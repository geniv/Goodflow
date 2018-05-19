<?php

/**
 *
 * Blok dynamickeho ehopu
 *
 */

//verze modulu
define("v_DynamicEshop", "0.22");

class DynamicEshop extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona;
  public $idmodul = "eshop";  //ovladani elementu pro obsah
  private $idsett = "_sett";  //nastaveni eshopu
  private $idmenu = "_menu";  //ovladani menu
  private $idobsah = "_obsah";  //ovladani obsahu
  private $idbasket = "_basket";  //nakupni kosik
  private $idorder = "_order"; //objednavky
  private $idstat = "_stat";  //statistika
  private $iduser = "_user";  //ovladani uzivatelu
  private $idauth = "_auth";  //ovladani vyrobce (author)

  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php");
  public $generated = array("script/ajax.js"); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul

//konfiguracni promenne
  public $max_zanoreni = 5;
  public $razeni_menu = "poradi ASC";
  public $razeni_obsah = "poradi ASC";
  public $search_autor, $search_name;

  private $typ_elementu, $znacka_povinne, $pathpicture,
          $minidir, $fulldir, $maxsizepic, $pathfile;
  private $name_button = "tlacitko";  //name tlacitko add/edit obsahu

  private $cfgexplode = "|--xx--|"; //text pro rozdeleni konfigurace
  private $obsexplode = "|-xxxx-|"; //text pro rozdeleni obsahu
  private $valexplode = "|-x--x-|"; //text pro rozdeleni value v obsahu

/**
 *
 * email:
 * snopekt@seznam.cz
 *
 * ++novy modul zvuky (*.ogg)
 * zbozi v omezenych serich
 * reseni odecitani polozek (pri odeslani zbozi by se odecetl z poctu dostupnych zbozi)
 * pri dokonceni objednavky se odecte z pocetu polozek ze zbozi.
 * akce na zbozi s tim ze se vytvori akce a zbozi se pak do tech akci bude dosazovat
 *
 * ke kazdemu obrazku uvadet podil na cene (kazdy obrazek ma jinou slozitost, proto jiny podil)
 *
 * kažtý uživatel může mít více dorucovacich adres!
 * Mel by tento modul umet:
 * export do xml pro zbozi.cz a heureka.cz -> generovat pres cron!!!
 * platba kartou?
 * platba paypal?
 * hledani/hledani dle parametru
 * vice typu dopravy
 * vyrobci / dodavatele
 * potvrzovani objednavky
 * vice vystupu nakupniho kosiku, nejak volitelne z jednoho
 * vytvaret jednoduche faktury--taky
 * --prirazeni jednoho zbozi do vice skupin?!
  //mit moznost na jedno zbozi nasadit ruzne varianty s upravou na cene--
 * a nebo to bude jen duplikace zbozi, co se tyce barvy tak by to slo
 * bud pres element a nebo jako nova polozka zbozi
 * musi umet i drobečkovou navigaci!
 * vyber barva,velikost, panske/damske
 * naseptavac pri vyhledavani?!
 *
 * --odecitat na zaklade obednavek
 * casova tolerance na zbozi, od pridani polozky do kosiku (napr jeden tyden)
 * kdyz bude zbozi v kosiku a vyproda se tak se uzivatelum poslou emaily s
 * upozornenim ze maji jeste tyden na zavaznou objednavku na to zbozi ktere bylo vyprodano
 * // -pred uplinutim teto doby by se poslal email na upozorneni
 *
 * pri rozkliknuti menu se zobrazi jen polozky nasledujiciho zanoreni a jednoho vnorene ->
 * v kazde urovni od zanoreni > 0 !! tj od prvni pod-urovne
 *
 * v zanoreni == 0 bude automaticky uvolni stranka jinak nez podsekce (bude jen jedna)
 * v kazde podsekci zanoreni > 0 bude stranka s moznosti drobeckova navidace, vypis sekci o zanoreni vetsi
 * a samotne polozky spodajici do daneho zanoreni a jeste nizsi (bude v kazde sekci a bude se generovat podle zadane sablony)
 *
 * moznost elementu s odkazem na rozkliknuti, kte pri prazdnem obsahu nebude videt ani
 * odkaz, pri nejakem obsahu ze zobtazi i link na rozkliknuti a text obsahu na skryti pres jQuery
 *
 * polozka obsahu aby byla jen v jedne sekci
 * a byla by moznost zaradit polozku i do jine podobne kategorie
 *
 * grafik:
 * propojeni s admin uzivatelama
 * vkladani navrhu (+komentar, ~10M), prochazeni jiz vlozenych navrhu ze zobrazenym poctem prodanych kusu
 * statistika, zobrazit jak placene, navrhy jinych (zobrazeni az polozek)
 * pridat polozku aktivni
 *
 * vyresit upload velkych souboru!!! pres flash...
 *
 * placeni: bude grafika na zivnost a bude placeny podle toho kolik nad navrhem stravi casu
 * ke kazdemu navrhu by melo byt info kolik z toho ma money a pod...
 *
 * dat potom vedet marwinovy jak resrim zpracovani url adresy ve strankach
 *
"checkbox"
"checkbox_user"
"checkgroup"
"checkgroup_user"
"radio"
"radio_user"
"colorradio"
"colorradio_user"
"select"
"select_user"
"minitext"
"minitext_user"
"fulltext"
"fulltext_user"
"wymeditor"
"hiddentext"
"hiddentext_user"
"conectmodule"
"conectmodule_user"
"download_user"
"pdf_user"
"reviews_user"
"url_user"
"datum"
"datum_user"
"cas"
"cas_user"
"datumcas"
"datumcas_user"
"foto"
"seriefoto"

case "checkbox":
case "checkbox_user":
case "checkgroup":
case "checkgroup_user":
case "conectmodule":
case "conectmodule_user":
case "pdf_user":
case "reviews_user":
case "url_user":
case "datum":
case "datum_user":
case "cas":
case "cas_user":
case "datumcas":
case "datumcas_user":
case "hiddentext":
case "hiddentext_user":
case "radio":
case "radio_user":
case "colorradio":
case "colorradio_user":
case "select":
case "select_user":
case "seriefoto":
case "minitext":
case "minitext_user":
case "fulltext":
case "fulltext_user":
case "wymeditor":
case "foto":
case "download_user":
break;
 */

/**
 *
 * Konstruktor menu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul, $this->idsett, $this->idmenu, //0..2
                          $this->idobsah, $this->idbasket, $this->idorder,  //3..5
                          $this->idstat, $this->iduser, $this->idauth); //6..8

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);
      $this->mainindex = $index;

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();
//dodelat!! nacitat jen v ramci eshopu!!!!!!!!! + prekopat!! nanitani!!!
      //nacteni konfigurace
/* primy load do this byl vyhozen!
      $this->ControlConfig(array ("max_zanoreni", "razeni_menu", "razeni_obsah", "search_autor", "search_name"), true,
                          array("load|config", "{$this->dirpath}/.config"));
*/

      //nacteni typu elementu
      $this->typ_elementu = $this->unikatni["set_typ_elementu"];
      $this->znacka_povinne = $this->unikatni["set_znacka_povinne"];
      //nacteni cesty k obrazkum
      $this->pathpicture = $this->unikatni["set_pathpicture"];
      $this->minidir = $this->unikatni["set_minidir"];
      $this->fulldir = $this->unikatni["set_fulldir"];
      $this->maxsizepic = $this->unikatni["set_maxsizepic"];
      //nacteni cesty k souborum
      $this->pathfile = $this->unikatni["set_pathfile"];

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul,
                                                $this->idsett,
                                                $this->idmenu,
                                                $this->idobsah,
                                                $this->idbasket,
                                                $this->idorder,
                                                $this->idstat,
                                                $this->iduser,
                                                $this->idauth);

      $this->namemodule = array($this->unikatni["name_module_admin"],
                                $this->unikatni["name_module_user"]);

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index);
      if (!$this->PripojeniDatabaze($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $this->Instalace();

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                          $this->idmodul,
                                                          $this->idsett,
                                                          $this->idmenu,
                                                          $this->idobsah,
                                                          $this->idbasket,
                                                          $this->idorder,
                                                          $this->idstat,
                                                          $this->iduser,
                                                          $this->idauth));
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
      switch ($_GET[$this->var->get_idmodul])
      {
        case $this->idmodul:  //id modul, elementy pro obsah eshopu
          $result = $this->AdministraceObsahu();
        break;

        case "{$this->idmodul}{$this->idsett}":  //nastaveni eshopu
          $result = $this->AdminEshopSetting();
        break;

        case "{$this->idmodul}{$this->idmenu}": //menu eshopu
          $result = $this->AdminEshopMenu();
        break;

        case "{$this->idmodul}{$this->idobsah}":  //obsah eshopu
          $result = $this->AdminEshopObsah();
        break;

        case "{$this->idmodul}{$this->idauth}":  //vyrobci zbozi
          $result = $this->AdminEshopAutor();
        break;

        case "{$this->idmodul}{$this->idbasket}": //kosik eshopu
          $result = "košík eshopu...";
        break;

        case "{$this->idmodul}{$this->idorder}":  //objednavky eshopu
          $result = "objednávky eshopu...";
        break;

        case "{$this->idmodul}{$this->idstat}":  //statistiky eshopu
          $result = "statistiky eshopu...";
        break;

        case "{$this->idmodul}{$this->iduser}":  //uzivatele eshopu
          $result = "uzivatele eshopu...";
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
  private function Instalace()
  {
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}menu (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    nazev VARCHAR(500),
                                    rewrite VARCHAR(500),
                                    zanoreni INTEGER UNSIGNED,
                                    koren TEXT,
                                    submenu TEXT,
                                    defaultni BOOL,
                                    max_obsah INTEGER UNSIGNED,
                                    zamek BOOL,
                                    href_id VARCHAR(200),
                                    href_class VARCHAR(200),
                                    href_akce VARCHAR(500),
                                    pridano DATETIME,
                                    upraveno DATETIME,
                                    poradi INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}obsah_element (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    typ VARCHAR(50),
                                    konfigurace TEXT,
                                    value TEXT,
                                    popis VARCHAR(200),
                                    povinne BOOL,
                                    vyhledavat BOOL,
                                    vlivcena INTEGER,
                                    xmltag VARCHAR(100),
                                    pridano DATETIME,
                                    upraveno DATETIME,
                                    poradi INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}obsah (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    adresa TEXT,
                                    autor INTEGER UNSIGNED,
                                    nazev VARCHAR(500),
                                    rewrite VARCHAR(500),
                                    konfigurace TEXT,
                                    obsah TEXT,
                                    typy TEXT,
                                    archiv BOOL,
                                    aktivni BOOL,
                                    pridano DATETIME,
                                    upraveno DATETIME,
                                    zobrazeno INTEGER UNSIGNED,
                                    poradi INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}vyrobce (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    uzivatel INTEGER UNSIGNED,
                                    nazev VARCHAR(200),
                                    popis TEXT,
                                    podil FLOAT,
                                    pridano DATETIME,
                                    upraveno DATETIME,
                                    aktivni BOOL);

                                  CREATE TABLE {$this->dbpredpona}kosik (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    zakaznik INTEGER UNSIGNED,
                                    pridano DATETIME,
                                    upraveno DATETIME,
                                    zbozi INTEGER UNSIGNED,
                                    konfigurace TEXT,
                                    sleva FLOAT,
                                    pocet INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}zakaznik (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    uzivatel INTEGER UNSIGNED,
                                    doprava VARCHAR(50),
                                    session VARCHAR(100),
                                    pridano DATETIME,
                                    upraveno DATETIME,
                                    expirace DATETIME);
                                  ", $error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }
  }

  public function CronXML_zbozi_cz()
  {
    //http://napoveda.seznam.cz/cz/specifikace-xml.html
  }

  public function CronXML_heureka_cz()
  {
    //http://sluzby.heureka.cz/napoveda/import/
  }

  public function CronXML_hledejceny_cz()
  {
    //http://www.hledejceny.cz/napoveda/pro-internetove-obchody#import
  }

  public function CronXML_hyperzbozi_cz()
  {
    //http://www.hyperzbozi.cz/specifikace-xml.html
  }

  public function CronXML_jyxo_cz()
  {
    //http://admin.vybereme.cz/format-xml-feedu
  }

  public function CronXML_pricemania_sk()
  {
    //http://www.pricemania.sk/prihlasenie/login.html
  }

  public function CronXML_najnakup_sk()
  {
    //http://www.najnakup.sk/about.aspx?a=2
  }

