<?php

/**
 * Centralni trida index projektu a hlavni nalinkovani funkce a promennych
 */
class Layout
{
  private $var;
  private $fileprom = "promenne.php"; //soubor promennych
  private $filefunc = "funkce.php"; //soubor funkce

/**
* Konstruktor hlavniho indexu
*/
  public function __construct()
  {
    if (file_exists($this->fileprom) && file_exists($this->filefunc))
    {
      include_once $this->fileprom; //vlozeni promennych
      include_once $this->filefunc; //vlozeni funkce

      $this->var = new Promenne();  //vytvoreni promennych
      $this->var->main[0] = new Funkce($this->var, 0);  //vytvoreni funkce
      $this->var->main[0]->StartCas();  //zacatek mereni generovani stranky
      $this->var->main[0]->InicializaceModulu($null);  //hlavni incializace dalsich definovanych modulu

      $admintitle = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminTitle");
      $adminmenu = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminMenu");
      $adminobsah = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminObsah");

      $menu = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu");
      $obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek");
      $title = $this->var->main[0]->NactiFunkci("StaticMenu", "Title");

      $pomlcka = $this->var->main[0]->NactiFunkci("PrepinaniPodleSekci", "Prepinani", $_GET[$this->var->get_kam]);
      $titleuvod = $this->var->main[0]->NactiFunkci("PrepinaniPodleSekci", "Prepinani", "{$_GET[$this->var->get_kam]}titleuvod");

      $idsekceclass = $this->var->main[0]->NactiFunkci("StaticMenu", "NavratPolozkyMenu", "id");

      $author = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "author");
      $copyright = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "copyright");
      $keywords = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "keywords");
      $description = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "description");

      $zapaticopyright = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "zapaticopyright");
      $validatorxhtml = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "validator-xhtml");
      $validatorcss = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "validatory-css");
      $createdby = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "createdby");
      $vygenerovano = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "vygenerovano");

      $highslidepozadi = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "highslide-pruhlednost-pozadi");
      $highslidepanel = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "highslide-pruhlednost-panel");
      $highslidepanelpozice = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "highslide-panel-pozice");
      $highslidepanelzobrazeni = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "highslide-panel-zobrazeni");
      $highslidepanelzapvyp = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "highslide-panel-zapnut-vypnut"); //-{$_GET[$this->var->get_kam]}
      $panelstatickyplovouci = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "panel-staticky-plovouci-fit-false");
      $highslidenumberposition = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "number-position-caption-heading");
      $highslideoutlinetype = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "highslide-nastaveni-outlinetype");
      $highslidewrapperclassname = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "highslide-nastaveni-wrapperclassname");
      $outlinetypehodnota = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "highslide-outlinetype-hodnota");
      $wrapperclassnamehodnota = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "highslide-wrapperclassname-hodnota");
      $fadeinoutprolnuti = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "fadeinout-prolnuti");
      //$popisobrazkutopbottom = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "popis-obrazku-caption-heading");
      //$highslidenumberpositiongalerie = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "number-position-caption-heading-{$_GET[$this->var->get_kam]}");

      $poziceadpanelu = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "pozice-admin-panelu");
      $autohideadpanelu = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "automaticke-skryvani-admin-panelu");
      $rychlostprijetiadpanelu = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "rychlost-prijeti-admin-panelu");
      $rychlostodjetiadpanelu = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "rychlost-odjeti-admin-panelu");
      $stylvolaniadpanelu = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "zpusob-volani-admin-panelu");
      $smerprijetiadpanelu = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "smer-prijeti-admin-panelu");
      $smerodjetiadpanelu = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "smer-odjeti-admin-panelu");
      $stylprijetiadpanelu = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "styl-prijeti-admin-panelu");
      $stylodjetiadpanelu = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "styl-odjeti-admin-panelu");

