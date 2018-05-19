<?php

/**
 *
 * Blok captcha kodu
 *
 */

//verze modulu
define("v_DynamicCaptcha", "2.02");

class DynamicCaptcha extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona;
  public $idmodul = "dyncapt";
  public $mount = array(".unikatni_obsah.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul
  public $convmeth = array();

  private $localpermit;

  private $dirfont = "fonty";
  private $dirprew = "nahledy";
  private $dirpic = "pozadi";
  private $defaultpic = "default";
  private $korekceobr = 10; //+px

  private $cfgexplode = "|--xx--|"; //text pro rozdeleni konfigurace

  private $imgcreare = "obrcreate";
  private $get_captcha = "captchakod";
  private $id_obr = "captchaid";

  private $typkodu = array ("");

/**
 *
 * Konstruktor menu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      $this->typkodu = $this->unikatni["set_typkodu"];
      $this->dirfont = $this->unikatni["set_dirfont"];
      $this->defaultpic = $this->unikatni["set_defaultpic"];

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);

      $this->Instalace();

      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->AutomatickeVykreslovani();

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                          $this->idmodul));
    }
  }

/**
 *
 * Instalace databaze
 *
 */
  private function Instalace()
  {
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}captcha (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                font INTEGER UNSIGNED,
                                typ VARCHAR(50),
                                konfigurace TEXT,
                                otazka VARCHAR(500),
                                x INTEGER UNSIGNED,
                                y INTEGER UNSIGNED,
                                width INTEGER UNSIGNED,
                                height INTEGER UNSIGNED,
                                padding VARCHAR(20),
                                font_size VARCHAR(20),
                                roztec INTEGER UNSIGNED,
                                font_color VARCHAR(20),
                                background_color VARCHAR(10),
                                rotace_pismen VARCHAR(20),
                                mrizka VARCHAR(20),
                                rand_dot BOOL,
                                rand_line BOOL,
                                rand_rectangle BOOL,
                                rand_arc BOOL,
                                rand_ellipse BOOL,
                                rand_barva VARCHAR(20),
                                rand_koeficient VARCHAR(20),
                                url VARCHAR(200),
                                vyrez_x INTEGER UNSIGNED,
                                vyrez_y INTEGER UNSIGNED);

                              CREATE TABLE {$this->dbpredpona}font (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                nazev VARCHAR(100),
                                url VARCHAR(300));
                                ");
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
 * Stara se o automaticke vykreslovani captcha kodu v adminu
 *
 */
  private function AutomatickeVykreslovani()
  {
    if (!Empty($_GET[$this->get_captcha]) &&
        $_GET[$this->get_captcha] == $this->imgcreare &&
        !Empty($_GET[$this->id_obr]) &&
        Empty($_GET["co"]))
    {
      $id = (int)$_GET[$this->id_obr];  //prepina mezi naplnovani a vykreslovanim
      //nacteni vlastni hodnoty z url
      $selfword = base64_decode(rawurldecode($this->NotEmpty("get", "selfword")));
      //detekce adminu, pri true si generuje slova sam
      $admin = ($this->NotEmpty("get", $this->var->get_kam) == $this->var->adresaadminu);

      $result = "";
      if ($data = $this->querySingleRow("SELECT
                                        id, typ, otazka, x, y, width, height, padding, font,
                                        font_size, roztec, font_color, background_color,
                                        rotace_pismen, mrizka, rand_dot, rand_line,
                                        rand_rectangle, rand_arc, rand_ellipse,
                                        rand_barva, rand_koeficient, url, vyrez_x, vyrez_y
                                        FROM {$this->dbpredpona}captcha WHERE id={$id};"))
      { //vygenerovani pole pro predani do generovaci funkce
        $captcha["slovo"] = ($admin ? array($selfword) : $this->NotEmpty("session", "slovo_{$id}"));  //$_SESSION["slovo_{$id}"]
        $captcha["x"] = $data->x;
        $captcha["y"] = $data->y;
        $captcha["width"] = $data->width;
        $captcha["height"] = $data->height;
        $captcha["padding"] = $data->padding;
        $captcha["font"] = "{$this->dirpath}/{$this->dirfont}/{$this->VypisHodnotu("url", "font", $data->font)}";
        $captcha["font_size"] = explode($this->cfgexplode, $data->font_size);
        $captcha["roztec"] = $data->roztec;
        $captcha["font_color"] = explode($this->cfgexplode, $data->font_color);
        $captcha["background_color"] = $data->background_color;
        $captcha["background_url"] = "{$this->dirpath}/{$this->dirpic}/{$data->url}"; //url pozadi
        $captcha["background_x"] = $data->vyrez_x;
        $captcha["background_y"] = $data->vyrez_y;
        $captcha["rotace_pismen"] = explode($this->cfgexplode, $data->rotace_pismen);
        $captcha["mrizka"] = explode($this->cfgexplode, $data->mrizka);
        $captcha["rand_dot"] = $data->rand_dot;
        $captcha["rand_line"] = $data->rand_line;
        $captcha["rand_rectangle"] = $data->rand_rectangle;
        $captcha["rand_arc"] = $data->rand_arc;
        $captcha["rand_ellipse"] = $data->rand_ellipse;
        $captcha["rand_barva"] = explode($this->cfgexplode, $data->rand_barva);
        $captcha["rand_koeficient"] = explode($this->cfgexplode, $data->rand_koeficient);

        //samotne vykreslovani nesaha do DB
        $this->VykresliCaptchaObrazek($captcha);
      }
        else
      {
        if ($_GET[$this->get_captcha] == $this->imgcreare &&
            !Empty($_GET[$this->id_obr]))
        {
          $cesta = "{$this->dirpath}/{$this->defaultpic}.png";
          if ($u = @fopen($cesta, "r"))
          {
            header("Content-type: image/png");
            echo fread($u, filesize($cesta));
            fclose($u);
            exit(1);
          }
        }
      }
    }
  }

/**
 *
 * funkce starajici se o vykresleni obrazku captcha kodu
 *
 * @param nastaveni prenosove pole
 * @return obrazek captcha kodu
 */
  private function VykresliCaptchaObrazek($nastaveni)
  {
    $width = $nastaveni["width"];
    $height = $nastaveni["height"];
    $size = $nastaveni["font_size"];
    $barva_textu = $nastaveni["font_color"];
    $rotace = $nastaveni["rotace_pismen"];
    $mrizka = $nastaveni["mrizka"]; //typ,x,y
    $koeficient = $nastaveni["rand_koeficient"]; //2
    $rand_barva = $nastaveni["rand_barva"]; //2
//dodelat!!! prepsat na IMAGIC!!!!!!!!!!!!!!!
    //blok autosize zpracovani
    $autosize = false;
    if ($width == 0 &&
        $height == 0)
    { //provedeni autosize vypoctu
      $autotext = $this->NotIsset($nastaveni["slovo"], 0);//$nastaveni["slovo"][0]; //bere rovnou pole
      $bbox = imagettfbbox($size[0], $rotace[0], $nastaveni["font"], $autotext);
      //nacitani paddingu TOP RIGHT BOTTOM LEFT
      $padding = explode(" ", $nastaveni["padding"]);
      $p_top = $padding[0];
      $p_right = $padding[1];
      $p_bottom = $padding[2];
      $p_left = $padding[3];
      //redeklarace typu pro jistotu
      settype($p_top, "integer");
      settype($p_right, "integer");
      settype($p_bottom, "integer");
      settype($p_left, "integer");
      //vypocet sirky a vysky
      $width = abs(($bbox[2] + $p_right) - ($bbox[0] - $p_left));
      $height = abs(($bbox[7] - $p_top) - ($bbox[1] + $p_bottom));
      //vypocet x a y pozice
      $pos_x = abs($bbox[6] - $p_left); //levy horni roh
      $pos_y = abs($bbox[7] - $p_top);
      $autosize = true;
    }

    $im = imagecreatetruecolor($width, $height);  //vytvoreni platna
    if (!Empty($nastaveni["background_color"])) //volba mezi pevnym pozadim a obrazkem
    {
      list($pozadi_r, $pozadi_g, $pozadi_b) = $this->PrevodNaRGB($nastaveni["background_color"]); //barva pozadi
      $pozadi = imagecolorallocate($im, $pozadi_r, $pozadi_g, $pozadi_b); //nastaveni barvy

      imagefilledrectangle($im, 0, 0, $width, $height, $pozadi);  //vyplneni pozadi barvou
    }
      else
    {
      $roz = explode(".", $nastaveni["background_url"]);
      //souceni obrazku vyrezu a platna
      switch ($roz[count($roz) - 1])
      {
        case "jpg":
          $im_obr = imagecreatefromjpeg($nastaveni["background_url"]);
        break;

        case "png":
          $im_obr = imagecreatefrompng($nastaveni["background_url"]);
        break;
      }

      imagecopymerge($im, $im_obr, 0, 0, $nastaveni["background_x"], $nastaveni["background_y"], $width, $height, 100);
    }

    //generovani mrizek
    if (!Empty($mrizka[0])) //je-li zapnuta mrzka
    {
      switch ($mrizka[0])
      {
        case 1: // +
          for ($i = 0; $i < ceil($width / $mrizka[1]); $i++)  //generovani radku
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, 0, $i * $mrizka[1], $width, $i * $mrizka[1], $barva);

            for ($j = 0; $j < ceil($height / $mrizka[2]); $j++) //generovani sloupcu
            {
              list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
              $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

              imageline($im, $i * $mrizka[2], 0, $i * $mrizka[2], $height, $barva);
            }
          }
        break;

        case 2: // #
          for ($i = 0; $i < ceil($width / $mrizka[1]); $i++)  //generovani radku
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, 0, $i * $mrizka[1], $width, $i * $mrizka[1], $barva);

            for ($j = 0; $j < ceil($height / $mrizka[2]); $j++) //generovani sloupcu
            {
              list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
              $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

              imageline($im, $i * $mrizka[2] + $mrizka[1], 0, $i * $mrizka[2], $height, $barva);
            }
          }
        break;

        case 3: // x
          for ($i = 0 - $mrizka[1]; $i < ceil($width / $mrizka[1]) + $mrizka[2]; $i++)  //generovani radku
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, $i * $mrizka[1] - $mrizka[2], 0, $i * $mrizka[1] + $mrizka[2], $height, $barva);

            for ($j = 0; $j < ceil($height / $mrizka[2]); $j++) //generovani sloupcu
            {
              list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
              $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

              imageline($im, $i * $mrizka[2] + $mrizka[1], 0, $i * $mrizka[2] - $mrizka[1], $height, $barva);
            }
          }
        break;

        case 4: // -
          for ($i = 0; $i < ceil($width / $mrizka[1]); $i++)  //generovani radku
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, 0, $i * $mrizka[1], $width, $i * $mrizka[1], $barva);
          }
        break;

        case 5: // |
          for ($i = 0; $i < $height; $i++) //generovani sloupcu
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, $i * $mrizka[1], 0, $i * $mrizka[1], $height, $barva);
          }
        break;

        case 6: // \
          for ($i = 0 - $mrizka[2]; $i < $height; $i++) //generovani sloupcu
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, $i * $mrizka[1], 0, $i * $mrizka[1] + $mrizka[2], $height, $barva);
          }
        break;

        case 7: // /
          for ($i = 0 - $mrizka[2]; $i < $height; $i++) //generovani sloupcu
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, $i * $mrizka[1] + $mrizka[2], 0, $i * $mrizka[1], $height, $barva);
          }
        break;
      }
    }

    //vygenerovani textu podle automatickeho tvaru
    if ($autosize)  //generovani podle automaticke velikosti
    {
      list($pismo_r, $pismo_g, $pismo_b) = $this->PrevodNaRGB(Empty($barva_textu[1]) ? $barva_textu[0] : $this->NahodnaRGBBarva($barva_textu[0], $barva_textu[1]));
      $color_font = imagecolorallocate($im, $pismo_r, $pismo_g, $pismo_b);

      imagettftext($im, $size[0], $rotace[0], $pos_x, $pos_y, $color_font, $nastaveni["font"], $autotext);
    }

    //rosekani slova na pismena, bere rovnou pole
    $pismena = str_split($this->NotIsset($nastaveni["slovo"], 0), 1); //$nastaveni["slovo"][0]
    //prochazeni pole pismen
    foreach ($pismena as $index => $pismeno)
    {
      list($pismo_r, $pismo_g, $pismo_b) = $this->PrevodNaRGB(Empty($barva_textu[1]) ? $barva_textu[0] : $this->NahodnaRGBBarva($barva_textu[0], $barva_textu[1]));
      $color_font = imagecolorallocate($im, $pismo_r, $pismo_g, $pismo_b);

      //prvni text a pak cary
      $size_font = (Empty($size[1]) ? $size[0] : rand($size[0], $size[1])); //velikost textu
      $rotace_pisma = (Empty($rotace[1]) ? $rotace[0] : rand($rotace[0], $rotace[1])); //rotace pismen

      if (!$autosize)
      {
        imagettftext($im, $size_font, $rotace_pisma, $nastaveni["x"] + ($index * $nastaveni["roztec"]), $nastaveni["y"], $color_font, $nastaveni["font"], $pismeno);
      }

      if (!Empty($koeficient[0]))
      {
        for ($j = 0; $j < (Empty($koeficient[1]) ? $koeficient[0] : rand($koeficient[0], $koeficient[1])); $j++)  //rand(5, 15)
        {
          list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("#000", "#fff") : $rand_barva[0]));
          $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

          if ($nastaveni["rand_dot"]) //generovani tecek
          {
            imagesetpixel($im, rand(0, $width), rand(0, $height), $barva);
          }

          if ($nastaveni["rand_line"])  //generovani linek
          {
            imageline($im, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $barva);
          }

          if ($nastaveni["rand_rectangle"]) //generovani ctvercu
          {
            imagerectangle($im, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $barva);
          }

          if ($nastaveni["rand_arc"]) //generovani polokruzi
          {
            imagearc($im, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $barva);
          }

          if ($nastaveni["rand_ellipse"]) //generovani elips
          {
            imageellipse($im, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $barva);
          }
        }
      }
    }

    header("Content-type: image/png");
    imagepng($im);
    imagedestroy($im);
    exit(0);
  }

