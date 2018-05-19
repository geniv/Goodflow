<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamické zobrazování - tvůrce šablon",
                                              "title" => "dynamicke zobrazování - tvůrce šablon",
                                              "id" => "",
                                              "class" => "dynamicky_obsah_menu",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_tvar_menu_odkaz" => "%%1%%",

                  "admin_tvar_menu_title" => "%%1%%",

                  "normal_link_rss_1" => "<link type=\"application/rss+xml\" rel=\"alternate\" href=\"%%1%%\" title=\"Novinky %%2%%\" />\n",

                  "normal_once_link_rss_1" => "<link type=\"application/rss+xml\" rel=\"alternate\" href=\"%%1%%\" title=\"Novinky\" />\n",

                  "normal_link_rss_web_1" => "<a href=\"%%1%%\">%%2%%</a>, ",

                  "normal_once_link_rss_web_1" => "<a href=\"%%1%%\">rss-ka</a>, ",

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
</rss>",

                  "admin_vypis_edit_link_skupina" => "
          <a href=\"%%1%%\" title=\"%%2%%\">%%2%%</a> (%%3%%)<br />
          ",

                  "admin_vypis_obsahu_skupiny" => "<br />
        %%1%%<br />
        %%2%%<br />
        %%3%%
        ",
                  //rychlo vypis
                  "normal_rychlo_vypis_1" => "
                  rychlo vypis:<br />
                  %%1%%<br />
                  %%2%%<br />
                  %%3%%<br />
                  %%4%%<br />
                  %%5%%<br />
                  %%6%%<br />
                  %%7%%<br />
                  %%8%%<br />
                  %%9%%<br />
                  %%10%%<br />
                  %%11%%<br />
                  %%12%%<br /><br />
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
                  "normal_vypis_1" => "
                  normal vypis:<br />
                  %%1%% %%2%%<br />
                  %%3%% >%%4%%<br />
                  %%5%% %%6%%<br />
                  %%7%%< %%8%%<br />
                  %%9%% %%10%%<br />
                  %%11%% %%12%%<br />
                  %%13%% %%14%%<br />
                  %%15%% %%16%%<br /><br />
                  ",

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

                  "normal_vypis_full_error_1" => "bohužel adresa je duplkatní a proto nelze přesně zaměřit",


                  "admin_addeditobsah_nadpis" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />%%7%% (%%8%%)<br />",

                  "admin_addeditobsah_popisek" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />%%7%% (%%8%%)<br />",

                  "admin_addeditobsah_text" => "%%1%% <textarea name=\"elem_%%2%%\"%%4%%%%5%%%%6%%>%%3%%</textarea>%%7%% (%%8%%)<br />",

                  "admin_addeditobsah_obrazek" => "
<hr />
                    %%1%% <input type=\"file\" name=\"elem_obr[%%2%%]\"%%3%%%%4%%%%5%% />%%6%%<br />
                    <input type=\"radio\"%%11%% name=\"mini%%2%%\" onclick=\"mini_1%%2%%();\" /> dopocitat vysku<br />
                    <input type=\"radio\"%%12%% name=\"mini%%2%%\" onclick=\"mini_2%%2%%();\" /> dopocitat sirku<br />
                    <input type=\"radio\"%%13%% name=\"mini%%2%%\" onclick=\"mini_3%%2%%();\" /> nastaveno napevno<br />
                    <input type=\"radio\"%%14%% name=\"mini%%2%%\" onclick=\"mini_4%%2%%();\" /> vlastní miniatura<br />
                    w_mini: <input type=\"text\" name=\"w_mini[%%2%%]\" id=\"mini_p1%%2%%\" value=\"%%7%%\" /><br />
                    h_mini: <input type=\"text\" name=\"h_mini[%%2%%]\" id=\"mini_p2%%2%%\" value=\"%%8%%\" /><br />
                    mini: <input type=\"file\" name=\"nahled_obr[%%2%%]\" id=\"mini_p3%%2%%\" /><br />

                    <input type=\"radio\"%%15%% name=\"full%%2%%\" onclick=\"full_1%%2%%();\" /> dopocitat vysku<br />
                    <input type=\"radio\"%%16%% name=\"full%%2%%\" onclick=\"full_2%%2%%();\" /> dopocitat sirku<br />
                    <input type=\"radio\"%%17%% name=\"full%%2%%\" onclick=\"full_3%%2%%();\" /> nastaveno napevno<br />
                    <input type=\"radio\"%%18%% name=\"full%%2%%\" onclick=\"full_4%%2%%();\" /> originální velikost<br />
                    w_full: <input type=\"text\" name=\"w_full[%%2%%]\" id=\"full_p1%%2%%\" value=\"%%9%%\" /><br />
                    h_full: <input type=\"text\" name=\"h_full[%%2%%]\" id=\"full_p2%%2%%\" value=\"%%10%%\" /><br />
                    <img src=\"%%21%%\" />
                    (%%23%%)
