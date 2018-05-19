<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamická návštěvní kniha - tvůrce knih",
                                              "title" => "dynamická návštěvní kniha - tvůrce knih",
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

                  "admin_vypis_edit_link_skupina" => "
          <a href=\"%%1%%\" title=\"%%2%%\">%%2%%</a> (%%3%%)<br />
          ",

                  "admin_vypis_obsahu_skupiny" => "<br />
        %%1%%<br />
        %%2%%<br />
        %%3%%
        ",

                  //normalni vypis
                  "normal_vypis_1" => "
                  normal vypis:<br />
                  url: %%1%% >%%2%%<br />
                  %%3%% %%4%%<br />
                  %%5%%< %%6%%<br />
                  %%7%% [captcha id:%%8%%]<br />
                  %%9%% %%10%%<br />
                  %%11%% %%12%%<br />
                  %%13%% %%14%%<br />
                  %%15%% %%16%%<br /><br />
                  ",

                  "normal_visible_email_1" => "vidíš mě: <a href=\"mailto:%%1%%\">a co ted? (%%1%%) (%%2%%)</a>",

                  "normal_invsible_email_1" => "nevidíš mě: (%%1%%) (%%2%%)",

                  "normal_num_jmeno_1" => 6,

                  "normal_vypis_null_1" => "zadaná adresa neexistuje",

                  "normal_vypis_prvni_1" => "prvni",

                  "normal_vypis_posledni_1" => "posledni",

                  "normal_vypis_ente_def_array_1" => array(1, 2, 5),

                  "normal_vypis_ente_def_1" => "aktivni",

                  "normal_vypis_ente_od_1" => 0,

                  "normal_vypis_ente_po_1" => 2,

                  "normal_vypis_ente_1" => "ente",

                  "normal_addobsah_form_1" => "
            <script type=\"text/javascript\" src=\"%%1%%%%2%%/ajax.js\"></script>

                  <form method=\"post\" action=\"\" id=\"centralni_form\">
                    <fieldset>
                      Jméno: <input type=\"text\"%%5%%%%7%% onkeyup=\"KontrolaFormatu(this.value, %%3%%, %%4%%, 'id_elem_%%3%%_%%4%%');\" value=\"%%6%%\" /> %%12%% <div id=\"id_elem_%%3%%_%%4%%\"></div><div id=\"id_elem_%%3%%_%%4%%_fin\">vysledek</div><br />
                      Email: <input type=\"text\"%%14%%%%16%% onkeyup=\"KontrolaFormatu(this.value, %%3%%, %%13%%, 'id_elem_%%3%%_%%13%%');\" value=\"%%15%%\" /> skrýt:<input type=\"checkbox\"%%20%% /> %%21%% <div id=\"id_elem_%%3%%_%%13%%\"></div><div id=\"id_elem_%%3%%_%%13%%_fin\">vysledek</div><br />

                      %%25%%<br />
                      <input type=\"text\"%%23%% /> ID: %%24%%, nezobrazovat: (%%26%%) %%30%%<br />
                      <br />

                      Text:<br />
                      <textarea%%32%%>%%33%%</textarea>%%38%%<br />

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

                      <input type=\"submit\"%%39%%%%40%% value=\"Přidat příspěvek\" /><br />
                    </fieldset>
                  </form>
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
%%22%% - 22
%%23%% - 23
%%24%% - 24
%% 25 %% - 25
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

