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

                  "admin_vypis_adres" => "<a href=\"%%1%%\">%%2%%, %%3%%x</a><br />",

                  "admin_vypis_adres_null" => "doposaď žádná položka",

                  "admin_obsah" => "administrace dynamickeho random obrazku
    <br />
    <a href=\"%%1%%\" title=\"\">přidat obrázek</a><br />
    <a href=\"%%2%%\" title=\"\">konfigurace galerie</a><br />
    <br />
    %%3%%<br />
    %%4%%
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

              mini:<br />
              <input type=\"radio\"%%6%% name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
              width mini: <input type=\"text\" name=\"w_mini\" id=\"mini1_p1\" value=\"%%7%%\" /> px<br />
              <br />
              <input type=\"radio\"%%8%% name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
              height mini: <input type=\"text\" name=\"h_mini\" id=\"mini2_p1\" value=\"%%9%%\" /> px<br />
              <br />
              <input type=\"radio\"%%10%% name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
              width mini: <input type=\"text\" name=\"w_mini\" id=\"mini3_p1\" value=\"%%7%%\" /> px<br />
              height mini: <input type=\"text\" name=\"h_mini\" id=\"mini3_p2\" value=\"%%9%%\" /> px<br />
              <br />
              <input type=\"radio\"%%11%% name=\"mini\" onclick=\"mini_4();\">vlasní miniatura<br />
              <br />
              <br />
              full:<br />
              <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_1();\">dopocitat vysku<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full1_p1\" value=\"%%13%%\" /> px<br />
              <br />
              <input type=\"radio\"%%14%% name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full2_p1\" value=\"%%15%%\" /> px<br />
              <br />
              <input type=\"radio\"%%16%% name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
              width full: <input type=\"text\" name=\"w_full\" id=\"full3_p1\" value=\"%%13%%\" /> px<br />
              height full: <input type=\"text\" name=\"h_full\" id=\"full3_p2\" value=\"%%15%%\" /> px<br />
              <br />
              <input type=\"radio\"%%17%% name=\"full\" onclick=\"full_4();\">originální velikost<br />
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

                  "admin_datum_tvar" => "j.n.Y H:i:s",

                  "admin_add" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />*<br />
              popisek: <input type=\"text\" name=\"popisek\" /><br />
              obrázek: <input type=\"file\" name=\"obrazek\" />*<br />
              datum: <input type=\"text\" name=\"datum\" value=\"%%2%%\" />*<br />
              <input type=\"radio\"%%7%% name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
              <input type=\"radio\"%%8%% name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
              <input type=\"radio\"%%9%% name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
              <input type=\"radio\"%%10%% name=\"mini\" onclick=\"mini_4();\">vlastní miniatura<br />
              w_mini: <input type=\"text\" name=\"w_mini\" id=\"mini_p1\" value=\"%%3%%\" /><br />
              h_mini: <input type=\"text\" name=\"h_mini\" id=\"mini_p2\" value=\"%%4%%\" /><br />
              mini: <input type=\"file\" name=\"mini_obrazek\" id=\"mini_p3\" /><br />

              <input type=\"radio\"%%11%% name=\"full\" onclick=\"full_1();\">dopocitat vysku<br />
              <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
              <input type=\"radio\"%%13%% name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
              <input type=\"radio\"%%14%% name=\"full\" onclick=\"full_4();\">originální velikost<br />
              w_full: <input type=\"text\" name=\"w_full\" id=\"full_p1\" value=\"%%5%%\" /><br />
              h_full: <input type=\"text\" name=\"h_full\" id=\"full_p2\" value=\"%%6%%\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat obrazek\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            document.getElementById('mini_p1').disabled = true;
            document.getElementById('mini_p2').disabled = true;
            document.getElementById('full_p1').disabled = true;
            document.getElementById('full_p2').disabled = true;

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
              document.getElementById('mini_p3').disabled = true;
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

            %%15%%
            %%16%%
          </script>
          ",

                  "admin_add_hlaska" => "
                přídána fotka s popiskem: %%1%%<br />
                navic: %%2%%
              ",

                  "admin_edit" => "
              <form method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />*<br />
                  popisek: <input type=\"text\" name=\"popisek\" value=\"%%2%%\" /><br />
                  <a href=\"%%4%%\"><img src=\"%%3%%\" alt=\"%%2%%\" /></a><br />
                  obrázek: <input type=\"file\" name=\"obrazek\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"%%5%%\" />*<br />
                  <input type=\"radio\"%%10%% name=\"mini\" onclick=\"mini_1();\">dopocitat vysku<br />
                  <input type=\"radio\"%%11%% name=\"mini\" onclick=\"mini_2();\">dopocitat sirku<br />
                  <input type=\"radio\"%%12%% name=\"mini\" onclick=\"mini_3();\">nastaveno napevno<br />
                  <input type=\"radio\"%%13%% name=\"mini\" onclick=\"mini_4();\">vlastní miniatura (při upravě full obrázku a této volbě se musi zároveň nahrát i miniatura!)<br />
                  w_mini: <input type=\"text\" name=\"w_mini\" id=\"mini_p1\" value=\"%%6%%\" /><br />
                  h_mini: <input type=\"text\" name=\"h_mini\" id=\"mini_p2\" value=\"%%7%%\" /><br />
                  mini: <input type=\"file\" name=\"mini_obrazek\" id=\"mini_p3\" /><br />

                  <input type=\"radio\"%%14%% name=\"full\" onclick=\"full_1();\">dopocitat vysku<br />
                  <input type=\"radio\"%%15%% name=\"full\" onclick=\"full_2();\">dopocitat sirku<br />
                  <input type=\"radio\"%%16%% name=\"full\" onclick=\"full_3();\">nastaveno napevno<br />
                  <input type=\"radio\"%%17%% name=\"full\" onclick=\"full_4();\">originální velikost<br />
                  w_full: <input type=\"text\" name=\"w_full\" id=\"full_p1\" value=\"%%8%%\" /><br />
                  h_full: <input type=\"text\" name=\"h_full\" id=\"full_p2\" value=\"%%9%%\" /><br />
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

                %%18%%
                %%19%%
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
