<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Captcha obrázky",
                                              "title" => "Captcha obrázky",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "normal_vypis_captcha_kod_1" => "<img src=\"%%3%%\" alt=\"%%1%%\" title=\"%%1%%\" />",



                  "admin_vypis_typu_select_begin" => "<select name=\"typ\">\n",

                  "admin_vypis_typu_select" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vypis_typu_select_end" => "</select>\n",



                  "admin_vypis_fontu_select_begin" => "<select name=\"font\">\n",

                  "admin_vypis_fontu_select" => "<option value=\"%%1%%\"%%2%%>[%%1%%] %%3%%</option>\n",

                  "admin_vypis_fontu_select_end" => "</select>\n",

                  "admin_vypis_fontu_select_null" => "<strong>Není nahraný žádný fonty !</strong>",

                  "admin_obsah" => "
<div class=\"captcha_obrazky\">
  <h3>Výpis fontů a položek captchy</h3>
  <p class=\"odkazy_captcha\">
    <a href=\"%%1%%\" title=\"Přidat font\" class=\"pridat_font\">Přidat font</a>
  </p>
  <div class=\"captcha_polozky\">
    %%2%%
  </div>
</div>\n",

                  "admin_vypis_font_begin" => "
<ul class=\"font_polozka\">
  <li class=\"nazev_captcha\"><em class=\"prvni_em\">[%%1%%]</em> <span class=\"font_%%5%%\"><!-- --></span><span class=\"tooltip\">Font:<br /><strong>%%2%%</strong><br />%%5%%</span><em>%%2%%</em></li>
  <li class=\"odkazy_captcha_editace\"><a href=\"%%8%%\" title=\"Přidat captcha obrázek s fontem: %%2%%\">Přidat captchu s fontem <strong>%%2%%</strong></a> - <a href=\"%%6%%\" title=\"Upravit font: %%2%%\">Upravit</a> - <a href=\"%%7%%\" title=\"Smazat font: %%2%%\" onclick=\"return confirm('Opravdu chceš smazat font &quot;%%2%%&quot; ?');\">Smazat</a></li>
  <li class=\"cesta_font_captcha\"><a href=\"modules/captcha_code/fonty/%%3%%\" title=\"%%2%%\">%%3%%</a></li>
  <li><img src=\"%%4%%\" alt=\"%%2%%\" title=\"%%2%%\" /></li>
</ul>\n",

                  "admin_vypis_font_end" => "",

                  "admin_vypis_font_null" => "žádné fonty",

                  "admin_vypis_captcha" => "
<ul class=\"captcha_polozka\">
  <li class=\"nazev_captcha\"><em class=\"prvni_em\">[%%1%%]</em><em>%%3%%</em></li>
  <li class=\"odkazy_captcha_editace\"><a href=\"%%5%%\" title=\"Upravit captcha obrázek s id: %%1%%\">Upravit</a> - <a href=\"%%6%%\" title=\"Smazat captcha obrázek s id: %%1%%\" onclick=\"return confirm('Opravdu chceš smazat captcha obrázek s id &quot;%%1%%&quot; ?');\">Smazat</a></li>
  <li class=\"cesta_font_captcha\">%%2%%</li>
  <li><img alt=\"\" src=\"%%4%%\" /></li>
</ul>\n",

                  "admin_vypis_captcha_null" => "žádná captcha",




                  "admin_addcap_default" => array("otazka" => "",
                                                  "pocet" => "4",
                                                  "x" => "10",
                                                  "y" => "30",
                                                  "width" => "450",
                                                  "height" => "45",
                                                  "roztec" => "20",
                                                  "font_size" => array(14, ),
                                                  "font_color" => array("#000000", ),
                                                  "background_color" => "#ffffff",
                                                  "vyrez_x" => "0",
                                                  "vyrez_y" => "0",
                                                  "rotace_pismen" => array(0, ),
                                                  "mrizka" => array(0, 5, 5),
                                                  "rand_dot" => "0",
                                                  "rand_line" => "0",
                                                  "rand_rectangle" => "0",
                                                  "rand_arc" => "0",
                                                  "rand_ellipse" => "0",
                                                  "rand_koeficient" => array(1, ),
                                                  "rand_barva" => array("#cccccc", ),
                                                  ),

                  "admin_addcap_nazev" => "Přidat captcha obrázek",

                  "admin_editcap_nazev" => "Upravit captcha obrázek",

                  "admin_addeditcap" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<script type=\"text/javascript\" src=\"%%2%%/script/farbtastic/farbtastic.js\"></script>
