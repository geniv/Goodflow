<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Taksk",
                                              "title" => "Tasks",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%2%%",
                                              "odkaz" => "Taksk - tým",
                                              "title" => "Týmy",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%3%%",
                                              "odkaz" => "Tasks - skupina",
                                              "title" => "Skupiny",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%4%%",
                                              "odkaz" => "Tasks - projekt",
                                              "title" => "Projekty",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%5%%",
                                              "odkaz" => "Tasks - ukoly",
                                              "title" => "Úkoly",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%6%%",
                                              "odkaz" => "Tasks - komentáře",
                                              "title" => "Komentáře",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%7%%",
                                              "odkaz" => "Tasks - uživatelé",
                                              "title" => "Uživatelé",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%8%%",
                                              "odkaz" => "Tasks - pošta",
                                              "title" => "Pošta",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%9%%",
                                              "odkaz" => "Tasks - odkazy",
                                              "title" => "Odkazy",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%10%%",
                                              "odkaz" => "Tasks - pozadí",
                                              "title" => "Pozadí",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),
/*
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

                  "admin_skupina_add_link_skupina" => "<a href=\"%%1%%\" title=\"Přidat obsah\" id=\"popis_sekce_odkaz_pridat\">Přidat obsah</a>",

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
*/














                  "admin_obsah" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis skupin a obsahů</h3>
  <p class=\"odkaz_pridat\">%%1%%</p>
<a href=\"%%2%%\">přidej tým</a><br />
<a href=\"%%3%%\">přidej skupinu</a><br />
<a href=\"%%4%%\">přidej projekt</a><br />
<a href=\"%%5%%\">přidej ukol</a><br />
<a href=\"%%6%%\">přidej komentář</a><br />
<a href=\"%%7%%\">přidej uživatel</a><br />
<a href=\"%%8%%\">přidej poštu</a><br />
</div>\n",


                  //týmy
                  "admin_obsah_tym" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis týmů</h3>
  <p class=\"odkaz_pridat\">%%1%%</p>
</div>",

                  "admin_addtym" => "
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Název týmu: *</span>
        <input type=\"text\" name=\"nazev\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zakladatel:</span>
          %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\"></textarea>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat tým\" />
      </label>
    </fieldset>
  </form>
  %%4%%
  ",

                  "admin_addtym_hlaska" => "byl přidán tým: %%1%%",

                  "admin_edittym" => "
  <form method=\"post\" action=\"\"> (%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Název týmu: *</span>
        <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zakladatel:</span>
          %%4%%
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\">%%5%%</textarea>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit tým\" />
      </label>
    </fieldset>
  </form>
  %%6%%
  ",

                  "admin_edittym_hlaska" => "Upraven tým: %%1%%",

                  "admin_deltym_hlaska" => "Smazán tým: %%1%%",

                  "admin_vypis_tym" => "
%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
<a href=\"%%6%%\" title=\"Upravit\">Upravit</a><br />
<a href=\"%%7%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat tým: &quot;%%2%%&quot; ?');\">Smazat</a><br />
<a href=\"%%8%%\" title=\"Přidat skupinu\">Přidat skupinu</a><br />
                   <br />",

                  //vyber tymu
                  "admin_select_tym_begin" => "<select name=\"tym\" onchange=\"document.location.href='%%1%%&amp;tym='+this.value\">\n",

                  "admin_select_tym" => "<option value=\"%%1%%\"%%2%%>%%3%%, %%4%%, %%5%%, %%6%%</option>\n",

                  "admin_select_tym_end" => "</select>",

                  //vyber viditelnosti
                  "admin_select_viditelnost_begin" => "<select name=\"verejne\" >\n",

                  "admin_select_viditelnost" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_select_viditelnost_end" => "</select>",


                  //skupiny
                  "admin_obsah_skupina" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis skupin</h3>
  (%%1%%%%2%%)
  <p class=\"odkaz_pridat\">%%3%%</p>