/*

uzivatele:
* tym (prop)
* jmeno
* prijmeni
* login
* heslo (md5)
* (3 stavy online)
* datum zalozeni
* datum upravy
* pocet prihlaseni
* popis funkce
* aktivni
* foto (url ~300?!)
* (detekce přihlášení, odhlášení + nečinnost)
* loganaci systém stejny jako u dynamic user!!!! oddělit + rozlišovat agenta
* + rozlišení, aby každý user agent měl unikatní nastavení!
* + kazdy uzivatel muze byt ve vice tymech

tym:
* nazev
* zakladatel
* popis
* datum vzniku

tasks (uloha):
* //tym (prop)
* projekt (prop)
* uzivatel (prop)
* uloha (nazev)
* datum zadani
* datum dokonceni
* dokonceno (bool)
* dulezitost (int)
* barva
* popis
* //casova narocnost (odhad)
* zobrazit
* poradi (drag'n drop)

posta:
* od
* pro
* predmet
* zprava
* datum odeslani
* datum precteni
* precteno
* zobrazit

skupina (skupina projektu):
* tym (prop)
* uzivatel (prop)
* verejne (int, zveřejnovat se budou celé skupiny)
* nazev
* popis
* poradi (drag'n drop)

projekt:
* tym (prop)
* skupina (prop)
* nazev
* popis projektu
* datum zadani
* datum dokonceni
* dokonceno
* cena
* //casova narocnost (+- odhad)
* poradi (drag'n drop)

komentare (verejnych uloh - tasks v ramci tymu a v ramci ulohy, projektu):
* //tym (prop)
* //projekt (prop)
* tasks (prop)
* od (prop)
* zprava
* datum pridani
* zanoreni (cislo zanoreni)
* viditelnost (nedestruktivni skryti)
* ip
* agent

nastavení:
* velikost textu globálně!!,
* fotka
* volitelné pozadi + vlastní pozadí + volitelná barva
* do klasických stránek neodhlašovat


hiearchie:
* tym (s cleny)
* uzivatele (v tymu se svymi projekty a ukoly)
* projekty (na kterych pracuje)
* tasks (projekt ma sve dilci ukoly)
* komentare (komentovani uloh)
* tym<-skupina<-projekt<-tasks<-komentar


napsat instalačku z default modulu
základní funkce na obsluhu tabulek s manipulačními vypisi a bloky
různé funkční bloky narvat do skupinovych funkci co zahrnou vetsi cast kodu
shrnuto: vypisi, editace, mazani ruznych tabulek (popř zpracovat jednotny
univerzalní systém na zpracování jakéhokoliv univerzálního formulare včetně
ošeření vstupních dat - měnila by se jen tvar formuláře, a zapínaly některé
příznaky požadované funkce - což by se pak dalo s uspěchem aplikovat i na
dalších modulech)
+spoluprace mezi tabulkami a klíčové výpisy z databáze ne kterých bude stát
tento system!!!

tato verze bude určitým stylem beta verze.. tzn že některté databaze budou
dopředu naplněny pevnymi daty a v případě osvěrčení se tento systém rošíří o
další možnosti a případně i veřejnost...

*/

      //$title .= $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "Title", "adresa");
      //$galerie = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "SekceGallery", "adresa", "galerie/");
      //$text = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "PictureGallery", "adresa");

      //$this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "hu1");

      //$flash1 = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "RandomPicture", "adresa");

//var_dump($strankovani);
      //$title .= $this->var->main[0]->NactiFunkci("DynamicMenu", "Title", "adresovita");
      //$search = $this->var->main[0]->NactiFunkci("DynamicMenu", "DynamickyMenu", "hu1", "adresa");

      //$text = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", $_GET["action"]);  //sekce
      //$text = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", $_GET[$this->var->get_kam], true, array("ahojky", "voe"));

      //$text = $this->var->main[0]->NactiFunkci("DynamicTable", "Table", "adresa");

      //$title .= $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup", "Title", "adresa");
      //$search = $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup", "DynamickyMenu", "adresa");

      //$text = $this->var->main[0]->NactiFunkci("DynamicGallery", "Gallery", "adresa");

      //$slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", 2); //pro id 1
      //$captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", 2, $slovo);  //pro id 1 se slovem


      //$text = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", "adresa");

      //$this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "NactiCaptchu", "adresa", 2, $captcha, $slovo);
