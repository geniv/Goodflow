<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Úvodní strana",
                                              "title" => "Úvodní strana",),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Administrace modulů",
                                              "title" => "Administrace modulů",),

                                        array("main_href" => "%%1%%%%3%%",
                                              "odkaz" => "Aktualizace modulů",
                                              "title" => "Aktualizace modulů",),

                                        array("main_href" => "%%1%%%%4%%",
                                              "odkaz" => "Konfigurace administrace",
                                              "title" => "Konfigurace administrace",),

                                        array("main_href" => "%%1%%%%5%%",
                                              "odkaz" => "Ovládání administrace",
                                              "title" => "Ovládání administrace",),

                                        array("main_href" => "%%1%%%%6%%",
                                              "odkaz" => "Přístupová práva složek",
                                              "title" => "Přístupová práva složek",),

                                        array("main_href" => "%%1%%%%7%%",
                                              "odkaz" => "Oprávnění administrátorů",
                                              "title" => "Oprávnění administrátorů",),

                                        array("main_href" => "%%1%%%%8%%",
                                              "odkaz" => "Přehled administrátorů",
                                              "title" => "Přehled administrátorů",),

                                        array("main_href" => "%%1%%%%9%%",
                                              "odkaz" => "Přehled přístupů do administrace",
                                              "title" => "Přehled přístupů do administrace",),

                                        array("main_href" => "%%1%%%%10%%",
                                              "odkaz" => "Statistiky přístupů",
                                              "title" => "Statistiky přístupů",),

                                        array("main_href" => "%%1%%%%11%%",
                                              "odkaz" => "BAN do administrace a na stránky",
                                              "title" => "BAN do administrace a na stránky",),

                                        array("main_href" => "%%1%%%%12%%",
                                              "odkaz" => "Přehled aktivity administrátorů",
                                              "title" => "Přehled aktivity administrátorů",),

                                        array("main_href" => "%%1%%%%13%%",
                                              "odkaz" => "Výpis error logů",
                                              "title" => "Výpis error logů",),

                                        array("main_href" => "%%1%%%%14%%",
                                              "odkaz" => "Statistiky",
                                              "title" => "Statistiky",),

                                        array("main_href" => "%%1%%%%15%%",
                                              "odkaz" => "Statistiky za dnešní den",
                                              "title" => "Statistiky za dnešní den",),

                                        array("main_href" => "%%1%%%%16%%",
                                              "odkaz" => "Celkové statistiky",
                                              "title" => "Celkové statistiky",),

                                        array("main_href" => "%%1%%%%17%%",
                                              "odkaz" => "Help centrum",
                                              "title" => "Help centrum",),

                                        array("main_href" => "%%1%%%%18%%",
                                              "odkaz" => "Reporty (hlášení chyb)",
                                              "title" => "Reporty (hlášení chyb)",),

                                        array("main_href" => "%%1%%%%19%%",
                                              "odkaz" => "FAQ (Otázky a odpovědi)",
                                              "title" => "FAQ (Otázky a odpovědi)",),

                                        array("main_href" => "%%1%%%%20%%",
                                              "odkaz" => "Testy systemu",
                                              "title" => "Testy systemu",),

                                        ),

                  "control_preinstall" => array("moduly" => array(array("id" => 1,
                                                                        "include" => "funkce.php",
                                                                        "class" => "Funkce",
                                                                        "admin" => 1,
                                                                        "databaze" => "modules/.sqlite2",
                                                                        "uloziste" => 1,
                                                                        "aktivni" => 1,
                                                                        "poradi" => 1,
                                                                        "pevneporadi" => 1),

                                                                    array("id" => 2,
                                                                        "include" => "modules/dynamic_cron/dynamic_cron.php",
                                                                        "class" => "DynamicCron",
                                                                        "admin" => 1,
                                                                        "databaze" => ".dbdyncro.sqlite2",
                                                                        "uloziste" => 1,
                                                                        "aktivni" => 1,
                                                                        "poradi" => 2,
                                                                        "pevneporadi" => 2),

                                                                    array("id" => 3,
                                                                        "include" => "modules/dynamic_database/dynamic_database.php",
                                                                        "class" => "DynamicDatabase",
                                                                        "admin" => 1,
                                                                        "databaze" => "",
                                                                        "uloziste" => 0,
                                                                        "aktivni" => 1,
                                                                        "poradi" => 3,
                                                                        "pevneporadi" => 3),

                                                                    array("id" => 4,
                                                                        "include" => "modules/dynamic_config/dynamic_config.php",
                                                                        "class" => "DynamicConfig",
                                                                        "admin" => 1,
                                                                        "databaze" => ".dbdyncon.sqlite2",
                                                                        "uloziste" => 1,
                                                                        "aktivni" => 1,
                                                                        "poradi" => 4,
                                                                        "pevneporadi" => 4),

                                                                    array("id" => 5,
                                                                        "include" => "modules/dynamic_htaccess/dynamic_htaccess.php",
                                                                        "class" => "DynamicHtaccess",
                                                                        "admin" => 1,
                                                                        "databaze" => ".dbdynhta.sqlite2",
                                                                        "uloziste" => 1,
                                                                        "aktivni" => 1,
                                                                        "poradi" => 5,
                                                                        "pevneporadi" => "%%1%%"),
                                                                    ),
                                                ),

                  "admin_permit" => array("" => array("" => "Meta refresh ***"),
                                          "%%1%%%%2%%" => array("" => "Odhlašování z administrace ***"),
                                          "%%1%%" => array("" => "Zobrazení úvodní strany ***"),
                                          "%%1%%%%3%%" => array("" => "Výpis modulů", "addmod" => "Přidat modul", "editmod" => "Upravit modul", "delmod" => "Smazat modul", "clemod" => "Promazat databázi modulu", "deldb" => "Smazat databázi modulu", "changeact" => "Měnit aktivitu modulů", "updatemenu" => "Měnit pořadí modulů", "getmoduleupdate" => "Kontrola aktualizací modulů"),
                                          "%%1%%%%4%%" => array("" => "Výpis aktualizací"),
                                          "%%1%%%%5%%" => array("" => "Výpis nastavení"),
                                          "%%1%%%%6%%" => array("" => "Výpis ovládání administrace", "clearerrlog" => "Promazat error logy", "clearerrpag" => "Promazat error page", "clearweblog" => "Promazat web logy", "clearactlog" => "Promazat action logy", "clearseslog" => "Promazat session logy", "clearcache" => "Promazat cache", "clkon" => "Regenerovat konfigurační javascripty", "genpri" => "Změna přístupových údajů do databáze"),
                                          "%%1%%%%7%%" => array("" => "Výpis přístupových práv složek "),
                                          "%%1%%%%8%%" => array("" => "Výpis oprávnění (Zpřístupní: \"Zobrazit v oprávnění\")", "setpermit" => "Nastavování práv", "addperm" => "Přidat skupinu oprávnění", "editperm" => "Upravit skupinu oprávnění", "delperm" => "Smazat skupinu oprávnění"),
                                          "%%1%%%%9%%" => array("" => "Výpis přehledu administrátorů", "adduser" => "Přidat administrátora", "edituser" => "Upravit administrátora", "deluser" => "Smazat administrátora"),
                                          "%%1%%%%10%%" => array("" => "Výpis přehledu přístupů do administrace", "clearlog" => "Promazat statistiky", "addip" => "Přidat BAN"),
                                          "%%1%%%%11%%" => array("" => "Statistiky přístupů"),
                                          "%%1%%%%12%%" => array("" => "Výpis přehledu BAN", "addip" => "Přidat BAN", "editip" => "Upravit BAN", "delip" => "Smazat BAN"),
                                          "%%1%%%%13%%" => array("" => "Výpis přehledu aktivity administrátorů", "show" => "Otevření přehledu aktivity administrátorů"),
                                          "%%1%%%%14%%" => array("" => "Výpis error logů", "view" => "Procházení error logů"),
                                          "%%1%%%%15%%" => array("" => "Výpis statistik"),
                                          "%%1%%%%16%%" => array("" => "Výpis statistik za dnešní den"),
                                          "%%1%%%%17%%" => array("" => "Výpis celkových statistik"),
                                          "%%1%%%%18%%" => array("" => "Help centrum"),
                                          "%%1%%%%19%%" => array("" => "Přidat report"),
                                          "%%1%%%%20%%" => array("" => "Výpis FAQ"),
                                          "%%1%%%%21%%" => array("" => "Testy systemu", "test_rv" => "Test regulárních výrazů", "sitemap" => "Genetrovani sitemap"),
                                          ),

                  "name_module" => array ("Administrace funkce",
                                          "Interní systém administrace"),

                  "admin_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_nacitani_css" => "<link rel=\"stylesheet\" type=\"text/css\" href=\"%%1%%%%2%%\" media=\"screen\" />\n      ",

                  "set_typdatabaze" => array ("Modul bez databáze",
                                              "SQLite",
                                              "MySQLi"),

                  "set_prohlizece" => array("Firefox" => "3.6",
                                            "Safari" => "5.0",
                                            "Chrome" => "6.0",
                                            "Opera" => "10.60",
                                            ),

                  "admin_ip_blok" => array ("127.0.1.1",  //seznam blokovanych ip pri kontrole z localhostu
                                            "127.0.0.1"),

                  "set_addon_mount" => array("styles/admin/central_styles_admin.css",
                                             "styles/admin/reset_admin.css",
                                             "styles/admin/theme/somewhere_deep/somewhere_deep.css"),

                  "admin_tvar_datum_paticka" => "H:i:s",

                  "set_expire_erroadmin" => "-5 day", //expirace error logu

                  "set_expire_dataadmin" => "-5 day", //expirace databaze

                  "set_expire_unikadmin" => "-5 day", //expirace unikatnich

                  "set_expire_logadmin" => "-14 day",  //expirace logovani do adminu

                  "text_cas_aktualizace" => "<p>Poslední čas aktualizace stránky: <strong>%%1%%</strong></p>
          <p>Při neaktivitě budeš automaticky odhlášen v: <strong>%%2%%</strong></p>
          <p>Automatické odhlášení je nastaveno na: <strong>%%3%%</strong><em>%%4%%</em></p>",

                  "admin_centralni_hlaska_navic" => "<strong>Navíc: %%1%%</strong>",

                  "admin_centralni_hlaska_add" => "
<div class=\"central_tip_success\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>ÚSPĚCH</h3>
    <h4>Přidáno</h4>
    <p>%%1%%%%2%%</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_centralni_hlaska_copy" => "
<div class=\"central_tip_success\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>ÚSPĚCH</h3>
    <h4>Duplikováno</h4>
    <p>%%1%%%%2%%</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_centralni_hlaska_edit" => "
<div class=\"central_tip_info\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>INFO</h3>
    <h4>Upraveno</h4>
    <p>%%1%%%%2%%</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_centralni_hlaska_del" => "
<div class=\"central_tip_info\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>INFO</h3>
    <h4>Smazáno</h4>
    <p>%%1%%%%2%%</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_centralni_hlaska_umisteni" => "<strong>%%1%%<!-- --></strong><strong>%%2%%<!-- --></strong>",

                  "admin_centralni_hlaska_info" => "
<div class=\"central_tip_info\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>INFO</h3>
    <p>%%1%%</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_centralni_hlaska_warning" => "
<div class=\"central_tip_warning\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>VAROVÁNÍ</h3>
    <p>%%1%%%%2%%</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_centralni_hlaska_notexists" => "
<div class=\"central_tip_warning\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>VAROVÁNÍ</h3>
    <h4>Neexistuje</h4>
    <p>%%1%%%%2%%</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_centralni_hlaska_error" => "
<div class=\"central_tip_error\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>CHYBA</h3>
%%1%%
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>",

                  "admin_centralni_hlaska_error_row" => "<h4>%%1%%</h4><p>Řádek: %%2%%<br />Metoda: %%3%%</p>\n",

                  "admin_centralni_hlaska_clear" => "
<div class=\"central_tip_info\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>INFO</h3>
    <h4>Promazáno</h4>
    <p>%%1%%</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_centralni_hlaska_send" => "
<div class=\"central_tip_info\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>INFO</h3>
    <h4>Odesláno</h4>
    <p>%%1%%</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_logoff" => "
<div class=\"central_tip_info\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>INFO</h3>
    <h4>Probíhá odhlašování z administrace</h4>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_redirect" => "
<div class=\"central_tip_info\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>INFO</h3>
    <h4>Probíhá přesměrování administrace</h4>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_menu_user_ban" => "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta http-equiv=\"refresh\" content=\"1;URL=%%1%%\" />
    <title>Do této části administrace nemáš přístup !</title>
  </head>
  <body>
    <div>
      <h1 style=\"text-align: center; font-size: 30px;\">Do této části administrace nemáš přístup !</h1>
    </div>
  </body>
</html>",

                  "vypis_debug" => "Načteno: %%1%% / %%2%% [ <strong>%%3%%</strong>, next: %%4%% ] <em>%%5%%</em><br />",

                  "error_page_text" => array (array("kod" => 400,
                                                    "popiskod" => "Špatná žádost",
                                                    "popis" => "Žádost nemůže být zpracována."),

                                              array("kod" => 401,
                                                    "popiskod" => "Neoprávněný přístup",
                                                    "popis" => "Pro vstup do této sekce nemáte dostatečná oprávnění."),

                                              array("kod" => 403,
                                                    "popiskod" => "Zakázáno",
                                                    "popis" => "Vaše operace byla zakázána."),

                                              array("kod" => 404,
                                                    "popiskod" => "Nenalezeno",
                                                    "popis" => "Požadovaná stránka není k dispozici."),

                                              array("kod" => 500,
                                                    "popiskod" => "Vnitřní chyba serveru",
                                                    "popis" => "Omlouváme se, vyskytla se chyba."),

                                              array("kod" => 503,
                                                    "popiskod" => "Služba není k dispozici",
                                                    "popis" => "Požadovaná služba není momentálně k dispozici."),
                                                    ),

                  "error_page_sablona" => "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GoodFlow design\" />
    <meta name=\"keywords\" content=\"\" />
    <meta name=\"description\" content=\"%%kod%% - %%popiskod%% - %%nazevwebu%%\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"%%absolutni_url%%%%errorpage%%/error.css\" media=\"screen\" />
    <title>%%kod%% - %%popiskod%% - %%nazevwebu%%</title>
  </head>
  <body id=\"error_%%kod%%\">
    <h1>%%kod%% - %%popiskod%%</h1>
    <p>%%popis%%</p>
    <p>Můžete se zkusit vrátit o <a href=\"javascript:history.go(-1)\" title=\"Zpět o stránku\">stránku zpět klapnutím na tento odkaz</a>.</p>
    <p>Nebo můžete následovat <a href=\"%%absolutni_url%%\" title=\"Na hlavní stranu webu %%nazevwebu%%\">tento odkaz, který Vás zavede na hlavní stránku webu %%nazevwebu%%</a></p>
  </body>
