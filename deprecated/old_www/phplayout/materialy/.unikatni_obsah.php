<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Generovaný obsah (šablony)",
                                              "title" => "Generovaný obsah (šablony)",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "admin_tvar_menu_odkaz" => "%%1%%",

                  "admin_tvar_menu_title" => "%%1%%",

                  "normal_link_rss_1" => "<link type=\"application/rss+xml\" rel=\"alternate\" href=\"%%1%%\" title=\"Novinky %%2%%\" />\n",

                  "normal_once_link_rss_1" => "<link type=\"application/rss+xml\" rel=\"alternate\" href=\"%%1%%\" title=\"Novinky\" />\n",

                  "normal_link_rss_web_1" => "


<a href=\"%%1%%\">%%2%%</a>, 


",

                  "normal_once_link_rss_web_1" => "


<a href=\"%%1%%\">rss-ka</a>, 


",

                  "normal_rss_header_1" => "


<?xml version=\"1.0\" encoding=\"%%1%%\"?>
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
<title>vol: ->%%6%%</title>
<link>%%1%%%%2%%</link>
<description>
(%%3%%), %%7%% %%8%% %%9%% %%10%%
</description>
<pubDate>%%4%%</pubDate>
<guid isPermaLink=\"false\">ID%%5%%</guid>
</item>



",

                  "normal_rss_end_1" => "



</channel>
</rss>


",

                  //rychlo vypis
                  "normal_rychlo_vypis_1" => "
strucny vypis:
%%1%% - (1)<br />
%%2%% - (2)<br />
%%3%% - (3)<br />
%%4%% - (4)<br />
%%5%% - (5)<br />
%%6%% - (6)<br />
%%7%% - (7)<br />
%%8%% - (8)<br />
%%9%% - (9)<br />
%%10%% - (10)<br />
%%11%% - (11)<br />
%%12%% - (12)<br />
",

                  "normal_rychlo_vypis_oznaceni_1" => "super označení",

                  "normal_rychlo_vypis_null_1" => "žádná položka",

                  "normal_rychlo_vypis_prvni_1" => "prvni",

                  "normal_rychlo_vypis_posledni_1" => "posledni",

                  "normal_rychlo_vypis_ente_def_array_1" => array(1, 2, 5),

                  "normal_rychlo_vypis_ente_def_1" => "aktivni",

                  "normal_rychlo_vypis_ente_od_1" => 0,

                  "normal_rychlo_vypis_ente_po_1" => 2,

                  "normal_rychlo_vypis_ente_1" => "ente",


                  "normal_vypis_title" => " - %%1%%",

                  //normalni vypis
                  "normal_vypis_1" => "\n    <p class=\"nazev_polozky\">%%8%%</p>
    <p class=\"cena_polozky\">%%9%%</p>
    <p class=\"popis_polozky\">%%10%%</p>\n  ",

                  "normal_vypis_null_1" => "zadaná adresa neexistuje",

                  "normal_vypis_prvni_1" => "prvni",

                  "normal_vypis_posledni_1" => "posledni",

                  "normal_vypis_ente_def_array_1" => array(1, 2, 5),

                  "normal_vypis_ente_def_1" => "aktivni",

                  "normal_vypis_ente_od_1" => 0,

                  "normal_vypis_ente_po_1" => 2,

                  "normal_vypis_ente_1" => "ente",


                  "normal_vypis_full_1" => "




full vypis:<br />
%%1%% %%2%%<br />
%%3%% %%4%%<br />
%%5%% %%6%%<br />
%%7%% %%8%%<br />
%%9%% %%10%%<br />
%%11%% %%12%%<br /><br />




",

                  "normal_vypis_full_error_1" => "bohužel adresa je duplkatní a proto nelze přesně zaměřit", // zprava pro vyvojare

                  "admin_error_empty" => "
      <label class=\"nadpis_sekce_zobrazovani_info\">
        <span>Nebyla vyplněna položka: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_min_max" => "
      <label class=\"nadpis_sekce_zobrazovani_info\">
        <span>Nebyl dodržen rozsah položky: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_min" => "
      <label class=\"nadpis_sekce_zobrazovani_info\">
        <span>Nebyl dodržen minimální rozsah položky: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_max" => "
      <label class=\"nadpis_sekce_zobrazovani_info\">
        <span>Bylo překročeno maximum rozsahu položky: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_reg_exp" => "
      <label class=\"nadpis_sekce_zobrazovani_info\">
        <span>Byl vyplněn špatný tvar vstupu položky: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_checkbox" => "
      <label class=\"nadpis_sekce_zobrazovani_info\">
        <span>K uložení je nutné označit položku: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_unknown" => "
      <label class=\"nadpis_sekce_zobrazovani_info\">
        <span>Vyskytla se chyba v položce: <strong>%%1%%</strong></span>
      </label>\n",

                  "admin_error_hidden" => "<input type=\"hidden\" name=\"%%1%%\" value=\"%%2%%\" />\n",

                  "admin_error_button" => "
      <label class=\"submit\">
        <input type=\"submit\" name=\"error_tlacitko\" value=\"Opakovat pokus\" />
      </label>\n",

                  "admin_error_end" => "