/**
 *
 * Vygenerovani ajax scriptu pro web
 *
 */
  public function VygenerujAjaxScript()
  {
    $cesta = "{$this->dirpath}/{$this->generated[0]}"; //cesta ajaxu
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        $this->dirpath,
                                        $this->AjaxJQueryKonverze(NULL, array("text", "roz")));

      $result = $this->ControlWriteFile(array($cesta => $obsah));
    }
  }

/**
 *
 * Vypise seznam vsech trid a jejich public funkci
 *
 * @param modul nazev modulu
 * @param nazev jmeno funkce
 * @return select s tridama a funkcema
 */
  private function SeznamTrid($modul = NULL, $nazev = NULL)
  {
    $result = $this->unikatni["admin_seznam_trid_begin"];

    $funblok = $this->BlokovaneNazvyVypisu();

    foreach ($this->var->main as $index => $polozka)
    {
      $trida = get_class($polozka);
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_trid_skupina_begin"],
                                          $trida);

      if ($index != $this->mainindex) //vyblokovani vlastni funkce
      {
        //nacteni funkci
        $fun = get_class_methods($polozka);
        foreach ($fun as $funkce)
        {
          if (!in_array($funkce, $funblok)) //ignorace funkci
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_trid"],
                                                "{$trida}:{$funkce}",
                                                ($trida == $modul && $funkce == $nazev ? " selected=\"selected\"" : ""),
                                                $funkce);
          }
        }
      }

      $result .= $this->unikatni["admin_seznam_trid_skupina_end"];
    }

    $result .= $this->unikatni["admin_seznam_trid_end"];

    return $result;
  }

/**
 *
 * Vyber typu elementu
 *
 * @param id identifikator polozky
 * @param adresa smerovaci adresa pri reloadu straky
 * @param konfigurace nastaveni vybraneho elementu
 * @return vyber elementu a jeho konfigurace
 */
  private function VyberTypu($id, $adresa, $konfigurace = NULL)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_begin"], $adresa);
    //vypis elementu
    foreach ($this->typ_elementu as $index => $polozka)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu"],
                                          $index,
                                          ($id == $index ? " selected=\"selected\"" : ""),
                                          $polozka);
    }
    $result .= $this->unikatni["admin_vyber_typu_end"];
//dodelat!! sjednotit rozstrelovani pomoci explode!!!!!
    //zobrazeni potrebne konfigurace
    switch ($id) //rozdeleni podle typu
    {
      case "checkbox":  //checkbox pro adminy
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_checkbox_default"],
                                                  $this->cfgexplode);
        }

        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_checkbox"],
                                            $hodnota[0],
                                            $hodnota[1]);
      break;

      case "checkbox_user": //checkbox pro uzivatele
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_checkbox_user_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_checkbox_user"],
                                            $this->var->jquerycore,
                                            $hodnota[0],
                                            $hodnota[1],
                                            ($hodnota[2] ? " checked=\"checked\"" : ""),
                                            ($hodnota[2] ? " disabled=\"disabled\"" : ""));
      break;

      case "checkgroup":  //checkgroup pro adminy
        $roz_mozn = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));
        //rozdeleni hodnot
        list($pop, $hod) = $this->RozdelitHodnoty($roz_mozn, 2, 1);

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_checkgroup"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                            $id,
                                            (!Empty($roz_mozn[0]) ? $roz_mozn[0] : 1),  //pocet
                                            (!Empty($pop) ? html_entity_decode(implode("|', '|", $pop), NULL, "UTF-8") : ""), //popisek
                                            (!Empty($hod) ? html_entity_decode(implode("|', '|", $hod), NULL, "UTF-8") : "")  //hodnoty
                                            );
      break;

      case "checkgroup_user": //checkgroup pro uzivatele
        $roz_mozn = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));
        //rozdeleni hodnot
        list($pop, $hod, $sho) = $this->RozdelitHodnoty($roz_mozn, 3, 1);

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_checkgroup_user"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                            $id,
                                            (!Empty($roz_mozn[0]) ? $roz_mozn[0] : 1),  //pocet
                                            (!Empty($pop) ? html_entity_decode(implode("|', '|", $pop), NULL, "UTF-8") : ""), //popisek
                                            (!Empty($hod) ? html_entity_decode(implode("|', '|", $hod), NULL, "UTF-8") : ""), //hodnoty
                                            (!Empty($sho) ? implode("','", $sho) : "")  //viditelnost
                                            );
      break;

      case "radio": //radio pro adminy
      case "colorradio":  //color pro adminy
      case "select":  //selelct pro adminy
        $roz_mozn = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));
        //rozdeleni hodnot
        list($pop, $hod) = $this->RozdelitHodnoty($roz_mozn, 2, 1);

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_radio_color_select"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                            $id,
                                            (!Empty($roz_mozn[0]) ? $roz_mozn[0] : 2),  //pocet
                                            (!Empty($pop) ? html_entity_decode(implode("|', '|", $pop), NULL, "UTF-8") : ""), //popisek
                                            (!Empty($hod) ? html_entity_decode(implode("|', '|", $hod), NULL, "UTF-8") : "")  //hodnoty
                                            );
      break;

      case "radio_user":  //radio pro uzivatele
      case "colorradio_user": //color pro uzivatele
      case "select_user": //select pro uzivatele
        $roz_mozn = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));
        //rozdeleni hodnot
        list($pop, $hod, $sho) = $this->RozdelitHodnoty($roz_mozn, 3, 1);

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_radio_color_select_user"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                            $id,
                                            (!Empty($roz_mozn[0]) ? $roz_mozn[0] : 2),  //pocet
                                            (!Empty($pop) ? html_entity_decode(implode("|', '|", $pop), NULL, "UTF-8") : ""), //popisek
                                            (!Empty($hod) ? html_entity_decode(implode("|', '|", $hod), NULL, "UTF-8") : ""),  //hodnoty
                                            (!Empty($sho) ? implode("','", $sho) : "")  //viditelnost
                                            );
      break;

      case "conectmodule":  //connect modulu pro admin
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));
        $funkce = explode(":", $hodnota[0]);  //rozdeleni 0 indexu pro nalistovani funkce
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_conectmodule"],
                                            $this->SeznamTrid($funkce[0], $funkce[1]),
                                            $hodnota[1]);
      break;

      case "conectmodule_user": //connect module pro uzivatele
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));
        $funkce = explode(":", $hodnota[0]);  //rozdeleni 0 indexu pro nalistovani funkce
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_conectmodule_user"],
                                            $this->SeznamTrid($funkce[0], $funkce[1]),
                                            $hodnota[1],
                                            ($hodnota[2] ? " checked=\"checked\"" : ""),  //viditelnost
                                            ($hodnota[2] ? " disabled=\"disabled\"" : ""));
      break;

      case "pdf_user":  //pdf tisk pro uzivatele
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_pdf_user_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_pdf_user"],
                                            $this->var->jquerycore,
                                            $hodnota[0],
                                            $hodnota[1],
                                            $hodnota[2],
                                            $hodnota[3],
                                            $hodnota[4],
                                            $hodnota[5],
                                            $hodnota[6],
                                            ($hodnota[7] ? " checked=\"checked\"" : ""),  //ptat se
                                            ($hodnota[7] ? " disabled=\"disabled\"" : ""),
                                            ($hodnota[8] ? " checked=\"checked\"" : ""),  //show
                                            ($hodnota[8] ? " disabled=\"disabled\"" : ""));
      break;

      case "reviews_user": //hodnoceni zbozi pro uzivatele
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_reviews_user_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));
        //min, max, split, (default tvori value)
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_reviews_user"],
                                            $this->var->jquerycore,
                                            $hodnota[0],  //min
                                            $hodnota[1],  //max
                                            $hodnota[2],  //split
                                            ($hodnota[3] ? " checked=\"checked\"" : ""),  //show
                                            ($hodnota[3] ? " disabled=\"disabled\"" : ""));
      break;

      case "url_user": //url odkazy pro uzivatele
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_url_user_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));
        //popis mezi <>..</a> a title bude value
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_url_user"],
                                            $this->var->jquerycore,
                                            $hodnota[0],  //link
                                            ($hodnota[1] ? " checked=\"checked\"" : ""),  //nove okno
                                            ($hodnota[1] ? " disabled=\"disabled\"" : ""),
                                            ($hodnota[2] ? " checked=\"checked\"" : ""),  //show
                                            ($hodnota[2] ? " disabled=\"disabled\"" : ""));
      break;

      case "minitext":
      case "fulltext":
      case "wymeditor":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_texty_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_texty"],
                                            $hodnota[0],
                                            $hodnota[1]);
      break;

      case "minitext_user":
      case "fulltext_user":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_texty_user_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_texty_user"],
                                            $this->var->jquerycore,
                                            $hodnota[0],
                                            $hodnota[1],
                                            ($hodnota[2] ? " checked=\"checked\"" : ""),  //viditelnost
                                            ($hodnota[2] ? " disabled=\"disabled\"" : ""));
      break;

      case "hiddentext":  //zadne nastaveni elementu
        $result .= $this->unikatni["admin_vyber_typu_not"];
      break;

      case "hiddentext_user":
      case "download_user": //pokud jsou uzivatelske budou viditelne podle toho jak je admin naplni
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_hiddentext_user_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_hiddentext_user"],
                                            $this->var->jquerycore,
                                            ($hodnota ? " checked=\"checked\"" : ""),  //viditelnost
                                            ($hodnota ? " disabled=\"disabled\"" : ""));
      break;

      case "datum":
      case "datumcas":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_datum_datumcas_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_datum_datumcas"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $hodnota[0],
                                            $hodnota[1],
                                            $hodnota[2],
                                            $hodnota[3]);
      break;

      case "datum_user":
      case "datumcas_user":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_datum_datumcas_user_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_datum_datumcas_user"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $hodnota[0],
                                            $hodnota[1],
                                            $hodnota[2],
                                            $hodnota[3],
                                            ($hodnota[4] ? " checked=\"checked\"" : ""),  //viditelnost
                                            ($hodnota[4] ? " disabled=\"disabled\"" : ""));
      break;

      case "cas":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_cas_default"];
        }
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_cas"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $konfigurace);
      break;

      case "cas_user":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_cas_user_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_cas_user"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $hodnota[0],
                                            ($hodnota[1] ? " checked=\"checked\"" : ""),  //viditelnost
                                            ($hodnota[1] ? " disabled=\"disabled\"" : ""));
      break;


      case "foto":  //jedna fotka
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_foto_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_foto"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $hodnota[0],  //mini
                                            $hodnota[1],  //full
                                            ($hodnota[2] ? " checked=\"checked\"" : ""),  //uprava velikosti
                                            ($hodnota[2] ? " disabled=\"disabled\"" : ""));
      break;

      case "seriefoto": //serie fotek
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_seriefoto_default"],
                                                  $this->cfgexplode);
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : explode($this->cfgexplode, $konfigurace));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_seriefoto"],
                                            $this->var->jquerycore,
                                            $this->dirpath,
                                            $hodnota[0],  //mini
                                            $hodnota[1],  //full
                                            ($hodnota[2] ? " checked=\"checked\"" : ""),  //uprava velikosti
                                            ($hodnota[2] ? " disabled=\"disabled\"" : ""),
                                            $hodnota[3],  //7
                                            ($hodnota[4] ? " checked=\"checked\"" : ""),  //uprava poctu
                                            ($hodnota[4] ? " disabled=\"disabled\"" : ""));
      break;

      default:
        $result .= $this->unikatni["admin_vyber_typu_null"];
      break;
    }

    return $result;
  }