</html>",

                  "set_zaplaceno" => true,

                  "datum_blokace_begin" => "01.01.2010 00:00:00",

                  "tvar_datum_blokace" => "d.m.Y, H:i:s",

                  "blokace_stranky_true" => "Stránky jsou blokovány od %%1%%",

                  "blokace_stranky_false" => "<strong>Stránky nebyly zatím zaplaceny. Nyní budou aktivní do: %%1%%, ",

                  "blokace_penale" => 0, //kč za jednotku

                  "blokace_typ_jednotka" => "den", //hodina/"den"/mesic

                  "blokace_pocet_jednotka" => 1,  //na typ jednotky, každou X-tou jednotku

                  "blokace_msg" => "blok_webu_dni_s_datem_zapisu::%%1%%",

                  "blokace_info_true" => "Stránky jsou zablokovány z důvodu nezaplacení již %%1%% %%2%%. Penále za prodlení dohodnuté částky činí <em>%%3%%,- Kč</em>",

                  "blokace_info_false" => "stránky budou funkční ještě %%1%% %%2%%</strong><br /><br />",

                  "ajax_zeme_notfound_1" => "Nebyla nalezena země",

                  "ajax_zeme_local_1" => "localhost",

                  "ajax_get_zeme_1" => "%%2%%",

                  "ajaxscript" => "
  function GetZeme(ip, tvar, ret)
  {
    $.post(\"ajax_funkce.php\",
          \"action=getzeme&ip=\"+ip+\"&tvar=\"+tvar,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetHostName(ip, ret)
  {
    $.post(\"ajax_funkce.php\",
          \"action=gethostname&ip=\"+ip,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetSize(cesta, ret)
  {
    $.post(\"ajax_funkce.php\",
          \"action=getsize&cesta=\"+cesta,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetAdrSize(cesta, rek, ret)
  {
    $.post(\"ajax_funkce.php\",
          \"action=getadrsize&cesta=\"+cesta+\"&rek=\"+rek,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetAvgSize(cesta, rek, ret)
  {
    $.post(\"ajax_funkce.php\",
          \"action=getavgsize&cesta=\"+cesta+\"&rek=\"+rek,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetValue(key, ret)
  {
    $.post(\"ajax_funkce.php\",
          \"action=getvalue&key=\"+key,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  }

  function GetModulUpdate(include, classa, ret)
  {
    $.post(\"ajax_funkce.php\",
      \"action=getmoduleupdate&include=\"+include+\"&class=\"+classa,
        function(theResponse)
        {
          $(ret).html(theResponse);
        }
      );
  }

  function SetPermit(id, adresa, stav, ret)
  {
    $.post(\"ajax_funkce.php\",
          \"action=setpermit&id=\"+id+\"&adresa=\"+adresa+\"&stav=\"+stav,
            function(theResponse)
            {
              $(ret).html(theResponse);
              ZpracujHlasku(ret);
            }
          );
  }

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }

  function Hodiny(ret, obnova)
  {
    window.setInterval(function(){
      $.post(\"ajax_funkce.php\",
        \"action=cas\",
          function(theResponse)
          {
            $(ret).html(theResponse);
          }
        );
    }, obnova);
  }",

/* - - - - - - - - - - Záhlaví navigace - - - - - - - - - - */

                  "set_current_theme" => "somewhere_deep",

                  "admin_vyber_tematu_begin" => "          <div id=\"vyber_tematu\">
            <div id=\"aktualni_tema\">
              <em>%%1%%</em>
            </div>
            <div id=\"seznam_temat\">
              <span id=\"seznam_temat_repeat\"></span>
              <span id=\"seznam_temat_pattern\"></span>
              <span id=\"seznam_temat_top\"></span>",

                  "admin_vyber_tematu" => "\n              <a href=\"%%1%%\" title=\"%%3%%\"%%2%%>%%3%%</a>",

                  "admin_vyber_tematu_aktivni" => " id=\"aktivni_vyber_tematu\"",

                  "admin_vyber_tematu_end" => "\n              <span id=\"seznam_temat_bottom\"></span>
            </div>
          </div>",

                  "admin_vyber_tematu_hlaska" => "<div id=\"nastaveno_zvolene_tema\"><span id=\"nastaveno_zvolene_tema_nadpis\">Nastaven vizuální vzhled</span><span id=\"nastaveno_zvolene_tema_nazev\">%%1%%</span></div>",

                  "tvar_admin_menu_begin" => "<div id=\"navigace_zahlavi\">
          <script type=\"text/javascript\">
            Hodiny('#aktualni_cas_hodnota', %%1%%*1000);
          </script>
          <p id=\"aktualni_cas_navigace\">
            <span id=\"aktualni_cas_nadpis\">ČAS</span>
            <span id=\"aktualni_cas_hodnota\">%%4%%</span>
          </p>
          <p id=\"aktualni_datum_navigace\">
            <span id=\"aktualni_datum_nadpis\">DATUM</span>
            <span id=\"aktualni_datum_hodnota\">%%5%%</span>
          </p>
          <a href=\"http://www.gfdesign.cz/\" title=\"GoodFlow design - Tvorba webových stránek a systémů\" id=\"odkaz_created_by\"><span><!-- GoodFlow design - Tvorba webových stránek a systémů --></span></a>
          <p id=\"vizualni_vzhled_navigace\">Momentální vizuální vzhled</p>
%%6%%
          <div id=\"logout_prejit_na_web\">
            <a href=\"%%2%%%%3%%\" onclick=\"return confirm('Opravdu se chcete odhlásit z GoodFlow Admin systému ?');\" title=\"Odhlásit se z GoodFlow Admin systému\" id=\"odkaz_odhlasit_se\">
              <span>Logout</span>
            </a>
            <a href=\"%%2%%\" title=\"Přejít na stránky bez odhlášení\" id=\"odkaz_prejit_na_web\">
              <span>Přejít na web</span>
            </a>
          </div>
        </div>\n",

/* - - - - - - - - - - /Záhlaví navigace - - - - - - - - - - */

/* - - - - - - - - - - Navigace - - - - - - - - - - */

                  "admin_menu_obal_begin" => "        <ul>
          <li class=\"nadpis_oddilu\">%%11%%<!-- --></li>\n",
//%%4%%%%6%%%%9%%
                  "tvar_admin_menu" => "          <li class=\"navigace_polozka zanoreni-%%8%%%%7%% zanoreni-%%8%%%%5%%\">
            <span class=\"navigace_aktivni_repeat\"><!-- --></span>
            <span class=\"navigace_aktivni_top\"><!-- --></span>
            <a href=\"%%1%%\" title=\"%%3%%\">
              <span class=\"navigace_sipka\">&rsaquo;&rsaquo;</span>
              <span class=\"navigace_plus\">+</span>
              <span class=\"navigace_text_odkazu\">%%2%%</span>
            </a>
            <span class=\"navigace_aktivni_bottom\"><!-- --></span>
          </li>\n",

                  "tvar_admin_menu_permit" => "          <li class=\"navigace_polozka navigace_standard_admin%%7%%\">
            <span class=\"navigace_aktivni_repeat\"><!-- --></span>
            <span class=\"navigace_aktivni_top\"><!-- --></span>
            <a href=\"%%1%%\" title=\"%%3%%\"%%4%%%%6%%%%9%%>
              <span class=\"navigace_sipka\">&rsaquo;&rsaquo;</span>
              <span class=\"navigace_plus\">+</span>
              <span class=\"navigace_text_odkazu\">%%2%%</span>
            </a>
            <span class=\"navigace_aktivni_bottom\"><!-- --></span>
          </li>\n",

                  "admin_menu_obal_end" => "        </ul>\n",

                  "tvar_aktivni_id" => "-aktivni",

                  "tvar_aktivni_class" => " aktivni",

                  "tvar_aktivity_prvni" => "",

                  "tvar_aktivity_posledni" => "",

                  "tvar_ente_od" => 0,

                  "tvar_ente_po" => 2,

                  "tvar_aktivity_ente_odpo" => "",

                  "tvar_ente_array" => array(1, 2),

                  "tvar_aktivity_ente_array" => "",

                  "tvar_aktivity_volitelny_text" => "",

                  "tvar_aktivity_odkazu_LP" => array("[ ", " ]"),

/* - - - - - - - - - - /Navigace - - - - - - - - - - */

/* - - - - - - - - - - Úvodní strana - - - - - - - - - - */

                  "uvod_admin_text" => "<div class=\"obal_uvodni_strana ow-h\">
  %%1%%
  <div class=\"ow-h\">
    %%2%%
    %%3%%
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 m-t-25 p-t-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Návštěvnost stránek za poslední měsíc</h3>
    %%4%%
    %%5%%
  </div>
  %%6%%
</div>\n",

                  "admin_uvodni_header_user" => "
<script type=\"text/javascript\" src=\"script/jquery/admin/jquery.simpledialog.0.1.min.js\"></script>
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('#poprve-v-systemu-gf').simpleDialog({
      title: '',
      useTitleAttr: true,
      containerId: 'sd_container',
      containerClass: 'sd_container',
      overlayId: 'sd_overlay',
      overlayClass: 'sd_overlay',
      loadingClass: 'sd_loading',
      closeLabelClass: 'sd_closelabel',
      showCloseLabel: false,
      closeLabel: 'close &times;',
      opacity: 0.9,
      duration: 1000,
      easing: 'easeOutExpo',
      zIndex: 1000,
      width: null,
      height: null,
      showCaption: true,
      open: null,
      close: null,
      closeSelector: '.poprve-v-systemu-gf-close'
    });
  });
</script>
<div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
  <h3 class=\"nadpis-sekce upc f-s-30\">Úvodní strana</h3>
  <h4 class=\"pod-nadpis-sekce f-s-17 f-f-web-pro upc ow-h\"><span class=\"fl-l\">Vítejte v systému GoodFlow Admin /</span><a href=\"#\" class=\"odkaz-5 fl-l t-a-c block no-u m-l-5 p-r-3 p-l-3\" id=\"poprve-v-systemu-gf\" title=\"Jste zde poprvé ?\" rel=\"poprvevsystemu\">Jste zde poprvé ? &rsaquo;&rsaquo;</a></h4>
  <div class=\"none\" id=\"poprvevsystemu\">
    <span id=\"poprve-v-systemu-gf-top\"><!-- --></span>
    <a href=\"#\" id=\"poprve-v-systemu-gf-close\" class=\"poprve-v-systemu-gf-close\" title=\"Zavřít\"><!-- --></a>
    <h5>Poprvé v systému GoodFlow Admin ?</h5>
%%1%%
    <a href=\"http://www.gfdesign.cz/\" id=\"poprve-v-systemu-gf-author\" title=\"GoodFlow design - Tvorba webových stránek a systémů\"><!-- GoodFlow design - Tvorba webových stránek a systémů --></a>
  </div>
</div>\n",

                  "admin_uvodni_header_admin" => "<div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
  <h3 class=\"nadpis-sekce upc f-s-30\">Úvodní strana</h3>
  <h4 class=\"pod-nadpis-sekce f-s-17 f-f-web-pro upc\">Vítejte v systému GoodFlow Admin</h4>
</div>\n",

                  "admin_uvodni_webinfo" => "
<div class=\"ow-h fl-l w-240 f-f-web-pro\">
  <h3 class=\"nadpis-1 p-t-10 p-b-10 p-l-10 f-s-22 b\">Web info</h3>
  <p class=\"fl-l m-t-10 m-b-5 m-l-6 p-t-2 p-r-4 p-b-2 p-l-4 barva-10 f-s-14\">Doména</p>
  <div class=\"cl-b f-s-14 m-l-9\">
    <p>Poskytovatel:</p>
    <p class=\"m-t-2 m-b-10 barva-4\">%%1%%</p>
    <p>Datum expirace:</p>
    <p class=\"m-t-2 barva-4\">%%2%%</p>
  </div>
  <p class=\"fl-l m-t-20 m-b-5 m-l-6 p-t-2 p-r-4 p-b-2 p-l-4 barva-10 f-s-14\">Hosting</p>
  <div class=\"cl-b f-s-14 m-l-9\">
    <p>Poskytovatel:</p>
    <p class=\"m-t-2 m-b-10 barva-4\">%%3%%</p>
    <p>Datum expirace:</p>
    <p class=\"m-t-2 barva-4\">%%4%%</p>
  </div>
</div>\n",

                  "admin_uvodni_webinfo_tvar_datum" => "d.m.Y",

                  "admin_uvodni_novinky" => "
<script type=\"text/javascript\" src=\"script/jquery/admin/jquery.coda-slider-2.0.js\"></script>
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('#coda-slider-novinky').codaSlider({
      autoHeight: true,
      autoHeightEaseDuration: 1000,
      autoHeightEaseFunction: 'easeOutExpo',
      autoSlide: false,
      crossLinking: false,
      dynamicArrows: false,
      dynamicTabs: true,
      dynamicTabsAlign: 'right',
      dynamicTabsPosition: 'bottom',
      firstPanelToLoad: 1,
      slideEaseDuration: 1000,
      slideEaseFunction: 'easeOutExpo'
    });
  });
</script>
<div class=\"ow-h fl-r w-460 f-f-web-pro\">
  <h3 class=\"nadpis-1 p-t-10 p-b-10 p-l-10 f-s-22 b\">Poslední aktualizace GoodFlow Admin</h3>
  <div id=\"coda-slider-novinky\" class=\"ow-h w-450 m-t-10 m-b-5 m-l-6\">
%%1%%
  </div>
</div>\n",

                  "admin_uvodni_novinky_tvar_datum" => "d.m.Y",

                  "admin_uvodni_novinky_row_sudy" => "
    <div class=\"panel w-450 fl-l\">
      <div class=\"cl-b ow-h m-r-6 m-b-25\">
        <p class=\"pos-rel fl-l p-t-2 p-r-4 p-b-2 p-l-4 f-s-14 barva-11\">%%1%%<span class=\"novinka-sipka\"><!-- --></span></p>
        <p class=\"fl-l f-s-12 p-t-3 p-r-3 p-b-3 p-l-3 barva-13\">%%2%%</p>
        <p class=\"cl-b m-t-15 fl-l f-s-14 l-h-20\">%%3%%</p>
      </div>
    %%4%%",

                  "admin_uvodni_novinky_row_lichy" => "
      <div class=\"cl-b ow-h m-r-6 m-b-20\">
        <p class=\"pos-rel fl-l p-t-2 p-r-4 p-b-2 p-l-4 f-s-14 barva-12\">%%1%%<span class=\"novinka-sipka\"><!-- --></span></p>
        <p class=\"fl-l f-s-12 p-t-3 p-r-3 p-b-3 p-l-3 barva-13\">%%2%%</p>
        <p class=\"cl-b m-t-15 fl-l f-s-14 l-h-20\">%%3%%</p>
      </div>
    %%4%%",

                  "admin_uvodni_novinky_row_end" => "</div>\n",

                  "admin_uvodni_novinky_row_null" => "<div class=\"nadpis-2 f-s-14 p-t-10 p-b-10 t-a-c f-f-web-pro cl-b\">Žádný záznam o aktualizaci.</div>",

                  "admin_uvodni_graf" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\">
  $(function() {
      Highcharts.setOptions({
        lang: { months: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Záři', 'Říjen', 'Listopad', 'Prosinec'],
                weekdays: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota']
              }
      });
    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container',
        defaultSeriesType: 'area',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        labels: {
          formatter: function() {
            return Highcharts.dateFormat('%e.%B', this.value);
          },
          align: 'left',
          rotation: 90,
          x: -3,
          y: 10,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        tickInterval: 2 * 24 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet návštěvníků',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 12px; color: #a7a7a7;\">%A, %e. %B %Y<\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        area: {
          color: '#0077cc',
          fillOpacity: 0.1,
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        name: '',
        data: [%%2%%]
      }]
    });
  });
</script>
<div id=\"container\" class=\"h-340\"></div>\n",

                  "uvod_admin_text_userlog" => "<a href=\"%%1%%\" title=\"Přejít do sekce statistiky\" class=\"odkaz-1 block f-f-web-pro f-s-14 fl-r no-u m-r-10 p-t-2 p-r-3 p-b-2 p-l-3 cl-b\">Přejít do sekce statistiky</a>",

                  "info_admin_uvod_text" => "<h3 class=\"nadpis-1 m-t-25 p-t-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Souhrnné informace</h3>
<a href=\"#\" onclick=\"ZmeritVse(); return false\" title=\"Zobrazit všechny hodnoty\" class=\"odkaz-1 block fl-l f-s-12 f-f-web-pro no-u m-t-10 m-b-10 m-l-5 p-t-3 p-r-3 p-b-3 p-l-3\">Zobrazit všechny hodnoty</a>
<script type=\"text/javascript\">
  function ZmeritVse()
  {
    GetAdrSize(%%6%%, '#idcelmod');
    GetSize(%%7%%, '#idceldat');
    GetAdrSize(%%8%%, '#idcelzal');
    GetAdrSize(%%9%%, '#idunizal');
    GetAdrSize(%%10%%, '#iderrzal');
    GetAdrSize(%%11%%, '#idcelweb');
    GetAdrSize(%%12%%, '#idcelsty');
    GetAdrSize(%%13%%, '#idcelskr');
    GetAdrSize(%%14%%, '#idcelobr');
    GetAdrSize(%%15%%, '#idcelsek');
    GetAdrSize(%%16%%, '#idcelwlo');
    GetAvgSize(%%16%%, '#idavgwlo');
    GetValue('mPDF', '#idverpdf');
    GetValue('phpver', '#idverphp');
    GetValue('phpvermin', '#idminverphp');
    GetValue('zipver', '#idverzip');
    GetValue('sqlitever', '#idversqlite');
    GetValue('apachever', '#idverapache');
    GetValue('systemver', '#idversystem');
    GetValue('loadext', '#idextload');
    GetValue('needext', '#idextneed');
    GetValue('curos', '#idoscur');
    GetValue('curbrow', '#idbrowcur');
    GetValue('curip', '#idipcur');
    GetValue('curhost', '#idhostcur');
    GetValue('curjquery', '#idjquerycur');
    GetValue('curlocjquery', '#idlocjquerycur');
    GetValue('curjqueryui', '#idjqueryuicur');
    GetValue('curlocjqueryui', '#idlocjqueryuicur');
    GetValue('curhighslide', '#idhighslidecur');
    GetValue('curlochighslide', '#idlochighslidecur');
    GetValue('curhighcharts', '#idhighchartscur');
    GetValue('curlochighcharts', '#idlochighchartscur');
    GetValue('curmpdf', '#idmpdfcur');
    GetValue('getbrowver', '#idbrowverget');
    GetValue('curgetbrowver', '#idbrowvercurget');
    GetValue('getbrowreleased', '#idbrowreleasedget');
    GetValue('curgetbrowreleased', '#idbrowreleasedcurget');
  }
</script>
<div class=\"obal-definicni-vycty ow-h cl-b\">
  <dl class=\"w-350 fl-l f-f-web-pro f-s-14 m-l-10\">
    <dt>Počet modulů:</dt>
      <dd>%%1%%</dd>
    <dt>Počet databází:</dt>
      <dd>%%2%%</dd>
    <dt>Počet načítaných soborů:</dt>
      <dd>%%3%%</dd>
    <dt>Přidělená paměť:</dt>
      <dd>%%4%%</dd>
    <dt>Reálná přidělená paměť:</dt>
      <dd>%%5%%</dd>
    <dt>Velikost všech modulů:</dt>
      <dd id=\"idcelmod\">???</dd>
    <dt>Velikost všech databází:</dt>
      <dd id=\"idceldat\">???</dd>
    <dt>Velikost celého webu:</dt>
      <dd id=\"idcelweb\">???</dd>
    <dt>Velikost stylů:</dt>
      <dd id=\"idcelsty\">???</dd>
    <dt>Velikost skriptů:</dt>
      <dd id=\"idcelskr\">???</dd>
    <dt>Velikost obrázků:</dt>
      <dd id=\"idcelobr\">???</dd>
    <dt>Velikost záloh databází:</dt>
      <dd id=\"idcelzal\">???</dd>
    <dt>Velikost záloh unikátních:</dt>
      <dd id=\"idunizal\">???</dd>
    <dt>Velikost záloh error logů:</dt>
      <dd id=\"iderrzal\">???</dd>
    <dt>Velikost sekcí:</dt>
      <dd id=\"idcelsek\">???</dd>
    <dt>Velikost web logů:</dt>
      <dd id=\"idcelwlo\">???</dd>
    <dt>Průměrná velikost web logů:</dt>
      <dd id=\"idavgwlo\">???</dd>
    <dt>Minimální verze PHP:</dt>
      <dd id=\"idminverphp\">???</dd>
    <dt>Aktuální verze PHP:</dt>
      <dd id=\"idverphp\">???</dd>
    <dt>Verze ZIP:</dt>
      <dd id=\"idverzip\">???</dd>
    <dt>Verze SQLite:</dt>
      <dd id=\"idversqlite\">???</dd>
    <dt>Verze Apache:</dt>
      <dd id=\"idverapache\">???</dd>
    <dt>Verze Systému:</dt>
      <dd id=\"idversystem\">???</dd>
  </dl>
  <dl class=\"w-340 fl-r f-f-web-pro f-s-14\">
    <dt>Načtené rozšíření:</dt>
      <dd id=\"idextload\">???</dd>
    <dt>Potřebné rozšíření:</dt>
      <dd id=\"idextneed\">???</dd>
    <dt>Aktuální operační systém:</dt>
      <dd id=\"idoscur\">???</dd>
    <dt>Aktuální prohlížeč:</dt>
      <dd id=\"idbrowcur\">???</dd>
    <dt>Aktuální IP:</dt>
      <dd id=\"idipcur\">???</dd>
    <dt>Aktuální hostname:</dt>
      <dd id=\"idhostcur\">???</dd>
    <dt>Verze jQuery:</dt>
      <dd id=\"idlocjquerycur\">???</dd>
    <dt>Verze jQuery na internetu:</dt>
      <dd id=\"idjquerycur\">???</dd>
    <dt>Verze jQuery UI:</dt>
      <dd id=\"idlocjqueryuicur\">???</dd>
    <dt>Verze jQuery UI na internetu:</dt>
      <dd id=\"idjqueryuicur\">???</dd>
    <dt>Verze mPDF:</dt>
      <dd id=\"idverpdf\">???</dd>
    <dt>Verze mPDF na internetu:</dt>
      <dd id=\"idmpdfcur\">???</dd>
    <dt>Verze Highslide:</dt>
      <dd id=\"idlochighslidecur\">???</dd>
    <dt>Verze Highslide na internetu:</dt>
      <dd id=\"idhighslidecur\">???</dd>
    <dt>Verze Highcharts:</dt>
      <dd id=\"idlochighchartscur\">???</dd>
    <dt>Verze Highcharts na internetu:</dt>
      <dd id=\"idhighchartscur\">???</dd>
    <dt>Verze Browscap:</dt>
      <dd id=\"idbrowverget\">???</dd>
    <dt>Verze Browscap na internetu:</dt>
      <dd id=\"idbrowvercurget\">???</dd>
    <dt>Verze Browscap released:</dt>
      <dd id=\"idbrowreleasedget\">???</dd>
    <dt>Verze Browscap released na internetu:</dt>
      <dd id=\"idbrowreleasedcurget\">???</dd>
    <dt>Počet chyb za dnešek:</dt>
      <dd class=\"ow-h\"><a href=\"%%17%%\" title=\"Počet chyb za dnešek: %%18%%\" class=\"odkaz-1 block fl-l no-u p-t-1 p-r-2 p-b-1 p-l-2\">%%18%%</a></dd>
    <dt>Počet všech chyb:</dt>
      <dd class=\"ow-h\"><a href=\"%%19%%\" title=\"Počet všech chyb: %%20%%\" class=\"odkaz-1 block fl-l no-u p-t-1 p-r-2 p-b-1 p-l-2\">%%20%%</a></dd>
  </dl>
</div>\n",

                  "ajax_need_ext" => "<span class=\"block ow-h m-b-1\"><input type=\"checkbox\" disabled=\"disabled\" %%2%% class=\"block fl-l m-t-1\" /> <em class=\"block m-l-5 no-i fl-l\">%%1%%</em></span>",

                  "info_admin_uvod_ready_verze" => "<strong class=\"no-b block l-h-17 fl-l m-r-3\">%%1%%</strong><span class=\"aktualni\"></span>",

                  "info_admin_uvod_wrong_verze" => "<strong class=\"no-b block l-h-17 fl-l m-r-3\">%%1%%</strong><span class=\"neaktualni\"></span>",

                  "admin_vypis_zaloha_null" => "<div class=\"nadpis-1 m-t-25 p-t-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b ow-h\">
  <span class=\"block\">Přehled záloh databáze</span>
  <a href=\"%%1%%\" title=\"Zálohovat databázi\" class=\"block fl-l odkaz-2 no-b f-s-14 no-u m-t-2\">Zálohovat databázi</a>
</div>
<ul class=\"nadpis-2 f-s-18 ow-h m-r-10 m-l-10 p-t-6 p-b-6 f-f-web-pro t-a-c\">
  <li>Není vytvořena záloha databáze</li>
</ul>\n",

                  "admin_vypis_zaloha" => "<div class=\"nadpis-1 m-t-25 p-t-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b ow-h\">
  <span class=\"block\">Přehled záloh databáze</span>
  <a href=\"%%1%%\" title=\"Zálohovat databázi\" class=\"block fl-l odkaz-2 no-b f-s-14 no-u m-t-2\">Zálohovat databázi</a>
</div>
<ul class=\"nadpis-2 f-s-18 ow-h m-r-10 m-l-10 p-t-6 p-b-6 f-f-web-pro\">
  <li class=\"w-300 p-l-10 fl-l\">Název databáze</li>
  <li class=\"w-170 fl-l\">Datum / Čas</li>
  <li class=\"w-110 fl-l\">Velikost</li>
  <li class=\"w-80 fl-l\">Smazat</li>
</ul>
%%2%%\n",

                  "admin_vypis_zaloha_row" => "
<ul class=\"polozka-1-%%6%% m-r-10 m-l-10 p-t-5 p-b-5 f-s-14 f-f-web-pro ow-h\">
  <li class=\"w-300 p-l-10 fl-l\"><a href=\"%%2%%\" title=\"%%1%%\" class=\"no-u odkaz-3\">%%1%%</a></li>
  <li class=\"w-170 fl-l\">%%3%%</li>
  <li class=\"w-110 fl-l\">%%4%%</li>
  <li class=\"w-80 fl-l\"><a href=\"%%5%%\" title=\"Opravdu chceš smazat zálohu: &quot;%%1%%&quot; ?\" class=\"confirm no-u odkaz-3\">Smazat</a></li>
</ul>\n",

                  "admin_vypis_zaloha_lichy" => "lichy",

                  "admin_vypis_zaloha_sudy" => "sudy",

/* - - - - - - - - - - /Úvodní strana - - - - - - - - - - */

/* - - - - - - - - - - Administrace modulů - - - - - - - - - - */

                  "admin_module" => "
<div class=\"obal_funkce_moumod\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Administrace modulů</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat modul\" class=\"addmod tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat modul</span>
  </a>
%%2%%
</div>\n",

                  "admin_addmod" => "
<script type=\"text/javascript\">
  function GetUpdateModule()
  {
    GetModulUpdate($('#id_include').val(), '%%4%%', '#id_%%4%%');
  }
  setTimeout(\"GetUpdateModule()\", 100); //automaticke spusteni
</script>
<div class=\"obal_funkce_moumod\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Přidat modul</h3>
  </div>
  <a href=\"%%10%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-select-optgroup f-povinny w-505\">
        <span class=\"nazev-elementu\">Modul:</span>
%%1%%
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span><br />Dostupných modulů: <em class=\"no-i u\">%%3%%</em>.</span>
      </label>
%%2%%
      <label class=\"f-text w-500 f-skryty%%4%%\">
        <span class=\"nazev-elementu\">Class:</span>
        <input type=\"text\" name=\"class\" value=\"%%4%%\" readonly=\"readonly\" />
      </label>
      <label class=\"f-checkbox w-500 f-skryty%%4%%\">
        <input type=\"checkbox\" disabled=\"disabled\"%%5%% />
        <span class=\"nazev-elementu\">Administrátorské prostředí</span>
      </label>
      <label class=\"f-text w-500 f-skryty%%4%%\">
        <span class=\"nazev-elementu\">Název databáze:</span>
        <input type=\"text\" name=\"databaze\" value=\"%%7%%\"%%6%% />
      </label>
      <label class=\"f-obsah\">
        <span class=\"nazev-elementu\">Podporované databáze:</span>
%%8%%
      </label>
      <label class=\"f-select f-obsah w-500\">
        <span class=\"nazev-elementu\">Zvolená databáze:</span>
%%9%%
      </label>
      <label class=\"f-checkbox w-500 f-skryty%%4%%\">
        <input type=\"checkbox\" name=\"aktivni\" checked=\"checked\" />
        <span class=\"nazev-elementu\">Aktivní modul</span>
      </label>
      <label class=\"f-obsah m-b-10 getmoduleupdate f-skryty%%4%%\">
        <span class=\"nazev-elementu\">Kontrola aktualizací modulu:</span>
        <a href=\"#\" onclick=\"GetUpdateModule(); return false;\" class=\"odkaz-1 p-t-2 p-r-3 p-b-2 p-l-3 f-s-14 f-f-web-pro l-h-22\">Zkontrolovat aktualizace</a>
      </label>
      <div class=\"polozka_aktualizace getmoduleupdate m-b-15 f-skryty%%4%%\">
        <div class=\"vsechny_casti_modulu\">
          <p class=\"nazev_casti_modulu nazev_casti_modulu_zahlavi\">Název části modulu</p>
          <p class=\"datum_zde_depozit datum_zde_depozit_zahlavi\"><span>Datum / čas zde</span><span>Datum / čas na depozitu</span></p>
          <p class=\"velikost_zde_depozit velikost_zde_depozit_zahlavi\"><span>Velikost zde</span><span>Velikost na depozitu</span></p>
          <p class=\"stav_aktualizace_casti stav_aktualizace_casti_zahlavi\">Stav</p>
        </div>
        <div id=\"id_%%4%%\" class=\"vsechny_casti_modulu\"><!-- --></div>
      </div>
      <label class=\"f-submit f-skryty%%4%%\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat modul\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editmod" => "
<script type=\"text/javascript\">
  function GetUpdateModule()
  {
    GetModulUpdate('%%1%%', '%%2%%', '#id_%%2%%');
  }
  setTimeout(\"GetUpdateModule()\", 100); //automaticke spusteni
</script>
<div class=\"obal_funkce_moumod\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Upravit modul</h3>
  </div>
  <a href=\"%%11%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-obsah\">
        <span class=\"nazev-elementu\">Modul:</span>
        <em class=\"polozka-obsah\">%%1%%<!-- --></em>
      </label>
      <label class=\"f-obsah\">
        <span class=\"nazev-elementu\">Class:</span>
        <em class=\"polozka-obsah\">%%2%%<!-- --></em>
      </label>
      <input type=\"hidden\" name=\"class\" value=\"%%2%%\" />
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" disabled=\"disabled\"%%3%% />
        <span class=\"nazev-elementu\">Administrátorské prostředí</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Název databáze:</span>
        <input type=\"text\" name=\"databaze\" value=\"%%5%%\"%%4%%%%9%% />
      </label>
      <label class=\"f-obsah\">
        <span class=\"nazev-elementu\">Podporované databáze:</span>
%%6%%
      </label>
      <label class=\"f-select f-obsah w-500\">
        <span class=\"nazev-elementu\">Zvolená databáze:</span>
%%7%%
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"aktivni\"%%8%%%%10%% />
        <span class=\"nazev-elementu\">Aktivní modul</span>
      </label>
      <label class=\"f-obsah m-b-10 getmoduleupdate\">
        <span class=\"nazev-elementu\">Kontrola aktualizací modulu:</span>
        <a href=\"#\" onclick=\"GetUpdateModule(); return false;\" class=\"odkaz-1 p-t-2 p-r-3 p-b-2 p-l-3 f-s-14 f-f-web-pro l-h-22\">Zkontrolovat aktualizace</a>
      </label>
      <div class=\"polozka_aktualizace getmoduleupdate m-b-15\">
        <div class=\"vsechny_casti_modulu\">
          <p class=\"nazev_casti_modulu nazev_casti_modulu_zahlavi\">Název části modulu</p>
          <p class=\"datum_zde_depozit datum_zde_depozit_zahlavi\"><span>Datum / čas zde</span><span>Datum / čas na depozitu</span></p>
          <p class=\"velikost_zde_depozit velikost_zde_depozit_zahlavi\"><span>Velikost zde</span><span>Velikost na depozitu</span></p>
          <p class=\"stav_aktualizace_casti stav_aktualizace_casti_zahlavi\">Stav</p>
        </div>
        <div id=\"id_%%2%%\" class=\"vsechny_casti_modulu\"><!-- --></div>
      </div>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit modul\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "ajax_get_module_update" => "
<p class=\"nazev_casti_modulu\">%%3%%</p>
<p class=\"datum_zde_depozit\"><span>%%4%%</span><span>%%5%%</span></p>
<p class=\"velikost_zde_depozit\"><span>%%6%%</span><span>%%7%%</span></p>
<p class=\"stav_aktualizace_casti\">%%8%%</p>\n",

                  "ajax_get_module_update_not_permit" => "Nemáte oprávnění",

                  "admin_vypis_module_begin" => "
<div class=\"obal_funkce_moumod\">
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('.vypis_modulu_polozka').css('cursor', 'move');
    $(function() {
      $(\"#obal_razeni\").sortable({
                          tolerance: 'pointer',
                          scroll: true,
                          scrollSensitivity: 40,
                          scrollSpeed: 30,
                          revert: 300,
                          opacity: 0.6,
                          cursor: 'move',
                          delay: 150,
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updatemenu';
        $.post(\"ajax_funkce.php\", order, function(theResponse){
          $('#status_drag').html(theResponse);
        });
        ZpracujHlasku('#status_drag');
      }
      });
    });
  });

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }

  function ChangeActive(id, stav)
  {
    ZpracujHlasku('#status_drag');

    $.post(\"ajax_funkce.php\", \"action=changeact&id=\"+id+\"&stav=\"+stav,
            function(theResponse)
            {
              $('#status_drag').html(theResponse);
            }
          );
  }