</div>\n",

                  "admin_addgrup" => "
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Název skupiny: *</span>
        <input type=\"text\" name=\"nazev\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Tým:</span>
          %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Uživatel:</span>
          %%4%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Veřejnost (viditelnost):</span>
          %%5%%
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\"></textarea>
      <label>
        <span>Pořadí:</span>
          <input type=\"text\" name=\"poradi\" value=\"%%6%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat skupinu\" />
      </label>
    </fieldset>
  </form>
  %%7%%
  ",

                  "admin_addgrup_hlaska" => "přidána skupina: %%1%%",

                  "admin_editgrup" => "
  <form method=\"post\" action=\"\"> (%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Název skupiny: *</span>
        <input type=\"text\" name=\"nazev\" value=\"%%6%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Tým:</span>
          %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Uživatel:</span>
          %%4%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Veřejnost (viditelnost):</span>
          %%5%%
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\">%%7%%</textarea>
      <label>
        <span>Pořadí:</span>
          <input type=\"text\" name=\"poradi\" value=\"%%8%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit skupinu\" />
      </label>
    </fieldset>
  </form>
  %%9%%
  ",

                  "admin_editgrup_hlaska" => "upravena skupina: %%1%%",

                  "admin_delgrup_hlaska" => "smazana skupina: %%1%%",

                  "admin_vypis_skupina_begin" => "(%%1%%) <a href=\"%%2%%\">Přidej další skupinu uživatele: %%1%%</a><br />",

                  "admin_vypis_skupina" => "
%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
<a href=\"%%9%%\" title=\"Upravit\">Upravit</a><br />
<a href=\"%%10%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat skupinu: &quot;%%4%%&quot; ?');\">Smazat</a><br />
<a href=\"%%11%%\" title=\"Přidat projekt\">Přidat projekt</a><br />
                   <br />",

                   "admin_vypis_skupina_null" => "prázdná skupina",

                   "admin_vypis_skupina_end" => "konec výpisu...",


                  //projekty
                  "admin_obsah_projekt" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis Projektu</h3>
  <p class=\"odkaz_pridat\">%%3%%</p>
</div>\n",

                  "admin_addproj" => "
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Skupina:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Název projektu: *</span>
        <input type=\"text\" name=\"nazev\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zadání: *</span>
          <input type=\"text\" name=\"zadani\" value=\"%%4%%\" />(datum)
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Dokonceni:</span>
          <input type=\"text\" name=\"dokonceni\" value=\"\" />(datum)
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Dokončeno:</span>
          <input type=\"checkbox\" name=\"dokonceno\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Cena:</span>
          <input type=\"text\" name=\"cena\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Náročnost:</span>
          <input type=\"text\" name=\"narocnost\" value=\"\" />hod
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\"></textarea>
      <label>
        <span>Pořadí:</span>
          <input type=\"text\" name=\"poradi\" value=\"%%5%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat projekt\" />
      </label>
    </fieldset>
  </form>
  %%6%%",

                  "admin_addproj_hlaska" => "přidán projekt: %%1%%",

                  "admin_editproj" => "
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Skupina:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Název projektu: *</span>
        <input type=\"text\" name=\"nazev\" value=\"%%4%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zadání: *</span>
          <input type=\"text\" name=\"zadani\" value=\"%%6%%\" />(datum)
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Dokonceni:</span>
          <input type=\"text\" name=\"dokonceni\" value=\"%%7%%\" />(datum)
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Dokončeno:</span>
          <input type=\"checkbox\" name=\"dokonceno\"%%8%% />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Cena:</span>
          <input type=\"text\" name=\"cena\" value=\"%%9%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Náročnost:</span>
          <input type=\"text\" name=\"narocnost\" value=\"%%10%%\" />hod
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\">%%5%%</textarea>
      <label>
        <span>Pořadí:</span>
          <input type=\"text\" name=\"poradi\" value=\"%%11%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit projekt\" />
      </label>
    </fieldset>
  </form>
  %%12%%",

                  "admin_editproj_hlaska" => "upraven projekt: %%1%%",

                  "admin_delproj_hlaska" => "smazán projekt: %%1%%",

                  "admin_vypis_projekt_begin" => "(%%1%%) <a href=\"%%2%%\">Přidej další projekt do skupiny: %%1%%</a><br />",

                  "admin_vypis_projekt" => "
