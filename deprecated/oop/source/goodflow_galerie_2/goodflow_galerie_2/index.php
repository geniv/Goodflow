<?php

include_once "config.php";

class AutoGalery3 extends Konfig
{
  //hlavni konstruktor
  public function __construct()
  {
    $this->absolutni_url = $this->AbsolutniUrl();

    $vyber = (!Empty($_GET["galerie"]) ? $_GET["galerie"] : "Přehled obrázků");
    $slozky = $this->VypisAdresaru($this->koren, array("name", "asc"));
    if (is_array($slozky))
    {
      $row = array();
      foreach ($slozky as $slozka)
      {
        if ($vyber == $slozka)
        {
          $row[] = "<p><span>{$slozka}</span></p>";
        }
          else
        {
          $row[] = "<p><a href=\"?galerie={$slozka}\" title=\"{$slozka}\">{$slozka}</a></p>";
        }
      }

      $menu = implode("", $row);
    }
      else
    {
      $menu = "";
    }

    $obsah = "";
    $cesta = "{$this->koren}/{$vyber}";
    if (!Empty($vyber) &&
        file_exists($cesta))
    {
      $this->ControlCreateDir(array(array($this->koren, $vyber, $this->minidir),
                                    ));

      $obrazky = $this->VypisSouboru($cesta, array("name", "asc"), array("png"));
      if (is_array($obrazky))
      {
        $max = 16 * 1024 * 1024;
        $files = array();
        $row = array();
        foreach ($obrazky as $obrazek)
        {
          $minicesta = "{$cesta}/{$this->minidir}/{$obrazek}";
          if (!file_exists($minicesta))
          {
            $files["tmp_name"]["obr"] = "{$cesta}/{$obrazek}";
            $files["type"]["obr"] = "image/png";
            $files["size"]["obr"] = filesize("{$cesta}/{$obrazek}");
            $files["out"]["obr"] = $minicesta;
            $this->SavePicture($files, "obr", $max, array("{$cesta}/{$this->minidir}" => $this->size));
          }

          $nazev = basename($obrazek, ".png");

          $row[] = "<div class=\"obal_vypis highslide-gallery\"><p class=\"obrazek\"><a href=\"{$cesta}/{$obrazek}\" title=\"{$nazev}\" class=\"highslide\" onclick=\"return hs.expand(this, config1 )\" style=\"background-image: url('{$cesta}/{$this->minidir}/{$obrazek}');\"><!-- --><span class=\"popis\">{$nazev}</span></a></p></div>";
        }

        $obsah = implode("", $row);
      }
        else
      {
        $minicesta = "{$cesta}/{$this->minidir}";
        $obrazky = $this->VypisSouboru($minicesta, array("name", "asc"));
        if (is_array($obrazky))
        {
          $row = array();
          foreach ($obrazky as $obrazek)
          {
            $nazev = basename($obrazek, ".png");

            $row[] = "<div class=\"obal_vypis highslide-gallery\"><p class=\"obrazek\"><a href=\"{$cesta}/{$obrazek}\" title=\"{$nazev}\" class=\"highslide\" onclick=\"return hs.expand(this, config1 )\" style=\"background-image: url('{$cesta}/{$this->minidir}/{$obrazek}');\"><!-- --><span class=\"popis\">{$nazev}</span></a></p></div>";
          }
        }

        $obsah = implode("", $row);
      }
    }

    $result = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GoodFlow design\" />
    <meta name=\"description\" content=\"GoodFlow galerie #1\" />
    <meta name=\"robots\" content=\"index, follow\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" title=\"\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <title>GoodFlow galerie #2 - {$vyber} - Název galerie</title>
    <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
    <script type=\"text/javascript\" src=\"highslide/highslide-with-gallery.js\"></script>
    <script type=\"text/javascript\" src=\"highslide/highslide.config.js\" charset=\"utf-8\"></script>
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"obal_sekce\">
        <h1><a href=\"{$this->absolutni_url}\">Název galerie</a></h1>
        <div id=\"obal\">
          <div id=\"menu\">
            {$menu}
          </div>
          <div id=\"vypis\">
            {$obsah}
          </div>
        </div>
      </div>
    </div>
  </body>
</html>";

    echo $result;

  }
}

new AutoGalery3();

?>
