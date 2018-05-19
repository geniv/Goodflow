<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Návštěvní kniha (šablony)",
                                              "title" => "Návštěvní kniha (šablony)",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_tvar_menu_odkaz" => "%%1%%",

                  "admin_tvar_menu_title" => "%%1%%",

                  "normal_once_link_rss_1" => "<link type=\"application/rss+xml\" rel=\"alternate\" href=\"%%1%%\" title=\"Novinky\" />\n",

                  "normal_once_link_rss_web_1" => "<a href=\"%%1%%\">rss-ka</a>",

                  "normal_rss_header_1" => "<?xml version=\"1.0\" encoding=\"%%1%%\"?>
<rss version=\"0.92\">
  <channel>
    <title>%%2%%</title>
    <link>%%3%%</link>
    <category>%%4%%</category>
    <description>%%5%%</description>
    <language>%%6%%</language>
    <copyright>%%7%%</copyright>
    <managingEditor>%%8%%</managingEditor>
    <webMaster>%%9%%</webMaster>
    <ttl>%%10%%</ttl>
    <pubDate>%%11%%</pubDate>
    <lastBuildDate>%%11%%</lastBuildDate>

    <image>
    <title>%%2%%</title>
    <link>%%3%%</link>
    <url>%%12%%</url>
    </image>
",

                  "normal_rss_item_1" => "
    <item>
      <title>vol: ->%%4%%</title>
      <link>%%1%%</link>
      <description>
        %%4%% %%5%% %%7%% %%8%%
      </description>
      <pubDate>%%2%%</pubDate>
      <guid isPermaLink=\"false\">ID%%3%%</guid>
    </item>
    ",

                  "normal_rss_end_1" => "
  </channel>
</rss>",

                  //normalni vypis
                  "normal_vypis_1" => "          <ul%%3%%>
            <li class=\"prvni%%11%%\">
              %%7%% || %%10%%
            </li>
            <li>
              %%9%%
            </li>
          </ul>\n",

                  "normal_visible_email_1" => "<a href=\"mailto:%%1%%\" title=\"E-mail\">%%2%%</a>",

                  "normal_invsible_email_1" => "<strong>%%2%%</strong>",

                  "normal_num_jmeno_1" => 6,

                  "normal_vypis_null_1" => "zadaná adresa neexistuje",

                  "normal_vypis_prvni_1" => "prvni",

                  "normal_vypis_posledni_1" => " class=\"posledni\"",

                  "normal_vypis_ente_def_array_1" => array(1, 2, 5),

                  "normal_vypis_ente_def_1" => "aktivni",

                  "normal_vypis_ente_od_1" => 0,

                  "normal_vypis_ente_po_1" => 2,

                  "normal_vypis_ente_1" => "ente",

                  "normal_addobsah_form_1" => "          <script type=\"text/javascript\" src=\"%%1%%%%2%%/ajax.js\"></script>
          <form method=\"post\" action=\"\">
            <fieldset>
              <label id=\"ll_jmeno\">
                <strong>Jméno:</strong>
                <input type=\"text\"%%5%% value=\"%%6%%\" />
              </label>
              <p class=\"tooltip tooltip-left\">Zde zadej jméno nebo přezdívku.<br />(Povinná položka)</p>
              <label id=\"ll_email\">
                <strong>E-mail:</strong>
                <input type=\"text\"%%14%% value=\"%%15%%\" onkeyup=\"KontrolaFormatu(this.value, %%3%%, %%13%%, 'id_elem_%%3%%_%%13%%');\" id=\"id_elem_%%3%%_%%13%%_fin\" />
                <span id=\"id_elem_1_2\"></span>
              </label>
              <p class=\"tooltip tooltip-left\">Zde zadej korektně tvůj email ve tvaru [xxxxx@yyyyy.zz].<br />(Povinná položka)</p>
              <label id=\"ll_skryt_mail\">
                <input type=\"checkbox\"%%20%% />
                <strong>Skrýt e-mail</strong>
              </label>
              <p class=\"tooltip tooltip-left\">Jestliže zaškrtneš tuto položku, tak tvůj email nebude zobrazen.</p>
              <label id=\"ll_captcha\">
                %%25%%
                <span>=</span>
                <input type=\"text\"%%23%% maxlength=\"2\" />
              </label>
              <p class=\"tooltip tooltip-left\">Zde zadej výsledek z příkladu na obrázku. (Jen sčítání a odčítání, můžou vycházet i záporné hodnoty)</p>
              <label id=\"ll_text\">
                <strong>Text:</strong>
                <textarea%%32%% rows=\"10\" cols=\"50\">%%33%%</textarea>
              </label>
              <p class=\"tooltip tooltip-bottom\">Zde nám můžeš zanechat vzkaz.<br />(Povinná položka)</p>
              <input type=\"hidden\"%%40%% value=\"%%41%%\" />
              <label id=\"ll_odeslat%%48%%\">
                <input type=\"submit\"%%46%%%%47%% value=\"Odeslat\" />
              </label>
            </fieldset>
          </form>\n",

                  "normal_addobsah_form_hlaska_1" => "<div id=\"prispevek_odeslan\">
  <span id=\"info\"></span>
  <h3>Přidal jsi příspěvek</h3>
  <p>Tvé jméno: <em>%%3%%</em></p>
  <p>Tvůj e-mail: <em>%%4%%</em></p>
  <p>Příspěvek odeslán v: <em>%%7%%</em></p>
  <p>Text příspěvku: <em>%%6%%</em></p>
  <p id=\"pokracuj_odkaz\">Pokračuj kliknutím na <a href=\"%%2%%\" title=\"Návštěvní kniha\">tento odkaz</a>.</p>