%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
%%11%% - 11<br />
%%12%% - 12<br />
%%13%% - 13<br />
<a href=\"%%11%%\" title=\"Upravit\">Upravit</a><br />
<a href=\"%%12%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat projekt: &quot;%%4%%&quot; ?');\">Smazat</a><br />
<a href=\"%%13%%\" title=\"Přidat ukol\">Přidat ukol</a><br />
                   <br />",

                  "admin_vypis_projekt_null" => "prázdná projekt",

                  "admin_vypis_projekt_end" => "konec výpisu...",


                  //vyber dulezitosti
                  "admin_select_dulezitost_begin" => "<select name=\"dulezitost\" >\n",

                  "admin_select_dulezitost" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_select_dulezitost_end" => "</select>",


                  //tasks
                  "admin_obsah_ukol" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis Ukolu</h3>
  <p class=\"odkaz_pridat\">%%3%%</p>
</div>\n",

                  "admin_addtask" => "
  <script type=\"text/javascript\" src=\"%%2%%/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"%%2%%/farbtastic/farbtastic.js\"></script>
  <link rel=\"stylesheet\" href=\"%%2%%/farbtastic/farbtastic.css\" type=\"text/css\" />
  <script type=\"text/javascript\">
    $(document).ready(function() {
      $('#picker').farbtastic('#color');
    });
  </script>
  <form method=\"post\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Projekt:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Název ukolu: *</span>
        <input type=\"text\" name=\"nazev\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zadání: *</span>
          <input type=\"text\" name=\"zadani\" value=\"%%4%%\" />(datum)
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Dokonceni:</span>
          <input type=\"text\" name=\"dokonceni\" value=\"\" />(datum)
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Dokončeno:</span>
          <input type=\"checkbox\" name=\"dokonceno\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Důležitost:</span>
          %%5%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Barva:</span>
          <div id=\"picker\"></div>
          <input type=\"text\" name=\"barva\" id=\"color\" value=\"#123456\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Náročnost:</span>
          <input type=\"text\" name=\"narocnost\" value=\"\" />hod
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zobrazit:</span>
          <input type=\"checkbox\" name=\"zobrazit\" checked=\"checked\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\"></textarea>
      <label>
        <span>Pořadí:</span>
          <input type=\"text\" name=\"poradi\" value=\"%%6%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat ukol (task)\" />
      </label>
    </fieldset>
  </form>
  %%7%%",

                  "admin_addtask_hlaska" => "přidán ukol: %%1%%",

                  "admin_edittask" => "
  <script type=\"text/javascript\" src=\"%%2%%/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"%%2%%/farbtastic/farbtastic.js\"></script>
  <link rel=\"stylesheet\" href=\"%%2%%/farbtastic/farbtastic.css\" type=\"text/css\" />
  <script type=\"text/javascript\">
    $(document).ready(function() {
      $('#picker').farbtastic('#color');
    });
  </script>
  <form method=\"post\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Projekt:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Název ukolu: *</span>
        <input type=\"text\" name=\"nazev\" value=\"%%4%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zadání: *</span>
          <input type=\"text\" name=\"zadani\" value=\"%%6%%\" />(datum)
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Dokonceni:</span>
          <input type=\"text\" name=\"dokonceni\" value=\"%%7%%\" />(datum)
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Dokončeno:</span>
          <input type=\"checkbox\" name=\"dokonceno\"%%8%% />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Důležitost:</span>
          %%9%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Barva:</span>
          <div id=\"picker\"></div>
          <input type=\"text\" name=\"barva\" id=\"color\" value=\"%%10%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Náročnost:</span>
          <input type=\"text\" name=\"narocnost\" value=\"%%11%%\" />hod
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zobrazit:</span>
          <input type=\"checkbox\" name=\"zobrazit\"%%12%% />
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\">%%5%%</textarea>
      <label>
        <span>Pořadí:</span>
          <input type=\"text\" name=\"poradi\" value=\"%%13%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit ukol (task)\" />
      </label>
    </fieldset>
  </form>
  %%14%%",

                  "admin_edittask_hlaska" => "upraven ukol: %%1%%",

                  "admin_deltask_hlaska" => "smazán ukol: %%2%%",

                  "admin_vypis_ukol_begin" => "(%%1%%) <a href=\"%%2%%\">Přidej další ukol do skupiny: %%1%%</a><br />",

                  "admin_vypis_ukol" => "
