<?php

include_once "config.php";

class VypisSlozky extends Konfig
{
  private $absolutni_url;

  public function __construct()
  {
    $this->absolutni_url = $this->AbsolutniUrl();

    $slozky = "";
    $cesta = (!Empty($_GET["cesta"]) ? base64_decode($_GET["cesta"]) : ".");
    $allcesta = "{$this->koren}/{$cesta}";
    $slozky = $this->VypisAdresaru($allcesta, array("name", "asc"));
    if (is_array($slozky))
    {
      $row = array();
      foreach ($slozky as $slozka)
      {
        $fil = "{$cesta}/{$slozka}";
        $stav = (is_array($this->VypisSouboru($fil)) || is_array($this->VypisAdresaru($fil)) ? "dir_full" : "dir_empty");
        $kod = base64_encode($fil);
        $row[] = "<p><a href=\"?cesta={$kod}\" title=\"{$slozka}\"><span class=\"pripona\" style=\"background-image: url(http://design_vypis_slozek.gfdesign.cz/pripony/{$stav}.png);\"><!-- --></span><span class=\"obal\"><span class=\"nazev nazev_slozka\">{$slozka}</span></span></a></p>";
      }

      $slozky = implode("", $row);
    }

    //koncovky co se nesmi zobrazit
    $blok_konc = array("htaccess"); //"php",
    $blok_file = array("index.php", "config.php", "default_modul_lite.php");

    $obsah = "";
    $soubory = $this->VypisSouboru($cesta, array("name", "asc"));
    if (is_array($soubory))
    {
      $row = array();
      foreach ($soubory as $soubor)
      {
        $a = explode(".", $soubor);
        $konc = strtolower($a[count($a) - 1]);
        //vypisuje jen ty ktere nenajde v bloku
        if (!in_array($konc, $blok_konc) &&
            !in_array($soubor, $blok_file))
        {
          $file = "{$cesta}/{$soubor}";
          $size = $this->Velikost(filesize($file));
          $mtime = date("d.m.Y / H:i:s", filemtime($file));
          $pripona = (in_array($konc, $this->pripony) ? "{$konc}" : "unknown");
          $newn = $this->PrepisTextu($soubor, "/[a-zA-Z0-9_\-\.\(\) \+\,]{1}/");
          $newname = "{$cesta}/{$newn}";
          if ($file != $newname)
          { //pokud neni prejmenovany tak ho prejmenuje
            rename($file, $newname);
          }

          $row[] = "<p><a href=\"{$file}\" title=\"{$soubor}\"><span class=\"pripona\" style=\"background-image: url(http://design_vypis_slozek.gfdesign.cz/pripony/{$pripona}.png);\"><!-- --></span><span class=\"obal\"><span class=\"nazev\">{$soubor}</span><span class=\"info\">{$size} - {$mtime}</span></span></a></p>";
        }
      }

      $obsah = implode("", $row);
    }

    $drobecky = "";
    if (!Empty($cesta))
    {
      $adrpole = explode("/", $cesta);
      $c_index = count($adrpole);
      $ces = $adr = array();
      $row = array("<a href=\"{$this->absolutni_url}\" title=\"Kořenový adresář\" class=\"koren\">Kořenový adresář</a>");
      foreach ($adrpole as $index => $polozka)
      {
        $adr[] = $polozka;
        $adres = implode("/", $adr);
        if ($polozka != "." &&
            file_exists($adres))
        {
          if ($index != ($c_index - 1))
          {
            $ces[] = $polozka;
            $sub = base64_encode(implode("/", $ces));
            $row[] = "<a href=\"?cesta={$sub}\" title=\"{$polozka}\">{$polozka}</a>";
          }
            else
          {
            $row[] = "<span>{$polozka}</span>";
          }
        }
      }

      $drobecky = implode("<em>&raquo;</em>", $row);
    }

    $result = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GoodFlow design\" />
    <meta name=\"description\" content=\"GoodFlow design\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"http://design_vypis_slozek.gfdesign.cz/styles/global_styles.css\" media=\"screen\" title=\"\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"http://design_vypis_slozek.gfdesign.cz/styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <title>GoodFlow design</title>
    <link rel=\"shortcut icon\" href=\"http://design_vypis_slozek.gfdesign.cz/obr/favicon.ico\" />
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"obal_sekce\">
        <h1><span>Složky &amp; Soubory</span><span id=\"podpis\"></span></h1>
        <strong>{$drobecky}</strong>
        {$slozky}
        {$obsah}
      </div>
    </div>
  </body>
</html>";

    echo $result;

  }
}

new VypisSlozky();

?>
