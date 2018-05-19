<?php

/**
 *
 * Blok dynamicky generovane obrazkove galerie
 *
 * public funkce:\n
 * construct: DynamicPictureGallery - hlavni konstruktor tridy\n
 * SekceGallery() - hlavni vypis sekci galerie\n
 * PictureGallery() - hlavni vypis obsahu galerie, podle url a nebo zadaneho parametru\n
 * Title() - vypisuje nazev sekce dle zvolene sekce\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicPictureGallery extends DefaultModule
{
  private $var;
  private $sqlite;
  private $dbname;  //jmeno db se ziska z promenne.php
  private $idmodul = "picgall";
  private $get_sekce = "sekce";
  private $dirpath;
  private $vypis_varovani = false;

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

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $this->Instalace();

    $adresa_menu = array( array("main_href" => "{$this->idmodul}",
                                "odkaz" => "administrace dynamické obrázkové galerie",
                                "title" => " - administrace dynamické obrázkové galerie",
                                "id" => "",
                                "class" => "",
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
      if (!@$this->sqlite->queryExec("CREATE TABLE skupina (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      nazev VARCHAR(200),
                                      rewrite VARCHAR(200),
                                      popis TEXT,
                                      datum DATETIME,
                                      defaultni BOOL);

                                      CREATE TABLE picture_gallery (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      popisek VARCHAR(300),
                                      url VARCHAR(200),
                                      datum DATETIME,
                                      skupina INTEGER UNSIGNED);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Vyhleda textovou reprezentaci sekce v databazi a pri uspechu vrati jeji cislo
 *
 * @param adr nazev adresy pro prevedeni na jeji ID reprezentaci v skupine
 * @return cislo oznacene sekce
 */
  private function PrevodTextoveAdresy($adr = NULL)
  {
    if (!Empty($adr))
    {
      $sekce = $adr;
    }
      else
    {
      $sekce = $this->var->main[0]->ZpetnyPrepisAdresy($_GET[$this->get_sekce]);
    }

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT id FROM skupina WHERE rewrite='{$sekce}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->id;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    settype($result, "integer");

    return $result;
  }

