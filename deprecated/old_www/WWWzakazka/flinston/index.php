<?php

/**
 *
 * Centralni index projektu a hlavni nalinkovani funkce a promennych
 *
 */

class Flinston
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

      $menu1 = $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup1", "DynamickyMenu", "menu");  //vygenerovani menu
      $menu2 = $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup2", "DynamickyMenu", "menu");  //vygenerovani menu
      $menu3 = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu");  //vygenerovani menu

      $obsah = $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup1", "ObsahStranek", "menu");
      $obsah .= $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup2", "ObsahStranek", "menu");
      
      $obsah .= $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek");

      $title = $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup1", "Title", "menu");
      $title .= $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup2", "Title", "menu");
      
      $title .= $this->var->main[0]->NactiFunkci("DynamicMenu", "Title", "realizace-zahrad-menu");
      $title .= $this->var->main[0]->NactiFunkci("DynamicMenu", "Title", "prodejna-menu");
      $title .= $this->var->main[0]->NactiFunkci("DynamicMenu", "Title", "interiery-menu");
      
      $title .= $this->var->main[0]->NactiFunkci("StaticMenu", "Title");

      //$title .= ($_GET[$this->var->get_kam] == "mapa-stranek" ? "Mapa stránek" : "");

      $prep = $this->var->main[0]->NactiFunkci("PrepinaniPodleSekci", "Prepinani", $_GET[$this->var->get_kam]);

      $linux = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu") ? ($this->var->aktivniadmin ? "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_linux_admin.css\" media=\"screen\" />" : "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_linux.css\" media=\"screen\" />") : "");

      $dynamickyobsah = ($_GET[$this->var->get_kam] == "" || $_GET[$this->var->get_kam] == "poradna" || $_GET[$this->var->get_kam] == "kontakty" || $_GET[$this->var->get_kam] == "mapa-stranek" ? $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "bocniobsahzaklad") : ""); 

      $dynamickyobsah .= ($_GET[$this->var->get_kam] == "realizace-zahrad" ? $this->var->main[0]->NactiFunkci("DynamicMenu", "DynamickyMenu", "realizace-zahrad", "realizace-zahrad-menu") : "");
      $dynamickyobsah .= ($_GET[$this->var->get_kam] == "prodejna" ? $this->var->main[0]->NactiFunkci("DynamicMenu", "DynamickyMenu", "prodejna", "prodejna-menu") : "");
      $dynamickyobsah .= ($_GET[$this->var->get_kam] == "interiery" ? $this->var->main[0]->NactiFunkci("DynamicMenu", "DynamickyMenu", "interiery", "interiery-menu") : "");
      
      $keywords = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "keywords");
      $description = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "description");
      $titlezaklad = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "titlezaklad");
      
      $galerienaboku = ($_GET[$this->var->get_kam] != "realizace-zahrad" && $_GET[$this->var->get_kam] != "prodejna" && $_GET[$this->var->get_kam] != "interiery" ? $this->var->main[0]->NactiFunkci("DynamicGallery", "Gallery", "bocnigalerie") : "");
      
      $opera = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceOpery") ? "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_opera_form.css\" media=\"screen\" />" : "");
      
      //$dynamickyformular = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", "adresa");
      
      //{$this->var->title[$_GET[$this->var->get_kam]]}
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

    $result =
    "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"Geniv &amp; Fugess &amp; Jurkix (GF Design - www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz - www.gfdesign.cz)\" />
    <meta name=\"keywords\" content=\"{$keywords}\" />
    <meta name=\"description\" content=\"{$description}\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->var->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/global_styles.css\" media=\"screen\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}styles/styles_ie6.css\" media=\"screen\" />
    <![endif]-->
    {$linux}{$prep}{$opera}
    <!-- mootools mouseenter -->
      <script type=\"text/javascript\" src=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}script/mootools/mootools-1.2.1-core-yc.js\"></script>
      <script type=\"text/javascript\" src=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}script/mootools/mouseenter.js\"></script>
    <!-- /mootools mouseenter -->
    <!-- highslide -->
      <script type=\"text/javascript\" src=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}script/highslide/highslide-full.js\"></script>
      <script type=\"text/javascript\">
        hs.graphicsDir = '{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}obr/highslide/';
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
    <title>{$titlezaklad} - {$title}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <h1>{$titlezaklad} - {$title}</h1>
        <p id=\"text_nadpis\"><strong>Flinston</strong> - <strong>Návrhy a realizace zahrad</strong> - <strong>{$title}</strong></p>
        <p id=\"admin\"><a href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}?{$this->var->get_kam}={$this->var->adresaadminu}\" title=\"\"></a></p>
        <div id=\"menu_zahlavi_nad\">
          <div>{$menu1}
          </div>
        </div>
        <div id=\"menu_zahlavi\">{$menu2}
        </div>
      </div>
      <div id=\"obal_obsah\">
        <div id=\"obsah_sloupce\">
{$dynamickyobsah}{$galerienaboku}\n        </div>
        <div id=\"hlavni_obsah\">
{$obsah}
        </div>{$this->var->chyba}
      </div>
      <div id=\"zapati\">
        <p id=\"autor\">
          Created by <a href=\"http://www.gfdesign.cz/\" title=\"GF Design - Tvorba webových stránek a systémů\">GF design</a>
        </p>
        <p id=\"stranka_vygenerovana\">
          {$menu3} - Vygenerováno za: {$this->var->main[0]->NactiFunkci("Funkce", "KonecCas")} s
        </p>
      </div>
    </div>
  </body>
</html>
    ";
//          <a href=\"{$this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl")}mapa-stranek\" title=\"Mapa stránek\">Mapa stránek</a>
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
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles_admin.css\" media=\"screen\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie7_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie6_admin.css\" media=\"screen\" />
    <![endif]-->
    {$linux}
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

$web = new Flinston();
?>
