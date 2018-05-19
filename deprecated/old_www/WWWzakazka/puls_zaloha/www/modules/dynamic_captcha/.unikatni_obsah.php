<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Captcha",
                                              "title" => "Captcha",),
                                        ),

                  "admin_permit" => array("%%1%%" => array("" => "Výpis fontů a captchy", "addfont" => "Přidat font", "editfont" => "Upravit font", "delfont" => "Smazat font",
                                                          "addcap" => "Přidat captchu", "editcap" => "Upravit captchu", "delcap" => "Smazat captchu"),
                                          ),

                  "name_module" => array ("Administrace captcha",
                                          "Captcha"),

/* - - - - - - - - - - Normal výpis - - - - - - - - - - */

                  "normal_vypis_captcha_kod_1" => "<img src=\"%%3%%\" alt=\"%%1%%\" />",

/* - - - - - - - - - - /Normal výpis - - - - - - - - - - */

                  "admin_obsah" => "
<div class=\"obal_dyncapt\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">Captcha</h3>
  </div>
  <a href=\"%%1%%\" title=\"Přidat font\" class=\"addfont tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat font</span>
  </a>
  <div class=\"cl-b pos-rel\">
    %%2%%
  </div>
</div>\n",

                  "admin_addeditfont_add" => "Přidat font",

                  "admin_addeditfont_edit" => "Upravit font",

                  "admin_addeditfont" => "
<div class=\"obal_dyncapt\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%1%% %%2%%</h3>
  </div>
  <a href=\"%%3%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\" class=\"cl-b formular\">
    <fieldset>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Název fontu:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%2%%\" id=\"nazev_fontu\" />
        <span class=\"popis-elementu\">Název fontu se načte automaticky.</span>
      </label>
      <label class=\"f-file w-700\">
        <span class=\"nazev-elementu\">Font:</span>
        <input type=\"file\" name=\"font\" onchange=\"$('#nazev_fontu').val(this.value);\" />
        <span class=\"popis-elementu block ow-h\">Podporovaný formát fontu je jen <strong>.ttf</strong></span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%1%%\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "set_dirfont" => "fonty",

                  "admin_vypis_obsah" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\">
  <li class=\"nadpis-6 f-s-16 l-h-24 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%2%%</span><span class=\"block fl-r informace-%%5%%\"><!-- --></span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%8%%\" class=\"addcap block fl-l m-r-5 m-l-5 no-u odkaz-18\" title=\"Přidat captchu\">Přidat captchu</a><a href=\"%%6%%\" class=\"editfont block fl-l m-r-5 m-l-5 no-u odkaz-18\" title=\"Upravit font\">Upravit font</a><a href=\"%%7%%\" class=\"delfont confirm block fl-l m-r-5 m-l-5 no-u odkaz-18\" title=\"Opravdu chceš smazat font: &quot;%%2%%&quot; ?\">Smazat font</a></span></li>
  <li class=\"polozka-4-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"fl-l\"><a href=\"modules/dynamic_captcha/fonty/%%3%%\" title=\"%%3%%\" class=\"odkaz-9 no-u\">%%3%%</a></span></li>
  <li class=\"polozka-4-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"block fl-l\"><img src=\"%%4%%\" alt=\"%%2%%\" class=\"block m-w-690\" /></span></li>
