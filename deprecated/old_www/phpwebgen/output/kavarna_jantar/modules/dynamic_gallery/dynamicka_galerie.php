<?php

/**
 *
 * Blok dynamicky generovane obrazkove galerie podle sekce
 *
 * public funkce:\n
 * construct: DynamicGallery - hlavni konstruktor tridy\n
 * Gallery() - hlavni vypis obsahu galerie\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicGallery extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $unikatni;
  private $idmodul = "dyngall";

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
    //$this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

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
      if (!@$this->sqlite->queryExec("CREATE TABLE gallery (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      popisek VARCHAR(300),
                                      url VARCHAR(200),
                                      datum DATETIME,
                                      poradi INTEGER UNSIGNED);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Navraceni samotne galerie podle sekce
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicGallery", "Gallery"[, "adresa"]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @param tvar tvar vypisu
 * @return vystupni galerie
 */
  public function Gallery($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
    }

    switch ($this->ValueConfig(5))
    {
      case 1:
        $order = "gallery.datum ASC";
      break;

      case 2:
        $order = "gallery.datum DESC";
      break;

      case 3:
        $order = "poradi ASC";
      break;

      case 4:
        $order = "poradi DESC";
      break;

      default:
        $order = "gallery.datum ASC";
      break;
    }

    $result = "";
    //vypis galerie
    if ($res = @$this->sqlite->query("SELECT popisek, url FROM gallery WHERE adresa='{$adresa}' ORDER BY {$order};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_obsah_{$tvar}"],
                                              "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}",
                                              "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}",
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
 * @param w_mini sirka mini
 * @param h_mini vyska mini
 * @param w_full sirka full
 * @param h_full vyska full
 * @param limit limit uploadu
 * @param razeni smer razeni
 */
  private function LoadConfig(&$w_mini, &$h_mini, &$w_full, &$h_full, &$limit, &$razeni)
  {
    if (file_exists($this->conffile))
    {
      $u = fopen($this->conffile, "r");
      $data = fread($u, filesize($this->conffile));
      fclose($u);

      $data = explode("-", $data);
      $w_mini = $data[0]; //0
      $h_mini = $data[1]; //135
      $w_full = $data[2]; //0
      $h_full = $data[3]; //400
      $limit = $data[4];  //3
      $razeni = $data[5]; //1
    }
      else
    {
      $u = fopen($this->conffile, "w");
      fwrite($u, "0-135-0-400-3-1");
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

    $razeni = $_POST["razeni"];
    settype($razeni, "integer");

    $u = fopen($this->conffile, "w");
    fwrite($u, "{$w_mini}-{$h_mini}-{$w_full}-{$h_full}-{$limit}-{$razeni}");
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
                                        $this->AdminVypisGallery());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "config":  //kofigurace galerie
          $this->LoadConfig($w_mini, $h_mini, $w_full, $h_full, $limit, $razeni);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_config"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                              ($w_mini != 0 ? " checked=\"checked\"" : ""),
                                              $w_mini,
                                              ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                              $h_mini,
                                              ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full != 0 ? " checked=\"checked\"" : ""),
                                              $w_full,
                                              ($h_full != 0 ? " checked=\"checked\"" : ""),
                                              $h_full,
                                              ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                              ($limit != 0 ? " checked=\"checked\"" : ""),
                                              $limit,
                                              ($limit == 0 ? " checked=\"checked\"" : ""),
                                              ($razeni == 1 ? " checked=\"checked\"" : ""),
                                              ($razeni == 2 ? " checked=\"checked\"" : ""),
                                              ($razeni == 3 ? " checked=\"checked\"" : ""),
                                              ($razeni == 4 ? " checked=\"checked\"" : ""),
                                              ($w_mini != 0 && $h_mini != 0 ? "mini_3();" : ($h_mini != 0 ? "mini_2();" : ($w_mini != 0 ? "mini_1();" : ""))),
                                              ($w_full == 0 && $h_full == 0 ? "full_4();" : ($w_full != 0 && $h_full != 0 ? "full_3();" : ($h_full != 0 ? "full_2();" : ($w_full != 0 ? "full_1();" : "")))),
                                              ($limit == 0 ? "lim_2();" : "lim_1();"));

          if (!Empty($_POST["tlacitko"]))
          {
            $result = $this->SaveConfig();

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "add": //pridavani obrazku
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add"],
                                              date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"])),
                                              ($this->ValueConfig(5) > 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_input_poradi"], 0) : ""));

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
          $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
          $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
          settype($poradi, "integer");

          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $ob = $this->ZpracujObrazek($_FILES["obrazek"], $url);
          }

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($popisek) &&
              !Empty($datum) &&
              $ob)
          {
            if (@$this->sqlite->queryExec("INSERT INTO gallery (id, adresa, popisek, url, datum, poradi) VALUES
                                          (NULL, '{$adresa}', '{$popisek}', '{$url}', '{$datum}', {$poradi});", $error))
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

        case "edit":  //editace skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, popisek, url, datum, poradi FROM gallery WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit"],
                                                  $data->adresa,
                                                  $data->popisek,
                                                  "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}",
                                                  date($this->NactiUnikatniObsah($this->unikatni["admin_datum_tvar"]), strtotime(stripslashes($data->datum))),
                                                  ($this->ValueConfig(5) > 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_input_poradi"], $data->poradi) : ""));

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
              $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
              $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
              settype($poradi, "integer");

              if (!Empty($_FILES["obrazek"]["tmp_name"]))
              {
                $this->ZpracujObrazek($_FILES["obrazek"], $url);
              }
                else
              {
                $url = $data->url;
              }

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($popisek) &&
                  !Empty($datum) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE gallery SET adresa='{$adresa}',
                                                                  popisek='{$popisek}',
                                                                  url='{$url}',
                                                                  datum='{$datum}',
                                                                  poradi={$poradi}
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

        case "del": //mazani skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT popisek, url FROM gallery WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM gallery WHERE id={$id};", $error)) //provedeni dotazu
              {
                chmod("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}", 0777);
                unlink("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}");  //odmazani fotek
                chmod("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}", 0777);
                unlink("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}");

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
    if ($res = @$this->sqlite->query("SELECT url FROM gallery;", NULL, $error))
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
 * @return true/false - poledlo se / nepovedlo se
 */
  private function ZpracujObrazek($tmp, &$obrazek)
  {
    list($old_w, $old_h) = getimagesize($tmp["tmp_name"]);
    $result = true;

    //mini obr
    if ($this->ValueConfig(0) != 0 && //pevna velikost
        $this->ValueConfig(1) != 0)
    {
      if ($old_w <= $this->ValueConfig(0) &&
          $old_h <= $this->ValueConfig(1))
      {
        $new_w = $old_w;  //zanechava
        $new_h = $old_h;
      }
        else
      {
        $new_w = $this->ValueConfig(0); //zmensuje
        $new_h = $this->ValueConfig(1);
      }
    }
      else
    if ($this->ValueConfig(1) == 0) //auto dopocitavani vysky
    {
      if ($old_w <= $this->ValueConfig(0))
      {
        $new_w = $old_w;  //zanechava
        $new_h = $old_h;
      }
        else
      {
        $new_w = $this->ValueConfig(0); //zmensuje
        $new_h = round($old_h / ($old_w / $this->ValueConfig(0)));
      }
    }
      else
    if ($this->ValueConfig(0) == 0) //auto dopocitavani sirky
    {
      if ($old_w <= $this->ValueConfig(1))
      {
        $new_w = $old_w;  //zanechava
        $new_h = $old_h;
      }
        else
      {
        $new_w = round($old_w / ($old_h / $this->ValueConfig(1))); //zmensuje
        $new_h = $this->ValueConfig(1);
      }
    }
      else
    {
      $result = false;
    }

    //full obr
    if ($this->ValueConfig(2) == 0 && //pevna velikost
        $this->ValueConfig(3) == 0)
    {
      $new_w_obr = $old_w;  //zanechava
      $new_h_obr = $old_h;
    }
      else
    if ($this->ValueConfig(2) != 0 && //pevna velikost
        $this->ValueConfig(3) != 0)
    {
      if ($old_w <= $this->ValueConfig(2) &&
          $old_h <= $this->ValueConfig(3))
      {
        $new_w_obr = $old_w;  //zanechava
        $new_h_obr = $old_h;
      }
        else
      {
        $new_w_obr = $this->ValueConfig(2); //zmensuje
        $new_h_obr = $this->ValueConfig(3);
      }
    }
      else
    if ($this->ValueConfig(3) == 0) //auto dopocitavani vysky
    {
      if ($old_w <= $this->ValueConfig(2))
      {
        $new_w_obr = $old_w;  //zanechava
        $new_h_obr = $old_h;
      }
        else
      {
        $new_w_obr = $this->ValueConfig(2); //zmensuje
        $new_h_obr = round($old_h / ($old_w / $this->ValueConfig(2)));
      }
    }
      else
    if ($this->ValueConfig(2) == 0) //auto dopocitavani sirky
    {
      if ($old_w <= $this->ValueConfig(3))
      {
        $new_w_obr = $old_w;  //zanechava
        $new_h_obr = $old_h;
      }
        else
      {
        $new_w_obr = round($old_w / ($old_h / $this->ValueConfig(3))); //zmensuje
        $new_h_obr = $this->ValueConfig(3);
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
          $img_old = imagecreatefromjpeg($tmp["tmp_name"]);
          $pripona = "jpg";

          $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
          imagejpeg($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}.{$pripona}", 100);
          imagedestroy($img_new);

          $img_new = imagecreatetruecolor($new_w_obr, $new_h_obr);  //full
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w_obr, $new_h_obr, $old_w, $old_h);
          imagejpeg($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$nazev}.{$pripona}", 100);
          imagedestroy($img_new);
        break;

        case "image/png":
          $img_old = imagecreatefrompng($tmp["tmp_name"]);
          $pripona = "png";

          $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
          imagepng($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}.{$pripona}");
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
    $nahoda = "";
    for ($i = 0; $i < 5; $i++)
    {
      $nahoda .= rand(10, 5000);
    }

    $result = "{$nahoda}__".date("j_n_Y-H_i_s");

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
                                      datum,
                                      poradi
                                      FROM gallery
                                      ORDER BY LOWER(adresa) ASC, poradi ASC;", NULL, $error))
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
                                              $data->poradi,
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
