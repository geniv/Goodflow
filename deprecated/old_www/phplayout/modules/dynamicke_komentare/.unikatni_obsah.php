<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamické komentáře",
                                              "title" => "%%2%%",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_tvar_menu_odkaz" => "%%1%%",

                  "admin_tvar_menu_title" => "%%1%%",

                  "admin_default_title" => "Dynamický obsah",

                  "admin_skupina_del_link" => "<a href=\"%%1%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat obsah: &quot;%%2%%&quot; ?');\">Smazat</a>",

                  "admin_vypis_edit_link_skupina" => "
<div class=\"vypis_polozky_dynamicky_obsah\">
  <p class=\"nazev_obsahu\">%%3%%%%2%%<a href=\"%%1%%\" title=\"Upravit\">Upravit</a></p>
  <div>
    %%4%%
  </div>
</div>\n",

                  "admin_skupina_add_link" => "<a href=\"%%1%%\" title=\"Přidat obsah\">Přidat obsah</a> - ",

                  "admin_skupina_add_link_skupina" => "<a href=\"%%1%%\" title=\"Přidat obsah\">Přidat obsah</a>",

                  "admin_vypis_obsahu_skupiny" => "
<div class=\"vypis_skupiny_dynamicky_obsah\">
  <h3>Výpis obsahu sekce <strong>%%1%%</strong></h3>
  <p class=\"popis_sekce\">%%3%%%%2%%</p>
  %%4%%
</div>\n",

                  "normal_vypis_null" => "<strong>Zadaná adresa neexistuje !</strong>",

                  "admin_seznam_skupin_begin" => "        <select name=\"skupina\">\n",

                  "admin_seznam_skupin" => "          <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_seznam_skupin_end" => "        </select>",

                  "admin_seznam_skupin_null" => "<strong>Zadaná skupina neexistuje !</strong>",

                  "admin_obsah_add_link" => "<a href=\"%%2%%\" title=\"Přidat skupinu\">Přidat skupinu</a>",

                  "admin_obsah" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis skupin a obsahů</h3>
  <p class=\"odkaz_pridat\">%%1%%</p>
%%2%%
</div>\n",

                  "admin_addobsah" => "
<div class=\"dynamicky_obsah_add_edit\">
  <!-- jquery wym -->
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/jquery-wym/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/jquery-wym/jquery.ui.js\"></script>
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/jquery-wym/jquery.ui.resizable.js\"></script>
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/wymeditor/jquery.wymeditor.min.js\"></script>
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js\"></script>
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/wymeditor/plugins/resizable/jquery.wymeditor.resizable.js\"></script>
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/wymeditor/plugins/fullscreen/jquery.wymeditor.fullscreen.js\"></script>
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/wymeditor/wymeditor.js\"></script>
  <!-- /jquery wym -->
  <!-- mootools mooslide -->
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/mootools/mootools12.js\"></script>
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/mootools/mooSlide2-moo12.js\"></script>
    <script type=\"text/javascript\" src=\"%%3%%modules/dynamicky_obsah/script/mootools/mooSlide2.js\"></script>
  <!-- /mootools mooslide -->
  <h3>Přidat obsah do skupiny <strong>%%5%%</strong></h3>
  <p class=\"backlink_obsah\">
    <a href=\"%%4%%\" title=\"Zpět na výpis skupiny %%5%%\">Zpět na výpis skupiny %%5%%</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
