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
  public function __construct()
  {
    if (file_exists($this->fileprom) && file_exists($this->filefunc))
    {
      include_once $this->fileprom; //vlozeni promennych
      include_once $this->filefunc; //vlozeni funkce

      $this->var = new Promenne();  //vytvoreni promennych
      $this->var->main[0] = new Funkce($this->var, 0);  //vytvoreni funkce
      $this->var->main[0]->StartCas();  //zacatek mereni generovani stranky
      $funkce_web = $this->var->main[0]->InicializaceModulu($info_web);  //hlavni incializace dalsich definovanych modulu

      $admintitle = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminTitle");
      $adminmenu = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminMenu");
      $adminobsah = $this->var->main[0]->NactiFunkci("Funkce", "GenerovaniAdminObsah");

      $struktura1 = $this->var->main[0]->NactiFunkci("StaticMenu", "NactiStrukturuMenu");
      $navigace = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu", $struktura1);
      $obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek", $struktura1);
      $title = $this->var->main[0]->NactiFunkci("StaticMenu", "Title", $struktura1);

      $struktura2 = $this->var->main[0]->NactiFunkci("StaticMenu", "NactiStrukturuMenu", 2);
      $navigace2 = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu", $struktura2);

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
//var_dump($_COOKIE["STORAGEVIEW"], $_SESSION["NEWSTORAGEVIEW"]);
//?debug=[debug, info, browscap, agent, access, php, ip, adr]
//var_dump($_GET);

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
      $absolute_url = $this->var->absolutni_url;
      $info_blok = $this->var->main[0]->NactiFunkci("Funkce", "BlokaceInfo", $funkce_web);
      $adminjmeno = $this->var->main[0]->NactiFunkci("Funkce", "GetUserName");
      $admin_styles = $this->var->main[0]->NactiFunkci("Funkce", "AdminNacitaniCssModulu");
      $cestatematu = $this->var->current_theme_dir;
      $logadvolani = ($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece") ? "<span id=\"odkaz_ad\">&raquo; Vstup do administrace</span>" : "<!-- -->");
      $logadvolanirc = ($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece") ? "<span id=\"odkaz_ad\"><!-- --></span>" : "<!-- -->");
      $linkadmin = $this->var->main[0]->BackLinkAdmin();
      $backadmin = ($this->var->main[0]->ZobrazitLinkAdmin() ? "<a href=\"{$absolute_url}?{$linkadmin}\" title=\"Vstup bez přihlašování\" id=\"ad_prejit_odkaz\"><!-- --></a>" : "<!-- -->");
      $timeupdate = $this->var->main[0]->NactiFunkci("Funkce", "CasAktualizace");
      $endtime = $this->var->main[0]->NactiFunkci("Funkce", "KonecCas");
      $this->var->main[0]->VypisVsechnyChyby();
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
    <meta name=\"author\" content=\"{$metainformace->meta_author}\" />
    <meta name=\"copyright\" content=\"{$metainformace->meta_copyright}\" />
    <meta name=\"keywords\" content=\"{$metainformace->meta_keywords}\" />
    <meta name=\"description\" content=\"{$this->var->nazevwebu}{$title}\" />
    <meta name=\"robots\" content=\"index, follow\" />
    <!--  -->
    {$this->var->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/global_styles.css\" media=\"screen\" title=\"{$this->var->nazevwebu}\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie7.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/styles_ie6.css\" media=\"screen\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/highslide/highslide-ie6.css\" media=\"screen\" />
    <![endif]-->
    <title>{$this->var->nazevwebu}{$title}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->
    <script type=\"text/javascript\" src=\"{$absolute_url}{$this->var->jquerycore_web}\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}{$this->var->jqueryui_web}\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/log_ad.js\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/jquery.coda-slider-2.0.js\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/jquery.scrollTo-min.js\"></script>
    ".($fuckie ? "<script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/jquery.blend.min.2.1.js\"></script>" : "<script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/jquery.blend.min.js\"></script>")."
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
        <h1 title=\"{$this->var->nazevwebu}{$title}\"><a href=\"{$absolute_url}\" title=\"{$this->var->nazevwebu}\"><span>{$this->var->nazevwebu}{$title}</span></a></h1>
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


        <a href=\"{$absolute_url}registrace\" title=\"Registrace\" id=\"zahlavi_registrace\" class=\"superadmin_{$superadminnastaveni->superadmin_registrace_blok}_blok\"><!-- --></a>


        <p id=\"zahlavi_profil\" class=\"superadmin_{$superadminnastaveni->superadmin_profil_blok}_blok\">
          <span>Jsi přihlášen jako <strong>Martin Šulák</strong></span>
          <a href=\"{$absolute_url}profil\" title=\"Profil\" class=\"superadmin_{$superadminnastaveni->superadmin_profil_blok}_blok\"><!-- --></a>
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
{$obsah}{$this->var->chyba}
        </div>
      </div>
      <div id=\"obal_zapati\">
        <div id=\"zapati\">
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
          <span id=\"vygenerovano\">Stránka vygenerována za: {$endtime} s</span>
          <div id=\"obal_log_ad\">
            {$logadvolani}
            <div id=\"log_ad\">
              {$backadmin}
              <form method=\"post\" action=\"\">
                <fieldset>
                  <label id=\"log_ad_user\">
                    <input type=\"text\" name=\"log_ad\" />
                  </label>
                  <label id=\"log_ad_pass\">
                    <input type=\"password\" name=\"log_he\" />
                  </label>
                  <input type=\"submit\" onclick=\"$(this).css('display', 'none');\" ondblclick=\"$(this).css('display', 'none');\"{$this->var->adminlogin} name=\"tl_log\" id=\"log_ad_tl\" value=\"&nbsp;\" title=\"Vstoupit\" />
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
</html>";

    if (!Empty($_GET[$this->var->get_kam]) &&
        $_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      $result =
      "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"{$metainformace->meta_author}\" />
    <meta name=\"copyright\" content=\"{$metainformace->meta_copyright}\" />
    <meta name=\"description\" content=\"{$this->var->nazevwebu} - {$admintitle}\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->var->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/admin/global_styles_admin.css\" media=\"screen\" />
      {$admin_styles}
    <title>{$this->var->nazevwebu} - GoodFlow Admin - {$admintitle}</title>
    <link rel=\"shortcut icon\" href=\"{$absolute_url}obr{$cestatematu}/favicon.ico\" />
    <script type=\"text/javascript\" src=\"{$absolute_url}{$this->var->jquerycore}\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}{$this->var->jqueryui}\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/admin/jquery.ui.datepicker-cs.js\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/admin/anytimec.js\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/admin/jquery.blend.min.js\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/admin/jquery.easy-confirm-dialog.js\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/admin/jquery.checkbox.min.js\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}{$this->var->main[0]->generated[0]}\"></script>
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('#obal_zahlavi h2 #blok_nazev_webu, #obal_zahlavi h2 #blok_prihlasen_jako').blend({speed: 300});
        $('#logout_prejit_na_web #odkaz_odhlasit_se, #logout_prejit_na_web #odkaz_prejit_na_web').blend({speed: 300});
        $('#vyber_tematu #aktualni_tema').blend({speed: 300});
        $('#navigace_zahlavi #odkaz_created_by span').blend({speed: 300});
        $('#navigace_zahlavi #vyber_tematu').accordion({
          header: '#aktualni_tema',
          clearStyle: true,
          collapsible: true,
          active: -1,
        });
        $('.confirm').easyconfirm();
        $('#obsah .formular .f-checkbox input').checkbox({cls:'jquery-theme-checkbox'});
        $('#obsah .formular .f-radiobutton input').checkbox({cls:'jquery-theme-radiobutton'});
        $('.central_tip_error, .central_tip_success, .central_tip_info, .central_tip_warning').draggable();
        $('#obsah .formular .f-datepicker input').datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'dd.mm.yy',
          yearRange: 'c-3:c+10',
          showAnim: 'drop'
        });
      });
    </script>
  </head>
  <body>
    <div id=\"body_zaklad\"><!-- --></div>
    <div id=\"zahlavi\">
      <div id=\"obal_zahlavi\">
        <h1>
          <a href=\"{$absolute_url}?action=\$ad&amp;modul=funkce\" title=\"{$this->var->nazevwebu}\"><!-- GoodFlow Admin - {$admintitle} --></a>
          <span><!-- GoodFlow Admin - {$admintitle} --></span>
        </h1>
        <h2>
          <span id=\"blok_prihlasen_jako\">
            <span id=\"nadpis_prihlasen_jako\">Přihlášen jako</span>
            <span id=\"prihlasen_jako\">{$adminjmeno}</span>
          </span>
          <span id=\"blok_nazev_webu\">
            <span id=\"nadpis_nazev_webu\">Vítejte v administraci webu</span>
            <span id=\"nazev_webu\">{$this->var->nazevwebu}</span>
          </span>
        </h2>
      </div>
    </div>
    <div id=\"obal_layout\">
      <div id=\"navigace\">
        {$adminmenu}        <span id=\"made_by_gfdesign\"><!-- GoodFlow Admin --></span>
      </div>
      <div id=\"obsah\">
{$adminobsah}
{$this->var->chyba}
        <div id=\"zapati\">
          <span id=\"body_zapati\"><!-- --></span>
          <p>Stránka vygenerována za: <strong>{$endtime} s</strong></p>
          {$timeupdate}
        </div>
      </div>
    </div>
  </body>
