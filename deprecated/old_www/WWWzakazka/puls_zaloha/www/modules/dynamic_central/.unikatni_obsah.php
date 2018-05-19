<?php

/*
 * za = dosazuje id $sablona
 * admin_obsah_sablony
 * admin_obsah_sablony_add
 *
 * admin_addeditobsah
 * admin_addeditobsah_add
 * admin_addeditobsah_edit
 * admin_addeditobsah_null
 *
 * admin_addeditobsah_hidden_jazyk
 * admin_addeditobsah_hidden_menu
 * admin_addeditobsah_hidden_archiv
 * admin_addeditobsah_hidden_aktivni
 *
 * admin_addeditobsah_checkbox
 * admin_addeditobsah_checkgroup_row
 * admin_addeditobsah_checkgroup
 * admin_addeditobsah_radio
 * admin_addeditobsah_select_row
 * admin_addeditobsah_select
 * admin_addeditobsah_conectmodule
 * admin_addeditobsah_header
 * admin_addeditobsah_specheader
 * admin_addeditobsah_minitext
 * admin_addeditobsah_fulltext
 * admin_addeditobsah_wymeditor
 * admin_addeditobsah_tinymce
 * admin_addeditobsah_minitextlite
 * admin_addeditobsah_fulltextlite
 * admin_addeditobsah_wymeditorlite
 * admin_addeditobsah_datum
 * admin_addeditobsah_cas
 * admin_addeditobsah_datumcas
 * admin_addeditobsah_hiddentext
 * admin_addeditobsah_automazani_row
 * admin_addeditobsah_automazani
 * admin_addeditobsah_foto_enable
 * admin_addeditobsah_foto_disable
 * admin_addeditobsah_foto
 * admin_addeditobsah_onefoto_enable
 * admin_addeditobsah_onefoto
 * admin_addeditobsah_seriefoto_enable
 * admin_addeditobsah_seriefoto_disable
 * admin_addeditobsah_seriefoto
 * admin_addeditobsah_oneseriefoto_enable
 * admin_addeditobsah_oneseriefoto_poc
 * admin_addeditobsah_oneseriefoto_row
 * admin_addeditobsah_oneseriefoto
 * admin_addeditobsah_download_row
 * admin_addeditobsah_download
 *
 * admin_addeditobsah_not_found
 *
 * admin_addeditobsah_error
 * admin_addeditobsah_error_sep
 *
 * admin_vypis_obsah_sablony
 * admin_vypis_obsah_sablony_copy
 * admin_vypis_obsah_sablony_del
 * admin_vypis_obsah_sablony_archivace
 * admin_vypis_obsah_sablony_aktivace
 * admin_vypis_obsah_sablony_datum
 * admin_vypis_obsah_sablony_datum_null
 * admin_vypis_obsah_sablony_sep
 * admin_vypis_obsah_sablony_link
 * admin_vypis_obsah_sablony_begin
 * admin_vypis_obsah_sablony_null
 * admin_vypis_obsah_sablony_end
 *
 *
 * =adresa (central)
 * normal_vypis_
 * normal_vypis_obal_
 * normal_vypis_obal_null_
 * normal_vypis_prvni_
 * normal_vypis_posledni_
 * normal_vypis_ente_def_array_
 * normal_vypis_ente_def_
 * normal_vypis_ente_od_
 * normal_vypis_ente_po_
 * normal_vypis_ente_break_
 * normal_vypis_begin_poc_
 * normal_vypis_ente_
 * normal_vypis_seriefoto_row_
 * normal_vypis_oneseriefoto_row_
 * normal_vypis_download_row_
 *
 * =adresa (centralmenu)
 * normal_vypis_menu_
 * normal_vypis_menu_aktivni_id_
 * normal_vypis_menu_aktivni_class_
 * normal_vypis_menu_prvni_
 * normal_vypis_menu_posledni_
 * normal_vypis_menu_ente_od_
 * normal_vypis_menu_ente_po_
 * normal_vypis_menu_ente_break_
 * normal_vypis_menu_ente_
 * normal_vypis_menu_ente_def_array_
 * normal_vypis_menu_ente_def_
 * normal_vypis_menu_aktivni_volitelny_
 * normal_vypis_menu_aktivni_LP_
 *
 * napr. pro sablonu id=1 tj XXX__1
 * nebo v normal vypisu:
 * napr. pro adresu adr vypis_1=adr
 * 'admin_addeditobsah_checkbox=1'
 * pokud je neudano bere defaultni 'admin_addeditobsah_checkbox'
 *
 **/

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Central - výpis šablon",
                                              "title" => "Central - výpis šablon",),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Řazení šablon",
                                              "title" => "Řazení šablon",),

                                        array("main_href" => "%%1%%%%3%%",
                                              "odkaz" => "Konfigurace menu",
                                              "title" => "Konfigurace menu",),

/*
                                        array("main_href" => "%%1%%%%4%%",
                                              "odkaz" => "Jazykova tabulka (DC) [neni]",
                                              "title" => "Jazykova tabulka (DC)",),
*/
                                        ),

                  "admin_permit" => array("%%1%%" => array("" => "Výpis šablon", "addsab" => "Přidat šablonu", "copysab" => "Duplikovat šablonu", "editsab" => "Upravit šablonu", "delsab" => "Smazat šablonu",
                                                          "copyelem" => "Duplikovat element", "addelem" => "Přidat element", "editelem" => "Upravit element", "delelem" => "Smazat element",
                                                          "updateelement" => "Úprava pořadí elementů"),
                                          "%%1%%%%2%%" => array("" => "Výpis řazení šablon", "updatesablona" => "Úprava pořadí šablon"),
                                          "%%1%%%%3%%" => array("" => "Výpis menu", "addmenu" => "Přidat menu", "editmenu" => "Upravit menu", "delmenu" => "Smazat menu",
                                                                "updatemenu" => "Úprava pořadí menu", "changedefmenu" => "Nastavování výchozího menu")
                                          ),

                  "admin_permit_rozsireni_vypis" => "%%1%% - Výpis obsahů",

                  "admin_permit_rozsireni_addobsah" => "%%1%% - Přidat obsah",

                  "admin_permit_rozsireni_copyobsah" => "%%1%% - Duplikovat obsah",

                  "admin_permit_rozsireni_editobsah" => "%%1%% - Upravit obsah",

                  "admin_permit_rozsireni_delobsah" => "%%1%% - Smazat obsah",

                  "admin_permit_rozsireni_updateobsah" => "%%1%% - Úprava pořadí obsahu",

                  "admin_permit_rozsireni_menu_vypis" => "%%1%% - Výpis menu",

                  "name_module" => array ("Administrace central",
                                          "Obsahy"),

/* - - - - - - - - - - Normal výpis - - - - - - - - - - */

                  //"normal_vypis_prvni" => "první",

                  "normal_vypis_prvni" => array("prvni1" => "p1",
                                                "prvni2" => "p2",
                                                "prvni3" => "p4",),

                  "normal_vypis_posledni" => array("posledn1" => "posledniíííí"),

                  "normal_vypis_ente_def_array" => array(1, 2, 3, 5),

                  "normal_vypis_ente_def" => array("ente1" => "enté definované"),


                  "normal_vypis_ente_od" => array("ente_lin" => 0),

                  "normal_vypis_ente_po" => array("ente_lin" => 1),

                  "normal_vypis_ente_break" => array("ente_lin" => 0),
                  //pocatek pocitani
                  "normal_vypis_begin_poc" => array("ente_lin" => 1),

                  "normal_vypis_ente" => array("ente_lin" => "enté lineární pocitani %%1%%"),



                  "normal_vypis_obal" => "cely vypis:<br />
<u>(%%nazev%%, %%popis%%)</u><br />
                  %%vypis%%
                  strankovani: %%strankovani%% (pokud je použité)
                  ",

                  "normal_rozkliknuty_vypis_obal" => "
ROZKLIKNUTY..
<u>(%%nazev%%, %%popis%%)</u><br />
                  %%vypis%%
                  strankovani: %%strankovani%% (pokud je použité)
                  ",


                  //null prepisuje cely obal
                  "normal_vypis_obal_null" => "žádné položky...",

                  "normal_vypis" => "
[%%id%%] => (%%poc%%, --%%subprvni%%)<br />
((%%prvni1%%, %%prvni2%%, %%prvni3%%, %%absolutni_url%%, %%ente1%%, %%ente_lin%%))<br />

%%10%% - 10<br />
%%11%%<br />
%%12%%<br />
%%13%%<br />
%%14%%<br />
%%15%%<br />
%%16%%<br />
%%17%%<br />
%%18%%<br />
%%19%%<br />
%%20%%<br />
%%21%%<br />
%%22%%<br />
<hr />
",

                  //pri rozkliknuti obsahu
                  "normal_rozkliknuty_vypis" => "
ROZKLIKNUTY...
[%%id%%] =><br />

%%10%%<br />
%%11%%<br />
%%12%%<br />
%%13%%<br />
%%14%%<br />
%%15%%<br />
<hr />
",

                  //"normal_vypis_1=adr" => "toto je  pokusny text pro adresu adr ...<br />",

                  "normal_vypis_foto" => "<a href=\"%%2%%\"><img src=\"%%1%%\" /></a>",

                  "normal_vypis_onefoto" => "<img src=\"%%1%%\" />",

                  "normal_vypis_seriefoto_row" => "<a href=\"%%2%%\"><img src=\"%%1%%\" /></a>%%3%%",

                  "normal_vypis_oneseriefoto_row" => "<a href=\"%%1%%\" title=\"%%2%%\"><img src=\"%%1%%\" alt=\"%%2%%\" width=\"120\" height=\"120\" /></a>",

                  "normal_vypis_download_row" => "<a href=\"%%1%%\">%%2%% (%%3%%, *.%%4%%, %%5%%, %%6%%)</a><br />",

                  "normal_vypis_download_date" => "d.m.Y H:i:s",

                  "normal_vypis_csssprit" => "<img src=\"%%1%%\" /> %%2%%x%%3%% %%4%%x%%5%%",

                  "normal_vypis_rewrite" => "<a href=\"%%2%%\" title=\"%%1%%\">%%1%%</a>",

                  "normal_vypis_url" => "<a href=\"%%1%%\" title=\"%%2%%\"%%3%%>%%2%%</a>",

                  "normal_vypis_externalfile_date" => "d.m.Y H:i:s",

                  "normal_vypis_externalfile_row" => "<a href=\"%%1%%\">(%%2%%) %%3%% (*.%%4%%, %%5%%, %%6%%)</a><br />
%%7%%
%%8%%
%%9%%
%%10%%
%%11%%
%%12%%
%%13%%
%%14%%
%%15%%
%%16%%
%%17%%
%%18%%
%%19%%
%%20%%
                  ",


                  //---central menu
                  "normal_vypis_menu" => "
<a href=\"%%url%%\">%%zantext%% - %%nazev%% (id:%%id%%, z:%%zanoreni%%, k:%%koren%%, in: %%menupoc%% (%%zanorenipoc%%), prvni: %%prvni%%, posledni: %%posledni%%, %%ente_lin%%, %%ente%%) %%absolutni_url%% %%aktivni1%%</a><br />
%%submenu%%
                  ",

                  "normal_vypis_menu_aktivni" => array("aktivni1" => "aktiiiiiiiivniiiiiiii"),

                  "normal_vypis_menu_prvni" => array("prvni" => "ok first"),

                  "normal_vypis_menu_posledni" => array("posledni" => "ok last"),

                  "normal_vypis_menu_ente_od" => array("ente_lin" => 0),

                  "normal_vypis_menu_ente_po" => array("ente_lin" => 2),

                  "normal_vypis_menu_ente_break" => array("ente_lin" => 0),

                  "normal_vypis_menu_ente" => array("ente_lin" => "lin ente aktivni"),


                  "normal_vypis_menu_ente_def_array" => array("ente" => array(1, 3, 5)),

                  "normal_vypis_menu_ente_def" => array("ente" => "array defffff"),


                  "normal_vypis_menu_text_zanoreni" => array("zan 0",
                                                            "zan 1",
                                                            "zan 2",
                                                            "zan 3",
                                                            "zan 4"
                                                            ),

//dodelat do univerzalnich!
                  //---drobeckova navigace
                  "normal_vypis_drobecky_first" => array("Hrobeček"),

                  "normal_vypis_drobecky_text" => "%%1%%",

                  "normal_vypis_drobecky_href" => "<a href=\"%%2%%\">%%1%%</a>",

                  "normal_vypis_drobecky_sep" => " >> ",





                  "normal_vypis_menu_obal" => "
                  <strong>naze sekce: %%1%%</strong><br />
<hr />
  obsah sekce: %%2%%
<hr />
                  ",





                  "normal_search_form" => "
        <form method=\"post\" action=\"\" id=\"zahlavi_hledej\" class=\"superadmin_zobrazit_blok\">
          <fieldset>
            <label class=\"form_text\">
              <input type=\"text\" name=\"%%1%%\" value=\"%%2%%\" />
            </label>
            <label class=\"form_submit\">
              <input type=\"submit\" name=\"%%3%%\" value=\"&nbsp;\" />
            </label>
          </fieldset>
        </form>
                  ",


                  "normal_vypis_search_minitext" => "minitext: <em>...%%1%%...</em> - nalezeno v tomto bloku: %%2%%x<br /><span>%%3%%</span><br />(%%4%%)<br /><br />",

                  "normal_vypis_search_fulltext" => "fulltext: <em>...%%1%%...</em> - nalezeno v tomto bloku: %%2%%x<br /><span>%%3%%</span><br />(%%4%%)<br /><br />",

                  "normal_vypis_search_tinymce" => "tiny: <em>...%%1%%...</em> - nalezeno v tomto bloku: %%2%%x<br /><span>%%3%%</span><br />(%%4%%)<br /><br />",

                  "normal_vypis_search_wymeditorlite" => "wym: <em>...%%1%%...</em> - nalezeno v tomto bloku: %%2%%x<br /><span>%%3%%</span><br />(%%4%%)<br /><br />",

                  "normal_vypis_search_minitextlite" => "minitextlite: <em>...%%1%%...</em> - nalezeno v tomto bloku: %%2%%x<br /><span>%%3%%</span><br />(%%4%%)<br /><br />",

                  "normal_vypis_search_fulltextlite" => "fulltextlite: <em>...%%1%%...</em> - nalezeno v tomto bloku: %%2%%x<br /><span>%%3%%</span><br />(%%4%%)<br /><br />",

                  "normal_search_fix_adres" => array (1 => "%%1%%lol",
                                                      4 => "%%1%%"),



                  "normal_search_redirect_wait" => "čekejte prosím probíhá velice náročné vyhledávání...",

                  "normal_search_redirect" => "%%1%%hledani/%%2%%",

                  "normal_vypis_search_konverze" => array("/%%1%%/" => "<strong>$0</strong>",
                                                          "/&lt;p&gt;/" => "",
                                                          "/&lt;\/p&gt;/" => "",
                                                          //"/\|-x--x-\|/" => ", ",
                                                          //"/\|-xxxx-\|/" => ", ",
                                                          ),

                  "normal_vypis_search_null" => "nic nenalezeno...",

                  "normal_vypis_search" => "
                  pocet vysledku: %%1%%<br />
                  vysledek vyhledavani:
<hr />
                  %%2%%
<hr />
                  ",


/* - - - - - - - - - - /Normal výpis - - - - - - - - - - */

                  "admin_obsah" => "
<div class=\"obal_dyncent\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Central - výpis šablon</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat šablonu\" class=\"addsab tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat šablonu</span>
  </a>
  <div class=\"cl-b pos-rel\">
    %%2%%
  </div>
