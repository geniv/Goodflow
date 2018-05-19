<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Captcha kody",
                                              "title" => "Captcha kody",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_captcha_kod_1" => "
                    %%1%%<br />
                    <img src=\"%%3%%\" /><br />
                    odpověď: <input type=\"text\" name=\"captcha_%%2%%\" /><br />
                  ",

                  "admin_vypis_typu_select_begin" => "<select name=\"typ_kodu\">",

                  "admin_vypis_typu_select" => "
                  <option value=\"%%1%%\"%%2%%>%%3%%</option>
                  ",

                  "admin_vypis_typu_select_end" => "</select>",


                  "admin_vypis_fontu_select_begin" => "<select name=\"font\">",

                  "admin_vypis_fontu_select" => "
            <option value=\"%%1%%\"%%2%%>font: %%3%% (%%4%%), %%1%%</option>
          ",

                  "admin_vypis_fontu_select_end" => "</select>",

                  "admin_vypis_fontu_select_null" => "<strong>žádný font</strong>",


                  "admin_obsah" => "administrace captcha kodu
    <br />
    <a href=\"%%1%%\" title=\"\">přidat font</a><br />
    <a href=\"%%2%%\" title=\"\">přidat položku</a><br />
    %%3%%
    ",

                  "admin_add" => "
          <form method=\"post\">
            <fieldset>
              typ: %%1%%<br />
              otázka: <input type=\"text\" name=\"otazka\" />*<br />
              počet písmen: <input type=\"text\" name=\"pocet\" value=\"6\" />*<br />
              počátek X: <input type=\"text\" name=\"x\" value=\"20\" /> px*<br />
              počátek Y: <input type=\"text\" name=\"y\" value=\"50\" /> px*<br />
              width: <input type=\"text\" name=\"width\" value=\"200\" /> px*<br />
              height: <input type=\"text\" name=\"height\" value=\"100\" /> px*<br />
              font: %%2%%<br />
              roztec: <input type=\"text\" name=\"roztec\" value=\"20\" /> px* (rozeč písmen)<br />
              <br />
              font velikost pevná: <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_1();\" checked=\"checked\" /> (všechna písmena stejně veliká)<br />
              pevna size: <input type=\"text\" name=\"size[0]\" value=\"14\" id=\"font_size_p1\" /> px*<br />
              font rozsah velikosti: <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_2();\" /> (každé písmeno jiné v daném rozsahu)<br />
              min size: <input type=\"text\" name=\"size[0]\" value=\"12\" id=\"font_size_p2\" /> px*<br />
              max size: <input type=\"text\" name=\"size[1]\" value=\"16\" id=\"font_size_p3\" /> px*<br />
              <br />
              font color pevná: <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_1();\" checked=\"checked\" /> (všechna písmena stejně barevná)<br />
              pevná barva textu: #<input type=\"text\" name=\"font_color[0]\" value=\"fff\" id=\"font_color_p1\" />*<br />
              font color rozsah: <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_2();\" /> (každé písmeno jiné v daném rozsahu barev)<br />
              min barva textu: #<input type=\"text\" name=\"font_color[0]\" value=\"eee\" id=\"font_color_p2\" />*<br />
              max barva textu: #<input type=\"text\" name=\"font_color[1]\" value=\"fff\" id=\"font_color_p3\" />*<br />
              <br />
              barva pozadí: #<input type=\"text\" name=\"pozadi\" value=\"000\" />*<br />
              <br />
              pevné natočení písmen: <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_1();\" checked=\"checked\" /> (všechna písmena stejně natočená)<br />
              pevné natočení: <input type=\"text\" name=\"font_rotace[0]\" value=\"0\" id=\"font_rotace_p1\" />*<br />
              rozsah natočení písmen: <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_2();\" /> (každé písmeno jinak natočené v daném rozsahu)<br />
              min natočení písmena: <input type=\"text\" name=\"font_rotace[0]\" value=\"0\" id=\"font_rotace_p2\" />*<br />
              max natočení písmena: <input type=\"text\" name=\"font_rotace[1]\" value=\"90\" id=\"font_rotace_p3\" />*<br />
              <hr />
              mřížka: <input type=\"checkbox\" name=\"checkbox_mrizka\" onclick=\"mrizka(this.checked);\" /><br />
              tvar mřížky:<br />
              + <input type=\"radio\" name=\"radio_mrizka\" value=\"1\" id=\"mrizka_p1\" /> (klasická)<br />
              # <input type=\"radio\" name=\"radio_mrizka\" value=\"2\" id=\"mrizka_p2\" /> (vodorovné rovně, slislé jsou nakloněné)<br />
              x <input type=\"radio\" name=\"radio_mrizka\" value=\"3\" id=\"mrizka_p3\" /> (křížení do X)<br />
              - <input type=\"radio\" name=\"radio_mrizka\" value=\"4\" id=\"mrizka_p4\" /> (jen vodorovné)<br />
              | <input type=\"radio\" name=\"radio_mrizka\" value=\"5\" id=\"mrizka_p5\" /> (jen svislé)<br />
              \ <input type=\"radio\" name=\"radio_mrizka\" value=\"6\" id=\"mrizka_p6\" /> (jen svislé do leva)<br />
              / <input type=\"radio\" name=\"radio_mrizka\" value=\"7\" id=\"mrizka_p7\" /> (jen svislé do prava)<br />
              rozestup mrizek X: <input type=\"text\" name=\"mrizka[0]\" value=\"5\" id=\"mrizka_p8\" /> px*<br />
              rozestup mrizek Y: <input type=\"text\" name=\"mrizka[1]\" value=\"5\" id=\"mrizka_p9\" /> px*<br />
              <br />
              náhodné body: <input type=\"checkbox\" name=\"checkbox_rand_dot\" onclick=\"rand(this.checked);\" /><br />
              náhodné čáry: <input type=\"checkbox\" name=\"checkbox_rand_line\" onclick=\"rand(this.checked);\" /><br />
              náhodné čtverce: <input type=\"checkbox\" name=\"checkbox_rand_restangle\" onclick=\"rand(this.checked);\" /><br />
              náhodné polokruží: <input type=\"checkbox\" name=\"checkbox_rand_arc\" onclick=\"rand(this.checked);\" /><br />
              náhodné elipsy: <input type=\"checkbox\" name=\"checkbox_rand_ellipse\" onclick=\"rand(this.checked);\" /><br />

              pevný koeficient: <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp1\" onclick=\"rand_koeficient_1();\" checked=\"checked\" /> (jedno čislo znasobeni pro kazde pismeno)<br />
              koeficient znásobení: <input type=\"text\" name=\"rand_koeficient[0]\" value=\"1\" id=\"rand_koeficient_p1\" />*<br />
              náhodny koeficient: <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp2\" onclick=\"rand_koeficient_2();\" /> (nahodny pocet car v danem rozsahu pro jedno pismeno)<br />
              min koeficient znásobení: <input type=\"text\" name=\"rand_koeficient[0]\" value=\"1\" id=\"rand_koeficient_p2\" />*<br />
              max koeficient znásobení: <input type=\"text\" name=\"rand_koeficient[1]\" value=\"4\" id=\"rand_koeficient_p3\" />*<br />
              <br />
              pevné barvy: <input type=\"radio\" name=\"radio_color\" onclick=\"color_1();\" checked=\"checked\" /> (všechny čáry stejnou barvou, mřížka+náhoda)<br />
              pevna barva: #<input type=\"text\" name=\"color[0]\" value=\"aaa\" id=\"color_p1\" />*<br />
              rozsah barvy: <input type=\"radio\" name=\"radio_color\" onclick=\"color_2();\" /> (každá čára barvou v rozsahu, mřížka+náhoda)<br />
              min barva náhody: #<input type=\"text\" name=\"color[0]\" value=\"aaa\" id=\"color_p2\" />*<br />
              max barva náhody: #<input type=\"text\" name=\"color[1]\" value=\"bbb\" id=\"color_p3\" />*<br />
              nahodne barvy: <input type=\"radio\" name=\"radio_color\" onclick=\"color_3();\" /> (každá čára nahodnou barvou, mřížka+náhoda)<br />
              <br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat položku\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            function font_size_1()
            {
              document.getElementById('font_size_p1').disabled = false;
              document.getElementById('font_size_p2').disabled = true;
              document.getElementById('font_size_p3').disabled = true;
            }

            function font_size_2()
            {
              document.getElementById('font_size_p1').disabled = true;
              document.getElementById('font_size_p2').disabled = false;
              document.getElementById('font_size_p3').disabled = false;
            }

            function font_color_1()
            {
              document.getElementById('font_color_p1').disabled = false;
              document.getElementById('font_color_p2').disabled = true;
              document.getElementById('font_color_p3').disabled = true;
            }

            function font_color_2()
            {
              document.getElementById('font_color_p1').disabled = true;
              document.getElementById('font_color_p2').disabled = false;
              document.getElementById('font_color_p3').disabled = false;
            }

            function font_rotace_1()
            {
              document.getElementById('font_rotace_p1').disabled = false;
              document.getElementById('font_rotace_p2').disabled = true;
              document.getElementById('font_rotace_p3').disabled = true;
            }

            function font_rotace_2()
            {
              document.getElementById('font_rotace_p1').disabled = true;
              document.getElementById('font_rotace_p2').disabled = false;
              document.getElementById('font_rotace_p3').disabled = false;
            }

            function mrizka(stav)
            {
              document.getElementById('mrizka_p1').checked = (!stav ? false : true);
              document.getElementById('mrizka_p1').disabled = !stav;
              document.getElementById('mrizka_p2').disabled = !stav;
              document.getElementById('mrizka_p3').disabled = !stav;
              document.getElementById('mrizka_p4').disabled = !stav;
              document.getElementById('mrizka_p5').disabled = !stav;
              document.getElementById('mrizka_p6').disabled = !stav;
              document.getElementById('mrizka_p7').disabled = !stav;
              document.getElementById('mrizka_p8').disabled = !stav;
              document.getElementById('mrizka_p9').disabled = !stav;
            }

            function rand(stav)
            {
              document.getElementById('rand_koeficient_rp1').disabled = !stav;
              document.getElementById('rand_koeficient_p1').disabled = !stav;
              document.getElementById('rand_koeficient_rp2').disabled = !stav;
              document.getElementById('rand_koeficient_p2').disabled = !stav;
              document.getElementById('rand_koeficient_p3').disabled = !stav;
              if (stav)
              {
                rand_koeficient_1();
              }
            }

            function rand_koeficient_1()
            {
              document.getElementById('rand_koeficient_p1').disabled = false;
              document.getElementById('rand_koeficient_p2').disabled = true;
              document.getElementById('rand_koeficient_p3').disabled = true;
            }

            function rand_koeficient_2()
            {
              document.getElementById('rand_koeficient_p1').disabled = true;
              document.getElementById('rand_koeficient_p2').disabled = false;
              document.getElementById('rand_koeficient_p3').disabled = false;
            }

            function color_1()
            {
              document.getElementById('color_p1').disabled = false;
              document.getElementById('color_p2').disabled = true;
              document.getElementById('color_p3').disabled = true;
            }

            function color_2()
            {
              document.getElementById('color_p1').disabled = true;
              document.getElementById('color_p2').disabled = false;
              document.getElementById('color_p3').disabled = false;
            }

            function color_3()
            {
              document.getElementById('color_p1').disabled = true;
              document.getElementById('color_p2').disabled = true;
              document.getElementById('color_p3').disabled = true;
            }

            font_size_1();
            font_color_1();
            font_rotace_1();
            mrizka(false);
            rand(false);
            color_1();
          </script>
          ",

                  "admin_add_hlaska" => "
                přídán: %%1%%
              ",

                  "admin_edit" => "
          <form method=\"post\">
            <fieldset>
              typ: %%1%%<br />
              otázka: <input type=\"text\" name=\"otazka\" value=\"%%2%%\" />*<br />
              počet písmen: <input type=\"text\" name=\"pocet\" value=\"%%3%%\" />*<br />
              počátek X: <input type=\"text\" name=\"x\" value=\"%%4%%\" /> px*<br />
              počátek Y: <input type=\"text\" name=\"y\" value=\"%%5%%\" /> px*<br />
              width: <input type=\"text\" name=\"width\" value=\"%%6%%\" /> px*<br />
              height: <input type=\"text\" name=\"height\" value=\"%%7%%\" /> px*<br />
              font: %%8%%<br />
              roztec: <input type=\"text\" name=\"roztec\" value=\"%%9%%\" /> px* (rozeč písmen)<br />
              <br />
              font velikost pevná: <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_1();\"%%10%% /> (všechna písmena stejně veliká)<br />
              pevna size: <input type=\"text\" name=\"size[0]\" value=\"%%11%%\" id=\"font_size_p1\" /> px*<br />
              font rozsah velikosti: <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_2();\"%%12%% /> (každé písmeno jiné v daném rozsahu)<br />
              min size: <input type=\"text\" name=\"size[0]\" value=\"%%11%%\" id=\"font_size_p2\" /> px*<br />
              max size: <input type=\"text\" name=\"size[1]\" value=\"%%13%%\" id=\"font_size_p3\" /> px*<br />
              <br />
              font color pevná: <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_1();\"%%14%% /> (všechna písmena stejně barevná)<br />
              pevná barva textu: #<input type=\"text\" name=\"font_color[0]\" value=\"%%15%%\" id=\"font_color_p1\" />*<br />
              font color rozsah: <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_2();\"%%16%% /> (každé písmeno jiné v daném rozsahu barev)<br />
              min barva textu: #<input type=\"text\" name=\"font_color[0]\" value=\"%%15%%\" id=\"font_color_p2\" />*<br />
              max barva textu: #<input type=\"text\" name=\"font_color[1]\" value=\"%%17%%\" id=\"font_color_p3\" />*<br />
              <br />
              barva pozadí: #<input type=\"text\" name=\"pozadi\" value=\"%%18%%\" />*<br />
              <br />
              pevné natočení písmen: <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_1();\"%%19%% /> (všechna písmena stejně natočená)<br />
              pevné natočení: <input type=\"text\" name=\"font_rotace[0]\" value=\"%%20%%\" id=\"font_rotace_p1\" />*<br />
              rozsah natočení písmen: <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_2();\"%%21%% /> (každé písmeno jinak natočené v daném rozsahu)<br />
              min natočení písmena: <input type=\"text\" name=\"font_rotace[0]\" value=\"%%20%%\" id=\"font_rotace_p2\" />*<br />
              max natočení písmena: <input type=\"text\" name=\"font_rotace[1]\" value=\"%%22%%\" id=\"font_rotace_p3\" />*<br />
              <hr />
              mřížka: <input type=\"checkbox\" name=\"checkbox_mrizka\" onclick=\"mrizka(this.checked);\"%%23%% /><br />
              tvar mřížky:<br />
              + <input type=\"radio\" name=\"radio_mrizka\" value=\"1\" id=\"mrizka_p1\"%%24%% /> (klasická)<br />
              # <input type=\"radio\" name=\"radio_mrizka\" value=\"2\" id=\"mrizka_p2\"%%25%% /> (vodorovné rovně, slislé jsou nakloněné)<br />
              x <input type=\"radio\" name=\"radio_mrizka\" value=\"3\" id=\"mrizka_p3\"%%26%% /> (křížení do X)<br />
              - <input type=\"radio\" name=\"radio_mrizka\" value=\"4\" id=\"mrizka_p4\"%%27%% /> (jen vodorovné)<br />
              | <input type=\"radio\" name=\"radio_mrizka\" value=\"5\" id=\"mrizka_p5\"%%28%% /> (jen svislé)<br />
              \ <input type=\"radio\" name=\"radio_mrizka\" value=\"6\" id=\"mrizka_p6\"%%29%% /> (jen svislé do leva)<br />
              / <input type=\"radio\" name=\"radio_mrizka\" value=\"7\" id=\"mrizka_p7\"%%30%% /> (jen svislé do prava)<br />
              rozestup mrizek X: <input type=\"text\" name=\"mrizka[0]\" value=\"%%31%%\" id=\"mrizka_p8\" /> px*<br />
              rozestup mrizek Y: <input type=\"text\" name=\"mrizka[1]\" value=\"%%32%%\" id=\"mrizka_p9\" /> px*<br />
              <br />
              náhodné body: <input type=\"checkbox\" name=\"checkbox_rand_dot\" onclick=\"rand(this.checked);\"%%33%% /><br />
              náhodné čáry: <input type=\"checkbox\" name=\"checkbox_rand_line\" onclick=\"rand(this.checked);\"%%34%% /><br />
              náhodné čtverce: <input type=\"checkbox\" name=\"checkbox_rand_restangle\" onclick=\"rand(this.checked);\"%%35%% /><br />
              náhodné polokruží: <input type=\"checkbox\" name=\"checkbox_rand_arc\" onclick=\"rand(this.checked);\"%%36%% /><br />
              náhodné elipsy: <input type=\"checkbox\" name=\"checkbox_rand_ellipse\" onclick=\"rand(this.checked);\"%%37%% /><br />

              pevný koeficient: <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp1\" onclick=\"rand_koeficient_1();\"%%38%% /> (jedno čislo znasobeni pro kazde pismeno)<br />
              koeficient znásobení: <input type=\"text\" name=\"rand_koeficient[0]\" value=\"%%39%%\" id=\"rand_koeficient_p1\" />*<br />
              náhodny koeficient: <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp2\" onclick=\"rand_koeficient_2();\"%%40%% /> (nahodny pocet car v danem rozsahu pro jedno pismeno)<br />
              min koeficient znásobení: <input type=\"text\" name=\"rand_koeficient[0]\" value=\"%%39%%\" id=\"rand_koeficient_p2\" />*<br />
              max koeficient znásobení: <input type=\"text\" name=\"rand_koeficient[1]\" value=\"%%41%%\" id=\"rand_koeficient_p3\" />*<br />
              <br />
              pevné barvy: <input type=\"radio\" name=\"radio_color\" onclick=\"color_1();\"%%42%% /> (všechny čáry stejnou barvou, mřížka+náhoda)<br />
              pevna barva: #<input type=\"text\" name=\"color[0]\" value=\"%%43%%\" id=\"color_p1\" />*<br />
              rozsah barvy: <input type=\"radio\" name=\"radio_color\" onclick=\"color_2();\"%%44%% /> (každá čára barvou v rozsahu, mřížka+náhoda)<br />
              min barva náhody: #<input type=\"text\" name=\"color[0]\" value=\"%%43%%\" id=\"color_p2\" />*<br />
              max barva náhody: #<input type=\"text\" name=\"color[1]\" value=\"%%45%%\" id=\"color_p3\" />*<br />
              nahodne barvy: <input type=\"radio\" name=\"radio_color\" onclick=\"color_3();\"%%46%% /> (každá čára nahodnou barvou, mřížka+náhoda)<br />
              <br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit položku\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            function font_size_1()
            {
              document.getElementById('font_size_p1').disabled = false;
              document.getElementById('font_size_p2').disabled = true;
              document.getElementById('font_size_p3').disabled = true;
            }

            function font_size_2()
            {
              document.getElementById('font_size_p1').disabled = true;
              document.getElementById('font_size_p2').disabled = false;
              document.getElementById('font_size_p3').disabled = false;
            }

            function font_color_1()
            {
              document.getElementById('font_color_p1').disabled = false;
              document.getElementById('font_color_p2').disabled = true;
              document.getElementById('font_color_p3').disabled = true;
            }

            function font_color_2()
            {
              document.getElementById('font_color_p1').disabled = true;
              document.getElementById('font_color_p2').disabled = false;
              document.getElementById('font_color_p3').disabled = false;
            }

            function font_rotace_1()
            {
              document.getElementById('font_rotace_p1').disabled = false;
              document.getElementById('font_rotace_p2').disabled = true;
              document.getElementById('font_rotace_p3').disabled = true;
            }

            function font_rotace_2()
            {
              document.getElementById('font_rotace_p1').disabled = true;
              document.getElementById('font_rotace_p2').disabled = false;
              document.getElementById('font_rotace_p3').disabled = false;
            }

            function mrizka(stav)
            {
              //document.getElementById('mrizka_p1').checked = (!stav ? false : true);
              document.getElementById('mrizka_p1').disabled = !stav;
              document.getElementById('mrizka_p2').disabled = !stav;
              document.getElementById('mrizka_p3').disabled = !stav;
              document.getElementById('mrizka_p4').disabled = !stav;
              document.getElementById('mrizka_p5').disabled = !stav;
              document.getElementById('mrizka_p6').disabled = !stav;
              document.getElementById('mrizka_p7').disabled = !stav;
              document.getElementById('mrizka_p8').disabled = !stav;
              document.getElementById('mrizka_p9').disabled = !stav;
            }

            function rand(stav)
            {
              document.getElementById('rand_koeficient_rp1').disabled = !stav;
              document.getElementById('rand_koeficient_p1').disabled = !stav;
              document.getElementById('rand_koeficient_rp2').disabled = !stav;
              document.getElementById('rand_koeficient_p2').disabled = !stav;
              document.getElementById('rand_koeficient_p3').disabled = !stav;
              if (stav)
              {
                rand_koeficient_1();
              }
            }

            function rand_koeficient_1()
            {
              document.getElementById('rand_koeficient_p1').disabled = false;
              document.getElementById('rand_koeficient_p2').disabled = true;
              document.getElementById('rand_koeficient_p3').disabled = true;
            }

            function rand_koeficient_2()
            {
              document.getElementById('rand_koeficient_p1').disabled = true;
              document.getElementById('rand_koeficient_p2').disabled = false;
              document.getElementById('rand_koeficient_p3').disabled = false;
            }

            function color_1()
            {
              document.getElementById('color_p1').disabled = false;
              document.getElementById('color_p2').disabled = true;
              document.getElementById('color_p3').disabled = true;
            }

            function color_2()
            {
              document.getElementById('color_p1').disabled = true;
              document.getElementById('color_p2').disabled = false;
              document.getElementById('color_p3').disabled = false;
            }

            function color_3()
            {
              document.getElementById('color_p1').disabled = true;
              document.getElementById('color_p2').disabled = true;
              document.getElementById('color_p3').disabled = true;
            }

            %%47%%
            %%48%%
            %%49%%
            %%50%%
            %%51%%
            %%52%%
            %%53%%
          </script>
              ",

                  "admin_edit_hlaska" => "
                    upraven: %%1%%
                  ",

                  "admin_del_hlaska" => "
                  smazáno: %%1%%
                ",

                  "admin_addfont" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              nazev: <input type=\"text\" name=\"nazev\" />*<br />
              font: <input type=\"file\" name=\"font\" /> (*.ttf)<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
                  ",

                  "admin_addfont_hlaska" => "
                přídán: %%1%%, navic: %%2%%
                  ",

                  "admin_editfont" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              nazev: <input type=\"text\" name=\"nazev\" value=\"%%1%%\" />*<br />
              url: %%2%%<br />
              font: <input type=\"file\" name=\"font\" /> (*.ttf)<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
            </fieldset>
          </form>
              ",

                  "admin_editfont_hlaska" => "
                    upraven: %%1%%, navic: %%2%%
                  ",

                  "admin_delfont_hlaska" => "
                  smazáno: %%1%%, navic: %%2%%
                ",





                  "admin_vypis_obsah_font" => "
                  id: %%1%%<br />
                  nazev: %%2%%<br />
                  url: %%3%%<br />
                  %%4%%<br />
          <a href=\"%%5%%\" title=\"\">upravit položku</a>
          <a href=\"%%6%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%2%%\' ?');\">smazat položku</a><br />
          <br />
                  ",

                  "admin_vypis_obsah_font_obsah" => "<hr />",


                  "admin_vypis_obsah" => "poradi: '%%1%%' (%%2%%) %%3%% %%4%% %%5%% %%6%% %%7%% %%8%%
          <a href=\"%%9%%\" title=\"\">upravit položku</a>
          <a href=\"%%10%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%3%%\' ?');\">smazat položku</a><br />
          ",

                  "set_dirfont" => "fonty",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
