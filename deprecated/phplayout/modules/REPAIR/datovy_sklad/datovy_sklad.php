<?php

/**
 *
 * Blok datovy sklad
 *
 */

class DataStorage extends DefaultModule
{
  private $var, $unikatni, $dirpath, $absolutni_url, $polefiletypu, $poledirtypu, $pokus, $x = 0, $y = 0;
  public $idmodul = "datstor";
  public $mount = array(".unikatni_obsah.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(NODATA);  //modulem podporovane databeze
  private $pomer = 10; //% pomer fotek typu, jpg, gif, png

  private $pathdata = "soubory";

/**
 *
 * Konstruktor obsahu
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

      //unikatni nastaveni promenych
      $this->pomer = $this->unikatni["set_pomer"];
      $this->pathdata = $this->unikatni["set_pathdata"];

      $this->pathdata = "{$this->dirpath}/{$this->pathdata}";

      $this->polefiletypu = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_file_type"], $this->absolutni_url);
      $this->poledirtypu = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_dir_type"], $this->absolutni_url);

      $this->NastavKomunikaci($this->var, $index);  //pripojeni defaultu

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"], $this->idmodul));
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
 * Rekurzivni nacteni struktury adresare do kombinovaneho pole
 *
 * @param cesta cesta slozky
 * @return struktura slozek
 */
  private function RekurzivniNacteniStruktury($cesta)
  {
    $result = "";
    $slozka = "";
    $i = 0;
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        switch (filetype("{$cesta}/{$soub}"))
        {
          case "dir":
            $rek = $this->RekurzivniNacteniStruktury("{$cesta}/{$soub}");

            $slozka = $soub;
            $result[$slozka] = (!Empty($rek) ? $rek : array());
          break;

          case "file":
            $result[$i] = $soub;  //musi se napevno nastavovat indexy
            $i++;
          break;
        }

      }
    }
    closedir($handle);

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
    $struktura = $this->RekurzivniNacteniStruktury($this->pathdata);  //ziska strukturu adresaru

