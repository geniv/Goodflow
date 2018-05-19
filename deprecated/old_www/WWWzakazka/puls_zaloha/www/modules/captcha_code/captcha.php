<?php

/**
 *
 * Blok captcha kodu
 *
 */

class CaptchaCode extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona;
  public $idmodul = "dyncapt";
  public $mount = array("");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze

  private $dirfont = "fonty";
  private $dirprew = "nahledy";
  private $dirpic = "pozadi";
  private $defaultpic = "default";
  private $korekceobr = 10; //+px

  private $cfgexplode = "|--|"; //rozdelovac nastaveni

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

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index);
      if (!$this->PripojeniDatabaze($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $this->Instalace();

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
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}captcha (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    typ VARCHAR(50),
                                    otazka VARCHAR(500),
                                    pocet INTEGER UNSIGNED,
                                    x INTEGER UNSIGNED,
                                    y INTEGER UNSIGNED,
                                    width INTEGER UNSIGNED,
                                    height INTEGER UNSIGNED,
                                    font INTEGER UNSIGNED,
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

                                  CREATE TABLE {$this->dbpredpona}captcha_font (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    nazev VARCHAR(100),
                                    url VARCHAR(300));", $error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }
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
    if ($_GET[$this->get_captcha] == $this->imgcreare &&
        !Empty($_GET[$this->id_obr]) &&
        Empty($_GET["co"]))
    {
      $id = $_GET[$this->id_obr];  //prepina mezi naplnovani a vykreslovanim
      settype($id, "integer");

      //detekce adminu, pri true si generuje slova sam
      $admin = ($_GET[$this->var->get_kam] == $this->var->adresaadminu);

      $result = "";
      if ($data = $this->querySingleRow("SELECT
                                        id, typ, otazka, x, y, width, height, font,
                                        font_size, roztec, font_color, background_color,
                                        rotace_pismen, mrizka, rand_dot, rand_line,
                                        rand_rectangle, rand_arc, rand_ellipse,
                                        rand_barva, rand_koeficient, url, vyrez_x, vyrez_y
                                        FROM {$this->dbpredpona}captcha WHERE id={$id};", $error))
      { //vygenerovani pole pro predani do generovaci funkce
        $captcha["slovo"] = ($admin ? $this->GenerujNahodneSlovo($id) : $_SESSION["slovo_{$id}"]);
        $captcha["x"] = $data->x;
        $captcha["y"] = $data->y;
        $captcha["width"] = $data->width;
        $captcha["height"] = $data->height;
        $captcha["font"] = "{$this->dirpath}/{$this->dirfont}/{$this->VypisHodnotu("url", "captcha_font", $data->font)}";
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
          if (!Empty($error))
          {
            $this->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
            else
          {
            if ($_GET[$this->get_captcha] == $this->imgcreare &&
                !Empty($_GET[$this->id_obr]))
            {
              header("Content-type: image/png");
              $cesta = "{$this->dirpath}/{$this->defaultpic}.png";
              $u = fopen($cesta, "r");
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

    //blok autosize zpracovani
    $autosize = false;
    if ($width == 0 &&
        $height == 0)
    { //provedeni autosize vypoctu
      $autotext = $nastaveni["slovo"][0]; //bere rovnou pole
      $bbox = imagettfbbox($size[0], $rotace[0], $nastaveni["font"], $autotext);

      $width = abs($bbox[2] - $bbox[0]);
      $height = abs($bbox[7] - $bbox[1]);

      $pos_x = abs($bbox[6]); //levy horni roh
      $pos_y = abs($bbox[7]);
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
    $pismena = str_split($nastaveni["slovo"][0], 1);
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
 * @return
 */
  public function GenerujNahodneSlovo($id)
  {
    settype($id, "integer");

    $male = str_split($this->unikatni["admin_slovo_lower"], 1);
    $velke = str_split($this->unikatni["admin_slovo_upper"], 1);
    $cisla = str_split($this->unikatni["admin_slovo_num"], 1);

    $bin = str_split($this->unikatni["admin_slovo_bin"], 1);
    $hex = str_split($this->unikatni["admin_slovo_hex"], 1);
    $oct = str_split($this->unikatni["admin_slovo_oct"], 1);
    $znamenko = str_split($this->unikatni["admin_slovo_znamenka"], 1);

    $result = "";
    //vyber z db typ a pocet
    if ($data = $this->querySingleRow("SELECT typ, pocet FROM {$this->dbpredpona}captcha WHERE id={$id};", $error))
    {
      $cislice = range(0, $data->pocet);
      $pocet = $data->pocet;
      $typ = $data->typ;
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    if (!Empty($typ))
    {
      switch ($typ)
      {
        case "smalltext": //text - male
          for ($i = 0; $i < $pocet; $i++)
          {
            $zn = $male[array_rand($male)];
            $result[0] .= $zn;
            $result[1] .= $zn;
          }
        break;

        case "largetext": //text - velke
          for ($i = 0; $i < $pocet; $i++)
          {
            $zn = $velke[array_rand($velke)];
            $result[0] .= $zn;
            $result[1] .= $zn;
          }
        break;

        case "randtext": //text - konbinace
          for ($i = 0; $i < $pocet; $i++)
          {
            switch (rand(0, 1))
            {
              case 0: //male
                $zn = $male[array_rand($male)];
                $result[0] .= $zn;
                $result[1] .= $zn;
              break;

              case 1: //velke
                $zn = $velke[array_rand($velke)];
                $result[0] .= $zn;
                $result[1] .= $zn;
              break;
            }
          }
        break;

        case "number": //cisla
          for ($i = 0; $i < $pocet; $i++)
          {
            $zn = $cisla[array_rand($cisla)];
            $result[0] .= $zn;
            $result[1] .= $zn;
          }
        break;

        case "smalltextnumber": //text a cisla - male
          for ($i = 0; $i < $pocet; $i++)
          {
            switch (rand(0, 1))
            {
              case 0: //male
                $zn = $male[array_rand($male)];
                $result[0] .= $zn;
                $result[1] .= $zn;
              break;

              case 1: //cislo
                $zn = $cisla[array_rand($cisla)];
                $result[0] .= $zn;
                $result[1] .= $zn;
              break;
            }
          }
        break;

        case "largetextnumber": //text a cisla - velke
          for ($i = 0; $i < $pocet; $i++)
          {
            switch (rand(0, 1))
            {
              case 0: //velke
                $zn = $velke[array_rand($velke)];
                $result[0] .= $zn;
                $result[1] .= $zn;
              break;

              case 1: //cislo
                $zn = $cisla[array_rand($cisla)];
                $result[0] .= $zn;
                $result[1] .= $zn;
              break;
            }
          }
        break;

        case "randtextnumber": //text a cisla - kombinace
          for ($i = 0; $i < $pocet; $i++)
          {
            switch (rand(0, 2))
            {
              case 0: //male
                $zn = $male[array_rand($male)];
                $result[0] .= $zn;
                $result[1] .= $zn;
              break;

              case 1: //velke
                $zn = $velke[array_rand($velke)];
                $result[0] .= $zn;
                $result[1] .= $zn;
              break;

              case 2: //cislo
                $zn = $cisla[array_rand($cisla)];
                $result[0] .= $zn;
                $result[1] .= $zn;
              break;
            }
          }
        break;

        case "examinc": //priklad +
          $cislo1 = $cisla[array_rand($cisla)];
          $cislo2 = $cisla[array_rand($cisla)];
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examinc"], $cislo1, $cislo2);
          $result[1] = $cislo1 + $cislo2;
        break;

        case "examdec": //priklad -
          $cislo1 = $cisla[array_rand($cisla)];
          $cislo2 = $cisla[array_rand($cisla)];
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examdec"], $cislo1, $cislo2);
          $result[1] = $cislo1 - $cislo2;
        break;

        case "examincdec": //priklad +&-
          $cislo1 = $cisla[array_rand($cisla)];
          $cislo2 = $cisla[array_rand($cisla)];
          $zmanenko = $znamenko[rand(0, 1)];
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examincdec"], $cislo1, $zmanenko, $cislo2);

          switch ($zmanenko)
          {
            case "+":
              $result[1] = $cislo1 + $cislo2;
            break;

            case "-":
              $result[1] = $cislo1 - $cislo2;
            break;
          }
        break;

        case "exammul": //priklad *
          $cislo1 = $cisla[array_rand($cisla)];
          $cislo2 = $cisla[array_rand($cisla)];
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_exammul"], $cislo1, $cislo2);
          $result[1] = $cislo1 * $cislo2;
        break;

        case "examincdecmul": //priklad kombinace
          $cislo1 = $cisla[array_rand($cisla)];
          $cislo2 = $cisla[array_rand($cisla)];
          $zmanenko = $znamenko[array_rand($znamenko)];
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examincdecmul"], $cislo1, $zmanenko, $cislo2);

          switch ($zmanenko)
          {
            case "+":
              $result[1] = $cislo1 + $cislo2;
            break;

            case "-":
              $result[1] = $cislo1 - $cislo2;
            break;

            case "*":
              $result[1] = $cislo1 * $cislo2;
            break;
          }
        break;

        case "exampow":  //mocnina
          $cislo1 = $cisla[array_rand($cisla)];
          $cislo2 = $cisla[array_rand($cisla)];
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_exampow"], $cislo1, $cislo2);

          $result[1] = pow($cislo1, $cislo2);
        break;

        case "exambindec":  //bin->dec
          $cislo = "";
          for ($i = 0; $i < $pocet; $i++)
          {
            $cislo .= $bin[array_rand($bin)];
          }
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_exambindec"], $cislo);

          $result[1] = bindec($cislo);
        break;

        case "examdecbin":  //dec->bin
          $cislo = $cislice[array_rand($cislice)];
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examdecbin"], $cislo);

          $result[1] = decbin($cislo);
        break;

        case "examoctdec":  //oct->dec
          $cislo = "";
          for ($i = 0; $i < $pocet; $i++)
          {
            $cislo .= $oct[array_rand($oct)];
          }
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examoctdec"], $cislo);

          $result[1] = octdec($cislo);
        break;

        case "examdecoct":  //dec->oct
          $cislo = $cislice[array_rand($cislice)];
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examdecoct"], $cislo);

          $result[1] = decoct($cislo);
        break;

        case "examhexdex":  //hex->dec
          $cislo = "";
          for ($i = 0; $i < $pocet; $i++)
          {
            $cislo .= $hex[array_rand($hex)];
          }
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examhexdex"], $cislo);

          $result[1] = hexdec($cislo);
        break;

        case "examdechex":  //dec->hex
          $cislo = $cislice[array_rand($cislice)];
          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examdechex"], $cislo);

          $result[1] = dechex($cislo);
        break;

        case "examrandconv":  //kombinace dec<-> oct, bin, hex
          $cislice = range(0, 100); //lokalni nastaveni cislic

          switch (rand(0, 5))
          {
            case 0: //bin->dec
              $cislo = "";
              for ($i = 0; $i < $pocet; $i++)
              {
                $cislo .= $bin[array_rand($bin)];
              }
              $tvar = "exambindec";

              $result[1] = bindec($cislo);
            break;

            case 1: //dec->bin
              $cislo = $cislice[array_rand($cislice)];
              $tvar = "examdecbin";

              $result[1] = decbin($cislo);
            break;

            case 2: //oct->dec
              $cislo = "";
              for ($i = 0; $i < $pocet; $i++)
              {
                $cislo .= $oct[array_rand($oct)];
              }
              $tvar = "examoctdec";

              $result[1] = octdec($cislo);
            break;

            case 3: //dec->oct
              $cislo = $cislice[array_rand($cislice)];
              $tvar = "examdecoct";

              $result[1] = decoct($cislo);
            break;

            case 4: //hex->dec
              $cislo = "";
              for ($i = 0; $i < $pocet; $i++)
              {
                $cislo .= $hex[array_rand($hex)];
              }
              $tvar = "examhexdex";

              $result[1] = hexdec($cislo);
            break;

            case 5: //dec->hex
              $cislo = $cislice[array_rand($cislice)];
              $tvar = "examdechex";

              $result[1] = dechex($cislo);
            break;
          }

          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_{$tvar}"], $cislo);
        break;

        case "examhexrgb":  //#XXXXXX->RGB
          $cislo = "";
          for ($i = 0; $i < 6; $i++)
          {
            $cislo .= $cisla[array_rand($cisla)];
          }

          $text = str_split($cislo, 2);
          $c_text = count($text);
          for ($i = 0; $i < $c_text; $i++)
          {
            $ret[] = hexdec($text[$i]);
          }

          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examhexrgb"], $cislo);
          $result[1] = implode($this->unikatni["admin_slovo_implode"], $ret);
        break;

        case "examrgbhex":  //RGB->#XXXXXX
          for ($i = 0; $i < 3; $i++)
          {
            $rgbcislo[] = rand(0, 255);
          }
          $cislo = implode($this->unikatni["admin_slovo_implode"], $rgbcislo);

          $c_rgbcislo = count($rgbcislo);
          for ($i = 0; $i < $c_rgbcislo; $i++)
          { //osetreni kdyz je cislo mensi nez 16 tak pridava 0
            $ret .= (strlen(dechex($rgbcislo[$i])) == 1 ? "0".dechex($rgbcislo[$i]) : dechex($rgbcislo[$i]));
          }

          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examrgbhex"], $cislo);
          $result[1] = $this->NactiUnikatniObsah($this->unikatni["admin_slovo_inexamrgbhex"], $ret);
        break;

        case "examrandrgbhex":  //kombinace RGB<->#XXXXXX
          switch (rand(0, 1))
          {
            case 0: //#XXXXXX->RGB
              $cislo = "";
              for ($i = 0; $i < 6; $i++)
              {
                $cislo .= $cisla[array_rand($cisla)];
              }

              $text = str_split($cislo, 2);
              $c_text = count($text);
              for ($i = 0; $i < $c_text; $i++)
              {
                $ret[] = hexdec($text[$i]);
              }

              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examhexrgb"], $cislo);
              $result[1] = implode($this->unikatni["admin_slovo_implode"], $ret);
            break;

            case 1: //RGB->#XXXXXX
              for ($i = 0; $i < 3; $i++)
              {
                $rgbcislo[] = rand(0, 255);
              }
              $cislo = implode($this->unikatni["admin_slovo_implode"], $rgbcislo);

              $c_rgbcislo = count($rgbcislo);
              for ($i = 0; $i < $c_rgbcislo; $i++)
              { //osetreni kdyz je cislo mensi nez 16 tak pridava 0
                $ret .= (strlen(dechex($rgbcislo[$i])) == 1 ? "0".dechex($rgbcislo[$i]) : dechex($rgbcislo[$i]));
              }

              $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examrgbhex"], $cislo);
              $result[1] = $this->NactiUnikatniObsah($this->unikatni["admin_slovo_inexamrgbhex"], $ret);
            break;
          }
        break;

        case "examrandder":  //urcita derivace o libovolnem +-X
          $mocnina = rand(1, $pocet);
          $xcislo = rand(1, $pocet);
          $cislo = rand(1, $pocet);
          $x = rand(-$pocet, $pocet);
          $zmanenko = $znamenko[array_rand($znamenko)];

          $krok1 = $mocnina * $xcislo * pow($x, $mocnina - 1);
          $krok2 = ($zmanenko == "*" ? $krok1 * $cislo : $krok1);

          $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_examrandder"], $xcislo, $mocnina, $zmanenko, $cislo, $x); //; {$vypocet}
          $result[1] = $krok2;
        break;
      }

      //osetreni proti nule, rekurzi
      if (is_array($result) &&
          is_numeric($result[1]) &&
          $result[1] == 0)
      {
        $result = $this->GenerujNahodneSlovo($id);
      }
    }

    return $result;
  }

/**
 *
 * Externe volana funkce pro vypis samotneho captcha kodu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", 1|$idcaptcha[, $slovo, $tvar]);</strong>
 *
 * @param id identifikator captcha kodu
 * @param slovo slovo na vygenerovani, nepovinne
 * @param tvar cislo tvaru
 * @return link na obrazek, s obrazkem captcha kodu
 */
  public function CaptchaKod($id, $slovo = null, $tvar = 1)
  {
    settype($id, "integer");
    //pokud je slovo prazdne tak si vygeneruje vlastni
    if (Empty($slovo))
    {
      $slovo = $this->GenerujNahodneSlovo($id);
    }
    //slovo: [0] vystupni text, [1] ocekavany vysledek
    //inicializace slova a vysledku do session a posledniho slova pro prime pouziti
    $_SESSION["slovo_{$id}_lastsolve"] = $_SESSION["slovo_{$id}_solve"];  //ulozi si posledni vysledek
    $_SESSION["slovo_{$id}"] = $slovo;  //vlozi cele pole
    $_SESSION["slovo_{$id}_solve"] = $slovo[1]; //a zde jen vysledek

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
 * pouziti: <strong>$slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "UpravSlovo", $slovo);</strong>
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
  private function VypisTypu($id = NULL)
  {
    $result = $this->unikatni["admin_vypis_typu_select_begin"];
    //prochazeni typu polozek
    foreach ($this->typkodu as $index => $polozka)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_typu_select"],
                                          $index,
                                          ($id == $index ? " selected=\"selected\"" : ""),
                                          $polozka);
    }
    $result .= $this->unikatni["admin_vypis_typu_select_end"];

    return $result;
  }

/**
 *
 * Vrati select pro vyber z fontu
 *
 * @param id identifikator polozky, nepovinne
 * @return vyber fontu
 */
  private function VypisFontu($id = NULL)
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, url FROM {$this->dbpredpona}captcha_font ORDER BY id ASC;", $error))
    {
      $result = $this->unikatni["admin_vypis_fontu_select_begin"];
      //vypis fontu
      foreach ($res as $data)
      {
        if (file_exists("{$this->dirpath}/{$this->dirfont}/{$data->url}"))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_fontu_select"],
                                              $data->id,
                                              ($id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->nazev,
                                              $data->url);
        }
      }
      $result .= $this->unikatni["admin_vypis_fontu_select_end"];
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result = $this->unikatni["admin_vypis_fontu_select_null"];
      }
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

    $width = abs($bbox[2] - $bbox[0]);
    $height = abs($bbox[7] - $bbox[1]);

    //generovani nahledu
    $im = imagecreatetruecolor($width, $height);
    list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->unikatni["set_barva_pozadi"]);
    $pozadi = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy
    imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $pozadi);  //vyplneni pozadi barvou
    list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->unikatni["set_barva_fontu"]);
    $color_font = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy

    $x = abs($bbox[6]); //levy horni roh
    $y = abs($bbox[7]);
    imagettftext($im, $font_size, 0, $x, $y, $color_font, $font_file, $text);
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
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfont",
                                        $this->AdminVypisObsah());

    //vytvari potrebne slozky
    $this->ControlCreateDir(array(array($this->dirpath, $this->dirfont),
                                  array($this->dirpath, $this->dirpic),
                                  array($this->dirpath, $this->dirprew)));

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addfont": //pridavani fontu
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addfont"],
                                              $this->var->jquerycore,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $ob = false;
          if (!Empty($_FILES["font"]["tmp_name"]))
          {
            $ob = $this->ZpracujNahledFontu($_FILES["font"], $url);
          }

          if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                        "url" => array("self", "string", $url)),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && $ob),
                                array("insert", "captcha_font", NULL),
                                $error))
          {
            $url = $this->VypisPolozky("url", "captcha_font");
            //synchronizace
            $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirfont}" => $url,
                                                    "{$this->dirpath}/{$this->dirprew}" => $url));
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addfont_hlaska"], $_POST["nazev"], $navic);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editfont":  //editace fontu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT nazev, url FROM {$this->dbpredpona}captcha_font WHERE id={$id};", $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_editfont"],
                                                  $data->nazev,
                                                  $data->url,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            $ob = false;
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
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && $ob),
                                  array("update", "captcha_font", $id),
                                  $error))
            {
              $url = $this->VypisPolozky("url", "captcha_font");
              //synchronizace
              $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirfont}" => $url,
                                                      "{$this->dirpath}/{$this->dirprew}" => $url));
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editfont_hlaska"], $_POST["nazev"], $navic);

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              if (!Empty($error))
              {
                $this->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "delfont": //mazani fontu
          $id = $_GET["id"];  //cislo sekce, pripadne kontrolovat jestli je pouzity!
          settype($id, "integer");

          if ($this->VypisHodnotu("COUNT(id)", "captcha", $id, "font=") == 0)
          {
            if ($this->ControlDeleteForm(array ("captcha_font" => array("id", $id, "nazev")), $nazev, $error))
            {
              $url = $this->VypisPolozky("url", "captcha_font");
              //synchronizace
              $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirfont}" => $url,
                                                      "{$this->dirpath}/{$this->dirprew}" => $url));
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_delfont_hlaska"], $nazev, $navic);

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              if (!Empty($error))
              {
                $this->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_delfont_false_hlaska"], $this->VypisHodnotu("nazev", "captcha_font", $id));

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "addcap": //pridavani captcha kodu
          $font = $_GET["font"];
          settype($font, "integer");

          $defaultni = $this->unikatni["admin_addcap_default"];

          $tlpodm = (!Empty($_POST["tlacitko"]));

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

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditcap"],
                                              $this->var->jquerycore,
                                              $this->dirpath,
                                              $this->unikatni["admin_addcap_nazev"],
                                              $this->VypisTypu($_POST["typ"]),
                                              ($tlpodm ? $_POST["otazka"] : $defaultni["otazka"]),  //5
                                              ($tlpodm ? $_POST["pocet"] : $defaultni["pocet"]),
                                              ($tlpodm ? $_POST["x"] : $defaultni["x"]),
                                              ($tlpodm ? $_POST["y"] : $defaultni["y"]),
                                              ($tlpodm ? $_POST["width"] : $defaultni["width"]),
                                              ($tlpodm ? $_POST["height"] : $defaultni["height"]),  //10
                                              $this->VypisFontu($tlpodm ? $_POST["font"] : $font),
                                              ($tlpodm ? $_POST["roztec"] : $defaultni["roztec"]),
                                              (Empty($font_size[1]) ? " checked=\"checked\"" : ""),
                                              $font_size[0],
                                              (!Empty($font_size[0]) && !Empty($font_size[1]) ? " checked=\"checked\"" : ""), //15
                                              $font_size[1],
                                              (Empty($font_color[1]) ? " checked=\"checked\"" : ""),
                                              $font_color[0],
                                              (!Empty($font_color[0]) && !Empty($font_color[1]) ? " checked=\"checked\"" : ""),
                                              $font_color[1], //20
                                              (!Empty($background_color) ? " checked=\"checked\"" : ""),
                                              $background_color,
                                              (Empty($background_color) ? " checked=\"checked\"" : ""),
                                              "{$this->dirpath}/{$this->dirpic}/{$url}",
                                              ($tlpodm ? $_POST["vyrez_x"] : $defaultni["vyrez_x"]),  //25
                                              ($tlpodm ? $_POST["vyrez_y"] : $defaultni["vyrez_y"]),
                                              (!isset($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                              $rotace_pismen[0],
                                              (isset($rotace_pismen[0]) && isset($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                              $rotace_pismen[1],  //30
                                              ($mrizka[0] != 0 ? " checked=\"checked\"" : ""),
                                              ($mrizka[0] == 1 ? " checked=\"checked\"" : ""),
                                              ($mrizka[0] == 2 ? " checked=\"checked\"" : ""),
                                              ($mrizka[0] == 3 ? " checked=\"checked\"" : ""),
                                              ($mrizka[0] == 4 ? " checked=\"checked\"" : ""),  //35
                                              ($mrizka[0] == 5 ? " checked=\"checked\"" : ""),
                                              ($mrizka[0] == 6 ? " checked=\"checked\"" : ""),
                                              ($mrizka[0] == 7 ? " checked=\"checked\"" : ""),
                                              $mrizka[1],
                                              $mrizka[2], //40
                                              ($rand_dot ? " checked=\"checked\"" : ""),
                                              ($rand_line ? " checked=\"checked\"" : ""),
                                              ($rand_rectangle ? " checked=\"checked\"" : ""),
                                              ($rand_arc ? " checked=\"checked\"" : ""),
                                              ($rand_ellipse ? " checked=\"checked\"" : ""),  //45
                                              (Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""),
                                              $rand_koeficient[0],
                                              (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""), //45
                                              $rand_koeficient[1],
                                              (Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),  //50
                                              $rand_barva[0],
                                              (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                              $rand_barva[1],
                                              (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                              (!Empty($font_size[0]) && !Empty($font_size[1]) ? "font_size_2();" : "font_size_1();"), //55
                                              (!Empty($font_color[0]) && !Empty($font_color[1]) ? "font_color_2();" : "font_color_1();"),
                                              (!Empty($background_color) ? "pozadi_1();" : "pozadi_2();"),
                                              (!Empty($rotace_pismen[0]) && !Empty($rotace_pismen[1]) ? "font_rotace_2();" : "font_rotace_1();"),
                                              (!Empty($mrizka[0]) ? "mrizka(true);" : "mrizka(false);"),
                                              ($rand_dot || $rand_line || $rand_rectangle || $rand_arc || $rand_ellipse ? "rand(true);" : "rand(false);"),  //60
                                              (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? "rand_koeficient_2();" : "rand_koeficient_1();"),
                                              (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? "color_3();" : (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? "color_2();" : "color_1();")),  //62
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("typ" => array("post", "string"),
                                        "otazka" => array("post", "string"),
                                        "pocet" => array("post", "integer"),
                                        "x" => array("post", "integer"),
                                        "y" => array("post", "integer"),
                                        "width" => array("post", "integer"),
                                        "height" => array("post", "integer"),
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
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["otazka"]) && $_POST["pocet"] > 0 && $_POST["roztec"] > 0),
                                array("insert", "captcha", NULL),
                                $error))
          {
            $url = $this->VypisPolozky("url", "captcha");
            //synchronizace
            $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirpic}" => $url));
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addcap_hlaska"], $_POST["otazka"], $navic);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editcap":  //editace captcha kodu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT id, typ, otazka, pocet, x, y, width, height, font, font_size, roztec, font_color, background_color, rotace_pismen, mrizka, rand_dot, rand_line, rand_rectangle, rand_arc, rand_ellipse, rand_barva, rand_koeficient, url, vyrez_x, vyrez_y FROM {$this->dbpredpona}captcha WHERE id={$id};", $error))
          {
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

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditcap"],
                                                $this->var->jquerycore,
                                                $this->dirpath,
                                                $this->unikatni["admin_editcap_nazev"],
                                                $this->VypisTypu($data->typ),
                                                $data->otazka,  //5
                                                $data->pocet,
                                                $data->x,
                                                $data->y,
                                                $data->width,
                                                $data->height,  //10
                                                $this->VypisFontu($data->font),
                                                $data->roztec,
                                                (Empty($font_size[1]) ? " checked=\"checked\"" : ""),
                                                $font_size[0],
                                                (!Empty($font_size[0]) && !Empty($font_size[1]) ? " checked=\"checked\"" : ""), //15
                                                $font_size[1],
                                                (Empty($font_color[1]) ? " checked=\"checked\"" : ""),
                                                $font_color[0],
                                                (!Empty($font_color[0]) && !Empty($font_color[1]) ? " checked=\"checked\"" : ""),
                                                $font_color[1], //20
                                                (!Empty($data->background_color) ? " checked=\"checked\"" : ""),
                                                $data->background_color,
                                                (Empty($data->background_color) ? " checked=\"checked\"" : ""),
                                                "{$this->dirpath}/{$this->dirpic}/{$data->url}",
                                                $data->vyrez_x, //25
                                                $data->vyrez_y,
                                                (!isset($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                                $rotace_pismen[0],
                                                (isset($rotace_pismen[0]) && isset($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                                $rotace_pismen[1],  //30
                                                ($mrizka[0] != 0 ? " checked=\"checked\"" : ""),
                                                ($mrizka[0] == 1 ? " checked=\"checked\"" : ""),
                                                ($mrizka[0] == 2 ? " checked=\"checked\"" : ""),
                                                ($mrizka[0] == 3 ? " checked=\"checked\"" : ""),
                                                ($mrizka[0] == 4 ? " checked=\"checked\"" : ""),  //35
                                                ($mrizka[0] == 5 ? " checked=\"checked\"" : ""),
                                                ($mrizka[0] == 6 ? " checked=\"checked\"" : ""),
                                                ($mrizka[0] == 7 ? " checked=\"checked\"" : ""),
                                                $mrizka[1],
                                                $mrizka[2], //40
                                                ($data->rand_dot ? " checked=\"checked\"" : ""),
                                                ($data->rand_line ? " checked=\"checked\"" : ""),
                                                ($data->rand_rectangle ? " checked=\"checked\"" : ""),
                                                ($data->rand_arc ? " checked=\"checked\"" : ""),
                                                ($data->rand_ellipse ? " checked=\"checked\"" : ""),  //45
                                                (Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""),
                                                $rand_koeficient[0],
                                                (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""), //45
                                                $rand_koeficient[1],
                                                (Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),  //50
                                                $rand_barva[0],
                                                (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                $rand_barva[1],
                                                (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                (!Empty($font_size[0]) && !Empty($font_size[1]) ? "font_size_2();" : "font_size_1();"), //55
                                                (!Empty($font_color[0]) && !Empty($font_color[1]) ? "font_color_2();" : "font_color_1();"),
                                                (!Empty($data->background_color) ? "pozadi_1();" : "pozadi_2();"),
                                                (!Empty($rotace_pismen[0]) && !Empty($rotace_pismen[1]) ? "font_rotace_2();" : "font_rotace_1();"),
                                                (!Empty($mrizka[0]) ? "mrizka(true);" : "mrizka(false);"),
                                                ($data->rand_dot || $data->rand_line || $data->rand_rectangle || $data->rand_arc || $data->rand_ellipse ? "rand(true);" : "rand(false);"),  //60
                                                (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? "rand_koeficient_2();" : "rand_koeficient_1();"),
                                                (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? "color_3();" : (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? "color_2();" : "color_1();")), //62
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("typ" => array("post", "string"),
                                          "otazka" => array("post", "string"),
                                          "pocet" => array("post", "integer"),
                                          "x" => array("post", "integer"),
                                          "y" => array("post", "integer"),
                                          "width" => array("post", "integer"),
                                          "height" => array("post", "integer"),
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
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["otazka"]) && $_POST["pocet"] > 0 && $_POST["roztec"] > 0),
                                  array("update", "captcha", $id),
                                  $error))
            {
              $url = $this->VypisPolozky("url", "captcha");
              //synchronizace
              $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirpic}" => $url));
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editcap_hlaska"], $_POST["otazka"], $navic);

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              if (!Empty($error))
              {
                $this->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "delcap": //mazani captcha kodu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($this->ControlDeleteForm(array ("captcha" => array("id", $id, "otazka")), $nazev, $error))
          {
            $url = $this->VypisPolozky("url", "captcha");
            //synchronizace
            $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->dirpic}" => $url));
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_delfont_hlaska"], $nazev, $navic);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
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
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, url FROM {$this->dbpredpona}captcha_font ORDER BY id ASC;", $error))
    {
      //vypis fontu
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_font_begin"],
                                              $data->id,
                                              $data->nazev,
                                              $data->url,
                                              "{$this->dirpath}/{$this->dirprew}/{$data->url}",
                                              (file_exists("{$this->dirpath}/{$this->dirfont}/{$data->url}") ? "existuje" : "neexistuje"),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfont&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfont&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addcap&amp;font={$data->id}");
        //vypis captcha kodu
        if ($res1 = $this->queryMultiObjectSingle("SELECT id, typ, otazka, width, height,
                                                  font_size, font_color, background_color
                                                  FROM {$this->dbpredpona}captcha
                                                  WHERE font={$data->id} ORDER BY id ASC;", $error))
        {
          //vypis captcha
          foreach ($res1 as $data1)
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_captcha"],
                                                $data1->id,
                                                $this->typkodu[$data1->typ],
                                                $data1->otazka,
                                                "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->get_captcha}={$this->imgcreare}&amp;{$this->id_obr}={$data1->id}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editcap&amp;id={$data1->id}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delcap&amp;id={$data1->id}");
          }
        }
          else
        {
          if (!Empty($error))
          {
            $this->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
            else
          {
            $result .= $this->unikatni["admin_vypis_captcha_null"];
          }
        }

        $result .= $this->unikatni["admin_vypis_font_end"];
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result = $this->unikatni["admin_vypis_font_null"];
      }
    }

    return $result;
  }


}
?>
