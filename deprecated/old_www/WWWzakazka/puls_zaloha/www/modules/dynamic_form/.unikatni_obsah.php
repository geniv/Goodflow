<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický formulář",
                                              "title" => "Dynamický formulář",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),

                                        array("main_href" => "%%1%%%%2%%",
                                              "odkaz" => "Soubory formuláře",
                                              "title" => "Soubory formuláře",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true)
                                        ),

//<script type=\"text/javascript\" src=\"%%1%%%%2%%/script/jquery-1.3.2.min.js\"></script>
                  "normal_vypis_form_1" => "
          <script type=\"text/javascript\" src=\"%%1%%%%2%%/script/ajax.js\"></script>
          <form method=\"post\" enctype=\"multipart/form-data\" action=\"\" id=\"rezervace_mist\">
            <h3>Nadpis</h3>
            <fieldset>
              <label id=\"rezervace_jmeno\">
                <input type=\"text\" name=\"%%4%%\" value=\"%%6%%\"%%7%% />
              </label>
              <p class=\"tooltip\">Zde vyplň své jméno a příjmení<br />(Povinná položka)</p>

              <label id=\"rezervace_email\">
                <input type=\"text\" name=\"%%12%%\" value=\"%%14%%\"%%15%% onkeyup=\"KontrolaFormatu(this.value, '%%11%%', '#id_elem_11');\" id=\"id_elem_11_fin\" />
                <span id=\"id_elem_11\"></span>
              </label>
              <p class=\"tooltip\">Zde vyplň e-mail ve tvaru: xxxxx@yyyyy.zzz<br />(Povinná položka)</p>

              <label id=\"rezervace_datum\">
                %%22%%<br />
                <input type=\"text\" name=\"%%20%%\" value=\"%%23%%\" />
              </label>
              <p class=\"tooltip\">Zde vyplň datum následující akce v sekci Program<br />(Povinná položka)</p>

              <input type=\"checkbox\" name=\"%%26%%\" value=\"%%27%%\" />
              <input type=\"checkbox\" name=\"%%32%%\" value=\"%%33%%\" />
              <input type=\"checkbox\" name=\"%%38%%\" value=\"%%39%%\" />
              <input type=\"checkbox\" name=\"%%44%%\" value=\"%%45%%\" />

              <label id=\"rezervace_datum\">
                <input type=\"text\" name=\"%%50%%\" value=\"%%52%%\" />
              </label>

              <input type=\"radio\" name=\"%%55%%\" value=\"%%56%%\" />
              <input type=\"radio\" name=\"%%61%%\" value=\"%%62%%\" />
              <input type=\"radio\" name=\"%%67%%\" value=\"%%68%%\" />
<br />
              <input type=\"file\" name=\"%%73%%\" onchange=\"$('#nazev_file').html(this.value);\" />(%%74%%)<br />
              <strong><span id=\"nazev_file\"></span></strong>
<br />
              <p class=\"tooltip\">Zde opiš text z obrázku, aby se formulář odeslal<br /></p>
              <p>dodatek: %%79%%</p>
              <input type=\"submit\" name=\"%%77%%\"%%78%% id=\"rezervace_odeslat\" value=\"Odeslat formulář\" />
            </fieldset>
          </form>
                  ",
/*
 <label id=\"rezervace_zprava\">
                <textarea%%28%% rows=\"3\" cols=\"20\"%%31%%>%%30%%</textarea>
              </label>
              <p class=\"tooltip\">Zde zanech zprávu<br />(Povinná položka)</p>

              %%38%%
              <label id=\"rezervace_captcha\">
                <input type=\"text\"%%36%% maxlength=\"4\" />
              </label>
*/
                  "normal_datum_admin_email_1" => "d.m.y / H:i:s",

                  "normal_email_header_1" => "%%1%%\nFrom: %%2%%",

                  "normal_email_send_true_1" => "<em>Rezervace byla odeslána</em>",

                  "normal_email_send_false_1" => "<em>Nastala chyba při odesílání</em>",

                  "normal_email_send2_true_1" => "oznámení",

                  "normal_email_send2_false_1" => "Nastala chyba při odesílání oznámení.",

                  "normal_email_send_complet_1" => "