</div>\n",

                  "normal_error_empty_1" => "    <p>Nevyplnil jsi: <em>%%1%%</em></p>\n",

                  "normal_error_min_max_1" => "nedodržení rozsahu v elementu: <strong>%%1%%</strong><br />",

                  "normal_error_min_1" => "nedodržení minima u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_max_1" => "překročení maxima u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_reg_exp_1" => "špatný tvar vstupu u elementu: <strong>%%1%%</strong><br />",

                  "normal_error_empty_captcha_1" => "    <p>Nevyplnil jsi: <em>Příklad</em></p>\n",

                  "normal_error_wrong_captcha_1" => "    <p>Špatně jsi vyplnil: <em>Příklad</em></p>\n",

                  "normal_checked_error_1" => "nezaškrkli jste potřebný element <strong>%%1%%</strong><br />",

                  "normal_error_unknown_1" => "blíže nespecifikovaná chyba v elementu: <strong>%%1%%</strong><br />",

                  "normal_error_hidden_1" => "<input type=\"hidden\" name=\"elem_%%1%%\" value=\"%%2%%\" />",

                  "normal_error_button_1" => "<p id=\"opakovat_pokus\"><input type=\"submit\" name=\"error_tlacitko\" value=\"Opakovat pokus\" /></p>",

                  "normal_error_end_1" => "<form method=\"post\" action=\"\" id=\"prispevek_neodeslan\">
  <fieldset>
    <span id=\"info\"></span>
    <h3>Vaše zpráva <strong>nebyla odeslána</strong> z těchto důvodů:</h3>
%%1%%    %%2%%
    %%3%%
  </fieldset>
</form>\n",

                  "set_autoklik_1" => false,

                  "set_time_autoklik_1" => 10,

                  "set_show_form_1" => false,  //true/false - prida/nahradi

                  "admin_error_empty" => "
      <label class=\"nadpis_sekce_kniha_info\">
        <span>Nebyla vyplněna položka: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_min_max" => "
      <label class=\"nadpis_sekce_kniha_info\">
        <span>Nebyl dodržen rozsah položky: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_min" => "
      <label class=\"nadpis_sekce_kniha_info\">
        <span>Nebyl dodržen minimální rozsah položky: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_max" => "
      <label class=\"nadpis_sekce_kniha_info\">
        <span>Bylo překročeno maximum rozsahu položky: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_reg_exp" => "
      <label class=\"nadpis_sekce_kniha_info\">
        <span>Byl vyplněn špatný tvar vstupu položky: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_unknown" => "
      <label class=\"nadpis_sekce_kniha_info\">
        <span>Vyskytla se chyba v položce: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_empty_captcha" => "
      <label class=\"nadpis_sekce_kniha_info\">
        <span>Nebyl vyplněn <strong>captcha</strong> obrázek</span>
      </label>\n",

                  "admin_error_wrong_captcha" => "
      <label class=\"nadpis_sekce_kniha_info\">
        <span>Byl špatně vyplněn <strong>captcha</strong> obrázek</span>
      </label>\n",

                  "admin_error_hidden" => "<input type=\"hidden\" name=\"%%1%%\" value=\"%%2%%\" />\n",

                  "admin_error_button" => "
      <label class=\"submit\">
        <input type=\"submit\" name=\"error_tlacitko\" value=\"Opakovat pokus\" />
      </label>\n",

                  "admin_error_end" => "