<script type=\"text/javascript\">
  $(function() {
    $('#picker_font_color_p1').farbtastic('#font_color_p1');
    $('#picker_font_color_p2').farbtastic('#font_color_p2');
    $('#picker_font_color_p3').farbtastic('#font_color_p3');
    $('#picker_pozadi_p1').farbtastic('#pozadi_p1');
    $('#picker_color_p1').farbtastic('#color_p1');
    $('#picker_color_p2').farbtastic('#color_p2');
    $('#picker_color_p3').farbtastic('#color_p3');
  });
</script>

<div class=\"captcha_obrazek_pridat_upravit\">
  <h3>%%3%%</h3>
  <p class=\"backlink_captcha\"><a href=\"%%63%%\" title=\"Zpět na výpis fontů a položek captchy\">Zpět na výpis fontů a položek captchy</a></p>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label class=\"input_select\">
        <span>Typ captchy:</span>
        %%4%%
      </label>
      <label class=\"input_text\">
        <span>Otázka captchy:</span>
        <input type=\"text\" name=\"otazka\" value=\"%%5%%\" />
        <span class=\"captcha_dodatek\">Povinná položka pro přidání s výchozím nastavením.</span>
      </label>
      <label class=\"input_text\">
        <span>Počet písmen v captche:</span>
        <input type=\"text\" name=\"pocet\" value=\"%%6%%\" />
        <span class=\"captcha_dodatek\">Funguje jen na obrázková čísla a písmena.<br />Ve výběru typu captchy je označeno [počet].</span>
      </label>
      <label class=\"input_text\">
        <span>Počátek písmen v ose X:</span>
        <input type=\"text\" name=\"x\" value=\"%%7%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Počátek písmen v ose Y:</span>
        <input type=\"text\" name=\"y\" value=\"%%8%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Šířka captcha obrázku [width]:</span>
        <input type=\"text\" name=\"width\" value=\"%%9%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px], 0 == auto.</span>
      </label>
      <label class=\"input_text\">
        <span>Výška captcha obrázku [height]:</span>
        <input type=\"text\" name=\"height\" value=\"%%10%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px], 0 == auto.</span>
      </label>
      <label class=\"input_select\">
        <span>Typ písma [font]:</span>
        %%11%%
      </label>
      <label class=\"input_text\">
        <span>Rozteč písma:</span>
        <input type=\"text\" name=\"roztec\" value=\"%%12%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost písma:</span>
        <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_1();\"%%13%% />
      </label>
      <label class=\"input_text\">
        <span>Hodnota pevné velikosti písma:</span>
        <input type=\"text\" name=\"font_size[0]\" value=\"%%14%%\" id=\"font_size_p1\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Velikost písma v určeném rozsahu:</span>
        <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_2();\"%%15%% />
        <span class=\"captcha_dodatek\">Každé písmeno má jinou velikost v tebou určeném rozsahu.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální velikost rozsahu písma:</span>
        <input type=\"text\" name=\"font_size[0]\" value=\"%%14%%\" id=\"font_size_p2\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální velikost rozsahu písma:</span>
        <input type=\"text\" name=\"font_size[1]\" value=\"%%16%%\" id=\"font_size_p3\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná barva písma:</span>
        <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_1();\"%%17%% />
      </label>
      <label class=\"input_text\">
        <span>Barva písma:</span>
        <input type=\"text\" name=\"font_color[0]\" value=\"%%18%%\" id=\"font_color_p1\" maxlength=\"7\" />
        <span class=\"barvapicker\" id=\"picker_font_color_p1\"></span>
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Barva písma v určeném rozsahu:</span>
        <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_2();\"%%19%% />
        <span class=\"captcha_dodatek\">Každé písmeno má jinou barvu v tebou určeném rozsahu.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální barva písma v rozsahu:</span>
        <input type=\"text\" name=\"font_color[0]\" value=\"%%18%%\" id=\"font_color_p2\" maxlength=\"7\" />
        <span class=\"barvapicker\" id=\"picker_font_color_p2\"></span>
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální barva písma v rozsahu:</span>
        <input type=\"text\" name=\"font_color[1]\" value=\"%%20%%\" id=\"font_color_p3\" maxlength=\"7\" />
        <span class=\"barvapicker\" id=\"picker_font_color_p3\"></span>
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná barva pozadí captcha obrázku:</span>
        <input type=\"radio\" name=\"radio_pozadi\" onclick=\"pozadi_1();\"%%21%% />
      </label>
      <label class=\"input_text\">
        <span>Barva pozadí:</span>
        <input type=\"text\" name=\"background_color\" value=\"%%22%%\" id=\"pozadi_p1\" maxlength=\"7\" />
        <span class=\"barvapicker\" id=\"picker_pozadi_p1\"></span>
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Obrázek na pozadí captchy:</span>
        <input type=\"radio\" name=\"radio_pozadi\" onclick=\"pozadi_2();\"%%23%% />
      </label>
      <label class=\"input_file\">
        <span>Cesta obrázku na pozadí captchy:</span>
        <input type=\"file\" name=\"obrazek\" id=\"pozadi_p2\" />
        <img src=\"%%24%%\" alt=\"Obrázek na pozadí captchy\" />
        <span class=\"captcha_dodatek\">Formát obrázku je <strong>.jpg nebo .png</strong></span>
      </label>
      <label class=\"input_text\">
        <span>Poloha obrázku na pozadí captchy v ose X:</span>
        <input type=\"text\" name=\"vyrez_x\" value=\"%%25%%\" id=\"pozadi_p3\" />
      </label>
      <label class=\"input_text\">
        <span>Poloha obrázku na pozadí captchy v ose Y:</span>
        <input type=\"text\" name=\"vyrez_y\" value=\"%%26%%\" id=\"pozadi_p4\" />
      </label>
      <label class=\"input_radio\">
        <span>Pevné natočení písmen:</span>
        <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_1();\"%%27%% />
      </label>
      <label class=\"input_text\">
        <span>Hodnota pevného natočení písma:</span>
        <input type=\"text\" name=\"rotace_pismen[0]\" value=\"%%28%%\" id=\"font_rotace_p1\" />
        <span class=\"captcha_dodatek\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"input_radio\">
        <span>Natočení písma v určitém rozsahu:</span>
        <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_2();\"%%29%% />
        <span class=\"captcha_dodatek\">Každé písmeno je jinak natočené v tebou určeném rozsahu.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální natočení písma v rozsahu:</span>
        <input type=\"text\" name=\"rotace_pismen[0]\" value=\"%%28%%\" id=\"font_rotace_p2\" />
        <span class=\"captcha_dodatek\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální natočení písma v rozsahu:</span>
        <input type=\"text\" name=\"rotace_pismen[1]\" value=\"%%30%%\" id=\"font_rotace_p3\" />
        <span class=\"captcha_dodatek\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Mřížka na captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_mrizka\" onclick=\"mrizka(this.checked);\"%%31%% />
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [+]:</span>
        <input type=\"radio\" name=\"mrizka[0]\" value=\"1\" id=\"mrizka_p1\"%%32%% />
        <span class=\"captcha_dodatek\">Mřížka má standardní tvar.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [#]:</span>
        <input type=\"radio\" name=\"mrizka[0]\" value=\"2\" id=\"mrizka_p2\"%%33%% />
        <span class=\"captcha_dodatek\">Mřížka má standardní tvar, ale svislé čáry jsou nakloněny.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [X]:</span>
        <input type=\"radio\" name=\"mrizka[0]\" value=\"3\" id=\"mrizka_p3\"%%34%% />
        <span class=\"captcha_dodatek\">Mřížka má tvar písmene X.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [-]:</span>
        <input type=\"radio\" name=\"mrizka[0]\" value=\"4\" id=\"mrizka_p4\"%%35%% />
        <span class=\"captcha_dodatek\">Mřížka je jen vodorovně.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [|]:</span>
        <input type=\"radio\" name=\"mrizka[0]\" value=\"5\" id=\"mrizka_p5\"%%36%% />
        <span class=\"captcha_dodatek\">Mřížka je jen svisle.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [\]:</span>
        <input type=\"radio\" name=\"mrizka[0]\" value=\"6\" id=\"mrizka_p6\"%%37%% />
        <span class=\"captcha_dodatek\">Mřížka je jen svisle nakloněná zleva doprava (shora dolů).</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [/]:</span>
        <input type=\"radio\" name=\"mrizka[0]\" value=\"7\" id=\"mrizka_p7\"%%38%% />
        <span class=\"captcha_dodatek\">Mřížka je jen svisle nakloněná zprava doleva (shora dolů).</span>
      </label>
      <label class=\"input_text\">
        <span>Rozestup mřížky v ose X:</span>
        <input type=\"text\" name=\"mrizka[1]\" value=\"%%39%%\" id=\"mrizka_p8\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Rozestup mřížky v ose Y:</span>
        <input type=\"text\" name=\"mrizka[2]\" value=\"%%40%%\" id=\"mrizka_p9\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné body v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"rand_dot\" onclick=\"rand(this.checked);\"%%41%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné čáry v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"rand_line\" onclick=\"rand(this.checked);\"%%42%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné čtverce v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"rand_rectangle\" onclick=\"rand(this.checked);\"%%43%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné polokruhy v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"rand_arc\" onclick=\"rand(this.checked);\"%%44%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné elipsy v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"rand_ellipse\" onclick=\"rand(this.checked);\"%%45%% />
      </label>
      <label class=\"input_radio\">
        <span>Pevný počet objektů na písmeno:</span>
        <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp1\" onclick=\"rand_koeficient_1();\"%%46%% />
      </label>
      <label class=\"input_text\">
        <span>Počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[0]\" value=\"%%47%%\" id=\"rand_koeficient_p1\" />
      </label>
      <label class=\"input_radio\">
        <span>Náhodný počet objektů na písmeno v určitém rozsahu:</span>
        <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp2\" onclick=\"rand_koeficient_2();\"%%48%% />
      </label>
      <label class=\"input_text\">
        <span>Minimální počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[0]\" value=\"%%47%%\" id=\"rand_koeficient_p2\" />
      </label>
      <label class=\"input_text\">
        <span>Maximální počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[1]\" value=\"%%49%%\" id=\"rand_koeficient_p3\" />
      </label>
      <label class=\"input_radio\">
        <span>Pevné nastavení barvy:</span>
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_1();\"%%50%% />
        <span class=\"captcha_dodatek\">Mřížka nebo náhodný objekt bude jednou barvou.<br />Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"input_text\">
        <span>Hodnota barvy v pevném nastavení:</span>
        <input type=\"text\" name=\"rand_barva[0]\" value=\"%%51%%\" id=\"color_p1\" maxlength=\"7\" />
        <span class=\"barvapicker\" id=\"picker_color_p1\"></span>
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Nastavení barvy v určitém rozsahu:</span>
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_2();\"%%52%% />
        <span class=\"captcha_dodatek\">Mřížka nebo náhodný objekt bude barvou v určitém rozsahu (každá čára / část náhodného objektu bude jinou barvou, ovšem v tebou stanoveném rozsahu).<br />Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální hodnota barvy v určitém rozsahu:</span>
        <input type=\"text\" name=\"rand_barva[0]\" value=\"%%51%%\" id=\"color_p2\" maxlength=\"7\" />
        <span class=\"barvapicker\" id=\"picker_color_p2\"></span>
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální hodnota barvy v určitém rozsahu:</span>
        <input type=\"text\" name=\"rand_barva[1]\" value=\"%%53%%\" id=\"color_p3\" maxlength=\"7\" />
        <span class=\"barvapicker\" id=\"picker_color_p3\"></span>
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Náhodná barva:</span>
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_3();\"%%54%% />
        <span class=\"captcha_dodatek\">Mřížka nebo náhodný objekt bude náhodnou barvou (každá čára / část náhodného objektu bude náhodnou barvou).<br />Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"%%3%%\" />
      </label>
    </fieldset>
  </form>
