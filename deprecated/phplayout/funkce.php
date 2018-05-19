<?php

/**
 *
 * Centralni funkce projektu
 *
 * debug info:
 * URL?debug=[debug, info, browscap, access, php, ip, adr, module, install, lasterror]
 *
 */

 //verze modulu
define("v_Funkce", "3.40");

include_once "default_modul.php";
class Funkce extends DefaultModule
{
  private $start, $konec, $var, $logoff, $unikatni,
          $absolutni_url, $cookie_url, $dbpredpona, $arraymenu;
  private $zaplaceno = false;
  public $idmodul = "funkce"; //hlavni adresa modulu
  private $idupdate = "_update";  //aktualizace
  private $iderror = "_error";  //error logy
  private $idusergui = "_usergui";  //admin uzivatele
  private $idlistlog = "_listlog";  //vypis logu
  private $idstatlog = "__statlog";  //vypis statistiky logu adminu
  private $iduserlog = "_userlog";  //rozcestnik pro vypis user logu
  private $idusercurlog = "__usercurlog"; //vypis logu za aktualni den
  private $iduseralllog = "__useralllog"; //vypis vsech logu
  private $idipban = "_ipban";  //banovani ip do adminu
  private $idset = "_set";  //konfigurace adminu
  private $idtest = "_test";  //testy v adminu
  private $idchmod = "_chmod";  //pristupy slozek
  private $idmoumod = "_moumod";  //administrace pripojovani modulu
  private $idcontrol = "_control";  //nastaveni adminu
  private $idhelp = "_help";  //help center
  private $idrepo = "__report";  //report zprav od adminu
  private $idfaq = "__faq"; //faq adminu
  private $idperm = "_permit";  //permission pro moduly
  private $idactlog = "_actlog";  //vypis logovanych akci
  private $idlogoff = "_logoff";  //pro odhlaseni

  private $dedicne = "duplikatni";  //prefix pri duplikaci

  private $localpermit;

  private $errorblok = ".vygenerovano"; //soubor pri vygenerovani error page
  private $adminsetblok = ".adminsetffiillee"; //soubor nastaveni casti static v adminu
  private $cachemodule = ".camcohdeule";  //cache modulu
  private $logprom = "login_promenne.php";  //soubor s login promennyma
  //cesta pro css permission
  private $csspermission = "styles/admin/permission";

  //slozka na databaze s logovanim a cache separatory
  private $dirweblog = "weblog";
  //cache grafu
  private $cachegraf = ".cachegraf";
  //cachovani dat, faq, novinek
  private $cachexmloutside = ".outsidexml";

  //temata vzhledu
  private $theme_pic = "obr/admin/theme"; //obrazky tematu
  private $theme_style = "styles/admin/theme";  //styly tematu
  //zarazena do slozky cache
  private $theme_cache = ".themecache";
  //separatory pro cache
  private $theme_sep_nazev = "|-nazev-|";
  private $theme_sep_cesta = "|-cesta-|";
  private $theme_sep_blok = "|-x-|";
  //uchovavaci soubor pro adminy
  private $set_admin_theme = ".setadmintheme";
  //defaultni tema a posleze aktualni
  public $current_theme = "under_water"; //nastavene tema
  //soubor cache aktualizaci
  private $updatefile = ".updatelist";

  //moznosti prohlizecu
  private $accessbrow = array("Firefox" => "3.6",
                              "Chrome" => "6.0",
                              "Safari" => "5.0",
                              "Opera" => "10.60");

  private $errorpage = "error_page";  //slozka error page
  private $zalohadbdir = "db";  //slozka zalohy databazi
  private $zalohauniq = "storeuniq";  //slozka zalohy unikatnich
  private $errorlogdir = "errorlog";  //slozka error logu

  private $typjednotky = array ("hodina" => "Hodina", //definovane: blokace_typ_jednotka
                                "den" => "Den",
                                "mesic" => "Měsíc");

  //pripojovane/spravovane soubory modulem
  public $mount = array(".unikatni_funkce.php",
                        "index.php",
                        ".unikatni_index.php",
                        "ajax_funkce.php",
                        "default_modul.php",
                        "promenne.php",
                        "class/browscap.php",
                        );

  public $generated = array("script/ajax.js"); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu, pro prenos do ajaxu
  public $namemodule; //nazvy pro modul
  public $convmeth = array("AjaxFunkce" => "Funkce"); //konvert nazvu metody

  private $bantyp = array("...",);  //nactene typy banu z unikatnich

  public $getdebug = false; //jednoduchy debug z get-u

  public $typdatabaze = array("...", ); //nacteni typu db z unikatnich

//dodelat!! pri nejlepsim poresit malinko jinak!!!
  private $securemodule = array(1, 2, 3, 4);  //id chranenych modulu, 5, 6
  private $hranicesecure = 20;  //klicove cislo pro urceni secure
  private $origuloziste = array("", //originalni jmena uloziste
                                "sqlite",
                                "mysqli");

//dodelat!!!!
//i pak statistiky na slozky a pod... treba - do budoucna
//mozna i na live graf z: sys_getloadavg()
//preskladat organizaci uloh na crona!!! a logicky rozdeli a seskupit!!! + upgradovat na vnitrni casovani!!!!!!!
//predelat cachovani barevnych temat
//predelat funkci na vypis adresaru (glob())
//vyresit browscap ve vypisech! - nebo skusit pouzivat lite knihovnu
//postelovat overovani platnosti browsapu pres ajax
//updaty browscapu by se mohli kontrolovat i pres crona...
//ve funkci pri vyberu modulu brat nazev slozky jako nazev mohulu bez pripony!
//vyhodit polozku sqlite verze, zip verze, pridat pdo
//zacait implementvat lepsi podporu DB!!! a to: mysqli, sqlite2, (nebo obecne pres PDO) pdo_sqlite3, pdo_mysql
//pokud se to dobre uchytne tak nejak posefovat pole: $this->support
//mozna by se dalo vyuzitna firmulare a nebo si udelat reimplementaci: http://doc.nette.org/cs/nette-forms
//mozna i toto na db, pres vlastni reimplmentaci a nebo i mozna pouzit: http://php.vrana.cz/notorm.php

//vylepsit crona na ucoven vlasniho rozlisovani casu!
//cron: den (jaky den v tydnu 1-7), denmesice (jaky den v mesici 1-31), tyden (jaky tyden 1-53), mesic (jaky mesic 1-12), rok (jaky den roku 1-365)
//to bude zakladni sada + kazdy volba by mohla mit i moznost kazdy N-ty prvek, pr: kazde pondeli-kazdeho mesice (fungovat to musi jako pridavna tabulka! 1:N)

/**
 *
 * Konstruktor funkce, ocesano z duvodu vicenasobneho spouseni
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 *
 */
  public function __construct(&$var = NULL, $index = -1, $unikatni = false) //konstruktor
  {
    $this->adress = array($this->idmodul, $this->idupdate, $this->idmoumod, //0..2
                          $this->idperm, $this->idusergui, $this->iderror,  //3..5
                          $this->idlistlog, $this->idstatlog, $this->iduserlog, //6..8
                          $this->idactlog, $this->idipban, $this->idset,  //9..11
                          $this->idtest, $this->idcontrol, $this->idchmod,  //12..14
                          $this->idhelp, $this->idrepo, $this->idfaq, //15..17
                          $this->idusercurlog, $this->iduseralllog, $this->idlogoff //18..20
                          );

    if (!Empty($var))
    {
      $this->var = $var;
      //includovani unikatniho obsahu
      if (!Empty($_GET[$this->var->get_kam]) &&
          $_GET[$this->var->get_kam] == $this->var->adresaadminu ||
          $unikatni) //includovani jen kdyz je v adminu, nebo je potreba jindy
      {
        $this->unikatni = $this->NactiObsahSouboru("{$this->AdresarWebu()}/.unikatni_funkce.php");
        $this->AdminSetConfigLoad();  //prepsani urcitych veci
      }
    }
  }

/**
 *
 * Hlavni inicializace modulu, jakasi nahrada __construct-toru
 *
 * @param &info pres parametr vracena informace
 */
  public function InicializaceModulu(&$info)
  {
    $this->absolutni_url = $this->AbsolutniUrl();

    $_SERVER["REMOTE_ADDR"] = (!Empty($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"]);

    $this->cookie_url = str_replace(".", "x", $_SERVER["REMOTE_ADDR"]); //konvert ip
    $this->getdebug = ($this->NotEmpty("get", "debug") == "debug");  //debug vyvolany pres adresu

    $this->StartSession();

    //includovani unikatniho obsahu
    if (!(!Empty($_GET[$this->var->get_kam]) &&
        $_GET[$this->var->get_kam] == $this->var->adresaadminu)) //jen mimo admin
    {
      $this->unikatni = $this->NactiObsahSouboru(".unikatni_funkce.php", false);
      $this->AdminSetConfigLoad();  //prepsani urcitych promennych

      $now = strtotime("now");
      $valkey = "{$this->var->dirmodule}/.kleiyc";
      if (file_exists($valkey))
      { //overovani
        $mtime = filemtime($valkey);
        if ($mtime < strtotime("-1 month", $now))
        { //smaze soubor a bude cekat na znovu overeni
          @unlink($valkey);
        }
      }
        else
      { //stahovani, pokud nestahuje sam ze sebe, jinak sam sebe odstreli
        if ($this->var->administrace != $this->absolutni_url)
        {
          $save_array = array("absolutni_url" => array("self", "string", $this->absolutni_url),
                              "UNIQUE_ID" => array("server", "string"),
                              "SCRIPT_URL" => array("server", "string"),
                              "SCRIPT_URI" => array("server", "string"),
                              "HTTP_ACCEPT" => array("server", "string"),
                              "HTTP_ACCEPT" => array("server", "string"),
                              "HTTP_USER_AGENT" => array("server", "string"),
                              "HTTP_ACCEPT_ENCODING" => array("server", "string"),
                              "HTTP_ACCEPT_LANGUAGE" => array("server", "string"),
                              "HTTP_ACCEPT_CHARSET" => array("server", "string"),
                              "HTTP_COOKIE" => array("server", "string"),
                              "HTTP_X_FORWARDED_FOR" => array("server", "string"),
                              "HTTP_X_ORIGINAL_TO" => array("server", "string"),
                              "HTTP_CONNECTION" => array("server", "string"),
                              "PATH" => array("server", "string"),
                              "SERVER_SIGNATURE" => array("server", "string"),
                              "SERVER_SOFTWARE" => array("server", "string"),
                              "SERVER_NAME" => array("server", "string"),
                              "SERVER_ADDR" => array("server", "string"),
                              "SERVER_PORT" => array("server", "string"),
                              "REMOTE_ADDR" => array("server", "string"),
                              "DOCUMENT_ROOT" => array("server", "string"),
                              "SERVER_ADMIN" => array("server", "string"),
                              "SCRIPT_FILENAME" => array("server", "string"),
                              "REMOTE_PORT" => array("server", "string"),
                              "GATEWAY_INTERFACE" => array("server", "string"),
                              "SERVER_PROTOCOL" => array("server", "string"),
                              "REQUEST_METHOD" => array("server", "string"),
                              "QUERY_STRING" => array("server", "string"),
                              "REQUEST_URI" => array("server", "string"),
                              "SCRIPT_NAME" => array("server", "string"),
                              "PHP_SELF" => array("server", "string"),
                              "REQUEST_TIME" => array("server", "string"),
                              "argv" => array("server", "array"),
                              "argc" => array("server", "string"),
                              );
          //zpracovani xml souboru
          $xml = $this->ControlCreateXml($save_array, array());
          //zakoduje texty a osetri pro bezpecne preneseni pres url
          $j = rawurlencode(base64_encode($this->absolutni_url));
          $k = rawurlencode(base64_encode($xml));
          $retll = $this->NactiUrl("{$this->var->administrace}", array("post" => "kk={$j}&ll={$k}"));
          if ($retll == "ok")
          {
            if ($u = fopen($valkey, "w"))
            {
              fwrite($u, $now);  //kdy bylo zapsano
              fclose($u);
            }
          }
          //dodelat!! pridat stav na blok!
        }
          else
        {
          if ($u = fopen($valkey, "w"))
          {
            fwrite($u, $now);  //kdy bylo zapsano
            fclose($u);
          }
        }
      }
    }

    //nacitani opravneni
    $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                              $this->idmodul,
                                              $this->idlogoff,
                                              $this->idmoumod,
                                              $this->idupdate,
                                              $this->idset, //5
                                              $this->idcontrol,
                                              $this->idchmod,
                                              $this->idperm,
                                              $this->idusergui,
                                              $this->idlistlog, //10
                                              $this->idstatlog,
                                              $this->idipban,
                                              $this->idactlog,
                                              $this->iderror,
                                              $this->iduserlog, //15
                                              $this->idusercurlog,
                                              $this->iduseralllog,
                                              $this->idhelp,
                                              $this->idrepo,
                                              $this->idfaq,  //20
                                              $this->idtest
                                              );

    $this->namemodule = $this->unikatni["name_module"];

    if (!defined("PHP_VERSION_ID")) //pokud neni definovano ID do verze php: 5.2.7
    {
      $version = explode(".", PHP_VERSION); //rozparsrovani verze

      define("PHP_VERSION_ID", ($version[0] * 10000 + $version[1] * 100 + $version[2]));
    }

    //kontrola verze, kvuli php5, last: 50210
    if (PHP_VERSION_ID < $this->var->phpmin)  //min: 50200
    {
      $curphpver = PHP_VERSION;
      $curphpid = PHP_VERSION_ID;
      echo "Máte příliš starou verzi PHP: [{$curphpver}], potřebujete minimálně verzi {$this->var->phpmin}, vaše je: {$curphpid} !";
      exit(1);
    }

    $this->bantyp = $this->unikatni["set_bantyp"];  //typy banu
    $this->typdatabaze = $this->unikatni["set_typdatabaze"];  //typy databaze
    $this->current_theme = $this->unikatni["set_current_theme"];  //defaultni nazev tematu

    $this->StartFunkce(); //inicializace modulu

    //nastaveni komunikace
    $this->dbpredpona = $this->NastavKomunikaci($this->var, 0, NULL, NULL, true);

    $this->Instalace(); //volani instalace databaze

    //aplikace permission na nactene pole permission
    $this->localpermit = $this->AplikacePermission($this->var->moduly[0]["class"], $this->permit);

    $c_moduly = count($this->var->moduly);
    if ($this->getdebug)  //zobrazeni debug info
    {
      echo $this->NactiUnikatniObsah($this->unikatni["vypis_debug"],
                                    1,  //poradi
                                    $c_moduly,  //pocet
                                    $this->var->moduly[0]["class"], //aktualni
                                    $this->var->moduly[1]["class"], //dalsi
                                    $this->var->moduly[0]["include"]);  //cesta
    }

    //nacitani $this->var->asocmoduly["index"][] preneseno do StartFunkce
    $this->var->asocmoduly["idmodul"][$this->idmodul] = 0; //nacitani id modulu

    foreach ($this->var->moduly as $index => $hodnota)
    {
      if ($index > 0) //preskoci funkci [0]
      {
        //existuje cesta a je do jeji slozky moznost zapisovani
        if (file_exists($hodnota["include"]) &&
            is_writable(dirname($hodnota["include"])))
        {
          include_once $hodnota["include"];

          if (class_exists($hodnota["class"]))
          {
            if ($this->getdebug)  //zobrazeni debug info
            {
              echo $this->NactiUnikatniObsah($this->unikatni["vypis_debug"],
                                            $index + 1,
                                            $c_moduly,
                                            $hodnota["class"],
                                            (!Empty($this->var->moduly[$index + 1]["class"]) ? $this->var->moduly[$index + 1]["class"] : "---"),
                                            $hodnota["include"]);
            }

            if (method_exists($hodnota["class"], "__construct"))
            {
              $this->var->main[$index] = new $hodnota["class"]($this->var, $index);

              //pokud existuje promenna idmodul v modulu
              if (property_exists($this->var->main[$index], "idmodul"))
              {
                $this->var->asocmoduly["idmodul"][$this->var->main[$index]->idmodul] = $index; //nacitani indexu podle idmodulu
              }
            }
              else
            {
              $this->ErrorMsg("Z třídy: \"{$hodnota["class"]}\", metoda konstruktoru neexistuje !", array(__LINE__, __METHOD__));
            }
          }
            else
          {
            $this->ErrorMsg("Třída: \"{$hodnota["class"]}\" neexistuje !", array(__LINE__, __METHOD__));
          }
        }
          else
        {
          $path = dirname($hodnota["include"]);
          if (!is_writable($path))
          {
            $this->ErrorMsg("Nelze zapisovat do složky: \"{$path}\" !", array(__LINE__, __METHOD__));
          }
            else
          {
            $this->ErrorMsg("Třída: \"{$hodnota["class"]}\" nemá svoje zastoupení v modulech !", array(__LINE__, __METHOD__));
          }
        }
      }
    }

    $this->zaplaceno = $this->unikatni["set_zaplaceno"];

    $result = $this->BlokaceStranky($info);

    $this->Prihlasovani();  //volani prihlasovani
    $this->OverovaniBanIp(array("session")); //aplikace banu pro stranky
    $this->AdminLoadTema(); //nacitani aktualniho tematu
    $this->AdminAddWebLog(); //logovani statistik pristupu na stranky
    $this->KomunikaceFukce();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul,
                                                        $this->idmoumod,  //2
                                                        $this->idupdate,
                                                        $this->idset,
                                                        $this->idcontrol, //5
                                                        $this->idchmod,
                                                        $this->idperm,
                                                        $this->idusergui,
                                                        $this->idlistlog,
                                                        $this->idstatlog, //10
                                                        $this->idipban,
                                                        $this->idactlog,
                                                        $this->iderror,
                                                        $this->iduserlog,
                                                        $this->idusercurlog,  //15
                                                        $this->iduseralllog,
                                                        $this->idhelp,
                                                        $this->idrepo,  //18
                                                        $this->idfaq,
                                                        $this->idtest //20
                                                        ));

    $debug = (!Empty($_GET["debug"]) ? $_GET["debug"] : "");
    //rozliseni servisniho debug modu
    if (!Empty($debug))
    {
      switch ($debug)
      {
        case "info":  //informace o prohlizeci
          $os = $this->TypOS($_SERVER["HTTP_USER_AGENT"]);
          $browser = $this->TypBrowseru($_SERVER["HTTP_USER_AGENT"]);
          $typ_sys = $this->TypSystemu();
          var_dump($os, $browser, $typ_sys);
        break;

        case "browscap":  //vypise informace z browscapu
          print_r($this->GetBrowser());
        break;

        case "access":  //vypise jestli ma prohlizec pravo pristupovat do adminu
          var_dump($this->AkceptujProhlizece(), $this->unikatni["set_prohlizece"]);
        break;

        case "php": //vypise verzi php
          echo PHP_VERSION;
        break;

        case "ip":  //vypise aktualni ip adresu
          echo $_SERVER["REMOTE_ADDR"];
        break;

        case "adr": //vypsani adres
          var_dump($this->absolutni_url, $this->AdresarWebu(), $this->cookie_url, $this->GetSessionId());
        break;

        case "module":
          $ext = get_loaded_extensions(); //vsechny nactene moduly apache
          natcasesort($this->var->needexmod);  //seradeni hodnot sestupne
          $row = array();
          foreach ($this->var->needexmod as $hodnota) //projiti pole potrebnych modulu
          {
            $row[] = $this->NactiUnikatniObsah($this->unikatni["ajax_need_ext"],
                                              $hodnota,
                                              (in_array($hodnota, $ext) ? " checked=\"checked\"" : ""));
          }
          echo implode("<br />", $row);
        break;

        case "install": //provede kroky na kontrolu/vytvoreni slozek/instalace webu
          $dirarray = array($this->errorlogdir, //0
                            $this->errorpage,
                            $this->zalohauniq,
                            $this->zalohadbdir,
                            $this->dirweblog,
                            $this->diractlog,
                            $this->dirsession,
                            $this->dircache);

          //kontrola nainstalovanych slozek
          foreach ($dirarray as $index => $slozka)
          {
            echo (file_exists($slozka) ? "s:{$index} existuje<br />\n" : "s:{$index} neexistuje<br />\n");
            $this->ControlCreateDir(array(array($slozka)));
          }
          //nacachovani temat
          $this->AdminCacheTema();

          ini_set("memory_limit", "100M");  //rezervuje vic mega
          $br = new Browscap($this->dircache);
          $br->lowercase = true;  //male pismena v promennch
          $br->doAutoUpdate = true; //povoleny autoupdate!
          $br->updateMethod = Browscap::UPDATE_CURL;  //stahovani pres curl
          echo "<strong>Browscap:</strong> ";
          $cesta = "{$this->dircache}/{$br->iniFilename}";
          if (file_exists($cesta))
          {
            echo "{$this->Velikost(filesize($cesta))}<br />";
          }
            else
          {
            echo "reload<br />";
          }
          $browser_name = $br->getBrowser()->browser_name;
          if (!Empty($browser_name))
          {
            echo $browser_name;
          }
            else
          {
            echo "fail: cache.php";
          }
          exit(0);
        break;
      }
    }
//var_dump($this->OverovaniManualPermission());
//var_dump($_COOKIE);
    return $result;
  }

/**
 *
 * Napojeni na funkci v ajaxu a provedeni vsech startovanich a nastavovacich ukonu
 *
 * @param soubor soubor unikatnich
 * @return nactene unikatni
 */
  public function AjaxInicializaceModulu($soubor)
  {
    $this->StartFunkce(); //nacteni modulu z cache

    $result = $this->NactiObsahSouboru($soubor);  //nacteni unikatnich
    $this->AdminSetConfigLoad($result);  //prepsani urcitych veci a preneseni unikatni

    return $result;
  }