</script>
<div id=\"obal_razeni\" class=\"cl-b\">\n",

                  "admin_vypis_module" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%3%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%9%%\" title=\"Upravit modul\" class=\"editmod block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit modul</a>%%10%%%%11%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Cesta:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Administrátorské prostředí:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" disabled=\"disabled\"%%4%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zvolená databáze:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Název databáze:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní modul:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\"%%7%%%%8%% class=\"block m-t-2 cur-poi\" /></span></li>
</ul>\n",

                  "admin_vypis_module_link" => "<a href=\"%%1%%\" title=\"Opravdu chceš smazat modul: &quot;%%2%%&quot; ?\" class=\"confirm delmod block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat modul</a>",

                  "admin_vypis_module_secure" => "<span class=\"block fl-l m-r-5 m-l-5 no-u barva-3\">Nelze smazat</span>",

                  "admin_vypis_module_clear_link" => "<a href=\"%%1%%\" title=\"Opravdu chceš promazat databázi: &quot;%%3%%&quot; ?\" class=\"confirm clemod block fl-l m-r-5 m-l-5 no-u odkaz-4\">Promazat databázi</a><a href=\"%%2%%\" title=\"Opravdu chceš smazat databázi: &quot;%%3%%&quot; ?\" class=\"confirm deldb block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat databázi</a>",

                  "admin_vypis_module_noclear" => "<span class=\"block fl-l m-r-5 m-l-5 no-u barva-3\">Nelze promazat databázi</span>",

                  "admin_vypis_module_nodb" => "<span class=\"block fl-l m-r-5 m-l-5 no-u barva-3\">Modul nemá databázi</span>",

                  "admin_vypis_module_end" => "\n</div>\n</div>\n<div id=\"status_drag\"></div>\n",

                  "admin_vypis_module_null" => "<em class=\"polozka-obsah\">Není vybrán modul</em>",

                  "admin_vyber_include_begin" => "<select name=\"include\" id=\"id_include\" onchange=\"document.location.href='%%1%%&amp;include='+this.value;\">\n  <option value=\"\">--- Vyber modul ---</option>\n",

                  "admin_vyber_include_skupina_begin" => "<optgroup label=\"%%1%%\">\n",

                  "admin_vyber_include" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vyber_include_skupina_end" => "</optgroup>\n\n",

                  "admin_vyber_include_end" => "</select>\n",

                  "admin_vyber_include_pohyb" => "
      <label class=\"f-obsah\">
        <span class=\"nazev-elementu\">Procházení modulů:</span>
        <em class=\"polozka-obsah\">%%2%%<!-- --></em>
        <em class=\"polozka-obsah\">%%1%%<!-- --></em>
      </label>\n",

                  "admin_vyber_include_pohyb_next" => "<a href=\"%%1%%\" title=\"Další modul\" class=\"odkaz-1 p-t-2 p-r-3 p-b-2 p-l-3\">Další modul &rsaquo;&rsaquo;</a> [%%2%%]",

                  "admin_vyber_include_pohyb_prev" => "<a href=\"%%1%%\" title=\"Předchozí modul\" class=\"odkaz-1 p-t-2 p-r-3 p-b-2 p-l-3\">Předchozí modul &rsaquo;&rsaquo;</a> [%%2%%]",

                  "admin_support_begin" => "",

                  "admin_support" => "<em class=\"polozka-obsah db_%%2%%\" title=\"%%2%%\"><em class=\"no-i\">%%2%%</em></em>",

                  "admin_support_end" => "",

                  "admin_support_null" => "<em class=\"polozka-obsah\">Není vybrán modul</em>",

                  "admin_uloziste_begin" => "<select name=\"uloziste\">\n",

                  "admin_uloziste" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_uloziste_end" => "</select>",

                  "admin_uloziste_null" => "<em class=\"polozka-obsah\">Není vybrán modul</em>",

                  "ajax_updatemenu" => "Byl proveden přesun mezi položkami modulů",

                  "ajax_updatemenu_not_permit" => "<em class=\"polozka-obsah\">Nemáte oprávění</em>",

                  "ajax_update_action" => "Aktivita modulu s ID: <strong>%%1%%</strong> byla změněna",

                  "ajax_update_action_not_permit" => "<em class=\"polozka-obsah\">Nemáte oprávění</em>",