<div id=\"rezervace_mist_vystup\" class=\"rezervace_ok\">
  <strong>Formulář byl odeslán</strong>
  %%1%%%%2%%
  <a href=\"%%3%%\" title=\"JZD Dance club\"><span>Pokračovat</span></a>
</div>",


                  "normal_error_empty_1" => "<dt>Nevyplněna položka:</dt><dd>%%1%%</dd>\n    ",

                  "normal_error_min_max_1" => "nedodržení rozsahu v elementu: <strong>%%1%%</strong><br />",

                  "normal_error_min_1" => "nedodržení minima u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_max_1" => "překročení maxima u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_reg_exp_1" => "<dt>Špatně vyplněná položka:</dt><dd>%%1%%</dd>\n    ",

                  "normal_error_empty_captcha_1" => "<dt>Nevyplněna položka:</dt><dd>Text z obrázku</dd>\n    ",

                  "normal_error_wrong_captcha_1" => "<dt>Špatně vyplněná položka:</dt><dd>Text z obrázku</dd>\n    ",

                  "normal_checked_error_1" => "nezaškrkli jste potřebný element <strong>%%1%%</strong><br />",

                  "normal_radio_error_1" => "neoznačili jste potřebný element <strong>%%1%%</strong><br />",

                  "normal_file_error_1" => "nevložiljste potřebný soubor <strong>%%1%%</strong><br />",

                  "normal_suffix_file_error_1" => "vložený soubor má špatnou příponu <strong>%%1%%</strong><br />",

                  "normal_upload_file_error_1" => "nepodařilo se uploadovat soubor <strong>%%1%%</strong><br />",

                  "normal_error_unkown_1" => "",

                  "normal_error_hidden_1" => "<input type=\"hidden\" name=\"%%1%%\" value=\"%%2%%\" />",

                  "normal_error_button_1" => "<input type=\"submit\" name=\"error_tlacitko\" id=\"neodeslano\" value=\"Pokračovat\" />",

                  "normal_error_end_1" => "
<form action=\"\" id=\"rezervace_mist_vystup\" class=\"rezervace_storno\" method=\"post\">
  <strong>Formulář nebyl odeslán !</strong>
  <em>Vyskytly se tyto chyby:</em>
  <dl>
    %%1%%
  </dl>
  %%2%%
  %%3%%
</form>\n",

                  "admin_vstupni_typ_select_begin" => "<select name=\"vstupni_typ\" onchange=\"document.location.href='%%1%%&amp;vstupni_typ='+this.value\">",

                  "admin_vstupni_typ_select" => "\n  <option value=\"%%1%%\"%%2%%>%%3%%</option>",

                  "admin_vstupni_typ_select_end" => "</select>",

                  "admin_typ_select_begin" => "<select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+this.value\">",

                  "admin_typ_select" => "\n  <option value=\"%%1%%\"%%2%%>%%4%%</option>",

                  "admin_typ_select_end" => "</select>",

                  "admin_formular_select_begin" => "<select name=\"formular\">",

                  "admin_formular_select" => "\n  <option value=\"%%1%%\"%%2%%>%%3%%</option>",

                  "admin_formular_select_end" => "</select>",

                  "admin_formular_select_null" => "žádný formulář",

                  "admin_obsah" => "
<div class=\"dynamicky_formular_hlavni_vypis\">
  <h3>Výpis formulářů s elementy</h3>
  <p class=\"odkazy_pridat_nastavit\">
    <a href=\"%%1%%\" title=\"Přidat formulář\">Přidat šablonu formuláře</a>
    <span>
      <a href=\"%%2%%\" title=\"Test regulárních výrazů\">Test regulárních výrazů</a>
    </span>
  </p>
