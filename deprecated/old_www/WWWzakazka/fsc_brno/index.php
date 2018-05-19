<?php
  include_once "promenne.php";
  include_once "funkce.php";
  include_once "login.php";

class FSCBrno  //hlavní skládací třída
{
  public $var;
  //****************************************************************************
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->login = new Login();  //vytvoření objektu login
    $this->var->main = new Hlavni($this->var);

		$this->var->main->StartCas();

		if ($con = $this->var->main->OtevriMySQLi())//$this->var,$this->login$this->var,
    {
      $this->var->main->InstalaceMySQLi();//$this->var, $this->login

  		$obsah = $this->var->main->ObsahStrakny();
  		$chyba = $this->var->chyba;

  		$result =
        "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
          \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
          <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
            <head>
              <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
              <meta http-equiv=\"Content-Language\" content=\"cs\" />
              <meta name=\"author\" content=\"GF Design - www.gfdesign.cz - Geniv &amp; Fugess\" />
              <meta name=\"copyright\" content=\"GF Design &copy; 2008 - www.gfdesign.cz\" />
              <meta name=\"keywords\" content=\"Figure Scating Club - Technika Brno - Oddíl krasobruslení, Figure Scating Club, Technika Brno, Oddíl krasobruslení, FSC, FSC Brno, FSC Technika Brno, FSC Oddíl krasobruslení\" />
              <meta name=\"description\" content=\"Figure Scating Club - Technika Brno - Oddíl krasobruslení\" />
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
                AjaxStranka('{$this->var->default}', '');
              </script>
              <title>Figure Scating Club - Technika Brno - Oddíl krasobruslení</title>
            </head>
            <body>
              <div id=\"hlavni_obal_layout\">
                <div id=\"zahlavi\">
                  <h1>Figure Scating Club - Technika Brno - Oddíl krasobruslení</h1>
                  ".($_GET["action"] != "administrace" ? "
                  <!--[if !IE]> -->
                    <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/zahlavi_fsc.swf\" width=\"746\" height=\"247\">
                  <!-- <![endif]-->
                  <!--[if IE]>
                    <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"746\" height=\"247\">
                      <param name=\"movie\" value=\"{$this->var->web}/flash/zahlavi_fsc.swf\" />
                  <!--><!---->
                      <param name=\"loop\" value=\"true\" />
                      <param name=\"menu\" value=\"false\" />
                      <param name=\"wmode\" value=\"opaque\" />
                      <param name=\"bgcolor\" value=\"#46444c\" />
                      <p id=\"no_flash\"></p>
                    </object>
                  <!-- <![endif]-->" :
                  "<p id=\"zahlavi_admin\">
                    <a href=\"./\" title=\"Hlavní strana\"></a>
                  </p>")."
                </div>
  ".($_GET["action"] != "administrace" ? "
  <div id=\"obal_layout\">
  <!-- nahradni obsah -->
  <noscript>
    <p>Javascript je vypnut!! Zapněte jej prosím! Některé funkce stránek jsou omezeny!</p>
  </noscript>
  <!-- nahradni obsah -->
  </div>
  " : "
  <div id=\"obal_layout_admin\">
  {$chyba}
  {$obsah}
  </div>
                  ")."
                  <div id=\"zapati\">
                    <div>
                      <span></span>
                    </div>
                    <p>
                      <span class=\"prvni\">
                        Copyright © <a href=\"http://www.azsystem.cz/\" title=\"AZ System s.r.o. - Váš průvodce světem softwaru a hardwaru, webových aplikací a počítačového poradenství\" onclick=\"window.open(this.href); return false;\">AZ System s.r.o</a> 2008
                      </span>
                      <span>
                        Design &amp; Coding by Fugess, Programming by Geniv, Project head leader by <a href=\"mailto:pavel.muzik@post.cz\" title=\"Bc. Pavel Mužík\">Bc. Pavel Mužík</a>
                      </span>
                    </p>
                  </div>
              </div>
            </body>
          </html>";
          // , Created by <a href=\"http://www.gfdesign.cz/\" title=\"Fugess &amp; Geniv &amp; Jurkix Design - Stránky tvůrců webových prezentací\" onclick=\"window.open(this.href); return false;\">GF Design</a>
          //<a href=\"mailto:fugess@gfdesign.cz\" title=\"Fugess\">Fugess</a>
          //<a href=\"mailto:geniv@gfdesign.cz\" title=\"Geniv\">Geniv</a>
          

      $this->var->main->ZavriMySQLi(); //uzávěr databáze
    }
      else
    {
      $result =
      "
        {$this->var->chyba}
      ";
    }

		echo $result;
  }
}

  $web = new FSCBrno();  //vytvoření hlavního objektu
?>
