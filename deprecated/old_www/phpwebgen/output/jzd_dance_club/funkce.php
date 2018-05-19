<?php

/**
 * Nacteni defaultniho modulu default_modul
 */
class AutoStart
{
/*
 * Konstruktor autostartu
 *
 * @return nacteny default_modul
 */
  public function __construct()
  {
    $cesta = "default_modul.php";

    if (file_exists($cesta))
    {
      include_once $cesta;
    }
      else
    {
      echo "soubor: <strong>{$cesta}</strong> nelze nalezt, zkontrolujte zda dany soubor existuje";
      exit(1);
    }
  }
}

$start = new AutoStart(); //vkladani default_modul

/**
 *
 * Centralni funkce projektu
 *
 * public funkce:\n
 * construct: Funkce - hlavni konstruktor tridy\n
 * StartCas() - zacatek stopovani casu\n
 * KonecCas() - konec stopovani casu\n
 * OdkazZpet() - hypertextovy odkaz zpet\n
 * ErrorMsg() - globalni vypis chybovych hlasek\n
 * AutoClick() - meta odkaz na auto presmerovani\n
 * TypOS() - zjisteni  typu OS\n
 * TypBrowseru() - zjisteni typu Browseru\n
 * ExistenceUrl() - kontrola existence url\n
 * NactiUrl() - stahne obsah url stranky do promenne\n
 * Velikost() - dle dane velikosti vrati prepocitanou jednotku\n
 * KontrolaEmailu() - kontrola emailu za pomoci regularnich vyrazu\n
 * DetekceLinuxu() - detekce linuxu\n
 * DetekceOpery() - detekuje operu\n
 * CasAktualizace() - vypise text aktualizace\n
 *
 * PrepisAdresy() - prepis adresy do pekne formy\n
 * ZpetnyPrepisAdresy() - zpetny prepis do puvodni formy\n
 *
 * NactiFunkci() - nacte danou funkci z daneho modulu udaneho indexem, i s danym parametrem\n
 * AbsoluteUrl() - vrati absolutni adresu webu\n
 * NactiObsahSouboru() - nacte obsah php souboru, krety konci returnem, ve slozce included\n
 * NactiUnikatniObsah() - nacte unikatni obsah ze souboru, obsah tvori asociativni pole\n
 * AdminObsah() - obsah adminu\n
 * InicializaceModulu() - inicialiazce vsech modulu\n
 *
 * GenerovaniAdminTitle() - generovani title adminu\n
 * CallAdminTitle() - volani na vykresleni title\n
 * GenerovaniAdminMenu() - generovani menu adminu\n
 * CallAdminMenu() - volani na vykresleni menu\n
 * GenerovaniAdminObsah() - generovani obsahu adminu\n
 *
 * url serveru: $_SERVER["SERVER_NAME"]\n
 * d.m.Y / H:i:s\n
 * header("Location: {$this->AbsoluteUrl()}");\n
 */
class Funkce extends DefaultModule
{
  private $start, $konec, $var, $unikatni;
  private $idmodul = "funkce";
  private $idzaloha = "zaloha";
  private $iddelzal = "delzal";
  private $idupp = "up";

  private $get_check = "check";
  private $get_download = "down";
  private $get_zdrojstazeni = "source";
  private $get_showsource = "soucefile";

/**
 *
 * Konstruktor funkce
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 *
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru(".unikatni_fukce.php", false);

    $this->StartSession();

    if ($this->var->autoklenot)  //kdyz bude IP v bloku tak jde o lokalhost tedy, o klenot se nejedna
    {
      $this->var->klenot = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? true : false);
    }

    $verze = $this->KontrolaVerze();
    if ($verze < 5) //kontrola verze, kvuli php5
    {
      $this->ErrorMsg("máte příliš starou verzi php: (PHP{$verze}), potřebujete minimálně verzi PHP5", NULL, true);
      exit(1);
    }

    //$this->Instalace();

    $this->Prihlasovani();

    $this->AutoZalohovani();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul,
                                                        "{$this->idmodul}{$this->idzaloha}"));
  }

/**
 *
 * Startuje session
 *
 */
  private function StartSession() //aktvuje session promenne
  {
    //session_name("SSID"); //nastaveni jmena session
    session_register("ADMIN_USER");
    session_register("ADMIN_PASS");
    session_register("ADMIN_TIME");

    session_start();
  }

/**
 *
 * Vrati absolutni adresu s pathem
 *
 * pouziti: <strong>$url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");</strong>
 *
 * @return absolutni adresa
 */
  public function AbsoluteUrl()
  {
    $path = dirname($_SERVER["SCRIPT_NAME"]);
    $result = "http://{$_SERVER["SERVER_NAME"]}".($path != "/" ? "{$path}" : "")."/";

    return $result;
  }

/**
 *
 * Zjist verzi php
 *
 * @return cislo verze
 */
  private function KontrolaVerze()
  {
    $verze = explode(".", phpversion());
    $result = $verze[0];
    settype($result, "integer");

    return $result;
  }

/**
 *
 * Zavola danou funkci z daneho indexu tridy, dokaze zpracovat libovolne mnozstvi parametru
 *
 * pouziti: <strong>$navrat = $this->var->main[0]->NactiFunkci("Funkce|index", "NazevFunkce", [parametry, [...]]);</strong>
 *
 * @param index index nebo nazev funkce pro $this->var->main
 * @param funkce volana public funkce
 * @return obsah funkce
 */
  public function NactiFunkci($index, $funkce)
  {
    $paramatr = func_get_args();
    $pocet = func_num_args();
    $argv = array();

    if ($pocet > 2)
    {
      for ($i = 2, $j = 0; $i < $pocet; $i++, $j++)
      {
        $argv[$j] = $paramatr[$i];  //prevedeni parametru
      }
    }

    //echo ($this->var->debug_mod ? "načtené moduly: {$index}, {$funkce}<br />" : "");

    if (is_string($index))
    {
      $cis = $this->NajdiIndexPodleTridy($index); //vrati index tridy - je-li nalezeno

      if ($cis == -1)
      {
        $this->ErrorMsg("POZOR! Nepodařilo se najít třídu s názvem: ''{$index}'' !!");
      }
        else
      {
        $index = $cis;
      }
    }

    $result = "";
    if ($cis != -1)
    {
      if (method_exists($this->var->moduly[$index]["class"], $funkce))
      {
        $result = call_user_func_array(array($this->var->main[$index], $funkce), $argv);  //trida::funkce, parametry
      }
        else
      {
        if (!Empty($this->var->moduly[$index]["class"]))
        {
          $this->ErrorMsg("POZOR! U třídy: ''{$this->var->moduly[$index]["class"]}'' se neporařilo načíst funkci: ''{$funkce}''!");
        }
          else
        {
          $this->ErrorMsg("POZOR! Nepodařilo se najít třídu o indexu:  ''{$index}'' ");
        }
      }
    }

    return $result;
  }

/**
 *
 * Najde index podle zadane tridy
 *
 * @param trida nazev tridy
 * @return cislo indexu
 */
  public function NajdiIndexPodleTridy($trida)
  {
    $result = -1;
    for ($i = 0; $i < count($this->var->moduly); $i++)
    {
      if ($this->var->moduly[$i]["class"] == $trida)
      {
        $result = $i;
        break;
      }
    }

    return $result;
  }

/**
 *
 * Hlavni inicializace modulu
 *
 */
  public function InicializaceModulu()
  {
    for ($i = 1; $i < count($this->var->moduly); $i++)
    {
      if (file_exists($this->var->moduly[$i]["include"]))
      {
        include_once "{$this->var->moduly[$i]["include"]}";
        if (class_exists($this->var->moduly[$i]["class"]))
        {
          if (method_exists($this->var->moduly[$i]["class"], "__construct"))
          {
            $this->var->main[$i] = new $this->var->moduly[$i]["class"]($this->var, $i);
          }
            else
          {
            $this->ErrorMsg("POZOR! Z třídy: ''{$this->var->moduly[$i]["class"]}'', metoda konstruktoru neexistuje");
          }
        }
          else
        {
          $this->ErrorMsg("POZOR! Třída:  ''{$this->var->moduly[$i]["class"]}'' neexistuje!!");
        }
      }
        else
      {
        $this->ErrorMsg("POZOR! Třída:  ''{$this->var->moduly[$i]["class"]}'' nema svoje zastoupení v modulech");
      }
    }
  }

/**
 *
 * Volana globaln funkce generujici title
 *
 * @param admin_menu menu nadefinovane ve dvourozmenrem poli
 * @return vygenerovany title
 */
  public function CallAdminTitle($admin_menu)
  {
    for ($i = 0; $i < count($admin_menu); $i++)  //prochazeni adres
    {
      if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
          $_GET[$this->var->get_idmodul] == $admin_menu[$i]["main_href"])
      {
        $result = $admin_menu[$i]["title"]; //navrat nalezeneho title
        break;
      }
    }