/**
 *
 * Vrati delku zadaneho elementu
 *
 * @param typ typ elementu
 * @param konfigurace konfigurace elementu
 * @return vypocitana delka rozsahu elementu pri hlavnim vypisu
 */
  private function PocitaniProcentElementu($typ, $konfigurace)
  {
    $result = "";
    switch ($typ)
    {
      case "checkbox":
      case "checkbox_user":
      case "checkgroup":
      case "checkgroup_user":
      case "conectmodule":
      case "conectmodule_user":
      case "pdf_user":
      case "reviews_user":
      case "url_user":
      case "datum":
      case "datum_user":
      case "cas":
      case "cas_user":
      case "datumcas":
      case "datumcas_user":
      case "hiddentext":
      case "hiddentext_user":
      case "radio":
      case "radio_user":
      case "colorradio":
      case "colorradio_user":
      case "select":
      case "select_user":
      case "seriefoto":
        $result = 1;  //hodnota
      break;

      case "minitext":
      case "minitext_user":
      case "fulltext":
      case "fulltext_user":
      case "wymeditor":
        $result = 2;  //zkraceny, original text
      break;

      case "foto":
      case "download_user": //link+pocet stazeni
        $result = 2;  //mini, full
      break;

      default:
        $result = 0;
      break;
    }

    return $result;
  }

/**
 *
 * Hlavni administrace obsahu modulu
 *
 * @return adminstracni formulare v html
 */
  private function AdministraceObsahu()
  {
    $this->VygenerujAjaxScript(); //vygenerovani scriptu

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelemobsah",
                                        $this->AdminVypisObsah());

    //vytvari potrebne slozky
    $this->ControlCreateDir(array(array($this->dirpath, $this->pathpicture, $this->minidir),
                                  array($this->dirpath, $this->pathpicture, $this->fulldir),
                                  array($this->dirpath, $this->pathfile)));
//dodelat!! pridat polozku nazev do elementu, kdyz je i popis?!
    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addelemobsah":  //pridavani elementu pro obsah
          $typ = $_GET["typ"];
//dodelat!_ predelat na univerzalni obsah!
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addelemobsah"],
                                              $this->VyberTypu($typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelemobsah"),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");
//dodelat!!! xmltag bude sada nazvu ktere se pak budou dle pole prepisovat zvlast
          if ($this->ControlForm(array ("typ" => array("post", "string"),
                                        "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                        "value" => array("post", "string"),
                                        "popis" => array("post", "string"),
                                        "povinne" => array("post", "boolean"),
                                        "vyhledavat" => array("post", "boolean"),
                                        "vlivcena" => array("post", "integer"),
                                        "xmltag" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now")),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "obsah_element", 1))),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["popis"]) && !Empty($_POST["typ"])),
                                array("insert", "obsah_element", NULL),
                                $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addelemobsah_hlaska"], $_POST["popis"]);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editelemobsah": //uprava elementu obsahu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT typ, konfigurace, value, popis, povinne, vyhledavat, vlivcena, xmltag FROM {$this->dbpredpona}obsah_element WHERE id={$id};", $error))
          {
            $typ = (!Empty($_GET["typ"]) ? $_GET["typ"] : $data->typ);
//dodelat!!! xmltag bude sada nazvu ktere se pak budou dle pole prepisovat zvlast
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelemobsah"],
                                                $this->VyberTypu($typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelemobsah&amp;id={$id}", $data->konfigurace),
                                                $data->value,
                                                $data->popis,
                                                ($data->povinne ? " checked=\"checked\"" : ""),
                                                ($data->vyhledavat ? " checked=\"checked\"" : ""),
                                                $data->vlivcena,
                                                $data->xmltag,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("typ" => array("post", "string"),
                                          "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                          "value" => array("post", "string"),
                                          "popis" => array("post", "string"),
                                          "povinne" => array("post", "boolean"),
                                          "vyhledavat" => array("post", "boolean"),
                                          "vlivcena" => array("post", "integer"),
                                          "xmltag" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["popis"]) && !Empty($_POST["typ"]) && $id > 0),
                                  array("update", "obsah_element", $id),
                                  $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelemobsah_hlaska"], $_POST["popis"]);

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              if (!Empty($error))
              {
                $this->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "delelemobsah":  //mazani elementu obsahu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("obsah_element" => array("id", $id, "popis")), $nazev, $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_delelemobsah_hlaska"], $nazev);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis administrace sablon menu
 *
 * @return vypis sablon obsahu
 */
  private function AdminVypisObsah()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_element_begin"],
                                        $this->var->jquerycore,
                                        $this->var->jqueryui,
                                        $this->dirpath);

    if ($res = $this->queryMultiObjectSingle("SELECT id, typ, value, popis, povinne, vyhledavat, vlivcena, poradi FROM {$this->dbpredpona}obsah_element ORDER BY poradi ASC;", $error))
    {
      $i = 10;  //pocatek pocitani indexu v hlavnim vypisu
      //vypis elementu
      foreach ($res as $data)
      {
        $delka = $this->PocitaniProcentElementu($data->typ, $data->konfigurace);

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_element"],
                                            $data->id,
                                            $this->typ_elementu[$data->typ],
                                            $data->value,
                                            $data->popis,
                                            ($data->povinne ? " checked=\"checked\"" : ""),
                                            ($data->vyhledavat ? " checked=\"checked\"" : ""),
                                            $data->vlivcena,
                                            $data->poradi,
                                            $i,
                                            $i + $delka - 1,  //10
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelemobsah&amp;id={$data->id}",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delelemobsah&amp;id={$data->id}");
        $i += $delka; //pricitani delek
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result .= $this->unikatni["admin_vypis_obsah_element_null"]; //null elementu
      }
    }

    $result .= $this->unikatni["admin_vypis_obsah_element_end"];

    return $result;
  }

/**
 *
 * Vypis elementu a jejich vyhledavatelnost
 *
 * @return vypis elementu
 */
  private function VypisVyhledanivaniElement()
  {
    //dodelat!! predelat!!?!
/*
    if ($res = $this->queryMultiObjectSingle("SELECT popis, vyhledavat FROM {$this->dbpredpona}obsah_element ORDER BY poradi ASC;", $error))
    {
      //vypis elementu
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["vypis_vyhledavani_element"],
                                            $data->popis,
                                            ($data->vyhledavat ? " checked=\"checked\"" : ""));
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result .= $this->unikatni["vypis_vyhledavani_element_null"]; //null elementu
      }
    }

    return $result;
*/
  }

/**
 *
 * Administrace nastaveni eshopu
 *
 * @return adminstracni formulare v html
 */
  private function AdminEshopSetting()
  {
    $this->VygenerujAjaxScript(); //vygenerovani scriptu
//dodelat!! hledani podle ceny/publikace/dostupnosti a popisu pujdou do hajzlu!!!!
//jsou totiz vyhozene z obsahu a spadaji pod elementy -> takze hladena jen podle jmena
//+ostatni naklikane
//ne vyhledavani ale pouziti v hlavnich sekcich?!!!

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_setting"],
                                        $this->max_zanoreni,
                                        ($this->razeni_menu == "poradi ASC" ? " checked=\"checked\"" : ""),
                                        ($this->razeni_menu == "poradi DESC" ? " checked=\"checked\"" : ""),
                                        ($this->razeni_obsah == "poradi ASC" ? " checked=\"checked\"" : ""),
                                        ($this->razeni_obsah == "poradi DESC" ? " checked=\"checked\"" : ""),
                                        ($this->razeni_obsah == "LOWER(nazev) ASC" ? " checked=\"checked\"" : ""),
                                        ($this->razeni_obsah == "LOWER(nazev) DESC" ? " checked=\"checked\"" : ""),
                                        ($this->search_autor ? " checked=\"checked\"" : ""),
                                        ($this->search_name ? " checked=\"checked\"" : ""),
                                        "co se ma zobrazit v hlavni sekci");  //$this->VypisVyhledanivaniElement()

    if ($this->ControlConfig(array ("max_zanoreni" => array("post", "integer"),
                                    "razeni_menu" => array("post", "string"),
                                    "razeni_obsah" => array("post", "string"),
                                    "search_autor" => array("post", "boolean"),
                                    "search_name" => array("post", "boolean")),
                            (!Empty($_POST["tlacitko"])),
                            array("save|config", "{$this->dirpath}/.config")))
    {
      $result = $this->unikatni["admin_setting_hlaska"];

      $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idsett}");  //auto kliknuti
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $result;
  }

/**
 *
 * Zobrazuje skryte nastaveni menu
 *
 * @param zamek zamek pro zanikani upravy polozky
 * @param href_id id polozky menu
 * @param href_class trida polozky menu
 * @param href_akce akce polozky menu
 * @return html skryte sekce
 */
  private function SkrytaSekceMenu($zamek = NULL, $href_id = NULL, $href_class = NULL, $href_akce = NULL)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_skryta_sekce_menu"],
                                        ($zamek ? " checked=\"checked\"" : ""),
                                        $href_id,
                                        $href_class,
                                        $href_akce);

    return $result;
  }

/**
 *
 * Administrace polozek menu
 *
 * @return adminstracni formulare v html
 */
  private function AdminEshopMenu()
  {
    $this->VygenerujAjaxScript(); //vygenerovani scriptu

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_eshop_menu"],
                                        $this->var->jquerycore,
                                        $this->dirpath,
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=addmenu",
                                        $this->AdminVypisObsahMenu());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addmenu": //pridavani polozek do menu
          $zan = $_GET["zan"];  //cislo zanoreni
          settype($zan, "integer");
          $koren = $_GET["root"];  //cislo korenoveho id
          settype($koren, "integer");