/* - - - - - - - - - - /Administrace modulů - - - - - - - - - - */

/* - - - - - - - - - - Aktualizace modulů - - - - - - - - - - */

                  "aktualizace_aktualni_hlaska" => "<span class=\"aktualni_verze\" title=\"Aktuální verze\"><!-- --></span>",

                  "aktualizace_neaktualni_hlaska" => "<span class=\"neaktualni_verze\" title=\"Neaktuální verze\"><!-- --></span>",

                  "aktualizace_null_soubor" => "<span class=\"vystraha_verze\" title=\"Tento modul není nahrán na depozitu\"><!-- --></span>",

                  "admin_aktualizace" => "
<div class=\"obal_funkce_update\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Aktualizace modulů</h3>
  </div>
  <div id=\"aktualizace_info_box\">
    <p class=\"info_right\"><em>Součet řádků všech modulů je přibližně: <span>%%2%%</span></em></p>
  </div>
  <div class=\"polozka_aktualizace_zahlavi\">
    <p class=\"nazev_modulu\">Název modulu</p>
    <p class=\"cas_zkontrolovano\">Čas kontroly modulu</p>
    <p class=\"zkontrolovat_vse\">Zkontrolovat všechny<br />části modulu</p>
    <p class=\"stav_aktualizace\">Stav</p>
  </div>