/**
 *
 * Vygeneruje nahodne slovo podle zvoleneho typu a poctu pismen
 *
 * @param id cislo captcha kodu
 * @return pole s obrazkem a vyslednou hodnotou
 */
  public function GenerujNahodneSlovo($id)
  {
    settype($id, "integer");

    $result = "";
    $ret = $this->ControlObjectHodnoty(array("typ", "konfigurace"),
                                      array("captcha", $id));
    //parsne konfiguraci
    $konfigurace = explode($this->cfgexplode, $ret->konfigurace);
    //vyber typu kodu
    if (!Empty($ret->typ))
    {
      switch ($ret->typ)
      {
        case "pismena":
          $pocet = $konfigurace[1];
          //rozliseni subtypu typu
          switch ($konfigurace[0])
          {
            case "small":
              $pismeno = array();
              foreach (range(1, $pocet) as $index)
              {
                $pismeno[] = chr(rand(97, 97+25));
              }
              $result[0] = implode("", $pismeno); //zobrazit
              $result[1] = implode("", $pismeno); //vysledek
            break;

            case "large":
              $pismeno = array();
              foreach (range(1, $pocet) as $index)
              {
                $pismeno[] = chr(rand(65, 65+25));
              }
              $result[0] = implode("", $pismeno); //zobrazit
              $result[1] = implode("", $pismeno); //vysledek
            break;

            case "smalllarge":
              $pismeno = array();
              foreach (range(1, $pocet) as $index)
              {
                $rand = array(chr(rand(97, 97+25)), //male
                              chr(rand(65, 65+25)));  //velke
                $pismeno[] = $rand[array_rand($rand)];
              }
              $result[0] = implode("", $pismeno); //zobrazit
              $result[1] = implode("", $pismeno); //vysledek
            break;

            case "number":
              $pismeno = array();
              foreach (range(1, $pocet) as $index)
              {
                $pismeno[] = chr(rand(48, 48+9));
              }
              $result[0] = implode("", $pismeno); //zobrazit
              $result[1] = implode("", $pismeno); //vysledek
            break;

            case "numbersmall":
              $pismeno = array();
              foreach (range(1, $pocet) as $index)
              {
                $rand = array(chr(rand(48, 48+9)), //cisla
                              chr(rand(97, 97+25)));  //male
                $pismeno[] = $rand[array_rand($rand)];
              }
              $result[0] = implode("", $pismeno); //zobrazit
              $result[1] = implode("", $pismeno); //vysledek
            break;

            case "numberlarge":
              $pismeno = array();
              foreach (range(1, $pocet) as $index)
              {
                $rand = array(chr(rand(48, 48+9)), //cisla
                              chr(rand(65, 65+25)));  //velke
                $pismeno[] = $rand[array_rand($rand)];
              }
              $result[0] = implode("", $pismeno); //zobrazit
              $result[1] = implode("", $pismeno); //vysledek
            break;

            case "rand":
              $pismeno = array();
              foreach (range(1, $pocet) as $index)
              {
                $rand = array(chr(rand(48, 48+9)), //cisla
                              chr(rand(97, 97+25)), //male
                              chr(rand(65, 65+25)));  //velke
                $pismeno[] = $rand[array_rand($rand)];
              }
              $result[0] = implode("", $pismeno); //zobrazit
              $result[1] = implode("", $pismeno); //vysledek
            break;

            case "special":
              $pismeno = array();
              foreach (range(1, $pocet) as $index)
              { //vsechny mozne tisknutelne netextove znaky
                $rand = array(chr(rand(33, 43)),
                              chr(rand(45, 47)),
                              chr(rand(58, 64)),
                              chr(rand(91, 95)),
                              chr(rand(123, 126)));
                $pismeno[] = $rand[array_rand($rand)];
              }
              $result[0] = implode("", $pismeno); //zobrazit
              $result[1] = implode("", $pismeno); //vysledek
            break;
          }
        break;

        case "priklady":
          $nahoda0 = rand($konfigurace[1], $konfigurace[2]); //generovani 1 nahodneho cisla
          $nahoda1 = rand($konfigurace[3], $konfigurace[4]); //generovani 2 nahodneho cisla
          //rozliseni subtypu typu
          switch ($konfigurace[0])
          {
            case "plus":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_plus"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $nahoda0 + $nahoda1; //vysledek
            break;

            case "minus":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_minus"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $nahoda0 - $nahoda1; //vysledek
            break;

            case "plusminus":
              $rand = array("plus" => $nahoda0 + $nahoda1,
                            "minus" => $nahoda0 - $nahoda1);
              $nahoda = array_rand($rand); //nahodny index pole
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_{$nahoda}"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $rand[$nahoda]; //vysledek
            break;

            case "nasobeni":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_nasobeni"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $nahoda0 * $nahoda1; //vysledek
            break;

            case "deleni":
              //osetreni na nulu!
              if ($nahoda1 == 0)
              { //anti chuck norris osetreni
                $nahoda1 = 1;
              }
              $vysl = explode(".", ($nahoda0 / $nahoda1));
              $dele = (count($vysl) > 1 ? implode(".", array($vysl[0], substr($vysl[1], 0, 3))) : $vysl[0]);
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_deleni"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $dele;
            break;

            case "nasobenideleni":
              //osetreni na nulu!
              if ($nahoda1 == 0)
              { //anti chuck norris osetreni
                $nahoda1 = 1;
              }
              $vysl = explode(".", ($nahoda0 / $nahoda1));
              $dele = (count($vysl) > 1 ? implode(".", array($vysl[0], substr($vysl[1], 0, 3))) : $vysl[0]);
              $rand = array("nasobeni" => $nahoda0 * $nahoda1,
                            "deleni" => $dele);
              $nahoda = array_rand($rand); //nahodny index pole
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_{$nahoda}"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $rand[$nahoda]; //vysledek
            break;

            case "modulo":
              //osetreni na nulu!
              if ($nahoda1 == 0)
              { //anti chuck norris osetreni
                $nahoda1 = 1;
              }
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_modulo"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $nahoda0 % $nahoda1;
            break;

            case "mocniny":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_mocniny"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = number_format(pow($nahoda0, $nahoda1), 0, ".", ""); //vysledek
            break;

            case "odmocniny":
              $vysl1 = explode(".", pow($nahoda1, 1 / $nahoda0));
              $sqrt = (count($vysl1) > 1 ? implode(".", array($vysl1[0], substr($vysl1[1], 0, 3))) : $vysl1[0]);
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_odmocniny"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $sqrt; //vysledek
            break;

            case "mocninyodmocniny":
              $vysl1 = explode(".", pow($nahoda1, 1 / $nahoda0));
              $sqrt = (count($vysl1) > 1 ? implode(".", array($vysl1[0], substr($vysl1[1], 0, 3))) : $vysl1[0]);
              $rand = array("mocniny" => number_format(pow($nahoda0, $nahoda1), 0, ".", ""),
                            "odmocniny" => $sqrt);
              $nahoda = array_rand($rand); //nahodny index pole
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_{$nahoda}"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $rand[$nahoda]; //vysledek
            break;

            case "rand":
              //osetreni na nulu!
              if ($nahoda1 == 0)
              { //anti chuck norris osetreni
                $nahoda1 = 1;
              }
              $vysl = explode(".", ($nahoda0 / $nahoda1));
              $dele = (count($vysl) > 1 ? implode(".", array($vysl[0], substr($vysl[1], 0, 3))) : $vysl[0]);
              $vysl1 = explode(".", pow($nahoda1, 1 / $nahoda0));
              $sqrt = (count($vysl1) > 1 ? implode(".", array($vysl1[0], substr($vysl1[1], 0, 3))) : $vysl1[0]);
              $rand = array("plus" => $nahoda0 + $nahoda1,
                            "minus" => $nahoda0 - $nahoda1,
                            "nasobeni" => $nahoda0 * $nahoda1,
                            "deleni" => $dele,
                            "modulo" => $nahoda0 % $nahoda1,
                            "mocniny" => number_format(pow($nahoda0, $nahoda1), 0, ".", ""),
                            "odmocniny" => $sqrt);
              $nahoda = array_rand($rand); //nahodny index pole
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_priklady_{$nahoda}"], $nahoda0, $nahoda1); //zobrazit
              $result[1] = $rand[$nahoda]; //vysledek
            break;
          }
        break;

        case "rimske":
          $nahoda = rand($konfigurace[1], $konfigurace[2]); //generovani nahodneho cisla
          //rozliseni subtypu typu
          switch ($konfigurace[0])
          {
            case "arabrim":
              $result[0] = $nahoda; //zobrazit
              $result[1] = $this->ArabskeRimske($nahoda); //vysledek
            break;

            case "rimarab":
              $result[0] = $this->ArabskeRimske($nahoda); //zobrazit
              $result[1] = $nahoda; //vysledek
            break;

            case "rand":
              //nahodna volba prevodu
              switch (rand(0, 1))
              {
                case 0:
                  $result[0] = $nahoda; //zobrazit
                  $result[1] = $this->ArabskeRimske($nahoda); //vysledek
                break;

                case 1:
                  $result[0] = $this->ArabskeRimske($nahoda); //zobrazit
                  $result[1] = $nahoda; //vysledek
                break;
              }
            break;
          }
        break;

        case "vlastni":
          list($klice, $hodnoty) = $this->RozdelitHodnoty($konfigurace, 2);
          //moznost => spravna odpoved
          $nahoda = array_rand($klice); //nahodny index pole
          $result[0] = $klice[$nahoda]; //zobrazit
          $result[1] = $hodnoty[$nahoda]; //vysledek
        break;

        case "prevody":
          $nahoda = rand($konfigurace[1], $konfigurace[2]); //generovani nahodneho cisla
          //rozliseni subtypu typu
          switch ($konfigurace[0])
          {
            case "bindec":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_bindec"], decbin($nahoda)); //zobrazit
              $result[1] = $nahoda; //vysledek
            break;

            case "binoct":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_binoct"], decbin($nahoda)); //zobrazit
              $result[1] = decoct($nahoda); //vysledek
            break;

            case "binhex":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_binhex"], decbin($nahoda)); //zobrazit
              $result[1] = dechex($nahoda); //vysledek
            break;

            case "octdec":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_octdec"], decoct($nahoda)); //zobrazit
              $result[1] = $nahoda; //vysledek
            break;

            case "octbin":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_octbin"], decoct($nahoda)); //zobrazit
              $result[1] = decbin($nahoda); //vysledek
            break;

            case "octhex":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_octhex"], decoct($nahoda)); //zobrazit
              $result[1] = dechex($nahoda); //vysledek
            break;

            case "hexdec":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_hexdec"], dechex($nahoda)); //zobrazit
              $result[1] = $nahoda; //vysledek
            break;

            case "hexoct":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_hexoct"], dechex($nahoda)); //zobrazit
              $result[1] = decoct($nahoda); //vysledek
            break;

            case "hexbin":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_hexbin"], dechex($nahoda)); //zobrazit
              $result[1] = decbin($nahoda); //vysledek
            break;

            case "decbin":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_decbin"], $nahoda); //zobrazit
              $result[1] = decbin($nahoda); //vysledek
            break;

            case "decoct":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_decoct"], $nahoda); //zobrazit
              $result[1] = decoct($nahoda); //vysledek
            break;

            case "dechex":
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_dechex"], $nahoda); //zobrazit
              $result[1] = dechex($nahoda); //vysledek
            break;

            case "rand":
              $rand = array("bindec" => array(decbin($nahoda), $nahoda),
                            "binoct" => array(decbin($nahoda), decoct($nahoda)),
                            "binhex" => array(decbin($nahoda), dechex($nahoda)),
                            "octdec" => array(decoct($nahoda), $nahoda),
                            "octbin" => array(decoct($nahoda), decbin($nahoda)),
                            "octhex" => array(decoct($nahoda), dechex($nahoda)),
                            "hexdec" => array(dechex($nahoda), $nahoda),
                            "hexoct" => array(dechex($nahoda), decoct($nahoda)),
                            "hexbin" => array(dechex($nahoda), decbin($nahoda)),
                            "decbin" => array($nahoda, decbin($nahoda)),
                            "decoct" => array($nahoda, decoct($nahoda)),
                            "dechex" => array($nahoda, dechex($nahoda)));
              $nahoda = array_rand($rand); //nahodny index pole
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_prevody_{$nahoda}"], $rand[$nahoda][0]); //zobrazit
              $result[1] = $rand[$nahoda][1]; //vysledek
            break;
          }
        break;

        case "barvy":
          //rozliseni subtypu typu
          switch ($konfigurace[0])
          {
            case "hexrgb":
              $dec = array();
              $hex = array();
              foreach (range(0, 2) as $index)
              {
                $cis = rand(16, 255);
                $hex[] = dechex($cis);
                $dec[] = $cis;
              }
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_barvy_hexrgb"], implode("", $hex));  //zobrazit
              $result[1] = implode(",", $dec);  //vysledek
            break;

            case "rgbhex":
              $dec = array();
              $hex = array();
              foreach (range(0, 2) as $index)
              {
                $cis = rand(16, 255);
                $dec[] = $cis;
                $hex[] = dechex($cis);
              }
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_barvy_rgbhex"], implode(",", $dec));  //zobrazit
              $result[1] = "#".implode("", $hex);  //vysledek
            break;

            case "rand":
              $dec = array();
              $hex = array();
              foreach (range(0, 2) as $index)
              {
                $cis = rand(16, 255);
                $hex[] = dechex($cis);
                $dec[] = $cis;
              }
              $rand = array("hexrgb" => array(implode("", $hex), implode(",", $dec)),
                            "rgbhex" => array(implode(",", $dec), "#".implode("", $hex)));
              $nahoda = array_rand($rand); //nahodny index pole
              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_nahoda_barvy_{$nahoda}"], $rand[$nahoda][0]); //zobrazit
              $result[1] = $rand[$nahoda][1]; //vysledek
            break;
          }
        break;

        case "derivace":
          //var_dump($result);
          //neni tak akutni!
        break;
      }
    }

    return $result;
  }

