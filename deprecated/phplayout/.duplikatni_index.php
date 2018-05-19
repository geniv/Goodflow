<?php
  //prenos ukazatele z funkce
  $this->var = $this->prenos;
  //normalni zapis dalsich funkci


$navigace = "";
$obsah = "";
$title = "";

//var_dump($this->var->main[0]->NactiFunkci("Funkce", "DetekceIExplorer"));
//$text = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", "adresa");
/*
    $struktura1 = $this->var->main[0]->NactiFunkci("StaticMenu", "NactiStrukturuMenu");
    $navigace = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu", $struktura1);
    $obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek", $struktura1);
    $title = $this->var->main[0]->NactiFunkci("StaticMenu", "Title", $struktura1);

    $struktura2 = $this->var->main[0]->NactiFunkci("StaticMenu", "NactiStrukturuMenu", 2);
    $navigace2 = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu", $struktura2);
var_dump($navigace, $navigace2);
*/

    //$text = $this->var->main[0]->NactiFunkci("DynamicLiteCentral", "LiteCentral", "testovaci-sablona");
    //$text = $this->var->main[0]->NactiFunkci("DynamicStat", "UserStatus");
    //$text1 = $this->var->main[0]->NactiFunkci("DynamicStat", "UserStatusClass");
    //$text = $this->var->main[0]->NactiFunkci("DynamicTable", "Table", "adresa");

    //$this->var->main[0]->NactiFunkci("DynamicCentral", "CentralDownload", "adresa");
    //$this->var->main[0]->NactiFunkci("DynamicCentral", "CentralDownload", "dsfgfsf");

    //$text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenu", array("adresa" => "adresa", "baseurl" => "polozky/"));
    //$text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenu", array("adresa" => "sdfgh", "baseurl" => "polozky/"));
    //$text1 = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "adresa", "baseurl" => "polozky/", "skryvat" => true));
    //$text1 = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "dsfgfsf", "subobsah" => "obsah-a", "baseurl" => "polozky/"));  //, "skryvat" => true
    //$text1 = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "adresa4", "subobsahradio" => "obsah-prvni", "baseurl" => "polozky/"));  //, "skryvat" => true
    //$text1 = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsah", array("adresa" => "adresa", "subobsahradio" => "obsah-prvni", "baseurl" => "polozky/", "pridavek" => array("kuk" => "wow pridana kukacka :D")), $adres);  //"strankovani" => array("<< 1, 2, 3 >>", "LIMIT 0,3"),
    //$text1 = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObal", array("adresa" => "adresa"));  //, "baseurl" => "polozky/"
    //$text1 = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralDrobeckovaNavigace", "adressaa", "polozky/");//šablony:adresa

    //$text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralSearchForm");
    //$text1 = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralSearch", array("loadstr" => array("adresa" => 4)));
$text = "";
    //$text = $this->var->main[0]->NactiFunkci("DynamicTable", "Table", "adresa");
    //$text = $this->var->main[0]->NactiFunkci("DynamicCaptcha", "CaptchaKod", "1");
    //$tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "RegistraceForm");

    $tx[] = $this->var->main[0]->NactiFunkci("DynamicMail", "MailZachytavaniOdhlaseni");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicMail", "MailNaStrankach");

    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "LoginForm");
    //$tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "AktivniUzivatel");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "ProfileForm");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoPublicProfile");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoProfile");

    $text = implode("<br /><br /><br />", $tx);

//var_dump($this->var->main[0]->NactiFunkci("DynamicCentral", "CentralPocetRadku", "adresa"));
//var_dump($this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsahPocetRadku", "adresa"));

//var_dump($this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigSingle", "adresa", "adr1"));
//var_dump($this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "adresa"));
//var_dump($this->var->main[0]->NactiFunkci("DynamicConfig", "ConfigSingle", "adresa", "adr1"));
//var_dump($this->var->main[0]->NactiFunkci("DynamicConfig", "ConfigGroup", "adresa"));
//var_dump($this->var->current_theme_dir);
//var_dump($this->AbsolutniUrl());

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
//var_dump($this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "adresa", false));
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "DetekceMicrosoftu"));
//var_dump($this->var->main[0]->NactiFunkci("Funkce", "NactiUrl", "www.gfdesign.cz", array("cache" => true, "expire" => "-2 hours")));
//var_dump($_COOKIE["STORAGEVIEW"], $_SESSION["NEWSTORAGEVIEW"]);

  //var_dump($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu"));
