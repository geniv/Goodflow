<?php

/**
 *
 * Centralni index projektu a hlavni nalinkovani funkce
 *
 */

class Eshop
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

      //menu
      $menu =$this->var->main[0]->NactiFunkci("DynamicEshopMenu", "Menu");
      //obsah
      $obsah = $this->var->main[0]->NactiFunkci("DynamicObsahEshop", "ObsahEshop");
      $infokosik = $this->var->main[0]->NactiFunkci("DynamicObsahEshop", "InfoKosik");
      $search = $this->var->main[0]->NactiFunkci("DynamicObsahEshop", "VyhledatPolozku");

      $title = $this->var->main[0]->NactiFunkci("DynamicEshopMenu", "Title").$this->var->main[0]->NactiFunkci("DynamicObsahEshop", "Title");
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
    "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
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
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
    <![endif]-->
    <title>Eshop - {$title}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />              -->
    <!-- <script type=\"text/javascript\" src=\"script/funkce.js\"></script>  -->
  </head>
  <body>
    <div id=\"obal_layout\">
        <div id=\"zahlavi\">
            {$search}<br />
            <span id=\"kosInfo\">{$infokosik}</span>
            <span id=\"eshopEmail\"><a href=\"mailto:eshop@bslaguna.cz\"><img src=\"Design/eshop_email.jpg\" /></a></span>
        </div>
        <div id=\"obal_obsah\">
            <div id=\"menu_obal\">
                {$menu}
            </div>
            <div id=\"vypis_sekce\">
                {$obsah}
                <hr class=\"oddelovac\" />
            </div>
            {$this->var->chyba}
        <hr class=\"cistic\" />
        </div>
        <div id=\"zapati\">
            <p>
            ".($this->var->administrace ? "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}\">(admin)</a>" : "")." |
            vygenerováno za: {$this->var->main[0]->NactiFunkci(0, "KonecCas")} s
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
      "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
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
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
    <![endif]-->
    <title>Eshop - Administrace</title>
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

$web = new Eshop();
?>