%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
%%11%% - 11<br />
%%12%% - 12<br />
%%13%% - 13<br />
<a href=\"%%13%%\" title=\"Upravit\">Upravit</a><br />
<a href=\"%%14%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat ukol: &quot;%%4%%&quot; ?');\">Smazat</a><br />
<a href=\"%%15%%\" title=\"Přidat komentář\">Přidat komentář</a><br />
                   <br />",

                  "admin_vypis_ukol_end" => "konec výpisu...",

                  "admin_vypis_ukol_null" => "prázdná ukol",


                  //komentare
                  "admin_obsah_komentar" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis Komentaru</h3>
  <p class=\"odkaz_pridat\">%%1%%</p>
</div>\n",

                  "admin_addcom" => "
  <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/ajax.js\"></script>

  <form method=\"post\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Ukol (tasks):</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Uživatel: *</span>
          <input type=\"text\" id=\"id_login_user\" onkeyup=\"SearchUser(this.value, 1, 'id_login_user', 'id_user', 'naseptavac');\" />
          <input type=\"hidden\" name=\"uzivatel\" id=\"id_user\" />
          <br />
          <span id=\"naseptavac\"></span>
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zobrazit:</span>
          <input type=\"checkbox\" name=\"zobrazit\" checked=\"checked\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      zpráva: *
      <textarea name=\"zprava\" rows=\"10\" cols=\"10\"></textarea>
      <label>
        <span>Zanoření:</span>
          %%4%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat komentář\" />
      </label>
    </fieldset>
  </form>
  %%5%%",

                  "admin_addcom_hlaska" => "přidán komentář: %%1%%",

                  "admin_editcom" => "
  <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/ajax.js\"></script>

  <form method=\"post\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Ukol (tasks):</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Uživatel: *</span>
          <input type=\"text\" id=\"id_login_user\" value=\"%%4%%\" onkeyup=\"SearchUser(this.value, 1, 'id_login_user', 'id_user', 'naseptavac');\" />
          <input type=\"hidden\" name=\"uzivatel\" id=\"id_user\" value=\"%%5%%\" />
          <br />
          <span id=\"naseptavac\"></span>
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Zobrazit:</span>
          <input type=\"checkbox\" name=\"zobrazit\"%%9%% />
        <span class=\"span_dodatek\">...</span>
      </label>
      (%%7%%, %%8%%)
      zpráva: *
      <textarea name=\"zprava\" rows=\"10\" cols=\"10\">%%6%%</textarea>
      <label>
        <span>Zanoření:</span>
          %%4%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit komentář\" />
      </label>
    </fieldset>
  </form>
  %%10%%",

                  "admin_editcom_hlaska" => "upraven komentář: %%1%%",

                  "admin_delcom_hlaska" => "smazán komentář: %%1%%",

                  "admin_vypis_komentar" => "