%%9%%
</ul>\n",

                  "admin_vypis_obsah_null" => "<div class=\"nadpis-2 f-s-16 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořen žádný font</div>",

                  "admin_vypis_obsah_row" => "
  <li class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">%%4%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\"><a href=\"%%7%%\" title=\"Upravit captchu\" class=\"editcap block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit captchu</a><a href=\"%%8%%\" title=\"Opravdu chceš smazat captchu: &quot;%%4%%&quot; ?\" class=\"confirm delcap block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat captchu</a></span></li>
  <li class=\"polozka-1-lichy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Hlavní typ captchy:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Specifický typ captchy:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h\"><span class=\"block fl-l\"><img src=\"%%5%%\" alt=\"%%4%%\" class=\"block m-w-670\" /></span></li>
  <li class=\"polozka-1-sudy m-r-10 m-l-10 p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Výsledek:</span><span class=\"fl-r barva-5\">%%6%%</span></li>\n",

                  "admin_vypis_obsah_row_null" => "<div class=\"nadpis-2 f-s-16 m-t-2 m-r-10 m-l-10 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vytvořená žádná captcha</div>",

                  "admin_addcap_default" => array("otazka" => "",
                                                  //"pocet" => "4",
                                                  "x" => "10",
                                                  "y" => "30",
                                                  "width" => "450",
                                                  "height" => "45",
                                                  "padding" => "0 0 0 0",
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

                  "admin_addcap_nazev" => "Přidat captchu",

                  "admin_editcap_nazev" => "Upravit captchu",

                  "admin_addeditcap" => "
<script type=\"text/javascript\" src=\"%%dirpath%%/script/color/farbtastic.js\"></script>
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
<div class=\"obal_dyncapt\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%nazev%%</h3>
  </div>
  <a href=\"%%backlink%%\" title=\"Zpět na výpis\" class=\"tlacitko-4 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Zpět na výpis</span>
  </a>
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\" class=\"cl-b formular\">
    <fieldset>
      %%typ%%
      %%font%%
      <label class=\"f-text f-povinny w-500\">
        <span class=\"nazev-elementu\">Otázka captchy:</span>
        <input type=\"text\" name=\"otazka\" value=\"%%otazka%%\" />
        <span class=\"popis-elementu\"><span class=\"f-povinny-popis\">Povinná položka.</span></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Počátek písmen v ose X:</span>
        <input type=\"text\" name=\"x\" value=\"%%x%%\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Počátek písmen v ose Y:</span>
        <input type=\"text\" name=\"y\" value=\"%%y%%\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_with_height\" onclick=\"with_height_1();\"%%with_height_0_check%% />
        <span class=\"nazev-elementu\">Pevné rozměry captcha obrázku</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Šířka captcha obrázku [width]:</span>
        <input type=\"text\" name=\"width\" value=\"%%width%%\" id=\"width_height_p1\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Výška captcha obrázku [height]:</span>
        <input type=\"text\" name=\"height\" value=\"%%height%%\" id=\"width_height_p2\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_with_height\" onclick=\"with_height_2();\"%%with_height_1_check%% />
        <span class=\"nazev-elementu\">Automaticky nastavit velikost captcha obrázku</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Odsazení textu od okraje obrázku:</span>
        <input type=\"text\" name=\"padding\" value=\"%%padding%%\" id=\"width_height_p3\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px]. Zápis hodnot je ve směru ručičkových hodinek: TOP RIGHT BOTTOM LEFT.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Rozteč písma:</span>
        <input type=\"text\" name=\"roztec\" value=\"%%roztec%%\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_1();\"%%font_size_1_check%% />
        <span class=\"nazev-elementu\">Pevná velikost písma</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Hodnota pevné velikosti písma:</span>
        <input type=\"text\" name=\"font_size[0]\" value=\"%%font_size_0%%\" id=\"font_size_p1\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_2();\"%%font_size_01_check%% />
        <span class=\"nazev-elementu\">Velikost písma v určeném rozsahu</span>
        <span class=\"popis-elementu cl-b\">Každé písmeno má jinou velikost v tebou určeném rozsahu.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální velikost rozsahu písma:</span>
        <input type=\"text\" name=\"font_size[0]\" value=\"%%font_size_0%%\" id=\"font_size_p2\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální velikost rozsahu písma:</span>
        <input type=\"text\" name=\"font_size[1]\" value=\"%%font_size_1%%\" id=\"font_size_p3\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_1();\"%%font_color_1_check%% />
        <span class=\"nazev-elementu\">Pevná barva písma</span>
      </label>
      <div class=\"w-700 cl-b\">
        <label class=\"f-text f-farbtastic w-195-i\">
          <span class=\"nazev-elementu\">Barva písma:</span>
          <span class=\"farbtastic\" id=\"picker_font_color_p1\"></span>
          <input type=\"text\" name=\"font_color[0]\" value=\"%%font_color_0%%\" id=\"font_color_p1\" maxlength=\"7\" />
          <span class=\"popis-elementu\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
        </label>
      </div>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_2();\"%%font_color_01_check%% />
        <span class=\"nazev-elementu\">Barva písma v určeném rozsahu</span>
        <span class=\"popis-elementu cl-b\">Každé písmeno má jinou barvu v tebou určeném rozsahu.</span>
      </label>
      <div class=\"w-700 cl-b\">
        <label class=\"f-text f-farbtastic w-195-i\">
          <span class=\"nazev-elementu\">Minimální barva písma v rozsahu:</span>
          <span class=\"farbtastic\" id=\"picker_font_color_p2\"></span>
          <input type=\"text\" name=\"font_color[0]\" value=\"%%font_color_0%%\" id=\"font_color_p2\" maxlength=\"7\" />
          <span class=\"popis-elementu\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
        </label>
      </div>
      <div class=\"w-700 cl-b\">
        <label class=\"f-text f-farbtastic w-195-i\">
          <span class=\"nazev-elementu\">Maximální barva písma v rozsahu:</span>
          <span class=\"farbtastic\" id=\"picker_font_color_p3\"></span>
          <input type=\"text\" name=\"font_color[1]\" value=\"%%font_color_1%%\" id=\"font_color_p3\" maxlength=\"7\" />
          <span class=\"popis-elementu\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
        </label>
      </div>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_pozadi\" onclick=\"pozadi_1();\"%%background_color_1_check%% />
        <span class=\"nazev-elementu\">Pevná barva pozadí captcha obrázku</span>
      </label>
      <div class=\"w-700 cl-b\">
        <label class=\"f-text f-farbtastic w-195-i\">
          <span class=\"nazev-elementu\">Barva pozadí:</span>
          <span class=\"farbtastic\" id=\"picker_pozadi_p1\"></span>
          <input type=\"text\" name=\"background_color\" value=\"%%background_color%%\" id=\"pozadi_p1\" maxlength=\"7\" />
          <span class=\"popis-elementu\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
        </label>
      </div>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_pozadi\" onclick=\"pozadi_2();\"%%background_color_0_check%% />
        <span class=\"nazev-elementu\">Obrázek na pozadí captchy</span>
      </label>
      <label class=\"f-file w-700\">
        <span class=\"nazev-elementu\">Cesta obrázku na pozadí captchy:</span>
        <input type=\"file\" name=\"obrazek\" id=\"pozadi_p2\" />
        <span class=\"popis-elementu block ow-h\">Formát obrázku je <strong>.jpg nebo .png</strong></span>
        <span class=\"popis-elementu block ow-h\"><img src=\"%%url%%\" alt=\"Obrázek na pozadí captchy\" /></span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Poloha obrázku na pozadí captchy v ose X:</span>
        <input type=\"text\" name=\"vyrez_x\" value=\"%%vyrez_x%%\" id=\"pozadi_p3\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Poloha obrázku na pozadí captchy v ose Y:</span>
        <input type=\"text\" name=\"vyrez_y\" value=\"%%vyrez_y%%\" id=\"pozadi_p4\" />
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_1();\"%%rotace_pismen_1_check%% />
        <span class=\"nazev-elementu\">Pevné natočení písmen</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Hodnota pevného natočení písma:</span>
        <input type=\"text\" name=\"rotace_pismen[0]\" value=\"%%rotace_pismen_0%%\" id=\"font_rotace_p1\" />
        <span class=\"popis-elementu\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_2();\"%%rotace_pismen_01_check%% />
        <span class=\"nazev-elementu\">Natočení písma v určitém rozsahu</span>
        <span class=\"popis-elementu cl-b\">Každé písmeno je jinak natočené v tebou určeném rozsahu.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální natočení písma v rozsahu:</span>
        <input type=\"text\" name=\"rotace_pismen[0]\" value=\"%%rotace_pismen_0%%\" id=\"font_rotace_p2\" />
        <span class=\"popis-elementu\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální natočení písma v rozsahu:</span>
        <input type=\"text\" name=\"rotace_pismen[1]\" value=\"%%rotace_pismen_1%%\" id=\"font_rotace_p3\" />
        <span class=\"popis-elementu\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"checkbox_mrizka\" onclick=\"mrizka(this.checked);\"%%mrizka_0_check%% />
        <span class=\"nazev-elementu\">Mřížka na captcha obrázku</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"mrizka[0]\" value=\"1\" id=\"mrizka_p1\"%%mrizka_1_check%% />
        <span class=\"nazev-elementu\">Mřížka ve tvaru [+]</span>
        <span class=\"popis-elementu cl-b\">Mřížka má standardní tvar.</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"mrizka[0]\" value=\"2\" id=\"mrizka_p2\"%%mrizka_2_check%% />
        <span class=\"nazev-elementu\">Mřížka ve tvaru [#]</span>
        <span class=\"popis-elementu cl-b\">Mřížka má standardní tvar, ale svislé čáry jsou nakloněny.</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"mrizka[0]\" value=\"3\" id=\"mrizka_p3\"%%mrizka_3_check%% />
        <span class=\"nazev-elementu\">Mřížka ve tvaru [X]</span>
        <span class=\"popis-elementu cl-b\">Mřížka má tvar písmene X.</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"mrizka[0]\" value=\"4\" id=\"mrizka_p4\"%%mrizka_4_check%% />
        <span class=\"nazev-elementu\">Mřížka ve tvaru [-]</span>
        <span class=\"popis-elementu cl-b\">Mřížka je jen vodorovně.</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"mrizka[0]\" value=\"5\" id=\"mrizka_p5\"%%mrizka_5_check%% />
        <span class=\"nazev-elementu\">Mřížka ve tvaru [|]</span>
        <span class=\"popis-elementu cl-b\">Mřížka je jen svisle.</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"mrizka[0]\" value=\"6\" id=\"mrizka_p6\"%%mrizka_6_check%% />
        <span class=\"nazev-elementu\">Mřížka ve tvaru [\]</span>
        <span class=\"popis-elementu cl-b\">Mřížka je jen svisle nakloněná zleva doprava (shora dolů).</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"mrizka[0]\" value=\"7\" id=\"mrizka_p7\"%%mrizka_7_check%% />
        <span class=\"nazev-elementu\">Mřížka ve tvaru [/]</span>
        <span class=\"popis-elementu cl-b\">Mřížka je jen svisle nakloněná zprava doleva (shora dolů).</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Rozestup mřížky v ose X:</span>
        <input type=\"text\" name=\"mrizka[1]\" value=\"%%mrizka_x%%\" id=\"mrizka_p8\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Rozestup mřížky v ose Y:</span>
        <input type=\"text\" name=\"mrizka[2]\" value=\"%%mrizka_y%%\" id=\"mrizka_p9\" />
        <span class=\"popis-elementu\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"f-checkbox w-500 m-b-3-i\">
        <input type=\"checkbox\" name=\"rand_dot\" onclick=\"rand(this.checked);\"%%rand_dot_check%% />
        <span class=\"nazev-elementu\">Generovat náhodné body v captcha obrázku</span>
      </label>
      <label class=\"f-checkbox w-500 m-b-3-i\">
        <input type=\"checkbox\" name=\"rand_line\" onclick=\"rand(this.checked);\"%%rand_line_check%% />
        <span class=\"nazev-elementu\">Generovat náhodné čáry v captcha obrázku</span>
      </label>
      <label class=\"f-checkbox w-500 m-b-3-i\">
        <input type=\"checkbox\" name=\"rand_rectangle\" onclick=\"rand(this.checked);\"%%rand_rectangle_check%% />
        <span class=\"nazev-elementu\">Generovat náhodné čtverce v captcha obrázku</span>
      </label>
      <label class=\"f-checkbox w-500 m-b-3-i\">
        <input type=\"checkbox\" name=\"rand_arc\" onclick=\"rand(this.checked);\"%%rand_arc_check%% />
        <span class=\"nazev-elementu\">Generovat náhodné polokruhy v captcha obrázku</span>
      </label>
      <label class=\"f-checkbox w-500\">
        <input type=\"checkbox\" name=\"rand_ellipse\" onclick=\"rand(this.checked);\"%%rand_ellipse_check%% />
        <span class=\"nazev-elementu\">Generovat náhodné elipsy v captcha obrázku</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_rand_koeficient\" id=\"rand_koeficient_rp1\" onclick=\"rand_koeficient_1();\"%%rand_koeficient_1_check%% />
        <span class=\"nazev-elementu\">Pevný počet objektů na písmeno</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[0]\" value=\"%%rand_koeficient_0%%\" id=\"rand_koeficient_p1\" />
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_rand_koeficient\" id=\"rand_koeficient_rp2\" onclick=\"rand_koeficient_2();\"%%rand_koeficient_01_check%% />
        <span class=\"nazev-elementu\">Náhodný počet objektů na písmeno v určitém rozsahu</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[0]\" value=\"%%rand_koeficient_0%%\" id=\"rand_koeficient_p2\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[1]\" value=\"%%rand_koeficient_1%%\" id=\"rand_koeficient_p3\" />
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_1();\"%%rand_barva_1_check%% />
        <span class=\"nazev-elementu\">Pevné nastavení barvy</span>
        <span class=\"popis-elementu cl-b\">Mřížka nebo náhodný objekt bude jednou barvou. Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <div class=\"w-700 cl-b\">
        <label class=\"f-text f-farbtastic w-195-i\">
          <span class=\"nazev-elementu\">Hodnota barvy v pevném nastavení:</span>
          <span class=\"farbtastic\" id=\"picker_color_p1\"></span>
          <input type=\"text\" name=\"rand_barva[0]\" value=\"%%rand_barva_0%%\" id=\"color_p1\" maxlength=\"7\" />
          <span class=\"popis-elementu\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
        </label>
      </div>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_2();\"%%rand_barva_01_check%% />
        <span class=\"nazev-elementu\">Nastavení barvy v určitém rozsahu</span>
        <span class=\"popis-elementu cl-b\">Mřížka nebo náhodný objekt bude barvou v určitém rozsahu (každá čára / část náhodného objektu bude jinou barvou, ovšem v tebou stanoveném rozsahu). Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <div class=\"w-700 cl-b\">
        <label class=\"f-text f-farbtastic w-195-i\">
          <span class=\"nazev-elementu\">Minimální hodnota barvy v určitém rozsahu:</span>
          <span class=\"farbtastic\" id=\"picker_color_p2\"></span>
          <input type=\"text\" name=\"rand_barva[0]\" value=\"%%rand_barva_0%%\" id=\"color_p2\" maxlength=\"7\" />
          <span class=\"popis-elementu\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
        </label>
      </div>
      <div class=\"w-700 cl-b\">
        <label class=\"f-text f-farbtastic w-195-i\">
          <span class=\"nazev-elementu\">Maximální hodnota barvy v určitém rozsahu:</span>
          <span class=\"farbtastic\" id=\"picker_color_p3\"></span>
          <input type=\"text\" name=\"rand_barva[1]\" value=\"%%rand_barva_1%%\" id=\"color_p3\" maxlength=\"7\" />
          <span class=\"popis-elementu\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
        </label>
      </div>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_3();\"%%rand_barva_10_check%% />
        <span class=\"nazev-elementu\">Náhodná barva</span>
        <span class=\"popis-elementu cl-b\">Mřížka nebo náhodný objekt bude náhodnou barvou (každá čára / část náhodného objektu bude náhodnou barvou). Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"f-submit\">
        <span class=\"f-submit-pattern\"><!-- --></span>
        <input type=\"submit\" name=\"tlacitko\" value=\"%%nazev%%\" />
      </label>
    </fieldset>
  </form>
</div>
<script type=\"text/javascript\">
  var disabledtrue = {
      'background-color': '#d3d3d3',
      'border-left-color': '#bebebe',
      'border-top-color': '#bebebe',
      'outline-color': '#b2b2b2',
      'color': '#b0b0b0'
    };
  var disabledfalse = {
      'background-color': '#f1f8fb',
      'border-left-color': '#e8eef1',
      'border-top-color': '#e8eef1',
      'outline-color': '#cfd8e0',
      'color': '#7c7c7c'
    };

  function with_height_1()
  {
    $('#width_height_p3').attr('disabled', true).css(disabledtrue);
    $('#width_height_p1, #width_height_p2').attr('disabled', false).css(disabledfalse);

  }
  function with_height_2()
  {
    $('#width_height_p1, #width_height_p2').attr('disabled', true).css(disabledtrue);
    $('#width_height_p3').attr('disabled', false).css(disabledfalse);
  }

  function font_size_1()
  {
    $('#font_size_p2, #font_size_p3').attr('disabled', true).css(disabledtrue);
    $('#font_size_p1').attr('disabled', false).css(disabledfalse);
  }
  function font_size_2()
  {
    $('#font_size_p1').attr('disabled', true).css(disabledtrue);
    $('#font_size_p2, #font_size_p3').attr('disabled', false).css(disabledfalse);
  }
  function font_color_1()
  {
    $('#font_color_p2, #font_color_p3').attr('disabled', true).css(disabledtrue);
    $('#font_color_p1').attr('disabled', false).css(disabledfalse);
  }
  function font_color_2()
  {
    $('#font_color_p1').attr('disabled', true).css(disabledtrue);
    $('#font_color_p2, #font_color_p3').attr('disabled', false).css(disabledfalse);
  }
  function pozadi_1()
  {
    $('#pozadi_p3, #pozadi_p4').attr('disabled', true).css(disabledtrue);
    $('#pozadi_p2').attr('disabled', true);
    $('#pozadi_p1').attr('disabled', false).css(disabledfalse);
  }
  function pozadi_2()
  {
    $('#pozadi_p3, #pozadi_p4').attr('disabled', false).css(disabledfalse);
    $('#pozadi_p2').attr('disabled', false);
    $('#pozadi_p1').attr('disabled', true).css(disabledtrue);
  }
  function font_rotace_1()
  {
    $('#font_rotace_p2, #font_rotace_p3').attr('disabled', true).css(disabledtrue);
    $('#font_rotace_p1').attr('disabled', false).css(disabledfalse);
  }
  function font_rotace_2()
  {
    $('#font_rotace_p1').attr('disabled', true).css(disabledtrue);
    $('#font_rotace_p2, #font_rotace_p3').attr('disabled', false).css(disabledfalse);
  }
  function mrizka(stav)
  {
    //$('#mrizka_p1').attr('checked', stav);
    $('#mrizka_p1, #mrizka_p2, #mrizka_p3, #mrizka_p4, #mrizka_p5, #mrizka_p6, #mrizka_p7, #mrizka_p8, #mrizka_p9').attr('disabled', stav);
    if (stav)
    {
      //$('#mrizka_p8').val(5);
      //$('#mrizka_p9').val(5);
    }
  }
  function rand(stav)
  {
    $('#rand_koeficient_rp1, #rand_koeficient_p1, #rand_koeficient_rp2, #rand_koeficient_p2, #rand_koeficient_p3').attr('disabled', stav);
    if (stav)
    {
      rand_koeficient_1();
    }
  }
  function rand_koeficient_1()
  {
    $('#rand_koeficient_p2, #rand_koeficient_p3').attr('disabled', true).css(disabledtrue);
    $('#rand_koeficient_p1').attr('disabled', false).css(disabledfalse);
  }
  function rand_koeficient_2()
  {
    $('#rand_koeficient_p2, #rand_koeficient_p3').attr('disabled', false).css(disabledfalse);
    $('#rand_koeficient_p1').attr('disabled', true).css(disabledtrue);
  }
  function color_1()
  {
    $('#color_p2, #color_p3').attr('disabled', true).css(disabledtrue);
    $('#color_p1').attr('disabled', false).css(disabledfalse);
  }
  function color_2()
  {
    $('#color_p2, #color_p3').attr('disabled', false).css(disabledfalse);
    $('#color_p1').attr('disabled', true).css(disabledtrue);
  }
  function color_3()
  {
    $('#color_p1, #color_p2, #color_p3').attr('disabled', true).css(disabledtrue);
  }
  %%funct_with_height%%
  %%func_font_size%%
  %%func_font_color%%
  %%func_background_color%%
  %%func_rotace_pismen%%
  %%func_mrizka%%
  %%func_rand%%
  %%func_rand_koeficient%%
  %%func_rand_barva%%
</script>\n",

                  "admin_vyber_typu" => "
<label class=\"f-select w-505\">
  <span class=\"nazev-elementu\">Hlavní typ captchy:</span>
  <select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+$(this).val()\">
    <option value=\"\">--- Vyber typ ---</option>
    %%2%%
  </select>
</label>
%%3%%",

                  "admin_vyber_typu_row" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vyber_typu_null" => "<span class=\"block nadpis-2 w-505 f-s-17 m-b-15 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není vybrán žádný typ</span>",

                  "admin_vyber_fontu" => "
      <label class=\"f-select w-505\">
        <span class=\"nazev-elementu\">Font:</span>
        <select name=\"font\">
          %%1%%
        </select>
      </label>\n",

                  "admin_vyber_fontu_row" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>\n",

                  "admin_vyber_fontu_null" => "<span class=\"block nadpis-2 w-505 f-s-17 m-b-15 p-t-10 p-b-10 t-a-c f-f-web-pro\">Není nahrán žádný font</span>",

                  "admin_vyber_typu_pismena_default" => array("small", 4),

                  "admin_vyber_typu_pismena" => "
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"small\"%%1%% />
        <span class=\"nazev-elementu\">Malá písmena</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"large\"%%2%% />
        <span class=\"nazev-elementu\">Velká písmena</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"smalllarge\"%%3%% />
        <span class=\"nazev-elementu\">Malá a velká písmena</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"number\"%%4%% />
        <span class=\"nazev-elementu\">Čísla</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"numbersmall\"%%5%% />
        <span class=\"nazev-elementu\">Čísla a malá písmena</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"numberlarge\"%%6%% />
        <span class=\"nazev-elementu\">Čísla a velká písmena</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"rand\"%%7%% />
        <span class=\"nazev-elementu\">Náhodně</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"special\"%%8%% />
        <span class=\"nazev-elementu\">Speciální znaky</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Počet písmen:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%9%%\" />
      </label>\n",

                  "admin_vyber_typu_priklady_default" => array("plus", 1, 20, 1, 20),

                  "admin_vyber_typu_priklady" => "
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"plus\"%%1%% />
        <span class=\"nazev-elementu\">Sčítání (+)</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"minus\"%%2%% />
        <span class=\"nazev-elementu\">Odečítání (-)</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"plusminus\"%%3%% />
        <span class=\"nazev-elementu\">Sčítání a odečítání (+ a -)</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"nasobeni\"%%4%% />
        <span class=\"nazev-elementu\">Násobení (*)</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"deleni\"%%5%% />
        <span class=\"nazev-elementu\">Dělení (/)</span>
        <span class=\"popis-elementu cl-b\">Jedná se o celočíselné dělení. Výsledek zaokrouhlen na tři desetinná místa.</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"nasobenideleni\"%%6%% />
        <span class=\"nazev-elementu\">Násobení a dělení (* a /)</span>
        <span class=\"popis-elementu cl-b\">Jedná se o celočíselné dělení. Výsledek zaokrouhlen na tři desetinná místa.</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"modulo\"%%7%% />
        <span class=\"nazev-elementu\">Zbytek po dělení (modulo)</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"mocniny\"%%8%% />
        <span class=\"nazev-elementu\">Mocniny (^)</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"odmocniny\"%%9%% />
        <span class=\"nazev-elementu\">Odmocniny (sqrt)</span>
        <span class=\"popis-elementu cl-b\">Výsledek zaokrouhlen na tři desetinná místa.</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"mocninyodmocniny\"%%10%% />
        <span class=\"nazev-elementu\">Mocniny a odmocniny (^ a sqrt)</span>
        <span class=\"popis-elementu cl-b\">Výsledek zaokrouhlen na tři desetinná místa.</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"rand\"%%11%% />
        <span class=\"nazev-elementu\">Náhodný příklad</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální hodnota prvního čísla:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%12%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální hodnota prvního čísla:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%13%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální hodnota druhého čísla:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%14%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální hodnota druhého čísla:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%15%%\" />
      </label>\n",

                  "admin_vyber_typu_rimske_default" => array("arabrim", 1, 200),

                  "admin_vyber_typu_rimske" => "
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"arabrim\"%%1%% />
        <span class=\"nazev-elementu\">Z arabských do římských</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"rimarab\"%%2%% />
        <span class=\"nazev-elementu\">Z římských do arabských</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"rand\"%%3%% />
        <span class=\"nazev-elementu\">Náhodná kombinace</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální hodnota čísla:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%4%%\" />
        <span class=\"popis-elementu\">Minimální hodnota je <strong>1</strong>.</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální hodnota čísla:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%5%%\" />
        <span class=\"popis-elementu\">Maximální hodnota je <strong>3999</strong>.</span>
      </label>\n",

                  "admin_vyber_typu_vlastni_default" => array(1, "", ""),

                  "admin_vyber_typu_vlastni" => "
  <script type=\"text/javascript\">
    var poc = %%1%%;
    function PridejHodnotu()
    {
      poc++;
      VykresliHodnotu();
    }

    function OdeberHodnotu()
    {
      poc--;
      VykresliHodnotu();
    }

    function NastavHodnotu(typ, id, text)
    {
      switch (typ)
      {
        case 0:
          pole_klic[id] = text;
        break;

        case 1:
          pole_hodnota[id] = text;
        break;
      }
    }

    var pole_klic = ['%%2%%'];
    var pole_hodnota = ['%%3%%'];
    function VykresliHodnotu()
    {
      var obsah = '';
      var poradi;
      var element;
      for (i = 0; i < poc; i++)
      {
        poradi = i + 1;
        element = \"<label class='f-text w-500 m-b-5-i'><span class='nazev-elementu'>Otázka [\"+poradi+\"]:</span><input type='text' name='konfigurace[]' onchange='NastavHodnotu(0, \"+i+\", this.value)' value='\"+(pole_klic[i] != null ? pole_klic[i] : '')+\"' /></label><label class='f-text w-500 m-b-20-i'><span class='nazev-elementu'>Odpověď [\"+poradi+\"]:</span><input type='text' name='konfigurace[]' onchange='NastavHodnotu(1, \"+i+\", this.value)' value='\"+(pole_hodnota[i] != null ? pole_hodnota[i] : '')+\"' /></label>\";

        if (poradi == poc && poradi > 1)
        {
          element += \"<a href='#' onclick='OdeberHodnotu(); return false;' title='Odebrat položku' class='odkaz-odebrat odkaz-1 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u'>Odebrat položku</a>\";
        }
        obsah = obsah + element;
      }

      $(function() {
        $('#polozky').html(obsah);
        $('.pocethodnot').html(poc);
        $('.pochodnot').val(poc);
      });
    }

    VykresliHodnotu();
  </script>
      <p class=\"ow-h\">
        <span class=\"block f-f-web-pro m-b-6\">Počet položek: <strong class=\"no-b u pocethodnot\"></strong></span>
        <a href=\"#\" onclick=\"PridejHodnotu(); return false;\" title=\"Přidat položku\" class=\"block fl-l odkaz-1 m-b-4 p-r-3 p-l-3 f-s-14 f-f-web-pro l-h-22 no-u\">Přidat položku</a>
        <input type=\"hidden\" class=\"pochodnot\" name=\"konfigurace[]\" />
      </p>
      <div id=\"polozky\" class=\"f-text w-500 pos-rel obal-odkazy-pridat-odebrat m-b-0-i\"></div>\n",

                  "admin_vyber_typu_prevody_default" => array("bindec", 0, 64),

                  "admin_vyber_typu_prevody" => "
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"bindec\"%%1%% />
        <span class=\"nazev-elementu\">Z Bin do Dec</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"binoct\"%%2%% />
        <span class=\"nazev-elementu\">Z Bin do Oct</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"binhex\"%%3%% />
        <span class=\"nazev-elementu\">Z Bin do Hex</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"octdec\"%%4%% />
        <span class=\"nazev-elementu\">Z Oct do Dec</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"octbin\"%%5%% />
        <span class=\"nazev-elementu\">Z Oct do Bin</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"octhex\"%%6%% />
        <span class=\"nazev-elementu\">Z Oct do Hex</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"hexdec\"%%7%% />
        <span class=\"nazev-elementu\">Z Hex do Dec</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"hexoct\"%%8%% />
        <span class=\"nazev-elementu\">Z Hex do Oct</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"hexbin\"%%9%% />
        <span class=\"nazev-elementu\">Z Hex do Bin</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"decbin\"%%10%% />
        <span class=\"nazev-elementu\">Z Dec do Bin</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"decoct\"%%11%% />
        <span class=\"nazev-elementu\">Z Dec do Oct</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"dechex\"%%12%% />
        <span class=\"nazev-elementu\">Z Dec do Hex</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"rand\"%%13%% />
        <span class=\"nazev-elementu\">Náhodná kombinace</span>
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Minimální hodnota:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%14%%\" />
      </label>
      <label class=\"f-text w-500\">
        <span class=\"nazev-elementu\">Maximální hodnota:</span>
        <input type=\"text\" name=\"konfigurace[]\" value=\"%%15%%\" />
      </label>\n",

                  "admin_vyber_typu_barvy_default" => array("hexrgb"),

                  "admin_vyber_typu_barvy" => "
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"hexrgb\"%%1%% />
        <span class=\"nazev-elementu\">Z Hex do RGB</span>
      </label>
      <label class=\"f-radiobutton w-500 m-b-3-i\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"rgbhex\"%%2%% />
        <span class=\"nazev-elementu\">Z RGB do Hex</span>
      </label>
      <label class=\"f-radiobutton w-500\">
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"rand\"%%3%% />
        <span class=\"nazev-elementu\">Náhodná kombinace</span>
      </label>\n",
/*
                  "admin_vyber_typu_derivace_default" => array(),

                  "admin_vyber_typu_derivace" => "
coming soon...
      <label class=\"input_text\">
        <span>Nahodne:</span>
        <input type=\"radio\" name=\"konfigurace[typ]\" value=\"rand\"%%3%% />
      </label>
coming soon...

f(x)=a (0)
f(x)=sin x (cos x)
f(x)=cos x (-sin x)
f(x)=x^n (n*x^n-1)
f(x)=ln x (1/x)
f(x)=e^x (e^x)

f(x)=sin x+cos x (cos x-sin x)
f(x)=sin x*cos x (cos x*cos x-sin x*sin x) (cos 2x)

ee Příklad na určitou derivaci o libovolnem X [počet]
                  ",
*/

                  "set_typkodu" => array ("pismena" => array ("Písmena / čísla / speciální znaky",
                                                              "small" => "Malá písmena",
                                                              "large" => "Velká písmena",
                                                              "smalllarge" => "Malá a velká písmena",
                                                              "number" => "Čísla",
                                                              "numbersmall" => "Čísla a malá písmena",
                                                              "numberlarge" => "Čísla a velká písmena",
                                                              "rand" => "Náhodně",
                                                              "special" => "Speciální znaky",
                                                              ),

                                          "priklady" => array("Příklady",
                                                              "plus" => "Sčítání (+)",
                                                              "minus" => "Odečítání (-)",
                                                              "plusminus" => "Sčítání a odečítání (+ a -)",
                                                              "nasobeni" => "Násobení (*)",
                                                              "deleni" => "Dělení (/)",
                                                              "nasobenideleni" => "Násobení a dělení (* a /)",
                                                              "modulo" => "Zbytek po dělení (modulo)",
                                                              "mocniny" => "Mocniny (^)",
                                                              "odmocniny" => "Odmocniny (sqrt)",
                                                              "mocninyodmocniny" => "Mocniny a odmocniny (^ a sqrt)",
                                                              "rand" => "Náhodný příklad",
                                                              ),

                                          "rimske" => array("Převody mezi arabskými a římskými číslicemi",
                                                            "arabrim" => "Z arabských do římských",
                                                            "rimarab" => "Z římských do arabských",
                                                            "rand" => "Náhodná kombinace",
                                                            ),

                                          "vlastni" => array("Vlastní možnosti otázek a odpovědí"),

                                          "prevody" => array ("Převádění jednotek",
                                                              "bindec" => "Z Bin do Dec",
                                                              "binoct" => "Z Bin do Oct",
                                                              "binhex" => "Z Bin do Hex",
                                                              "octdec" => "Z Oct do Dec",
                                                              "octbin" => "Z Oct do Bin",
                                                              "octhex" => "Z Oct do Hex",
                                                              "hexdec" => "Z Hex do Dec",
                                                              "hexoct" => "Z Hex do Oct",
                                                              "hexbin" => "Z Hex do Bin",
                                                              "decbin" => "Z Dec do Bin",
                                                              "decoct" => "Z Dec do Oct",
                                                              "dechex" => "Z Dec do Hex",
                                                              "rand" => "Náhodná kombinace",
                                                              ),

                                          "barvy" => array ("Převádění barev",
                                                            "hexrgb" => "Z Hex do RGB",
                                                            "rgbhex" => "Z RGB do Hex",
                                                            "rand" => "Náhodná kombinace",
                                                            ),
/*
                                          "derivace" => array("Vyšší matika s derivacema",
                                                              "" => "",
                                                              "" => "",),
*/
                                          ),


                  "admin_nahoda_priklady_plus" => "%%1%%+%%2%%",

                  "admin_nahoda_priklady_minus" => "%%1%%-%%2%%",


                  "admin_nahoda_priklady_nasobeni" => "%%1%%*%%2%%",

                  "admin_nahoda_priklady_deleni" => "%%1%%/%%2%%",

                  "admin_nahoda_priklady_modulo" => "%%1%% mod %%2%%",


                  "admin_nahoda_priklady_mocniny" => "%%1%%^%%2%%",

                  "admin_nahoda_priklady_odmocniny" => "%%1%%√%%2%%",


                  "admin_nahoda_prevody_bindec" => "Bin(%%1%%)=>Dec",

                  "admin_nahoda_prevody_binoct" => "Bin(%%1%%)=>Oct",

                  "admin_nahoda_prevody_binhex" => "Bin(%%1%%)=>Hex",


                  "admin_nahoda_prevody_octdec" => "Oct(%%1%%)=>Dec",

                  "admin_nahoda_prevody_octbin" => "Oct(%%1%%)=>Bin",

                  "admin_nahoda_prevody_octhex" => "Oct(%%1%%)=>Hex",


                  "admin_nahoda_prevody_hexdec" => "Hex(%%1%%)=>Dec",

                  "admin_nahoda_prevody_hexoct" => "Hex(%%1%%)=>Oct",

                  "admin_nahoda_prevody_hexbin" => "Hex(%%1%%)=>Bin",


                  "admin_nahoda_prevody_decbin" => "Dec(%%1%%)=>Bin",

                  "admin_nahoda_prevody_decoct" => "Dec(%%1%%)=>Oct",

                  "admin_nahoda_prevody_dechex" => "Dec(%%1%%)=>Hex",


                  "admin_nahoda_barvy_hexrgb" => "#%%1%%=>R,G,B",

                  "admin_nahoda_barvy_rgbhex" => "R,G,B:%%1%%=>#Hex",


                  //"admin_slovo_inexamrgbhex" => "#%%1%%",

                  //"admin_captcha_examrandder" => "y'=(%%1%%x^%%2%%)%%3%%%%4%%, x=%%5%%",


                  "set_defaultpic" => "default",

                  "set_barva_pozadi" => "#fff",

                  "set_barva_fontu" => "#000",

                  "set_nahled_size" => 14,

                  "set_nahled_text" => "a b c d e f g h i j k l m n o p q r s t u v w x y z\n\n0 1 2 3 4 5 6 7 8 9  + - * / ^ √\n\nA B C D E F G H I J K L M N O P Q R S T U V W X Y Z\n\ně š č ř ž ý á í é ú ů ! ? ( )\n\nĚ Š Č Ř Ž Ý Á Í É Ú Ů",

                  "set_nahled_padding" => array(10, 10, 10, 10),

                  "set_nahled_zalomit" => 60,

                  );

  return $result;
?>
