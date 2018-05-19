<?php

/**
 *
 * Blok dynamicky generovanych tabulek
 *
 * public funkce:\n
 * construct: DynamicDrinks - hlavni konstruktor tridy\n
 * Drinks() - vypis obsahu galerie podle adresy\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicDrinks extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $absolutni_url, $unikatni;
  public $idmodul = "dyndri";

  private $pathpicture = "obrazky";

  private $min_col = 1; //min sloupcu
  private $max_col = 0; //max sloupcu, 0 - nekonecno

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

    $this->min_col = $this->NactiUnikatniObsah($this->unikatni["set_min_col"]);
    $this->max_col = $this->NactiUnikatniObsah($this->unikatni["set_max_col"]);
    $this->pathpicture = $this->NactiUnikatniObsah($this->unikatni["set_pathpicture"]);

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
      if (!@$this->sqlite->queryExec("CREATE TABLE sekce (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      nadpis VARCHAR(200),
                                      nadpis_url VARCHAR(200),
                                      w_mini INTEGER UNSIGNED,
                                      h_mini INTEGER UNSIGNED,
                                      sloupce TEXT,
                                      defaultni TEXT,
                                      poznamka VARCHAR(300),
                                      sekce_id VARCHAR(200),
                                      sekce_class VARCHAR(200),
                                      sekce_akce VARCHAR(500),
                                      poradi INTEGER UNSIGNED);

                                      CREATE TABLE polozka (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      sekce INTEGER UNSIGNED,
                                      radek TEXT,
                                      poradi INTEGER UNSIGNED,
                                      polozka_id VARCHAR(200),
                                      polozka_class VARCHAR(200),
                                      polozka_akce VARCHAR(200));
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
  }

/**
 *
 * Navraceni samotne tabulky podle sekce
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicDrinks", "Drinks"[, "adresa"]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return vystupni galerie
 */
  public function Drinks($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
    }

    $prvni_sekce = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_prvni_{$tvar}"]);
    $posledni_sekce = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_posledni_{$tvar}"]);
    $ente_def_array_sekce = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_ente_def_array_{$tvar}"]);
    $ente_def_sekce = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_ente_def_{$tvar}"]);
    $ente_od_sekce = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_ente_od_{$tvar}"]);
    $ente_po_sekce = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_ente_po_{$tvar}"]);
    $ente_sekce = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_sekce_ente_{$tvar}"]);