<hr />
                  ",

                  "normal_addobsah_form_hlaska_1" => "přidán obsah: %%1%%, <a href=\"%%2%%\">klikni</a>
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
                  ",


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

                  "set_autoklik_1" => false,

                  "set_time_autoklik_1" => 10,

                  "set_show_form_1" => true,  //true/false - prida/nahradi


                  "admin_error_empty" => "nevyplnil si element: <strong>%%1%%</strong><br />",

                  "admin_error_min_max" => "nedodržení rozsahu v elementu: <strong>%%1%%</strong><br />",

                  "admin_error_min" => "nedodržení minima u elementu: <strong>%%1%%</strong><br />",

                  "admin_error_max" => "překročení maxima u elementu: <strong>%%1%%</strong><br />",

                  "admin_error_reg_exp" => "špatný tvar vstupu u elementu: <strong>%%1%%</strong><br />",

                  "admin_error_empty_captcha" => "nevyplnil si <strong>captcha kod</strong><br />",

                  "admin_error_wrong_captcha" => "zadal si špatně <strong>captcha kod</strong><br />",

                  "admin_error_unknown" => "blíže nespecifikovaná chyba v elementu: <strong>%%1%%</strong><br />",

                  "admin_error_hidden" => "<input type=\"hidden\" name=\"elem_%%1%%\" value=\"%%2%%\" />",

                  "admin_error_button" => "<input type=\"submit\" name=\"error_tlacitko\" value=\"znovu skusit\" />",

                  "admin_error_end" => "chyby: <br />%%1%%<br /> <a href=\"%%4%%\">přejít</a><br />

                  <form method=\"post\" action=\"\" id=\"centralni_form\">
                    <fieldset>
                      %%2%%
                      %%3%%<br />
                    </fieldset>
                  </form>
                  ",


                  "admin_addeditobsah_skryt_obsah" => "<input type=\"checkbox\" name=\"skryt_elem_%%1%%\"%%2%% /> skrýt obsah<br />",

                  "admin_addeditobsah_nadpis" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\"%%4%% value=\"%%3%%\"%%5%%%%6%%%%7%% />%%8%% (%%9%%)<br />",

                  "admin_addeditobsah_popisek" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" onkeyup=\"KontrolaFormatu(this.value, %%11%%, %%2%%, 'id_elem_%%11%%_%%2%%');\"%%4%% value=\"%%3%%\"%%5%%%%6%%%%7%% /><div id=\"id_elem_%%11%%_%%2%%\"></div>%%8%% %%10%% (%%9%%)<br />",

                  "admin_addeditobsah_text" => "%%1%% <textarea name=\"elem_%%2%%\"%%5%%%%6%%%%7%%%%4%%>%%3%%</textarea>%%8%% (%%9%%)<br />",

                  "admin_addeditobsah_captcha" => "%%5%%<br />%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%4%%\"%%6%%%%7%%%%8%% />%%9%% (%%10%%, slovo: %%4%%, id captcha: %%3%%)<br />",

                  "admin_addeditobsah_datum" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%% (%%10%%)<br />",

                  "admin_addeditobsah_cas" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%% (%%10%%)<br />",

                  "admin_addeditobsah_datumcas" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%% (%%10%%)<br />",

                  "admin_addeditobsah_checkbox" => "%%1%% <input type=\"checkbox\" name=\"elem_%%2%%\"%%3%%%%8%%%%4%%%%5%%%%6%% />%%7%% (%%9%%)<br />",


                  "admin_addobsah_form" => "
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

          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              %%1%%
              zobrazit: <input type=\"checkbox\" name=\"zobrazit\" checked=\"checked\" /><br />
              <input type=\"submit\" name=\"tlacitko\"%%3%% value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_addobsah_hlaska" => "přidán obsah: %%1%%",

                  "admin_editobsah_form" => "
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

          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              %%1%%
              zobrazit: <input type=\"checkbox\" name=\"zobrazit\"%%2%% /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
            </fieldset>
          </form>
          ",

                  "admin_editobsah_hlaska" => "uložen obsah: %%1%%",

                  "admin_delobsah_hlaska" => "smazán obsah: %%1%%",


                  "admin_obsah_sablony" => "
                  <a href=\"%%1%%\">přidej admin příspěvek </a><br />
                  %%2%%<br />
                  %%3%%
                  ",

                  "admin_sablona_vypis_element" => "
                  %%1%%
                  ",

                  "admin_vyber_sablony_begin" => "<select name=\"sablona\">",

                  "admin_vyber_sablony" => "
          <option value=\"%%1%%\"%%2%%>%%3%% - %%4%%</option>
          ",

                  "admin_vyber_sablony_end" => "</select>",

                  "admin_vyber_sablony_null" => "zadaná šablona neexistuje",


                  "admin_vstupni_typ_select_begin" => "<select name=\"vstupni_typ\" onchange=\"document.location.href='%%1%%&amp;vstup='+this.value\">",

                  "admin_vstupni_typ_select" => "
        <option value=\"%%1%%\"%%2%%>%%3%%</option>
      ",
                  "admin_vstupni_typ_select_end" => "</select>",


                  "admin_typ_select_begin" => "<select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+this.value\">",

                  "admin_typ_select" => "
        <option value=\"%%1%%\"%%2%%>%%3%% - %%4%%</option>
      ",
                  "admin_typ_select_end" => "</select>",

                  "admin_obsah_add_link" => "
                  <a href=\"%%1%%\" title=\"\">přidej návštěvní knihu</a><br />
                  <a href=\"%%2%%\" title=\"\">přidej element do návštěvní knihy</a><br />
                  ",

                  "admin_obsah" => "administrace dynamicke návštevní knihy<br />
    <a href=\"%%1%%\" title=\"\">test regulárních výrazů</a><br />
    %%2%%
    %%3%%<br />",

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

                  "admin_addsab" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /> *<br />
              řazení podle data:<br />
              asc (A->Z, 0->9): <input type=\"radio\" name=\"razeni\" value=\"ASC\" /> (prvni nahore, posldeni dole)<br />
              desc (Z->A, 9->0): <input type=\"radio\" name=\"razeni\" value=\"DESC\" checked=\"checked\" /> (posledni nahore, prvni dole)<br />
              počet novych rss položek: <input type=\"text\" name=\"nove_rss\" value=\"5\" /><br />
              nazev: <input type=\"text\" name=\"nazev\" /> *<br />
              popisek: <textarea name=\"popisek\"></textarea><br />
              href_id: <input type=\"text\" name=\"href_id\" /><br />
              href_class: <input type=\"text\" name=\"href_class\" /><br />
              href_akce: <input type=\"text\" name=\"href_akce\" /><br />
              zobrazit: <input type=\"checkbox\" name=\"zobrazit\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>",

                  "admin_addsab_hlaska" => "přidána šablona: %%1%%",

                  "admin_editsab" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /> *<br />
              řazení podle data:<br />
              asc (A->Z, 0->9): <input type=\"radio\" name=\"razeni\" value=\"ASC\" %%2%% /><br />
              desc (Z->A, 9->0): <input type=\"radio\" name=\"razeni\" value=\"DESC\" %%3%% /><br />
              počet novych rss položek: <input type=\"text\" name=\"nove_rss\" value=\"%%4%%\" /><br />
              nazev: <input type=\"text\" name=\"nazev\" value=\"%%5%%\" /> *<br />
              popisek: <textarea name=\"popisek\">%%6%%</textarea><br />
              href_id: <input type=\"text\" name=\"href_id\" value=\"%%7%%\" /><br />
              href_class: <input type=\"text\" name=\"href_class\" value=\"%%8%%\" /><br />
              href_akce: <input type=\"text\" name=\"href_akce\" value=\"%%9%%\" /><br />
              zobrazit: <input type=\"checkbox\" name=\"zobrazit\"%%10%% /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
            </fieldset>
          </form>
              ",

                  "admin_editsab_hlaska" => "upravena šablona: %%1%%",

                  "admin_delsab_hlaska" => "smazána šablona: %%1%% a všechny elementy v ní!",


                  "admin_addeditelem_value" => "value: <input type=\"text\" name=\"value\" value=\"%%1%%\" /><br />",

                  "admin_addeditelem_captcha" => "ID captcha kodu: <input type=\"text\" name=\"value\" value=\"%%1%%\" /><br />",

                  "admin_addeditelem_skryt_obsah" => "skryt obsah: <input type=\"checkbox\" name=\"skryt_obsah\"%%1%% /><br />",

                  "admin_addeditelem_vstupni_typ" => "vstupní typ: %%1%%<br />",

                  "admin_addeditelem_reg_exp" => "reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" /> <a href=\"http://cz2.php.net/manual/en/function.preg-match.php\" target=\"_blank\">dokumentace</a><br />",

                  "admin_addeditelem_vystupni_format" => "vystupni_format: <input type=\"text\" name=\"vystupni_format\" value=\"%%1%%\" /> <a href=\"http://php.net/manual/en/function.date.php\">dokumentace</a><br />",

                  "admin_addeditelem_min_max_poc" => "
                  min_poc: <input type=\"text\" name=\"min_val\" value=\"%%1%%\" /> (u textu min počet, u čísla min hodnota)<br />
                  max_poc: <input type=\"text\" name=\"max_val\" value=\"%%2%%\" /> (u textu max počet, u čísla max hodnota)<br />
                  ",

                  "admin_addelem" => "<form method=\"post\">
            <fieldset>
              šablona: %%1%%<br />
              typ: %%2%%<br />
              nazev: <input type=\"text\" name=\"nazev\" />*<br />
              %%3%%
              input_id: <input type=\"text\" name=\"input_id\" /><br />
              input_class: <input type=\"text\" name=\"input_class\" /><br />
              input_akce: <input type=\"text\" name=\"input_akce\" /><br />
              povinne: <input type=\"checkbox\" name=\"povinne\" /><br />
              %%4%%
              %%5%%
              %%6%%
              %%7%%
              %%8%%
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%9%%\" /> * >0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>",

                  "admin_addelem_hlaska" => "přidán element: %%1%%",

                  "admin_editelem" => "<form method=\"post\">
            <fieldset>
              šablona: %%1%%<br />
              typ: %%2%%<br />
              nazev: <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />*<br />
              %%4%%
              input_id: <input type=\"text\" name=\"input_id\" value=\"%%5%%\" /><br />
              input_class: <input type=\"text\" name=\"input_class\" value=\"%%6%%\" /><br />
              input_akce: <input type=\"text\" name=\"input_akce\" value=\"%%7%%\" /><br />
              povinne: <input type=\"checkbox\" name=\"povinne\"%%8%% /><br />
              %%9%%
              %%10%%
              %%11%%
              %%12%%
              %%13%%
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%14%%\" /> * >0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
            </fieldset>
          </form>",

                  "admin_editelem_hlaska" => "upraven element: %%1%%",

                  "admin_delelem_hlaska" => "smazán element: %%1%%",


                  "admin_vypis_sablona_adddel_link" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat nazev: \'%%3%%\' ?');\">smazat šablonu</a>
                                                        <a href=\"%%2%%\" title=\"\">přidej element do šablony</a>",

                  "admin_vypis_del_link" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat adresu: \'%%2%%\' ?');\">smazat sekci</a>",

                  "admin_vypis_sablona" => "
          šablona: %%1%%, adresa: %%2%%, nazev: %%3%%, popis: %%4%%<br />
          <a href=\"%%5%%\" title=\"\">uprav šablonu</a>
          %%6%%
          <br />",

                  "admin_vypis_skupina_end" => "end šablony<br /><br />",

                  "admin_vypis_element" => "