    return $result;
  }

/**
 *
 * Volana globalni funkce generujci menu
 *
 * @param admin_menu menu nadefinovane ve dvourozmenrem poli
 * @return vygenerovane menu
 */
  public function CallAdminMenu($admin_menu)
  {
    $result = "";
    static $pocit = 0;  //pocitadlo volani funkce

    for ($i = 0; $i < count($admin_menu); $i++)  //prochazeni adres
    {
      $pocit++; //pocita volani
      $podminka = ($_GET[$this->var->get_kam] == $this->var->adresaadminu && $_GET[$this->var->get_idmodul] == $admin_menu[$i]["main_href"]);

      switch ($this->var->admin_ozn_menu)
      {
        case "odkaz":
          $ozn = explode("|--|", $this->var->select_admin_oznac["odkaz"]);  //rozdeleni oznacovace textu
          $ozn_odkaz_l = ($podminka ? $ozn[0] : "");
          $ozn_odkaz_r = ($podminka ? $ozn[1] : "");
        break;

        case "class":
          $ozn = $this->var->select_admin_oznac["class"];
          $ozn_class = ($podminka ? $ozn : "");
        break;

        case "id":
          $ozn = $this->var->select_admin_oznac["id"];
          $ozn_id = ($podminka ? $ozn : "");
        break;
      }

      //eventualni podminky pro oznaceni zacatku, konce a kazdeno eN-teho
      $prvni = (($pocit - 1) == 0 ? $this->NactiUnikatniObsah($this->unikatni["admin_menu_prvni"]) : ""); //prvni
      $posledni = ($pocit == (count($this->var->moduly) + count($admin_menu)) ?
                  $this->NactiUnikatniObsah($this->unikatni["admin_menu_posledni"]) :
                  ""); //posledni

      $ente = ($this->var->ente_definovane ?
              in_array(($pocit - 1), $this->var->ente_ozn_def) :
              (((($pocit - 1) + $this->var->ente_ozn_od) % $this->var->ente_ozn_po) == 0));  //kazde N od M nebo definovane
      $ente = ($ente ? $this->NactiUnikatniObsah($this->unikatni["admin_menu_ente"]) : "");

      $main_href = (!Empty($admin_menu[$i]["main_href"]) ? "&amp;{$this->var->get_idmodul}={$admin_menu[$i]["main_href"]}" : "");
      $class = (!Empty($admin_menu[$i]["class"]) || !Empty($ozn_class) ? " class=\"{$admin_menu[$i]["class"]}{$ozn_class}\"" : "");
      $id = (!Empty($admin_menu[$i]["id"]) || !Empty($ozn_id) ? " id=\"{$admin_menu[$i]["id"]}{$ozn_id}\"" : "");
      $akce = (!Empty($admin_menu[$i]["akce"]) ? " {$admin_menu[$i]["akce"]}" : "");

      //externi odvolani do souborum
      $result .= ($admin_menu[$i]["zobrazit"] ? $this->NactiUnikatniObsah($this->unikatni["tvar_admin_menu"], // + menu_tvar_logoff
                                                                          "{$this->var->get_kam}",
                                                                          "{$this->var->adresaadminu}{$main_href}",
                                                                          $admin_menu[$i]["odkaz"],
                                                                          $id, $class, $akce, $ozn_odkaz_l, $ozn_odkaz_r,
                                                                          $prvni, $posledni, $ente)
                                              : ($this->var->debug_mod ? "skryté: {$admin_menu[$i]["odkaz"]}<br />" : ""));
    }

    return $result;
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
        case "":  //uvod adminu
          $result = $this->NactiUnikatniObsah($this->unikatni["uvod_admin_text"],
                                              $this->var->nazevwebu,
                                              $this->SouhrnnenIformaceWebu(),
                                              $this->VypisZalohyDB());
        break;

        case $this->idmodul:  //id modul
          $result = $this->KontrolaAktualizace();
        break;

        case "{$this->idmodul}{$this->idzaloha}": //zaloha
          $result = $this->ZalohovaniSQLiteDB();
        break;

        case "{$this->idmodul}{$this->iddelzal}": //smazani souboru zalohy
          $result = $this->SmazatSouborZalohy();
        break;

        case "{$this->idmodul}{$this->idupp}":  //uploadovani verzi
          $result = $this->UploadovatNovouVerzi();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Souhrnne informace o webu
 *
 * @return vrati info
 */
  public function SouhrnnenIformaceWebu()
  {
    $moduly = $this->var->moduly;
    $sum = $dbpoc = 0;
    for ($i = 0; $i < count($moduly); $i++)
    {
      if (!Empty($moduly[$i]["databaze"]))
      {
        $path = dirname($moduly[$i]["include"]);
        $sum += filesize("{$path}/{$moduly[$i]["databaze"]}");
        $dbpoc++;
      }
    }

    $poc = count($moduly) + 2; //+ promenne + default module

    $result = $this->NactiUnikatniObsah($this->unikatni["info_admin_uvod_text"],
                                        $poc,
                                        $dbpoc,
                                        $this->Velikost($this->VelikostAdresare("modules", true)),
                                        $this->Velikost($sum),
                                        $this->Velikost($this->VelikostAdresare($this->var->zalohadir)),
                                        $this->Velikost($this->VelikostAdresare("./", true)),
                                        $this->Velikost($this->VelikostAdresare("styles", true)),
                                        $this->Velikost($this->VelikostAdresare("script", true)),
                                        $this->Velikost($this->VelikostAdresare("obr", true)),
                                        $this->Velikost($this->VelikostAdresare($this->var->souborymenu, true)));

    return $result;
  }

/**
 *
 * Rekurzivni/nerekurzivni mereni velikosti souboru/slozek
 *
 * @param cesta cesta adresare
 * @param rekurzivne rekurzivni prochazeni true/false
 * @return velikost v zakladnich jednotkach
 */
  private function VelikostAdresare($cesta, $rekurzivne = false)
  {
    $handle = opendir($cesta);
    $sum = 0;
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        switch (filetype("{$cesta}/{$soub}"))
        {
          case "dir":
            $sum += ($rekurzivne ? $this->VelikostAdresare("{$cesta}/{$soub}", $rekurzivne) : 0);
          break;

          case "file":
            $sum += filesize("{$cesta}/{$soub}");
          break;
        }

      }
    }
    closedir($handle);

    return $sum;
  }