<div class=\"pridat_upravit_obsah_dynamicke_zobrazeni\">
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
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />
        <span class=\"zobrazovani_dodatek\">%%7%%</span>
      </label>\n", // %%8%% - poradi

                  "admin_addeditobsah_popisek" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />
        <span class=\"zobrazovani_dodatek\">%%7%%</span>
      </label>\n", // %%8%% - poradi

                  "admin_addeditobsah_text" => "
      <label class=\"input_textarea\">
        <span>%%1%%:</span>
        <textarea name=\"elem_%%2%%\"%%4%%%%5%%%%6%% rows=\"30\" cols=\"80\">%%3%%</textarea>
        <span class=\"zobrazovani_dodatek\">%%7%%</span>
      </label>\n", // %%8%% - poradi

                  "admin_addeditobsah_obrazek" => "
      <label class=\"input_file\">
        <span>%%1%%:</span>
        <input type=\"file\" name=\"elem_obr[%%2%%]\"%%3%%%%4%%%%5%% />
        <span class=\"zobrazovani_dodatek\">%%6%% Nastavení pro obrázek v plném rozlišení je uvedeno níže.</span>
      </label>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>Nastavení miniatury</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%11%% name=\"mini%%2%%\" onclick=\"mini_1%%2%%();\" />
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%12%% name=\"mini%%2%%\" onclick=\"mini_2%%2%%();\" />
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%13%% name=\"mini%%2%%\" onclick=\"mini_3%%2%%();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka miniatury [width]:</span>
        <input type=\"text\" name=\"w_mini[%%2%%]\" id=\"mini_p1%%2%%\" value=\"%%7%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška miniatury [height]:</span>
        <input type=\"text\" name=\"h_mini[%%2%%]\" id=\"mini_p2%%2%%\" value=\"%%8%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Vlastní miniatura:</span>
        <input type=\"radio\"%%14%% name=\"mini%%2%%\" onclick=\"mini_4%%2%%();\" />
      </label>
      <label class=\"input_file\">
        <span>Obrázek miniatury:</span>
        <input type=\"file\" name=\"nahled_obr[%%2%%]\" id=\"mini_p3%%2%%\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka jen pokud je nastavena vlastní miniatura.</span>
      </label>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>Nastavení plného náhledu</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%15%% name=\"full%%2%%\" onclick=\"full_1%%2%%();\" />
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%16%% name=\"full%%2%%\" onclick=\"full_2%%2%%();\" />
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%17%% name=\"full%%2%%\" onclick=\"full_3%%2%%();\" />
      </label>
      <label class=\"input_radio\">
        <span>Originální velikost:</span>
        <input type=\"radio\"%%18%% name=\"full%%2%%\" onclick=\"full_4%%2%%();\" />
        <span class=\"zobrazovani_dodatek\">Ponechá velikost obrázku zjištěnou při nahrávání.</span>
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"w_full[%%2%%]\" id=\"full_p1%%2%%\" value=\"%%9%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"h_full[%%2%%]\" id=\"full_p2%%2%%\" value=\"%%10%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>

<script type=\"text/javascript\">
  //document.getElementById('mini_p1%%2%%').disabled = true;
  //document.getElementById('mini_p2%%2%%').disabled = true;
  //document.getElementById('full_p1%%2%%').disabled = true;
  //document.getElementById('full_p2%%2%%').disabled = true;

  function mini_1%%2%%()
  {
    document.getElementById('mini_p1%%2%%').disabled = false;
    document.getElementById('mini_p2%%2%%').disabled = true;
    document.getElementById('mini_p3%%2%%').disabled = true;
  }

  function mini_2%%2%%()
  {
    document.getElementById('mini_p1%%2%%').disabled = true;
    document.getElementById('mini_p2%%2%%').disabled = false;
    document.getElementById('mini_p3%%2%%').disabled = true;
  }

  function mini_3%%2%%()
  {
    document.getElementById('mini_p1%%2%%').disabled = false;
    document.getElementById('mini_p2%%2%%').disabled = false;
    document.getElementById('mini_p3%%2%%').disabled = true;
  }

  function mini_4%%2%%()
  {
    document.getElementById('mini_p1%%2%%').disabled = true;
    document.getElementById('mini_p2%%2%%').disabled = true;
    document.getElementById('mini_p3%%2%%').disabled = false;
  }

  function full_1%%2%%()
  {
    document.getElementById('full_p1%%2%%').disabled = false;
    document.getElementById('full_p2%%2%%').disabled = true;
  }

  function full_2%%2%%()
  {
    document.getElementById('full_p1%%2%%').disabled = true;
    document.getElementById('full_p2%%2%%').disabled = false;
  }

  function full_3%%2%%()
  {
    document.getElementById('full_p1%%2%%').disabled = false;
    document.getElementById('full_p2%%2%%').disabled = false;
  }

  function full_4%%2%%()
  {
    document.getElementById('full_p1%%2%%').disabled = true;
    document.getElementById('full_p2%%2%%').disabled = true;
  }

  %%19%%
  %%20%%
