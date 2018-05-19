<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace dynamického random obrázku",
                                              "title" => "administrace dynamického random obrázku",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_obsah_1" => "
          <br />
          <a href=\"%%1%%\" title=\"%%3%%\">
            <img src=\"%%2%%\" alt=\"%%3%%\" />
          </a>
          <p>%%3%%</p>
          <br />
          ",

                  "normal_vypis_null_1" => "žádná položka",

                  "admin_obsah" => "administrace dynamickeho random obrazku
    <br />
    <a href=\"%%1%%\" title=\"\">přidat obrázek</a><br />
    <a href=\"%%2%%\" title=\"\">konfigurace galerie</a><br />
    <br />
    %%3%%
    ",

                  "admin_config" => "<br />
          <a href=\"%%1%%\" title=\"\">zavřít konfiguraci [X]</a><br />
          <form method=\"post\">
            <fieldset>
              limit:<br />
              <input type=\"radio\"%%2%% name=\"lim\" onclick=\"lim_1();\">dany limit<br />
              limit upload: <input type=\"text\" name=\"limit\" id=\"lim_p1\" value=\"%%3%%\" /> MB<br />
              <br />
              <input type=\"radio\"%%4%% name=\"lim\" onclick=\"lim_2();\">neomezeny (do limitu php def.nastaveni)<br />
              <br />
              <input type=\"submit\" name=\"tlacitko\" value=\"uložit konfiguraci\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            function lim_1()
            {
              document.getElementById('lim_p1').disabled = false;
            }

            function lim_2()
            {
              document.getElementById('lim_p1').disabled = true;
            }

            %%5%%
          </script>
          ",

                  "admin_config_save" => "Uloženo...",

                  "admin_datum_tvar" => "j.n.Y H:i:s",

                  "admin_add" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /><br />
              popisek: <input type=\"text\" name=\"popisek\" /><br />
              obrázek: <input type=\"file\" name=\"obrazek\" /><br />
              datum: <input type=\"text\" name=\"datum\" value=\"%%1%%\" /><br />
              <input type=\"radio\"%%2%% name=\"mini\" onclick=\"mini_1();\" checked=\"checked\">dopocitat vysku<br />
              <input type=\"radio\"%%4%% name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
              <input type=\"radio\"%%6%% name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
              w_mini: <input type=\"text\" name=\"w_mini\" id=\"mini_p1\" value=\"0\" /><br />
              h_mini: <input type=\"text\" name=\"h_mini\" id=\"mini_p2\" value=\"0\" /><br />
              <input type=\"radio\"%%7%% name=\"full\" onclick=\"full_1();\" checked=\"checked\">dopocitat vysku<br />
              <input type=\"radio\"%%9%% name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
              <input type=\"radio\"%%11%% name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
              <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_4();\">originální velikost<br />
              w_full: <input type=\"text\" name=\"w_full\" id=\"full_p1\" value=\"0\" /><br />
              h_full: <input type=\"text\" name=\"h_full\" id=\"full_p2\" value=\"0\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat obrazek\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            document.getElementById('mini_p1').disabled = true;
            document.getElementById('mini_p2').disabled = true;
            document.getElementById('full_p1').disabled = true;
            document.getElementById('full_p2').disabled = true;
            mini_1();
            full_1();

            function mini_1()
            {
              document.getElementById('mini_p1').disabled = false;
              document.getElementById('mini_p2').disabled = true;
            }

            function mini_2()
            {
              document.getElementById('mini_p1').disabled = true;
              document.getElementById('mini_p2').disabled = false;
            }

            function mini_3()
            {
              document.getElementById('mini_p1').disabled = false;
              document.getElementById('mini_p2').disabled = false;
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
          </script>
          ",

                  "admin_add_hlaska" => "
                přídána fotka s popiskem: %%1%%<br />
                navic: %%2%%
              ",

                  "admin_edit" => "
              <form method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /><br />
                  popisek: <input type=\"text\" name=\"popisek\" value=\"%%2%%\" /><br />
                  <img src=\"%%3%%\" alt=\"%%2%%\" /><br />
                  obrázek: <input type=\"file\" name=\"obrazek\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"%%4%%\" /><br />
                  <input type=\"radio\"%%9%% name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
                  <input type=\"radio\"%%10%% name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
                  <input type=\"radio\"%%11%% name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
                  w_mini: <input type=\"text\" name=\"w_mini\" id=\"mini_p1\" value=\"%%5%%\" /><br />
                  h_mini: <input type=\"text\" name=\"h_mini\" id=\"mini_p2\" value=\"%%6%%\" /><br />
                  <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_1();\">dopocitat vysku<br />
                  <input type=\"radio\"%%13%% name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
                  <input type=\"radio\"%%13%% name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
                  <input type=\"radio\"%%15%% name=\"full\" onclick=\"full_4();\">originální velikost<br />
                  w_full: <input type=\"text\" name=\"w_full\" id=\"full_p1\" value=\"%%7%%\" /><br />
                  h_full: <input type=\"text\" name=\"h_full\" id=\"full_p2\" value=\"%%8%%\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit obrázek\" />
                </fieldset>
              </form>

              <script type=\"text/javascript\">
                function mini_1()
                {
                  document.getElementById('mini_p1').disabled = false;
                  document.getElementById('mini_p2').disabled = true;
                }

                function mini_2()
                {
                  document.getElementById('mini_p1').disabled = true;
                  document.getElementById('mini_p2').disabled = false;
                }

                function mini_3()
                {
                  document.getElementById('mini_p1').disabled = false;
                  document.getElementById('mini_p2').disabled = false;
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

                %%16%%
                %%17%%
              </script>
              ",

                  "admin_edit_hlaska" => "
                    upravena fotka s popiskem: %%1%%<br />
                    navic: %%2%%
                  ",

                  "admin_del_hlaska" => "
                  smazána fotka s popiskem: %%1%%<br />
                  navic odmazano: %%2%%
                ",

                  "admin_vypis_obsah" => "(%%1%%) %%2%%
          <p>
            adresa: %%3%%<br />
            %%4%%<br />
          </p>
          <a href=\"%%5%%\" title=\"%%4%%\"><img src=\"%%6%%\" alt=\"%%4%%\" /></a><br />
          <a href=\"%%7%%\" title=\"\">upravit obrazek</a>
          <a href=\"%%8%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%4%%\' ?');\">smazat obsah</a>
          <br />
          <br />
          ",

                  "set_pathpicture" => "picture",

                  "set_minidir" => "mini",

                  "set_fulldir" => "full",

                  "set_conffile" => ".config_file",

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
