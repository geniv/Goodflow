<?php

/**
 *
 * Blok captcha kodu
 *
 * public funkce:\n
 * construct: CaptchaCode - hlavni konstruktor tridy\n
 * AdminObsah() - obsah adminu\n
 *
 */

class CaptchaCode extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $absolutni_url, $unikatni;
  public $idmodul = "dyncaptcha";
  private $dirfont = "fonty";
  private $dirpic = "pozadi";
  private $defaultpic = "default";
  private $korekceobr = 10; //+px

  private $imgcreare = "obrcreate";
  private $get_captcha = "captchakod";

  private $typkodu = array ("obrazkový text (malé písmena)",
                            "obrazkový text (velké písmena)",
                            "obrazkový text (kombinace písmena)",
                            "obrazkové číslo",
                            "obrazkové text a číslo (malé písmena)",
                            "obrazkové text a číslo (velké písmena)",
                            "obrazkové text a číslo (kombinace písmena)",
                            "obrázkový matematicky příklad (+)",
                            "obrázkový matematicky příklad (-)",
                            "obrázkový matematicky příklad (+&-)",
                            "obrázkový matematicky příklad (*)",
                            "obrázkový matematicky příklad (kombinace)"
                            );

/**
 *
 * Konstruktor menu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;
    $this->dirpath = dirname($this->var->moduly[$index]["include"]);
    //$this->fullpath = $this->var->moduly[$index]["include"];
    $this->dbname = $this->var->moduly[$index]["databaze"];

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->typkodu = $this->NactiUnikatniObsah($this->unikatni["set_typkodu"]);
    $this->dirfont = $this->NactiUnikatniObsah($this->unikatni["set_dirfont"]);
    $this->defaultpic = $this->NactiUnikatniObsah($this->unikatni["set_defaultpic"]);

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
      if (!@$this->sqlite->queryExec("CREATE TABLE captcha (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      typ INTEGER UNSIGNED,
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

                                      CREATE TABLE captcha_font (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      nazev VARCHAR(100),
                                      url VARCHAR(300));
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
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
          $result = $this->Administrace();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Defaultni obrazek kdyz neexstuje
 *
 */
  private function DefaultniObrazek()
  {
    header("Content-type: image/png");
    $cesta = "{$this->dirpath}/{$this->defaultpic}.png";
    $u = fopen($cesta, "r");
    echo fread($u, filesize($cesta));
    fclose($u);
    exit(1);
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

    $im = imagecreatetruecolor($width, $height);  //vytvoreni platna

    if (!Empty($nastaveni["background_color"])) //volba mezi pevnym pozadim a obrazkem
    {
      list($pozadi_r, $pozadi_g, $pozadi_b) = $this->PrevodNaRGB($nastaveni["background_color"]); //barva pozadi
      $pozadi = imagecolorallocate($im, $pozadi_r, $pozadi_g, $pozadi_b); //nastaveni barvy

      imagefilledrectangle($im, 0, 0, $width, $height, $pozadi);  //vyplneni pozadi barvou
    }
      else
    {
      $roz = explode(".",$nastaveni["background_url"]);

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

    if (!Empty($mrizka[0])) //je-li zapnuta mrzka
    {
      switch ($mrizka[0])
      {
        case 1: // +
          for ($i = 0; $i < ceil($width / $mrizka[1]); $i++)  //generovani radku
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, 0, $i * $mrizka[1], $width, $i * $mrizka[1], $barva);

            for ($j = 0; $j < ceil($height / $mrizka[2]); $j++) //generovani sloupcu
            {
              list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
              $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

              imageline($im, $i * $mrizka[2], 0, $i * $mrizka[2], $height, $barva);
            }
          }
        break;

        case 2: // #
          for ($i = 0; $i < ceil($width / $mrizka[1]); $i++)  //generovani radku
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, 0, $i * $mrizka[1], $width, $i * $mrizka[1], $barva);

            for ($j = 0; $j < ceil($height / $mrizka[2]); $j++) //generovani sloupcu
            {
              list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
              $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

              imageline($im, $i * $mrizka[2] + $mrizka[1], 0, $i * $mrizka[2], $height, $barva);
            }
          }
        break;

        case 3: // x
          for ($i = 0 - $mrizka[1]; $i < ceil($width / $mrizka[1]) + $mrizka[2]; $i++)  //generovani radku
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, $i * $mrizka[1] - $mrizka[2], 0, $i * $mrizka[1] + $mrizka[2], $height, $barva);

            for ($j = 0; $j < ceil($height / $mrizka[2]); $j++) //generovani sloupcu
            {
              list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
              $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

              imageline($im, $i * $mrizka[2] + $mrizka[1], 0, $i * $mrizka[2] - $mrizka[1], $height, $barva);
            }
          }
        break;

        case 4: // -
          for ($i = 0; $i < ceil($width / $mrizka[1]); $i++)  //generovani radku
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, 0, $i * $mrizka[1], $width, $i * $mrizka[1], $barva);
          }
        break;

        case 5: // |
          for ($i = 0; $i < $height; $i++) //generovani sloupcu
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, $i * $mrizka[1], 0, $i * $mrizka[1], $height, $barva);
          }
        break;

        case 6: // \
          for ($i = 0 - $mrizka[2]; $i < $height; $i++) //generovani sloupcu
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, $i * $mrizka[1], 0, $i * $mrizka[1] + $mrizka[2], $height, $barva);
          }
        break;

        case 7: // /
          for ($i = 0 - $mrizka[2]; $i < $height; $i++) //generovani sloupcu
          {
            list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
            $barva = imagecolorallocate($im, $rand_barva_r, $rand_barva_g, $rand_barva_b);

            imageline($im, $i * $mrizka[1] + $mrizka[2], 0, $i * $mrizka[1], $height, $barva);
          }
        break;
      }
    }

    $pismeno = (is_array($nastaveni["slovo"]) ? str_split($nastaveni["slovo"][0], 1) : str_split($nastaveni["slovo"], 1));

    for ($i = 0; $i < count($pismeno); $i++)
    {
      list($pismo_r, $pismo_g, $pismo_b) = $this->PrevodNaRGB(Empty($barva_textu[1]) ? $barva_textu[0] : $this->NahodnaRGBBarva($barva_textu[0], $barva_textu[1]));
      $color_font = imagecolorallocate($im, $pismo_r, $pismo_g, $pismo_b);

      //prvni text a pak cary
      $size_font = (Empty($size[1]) ? $size[0] : rand($size[0], $size[1])); //velikost textu
      $rotace_pisma = (Empty($rotace[1]) ? $rotace[0] : rand($rotace[0], $rotace[1])); //rotace pismen
      imagettftext($im, $size_font, $rotace_pisma, $nastaveni["x"] + ($i * $nastaveni["roztec"]), $nastaveni["y"], $color_font, $nastaveni["font"], $pismeno[$i]);

      if (!Empty($koeficient[0]))
      {
        for ($j = 0; $j < (Empty($koeficient[1]) ? $koeficient[0] : rand($koeficient[0], $koeficient[1])); $j++)  //rand(5, 15)
        {
          list($rand_barva_r, $rand_barva_g, $rand_barva_b) = $this->PrevodNaRGB(!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? $this->NahodnaRGBBarva($rand_barva[0], $rand_barva[1]) : (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? $this->NahodnaRGBBarva("000", "fff") : $rand_barva[0]));
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

    $male = str_split($this->NactiUnikatniObsah($this->unikatni["admin_slovo_lower"]), 1);
    $velke = str_split($this->NactiUnikatniObsah($this->unikatni["admin_slovo_upper"]), 1);
    $cisla = str_split($this->NactiUnikatniObsah($this->unikatni["admin_slovo_num"]), 1);

    $bin = str_split($this->NactiUnikatniObsah($this->unikatni["admin_slovo_bin"]), 1);
    $hex = str_split($this->NactiUnikatniObsah($this->unikatni["admin_slovo_hex"]), 1);
    $oct = str_split($this->NactiUnikatniObsah($this->unikatni["admin_slovo_oct"]), 1);
    $znamenko = str_split($this->NactiUnikatniObsah($this->unikatni["admin_slovo_znamenka"]), 1);

    $result = "";
    if ($res = @$this->sqlite->query("SELECT
                                      typ, pocet
                                      FROM captcha
                                      WHERE
                                      id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $cislice = range(0, $data->pocet);

        switch ($data->typ)
        {
          case 0: //text - male
            for ($i = 0; $i < $data->pocet; $i++)
            {
              $result .= $male[array_rand($male)];
            }
          break;

          case 1: //text - velke
            for ($i = 0; $i < $data->pocet; $i++)
            {
              $result .= $velke[array_rand($velke)];
            }
          break;

          case 2: //text - konbinace
            for ($i = 0; $i < $data->pocet; $i++)
            {
              switch (rand(0, 1))
              {
                case 0: //male
                  $result .= $male[array_rand($male)];
                break;

                case 1: //velke
                  $result .= $velke[array_rand($velke)];
                break;
              }
            }
          break;

          case 3: //cisla
            for ($i = 0; $i < $data->pocet; $i++)
            {
              $result .= $cisla[array_rand($cisla)];
            }
          break;

          case 4: //text a cisla - male
            for ($i = 0; $i < $data->pocet; $i++)
            {
              switch (rand(0, 1))
              {
                case 0: //male
                  $result .= $male[array_rand($male)];
                break;

                case 1: //cislo
                  $result .= $cisla[array_rand($cisla)];
                break;
              }
            }
          break;

          case 5: //text a cisla - velke
            for ($i = 0; $i < $data->pocet; $i++)
            {
              switch (rand(0, 1))
              {
                case 0: //velke
                  $result .= $velke[array_rand($velke)];
                break;

                case 1: //cislo
                  $result .= $cisla[array_rand($cisla)];
                break;
              }
            }
          break;

          case 6: //text a cisla - kombinace
            for ($i = 0; $i < $data->pocet; $i++)
            {
              switch (rand(0, 2))
              {
                case 0: //male
                  $result .= $male[array_rand($male)];
                break;

                case 1: //velke
                  $result .= $velke[array_rand($velke)];
                break;

                case 2: //cislo
                  $result .= $cisla[array_rand($cisla)];
                break;
              }
            }
          break;

          case 7: //priklad +
            $cislo1 = $cisla[array_rand($cisla)];
            $cislo2 = $cisla[array_rand($cisla)];
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_7"], $cislo1, $cislo2);
            $result[1] = $cislo1 + $cislo2;
          break;

          case 8: //priklad -
            $cislo1 = $cisla[array_rand($cisla)];
            $cislo2 = $cisla[array_rand($cisla)];
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_8"], $cislo1, $cislo2);
            $result[1] = $cislo1 - $cislo2;
          break;

          case 9: //priklad +&-
            $cislo1 = $cisla[array_rand($cisla)];
            $cislo2 = $cisla[array_rand($cisla)];
            $zmanenko = $znamenko[rand(0, 1)];
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_9"], $cislo1, $zmanenko, $cislo2);

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

          case 10: //priklad *
            $cislo1 = $cisla[array_rand($cisla)];
            $cislo2 = $cisla[array_rand($cisla)];
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_10"], $cislo1, $cislo2);
            $result[1] = $cislo1 * $cislo2;
          break;

          case 11: //priklad kombinace
            $cislo1 = $cisla[array_rand($cisla)];
            $cislo2 = $cisla[array_rand($cisla)];
            $zmanenko = $znamenko[array_rand($znamenko)];
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_11"], $cislo1, $zmanenko, $cislo2);

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

          case 12:  //mocnina
            $cislo1 = $cisla[array_rand($cisla)];
            $cislo2 = $cisla[array_rand($cisla)];
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_12"], $cislo1, $cislo2);

            $result[1] = pow($cislo1, $cislo2);
          break;

          case 13:  //bin->dec
            $cislo = "";
            for ($i = 0; $i < $data->pocet; $i++)
            {
              $cislo .= $bin[array_rand($bin)];
            }
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_13"], $cislo);

            $result[1] = bindec($cislo);
          break;

          case 14:  //dec->bin
            $cislo = $cislice[array_rand($cislice)];
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_14"], $cislo);

            $result[1] = decbin($cislo);
          break;

          case 15:  //oct->dec
            $cislo = "";
            for ($i = 0; $i < $data->pocet; $i++)
            {
              $cislo .= $oct[array_rand($oct)];
            }
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_15"], $cislo);

            $result[1] = octdec($cislo);
          break;

          case 16:  //dec->oct
            $cislo = $cislice[array_rand($cislice)];
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_16"], $cislo);

            $result[1] = decoct($cislo);
          break;

          case 17:  //hex->dec
            $cislo = "";
            for ($i = 0; $i < $data->pocet; $i++)
            {
              $cislo .= $hex[array_rand($hex)];
            }
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_17"], $cislo);

            $result[1] = hexdec($cislo);
          break;

          case 18:  //dec->hex
            $cislo = $cislice[array_rand($cislice)];
            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_18"], $cislo);

            $result[1] = dechex($cislo);
          break;

          case 19:  //kombinace dec<-> oct, bin, hex
            $cislice = range(0, 100); //lokalni nastaveni cislic

            switch (rand(0, 5))
            {
              case 0: //bin->dec
                $cislo = "";
                for ($i = 0; $i < $data->pocet; $i++)
                {
                  $cislo .= $bin[array_rand($bin)];
                }
                $tvar = 13;

                $result[1] = bindec($cislo);
              break;

              case 1: //dec->bin
                $cislo = $cislice[array_rand($cislice)];
                $tvar = 14;

                $result[1] = decbin($cislo);
              break;

              case 2: //oct->dec
                $cislo = "";
                for ($i = 0; $i < $data->pocet; $i++)
                {
                  $cislo .= $oct[array_rand($oct)];
                }
                $tvar = 15;

                $result[1] = octdec($cislo);
              break;

              case 3: //dec->oct
                $cislo = $cislice[array_rand($cislice)];
                $tvar = 16;

                $result[1] = decoct($cislo);
              break;

              case 4: //hex->dec
                $cislo = "";
                for ($i = 0; $i < $data->pocet; $i++)
                {
                  $cislo .= $hex[array_rand($hex)];
                }
                $tvar = 17;

                $result[1] = hexdec($cislo);
              break;

              case 5: //dec->hex
                $cislo = $cislice[array_rand($cislice)];
                $tvar = 18;

                $result[1] = dechex($cislo);
              break;
            }

            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_{$tvar}"], $cislo);
          break;

          case 20:  //#XXXXXX->RGB
            $cislo = "";
            for ($i = 0; $i < 6; $i++)
            {
              $cislo .= $cisla[array_rand($cisla)];
            }

            $text = str_split($cislo, 2);
            for ($i = 0; $i < count($text); $i++)
            {
              $ret[] = hexdec($text[$i]);
            }

            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_20"], $cislo);
            $result[1] = implode($this->NactiUnikatniObsah($this->unikatni["admin_slovo_implode"]), $ret);
          break;

          case 21:  //RGB->#XXXXXX
            for ($i = 0; $i < 3; $i++)
            {
              $rgbcislo[] = rand(0, 255);
            }
            $cislo = implode($this->NactiUnikatniObsah($this->unikatni["admin_slovo_implode"]), $rgbcislo);

            for ($i = 0; $i < count($rgbcislo); $i++)
            { //osetreni kdyz je cislo mensi nez 16 tak pridava 0
              $ret .= (strlen(dechex($rgbcislo[$i])) == 1 ? "0".dechex($rgbcislo[$i]) : dechex($rgbcislo[$i]));
            }

            $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_21"], $cislo);
            $result[1] = $this->NactiUnikatniObsah($this->unikatni["admin_slovo_in21"], $ret);
          break;

          case 22:  //kombinace RGB<->#XXXXXX
            switch (rand(0, 1))
            {
              case 0: //#XXXXXX->RGB
                $cislo = "";
                for ($i = 0; $i < 6; $i++)
                {
                  $cislo .= $cisla[array_rand($cisla)];
                }

                $text = str_split($cislo, 2);
                for ($i = 0; $i < count($text); $i++)
                {
                  $ret[] = hexdec($text[$i]);
                }

                $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_20"], $cislo);
                $result[1] = implode($this->NactiUnikatniObsah($this->unikatni["admin_slovo_implode"]), $ret);
              break;

              case 1: //RGB->#XXXXXX
                for ($i = 0; $i < 3; $i++)
                {
                  $rgbcislo[] = rand(0, 255);
                }
                $cislo = implode($this->NactiUnikatniObsah($this->unikatni["admin_slovo_implode"]), $rgbcislo);

                for ($i = 0; $i < count($rgbcislo); $i++)
                { //osetreni kdyz je cislo mensi nez 16 tak pridava 0
                  $ret .= (strlen(dechex($rgbcislo[$i])) == 1 ? "0".dechex($rgbcislo[$i]) : dechex($rgbcislo[$i]));
                }

                $result[0] = $this->NactiUnikatniObsah($this->unikatni["admin_captcha_21"], $cislo);
                $result[1] = $this->NactiUnikatniObsah($this->unikatni["admin_slovo_in21"], $ret);
              break;
            }
          break;
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
 * Externe volana funkce pro vypis samotneho captcha kodu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", 1, $slovo[, $tvar]);</strong>
 *
 * @param id cislo kodu v DB
 * @param slovo slovo na vygenerovani
 * @param tvar cislo tvaru
 * @return link na obrazek, s obrazkem captcha kodu
 */
  public function CaptchaKod($id, $slovo, $tvar = 1)
  {
    $id = (!Empty($_GET["captchaid"]) ? $_GET["captchaid"] : $id);  //prepina mezi naplnovani a vykreslovanim
    settype($id, "integer");

    if (Empty($_GET["captchaid"])) //session nacita jen kdyz jede inicializacni mod, ne uz cteci!!
    {
      $_SESSION["slovo_{$id}"] = $slovo;  //inicializace slova

      if (is_array($slovo))  //je-li pole vrati jeho [1] index
      {
        $_SESSION["slovo_{$id}_solve"] = $slovo[1];
      }
    }

    $result = "";
    if ($res = @$this->sqlite->query("SELECT
                                      id, typ, otazka, x, y, width, height, font,
                                      font_size, roztec, font_color, background_color,
                                      rotace_pismen, mrizka, rand_dot, rand_line,
                                      rand_rectangle, rand_arc, rand_ellipse,
                                      rand_barva, rand_koeficient, url, vyrez_x, vyrez_y
                                      FROM captcha
                                      WHERE
                                      id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();

        if ($_GET[$this->get_captcha] == $this->imgcreare &&
            !Empty($_GET["captchaid"]))
        {
          $captcha["id"] = $_GET["captchaid"];
          $captcha["slovo"] = $_SESSION["slovo_{$_GET["captchaid"]}"];
          $captcha["x"] = $data->x;
          $captcha["y"] = $data->y;
          $captcha["width"] = $data->width;
          $captcha["height"] = $data->height;
          $captcha["font"] = "./{$this->dirpath}/{$this->dirfont}/{$this->VypisUrlFontu($data->font)}";
          $captcha["font_size"] = explode("|--|", $data->font_size);
          $captcha["roztec"] = $data->roztec;
          $captcha["font_color"] = explode("|--|", $data->font_color);
          $captcha["background_color"] = $data->background_color;
          $captcha["background_url"] = "{$this->dirpath}/{$this->dirpic}/{$data->url}"; //url pozadi
          $captcha["background_x"] = $data->vyrez_x;
          $captcha["background_y"] = $data->vyrez_y;
          $captcha["rotace_pismen"] = explode("|--|", $data->rotace_pismen);
          $captcha["mrizka"] = explode("|--|", $data->mrizka);
          $captcha["rand_dot"] = $data->rand_dot;
          $captcha["rand_line"] = $data->rand_line;
          $captcha["rand_rectangle"] = $data->rand_rectangle;
          $captcha["rand_arc"] = $data->rand_arc;
          $captcha["rand_ellipse"] = $data->rand_ellipse;
          $captcha["rand_barva"] = explode("|--|", $data->rand_barva);
          $captcha["rand_koeficient"] = explode("|--|", $data->rand_koeficient);

          $this->VykresliCaptchaObrazek($captcha);  //vlozi to do toho... samotne vykreslovani nebude sahat do DB!
        }

        $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_captcha_kod_{$tvar}"],
                                            $data->otazka,
                                            $id,
                                            "{$this->absolutni_url}?{$this->get_captcha}={$this->imgcreare}&amp;captchaid={$id}");

      }
        else
      {
        if ($_GET[$this->get_captcha] == $this->imgcreare &&
            !Empty($_GET["captchaid"]))
        {
          $this->DefaultniObrazek();
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
 * Osetruje nebezpecne znaky v nazvu
 *
 * @param jmeno nazev souboru
 * @return osetreny nazev
 */
  private function OsetriJmenoSouboru($jmeno)
  {
    $prepis = $this->NactiUnikatniObsah($this->unikatni["set_prepis"]);

    return strtr($jmeno, $prepis);  //prevede text dle prevadecoho pole
  }

/**
 *
 * Vypis typu captcha kodu
 *
 * @param di nepovinne id
 * @return html select
 */
  private function VypisTypu($id = NULL)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_typu_select_begin"]);
    for ($i = 0; $i < count($this->typkodu); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_typu_select"],
                                          $i,
                                          ($id == $i ? " selected=\"selected\"" : ""),
                                          $this->typkodu[$i]);
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_typu_select_end"]);

    return $result;
  }

/**
 *
 * Vrati url fontu
 *
 * @param adresa adresa sablony
 * @param nazev zapnout / vypnout vraceni nazvu fontu
 * @return cislo pro limit
 */
  private function VypisUrlFontu($id, $nazev = false)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT url, nazev
                                      FROM captcha_font
                                      WHERE
                                      id='{$id}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $result = ($nazev ? $data->nazev : $data->url);
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
 * Vrati select pro vyber z fontu
 *
 * @param id id polozky, nepovinne
 * @return html select
 */
  private function VypisFontu($id = NULL)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev, url FROM captcha_font ORDER BY id ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_fontu_select_begin"]);
        while ($data = $res->fetchObject())
        {
          if (file_exists("{$this->dirpath}/{$this->dirfont}/{$data->url}"))
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_fontu_select"],
                                                $data->id,
                                                (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                                $data->nazev,
                                                $data->url);
          }
        }
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_fontu_select_end"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_fontu_select_null"]);
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
 * Prevadi hex reprezentaci barev na dec reprezentaci
 *
 * @param hex hex barva, s delkou 3 nebo 6
 * @return pole v dec podobe
 */
  private function PrevodNaRGB($hex)
  {
    $result = "";
    if (strlen($hex) == 3)
    {
      $text = str_split($hex, 1);
      for ($i = 0; $i < count($text); $i++)
      {
        $result[] = hexdec("{$text[$i]}{$text[$i]}");
      }
    }
      else
    if (strlen($hex) == 6)
    {
      $text = str_split($hex, 2);
      for ($i = 0; $i < count($text); $i++)
      {
        $result[] = hexdec($text[$i]);
      }
    }
      else
    {
      $result = NULL;
    }

    return $result;
  }

/**
 *
 * Vygeneruje nahodnou rgb barvu v 6-ti mistnem zobrazeni
 *
 * @param min minimalni barva
 * @param max maximalni barva
 * @return nahodna barva v limtu
 */
  private function NahodnaRGBBarva($min, $max)
  {
    $result = "";
    if (strlen($min) == strlen($max))
    {
      if (strlen($min) == 3)
      {
        $textmin = str_split($min, 1);
        $textmax = str_split($max, 1);
        for ($i = 0; $i < count($textmin); $i++)
        {
          $result .= dechex(rand(hexdec("{$textmin[$i]}{$textmin[$i]}"), hexdec("{$textmax[$i]}{$textmax[$i]}")));
        }
      }
        else
      if (strlen($min) == 6)
      {
        $textmin = str_split($min, 2);
        $textmax = str_split($max, 2);
        for ($i = 0; $i < count($textmin); $i++)
        {
          $result .= dechex(rand(hexdec($textmin[$i]), hexdec($textmax[$i])));
        }
      }
        else
      {
        $result = NULL;
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
 * Kontroluje rozdily mezi databazi a filesystemem
 *
 */
  private function SyncFileWithDB()
  {
    if ($res = @$this->sqlite->query("SELECT url FROM captcha_font;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $databaze = "";
        while ($data = $res->fetchObject())
        {
          $databaze[] = $data->url;
          $rozdel = explode(".", $data->url);
          $databaze[] = "{$rozdel[0]}.png";
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->dirfont}";  //projiti miniatur
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
        chmod("{$this->dirpath}/{$this->dirfont}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->dirfont}/{$diff[$i]}");
      }
    }

    $result = $pocet1;

    return $result;
  }

/**
 *
 * Kontroluje rozdily mezi databazi a filesystemem u captchy
 *
 */
  private function SyncCaptchaFileWithDB()
  {
    if ($res = @$this->sqlite->query("SELECT url FROM captcha;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $databaze = "";
        while ($data = $res->fetchObject())
        {
          $databaze[] = $data->url;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->dirpic}";  //projiti miniatur
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
        chmod("{$this->dirpath}/{$this->dirpic}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->dirpic}/{$diff[$i]}");
      }
    }

    $result = $pocet1;

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickeho htaccessu
 *
 * @return adminstracni formular v html
 */
  private function Administrace()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfont",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add",
                                        $this->AdminVypisObsah());

    if (!file_exists("{$this->dirpath}/{$this->dirfont}"))
    {
      mkdir("{$this->dirpath}/{$this->dirfont}", 0777);
    }

    if (!file_exists("{$this->dirpath}/{$this->dirpic}"))
    {
      mkdir("{$this->dirpath}/{$this->dirpic}", 0777);
    }

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani
          $font_1 = $_GET["font"];
          settype($font_1, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add"],
                                              $this->VypisTypu(),
                                              $this->VypisFontu($font_1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $typ_kodu = $_POST["typ_kodu"];
          settype($typ_kodu, "integer");
          $otazka = stripslashes(htmlspecialchars($_POST["otazka"], ENT_QUOTES));
          $pocet = $_POST["pocet"];
          settype($pocet, "integer");
          $x = $_POST["x"];
          settype($x, "integer");
          $y = $_POST["y"];
          settype($y, "integer");
          $width = $_POST["width"];
          settype($width, "integer");
          $height = $_POST["height"];
          settype($height, "integer");
          $font = $_POST["font"];
          settype($font, "integer");

          $size[] = $_POST["size"][0];
          $size[] = $_POST["size"][1];
          $size = implode("|--|", $size);

          $roztec = $_POST["roztec"];
          settype($roztec, "integer");

          $font_color[] = $_POST["font_color"][0];
          $font_color[] = $_POST["font_color"][1];
          $font_color = implode("|--|", $font_color);

          $pozadi = stripslashes(htmlspecialchars($_POST["pozadi"], ENT_QUOTES));

          $jmeno = "";
          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $mezinaz = explode(".", $_FILES["obrazek"]["name"]); //rozdeleni na koncovku a jmeno
            $holejmeno = "{$this->VytvorJmenoObrazku()}_{$this->OsetriJmenoSouboru($mezinaz[0])}";
            $jmeno = "{$holejmeno}.".strtolower($mezinaz[count($mezinaz) - 1]);

            if ((strtolower($mezinaz[count($mezinaz) - 1]) == "jpg" ||
                strtolower($mezinaz[count($mezinaz) - 1]) == "png") &&
                !move_uploaded_file($_FILES["obrazek"]["tmp_name"], "{$this->dirpath}/{$this->dirpic}/{$jmeno}"))
            {
              $this->var->main[0]->ErrorMsg($_FILES["obrazek"]["error"], array(__LINE__, __METHOD__));
            }
          }

          $vyrez_x = $_POST["vyrez_x"];
          settype($vyrez_x, "integer");
          $vyrez_y = $_POST["vyrez_y"];
          settype($vyrez_y, "integer");

          $font_rotace[] = $_POST["font_rotace"][0];
          $font_rotace[] = $_POST["font_rotace"][1];
          $font_rotace = implode("|--|", $font_rotace);

          $mrizka[] = $_POST["radio_mrizka"];
          $mrizka[] = $_POST["mrizka"][0];
          $mrizka[] = $_POST["mrizka"][1];
          $mrizka = implode("|--|", $mrizka);

          $rand_dot = (!Empty($_POST["checkbox_rand_dot"]) ? 1 : 0);
          $rand_line = (!Empty($_POST["checkbox_rand_line"]) ? 1 : 0);
          $rand_rectangle = (!Empty($_POST["checkbox_rand_restangle"]) ? 1 : 0);
          $rand_arc = (!Empty($_POST["checkbox_rand_arc"]) ? 1 : 0);
          $rand_ellipse = (!Empty($_POST["checkbox_rand_ellipse"]) ? 1 : 0);

          $rand_koeficient[] = $_POST["rand_koeficient"][0];
          $rand_koeficient[] = $_POST["rand_koeficient"][1];
          $rand_koeficient = implode("|--|", $rand_koeficient);

          $color[] = $_POST["color"][0];
          $color[] = $_POST["color"][1];
          $color = implode("|--|", $color);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($otazka) &&
              $pocet != 0 &&
              $width != 0 &&
              $height != 0 &&
              $roztec != 0)
          {
            if (@$this->sqlite->queryExec("INSERT INTO captcha (id, typ, otazka, pocet, x, y, width, height, font, font_size, roztec, font_color, background_color, rotace_pismen, mrizka, rand_dot, rand_line, rand_rectangle, rand_arc, rand_ellipse, rand_barva, rand_koeficient, url, vyrez_x, vyrez_y) VALUES
                                          (NULL, {$typ_kodu}, '{$otazka}', {$pocet}, {$x}, {$y}, {$width}, {$height}, {$font}, '{$size}', {$roztec}, '{$font_color}', '{$pozadi}', '{$font_rotace}', '{$mrizka}', {$rand_dot}, {$rand_line}, {$rand_rectangle}, {$rand_arc}, {$rand_ellipse}, '{$color}', '{$rand_koeficient}', '{$jmeno}', {$vyrez_x}, {$vyrez_y});", $error))
            {
              $navic = $this->SyncCaptchaFileWithDB();
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_hlaska"],
                                                  $otazka,
                                                  $navic);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "edit":  //editace
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT id, typ, otazka, pocet, x, y, width, height, font, font_size, roztec, font_color, background_color, rotace_pismen, mrizka, rand_dot, rand_line, rand_rectangle, rand_arc, rand_ellipse, rand_barva, rand_koeficient, url, vyrez_x, vyrez_y FROM captcha WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
              $font_size = explode("|--|", $data->font_size);
              $font_color = explode("|--|", $data->font_color);
              $rotace_pismen = explode("|--|", $data->rotace_pismen);
              $mrizka = explode("|--|", $data->mrizka);
              $rand_koeficient = explode("|--|", $data->rand_koeficient);
              $rand_barva = explode("|--|", $data->rand_barva);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit"],
                                                  $this->VypisTypu($data->typ),
                                                  $data->otazka,
                                                  $data->pocet,
                                                  $data->x,
                                                  $data->y,
                                                  $data->width,
                                                  $data->height,
                                                  $this->VypisFontu($data->font),
                                                  $data->roztec,
                                                  (Empty($font_size[1]) ? " checked=\"checked\"" : ""),
                                                  $font_size[0],
                                                  (!Empty($font_size[0]) && !Empty($font_size[1]) ? " checked=\"checked\"" : ""), //12
                                                  $font_size[1],
                                                  (Empty($font_color[1]) ? " checked=\"checked\"" : ""),
                                                  $font_color[0],
                                                  (!Empty($font_color[0]) && !Empty($font_color[1]) ? " checked=\"checked\"" : ""), //16
                                                  $font_color[1],
                                                  (!Empty($data->background_color) ? " checked=\"checked\"" : ""),  //18
                                                  $data->background_color,
                                                  (Empty($data->background_color) ? " checked=\"checked\"" : ""),
                                                  "{$this->dirpath}/{$this->dirpic}/{$data->url}",  //21
                                                  $data->vyrez_x,
                                                  $data->vyrez_y, //23
                                                  (Empty($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                                  $rotace_pismen[0],
                                                  (!Empty($rotace_pismen[1]) ? " checked=\"checked\"" : ""), //26 !Empty($rotace_pismen[0]) &&
                                                  $rotace_pismen[1],
                                                  ($mrizka[0] != 0 ? " checked=\"checked\"" : ""),  //28
                                                  ($mrizka[0] == 1 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 2 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 3 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 4 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 5 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 6 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 7 ? " checked=\"checked\"" : ""),
                                                  $mrizka[1], //36
                                                  $mrizka[2],
                                                  ($data->rand_dot ? " checked=\"checked\"" : ""),
                                                  ($data->rand_line ? " checked=\"checked\"" : ""),
                                                  ($data->rand_rectangle ? " checked=\"checked\"" : ""),
                                                  ($data->rand_arc ? " checked=\"checked\"" : ""),  //41
                                                  ($data->rand_ellipse ? " checked=\"checked\"" : ""),
                                                  (Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""),
                                                  $rand_koeficient[0],
                                                  (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""), //45
                                                  $rand_koeficient[1],
                                                  (Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                  $rand_barva[0],  //48
                                                  (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                  $rand_barva[1], //50
                                                  (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                  (!Empty($font_size[0]) && !Empty($font_size[1]) ? "font_size_2();" : "font_size_1();"),
                                                  (!Empty($font_color[0]) && !Empty($font_color[1]) ? "font_color_2();" : "font_color_1();"), //53
                                                  (!Empty($data->background_color) ? "pozadi_1();" : "pozadi_2();"),
                                                  (!Empty($rotace_pismen[0]) && !Empty($rotace_pismen[1]) ? "font_rotace_2();" : "font_rotace_1();"),
                                                  (!Empty($mrizka[0]) ? "mrizka(true);" : "mrizka(false);"),  //56
                                                  ($data->rand_dot || $data->rand_line || $data->rand_rectangle || $data->rand_arc || $data->rand_ellipse ? "rand(true);" : "rand(false);"),
                                                  (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? "rand_koeficient_2();" : "rand_koeficient_1();"),
                                                  (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? "color_3();" : (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? "color_2();" : "color_1();")),  //59
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $font_size = "";
              $font_color = "";
              $rotace_pismen = "";
              $mrizka = "";
              $rand_koeficient = "";
              $rand_barva = "";

              $typ_kodu = $_POST["typ_kodu"];
              settype($typ_kodu, "integer");
              $otazka = stripslashes(htmlspecialchars($_POST["otazka"], ENT_QUOTES));
              $pocet = $_POST["pocet"];
              settype($pocet, "integer");
              $x = $_POST["x"];
              settype($x, "integer");
              $y = $_POST["y"];
              settype($y, "integer");
              $width = $_POST["width"];
              settype($width, "integer");
              $height = $_POST["height"];
              settype($height, "integer");
              $font = $_POST["font"];
              settype($font, "integer");

              $size[] = $_POST["size"][0];
              $size[] = $_POST["size"][1];
              $size = implode("|--|", $size);

              $roztec = $_POST["roztec"];
              settype($roztec, "integer");

              $font_color[] = $_POST["font_color"][0];
              $font_color[] = $_POST["font_color"][1];
              $font_color = implode("|--|", $font_color);

              $pozadi = stripslashes(htmlspecialchars($_POST["pozadi"], ENT_QUOTES));

              $jmeno = "";
              if (!Empty($_FILES["obrazek"]["tmp_name"]))
              {
                $mezinaz = explode(".", $_FILES["obrazek"]["name"]); //rozdeleni na koncovku a jmeno
                $holejmeno = "{$this->VytvorJmenoObrazku()}_{$this->OsetriJmenoSouboru($mezinaz[0])}";
                $jmeno = "{$holejmeno}.".strtolower($mezinaz[count($mezinaz) - 1]);

                if ((strtolower($mezinaz[count($mezinaz) - 1]) == "jpg" ||
                    strtolower($mezinaz[count($mezinaz) - 1]) == "png") &&
                    !move_uploaded_file($_FILES["obrazek"]["tmp_name"], "{$this->dirpath}/{$this->dirpic}/{$jmeno}"))
                {
                  $this->var->main[0]->ErrorMsg($_FILES["obrazek"]["error"], array(__LINE__, __METHOD__));
                }
              }
                else
              {
                $jmeno = (Empty($pozadi) ? $data->url : "");
              }

              $vyrez_x = $_POST["vyrez_x"];
              settype($vyrez_x, "integer");
              $vyrez_y = $_POST["vyrez_y"];
              settype($vyrez_y, "integer");

              $font_rotace[] = $_POST["font_rotace"][0];
              $font_rotace[] = $_POST["font_rotace"][1];
              $font_rotace = implode("|--|", $font_rotace);

              $mrizka[] = $_POST["radio_mrizka"];
              $mrizka[] = $_POST["mrizka"][0];
              $mrizka[] = $_POST["mrizka"][1];
              $mrizka = implode("|--|", $mrizka);

              $rand_dot = (!Empty($_POST["checkbox_rand_dot"]) ? 1 : 0);
              $rand_line = (!Empty($_POST["checkbox_rand_line"]) ? 1 : 0);
              $rand_rectangle = (!Empty($_POST["checkbox_rand_restangle"]) ? 1 : 0);
              $rand_arc = (!Empty($_POST["checkbox_rand_arc"]) ? 1 : 0);
              $rand_ellipse = (!Empty($_POST["checkbox_rand_ellipse"]) ? 1 : 0);

              $rand_koeficient[] = $_POST["rand_koeficient"][0];
              $rand_koeficient[] = $_POST["rand_koeficient"][1];
              $rand_koeficient = implode("|--|", $rand_koeficient);

              $color[] = $_POST["color"][0];
              $color[] = $_POST["color"][1];
              $color = implode("|--|", $color);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($otazka) &&
                  $pocet != 0 &&
                  $width != 0 &&
                  $height != 0 &&
                  $roztec != 0 &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE captcha SET typ={$typ_kodu},
                                                                  otazka='{$otazka}',
                                                                  pocet={$pocet},
                                                                  x={$x},
                                                                  y={$y},
                                                                  width={$width},
                                                                  height={$height},
                                                                  font={$font},
                                                                  font_size='{$size}',
                                                                  roztec={$roztec},
                                                                  font_color='{$font_color}',
                                                                  background_color='{$pozadi}',
                                                                  rotace_pismen='{$font_rotace}',
                                                                  mrizka='{$mrizka}',
                                                                  rand_dot={$rand_dot},
                                                                  rand_line={$rand_line},
                                                                  rand_rectangle={$rand_rectangle},
                                                                  rand_arc={$rand_arc},
                                                                  rand_ellipse={$rand_ellipse},
                                                                  rand_barva='{$color}',
                                                                  rand_koeficient='{$rand_koeficient}',
                                                                  url='{$jmeno}',
                                                                  vyrez_x={$vyrez_x},
                                                                  vyrez_y={$vyrez_y}
                                                                  WHERE id={$id};", $error))
                {
                  $navic = $this->SyncCaptchaFileWithDB();
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_hlaska"],
                                                      $otazka,
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

        case "del": //rekurzivni mazani
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT otazka FROM captcha WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM captcha WHERE id={$id};", $error)) //provedeni dotazu
              {
                $navic = $this->SyncCaptchaFileWithDB();
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_hlaska"],
                                                    $data->otazka,
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

        case "addfont": //pridavani fontu
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addfont"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !Empty($_FILES["font"]["tmp_name"]))
          {
            $mezinaz = explode(".", $_FILES["font"]["name"]); //rozdeleni na koncovku a jmeno
            $holejmeno = "{$this->VytvorJmenoObrazku()}_{$this->OsetriJmenoSouboru($mezinaz[0])}";
            $nahled = "{$holejmeno}.png";
            $jmeno = "{$holejmeno}.ttf";

            if (strtolower($mezinaz[count($mezinaz) - 1]) == "ttf" && !move_uploaded_file($_FILES["font"]["tmp_name"], "{$this->dirpath}/{$this->dirfont}/{$jmeno}"))
            {
              $this->var->main[0]->ErrorMsg($_FILES["font"]["error"], array(__LINE__, __METHOD__));
            }

            $text = str_split($this->NactiUnikatniObsah($this->unikatni["set_nahled_text"]));
            $zalomeni = $this->NactiUnikatniObsah($this->unikatni["set_nahled_zalomit"]);

            $krok_x = $this->NactiUnikatniObsah($this->unikatni["set_nahled_width_letter"]);
            $krok_y = $this->NactiUnikatniObsah($this->unikatni["set_nahled_height_letter"]);

            $width = ($krok_x * $zalomeni) + (2 * $this->korekceobr);
            $height = (ceil(count($text) / $zalomeni) * $krok_y) + (2 * $this->korekceobr);

            //generovani nahledu
            $im = imagecreatetruecolor($width, $height);
            list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->NactiUnikatniObsah($this->unikatni["set_barva_pozadi"]));
            $pozadi = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy
            imagefilledrectangle($im, 0, 0, $width, $height, $pozadi);  //vyplneni pozadi barvou
            list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->NactiUnikatniObsah($this->unikatni["set_barva_fontu"]));
            $color_font = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy

            $posun_x = 0;
            $posun_y = $krok_y;
            $poc = 0;
            for ($i = 0; $i < count($text); $i++)
            {
              if ($poc == $zalomeni)
              {
                $posun_x = 0;
                $poc = 0;
                $posun_y += $krok_y;
              }

              imagettftext($im, $this->NactiUnikatniObsah($this->unikatni["set_nahled_size"]), 0, $this->korekceobr + $posun_x, $this->korekceobr + $posun_y, $color_font, "./{$this->dirpath}/{$this->dirfont}/{$jmeno}", $text[$i]);

              $posun_x += $krok_x;
              $poc++;
            }

            imagepng($im, "./{$this->dirpath}/{$this->dirfont}/{$nahled}");

            if (@$this->sqlite->queryExec("INSERT INTO captcha_font (id, nazev, url) VALUES
                                          (NULL, '{$nazev}', '{$jmeno}');", $error))
            {
              $navic = $this->SyncFileWithDB();
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addfont_hlaska"],
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

        case "editfont":  //editace fontu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT nazev, url FROM captcha_font WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editfont"],
                                                  $data->nazev,
                                                  $data->url,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                $text = str_split($this->NactiUnikatniObsah($this->unikatni["set_nahled_text"]));
                $zalomeni = $this->NactiUnikatniObsah($this->unikatni["set_nahled_zalomit"]);

                $krok_x = $this->NactiUnikatniObsah($this->unikatni["set_nahled_width_letter"]);
                $krok_y = $this->NactiUnikatniObsah($this->unikatni["set_nahled_height_letter"]);

                $width = ($krok_x * $zalomeni) + (2 * $this->korekceobr);
                $height = (ceil(count($text) / $zalomeni) * $krok_y) + (2 * $this->korekceobr);

                //generovani nahledu
                $im = imagecreatetruecolor($width, $height);
                list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->NactiUnikatniObsah($this->unikatni["set_barva_pozadi"]));
                $pozadi = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy
                imagefilledrectangle($im, 0, 0, $width, $height, $pozadi);  //vyplneni pozadi barvou
                list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->NactiUnikatniObsah($this->unikatni["set_barva_fontu"]));
                $color_font = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy

                if (!Empty($_FILES["font"]["tmp_name"]))
                {
                  $mezinaz = explode(".", $_FILES["font"]["name"]); //rozdeleni na koncovku a jmeno
                  $holejmeno = "{$this->VytvorJmenoObrazku()}_{$this->OsetriJmenoSouboru($mezinaz[0])}";
                  $nahled = "{$holejmeno}.png";
                  $url = $jmeno = "{$holejmeno}.ttf";

                  if (strtolower($mezinaz[count($mezinaz) - 1]) == "ttf" && !move_uploaded_file($_FILES["font"]["tmp_name"], "{$this->dirpath}/{$this->dirfont}/{$jmeno}"))
                  {
                    $this->var->main[0]->ErrorMsg($_FILES["font"]["error"], array(__LINE__, __METHOD__));
                  }

                  $posun_x = 0;
                  $posun_y = $krok_y;
                  $poc = 0;
                  for ($i = 0; $i < count($text); $i++)
                  {
                    if ($poc == $zalomeni)
                    {
                      $posun_x = 0;
                      $poc = 0;
                      $posun_y += $krok_y;
                    }

                    imagettftext($im, $this->NactiUnikatniObsah($this->unikatni["set_nahled_size"]), 0, $this->korekceobr + $posun_x, $this->korekceobr + $posun_y, $color_font, "./{$this->dirpath}/{$this->dirfont}/{$jmeno}", $text[$i]);

                    $posun_x += $krok_x;
                    $poc++;
                  }

                  imagepng($im, "./{$this->dirpath}/{$this->dirfont}/{$nahled}");
                }
                  else
                {
                  $url = $data->url;

                  //vytvoreni nahledu bez uploadu
                  $mezinaz = explode(".", $url); //rozdeleni na koncovku a jmeno
                  $holejmeno = $mezinaz[0];
                  $nahled = "{$holejmeno}.png";
                  $jmeno = "{$holejmeno}.ttf";

                  $posun_x = 0;
                  $posun_y = $krok_y;
                  $poc = 0;
                  for ($i = 0; $i < count($text); $i++)
                  {
                    if ($poc == $zalomeni)
                    {
                      $posun_x = 0;
                      $poc = 0;
                      $posun_y += $krok_y;
                    }

                    imagettftext($im, $this->NactiUnikatniObsah($this->unikatni["set_nahled_size"]), 0, $this->korekceobr + $posun_x, $this->korekceobr + $posun_y, $color_font, "./{$this->dirpath}/{$this->dirfont}/{$jmeno}", $text[$i]);

                    $posun_x += $krok_x;
                    $poc++;
                  }

                  imagepng($im, "./{$this->dirpath}/{$this->dirfont}/{$nahled}");
                }

                if (@$this->sqlite->queryExec ("UPDATE captcha_font SET nazev='{$nazev}',
                                                                        url='{$url}'
                                                                        WHERE id={$id};", $error))
                {
                  $navic = $this->SyncFileWithDB();
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editfont_hlaska"],
                                                      $nazev,
                                                      $navic);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}", array(__LINE__, __METHOD__));  //auto kliknuti
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

        case "delfont": //mazani fontu
          $id = $_GET["id"];  //cislo sekce, pripadne kontrolovat jestli je pouzity!
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT nazev FROM captcha_font WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if ($this->KontrolaVyuzitiFontu($id))
              {
                if (@$this->sqlite->queryExec("DELETE FROM captcha_font WHERE id={$id};", $error)) //provedeni dotazu
                {
                  $navic = $this->SyncFileWithDB();
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_delfont_hlaska"],
                                                      $data->nazev,
                                                      $navic);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              }
                else
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delfont_false_hlaska"], $data->nazev);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
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
 * Kontrola blokace funkce
 *
 * @param id id fontu
 * @return true/false- povoli/zakaze
 */
  private function KontrolaVyuzitiFontu($id)
  {
    if ($res = @$this->sqlite->query("SELECT id FROM captcha WHERE font={$id};", NULL, $error))
    {
      $result = ($res->numRows() == 0 ? true : false);  //kdyz je nulovy pcet vyuziti dovoli jej smazat
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
    if ($res = @$this->sqlite->query("SELECT id, nazev, url FROM captcha_font ORDER BY id ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $rozdel = explode(".", $data->url);
          $nahled = "./{$this->dirpath}/{$this->dirfont}/{$rozdel[0]}.png";

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_font"],
                                              $data->id,
                                              $data->nazev,
                                              $data->url,
                                              $nahled,
                                              (file_exists("{$this->dirpath}/{$this->dirfont}/{$data->url}") ? "existuje" : "neexistuje"),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfont&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfont&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add&amp;font={$data->id}");
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_font_obsah"]);

    if ($res = @$this->sqlite->query("SELECT id, typ, otazka, width, height,
                                      font, font_size, font_color, background_color
                                      FROM captcha ORDER BY id ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                              $data->id,
                                              $this->typkodu[$data->typ],
                                              $data->otazka,
                                              $data->width,
                                              $data->height,
                                              $data->font_size,
                                              $this->VypisUrlFontu($data->font, true),
                                              $data->font_color,
                                              $data->background_color,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}");
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_end"]);

    return $result;
  }
}
?>