<div class=\"pridat_upravit_obsah_navstevni_kniha\">
  <form method=\"post\" action=\"\">
    <fieldset>
%%1%%
%%2%%
%%3%%
    </fieldset>
  </form>
</div>\n", // %%4%% - backlink

                  "admin_addeditobsah_nadpis" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%5%%%%6%%%%7%% />
        <span class=\"kniha_dodatek\">%%8%%</span>
      </label>\n", // %%9%% - poradi

                  "admin_addeditobsah_skryt_obsah" => "
      <label class=\"input_checkbox\">
        <span>Skrýt e-mail:</span>
        <input type=\"checkbox\" name=\"skryt_elem_%%1%%\"%%2%% />
        <span class=\"kniha_dodatek\">Jestliže zaškrtneš tuto položku, tak tvůj email nebude zobrazen.</span>
      </label>\n",

                  "admin_addeditobsah_popisek" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%5%%%%6%%%%7%% />
        <span class=\"kniha_dodatek\">%%8%%</span>
      </label>\n%%10%%\n", // %%9%% - poradi

                  "admin_addeditobsah_text" => "
      <label class=\"input_textarea\">
        <span>%%1%%:</span>
        <textarea name=\"elem_%%2%%\"%%5%%%%6%%%%7%% rows=\"30\" cols=\"80\">%%3%%</textarea>
        <span class=\"kniha_dodatek\">%%8%%</span>
      </label>\n", // %%9%% - poradi

                  "admin_addeditobsah_captcha" => "
      <label class=\"input_text\">
        <span>%%1%%</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%4%%\"%%6%%%%7%%%%8%% />
        <span class=\"kniha_dodatek\">%%9%%</span>
        <span class=\"kniha_dodatek\">%%5%%</span>
      </label>\n", // %%10%% - poradi

                  "admin_addeditobsah_datum" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />
        <span class=\"kniha_dodatek\">%%7%% Formát je %%8%%. Datum zapiš v tomto tvaru: %%9%%</span>
      </label>\n", // %%10%% - poradi

                  "admin_addeditobsah_cas" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />
        <span class=\"kniha_dodatek\">%%7%% Formát je %%8%%. Čas zapiš v tomto tvaru: %%9%%</span>
      </label>\n", // %%10%% - poradi

                  "admin_addeditobsah_datumcas" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />
        <span class=\"kniha_dodatek\">%%7%% Formát je %%8%%. Datum a čas zapiš v tomto tvaru: %%9%%</span>
      </label>\n", // %%10%% - poradi

                  "admin_addeditobsah_checkbox" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
        <input type=\"checkbox\" name=\"elem_%%2%%\"%%3%%%%8%%%%4%%%%5%%%%6%% />
        <span class=\"kniha_dodatek\">%%7%%</span>
      </label>\n", // %%9%% - poradi

                  "admin_addobsah_form" => "
<div class=\"pridat_upravit_obsah_navstevni_kniha\">
  <h3>Přidat příspěvek</h3>
  <p class=\"backlink_kniha\"><a href=\"%%3%%\" title=\"Zpět na výpis příspěvků\">Zpět na výpis příspěvků</a></p>
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\">
    <fieldset>
%%1%%

