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

    $poc = 0;
    while (!file_exists($cesta))
    {
      $cesta = "../{$cesta}";
      $poc++;

      if ($poc > 10)  //kontrola zacykleni
      {
        break;
      }
    }

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
 * ini_set("memory_limit", "100M");  //nasosne si 100MB\n
 * header('Content-type: text/html; charset=UTF-8');\n
 * onclick="return AddFavorite(this,document.location.href,document.title);"+skrypt\n
 * , array(__LINE__, __METHOD__)\n
  <label>
    <span>text:</span>
    <input>
  </label>
 */
class Funkce extends DefaultModule
{
  private $start, $konec, $var, $logoff, $unikatni,
          $absolutni_url, $cookie_url;
  private $zaplaceno = false;
  private $idmodul = "funkce";
  private $idzaloha = "zaloha";
  private $iddelzal = "delzal";
  private $iderror = "error";
  private $idupp = "up";

  private $errorpage = "error_page";
  private $errorblok = ".vygenerovano";

  private $get_check = "check";
  private $get_download = "down";
  private $get_zdrojstazeni = "source";
  private $get_showsource = "soucefile";

  private $errorlogdir = "errorlog";  //slozka error logu
  private $blokvyjimka = array("dynobsah");
  private $dedicne = "duplikatni";

  public $mount = array("ajax_funkce.php",
                        "default_modul.php",
                        "promenne.php",
                        "script/jquery/jquery-132-yui.js",
                        "script/jquery/jquery.ui-1.7.min.js",
                        "script/jquery/jquery-ui-1.7.1.custom.min.js",
                        "script/jquery/jquery.tooltip.admin.js",
                        "script/jquery/toolstooltip-102-yui.js",
                        "script/jquery/log_ad.js");

/**
 *
 * Konstruktor funkce
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 *
 */
  public function __construct(&$var, $index = 0, $unikatni = false) //konstruktor
  {
    $this->var = $var;

    //inicializace presunuty do funkce: InicializaceModulu()
    //static $pocc = 0;

    //includovani unikatniho obsahu
    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu ||
        $unikatni) //includovani jen kdyz je v adminu, nebo je potreba jindy
    {
      $this->unikatni = $this->NactiObsahSouboru(".unikatni_funkce.php");
      //var_dump($this->NactiObsahSouboru(".unikatni_funkce.php", false));
      //$this->unikatni = include ".unikatni_funkce.php";
      //$this->NactiObsahSouboru(".unikatni_funkce.php", false);
      //include ".unikatni_funkce.php";
      //var_dump($pocc);
      //$pocc++;
    }
  }

/**
 *
 * Startuje session
 *
 */
  private function StartSession() //aktvuje session promenne
  {
    //session_name("SSID"); //nastaveni jmena session
    session_register("ADMIN:{$this->absolutni_url}");

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
        $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_nacteni_tridy"], $index), array(__LINE__, __METHOD__));
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
          $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_nacteni_tridy_funkce"], $this->var->moduly[$index]["class"], $funkce), array(__LINE__, __METHOD__));
        }
          else
        {
          $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_nacteni_tridy_class"], $index), array(__LINE__, __METHOD__));
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
 * Najde index podle zadane tridy
 *
 * @param cesta cesta modulu
 * @return cislo indexu
 */
  public function NajdiIndexPodleCesty($cesta)
  {
    $result = -1;
    for ($i = 0; $i < count($this->var->moduly); $i++)
    {
      if (dirname($this->var->moduly[$i]["include"]) == $cesta)
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
 * @param &info pres parametr vracena informace
 */
  public function InicializaceModulu(&$info)
  {
    $this->absolutni_url = $this->AbsoluteUrl();
    //konvert kvuli windows
    $this->cookie_url = str_replace(".", "x", $this->absolutni_url);

    $this->StartSession();

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
            $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_main_init_construct_class"], $this->var->moduly[$i]["class"]), array(__LINE__, __METHOD__));
          }
        }
          else
        {
          $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_main_init_exist_class"], $this->var->moduly[$i]["class"]), array(__LINE__, __METHOD__));
        }
      }
        else
      {
        $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_main_init_not_exist"], $this->var->moduly[$i]["class"]), array(__LINE__, __METHOD__));
      }
    }

    //includovani unikatniho obsahu
    //$this->unikatni = $this->NactiObsahSouboru(".unikatni_funkce.php", false);
    if ($_GET[$this->var->get_kam] != $this->var->adresaadminu) //includovani jen kdyz je mimo admin
    {
      $this->unikatni = $this->NactiObsahSouboru(".unikatni_funkce.php", false);
    }

    $verze = $this->KontrolaVerze();
    if ($verze < 5) //kontrola verze, kvuli php5
    {
      $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_old_php_version"], $verze), array(__LINE__, __METHOD__), "crit");
      exit(1);
    }

    $this->zaplaceno = $this->NactiUnikatniObsah($this->unikatni["set_zaplaceno"]);

    $result = $this->BlokaceStranky($info);

    settype($_COOKIE["ADMIN:{$this->cookie_url}DEBUG"], "boolean");
    $this->var->debug_mod = $_COOKIE["ADMIN:{$this->cookie_url}DEBUG"];

    //$this->Instalace();

    $this->Prihlasovani();

    $this->AutoZalohovani();
    $this->GenerovaniErrorPage();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul,
                                                        "{$this->idmodul}{$this->idzaloha}",
                                                        "{$this->idmodul}{$this->iddelzal}",
                                                        "{$this->idmodul}{$this->idupp}",
                                                        "{$this->idmodul}{$this->iderror}"));

    return $result;
  }