</div>\n",

                  "set_konfigurace_sude_liche" => array("sudy", "lichy"),

                  "set_konfigurace_menu" => array("oznacit_defaultni" => array("name" => "Číslo výchozího zanoření menu", "typ" => "integer", "def" => -1, "only" => array(0), "class" => "f-text w-500"),
                                                  "zamek_menu" => array("name" => "Zamknout přidávání / mazání menu", "typ" => "boolean", "def" => false, "only" => array(), "class" => "f-checkbox w-500 m-b-3-i"),
                                                  "zamek_obsahu" => array("name" => "Zamknout přidávání / mazání obsahu", "typ" => "boolean", "def" => false, "only" => array(), "class" => "f-checkbox w-500 m-b-3-i"),
                                                  "zobrazit_submenu" => array("name" => "Zobrazit vypsané celé menu", "typ" => "boolean", "def" => false, "only" => array(0), "class" => "f-checkbox w-500 m-b-3-i"),
                                                  "zobrazit_submenu_obsah" => array("name" => "Zapnout filtrování obsahů", "typ" => "boolean", "def" => false, "only" => array(0), "class" => "f-checkbox w-500"),
                                                  ),

                  "admin_konfigurace_menu_boolean" => "
      <label class=\"%%5%%\">
        <input type=\"checkbox\"%%2%% onclick=\"$('#hide_%%1%%').val('%%1%%:'+(!this.checked));\" />
        <span class=\"nazev-elementu\">%%4%%</span>
      </label>
      <input type=\"hidden\" id=\"hide_%%1%%\" name=\"konfigurace[]\" value=\"%%1%%:%%3%%\" />\n",

                  "admin_konfigurace_menu_integer" => "
      <label class=\"%%4%%\">
        <span class=\"nazev-elementu\">%%3%%</span>
        <input type=\"text\" value=\"%%2%%\" onchange=\"$('#hide_%%1%%').val('%%1%%:'+(this.value));\" onkeyup=\"$('#hide_%%1%%').val('%%1%%:'+(this.value));\" />

      </label>
      <input type=\"hidden\" id=\"hide_%%1%%\" name=\"konfigurace[]\" value=\"%%1%%:%%2%%\" />\n",

                  "admin_vypis_konfigurace_menu_boolean" => "<li class=\"polozka-%%1%%-%%2%% m-l-%%3%% p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%4%%:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%5%% class=\"block m-t-2\" /></span></li>\n",

                  "admin_vypis_konfigurace_menu_integer" => "<li class=\"polozka-%%1%%-%%2%% m-l-%%3%% p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%4%%:</span><span class=\"fl-r\">%%5%%</span></li>\n",

                  "set_konfigurace_obsahu" => array("archivace" => array("name" => "Archivovat", "action" => "Archivovaný obsah", "typ" => "boolean", "class" => "f-checkbox w-500 m-b-3-i"),
                                                    "aktivace" => array("name" => "Schválit", "action" => "Schválený obsah", "typ" => "boolean", "class" => "f-checkbox w-500"),
                                                    ),

                  "set_konfigurace_sablony" => array ("zamek" => array("name" => "Zamknout přidávání obsahu", "typ" => "boolean", "class" => "f-checkbox w-500 m-b-3-i"),
                                                      "archivace" => array("name" => "Umožnit archivaci obsahů", "typ" => "boolean", "class" => "f-checkbox w-500 m-b-3-i"),
                                                      "aktivace" => array("name" => "Umožnit schvalování obsahů", "typ" => "boolean", "class" => "f-checkbox w-500 m-b-3-i"),
                                                      "zmena" => array("name" => "Umožnit výběr šablony", "typ" => "boolean", "class" => "f-checkbox w-500 m-b-3-i"),
                                                      //"strankovani" => array("name" => "Umožnit stránkování obsahů", "typ" => "boolean", "class" => "f-checkbox w-500"),
                                                      ),

                  "admin_konfigurace_sablony" => "
      <label class=\"%%5%%\">
        <input type=\"checkbox\"%%2%% onclick=\"$('#hide_%%1%%').val('%%1%%:'+(!this.checked));\" />
        <span class=\"nazev-elementu\">%%4%%</span>
      </label>
      <input type=\"hidden\" id=\"hide_%%1%%\" name=\"konfigurace[]\" value=\"%%1%%:%%3%%\" />\n",

                  "admin_vypis_konfigurace_sablony" => "<li class=\"polozka-4-%%1%% p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%2%%:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%3%% class=\"block m-t-2\" /></span></li>\n",

                  "admin_addsab_default" => array("",
                                                  "",
                                                  "poradi ASC",
                                                  0,
                                                  false,
                                                  false,
                                                  "",
                                                  "",
                                                  ),

                  "admin_addeditsab_add" => "Přidat šablonu",

                  "admin_addeditsab_edit" => "Upravit šablonu",

                  "admin_addeditsab" => "
<div class=\"obal_dyncent\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%% %%3%%</h3>
  </div>
  <a href=\"%%13%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Adresa šablony:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%2%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název šablony:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"razeni\" value=\"pridano ASC\"%%4%% />
        <span class=\"nazev-elementu\">Řazení podle data [A -> Z, 0 -> 9]</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"razeni\" value=\"pridano DESC\"%%5%% />
        <span class=\"nazev-elementu\">Řazení podle data [Z -> A, 9 -> 0]</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"razeni\" value=\"poradi ASC\"%%6%% />
        <span class=\"nazev-elementu\">Řazení podle pořadí [0 -> 9]</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"razeni\" value=\"poradi DESC\"%%7%% />
        <span class=\"nazev-elementu\">Řazení podle pořadí [9 -> 0]</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximum obsahů:</span>
        <input type=\"text\" name=\"max_obsah\" value=\"%%8%%\" />
        <span class=\"popis-elementu\">0 = neomezeně</span>
      </label>
      <label class=\"f-checkbox w-500 m-b-3-i none-i\">
        <input type=\"checkbox\" name=\"jazyky\"%%9%% />
        <span class=\"nazev-elementu\">Umožnit jazykové mutace</span>
      </label>
      <label class=\"f-checkbox w-500 m-b-3-i\">
        <input type=\"checkbox\" name=\"formenu\"%%10%% />
        <span class=\"nazev-elementu\">Šablona pro menu</span>
      </label>
%%11%%
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Popis šablony:</span>
        <textarea name=\"popis\" rows=\"10\" cols=\"60\">%%12%%</textarea>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_obsah_sablona_infinite" => "0 (neomezeně)",

                  "admin_vypis_obsah_sablona_begin" => "
<script type=\"text/javascript\" src=\"%%1%%/script/jquery.scrollTo-min.js\"></script>
<script type=\"text/javascript\">
    $(function() {
      $(\".obal_razeni\").sortable({
                          tolerance: 'pointer',
                          scroll: true,
                          scrollSensitivity: 40,
                          scrollSpeed: 30,
                          revert: 300,
                          opacity: 0.6,
                          cursor: 'move',
                          delay: 150,
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updateelement';
        $.post(\"%%1%%/ajax_form.php\", order, function(theResponse){
          $('#status_drag').html(theResponse);
        });
        ZpracujHlasku('#status_drag');
      }
      });
    });

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }

  function PosunNaPozici(id)
  {
    $.scrollTo('#scroll_sablony'+id, 1000, {easing: 'easeOutExpo'});
  }

  $(function(){
    $('#scrolltoobal').hover(
      function(){
        $(this).stop().animate({width: '200px'}, {duration: 600, easing: 'easeOutExpo'})
      },
      function(){
        $(this).stop().animate({width: '15px'}, {duration: 600, easing: 'easeOutExpo'})
      }
    );
  });
</script>
<div id=\"scrolltoobal\" class=\"nadpis-2\">
%%2%%
</div>
%%3%%
<div id=\"status_drag\"></div>\n",

//do budoucna dodelat!!
//<li class=\"polozka-4-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Umožnit jazykové mutace:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%6%% class=\"block m-t-2\" /></span></li>

                  "admin_vypis_obsah_sablona" => "
<ul class=\"f-f-web-pro f-s-14 m-t-15\" id=\"scroll_sablony%%1%%\">
  <li class=\"nadpis-6 f-s-16 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%3%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%10%%\" title=\"Přidat element\" class=\"addelem block fl-l m-r-5 m-l-5 no-u odkaz-18\">Přidat element</a><a href=\"%%7%%\" title=\"Duplikovat šablonu\" class=\"copysab block fl-l m-r-5 m-l-5 no-u odkaz-18\">Duplikovat šablonu</a><a href=\"%%8%%\" title=\"Upravit šablonu\" class=\"editsab block fl-l m-r-5 m-l-5 no-u odkaz-18\">Upravit šablonu</a><a href=\"%%9%%\" title=\"Opravdu chceš smazat šablonu: &quot;%%3%%&quot; ?\" class=\"confirm delsab block fl-l m-r-5 m-l-5 no-u odkaz-18\">Smazat šablonu</a><a href=\"#\" onclick=\"$.scrollTo('#zahlavi', 1000, {easing: 'easeOutExpo'}); return false;\" title=\"Nahoru\" class=\"block fl-l m-r-5 m-l-5 no-u odkaz-18\">Nahoru</a></span></li>
  <li class=\"polozka-4-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Adresa šablony:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-4-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Maximum obsahů:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
  <li class=\"polozka-4-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Šablona pro menu:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%5%% class=\"block m-t-2\" /></span></li>
%%6%%
</ul>
<div class=\"obal_razeni\">
%%11%%
</div>\n",

                  "admin_vypis_obsah_sablona_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořena žádná šablona</div>",

                  "admin_vypis_obsah_element" => "
<ul class=\"f-f-web-pro f-s-14 m-b-2\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%4%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%9%%\" title=\"Duplikovat element\" class=\"copyelem block fl-l m-r-5 m-l-5 no-u odkaz-4\">Duplikovat element</a><a href=\"%%10%%\" title=\"Upravit element\" class=\"editelem block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit element</a><a href=\"%%11%%\" title=\"Opravdu chceš smazat element: &quot;%%4%%&quot; ?\" class=\"confirm delelem block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat element</a></span></li>
  <li class=\"polozka-1-lichy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Typ elementu:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Výchozí obsah:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Povinná položka:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%5%% class=\"block m-t-2\" /></span></li>
  <li class=\"polozka-1-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Indexy v unikátních:</span><span class=\"fl-r barva-5\">od <span class=\"barva-2\">%%7%%</span> do <span class=\"barva-2\">%%8%%</span></span></li>
</ul>\n",

                  "admin_vypis_obsah_element_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořen žádný element</div>",

                  "ajax_updateelement" => "Bylo změněno pořadí elementů",

                  "ajax_updateelement_not_permit" => "Nemáte oprávnění",

                  "admin_vypis_sablona_scrollto" => "<a href=\"#\" onclick=\"PosunNaPozici(%%1%%); return false;\" title=\"Přesuň se na: %%2%%\" class=\"nadpis-6 odkaz-1 f-f-web-pro f-s-14 no-u\">%%2%%</a>\n",

                  "admin_vypis_sablona_scrollto_null" => "<p class=\"nadpis-6 cur-def f-f-web-pro f-s-14 no-u\">Žádné šablony</p>\n",

                  "admin_vypis_razeni_sablony_begin" => "
<script type=\"text/javascript\">
  $(document).ready(function(){
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
        var order = $(this).sortable(\"serialize\") + '&action=updatesablona';
        $.post(\"%%1%%/ajax_form.php\", order, function(theResponse){
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
</script>
<div class=\"obal_dyncent_sort\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Řazení šablon</h3>
  </div>
</div>
<div id=\"obal_razeni\" class=\"cl-b\">\n",

                  "admin_vypis_razeni_sablony" => "
<ul class=\"f-f-web-pro f-s-14 m-b-2\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h cur-move\"><span class=\"fl-l\">%%4%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">Pořadí: <span class=\"barva-14\">%%2%%</span> - ID: <span class=\"barva-14\">%%1%%</span></span></li>
</ul>\n",

                  "admin_vypis_razeni_sablony_end" => "</div>\n<div id=\"status_drag\"></div>\n",

                  "admin_vypis_razeni_sablony_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořena žádná šablona</div>",

                  "ajax_updatesablona" => "Bylo změněno pořadí šablon",

                  "ajax_updatesablona_not_permit" => "Nemáte oprávnění",

                  "admin_obsah_menu_addmenu" => "%%1%%",

                  "admin_obsah_menu" => "
<div class=\"obal_dyncent_menu\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Konfigurace menu</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat menu\" class=\"addmenu tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat menu</span>
  </a>
  <div class=\"cl-b pos-rel\">
    %%2%%
  </div>
</div>\n",

                  "admin_vypis_central_menu_row_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 m-b-20 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořeno žádné menu</div>",

                  "admin_vypis_central_menu_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořeno žádné menu</div>",

                  "admin_addeditmenu_add" => "Přidat menu",

                  "admin_addeditmenu_edit" => "Upravit menu",

                  "admin_addeditmenu" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<div class=\"obal_dyncent_menu\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%2%% %%6%%</h3>
  </div>
  <a href=\"%%11%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text w-710 ow-h\">
        <span class=\"nazev-elementu fl-l\">Zanoření:</span>
        <span class=\"nazev-elementu fl-l m-l-5 f-s-16-i l-h-21-i u\">%%3%%</span>
      </label>
      <label class=\"f-select f-povinny f-obsah w-505\">
        <span class=\"nazev-elementu\">Šablona:</span>
%%4%%
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
%%5%%
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název menu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%6%%\" onchange=\"PrepisRewrite(this.value, '.rewrite');\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span> Musí být uveden unikátní název oproti ostatním.</span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Rewrite název:</span>
        <input type=\"text\" class=\"rewrite\" name=\"rewrite\" value=\"%%7%%\" readonly=\"readonly\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span> Název se vyplní sám podle názvu menu.</span>
      </label>
%%8%%
%%9%%
%%10%%
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%2%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_skryta_sekce_nastaveni_menu" => "
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Adresa menu:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Maximum zanoření:</span>
        <input type=\"text\" name=\"max_zanoreni\" value=\"%%2%%\" />
        <span class=\"popis-elementu\">0 = neomezeně</span>
      </label>\n",

                  "ajax_updatemenu" => "Bylo změněno pořadí menu",

                  "ajax_updatemenu_not_permit" => "Nemáte oprávnění",

                  "ajax_changedefmenu" => "Bylo změněno výchozí menu z %%1%% na %%2%%",

                  "ajax_changedefmenu_not_permit" => "Nemáte oprávnění",

                  "admin_vypis_central_menu" => "
<script type=\"text/javascript\">
    $(function() {
      $(\".obal_razeni\").sortable({
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
        $.post(\"%%1%%/ajax_form.php\", order, function(theResponse){
          $('.status_drag').html(theResponse);
        });
        ZpracujHlasku('.status_drag');
      }
      });
    });

  function ZmenStav(koren, id, hodnota)
  {
    $.post(\"%%1%%/ajax_form.php\",
          \"action=changedefmenu&koren=\"+koren+\"&id=\"+id+\"&value=\"+hodnota,
            function(theResponse)
            {
              $('.status_drag').html(theResponse);
              ZpracujHlasku('.status_drag');
            }
          );
  }

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }
</script>
<div class=\"status_drag\"></div>
<div class=\"obal_razeni\">
%%2%%
</div>\n",

                  "admin_vypis_central_menu_pocitani" => 15,

                  "admin_vypis_central_menu_addmenu" => "<a href=\"%%1%%\" title=\"Přidat submenu\" class=\"addmenu block fl-l m-r-5 m-l-5 no-u odkaz-%%2%%\">Přidat submenu</a>",

                  "admin_vypis_central_menu_delmenu" => "<a href=\"%%1%%\" title=\"Opravdu chceš smazat menu: &quot;%%2%%&quot; ?\" class=\"confirm delmenu block fl-l m-r-5 m-l-5 no-u odkaz-%%3%%\">Smazat menu</a>",

                  "admin_vypis_central_menu_infinite" => "0 (neomezeně)",

                  "admin_vypis_central_menu_row" => "