    $blok = "";
    $typ = "";
    $coki = $_COOKIE["STORAGEVIEW"];//$_SESSION["STORAGEVIEW"]; //$_COOKIE["STORAGEVIEW"]
    switch ($coki)  //$_COOKIE["STORAGEVIEW"]
    {
      default:
      case "tree":
        $blok = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_tree"],
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$this->pathdata}",
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$this->pathdata}",
                                          $this->RekurzivniVypis($struktura),
                                          $this->SpocitejSlozky($struktura),
                                          $this->SpocitejSoubory($struktura));

        $typ = "tree";
      break;

      case "lefttree":
        $blok = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_lefttree"],
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$this->pathdata}",
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$this->pathdata}",
                                          $this->LeftTreeView($struktura));
        $typ = "lefttree";
      break;

      case "classic":
        $blok = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_classic"],
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$this->pathdata}",
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$this->pathdata}",
                                          $this->ClassicView());
        $typ = "classic";
      break;
    }

    if (!Empty($_GET["view"]))
    {
      SetCookie("STORAGEVIEW", $_GET["view"], Time() + 31536000); //zápis do cookie

      $blok = $this->unikatni["admin_obsah_change"];

      $this->AutoClick(0, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;view=tree",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;view=lefttree",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;view=classic",
                                        $blok,
                                        ((Empty($_GET["view"]) && $_GET["view"] == "tree") || (!Empty($coki) && $coki == "tree") || Empty($coki) ? $this->unikatni["admin_obsah_aktivni"] : ""),
                                        ($_GET["view"] == "lefttree" || $coki == "lefttree" ? $this->unikatni["admin_obsah_aktivni"] : ""),
                                        ($_GET["view"] == "classic" || $coki == "classic" ? $this->unikatni["admin_obsah_aktivni"] : ""));



    if (!file_exists($this->pathdata))  //vytvori si vlastni soubor
    {
      mkdir($this->pathdata, 0777);
    }

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "adddir": //pridavani slozky
          //kdyz je aktualni vetsi/rovno jak maximalni tak blok
          $podm = !((count(explode("/", $_GET["file"])) - 3) >= $this->unikatni["admin_max_zanoreni"]);

          $result = ($podm ? $this->NactiUnikatniObsah($this->unikatni["admin_add_dir"],
                                                      "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}") :
                            $this->unikatni["admin_add_dir_max"]);

          $slozka = stripslashes(htmlspecialchars($this->RewritePrepis($_POST["nazev"]), ENT_QUOTES));

          $podmfile = !(strlen($_GET["file"]) < strlen($this->pathdata)); //zaruceni ukladani je tam kam ma

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($slozka) &&
              $podm &&
              $podmfile)
          {
            if (mkdir("{$_GET["file"]}/{$slozka}", 0777))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_dir_hlaska"], $slozka);
            }

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editdir": //uprava slozky
          $base = basename($_GET["file"]);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_dir"],
                                              $base,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $nazev = stripslashes(htmlspecialchars($this->RewritePrepis($_POST["nazev"]), ENT_QUOTES));

          $podmfile = !(strlen($_GET["file"]) <= strlen($this->pathdata)); //zaruceni ukladani je tam kam ma

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($nazev) &&
              $podmfile)
          {
            $dir = dirname($_GET["file"]);
            if (rename($_GET["file"], "{$dir}/{$nazev}"))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_dir_hlaska"], $nazev);
            }

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "deldir": //smazat slozku
          if (!Empty($_GET["file"]))
          {
            $podm = !(strlen(dirname($_GET["file"])) < strlen($this->pathdata));

            if ($podm)
            {
              $this->DelDirFile($_GET["file"]);
              @rmdir($_GET["file"]); //maze slozku

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_dir_hlaska"], basename($_GET["file"]));
            }

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "addfile": //pridavani soubor
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_file"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($_FILES["soubor"]["tmp_name"]))
          {
            $adresar = $_GET["file"]; //adresar
            //$jmeno = $this->RewritePrepis($_FILES["soubor"]["name"]); //defaultni jmeno souboru
            $a = explode(".", $_FILES["soubor"]["name"]);
            $jmeno = "{$this->RewritePrepis(implode(" ", array_slice($a, 0, -1)))}.{$a[count($a) - 1]}";

            //overi existenci, kdyz existuje da puvodni, jinak prida pred nazev nudli datumu
            $cil = (!file_exists("{$adresar}/{$jmeno}") ? "{$adresar}/{$jmeno}" : "{$adresar}/{$this->VytvorJmenoObrazku()}_{$jmeno}");
            if (move_uploaded_file($_FILES["soubor"]["tmp_name"], $cil))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_file_hlaska"], $cil);
            }
              else
            {
              $this->ErrorMsg($this->unikatni["admin_error_upload"], array(__LINE__, __METHOD__));
            }

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editfile": //uprava slozky
          $base = basename($_GET["file"]);  //ziskani souboru
          $dir = dirname($_GET["file"]);  //ziskani slozky

          $rozdel = explode(".", $base);  //rozdeleni jmena
          $nazev = implode(".", array_slice($rozdel, 0, -1)); //slouceni textovych nazvu zpet
          $pripona = $rozdel[count($rozdel) - 1]; //ziskani koncovky

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_file"],
                                              $base,
                                              $nazev,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_GET["file"]) &&
              !Empty($_POST["nazev"]))
          {
            $new = $this->RewritePrepis($_POST["nazev"]);

            if (!Empty($_FILES["soubor"]["tmp_name"]))
            {
              $koncovka = explode(".", $_FILES["soubor"]["name"]);  //koncovku vezme ze soboru
              $koncovka = $koncovka[count($koncovka) - 1];  //extrahuje jen koncovku

              if (file_exists("{$dir}/{$new}.{$koncovka}")) //pokud nazev v inputu s koncovkou souboru existuje
              {
                $new = "{$new}-{$this->VytvorJmenoObrazku()}";  //hodi za nazev unikatn blabol
              }

              $nazev = "{$new}.{$koncovka}";  //nazev zanecha (nebo vylepsi) a da uploadovanou koncovkou
              $cil = "{$dir}/{$nazev}"; //vezme slozku a prida vygenerovany nazev
              if (move_uploaded_file($_FILES["soubor"]["tmp_name"], $cil))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_file_hlaska"], $nazev);
              }
                else
              {
                $this->ErrorMsg($this->unikatni["admin_error_upload"], array(__LINE__, __METHOD__));
              }
            }
              else
            {
              if (file_exists("{$dir}/{$new}.{$pripona}"))
              {
                $new = "{$new}-{$this->VytvorJmenoObrazku()}";
              }

              rename($_GET["file"], "{$dir}/{$new}.{$pripona}");

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_rename_file_hlaska"], "{$new}.{$pripona}");
            }

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "delfile": //smazat soubor
          if (!Empty($_GET["file"]))
          {
            if (unlink($_GET["file"]))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_file_hlaska"], basename($_GET["file"]));
            }
          }

          $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
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
      if ($soub != ".." && $soub != ".")
      {
        if (is_file("{$jmeno}/{$soub}")) //kdyz je soubor
        {
          @unlink("{$jmeno}/{$soub}");  //maze soubor
        }
          else
        { //kdyz je slozka
          $this->DelDirFile("{$jmeno}/{$soub}");  //rekurze
          @rmdir("{$jmeno}/{$soub}"); //maze slozku
        }
      }
    }
    closedir($handle);
  }