<script type=\"text/javascript\">
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

    xmlHttp.open(\"POST\", \"%%2%%/ajax_form.php\", true);
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
    if (document.getElementById(element) != null)
    {
      switch (xmlHttp.readyState) //osetreni navratovych kodu
      {
        case 4: //kompletni
          if (xmlHttp.status == 200)  //je-li vse ok
          {
            document.getElementById(element).innerHTML = xmlHttp.responseText;
          }
        break;
      }
    }
  }
</script>

      <label class=\"input_checkbox\">
        <span>Viditelný příspěvek:</span>
        <input type=\"checkbox\" name=\"zobrazit\" checked=\"checked\" />
      </label>
      <label class=\"submit%%6%%\">
        <input type=\"submit\"%%4%%%%5%% value=\"Přidat příspěvek\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán příspěvek od: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editobsah_form" => "
<div class=\"pridat_upravit_obsah_navstevni_kniha\">
  <h3>Upravit příspěvek</h3>
  <p class=\"backlink_kniha\"><a href=\"%%4%%\" title=\"Zpět na výpis příspěvků\">Zpět na výpis příspěvků</a></p>
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\">
    <fieldset>
%%1%%

<script type=\"text/javascript\">
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

    xmlHttp.open(\"POST\", \"%%3%%/ajax_form.php\", true);
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
    if (document.getElementById(element) != null)
    {
      switch (xmlHttp.readyState) //osetreni navratovych kodu
      {
        case 4: //kompletni
          if (xmlHttp.status == 200)  //je-li vse ok
          {
            document.getElementById(element).innerHTML = xmlHttp.responseText;
          }
        break;
      }
    }
  }
</script>

      <label class=\"input_checkbox\">
        <span>Viditelný příspěvek:</span>
        <input type=\"checkbox\" name=\"zobrazit\"%%2%% />
      </label>
      <label class=\"submit%%7%%\">
        <input type=\"submit\"%%5%%%%6%% value=\"Upravit příspěvek\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven příspěvek od: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazána příspěvek od: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_obsah_sablony" => "
<div class=\"vypis_sekce_navstevni_kniha_uzivatelske_rozhrani\">
  <h3>Výpis sekce <strong>%%4%%</strong></h3>
  <p class=\"odkaz_pridat_polozku_sekce\">
    <a href=\"%%1%%\" title=\"Přidat administrátorský příspěvek\">Přidat administrátorský příspěvek</a>
    <span>%%2%%<!-- --></span>
  </p>
%%3%%
</div>\n",

                  "admin_sablona_vypis_element" => "%%1%%",

                  "admin_vyber_sablony_begin" => "        <select name=\"sablona\">\n",

                  "admin_vyber_sablony" => "          <option value=\"%%1%%\"%%2%%>%%3%% [%%4%%]</option>\n",

                  "admin_vyber_sablony_end" => "        </select>",

                  "admin_vyber_sablony_null" => "zadaná šablona neexistuje",

                  "admin_vstupni_typ_select_begin" => "        <select name=\"vstupni_typ\" onchange=\"document.location.href='%%1%%&amp;vstup='+this.value\">\n",

                  "admin_vstupni_typ_select" => "          <option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vstupni_typ_select_end" => "        </select>",

                  "admin_typ_select_begin" => "        <select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+this.value\">\n",

                  "admin_typ_select" => "          <option value=\"%%1%%\"%%2%%>%%4%%</option>\n",

                  "admin_typ_select_end" => "        </select>",

                  "admin_obsah_add_link" => "<a href=\"%%1%%\" title=\"Přidat šablonu návštěvní knihy\">Přidat šablonu</a>",

                  "admin_obsah" => "
<div class=\"dynamicka_navstevni_kniha_hlavni_vypis\">
  <h3>Výpis šablon s elementy</h3>
  <p class=\"odkazy_pridat_nastavit\">
    %%2%%
    <span>
      <a href=\"%%1%%\" title=\"Test regulárních výrazů\">Test regulárních výrazů</a>
    </span>
  </p>
%%3%%
</div>\n",

                  "admin_test_rv" => "
