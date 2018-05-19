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
  private $var;
  private $sqlite;
  private $dbname;  //jmeno db se ziska z promenne.php
  private $idmodul = "dyngall";
  private $dirpath;

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

    $adresa_menu = array( array("main_href" => "{$this->idmodul}",
                                "odkaz" => "Dynamická galerie bez sekcí",
                                "title" => "Dynamická galerie bez sekcí",
                                "id" => "",
                                "class" => "galerie_delsi_nazev_menu",
                                "akce" => ""),
                          );

    $this->NastavitAdresuMenu($adresa_menu);
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
 * @return vystupni galerie
 */
  public function Gallery($adr = NULL)
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
    //vypis gelerie
    if ($res = @$this->sqlite->query("SELECT popisek, url FROM gallery WHERE adresa='{$adresa}' ORDER BY {$order};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "\n          <p class=\"obrazek\">
            <a href=\"{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}\" class=\"highslide obrazek\" title=\"{$data->popisek}\" onclick=\"return hs.expand(this)\">
              <img src=\"{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}\" alt=\"{$data->popisek}\" />
            </a>
            <span class=\"highslide-caption\">{$data->popisek}</span>
          </p>";
        }
      }
        else
      {
        $result = "";
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
      $w_mini = $data[0];
      $h_mini = $data[1];
      $w_full = $data[2];
      $h_full = $data[3];
      $limit = $data[4];
      $razeni = $data[5];
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

    $result = "Uloženo...";

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
    $result =
    "administrace dynamické obrázkové galerie bez sekcí
    <br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add\" title=\"\">přidat obrázek</a><br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=config\" title=\"\">konfigurace galerie</a><br />
    <br />
    {$this->AdminVypisGallery()}
    ";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "config":  //kofigurace galerie
          $this->LoadConfig($w_mini, $h_mini, $w_full, $h_full, $limit, $razeni);

          $result =
          "<br />
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\">zavřít konfiguraci [X]</a><br />
          <form method=\"post\">
            <fieldset>
              mini:<br />
              <input type=\"radio\"".($w_mini != 0 ? " checked=\"checked\"" : "")." name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
              width mini: <input type=\"text\" name=\"w_mini\" id=\"mini1_p1\" value=\"{$w_mini}\" /> px<br />
              <br />
              <input type=\"radio\"".($h_mini != 0 ? " checked=\"checked\"" : "")." name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
              height mini: <input type=\"text\" name=\"h_mini\" id=\"mini2_p1\" value=\"{$h_mini}\" /> px<br />
              <br />
              <input type=\"radio\"".($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : "")." name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
              width mini: <input type=\"text\" name=\"w_mini\" id=\"mini3_p1\" value=\"{$w_mini}\" /> px<br />
              height mini: <input type=\"text\" name=\"h_mini\" id=\"mini3_p2\" value=\"{$h_mini}\" /> px<br />
              <br />
              <br />
              full:<br />
              <input type=\"radio\"".($w_full != 0 ? " checked=\"checked\"" : "")." name=\"full\" onclick=\"full_1();\">dopocitat vysku<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full1_p1\" value=\"{$w_full}\" /> px<br />
              <br />
              <input type=\"radio\"".($h_full != 0 ? " checked=\"checked\"" : "")." name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full2_p1\" value=\"{$h_full}\" /> px<br />
              <br />
              <input type=\"radio\"".($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : "")." name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full3_p1\" value=\"{$w_full}\" /> px<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full3_p2\" value=\"{$h_full}\" /> px<br />
              <br />
              <input type=\"radio\"".($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : "")." name=\"full\" onclick=\"full_4();\">originální velikost<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full4_p1\" value=\"0\" disabled /> px<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full4_p2\" value=\"0\" disabled /> px<br />
              <br />
              <br />
              limit:<br />
              <input type=\"radio\"".($limit != 0 ? " checked=\"checked\"" : "")." name=\"lim\" onclick=\"lim_1();\">dany limit<br />
              limit upload: <input type=\"text\" name=\"limit\" id=\"lim_p1\" value=\"{$limit}\" /> MB<br />
              <br />
              <input type=\"radio\"".($limit == 0 ? " checked=\"checked\"" : "")." name=\"lim\" onclick=\"lim_2();\">neomezeny (do limitu php def.nastaveni)<br />
              <br />
              <br />
              volba řazeni:<br />
              <input type=\"radio\" name=\"razeni\" value=\"1\"".($razeni == 1 ? " checked=\"checked\"" : "")." />datum ASC<br />
              <input type=\"radio\" name=\"razeni\" value=\"2\"".($razeni == 2 ? " checked=\"checked\"" : "")." />datum DESC<br />
              <input type=\"radio\" name=\"razeni\" value=\"3\"".($razeni == 3 ? " checked=\"checked\"" : "")." />pořadí ASC<br />
              <input type=\"radio\" name=\"razeni\" value=\"4\"".($razeni == 4 ? " checked=\"checked\"" : "")." />pořadí DESC<br />
              <br />
              <input type=\"submit\" name=\"tlacitko\" value=\"uložit konfiguraci\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            function mini_1()
            {
              document.getElementById('mini1_p1').disabled = false;
              document.getElementById('mini2_p1').disabled = true;
              document.getElementById('mini3_p1').disabled = true;
              document.getElementById('mini3_p2').disabled = true;
            }

            function mini_2()
            {
              document.getElementById('mini1_p1').disabled = true;
              document.getElementById('mini2_p1').disabled = false;
              document.getElementById('mini3_p1').disabled = true;
              document.getElementById('mini3_p2').disabled = true;
            }

            function mini_3()
            {
              document.getElementById('mini1_p1').disabled = true;
              document.getElementById('mini2_p1').disabled = true;
              document.getElementById('mini3_p1').disabled = false;
              document.getElementById('mini3_p2').disabled = false;
            }

            function full_1()
            {
              document.getElementById('full1_p1').disabled = false;
              document.getElementById('full2_p1').disabled = true;
              document.getElementById('full3_p1').disabled = true;
              document.getElementById('full3_p2').disabled = true;
            }

            function full_2()
            {
              document.getElementById('full1_p1').disabled = true;
              document.getElementById('full2_p1').disabled = false;
              document.getElementById('full3_p1').disabled = true;
              document.getElementById('full3_p2').disabled = true;
            }

            function full_3()
            {
              document.getElementById('full1_p1').disabled = true;
              document.getElementById('full2_p1').disabled = true;
              document.getElementById('full3_p1').disabled = false;
              document.getElementById('full3_p2').disabled = false;
            }

            function full_4()
            {
              document.getElementById('full1_p1').disabled = true;
              document.getElementById('full2_p1').disabled = true;
              document.getElementById('full3_p1').disabled = true;
              document.getElementById('full3_p2').disabled = true;
            }

            function lim_1()
            {
              document.getElementById('lim_p1').disabled = false;
            }

            function lim_2()
            {
              document.getElementById('lim_p1').disabled = true;
            }

            ".($w_mini != 0 && $h_mini != 0 ? "mini_3();" : ($h_mini != 0 ? "mini_2();" : ($w_mini != 0 ? "mini_1();" : "")))."
            ".($w_full == 0 && $h_full == 0 ? "full_4();" : ($w_full != 0 && $h_full != 0 ? "full_3();" : ($h_full != 0 ? "full_2();" : ($w_full != 0 ? "full_1();" : ""))))."
            ".($limit == 0 ? "lim_2();" : "lim_1();")."
          </script>
          ";

          if (!Empty($_POST["tlacitko"]))
          {
            $result = $this->SaveConfig();

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "add": //pridavani obrazku
          $result =
          "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /><br />
              popisek: <input type=\"text\" name=\"popisek\" /><br />
              obrázek: <input type=\"file\" name=\"obrazek\" /><br />
              datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s")."\" /><br />
              ".($this->ValueConfig(5) > 2 ? "poradi: <input type=\"text\" name=\"poradi\" /><br />" : "")."
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat obrazek\" />
            </fieldset>
          </form>
          ";

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

              $result =
              "
                přídána fotka s popiskem: {$popisek}<br />
                navic: {$navic}
              ";
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

              $result =
              "
              <form method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"{$data->adresa}\" /><br />
                  popisek: <input type=\"text\" name=\"popisek\" value=\"{$data->popisek}\" /><br />
                  <img src=\"{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}\" alt=\"{$data->popisek}\" /><br />
                  obrázek: <input type=\"file\" name=\"obrazek\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s", strtotime(stripslashes($data->datum)))."\" /><br />
                  ".($this->ValueConfig(5) > 2 ? "poradi: <input type=\"text\" name=\"poradi\" value=\"{$data->poradi}\" /><br />" : "")."
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit obrázek\" />
                </fieldset>
              </form>
              ";

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

                  $result =
                  "
                    upravena fotka s popiskem: {$popisek}<br />
                    navic: {$navic}
                  ";
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

                $result =
                "
                  smazána fotka s popiskem: {$data->popisek}<br />
                  navic odmazano: {$navic}
                ";
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
          $datum = date("j.n. Y H:i:s", strtotime($data->datum));

          $result .=
          "({$data->id}) '{$datum}'
          <p>
            adresa: {$data->adresa}<br />
            {$data->popisek}<br />
            poradi: {$data->poradi}
          </p>
          <a href=\"{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}\" title=\"{$data->popisek}\"><img src=\"{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}\" alt=\"{$data->popisek}\" /></a><br />
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}\" title=\"\">upravit obrazek</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->popisek}\' ?');\">smazat obsah</a> <br />
          ";
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