</html>";
    }

    if ($funkce_web)
    {
      $result =
    "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"{$metainformace->meta_author}\" />
    <meta name=\"copyright\" content=\"{$metainformace->meta_copyright}\" />
    <meta name=\"description\" content=\"{$this->var->nazevwebu} - {$info_web}\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->var->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/nc/global_styles_nc.css\" media=\"screen\" />
    <title>{$this->var->nazevwebu} - {$info_web}</title>
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"obal_sekce\">{$this->var->chyba}<!-- --></div>
      <div id=\"zapati\">
        <p>
          <strong>{$info_blok}</strong>
        </p>
        <p>
          <strong>{$info_web}</strong>
        </p>
        <span id=\"vygenerovano\">Stránka vygenerována za: {$endtime} s</span>
      </div>
    </div>
  </body>
</html>";
    }
//$_GET[$this->var->get_kam] != $this->var->adresaadminu &&
    if (!Empty($_GET[$this->var->get_kam]) &&
        ($_GET[$this->var->get_kam] == $this->var->adresaadminu && $this->var->aktivniadmin ? false : true) &&
        $this->var->waitindex)
    {
      $result =
    "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"{$metainformace->meta_author}\" />
    <meta name=\"copyright\" content=\"{$metainformace->meta_copyright}\" />
    <meta name=\"description\" content=\"{$this->var->nazevwebu} - Stránky jsou v rekonstrukci\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->var->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"{$absolute_url}styles/rc/global_styles_rc.css\" media=\"screen\" />
    <title>{$this->var->nazevwebu} - Stránky jsou v rekonstrukci</title>
    <script type=\"text/javascript\" src=\"{$absolute_url}{$this->var->jquerycore}\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}{$this->var->jqueryui}\"></script>
    <script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/log_ad.js\"></script>
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"obal_sekce\">
        <div id=\"obal_log_ad\">
          {$logadvolanirc}
          <div id=\"log_ad\">
            {$backadmin}
            <form method=\"post\" action=\"\">
              <fieldset>
                <label id=\"log_ad_user\">
                  <input type=\"text\" name=\"log_ad\" />
                </label>
                <label id=\"log_ad_pass\">
                  <input type=\"password\" name=\"log_he\" />
                </label>
                <input type=\"submit\" onclick=\"$(this).css('display', 'none');\" ondblclick=\"$(this).css('display', 'none');\"{$this->var->adminlogin} name=\"tl_log\" id=\"log_ad_tl\" value=\"&nbsp;\" title=\"Vstoupit\" />
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
        </script>{$this->var->chyba}
      </div>
    </div>
  </body>
</html>";
    }

    $this->var->main[0]->LastError();
    echo $result;
  }
}

new Layout();

?>