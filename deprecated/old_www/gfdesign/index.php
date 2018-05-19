<?php

/**
 *
 * Centralni index projektu a hlavni nalinkovani funkce a promennych
 *
 */

class GFdesign
{
  private $var;
  private $fileprom = "promenne.php"; //soubor promennych
  private $filefunc = "funkce.php"; //soubor funkce

/**
*
* Konstruktor hlavniho indexu
*
*/
  function __construct()
  {
    if (file_exists($this->fileprom) && file_exists($this->filefunc))
    {
      include_once $this->fileprom; //vlozeni promennych
      include_once $this->filefunc; //vlozeni funkce

      $this->var = new Promenne();  //vytvoreni promennych
      $this->var->main[0] = new Funkce($this->var, 0);  //vytvoreni funkce
      $this->var->main[0]->InicializaceModulu();  //hlavni incializace dalsich modulu

      $this->var->main[0]->NactiFunkci("Funkce", "StartCas");  //zacatek mereni generovani stranky

      $adminmenu = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminMenu");
      $adminobsah = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminObsah");

      $title = $this->var->main[0]->NactiFunkci("StaticMenu", "Title");
      $obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek");
      $menu = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu");  //vygenerovani menu

      $flash = $this->var->main[0]->NactiFunkci("FlashHeader", "Flash");

      $prep = $this->var->main[0]->NactiFunkci("PrepinaniPodleSekci", "Prepinani");

      $rss = $this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "RSSLink");
      $this->var->main[0]->NactiFunkci("DynamicRSS", "RSSVystup");

      $jazyk = $this->var->main[0]->NactiFunkci("DynamicLanguage", "SeznamJazyku");
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
      exit;
    }

    $linux = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu") ?
              ($this->var->aktivniadmin ?
              "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_linux_admin.css\" media=\"screen\" />" : //admin
              "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_linux.css\" media=\"screen\" />")  //normal
              : "");

    $result =
    "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"Geniv &amp; Fugess &amp; Jurkix (GF Design - www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz - www.gfdesign.cz)\" />
    <meta name=\"keywords\" content=\"\" />
    <meta name=\"description\" content=\"GF Design - Geniv &amp; Fugess &amp; Jurkix Design - Tvorba webových stránek a systémů\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->var->meta}
    {$rss}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/global_styles.css\" media=\"screen\" />
      {$linux}
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_ie7.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_ie6.css\" media=\"screen\" />
    <![endif]-->
    <title>GF Design - Tvorba webových stránek a systémů{$title}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->
{$prep}
    <!-- highslide -->
      <script type=\"text/javascript\" src=\"script/highslide/highslide-full.js\"></script>
      <script type=\"text/javascript\">
        hs.graphicsDir = 'obr/highslide/';
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.outlineType = 'rounded-white';
        hs.fadeInOut = true;
        //hs.dimmingOpacity = 0.75;

        // Add the controlbar
        hs.addSlideshow({
          //slideshowGroup: 'group1',
          interval: 5000,
          repeat: false,
          useControls: true,
          fixedControls: 'fit',
          overlayOptions: {
            opacity: .75,
            position: 'bottom center',
            hideOnMouseOut: true
          }
        });
      </script>
    <!-- /highslide -->
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <div id=\"header_logo\">
          {$flash}
        </div>
        <h1>GF Design - Tvorba webových stránek a systémů</h1>
        <ul>
          <!--[if !IE]> -->
            <li id=\"nahrada_za_sousediciho_sourozence\">
              <strong>GF Design - Tvorba webových stránek a systémů</strong>
            </li>
            <li id=\"background_menu_ie6\">
              <strong>GF Design - Geniv &amp; Fugess &amp; Jurkix Design</strong>
            </li>
          <!-- <![endif]-->
{$menu}          <!--[if IE]>
            <li id=\"nahrada_za_sousediciho_sourozence\">
              <strong>GF Design - Tvorba webových stránek a systémů</strong>
            </li>
            <li id=\"background_menu_ie6\">
              <strong>GF Design - Geniv &amp; Fugess &amp; Jurkix Design</strong>
            </li>
          <![endif]-->
        </ul>
        <span id=\"background_odraz_menu\"></span>
        <span id=\"background_koreny_zahlavi\"></span>
      </div>
      <div id=\"obal_obsah\">{$obsah}{$this->var->chyba}        <span id=\"background_koreny_obal_obsah\"></span>
      </div>
      <div id=\"obal_body_background_bottom\">
        <div id=\"zapati\">
          <p>
            vygenerováno za: {$this->var->main[0]->NactiFunkci("Funkce", "KonecCas")} s
          </p>
          <em>
            {$jazyk}".($this->var->administrace ? "<a href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}?{$this->var->get_kam}={$this->var->adresaadminu}\" title=\"admin\">(admin)</a>" : "")."
          </em>
        </div>
      </div>
    </div>
    <div id=\"preloader\">
      <span id=\"preload_01\"></span>
      <span id=\"preload_02\"></span>
      <span id=\"preload_03\"></span>
      <span id=\"preload_04\"></span>
      <span id=\"preload_05\"></span>
      <span id=\"preload_06\"></span>
      <span id=\"preload_07\"></span>
      <span id=\"preload_08\"></span>
      <span id=\"preload_09\"></span>
      <span id=\"preload_10\"></span>
      <span id=\"preload_11\"></span>
      <span id=\"preload_12\"></span>
      <span id=\"preload_13\"></span>
      <span id=\"preload_14\"></span>
      <span id=\"preload_15\"></span>
      <span id=\"preload_16\"></span>
      <span id=\"preload_17\"></span>
      <span id=\"preload_18\"></span>
      <span id=\"preload_19\"></span>
      <span id=\"preload_20\"></span>
      <span id=\"preload_21\"></span>
      <span id=\"preload_22\"></span>
      <span id=\"preload_23\"></span>
      <span id=\"preload_24\"></span>
      <span id=\"preload_25\"></span>
      <span id=\"preload_26\"></span>
      <span id=\"preload_27\"></span>
      <span id=\"preload_28\"></span>
      <span id=\"preload_29\"></span>
      <span id=\"preload_30\"></span>
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
      "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
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
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/global_styles_admin.css\" media=\"screen\" />
      {$linux}
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_ie_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_ie7_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_ie6_admin.css\" media=\"screen\" />
    <![endif]-->
    <title>Výchozí layout - Administrace</title>
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
          vygenerováno za: {$this->var->main[0]->KonecCas()} s
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

$web = new GFdesign();

?>