%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
%%11%% - 11<br />
%%12%% - 12<br />
%%13%% - 13<br />
<a href=\"%%10%%\" title=\"Upravit\">Upravit</a><br />
<a href=\"%%11%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat komentář: &quot;%%2%%&quot; ?');\">Smazat</a><br />
<a href=\"%%12%%\" title=\"Přidat komentář ze komentář\">Přidat komentář ke komentáři</a><br />
                   <br />",


                  //uzivatele
                  "admin_obsah_uzivatel" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis Uzivatelu</h3>
  <p class=\"odkaz_pridat\">%%1%%</p>
<a href=\"%%2%%\">přidej uzivatele</a><br />
</div>\n",

                  "admin_adduser" => "....(%%1%%%%2%%)
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label>
        <span>Jméno: *</span>
        <input type=\"text\" name=\"jmeno\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Příjmení:</span>
        <input type=\"text\" name=\"prijmeni\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Login: *</span>
        <input type=\"text\" name=\"login\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Heslo: *</span>
        <input type=\"password\" name=\"heslo\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Email: *</span>
        <input type=\"text\" name=\"email\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Popis:</span>
        <textarea name=\"popis\"></textarea>
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Fotografie:</span>
        <input type=\"file\" name=\"obrazek\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Aktivni:</span>
        <input type=\"checkbox\" name=\"aktivni\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat uživatele\" />
      </label>
    </fieldset>
  </form>
  %%3%%
                  ",

                  "admin_adduser_hlaska" => "byl přidán uživatel: %%1%%",

                  "admin_edituser" => "....(%%1%%%%2%%)
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Tým: *</span>
          %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Jméno: *</span>
        <input type=\"text\" name=\"jmeno\" value=\"%%4%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Příjmení:</span>
        <input type=\"text\" name=\"prijmeni\" value=\"%%5%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Login: *</span>
        <input type=\"text\" name=\"login\" value=\"%%6%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Heslo: *</span>
        <input type=\"password\" name=\"heslo\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Email: *</span>
        <input type=\"text\" name=\"email\" value=\"%%7%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Popis:</span>
        <textarea name=\"popis\">%%8%%</textarea>
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Fotografie:</span>
        <input type=\"file\" name=\"foto\" />
        %%9%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Aktivni:</span>
        <input type=\"checkbox\" name=\"aktivni\"%%10%% />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit uživatele\" />
      </label>
    </fieldset>
  </form>
  %%11%%
                  ",

                  "admin_edituser_hlaska" => "byl upraven uživatel: %%1%%",

                  "admin_contymuser" => "
  <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/ajax.js\"></script>

  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Název týmu: *</span>
          <input type=\"text\" id=\"id_jmeno\" name=\"nazev\" onkeyup=\"SearchTym(this.value, 1, 'id_jmeno', 'id_tym', 'naseptavac');\" /><br />
          <input type=\"hidden\" name=\"tym\" id=\"id_tym\" />
          <span id=\"naseptavac\"></span>
        <span class=\"span_dodatek\">...</span>
      </label>

      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat se do týmu\" />
      </label>
    </fieldset>
  </form>
                  ",

                  "admin_contymuser_hlaska" => "uživatel přidán do týmu: %%1%%",

                  "admin_deluser_hlaska" => "smazán uživatel %%1%% se vším všudy!",

                  "admin_vypis_uzivatel" => "
%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
<a href=\"%%11%%\" title=\"Upravit\">Upravit</a><br />
<a href=\"%%12%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat uživate: &quot;%%5%%&quot; ?');\">Smazat</a><br />
<a href=\"%%13%%\" title=\"Přidat se k týmu\">přidat se do týmu (nutný znat název týmu)</a><br />
<a href=\"%%14%%\" title=\"Založit tým\">založit vlastní tým</a><br />
<a href=\"%%15%%\" title=\"Přidat skupinu\">Přidat skupinu projektu</a><br />
<a href=\"%%16%%\" title=\"Poslat poštu\">Poslat poštu</a><br />
<a href=\"%%17%%\" title=\"Přidat skupinu odkazu\">Přidat skupinu odkazu</a><br />
<a href=\"%%18%%\" title=\"Přidat pozadi\">Přidat pozadi</a><br />
                   <br />",


                  //posta
                  "admin_obsah_posta" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis Pošty</h3>
  <p class=\"odkaz_pridat\">%%1%%</p>