</div>

<script type=\"text/javascript\">
  function font_size_1()
  {
    $('#font_size_p2, #font_size_p3').attr('disabled', true);
    $('#font_size_p1').attr('disabled', false);
  }

  function font_size_2()
  {
    $('#font_size_p1').attr('disabled', true);
    $('#font_size_p2, #font_size_p3').attr('disabled', false);
    //$('#font_size_p3').val(16);
  }

  function font_color_1()
  {
    $('#font_color_p2, #font_color_p3').attr('disabled', true);
    $('#font_color_p1').attr('disabled', false);
  }

  function font_color_2()
  {
    $('#font_color_p1').attr('disabled', true);
    $('#font_color_p2, #font_color_p3').attr('disabled', false);
    //$('#font_color_p3').val('#ffffff');
  }

  function pozadi_1()
  {
    $('#pozadi_p2, #pozadi_p3, #pozadi_p4').attr('disabled', true);
    $('#pozadi_p1').attr('disabled', false);
  }

  function pozadi_2()
  {
    $('#pozadi_p2, #pozadi_p3, #pozadi_p4').attr('disabled', false);
    $('#pozadi_p1').attr('disabled', true);
    //$('#pozadi_p3').val(0);
    //$('#pozadi_p4').val(0);
  }

  function font_rotace_1()
  {
    $('#font_rotace_p2, #font_rotace_p3').attr('disabled', true);
    $('#font_rotace_p1').attr('disabled', false);
  }

  function font_rotace_2()
  {
    $('#font_rotace_p1').attr('disabled', true);
    $('#font_rotace_p2, #font_rotace_p3').attr('disabled', false);
    //$('#font_rotace_p2').val(-20);
    //$('#font_rotace_p3').val(20);
  }

  function mrizka(stav)
  {
    //$('#mrizka_p1').attr('checked', stav);
    $('#mrizka_p1, #mrizka_p2, #mrizka_p3, #mrizka_p4, #mrizka_p5, #mrizka_p6, #mrizka_p7, #mrizka_p8, #mrizka_p9').attr('disabled', !stav);
    if (stav)
    {
      //$('#mrizka_p8').val(5);
      //$('#mrizka_p9').val(5);
    }
  }

  function rand(stav)
  {
    $('#rand_koeficient_rp1, #rand_koeficient_p1, #rand_koeficient_rp2, #rand_koeficient_p2, #rand_koeficient_p3').attr('disabled', !stav);
    if (stav)
    {
      rand_koeficient_1();
    }
  }

  function rand_koeficient_1()
  {
    $('#rand_koeficient_p2, #rand_koeficient_p3').attr('disabled', true);
    $('#rand_koeficient_p1').attr('disabled', false);
    //$('#rand_koeficient_p1').val(1);
  }

  function rand_koeficient_2()
  {
    $('#rand_koeficient_p2, #rand_koeficient_p3').attr('disabled', false);
    $('#rand_koeficient_p1').attr('disabled', true);
    //$('#rand_koeficient_p2').val(1);
    //$('#rand_koeficient_p3').val(4);
  }

  function color_1()
  {
    $('#color_p2, #color_p3').attr('disabled', true);
    $('#color_p1').attr('disabled', false);
  }

  function color_2()
  {
    $('#color_p2, #color_p3').attr('disabled', false);
    $('#color_p1').attr('disabled', true);
    //$('#color_p2').val('#aaaaaa');
    //$('#color_p3').val('#cccccc');
  }

  function color_3()
  {
    $('#color_p1, #color_p2, #color_p3').attr('disabled', true);
  }

  %%55%%
  %%56%%
  %%57%%
  %%58%%
  %%59%%
  %%60%%
  %%61%%
  %%62%%