%%3%%
</div>\n",

                  "admin_test_rv" => "
<div class=\"nastaveni_dynamicky_formular\">
  <h3>Test regulárních výrazů</h3>
  <p class=\"backlink_formular\"><a href=\"%%4%%\" title=\"Zpět na výpis formulářů s elementy\">Zpět na výpis formulářů s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"nadpis_sekce_formular\">
        <span>Příklady:</span>
      </label>
      <label class=\"nadpis_sekce_formular\">
        <span>/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/</span>
      </label>
      <label class=\"nadpis_sekce_formular\">
        <span>/^(\+420)?[0-9]{9}$/</span>
      </label>
      <label class=\"nadpis_sekce_formular\">
        <span><a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" title=\"Dokumentace\">Dokumentace</a></span>
      </label>
      <label class=\"nadpis_sekce_formular\">
        <span><!-- --></span>
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
      <label class=\"nadpis_sekce_formular\">
        <span>%%3%%<!-- --></span>
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addform" => "
<div class=\"dynamicky_formular_addedit_sablony\">
  <!-- jquery wym -->
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/jquery-wym/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/jquery-wym/jquery.ui.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/jquery-wym/jquery.ui.resizable.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/jquery.wymeditor.min.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/plugins/resizable/jquery.wymeditor.resizable.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/plugins/fullscreen/jquery.wymeditor.fullscreen.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/wymeditor.js\"></script>
  <!-- /jquery wym -->
  <!-- mootools mooslide -->
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/mootools/mootools12.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/mootools/mooSlide2-moo12.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/mootools/mooSlide2.js\"></script>
  <!-- /mootools mooslide -->

  <script type=\"text/javascript\" src=\"%%1%%/script/jquery-1.3.2.min.js\"></script>

  <h3>Přidat šablonu formuláře</h3>
  <p class=\"backlink_formular\"><a href=\"%%2%%\" title=\"Zpět na výpis formulářů s elementy\">Zpět na výpis formulářů s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Adresa formuláře:</span>
        <input type=\"text\" name=\"adresa\" />
        <span class=\"formular_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Název formuláře:</span>
        <input type=\"text\" name=\"nazev\" />
      </label>
      <label class=\"input_text\">
        <span>Předmět emailu:</span>
        <input type=\"text\" name=\"predmet\" />
        <span class=\"formular_dodatek\">Povinná položka. Předmět emailu pro administrátory.</span>
      </label>
      <label class=\"input_radio\">
        <span>Vlastní email odesílatele:</span>
        <input type=\"radio\" name=\"odesilatel\" value=\"true\" checked=\"checked\" onclick=\"CheckOdeslatelSolid();\" />
        <span class=\"formular_dodatek\">Nastaví napevno email odesílatele.</span>
      </label>
      <label class=\"input_text\">
        <span>Vlastní email odesílatele:</span>
        <input type=\"text\" name=\"odesilateladmin\" id=\"id_odesilateladmin\" />
        <span class=\"formular_dodatek\">Nastaví napevno email odesílatele.</span>
      </label>
      <label class=\"input_radio\">
        <span>Email uživatele jako odesílatel:</span>
        <input type=\"radio\" name=\"odesilatel\" value=\"false\" onclick=\"CheckOdeslatelFlexible();\" />
        <span class=\"formular_dodatek\">Nastaví napevno email odesílatele.</span>
      </label>
      <label class=\"input_text\">
        <span>Name elementu pro email:</span>
        <input type=\"text\" name=\"zdrojovyemail\" id=\"id_zdrojovyemail\" value=\"elem_?\" />
        <span class=\"formular_dodatek\">Za otazník dosaď číslo v name elementu pro vstup emailu.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Emaily příjemců:</span>
        <textarea name=\"email\" rows=\"30\" cols=\"80\"></textarea>
        <span class=\"formular_dodatek\">Email můžeš vyplnit buď jeden, nebo více oddělených čárkou.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Text emailu příjemce:</span>
        <textarea name=\"textemail\" rows=\"30\" cols=\"80\" class=\"wymeditor\"></textarea>
        <span class=\"formular_dodatek\">Tvar vstupních dat je @@x@@.</span>
      </label>
      <label class=\"input_text formular_dodatek_popis\">
        <span>Dodatek formuláře:</span>
        <input type=\"text\" name=\"dodatek\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Oznámení uživateli:</span>
        <input type=\"checkbox\" name=\"oznameni\" onclick=\"CheckOznameni(this.checked);\" />
        <span class=\"formular_dodatek\">Oznámení uživateli na email, který zadal.</span>
      </label>
      <label class=\"input_text\">
        <span>Předmět oznámení uživateli:</span>
        <input type=\"text\" name=\"predmetoznameni\" id=\"id_predmetoznameni\" />
      </label>
      <label class=\"input_text\">
        <span>Odesílatel pro uživatele:</span>
        <input type=\"text\" name=\"odesilateluzivatel\" id=\"id_odesilateluzivatel\" />
        <span class=\"formular_dodatek\">Nastaví napevno email odesílatele pro uživatele.</span>
      </label>
      <label class=\"input_textarea textarea_dlouhy_text\">
        <span>Text emailu pro uživatele:</span>
        <textarea name=\"textemailoznameni\" rows=\"30\" cols=\"80\" id=\"id_textemailoznameni\"></textarea>
        <span class=\"formular_dodatek\">Tvar vstupních dat je @@x@@.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" class=\"wymupdate\" value=\"Přidat šablonu formuláře\" />
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
</div>