/**
 *
 * Zjisti jestli byli stranky zaplaceny
 *
 * @param &info pres parametr vracena hlaska o hrubem stavu blokace
 * @return true/false - blokace/normal
 */
  private function BlokaceStranky(&$info)
  {
    $result = false;

    $datum = $this->NactiUnikatniObsah($this->unikatni["datum_blokace_begin"]);
    $tvar_data = $this->NactiUnikatniObsah($this->unikatni["tvar_datum_blokace"]);

    if (!$this->zaplaceno)
    {
      if (date("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime($datum)))
      {
        $result = true; //po datu blokace blokuje

        $info = $this->NactiUnikatniObsah($this->unikatni["blokace_stranky_true"],
                                          date($tvar_data, strtotime($datum)));
      }
        else
      {
        $result = false;  //do data blokace necha bezet stranky

        $info = $this->NactiUnikatniObsah($this->unikatni["blokace_stranky_false"],
                                          date($tvar_data, strtotime($datum)));
      }
    }
      else
    {
      $result = false;  //pri vypnute blokaci

      $info = "";
    }

    return $result;
  }

/**
 *
 * Podava informace o blokaci
 *
 * pouziti: <strong>$info = $this->var->main[0]->NactiFunkci("Funkce", "BlokaceInfo", $blok);</strong>
 *
 * @param blok true/false - blokovano/neblokovano
 * @return informacni text
 */
  public function BlokaceInfo($blok)
  {
    $result = "";

    $datum = $this->NactiUnikatniObsah($this->unikatni["datum_blokace_begin"]);

    if (!$this->zaplaceno)  //kdyz je web nezaplaceny
    {
      if ($blok)
      {
        $dni = $this->PocetDni($datum, "now");  //do data to ted

        $penale = $this->NactiUnikatniObsah($this->unikatni["blokace_penale"]);  //za jednotku
        $typ_jednotka = $this->NactiUnikatniObsah($this->unikatni["blokace_typ_jednotka"]);  //typ jednotky
        $pocet_jednotka = $this->NactiUnikatniObsah($this->unikatni["blokace_pocet_jednotka"]);  //typ jednotky

        $soubor = ".valuedelay";
        if (file_exists($soubor))
        {
          $u = fopen($soubor, "r");
          $rozdel = explode("::", $this->DekodujText(fread($u, (filesize($soubor) == 0 ? 1 : filesize($soubor)))));
          fclose($u);
        }
          else
        {
          $u = fopen($soubor, "w");
          fwrite($u, $this->ZakodujText($this->NactiUnikatniObsah($this->unikatni["blokace_msg"], date("Y-m-d H:i:s"))));
          fclose($u);
        }

        switch ($typ_jednotka)
        {
          case "hodina":  //kazdych X hodin
            $nasobek = ($dni * 24) / $pocet_jednotka;  //kazdy den ma 24 hodin
            $castka = round($nasobek * $penale);

            if (date("Y-m-d H:i:s") >= date("Y-m-d H:i:s", strtotime("+{$pocet_jednotka} hour", strtotime($rozdel[1]))))
            {
              $u = fopen($soubor, "w");
              fwrite($u, $this->ZakodujText($this->NactiUnikatniObsah($this->unikatni["blokace_msg"], date("Y-m-d H:i:s"))));
              fclose($u);
            }
          break;

          default:
          case "den": //kazdych X dni
            $nasobek = $dni / $pocet_jednotka;
            $castka = round($nasobek * $penale);

            if (date("Y-m-d") >= date("Y-m-d", strtotime("+{$pocet_jednotka} day", strtotime($rozdel[1]))))
            {
              $u = fopen($soubor, "w");
              fwrite($u, $this->ZakodujText($this->NactiUnikatniObsah($this->unikatni["blokace_msg"], date("Y-m-d H:i:s"))));
              fclose($u);
            }
          break;

          case "mesic": //kazdych X mesicu
            $nasobek = ($dni / 30) / $pocet_jednotka; //delka mesice prumerne 30 dni
            $castka = round($nasobek * $penale);

            if (date("Y-m-d") >= date("Y-m-d", strtotime("+{$pocet_jednotka} month", strtotime($rozdel[1]))))
            {
              $u = fopen($soubor, "w");
              fwrite($u, $this->ZakodujText($this->NactiUnikatniObsah($this->unikatni["blokace_msg"], date("Y-m-d H:i:s"))));
              fclose($u);
            }
          break;
        }

        $result = $this->NactiUnikatniObsah($this->unikatni["blokace_info_true"],
                                            $dni,
                                            $this->VysloveniDne($dni),
                                            $castka);
      }
        else
      {
        $dni = $this->PocetDni("now", $datum);  //od ted do data

        $result = $this->NactiUnikatniObsah($this->unikatni["blokace_info_false"],
                                            $dni,
                                            $this->VysloveniDne($dni));
      }
    }

    return $result;
  }

/**
 *
 * Spocita kolik casu ubehlo od poc_datum do kon_datum
 *
 * pouziti: <strong>$dni = $this->var->main[0]->NactiFunkci("Fukce", "PocetDni", "now", "01.10.2009");</strong>
 *
 * @param poc_datum pocatecni datum, vstup do strtotime
 * @param kon_datum koncove datum, vstup do strtotime
 * @return pocet dni
 */
  public function PocetDni($poc_datum, $kon_datum)
  {
    $result = 0;
    $poc = strtotime($poc_datum);
    $kon = strtotime($kon_datum);

    if (date("Y-m-d", $poc) < date("Y-m-d", $kon))
    {
      $i = 0;
      while (date("Y-m-d", strtotime("+{$i} day", $poc)) != date("Y-m-d", $kon))
      {
        $i++;
      }

      $result = $i;
    }
      else
    {
      $i = 0;
      while (date("Y-m-d", strtotime("-{$i} day", $poc)) != date("Y-m-d", $kon))
      {
        $i++;
      }

      $result = $i;
    }

    return $result;
  }

/**
 *
 * Vysloveni spravneho tvaru dne
 *
 * pouziti: <strong>$slovoden = $this->var->main[0]->NactiFunkci("Fukce", "VysloveniDne", 4);</strong>
 *
 * @param dne cislo dne
 * @return tvar slova dne
 */
  public function VysloveniDne($den)
  {
    $poledny = $this->NactiUnikatniObsah($this->unikatni["vysloveni_dne"]);

    switch ($den)
    {
      case 0: //dnu
        $result = $poledny[0];
      break;

      case 1: //den
        $result = $poledny[1];
      break;

      case 2: //dny
      case 3:
      case 4:
        $result = $poledny[2];
      break;

      default:  //dni
        $result = $poledny[3];
      break;
    }

    return $result;
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
    $result = "";

    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu)
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
    $absolutni_url = $this->AbsoluteUrl();
    $cookie_url = str_replace(".", "x", $absolutni_url);
    settype($_COOKIE["ADMIN:{$cookie_url}DEBUG"], "boolean");

    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu)
    {
      static $pocit = 0;  //pocitadlo volani funkce

      //cyklicka funkce!
      $this->unikatni = $this->NactiObsahSouboru(".unikatni_funkce.php", false);
      //nacte pro jedno volani menu
      $prvni = $this->NactiUnikatniObsah($this->unikatni["admin_menu_prvni"]);
      $posledni = $this->NactiUnikatniObsah($this->unikatni["admin_menu_posledni"]);
      $ente_def_array = $this->NactiUnikatniObsah($this->unikatni["admin_menu_ente_def_array"]);
      $ente_def = $this->NactiUnikatniObsah($this->unikatni["admin_menu_ente_def"]);
      $ente_od = $this->NactiUnikatniObsah($this->unikatni["admin_menu_ente_od"]);
      $ente_po = $this->NactiUnikatniObsah($this->unikatni["admin_menu_ente_po"]);
      $ente = $this->NactiUnikatniObsah($this->unikatni["admin_menu_ente"]);

      for ($i = 0; $i < count($admin_menu); $i++)  //prochazeni adres
      {
        $pocit++; //pocita volani
        $podminka = ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
                    $_GET[$this->var->get_idmodul] == $admin_menu[$i]["main_href"]);

        //blokovani stranky z adresy
        if (!$admin_menu[$i]["zobrazit"] && //skryty
            //!$this->var->debug_mod && //global debug
            !$_COOKIE["ADMIN:{$cookie_url}DEBUG"] &&  //user debug
            $_GET[$this->var->get_idmodul] == $admin_menu[$i]["main_href"] &&
            !in_array($_GET[$this->var->get_idmodul], $this->blokvyjimka))
        {
          exit(0);
        }

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

        $main_href = (!Empty($admin_menu[$i]["main_href"]) ? "&amp;{$this->var->get_idmodul}={$admin_menu[$i]["main_href"]}" : "");
        $class = (!Empty($admin_menu[$i]["class"]) || !Empty($ozn_class) ? " class=\"{$admin_menu[$i]["class"]}{$ozn_class}\"" : "");
        $id = (!Empty($admin_menu[$i]["id"]) || !Empty($ozn_id) ? " id=\"{$admin_menu[$i]["id"]}{$ozn_id}\"" : "");
        $akce = (!Empty($admin_menu[$i]["akce"]) ? " {$admin_menu[$i]["akce"]}" : "");

        //externi odvolani do souborum
        $result .= ($admin_menu[$i]["zobrazit"] ? $this->NactiUnikatniObsah($this->unikatni["tvar_admin_menu"], // + menu_tvar_logoff
                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}{$main_href}",
                                                                            $admin_menu[$i]["odkaz"],
                                                                            $id,
                                                                            $class,
                                                                            $akce,
                                                                            $ozn_odkaz_l,
                                                                            $ozn_odkaz_r,
                                                                            (($pocit - 1) == 0 ? $prvni : ""),
                                                                            ($pocit == (count($this->var->moduly) + count($admin_menu)) ? $posledni : ""),
                                                                            (in_array(($pocit - 1), $ente_def_array) ? $ente_def : ""),
                                                                            (((($pocit - 1) + $ente_od) % $ente_po) == 0 ? $ente : ""))
                                                : ($_COOKIE["ADMIN:{$cookie_url}DEBUG"] ? $this->NactiUnikatniObsah($this->unikatni["tvar_admin_menu_skryte"],
                                                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}{$main_href}",
                                                                                                                            $admin_menu[$i]["odkaz"],
                                                                                                                            $id,
                                                                                                                            $class,
                                                                                                                            $akce,
                                                                                                                            $ozn_odkaz_l,
                                                                                                                            $ozn_odkaz_r) : ""));
      }
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
    $result = "";
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

        case "{$this->idmodul}{$this->iderror}":  //prohlzeni error logu
          $result = $this->VypisErrorLogu();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Nahrazuje prepnani podle sekci pro amdinu
 *
 * @param sekce doplnujici sekce pro vice
 * @return text pro danou sekci
 */
  public function AdminPrepinaniPodleSekci($sekce = NULL)
  {
    $prep = $this->NactiUnikatniObsah($this->unikatni["admin_prepinani_sekce"]);

    $result = (Empty($prep["{$_GET[$this->var->get_idmodul]}{$sekce}"]) ?
                    $prep["default{$sekce}"] :
                    $prep["{$_GET[$this->var->get_idmodul]}{$sekce}"]);

    return $result;
  }