/**
 *
 * Kontroluje aktualizace na repozitu
 *
 * @return formular s aktualizacema
 */
  private function KontrolaAktualizace()
  {
    if ($this->var->aktualizovat)
    {
      $moduly = $this->var->moduly;

      $moduly[count($moduly)] = array("include" => "promenne.php",
                                      "class" => "Promenne",
                                      "admin" => false,
                                      "databaze" => "");

      $moduly[count($moduly)] = array("include" => "default_modul.php",
                                      "class" => "DefaultModule",
                                      "admin" => false,
                                      "databaze" => "");

      $result = $this->NactiUnikatniObsah($this->unikatni["aktualizace_datum"], date("d.m.Y / H:i:s"));

      for ($i = 0; $i < count($moduly); $i++)
      {
        $nazev = $moduly[$i]["class"];
        $cesta = $moduly[$i]["include"];

        $soubor = basename($cesta); //soubor
        $adresar = dirname($cesta); //adresar
        $adresar = explode("/", $adresar);
        $adresar = (count($adresar) > 1 ? $adresar[1] : "kořen (./)");

        if (file_exists($cesta))
        {
          $velikost = filesize($cesta);  //$this->Velikost()
          $datum = filemtime($cesta); //datum na aktualnim webu, date("d.m.Y H:i:s", )
        }
          else
        {
          $datum = $this->NactiUnikatniObsah($this->unikatni["aktualizace_notexists"]);
        }

        $zprava = $this->NactiUrl("{$this->var->depozitar}?{$this->get_check}={$cesta}");  //datum na depozitu s velikosti
        $zprava_velikost = explode("-_-", $zprava); //rozdeleni na datum a velikost

        $zprava_datum = $zprava_velikost[0];  //vraceni datumu zpravy
        $zprava_velikost = $zprava_velikost[1]; //vraceni velikosti

        if (!Empty($zprava_velikost))
        {
          if ($datum == $zprava_datum)  //stejne datumy
          {
            if ($velikost == $zprava_velikost)
            {
              $info = $this->NactiUnikatniObsah($this->unikatni["aktualizace_aktualni_hlaska"]);
            }
              else
            {
              $info = $this->NactiUnikatniObsah($this->unikatni["aktualizace_aktualni_datum_hlaska"],
                                                "{$this->var->depozitar}?{$this->get_download}={$cesta}&amp;{$this->get_zdrojstazeni}={$_SERVER["SERVER_NAME"]}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idupp}&amp;file={$cesta}");
            }
          }
            else
          {
            if ($datum > $zprava_datum) //nove na tomto webu
            {
              if ($velikost == $zprava_velikost)
              {
                $info = $this->NactiUnikatniObsah($this->unikatni["aktualizace_aktualni_novejsi_hlaska"]);
              }
                else
              {
                $info = $this->NactiUnikatniObsah($this->unikatni["aktualizace_novejsi_hlaska"]);
              }
            }
              else
            {
              if ($velikost == $zprava_velikost)
              {
                $info = $this->NactiUnikatniObsah($this->unikatni["aktualizace_aktualni_depozit_hlaska"]);
              }
                else
              {
                $info = $this->NactiUnikatniObsah($this->unikatni["aktualizace_novejsi_depozit_hlaska"],
                                                  "{$this->var->depozitar}?{$this->get_download}={$cesta}&amp;{$this->get_zdrojstazeni}={$_SERVER["SERVER_NAME"]}",
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idupp}&amp;file={$cesta}");
              }
            }
          }
        }
          else
        {
          $info = $this->NactiUnikatniObsah($this->unikatni["aktualizace_null_soubor"]);
        }

        settype($datum, "integer"); //konvert na cislo
        if (!Empty($datum))
        {
          $fun_dat = date("d.m.Y / H:i:s", $datum);
        }

        settype($zprava_datum, "integer"); //konvert na cislo
        if (!Empty($zprava_datum))
        {

          $dep_dat = date("d.m.Y / H:i:s", $zprava_datum);
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["aktualizace_admin_vypis"],
                                            $nazev,
                                            $adresar,
                                            $soubor,
                                            $fun_dat,
                                            $this->Velikost($velikost),
                                            $dep_dat,
                                            (!Empty($zprava_velikost) ? "({$this->Velikost($zprava_velikost)})" : ""),
                                            $info);
      }
    }
      else
    {
      $this->ErrorMsg("Aktualizace jsou vypnuty");
    }

    return $result;
  }