<script type=\"text/javascript\">
  function CheckOdeslatelSolid()
  {
    $('#id_zdrojovyemail').attr('disabled', true);
    $('#id_odesilateladmin').attr('disabled', false);
  }

  function CheckOdeslatelFlexible()
  {
    $('#id_odesilateladmin').attr('disabled', true);
    $('#id_zdrojovyemail').attr('disabled', false);
  }

  function CheckOznameni(stav)
  {
    $('#id_predmetoznameni, #id_odesilateluzivatel, #id_textemailoznameni').attr('disabled', !stav);
  }

  CheckOdeslatelSolid();
  CheckOznameni(false);
</script>\n",

                  "admin_addform_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přidána šablona: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editform" => "
<div class=\"dynamicky_formular_addedit_sablony\">
  <!-- jquery wym -->
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/jquery-wym/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/jquery-wym/jquery.ui.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/jquery-wym/jquery.ui.resizable.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/jquery.wymeditor.min.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/plugins/resizable/jquery.wymeditor.resizable.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/plugins/fullscreen/jquery.wymeditor.fullscreen.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/wymeditor/wymeditor.js\"></script>
  <!-- /jquery wym -->
  <!-- mootools mooslide -->
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/mootools/mootools12.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/mootools/mooSlide2-moo12.js\"></script>
    <script type=\"text/javascript\" src=\"modules/dynamic_form/script/mootools/mooSlide2.js\"></script>
  <!-- /mootools mooslide -->

  <script type=\"text/javascript\" src=\"%%1%%/script/jquery-1.3.2.min.js\"></script>

  <h3>Upravit šablonu formuláře</h3>
  <p class=\"backlink_formular\"><a href=\"%%18%%\" title=\"Zpět na výpis formulářů s elementy\">Zpět na výpis formulářů s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Adresa formuláře:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%2%%\" />
        <span class=\"formular_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Název formuláře:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />
      </label>
      <label class=\"input_text\">
        <span>Předmět emailu:</span>
        <input type=\"text\" name=\"predmet\" value=\"%%4%%\" />
        <span class=\"formular_dodatek\">Povinná položka. Předmět emailu pro administrátory.</span>
      </label>
      <label class=\"input_radio\">
        <span>Vlastní email odesílatele:</span>
        <input type=\"radio\" name=\"odesilatel\" value=\"true\"%%5%% onclick=\"CheckOdeslatelSolid();\" />
        <span class=\"formular_dodatek\">Nastaví napevno email odesílatele.</span>
      </label>
      <label class=\"input_text\">
        <span>Vlastní email odesílatele:</span>
        <input type=\"text\" name=\"odesilateladmin\" id=\"id_odesilateladmin\" value=\"%%6%%\" />
        <span class=\"formular_dodatek\">Nastaví napevno email odesílatele.</span>
      </label>
      <label class=\"input_radio\">
        <span>Email uživatele jako odesílatel:</span>
        <input type=\"radio\" name=\"odesilatel\" value=\"false\"%%7%% onclick=\"CheckOdeslatelFlexible();\" />
        <span class=\"formular_dodatek\">Nastaví napevno email odesílatele.</span>
      </label>
      <label class=\"input_text\">
        <span>Name elementu pro email:</span>
        <input type=\"text\" name=\"zdrojovyemail\" id=\"id_zdrojovyemail\" value=\"%%8%%\" />
        <span class=\"formular_dodatek\">Za otazník dosaď číslo v name elementu pro vstup emailu.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Emaily příjemců:</span>
        <textarea name=\"email\" rows=\"30\" cols=\"80\">%%9%%</textarea>
        <span class=\"formular_dodatek\">Email můžeš vyplnit buď jeden, nebo více oddělených čárkou.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Text emailu příjemce:</span>
        <textarea name=\"textemail\" rows=\"30\" cols=\"80\" class=\"wymeditor\">%%10%%</textarea>
        <span class=\"formular_dodatek\">Tvar vstupních dat je @@x@@.</span>
      </label>
      <label class=\"input_text formular_dodatek_popis\">
        <span>Dodatek formuláře:</span>
        <input type=\"text\" name=\"dodatek\" value=\"%%11%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Oznámení uživateli:</span>
        <input type=\"checkbox\" name=\"oznameni\"%%12%% onclick=\"CheckOznameni(this.checked);\" />
        <span class=\"formular_dodatek\">Oznámení uživateli na email, který zadal.</span>
      </label>
      <label class=\"input_text\">
        <span>Předmět oznámení uživateli:</span>
        <input type=\"text\" name=\"predmetoznameni\" value=\"%%13%%\" id=\"id_predmetoznameni\" />
      </label>
      <label class=\"input_text\">
        <span>Odesílatel pro uživatele:</span>
        <input type=\"text\" name=\"odesilateluzivatel\" value=\"%%14%%\" id=\"id_odesilateluzivatel\" />
        <span class=\"formular_dodatek\">Nastaví napevno email odesílatele pro uživatele.</span>
      </label>
      <label class=\"input_textarea textarea_dlouhy_text\">
        <span>Text emailu pro uživatele:</span>
        <textarea name=\"textemailoznameni\" rows=\"30\" cols=\"80\" id=\"id_textemailoznameni\">%%15%%</textarea>
        <span class=\"formular_dodatek\">Tvar vstupních dat je @@x@@.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" class=\"wymupdate\" value=\"Upravit šablonu formuláře\" />
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
</div>