/**
 *
 * Vrati pocet slozek ve slozce
 *
 * @param struktura pole struktury slozky
 * @return pocet slozek
 */
  private function SpocitejSlozky($struktura)
  {
    $pocfile = 0;
    $pocdir = 0;
    if (is_array($struktura))
    {
      $klice = array_keys($struktura);

      for ($i = 0; $i < count($klice); $i++)
      {
        if (!is_array($struktura[$klice[$i]]))  //kontroluje jestli neni pole v hodnete
        {
          $pocfile++;
        }
          else
        {
          $pocdir++;
        }
      }
    }

    return $pocdir;
  }

/**
 *
 * Vrati pocet souboru ve slozce
 *
 * @param struktura pole struktury slozky
 * @return pocet souboru
 */
  private function SpocitejSoubory($struktura)
  {
    $pocfile = 0;
    $pocdir = 0;
    if (is_array($struktura))
    {
      $klice = array_keys($struktura);

      for ($i = 0; $i < count($klice); $i++)
      {
        if (!is_array($struktura[$klice[$i]]))  //kontroluje jestli neni pole v hodnete
        {
          $pocfile++;
        }
          else
        {
          $pocdir++;
        }
      }
    }

    return $pocfile;
  }

/**
 *
 * Vrati nejcastejsi typ soboru ve slozce
 *
 * @param struktura pole struktury slozky
 * @return koncovka nejvic uzivaneho souboru
 */
  private function NejTypSoboru($struktura)
  {
    $klice = array_keys($struktura);

    $suffix = "";
    $kon = "";
    for ($i = 0; $i < count($klice); $i++)
    {
      if (is_numeric($klice[$i]))
      {
        //$pocfile++;
        $kon = explode(".", $struktura[$klice[$i]]);
        $suffix[] = $kon[count($kon) - 1];
      }
        else
      {
        //$pocdir++;
      }
    }

    $sufflip = "";
    if (is_array($suffix))
    {
      $suffpoc = array_count_values($suffix);
      $sufflip = array_flip($suffpoc);
      $maxsuff = max($suffpoc);
    }

    return $sufflip[$maxsuff];
  }

/**
 *
 * Vrati pocet slozek ve slozce
 *
 * @param cesta cesta slozky
 * @return pocet slozek
 */
  private function SpocitejSlozkyFileSystemem($cesta)
  {
    $handle = opendir($cesta);
    $pocfile = 0;
    $pocdir = 0;
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        switch (filetype("{$cesta}/{$soub}"))
        {
          case "dir":
            $pocdir++;
          break;

          case "file":
            $pocfile++;
          break;
        }
      }
    }
    closedir($handle);

    return $pocdir;
  }

