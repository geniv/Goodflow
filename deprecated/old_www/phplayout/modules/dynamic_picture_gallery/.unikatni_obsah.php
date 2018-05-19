<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace dynamické obrázkové galerie",
                                              "title" => "administrace dynamické obrázkové galerie",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "dny_datum_1" => array("",
                                        "\p\o\\n\d\ě\l\í",
                                        "\ú\\t\e\\r\ý",
                                        "\s\\t\ř\e\d\a",
                                        "\č\\t\\v\\r\\t\e\k",
                                        "\p\á\\t\e\k",
                                        "\s\o\b\o\\t\a",
                                        "\\n\e\d\ě\l\e"),

                  "normal_vypis_nahled_galerie_datum_1" => "j.n.Y H:i:s %%1%%",

                  "normal_vypis_galerie_datum_1" => "j.n.Y H:i:s %%1%%",


                  "normal_galerie_prvni_1" => "prvni",

                  "normal_galerie_posledni_1" => "posledni",

                  "normal_galerie_ente_def_array_1" => array(1, 2, 5),

                  "normal_galerie_ente_def_1" => "aktivni",

                  "normal_galerie_ente_od_1" => 0,

                  "normal_galerie_ente_po_1" => 2,

                  "normal_galerie_ente_1" => "ente",

                  "normal_galerie_ente_off_posl_1" => true,

                  "normal_vypis_init_1" => "<script type=\"text/javascript\" src=\"%%1%%\"></script>
                                            naz: %%2%%, <img src=\"%%3%%\" alt=\"%%2%%\" />, pop: %%4%%
                                            <a href=\"%%5%%\">zpět na výběr</a>
                                            <div id=\"div_rozkliknute\"></div>",

                  "normal_vypis_galerie_1" => "
          <br />
          <a href=\"%%4%%\" onclick=\"%%5%%RozkliknutiPolozky(%%6%%, 'div_rozkliknute');return false;\" title=\"%%1%%\">mini:<img src=\"%%2%%\" alt=\"%%1%%\" />midd:<img src=\"%%3%%\" alt=\"%%1%%\" /></a>
          <p>%%1%%, %%7%%, %%8%%x, %%9%%/%%10%% >%%11%% %%12%% %%13%% %%14%%<</p>
          <br />
          ",

                  "normal_vypis_galerie_end_1" => "--konec galerie--",

                  "normal_vypis_galerie_null_1" => "žádná položka",



                  "normal_title_1" => " - %%1%%",



                  "set_skryvani_sekce_1" => true,  //true/false - schovat/nechat

                  "normal_vypis_prvni_1" => "prvni",

                  "normal_vypis_posledni_1" => "posledni",

                  "normal_vypis_ente_def_array_1" => array(1, 2, 5),

                  "normal_vypis_ente_def_1" => "aktivni",

                  "normal_vypis_ente_od_1" => 0,

                  "normal_vypis_ente_po_1" => 2,

                  "normal_vypis_ente_1" => "ente",

                  "normal_vypis_ente_off_posl_1" => true,


                  "normal_vypis_nahled_prvni_1" => "prvni",

                  "normal_vypis_nahled_posledni_1" => "posledni",

                  "normal_vypis_nahled_ente_def_array_1" => array(1, 2, 5),

                  "normal_vypis_nahled_ente_def_1" => "aktivni",

                  "normal_vypis_nahled_ente_od_1" => 0,

                  "normal_vypis_nahled_ente_po_1" => 2,

                  "normal_vypis_nahled_ente_1" => "ente",

                  "normal_vypis_nahled_ente_off_posl_1" => true,

                  "normal_vypis_sekce_init_1" => "<script type=\"text/javascript\" src=\"%%1%%\"></script>
                                                  <div id=\"div_rozkliknute\"></div>
                                                  ",

                  "normal_vypis_nahled_galerie_1" => "
          <br />
          <a href=\"#\" onclick=\"%%5%%RozkliknutiPolozky(%%6%%, 'div_rozkliknute');return false;\" title=\"%%1%%\">mini:<img src=\"%%2%%\" alt=\"%%1%%\" />midd:<img src=\"%%3%%\" alt=\"%%1%%\" /></a>
          <p>%%1%%, %%7%%, %%8%%x, %%9%%/%%10%% >%%11%% %%12%% %%13%% %%14%%<</p>
          <br />
          ",

                  "normal_vypis_sekce_galerie_1" => "
          naz: %%1%%,
          <img src=\"%%2%%\" alt=\"%%1%%\" />,
          pop: %%3%%<br />

          datum: %%4%%<br />

          <a href=\"%%5%%\" title=\"%%3%%\">vejdi do: %%1%%</a>
          >%%6%%, %%7%% %%8%% %%9%% %%10%%<
          počet fotek: %%11%%<br />
          náhledy: %%12%%<br />
          <br />
          ",

                  "normal_sekce_galerie_vybrana_1" => "vybrana",

                  "normal_vypis_sekce_end_1" => "--konec sekce--",


                  "ajax_rozkliknuti" => "
                  <a href=\"#\" onclick=\"RozkliknutiPolozky(0, 'div_rozkliknute');return false;\">zavřít okno</a><br />
                  střední rozliknurí, znuvu můžeš kliknout pro full fotku :D
                  popisek: %%1%%<br />
                  <a href=\"%%4%%\" title=\"%%1%%\"><img src=\"%%3%%\" /></a><br />
                  <hr />
                  %%5%%
                  <hr />
                  ",

                  "normal_vypis_random_1" => "
          <br />
          <script type=\"text/javascript\" src=\"%%12%%\"></script>
          náhodná fotka:<br />
          sekce: %%1%%<br />
          <a href=\"%%5%%\" onclick=\"%%6%%RozkliknutiPolozky(%%7%%, 'div_rozkliknute');return false;\" title=\"%%2%%\">mini:<img src=\"%%3%%\" alt=\"%%1%%\" />midd:<img src=\"%%4%%\" alt=\"%%2%%\" /></a>
          <p>%%2%%, %%8%%, %%9%%x, %%10%%/%%11%%</p>
          <br />
                  ",








                  "admin_vypis_adres" => "<a href=\"%%1%%\">%%2%%</a> %%3%%x<br />",

                  "admin_vypis_adres_null" => "doposaď žádná položka",


                  "admin_vyber_sekce_select_begin" => "<select name=\"skupina\">",

                  "admin_vyber_sekce_select" => "
            <option value=\"%%1%%\"%%2%%>%%3%%</option>
          ",

                  "admin_vyber_sekce_select_end" => "</select>",

                  "admin_vyber_sekce_select_null" => "žádný skupina",

                  "admin_seznam_skupin" => "<a href=\"%%1%%\">%%2%%</a> %%3%%x<br />",

                  "admin_seznam_skupin_null" => "doposaď žádná skupina",

                  "admin_obsah" => "administrace dynamické obrázkové galerie
    <br />
    <a href=\"%%1%%\" title=\"\">přidat skupinu</a><br />
    <a href=\"%%2%%\" title=\"\">přidat obrázek</a><br />
    <a href=\"%%3%%\" title=\"\">konfigurace galerie</a><br />
    <a href=\"%%4%%\" title=\"\">statistika galerie</a><br />
    <br />
    %%5%%
    %%6%%
    ",

                  "admin_config" => "<br />
          <a href=\"%%1%%\" title=\"\">zavřít konfiguraci [X]</a><br />
          <form method=\"post\">
            <fieldset>
              mini:<br />
              <input type=\"radio\"%%2%% name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
              width mini: <input type=\"text\" name=\"w_mini\" id=\"mini1_p1\" value=\"%%3%%\" /> px<br />
              <br />
              <input type=\"radio\"%%4%% name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
              height mini: <input type=\"text\" name=\"h_mini\" id=\"mini2_p1\" value=\"%%5%%\" /> px<br />
              <br />
              <input type=\"radio\"%%6%% name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
              width mini: <input type=\"text\" name=\"w_mini\" id=\"mini3_p1\" value=\"%%3%%\" /> px<br />
              height mini: <input type=\"text\" name=\"h_mini\" id=\"mini3_p2\" value=\"%%5%%\" /> px<br />
              <br />
              <input type=\"radio\"%%7%% name=\"mini\" onclick=\"mini_4();\">vlasní miniatura<br />
              <br />
              <br />
              middle:<br />
              <input type=\"radio\"%%8%% name=\"midd\" onclick=\"midd_1();\">dopocitat vysku<br />
              width midd: <input type=\"text\" name=\"w_midd\" id=\"midd1_p1\" value=\"%%9%%\" /> px<br />
              <br />
              <input type=\"radio\"%%10%% name=\"midd\" onclick=\"midd_2();\">dopocitat sirku<br />
              height midd: <input type=\"text\" name=\"h_midd\" id=\"midd2_p1\" value=\"%%11%%\" /> px<br />
              <br />
              <input type=\"radio\"%%12%% name=\"midd\" onclick=\"midd_3();\">nastaveno napevno<br />
              width midd: <input type=\"text\" name=\"w_midd\" id=\"midd3_p1\" value=\"%%9%%\" /> px<br />
              height midd: <input type=\"text\" name=\"h_midd\" id=\"midd3_p2\" value=\"%%11%%\" /> px<br />
              <br />
              <br />
              full:<br />
              <input type=\"radio\"%%13%% name=\"full\" onclick=\"full_1();\">dopocitat vysku<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full1_p1\" value=\"%%14%%\" /> px<br />
              <br />
              <input type=\"radio\"%%15%% name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full2_p1\" value=\"%%16%%\" /> px<br />
              <br />
              <input type=\"radio\"%%17%% name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full3_p1\" value=\"%%14%%\" /> px<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full3_p2\" value=\"%%16%%\" /> px<br />
              <br />
              <input type=\"radio\"%%18%% name=\"full\" onclick=\"full_4();\">originální velikost<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full4_p1\" value=\"0\" disabled=\"disabled\" /> px<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full4_p2\" value=\"0\" disabled=\"disabled\" /> px<br />
              <br />
              <br />
              limit:<br />
              <input type=\"radio\"%%19%% name=\"lim\" onclick=\"lim_1();\">dany limit<br />
              limit upload: <input type=\"text\" name=\"limit\" id=\"lim_p1\" value=\"%%20%%\" /> MB<br />
              <br />
              <input type=\"radio\"%%21%% name=\"lim\" onclick=\"lim_2();\">neomezeny (do limitu php def.nastaveni)<br />
              <br />
              <br />
              volba řazeni:<br />
              sekce<br />
              <input type=\"radio\" name=\"razeni1\" value=\"1\"%%22%% />datum ASC<br />
              <input type=\"radio\" name=\"razeni1\" value=\"2\"%%23%% />datum DESC<br />
              <input type=\"radio\" name=\"razeni1\" value=\"3\"%%24%% />pořadí ASC<br />
              <input type=\"radio\" name=\"razeni1\" value=\"4\"%%25%% />pořadí DESC<br />
              <br />
              obrázky<br />
              <input type=\"radio\" name=\"razeni2\" value=\"1\"%%26%% />datum ASC<br />
              <input type=\"radio\" name=\"razeni2\" value=\"2\"%%27%% />datum DESC<br />
              <input type=\"radio\" name=\"razeni2\" value=\"3\"%%28%% />pořadí ASC<br />
              <input type=\"radio\" name=\"razeni2\" value=\"4\"%%29%% />pořadí DESC<br />
              <br />
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

            function midd_1()
            {
              document.getElementById('midd1_p1').disabled = false;
              document.getElementById('midd2_p1').disabled = true;
              document.getElementById('midd3_p1').disabled = true;
              document.getElementById('midd3_p2').disabled = true;
            }

            function midd_2()
            {
              document.getElementById('midd1_p1').disabled = true;
              document.getElementById('midd2_p1').disabled = false;
              document.getElementById('midd3_p1').disabled = true;
              document.getElementById('midd3_p2').disabled = true;
            }

            function midd_3()
            {
              document.getElementById('midd1_p1').disabled = true;
              document.getElementById('midd2_p1').disabled = true;
              document.getElementById('midd3_p1').disabled = false;
              document.getElementById('midd3_p2').disabled = false;
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

            %%30%%
            %%31%%
            %%32%%
            %%33%%
          </script>
          ",

                  "admin_config_save" => "Uloženo...",

                  "admin_datum_tvar" => "j.n.Y H:i:s",


                  "admin_input_poradi" => "poradi: <input type=\"text\" name=\"poradi\" value=\"%%1%%\" /> >0 *<br />",

                  "admin_addgrup" => "
          <script type=\"text/javascript\">

          //aplikace AJAXu
          //
          // name: CreateXmlHttpObject
          // @param
          // @return
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

          //
          // name: AjaxStranka
          // @param
          // @return
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

          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /> *<br />
              počet náhledů skupiny: <input type=\"text\" name=\"nahledy\" value=\"1\" /><br />
              nazev: <input type=\"text\" name=\"nazev\" onkeyup=\"PrepisovaniTextu(this.value)\" /> * (fyzická adresa sekce)<br />
              rewrite: <input type=\"text\" id=\"rewrite_input\" name=\"rewrite\" readonly=\"readonly\" /><br />
              obrázek nadpisu: <input type=\"file\" name=\"obrazek\" /><br />
              popis: <input type=\"text\" name=\"popis\" /> (popisek sekce)<br />
              datum: <input type=\"text\" name=\"datum\" value=\"%%2%%\" /> * (jestli dokurvis datum = tvoje blbost)<br />
              defaultní: <input type=\"checkbox\" name=\"defaultni\" disabled=\"disabled\" /> (při hromadném výpisu ma byt prvni?)<br />
              %%3%%
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat skupinu\" />
            </fieldset>
          </form>
          ",

                  "admin_addgrup_hlaska" => "
                přídána: %%1%%, navic: %%2%%
              ",

                  "admin_editgrup" => "
              <script type=\"text/javascript\">

              //aplikace AJAXu
              //
              // name: CreateXmlHttpObject
              // @param
              // @return
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

              //
              // name: AjaxStranka
              // @param
              // @return
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

              <form method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%2%%\" /> *<br />
                  počet náhledů skupiny: <input type=\"text\" name=\"nahledy\" value=\"%%3%%\" /><br />
                  nazev: <input type=\"text\" name=\"nazev\" value=\"%%4%%\" onkeyup=\"PrepisovaniTextu(this.value)\" /> *<br />
                  rewrite: <input type=\"text\" id=\"rewrite_input\" name=\"rewrite\" readonly=\"readonly\" value=\"%%5%%\" /><br />
                  <img src=\"%%6%%\" /><br />
                  obrázek nadpisu: <input type=\"file\" name=\"obrazek\" /><br />
                  popis: <input type=\"text\" name=\"popis\" value=\"%%7%%\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"%%8%%\" /> * (jestli dokurvis datum = tvoje blbost)<br />
                  defaultni: <input type=\"checkbox\" name=\"defaultni\"%%9%% /><br />
                  poradi: <input type=\"text\" name=\"poradi\" value=\"%%10%%\" /> >0 *<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit skupinu\" />
                </fieldset>
              </form>
              ",

                  "admin_editgrup_hlaska" => "
                    upraven: %%1%%, navic: %%2%%
                  ",

                  "admin_delgrup_hlaska" => "
                  smazáno: %%1%% a vsechny pod obrazky<br />
                  navic: %%2%%
                ",

                  "admin_addpict" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
            %%25%%,
              skupina: %%1%%<br />
              !!!!první je nutné si naklikat nějaký počet fotek (pro multiupload) a pak přidávat fotky. Při přidávání se odkazy níž automaticky skryji!!!!<br />
              !!!!při vlastni miniatuře uploadovat pouze jeden obrázek!! jinak cela skupna hormadně uploadovanych fotek bude mít stejný mini obrázek!!!!<br />
              <a href=\"#\" onclick=\"PridejElement(); return false;\" id=\"add_href\">přidat element fotek</a>
              <a href=\"#\" onclick=\"OdeberElement(); return false;\" id=\"del_href\">odeber element fotek</a><br />

              <div id=\"div_file\"></div>

              datum: <input type=\"text\" name=\"datum\" value=\"%%2%%\" /><br />
              %%3%%
              <hr />
              <input type=\"radio\"%%10%% name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
              <input type=\"radio\"%%11%% name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
              <input type=\"radio\"%%12%% name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
              <input type=\"radio\"%%13%% name=\"mini\" onclick=\"mini_4();\">vlastní miniatura<br />
              w_mini: <input type=\"text\" name=\"w_mini\" id=\"mini_p1\" value=\"%%4%%\" /><br />
              h_mini: <input type=\"text\" name=\"h_mini\" id=\"mini_p2\" value=\"%%5%%\" /><br />
              mini: <input type=\"file\" name=\"mini_obrazek\" id=\"mini_p3\" /><br />
              <br />
              <input type=\"radio\"%%14%% name=\"midd\" onclick=\"midd_1();\">dopocitat vysku<br />
              <input type=\"radio\"%%15%% name=\"midd\" onclick=\"midd_2();\">dopocitat sirku<br />
              <input type=\"radio\"%%16%% name=\"midd\" onclick=\"midd_3();\">nastaveno napevno<br />
              w_midd: <input type=\"text\" name=\"w_midd\" id=\"midd_p1\" value=\"%%6%%\" /><br />
              h_midd: <input type=\"text\" name=\"h_midd\" id=\"midd_p2\" value=\"%%7%%\" /><br />
              <br />
              <input type=\"radio\"%%17%% name=\"full\" onclick=\"full_1();\">dopocitat vysku<br />
              <input type=\"radio\"%%18%% name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
              <input type=\"radio\"%%19%% name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
              <input type=\"radio\"%%20%% name=\"full\" onclick=\"full_4();\">originální velikost<br />
              w_full: <input type=\"text\" name=\"w_full\" id=\"full_p1\" value=\"%%8%%\" /><br />
              h_full: <input type=\"text\" name=\"h_full\" id=\"full_p2\" value=\"%%9%%\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat obrazek\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            var poc = 1;

            function VykresliElement()
            {
              var elem = '';
              poc = (poc <= 1 ? 1 : poc); //osetreni proti 0

              for (var i = 0; i < poc; i++)
              {
                //var elemjmeno = \"inputfile\"+i;
                //var jmeno = document.getElementById(elemjmeno).value;
                elem += \"obrázek (\"+(i + 1)+\"): <input type='file' name='obrazek[]' id='inputfile\"+i+\"' onchange=\\\"ZmenaObsahu(\"+i+\", this.value);\\\" /> * <span id=\'popfile\"+i+\"\'></span><br />popisek (\"+(i + 1)+\"): <input type=\\\"text\\\" name=\\\"popisek[]\\\" value=\\\"--- bez komentáře ---\\\" onfocus=\\\"this.value=(this.value == '--- bez komentáře ---' ? '' : this.value);\\\" onblur=\\\"this.value=(this.value == '' ? '--- bez komentáře ---' : this.value);\\\" /><br />\";
              }

              document.getElementById('div_file').innerHTML = elem;
              document.getElementById('nejaky nazev').innerHTML = \"ultra text\" + poc;
            }

            function ZmenaObsahu(id, jmeno)
            {
              document.getElementById('add_href').style.visibility = 'hidden';
              document.getElementById('del_href').style.visibility = 'hidden';
              document.getElementById(\"popfile\"+id).innerHTML = jmeno;
            }

            function PridejElement()
            {
              poc++;
              VykresliElement();
            }

            function OdeberElement()
            {
              poc--;
              VykresliElement();
            }

            function mini_1()
            {
              document.getElementById('mini_p1').disabled = false;
              document.getElementById('mini_p2').disabled = true;
              document.getElementById('mini_p3').disabled = true;
            }

            function mini_2()
            {
              document.getElementById('mini_p1').disabled = true;
              document.getElementById('mini_p2').disabled = false;
              document.getElementById('mini_p3').disabled = true;
            }

            function mini_3()
            {
              document.getElementById('mini_p1').disabled = false;
              document.getElementById('mini_p2').disabled = false;
              document.getElementById('mini_p3').disabled = true;
            }

            function mini_4()
            {
              document.getElementById('mini_p1').disabled = true;
              document.getElementById('mini_p2').disabled = true;
              document.getElementById('mini_p3').disabled = false;
            }

            function midd_1()
            {
              document.getElementById('midd_p1').disabled = false;
              document.getElementById('midd_p2').disabled = true;
            }

            function midd_2()
            {
              document.getElementById('midd_p1').disabled = true;
              document.getElementById('midd_p2').disabled = false;
            }

            function midd_3()
            {
              document.getElementById('midd_p1').disabled = false;
              document.getElementById('midd_p2').disabled = false;
            }

            function full_1()
            {
              document.getElementById('full_p1').disabled = false;
              document.getElementById('full_p2').disabled = true;
            }

            function full_2()
            {
              document.getElementById('full_p1').disabled = true;
              document.getElementById('full_p2').disabled = false;
            }

            function full_3()
            {
              document.getElementById('full_p1').disabled = false;
              document.getElementById('full_p2').disabled = false;
            }

            function full_4()
            {
              document.getElementById('full_p1').disabled = true;
              document.getElementById('full_p2').disabled = true;
            }

            VykresliElement();
            %%21%%
            %%22%%
            %%23%%
          </script>
          ",

                  "admin_addpict_hlaska" => "
                přídána fotka s popiskem: %%1%%<br />
                navic: %%2%%
              ",

                  "admin_editpict" => "
              <form method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                  skupina: %%1%%<br />
                  popisek: <input type=\"text\" name=\"popisek\" value=\"%%2%%\" /><br />
                  <a href=\"%%4%%\"><img src=\"%%3%%\" alt=\"%%2%%\" /></a><br />
                  obrázek: <input type=\"file\" name=\"obrazek\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"%%5%%\" /> *<br />
                  %%6%%
                  <hr />
                  <input type=\"radio\"%%13%% name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
                  <input type=\"radio\"%%14%% name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
                  <input type=\"radio\"%%15%% name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
                  <input type=\"radio\"%%16%% name=\"mini\" onclick=\"mini_4();\">vlastní miniatura<br />
                  w_mini: <input type=\"text\" name=\"w_mini\" id=\"mini_p1\" value=\"%%7%%\" /><br />
                  h_mini: <input type=\"text\" name=\"h_mini\" id=\"mini_p2\" value=\"%%8%%\" /><br />
                  mini: <input type=\"file\" name=\"mini_obrazek\" id=\"mini_p3\" /><br />
                  <br />
                  <input type=\"radio\"%%17%% name=\"midd\" onclick=\"midd_1();\">dopocitat vysku<br />
                  <input type=\"radio\"%%18%% name=\"midd\" onclick=\"midd_2();\">dopocitat sirku<br />
                  <input type=\"radio\"%%19%% name=\"midd\" onclick=\"midd_3();\">nastaveno napevno<br />
                  w_midd: <input type=\"text\" name=\"w_midd\" id=\"midd_p1\" value=\"%%9%%\" /><br />
                  h_midd: <input type=\"text\" name=\"h_midd\" id=\"midd_p2\" value=\"%%10%%\" /><br />
                  <br />
                  <input type=\"radio\"%%20%% name=\"full\" onclick=\"full_1();\">dopocitat vysku<br />
                  <input type=\"radio\"%%21%% name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
                  <input type=\"radio\"%%22%% name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
                  <input type=\"radio\"%%23%% name=\"full\" onclick=\"full_4();\">originální velikost<br />
                  w_full: <input type=\"text\" name=\"w_full\" id=\"full_p1\" value=\"%%11%%\" /><br />
                  h_full: <input type=\"text\" name=\"h_full\" id=\"full_p2\" value=\"%%12%%\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit obrázek\" />
                </fieldset>
              </form>

              <script type=\"text/javascript\">
                function mini_1()
                {
                  document.getElementById('mini_p1').disabled = false;
                  document.getElementById('mini_p2').disabled = true;
                  document.getElementById('mini_p3').disabled = true;
                }

                function mini_2()
                {
                  document.getElementById('mini_p1').disabled = true;
                  document.getElementById('mini_p2').disabled = false;
                  document.getElementById('mini_p3').disabled = true;
                }

                function mini_3()
                {
                  document.getElementById('mini_p1').disabled = false;
                  document.getElementById('mini_p2').disabled = false;
                  document.getElementById('mini_p3').disabled = true;
                }

                function mini_4()
                {
                  document.getElementById('mini_p1').disabled = true;
                  document.getElementById('mini_p2').disabled = true;
                  document.getElementById('mini_p3').disabled = false;
                }

                function midd_1()
                {
                  document.getElementById('midd_p1').disabled = false;
                  document.getElementById('midd_p2').disabled = true;
                }

                function midd_2()
                {
                  document.getElementById('midd_p1').disabled = true;
                  document.getElementById('midd_p2').disabled = false;
                }

                function midd_3()
                {
                  document.getElementById('midd_p1').disabled = false;
                  document.getElementById('midd_p2').disabled = false;
                }

                function full_1()
                {
                  document.getElementById('full_p1').disabled = false;
                  document.getElementById('full_p2').disabled = true;
                }

                function full_2()
                {
                  document.getElementById('full_p1').disabled = true;
                  document.getElementById('full_p2').disabled = false;
                }

                function full_3()
                {
                  document.getElementById('full_p1').disabled = false;
                  document.getElementById('full_p2').disabled = false;
                }

                function full_4()
                {
                  document.getElementById('full_p1').disabled = true;
                  document.getElementById('full_p2').disabled = true;
                }

                %%24%%
                %%25%%
                %%26%%
              </script>
              ",

                  "admin_editpict_hlaska" => "
                    upravena fotka s popiskem: %%1%%<br />
                    navic: %%2%%
                  ",

                  "admin_delpict_hlaska" => "
                  smazána fotka s popiskem: %%1%%<br />
                  navic odmazano: %%2%%
                ",

                  "admin_stat" => "satistika galerie...<br />
                  celkový počet mini: %%1%%<br />
                  celková velikost mini: %%2%%<br />

                  celkový počet midd: %%3%%<br />
                  celková velikost midd: %%4%%<br />

                  celkový počet full: %%5%%<br />
                  celková velikost full: %%6%%<br />
                  <br />
                  celková velikost složek: %%7%%<br />
                  celkový počet souborů: %%8%%<br />
                  <br />
                  počet galerii: <strong>%%9%%</strong>
                  <hr />
                  %%10%%
                  ",

                  "admin_stat_galerie" => "
                  galerie: %%1%%<br />
                  popis: %%2%%<br />
                  datum: %%3%%<br />
                  počet obrázků: <strong>%%4%%</strong><br />
                  velikost mini: %%5%%<br />
                  velikost midd: %%6%%<br />
                  velikost full: %%7%%<br />
                  celková velikost sekce galerie: %%8%%<br />
                  celkový počet zobrazení: %%9%%x<br />
                  <br />
                  ",

                  "admin_vypis_skupina" => "<br />
-------------------------------------------------------------------------------
          <br />
          adresa: %%1%%<br />
          počet náhledů: %%2%%<br />
          nazev: %%3%%<br />
          rewrite: %%4%%<br />
          popis: %%5%%<br />
          datum: %%6%%<br />
          defaultni: <input type=\"checkbox\" name=\"defaultni\"%%7%% disabled=\"disabled\" /><br />
          poradi: %%8%%<br />
          <a href=\"%%9%%\" title=\"\">přidat obrázek do této skupiny</a>
          <a href=\"%%10%%\" title=\"\">upravit skupinu</a>
          <a href=\"%%11%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%3%%\' ?');\">smazat skupinu</a><br />
          ",


                  "admin_vypis_skupina_end" => "<br />",

                  "admin_vypis_obsah" => "<br />
*******************************************************************************
                <br />
                popisek: %%1%%<br />
                datum: %%4%%<br />
                zobrazeno: %%5%%x<br />
                poradi: %%6%%<br />
                <a href=\"%%2%%\" title=\"%%1%%\"><img src=\"%%3%%\" alt=\"%%1%%\" /></a><br />
                <a href=\"%%7%%\" title=\"\">upravit obrazek</a>
                <a href=\"%%8%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%1%%\' ?');\">smazat obrázek</a><br />
                ",

                  "set_get_sekce" => "sekce",

                  "set_vypis_varovani" => true,

                  "set_pathpicture" => "picture",

                  "set_minidir" => "mini",

                  "set_midddir" => "midd",

                  "set_fulldir" => "full",

                  "set_nadpisdir" => "nadpis",

                  "set_conffile" => ".config_file",

                  "ajaxscript" => "var urlcesta = \"%%1%%%%2%%/\";

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
function PoctadloZobrazeni(id)
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
    return;
  }

  var send = \"action=pocitadlo&id=\"+id+\"&kid=\"+Math.random();

  //xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, \"pokus\");};  //po dokonceni se zavola

  xmlHttp.open(\"POST\", urlcesta + \"ajax.php\", true);
  xmlHttp.setRequestHeader(\"Content-Type\", \"application/x-www-form-urlencoded\");
  xmlHttp.send(send);
}

/**
 * Vykonavaci fukce, posila instrukce na server
 * @param text vstupni text
 */
function RozkliknutiPolozky(id, element)
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert (\"Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.\");
    return;
  }

  var send = \"action=rozkliknuti&id=\"+id+\"&kid=\"+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, element);};  //po dokonceni se zavola

  xmlHttp.open(\"POST\", urlcesta + \"ajax.php\", true);
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
        }
      break;
    }
  }
}",

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
                  );

  return $result;
?>