<script type=\"text/javascript\">
  function CheckOdeslatelSolid()
  {
    $('#id_zdrojovyemail').attr('disabled', true);
    $('#id_odesilateladmin').attr('disabled', false);
  }

  function CheckOdeslatelFlexible()
  {
    $('#id_odesilateladmin').attr('disabled', true);
    $('#id_zdrojovyemail').attr('disabled', false);
  }

  function CheckOznameni(stav)
  {
    $('#id_predmetoznameni, #id_odesilateluzivatel, #id_textemailoznameni').attr('disabled', !stav);
  }

  %%16%%
  %%17%%
</script>\n",

                  "admin_editform_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena šablona: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delform_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána šablona: \"<strong>%%1%%</strong>\" včetně jejích elementů
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_addedit_elem_nazev" => "
      <label class=\"input_text\">
        <span>Název elementu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%1%%\" />
      </label>\n",

                  "admin_addedit_elem_value" => "
      <label class=\"input_text\">
        <span>Value hodnota:</span>
        <input type=\"text\" name=\"value\" value=\"%%1%%\" />
      </label>\n",

                  "admin_addedit_elem_captcha" => "
      <label class=\"input_text\">
        <span>ID captcha obrázku:</span>
        <input type=\"text\" name=\"value\" value=\"%%1%%\" />
      </label>\n",

                  "admin_addedit_elem_readonly" => "
      <label class=\"input_checkbox\">
        <span>Readonly:</span>
        <input type=\"checkbox\" name=\"readonly\"%%1%% />
      </label>\n",

                  "admin_addedit_elem_disabled" => "
      <label class=\"input_checkbox\">
        <span>Disabled:</span>
        <input type=\"checkbox\" name=\"disabled\"%%1%% />
      </label>\n",

                  "admin_addedit_elem_vstupni_typ" => "
      <label class=\"input_select\">
        <span>Typ vstupu:</span>