<div class=\"test_regularnich_vyrazu_kniha\">
  <h3>Test regulárních výrazů</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%4%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"nadpis_sekce_kniha\">
        <span>Příklady:</span>
      </label>
      <label class=\"nadpis_sekce_kniha\">
        <span>/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/</span>
      </label>
      <label class=\"nadpis_sekce_kniha\">
        <span>/^(\+420)?[0-9]{9}$/</span>
      </label>
      <label class=\"nadpis_sekce_kniha\">
        <span><a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" title=\"Dokumentace\">Dokumentace</a></span>
      </label>
      <label class=\"nadpis_sekce_kniha\">
        <span><!-- --></span>
      </label>
      <label class=\"input_text\">
        <span>Vstupní text:</span>
        <input type=\"text\" name=\"vstup\" value=\"%%1%%\" />
      </label>
      <label class=\"input_text\">
        <span>Regulární výraz:</span>
        <input type=\"text\" name=\"reg_exp\" value=\"%%2%%\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Otestovat\" />
      </label>
      <label class=\"nadpis_sekce_kniha\">
        <span>%%3%%<!-- --></span>
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addsab" => "
<div class=\"navstevni_kniha_addedit_sablony\">
  <h3>Přidat šablonu</h3>
  <p class=\"backlink_kniha\">
    <a href=\"%%2%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Adresa šablony:</span>
        <input type=\"text\" name=\"adresa\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle data [A -> Z, 0 -> 9]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"ASC\" />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle data [Z -> A, 9 -> 0]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"DESC\" checked=\"checked\" />
      </label>
      <label class=\"input_text\">
        <span>Položek na stručném výpisu:</span>
        <input type=\"text\" name=\"nove\" value=\"1\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Položek na RSS odběru:</span>
        <input type=\"text\" name=\"nove_rss\" value=\"10\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Popis šablony:</span>
        <textarea name=\"popisek\" rows=\"30\" cols=\"80\"></textarea>
      </label>
      <label class=\"input_text\">
        <span>id:</span>
        <input type=\"text\" name=\"href_id\" />
      </label>
      <label class=\"input_text\">
        <span>class:</span>
        <input type=\"text\" name=\"href_class\" />
      </label>
      <label class=\"input_text\">
        <span>akce:</span>
        <input type=\"text\" name=\"href_akce\" />
      </label>
      <label class=\"input_text\">
        <span>Název v menu:</span>
        <input type=\"text\" name=\"nazev\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Zobrazit v menu:</span>
        <input type=\"checkbox\" name=\"zobrazit\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat šablonu\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addsab_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přidána šablona: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editsab" => "
<div class=\"navstevni_kniha_addedit_sablony\">
  <h3>Upravit šablonu</h3>
  <p class=\"backlink_kniha\">
    <a href=\"%%11%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Adresa šablony:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle data [A -> Z, 0 -> 9]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"ASC\"%%2%% />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle data [Z -> A, 9 -> 0]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"DESC\"%%3%% />
      </label>
      <label class=\"input_text\">
        <span>Položek na stručném výpisu:</span>
        <input type=\"text\" name=\"nove\" value=\"1\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Položek na RSS odběru:</span>
        <input type=\"text\" name=\"nove_rss\" value=\"%%4%%\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Popis šablony:</span>
        <textarea name=\"popisek\" rows=\"30\" cols=\"80\">%%6%%</textarea>
      </label>
      <label class=\"input_text\">
        <span>id:</span>
        <input type=\"text\" name=\"href_id\" value=\"%%7%%\" />
      </label>
      <label class=\"input_text\">
        <span>class:</span>
        <input type=\"text\" name=\"href_class\" value=\"%%8%%\" />
      </label>
      <label class=\"input_text\">
        <span>akce:</span>
        <input type=\"text\" name=\"href_akce\" value=\"%%9%%\" />
      </label>
      <label class=\"input_text\">
        <span>Název v menu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%5%%\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Zobrazit v menu:</span>
        <input type=\"checkbox\" name=\"zobrazit\"%%10%% />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit šablonu\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editsab_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena šablona: \"<strong>%%1%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delsab_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána šablona: \"<strong>%%1%%</strong>\" včetně jejích elementů
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_addeditelem_value" => "
      <label class=\"input_text\">
        <span>Value hodnota:</span>
        <input type=\"text\" name=\"value\" value=\"%%1%%\" />
      </label>\n",

                  "admin_addeditelem_captcha" => "
      <label class=\"input_text\">
        <span>ID captcha obrázku:</span>
        <input type=\"text\" name=\"value\" value=\"%%1%%\" />
      </label>\n",

                  "admin_addeditelem_skryt_obsah" => "
      <label class=\"input_checkbox\">
        <span>Skrývání elementu:</span>
        <input type=\"checkbox\" name=\"skryt_obsah\"%%1%% />
      </label>\n",

                  "admin_addeditelem_vstupni_typ" => "
      <label class=\"input_select\">
        <span>Typ vstupu:</span>