/**
 *
 * Nacitani CSS stylu pro samotne moduly
 *
 * @return seznam stylu co se ma nacitat
 */
  public function AdminNacitaniCssModulu()
  {
    $moduly = $this->var->moduly;
    $result = "";
    $absolutni_url = $this->AbsoluteUrl();
    for ($i = 0; $i < count($moduly); $i++)
    {
      $nazev = basename($moduly[$i]["include"], ".php"); //extrahuje nazev bez .php
      $path = dirname($moduly[$i]["include"]);
      $cssfile = "{$path}/{$nazev}.css";

      $rozdeleni = explode("__", $_GET[$this->var->get_idmodul]); //i pro sub vnorene sekce
      $idmodul = (count($rozdeleni) > 1 ? $rozdeleni[0] : $_GET[$this->var->get_idmodul]);  //>1 - jeden sam je vzdy

      $dedicnecss = "{$path}/{$this->dedicne}_{$nazev}.css";

      if (file_exists($cssfile) &&
          $idmodul == $this->var->main[$i]->idmodul)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_nacitani_css"],
                                            $this->absolutni_url,
                                            $cssfile);

        if (file_exists($dedicnecss)) //nacte css s vetsi specifikaci
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_nacitani_css"],
                                              $this->absolutni_url,
                                              $dedicnecss);
        }
      }
    }

    //nacitani debug stylu
    $plusfile = "styles/styles_debug.css";
    if ($this->var->debug_mod &&
        file_exists($plusfile))
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_nacitani_css"],
                                          $this->absolutni_url,
                                          $plusfile);
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
        $dodatek = ($moduly[$i]["uloziste"] == "mysqli" ? ".mysqli" : "");
        $sum += @filesize("{$path}/{$moduly[$i]["databaze"]}{$dodatek}");  //secte velikost databaze
        $dbpoc++;
      }
    }

    $poc = count($moduly) + 2; //+ promenne + default module, dedi se/dedi se

    $errorradku = 0;
    if (!file_exists($this->errorlogdir))
    {
      mkdir($this->errorlogdir, 0777);
    }
      else
    {
      $cesta = $this->errorlogdir;
      $handle = opendir($cesta);
      $i = 0;
      while($soub = readdir($handle))
      {
        if ($soub != "." && $soub != ".." && is_file("{$cesta}/{$soub}"))
        { //mazan po zadane dobe
          if (filemtime("{$cesta}/{$soub}") <= mktime(0, 0, 0, date("n"), date("j") - $this->var->zalohovatdni, date("Y")))
          {
            unlink("{$cesta}/{$soub}"); //smaze starsi N dni
          }
        }
      }
      closedir($handle);

      $filedatum = date("d-m-Y");

      $filename = "errorlog-{$filedatum}.txt";
      $soubor = "{$this->errorlogdir}/errorlog-{$filedatum}.txt";
      if (file_exists($soubor))
      {
        $u = fopen($soubor, "r");
        $errorradku = count(explode("--end--", fread($u, (filesize($soubor) == 0 ? 1 : filesize($soubor))))) - 1;
        fclose($u);
      }
        else
      {
        $u = fopen($soubor, "w"); //osetreni proti nulove chybe
        fclose($u);
        $errorradku = 0;
      }
    }

    //live prenastaveni debugu
    if (!Empty($_POST["tlacitko_debug"]))
    {
      SetCookie("ADMIN:{$this->cookie_url}DEBUG", (!Empty($_POST["livedebug"])), Time() + 31536000); //zapis do cookie

      $this->AutoClick(0, "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}");
    }
    settype($_COOKIE["ADMIN:{$this->cookie_url}DEBUG"], "boolean");

    $result = $this->NactiUnikatniObsah($this->unikatni["info_admin_uvod_text"],
                                        $poc,
                                        $dbpoc,
                                        "'modules', true",
                                        $sum,
                                        "'{$this->var->zalohadir}', false",
                                        "'./', true",
                                        "'styles', true",
                                        "'script', true",
                                        "'obr', true",
                                        "'{$this->var->souborymenu}', true",
                                        ($_COOKIE["ADMIN:{$this->cookie_url}DEBUG"] ? $this->NactiUnikatniObsah($this->unikatni["info_admin_uvod_text_href"],
                                                                                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iderror}&amp;co={$filename}",
                                                                                                                $errorradku) : $errorradku),
                                        ($this->var->adminuser["debug"] ? $this->NactiUnikatniObsah($this->unikatni["info_admin_uvod_text_debug"],
                                                                                                    " name=\"livedebug\"",
                                                                                                    ($_COOKIE["ADMIN:{$this->cookie_url}DEBUG"] ? " checked=\"checked\"" : ""),
                                                                                                    " name=\"tlacitko_debug\"") : ""),
                                        $this->absolutni_url,
                                        "script/jquery");

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
  public function VelikostAdresare($cesta, $rekurzivne = false)
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
      $result = $this->NactiUnikatniObsah($this->unikatni["aktualizace_datum"], date($this->NactiUnikatniObsah($this->unikatni["admin_tvar_datum"])));

      $href = "";
      $odkaz = "";
      $moduly = $this->var->moduly; //kopie
      for ($i = 0; $i < count($moduly); $i++)
      {
        $nazev = $moduly[$i]["class"];  //prvni nacteni
        $cesta = $moduly[$i]["include"];

        $diffvar["class"][] = $nazev; //na druhou kontrolu
        $diffvar["include"][] = $cesta;

        $href[] = "{$nazev}:{$cesta}";

        //overeni existence promenne a pak i jeji prazdnoty
        if (property_exists($nazev, "mount") &&
            !Empty($this->var->main[$i]->mount[0]))
        {
          for ($j = 0; $j < count($this->var->main[$i]->mount); $j++)
          {
            $path = dirname($cesta);  //nacteni path cesty
            $href[] = "{$nazev}:{$path}/{$this->var->main[$i]->mount[$j]}";

            $delka = $this->NactiUnikatniObsah($this->unikatni["aktualizace_delka"]);
            $dodatek = (strlen(basename($this->var->main[$i]->mount[$j])) > $delka ? $this->NactiUnikatniObsah($this->unikatni["aktualizace_dodatek"]) : "");
            $presne = substr(basename($this->var->main[$i]->mount[$j]), 0, $delka);

            $diffvar["class"][] = $this->NactiUnikatniObsah($this->unikatni["aktualizace_mount"],
                                                            $nazev,
                                                            "{$presne}{$dodatek}");
            $diffvar["include"][] = "{$path}/{$this->var->main[$i]->mount[$j]}";
          }
        }
      }

      $odkaz = implode("&{$this->get_check}[]=", $href);
      $user = $_SESSION["ADMIN:{$this->absolutni_url}"]["USER"];
      $pass = $_SESSION["ADMIN:{$this->absolutni_url}"]["PASS"];
      $odkaz .= "&user={$user}&pass={$pass}&web={$this->absolutni_url}";

      $ret = $this->NactiUrl("{$this->var->depozitar}?{$this->get_check}[]={$odkaz}");

      $rozdel = explode("++", $ret);  //rozdeleni zpravy
      for ($i = 0; $i < count($rozdel); $i++) //projiti zpravy
      {
        $nazev = $diffvar["class"][$i]; //$moduly[$i]["class"];
        $cesta = $diffvar["include"][$i]; //$moduly[$i]["include"];

        $soubor = basename($cesta); //soubor
        $adresar = dirname($cesta); //adresar
        $adresar = explode("/", $adresar);
        $adresar = (count($adresar) > 1 ? $adresar[1] : $this->NactiUnikatniObsah($this->unikatni["aktualizace_root"]));

        $info0 = "";
        if (file_exists($cesta))
        {
          $velikost = filesize($cesta);  //$this->Velikost()
          $datum = filemtime($cesta); //datum na aktualnim webu, date("d.m.Y H:i:s", )
        }
          else
        {
          $info0 = $this->NactiUnikatniObsah($this->unikatni["aktualizace_notexists"]);
        }

        $dat = explode("-_-", $rozdel[$i]); //rozdeleni data a velikosti

        $zprava_datum = $dat[0];  //vraceni datumu zpravy
        $zprava_velikost = $dat[1]; //vraceni velikosti

        $info = "";
        if (is_numeric($zprava_datum))
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

        $fun_dat = "-- / --";
        settype($datum, "integer"); //konvert na cislo
        if (!Empty($datum))
        {
          $fun_dat = date($this->NactiUnikatniObsah($this->unikatni["admin_tvar_datum"]), $datum);
        }

        $dep_dat = "-- / --";
        settype($zprava_datum, "integer"); //konvert na cislo
        if (!Empty($zprava_datum))
        {

          $dep_dat = date($this->NactiUnikatniObsah($this->unikatni["admin_tvar_datum"]), $zprava_datum);
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["aktualizace_admin_vypis"],
                                            $nazev,
                                            $adresar,
                                            $soubor,
                                            $fun_dat,
                                            $this->Velikost($velikost),
                                            $dep_dat,
                                            (!Empty($zprava_velikost) ? $this->Velikost($zprava_velikost) : ""),
                                            (!Empty($info0) ? $info0 : $info));
      }
    }
      else
    {
      $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_update"]), array(__LINE__, __METHOD__));
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
          $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_update_upload_error"], $_FILES["modul"]["error"]), array(__LINE__, __METHOD__));
        }
      }
        else
      {
        if (!Empty($_FILES["modul"]["tmp_name"]))
        {
          if ($koncovka[count($koncovka) - 1] == "php")
          {
            $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_update_suffix"]), array(__LINE__, __METHOD__));
          }

          if (file_exists($soubor))
          {
            $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_update_file_not_exist"]), array(__LINE__, __METHOD__));
          }

          if ($soubor != "promenne.php" &&
              $soubor != ".htaccess")
          {
            $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_update_hack"]), array(__LINE__, __METHOD__));
          }

          if ($_FILES["modul"]["name"] == basename($soubor))
          {
            $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_update_another_file"]), array(__LINE__, __METHOD__));
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_update_empty_file"]), array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vypisuje error logy
 *
 * @return vypis logu
 */
  private function VypisErrorLogu()
  {
    $cesta = $this->errorlogdir;
    $result = "";
    if (file_exists($cesta))
    {
      $handle = opendir($cesta);
      $i = 0;
      while($soub = readdir($handle))
      {
        if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
        {
          $soubor[$i] = $soub;
          $datumy[$i] = filemtime("{$cesta}/{$soub}");  //pro serazeni
          $i++;
        }
      }
      closedir($handle);

      asort($datumy); //seradi
      $klic = array_keys($datumy);  //vezme klice pro vypis podle serazenych

      $odkazy = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_error_log_begin"],
                                          $this->absolutni_url,
                                          "script/jquery");
      $pocet = 0;
      $vyber = $_GET["co"];
      for ($i = 0; $i < count($klic); $i++)
      {
        $log = "{$cesta}/{$soubor[$klic[$i]]}";
        $u = fopen($log, "r");
        $pocet = count(explode("--end--", fread($u, (filesize($log) == 0 ? 1 : filesize($log))))) - 1;
        fclose($u);

        $odkazy .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_error_log_odkaz"],
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iderror}&amp;co={$soubor[$klic[$i]]}",
                                            $soubor[$klic[$i]],
                                            $pocet,
                                            date($this->NactiUnikatniObsah($this->unikatni["admin_tvar_datum"]), $datumy[$klic[$i]]),
                                            ($vyber == $soubor[$klic[$i]] ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_error_log_aktivni"]) : ""));
      }

      if (!Empty($vyber)) //vyber vypisu
      {
        $log = "{$cesta}/{$vyber}";
        $u = fopen($log, "r");
        $obsah = explode("--end--", fread($u, (filesize($log) == 0 ? 1 : filesize($log))));
        fclose($u);

        if (count($obsah) > 1)
        {
          for ($i = 0; $i < count($obsah) - 1; $i++)
          {
            $ret = explode("|-x-|", $obsah[$i]);
            $ret[4] = $this->var->error_code[$ret[4]];  //typ chyby
            $ret = array_splice($ret, 0, -1); //odstraneni posledniho indexu
            $ret[] = $i; //(!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? gethostbyaddr($ret[6]) : $ret[6]);
            $ret[] = date($this->NactiUnikatniObsah($this->unikatni["admin_tvar_datum"]), strtotime($ret[5]));
            $ret[] = $this->TypBrowseru($ret[7]);
            $ret[] = $this->TypOS($ret[7]);

            $vypis .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_error_log_radek"],
                                                $ret);
          }
        }
          else
        {
          $vypis = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_error_log_radek_null"]);
        }
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_error_log"],
                                          $odkazy,
                                          $vypis);
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
      if ($this->var->moduly[$i]["admin"])
      {
        if (method_exists($this->var->moduly[$i]["class"], "AdminTitle"))
        {
          $result .= $this->var->main[$i]->AdminTitle();
        }
          else
        {
          $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_gen_title"], $this->var->moduly[$i]["class"]), array(__LINE__, __METHOD__));
        }
      }
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
      if ($this->var->moduly[$i]["admin"] && $this->var->moduly[$i]["zobrazit"])
      {
        if (method_exists($this->var->moduly[$i]["class"], "AdminMenu"))
        {
          $result .= $this->var->main[$i]->AdminMenu();
        }
          else
        {
          $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_gen_menu"], $this->var->moduly[$i]["class"]), array(__LINE__, __METHOD__));
        }
      }
    }

    //nacteni zbytku menu
    $result .= $this->NactiUnikatniObsah($this->unikatni["tvar_admin_logoff"],
                                        $this->var->get_kam);  //nacteni odkazu log off + menu_tvar_admin

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
      if ($this->var->moduly[$i]["admin"])
      {
        if (method_exists($this->var->moduly[$i]["class"], "AdminObsah"))
        {
          $result .= $this->var->main[$i]->AdminObsah();
        }
          else
        {
          $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_gen_obsah"], $this->var->moduly[$i]["class"]), array(__LINE__, __METHOD__));
        }
      }
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
        if ($this->var->moduly[$i]["admin"])  //pokud ma modul databazi
        {
          if (!Empty($this->var->moduly[$i]["databaze"]))
          {
            $zip->addFromString("zaloha_{$this->var->moduly[$i]["class"]}_".date("d-m-Y_H-i-s").".sql", $this->NactiFunkci("AdministraceDatabaze", "ZalohujDatabazi", $i));
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

        $prvni = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_prvni"]);
        $posledni = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_posledni"]);
        $ente_def_array = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_ente_def_array"]);
        $ente_def = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_ente_def"]);
        $ente_od = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_ente_od"]);
        $ente_po = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_ente_po"]);
        $ente = $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_ente"]);

        for ($i = 0; $i < count($soubor); $i++)
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["vypis_zaloha_telicko"],
                                              $soubor[$i],
                                              "{$cesta}/{$soubor[$i]}",
                                              date($this->NactiUnikatniObsah($this->unikatni["admin_tvar_datum"]), filemtime("{$cesta}/{$soubor[$i]}")),
                                              $this->Velikost(filesize("{$cesta}/{$soubor[$i]}")),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iddelzal}&amp;file={$soubor[$i]}",
                                              ($i == 0 ? $prvni : ""),
                                              ($i == (count($soubor) - 1) ? $posledni : ""),
                                              (in_array($i, $ente_def_array) ? $ente_def : ""),
                                              ((($i + $ente_od) % $ente_po) == 0 ? $ente : ""));

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

    if (file_exists("{$this->var->zalohadir}/{$cesta}") &&
        !Empty($cesta))
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
        $return .= fgets($open, 4096);  //4096
      }
      fclose($open);

      $ret = @explode("\r\n\r\n", $return, 2);
      //$header = $ret[0]; //header
      $result = $ret[1]; //body
    }
      else
    {
      $this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_get_url"], $errno, $errstr), array(__LINE__, __METHOD__));
      $result = NULL;
    }
    //$result = file_get_contents($url);

    return $result;
  }