<ul class=\"f-f-web-pro f-s-14 m-t-20\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-6 f-s-16 m-t-2 m-l-0 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%4%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%9%%<a href=\"%%7%%\" title=\"Upravit menu\" class=\"editmenu block fl-l m-r-5 m-l-5 no-u odkaz-18\">Upravit menu</a>%%8%%</span></li>
  <li class=\"polozka-4-lichy m-l-0 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Adresa:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-4-sudy m-l-0 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Šablona:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-4-lichy m-l-0 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Maximum zanoření:</span><span class=\"fl-r barva-5\">%%5%%</span></li>
%%6%%
%%10%%
</ul>\n",

                  "admin_rekurzivni_vypis_central_menu_row" => "
  <li class=\"nadpis-2 f-s-16 m-t-2 m-l-%%2%% p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">[%%5%%] - %%4%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%11%%<a href=\"%%9%%\" title=\"Upravit submenu\" class=\"editmenu block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit submenu</a>%%10%%</span></li>
  <li class=\"polozka-1-lichy m-l-%%2%% p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Šablona:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy m-l-%%2%% p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Výchozí submenu:</span><span class=\"fl-r\"><input type=\"radio\"%%7%% name=\"defz%%5%%k%%6%%\" onclick=\"ZmenStav(%%6%%, %%1%%, this.checked, '#status_change');\" class=\"changedefmenu block m-t-1 cur-poi\" /></span></li>
%%8%%
%%12%%\n",

                  "admin_vypis_zanoreni_menu" => "
<script type=\"text/javascript\">
    $(function() {
      $(\".obal_razeni\").sortable({
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
        $.post(\"%%1%%/ajax_form.php\", order, function(theResponse){
          $(\"#status_drag\").html(theResponse);
        });
        ZpracujHlasku('#status_drag');
      }
      });
    });

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }
</script>
<div class=\"obal_razeni f-f-web-pro f-s-14 m-b-20 m-r-10\">
  %%2%%
</div>
<div id=\"status_drag\"></div>",

                  "admin_vypis_zanoreni_menu_row" => "
<ul class=\"f-f-web-pro f-s-14 m-b-2\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 m-l-0 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%2%%</span></li>
  <li class=\"polozka-1-lichy m-l-0 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Výchozí menu:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%3%% class=\"block m-t-2\" /></span></li>
%%4%%
</ul>\n",

                  "admin_vypis_zanoreni_menu_submenu" => "<li class=\"polozka-1-sudy m-l-0 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsahuje submenu</span></li>",

                  "admin_vypis_zanoreni_menu_null" => "<div class=\"nadpis-2 f-s-16 m-b-20 m-r-10 p-t-10 p-b-10 t-a-c f-f-web-pro\">Žádné další menu v této úrovni</div>",

                  "ajax_update_menu_zanoreni" => "Bylo změněno pořadí menu",

/*
 * =menu
 * admin_obsah_central_menu
 * admin_vypis_menu_href_up
 * admin_vypis_menu
 * admin_vypis_menu_aktivni
 * admin_vypis_menu_submenu
 * admin_vypis_menu_null
 *
 * admin_vypis_drobek_root
 * admin_vypis_drobek_href
 * admin_vypis_drobek_text
 * admin_vypis_drobek_sep
 *
 **/

                  "admin_obsah_central_menu" => "
<div class=\"obal_dyncent__%%1%%\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%3%%</h3>
  </div>
%%5%%
%%4%%
%%2%%
  <div class=\"cl-b pos-rel\">
%%6%%
  </div>
</div>\n",

                  "admin_vypis_menu_addobsah" => "
  <a href=\"%%1%%\" title=\"Přidat obsah\" class=\"addobsah tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat obsah</span>
  </a>\n",

                  "admin_vypis_menu" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  %%1%%
</ul>\n",

                  "admin_vypis_menu_row" => "
<li class=\"nadpis-2 f-s-14 p-t-3 p-r-6 p-b-2 p-l-6 ow-h\"><a href=\"%%1%%\" class=\"block fl-l no-u odkaz-10\" title=\"%%2%%\">%%2%%%%3%%</a><span class=\"block fl-r\">Počet obsahů: <span class=\"barva-14\">%%6%%</span></span></li>
<li class=\"polozka-1-sudy m-b-2 p-t-3 p-r-6 p-b-2 p-l-6 ow-h f-s-12\"><span class=\"fl-l barva-4\">Výchozí menu:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%5%% class=\"block\" /></span></li>\n",

                  "admin_vypis_menu_submenu" => " - obsahuje submenu",

                  "admin_vypis_drobek" => "
<p class=\"f-f-web-pro f-s-14 l-h-18 m-b-15 ow-h\">
  %%1%%
</p>",

                  "admin_vypis_drobek_href" => "<a href=\"%%2%%\" title=\"%%3%%\" class=\"block fl-l odkaz-1 m-b-2 p-r-3 p-l-3 no-u\">%%3%%</a>",

                  "admin_vypis_drobek_text" => "<span class=\"block fl-l m-b-2\">%%2%%</span>",

                  "admin_vypis_drobek_sep" => "<span class=\"block fl-l m-b-2 p-r-2 p-l-2 f-s-16\">&raquo;</span>",

                  "admin_addeditelem_add" => "Přidat element",

                  "admin_addeditelem_edit" => "Upravit element",

                  "admin_addeditelem" => "
<div class=\"obal_dyncent\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%2%% - %%1%%</h3>
  </div>
  <a href=\"%%10%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-select f-obsah w-505\">
        <span class=\"nazev-elementu\">Šablona:</span>
%%3%%
      </label>
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Název elementu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%4%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
%%5%%
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Výchozí obsah:</span>
        <textarea name=\"value\" class=\"hodnota\" rows=\"10\" cols=\"60\">%%6%%</textarea>
      </label>
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Popis elementu:</span>
        <textarea name=\"popis\" rows=\"10\" cols=\"60\">%%7%%</textarea>
      </label>
%%9%%
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"povinne\"%%8%% />
        <span class=\"nazev-elementu\">Povinná položka</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editelemobsah_row" => "<a href=\"%%1%%\">typ: %%2%%</a><br />",

                  "admin_editelemobsah" => "
<div class=\"obal_dyncent\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Upravit element obsahu - %%1%%</h3>
  </div>
  <a href=\"%%3%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na obsah</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
%%2%%
    </fieldset>
  </form>
</div>\n",

                  "admin_editelemobsah_edit" => "
<div class=\"obal_dyncent\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Upravit element obsahu - %%1%% (změna na: %%2%%)</h3>
  </div>
  <a href=\"%%5%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na elementy</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
%%3%%
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Obsah:</span>
        <textarea name=\"value\" class=\"hodnota\" rows=\"10\" cols=\"60\">%%4%%</textarea>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit element\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vyber_sablony" => "
<select name=\"sablona\">
  %%1%%
</select>",

                  "admin_vyber_sablony_row" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vyber_sablony_null" => "<span class=\"nazev-elementu f-s-14-i\">Šablona neexistuje !</span>",

                  "admin_vyber_typu_row" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vyber_typu" => "
      <label class=\"f-select f-povinny w-505\">
        <span class=\"nazev-elementu\">Typ elementu:</span>
<select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+this.value\">
  <option value=\"\">--- Vyber element ---</option>
  %%2%%
</select>
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
%%3%%\n",

                  "admin_vyber_typu_null" => "<span class=\"block nadpis-2 w-505 f-s-17 m-b-15 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vybrán žádný element</span>",

                  "admin_vyber_typu_not" => "<span class=\"block nadpis-2 w-505 f-s-17 m-b-15 p-t-10 p-b-10 t-a-c f-f-web-pro\">Žádné nastavení</span>",

                  "admin_vyber_typu_fulltextlite_default" => array(100, 300),

                  "admin_vyber_typu_fulltextlite" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální výška v px:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
        <span class=\"popis-elementu\">Rozsah od 30 do 710, Krok po 5.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální výška v px:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
        <span class=\"popis-elementu\">Rozsah od 30 do 710, Krok po 5.</span>
      </label>\n",

                  "admin_vyber_typu_fulltext_default" => array(100, 300, 0, "...", 0),

                  "admin_vyber_typu_fulltext" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální výška v px:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
        <span class=\"popis-elementu\">Rozsah od 30 do 710, Krok po 5.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální výška v px:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
        <span class=\"popis-elementu\">Rozsah od 30 do 710, Krok po 5.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zkracování textu po:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" />
        <span class=\"popis-elementu\">0 = nezkracuje text</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%6%%\" />
      </label>
