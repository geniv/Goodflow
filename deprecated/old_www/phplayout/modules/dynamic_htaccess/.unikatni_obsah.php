<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Nastavení htaccess",
                                              "title" => "Nastavení htaccess",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "admin_generovani_htaccess" => "#%%1%%\n%%2%%\n\n",

                  "admin_generovani_htaccess_complet" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla vytvořen htaccess z konceptu.
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_htaccess_exists" => "<a href=\"%%1%%\" title=\"Náhled aktivního htaccessu\" class=\"odkaz_vpravo\">Náhled aktivního htaccessu</a>",

                  "admin_htaccess_not_exists" => "<span class=\"odkaz_vpravo\">htaccess neexistuje</span>",

                  "admin_obsah" => "
<div class=\"dynamicky_htaccess_vypis\">
  <h3>Výpis konceptu htaccessu</h3>
  <p class=\"odkaz_pridat_htaccess\">
    <a href=\"%%1%%\" title=\"Přidat položku\">Přidat položku</a>
    <a href=\"%%2%%\" title=\"Test regulárních výrazů\" class=\"odkaz_vpravo\">Test regulárních výrazů</a>
  </p>
  <p class=\"vygenerovat_htaccess\">
    <a href=\"%%3%%\" title=\"Vygenerovat htaccess\" onclick=\"return confirm('Opravdu chceš vygenerovat htaccess z konceptu ?');\">Vygenerovat htaccess</a>
    %%4%%
  </p>
%%5%%
</div>\n",

                  "admin_test_rv" => "
<div class=\"test_regularnich_vyrazu_htaccess\">
  <h3>Test regulárních výrazů</h3>
  <p class=\"backlink_htaccess\"><a href=\"%%4%%\" title=\"Zpět na výpis konceptu htaccessu\">Zpět na výpis konceptu htaccessu</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"nadpis_sekce_htaccess hlavni_nadpis_htaccess\">
        <span>Příklady:</span>
      </label>
      <label class=\"nadpis_sekce_htaccess\">
        <span>Pro e-mail:</span>
      </label>
      <span class=\"pre_htaccess\">/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/</span>
      <label class=\"nadpis_sekce_htaccess\">
        <span>Pro telefon:</span>
      </label>
      <span class=\"pre_htaccess\">/^(\+420)?[0-9]{9}$/</span>
      <label class=\"nadpis_sekce_htaccess\">
        <span>Ostatní příklady:</span>
      </label>
      <span class=\"pre_htaccess\">RewriteRule ^zmena-jazyka-na-([a-zA-Z\_]+)/?$ ?sub=changelang&amp;id=$1 [L]