/**
 *
 * Upload nove verze modulu
 *
 * @return info o uploadovani
 */
  private function UploadovatNovouVerzi()
  {
    $soubor = $_GET["file"];
    if (file_exists($soubor))
    {
      @chmod($soubor, 0777);
      @chmod(dirname($soubor), 0777);

      $result = $this->NactiUnikatniObsah($this->unikatni["upload_admin_form"], $soubor);

      $koncovka = explode(".", $_FILES["modul"]["name"]);

      if (!Empty($_FILES["modul"]["tmp_name"]) &&
          !Empty($_POST["tlacitko"]) &&
          !Empty($soubor) &&
          $_FILES["modul"]["name"] == basename($soubor) &&
          $koncovka[count($koncovka) - 1] == "php" &&
          file_exists($soubor) &&
          $soubor != "promenne.php" &&
          $soubor != "index.php" &&
          $soubor != ".htaccess")
      {
        if (move_uploaded_file($_FILES["modul"]["tmp_name"], $soubor))
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["upload_admin_finish"], $soubor);
          chmod($soubor, 0777);

          $this->var->main[0]->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
        }
          else
        {
          $this->ErrorMsg("Nastala chyba: <strong>{$_FILES["modul"]["error"]}</strong>");
        }
      }
        else
      {
        if (!Empty($_FILES["modul"]["tmp_name"]))
        {
          if ($koncovka[count($koncovka) - 1] == "php")
          {
            $this->ErrorMsg("Jiná koncovka");
          }

          if (file_exists($soubor))
          {
            $this->ErrorMsg("Soubor neexistuje");
          }

          if ($soubor != "promenne.php" &&
              $soubor != ".htaccess")
          {
            $this->ErrorMsg("Nepřípustné soubory");
          }

          if ($_FILES["modul"]["name"] == basename($soubor))
          {
            $this->ErrorMsg("Nenahráváte kompatibilní soubor");
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg("nebyl vybrán žádný soubor");
    }

    return $result;
  }

/**
 *
 * Vygenerovani title adminu
 *
 * @return admin menu
 */
  public function GenerovaniAdminTitle()
  {
    $result = "";
    for ($i = 0; $i < count($this->var->moduly); $i++)
    {
      $result .= ($this->var->moduly[$i]["admin"] ? (method_exists($this->var->moduly[$i]["class"], "AdminTitle") ? $this->var->main[$i]->AdminTitle() : "Modul menu z třídy: ''{$this->var->moduly[$i]["class"]}'' se nepodařilo načíst, aktualizujte jej prosím<br />") : "");
    }

    return $result;
  }

/**
 *
 * Vygenerovani menu adminu
 *
 * @return admin menu
 */
  public function GenerovaniAdminMenu()
  {
    $result = "";
    for ($i = 0; $i < count($this->var->moduly); $i++)
    {
      $result .= ($this->var->moduly[$i]["admin"] && $this->var->moduly[$i]["zobrazit"] ? (method_exists($this->var->moduly[$i]["class"], "AdminMenu") ? $this->var->main[$i]->AdminMenu() : "Modul menu z třídy: ''{$this->var->moduly[$i]["class"]}'' se nepodařilo načíst, aktualizujte jej prosím<br />") : "");
    }

    //nacteni zbytku menu
    $result .= $this->NactiUnikatniObsah($this->unikatni["tvar_admin_logoff"], $this->var->get_kam);  //nacteni odkazu log off + menu_tvar_admin

    return $result;
  }

/**
 *
 * Vygenerovani obsahu adminu
 *
 * @return admin obsah
 */
  public function GenerovaniAdminObsah()
  {
    $result = "";
    for ($i = 0; $i < count($this->var->moduly); $i++)
    {
      $result .= ($this->var->moduly[$i]["admin"] ? (method_exists($this->var->moduly[$i]["class"], "AdminObsah") ? $this->var->main[$i]->AdminObsah() : "Modul obsahu z třídy: ''{$this->var->moduly[$i]["class"]}'' se nepodařilo načíst, aktualizujte jej prosím<br />") : "");
    }

    return $result;
  }

/**
 *
 * Zazalohovani sqlite databazi
 *
 * @return odkaz na zip soubor
 */
  private function ZalohovaniSQLiteDB($autodown = true)
  {
    $result = "";
    if (!file_exists($this->var->zalohadir))
    {
      mkdir($this->var->zalohadir, 0777);
    }

    $cil = "{$this->var->zalohadir}/zaloha_db_".date("d-m-Y_H-i-s").".zip";

    $zip = new ZipArchive();
    if ($zip->open($cil, ZipArchive::CREATE) === true)
    {
      for ($i = 0; $i < count($this->var->moduly); $i++)
      {
        if ($this->var->moduly[$i]["admin"])  //pokud ma modul dazaba
        {
          $databaze = dirname($this->var->moduly[$i]["include"])."/".$this->var->moduly[$i]["databaze"];
          if (file_exists($databaze))
          {
            $zip->addFile($databaze);  //ulozi i se stejnou cestou!!
          }
        }
      }
      $zip->close();
    }

    if ($autodown)
    {
      header("Content-Description: File Transfer");
      header("Content-Type: application/force-download");
      header("Content-Disposition: attachment; filename=\"{$cil}\"");
      $result = readfile($cil); //vybydne ke stazeni
    }

    return $result;
  }

/**
 *
 * Stara se o automatcke zalohovani
 *
 */
  private function AutoZalohovani()
  {
    if ($this->var->autozaloha)
    {
      $cesta = $this->var->zalohadir;
      if (file_exists($cesta))
      {
        $handle = opendir($cesta);
        $i = 0;
        while($soub = readdir($handle))
        {
          if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
          {
            if (date("Y-m-d") == date("Y-m-d", filemtime("{$cesta}/{$soub}")))
            {
              $i++;
            }
          }
        }
        closedir($handle);

        if ($i == 0)
        {
          $this->ZalohovaniSQLiteDB(false); //pri prazdne slozce
        }
      }
        else
      {
        mkdir($this->var->zalohadir, 0777);  //vytvoreni a prvotni zalohovani
        $this->ZalohovaniSQLiteDB(false);
      }
    }
  }

/**
 *
 * Vypise obsah adresare zalohy
 *
 * @return seznam souboru
 */
  private function VypisZalohyDB()
  {
    $result = "";
    $cesta = $this->var->zalohadir;
    if (file_exists($cesta))
    {
      $handle = opendir($cesta);
      $i = 0;
      while($soub = readdir($handle))
      {
        if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
        {
          $soubor[$i] = $soub;
          $i++;
        }
      }
      closedir($handle);

      if ($i == 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_null"]);
      }
        else
      {
        rsort($soubor);

        $result = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_hlavicka"]);

        for ($i = 0; $i < count($soubor); $i++)
        {
          $velikost = $this->Velikost(filesize("{$cesta}/{$soubor[$i]}"));
          $datum = date("d.m.Y / H:i:s", filemtime("{$cesta}/{$soubor[$i]}"));

          $result .= $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_telicko"],
                                              ($i == (count($soubor)-1) ? " class=\"posledni-bottom\"" : ""),
                                              "{$cesta}/{$soubor[$i]}",
                                              $soubor[$i],
                                              $datum,
                                              $velikost,
                                              "{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iddelzal}");

          if (filemtime("{$cesta}/{$soubor[$i]}") <= mktime(0, 0, 0, date("n"), date("j") - $this->var->zalohovatdni, date("Y")))
          {
            unlink("{$cesta}/{$soubor[$i]}"); //smaze starsi N dni
            $result .= $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_del"], $soubor[$i]);
          }
        }
      }
    }
      else
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_notexists"], $cesta);
    }

    return $result;
  }

/**
 *
 * Smaze dany soubor ve slozce zalohy
 *
 * @return zprava o smazani
 */
  private function SmazatSouborZalohy()
  {
    $cesta = $_GET["file"];

    if (file_exists("{$this->var->zalohadir}/{$cesta}"))
    {
      $result = (unlink("{$this->var->zalohadir}/{$cesta}") ?
                $this->NactiUnikatniObsah($this->unikatni["zaloha_smazano_true"], $cesta) :
                $this->NactiUnikatniObsah($this->unikatni["zaloha_smazano_false"], $cesta));

      $this->var->main[0]->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}");  //auto kliknuti
    }
      else
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["zaloha_dir_notexists"], $cesta);

      $this->var->main[0]->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}");  //auto kliknuti
    }

    return $result;
  }

