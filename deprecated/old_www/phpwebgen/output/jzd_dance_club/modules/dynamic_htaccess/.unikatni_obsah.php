<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamický htaccess",
                                              "title" => "Dynamický htaccess",
                                              "id" => "",
                                              "class" => "dynamicky_htaccess_menu",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_generovani_htaccess" => "#%%1%%\n%%2%%\n\n",

                  "admin_generovani_htaccess_complet" => "kompilováno",

                  "admin_htaccess_exists" => "htaccess existuje <a href=\"%%1%%\" title=\"\">náhled</a>",

                  "admin_htaccess_not_exists" => "htaccess neexistuje",

                  "admin_obsah" => "administrace dynamickeho htaccess-u
    <br />
    <a href=\"%%1%%\" title=\"\">přidat položku</a><br />
    <a href=\"%%2%%\" title=\"\" onclick=\"return confirm('Opravdu vygenerovat soubor ?');\">vygenerovat htaccess</a>
    %%3%%
    <br />
    <br />
    %%4%%
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
              <br />
              full:<br />
              <input type=\"radio\"%%7%% name=\"full\" onclick=\"full_1();\">dopocitat vysku<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full1_p1\" value=\"%%8%%\" /> px<br />
              <br />
              <input type=\"radio\"%%9%% name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full2_p1\" value=\"%%10%%\" /> px<br />
              <br />
              <input type=\"radio\"%%11%% name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full3_p1\" value=\"%%8%%\" /> px<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full3_p2\" value=\"%%10%%\" /> px<br />
              <br />
              <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_4();\">originální velikost<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full4_p1\" value=\"0\" disabled /> px<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full4_p2\" value=\"0\" disabled /> px<br />
              <br />
              <br />
              limit:<br />
              <input type=\"radio\"%%13%% name=\"lim\" onclick=\"lim_1();\">dany limit<br />
              limit upload: <input type=\"text\" name=\"limit\" id=\"lim_p1\" value=\"%%14%%\" /> MB<br />
              <br />
              <input type=\"radio\"%%15%% name=\"lim\" onclick=\"lim_2();\">neomezeny (do limitu php def.nastaveni)<br />
              <br />
              <br />
              volba řazeni:<br />
              <input type=\"radio\" name=\"razeni\" value=\"1\"%%16%% />datum ASC<br />
              <input type=\"radio\" name=\"razeni\" value=\"2\"%%17%% />datum DESC<br />
              <input type=\"radio\" name=\"razeni\" value=\"3\"%%18%% />pořadí ASC<br />
              <input type=\"radio\" name=\"razeni\" value=\"4\"%%19%% />pořadí DESC<br />
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

            %%20%%
            %%21%%
            %%22%%
          </script>
          ",

                  "admin_config_save" => "Uloženo...",

                  "admin_datum_tvar" => "j.n.Y H:i:s",

                  "admin_input_poradi" => "poradi: <input type=\"text\" name=\"poradi\" value=\"%%1%%\" /><br />",

                  "admin_add" => "
          <form method=\"post\">
            <fieldset>
              rewrite: <input type=\"text\" name=\"rewrite\" /><br />
              poznamka: <input type=\"text\" name=\"poznamka\" />(max 300 zn.)<br />
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%1%%\" />>0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat položku\" />
            </fieldset>
          </form>
          ",

                  "admin_add_hlaska" => "
                přídán: %%1%% do pořadí: %%2%%
              ",

                  "admin_edit" => "
              <form method=\"post\">
                <fieldset>
                  rewrite: <input type=\"text\" name=\"rewrite\" value=\"%%1%%\" /><br />
                  poznamka: <input type=\"text\" name=\"poznamka\" value=\"%%2%%\" />(max 300 zn.)<br />
                  poradi: <input type=\"text\" name=\"poradi\" value=\"%%3%%\" />>0<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_edit_hlaska" => "
                    upraven: %%1%%
                  ",

                  "admin_del_hlaska" => "
                  smazáno: %%1%%
                ",

                  "admin_show" => "<br />
          <a href=\"%%1%%\" title=\"\">zavřít náhled [X]</a><br />
          <pre>%%2%%</pre>",

                  "admin_vypis_obsah" => "poradi: '%%1%%' (%%2%%) <strong>%%3%% #%%4%%</strong>
          <a href=\"%%5%%\" title=\"\">upravit položku</a>
          <a href=\"%%6%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%3%%\' ?');\">smazat položku</a> <br />
          ",

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