%%1%%
      </label>\n",

                  "admin_addeditelem_reg_exp" => "
      <label class=\"input_text\">
        <span>Regulární výraz:</span>
        <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" />
        <span class=\"kniha_dodatek\"><a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" title=\"Dokumentace\">Dokumentace</a></span>
      </label>\n",

                  "admin_addeditelem_vystupni_format" => "
      <label class=\"input_text\">
        <span>Výstupní formát data / času:</span>
        <input type=\"text\" name=\"vystupni_format\" value=\"%%1%%\" />
        <span class=\"kniha_dodatek\"><a href=\"http://php.net/manual/en/function.date.php\" title=\"Dokumentace\">Dokumentace</a></span>
      </label>\n",

                  "admin_addeditelem_min_max_poc" => "
      <label class=\"input_text\">
        <span>Minimální hodnota:</span>
        <input type=\"text\" name=\"min_val\" value=\"%%1%%\" />
        <span class=\"kniha_dodatek\">Nepovinná položka. Při vybraném textovém vstupu nastavuje minimální délku, u čísla minimální hodnotu. 0 = Neaktivní.</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální hodnota:</span>
        <input type=\"text\" name=\"max_val\" value=\"%%2%%\" />
        <span class=\"kniha_dodatek\">Nepovinná položka. Při vybraném textovém vstupu nastavuje maximální délku, u čísla maximální hodnotu. 0 = Neaktivní.</span>
      </label>\n",

                  "admin_addelem" => "
<div class=\"pridat_upravit_element_navstevni_kniha\">
  <h3>Přidat element do šablony</h3>
  <p class=\"backlink_kniha\"><a href=\"%%10%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_select\">
        <span>Šablona:</span>
%%1%%
      </label>
      <label class=\"input_select\">
        <span>Typ elementu:</span>
%%2%%
      </label>
      <label class=\"input_text\">
        <span>Popis elementu:</span>
        <input type=\"text\" name=\"nazev\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
%%3%%
      <label class=\"input_text\">
        <span>id:</span>
        <input type=\"text\" name=\"input_id\" />
      </label>
      <label class=\"input_text\">
        <span>class:</span>
        <input type=\"text\" name=\"input_class\" />
      </label>
      <label class=\"input_text\">
        <span>akce:</span>
        <input type=\"text\" name=\"input_akce\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Povinná položka:</span>
        <input type=\"checkbox\" name=\"povinne\" />
      </label>
%%4%%
%%5%%
%%6%%
%%7%%
%%8%%
      <label class=\"input_text\">
        <span>Pořadí elementu:</span>
        <input type=\"text\" name=\"poradi\" value=\"%%9%%\" />
        <span class=\"kniha_dodatek\">Zapsaná hodnota musí být větší než nula.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat element\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editelem" => "
<div class=\"pridat_upravit_element_navstevni_kniha\">
  <h3>Upravit element v šabloně</h3>
  <p class=\"backlink_kniha\"><a href=\"%%15%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_select\">
        <span>Šablona:</span>
%%1%%
      </label>
      <label class=\"input_select\">
        <span>Typ elementu:</span>
%%2%%
      </label>
      <label class=\"input_text\">
        <span>Popis elementu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />
        <span class=\"kniha_dodatek\">Povinná položka.</span>
      </label>
%%4%%
      <label class=\"input_text\">
        <span>id:</span>
        <input type=\"text\" name=\"input_id\" value=\"%%5%%\" />
      </label>
      <label class=\"input_text\">
        <span>class:</span>
        <input type=\"text\" name=\"input_class\" value=\"%%6%%\" />
      </label>
      <label class=\"input_text\">
        <span>akce:</span>
        <input type=\"text\" name=\"input_akce\" value=\"%%7%%\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Povinná položka:</span>
        <input type=\"checkbox\" name=\"povinne\"%%8%% />
      </label>