<hr />
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
                    </script>
                    ",

                  "admin_addeditobsah_datum" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%% (%%10%%)<br />",

                  "admin_addeditobsah_cas" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%% (%%10%%)<br />",

                  "admin_addeditobsah_datumcas" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%% (%%10%%)<br />",

                  "admin_addeditobsah_checkbox" => "%%1%% <input type=\"checkbox\" name=\"elem_%%2%%\"%%3%%%%8%%%%4%%%%5%%%%6%% />%%7%% (%%9%%)<br />",

                  "admin_addeditobsah_autodel" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%% (%%10%%)<br />",

                  "admin_addobsah_form" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
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

              nazev: <input type=\"text\" name=\"nazev\" value=\"\" onkeyup=\"PrepisovaniTextu(this.value);\" /><br />
              rewrite: <input type=\"text\" name=\"rewrite\" value=\"\" id=\"rewrite_input\" readonly=\"readonly\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_addobsah_hlaska" => "přidán obsah: %%1%%, navic: %%2%%",

                  "admin_addobsah_error" => "chybý data!",

                  "admin_editobsah_form" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
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

              nazev: <input type=\"text\" name=\"nazev\" value=\"%%2%%\" onkeyup=\"PrepisovaniTextu(this.value);\" /><br />
              rewrite: <input type=\"text\" name=\"rewrite\" value=\"%%3%%\" id=\"rewrite_input\" readonly=\"readonly\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
            </fieldset>
          </form>
          ",

                  "admin_editobsah_hlaska" => "uložen obsah: %%1%%, navic: %%2%%",

                  "admin_editobsah_error" => "chybý data!",

                  "admin_delobsah_hlaska" => "smazán obsah: %%1%%, navic: %%2%%",


                  "admin_obsah_sablony" => "
                  <a href=\"%%1%%\">přidej obsah</a><br />
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
                  <a href=\"%%1%%\" title=\"\">přidej šablonu</a><br />
                  <a href=\"%%2%%\" title=\"\">přidej element</a><br />
                  ",

                  "admin_obsah" => "administrace dynamickeho obsahu<br />
    <a href=\"%%1%%\" title=\"\">předkonfigurace obrazku</a><br />
    <a href=\"%%2%%\" title=\"\">test regulárních výrazů</a><br />
    %%3%%
    %%4%%<br />",

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

                  "admin_config" => "<br />
          <a href=\"%%1%%\" title=\"\">zavřít konfiguraci [X]</a><br />
          <form method=\"post\">
            <fieldset>
              limit:<br />
              <input type=\"radio\"%%2%% name=\"lim\" onclick=\"lim_1();\" /> dany limit<br />
              limit upload: <input type=\"text\" name=\"limit\" id=\"lim_p1\" value=\"%%3%%\" /> MB<br />
              <br />
              <input type=\"radio\"%%4%% name=\"lim\" onclick=\"lim_2();\" /> neomezeny (do limitu php def.nastaveni)<br />
              <br />

              mini:<br />
              <input type=\"radio\"%%6%% name=\"mini\" onclick=\"mini_1();\" /> dopocitat vysku<br />
              width mini: <input type=\"text\" name=\"w_mini\" id=\"mini1_p1\" value=\"%%7%%\" /> px<br />
              <br />
              <input type=\"radio\"%%8%% name=\"mini\" onclick=\"mini_2();\" /> dopocitat sirku<br />
              height mini: <input type=\"text\" name=\"h_mini\" id=\"mini2_p1\" value=\"%%9%%\" /> px<br />
              <br />
              <input type=\"radio\"%%10%% name=\"mini\" onclick=\"mini_3();\" /> nastaveno napevno<br />
              width mini: <input type=\"text\" name=\"w_mini\" id=\"mini3_p1\" value=\"%%7%%\" /> px<br />
              height mini: <input type=\"text\" name=\"h_mini\" id=\"mini3_p2\" value=\"%%9%%\" /> px<br />
              <br />
              <input type=\"radio\"%%11%% name=\"mini\" onclick=\"mini_4();\" /> vlasní miniatura<br />
              <br />
              <br />
              full:<br />
              <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_1();\" /> dopocitat vysku<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full1_p1\" value=\"%%13%%\" /> px<br />
              <br />
              <input type=\"radio\"%%14%% name=\"full\" onclick=\"full_2();\" /> dopocitat sirku<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full2_p1\" value=\"%%15%%\" /> px<br />
              <br />
              <input type=\"radio\"%%16%% name=\"full\" onclick=\"full_3();\" /> nastaveno napevno<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full3_p1\" value=\"%%13%%\" /> px<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full3_p2\" value=\"%%15%%\" /> px<br />
              <br />
              <input type=\"radio\"%%17%% name=\"full\" onclick=\"full_4();\" /> originální velikost<br />
              width full: <input type=\"text\" name=\"w_full\" value=\"0\" disabled=\"disabled\" /> px<br />
              height full: <input type=\"text\" name=\"h_full\" value=\"0\" disabled=\"disabled\" /> px<br />

              <input type=\"submit\" name=\"tlacitko\" value=\"uložit konfiguraci\" />
            </fieldset>
          </form>

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
          </script>
          ",

                  "admin_config_save" => "Uloženo...",

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

          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" />*<br />
              řazení podle data:<br />
              asc (A->Z, 0->9): <input type=\"radio\" name=\"razeni\" value=\"ASC\" /><br />
              desc (Z->A, 9->0): <input type=\"radio\" name=\"razeni\" value=\"DESC\" checked=\"checked\" /><br />
              počet novych položek na rychlo vypis: <input type=\"text\" name=\"nove\" value=\"1\" />*<br />
              počet novych rss položek: <input type=\"text\" name=\"nove_rss\" value=\"1\" />*<br />
              nazev: <input type=\"text\" name=\"nazev\" onkeyup=\"PrepisovaniTextu(this.value);\" />*<br />
              rewrite: <input type=\"text\" name=\"rewrite\" id=\"rewrite_input\" readonly=\"readonly\" /><br />
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

          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" value=\"%%2%%\" />*<br />
              řazení podle data:<br />
              asc (A->Z, 0->9): <input type=\"radio\" name=\"razeni\" value=\"ASC\" %%3%% /><br />
              desc (Z->A, 9->0): <input type=\"radio\" name=\"razeni\" value=\"DESC\" %%4%% /><br />
              počet novych položek na rychlo vypis: <input type=\"text\" name=\"nove\" value=\"%%5%%\" />*<br />
              počet novych rss položek: <input type=\"text\" name=\"nove_rss\" value=\"%%6%%\" />*<br />
              nazev: <input type=\"text\" name=\"nazev\" value=\"%%7%%\" onkeyup=\"PrepisovaniTextu(this.value);\" />*<br />
              rewrite: <input type=\"text\" name=\"rewrite\" value=\"%%8%%\" id=\"rewrite_input\" readonly=\"readonly\" /><br />
              popisek: <textarea name=\"popisek\">%%9%%</textarea><br />
              href_id: <input type=\"text\" name=\"href_id\" value=\"%%10%%\" /><br />
              href_class: <input type=\"text\" name=\"href_class\" value=\"%%11%%\" /><br />
              href_akce: <input type=\"text\" name=\"href_akce\" value=\"%%12%%\" /><br />
              zobrazit: <input type=\"checkbox\" name=\"zobrazit\"%%13%% /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
            </fieldset>
          </form>
              ",

                  "admin_editsab_hlaska" => "upravena šablona: %%1%%",

                  "admin_delsab_hlaska" => "smazána šablona: %%1%% a všechny elementy v ní!",


                  "admin_addeditelem_value_pic" => "
                  mini:<br />
                  <input type=\"radio\"%%5%% name=\"mini\" onclick=\"mini_1();\" /> dopocitat vysku<br />
                  width mini: <input type=\"text\" name=\"value[0]\" id=\"mini1_p1\" value=\"%%1%%\" /> px<br />
                  <br />
                  <input type=\"radio\"%%6%% name=\"mini\" onclick=\"mini_2();\" /> dopocitat sirku<br />
                  height mini: <input type=\"text\" name=\"value[1]\" id=\"mini2_p1\" value=\"%%2%%\" /> px<br />
                  <br />
                  <input type=\"radio\"%%7%% name=\"mini\" onclick=\"mini_3();\" /> nastaveno napevno<br />
                  width mini: <input type=\"text\" name=\"value[0]\" id=\"mini3_p1\" value=\"%%1%%\" /> px<br />
                  height mini: <input type=\"text\" name=\"value[1]\" id=\"mini3_p2\" value=\"%%2%%\" /> px<br />
                  <br />
                  <input type=\"radio\"%%8%% name=\"mini\" onclick=\"mini_4();\" /> vlasní miniatura<br />
                  <br />
                  <br />
                  full:<br />
                  <input type=\"radio\"%%9%% name=\"full\" onclick=\"full_1();\" /> dopocitat vysku<br />
                  width full: <input type=\"text\" name=\"value[2]\" id=\"full1_p1\" value=\"%%3%%\" /> px<br />
                  <br />
                  <input type=\"radio\"%%10%% name=\"full\" onclick=\"full_2();\" /> dopocitat sirku<br />
                  height full: <input type=\"text\" name=\"value[3]\" id=\"full2_p1\" value=\"%%4%%\" /> px<br />
                  <br />
                  <input type=\"radio\"%%11%% name=\"full\" onclick=\"full_3();\" /> nastaveno napevno<br />
                  width full: <input type=\"text\" name=\"value[2]\" id=\"full3_p1\" value=\"%%3%%\" /> px<br />
                  height full: <input type=\"text\" name=\"value[3]\" id=\"full3_p2\" value=\"%%4%%\" /> px<br />
                  <br />
                  <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_4();\" /> originální velikost<br />
                  width full: <input type=\"text\" name=\"value[2]\" value=\"0\" disabled=\"disabled\" /> px<br />
                  height full: <input type=\"text\" name=\"value[3]\" value=\"0\" disabled=\"disabled\" /> px<br />

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
                  </script>
                  ",

                  "admin_addelem_value" => "value: <input type=\"text\" name=\"value\" value= \"%%1%%\" /><br />",

                  "admin_addelem_vstupni_typ" => "vstupní typ: %%1%%<br />",

                  "admin_addelem_reg_exp" => "reg_exp: <input type=\"text\" name=\"reg_exp\" /> <a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />",

                  "admin_addelem_vystupni_format" => "vystupni_format: <input type=\"text\" name=\"vystupni_format\" value=\"%%1%%\" /> <a href=\"http://php.net/manual/en/function.date.php\">dokumentace</a><br />",

                  "admin_addelem_min_max_poc" => "
                  min_poc: <input type=\"text\" name=\"min_poc\" value=\"0\" /><br />
                  max_poc: <input type=\"text\" name=\"max_poc\" value=\"0\" /><br />
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
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%8%%\" /> >0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>",

                  "admin_addelem_hlaska" => "přidán element: %%1%%",


                  "admin_editelem_value" => "value: <input type=\"text\" name=\"value\" value= \"%%1%%\" /><br />",

                  "admin_editelem_vstupni_typ" => "vstupní typ: %%1%%<br />",

                  "admin_editelem_reg_exp" => "reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" /> <a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />",

                  "admin_editelem_vystupni_format" => "vystupni_format: <input type=\"text\" name=\"vystupni_format\" value=\"%%1%%\" /> <a href=\"http://php.net/manual/en/function.date.php\">dokumentace</a><br />",

                  "admin_editelem_min_max_poc" => "
                  min_poc: <input type=\"text\" name=\"min_poc\" value=\"%%1%%\" /><br />
                  max_poc: <input type=\"text\" name=\"max_poc\" value=\"%%2%%\" /><br />
                  ",

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
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%13%%\" /> >0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
            </fieldset>
          </form>",

                  "admin_editelem_hlaska" => "upraven element: %%1%%",

                  "admin_delelem_hlaska" => "smazán element: %%1%%",


                  "admin_vypis_sablona_adddel_link" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat nazev: \'%%3%%\' ?');\">smazat šablonu</a>
                                                        <a href=\"%%2%%\" title=\"\">přidej element do šablony</a>",

                  "admin_vypis_del_link" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat adresu: \'%%2%%\' ?');\">smazat sekci</a>",

                  "admin_vypis_sablona" => "
          šablona: %%1%%, adresa: %%2%%, nazev: %%3%%, rewrite: %%4%%, popis: %%5%%<br />
          <a href=\"%%6%%\" title=\"\">uprav šablonu</a>
          %%7%%
          <br />",

                  "admin_vypis_skupina_end" => "end šablony<br /><br />",

                  "admin_vypis_element" => "
nazev: %%1%%
<p>
value: %%2%%<br />
typ: %%3%%<br />
povinne: <input type=\"checkbox\"%%4%% disabled=\"disabled\" /><br />
vstupni format: %%5%%<br />
vystupni format: %%6%%<br />
poradi: %%7%%<br />
<a href=\"%%8%%\" title=\"\">uprav element</a>
%%9%%
</p>
<br />
          ",

                  "admin_vypis_obsah" => "
          %%1%%, %%3%%, %%4%%, %%5%%<br />
          <a href=\"%%6%%\">uprav obsah</a>
          <a href=\"%%7%%\" title=\"\" onclick=\"return confirm('Opravdu smazat nazev: \'%%2%%\' ?');\">smazat obsah</a>
          <br />
          ",

                  "set_povolit_pridani" => true,

                  "set_vypis_chybu" => false,

                  "set_znacka_povinne" => "*",

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