<script type=\"text/javascript\">
  var poc = %%7%%;
  function PridejElement()
  {
    poc++;

    VykresliElement();
  }

  function OdeberElement()
  {
    poc--;

    VykresliElement();
  }

  var pole_nazev = ['|%%8%%|'];
  var pole_hodnota = ['|%%9%%|'];
  function PosliData(row, polozka, hodnota)
  {
%%2%%

    switch (polozka)
    {
      case 0:
        pole_nazev[row] = '|'+roz+'|';
        VykresliElement();
      break;

      case 1:
        pole_hodnota[row] = '|'+roz+'|';
        VykresliElement();
      break;
    }
  }

  function VykresliElement()
  {
    $(function() {
      $.post(\"%%1%%/ajax_form.php\",
            \"action=listtext&pocet=\"+poc+\"&nazev=\"+pole_nazev+\"&hodnota=\"+pole_hodnota,
              function(theResponse)
              {
                $('#polozky').html(theResponse);
              }
            );
      $('.pocetprvku').val(poc);
      $('#pocet_polozek').html(poc);
    });
  }
  window.setTimeout(\"VykresliElement();\", 10);
</script>
<p class=\"ow-h\">
  <span class=\"block f-f-web-pro m-b-6\">Počet položek: <strong id=\"pocet_polozek\" class=\"no-b u\"></strong></span>
  <a href=\"#\" onclick=\"PridejElement(); return false;\" title=\"Přidat položku\" class=\"block fl-l odkaz-1 m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Přidat položku</a>
  <input type=\"hidden\" class=\"pocetprvku\" name=\"konfigurace[]\" />
</p>
<div id=\"polozky\" class=\"f-text w-500 pos-rel obal-odkazy-pridat-odebrat m-b-0-i\"></div>\n",

                  "admin_vyber_typu_minitext_default" => array(0, "...", 0),

                  "admin_vyber_typu_minitext" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zkracování textu po:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
        <span class=\"popis-elementu\">0 = nezkracuje text</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
      </label>
<script type=\"text/javascript\">
  var poc = %%5%%;
  function PridejElement()
  {
    poc++;

    VykresliElement();
  }

  function OdeberElement()
  {
    poc--;

    VykresliElement();
  }

  var pole_nazev = ['|%%6%%|'];
  var pole_hodnota = ['|%%7%%|'];
  function PosliData(row, polozka, hodnota)
  {
%%2%%

    switch (polozka)
    {
      case 0:
        pole_nazev[row] = '|'+roz+'|';
        VykresliElement();
      break;

      case 1:
        pole_hodnota[row] = '|'+roz+'|';
        VykresliElement();
      break;
    }
  }

  function VykresliElement()
  {
    $(function() {
      $.post(\"%%1%%/ajax_form.php\",
            \"action=listtext&pocet=\"+poc+\"&nazev=\"+pole_nazev+\"&hodnota=\"+pole_hodnota,
              function(theResponse)
              {
                $('#polozky').html(theResponse);
              }
            );
      $('.pocetprvku').val(poc);
      $('#pocet_polozek').html(poc);
    });
  }
  window.setTimeout(\"VykresliElement();\", 10);
</script>
      <p class=\"ow-h\">
        <span class=\"block f-f-web-pro m-b-6\">Počet položek: <strong id=\"pocet_polozek\" class=\"no-b u\"></strong></span>
        <a href=\"#\" onclick=\"PridejElement(); return false;\" title=\"Přidat položku\" class=\"block fl-l odkaz-1 m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Přidat položku</a>
        <input type=\"hidden\" class=\"pocetprvku\" name=\"konfigurace[]\" />
      </p>
      <div id=\"polozky\" class=\"f-text w-500 pos-rel obal-odkazy-pridat-odebrat m-b-0-i\"></div>\n",

                  "ajax_listtext_del" => "<a href=\"#\" onclick=\"OdeberElement(); return false\" title=\"Odebrat položku\" class=\"odkaz-odebrat odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Odebrat položku</a>",

                  "ajax_listtext" => "
      <label class=\"f-text w-500 m-b-3-i\">
        <span class=\"nazev-elementu\">[%%2%%] Přepis znaků z:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onchange=\"PosliData(%%1%%, 0, this.value);\" />
      </label>
      <label class=\"f-text w-500 m-b-20-i\">
        <span class=\"nazev-elementu\">[%%2%%] Přepis znaků na:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" onchange=\"PosliData(%%1%%, 1, this.value);\" />
      </label>
%%5%%\n",

                  "admin_vyber_vstupu" => "
      <label class=\"f-select f-obsah w-505\">
        <span class=\"nazev-elementu\">Typ vstupu:</span>
<select name=\"vstup\" onchange=\"document.location.href='%%1%%&amp;vstup='+this.value\">
%%2%%
</select>
      </label>
%%3%%\n",

                  "admin_vyber_vstupu_row" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vyber_vstupu_string_integer_float" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální hodnota:</span>
        <input type=\"text\" name=\"min_val\" value=\"%%1%%\" />
        <span class=\"popis-elementu\">Při vybraném textovém vstupu nastavuje minimální délku, u čísla minimální hodnotu.<br />0 = neaktivní.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální hodnota:</span>
        <input type=\"text\" name=\"max_val\" value=\"%%2%%\" />
        <span class=\"popis-elementu\">Při vybraném textovém vstupu nastavuje maximální délku, u čísla maximální hodnotu.<br />0 = neaktivní.</span>
      </label>\n",

                  "admin_vyber_vstupu_reg_exp" => "
      <label class=\"f-textarea w-500\">
        <span class=\"nazev-elementu\">Regulární výraz:</span>
        <textarea name=\"reg_exp\" rows=\"7\" cols=\"60\">%%1%%</textarea>
        <span class=\"popis-elementu block ow-h\"><a href=\"http://cz.php.net/manual/en/function.preg-match.php\" title=\"Dokumentace\" class=\"block fl-l odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Dokumentace</a></span>
      </label>\n",

                  "admin_vyber_typu_datum_default" => array("d.m.Y",
                                                            "Pondělí,Úterý,Středa,Čtvrtek,Pátek,Sobota,Neděle",
                                                            "Leden,Únor,Březen,Duben,Květen,Červen,Červenec,Srpen,Září,Říjen,Listopad,Prosinec",
                                                            "@datum@, @den@, @mesic@, @svatek@"),

                  "admin_vyber_typu_datum" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Formát datumu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" id=\"formdate\" />
        <span class=\"popis-elementu\">Formát datumu je podle PHP.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Dny v týdnu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" id=\"daydate\" />
        <span class=\"popis-elementu\">Názvy dnů jsou odděleny čárkou.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Měsíce v roce:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" id=\"monthdate\" />
        <span class=\"popis-elementu\">Názvy měsíců jsou odděleny čárkou.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Výstupní tvar:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" id=\"fintvar\" />
        <span class=\"popis-elementu\">Datum: @datum@, Den: @den@, Měsíc: @mesic@, Svátek: @svatek@.</span>
      </label>
      <label class=\"f-text w-710\">
        <span class=\"nazev-elementu\">Náhled výstupního tvaru:</span>
        <span id=\"nahled_datum\" class=\"nazev-elementu f-s-14-i l-h-16-i\">---</span>
        <span class=\"popis-elementu block ow-h\"><a href=\"#\" onclick=\"NahledData($('.hodnota').val(), $('#formdate').val(), $('#daydate').val(), $('#monthdate').val(), $('#fintvar').val(), '#nahled_datum'); return false;\" title=\"Náhled\" class=\"block fl-l odkaz-1 m-r-3 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Náhled</a><a href=\"#\" onclick=\"$('.hodnota').val('now'); return false;\" title=\"Dnešní datum\" class=\"block fl-l odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Dnešní datum</a></span>
      </label>\n",

                  "admin_vyber_typu_cas_default" => array("H:i:s"),

                  "admin_vyber_typu_cas" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Formát času:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" id=\"formtime\" />
        <span class=\"popis-elementu\">Formát času je podle PHP.</span>
      </label>
      <label class=\"f-text w-710\">
        <span class=\"nazev-elementu\">Náhled výstupního tvaru:</span>
        <span id=\"nahled_cas\" class=\"nazev-elementu f-s-14-i l-h-16-i\">---</span>
        <span class=\"popis-elementu block ow-h\"><a href=\"#\" onclick=\"NahledCasu($('.hodnota').val(), $('#formtime').val(), '#nahled_cas'); return false;\" title=\"Náhled\" class=\"block fl-l odkaz-1 m-r-3 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Náhled</a><a href=\"#\" onclick=\"$('.hodnota').val('now'); return false;\" title=\"Aktuální čas\" class=\"block fl-l odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Aktuální čas</a></span>
      </label>\n",

                  "admin_vyber_typu_datumcas_default" => array ("d.m.Y H:i:s",
                                                                "Pondělí,Úterý,Středa,Čtvrtek,Pátek,Sobota,Neděle",
                                                                "Leden,Únor,Březen,Duben,Květen,Červen,Červenec,Srpen,Září,Říjen,Listopad,Prosinec",
                                                                "@datum@, @den@, @mesic@, @svatek@"),

                  "admin_vyber_typu_datumcas" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Formát datumu a času:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" id=\"formdate\" />
        <span class=\"popis-elementu\">Formát datumu a času je podle PHP.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Dny v týdnu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" id=\"daydate\" />
        <span class=\"popis-elementu\">Názvy dnů jsou odděleny čárkou.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Měsíce v roce:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" id=\"monthdate\" />
        <span class=\"popis-elementu\">Názvy měsíců jsou odděleny čárkou.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Výstupní tvar:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" id=\"fintvar\" />
        <span class=\"popis-elementu\">Datum: @datum@, Den: @den@, Měsíc: @mesic@, Svátek: @svatek@.</span>
      </label>
      <label class=\"f-text w-710\">
        <span class=\"nazev-elementu\">Náhled výstupního tvaru:</span>
        <span id=\"nahled_datum_cas\" class=\"nazev-elementu f-s-14-i l-h-16-i\">---</span>
        <span class=\"popis-elementu block ow-h\"><a href=\"#\" onclick=\"NahledData($('.hodnota').val(), $('#formdate').val(), $('#daydate').val(), $('#monthdate').val(), $('#fintvar').val(), '#nahled_datum_cas'); return false;\" title=\"Náhled\" class=\"block fl-l odkaz-1 m-r-3 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Náhled</a><a href=\"#\" onclick=\"$('.hodnota').val('now'); return false;\" title=\"Dnešní datum a čas\" class=\"block fl-l odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Dnešní datum a čas</a></span>
      </label>\n",

                  "admin_vyber_typu_foto_default" => array("200x0",
                                                          "800x0",
                                                          true),

                  "admin_vyber_typu_foto" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\">
  TypeUpload('%%2%%', '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#main_mini');
  TypeUpload('%%3%%', 'own', '', '#main_full');
</script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Nastavení miniatury:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#main_mini');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost, own = bude požadovat vlastní miniaturu.<br /><span id=\"main_mini\"></span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Nastavení plného náhledu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#main_full');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><span id=\"main_full\"></span></span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"konfigurace[]\" value=\"confmain\" onclick=\"$('#hide_confmain').attr('disabled', !this.checked);\"%%4%% />
        <span class=\"nazev-elementu\">Měnit velikosti obrázku</span>
      </label>
<input type=\"hidden\" name=\"konfigurace[]\" value=\"\" id=\"hide_confmain\"%%5%% />\n",

                  "admin_vyber_typu_onefoto_default" => array("800x0",
                                                              true),

                  "admin_vyber_typu_onefoto" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\">
  TypeUpload('%%2%%', 'own', '', '#main_full');
</script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Nastavení plného náhledu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#main_full');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><span id=\"main_full\"></span></span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"konfigurace[]\" value=\"confmain\" onclick=\"$('#hide_confmain').attr('disabled', !this.checked);\"%%3%% />
        <span class=\"nazev-elementu\">Měnit velikosti obrázku</span>
      </label>
<input type=\"hidden\" name=\"konfigurace[]\" value=\"\" id=\"hide_confmain\"%%4%% />\n",

                  "admin_vyber_typu_seriefoto_default" => array("200x0",
                                                                "800x0",
                                                                true,
                                                                3,
                                                                true),

                  "admin_vyber_typu_seriefoto" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\">
  TypeUpload('%%2%%', '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#main_mini');
  TypeUpload('%%3%%', 'own', '', '#main_full');
</script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Nastavení miniatury:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#main_mini');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost, own = bude požadovat vlastní miniaturu.<br /><span id=\"main_mini\"></span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Nastavení plného náhledu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#main_full');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><span id=\"main_full\"></span></span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"konfigurace[]\" value=\"confmain\" onclick=\"$('#hide_confmain').attr('disabled', !this.checked);\"%%4%% />
        <span class=\"nazev-elementu\">Měnit velikosti obrázku</span>
      </label>
<input type=\"hidden\" name=\"konfigurace[]\" value=\"\" id=\"hide_confmain\"%%5%% />
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Výchozí počet obrázků:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%6%%\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"konfigurace[]\" value=\"pocserie\" onclick=\"$('#hide_pocserie').attr('disabled', !this.checked);\"%%7%% />
        <span class=\"nazev-elementu\">Měnit počet obrázků</span>
      </label>
<input type=\"hidden\" name=\"konfigurace[]\" value=\"\" id=\"hide_pocserie\"%%8%% />\n",

                  "admin_vyber_typu_oneseriefoto_default" => array("800x0",
                                                                  true,
                                                                  3,
                                                                  true),

                  "admin_vyber_typu_oneseriefoto" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\">
  TypeUpload('%%2%%', 'own', '', '#main_full');
</script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Nastavení plného náhledu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#main_full');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><span id=\"main_full\"></span></span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"konfigurace[]\" value=\"confmain\" onclick=\"$('#hide_confmain').attr('disabled', !this.checked);\"%%3%% />
        <span class=\"nazev-elementu\">Měnit velikosti obrázku</span>
      </label>
<input type=\"hidden\" name=\"konfigurace[]\" value=\"\" id=\"hide_confmain\"%%4%% />
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální počet obrázků:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" />
        <span class=\"popis-elementu\">0 = neomezeně</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"konfigurace[]\" value=\"pocserie\" onclick=\"$('#hide_pocserie').attr('disabled', !this.checked);\"%%6%% />
        <span class=\"nazev-elementu\">Měnit počet obrázků</span>
      </label>
<input type=\"hidden\" name=\"konfigurace[]\" value=\"\" id=\"hide_pocserie\"%%7%% />\n",

                  "admin_vyber_typu_checkbox_default" => array("",
                                                               ""),

                  "admin_vyber_typu_checkbox" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Value hodnota [on]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Value hodnota [off]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
      </label>\n",

                  "admin_vyber_typu_radio_select_default" => array(5, 2),

                  "admin_vyber_typu_radio_select" => "
<script type=\"text/javascript\">
  var poc = %%5%%;
  function PridejElement()
  {
    poc++;

    VykresliElement();
  }

  function OdeberElement()
  {
    poc--;

    VykresliElement();
  }

  function OznacitDefault(id)
  {
    $('.hodnota').val($('.radiohodnota'+id).val());
  }

  var pole_nazev = ['|%%6%%|'];
  var pole_hodnota = ['|%%7%%|'];
  function PosliData(row, polozka, hodnota)
  {
%%2%%

    switch (polozka)
    {
      case 0:
        pole_nazev[row] = '|'+roz+'|';
        VykresliElement();
      break;

      case 1:
        pole_hodnota[row] = '|'+roz+'|';
        VykresliElement();
      break;
    }
  }

  function VykresliElement()
  {
    $(function() {
      $.post(\"%%1%%/ajax_form.php\",
            \"action=listradsel&typ=%%3%%&pocet=\"+poc+\"&nazev=\"+pole_nazev+\"&hodnota=\"+pole_hodnota,
              function(theResponse)
              {
                $('#polozky').html(theResponse);
              }
            );
      $('.pocetprvku').val(poc);
      $('#pocet_polozek').html(poc);
    });
  }
  window.setTimeout(\"VykresliElement();\", 10);
</script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zalomit po [X] položkách:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
        <span class=\"popis-elementu\">Nastavení souvisí jen s elementy \"Skupina checkboxů\" a \"Radio buttony\".</span>
      </label>
      <p class=\"ow-h\">
        <span class=\"block f-f-web-pro m-b-6\">Počet položek: <strong id=\"pocet_polozek\" class=\"no-b u\"></strong></span>
        <a href=\"#\" onclick=\"PridejElement(); return false;\" title=\"Přidat položku\" class=\"block fl-l odkaz-1 m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Přidat položku</a>
        <input type=\"hidden\" class=\"pocetprvku\" name=\"konfigurace[]\" />
      </p>
      <div id=\"polozky\" class=\"f-text w-500 pos-rel obal-odkazy-pridat-odebrat m-b-0-i\"></div>\n",

                  "ajax_listradsel" => "
%%6%%
      <label class=\"f-text w-500 m-b-5-i\">
        <span class=\"nazev-elementu\">Popis [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" onchange=\"PosliData(%%1%%, 0, this.value);\" />
      </label>
      <label class=\"f-text w-500 m-b-20-i\">
        <span class=\"nazev-elementu\">Hodnota [%%2%%]:</span>
        <input type=\"text\" name=\"konfigurace[]\" class=\"radiohodnota%%1%%\" value=\"%%4%%\" onchange=\"PosliData(%%1%%, 1, this.value);\" />
        <span class=\"popis-elementu ow-h\">%%5%%<!-- --></span>
        <span class=\"popis-elementu\">V případě elementu \"Skupina checkboxů\" je zápis hodnoty \"TRUE-;-FALSE\".</span>
      </label>\n",

                  "ajax_listradsel_radsel" => "<a href=\"#\" onclick=\"OznacitDefault(%%1%%); return false;\" title=\"Výchozí položka [%%2%%]\" class=\"block fl-l odkaz-1 p-t-2 p-r-3 p-b-2 p-l-3 no-u\">Výchozí položka [%%2%%]</a>",

                  "ajax_listradsel_del" => "<a href=\"#\" onclick=\"OdeberElement(); return false\" title=\"Odebrat položku\" class=\"odkaz-odebrat odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Odebrat položku</a>",

                  "admin_vyber_typu_automazani_default" => array("+14 day,+7 day,+2 day"),

                  "admin_vyber_typu_automazani" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Varianty přičítání datumu:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
        <span class=\"popis-elementu\">Zápis je podle PHP. Hodnoty jsou odděleny čárkou.</span>
        <span class=\"popis-elementu block ow-h\"><a href=\"http://cz.php.net/manual/en/datetime.formats.relative.php\" title=\"Dokumentace\" class=\"block fl-l odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Dokumentace</a></span>
      </label>\n",

                  "admin_vyber_typu_conectmodule" => "
      <label class=\"f-select-optgroup f-povinny w-505\">
        <span class=\"nazev-elementu\">Funkce modulu:</span>
%%1%%
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Parametry funkce:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" />
        <span class=\"popis-elementu\">Parametry nastavuj podle funkce modulu, oddělovač: \"|\", volací metoda: @@1@@, ID obsahu: @@2@@</span>
      </label>\n",

                  "admin_seznam_trid_begin" => "
<select name=\"konfigurace[]\">
  <option value=\"\" class=\"option_center\">--- Vyber funkci modulu ---</option>\n",

                  "admin_seznam_trid_skupina_begin" => "  <optgroup label=\"%%1%%\">\n",

                  "admin_seznam_trid" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_seznam_trid_skupina_end" => "  </optgroup>\n\n",

                  "admin_seznam_trid_end" => "</select>\n",

                  //v budoucnu dodelat!!
                  //"admin_vyber_typu_upload_default" => array("jpg,png,gif,bmp"),

//v budoucnu dodelat!!?!
/*
                  "admin_vyber_typu_upload" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Podporované formáty:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
        <span class=\"popis-elementu\">Hodnoty jsou odděleny čárkou.</span>
      </label>\n",
*/

                  "admin_vyber_typu_download_default" => array(1, "none"),

                  "admin_vyber_typu_download" => "
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximum souborů:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%1%%\" />
        <span class=\"popis-elementu\">0 = neomezeně</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[razeni]\" value=\"none\"%%2%% />
        <span class=\"nazev-elementu\">Neřadit, umožní manuální řazení</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[razeni]\" value=\"date asc\"%%3%% />
        <span class=\"nazev-elementu\">Řazení podle data [A -> Z, 0 -> 9]</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[razeni]\" value=\"date desc\"%%4%% />
        <span class=\"nazev-elementu\">Řazení podle data [Z -> A, 9 -> 0]</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[razeni]\" value=\"name asc\"%%5%% />
        <span class=\"nazev-elementu\">Řazení podle názvu [A -> Z, 0 -> 9]</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[razeni]\" value=\"name desc\"%%6%% />
        <span class=\"nazev-elementu\">Řazení podle názvu [Z -> A, 9 -> 0]</span>
      </label>\n",
/*
                  "admin_vyber_typu_flash_default" => array("file",
                                                            200,
                                                            100,
                                                            true,
                                                            false,
                                                            "",
                                                            "#rrggbb",
                                                            "left",
                                                            "false",
                                                            "true",
                                                            "false",
                                                            "high",
                                                            "false",
                                                            "opaque",
                                                            "false",
                                                            ),

                  "admin_vyber_typu_flash" => "
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"link\"%%1%% />
        <span class=\"nazev-elementu\">Odkaz na flash</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"file\"%%2%% />
        <span class=\"nazev-elementu\">Nahrát flash</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Délka:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Výška:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
      </label>
      <label class=\"f-checkbox w-500 m-b-3-i\">
        <input type=\"checkbox\" name=\"konfigurace[]\" value=\"confsize\" onclick=\"$('#hide_confsize').attr('disabled', !this.checked);\"%%5%% />
        <span class=\"nazev-elementu\">Umožnit nastavení velikosti</span>
      </label>
      <input type=\"hidden\" name=\"konfigurace[]\" value=\"\" id=\"hide_confsize\"%%6%% />
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"konfigurace[]\" value=\"confvar\" onclick=\"$('#hide_confvar').attr('disabled', !this.checked);\"%%7%% />
        <span class=\"nazev-elementu\">Umožnit nastavení vlastních parametrů</span>
      </label>
      <input type=\"hidden\" name=\"konfigurace[]\" value=\"\" id=\"hide_confvar\"%%8%% />
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Vlastní parametry:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%9%%\" />
        <span class=\"popis-elementu\">(klic:hodnota;klic:hodnota;)</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Barva pozadí:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%10%%\" />
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[align]\" value=\"default\"%%11%% />
        <span class=\"nazev-elementu\">align default</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[align]\" value=\"left\"%%12%% />
        <span class=\"nazev-elementu\">align left</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[align]\" value=\"right\"%%13%% />
        <span class=\"nazev-elementu\">align right</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[align]\" value=\"top\"%%14%% />
        <span class=\"nazev-elementu\">align top</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[align]\" value=\"bottom\"%%15%% />
        <span class=\"nazev-elementu\">align bottom</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[devicefont]\" value=\"true\"%%16%% />
        <span class=\"nazev-elementu\">Vykreslovat texty</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[devicefont]\" value=\"false\"%%17%% />
        <span class=\"nazev-elementu\">Nevykreslovat texty</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[play]\" value=\"true\"%%18%% />
        <span class=\"nazev-elementu\">Přehrát hned</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[play]\" value=\"false\"%%19%% />
        <span class=\"nazev-elementu\">Přehrát po načtení</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[loop]\" value=\"true\"%%20%% />
        <span class=\"nazev-elementu\">Neustále opakovat</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[loop]\" value=\"false\"%%21%% />
        <span class=\"nazev-elementu\">Neopakovat</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[quality]\" value=\"low\"%%22%% />
        <span class=\"nazev-elementu\">quality low</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[quality]\" value=\"medium\"%%23%% />
        <span class=\"nazev-elementu\">quality medium</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[quality]\" value=\"high\"%%24%% />
        <span class=\"nazev-elementu\">quality high</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[quality]\" value=\"autolow\"%%25%% />
        <span class=\"nazev-elementu\">quality autolow</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[quality]\" value=\"autohigh\"%%26%% />
        <span class=\"nazev-elementu\">quality autohigh</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[quality]\" value=\"best\"%%27%% />
        <span class=\"nazev-elementu\">quality best</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[menu]\" value=\"true\"%%28%% />
        <span class=\"nazev-elementu\">Povolit kontextové menu</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[menu]\" value=\"false\"%%29%% />
        <span class=\"nazev-elementu\">Zakázat kontextové menu</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[wmode]\" value=\"window\"%%30%% />
        <span class=\"nazev-elementu\">wmode (průhlednost) window</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[wmode]\" value=\"opaque\"%%31%% />
        <span class=\"nazev-elementu\">wmode (průhlednost) opaque</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[wmode]\" value=\"transparent\"%%32%% />
        <span class=\"nazev-elementu\">wmode (průhlednost) transparent</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[seamlessTabbing]\" value=\"true\"%%33%% />
        <span class=\"nazev-elementu\">seamlessTabbing - Povolit opuštění tabulátorem</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[seamlessTabbing]\" value=\"false\"%%34%% />
        <span class=\"nazev-elementu\">seamlessTabbing - Zakázat opuštění tabulátorem</span>
      </label>\n",
*/
                  "admin_vyber_typu_csssprit_default" => array("200x0",
                                                              "",
                                                              "",
                                                              "0 0 0 0",
                                                              "left",
                                                              "transparent",
                                                              "255,255,255"),

                  "admin_vyber_typu_csssprit" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\">
  TypeUpload('%%2%%', 'own', '', '#main_full');
</script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Velikost individuálního obrázku:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#main_full');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><span id=\"main_full\"></span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Popis k prvnímu obrázku:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Popis k druhému obrázku:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Odsazení obrázku:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px]. Zápis hodnot je ve směru ručičkových hodinek: TOP RIGHT BOTTOM LEFT.</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[align]\" value=\"left\"%%6%% />
        <span class=\"nazev-elementu\">Zarovnat obrázky vedle sebe</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[align]\" value=\"top\"%%7%% />
        <span class=\"nazev-elementu\">Zarovnat obrázky pod sebou</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[back]\" value=\"transparent\"%%8%% />
        <span class=\"nazev-elementu\">Průhledné pozadí</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[back]\" value=\"rgb\"%%9%% />
        <span class=\"nazev-elementu\">Barva pozadí</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Barva pozadí:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%10%%\" />
        <span class=\"popis-elementu\">(R,G,B)</span>
      </label>\n",

                  "admin_vyber_typu_externalfile_default" => array("/soubory", 3, "zip,xvid,xml,xls,xhtml,wmv,wma,wav,vob,vcd,txt,ttf,tiff,tif,tga,swf,rtf,rm,rar,psd,ppt,pps,png,pl,pdf,otf,ogg,nrg,mpeg,mpg,mp4,mp3,mov,mds,mdf,swf,js,jpg,jpeg,iso,html,htm,gz,gif,fon,flv,flac,doc,divx,dat,cue,css,bmp,avi,asf,arj,ape,aiff,ace,aac,7z,3gp"),

                  "admin_vyber_typu_externalfile" => "
      <script type=\"text/javascript\" src=\"%%1%%\"></script>
      <label class=\"f-text w-500 ow-h\">
        <span class=\"nazev-elementu\">Adresa složky:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%2%%\" class=\"diradresa\" />
        <span class=\"popis-elementu block ow-h\"><a href=\"#\" onclick=\"OvereniExistence($('.diradresa').val(), '.diradresa'); return false;\" title=\"Zkontrolovat existenci složky\" class=\"block fl-l odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-20 no-u\">Zkontrolovat existenci složky</a></span>
        <span class=\"diradresa block fl-l nadpis-1 barva-1 m-t-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-20\"></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximum souborů:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%3%%\" />
        <span class=\"popis-elementu\">0 = neomezeně</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Povolené tipy přípon:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"konfigurace[]\" value=\"confdel\" onclick=\"$('#hide_confdel').attr('disabled', !this.checked);\"%%5%% />
        <span class=\"nazev-elementu\">Povolit mazání souborů</span>
      </label>
      <input type=\"hidden\" name=\"konfigurace[]\" value=\"\" id=\"hide_confdel\"%%6%% />\n",

                  "ajax_fileexists" => "%%1%%%%2%%",

                  "ajax_fileexists_stav" => array("<span class=\"tlacitko-1 m-b-3\"><span class=\"tlacitko-pattern\"><!-- --></span><span class=\"tlacitko-text\">Neexistuje !</span></span>", "<span class=\"tlacitko-3 m-b-3\"><span class=\"tlacitko-pattern\"><!-- --></span><span class=\"tlacitko-text\">Existuje</span></span>"),

                  "set_typ_elementu" => array("header" => "Nadpis oddílu",
                                              "specheader" => "Zvýrazněný popis",
                                              "minitext" => "Krátký text",
                                              "minitextlite" => "Krátký text bez zkracovaní",
                                              "fulltext" => "Dlouhý text",
                                              "fulltextlite" => "Dlouhý text bez zkracovaní",
                                              "wymeditorlite" => "WYM editor",
                                              "tinymce" => "TinyMCE editor",
                                              "hiddentext" => "Skrytý text",
                                              "datum" => "Datum",
                                              "cas" => "Čas",
                                              "datumcas" => "Datum a čas",
                                              "foto" => "Fotka s miniaturou",
                                              "onefoto" => "Fotka bez miniatury",
                                              "seriefoto" => "Série fotek s miniaturami",
                                              "oneseriefoto" => "Série fotek bez miniatur",
                                              "checkbox" => "Checkbox",
                                              "checkgroup" => "Skupina checkboxů",
                                              "radio" => "Radio buttony",
                                              "radiocontent" => "Přepínatelný odlišný obsah v šabloně",
                                              "select" => "Select",
                                              "download" => "Download",
                                              "automazani" => "Auto mazání CRON",
                                              "conectmodule" => "Připojení externího modulu",
                                              //"flash" => "Flash",
                                              "csssprit" => "CSS sprit",
                                              "rewrite" => "Rewrite adresa obsahu",
                                              "url" => "Url adresa",
                                              "adrescontent" => "Odlišný obsah v šabloně",
                                              "externalfile" => "Soubory z předdefinované složky",
                                              //"upload" => "Upload souboru (neni)",
                                              //"pdfprint" => "PDF tisk obsahu pro uzivatele (neni)",
                                              ),

                  "set_typ_vstupu" => array("string" => "Text",
                                            "integer" => "Celé číslo",
                                            "float" => "Desetinné číslo",
                                            "reg_exp" => "Regulární výraz"),

                  "admin_vypis_obsah_sablony_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Žádný obsah</div>",

                  "admin_addeditobsah_null" => "<div class=\"nadpis-2 f-s-16 m-t-10 p-t-10 p-b-10 t-a-c f-f-web-pro\">Nejsou nastaveny elementy pro šablonu obsahu</div>",

                  "admin_obsah_sablony_add" => "
  <a href=\"%%1%%\" title=\"Přidat obsah\" class=\"addobsah tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat obsah</span>
  </a>\n",

                  "admin_obsah_sablony" => "
<div class=\"obal_dyncent__%%1%%\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%3%%</h3>
    <h4 class=\"pod-nadpis-sekce f-s-17 f-f-web-pro\">%%4%%<!-- --></h4>
  </div>
%%2%%
  <div class=\"cl-b pos-rel\">
    %%5%%
  </div>
</div>\n",

                  "admin_addeditobsah_add" => "Přidat obsah",

                  "admin_addeditobsah_edit" => "Upravit obsah",

                  "admin_addeditobsah" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/wymeditor/jquery.wymeditor.min.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/tiny_mce/jquery.tinymce.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/prettyComments.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/gallery-preview.js\"></script>
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('.wymeditor').wymeditor({
      skin: 'default',
      lang: 'cs',
      postInit: function(wym) {
        wym.hovertools();
      },
      dialogFeatures: \"menubar=no,titlebar=no,toolbar=no,resizable=no\"
                    + \",width=700,height=300,top=100,left=100\",
      dialogFeaturesPreview: \"menubar=no,titlebar=no,toolbar=no,resizable=no\"
                           + \",scrollbars=yes,width=700,height=400,top=100,left=100\",
      logoHtml:  \"\",
    });
    $(\".wym_status\").css({
      'height': '14px'
    });
    $(\".wym_skin_default .wym_iframe iframe\").css({
      'height': '600px'
    });
    $(\".wym_skin_default .wym_dropdown ul\").css({
      'display': 'block',
      'position': 'relative',
      'border-width': '0 0 1px 1px'
    });
    $(\".wym_skin_default .wym_section h2 span\").css({
      'display': 'none'
    });
    $(\".wym_skin_default .wym_dropdown ul\").css({
      'padding': '5px 5px 5px 3px'
    });
    $(\".wym_skin_default .wym_html textarea\").css({
      'height': '400px'
    });
    $(\".wym_classes\").css({
      'display': 'none'
    });

    $(function() {
        $('.obal_razeni').sortable({
                          tolerance: 'pointer',
                          scroll: true,
                          scrollSensitivity: 40,
                          scrollSpeed: 30,
                          revert: 300,
                          opacity: 0.6,
                          cursor: 'move',
                          delay: 150,
                          update: function() {
          ZpracujHlasku('.status_drag');
        }
      });
    });
  });

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }
</script>
<div class=\"obal_pattern\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%3%%</h3>
  </div>
  <a href=\"%%9%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\" class=\"cl-b formular pos-rel\">
    <fieldset>