/**
 *
 * Funkce se pokusí stáhnout danou url stránku
 *
 * pouziti: <strong>$url = $this->var->main[0]->NactiFunkci("Funkce", "NactiUrl", "www.url.cz");</strong>
 *
 * @param url www adresa
 * @return stranka v promenne
 */
  public function NactiUrl($url)
  {
    $url = str_replace("http://", "", $url);
    if (preg_match("#/#","{$url}"))
    {
      $page = $url;
      $url = @explode("/",$url);
      $url = $url[0];
      $page = str_replace($url,"",$page);
      if (!$page || $page == "")
      {
        $page = "/";
      }
      $ip = gethostbyname($url);
    }
      else
    {
      $ip = gethostbyname($url);
      $page = "/";
    }

    if ($open = @fsockopen($ip, 80, $errno, $errstr, 60))
    {
      $send .= "GET {$page} HTTP/1.0\r\n";
      $send .= "Host: {$url}\r\n";
      $send .= "Accept-Language: en-us, en;q=0.50\r\n";
      $send .= "User-Agent: {$_SERVER["HTTP_USER_AGENT"]}\r\n";
      $send .= "Connection: Close\r\n\r\n";

      fputs($open, $send);
      $return = "";
      while (!feof($open))
      {
        $return .= fgets($open, 4096);
      }
      fclose($open);

      $ret = @explode("\r\n\r\n", $return, 2);
      //$header = $ret[0]; //header
      $result = $ret[1]; //body
    }
      else
    {
      $this->ErrorMsg("Chyba připojení k portu 80, cislo: {$errno}, duvod: {$errstr}");
      $result = NULL;
    }
    //$result = file_get_contents($url);

    return $result;
  }

/**
 *
 * Kontrola emailu pres regularni vyraz
 *
 * pouziti: <strong>$email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", "email@email.cz");</strong>
 *
 * @param email text na zkontrolovani
 * @return je-li vyraz v poradku vrati jeho hodnotu
 */
  public function KontrolaEmailu($email)
  {
    $regular = "/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$/";
    preg_match($regular, $email, $ret);
    $result = $ret[0];  //vybere nulty index

    return $result;
  }

/**
 *
 * Kontroluje zda dana url adresa existuje
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "ExistenceUrl", "www.neco.cz") ? "existuje" : "neexistuje")."</strong>
 *
 * @param url www adresa
 * @return true/false - existuje / neexistuje
 */
  public function ExistenceUrl($url)
  {
    $result = false;
    if (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok))
    {
      $a = get_headers($url);
      $b = explode(" ", $a[0]);

      if ($b[1] == 200) //kdyz existuje je 200
      {
        $result = true;
      }
        else
      {
        $result = false;
      }
    }
      else
    {
      $result = true; //docasne!
    }

    return $result;
  }

/**
 *
 * Vraci cas posledni aktualizace a timeout cas
 *
 * @return text aktualizace
 */
  public function CasAktualizace()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["text_cas_aktualizace"],
                                        date("H:i:s", $_SERVER["REQUEST_TIME"]),
                                        $this->var->admin_expire_hod,
                                        $this->var->admin_expire_min,
                                        $this->var->admin_expire_sec);

    return $result;
  }

/**
 *
 * Provadi prihlaseni do adminu
 *
 */
  private function Prihlasovani()
  {
    $logon = $this->NactiUnikatniObsah($this->unikatni["text_autorizace_logon"]);
    $nextdate = mktime(date("H") + $this->var->admin_expire_hod,
                      date("i") + $this->var->admin_expire_min,
                      date("s") + $this->var->admin_expire_sec,
                      date("n"), date("j"), date("Y"));

    if ($_GET[$this->var->get_kam] == "logoff")
    {
      //header("WWW-Authenticate: Basic realm=\"{$logoff}\"");
      //header("HTTP/1.0 401 Unauthorized");

      unset($_SESSION["ADMIN_USER"]);
      unset($_SESSION["ADMIN_PASS"]);
      unset($_SESSION["ADMIN_TIME"]);

      $this->AutoClick(0, "{$this->AbsoluteUrl()}?{$this->var->get_kam}=logoff&act=true");

      if ($_GET["act"] == "true")
      {
        //header("WWW-Authenticate: Basic realm=\"{$logoff}\"");
        //header("HTTP/1.0 401 Unauthorized");

        unset($_SESSION["ADMIN_USER"]);
        unset($_SESSION["ADMIN_PASS"]);
        unset($_SESSION["ADMIN_TIME"]);

        $this->AutoClick(0, $this->AbsoluteUrl());
      }
    }

    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu)
    {
      $_SESSION["ADMIN_USER"] = $_SERVER["PHP_AUTH_USER"];
      $_SESSION["ADMIN_PASS"] = $_SERVER["PHP_AUTH_PW"];

      if (Empty($_SESSION["ADMIN_USER"]) && Empty($_SESSION["ADMIN_PASS"]))
      {
        header("WWW-Authenticate: Basic realm=\"{$logon}\"");
        header("HTTP/1.0 401 Unauthorized");

        if ($this->var->klenot)  //prepnuti pro ziskani dat z klenot
        {
          list($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]) = explode(":", base64_decode(substr($_SERVER["REDIRECT_REMOTE_USER"], 6)));
        }

        echo $this->NactiUnikatniObsah($this->unikatni["text_autorizace_logoff"], $this->AbsoluteUrl());
        exit(0);
      }

      if (!$this->Autorizace($_SESSION["ADMIN_USER"], $_SESSION["ADMIN_PASS"]))
      {
        $this->var->aktivniadmin = false;

        //unset($_SESSION["ADMIN_USER"]);
        //unset($_SESSION["ADMIN_PASS"]);
        //unset($_SESSION["ADMIN_TIME"]);

        //$this->AutoClick(0, $this->AbsoluteUrl());
      }
        else
      {
        if ($this->Autorizace($_SESSION["ADMIN_USER"], $_SESSION["ADMIN_PASS"]))
        {
          $this->var->aktivniadmin = true;

          if ($_SERVER["REQUEST_TIME"] > $_SESSION["ADMIN_TIME"])
          {
            unset($_SESSION["ADMIN_USER"]);
            unset($_SESSION["ADMIN_PASS"]);
            unset($_SESSION["ADMIN_TIME"]);

            $this->AutoClick(0, $this->AbsoluteUrl());
          }

          $_SESSION["ADMIN_TIME"] = $nextdate;
        }
          else
        {
          $this->var->aktivniadmin = false;

          //unset($_SESSION["ADMIN_USER"]);
          //unset($_SESSION["ADMIN_PASS"]);
          //unset($_SESSION["ADMIN_TIME"]);

          //$this->AutoClick(0, $this->AbsoluteUrl());
        }
      }
    }
      else
    {
/*
      if (!Empty($_SESSION["ADMIN_USER"]) && !Empty($_SESSION["ADMIN_PASS"]))
      {
        unset($_SESSION["ADMIN_USER"]);
        unset($_SESSION["ADMIN_PASS"]);
        unset($_SESSION["ADMIN_TIME"]);
        $this->AutoClick(0, $this->AbsoluteUrl());
        return;
      }
*/
    }
  }