/*
    $prvni_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_prvni_{$tvar}"]);
    $posledni_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_posledni_{$tvar}"]);
    $ente_def_array_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_def_array_{$tvar}"]);
    $ente_def_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_def_{$tvar}"]);
    $ente_od_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_od_{$tvar}"]);
    $ente_po_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_po_{$tvar}"]);
    $ente_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_{$tvar}"]);
*/

    $prvni_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_prvni_{$tvar}"]);
    $posledni_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_posledni_{$tvar}"]);
    $ente_def_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_def_{$tvar}"]);
    $ente_def_array_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_def_array_{$tvar}"]);
    $ente_od_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_od_{$tvar}"]);
    $ente_po_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_po_{$tvar}"]);

    $result = "";
    if ($res = @$this->sqlite->query("SELECT
                                      id,
                                      nadpis,
                                      nadpis_url,
                                      sloupce,
                                      poznamka,
                                      sekce_id,
                                      sekce_class,
                                      sekce_akce
                                      FROM sekce
                                      WHERE adresa='{$adresa}'
                                      ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $id = (!Empty($data->sekce_id) ? " id=\"{$data->sekce_id}\"" : "");
          $class = (!Empty($data->sekce_class) ? " class=\"{$data->sekce_class}\"" : "");
          $akce = (!Empty($data->sekce_akce) ? " {$data->sekce_akce}" : "");

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_begin_{$tvar}"],
                                              $data->nadpis,
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$data->nadpis_url}",
                                              $id,
                                              $class,
                                              $akce,
                                              ($i == 0 ? $prvni_sekce : ""),
                                              ($i == ($res->numRows() - 1) ? $posledni_sekce : ""),
                                              (in_array($i, $ente_def_array_sekce) ? $ente_def_sekce : ""),
                                              ((($i + $ente_od_sekce) % $ente_po_sekce) == 0 ? $ente_sekce : ""),
                                              $i);

          //generovani bunek
          if ($res1 = @$this->sqlite->query("SELECT
                                            radek,
                                            poradi,
                                            polozka_id,
                                            polozka_class,
                                            polozka_akce
                                            FROM polozka
                                            WHERE sekce={$data->id}
                                            ORDER BY poradi ASC, id ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              $j = 0;
              while ($data1 = $res1->fetchObject())
              {
                $id = (!Empty($data1->polozka_id) ? " id=\"{$data1->polozka_id}\"" : "");
                $class = (!Empty($data1->polozka_class) ? " class=\"{$data1->polozka_class}\"" : "");
                $akce = (!Empty($data1->polozka_akce) ? " {$data1->polozka_akce}" : "");

                $ente_polozka = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_polozka_ente_{$tvar}"],
                                                          ($j == 0 ? $prvni_polozka : ""),
                                                          ($j == ($res1->numRows() - 1) ? $posledni_polozka : ""));

                $radek = "";
                $rad = explode("|--|", $data1->radek);
                for ($k = 0; $k < count($rad); $k++)
                {
                  $radek .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_row_bunka_{$tvar}"],
                                                      (!Empty($rad[$k]) ? $rad[$k] : $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_row_bunka_empty_{$tvar}"])),
                                                      ($i == 0 ? $prvni_sekce : ""),
                                                      ($i == ($res->numRows() - 1) ? $posledni_sekce : ""),
                                                      (in_array($i, $ente_def_array_sekce) ? $ente_def_sekce : ""),
                                                      ((($i + $ente_od_sekce) % $ente_po_sekce) == 0 ? $ente_sekce : ""),
                                                      ($j == 0 ? $prvni_polozka : ""),
                                                      ($j == ($res1->numRows() - 1) ? $posledni_polozka : ""),
                                                      (in_array($j, $ente_def_array_polozka) ? $ente_def_polozka : ""),
                                                      ((($j + $ente_od_polozka) % $ente_po_polozka) == 0 ? $ente_polozka : ""),
                                                      ($k == 0 ? $prvni_polozka : ""),
                                                      ($k == ($res1->numRows() - 1) ? $posledni_polozka : ""),
                                                      (in_array($k, $ente_def_array_polozka) ? $ente_def_polozka : ""),
                                                      ((($k + $ente_od_polozka) % $ente_po_polozka) == 0 ? $ente_polozka : ""),
                                                      $i, $j, $k);
                }

                //tridy pro kazdy radek TR
                $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_row_{$tvar}"],
                                                    $id,
                                                    $class,
                                                    $akce,
                                                    $radek,
                                                    ($i == 0 ? $prvni_sekce : ""),
                                                    ($i == ($res->numRows() - 1) ? $posledni_sekce : ""),
                                                    (in_array($i, $ente_def_array_sekce) ? $ente_def_sekce : ""),
                                                    ((($i + $ente_od_sekce) % $ente_po_sekce) == 0 ? $ente_sekce : ""),
                                                    ($j == 0 ? $prvni_polozka : ""),
                                                    ($j == ($res1->numRows() - 1) ? $posledni_polozka : ""),
                                                    (in_array($j, $ente_def_array_polozka) ? $ente_def_polozka : ""),
                                                    ((($j + $ente_od_polozka) % $ente_po_polozka) == 0 ? $ente_polozka : ""),
                                                    $i, $j);
                $j++;
              }
            }
              else
            {
              $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_null_{$tvar}"]);
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_end_{$tvar}"], $data->poznamka);
          $i++;
        }
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_empty_{$tvar}"]);
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
 * Vrati select pro vyber z tabulek
 *
 * @param id id polozky menu, nepovinne
 * @return html select
 */
  private function VyberTabulky($id = NULL)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa FROM sekce ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tabulky_begin"]);

        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tabulky"],
                                              $data->id,
                                              (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->adresa);
          ;
        }
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tabulky_end"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tabulky_null"]);
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
 * Vrati pocet bunek dane sekce
 *
 * @param hlavicka cislo hlavicky
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetSekci($inc = 0)
  {
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) as pocet FROM sekce;", NULL, $error))
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
 * Vrati pocet bunek dane sekce
 *
 * @param hlavicka cislo hlavicky
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($sekce, $inc = 0)
  {
    settype($sekce, "integer");
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) as pocet FROM polozka WHERE sekce={$sekce};", NULL, $error))
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
 * Zpracovani obrazku
 *
 * @param tmp temp name obrazku
 * @param obrazek nazev obrazku vracena pres parametr
 * @param w_mini sirka obrazku
 * @param h_mini vyska obrazku
 * @return nazev obrazku
 */
  private function ZpracujObrazek($tmp, &$obrazek, $w_mini, $h_mini)
  {
    list($old_w, $old_h) = getimagesize($tmp["tmp_name"]);
    $result = true;

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
    if ($h_mini == 0 && //auto dopocitavani vysky
        $w_mini != 0)
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
    if ($w_mini == 0 && //auto dopocitavani sirky
        $h_mini != 0)
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
    if ($w_mini == 0 &&
        $h_mini == 0)
    {
      $new_w = $old_w;  //zanechava
      $new_h = $old_h;
    }
      else
    {
      $result = false;
    }

    if ($result)
    {
      $nazev = $this->VytvorJmenoObrazku();

      switch ($tmp["type"])
      {
        case "image/jpeg":
          $pripona = "jpg";
          //ini_set("memory_limit", "100M");  //nasosne si vic mega
          $img_old = imagecreatefromjpeg($tmp["tmp_name"]);

          $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
          imagejpeg($img_new, "{$this->dirpath}/{$this->pathpicture}/{$nazev}.{$pripona}", 100);
          imagedestroy($img_new);
        break;

        case "image/png":
          $pripona = "png";
          //ini_set("memory_limit", "100M");  //nasosne si vic mega
          $img_old = imagecreatefrompng($tmp["tmp_name"]);

          $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
          imagepng($img_new, "{$this->dirpath}/{$this->pathpicture}/{$nazev}.{$pripona}");
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
 * Kontroluje rozdily mezi databazi a filesystemem
 *
 */
  private function SyncFileWithDB()
  {
    if ($res = @$this->sqlite->query("SELECT nadpis_url FROM sekce;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $databaze = "";
        while ($data = $res->fetchObject())
        {
          $databaze[] = $data->nadpis_url;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->pathpicture}";  //projiti obrazku
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
        chmod("{$this->dirpath}/{$this->pathpicture}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathpicture}/{$diff[$i]}");
      }
    }

    $result = $pocet1;

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickych tabulek
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab&amp;col={$this->min_col}",
                                        $this->AdminVypisTable());

    if (!file_exists("{$this->dirpath}/{$this->pathpicture}"))  //vytvoreni slozek na obrazky
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}", 0777);
    }

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addtab":
          $col = $_GET["col"];  //cislo sekce
          settype($col, "integer");

          $col = ($col <= 0 || $col < $this->min_col || ($this->max_col > 0 ? $col > $this->max_col : false) ? $this->min_col : $col);  //osetreni spatnych vstupu

          $plus = ($this->max_col > 0 ? (($col + 1) <= $this->max_col ? $col + 1 : $col) : $col + 1);
          $mimus = (($col - 1) < $this->min_col ? $this->min_col : $col - 1); //osetreni zapornych cisel

          $sloupce = "";
          for ($i = 0; $i < $col; $i++)
          {
            $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addtab_input_sloupce"], $i + 1);
            $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addtab_input_defaultni"], $i + 1);
          }

          //$sloupce = str_repeat($this->NactiUnikatniObsah($this->unikatni["admin_addtab_input_sloupce"]), $col);
          //$defaultni = str_repeat($this->NactiUnikatniObsah($this->unikatni["admin_addtab_input_defaultni"]), $col);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addtab"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab&amp;col={$plus}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab&amp;col={$mimus}",
                                              $sloupce,
                                              "",//$defaultni,
                                              $this->PocetSekci(1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                              $col);

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $nadpis = stripslashes(htmlspecialchars($_POST["nadpis"], ENT_QUOTES));
          $w_mini = $_POST["w_mini"];
          settype($w_mini, "integer");
          $h_mini = $_POST["h_mini"];
          settype($h_mini, "integer");

          $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"], ENT_QUOTES));
          $sekce_id = stripslashes(htmlspecialchars($_POST["sekce_id"], ENT_QUOTES));
          $sekce_class = stripslashes(htmlspecialchars($_POST["sekce_class"], ENT_QUOTES));
          $sekce_akce = stripslashes(htmlspecialchars($_POST["sekce_akce"], ENT_QUOTES));
          $poradi = $_POST["poradi"];
          settype($poradi, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              count($_POST) > 0 &&
              $poradi > 0)
          {
            $sloupce = stripslashes(htmlspecialchars(implode("|--|", $_POST["sloupce"]), ENT_QUOTES));
            $defaultni = stripslashes(htmlspecialchars(implode("|--|", $_POST["defaultni"]), ENT_QUOTES));

            $url = "";
            $tmp = $_FILES["obr_nadpis"];
            if (!Empty($tmp["tmp_name"]))
            {
              $this->ZpracujObrazek($tmp, $url, $w_mini, $h_mini);
            }

            if (@$this->sqlite->queryExec("INSERT INTO sekce (id, adresa, nadpis, nadpis_url, w_mini, h_mini, sloupce, defaultni, poznamka, sekce_id, sekce_class, sekce_akce, poradi) VALUES
                                          (NULL, '{$adresa}', '{$nadpis}', '{$url}', {$w_mini}, {$h_mini}, '{$sloupce}', '{$defaultni}', '{$poznamka}', '{$sekce_id}', '{$sekce_class}', '{$sekce_akce}', {$poradi});", $error))
            {
              $navic = $this->SyncFileWithDB();
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addtab_hlaska"], $adresa, $navic);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "edittab":
          $col = $_GET["col"];  //cislo sekce
          settype($col, "integer");

          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, nadpis, nadpis_url, w_mini, h_mini, sloupce, defaultni, poznamka, sekce_id, sekce_class, sekce_akce, poradi FROM sekce WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $col = ($col <= 0 || $col < $this->min_col || ($this->max_col > 0 ? $col > $this->max_col : false) ? $this->min_col : $col);  //osetreni spatnych vstupu

              $plus = ($this->max_col > 0 ? (($col + 1) <= $this->max_col ? $col + 1 : $col) : $col + 1);
              $mimus = (($col - 1) < $this->min_col ? $this->min_col : $col - 1); //osetreni zapornych cisel

              $sloupce = "";
              $sloup = explode("|--|", $data->sloupce);
              $def = explode("|--|", $data->defaultni);
              $rozdil = $col - count($sloup);
              for ($i = 0; $i < count($sloup) + $rozdil; $i++)
              {
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_edittab_input_sloupce"], $sloup[$i], $i + 1);
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_edittab_input_defaultni"], $def[$i], $i + 1);
              }

/*
              $defaultni = "";
              $def = explode("|--|", $data->defaultni);
              for ($i = 0; $i < count($def) + $rozdil; $i++)
              {
                $defaultni .= $this->NactiUnikatniObsah($this->unikatni["admin_edittab_input_defaultni"], $def[$i]);
              }
*/

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edittab"],
                                                  $data->adresa,
                                                  $data->nadpis,
                                                  "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$data->nadpis_url}",
                                                  $data->w_mini,
                                                  $data->h_mini,
                                                  ($data->w_mini != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->h_mini != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_mini != 0 && $data->h_mini != 0 ? " checked=\"checked\"" : ""),
                                                  ($data->w_mini == 0 && $data->h_mini == 0 ? " checked=\"checked\"" : ""),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;col={$plus}&amp;id={$id}",
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;col={$mimus}&amp;id={$id}",
                                                  $sloupce,
                                                  "",//$defaultni,
                                                  $data->poznamka,
                                                  $data->sekce_id,
                                                  $data->sekce_class,
                                                  $data->sekce_akce,
                                                  $data->poradi,
                                                  ($data->w_mini == 0 && $data->h_mini == 0 ? "mini_4()" : ($data->w_mini != 0 && $data->h_mini != 0 ? "mini_3();" : ($data->h_mini != 0 ? "mini_2();" : ($data->w_mini != 0 ? "mini_1();" : "")))),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  $col);


              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $nadpis = stripslashes(htmlspecialchars($_POST["nadpis"], ENT_QUOTES));
              $w_mini = $_POST["w_mini"];
              settype($w_mini, "integer");
              $h_mini = $_POST["h_mini"];
              settype($h_mini, "integer");

              $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"], ENT_QUOTES));
              $sekce_id = stripslashes(htmlspecialchars($_POST["sekce_id"], ENT_QUOTES));
              $sekce_class = stripslashes(htmlspecialchars($_POST["sekce_class"], ENT_QUOTES));
              $sekce_akce = stripslashes(htmlspecialchars($_POST["sekce_akce"], ENT_QUOTES));
              $poradi = $_POST["poradi"];
              settype($poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  count($_POST) > 0 &&
                  $id != 0 &&
                  $poradi > 0)
              {
                $sloupce = stripslashes(htmlspecialchars(implode("|--|", $_POST["sloupce"]), ENT_QUOTES));
                $defaultni = stripslashes(htmlspecialchars(implode("|--|", $_POST["defaultni"]), ENT_QUOTES));

                $url = "";
                $tmp = $_FILES["obr_nadpis"];
                if (!Empty($tmp["tmp_name"]))
                {
                  $this->ZpracujObrazek($tmp, $url, $w_mini, $h_mini);
                }
                  else
                {
                  $url = $data->nadpis_url;
                }

                if (@$this->sqlite->queryExec("UPDATE sekce SET adresa='{$adresa}',
                                                                nadpis='{$nadpis}',
                                                                nadpis_url='{$url}',
                                                                w_mini={$w_mini},
                                                                h_mini={$h_mini},
                                                                sloupce='{$sloupce}',
                                                                defaultni='{$defaultni}',
                                                                poznamka='{$poznamka}',
                                                                sekce_id='{$sekce_id}',
                                                                sekce_class='{$sekce_class}',
                                                                sekce_akce='{$sekce_akce}',
                                                                poradi={$poradi}
                                                                WHERE id={$id};", $error))
                {
                  $navic = $this->SyncFileWithDB();
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edittab_hlaska"], $adresa, $navic);

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

        case "deltab":
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa FROM sekce WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM sekce WHERE id={$id};
                                            DELETE FROM polozka WHERE sekce={$id};", $error)) //provedeni dotazu
              {
                $navic = $this->SyncFileWithDB();
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_deltab_hlaska"], $data->adresa, $navic);

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


        case "addrow":
          $tab = $_GET["tab"];  //cislo sekce
          settype($tab, "integer");

          if ($res = @$this->sqlite->query("SELECT sloupce, defaultni FROM sekce WHERE id={$tab};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              //$sloupce = $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table_begin"]);
              $sloup = explode("|--|", $data->sloupce);
              $def = explode("|--|", $data->defaultni);
              for ($i = 0; $i < count($sloup); $i++)
              {
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table_header"], $sloup[$i], $i + 1);
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table"], $def[$i], $i + 1);
              }

/*
              $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table_newrow"]);
              $def = explode("|--|", $data->defaultni);
              for ($i = 0; $i < count($def); $i++)
              {
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table"], $def[$i]);
              }
              $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table_end"]);
*/

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addrow"],
                                                  $this->VyberTabulky($tab),
                                                  $sloupce,
                                                  $this->PocetRadku($tab, 1),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          if (!Empty($_POST["tlacitko"]) &&
              count($_POST) > 0)
          {
            $sekce = $_POST["sekce"];
            settype($sekce, "integer");
            $radek = stripslashes(htmlspecialchars(implode("|--|", $_POST["radek"]), ENT_QUOTES));
            $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
            settype($poradi, "integer");
            $polozka_id = stripslashes(htmlspecialchars($_POST["polozka_id"], ENT_QUOTES));
            $polozka_class = stripslashes(htmlspecialchars($_POST["polozka_class"], ENT_QUOTES));
            $polozka_akce = stripslashes(htmlspecialchars($_POST["polozka_akce"], ENT_QUOTES));

            if (@$this->sqlite->queryExec("INSERT INTO polozka (id, sekce, radek, poradi, polozka_id, polozka_class, polozka_akce) VALUES
                                          (NULL, {$sekce}, '{$radek}', {$poradi}, '{$polozka_id}', '{$polozka_class}', '{$polozka_akce}');", $error))
            {
              $rozdel = explode("|--|", $radek);
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addrow_hlaska"], $rozdel[0]);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editrow":
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT sekce, radek, poradi, polozka_id, polozka_class, polozka_akce FROM polozka WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
              $rad = explode("|--|", $data->radek);

              //generovan popisku
              if ($res1 = @$this->sqlite->query("SELECT sloupce FROM sekce WHERE id={$data->sekce};", NULL, $error))
              {
                if ($res1->numRows() == 1)
                {
                  $data1 = $res1->fetchObject();

                  //$sloupce = $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table_begin"]);
                  $sloupce = "";
                  $sloup = explode("|--|", $data1->sloupce);
                  for ($i = 0; $i < count($sloup); $i++)
                  {
                    $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table_header"], $sloup[$i], $i + 1);
                    $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table"], $rad[$i], $i + 1);
                  }
                }
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }

/*
              //generovani obsahu
              $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table_newrow"]);

              for ($i = 0; $i < count($sloup); $i++)  //napocet musi vzit pocet sloupcu!!!
              {
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table"], $rad[$i]);
              }
              $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table_end"]);
*/

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editrow"],
                                                  $this->VyberTabulky($data->sekce),
                                                  $sloupce,
                                                  $data->poradi,
                                                  $data->polozka_id,
                                                  $data->polozka_class,
                                                  $data->polozka_akce,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          if (!Empty($_POST["tlacitko"]) &&
              count($_POST) > 0 &&
              $id != 0)
          {
            $sekce = $_POST["sekce"];
            settype($sekce, "integer");
            $radek = stripslashes(htmlspecialchars(implode("|--|", $_POST["radek"]), ENT_QUOTES));
            $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
            settype($poradi, "integer");
            $polozka_id = stripslashes(htmlspecialchars($_POST["polozka_id"], ENT_QUOTES));
            $polozka_class = stripslashes(htmlspecialchars($_POST["polozka_class"], ENT_QUOTES));
            $polozka_akce = stripslashes(htmlspecialchars($_POST["polozka_akce"], ENT_QUOTES));

            if (@$this->sqlite->queryExec("UPDATE polozka SET sekce={$sekce},
                                                              radek='{$radek}',
                                                              poradi={$poradi},
                                                              polozka_id='{$polozka_id}',
                                                              polozka_class='{$polozka_class}',
                                                              polozka_akce='{$polozka_akce}'
                                                              WHERE id={$id};", $error))
            {
              $rozdel = explode("|--|", $radek);
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editrow_hlaska"], $rozdel[0]);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "delrow":
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT radek, poradi FROM polozka WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM polozka WHERE id={$id};", $error)) //provedeni dotazu
              {
                $rozdel = explode("|--|", $data->radek);
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delrow_hlaska"], $rozdel[0], $data->poradi);

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
      }
    }

    return $result;
  }

/**
 *
 * Vypis administrace tabulek
 *
 * @return vypis menu v html
 */
  private function AdminVypisTable()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id,
                                      adresa,
                                      nadpis,
                                      nadpis_url,
                                      sloupce,
                                      defaultni,
                                      poznamka,
                                      poradi
                                      FROM sekce
                                      ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $sloupce = explode("|--|", $data->sloupce);
          $col = count($sloupce);

          $rows = "";
          if ($res1 = @$this->sqlite->query("SELECT id,
                                            radek,
                                            poradi
                                            FROM polozka
                                            WHERE sekce={$data->id}
                                            ORDER BY poradi ASC, id ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $radky = explode("|--|", $data1->radek);

                $obsah = array ("array_args",
                                $data1->id,
                                $radky[0],
                                $data1->poradi,
                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editrow&amp;id={$data1->id}",
                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delrow&amp;id={$data1->id}");

                $radky = array_merge($obsah, $radky); //slouceni pole obsahu a pole radku

                $rows .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_bunka"],
                                                    $radky);
              }
            }
              else
            {
              $rows = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_bunka_null"]);
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $vypis = array ("array_args",
                          $data->id,
                          $data->adresa,
                          $data->nadpis,
                          "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$data->nadpis_url}",
                          $data->poznamka,
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addrow&amp;tab={$data->id}",
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;col={$col}&amp;id={$data->id}",
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deltab&amp;id={$data->id}",
                          $rows); //vlozeni radku do hlavicky

          $vypis = array_merge($vypis, $sloupce); //slouceni pole vypisu a pole sloupcu

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_hlavicka"],
                                              $vypis);
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
