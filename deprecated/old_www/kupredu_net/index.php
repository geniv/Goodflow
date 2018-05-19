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
    $this->var->web = "http://{$_SERVER["SERVER_NAME"]}{$this->var->temp}";

    $obsah = $this->var->main->ObsahStranky();  //vypis obsahu stranek
    $menu = $this->var->main->Menu();
    $novinky = $this->var->main->Novinky();

    $podminka = ($this->var->kam == "cenik" || $this->var->kam == "sit" || $this->var->kam == "kontakt");
    $podminka2 = ($this->var->kam == "form_doprava" || $this->var->kam == "form_satelity");

    $result =
    "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
    <head>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
      <meta http-equiv=\"Content-Language\" content=\"cs\" />
      <meta name=\"author\" content=\"Geniv &amp; Fugess &amp; Jurkix (GF Design)\" />
      <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz)\" />
      <meta name=\"keywords\" content=\"internet, net, poskytovatel internetu,kupredu.net, kupředu.net, kupredu net, kupředu net, autodoprava, doprava, přeprava, preprava, satelitní příjem, satelitni prijem, satelitni TV, satelitní TV, e-shop, online shop\" />
      <meta name=\"description\" content=\"Kupředu net - communications for you, internet for life... | zprostředkování připojení k internetu | autodoprava | montáž satelitních přijímačů | e-shop\" />
      <meta name=\"robots\" content=\"noindex, nofollow\" />
      {$this->var->meta}
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->web}/styles/global_styles" .($podminka ? "1" : ($podminka2 ? "2" : "")). ".css\" media=\"screen\" />
      <!--[if IE]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->web}/styles/styles_IE.css\" media=\"screen\" />
      <![endif]-->
      <!--[if IE 7]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->web}/styles/styles_IE7.css\" media=\"screen\" />
      <![endif]-->
      <!--[if lte IE 6]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->var->web}/styles/styles_IE6.css\" media=\"screen\" />
      <![endif]-->
      <title>Kupředu net - communications for you, internet for life...</title>
      <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
      <script type=\"text/javascript\" src=\"script/funkce.js\"></script>
      <link type=\"application/rss+xml\" rel=\"alternate\" href=\"rss\" />
    </head>
    <body>
     <div id=\"zahlavi\">
  <h1>kupredu net</h1>
  <a href=\"./\" title=\"Hlavní strana\"></a>
      </div>

<div id=\"obal_layout\">
".($podminka ? "<div id=\"menu\">{$menu}</div>" : "")."
                 <div id=\"obal_obsah\">

    <div id=\"obsah_levy\">
{$obsah}<br />
{$this->var->chyba}<br />
    </div>
".($podminka ? "{$novinky}" : "")."
                   </div>
                <div id=\"zapati\">
                  <p>
                    &copy; 2008 Kupredu.net &bull; valid <a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict\" rel=\"nofollow\">xhtml</a> | <a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS 2.1\" rel=\"nofollow\">css</a> &bull; Created by <a href=\"http://gfdesign.cz\" title=\"GFdesign.cz\" rel=\"nofollow\">GF design</a>
        </p>
                </div>
  <div id=\"zapati_bg\">
  <h1>img naspodu</h1>
  </div>
      </div>
<a href=\"index.php?action=admin\">...</a>
    </body>
  </html>";

    echo $result;
  }
}

$web = new Layout();
?>