</script>\n", // %%23%% - poradi

                  "admin_addeditobsah_datum" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />
        <span class=\"zobrazovani_dodatek\">%%7%% Formát je %%8%%. Datum zapiš v tomto tvaru: %%9%%</span>
      </label>\n", // %%10%% - poradi

                  "admin_addeditobsah_cas" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />
        <span class=\"zobrazovani_dodatek\">%%7%% Formát je %%8%%. Čas zapiš v tomto tvaru: %%9%%</span>
      </label>\n", // %%10%% - poradi

                  "admin_addeditobsah_datumcas" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />
        <span class=\"zobrazovani_dodatek\">%%7%% Formát je %%8%%. Datum a čas zapiš v tomto tvaru: %%9%%</span>
      </label>\n", // %%10%% - poradi

                  "admin_addeditobsah_checkbox" => "
      <label class=\"input_checkbox\">
        <span>%%1%%:</span>
        <input type=\"checkbox\" name=\"elem_%%2%%\"%%3%%%%8%%%%4%%%%5%%%%6%% />
        <span class=\"zobrazovani_dodatek\">%%7%%</span>
      </label>\n", // %%9%% - poradi

                  "admin_addeditobsah_autodel" => "
      <label class=\"input_text\">
        <span>%%1%%:</span>
        <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />
        
        <span class=\"zobrazovani_dodatek\">%%7%% Formát je %%8%%. Datum a čas zapiš v tomto tvaru: %%9%%</span>
      </label>\n", // %%10%% - poradi

                  "admin_addeditobsah_autodel_onkeyp" => " onkeyup=\"PrepisDatumu(this.value, '%%1%%', '%%2%%', '%%3%%');\"",

                  "admin_addeditobsah_autodel_id" => " id=\"%%1%%\"",

                  "admin_addobsah_form" => "
<div class=\"pridat_upravit_obsah_dynamicke_zobrazeni\">
  <h3>Přidat položku</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%3%%\" title=\"Zpět na výpis položek\">Zpět na výpis položek</a></p>
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
  function PrepisovaniTextu(text)
  {
    var xmlHttp = CreateXmlHttpObject();
    if (xmlHttp == null)
    {
      alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
      return;
    }

    var send = \"action=prepis&text=\"+text+\"&kid=\"+Math.random();

    xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, \"rewrite_input\");};  //po dokonceni se zavola

    xmlHttp.open(\"POST\", \"%%2%%/ajax.php\", true);
    xmlHttp.setRequestHeader(\"Content-Type\", \"application/x-www-form-urlencoded\");
    xmlHttp.send(send);
  }

                /**
                 * Vykonavaci fukce, posila instrukce na server
                 * @param text vstupni text
                 */
                function PrepisDatumu(zdroj, id_output, inc, format)
                {
                  var xmlHttp = CreateXmlHttpObject();
                  if (xmlHttp == null)
                  {
                    alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
                    return;
                  }

                  var send = \"action=prepisdatumu&zdroj=\"+zdroj+\"&inc=\"+inc+\"&format=\"+format+\"&kid=\"+Math.random();

                  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, id_output);};  //po dokonceni se zavola

                  xmlHttp.open(\"POST\", \"%%2%%/ajax.php\", true);
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
            document.getElementById(element).value = xmlHttp.responseText;
          }
        break;
      }
    }
  }
</script>

      <label class=\"input_text neaktivni_polozka\">
        <span>Název v adrese:</span>
        <input type=\"text\" name=\"nazev\" value=\"\" onkeyup=\"PrepisovaniTextu(this.value);\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text neaktivni_polozka\">
        <span>Rewrite názvu:</span>
        <input type=\"text\" name=\"rewrite\" value=\"\" id=\"rewrite_input\" readonly=\"readonly\" />
      </label>
      <label class=\"submit%%6%%\">
        <input type=\"submit\"%%4%%%%5%% value=\"Přidat položku\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přidána položka: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet obrázků navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editobsah_form" => "
<div class=\"pridat_upravit_obsah_dynamicke_zobrazeni\">
  <h3>Upravit položku</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%5%%\" title=\"Zpět na výpis položek\">Zpět na výpis položek</a></p>
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
  function PrepisovaniTextu(text)
  {
    var xmlHttp = CreateXmlHttpObject();
    if (xmlHttp == null)
    {
      alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
      return;
    }

    var send = \"action=prepis&text=\"+text+\"&kid=\"+Math.random();

    xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, \"rewrite_input\");};  //po dokonceni se zavola

    xmlHttp.open(\"POST\", \"%%4%%/ajax.php\", true);
    xmlHttp.setRequestHeader(\"Content-Type\", \"application/x-www-form-urlencoded\");
    xmlHttp.send(send);
  }

                /**
                 * Vykonavaci fukce, posila instrukce na server
                 * @param text vstupni text
                 */
                function PrepisDatumu(zdroj, id_output, inc, format)
                {
                  var xmlHttp = CreateXmlHttpObject();
                  if (xmlHttp == null)
                  {
                    alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
                    return;
                  }

                  var send = \"action=prepisdatumu&zdroj=\"+zdroj+\"&inc=\"+inc+\"&format=\"+format+\"&kid=\"+Math.random();

                  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, id_output);};  //po dokonceni se zavola

                  xmlHttp.open(\"POST\", \"%%4%%/ajax.php\", true);
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
            document.getElementById(element).value = xmlHttp.responseText;
          }
        break;
      }
    }
  }