/**
 *
 * Overeni hesla do administrace
 *
 * @param login: login admina
 * @param heslo: heslo admina
 * @return povoleno/zamitnuto - true/false
 */
  private function Autorizace($login, $heslo)
  { //+ jeste udelat expiraci!!
    $result = ($this->var->adminpristup[md5(md5($login))] == md5(md5($heslo)) ? true : false);

    return $result;
  }

/**
 *
 * Vraceni odpocitavaneho casu pro vypocet delky provaden skryptu
 *
 * @return cas stopek v ms
 */
  private function MeritCas() //funkce pro vrácení času
  {
    $cas = explode(" ", microtime());
    $soucet = $cas[1] + $cas[0];

    return $soucet;
  }

/**
 *
 * Zacatek odpocitavani
 *
 */
  public function StartCas() //zapis začátku
  {
    $this->start = $this->MeritCas();
  }

/**
 *
 * Konec odpocitavani
 *
 * @return cas v sec.
 */
  public function KonecCas()
  {
    $this->konec = $this->MeritCas();
    $cas = Abs(Round(($this->konec - $this->start) * 10000) / 10000); //Abs, výpočet

    return $cas;
  }

/**
 *
 * Prechod o pocet stranek zpet
 *
 * pouziti: <strong>$odkaz = $this->var->main[0]->NactiFunkci("Funkce", "OdkazZpet", "text1", 1);</strong>
 *
 * @param zpet pocet kroku koli ma udelat zpet
 * @return odkaz v html
 */
  public function OdkazZpet($text = "O úroveň nazpět", $zpet = 1) //vracec historie
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["text_odkaz_zpet"], $zpet, $text);

    return $result;
  }

/**
 *
 * Vypis chyby v html
 *
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("Funkce", "ErrorMsg", "text chyby", "text odkazu zpet"[, true]);</strong>
 *
 * @param chyba text chyby
 * @param zpet_odkaz text odkazu zpet
 * @param primo primy vypis true/false - true (hodi po vypisu exit(1))
 * @return chyby interpretovana v html kodu
 */
  public function ErrorMsg($chyba, $zpet_odkaz = "O úroveň nazpět", $primo = false)  //proecdura chybove hlasky
  {
    $textchyby = $this->NactiUnikatniObsah($this->unikatni["text_chyba"], $chyba, $this->OdkazZpet($zpet_odkaz));

    if ($primo)
    {
      echo $textchyby;
      exit(1);
    }
      else
    {
      $this->var->chyba = $textchyby;
    }
  }

/**
 *
 * Meta refresh
 *
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("Funkce", "AutoClick", 1, "url");</strong>( 1[ms] )
 *
 * @param cas doba aktualizace
 * @param cesta cilova cesta presmerovani
 * @return prislusne nastaveny meta tag
 */
  public function AutoClick($cas, $cesta)  //auto kliknuti, procedura
  {
    $this->var->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
  }

/**
 *
 * Zjisteni a vypsani typu OS
 *
 * pouziti: <strong>$os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $_SERVER["HTTP_USER_AGENT"]);</strong>
 *
 * @param agent agent z $_SERVER["HTTP_USER_AGENT"]
 * @return typ OS
 */
  public function TypOS($agent)
  {
    $OSList = array("Windows 3.11" => "/Win16/i",
                    "Windows 95" => "/(Windows.95)|(Win95)/i",
                    "Windows 98" => "/(Windows.98)|(Win98)/i",
                    "Windows 2000" => "/(Windows NT 5\.0)|(Windows 2000)/i",
                    "Windows XP" => "/(Windows NT 5\.1)|(Windows XP)/i",
                    "Windows XP x64" => "/((Windows NT 5\.2).*(Win64))|((Win64).*(Windows NT 5\.2))/i",
                    "Windows Server 2003" => "/Windows NT 5\.2/i",
                    "Windows Vista" => "/Windows NT 6\.0/i",
                    "Windows 7" => "/Windows NT 7\.0/i",
                    "Windows NT 4.0" => "/(Windows NT 4\.0)|(WinNT4\.0)|(WinNT)|(Windows NT)/i",
                    "Windows ME" => "/(Windows ME)|(Win 9x 4\.90)/i",
                    "Microsoft PocketPC" => "/((Windows CE).*(PPC))|((PPC).*(Windows CE))/i",
                    "Microsoft Smartphone" => "/((Windows CE).*(smartphone))|((smartphone).*(Windows CE))/i",
                    "Windows CE" => "/Windows CE/i",
                    "Mandrake Linux" => "/((Linux).*(Mandrake))|((Mandrake).*(Linux))/i",
                    "Mandriva Linux" => "/((Linux).*(Mandriva))|((Mandriva).*(Linux))/i",
                    "SuSE Linux" => "/((Linux).*(SuSE))|((SuSE).*(Linux))/i",
                    "Novell Linux" => "/((Linux).*(Novell))|((Novell).*(Linux))/i",
                    "Kubuntu Linux" => "/((Linux).*(Kubuntu))|((Kubuntu).*(Linux))/i",
                    "Xubuntu Linux" => "/((Linux).*(Xubuntu))|((Xubuntu).*(Linux))/i",
                    "Edubuntu Linux" => "/((Linux).*(Edubuntu))|((Edubuntu).*(Linux))/i",
                    "Ubuntu Linux" => "/((Linux).*(Ubuntu))|((Ubuntu).*(Linux))/i",
                    "Debian GNU/Linux" => "/((Linux).*(Debian))|((Debian).*(Linux))/i",
                    "RedHat Linux" => "/((Linux).*(Red ?Hat))|((Red ?Hat).*(Linux))/i",
                    "Gentoo Linux" => "/((Linux).*(Gentoo))|((Gentoo).*(Linux))/i",
                    "Fedora Linux" => "/((Linux).*(Fedora))|((Fedora).*(Linux))/i",
                    "MEPIS Linux" => "/((Linux).*(MEPIS))|((MEPIS).*(Linux))/i",
                    "Knoppix Linux" => "/((Linux).*(Knoppix))|((Knoppix).*(Linux))/i",
                    "Slackware Linux" => "/((Linux).*(Slackware))|((Slackware).*(Linux))/i",
                    "Xandros Linux" => "/((Linux).*(Xandros))|((Xandros).*(Linux))/i",
                    "Kanotix Linux" => "/((Linux).*(Kanotix))|((Kanotix).*(Linux))/i",
                    "Linux" => "/(Linux)|(X11)/i",
                    "FreeBSD" => "/Free/i",
                    "OpenBSD" => "/OpenBSD/i",
                    "NetBSD" => "/NetBSD/i",
                    "SGI IRIX" => "/IRIX/i",
                    "Sun OS" => "/SunOS/i",
                    "QNX" => "/QNX/i",
                    "BeOS" => "/BeOS/i",
                    "Mac OS X Leopard" => "/(Mac OS).*(Leopard)/i",
                    "Mac OS X" => "/(Mac OS X)/i",
                    "Mac OS" => "/(Mac_PowerPC)|(Macintosh)/i",
                    "OS/2" => "#OS/2#i",
                    "Qtopia" => "/QtEmbedded/i",
                    "Sharp Zaurus \\1" => "/Zaurus ([a-zA-Z0-9\.]+)/i",
                    "Zaurus" => "/Zaurus/i",
                    "Symbian OS" => "/Symbian/i",
                    "Sony Clie" => "#PalmOS/sony/model#i",
                    "Series \\1" => "/Series ([0-9]+)/i",
                    "Nokia \\1" => "/Nokia ([0-9]+)/i",
                    "Siemens \\1" => "/SIE-([a-zA-Z0-9]+)/i",
                    "Dopod \\1" => "/dopod([a-zA-Z0-9]+)/i",
                    "O2 XDA \\1" => "/o2 xda ([a-zA-Z0-9 ]+);/i",
                    "Samsung \\1" => "/SEC-([a-zA-Z0-9]+)/i",
                    "SonyEricsson \\1" => "/SonyEricsson ?([a-zA-Z0-9]+)/i",
                    "Nintendo Wii" => "/Wii/i",
                    "Bot" => "/(crawler)|(Mediapartners-Google)|(Jyxobot)|(morfeo.centrum.cz)|(Gigabot)|(ASAP-LynxViewer)|(ASAP-Web-Sniffer)|(EARTHCOM.info)|(Mozdex)|(SeznamBot)|(Speedy Spider)|(Yahoo! Slurp)|(ZACATEK_CZ_BOT)|(www.yacy.net)|(Googlebot)|(Openbot)|(MSNBot)|(del.icio.us-thumbnails)|(Exabot)|(findlinks)|(Bot,Robot,Spider)/i",
                    "Neznámý" => "/(.*)/");

    foreach($OSList as $os => $regexp)
    {
      preg_match($regexp, $agent, $matches);
      if (!Empty($matches))
      {
        for ($i = 0; $i <= count($matches); $i++)
        {
          $os = str_replace("\\{$i}", $matches[$i], $os);
        }
        break;
      }
    }

    return trim($os);
  }