%%1%%
</div>\n",

                  "admin_aktualizace_row" => "
  <div class=\"polozka_aktualizace\">
    <p class=\"nazev_modulu\">%%1%% %%2%%</p>
    <p class=\"cas_zkontrolovano odpoved_%%1%%\">%%3%%</p>
    <p class=\"zkontrolovat_vse\"><a href=\"#\" onclick=\"$('#id_%%1%%').fadeIn('slow'); return false;\" title=\"Zkontrolovat všechny části modulu\" class=\"getupdate\">Zkontrolovat</a></p>
    <p class=\"stav_aktualizace stav_%%1%%\"><!-- -->%%4%%</p>

    <div id=\"id_%%1%%\" class=\"vsechny_casti_modulu\">
      <a href=\"#\" onclick=\"$('#id_%%1%%').fadeOut('slow'); return false;\" class=\"vsechny_casti_modulu_close\" title=\"Zavřít všechny části modulu\"><!-- --></a>
      <p class=\"nazev_casti_modulu nazev_casti_modulu_zahlavi\">Název části modulu</p>
      <p class=\"datum_zde_depozit datum_zde_depozit_zahlavi\"><span>Datum / čas zde</span><span>Datum / čas na depozitu</span></p>
      <p class=\"velikost_zde_depozit velikost_zde_depozit_zahlavi\"><span>Velikost zde</span><span>Velikost na depozitu</span></p>
      <p class=\"stav_aktualizace_casti stav_aktualizace_casti_zahlavi\">Stav</p>
      %%5%%
    </div>
  </div>\n",

                  "admin_aktualizace_row_soubor" => "
<p class=\"nazev_casti_modulu\">%%1%%</p>
<p class=\"datum_zde_depozit\"><span>%%2%%</span><span>%%3%%</span></p>
<p class=\"velikost_zde_depozit\"><span>%%4%%</span><span>%%5%%</span></p>
<p class=\"stav_aktualizace_casti\">%%6%%</p>\n",

                  //"ajax_get_update_not_permit" => "<em>Nemáte oprávnění</em>",

                  "set_aktualizace_datum" => "d.m.Y / H:i:s",

                  "set_aktualizace_nodatum" => "--.--.---- / --:--:--",

                  "set_aktualizace_nosize" => "---",

/*
                  "set_get_check" => "checkfile",

                  "set_get_down" => "downfile",

                  "set_get_downclass" => "class",
*/

/* - - - - - - - - - - /Aktualizace modulů - - - - - - - - - - */

/* - - - - - - - - - - Konfigurace administrace - - - - - - - - - - */

                  "admin_set_typ_jednotky_begin" => "<select name=\"blokace_typ_jednotka\">\n",

                  "admin_set_typ_jednotky" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_set_typ_jednotky_end" => "</select>",

                  "admin_vypis_blok_brow" => "
      <label class=\"f-checkbox w-500 m-b-0-i\">
        <input type=\"checkbox\" name=\"set_prohlizece[%%1%%]\" value=\"%%1%%\"%%2%% onclick=\"$('#browser%%1%%').attr('disabled', this.checked);\" />
        <span class=\"nazev-elementu\">%%1%%</span>
      </label>
      <label class=\"f-text w-500\">
        <input type=\"text\" id=\"browser%%1%%\" name=\"set_prohlizece[%%1%%]\" value=\"%%3%%\"%%4%% />
      </label>\n",

                  "admin_obsl_ipblok" => "
  <script type=\"text/javascript\">
    var pocip = %%1%%;
    function PridejIP()
    {
      pocip++;
      VykresliIP();
    }

    function OdeberIP()
    {
      pocip--;
      VykresliIP();
    }

    function NastavHodnotu(id, text)
    {
      pole_hodnota[id] = text;
    }

    var pole_hodnota = ['%%2%%'];
    function VykresliIP()
    {
      var obsah = '';
      var poradi;
      var element;
      for (i = 0; i < pocip; i++)
      {
        poradi = i + 1;
        element = \"<div class='m-b-6'><input type='text' name='admin_ip_blok[\"+i+\"]' value='\"+(pole_hodnota[i] != null ? pole_hodnota[i] : '')+\"' onchange='NastavHodnotu(\"+i+\", this.value);' /></div>\";

        if (poradi == pocip && poradi > 1)
        {
          element += \"<a href='#' onclick='OdeberIP(); return false;' title='Odebrat položku' class='odkaz-odebrat odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u'>Odebrat položku</a>\";
        }
        obsah = obsah + element;
      }

      $(function() {
        $('#polozky_ip').html(obsah);
        $('#pocetip').html(pocip);
      });
    }

    VykresliIP();
  </script>
<p class=\"ow-h\">
  <span class=\"block f-f-web-pro m-b-6\">Počet položek: <strong id=\"pocetip\" class=\"no-b u\"></strong></span>
  <a href=\"#\" onclick=\"PridejIP(); return false;\" title=\"Přidat položku\" class=\"block fl-l odkaz-1 m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Přidat položku</a>
</p>
<div id=\"polozky_ip\" class=\"f-text w-500 pos-rel obal-odkazy-pridat-odebrat m-b-9-i\"></div>\n",

                  "admin_set_config" => "
<div class=\"obal_funkce_set\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Konfigurace administrace</h3>
  </div>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"waitindex\"%%waitindex%% />
        <span class=\"nazev-elementu\">Stránky ve výstavbě</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"set_zaplaceno\"%%set_zaplaceno%% />
        <span class=\"nazev-elementu\">Stránky zaplaceny</span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Datum a čas začátku blokace:</span>
        <input type=\"text\" name=\"datum_blokace_begin\" value=\"%%datum_blokace_begin%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Peněžní hodnota penále [kč]:</span>
        <input type=\"text\" name=\"blokace_penale\" value=\"%%blokace_penale%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-select f-povinny f-obsah w-505\">
        <span class=\"nazev-elementu\">Časové rozhraní přičítání penále:</span>
%%blokace_typ_jednotka%%
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Přičítat penále každé X [časové rozhraní]:</span>
        <input type=\"text\" name=\"blokace_pocet_jednotka\" value=\"%%blokace_pocet_jednotka%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span><br />Hodnota určuje přičítání penále každé X hodiny, X dnů, X měsíců.</span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Tvar datumu v administraci:</span>
        <input type=\"text\" name=\"admin_tvar_datum\" value=\"%%admin_tvar_datum%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Expirace doby přihlášení v administraci:</span>
        <input type=\"text\" name=\"admin_expire\" value=\"%%admin_expire%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Expirace záloh databáze:</span>
        <input type=\"text\" name=\"set_expire_dataadmin\" value=\"%%set_expire_dataadmin%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Expirace záloh unikátních:</span>
        <input type=\"text\" name=\"set_expire_unikadmin\" value=\"%%set_expire_unikadmin%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Expirace přehledu přístupů do administrace:</span>
        <input type=\"text\" name=\"set_expire_logadmin\" value=\"%%set_expire_logadmin%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Expirace přehledu aktivity administrátorů:</span>
        <input type=\"text\" name=\"set_expire_actionlog\" value=\"%%set_expire_actionlog%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Expirace error logů:</span>
        <input type=\"text\" name=\"set_expire_erroadmin\" value=\"%%set_expire_erroadmin%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Název stránek:</span>
        <input type=\"text\" name=\"nazevwebu\" value=\"%%nazevwebu%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Adresa administrace:</span>
        <input type=\"text\" name=\"adresaadminu\" value=\"%%adresaadminu%%\" />
      </label>
      <span class=\"block m-t-30 m-b-10 f-f-web-pro f-s-19 u\">Podporované prohlížeče pro přístup do administrace:</span>
%%set_prohlizece%%
      <span class=\"block m-t-30 m-b-10 f-f-web-pro f-s-19 u\">Blokované IP adresy pro localhost:</span>
%%admin_ip_blok%%
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Uložit konfiguraci\" />
      </label>
    </fieldset>
  </form>
</div>\n",

/* - - - - - - - - - - /Konfigurace administrace - - - - - - - - - - */

/* - - - - - - - - - - Ovládání administrace - - - - - - - - - - */

                  "admin_control" => "
<div class=\"obal_funkce_control\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Ovládání administrace</h3>
  </div>
  <p class=\"ow-h\">
    <a href=\"%%1%%\" title=\"Opravdu chceš promazat error logy ?\" class=\"confirm clearerrlog block fl-l cl-b odkaz-1 no-u m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22\">Promazat error logy</a>
    <a href=\"%%2%%\" title=\"Opravdu chceš promazat error page ?\" class=\"confirm clearerrpag block fl-l cl-b odkaz-1 no-u m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22\">Promazat error page</a>
    <a href=\"%%3%%\" title=\"Opravdu chceš promazat web logy ?\" class=\"confirm clearweblog block fl-l cl-b odkaz-1 no-u m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22\">Promazat web logy</a>
    <a href=\"%%4%%\" title=\"Opravdu chceš promazat action logy ?\" class=\"confirm clearactlog block fl-l cl-b odkaz-1 no-u m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22\">Promazat action logy</a>
    <a href=\"%%5%%\" title=\"Opravdu chceš promazat session logy ?\" class=\"confirm clearseslog block fl-l cl-b odkaz-1 no-u m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22\">Promazat session logy</a>
    <a href=\"%%6%%\" title=\"Opravdu chceš promazat cache ?\" class=\"confirm clearcache block fl-l cl-b odkaz-1 no-u m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22\">Promazat cache</a>
    <a href=\"%%7%%\" title=\"Opravdu chceš regenerovat konfigurační javascripty ?\" class=\"confirm clkon block fl-l cl-b odkaz-1 no-u m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22\">Regenerovat konfigurační javascripty</a>
    <a href=\"%%8%%\" title=\"Změna přístupových údajů do databáze\" class=\"genpri block fl-l cl-b odkaz-1 no-u m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22\">Změna přístupových údajů do databáze</a>
  </p>
</div>\n",

                  "admin_control_genpri" => "
<div class=\"obal_funkce_control\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Změna přístupových údajů do databáze</h3>
  </div>
  <a href=\"%%6%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název databáze:</span>
        <input type=\"text\" name=\"mysql_dbname\" value=\"%%1%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Server:</span>
        <input type=\"text\" name=\"mysql_host\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Login:</span>
        <input type=\"text\" name=\"mysql_user\" value=\"%%3%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Heslo:</span>
        <input type=\"password\" name=\"mysql_pass\" value=\"%%4%%\" class=\"w-500\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Port:</span>
        <input type=\"text\" name=\"mysql_port\" value=\"%%5%%\" />
        <span class=\"popis-elementu\">(3306)</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Uložit přístupové údaje\" />
      </label>
    </fieldset>
  </form>
</div>\n",

/* - - - - - - - - - - /Ovládání administrace - - - - - - - - - - */


                  "admin_test" => "
<div class=\"obal_funkce_chmod\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Testy systemu</h3>
  </div>
    <a href=\"%%1%%\" title=\"Test regulárních výrazů\" class=\"test_rv tlacitko-8 m-r-12 fl-l odkaz-12\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Test regulárních výrazů</span>
    </a>

    <a href=\"%%2%%\" title=\"Generovani sitemaps\" class=\"sitemap tlacitko-8 m-r-12 fl-l odkaz-12\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Generovani sitemaps</span>
    </a>
%%3%%
</div>\n",
//dodelat!
                  "admin_test_rv" => "
<div class=\"obal_dynhtcs\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Test regulárních výrazů</h3>
  </div>
  <a href=\"%%4%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
        <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">Příklady</span></li>
      </ul>
      <label class=\"f-obsah m-b-0-i w-700\">
        <span class=\"nazev-elementu\">Pro e-mail:</span>
      </label>
<pre class=\"ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/</pre>
      <label class=\"f-obsah m-b-0-i w-700\">
        <span class=\"nazev-elementu\">Pro telefon:</span>
      </label>
<pre class=\"ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">/^(\+420)?[0-9]{9}$/</pre>
      <label class=\"f-obsah m-b-0-i w-700\">
        <span class=\"nazev-elementu\">Ostatní příklady:</span>
      </label>
