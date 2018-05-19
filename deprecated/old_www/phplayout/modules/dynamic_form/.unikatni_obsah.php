<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický fomulář",
                                              "title" => "administrace dynamickeho fomulare",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_form_1" => "
          <script type=\"text/javascript\" src=\"%%1%%%%2%%/ajax.js\"></script>

                  <form method=\"post\" action=\"\" id=\"centralni_form\">
                    <fieldset>
                      %%5%% <input type=\"text\"%%4%%%%7%%%%8%%%%9%% onkeyup=\"KontrolaFormatu(this.value, 0, %%3%%, 'id_elem_%%3%%');\" value=\"%%6%%\" /> %%10%% <div id=\"id_elem_%%3%%\"></div><div id=\"id_elem_%%3%%_fin\">vysledek</div><br />
                      %%13%% <input type=\"text\"%%12%%%%15%%%%16%%%%17%% onkeyup=\"KontrolaFormatu(this.value, 0, %%11%%, 'id_elem_%%11%%');\" value=\"%%14%%\" /> %%18%% <div id=\"id_elem_%%11%%\"></div><div id=\"id_elem_%%11%%_fin\">vysledek</div><br />

                      %%22%%<br />
                      <input type=\"text\"%%20%% /> %%24%%, nezobrazovat: (%%23%%)<br />

                      <input type=\"submit\"%%26%%%%28%% value=\"%%27%%\" /> %%29%%<br />
                    </fieldset>
                  </form>
                  %%50%%
                  <hr />
