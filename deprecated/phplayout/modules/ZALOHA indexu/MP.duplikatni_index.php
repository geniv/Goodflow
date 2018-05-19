<?php
  //prenos ukazatele z funkce
  $this->var = $this->prenos;
  //normalni zapis dalsich funkci


  $struktura1 = $this->var->main[0]->NactiFunkci("StaticMenu", "NactiStrukturuMenu");
  $navigace = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu", $struktura1);
  $obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek", $struktura1);
  $title = $this->var->main[0]->NactiFunkci("StaticMenu", "Title", $struktura1);

  $struktura2 = $this->var->main[0]->NactiFunkci("StaticMenu", "NactiStrukturuMenu", 2);
  $navigace2 = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu", $struktura2);




  $superadminnastaveni = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "superadmin-nastaveni", true);
  $metainformace = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "meta-informace");
  $hlavninastaveni = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "hlavni-nastaveni");
  $sekcedomu = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-domu");
  $sekceonas = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-o-nas");
  $sekcekestazeni = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-ke-stazeni");
  $sekceamp = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-amp");
  $sekcetiskovyservis = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-tiskovy-servis");
  $sekcepromedia = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-pro-media");
  $sekcepozvanky = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-pozvanky");
  $sekceprojekty = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-projekty");
  $sekcetipy = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-tipy");
  $sekceregistrace = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-registrace");

  $zapatipartneri = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "zapati-partneri", "tvar" => "zapati-partneri"));

  $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralDownload", "ke-stazeni-menu");
  $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralDownload", "obcasnik");
  $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralDownload", "pro-media");


$zahlavihledej = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralSearchForm", array("tvar" => "zahlavi-hledej"));


  $fuckie = $this->var->main[0]->NactiFunkci("Funkce", "DetekceIExplorer");

  $logadvolani = ($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece") ? "<span id=\"odkaz_ad\">&raquo; Vstup do administrace</span>" : "<!-- -->");


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
//$text = "";
    //$tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "RegistraceForm");
