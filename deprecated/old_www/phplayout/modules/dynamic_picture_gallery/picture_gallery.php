<?php

/**
 *
 * Blok dynamicky generovane obrazkove galerie
 *
 * public funkce:\n
 * construct: DynamicPictureGallery - hlavni konstruktor tridy\n
 * SekceGallery() - hlavni vypis sekci galerie\n
 * PictureGallery() - hlavni vypis obsahu galerie, podle url a nebo zadaneho parametru\n
 * RandomPicture() - nahodny vypis z galerie\n
 * Title() - vypisuje nazev sekce dle zvolene sekce\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicPictureGallery extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $cesta_zpet, $absolutni_url, $unikatni;
  public $idmodul = "picgall";
  private $get_sekce = "sekce";
  private $vypis_varovani = false;

  private $pathpicture = "picture";
  private $minidir = "mini";  //adresar miniatur
  private $midddir = "midd";  //adresaz zbytecnych strednich fotek
  private $fulldir = "full";  //adresar full obrazku
  private $nadpisdir = "nadpis"; //adresar obrazku nadpisu
  private $conffile = ".config_file";

  private $order_skup = array("skupina.datum ASC",  //defaultni
                              "skupina.datum ASC",  //datum
                              "skupina.datum DESC",
                              "skupina.poradi ASC", //poradi
                              "skupina.poradi DESC");

  private $order_pict = array("picture_gallery.datum ASC",  //defaultni
                              "picture_gallery.datum ASC",  //datum
                              "picture_gallery.datum DESC",
                              "picture_gallery.poradi ASC", //poradi
                              "picture_gallery.poradi DESC");

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;
    $this->dirpath = dirname($this->var->moduly[$index]["include"]);
    $this->dbname = $this->var->moduly[$index]["databaze"];

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->get_sekce = $this->NactiUnikatniObsah($this->unikatni["set_get_sekce"]);
    $this->vypis_varovani = $this->NactiUnikatniObsah($this->unikatni["set_vypis_varovani"]);
    $this->pathpicture = $this->NactiUnikatniObsah($this->unikatni["set_pathpicture"]);
    $this->minidir = $this->NactiUnikatniObsah($this->unikatni["set_minidir"]);
    $this->midddir = $this->NactiUnikatniObsah($this->unikatni["set_midddir"]);
    $this->fulldir = $this->NactiUnikatniObsah($this->unikatni["set_fulldir"]);
    $this->nadpisdir = $this->NactiUnikatniObsah($this->unikatni["set_nadpisdir"]);
    $this->conffile = $this->NactiUnikatniObsah($this->unikatni["set_conffile"]);

    $this->conffile = "{$this->dirpath}/{$this->conffile}";

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $this->Instalace();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"], $this->idmodul));
  }

/**
 *
 * Instalace SQLite databaze
 *
 */
  private function Instalace()
  {
    if (filesize("{$this->dirpath}/{$this->dbname}") == 0)
    {
      if (!@$this->sqlite->queryExec("CREATE TABLE skupina (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      nahledy INTEGER UNSIGNED,
                                      nazev VARCHAR(200),
                                      rewrite VARCHAR(200),
                                      url VARCHAR(200),
                                      popis TEXT,
                                      datum DATETIME,
                                      defaultni BOOL,
                                      poradi INTEGER UNSIGNED);

                                      CREATE TABLE picture_gallery (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      skupina INTEGER UNSIGNED,
                                      popisek VARCHAR(300),
                                      url VARCHAR(200),
                                      datum DATETIME,
                                      w_mini INTEGER UNSIGNED,
                                      h_mini INTEGER UNSIGNED,
                                      w_midd INTEGER UNSIGNED,
                                      h_midd INTEGER UNSIGNED,
                                      w_full INTEGER UNSIGNED,
                                      h_full INTEGER UNSIGNED,
                                      zobrazeni INTEGER UNSIGNED,
                                      poradi INTEGER UNSIGNED);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
  }

/**
 *
 * Vyhleda textovou reprezentaci sekce v databazi a pri uspechu vrati jeji cislo
 *
 * @param adresa adresa skupiny
 * @param sekce sekce galerie
 * @return cislo oznacene sekce
 */
  private function PrevodTextoveAdresy($adresa, $sekce)
  {
    $result = 0;
    if ($res = @$this->sqlite->query("SELECT id FROM skupina WHERE adresa='{$adresa}' AND rewrite='{$sekce}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->id;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    settype($result, "integer");

    return $result;
  }

/**
 *
 * Vrati cislo defaultni sekce, jestli teda je nejaka nastavena
 *
 * @param adresa adresa sekce
 * @return cislo defaultni sekce
 */
  private function DefaultniSekce($adresa)
  {
    $result = 0;
    if ($res = @$this->sqlite->query("SELECT id FROM skupina WHERE adresa='{$adresa}' AND defaultni=1;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->id;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    settype($result, "integer");

    return $result;
  }

/**
 *
 * Vrati cislo aktualni sekce vybrane
 *
 * @param adresa sekce
 * @return cislo sekce
 */
  private function AktualniSekce($adresa)
  {
    if ($this->DefaultniSekce($adresa) != 0)
    {
      $result = $this->DefaultniSekce($adresa);
    }
      else
    {
      if ($this->var->htaccess)
      {
        $result = $this->PrevodTextoveAdresy($adresa, $_GET[$this->get_sekce]); //vrati id adresy
      }
        else
      {
        $result = $_GET[$this->get_sekce];
        settype($result, "integer");
      }
    }

    return $result;
  }

/**
 *
 * Generovani title
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "Title", "adresa"[, 1]);</strong>
 *
 * @param adresa adresa sekce
 * @param tvar cislo tvaru
 * @return title text
 */
  public function Title($adresa, $tvar = 1)
  {
    $id = $this->AktualniSekce($adresa);

    $result = "";
    if ($res = @$this->sqlite->query("SELECT nazev FROM skupina WHERE id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_title_{$tvar}"],
                                            $res->fetchObject()->nazev);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Navraceni samotneho vypisu sekci
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "SekceGallery", "adresa"[, "cesta galere", 1]);</strong>
 *
 * @param adresa adresa sekce
 * @param cesta vlozena cesta do url
 * @param tvar cislo tvaru
 * @return vystupni sekce
 */
  public function SekceGallery($adresa, $cesta = NULL, $tvar = 1)
  {
    $sekce = $this->AktualniSekce($adresa);
    $this->cesta_zpet = $cesta;

    $result = "";

    $blok_skryvani = $this->NactiUnikatniObsah($this->unikatni["set_skryvani_sekce_{$tvar}"]);

    if ($sekce > 0 ? ($blok_skryvani ? false : true) : true)  //blok zobrazeni pri nastavenem zobrazovani
    {
      $prvni = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_prvni_{$tvar}"]);
      $posledni = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_posledni_{$tvar}"]);
      $ente_def_array = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_def_array_{$tvar}"]);
      $ente_def = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_def_{$tvar}"]);
      $ente_od = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_od_{$tvar}"]);
      $ente_po = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_po_{$tvar}"]);
      $ente = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_{$tvar}"]);
      $off_ente_posl = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_off_posl_{$tvar}"]);

      $prvni1 = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_prvni_{$tvar}"]);
      $posledni1 = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_posledni_{$tvar}"]);
      $ente_def_array1 = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_ente_def_array_{$tvar}"]);
      $ente_def1 = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_ente_def_{$tvar}"]);
      $ente_od1 = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_ente_od_{$tvar}"]);
      $ente_po1 = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_ente_po_{$tvar}"]);
      $ente1 = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_ente_{$tvar}"]);
      $off_ente_posl1 = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_ente_off_posl_{$tvar}"]);

      $arrayden = $this->NactiUnikatniObsah($this->unikatni["dny_datum_{$tvar}"]);

      $result = "";
      //vypis skupiny
      if ($res = @$this->sqlite->query("SELECT id, adresa, nahledy, nazev, rewrite, url, popis, datum, defaultni, poradi FROM skupina WHERE adresa='{$adresa}' ORDER BY {$this->order_skup[$this->ValueConfig(7)]};", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_init_{$tvar}"],  //inicializace ajaxu
                                              "{$this->absolutni_url}{$this->dirpath}/ajax.js");
          $i = 0;
          while ($data = $res->fetchObject())
          { //$this->var->main[0]->PrepisAdresy($data->nazev)
            //generovani nahledu fotky
            $nahledy = "";
            if ($res1 = @$this->sqlite->query("SELECT id, popisek, url, datum, zobrazeni FROM picture_gallery
                                              WHERE skupina={$data->id}
                                              ORDER BY {$this->order_pict[$this->ValueConfig(8)]}
                                              LIMIT 0,{$data->nahledy};", NULL, $error))
            {
              if ($res1->numRows() != 0)
              {
                $j = 0;
                $poc = $this->PocetRadkuObrazku($data->id); //vrati pocet radku obrazku
                while ($data1 = $res1->fetchObject())
                {
                  $nahledy .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_galerie_{$tvar}"],
                                                      $data1->popisek,
                                                      "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data1->url}",
                                                      "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->midddir}/{$data1->url}",
                                                      "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data1->url}",
                                                      "PoctadloZobrazeni({$data1->id});",
                                                      $data->id,
                                                      date($this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_galerie_datum_{$tvar}"], $arrayden[date("N", strtotime(stripslashes($data1->datum)))]), strtotime(stripslashes($data1->datum))),
                                                      $data1->zobrazeni,
                                                      $j + 1,
                                                      $poc,
                                                      ($j == 0 ? $prvni1 : ""),
                                                      ($j == ($data->nahledy - 1) ? $posledni1 : ""),
                                                      (in_array($j, $ente_def_array1) ? $ente_def1 : ""),
                                                      ((($j + $ente_od1) % $ente_po1) == 0 ? ($off_ente_posl && $j == ($data->nahledy - 1) ? "" : $ente1) : ""));
                  $j++;
                }
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }

            $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_galerie_{$tvar}"],
                                                $data->nazev,
                                                "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}/{$data->url}",
                                                $data->popis,
                                                date($this->NactiUnikatniObsah($this->unikatni["normal_vypis_nahled_galerie_datum_{$tvar}"], $arrayden[date("N", strtotime(stripslashes($data->datum)))]), strtotime(stripslashes($data->datum))),
                                                ($this->var->htaccess ? "{$this->absolutni_url}{$cesta}{$data->rewrite}" : "?{$cesta}{$this->get_sekce}={$data->id}"),
                                                (($data->id == $sekce) || ($data->id == $this->DefaultniSekce($adresa) && $sekce == 0) ? $this->NactiUnikatniObsah($this->unikatni["normal_sekce_galerie_vybrana_{$tvar}"]) : ""),
                                                ($i == 0 ? $prvni : ""),
                                                ($i == ($res->numRows() - 1) ? $posledni : ""),
                                                (in_array($i, $ente_def_array) ? $ente_def : ""),
                                                ((($i + $ente_od) % $ente_po) == 0 ? ($off_ente_posl && $i == ($res->numRows() - 1) ? "" : $ente) : ""),
                                                $poc, //pocet fotek v sekci
                                                $nahledy);
            $i++;
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_end_{$tvar}"]);
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $result;
  }

/**
 *
 * Navraceni samotne galerie podle sekce
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "PictureGallery"[, "adresa_skupiny"]);</strong>
 *
 * @param adresa adresa sekce
 * @param adr nazev (rewrite) skupiny v galerii
 * @param tvar cislo tvaru
 * @return vystupni galerie
 */
  public function PictureGallery($adresa, $adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $sekce = $this->PrevodTextoveAdresy($adresa, $adr);
    }
      else
    {
      $sekce = $this->AktualniSekce($adresa);
    }

    $prvni = $this->NactiUnikatniObsah($this->unikatni["normal_galerie_prvni_{$tvar}"]);
    $posledni = $this->NactiUnikatniObsah($this->unikatni["normal_galerie_posledni_{$tvar}"]);
    $ente_def_array = $this->NactiUnikatniObsah($this->unikatni["normal_galerie_ente_def_array_{$tvar}"]);
    $ente_def = $this->NactiUnikatniObsah($this->unikatni["normal_galerie_ente_def_{$tvar}"]);
    $ente_od = $this->NactiUnikatniObsah($this->unikatni["normal_galerie_ente_od_{$tvar}"]);
    $ente_po = $this->NactiUnikatniObsah($this->unikatni["normal_galerie_ente_po_{$tvar}"]);
    $ente = $this->NactiUnikatniObsah($this->unikatni["normal_galerie_ente_{$tvar}"]);
    $off_ente_posl = $this->NactiUnikatniObsah($this->unikatni["normal_galerie_ente_off_posl_{$tvar}"]);

    $arrayden = $this->NactiUnikatniObsah($this->unikatni["dny_datum_{$tvar}"]);

    if ($res = @$this->sqlite->query("SELECT nazev, url, popis FROM skupina WHERE id={$sekce};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $skup_nazev = $data->nazev;
        $skup_url = $data->url;
        $skup_popis = $data->popis;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result = "";
    //vypis gelerie
    if ($res = @$this->sqlite->query("SELECT id, popisek, url, datum, zobrazeni FROM picture_gallery WHERE skupina={$sekce} ORDER BY {$this->order_pict[$this->ValueConfig(8)]};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_init_{$tvar}"],  //inicializace ajaxu
                                            "{$this->absolutni_url}{$this->dirpath}/ajax.js",
                                            $skup_nazev,
                                            "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}/{$skup_url}",
                                            $skup_popis,
                                            "{$this->absolutni_url}{$this->cesta_zpet}");

        $poc = $res->numRows();
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_galerie_{$tvar}"],
                                              $data->popisek,
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}",
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->midddir}/{$data->url}",
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}",
                                              "PoctadloZobrazeni({$data->id});",
                                              $data->id,
                                              date($this->NactiUnikatniObsah($this->unikatni["normal_vypis_galerie_datum_{$tvar}"], $arrayden[date("N", strtotime(stripslashes($data->datum)))]), strtotime(stripslashes($data->datum))),
                                              $data->zobrazeni,
                                              $i + 1,
                                              $poc,
                                              ($i == 0 ? $prvni : ""),
                                              ($i == ($res->numRows() - 1) ? $posledni : ""),
                                              (in_array($i, $ente_def_array) ? $ente_def : ""),
                                              ((($i + $ente_od) % $ente_po) == 0 ? ($off_ente_posl && $i == ($res->numRows() - 1) ? "" : $ente) : ""));

          $i++;
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_galerie_end_{$tvar}"]);
      }
        else
      {
        if (!Empty($sekce))
        {
          if ($this->vypis_varovani)
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_galerie_null_{$tvar}"]);
          }
            else
          {
            $result = "";
          }
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vykresli nahodny obrazek z gelerie
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "RandomPicture"[, "adresa_skupiny"]);</strong>
 *
 * @param adresa adresa sekce
 * @param adr nazev (rewrite) skupiny v galerii
 * @param tvar cislo tvaru
 * @return vystupni obrazek
 */
  public function RandomPicture($adresa, $tvar = 1)
  {
    if ($res = @$this->sqlite->query("SELECT
                                      picture_gallery.id id, s.nazev nazev
                                      FROM skupina s, picture_gallery
                                      WHERE s.id=picture_gallery.skupina AND s.adresa='{$adresa}'
                                      ORDER BY {$this->order_pict[$this->ValueConfig(8)]};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $id[$data->id] = $data->nazev;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result = "";
    if (!Empty($id))
    {
      //tvar: [id]->sekce
      $ide = array_keys($id); //ziskani klicu do value
      $allpocet = array_count_values(array_values($id));  //pocty fotek v kazde sekci [sekce] -> pocet
      $nahoda = $ide[array_rand($ide)]; //nahodne cislo z cele rady
      settype($nahoda, "integer");  //definovani na cislo
      $aktualni_sekce = $id[$nahoda]; //sahne do originalniho pole s cislem nahody pro nazev
      $reverz = array_flip(array_keys($id, $aktualni_sekce)); //prevracene pole vyhledanych klicu v aktualni sekci
      $aktualni = $reverz[$nahoda] + 1; //sahnuti do reverze id fotky a vytahne porad o -1 mensi, +1 korekce na spravny pocet
      $pocet = $allpocet[$aktualni_sekce];  //vezme si pocet fote v aktualn sekci
      $arrayden = $this->NactiUnikatniObsah($this->unikatni["dny_datum_{$tvar}"]);

      if ($res = @$this->sqlite->query("SELECT
                                        id, popisek, url, datum, zobrazeni
                                        FROM picture_gallery
                                        WHERE id={$nahoda};", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          while ($data = $res->fetchObject())
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_random_{$tvar}"],
                                                $aktualni_sekce,
                                                $data->popisek,
                                                "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}",
                                                "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->midddir}/{$data->url}",
                                                "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}",
                                                "PoctadloZobrazeni({$data->id});",
                                                $data->id,
                                                date($this->NactiUnikatniObsah($this->unikatni["normal_vypis_galerie_datum_{$tvar}"], $arrayden[date("N", strtotime(stripslashes($data->datum)))]), strtotime(stripslashes($data->datum))),
                                                $data->zobrazeni,
                                                $aktualni,
                                                $pocet,
                                                "{$this->absolutni_url}{$this->dirpath}/ajax.js");
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $result;
  }

/**
 *
 * Obsah adminu
 *
 * @return obsah adminu
 */
  public function AdminObsah()
  {
    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      switch ($_GET[$this->var->get_idmodul])
      {
        case $this->idmodul:  //id modul
          $result = $this->AdministraceObsahu();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Overuje jestli existuje polozda v DB
 *
 * @param nazev nazev sekce
 * @return true/false - existuje / neexistuje
 */
  private function ExistujePolozka($nazev)
  {
    if ($res = @$this->sqlite->query("SELECT id FROM skupina WHERE nazev='{$nazev}';", NULL, $error))
    {
      $result = ($res->numRows() == 1 ? true : false);
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati select pro vyber ze sekce
 *
 * @param id id polozky menu, nepovinne
 * @return html select
 */
  private function VyberSekce($id = NULL)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev FROM skupina ORDER BY {$this->order_skup[$this->ValueConfig(7)]};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sekce_select_begin"]);

        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sekce_select"],
                                              $data->id,
                                              (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->nazev);
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sekce_select_end"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sekce_select_null"]);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati pocet obrazku ve skupine
 *
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadkuSkupiny($inc = 0)
  {
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) pocet FROM skupina;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->pocet + $inc;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati pocet obrazku v dane skupine
 *
 * @param skupina skupna obrazku
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadkuObrazku($skupina, $inc = 0)
  {
    settype($skupina, "integer");
    settype($inc, "integer");

    $result = 0;
    if (!Empty($skupina))
    {
      if ($res = @$this->sqlite->query("SELECT COUNT(id) pocet FROM picture_gallery WHERE skupina={$skupina};", NULL, $error))
      {
        if ($res->numRows() == 1)
        {
          $result = $res->fetchObject()->pocet + $inc;
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
      else
    {
      $result = $inc;
    }

    return $result;
  }

/**
 *
 * Vrati pocet a vypis dostupnych skupin
 *
 * @return vypis skupin
 */
  private function SeznamSkupin()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev
                                      FROM skupina
                                      ORDER BY {$this->order_skup[$this->ValueConfig(7)]};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_skupin"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addpict&amp;skupina={$data->id}",
                                              $data->nazev,
                                              $this->PocetRadkuObrazku($data->id));
        }
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_seznam_skupin_null"]);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati hodnotu daneho indexu
 *
 * @param cislo index pole pro navrat pozadovane hodnoty
 * @return cislo dle indexu
 */
  private function ValueConfig($cislo)
  {
    $result = 0;
    if (file_exists($this->conffile))
    {
      $u = fopen($this->conffile, "r");
      $data = explode("-", fread($u, filesize($this->conffile)));
      fclose($u);

      $result = $data[$cislo];
    }

    return $result;
  }

/**
 *
 * Nacte konfiguraci
 *
 * @param w_mini sirka mini
 * @param h_mini vyska mini
 * @param w_midd sirka midd
 * @param h_midd vyska midd
 * @param w_full sirka full
 * @param h_full vyska full
 * @param limit limit uploadu
 */
  private function LoadConfig(&$w_mini, &$h_mini, &$w_midd, &$h_midd, &$w_full, &$h_full, &$limit, &$razeni1, &$razeni2)
  {
    if (file_exists($this->conffile))
    {
      $u = fopen($this->conffile, "r");
      $data = fread($u, filesize($this->conffile));
      fclose($u);

      $data = explode("-", $data);
      $w_mini = $data[0]; //mini
      $h_mini = $data[1];
      $w_midd = $data[2]; //midd
      $h_midd = $data[3];
      $w_full = $data[4]; //full
      $h_full = $data[5];
      $limit = $data[6];
      $razeni1 = $data[7];
      $razeni2 = $data[8];
    }
      else
    {
      $u = fopen($this->conffile, "w");
      fwrite($u, "0-135-0-300-0-400-3-1-1");
      fclose($u);

      echo "soubor se vytvari, pro pokracovani refresujte a nebo zmente prava zapisu ve slozce";
    }
  }

/**
 *
 * Ulozi konfiguraci
 *
 * @return info o ulozeni
 */
  private function SaveConfig()
  {
    $w_mini = $_POST["w_mini"];
    settype($w_mini, "integer");

    $h_mini = $_POST["h_mini"];
    settype($h_mini, "integer");

    $w_midd = $_POST["w_midd"];
    settype($w_midd, "integer");

    $h_midd = $_POST["h_midd"];
    settype($h_midd, "integer");

    $w_full = $_POST["w_full"];
    settype($w_full, "integer");

    $h_full = $_POST["h_full"];
    settype($h_full, "integer");

    $limit = $_POST["limit"];
    settype($limit, "integer");

    $razeni1 = $_POST["razeni1"];
    settype($razeni1, "integer");

    $razeni2 = $_POST["razeni2"];
    settype($razeni2, "integer");

    $u = fopen($this->conffile, "w");
    fwrite($u, "{$w_mini}-{$h_mini}-{$w_midd}-{$h_midd}-{$w_full}-{$h_full}-{$limit}-{$razeni1}-{$razeni2}");
    fclose($u);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_config_save"]);

    return $result;
  }

/**
 *
 * Vygenerovani ajax scriptu pro web
 *
 */
  private function VygenerujAjaxScript()
  {
    $cesta = "{$this->dirpath}/ajax.js";
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        $this->dirpath);
      $u = fopen($cesta, "w");
      fwrite($u, $obsah);
      fclose($u);

      var_dump("vytvořeno: {$cesta}");
    }
  }

/**
 *
 * Vrati text daneho sloupce
 *
 * @param skupina id skupiny
 * @param sloupec nazev sloupce v databazi
 * @return text sloupce
 */
  private function VypisSloupce($skupina, $sloupec)
  {
    settype($skupina, "integer");

    $result = "";
    if ($res = @$this->sqlite->query("SELECT {$sloupec} vyst
                                      FROM skupina
                                      WHERE
                                      id={$skupina};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $result = $data->vyst;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickeho menu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addgrup",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addpict",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=config",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=stat",
                                        $this->SeznamSkupin(),
                                        $this->AdminVypisGallery());

    if (!file_exists("{$this->dirpath}/{$this->pathpicture}"))  //vytvoreni slozek na obrazky
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}")) //mini
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->midddir}")) //midd
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->midddir}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}")) //full
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}")) //nadpis
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}", 0777);
    }

    $this->VygenerujAjaxScript(); //vygenerovani scriptu

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "config":  //kofigurace galerie
          $this->LoadConfig($w_mini, $h_mini, $w_midd, $h_midd, $w_full, $h_full, $limit, $razeni1, $razeni2);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_config"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                              ($w_mini != 0 ? " checked=\"checked\"" : ""),
                                              $w_mini,
                                              ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                              $h_mini,
                                              ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? " checked=\"checked\"" : ""),
                                              ($w_midd != 0 ? " checked=\"checked\"" : ""),
                                              $w_midd,
                                              ($h_midd != 0 ? " checked=\"checked\"" : ""), //10
                                              $h_midd,
                                              ($w_midd != 0 && $h_midd != 0 ? " checked=\"checked\"" : ""), //12
                                              ($w_full != 0 ? " checked=\"checked\"" : ""),
                                              $w_full,
                                              ($h_full != 0 ? " checked=\"checked\"" : ""),
                                              $h_full,
                                              ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                              ($limit != 0 ? " checked=\"checked\"" : ""),
                                              $limit,
                                              ($limit == 0 ? " checked=\"checked\"" : ""),
                                              ($razeni1 == 1 ? " checked=\"checked\"" : ""),
                                              ($razeni1 == 2 ? " checked=\"checked\"" : ""),
                                              ($razeni1 == 3 ? " checked=\"checked\"" : ""),
                                              ($razeni1 == 4 ? " checked=\"checked\"" : ""),
                                              ($razeni2 == 1 ? " checked=\"checked\"" : ""),
                                              ($razeni2 == 2 ? " checked=\"checked\"" : ""),
                                              ($razeni2 == 3 ? " checked=\"checked\"" : ""),
                                              ($razeni2 == 4 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? "mini_4();" : ($w_mini != 0 && $h_mini != 0 ? "mini_3();" : ($h_mini != 0 ? "mini_2();" : ($w_mini != 0 ? "mini_1();" : "")))),
                                              ($w_midd != 0 && $h_midd != 0 ? "midd_3();" : ($h_midd != 0 ? "midd_2();" : ($w_midd != 0 ? "midd_1();" : ""))),
                                              ($w_full == 0 && $h_full == 0 ? "full_4();" : ($w_full != 0 && $h_full != 0 ? "full_3();" : ($h_full != 0 ? "full_2();" : ($w_full != 0 ? "full_1();" : "")))),
                                              ($limit == 0 ? "lim_2();" : "lim_1();"));

          if (!Empty($_POST["tlacitko"]))
          {
            $result = $this->SaveConfig();

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "addgrup": //pridavani skupiny
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgrup"],
                                              $this->dirpath,
                                              date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"])),
                                              ($this->ValueConfig(7) > 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_input_poradi"], $this->PocetRadkuSkupiny(1)) : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");
          //7 - 1-2:datum, 3-4:poradi
          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $nahledy = $_POST["nahledy"];
          settype($nahledy, "integer");
          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $rewrite = stripslashes(htmlspecialchars($_POST["rewrite"], ENT_QUOTES));
          $popis = stripslashes(htmlspecialchars($_POST["popis"], ENT_QUOTES));
          $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
          $defaultni = (!Empty($_POST["defaultni"]) ? 1 : 0);
          $poradi = $_POST["poradi"];
          settype($poradi, "integer");

          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $mezi = explode(".", $_FILES["obrazek"]["name"]);
            $url = "";
            $meziurl = "{$this->VytvorJmenoObrazku()}.{$mezi[count($mezi) - 1]}";
            if ((strtolower($mezi[count($mezi) - 1]) == "jpg" ||
                strtolower($mezi[count($mezi) - 1]) == "png") &&
                move_uploaded_file($_FILES["obrazek"]["tmp_name"], "{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}/{$meziurl}"))
            {
              $url = $meziurl;
            }
              else
            {
              $this->var->main[0]->ErrorMsg($_FILES["obrazek"]["error"], array(__LINE__, __METHOD__));
            }
          }
            else
          {
            $url = "";
          }

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($nazev) &&
              !Empty($datum) &&
              !Empty($rewrite) &&
              !$this->ExistujePolozka($nazev))  //kontrola duplicity
          {


            if (@$this->sqlite->queryExec("INSERT INTO skupina (id, adresa, nahledy, nazev, rewrite, url, popis, datum, defaultni, poradi) VALUES
                                          (NULL, '{$adresa}', {$nahledy}, '{$nazev}', '{$rewrite}', '{$url}', '{$popis}', '{$datum}', {$defaultni}, {$poradi});", $error))
            {
              $navic = $this->SyncFileWithDBNadpis(); //synchronizace

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgrup_hlaska"],
                                                  $nazev,
                                                  $navic);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editgrup":  //editace skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, nahledy, nazev, rewrite, url, popis, datum, defaultni, poradi FROM skupina WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgrup"],
                                                  $this->dirpath,
                                                  $data->adresa,
                                                  $data->nahledy,
                                                  $data->nazev,
                                                  $data->rewrite,
                                                  "{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}/{$data->url}",
                                                  $data->popis,
                                                  date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"]), strtotime(stripslashes($data->datum))),
                                                  ($data->defaultni ? " checked=\"checked\"" : ""),
                                                  $data->poradi,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $nahledy = $_POST["nahledy"];
              settype($nahledy, "integer");
              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $rewrite = stripslashes(htmlspecialchars($_POST["rewrite"], ENT_QUOTES));
              $popis = stripslashes(htmlspecialchars($_POST["popis"], ENT_QUOTES));
              $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
              $defaultni = (!Empty($_POST["defaultni"]) ? 1 : 0);
              $poradi = $_POST["poradi"];
              settype($poradi, "integer");

              if (!Empty($_FILES["obrazek"]["tmp_name"]))
              {
                $mezi = explode(".", $_FILES["obrazek"]["name"]);
                $url = $data->url;
                $meziurl = "{$this->VytvorJmenoObrazku()}.{$mezi[count($mezi) - 1]}";
                if ((strtolower($mezi[count($mezi) - 1]) == "jpg" ||
                    strtolower($mezi[count($mezi) - 1]) == "png") &&
                    move_uploaded_file($_FILES["obrazek"]["tmp_name"], "{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}/{$meziurl}"))
                {
                  $url = $meziurl;
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($_FILES["obrazek"]["error"], array(__LINE__, __METHOD__));
                }
              }
                else
              {
                $url = $data->url;
              }

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($nazev) &&
                  !Empty($rewrite) &&
                  !Empty($datum) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE skupina SET defaultni=0;
                                               UPDATE skupina SET adresa='{$adresa}',
                                                                  nahledy={$nahledy},
                                                                  nazev='{$nazev}',
                                                                  rewrite='{$rewrite}',
                                                                  url='{$url}',
                                                                  popis='{$popis}',
                                                                  datum='{$datum}',
                                                                  defaultni={$defaultni},
                                                                  poradi={$poradi}
                                                                  WHERE id={$id};
                                                                  ", $error))
                {
                  $navic = $this->SyncFileWithDBNadpis(); //synchronizace

                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgrup_hlaska"],
                                                      $nazev,
                                                      $navic);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "delgrup": //mazani skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT nazev FROM skupina WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec ("DELETE FROM skupina WHERE id={$id};
                                              DELETE FROM picture_gallery WHERE skupina={$id};", $error)) //provedeni dotazu
              {
                $navic = $this->SyncFileWithDB(); //synchronizace 1
                $navic += $this->SyncFileWithDBNadpis(); //synchronizace 2

                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delgrup_hlaska"],
                                                    $data->nazev,
                                                    $navic);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "addpict": //pridavani obrazku
          $w_mini = $this->ValueConfig(0);
          $h_mini = $this->ValueConfig(1);
          $w_midd = $this->ValueConfig(2);
          $h_midd = $this->ValueConfig(3);
          $w_full = $this->ValueConfig(4);
          $h_full = $this->ValueConfig(5);
          //8 - 1-2:datum, 3-4:poradi
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addpict"],
                                              $this->VyberSekce($_GET["skupina"]),
                                              date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"])),
                                              ($this->ValueConfig(8) > 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_input_poradi_pict"], $this->PocetRadkuObrazku($_GET["skupina"], 1)) : ""),
                                              $w_mini,
                                              $h_mini,
                                              $w_midd,
                                              $h_midd,
                                              $w_full,
                                              $h_full,
                                              ($w_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? " checked=\"checked\"" : ""),
                                              ($w_midd != 0 ? " checked=\"checked\"" : ""), //14
                                              ($h_midd != 0 ? " checked=\"checked\"" : ""),
                                              ($w_midd != 0 && $h_midd != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full != 0 ? " checked=\"checked\"" : ""),
                                              ($h_full != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? "mini_4()" : ($w_mini != 0 && $h_mini != 0 ? "mini_3();" : ($h_mini != 0 ? "mini_2();" : ($w_mini != 0 ? "mini_1();" : "")))),
                                              ($w_midd != 0 && $h_midd != 0 ? "midd_3();" : ($h_midd != 0 ? "midd_2();" : ($w_midd != 0 ? "midd_1();" : ""))),
                                              ($w_full == 0 && $h_full == 0 ? "full_4();" : ($w_full != 0 && $h_full != 0 ? "full_3();" : ($h_full != 0 ? "full_2();" : ($w_full != 0 ? "full_1();" : "")))),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                              $this->VypisSloupce($_GET["skupina"], "nazev"));

          $skupina = $_POST["skupina"];
          settype($skupina, "integer");

          $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));

          $w_mini = $_POST["w_mini"];
          settype($w_mini, "integer");

          $h_mini = $_POST["h_mini"];
          settype($h_mini, "integer");

          $w_midd = $_POST["w_midd"];
          settype($w_midd, "integer");

          $h_midd = $_POST["h_midd"];
          settype($h_midd, "integer");

          $w_full = $_POST["w_full"];
          settype($w_full, "integer");

          $h_full = $_POST["h_full"];
          settype($h_full, "integer");

          $poradi = $_POST["poradi"];
          settype($poradi, "integer");

          $ob = false;
          $urlobrazku = "";
          for ($i = 0; $i < count($_FILES["obrazek"]["tmp_name"]); $i++)
          {
            if (!Empty($_FILES["obrazek"]["tmp_name"][$i]))
            {
              $obrazek["obrazek"]["name"] = $_FILES["obrazek"]["name"][$i];
              $obrazek["obrazek"]["type"] = $_FILES["obrazek"]["type"][$i];
              $obrazek["obrazek"]["tmp_name"] = $_FILES["obrazek"]["tmp_name"][$i];
              $obrazek["obrazek"]["error"] = $_FILES["obrazek"]["error"][$i];
              $obrazek["obrazek"]["size"] = $_FILES["obrazek"]["size"][$i];
              $url = "";
              $ob = $this->ZpracujObrazek($obrazek["obrazek"], $url, $w_mini, $h_mini, $w_midd, $h_midd, $w_full, $h_full, $_FILES["mini_obrazek"]);
              $urlobrazku[] = $url;
              $popisek[] = stripslashes(htmlspecialchars($_POST["popisek"][$i], ENT_QUOTES));
            }
          }

/*
          $ob = false;
          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $ob = $this->ZpracujObrazek($_FILES["obrazek"], $url, $w_mini, $h_mini, $w_midd, $h_midd, $w_full, $h_full, $_FILES["mini_obrazek"]);
          }
*/

          if (!Empty($_POST["tlacitko"]) &&
              //!Empty($popisek) &&
              !Empty($datum) &&
              $skupina > 0 &&
              $ob)
          {
            $chyba = false;
            for ($i = 0; $i < count($urlobrazku); $i++)
            {
              if (!@$this->sqlite->queryExec("INSERT INTO picture_gallery (id, skupina, popisek, url, datum, w_mini, h_mini, w_midd, h_midd, w_full, h_full, zobrazeni, poradi) VALUES
                                              (NULL, {$skupina}, '{$popisek[$i]}', '{$urlobrazku[$i]}', '{$datum}', {$w_mini}, {$h_mini}, {$w_midd}, {$h_midd}, {$w_full}, {$h_full}, 0, {$poradi});", $error))
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                $chyba = true;
              }

              $poradi++;
            }

            if (!$chyba)
            {
              $navic = $this->SyncFileWithDB(); //synchronizace

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addpict_hlaska"],
                                                  $popisek[0],
                                                  $navic);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }

/*
            if (@$this->sqlite->queryExec("INSERT INTO picture_gallery (id, skupina, popisek, url, datum, w_mini, h_mini, w_midd, h_midd, w_full, h_full, zobrazeni, poradi) VALUES
                                          (NULL, {$skupina}, '{$popisek}', '{$url}', '{$datum}', {$w_mini}, {$h_mini}, {$w_midd}, {$h_midd}, {$w_full}, {$h_full}, 0, {$poradi});", $error))
            {
              $navic = $this->SyncFileWithDB(); //synchronizace

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addpict_hlaska"],
                                                  $popisek,
                                                  $navic);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
*/
          }
        break;

        case "editpict":  //editace skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT id, skupina, popisek, url, datum, w_mini, h_mini, w_midd, h_midd, w_full, h_full, zobrazeni, poradi FROM picture_gallery WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
              //8 - 1-2:datum, 3-4:poradi
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editpict"],
                                                  $this->VyberSekce($data->skupina),
                                                  $data->popisek,
                                                  "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}",
                                                  "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}",
                                                  date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"]), strtotime(stripslashes($data->datum))),
                                                  ($this->ValueConfig(8) > 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_input_poradi_pict"], $data->poradi) : ""),
                                                  $data->w_mini,
                                                  $data->h_mini,
                                                  $data->w_midd,
                                                  $data->h_midd,
                                                  $data->w_full,
                                                  $data->h_full,  //12
                                                  ($data->w_mini != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->h_mini != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_mini != 0 && $data->h_mini != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_mini == 0 && $data->h_mini == 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_midd != 0 ? " checked=\"checked\"" : ""), //14
                                                  ($data->h_midd != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_midd != 0 && $data->h_midd != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_full != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->h_full != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_full != 0 && $data->h_full != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_full == 0 && $data->h_full == 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_mini == 0 && $data->h_mini == 0 ? "mini_4()" : ($data->w_mini != 0 && $data->h_mini != 0 ? "mini_3();" : ($data->h_mini != 0 ? "mini_2();" : ($data->w_mini != 0 ? "mini_1();" : "")))),
                                                  ($data->w_midd != 0 && $data->h_midd != 0 ? "midd_3();" : ($data->h_midd != 0 ? "midd_2();" : ($data->w_midd != 0 ? "midd_1();" : ""))),
                                                  ($data->w_full == 0 && $data->h_full == 0 ? "full_4();" : ($data->w_full != 0 && $data->h_full != 0 ? "full_3();" : ($data->h_full != 0 ? "full_2();" : ($data->w_full != 0 ? "full_1();" : "")))),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  $this->VypisSloupce($data->skupina, "nazev"));

              $skupina = $_POST["skupina"];
              settype($skupina, "integer");
              $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
              $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));

              $w_mini = $_POST["w_mini"];
              settype($w_mini, "integer");

              $h_mini = $_POST["h_mini"];
              settype($h_mini, "integer");

              $w_midd = $_POST["w_midd"];
              settype($w_midd, "integer");

              $h_midd = $_POST["h_midd"];
              settype($h_midd, "integer");

              $w_full = $_POST["w_full"];
              settype($w_full, "integer");

              $h_full = $_POST["h_full"];
              settype($h_full, "integer");

              $poradi = $_POST["poradi"];
              settype($poradi, "integer");

              if (!Empty($_FILES["obrazek"]["tmp_name"]) &&
                  ($w_mini == 0 && $h_mini == 0 && Empty($_FILES["mini_obrazek"]["tmp_name"]) ? false : true))
              {
                $this->ZpracujObrazek($_FILES["obrazek"], $url, $w_mini, $h_mini, $w_midd, $h_midd, $w_full, $h_full, $_FILES["mini_obrazek"]);
              }
                else
              {
                $url = $data->url;
              }

              if (!Empty($_POST["tlacitko"]) &&
                  //!Empty($popisek) &&
                  !Empty($datum) &&
                  $skupina > 0 &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE picture_gallery SET skupina={$skupina},
                                                                          popisek='{$popisek}',
                                                                          url='{$url}',
                                                                          datum='{$datum}',
                                                                          w_mini={$w_mini},
                                                                          h_mini={$h_mini},
                                                                          w_midd={$w_midd},
                                                                          h_midd={$h_midd},
                                                                          w_full={$w_full},
                                                                          h_full={$h_full},
                                                                          poradi={$poradi}
                                                                          WHERE id={$id};", $error))
                {
                  $navic = $this->SyncFileWithDB(); //synchronizace

                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editpict_hlaska"],
                                                      $popisek,
                                                      $navic);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "delpict": //mazani skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT popisek, url FROM picture_gallery WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM picture_gallery WHERE id={$id};", $error)) //provedeni dotazu
              {
                $navic = $this->SyncFileWithDB(); //synchronizace

                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delpict_hlaska"],
                                                    $data->popisek,
                                                    $navic);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "stat":  //statistika galerie
          $mini_sum = 0;
          $mini_poc = 0;
          $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}";  //projiti minitur
          $handle = opendir($cesta);
          while($soub = readdir($handle))
          {
            if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
            {
              $mini_sum += filesize("{$cesta}/{$soub}");  //souce velikosti
              $mini_poc++;  //pocet
            }
          }
          closedir($handle);

          $midd_sum = 0;
          $midd_poc = 0;
          $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->midddir}";  //projiti middle
          $handle = opendir($cesta);
          while($soub = readdir($handle))
          {
            if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
            {
              $midd_sum += filesize("{$cesta}/{$soub}");  //souce velikosti
              $midd_poc++;  //pocet
            }
          }
          closedir($handle);

          $full_sum = 0;
          $full_poc = 0;
          $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}";  //projiti middle
          $handle = opendir($cesta);
          while($soub = readdir($handle))
          {
            if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
            {
              $full_sum += filesize("{$cesta}/{$soub}");  //souce velikosti
              $full_poc++;  //pocet
            }
          }
          closedir($handle);

          if ($res = @$this->sqlite->query("SELECT id, nazev, popis, datum FROM skupina;", NULL, $error))
          {
            $pocgal = 0;
            if ($res->numRows() != 0)
            {
              $galerie = "";
              $pocgal = $res->numRows();

              while ($data = $res->fetchObject())
              {
                $datum = date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"]), strtotime($data->datum));
                $sumpoc = 0;
                $summini = 0;
                $summidd = 0;
                $sumfull = 0;
                $sumzobr = 0;

                if ($res1 = @$this->sqlite->query("SELECT
                                                  url, zobrazeni
                                                  FROM picture_gallery
                                                  WHERE skupina={$data->id};", NULL, $error))
                {
                  if ($res1->numRows() != 0)
                  {
                    $sumpoc = $res1->numRows();

                    while ($data1 = $res1->fetchObject())
                    {
                      $summini += @filesize("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data1->url}");
                      $summidd += @filesize("{$this->dirpath}/{$this->pathpicture}/{$this->midddir}/{$data1->url}");
                      $sumfull += @filesize("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data1->url}");
                      $sumzobr += $data1->zobrazeni;
                    }
                  }
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                }

                $galerie .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_galerie"],
                                                      $data->nazev,
                                                      $data->popis,
                                                      $datum,
                                                      $sumpoc,
                                                      $this->var->main[0]->NactiFunkci("Funkce", "Velikost", $summini),
                                                      $this->var->main[0]->NactiFunkci("Funkce", "Velikost", $summidd),
                                                      $this->var->main[0]->NactiFunkci("Funkce", "Velikost", $sumfull),
                                                      $this->var->main[0]->NactiFunkci("Funkce", "Velikost", $summini + $summidd + $sumfull),
                                                      $sumzobr);
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_stat"],
                                              $mini_poc,
                                              $this->var->main[0]->NactiFunkci("Funkce", "Velikost", $mini_sum),
                                              $midd_poc,
                                              $this->var->main[0]->NactiFunkci("Funkce", "Velikost", $midd_sum),
                                              $full_poc,
                                              $this->var->main[0]->NactiFunkci("Funkce", "Velikost", $full_sum),
                                              $this->var->main[0]->NactiFunkci("Funkce", "Velikost", $mini_sum + $midd_sum + $full_sum),
                                              $mini_poc + $midd_poc + $full_poc,
                                              $pocgal,
                                              $galerie,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");
        break;
      }
    }

    return $result;
  }

/**
 *
 * Kontroluje rozdily mezi databazi a filesystemem
 *
 */
  private function SyncFileWithDB()
  {
    if ($res = @$this->sqlite->query("SELECT url FROM picture_gallery", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $databaze[$i] = $data->url;
          $i++;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}";  //projiti miniatur
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $mini[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->midddir}";  //projiti strednich velikosti
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $midd[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}";  //projiti plnych velikosti
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $full[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    $pocet1 = 0;
    if (count($databaze) != 0 &&  //mini
        count($mini) != 0)
    {
      $diff = array_diff($mini, $databaze); //vyhozeni rozdilu
      $diff = array_values($diff);  //oprava indexu
      $pocet1 = count($diff);

      for ($i = 0; $i < $pocet1; $i++)
      {
        chmod("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$diff[$i]}");
      }
    }

    $pocet3 = 0;
    if (count($databaze) != 0 &&  //midd
        count($midd) != 0)
    {
      $diff = array_diff($midd, $databaze); //vyhozeni rozdilu
      $diff = array_values($diff);  //oprava indexu
      $pocet3 = count($diff);

      for ($i = 0; $i < $pocet3; $i++)
      {
        chmod("{$this->dirpath}/{$this->pathpicture}/{$this->midddir}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathpicture}/{$this->midddir}/{$diff[$i]}");
      }
    }

    $pocet2 = 0;
    if (count($databaze) != 0 &&  //full
        count($full) != 0)
    {
      $diff = array_diff($full, $databaze); //vyhozeni rozdilu
      $diff = array_values($diff);  //oprava indexu
      $pocet2 = count($diff);

      for ($i = 0; $i < $pocet2; $i++)
      {
        chmod("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$diff[$i]}");
      }
    }

    $result = $pocet1 + $pocet2 + $pocet3;

    return $result;
  }

/**
 *
 * Kontroluje rozdily mezi databazi a filesystemem
 *
 */
  private function SyncFileWithDBNadpis()
  {
    if ($res = @$this->sqlite->query("SELECT url FROM skupina", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $databaze[$i] = $data->url;
          $i++;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}";  //projiti miniatur
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $mini[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    $pocet1 = 0;
    if (count($databaze) != 0 &&  //mini
        count($mini) != 0)
    {
      $diff = array_diff($mini, $databaze); //vyhozeni rozdilu
      $diff = array_values($diff);  //oprava indexu
      $pocet1 = count($diff);

      for ($i = 0; $i < $pocet1; $i++)
      {
        chmod("{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathpicture}/{$this->nadpisdir}/{$diff[$i]}");
      }
    }

    $result = $pocet1;

    return $result;
  }

/**
 *
 * Zpracovani obrazku
 *
 * @param tmp temp name obrazku
 * @param &obrazek pres parametr vraci jmeno obrazku
 * @param w_mini sirka mini
 * @param h_mini vyska mini
 * @param w_full sirka full
 * @param h_full vyska full
 * @param tmp2 temp name nahradni minatury
 * @return true/false - povedlo se / nepovedlo se
 */
  private function ZpracujObrazek($tmp, &$obrazek, $w_mini, $h_mini, $w_midd, $h_midd, $w_full, $h_full, $tmp2 = null)
  {
    list($old_w, $old_h) = getimagesize($tmp["tmp_name"]);
    $result = true;

    if (Empty($tmp2["tmp_name"]))
    {
      //mini obr
      if ($w_mini != 0 && //pevna velikost
          $h_mini != 0)
      {
        if ($old_w <= $w_mini &&
            $old_h <= $h_mini)
        {
          $new_w = $old_w;  //zanechava
          $new_h = $old_h;
        }
          else
        {
          $new_w = $w_mini; //zmensuje
          $new_h = $h_mini;
        }
      }
        else
      if ($h_mini == 0) //auto dopocitavani vysky
      {
        if ($old_w <= $w_mini)
        {
          $new_w = $old_w;  //zanechava
          $new_h = $old_h;
        }
          else
        {
          $new_w = $w_mini; //zmensuje
          $new_h = round($old_h / ($old_w / $w_mini));
        }
      }
        else
      if ($w_mini == 0) //auto dopocitavani sirky
      {
        if ($old_w <= $h_mini)
        {
          $new_w = $old_w;  //zanechava
          $new_h = $old_h;
        }
          else
        {
          $new_w = round($old_w / ($old_h / $h_mini)); //zmensuje
          $new_h = $h_mini;
        }
      }
        else
      {
        $result = false;
      }
    }

    //midd obr
    if ($w_midd == 0 && //pevna velikost
        $h_midd == 0)
    {
      $new_w_mid = $old_w;  //zanechava
      $new_h_mid = $old_h;
    }
      else
    if ($w_midd != 0 && //pevna velikost
        $h_midd != 0)
    {
      if ($old_w <= $w_midd &&
          $old_h <= $h_midd)
      {
        $new_w_mid = $old_w;  //zanechava
        $new_h_mid = $old_h;
      }
        else
      {
        $new_w_mid = $w_midd; //zmensuje
        $new_h_mid = $h_midd;
      }
    }
      else
    if ($h_midd == 0) //auto dopocitavani vysky
    {
      if ($old_w <= $w_midd)
      {
        $new_w_mid = $old_w;  //zanechava
        $new_h_mid = $old_h;
      }
        else
      {
        $new_w_mid = $w_midd; //zmensuje
        $new_h_mid = round($old_h / ($old_w / $w_midd));
      }
    }
      else
    if ($w_midd == 0) //auto dopocitavani sirky
    {
      if ($old_w <= $h_midd)
      {
        $new_w_mid = $old_w;  //zanechava
        $new_h_mid = $old_h;
      }
        else
      {
        $new_w_mid = round($old_w / ($old_h / $h_midd)); //zmensuje
        $new_h_mid = $h_midd;
      }
    }
      else
    {
      $result = false;
    }

    //full obr
    if ($w_full == 0 && //pevna velikost
        $h_full == 0)
    {
      $new_w_obr = $old_w;  //zanechava
      $new_h_obr = $old_h;
    }
      else
    if ($w_full != 0 && //pevna velikost
        $h_full != 0)
    {
      if ($old_w <= $w_full &&
          $old_h <= $h_full)
      {
        $new_w_obr = $old_w;  //zanechava
        $new_h_obr = $old_h;
      }
        else
      {
        $new_w_obr = $w_full; //zmensuje
        $new_h_obr = $h_full;
      }
    }
      else
    if ($h_full == 0) //auto dopocitavani vysky
    {
      if ($old_w <= $w_full)
      {
        $new_w_obr = $old_w;  //zanechava
        $new_h_obr = $old_h;
      }
        else
      {
        $new_w_obr = $w_full; //zmensuje
        $new_h_obr = round($old_h / ($old_w / $w_full));
      }
    }
      else
    if ($w_full == 0) //auto dopocitavani sirky
    {
      if ($old_w <= $h_full)
      {
        $new_w_obr = $old_w;  //zanechava
        $new_h_obr = $old_h;
      }
        else
      {
        $new_w_obr = round($old_w / ($old_h / $h_full)); //zmensuje
        $new_h_obr = $h_full;
      }
    }
      else
    {
      $result = false;
    }

    if (($this->ValueConfig(4) != 0 ? $tmp["size"] < (1024 * 1024 * $this->ValueConfig(6)) : true) && //je-li nastaven limit omezuje jinak pousti
        $result)
    {
      $nazev = $this->VytvorJmenoObrazku();

      switch ($tmp["type"])
      {
        case "image/jpeg":
          $pripona = "jpg";
          ini_set("memory_limit", "100M");  //nasosne si vic mega
          $img_old = imagecreatefromjpeg($tmp["tmp_name"]);

          if (Empty($tmp2["tmp_name"]))
          {
            $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
            imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
            imagejpeg($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}.{$pripona}", 100);
            imagedestroy($img_new);
          }
            else
          {
            if (!move_uploaded_file($tmp2["tmp_name"], "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}.{$pripona}"))
            {
              $result = false;
            }
          }

          $img_new = imagecreatetruecolor($new_w_mid, $new_h_mid);  //midd
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w_mid, $new_h_mid, $old_w, $old_h);
          imagejpeg($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->midddir}/{$nazev}.{$pripona}", 100);
          imagedestroy($img_new);

          $img_new = imagecreatetruecolor($new_w_obr, $new_h_obr);  //full
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w_obr, $new_h_obr, $old_w, $old_h);
          imagejpeg($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$nazev}.{$pripona}", 100);
          imagedestroy($img_new);
        break;

        case "image/png":
          $pripona = "png";
          ini_set("memory_limit", "100M");  //nasosne si vic mega
          $img_old = imagecreatefrompng($tmp["tmp_name"]);

          if (Empty($tmp2["tmp_name"]))
          {
            $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
            imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
            imagepng($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}.{$pripona}");
            imagedestroy($img_new);
          }
            else
          {
            if (!move_uploaded_file($tmp2["tmp_name"], "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}.{$pripona}"))
            {
              $result = false;
            }
          }

          $img_new = imagecreatetruecolor($new_w_mid, $new_h_mid);  //midd
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w_mid, $new_h_mid, $old_w, $old_h);
          imagepng($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->midddir}/{$nazev}.{$pripona}", 100);
          imagedestroy($img_new);

          $img_new = imagecreatetruecolor($new_w_obr, $new_h_obr);  //full
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w_obr, $new_h_obr, $old_w, $old_h);
          imagepng($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$nazev}.{$pripona}");
          imagedestroy($img_new);
        break;

        default:
          $result = false;
        break;
      }

      $obrazek = "{$nazev}.{$pripona}";
    }
      else
    {
      $result = false;
    }

    return $result;
  }

/**
 *
 * Vygenerovani nazvu pro obrazky
 *
 * @return vygenerovany vzorek nazvu
 */
  private function VytvorJmenoObrazku()
  {
    $result = date("d-m-Y-H-i-s-").rand(0,100);

    return $result;
  }

/**
 *
 * Vypis administrace menu
 *
 * @return vypis menu v html
 */
  private function AdminVypisGallery()
  {
    $result = "";
    //vypis skupiny
    if ($res = @$this->sqlite->query("SELECT id, adresa, nahledy, nazev, rewrite, popis, datum, defaultni, poradi FROM skupina ORDER BY {$this->order_skup[$this->ValueConfig(7)]};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina"],
                                              $data->adresa,
                                              $data->nahledy,
                                              $data->nazev,
                                              $data->rewrite,
                                              $data->popis,
                                              date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"]), strtotime($data->datum)),
                                              ($data->defaultni ? " checked=\"checked\"" : ""),
                                              $data->poradi,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addpict&amp;skupina={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editgrup&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delgrup&amp;id={$data->id}");

          //vypis obrazku
          if ($res1 = @$this->sqlite->query("SELECT id,
                                            popisek,
                                            url,
                                            datum,
                                            zobrazeni,
                                            poradi
                                            FROM picture_gallery
                                            WHERE skupina={$data->id}
                                            ORDER BY {$this->order_pict[$this->ValueConfig(8)]};", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                                    $data1->popisek,
                                                    "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data1->url}",
                                                    "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data1->url}",
                                                    date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"]), strtotime($data1->datum)),
                                                    $data1->zobrazeni,
                                                    $data1->poradi,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editpict&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delpict&amp;id={$data1->id}");
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_end"]);
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }
}
?>