//      $text = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "NavstevniKniha", "adresa");

      //$text = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", "adresa", 1, $captcha, $slovo); //kontrola id 1 z captchy se slovem
      //$text = $this->var->main[0]->NactiFunkci("DynamicTable", "Table", "adresa");

      //$this->var->main[0]->NactiFunkci("DynamicZobrazeni", "ArrayVystupObsahu", "adresa1");

      //$text = $this->var->main[0]->NactiFunkci("DynamicGallery", "Gallery", "adresa");

      //$this->var->main[0]->NactiFunkci("DynamicZobrazeni", "KontrolaAutoMazani", "adresa1", 6);

      //$this->var->main[0]->NactiFunkci("StaticIdos", "NacteniAkci", $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "ArrayVystupObsahu", "adresa1"), 2, 1, "j.n.Y", " ", array(1, 2));
      //$text = $this->var->main[0]->NactiFunkci("StaticIdos", "Idos");

//$this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", "email@email.cz  ,       email@email.cz, email@email.cz");
      //$obsah = $this->var->main[0]->NactiFunkci("DynamicObsahEshop", "ObsahEshop");
      //$infokosik = $this->var->main[0]->NactiFunkci("DynamicObsahEshop", "InfoKosik");
      //$search = $this->var->main[0]->NactiFunkci("DynamicObsahEshop", "VyhledatPolozku");

      //$title = $this->var->main[0]->NactiFunkci("DynamicEshopMenu", "Title").$this->var->main[0]->NactiFunkci("DynamicObsahEshop", "Title");

      //$prep = $this->var->main[0]->NactiFunkci("PrepinaniPodleSekci", "Prepinani");

      //$rss = $this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "RSSLink");
      //$rsslink = $this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "RSSLinkWeb");
      //$this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "RSSVystup");

      //$jazyk = $this->var->main[0]->NactiFunkci("DynamicLanguage", "SeznamJazyku");

      //$flash = $this->var->main[0]->NactiFunkci("FlashHeader", "Flash");
      //$flash = $this->var->main[0]->NactiFunkci("DynamicRandomGallery", "Obrazek", "adresa");

//var_dump($this->var->main[0]->NactiFunkci("DynamicLanguageObsah", "LangObsah", "neco_nekde"));

//var_dump($this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "LangCyklObsah", "nekde_nekde"));

      //$this->var->main[0]->NactiFunkci("DynamicRSS", "RSSVystup");

//list($str, $limit) = $this->var->main[0]->NactiFunkci("Funkce", "Strankovani", 10, 30, "ahojky", "limit");

//var_dump($text = $this->var->main[0]->NactiFunkci("DynamicCyklObsah", "CyklObsah", "neco"));

      //$sekce = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "SekceGallery");
      //$galerie = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "PictureGallery", "zlutoucky-kun");

      //$title = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "Title");

