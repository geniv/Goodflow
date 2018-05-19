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

      $metainformace = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "meta-informace");

//var_dump($this->var->adminuser["name"], $this->var->adminuser["debug"]);
//var_dump($this->var->debug_mod);
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

      $absolute_url = $this->var->absolutni_url;
      $info_blok = $this->var->main[0]->NactiFunkci("Funkce", "BlokaceInfo", $funkce_web);
      $adminjmeno = $this->var->main[0]->NactiFunkci("Funkce", "GetUserName");
      $admin_styles = $this->var->main[0]->NactiFunkci("Funkce", "AdminNacitaniCssModulu");
      $cestatematu = $this->var->current_theme_dir;
      $logadvolani = ($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece") ? "<span id=\"odkaz_ad\">--- admin ---<!-- --></span>" : "<!-- -->");
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
    <meta name=\"description\" content=\"{$this->var->nazevwebu}\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
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
    <![endif]-->
    <title>{$this->var->nazevwebu} GoodFlow design</title>
    <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"obal_sekce\">
        <form method=\"post\" action=\"\">
          <h1><a href=\"{$absolute_url}\" title=\"{$this->var->nazevwebu}\"><!-- {$this->var->nazevwebu} --></a></h1>
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
        {$this->var->chyba}
      </div>
    </div>
    <script type=\"text/javascript\">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-19154332-1']);
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
