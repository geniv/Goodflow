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
  function __construct()
  {
    if (file_exists($this->fileprom) && file_exists($this->filefunc))
    {
      include_once $this->fileprom; //vlozeni promennych
      include_once $this->filefunc; //vlozeni funkce

      $this->var = new Promenne();  //vytvoreni promennych
      $this->var->main[0] = new Funkce($this->var, 0);  //vytvoreni funkce
      $this->var->main[0]->InicializaceModulu();  //hlavni incializace dalsich definovanych modulu

      $this->var->main[0]->NactiFunkci("Funkce", "StartCas");  //zacatek mereni generovani stranky

      $admintitle = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminTitle");
      $adminmenu = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminMenu");
      $adminobsah = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminObsah");

      //echo $this->var->main[0]->UnikatniText("pokus1", $this->var->get_kam, "ahoj1", "text2", "pokus3");

      //$menu = $this->var->main[0]->NactiFunkci("DynamicEshopMenu", "Menu");  //vygenerovani menu

      $pocetradku = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "PocetRadkuNavstevniKniha", "adresa");
      $strankovani = $this->var->main[0]->NactiFunkci("StatickeStrankovani", "Strankovani", 3, $pocetradku, "hu1/", "limit");

      $this->var->preload[0] = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "NavstevniKniha", "adresa", false, NULL, $strankovani);

      $menu = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu");
      $obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek");
      $title = $this->var->main[0]->NactiFunkci("StaticMenu", "Title");


      $title .= $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "Title", "adresa");
      $galerie = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "SekceGallery", "adresa", "galerie/");
      $text = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "PictureGallery", "adresa");

//var_dump($strankovani);
      //$title .= $this->var->main[0]->NactiFunkci("DynamicMenu", "Title", "adresovita");
      //$search = $this->var->main[0]->NactiFunkci("DynamicMenu", "DynamickyMenu", "hu1", "adresa");

      //$text = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", $_GET["sekce"]);
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

      //$title .= $text = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "Title");
      //$flash = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RychloVypis", array("adresa", "adresa1"));
      //$flash = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RychloVypis", "adresa1");
      //$flash1 = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "DynamickeZobrazeni", "adresa", true, NULL);
      //$text = $this->var->main[0]->NactiFunkci("DynamicDrinks", "Drinks", "adresa");

      //$rss = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSLink", "adresa1");
      //$rss = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSLink", array("adresa", "adresa1"));

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

//var_dump($_SESSION);
//var_dump($_SERVER["PHP_AUTH_USER"], $_SESSION);
//var_dump($slovo);
//var_dump($_GET[$this->var->get_kam]);
//var_dump($_SERVER["HTTP_USER_AGENT"]);
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "TypOS", $_SERVER["HTTP_USER_AGENT"]));
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $_SERVER["HTTP_USER_AGENT"]));

      $absolute_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

      $linux = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu") ?
                ($this->var->aktivniadmin ?
                "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_linux_admin.css\" media=\"screen\" />" : //admin
                "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_linux.css\" media=\"screen\" />")  //normal
                : "");

      $opera = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceOpery") ?
                "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_opera_form.css\" media=\"screen\" />" :
                "");
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

    //eval("\$vysl[]=\$absolute_url;");
    //var_dump($vysl);

    $result =
    "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"Geniv &amp; Fugess &amp; Jurkix (GF Design - www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz - www.gfdesign.cz)\" />
    <meta name=\"keywords\" content=\"\" />
    <meta name=\"description\" content=\"\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->var->meta}
    {$rss}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/global_styles.css\" media=\"screen\" />
      {$linux}
      {$opera}
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie7.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie6.css\" media=\"screen\" />
    <![endif]-->
    <title>{$this->var->nazevwebu} - {$title}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />              -->
    <!-- <script type=\"text/javascript\" src=\"script/funkce.js\"></script>  -->
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <h1>{$this->var->nazevwebu}</h1>
      </div>
      <div id=\"obal_obsah\">
        <div id=\"menu_obal\">
({$os},
{$brow}),
[{$prep}],
{$flash},
<hr />
{$flash1}
{$jazyk}
{$obr}
{$rsslink}
{$captcha1}

{$sekce}
{$galerie}
{$text}
{$text2}

{$search}
{$infokosik}<br />
{$menu}          </div>
        <div id=\"vypis_sekce\">{$obsah}        </div>
{$this->var->chyba}
        <dl>
          <dt>
            termin
          </dt>
          <dd>
            definice
          </dd>
        </dl>
".($this->var->administrace ? "<a href=\"{$absolute_url}?{$this->var->get_kam}={$this->var->adresaadminu}\">(admin)</a>" : "")."
      </div>
      <div id=\"zapati\">
        <p>
          vygenerováno za: {$this->var->main[0]->NactiFunkci("Funkce", "KonecCas")} s
        </p>
      </div>
    </div>
  </body>
</html>
    ";

//*****************************************************************************//
//                                                                             //
//                                                                             //
//                         Adminisracni index                                  //
//                                                                             //
//                                                                             //
//*****************************************************************************//

    if ($this->var->aktivniadmin)
    {
      $result =
      "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"Geniv &amp; Fugess &amp; Jurkix (GF Design - www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz - www.gfdesign.cz)\" />
    <meta name=\"keywords\" content=\"\" />
    <meta name=\"description\" content=\"\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->var->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/global_styles_admin.css\" media=\"screen\" />
      {$linux}
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie7_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie6_admin.css\" media=\"screen\" />
    <![endif]-->
    <title>Administrace {$this->var->nazevwebu} - {$admintitle}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />              -->
    <!-- <script type=\"text/javascript\" src=\"script/funkce.js\"></script>  -->
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <h1>{$this->var->nazevwebu} - Administrace</h1>
      </div>
      <div id=\"obal_obsah\">
        <div id=\"menu_obal\">
{$adminmenu}          </div>
        <div id=\"vypis_sekce\">{$adminobsah}        </div>
{$this->var->chyba}
      </div>
      <div id=\"zapati\">
        <p>
          vygenerováno za: {$this->var->main[0]->NactiFunkci("Funkce", "KonecCas")} s,
          {$this->var->main[0]->NactiFunkci("Funkce", "CasAktualizace")}
        </p>
      </div>
    </div>
  </body>
</html>
      ";
    }

    echo $result;
  }
}

$web = new Layout();
?>