<pre class=\"w-700 ws-pre-wrap ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">RewriteRule ^zmena-jazyka-na-([a-zA-Z\_]+)/?$ ?sub=changelang&amp;id=$1 [L]</pre>
<pre class=\"w-700 ws-pre-wrap ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">RewriteRule ^rss/([a-zA-Z-\_]+)/?$ ?action=rss&amp;sablona=$1 [L]</pre>
<pre class=\"w-700 ws-pre-wrap ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">RewriteRule ^galerie/([a-zA-Z-\_]+)/?$ ?action=galerie&amp;sekce=$1 [L]</pre>
<pre class=\"w-700 ws-pre-wrap ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">RewriteRule ^([a-zA-Z0-9-\_]+)/([0-9]+)?$ ?action=$1&amp;str=$2 [L]</pre>
<pre class=\"w-700 ws-pre-wrap ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">RewriteRule ^([a-zA-Z0-9-\_]+)/?$ ?action=$1 [L]</pre>
<pre class=\"w-700 ws-pre-wrap ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">RewriteRule ^([a-zA-Z0-9-\_]+)/serazeno-podle:([a-z\_]+)/pohled:([a-z\_]+)/strana:([0-9]+)/?$ ?action=$1&amp;sort=$2&amp;view=$3&amp;str=$4 [L]</pre>
<pre class=\"w-700 ws-pre-wrap ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">RewriteRule ^([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/?/?$ ?action=$1%%%%$2 [L]</pre>
<pre class=\"w-700 ws-pre-wrap ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">RewriteRule ^([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/?/?/?$ ?action=$1%%%%$2%%%%$3 [L]</pre>
<pre class=\"w-700 ws-pre-wrap ow-h cl-b f-s-12 m-b-15 p-t-2 p-r-2 p-b-2 p-l-2\">RewriteRule ^([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/?/?/?/?$ ?action=$1%%%%$2%%%%$3%%%%$4 [L]</pre>
      <p class=\"m-b-15 ow-h\">
        <a href=\"http://cz.php.net/manual/en/function.preg-match.php\" title=\"Dokumentace\" class=\"block fl-l odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Dokumentace</a>
      </p>
      <label class=\"f-textarea w-700\">
        <span class=\"nazev-elementu\">Vstupní text:</span>
        <textarea name=\"vstup\" rows=\"10\" cols=\"60\">%%1%%</textarea>
      </label>
      <label class=\"f-textarea w-700\">
        <span class=\"nazev-elementu\">Regulární výraz:</span>
        <textarea name=\"reg_exp\" rows=\"10\" cols=\"60\">%%2%%</textarea>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Potvrdit\" />
      </label>
%%3%%
    </fieldset>
  </form>
</div>\n",

                  "admin_sitemap" => "
<div class=\"obal_funkce_control\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Sitemapa pro web ...</h3>
  </div>
  <a href=\"%%backlink%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Url webu:</span>
        <input type=\"text\" name=\"url\" value=\"%%url%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Generovani\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_sitemapgen" => "
<div class=\"obal_funkce_control\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">doklikani site mapy</h3>
  </div>
  <a href=\"%%backlink%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Url webu:</span>
        <input type=\"text\" name=\"url\" value=\"%%url%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>

      %%row%%

      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"nějak zpracovat?!\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_sitemap_row" => "
                  <input type=\"checkbox\" checked=\"checked\" /> %%loc%%<br />
                  ",


/* - - - - - - - - - - Přístupová práva složek - - - - - - - - - - */

                  "admin_chmod" => "
<div class=\"obal_funkce_chmod\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Přístupová práva složek</h3>
  </div>
  <ul class=\"f-f-web-pro f-s-14\">
    <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\">
      <span class=\"fl-l w-170\">Složka</span>
      <span class=\"fl-l w-160 t-a-c\">Doporučený chmod</span>
      <span class=\"fl-l w-160 t-a-c\">Skutečný chmod</span>
      <span class=\"fl-l w-200 t-a-c\">Stav / Doporučení</span>
    </li>
  </ul>\n
%%1%%
</div>\n",

                  "admin_chmod_row" => "
<ul class=\"f-f-web-pro f-s-14\">
  <li class=\"polozka-1-%%5%% p-t-3 p-r-10 p-b-3 p-l-10 ow-h\">
    <span class=\"fl-l w-170\">%%1%%</span>
    <span class=\"fl-l w-160 t-a-c\">%%3%%</span>
    <span class=\"fl-l w-160 t-a-c\">%%2%%</span>
    <span class=\"fl-l w-200 t-a-c\">%%4%%</span>
  </li>
</ul>\n",

                  "admin_chmod_true" => "V pořádku",

                  "admin_chmod_false" => "Doporučuje se změnit chmod",

                  "admin_chmod_sude" => "sudy",

                  "admin_chmod_liche" => "lichy",

/* - - - - - - - - - - /Přístupová práva složek - - - - - - - - - - */

/* - - - - - - - - - - Oprávnění administrátorů - - - - - - - - - - */

                  "admin_permission" => "
<div class=\"obal_funkce_permit\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Oprávnění administrátorů</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat skupinu oprávnění\" class=\"addperm tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat skupinu oprávnění</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "admin_addeditperm_add" => "Přidat skupinu oprávnění",

                  "admin_addeditperm_edit" => "Upravit skupinu oprávnění",

                  "admin_addeditperm" => "
<div class=\"obal_funkce_permit\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%%</h3>
  </div>
  <a href=\"%%5%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název skupiny oprávnění:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Popis skupiny oprávnění:</span>
        <input type=\"text\" name=\"popis\" value=\"%%3%%\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"aktivni\"%%4%% />
        <span class=\"nazev-elementu\">Aktivní skupina oprávnění</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_permission_begin" => "
<script type=\"text/javascript\">
  function timedelay(millis)
  {
    var date = new Date();
    var curDate = null;
    do { curDate = new Date(); }
    while(curDate-date < millis);
  }
  function SetGroupPermit(id, adresa, stav, ret)
  {
    var rozdeleni = adresa.split('|_|');
    for (var i = 0; i < rozdeleni.length; i++)
    {
      SetPermit(id, rozdeleni[i], stav, ret);
      timedelay(500);
    }
  }
</script>",

                  "admin_vypis_permission_tvar_datum" => "d.m.Y / H:i:s",


                  "admin_vypis_permission_aktivni" => " barva-14",

                  "admin_vypis_permission" => "
<ul class=\"obal_funkce_error f-s-14 f-f-web-pro m-b-15 cl-b\">
  <li class=\"nadpis-6 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l f-s-16\"><a href=\"%%1%%\" class=\"view block no-u odkaz-14%%4%%\" title=\"%%2%%\">%%2%%</a></span><span class=\"block fl-r m-t-1 ow-h\"><a href=\"%%9%%\" class=\"editperm block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit skupinu\">Upravit skupinu</a><a href=\"%%10%%\" title=\"Opravdu chceš smazat skupinu oprávnění: &quot;%%2%%&quot; ?\" class=\"delperm confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat skupinu</a></span></li>
  <li class=\"polozka-4-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Popis skupiny:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-4-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Přidáno:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
  <li class=\"polozka-4-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Upraveno:</span><span class=\"fl-r barva-5\">%%7%%</span></li>
  <li class=\"polozka-4-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní skupina oprávnění:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%8%% class=\"block m-t-2\" /></span></li>
%%5%%
</ul>\n",

                  "admin_vypis_permission_neupraveno" => "Zatím nebyla skupina upravena",

                  "admin_vypis_permission_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořena skupina oprávnění</div>",

                  "admin_vypis_permission_end" => "<div class=\"infopermission\" id=\"status_drag\"></div>",

                  "ajax_update_permission" => "%%2%% oprávnění:<br />%%1%%",

                  "ajax_update_permission_true" => "Nastaveno",

                  "ajax_update_permission_false" => "Zrušeno",

                  "admin_generovani_permission_modul_aktivni" => " barva-7",

                  "admin_generovani_permission_modul" => "
  <li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><a href=\"%%1%%\" class=\"block no-u f-s-16 odkaz-10%%3%%\" title=\"%%2%%\">%%2%%</a></li>
%%4%%\n",

                  "admin_generovani_permission_sekce" => "
  <li class=\"nadpis-4 f-s-16 m-t-2 m-r-20 m-l-20 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\">%%1%%</span></li>
  <li class=\"polozka-3-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Všechno dostupné oprávnění</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" onclick=\"SetGroupPermit(%%2%%, '%%3%%', this.checked, '.infopermission');\"%%4%% class=\"setpermit block m-t-2 cur-poi\" /></span></li>
  <li class=\"polozka-3-sudy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Upravovací oprávnění</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" onclick=\"SetGroupPermit(%%2%%, '%%5%%', this.checked, '.infopermission');\"%%6%% class=\"setpermit block m-t-2 cur-poi\" /></span></li>
  <li class=\"polozka-3-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zobrazit v oprávnění</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" onclick=\"SetPermit(%%2%%, '%%7%%', this.checked, '.infopermission');\"%%8%% class=\"setpermit block m-t-2 cur-poi\" /></span></li>
  %%9%%\n",

                  "admin_generovani_permission_polozka" => "<li class=\"polozka-1-%%5%% m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%4%%</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" onclick=\"SetPermit(%%1%%, '%%2%%', this.checked, '.infopermission');\"%%3%% class=\"setpermit block m-t-2 cur-poi\" /></span></li>\n  ",

                  "admin_generovani_permission_polozka_liche" => "lichy",

                  "admin_generovani_permission_polozka_sude" => "sudy",

                  "ajax_update_permission_not_permit" => "Nemáte oprávnění",

                  "admin_vypis_select_permission_begin" => "<select name=\"permission\">\n",

                  "admin_vypis_select_permission" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vypis_select_permission_end" => "</select>\n",

                  "admin_vypis_select_permission_null" => "<span class=\"block nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořena skupina oprávnění</span>",

/* - - - - - - - - - - /Oprávnění administrátorů - - - - - - - - - - */

/* - - - - - - - - - - Přehled administrátorů - - - - - - - - - - */

                  "admin_user" => "
<div class=\"obal_funkce_usergui\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Přehled administrátorů</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat administrátora\" class=\"adduser tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat administrátora</span>
  </a>
  %%2%%
</div>\n",

                  "admin_addedituser_skryte" => "
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"superadmin\"%%1%% />
        <span class=\"nazev-elementu\">Možnost přidávat další administrátory</span>
        <span class=\"popis-elementu cl-b\">Tato možnost povoluje zobrazení oprávnění administrátorů v navigaci.</span>
      </label>",

                  "admin_addedituser_add" => "Přidat administrátora",

                  "admin_addedituser_edit" => "Upravit administrátora",

                  "admin_addedituser" => "
<div class=\"obal_funkce_usergui\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%%</h3>
  </div>
  <a href=\"%%7%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-select f-povinny w-505\">
        <span class=\"nazev-elementu\">Vyber skupinu oprávnění:</span>
%%2%%
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Login:</span>
        <input type=\"text\" name=\"login\" value=\"%%3%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Heslo:</span>
        <input type=\"password\" name=\"heslo\" class=\"w-500\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Jméno v administraci:</span>
        <input type=\"text\" name=\"jmeno\" value=\"%%4%%\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"aktivni\"%%6%% />
        <span class=\"nazev-elementu\">Aktivní administrátor</span>
      </label>
%%5%%
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
  </fieldset>
</form>
</div>\n",

                  "admin_vypis_admin_user_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_admin_user_neupraveno" => "Administrátor nebyl upraven",

                  "admin_vypis_admin_user" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15 cl-b\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%3%% (%%2%%)</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%8%%\" class=\"edituser block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit administrátora\">Upravit administrátora</a><a href=\"%%9%%\" title=\"Opravdu chceš smazat administrátora: &quot;%%3%%&quot; ?\" class=\"deluser confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat administrátora</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Skupina oprávnění:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Administrátor přidán:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Administrátor upraven:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní administrátor:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\"%%7%% disabled=\"disabled\" class=\"block m-t-2\" /></span></li>
</ul>\n",

                  "admin_vypis_admin_user_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro cl-b\">Není vytvořen administrátor</div>",

/* - - - - - - - - - - /Přehled administrátorů - - - - - - - - - - */

/* - - - - - - - - - - Přehled přístupů do administrace - - - - - - - - - - */

                  "admin_log" => "
<div class=\"obal_funkce_listlog\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Přehled přístupů do administrace</h3>
  </div>
  <a href=\"%%1%%\" title=\"Opravdu chceš promazat přehled přístupů do administrace ?\" class=\"clearlog confirm tlacitko-1 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Promazat přehled přístupů</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "vypis_log_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_log_acc_true" => " informace-true",

                  "admin_log_acc_false" => " informace-false",

                  "admin_vypis_log_pass" => " - <a href=\"#\" title=\"Heslo: %%1%%\" class=\"confirm odkaz-10 no-u\">Zobrazit heslo</a>",

                  "admin_vypis_log_row" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 l-h-24 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%2%%%%3%%</span><span class=\"block fl-r%%5%%\"><!-- --></span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%14%%\" class=\"addip block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Zabanovat toto IP\">Zabanovat toto IP</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Kdy:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">IP:</span><span class=\"fl-r barva-5\">%%7%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Operační systém:</span><span class=\"fl-r barva-5\">%%8%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Prohlížeč:</span><span class=\"fl-r barva-5\">%%9%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Kolikátý vstup z této IP:</span><span class=\"fl-r barva-5\">%%10%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l\"><a href=\"#\" onclick=\"GetZeme('%%7%%', 1, '#idip_%%1%%'); return false;\" title=\"Zjistit zemi původu\" class=\"odkaz-3 no-u\">Zjistit zemi původu</a>:</span><span class=\"fl-r barva-5\"><span id=\"idip_%%1%%\"></span></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l\"><a href=\"#\" onclick=\"GetHostName('%%7%%', '#idhost_%%1%%'); return false;\" title=\"Zjistit host name\" class=\"odkaz-3 no-u\">Zjistit host name</a>:</span><span class=\"fl-r barva-5\"><span id=\"idhost_%%1%%\"></span></span></li>
</ul>\n",

                  "admin_vypis_log_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Prázdný přehled přístupů do administrace</div>",

                  "admin_vypis_log" => "
<div class=\"m-b-15 f-s-16 f-f-web-pro\">
  %%1%%
</div>
%%2%%\n",

                  "admin_vypis_log_ip" => "<p class=\"nadpis-1 barva-1 f-s-14 ow-h m-b-1 p-t-3 p-r-10 p-b-3 p-l-10\"><span class=\"fl-l\">Vstup z IP: <span class=\"barva-7\">%%1%%</span></span><span class=\"fl-r\">%%2%%x</span></p>\n  ",



                  "admin_statlog" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\">
  $(function() {
      Highcharts.setOptions({
        lang: { months: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Záři', 'Říjen', 'Listopad', 'Prosinec'],
                weekdays: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota']
              }
      });
    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container0',
        defaultSeriesType: 'area',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        labels: {
          formatter: function() {
            return Highcharts.dateFormat('%e.%B', this.value);
          },
          align: 'left',
          rotation: 90,
          x: -3,
          y: 10,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        tickInterval: 24 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 12px; color: #a7a7a7;\">%A, %e. %B %Y<\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        area: {
          color: '#0077cc',
          fillOpacity: 0.1,
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        name: '',
        data: [%%3%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container1',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">IP: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        type: 'pie',
        name: '',
        data: [%%4%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container2',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Prohlížeč: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        type: 'pie',
        name: '',
        data: [%%5%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container3',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Operační systém: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        type: 'pie',
        name: '',
        data: [%%6%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container4',
        defaultSeriesType: 'column',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        labels: {
          formatter: function() {
            return Highcharts.dateFormat('%e.%B', this.value);
          },
          align: 'left',
          rotation: 90,
          x: -3,
          y: 10,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        tickInterval: 24 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 12px; color: #a7a7a7;\">%A, %e. %B %Y<\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Administrátor: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.series.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Součet sloupce: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.total+'<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        column: {
          stacking: 'normal'
        },
        series: {
          pointWidth: 47,
          borderRadius: 5
        }
      },
      credits: {
        enabled: false
      },
      series: [
%%7%%
      ]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container5',
        defaultSeriesType: 'column',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        labels: {
          formatter: function() {
            return Highcharts.dateFormat('%e.%B', this.value);
          },
          align: 'left',
          rotation: 90,
          x: -3,
          y: 10,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        tickInterval: 24 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 12px; color: #a7a7a7;\">%A, %e. %B %Y<\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Operační systém: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.series.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Součet sloupce: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.total+'<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        column: {
          stacking: 'normal'
        },
        series: {
          pointWidth: 47,
          borderRadius: 5
        }
      },
      credits: {
        enabled: false
      },
      series: [
%%8%%
      ]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container6',
        defaultSeriesType: 'column',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        labels: {
          formatter: function() {
            return Highcharts.dateFormat('%e.%B', this.value);
          },
          align: 'left',
          rotation: 90,
          x: -3,
          y: 10,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        tickInterval: 24 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 12px; color: #a7a7a7;\">%A, %e. %B %Y<\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Prohlížeč: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.series.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Součet sloupce: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.total+'<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        column: {
          stacking: 'normal'
        },
        series: {
          pointWidth: 47,
          borderRadius: 5
        }
      },
      credits: {
        enabled: false
      },
      series: [
%%9%%
      ]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container7',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Administrátor: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      //<![CDATA[
      series: [{
        type: 'pie',
        name: '',
        data: [%%10%%]
      }]
      //]]>
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container8',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Prohlížeč: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      //<![CDATA[
      series: [{
        type: 'pie',
        name: '',
        data: [%%11%%]
      }]
      //]]>
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container9',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Administrátor: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      //<![CDATA[
      series: [{
        type: 'pie',
        name: '',
        data: [%%12%%]
      }]
      //]]>
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container10',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Administrátor: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      //<![CDATA[
      series: [{
        type: 'pie',
        name: '',
        data: [%%13%%]
      }]
      //]]>
    });
  });
</script>
<div class=\"obal_funkce__statlog\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Statistiky přístupů do administrace</h3>
  </div>
  <div class=\"m-b-15 f-f-web-pro\">
    <p class=\"nadpis-1 barva-1 f-s-16 ow-h p-t-6 p-r-6 p-b-6 p-l-6\"><span class=\"fl-l\">Celkový počet vstupů ze všech IP:</span><span class=\"fl-r\">%%2%%x</span></p>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů do administrace</h3>
    <div id=\"container0\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z IP</h3>
    <div id=\"container1\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z prohlížečů</h3>
    <div id=\"container2\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z OS</h3>
    <div id=\"container3\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů administrátorů</h3>
    <div id=\"container4\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z OS za den</h3>
    <div id=\"container5\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z prohlížečů za den</h3>
    <div id=\"container6\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů administrátorů v kombinaci s IP</h3>
    <div id=\"container7\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z prohlížečů v kombinaci s OS</h3>
    <div id=\"container8\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů administrátorů v kombinaci s OS a prohlížečem</h3>
    <div id=\"container9\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů administrátorů v kombinaci s IP, OS a prohlížečem</h3>
    <div id=\"container10\" class=\"h-340\"></div>
  </div>
</div>\n",

                  "admin_statlog_pocet_login_ip" => "['%%1%% <br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">IP: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%%2%%<\/span><\/span>', %%3%%]",

                  "admin_statlog_pocet_os_brow" => "['%%2%% <br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Operační systém: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%%1%%<\/span><\/span>', %%3%%]",

                  "admin_statlog_pocet_login_os" => "['%%1%% <br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Operační systém: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%%2%%<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Prohlížeč: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%%3%%<\/span><\/span>', %%4%%]",

                  "admin_statlog_pocet_login_ip_os" => "['%%1%% <br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">IP: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%%2%%<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Operační systém: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%%3%%<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Prohlížeč: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%%4%%<\/span><\/span>', %%5%%]",

/* - - - - - - - - - - /Přehled přístupů do administrace - - - - - - - - - - */

/* - - - - - - - - - - BAN do administrace a na stránky - - - - - - - - - - */

                  "set_bantyp" => array("fullbanip" => "BAN IP na stránky",
                                        "banip" => "BAN IP na vstup do administrace",
                                        "banlog" => "BAN loginu na vstup do administrace",
                                        "banlogip" => "BAN IP a loginu na vstup do administrace",
                                        "banlogorip" => "BAN IP nebo loginu na vstup do administrace",
                                        ),

                  "admin_ban_typ_select_begin" => "<select name=\"typ\">\n",

                  "admin_ban_typ_select" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_ban_typ_select_end" => "</select>",

                  "admin_full_ban_info" => "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"GF design - Tvorba webových stránek a systémů (www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GF design\" />
    <meta name=\"keywords\" content=\"\" />
    <meta name=\"description\" content=\"Vaše IP adresa byla zabanována !\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    <title>Vaše IP adresa byla zabanována !</title>
  </head>
  <body>
    <div id=\"obal_layout\">
      <h1 style=\"text-align: center;\">Vaše IP adresa byla zabanována !</h1>
    </div>
  </body>
</html>",

                  "admin_ban" => "
<div class=\"obal_funkce_ipban\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">BAN do administrace a na stránky</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat BAN\" class=\"addip tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat BAN</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "admin_addeditip_add" => "Přidat BAN",

                  "admin_addeditip_edit" => "Upravit BAN",

                  "admin_addeditip" => "
<div class=\"obal_funkce_ipban\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%%</h3>
  </div>
  <a href=\"%%7%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Popis:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-select f-povinny w-505\">
        <span class=\"nazev-elementu\">Typ:</span>
%%3%%
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Login:</span>
        <input type=\"text\" name=\"login\" value=\"%%4%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">IP:</span>
        <input type=\"text\" name=\"ip\" value=\"%%5%%\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"aktivni\"%%6%% />
        <span class=\"nazev-elementu\">Aktivní BAN</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "vypis_ban_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_ban" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15 cl-b\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\">
  <span class=\"fl-l\">%%2%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%9%%\" class=\"editip block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit BAN\">Upravit BAN</a><a href=\"%%10%%\" title=\"Opravdu chceš smazat BAN: &quot;%%2%%&quot; ?\" class=\"delip confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat BAN</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Typ:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Login:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">IP:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum vytvoření:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Datum upraveni:</span><span class=\"fl-r barva-5\">%%7%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní BAN:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\" disabled=\"disabled\"%%8%% class=\"block m-t-2\" /></span></li>
</ul>\n",

                  "admin_vypis_ban_neupraveno" => "BAN nebyl upraven",

                  "admin_vypis_ban_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není nastaven žádný BAN</div>",

/* - - - - - - - - - - /BAN do administrace a na stránky - - - - - - - - - - */

/* - - - - - - - - - - Přehled aktivity administrátorů - - - - - - - - - - */

                  "admin_action_log" => "
<div class=\"obal_funkce_actlog obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
  <h3 class=\"nadpis-sekce upc f-s-30\">Přehled aktivity administrátorů</h3>
</div>\n",

                  "admin_action_log_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Prázdný přehled aktivity administrátorů</div>",

                  "admin_action_log_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_action_log_val_sep" => ", ",

                  "admin_action_log_akce" => array ("Funkce" => array("" => array("login" => "Přihlášení do administrace",
                                                                                  "logoff" => "Odhlášení z administrace",
                                                                                  "expirelogoff" => "Vypršela expirační doba přihlášení"),
                                                                     ),
                                                   ),

                  "admin_vypis_action_log" => "
  <li class=\"nadpis-4 f-s-16 m-t-2 m-r-20 m-l-20 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\">[%%1%%] - Akce:</span><span class=\"block fl-r\">%%5%%</span></li>
  <li class=\"polozka-3-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Hodnota:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
  <li class=\"polozka-3-sudy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">(Modul) - (ID) - (Adresa):</span><span class=\"fl-r barva-5\">(%%2%%) - (%%3%%) - (%%4%%)</span></li>
  <li class=\"polozka-3-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Operační systém:</span><span class=\"fl-r barva-5\">%%7%%</span></li>
  <li class=\"polozka-3-sudy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Prohlížeč:</span><span class=\"fl-r barva-5\">%%8%%</span></li>
  <li class=\"polozka-3-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">IP:</span><span class=\"fl-r barva-5\">%%9%%</span></li>
  <li class=\"polozka-3-sudy m-r-20 m-b-10 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Datum / čas:</span><span class=\"fl-r barva-5\">%%10%%</span></li>\n",

                  "admin_vypis_seznam_action_log_datum" => "d.m.Y / H:i:s",

                  "set_expire_actionlog" => "-14 day",

                  "admin_vypis_action_log_user" => "
  <li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\"><a href=\"%%1%%\" class=\"show block no-u odkaz-10%%5%%\" title=\"%%3%% (%%2%%)\">%%3%% (%%2%%)</a></span><span class=\"block fl-r\">Záznamů: <span class=\"u\">%%4%%</span></span></li>
%%6%%\n",

                  "admin_vypis_action_log_user_aktivni" => " barva-7",

                  "admin_vypis_seznam_action_log_aktivni" => " barva-14",

                  "admin_vypis_seznam_action_log" => "
<ul class=\"f-f-web-pro m-b-2 cl-b\">
  <li class=\"nadpis-6 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\"><a href=\"%%1%%\" class=\"block no-u odkaz-14%%3%%\" title=\"%%2%%\">%%2%%</a></span></li>
%%4%%
</ul>\n",

/* - - - - - - - - - - /Přehled aktivity administrátorů - - - - - - - - - - */

/* - - - - - - - - - - Výpis error logů - - - - - - - - - - */

                  "admin_vypis_error_log" => "
<div class=\"obal_funkce_error\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Výpis error logů</h3>
  </div>
  %%1%%
</div>\n",

                  "admin_vypis_error_log_odkaz" => "
<ul class=\"obal_funkce_error f-f-web-pro m-b-2 cl-b\">
  <li class=\"nadpis-6 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\"><a href=\"%%1%%\" class=\"view block no-u odkaz-14%%5%%\" title=\"%%2%%\">%%2%%</a></span><span class=\"block fl-r\">Počet chyb: <span class=\"u\">%%3%%</span></span></li>
  <li class=\"nadpis-2 f-s-16 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\">Datum / čas:</span><span class=\"block fl-r\">%%4%%</span></li>
%%6%%
</ul>\n",

                  "admin_vypis_error_log_aktivni" => " barva-14",

                  "admin_vypis_error_log_radek" => "
  <li class=\"nadpis-4 f-s-16 m-t-2 m-r-20 m-l-20 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l\">%%1%%</span></li>
  <li class=\"polozka-3-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Řádek:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-3-sudy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Metoda:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-3-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Typ chyby:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-3-sudy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Datum / čas:</span><span class=\"fl-r barva-5\">%%9%%</span></li>
  <li class=\"polozka-3-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">IP:</span><span class=\"fl-r barva-5\">%%6%%</span></li>
  <li class=\"polozka-3-sudy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Prohlížeč:</span><span class=\"fl-r barva-5\">%%10%%</span></li>
  <li class=\"polozka-3-lichy m-r-20 m-b-10 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Operační systém:</span><span class=\"fl-r barva-5\">%%11%%</span></li>\n",

                  "admin_vypis_error_log_radek_null" => "<div class=\"nadpis-2 f-s-16 m-r-20 m-l-20 p-t-10 p-b-10 t-a-c f-f-web-pro\">Bez chyby</div>",

                  "admin_vypis_error_log_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Prázdný výpis error logů</div>",

/* - - - - - - - - - - /Výpis error logů - - - - - - - - - - */

/* - - - - - - - - - - Statistiky - - - - - - - - - - */

                  "admin_web_log" => "
<div class=\"obal_funkce_userlog\">
  <div class=\"obal-nadpisy-sekce m-b-45 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Statistiky - Rozcestník</h3>
  </div>
  <div class=\"ow-h f-s-22 f-f-web-pro m-b-45\">
    <h3 class=\"nadpis-1 w-400 m-auto b\"><a href=\"%%1%%\" title=\"Statistiky za dnešní den\" class=\"block p-t-10 p-b-10 t-a-c no-u odkaz-19\">Statistiky za dnešní den</a></h3>
    <p class=\"w-400 m-auto m-t-5 l-h-22 f-s-14\">Zde naleznete statistiky stránek počítané za dnešní den.</p>
  </div>
  <div class=\"ow-h f-s-22 f-f-web-pro m-b-30\">
    <h3 class=\"nadpis-1 w-400 m-auto b\"><a href=\"%%2%%\" title=\"Celkové statistiky\" class=\"block p-t-10 p-b-10 t-a-c no-u odkaz-20\">Celkové statistiky</a></h3>
    <p class=\"w-400 m-auto m-t-5 l-h-22 f-s-14\">Zde naleznete statistiky stránek počítané od jejich spuštění.</p>
  </div>
</div>\n",

                  "admin_web_log_day_wait" => "
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Statistiky za dnešní den</h3>
  </div>
  <div class=\"nadpis-2 f-s-16 m-r-20 m-l-20 p-t-10 p-b-10 t-a-c f-f-web-pro\">Probíhá sběr dat</div>\n",

                  "admin_web_log_day" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\">
  $(function() {
      Highcharts.setOptions({
        lang: { months: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Záři', 'Říjen', 'Listopad', 'Prosinec'],
                weekdays: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota']
              }
      });
    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container0',
        defaultSeriesType: 'area',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
        zoomType: 'x'
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        maxZoom: 5 * 60 * 1000,
        labels: {
          y: 20,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
          },
        },
        //tickInterval: 2 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Čas: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%H:%M:%S<\/span><\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        area: {
          color: '#0077cc',
          fillOpacity: 0.1,
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        name: '',
        data: [%%3%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container1',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">IP: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        type: 'pie',
        name: '',
        data: [%%4%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container2',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Operační systém: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        type: 'pie',
        name: '',
        data: [%%5%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container3',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Prohlížeč: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        type: 'pie',
        name: '',
        data: [%%6%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container4',
        defaultSeriesType: 'scatter',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
        zoomType: 'x'
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        maxZoom: 5 * 60 * 1000,
        labels: {
          y: 20,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        //tickInterval: 2 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Čas: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%H:%M:%S<\/span><\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">IP: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.series.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        column: {
          stacking: 'normal'
        },
        series: {
          marker: {
            radius: 7,
            states: {
              hover: {
                radius: 10
              }
            }
          }
        }
      },
      credits: {
        enabled: false
      },
      series: [
%%9%%
      ]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container5',
        defaultSeriesType: 'scatter',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
        zoomType: 'x'
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        maxZoom: 5 * 60 * 1000,
        labels: {
          y: 20,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        //tickInterval: 2 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Čas: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%H:%M:%S<\/span><\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Operační systém: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.series.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        column: {
          stacking: 'normal'
        },
        series: {
          marker: {
            radius: 7,
            states: {
              hover: {
                radius: 10
              }
            }
          }
        }
      },
      credits: {
        enabled: false
      },
      series: [
%%7%%
      ]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container6',
        defaultSeriesType: 'scatter',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
        zoomType: 'x'
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        maxZoom: 5 * 60 * 1000,
        labels: {
          y: 20,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        //tickInterval: 2 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Čas: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">%H:%M:%S<\/span><\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Prohlížeč: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.series.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        column: {
          stacking: 'normal'
        },
        series: {
          marker: {
            radius: 7,
            states: {
              hover: {
                radius: 10
              }
            }
          }
        }
      },
      credits: {
        enabled: false
      },
      series: [
%%8%%
      ]
    });
  });
</script>
<div class=\"obal_funkce__usercurlog\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Statistiky za dnešní den</h3>
  </div>
  <div class=\"m-b-15 f-f-web-pro\">
    <p class=\"nadpis-1 barva-1 f-s-16 ow-h p-t-6 p-r-6 p-b-6 p-l-6\"><span class=\"fl-l\">Celkový počet vstupů za dnešní den:</span><span class=\"fl-r\">%%2%%x</span></p>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů na stránky za dnešní den</h3>
    <div id=\"container0\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z IP za dnešní den</h3>
    <div id=\"container1\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z OS za dnešní den</h3>
    <div id=\"container2\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z prohlížečů za dnešní den</h3>
    <div id=\"container3\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z IP na časové ose za dnešní den</h3>
    <div id=\"container4\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z OS na časové ose za dnešní den</h3>
    <div id=\"container5\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z prohlížečů na časové ose za dnešní den</h3>
    <div id=\"container6\" class=\"h-340\"></div>
  </div>
</div>\n",

                  "admin_web_log_all_wait" => "
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Celkové statistiky</h3>
  </div>
  <div class=\"nadpis-2 f-s-16 m-r-20 m-l-20 p-t-10 p-b-10 t-a-c f-f-web-pro\">Probíhá sběr dat</div>\n",

                  "admin_web_log_all" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\">
  $(function() {
      Highcharts.setOptions({
        lang: { months: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Záři', 'Říjen', 'Listopad', 'Prosinec'],
                weekdays: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota']
              }
      });
    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container0',
        defaultSeriesType: 'area',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
        zoomType: 'x'
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        maxZoom: 14 * 24 * 60 * 60 * 1000,
        labels: {
          formatter: function() {
            return Highcharts.dateFormat('%e.%B', this.value);
          },
          align: 'left',
          rotation: 90,
          x: -3,
          y: 10,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        //tickInterval: 24 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 12px; color: #a7a7a7;\">%A, %e. %B %Y<\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        area: {
          color: '#0077cc',
          fillOpacity: 0.1,
          marker: {
            radius: 2,
            states: {
              hover: {
                enabled: true,
                radius: 4
              }
            }
          },
          shadow: false,
          lineWidth: 1,
          states: {
            hover: {
            lineWidth: 1
            }
          }
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        name: '',
        data: [%%4%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container1',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">IP: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        type: 'pie',
        name: '',
        data: [%%5%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container2',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Operační systém: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        type: 'pie',
        name: '',
        data: [%%6%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container3',
        margin: [10, 0, 10, 0],
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return '<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Prohlížeč: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.point.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
        },
      },
      credits: {
        enabled: false
      },
      series: [{
        type: 'pie',
        name: '',
        data: [%%7%%]
      }]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container4',
        defaultSeriesType: 'scatter',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
        zoomType: 'x'
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        maxZoom: 5 * 60 * 1000,
        labels: {
          y: 20,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        //tickInterval: 2 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 12px; color: #a7a7a7;\">%A, %e. %B %Y, %H:%M:%S<\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">IP: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.series.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        column: {
          stacking: 'normal'
        },
        series: {
          marker: {
            radius: 7,
            states: {
              hover: {
                radius: 10
              }
            }
          }
        }
      },
      credits: {
        enabled: false
      },
      series: [
%%10%%
      ]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container5',
        defaultSeriesType: 'scatter',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
        zoomType: 'x'
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        maxZoom: 5 * 60 * 1000,
        labels: {
          y: 20,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        //tickInterval: 2 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 12px; color: #a7a7a7;\">%A, %e. %B %Y, %H:%M:%S<\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Operační systém: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.series.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        column: {
          stacking: 'normal'
        },
        series: {
          marker: {
            radius: 7,
            states: {
              hover: {
                radius: 10
              }
            }
          }
        }
      },
      credits: {
        enabled: false
      },
      series: [
%%8%%
      ]
    });

    chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container6',
        defaultSeriesType: 'scatter',
        ignoreHiddenSeries: false,
        margin: [30, 10, 90, 60],
        zoomType: 'x'
      },
      title: {
        text: '',
        style: {
          display: 'none'
        },
      },
      legend: {
        enabled: false
      },
      subtitle: {
        text: '',
        style: {
          display: 'none'
        },
      },
      xAxis: {
        title: {
          text: '',
          style: {
            display: 'none'
          },
        },
        type: 'datetime',
        maxZoom: 5 * 60 * 1000,
        labels: {
          y: 20,
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c'
          },
        },
        //tickInterval: 2 * 60 * 60 * 1000,
      },
      yAxis: {
        title: {
          text: 'Počet přístupů',
          style: {
            fontFamily: 'Verdana',
            fontSize: '10px',
            color: '#7d7c7c',
            fontWeight: 'normal'
          },
        },
        allowDecimals: false,
      },
      //<![CDATA[
      tooltip: {
        formatter: function() {
          return ''+Highcharts.dateFormat('<span style=\"font-family: myriad-web-pro; font-size: 12px; color: #a7a7a7;\">%A, %e. %B %Y, %H:%M:%S<\/span><br/>', this.x)+'<span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Prohlížeč: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.series.name+'<\/span><\/span><br/><span style=\"font-family: myriad-web-pro; font-size: 14px; color: #7c7c7c;\">Přístupy: <span style=\"font-family: myriad-web-pro; font-size: 14px; color: #000;\">'+this.y+'x<\/span><\/span>';
        }
      },
      //]]>
      plotOptions: {
        column: {
          stacking: 'normal'
        },
        series: {
          marker: {
            radius: 7,
            states: {
              hover: {
                radius: 10
              }
            }
          }
        }
      },
      credits: {
        enabled: false
      },
      series: [
%%9%%
      ]
    });
  });