%%8%%
%%4%%
%%5%%
%%7%%
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\"%%6%% value=\"%%3%%\" class=\"wymupdate\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addeditobsah_header" => "
<div class=\"nadpis-1 w-690 m-b-15 p-t-10 p-r-7 p-b-10 p-l-10 f-s-22 f-f-web-pro b ow-h\">
  <span class=\"block\">%%1%%</span>
  <span class=\"block fl-l barva-6 f-s-14 no-b m-t-2\">%%2%%<!-- --></span>
  <span class=\"block fl-l barva-6 f-s-14 no-b m-t-2 cl-b\">%%3%%<!-- --></span>
</div>\n",

                  "admin_addeditobsah_specheader" => "
<div class=\"central_tip_specheader m-b-15\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>%%1%%</h3>
    <h4>%%2%%<!-- --></h4>
    <p>%%3%%<!-- --></p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_select_menu" => "
      <label class=\"f-select w-505\">
        <span class=\"nazev-elementu\">Vyber menu:</span>
        <select name=\"menu\">
%%1%%
        </select>
      </label>\n",

                  "admin_select_menu_row" => "  <option value=\"%%1%%\"%%2%%>%%4%% %%3%%</option>\n",

                  "admin_select_menu_null" => "<option>--- Není vytvořeno menu ---</option>",

                  "admin_skryta_sekce_addedit_obsah" => "\n%%1%%\n%%2%%\n",

                  "admin_skryta_sekce_addedit_obsah_element" => "
      <label class=\"%%5%%\">
        <input type=\"checkbox\"%%2%% onclick=\"$('#hide_%%1%%').val('%%1%%:'+(!this.checked));\" />
        <span class=\"nazev-elementu\">%%4%%</span>
      </label>
      <input type=\"hidden\" id=\"hide_%%1%%\" name=\"konfig[]\" value=\"%%1%%:%%3%%\" />\n",

                  "admin_addeditobsah_minitext" => "
      <label class=\"f-text m-b-3-i w-500%%9%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\"%%4%% />
        <span class=\"popis-elementu block ow-h\">%%10%%%%8%%<!-- --></span>
        <span class=\"popis-elementu block ow-h\"><a href=\"#\" onclick=\"NahledTextu(%%7%%, $('.hodnota%%2%%').val(), $('.delka%%2%%').val(), $('.zkrac%%2%%').val(), '#nahled_text%%2%%'); return false;\" title=\"Náhled\" class=\"block fl-l odkaz-1 m-r-3 p-r-3 p-l-3 f-s-12 f-f-web-pro l-h-16 no-u\">Náhled:</a> <span id=\"nahled_text%%2%%\"></span></span>
      </label>
      <label class=\"f-text w-500 m-b-3-i\">
        <span class=\"nazev-elementu\">Zkracování textu po:</span>
        <input type=\"text\" name=\"%%2%%[delka]\" value=\"%%5%%\" class=\"delka%%2%%\" />
        <span class=\"popis-elementu\">0 = nezkracuje text</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"%%2%%[zkrac]\" value=\"%%6%%\" class=\"zkrac%%2%%\" />
      </label>\n",

                  "admin_addeditobsah_minitextlite" => "
      <label class=\"f-text w-500%%6%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" class=\"hodnota%%2%%\"%%4%% />
        <span class=\"popis-elementu block ow-h\">%%7%%%%5%%<!-- --></span>
      </label>\n",

                  "admin_addeditobsah_fulltext" => "
      <script type=\"text/javascript\">
        $(function() {
          $('.fulltext%%2%%').prettyComments({
            maxHeight: %%5%%
          });
        });
      </script>
      <label class=\"f-textarea m-b-3-i w-500%%11%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <textarea name=\"%%2%%[value]\" rows=\"15\" cols=\"60\" class=\"hodnota%%2%% fulltext%%2%% h-%%4%%\"%%6%%>%%3%%</textarea>
        <span class=\"popis-elementu block ow-h\">%%12%%%%10%%<!-- --></span>
        <span class=\"popis-elementu block ow-h\"><a href=\"#\" onclick=\"NahledTextu(%%9%%, $('.hodnota%%2%%').val(), $('.delka%%2%%').val(), $('.zkrac%%2%%').val(), '#nahled_text%%2%%'); return false;\" title=\"Náhled\" class=\"block fl-l odkaz-1 m-r-3 p-r-3 p-l-3 f-s-12 f-f-web-pro l-h-16 no-u\">Náhled:</a> <span id=\"nahled_text%%2%%\"></span></span>
      </label>
      <label class=\"f-text w-500 m-b-3-i\">
        <span class=\"nazev-elementu\">Zkracování textu po:</span>
        <input type=\"text\" name=\"%%2%%[delka]\" value=\"%%7%%\" class=\"delka%%2%%\" />
        <span class=\"popis-elementu\">0 = nezkracuje text</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zakončení zkráceného textu:</span>
        <input type=\"text\" name=\"%%2%%[zkrac]\" value=\"%%8%%\" class=\"zkrac%%2%%\" />
      </label>\n",

                  "admin_addeditobsah_fulltextlite" => "
      <script type=\"text/javascript\">
        $(function() {
          $('.fulltext%%2%%').prettyComments({
            maxHeight: %%5%%
          });
        });
      </script>
      <label class=\"f-textarea w-500%%8%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <textarea name=\"%%2%%[value]\" rows=\"15\" cols=\"60\" class=\"hodnota%%2%% fulltext%%2%% h-%%4%%\"%%6%%>%%3%%</textarea>
        <span class=\"popis-elementu block ow-h\">%%9%%%%7%%<!-- --></span>
      </label>\n",

                  "admin_addeditobsah_wymeditorlite" => "
      <div class=\"f-wysiwyg%%6%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <textarea name=\"%%2%%[value]\" rows=\"20\" cols=\"60\" class=\"hodnota%%2%% wymeditor\"%%4%%>%%3%%</textarea>
        <span class=\"popis-elementu block ow-h\">%%7%%%%5%%<!-- --></span>
      </div>",

                  "admin_addeditobsah_tinymce" => "
      <script type=\"text/javascript\">
        $(document).ready(function(){
          $('.hodnota%%2%%').tinymce({
            // Location of TinyMCE script
            script_url : '%%3%%/script/tiny_mce/tiny_mce.js',

            language : 'cs',

            // General options
            theme : \"advanced\",
            plugins : \"pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist\",

            //,imagemanager
            //document_base_url : 'http://tinymce.moxiecode.com/',
            //document_base_url : 'http://soubory.gfdesign.cz/',

            // Theme options
            theme_advanced_buttons1 : \"newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect\",
            theme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor\",
            theme_advanced_buttons3 : \"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen\",
            theme_advanced_buttons4 : \"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak\",
            theme_advanced_toolbar_location : \"top\",
            theme_advanced_toolbar_align : \"left\",
            theme_advanced_statusbar_location : \"bottom\",
            theme_advanced_resizing : true,

            // Example content CSS (should be your site CSS)
            //content_css : \"css/content.css\",

            // Drop lists for link/image/media/template dialogs
            template_external_list_url : \"lists/template_list.js\",
            external_link_list_url : \"lists/link_list.js\",
            external_image_list_url : \"lists/image_list.js\",
            media_external_list_url : \"lists/media_list.js\",

            // Replace values for the template plugin
            template_replace_values : {
              username : \"Some User\",
              staffid : \"991234\"
            }
          });
        });
      </script>
      <div class=\"f-wysiwyg%%7%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <textarea name=\"%%2%%[value]\" rows=\"20\" cols=\"60\" class=\"hodnota%%2%%\"%%5%%>%%4%%</textarea>
        <span class=\"popis-elementu block ow-h\">%%8%%%%6%%<!-- --></span>
      </div>\n",

                  "admin_addeditobsah_hiddentext" => "<input type=\"hidden\" name=\"%%2%%[value]\" value=\"%%3%%\" />\n",

                  "admin_addeditobsah_adrescontent" => "<input type=\"hidden\" name=\"%%2%%[value]\" value=\"%%3%%\" />\n",

                  "admin_addeditobsah_datum" => "
      <script type=\"text/javascript\">
        $(document).ready(function(){
          $('#f-datepicker-%%2%%').AnyTime_picker({
            format: '%%8%%',
            labelDayOfMonth: 'Dny v měsíci',
            labelHour: 'Hodiny',
            labelMinute: 'Minuty',
            labelMonth: 'Měsíce',
            labelSecond: 'Sekundy',
            labelTitle: '%%1%%',
            labelYear: 'Roky',
            firstDOW: 1,
            dayAbbreviations: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
            monthAbbreviations: ['Leden','Únor','Březen','Duben','Květen','Červen','Červenec','Srpen','Září','Říjen','Listopad','Prosinec']
          });
        });
      </script>
      <label class=\"f-text w-500%%10%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" id=\"f-datepicker-%%2%%\" class=\"hodnota%%2%%\" />
        <span class=\"popis-elementu block ow-h\">%%11%%%%9%%<!-- --></span>
        <span class=\"popis-elementu block ow-h\"><a href=\"#\" onclick=\"NahledData($('.hodnota%%2%%').val(), '%%4%%', '%%5%%', '%%6%%', '%%7%%', '#nahled_datum%%2%%'); return false;\" title=\"Náhled\" class=\"block fl-l odkaz-1 m-r-3 p-r-3 p-l-3 f-s-12 f-f-web-pro l-h-16 no-u\">Náhled:</a> <span id=\"nahled_datum%%2%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_cas" => "
      <script type=\"text/javascript\">
        $(document).ready(function(){
          $('#f-timepicker-%%2%%').AnyTime_picker({
              format: '%%5%%',
              labelDayOfMonth: 'Dny v měsíci',
              labelHour: 'Hodiny',
              labelMinute: 'Minuty',
              labelMonth: 'Měsíce',
              labelSecond: 'Sekundy',
              labelTitle: '%%1%%',
              labelYear: 'Roky',
              firstDOW: 1,
              dayAbbreviations: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
              monthAbbreviations: ['Leden','Únor','Březen','Duben','Květen','Červen','Červenec','Srpen','Září','Říjen','Listopad','Prosinec']
            });
          });
      </script>
      <label class=\"f-text w-500%%7%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" id=\"f-timepicker-%%2%%\" class=\"hodnota%%2%%\" />
        <span class=\"popis-elementu block ow-h\">%%8%%%%6%%<!-- --></span>
        <span class=\"popis-elementu block ow-h\"><a href=\"#\" onclick=\"NahledCasu($('.hodnota%%2%%').val(), '%%4%%', '#nahled_datum%%2%%'); return false;\" title=\"Náhled\" class=\"block fl-l odkaz-1 m-r-3 p-r-3 p-l-3 f-s-12 f-f-web-pro l-h-16 no-u\">Náhled:</a> <span id=\"nahled_datum%%2%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_datumcas" => "
      <script type=\"text/javascript\">
        $(document).ready(function(){
          $('#f-datetimepicker-%%2%%').AnyTime_picker({
            format: '%%8%%',
            labelDayOfMonth: 'Dny v měsíci',
            labelHour: 'Hodiny',
            labelMinute: 'Minuty',
            labelMonth: 'Měsíce',
            labelSecond: 'Sekundy',
            labelTitle: '%%1%%',
            labelYear: 'Roky',
            firstDOW: 1,
            dayAbbreviations: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
            monthAbbreviations: ['Leden','Únor','Březen','Duben','Květen','Červen','Červenec','Srpen','Září','Říjen','Listopad','Prosinec']
          });
        });
      </script>
      <label class=\"f-text w-500%%10%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" value=\"%%3%%\" id=\"f-datetimepicker-%%2%%\" class=\"hodnota%%2%%\" />
        <span class=\"popis-elementu block ow-h\">%%11%%%%9%%<!-- --></span>
        <span class=\"popis-elementu block ow-h\"><a href=\"#\" onclick=\"NahledData($('.hodnota%%2%%').val(), '%%4%%', '%%5%%', '%%6%%', '%%7%%', '#nahled_datum%%2%%'); return false;\" title=\"Náhled\" class=\"block fl-l odkaz-1 m-r-3 p-r-3 p-l-3 f-s-12 f-f-web-pro l-h-16 no-u\">Náhled:</a> <span id=\"nahled_datum%%2%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_checkbox" => "
