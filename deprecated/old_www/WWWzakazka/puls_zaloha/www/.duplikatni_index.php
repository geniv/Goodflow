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

  $idsekce = $this->var->main[0]->NactiFunkci("StaticMenu", "NavratPolozkyMenu", $struktura1, "id");


  $logadvolani = ($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece") ? "<span id=\"odkaz_ad\"><!-- --></span>" : "<!-- -->");

$centralniobsah = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "centralni-obsah");

$oteviracidoba = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "oteviraci-doba");


$zapatisprit = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "zapati-sprit", "tvar" => "zapati-sprit"));

/*
$fuckie = $this->var->main[0]->NactiFunkci("Funkce", "DetekceIExplorer");
*/

/*





<a href=\"#\" title=\"\" class=\"zrusit_oddelovac\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">prvni</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_2.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">druhy</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">treti</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_2.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">ctvrty</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">paty</span>

</a>




</div>


<div>


<a href=\"#\" title=\"\" class=\"zrusit_oddelovac\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_2.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">prvni</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">druhy</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">treti</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">ctvrty</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_2.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">paty</span>

</a>

</div>

<div>


<a href=\"#\" title=\"\" class=\"zrusit_oddelovac\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">prvni</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_2.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">druhy</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_2.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">treti</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_2.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">ctvrty</span>

</a>

<a href=\"#\" title=\"\">

<span class=\"sprit\" style=\"background-image: url(%%absolutni_url%%partner_vzor_1.png);\"><!-- --></span>
<span class=\"oddelovac\"><!-- --></span>
<span class=\"alternativa\">paty</span>

</a>


</div>






*/







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
    <meta name=\"google-site-verification\" content=\"7MjjL5LFK_PDzatY9QHxUrNmlKJh8Ws_UyqFDYGfXBQ\" />
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
    <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
    <script type=\"text/javascript\" src=\"%%absolutni_url%%%%jquerycore_web%%\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%%%jqueryui_web%%\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/log_ad.js\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/jquery.scrollTo-min.js\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/jquery.blend.min.js\"></script>
    <script type=\"text/javascript\" src=\"%%absolutni_url%%script/jquery/jquery.cycle.all.min.js\"></script>
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('.central_tip_error, .central_tip_success, .central_tip_info, .central_tip_warning').draggable();
        $('#ikony_zahlavi #skype_ikona').hover(function(){
          $('#skype_ikona #skype_box').stop(true, true).show(\"fade\", 400);
        },function(){
          $('#skype_ikona #skype_box').stop(true, true).hide(\"fade\", 400);
        });
        $('#ikony_zahlavi #oteviraci_doba_ikona').hover(function(){
          $('#oteviraci_doba_ikona #oteviraci_doba_box').stop(true, true).show(\"fade\", 400);
        },function(){
          $('#oteviraci_doba_ikona #oteviraci_doba_box').stop(true, true).hide(\"fade\", 400);
        });
        $('#ikony_zahlavi #telefon_ikona').hover(function(){
          $('#telefon_ikona #telefon_box').stop(true, true).show(\"fade\", 400);
        },function(){
          $('#telefon_ikona #telefon_box').stop(true, true).hide(\"fade\", 400);
        });
        $('#ikony_zahlavi #fcb_ikona').hover(function(){
          $('#fcb_ikona #fcb_box').stop(true, true).show(\"fade\", 400);
        },function(){
          $('#fcb_ikona #fcb_box').stop(true, true).hide(\"fade\", 400);
        });
        $('#partneri_obsah').cycle({
          fx: 'scrollHorz',
          timeout: 0,
          next: '#partneri_sipka_vpravo',
          prev: '#partneri_sipka_vlevo',
        });
      });
    </script>
  </head>
  <body id=\"body_{$idsekce}\">
    <div id=\"obal_layout\">
      <span id=\"body_top\"><!-- --></span>
      <div id=\"zahlavi\">
        <span id=\"body_podklad\"><!-- --></span>
        <h1 title=\"%%nazev_webu%%{$title}\"><a href=\"%%absolutni_url%%\" title=\"%%nazev_webu%%\"><span>%%nazev_webu%%{$title}</span></a></h1>
        <ul id=\"navigace\">
{$navigace}        </ul>
        <div id=\"ikony_zahlavi\">
          <div id=\"skype_ikona\">
            <div id=\"skype_box\">
              <p>{$centralniobsah->studio_puls_skype}</p>
            </div>
          </div>
          <div id=\"oteviraci_doba_ikona\">
            <div id=\"oteviraci_doba_box\">
              <ul id=\"oteviraci_doba_dny\">
                <li>Pondělí</li>
                <li>Úterý</li>
                <li>Středa</li>
                <li>Čtvrtek</li>
                <li>Pátek</li>
                <li>Sobota</li>
                <li>Neděle</li>
              </ul>
              <ul id=\"oteviraci_doba_studiopuls\">
                <li>{$oteviracidoba->studio_puls_pondeli}</li>
                <li>{$oteviracidoba->studio_puls_utery}</li>
                <li>{$oteviracidoba->studio_puls_streda}</li>
                <li>{$oteviracidoba->studio_puls_ctvrtek}</li>
                <li>{$oteviracidoba->studio_puls_patek}</li>
                <li>{$oteviracidoba->studio_puls_sobota}</li>
                <li>{$oteviracidoba->studio_puls_nedele}</li>
              </ul>
            </div>
          </div>
          <div id=\"telefon_ikona\">
            <div id=\"telefon_box\">
              <p>+420 {$centralniobsah->studio_puls_tel}</p>
            </div>
          </div>
          <div id=\"fcb_ikona\">
            <a href=\"http://www.facebook.com/pages/Kadernicke-studio-Puls-v-Breclavi/96226669958\" title=\"Kadeřnické studio Puls v Břeclavi\" id=\"fcb_direct_link\"><!-- --></a>
            <div id=\"fcb_box\">
              <p><a href=\"http://www.facebook.com/pages/Kadernicke-studio-Puls-v-Breclavi/96226669958\" title=\"Kadeřnické studio Puls v Břeclavi\">Kadeřnické studio Puls v Břeclavi</a></p>
            </div>
          </div>
        </div>
      </div>
      <div id=\"obal_sekce\">
        <div class=\"obsah\">
{$obsah}
%%chyba%%
        </div>
      </div>
      <div id=\"zapati\">
        <div id=\"zapati_lista\">
          <ul>
{$navigace2}          </ul>
          <a href=\"#\" title=\"NAHORU\" id=\"zapati_nahoru\" onclick=\"$.scrollTo('#obal_layout', 2000, {easing: 'easeOutExpo'}); return false;\"><span><!-- --></span></a>
        </div>


<div id=\"zapati_partneri\">

<div id=\"partneri_obal\">



<a href=\"#\" title=\"\" id=\"partneri_sipka_vlevo\"><!-- --></a>

<div id=\"partneri_obsah\">

<div>
{$zapatisprit}












</div>


<a href=\"#\" title=\"\" id=\"partneri_sipka_vpravo\"><!-- --></a>




</div>

</div>




        %%info_web%%%%info_blok%%<span id=\"vygenerovano\">Stránka vygenerována za: %%endtime%% s</span>
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



<script type=\"text/javascript\">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21652350-1']);
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
