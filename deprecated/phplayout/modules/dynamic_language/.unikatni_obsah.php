<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace jazyků",
                                              "title" => "Administrace jazyků"),
                                        ),

                  "admin_permit" => array("%%1%%" => array("" => "Výpis jazyků", "addlang" => "Přidat jazyk", "editlang" => "Upravit jazyk", "dellang" => "Smazat jazyk"),
                                          ),

                  "name_module" => array ("Administrace jazyků",
                                          "Administrace jazyků"),

                  "rewrite_url_seznam_jazyku_1" => "%%1%%jazyk-%%2%%",

/* - - - - - - - - - - Normal výpis - - - - - - - - - - */

                  "normal_sezam_jazyku_nohref_1" => "<span class=\"%%3%%%%6%%\"><span>%%2%%</span></span>\n",

                  "normal_seznam_jazyku_1" => "<a href=\"%%1%%\" title=\"%%2%%\" class=\"%%3%%\"><span>%%2%%</span></a>\n",

                  "normal_seznam_jazyku_null_1" => "žádný jazyk",

                  "normal_seznam_jazyku_changelang_1" => "",

                  "normal_vyber_jazyka_select_1" => "
<select name=\"jazyk\">
  %%1%%
</select>\n",

                  "normal_vyber_jazyka_aktivni_1" => " selected=\"selected\"",

                  "normal_vyber_jazyka_select_row_1" => "<option value=\"%%1%%\"%%4%%>%%2%% - %%3%%</option>\n",

                  "normal_vyber_jazyka_select_null_1" => "žádný jazyk",

                  "normal_jazyk_podle_id_1" => "žádný název neexistuje",

                  "normal_zkratka_podle_id_1" => "žádný název neexistuje",

/* - - - - - - - - - - /Normal výpis - - - - - - - - - - */

                  "admin_obsah" => "
<div class=\"obal_dynlang\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Administrace jazyků</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat jazyk\" class=\"addlang tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat jazyk</span>
  </a>
  <div class=\"cl-b\">
    %%2%%
  </div>
</div>\n",

                  "admin_addeditlang_add" => "Přidat jazyk",

                  "admin_addeditlang_edit" => "Upravit jazyk",

                  "admin_addeditlang" => "
<div class=\"obal_dynlang\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%% %%2%%</h3>
  </div>
  <a href=\"%%5%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Název jazyka:</span>
        <input type=\"text\" name=\"jazyk\" value=\"%%2%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zkratka jazyka:</span>
        <input type=\"text\" name=\"zkratka\" value=\"%%3%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Zkratka auto-volby jazyka:</span>
        <input type=\"text\" name=\"autovolba\" value=\"%%4%%\" />
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_vypis_obsah" => "
<ul class=\"obal_dynlang f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-2 f-s-16 p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%2%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%5%%\" class=\"editlang block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit jazyk\">Upravit jazyk</a><a href=\"%%6%%\" title=\"Opravdu chceš smazat jazyk: &quot;%%2%%&quot; ?\" class=\"dellang confirm block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat jazyk</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zkratka jazyka:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Zkratka auto-volby jazyka:</span><span class=\"fl-r barva-5\">%%4%%</span></li>
</ul>\n",

                  "admin_vypis_obsah_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořen žádný jazyk</div>",

                  "set_ozn_jazyk_l" => "",

                  "set_ozn_jazyk_r" => "",

                  "set_ozn_jazyk_class" => " %%3%%_aktivni",

                  "set_cookie_name" => "LANG",

                  "set_adrname" => "sub",

                  "set_adrchange" => "changelang",

                  "set_idlang" => "id",

                  );

  return $result;
?>