</script>

      <label class=\"input_text neaktivni_polozka\">
        <span>Název v adrese:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%2%%\" onkeyup=\"PrepisovaniTextu(this.value);\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text neaktivni_polozka\">
        <span>Rewrite názvu:</span>
        <input type=\"text\" name=\"rewrite\" value=\"%%3%%\" id=\"rewrite_input\" readonly=\"readonly\" />
      </label>
      <label class=\"submit%%8%%\">
        <input type=\"submit\"%%6%%%%7%% value=\"Upravit položku\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla upravena položka: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet obrázků navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delobsah_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla smazána položka: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet obrázků navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_obsah" => "
<div class=\"dynamicke_zobrazovani_hlavni_vypis\">
  <h3>Výpis šablon s elementy</h3>
  <p class=\"odkazy_pridat_nastavit\">
    %%3%%
    <span>
      <a href=\"%%1%%\" title=\"Nastavení nahrávaných obrázků\">Nastavení nahrávaných obrázků</a> - <a href=\"%%2%%\" title=\"Test regulárních výrazů\">Test regulárních výrazů</a>
    </span>
  </p>
%%4%%
</div>\n",

                  "admin_test_rv" => "
<div class=\"nastaveni_obrazku_dynamicke_zobrazeni\">
  <h3>Test regulárních výrazů</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%4%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>Příklady:</span>
      </label>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/</span>
      </label>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>/^(\+420)?[0-9]{9}$/</span>
      </label>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span><a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" title=\"Dokumentace\">Dokumentace</a></span>
      </label>
      <label class=\"nadpis_sekce_zobrazovani\">
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
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>%%3%%<!-- --></span>
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_config" => "
<div class=\"nastaveni_obrazku_dynamicke_zobrazeni\">
  <h3>Nastavení nahrávaných obrázků</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%1%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>Nastavení miniatury</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%6%% name=\"mini\" onclick=\"mini_1();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka miniatury [width]:</span>
        <input type=\"text\" name=\"w_mini\" id=\"mini1_p1\" value=\"%%7%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%8%% name=\"mini\" onclick=\"mini_2();\" />
      </label>
      <label class=\"input_text\">
        <span>Výška miniatury [height]:</span>
        <input type=\"text\" name=\"h_mini\" id=\"mini2_p1\" value=\"%%9%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%10%% name=\"mini\" onclick=\"mini_3();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka miniatury [width]:</span>
        <input type=\"text\" name=\"w_mini\" id=\"mini3_p1\" value=\"%%7%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška miniatury [height]:</span>
        <input type=\"text\" name=\"h_mini\" id=\"mini3_p2\" value=\"%%9%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Vlastní miniatura:</span>
        <input type=\"radio\"%%11%% name=\"mini\" onclick=\"mini_4();\" />
      </label>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>Nastavení plného náhledu</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_1();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"w_full\" id=\"full1_p1\" value=\"%%13%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%14%% name=\"full\" onclick=\"full_2();\" />
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"h_full\" id=\"full2_p1\" value=\"%%15%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%16%% name=\"full\" onclick=\"full_3();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"w_full\" id=\"full3_p1\" value=\"%%13%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"h_full\" id=\"full3_p2\" value=\"%%15%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Originální velikost:</span>
        <input type=\"radio\"%%17%% name=\"full\" onclick=\"full_4();\" />
        <span class=\"zobrazovani_dodatek\">Ponechá velikost obrázku zjištěnou při nahrávání.</span>
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"w_full\" value=\"0\" disabled=\"disabled\" />
        <span class=\"zobrazovani_dodatek\">Tato položka má informativní účel. Nuly znamenají automatické zjištění velikosti obrázku při jeho nahrávání.</span>
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"h_full\" value=\"0\" disabled=\"disabled\" />
        <span class=\"zobrazovani_dodatek\">Tato položka má informativní účel. Nuly znamenají automatické zjištění velikosti obrázku při jeho nahrávání.</span>
      </label>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>Nastavení limitu nahrávání</span>
      </label>
      <label class=\"input_radio\">
        <span>Limit nahrávání obrázku:</span>
        <input type=\"radio\"%%2%% name=\"lim\" onclick=\"lim_1();\" />
      </label>
      <label class=\"input_text\">
        <span>Hodnota limitu nahrávání obrázku:</span>
        <input type=\"text\" name=\"limit\" id=\"lim_p1\" value=\"%%3%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [MB].</span>
      </label>
      <label class=\"input_radio\">
        <span>Neomezený limit nahrávání obrázku:</span>
        <input type=\"radio\"%%4%% name=\"lim\" onclick=\"lim_2();\" />
        <span class=\"zobrazovani_dodatek\">Při tomto nastavení je limit omezen jen výchozím nastavením PHP konfigurace.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Uložit nastavení\" />
      </label>
    </fieldset>
  </form>
</div>