//var_dump($this->var->adminuser["name"], $this->var->adminuser["debug"]);
//var_dump($this->var->debug_mod);
//<meta http-equiv=\"cache-control\" content=\"no-cache\" />
//<meta http-equiv=\"cache-control\" content=\"no-cache\" />
//var_dump($this->var->meta);

/*
    $linux = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu") ?
              ($this->var->aktivniadmin ?
              "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/admin/styles_linux_admin.css\" media=\"screen\" />\n    " : //admin
              "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_linux.css\" media=\"screen\" />\n    ")  //normal
              : "");

    $opera = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceOpery") ?
              "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_opera.css\" media=\"screen\" />\n    " :
              "");
*/
  //$metainformace = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "meta-informace");

  //$a = ($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu") ? "je to super linux" : "je to cokoli fuj jine...");

//$firephp = FirePHP::getInstance(true);
/*
FB::log('Log message');
FB::info('Info message');
FB::warn('Warn message');
FB::error('Error message');
*/
//var_dump($this->GetSessionUser());
//var_dump($this->DetekceIExplorer(9));



  $result = array(

                  "index_main" => "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"%%meta_author%%\" />
    <meta name=\"copyright\" content=\"%%meta_copyright%%\" />
    <meta name=\"keywords\" content=\"%%meta_keywords%%\" />
    <meta name=\"description\" content=\"%%nazev_webu%%{$title}\" />
    <meta name=\"robots\" content=\"index, follow\" />
    <!--  -->
      <link rel=\"stylesheet\" type=\"text/css\" href=\"%%absolutni_url%%styles/global_styles.css\" media=\"screen\" title=\"%%nazev_webu%%\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"%%absolutni_url%%styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"%%absolutni_url%%styles/styles_ie7.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"%%absolutni_url%%styles/styles_ie6.css\" media=\"screen\" />
    <![endif]-->
    <title>%%nazev_webu%%{$title}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->
    <script type=\"text/javascript\" src=\"%%absolutni_url%%%%jquerycore_web%%\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%%%jqueryui_web%%\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/log_ad.js\"></script>
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('.central_tip_error, .central_tip_success, .central_tip_info, .central_tip_warning').draggable();
      });
    </script>
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <h1 title=\"%%nazev_webu%%{$title}\"><a href=\"%%absolutni_url%%\" title=\"%%nazev_webu%%\"><span>%%nazev_webu%%{$title}</span></a></h1>
      </div>
      <div id=\"obal_sekce\">
<!--
        <ul id=\"navigace\">
{$navigace}        </ul>
-->
        <div class=\"obsah\">
          <h2 title=\"%%nazev_webu%%{$title}\">%%nazev_webu%%{$title}</h2>
{$obsah}
<br />
<br />

{$text}

%%chyba%%
        </div>
      </div>
      <div id=\"zapati\">
        <p>
          %%info_web%%%%info_blok%%
          Design by <a href=\"http://www.martiondesign.net/\" title=\"Martion Design - webové portfolio Martina Šuláka\">Martion Design</a> | Created by <a href=\"http://www.gfdesign.cz/\" title=\"GoodFlow design - Tvorba webových stránek a systémů\">GoodFlow design</a>
        </p>
        <span id=\"vygenerovano\">Stránka vygenerována za: %%endtime%% s</span>
        <div id=\"obal_log_ad\">
          %%logadvolani%%
          <div id=\"log_ad\">
            %%backadmin%%
            <form method=\"post\" action=\"\">
              <fieldset>
                <label id=\"log_ad_user\">
                  <input type=\"text\" name=\"log_ad\" />
                </label>
                <label id=\"log_ad_pass\">
                  <input type=\"password\" name=\"log_he\" />
                </label>
                <input type=\"submit\" onclick=\"$(this).css('display', 'none');\" ondblclick=\"$(this).css('display', 'none');\"%%adminlogin%% name=\"tl_log\" id=\"log_ad_tl\" value=\"&nbsp;\" title=\"Vstoupit\" />
              </fieldset>
            </form>
          </div>
        </div>
        <script type=\"text/javascript\">
          $('#obal_log_ad').rb_menu({
            autoHide: false,
            effectDurationIn: 1000,
            effectDurationOut: 1000,
            triggerEvent: 'click',
            directionIn: 'left',
            directionOut: 'right',
            transitionIn: 'easeOutExpo',
            transitionOut: 'easeOutExpo'
          });
        </script>
      </div>
    </div>
    <!--
      *** GOOGLE ANALYTICS ***
    -->
  </body>
</html>",


                  );

  return $result;
?>
