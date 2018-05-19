<?php

include_once "config.php";

class AutoGalery3 extends Konfig
{
  //hlavni konstruktor
  public function __construct()
  {
    $this->absolutni_url = $this->AbsolutniUrl();

    $vyber = (!Empty($_GET["galerie"]) ? $_GET["galerie"] : "výpis fontů");
    $slozky = $this->VypisAdresaru($this->koren, array("name", "asc"));
    if (is_array($slozky))
    {
      $row = array();
      foreach ($slozky as $slozka)
      {
        if ($vyber == $slozka)
        {
          $row[] = "<p><span><em class=\"odrazka\"><!-- --></em>{$slozka}</span></p>";
        }
          else
        {
          $row[] = "<p><a href=\"?galerie={$slozka}\" title=\"{$slozka}\"><em class=\"odrazka\"><!-- --></em>{$slozka}</a></p>";
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

          $row[] = "<div class=\"obal_vypis\"><p>{$nazev}</p><img src=\"{$cesta}/{$this->minidir}/{$obrazek}\" alt=\"{$nazev}\" /></div>";
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

            $row[] = "<div class=\"obal_vypis\"><p>{$nazev}</p><img src=\"{$minicesta}/{$obrazek}\" alt=\"{$nazev}\" /></div>";
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
    <meta name=\"description\" content=\"GoodFlow design - výpis fontů\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" title=\"\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <title>GoodFlow design - {$vyber}</title>
    <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"obal_sekce\">
        <h1><a href=\"{$this->absolutni_url}\"><span>Složky &amp; Soubory</span></a><span id=\"nadpis_prehled\"><!-- --></span><span id=\"podpis\"><!-- --></span></h1>
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