<script type=\"text/javascript\">
  function mini_1()
  {
    document.getElementById('mini1_p1').disabled = false;
    document.getElementById('mini2_p1').disabled = true;
    document.getElementById('mini3_p1').disabled = true;
    document.getElementById('mini3_p2').disabled = true;
  }

  function mini_2()
  {
    document.getElementById('mini1_p1').disabled = true;
    document.getElementById('mini2_p1').disabled = false;
    document.getElementById('mini3_p1').disabled = true;
    document.getElementById('mini3_p2').disabled = true;
  }

  function mini_3()
  {
    document.getElementById('mini1_p1').disabled = true;
    document.getElementById('mini2_p1').disabled = true;
    document.getElementById('mini3_p1').disabled = false;
    document.getElementById('mini3_p2').disabled = false;
  }

  function mini_4()
  {
    document.getElementById('mini1_p1').disabled = true;
    document.getElementById('mini2_p1').disabled = true;
    document.getElementById('mini3_p1').disabled = true;
    document.getElementById('mini3_p2').disabled = true;
  }

  function full_1()
  {
    document.getElementById('full1_p1').disabled = false;
    document.getElementById('full2_p1').disabled = true;
    document.getElementById('full3_p1').disabled = true;
    document.getElementById('full3_p2').disabled = true;
  }

  function full_2()
  {
    document.getElementById('full1_p1').disabled = true;
    document.getElementById('full2_p1').disabled = false;
    document.getElementById('full3_p1').disabled = true;
    document.getElementById('full3_p2').disabled = true;
  }

  function full_3()
  {
    document.getElementById('full1_p1').disabled = true;
    document.getElementById('full2_p1').disabled = true;
    document.getElementById('full3_p1').disabled = false;
    document.getElementById('full3_p2').disabled = false;
  }

  function full_4()
  {
    document.getElementById('full1_p1').disabled = true;
    document.getElementById('full2_p1').disabled = true;
    document.getElementById('full3_p1').disabled = true;
    document.getElementById('full3_p2').disabled = true;
  }

  function lim_1()
  {
    document.getElementById('lim_p1').disabled = false;
  }

  function lim_2()
  {
    document.getElementById('lim_p1').disabled = true;
  }

  %%5%%
  %%18%%
  %%19%%
</script>\n",

                  "admin_config_save" => "
<div class=\"central_absolutni central_info\">
  <p>
    Bylo upraveno nastavení nahrávaných obrázků
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_addsab" => "
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
  function PrepisovaniTextu(text)
  {
    var xmlHttp = CreateXmlHttpObject();
    if (xmlHttp == null)
    {
      alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
      return;
    }

    var send = \"action=prepis&text=\"+text+\"&kid=\"+Math.random();

    xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, \"rewrite_input\");};  //po dokonceni se zavola

    xmlHttp.open(\"POST\", \"%%1%%/ajax.php\", true);
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
            document.getElementById(element).value = xmlHttp.responseText;
          }
        break;
      }
    }
  }
</script>

<div class=\"dynamicke_zobrazovani_addedit_sablony\">
  <h3>Přidat šablonu</h3>
  <p class=\"backlink_zobrazovani\">
    <a href=\"%%2%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Adresa šablony:</span>
        <input type=\"text\" name=\"adresa\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
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
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Položek na RSS odběru:</span>
        <input type=\"text\" name=\"nove_rss\" value=\"10\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
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
        <input type=\"text\" name=\"nazev\" onkeyup=\"PrepisovaniTextu(this.value);\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Rewrite názvu:</span>
        <input type=\"text\" name=\"rewrite\" id=\"rewrite_input\" readonly=\"readonly\" />
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
  function PrepisovaniTextu(text)
  {
    var xmlHttp = CreateXmlHttpObject();
    if (xmlHttp == null)
    {
      alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
      return;
    }

    var send = \"action=prepis&text=\"+text+\"&kid=\"+Math.random();

    xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, \"rewrite_input\");};  //po dokonceni se zavola

    xmlHttp.open(\"POST\", \"%%1%%/ajax.php\", true);
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
            document.getElementById(element).value = xmlHttp.responseText;
          }
        break;
      }
    }
  }
</script>

