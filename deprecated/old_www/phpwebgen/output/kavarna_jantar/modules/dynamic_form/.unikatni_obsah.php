<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický fomulář",
                                              "title" => "administrace dynamickeho fomulare",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_begin_form_1" => "  <form method=\"post\" action=\"\" id=\"centralni_form\">
    <fieldset>
      <dl>\n",

                  "normal_vypis_form_nadpis_1" => "<h2>%%1%%</h2>",

                  "normal_vypis_form_label_1" => "        <dt id=\"centralni_dt_%%1%%\">\n          <label for=\"%%2%%\">%%3%%</label>\n        </dt>\n        ",

                  "normal_vypis_form_text_zac_1" => "%%1%%<dd id=\"centralni_dd_%%2%%\">\n          <input type=\"text\"%%3%%%%4%%%%5%%%%6%%%%7%%%%8%%%%9%% />%%10%%\n        </dd>\n",

                  "normal_vypis_form_password_zac_1" => "%%1%%<dd id=\"centralni_dd_%%2%%\">\n          <input type=\"password\"%%3%%%%4%%%%5%%%%6%%%%7%%%%8%%%%9%% />%%10%%\n        </dd>\n",

                  "normal_vypis_form_textarea_zac_1" => "%%1%%<dd id=\"centralni_dd_%%2%%\">\n          <textarea%%3%%%%4%%%%5%%%%6%%%%7%%%%8%% rows=\"10\" cols=\"30\">%%9%%",

                  "normal_vypis_form_textarea_kon_1" => "</textarea>%%1%%\n        </dd>\n",

                  "normal_vypis_form_textarea_zac_kon_1" => "%%1%%<dd id=\"centralni_dd_%%2%%\">\n          <textarea%%3%%%%4%%%%5%%%%6%%%%7%%%%8%% rows=\"10\" cols=\"30\">%%9%%</textarea>%%10%%\n        </dd>\n",

                  "normal_vypis_form_checkbox_zac_1" => "%%1%%<dd id=\"centralni_dd_%%2%%\">\n          <input type=\"checkbox\"%%3%%%%4%%%%5%%%%6%%%%7%% /> %%8%%%%9%%\n        </dd>\n",

                  "normal_vypis_form_radio_zac_1" => "%%1%%<dd id=\"centralni_dd_%%2%%\">\n          <input type=\"radio\"%%3%%%%4%%%%5%%%%6%%%%7%% /> %%8%%%%9%%\n        </dd>\n",

                  "normal_vypis_form_submit_zac_1" => "        <dd id=\"centralni_dd_%%1%%\">\n          <input type=\"submit\"%%2%%%%3%%%%4%%%%5%%%%6%%%%7%% />\n        </dd>\n",

                  "normal_vypis_form_reset_zac_1" => "        <dd id=\"centralni_dd_%%1%%\">\n          <input type=\"reset\"%%2%%%%3%%%%4%%%%5%%%%6%%%%7%% />\n        </dd>\n",

                  "normal_vypis_form_image_zac_1" => "        <input type=\"image\"%%1%%%%2%%%%3%%%%4%%%%5%%%%6%% />\n",

                  "normal_vypis_form_hidden_zac_1" => "        <input type=\"hidden\"%%1%%%%2%%%%3%%%%4%%%%5%% />\n",

                  "normal_vypis_form_select_zac_1" => "%%1%%<dd id=\"centralni_dd_%%2%%\">\n          <select%%3%%%%4%%%%5%%%%6%%%%7%%>",

                  "normal_vypis_form_select_kon_1" => "\n          </select>%%1%%\n        </dd>\n",

                  "normal_vypis_form_option_zac_kon_1" => "\n              <option%%1%%%%2%%%%3%%%%4%%>%%5%%</option>",

                  "normal_vypis_form_optgroup_zac_1" => "\n            <optgroup%%1%%%%2%%%%3%%%%4%%>",

                  "normal_vypis_form_captcha_zac_1" => "%%1%%",

                  "normal_vypis_form_elem_1" => "%%1%%",

                  "normal_vypis_end_form_1" => "      </dl>
      <p id=\"centralni_form_dodatek\">%%1%%</p>
    </fieldset>
  </form>",

                  "normal_email_text_1" => "%%1%%: %%2%%<br />\n",

                  "normal_email_zprava_1" => "%%1%%<br />\n<br />\n%%2%%<br />\nIP: %%3%%<br />\nHost: %%4%%<br />\nOS: %%5%%<br />\nBrowser: %%6%%<br />\nDatum: %%7%%",

                  "normal_email_header_1" => "%%1%%\nFrom: %%2%%",

                  "normal_email_send_true_1" => "odesláno majiteli",

                  "normal_email_send_false_1" => "něco se pokazilo",

                  "normal_email_send2_true_1" => ", odeslano oznameni",

                  "normal_email_send2_false_1" => ", něco na oznameni se pokazilo",

                  "normal_email_send_complet_1" => "data odeslána... %%1%%%%2%%, <a href=\"%%3%%\">přejít</a>",

                  "normal_input_error_captcha_1" => "chybne zadany captcha kod <a href=\"%%1%%\">přejít</a>",

                  "normal_input_error_1" => "chyba vstupnich dat! <a href=\"%%1%%\">přejít</a>",

                  //select
                  "admin_vstupni_typ_select_begin" => "<select name=\"vstupni_typ\" onchange=\"document.location.href='%%1%%&amp;vstupni_typ='+this.value\">",

                  "admin_vstupni_typ_select" => "
        <option value=\"%%1%%\"%%2%%>%%3%%</option>
      ",
                  "admin_vstupni_typ_select_end" => "</select>",

                  //select
                  "admin_typ_select_begin" => "<select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+this.value\">",

                  "admin_typ_select" => "
        <option value=\"%%1%%\"%%2%%>%%3%%</option>
      ",

                  "admin_typ_select_end" => "</select>",

                  "admin_formular_select_begin" => "<select name=\"formular\">",

                  "admin_formular_select" => "
            <option value=\"%%1%%\"%%2%%>adresa formuláře: %%3%%</option>
          ",
                  "admin_formular_select_end" => "</select>",

                  "admin_formular_select_null" => "žádný formulář",

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


                  "admin_obsah" => "administrace dynamické obrázkové galerie
    <br />
    <a href=\"%%1%%\" title=\"\">přidat formular</a><br />
    <a href=\"%%2%%\" title=\"\">test regularnich vyrazu</a><br />
    <br />
    %%3%%
    ",

                  "admin_test_rv" => "např:<br />
          email: <pre>/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/</pre>
          telefon: <pre>/^(\+420)?[0-9]{9}$/</pre>
          <form method=\"post\">
            <fieldset>
              <a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />
              vstup: <input type=\"text\" name=\"vstup\" value=\"%%1%%\" /><br />
              reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"%%2%%\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"otestovat\" />
            </fieldset>
          </form>
          výsledek:
          ",

                  "admin_test_rv_out" => "<strong>%%1%%</strong>",

                  "admin_add_form" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" />*<br />
              nazev: <input type=\"text\" name=\"nazev\" /><br />
              predmet: <input type=\"text\" name=\"predmet\" />*<br />
              <input type=\"checkbox\" name=\"odesilatel\" checked=\"checked\" onclick=\"(this.checked ? odes_1() : odes_2());\" /> posílat uživatelův email jako odesilatele *<br />
              odesilatel admin: <input type=\"text\" name=\"odesilateladmin\" id=\"id_odesilatel\" /><br />
              email: <input type=\"text\" name=\"email\" />*<br />
              text email: <input type=\"text\" name=\"textemail\" />*<br />
              dodatek: <input type=\"text\" name=\"dodatek\" /><br />
              oznameni: <input type=\"checkbox\" name=\"oznameni\" checked=\"checked\" /><br />
              predmet oznameni: <input type=\"text\" name=\"predmetoznameni\" /><br />
              odesilatel uzivatel: <input type=\"text\" name=\"odesilateluzivatel\" />*<br />
              text email oznameni: <input type=\"text\" name=\"textemailoznameni\" /><br />
              zdrojovy email: <input type=\"text\" name=\"zdrojovyemail\" />(name elementu)<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat formular\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            function odes_1()
            {
              document.getElementById('id_odesilatel').disabled = true;
            }

            function odes_2()
            {
              document.getElementById('id_odesilatel').disabled = false;
            }

            odes_1();
          </script>
          ",

                  "admin_add_form_hlaska" => "
                přídán: %%1%%
              ",

                  "admin_edit_form" => "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />*<br />
                  nazev: <input type=\"text\" name=\"nazev\" value=\"%%2%%\" /><br />
                  predmet: <input type=\"text\" name=\"predmet\" value=\"%%3%%\" />*<br />
                  <input type=\"checkbox\" name=\"odesilatel\"%%4%% onclick=\"(this.checked ? odes_1() : odes_2());\" /> posílat uživatelův email jako odesilatele *<br />
                  odesilatel admin: <input type=\"text\" name=\"odesilateladmin\" id=\"id_odesilatel\" value=\"%%5%%\" /><br />
                  email: <input type=\"text\" name=\"email\" value=\"%%6%%\" />*<br />
                  text email: <input type=\"text\" name=\"textemail\" value=\"%%7%%\" />*<br />
                  dodatek: <input type=\"text\" name=\"dodatek\" value=\"%%8%%\" /><br />
                  oznameni: <input type=\"checkbox\" name=\"oznameni\"%%9%% /><br />
                  predmet oznameni: <input type=\"text\" name=\"predmetoznameni\" value=\"%%10%%\" /><br />
                  odesilatel uzivatel: <input type=\"text\" name=\"odesilateluzivatel\" value=\"%%11%%\" />*<br />
                  text email oznameni: <input type=\"text\" name=\"textemailoznameni\" value=\"%%12%%\" /><br />
                  zdrojovy email: <input type=\"text\" name=\"zdrojovyemail\" value=\"%%13%%\" />(name elementu)<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit formular\" />
                </fieldset>
              </form>

              <script type=\"text/javascript\">
                function odes_1()
                {
                  document.getElementById('id_odesilatel').disabled = true;
                }

                function odes_2()
                {
                  document.getElementById('id_odesilatel').disabled = false;
                }

                %%14%%
              </script>
              ",

                  "admin_edit_form_hlaska" => "
                    upraven: %%1%%
                  ",

                  "admin_del_form_hlaska" => "
                  smazána adresa: %%1%% a jeho pod-elementy
                ",





                "admin_add_elem1" => "
            <form method=\"post\">
              <fieldset>
                %%1%%<br />
                nazev: <input type=\"text\" name=\"nazev\" /><br />
                <input type=\"submit\" name=\"tlacitko\" value=\"Přidat prvek\" />
              </fieldset>
            </form>
            ",

                  "admin_add_elem1_hlaska" => "
                  přídán typ element: %%1%%
                ",






                  "admin_add_elem_nazev" => "nazev: <input type=\"text\" name=\"nazev\" />%%1%%<br />",

                  "admin_add_elem_value" => "value: <input type=\"text\" name=\"value\" />%%1%%<br />",

                  "admin_add_elem_src" => "src: <input type=\"text\" name=\"src\" /><br />",

                  "admin_add_elem_readonly" => "readonly: <input type=\"checkbox\" name=\"readonly\" /><br />",

                  "admin_add_elem_disabled" => "disabled: <input type=\"checkbox\" name=\"disabled\" /><br />",

                  "admin_add_elem_label" => "label: <input type=\"checkbox\" name=\"label\" /><br />",

                  "admin_add_elem_konec" => "konec: <input type=\"checkbox\" name=\"konec\" /><br />", //^ok

                  "admin_add_elem_povinne" => "povinne: <input type=\"checkbox\" name=\"povinne\" />%%1%%<br />",

                  "admin_add_elem_vstupni_typ" => "vstupni_typ: %%1%%<br />",

                  "admin_add_elem_reg_exp" => "reg_exp: <input type=\"text\" name=\"reg_exp\" /><a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />",

                  "admin_add_elem_min_poc" => "min_poc: <input type=\"text\" name=\"min_poc\" value=\"0\" /><br />",

                  "admin_add_elem_max_poc" => "max_poc: <input type=\"text\" name=\"max_poc\" value=\"0\" /><br />",

                  "admin_add_elem" => "
                <form method=\"post\">
                  <fieldset>
                    formulář: %%1%%<br />
                    %%2%%<br />
                    %%3%%
                    %%4%%
                    input_class: <input type=\"text\" name=\"input_class\" /><br />
                    input_id: <input type=\"text\" name=\"input_id\" /><br />
                    input_akce: <input type=\"text\" name=\"input_akce\" /><br />
                    %%5%%
                    %%6%%
                    %%7%%
                    %%8%%
                    zacatek: <input type=\"checkbox\" name=\"zacatek\"%%9%% /><br />
                    %%10%%
                    %%11%%
                    %%12%%
                    %%13%%
                    %%14%%
                    %%15%%
                    poradi: <input type=\"text\" name=\"poradi\" value=\"%%16%%\" />*>0<br />
                    <input type=\"submit\" name=\"tlacitko\" value=\"Přidat element\" />
                  </fieldset>
                </form>
                ",

                  "admin_add_elem2_hlaska" => "
                      uložen element: %%1%%
                    ",

                  "admin_edit_elem_nazev" => "nazev: <input type=\"text\" name=\"nazev\" value=\"%%1%%\" />%%2%%<br />",

                  "admin_edit_elem_value" => "value: <input type=\"text\" name=\"value\" value=\"%%1%%\" />%%2%%<br />",

                  "admin_edit_elem_src" => "src: <input type=\"text\" name=\"src\" value=\"%%1%%\" /><br />",

                  "admin_edit_elem_readonly" => "readonly: <input type=\"checkbox\" name=\"readonly\"%%1%% /><br />",

                  "admin_edit_elem_disabled" => "disabled: <input type=\"checkbox\" name=\"disabled\"%%1%% /><br />",

                  "admin_edit_elem_label" => "label: <input type=\"checkbox\" name=\"label\"%%1%% /><br />",

                  "admin_edit_elem_konec" => "konec: <input type=\"checkbox\" name=\"konec\"%%1%% /><br />",

                  "admin_edit_elem_povinne" => "povinne: <input type=\"checkbox\" name=\"povinne\"%%1%% />%%2%%<br />",

                  "admin_edit_elem_vstupni_typ" => "vstupni_typ: %%1%%<br />",

                  "admin_edit_elem_reg_exp" => "reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" /><a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />",

                  "admin_edit_elem_min_poc" => "min_poc: <input type=\"text\" name=\"min_poc\" value=\"%%1%%\" /><br />",

                  "admin_edit_elem_max_poc" => "max_poc: <input type=\"text\" name=\"max_poc\" value=\"%%1%%\" /><br />",

                  "admin_edit_elem" => "
              <form method=\"post\">
                <fieldset>
                  formulář: %%1%%<br />
                  %%2%%<br />
                  %%3%%
                  %%4%%
                  input_class: <input type=\"text\" name=\"input_class\" value=\"%%5%%\" /><br />
                  input_id: <input type=\"text\" name=\"input_id\" value=\"%%6%%\" />%%7%%<br />
                  input_akce: <input type=\"text\" name=\"input_akce\" value=\"%%8%%\" /><br />
                  %%9%%
                  %%10%%
                  %%11%%
                  %%12%%
                  zacatek: <input type=\"checkbox\" name=\"zacatek\"%%13%% /><br />
                  %%14%%
                  %%15%%
                  %%16%%
                  %%17%%
                  %%18%%
                  %%19%%
                  poradi: <input type=\"text\" name=\"poradi\" value=\"%%20%%\" />*>0<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit element\" />
                </fieldset>
              </form>
              ",

                  "admin_edit_elem_hlaska" => "
                    uložen element: %%1%%
                  ",

                  "admin_del_elem_hlaska" => "
                  smazán element: %%1%%
                ",

                  "admin_vypis_obsah_begin_form" => "<br />
-------------------------------------------------------------------------------
          <br />
          %%1%% - %%2%%<p>%%3%% %%4%% %%5%%</p>
          <a href=\"%%6%%\" title=\"\">přidat prvek</a>
          <a href=\"%%7%%\" title=\"\">upravit formulář</a>
          <a href=\"%%8%%\" title=\"\" onclick=\"return confirm('Opravdu smazat formulář: \'%%1%%\' ?');\">smazat formulář</a><br />
          ",

                  "admin_vypis_obsah_end_form" =>
                  "-------------------------------------------------------------------------------",

                  "admin_vypis_obsah_elem" => "<br />
*******************************************************************************
                <br />
                <p>nazev: %%1%%, name: elem_%%2%%, typ: %%3%%, value: %%4%% pořadí: %%5%%</p>
                <br />
                <a href=\"%%6%%\" title=\"\">upravit prvek</a>
                <a href=\"%%7%%\" title=\"\" onclick=\"return confirm('Opravdu smazat prvek: \'%%1%%\' ?');\">smazat prvek</a><br />
                ",

                  "set_znakpovinne" => "\n          <span>*</span>",

                  "set_znakdoporuc" => "<<--",

                  "set_hlavicka" => "Content-type: text/html; charset=UTF-8",

                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