nazev: %%1%%
<p>
value: %%2%%<br />
typ: %%3%%<br />
povinne: <input type=\"checkbox\"%%4%% disabled=\"disabled\" /><br />
skryt_obsah: <input type=\"checkbox\"%%5%% disabled=\"disabled\" /><br />
vstupni format: %%6%%<br />
vystupni format: %%7%%<br />
poradi: %%8%%<br />
<a href=\"%%9%%\" title=\"\">uprav element</a>
%%10%%
</p>
<br />
          ",

                  "admin_vypis_obsah" => "
          <br />
          obsah: %%1%%<br />
          přidáno: %%3%%<br />
          admin: %%6%%<br />
          [%%9%%, %%10%%, %%11%%, %%12%%, %%13%%, %%14%%]<br />
          zobrazeno: <input type=\"checkbox\"%%4%% disabled=\"disabled\" /><br />
          admin příspěvek: <input type=\"checkbox\"%%5%% disabled=\"disabled\" /><br />
          <a href=\"%%7%%\">uprav obsah</a>
          <a href=\"%%8%%\" title=\"\" onclick=\"return confirm('Opravdu smazat nazev: \'%%2%%\' ?');\">smazat obsah</a>
          <br />
          ",

                  "set_povolit_pridani" => true,

                  "set_vypis_chybu" => false,

                  "set_admin_prepnani_unikatnich" => false, //true - promenne/false - jednotne

                  "set_znacka_povinne" => "*",

                  "set_admin_datum" => "H:i:s / d.m.Y",

                  "set_element" => array ("nadpis" =>  "Napis :D", //index => slovní popis
                                          "popisek" => "Krátký popisek",
                                          "text" =>    "Dlouhé texty",

                                          "captcha" => "Captcha kod - 1x",

                                          "datum" =>   "Datum",
                                          "cas" =>     "Čas",
                                          "datumcas" =>"Datum a čas",

                                          "checkbox" => "Zaškrkávací políčko",
                                          ),

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


                  "ajax_dobre" => "dobre",

                  "ajax_spatne" => "špatne",

                  "ajax_set_get_id" => "id",

                  "ajax_set_get_sablona" => "sablona",

                  "ajax_set_get_text" => "text",

                  "ajax_kontrola_sql_dotaz" => "SELECT
                                                vstupni_typ, reg_exp, min_val, max_val
                                                FROM element_kniha
                                                WHERE sablona=%%1%% AND id=%%2%%
                                                ORDER BY poradi ASC;",

                  "set_hlavicka" => "Content-type: text/html; charset=UTF-8",

                  "set_prevod" => array("@" => "%40",
                                        "\n" => "<br />"),

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
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