<div class=\"dynamicke_zobrazovani_addedit_sablony\">
  <h3>Upravit šablonu</h3>
  <p class=\"backlink_zobrazovani\">
    <a href=\"%%14%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Adresa šablony:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%2%%\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle data [A -> Z, 0 -> 9]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"ASC\"%%3%% />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle data [Z -> A, 9 -> 0]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"DESC\"%%4%% />
      </label>
      <label class=\"input_text\">
        <span>Položek na stručném výpisu:</span>
        <input type=\"text\" name=\"nove\" value=\"%%5%%\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Položek na RSS odběru:</span>
        <input type=\"text\" name=\"nove_rss\" value=\"%%6%%\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_textarea\">
        <span>Popis šablony:</span>
        <textarea name=\"popisek\" rows=\"30\" cols=\"80\">%%9%%</textarea>
      </label>
      <label class=\"input_text\">
        <span>id:</span>
        <input type=\"text\" name=\"href_id\" value=\"%%10%%\" />
      </label>
      <label class=\"input_text\">
        <span>class:</span>
        <input type=\"text\" name=\"href_class\" value=\"%%11%%\" />
      </label>
      <label class=\"input_text\">
        <span>akce:</span>
        <input type=\"text\" name=\"href_akce\" value=\"%%12%%\" />
      </label>
      <label class=\"input_text\">
        <span>Název v menu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%7%%\" onkeyup=\"PrepisovaniTextu(this.value);\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Rewrite názvu:</span>
        <input type=\"text\" name=\"rewrite\" value=\"%%8%%\" id=\"rewrite_input\" readonly=\"readonly\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Zobrazit v menu:</span>
        <input type=\"checkbox\" name=\"zobrazit\"%%13%% />
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

                  "admin_addeditelem_value_pic" => "
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>Nastavení miniatury</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%5%% name=\"mini\" onclick=\"mini_1();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka miniatury [width]:</span>
        <input type=\"text\" name=\"value[0]\" id=\"mini1_p1\" value=\"%%1%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%6%% name=\"mini\" onclick=\"mini_2();\" />
      </label>
      <label class=\"input_text\">
        <span>Výška miniatury [height]:</span>
        <input type=\"text\" name=\"value[1]\" id=\"mini2_p1\" value=\"%%2%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%7%% name=\"mini\" onclick=\"mini_3();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka miniatury [width]:</span>
        <input type=\"text\" name=\"value[0]\" id=\"mini3_p1\" value=\"%%1%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška miniatury [height]:</span>
        <input type=\"text\" name=\"value[1]\" id=\"mini3_p2\" value=\"%%2%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Vlastní miniatura:</span>
        <input type=\"radio\"%%8%% name=\"mini\" onclick=\"mini_4();\" />
      </label>
      <label class=\"nadpis_sekce_zobrazovani\">
        <span>Nastavení plného náhledu</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%9%% name=\"full\" onclick=\"full_1();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"value[2]\" id=\"full1_p1\" value=\"%%3%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%10%% name=\"full\" onclick=\"full_2();\" />
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"value[3]\" id=\"full2_p1\" value=\"%%4%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%11%% name=\"full\" onclick=\"full_3();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"value[2]\" id=\"full3_p1\" value=\"%%3%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"value[3]\" id=\"full3_p2\" value=\"%%4%%\" />
        <span class=\"zobrazovani_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Originální velikost:</span>
        <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_4();\" />
        <span class=\"zobrazovani_dodatek\">Ponechá velikost obrázku zjištěnou při nahrávání.</span>
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"value[2]\" value=\"0\" disabled=\"disabled\" />
        <span class=\"zobrazovani_dodatek\">Tato položka má informativní účel. Nuly znamenají automatické zjištění velikosti obrázku při jeho nahrávání.</span>
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"value[3]\" value=\"0\" disabled=\"disabled\" />
        <span class=\"zobrazovani_dodatek\">Tato položka má informativní účel. Nuly znamenají automatické zjištění velikosti obrázku při jeho nahrávání.</span>
      </label>

<script type=\"text/javascript\">
  function mini_1()
  {
    document.getElementById('mini1_p1').disabled = false;
    document.getElementById('mini2_p1').disabled = true;
    document.getElementById('mini3_p1').disabled = true;
    document.getElementById('mini3_p2').disabled = true;
  }

  function mini_2()
  {
    document.getElementById('mini1_p1').disabled = true;
    document.getElementById('mini2_p1').disabled = false;
    document.getElementById('mini3_p1').disabled = true;
    document.getElementById('mini3_p2').disabled = true;
  }

  function mini_3()
  {
    document.getElementById('mini1_p1').disabled = true;
    document.getElementById('mini2_p1').disabled = true;
    document.getElementById('mini3_p1').disabled = false;
    document.getElementById('mini3_p2').disabled = false;
  }

  function mini_4()
  {
    document.getElementById('mini1_p1').disabled = true;
    document.getElementById('mini2_p1').disabled = true;
    document.getElementById('mini3_p1').disabled = true;
    document.getElementById('mini3_p2').disabled = true;
  }

  function full_1()
  {
    document.getElementById('full1_p1').disabled = false;
    document.getElementById('full2_p1').disabled = true;
    document.getElementById('full3_p1').disabled = true;
    document.getElementById('full3_p2').disabled = true;
  }

  function full_2()
  {
    document.getElementById('full1_p1').disabled = true;
    document.getElementById('full2_p1').disabled = false;
    document.getElementById('full3_p1').disabled = true;
    document.getElementById('full3_p2').disabled = true;
  }

  function full_3()
  {
    document.getElementById('full1_p1').disabled = true;
    document.getElementById('full2_p1').disabled = true;
    document.getElementById('full3_p1').disabled = false;
    document.getElementById('full3_p2').disabled = false;
  }

  function full_4()
  {
    document.getElementById('full1_p1').disabled = true;
    document.getElementById('full2_p1').disabled = true;
    document.getElementById('full3_p1').disabled = true;
    document.getElementById('full3_p2').disabled = true;
  }

  function lim_1()
  {
    document.getElementById('lim_p1').disabled = false;
  }

  function lim_2()
  {
    document.getElementById('lim_p1').disabled = true;
  }

  %%13%%
  %%14%%
</script>\n",

                  "admin_addelem" => "
