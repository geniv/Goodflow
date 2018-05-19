<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický uživatel - tvůrce GUI",
                                              "title" => "administrace dynamickeho uživatele",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),

                                        array("main_href" => "%%2%%",
                                              "odkaz" => "Výpis uživatelů",
                                              "title" => "Výpis uživatelů",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  //logovani
                  "normal_login_user_true_1" => "byl jsi kupodivu uspěšně přhlášen <a href=\"%%1%%\">odkaz...</a>",

                  "normal_login_user_false_1" => "hahaa.. aj to věděl že něcou zkoušíš <a href=\"%%1%%\">odkaz...</a>",

                  "normal_login_user_empty_1" => "vubec ale vubec nic si nevyplnil <a href=\"%%1%%\">odkaz...</a>",

                  "normal_login_timeout_1" => 2,

                  "normal_login_user_off_1" => "
          přihlašování uživatele:<br />
          <form method=\"post\">
            <fieldset>
              <a href=\"%%5%%%%6%%\">zapomenuté heslo (nevíš coby? padej do OBI!)</a><br />
              Login: <input type=\"text\" name=\"login_user\" /> *<br />
              Heslo: <input type=\"password\" name=\"heslo_user\" /> *<br />
              <input type=\"submit\" value=\"Log-in\"%%1%%%%2%% /><br />
            </fieldset>
          </form>
          (%%3%%)
          %%4%%
                  ",

                  "normal_login_user_on_1" => "
                  <a href=\"%%1%%%%3%%\">log off</a><br />
                  <a href=\"%%1%%%%4%%\">info o uživateli: %%2%% (%%5%%)</a><br />
                  <a href=\"%%1%%%%6%%\">editace uživatele: %%2%% (%%7%%)</a><br />
                  <a href=\"%%1%%%%8%%\">výpis uživatelů (%%9%%)</a><br /><br />
                  ",

                  "normal_login_active_1" => "...aktivní",

                  "normal_login_user_logoff_1" => "užvatel %%1%% byl odhlášen
                  link: <a href=\"%%2%%\">link</a><br />
                  ",

                  //zapomenute heslo
                  "normal_forget_pass_1" => "
          přihlašování uživatele:<br />
          <form method=\"post\">
            <fieldset>
              <a href=\"%%5%%%%6%%\">zapomenuté heslo (nevíš coby? padej do OBI!)</a><br />
              váš login: <input type=\"text\" name=\"login_forget\" /> *<br />
              email: <input type=\"text\" name=\"email_forget\" /> *<br />
              <input type=\"submit\" value=\"pošli prosbu na změnu\"%%1%%%%2%% /><br />
              na email se vám zašle link na potvrzení změny hesla (s novym heslem), dokud na poslany link v emailu nekliknete tak
              bude heslo nadále zachováno, a změní se až po následném kliknutí a zprávě o tom že heslo bylo změněno,
              vygenerované heslo v ránci svých možnosti změňte a nebo nevim... :S :D
            </fieldset>
          </form>
          (%%3%%)
          %%4%%
                  ",

                                                  //generovani hesla pro zapometlive
                  "normal_abeceda_gen_pass_1" => "abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ0123456789",

                  "normal_length_gen_pass_1" => 30,

                  "normal_forget_pass_true_1" => "email s novým \"dočasným\" heslem byl zaslán na email, pokud na odkaz neklepnete geslo se prostě nezmění, a expirace je nastavena na několik dní...",

                  "normal_forget_pass_false_1" => "nic se neděje.. si zdřejmě jen vtipalek co něco zkouší, a nebo si takovy sklerotk že ani svuj login a heslo neznas!",

                  "normal_forger_pass_email_expire_1" => 3, //dni

                  "normal_forget_pass_timeout_1" => 5,  //s

                  "normal_forget_pass_email_subject_1" => "dosel ti email od tud... %%1%% na zmenu hesla",

                  "normal_forget_pass_email_message_1" => "zapoměl jsem heslo, já hlava dubová<br />
absolute: %%1%% - 1<br />
link: %%1%%%%2%% - 2<br />
login: %%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
                  ",

                  "normal_forget_pass_email_header_1" => "%%1%%\nFrom: %%2%%",

                  "normal_forget_pass_send_email_error_1" => "nepodařilo se odeslat email na změnu...",


                  //online user
                  "normal_online_user_true_1" => "%%3%% (%%4%%, %%6%%)",

                  "normal_online_user_true_select_1" => "<a href=\"%%1%%%%2%%\">%%3%% (%%4%%, %%6%%)</a>",

                  "normal_online_user_false_1" => "<a href=\"%%1%%%%2%%\">%%3%% (%%4%%, %%6%%)</a>",

                  "normal_online_user_oddel_1" => ", ",

                  "normal_online_user_tvar_datum_1" => "d.m.y H:i",


                  //info user
                  "normal_info_user_datum_1" => "H:i:s d.m.Y",

                  "normal_info_user_1" => "
              <script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-1.3.2.min.js\"></script>
              <script type=\"text/javascript\" src=\"%%1%%%%2%%/ajax.js\"></script>
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
%%1%%%%13%% - 13<br />
%%1%%%%14%% - 14<br />
%%15%% - 15<br />
%%16%% - 16<br />
%%17%% - 17<br />
%%18%% - 18<br />
%%19%% - 19<br />
%%20%% - 20<br />
%%21%% - 21<br />
%%22%% - 22<br />
%%23%% - 23<br />
%%24%% - 24<br />
%%25%% - 25<br />
%%26%% - 26<br />
%%27%% - 27<br />
%%28%% - 28<br />
%%29%% - 29<br />
%%30%% - 30<br />
                  ",

                  //editace
                  "normal_edit_user_1" => "
          <script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-1.3.2.min.js\"></script>
          <script type=\"text/javascript\" src=\"%%1%%%%2%%/ajax.js\"></script>

<h1>Editace profilu</h1>

          <form method=\"post\">
            <fieldset>
              Login: <input type=\"text\" name=\"login\" value=\"%%3%%\" /> *<br />
              Heslo: <input type=\"password\" name=\"heslo\" />
              <strong>(při změně hesla se musi vyplnit email [stejny email], v případě shody se pošle potvrzovaci email na email v DB)</strong><br />
              Email: <input type=\"text\" name=\"email\" id=\"id_email\" onkeyup=\"KontrolaEmalu('id_email', 'kontrola_email');\" onclick=\"KontrolaEmalu('id_email', 'kontrola_email');\" /> <span id=\"kontrola_email\"></span>
              <strong>(při změně emailu se musi vyplnit heslo [stejne heslo], při shodě hesla se odešle potvrzovaci email na stady email v DB)</strong><br />

              <br />
              <strong>link na sebe zrušení (musi se potvrdit a stavajici email a byt pod confirmem)</strong><br />
              <a href=\"%%1%%%%4%%\" onclick=\"return confirm('Opravdu chcete spácha sebevraždu ?');\">suicide user</a>
              <br /><br />

              absolute: %%1%%<br />
              dirpath: %%2%%<br />
              <br />
              (%%5%%) %%6%%: <input type=\"text\" value=\"%%8%%\"%%7%%% />%%12%%<br />
              (%%13%%) %%14%%: <input type=\"text\" value=\"%%16%%\"%%15%% />%%20%%<br />
              (%%21%%) %%22%%: <input type=\"radio\" value=\"%%22%%\"%%23%%%%24%% />%%26%%<br />
              (%%27%%) %%28%%: <input type=\"radio\" value=\"%%28%%\"%%29%%%%30%% />%%32%%<br />
              (%%33%%) %%34%%: <input type=\"radio\" value=\"%%34%%\"%%35%%%%36%% />%%38%%<br />
              (%%39%%) %%40%%: <input type=\"radio\" value=\"%%40%%\"%%41%%%%42%% />%%44%%<br />
              (%%45%%) %%46%%: <textarea%%47%%>%%48%%</textarea>%%52%%<br />
              (%%53%%) %%54%%: <input type=\"checkbox\" value=\"%%56%%\"%%55%%%%57%% />%%59%%<br />

              (%%60%%) %%61%%: <input type=\"text\" value=\"%%63%%\"%%62%% />%%64%%<br />
              <input type=\"submit\" value=\"upravit profil\"%%65%%%%66%% />(%%67%%)<br />
            </fieldset>
          </form>
                  ",

                  "normal_edit_user_hlaska_1" => "upraveno: %%1%%",

                  //format emailu na zmenu hesla
                  "normal_edit_pass_email_expire_1" => 3, //dni

                  "normal_edit_pass_email_subject_1" => "dosel ti email od tud... %%1%% na zmenu hesla",

                  "normal_edit_pass_email_message_1" => "měním heslo<br />
absolute: %%1%% - 1<br />
link: %%1%%%%2%% - 2<br />
login: %%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
                  ",

                  "normal_edit_pass_email_header_1" => "%%1%%\nFrom: %%2%%",

                  "normal_edit_pass_send_email_1" => "email odeslán na danou adresu: %%1%%",

                  "normal_edit_pass_send_email_error_1" => "nepodařilo se odeslat email na zrušení...",

                  //forma emailu na zmenu emailu
                  "normal_edit_email_email_expire_1" => 3, //dni

                  "normal_edit_email_email_subject_1" => "dosel ti email od tud... %%1%% na zmenu emailu",

                  "normal_edit_email_email_message_1" => "měním email<br />
absolute: %%1%% - 1<br />
link: %%1%%%%2%% - 2<br />
login: %%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
                  ",

                  "normal_edit_email_email_header_1" => "%%1%%\nFrom: %%2%%",

                  "normal_edit_email_send_email_1" => "email odeslán na danou adresu: %%1%%",

                  "normal_edit_email_send_email_error_1" => "nepodařilo se odeslat email na zrušení...",


                  "normal_edit_autoclick_1" => true,  //true/false - zapnuto/vypnuto auto click

                  "normal_edit_time_autoclick_1" => 5,  //s auto click

                  //suicide
                  "normal_suicide_email_subject_1" => "dosel ti email od tud... %%1%%",

                  "normal_suicide_email_message_1" => "tu klkni na tento kouzelny odkaz: %%1%%%%2%% na zrušení
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
%%14%% - 14<br />
%%15%% - 15<br />
%%16%% - 16<br />
%%17%% - 17<br />
%%18%% - 18<br />
%%19%% - 19<br />
%%20%% - 20<br />
%%21%% - 21<br />
%%22%% - 22<br />
%%23%% - 23<br />
%%24%% - 24<br />
%%25%% - 25<br />
%%26%% - 26<br />
%%27%% - 27<br />
%%28%% - 28<br />
%%29%% - 29<br />
%%30%% - 30<br />
                  ",

                  "normal_suicide_email_header_1" => "%%1%%\nFrom: email@email.cz",

                  "normal_suicide_send_email_1" => "email odeslán na danou adresu: %%1%%",

                  "normal_suicide_send_email_error_1" => "nepodařilo se odeslat email na zrušení...",

                  "normal_suicide_autoclick_1" => false,  //true/false - zapnuto/vypnuto auto click

                  "normal_suicide_time_autoclick_1" => 10, //s auto click

                  "normal_suicide_user_hlaska_1" => "byli jste odmazani!",

                  //prime mazani (admina)
                  "normal_suicide_self_user_hlaska_1" => "nelze v nevlastnickem modu smazat sebe sama (tedy: %%1%%) primo!",

                  "normal_suicide_other_user_hlaska_1" => "smazán uživatel: %%1%%, vysl: %%2%%",


                  "normal_suicide_other_email_subject_1" => "dosel ti email od tud... %%1%%",

                  "normal_suicide_other_email_message_1" => "
absolute: %%1%% - 1<br />
kdo mazal: %%2%% - 2<br />
koho: %%3%% - 3<br />
%%4%% - 4<br />
%%5%% - 5<br />
%%6%% - 6<br />
%%7%% - 7<br />
%%8%% - 8<br />
%%9%% - 9<br />
%%10%% - 10<br />
                  ",

                  "normal_suicide_other_email_header_1" => "%%1%%\nFrom: %%2%%",

                  "normal_suicide_other_send_email_1" => "email odeslán na danou other adresu: %%1%%",

                  "normal_suicide_other_time_autoclick_1" => 10, //s auto click

                  //list user
                  "normal_list_user_begin_1" => "
                  <script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-1.3.2.min.js\"></script>
                  <script type=\"text/javascript\" src=\"%%1%%%%2%%/ajax.js\"></script>
                  <br />
                  <div id=\"idzeme\"></div>
                  <br />
                  ",

                  "normal_list_user_1" => "
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
%%14%% - 14<br />
%%15%% - 15<br />
%%16%% - 16<br />
%%17%% - 17<br />
%%18%% - 18<br />
%%19%% - 19<br />
%%20%% - 20<br />
%%21%% - 21<br />
%%22%% - 22<br />
%%23%% - 23<br />
%%24%% - 24<br />
%%25%% - 25<br />
%%26%% - 26<br />
%%27%% - 27<br />
%%28%% - 28<br />
%%29%% - 29<br />
%%30%% - 30<br />

zjisti zemi: <a href=\"#\" onclick=\"GetZeme('%%10%%', 1, 'idzeme'); return false;\">zjisti zemi</a><br />
zjisti hostname: <a href=\"#\" onclick=\"GetHostName('%%10%%', 'idzeme'); return false;\">zjisti host name</a><br />
poslední přístupy: <a href=\"#\" onclick=\"GetLoginHistory(%%2%%, %%11%%, 1, 'idzeme'); return false;\">zjisti poslední přístupy</a><br />
<br />
                  ",

                  "normal_list_user_null_1" => "žádná uživatele",

                  "normal_list_user_datum_1" => "H:i:s d.m.Y",

                  "normal_list_user_online_true_1" => "je přítomen",

                  "normal_list_user_online_false_1" => "offline",

                  //info link
                  "normal_list_user_enable_info_1" => true,

                  "normal_list_user_enable_info_link_1" => "<a href=\"%%1%%%%2%%\">info</a>",

                  //edit link
                  "normal_list_user_enable_edit_1" => true,

                  "normal_list_user_enable_edit_link_1" => "<a href=\"%%1%%%%2%%\">edit</a>",

                  //del link
                  "normal_list_user_enable_del_1" => true,

                  "normal_list_user_enable_del_link_1" => "<a href=\"%%1%%%%2%%\" onclick=\"return confirm('Opravdu chcete podříznout uživatele: %%3%% ?');\">del</a>",

                  "normal_list_user_end_1" => "a to je vše přítelé...<br /><br /><br />",


                  //registrace
                  "normal_registrace_1" => "
          <script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-1.3.2.min.js\"></script>
          <script type=\"text/javascript\" src=\"%%1%%%%2%%/ajax.js\"></script>

<h1>Registrace</h1>

          <form method=\"post\">
            <fieldset>
              Login: <input type=\"text\" name=\"login\" value=\"%%3%%\" id=\"id_login\" onkeyup=\"KontrolaDuplicity('id_login', 'duplicita_loginu');\" onclick=\"KontrolaDuplicity('id_login', 'duplicita_loginu');\" /> * <span id=\"duplicita_loginu\"></span> (true = existuje!)<br />
              Heslo: <input type=\"password\" name=\"heslo\" id=\"id_heslo1\" /> *<br />
              Heslo (po 2): <input type=\"password\" name=\"heslo_2\" id=\"id_heslo2\" onkeyup=\"PorovnaniObsahu('id_heslo1', 'id_heslo2', 'porovnani_hesla');\" onclick=\"PorovnaniObsahu('id_heslo1', 'id_heslo2', 'porovnani_hesla');\" /> * <span id=\"porovnani_hesla\"></span><br />
              Email: <input type=\"text\" name=\"email\" value=\"%%4%%\" id=\"id_email1\" onkeyup=\"KontrolaEmalu('id_email1', 'kontrola_email');\" onclick=\"KontrolaEmalu('id_email1', 'kontrola_email');\" /> * <span id=\"kontrola_email\"></span><br />
              Email (po 2): <input type=\"text\" name=\"email_2\" value=\"%%5%%\" id=\"id_email2\" onkeyup=\"PorovnaniObsahu('id_email1', 'id_email2', 'porovnani_email');\" onclick=\"PorovnaniObsahu('id_email1', 'id_email2', 'porovnani_email');\" /> * <span id=\"porovnani_email\"></span><br />
              absolute: %%1%%<br />
              dirpath: %%2%%<br />
              <br />
              (%%6%%) %%7%%: <input type=\"radio\" value=\"%%7%%\"%%8%%%%9%%%%10%% />%%11%%<br />
              (%%12%%) %%13%%: <input type=\"radio\" value=\"%%13%%\"%%14%%%%15%%%%16%% />%%17%%<br />
              (%%18%%) %%19%%: <input type=\"radio\" value=\"%%19%%\"%%20%%%%21%%%%22%% />%%23%%<br />
              (%%24%%) %%25%%: <input type=\"radio\" value=\"%%25%%\"%%26%%%%27%%%%28%% />%%29%%<br />
              (%%30%%) %%31%%: <input type=\"checkbox\" value=\"%%33%%\"%%32%%%%34%%%%35%% />%%36%%<br />

              (%%37%%) %%38%%:<br />%%41%%<br /><input type=\"text\" value=\"%%42%%\"%%39%% />%%43%% (id captcha: %%40%%)<br />
              <input type=\"submit\" value=\"registracie\"%%44%%%%45%% />(%%46%%)<br />

              u deaktivovanych uzivatelu musi byt moznost znovu poslat autorzacni email
            </fieldset>
          </form>
                  ",

                  "normal_registrace_hlaska_1" => "přídán uživatel: %%1%%, aktivní bude až po potvrzení potvrzovaciho emailu z duvodu
                  odeleni zrna od plev",

                  "normal_email_subject_1" => "dosel ti email od tud... %%1%%",

                  "normal_email_message_1" => "tu klkni na tento kouzelny odkaz: %%1%%%%2%%
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
%%14%% - 14<br />
%%15%% - 15<br />
%%16%% - 16<br />
%%17%% - 17<br />
%%18%% - 18<br />
%%19%% - 19<br />
%%20%% - 20<br />
%%21%% - 21<br />
%%22%% - 22<br />
%%23%% - 23<br />
%%24%% - 24<br />
%%25%% - 25<br />
%%26%% - 26<br />
%%27%% - 27<br />
%%28%% - 28<br />
%%29%% - 29<br />
%%30%% - 30<br />
                  ",

                  "normal_email_header_1" => "%%1%%\nFrom: email@email.cz",

                  "normal_send_email_error_1" => "nepodařilo se odeslat email...",

                  "normal_reg_autoclick_1" => false,  //true/false - zapnuto/vypnuto auto click

                  "normal_reg_time_autoclick_1" => 10, //s auto click

                  //aktivace
                  "normal_activate_user_1" => "login: %%1%% aktivován... :D",

                  "normal_activate_del_user_1" => "jo! právě s to pěkně posral... vyprčela ti doba potřebná pro aktivaci loginu: %%1%% :D",

                  "normal_activate_act_user_1" => "ha, uživatel je aktivovany a nebo si tak blby a zkoušiš obejít človeče funkci! :D",

                  "normal_activate_change_pass_1" => "nove heslo nastaveno",

                  "normal_activate_change_email_1" => "novy email: %%1%%",

                  "normal_activate_forget_pass_1" => "nove heslo nastaveno loginu: %%1%%",

                  "normal_activate_timeout_1" => 5, //s

                  //chyby formulare (registrace + edit)
                  "normal_error_empty_1" => "nevyplnil si element: <strong>%%1%%</strong><br />",

                  "normal_error_min_max_1" => "nedodržení rozsahu v elementu: <strong>%%1%%</strong><br />",

                  "normal_error_min_1" => "nedodržení minima u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_max_1" => "překročení maxima u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_reg_exp_1" => "špatný tvar vstupu u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_radio_1" => "neoznačily jste ani jednu z následujících možností: <strong>%%1%%</strong><br />",

                  "normal_error_checkbox_1" => "je zapotřebí označit: <strong>%%1%%</strong><br />",

                  "normal_error_empty_captcha_1" => "nevyplnil si <strong>captcha kod</strong><br />",

                  "normal_error_wrong_captcha_1" => "zadal si špatně <strong>captcha kod</strong><br />",

                  "normal_checked_error_1" => "nezaškrkli jste potřebný element <strong>%%1%%</strong><br />",

                  "normal_error_unknown_1" => "blíže nespecifikovaná chyba v elementu: <strong>%%1%%</strong><br />",

                  "normal_error_hidden_1" => "<input type=\"hidden\" name=\"%%1%%\" value=\"%%2%%\" />",

                  "normal_error_duplicity_1" => "duplicita loginu: <strong>%%1%%</strong><br />",

                  "normal_error_pass_not_equal_1" => "nerovnaji se hesla",

                  "normal_error_wrong_email_1" => "špatný formát emailu: <strong>%%1%%</strong><br />",

                  "normal_error_email_not_equal_1" => "nerovnají se emaily",

                  "normal_error_button_1" => "<input type=\"submit\" name=\"error_tlacitko\" value=\"znovu skusit\" />",

                  "normal_error_end_1" => "chyby: <br />%%1%%<br /> <a href=\"%%4%%\">přejít</a><br />

                  <form method=\"post\" action=\"\" id=\"centralni_form\">
                    <fieldset>
                      %%2%%
                      %%3%%<br /><br />
                    </fieldset>
                  </form>
                  ",

                  //select
                  "admin_vstupni_typ_select_begin" => "<select name=\"vstupni_typ\" onchange=\"document.location.href='%%1%%&amp;vstupni_typ='+this.value\">",

                  "admin_vstupni_typ_select" => "
        <option value=\"%%1%%\"%%2%%>%%3%%</option>
      ",
                  "admin_vstupni_typ_select_end" => "</select>",

                  //select
                  "admin_typ_select_begin" => "<select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+this.value\">",

                  "admin_typ_select" => "
        <option value=\"%%1%%\"%%2%%>%%3%% - %%4%%</option>
      ",

                  "admin_typ_select_end" => "</select>",

                  "admin_formular_select_begin" => "<select name=\"formular\">",

                  "admin_formular_select" => "
            <option value=\"%%1%%\"%%2%%>adresa formuláře: %%3%%</option>
          ",
                  "admin_formular_select_end" => "</select>",

                  "admin_formular_select_null" => "žádný formulář",

                  "admin_obsah" => "administrace dynamického užvatele
    <br />
    <a href=\"%%1%%\" title=\"\">přidej GUI</a><br />
    <a href=\"%%2%%\" title=\"\">přidej uživatele</a><br />
    <a href=\"%%3%%\" title=\"\">test regularnich vyrazu</a><br />
    <a href=\"%%4%%\" title=\"\">statistiky</a><br />
    <br />
    %%5%%
    ",

                  "admin_test_rv" => "např:<br />
          email: <pre>/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/</pre>
          telefon: <pre>/^(\+420)?[0-9]{9}$/</pre>
          <form method=\"post\">
            <fieldset>
              <a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" target=\"_blank\">dokumentace</a><br />
              vstup: <input type=\"text\" name=\"vstup\" value=\"%%1%%\" /><br />
              reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"%%2%%\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"otestovat\" />
            </fieldset>
          </form>
          výsledek:

          <strong>%%3%%</strong>
          %%4%%
          ",

                  "admin_addedit_elem_value" => "Value: <input type=\"text\" name=\"value\" value=\"%%1%%\" /><br />",

                  "admin_addedit_elem_captcha" => "Captcha ID: <input type=\"text\" name=\"value\" value=\"%%1%%\" /> (ID captcha kodu!!)<br />",

                  "admin_addedit_elem_group" => "Skupinové jméno: <input type=\"text\" name=\"value\" value=\"%%1%%\" /> (u 2 a více radio button musi byt stejný nazev jinak mezi sebou nepřepínají!)<br />",

                  "admin_addedit_elem_readonly" => "Jen pro čtení: <input type=\"checkbox\" name=\"readonly\"%%1%% /> (readonly)<br />",

                  "admin_addedit_elem_disabled" => "Zakazat: <input type=\"checkbox\" name=\"disabled\"%%1%% /> (disabled)<br />",

                  "admin_addedit_elem_vstupni_typ" => "Vstupní typ: %%1%%<br />",

                  "admin_addedit_elem_reg_exp" => "reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" /> <a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" target=\"_blank\">dokumentace</a><br />",

                  "admin_addedit_elem_vystupni_typ" => "Výstupní formát: <input type=\"text\" name=\"format\" value=\"%%1%%\" /> (%%1%%, %%2%%)<br />",

                  "admin_addedit_elem_minmax_val" => "Minimalní hodnota: <input type=\"text\" name=\"min_val\" value=\"%%1%%\" /> (u textu min počet, u čísla min hodnota)<br />
                                                      Maximální hodnota: <input type=\"text\" name=\"max_val\" value=\"%%2%%\" /> (u textu max počet, u čísla max hodnota)<br />",

                  "admin_add_gui" => "
          <form method=\"post\">
            <fieldset>
              Název: <input type=\"text\" name=\"nazev\" /> *<br />
              Typ položky: %%1%%<br />
              %%2%%
              Zobrazit v registraci: <input type=\"checkbox\" name=\"registrace\" /><br />
              Zobrazit v profilu: <input type=\"checkbox\" name=\"profil\" /><br />
              %%3%%
              %%4%%
              %%5%%
              %%6%%
              Povinné: <input type=\"checkbox\" name=\"povinne\" /> (*)<br />
              %%7%%
              %%8%%
              %%9%%
              %%10%%
              Pořadí: <input type=\"text\" name=\"poradi\" value=\"%%11%%\" /> *<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat položku\" />
            </fieldset>
          </form>
                  ",

                  "admin_add_gui_hlaska" => "
                přídán: %%1%%
              ",

                  "admin_edit_gui" => "
          <form method=\"post\">
            <fieldset>
              Název: <input type=\"text\" name=\"nazev\" value=\"%%1%%\" /> *<br />
              Typ položky: %%2%%<br />
              %%3%%
              %%4%%
              %%5%%
              Zobrazit v registraci: <input type=\"checkbox\" name=\"registrace\"%%6%% /><br />
              Zobrazit v profilu: <input type=\"checkbox\" name=\"profil\"%%7%% /><br />
              %%8%%
              %%9%%
              Povinné: <input type=\"checkbox\" name=\"povinne\"%%10%% /> (*)<br />
              %%11%%
              %%12%%
              %%13%%
              %%14%%
              Pořadí: <input type=\"text\" name=\"poradi\" value=\"%%15%%\" /> *<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit položku\" />
            </fieldset>
          </form>
                  ",

                  "admin_edit_gui_hlaska" => "
                    upraven: %%1%%
                  ",

                  "admin_del_gui_hlaska" => "
                  smazán: %%1%%
                ",


                  "admin_error_empty" => "nevyplnil si element: <strong>%%1%%</strong><br />",

                  "admin_error_min_max" => "nedodržení rozsahu v elementu: <strong>%%1%%</strong><br />",

                  "admin_error_min" => "nedodržení minima u elementu: <strong>%%1%%</strong><br />",

                  "admin_error_max" => "překročení maxima u elementu: <strong>%%1%%</strong><br />",

                  "admin_error_reg_exp" => "špatný tvar vstupu u elementu: <strong>%%1%%</strong><br />",

                  "admin_error_radio" => "neoznačily jste ani jednu z následujících možností: <strong>%%1%%</strong><br />",

                  "admin_error_checkbox" => "je zapotřebí označit: <strong>%%1%%</strong><br />",

                  "admin_error_empty_captcha" => "nevyplnil si <strong>captcha kod</strong><br />",

                  "admin_error_wrong_captcha" => "zadal si špatně <strong>captcha kod</strong><br />",

                  "admin_checked_error" => "nezaškrkli jste potřebný element <strong>%%1%%</strong><br />",

                  "admin_error_unknown" => "blíže nespecifikovaná chyba v elementu: <strong>%%1%%</strong><br />",

                  "admin_error_hidden" => "<input type=\"hidden\" name=\"%%1%%\" value=\"%%2%%\" />\n",

                  "admin_error_button" => "<input type=\"submit\" name=\"error_tlacitko\" value=\"znovu skusit\" />",

                  "admin_error_end" => "chyby: <br />%%1%%<br /> <a href=\"%%4%%\">přejít</a><br />

                  <form method=\"post\" action=\"\" id=\"centralni_form\">
                    <fieldset>
                      %%2%%
                      %%3%%<br />
                    </fieldset>
                  </form>
                  ",


                  "admin_addeditobsah_popisek" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" onkeyup=\"KontrolaFormatu(this.value, 0, %%2%%, 'id_elem_%%2%%');\"%%4%% value=\"%%3%%\" /><span id=\"id_elem_%%2%%\"></span>%%5%% (%%6%%)<br />\n",

                  "admin_addeditobsah_text" => "%%1%% <textarea name=\"elem_%%2%%\"%%4%%>%%3%%</textarea>%%5%% (%%6%%)<br />\n",

                  "admin_addeditobsah_datum" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\" />(format: %%5%%, %%6%%) %%4%% (%%7%%)<br />\n",

                  "admin_addeditobsah_cas" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\" />(format: %%5%%, %%6%%) %%4%% (%%7%%)<br />\n",

                  "admin_addeditobsah_datumcas" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\" />(format: %%5%%, %%6%%) %%4%% (%%7%%)<br />\n",

                  "admin_addeditobsah_checkbox" => "%%1%% <input type=\"checkbox\" name=\"elem_%%2%%\" value=\"%%3%%\"%%5%% />%%4%% (%%6%%)<br />\n",

                  "admin_addeditobsah_radio" => "%%1%% <input type=\"radio\" name=\"%%3%%\" value=\"%%1%%\"%%5%% />%%4%% (%%6%%)<br />\n",

                  "admin_addeditobsah_captcha" => "%%5%%<br />%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%4%%\" />%%6%% (%%7%%, slovo: %%4%%, id captcha: %%3%%)<br />\n",
//<script type=\"text/javascript\" src=\"%%2%%/ajax.js\"></script>
////$(document).ready(function(){  });  //dopsat a nasadit do generovanych!
//<script type=\"text/javascript\" src=\"%%2%%/jquery-ui-1.7.1.custom.min.js\"></script>
//Heslo (po 2): <input type=\"password\" name=\"heslo_2\" id=\"id_heslo2\" onkeyup=\"PorovnaniObsahu('id_heslo1', 'id_heslo2', 'porovnani_hesla');\" /> * <span id=\"porovnani_hesla\"></span><br />
//Email (po 2): <input type=\"text\" name=\"email_2\" value=\"\" id=\"id_email2\" onkeyup=\"PorovnaniObsahu('id_email1', 'id_email2', 'porovnani_email');\" /> * <span id=\"porovnani_email\"></span><br />

                  "admin_add_user" => "
          <script type=\"text/javascript\" src=\"%%2%%/jquery-1.3.2.min.js\"></script>
          <script type=\"text/javascript\" src=\"%%2%%/ajax.js\"></script>

          <form method=\"post\">
            <fieldset>
              Login: <input type=\"text\" name=\"login\" value=\"%%3%%\" id=\"id_login\" onkeyup=\"KontrolaDuplicity(this.value, 'duplicita_loginu');\" /> * <span id=\"duplicita_loginu\"></span> (true = existuje!)<br />
              Heslo: <input type=\"password\" name=\"heslo\" id=\"id_heslo1\" /> *<br />
              Email: <input type=\"text\" name=\"email\" value=\"%%4%%\" id=\"id_email1\" onkeyup=\"KontrolaEmalu(this.value, 'kontrola_email');\" /> * <span id=\"kontrola_email\"></span><br />
              Aktivní: <input type=\"checkbox\" name=\"aktivni\"%%5%% /><br />
              %%1%%
              <input type=\"submit\"%%6%%%%7%% value=\"Přidat uživatele\" />(%%8%%)
            </fieldset>
          </form>
                  ",

                  "admin_add_user_hlaska" => "přídán uživatel: %%1%%",

                  "admin_edit_user" => "
          <script type=\"text/javascript\" src=\"%%2%%/jquery-1.3.2.min.js\"></script>
          <script type=\"text/javascript\" src=\"%%2%%/ajax.js\"></script>

          <form method=\"post\">
            <fieldset>
              Login: <input type=\"text\" name=\"login\" value=\"%%3%%\" id=\"id_login\" onkeyup=\"KontrolaDuplicity('id_login', 'duplicita_loginu');\" /> * <span id=\"duplicita_loginu\"></span> (true = existuje!)<br />
              Heslo: <input type=\"password\" name=\"heslo\" /> *<br />
              Email: <input type=\"text\" name=\"email\" value=\"%%4%%\" id=\"id_email\" onkeyup=\"KontrolaEmalu('id_email', 'kontrola_email');\" /> * <span id=\"kontrola_email\"></span><br />
              Aktivní: <input type=\"checkbox\" name=\"aktivni\"%%5%% /><br />
              %%1%%
              <input type=\"submit\"%%6%%%%7%% value=\"Upravit uživatele\" />(%%8%%)
            </fieldset>
          </form>
                  ",

                  "admin_edit_user_hlaska" => "upraven: %%1%%",

                  "admin_del_user_hlaska" => "smazán: %%1%%",

                  "admin_vypis_obsah_gui_begin" => "
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
<div id=\"obal_razeni\">\n",

                  "admin_vypis_obsah_gui" => "
                <ul id=\"recordsArray_%%1%%\">
                  id: %%1%%<br />
                  <li class=\"poradi_id\">Pořadí: [%%2%%]</li>
                  název: %%3%%<br />
                  typ: %%4%%<br />
                  registrace: <input type=\"checkbox\" disabled=\"disabled\"%%5%% /><br />
                  profil: <input type=\"checkbox\" disabled=\"disabled\"%%6%% /><br />
                  povinne: <input type=\"checkbox\" disabled=\"disabled\"%%7%% /><br />
                  <a href=\"%%8%%\" title=\"\">upravit GUI</a>
                  <a href=\"%%9%%\" title=\"\" onclick=\"return confirm('Opravdu smazat formulář: \'%%3%%\' ?');\">smazat GUI</a><br />
                </ul>\n
                  ",

                  "admin_vypis_obsah_gui_end" => "
</div>
<div id=\"status_drag\">
  <p>Položky mají funkci \"drag and drop\"</p>
</div>",

                  "ajax_update_records_listings" => "Změnil jsi pořadí položky v gui !",


                  "admin_vypis_obsah_user_begin" => "
                  <a href=\"%%1%%\">přidat uživatele</a><br /><br />
          <script type=\"text/javascript\" src=\"%%2%%/jquery-1.3.2.min.js\"></script>
          <script type=\"text/javascript\" src=\"%%2%%/ajax.js\"></script>
          %%3%%<br />
          <div id=\"idzeme\"></div>
                  ",

                  "admin_vypis_obsah_user_end" => "
                  konec vypisu...
                  ",

                  "admin_vypis_obsah_user_datum" => "H:i:s d.m.Y",

                  "admin_vypis_obsah_user_online_true" => "je právě přihlášen",

                  "admin_vypis_obsah_user_online_false" => "...",

                  "admin_vypis_obsah_user" => "
                  login: %%2%%<br />
                  email: %%3%%<br />
                  přidáno: %%4%%<br />
                  upraveno: %%5%%<br />
                  aktivni: <input type=\"checkbox\"%%6%% disabled=\"disabled\" /><br />
                  posledni přihlášení: %%7%%<br />
                  aktualní stav: %%8%%<br />
                  last ip: %%9%%<br />
                  host name: <a href=\"#\" onclick=\"GetHostName('%%9%%', 'hostname_out_%%1%%'); return false;\">zjisti ip hostname</a> <span id=\"hostname_out_%%1%%\"></span><br />
                  zjisti zemi: <a href=\"#\" onclick=\"GetZeme('%%9%%', 1, 'ip_out_%%1%%'); return false;\">zjisti zemi (idzeme)</a> <span id=\"ip_out_%%1%%\"></span><br />
                  browser: %%10%%<br />
                  os: %%11%%<br />
                  zjisti zemi: <a href=\"#\" onclick=\"GetLoginHistory(%%1%%, false, 1, 'userlog_out_%%1%%'); return false;\">vypiš historii logu uživatele</a> <span id=\"userlog_out_%%1%%\"></span><br />
                  <a href=\"%%12%%\">upravit uživatele</a>
                  <a href=\"%%13%%\" onclick=\"return confirm('Opravdu smazat uživatele: \'%%2%%\' ?');\">smazat uživatele</a><br />
<strong>položky:</strong><br />
%%14%% - 14<br />
%%15%% - 15<br />
%%16%% - 16<br />
%%17%% - 17<br />
%%18%% - 18<br />
%%19%% - 19<br />
%%20%% - 20<br />
%%21%% - 21<br />
%%22%% - 22<br />
%%23%% - 23<br />
%%24%% - 24<br />
%%25%% - 25<br />
%%26%% - 26<br />
%%27%% - 27<br />
%%28%% - 28<br />
%%29%% - 29<br />
%%30%% - 30<br />
                  <br /><br />
                  ",

                  "admin_vypis_obsah_user_null" => "žádná položka...<br /><br />",










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
                <p>nazev: %%1%%, name: elem_%%2%%, typ: %%3%%, value: %%4%%, pořadí: %%5%%</p>
                <br />
                <a href=\"%%6%%\" title=\"\">upravit prvek</a>
                <a href=\"%%7%%\" title=\"\" onclick=\"return confirm('Opravdu smazat prvek: \'%%1%%\' ?');\">smazat prvek</a><br />
                ",

                  "set_znacka_povinne" => "\n          <span>*</span>",

                  "set_input" => array ("popisek" => "Krátký popisek",
                                        "text"     => "Dlouhé texty",
                                        "datum"    => "Datum",
                                        "cas"      => "Čas",
                                        "datumcas" => "Datum a čas",
                                        "checkbox" => "zaškrkávací políčko",
                                        "radio"    => "výběrové políčko",
                                        "captcha"  => "captcha kod",
                                        ),

                  "set_expire_user" => 3, //dny expirace registrace

                  "set_wordroz" => "91827364-5",

                  "set_idautorizace" => "autorizace",

                  "set_idinfouser" => "userinfo",

                  "set_idedituser" => "useredit",

                  "set_idsuicide" => "usersuicide",

                  "set_idlistuser" => "userlist",

                  "set_idlogoff" => "userlogoff",

                  "set_idforgetpass" => "forgetpass",

                  "set_iduserid" => "id",

                  "set_cookiename" => "USER",

                  "set_time_active" => 5, //minut online

                  "set_count_log_del" => 50,  //na X zaznamu!!!

                  "set_pathscript" => "script",

                  "set_undying_user" => array(1, //výčet nesmrtelných uživatelů, jelich ID, kvuli nezamenitelnosti!
                                              2,
                                              3),

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

                  "ajax_dobre" => "true",

                  "ajax_spatne" => "false",

                  "ajax_set_get_id" => "id",

                  "ajax_set_get_sablona" => "sablona",

                  "ajax_set_get_text" => "text",

                  "ajax_porovnani_true" => "true",

                  "ajax_porovnani_false" => "false",

                  "ajax_duplicita_true" => "true",

                  "ajax_duplicita_false" => "false",

                  //zjistovani zeme
                  "ajax_zeme_notfound_1" => "žádná země",

                  "ajax_zeme_local_1" => "localhost",

                  "ajax_get_zeme_1" => "
                  ip adrese: %%1%% odpovídá: %%2%%
                  ",

                  //vypis prihlasovaci historie
                  "ajax_vypis_getloginhistory_1" => "
                přihlášen: %%2%% (%%1%%)<br />
                (poslední) aktivita (/do): %%3%%<br />
                ip: %%4%%<br />
                %%5%%<br />
                %%6%%<br /><br />
                  ",

                  "ajax_tvar_datumu_getloginhistory_1" => "d.m.Y H:i:s",

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


                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