RewriteRule ^rss/([a-zA-Z-\_]+)/?$ ?action=rss&amp;sablona=$1 [L]
RewriteRule ^galerie/([a-zA-Z-\_]+)/?$ ?action=galerie&amp;sekce=$1 [L]
RewriteRule ^([a-zA-Z0-9-\_]+)/([0-9]+)?$ ?action=$1&amp;str=$2 [L]
RewriteRule ^([a-zA-Z0-9-\_]+)/?$ ?action=$1 [L]
RewriteRule ^([a-zA-Z0-9-\_]+)/serazeno-podle:([a-z\_]+)/pohled:([a-z\_]+)/strana:([0-9]+)/?$ ?action=$1&amp;sort=$2&amp;view=$3&amp;str=$4 [L]
RewriteRule ^([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/?/?$ ?action=$1%%%%$2 [L]
RewriteRule ^([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/?/?/?$ ?action=$1%%%%$2%%%%$3 [L]
RewriteRule ^([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/([a-zA-Z0-9-\_]+)/?/?/?/?$ ?action=$1%%%%$2%%%%$3%%%%$4 [L]</span>
      <label class=\"nadpis_sekce_htaccess\">
        <span><a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" title=\"Dokumentace\">Dokumentace</a></span>
      </label>
      <label class=\"input_textarea\">
        <span>Vstupní text:</span>
        <textarea name=\"vstup\" rows=\"30\" cols=\"80\">%%1%%</textarea>
      </label>
      <label class=\"input_textarea\">
        <span>Regulární výraz:</span>
        <textarea name=\"reg_exp\" rows=\"30\" cols=\"80\">%%2%%</textarea>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Otestovat\" />
      </label>
      <label class=\"vyslede_htaccess\">
        <span>%%3%%<!-- --></span>
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_add" => "
<div class=\"pridat_upravit_polozku_htaccess\">
  <h3>Přidat položku htaccessu</h3>
  <p class=\"backlink_htaccess\"><a href=\"%%2%%\" title=\"Zpět na výpis konceptu htaccessu\">Zpět na výpis konceptu htaccessu</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_checkbox\">
        <span>Aktivní položka:</span>
        <input type=\"checkbox\" name=\"aktivni\" />
      </label>
      <label class=\"input_textarea\">
        <span>Rewrite zápis:</span>
        <textarea name=\"rewrite\" rows=\"30\" cols=\"80\"></textarea>
      </label>
      <label class=\"input_text\">
        <span>Komentář:</span>
        <input type=\"text\" name=\"poznamka\" />
        <span class=\"htaccess_dodatek\">Maximální počet znaků je 300.</span>
      </label>
      <label class=\"input_text\">
        <span>Pořadí položky:</span>
        <input type=\"text\" name=\"poradi\" value=\"%%1%%\" />
        <span class=\"htaccess_dodatek\">Zapsaná hodnota musí být větší než nula.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat položku\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_add_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přidána položka: \"<strong>%%1%%</strong>\" v pořadí: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_edit" => "
<div class=\"pridat_upravit_polozku_htaccess\">
  <h3>Upravit položku htaccessu</h3>
  <p class=\"backlink_htaccess\"><a href=\"%%5%%\" title=\"Zpět na výpis konceptu htaccessu\">Zpět na výpis konceptu htaccessu</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_checkbox\">
        <span>Aktivní položka:</span>
        <input type=\"checkbox\" name=\"aktivni\"%%1%% />
      </label>
      <label class=\"input_textarea\">
        <span>Rewrite zápis:</span>
        <textarea name=\"rewrite\" rows=\"30\" cols=\"80\">%%2%%</textarea>
      </label>
      <label class=\"input_text\">
        <span>Komentář:</span>
        <input type=\"text\" name=\"poznamka\" value=\"%%3%%\" />
        <span class=\"htaccess_dodatek\">Maximální počet znaků je 300.</span>
      </label>
      <label class=\"input_text\">
        <span>Pořadí položky:</span>
        <input type=\"text\" name=\"poradi\" value=\"%%4%%\" />
        <span class=\"htaccess_dodatek\">Zapsaná hodnota musí být větší než nula.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit položku\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_edit_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena položka: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_del_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána položka: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_show" => "
<div class=\"pridat_upravit_polozku_htaccess\">
  <h3>Náhled aktivního htaccessu</h3>
  <p class=\"backlink_htaccess\"><a href=\"%%1%%\" title=\"Zpět na výpis konceptu htaccessu\">Zpět na výpis konceptu htaccessu</a></p>
  <pre>%%2%%</pre>
</div>\n",

                  "admin_vypis_obsah_begin" => "
<script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-1.3.2.min.js\"></script>
<script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-ui-1.7.1.custom.min.js\"></script>
<script type=\"text/javascript\">
  $(document).ready(function(){

    $(function() {
      $(\"#obal_razeni\").sortable({ opacity: 0.6, cursor: 'move', update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updateRecordsListings';
        $.post(\"%%1%%%%2%%/ajax_form.php\", order, function(theResponse){
          $(\"#status_drag\").html(theResponse);
          setTimeout(\"SchovejHlasku()\", 2000);
        });
        ZobrazHlasku();
      }
      });
    });
  });

  function ChangeActive(id, stav)
  {
    ZobrazHlasku();

    $.post(\"%%1%%%%2%%/ajax_form.php\", \"action=changeact&id=\"+id+\"&stav=\"+stav,
          function(theResponse)
          {
            $(\"#status_drag\").html(theResponse);
          }
          );

    setTimeout(\"SchovejHlasku()\", 2000);
  }

  function ZobrazHlasku()
  {
    $(document).ready(function(){
      $(\"#status_drag\").fadeIn(\"slow\");
    });
  }

  function SchovejHlasku()
  {
    $(document).ready(function(){
      $(\"#status_drag\").fadeOut(\"slow\");
    });
  }
</script>
<div id=\"obal_razeni\">\n",

                  "admin_vypis_obsah" => "
<ul id=\"recordsArray_%%1%%\">
  <li class=\"poradi_id\">Pořadí: [%%2%%]</li>
  <li class=\"poradi_id id_polozky\">ID položky: [%%1%%]</li>
  <li class=\"aktivni_polozka\"><em>Aktivní položka:</em><input type=\"checkbox\"%%3%% onclick=\"ChangeActive(%%1%%, this.checked);\" /></li>
  <li class=\"popis_hodnota\">#%%5%%</li>
  <li class=\"popis_hodnota\">%%4%%</li>
  <li class=\"odkazy_upravit_smazat\">
    <a href=\"%%6%%\" title=\"Upravit položku\">Upravit položku</a> - <a href=\"%%7%%\" title=\"Smazat položku\" onclick=\"return confirm('Opravdu chceš smazat položku s ID &quot;%%1%%&quot; ?');\">Smazat položku</a>
  </li>
</ul>\n",


                  "admin_vypis_obsah_end" => "
</div>
<div id=\"status_drag\">
  <p>Položky mají funkci \"drag and drop\"</p>
</div>",

                  "ajax_update_records_listings" => "Změnil jsi pořadí položky v htaccesu !",

                  "ajax_update_action" => "Aktivita položky s ID: <strong>%%1%%</strong> byla změněna !",

                  "" => "",
                  "" => "",
                  );

  return $result;
?>