<label class=\"f-checkbox w-500%%5%%\">
  <input type=\"checkbox\" name=\"%%2%%[value]\"%%3%% />
  <span class=\"nazev-elementu\">%%1%%</span>
  <span class=\"popis-elementu block ow-h cl-b\">%%6%%%%4%%<!-- --></span>
</label>\n",

                  "admin_addeditobsah_checkgroup_row_zalomeni" => "
</div>
<div class=\"w-355 fl-r\">\n",


                  "admin_addeditobsah_checkgroup_row" => "
<label class=\"f-checkbox w-355 m-b-3-i\">
  <input type=\"checkbox\" name=\"%%2%%[value][%%3%%]\" value=\"%%4%%\"%%5%% />
  <span class=\"nazev-elementu\">%%1%%</span>
</label>
%%6%%\n",

                  "admin_addeditobsah_checkgroup" => "
<div class=\"ow-h\">
  <label class=\"f-obsah w-710 m-b-3-i\">
    <span class=\"nazev-elementu m-b-5-i u\">%%1%%:</span>
  </label>
  <div class=\"w-355 fl-l\">
%%2%%
  </div>
  <label class=\"f-checkbox w-710%%4%%\">
    <span class=\"popis-elementu cl-b\">%%5%%%%3%%<!-- --></span>
  </label>
</div>\n",

                  "admin_addeditobsah_radio_row_zalomeni" => "
</div>
<div class=\"w-355 fl-r\">\n",

                  "admin_addeditobsah_radio_row" => "
<label class=\"f-radiobutton w-355 m-b-3-i\">
  <input type=\"radio\" name=\"%%2%%[value]\" value=\"%%3%%\"%%4%% />
  <span class=\"nazev-elementu\">%%1%%</span>
</label>
%%5%%\n",

                  "admin_addeditobsah_radio" => "
<div class=\"ow-h\">
  <label class=\"f-obsah w-710 m-b-3-i\">
    <span class=\"nazev-elementu m-b-5-i u\">%%1%%:</span>
  </label>
  <div class=\"w-355 fl-l\">
%%2%%
  </div>
  <label class=\"f-radiobutton w-710%%4%%\">
    <span class=\"popis-elementu cl-b\">%%5%%%%3%%<!-- --></span>
  </label>
</div>\n",

                  "admin_addeditobsah_select_row" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_addeditobsah_select" => "
<label class=\"f-select w-505%%5%%\">
  <span class=\"nazev-elementu\">%%1%%:</span>
  <select name=\"%%2%%[value]\">
    %%3%%
  </select>
  <span class=\"popis-elementu block ow-h\">%%6%%%%4%%<!-- --></span>
</label>\n",

                  "admin_addeditobsah_automazani_row" => "<a href=\"#\" onclick=\"$('.autodel%%2%%').val('%%1%%'); return false;\" title=\"%%3%%\" class=\"block fl-l odkaz-1 m-r-3 p-r-3 p-l-3 f-s-12 f-f-web-pro l-h-16 no-u\">%%3%%</a>",

                  "admin_addeditobsah_automazani" => "
      <script type=\"text/javascript\">
        $(document).ready(function(){
          $('#f-datepicker-%%2%%').AnyTime_picker({
            format: '%d.%m.%Y',
            labelDayOfMonth: 'Dny v měsíci',
            labelHour: 'Hodiny',
            labelMinute: 'Minuty',
            labelMonth: 'Měsíce',
            labelSecond: 'Sekundy',
            labelTitle: '%%1%%',
            labelYear: 'Roky',
            firstDOW: 1,
            dayAbbreviations: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
            monthAbbreviations: ['Leden','Únor','Březen','Duben','Květen','Červen','Červenec','Srpen','Září','Říjen','Listopad','Prosinec']
          });
        });
      </script>
      <label class=\"f-text w-500%%6%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[value]\" class=\"autodel%%2%%\" id=\"f-datepicker-%%2%%\" value=\"%%3%%\" />
        <span class=\"popis-elementu block ow-h\">%%7%%%%5%%<!-- --></span>
        <span class=\"popis-elementu block ow-h\">%%4%%</span>
      </label>\n",

                  "admin_addeditobsah_conectmodule_null" => "Nepodařilo se najít modul !",

                  "admin_addeditobsah_conectmodule" => "
      <label class=\"f-text w-700%%5%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <span class=\"popis-elementu block ow-h\"><strong class=\"block fl-l p-t-2 p-r-3 p-b-2 p-l-3 no-b nadpis-2\">%%3%%</strong></span>
        <span class=\"popis-elementu block ow-h\">%%6%%%%4%%</span>
      </label>\n",

                  "admin_addeditobsah_csssprit" => "
      <label class=\"f-file m-b-3-i w-500%%9%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"file\" name=\"%%2%%[main0]\" />
        <span class=\"popis-elementu block ow-h\">%%10%%%%3%%<!-- --></span>
      </label>
      <label class=\"f-file m-b-3-i w-500%%9%%\">
        <span class=\"nazev-elementu\">%%8%%:</span>
        <input type=\"file\" name=\"%%2%%[main1]\" />
        <span class=\"popis-elementu block ow-h\">%%10%%%%4%%<!-- --></span>
      </label>
      <label class=\"f-file\">
        <img src=\"%%5%%\" alt=\"\" class=\"block\" />
      </label>\n",

                  "admin_addeditobsah_rewrite" => "
      <label class=\"f-text m-b-3-i w-500%%6%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[nazev]\" value=\"%%3%%\" onchange=\"PrepisRewrite(this.value, '.rewrite%%2%%');\" />
        <span class=\"popis-elementu block ow-h\">%%7%%%%5%%<!-- --></span>
      </label>
      <label class=\"f-text w-500%%6%%\">
        <span class=\"nazev-elementu\">%%1%% (v adrese):</span>
        <input type=\"text\" name=\"%%2%%[rewrite]\" value=\"%%4%%\" class=\"rewrite%%2%%\" readonly=\"readonly\" />
        <span class=\"popis-elementu block ow-h\">%%7%%Vyplní se samo. %%5%%<!-- --></span>
      </label>\n",

                  "admin_addeditobsah_url" => "
      <label class=\"f-text m-b-3-i w-500%%7%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"text\" name=\"%%2%%[url]\" value=\"%%3%%\" />
        <span class=\"popis-elementu block ow-h\">%%8%%%%6%%<!-- --></span>
      </label>
      <label class=\"f-text m-b-3-i w-500%%7%%\">
        <span class=\"nazev-elementu\">Popis odkazu:</span>
        <input type=\"text\" name=\"%%2%%[nazev]\" value=\"%%4%%\" />
        <span class=\"popis-elementu block ow-h\">%%8%%%%6%%<!-- --></span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"%%2%%[target]\"%%5%% />
        <span class=\"nazev-elementu\">Otevřít odkaz do nového okna.</span>
      </label>\n",

                  "admin_addeditobsah_externalfile" => "
      <script type=\"text/javascript\">
        ProjdiSlozku('%%2%%', '%%3%%', '%%4%%', '#vypis%%2%%');
        //casem dvojty drag n drop
      </script>
      <label class=\"f-text w-500%%7%% m-b-3-i\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <span class=\"popis-elementu block ow-h\">%%8%%%%6%%<!-- --></span>
      </label>
      <ul id=\"vypis%%2%%\" class=\"f-f-web-pro f-s-14 m-b-15\"></ul>
      <ul class=\"obal_razeni f-f-web-pro f-s-14 m-b-15\">
        <li class=\"p-t-3 p-b-3 ow-h f-s-14\"><span class=\"fl-l barva-4\">Výpis vybraných souborů:</span></li>
        %%5%%
      </ul>
      <div class=\"status_drag\">Bylo změněno pořadí</div>\n",

                  "admin_addeditobsah_externalfile_val_datum" => "d.m.Y / H:i:s",

                  "admin_addeditobsah_externalfile_val" => "<li class=\"nadpis-2 m-t-1 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"block fl-l ow-h w-690 cur-move\"><input type=\"checkbox\" name=\"%%4%%[del][]\" value=\"%%6%%\" class=\"block fl-l m-t-2 m-r-3 cur-poi\" /> %%1%%</span></li><input type=\"hidden\" name=\"%%4%%[list][]\" value=\"%%6%%\"  />",

                  "admin_addeditobsah_externalfile_val_null" => "<li class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vybrán žádný soubor</li>",

                  "ajax_getdir_obal" => "
      <p class=\"f-f-web-pro f-s-14 l-h-18 m-b-5 ow-h\">
        %%1%%
      </p>
      <ul class=\"f-f-web-pro f-s-14\">
        %%3%%
      </ul>\n",

                  "ajax_getdir_adresar" => "<li class=\"nadpis-2 m-t-1 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"block fl-l ow-h w-570\"><a href=\"#\" onclick=\"ProjdiSlozku('%%2%%', '%%3%%/%%1%%', '%%4%%', '#vypis%%2%%'); return false;\" title=\"%%1%%\" class=\"block fl-l no-u odkaz-4\">%%1%%</a></span></li>",

                  "ajax_getdir_soubor_null" => "<li class=\"nadpis-2 f-s-16 m-t-2 p-t-10 p-b-10 t-a-c f-f-web-pro\">Prázdná složka</li>",

                  "ajax_getdir_koren" => "<a href=\"#\" onclick=\"ProjdiSlozku('%%2%%', '%%3%%', '%%4%%', '#vypis%%2%%'); return false;\" title=\"%%1%%\" class=\"block fl-l odkaz-1 m-b-2 p-r-3 p-l-3 no-u\">%%1%%</a>",

                  "ajax_getdir_drobek_href" => "<a href=\"#\" onclick=\"ProjdiSlozku('%%2%%', '%%3%%', '%%4%%', '#vypis%%2%%'); return false;\" title=\"%%1%%\" class=\"block fl-l odkaz-1 m-b-2 p-r-3 p-l-3 no-u\">%%1%%</a>",

                  "ajax_getdir_drobek_text" => "<span class=\"block fl-l m-b-2\">%%1%%</span>",

                  "ajax_getdir_drobek_sep" => "<span class=\"block fl-l m-b-2 p-r-2 p-l-2 f-s-16\">&raquo;</span>",

                  "ajax_getdir_soubor_datum" => "Y.m.d / H:i:s",

                  "ajax_getdir_soubor" => "<li class=\"nadpis-2 m-t-1 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"block fl-l ow-h w-570\"><input type=\"checkbox\" onclick=\"$('#id%%4%%%%5%%').attr('disabled', !this.checked);\"%%7%% class=\"block fl-l m-t-1 m-r-3 cur-poi\" />%%1%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%9%%</span></li><input type=\"hidden\" name=\"%%4%%[soubory][]\" id=\"id%%4%%%%5%%\" value=\"%%6%%\"%%8%%  />",

                  "ajax_getdir_soubor_link" => "<a href=\"%%1%%\" title=\"Opravdu chceš smazat soubor: &quot;%%2%%&quot; ?\" class=\"block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat soubor</a>",

                  "admin_addeditobsah_foto_enable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', '', '<input type=\'file\' name=\'%%1%%[main_mini]\' ><span class=\'popis-elementu block cl-b\'>Když se bude nahrávat miniatura znovu, tak je potřeba nahrát i obrázek v plné velikosti.</span>', '#main_mini%%1%%');
        TypeUpload('%%3%%', 'own', '', '#main_full%%1%%');
      </script>
      <label class=\"f-text w-500 m-b-0-i\">
        <span class=\"nazev-elementu\">Nastavení miniatury:</span>
        <input type=\"text\" name=\"%%1%%[mini]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, '', '<input type=\'file\' name=\'%%1%%[main_mini]\' class=\'input_file\'><span class=\'popis-elementu block cl-b\'>Když se bude nahrávat miniatura znovu, tak je potřeba nahrát i obrázek v plné velikosti.</span>', '#main_mini%%1%%');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost, own = bude požadovat vlastní miniaturu, own->WIDTHxHEIGHT = smazání miniatury.</span>
      </label>
      <label class=\"f-file w-500 m-b-3-i\">
        <span class=\"popis-elementu\"><span id=\"main_mini%%1%%\" class=\"block\"></span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Nastavení plného náhledu:</span>
        <input type=\"text\" name=\"%%1%%[full]\" value=\"%%3%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#main_full%%1%%');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><span id=\"main_full%%1%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_foto_disable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', '', '<input type=\'file\' name=\'%%1%%[main_mini]\' ><span class=\'popis-elementu block cl-b\'>Když se bude nahrávat miniatura znovu, tak je potřeba nahrát i obrázek v plné velikosti.</span>', '#main_mini%%1%%');
        TypeUpload('%%3%%', 'own', '', '#main_full%%1%%');
      </script>
      <label class=\"f-file w-500 m-b-3-i\">
        <span class=\"nazev-elementu\">Nastavení miniatury:</span>
        <span class=\"popis-elementu\"><span id=\"main_mini%%1%%\" class=\"block\"></span></span>
      </label>
      <label class=\"f-file w-500\">
        <span class=\"nazev-elementu\">Nastavení plného náhledu:</span>
        <span class=\"popis-elementu\"><span id=\"main_full%%1%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_foto_default_pic" => "../../no-image.png",

                  "admin_addeditobsah_foto" => "
      <label class=\"f-file w-700%%7%% m-b-3-i ow-h\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"file\" name=\"%%2%%[main]\" />
        <span class=\"popis-elementu block ow-h\">%%8%%%%6%%<!-- --></span>
        <a href=\"%%5%%\" title=\"%%1%%\" class=\"preview block fl-l cl-b ow-h\"><img src=\"%%4%%\" alt=\"%%1%%\" class=\"block m-w-340 m-h-260\" /></a>
      </label>