/**
 *
 * Vrati cislo defaultni sekce, jestli teda je nejaka nastavena
 *
 * @return cislo defaultni sekce
 */
  private function DefaultniSekce()
  {
    $result = 0;
    if ($res = @$this->sqlite->query("SELECT id FROM skupina WHERE defaultni=1;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->id;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    settype($result, "integer");

    return $result;
  }

/**
 *
 * Vrati cislo aktualni sekce vybrane
 *
 * @return cslo sekce
 */
  private function AktualniSekce()
  {
    if ($this->DefaultniSekce() != 0)
    {
      $result = $this->DefaultniSekce();
    }
      else
    {
      if ($this->var->htaccess)
      {
        $result = $this->PrevodTextoveAdresy(); //vrati id adresy
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
 * @return title text
 */
  public function Title()
  {
    $id = $this->AktualniSekce();

    $result = "";
    if ($res = @$this->sqlite->query("SELECT nazev FROM skupina WHERE id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = " - ".$res->fetchObject()->nazev;
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
 * Navraceni samotneho vypisu sekci
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "SekceGallery");</strong>
 *
 * @return vystupni sekce
 */
  public function SekceGallery()
  {
    $sekce = $this->AktualniSekce();

    switch ($this->ValueConfig(5))
    {
      case 1:
        $order = "skupina.datum ASC";
      break;

      case 2:
        $order = "skupina.datum DESC";
      break;

      case 3:
        $order = "LOWER(skupina.nazev) ASC";
      break;

      case 4:
        $order = "LOWER(skupina.nazev) DESC";
      break;

      default:
        $order = "skupina.datum ASC";
      break;
    }

    $result = "";
    //vypis skupiny
    if ($res = @$this->sqlite->query("SELECT id, nazev, rewrite, popis, datum FROM skupina ORDER BY {$order};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        { //$this->var->main[0]->PrepisAdresy($data->nazev)
          $adresa = ($this->var->htaccess ? $data->rewrite : "?{$this->get_sekce}={$data->id}");

          $result .=
          "
          <br />
          název: {$data->nazev}
          <p>{$data->popis}</p>
          <a href=\"{$adresa}\" title=\"{$data->popis}\">vejdi do: {$data->nazev}</a>
          ".(($data->id == $sekce) || ($data->id == $this->DefaultniSekce() && $sekce == 0) ? "vybrana" : "")."
          <br />
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

/**
 *
 * Navraceni samotne galerie podle sekce
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "PictureGallery"[, "adresa_skupiny"]);</strong>
 *
 * @param adr nazev skupiny v galerii
 * @return vystupni galerie
 */
  public function PictureGallery($adr = NULL)
  {
    if (!Empty($adr))
    {
      $sekce = $this->PrevodTextoveAdresy($adr);
    }
      else
    {
      $sekce = $this->AktualniSekce();
    }

    switch ($this->ValueConfig(6))
    {
      case 1:
        $order = "picture_gallery.datum ASC";
      break;

      case 2:
        $order = "picture_gallery.datum DESC";
      break;

      case 3:
        $order = "LOWER(picture_gallery.popisek) ASC";
      break;

      case 4:
        $order = "LOWER(picture_gallery.popisek) DESC";
      break;

      default:
        $order = "picture_gallery.datum ASC";
      break;
    }

    $result = "";
    //vypis gelerie
    if ($res = @$this->sqlite->query("SELECT popisek, url FROM picture_gallery WHERE skupina={$sekce} ORDER BY {$order};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          //evantualni podminky pro oznaceni zacatku, konce a kazdeno eN-teho
          $prvni = ($i == 0); //prvni
          $posledni = ($i == ($res->numRows() - 1)); //posledni
          $ente = ((($i + 0) % 2) == 0);  //kazde 2 od 0

          $result .=
          "
          <br />
          <a href=\"".($this->var->htaccess ? "../" : "")."{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data->url}\" title=\"{$data->popisek}\"><img src=\"".($this->var->htaccess ? "../" : "")."{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}\" alt=\"{$data->popisek}\" /></a>
          <p>{$data->popisek}</p>
          <br />
          ";

          $i++;
        }
      }
        else
      {
        if (!Empty($sekce))
        {
          if ($this->vypis_varovani)
          {
            $result = "žádná položka";
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
      $this->var->main[0]->ErrorMsg($error);
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
    if ($res = @$this->sqlite->query("SELECT id, nazev FROM skupina ORDER BY LOWER(nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = "<select name=\"skupina\">";
        while ($data = $res->fetchObject())
        {
          $result .=
          "
            <option value=\"{$data->id}\"".(!Empty($id) && $id == $data->id ? " selected=\"selected\"" : "").">{$data->nazev}</option>
          ";
        }
        $result .= "</select>";
      }
        else
      {
        $result = "žádný skupina";
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
 * @param w_mini sirka mini
 * @param h_mini vyska mini
 * @param w_full sirka full
 * @param h_full vyska full
 * @param limit limit uploadu
 */
  private function LoadConfig(&$w_mini, &$h_mini, &$w_full, &$h_full, &$limit, &$razeni1, &$razeni2)
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
      $razeni1 = $data[5];
      $razeni2 = $data[6];
    }
      else
    {
      $u = fopen($this->conffile, "w");
      fwrite($u, "0-135-0-400-3-1-1");
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

    $razeni1 = $_POST["razeni1"];
    settype($razeni1, "integer");

    $razeni2 = $_POST["razeni2"];
    settype($razeni2, "integer");

    $u = fopen($this->conffile, "w");
    fwrite($u, "{$w_mini}-{$h_mini}-{$w_full}-{$h_full}-{$limit}-{$razeni1}-{$razeni2}");
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
    "administrace dynamické obrázkové galerie
    <br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addgrup\" title=\"\">přidat skupinu</a><br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addpict\" title=\"\">přidat obrázek</a><br />
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
          $this->LoadConfig($w_mini, $h_mini, $w_full, $h_full, $limit, $razeni1, $razeni2);

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
              width full: <input type=\"text\" name=\"w_full\" id=\"full4_p1\" value=\"0\" disabled=\"disabled\" /> px<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full4_p2\" value=\"0\" disabled=\"disabled\" /> px<br />
              <br />
              <br />
              limit:<br />
              <input type=\"radio\"".($limit != 0 ? " checked=\"checked\"" : "")." name=\"lim\" onclick=\"lim_1();\">dany limit<br />
              limit upload: <input type=\"text\" name=\"limit\" id=\"lim_p1\" value=\"{$limit}\" /> MB<br />
              <br />
              <input type=\"radio\"".($limit == 0 ? " checked=\"checked\"" : "")." name=\"lim\" onclick=\"lim_2();\">neomezeny (do limitu php def.nastaveni)<br />
              <br />
              volba řazeni:<br />
              sekce<br />
              <input type=\"radio\" name=\"razeni1\" value=\"1\"".($razeni1 == 1 ? " checked=\"checked\"" : "")." />datum ASC<br />
              <input type=\"radio\" name=\"razeni1\" value=\"2\"".($razeni1 == 2 ? " checked=\"checked\"" : "")." />datum DESC<br />
              <input type=\"radio\" name=\"razeni1\" value=\"3\"".($razeni1 == 3 ? " checked=\"checked\"" : "")." />název ASC<br />
              <input type=\"radio\" name=\"razeni1\" value=\"4\"".($razeni1 == 4 ? " checked=\"checked\"" : "")." />název DESC<br />
              <br />
              obrázky<br />
              <input type=\"radio\" name=\"razeni2\" value=\"1\"".($razeni2 == 1 ? " checked=\"checked\"" : "")." />datum ASC<br />
              <input type=\"radio\" name=\"razeni2\" value=\"2\"".($razeni2 == 2 ? " checked=\"checked\"" : "")." />datum DESC<br />
              <input type=\"radio\" name=\"razeni2\" value=\"3\"".($razeni2 == 3 ? " checked=\"checked\"" : "")." />popisek ASC<br />
              <input type=\"radio\" name=\"razeni2\" value=\"4\"".($razeni2 == 4 ? " checked=\"checked\"" : "")." />popisek DESC<br />
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

        case "addgrup": //pridavani skupiny
          $result =
          "
          <script type=\"text/javascript\">

          //aplikace AJAXu
          //
          // name: CreateXmlHttpObject
          // @param
          // @return
          function CreateXmlHttpObject()
          {
            var xmlHttp = null;
            try
              {
                xmlHttp = new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
              }
                catch (e)
                {
                  try
                  {
                    xmlHttp = new ActiveXObject(\"Msxml2.XMLHTTP\");  // Internet Explorer
                  }
                    catch (e)
                    {
                      xmlHttp = new ActiveXObject(\"Microsoft.XMLHTTP\");
                    }
                }

            return xmlHttp;
          }

          //
          // name: AjaxStranka
          // @param
          // @return
          function PrepisovaniTextu(text)
          {
            var xmlHttp = CreateXmlHttpObject();
            if (xmlHttp == null)
            {
              alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
              return;
            }

            var send = \"action=prepis&text=\"+text+\"&kid=\"+Math.random();

            xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, \"rewrite_input\");};  //po dokonceni se zavola

            xmlHttp.open(\"POST\", \"{$this->dirpath}/ajax.php\", true);
            xmlHttp.setRequestHeader(\"Content-Type\", \"application/x-www-form-urlencoded\");
            xmlHttp.send(send);
          }

          function ZmenaStavu(xmlHttp, element)
          {
            if (document.getElementById(element) != null)
            {
              switch (xmlHttp.readyState) //osetreni navratovych kodu
              {
                case 4: //kompletni
                  if (xmlHttp.status == 200)  //je-li vse ok
                  {
                    document.getElementById(element).value = xmlHttp.responseText;
                  }
                break;
              }
            }
          }
          </script>

          <form method=\"post\">
            <fieldset>
              nazev: <input type=\"text\" name=\"nazev\" onkeyup=\"PrepisovaniTextu(this.value)\" /><br />
              rewrite: <input type=\"text\" id=\"rewrite_input\" name=\"rewrite\" readonly=\"readonly\" /><br />
              popis: <input type=\"text\" name=\"popis\" /><br />
              datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s")."\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat skupinu\" />
            </fieldset>
          </form>
          ";

          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $rewrite = stripslashes(htmlspecialchars($_POST["rewrite"], ENT_QUOTES));
          $popis = stripslashes(htmlspecialchars($_POST["popis"], ENT_QUOTES));
          $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !Empty($popis) &&
              !Empty($datum) &&
              !Empty($rewrite) &&
              !$this->ExistujePolozka($nazev))  //kontrola duplicity
          {
            if (@$this->sqlite->queryExec("INSERT INTO skupina (id, nazev, rewrite, popis, datum, defaultni) VALUES
                                          (NULL, '{$nazev}', '{$rewrite}', '{$popis}', '{$datum}', 0);", $error))
            {
              $result =
              "
                přídána: {$nazev}
              ";
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editgrup":  //editace skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT nazev, rewrite, popis, datum, defaultni FROM skupina WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <script type=\"text/javascript\">

              //aplikace AJAXu
              //
              // name: CreateXmlHttpObject
              // @param
              // @return
              function CreateXmlHttpObject()
              {
                var xmlHttp = null;
                try
                  {
                    xmlHttp = new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
                  }
                    catch (e)
                    {
                      try
                      {
                        xmlHttp = new ActiveXObject(\"Msxml2.XMLHTTP\");  // Internet Explorer
                      }
                        catch (e)
                        {
                          xmlHttp = new ActiveXObject(\"Microsoft.XMLHTTP\");
                        }
                    }

                return xmlHttp;
              }

              //
              // name: AjaxStranka
              // @param
              // @return
              function PrepisovaniTextu(text)
              {
                var xmlHttp = CreateXmlHttpObject();
                if (xmlHttp == null)
                {
                  alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
                  return;
                }

                var send = \"action=prepis&text=\"+text+\"&kid=\"+Math.random();

                xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, \"rewrite_input\");};  //po dokonceni se zavola

                xmlHttp.open(\"POST\", \"{$this->dirpath}/ajax.php\", true);
                xmlHttp.setRequestHeader(\"Content-Type\", \"application/x-www-form-urlencoded\");
                xmlHttp.send(send);
              }

              function ZmenaStavu(xmlHttp, element)
              {
                if (document.getElementById(element) != null)
                {
                  switch (xmlHttp.readyState) //osetreni navratovych kodu
                  {
                    case 4: //kompletni
                      if (xmlHttp.status == 200)  //je-li vse ok
                      {
                        document.getElementById(element).value = xmlHttp.responseText;
                      }
                    break;
                  }
                }
              }
              </script>

              <form method=\"post\">
                <fieldset>
                  nazev: <input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\" onkeyup=\"PrepisovaniTextu(this.value)\" /><br />
                  rewrite: <input type=\"text\" id=\"rewrite_input\" name=\"rewrite\" readonly=\"readonly\" value=\"{$data->rewrite}\" /><br />
                  popis: <input type=\"text\" name=\"popis\" value=\"{$data->popis}\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s", strtotime(stripslashes($data->datum)))."\" /><br />
                  defaultni: <input type=\"checkbox\" name=\"defaultni\"".($data->defaultni ? " checked=\"checked\"" : "")." /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit skupinu\" />
                </fieldset>
              </form>
              ";

              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $rewrite = stripslashes(htmlspecialchars($_POST["rewrite"], ENT_QUOTES));
              $popis = stripslashes(htmlspecialchars($_POST["popis"], ENT_QUOTES));
              $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
              $defaultni = (!Empty($_POST["defaultni"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  !Empty($popis) &&
                  !Empty($datum) &&
                  !Empty($rewrite) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE skupina SET nazev='{$nazev}',
                                                                  rewrite='{$rewrite}',
                                                                  popis='{$popis}',
                                                                  datum='{$datum}'
                                                                  WHERE id={$id};
                                              UPDATE skupina SET defaultni=0;
                                              UPDATE skupina SET defaultni='{$defaultni}' WHERE id={$id};
                                                                  ", $error))
                {
                  $result =
                  "
                    upraven: {$nazev}
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
                $navic = $this->SyncFileWithDB(); //synchronizace

                $result =
                "
                  smazáno: '{$data->nazev}' a vsechny pod obrazky<br />
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
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;



        case "addpict": //pridavani obrazku
          $result =
          "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              popisek: <input type=\"text\" name=\"popisek\" /><br />
              obrázek: <input type=\"file\" name=\"obrazek\" /><br />
              datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s")."\" /><br />
              {$this->VyberSekce($_GET["skupina"])}<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat obrazek\" />
            </fieldset>
          </form>
          ";

          $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
          $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
          $skupina = stripslashes(htmlspecialchars($_POST["skupina"], ENT_QUOTES));
          settype($skupina, "integer");

          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $ob = $this->ZpracujObrazek($_FILES["obrazek"], $url);
          }

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($popisek) &&
              !Empty($datum) &&
              !Empty($skupina) &&
              $skupina != 0 &&
              $ob)
          {
            if (@$this->sqlite->queryExec("INSERT INTO picture_gallery (id, popisek, url, datum, skupina) VALUES
                                          (NULL, '{$popisek}', '{$url}', '{$datum}', {$skupina});", $error))
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

        case "editpict":  //editace skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT popisek, url, datum, skupina FROM picture_gallery WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                  popisek: <input type=\"text\" name=\"popisek\" value=\"{$data->popisek}\" /><br />
                  <img src=\"{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data->url}\" alt=\"{$data->popisek}\" /><br />
                  obrázek: <input type=\"file\" name=\"obrazek\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s", strtotime(stripslashes($data->datum)))."\" /><br />
                  {$this->VyberSekce($data->skupina)}<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit obrázek\" />
                </fieldset>
              </form>
              ";

              $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
              $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
              $skupina = stripslashes(htmlspecialchars($_POST["skupina"], ENT_QUOTES));
              settype($skupina, "integer");

              if (!Empty($_FILES["obrazek"]["tmp_name"]))
              {
                $this->ZpracujObrazek($_FILES["obrazek"], $url);
              }
                else
              {
                $url = $data->url;
              }

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($popisek) &&
                  !Empty($datum) &&
                  !Empty($skupina) &&
                  $skupina != 0 &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE picture_gallery SET popisek='{$popisek}',
                                                                          url='{$url}',
                                                                          datum='{$datum}',
                                                                          skupina={$skupina}
                                                                          WHERE id={$id};", $error))
                {
                  $result =
                  "
                    upravena fotka s popiskem: {$popisek}
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
    switch ($this->ValueConfig(5))
    {
      case 1:
        $order = "skupina.datum ASC";
      break;

      case 2:
        $order = "skupina.datum DESC";
      break;

      case 3:
        $order = "LOWER(skupina.nazev) ASC";
      break;

      case 4:
        $order = "LOWER(skupina.nazev) DESC";
      break;

      default:
        $order = "skupina.datum ASC";
      break;
    }

    $result = "";
    //vypis skupiny
    if ($res = @$this->sqlite->query("SELECT id, nazev, rewrite, popis, datum, defaultni FROM skupina ORDER BY {$order};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $datum = date("j.n. Y H:i:s", strtotime($data->datum));

          $result .=
          "<br />
-------------------------------------------------------------------------------
          <br />
          {$data->nazev} - {$data->rewrite} '{$datum}'<p>{$data->popis}</p>
          <input type=\"checkbox\" name=\"defaultni\"".($data->defaultni ? " checked=\"checked\"" : "")." disabled /><br />
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addpict&amp;skupina={$data->id}\" title=\"\">přidat obrázek</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editgrup&amp;id={$data->id}\" title=\"\">upravit skupinu</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delgrup&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->nazev}\' ?');\">smazat skupinu</a><br />
          ";

          switch ($this->ValueConfig(6))
          {
            case 1:
              $order = "picture_gallery.datum ASC";
            break;

            case 2:
              $order = "picture_gallery.datum DESC";
            break;

            case 3:
              $order = "LOWER(picture_gallery.popisek) ASC";
            break;

            case 4:
              $order = "LOWER(picture_gallery.popisek) DESC";
            break;

            default:
              $order = "picture_gallery.datum ASC";
            break;
          }

          //vypis obrazku
          if ($res1 = @$this->sqlite->query("SELECT id,
                                            popisek,
                                            url,
                                            datum
                                            FROM picture_gallery
                                            WHERE picture_gallery.skupina={$data->id}
                                            ORDER BY {$order};", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $datum1 = date("j.n. Y H:i:s", strtotime($data1->datum));

                $result .=
                "<br />
*******************************************************************************
                <br />
                '{$datum1}'<p>{$data1->popisek}</p>
                <a href=\"{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$data1->url}\" title=\"{$data1->popisek}\"><img src=\"{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$data1->url}\" alt=\"{$data1->popisek}\" /></a><br />
                <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editpict&amp;id={$data1->id}\" title=\"\">upravit obrazek</a>
                <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delpict&amp;id={$data1->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data1->popisek}\' ?');\">smazat obrázek</a> <br />

                ";
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
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
