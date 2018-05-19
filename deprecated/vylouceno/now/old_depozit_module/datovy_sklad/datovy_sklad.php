<?php

/**
 *
 * Blok datovy sklad
 *
 * public funkce:\n
 * construct: DynamicGallery - hlavni konstruktor tridy\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DataStorage extends DefaultModule
{
  private $var;
  private $idmodul = "datstor";
  private $dirpath;

  private $pathdata = "soubory";

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

    $this->pathdata = "{$this->dirpath}/{$this->pathdata}";

    if (!file_exists($this->pathdata))
    {
      mkdir($this->pathdata, 0777);
    }

    $adresa_menu = array( array("main_href" => "{$this->idmodul}",
                                "odkaz" => "Sklad souborů",
                                "title" => "Sklad souborů",
                                "id" => "",
                                "class" => "sklad_souboru_menu",
                                "akce" => ""),
                          );

    $this->NastavitAdresuMenu($adresa_menu);
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
          $result = $this->AdministraceSkladu();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace datoveho skladu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceSkladu()
  {
    $result =
    "administrace dynamické obrázkové galerie bez sekcí
    <br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$this->pathdata}\" title=\"\">přidat složku</a><br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$this->pathdata}\" title=\"\">přidat soubor</a><br />
    <br />
    {$this->AdminVypisData()}
    ";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "adddir": //pridavani slozky
          $result =
          "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              název složky: <input type=\"text\" name=\"slozka\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat slozku\" />
            </fieldset>
          </form>
          ";

          $slozka = stripslashes(htmlspecialchars($this->OsetreniNazvu($_POST["slozka"]), ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($slozka))
          {
            if (mkdir("{$_GET["file"]}/{$slozka}", 0777))
            {
              $result = "složka {$slozka} vytvořena";
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editdir": //uprava slozky
          $base = basename($_GET["file"]);

          $result =
          "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              název složky: <input type=\"text\" name=\"nazev\" value=\"{$base}\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit slozku\" />
            </fieldset>
          </form>
          ";

          $nazev = stripslashes(htmlspecialchars($this->OsetreniNazvu($_POST["nazev"]), ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($nazev))
          {
            $dir = dirname($_GET["file"]);
            if (rename($_GET["file"], "{$dir}/{$nazev}"))
            {
              $result = "složka {$nazev} přejmenována";
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "deldir": //smazat slozku
          if (!Empty($_GET["file"]))
          {
            $this->DelDirFile($_GET["file"]);
            $result = "složka {$_GET["file"]} smazána";
          }

          $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
        break;

        case "addfile": //pridavani soubor
          $result =
          "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              název souboru: <input type=\"file\" name=\"soubor\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat soubor\" />
            </fieldset>
          </form>
          ";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($_FILES["soubor"]["tmp_name"]))
          {
            $nazev = $this->OsetreniNazvu("{$this->VytvorJmenoObrazku()}__{$_FILES["soubor"]["name"]}");
            $cil = "{$_GET["file"]}/{$nazev}";
            if (move_uploaded_file($_FILES["soubor"]["tmp_name"], $cil))
            {
              $result = "uploadovani probehlo uspesne";
            }
              else
            {
              $result = "vyskytla se chyba";
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editfile": //uprava slozky
          $base = basename($_GET["file"]);

          $result =
          "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              název složky: <input type=\"text\" name=\"nazev\" value=\"{$base}\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit soubor\" />
            </fieldset>
          </form>
          ";

          $nazev = stripslashes(htmlspecialchars($this->OsetreniNazvu($_POST["nazev"]), ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($nazev))
          {
            $dir = dirname($_GET["file"]);
            if (rename($_GET["file"], "{$dir}/{$nazev}"))
            {
              $result = "složka {$nazev} přejmenována";
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "delfile": //smazat soubor
          if (!Empty($_GET["file"]))
          {
            if (unlink($_GET["file"]))
            {
              $result = "soubor: {$_GET["file"]} smazán";
            }
          }

          $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
        break;
      }
    }

    return $result;
  }

/**
 *
 * Rekurzivni mazani slozek a souboru
 *
 * @param jmeno nazev adresare
 */
  private function DelDirFile($jmeno)
  {
    $handle = opendir($jmeno);

    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        if (!(filetype("{$jmeno}/{$soub}") == "file" ? @unlink("{$jmeno}/{$soub}") : @rmdir("{$jmeno}/{$soub}")))
        {
          $this->DelDirFile("{$jmeno}/{$soub}");  //rekurze
        }
      }
    }
    closedir($handle);
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
 * Osetri vstupni nazev
 *
 * @param text vstupni text
 * @return bezpecny text
 */
  private function OsetreniNazvu($text)  //prevede nebezpecne znaky na bezpecne
  {
    $prevod = array("\xc3\xa1" => "a",
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
                    " " => "_",
                    //"-" => "_",
                    "+" => "_",
                    ";" => "_",
                    ":" => "_",
                    "," => "_",
                    "'" => "_",
                    "?" => "_",
                    "<" => "_",
                    ">" => "_",
                    "\x5c" => "_",  // /
                    "\x2f" => "_",  // \
                    "|" => "_",
                    "=" => "_",
                    "!" => "_",
                    "*" => "_",
                    "@" => "_",
                    "%" => "_",
                    "&" => "_",
                    "§" => "_",
                    "#" => "_",
                    "$" => "_",
                    "\"" => "_",
                    "˚" => "_",
                    "`" => "_",
                    "~" => "_",
                    "^" => "_",
                    "€" => "_",
                    "¶" => "_",
                    "¨" => "_",
                    "ŧ" => "_",
                    "¯" => "_",
                    "←" => "_",
                    "→" => "_",
                    "↓" => "_",
                    "ø" => "_",
                    "þ" => "_",
                    "Đ" => "d",
                    "đ" => "d"
                    );

    return strtr($text, $prevod);  //prevede text dle prevadecoho pole
  }