<div class=\"pridat_upravit_element_dynamicke_zobrazeni\">
  <h3>Přidat element do šablony</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%9%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a></p>
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
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
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
      <label class=\"input_text\">
        <span>Pořadí elementu:</span>
        <input type=\"text\" name=\"poradi\" value=\"%%8%%\" />
        <span class=\"zobrazovani_dodatek\">Zapsaná hodnota musí být větší než nula.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat element\" />
      </label>
    </fieldset>
  </form>
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

                  "admin_obsah_add_link" => "<a href=\"%%1%%\" title=\"Přidat šablonu do generovaného obsahu\">Přidat šablonu</a>",

                  "admin_addeditelem_value" => "
      <label class=\"input_text\">
        <span>Value hodnota:</span>
        <input type=\"text\" name=\"value\" value=\"%%1%%\" />
      </label>\n",

                  "admin_addeditelem_autodel_value" => "id elementu autodel: <input type=\"text\" name=\"value\" value=\"%%1%%\" /> (nějaký id název)<br />",

                  "admin_addeditelem_autodel_reg_exp" => "defaultní přičítací hodnota: <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" /> <a href=\"http://php.net/manual/en/function.strtotime.php\">dokumentace</a><br />",

                  "admin_addeditelem_vstupni_typ" => "
      <label class=\"input_select\">
        <span>Typ vstupu:</span>
%%1%%
      </label>\n",

                  "admin_addeditelem_reg_exp" => "
      <label class=\"input_text\">
        <span>Regulární výraz:</span>
        <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" />
        <span class=\"zobrazovani_dodatek\"><a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" title=\"Dokumentace\">Dokumentace</a></span>
      </label>\n",

                  "admin_addeditelem_vystupni_format" => "
      <label class=\"input_text\">
        <span>Výstupní formát data / času:</span>
        <input type=\"text\" name=\"vystupni_format\" value=\"%%1%%\" />
        <span class=\"zobrazovani_dodatek\"><a href=\"http://php.net/manual/en/function.date.php\" title=\"Dokumentace\">Dokumentace</a></span>
      </label>\n",

                  "admin_addeditelem_min_max_poc" => "
      <label class=\"input_text\">
        <span>Minimální hodnota:</span>
        <input type=\"text\" name=\"min_poc\" value=\"%%1%%\" />
        <span class=\"zobrazovani_dodatek\">Nepovinná položka. Při vybraném textovém vstupu nastavuje minimální délku, u čísla minimální hodnotu. 0 = Neaktivní.</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální hodnota:</span>
        <input type=\"text\" name=\"max_poc\" value=\"%%2%%\" />
        <span class=\"zobrazovani_dodatek\">Nepovinná položka. Při vybraném textovém vstupu nastavuje maximální délku, u čísla maximální hodnotu. 0 = Neaktivní.</span>
      </label>\n",

                  "admin_editelem" => "
<div class=\"pridat_upravit_element_dynamicke_zobrazeni\">
  <h3>Upravit element v šabloně</h3>
  <p class=\"backlink_zobrazovani\"><a href=\"%%14%%\" title=\"Zpět na výpis šablon s elementy\">Zpět na výpis šablon s elementy</a></p>
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
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
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
      <label class=\"input_text\">
        <span>Pořadí elementu:</span>
        <input type=\"text\" name=\"poradi\" value=\"%%13%%\" />
        <span class=\"zobrazovani_dodatek\">Zapsaná hodnota musí být větší než nula.</span>
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

                  "admin_vypis_sablona" => "
<ul class=\"vypis_sablon_zahlavi\">
  <li>[%%1%%] - %%3%%</li>
  <li class=\"adresa_sablony\">%%2%%</li>
  <li class=\"odkazy_pridat_upravit\"><p>%%7%%<a href=\"%%6%%\" title=\"Upravit šablonu\">Upravit šablonu</a></p></li>
</ul>
<div class=\"obal_vypis_sablon_obsah\">\n",

                  "admin_vypis_skupina_end" => "\n</div>\n",

                  "admin_vypis_element" => "
<ul class=\"vypis_sablon_polozka\">
  <li>Typ elementu: <strong>%%3%%</strong></li>
  <li>Popis elementu: <strong>%%1%%</strong></li>
  <li>Value hodnota: <strong>%%2%%</strong></li>
  <li class=\"povinna_polozka_checkbox\"><em>Povinná položka:</em><input type=\"checkbox\"%%4%% disabled=\"disabled\" /></li>
  <li>Pořadí elementu: <strong>%%7%%</strong></li>
  <li class=\"odkazy_pridat_upravit\"><a href=\"%%8%%\" title=\"Upravit element\">Upravit element</a>%%9%%</li>
</ul>\n",

                  "admin_vypis_element_null" => "
<ul class=\"prazdna_sablona\">
  <li>Prázdná šablona</li>
</ul>\n",

                  "admin_vypis_del_link" => " - <a href=\"%%1%%\" title=\"Smazat element\" onclick=\"return confirm('Opravdu chceš smazat element: &quot;%%2%%&quot; ?');\">Smazat element</a>",

                  "admin_obsah_sablony" => "
<div class=\"vypis_sekce_uzivatelske_rozhrani\">
  <h3>Výpis sekce <strong>%%4%%</strong></h3>
  <p class=\"odkaz_pridat_polozku_sekce\">
    <a href=\"%%1%%\" title=\"Přidat položku\">Přidat položku</a>
    <span>%%2%%<!-- --></span>
  </p>