/**
 *
 * Vrati pocet souboru ve slozce
 *
 * @param cesta cesta slozky
 * @return pocet souboru
 */
  private function SpocitejSouboryFileSystemem($cesta)
  {
    $handle = opendir($cesta);
    $pocfile = 0;
    $pocdir = 0;
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        switch (filetype("{$cesta}/{$soub}"))
        {
          case "dir":
            $pocdir++;
          break;

          case "file":
            $pocfile++;
          break;
        }
      }
    }
    closedir($handle);

    return $pocfile;
  }

/**
 *
 * Vrati nejcastejsi typ soboru ve slozce
 *
 * @param cesta cesta slozky
 * @return koncovka nejvic uzivaneho souboru
 */
  private function NejTypSoboruFileSystemem($cesta)
  {
    $handle = opendir($cesta);
    $pocfile = 0;
    $pocdir = 0;
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        if (is_file("{$cesta}/{$soub}"))
        {
          $kon = explode(".", $soub);
          $suffix[] = $kon[count($kon) - 1];
        }
      }
    }
    closedir($handle);

    $sufflip = "";
    if (is_array($suffix))
    {
      $suffpoc = array_count_values($suffix);
      $sufflip = array_flip($suffpoc);
      $maxsuff = max($suffpoc);
    }

    return $sufflip[$maxsuff];
  }

/**
 *
 * Rekurzivni vypis adresare
 *
 * @param cesta adresare
 * @return vypis pod-adresare
 */
  private function RekurzivniVypis($struktura, $slozka = NULL)  //cesta
  {
    $result = "";
    $pocfiles = 0;
    $pocdirs = 0;
    //$max = "";
    if (is_array($struktura))
    {
      asort($struktura);
      $klice = array_keys($struktura);

      for ($i = 0; $i < count($klice); $i++)
      {
        if (is_numeric($klice[$i]))
        {
          $pocfiles++;
        }
          else
        {
          $pocdirs++;
        }
      }

      $zan = count(explode("/", $slozka));
      $odsazeni = $this->unikatni["admin_nasobitel_odsazeni"] * $zan;

      $dir = (!Empty($slozka) ? substr("/{$slozka}", 1) : $slozka);
      $pathdir = "{$this->pathdata}{$dir}/";


      $vnorene = "";
      $pfile = 0;
      $pdir = 0;
      for ($i = 0; $i < count($klice); $i++)
      {
        //kdyz neni pole vypisuje soubory
        if (!is_array($struktura[$klice[$i]]))  //(is_numeric($klice[$i])) //soubory (files)
        {
          $a = explode(".", $struktura[$klice[$i]]);
          $suffix = strtolower($a[count($a) - 1]);
          $pfile++;

          if ($suffix == "jpg" ||
              $suffix == "png" ||
              $suffix == "gif")
          {
            list($w, $h) = getimagesize("{$pathdir}{$struktura[$klice[$i]]}");
            $new_w = ($w / 100) * $this->pomer;
            $new_h = ($h / 100) * $this->pomer;

            $obr = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_obr"],
                                            "{$pathdir}{$struktura[$klice[$i]]}",
                                            $new_w,
                                            $new_h,
                                            $struktura[$klice[$i]]);
          }
            else
          {
            $obr = "";
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_file"],
                                              $odsazeni,
                                              $struktura[$klice[$i]], //nazev souboru
                                              $zan,
                                              $this->Velikost(filesize("{$pathdir}{$struktura[$klice[$i]]}")),
                                              date($this->unikatni["admin_vypis_datum"], filemtime("{$pathdir}{$struktura[$klice[$i]]}")),
                                              $this->absolutni_url,
                                              "{$pathdir}{$struktura[$klice[$i]]}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfile&amp;file={$pathdir}{$struktura[$klice[$i]]}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfile&amp;file={$pathdir}{$struktura[$klice[$i]]}",
                                              $obr,
                                              (array_key_exists($suffix, $this->polefiletypu) ? $this->polefiletypu[$suffix] : $this->polefiletypu["default"]),
                                              ($i == (count($klice) - 1) ? $this->unikatni["admin_vypis_file_posledni"] : ""));
        }
          else
        {
          $pdir++; //adresare (dir)

          $rek = $this->RekurzivniVypis($struktura[$klice[$i]], "{$slozka}/{$klice[$i]}");

          $pocdir = $this->SpocitejSlozky($struktura[$klice[$i]]);
          $pocfile = $this->SpocitejSoubory($struktura[$klice[$i]]);
  //        $typ = ( ? "dir_empty" : );
          if ($pocdir == 0 && $pocfile == 0)  //kdyz bude slozka uplne prazdna
          {
            $typ = $this->poledirtypu["empty"]; //prazdne
          }
            else
          {
            if ($pocfile == 0)  //kdyz budou ve slozce jen slozky
            {
              $typ = $this->poledirtypu["dir"]; //slozka
            }
              else
            {
              $suffix = $this->NejTypSoboru($struktura[$klice[$i]]);
              $typ = (array_key_exists($suffix, $this->poledirtypu) ? $this->poledirtypu[$suffix] : $this->poledirtypu["unknown"]);
            }

          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_dir"],
                                              $odsazeni,
                                              $klice[$i], //$sloz,  //nazev slozky
                                              $zan,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$pathdir}{$klice[$i]}",
                                              ($zan < $this->unikatni["admin_max_zanoreni"] ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_dir_adddir"], //povolovani odkazu na dalsi slozku
                                                                                                                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$pathdir}{$klice[$i]}",
                                                                                                                                                    $klice[$i]) : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editdir&amp;file={$pathdir}{$klice[$i]}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deldir&amp;file={$pathdir}{$klice[$i]}",
                                              $rek,
                                              $typ, //"typ slozky",//$this->poletypu["dir"],
                                              $pocdir,
                                              $pocfile,
                                              ($i == (count($klice) - 1) ? $this->unikatni["admin_vypis_dir_posledni"] : ""));
        }
      }
    }



    return $result;
  }