/**
 *
 * Kontrola emailu pres regularni vyraz, i vice, vysledek zimploduje
 *
 * pouziti: <strong>$email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", "email@email.cz");</strong>
 *
 * @param email text na zkontrolovani
 * @return je-li vyraz v poradku vrati jeho hodnotu
 */
  public function KontrolaEmailu($email)
  {
    $emaily = explode(",", $email);
    $result = "";
    $konec = false;
    $email = "";
    for ($i = 0; $i < count($emaily); $i++)
    {
      $regular = "/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$/";
      preg_match($regular, trim($emaily[$i]), $ret);

      if (!Empty($ret[0]))  //pokud je neprazdny, nechybny
      {
        $email[] = $ret[0];
      }
        else
      {
        $konec = true;
      }
    }

    $result = (!$konec ? implode(", ", $email) : "");

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
    $endtime = date(strtotime($this->var->admin_expire, $_SERVER["REQUEST_TIME"]));

    $result = $this->NactiUnikatniObsah($this->unikatni["text_cas_aktualizace"],
                                        date("H:i:s", $_SERVER["REQUEST_TIME"]),
                                        date("H:i:s", $endtime),
                                        $this->var->admin_expire);

    return $result;
  }

/**
 *
 * Akceptuje zadane prohlizece pri prihlasovani
 *
 * pouziti: <strong>$text = ($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece") ? "access" : "deny access")</strong>
 *
 * @return true/false - akceptoval/neakceptoval
 */
  public function AkceptujProhlizece()
  {
    $prohlizece = $this->NactiUnikatniObsah($this->unikatni["set_prohlizece"]);

    $result = false;
    $vysl = false;
    for ($i = 0; $i < count($prohlizece); $i++)
    {
      $vysl = $this->NactiFunkci("Funkce", $prohlizece[$i]);
      if ($vysl)  //kontrola vysledku
      {
        $result = $vysl;
      }
    }

    return $result;
  }