/*
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "LoginForm");
    //$tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "AktivniUzivatel");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "ProfileForm");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoPublicProfile");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoProfile");

    $text = implode("<br /><br /><br />", $tx);
*/

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
      <link rel=\"stylesheet\" type=\"text/css\" href=\"%%absolutni_url%%styles/highslide/highslide-ie6.css\" media=\"screen\" />
    <![endif]-->
    <title>%%nazev_webu%%{$title}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->
    <script type=\"text/javascript\" src=\"%%absolutni_url%%%%jquerycore_web%%\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%%%jqueryui_web%%\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/log_ad.js\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/jquery.coda-slider-2.0.js\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/jquery.scrollTo-min.js\"></script>
    ".($fuckie ? "<script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/jquery.blend.min.2.1.js\"></script>" : "<script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/jquery.blend.min.js\"></script>")."
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('.central_tip_error, .central_tip_success, .central_tip_info, .central_tip_warning').draggable();
      ".($fuckie ? "" : "
        $('#zahlavi #navigace li a').blend({speed: {$hlavninastaveni->blend_zahlavi_menu}});
        $('#zahlavi #zahlavi_registrace').blend({speed: {$hlavninastaveni->blend_zahlavi_registrace}});
        $('#zahlavi #zahlavi_profil a').blend({speed: {$hlavninastaveni->blend_zahlavi_registrace}});
        $('#obal_kdo_jsme a .foto_sprit').blend({speed: {$sekceonas->blend_kdo_jsme}});
        $('#vybrano_z_webu_oddil p a span').blend({speed: {$sekcedomu->blend_vybrano_z_webu}});
        $('#ke_stazeni_obal_menu_sekce #ke_stazeni_obal_menu h3 a').blend({speed: {$sekcekestazeni->blend_ke_stazeni_menu}});
        $('#obal_sekce_amp #amp_blok_slider #amp_registrovat').blend({speed: {$sekceamp->blend_amp_registrovat}});
        $('#partneri_projektu .coda-slider-partneri .panel-wrapper p a').blend({speed: {$hlavninastaveni->blend_zapati_partneri}});
      ")."
        $('#socialni_site_oddil #socialni_prvni_oddil a, #socialni_site_oddil #socialni_druhy_oddil a').blend({speed: {$sekcedomu->blend_socialni_sracky}});
        $('#obal_news_nav2 #navigace2 a, #obal_log_ad #odkaz_ad').css({'color': '#ffffff'});
        $('#obal_news_nav2 #navigace2 a, #obal_log_ad #odkaz_ad').hover(
          function(){
            $(this).stop().animate({'color': '#eb6840'}, {duration: {$hlavninastaveni->hover_zapati_menu}, easing: '{$hlavninastaveni->easing_menu_zapati}'})
          },
          function(){
            $(this).stop().animate({'color': '#ffffff'}, {duration: {$hlavninastaveni->hover_zapati_menu}, easing: '{$hlavninastaveni->easing_menu_zapati}'})
          }
        );
        $('#zahlavi #zahlavi_hledej').css({'width': '20px'});
        $('#zahlavi #zahlavi_hledej').click(
          function(){
            $('#zahlavi #zahlavi_hledej').stop().animate({'width': '214px'}, {duration: {$hlavninastaveni->animate_zahlavi_hledej}, easing: '{$hlavninastaveni->easing_hledej_zahlavi}'});
            $('#zahlavi #zahlavi_hledej').css({'border-right': '0'});
          }
        );
        $('#zahlavi #zahlavi_twitter #text_twitter').css({'width': '382px'});
        $('#zahlavi #zahlavi_twitter #ptak_twitter').hover(
          function(){
            $('#zahlavi #zahlavi_twitter #text_twitter').stop().animate({'width': '0px'}, {duration: {$hlavninastaveni->hover_twitter_zahlavi}, easing: '{$hlavninastaveni->easing_twitter_zahlavi}'})
          },
          function(){
            $('#zahlavi #zahlavi_twitter #text_twitter').stop().animate({'width': '382px'}, {duration: {$hlavninastaveni->hover_twitter_zahlavi}, easing: '{$hlavninastaveni->easing_twitter_zahlavi}'})
          }
        );
        $('#zahlavi #zahlavi_twitter #text_twitter_hover').css({'width': '0px'});
        $('#zahlavi #zahlavi_twitter #ptak_twitter').hover(
          function(){
            $('#zahlavi #zahlavi_twitter #text_twitter_hover').stop().animate({'width': '382px'}, {duration: {$hlavninastaveni->hover_twitter_zahlavi}, easing: '{$hlavninastaveni->easing_twitter_zahlavi}'})
          },
          function(){
            $('#zahlavi #zahlavi_twitter #text_twitter_hover').stop().animate({'width': '0px'}, {duration: {$hlavninastaveni->hover_twitter_zahlavi}, easing: '{$hlavninastaveni->easing_twitter_zahlavi}'})
          }
        );
        $('#centralni_strankovani p a').css({'color': '#9badb9'});
        $('#centralni_strankovani p a').hover(
          function(){
            $(this).stop().animate({'color': '#3e6a7e'}, {duration: {$hlavninastaveni->hover_strankovani}, easing: '{$hlavninastaveni->easing_strankovani}'})
          },
          function(){
            $(this).stop().animate({'color': '#9badb9'}, {duration: {$hlavninastaveni->hover_strankovani}, easing: '{$hlavninastaveni->easing_strankovani}'})
          }
        );
        $('#obal_sekce_registrace form label#form_submit input').css({'color': '#fff', 'background-color': '#eb6840'});
        $('#obal_sekce_registrace form label#form_submit input').hover(
          function(){
            $(this).stop().animate({'color': '#1d2a33', 'background-color': '#6dd1ff'}, {duration: {$sekceregistrace->hover_registrace_tlacitko}, easing: '{$sekceregistrace->easing_registrace_tlacitko}'})
          },
          function(){
            $(this).stop().animate({'color': '#fff', 'background-color': '#eb6840'}, {duration: {$sekceregistrace->hover_registrace_tlacitko}, easing: '{$sekceregistrace->easing_registrace_tlacitko}'})
          }
        );
        $('#obal_sekce_registrace form label#form_submit input').focus(function() {
          $(this).css('cssText', 'color: #1d2a33 !important; background-color: #6dd1ff !important;');
        });
        $('#obal_sekce_registrace form label#form_submit input').blur(function() {
          $(this).css('cssText', 'color: #fff;');
        });
        $('#obal_sekce_upravit_profil form label#form_submit input').css({'color': '#fff', 'background-color': '#eb6840'});
        $('#obal_sekce_upravit_profil form label#form_submit input').hover(
          function(){
            $(this).stop().animate({'color': '#1d2a33', 'background-color': '#6dd1ff'}, {duration: {$sekceregistrace->hover_registrace_tlacitko}, easing: '{$sekceregistrace->easing_registrace_tlacitko}'})
          },
          function(){
            $(this).stop().animate({'color': '#fff', 'background-color': '#eb6840'}, {duration: {$sekceregistrace->hover_registrace_tlacitko}, easing: '{$sekceregistrace->easing_registrace_tlacitko}'})
          }
        );
        $('#obal_sekce_upravit_profil form label#form_submit input').focus(function() {
          $(this).css('cssText', 'color: #1d2a33 !important; background-color: #6dd1ff !important;');
        });
        $('#obal_sekce_upravit_profil form label#form_submit input').blur(function() {
          $(this).css('cssText', 'color: #fff;');
        });
        $('#obal_sekce_profil #obal_uzivatel_obsah #upravit_profil').css({'color': '#fff', 'background-color': '#a8bcca'});
        $('#obal_sekce_profil #obal_uzivatel_obsah #upravit_profil').hover(
          function(){
            $(this).stop().animate({'color': '#fff', 'background-color': '#eb6840'}, {duration: {$sekceregistrace->hover_registrace_tlacitko}, easing: '{$sekceregistrace->easing_registrace_tlacitko}'})
          },
          function(){
            $(this).stop().animate({'color': '#fff', 'background-color': '#a8bcca'}, {duration: {$sekceregistrace->hover_registrace_tlacitko}, easing: '{$sekceregistrace->easing_registrace_tlacitko}'})
          }
        );
        $('#domu_obsah_oddil #obsah_oddil a').css({'color': '#fefefe', 'background-color': '#eb6840'});
        $('#domu_obsah_oddil #obsah_oddil a').hover(
          function(){
            $(this).stop().animate({'color': '#1d2a33', 'background-color': '#6dd1ff'}, {duration: {$sekcedomu->hover_prejit_do_sekce_o_nas}, easing: '{$sekcedomu->easing_prejit_do_sekce_o_nas}'})
          },
          function(){
            $(this).stop().animate({'color': '#fefefe', 'background-color': '#eb6840'}, {duration: {$sekcedomu->hover_prejit_do_sekce_o_nas}, easing: '{$sekcedomu->easing_prejit_do_sekce_o_nas}'})
          }
        );
        $('#ke_stazeni_obal_menu_sekce #ke_stazeni_obal_menu h3 a').css({'color': '#9aa0a5'});
        $('#ke_stazeni_obal_menu_sekce #ke_stazeni_obal_menu h3 a').hover(
          function(){
            $(this).stop().animate({'color': '#854a38'}, {duration: {$sekcekestazeni->ke_stazeni_duration_menu}, easing: '{$sekcekestazeni->ke_stazeni_easing_menu}'})
          },
          function(){
            $(this).stop().animate({'color': '#9aa0a5'}, {duration: {$sekcekestazeni->ke_stazeni_duration_menu}, easing: '{$sekcekestazeni->ke_stazeni_easing_menu}'})
          }
        );
        $('#ke_stazeni_obal_menu_sekce #ke_stazeni_obal_sekce .ke_stazeni_download a').css({'color': '#fff'});
        $('#ke_stazeni_obal_menu_sekce #ke_stazeni_obal_sekce .ke_stazeni_download a').hover(
          function(){
            $(this).stop().animate({'color': '#854a38'}, {duration: {$sekcekestazeni->ke_stazeni_duration_stahnout}, easing: '{$sekcekestazeni->ke_stazeni_easing_stahnout}'})
          },
          function(){
            $(this).stop().animate({'color': '#fff'}, {duration: {$sekcekestazeni->ke_stazeni_duration_stahnout}, easing: '{$sekcekestazeni->ke_stazeni_easing_stahnout}'})
          }
        );
        $('#obal_sekce_tiskovy_servis #tiskovy_servis_obal_menu h3 a').css({'color': '#d3e3ec'});
        $('#obal_sekce_tiskovy_servis #tiskovy_servis_obal_menu h3 a').hover(
          function(){
            $(this).stop().animate({'color': '#a5c2cf'}, {duration: {$sekcetiskovyservis->duration_tiskovy_servis_menu}, easing: '{$sekcetiskovyservis->easing_tiskovy_servis_menu}'})
          },
          function(){
            $(this).stop().animate({'color': '#d3e3ec'}, {duration: {$sekcetiskovyservis->duration_tiskovy_servis_menu}, easing: '{$sekcetiskovyservis->easing_tiskovy_servis_menu}'})
          }
        );
        $('#tiskovy_servis_obal_sekce .tiskovy_servis_clanek .cely_clanek_odkaz a').css({'color': '#fefefe', 'background-color': '#eb6840'});
        $('#tiskovy_servis_obal_sekce .tiskovy_servis_clanek .cely_clanek_odkaz a').hover(
          function(){
            $(this).stop().animate({'color': '#1d2a33', 'background-color': '#6dd1ff'}, {duration: {$sekcetiskovyservis->duration_tiskovy_servis_clanek}, easing: '{$sekcetiskovyservis->easing_tiskovy_servis_clanek}'})
          },
          function(){
            $(this).stop().animate({'color': '#fefefe', 'background-color': '#eb6840'}, {duration: {$sekcetiskovyservis->duration_tiskovy_servis_clanek}, easing: '{$sekcetiskovyservis->easing_tiskovy_servis_clanek}'})
          }
        );
        $('#obal_sekce_pro_media #pro_media_obal_menu a').css({'color': '#596f82'});
        $('#obal_sekce_pro_media #pro_media_obal_menu a').hover(
          function(){
            $(this).stop().animate({'color': '#eb6840'}, {duration: {$sekcepromedia->duration_pro_media_menu}, easing: '{$sekcepromedia->easing_pro_media_menu}'})
          },
          function(){
            $(this).stop().animate({'color': '#596f82'}, {duration: {$sekcepromedia->duration_pro_media_menu}, easing: '{$sekcepromedia->easing_pro_media_menu}'})
          }
        );
        $('#obal_sekce_pozvanky #pozvanky_obal_menu h4 a').css({'color': '#9aa0a5'});
        $('#obal_sekce_pozvanky #pozvanky_obal_menu h4 a').hover(
          function(){
            $(this).stop().animate({'color': '#854a38'}, {duration: {$sekcepozvanky->duration_pozvanky_menu}, easing: '{$sekcepozvanky->easing_pozvanky_menu}'})
          },
          function(){
            $(this).stop().animate({'color': '#9aa0a5'}, {duration: {$sekcepozvanky->duration_pozvanky_menu}, easing: '{$sekcepozvanky->easing_pozvanky_menu}'})
          }
        );
        $('#pozvanky_obal_obsah .pozvanky_obsah_polozka .cely_clanek_odkaz a').css({'color': '#fefefe', 'background-color': '#eb6840'});
        $('#pozvanky_obal_obsah .pozvanky_obsah_polozka .cely_clanek_odkaz a').hover(
          function(){
            $(this).stop().animate({'color': '#1d2a33', 'background-color': '#6dd1ff'}, {duration: {$sekcepozvanky->duration_pozvanky_clanek}, easing: '{$sekcepozvanky->easing_pozvanky_clanek}'})
          },
          function(){
            $(this).stop().animate({'color': '#fefefe', 'background-color': '#eb6840'}, {duration: {$sekcepozvanky->duration_pozvanky_clanek}, easing: '{$sekcepozvanky->easing_pozvanky_clanek}'})
          }
        );
        $('#obal_sekce_projekty #projekty_obal_menu h4 a').css({'color': '#9aa0a5'});
        $('#obal_sekce_projekty #projekty_obal_menu h4 a').hover(
          function(){
            $(this).stop().animate({'color': '#854a38'}, {duration: {$sekceprojekty->duration_projekty_menu}, easing: '{$sekceprojekty->easing_projekty_menu}'})
          },
          function(){
            $(this).stop().animate({'color': '#9aa0a5'}, {duration: {$sekceprojekty->duration_projekty_menu}, easing: '{$sekceprojekty->easing_projekty_menu}'})
          }
        );
        $('#obal_sekce_projekty #projekty_obal_obsah .projekty_obsah_polozka .cely_popis_odkaz a').css({'color': '#fefefe', 'background-color': '#eb6840'});
        $('#obal_sekce_projekty #projekty_obal_obsah .projekty_obsah_polozka .cely_popis_odkaz a').hover(
          function(){
            $(this).stop().animate({'color': '#1d2a33', 'background-color': '#6dd1ff'}, {duration: {$sekceprojekty->duration_projekty_clanek}, easing: '{$sekceprojekty->easing_projekty_clanek}'})
          },
          function(){
            $(this).stop().animate({'color': '#fefefe', 'background-color': '#eb6840'}, {duration: {$sekceprojekty->duration_projekty_clanek}, easing: '{$sekceprojekty->easing_projekty_clanek}'})
          }
        );
        $('#obal_sekce_projekty #projekty_obal_obsah .projekty_historie_polozka p a').css({'color': '#596f82'});
        $('#obal_sekce_projekty #projekty_obal_obsah .projekty_historie_polozka p a').hover(
          function(){
            $(this).stop().animate({'color': '#eb6840'}, {duration: {$sekceprojekty->duration_projekty_clanek}, easing: '{$sekceprojekty->easing_projekty_clanek}'})
          },
          function(){
            $(this).stop().animate({'color': '#596f82'}, {duration: {$sekceprojekty->duration_projekty_clanek}, easing: '{$sekceprojekty->easing_projekty_clanek}'})
          }
        );
        $('#obal_sekce_tipy #tipy_obal_menu h4 a').css({'color': '#9aa0a5'});
        $('#obal_sekce_tipy #tipy_obal_menu h4 a').hover(
          function(){
            $(this).stop().animate({'color': '#854a38'}, {duration: {$sekcetipy->duration_tipy_menu}, easing: '{$sekcetipy->easing_tipy_menu}'})
          },
          function(){
            $(this).stop().animate({'color': '#9aa0a5'}, {duration: {$sekcetipy->duration_tipy_menu}, easing: '{$sekcetipy->easing_tipy_menu}'})
          }
        );
        $('#tipy_obal_obsah .tipy_obsah_polozka .cely_clanek_odkaz a').css({'color': '#fefefe', 'background-color': '#eb6840'});
        $('#tipy_obal_obsah .tipy_obsah_polozka .cely_clanek_odkaz a').hover(
          function(){
            $(this).stop().animate({'color': '#1d2a33', 'background-color': '#6dd1ff'}, {duration: {$sekcetipy->duration_tipy_clanek}, easing: '{$sekcetipy->easing_tipy_clanek}'})
          },
          function(){
            $(this).stop().animate({'color': '#fefefe', 'background-color': '#eb6840'}, {duration: {$sekcetipy->duration_tipy_clanek}, easing: '{$sekcetipy->easing_tipy_clanek}'})
          }
        );
        $('#zapati #zapati_sipka').css({'opacity': '0.4'});
        $('#zapati #zapati_sipka').hover(
          function(){
            $('#zapati #zapati_sipka').stop().fadeTo({$hlavninastaveni->blend_zahlavi_registrace}, 1);
          },
          function(){
            $('#zapati #zapati_sipka').stop().fadeTo({$hlavninastaveni->blend_zahlavi_registrace}, 0.4);
          }
        );
      });
      $().ready(function() {
        $('#partneri-projektu-slider').codaSlider({
          autoHeight: false,
          autoSlide: {$hlavninastaveni->partneri_autoslide},
          autoSlideInterval: {$hlavninastaveni->partneri_autoslideinterval}000,
          autoSlideStopWhenClicked: true,
          crossLinking: false,
          dynamicArrows: true,
          dynamicArrowLeftText: '',
          dynamicArrowRightText: '',
          dynamicTabs: false,
          firstPanelToLoad: {$hlavninastaveni->partneri_firstpaneltoload},
          slideEaseDuration: {$hlavninastaveni->partneri_slideeaseduration},
          slideEaseFunction: '{$hlavninastaveni->partneri_slideeasefunction}'
        });
      });
    </script>
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <span id=\"zahlavi_left\"><!-- --></span>
        <span id=\"zahlavi_right\"><!-- --></span>
        <h1 title=\"%%nazev_webu%%{$title}\"><a href=\"%%absolutni_url%%\" title=\"%%nazev_webu%%\"><span>%%nazev_webu%%{$title}</span></a></h1>
        <ul id=\"navigace\">
{$navigace}        </ul>
        <form method=\"post\" action=\"\" id=\"zahlavi_hledej\" class=\"superadmin_{$superadminnastaveni->superadmin_hledej_blok}_blok\">
          <fieldset>
{$zahlavihledej}
          </fieldset>
        </form>





        <form method=\"post\" action=\"\" id=\"zahlavi_prihlaseni\" class=\"superadmin_{$superadminnastaveni->superadmin_registrace_blok}_blok\">
          <fieldset>
            <label class=\"form_text_jmeno\">
              <input type=\"text\" name=\"\" value=\"\" />
            </label>
            <label class=\"form_text_heslo\">
              <input type=\"text\" name=\"\" value=\"\" />
            </label>
            <label class=\"form_submit\">
              <input type=\"submit\" name=\"\" value=\"&nbsp;\" />
            </label>
          </fieldset>
        </form>


        <a href=\"%%absolutni_url%%registrace\" title=\"Registrace\" id=\"zahlavi_registrace\" class=\"superadmin_{$superadminnastaveni->superadmin_registrace_blok}_blok\"><!-- --></a>


        <p id=\"zahlavi_profil\" class=\"superadmin_{$superadminnastaveni->superadmin_profil_blok}_blok\">
          <span>Jsi přihlášen jako <strong>Martin Šulák</strong></span>
          <a href=\"%%absolutni_url%%profil\" title=\"Profil\" class=\"superadmin_{$superadminnastaveni->superadmin_profil_blok}_blok\"><!-- --></a>
        </p>


        <div id=\"zahlavi_twitter\" class=\"superadmin_{$superadminnastaveni->superadmin_twitter_blok}_blok\">
          <div id=\"ptak_twitter\"><!-- --></div>
          <div id=\"text_twitter\"><!-- --></div>
          <div id=\"text_twitter_hover\">
            <p>
              <script type=\"text/javascript\" src=\"http://widgets.twimg.com/j/2/widget.js\"></script>
              <script type=\"text/javascript\">
              new TWTR.Widget({
                version: 2,
                type: 'profile',
                rpp: 1,
                interval: 2000,
                width: 'auto',
                theme: {
                  shell: {
                    background: 'transparent',
                    color: '#ffffff'
                  },
                  tweets: {
                    background: 'transparent',
                    color: '#ffffff',
                    links: '#4aed05'
                  }
                },
                features: {
                  scrollbar: false,
                  loop: false,
                  live: false,
                  hashtags: true,
                  timestamp: true,
                  avatars: false,
                  behavior: 'all'
                }
              }).render().setUser('Mpodnikatele').start();
              </script>
            </p>
          </div>
        </div>
      </div>
      <div id=\"obal_sekce\">
        <span id=\"body_left\"><!-- --></span>
        <span id=\"body_right\"><!-- --></span>
        <div class=\"obsah\">
{$obsah}%%chyba%%
        </div>
      </div>
      <div id=\"obal_zapati\">
        <div id=\"zapati\">
          %%info_web%%%%info_blok%%
          <span id=\"zapati_left\"><!-- --></span>
          <span id=\"zapati_right\"><!-- --></span>
          <a href=\"#\" title=\"NAHORU\" id=\"zapati_sipka\" onclick=\"$.scrollTo('#obal_layout', 2000, {easing: '{$hlavninastaveni->easing_hledej_zahlavi}'}); return false;\">NAHORU<span><!-- --></span></a>
          <div id=\"obal_news_nav2\">
            <div id=\"newsletter\" class=\"superadmin_{$superadminnastaveni->superadmin_newsletter_blok}_blok\">
              {$superadminnastaveni->superadmin_newsletter_text}
              <form method=\"post\" action=\"\">
                <fieldset>
                  <label id=\"form_email\">
                    <input type=\"text\" name=\"\" value=\"\" />
                  </label>
                  <label id=\"form_submit\">
                    <input type=\"submit\" name=\"\" value=\"&nbsp;\" />
                  </label>
                </fieldset>
              </form>
            </div>
            <div id=\"navigace2\" class=\"superadmin_{$superadminnastaveni->superadmin_navigace_zapati_blok}_blok\">
              {$superadminnastaveni->superadmin_navigace_zapati_text}
              <div id=\"levy_blok_navigace2\">
                {$navigace2}
              </div>
            </div>
          </div>
          <div id=\"partneri_projektu\" class=\"superadmin_{$superadminnastaveni->superadmin_partneri_projektu_blok}_blok\">
            {$superadminnastaveni->superadmin_partneri_projektu_text}
{$zapatipartneri}
          </div>
          <span id=\"vygenerovano\">Stránka vygenerována za: %%endtime%% s</span>
          <div id=\"obal_log_ad\">
            {$logadvolani}
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
    </div>
    <script type=\"text/javascript\">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-19949816-1']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </body>
</html>",





/*
                  "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
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
    %%meta_refresh%%
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
*/


                  );

  return $result;
?>