/**
 *
 * Externe volana funkce pro vypis samotneho captcha kodu
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicCaptcha", "CaptchaKod", 1|$idcaptcha[, $slovo, $tvar]);
 *
 * @param id identifikator captcha kodu
 * @param slovo slovo na vygenerovani, nepovinne
 * @param tvar cislo tvaru
 * @return link na obrazek, s obrazkem captcha kodu
 */
  public function CaptchaKod($id, $slovo = null, $tvar = 1)
  {
    $id = (int)$id;
    //pokud je slovo prazdne tak si vygeneruje vlastni
    if (Empty($slovo))
    {
      $slovo = $this->GenerujNahodneSlovo($id);
    }
    //slovo: [0] vystupni text, [1] ocekavany vysledek
    //inicializace slova a vysledku do session a posledniho slova pro prime pouziti
    $_SESSION["slovo_{$id}_lastsolve"] = $this->NotEmpty("session", "slovo_{$id}_solve"); //ulozeni posledni hodnoty
    $_SESSION["slovo_{$id}"] = $slovo;  //vlozi cele pole
    $_SESSION["slovo_{$id}_solve"] = $slovo[1]; //a zde jen vysledek
//dodelat!! dokontrolovat!
    $result = "";
    //vypise otazku captchy
    if ($otazka = $this->querySingle("SELECT otazka FROM {$this->dbpredpona}captcha WHERE id={$id};"))
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_captcha_kod_{$tvar}"],
                                          $otazka,
                                          $id,
                                          "{$this->absolutni_url}?{$this->get_captcha}={$this->imgcreare}&amp;{$this->id_obr}={$id}");
    }

    return $result;
  }

