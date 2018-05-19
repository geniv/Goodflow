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
  private $var, $sqlite, $dbname, $dirpath, $fullpath, $absolutni_url, $unikatni;
  private $idmodul = "dyncaptcha";
  private $dirfont = "fonty";

  private $imgcreare = "obrcreate";

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
    $this->fullpath = $this->var->moduly[$index]["include"];
    $this->dbname = $this->var->moduly[$index]["databaze"];

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->dirfont = $this->NactiUnikatniObsah($this->unikatni["set_dirfont"]);

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
                                      rand_koeficient VARCHAR(20));

                                      CREATE TABLE captcha_font (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      nazev VARCHAR(100),
                                      url VARCHAR(300));
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
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

  private function DefaultniObrazek()
  {
    header("Content-type: image/png");
    $cesta = "{$this->dirpath}/picture.png";
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
    list($pozadi_r, $pozadi_g, $pozadi_b) = $this->PrevodNaRGB($nastaveni["background_color"]); //barva pozadi
    $pozadi = imagecolorallocate($im, $pozadi_r, $pozadi_g, $pozadi_b); //nastaveni barvy
    imagefilledrectangle($im, 0, 0, $width, $height, $pozadi);  //vyplneni pozadi barvou

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

    $male = str_split("abcdefghijklmnopqrstuvwxyz", 1);
    $velke = str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 1);
    $cisla = str_split("0123456789", 1);
    $znamenko = str_split("+-*", 1);

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
        //
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
            $result[0] = "{$cislo1}+{$cislo2}";
            $result[1] = $cislo1 + $cislo2;
          break;

          case 8: //priklad -
            $cislo1 = $cisla[array_rand($cisla)];
            $cislo2 = $cisla[array_rand($cisla)];
            $result[0] = "{$cislo1}-{$cislo2}";
            $result[1] = $cislo1 - $cislo2;
          break;

          case 9: //priklad +&-
            $cislo1 = $cisla[array_rand($cisla)];
            $cislo2 = $cisla[array_rand($cisla)];
            $zmanenko = $znamenko[rand(0, 1)];
            $result[0] = "{$cislo1}{$zmanenko}{$cislo2}";

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
            $result[0] = "{$cislo1}*{$cislo2}";
            $result[1] = $cislo1 * $cislo2;
          break;

          case 11: //priklad kombinace
            $cislo1 = $cisla[array_rand($cisla)];
            $cislo2 = $cisla[array_rand($cisla)];
            $zmanenko = $znamenko[array_rand($znamenko)];
            $result[0] = "{$cislo1}{$zmanenko}{$cislo2}";

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
 * Externe volana funkce pro vypis samotneho captcha kodu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", 1);</strong>
 *
 * @param id cislo kodu v DB
 * @param slovo slovo na vygenerovani
 * @param tvar cislo tvaru
 * @return link na obrazek, s obrazkem captcha kodu
 */
  public function CaptchaKod($id, $slovo, $tvar = 1)
  {
    $id = (!Empty($_GET["id"]) ? $_GET["id"] : $id);
    settype($id, "integer");

    if (Empty($_GET["id"])) //session nacita jen kdyz jede inicializacni mod, ne uz cteci!!
    {
      $_SESSION["slovo_{$id}"] = $slovo;  //inicializace slova
    }

    $result = "";
    if ($res = @$this->sqlite->query("SELECT
                                      id, typ, otazka, x, y, width, height, font, font_size, roztec, font_color, background_color, rotace_pismen, mrizka, rand_dot, rand_line, rand_rectangle, rand_arc, rand_ellipse, rand_barva, rand_koeficient
                                      FROM captcha
                                      WHERE
                                      id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();

        if ($_GET[$this->var->get_kam] == $this->imgcreare &&
            !Empty($_GET["id"]))
        {
          $captcha["slovo"] = $_SESSION["slovo_{$_GET["id"]}"];
          $captcha["x"] = $data->x;
          $captcha["y"] = $data->y;
          $captcha["width"] = $data->width;
          $captcha["height"] = $data->height;
          $captcha["font"] = "./{$this->dirpath}/{$this->dirfont}/{$this->VypisUrlFontu($data->font)}";
          $captcha["font_size"] = explode("|--|", $data->font_size);
          $captcha["roztec"] = $data->roztec;
          $captcha["font_color"] = explode("|--|", $data->font_color);
          $captcha["background_color"] = $data->background_color;
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
                                            "{$this->absolutni_url}?{$this->var->get_kam}={$this->imgcreare}&amp;id={$id}");

      }
        else
      {
        if ($_GET[$this->var->get_kam] == $this->imgcreare &&
            !Empty($_GET["id"]))
        {
          $this->DefaultniObrazek();
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
 * Osetruje nebezpecne znaky v nazvu
 *
 * @param jmeno nazev souboru
 * @return osetreny nazev
 */
  private function OsetriJmenoSouboru($jmeno)
  {
    $prepis = array("\xc3\xa1" => "a",
                    "\xc3\xa4" => "a",
                    "\xc4\x8d" => "c",
                    "\xc4\x8f" => "d",
                    "\xc3\xa9" => "e",
                    "\xc4\x9b" => "e",
                    "\xc3\xad" => "i",
                    "\xc4\xbe" => "l",
                    "\xc4\xba" => "l",
                    "\xc5\x88" => "n",
                    "\xc3\xb3" => "o",
                    "\xc3\xb6" => "o",
                    "\xc5\x91" => "o",
                    "\xc3\xb4" => "o",
                    "\xc5\x99" => "r",
                    "\xc5\x95" => "r",
                    "\xc5\xa1" => "s",
                    "\xc5\xa5" => "t",
                    "\xc3\xba" => "u",
                    "\xc5\xaf" => "u",
                    "\xc3\xbc" => "u",
                    "\xc5\xb1" => "u",
                    "\xc3\xbd" => "y",
                    "\xc5\xbe" => "z",
                    "\xc3\x81" => "A",
                    "\xc3\x84" => "A",
                    "\xc4\x8c" => "C",
                    "\xc4\x8e" => "D",
                    "\xc3\x89" => "E",
                    "\xc4\x9a" => "E",
                    "\xc3\x8d" => "I",
                    "\xc4\xbd" => "L",
                    "\xc4\xb9" => "L",
                    "\xc5\x87" => "N",
                    "\xc3\x93" => "O",
                    "\xc3\x96" => "O",
                    "\xc5\x90" => "O",
                    "\xc3\x94" => "O",
                    "\xc5\x98" => "R",
                    "\xc5\x94" => "R",
                    "\xc5\xa0" => "S",
                    "\xc5\xa4" => "T",
                    "\xc3\x9a" => "U",
                    "\xc5\xae" => "U",
                    "\xc3\x9c" => "U",
                    "\xc5\xb0" => "U",
                    "\xc3\x9d" => "Y",
                    "\xc5\xbd" => "Z",
                    " " => "-",
                    "." => "-",
                    "(" => "-",
                    ")" => "-",
                    "[" => "-",
                    "]" => "-",
                    "{" => "-",
                    "}" => "-",
                    "ˇ" => "-",
                    "´" => "-",
                    //"-" => "_",
                    "+" => "-",
                    ";" => "-",
                    ":" => "-",
                    "," => "-",
                    "'" => "-",
                    "?" => "-",
                    "<" => "-",
                    ">" => "-",
                    "\x5c" => "-",  // /
                    "\x2f" => "-",  // \
                    "|" => "-",
                    "=" => "-",
                    "!" => "-",
                    "*" => "-",
                    "@" => "-",
                    "%" => "-",
                    "&" => "-",
                    "§" => "-",
                    "#" => "-",
                    "$" => "-",
                    "\"" => "-",
                    "˚" => "-",
                    "`" => "-",
                    "~" => "-",
                    "^" => "-",
                    "€" => "-",
                    "¶" => "-",
                    "¨" => "-",
                    "ŧ" => "-",
                    "¯" => "-",
                    "←" => "-",
                    "→" => "-",
                    "↓" => "-",
                    "ø" => "-",
                    "þ" => "-",
                    "Đ" => "d",
                    "đ" => "d");

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
 * @return cislo pro limit
 */
  private function VypisUrlFontu($id)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT url
                                      FROM captcha_font
                                      WHERE
                                      id='{$id}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $result = $data->url;
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
      $this->var->main[0]->ErrorMsg($error);
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
    if ($res = @$this->sqlite->query("SELECT url FROM captcha_font", NULL, $error))
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
      $this->var->main[0]->ErrorMsg($error);
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

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add"],
                                              $this->VypisTypu(),
                                              $this->VypisFontu());

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
              !Empty($pozadi))
          {
            if (@$this->sqlite->queryExec("INSERT INTO captcha (id, typ, otazka, pocet, x, y, width, height, font, font_size, roztec, font_color, background_color, rotace_pismen, mrizka, rand_dot, rand_line, rand_rectangle, rand_arc, rand_ellipse, rand_barva, rand_koeficient) VALUES
                                          (NULL, {$typ_kodu}, '{$otazka}', {$pocet}, {$x}, {$y}, {$width}, {$height}, {$font}, '{$size}', {$roztec}, '{$font_color}', '{$pozadi}', '{$font_rotace}', '{$mrizka}', {$rand_dot}, {$rand_line}, {$rand_rectangle}, {$rand_arc}, {$rand_ellipse}, '{$color}', '{$rand_koeficient}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_hlaska"],
                                                  $otazka);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "edit":  //editace
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT id, typ, otazka, pocet, x, y, width, height, font, font_size, roztec, font_color, background_color, rotace_pismen, mrizka, rand_dot, rand_line, rand_rectangle, rand_arc, rand_ellipse, rand_barva, rand_koeficient FROM captcha WHERE id={$id};", NULL, $error))
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
                                                  $data->background_color,  //18
                                                  (Empty($rotace_pismen[1]) ? " checked=\"checked\"" : ""),
                                                  $rotace_pismen[0],
                                                  (!Empty($rotace_pismen[1]) ? " checked=\"checked\"" : ""), //21 !Empty($rotace_pismen[0]) &&
                                                  $rotace_pismen[1],
                                                  ($mrizka[0] != 0 ? " checked=\"checked\"" : ""),  //23
                                                  ($mrizka[0] == 1 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 2 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 3 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 4 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 5 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 6 ? " checked=\"checked\"" : ""),
                                                  ($mrizka[0] == 7 ? " checked=\"checked\"" : ""),
                                                  $mrizka[1], //31
                                                  $mrizka[2],
                                                  ($data->rand_dot ? " checked=\"checked\"" : ""),
                                                  ($data->rand_line ? " checked=\"checked\"" : ""),
                                                  ($data->rand_rectangle ? " checked=\"checked\"" : ""),
                                                  ($data->rand_arc ? " checked=\"checked\"" : ""),  //36
                                                  ($data->rand_ellipse ? " checked=\"checked\"" : ""),
                                                  (Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""),
                                                  $rand_koeficient[0],
                                                  (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? " checked=\"checked\"" : ""), //40
                                                  $rand_koeficient[1],
                                                  (Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                  $rand_barva[0],  //43
                                                  (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                  $rand_barva[1], //45
                                                  (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? " checked=\"checked\"" : ""),
                                                  (!Empty($font_size[0]) && !Empty($font_size[1]) ? "font_size_2();" : "font_size_1();"),
                                                  (!Empty($font_color[0]) && !Empty($font_color[1]) ? "font_color_2();" : "font_color_1();"), //48
                                                  (!Empty($rotace_pismen[0]) && !Empty($rotace_pismen[1]) ? "font_rotace_2();" : "font_rotace_1();"),
                                                  (!Empty($mrizka[0]) ? "mrizka(true);" : "mrizka(false);"),  //50
                                                  ($data->rand_dot || $data->rand_line || $data->rand_rectangle || $data->rand_arc || $data->rand_ellipse ? "rand(true);" : "rand(false);"),
                                                  (!Empty($rand_koeficient[0]) && !Empty($rand_koeficient[1]) ? "rand_koeficient_2();" : "rand_koeficient_1();"),
                                                  (Empty($rand_barva[0]) && Empty($rand_barva[1]) ? "color_3();" : (!Empty($rand_barva[0]) && !Empty($rand_barva[1]) ? "color_2();" : "color_1();")));  //53

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
//print_r($_POST);
//var_dump($mrizka);
              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($otazka) &&
                  $pocet != 0 &&
                  $width != 0 &&
                  $height != 0 &&
                  $roztec != 0 &&
                  !Empty($pozadi) &&
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
                                                                  rand_koeficient='{$rand_koeficient}'
                                                                  WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_hlaska"],
                                                      $otazka);
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
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_hlaska"],
                                                    $data->otazka);
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

        case "addfont": //pridavani fontu
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addfont"]);

          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !Empty($_FILES["font"]["tmp_name"]))
          {
            $mezinaz = explode(".", $_FILES["font"]["name"]); //rozdeleni na koncovku a jmeno
            $jmeno = "{$this->VytvorJmenoObrazku()}_{$this->OsetriJmenoSouboru($mezinaz[0])}.ttf";

            if (strtolower($mezinaz[count($mezinaz) - 1]) == "ttf" && !move_uploaded_file($_FILES["font"]["tmp_name"], "{$this->dirpath}/{$this->dirfont}/{$jmeno}"))
            {
              $this->var->main[0]->ErrorMsg($_FILES["font"]["error"]);
            }

            if (@$this->sqlite->queryExec("INSERT INTO captcha_font (id, nazev, url) VALUES
                                          (NULL, '{$nazev}', '{$jmeno}');", $error))
            {
              $navic = $this->SyncFileWithDB();
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addfont_hlaska"],
                                                  $nazev,
                                                  $navic);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
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
                                                  $data->url);

              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                if (!Empty($_FILES["font"]["tmp_name"]))
                {
                  $mezinaz = explode(".", $_FILES["font"]["name"]); //rozdeleni na koncovku a jmeno
                  $url = "{$this->VytvorJmenoObrazku()}_{$this->OsetriJmenoSouboru($mezinaz[0])}.ttf";

                  if ($mezinaz[count($mezinaz) - 1] == "ttf" && !move_uploaded_file($_FILES["font"]["tmp_name"], "{$this->dirpath}/{$this->dirfont}/{$jmeno}"))
                  {
                    $this->var->main[0]->ErrorMsg($_FILES["font"]["error"]);
                  }
                }
                  else
                {
                  $url = $data->url;
                }

                if (@$this->sqlite->queryExec ("UPDATE captcha_font SET nazev='{$nazev}',
                                                                        url='{$url}'
                                                                        WHERE id={$id};", $error))
                {
                  $navic = $this->SyncFileWithDB();
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editfont_hlaska"],
                                                      $nazev,
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

        case "delfont": //mazani fontu
          $id = $_GET["id"];  //cislo sekce, pripadne kontrolovat jestli je pouzity!
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT nazev FROM captcha_font WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM captcha_font WHERE id={$id};", $error)) //provedeni dotazu
              {
                $navic = $this->SyncFileWithDB();
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delfont_hlaska"],
                                                    $data->nazev,
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
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_font"],
                                              $data->id,
                                              $data->nazev,
                                              $data->url,
                                              (file_exists("{$this->dirpath}/{$this->dirfont}/{$data->url}") ? "existuje" : "neexistuje!"),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfont&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfont&amp;id={$data->id}");
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_font_obsah"]);

    if ($res = @$this->sqlite->query("SELECT id, typ, otazka, x, y, width, height,
                                      font, font_size, font_color, background_color,
                                      rotace_pismen, mrizka, rand_dot, rand_line,
                                      rand_rectangle, rand_arc, rand_ellipse, rand_barva,
                                      rand_koeficient FROM captcha ORDER BY id ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                              $data->id,
                                              $data->typ,
                                              $data->otazka,
                                              $data->width,
                                              $data->height,
                                              $data->size,
                                              $data->pismo,
                                              $data->pozadi,
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