//var_dump($this->var->main[0]->NactiFunkci("Funkce", "ExistenceUrl", "http://seznam.cz"));
      //$obr = $this->var->main[5]->Obrazek();

      //var_dump($this->var->main[0]->NactiFunkci("Funkce", "NactiUnikatniObsah", ".unikatni_fukce.php", "info_uvod"));

      //$text =
      //$this->var->main[0]->NactiFunkci("DynamicZobrazeni", "DynamickeZobrazeni", "adresa");
      //$title .= $text = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "Title");
      //$flash = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RychloVypis", array("adresa", "adresa1"));
      //$flash = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RychloVypis", "adresa1");
      //$flash1 = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "DynamickeZobrazeni", "adresa1", true, NULL);
      //var_dump($this->var->main[0]->NactiFunkci("DynamicZobrazeni", "KontrolaAutoMazani", "adresa", 5, false));
      //$text = $this->var->main[0]->NactiFunkci("DynamicDrinks", "Drinks", "adresa");

      //$rss = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSLink", "adresa1");
      //$rss = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSLink", array("adresa", "adresa1"));
      //$this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSVystup", "adresa");

      //$rss = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "RSSLink");
      //$rss = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "RSSLinkWeb");
      //$this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "RSSVystup", "adresa");
      //$pole = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "ArrayVystupObsahu", "adresa");

      //$rss = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSLinkWeb", "adresa1");
      //$rss = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSLinkWeb", array("adresa", "adresa1"));

      //$this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSVystup", "adresa1");
      //$this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSVystup", array("adresa", "adresa1"));

      //$slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", 1);
      //$text = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", 1, $slovo);

      //$text2 = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", 2, "kokote");
/*
      //$text =
      $this->var->main[0]->NactiFunkci("DynamicUser", "Registrace");
      $text2 = $this->var->main[0]->NactiFunkci("DynamicUser", "AutorizaceUzivatele");

      $flash = $this->var->main[0]->NactiFunkci("DynamicUser", "LoginUser", false);
      $os = $this->var->main[0]->NactiFunkci("DynamicUser", "InformaceProfilu", false);
      $brow = $this->var->main[0]->NactiFunkci("DynamicUser", "EditaceProfilu", false);
      $prep = $this->var->main[0]->NactiFunkci("DynamicUser", "SmazaniProfilu", false);
      $flash1 = $this->var->main[0]->NactiFunkci("DynamicUser", "SeznamUzivatelu", false);
*/