/**
 *
 * Externe volana funkce upravu slova do kodu
 *
 * pouziti:
 * $slovo = $this->var->main[0]->NactiFunkci("DynamicCaptcha", "UpravSlovo", $slovo);
 *
 * @param slovo plny tvar slova
 * @return samotne slovo dulezite pro vypis
 */
  public function UpravSlovo($slovo)
  {
    $result = $slovo[1];  //vraci vysledek

    return $result;
  }

/**
 *
 * Osetruje nebezpecne znaky v nazvu
 *
 * @param jmeno nazev souboru
 * @return osetreny nazev
 */
  private function OsetriJmenoSouboru($jmeno)
  {
    $result = $this->RewritePrepis($jmeno);

    return $result;
  }

/**
 *
 * Vypis typu captcha kodu
 *
 * @param id identifikator polozky, nepovinny
 * @return vyber typu
 */
  private function VyberTypu($id, $adresa, $konfigurace = NULL)
  {
    //prochazeni typu polozek
    $row = array();
    foreach ($this->typkodu as $index => $polozka)
    {
      $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_row"],
                                        $index,
                                        ($id == $index ? " selected=\"selected\"" : ""),
                                        $polozka[0]);
    }
    //rozdeleni nactene konfigurace na pole
    $konfigurace = explode($this->cfgexplode, $konfigurace);
    //zobrazeni potrebne konfigurace
    $res = "";
    switch ($id)
    {
      case "pismena":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_pismena_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);

        $res = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_pismena"],
                                        ($hodnota[0] == "small" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "large" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "smalllarge" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "number" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "numbersmall" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "numberlarge" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "rand" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "special" ? " checked=\"checked\"" : ""),
                                        $hodnota[1]);
      break;

      case "priklady":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_priklady_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);

        $res = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_priklady"],
                                        ($hodnota[0] == "plus" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "minus" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "plusminus" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "nasobeni" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "deleni" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "nasobenideleni" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "modulo" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "mocniny" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "odmocniny" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "mocninyodmocniny" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "rand" ? " checked=\"checked\"" : ""),
                                        $hodnota[1],
                                        $hodnota[2],
                                        $hodnota[3],
                                        $hodnota[4]);
      break;

      case "rimske":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_rimske_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);

        $res = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_rimske"],
                                        ($hodnota[0] == "arabrim" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "rimarab" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "rand" ? " checked=\"checked\"" : ""),
                                        $hodnota[1],
                                        $hodnota[2]);
      break;

      case "vlastni":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_vlastni_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);
        list($key, $hod) = $this->RozdelitHodnoty($hodnota, 2);
        //natypovani poctu
        settype($hodnota[0], "integer");
        $res = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_vlastni"],
                                        $hodnota[0],
                                        implode("', '", $key),
                                        implode("', '", $hod));
      break;

      case "prevody":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_prevody_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);

        $res = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_prevody"],
                                        ($hodnota[0] == "bindec" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "binoct" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "binhex" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "octdec" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "octbin" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "octhex" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "hexdec" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "hexoct" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "hexbin" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "decbin" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "decoct" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "dechex" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "rand" ? " checked=\"checked\"" : ""),
                                        $hodnota[1],
                                        $hodnota[2]);
      break;

      case "barvy":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_barvy_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);

        $res = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_barvy"],
                                        ($hodnota[0] == "hexrgb" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "rgbhex" ? " checked=\"checked\"" : ""),
                                        ($hodnota[0] == "rand" ? " checked=\"checked\"" : ""));
      break;

      case "derivace":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_derivace_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);

        $res = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_derivace"],
                                        ($hodnota[0] == "hexrgb" ? " checked=\"checked\"" : ""),
                                        "?? dodelat!! ??");
      break;

      default:
        $res = $this->unikatni["admin_vyber_typu_null"];
      break;
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu"],
                                        $adresa,
                                        implode("", $row),
                                        $res);

    return $result;
  }

