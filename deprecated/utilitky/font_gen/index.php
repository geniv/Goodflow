<?php

include_once "config.php";

class FontGen extends Konfig
{
  //konstruktor
  public function __construct()
  {
    if (file_exists($this->dirfont))
    {
      $cesta = (!Empty($_POST["cesta"]) ? $_POST["cesta"] : $this->dirfont);
      $obrcesta = (!Empty($_POST["obrcesta"]) ? $_POST["obrcesta"] : $this->dirfontobr);

      $soubory = $this->VypisSouboru($cesta, NULL, array("ttf"));
      $poc = count($soubory);

      if (Empty($_POST["tlacitko"]))
      {
        $fonty = "";
        if (is_array($soubory))
        {
          $fonty = implode(", ", $soubory);
        }

        $result = "počet fontů: {$poc}<br />
        soubory v aktuální složce ( {$cesta}, {$cesta}{$obrcesta} ): <strong>{$fonty}</strong><br />
        <form method=\"post\" action=\"\">
          <fieldset>
            cesta fontu:
            <br />
            <input type=\"text\" name=\"cesta\" value=\"{$cesta}\">
            <br />

            cesta nahledu:
            <br />
            {$cesta}<input type=\"text\" name=\"obrcesta\" value=\"{$obrcesta}\">

            <br /><br />

            <input type=\"submit\" name=\"tlacitkocheck\" value=\"zkontrolovat složku miniatury\" />
            <input type=\"submit\" name=\"tlacitko\" value=\"vytvořit miniatury\" />
          </fieldset>
        </form>
        ";
      }
        else
      {
        //vytvari potrebne slozky
        $this->ControlCreateDir(array(array($cesta, $obrcesta),
                                      ));
        //rozdeleni na bloky
        $rozgen = array_chunk($soubory, $this->safegen);
        //prochazeni bloku fontu
        $row = array();
        foreach ($rozgen as $index => $blokgen)
        {
          $p = 0;
          //vypis bloku fontu
          foreach ($blokgen as $soubor)
          {
            $font = "{$cesta}/{$soubor}";
            $obrfont = "{$cesta}/{$obrcesta}/{$soubor}.png";
            if (!file_exists($obrfont))
            {
              $text = wordwrap(html_entity_decode($this->fonttext, NULL, "UTF-8"), $this->fontwrap);

              $font_size = $this->fontsize;
              $font_file = $font;
              $bbox = @imagettfbbox($font_size, 0, $font_file, $text);
              //nacitani paddingu TOP RIGHT BOTTOM LEFT
              $padding = $this->fontpadding;
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
              list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->fontpozadi);
              $pozadi = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy
              imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $pozadi);  //vyplneni pozadi barvou
              list($bar1, $bar2, $bar3) = $this->PrevodNaRGB($this->fontbarvafontu);
              $color_font = imagecolorallocate($im, $bar1, $bar2, $bar3); //nastaveni barvy

              //vypocet x a y pozice
              $pos_x = abs($bbox[6] - $p_left); //levy horni roh
              $pos_y = abs($bbox[7] - $p_top);
              imagettftext($im, $font_size, 0, $pos_x, $pos_y, $color_font, $font_file, $text);
              if (imagepng($im, $obrfont))
              {
                $row[] = "uspěšně vygenerovano: {$soubor}<br />";
                $p++;
              }
            }
              else
            {
              //$row[] = "{$soubor}<img src=\"{$obrfont}\" alt=\"{$soubor}\"><br /><br />";
            }
          }

          if ($p == $this->safegen)
          { //zastaveni po zadanem poctu
            $row[] = "generovani bloku: {$index}<br />";
            break;
          }
            else
          {
            $row[] = "blok: {$index} hotovo<br />";
          }
        }

        $row = implode("", $row);

        $absolutni_url = $this->AbsolutniUrl();

        $result = "<br />
        {$row}
        <a href=\"{$absolutni_url}\">dokončeno</a>
        ";
      }
    }
      else
    {
      $result = "adresar: {$this->dirfont} neexistuje";
    }

    echo $result;
  }
}

new FontGen();

?>