</div>\n",


                  //odkazy
                  "admin_obsah_odkaz" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis Odkazů</h3>
  <p class=\"odkaz_pridat\">%%1%%</p>
</div>\n",

                  "admin_addlinkgroup" => "
  <script type=\"text/javascript\" src=\"%%2%%/script/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"%%2%%/script/farbtastic/farbtastic.js\"></script>
  <link rel=\"stylesheet\" href=\"%%2%%/script/farbtastic/farbtastic.css\" type=\"text/css\" />
  <script type=\"text/javascript\">
    $(document).ready(function() {
      $('#picker').farbtastic('#color');
    });
  </script>
  <form method=\"post\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Uživatel:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Název skupiny: *</span>
        <input type=\"text\" name=\"nazev\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Barva:</span>
          <div id=\"picker\"></div>
          <input type=\"text\" name=\"barva\" id=\"color\" value=\"#123456\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\"></textarea>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat skupinu odkazu\" />
      </label>
    </fieldset>
  </form>
  %%4%%",

                  "admin_addlinkgroup_hlaska" => "přidána skupina: %%1%%",

                  "admin_editlinkgroup" => "
  <script type=\"text/javascript\" src=\"%%2%%/script/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"%%2%%/script/farbtastic/farbtastic.js\"></script>
  <link rel=\"stylesheet\" href=\"%%2%%/script/farbtastic/farbtastic.css\" type=\"text/css\" />
  <script type=\"text/javascript\">
    $(document).ready(function() {
      $('#picker').farbtastic('#color');
    });
  </script>
  <form method=\"post\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Uživatel:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Název skupiny: *</span>
        <input type=\"text\" name=\"nazev\" value=\"%%4%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Barva:</span>
          <div id=\"picker\"></div>
          <input type=\"text\" name=\"barva\" id=\"color\" value=\"%%5%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\">%%6%%</textarea>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit skupinu odkazu\" />
      </label>
    </fieldset>
  </form>
  %%7%%",

                  "admin_editlinkgroup_hlaska" => "upravena skupina: %%1%%",

                  "admin_dellinkgroup_hlaska" => "smazána skupina %%1%%, i s odkazy",

                  "admin_addlink" => "
  <form method=\"post\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Skupina:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Link: *</span>
        <input type=\"text\" name=\"nazev\" value=\"\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\"></textarea>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat odkaz\" />
      </label>
    </fieldset>
  </form>
  %%4%%",

                  "admin_addlink_hlaska" => "pridan odkaz: %%1%%",

                                    "admin_editlink" => "
  <form method=\"post\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Skupina:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Link: *</span>
        <input type=\"text\" name=\"nazev\" value=\"%%4%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      Popis:
      <textarea name=\"popis\" rows=\"10\" cols=\"10\">%%5%%</textarea>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit odkaz\" />
      </label>
    </fieldset>
  </form>
  %%6%%",

                  "admin_editlink_hlaska" => "upraven odkaz: %%1%%",

                  "admin_dellink_hlaska" => "smazan odkaz: %%1%%",

                  "admin_vypis_odkaz_begin" => "
%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
<a href=\"%%6%%\" title=\"Upravit\">Upravit</a><br />
<a href=\"%%7%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat skupinu: &quot;%%3%%&quot; ?');\">Smazat</a><br />
<a href=\"%%8%%\">Přidej novou skupinu pro: %%2%%</a><br />
<a href=\"%%9%%\">Přidej nový odkaz do této skupiny</a><br />
                  ",

                  "admin_vypis_odkaz" => "