//dodelat!! predelat na univerzlani formu
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addmenu"],
                                              $this->var->jquerycore,
                                              "{$this->dirpath}/{$this->generated[0]}",
                                              $zan,
                                              ($this->var->admin_mod ? $this->SkrytaSekceMenu() : ""),
                                              $this->VypisZanoreniMenu($zan, $koren),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");

          //hlidani maximalniho zanoreni
          $next_zanoreni = ($this->max_zanoreni > 0 ? $zan < $this->max_zanoreni : true);

          //ulozeni + nastaveni defaultu na prvni polozku
          if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                        "rewrite" => array("post", "string"),
                                        "zanoreni" => array("self", "integer", $zan),
                                        "koren" => array("self", "integer", $koren),
                                        "defaultni" => array("self", "boolean", $this->VypisPocetRadku("poradi", "menu", 1, "WHERE koren={$koren}") == 1 ? 1 : 0),
                                        "zamek" => array("post", "boolean"),
                                        "href_id" => array("post", "string"),
                                        "href_class" => array("post", "string"),
                                        "href_akce" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "menu", 1, "WHERE zanoreni={$zan}"))), //kontrola prazdnoty a unikatnost adresy
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["rewrite"]) && $next_zanoreni && $this->DuplikatniHodnota("rewrite", "menu", $_POST["rewrite"], "zanoreni='{$zan}' AND ")),
                                array("insert", "menu", NULL),
                                $error))
          {
            //pridani posledniho id do submenu korene
            if ($zan > 0 &&
                $koren > 0)
            { //nacteni noveho id
              $last_id = $this->lastInsertRowid();
              //nacteni submenu z rootu
              $submenu = $this->VypisHodnotu("submenu", "menu", $koren);
              //vlozeni noveho id a nebo pripojeni noveho id na konec
              $submenu = (Empty($submenu) ? $last_id : "{$submenu}-{$last_id}");
              $this->NastavHodnotu("submenu", $submenu, "menu", $koren);
            }

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addmenu_hlaska"], $_POST["nazev"]);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editmenu":  //uprava polozek menu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT nazev, rewrite, zanoreni, koren, submenu, defaultni, zamek, href_id, href_class, href_akce, poradi FROM {$this->dbpredpona}menu WHERE id={$id};", $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_editmenu"],
                                                $this->var->jquerycore,
                                                "{$this->dirpath}/{$this->generated[0]}",
                                                $data->zanoreni,
                                                $data->nazev,
                                                $data->rewrite,
                                                ($this->var->admin_mod ? $this->SkrytaSekceMenu($data->zamek, $data->href_id, $data->href_class, $data->href_akce) : ""),
                                                $this->VypisZanoreniMenu($data->zanoreni, $data->koren),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");

            if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                          "rewrite" => array("post", "string"),
                                          "zamek" => array("post", "boolean"),
                                          "href_id" => array("post", "string"),
                                          "href_class" => array("post", "string"),
                                          "href_akce" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now")), //kontrola prazdnoty a unikatnost adresy
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["rewrite"]) && $id > 0),
                                  array("update", "menu", $id),
                                  $error1))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editmenu_hlaska"], $_POST["nazev"]);

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");  //auto kliknuti
            }
              else
            {
              if (!Empty($error1))
              {
                $this->ErrorMsg($error1, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "delmenu": //mazani polozek menu
          $id = $_GET["id"];
          settype($id, "integer");

          $rek_id = $this->RekurzivniKlesani($id);
          if ($this->ControlDeleteForm(array("menu" => array("id", $rek_id, "nazev")), $nazev, $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_delmenu_hlaska"], $nazev);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypisuje menu zadane urovne a sablony pro presun drag'n'drop
 *
 * @param zanoreni hloubka zanoreni
 * @param koren koren menu
 * @return vypis na drag'n'drop
 */
  private function VypisZanoreniMenu($zanoreni, $koren)
  {
    settype($zanoreni, "integer");  //pretypovani cisla zanoreni
    settype($koren, "integer");  //pretypovani cisla korenu

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_zanoreni_menu_begin"],
                                        $this->var->jquerycore,
                                        $this->var->jqueryui,
                                        $this->dirpath,
                                        ($this->razeni_menu == "poradi ASC" ? "asc" : "desc"));

    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, rewrite, koren, submenu, defaultni, zamek, poradi FROM {$this->dbpredpona}menu
                                              WHERE zanoreni={$zanoreni} AND koren={$koren}
                                              ORDER BY {$this->razeni_menu};", $error))
    {
      //vypis zanoreni menu
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_zanoreni_menu"],
                                            $data->id,
                                            $data->nazev,
                                            $data->rewrite,
                                            ($data->defaultni ? " checked=\"checked\"" : ""),
                                            (!Empty($data->submenu) ? $this->unikatni["admin_vypis_zanoreni_menu_submenu"] : $this->unikatni["admin_vypis_zanoreni_menu_null_submenu"]),
                                            $data->poradi);
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result .= $this->unikatni["admin_vypis_zanoreni_menu_null"]; //null zanoreni menu
      }
    }

    $result .= $this->unikatni["admin_vypis_zanoreni_menu_end"];

    return $result;
  }

/**
 *
 * Rekurzivne vykreslovane menu, pro samotnou obsluhu menu
 *
 * @param zanoreni cislo zanoreni, predavane pri rekurzi
 * @param submenu adresy submenu, predavane pri rekurzi
 * @param rek_adr rekurzivni adresa, predavane pri rekurzi
 * @return rekurzivne seskladane menu
 */
  private function AdminVypisObsahMenu($zanoreni = 0, $submenu = NULL, $rek_adr = NULL)
  {
    $result = "";
    //rozdeneni sub polozek na vykresleni
    $sub = explode("-", $submenu);
    $subpolozky = "";
    if (!Empty($submenu))
    { //slozeni sub dotazu na vykresleni jen urcitych id
      $id = implode(", ", $sub);
      $subpolozky = "AND id IN ({$id})";
    }

    $next_zanoreni = ($this->max_zanoreni > 0 ? $zanoreni + 1 < $this->max_zanoreni : true);

    //vypisovat i podle submenu
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, rewrite, zanoreni, koren, submenu, defaultni, zamek
                                              FROM {$this->dbpredpona}menu
                                              WHERE zanoreni={$zanoreni}
                                              {$subpolozky}
                                              ORDER BY {$this->razeni_menu};", $error))
    {
      //vypis menu
      foreach ($res as $data)
      { //pripocitani zanoreni o +1
        $zan = $data->zanoreni + 1;
        //generovani adresy rekurze
        $adr_rek = (Empty($rek_adr) ? $data->id : "{$rek_adr}-{$data->id}");

        $submenu = "";
        if (!Empty($data->submenu))
        { //generovani submenu, a zanoreni o 1 vyssi
          $submenu = $this->AdminVypisObsahMenu($zan, $data->submenu, $adr_rek);
        }
//html vykresleni zanoreni
$pok = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $data->zanoreni);  //docasne

        $addsub = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_menu_addsub"],
                                            $data->nazev,
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=addmenu&amp;zan={$zan}&amp;root={$data->id}");

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_menu"],
                                            $data->id,
                                            $data->nazev,
                                            $data->rewrite,
                                            $data->zanoreni,
                                            $data->koren, //5
                                            ($data->defaultni ? " checked=\"checked\"" : ""),
                                            ($data->zamek ? " checked=\"checked\"" : ""),
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=editmenu&amp;id={$data->id}",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=delmenu&amp;id={$data->id}",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=addmenu&amp;zan={$data->zanoreni}&amp;root={$data->koren}",
                                            ($next_zanoreni ? $addsub : $this->unikatni["admin_vypis_obsah_menu_addsub_max"]),
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;co=addobsah&amp;rek={$adr_rek}",
                                            $submenu,
                                            $pok);
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result .= $this->unikatni["admin_vypis_obsah_menu_null"];  //null obsah menu
      }
    }

    return $result;
  }

/**
 *
 * Menu pro pridavani obsahu
 *
 * @param menu id polozky menu
 * @return seskladane menu pro pridavani obsahu
 */
  private function VypisMenu($menu = 0)
  {
    $result = "";
    settype($menu, "integer");  //pretypovani cisla id menu
    //nacteni dat pro vykresneni podle vlozeneho id menu
    if (!$dat = $this->querySingleRow("SELECT zanoreni, koren, submenu FROM {$this->dbpredpona}menu WHERE id={$menu};", $error))
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    $zanoreni = $dat->zanoreni; //nacteni zanoreni
    settype($zanoreni, "integer");  //pretypovani cisla zanoreni
    $koren = $dat->koren; //nacteni korenu
    settype($koren, "integer");  //pretypovani cisla korenu
    $submenu = $dat->submenu; //nacteni submenu

    //pokud je detekovane submenu
    if (!Empty($submenu))
    { //pricte zanoreni a koren bude predesle menu
      $zanoreni += 1;
      $koren = $menu;
    }

    if ($zanoreni > 0)
    {
      $backmenu = $this->VypisHodnotu("koren", "menu", $koren); //nacteni korene korenu
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_menu_href_up"],
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;menu={$backmenu}");
    }

    //vypis polozek podle direkci
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, rewrite, zanoreni, koren, submenu, defaultni
                                              FROM {$this->dbpredpona}menu
                                              WHERE zanoreni={$zanoreni} AND koren={$koren}
                                              ORDER BY {$this->razeni_menu};", $error))
    {
      //vypis menu
      foreach ($res as $data)
      { //generovani adresy rekurze
        $adr_rek = implode("-", $this->RekurzivniStoupani($data->id));
        //oznacovani aktivnich polozek, pri oznacem menu, nebo pri defaultni polozce
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_menu"],
                                            $data->id,
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;menu={$data->id}",//$hrefdown,//"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;zanoreni={$zan}&amp;koren={$data->id}",
                                            $data->nazev,
                                            ($menu == $data->id ? $this->unikatni["admin_vypis_menu_aktivni"] : ""),
                                            (!Empty($data->submenu) ? $this->unikatni["admin_vypis_menu_submenu"] : ""),
                                            $data->zanoreni,  //6
                                            ($data->defaultni ? " checked=\"checked\"" : ""), //7
                                            $this->VypisHodnotu("COUNT(id)", "obsah", $adr_rek, "adresa="), //pocet polozek je pod danym menu
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;co=addobsah&amp;rek={$adr_rek}");
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result .= $this->unikatni["admin_vypis_menu_null"];  //null menu
      }
    }

    return $result;
  }

/**
 *
 * Drobeckova navigace u pridavani obsahu do menu
 *
 * @param menu id polozky menu
 * @return seskladana drobeckova navigace
 */
  private function VypisDrobNavMenu($menu = 0)
  {
    $result = "";
    settype($menu, "integer");  //pretypovani cisla id menu
    //nacteni dat pro vykresneni podle vlozeneho id menu
    if (!$dat = $this->querySingleRow("SELECT zanoreni, koren, submenu FROM {$this->dbpredpona}menu WHERE id={$menu};", $error))
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    $zanoreni = $dat->zanoreni; //nacteni zanoreni
    settype($zanoreni, "integer");  //pretypovani cisla zanoreni
    $koren = $dat->koren; //nacteni korenu
    settype($koren, "integer");  //pretypovani cisla korenu

    //vybere si jen id od nuly do predposledniho
    $drobid = array_slice($this->RekurzivniStoupani($koren), 0, -1);
    $drobid[] = $menu;

    //vygenerovani podminky sql pro vyber polozek drobeckove navigace
    $subpolozky = "0";
    if (!Empty($drobid[0]))
    {
      $id = implode(", ", $drobid);
      $subpolozky = "id IN ({$id})";
    }

    //pocatecni koren menu
    $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_drobek_root"],
                                      "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;menu=0");

    //vypis polozek podle direkci
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, rewrite, zanoreni, koren
                                              FROM {$this->dbpredpona}menu
                                              WHERE {$subpolozky}
                                              ORDER BY zanoreni ASC;", $error))
    {
      //vypis drobeckove navigace
      foreach ($res as $index => $data)
      {
        if ($index != (count($res) - 1))
        { //odkaz
          $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_drobek_href"],
                                            $data->id,
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;menu={$data->id}",
                                            $data->nazev,
                                            $data->rewrite,
                                            $data->zanoreni);
        }
          else
        { //text
          $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_drobek_text"],
                                            $data->id,
                                            $data->nazev,
                                            $data->rewrite,
                                            $data->zanoreni);
        }
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
    //slouceni pole drobeckove navigace
    $result = implode($this->unikatni["admin_vypis_drobek_sep"], $ret);

    return $result;
  }