</script>
<div class=\"obal_funkce__useralllog\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Celkové statistiky</h3>
  </div>
  <div class=\"m-b-1 f-f-web-pro\">
    <p class=\"nadpis-1 barva-1 f-s-16 ow-h p-t-6 p-r-6 p-b-6 p-l-6\"><span class=\"fl-l\">Stránky beží:</span><span class=\"fl-r\">%%2%%</span></p>
  </div>
  <div class=\"m-b-15 f-f-web-pro\">
    <p class=\"nadpis-1 barva-1 f-s-16 ow-h p-t-6 p-r-6 p-b-6 p-l-6\"><span class=\"fl-l\">Celkový počet přístupů od spuštění stránek:</span><span class=\"fl-r\">%%3%%x</span></p>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů od spuštění stránek na časové ose</h3>
    <div id=\"container0\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z IP od spuštění stránek</h3>
    <div id=\"container1\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z OS od spuštění stránek</h3>
    <div id=\"container2\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z prohlížečů od spuštění stránek</h3>
    <div id=\"container3\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z IP od spuštění stránek na časové ose</h3>
    <div id=\"container4\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z OS od spuštění stránek na časové ose</h3>
    <div id=\"container5\" class=\"h-340\"></div>
  </div>
  <div class=\"ow-h m-b-5\">
    <h3 class=\"nadpis-1 p-t-10 p-r-10 p-b-10 p-l-10 f-s-22 f-f-web-pro b\">Celkový počet přístupů z prohlížečů od spuštění stránek na časové ose</h3>
    <div id=\"container6\" class=\"h-340\"></div>
  </div>