%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
<a href=\"%%4%%\" title=\"Upravit\">Upravit</a><br />
<a href=\"%%5%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat link: &quot;%%2%%&quot; ?');\">Smazat</a><br />
                   <br />",

                  "admin_vypis_odkaz_null" => "žádný odkaz ve skupině",

                  "admin_vypis_odkaz_group_null" => "žádná skupina odkazů",

                  "admin_vypis_odkaz_end" => "<br />--konec skupiny--",


                  //pozadi
                  "admin_obsah_pozadi" => "
<div class=\"dynamicky_obsah_hlavni\">
  <h3>Výpis Pozadí</h3>
  <p class=\"odkaz_pridat\">%%1%%</p>
</div>\n",

                  "admin_addback" => "
  <script type=\"text/javascript\" src=\"%%2%%/script/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"%%2%%/script/farbtastic/farbtastic.js\"></script>
  <link rel=\"stylesheet\" href=\"%%2%%/script/farbtastic/farbtastic.css\" type=\"text/css\" />
  <script type=\"text/javascript\">
    $(document).ready(function() {
      $('#picker').farbtastic('#color');
    });
  </script>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Uživatel:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Url: *</span>
        <input type=\"file\" name=\"obrazek\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Barva:</span>
          <div id=\"picker\"></div>
          <input type=\"text\" name=\"barva\" id=\"color\" value=\"#123456\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat pozadí\" />
      </label>
    </fieldset>
  </form>
  %%4%%",

                  "admin_addback_hlaska" => "přidáno pozadí: %%1%%, navíc: %%2%%",

                  "admin_editback" => "
  <script type=\"text/javascript\" src=\"%%2%%/script/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"%%2%%/script/farbtastic/farbtastic.js\"></script>
  <link rel=\"stylesheet\" href=\"%%2%%/script/farbtastic/farbtastic.css\" type=\"text/css\" />
  <script type=\"text/javascript\">
    $(document).ready(function() {
      $('#picker').farbtastic('#color');
    });
  </script>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">(%%1%%%%2%%)
    <fieldset>
      <label>
        <span>Uživatel:</span>
        %%3%%
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Url: *</span>
        %%4%%
        <input type=\"file\" name=\"obrazek\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label>
        <span>Barva:</span>
          <div id=\"picker\"></div>
          <input type=\"text\" name=\"barva\" id=\"color\" value=\"%%5%%\" />
        <span class=\"span_dodatek\">...</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit pozadí\" />
      </label>
    </fieldset>
  </form>
  %%6%%",

                  "admin_editback_hlaska" => "upraveno pozadi: %%1%%, navic: %%2%%",

                  "admin_delback_hlaska" => "smazáno pozadi: %%1%%, navic: %%2%%",

                  "admin_vypis_pozadi" => "
%%1%% - 1<br />
%%2%% - 2<br />
%%3%% - 3<br />
%%4%% - 4<br />
<a href=\"%%5%%\" title=\"Upravit\">Upravit</a><br />
<a href=\"%%6%%\" title=\"Smazat\" onclick=\"return confirm('Opravdu chceš smazat pozadi: &quot;%%3%%&quot; ?');\">Smazat</a><br />
                   <br />",





                  //hledani uzivatelu
                  "ajax_search_user_begin_1" => "--začátek--<br />",

                  "ajax_search_user_1" => "login: <a href=\"#\" onclick=\"InsertSearchUser('%%1%%', '%%5%%', '%%4%%', '%%3%%', %%2%%); return false;\">%%5%%</a> jmeno: %%6%% %%7%%<br />\n",

                  "ajax_search_user_null_1" => "nic neodpovídá hledanému výrazu: %%1%%<br />",

                  "ajax_search_user_end_1" => "--konec--",


                  //hledani tymu
                  "ajax_search_tym_begin_1" => "--začátek..<br />",

                  "ajax_search_tym_1" => "nazev: <a href=\"#\" onclick=\"InsertSearchTym('%%1%%', '%%5%%', '%%4%%', '%%3%%', %%2%%); return false;\">%%5%%</a><br />\n",

                  "ajax_search_tym_null_1" => "nic neodpovídá hledanému výrazu: %%1%%<br />",

                  "ajax_search_tym_end_1" => "--konec--",


                  //nastaveni
                  "set_viditelnost_skupiny" => array ("--vyber--",
                                                      "Osobní", //vidi svoje
                                                      "Týmová", //vydi tym
                                                      "Veřejná (pod registraci)", //musi byt registrovan
                                                      "Naprosto veřejná"),  //uplne free

                  "set_dulezitost_ukolu" => array("--vyber--",
                                                  "Výhledově",
                                                  "Normalni",
                                                  "Spěchá",
                                                  "Sebevražda"),

                  "set_pathscript" => "script",

                  "set_pathpicture" => "picture",

                  "set_pathback" => "background",

                  "set_pathprofile" => "profile",

                  "set_max_w" => array(100, 0), //profil, pozadi

                  "set_max_h" => array(200, 0), //profil, pozadi

                  "set_max_size" => array(3, 3), //profil: (MB, 0=neomezene), pozadi: (MB, 0=neomezene)


                  "ajaxscript" => "