/**
 *
 * Zjisteni a vypsani typu Browseru
 *
 * pouziti: <strong>$browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $_SERVER["HTTP_USER_AGENT"]);</strong>
 *
 * @param agent agent z $_SERVER["HTTP_USER_AGENT"]
 * @return typ Browseru
 */
  public function TypBrowseru($agent)
  {
    $BrowserList = array ("Internet Explorer \\1" => "#MSIE ([a-zA-Z0-9\.]+)#i",
                          "Mozilla Firefox \\2" => "#(Firefox|Phoenix|Firebird)/([a-zA-Z0-9\.]+)#i",
                          "Opera \\1" => "#Opera[ /]([a-zA-Z0-9\.]+)#i",
                          "Netscape \\1" => "#Netscape[0-9]?/([a-zA-Z0-9\.]+)#i",
                          "Safari \\1" => "#Safari/([a-zA-Z0-9\.]+)#i",
                          "Flock \\1" => "#Flock/([a-zA-Z0-9\.]+)#i",
                          "Epiphany \\1" => "#Epiphany/([a-zA-Z0-9\.]+)#i",
                          "Konqueror \\1" => "#Konqueror/([a-zA-Z0-9\.]+)#i",
                          "Maxthon \\1" => "#Maxthon ?([a-zA-Z0-9\.]+)?#i",
                          "K-Meleon \\1" => "#K-Meleon/([a-zA-Z0-9\.]+)#i",
                          "Lynx \\1" => "#Lynx/([a-zA-Z0-9\.]+)#i",
                          "Links \\1" => "#Links .{2}([a-zA-Z0-9\.]+)#i",
                          "ELinks \\3" => "#ELinks([/ ]|(.{2}))([a-zA-Z0-9\.]+)#i",
                          "Debian IceWeasel \\1" => "#(iceweasel)/([a-zA-Z0-9\.]+)#i",
                          "Mozilla SeaMonkey \\1" => "#(SeaMonkey)/([a-zA-Z0-9\.]+)#i",
                          "OmniWeb" => "#OmniWeb#i",
                          "Mozilla \\1" => "#^Mozilla/5\.0.*rv:([a-zA-Z0-9\.]+).*#i",
                          "Netscape Navigator \\1" => "#^Mozilla/([a-zA-Z0-9\.]+)#i",
                          "PHP" => "/PHP/i",
                          "SymbianOS \\1" => "#symbianos/([a-zA-Z0-9\.]+)#i",
                          "Avant Browser" => "/avantbrowser\.com/i",
                          "Camino \\1" => "#(Camino|Chimera)[ /]([a-zA-Z0-9\.]+)#i",
                          "Anonymouse" => "/anonymouse/i",
                          "Danger HipTop" => "/danger hiptop/i",
                          "W3M \\1" => "#w3m/([a-zA-Z0-9\.]+)#i",
                          "Shiira \\1" => "#Shiira[ /]([a-zA-Z0-9\.]+)#i",
                          "Dillo \\1" => "#Dillo[ /]([a-zA-Z0-9\.]+)#i",
                          "Openwave UP.Browser \\1" => "#UP.Browser/([a-zA-Z0-9\.]+)#i",
                          "DoCoMo \\1" => "#DoCoMo/(([a-zA-Z0-9\.]+)[/ ]([a-zA-Z0-9\.]+))#i",
                          "Unbranded Firefox \\1" => "#(bonecho)/([a-zA-Z0-9\.]+)#i",
                          "Kazehakase \\1" => "#Kazehakase/([a-zA-Z0-9\.]+)#i",
                          "Minimo \\1" => "#Minimo/([a-zA-Z0-9\.]+)#i",
                          "MultiZilla \\1" => "#MultiZilla/([a-zA-Z0-9\.]+)#i",
                          "Sony PSP \\2" => "/PSP \(PlayStation Portable\)\; ([a-zA-Z0-9\.]+)/i",
                          "Galeon \\1" => "#Galeon/([a-zA-Z0-9\.]+)#i",
                          "iCab \\1" => "#iCab/([a-zA-Z0-9\.]+)#i",
                          "NetPositive \\1" => "#NetPositive/([a-zA-Z0-9\.]+)#i",
                          "NetNewsWire \\1" => "#NetNewsWire/([a-zA-Z0-9\.]+)#i",
                          "Opera Mini \\1" => "#opera mini/([a-zA-Z0-9]+)#i",
                          "WebPro \\2" => "#WebPro(/([a-zA-Z0-9\.]+))?#i",
                          "Netfront \\1" => "#Netfront/([a-zA-Z0-9\.]+)#i",
                          "Xiino \\1" => "#Xiino/([a-zA-Z0-9\.]+)#i",
                          "Blackberry \\1" => "#Blackberry([0-9]+)?#i",
                          "Orange SPV \\1" => "#SPV ([0-9a-zA-Z\.]+)#i",
                          "LG \\1" => "#LGE-([a-zA-Z0-9]+)#i",
                          "Motorola \\1" => "#MOT-([a-zA-Z0-9]+)#i",
                          "Nokia \\1" => "#Nokia ?([0-9]+)#i",
                          "Nokia N-Gage" => "#NokiaN-Gage#i",
                          "Blazer \\1" => "#Blazer[ /]?([a-zA-Z0-9\.]*)#i",
                          "Siemens \\1" => "#SIE-([a-zA-Z0-9]+)#i",
                          "Samsung \\4" => "#((SEC-)|(SAMSUNG-))((S.H-[a-zA-Z0-9]+)|([a-zA-Z0-9]+))#i",
                          "SonyEricsson \\1" => "#SonyEricsson ?([a-zA-Z0-9]+)#i",
                          "J2ME/MIDP Browser" => "#(j2me|midp)#i",
                          "Neznámý" => "/(.*)/");

    foreach($BrowserList as $browser => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if (!Empty($matches))
        {
          for ($i = 0; $i <= count($matches); $i++)
          {
            $browser = str_replace("\\{$i}", $matches[$i], $browser);
          }
        }
        break;
      }
    }

    return trim($browser);
  }