/**
 *
 * Vypis obsahu dle menu
 *
 * @param menu id polozky menu
 * @return vypis obsahu
 */
  private function VypisObsahMenu($menu = 0)
  {
    $result = "";
    $result = "";
    settype($menu, "integer");  //pretypovani cisla id menu
    //nacteni dat pro vykresneni podle vlozeneho id menu
    if (!$dat = $this->querySingleRow("SELECT nazev, zanoreni, koren, submenu FROM {$this->dbpredpona}menu WHERE id={$menu};", $error))
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    $nazev = $dat->nazev; //nacteni nazvu aktualniho menu
    $zanoreni = $dat->zanoreni; //nacteni zanoreni
    settype($zanoreni, "integer");  //pretypovani cisla zanoreni
    $koren = $dat->koren; //nacteni korenu
    settype($koren, "integer");  //pretypovani cisla korenu

    //vybere si jen id od nuly do predposledniho
    $drobid = array_slice($this->RekurzivniStoupani($koren), 0, -1);
    $drobid[] = $menu;
    //vygenerovani adresy pro adresaci obsahu
    $adresa = implode("-", array_unique($drobid));

    //pokud je neprazdna adresa
    if (!Empty($adresa))
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_polozky_obsah_begin"],
                                          $this->var->jquerycore,
                                          $this->var->jqueryui,
                                          $this->dirpath,
                                          ($this->razeni_obsah == "poradi ASC" ? "asc" : "desc"),
                                          $nazev,
                                          $this->VypisHodnotu("COUNT(id)", "obsah", $adresa, "adresa="));

      $tvar_datum = $this->unikatni["admin_vypis_polozky_obsah_tvar_datum"];

      //vypis polozek obsahu dle adresy
      if ($res = $this->queryMultiObjectSingle("SELECT id, adresa, autor, nazev, rewrite,
                                                konfigurace, obsah, typy, pridano, upraveno, zobrazeno
                                                FROM {$this->dbpredpona}obsah
                                                WHERE adresa='{$adresa}'
                                                ORDER BY {$this->razeni_obsah};", $error))
      {
        //vypis obsahu
        foreach ($res as $data)
        {
          $konfigurace = explode($this->obsexplode, $data->konfigurace);
          $obsah = explode($this->obsexplode, $data->obsah);
          $typy = explode($this->obsexplode, $data->typy);

          $ret = "";
          //prochazeni typu
          foreach ($typy as $indextyp => $typ)
          {
            switch ($typ)
            {
              case "checkbox":
              case "checkbox_user":
                $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
                //vyber pole moznosti podle zvolehe hodnoty
                $val = $moznosti[($obsah[$indextyp] ? 0 : 1)];
                $ret[] = $val;
                $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
              break;

              case "checkgroup":
              case "checkgroup_user":
                $hodnoty = explode($this->valexplode, $obsah[$indextyp]);

                $pole = array();
                //vypise jen ty oznacene prvky
                foreach ($hodnoty as $hodnota)
                {
                  if (!Empty($hodnota))
                  {
                    $pole[] = $hodnota;
                  }
                }

                $val = implode($this->unikatni["admin_vypis_polozky_obsah_sep"], $pole);
                $ret[] = $val;
                $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
              break;

              case "conectmodule":
              case "conectmodule_user":
                $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
                $modul = explode(":", $moznosti[0]);  //rosekani na pole
                $param = explode("|", $moznosti[1]);

                //prime pripojovani k modulu
                if (method_exists($modul[0], $modul[1]))
                { //zavolani funkce, + prevedeni @@_@@ promennych
                  $ret[] = $this->var->main[0]->NactiFunkci($modul, $this->PrevodUnikatnihoTextu($param,
                                                                                                __METHOD__,
                                                                                                $data->id));
                }
                  else
                {
                  $ret[] = "---";
                }
                $ret[] = "rezerva conectmodule";
              break;

              case "datum":
              case "datum_user":
              case "datumcas":
              case "datumcas_user":
                $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
                //vypis naformatovaneho datumu
                $datum = $this->InterpretDate($obsah[$indextyp], $moznosti[0], $moznosti[1], $moznosti[2], $moznosti[3]);
                $ret[] = $datum;
                $ret[] = html_entity_decode(html_entity_decode($datum, NULL, "UTF-8"));
              break;

              case "cas":
              case "cas_user":
                $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
                //vypis naformatovaneho casu
                $cas = $this->InterpretTime($obsah[$indextyp], $moznosti[0]);
                $ret[] = $cas;
                $ret[] = html_entity_decode(html_entity_decode($cas, NULL, "UTF-8"));
              break;

              case "hiddentext":
              case "hiddentext_user":
              case "radio":
              case "radio_user":
              case "colorradio":
              case "colorradio_user":
              case "select":
              case "select_user":
                //vypise obsah elementu
                $val = $obsah[$indextyp];
                $ret[] = $val;
                $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
              break;

              case "pdf_user":
                //vypis tisku pdf
                $ret[] = "rezerva pdf";
                $ret[] = "rezerva pdf";
              break;

              case "reviews_user":  //pocita z polozek obsahu aritmeticky prumer, pudou ukladany jako pole
                //vypis prumeru hodnoceni
                $hodnoceni = explode($this->valexplode, $obsah[$indextyp]);
                $soucet = array_sum($hodnoceni);  //soucet polozek pole
                $pocet = count($hodnoceni); //pocet polozek
                $avg = $soucet / $pocet;  //soucet podeleny poctem polozek = avg
                $ret[] = $avg;  //prumer hodnoceni
                $ret[] = $pocet;  //pocet hodnoceni
              break;

              case "url_user":
                $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
                //vypis url pro uzivatele
                $ret[] = $obsah[$indextyp]; //popis url
                $ret[] = $moznosti[0];  //url
              break;

              case "download_user":
                $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
                //vypis download souboru pro uzivatele
                $cesta = "{$this->dirpath}/{$this->pathfile}/{$moznosti[1]}";
                $file = "";
                if (file_exists("{$this->dirpath}/{$this->pathfile}/{$moznosti[1]}"))
                { //pokud soubor existuje
                  $file = "{$this->dirpath}/{$this->pathfile}/{$moznosti[1]}";
                }
                $ret[] = $obsah[$indextyp]; //nazev souboru
                $ret[] = $file; //cesta k souboru
              break;

              case "minitext":
              case "minitext_user":
              case "fulltext":
              case "fulltext_user":
              case "wymeditor":
                $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
                $val = $this->ZkraceniTextu($obsah[$indextyp], $moznosti[0], $moznosti[1]);
                //vypise zkraceny text
                $ret[] = $val;
                $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
              break;

              case "foto":
                $val = explode($this->valexplode, $obsah[$indextyp]);
                if (Empty($val[0]))
                {
                  $val[0] = $val[1];  //pokud je own prazdne pouzije [1]
                }
                //vypis obrazku foto
                $ret[] = "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$val[0]}";
                $ret[] = "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$val[1]}";
              break;

              case "seriefoto":
                $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
                $val = explode($this->valexplode, $obsah[$indextyp]);
                $poc = $moznosti[3];  //nacteni poctu
                $obr = array_slice($val, 0, $poc * 2);  //extrahovani obrazku
                $pop = array_slice($val, $poc * 2); //extrahovani popisku

                if (Empty($obr[0]))
                {
                  $obr[0] = $obr[1];  //pokud je own prazdne pouzije [1]
                }
                //vypis prvniho z serie obrazku, prvni miniatura a prvni popisek
                $ret[] = "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[0]}";
                $ret[] = $pop[0];
                //"{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$val[1]}";
              break;

              case "":
                $ret[] = "??";
              break;
            }
          }

          $vypis = array ("array_args",
                          $data->id,
                          $data->nazev,
                          $data->rewrite,
                          date($tvar_datum, strtotime($data->pridano)),
                          (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : ""),
                          $data->zobrazeno, //6
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;co=copyobsah&amp;id={$data->id}",
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;co=editobsah&amp;id={$data->id}",
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;co=delobsah&amp;id={$data->id}");

          //slouceni hlavniho pole a indexu
          $vypis = array_merge($vypis, $ret);

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_polozky_obsah"],
                                              $vypis);
        }
      }
        else
      {
        if (!Empty($error))
        {
          $this->ErrorMsg($error, array(__LINE__, __METHOD__));
        }
          else
        {
          $result .= $this->unikatni["admin_vypis_polozky_obsah_null"];
        }
      }

      $result .= $this->unikatni["admin_vypis_polozky_obsah_end"];
    }

    return $result;
  }

/**
 *
 * Generovani elementu do obsahu
 *
 * @param
 * @return nagenerovane html elementy
 */
  private function GenerovaniElementu($index, $podminka)
  {
    $result = "";
    $element = array();
    $povinne = ($podminka[$index]["povinne"] ? $this->znacka_povinne : ""); //aplikace povinneho textu

    //prochazeni typu a jejich vykresleni
    switch ($podminka[$index]["typ"])
    {
      case "checkbox":  //checkbox pro adminy
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_checkbox"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $podminka[$index]["konfigurace"][0],
                                              ($value ? " checked=\"checked\"" : ""),
                                              $povinne);
      break;

      case "checkbox_user": //checkbox pro uzivatele
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][2]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_checkbox_user"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $podminka[$index]["konfigurace"][0],
                                              ($value ? " checked=\"checked\"" : ""),
                                              ($show ? " checked=\"checked\"" : ""), //show
                                              $povinne);
      break;

      case "checkgroup":  //checkgroup pro adminy
        list($popis, $hodnota) = $this->RozdelitHodnoty($podminka[$index]["konfigurace"], 2, 1);
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : explode($this->valexplode, $podminka[$index]["value"]));

        $row = "";
        for ($i = 0; $i < $podminka[$index]["konfigurace"][0]; $i++)
        {
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_checkgroup_row"],
                                            $popis[$i], //popis
                                            $podminka[$index]["name"],
                                            $i,
                                            $hodnota[$i], //value
                                            ($value[$i] ? " checked=\"checked\"" : ""), //checked
                                            $povinne);
        }

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_checkgroup"],
                                              $podminka[$index]["nazev"],
                                              implode("\n", $row),
                                              $povinne);
      break;

      case "checkgroup_user": //checkgroup pro uzivatele
        list($popis, $hodnota, $def_show) = $this->RozdelitHodnoty($podminka[$index]["konfigurace"], 3, 1);
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : explode($this->valexplode, $podminka[$index]["value"]));
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $def_show);

        $row = "";
        for ($i = 0; $i < $podminka[$index]["konfigurace"][0]; $i++)
        {
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}_row"],
                                            $popis[$i], //popis
                                            $podminka[$index]["name"],
                                            $i, //3
                                            $hodnota[$i], //value
                                            ($hodnota[$i] == $value[$i] ? " checked=\"checked\"" : ""), //checked
                                            ($show[$i] ? " checked=\"checked\"" : ""),  //show
                                            $povinne);
        }

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              implode("\n", $row),
                                              $povinne);
      break;

      case "radio": //radio pro adminy
      case "colorradio":  //color radio pro adminy
        list($popis, $hodnota) = $this->RozdelitHodnoty($podminka[$index]["konfigurace"], 2, 1);
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);

        $row = "";
        for ($i = 0; $i < $podminka[$index]["konfigurace"][0]; $i++)
        {
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}_row"],
                                            $popis[$i], //popis
                                            $podminka[$index]["name"],
                                            $hodnota[$i], //value
                                            ($hodnota[$i] == $value ? " checked=\"checked\"" : ""), //checked
                                            $povinne);
        }

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              implode("\n", $row),
                                              $povinne);
      break;

      case "radio_user":  //radio pro uzivatele
      case "colorradio_user": //colorradio pro uzivatele
      case "select_user": //select pro uzivatele
        list($popis, $hodnota, $def_show) = $this->RozdelitHodnoty($podminka[$index]["konfigurace"], 3, 1);
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $def_show);

        $row = "";
        for ($i = 0; $i < $podminka[$index]["konfigurace"][0]; $i++)
        {
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}_row"],
                                            $popis[$i], //popis
                                            $podminka[$index]["name"],
                                            $i, //3
                                            $hodnota[$i], //value
                                            ($hodnota[$i] == $value ? " checked=\"checked\"" : ""), //checked
                                            ($show[$i] ? " checked=\"checked\"" : ""),  //show
                                            $povinne);
        }

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              implode("\n", $row),
                                              $povinne);
      break;

      case "select":  //select pro adminy
        list($popis, $hodnota) = $this->RozdelitHodnoty($podminka[$index]["konfigurace"], 2, 1);
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);

        $row = "";
        for ($i = 0; $i < $podminka[$index]["konfigurace"][0]; $i++)
        {
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_select_row"],
                                            $hodnota[$i], //value
                                            ($hodnota[$i] == $value ? " selected=\"selected\"" : ""),
                                            $popis[$i]);  //popis
        }

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_select"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              implode("\n", $row),
                                              $povinne);
      break;

      case "minitext":  //minitext pro adminy
      case "fulltext":  //fulltext pro adminy
      case "wymeditor": //wym editor pro adminy
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $delka = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["delka"] : $podminka[$index]["konfigurace"][0]);
        $zkrac = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["zkrac"] : $podminka[$index]["konfigurace"][1]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $delka, //4
                                              $zkrac,
                                              $povinne);
      break;

      case "minitext_user": //minitext pro uzivatele
      case "fulltext_user": //fulltext pro uzivatele
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $delka = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["delka"] : $podminka[$index]["konfigurace"][0]);
        $zkrac = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["zkrac"] : $podminka[$index]["konfigurace"][1]);
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][2]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $delka,
                                              $zkrac,
                                              ($show ? " checked=\"checked\"" : ""),
                                              $povinne);
      break;

      case "hiddentext":  //hiddentext pro adminy
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_hiddentext"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value);
      break;

      case "hiddentext_user": //hiddentext pro uzivatele
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][0]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_hiddentext_user"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              ($show[0] ? " checked=\"checked\"" : ""),  //show
                                              $povinne);
      break;

      case "conectmodule":  //connectmodule pro adminy
      case "conectmodule_user": //connect module pro uzivatele
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][2]);
        $modul = explode(":", $podminka[$index]["konfigurace"][0]); //nacteni modulu
        $param = explode("|", $podminka[$index]["konfigurace"][1]); //nacteni parametru

        //overeni existence funkce
        if (method_exists($modul[0], $modul[1]))
        { //test zavolani funkce
          $ret = $this->var->main[0]->NactiFunkci($modul, $param);
        }
          else
        {
          $ret = $this->unikatni["admin_addedit_{$podminka[$index]["typ"]}_null"];
        }

        //value je k nicemu, volani modulu se provadi primo v hlavni funkci
        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $ret,
                                              ($show ? " checked=\"checked\"" : ""),  //show
                                              $povinne);
      break;

      case "download_user": //dowmload_user pro uzivatele alias pro download dokumentu
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][0]);
        settype($podminka[$index]["konfigurace"][2], "integer");

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_download_user"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["konfigurace"][1],  //link
                                              $podminka[$index]["konfigurace"][2],  //stazeno
                                              ($show ? " checked=\"checked\"" : ""),  //6
                                              $povinne);
      break;

      case "pdf_user":  //pdf_user pro uzivatele alias tisk pdf
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][8]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_pdf_user"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($show ? " checked=\"checked\"" : ""),  //show
                                              $povinne);
      break;

      case "reviews_user":  //reviews_user pro uzivtele alias hodnoceni
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][3]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_reviews_user"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($show ? " checked=\"checked\"" : ""),  //show
                                              $povinne);
      break;

      case "url_user":  //url user pro uzivatele alias url odkaz
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $link = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["link"] : $podminka[$index]["konfigurace"][0]);
        $nove = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["nove"] : $podminka[$index]["konfigurace"][1]);
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][2]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $link,
                                              ($nove ? " checked=\"checked\"" : ""),  //do noveho okna
                                              ($show ? " checked=\"checked\"" : ""),  //show
                                              $povinne);
      break;

      case "datum": //datum pro adminy
      case "datumcas":  //datumcas pro adminy
        $datum = date($podminka[$index]["konfigurace"][0], strtotime($podminka[$index]["value"]));
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $datum);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["konfigurace"][0],
                                              $podminka[$index]["konfigurace"][1],
                                              $podminka[$index]["konfigurace"][2],
                                              $podminka[$index]["konfigurace"][3],
                                              $povinne);
      break;

      case "cas": //cas pro adminy
        $datum = date($podminka[$index]["konfigurace"][0], strtotime($podminka[$index]["value"]));
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $datum);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["konfigurace"][0],
                                              $povinne);
      break;

      case "datum_user":  //datum pro uzivatele
      case "datumcas_user": //datumcas pro uzivatele
        $datum = date($podminka[$index]["konfigurace"][0], strtotime($podminka[$index]["value"]));
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $datum);
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][4]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["konfigurace"][0],
                                              $podminka[$index]["konfigurace"][1],
                                              $podminka[$index]["konfigurace"][2],
                                              $podminka[$index]["konfigurace"][3],
                                              ($show ? " checked=\"checked\"" : ""),  //show
                                              $povinne);
      break;

      case "cas_user":  //case pro uzivatele
        $datum = date($podminka[$index]["konfigurace"][0], strtotime($podminka[$index]["value"]));
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $datum);
        $show = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["show"] : $podminka[$index]["konfigurace"][1]);

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["konfigurace"][0],
                                              ($show ? " checked=\"checked\"" : ""),  //show
                                              $povinne);
      break;

      case "foto":  //foto pro adminy alias jedna fotka
        $value = (!Empty($_FILES[$podminka[$index]["name"]]["tmp_name"]["main"]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $mini = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["mini"] : $podminka[$index]["konfigurace"][0]);
        $full = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["full"] : $podminka[$index]["konfigurace"][1]);

        //povoleno nastaveni obrazku
        $set_enable = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_foto_set_enable"],
                                                $podminka[$index]["name"],  //pokud je vlastni miniatura tak vlozi primo file
                                                $mini,
                                                $full);

        //zakazano nastaveni obrazku, promenne zustavaji natvrdo nastavene
        $set_disable = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_foto_set_disable"],
                                                $podminka[$index]["name"],
                                                $podminka[$index]["konfigurace"][0]); //nesmi se ovlivnovat z postu

        $obr = explode($this->valexplode, $value);
        //vkladani defaultniho obrazku
        if (!is_file("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[1]}"))
        {
          $obr[0] = $this->unikatni["admin_addedit_foto_default_pic"];
        }

        if (Empty($obr[0]))
        {
          $obr[0] = $obr[1];  //pokud je own prazdne pouzije [1]
        }

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($podminka[$index]["konfigurace"][2] ? $set_enable : $set_disable),
                                              "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[0]}", //5
                                              "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[1]}",
                                              $povinne);
      break;

      case "seriefoto": //seriefoto pro adminy alias serie fotek
        $value = (!Empty($_FILES[$podminka[$index]["name"]]["tmp_name"]["main0"]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $mini = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["mini"] : $podminka[$index]["konfigurace"][0]);
        $full = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["full"] : $podminka[$index]["konfigurace"][1]);
        $poc = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["poc"] : $podminka[$index]["konfigurace"][3]);

        //povoleno nataveni obrazku
        $set_enable = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_seriefoto_set_enable"],
                                                $podminka[$index]["name"],  //pokud je vlastni miniatura tak vlozi primo file
                                                $mini,
                                                $full);

        //zakazano nastaveni obrazku, promenne zustavaji natvrdo nastavene
        $set_disable = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_seriefoto_set_disable"],
                                                $podminka[$index]["name"],
                                                $podminka[$index]["konfigurace"][0]); //nesmi se ovlivnovat z postu

        $obr = explode($this->valexplode, $value);
        $obr_pic = array_slice($obr, 0, $poc * 2);
        $obr_pop = array_slice($obr, $poc * 2);

        //vraceni dat z postu
        foreach (range(0, $poc - 1) as $i)
        {
          $popis = $_POST[$podminka[$index]["name"]]["popis{$i}"];
          $obr_pop[$i] = html_entity_decode((!Empty($popis) ? $popis : $obr_pop[$i]), NULL, "UTF-8");
        }

        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}"],
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($podminka[$index]["konfigurace"][2] ? $set_enable : $set_disable),
                                              $this->dirpath, //4
                                              $poc,
                                              (!Empty($obr_pic) ? implode("|', '|", $obr_pic) : ""),  //6
                                              (!Empty($obr_pop) ? implode("|', '|", $obr_pop) : ""),
                                              $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")), //8
                                              $podminka[$index]["konfigurace"][4],  //9
                                              ($podminka[$index]["konfigurace"][4] ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_{$podminka[$index]["typ"]}_add"], $podminka[$index]["name"]) : ""),
                                              $povinne);
      break;
    }

    //slouceni vnitrnich elementu
    $result = implode("", $element);

    return $result;
  }