/**
 *
 * Provadi prihlaseni do adminu
 *
 */
  private function Prihlasovani()
  {
    $nextdate = date(strtotime($this->var->admin_expire));

    if ($_GET[$this->var->get_kam] == "logoff") //odhlaseni
    {
      unset($_SESSION["ADMIN:{$this->absolutni_url}"]["USER"]); //zrusi jen login a heslo
      unset($_SESSION["ADMIN:{$this->absolutni_url}"]["PASS"]);
      unset($this->var->backadmin);

      $this->AutoClick(0, $this->absolutni_url);
    }

    $login = stripslashes(htmlspecialchars($_POST["log_ad"], ENT_QUOTES));
    $heslo = stripslashes(htmlspecialchars($_POST["log_he"], ENT_QUOTES));

    if (!Empty($_POST["tl_log"]) &&
        !Empty($login) &&
        !Empty($heslo) &&
        $this->AkceptujProhlizece())  //checkuje prohlizec
    {
      if (!$this->Autorizace($login, $heslo)) //spatne
      {
        $this->var->aktivniadmin = false;

        unset($_SESSION["ADMIN:{$this->absolutni_url}"]["USER"]); //zrusi jen login a heslo
        unset($_SESSION["ADMIN:{$this->absolutni_url}"]["PASS"]);
        unset($this->var->backadmin);

        //$this->AutoClick(0, $this->absolutni_url);
      }
        else
      {
        if ($this->Autorizace($login, $heslo))  //kdyz je prihaseno
        {
          $this->var->aktivniadmin = true;
          $_SESSION["ADMIN:{$this->absolutni_url}"]["USER"] = md5(md5($login));
          $_SESSION["ADMIN:{$this->absolutni_url}"]["PASS"] = md5(md5($heslo));

          if (!Empty($_POST["log_ad"]))  //uklad po sobe $_POST
          {
            $autourl = (!Empty($_SESSION["ADMIN:{$this->absolutni_url}"]["LASTURL"]) ? $_SESSION["ADMIN:{$this->absolutni_url}"]["LASTURL"] : "{$this->var->get_kam}={$this->var->adresaadminu}");
            $this->AutoClick(0, "{$this->absolutni_url}?{$autourl}");
          }

          $_SESSION["ADMIN:{$this->absolutni_url}"]["TIME"] = $nextdate;
        }
      }
    }
      else
    {
      if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
          $this->Autorizace($_SESSION["ADMIN:{$this->absolutni_url}"]["USER"], $_SESSION["ADMIN:{$this->absolutni_url}"]["PASS"], false) &&
          $this->AkceptujProhlizece())  //pro admin, checkuje prohlizec
      {
        $this->var->aktivniadmin = true;
        $_SESSION["ADMIN:{$this->absolutni_url}"]["LASTURL"] = $_SERVER["QUERY_STRING"];  //pro zpetne vraceni na dane misto

        if ($_SERVER["REQUEST_TIME"] > $_SESSION["ADMIN:{$this->absolutni_url}"]["TIME"])  //expire
        {
          unset($_SESSION["ADMIN:{$this->absolutni_url}"]["USER"]); //zrusi jen login a heslo
          unset($_SESSION["ADMIN:{$this->absolutni_url}"]["PASS"]);
          unset($this->var->backadmin);

          $this->AutoClick(0, "{$this->absolutni_url}?{$this->var->get_kam}=logoff"); //kdyz vyprsi cas expirace tak autoclick
        }

        $_SESSION["ADMIN:{$this->absolutni_url}"]["TIME"] = $nextdate;
      }
        else
      {
        $this->var->aktivniadmin = false; //pro stranky
        $this->var->backadmin = $_SESSION["ADMIN:{$this->absolutni_url}"]["USER"]; //pro zobrazeni odkazu na indexu

        if ($_SERVER["REQUEST_TIME"] > $_SESSION["ADMIN:{$this->absolutni_url}"]["TIME"] &&  //presmerovani pri vyprseni
            $_GET[$this->var->get_kam] == $this->var->adresaadminu)
        {
          $_SESSION["ADMIN:{$this->absolutni_url}"]["LASTURL"] = $_SERVER["QUERY_STRING"];
          $this->AutoClick(0, $this->absolutni_url);
        }
      }
    }

    $this->var->adminlogin = (!Empty($_POST["log_ad"]) &&
                              !Empty($_POST["log_he"]) &&
                              !$this->Autorizace($_POST["log_ad"], $_POST["log_he"]) ? " disabled=\"disabled\"" : "");
  }