<span>Skupina:</span>
%%2%%
<span class=\"span_dodatek\">Vyber jen v případě, že chceš skupinu přesunout jinam !</span>
      </label>
      <label>
        <span>Adresa obsahu:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />
        <span class=\"span_dodatek\">Vyplň jen v případě, jestliže je adresa implementována a jestli znáš adresu obsahu !</span>
      </label>
      <textarea class=\"wymeditor\" name=\"text\" rows=\"30\" cols=\"80\"></textarea>
      <label class=\"submit\">
        <input type=\"submit\" class=\"wymupdate\" name=\"tlacitko\" value=\"Přidat obsah\" />
      </label>
    </fieldset>
  </form>
  <div id=\"napoveda_wym_panel\" class=\"moo_napoveda\">
    <h3>Nápověda k WYM editoru</h3>
    <a href=\"#\" id=\"close\" title=\"Zavřít nápovědu\"></a>
    <ul>
      <li>Doporučený prohlížeč pro WYM editor: Firefox 3+ a jeho ekvivalenty. V ostatních prohlížečích je funkce WYM editoru odlišná.</li>
      <li>@@1@@ - Absolutní url směrovaná do kořenu webu, @@2+@@ - Vkládá definované moduly (pokud jsou definovány, použití na vlastní riziko).</li>
      <li>Typy obsahu - vkládá definované elementy - používej s rozvahou !, ne všechny elementy jsou předstylovány !</li>
      <li>Třídy - jsou předchystány pro uživatelské využití - lze je i slučovat (pro kontrolu aplikovaných tříd můžeš použít HTML náhled).</li>
      <li>Když ukážeš na třídu, tak se ti označí pole do kterého můžeš tyto třídy použít.</li>
      <li>Tam, kde chceš použít element z tabulky typy obsahu; klapni a použij element.</li>
      <li>Enter -> nový odstavec, Shift + Enter -> Nový řádek v odstavci.</li>
      <li>Jestli chceš vytvořit odkaz, tak si nejdřív napiš text, potom si označ úsek na který chceš odkaz aplikovat a následně klapni na ikonu \"Vytvořit odkaz\". Tento postup je stejný i u definovaného prvku s použitím ikony \"Vložit definovaný prvek\".</li>
      <li>Jestli chceš zrušit odkaz tak označ text odkazu a následně klapni na ikonu \"Zrušit odkaz\". Tento postup je stejný i u zrušení definovaného prvku s použitím ikony \"Zrušit definovaný prvek\".</li>
    </ul>
  </div>
</div>\n",

                  "admin_addobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán obsah: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editobsah" => "
<div class=\"dynamicky_obsah_add_edit\">
  <!-- jquery wym -->
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/jquery-wym/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/jquery-wym/jquery.ui.js\"></script>
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/jquery-wym/jquery.ui.resizable.js\"></script>
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/wymeditor/jquery.wymeditor.min.js\"></script>
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js\"></script>
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/wymeditor/plugins/resizable/jquery.wymeditor.resizable.js\"></script>
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/wymeditor/plugins/fullscreen/jquery.wymeditor.fullscreen.js\"></script>
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/wymeditor/wymeditor.js\"></script>
  <!-- /jquery wym -->
  <!-- mootools mooslide -->
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/mootools/mootools12.js\"></script>
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/mootools/mooSlide2-moo12.js\"></script>
    <script type=\"text/javascript\" src=\"%%5%%modules/dynamicky_obsah/script/mootools/mooSlide2.js\"></script>
  <!-- /mootools mooslide -->
  <h3>Upravit obsah ve skupině <strong>%%6%%</strong></h3>
  <p class=\"backlink_obsah\">
    <a href=\"%%4%%\" title=\"Zpět na výpis skupiny %%6%%\">Zpět na výpis skupiny %%6%%</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
<span>Skupina:</span>
%%3%%
<span class=\"span_dodatek\">Vyber jen v případě, že chceš skupinu přesunout jinam !</span>
      </label>
      <label>
        <span>Adresa obsahu:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%1%%\" readonly=\"readonly\" />
        <span class=\"span_dodatek\">Vyplň jen v případě, jestliže je adresa implementována a jestli znáš adresu obsahu !</span>
      </label>
      <textarea class=\"wymeditor\" name=\"text\" rows=\"30\" cols=\"80\">%%2%%</textarea>
      <label class=\"submit\">
        <input type=\"submit\" class=\"wymupdate\" name=\"tlacitko\" value=\"Upravit obsah\" />
      </label>
    </fieldset>
  </form>
  <div id=\"napoveda_wym_panel\" class=\"moo_napoveda\">
    <h3>Nápověda k WYM editoru</h3>
    <a href=\"#\" id=\"close\" title=\"Zavřít nápovědu\"></a>
    <ul>
      <li>Doporučený prohlížeč pro WYM editor: Firefox 3+ a jeho ekvivalenty. V ostatních prohlížečích je funkce WYM editoru odlišná.</li>
      <li>@@1@@ - Absolutní url směrovaná do kořenu webu, @@2+@@ - Vkládá definované moduly (pokud jsou definovány, použití na vlastní riziko).</li>
      <li>Typy obsahu - vkládá definované elementy - používej s rozvahou !, ne všechny elementy jsou předstylovány !</li>
      <li>Třídy - jsou předchystány pro uživatelské využití - lze je i slučovat (pro kontrolu aplikovaných tříd můžeš použít HTML náhled).</li>
      <li>Když ukážeš na třídu, tak se ti označí pole do kterého můžeš tyto třídy použít.</li>
      <li>Tam, kde chceš použít element z tabulky typy obsahu; klapni a použij element.</li>
      <li>Enter -> nový odstavec, Shift + Enter -> Nový řádek v odstavci.</li>
      <li>Jestli chceš vytvořit odkaz, tak si nejdřív napiš text, potom si označ úsek na který chceš odkaz aplikovat a následně klapni na ikonu \"Vytvořit odkaz\". Tento postup je stejný i u definovaného prvku s použitím ikony \"Vložit definovaný prvek\".</li>
      <li>Jestli chceš zrušit odkaz tak označ text odkazu a následně klapni na ikonu \"Zrušit odkaz\". Tento postup je stejný i u zrušení definovaného prvku s použitím ikony \"Zrušit definovaný prvek\".</li>
    </ul>
  </div>