/**
 *
 * Kontroluje vstupni data
 *
 * @param promenna promenna vytazema ze vstupu
 * @param nastaveni asociativni pole nastaveni
 * @param &error text chybove hlasky
 * @return zkontrolovana promenna
 */
  private function KontrolaVstupu($promenna, $nastaveni, &$error)
  {
    $chyba = "";
    $error = "";
    //pokud je polozka povinna
    if ($nastaveni["povinne"])
    {
      //vyber textoveho typu
      switch ($nastaveni["typ"])
      {
        case "checkbox":
        case "checkbox_user":
          if (is_null($promenna))
          {
            $promenna = "";
            //neoznaceni povinneho checkboxu
            $chyba = $this->unikatni["admin_kontrola_vstupu_checkbox"];
          }
        break;

        case "checkgroup":
        case "checkgroup_user":
          if (is_null($promenna))
          {
            $promenna = "";
            //neoznaceni minimalne jednoho checkboxu
            $chyba = $this->unikatni["admin_kontrola_vstupu_checkgroup"];
          }
        break;

        case "radio":
        case "radio_user":
        case "colorradio":
        case "colorradio_user":
          if (is_null($promenna))
          {
            $promenna = "";
            //neoznaceni povinneho radio buttonu
            $chyba = $this->unikatni["admin_kontrola_vstupu_radio"];
          }
        break;

        case "select":
        case "select_user":
          if (is_null($promenna))
          {
            $promenna = "";
            //neoznaceni povinneho radio buttonu
            $chyba = $this->unikatni["admin_kontrola_vstupu_select"];
          }
        break;

        case "minitext":
        case "minitext_user":
        case "fulltext":
        case "fulltext_user":
        case "wymeditor":
          if (Empty($promenna))
          {
            $promenna = "";
            //pokud je prazdna hodnota
            $chyba = $this->unikatni["admin_kontrola_vstupu_texty"];
          }
        break;

        case "datum":
        case "datum_user":
          //parsuje datum
          $datum = date_parse($promenna);
          $testdate = date("Y-m-d H:i:s", strtotime($promenna));
          //kontroluje vstupni datum a pocet chyb po parsrovani
          if (!checkdate($datum["month"], $datum["day"], $datum["year"]) ||
              $datum["error_count"] != 0 ||
              $testdate == "1970-01-01 01:00:00")
          {
            $promenna = "";
            //chyba, neni gregoriansky datum
            $chyba = $this->unikatni["admin_kontrola_vstupu_datum"];
          }
        break;

        case "cas":
        case "cas_user":
        case "datumcas":
        case "datumcas_user":
          $testdate = date("Y-m-d H:i:s", strtotime($promenna));
          if ($testdate == "1970-01-01 01:00:00")
          {
            $promenna = "";
            //chyba, neni spravny cas nebo datumcas
            $chyba = $this->unikatni["admin_kontrola_vstupu_cas_datumcas"];
          }
        break;

        case "conectmodule":
        case "conectmodule_user":
        case "hiddentext":
        case "hiddentext_user":
        case "pdf_user":
        case "reviews_user":
          //neni povinnost neco vyplnovat
        break;

        case "download_user":
          if (Empty($promenna) ||
              Empty($_FILES[$nastaveni["name"]]["tmp_name"]["soubor"]))
          {
            $promenna = "";
            //pokud je prazdna hodnota nebou soubor
            $chyba = $this->unikatni["admin_kontrola_vstupu_download"];
          }
        break;

        case "url_user":
          if (Empty($promenna) ||
              Empty($_POST[$nastaveni["name"]]["link"]))
          {
            $promenna = "";
            //pokud je prazdna hodnota nebo link
            $chyba = $this->unikatni["admin_kontrola_vstupu_url"];
          }
        break;

        case "foto":
          if (Empty($nastaveni["value"]) &&
              Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main"]))
          {
            $promenna = "";
            //chyba, neni vybran obrazek
            $chyba = $this->unikatni["admin_kontrola_vstupu_foto"];
          }

          //pokud je povoleno nastaveni bere nastaveni z post, jinak z konfigurace
          if (($nastaveni["konfigurace"][2] ? $_POST[$nastaveni["name"]]["mini"] : $nastaveni["konfigurace"][0]) == "own" &&
              (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main"]) xor
              Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main_mini"])))
          {
            $promenna = "";
            //chyba, neni vybran obrazek s miniaturou
            $chyba = $this->unikatni["admin_kontrola_vstupu_foto_mini"];
          }

          //pokud je povoleno vlastni nastaveni kontroluje hodnoty
          if ($nastaveni["konfigurace"][2] && //pokud je povolena uprava
              (Empty($_POST[$nastaveni["name"]]["mini"]) ||
              Empty($_POST[$nastaveni["name"]]["full"])))
          {
            $promenna = "";
            //chyba, neni nastaven zmensovaci pomer
            $chyba = $this->unikatni["admin_kontrola_vstupu_foto_dim"];
          }
        break;

        case "seriefoto":
          $obr = explode($this->valexplode, $nastaveni["value"]);
          $poc = $_POST[$nastaveni["name"]]["poc"];
          settype($poc, "integer");

          for ($i = 0; $i < $poc; $i++)
          {
            if (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main{$i}"]) &&
                Empty($obr[$i]))
            {
              $promenna = "";
              //chyba, neni jeden vybran full brazek
              $chyba = $this->unikatni["admin_kontrola_vstupu_seriefoto"];
              break;
            }

            if (($nastaveni["konfigurace"][2] ? $_POST[$nastaveni["name"]]["mini"] : $nastaveni["konfigurace"][0]) == "own" &&
                (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main{$i}"]) xor
                Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main{$i}_mini"])))
            {
              $promenna = "";
              //chyba, neni vybran hlavni obrazek s miniaturou
              $chyba = $this->unikatni["admin_kontrola_vstupu_seriefoto_mini"];
              break;
            }
          }

          //pokud je povoleno vlastni nastaveni kontroluje hodnoty
          if ($nastaveni["konfigurace"][2] && //pokud je povolena uprava
              (Empty($_POST[$nastaveni["name"]]["mini"]) ||
              Empty($_POST[$nastaveni["name"]]["full"])))
          {
            $promenna = "";
            //chyba, neni nastaven zmensovaci pomer
            $chyba = $this->unikatni["admin_kontrola_vstupu_seriefoto_dim"];
          }
        break;
      }
    }

    //zpracovani chyby pokud je polozka povinna
    if (!Empty($chyba))
    {
      $error = $this->NactiUnikatniObsah($this->unikatni["admin_kontrola_vstupu_error"],
                                        $chyba,
                                        $nastaveni["nazev"],
                                        $this->typ_elementu[$nastaveni["typ"]]);
    }

    return $promenna;
  }

/**
 *
 * Zpracovani nactenych hodnot
 *
 * @param value zkontrolovane value z kontrolni funkce
 * @param nactene promenne nactene z postu
 * @param nastaveni nacteni a rozdeleni konfigurace z db
 * @return pole zpracovanych dat
 */
  private function ZpracovaniVstupu($value, $nactene, $nastaveni)
  {
    $result = "";
    switch ($nastaveni["typ"])
    {
      case "checkbox":
      case "checkbox_user":
        $nastaveni["konfigurace"][2] = $nactene["show"];  //donastaveni viditelnosti

        $result["val"] = ($value == $nastaveni["konfigurace"][0] ? 1 : 0); //nacteni hodnoty
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]); //nacteni konfigurace
      break;

      case "checkgroup":
        $pole = "";
        for ($i = 0; $i < $nastaveni["konfigurace"][0]; $i++)
        { //sesbirani hodnot
          $pole[$i] = $value[$i];
        }

        $result["val"] = implode($this->valexplode, $pole); //ulouzi indexy oznacenych checkboxu
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "checkgroup_user":
        $pole = "";
        for ($i = 0; $i < $nastaveni["konfigurace"][0]; $i++)
        { //sesbirani hodnot
          $pole[$i] = $value[$i];
        }

        if (is_array($nactene["show"]))
        { //nastaveni show
          foreach ($nactene["show"] as $index => $show)
          {
            if ($show)
            {
              $nastaveni["konfigurace"][($index + 1) * 3] = $show;
            }
          }
        }

        $result["val"] = implode($this->valexplode, $pole); //ulouzi indexy oznacenych checkboxu
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "conectmodule":
      case "conectmodule_user":
      case "url_user":
        $nastaveni["konfigurace"][2] = $nactene["show"];  //donastaveni viditelnosti

        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "pdf_user":
        $nastaveni["konfigurace"][8] = $nactene["show"];  //donastaveni viditelnosti

        $result["val"] = "";
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "reviews_user":  //hodnoceni
        $nastaveni["konfigurace"][3] = $nactene["show"];  //donastaveni viditelnosti

        $result["val"] = "";  //ukladani jednotlivych hodnot
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "download_user":
        //upload souboru
        $file = $this->ControlUploadFile(array("{$this->dirpath}/{$this->pathfile}" => array($nastaveni["name"], "soubor")));

        $nastaveni["konfigurace"][0] = $nactene["show"];  //donastaveni viditelnosti
        $nastaveni["konfigurace"][1] = $file[0];
        //2 je pocitadlo stezeni
//dodelat!! prekopat!! zmenilo se to!
        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "radio":
      case "radio_user":
      case "colorradio":
      case "colorradio_user":
      case "select":
      case "select_user":
        if (is_array($nactene["show"]))
        {
          foreach ($nactene["show"] as $index => $show)
          {
            if ($show)
            {
              $nastaveni["konfigurace"][($index + 1) * 3] = $show;
            }
          }
        }

        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "datum":
      case "datum_user":
      case "datumcas":
      case "datumcas_user":
        $nastaveni["konfigurace"][4] = $nactene["show"];  //donastaveni viditelnosti

        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "cas":
      case "cas_user":
        $nastaveni["konfigurace"][1] = $nactene["show"];  //donastaveni viditelnosti

        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "minitext":
      case "minitext_user":
      case "fulltext":
      case "fulltext_user":
      case "wymeditor":
        $nastaveni["konfigurace"][0] = $nactene["delka"];
        $nastaveni["konfigurace"][1] = $nactene["zkrac"];
        $nastaveni["konfigurace"][2] = $nactene["show"];  //donastaveni viditelnosti

        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "hiddentext":
      case "hiddentext_user":
        $nastaveni["konfigurace"][0] = $nactene["show"];  //donastaveni viditelnosti

        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "foto":
        $mini = (!Empty($nactene["mini"]) ? $nactene["mini"] : $nastaveni["konfigurace"][0]);
        $full = (!Empty($nactene["full"]) ? $nactene["full"] : $nastaveni["konfigurace"][1]);

        //samotny upload obrazku
        $max = 1024 * 1024 * $this->maxsizepic; //vypocet max size
        $obr = $this->ControlPicture(array("main" => array(NULL, array ("mini" => $mini,
                                                                        "full" => $full))),
                                    array($nastaveni["name"], $max, array("mini" => "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}",
                                                                          "full" => "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}"))
                                    );

        //update stavajicich hodnot
        $nastaveni["konfigurace"][0] = $mini;
        $nastaveni["konfigurace"][1] = $full;

        //roseka nacteny obsah pro navraz z postu a preneseni pri copy a update
        $pic = explode($this->valexplode, $nastaveni["value"]);
        $pole = array((!Empty($obr["main"]["own"]) ? $obr["main"]["own"] : $pic[0]),
                      (!Empty($obr["main"]["mini"]) ? $obr["main"]["mini"] : $pic[1]));

        $result["val"] = implode($this->valexplode, $pole);
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "seriefoto":
        $mini = (!Empty($nactene["mini"]) ? $nactene["mini"] : $nastaveni["konfigurace"][0]);
        $full = (!Empty($nactene["full"]) ? $nactene["full"] : $nastaveni["konfigurace"][1]);
        $poc = $nactene["poc"];
        settype($poc, "integer");

        //samotny upload obrazku
        $max = 1024 * 1024 * $this->maxsizepic; //vypocet max size
        $obr = $this->ControlPicture(array("main" => array($poc, array ("mini" => $mini,
                                                                        "full" => $full))),
                                    array($nastaveni["name"], $max, array("mini" => "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}",
                                                                          "full" => "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}"))
                                    );

        $pic = explode($this->valexplode, $nastaveni["value"]);
        $pic_obr = array_chunk(array_slice($pic, 0, $poc * 2), 2);

        //nacteni obrazku z multipole
        $obrazky = "";
        foreach ($obr["main"] as $i => $obrazek)
        { //slucovani presne dvou polozek
          $obrazky[] = implode($this->valexplode, array((!Empty($obrazek["own"]) ? $obrazek["own"] : $pic_obr[$i][0]),
                                                        (!Empty($obrazek["mini"]) ? $obrazek["mini"] : $pic_obr[$i][1])));
        }

        //nacteni popisku obrazku
        $rozsah = range(0, $poc - 1);
        foreach ($rozsah as $poradi)
        { //sesbirani popisku z postu
          $popis[] = $nactene["popis{$poradi}"];
        }

        //update stavajicich hodnot
        $nastaveni["konfigurace"][0] = $mini;
        $nastaveni["konfigurace"][1] = $full;
        $nastaveni["konfigurace"][3] = $poc;

        $pole = array(implode($this->valexplode, $obrazky),
                      implode($this->valexplode, $popis));

        $result["val"] = implode($this->valexplode, $pole);
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;
    }

    return $result;
  }

/**
 *
 * Projde obsah a vypise vsechny obrazky
 *
 * @return pole obrazku
 */
  private function NajdiObrazky()
  {
    $result = array();
    if ($res = $this->queryMultiObjectSingle("SELECT obsah, typy, konfigurace
                                              FROM {$this->dbpredpona}obsah;", $error))
    {
      //vypis obsahu
      foreach ($res as $data)
      {
        $typy = explode($this->obsexplode, $data->typy);
        $obsah = explode($this->obsexplode, $data->obsah);
        $konfigurace = explode($this->obsexplode, $data->konfigurace);
        //projde typy a vybere obrazky
        foreach ($typy as $index => $typ)
        {
          switch ($typ)
          {
            case "foto":
              $hodn = explode($this->valexplode, $obsah[$index]);
              //secteni pole sama ze sebou
              $result = array_merge($result, $hodn);
            break;

            case "seriefoto":
              $hodn = explode($this->valexplode, $obsah[$index]);
              $konf = explode($this->cfgexplode, $konfigurace[$index]);
              $poc = $konf[3];  //nycteni postu obrazku
              //secteni pole sama ze sebou
              $result = array_merge($result, array_slice($hodn, 0, $poc * 2));
            break;
          }
        }
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
    //odstraneni duplikatnich hodnot (prazdneho mista)
    $result = array_unique($result);

    return $result;
  }

/**
 *
 * Projde obsah a vypise vsechny soubory pro downaload
 *
 * @return pole obrazku
 */
  private function NajdiSoubory()
  {
    //najde soubory pro synchronizaci a pak synchronizuje
    $result = array();
    if ($res = $this->queryMultiObjectSingle("SELECT typy, konfigurace
                                              FROM {$this->dbpredpona}obsah;", $error))
    {
      //vypis obsahu
      foreach ($res as $data)
      {
        $typy = explode($this->obsexplode, $data->typy);
        $konfigurace = explode($this->obsexplode, $data->konfigurace);
        //projde typy a vybere obrazky
        foreach ($typy as $index => $typ)
        {
          switch ($typ)
          {
            case "download_user":
              $hodn = explode($this->cfgexplode, $konfigurace[$index]);
              //nacteni pole nazvu souboru
              $result[] = $hodn[1];
            break;
          }
        }
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
    //odstraneni duplikatnich hodnot (prazdneho mista)
    $result = array_unique($result);

    return $result;
  }

/**
 *
 * Administrace polozek obsahu
 *
 * @return adminstracni formulare v html
 */
  private function AdminEshopObsah()
  {
    $this->VygenerujAjaxScript(); //vygenerovani scriptu

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_eshop_obsah"],
                                        $this->VypisMenu($_GET["menu"]),
                                        $this->VypisDrobNavMenu($_GET["menu"]),
                                        $this->VypisObsahMenu($_GET["menu"]));

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addobsah":  //pridavani obsahu menu
        case "copyobsah":  //duplikace obsahu menu
          $podm_copy = ($co == "copyobsah");

          $rek = $_GET["rek"];
          $a = explode("-", $rek);  //parsnuti rekurzivni adresy, posledni index je id
          $id = $a[count($a) - 1];

          $tvar_datum = $this->unikatni["admin_obsah_tvar_datum"];

          if ($podm_copy)
          {
            $id = $_GET["id"];
            settype($id, "integer");

            //nacita hodnoty z kopirovaneho obsahu
            if ($data = $this->querySingleRow("SELECT adresa, autor, nazev, rewrite, konfigurace, obsah, typy FROM {$this->dbpredpona}obsah WHERE id={$id};", $error))
            {
              $val_adresa = $data->adresa;
              $rek = $val_adresa; //dosazeni rekurzivni adresy
              $val_autor = $data->autor;
              $val_nazev = $data->nazev;
              $val_rewrite = $data->rewrite;

              $val_obsah = explode($this->obsexplode, $data->obsah);
              $val_konfigurace = explode($this->obsexplode, $data->konfigurace);
              $val_typy = explode($this->obsexplode, $data->typy);
            }
          }
            else
          {
            $default = $this->unikatni["admin_addobsah_default"];

            $val_adresa = $default[0];
            $val_autor = $default[1];
            $val_nazev = $default[2];
            $val_rewrite = $default[3];
          }

          $podm_add = (!$this->VypisHodnotu("zamek", "menu", $id)); //zamek na obsah

          $podminka = "";
          $element = "";
          if ($res = $this->queryMultiObjectSingle("SELECT id, typ, konfigurace, value, popis, povinne, vyhledavat, vlivcena, poradi
                                                    FROM {$this->dbpredpona}obsah_element
                                                    ORDER BY poradi ASC;", $error))
          {
            //vypis elementu
            foreach ($res as $index => $data)
            {
              //nacteni pracovniho pole
              $podminka[$index]["id"] = $data->id;
              $podminka[$index]["typ"] = ($podm_copy ? $val_typy[$index] : $data->typ);  //uklada se
              $podminka[$index]["nazev"] = $data->popis;
              $podminka[$index]["name"] = "elem_{$data->id}";
              $podminka[$index]["value"] = ($podm_copy ? $val_obsah[$index] : $data->value);  //uklada se
              $podminka[$index]["konfigurace"] = explode($this->cfgexplode, ($podm_copy ? $val_konfigurace[$index] : $data->konfigurace));  //uklada se
              $podminka[$index]["povinne"] = $data->povinne;

              //zapouzdreni generovani elementu
              $element[] = $this->GenerovaniElementu($index, $podminka);
            }

            //po zmacknuti tlacitka
            if (!Empty($_POST[$this->name_button]))
            {
              foreach ($podminka as $index => $polozky)
              { //probehne kontrola povinnych
                $value = $this->KontrolaVstupu($_POST[$podminka[$index]["name"]]["value"], $podminka[$index], $chyba);
                if (Empty($chyba)) //kdyz je prazdna chyba probiha zpracovani vstupu
                { //naplneni pole pro ulozeni
                  $prom = $this->ZpracovaniVstupu($value, $_POST[$podminka[$index]["name"]], $podminka[$index]);
                  $save_val[$index] = $prom["val"]; //naplneni hodnot
                  $save_cfg[$index] = $prom["cfg"]; //naplneni konfiguraci
                  $save_typ[$index] = $polozky["typ"];  //naplneni typu
                }
                  else
                { //naplneni pripadnych chyb
                  $array_error[] = $chyba;
                }
              }
            }

            //detekce a slouceni chyb
            if (count($array_error) > 0)
            {
              $chyby = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_error"],
                                                implode("", $array_error));
            }

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah"],
                                                $this->var->jquerycore,
                                                $this->var->jqueryui,
                                                "{$this->dirpath}/{$this->generated[0]}",
                                                $this->dirpath,
                                                $this->VypisHodnotu("nazev", "menu", $id),
                                                $val_autor,
                                                $val_nazev,
                                                $val_rewrite,
                                                implode("", $element),  //9
                                                $this->unikatni["admin_addeditobsah_add"],  //10
                                                $this->name_button,
                                                $chyby,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;menu={$rek}");

            //po zmacknuti tlacitka
            if (!Empty($_POST[$this->name_button]) &&
                count($array_error) == 0 &&
                $podm_add &&  //zamek obsahu
                !Empty($rek) && //adresa
                !Empty($_POST["nazev"]) &&
                !Empty($_POST["rewrite"]) &&
                $this->DuplikatniHodnota("rewrite", "obsah", $_POST["rewrite"], "adresa='{$rek}' AND ")) //kontrola duplicity na rewrite
            {
              //algoritmus ukladani dat
              if ($this->ControlForm(array ("adresa" => array("self", "string", $rek),
                                            "autor" => array("post", "integer"),
                                            "nazev" => array("post", "string"),
                                            "rewrite" => array("post", "string"),
                                            "konfigurace" => array("self", "array", $save_cfg, $this->obsexplode),
                                            "obsah" => array("self", "array", $save_val, $this->obsexplode),
                                            "pridano" => array("self", "date", "now"),
                                            //"upraveno" => array("self", "date", "now"),
                                            "typy" => array("self", "array", $save_typ, $this->obsexplode),
                                            "zobrazeno" => array("self", "integer", 0),
                                            "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "obsah", 1))),
                                    true,
                                    array("insert", "obsah", NULL),
                                    $error))
              {
                $vstup_obr = $this->NajdiObrazky(); //vyhleda vsechny obrazky
                $vstup_fil = $this->NajdiSoubory();  //vyhleda vsechny soubory
                //synchronizace
                $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}" => $vstup_obr,
                                                        "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}" => $vstup_obr,
                                                        "{$this->dirpath}/{$this->pathfile}" => $vstup_fil));

                //zmena hlasky pri zkopirovani obsahu
                if ($podm_copy)
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_copyobsah_hlaska"], $_POST["nazev"], $navic);
                }
                  else
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah_hlaska"], $_POST["nazev"], $navic);
                }

                $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&menu={$rek}");  //auto kliknuti
              }
                else
              {
                if (!Empty($error))
                {
                  $this->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              }
            }
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
              else
            {
              $result .= $this->unikatni["admin_addeditobsah_null"];
            }
          }
        break;

        case "editobsah": //uprava obsahu menu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT adresa, autor, nazev, rewrite, konfigurace, obsah, typy FROM {$this->dbpredpona}obsah WHERE id={$id};", $error))
          {
            //rozdeleni nactenych hodnot
            $obsah_adresa = $data->adresa;
            $rek = $obsah_adresa;
            $obsah_autor = $data->autor;
            $obsah_nazev = $data->nazev;
            $obsah_rewrite = $data->rewrite;
            $obsah_value = explode($this->obsexplode, $data->obsah);
            $obsah_konfigurace = explode($this->obsexplode, $data->konfigurace);
            $obsah_typy = explode($this->obsexplode, $data->typy);
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }

          $podminka = "";
          $element = "";
          if ($res = $this->queryMultiObjectSingle("SELECT id, typ, konfigurace, value, popis, povinne, vyhledavat, vlivcena, poradi
                                                    FROM {$this->dbpredpona}obsah_element
                                                    ORDER BY poradi ASC;", $error))
          {
            //vypis elementu
            foreach ($res as $index => $data)
            {
              //nacteni pracovniho pole
              $podminka[$index]["id"] = $data->id;
              $podminka[$index]["typ"] = $obsah_typy[$index];  //uklada se
              $podminka[$index]["nazev"] = $data->popis;
              $podminka[$index]["name"] = "elem_{$data->id}";
              $podminka[$index]["value"] = $obsah_value[$index];  //uklada se
              $podminka[$index]["konfigurace"] = explode($this->cfgexplode, $obsah_konfigurace[$index]);  //uklada se
              $podminka[$index]["povinne"] = $data->povinne;

              //zapouzdreni generovani elementu
              $element[] = $this->GenerovaniElementu($index, $podminka);
            }

            //po zmacknuti tlacitka
            if (!Empty($_POST[$this->name_button]))
            {
              foreach ($podminka as $index => $polozky)
              { //probehne kontrola povinnych
                $value = $this->KontrolaVstupu($_POST[$podminka[$index]["name"]]["value"], $podminka[$index], $chyba);
                if (Empty($chyba)) //kdyz je prazdna chyba probiha zpracovani vstupu
                { //naplneni pole pro ulozeni
                  $prom = $this->ZpracovaniVstupu($value, $_POST[$podminka[$index]["name"]], $podminka[$index]);
                  $save_val[$index] = $prom["val"]; //naplneni hodnot
                  $save_cfg[$index] = $prom["cfg"]; //naplneni konfiguraci
                  $save_typ[$index] = $polozky["typ"];  //naplneni typu
                }
                  else
                { //naplneni pripadnych chyb
                  $array_error[] = $chyba;
                }
              }
            }

            //detekce a slouceni chyb
            if (count($array_error) > 0)
            {
              $chyby = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_error"],
                                                implode("", $array_error));
            }

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah"],
                                                $this->var->jquerycore,
                                                $this->var->jqueryui,
                                                "{$this->dirpath}/{$this->generated[0]}",
                                                $this->dirpath,
                                                $this->VypisHodnotu("nazev", "menu", $id),  //?? dodelat!
                                                $obsah_autor,
                                                $obsah_nazev,
                                                $obsah_rewrite,
                                                implode("", $element),  //9
                                                $this->unikatni["admin_addeditobsah_edit"],  //10
                                                $this->name_button,
                                                $chyby,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&amp;menu={$rek}");

            //po zmacknuti tlacitka
            if (!Empty($_POST[$this->name_button]) &&
                count($array_error) == 0 &&
                //$podm_add &&  //zamek obsahu
                !Empty($rek) && //adresa
                !Empty($_POST["nazev"]) &&
                !Empty($_POST["rewrite"]) &&
                $id > 0)
            {
              //algoritmus ukladani dat
              if ($this->ControlForm(array ("adresa" => array("self", "string", $rek),
                                            "autor" => array("post", "integer"),
                                            "nazev" => array("post", "string"),
                                            "rewrite" => array("post", "string"),
                                            "konfigurace" => array("self", "array", $save_cfg, $this->obsexplode),
                                            "obsah" => array("self", "array", $save_val, $this->obsexplode),
                                            //"pridano" => array("self", "date", "now"),
                                            "upraveno" => array("self", "date", "now"),
                                            "typy" => array("self", "array", $save_typ, $this->obsexplode)),
                                    true,
                                    array("update", "obsah", $id),
                                    $error))
              {
                $vstup_obr = $this->NajdiObrazky(); //vyhleda vsechny obrazky
                $vstup_fil = $this->NajdiSoubory();  //vyhleda vsechny soubory
                //synchronizace
                $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}" => $vstup_obr,
                                                        "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}" => $vstup_obr,
                                                        "{$this->dirpath}/{$this->pathfile}" => $vstup_fil));

                $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah_hlaska"], $_POST["nazev"], $navic);

                $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&menu={$rek}");  //auto kliknuti
              }
                else
              {
                if (!Empty($error))
                {
                  $this->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              }
            }
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
              else
            {
              $result .= $this->unikatni["admin_addeditobsah_null"];
            }
          }
        break;

        case "delobsah":  //mazani polozek menu
          $id = $_GET["id"];
          settype($id, "integer");
          //nacteni adresy pro navrat
          $rek = $this->VypisHodnotu("adresa", "obsah", $id);

          if ($this->ControlDeleteForm(array("obsah" => array("id", $id, "nazev")), $nazev, $error))
          {
            $vstup_obr = $this->NajdiObrazky(); //vyhleda vsechny obrazky
            $vstup_fil = $this->NajdiSoubory();  //vyhleda vsechny soubory
            //synchronizace
            $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}" => $vstup_obr,
                                                    "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}" => $vstup_obr,
                                                    "{$this->dirpath}/{$this->pathfile}" => $vstup_fil));

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_delobsah_hlaska"], $nazev, $navic);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idobsah}&menu={$rek}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Administrace autoru
 *
 * @return adminstracni formulare v html
 */
  private function AdminEshopAutor()
  {
    $this->VygenerujAjaxScript(); //vygenerovani scriptu

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_eshop_autor"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idauth}&amp;co=addaut",
                                        "vypis...");
/*
$this->idmodul,
$this->idsett,
$this->idmenu,
$this->idobsah,
$this->idbasket,
$this->idorder,
$this->idstat,
$this->iduser,
$this->idauth
* "{$this->idmodul}",
*/
//modul => co
//dodelat!!
//var_dump($this->permit);

////$this->AdminVypisObsahMenu()
    $co = $_GET["co"];
//dodelat!!! + jeste select vypis do pridavani obsahu s defaultni nulovou polozkou

//napojeni jen na staticke resp tedy jen na jeden typ uzivatelu!!!
//+++ vymyslet princim predavani prav novym uzivatelum?!
    if (!Empty($co))
    {
      switch ($co)
      {
        case "addaut":  //pridavani autoru
          $default = $this->unikatni["admin_addaut_default"];
          //nacist nadefiovany modul z uzivatelu
//kua jak pripojovat?!
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditaut"],
                                              $this->unikatni["admin_addeditaut_add"],
                                              "++select na vyber uzivatelu, jejich id, 0 = zadny++",
                                              $default[0],
                                              $default[1],
                                              $default[2],
                                              ($default[3] ? " checked=\"checked\"" : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idauth}");
//a co tyk vypis vsechy uzivatelu static/dynamic?
          //vyrobce
          //id, uzivatel, nazev, popis, podil, pridano, upraveno, aktivni
        break;
//dodelat!! dopsat!!!
//premyslet topologii adminu na permission...!!!
        case "editaut": //uprava autoru
          $id = $_GET["id"];
          settype($id, "integer");
//id, uzivatel, nazev, popis, podil, pridano, upraveno, aktivni
          if ($data = $this->querySingleRow("SELECT uzivatel, nazev, popis, podil, pridano, upraveno, aktivni FROM {$this->dbpredpona}vyrobce WHERE id={$id};", $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditaut"],
                                                $this->unikatni["admin_addeditaut_edit"],
                                                "{$data->uzivatel} ... select...",
                                                $data->nazev,
                                                $data->popis,
                                                $data->podil,
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idauth}");
//!! dodelat!! $id > 0
            //dopsat!!
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "delaut":  //mazani autoru
          $id = $_GET["id"];
          settype($id, "integer");

          //
        break;
      }
    }

    return $result;
  }


}
?>