//var_dump($_GET);
//var_dump($_POST);
//var_dump($_SESSION);
//var_dump($this->var->backadmin);
//var_dump($this->var->aktivniadmin);
//var_dump($_SESSION["LASTURL"]);
//var_dump($_COOKIE);
//var_dump($_SERVER["PHP_AUTH_USER"], $_SESSION);
//var_dump($slovo);
//var_dump($funkce_web, $info_web);
//var_dump($_GET[$this->var->get_kam]);
//var_dump($_SERVER["QUERY_STRING"], $_SERVER["HTTP_USER_AGENT"]);
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "TypOS", $_SERVER["HTTP_USER_AGENT"]));
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $_SERVER["HTTP_USER_AGENT"]));
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "DetekceWebkitu"));
//".($this->var->administrace ? "<a href=\"{$absolute_url}?{$this->var->get_kam}={$this->var->adresaadminu}\">(admin)</a>" : "")."
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "TypOS", $_SERVER["HTTP_USER_AGENT"]));
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece"));
//var_dump($this->var->main[0]->NactiFunkci("DynamicZobrazeni", "PocetRadkuDynamickeZobrazeni", "adresa"));
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "PocetDni", "now", "01.10.2009 00:00:00"));
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "PocetDni", "now", "01.10.2009 00:00:00"));
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "DetekceChromeLinux"));
//var_dump($this->var->adminuser["name"], $this->var->adminuser["debug"]);
//var_dump($this->var->debug_mod);


      $absolute_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");
      $info_blok = $this->var->main[0]->NactiFunkci("Funkce", "BlokaceInfo", $funkce_web);

      $usecontrolsadmin = $this->var->main[0]->NactiFunkci("Funkce", "AdminPrepinaniPodleSekci", "-use-controls-admin");
      $numberpositionadmin = $this->var->main[0]->NactiFunkci("Funkce", "AdminPrepinaniPodleSekci", "-number-position-admin");

      //$prep_admin = $this->var->main[0]->NactiFunkci("Funkce", "AdminPrepinaniPodleSekci");
      $admin_styles = $this->var->main[0]->NactiFunkci("Funkce", "AdminNacitaniCssModulu");

      $moologvolani = ($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece") ? "<span id=\"odkaz_ad\" style=\"{$poziceadpanelu}: -12px;\">--- admin ---<!-- --></span>" : "");

      $linux = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu") ?
                ($this->var->aktivniadmin ?
                "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_linux_admin.css\" media=\"screen\" />" : //admin
                "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_linux.css\" media=\"screen\" />")  //normal
                : "");

      $opera = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceOpery") ?
                "\n      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_opera.css\" media=\"screen\" />" :
                "");

      $linkadmin = (!Empty($_SESSION["ADMIN:{$absolute_url}"]["LASTURL"]) ? htmlspecialchars($_SESSION["ADMIN:{$absolute_url}"]["LASTURL"]) : "{$this->var->get_kam}={$this->var->adresaadminu}");

      $this->var->main[0]->VypisVsechnyChyby();  //hlavni vypis chyby
    }
      else
    {
      if (!file_exists($this->fileprom))
      {
        echo "chyby: <strong>{$this->fileprom}</strong>!!<br />";
      }

      if (!file_exists($this->filefunc))
      {
        echo "chyby: <strong>{$this->filefunc}</strong>!!<br />";
      }
      exit(1);
    }

    $result =
    "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"{$author}\" />
    <meta name=\"copyright\" content=\"{$copyright}\" />
    <meta name=\"keywords\" content=\"{$keywords}\" />
    <meta name=\"description\" content=\"{$this->var->nazevwebu}{$description}\" />
    <meta name=\"robots\" content=\"index, follow\" />
    <!-- {$rss} -->
    {$this->var->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/global_styles.css\" media=\"screen\" title=\"{$this->var->nazevwebu}\" />{$linux}{$opera}
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie7.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie6.css\" media=\"screen\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/highslide/highslide-ie6.css\" media=\"screen\" />
    <![endif]-->
    <title>{$this->var->nazevwebu}{$pomlcka}{$title}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->
    <script type=\"text/javascript\" src=\"{$absolute_url}script/highslide/highslide-with-gallery-yui.js\"></script>
    <script type=\"text/javascript\">
      hs.graphicsDir = '{$absolute_url}obr/highslide/';
      hs.align = 'center';
      hs.transitions = ['expand', 'crossfade'];
      {$highslideoutlinetype} = '{$outlinetypehodnota}'; // (jedna hodnota vzhledu) [rounded-white, rounded-black, glossy-dark, outer-glow]
      {$highslidewrapperclassname} = '{$wrapperclassnamehodnota}'; // (jedna nebo kombinace hodnot vzhledu) [in-page, controls-in-heading, dark, floating-caption, borderless, draggable-header, colored-border, outer-glow, no-footer, wide-border]
      hs.fadeInOut = {$fadeinoutprolnuti}; // pruhledne prolnuti pri zobrazeni obrazku (true [pomalejsi] x false [rychlejsi])
      hs.numberPosition = '{$highslidenumberposition}'; // caption, heading (obrazek % z %, caption = pod obrazkem, heading nad obrazkem, prazdne = nezobrazi)
      hs.dimmingOpacity = {$highslidepozadi}; // pruhlednost pozadi (0 - 1)

      // Add the controlbar
      if (hs.addSlideshow) hs.addSlideshow({
        //slideshowGroup: 'group1',
        interval: 5000,
        repeat: false,
        useControls: {$highslidepanelzapvyp}, // zapnuto-vypnuto (zapnuti x vypnuti panelu)
        fixedControls: {$panelstatickyplovouci}, // \"fit\" ('fit'), false (pozice panelu pri prochazeni obrazku - staticka [\"fit\"], plovouci [false])
        overlayOptions: {
          opacity: {$highslidepanel}, // pruhlednost panelu (0 - 1)
          position: '{$highslidepanelpozice}', // pozice (jakekoliv kombinace)
          hideOnMouseOut: {$highslidepanelzobrazeni}
        } // stale-zobrazeni (urcuje zda bude panel stale zobrazen nebo jen po najeti mysi [true x false])
      });
    </script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/jquery-132-yui.js\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/jquery.ui-1.7.min.js\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/log_ad.js\"></script>
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <h1 title=\"{$this->var->nazevwebu}{$pomlcka}{$title}\"><a href=\"{$absolute_url}\" title=\"{$this->var->nazevwebu}\"><span>{$this->var->nazevwebu}{$pomlcka}{$title}</span></a></h1>
      </div>
      <div id=\"obal_sekce\">
        <ul id=\"menu\">
{$menu}        </ul>
        <div class=\"obsah {$idsekceclass}\">
          <h2 title=\"{$title}{$titleuvod}\">{$title}{$titleuvod}</h2>
{$obsah}


{$os} - OS<br />
{$brow} - BROWSER<br />
{$prep} - PREPINANI<br />
{$flash} - FLASH<br />
{$flash1} - FLASH 1<br />

{$jazyk} - JAZYK<br />
{$obr} - OBR<br />
{$rsslink} - RSSLINK<br />
{$captcha1} - CAPTCHA1<br />

{$sekce} - SEKCE<br />
{$galerie} - GALERIE<br />
{$text} - TEXT<br />
{$text2} - TEXT2<br />
<!--
{$search} - SEARCH<br />
{$infokosik} - INFOKOSIK<br />
-->

{$this->var->chyba}
        </div>
      </div>
      <div id=\"zapati\">
        <p>
          {$info_web}{$info_blok}
          {$zapaticopyright} | {$createdby} | {$validatorxhtml} &amp; {$validatorcss}
        </p>
        <span id=\"vygenerovano\">{$vygenerovano} {$this->var->main[0]->NactiFunkci("Funkce", "KonecCas")} s</span>
        <div id=\"obal_moo_ad\" style=\"{$poziceadpanelu}: 12px;\">
          {$moologvolani}<!-- <span id=\"odkaz_ad\" style=\"{$poziceadpanelu}: -12px;\"></span> -->
          <div id=\"moo_ad\" class=\"moo_log\">
            <span class=\"moo_log_zah_zap\"><span id=\"close\" class=\"moo_close\" title=\"Zavřít\"></span></span>
              <div>
                <span id=\"moo_span\"><span id=\"moo_cajovna\"><!-- --></span><strong>{$this->var->nazevwebu}</strong><span><!-- --></span></span>
                <form method=\"post\" action=\"\">
                  <fieldset>
                    <label id=\"ll_moo_ad\">
                      <span class=\"prvni_span\"><span><!-- --></span></span>
                      <input type=\"text\" name=\"log_ad\" />
                    </label>
                    <label>
                      <span class=\"prvni_span\"><span><!-- --></span></span>
                      <input type=\"password\" name=\"log_he\" />
                    </label>
                    <input type=\"submit\" onclick=\"document.getElementById('log_ad_id').style.display='none';\"{$this->var->adminlogin} name=\"tl_log\" id=\"log_ad_id\" class=\"moo_log_tl\" value=\"&nbsp;\" title=\"Vstoupit\" />
                  </fieldset>
                </form>
              </div>
            <span class=\"moo_log_zah_zap\">".(!Empty($this->var->backadmin) ? "<a href=\"{$absolute_url}?{$linkadmin}\" title=\"Vstup bez přihlašování\" class=\"prejit_odkaz\">Vstup bez přihlašování >></a>" : "<!-- -->")."</span>
          </div>
        </div>
        <script type=\"text/javascript\">
          $('#obal_moo_ad').rb_menu({
            autoHide: {$autohideadpanelu},
            effectDurationIn: {$rychlostprijetiadpanelu},
            effectDurationOut: {$rychlostodjetiadpanelu},
            triggerEvent: '{$stylvolaniadpanelu}',
            directionIn: '{$smerprijetiadpanelu}',
            directionOut: '{$smerodjetiadpanelu}',
            transitionIn: '{$stylprijetiadpanelu}',
            transitionOut: '{$stylodjetiadpanelu}'
          });
        </script>
      </div>
    </div>
    <!--
      *** script GOOGLE ANALYTICS ***
    -->
  </body>
</html>";

    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      $result =
      "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"{$author}\" />
    <meta name=\"copyright\" content=\"{$copyright}\" />
    <meta name=\"description\" content=\"{$this->var->nazevwebu}{$description}\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->var->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/global_styles_admin.css\" media=\"screen\" />
      {$admin_styles}{$linux}
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie7_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie6_admin.css\" media=\"screen\" />
    <![endif]-->
    <title>{$this->var->nazevwebu} - {$admintitle}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->
    <script type=\"text/javascript\" src=\"{$absolute_url}script/highslide/highslide-with-gallery-yui.js\"></script>
    <script type=\"text/javascript\">
      hs.graphicsDir = '{$absolute_url}obr/highslide/';
      hs.align = 'center';
      hs.transitions = ['expand', 'crossfade'];
      {$highslideoutlinetype} = '{$outlinetypehodnota}'; // (jedna hodnota vzhledu) [rounded-white, rounded-black, glossy-dark, outer-glow]
      {$highslidewrapperclassname} = '{$wrapperclassnamehodnota}'; // (jedna nebo kombinace hodnot vzhledu) [in-page, controls-in-heading, dark, floating-caption, borderless, draggable-header, colored-border, outer-glow, no-footer, wide-border]
      hs.fadeInOut = {$fadeinoutprolnuti}; // pruhledne prolnuti pri zobrazeni obrazku (true [pomalejsi] x false [rychlejsi])
      hs.numberPosition = '{$numberpositionadmin}'; // caption, heading (obrazek % z %, caption = pod obrazkem, heading nad obrazkem, prazdne = nezobrazi)
      hs.dimmingOpacity = {$highslidepozadi}; // pruhlednost pozadi (0 - 1)

      // Add the controlbar
      if (hs.addSlideshow) hs.addSlideshow({
        //slideshowGroup: 'group1',
        interval: 5000,
        repeat: false,
        useControls: {$usecontrolsadmin}, // zapnuto-vypnuto (zapnuti x vypnuti panelu) {$highslidepanelzapvyp} vypnuto pro datovy sklad
        fixedControls: {$panelstatickyplovouci}, // \"fit\" ('fit'), false (pozice panelu pri prochazeni obrazku - staticka [\"fit\"], plovouci [false])
        overlayOptions: {
          opacity: {$highslidepanel}, // pruhlednost panelu (0 - 1)
          position: '{$highslidepanelpozice}', // pozice (jakekoliv kombinace)
          hideOnMouseOut: {$highslidepanelzobrazeni}
        } // stale-zobrazeni (urcuje zda bude panel stale zobrazen nebo jen po najeti mysi [true x false])
      });
    </script>
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <h1>
          {$admintitle}
        </h1>
        <h2>
          <a href=\"{$absolute_url}?action=\$ad\" title=\"{$this->var->nazevwebu}\">
            <span>Administrace</span>
            {$this->var->nazevwebu}
          </a>
          {$this->var->adminuser["name"]}
        </h2>
      </div>
      <div id=\"obal_sekce\">
        <ul id=\"menu\">
{$adminmenu}
        </ul>
        <div class=\"obsah\">
{$adminobsah}
{$this->var->chyba}
        </div>
      </div>
      <div id=\"zapati\">
        <p>
          {$zapaticopyright} | {$createdby} | {$vygenerovano} {$this->var->main[0]->NactiFunkci("Funkce", "KonecCas")} s
        </p>
        <p>
          {$this->var->main[0]->NactiFunkci("Funkce", "CasAktualizace")}
        </p>
      </div>
    </div>
  </body>
</html>";
    }

    echo $result;
  }
}

$web = new Layout();
?>