/**
 *
 * Pocatecni nastaveni modulu pro zakladni start
 *
 */
  private function StartFunkce($generovat = false)
  {
    //nastaveni globalni absolutni cesty
    $this->var->absolutni_url = $this->AbsolutniUrl();

    $_SERVER["REMOTE_ADDR"] = (!Empty($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"]);

    $cesta = $this->FileVynorovani("{$this->var->dirmodule}/{$this->cachemodule}");
    //pri existenci nacita a pri pozadavku na generovani pregeneruje
    if (file_exists($cesta) && !$generovat)
    {
      //nacteni cache modulu
      $u = fopen($cesta, "r");
      $data = explode("|Xx-xX|", fread($u, filesize($cesta)));
      fclose($u);

      $include_cache = explode("|x|", $data[0]);
      $class_cache = explode("|xx|", $data[1]);
      $admin_cache = explode("|xxx|", $data[2]);
      $databaze_cache = explode("|xxxx|", $data[3]);
      $uloziste_cache = explode("|xxxxx|", $data[4]);

      //projiti polozek cache
      $result = "";
      foreach ($include_cache as $index => $polozka)
      {
        $result[$index]["include"] = $polozka;
        $result[$index]["class"] = $class_cache[$index];
        settype($admin_cache[$index], "boolean"); //konvert na boolean
        $result[$index]["admin"] = $admin_cache[$index];
        $result[$index]["databaze"] = $databaze_cache[$index];
        $result[$index]["uloziste"] = $uloziste_cache[$index];

        $this->var->asocmoduly["index"][$class_cache[$index]] = $index;
      }

      $this->var->moduly = $result; //nastaveni hlavnich modulu
    }
      else
    {
      //var_dump("generuji cache s moduly");
      $this->var->moduly = array (array("include" => "funkce.php",  //hlavni funkce musi byt implicitne 0
                                        "class" => "Funkce",
                                        "admin" => true,  //zobrazit v adminu
                                        "databaze" => "modules/.sqlite2",
                                        "uloziste" => "sqlite")
                                  );

      //nastaveni komunikace
      $this->dbpredpona = $this->NastavKomunikaci($this->var, 0, NULL, NULL, true);

      $this->Instalace(); //volani instalace databaze

      $this->AdminGenerateModule(); //vygenerovani cache modulu
    }

    //preneseni do super globalu bool opravneni i pro ajax
    $this->var->permit_mod = $this->OverovaniPermission();
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
    if (!Empty($_GET[$this->var->get_kam]) &&
        $_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      switch ($this->NotEmpty("get", $this->var->get_idmodul))
      {
        case "":  //pri prazdne adrese presmerovani na idmodul a nebo na ret
          $result = $this->unikatni["admin_redirect"];

          if (!Empty($_GET["ret"]))
          { //pokud se treba zbavit se postu v adrese, prenese se pres toto presmerovani
            $this->AutoClick(0, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$_GET["ret"]}");  //auto kliknuti na ret
          }
            else
          { //klasicky stav spatne adresy
            $this->AutoClick(0, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case $this->idmodul:  //uvod adminu
          $result = $this->AdministraceObsahu();
        break;

        case "{$this->idmodul}{$this->idupdate}": //aktualizace
          $result = $this->AdminKontrolaAktualizace();
        break;

        case "{$this->idmodul}{$this->iderror}":  //prohlizeni error logu
          $result = $this->AdminVypisErrorLogu();
        break;

        case "{$this->idmodul}{$this->idusergui}":  //uprava uzivatelu adminu
          $result = $this->AdminUser();
        break;

        case "{$this->idmodul}{$this->idlistlog}":  //admin logu
          $result = $this->AdminLog();
        break;

        case "{$this->idmodul}{$this->idstatlog}":  //admin statistika logu
          $result = $this->AdminStatLog();
        break;

        case "{$this->idmodul}{$this->iduserlog}":  //admin webu logu (statistiky)
          $result = $this->AdminWebLog();
        break;

        case "{$this->idmodul}{$this->idusercurlog}":  //weblog za dnesek
          $result = $this->AdminWebLogDay();
        break;

        case "{$this->idmodul}{$this->iduseralllog}":  //weblog za vsechny dny
          $result = $this->AdminWebLogAll();
        break;

        case "{$this->idmodul}{$this->idipban}":  //admin ip ban-u
          $result = $this->AdminIpBan();
        break;

        case "{$this->idmodul}{$this->idset}":  //konfigurace adminu
          $result = $this->AdminSetConfig();
        break;

        case "{$this->idmodul}{$this->idtest}": //testy v adminu
          $result = $this->AdminTest();
        break;

        case "{$this->idmodul}{$this->idchmod}":  //pristupova prava
          $result = $this->AdminChmod();
        break;

        case "{$this->idmodul}{$this->idmoumod}":  //pripojovani modulu
          $result = $this->AdminMountModule();
        break;

        case "{$this->idmodul}{$this->idcontrol}":  //ovladani adminu
          $result = $this->AdminControl();
        break;

        case "{$this->idmodul}{$this->idhelp}": //help center - krizovatka
          $result = $this->AdminHelpCenter();
        break;

        case "{$this->idmodul}{$this->idrepo}": //report zprav
          $result = $this->AdminReport();
        break;

        case "{$this->idmodul}{$this->idfaq}":  //faq pro admin
          $result = $this->AdminFAQ();
        break;

        case "{$this->idmodul}{$this->idperm}": //permission modulu
          $result = $this->AdminPermission();
        break;

        case "{$this->idmodul}{$this->idactlog}": //admin log user akci
          $result = $this->AdminActionLog();
        break;

        case "{$this->idmodul}{$this->idlogoff}": //odhlaseni z adminu
          $result = $this->unikatni["admin_logoff"];  //text pri odhlaseni

          $this->AutoClick(0, "?{$this->var->get_kam}=logoff");  //auto kliknuti
        break;
      }
    }

    return $result;
  }

/**
 *
 * Instalace databaze
 *
 */
  private function Instalace()  //instalace databaze
  {
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}useradmin (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                login VARCHAR(800),
                                loginlog VARCHAR(100),
                                heslo VARCHAR(100),
                                permission INTEGER UNSIGNED,
                                jmeno VARCHAR(800),
                                konfigurace TEXT,
                                superadmin BOOL,
                                pridano DATETIME,
                                upraveno DATETIME,
                                aktivni BOOL);

                              CREATE TABLE {$this->dbpredpona}ipban (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                nazev VARCHAR(100),
                                typ VARCHAR(50),
                                login VARCHAR(100),
                                ip VARCHAR(50),
                                pridano DATETIME,
                                upraveno DATETIME,
                                aktivni BOOL);

                              CREATE TABLE {$this->dbpredpona}adminlog (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                login VARCHAR(100),
                                wrongpass VARCHAR(100),
                                datum DATETIME,
                                ip VARCHAR(50),
                                agent VARCHAR(300),
                                pocet INTEGER UNSIGNED,
                                language VARCHAR(100),
                                cookie TEXT,
                                get TEXT);

                              CREATE TABLE {$this->dbpredpona}moduly (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                include VARCHAR(500),
                                class VARCHAR(100),
                                admin BOOL,
                                databaze VARCHAR(100),
                                uloziste INTEGER UNSIGNED,
                                aktivni BOOL,
                                poradi INTEGER UNSIGNED,
                                pevneporadi INTEGER UNSIGNED);

                              CREATE TABLE {$this->dbpredpona}reporty (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                login VARCHAR(100),
                                email VARCHAR(200),
                                predmet VARCHAR(500),
                                message TEXT,
                                pridano DATETIME,
                                ip VARCHAR(50),
                                agent VARCHAR(300));

                              CREATE TABLE {$this->dbpredpona}permission (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                nazev VARCHAR(100),
                                popis TEXT,
                                opravneni TEXT,
                                pridano DATETIME,
                                upraveno DATETIME,
                                aktivni BOOL);
                              ");

    //preinstalace dat
    $this->ControlPreInstall($this->unikatni["control_preinstall"],
                            array($this->hranicesecure),
                            $error);
  }

/**
 *
 * Vygenerovani ajax scriptu pro web
 *
 */
  public function VygenerujAjaxScript()
  {
    $result = "";
    $cesta = $this->generated[0];
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        "");

      $result = $this->ControlWriteFile(array($cesta => $obsah));
    }

    return $result;
  }

/**
 *
 * Vykreslovani web info na uvodni strance
 *
 * @return vypis web info
 */
  private function AdminUvodniWebInfo()
  {
    $cesta = "{$this->dircache}/{$this->cachexmloutside}";
    if (file_exists($cesta) &&
        is_file($cesta))
    {
      $xml = simplexml_load_file($cesta);
//dodelat!!! rozsirit u adminu o zaplaceno a tim to podbarvovat
      $tvar_datum = $this->unikatni["admin_uvodni_webinfo_tvar_datum"];
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_uvodni_webinfo"],
                                          (string)$xml->web->poskdomena,
                                          date($tvar_datum, strtotime((string)$xml->web->expdomena)),
                                          (string)$xml->web->poskhosting,
                                          date($tvar_datum, strtotime((string)$xml->web->exphosting)));
    }
      else
    {
      $result = $this->Hlaska("warning", "Nejsou nacachovany hodnoty");
    }

    return $result;
  }

/**
 *
 * Vykreslovani novinek na uvodni strance
 *
 * @return vypis novinek
 */
  private function AdminUvodniNovinky()
  {
    $cesta = "{$this->dircache}/{$this->cachexmloutside}";
    if (file_exists($cesta) &&
        is_file($cesta))
    {
      $xml = simplexml_load_file($cesta);
      $tvar_datum = $this->unikatni["admin_uvodni_novinky_tvar_datum"];
      $ret = array();
      if (!Empty($xml->novinky))
      {
        $index = 0;
        foreach ($xml->novinky as $polozka)
        { //pocitani kazde 2 polozky
          $pocitani = (($index % 2) == 0);
          $ret[] = $this->NactiUnikatniObsah($this->unikatni[($pocitani ? "admin_uvodni_novinky_row_sudy" : "admin_uvodni_novinky_row_lichy")],
                                            (string)$polozka->nazev,
                                            date($tvar_datum, strtotime((string)$polozka->datum)),
                                            (string)$polozka->popis,
                                            (!$pocitani || ($index == count($xml->novinky) - 1) ? $this->unikatni["admin_uvodni_novinky_row_end"] : ""));
          $index++;
        }
      }
        else
      {
        $ret[] = $this->unikatni["admin_uvodni_novinky_row_null"];
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_uvodni_novinky"],
                                          implode("", $ret));
    }
      else
    {
      $result = $this->Hlaska("warning", "Nejsou nacachovany hodnoty");
    }

    return $result;
  }

/**
 *
 * Vykreslovani hlavicky na uvodni strance
 *
 * @return vypis hlavicky
 */
  private function AdminUvodniHeader()
  {
    $result = "";

    if ($this->var->admin_mod)
    { //hlavicka adminu
      $result = $this->unikatni["admin_uvodni_header_admin"];
    }
      else
    { //hlavicka uzivatele
      $cesta = "{$this->dircache}/{$this->cachexmloutside}";
      if (file_exists($cesta) &&
          is_file($cesta))
      {
        $xml = simplexml_load_file($cesta);
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_uvodni_header_user"],
                                            (string)$xml->nastaveni->dialog);
      }
        else
      {
        $result = $this->Hlaska("warning", "Nejsou nacachovany hodnoty");
      }
    }

    return $result;
  }

/**
 *
 * Vykreslovani grafu na uvodni strance
 *
 * @return graf
 */
  private function AdminUvodniGraf()
  {
    $result = "";
    $res = $this->ControlConfig(array("cachegraf"), true,
                                array("load|config", "{$this->dircache}/{$this->cachegraf}"));

    if (!Empty($res) &&
        is_array($res->cachegraf))
    {
      //pocet pristupu za poslednich 30 dni
      $pocet_pristupu = array();
      foreach ($res->cachegraf as $datum => $pocet)
      {
        $dat = strtotime($datum);
        $y = date("Y", $dat);
        $m = date("n", $dat) - 1;
        $d = date("j", $dat);
        $h = date("G", $dat);
        $i = date("i", $dat);
        settype($i, "integer");
        $s = date("s", $dat);
        settype($s, "integer");

        $pocet_pristupu[] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$pocet}]";
      }
      $pocet_pristupu = implode(", ", $pocet_pristupu);

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_uvodni_graf"],
                                          $this->var->highcharts,
                                          $pocet_pristupu);
    }
      else
    {
      $result = $this->Hlaska("warning", "Nejsou nacachovany hodnoty");
    }

    return $result;
  }

/**
 *
 * Administrace hlavniho obsahu, uvodni stranka
 *
 * @return administrace hlavniho obsahu
 */
  private function AdministraceObsahu()
  {
    //nacitani opraveni pro odkaz do userlogu
    $userlog = $this->OverovaniManualPermission(NULL, "{$this->idmodul}{$this->iduserlog}", "");
    $result = $this->NactiUnikatniObsah($this->unikatni["uvod_admin_text"],
                                        $this->AdminUvodniHeader(),
                                        $this->AdminUvodniWebInfo(),
                                        $this->AdminUvodniNovinky(),
                                        $this->AdminUvodniGraf(),
                                        ($userlog ? $this->NactiUnikatniObsah($this->unikatni["uvod_admin_text_userlog"],
                                                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iduserlog}") : ""),
                                        $this->AdminVypisObsahu());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addfilezal":  //vytvoreni zalohy
          $this->CronZalohovaniDatabaze(true);
        break;

        case "delfilezal": //vymazani souboru zalohy
          $cesta = $_GET["file"];

          if (!Empty($cesta) &&
              file_exists("{$this->zalohadbdir}/{$cesta}"))
          {
            $result = (@unlink("{$this->zalohadbdir}/{$cesta}") ? $this->Hlaska("del", $cesta) : "");

            $this->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
            else
          {
            $result = $this->Hlaska("notexists", $cesta);

            $this->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
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
  private function AdminVypisObsahu()
  {
    $result = "";
    if ($this->var->admin_mod)
    {
      $cesta = $this->zalohadbdir;
      if ($soubor = $this->VypisSouboru($cesta, array("date", "desc")))
      {
        $tvar_datum = $this->unikatni["admin_tvar_datum"];
        $row = array();
        //vypis zaloh databazi
        foreach ($soubor as $index => $data)
        {
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_zaloha_row"],
                                              $data,
                                              "{$cesta}/{$data}",
                                              date($tvar_datum, filemtime("{$cesta}/{$data}")),
                                              $this->Velikost(filesize("{$cesta}/{$data}")),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfilezal&amp;file={$data}",
                                              (($index % 2) == 0 ? $this->unikatni["admin_vypis_zaloha_lichy"] : $this->unikatni["admin_vypis_zaloha_sudy"]));
        }

        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_zaloha"],
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfilezal",
                                            implode("", $row));


      }
        else
      { //pri null i odkaz na znovu vygenerovani
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_zaloha_null"],
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfilezal");
      }
    }

    return $result;
  }

/**
 *
 * Vrati pocet radku v aktualnim error logu
 *
 * @return pocet radku
 */
  private function PocetRadkuErrorLogu($dnes = true)
  {
    $result = 0;
    switch ($dnes)
    {
      case true:  //pocet erroru za aktualni den
        $datum = date("d-m-Y");
        $soubor = "{$this->errorlogdir}/errorlog-{$datum}.txt";
        if ($u = @fopen($soubor, "r"))
        {
          $u = fopen($soubor, "r");
          $size = (filesize($soubor) == 0 ? 1 : filesize($soubor));
          $result = count(explode("--end--", fread($u, $size))) - 1;
          fclose($u);
        }
      break;

      case false: //pocet erroru celkove ze slozky error logu
        $cesta = $this->errorlogdir;
        $poc = 0;
        if ($soubor = $this->VypisSouboru($cesta))
        {
          foreach ($soubor as $polozka)
          {
            $log = "{$cesta}/{$polozka}";
            if ($u = @fopen($log, "r"))
            {
              $size = (filesize($log) == 0 ? 1 : filesize($log));
              $poc += count(explode("--end--", fread($u, $size))) - 1;
              fclose($u);
            }
          }
        }

        $result = $poc;
      break;
    }

    return $result;
  }

/**
 *
 * Souhrnne informace o webu
 *
 * @return vrati info
 */
  private function InfoLayout()
  {//prehodit do test!!!
    if ($this->var->admin_mod)
    {
      $sum = 0;
      $dbpoc = 0;
      $modpoc = 0;
      foreach ($this->var->moduly as $hodnota)
      {
        $path = dirname($hodnota["include"]); //utvoreni pathe
        $dodatek = ($hodnota["uloziste"] == "mysqli" ? ".mysqli" : ""); //vytvoreni suffixu

        if (file_exists("{$path}/{$hodnota["databaze"]}{$dodatek}") &&
            is_file("{$path}/{$hodnota["databaze"]}{$dodatek}"))
        {
          //zmereni velikosti db souboru (nezavazne)
          $sum += filesize("{$path}/{$hodnota["databaze"]}{$dodatek}");
          $dbpoc++; //pocita databaze kdyz existujou a jsou to soubory
        }
        $modpoc++;  //pocita hlavni moduly
      }

      $errordnes = $this->PocetRadkuErrorLogu(); //spocitani erroru pro akualni den
      $errorvse = $this->PocetRadkuErrorLogu(false); //spocitani vsech erroru
      //datum pro error log
      $datum = date("d-m-Y"); //dnesni datum
      $errorlogfile = "errorlog-{$datum}.txt";
      $result = $this->NactiUnikatniObsah($this->unikatni["info_admin_uvod_text"],
                                          $modpoc,
                                          $dbpoc,
                                          count(get_included_files()),
                                          $this->Velikost(memory_get_peak_usage()),
                                          $this->Velikost(memory_get_peak_usage(true)),
                                          "'{$this->var->dirmodule}', true",
                                          $sum, //~velikost db
                                          "'{$this->zalohadbdir}', false",  //zaloha db
                                          "'{$this->zalohauniq}', false", //zaloha unikatnich
                                          "'{$this->errorlogdir}', false",  //error logy
                                          "'./', true", //cely layout
                                          "'styles', true", //styly
                                          "'script', true", //skrypty
                                          "'obr', true",  //obrazky
                                          "'{$this->var->souborymenu}', true",  //15
                                          "'{$this->dirweblog}', false", //16
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iderror}".(file_exists("{$this->errorlogdir}/{$errorlogfile}") ? "&amp;co=view&amp;date={$errorlogfile}" : ""),
                                          $errordnes, //18
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iderror}",
                                          $errorvse); //20
    }

    return $result;
  }

/**
 *
 * Zalohovani databazi
 * --urceno pro cron
 *
 * @param autodown pri true vybydne ke stazeni
 */
  public function CronZalohovaniDatabaze($autodown = false)
  {
    $datum = date("d-m-Y_H-i-s");
    $cil = "{$this->zalohadbdir}/zaloha_db_{$datum}.zip";

    $zip = new ZipArchive();
    if ($zip->open($cil, ZipArchive::CREATE) === true)
    {
      foreach ($this->var->moduly as $index => $hodnota)
      {
        if ($hodnota["admin"])  //pokud ma modul databazi
        {
          if (!Empty($hodnota["databaze"]))
          {
            $datum = date("d-m-Y_H-i-s"); //datum na casovou znacku do zipu
            $zip->addFromString("zaloha_{$hodnota["class"]}_{$datum}.sql",
                                $this->NactiFunkci("DynamicDatabase", "ZalohujDatabazi",
                                $index));
          }
        }
      }
      $zip->close();
    }

    if ($autodown)
    {
      $this->CronZalohovaniUnikatnich();  //zalohuje zaroven i unikatni

      header("Content-Description: File Transfer");
      header("Content-Type: application/force-download");
      header("Content-Disposition: attachment; filename=\"{$cil}\"");
      readfile($cil); //vybydne ke stazeni
    }
  }

/**
 *
 * Zalohovani unikatnich souboru a stylu
 * --urceno pro cron
 *
 */
  public function CronZalohovaniUnikatnich()
  {
    $datum = date("d-m-Y_H-i-s");
    $cil = "{$this->zalohauniq}/zaloha_uniq_{$datum}.zip";
    $zip = new ZipArchive();
    if ($zip->open($cil, ZipArchive::CREATE) === true)
    {
      foreach ($this->var->moduly as $index => $hodnota)
      {
        $path = dirname($hodnota["include"]);
        $jmeno = basename($hodnota["include"], ".php");
        //zaloha unkatnich
        $unikatni = ($index == 0 ? ".unikatni_funkce" : ".unikatni_obsah"); //rozliseni funkce
        $cesta = "{$path}/{$unikatni}.php"; //slozeni cesty
        if (file_exists($cesta))
        {
          $zip->addFile($cesta);  //pridani unikatnich do zipu
        }
        //zaloha duplikatnich
        $duplikatni = ($index == 0 ? ".{$this->dedicne}_funkce" : ".{$this->dedicne}_obsah"); //rozliseni funkce
        $cesta = "{$path}/{$duplikatni}.php"; //slozeni cesty
        if (file_exists($cesta))
        {
          $zip->addFile($cesta);  //pridani duplikatni do zipu
        }
        //zaloha korenovych stylu
        $styl = "{$path}/{$jmeno}.css";
        if (file_exists($styl))
        {
          $zip->addFile($styl);  //pridani css do zipu
        }
        //zaloha duplikatnich stylu
        $duplikatnistyl = "{$path}/{$this->dedicne}_{$jmeno}.css";
        if (file_exists($duplikatnistyl))
        {
          $zip->addFile($duplikatnistyl);  //pridani duplikatni css do zipu
        }
      }
      $zip->close();
    }
  }

/**
 *
 * Zkontroluje prebytecne zalohy databaze
 * --urceno pro cron
 *
 */
  public function CronKontolaZalohyDatabaze()
  {
    $expire = strtotime($this->unikatni["set_expire_dataadmin"]);

    if ($soubor = $this->VypisSouboru($this->zalohadbdir))
    {
      foreach ($soubor as $data)
      {
        if (filemtime("{$this->zalohadbdir}/{$data}") <= $expire)
        {
          @unlink("{$this->zalohadbdir}/{$data}"); //smaze starsi N dni
        }
      }
    }
  }

/**
 *
 * Zkontroluje prebytecne zalohy unikatnich
 * --urceno pro cron
 *
 */
  public function CronKontrolaUnikatnich()
  {
    $expire = strtotime($this->unikatni["set_expire_unikadmin"]);
    //vypis souboru
    if ($soubor = $this->VypisSouboru($this->zalohauniq))
    {
      foreach ($soubor as $data)
      {
        if (filemtime("{$this->zalohauniq}/{$data}") <= $expire)
        {
          @unlink("{$this->zalohauniq}/{$data}"); //smaze starsi N dni
        }
      }
    }
  }

/**
 *
 * Zkontroluje prebytecne error logy
 * --urceno pro cron
 *
 */
  public function CronKontrolaErrorLogu()
  {
    $expire = strtotime($this->unikatni["set_expire_erroadmin"]);
    //vypis souboru
    if ($soubor = $this->VypisSouboru($this->errorlogdir))
    {
      foreach ($soubor as $data)
      {
        if (filemtime("{$this->errorlogdir}/{$data}") <= $expire)
        {
          @unlink("{$this->errorlogdir}/{$data}"); //smaze starsi N dni
        }
      }
    }
  }

/**
 *
 * Zkontroluje prebytecne session logy po prihlasovani
 * --urceno pro cron
 *
 */
  public function CronKontrolaSessionLogu()
  { //maximalni casovy limit prihlaseni
    $expire = strtotime("-2 day");  //nastaveno natvrdo
    //vypis souboru
    if ($soubor = $this->VypisSouboru($this->dirsession))
    {
      foreach ($soubor as $data)
      {
        if (filemtime("{$this->dirsession}/{$data}") <= $expire)
        {
          @unlink("{$this->dirsession}/{$data}"); //smaze starsi N dni
        }
      }
    }

    //promazavani cache temat
    $themecesta = "{$this->dircache}/{$this->theme_cache}";
    if (file_exists($themecesta))
    { //pokud existuje smazat
      @unlink($themecesta);
      //nacachovani temat
      $this->AdminCacheTema();
    }
      else
    { //pokud ne tak vytvorit
      $this->AdminCacheTema();
    }
  }

/**
 *
 * Zkontroluje prebytecne action logy
 * --urceno pro cron
 *
 */
  public function CronKontrolaActionLogu()
  {
    $expire = strtotime($this->unikatni["set_expire_actionlog"]);
    //vypis souboru
    if ($soubor = $this->VypisSouboru($this->diractlog))
    {
      foreach ($soubor as $data)
      {
        if (filemtime("{$this->diractlog}/{$data}") <= $expire)
        {
          @unlink("{$this->diractlog}/{$data}"); //smaze starsi N dni
        }
      }
    }
  }

