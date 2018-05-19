<?php

/* -------------------------------------------------------------------------- */

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
                                              "zobrazit" => false)
                                        ),

                  "normal_vypis_form_1" => "
<form method=\"post\" action=\"\">
  <fieldset>
    <label class=\"jmeno_email\">
      <span>%%5%%</span>
      <input type=\"text\" name=\"%%4%%\" value=\"\" />
    </label>
    <label class=\"jmeno_email\">
      <span>%%13%%</span>
      <input type=\"text\" name=\"%%12%%\" value=\"\" />
    </label>
    <label class=\"captcha\">
      <span>Ověření</span>
      <span>Zde opište obrázek</span>
      %%22%%
      <input type=\"text\" name=\"%%20%%\" value=\"\" maxlength=\"4\" />
    </label>
    <label class=\"zprava\">
      <span>%%27%%</span>
      <textarea name=\"%%26%%\" rows=\"20\" cols=\"60\"></textarea>
    </label>
    <label class=\"form_submit\">
      <input type=\"submit\" name=\"%%33%%\" value=\"&nbsp;\" />
    </label>
  </fieldset>
</form>",


/*


<form method=\"post\" action=\"\">
  <fieldset>
    <label class=\"jmeno_email\">
      <span>Jméno</span>
      <input type=\"text\" name=\"\" value=\"\" />
    </label>
    <label class=\"jmeno_email\">
      <span>Email</span>
      <input type=\"text\" name=\"\" value=\"\" />
    </label>
    <label class=\"captcha\">
      <span>Ověření</span>
      <span>Zde opište obrázek</span>
      <img src=\"{$absolute_url}captcha.png\" alt=\"\" />
      <input type=\"text\" name=\"\" value=\"\" />
    </label>
    <label class=\"zprava\">
      <span>Vaše zpráva</span>
      <textarea name=\"\" rows=\"20\" cols=\"60\"></textarea>
    </label>

    <label class=\"form_submit\">
      <input type=\"submit\" name=\"\" value=\"&nbsp;\" />
    </label>

  </fieldset>
</form>


*/





                  "normal_email_send_complet_1" => "
                  <div id=\"kontakt_odeslan\">
                    <h4>Formulář byl odeslán, děkujeme za Váš zájem.</h4>
                    <p>Můžete pokračovat klapnutím na <a href=\"%%3%%\" title=\"Můžete pokračovat klapnutím na tento odkaz\">tento odkaz</a>.</p>
                  </div>",

                  "normal_error_empty_1" => "                    <p>Nevyplněná položka: <strong>%%1%%</strong></p>\n",

                  "normal_error_min_max_1" => "                    <p>Nebyl dodržen rozsah v položce: <strong>%%1%%</strong></p>\n",

                  "normal_error_min_1" => "                    <p>Nebyl dodržen minimální rozsah v položce: <strong>%%1%%</strong></p>\n",

                  "normal_error_max_1" => "                    <p>Nebyl dodržen maximální rozsah v položce: <strong>%%1%%</strong></p>\n",

                  "normal_error_reg_exp_1" => "                    <p>Špatně vyplněná položka: <strong>%%1%%</strong></p>\n",

                  "normal_error_empty_captcha_1" => "                    <p>Nevyplněná položka: <strong>Kontrola</strong></p>\n",

                  "normal_error_wrong_captcha_1" => "                    <p>Špatně vyplněná položka: <strong>Kontrola</strong></p>\n",

                  "normal_error_unkown_1" => "",

                  "normal_error_hidden_1" => "<input type=\"hidden\" name=\"%%1%%\" value=\"%%2%%\" />",

                  "normal_error_button_1" => "<input type=\"submit\" name=\"error_tlacitko\" value=\"POKRAČOVAT\" />",

                  "normal_error_end_1" => "
                  <div id=\"kontakt_neodeslan\">
                    <h4>Formulář nebyl odeslán kvůli nekorektnímu vyplnění</h4>
%%1%%                    <div class=\"input_submit\">
                      <span class=\"submit_pozadi\"><!-- --></span>
                      %%2%%%%3%%
                    </div>
                  </div>",

/* -------------------------------------------------------------------------- */

                  );

/* -------------------------------------------------------------------------- */

  return $result;
?>
