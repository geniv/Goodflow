<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Nastavení htaccess",
                                              "title" => "Nastavení htaccess",),
                                        ),

                  "control_preinstall" => array("htaccess" => array(array("id" => 1,
                                                                          "rewrite" => "Options -Indexes",
                                                                          "popis" => "Zakazování zobrazení složek",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 1),

                                                                    array("id" => 2,
                                                                          "rewrite" => "ErrorDocument 400 /error_page/400.html",
                                                                          "popis" => "Error page 400",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 2),

                                                                    array("id" => 3,
                                                                          "rewrite" => "ErrorDocument 401 /error_page/401.html",
                                                                          "popis" => "Error page 401",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 3),

                                                                    array("id" => 4,
                                                                          "rewrite" => "ErrorDocument 403 /error_page/403.html",
                                                                          "popis" => "Error page 403",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 4),

                                                                    array("id" => 5,
                                                                          "rewrite" => "ErrorDocument 404 /error_page/404.html",
                                                                          "popis" => "Error page 404",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 5),

                                                                    array("id" => 6,
                                                                          "rewrite" => "ErrorDocument 500 /error_page/500.html",
                                                                          "popis" => "Error page 500",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 6),

                                                                    array("id" => 7,
                                                                          "rewrite" => "ErrorDocument 503 /error_page/503.html",
                                                                          "popis" => "Error page 503",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 7),

                                                                    array("id" => 10,
                                                                          "rewrite" => "RewriteEngine on",
                                                                          "popis" => "Zapínání rewrite",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 10),

                                                                    array("id" => 11,
                                                                          "rewrite" => "RewriteBase /",
                                                                          "popis" => "Nasměrování kořenu",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 11),

                                                                    array("id" => 13,
                                                                          "rewrite" => "RewriteRule ^([a-zA-Z0-9-\_]+)/([0-9]+)?$ ?action=$1&str=$2 [L]",
                                                                          "popis" => "Přepis pro stránkování",
                                                                          "aktivni" => 0,
                                                                          "poradi" => 13),

                                                                    array("id" => 14,
                                                                          "rewrite" => "RewriteRule ^([a-zA-Z0-9-\_]+)/?$ ?action=$1 [L]",
                                                                          "popis" => "Přepis pro sekce",
                                                                          "aktivni" => 1,
                                                                          "poradi" => 14),
                                                                    ),
                                                ),

                  "admin_permit" => array("%%1%%" => array("" => "výpis", "add" => "Přidat položku", "edit" => "Upravit položku", "del" => "Smazat položku", "show" => "Náhled aktivního htaccess",
                                                          "updaterow" => "Úprava pořadí", "changeact" => "Změna aktivity položky", "generate" => "Vygenerovat htaccess"),
                                          ),

                  "name_module" => array ("Administrace htaccess",
                                          "Administrace htaccess"),

                  "admin_generovani_htaccess" => "#%%1%%\n%%2%%\n\n",

                  "admin_obsah" => "
<div class=\"obal_dynhtcs\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Nastavení htaccess - koncept</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat položku\" class=\"add tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat položku</span>
  </a>
  <div class=\"cl-b ow-h m-b-15\">
    <a href=\"%%2%%\" title=\"Opravdu chceš vygenerovat htaccess z konceptu ?\" class=\"confirm generate tlacitko-8 m-r-12 m-l-2 fl-l odkaz-20\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Vygenerovat htaccess</span>
    </a>
    <a href=\"%%3%%\" title=\"Náhled aktivního htaccess\" class=\"show tlacitko-8 m-r-12 fl-l odkaz-19\">
      <span class=\"tlacitko-left\"><!-- --></span>
      <span class=\"tlacitko-right\"><!-- --></span>
      <span class=\"tlacitko-text\">Náhled aktivního htaccess</span>
    </a>
  </div>
  <div class=\"cl-b ow-h m-b-15\">
    %%4%%
  </div>
</div>\n",

                  "admin_addedit_add" => "Přidat položku",

                  "admin_addedit_edit" => "Upravit položku",

                  "admin_addedit" => "
<div class=\"obal_dynhtcs\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%% Htaccess</h3>
  </div>
  <a href=\"%%5%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-textarea f-povinny w-700\">
        <span class=\"nazev-elementu\">Zápis:</span>
        <textarea name=\"rewrite\" rows=\"10\" cols=\"60\">%%2%%</textarea>
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-700\">
        <span class=\"nazev-elementu\">Komentář:</span>
        <input type=\"text\" name=\"popis\" value=\"%%3%%\" />
      </label>
      <label class=\"f-checkbox w-700\">
        <input type=\"checkbox\" name=\"aktivni\"%%4%% />
        <span class=\"nazev-elementu\">Aktivní položka</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_show" => "
<div class=\"obal_dynhtcs\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Náhled aktivního htaccess</h3>
  </div>
  <a href=\"%%1%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <pre class=\"ow-h cl-b f-s-12\">%%2%%</pre>
</div>\n",

                  "admin_vypis_obsah_begin" => "
<script type=\"text/javascript\">
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
      var order = $(this).sortable(\"serialize\") + '&action=updaterow';
      $.post(\"%%1%%/ajax_form.php\", order, function(theResponse){
        $('#status_drag').html(theResponse);
      });
      ZpracujHlasku('#status_drag');
    }
    });
  });

  function ChangeActive(id, stav)
  {
    $.post(\"%%1%%/ajax_form.php\",
          \"action=changeact&id=\"+id+\"&stav=\"+stav,
            function(theResponse)
            {
              $('#status_drag').html(theResponse);
              ZpracujHlasku('#status_drag');
            }
          );
  }

  function ZpracujHlasku(ret)
  {
    $(ret).fadeIn('slow').delay(2000).fadeOut('slow');
  }
</script>
<div id=\"obal_razeni\">\n",

                  "admin_vypis_obsah" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 cur-move p-t-6 p-r-5 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">Pořadí: [%%2%%] - ID položky: [%%1%%]</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%6%%\" class=\"edit block fl-l m-r-5 m-l-5 no-u odkaz-4\" title=\"Upravit položku\">Upravit položku</a><a href=\"%%7%%\" title=\"Opravdu chceš smazat položku s ID [%%1%%] ?\" class=\"confirm del block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat položku</a></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%5%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">%%4%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l barva-4\">Aktivní položka:</span><span class=\"fl-r barva-5\"><input type=\"checkbox\"%%3%% onclick=\"ChangeActive(%%1%%, this.checked);\" class=\"block m-t-2 cur-poi\" /></span></li>
</ul>\n",

                  "admin_vypis_obsah_end" => "\n</div>\n<div id=\"status_drag\"></div>\n",

                  "ajax_updaterow" => "Bylo změněno pořadí položek",

                  "ajax_updaterow_not_permit" => "Nemáte oprávnění",

                  "ajax_changeact" => "Byla změněna aktivita položky: %%1%%",

                  "ajax_changeact_not_permit" => "Nemáte oprávnění",

                  );

  return $result;
?>