/**
 *
 * Vygeneruje cache pro grafy
 * --urceno pro cron
 *
 */
  public function CronGenerovaniCacheGrafu()
  {
    //statistiky za poslednich 30 dni
    $ret = "";
    for ($i = 0; $i < 30; $i++)
    {
      $den = date("Y-m-d", strtotime("-{$i} day"));
      //nadefinovani pripojeni
      $pole = array("uloziste" => "sqlite",
                    "class" => "Pocitadlo",
                    "include" => "pocitadlo.php",
                    "databaze" => "{$this->dirweblog}/.wlog{$den}.sqlite2");
      //overeni existence databaze
      if (file_exists($pole["databaze"]))
      {
        $this->dbpredpona = $this->NastavKomunikaci($this->var, $pole, NULL, "poc");
        if (!$this->PripojeniDatabaze($error))
        {
          $this->ErrorMsg($error, array(__LINE__, __METHOD__));
        }
        //vyber dat z databaze
        $ret[$den] = $this->VypisHodnotu("COUNT(id)", "weblog", 1, "");
      }
    }
    $this->dbpredpona = $this->NavratPripojeni(); //navrat id pro samotnou funkci i s predponou

    //nacteni souboru databazi
    $soubory = $this->VypisSouboru($this->dirweblog);
    if (is_array($soubory))
    {
      $pocet_run = count($soubory);
      //prochazeni databazemi
      foreach ($soubory as $databaze)
      {
        //nadefinovani pripojeni
        $pole = array("uloziste" => "sqlite",
                      "class" => "Pocitadlo",
                      "include" => "pocitadlo.php",
                      "databaze" => "{$this->dirweblog}/{$databaze}");
        //overeni existence databaze
        if (file_exists($pole["databaze"]))
        {
          $this->dbpredpona = $this->NastavKomunikaci($this->var, $pole, NULL, "poc");
          if (!$this->PripojeniDatabaze($error))
          {
            $this->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
          //ulozeni hodnot z db
          $cas = date("Y-m-d", filemtime($pole["databaze"]));
          $agent[$cas] = implode($this->permexplode, $this->VypisPolozky("agent", "weblog"));
          $ip[$cas] = implode($this->permexplode, $this->VypisPolozky("ip", "weblog"));
          $pristup[$cas] = implode($this->permexplode, $this->VypisPolozky("pristup", "weblog"));
        }
      }
      $this->dbpredpona = $this->NavratPripojeni(); //navrat id pro samotnou funkci i s predponou
    }

    //ulozeni do cachu
    $this->ControlConfig(array ("cachegraf" => array("self", "array", $ret),
                                "cacheagent" => array("self", "array", $agent),
                                "cacheip" => array("self", "array", $ip),
                                "cachedat" => array("self", "array", $pristup),
                                "pocrun" => array("self", "integer", $pocet_run)
                              ), true,
                        array("save|config", "{$this->dircache}/{$this->cachegraf}"));

//dodelat!! !!!!!!!!
//posilat dotaz pres post!!!!!! doacasne vypnuto!!!!

    //zpracovani dat z outside adminu

    //stahnuti xml
////spatne reseneeeeeee!!!!!!!!! nemuze tahat sam ze sebe!!!!
    if ($this->var->administrace != $this->absolutni_url)
    {
      $kod = base64_encode($this->ZakodujText($this->absolutni_url));
//dotazovat se na post!!!!!! dodelat!!!!!
      $getxml = $this->NactiUrl("{$this->var->administrace}?w={$kod}");
      //ulozeni xml do souboru
      if ($u = fopen("{$this->dircache}/{$this->cachexmloutside}", "w"))
      {
        fwrite($u, $getxml);
        fclose($u);
      }
    }
  }

/**
 *
 * Promazavani logu prihlasovani
 * --urceno pro cron
 *
 */
  public function CronAdminClearLog()
  {
    $expire = date("Y-m-d H:i:s", strtotime($this->unikatni["set_expire_logadmin"]));
    //projiti databaze
    if ($res = $this->queryMultiObjectSingle("SELECT id FROM {$this->dbpredpona}adminlog a
                                              WHERE
                                              datum<='{$expire}';"))
    {
      $id = "";
      foreach ($res as $data)
      {
        $id[] = $data->id;
      }

      if (!Empty($id) &&
          is_array($id))
      {
        $sloucene = implode(", ", $id);
        $this->queryExec("DELETE FROM {$this->dbpredpona}adminlog WHERE id IN ({$sloucene});"); //provedeni dotazu
      }
    }
  }

/**
 *
 * Zalogovani pristupu do adminu
 *
 */
  private function AdminAddLog($login, $wrongpass = "")
  {
    //prida automaticky log, pokud spatne heslo tak i heslo
    $sepkey = "||key||";
    $sepval = "||val||";
    $separr = "==>>";

    $cok_key = implode($sepkey, array_keys($_COOKIE));
    $cok_val = implode($sepval, array_values($_COOKIE));

    $get_key = implode($sepkey, array_keys($_GET));
    $get_val = implode($sepval, array_values($_GET));

    $pocip = $this->VypisPocetRadku("pocet", "adminlog", 1, "WHERE ip='{$_SERVER["REMOTE_ADDR"]}'");

    $this->ControlForm(array ("login" => array("self", "string", $login),
                              "wrongpass" => array("self", "string", $wrongpass),
                              "datum" => array("self", "date", "now"),
                              "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),
                              "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"]),
                              "pocet" => array("self", "integer", $pocip),
                              "language" => array("self", "string", $_SERVER["HTTP_ACCEPT_LANGUAGE"]),
                              "cookie" => array("self", "array", array($cok_key, $cok_val), $separr),
                              "get" => array("self", "array", array($get_key, $get_val), $separr)),
                      true,
                      array("insert", "adminlog", NULL));
  }

/**
 *
 * administrace logovani do adminu
 *
 * @return admin logu
 */
  private function AdminLog()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_log"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["clearlog"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idlistlog}&amp;co=clearlog" : ""),
                                        $this->VypisAdminLog());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "clearlog": //vyprazdneni logu
          if ($this->queryExec("DELETE FROM {$this->dbpredpona}adminlog;")) //provedeni dotazu
          {
            $result = $this->Hlaska("clear", "Promazání logů");
            $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idlistlog}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Statistiky admin logu
 *
 * @return grafy statistik
 */
  private function AdminStatLog()
  {
    $result = "";
    $pocet_pristupu = $this->querySingle("SELECT COUNT(login) FROM {$this->dbpredpona}adminlog;");

    //celkovy pocet pristupu
    if ($res = $this->queryMultiObjectSingle("SELECT datum, COUNT(login) pocet FROM {$this->dbpredpona}adminlog
                                              GROUP BY {$this->dateFormat("datum", "Y-m-d")}
                                              ORDER BY datum ASC;"))
    {
      $pocet_all = array();
      foreach ($res as $data)
      {
        $dat = strtotime($data->datum);
        $y = date("Y", $dat);
        $m = date("n", $dat) - 1;
        $d = date("j", $dat);
        $h = date("G", $dat);
        $i = date("i", $dat);
        settype($i, "integer");
        $s = date("s", $dat);
        settype($s, "integer");

        $pocet_all[] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$data->pocet}]";
      }
      $pocet_all = implode(", ", $pocet_all);
    }

    //pocet ip
    if ($ret = $this->queryMultiObjectSingle("SELECT ip, COUNT(ip) pocet FROM {$this->dbpredpona}adminlog GROUP BY ip ORDER BY COUNT(ip) DESC;"))
    {
      $pocet_ip = array();
      foreach ($ret as $data)
      {
        $pocet_ip[] = "['{$data->ip}', {$data->pocet}]";
      }
      $pocet_ip = implode(", ", $pocet_ip);
    }

    //pocty prohlizecu
    if ($pole = $this->queryMultiArraySingle("SELECT agent FROM {$this->dbpredpona}adminlog;"))
    {
      foreach ($pole as $radek) //zpracovani prohlizecu
      {
        $agent = array_values($radek);  //vybrani hodnot
        $browser[] = $this->TypSystemu($agent[0])->browser;
        //$browser[] = $this->TypBrowseru($agent[0]);
      }

      $pocty = array_count_values($browser);  //spocitani hodnot
      arsort($pocty); //serazeni podle hodnoty reverzivne

      $pocet_brow = array();
      foreach ($pocty as $index => $radek) //generovani radku
      {
        $pocet_brow[] = "['{$index}', {$radek}]";
      }
      $pocet_brow = implode(", ", $pocet_brow);
    }

    //pocty os
    if ($pole = $this->queryMultiArraySingle("SELECT agent FROM {$this->dbpredpona}adminlog;"))
    {
      foreach ($pole as $radek) //zpracovani prohlizecu
      {
        $agent = array_values($radek);  //vybrani hodnot
        $os[] = $this->TypSystemu($agent[0])->os;
        //$os[] = $this->TypOS($agent[0]);
      }

      $pocty = array_count_values($os);  //spocitani hodnot
      arsort($pocty); //serazeni podle hodnoty reverzivne

      $pocet_os = array();
      foreach ($pocty as $index => $radek) //generovani radku
      {
        $pocet_os[] = "['{$index}', {$radek}]";
      }
      $pocet_os = implode(", ", $pocet_os);
    }

    //pocet pristupu daneho loginu
    if ($ret = $this->queryMultiObjectSingle("SELECT login, COUNT(login) pocet, {$this->dateFormat("datum", "Y-m-d")} datum
                                              FROM {$this->dbpredpona}adminlog
                                              WHERE wrongpass=''
                                              GROUP BY {$this->dateFormat("datum", "Y-m-d")}, login
                                              ORDER BY datum ASC;"))
    {
      $pocet_login = array();
      $datumy = array();
      foreach ($ret as $data)
      { //zpracovani dat
        $dat = strtotime($data->datum);
        $y = date("Y", $dat);
        $m = date("n", $dat) - 1;
        $d = date("j", $dat);
        $h = date("G", $dat);
        $i = date("i", $dat);
        settype($i, "integer");
        $s = date("s", $dat);
        settype($s, "integer");

        $pocet_login[$data->login][] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$data->pocet}]";
        $datumy[] = $data->datum;
      }

      $sub = array();
      //zpracovani serii
      foreach ($pocet_login as $index => $polozka)
      {
        $impl = implode(", ", $polozka);
        $sub[] = "{data: [{$impl}], name: '{$index}',}";
      }
      $pocet_login = implode(",\n", $sub);
    }
//dodelat?! toto zavani cachovanim!!
    //pocet pristupu os & brow
    if ($ret = $this->queryMultiObjectSingle("SELECT agent, {$this->dateFormat("datum", "Y-m-d")} datum
                                              FROM {$this->dbpredpona}adminlog
                                              ORDER BY datum ASC;"))
    {
      //sber dat
      $os_array = array();
      $brow_array = array();
      foreach ($ret as $data)
      {
        $sys = $this->TypSystemu($data->agent);
        $os_array[$data->datum][] = $sys->os;
        $brow_array[$data->datum][] = $sys->browser;
        //$os_array[$data->datum][] = $this->TypOS($data->agent);
        //$brow_array[$data->datum][] = $this->TypBrowseru($data->agent);
      }

      $pocet_datum_os = array();
      //zpracovani os
      foreach ($os_array as $datum => $os)
      {
        $dat = strtotime($datum);
        $y = date("Y", $dat);
        $m = date("n", $dat) - 1;
        $d = date("j", $dat);
        $h = date("G", $dat);
        $i = date("i", $dat);
        settype($i, "integer");
        $s = date("s", $dat);
        settype($s, "integer");

        //zpracovani poctu os
        foreach (array_count_values($os) as $polozka => $pocet)
        {
          $pocet_datum_os[$polozka][] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$pocet}]";
        }
      }

      $pocet_datum_brow = array();
      //zpracovani brows
      foreach ($brow_array as $datum => $brow)
      {
        $dat = strtotime($datum);
        $y = date("Y", $dat);
        $m = date("n", $dat) - 1;
        $d = date("j", $dat);
        $h = date("G", $dat);
        $i = date("i", $dat);
        settype($i, "integer");
        $s = date("s", $dat);
        settype($s, "integer");

        //zpracovani poctu brow
        foreach (array_count_values($brow) as $polozka => $pocet)
        {
          $pocet_datum_brow[$polozka][] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$pocet}]";
        }
      }

      $sub = array();
      //zpracovani serii os
      foreach ($pocet_datum_os as $os => $polozka)
      {
        $impl = implode(", ", $polozka);
        $sub[] = "{data: [{$impl}], name: '{$os}',}";
      }
      $pocet_datum_os = implode(",\n", $sub);

      $sub = array();
      //zpracovani serii brow
      foreach ($pocet_datum_brow as $brow => $polozka)
      {
        $impl = implode(", ", $polozka);
        $sub[] = "{data: [{$impl}], name: '{$brow}',}";
      }
      $pocet_datum_brow = implode(",\n", $sub);
    }
//dodelat?! // toto zavani cachovanim!!
    //login (ip) => pocet
    if ($ret = $this->queryMultiObjectSingle("SELECT login, COUNT(login) pocet, ip FROM {$this->dbpredpona}adminlog
                                              WHERE wrongpass=''
                                              GROUP BY login, ip
                                              ORDER BY LOWER(login) ASC;"))
    {
      $pocet_login_ip = array();
      foreach ($ret as $data)
      {
        $pocet_login_ip[] = $this->NactiUnikatniObsah($this->unikatni["admin_statlog_pocet_login_ip"],
                                                      $data->login,
                                                      $data->ip,
                                                      $data->pocet);
      }
      $pocet_login_ip = implode(", ", $pocet_login_ip);
    }

    //os (brow) => pocet
    if ($ret = $this->queryMultiObjectSingle("SELECT agent FROM {$this->dbpredpona}adminlog;"))
    {
      //sesbirani agentu
      $agent = "";
      foreach ($ret as $data)
      {
        $agent[] = $data->agent;
      }

      $ret = $this->AlgPoctyOsProhlizecu($agent);  //zpracovani agentu
      $pocet_os_brow = array();
      foreach ($ret as $hodnota)
      {
        $pocet_os_brow[] = $this->NactiUnikatniObsah($this->unikatni["admin_statlog_pocet_os_brow"],
                                                    $hodnota["os"],
                                                    $hodnota["brow"],
                                                    $hodnota["count"]);
      }
      $pocet_os_brow = implode(", ", $pocet_os_brow);
    }

    //login (os, brow) => pocet
    if ($ret = $this->queryMultiObjectSingle("SELECT login, agent, COUNT(agent) pocet FROM {$this->dbpredpona}adminlog
                                              WHERE wrongpass=''
                                              GROUP BY agent, login
                                              ORDER BY LOWER(login) ASC;"))
    {
      $pocet_login_os = array();
      foreach ($ret as $data)
      {
        $os = $this->TypOS($data->agent);
        $browser = $this->TypBrowseru($data->agent);
        //$sys = $this->TypSystemu($data->agent);
        $pocet_login_os[] = $this->NactiUnikatniObsah($this->unikatni["admin_statlog_pocet_login_os"],
                                                      $data->login,
                                                      $sys->os,
                                                      $sys->browser,
                                                      $data->pocet);
      }
      $pocet_login_os = implode(", ", $pocet_login_os);
    }

    //login (os, brow) => pocet
    if ($ret = $this->queryMultiObjectSingle("SELECT login, agent, COUNT(agent) pocet, ip FROM {$this->dbpredpona}adminlog
                                              WHERE wrongpass=''
                                              GROUP BY agent, login, ip
                                              ORDER BY LOWER(login) ASC;"))
    {
      $pocet_login_ip_os = array();
      foreach ($ret as $data)
      {
        //$os = $this->TypOS($data->agent);
        //$browser = $this->TypBrowseru($data->agent);
        $sys = $this->TypSystemu($data->agent);
        $pocet_login_ip_os[] = $this->NactiUnikatniObsah($this->unikatni["admin_statlog_pocet_login_ip_os"],
                                                        $data->login,
                                                        $data->ip,
                                                        $sys->os,
                                                        $sys->browser,
                                                        $data->pocet);
      }
      $pocet_login_ip_os = implode(", ", $pocet_login_ip_os);
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_statlog"],
                                        $this->var->highcharts,
                                        $pocet_pristupu,
                                        $pocet_all,
                                        $pocet_ip,
                                        $pocet_brow,  //5
                                        $pocet_os,
                                        $pocet_login,
                                        $pocet_datum_os,
                                        $pocet_datum_brow,
                                        $pocet_login_ip,  //v unikatnich←↓
                                        $pocet_os_brow,
                                        $pocet_login_os,
                                        $pocet_login_ip_os);

    return $result;
  }

/**
 *
 * Vypis admin logu
 *
 * @return vypis
 */
  private function VypisAdminLog()
  {
    $tvar_datum = $this->unikatni["vypis_log_tvar_datum"];  //nacteni tvaru data
    $sekceipban = "{$this->idmodul}{$this->idipban}";
    $row = array();
    if ($res = $this->queryMultiObjectSingle("SELECT id, login, wrongpass, datum, ip, agent, pocet, language, cookie, get FROM {$this->dbpredpona}adminlog ORDER BY adminlog.datum DESC;"))
    {
      foreach ($res as $data)
      {
        $sys = $this->TypSystemu($data->agent);
        $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_log_row"],
                                          $data->id,
                                          $data->login,
                                          (!Empty($data->wrongpass) ?$this->NactiUnikatniObsah($this->unikatni["admin_vypis_log_pass"], $data->wrongpass) : ""), //pridavat a href!!
                                          (Empty($data->wrongpass) ? " checked=\"checked\"" : ""),  //true=admin
                                          (Empty($data->wrongpass) ? $this->unikatni["admin_log_acc_true"] : $this->unikatni["admin_log_acc_false"]),  //true=admin
                                          date($tvar_datum, strtotime($data->datum)),
                                          $data->ip,
                                          $sys->os,
                                          $sys->browser,
                                          $data->pocet,
                                          $data->language,
                                          $data->cookie,
                                          $data->get,
                                          ($this->localpermit[$sekceipban]["addip"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$sekceipban}&amp;co=addip&amp;ip={$data->ip}&amp;ret={$this->idmodul}{$this->idlistlog}" : ""));
      }
    }
      else
    {
      $row[] = $this->unikatni["admin_vypis_log_null"];
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_log"],
                                        $this->VypisAdminLogIp(),
                                        implode("", $row));  //vlezeni vypisu do hlavniho vypisu

    return $result;
  }

/**
 *
 * Skupinovy vypis ip adres
 *
 * @return skupina ip
 */
  private function VypisAdminLogIp()
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT ip, COUNT(ip) pocet FROM {$this->dbpredpona}adminlog GROUP BY ip ORDER BY COUNT(ip) ASC;"))
    {
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_log_ip"],
                                            $data->ip,
                                            $data->pocet);
      }
    }

    return $result;
  }

/**
 *
 * Rozcestnik mezi dnesnima a vsema statistikama
 *
 * @return rozcestnik
 */
  private function AdminWebLog()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_web_log"],
                                        ($this->OverovaniManualPermission(NULL, "{$this->idmodul}{$this->idusercurlog}", "") ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idusercurlog}" : ""),
                                        ($this->OverovaniManualPermission(NULL, "{$this->idmodul}{$this->iduseralllog}", "") ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iduseralllog}" : ""));

    return $result;
  }

/**
 *
 * Vypis logovani stranek v grafech za aktualni den
 *
 * @return vypis statistik v grafech
 */
  private function AdminWebLogDay()
  {
    //nadefinovani pripojeni pro posledni den
    $den = date("Y-m-d");
    $pole = array("uloziste" => "sqlite",
                  "class" => "Pocitadlo",
                  "include" => "pocitadlo.php",
                  "databaze" => "{$this->dirweblog}/.wlog{$den}.sqlite2");
    //overeni existence databaze
    $lastip = array();
    $lastagent = array();
    $lastdat = array();
    if (file_exists($pole["databaze"]))
    {
      $this->dbpredpona = $this->NastavKomunikaci($this->var, $pole, NULL, "poc");
      if (!$this->PripojeniDatabaze($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      //nacteni pole
      $curday_agent = $this->VypisPolozky("agent", "weblog");
      $curday_ip = $this->VypisPolozky("ip", "weblog");
      $curday_dat = $this->VypisPolozky("pristup", "weblog");
      //slouceni pole hodnot
      $lastip = array_combine($curday_dat, $curday_ip);
      $lastagent = array_combine($curday_dat, $curday_agent);
      $lastdat = array_combine($curday_dat, $curday_dat);
      //pocet pristupu za den
      $last_day_sum = count($lastdat);

      $this->dbpredpona = $this->NavratPripojeni(); //navrat id pro samotnou funkci i s predponou

      //vypocty pristupu za posledni den
      $datpoc = array();
      $ospoc = array();
      $browpoc = "";
      $datospoc = "";
      $datbrowpoc = "";
      $datippoc = "";
      $last_day_os = array();
      $last_day_brow = array();
      $last_day_dat_os = array();
      $last_day_dat_brow = array();
      $last_day_dat_pristup = array();
      $last_day_dat_ip = array();
      //projiti a zpracovani dat
      foreach ($lastagent as $intexag => $ag)
      {
        //zpracovani aktualniho casu
        $idate = strtotime($lastdat[$intexag]);
        $y = date("Y", $idate);
        $m = date("n", $idate) - 1;
        $d = date("j", $idate);
        $h = date("G", $idate);
        $i = date("i", $idate);
        settype($i, "integer");
        $s = date("s", $idate);
        settype($s, "integer");

        $sys = $this->TypSystemu($ag);
        $typos = $sys->os;
        $typbrow = $sys->browser;
        //$typos = $this->TypOS($ag);
        //$typbrow = $this->TypBrowseru($ag);

        //pocitani proistupi v cas
        $index_dat_pristup = "{$y}-{$m}-{$d} {$h}"; //indez pro s presnosti hodiny
        if (Empty($datpoc[$index_dat_pristup]))
        {
          $datpoc[$index_dat_pristup] = 0;
        }
        $datpoc[$index_dat_pristup]++;
        $last_day_dat_pristup[$index_dat_pristup] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$datpoc[$index_dat_pristup]}]";

        //celkovy pocet os a brow
        if (Empty($ospoc[$typos]))
        {
          $ospoc[$typos] = 0;
        }
        $ospoc[$typos]++; //pocitadlo os
        $last_day_os[$typos] = "['{$typos}', {$ospoc[$typos]}]";

        if (Empty($browpoc[$typbrow]))
        {
          $browpoc[$typbrow] = 0;
        }
        $browpoc[$typbrow]++; //pocitadlo brow
        $last_day_brow[$typbrow] = "['{$typbrow}', {$browpoc[$typbrow]}]";

        //pocitani pristupu os a brow v cas
        if (Empty($datospoc[$typos]))
        {
          $datospoc[$typos] = "";
          $datospoc[$typos][$index_dat_pristup] = 0;
        }
        $datospoc[$typos][$index_dat_pristup]++;  //pocitadlo os
        $last_day_dat_os[$typos][$index_dat_pristup] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$datospoc[$typos][$index_dat_pristup]}]";

        if (Empty($datbrowpoc[$typbrow]))
        {
          $datbrowpoc[$typbrow] = "";
          $datbrowpoc[$typbrow][$index_dat_pristup] = 0;
        }
        $datbrowpoc[$typbrow][$index_dat_pristup]++;  //pocitadlo brow
        $last_day_dat_brow[$typbrow][$index_dat_pristup] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$datbrowpoc[$typbrow][$index_dat_pristup]}]";
        //pocitani pristupu ip
        $ip = $lastip[$intexag];
        if (Empty($datippoc[$ip]))
        {
          $datippoc[$ip] = "";
        }
        if (Empty($datippoc[$ip][$index_dat_pristup]))
        {
          $datippoc[$ip][$index_dat_pristup] = "";
        }
        $datippoc[$ip][$index_dat_pristup]++;
        $last_day_dat_ip[$ip][$index_dat_pristup] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$datippoc[$ip][$index_dat_pristup]}]";
      }
      //dnes os(all)=>pocet
      $last_day_os = implode(", ", $last_day_os);
      //dnes brow(all)=>pocet
      $last_day_brow = implode(", ", $last_day_brow);

      //pocet vsech ip za den
      $last_day_ip = array();
      foreach (array_count_values($lastip) as $indexip => $pocet)
      {
        $last_day_ip[] = "['{$indexip}', {$pocet}]";
      }
      $last_day_ip = implode(", ", $last_day_ip);

      //dnes os(cas)=>pocet
      $sub = array();
      foreach ($last_day_dat_os as $os => $polozka)
      {
        $impl = implode(", ", $polozka);
        $sub[] = "{data: [{$impl}], name: '{$os}',}";
      }
      $last_day_dat_os = implode(",\n", $sub);

      //dnes brow(cas)=>pocet
      $sub = array();
      foreach ($last_day_dat_brow as $brow => $polozka)
      {
        $impl = implode(", ", $polozka);
        $sub[] = "{data: [{$impl}], name: '{$brow}',}";
      }
      $last_day_dat_brow = implode(",\n", $sub);

      //dnes ip(cas)=>pocet
      $sub = array();
      foreach ($last_day_dat_ip as $ip => $polozka)
      {
        $impl = implode(", ", $polozka);
        $sub[] = "{data: [{$impl}], name: '{$ip}',}";
      }
      $last_day_dat_ip = implode(",\n", $sub);

      //pristup za den cas(hodiny)=>pristup
      $last_day_dat_pristup = implode(", ", $last_day_dat_pristup);

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_web_log_day"],
                                          $this->var->highcharts,
                                          $last_day_sum,
                                          $last_day_dat_pristup,
                                          $last_day_ip,
                                          $last_day_os, //5
                                          $last_day_brow,
                                          $last_day_dat_os,
                                          $last_day_dat_brow,
                                          $last_day_dat_ip);
    }
      else
    {
      $result = $this->unikatni["admin_web_log_day_wait"];
    }

    return $result;
  }

/**
 *
 * Vypis logovani stranek v grafech za vsechny dny
 *
 * @return vypis statistik v grafech
 */
  private function AdminWebLogAll()
  {
    $result = "";
    $res = $this->ControlConfig(array("cacheagent", "cacheip", "cachedat", "pocrun"), true,
                                array("load|config", "{$this->dircache}/{$this->cachegraf}"));

    //zpracovani dat
    if (!Empty($res) &&
        is_array($res->cacheagent))
    {
      $pristup_sum = 0;
      $pocet_pristup = array();
      $allip = array();
      $alldate = array();
      $allagent = array();
      //seskladani pole nazpet z cahovaneho pole
      foreach ($res->cacheagent as $index => $klic)
      {
        //rozdeleni dat do sub-array
        $agent_val = explode($this->permexplode, $klic);  //$res->agentval[$index]
        $ip_val = explode($this->permexplode, $res->cacheip[$index]);
        $dat_val = explode($this->permexplode, $res->cachedat[$index]);

        $agent[$index] = $agent_val;
        $ip[$index] = $ip_val;
        $dat[$index] = $dat_val;

        $allip = array_merge($allip, $ip_val);
        $alldate = array_merge($alldate, $dat_val);
        $allagent = array_merge($allagent, $agent_val);

        //predbezne zpracovani dat
        $count_ip_val = count($ip_val);
        //scitani celkoveho poctu pristupu
        $pristup_sum += $count_ip_val;

        $idate = strtotime($index);
        $y = date("Y", $idate);
        $m = date("n", $idate) - 1;
        $d = date("j", $idate);
        $h = date("G", $idate);
        $i = date("i", $idate);
        settype($i, "integer");
        $s = date("s", $idate);
        settype($s, "integer");
        $pocet_pristup[] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$count_ip_val}]";
      }
      $pocet_pristup = implode(", ", $pocet_pristup);

      //pocet vsech ip
      $pocet_allip = array();
      foreach (array_count_values($allip) as $indexip => $pocet)
      {
        $pocet_allip[] = "['{$indexip}', {$pocet}]";
      }
      $pocet_allip = implode(", ", $pocet_allip);
      //pocet vsech os a brow
      $pocet_allos = array();
      $pocet_allbrow = array();
      $pocet_day_os = array();
      $pocet_day_brow = array();
      $pocet_day_ip = array();
      $allos = "";
      $allbrow = "";
      $pocdayos = "";
      $pocdaybrow = "";
      foreach ($allagent as $indexpolozka => $polozka)
      {
        $sys = $this->TypSystemu($polozka);
        //$os = $this->TypOS($polozka); //nacitani os
        $os = $sys->os;
        if (Empty($allos[$os]))
        {
          $allos[$os] = 0;
        }
        $allos[$os]++;  //pocitani os
        $pocet_allos[$os] = "['{$os}', {$allos[$os]}]";
        //$brow = $this->TypBrowseru($polozka); //nacitani brow
        $brow = $sys->browser;
        if (Empty($allbrow[$brow]))
        {
          $allbrow[$brow] = 0;
        }
        $allbrow[$brow]++;  //pocitani brow
        $pocet_allbrow[$os] = "['{$brow}', {$allbrow[$brow]}]";

        //zpracovani casu
        $idate = strtotime($alldate[$indexpolozka]);
        $y = date("Y", $idate);
        $m = date("n", $idate) - 1;
        $d = date("j", $idate);
        $h = date("G", $idate);
        $i = date("i", $idate);
        settype($i, "integer");
        $s = date("s", $idate);
        settype($s, "integer");

        $index_datum = "{$y}-{$m}-{$d}"; //presnost na den
        if (Empty($pocdayos[$os]))
        {
          $pocdayos[$os] = "";
        }
        if (Empty($pocdayos[$os][$index_datum]))
        {
          $pocdayos[$os][$index_datum] = 0;
        }
        $pocdayos[$os][$index_datum]++; //pocitani os
        $pocet_day_os[$os][$index_datum] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$pocdayos[$os][$index_datum]}]";
        if (Empty($pocdaybrow[$brow]))
        {
          $pocdaybrow[$brow] = "";
        }
        if (Empty($pocdaybrow[$brow][$index_datum]))
        {
          $pocdaybrow[$brow][$index_datum] = 0;
        }
        $pocdaybrow[$brow][$index_datum]++; //pocitani brow
        $pocet_day_brow[$brow][$index_datum] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$pocdaybrow[$brow][$index_datum]}]";

        //pocitani pristupu ip
        $ip = $allip[$indexpolozka];
        if (Empty($datippoc[$ip]))
        {
          $datippoc[$ip] = "";
        }
        if (Empty($datippoc[$ip][$index_datum]))
        {
          $datippoc[$ip][$index_datum] = 0;
        }
        $datippoc[$ip][$index_datum]++;
        $pocet_day_ip[$ip][$index_datum] = "[Date.UTC({$y}, {$m}, {$d}, {$h}, {$i}, {$s}), {$datippoc[$ip][$index_datum]}]";
      }
      $pocet_allos = implode(", ", $pocet_allos);
      $pocet_allbrow = implode(", ", $pocet_allbrow);

      //all os(den)=>pocet
      $sub = array();
      foreach ($pocet_day_os as $os => $polozka)
      {
        $impl = implode(", ", $polozka);
        $sub[] = "{data: [{$impl}], name: '{$os}',}";
      }
      $pocet_day_os = implode(",\n", $sub);

      //all brow(den)=>pocet
      $sub = array();
      foreach ($pocet_day_brow as $brow => $polozka)
      {
        $impl = implode(", ", $polozka);
        $sub[] = "{data: [{$impl}], name: '{$brow}',}";
      }
      $pocet_day_brow = implode(",\n", $sub);

      //all ip(den)=>pocet
      $sub = array();
      foreach ($pocet_day_ip as $ip => $polozka)
      {
        $impl = implode(", ", $polozka);
        $sub[] = "{data: [{$impl}], name: '{$ip}',}";
      }
      $pocet_day_ip = implode(",\n", $sub);

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_web_log_all"],
                                          $this->var->highcharts,
                                          "{$res->pocrun} {$this->VysloveniDne($res->pocrun)}", //2
                                          $pristup_sum,
                                          $pocet_pristup, //4
                                          $pocet_allip, //5
                                          $pocet_allos,
                                          $pocet_allbrow,
                                          $pocet_day_os,
                                          $pocet_day_brow,  //9
                                          $pocet_day_ip,  //10
                                          "?? ip (os)[pie] z jake ip jaky os [do budoucna i rozliseni]",
                                          "?? ip (brow)[pie] z jake ip jaky brow",
                                          "?? os(bwow)[pie]");
    }
      else
    {
      $result = $this->unikatni["admin_web_log_all_wait"];
    }

    return $result;
  }

