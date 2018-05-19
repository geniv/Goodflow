<?php

/**
 *
 * Blok dynamicky generovaneho random obrazku
 *
 * public funkce:\n
 * construct: DynamicRandomGallery - hlavni konstruktor tridy\n
 * Obrazek() - hlavni vypis obsahu galerie\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicRandomGallery extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $unikatni;
  public $idmodul = "randdyngall";

  private $pathpicture = "picture";
  private $minidir = "mini";  //adresar miniatur
  private $fulldir = "full";  //adresar full obrazku
  private $conffile = ".config_file";

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

    $this->pathpicture = $this->NactiUnikatniObsah($this->unikatni["set_pathpicture"]);
    $this->minidir = $this->NactiUnikatniObsah($this->unikatni["set_minidir"]);
    $this->fulldir = $this->NactiUnikatniObsah($this->unikatni["set_fulldir"]);
    $this->conffile = $this->NactiUnikatniObsah($this->unikatni["set_conffile"]);

    $this->conffile = "{$this->dirpath}/{$this->conffile}";

    if (!file_exists($this->conffile))
    {
      echo "Nechte prosím automaticky v adminu vytvořit soubor: {$this->conffile}";
    }

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
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
      if (!@$this->sqlite->queryExec("CREATE TABLE random_gallery (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      popisek VARCHAR(300),
                                      url VARCHAR(200),
                                      datum DATETIME,
                                      w_mini INTEGER UNSIGNED,
                                      h_mini INTEGER UNSIGNED,
                                      w_full INTEGER UNSIGNED,
                                      h_full INTEGER UNSIGNED);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Vrati v poli vsechyna id v databazi
 *
 * @param adresa adresa obrazku
 * @return pole id z DB
 */
  private function NavratVsechId($adresa)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id FROM random_gallery WHERE adresa='{$adresa}';", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result[] = $data->id;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Navraceni samotne galerie podle sekce
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicRandomGallery", "Obrazek"[, "adresa", 1]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @param tvar cislo tvaru
 * @return vystupni galerie
 */
  public function Obrazek($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
    }

    $pole = $this->NavratVsechId($adresa);
    $rand_id = (!Empty($pole) ? $pole[array_rand($pole)] : 0);  //rand vraci indexy

    $result = "";
    //vypis galerie
    if ($res = @$this->sqlite->query("SELECT popisek, url FROM random_gallery WHERE adresa='{$adresa}' AND id={$rand_id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        while ($data = $res->fetchObject())
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_obsah_{$tvar}"],
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}",
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}",
                                              $data->popisek);
        }
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_null_{$tvar}"]);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
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
          $result = $this->AdministracePicGallery();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vrati pocet a vypis dostupnych adres
 *
 * @return vypis adres
 */
  private function SeznamAdres()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT adresa, count(adresa) pocet FROM random_gallery GROUP BY adresa ORDER BY adresa;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_adres"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add&amp;adresa={$data->adresa}",
                                              $data->adresa,
                                              $data->pocet);
        }
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_adres_null"]);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
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
 * @param limit limit uploadu
 */
  private function LoadConfig(&$w_mini, &$h_mini, &$w_full, &$h_full, &$limit)
  {
    if (file_exists($this->conffile))
    {
      $u = fopen($this->conffile, "r");
      $data = fread($u, filesize($this->conffile));
      fclose($u);

      $data = explode("-", $data);
      $w_mini = $data[0];
      $h_mini = $data[1];
      $w_full = $data[2];
      $h_full = $data[3];
      $limit = $data[4];  //3
    }
      else
    {
      $u = fopen($this->conffile, "w");
      fwrite($u, "0-135-0-400-3");
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

    $w_full = $_POST["w_full"];
    settype($w_full, "integer");

    $h_full = $_POST["h_full"];
    settype($h_full, "integer");

    $limit = $_POST["limit"];
    settype($limit, "integer");

    $u = fopen($this->conffile, "w");
    fwrite($u, "{$w_mini}-{$h_mini}-{$w_full}-{$h_full}-{$limit}");
    fclose($u);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_config_save"]);

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickeho menu
 *
 * @return adminstracni formular v html
 */
  private function AdministracePicGallery()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=config",
                                        $this->SeznamAdres(),
                                        $this->AdminVypisGallery());

    if (!file_exists("{$this->dirpath}/{$this->pathpicture}"))  //vytvoreni slozek na obrazky
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}"))
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}"))
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}", 0777);
    }

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "config":  //kofigurace galerie
          $this->LoadConfig($w_mini, $h_mini, $w_full, $h_full, $limit);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_config"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                              ($limit != 0 ? " checked=\"checked\"" : ""),
                                              $limit,
                                              ($limit == 0 ? " checked=\"checked\"" : ""),
                                              ($limit == 0 ? "lim_2();" : "lim_1();"),
                                              ($w_mini != 0 ? " checked=\"checked\"" : ""),
                                              $w_mini,
                                              ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                              $h_mini,
                                              ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? " checked=\"checked\"" : ""),
                                              ($w_full != 0 ? " checked=\"checked\"" : ""),
                                              $w_full,
                                              ($h_full != 0 ? " checked=\"checked\"" : ""),
                                              $h_full,
                                              ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? "mini_4();" : ($w_mini != 0 && $h_mini != 0 ? "mini_3();" : ($h_mini != 0 ? "mini_2();" : ($w_mini != 0 ? "mini_1();" : "")))),
                                              ($w_full == 0 && $h_full == 0 ? "full_4();" : ($w_full != 0 && $h_full != 0 ? "full_3();" : ($h_full != 0 ? "full_2();" : ($w_full != 0 ? "full_1();" : "")))));

          if (!Empty($_POST["tlacitko"]))
          {
            $result = $this->SaveConfig();

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "add": //pridavani obrazku
          $w_mini = $this->ValueConfig(0);
          $h_mini = $this->ValueConfig(1);
          $w_full = $this->ValueConfig(2);
          $h_full = $this->ValueConfig(3);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add"],
                                              $_GET["adresa"],
                                              date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"])),
                                              $w_mini,
                                              $h_mini,
                                              $w_full,
                                              $h_full,
                                              ($w_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? " checked=\"checked\"" : ""),
                                              ($w_full != 0 ? " checked=\"checked\"" : ""),
                                              ($h_full != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? "mini_4()" : ($w_mini != 0 && $h_mini != 0 ? "mini_3();" : ($h_mini != 0 ? "mini_2();" : ($w_mini != 0 ? "mini_1();" : "")))),
                                              ($w_full == 0 && $h_full == 0 ? "full_4();" : ($w_full != 0 && $h_full != 0 ? "full_3();" : ($h_full != 0 ? "full_2();" : ($w_full != 0 ? "full_1();" : "")))));

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
          $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
          $w_mini = $_POST["w_mini"];
          settype($w_mini, "integer");

          $h_mini = $_POST["h_mini"];
          settype($h_mini, "integer");

          $w_full = $_POST["w_full"];
          settype($w_full, "integer");

          $h_full = $_POST["h_full"];
          settype($h_full, "integer");

          $ob = false;
          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $ob = $this->ZpracujObrazek($_FILES["obrazek"], $url, $w_mini, $h_mini, $w_full, $h_full, $_FILES["mini_obrazek"]);
          }

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              //!Empty($popisek) &&
              !Empty($datum) &&
              $ob)
          {
            if (@$this->sqlite->queryExec("INSERT INTO random_gallery (id, adresa, popisek, url, datum, w_mini, h_mini, w_full, h_full) VALUES
                                          (NULL, '{$adresa}', '{$popisek}', '{$url}', '{$datum}', {$w_mini}, {$h_mini}, {$w_full}, {$h_full});", $error))
            {
              $navic = $this->SyncFileWithDB(); //synchronizace

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_hlaska"],
                                                  $popisek,
                                                  $navic);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "edit":  //editace obrazku
          $id = $_GET["id"];  //cislo obrazku
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, popisek, url, datum, w_mini, h_mini, w_full, h_full FROM random_gallery WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit"],
                                                  $data->adresa,
                                                  $data->popisek,
                                                  "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}",
                                                  "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}",
                                                  date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"]), strtotime(stripslashes($data->datum))),
                                                  $data->w_mini,
                                                  $data->h_mini,
                                                  $data->w_full,
                                                  $data->h_full,
                                                  ($data->w_mini != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->h_mini != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_mini != 0 && $data->h_mini != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_mini == 0 && $data->h_mini == 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_full != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->h_full != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_full != 0 && $data->h_full != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_full == 0 && $data->h_full == 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_mini == 0 && $data->h_mini == 0 ? "mini_4();" : ($data->w_mini != 0 && $data->h_mini != 0 ? "mini_3();" : ($data->h_mini != 0 ? "mini_2();" : ($data->w_mini != 0 ? "mini_1();" : "")))),
                                                  ($data->w_full == 0 && $data->h_full == 0 ? "full_4();" : ($data->w_full != 0 && $data->h_full != 0 ? "full_3();" : ($data->h_full != 0 ? "full_2();" : ($data->w_full != 0 ? "full_1();" : "")))));

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
              $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
              $w_mini = $_POST["w_mini"];
              settype($w_mini, "integer");

              $h_mini = $_POST["h_mini"];
              settype($h_mini, "integer");

              $w_full = $_POST["w_full"];
              settype($w_full, "integer");

              $h_full = $_POST["h_full"];
              settype($h_full, "integer");

              if (!Empty($_FILES["obrazek"]["tmp_name"]) &&
                  ($w_mini == 0 && $h_mini == 0 && Empty($_FILES["mini_obrazek"]["tmp_name"]) ? false : true))
              {
                $this->ZpracujObrazek($_FILES["obrazek"], $url, $w_mini, $h_mini, $w_full, $h_full, $_FILES["mini_obrazek"]);
              }
                else
              {
                $url = $data->url;
              }

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  //!Empty($popisek) &&
                  !Empty($datum) &&
                  $id != 0 &&
                  ($w_mini == 0 && $h_mini == 0 && Empty($_FILES["mini_obrazek"]["tmp_name"]) ? false : true))
              {
                if (@$this->sqlite->queryExec("UPDATE random_gallery SET adresa='{$adresa}',
                                                                  popisek='{$popisek}',
                                                                  url='{$url}',
                                                                  datum='{$datum}',
                                                                  w_mini={$w_mini},
                                                                  h_mini={$h_mini},
                                                                  w_full={$w_full},
                                                                  h_full={$h_full}
                                                                  WHERE id={$id};", $error))
                {
                  $navic = $this->SyncFileWithDB(); //synchronizace

                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_hlaska"],
                                                      $popisek,
                                                      $navic);
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error);
                }

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;

        case "del": //mazani obrazku
          $id = $_GET["id"];  //cislo obrazku
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT popisek, url FROM random_gallery WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM random_gallery WHERE id={$id};", $error)) //provedeni dotazu
              {
                $navic = $this->SyncFileWithDB(); //synchronizace

                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_hlaska"],
                                                    $data->popisek,
                                                    $navic);
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error);
              }

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
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
    if ($res = @$this->sqlite->query("SELECT url FROM random_gallery;", NULL, $error))
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
      $this->var->main[0]->ErrorMsg($error);
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

    $result = $pocet1 + $pocet2;

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
  private function ZpracujObrazek($tmp, &$obrazek, $w_mini, $h_mini, $w_full, $h_full, $tmp2 = null)
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

    if (($this->ValueConfig(4) != 0 ? $tmp["size"] < (1024 * 1024 * $this->ValueConfig(4)) : true) && //je-li nastaven limit omezuje jinak pousti
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
    $result = date("d-m-Y-H-i-s");

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
    //vypis obrazku
    if ($res = @$this->sqlite->query("SELECT id,
                                      adresa,
                                      popisek,
                                      url,
                                      datum
                                      FROM random_gallery
                                      ORDER BY LOWER(adresa) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $datum = date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"]), strtotime($data->datum));

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                              $data->id,
                                              $datum,
                                              $data->adresa,
                                              $data->popisek,
                                              "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}",
                                              "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}");
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }
}
?>