%%3%%\n",

                  "admin_addeditobsah_onefoto_enable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', 'own', '', '#main_full%%1%%');
      </script>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Nastavení plného náhledu:</span>
        <input type=\"text\" name=\"%%1%%[full]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#main_full%%1%%');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><span id=\"main_full%%1%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_onefoto_disable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', 'own', '', '#main_full%%1%%');
      </script>
      <label class=\"f-file w-500\">
        <span class=\"nazev-elementu\">Nastavení plného náhledu:</span>
        <span class=\"popis-elementu\"><span id=\"main_full%%1%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_onefoto_default_pic" => "../no-image.png",

                  "admin_addeditobsah_onefoto" => "
      <label class=\"f-file w-700%%6%% m-b-3-i ow-h\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"file\" name=\"%%2%%[main]\" />
        <span class=\"popis-elementu block ow-h\">%%7%%%%5%%<!-- --></span>
        <a href=\"%%4%%\" title=\"%%1%%\" class=\"preview block fl-l cl-b ow-h\"><img src=\"%%4%%\" alt=\"%%1%%\" class=\"block m-w-340 m-h-260\" /></a>
      </label>
%%3%%\n",

                  "admin_addeditobsah_seriefoto_enable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini%%1%%');
        TypeUpload('%%3%%', 'own', '', '#full%%1%%');
      </script>
      <label class=\"f-text w-500 m-b-3-i\">
        <span class=\"nazev-elementu\">Nastavení miniatur:</span>
        <input type=\"text\" name=\"%%1%%[mini]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini%%1%%'); Vykresli%%1%%();\" class=\"sourcemini%%1%%\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost, own = bude požadovat vlastní miniaturu, own->WIDTHxHEIGHT = smazání miniatury.<br /><span id=\"mini%%1%%\"></span></span>
      </label>
      <label class=\"f-text w-500 m-b-6-i\">
        <span class=\"nazev-elementu\">Nastavení plných náhledů:</span>
        <input type=\"text\" name=\"%%1%%[full]\" value=\"%%3%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#full%%1%%');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><span id=\"full%%1%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_seriefoto_disable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', '', '<strong>Bude požadovat vlastní miniaturu</strong>', '#mini%%1%%');
        TypeUpload('%%3%%', 'own', '', '#full%%1%%');
      </script>
      <input type=\"hidden\" value=\"%%2%%\" class=\"sourcemini%%1%%\" />
      <label class=\"f-file w-500 m-b-3-i\">
        <span class=\"nazev-elementu\">Nastavení miniatur:</span>
        <span class=\"popis-elementu\"><span id=\"mini%%1%%\"></span></span>
      </label>
      <label class=\"f-file w-500 m-b-6-i\">
        <span class=\"nazev-elementu\">Nastavení plných náhledů:</span>
        <span class=\"popis-elementu\"><span id=\"full%%1%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_seriefoto" => "
      <script type=\"text/javascript\">
        var poc%%2%% = %%5%%;
        function Pridej%%2%%()
        {
          poc%%2%%++;
          Vykresli%%2%%();
        }
        function Odeber%%2%%()
        {
          poc%%2%%--;
          Vykresli%%2%%();
        }
        var pic%%2%% = ['|%%6%%|']; //r
        var popis%%2%% = ['|%%7%%|'];  //r+w
        function PosliData%%2%%(row, polozka, hodnota)
        {
    %%8%%
          switch (polozka)
          {
            case 0:
              popis%%2%%[row] = '|'+roz+'|';
              Vykresli%%2%%();
            break;
          }
        }
        function Vykresli%%2%%()
        {
          $(function() {
            $.post(\"%%4%%/ajax_form.php\",
                  \"action=listseriefoto&pocet=\"+poc%%2%%+\"&name=%%2%%&pocser=%%9%%&mini=\"+$('.sourcemini%%2%%').val()+\"&pic=\"+pic%%2%%+\"&popis=\"+popis%%2%%,
                    function(theResponse)
                    {
                      $('#polozky%%2%%').html(theResponse);
                    }
                  );
            $('.pocetprvku%%2%%').val(poc%%2%%);
            $('#pocet_polozek%%2%%').html(poc%%2%%);
          });
        }
        window.setTimeout(\"Vykresli%%2%%();\", 10);
      </script>
      <label class=\"f-file w-700%%12%% m-b-3-i ow-h\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <span class=\"popis-elementu block ow-h\">%%13%%Nejdříve vyplň u jednotlivých obrázků popis a potom vyber obrázky které se budou nahrávat. %%11%%<!-- --></span>
      </label>
%%3%%
      <p class=\"ow-h\">
        <span class=\"block f-f-web-pro m-b-6\">Počet obrázků: <strong id=\"pocet_polozek%%2%%\" class=\"no-b u\"></strong></span>
        %%10%%
        <input type=\"hidden\" class=\"pocetprvku%%2%%\" name=\"%%2%%[poc]\" />
      </p>
      <div id=\"polozky%%2%%\" class=\"w-700 pos-rel obal-odkazy-pridat-odebrat m-b-15\"></div>\n",

                  "admin_addeditobsah_seriefoto_add" => "<a href=\"#\" onclick=\"Pridej%%1%%(); return false;\" title=\"Přidat obrázek\" class=\"block fl-l odkaz-1 m-b-6 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-20 no-u\">Přidat obrázek</a>",

                  "admin_addeditobsah_seriefoto_default_pic" => "../../no-image.png",

                  "ajax_listseriefoto" => "
      <label class=\"f-file w-500 m-b-3-i ow-h\">
        <span class=\"nazev-elementu\">[%%2%%] Obrázek:</span>
        <input type=\"file\" name=\"%%3%%[main%%1%%]\" />
      </label>
      %%7%%
      <label class=\"f-text w-500 m-b-15-i ow-h\">
        <span class=\"nazev-elementu\">[%%2%%] Popis obrázku:</span>
        <input type=\"text\" name=\"%%3%%[popis%%1%%]\" value=\"%%4%%\" onchange=\"PosliData%%3%%(%%1%%, 0, this.value);\" />
        <a href=\"%%6%%\" title=\"%%2%%\" class=\"preview block fl-l cl-b ow-h m-t-3\"><img src=\"%%5%%\" alt=\"%%2%%\" class=\"block m-w-340 m-h-260\" /></a>
      </label>
      %%8%%\n",

                  "ajax_listseriefoto_own" => "
      <label class=\"f-file w-500 m-b-3-i ow-h\">
        <span class=\"nazev-elementu\">[%%2%%] Miniatura:</span>
        <input type=\"file\" name=\"%%3%%[main%%1%%_mini]\" />
      </label>\n",

                  "ajax_listseriefoto_del" => "<a href=\"#\" onclick=\"Odeber%%1%%(); return false\" title=\"Odebrat obrázek\" class=\"odkaz-odebrat odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-20 no-u\">Odebrat obrázek</a>",

                  "admin_addeditobsah_oneseriefoto_enable" => "
      <script type=\"text/javascript\">
        TypeUpload('%%2%%', 'own', '', '#main_full%%1%%');
      </script>
      <label class=\"f-text w-500 m-b-3-i\">
        <span class=\"nazev-elementu\">Nastavení plného náhledu:</span>
        <input type=\"text\" name=\"%%1%%[full]\" value=\"%%2%%\" onkeyup=\"TypeUpload(this.value, 'own', '', '#main_full%%1%%');\" />
        <span class=\"popis-elementu\">Formát: WIDTHxHEIGHT, 0 = dopočítávání, 0x0 = plná velikost.<br /><span id=\"main_full%%1%%\"></span></span>
      </label>\n",

                  "admin_addeditobsah_oneseriefoto_poc" => "
      <label class=\"f-text w-500 m-b-0-i\">
        <span class=\"nazev-elementu\">Maximální počet obrázků:</span>
        <input type=\"text\" name=\"%%1%%[poc]\" value=\"%%2%%\" />
      </label>\n",

                  "admin_addeditobsah_oneseriefoto_row" => "
<div class=\"ow-h fl-l w-330 h-330 m-t-15 m-l-15 cur-move\">
  <a href=\"%%3%%\" title=\"%%2%%\" class=\"preview block fl-l cl-b ow-h cur-move\"><img src=\"%%3%%\" alt=\"%%2%%\" class=\"block m-w-340 m-h-260\" /></a>
  <label class=\"f-text w-320-i m-b-1-i m-t-0-i\">
    <span class=\"nazev-elementu l-h-20-i\">Popis obrázku:</span>
    <input type=\"text\" name=\"%%1%%[popis][]\" value=\"%%4%%\" />
  </label>
  <a href=\"#\" title=\"Smazat obrázek\" onclick=\"$(this).parent().remove(); return false;\" class=\"block fl-l cl-b f-s-12 f-f-web-pro odkaz-1 p-r-3 p-l-3 no-u\">Smazat obrázek</a>
  <input type=\"hidden\" name=\"%%1%%[old][]\" value=\"%%2%%\" />
</div>\n",

                  "admin_addeditobsah_oneseriefoto" => "
      <label class=\"f-file w-700%%7%% m-b-3-i ow-h\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"file\" name=\"%%2%%[main][]\" multiple=\"multiple\" />
        <span class=\"popis-elementu block ow-h\">%%8%%%%6%%<!-- --></span>
      </label>
%%3%%
%%4%%
<div class=\"obal_razeni m-b-15 ow-h\">
  %%5%%
</div>
<div class=\"status_drag\">Bylo změněno pořadí</div>\n",

                  "admin_addeditobsah_download_row" => "
<div class=\"ow-h fl-l w-330 h-145 m-t-15 m-l-15 cur-move\">
  <a href=\"%%5%%\" title=\"%%2%%\" class=\"preview block cl-b ow-h h-55 l-h-50 m-b-3 f-f-web-pro odkaz-1 nadpis-1 cur-move no-u\">
    <img src=\"%%7%%obr/admin/datovy_sklad_ikony/%%6%%.png\" alt=\"%%2%%\" class=\"block m-t-3 m-l-3\" />
  </a>
  <a href=\"%%5%%\" title=\"%%2%%\" class=\"block fl-l cl-b f-s-12 l-h-16 f-f-web-pro odkaz-1 p-r-3 p-l-3 no-u m-b-2\">
    %%2%%
  </a>
  <label class=\"f-text w-320-i m-b-1-i\">
    <span class=\"nazev-elementu\">Popis:</span>
    <input type=\"text\" name=\"%%1%%[popis][]\" value=\"%%4%%\" />
  </label>
  <a href=\"#\" title=\"Smazat\" onclick=\"$(this).parent().remove(); return false;\" class=\"block fl-l cl-b f-s-12 f-f-web-pro odkaz-1 p-r-3 p-l-3 no-u\">Smazat</a>
  <input type=\"hidden\" name=\"%%1%%[old_name][]\" value=\"%%2%%\" />
  <input type=\"hidden\" name=\"%%1%%[old_file][]\" value=\"%%3%%\" />
</div>\n",

                  "admin_addeditobsah_download" => "
      <label class=\"f-file w-700%%5%% m-b-3-i ow-h\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <input type=\"file\" name=\"%%2%%[soubor][]\" multiple=\"multiple\" />
        <span class=\"popis-elementu block ow-h\">%%6%%%%4%%<!-- --></span>
      </label>
<div class=\"obal_razeni m-b-15 ow-h\">
  %%3%%
</div>
<div class=\"status_drag\">Bylo změněno pořadí</div>\n",
/*
                  "admin_addeditobsah_flash_link" => "
      <label class=\"f-file w-700\">
        <input type=\"text\" name=\"%%1%%[flash]\" value=\"%%2%%\" />
        <span class=\"popis-elementu block ow-h\">link flash animace</span>
      </label>",

                  "admin_addeditobsah_flash_file" => "
      <label class=\"f-file w-700\">
        <input type=\"file\" name=\"%%1%%[flash][]\" />
        <span class=\"popis-elementu block ow-h\">nahrat vlastni flash animaci</span>
        %%2%%
      </label>",

                  "admin_addeditobsah_flash_size" => "
      <label class=\"f-file w-700\">
        <input type=\"text\" name=\"%%1%%[width]\" value=\"%%2%%\" />
        <span class=\"popis-elementu block ow-h\">width animace</span>
      </label>
      <label class=\"f-file w-700\">
        <input type=\"text\" name=\"%%1%%[height]\" value=\"%%3%%\" />
        <span class=\"popis-elementu block ow-h\">height animace</span>
      </label>",

                  "admin_addeditobsah_flash_param" => "
      <label class=\"f-file w-700\">
        <input type=\"text\" name=\"%%1%%[param]\" value=\"%%2%%\" />
        <span class=\"popis-elementu block ow-h\">vlastni parametry animace (klic:hodnota;klic:hodnota;)</span>
      </label>",

                  "admin_addeditobsah_flash" => "
      <label class=\"f-file w-700%%7%%\">
        <span class=\"nazev-elementu\">%%1%%:</span>
        <span class=\"popis-elementu block ow-h\">%%8%%%%6%%<!-- --></span>
        <span class=\"popis-elementu block ow-h\"></span>
      </label>
%%3%%
%%4%%\n",
*/
                  "admin_addeditobsah_povinne" => array("checkbox" => " f-povinny",
                                                        "checkgroup" => " f-povinny",
                                                        "radio" => " f-povinny",
                                                        "select" => " f-povinny",
                                                        "conectmodule" => " f-povinny",
                                                        "minitextlite" => " f-povinny",
                                                        "fulltextlite" => " f-povinny",
                                                        "wymeditorlite" => " f-wysiwyg-povinny",
                                                        "tinymce" => " f-wysiwyg-povinny",
                                                        "minitext" => " f-povinny",
                                                        "fulltext" => " f-povinny",
                                                        "datum" => " f-povinny",
                                                        "datumcas" => " f-povinny",
                                                        "cas" => " f-povinny",
                                                        "automazani" => " f-povinny",
                                                        "foto" => " f-wysiwyg-povinny",
                                                        "onefoto" => " f-wysiwyg-povinny",
                                                        "seriefoto" => " f-wysiwyg-povinny",
                                                        "oneseriefoto" => " f-wysiwyg-povinny",
                                                        "download" => " f-wysiwyg-povinny",
                                                        //"flash" => " f-wysiwyg-povinny",
                                                        "csssprit" => " f-wysiwyg-povinny",
                                                        "rewrite" => " f-povinny",
                                                        "url" => " f-povinny",
                                                        "externalfile" => " f-povinny",
                                                        "adrescontent" => "",
                                                        ),

                  "admin_addeditobsah_not_found" => "
<div class=\"central_tip_error m-b-15\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>CHYBA</h3>
    <p>Kostra této šablony byla oproti originální šabloně změněna !</p>
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>",

                  "admin_addeditobsah_error" => "
<div class=\"central_tip_warning m-b-15\">
  <span class=\"central_tip_top\"><!-- --></span>
  <span class=\"central_tip_pattern\"><!-- --></span>
    <h3>VAROVÁNÍ</h3>
    <h4>Při ukládání nastaly tyto chyby:</h4>
    %%1%%
  <span class=\"central_tip_bottom\"><!-- --></span>
</div>\n",

                  "admin_kontrola_vstupu_error" => "<p>%%2%%<strong>%%1%%</strong></p>\n",

                  "admin_kontrola_vstupu_checkbox" => "Toto zaškrtávací tlačítko je povinné.",

                  "admin_kontrola_vstupu_checkgroup" => "Tato skupina zaškrtávacích tlačítek je povinná.",

                  "admin_kontrola_vstupu_radio" => "Není označeno tlačítko.",

                  "admin_kontrola_vstupu_str_empty" => "Tento formulář nesmí mít prázdný obsah.",

                  "admin_kontrola_vstupu_str_minmax" => "Text v tomto formuláři neodpovídá minimálnímu nebo maximálnímu rozsahu.",

                  "admin_kontrola_vstupu_str_min" => "Text v tomto formuláři nedosáhl minimálního rozsahu.",

                  "admin_kontrola_vstupu_str_max" => "Text v tomto formuláři přesáhl maximální rozsah.",

                  "admin_kontrola_vstupu_val_null" => "Tento formulář nesmí mít prázdný obsah.",

                  "admin_kontrola_vstupu_val_minmax" => "Číslo v tomto formuláři neodpovídá minimálnímu nebo maximálnímu rozsahu.",

                  "admin_kontrola_vstupu_val_min" => "Číslo v tomto formuláři nedosáhlo minimálního rozsahu.",

                  "admin_kontrola_vstupu_val_max" => "Číslo v tomto formuláři přesáhlo maximální rozsah.",

                  "admin_kontrola_vstupu_reg_exp" => "Vámi zadaný obsah neodpovídá předpokládanému tvaru.",

                  "admin_kontrola_vstupu_datum" => "Vámi zadaný formát datumu neodpovídá předpokládanému tvaru.",

                  "admin_kontrola_vstupu_cas_datumcas" => "Vámi zadaný formát datumu / času neodpovídá předpokládanému tvaru.",

                  "admin_kontrola_vstupu_foto" => "Obrázek je povinný.",

                  "admin_kontrola_vstupu_foto_mini" => "Miniatura je povinná.",

                  "admin_kontrola_vstupu_foto_dim" => "Formulář pro nastavení velikosti nesmí být prázdný.",

                  "admin_kontrola_vstupu_onefoto" => "Obrázek je povinný.",

                  "admin_kontrola_vstupu_onefoto_dim" => "Formulář pro nastavení velikosti nesmí být prázdný.",

                  "admin_kontrola_vstupu_seriefoto" => "Obrázek je povinný.",

                  "admin_kontrola_vstupu_seriefoto_mini" => "Miniatura je povinná.",

                  "admin_kontrola_vstupu_seriefoto_dim" => "Formulář pro nastavení velikosti nesmí být prázdný.",

                  "admin_kontrola_vstupu_oneseriefoto" => "Obrázek je povinný.",

                  "admin_kontrola_vstupu_oneseriefoto_dim" => "Formulář pro nastavení velikosti nesmí být prázdný.",

                  "admin_kontrola_vstupu_download" => "Soubor je povinný.",

                  "admin_kontrola_vstupu_externalfile" => "Soubor je povinný.",
/*
                  "admin_kontrola_vstupu_flash_link" => "Link flashe je povinny.",

                  "admin_kontrola_vstupu_flash_file" => "Soubor flashe je povinny.",

                  "admin_kontrola_vstupu_flash_dim" => "Pole pro nastavení velikosti nesmí být prázdné.",
*/
                  "admin_kontrola_vstupu_csssprit" => "Obrázky jsou povinné.",

                  "admin_kontrola_vstupu_csssprit_type" => "Povolené formáty obrázků jsou jen PNG nebo JPG.",

                  "admin_kontrola_vstupu_rewrite" => "Adresa je povinná.",

                  "admin_kontrola_vstupu_url" => "Popis a adresa odkazu jsou povinné.",

                  "admin_vyber_obsah_sablony" => "
      <label class=\"f-select w-505\">
        <span class=\"nazev-elementu\">Výběr šablony:</span>
<select name=\"sablona\" onchange=\"document.location.href='%%1%%__'+this.value+'&amp;%%2%%'\">
%%3%%
</select>
        <span class=\"popis-elementu\">Zobrazuje jen stejné kopie šablon. Zvol jen v případě, že chceš tento obsah umístnit v jiné šabloně.</span>
      </label>",

                  "admin_vyber_obsah_sablony_row" => "  <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vyber_obsah_sablony_null" => "Není vytvořena stejná šablona.",

                  "admin_vyber_obsah_sablony_hidden" => "<input type=\"hidden\" name=\"sablona\" value=\"%%1%%\" />",

                  "set_znacka_povinne" => "<span class=\"f-povinny-popis\">Povinná položka.</span> ",

                  "admin_vypis_konfigurace_obsahu" => "<li class=\"polozka-1-%%1%% p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%2%%:</span><span class=\"fl-r\"><input type=\"checkbox\" disabled=\"disabled\"%%3%% class=\"block m-t-2\" /></span></li>",

                  "admin_vypis_obsah_sablony_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_obsah_sablony_datum_null" => "Obsah nebyl zatím upraven",

                  "admin_vypis_obsah_sablony_checkgroup" => ", ",

                  "admin_vypis_obsah_sablony_seriefoto" => "
%%1%% - (1)<br />
%%2%% - (2)<br />
%%3%% - (3)<br />
                  ",

                  "admin_vypis_obsah_sablony_oneseriefoto" => "
%%1%% - (1)<br />
%%2%% - (2)<br />
                  ",

                  "admin_vypis_obsah_sablony_download" => "
%%1%% - (1)<br />
%%2%% - (2)<br />
%%3%% - (3)<br />
%%4%% - (4)<br />
%%5%% - (5)<br />
%%6%% - (6)<br />
                  ",

                  "admin_vypis_obsah_sablony_externalfile_datum" => "d.m.Y H:i:s",

                  "admin_vypis_obsah_sablony_externalfile" => "
%%1%% - (1)<br />
%%2%% - (2)<br />
%%3%% - (3)<br />
%%4%% - (4)<br />
%%5%% - (5)<br />
%%6%% - (6)<br />
                  ",


                  "admin_vypis_obsah_sablony_begin" => "
<script type=\"text/javascript\">
  $(document).ready(function(){
    $(function() {
      $(\".obal_razeni\").sortable({
                          tolerance: 'pointer',
                          scroll: true,
                          scrollSensitivity: 40,
                          scrollSpeed: 30,
                          revert: 300,
                          opacity: 0.6,
                          cursor: 'move',
                          delay: 150,
                          update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updateobsah&direct=%%2%%';
        $.post(\"%%1%%/ajax_form.php\", order, function(theResponse){
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
</script>
<div class=\"obal_razeni\">\n",

                  "admin_vypis_obsah_sablony_copy" => "<a href=\"%%1%%\" title=\"Duplikovat obsah\" class=\"copyobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Duplikovat obsah</a>",

                  "admin_vypis_obsah_sablony_del" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat obsah: &quot;%%1%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat obsah</a>",

                  "admin_vypis_obsah_sablony_editelemobsah" => "<a href=\"%%1%%\" title=\"Duplikovat obsah\" class=\"block fl-l m-r-5 m-l-5 no-u odkaz-4\">[ Upravit elementy v sabloně ]</a>",

                  "admin_vypis_obsah_sablony" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">[%%1%%]</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit obsah\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit obsah</a>%%7%%%%8%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%10%% - (10)</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%11%% - (11)</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%12%% - (12)</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%13%% - (13)</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%14%% - (14)</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%15%% - (15)</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%16%% - (16)</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%17%% - (17)</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%18%% - (18)</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%19%% - (19)</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%20%% - (20)</span></li>
</ul>\n",

                  "admin_vypis_obsah_sablony_end" => "\n</div>\n<div id=\"status_drag\"></div>\n",


                  "ajax_updateobsah" => "Bylo změněno pořadí",

                  "ajax_updateobsah_not_permit" => "Nemáte oprávnění",

                  "set_maxsizepic" => 32,

                  "set_pathpicture" => "obrazky",

                  "set_minidir" => "mini",

                  "set_fulldir" => "full",

                  "set_pathfile" => "soubory",

                  "set_get_menu" => "menu",

                  "set_get_down" => "down",

                  "ajaxscript" => "
function PrepisRewrite(text, ret)
{
%%3%%
  $.post(\"%%2%%/ajax_form.php\",
        \"action=rewritename&text=\"+roz,
          function(theResponse)
          {
            $(ret).val(theResponse);
          }
        );
}

function NahledData(datum, format, dny, mesice, tvar, ret)
{
  $(function() {
    $.post(\"%%2%%/ajax_form.php\",
          \"action=gendate&datum=\"+datum+\"&format=\"+format+\"&dny=\"+dny+\"&mesice=\"+mesice+\"&tvar=\"+tvar,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function NahledCasu(datum, format, ret)
{
  $(function() {
    $.post(\"%%2%%/ajax_form.php\",
          \"action=gentime&datum=\"+datum+\"&format=\"+format,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function NahledTextu(id, text, delka, zkraceni, ret)
{
  $(function() {
    $.post(\"%%2%%/ajax_form.php\",
          \"action=gentext&id=\"+id+\"&text=\"+text+\"&delka=\"+delka+\"&zkraceni=\"+zkraceni,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function OvereniExistence(cesta, ret)
{
  $(function() {
    $.post(\"%%2%%/ajax_form.php\",
          \"action=fileexists&cesta=\"+cesta,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function ProjdiSlozku(name, cesta, data, ret)
{
  $(function() {
    $.post(\"%%2%%/ajax_form.php\",
          \"action=getdir&name=\"+name+\"&cesta=\"+cesta+\"&data=\"+data,
            function(theResponse)
            {
              $(ret).html(theResponse);
            }
          );
  });
}

function TypeUpload(value, blok, input, ret)
{
  $(function() {
    if (value == 'own' && value != blok)
    {
      $(ret).html(input); //vlozeni upload inputu
    }
      else
    {
      $(ret).html('');
      roz = value.split('x'); //rozdeleni podle x
      w = parseInt(roz[0]); //parsnuti velikosti
      h = parseInt(roz[1]);

      if (!isNaN(w) && !isNaN(h))
      {
        if (w == 0 && h == 0)
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Ponechá originální velikost</strong></span>');
          return;
        }

        if (w == 0)
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Délka se dopočítává, výška je nastavena</strong></span>');
          return;
        }

        if (h == 0)
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Délka je nastavena, výška se dopočítává</strong></span>');
          return;
        }

        if (w != 0 && h != 0)
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Délka je nastavena, výška je nastavena</strong></span>');
          return;
        }
      }
        else
      {
        if (value == 'own')
        {
          $(ret).html('<span class=\'popis-elementu\'><strong>Tato funkce je zakázána !</strong></span>');
          return;
        }
          else
        {
          roz1 = value.split('->');
          if (roz1[0] == 'own')
          {
            roz = roz1[1].split('x'); //rozdeleni podle x
            w = parseInt(roz[0]); //parsnuti velikosti
            h = parseInt(roz[1]);

            if (!isNaN(w) && !isNaN(h))
            {
              if (w == 0 && h == 0)
              {
                $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Ponechá originální velikost</strong></span>');
                return;
              }

              if (w == 0)
              {
                $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Délka se dopočítává, výška je nastavena</strong></span>');
                return;
              }

              if (h == 0)
              {
                $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Délka je nastavena, výška se dopočítává</strong></span>');
                return;
              }

              if (w != 0 && h != 0)
              {
                $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Délka je nastavena, výška je nastavena</strong></span>');
                return;
              }
            }
              else
            {
              $(ret).html('<span class=\'popis-elementu\'><strong>Miniatura bude odstraněna a Špatný zápis !</strong></span>');
              return;
            }
          }
            else
          {
            $(ret).html('<span class=\'popis-elementu\'><strong>Špatný zápis !</strong></span>');
            return;
          }
        }
      }
    }
  });
}",
                  );

  return $result;
?>