/**
 *
 * Detekce linuxu
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu") ? "je to linux" : "je to mrkvosoft")."</strong>
 *
 * @return jsou to linuxy / nejsou to linuxy - true(linux) / false(MS)
 */
  public function DetekceLinuxu()
  {
    $OSList = array("Mandrake Linux" => "/((Linux).*(Mandrake))|((Mandrake).*(Linux))/i",
                    "Mandriva Linux" => "/((Linux).*(Mandriva))|((Mandriva).*(Linux))/i",
                    "SuSE Linux" => "/((Linux).*(SuSE))|((SuSE).*(Linux))/i",
                    "Novell Linux" => "/((Linux).*(Novell))|((Novell).*(Linux))/i",
                    "Kubuntu Linux" => "/((Linux).*(Kubuntu))|((Kubuntu).*(Linux))/i",
                    "Xubuntu Linux" => "/((Linux).*(Xubuntu))|((Xubuntu).*(Linux))/i",
                    "Edubuntu Linux" => "/((Linux).*(Edubuntu))|((Edubuntu).*(Linux))/i",
                    "Ubuntu Linux" => "/((Linux).*(Ubuntu))|((Ubuntu).*(Linux))/i",
                    "Debian GNU/Linux" => "/((Linux).*(Debian))|((Debian).*(Linux))/i",
                    "RedHat Linux" => "/((Linux).*(Red ?Hat))|((Red ?Hat).*(Linux))/i",
                    "Gentoo Linux" => "/((Linux).*(Gentoo))|((Gentoo).*(Linux))/i",
                    "Fedora Linux" => "/((Linux).*(Fedora))|((Fedora).*(Linux))/i",
                    "MEPIS Linux" => "/((Linux).*(MEPIS))|((MEPIS).*(Linux))/i",
                    "Knoppix Linux" => "/((Linux).*(Knoppix))|((Knoppix).*(Linux))/i",
                    "Slackware Linux" => "/((Linux).*(Slackware))|((Slackware).*(Linux))/i",
                    "Xandros Linux" => "/((Linux).*(Xandros))|((Xandros).*(Linux))/i",
                    "Kanotix Linux" => "/((Linux).*(Kanotix))|((Kanotix).*(Linux))/i",
                    "Linux" => "/(Linux)|(X11)/i",
                    "FreeBSD" => "/Free/i",
                    "OpenBSD" => "/OpenBSD/i",
                    "NetBSD" => "/NetBSD/i",
                    "SGI IRIX" => "/IRIX/i",
                    "Sun OS" => "/SunOS/i",
                    "QNX" => "/QNX/i",
                    "BeOS" => "/BeOS/i",
                    "Mac OS X Leopard" => "/(Mac OS).*(Leopard)/i",
                    "Mac OS X" => "/(Mac OS X)/i",
                    "Mac OS" => "/(Mac_PowerPC)|(Macintosh)/i",
                    "OS/2" => "#OS/2#i",
                    "Qtopia" => "/QtEmbedded/i",
                    "" => "/(.*)/");

    $agent = $_SERVER["HTTP_USER_AGENT"];
    foreach($OSList as $os => $regexp)
    {
      preg_match($regexp, $agent, $matches);
      if (!Empty($matches))
      {
        for ($i = 0; $i <= count($matches); $i++)
        {
          $os = str_replace("\\{$i}", $matches[$i], $os);
        }
        break;
      }
    }

    return (!Empty($os) ? true : false);
  }

/**
 *
 * Detekce opery
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "DetekceOpery") ? "je to opera" : "je to coloki jineho")."</strong>
 *
 * @return je to opera / neni to opera - true(opera) / false(jiny)
 */
  public function DetekceOpery()
  {
    $OSList = array("Opera \\1" => "#Opera[ /]([a-zA-Z0-9\.]+)#i",
                    "" => "/(.*)/");

    $agent = $_SERVER["HTTP_USER_AGENT"];
    foreach($OSList as $os => $regexp)
    {
      preg_match($regexp, $agent, $matches);
      if (!Empty($matches))
      {
        for ($i = 0; $i <= count($matches); $i++)
        {
          $os = str_replace("\\{$i}", $matches[$i], $os);
        }
        break;
      }
    }

    return (!Empty($os) ? true : false);
  }

/**
 *
 * Stara se instalaci databaze
 *
 */
  private function Instalace()  //instalace databaze
  {
    //
  }

/**
 *
 * Prepocet velikosti
 *
 * pouziti: <strong>$velikost = $this->var->main[0]->NactiFunkci("Funkce", "Velikost", filesize($soubor));</strong>
 *
 * @param size zmerena velikost
 * @return prepocitana velikost
 */
  public function Velikost($size)  //vypocet velikosti souboru
  {
    $symbol = array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

    $exp = 0;
    $converted_value = 0;
    if ($size > 0)
    {
      $exp = floor(log($size) / log(1024));
      $converted_value = ($size / pow(1024, floor($exp)));
    }

    $result = sprintf("%.2f {$symbol[$exp]}", $converted_value);

    return $result;
  }

/**
 *
 * Prepisuje obycejnou adresu pro htaccess format - testovaci provoz
 *
 * @param adresa vstupni adresa
 * @return url pripravena pro hraccess
 */
  public function PrepisAdresy($adresa)
  {
    $search = array_keys($this->var->prepis_pravidla);
    $replace = array_values($this->var->prepis_pravidla);

    $result = str_replace($search, $replace, $adresa);

    return $result;
  }

/**
 *
 * Prepisuje zpet textovou adresu do neupravene - testovaci provoz
 *
 * @param adresa vstupni adresa
 * @return url adresa shodna s nazevem
 */
  public function ZpetnyPrepisAdresy($adresa)
  {
    $search = array_values($this->var->prepis_pravidla);
    $replace = array_keys($this->var->prepis_pravidla);

    $result = str_replace($search, $replace, $adresa);

    return $result;
  }
}
?>