%%9%%
%%10%%
%%11%%
%%12%%
%%13%%
      <label class=\"input_text\">
        <span>Pořadí elementu:</span>
        <input type=\"text\" name=\"poradi\" value=\"%%14%%\" />
        <span class=\"kniha_dodatek\">Zapsaná hodnota musí být větší než nula.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit element\" />
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

                  "admin_vypis_sablona_adddel_link" => "<em><a href=\"%%2%%\" title=\"Přidat element\">Přidat element</a>&nbsp;-&nbsp;</em><span>&nbsp;-&nbsp;<a href=\"%%1%%\" title=\"Smazat šablonu\" onclick=\"return confirm('Opravdu chceš smazat šablonu: &quot;%%3%%&quot; ?');\">Smazat šablonu</a></span>",

                  "admin_vypis_del_link" => " - <a href=\"%%1%%\" title=\"Smazat element\" onclick=\"return confirm('Opravdu chceš smazat element: &quot;%%2%%&quot; ?');\">Smazat element</a>",

                  "admin_vypis_sablona" => "
<ul class=\"vypis_sablon_zahlavi\">
  <li>[%%1%%] - %%3%%</li>
  <li class=\"adresa_sablony\">%%2%%</li>
  <li class=\"odkazy_pridat_upravit\"><p>%%6%%<a href=\"%%5%%\" title=\"Upravit šablonu\">Upravit šablonu</a></p></li>
</ul>
<div class=\"obal_vypis_sablon_obsah\">\n",

                  "admin_vypis_skupina_end" => "\n</div>\n",

                  "admin_vypis_element" => "
<ul class=\"vypis_sablon_polozka\">
  <li>Typ elementu: <strong>%%3%%</strong></li>
  <li>Popis elementu: <strong>%%1%%</strong></li>
  <li>Value hodnota: <strong>%%2%%</strong></li>
  <li class=\"povinna_polozka_checkbox\"><em>Povinná položka:</em><input type=\"checkbox\"%%4%% disabled=\"disabled\" /></li>
  <li class=\"povinna_polozka_checkbox\"><em>Skrývání elementu:</em><input type=\"checkbox\"%%5%% disabled=\"disabled\" /></li>
  <li>Pořadí elementu: <strong>%%8%%</strong></li>
  <li class=\"odkazy_pridat_upravit\"><a href=\"%%9%%\" title=\"Upravit element\">Upravit element</a>%%10%%</li>
</ul>\n",

                  "admin_vypis_obsah" => "
<div class=\"vypis_polozky_uzivatelske_rozhrani\">
  <ul class=\"staticke_info_uzivatelske_rozhrani%%6%%\">
    <li>Příspěvek od: <strong>%%2%%</strong></li>
    <li class=\"datum_polozky\">Příspěvek vytvořen: <strong>%%3%%</strong></li>
    <li class=\"odkazy_upravit_smazat\"><a href=\"%%7%%\" title=\"Upravit příspěvek\">Upravit příspěvek</a> - <a href=\"%%8%%\" title=\"Smazat příspěvek\" onclick=\"return confirm('Opravdu chceš smazat příspěvek: &quot;%%2%%&quot; ?');\">Smazat příspěvek</a></li>
  </ul>
  <div class=\"povinna_polozka_checkbox\">
    <em>Skrývání emailu:</em><input type=\"checkbox\"%%11%% disabled=\"disabled\" />
  </div>
  <div class=\"povinna_polozka_checkbox\">
    <em>Viditelný příspěvek:</em><input type=\"checkbox\"%%4%% disabled=\"disabled\" />
  </div>
  <div class=\"povinna_polozka_checkbox\">
    <em>Administrátorský příspěvek:</em><input type=\"checkbox\"%%5%% disabled=\"disabled\" />
  </div>
  <div class=\"email_prispevku\">
    E-mail: <strong><a href=\"mailto:%%12%%\" title=\"%%12%%\">%%12%%</a></strong>
  </div>
  <div class=\"text_prispevku%%6%%\">
    Text příspěvku: <strong>%%14%%</strong>
  </div>
  <div>
    Upravitelný čas a datum příspěvku: <strong>%%15%%</strong>
  </div>