%%1%% - 1
%%2%% - 2
%%3%% - 3
%%4%% - 4
%%5%% - 5
%%6%% - 6
%%7%% - 7
%%8%% - 8
%%9%% - 9
%%10%% - 10
%%11%% - 11
%%12%% - 12
%%13%% - 13
%%14%% - 14
%%15%% - 15
%%16%% - 16
%%17%% - 17
%%18%% - 18
%%19%% - 19
%%20%% - 20
%%21%% - 21
%% 22 %% - 22
%%23%% - 23
%%24%% - 24
%%25%% - 25
%%26%% - 26
%%27%% - 27
%%28%% - 28
%%29%% - 29
%%30%% - 30
%%31%% - 31
%%32%% - 32
%%33%% - 33
%%34%% - 34
%%35%% - 35
%%36%% - 36
%%37%% - 37
%%38%% - 38
%%39%% - 39
%%40%% - 40
%%41%% - 41
%%42%% - 42
%%43%% - 43
%%44%% - 44
%%45%% - 45
%%46%% - 46
%%47%% - 47
%%48%% - 48
%%49%% - 49
%%50%% - 50
%%51%% - 51
%%52%% - 52
%%53%% - 53
%%54%% - 54
%%55%% - 55
%%56%% - 56
%%57%% - 57
%%58%% - 58
%%59%% - 59
%%60%% - 60
<hr />
                  ",

                  "normal_datum_admin_email_1" => "d.m.y / H:i:s",

                  "normal_email_header_1" => "%%1%%\nFrom: %%2%%",

                  "normal_email_send_true_1" => "odesláno majiteli",

                  "normal_email_send_false_1" => "něco se pokazilo",

                  "normal_email_send2_true_1" => ", odeslano oznameni",

                  "normal_email_send2_false_1" => ", něco na oznameni se pokazilo",

                  "normal_email_send_complet_1" => "data odeslána... %%1%%%%2%%, <a href=\"%%3%%\">přejít</a>",


                  "normal_error_empty_1" => "nevyplnil si element: <strong>%%1%%</strong><br />",

                  "normal_error_min_max_1" => "nedodržení rozsahu v elementu: <strong>%%1%%</strong><br />",

                  "normal_error_min_1" => "nedodržení minima u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_max_1" => "překročení maxima u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_reg_exp_1" => "špatný tvar vstupu u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_empty_captcha_1" => "nevyplnil si <strong>captcha kod</strong><br />",

                  "normal_error_wrong_captcha_1" => "zadal si špatně <strong>captcha kod</strong><br />",

                  "normal_checked_error_1" => "nezaškrkli jste potřebný element <strong>%%1%%</strong><br />",

                  "normal_error_unkown_1" => "blíže nespecifikovaná chyba v elementu: <strong>%%1%%</strong><br />",

                  "normal_error_hidden_1" => "<input type=\"hidden\" name=\"elem_%%1%%\" value=\"%%2%%\" />",

                  "normal_error_button_1" => "<input type=\"submit\" name=\"error_tlacitko\" value=\"znovu skusit\" />",

                  "normal_error_end_1" => "chyby: <br />%%1%%<br /> <a href=\"%%4%%\">přejít</a><br />

                  <form method=\"post\" action=\"\" id=\"centralni_form\">
                    <fieldset>
                      %%2%%
                      %%3%%<br />
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
              <a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" target=\"_blank\">dokumentace</a><br />
              vstup: <input type=\"text\" name=\"vstup\" value=\"%%1%%\" /><br />
              reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"%%2%%\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"otestovat\" />
            </fieldset>
          </form>
          výsledek:

          %%3%%
          %%4%%
          ",

                  "admin_add_form" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /> *<br />
              nazev: <input type=\"text\" name=\"nazev\" /><br />
              predmet: <input type=\"text\" name=\"predmet\" /> * (předmět emailu pro adminy)<br />

              (použít uživatelův email jako odesilatele [from] pro adminy)<br />
              <input type=\"radio\" name=\"odesilatel\" value=\"true\" checked=\"checked\" onclick=\"CheckOdeslatelSolid();\" />
              odesilatel admin: <input type=\"text\" name=\"odesilateladmin\" id=\"id_odesilateladmin\" /> * (uvest tento email jako odesilatele [from] pro adminy)<br />
              <input type=\"radio\" name=\"odesilatel\" value=\"false\" onclick=\"CheckOdeslatelFlexible();\" />
              zdrojovy email: <input type=\"text\" name=\"zdrojovyemail\" id=\"id_zdrojovyemail\" value=\"elem_?\" /> * (name elementu, tedy spíš jeho číslo, pri oznamovani musi byt spravne vyplneny)<br />

              email: <textarea name=\"email\"></textarea> * (email/y adminu)<br />
              text email: <textarea name=\"textemail\"></textarea> * (uvodni text emalu, formát: @@XX@@)<br />
              dodatek: <input type=\"text\" name=\"dodatek\" /> (dodatek pod cely formular)<br />
              oznameni: <input type=\"checkbox\" name=\"oznameni\" onclick=\"CheckOznameni(this.checked);\" /> (zapnout/vypnout potvrzeni o odeslani formulare, dojde na email ktery zada uzivatel, email vezme z elementu: zdrojovyemail)<br />
              predmet oznameni: <input type=\"text\" name=\"predmetoznameni\" id=\"id_predmetoznameni\" /> (predmet oznameni pro uzivatele)<br />
              odesilatel uzivatel: <input type=\"text\" name=\"odesilateluzivatel\" id=\"id_odesilateluzivatel\" /> * (email odesilate [from] pro uživatele)<br />
              text email oznameni: <textarea  name=\"textemailoznameni\" id=\"id_textemailoznameni\"></textarea> (uvodní text oznámení, formát: @@XX@@)<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat formular\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            function CheckOdeslatelSolid()
            {
              document.getElementById('id_odesilateladmin').disabled = false;
              document.getElementById('id_zdrojovyemail').disabled = true;
            }

            function CheckOdeslatelFlexible()
            {
              document.getElementById('id_odesilateladmin').disabled = true;
              document.getElementById('id_zdrojovyemail').disabled = false;
            }

            function CheckOznameni(stav)
            {
              document.getElementById('id_predmetoznameni').disabled = !stav;
              document.getElementById('id_odesilateluzivatel').disabled = !stav;
              document.getElementById('id_textemailoznameni').disabled = !stav;
            }

            CheckOdeslatelSolid();
            CheckOznameni(false);
          </script>
          ",

                  "admin_add_form_hlaska" => "
                přídán: %%1%%
              ",

                  "admin_edit_form" => "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /> *<br />
                  nazev: <input type=\"text\" name=\"nazev\" value=\"%%2%%\" /><br />
                  predmet: <input type=\"text\" name=\"predmet\" value=\"%%3%%\" /> * (předmět emailu pro adminy)<br />

                  (použít uživatelův email jako odesilatele [from] pro adminy)<br />
                  <input type=\"radio\" name=\"odesilatel\" value=\"true\"%%4%% onclick=\"CheckOdeslatelSolid();\" /> *
                  odesilatel admin: <input type=\"text\" name=\"odesilateladmin\" id=\"id_odesilateladmin\" value=\"%%5%%\" /> (uvest tento email jako odesilatele [from] pro adminy, na tvrdo)<br />
                  <input type=\"radio\" name=\"odesilatel\" value=\"false\"%%6%% onclick=\"CheckOdeslatelFlexible();\" /> *
                  zdrojovy email pro admina: <input type=\"text\" name=\"zdrojovyemail\" id=\"id_zdrojovyemail\" value=\"%%7%%\" /> (name elementu, tedy spíš jeho číslo, dle emailu co zada svuj email, pri oznamovani musi byt spravne vyplneny)<br />

                  email: <textarea name=\"email\">%%8%%</textarea> * (email/y adminu)<br />
                  text email: <textarea name=\"textemail\">%%9%%</textarea> * (uvodni text emalu, formát: @@XX@@)<br />
                  dodatek: <input type=\"text\" name=\"dodatek\" value=\"%%10%%\" /> (dodatek pod cely formular)<br />
                  oznameni: <input type=\"checkbox\" name=\"oznameni\"%%11%% onclick=\"CheckOznameni(this.checked);\" /> (zapnout/vypnout potvrzeni o odeslani formulare, dojde na email ktery zada uzivatel, email vezme z elementu: zdrojovyemail)<br />
                  predmet oznameni: <input type=\"text\" name=\"predmetoznameni\" value=\"%%12%%\" id=\"id_predmetoznameni\" /> (predmet oznameni pro uzivatele)<br />
                  odesilatel uzivatel: <input type=\"text\" name=\"odesilateluzivatel\" value=\"%%13%%\" id=\"id_odesilateluzivatel\" /> * (email odesilate [from] pro uživatele)<br />
                  text email oznameni: <textarea  name=\"textemailoznameni\" id=\"id_textemailoznameni\">%%14%%</textarea> (uvodní text oznámení, formát: @@XX@@)<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit formular\" />
                </fieldset>
              </form>

              <script type=\"text/javascript\">
                function CheckOdeslatelSolid()
                {
                  document.getElementById('id_odesilateladmin').disabled = false;
                  document.getElementById('id_zdrojovyemail').disabled = true;
                }

                function CheckOdeslatelFlexible()
                {
                  document.getElementById('id_odesilateladmin').disabled = true;
                  document.getElementById('id_zdrojovyemail').disabled = false;
                }

                function CheckOznameni(stav)
                {
                  document.getElementById('id_predmetoznameni').disabled = !stav;
                  document.getElementById('id_odesilateluzivatel').disabled = !stav;
                  document.getElementById('id_textemailoznameni').disabled = !stav;
                }

                %%15%%
                %%16%%
              </script>
              ",

                  "admin_edit_form_hlaska" => "
                    upraven: %%1%%
                  ",

                  "admin_del_form_hlaska" => "
                  smazána adresa: %%1%% a jeho pod-elementy
                ",

                  "admin_addedit_elem_nazev" => "nazev: <input type=\"text\" name=\"nazev\" value=\"%%1%%\" /><br />",

                  "admin_addedit_elem_value" => "value: <input type=\"text\" name=\"value\" value=\"%%1%%\" /><br />",

                  "admin_addedit_elem_captcha" => "captcha ID: <input type=\"text\" name=\"value\" value=\"%%1%%\" /><br />",

                  "admin_addedit_elem_readonly" => "readonly: <input type=\"checkbox\" name=\"readonly\"%%1%% /><br />",

                  "admin_addedit_elem_disabled" => "disabled: <input type=\"checkbox\" name=\"disabled\"%%1%% /><br />",

                  "admin_addedit_elem_vstupni_typ" => "vstupni_typ: %%1%%<br />",

                  "admin_addedit_elem_reg_exp" => "reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" /><a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" target=\"_blank\">dokumentace</a><br />",

                  "admin_addedit_elem_minmax_val" => "min_val: <input type=\"text\" name=\"min_val\" value=\"%%1%%\" /> (u textu min počet, u čísla min hodnota)<br />
                                                      max_val: <input type=\"text\" name=\"max_val\" value=\"%%2%%\" /> (u textu max počet, u čísla max hodnota)<br />",

                  "admin_add_elem" => "
                <form method=\"post\">
                  <fieldset>
                    formulář: %%1%%<br />
                    %%2%%<br />
                    %%3%%
                    %%4%%
                    %%5%%
                    %%6%%
                    %%7%%
                    povinne: <input type=\"checkbox\" name=\"povinne\" /><br />
                    %%8%%
                    %%9%%
                    %%10%%
                    poradi: <input type=\"text\" name=\"poradi\" value=\"%%11%%\" />*>0<br />
                    <input type=\"submit\" name=\"tlacitko\" value=\"Přidat element\" />
                  </fieldset>
                </form>
                ",

                  "admin_add_elem_hlaska" => "
                      přidán element: %%1%%
                    ",

                  "admin_edit_elem" => "
              <form method=\"post\">
                <fieldset>
                  formulář: %%1%%<br />
                  %%2%%<br />
                  %%3%%
                  %%4%%
                  %%5%%
                  %%6%%
                  %%7%%
                  povinne: <input type=\"checkbox\" name=\"povinne\"%%8%% /><br />
                  %%9%%
                  %%10%%
                  %%11%%
                  poradi: <input type=\"text\" name=\"poradi\" value=\"%%12%%\" /> *>0<br />
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
                <p>nazev: %%1%%, name: elem_%%2%%, typ: %%3%%, value: %%4%%, pořadí: %%5%%</p>
                <br />
                <a href=\"%%6%%\" title=\"\">upravit prvek</a>
                <a href=\"%%7%%\" title=\"\" onclick=\"return confirm('Opravdu smazat prvek: \'%%1%%\' ?');\">smazat prvek</a><br />
                ",

                  "set_znakpovinne" => "\n          <span>*</span>",

                  "set_input" => array("text"     => "textové pole",  //Xx - nazev, value
                                      "checkbox" => "zaškrkávací políčko",  //Xx - nazev, checked
                                      "submit"   => "odesílací tlačítko - 1x", //1x - value
                                      "reset"    => "resetovací tlačítko - 1x",  //1x - value
                                      "captcha"  => "captcha kod - 1x",  //1x - ?
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

                  "ajax_dobre" => "dobre",

                  "ajax_spatne" => "špatne",

                  "ajax_set_get_id" => "id",

                  "ajax_set_get_sablona" => "sablona",

                  "ajax_set_get_text" => "text",

                  "ajax_kontrola_sql_dotaz" => "SELECT
                                                vstupni_typ, reg_exp, min_val, max_val
                                                FROM prvek
                                                WHERE id=%%2%%
                                                ORDER BY poradi ASC;",

                  "ajaxscript" => "
/**
 * Vytvoreni tridy ajaxu
 * @return objekt ajaxu
 */
function CreateXmlHttpObject()
{
  var xmlHttp = null;
  try
    {
      xmlHttp = new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
    }
      catch (e)
      {
        try
        {
          xmlHttp = new ActiveXObject(\"Msxml2.XMLHTTP\");  // Internet Explorer
        }
          catch (e)
          {
            xmlHttp = new ActiveXObject(\"Microsoft.XMLHTTP\");
          }
      }

  return xmlHttp;
}

/**
 * Vykonavaci fukce, posila instrukce na server
 * @param text vstupni text
 */
function KontrolaFormatu(text, sablona, id, vystupid)
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
    return;
  }

  var send = \"action=kontrola&text=\"+text+\"&sablona=\"+sablona+\"&id=\"+id+\"&kid=\"+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, vystupid);};  //po dokonceni se zavola

  xmlHttp.open(\"POST\", \"%%1%%%%2%%/ajax_form.php\", true);
  xmlHttp.setRequestHeader(\"Content-Type\", \"application/x-www-form-urlencoded\");
  xmlHttp.send(send);
}

/**
 * Samotna zmena stavu
 * @param xmlHttp vstupni objekt ajaxu
 * @param element ID vystupnho elementu
 */
function ZmenaStavu(xmlHttp, element)
{
  element1 = element+\"_fin\";

  if (document.getElementById(element) != null)
  {
    switch (xmlHttp.readyState) //osetreni navratovych kodu
    {
      case 4: //kompletni
        if (xmlHttp.status == 200)  //je-li vse ok
        {
          document.getElementById(element).innerHTML = xmlHttp.responseText;

          if (xmlHttp.responseText == \"dobre\")
          {
            document.getElementById(element1).style.color = \"green\";
          }
            else
          {
            document.getElementById(element1).style.color = \"red\";
          }
        }
      break;
    }
  }
}
                  ",

                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