/**
 *
 * Uzivatelske pocitani pristupu
 *
 */
  private function AdminAddWebLog()
  {
    //zapis statistik jen mino admin
    if (!$this->var->aktivniadmin)  //$_GET[$this->var->get_kam] != $this->var->adresaadminu
    {
      $dnes = date("Y-m-d");  //dnesni datum
      //nadefinovani pripojeni
      $pole = array("uloziste" => "sqlite",
                    "class" => "Pocitadlo",
                    "include" => "pocitadlo.php",
                    "databaze" => "{$this->dirweblog}/.wlog{$dnes}.sqlite2");
      //pokud existuje slozka, jinak se musi regenerovat js
      if (file_exists($this->dirweblog))
      {
        $this->dbpredpona = $this->NastavKomunikaci($this->var, $pole, NULL, "poc");
        if (!$this->PripojeniDatabaze($error))
        {
          $this->ErrorMsg($error, array(__LINE__, __METHOD__));
        }

        //instalace databaze
        if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}weblog (
                                        id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                        agent VARCHAR(300),
                                        ip VARCHAR(50),
                                        pristup DATETIME,
                                        language VARCHAR(100),
                                        session VARCHAR(100));
                                      ", $error, true))
        {
          $this->ErrorMsg($error, array(__LINE__, __METHOD__));
        }

        $session = $this->GetSessionId();
        //pridani unikatniho zaznamu
        $this->ControlForm(array ("agent" => array("self", "string", $this->NotEmpty("server", "HTTP_USER_AGENT")), //$_SERVER["HTTP_USER_AGENT"]
                                  "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),  //$_SERVER["REMOTE_ADDR"]
                                  "pristup" => array("self", "date", $_SERVER["REQUEST_TIME"]),
                                  "language" => array("self", "string", $this->NotEmpty("server", "HTTP_ACCEPT_LANGUAGE")),
                                  "session" => array("self", "string", $session)),
                          ($this->DuplikatniHodnota("agent", "weblog", $this->NotEmpty("server", "HTTP_USER_AGENT")) && $this->DuplikatniHodnota("session", "weblog", $session)), //kontrola unikatnosti agentu && session
                          array("insert", "weblog", NULL));

        $this->dbpredpona = $this->NavratPripojeni(); //navrat id pro samotnou funkci i s predponou
      }
        else
      {
        var_dump("nutny install");
      }
    }
  }

/**
 *
 * Admin vypis logovanych akci
 *
 * @return vypis zalogovanych akci
 */
  private function AdminActionLog()
  {
    $result = $this->unikatni["admin_action_log"];

    $datum = "";
    $co = $this->NotEmpty("get", "co");
    //prepisuje datum dle getu
    switch ($co)
    {
      case "show":
        //generovani pole uzivatelu, musi se nacitat mimo
        if ($res = $this->queryMultiObjectSingle("SELECT id, login, jmeno FROM {$this->dbpredpona}useradmin"))
        {
          foreach ($res as $data)
          {
            $user_array["login"][$data->id] = $this->DekodujText($data->login);
            $user_array["jmeno"][$data->id] = $this->DekodujText($data->jmeno);
          }
        }

        $datum = (!Empty($_GET["log"]) ? $_GET["log"] : "");
      break;
    }

    //nadefinovani pripojeni
    $pole = array("uloziste" => "sqlite",
                  "class" => "Pocitadlo",
                  "include" => "pocitadlo.php",
                  "databaze" => "{$this->diractlog}/.alog{$datum}.sqlite2");

    $uzivatel = array();
    if (file_exists($pole["databaze"]))
    {
      $this->dbpredpona = $this->NastavKomunikaci($this->var, $pole, NULL, "act");
      if (!$this->PripojeniDatabaze($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $tvar_datum = $this->unikatni["admin_action_log_tvar_datum"]; //tvar data pro vypis akci
      $val_sep = $this->unikatni["admin_action_log_val_sep"]; //oddelovac multihodnot
      $akce = $this->unikatni["admin_action_log_akce"]; //pole akci dle "co"
      //nacitani id uzivatele
      $user = $this->NotEmpty("get", "user");
      settype($user, "integer");

      //vyber dat z databaze
      $action = array();
      if ($res = $this->queryMultiObjectSingle("SELECT id, user, idmodul, co, hodnota, agent, ip, datum, metoda
                                                FROM {$this->dbpredpona}actlog a
                                                WHERE user={$user}
                                                ORDER BY a.datum DESC;"))
      {
        $permission = "";
        $konvert = array();
        //prochazeni modulu, jen kdyz je az vybrany uzivatel
        foreach ($this->var->main as $index => $modul)
        { //nacteni prav z modulu
          $permission[$this->var->moduly[$index]["class"]] = $modul->permit;
          //method_exists() nebo property_exists()
          if (is_array($modul->convmeth))
          { //nacitani konvertu kvuli ajaxu
            $konvert = array_merge($konvert, $modul->convmeth);
          }
        }
        //rozsireni pole nazvu o nazvy ktere moduly nemumi
        $permission = array_merge_recursive($permission, $akce);
        //priprava konertu, kvuli ajaxu
        $konvert_key = array_keys($konvert);
        $konvert_val = array_values($konvert);
//print_r($permission);
        //vypis samotnych logu
        foreach ($res as $data)
        {
          $sys = $this->TypSystemu($data->agent);
          //$os = $this->TypOs($data->agent);
          //$brow = $this->TypBrowseru($data->agent);
          //slucovani dvojhodnot
          $hodn = implode($val_sep, explode($this->permexplode, $data->hodnota));
          //parsnuti metody
          $metoda = explode("::", $data->metoda);
          //prepis konvertu s metodou
          $method = str_replace($konvert_key, $konvert_val, $metoda[0]);
          //generovani pole radku
          $action[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_action_log"],
                                                $data->id,
                                                $method,  //adresovani akce z permission
                                                $data->idmodul,
                                                $data->co,
                                                $permission[$method][$data->idmodul][$data->co],
                                                $hodn,
                                                $sys->os,
                                                $sys->browser,
                                                $data->ip,
                                                date($tvar_datum, strtotime($data->datum)));
        }
      }

      //vypis dostupnych uzivatelu
      if ($res = $this->queryMultiObjectSingle("SELECT user, COUNT(user) pocet
                                                FROM {$this->dbpredpona}actlog
                                                GROUP BY user;"))
      {
        foreach ($res as $data)
        {
          //podminka aktivni polozky
          $podm = ($user == $data->user);
          //+slucovani akci
          $uzivatel[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_action_log_user"],
                                                  ($this->localpermit[$_GET[$this->var->get_idmodul]]["show"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idactlog}&amp;co=show&amp;log={$datum}".(!$podm ? "&amp;user={$data->user}" : "") : ""),
                                                  $user_array["login"][$data->user],
                                                  $user_array["jmeno"][$data->user],
                                                  $data->pocet,
                                                  ($podm ? $this->unikatni["admin_vypis_action_log_user_aktivni"] : ""),
                                                  ($podm ? implode("", $action) : ""));
        }
      }

      $this->dbpredpona = $this->NavratPripojeni(); //navrat id pro samotnou funkci i s predponou
    }
      else
    {
      if (!file_exists($this->diractlog))
      {
        var_dump("nutny install");
      }
    }

    //vypis dostupnych logu akci
    $tvar_datum = $this->unikatni["admin_vypis_seznam_action_log_datum"];
    //nacitani obsahu slozky + serazeni dle data
    $ret = array();
    $soubory = $this->VypisSouboru($this->diractlog, array("date", "desc"));
    if (is_array($soubory))
    {
      foreach ($soubory as $polozka)
      {
        $mtime = filemtime("{$this->diractlog}/{$polozka}");  //nacteni casu
        $dat = date("Y-m-d", $mtime);
        $podm = ($datum == $dat);
        $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_seznam_action_log"],
                                          ($this->localpermit[$_GET[$this->var->get_idmodul]]["show"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idactlog}".(!$podm ? "&amp;co=show&amp;log={$dat}" : "") : ""),
                                          date($tvar_datum, $mtime),
                                          ($podm ? $this->unikatni["admin_vypis_seznam_action_log_aktivni"] : ""),
                                          ($podm ? implode("", $uzivatel) : ""));
      }
      //slucovani vypisu dostupnych logu
      $result .= implode("", $ret);
    }
      else
    {
      $result .= $this->unikatni["admin_action_log_null"];
    }

    return $result;
  }

/**
 *
 * Overuje zda-li neni admin uzivatel blokovan
 * Aplikovany na prihlasovani a prochazeni po strankach
 *
 * @param vstup vstupni pole array("self/session", $login, true/false[defaultne false])
 * @return povoli/nepovoli pristup
 */
  private function OverovaniBanIp($vstup)
  {
    $result = true; //zakladni stav=true
    $ip = $_SERVER["REMOTE_ADDR"];  //nacteni ip

    $crypt = (!Empty($vstup[2]) ? $vstup[2] : ""); //loginy se primo nacryptuji
    settype($crypt, "boolean"); //natypovani crypt, defaultne false
    switch ($vstup[0])
    {
      case "self":  //vlastni hodnota
        $login = ($crypt ? md5(md5($vstup[1])) : $vstup[1]);
      break;

      case "session": //hodnota z session
        $logid = $this->GetSessionUser(); //nacteni
        $login = $logid[0];
      break;
    }

    if ($res = $this->queryMultiObjectSingle("SELECT typ, login, ip FROM {$this->dbpredpona}ipban WHERE aktivni=1;"))
    {
      foreach ($res as $data)
      {
        switch ($data->typ) //rozliseni typu a aplikace banu
        {
          case "banip": //ban na ip
            $result = ($ip == $data->ip ? false : $result);
          break;

          case "banlog":  //ban na login
            $log = md5(md5($data->login));
            $result = ($login == $log ? false : $result);
          break;

          case "banlogip":  //ban na login && ip
            $log = md5(md5($data->login));
            $result = ($login == $log && $ip == $data->ip ? false : $result);
          break;

          case "banlogorip":  //ban na login || ip
            $log = md5(md5($data->login));
            $result = ($login == $log || $ip == $data->ip ? false : $result);
          break;

          case "fullbanip": //ban stranek podle ip
            if ($ip == $data->ip)
            {
              echo $this->NactiUnikatniObsah($this->unikatni["admin_full_ban_info"],
                                            $ip);

              exit(0);  //zatrhne nacteni stranek
            }
          break;
        }
      }
    }

    return $result;
  }

/**
 *
 * Vrati select pro vyber z typu banu
 *
 * @param id id polozky vstupu, nepovinne
 * @return html select
 */
  private function VyberBanTypu($id = NULL)
  {
    $result = $this->unikatni["admin_ban_typ_select_begin"];
    foreach ($this->bantyp as $index => $hodnota)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_ban_typ_select"],
                                          $index,
                                          ($id == $index ? " selected=\"selected\"" : ""),
                                          $hodnota);
    }
    $result .= $this->unikatni["admin_ban_typ_select_end"];

    return $result;
  }

/**
 *
 * Administrace banovani adminu
 *
 * @return administrace ban-u
 */
  private function AdminIpBan()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_ban"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addip"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idipban}&amp;co=addip" : ""),
                                        $this->VypisAdminIpBan());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addip": //pridavani ip ban
          $tlacitko = (!Empty($_POST["tlacitko"]));
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditip"],
                                              $this->unikatni["admin_addeditip_add"],
                                              $this->NotEmpty("post", "nazev"),
                                              $this->VyberBanTypu($this->NotEmpty("post", "typ")),
                                              $this->NotEmpty("post", "login"),
                                              ($tlacitko ? $this->NotEmpty("post", "ip") : $this->NotEmpty("get", "ip")),  //5
                                              ($this->NotEmpty("post", "aktivni") ? " checked=\"checked\"" : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? $_GET["ret"] : "{$this->idmodul}{$this->idipban}"));

          if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                        "typ" => array("post", "string"),
                                        "login" => array("post", "string"),
                                        "ip" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "aktivni" => array("post", "boolean")),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"])),
                                array("insert", "ipban", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["nazev"]);
            $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idipban}");  //auto kliknuti
          }
        break;

        case "editip":  //uprava ip ban
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT nazev, typ, login, ip, aktivni FROM {$this->dbpredpona}ipban WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditip"],
                                                $this->unikatni["admin_addeditip_edit"],
                                                $data->nazev,
                                                $this->VyberBanTypu($data->typ),
                                                $data->login,
                                                $data->ip,
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idipban}");

            if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                          "typ" => array("post", "string"),
                                          "login" => array("post", "string"),
                                          "ip" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now"),
                                          "aktivni" => array("post", "boolean")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && $id > 0),
                                  array("update", "ipban", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idipban}");  //auto kliknuti
            }
          }
        break;

        case "delip": //mazani ip ban
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("ipban" => array("id", $id, "nazev")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idipban}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Admin vypis ip ban-u
 *
 * @return vypis
 */
  private function VypisAdminIpBan()
  {
    $result = "";
    $tvar_datum = $this->unikatni["vypis_ban_tvar_datum"];  //nacteni tvaru data
    $editip_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editip"];
    $delip_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delip"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, typ, login, ip, pridano, upraveno, aktivni FROM {$this->dbpredpona}ipban ORDER BY LOWER(nazev) ASC;"))
    {
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_ban"],
                                            $data->id,
                                            $data->nazev,
                                            $this->bantyp[$data->typ],
                                            $data->login,
                                            $data->ip,
                                            date($tvar_datum, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : $this->unikatni["admin_vypis_ban_neupraveno"]),
                                            ($data->aktivni ? " checked=\"checked\"" : ""),
                                            ($editip_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idipban}&amp;co=editip&amp;id={$data->id}" : ""),
                                            ($delip_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idipban}&amp;co=delip&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_ban_null"];
    }

    return $result;
  }

/**
 *
 * Vrati select pro vyber z typu jednotek
 *
 * @param id id polozky vstupu, nepovinne
 * @return html select
 */
  private function VyberTypJednotky($id = NULL)
  {
    $result = $this->unikatni["admin_set_typ_jednotky_begin"];
    foreach ($this->typjednotky as $index => $hodnota)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_set_typ_jednotky"],
                                          $index,
                                          ($id == $index ? " selected=\"selected\"" : ""),
                                          $hodnota);
    }
    $result .= $this->unikatni["admin_set_typ_jednotky_end"];

    return $result;
  }

/**
 *
 * Navoleni akceptovaneho prohlizece
 *
 * @param pole pole zadanych hodonot
 * @return blok checkboxu s texty
 */
  private function VyberAkceptujProhlizec($pole)
  {
    $arrayproh = $this->accessbrow;
    asort($arrayproh);  //serazeni prohlizecu

    $key = array_keys($pole);
    $val = array_values($pole);
    $result = "";
    foreach ($arrayproh as $prohlizec => $verze)
    {
      $podm = in_array($prohlizec, $key);
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_blok_brow"],
                                          $prohlizec,
                                          ($podm ? " checked=\"checked\"" : ""),
                                          ($podm ? $pole[$prohlizec] : $verze),
                                          (!$podm ? " disabled=\"disabled\"" : ""));
    }

    return $result;
  }

/**
 *
 * Obsluha admin ipblok
 *
 * @param pole array zadanych hodnot
 * @return blok inputu
 */
  private function AdminObsluhaIpBlok($pole)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsl_ipblok"],
                                        count($pole),
                                        implode("', '", $pole));

    return $result;
  }

/**
 *
 * Nacteni casti konfigurace ze souboru
 *
 * @param uniq vlozeni potrebne unikatni
 */
  private function AdminSetConfigLoad($unikatni = NULL)
  {
    //umele vlozi unikatni, pri ajaxu
    if (!is_null($unikatni))
    {
      $this->unikatni = $unikatni;
    }

    //nacitani promennach
    if ($res = $this->ControlConfig(array("waitindex", "set_zaplaceno", "datum_blokace_begin", "blokace_penale", "blokace_typ_jednotka",
                                          "blokace_pocet_jednotka", "admin_tvar_datum", "admin_expire", "set_expire_dataadmin",
                                          "set_expire_unikadmin", "set_expire_logadmin", "set_expire_actionlog", "set_expire_erroadmin",
                                          "nazevwebu", "adresaadminu", "set_prohlizece", "admin_ip_blok"), true,
                                    array("load|config", $this->FileVynorovani("{$this->var->dirmodule}/{$this->adminsetblok}"))))
    {
      $this->var->waitindex = $res->waitindex;
      $this->unikatni["set_zaplaceno"] = $res->set_zaplaceno;
      $this->unikatni["datum_blokace_begin"] = $res->datum_blokace_begin;
      $this->unikatni["blokace_penale"] = $res->blokace_penale;
      $this->unikatni["blokace_typ_jednotka"] = $res->blokace_typ_jednotka;
      $this->unikatni["blokace_pocet_jednotka"] = $res->blokace_pocet_jednotka;
      $this->unikatni["admin_tvar_datum"] = $res->admin_tvar_datum;
      $this->var->admin_expire = $res->admin_expire;
      $this->unikatni["set_expire_erroadmin"] = $res->set_expire_erroadmin;
      $this->unikatni["set_expire_dataadmin"] = $res->set_expire_dataadmin;
      $this->unikatni["set_expire_unikadmin"] = $res->set_expire_unikadmin;
      $this->unikatni["set_expire_logadmin"] = $res->set_expire_logadmin;
      $this->unikatni["set_expire_actionlog"] = $res->set_expire_actionlog;
      $this->var->nazevwebu = htmlspecialchars_decode(html_entity_decode($res->nazevwebu, NULL, "UTF-8"));  //prevod z entit
      $this->var->adresaadminu = $res->adresaadminu;
      $this->unikatni["set_prohlizece"] = $res->set_prohlizece;
      $this->unikatni["admin_ip_blok"] = $res->admin_ip_blok;
      $this->var->ipblok = $this->unikatni["admin_ip_blok"];
    }
      else
    {
      $this->var->ipblok = $this->unikatni["admin_ip_blok"];
    }
  }

/**
 *
 * Administrace nastaveni adminu
 *
 * @return administrace nastaveni
 */
  private function AdminSetConfig()
  {
    $result = $this->UniqObject($this->unikatni["admin_set_config"], array(
                                "waitindex" => ($this->var->waitindex ? " checked=\"checked\"" : ""),
                                "set_zaplaceno" => ($this->unikatni["set_zaplaceno"] ? " checked=\"checked\"" : ""),
                                "datum_blokace_begin" => $this->unikatni["datum_blokace_begin"],
                                "blokace_penale" => $this->unikatni["blokace_penale"],
                                "blokace_typ_jednotka" => $this->VyberTypJednotky($this->unikatni["blokace_typ_jednotka"]),
                                "blokace_pocet_jednotka" => $this->unikatni["blokace_pocet_jednotka"],
                                "admin_tvar_datum" => $this->unikatni["admin_tvar_datum"],
                                "admin_expire" => $this->var->admin_expire,
                                "set_expire_dataadmin" => $this->unikatni["set_expire_dataadmin"],
                                "set_expire_unikadmin" => $this->unikatni["set_expire_unikadmin"],
                                "set_expire_logadmin" => $this->unikatni["set_expire_logadmin"],
                                "set_expire_actionlog" => $this->unikatni["set_expire_actionlog"],
                                "set_expire_erroadmin" => $this->unikatni["set_expire_erroadmin"],
                                "nazevwebu" => $this->var->nazevwebu,
                                "adresaadminu" => $this->var->adresaadminu,
                                "set_prohlizece" => $this->VyberAkceptujProhlizec($this->unikatni["set_prohlizece"]),
                                "admin_ip_blok" => $this->AdminObsluhaIpBlok($this->unikatni["admin_ip_blok"])));

    //ukladani konfigurace
    if ($this->ControlConfig(array ("waitindex" => array("post", "boolean"),
                                    "set_zaplaceno" => array("post", "boolean"),
                                    "datum_blokace_begin" => array("post", "date"),
                                    "blokace_penale" => array("post", "integer"),
                                    "blokace_typ_jednotka" => array("post", "string"),
                                    "blokace_pocet_jednotka" => array("post", "integer"),
                                    "admin_tvar_datum" => array("post", "string"),
                                    "admin_expire" => array("post", "string"),
                                    "set_expire_dataadmin" => array("post", "string"),
                                    "set_expire_unikadmin" => array("post", "string"),
                                    "set_expire_logadmin" => array("post", "string"),
                                    "set_expire_actionlog" => array("post", "string"),
                                    "set_expire_erroadmin" => array("post", "string"),
                                    "nazevwebu" => array("post", "string"),
                                    "adresaadminu" => array("post", "string"),
                                    "set_prohlizece" => array("post", "array"),
                                    "admin_ip_blok" => array("post", "array"),
                                    ), (!Empty($_POST["tlacitko"]) && !Empty($_POST["datum_blokace_begin"])),
                              array("save|config", "{$this->var->dirmodule}/{$this->adminsetblok}")))
    {
      $result = $this->Hlaska("edit", "Konfigurace administrace");
      $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
      $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idset}");  //auto kliknuti
    }

    return $result;
  }

/**
 *
 * Administrace testu v adminu
 *
 * @return administrace testu
 */
  private function AdminTest()
  {
    $result = "";
    $co = $this->NotEmpty("get", "co");

    switch ($co)
    {
      default:
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_test"],
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["test_rv"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtest}&amp;co=test_rv" : ""),
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtest}&amp;co=sitemap",
                                            $this->InfoLayout());
      break;

      case "test_rv":
//var_dump(ini_get("magic_quotes_gpc"));
//nejak dodelat?!
//toto nejak nastavit?!!!! a nebo jak?
        $vstup = $this->ChangeWrongChar($this->NotEmpty("post", "vstup"));
        //prepinani podle webu/lokalu
        $reg_exp = $this->NotEmpty("post", "reg_exp");
        //$this->ChangeWrongChar();
        //(!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : $this->ChangeWrongChar($_POST["reg_exp"], false));

        $vysledek = "";
        if (!Empty($_POST["tlacitko"]) &&
            !Empty($vstup) &&
            !Empty($reg_exp))
        {
          if (@preg_match($reg_exp, $vstup, $ret) !== false)
          {
            $vysledek = (!Empty($ret[0]) ? $ret[0] : "NULL");  //vybere nulty index
          }
            else
          {
            $vysledek = $this->Hlaska("warning", "Chybný regularní výraz '{$reg_exp}'");
          }
        }

        $result = $this->NactiUnikatniObsah($this->unikatni["admin_test_rv"],
                                            $vstup,
                                            $reg_exp,
                                            $vysledek,
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtest}");
      break;

      case "sitemap": //vytvareni zakladniho xml site mapy
        $url = $this->NotEmpty("post", "url");

        if (!Empty($url))
        {
          ini_set("memory_limit", "100M");  //rezervuje vic mega
          //ini_set("max_execution_time", "60");
          $listurl = $this->ProjdiUrl($url);
          if (is_array($listurl))
          {
            //prvni pruchod urovne
            foreach ($listurl as $adresa)
            {
              $uroven = $this->ProjdiUrl($url, $adresa);
              $listurl = array_merge($listurl, $uroven);
            }
            $listurl = array_unique($listurl);

            //druhy pruchod urovne
            foreach ($listurl as $adresa)
            {
              $uroven = $this->ProjdiUrl($url, $adresa);
              $listurl = array_merge($listurl, $uroven);
            }
            $listurl = array_unique($listurl);
            natcasesort($listurl);  //prirozene serazeni hodnot

            $xml = new SimpleXMLElement("<urlset></urlset>");
            $xml->addAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
            $xml->addAttribute("xsi:schemaLocation", "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd", "http://www.w3.org/2001/XMLSchema-instance");
            //prochazeni adres
            foreach ($listurl as $polozka)
            {
              $xmlurl = $xml->addChild("url");
              $xmlurl->addChild("loc", $polozka);
            }
            $url_name = preg_replace(array("/www\./", "/http:\/\//", "/\//"),
                                    array("", "", ""),
                                    $url);
            $full_url_name = "{$url_name}_sitemap.xml";
            $xml->asXML("{$this->dircache}/{$full_url_name}");
            $this->AutoClick(0, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtest}&co=sitemapgen&xml={$full_url_name}");
          }
        }

        $result = $this->UniqObject($this->unikatni["admin_sitemap"],
                                    array("url" => $url,
                                          "backlink" => "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtest}"));
      break;

      case "sitemapgen":  //samotna uprava sitemapy
        $getxml = $this->NotEmpty("get", "xml");
        // && Empty($getxml)