%%1%%
      </label>\n",

                  "admin_addedit_elem_reg_exp" => "
      <label class=\"input_text\">
        <span>Regulární výraz:</span>
        <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" />
        <span class=\"formular_dodatek\"><a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" title=\"Dokumentace\">Dokumentace</a></span>
      </label>\n",

                  "admin_addedit_elem_minmax_val" => "
      <label class=\"input_text\">
        <span>Minimální hodnota:</span>
        <input type=\"text\" name=\"min_val\" value=\"%%1%%\" />
        <span class=\"formular_dodatek\">Nepovinná položka. Při vybraném textovém vstupu nastavuje minimální délku, u čísla minimální hodnotu. 0 = Neaktivní.</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální hodnota:</span>
        <input type=\"text\" name=\"max_val\" value=\"%%2%%\" />
        <span class=\"formular_dodatek\">Nepovinná položka. Při vybraném textovém vstupu nastavuje maximální délku, u čísla maximální hodnotu. 0 = Neaktivní.</span>
      </label>\n",

                  "admin_addelem" => "
<div class=\"pridat_upravit_element_dynamicky_formular\">
  <h3>Přidat element do šablony</h3>
  <p class=\"backlink_formular\"><a href=\"%%11%%\" title=\"Zpět na výpis formulářů s elementy\">Zpět na výpis formulářů s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_select\">
        <span>Šablona formuláře:</span>
%%1%%
      </label>
      <label class=\"input_select\">
        <span>Typ vstupu:</span>
%%2%%
      </label>
%%3%%
%%4%%
%%5%%
%%6%%
%%7%%
      <label class=\"input_checkbox\">
        <span>Povinná položka:</span>
        <input type=\"checkbox\" name=\"povinne\" />
      </label>
%%8%%
%%9%%
%%10%%
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat element\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addelem_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán element: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editelem" => "
<div class=\"pridat_upravit_element_dynamicky_formular\">
  <h3>Upravit element v šabloně</h3>
  <p class=\"backlink_formular\"><a href=\"%%12%%\" title=\"Zpět na výpis formulářů s elementy\">Zpět na výpis formulářů s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_select\">
        <span>Šablona formuláře:</span>
%%1%%
      </label>
      <label class=\"input_select\">
        <span>Typ vstupu:</span>
%%2%%
      </label>
%%3%%
%%4%%
%%5%%
%%6%%
%%7%%
      <label class=\"input_checkbox\">
        <span>Povinná položka:</span>
        <input type=\"checkbox\" name=\"povinne\"%%8%% />
      </label>
%%9%%
%%10%%
%%11%%
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit element\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editelem_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven element: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delelem_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán element: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delfile_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán soubor: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",




                  "admin_vypis_obsah_begin" => "
