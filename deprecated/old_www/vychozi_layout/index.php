<?php
include_once "promenne.php";
include_once "funkce.php";

class Layout
{
  public $var;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();
    $this->var->main = new Funkce($this->var);
    
    $this->var->main->StartCas();

    $menu = $this->var->main->Menu();
    $obsah = $this->var->main->ObsahStranky();  //vypis obsahu stranek
      
      $result =
      "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
    <head>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
      <meta http-equiv=\"Content-Language\" content=\"cs\" />
      <meta name=\"author\" content=\"Geniv &amp; Fugess (GF Design)\" />
      <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz)\" />
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
      <title>Výchozí layout</title>
      <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />              -->
      <!-- <script type=\"text/javascript\" src=\"script/funkce.js\"></script>  -->
    </head>
    <body>
      <div id=\"obal_layout\">
        <div id=\"zahlavi\">
          <h1>Výchozí layout</h1>
        </div>
        <div id=\"obal_obsah\">

{$menu}<br />
{$obsah}<br />
{$this->var->chyba}<br />

        </div>
        <div id=\"zapati\">
          <p>{$this->var->main->KonecCas()}</p>
        </div>
      </div>
    </body>
  </html>
      ";

    echo $result;
  }
//******************************************************************************
}

$web = new Layout();
?>