//dodelat!!! toto rozhrani!!!!
        $row = array();
        $cesta = "{$this->dircache}/{$getxml}";
        if (is_file($cesta))
        {
          $vystup = "";
          $xml = simplexml_load_file($cesta);
          foreach ($xml->url as $polozka)
          {
            $loc = (string)$polozka->loc;

            $row[] = $this->UniqObject($this->unikatni["admin_sitemap_row"],
                                      array("loc" => $loc));
          }
          //var_dump($xml->asXML());
        }

        $result = $this->UniqObject($this->unikatni["admin_sitemapgen"],
                                    array("row" => implode("", $row),
                                          "backlink" => "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtest}"));
      break;
    }

    return $result;
  }

  private function ProjdiUrl($url, $prenos = "")
  {
    $result = array($url);
    $prenos = (!Empty($prenos) ? $prenos : $url);
    $html = file_get_contents($prenos);
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xml = simplexml_import_dom($dom);
    //vyhledani odkazu
    $search = $xml->xpath("body//*[@href]");
    $clear_url = preg_split("/^http\:\/\/|\//", $url);  //pevne url!
    if (is_array($search))
    {
      $odkazy = array();
      foreach ($search as $polozka)
      {
        $atribut = $polozka->attributes();
        $href = (string)$atribut->href;

        if (preg_match("/{$clear_url[1]}\/[a-zA-Z0-9]+/", $href) &&
            !preg_match("/\/modules\//", $href))
        {
          $result[] = $href;
        }
      }
    }

    return $result;
  }

/**
 *
 * Administrace doporucenych chmod-u souboru
 *
 * @return administrace chmod
 */
  private function AdminChmod()
  {
    //slozka => chmod
    $chmodfile = array ($this->errorlogdir => "0755",
                        $this->errorpage => "0755",
                        $this->zalohauniq => "0755",
                        $this->zalohadbdir => "0755",
                        $this->dirweblog => "0755",
                        $this->diractlog => "0755",
                        $this->dirsession => "0755",
                        $this->dircache => "0755",
                        $this->var->souborymenu => "0755",
                        $this->var->dirmodule => "0777",
                        dirname($this->var->mpdfcore) => "0755",
                        dirname($this->var->geoipinc) => "0755",
                        "font" => "0755",
                        "browscap" => "0755",
                        "obr" => "0755",
                        "script" => "0777",
                        "styles" => "0755",
                        );
    //serazeni podle klice
    ksort($chmodfile);
    //prochazeni pole doporucenych chmodu
    $poc = 0;
    $ret = array();
    foreach ($chmodfile as $slozka => $chmod)
    {
      $atribut = $this->ZjistiAtributy($slozka, true);  //zjisteni atributu
      $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_chmod_row"],
                                        $slozka,
                                        $atribut,
                                        $chmod, //rovno nebo skutecny > doporuceny
                                        ($atribut == $chmod || $atribut > $chmod ?
                                          $this->unikatni["admin_chmod_true"] :
                                          $this->unikatni["admin_chmod_false"]),
                                        (($poc % 2) == 0 ? $this->unikatni["admin_chmod_liche"] : $this->unikatni["admin_chmod_sude"]));
      $poc++;
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_chmod"],
                                        implode("", $ret));

    return $result;
  }

/**
 *
 * Vyber souboru pro include
 *
 * @param adresa adresovani funkce
 * @param id nazev oznacene polozky
 * @param pohyb odkazy na pohyb mezi moduly
 * @param dostupne pocet volnych modulu
 * @return select souboru
 */
  private function VyberInclude($adresa, $id = NULL, &$pohyb = NULL, &$dostupne = NULL)
  {
    $pripojene = "";

    //vezme moduly v db ale i ty neaktivni
    $modulydb = $this->querySingle("SELECT include FROM {$this->dbpredpona}moduly;", false);
    foreach ($modulydb as $polozka)
    {
      $pripojene[] = dirname($polozka);
    }
//dodelat!! nacitat php moduly podle nazvu slozky!
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_include_begin"],
                                        $adresa);

    //vypis slozky modulu
    $moduly = $this->VypisAdresaru($this->var->dirmodule, array("name", "asc"));
    $selectmodule = array();
    foreach ($moduly as $adresar)
    { //pokud neni modul pripojeny
      if (!in_array("{$this->var->dirmodule}/{$adresar}", $pripojene))
      {
        $selectmodule[] = $adresar; //nacteni vybranych modulu
      }
    }
    //vrati pocet volnych dostupnych modulu
    $dostupne = count($selectmodule);
    $mindex = -1;
    $modulesoubory = "";
    foreach ($selectmodule as $modulindex => $adresar)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_include_skupina_begin"],
                                          $adresar);

      $soubory = $this->VypisSouboru("{$this->var->dirmodule}/{$adresar}", array("name", "asc"), array("php"));
      //pokud jsou ve slozce soubory
      if (is_array($soubory))
      {
        foreach ($soubory as $souborindex => $polozka)
        {
          if ($polozka != ".unikatni_obsah.php" &&  //vyblokovani obvyklych souboru
              $polozka != ".duplikatni_obsah.php" &&
              $polozka != "ajax_form.php")
          {
            $modulesoubor[$modulindex] = $polozka;  //ulozeni souboru pro kazdy modul
            if ($id == "{$adresar}/{$polozka}")
            {
              $mindex = $modulindex;  //ulozeni modul indexu
            }

            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_include"],
                                                "{$adresar}/{$polozka}",
                                                ($id == "{$this->var->dirmodule}/{$adresar}/{$polozka}" ? " selected=\"selected\"" : ""),
                                                $polozka);
          }
        }
      }

      $result .= $this->unikatni["admin_vyber_include_skupina_end"];
    }

    $result .= $this->unikatni["admin_vyber_include_end"];

    //pohyb mezi moduly
    $pohyb = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_include_pohyb"],
                                      (!Empty($selectmodule[$mindex - 1]) ? $this->NactiUnikatniObsah($this->unikatni["admin_vyber_include_pohyb_prev"],
                                                                                                      "{$adresa}&amp;include={$this->NotIsset($selectmodule, $mindex - 1)}/{$this->NotIsset($modulesoubor, $mindex - 1)}",
                                                                                                      $selectmodule[$mindex - 1],
                                                                                                      $this->NotIsset($modulesoubor, $mindex - 1)) : ""),
                                      (!Empty($selectmodule[$mindex + 1]) ? $this->NactiUnikatniObsah($this->unikatni["admin_vyber_include_pohyb_next"],
                                                                                                      "{$adresa}&amp;include={$this->NotIsset($selectmodule, $mindex + 1)}/{$this->NotIsset($modulesoubor, $mindex + 1)}",
                                                                                                      $selectmodule[$mindex + 1],
                                                                                                      $this->NotIsset($modulesoubor, $mindex + 1)) : "")
                                      );

    return $result;
  }

/**
 *
 * Vyparsrovani tridy ze souboru modulu
 *
 * @param include cesta modulu
 * @return nazev tridy
 */
  private function VyhledejClass($include)
  {
    $result = "";
    $cesta = "{$this->var->dirmodule}/{$include}";
    if (file_exists($cesta) &&
        is_file($cesta))
    {
      $u = fopen($cesta, "r");
      $data = fread($u, 2000);  //otevre si prvnich 2k znaku
      fclose($u);

      $a = explode("class", $data);
      $b = explode(" ", $a[1]);
      $result = $b[1];
    }

    return $result;
  }

/**
 *
 * Zjisteni informaci z modulu
 *
 * @param include cesta modulu
 * @param clas trida modulu
 * @param prom hodnota co se ma vratit
 * @return pole podporovanych databazi
 */
  private function GetModule($include, $clas, $prom)
  {
    $result = "";
    $cesta = $include;
    //"{$this->var->dirmodule}/{$include}";
    if (file_exists($cesta) &&
        is_file($cesta))
    {
      include_once $cesta;
      $modul = new $clas();

      switch ($prom)
      {
        case "support": //zjisteni podpory db
          $result = $modul->support;
        break;

        case "admin": //zjisteni adminu
          $result = method_exists($modul, "AdminObsah");
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vygeneruje nazev databaze
 *
 * @param include ceska k souboru
 * @param pole array uloziste
 * @return nazev db
 */
  private function VytvoritNazevDB($include, $pole)
  {
    $result = "";

    if (!Empty($pole[0]) &&
        $pole[0] != 0)
    {
      $result = ".db";  //predpona

      $a = explode("_", basename($include, ".php"));  //rozdeleni podle "_"
      foreach ($a as $slovo)
      {
        $result .= substr($slovo, 0, 3);  //vezme si 3 prvni pismena
      }

      $result .= ".sqlite2";  //koncovka
    }

    return $result;
  }

/**
 *
 * Vypise podporovane uloziste
 *
 * @param pole array uloziste
 * @return vypis podporovanych
 */
  private function PodporovaneUloziste($pole)
  {
    if (is_array($pole))
    {
      $result = $this->unikatni["admin_support_begin"];

      foreach ($pole as $uloziste)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_support"],
                                            $uloziste,
                                            $this->typdatabaze[$uloziste]);
      }

      $result .= $this->unikatni["admin_support_end"];
    }
      else
    {
      $result = $this->unikatni["admin_support_null"];
    }

    return $result;
  }

/**
 *
 * Vyber uloziste pro modul
 *
 * @param pole array uloziste
 * @return select vyberu uloziste
 */
  private function VyberUloziste($pole, $id = NULL)
  {
    if (is_array($pole))
    {
      $result = $this->unikatni["admin_uloziste_begin"];

      foreach ($pole as $uloziste)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_uloziste"],
                                            $uloziste,
                                            ($id == $uloziste ? " selected=\"selected\"" : ""),
                                            $this->typdatabaze[$uloziste]);
      }

      $result .= $this->unikatni["admin_uloziste_end"];
    }
      else
    {
      $result = $this->unikatni["admin_uloziste_null"];
    }

    return $result;
  }

/**
 *
 * Administrace pripojovanych modulu
 *
 * @return administrace modulu
 */
  private function AdminMountModule()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_module"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addmod"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}&amp;co=addmod" : ""),
                                        $this->VypisAdminMountModule());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addmod": //pridani modulu
          $include = (!Empty($_GET["include"]) ? $_GET["include"] : "");
          $class = $this->VyhledejClass($include);
          $include = "{$this->var->dirmodule}/{$include}";
          $admin = $this->GetModule($include, $class, "admin");
          $uloziste = $this->GetModule($include, $class, "support");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addmod"],
                                              $this->VyberInclude("?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}&amp;co=addmod", $include, $pohyb, $dostupne),
                                              $pohyb,
                                              $dostupne,
                                              $class,
                                              ($admin ? " checked=\"checked\"" : ""),
                                              (is_array($uloziste) && $uloziste[0] == 0 ? " disabled=\"disabled\"" : ""),
                                              $this->VytvoritNazevDB($include, $uloziste),
                                              $this->PodporovaneUloziste($uloziste),  //8
                                              $this->VyberUloziste($uloziste),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}");

          $booladmin = $this->GetModule("{$this->var->dirmodule}/{$this->NotEmpty("post", "include")}", $this->NotEmpty("post", "class"), "admin");
          if ($this->ControlForm(array ("include" => array("post", "string|pref", "{$this->var->dirmodule}/"),  //+vlozi predponu
                                        "class" => array("post", "string"),
                                        "admin" => array("self", "boolean", $booladmin),
                                        "databaze" => array("post", "string"),
                                        "uloziste" => array("post", "integer"),
                                        "aktivni" => array("post", "boolean"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "moduly", 1)),
                                        "pevneporadi" => array("self", "integer", $this->hranicesecure)), //pevne poradi bude ostatnim nastavovat na $this->hranicesecure
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["include"]) && !Empty($_POST["class"]) && $_POST["uloziste"] >= 0),
                                array("insert", "moduly", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["class"]);
            $this->AdminAddActionLog($_POST["class"], array(__LINE__, __METHOD__));
            $this->AdminGenerateModule(); //vygeneruje cache modulu
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}");  //auto kliknuti
          }
        break;

        case "editmod":  //upraveni modulu
          $id = $_GET["id"];
          settype($id, "integer");
          $secure = in_array($id, $this->securemodule);

          if ($data = $this->querySingleRow("SELECT include, class, admin, databaze, uloziste, aktivni FROM {$this->dbpredpona}moduly WHERE id={$id};"))
          {
            $uloziste = $this->GetModule($data->include, $data->class, "support");  //pripojeni do modulu

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_editmod"],
                                                $data->include,
                                                $data->class,
                                                ($data->admin ? " checked=\"checked\"" : ""),
                                                ($uloziste[0] == 0 ? " disabled=\"disabled\"" : ""),  //4
                                                $data->databaze,  //5
                                                $this->PodporovaneUloziste($uloziste),
                                                $this->VyberUloziste($uloziste, $data->uloziste),
                                                ($data->aktivni ? " checked=\"checked\"" : ""), //8
                                                ($secure ? " readonly=\"readonly\"" : ""),
                                                ($secure ? " disabled=\"disabled\"" : ""),  //10
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}");

            if ($this->ControlForm(array ("databaze" => array("post", "string"),
                                          "uloziste" => array("post", "integer"),
                                          "aktivni" => array("self", "boolean", (!Empty($_POST["aktivni"]) || $secure))),
                                  (!Empty($_POST["tlacitko"]) && $_POST["uloziste"] >= 0 && $id > 0),
                                  array("update", "moduly", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["class"]);
              $this->AdminAddActionLog($_POST["class"], array(__LINE__, __METHOD__));
              $this->AdminGenerateModule(); //vygeneruje cache modulu
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}");  //auto kliknuti
            }
          }
        break;

        case "delmod": //smazani modulu
          $id = $_GET["id"];
          settype($id, "integer");
          $id = (!in_array($id, $this->securemodule) ? $id : 0);  //ochrana zakladnich modulu

          if ($this->ControlDeleteForm(array("moduly" => array("id", $id, "class")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AdminGenerateModule(); //vygeneruje cache modulu
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}");  //auto kliknuti
          }
        break;

        case "clemod":  //promazani obsahu databaze
          $id = $_GET["id"];
          settype($id, "integer");
          $id = (!in_array($id, $this->securemodule) ? $id : 0);  //ochrana zakladnich modulu

          if ($data = $this->querySingleRow("SELECT include, class, databaze, uloziste FROM {$this->dbpredpona}moduly WHERE id={$id};"))
          {
            $pole = array("include" => $data->include,
                          "class" => $data->class,
                          "databaze" => $data->databaze,
                          "uloziste" => $this->origuloziste[$data->uloziste]);

            //pripojeni do jine databaze behem pripojeni zakladni databaze
            $predpona = $this->NastavKomunikaci($this->var, $pole, null, 1);
            if (!$this->PripojeniDatabaze($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
              else
            { //kdyz je pripojen do druhe db
              if ($ret = $this->GetTable())  //pokud neco vrati
              {
                foreach ($ret as $tabulka)  //projiti tabulek
                {
                  $tab[] = "DELETE FROM {$tabulka};"; //poskladani dotazu
                }
                $table = implode("\n", $tab); //slouceni tabulek

                if ($this->queryExec($table)) //provedeni dotazu
                {
                  $result = $this->Hlaska("clear", $data->class);

                  $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}");  //auto kliknuti
                }
              }
            }

            $this->NavratPripojeni(); //navrat rizeni 0
          }
        break;

        case "deldb": //absolutni smazani databaze
          $id = $_GET["id"];
          settype($id, "integer");
          $id = (!in_array($id, $this->securemodule) ? $id : 0);  //ochrana zakladnich modulu

          if ($data = $this->querySingleRow("SELECT include, class, databaze, uloziste FROM {$this->dbpredpona}moduly WHERE id={$id};"))
          {
            $path = dirname($data->include);
            $typ = $this->origuloziste[$data->uloziste];
            $dbname = "{$path}/{$data->databaze}".($typ == "mysqli" ? ".mysqli" : "");
            $predinstall = "{$path}/.installdata";

            switch ($typ) //akce podle typu db
            {
              case "sqlite":  //soubor+predinstall
                if (file_exists($dbname)) //smazani souboru
                {
                  @unlink($dbname);
                }

                if (file_exists($predinstall))  //smazani predinstall
                {
                  @unlink($predinstall);
                }
              break;

              case "mysqli":  //drop+soubor+predinstall
                $pole = array("include" => $data->include,
                              "class" => $data->class,
                              "databaze" => $data->databaze,
                              "uloziste" => $this->origuloziste[$data->uloziste]);

                //pripojeni do jine databaze behem pripojeni zakladni databaze
                $predpona = $this->NastavKomunikaci($this->var, $pole, null, 1);
                if (!$this->PripojeniDatabaze($error1))
                {
                  $this->ErrorMsg($error1, array(__LINE__, __METHOD__));
                }
                  else
                { //kdyz je pripojen do druhe db
                  if ($ret = $this->GetTable())  //pokud neco vrati
                  {
                    foreach ($ret as $tabulka)  //projiti tabulek
                    {
                      $tab[] = "DROP TABLE `{$tabulka}`;"; //poskladani dotazu
                    }
                    $table = implode("\n", $tab); //slouceni tabulek

                    $this->queryExec($table); //provedeni dotazu
                  }
                }

                $this->NavratPripojeni(); //navrat rizeni 0

                if (file_exists($dbname)) //smazani souboru
                {
                  @unlink($dbname);
                }

                if (file_exists($predinstall))  //smazani predinstall
                {
                  @unlink($predinstall);
                }
              break;
            }

            $result = $this->Hlaska("del", $data->class);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vygenerovani seznamu modulu pro nacteni
 *
 */
  private function AdminGenerateModule()
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, include, class, admin, databaze, uloziste FROM {$this->dbpredpona}moduly
                                              WHERE aktivni=1 ORDER BY pevneporadi ASC, poradi ASC;"))
    {
      foreach ($res as $data)
      {
        $include_cache[] = "{$data->include}";
        $class_cache[] = "{$data->class}";
        $admin_cache[] = $data->admin;
        $databaze_cache[] = $data->databaze;
        $uloziste_cache[] = $this->origuloziste[$data->uloziste];
      }

      $cache[] = implode("|x|", $include_cache);
      $cache[] = implode("|xx|", $class_cache);
      $cache[] = implode("|xxx|", $admin_cache);
      $cache[] = implode("|xxxx|", $databaze_cache);
      $cache[] = implode("|xxxxx|", $uloziste_cache);

      //ulozeni do cache souboru
      $cesta = "{$this->var->dirmodule}/{$this->cachemodule}";
      if ($u = @fopen($cesta, "w"))
      {
        fwrite($u, implode("|Xx-xX|", $cache));
        fclose($u);
      }
        else
      {
        $this->ErrorMsg("Nelze zapsat do cache modulu", array(__LINE__, __METHOD__));
      }
    }
  }

/**
 *
 * Pregenerovani cache modulu z ajaxu
 *
 */
  public function AjaxAdminGenerateModule()
  {
    $this->StartFunkce(true);
  }

/**
 *
 * Vypisuje pripojovane moduly
 *
 * @return vypis modulu
 */
  private function VypisAdminMountModule()
  {
    $result = $this->unikatni["admin_vypis_module_begin"];  //vlozeni vypisu do hlavniho vypisu

    $editmod_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editmod"];
    $delmod_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delmod"];
    $clemod_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["clemod"];
    $deldb_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["deldb"];

    $dbclass = array();
    if ($res = $this->queryMultiObjectSingle("SELECT id, include, class, admin, databaze, uloziste, aktivni, pevneporadi
                                              FROM {$this->dbpredpona}moduly
                                              ORDER BY pevneporadi ASC, poradi ASC;"))
    {
      foreach ($res as $data)
      {
        $result .= $this->UniqObject($this->unikatni["admin_vypis_module"], array(
                                    "id" => $data->id,
                                    "include" => $data->include,
                                    "existsinclude" => (!file_exists($data->include) ? "MODUL SE NEPODARILO NALEZT! - " : ""),
                                    "class" => $data->class,
                                    "admin" => ($data->admin ? " checked=\"checked\"" : ""),
                                    "databaze" => $data->databaze,
                                    "typdatabaze" => $this->typdatabaze[$data->uloziste],
                                    "aktivni" => ($data->aktivni ? " checked=\"checked\"" : ""),
                                    "securemodule" => (in_array($data->id, $this->securemodule) ? " disabled=\"disabled\"" : " onclick=\"ChangeActive({$data->id}, this.checked);\""),
                                    "editmod" => ($editmod_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}&amp;co=editmod&amp;id={$data->id}" : ""),
                                    "delmod" => ($data->pevneporadi < $this->hranicesecure ?  //ostatni moduly maji pevne razeni: $this->hranicesecure
                                      $this->unikatni["admin_vypis_module_secure"] :
                                      $this->NactiUnikatniObsah($this->unikatni["admin_vypis_module_link"],
                                                                ($delmod_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}&amp;co=delmod&amp;id={$data->id}" : ""),
                                                                $data->class)
                                    ),
                                    "clemoddeldb" => ($data->uloziste > 0 && $data->pevneporadi >= $this->hranicesecure ?
                                      $this->NactiUnikatniObsah($this->unikatni["admin_vypis_module_clear_link"],
                                                                ($clemod_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}&amp;co=clemod&amp;id={$data->id}" : ""),
                                                                ($deldb_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmoumod}&amp;co=deldb&amp;id={$data->id}" : ""),
                                                                $data->class) :
                                      ($data->uloziste == 0 ? $this->unikatni["admin_vypis_module_nodb"] : $this->unikatni["admin_vypis_module_noclear"]))
                                    ));

        //nacteni trid v db
        $dbclass[] = $data->class;
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_module_null"];
    }

    $result .= $this->unikatni["admin_vypis_module_end"];

    //nacteni trid v cache
    foreach ($this->var->moduly as $modul)
    {
      $cacheclass[] = $modul["class"];
    }

    $chyby = array_diff($cacheclass, $dbclass); //porovnani cache s databazi

    //pridani chybejicich modulu z cache
    if (is_array($chyby) &&
        count($chyby) > 0)
    {
      //dotaha moduly do db
      foreach ($chyby as $polozka)
      { //nalezeni indexu dle polozky
        $index = $this->var->asocmoduly["index"][$polozka];
        if ($this->ControlForm(array ("include" => array("self", "string", $this->var->moduly[$index]["include"]),
                                      "class" => array("self", "string", $this->var->moduly[$index]["class"]),
                                      "admin" => array("self", "boolean", $this->var->moduly[$index]["admin"]),
                                      "databaze" => array("self", "string", $this->var->moduly[$index]["databaze"]),
                                      "uloziste" => array("self", "integer", array_search($this->var->moduly[$index]["uloziste"], $this->origuloziste)),
                                      "aktivni" => array("self", "boolean", 1),
                                      "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "moduly", 1)),
                                      "pevneporadi" => array("self", "integer", $this->hranicesecure)),
                              true,
                              array("insert", "moduly", NULL)))
        {
          $result .= $this->Hlaska("add", $this->var->moduly[$index]["class"]);
        }
      }

    }

    return $result;
  }

/**
 *
 * Vraci informace o pripojeni z jineho modulu, slouzi na testy pripojovani modulu
 *
 * @return info o pripojeni
 */
  public function TestConnectModule()
  {
    $prom = func_get_args();  //nacteni parametru
    $met = __METHOD__;  //nacteni aktualni metody
    $promenne = implode("], [", $prom); //slouceni promennych

    $result = "Connect: [{$met}]; var: [{$promenne}]";

    return $result;
  }

/**
 *
 * Administrace ovladani adminu
 *
 * @return administrace ovladani
 */
  private function AdminControl()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_control"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["clearerrlog"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idcontrol}&amp;co=clearerrlog" : ""),
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["clearerrpag"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idcontrol}&amp;co=clearerrpag" : ""),
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["clearweblog"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idcontrol}&amp;co=clearweblog" : ""),
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["clearactlog"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idcontrol}&amp;co=clearactlog" : ""),
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["clearseslog"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idcontrol}&amp;co=clearseslog" : ""),
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["clearcache"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idcontrol}&amp;co=clearcache" : ""),
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["clkon"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idcontrol}&amp;co=clkon" : ""),
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["genpri"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idcontrol}&amp;co=genpri" : ""));

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "clearerrpag":  //promazani error page
          $result = "";
          foreach ($this->unikatni["error_page_text"] as $polozka)
          {
            $soubor = "{$this->errorpage}/{$polozka["kod"]}.html";
            if (file_exists($soubor) &&
                @unlink($soubor))  //smazani souboru
            {
              $result .= $this->Hlaska("clear", $soubor);
            }
          }

          if (file_exists("{$this->errorpage}/{$this->errorblok}"))
          {
            @unlink("{$this->errorpage}/{$this->errorblok}");  //smazani zaznamu o vygenerovani
          }

          //vygenerovani error page
          $result .= $this->GenerovaniErrorPage();

          $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
          $this->AutoClick(5, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idcontrol}");  //auto kliknuti
        break;

        case "clearerrlog":  //promazavani error logu
          $result = $this->ControlDeleteContentDir($this->errorlogdir);

          $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
          $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idcontrol}");  //auto kliknuti
        break;

        case "clearweblog":  //promazavani weblogu
          $result = $this->ControlDeleteContentDir($this->dirweblog);

          $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
          $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idcontrol}");  //auto kliknuti
        break;

        case "clearactlog":  //promazavani actionlogu
          $result = $this->ControlDeleteContentDir($this->diractlog);

          $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
          $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idcontrol}");  //auto kliknuti
        break;

        case "clearseslog":  //promazavani sessionlogu
          $result = $this->ControlDeleteContentDir($this->dirsession);

          $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
          $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idcontrol}");  //auto kliknuti
        break;

        case "clearcache":  //promazavani cache
          $result = $this->ControlDeleteContentDir($this->dircache);

          $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
          $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idcontrol}");  //auto kliknuti
        break;

        case "clkon": //regererace konfigurace
          $result = "";
          foreach ($this->var->main as $index => $polozka)
          {
            $path = dirname($this->var->moduly[$index]["include"]); //path modulu
            if (!Empty($polozka->generated[0])) //pokud hned neni nulty index prazdny
            {
              foreach ($polozka->generated as $gener) //projiti generovanych souboru
              {
                $cesta = "{$path}/{$gener}";
                if (file_exists("{$path}/{$gener}") &&  //pokud soubor existuje
                    @unlink($cesta))
                {
                  $result .= $this->Hlaska("clear", $cesta);
                }
                //overeni existence metody a jeji nasledne spusteni
                if (method_exists($polozka, "VygenerujAjaxScript"))
                {
                  $result .= $polozka->VygenerujAjaxScript();  //znovu vygenerovani skryptu
                }
              }
            }
          }

          $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
          $this->AutoClick(5, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idcontrol}");  //auto kliknuti
        break;

        case "genpri": //generovani pristupu
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_control_genpri"],
                                              $this->DekodujText($this->var->mysql_dbname),
                                              $this->DekodujText($this->var->mysql_host),
                                              $this->DekodujText($this->var->mysql_user),
                                              $this->DekodujText($this->var->mysql_pass),
                                              $this->var->mysql_port,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idcontrol}");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["mysql_dbname"]) &&
              !Empty($_POST["mysql_host"]) &&
              !Empty($_POST["mysql_user"]) &&
              !Empty($_POST["mysql_pass"]))
          {
            $mysql_dbname = $this->ZakodujText($this->ChangeWrongChar($_POST["mysql_dbname"]));
            $mysql_host = $this->ZakodujText($this->ChangeWrongChar($_POST["mysql_host"]));
            $mysql_user = $this->ZakodujText($this->ChangeWrongChar($_POST["mysql_user"]));
            $mysql_pass = $this->ZakodujText($this->ChangeWrongChar($_POST["mysql_pass"]));
            $mysql_port = $_POST["mysql_port"];
            settype($mysql_port, "integer");

            $sablona = "<?php
/**
 *
 * Trida promennych pro login do mysqli
 *
 */
  class LoginMySQLi
  {
    public \$mysql_dbname = \"{$mysql_dbname}\"; //CREATE DATABASE {$mysql_dbname} DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci;
    public \$mysql_host = \"{$mysql_host}\";
    public \$mysql_user = \"{$mysql_user}\";
    public \$mysql_pass = \"{$mysql_pass}\";
    public \$mysql_port = {$mysql_port};
  }
?>\n";

            if ($u = @fopen($this->logprom, "w"))
            {
              fwrite($u, $sablona);
              fclose($u);

              $result = $this->Hlaska("edit", "Vygenerování přístupů");
              $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
            }

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idcontrol}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Rozcestnik mezi reporty, faq
 *
 * @return rozcestnik
 */
  private function AdminHelpCenter()
  {
    $cesta = "{$this->dircache}/{$this->cachexmloutside}";
    if (file_exists($cesta) &&
        is_file($cesta))
    {
      $xml = simplexml_load_file($cesta);
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_help_center"],
                                          ($this->OverovaniManualPermission(NULL, "{$this->idmodul}{$this->idrepo}", "") ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idrepo}" : ""),
                                          (string)$xml->nastaveni->popisreport,
                                          ($this->OverovaniManualPermission(NULL, "{$this->idmodul}{$this->idfaq}", "") ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}" : ""),
                                          (string)$xml->nastaveni->popisfaq);
    }
      else
    {
      $result = $this->Hlaska("warning", "Nejsou nacachovany hodnoty");
    }

    return $result;
  }