<script type=\"text/javascript\" src=\"%%2%%/script/jquery-1.3.2.min.js\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/jquery-ui-1.7.2.custom.min.js\"></script>
<script type=\"text/javascript\">
  $(document).ready(function(){

    $(function() {
      $(\".obal_vypis_sablon_obsah\").sortable({
                          tolerance: 'pointer',
                          scroll: true,
                          scrollSensitivity: 40,
                          scrollSpeed: 30,
                          revert: 300,
                          opacity: 0.6,
                          cursor: 'move',
                          update: function() {
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
</script>",

                  "admin_vypis_obsah_begin_form" => "
<ul class=\"vypis_sablon_zahlavi\">
  <li>%%1%% - %%3%%</li>
  <li class=\"adresa_sablony\">%%2%%</li>
  <li class=\"odkazy_pridat_upravit\"><a href=\"%%6%%\" title=\"Přidat element\">Přidat element</a> - <a href=\"%%7%%\" title=\"Upravit šablonu\">Upravit šablonu</a> - <a href=\"%%8%%\" title=\"Smazat šablonu\" onclick=\"return confirm('Opravdu chceš smazat šablonu: &quot;%%3%%&quot; ?');\">Smazat šablonu</a></li>
</ul>
<div class=\"obal_vypis_sablon_obsah\">\n",

                  "admin_vypis_obsah_end_form" => "\n</div>\n",

                  "admin_vypis_obsah_elem" => "
<ul class=\"vypis_sablon_polozka\" id=\"recordsArray_%%2%%\">
  <li>Typ elementu: <strong>%%3%%</strong></li>
  <li>Popis elementu: <strong>%%1%%<!-- --></strong></li>
  <li>Name hodnota: <strong>elem_%%2%%</strong></li>
  <li>Value hodnota: <strong>%%4%%<!-- --></strong></li>
  <li class=\"povinna_polozka_checkbox\"><em>Povinná položka:</em><input type=\"checkbox\"%%8%% disabled=\"disabled\" /></li>
  <li>Pořadí elementu: <strong>%%5%%</strong></li>
  <li class=\"odkazy_pridat_upravit\"><a href=\"%%6%%\" title=\"Upravit element\">Upravit element</a> - <a href=\"%%7%%\" title=\"Smazat element\" onclick=\"return confirm('Opravdu chceš smazat element: &quot;%%2%%&quot; ?');\">Smazat element</a></li>
</ul>\n",

                  "admin_vypis_obsah_end" => "<div id=\"status_drag\"></div>\n",

                  "ajax_update_records_listings" => "Byl proveden přesun mezi položkami %%1%% a %%2%%",



                  "tvar_datum_vypis_souboru" => "d.m.Y H:i:s",

                  "admin_obsah_souboru_begin" => "začátek<br />",

                  "admin_obsah_souboru" => "soubor: <a href=\"%%1%%\">%%2%%</a> - %%3%% - <a href=\"%%4%%\" onclick=\"return confirm('Opravdu chceš smazat soubor: &quot;%%2%%&quot; ?');\">smazat</a><br />",

                  "admin_obsah_souboru_null" => "žádné soubory",

                  "admin_obsah_souboru_end" => "konec<br />",



                  "set_znakpovinne" => "Povinná položka.",

                  "set_debug_lokal" => false,

                  "set_input" => array("text"     => "Dlouhý text",  //Xx - nazev, value
                                      "checkbox" => "Checkbox",  //Xx - nazev, checked

                                      "radio" => "Radio button (nazev = group-name)",

                                      "datumcas" => "Datum / čas (value = date-format)",

                                      "captcha"  => "Captcha obrázek (value = id-captchy)",

                                      "file"  => "Upload souboru (value = filtr, | = odd)",
                                      ),

                  "set_prevod" => array("\xc3\xa1" => "a",
                                        "\xc3\xa4" => "a",
                                        "\xc4\x8d" => "c",
                                        "\xc4\x8f" => "d",
                                        "\xc3\xa9" => "e",
                                        "\xc4\x9b" => "e",
                                        "\xc3\xad" => "i",
                                        "\xc4\xbe" => "l",
                                        "\xc4\xba" => "l",
                                        "\xc5\x88" => "n",
                                        "\xc3\xb3" => "o",
                                        "\xc3\xb6" => "o",
                                        "\xc5\x91" => "o",
                                        "\xc3\xb4" => "o",
                                        "\xc5\x99" => "r",
                                        "\xc5\x95" => "r",
                                        "\xc5\xa1" => "s",
                                        "\xc5\xa5" => "t",
                                        "\xc3\xba" => "u",
                                        "\xc5\xaf" => "u",
                                        "\xc3\xbc" => "u",
                                        "\xc5\xb1" => "u",
                                        "\xc3\xbd" => "y",
                                        "\xc5\xbe" => "z",
                                        "\xc3\x81" => "A",
                                        "\xc3\x84" => "A",
                                        "\xc4\x8c" => "C",
                                        "\xc4\x8e" => "D",
                                        "\xc3\x89" => "E",
                                        "\xc4\x9a" => "E",
                                        "\xc3\x8d" => "I",
                                        "\xc4\xbd" => "L",
                                        "\xc4\xb9" => "L",
                                        "\xc5\x87" => "N",
                                        "\xc3\x93" => "O",
                                        "\xc3\x96" => "O",
                                        "\xc5\x90" => "O",
                                        "\xc3\x94" => "O",
                                        "\xc5\x98" => "R",
                                        "\xc5\x94" => "R",
                                        "\xc5\xa0" => "S",
                                        "\xc5\xa4" => "T",
                                        "\xc3\x9a" => "U",
                                        "\xc5\xae" => "U",
                                        "\xc3\x9c" => "U",
                                        "\xc5\xb0" => "U",
                                        "\xc3\x9d" => "Y",
                                        "\xc5\xbd" => "Z",
                                        " " => " ",
                                        //"-" => "_",
                                        "+" => "_",
                                        ";" => "_",
                                        ":" => "_",
                                        "," => "_",
                                        "'" => "_",
                                        "?" => "_",
                                        "<" => "_",
                                        ">" => "_",
                                        "\x5c" => "_",  // /
                                        "\x2f" => "_",  // \
                                        "|" => "_",
                                        "=" => "_",
                                        "!" => "_",
                                        "*" => "_",
                                        "@" => "_",
                                        "%" => "_",
                                        "&" => "_",
                                        "§" => "_",
                                        "#" => "_",
                                        "$" => "_",
                                        "\"" => "_",
                                        "˚" => "_",
                                        "`" => "_",
                                        "~" => "_",
                                        "^" => "_",
                                        "€" => "_",
                                        "¶" => "_",
                                        "¨" => "_",
                                        "ŧ" => "_",
                                        "¯" => "_",
                                        "←" => "_",
                                        "→" => "_",
                                        "↓" => "_",
                                        "ø" => "_",
                                        "þ" => "_",
                                        "Đ" => "d",
                                        "đ" => "d"),

                  "set_hlavicka" => "Content-type: text/html; charset=UTF-8",

                  "set_pathfile" => "soubory",

                  "set_getidfile" => "execfile",

                  "ajax_dobre" => "dobre",

                  "ajax_spatne" => "špatne",

                  "ajaxscript" => "
  function KontrolaFormatu(text, id, ret)
  {
    $.post(\"%%1%%%%2%%/ajax_form.php\",
      \"action=kontrola&text=\"+text+\"&id=\"+id,
        function(theResponse)
        {
          $(ret).html(theResponse);
          if (theResponse == 'dobre')
          {
            $(ret+'_fin').css('color', '#000');
          }
            else
          {
            $(ret+'_fin').css('color', '#ff0000');
          }
        }
      );
  }
                  ",

                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
