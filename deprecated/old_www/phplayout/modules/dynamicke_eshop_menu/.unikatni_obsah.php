<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace dynamickeho eshop menu",
                                              "title" => "administrace dynamickeho eshop menu",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_obsah_1" => "
          <a href=\"%%1%%\" title=\"%%3%%\">%%6%%%%3%%%%7%%</a> - (%%2%%, %%5%%) %%8%%<br />
          %%9%%
          ",

                  "normal_vypis_null_1" => "žádná položka",

                  "admin_obsah" => "administrace dynamické obrázkové galerie bez sekcí
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
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /><br />
              popisek: <input type=\"text\" name=\"popisek\" /><br />
              obrázek: <input type=\"file\" name=\"obrazek\" /><br />
              datum: <input type=\"text\" name=\"datum\" value=\"%%1%%\" /><br />
              %%2%%
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat obrazek\" />
            </fieldset>
          </form>
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
                  %%5%%
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit obrázek\" />
                </fieldset>
              </form>
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
            poradi: %%5%%
          </p>
          <a href=\"%%6%%\" title=\"%%4%%\"><img src=\"%%7%%\" alt=\"%%4%%\" /></a><br />
          <a href=\"%%8%%\" title=\"\">upravit obrazek</a>
          <a href=\"%%9%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%4%%\' ?');\">smazat obsah</a> <br />
          ",

                  "set_nazevblok" => "buy",

                  "set_blokurl" => array ("show",
                                          "add",
                                          "krok"),

                  "set_oddtit" => "/",

                  "set_ozn_hlavni_l" => "[> ",

                  "set_ozn_hlavni_r" => " <]",

                  "set_ozn_vetev_l" => "[ ",

                  "set_ozn_vetev_r" => " ]",

                  "set_ozn_class_hlavni" => "_hlavni",

                  "set_ozn_class_vetev" => "_vetev",

                  "set_odd_full" => "-",

                  "set_odd_htac" => "%%%%",

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
                  );

  return $result;
?>