//vyhledani uzivatele do naseptavace
function SearchUser(text, tvar, user_in, user_out, out_id)
{
  $('#'+out_id).fadeIn('slow');
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=searchuser&text=\"+text+\"&tvar=\"+tvar+\"&user_in=\"+user_in+\"&user_out=\"+user_out+\"&out=\"+out_id,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

//vlozeni textu do formulare z naseptavace
function InsertSearchUser(in_id, login, vystup, out_id, user)
{
  $('#'+vystup).fadeOut('slow');
  $('#'+in_id).val(login);
  $('#'+out_id).val(user);
}


//vyhledani uzivatele do naseptavace
function SearchTym(text, tvar, login, id_out, out_id)
{
  $('#'+out_id).fadeIn('slow');
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=searchtym&text=\"+text+\"&tvar=\"+tvar+\"&login=\"+login+\"&id_out=\"+id_out+\"&out=\"+out_id,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

//vlozeni textu do formulare z naseptavace
function InsertSearchTym(in_id, login, vystup, out_id, user)
{
  $('#'+vystup).fadeOut('slow');
  $('#'+in_id).val(login);
  $('#'+out_id).val(user);
}


//zjisteni nazvu zeme
function GetZeme(ip, tvar, out_id)
{
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=getzeme&ip=\"+ip+\"&tvar=\"+tvar,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

//zjisteni hostu
function GetHostName(ip, out_id)
{
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=gethostname&ip=\"+ip,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}
",












/*
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
*/


/*
<script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-1.3.2.min.js\"></script>
                  <script type=\"text/javascript\" src=\"%%1%%%%2%%/ajax.js\"></script>

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

                  "ajaxscript" => "
function KontrolaFormatu(text, sablona, id, out_id)
{
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=kontrola&text=\"+text+\"&sablona=\"+sablona+\"&id=\"+id,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

function PorovnaniObsahu(idobsah1, idobsah2, out_id)
{
  var text1 = document.getElementById(idobsah1).value;
  var text2 = document.getElementById(idobsah2).value;

  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=porovnani&text1=\"+text1+\"&text2=\"+text2,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

function KontrolaEmalu(email, out_id)
{
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=email&email=\"+email,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

function KontrolaDuplicity(login, out_id)
{
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=duplicita&login=\"+login,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

function GetZeme(ip, tvar, out_id)
{
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=getzeme&ip=\"+ip+\"&tvar=\"+tvar,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

function GetHostName(ip, out_id)
{
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=gethostname&ip=\"+ip,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

function GetLoginHistory(id, prava, tvar, out_id)
{
  $.post(\"%%1%%%%2%%/ajax_form.php\",
        \"action=getloginhistory&id=\"+id+\"&prava=\"+prava+\"&tvar=\"+tvar,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}
",
*/

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