/**
 *
 * Overeni hesla do administrace
 *
 * @param login login admina
 * @param heslo heslo admina
 * @param kodovat zapnuto/vypnuto - implcitni kodovani
 * @return povoleno/zamitnuto - true/false
 */
  private function Autorizace($login, $heslo, $kodovat = true)
  {
    $result = false;
    for ($i = 0; $i < count($this->var->adminpristup); $i++)
    {
      $log = ($kodovat ? md5(md5($login)) : $login);
      $result = ($this->var->adminpristup[$i][$log] == ($kodovat ? md5(md5($heslo)) : $heslo));
      if ($result)
      {
        $sys = explode(":", $this->DekodujText($this->var->adminpristup[$i]["sys"]));
        if ($sys[2] == $log)
        {
          $this->var->adminuser["name"] = $sys[0];
          $this->var->adminuser["debug"] = ($sys[1] == "true");
          break;
        }
          else
        {
          $result = false;
        }
      }
    }

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
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("Funkce", "ErrorMsg", "text chyby", array(__LINE__, __METHOD__), "text odkazu zpet"[, true]);</strong>
 *
 * @param chyba text chyby
 * @param poloha poloha chyby se vstupem: array(__LINE__, __METHOD__)
 * @param zpet_odkaz text odkazu zpet
 * @param typ typ chyby
 * @return chyby interpretovana v html kodu
 */
  public function ErrorMsg($chyba, $poloha = array(0, NULL), $typ = "info")
  {
    static $volani = 0;

    $this->var->chyba[$volani]["chyba"] = $chyba;
    $this->var->chyba[$volani]["poloha"] = $poloha;
    $this->var->chyba[$volani]["typ"] = $typ;

    $volani++;
  }

/**
 *
 * Vytiskne vsechny vyvolane chyby
 *
 */
  public function VypisVsechnyChyby()
  {
    $chyby = $this->var->chyba;

    $this->ZavritDatabaze();  //tady uzavre databazi!!

    if (count($chyby) > 0)  //je-li nejaka chyba
    {
      $kriticka = 0;
      $result = $this->NactiUnikatniObsah($this->unikatni["text_chyba_begin"]);
      for ($i = 0; $i < count($chyby); $i++)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["text_chyba"],
                                            $chyby[$i]["chyba"],
                                            $chyby[$i]["poloha"][0],
                                            $chyby[$i]["poloha"][1]);

        if ($chyby[$i]["typ"] == "crit")  //detekce kryticke chyby
        {
          $kriticka++;
        }
      }

      $this->ErrorLog($chyby);  //logovani chyb

      $result .= $this->NactiUnikatniObsah($this->unikatni["text_chyba_end"],
                                          $this->absolutni_url,
                                          $_SERVER["QUERY_STRING"]);

      if ($kriticka != 0) //je-li detekovana kriticka chyba
      {
        echo $result;
        exit(1);
      }
        else
      {
        $this->var->chyba = $result;
      }
    }
  }