/**
 *
 * Vypis slozky a zaklade zadane cesty
 *
 * @param slozka cesta adresare
 * @return vypis slozeka a souboru
 */
  private function VykresliDanouSlozku($slozka)
  {
    $cesta = (!Empty($slozka) ? (strlen(dirname($slozka)) < strlen($this->pathdata) ? $this->pathdata : $slozka) : $this->pathdata);

    $result = "";
    $handle = opendir($cesta);
    $obsah = NULL;

    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        switch (filetype("{$cesta}/{$soub}"))
        {
          case "dir":
            $obsah[] = $soub;
          break;

          case "file":
            $obsah[] = $soub;
          break;
        }
      }
    }
    closedir($handle);

    $mindir = (strlen(dirname($cesta)) < strlen($this->pathdata) ? $cesta : dirname($cesta));
    $podm = (strlen(dirname($cesta)) >= strlen($this->pathdata));

    $zan = count(explode("/", $cesta)) - 2;
    $odsazeni = $this->unikatni["admin_vypis_dane_slozky_nasobitel_odsazeni"] * $zan;

    $currdir = ($cesta == $this->pathdata ? $this->unikatni["admin_vypis_dane_slozky_root"] : basename($cesta));

    $result[] = ($podm ?
                $this->NactiUnikatniObsah($this->unikatni["admin_vypis_dane_slozky_up"],
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;dir={$mindir}") : "");

    $result[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_dane_slozky_link"],  //add file
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$cesta}",
                                          ($zan < $this->unikatni["admin_max_zanoreni"] ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_dane_slozky_addlink"], //povolovani odkazu na dalsi slozku, adddir
                                                                                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$cesta}",
                                                                                                                    $currdir) : ""),
                                          ($podm ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_dane_slozky_dellink"],  //edit+del dir
                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editdir&amp;file={$cesta}",
                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deldir&amp;file={$cesta}",
                                                                            $currdir) : ""),
                                          $currdir);

    if (count($obsah) > 0)  //kdyz obsahuje vic jak 0 polozek
    {
      sort($obsah);  //serazeni obsahu

      for ($i = 0; $i < count($obsah); $i++)
      {
        if (is_dir("{$cesta}/{$obsah[$i]}"))
        {
          //pridat rozlsovani typu
          $pocdir = $this->SpocitejSlozkyFileSystemem("{$cesta}/{$obsah[$i]}");
          $pocfile = $this->SpocitejSouboryFileSystemem("{$cesta}/{$obsah[$i]}");

          if ($pocdir == 0 && $pocfile == 0)  //kdyz bude slozka uplne prazdna
          {
            $typ = $this->poledirtypu["empty"]; //prazdne
          }
            else
          {
            if ($pocfile == 0)  //kdyz budou ve slozce jen slozky
            {
              $typ = $this->poledirtypu["dir"]; //slozka
            }
              else
            {
              $suffix = $this->NejTypSoboruFileSystemem("{$cesta}/{$obsah[$i]}");
              $typ = (array_key_exists($suffix, $this->poledirtypu) ? $this->poledirtypu[$suffix] : $this->poledirtypu["unknown"]);
            }
          }

          $result[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_dane_slozky_dir"],
                                                $odsazeni,
                                                $obsah[$i],
                                                $zan,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;dir={$cesta}/{$obsah[$i]}",
                                                $this->absolutni_url,
                                                "{$cesta}/{$obsah[$i]}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfile&amp;file={$cesta}/{$obsah[$i]}",
                                                ($zan < $this->unikatni["admin_max_zanoreni"] ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_dane_slozky_dir_adddir"], //povolovani odkazu na dalsi slozku
                                                                                                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adddir&amp;file={$cesta}",
                                                                                                                          $obsah[$i]) : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editdir&amp;file={$cesta}/{$obsah[$i]}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deldir&amp;file={$cesta}/{$obsah[$i]}",
                                                $typ,
                                                $pocdir,
                                                $pocfile);
        }
          else
        {
          $a = explode(".", $obsah[$i]);
          $suffix = strtolower($a[count($a) - 1]);

          if ($suffix == "jpg" ||
              $suffix == "png" ||
              $suffix == "gif")
          {
            list($w, $h) = getimagesize("{$cesta}/{$obsah[$i]}");
            $new_w = ($w / 100) * $this->pomer;
            $new_h = ($h / 100) * $this->pomer;

            $obr = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_dane_slozky_obr"],
                                            "{$cesta}/{$obsah[$i]}",
                                            $new_w,
                                            $new_h,
                                            $obsah[$i]);
          }
            else
          {
            $obr = "";
          }

          $result[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_dane_slozky_file"],
                                                $odsazeni,
                                                $obsah[$i],
                                                $zan,
                                                $this->Velikost(filesize("{$cesta}/{$obsah[$i]}")),
                                                date($this->unikatni["admin_vypis_datum"], filemtime("{$cesta}/{$obsah[$i]}")),
                                                $this->absolutni_url,
                                                "{$cesta}/{$obsah[$i]}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfile&amp;file={$cesta}/{$obsah[$i]}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfile&amp;file={$cesta}/{$obsah[$i]}",
                                                $obr,
                                                (array_key_exists($suffix, $this->polefiletypu) ? $this->polefiletypu[$suffix] : $this->polefiletypu["default"]));
        }
      }
    }
      else
    {
      $result[] = $this->unikatni["admin_vypis_dane_slozky_empty"];
    }

    return $result;
  }

