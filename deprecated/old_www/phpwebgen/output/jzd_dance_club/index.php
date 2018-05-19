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

      $menu = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu");
      $obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek");
      $title = $this->var->main[0]->NactiFunkci("StaticMenu", "Title");

      //$title .= $this->var->main[0]->NactiFunkci("DynamicMenu", "Title", "adresovita");
      //$search = $this->var->main[0]->NactiFunkci("DynamicMenu", "DynamickyMenu", "hu1", "adresa");

      $text = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", $_GET["sekce"]);

      //$title .= $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup", "Title", "adresa");
      //$search = $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup", "DynamickyMenu", "adresa");

      //$text = $this->var->main[0]->NactiFunkci("DynamicGallery", "Gallery", "adresa");

      //$text = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", "adresa");
      //$text = $this->var->main[0]->NactiFunkci("DynamicTable", "Table", "adresa");

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

      $flash = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RychloVypis", "adresa");
      $flash1 = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "DynamickeZobrazeni", "adresa");

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
{$jazyk}
{$obr}
{$rsslink}

{$sekce}
{$galerie}
{$text}

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
        <h1>Výchozí layout</h1>
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