%%3%%
</div>\n",

                  "admin_vypis_obsah" => "
<div class=\"vypis_polozky_uzivatelske_rozhrani\">
  <ul class=\"staticke_info_uzivatelske_rozhrani\">
    <li>%%2%%</li>
    <li class=\"datum_polozky\">Datum přidání: <strong>%%3%%</strong></li>
    <li class=\"odkazy_upravit_smazat\"><a href=\"%%6%%\" title=\"Upravit položku\">Upravit položku</a> - <a href=\"%%7%%\" title=\"Smazat položku\" onclick=\"return confirm('Opravdu chceš smazat položku: &quot;%%2%%&quot; ?');\">Smazat položku</a></li>
  </ul>
  <div>
    %%8%% [%%9%%]
  </div>
  <div>
    %%10%%
  </div>
</div>\n", // %%4%% nazev, %%5%% rewrite, %%1%% nazev sekce

                  "set_admin_datum" => "H:i:s / d.m.Y",

                  "set_element" => array ("nadpis" =>  "Nadpis",
                                          "popisek" => "Krátký text",
                                          "text" =>    "Dlouhý text",
                                          "obrazek" => "Obrázek",
                                          "datum" =>   "Datum",
                                          "cas" =>     "Čas",
                                          "datumcas" =>"Datum a čas",
                                          "checkbox" => "Checkbox",
                                          "autodel" => "Automatické mazání"
                                          ),

                  "admin_vypis_empty_value" => "(žádná hodnota)",

                  "set_admin_prepnani_unikatnich" => false, //true - promenne/false - jednotne

                  "set_povolit_pridani" => true,

                  "set_vypis_chybu" => false,

                  "set_znacka_povinne" => "Povinná položka.",

                  "set_pathpicture" => "obrazky",

                  "set_minidir" => "mini",

                  "set_fulldir" => "full",

                  "set_conffile" => ".config_file",

                  "set_adresa_sekce" => "sekce",

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

                  "ajax_prepis" => array ("\xc3\xa1" => "a",
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
                                          "\xc3\x81" => "a",
                                          "\xc3\x84" => "a",
                                          "\xc4\x8c" => "c",
                                          "\xc4\x8e" => "d",
                                          "\xc3\x89" => "e",
                                          "\xc4\x9a" => "e",
                                          "\xc3\x8d" => "i",
                                          "\xc4\xbd" => "l",
                                          "\xc4\xb9" => "l",
                                          "\xc5\x87" => "n",
                                          "\xc3\x93" => "o",
                                          "\xc3\x96" => "o",
                                          "\xc5\x90" => "o",
                                          "\xc3\x94" => "o",
                                          "\xc5\x98" => "r",
                                          "\xc5\x94" => "r",
                                          "\xc5\xa0" => "s",
                                          "\xc5\xa4" => "t",
                                          "\xc3\x9a" => "u",
                                          "\xc5\xae" => "u",
                                          "\xc3\x9c" => "u",
                                          "\xc5\xb0" => "u",
                                          "\xc3\x9d" => "y",
                                          "\xc5\xbd" => "z",
                                          "A" => "a",
                                          "B" => "b",
                                          "C" => "c",
                                          "D" => "d",
                                          "E" => "e",
                                          "F" => "f",
                                          "G" => "g",
                                          "H" => "h",
                                          "I" => "i",
                                          "J" => "j",
                                          "K" => "k",
                                          "L" => "l",
                                          "M" => "m",
                                          "N" => "n",
                                          "O" => "o",
                                          "P" => "p",
                                          "Q" => "q",
                                          "R" => "r",
                                          "S" => "s",
                                          "T" => "t",
                                          "U" => "u",
                                          "V" => "v",
                                          "W" => "w",
                                          "X" => "x",
                                          "Y" => "y",
                                          "Z" => "z",
                                          " " => "-",
                                          "." => "-",
                                          "(" => "-",
                                          ")" => "-",
                                          "[" => "-",
                                          "]" => "-",
                                          "{" => "-",
                                          "}" => "-",
                                          "ˇ" => "-",
                                          "´" => "-",
                                          //"-" => "_",
                                          "+" => "-",
                                          ";" => "-",
                                          ":" => "-",
                                          "," => "-",
                                          "'" => "-",
                                          "?" => "-",
                                          "<" => "-",
                                          ">" => "-",
                                          "\x5c" => "-",  // /
                                          "\x2f" => "-",  // \
                                          "|" => "-",
                                          "=" => "-",
                                          "!" => "-",
                                          "*" => "-",
                                          "@" => "-",
                                          "%" => "-",
                                          "&" => "-",
                                          "§" => "-",
                                          "#" => "-",
                                          "$" => "-",
                                          "\"" => "-",
                                          "˚" => "-",
                                          "`" => "-",
                                          "~" => "-",
                                          "^" => "-",
                                          "€" => "-",
                                          "¶" => "-",
                                          "¨" => "-",
                                          "ŧ" => "-",
                                          "¯" => "-",
                                          "←" => "-",
                                          "→" => "-",
                                          "↓" => "-",
                                          "ø" => "-",
                                          "þ" => "-",
                                          "Đ" => "d",
                                          "đ" => "d"
                                          ),


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