</script>\n",

                  "admin_addcap_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán captcha obrázek: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet vyřezů navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editcap_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven captcha obrázek: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet vyřezů navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delcap_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán captcha obrázek: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet vyřezů navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_addfont" => "
<script type=\"text/javascript\" src=\"%%1%%\"></script>
<div class=\"captcha_pridat_upravit_font\">
  <h3>Přidat font</h3>
  <p class=\"backlink_captcha\"><a href=\"%%2%%\" title=\"Zpět na výpis fontů a položek captchy\">Zpět na výpis fontů a položek captchy</a></p>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Název fontu:</span>
        <input type=\"text\" name=\"nazev\" id=\"nazev_fontu\" />
      </label>
      <label class=\"input_file\">
        <span>Cesta fontu:</span>
        <input type=\"file\" name=\"font\" onchange=\"$('#nazev_fontu').val(this.value);\" />
        <span class=\"font_dodatek\">formát fontu jen <strong>.ttf</strong></span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat font\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_addfont_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán font: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet fontů navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_editfont" => "
<div class=\"captcha_pridat_upravit_font\">
  <h3>Upravit font</h3>
  <p class=\"backlink_captcha\"><a href=\"%%3%%\" title=\"Zpět na výpis fontů a položek captchy\">Zpět na výpis fontů a položek captchy</a></p>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Název fontu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%1%%\" />
      </label>
      <label class=\"input_file\">
        <span>Cesta fontu:</span>
        <input type=\"file\" name=\"font\" />
        <span class=\"font_dodatek\">formát fontu jen <strong>.ttf</strong></span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit font\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_editfont_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven font: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet fontů navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delfont_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán font: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet fontů navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_delfont_false_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Nepodařilo se smazat font: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Font je blokován systémem.
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "set_dirfont" => "fonty",

                  "set_typkodu" => array ("smalltext" => "Text (malá písmena) [počet]",
                                          "largetext" => "Text (velká písmena) [počet]",
                                          "randtext" => "Text (náhodná kombinace malých a velkých písmen) [počet]",
                                          "number" => "Číslo [počet]",
                                          "smalltextnumber" => "Text a číslo (malá písmena) [počet]",
                                          "largetextnumber" => "Text a číslo (velká písmena) [počet]",
                                          "randtextnumber" => "Text a číslo (náhodná kombinace malých a velkých písmen) [počet]",
                                          "examinc" => "Příklad (sčítání) (+)",
                                          "examdec" => "Příklad (odčítání) (-)",
                                          "examincdec" => "Příklad (sčítání a odčítání) (+&amp;-)",
                                          "exammul" => "Příklad (krácení) (*)",
                                          "examincdecmul" => "Příklad (náhodná kombinace +&amp;-&amp;*)",
                                          "exampow" => "Příklad (mocnina)",
                                          "exambindec" => "Příklad (převod Bin -> Dec) [počet]",
                                          "examdecbin" => "Příklad (převod Dec -> Bin) (od 0 do: [počet])",
                                          "examoctdec" => "Příklad (převod Oct -> Dec) [počet]",
                                          "examdecoct" => "Příklad (převod Dec -> Oct) (od 0 do: [počet])",
                                          "examhexdex" => "Příklad (převod Hex -> Dec) [počet]",
                                          "examdechex" => "Příklad (převod Dec -> Hex) (od 0 do: [počet])",
                                          "examrandconv" => "Příklad (náhodná kombinace všech převodů) [počet][od 0 do 100]",
                                          "examhexrgb" => "Příklad (převod barvy Hex->RGB)",
                                          "examrgbhex" => "Příklad (převod barvy RGB->Hex)",
                                          "examrandrgbhex" => "Příklad (náhodná kombinace převodů RGB &amp; Hex)",
                                          "examrandder" => "Příklad na určitou derivaci o libovolnem X [počet]",
                                          ),

                  "admin_slovo_lower" => "abcdefghijklmnopqrstuvwxyz",

                  "admin_slovo_upper" => "ABCDEFGHIJKLMNOPQRSTUVWXYZ",

                  "admin_slovo_num" => "0123456789",

                  "admin_slovo_bin" => "01",

                  "admin_slovo_hex" => "0123456789ABCDEF",

                  "admin_slovo_oct" => "01234567",

                  "admin_slovo_znamenka" => "+-*",

                  "admin_slovo_implode" => ",",

                  "admin_captcha_examinc" => "%%1%%+%%2%%",

                  "admin_captcha_examdec" => "%%1%%-%%2%%",

                  "admin_captcha_examincdec" => "%%1%%%%2%%%%3%%",

                  "admin_captcha_exammul" => "%%1%%*%%2%%",

                  "admin_captcha_examincdecmul" => "%%1%%%%2%%%%3%%",

                  "admin_captcha_exampow" => "%%1%%^%%2%%",

                  "admin_captcha_exambindec" => "Bin(%%1%%)=>Dec",

                  "admin_captcha_examdecbin" => "Dec(%%1%%)=>Bin",

                  "admin_captcha_examoctdec" => "Oct(%%1%%)=>Dec",

                  "admin_captcha_examdecoct" => "Dec(%%1%%)=>Oct",

                  "admin_captcha_examhexdex" => "Hex(%%1%%)=>Dec",

                  "admin_captcha_examdechex" => "Dec(%%1%%)=>Hex",

                  //19 si sama prepina mezi 13-18

                  "admin_captcha_examhexrgb" => "#%%1%%=>RGB",

                  "admin_captcha_examrgbhex" => "RGB:%%1%%=>#Hex",

                  "admin_slovo_inexamrgbhex" => "#%%1%%",

                  "admin_captcha_examrandder" => "y'=(%%1%%x^%%2%%)%%3%%%%4%%, x=%%5%%",

                  "set_defaultpic" => "default",



                  "set_barva_pozadi" => "#fff",

                  "set_barva_fontu" => "#000",

                  "set_nahled_size" => 10,

                  "set_nahled_text" => "a b c d e f g h i j k l m n o p q r s t u v w x y z\n\n0 1 2 3 4 5 6 7 8 9  + - * ^\n\nA B C D E F G H I J K L M N O P Q R S T U V W X Y Z\n\ně š č ř ž ý á í é ú ů ! ? ( )\n\nĚ Š Č Ř Ž Ý Á Í É Ú Ů",

                  "set_nahled_zalomit" => 60,




                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