/**
 *
 * Administrace reportu od uzivatelu adminu
 *
 * @return administrace reportu
 */
  private function AdminReport()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_report"],
                                        $this->AdminAddReport());

    return $result;
  }

/**
 *
 * Zalogovani reportu a zaslani upozorneni o novem reportu
 *
 * @return formular na pridani reportu pro admin uzivatele
 */
  private function AdminAddReport()
  {
    $result = $this->unikatni["admin_add_report"];
    if ($this->ControlForm(array ("login" => array("self", "string", $this->var->adminuser["name"]),
                                  "email" => array("post", "string"),
                                  "predmet" => array("post", "string"),
                                  "message" => array("post", "string"),
                                  "pridano" => array("self", "date", "now"),
                                  "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),
                                  "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"])),
                        (!Empty($_POST["tlacitko"]) && !Empty($_POST["predmet"]) &&  !Empty($_POST["message"])),
                        array("insert", "reporty", NULL)))
    { //+posle email
      $predmet = $this->NactiUnikatniObsah($this->unikatni["admin_report_predmet"],
                                          $this->var->nazevwebu,
                                          $_POST["predmet"]);

      //kod pro admin na precteni reportu
      $kod = base64_encode("{$this->ZakodujText($this->absolutni_url)}--{$this->lastInsertRowid()}");
      //posle link na zpravu
      $message = $this->NactiUnikatniObsah($this->unikatni["admin_report_message"],
                                          $this->var->nazevwebu,
                                          "{$this->var->administrace}?r={$kod}",
                                          $_POST["message"],
                                          date($this->unikatni["admin_report_tvar_datum"]),
                                          $_SERVER["REMOTE_ADDR"],
                                          gethostbyaddr($_SERVER["REMOTE_ADDR"]),
                                          $this->TypOS($_SERVER["HTTP_USER_AGENT"]),
                                          $this->TypBrowseru($_SERVER["HTTP_USER_AGENT"]));

      $email = ($_POST["email"] == "@" ? "" : $_POST["email"]);

      $header = $this->NactiUnikatniObsah($this->unikatni["admin_report_header"],
                                          $this->var->nazevwebu,
                                          $email);

      if (mail($this->unikatni["admin_report_email"], $predmet, $message, $header))
      {
        $result = $this->Hlaska("send", $_POST["predmet"]);
      }

      $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idrepo}");  //auto kliknuti
    }

    return $result;
  }

/**
 *
 * Admin FAQ pro uzivatele
 *
 * @return administrace FAQ
 */
  private function AdminFAQ()
  {
    $cesta = "{$this->dircache}/{$this->cachexmloutside}";
    if (file_exists($cesta) &&
        is_file($cesta))
    {
      $xml = simplexml_load_file($cesta);
      $skupina = (!Empty($_GET["skup"]) ? $_GET["skup"] : "");
      if (!Empty($xml->faq))
      {
        $pocskup = 0;
        $indexskupina = 0;
        $ret = array();
        foreach ($xml->faq as $polozka)
        {
          $pocskup = $indexskupina + 1;
          $podm = ($skupina == $pocskup);
          $rad = array();
          //generovani jen kdyz je potreba
          if ($podm)
          {
            if (!Empty($polozka->polozka))
            {
              //prochazeni radku
              foreach ($polozka->polozka as $radek)
              {
                $rad[] = $this->NactiUnikatniObsah($this->unikatni["admin_faq_radek"],
                                                  (string)$radek->nazev,
                                                  (string)$radek->otazka,
                                                  (string)$radek->odpoved);
              }
            }
              else
            {
              $rad[] = $this->unikatni["admin_faq_radek_null"];
            }
          }
          //generovani skupin s radky
          $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_faq_skupina"],
                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}".(!$podm ? "&amp;skup={$pocskup}" : ""),
                                    htmlspecialchars_decode(html_entity_decode($polozka->nazev, NULL, "UTF-8")), //nazev skupiny
                                    ($podm ? $this->unikatni["admin_faq_skupina_aktivni"] : ""),
                                    ($podm ? implode("", $rad) : ""));
          $indexskupina++;
        }
      }
        else
      {
        $ret[] = $this->unikatni["admin_faq_null"];
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_faq"],
                                          implode("", $ret));
    }
      else
    {
      $result = $this->Hlaska("warning", "Nejsou nacachovany hodnoty");
    }

    return $result;
  }

/**
 *
 * Administrace opravneni adminu
 *
 * @return administrace opravneni
 */
  private function AdminPermission()
  { //prochazeni modulu
    foreach ($this->var->main as $index => $modul)
    { //nacteni prav z modulu
      $permission[$this->var->moduly[$index]["class"]] = $modul->permit;
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_permission"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addperm"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}&amp;co=addperm" : ""),
                                        $this->AdminVypisPermission($permission));

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addperm": //pridavani permission
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditperm"],
                                              $this->unikatni["admin_addeditperm_add"],
                                              $this->NotEmpty("post", "nazev"),  //$_POST["nazev"],
                                              $this->NotEmpty("post", "popis"),  //$_POST["popis"],$_POST["aktivni"]
                                              ($this->NotEmpty("post", "aktivni") ? " checked=\"checked\"" : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}");

          if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                        "popis" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "aktivni" => array("post", "boolean")),
                        (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"])),
                        array("insert", "permission", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["nazev"]);
            $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}");  //auto kliknuti
          }
        break;

        case "editperm":  //uprava permisson
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT nazev, popis, aktivni FROM {$this->dbpredpona}permission WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditperm"],
                                                $this->unikatni["admin_addeditperm_edit"],
                                                $data->nazev,
                                                $data->popis,
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}");

            if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                          "popis" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now"),
                                          "aktivni" => array("post", "boolean")),
                          (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && $id > 0),
                          array("update", "permission", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}");  //auto kliknuti
            }
          }
        break;

        case "delperm": //mazani permission
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("permission" => array("id", $id, "nazev")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis obravnani v selectu pro admin uzivatele
 *
 * @param id cislo oznacene polozky opravneni
 * @param omezit id na omezeni, aby se admin nemohl upravovat
 * @return select vypis
 */
  private function AdminVypisSelectPermission($id = NULL, $omezit = NULL)
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}permission WHERE aktivni=1 AND id!='{$omezit}' ORDER BY nazev ASC;"))
    {
      $result = $this->unikatni["admin_vypis_select_permission_begin"];
      //vypis opravneni pro select
      foreach ($res as $data)
      { //omezuje jen zadanou polozku, jinak vypisuje vse
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_select_permission"],
                                            $data->id,
                                            ($id == $data->id ? " selected=\"selected\"" : ""),
                                            $data->nazev);
      }

      $result .= $this->unikatni["admin_vypis_select_permission_end"];
    }
      else
    {
      $result = $this->unikatni["admin_vypis_select_permission_null"]; //null
    }

    return $result;
  }

/**
 *
 * Vypis opravneni modulu
 *
 * @param permission pole opravneni nactene z modulu
 * @return vypis skupin s opravnenim
 */
  private function AdminVypisPermission($permission)
  {
    $result = $this->unikatni["admin_vypis_permission_begin"];

    $tvar_datum = $this->unikatni["admin_vypis_permission_tvar_datum"];
    $editperm_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editperm"];
    $delperm_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delperm"];
    //promenna na zobrazovani konkretniho opravneni
    $permit = (!Empty($_GET["perm"]) ? $_GET["perm"] : "");
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, popis, opravneni, pridano, upraveno, aktivni FROM {$this->dbpredpona}permission
                                              WHERE id!='{$this->var->useradmin_permission}' ORDER BY nazev ASC;"))
    {
      //vypis opravneni
      foreach ($res as $data)
      {
        //generovani prav dle modulu a ulozenych hodnot
        $prava = $this->GenerovaniPermission($permission, $data->id, explode($this->permexplode, $data->opravneni));
        //podminka na zobrazeni jednoho daneho opravneni
        $podm = ($permit == $data->id);
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_permission"],
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}".(!$podm ? "&amp;perm={$data->id}" : ""),
                                            $data->nazev,
                                            $data->popis,
                                            ($podm ? $this->unikatni["admin_vypis_permission_aktivni"] : ""),
                                            ($podm ? $prava : ""),
                                            date($tvar_datum, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : $this->unikatni["admin_vypis_permission_neupraveno"]),
                                            ($data->aktivni ? " checked=\"checked\"" : ""),
                                            ($editperm_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}&amp;co=editperm&amp;id={$data->id}" : ""),
                                            ($delperm_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}&amp;co=delperm&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_permission_null"]; //null
    }

    $result .= $this->unikatni["admin_vypis_permission_end"];

    return $result;
  }

/**
 *
 * Generovani polozek opravneni
 *
 * @param permission pole opravneni nactene z modulu
 * @param idpermit identifikator skupiny opravneni
 * @param load_permit nactene opravneni z db
 * @return vypis checkboxu s opravnenim
 */
  private function GenerovaniPermission($permission, $idpermit, $load_permit)
  {
    $result = "";
    $menuodkazy = "";
    foreach ($this->arraymenu as $polozka)
    { //nacteni nazvu modulu
      $menuodkazy[$polozka["main_href"]] = $polozka["odkaz"];
    }
    $fun_per = "Funkce|-|funkce_permit|x|"; //nazev opravneni funkce
    //pokud je povoleno opravneni ve funkci
    $enable_permit = in_array($fun_per, $load_permit);
    //nacteni aktualniho bloku permission
    $blok_modulu = (!Empty($_GET["blok"]) ? $_GET["blok"] : "");
    //prochazeni modulu
    foreach ($permission as $name_modul => $modul)
    {
      //pokud je modul pole
      if (is_array($modul))
      {
        $mod = array();
        //prochazeni sekci modulu
        foreach ($modul as $name_sekce => $sekce)
        {
          //pokud je sekce pole
          if (is_array($sekce))
          {
            $pol = "";
            $all = "";
            $edit = "";
            //prochazeni polozek sekce a vypis samotnych opravneni
            $pocrad = 0;  //pocitani radku
            foreach ($sekce as $index_polozka => $polozka)
            {
              $adresa = "{$name_modul}|-|{$name_sekce}|x|{$index_polozka}";

              $all[] = $adresa;
              //hledani edit polozek
              preg_match("/^edit.*/", $index_polozka, $ret);
              if (!Empty($ret[0]))
              {
                $edit[] = $adresa;
              }

              //nacitani pole polozek
              $pol[] = $this->NactiUnikatniObsah($this->unikatni["admin_generovani_permission_polozka"],
                                                $idpermit,
                                                $adresa,
                                                (in_array($adresa, $load_permit) ? " checked=\"checked\"" : ""),
                                                $polozka,
                                                (($pocrad % 2) == 0 ? $this->unikatni["admin_generovani_permission_polozka_sude"] : $this->unikatni["admin_generovani_permission_polozka_liche"]));
              $pocrad++;
            }

            //vyhodnoceni zaskrknuti vsech polozek
            $pocall = 0;
            $allcheck = false;
            foreach ($all as $polozka)
            {
              $pocall += (in_array($polozka, $load_permit) ? 1 : 0);
            }
            $allcheck = ($pocall == count($all));

            //vyhodnocovani zaskrknuti editacnich polozek
            $pocedit = 0;
            $editcheck = false;
            if (is_array($edit))
            {
              foreach ($edit as $polozka)
              {
                $pocedit += (in_array($polozka, $load_permit) ? 1 : 0);
              }
              $editcheck = ($pocedit == count($edit));
            }

            //adresa pro zobrazeni dotycne sekce
            $permit_pristup = "{$name_modul}|-|{$name_sekce}|x|allowpermitedit";
            //bool na vyblokovani sama sebe
            $disable_self_permit = ("{$name_modul}|-|{$name_sekce}|x|" != $fun_per);
            //v adminu zobrazit vse, uzivately jen ty kdetere jsou pro toto $permit_pristup povolene
            if ($this->var->admin_mod ? true : in_array($permit_pristup, $load_permit) && $enable_permit)
            {
              //nacitani pole sekci
              $mod[] = $this->NactiUnikatniObsah($this->unikatni["admin_generovani_permission_sekce"],
                                                (!Empty($menuodkazy[$name_sekce]) ? $menuodkazy[$name_sekce] : (!Empty($name_sekce) ? $name_sekce : $name_modul)),
                                                $idpermit,
                                                (implode("|_|", $all)), //vsechyn polozky
                                                ($allcheck ? " checked=\"checked\"" : ""),
                                                (is_array($edit) ? implode("|_|", $edit) : ""), //jen editacni polozky
                                                (is_array($edit) ? ($editcheck ? " checked=\"checked\"" : "") : " disabled=\"disabled\""),
                                                ($disable_self_permit ? $permit_pristup : ""),  //zobrazeni editace prav, sama sebe dizablovat
                                                ($enable_permit && $disable_self_permit && $this->var->admin_mod ? (in_array($permit_pristup, $load_permit) ? " checked=\"checked\"" : "") : " disabled=\"disabled\""),
                                                implode("", $pol));
            }
          }
        }
        //zobrazi jen ty polozky ktere obsahuji sekce
        if (count($mod) > 0)
        {
          $podm = ($blok_modulu == $name_modul);
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_generovani_permission_modul"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idperm}&amp;perm={$idpermit}".(!$podm ? "&amp;blok={$name_modul}" : ""),
                                              $name_modul,
                                              ($podm ? $this->unikatni["admin_generovani_permission_modul_aktivni"] : ""),
                                              ($podm ? implode("", $mod) : ""));
        }
      }
    }

    return $result;
  }

/**
 *
 * Zavola danou funkci z daneho indexu tridy, dokaze zpracovat libovolne mnozstvi parametru
 *
 * pouziti:
 * $navrat = $this->var->main[0]->NactiFunkci("Funkce|index", "NazevFunkce", [parametry[, ...]]);
 * $navrat = $this->var->main[0]->NactiFunkci(array("Funkce|index", "NazevFunkce"), [array(parametry[, ...])]);
 *
 * @param index index nebo nazev funkce pro $this->var->main
 * @param funkce volana public funkce
 * @return obsah funkce
 */
  public function NactiFunkci($index, $funkce)
  {
    $parametr = func_get_args();
    $pocet = func_num_args();
    $argv = array();

    //orezava konec pole na parametry
    if ($pocet > 2)
    {
      $argv = array_slice($parametr, 2);  //extrahuje pole parametru, od 2 parametru
    }

    //upravuje dalsi promenne ze 2 vstupnich poli
    if ($pocet == 2 &&
        is_array($index) &&
        is_array($funkce))
    {
      $fun = $index;
      $par = $funkce;
      //prevedeni pole do textu a jednoho pole
      $index = $fun[0];
      $funkce = $fun[1];
      $argv = $par;
    }

    //vyhledani indexu funkce
    if (is_string($index))
    {
      $cis = $this->var->asocmoduly["index"][$index];  //vrati index tridy je-li nalezeno

      if (!is_null($cis)) //pokud najde tridu ulozi do indexu jeji cislo (poradi)
      {
        $index = $cis;
      }
        else
      {
        $this->ErrorMsg("Nepodařilo se najít třídu s názvem: \"{$index}\" !", array(__LINE__, __METHOD__));
        $index = NULL;
      }
    }

    $result = "";
    //pokud se nalezl index metody a index je i zaroven korektni cislo
    if (!is_null($index) &&
        is_numeric($index))
    { //overuje existenci funkce podle nacteni main
      if (method_exists($this->var->main[$index], $funkce))
      { //nacita podle funkci podle nacteneho objektu
        $result = call_user_func_array(array($this->var->main[$index], $funkce), $argv);  //trida::funkce, parametry
      }
        else
      if (method_exists($this->var->moduly[$index]["class"], $funkce))
      {
        $result = call_user_func_array(array($this->var->moduly[$index]["class"], $funkce), $argv);  //trida::funkce, parametry
      }
        else
      { //pokud se nepodari nalezt funkci v tride
        $this->ErrorMsg("U třídy: \"{$this->var->moduly[$index]["class"]}\" se nepodařilo načíst funkci: \"{$funkce}\" !", array(__LINE__, __METHOD__));
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
    $result = NULL;
    if (in_array($trida, $this->var->asocmoduly["index"]))
    {
      $result = $this->var->asocmoduly["index"][$trida];
      settype($result, "integer");
    }

    return $result;
  }

/**
 *
 * Najde index podle zadane tridy
 *
 * pouziti:
 * $index = $this->var->main[0]->NactiFunkci("Funkce", "NajdiIndexPodleCesty", $cesta);
 * $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]);
 *
 * @param cesta adresar modulu
 * @return cislo indexu modulu
 */
  public function NajdiIndexPodleCesty($cesta)
  {
    $result = NULL;

    //revert pro prevraceni hodnot do klicu
    $revert = array_flip(explode("/", $cesta));

    //pokud existuje klic v revertu najde ho a index pak pouzije pro orezani, pokud ne je v korenu
    $dir = (array_key_exists($this->var->dirmodule, $revert) ?
            implode("/", array_slice(explode("/", $cesta), $revert[$this->var->dirmodule], -1)) :
            ".");

    //vyhledani adresare v poli modulu
    foreach ($this->var->moduly as $index => $hodnota)
    {
      if (dirname($hodnota["include"]) == $dir)
      {
        $result = $index;
        break;
      }
    }

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

    $datum = $this->unikatni["datum_blokace_begin"];
    $tvar_data = $this->unikatni["tvar_datum_blokace"];

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
    $datum = $this->unikatni["datum_blokace_begin"];
    if (!$this->zaplaceno)  //kdyz je web nezaplaceny
    {
      if ($blok)
      {
        $dni = $this->PocetDni($datum, "now");  //do data to ted

        $penale = $this->unikatni["blokace_penale"];  //za jednotku
        $typ_jednotka = $this->unikatni["blokace_typ_jednotka"];  //typ jednotky
        $pocet_jednotka = $this->unikatni["blokace_pocet_jednotka"];  //typ jednotky

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
 * Vykresluje skrytou sekci user admin uzivatelu
 *
 * @param superadmin bool pro oznaceni checkboxu
 * @return kus formulare
 */
  private function SkrytaSekceAdminUser($superadmin = NULL)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_addedituser_skryte"],
                                        ($superadmin ? " checked=\"checked\"" : ""));

    return $result;
  }

/**
 *
 * Administrace statickych uzivatelu
 *
 * @return admin statickych uzivatelu
 */
  private function AdminUser()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_user"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["adduser"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idusergui}&amp;co=adduser" : ""),
                                        $this->VypisAdminUser());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "adduser": //pridani admina
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addedituser"],
                                              $this->unikatni["admin_addedituser_add"],
                                              $this->AdminVypisSelectPermission(NULL, $this->var->useradmin_permission),
                                              $this->NotEmpty("post", "login"),  //$_POST["login"],$_POST["login"]
                                              $this->NotEmpty("post", "jmeno"),  //$_POST["jmeno"],  $_POST["aktivni"]
                                              ($this->var->admin_mod ? $this->SkrytaSekceAdminUser() : ""),
                                              ($this->NotEmpty("post", "aktivni") ? " checked=\"checked\"" : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idusergui}");

          if ($this->ControlForm(array ("login" => array("post", "string|code"),
                                        "loginlog" => array("self", "string|2md5", $this->NotEmpty("post", "login")),
                                        "heslo" => array("post", "string|2md5"),
                                        "permission" => array("post", "integer"),
                                        "jmeno" => array("post", "string|code"),
                                        "superadmin" => array("post", "boolean"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "aktivni" => array("post", "boolean")), //+kontrola duplicity loginu
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["login"]) && !Empty($_POST["heslo"]) && !Empty($_POST["permission"]) && $this->DuplikatniHodnota("login", "useradmin", $this->ZakodujText($_POST["login"]))),
                                array("insert", "useradmin", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["login"]);
            $this->AdminAddActionLog($_POST["login"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idusergui}");  //auto kliknuti
          }
        break;

        case "edituser":  //uprava admina
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT login, loginlog, heslo, permission, jmeno, superadmin, aktivni FROM {$this->dbpredpona}useradmin
                                            WHERE id={$id} AND
                                            id!='{$this->var->useradmin_id}' AND
                                            permission!='{$this->var->useradmin_permission}';"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addedituser"],
                                                $this->unikatni["admin_addedituser_edit"],
                                                $this->AdminVypisSelectPermission($data->permission, $this->var->useradmin_permission),
                                                $this->DekodujText($data->login),
                                                $this->DekodujText($data->jmeno),
                                                ($this->var->admin_mod ? $this->SkrytaSekceAdminUser($data->superadmin) : ""),
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idusergui}");

            if ($this->ControlForm(array ("login" => array("post", "string|code"),
                                          "loginlog" => array("self", "string|2md5", $this->NotEmpty("post", "login")),
                                          "heslo" => array("post|opt", "string|2md5", $data->heslo),
                                          "permission" => array("post", "integer"),
                                          "jmeno" => array("post", "string|code"),
                                          "superadmin" => array("post", "boolean"), //, $data->superadmin
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now"),
                                          "aktivni" => array("post", "boolean")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["login"]) && !Empty($_POST["permission"]) && $id > 0),
                                  array("update", "useradmin", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["login"]);
              $this->AdminAddActionLog($_POST["login"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idusergui}");  //auto kliknuti
            }
          }
        break;

        case "deluser": //mazani admina
          $id = $_GET["id"];
          settype($id, "integer");
          //blok proti smazani sama sebe nebo admina se stejnymi pravy
          if ($id != $this->var->useradmin_id &&
              $this->ControlDeleteForm(array("useradmin" => array("permission!='{$this->var->useradmin_permission}' AND id", $id, "login")), $nazev))
          {
            $result = $this->Hlaska("del", $this->DekodujText($nazev));
            $this->AdminAddActionLog($this->DekodujText($nazev), array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idusergui}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vrati jmeno apktualne prohlaseneho uzivatele
 *
 * pouziti:
 * $jmeno = $this->var->main[0]->NactiFunkci("Fukce", "GetUserName");
 *
 * @return jmeno uzivatele
 */
  public function GetUserName()
  {
    $result = $this->var->adminuser["name"];

    return $result;
  }

/**
 *
 * Vypisuje adminy
 *
 * @return vypis adminu
 */
  private function VypisAdminUser()
  {
    $result = "";
    $tvar_datum = $this->unikatni["admin_vypis_admin_user_datum"];
    $edituser_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["edituser"];
    $deluser_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["deluser"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, login, permission, jmeno, pridano, upraveno, aktivni FROM {$this->dbpredpona}useradmin
                                              WHERE id!='{$this->var->useradmin_id}' AND
                                              permission!='{$this->var->useradmin_permission}'
                                              ORDER BY id ASC;"))
    {
      //vytvoreni pole nazvu opravneni
      $opravneni = array_combine($this->VypisPolozky("id", "permission"), $this->VypisPolozky("nazev", "permission"));
      //vypis adminu
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_admin_user"],
                                            $data->id,
                                            $this->DekodujText($data->login),
                                            $this->DekodujText($data->jmeno),
                                            $opravneni[$data->permission],
                                            date($tvar_datum, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : $this->unikatni["admin_vypis_admin_user_neupraveno"]),
                                            ($data->aktivni ? " checked=\"checked\"" : ""), //6
                                            ($edituser_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idusergui}&amp;co=edituser&amp;id={$data->id}" : ""),
                                            ($deluser_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idusergui}&amp;co=deluser&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_admin_user_null"];
    }

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
    $result = "";
    //nacitani css jen v adminu
    if (!Empty($_GET[$this->var->get_kam]) &&
        $_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      $result = "";
      $roz = explode("_", $this->NotEmpty("get", $this->var->get_idmodul));
      if (!Empty($roz[0]))
      {
        $index = $this->var->asocmoduly["idmodul"][$roz[0]];  //nacteni id modulu
      }
      settype($index, "integer");

      $nazev = basename($this->var->moduly[$index]["include"], ".php"); //extrahuje nazev bez .php
      $path = dirname($this->var->moduly[$index]["include"]);
      //nacitani hlavniho stylu modulu
      $cssfile = "{$path}/{$nazev}.css";
      if (file_exists($cssfile))  //overi existenci css file
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_nacitani_css"],
                                            $this->absolutni_url,
                                            $cssfile);
      }
      //nacitani duplikatniho stylu modulu
      $dedicnecss = "{$path}/{$this->dedicne}_{$nazev}.css";
      if (file_exists($dedicnecss)) //nacte css s vetsi specifikaci
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_nacitani_css"],
                                            $this->absolutni_url,
                                            $dedicnecss);
      }
      //nacitani tematu layoutu
      $themecss = "{$this->theme_style}/{$this->current_theme}/{$this->current_theme}.css";
      if (file_exists($themecss))
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_nacitani_css"],
                                            $this->absolutni_url,
                                            $themecss);
      }
      //nacitani permision stylu, pro skryvani/odkryvani odkazu, dle id permissio
      $permitcss = "{$this->csspermission}{$this->var->useradmin_permission}.css";
      if (file_exists($permitcss) &&
          !$this->var->admin_mod) //jen pro uzivatele
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_nacitani_css"],
                                            $this->absolutni_url,
                                            $permitcss);
      }
    }

    return $result;
  }