/**
 *
 * Rekurzivni vypis adresare
 *
 * @param cesta adresare
 * @return vypis pod-adresare
 */
  private function RekurzivniVypis($cesta)
  {
    $handle = opendir($cesta);
    $i = $j = 0;
    $result = "";
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        $pocet = count(explode("/", "{$cesta}/{$soub}")) - 4;
        $odsazeni = str_repeat("----", $pocet);

        switch (filetype("{$cesta}/{$soub}"))
        {
          case "dir":
            $rek = $this->RekurzivniVypis("{$cesta}/{$soub}");

            $result .=
            "<br />
            {$odsazeni} složka: {$soub}, zanoreni: {$pocet}<br />
            {$odsazeni} <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$cesta}/{$soub}\" title=\"\">přidat soubor</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$cesta}/{$soub}\" title=\"\">přidat podsložku</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editdir&amp;file={$cesta}/{$soub}\" title=\"\">upravit složku</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deldir&amp;file={$cesta}\" title=\"\" onclick=\"return confirm('Opravdu smazat složku: \'{$soub}\' ?');\">smazat složku</a>
            {$rek}";
            $i++;
          break;

          case "file":
            $a = explode(".", basename("{$cesta}/{$soub}"));
            $suffix = strtolower($a[1]);
            $obr = ($suffix == "jpg" ||
                    $suffix == "png" ||
                    $suffix == "gif" ?
                    "<img src=\"{$cesta}/{$soub}\" width=\"100px\" height=\"100px\" />" : "");

            $velikost = $this->var->main[0]->NactiFunkci("Funkce", "Velikost", filesize("{$cesta}/{$soub}"));
            $datum = date("d.m.Y / H:i:s", filemtime("{$cesta}/{$soub}"));

            $result .=
            "<br />
            {$odsazeni} soubor: {$soub} ({$velikost}) {$datum}<br />
            {$odsazeni} relativni cesta: ../{$cesta}/{$soub} <a href=\"../{$cesta}/{$soub}\">{$soub}</a><br />
            {$odsazeni} absolutni cesta: {$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}{$cesta}/{$soub} <a href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}{$cesta}/{$soub}\">{$soub}</a><br />
            {$odsazeni} <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfile&amp;file={$cesta}/{$soub}\" title=\"\">upravit soubor</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfile&amp;file={$cesta}/{$soub}\" title=\"\" onclick=\"return confirm('Opravdu smazat soubor: \'{$soub}\' ?');\">smazat soubor</a>
            {$obr}
            ";
            $j++;
          break;
        }
      }
    }
    closedir($handle);

    $result .=
    "<br />
    {$odsazeni} počet složek: {$i}<br />
    {$odsazeni} počet souborů: {$j}
    ";

    return $result;
  }

/**
 *
 * Vypis administrace menu
 *
 * @return vypis menu v html
 */
  private function AdminVypisData()
  {
    $cesta = $this->pathdata;
    $handle = opendir($cesta);
    $i = $j = 0;
    $obr = "";
    $result = "";
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        $pocet = count(explode("/", "{$cesta}/{$soub}")) - 4;
        $odsazeni = str_repeat("----", $pocet);

        switch (filetype("{$cesta}/{$soub}"))
        {
          case "dir":
            $rek = $this->RekurzivniVypis("{$cesta}/{$soub}");

            $result .=
            "<br />
            {$odsazeni} složka: {$soub}, zanoreni: {$pocet}<br />
            {$odsazeni} <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$cesta}/{$soub}\" title=\"\">přidat soubor</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$cesta}/{$soub}\" title=\"\">přidat podsložku</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editdir&amp;file={$cesta}/{$soub}\" title=\"\">upravit složku</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deldir&amp;file={$cesta}\" title=\"\" onclick=\"return confirm('Opravdu smazat složku: \'{$soub}\' ?');\">smazat složku</a>
            {$rek}";
            $i++;
          break;

          case "file":
            $a = explode(".", basename("{$cesta}/{$soub}"));
            $suffix = strtolower($a[1]);
            $obr = ($suffix == "jpg" ||
                    $suffix == "png" ||
                    $suffix == "gif" ?
                    "<img src=\"{$cesta}/{$soub}\" width=\"100px\" height=\"100px\" />" : "");

            $velikost = $this->var->main[0]->NactiFunkci("Funkce", "Velikost", filesize("{$cesta}/{$soub}"));
            $datum = date("d.m.Y / H:i:s", filemtime("{$cesta}/{$soub}"));

            $result .=
            "<br />
            {$odsazeni} soubor: {$soub} ({$velikost}) {$datum}<br />
            {$odsazeni} relativni cesta: ../{$cesta}/{$soub} <a href=\"../{$cesta}/{$soub}\">{$soub}</a><br />
            {$odsazeni} absolutni cesta: {$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}{$cesta}/{$soub} <a href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}{$cesta}/{$soub}\">{$soub}</a><br />
            {$odsazeni} <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfile&amp;file={$cesta}/{$soub}\" title=\"\">upravit soubor</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfile&amp;file={$cesta}/{$soub}\" title=\"\" onclick=\"return confirm('Opravdu smazat soubor: \'{$soub}\' ?');\">smazat soubor</a>
            {$obr}
            ";
            $j++;
          break;
        }

      }
    }
    closedir($handle);

    $result .=
    "<br />
    {$odsazeni} počet složek: {$i}<br />
    {$odsazeni} počet souborů: {$j}
    ";

    return $result;
  }
}
?>