/**
 *
 * Vypis leveho stromu s jeho obsahem slozek
 *
 * @param struktura nacrena struktura adresaru
 * @return vypis leveho stromu a jeho obsahu
 */
  private function LeftTreeView($struktura)
  {
    $tree = $this->RekurzivniVypisLeftTree($struktura);
    $dir = $this->VykresliDanouSlozku($_GET["dir"]);

    $vypis = "";
    for ($i = 0; $i < count($dir); $i++)
    {
      $vypis .= $this->NactiUnikatniObsah($this->unikatni["admin_left_tree_polozka"],
                                          $dir[$i]);
    }

    $podm = ((!Empty($_GET["dir"]) ? $_GET["dir"] : $this->pathdata) == $this->pathdata);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_left_tree_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                        ($podm ? $this->unikatni["admin_rekurzivni_tree_aktivni"] : ""),
                                        $tree,
                                        $vypis);

    return $result;
  }

/**
 *
 * Rekurzivne vypisuje strom slozek
 *
 * @param struktura nactena struktura adresaru
 * @param slozka urdzuje cestu adresaroveho stromu
 * @return stromovy vypis adresaru
 */
  private function RekurzivniVypisLeftTree($struktura, $slozka = NULL)
  {
    $result = "";
    if (is_array($struktura))
    {
      asort($struktura);
      $klice = array_keys($struktura);

      for ($i = 0; $i < count($klice); $i++)
      {
        $zan = count(explode("/", $slozka));
        $odsazeni = $this->unikatni["admin_rekurzivni_tree_nasobitel_odsazeni"] * $zan;

        if (is_array($struktura[$klice[$i]]))  //(is_numeric($klice[$i])) //soubory (files)
        {
          $rek = $this->RekurzivniVypisLeftTree($struktura[$klice[$i]], "{$slozka}/{$klice[$i]}");

          $podm = ((!Empty($_GET["dir"]) ? $_GET["dir"] : $this->pathdata) == "{$this->pathdata}{$slozka}/{$klice[$i]}");

          $pocdir = $this->SpocitejSlozky($struktura[$klice[$i]]);
          $pocfile = $this->SpocitejSoubory($struktura[$klice[$i]]);

          if ($pocdir == 0 && $pocfile == 0)  //kdyz bude slozka uplne prazdna
          {
            $typ = $this->poledirtypu["empty"]; //prazdne
          }
            else
          {
            if ($pocfile == 0)  //kdyz budou ve slozce jen slozky
            {
              $typ = $this->poledirtypu["dir"]; //slozka
            }
              else
            {
              $suffix = $this->NejTypSoboru($struktura[$klice[$i]]);
              $typ = (array_key_exists($suffix, $this->poledirtypu) ? $this->poledirtypu[$suffix] : $this->poledirtypu["unknown"]);
            }
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_rekurzivni_tree_dir"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;dir={$this->pathdata}{$slozka}/{$klice[$i]}",
                                              $klice[$i],
                                              ($podm ? $this->unikatni["admin_rekurzivni_tree_aktivni"] : ""),
                                              $zan,
                                              $odsazeni,
                                              $typ, //"typ slozky",//$this->poletypu["dir"],
                                              $pocdir,
                                              $pocfile);

          if (!Empty($rek))
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_rekurzivni_tree_rek"],
                                                $klice[$i],
                                                $rek);
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Vykresluje drobeckovou navigaci
 *
 * @param slozka aktualni slozka
 * @return dlouha nudle drobeckove navigace
 */
  private function DrobeckovaNavigaceObsahu($slozka)
  {
    $cesta = (!Empty($slozka) ? $slozka : $this->pathdata);

    //$cesta = (strlen(dirname($cesta0)) < strlen($this->pathdata) ? $cesta0 : dirname($cesta0));

    $pole = explode("/", $cesta);

    $mezicesta = "{$this->pathdata}";
    $podm = ((!Empty($_GET["dir"]) ? $_GET["dir"] : $this->pathdata) == $mezicesta);

    $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_drobecky_root"],
                                      "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;dir={$this->pathdata}",
                                      ($podm ? $this->unikatni["admin_drobecky_aktivni"] : ""));

    for ($i = 3; $i < count($pole); $i++)
    {
      $mezicesta .= "/{$pole[$i]}";
      $podm = ($_GET["dir"] == $mezicesta);
      $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_drobecky_link"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;dir={$mezicesta}",
                                        $pole[$i],
                                        ($podm ? $this->unikatni["admin_drobecky_aktivni"] : ""));
    }

    $result = implode($this->unikatni["admin_drobecky_implode"], $res);

    return $result;
  }

/**
 *
 * Vykresluje klascky tvar vypisu slozky
 *
 * @return klasicky vypis
 */
  private function ClassicView()
  {
    $drobek = $this->DrobeckovaNavigaceObsahu($_GET["dir"]);
    $dir = $this->VykresliDanouSlozku($_GET["dir"]);

    $vypis = "";
    for ($i = 0; $i < count($dir); $i++)
    {
      $vypis .= $this->NactiUnikatniObsah($this->unikatni["admin_classic_polozka"],
                                          $dir[$i]);
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_classic_obsah"],
                                        $drobek,
                                        $vypis);

    return $result;
  }


}
?>