/**
 *
 * Nacachovani dostupnych temat
 *
 */
  private function AdminCacheTema()
  {
//dodelat!! chachovani xml pres funkci do XML!!!
    $themecesta = "{$this->dircache}/{$this->theme_cache}";
    if (!file_exists($themecesta))
    {
      $hrube_tema = $this->VypisAdresaru($this->theme_style, array("name", "asc"));
      $nazev = array();
      $cesta = array();
      foreach ($hrube_tema as $polozka)
      { //synchronizace se slozkou obrazku
        $this->ControlCreateDir(array(array($this->theme_pic, $polozka)));
        //nacitani nazvu & cesty temata
        $loadces = "{$this->theme_style}/{$polozka}/theme.name";
        if ($u = @fopen($loadces, "r"))
        {
          $loadnaz = fread($u, filesize($loadces));
          fclose($u);
        }
        $nazev[] = rtrim($loadnaz); //orezani znaku z prava
        $cesta[] = $polozka;
      }
      //slouceni nazvu a cesty do textu
      $naz = implode($this->theme_sep_nazev, $nazev);
      $ces = implode($this->theme_sep_cesta, $cesta);
      if ($u = @fopen($themecesta, "w"))
      {
        fwrite($u, implode($this->theme_sep_blok, array($naz, $ces)));
        fclose($u);
      }
    }
  }

/*
 *
 * Nacitani tematu podle prihlaseneho uzivatele
 *
 */
  private function AdminLoadTema()
  { //nacitani pro adminy
    if ($this->var->admin_mod)
    {
      //nacitani tematu pro admina
      $res = $this->ControlConfig(array("current_theme"), true,
                                  array("load|config", "{$this->dircache}/{$this->set_admin_theme}"));
      if (!Empty($res))
      {
        $this->current_theme = $res->current_theme[$this->var->adminuser["name"]];
      }
    }
    //nacitani pro admin uzivatele
    if (!Empty($this->var->useradmin_id))
    {
      $konfig = $this->VypisHodnotu("konfigurace", "useradmin", $this->var->useradmin_id);
      //nastaveni tematu
      $this->current_theme = (!Empty($konfig) ? $konfig : $this->current_theme);
    }
    //nacitani cesty
    $this->var->current_theme_dir = "/admin/theme/{$this->current_theme}";
  }

/**
 *
 * Select na vyber a nastaveni tematu
 *
 */
  private function AdminVyberTematu()
  {
    $result = "";
    $themecesta = "{$this->dircache}/{$this->theme_cache}";
    if (file_exists($themecesta))
    {
      if ($u = fopen($themecesta, "r"))
      {
        $data = explode($this->theme_sep_blok, fread($u, filesize($themecesta)));
        fclose($u);
        //nacitani a vykreslovani temat
        $nazvy = explode($this->theme_sep_nazev, $data[0]);
        $cesty = explode($this->theme_sep_cesta, $data[1]);
        //zacatek vyberu tematu
        $flipcesta = array_flip($cesty);  //obraceni pole cest pro ziskani indexu dle tematu
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tematu_begin"],
                                            $nazvy[$flipcesta[$this->current_theme]]);
        $temata = array_combine($cesty, $nazvy);  //slouceni pole na asociativni
        $arraytheme = "";
        //vypis na predrazeni temat
        foreach ($temata as $index => $hodnota)
        {
          $arraytheme[$index] = ($this->current_theme == $index);
        }
        arsort($arraytheme); //serazeni dle hodnot pospatku
        //vypis serazenych temat
        foreach ($arraytheme as $index => $hodnota)
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tematu"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;admintheme={$index}",
                                              ($this->current_theme == $index ? $this->unikatni["admin_vyber_tematu_aktivni"] : ""),
                                              $temata[$index]);
        }
        $result .= $this->unikatni["admin_vyber_tematu_end"];
      }

      //ukladani vybrane hodnoty
      $admim_theme = (!Empty($_GET["admintheme"]) ? $_GET["admintheme"] : "");
      //ukladani temata pro super adminy
      if (!Empty($admim_theme))
      { //ukladani pro adminy
        if ($this->var->admin_mod)
        {
          if ($this->ControlConfig(array("current_theme" => array("self", "array", array($this->var->adminuser["name"] => $admim_theme))), true,
                                   array("save|config", "{$this->dircache}/{$this->set_admin_theme}")))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tematu_hlaska"],
                                                $temata[$admim_theme]);
          }
        }
        //ukladani pro admin uzivatele
        if (!Empty($this->var->useradmin_id))
        {
          $this->NastavHodnotu("konfigurace", $this->ChangeWrongChar($admim_theme), "useradmin", $this->var->useradmin_id);
        }

        $this->AutoClick(0, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
      }
    }

    return $result;
  }

/**
 *
 * Porovnani md5 otisku s navratovou hodnotou pro globalni vypis
 *
 * @param md5 md5 otisk lokalniho souboru
 * @param server_md5 md5 otisk weboveho souboru na depozitu
 * @return cislo modu, 1 ok, 2 rozdil, 3 chyby
 */
  private function PorovnaniUplneAktualizace($md5, $server_md5)
  {
    $result = "";
    if (!Empty($server_md5))
    {
      $result = ($md5 == $server_md5 ? 1 : 2);
    }
      else
    {
      $result = 3;
    }

    return $result;
  }