/**
 *
 * Vrati select pro vyber z fontu
 *
 * @param id identifikator polozky, nepovinne
 * @return vyber fontu
 */
  private function VyberFontu($id = NULL)
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, url FROM {$this->dbpredpona}font ORDER BY id ASC;"))
    {
      //vypis fontu
      $row = array();
      foreach ($res as $data)
      {
        if (file_exists("{$this->dirpath}/{$this->dirfont}/{$data->url}"))
        {
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_fontu_row"],
                                            $data->id,
                                            ($id == $data->id ? " selected=\"selected\"" : ""),
                                            $data->nazev);
        }
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_fontu"],
                                          implode("", $row));
    }
      else
    {
      $result = $this->unikatni["admin_vyber_fontu_null"];
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
 * Vygeneruje nahled fontu
 *
 * @param tmp vstupni font
 * @param &nazev vraci pres parametr nazev
 * @return vraci info bool o tim jestli se podarilo uloadovat
 */
  private function ZpracujNahledFontu($tmp, &$nazev, $resave = false)
  {
    $mezinaz = explode(".", $tmp["name"]); //rozdeleni na koncovku a jmeno
    $holejmeno = ($resave ? $mezinaz[0] : "{$this->VytvorJmenoObrazku()}_{$this->OsetriJmenoSouboru($mezinaz[0])}");
    $jmeno = "{$holejmeno}.ttf";

    if (!$resave)
    {
      if (strtolower($mezinaz[count($mezinaz) - 1]) == "ttf" && !move_uploaded_file($tmp["tmp_name"], "{$this->dirpath}/{$this->dirfont}/{$jmeno}"))
      {
        $this->ErrorMsg($tmp["error"], array(__LINE__, __METHOD__));
      }
    }

    $wrap = $this->unikatni["set_nahled_zalomit"];
    $text = wordwrap(html_entity_decode($this->unikatni["set_nahled_text"], NULL, "UTF-8"), $wrap);

    $font_size = $this->unikatni["set_nahled_size"];
    $font_file = "{$this->dirpath}/{$this->dirfont}/{$jmeno}";
    $bbox = imagettfbbox($font_size, 0, $font_file, $text);
    //nacitani paddingu TOP RIGHT BOTTOM LEFT
    $padding = $this->unikatni["set_nahled_padding"];
    $p_top = $padding[0];
    $p_right = $padding[1];
    $p_bottom = $padding[2];
    $p_left = $padding[3];
    //redeklarace typu pro jistotu
    settype($p_top, "integer");
    settype($p_right, "integer");
    settype($p_bottom, "integer");
    settype($p_left, "integer");

    //vypocet sirky a vysky
    $width = abs(($bbox[2] + $p_right) - ($bbox[0] - $p_left));
    $height = abs(($bbox[7] - $p_top) - ($bbox[1] + $p_bottom));

    //generovani nahledu
    $im = imagecreatetruecolor($width, $height);
    list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->unikatni["set_barva_pozadi"]);
    $pozadi = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy
    imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $pozadi);  //vyplneni pozadi barvou
    list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->unikatni["set_barva_fontu"]);
    $color_font = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy

    //vypocet x a y pozice
    $pos_x = abs($bbox[6] - $p_left); //levy horni roh
    $pos_y = abs($bbox[7] - $p_top);
    imagettftext($im, $font_size, 0, $pos_x, $pos_y, $color_font, $font_file, $text);
    $result = imagepng($im, "{$this->dirpath}/{$this->dirprew}/{$jmeno}");
    $nazev = $jmeno;

    return $result;
  }

