<?php

/**
 *
 * Blok datovy sklad
 *
 * public funkce:\n
 * construct: DataStorage - hlavni konstruktor tridy\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DataStorage extends DefaultModule
{
  private $var, $unikatni;
  private $idmodul = "datstor";
  private $dirpath;
  private $pomer = 10; //% pomer fotek typu, jpg, gif, png

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

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    //vyresit duplikace.. prepinani duplikatnich obsahu na ukor admin menu

    //unikatni nastaveni promenych
    $this->pomer = $this->NactiUnikatniObsah($this->unikatni["set_pomer"]);
    $this->pathdata = $this->NactiUnikatniObsah($this->unikatni["set_pathdata"]);

    $this->pathdata = "{$this->dirpath}/{$this->pathdata}";

    if (!file_exists($this->pathdata))
    {
      mkdir($this->pathdata, 0777);
    }

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"], $this->idmodul));
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
      $modul = explode("_", $_GET[$this->var->get_idmodul]);

      switch ($modul[0])
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
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$this->pathdata}",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$this->pathdata}",
                                        $this->RekurzivniVypis($this->pathdata));

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "adddir": //pridavani slozky
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_dir"]);

          $slozka = stripslashes(htmlspecialchars($this->OsetreniNazvu($_POST["slozka"]), ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($slozka))
          {
            if (mkdir("{$_GET["file"]}/{$slozka}", 0777))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_dir_hlaska"], $slozka);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editdir": //uprava slozky
          $base = basename($_GET["file"]);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_dir"], $base);

          $nazev = stripslashes(htmlspecialchars($this->OsetreniNazvu($_POST["nazev"]), ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($nazev))
          {
            $dir = dirname($_GET["file"]);
            if (rename($_GET["file"], "{$dir}/{$nazev}"))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_dir_hlaska"], $nazev);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "deldir": //smazat slozku
          if (!Empty($_GET["file"]))
          {
            $this->DelDirFile($_GET["file"]);
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_dir_hlaska"], $_GET["file"]);
          }

          $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
        break;

        case "addfile": //pridavani soubor
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_file"]);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($_FILES["soubor"]["tmp_name"]))
          {
            $nazev = $this->OsetreniNazvu("{$this->VytvorJmenoObrazku()}__{$_FILES["soubor"]["name"]}");
            $cil = "{$_GET["file"]}/{$nazev}";
            if (move_uploaded_file($_FILES["soubor"]["tmp_name"], $cil))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_file_hlaska"], $nazev);
            }
              else
            {
              $this->var->main[0]->ErrorMsg("vyskytla se chyba při uploadu");
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editfile": //uprava slozky
          $base = basename($_GET["file"]);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_file"], $base);

          $nazev = stripslashes(htmlspecialchars($this->OsetreniNazvu($_POST["nazev"]), ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($nazev))
          {
            $dir = dirname($_GET["file"]);
            if (rename($_GET["file"], "{$dir}/{$nazev}"))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_file_hlaska"], $nazev);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "delfile": //smazat soubor
          if (!Empty($_GET["file"]))
          {
            if (unlink($_GET["file"]))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_file_hlaska"], $_GET["file"]);
              ;
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

            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_dir"],
                                                $odsazeni,
                                                $soub,
                                                $pocet,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$cesta}/{$soub}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$cesta}/{$soub}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editdir&amp;file={$cesta}/{$soub}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deldir&amp;file={$cesta}",
                                                $rek);
            $i++;
          break;

          case "file":
            $a = explode(".", basename("{$cesta}/{$soub}"));
            $suffix = strtolower($a[1]);

            if ($suffix == "jpg" ||
                $suffix == "png" ||
                $suffix == "gif")
            {
              list($w, $h) = getimagesize("{$cesta}/{$soub}");
              $new_w = ($w / 100) * $this->pomer;
              $new_h = ($h / 100) * $this->pomer;

              $obr = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_obr"],
                                              "{$cesta}/{$soub}",
                                              $new_w,
                                              $new_h);
            }
              else
            {
              $obr = "";
            }

            $velikost = $this->var->main[0]->NactiFunkci("Funkce", "Velikost", filesize("{$cesta}/{$soub}"));
            $datum = date("d.m.Y / H:i:s", filemtime("{$cesta}/{$soub}"));

            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_file"],
                                                $odsazeni,
                                                $soub,
                                                $velikost,
                                                $datum,
                                                $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl"),
                                                "{$cesta}/{$soub}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfile&amp;file={$cesta}/{$soub}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfile&amp;file={$cesta}/{$soub}",
                                                $obr);
            $j++;
          break;
        }
      }
    }
    closedir($handle);

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_sum"],
                                        $odsazeni,
                                        $i,
                                        $j);

    return $result;
  }
}
?>