</div>\n", // %%4%% nazev, %%5%% rewrite, %%1%% nazev sekce

                  "set_admin_datum" => "H:i:s / d.m.Y",

                  "set_element" => array ("nadpis" =>  "Nadpis",
                                          "popisek" => "Krátký text",
                                          "text" =>    "Dlouhý text",
                                          "captcha" => "Captcha obrázek",
                                          "datum" =>   "Datum",
                                          "cas" =>     "Čas",
                                          "datumcas" =>"Datum a čas",
                                          "checkbox" => "Checkbox"
                                          ),

                  "set_povolit_pridani" => true,

                  "set_vypis_chybu" => false,

                  "set_znacka_povinne" => "Povinná položka.",

                  "set_rsslink" => "rss",


                  "set_rss_kodovani_1" => "UTF-8",

                  "set_rss_title_1" => "title rss",

                  "set_rss_category_1" => "kategorie",

                  "set_rss_description_1" => "poznamka",

                  "set_rss_language_1" => "cs",

                  "set_rss_copyright_1" => "(c) vytvoren (c)",

                  "set_rss_managingEditor_1" => "rizeni@email.cz (rizeni)",

                  "set_rss_webMaster_1" => "webmaster@email.cz (webmaster)",

                  "set_rss_ttl_1" => 120,

                  "set_rss_image_title_1" => "nadpis obrazku",

                  "set_rss_image_link_1" => "%%1%%",

                  "set_rss_image_url_1" => "%%1%%obr.png",

                  "ajaxscript" => "/**
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

          if (xmlHttp.responseText == \"<span id=\\\"mail_true\\\"></span>\")
          {
            document.getElementById(element1).style.color = \"#2e241b\";
          }
            else
          {
            document.getElementById(element1).style.color = \"#d2342f\";
          }
        }
      break;
    }
  }
}",

                  "normal_report_email_enabled_1" => false,

                  "normal_report_email_emaily_1" => array ("email1@email.cz",
                                                    "email2@email.cz",
                                                    ),

                  "normal_report_email_subject_1" => "dosel ti email od tud... %%1%%",

                  "normal_report_email_message_1" => "
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

                  "normal_report_email_header_1" => "%%1%%\nFrom: email@email.cz",

                  "normal_report_email_send_error_1" => "nepodařilo se odeslat email na zrušení...",

                  "ajax_dobre" => "<span id=\"mail_true\"></span>",

                  "ajax_spatne" => "<span id=\"mail_false\"></span>",

                  "set_admin_prepnani_unikatnich" => false, //true - promenne/false - jednotne

                  "set_prevod" => array("@" => "%40",
                                        "\n" => "<br />",
                                        "=)" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-37-47.gif\" alt=\"=)\" title=\"=)\" /> ",
                                        ":)" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-37-47.gif\" alt=\":)\" title=\":)\" /> ",
                                        ":-)" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-37-47.gif\" alt=\":-)\" title=\":-)\" /> ",
                                        ":-))" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-37-47.gif\" alt=\":-))\" title=\":-))\" /> ",
                                        ":-)))" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-37-47.gif\" alt=\":-)))\" title=\":-)))\" /> ",
                                        ":-))))" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-37-47.gif\" alt=\":-))))\" title=\":-))))\" /> ",
                                        ":-)))))" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-37-47.gif\" alt=\":-)))))\" title=\":-)))))\" /> ",
                                        ":-))))))" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-37-47.gif\" alt=\":-))))))\" title=\":-))))))\" /> ",
                                        ":-(" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/17-07-2009-21-53-26.gif\" alt=\":-(\" title=\":-(\" /> ",
                                        ":D" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-41-16.gif\" alt=\":D\" title=\":D\" /> ",
                                        ":-D" => " <img src=\"%%1%%modules/datovy_sklad/soubory/smajly/29-07-2009-23-41-16.gif\" alt=\":D\" title=\":D\" /> "),

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