/**
 *
 * Hlavni administrace obsahu modulu
 *
 * @return hlavni adminstrace modulu
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addfont"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfont" : ""),
                                        $this->AdminVypisObsah());

    //vytvari potrebne slozky
    $this->ControlCreateDir(array(array($this->dirpath, $this->dirfont),
                                  array($this->dirpath, $this->dirpic),
                                  array($this->dirpath, $this->dirprew)));

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addfont": //pridavani fontu
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditfont"],
                                              $this->unikatni["admin_addeditfont_add"],
                                              "",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $ob = false;
          $url = "";
          if (!Empty($_FILES["font"]["tmp_name"]))
          {
            $ob = $this->ZpracujNahledFontu($_FILES["font"], $url);
          }

          if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                        "url" => array("self", "string", $url)),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && $ob),
                                array("insert", "font", NULL)))
          {
            $url = $this->VypisPolozky("url", "font");
            //synchronizace
            $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirfont}" => $url,
                                                    "{$this->dirpath}/{$this->dirprew}" => $url));

            $result = $this->Hlaska("add", array($_POST["nazev"], $navic));
            $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editfont":  //editace fontu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT nazev, url FROM {$this->dbpredpona}font WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditfont"],
                                                $this->unikatni["admin_addeditfont_edit"],
                                                $data->nazev,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            $ob = false;
            $url = "";
            if (!Empty($_FILES["font"]["tmp_name"]))
            {
              $ob = $this->ZpracujNahledFontu($_FILES["font"], $url);
            }
              else
            {
              if (!Empty($_POST["tlacitko"]))
              {
                $tmp["tmp_name"] = "{$this->dirpath}/{$this->dirfont}/{$data->url}";
                $tmp["name"] = $data->url;
                $ob = $this->ZpracujNahledFontu($tmp, $url, true);
              }
            }

            if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                          "url" => array("self", "string", $url)),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && $ob && $id > 0),
                                  array("update", "font", $id)))
            {
              $url = $this->VypisPolozky("url", "font");
              //synchronizace
              $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirfont}" => $url,
                                                      "{$this->dirpath}/{$this->dirprew}" => $url));

              $result = $this->Hlaska("edit", array($_POST["nazev"], $navic));
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "delfont": //mazani fontu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array ("font" => array("id", $id, "nazev"),
                                              "captcha" => array("font")), $nazev))
          {
            $url = $this->VypisPolozky("url", "font");
            //synchronizace
            $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirfont}" => $url,
                                                    "{$this->dirpath}/{$this->dirprew}" => $url));

            $result = $this->Hlaska("del", array($nazev, $navic));
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "addcap": //pridavani captcha kodu
          $font = $_GET["font"];
          settype($font, "integer");

          $defaultni = $this->unikatni["admin_addcap_default"];

          $tlpodm = (!Empty($_POST["tlacitko"]));

          $width = ($tlpodm ? $_POST["width"] : $defaultni["width"]);
          $height = ($tlpodm ? $_POST["height"] : $defaultni["height"]);
          $font_size = ($tlpodm ? $_POST["font_size"] : $defaultni["font_size"]);
          $font_color = ($tlpodm ? $_POST["font_color"] : $defaultni["font_color"]);
          $background_color = ($tlpodm ? $_POST["background_color"] : $defaultni["background_color"]);
          $rotace_pismen = ($tlpodm ? $_POST["rotace_pismen"] : $defaultni["rotace_pismen"]);
          $mrizka = ($tlpodm ? $_POST["mrizka"] : $defaultni["mrizka"]);
          $rand_dot = ($tlpodm ? $_POST["rand_dot"] : $defaultni["rand_dot"]);
          $rand_line = ($tlpodm ? $_POST["rand_line"] : $defaultni["rand_line"]);
          $rand_rectangle = ($tlpodm ? $_POST["rand_rectangle"] : $defaultni["rand_rectangle"]);
          $rand_arc = ($tlpodm ? $_POST["rand_arc"] : $defaultni["rand_arc"]);
          $rand_ellipse = ($tlpodm ? $_POST["rand_ellipse"] : $defaultni["rand_ellipse"]);
          $rand_koeficient = ($tlpodm ? $_POST["rand_koeficient"] : $defaultni["rand_koeficient"]);
          $rand_barva = ($tlpodm ? $_POST["rand_barva"] : $defaultni["rand_barva"]);

          $url = "";
          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $mezinaz = explode(".", $_FILES["obrazek"]["name"]); //rozdeleni na koncovku a jmeno
            $holejmeno = "{$this->VytvorJmenoObrazku()}_{$this->OsetriJmenoSouboru($mezinaz[0])}";
            $url = "{$holejmeno}.".strtolower($mezinaz[count($mezinaz) - 1]);

            if ((strtolower($mezinaz[count($mezinaz) - 1]) == "jpg" ||
                strtolower($mezinaz[count($mezinaz) - 1]) == "png") &&
                !move_uploaded_file($_FILES["obrazek"]["tmp_name"], "{$this->dirpath}/{$this->dirpic}/{$url}"))
            {
              $this->ErrorMsg($_FILES["obrazek"]["error"], array(__LINE__, __METHOD__));
            }
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditcap"], array("array_object",
                                              "dirpath" => $this->dirpath,
                                              "nazev" => $this->unikatni["admin_addcap_nazev"],
                                              "typ" => $this->VyberTypu($this->NotEmpty("get", "typ"), "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;font={$font}"),  //$val_konfigurace
                                              "otazka" => ($tlpodm ? $_POST["otazka"] : $defaultni["otazka"]),
                                              "x" => ($tlpodm ? $_POST["x"] : $defaultni["x"]),
                                              "y" => ($tlpodm ? $_POST["y"] : $defaultni["y"]),
                                              "with_height_0_check" => (!Empty($width) && !Empty($height) ? " checked=\"checked\"" : ""),
                                              "width" => $width,
                                              "height" => $height,
                                              "with_height_1_check" => (Empty($width) && Empty($height) ? " checked=\"checked\"" : ""),
                                              "padding" => ($tlpodm ? $_POST["padding"] : $defaultni["padding"]),
                                              "font" => $this->VyberFontu($tlpodm ? $_POST["font"] : $font),
                                              "roztec" => ($tlpodm ? $_POST["roztec"] : $defaultni["roztec"]),
                                              "font_size_1_check" => (Empty($font_size[1]) ? " checked=\"checked\"" : ""),
                                              "font_size_0" => $font_size[0],
                                              "font_size_01_check" => (!Empty($font_size[0]) && !Empty($font_size[1]) ? " checked=\"checked\"" : ""),
                                              "font_size_1" => $this->NotEmpty($font_size, 1),
                                              "font_color_1_check" => (Empty($font_color[1]) ? " checked=\"checked\"" : ""),
                                              "font_color_0" => $font_color[0],
                                              "font_color_01_check" => (!Empty($font_color[0]) && !Empty($font_color[1]) ? " checked=\"checked\"" : ""),
                                              "font_color_1" => $this->NotEmpty($font_color, 1),
                                              "background_color_1_check" => (!Empty($background_color) ? " checked=\"checked\"" : ""),
                                              "background_color" => $background_color,
                                              "background_color_0_check" => (Empty($background_color) ? " checked=\"checked\"" : ""),
                                              "url" => "{$this->dirpath}/{$this->dirpic}/{$url}",
                                              "vyrez_x" => ($tlpodm ? $_POST["vyrez_x"] : $defaultni["vyrez_x"]),
                                              "vyrez_y" => ($tlpodm ? $_POST["vyrez_y"] : $defaultni["vyrez_y"]),
                                              "rotace_pismen_1_check" => (!isset($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                              "rotace_pismen_0" => $rotace_pismen[0],
                                              "rotace_pismen_01_check" => (isset($rotace_pismen[0]) && isset($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                              "rotace_pismen_1" => $this->NotEmpty($rotace_pismen, 1),
                                              "mrizka_0_check" => ($mrizka[0] != 0 ? " checked=\"checked\"" : ""),
                                              "mrizka_1_check" => ($mrizka[0] == 1 ? " checked=\"checked\"" : ""),
                                              "mrizka_2_check" => ($mrizka[0] == 2 ? " checked=\"checked\"" : ""),
                                              "mrizka_3_check" => ($mrizka[0] == 3 ? " checked=\"checked\"" : ""),
                                              "mrizka_4_check" => ($mrizka[0] == 4 ? " checked=\"checked\"" : ""),
                                              "mrizka_5_check" => ($mrizka[0] == 5 ? " checked=\"checked\"" : ""),
                                              "mrizka_6_check" => ($mrizka[0] == 6 ? " checked=\"checked\"" : ""),
                                              "mrizka_7_check" => ($mrizka[0] == 7 ? " checked=\"checked\"" : ""),
                                              "mrizka_x" => $mrizka[1],
                                              "mrizka_y" => $mrizka[2],
                                              "rand_dot_check" => ($rand_dot ? " checked=\"checked\"" : ""),
                                              "rand_line_check" => ($rand_line ? " checked=\"checked\"" : ""),
                                              "rand_rectangle_check" => ($rand_rectangle ? " checked=\"checked\"" : ""),
                                              "rand_arc_check" => ($rand_arc ? " checked=\"checked\"" : ""),
                                              "rand_ellipse_check" => ($rand_ellipse ? " checked=\"checked\"" : ""),
                                              "rand_koeficient_1_check" => (Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""),
                                              "rand_koeficient_0" => $rand_koeficient[0],
                                              "rand_koeficient_01_check" => (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""),
                                              "rand_koeficient_1" => $this->NotEmpty($rand_koeficient, 1),
                                              "rand_barva_1_check" => (Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                              "rand_barva_0" => $rand_barva[0],
                                              "rand_barva_01_check" => (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                              "rand_barva_1" => $this->NotEmpty($rand_barva, 1),
                                              "rand_barva_10_check" => (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                              "funct_with_height" => (!Empty($width) && !Empty($height) ? "with_height_1();" : "with_height_2();"),
                                              "func_font_size" => (!Empty($font_size[0]) && !Empty($font_size[1]) ? "font_size_2();" : "font_size_1();"),
                                              "func_font_color" => (!Empty($font_color[0]) && !Empty($font_color[1]) ? "font_color_2();" : "font_color_1();"),
                                              "func_background_color" => (!Empty($background_color) ? "pozadi_1();" : "pozadi_2();"),
                                              "func_rotace_pismen" => (!Empty($rotace_pismen[0]) && !Empty($rotace_pismen[1]) ? "font_rotace_2();" : "font_rotace_1();"),
                                              "func_mrizka" => (Empty($mrizka[0]) ? "mrizka(true);" : "mrizka(false);"),
                                              "func_rand" => ($rand_dot || $rand_line || $rand_rectangle || $rand_arc || $rand_ellipse ? "rand(true);" : "rand(false);"),
                                              "func_rand_koeficient" => (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? "rand_koeficient_2();" : "rand_koeficient_1();"),
                                              "func_rand_barva" => (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? "color_3();" : (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? "color_2();" : "color_1();")),
                                              "backlink" => "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}"));

          if ($this->ControlForm(array ("typ" => array("post", "string"),
                                        "otazka" => array("post", "string"),
                                        "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                        "x" => array("post", "integer"),
                                        "y" => array("post", "integer"),
                                        "width" => array("post", "integer"),
                                        "height" => array("post", "integer"),
                                        "padding" => array("post", "string"),
                                        "font" => array("post", "integer"),
                                        "font_size" => array("post", "array", null, $this->cfgexplode),
                                        "roztec" => array("post", "integer"),
                                        "font_color" => array("post", "array", null, $this->cfgexplode),
                                        "background_color" => array("post", "string"),
                                        "rotace_pismen" => array("post", "array", null, $this->cfgexplode),
                                        "mrizka" => array("post", "array", null, $this->cfgexplode),
                                        "rand_dot" => array("post", "boolean"),
                                        "rand_line" => array("post", "boolean"),
                                        "rand_rectangle" => array("post", "boolean"),
                                        "rand_arc" => array("post", "boolean"),
                                        "rand_ellipse" => array("post", "boolean"),
                                        "rand_barva" => array("post", "array", null, $this->cfgexplode),
                                        "rand_koeficient" => array("post", "array", null, $this->cfgexplode),
                                        "url" => array("self", "string", $url),
                                        "vyrez_x" => array("post", "integer"),
                                        "vyrez_y" => array("post", "integer")),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["otazka"]) && $_POST["roztec"] > 0),
                                array("insert", "captcha", NULL)))
          {
            $url = $this->VypisPolozky("url", "captcha");
            //synchronizace
            $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirpic}" => $url));
            $result = $this->Hlaska("add", array($_POST["otazka"], $navic));
            $this->AdminAddActionLog($_POST["otazka"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editcap":  //editace captcha kodu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT id, typ, otazka, konfigurace, x, y, width, height, padding, font, font_size, roztec, font_color, background_color, rotace_pismen, mrizka, rand_dot, rand_line, rand_rectangle, rand_arc, rand_ellipse, rand_barva, rand_koeficient, url, vyrez_x, vyrez_y FROM {$this->dbpredpona}captcha WHERE id={$id};"))
          {
            $typ = (!Empty($_GET["typ"]) ? $_GET["typ"] : $data->typ);

            $font_size = explode($this->cfgexplode, $data->font_size);
            $font_color = explode($this->cfgexplode, $data->font_color);
            $rotace_pismen = explode($this->cfgexplode, $data->rotace_pismen);
            $mrizka = explode($this->cfgexplode, $data->mrizka);
            $rand_koeficient = explode($this->cfgexplode, $data->rand_koeficient);
            $rand_barva = explode($this->cfgexplode, $data->rand_barva);

            $url = "";
            if (!Empty($_FILES["obrazek"]["tmp_name"]))
            {
              $mezinaz = explode(".", $_FILES["obrazek"]["name"]); //rozdeleni na koncovku a jmeno
              $holejmeno = "{$this->VytvorJmenoObrazku()}_{$this->OsetriJmenoSouboru($mezinaz[0])}";
              $url = "{$holejmeno}.".strtolower($mezinaz[count($mezinaz) - 1]);

              if ((strtolower($mezinaz[count($mezinaz) - 1]) == "jpg" ||
                  strtolower($mezinaz[count($mezinaz) - 1]) == "png") &&
                  !move_uploaded_file($_FILES["obrazek"]["tmp_name"], "{$this->dirpath}/{$this->dirpic}/{$url}"))
              {
                $this->ErrorMsg($_FILES["obrazek"]["error"], array(__LINE__, __METHOD__));
              }
            }
              else
            {
              $url = (Empty($pozadi) ? $data->url : "");
            }

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditcap"], array("array_object",
                                                "dirpath" => $this->dirpath,
                                                "nazev" => $this->unikatni["admin_editcap_nazev"],
                                                "typ" => $this->VyberTypu($typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;id={$id}", $data->konfigurace),
                                                "otazka" => $data->otazka,
                                                "x" => $data->x,
                                                "y" => $data->y,
                                                "with_height_0_check" => (!Empty($data->width) && !Empty($data->height) ? " checked=\"checked\"" : ""),
                                                "width" => $data->width,
                                                "height" => $data->height,
                                                "with_height_1_check" => (Empty($data->width) && Empty($data->height) ? " checked=\"checked\"" : ""),
                                                "padding" => $data->padding,
                                                "font" => $this->VyberFontu($data->font),
                                                "roztec" => $data->roztec,
                                                "font_size_1_check" => (Empty($font_size[1]) ? " checked=\"checked\"" : ""),
                                                "font_size_0" => $font_size[0],
                                                "font_size_01_check" => (!Empty($font_size[0]) && !Empty($font_size[1]) ? " checked=\"checked\"" : ""),
                                                "font_size_1" => $font_size[1],
                                                "font_color_1_check" => (Empty($font_color[1]) ? " checked=\"checked\"" : ""),
                                                "font_color_0" => $font_color[0],
                                                "font_color_01_check" => (!Empty($font_color[0]) && !Empty($font_color[1]) ? " checked=\"checked\"" : ""),
                                                "font_color_1" => $font_color[1],
                                                "background_color_1_check" => (!Empty($data->background_color) ? " checked=\"checked\"" : ""),
                                                "background_color" => $data->background_color,
                                                "background_color_0_check" => (Empty($data->background_color) ? " checked=\"checked\"" : ""),
                                                "url" => "{$this->dirpath}/{$this->dirpic}/{$data->url}",
                                                "vyrez_x" => $data->vyrez_x,
                                                "vyrez_y" => $data->vyrez_y,
                                                "rotace_pismen_1_check" => (!isset($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                                "rotace_pismen_0" => $rotace_pismen[0],
                                                "rotace_pismen_01_check" => (isset($rotace_pismen[0]) && isset($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                                "rotace_pismen_1" => $rotace_pismen[1],
                                                "mrizka_0_check" => ($mrizka[0] != 0 ? " checked=\"checked\"" : ""),
                                                "mrizka_1_check" => ($mrizka[0] == 1 ? " checked=\"checked\"" : ""),
                                                "mrizka_2_check" => ($mrizka[0] == 2 ? " checked=\"checked\"" : ""),
                                                "mrizka_3_check" => ($mrizka[0] == 3 ? " checked=\"checked\"" : ""),
                                                "mrizka_4_check" => ($mrizka[0] == 4 ? " checked=\"checked\"" : ""),
                                                "mrizka_5_check" => ($mrizka[0] == 5 ? " checked=\"checked\"" : ""),
                                                "mrizka_6_check" => ($mrizka[0] == 6 ? " checked=\"checked\"" : ""),
                                                "mrizka_7_check" => ($mrizka[0] == 7 ? " checked=\"checked\"" : ""),
                                                "mrizka_x" => $mrizka[1],
                                                "mrizka_y" => $mrizka[2],
                                                "rand_dot_check" => ($data->rand_dot ? " checked=\"checked\"" : ""),
                                                "rand_line_check" => ($data->rand_line ? " checked=\"checked\"" : ""),
                                                "rand_rectangle_check" => ($data->rand_rectangle ? " checked=\"checked\"" : ""),
                                                "rand_arc_check" => ($data->rand_arc ? " checked=\"checked\"" : ""),
                                                "rand_ellipse_check" => ($data->rand_ellipse ? " checked=\"checked\"" : ""),  //45
                                                "rand_koeficient_1_check" => (Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""),
                                                "rand_koeficient_0" => $rand_koeficient[0],
                                                "rand_koeficient_01_check" => (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""), //45
                                                "rand_koeficient_1" => $rand_koeficient[1],
                                                "rand_barva_1_check" => (Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),  //50
                                                "rand_barva_0" => $rand_barva[0],
                                                "rand_barva_01_check" => (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                "rand_barva_1" => $rand_barva[1],
                                                "rand_barva_10_check" => (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                "funct_with_height" => (!Empty($data->width) && !Empty($data->height) ? "with_height_1();" : "with_height_2();"),
                                                "func_font_size" => (!Empty($font_size[0]) && !Empty($font_size[1]) ? "font_size_2();" : "font_size_1();"), //55
                                                "func_font_color" => (!Empty($font_color[0]) && !Empty($font_color[1]) ? "font_color_2();" : "font_color_1();"),
                                                "func_background_color" => (!Empty($data->background_color) ? "pozadi_1();" : "pozadi_2();"),
                                                "func_rotace_pismen" => (!Empty($rotace_pismen[0]) && !Empty($rotace_pismen[1]) ? "font_rotace_2();" : "font_rotace_1();"),
                                                "func_mrizka" => (Empty($mrizka[0]) ? "mrizka(true);" : "mrizka(false);"),
                                                "func_rand" => ($data->rand_dot || $data->rand_line || $data->rand_rectangle || $data->rand_arc || $data->rand_ellipse ? "rand(true);" : "rand(false);"),  //60
                                                "func_rand_koeficient" => (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? "rand_koeficient_2();" : "rand_koeficient_1();"),
                                                "func_rand_barva" => (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? "color_3();" : (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? "color_2();" : "color_1();")), //62
                                                "backlink" => "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}"));

            if ($this->ControlForm(array ("typ" => array("post", "string"),
                                          "otazka" => array("post", "string"),
                                          "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                          "x" => array("post", "integer"),
                                          "y" => array("post", "integer"),
                                          "width" => array("post", "integer"),
                                          "height" => array("post", "integer"),
                                          "padding" => array("post", "string"),
                                          "font" => array("post", "integer"),
                                          "font_size" => array("post", "array", null, $this->cfgexplode),
                                          "roztec" => array("post", "integer"),
                                          "font_color" => array("post", "array", null, $this->cfgexplode),
                                          "background_color" => array("post", "string"),
                                          "rotace_pismen" => array("post", "array", null, $this->cfgexplode),
                                          "mrizka" => array("post", "array", null, $this->cfgexplode),
                                          "rand_dot" => array("post", "boolean"),
                                          "rand_line" => array("post", "boolean"),
                                          "rand_rectangle" => array("post", "boolean"),
                                          "rand_arc" => array("post", "boolean"),
                                          "rand_ellipse" => array("post", "boolean"),
                                          "rand_barva" => array("post", "array", null, $this->cfgexplode),
                                          "rand_koeficient" => array("post", "array", null, $this->cfgexplode),
                                          "url" => array("self", "string", $url),
                                          "vyrez_x" => array("post", "integer"),
                                          "vyrez_y" => array("post", "integer")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["otazka"]) && $_POST["roztec"] > 0 && $id > 0),
                                  array("update", "captcha", $id)))
            {
              $url = $this->VypisPolozky("url", "captcha");
              //synchronizace
              $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirpic}" => $url));
              $result = $this->Hlaska("edit", array($_POST["otazka"], $navic));
              $this->AdminAddActionLog($_POST["otazka"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "delcap": //mazani captcha kodu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($this->ControlDeleteForm(array ("captcha" => array("id", $id, "otazka")), $nazev))
          {
            $url = $this->VypisPolozky("url", "captcha");
            //synchronizace
            $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirpic}" => $url));
            $result = $this->Hlaska("del", array($nazev, $navic));
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis administrace obsahu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisObsah()
  {
    $result = "";
    //vypis fontu
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, url FROM {$this->dbpredpona}font ORDER BY id ASC;"))
    {
      foreach ($res as $data)
      {
        $row = array();
        //vypis captcha kodu
        if ($res1 = $this->queryMultiObjectSingle("SELECT id, typ, otazka, konfigurace
                                                  FROM {$this->dbpredpona}captcha
                                                  WHERE font={$data->id} ORDER BY id ASC;"))
        {
          //vypis captcha
          foreach ($res1 as $data1)
          { //parsnuti konfigurace
            $konfigurace = explode($this->cfgexplode, $data1->konfigurace);
            $slovo = $this->GenerujNahodneSlovo($data1->id);
            $hash = rawurlencode(base64_encode($slovo[0]));
            $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_row"],
                                              $data1->id,
                                              $this->typkodu[$data1->typ][0],  //vypis typu a subtypu
                                              $this->typkodu[$data1->typ][$konfigurace[0]],  //vypis typu a subtypu
                                              $data1->otazka, //4
                                              "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->get_captcha}={$this->imgcreare}&amp;{$this->id_obr}={$data1->id}&amp;selfword={$hash}",
                                              $slovo[1],  //6
                                              ($this->localpermit[$_GET[$this->var->get_idmodul]]["editcap"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editcap&amp;id={$data1->id}" : ""),
                                              ($this->localpermit[$_GET[$this->var->get_idmodul]]["delcap"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delcap&amp;id={$data1->id}" : ""));
          }
        }
          else
        {
          $row[] = $this->unikatni["admin_vypis_obsah_row_null"];
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            $data->id,
                                            $data->nazev,
                                            $data->url,
                                            "{$this->dirpath}/{$this->dirprew}/{$data->url}",
                                            (file_exists("{$this->dirpath}/{$this->dirfont}/{$data->url}") ? "true" : "false"),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["editfont"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfont&amp;id={$data->id}" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["delfont"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfont&amp;id={$data->id}" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["addcap"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addcap&amp;font={$data->id}" : ""),
                                            implode("", $row));
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_obsah_null"];
    }

    return $result;
  }


}
?>