</div>\n",

/* - - - - - - - - - - /Statistiky - - - - - - - - - - */

/* - - - - - - - - - - Help centrum - - - - - - - - - - */

                  "admin_help_center" => "
<div class=\"obal_funkce_userlog\">
  <div class=\"obal-nadpisy-sekce m-b-45 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Help centrum - Rozcestník</h3>
  </div>
  <div class=\"ow-h f-s-22 f-f-web-pro m-b-45\">
    <h3 class=\"nadpis-1 w-400 m-auto b\"><a href=\"%%1%%\" title=\"Reporty (hlášení chyb)\" class=\"block p-t-10 p-b-10 t-a-c no-u odkaz-19\">Reporty (hlášení chyb)</a></h3>
    <p class=\"w-400 m-auto m-t-5 l-h-22 f-s-14\">%%2%%</p>
  </div>
  <div class=\"ow-h f-s-22 f-f-web-pro m-b-30\">
    <h3 class=\"nadpis-1 w-400 m-auto b\"><a href=\"%%3%%\" title=\"FAQ (Otázky a odpovědi)\" class=\"block p-t-10 p-b-10 t-a-c no-u odkaz-20\">FAQ (Otázky a odpovědi)</a></h3>
    <p class=\"w-400 m-auto m-t-5 l-h-22 f-s-14\">%%4%%</p>
  </div>
</div>\n",

/* - - - - - - - - - - /Help centrum - - - - - - - - - - */

/* - - - - - - - - - - Reporty (hlášení chyb) - - - - - - - - - - */

                  "admin_report" => "
<div class=\"obal_funkce__report\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Reporty (hlášení chyb)</h3>
    <h4 class=\"pod-nadpis-sekce f-s-14 l-h-20 f-f-web-pro\">V případě, že byste objevily chybu v našem systému, tak nám o ní můžete říct prostřednictvím tohoto formuláře.</h4>
    <h4 class=\"pod-nadpis-sekce f-s-14 l-h-20 f-f-web-pro\">Tento formulář můžete ovšem využít i v případě, že máte k systému dotaz / připomínku / nápad, apod.</h4>
  </div>
%%1%%
</div>\n",

                  "admin_add_report" => "
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">E-mail:</span>
        <input type=\"text\" name=\"email\" value=\"@\" />
        <span class=\"popis-elementu\">E-mail vyplňte jen v případě, pokud chcete, aby Vám byla zaslána odpověď.</span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Předmět zprávy:</span>
        <input type=\"text\" name=\"predmet\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-textarea f-povinny w-500\">
        <span class=\"nazev-elementu\">Zpráva:</span>
        <textarea name=\"message\" rows=\"20\" cols=\"60\"></textarea>
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Odeslat formulář\" />
      </label>
    </fieldset>
  </form>",

                  "admin_report_email" => "help@gfdesign.cz",

                  "admin_report_predmet" => "Report ze stránek: %%1%%, předmět reportu: %%2%%",

                  "admin_report_message" => "
Byl nahlášen report ze stránek: <strong>%%1%%</strong>
<br /><br />
<a href=\"%%2%%\" title=\"Odkaz na report\">Odkaz na report</a>
<br /><br /><br />
Zpráva: <strong>%%3%%</strong>
<br /><br />
Datum / čas zaslání reportu: <strong>%%4%%</strong><br />
IP administrátora: <strong>%%5%%</strong><br />
Hostitel administrátora: <strong>%%6%%</strong><br />
Operační systém administrátora: <strong>%%7%%</strong><br />
Prohlížeč administrátora: <strong>%%8%%</strong>
<br /><br />\n",

                  "admin_report_header" => "Content-type: text/html; charset=UTF-8\nFrom: %%2%%",

                  "admin_report_tvar_datum" => "d.m.Y / H:i:s",

/* - - - - - - - - - - /Reporty (hlášení chyb) - - - - - - - - - - */

/* - - - - - - - - - - FAQ (Otázky a odpovědi) - - - - - - - - - - */

                  "admin_faq_skupina_aktivni" => " barva-14",

                  "admin_faq_skupina" => "
<li class=\"nadpis-6 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block f-s-16\"><a href=\"%%1%%\" class=\"block no-u odkaz-14%%3%%\" title=\"%%2%%\">%%2%%</a></span></li>
%%4%%\n",

                  "admin_faq_radek" => "
  <li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"block fl-l f-s-16\">%%1%%</span></li>
  <li class=\"polozka-1-lichy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Otázka: <span class=\"barva-5\">%%2%%</span></span></li>
  <li class=\"polozka-1-sudy m-r-20 m-l-20 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Odpověď: <span class=\"barva-5\">%%3%%</span></span></li>\n",

                  "admin_faq_radek_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 p-t-10 p-b-10 t-a-c f-f-web-pro\">V této skupině zatím není FAQ</div>",

                  "admin_faq_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořen žádný FAQ</div>",

                  "admin_faq" => "
<div class=\"obal_funkce__faq\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">FAQ (Otázky a odpovědi)</h3>
  </div>
  <ul class=\"f-s-14 f-f-web-pro cl-b\">
    %%1%%
  </ul>
</div>\n",

/* - - - - - - - - - - /FAQ (Otázky a odpovědi) - - - - - - - - - - */

                  );

  return $result;
?>