/**
 *
 * Zaloguje chyby ktere se staly
 *
 * @param chyby pole chyb
 */
  private function ErrorLog($chyby)
  {
    $cas = date("Y-m-d H:i:s");
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"];

    if (!file_exists($this->errorlogdir))
    {
      mkdir($this->errorlogdir, 0777);
    }

    $filedatum = date("d-m-Y");
    $soubor = "{$this->errorlogdir}/errorlog-{$filedatum}.txt";
    $u = fopen($soubor, "a");

    $tvar = "";
    for ($i = 0; $i < count($chyby); $i++)
    {
      $tvar[] = "array_args";
      $tvar[] = $chyby[$i]["chyba"];
      $tvar[] = $chyby[$i]["poloha"][0];
      $tvar[] = $chyby[$i]["poloha"][1];
      $tvar[] = $chyby[$i]["typ"];
      $tvar[] = $cas;
      $tvar[] = $ip;
      $tvar[] = $agent;
      $tvar[] = "--end--";

      fwrite($u, implode("|-x-|", $tvar));
      $tvar = ""; //po zapsani vymazat!
    }

    fclose($u);
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
                    "Ubuntu Linux \\4 (\\5)" => "/((Linux).*(Ubuntu\/([0-9\.]+) \(([a-zA-Z]+)\)))|((Ubuntu).*(Linux))/i",
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
//var_dump($agent);
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
                          "Mozilla Firefox \\2" => "#(Firefox|Shiretoko|Phoenix|Firebird)/([a-zA-Z0-9\.]+)#i",
                          "Opera \\1" => "#Opera[ /]([a-zA-Z0-9\.]+)#i",
                          "Netscape \\1" => "#Netscape[0-9]?/([a-zA-Z0-9\.]+)#i",
                          "Chrome \\1" => "#Chrome/([a-zA-Z0-9\.]+) Safari/([a-zA-Z0-9\.]+)#i",
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
 * Detekce firefoxu
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "DetekceFirefoxu") ? "je to firefox" : "je to coloki jineho")."</strong>
 *
 * @return je to opera / neni to opera - true(firefox) / false(jiny)
 */
  public function DetekceFirefoxu()
  {
    $OSList = array("Mozilla Firefox \\2" => "#(Firefox|Shiretoko|Phoenix|Firebird)/([a-zA-Z0-9\.]+)#i",
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
 * Detekce firefoxu
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "DetekceWebkitu") ? "je to webkit" : "je to coloki jineho")."</strong>
 *
 * @return je to opera / neni to opera - true(firefox) / false(jiny)
 */
  public function DetekceWebkitu()
  {
    $OSList = array("Safari \\1" => "#Safari/([a-zA-Z0-9\.]+)#i",
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
 * Detekce firefoxu
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "DetekceChromeLinux") ? "je to chrome" : "je to coloki jineho")."</strong>
 *
 * @return je to opera / neni to opera - true(firefox) / false(jiny)
 */
  public function DetekceChromeLinux()
  {
    $OSList = array("Safari \\1" => "#(U; Linux.*)Safari/([a-zA-Z0-9\.]+)#i",
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
    $symbol = $this->NactiUnikatniObsah($this->unikatni["set_jednotky"]);

    $exp = 0;
    $converted_value = 0;
    if ($size > 0)
    {
      $exp = floor(log($size) / log(1024));
      $converted_value = ($size / pow(1024, floor($exp)));
    }

    $result = sprintf(($exp == 0 ? "%d {$symbol[$exp]}" : "%.2f {$symbol[$exp]}"), $converted_value);

    return $result;
  }

/**
 *
 * Funkce na vygenerovani error_page stranek
 *
 */
  private function GenerovaniErrorPage()
  {
    if (file_exists($this->errorpage) &&  //kdyz exstuje slozka
        !file_exists("{$this->errorpage}/{$this->errorblok}") &&  //pokud neexistuje blokovac
        $_GET[$this->var->get_kam] == $this->var->adresaadminu) //pokud je v adminu
    {
      $error = $this->NactiUnikatniObsah($this->unikatni["text_error_page"]);

      $u = fopen("{$this->errorpage}/error_sablona.html", "r");
      $vystup = fread($u, filesize("{$this->errorpage}/error_sablona.html"));
      fclose($u);

      for ($i = 0; $i < count($error); $i++)
      {
        $pole = $error[$i];
        $pole["absolutni_url"] = $this->absolutni_url;  //prida absolutni cestu
        $pole["nazevwebu"] = $this->var->nazevwebu; //prida nazev webu
        $klice = array_keys($pole); //nezme klice
        $page = $vystup;  //zkopiruje obsah sablony

        for ($j = 0; $j < count($pole); $j++) //vepsani do sablony
        {
          $page = str_replace("%%{$klice[$j]}%%", $pole[$klice[$j]], $page);
        }

        $u = fopen("{$this->errorpage}/{$pole["kod"]}.html", "w");  //zapsani do souboru
        fwrite($u, $page);
        fclose($u);
      }

      $u = fopen("{$this->errorpage}/{$this->errorblok}", "w");  //vytvoreni souboru pro blokaci
      fwrite($u, date("Y-m-d H:i:s")); //vlozi datum vyvoreni
      fclose($u);
    }
  }

}
?>