</div>\n",

                  "admin_editobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven obsah: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán obsah: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_addgroup" => "
<div class=\"dynamicky_obsah_add_edit_skupiny\">
  <h3>Přidat skupinu</h3>
  <p>
    <a href=\"%%1%%\" title=\"Zpět do dynamického obsahu\">Zpět do dynamického obsahu</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Název skupiny:</span>
        <input type=\"text\" name=\"nazev\" />
      </label>
      <label>
        <span>Popis skupiny:</span>
        <textarea name=\"popisek\" rows=\"30\" cols=\"80\"></textarea>
      </label>
      <label>
        <span>id:</span>
        <input type=\"text\" name=\"href_id\" />
      </label>
      <label>
        <span>class:</span>
        <input type=\"text\" name=\"href_class\" />
      </label>
      <label>
        <span>akce:</span>
        <input type=\"text\" name=\"href_akce\" />
      </label>
      <label class=\"checkbox\">
        <span>Zobrazit v menu:</span>
        <input type=\"checkbox\" name=\"zobrazit\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat skupinu\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addgroup_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přidána skupina: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editgroup" => "
<div class=\"dynamicky_obsah_add_edit_skupiny\">
  <h3>Upravit skupinu <strong>%%1%%</strong></h3>
  <p>
    <a href=\"%%7%%\" title=\"Zpět do dynamického obsahu\">Zpět do dynamického obsahu</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Název skupiny:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%1%%\" />
      </label>
      <label>
        <span>Popis skupiny:</span>
        <textarea name=\"popisek\" rows=\"30\" cols=\"80\">%%2%%</textarea>
      </label>
      <label>
        <span>id:</span>
        <input type=\"text\" name=\"href_id\" value=\"%%3%%\" />
      </label>
      <label>
        <span>class:</span>
        <input type=\"text\" name=\"href_class\" value=\"%%4%%\" />
      </label>
      <label>
        <span>akce:</span>
        <input type=\"text\" name=\"href_akce\" value=\"%%5%%\" />
      </label>
      <label class=\"checkbox\">
        <span>Zobrazit v menu:</span>
        <input type=\"checkbox\" name=\"zobrazit\"%%6%% />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit skupinu\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editgroup_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena skupina: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delgroup_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána skupina: \"<strong>%%1%%</strong>\" (včetně obsahu)
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_vypis_skupina_del_link" => " - <a href=\"%%1%%\" title=\"Smazat skupinu\" onclick=\"return confirm('Opravdu chceš smazat skupinu: &quot;%%2%%&quot; ?');\">Smazat skupinu</a>",

                  "admin_vypis_del_link" => " - <a href=\"%%1%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat obsah: &quot;%%2%%&quot; ?');\">Smazat</a>",

                  "admin_vypis_skupina" => "
<ul>
  <li>[%%1%%] - <strong>%%2%%</strong></li>
  <li class=\"popis_skupiny\">%%3%%</li>
  <li class=\"odkazy_skupiny\">%%6%%<a href=\"%%4%%\" title=\"Upravit skupinu\">Upravit skupinu</a>%%5%%</li>",

                  "admin_vypis_skupina_end" => "\n</ul>\n",

                  "admin_vypis_obsah" => "
  <li class=\"nazev_obsahu\"><strong>%%2%%</strong><span><a href=\"%%3%%\" title=\"Upravit\">Upravit</a>%%4%%</span></li>
  <li class=\"pre\">
    <pre>%%1%%</pre>
  </li>",

                  "set_admin_prepnani_unikatnich" => false, //true - promenne/false - jednotne

                  "set_povolit_pridani" => true,

                  "set_vypis_chybu" => false,

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