/**
 *
 * Vraci pole pripojenych modulu
 *
 * @return pole souboru
 */
  private function PripojeneSouboryModulu()
  {
    $result = array();
    foreach ($this->var->moduly as $index => $hodnota)
    {
      $include = $hodnota["include"]; //vkladani cesty
      $class = $hodnota["class"];
      $path = dirname($include);
      $soubor = basename($include); //soubor
      $fun = ($soubor == "funkce.php");

      //cesta modulu
      if (file_exists($include))
      {
        $result[$class][] = $include;
      }

      //pripojeni podsouboru modulu
      if (!Empty($this->var->main[$index]->mount))
      {
        //vedlejsi rozsizeni k funkci
        if ($fun) //$index == 0
        {
          $this->var->main[$index]->mount = array_merge($this->var->main[$index]->mount, $this->unikatni["set_addon_mount"]); //rozsireni pripojenych souboru
        }

        //projiti podsouboru
        foreach ($this->var->main[$index]->mount as $hodnota)
        {
          if (!Empty($hodnota)) //pokud ma modul nejaky pripojny soubor
          {
            $result[$class][] = "{$path}/{$hodnota}"; //vlozeni pridavnych modulu
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Kontroluje aktualizace na repozitu
 *
 * @return formular s aktualizacema
 */
  private function AdminKontrolaAktualizace()
  {
    $set_nosize = $this->unikatni["set_aktualizace_nosize"]; //nacteni tvaru bez velikosti
    $set_datum = $this->unikatni["set_aktualizace_datum"]; //nacteni tvaru datumu
    $set_nodatum = $this->unikatni["set_aktualizace_nodatum"]; //nacteni tvaru bez datumu

    if ($this->var->administrace != $this->absolutni_url)
    { //pokud je mimo sebe sama
      $url = rawurlencode(base64_encode($this->absolutni_url));
      $soubory = $this->PripojeneSouboryModulu();
      $pole = array();
      foreach ($soubory as $trida => $hodnota)
      {
        $pole[] = "class:{$trida}";
        $pole = array_merge($pole, $hodnota);
      }
      $hash = rawurlencode(base64_encode(implode("||", $pole)));
      $retdata = $this->NactiUrl("{$this->var->administrace}", array("post" => "update={$url}&filehash={$hash}"));
      //ulozeni do cahce souboru
      $info = "";
      $cesta = "{$this->dircache}/{$this->updatefile}";
      if (!Empty($retdata))
      {
        file_put_contents($cesta, $retdata);
      }

      if (file_exists($cesta) &&
          is_file($cesta))
      { //nacteni xml ze souboru
        $xml = simplexml_load_file($cesta);
        //vypis modulu
        $row = array();
        $sum = 0;
        foreach ($xml->module as $modul)
        { //nacteni atributu
          $modul_attr = $modul->attributes();
          $modul_trida = (string)$modul_attr->class;
          $modul_cas = (int)$modul_attr->time;
          $modul_stav = (string)$modul_attr->state;
          $modul_verze = (string)$modul_attr->version;
          //vypis souboru
          $rew = array();
          $neaktualni[$modul_trida] = "";
          foreach ($modul->file as $soubor)
          { //nacteni atributu
            $soubor_attr = $soubor->attributes();
            //prevziti hodnot z xml a pretypovani
            $soubor_cesta = (string)$soubor;
            $soubor_nazev = (string)$soubor_attr->name;
            $soubor_md5_file = (string)$soubor_attr->md5;
            $soubor_filemtime = (int)$soubor_attr->mtime;
            $soubor_filesize = (int)$soubor_attr->size;
            //$soubor_stav = (string)$soubor_attr->state;
            $soubor_radku = (int)$soubor_attr->rows;

            $md5 = "";
            $datum = $velikost = 0;
            if (file_exists($soubor_cesta))
            { //nacteni mistnich hodnot pokud cesta existuje
              $md5 = md5_file($soubor_cesta);
              $datum = filemtime($soubor_cesta);
              $velikost = filesize($soubor_cesta);
            }

            $diff = $this->PorovnaniUplneAktualizace($md5, $soubor_md5_file);
            $diff_stav = "";
            switch ($diff)
            {
              case 1:
                $diff_stav = $this->unikatni["aktualizace_aktualni_hlaska"];
              break;

              case 2:
                $diff_stav = $this->unikatni["aktualizace_neaktualni_hlaska"];
                $neaktualni[$modul_trida][] = $soubor_cesta;
              break;

              case 3:
                $diff_stav = $this->unikatni["aktualizace_null_soubor"];
              break;
            }

            $rew[] = $this->NactiUnikatniObsah($this->unikatni["admin_aktualizace_row_soubor"],
                                              $soubor_nazev,
                                              (!Empty($datum) ? date($set_datum, $datum) : $set_nodatum),
                                              (!Empty($soubor_filemtime) ? date($set_datum, $soubor_filemtime) : $set_nodatum),
                                              (!Empty($velikost) ? $this->Velikost($velikost) : $set_nosize),
                                              (!Empty($soubor_filesize) ? $this->Velikost($soubor_filesize) : $set_nosize),
                                              $diff_stav);

            $sum += $soubor_radku;
          }

          $v = "v_{$modul_trida}";  //vytvoreni jmena konstanty
          $verze = (defined($v) ? constant($v) : "");

          $stav= "";
          switch ($modul_stav)
          {
            case "ok":
              if (!Empty($neaktualni[$modul_trida]))
              {
                $stav = $this->unikatni["aktualizace_neaktualni_hlaska"];
              }
                else
              {
                $stav = $this->unikatni["aktualizace_aktualni_hlaska"];
              }
            break;

            case "error":
              $stav = $this->unikatni["aktualizace_null_soubor"];
            break;
          }

          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_aktualizace_row"],
                                            $modul_trida,
                                            ($modul_stav == "ok" ? "[ tu: {$verze} / {$modul_verze} ]" : "( tu: {$verze} )"),
                                            date($set_datum, $modul_cas),
                                            $stav,
                                            implode("", $rew));
        }
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_aktualizace"],
                                          implode("", $row),
                                          $this->MezeraCisla($sum));

      if (Empty($retdata))
      { //pridani hlasky
        $result .= $this->Hlaska("warning", "Nepodařilo se stáhnout aktuální seznam modulů");
      }
    }
      else
    {
      $result = "kontrola akutalizaci na admin.gfko.cz na webu...!!!!!!!! comming soon...";
    }

    return $result;
  }

/**
 *
 * Zpracovava aktualizace na webu
 *
 * @return tisk xml s informacemi o aktualizacich
 */
  private function KomunikaceFukce()
  {
    $update = $this->NotEmpty("post", "update");
    $url = base64_decode(rawurldecode($update));
    if (!Empty($update) &&
        $url != $this->absolutni_url)
    {//jen na adminu + prepset to xml malinko! dodelat!!
      //nacte pole souboru pro overovani
      $hash = explode("||", base64_decode(rawurldecode($_POST["filehash"])));
      //vytvori si xml a projde zadane soubory
      $xml = new SimpleXMLElement("<update></update>");
      $class = "";
      foreach ($hash as $index => $soubor)
      {
        $a = explode("class:", $soubor);
        //pokud se jedna o tridu modulu
        if (!Empty($a[1]))
        {
          $class = $a[1];
          $v = "v_{$class}";  //vytvoreni jmena konstanty
          //pokud je verze nedefinovana
          if (!defined($v))
          { //nacteni souboru modulu
            $cesta = $hash[$index + 1];
            if (file_exists($cesta) &&
                is_file($cesta))
            {
              include_once($hash[$index + 1]);
            }
          }
          //<modul class="" version="" time="" state=""></modul>
          $modul = $xml->addChild("module");
          $modul->addAttribute("class", $class);
          $modul->addAttribute("version", (defined($v) ? constant($v) : ""));
          $modul->addAttribute("time", strtotime("now"));
          $modul->addAttribute("state", "ok");
        }
          else
        {
          //<file name="" md5="" mtime="" size="" state="" rows=""></file>
          $row = $modul->addChild("file", $soubor);
          $row->addAttribute("name", basename($soubor));
          $row->addAttribute("md5", md5_file($soubor));
          $row->addAttribute("mtime", filemtime($soubor));
          $row->addAttribute("size", filesize($soubor));
          $row->addAttribute("state", (file_exists($soubor) ? "ok" : "error"));
          if (!file_exists($soubor))
          { //pokud chyby nejaka soucast zhodi stav na error
            $modul->attributes()->state = "error";
          }
          $ext = pathinfo($soubor, PATHINFO_EXTENSION); //zjisteni koncovky, pocita jen PHP soubory
          $row->addAttribute("rows", (file_exists($soubor) && $ext == "php" ? count(file($soubor)) : 0));
        }
      }
      echo $xml->asXml();
      exit(0);
    }
  }

/**
 *
 * Vypisuje error logy
 *
 * @return vypis logu
 */
  private function AdminVypisErrorLogu()
  {
    if (file_exists($this->errorlogdir))
    {
      $vyber = $this->NotEmpty("get", "date");
      $tvar_datum = $this->unikatni["admin_tvar_datum"];

      $co = $this->NotEmpty("get", "co");

      $vypis = "";
      switch ($co)
      {
        case "view":
          $log = "{$this->errorlogdir}/{$vyber}"; //otevreni vybraneho souboru
          $obsah = "";
          if ($u = @fopen($log, "r"))
          {
            $obsah = explode("--end--", fread($u, (filesize($log) == 0 ? 1 : filesize($log))));
            fclose($u);
          }

          if (count($obsah) > 1)  //pokud je pocet polozek > 1, 1 je standartne prazdna
          {
            $c_obsah = count($obsah) - 1;
            for ($i = ($c_obsah - 1); $i >= 0; $i--)  //vypis pole po spatku
            {
              $ret = explode("|-x-|", $obsah[$i]);
              //$ret[4] = $this->var->error_code[$ret[4]];  //typ chyby
              $ret = array_splice($ret, 0, -1); //odstraneni posledniho indexu
              $ret[] = $i; //(!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? gethostbyaddr($ret[6]) : $ret[6]);
              $ret[] = date($tvar_datum, strtotime($ret[5]));
              $sys = $this->TypSystemu($ret[7]);
              $ret[] = $sys->browser;
              $ret[] = $sys->os;
              //$ret[] = $this->TypBrowseru($ret[7]);
              //$ret[] = $this->TypOS($ret[7]);

              $vypis .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_error_log_radek"],
                                                  $ret);
            }
          }
            else
          {
            $vypis = $this->unikatni["admin_vypis_error_log_radek_null"];
          }
        break;
      }

      $odkazy = array();
      $pocet = 0;
      $soubor = $this->VypisSouboru($this->errorlogdir, array("date", "desc"));
      if (is_array($soubor))
      {
        foreach ($soubor as $data)
        {
          $file = "{$this->errorlogdir}/{$data}";
          if ($u = @fopen($file, "r"))
          {
            $pocet = count(explode("--end--", fread($u, (filesize($file) == 0 ? 1 : filesize($file))))) - 1;
            fclose($u);
            //podminka aktivni polozky
            $podm = ($vyber == $data);
            $odkazy[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_error_log_odkaz"],
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iderror}".(!$podm ? "&amp;co=view&amp;date={$data}" : ""),
                                                  $data,
                                                  $pocet,
                                                  date($tvar_datum, filemtime($file)),
                                                  ($podm ? $this->unikatni["admin_vypis_error_log_aktivni"] : ""),
                                                  ($podm ? $vypis : ""));
          }
        }
      }
        else
      {
        $odkazy[] = $this->unikatni["admin_vypis_error_log_null"];
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_error_log"],
                                          implode("", $odkazy));
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

    if (!Empty($_GET[$this->var->get_kam]) &&
        $_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      foreach ($admin_menu as $hodnota)
      {
        if (!Empty($_GET[$this->var->get_idmodul]) &&
            $_GET[$this->var->get_idmodul] == $hodnota["main_href"])
        {
          $result = $hodnota["title"]; //navrat nalezeneho title
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
  public function CallAdminMenu($admin_menu, $predani)
  {
    static $result = "";  //staticky result, v poslednim kroku se vraco kompletni menu

    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      static $pocit = 0;  //staticke pocitadlo indexu funkce

      foreach ($admin_menu as $hodnota)
      {
        $rozdel = explode("_", $hodnota["main_href"]);  //kalkulace zanoreni

        //prekladani prvku do druheho pole
        $result[$pocit] = array("zanoreni" => count($rozdel),
                                "main_href" => $hodnota["main_href"],
                                "odkaz" => $hodnota["odkaz"],
                                "title" => $hodnota["title"],
                                //"id" => $hodnota["id"],
                                //"class" => $hodnota["class"],
                                //"akce" => $hodnota["akce"],
                                "parent" => $predani  //predani rodice
                                );

        $pocit++; //pocita volani
      }
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
    if ($this->var->aktivniadmin)
    {
      $modul = explode("_", $this->NotEmpty("get", $this->var->get_idmodul));  //rozsekani adresy modulu
      $index = (!Empty($this->var->asocmoduly["idmodul"][$modul[0]]) ? $this->var->asocmoduly["idmodul"][$modul[0]] : 0);
      settype($index, "integer"); //konvert na integer
      $result = $this->var->main[$index]->PredaniAdminTitle();
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
    //vykresluje se jen v adminu
    if (!Empty($_GET[$this->var->get_kam]) &&
        $_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      $arraymenu = "";
      $namemodule = "";
      $hide_permit = "Funkce|-|funkce_permit|x|allowpermitedit";  //sekce permission na skryvani
      foreach ($this->var->moduly as $index => $modul)  //vytahani dat z modulu
      {
        if ($modul["admin"])  //nacitani jen modulu s adminem
        {
          if (method_exists($this->var->main[$index], "PredaniAdminMenu")) //$this->var->moduly[$i]["class"]
          {
            $arraymenu = $this->var->main[$index]->PredaniAdminMenu($modul);  //nacteni menu z modulu
            $namemodule[$modul["class"]] = $this->var->main[$index]->namemodule;  //nacitani nazvu modulu
          }
            else
          {
            $this->ErrorMsg("Modul menu z třídy: \"{$modul["class"]}\" se nepodařilo načíst, aktualizujte jej prosím !", array(__LINE__, __METHOD__));
          }
        }
      }
      $this->arraymenu = $arraymenu;  //nacteni pole menu pro permission

      //zacatek menu
      $result .= $this->NactiUnikatniObsah($this->unikatni["tvar_admin_menu_begin"],
                                          30, //kazdych Xs obnova casu
                                          $this->absolutni_url,
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idlogoff}",
                                          date("H:i"),
                                          date("j.n.Y"),  //5
                                          $this->AdminVyberTematu());

      $blokace = "";
      //jen pokud je naplnene pole permission
      if (is_array($this->var->admin_permit))
      { //prednachystani si permit pole pro spravne obalovani polozek menu usera
        $permit_pole = array();
        //nacteni bool superadmina pro vytvoreneho admina
        $user_permit = $this->VypisHodnotu("superadmin", "useradmin", $this->var->useradmin_id);
        //projiti pole menu a vyber jen user polozek
        foreach ($arraymenu as $polozka)
        { //skladani permission adresy
          $permit_adresa = "{$polozka["parent"]["class"]}|-|{$polozka["main_href"]}|x|";
          //overovaci podminka na skryvani polozek
          if (in_array($permit_adresa, $this->var->admin_permit) && //je povolene zobrazeni
              ($user_permit ? true : "{$permit_adresa}allowpermitedit" != $hide_permit))  //schovani permission uzivatelum
          {
            $permit_pole[] = $polozka["parent"]["class"];
          }
        }
      }

      //pokud je arraymenu pole
      if (is_array($arraymenu))
      {
        $obsah = "";
        $poc = 0;
        $c_arraymenu = count($arraymenu); //spocitani polozek
        foreach ($arraymenu as $index => $polozka)
        {
          settype($polozka["zanoreni"], "integer"); //konvert na cislo
          //overovani aktivni adresy
          $podminka = (!Empty($_GET[$this->var->get_idmodul]) &&
                      $_GET[$this->var->get_idmodul] == $polozka["main_href"]);
          //neopravneny pristup do sekce
          if ((!is_array($this->var->admin_permit) && //permit musi byt prazdny (umoznuje na zaklade permission vsoupit i do jinych sekci)
              !$this->var->admin_mod &&
              $podminka) || //nebo je negace opravneni
              !$this->OverovaniPermission()
              )
          { //vlozeni adresy pro presmerovani zpet do adminu
            echo $this->NactiUnikatniObsah($this->unikatni["admin_menu_user_ban"],
                                          "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}");
            exit(0);
          }
          //seskladani href odkazu
          $href = (!Empty($polozka["main_href"]) ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$polozka["main_href"]}" : "");
          $obsah = array ("array_args",
                          "{$this->absolutni_url}{$href}",
                          $polozka["odkaz"],
                          $polozka["title"],
                          "",//"nic",//$polozka["id"],
                          ($podminka ? $this->unikatni["tvar_aktivni_id"] : ""),
                          "",//"nic",//$polozka["class"],
                          ($podminka ? $this->unikatni["tvar_aktivni_class"] : ""),
                          $polozka["zanoreni"],
                          "",//"nic",//$this->BackChangeChar($polozka["akce"]),
                          $index, //10
                          $namemodule[$polozka["parent"]["class"]][($this->var->admin_mod ? 0 : 1)],
                          ($index == 0 ? $this->unikatni["tvar_aktivity_prvni"] : ""),
                          ($index == $c_arraymenu - 1 ? $this->unikatni["tvar_aktivity_posledni"] : ""),
                          ((($index + $this->unikatni["tvar_ente_od"]) % $this->unikatni["tvar_ente_po"]) == 0 ? $this->unikatni["tvar_aktivity_ente_odpo"] : ""),
                          (in_array($index, $this->unikatni["tvar_ente_array"]) ? $this->unikatni["tvar_aktivity_ente_array"] : ""),
                          ($podminka ? $this->unikatni["tvar_aktivity_volitelny_text"] : ""),
                          ($podminka ? $this->unikatni["tvar_aktivity_odkazu_LP"][0] : ""),
                          ($podminka ? $this->unikatni["tvar_aktivity_odkazu_LP"][1] : ""),
                          $polozka["parent"]["class"],
                          $polozka["parent"]["uloziste"]);

          //generovani textu na kontrolu permit
          $permit_adresa = "{$polozka["parent"]["class"]}|-|{$polozka["main_href"]}|x|";
          $begin_obal = $this->NactiUnikatniObsah($this->unikatni["admin_menu_obal_begin"], $obsah);
          $end_obal = $this->NactiUnikatniObsah($this->unikatni["admin_menu_obal_end"], $obsah);
//var_dump(count($arraymenu));
          //admin menu, obalovani probiha zvlast
          if ($this->var->admin_mod)
          {
            $result .= ($polozka["parent"]["class"] != (($index - 1) >= 0 ? $arraymenu[$index - 1]["parent"]["class"] : "") ? $begin_obal : "");
            $result .= $this->NactiUnikatniObsah($this->unikatni["tvar_admin_menu"],
                                                $obsah);
            $result .= ($polozka["parent"]["class"] != (($index + 1) < count($arraymenu) ? $arraymenu[$index + 1]["parent"]["class"] : "") ? $end_obal : "");
          }
            else
          {
            //uzivatelske menu
            if (is_array($this->var->admin_permit) && //pokud je permit pole
                in_array($permit_adresa, $this->var->admin_permit) && //pokud je permit adresa v poli opravneni
                ($user_permit ? true : "{$permit_adresa}allowpermitedit" != $hide_permit))  //schovani permission uzivatelum
            { //povolena polozka menu dle permission
              $result .= ($polozka["parent"]["class"] != $this->NotEmpty($permit_pole, $poc - 1) ? $begin_obal : ""); //$permit_pole[$poc - 1]
              $result .= $this->NactiUnikatniObsah($this->unikatni["tvar_admin_menu_permit"],
                                                  $obsah);
              $result .= ($polozka["parent"]["class"] != $this->NotEmpty($permit_pole, $poc + 1) ? $end_obal : ""); //$permit_pole[$poc + 1]
              $poc++;
            }
          }
        }
      }
    }

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
    if ($this->var->aktivniadmin)
    {
      $modul = explode("_", $this->NotEmpty("get", $this->var->get_idmodul));  //rozsekani adresy modulu
      $index = (!Empty($this->var->asocmoduly["idmodul"][$modul[0]]) ? $this->var->asocmoduly["idmodul"][$modul[0]] : 0);
      settype($index, "integer"); //konvert na integer
      $result = $this->var->main[$index]->AdminObsah();
    }

    return $result;
  }

/**
 *
 * Generovani css pro zobrazovani odkazu pro uzivatele
 *
 * @param id cislo id permission
 */
  public function GenerovaniCssPermisson($idpermit)
  {
    if (!Empty($idpermit))
    {
      $cesta = "{$this->csspermission}{$idpermit}.css";
      if ($u = @fopen($cesta, "w"))
      {
        $this->dbpredpona = $this->NastavKomunikaci($this->var, 0);
        if (!$this->PripojeniDatabaze($error))
        {
          var_dump($error, array(__LINE__, __METHOD__));
        }
        //nacteni opravneni co se ma ignorovat
        $opravneni = explode($this->permexplode, $this->VypisHodnotu("opravneni", "permission", $idpermit));
        //znovunastaveni komunikace
        $this->var = new Promenne();  //vytvoreni promennych
        $this->var->main[0] = new Funkce($this->var, 0);  //vytvoreni funkce
        $this->var->main[0]->InicializaceModulu($null); //nastartuje dodatecne funkce

        $hidepole = array();
        //vypis modulu
        foreach ($this->var->main as $index => $modul)
        {
          $trida = $this->var->moduly[$index]["class"];
          //pokud je permit pole
          if (is_array($modul->permit))
          {
            //vypis sekci
            foreach ($modul->permit as $indexsekce => $sekce)
            {
              if (!Empty($indexsekce))
              {
                //vypis odkazu
                foreach ($sekce as $indexodkaz => $odkaz)
                {
                  if (!Empty($indexodkaz))
                  { //seskladani adresy na kontrolu
                    $adresa = "{$trida}|-|{$indexsekce}|x|{$indexodkaz}";
                    //pokud neni v poli skryje
                    if (!in_array($adresa, $opravneni))
                    {
                      $hidepole[] = ".obal_{$indexsekce} .{$indexodkaz}";
                    }
                  }
                }
              }
            }
          }
        }
        //sloupceni pole prvku na skryti
        $skryt = implode(",\n", $hidepole);
        $result = "/**
 *
 * Styly pro skupinu oprávnění: {$idpermit}
 *
 */

{$skryt} {
  display: none !important;
}
";

        fwrite($u, $result);
        fclose($u);
      }
        else
      {
        if (!is_writable($this->csspermission))
        {
          var_dump("nelze zapsat: <strong>{$cesta}</strong>", array(__LINE__, __METHOD__));
        }
      }
    }
  }

/**
 *
 * Overovani jestli aktualni adresa je ve white listu (tedy povolena)
 *
 * @return bool o pristupu, false = zakazano
 */
  public function OverovaniPermission()
  {
    $result = true;
    if (is_array($this->var->admin_permit))
    {
      $modul = explode("_", $_GET[$this->var->get_idmodul]);  //rozdeleni adresy modulu
      //nacteni indexu do pole modulu
      $index = (!is_null($this->var->asocmoduly["idmodul"][$modul[0]]) ? $this->var->asocmoduly["idmodul"][$modul[0]] : 0);
      $adresa = "{$this->var->moduly[$index]["class"]}|-|{$_GET[$this->var->get_idmodul]}|x|{$this->NotEmpty("get", "co")}";  //$_GET["co"]
      $result = in_array($adresa, $this->var->admin_permit);
    }

    return $result;
  }

/**
 *
 * Manualni overovani opravneni pro podrobnejsi kontrolu
 *
 * @param class trida modulu
 * @param id_modul id modulu
 * @param co koncova adresa
 * @return bool o povoleni pristupu
 */
  public function ManualPermission($class = NULL, $id_modul = NULL, $co = NULL)
  {
    $logid = $this->GetSessionUser(true);
    if (Empty($this->var->admin_permit) &&
        !$this->var->admin_mod &&
        $logid > 0)
    {
      //v pripade pripojeni z ajaxu
      $this->StartFunkce(); //nacteni modulu z cache
      $this->NastavKomunikaci($this->var, 0, true, "manperm");
      $cesta = $this->ZjistiCestu(true);
      $this->NastavCestu("{$this->AdresarWebu()}/{$this->FileVynorovani($cesta)}");
      if (!$this->PripojeniDatabaze($error))
      {
        var_dump($error, array(__LINE__, __METHOD__));
      }
      $loginf = $this->GetSessionUser();
      $this->Autorizace($loginf[0], $loginf[1], false);
      $this->NavratPripojeni();
    }

    //pokud je permit pole kontroluje opravneni
    $result = ($logid < 0); //pokud je super admin tak je defaultni false
    if (is_array($this->var->admin_permit))
    {
      $modul = explode("_", $this->NotEmpty("get", $this->var->get_idmodul));  //rozdeleni adresy modulu
      $index = (!Empty($this->var->asocmoduly["idmodul"][$modul[0]]) ? $this->var->asocmoduly["idmodul"][$modul[0]] : 0);

      $trida = (isset($class) ? $class : $this->var->moduly[$index]["class"]);
      $id = (isset($id_modul) ? $id_modul : $_GET[$this->var->get_idmodul]);
      $c = (isset($co) ? $co : $_GET["co"]);
      $adresa = "{$trida}|-|{$id}|x|{$c}";
      $result = in_array($adresa, $this->var->admin_permit);
    }
//var_dump($result);
//var_dump($logid, $result, $this->var->admin_permit);
    return $result;
  }

/**
 *
 * Pripojeni zadaneho modulu dle indexu
 *
 * @param index index modulu v promenne moduly[]
 * @param promenna pole promennych na vraceni
 * @return ukazatel na tridu a nebo zadana promenna
 */
  public function ConMod($index, $promenna = NULL)
  {
    $result = "";
    $this->StartFunkce(); //nacteni modulu z cache
    if (!is_null($index) &&
        !Empty($this->var->moduly[$index]["include"]))
    { //nacte tridu
      include_once $this->var->moduly[$index]["include"];
      $res = new $this->var->moduly[$index]["class"]();  //vytvori tridu
      if (is_array($promenna))
      {
        foreach ($promenna as $polozka)
        {
          switch ($polozka)
          {
            case "class": //vrati nazev tridy
              $result->class = $this->var->moduly[$index]["class"];
            break;

            default:  //vrati hodnotu public promenne
              $result->$polozka = $res->$polozka;
            break;
          }
        }
      }
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
    $result = "";
    $endtime = date(strtotime($this->var->admin_expire, $_SERVER["REQUEST_TIME"]));
    $tvar_datum = $this->unikatni["admin_tvar_datum_paticka"];

    $cesta = "{$this->dircache}/{$this->cachexmloutside}";
    if (file_exists($cesta) &&
        is_file($cesta))
    {
      $xml = simplexml_load_file($cesta);
      $result = $this->NactiUnikatniObsah($this->unikatni["text_cas_aktualizace"],
                                          date($tvar_datum, $_SERVER["REQUEST_TIME"]),
                                          date($tvar_datum, $endtime),
                                          $this->var->admin_expire,
                                          (string)$xml->nastaveni->datumoddo);
    }
      else
    {
      $result = $this->Hlaska("warning", "Nejsou nacachovany hodnoty");
    }

    return $result;
  }

/**
 *
 * Akceptuje zadane prohlizece pri prihlasovani
 *
 * pouziti:
 * $text = ($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece") ? "access" : "deny access");
 *
 * @return true/false - akceptoval/neakceptoval
 */
  public function AkceptujProhlizece()
  {
    $result = false;
    $loguser = $this->GetSessionUser(); //zjisteni session
    if ($loguser && //nesmi byt false
        Empty($loguser[0]) &&
        Empty($loguser[1]))
    { //pokud neni nikdo prihlaseny
      $prohlizece = $this->unikatni["set_prohlizece"];  //povolene prohlizece
      $curbrow = $this->GetBrowser(); //aktualni prohlizec
      //aktualni verze musi byt vetsi nebo rovna minimalni nastavene
      $result = (!Empty($curbrow->browser) && //neni prazdny browser
                array_key_exists($curbrow->browser, $prohlizece) &&  //prohlizec musi byt ve vyctu povolenych
                $curbrow->version >= $prohlizece[$curbrow->browser] &&  //musi sedet verze
                $curbrow->cssversion >= 3); //musi umet css3
    }
      else
    { //pokud je sesion user false
      $result = true;
    }

    return $result;
  }

/**
 *
 * Zjistli jestli je prihodne zobrazit link na navrat do adminu
 *
 * @return bool na zobrazeni lindu zpet do adminu
 */
  public function ZobrazitLinkAdmin()
  {
    $logid = $this->GetSessionUser();
    $result = (!Empty($logid[0]) &&
              !Empty($logid[1]) &&
              !Empty($_COOKIE["ADMIN{$this->cookie_url}LASTURL"]));

    return $result;
  }

/**
 *
 * Vraci back link do adminu
 *
 * @return back link
 */
  public function BackLinkAdmin()
  {
    $result = (!Empty($_COOKIE["ADMIN{$this->cookie_url}LASTURL"]) ?
                htmlspecialchars($_COOKIE["ADMIN{$this->cookie_url}LASTURL"]) :
                "{$this->var->get_kam}={$this->var->adresaadminu}");

    return $result;
  }

/**
 *
 * Provadi prihlaseni do adminu
 *
 */
  private function Prihlasovani()
  {
    $nextdate = strtotime($this->var->admin_expire);  //prevypocet casu
    $getkam = (!Empty($_GET[$this->var->get_kam]) ? $_GET[$this->var->get_kam] : "");
    switch ($getkam)
    {
      case "expirelogoff":  //auto odhlaseni
        $this->AdminAddActionLog($this->GetUserName(), array(__LINE__, __METHOD__), null, $_GET[$this->var->get_kam]);
        $this->DelSessionUser();
        $this->AutoClick(0, $this->absolutni_url);
      break;

      case "logoff":  //manualni odhlaseni //tvrde odhlaseni z adminu
        $this->AdminAddActionLog($this->GetUserName(), array(__LINE__, __METHOD__), null, $_GET[$this->var->get_kam]);
        $this->DelSessionUser();
        SetCookie("ADMIN{$this->cookie_url}LASTURL", "", Time() + 31536000);
        $this->AutoClick(0, $this->absolutni_url);
      break;
    }

    $login = (!Empty($_POST["log_ad"]) ? $this->ChangeWrongChar($_POST["log_ad"]) : "");
    $heslo = (!Empty($_POST["log_he"]) ? $this->ChangeWrongChar($_POST["log_he"]) : "");

    if (!Empty($_POST["tl_log"]) &&
        !Empty($login) &&
        !Empty($heslo) &&
        $this->OverovaniBanIp(array("self", $login, true)) &&  //overeni ip-ban
        $this->AkceptujProhlizece())  //checkuje prohlizec
    {
      $this->RegenerateSession(); //pred prihlasenim se musi regenerovat session id!!
      if ($this->Autorizace($login, $heslo))  //kdyz je prihaseno
      {
        $this->AdminAddLog($login); //zalogovani vstupu
        $this->AdminAddActionLog($this->GetUserName(), array(__LINE__, __METHOD__), null, "login");
        //admin
        $this->var->aktivniadmin = true;
        SetCookie("ADMIN{$this->cookie_url}TIME", $nextdate, Time() + 31536000);  //zapis do cookie
        $autourl = (!Empty($_COOKIE["ADMIN{$this->cookie_url}LASTURL"]) ?
                    htmlspecialchars($_COOKIE["ADMIN{$this->cookie_url}LASTURL"]) :
                    "{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");
        $this->AutoClick(0, "{$this->absolutni_url}?{$autourl}");
      }
        else
      {
        $this->AdminAddLog($login, $heslo); //zalogovani pri chybe
        //admin
        $this->var->aktivniadmin = false;
      }
    }
      else
    {
      $logid = $this->GetSessionUser(); //nacteni
      if (!Empty($_GET[$this->var->get_kam]) &&
          $_GET[$this->var->get_kam] == $this->var->adresaadminu &&
          $this->Autorizace($logid[0], $logid[1], false) &&
          $this->OverovaniBanIp(array("self", $logid[0])) &&  //overeni ip-ban
          $this->AkceptujProhlizece())  //pro admin, checkuje prohlizec
      {
        //admin
        $this->var->aktivniadmin = true;
        //obnoveni aktualni adresy
        SetCookie("ADMIN{$this->cookie_url}LASTURL", $_SERVER["QUERY_STRING"], Time() + 31536000);  //pro zpetne vraceni na dane misto
        if ($_COOKIE["ADMIN{$this->cookie_url}TIME"] < $_SERVER["REQUEST_TIME"]) //<= $exp($_SERVER["REQUEST_TIME"] > $_SESSION["ADMIN:{$this->cookie_url}"]["TIME"])  //expire
        {
          SetCookie("ADMIN{$this->cookie_url}LASTURL", $_SERVER["QUERY_STRING"], Time() + 31536000); //pro zpetne vraceni na dane misto
          //pri expiraci vypadne
          $this->AutoClick(0, "{$this->absolutni_url}?{$this->var->get_kam}=expirelogoff"); //kdyz vyprsi cas expirace tak autoclick
        }
        //posun expirace
        SetCookie("ADMIN{$this->cookie_url}TIME", $nextdate, Time() + 31536000); //update casu do cookie
      }
        else
      {
        $this->var->aktivniadmin = false; //pro stranky
        //v adminu pri expiraci
        if (!Empty($_COOKIE["ADMIN{$this->cookie_url}TIME"]) &&
            $_COOKIE["ADMIN{$this->cookie_url}TIME"] < $_SERVER["REQUEST_TIME"] &&  //presmerovani pri vyprseni
            !Empty($_GET[$this->var->get_kam]) &&
            $_GET[$this->var->get_kam] == $this->var->adresaadminu)
        {
          SetCookie("ADMIN{$this->cookie_url}LASTURL", $_SERVER["QUERY_STRING"], Time() + 31536000); //pro zpetne vraceni na dane misto
          //pri expiraci v adminu
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
    $result = Abs(Round(($this->konec - $this->start) * 10000) / 10000); //Abs, vypocet

    return $result;
  }

/**
 *
 * Vypis chyby v html
 *
 * pouziti:
 * $this->var->main[0]->NactiFunkci("Funkce", "ErrorMsg", "text chyby", array(__LINE__, __METHOD__));
 * presmerovava z default modulu
 * v modulech ktere dedi default_modul:
 * pouziti:
 * $this->ErrorMsg("text chyby", array(__LINE__, __METHOD__)[, "info"/"crit"]);
 *
 * @param chyba text chyby
 * @param poloha poloha chyby se vstupem: array(__LINE__, __METHOD__)
 * @param typ typ chyby(?! prakticky nevyuzito...)
 */
  public function ErrorMsg($chyba, $poloha = array(0, NULL, NULL), $tisk = false)
  {
    static $volani = 0;

    //pokud je chyba textove pole
    if (is_array($chyba))
    {
      $chyba = implode(", ", $chyba);
    }
//dodelat!!!
//cpat pres globalni php chybu s grafikou martina!!!!!
    if ($tisk)
    {
      echo $this->Hlaska("warning", $chyba, $poloha);
    }

    $this->var->chyba[$volani] = array("chyba" => $chyba,
                                        "poloha" => $poloha,
                                        "typ" => "info");

    $volani++;
  }

/**
 *
 * Vytiskne vsechny vyvolane chyby
 *
 */
  public function VypisVsechnyChyby()
  {
    //odchytavani dotazu z adminu
    $web = $this->NotEmpty("get", "wr");
    //pokud je pripojeni mimo admin
    if (!(!Empty($_GET[$this->var->get_kam]) &&
        $_GET[$this->var->get_kam] == $this->var->adresaadminu) &&
        !Empty($web))
    {
      $roz = explode("--", base64_decode($web));
      $url = $this->DekodujText($roz[0]);
      //kdyz souhlasi web adresa tak generuje xml reportu
      if ($url == $this->absolutni_url)
      {
        //dodelat!! predelat XML a komunikaci!
        //generuje vsechny dostupne reporty
        $xml = new SimpleXMLElement("<layout></layout>");
        //vypis reportu
        if ($res = $this->queryMultiObjectSingle("SELECT id, login, email, predmet, message, pridano, ip, agent
                                                  FROM {$this->dbpredpona}reporty;"))
        {
          $i = 0;
          foreach ($res as $data)
          { //zpracovani do xml
            $xml->reporty[$i]->id = $data->id;
            $xml->reporty[$i]->login = $data->login;
            $xml->reporty[$i]->email = $data->email;
            $xml->reporty[$i]->predmet = $data->predmet;
            $xml->reporty[$i]->message = $data->message;
            $xml->reporty[$i]->pridano = $data->pridano;
            $xml->reporty[$i]->ip = $data->ip;
            $xml->reporty[$i]->agent = $data->agent;
            $i++;
          }
        }
//dodelat!! + mozna predavat i error log? a nebo nejake statistiky?
        //nastaveni hlavicky
        header("Content-type: text/xml");
        echo $xml->asXml();
        exit(0);
      }
    }

    $chyby = $this->var->chyba;

    $this->ZavritDatabaze();  //tady uzavre databazi







//dodelat!!!!!
//a poresit jinak!!!! treba pres session!!!!
//ale ukladat ihned!!! a univerzalneji!!!!
//toto nejak doresit?!!!
    $result = "";
    if (is_array($chyby) && count($chyby) > 0)  //je-li nejaka chyba
    {
      $kriticka = 0;
      $ret = array();
      foreach ($chyby as $polozka)
      {
        $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_centralni_hlaska_error_row"],
                                          $polozka["chyba"],
                                          $polozka["poloha"][0],
                                          $polozka["poloha"][1]);

        if ($polozka["typ"] == "crit")  //detekce kryticke chyby
        {
          $kriticka++;
        }
      }

      $this->ErrorLog($chyby);  //logovani chyb
      //vypis chyb do globalni hlasky
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_centralni_hlaska_error"],
                                          implode("\n", $ret));

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

    $filedatum = date("d-m-Y");
    $soubor = "{$this->errorlogdir}/errorlog-{$filedatum}.txt";
    if ($u = @fopen($soubor, "a"))
    {
      $tvar = "";
      foreach ($chyby as $polozka)
      {
//dodelat!! predelat!!! aby tyto veci z erroru slucoval pod jednim indexem!!!!
        $tvar = array("array_args",
                      $polozka["chyba"],
                      $polozka["poloha"][0],
                      $polozka["poloha"][1],
                      (!Empty($polozka["poloha"][2]) ? $polozka["poloha"][2] : ""),
                      $cas,
                      $ip,
                      $agent,
                      "--end--");

        fwrite($u, implode("|-x-|", $tvar));
        $tvar = ""; //po zapsani vymazat!
      }

      fclose($u);
    }
  }

/**
 *
 * Funkce na vygenerovani error_page stranek
 *
 */
  private function GenerovaniErrorPage()
  {
    $result = "";
    if (file_exists($this->errorpage) &&  //kdyz exstuje slozka
        !file_exists("{$this->errorpage}/{$this->errorblok}"))  //pokud neexistuje blokovac
    {
      $pageerror = $this->unikatni["error_page_text"];  //nacteni pole textu
      $errorsablona = $this->unikatni["error_page_sablona"];  //nacteni sablony
      //prochazeni zadanych error stranek
      foreach ($pageerror as $polozka)
      {
        $pole = $polozka;
        $pole["absolutni_url"] = $this->absolutni_url;  //prida absolutni cestu
        $pole["errorpage"] = $this->errorpage;
        $pole["nazevwebu"] = $this->var->nazevwebu; //prida nazev webu
        $klice = array_keys($pole); //nezme klice
        $page = $errorsablona;  //zkopiruje obsah sablony

        $c_pole = count($pole);
        for ($j = 0; $j < $c_pole; $j++) //vepsani do sablony
        {
          $page = str_replace("%%{$klice[$j]}%%", $pole[$klice[$j]], $page);
        }
        //var_dump("{$this->errorpage}/{$pole["kod"]}.html");
        //zapsani do souboru
        if ($u = @fopen("{$this->errorpage}/{$pole["kod"]}.html", "w"))
        {
          fwrite($u, $page);
          fclose($u);

          $result .= $this->Hlaska("add", "{$this->errorpage}/{$pole["kod"]}.html");
        }
      }
      //vytvoreni souboru pro blokaci
      if ($u = @fopen("{$this->errorpage}/{$this->errorblok}", "w"))
      {
        fwrite($u, date("Y-m-d H:i:s")); //vlozi datum vyvoreni
        fclose($u);
      }
    }

    return $result;
  }

/*
 * url serveru: $_SERVER["SERVER_NAME"]
 * d.m.Y / H:i:s
 * header("Location: {$this->AbsolutniUrl()}");
 * ini_set("memory_limit", "100M");  //nasosne si 100MB
 * header('Content-type: text/html; charset=UTF-8');
 * onclick="return AddFavorite(this,document.location.href,document.title);"+skrypt
 * , array(__LINE__, __METHOD__, $sql)
  <label>
    <span>text:</span>
    <input>
  </label>
 * $start = $this->MeritCas();
 * $konec = $this->MeritCas();
 * var_dump($this->KalkulaceCas($start, $konec));
 * žluťoučký kůň ůpěl dábělské tóny
 *
 * $dat = new DateTime("now");
 * var_dump($dat->format("Y-m-d H:i:s"));
 * glob()
 * pathinfo (, PATHINFO_EXTENSION)
 * ini_set("memory_limit", "100M");  //rezervuje vic mega
 * ini_set("max_execution_time", "60");
 * JS pro firebug: console.log(prom)
*/


}
?>
