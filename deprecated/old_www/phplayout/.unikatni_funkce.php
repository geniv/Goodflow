<?php

  $result = array("admin_menu" => array(array("main_href" => "",
                                              "odkaz" => "Úvodní strana",
                                              "title" => "Úvodní strana",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%1%%",
                                              "odkaz" => "Aktualizace modulů",
                                              "title" => "Aktualizace modulů",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),

                                        array("main_href" => "%%2%%",
                                              "odkaz" => "Zálohovat databázi",
                                              "title" => "Zálohovat databázi",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => " onclick=\"return confirm('Chcete zálohovat všechny databáze ?\\n(Po zálohování se databáze nabídnou ke stažení a zároveň se uloží na serveru)');\"",
                                              "zobrazit" => false),

                                        array("main_href" => "%%3%%",
                                              "odkaz" => "Úvodní strana",
                                              "title" => "Úvodní strana",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "onclick=\"return confirm('Tato sekce může způsobit chybu !');\"",
                                              "zobrazit" => false),

                                        array("main_href" => "%%4%%",
                                              "odkaz" => "Aktualizace modulů",
                                              "title" => "Aktualizace modulů",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "onclick=\"return confirm('Tato sekce může způsobit chybu !');\"",
                                              "zobrazit" => false),

                                        array("main_href" => "%%5%%",
                                              "odkaz" => "Výpis error logů",
                                              "title" => "Výpis error logů",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "admin_nacitani_css" => "<link rel=\"stylesheet\" type=\"text/css\" href=\"%%1%%%%2%%\" media=\"screen\" />\n      ",

                  "tvar_admin_menu_skryte" => "          <li class=\"debug_mod\">
            <a href=\"%%1%%\" title=\"%%2%%\"%%4%%%%5%%>
              %%2%%
            </a>
          </li>\n",

                  "admin_prepinani_sekce" => array( "default-use-controls-admin" => "true",
                                                    "dyngall-use-controls-admin" => "true",
                                                    "datstor-use-controls-admin" => "false",
                                                    "default-number-position-admin" => "caption",
                                                    "datstor-number-position-admin" => " "
                                                  ),

                  "set_prohlizece" => array("DetekceFirefoxu",
                                            "DetekceWebkitu",
                                            //"DetekceLinuxu",
                                            //"DetekceOpery",
                                            ),

                  "admin_tvar_datum" => "d.m.Y / H:i:s",

                  "admin_menu_prvni" => "prvni",

                  "admin_menu_posledni" => "posledni",

                  "admin_menu_ente_def_array" => array(1, 2, 5),

                  "admin_menu_ente_def" => "aktivni",

                  "admin_menu_ente_od" => 0,

                  "admin_menu_ente_po" => 2,

                  "admin_menu_ente" => "ente",

                  "tvar_admin_menu" => "          <li>
            <a href=\"%%1%%\" title=\"%%2%%\"%%4%%%%5%%>
              %%6%%%%2%%%%7%%
            </a>
          </li>\n",

                  "tvar_admin_logoff" => "          <li>
            <a href=\"?%%1%%=logoff\" title=\"Odhlásit se\" class=\"odhlasit_se_menu\" onclick=\"return confirm('Opravdu se chcete odhlásit ?');\">
              Odhlásit se
            </a>
          </li>
          <li>
            <a href=\"./\" title=\"Přejít na stránky bez odhlášení\" class=\"odhlasit_se_menu\">
              Přejít na stránky bez odhlášení
            </a>
          </li>\n",

                  "uvod_admin_text" => "
<h3>Vítejte v administraci webu %%1%%</h3>
%%2%%
<h3>Výpis všech záloh databáze</h3>
%%3%%\n",

                  "info_admin_uvod_text" => "
<dl>
  <dt>Počet modulů:</dt>
    <dd>%%1%%</dd>
  <dt>Počet databází:</dt>
    <dd>%%2%%</dd>
  <dt>Velikost všech modulů:</dt>
    <dd>%%3%%</dd>
  <dt>Velikost všech databází:</dt>
    <dd>%%4%%</dd>
  <dt>Velikost celého webu:</dt>
    <dd>%%6%%</dd>
  <dt>Velikost stylů:</dt>
    <dd>%%7%%</dd>
  <dt>Velikost skriptů:</dt>
    <dd>%%8%%</dd>
  <dt>Velikost obrázků:</dt>
    <dd>%%9%%</dd>
  <dt>Velikost záloh:</dt>
    <dd>%%5%%</dd>
  <dt>Velikost sekcí:</dt>
    <dd>%%10%%</dd>
  <dt>Počet chyb za dnešek:</dt>
    <dd><a href=\"%%11%%\" title=\"Počet chyb za dnešek: %%12%%\">%%12%%</a></dd>
</dl>\n",

                  "aktualizace_notexists" => "<span class=\"vystraha\"><!-- --></span><span class=\"tooltip\"><br />Tento modul zde není nahrán</span>",

                  "aktualizace_aktualni_hlaska" => "<span class=\"aktualni\"><!-- --></span><span class=\"tooltip\"><br />Aktuální verze</span>",

                  "aktualizace_aktualni_datum_hlaska" => "<span class=\"aktualni\"><!-- --></span><span class=\"tooltip\"><br />Aktuální verze<br />Velikost je větší na depozitu</span><a href=\"%%2%%\" title=\"Nahrát modul na tento web\" class=\"nahrat_modul\"><!-- --></a><span class=\"tooltip\"><br />Nahrát modul na tento web</span><a href=\"%%1%%\" title=\"Stáhnout modul z depozitu\" class=\"stahnout_modul\"><!-- --></a><span class=\"tooltip\"><br />Stáhnout modul z depozitu</span>",

                  "aktualizace_aktualni_novejsi_hlaska" => "<span class=\"aktualni\"><!-- --></span><span class=\"tooltip\"><br />Aktuální verze</span><span class=\"aktualni_novejsi\"><!-- --></span><span class=\"tooltip\"><br />Datum je novější na tomto webu</span>",

                  "aktualizace_novejsi_hlaska" => "<span class=\"aktualni\"><!-- --></span><span class=\"tooltip\"><br />Aktuální verze</span><span class=\"aktualni_novejsi\"><!-- --></span><span class=\"tooltip\"><br />Datum je novější na tomto webu<br />Velikost je větší na tomto webu</span>",

                  "aktualizace_aktualni_depozit_hlaska" => "<span class=\"aktualni\"><!-- --></span><span class=\"tooltip\"><br />Aktuální verze</span><span class=\"aktualni_novejsi\"><!-- --></span><span class=\"tooltip\"><br />Datum je novější na depozitu</span>",

                  "aktualizace_novejsi_depozit_hlaska" => "<span class=\"neaktualni\"><!-- --></span><span class=\"tooltip\">Neaktuální verze<br />Datum je novější na depozitu<br />Velikost je větší na depozitu</span><a href=\"%%2%%\" title=\"Nahrát modul na tento web\" class=\"nahrat_modul\"><!-- --></a><span class=\"tooltip\"><br />Nahrát modul na tento web</span><a href=\"%%1%%\" title=\"Stáhnout modul z depozitu\" class=\"stahnout_modul\"><!-- --></a><span class=\"tooltip\"><br />Stáhnout modul z depozitu</span>",

                  "aktualizace_null_soubor" => "<span class=\"vystraha\"><!-- --></span><span class=\"tooltip\"><br />Tento modul není nahrán na depozitu</span>",

                  "aktualizace_admin_vypis" => "
<ul class=\"aktualizace_modulu\">
  <li class=\"modul\">%%1%%</li>
  <li class=\"tooltip\">Cesta:<br />%%2%%<br />Název:<br />%%3%%</li>
  <li class=\"datum\">%%4%%</li>
  <li class=\"velikost\">%%5%%</li>
  <li class=\"datum datum_depozit\">%%6%%</li>
  <li class=\"velikost velikost_depozit\">%%7%%</li>
  <li class=\"stav\">%%8%%</li>
</ul>\n",

                  "upload_admin_form" => "
<form method=\"post\" class=\"aktualizace_modulu\" enctype=\"multipart/form-data\" onsubmit=\"return confirm('Opravdu chceš aktualizovat modul: &quot;%%1%%&quot; ?');\">
  <fieldset>
    <label>
      <span>Vlož cestu k modulu:</span>
      <input type=\"file\" name=\"modul\" />
    </label>
    <label class=\"submit\">
      <input type=\"submit\" name=\"tlacitko\" value=\"Aktualizovat modul\" />
    </label>
  </fieldset>
</form>\n",

                  "aktualizace_datum" => "
<script type=\"text/javascript\" src=\"script/jquery/jquery-132-yui.js\"></script>
<script type=\"text/javascript\" src=\"script/jquery/toolstooltip-102-yui.js\"></script>
<script type=\"text/javascript\" src=\"script/jquery/jquery.tooltip.admin.js\"></script>
<h3>Aktualizace zkontrolovány: %%1%%</h3>
<ul class=\"aktualizace_modulu aktualizace_modulu_zahlavi\">
  <li class=\"modul\">Modul</li>
  <li class=\"tooltip\">Cesta<br />Název</li>
  <li class=\"datum\">Datum zde</li>
  <li class=\"velikost\">Velikost zde</li>
  <li class=\"datum datum_depozit\">Datum depozit</li>
  <li class=\"velikost velikost_depozit\">Velikost depozit</li>
  <li class=\"stav\">Stav</li>
  <li class=\"tooltip\"><br />Stav</li>
</ul>\n",

                  "aktualizace_root" => "Kořen (./)",

                  "upload_admin_finish" => "
<div class=\"central_absolutni central_info\">
  <p>
    Modul: \"%%1%%\" byl aktualizován.
  </p>
  <p class=\"odkaz_pokracovat\">
    <a href=\"javascript:location.reload();\">Pokračujte obnovením stránky</a>
  </p>
</div>\n",

                  "vypis_zaloha_null" => "<br /><br /><strong>Složka záloh je prázdná</strong>",

                  "vypis_zaloha_hlavicka" => "
<ul class=\"uvod_ul uvod_ul_prvni\">
  <li class=\"nazev_databaze\">Název databáze</li>
  <li class=\"datum_cas\">Datum / Čas</li>
  <li class=\"velikost\">Velikost</li>
  <li class=\"smazat\">Smazat</li>
</ul>\n",

                  "vypis_zaloha_prvni" => " uvod_ul_prvni",

                  "vypis_zaloha_posledni" => " uvod_ul_posledni",

                  "vypis_zaloha_ente_def_array" => array(1, 2, 5),

                  "vypis_zaloha_ente_def" => "aktivni",

                  "vypis_zaloha_ente_od" => 0,

                  "vypis_zaloha_ente_po" => 2,

                  "vypis_zaloha_ente" => "ente",

                  "vypis_zaloha_telicko" => "
<ul class=\"uvod_ul%%7%%\">
  <li class=\"nazev_databaze\"><a href=\"%%2%%\" title=\"%%1%%\">%%1%%</a></li>
  <li class=\"datum_cas\">%%3%%</li>
  <li class=\"velikost\">%%4%%</li>
  <li class=\"smazat\"><a href=\"%%5%%\" onclick=\"return confirm('Opravdu chceš smazat zálohu: &quot;%%1%%&quot; ?');\" title=\"Smazat\">Smazat</a></li>
</ul>\n",

                  "vypis_zaloha_del" => "
<div class=\"central_absolutni central_info\">
  <p>
    Soubor: \"%%1%%\" byl automaticky smazán !
  </p>
  <p class=\"odkaz_pokracovat\">
    <a href=\"javascript:location.reload();\">Pokračujte obnovením stránky</a>
  </p>
</div>\n",

                  "vypis_zaloha_notexists" => "
<div class=\"central_absolutni central_warning\">
  <p>
    Složka \"%%1%%\" neexistuje. Musí se vytvořit záloha databáze, nebo samotná složka.
  </p>
  <p class=\"odkaz_pokracovat\">
    <a href=\"javascript:location.reload();\">Pokračujte obnovením stránky</a>
  </p>
</div>\n",

                  "zaloha_smazano_true" => "
<div class=\"central_absolutni central_info\">
  <p>
    Soubor: \"%%1%%\" byl smazán !
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "zaloha_smazano_false" => "
<div class=\"central_absolutni central_warning\">
  <p>
    Nastala chyba, soubor \"%%1%%\" nebyl smazán !
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "zaloha_dir_notexists" => "
<div class=\"central_absolutni central_warning\">
  <p>
    Cesta k souboru \"%%1%%\" neexistuje !
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_vypis_error_log_begin" => "
          <script type=\"text/javascript\" src=\"%%2%%/jquery-1.3.2.min.js\"></script>
          <script type=\"text/javascript\">
function GetZeme(ip, tvar, out_id)
{
  $.post(\"%%1%%ajax_funkce.php\",
        \"action=getzeme&ip=\"+ip+\"&tvar=\"+tvar,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

function GetHostName(ip, out_id)
{
  $.post(\"%%1%%ajax_funkce.php\",
        \"action=gethostname&ip=\"+ip,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}
          </script>
                  ",

                  "admin_vypis_error_log_odkaz" => "<h3><a href=\"%%1%%\">%%2%%</a> - Počet chyb: <strong>%%3%%</strong> - Změněno: <strong>%%4%%</strong></h3>
                  ",

                  "admin_vypis_error_log_radek" => "
<h3>Chyba: %%1%%</h3>
<dl>
  <dt>Řádek:</dt>
    <dd>%%2%%</dd>
  <dt>Metoda:</dt>
    <dd>%%3%%</dd>
  <dt>Kritická:</dt>
    <dd>%%4%%<!-- --></dd>
  <dt>Čas:</dt>
    <dd>%%9%%</dd>
  <dt>IP:</dt>
    <dd>%%6%%</dd>
  <dt>Host:</dt>
    <dd><a href=\"#\" onclick=\"GetHostName('%%6%%', 'idhost_%%8%%'); return false;\">host name</a><div id=\"idhost_%%8%%\"></div></dd>
  <dt>Browser:</dt>
    <dd>%%10%%</dd>
  <dt>OS:</dt>
    <dd>%%11%%</dd>
</dl>\n",

                  "admin_vypis_error_log_radek_null" => "<h3>Bez chyby</h3>",

                  "admin_vypis_error_log" => "%%1%%%%2%%",

                  "text_cas_aktualizace" => "Naposledy aktualizováno v: <em>%%1%%</em>, při neaktivitě budeš automaticky odhlášen v: <em>%%5%%</em>, nyní je nastaveno automatické odhlášení na: <em>%%2%%</em><span>h</span>:<em>%%3%%</em><span>m</span>:<em>%%4%%</em><span>s</span>",

                  "text_odkaz_zpet" => "\n  <p class=\"odkaz_chyby\">\n   <a href=\"javascript:history.back(-%%1%%);\">Zkuste se vrátit o úroveň zpět</a>\n   <span>nebo</span>\n   <a href=\"javascript:location.reload();\">zkuste obnovit stránku</a>\n  </p>",

                  "text_chyba_begin" => "<div id=\"centralni_chyba\">",

                  "text_chyba" => "\n  <p class=\"nazev_chyby\">
    Nastala tato chyba:
  </p>
  <p class=\"vypis_chyby\">
    <strong>%%1%%, z řádku: %%2%%</strong>
  </p>
  <p class=\"dodatek_chyby\">%%3%%</p>",

                  "text_chyba_end" => "%%1%%\n</div>",

                  "error_nacteni_tridy" => "POZOR! Nepodařilo se najít třídu s názvem: \"%%1%%\" !",

                  "error_nacteni_tridy_funkce" => "POZOR! U třídy: \"%%1%%\" se nepodařilo načíst funkci: \"%%2%%\" !",

                  "error_nacteni_tridy_class" => "POZOR! Nepodařilo se najít třídu o indexu: \"%%1%%\" !",

                  "error_main_init_construct_class" => "POZOR! Z třídy: \"%%1%%\", metoda konstruktoru neexistuje !",

                  "error_main_init_exist_class" => "POZOR! Třída: \"%%1%%\" neexistuje !",

                  "error_main_init_not_exist" => "POZOR! Třída: \"%%1%%\" nemá svoje zastoupení v modulech !",

                  "error_old_php_version" => "máte příliš starou verzi php: (PHP%%1%%), potřebujete minimálně verzi PHP5 !",

                  "error_update" => "Aktualizace jsou vypnuty !",

                  "error_update_upload_error" => "Nastala chyba: <strong>%%1%%</strong> !",

                  "error_update_suffix" => "Jiná koncovka !",

                  "error_update_file_not_exist" => "Soubor neexistuje !",

                  "error_update_hack" => "Nepřípustné soubory !",

                  "error_update_another_file" => "Nenahráváte kompatibilní soubor !",

                  "error_update_empty_file" => "nebyl vybrán žádný soubor !",

                  "error_gen_title" => "Modul title z třídy: \"%%1%%\" se nepodařilo načíst, aktualizujte jej prosím !",

                  "error_gen_menu" => "Modul menu z třídy: \"%%1%%\" se nepodařilo načíst, aktualizujte jej prosím !",

                  "error_gen_obsah" => "Modul obsahu z třídy: \"%%1%%\" se nepodařilo načíst, aktualizujte jej prosím !",

                  "error_get_url" => "Chyba připojení k portu 80, číslo: %%1%%, důvod: %%2%% !",

                  "set_jednotky" => array("bajtů", "kB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"),

                  "text_error_page" => array (array("kod" => 400,
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
                                                    "popis" => "Požadovaná služba není momentálně k dispozici."),
                                                    ),

                  "set_zaplaceno" => true,

                  "datum_blokace_begin" => "29.09.2009 16:35:00",

                  "tvar_datum_blokace" => "d.m.Y, H:i:s",

                  "blokace_stranky_true" => "Stránky jsou blokovány od %%1%%",

                  "blokace_stranky_false" => "<strong>Stránky nebyly zatím zaplaceny. Nyní budou aktivní do: %%1%%, ",

                  "blokace_penale" => 0, //kč za jednotku

                  "blokace_typ_jednotka" => "den", //hodina/"den"/mesic

                  "blokace_pocet_jednotka" => 1,  //na typ jednotky, každou X-tou jednotku

                  "blokace_msg" => "blok_webu_dni_s_datem_zapisu::%%1%%",

                  "blokace_info_true" => "Stránky jsou zablokovány z důvodu nezaplacení již %%1%% %%2%%. Penále za prodlení dohodnuté částky činí <em>%%3%%,- Kč</em>",

                  "blokace_info_false" => "stránky budou funkční ještě %%1%% %%2%%</strong><br /><br />",

                  "vysloveni_dne" => array ("dnů",
                                            "den",
                                            "dny",
                                            "dní"),

                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
