<?php
  include_once "promenne.php";
  include_once "funkce.php";

class Jurkix  //hlavní skládací třída
{
  public $var;
  //****************************************************************************
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->main = new Hlavni($this->var);

		$this->var->main->StartCas();

		$novinky = include_once "novinky.php";
		$obsah = $this->var->main->ObsahStrakny();
		$menu = $this->var->main->Menu();
		$chyba = $this->var->chyba;

		$result =
      "
      <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
        <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
          <head>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <meta http-equiv=\"Content-Language\" content=\"cs\" />
            <meta name=\"author\" content=\"Jurkix &amp; Geniv &amp; Fugess, (GF Design)\" />
            <meta name=\"copyright\" content=\"Jurkix (c) 2008, Geniv (c) 2008, Fugess (c) 2008, Created by GF Design - info@gfdesign.cz\" />
            <meta name=\"keywords\" content=\"Jurkix, Jurkix design, Jurkix GFdesign, grafika, photoshop, cinema 4d, pixel art, flash, design, webdesign, web, tvorba webu, návrh webu\" />
            <meta name=\"description\" content=\"Jurkix design - Grafika | Animace | Webdesign\" />
            <meta name=\"robots\" content=\"index, follow\" />
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
            <!--[if IE]>
              <script type=\"text/javascript\" src=\"script/script_flash.js\" defer=\"defer\"></script>
            <![endif]-->
            <script type=\"text/javascript\" src=\"script/funkce.js\"></script>
              <!-- lightbox -->
                <script type=\"text/javascript\" src=\"script/lightbox/prototype.js\"></script>
                <script type=\"text/javascript\" src=\"script/lightbox/scriptaculous.js?load=effects,builder\"></script>
                <script type=\"text/javascript\" src=\"script/lightbox/lightbox.js\"></script>
              <!-- lightbox -->
            <script type=\"text/javascript\">
              AjaxStranka('{$this->var->default}', '', '', '');
            </script>
            <title>Jurkix design</title>
          </head>
          <body>
            
              <div id=\"zahlavi\">
                <h1>Jurkix design - Grafika | Animace | Webdesign</h1>
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/logo_new_web.swf\" width=\"710\" height=\"165\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"710\" height=\"165\">
                    <param name=\"movie\" value=\"{$this->var->web}/flash/logo_new_web.swf\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#433025\" />
                    <p id=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>

".($_GET["action"] != "administrace" ? "
<div id=\"obal_layout\">
<!-- nahradni obsah -->
<noscript>
  <p>Javascript je vypnut!! Zapněte jej prosím! Některé funkce stránek jsou omezeny!</p>
                <div id=\"menu\">
                  {$menu}
                </div>
                <div id=\"obal_obsah\">
                  <div id=\"obsah\">
                  	{$obsah}
                  	{$chyba}
                  </div>
                  <div id=\"obal_novinky\">
                    <div id=\"novinky_top\"></div>
                      <div id=\"novinky_obsah\">
                        {$novinky}
                      </div>
                    <div id=\"novinky_bottom\"></div>
                  </div>
                </div>
                <div id=\"zapati\">
                  {$this->var->main->KonecCas()}
                  <p>
                    {$this->var->main->TextSekce("zapati")} | Valid <a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict\" rel=\"nofollow\">xhtml</a> &amp; <a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS 2.1\" rel=\"nofollow\">css</a> |
                  </p>
                </div>
</noscript>
<!-- nahradni obsah -->
</div>
" : "

                <div id=\"menu\">
                  {$menu}
                </div>
                <div id=\"obal_obsah\">
                  <div id=\"obsah\">
                  	{$obsah}
                  	{$chyba}
                  </div>
                  <div id=\"obal_novinky\">
                    <div id=\"novinky_top\"></div>
                      <div id=\"novinky_obsah\">
                        {$novinky}
                      </div>
                    <div id=\"novinky_bottom\"></div>
                  </div>
                </div>

                ")."

          </body>
        </html>";

		echo $result;
  }
}

  $web = new Jurkix();  //vytvoření hlavního objektu
?>
