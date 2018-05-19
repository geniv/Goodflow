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

                  "admin_vypis_typu_select_begin" => "<select name=\"typ_kodu\">",

                  "admin_vypis_typu_select" => "<option value=\"%%1%%\"%%2%%>%%3%%</option>",

                  "admin_vypis_typu_select_end" => "</select>",

                  "admin_vypis_fontu_select_begin" => "<select name=\"font\">",

                  "admin_vypis_fontu_select" => "<option value=\"%%1%%\"%%2%%>[%%1%%] %%3%%</option>",

                  "admin_vypis_fontu_select_end" => "</select>",

                  "admin_vypis_fontu_select_null" => "<strong>Není nahraný žádný fonty !</strong>",

                  "admin_obsah" => "
<div class=\"captcha_obrazky\">
  <script type=\"text/javascript\" src=\"script/jquery/jquery-132-yui.js\"></script>
  <script type=\"text/javascript\" src=\"script/jquery/toolstooltip-102-yui.js\"></script>
  <script type=\"text/javascript\" src=\"script/jquery/jquery.tooltip.admin.js\"></script>
  <h3>Výpis fontů a položek captchy</h3>
  <p class=\"odkazy_captcha\">
    <a href=\"%%1%%\" title=\"Přidat font\" class=\"pridat_font\">Přidat font</a>
    <a href=\"%%2%%\" title=\"Přidat captcha obrázek\">Přidat captcha obrázek</a>
  </p>
%%3%%
</div>\n",

                  "admin_vypis_obsah_font" => "
<ul>
  <li class=\"nazev_captcha\"><em class=\"prvni_em\">[%%1%%]</em> <span class=\"font_%%5%%\"><!-- --></span><span class=\"tooltip\">Font:<br /><strong>%%2%%</strong><br />%%5%%</span><em>%%2%%</em></li>
  <li class=\"odkazy_captcha_editace\"><a href=\"%%8%%\" title=\"Přidat captcha obrázek s fontem: %%2%%\">Přidat captchu s fontem <strong>%%2%%</strong></a> - <a href=\"%%6%%\" title=\"Upravit font: %%2%%\">Upravit</a> - <a href=\"%%7%%\" title=\"Smazat font: %%2%%\" onclick=\"return confirm('Opravdu chceš smazat font &quot;%%2%%&quot; ?');\">Smazat</a></li>
  <li class=\"cesta_font_captcha\">%%3%%</li>
  <li><img src=\"%%4%%\" alt=\"%%2%%\" title=\"%%2%%\" /></li>
</ul>\n",

                  "admin_vypis_obsah_font_obsah" => "<div class=\"captcha_polozky\">\n",

                  "admin_vypis_obsah" => "
<ul>
  <li class=\"nazev_captcha\"><em class=\"prvni_em\">[%%1%%]</em><em>(%%7%%)</em><em>%%3%%</em></li>
  <li class=\"odkazy_captcha_editace\"><a href=\"%%10%%\" title=\"Upravit captcha obrázek s id: %%1%%\">Upravit</a> - <a href=\"%%11%%\" title=\"Smazat captcha obrázek s id: %%1%%\" onclick=\"return confirm('Opravdu chceš smazat captcha obrázek s id &quot;%%1%%&quot; ?');\">Smazat</a></li>
  <li class=\"cesta_font_captcha\">%%2%%</li>
</ul>\n",

                  "admin_vypis_obsah_end" => "</div>\n",

                  "admin_add" => "
<div class=\"captcha_obrazek_pridat_upravit\">
  <h3>Přidat captcha obrázek</h3>
  <p class=\"backlink_captcha\"><a href=\"%%3%%\" title=\"Zpět na výpis fontů a položek captchy\">Zpět na výpis fontů a položek captchy</a></p>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label class=\"input_select\">
        <span>Typ captchy:</span>
        %%1%%
      </label>
      <label class=\"input_text\">
        <span>Otázka captchy:</span>
        <input type=\"text\" name=\"otazka\" />
        <span class=\"captcha_dodatek\">Povinná položka pro přidání s výchozím nastavením.</span>
      </label>
      <label class=\"input_text\">
        <span>Počet písmen v captche:</span>
        <input type=\"text\" name=\"pocet\" value=\"4\" />
        <span class=\"captcha_dodatek\">Funguje jen na obrázková čísla a písmena.<br />Ve výběru typu captchy je označeno [počet].</span>
      </label>
      <label class=\"input_text\">
        <span>Počátek písmen v ose X:</span>
        <input type=\"text\" name=\"x\" value=\"10\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Počátek písmen v ose Y:</span>
        <input type=\"text\" name=\"y\" value=\"30\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Šířka captcha obrázku [width]:</span>
        <input type=\"text\" name=\"width\" value=\"450\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška captcha obrázku [height]:</span>
        <input type=\"text\" name=\"height\" value=\"45\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_select\">
        <span>Typ písma [font]:</span>
        %%2%%
      </label>
      <label class=\"input_text\">
        <span>Rozteč písma:</span>
        <input type=\"text\" name=\"roztec\" value=\"20\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost písma:</span>
        <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_1();\" checked=\"checked\" />
      </label>
      <label class=\"input_text\">
        <span>Hodnota pevné velikosti písma:</span>
        <input type=\"text\" name=\"size[0]\" value=\"14\" id=\"font_size_p1\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Velikost písma v určeném rozsahu:</span>
        <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_2();\" />
        <span class=\"captcha_dodatek\">Každé písmeno má jinou velikost v tebou určeném rozsahu.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální velikost rozsahu písma:</span>
        <input type=\"text\" name=\"size[0]\" value=\"12\" id=\"font_size_p2\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální velikost rozsahu písma:</span>
        <input type=\"text\" name=\"size[1]\" value=\"16\" id=\"font_size_p3\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná barva písma:</span>
        <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_1();\" checked=\"checked\" />
      </label>
      <label class=\"input_text\">
        <span>Barva písma [#]:</span>
        <input type=\"text\" name=\"font_color[0]\" value=\"000\" id=\"font_color_p1\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Barva písma v určeném rozsahu:</span>
        <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_2();\" />
        <span class=\"captcha_dodatek\">Každé písmeno má jinou barvu v tebou určeném rozsahu.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální barva písma v rozsahu [#]:</span>
        <input type=\"text\" name=\"font_color[0]\" value=\"eee\" id=\"font_color_p2\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální barva písma v rozsahu [#]:</span>
        <input type=\"text\" name=\"font_color[1]\" value=\"fff\" id=\"font_color_p3\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná barva pozadí captcha obrázku:</span>
        <input type=\"radio\" name=\"radio_pozadi\" onclick=\"pozadi_1();\" checked=\"checked\" />
      </label>
      <label class=\"input_text\">
        <span>Barva pozadí [#]:</span>
        <input type=\"text\" name=\"pozadi\" value=\"fff\" id=\"pozadi_p1\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Obrázek na pozadí captchy:</span>
        <input type=\"radio\" name=\"radio_pozadi\" onclick=\"pozadi_2();\" />
      </label>
      <label class=\"input_file\">
        <span>Cesta obrázku na pozadí captchy:</span>
        <input type=\"file\" name=\"obrazek\" id=\"pozadi_p2\" />
        <span class=\"captcha_dodatek\">Formát obrázku je <strong>.jpg nebo .png</strong></span>
      </label>
      <label class=\"input_text\">
        <span>Poloha obrázku na pozadí captchy v ose X:</span>
        <input type=\"text\" name=\"vyrez_x\" value=\"0\" id=\"pozadi_p3\" />
      </label>
      <label class=\"input_text\">
        <span>Poloha obrázku na pozadí captchy v ose Y:</span>
        <input type=\"text\" name=\"vyrez_y\" value=\"0\" id=\"pozadi_p4\" />
      </label>
      <label class=\"input_radio\">
        <span>Pevné natočení písmen:</span>
        <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_1();\" checked=\"checked\" />
      </label>
      <label class=\"input_text\">
        <span>Hodnota pevného natočení písma:</span>
        <input type=\"text\" name=\"font_rotace[0]\" value=\"0\" id=\"font_rotace_p1\" />
        <span class=\"captcha_dodatek\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"input_radio\">
        <span>Natočení písma v určitém rozsahu:</span>
        <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_2();\" />
        <span class=\"captcha_dodatek\">Každé písmeno je jinak natočené v tebou určeném rozsahu.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální natočení písma v rozsahu:</span>
        <input type=\"text\" name=\"font_rotace[0]\" value=\"-20\" id=\"font_rotace_p2\" />
        <span class=\"captcha_dodatek\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální natočení písma v rozsahu:</span>
        <input type=\"text\" name=\"font_rotace[1]\" value=\"20\" id=\"font_rotace_p3\" />
        <span class=\"captcha_dodatek\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Mřížka na captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_mrizka\" onclick=\"mrizka(this.checked);\" />
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [+]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"1\" id=\"mrizka_p1\" />
        <span class=\"captcha_dodatek\">Mřížka má standardní tvar.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [#]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"2\" id=\"mrizka_p2\" />
        <span class=\"captcha_dodatek\">Mřížka má standardní tvar, ale svislé čáry jsou nakloněny.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [X]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"3\" id=\"mrizka_p3\" />
        <span class=\"captcha_dodatek\">Mřížka má tvar písmene X.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [-]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"4\" id=\"mrizka_p4\" />
        <span class=\"captcha_dodatek\">Mřížka je jen vodorovně.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [|]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"5\" id=\"mrizka_p5\" />
        <span class=\"captcha_dodatek\">Mřížka je jen svisle.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [\]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"6\" id=\"mrizka_p6\" />
        <span class=\"captcha_dodatek\">Mřížka je jen svisle nakloněná zleva doprava (shora dolů).</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [/]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"7\" id=\"mrizka_p7\" />
        <span class=\"captcha_dodatek\">Mřížka je jen svisle nakloněná zprava doleva (shora dolů).</span>
      </label>
      <label class=\"input_text\">
        <span>Rozestup mřížky v ose X:</span>
        <input type=\"text\" name=\"mrizka[0]\" value=\"5\" id=\"mrizka_p8\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Rozestup mřížky v ose Y:</span>
        <input type=\"text\" name=\"mrizka[1]\" value=\"5\" id=\"mrizka_p9\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné body v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_dot\" onclick=\"rand(this.checked);\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné čáry v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_line\" onclick=\"rand(this.checked);\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné čtverce v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_restangle\" onclick=\"rand(this.checked);\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné polokruhy v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_arc\" onclick=\"rand(this.checked);\" />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné elipsy v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_ellipse\" onclick=\"rand(this.checked);\" />
      </label>
      <label class=\"input_radio\">
        <span>Pevný počet objektů na písmeno:</span>
        <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp1\" onclick=\"rand_koeficient_1();\" checked=\"checked\" />
      </label>
      <label class=\"input_text\">
        <span>Počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[0]\" value=\"1\" id=\"rand_koeficient_p1\" />
      </label>
      <label class=\"input_radio\">
        <span>Náhodný počet objektů na písmeno v určitém rozsahu:</span>
        <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp2\" onclick=\"rand_koeficient_2();\" />
      </label>
      <label class=\"input_text\">
        <span>Minimální počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[0]\" value=\"1\" id=\"rand_koeficient_p2\" />
      </label>
      <label class=\"input_text\">
        <span>Maximální počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[1]\" value=\"4\" id=\"rand_koeficient_p3\" />
      </label>
      <label class=\"input_radio\">
        <span>Pevné nastavení barvy:</span>
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_1();\" checked=\"checked\" />
        <span class=\"captcha_dodatek\">Mřížka nebo náhodný objekt bude jednou barvou.<br />Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"input_text\">
        <span>Hodnota barvy v pevném nastavení:</span>
        <input type=\"text\" name=\"color[0]\" value=\"ccc\" id=\"color_p1\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Nastavení barvy v určitém rozsahu:</span>
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_2();\" />
        <span class=\"captcha_dodatek\">Mřížka nebo náhodný objekt bude barvou v určitém rozsahu (každá čára / část náhodného objektu bude jinou barvou, ovšem v tebou stanoveném rozsahu).<br />Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální hodnota barvy v určitém rozsahu:</span>
        <input type=\"text\" name=\"color[0]\" value=\"aaa\" id=\"color_p2\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální hodnota barvy v určitém rozsahu:</span>
        <input type=\"text\" name=\"color[1]\" value=\"ccc\" id=\"color_p3\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Náhodná barva:</span>
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_3();\" />
        <span class=\"captcha_dodatek\">Mřížka nebo náhodný objekt bude náhodnou barvou (každá čára / část náhodného objektu bude náhodnou barvou).<br />Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat captcha obrázek\" />
      </label>
    </fieldset>
  </form>
</div>

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

  function pozadi_1()
  {
    document.getElementById('pozadi_p1').disabled = false;
    document.getElementById('pozadi_p2').disabled = true;
    document.getElementById('pozadi_p3').disabled = true;
    document.getElementById('pozadi_p4').disabled = true;
  }

  function pozadi_2()
  {
    document.getElementById('pozadi_p1').disabled = true;
    document.getElementById('pozadi_p2').disabled = false;
    document.getElementById('pozadi_p3').disabled = false;
    document.getElementById('pozadi_p4').disabled = false;
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
  pozadi_1();
  font_rotace_1();
  mrizka(false);
  rand(false);
  color_1();
</script>\n",

                  "admin_add_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přidán captcha obrázek: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet fontů navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_edit" => "
<div class=\"captcha_obrazek_pridat_upravit\">
  <h3>Upravit captcha obrázek</h3>
  <p class=\"backlink_captcha\"><a href=\"%%60%%\" title=\"Zpět na výpis fontů a položek captchy\">Zpět na výpis fontů a položek captchy</a></p>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label class=\"input_select\">
        <span>Typ captchy:</span>
        %%1%%
      </label>
      <label class=\"input_text\">
        <span>Otázka captchy:</span>
        <input type=\"text\" name=\"otazka\" value=\"%%2%%\" />
        <span class=\"captcha_dodatek\">Povinná položka pro přidání s výchozím nastavením.</span>
      </label>
      <label class=\"input_text\">
        <span>Počet písmen v captche:</span>
        <input type=\"text\" name=\"pocet\" value=\"%%3%%\" />
        <span class=\"captcha_dodatek\">Funguje jen na obrázková čísla a písmena.<br />Ve výběru typu captchy je označeno [počet].</span>
      </label>
      <label class=\"input_text\">
        <span>Počátek písmen v ose X:</span>
        <input type=\"text\" name=\"x\" value=\"%%4%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Počátek písmen v ose Y:</span>
        <input type=\"text\" name=\"y\" value=\"%%5%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Šířka captcha obrázku [width]:</span>
        <input type=\"text\" name=\"width\" value=\"%%6%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška captcha obrázku [height]:</span>
        <input type=\"text\" name=\"height\" value=\"%%7%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_select\">
        <span>Typ písma [font]:</span>
        %%8%%
      </label>
      <label class=\"input_text\">
        <span>Rozteč písma:</span>
        <input type=\"text\" name=\"roztec\" value=\"%%9%%\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost písma:</span>
        <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_1();\"%%10%% />
      </label>
      <label class=\"input_text\">
        <span>Hodnota pevné velikosti písma:</span>
        <input type=\"text\" name=\"size[0]\" value=\"%%11%%\" id=\"font_size_p1\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Velikost písma v určeném rozsahu:</span>
        <input type=\"radio\" name=\"radio_font_size\" onclick=\"font_size_2();\"%%12%% />
        <span class=\"captcha_dodatek\">Každé písmeno má jinou velikost v tebou určeném rozsahu.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální velikost rozsahu písma:</span>
        <input type=\"text\" name=\"size[0]\" value=\"%%11%%\" id=\"font_size_p2\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální velikost rozsahu písma:</span>
        <input type=\"text\" name=\"size[1]\" value=\"%%13%%\" id=\"font_size_p3\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná barva písma:</span>
        <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_1();\"%%14%% />
      </label>
      <label class=\"input_text\">
        <span>Barva písma [#]:</span>
        <input type=\"text\" name=\"font_color[0]\" value=\"%%15%%\" id=\"font_color_p1\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Barva písma v určeném rozsahu:</span>
        <input type=\"radio\" name=\"radio_font_color\" onclick=\"font_color_2();\"%%16%% />
        <span class=\"captcha_dodatek\">Každé písmeno má jinou barvu v tebou určeném rozsahu.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální barva písma v rozsahu [#]:</span>
        <input type=\"text\" name=\"font_color[0]\" value=\"%%15%%\" id=\"font_color_p2\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální barva písma v rozsahu [#]:</span>
        <input type=\"text\" name=\"font_color[1]\" value=\"%%17%%\" id=\"font_color_p3\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná barva pozadí captcha obrázku:</span>
        <input type=\"radio\" name=\"radio_pozadi\" onclick=\"pozadi_1();\"%%18%% />
      </label>
      <label class=\"input_text\">
        <span>Barva pozadí [#]:</span>
        <input type=\"text\" name=\"pozadi\" value=\"%%19%%\" id=\"pozadi_p1\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Obrázek na pozadí captchy:</span>
        <input type=\"radio\" name=\"radio_pozadi\" onclick=\"pozadi_2();\"%%20%% />
      </label>
      <label class=\"input_file\">
        <span>Cesta obrázku na pozadí captchy:</span>
        <input type=\"file\" name=\"obrazek\" id=\"pozadi_p2\" />
        <img src=\"%%21%%\" alt=\"Obrázek na pozadí captchy\" />
        <span class=\"captcha_dodatek\">Formát obrázku je <strong>.jpg nebo .png</strong></span>
      </label>
      <label class=\"input_text\">
        <span>Poloha obrázku na pozadí captchy v ose X:</span>
        <input type=\"text\" name=\"vyrez_x\" value=\"%%22%%\" id=\"pozadi_p3\" />
      </label>
      <label class=\"input_text\">
        <span>Poloha obrázku na pozadí captchy v ose Y:</span>
        <input type=\"text\" name=\"vyrez_y\" value=\"%%23%%\" id=\"pozadi_p4\" />
      </label>
      <label class=\"input_radio\">
        <span>Pevné natočení písmen:</span>
        <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_1();\"%%24%% />
      </label>
      <label class=\"input_text\">
        <span>Hodnota pevného natočení písma:</span>
        <input type=\"text\" name=\"font_rotace[0]\" value=\"%%25%%\" id=\"font_rotace_p1\" />
        <span class=\"captcha_dodatek\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"input_radio\">
        <span>Natočení písma v určitém rozsahu:</span>
        <input type=\"radio\" name=\"radio_font_rotace\" onclick=\"font_rotace_2();\"%%26%% />
        <span class=\"captcha_dodatek\">Každé písmeno je jinak natočené v tebou určeném rozsahu.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální natočení písma v rozsahu:</span>
        <input type=\"text\" name=\"font_rotace[0]\" value=\"%%25%%\" id=\"font_rotace_p2\" />
        <span class=\"captcha_dodatek\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální natočení písma v rozsahu:</span>
        <input type=\"text\" name=\"font_rotace[1]\" value=\"%%27%%\" id=\"font_rotace_p3\" />
        <span class=\"captcha_dodatek\">Zadej hodnotu natočení písma. Pro natočení na opačnou stranu použij zápornou hodnotu.</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Mřížka na captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_mrizka\" onclick=\"mrizka(this.checked);\"%%28%% />
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [+]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"1\" id=\"mrizka_p1\"%%29%% />
        <span class=\"captcha_dodatek\">Mřížka má standardní tvar.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [#]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"2\" id=\"mrizka_p2\"%%30%% />
        <span class=\"captcha_dodatek\">Mřížka má standardní tvar, ale svislé čáry jsou nakloněny.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [X]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"3\" id=\"mrizka_p3\"%%31%% />
        <span class=\"captcha_dodatek\">Mřížka má tvar písmene X.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [-]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"4\" id=\"mrizka_p4\"%%32%% />
        <span class=\"captcha_dodatek\">Mřížka je jen vodorovně.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [|]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"5\" id=\"mrizka_p5\"%%33%% />
        <span class=\"captcha_dodatek\">Mřížka je jen svisle.</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [\]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"6\" id=\"mrizka_p6\"%%34%% />
        <span class=\"captcha_dodatek\">Mřížka je jen svisle nakloněná zleva doprava (shora dolů).</span>
      </label>
      <label class=\"input_radio\">
        <span>Mřížka ve tvaru [/]:</span>
        <input type=\"radio\" name=\"radio_mrizka\" value=\"7\" id=\"mrizka_p7\"%%35%% />
        <span class=\"captcha_dodatek\">Mřížka je jen svisle nakloněná zprava doleva (shora dolů).</span>
      </label>
      <label class=\"input_text\">
        <span>Rozestup mřížky v ose X:</span>
        <input type=\"text\" name=\"mrizka[0]\" value=\"%%36%%\" id=\"mrizka_p8\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Rozestup mřížky v ose Y:</span>
        <input type=\"text\" name=\"mrizka[1]\" value=\"%%37%%\" id=\"mrizka_p9\" />
        <span class=\"captcha_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné body v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_dot\" onclick=\"rand(this.checked);\"%%38%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné čáry v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_line\" onclick=\"rand(this.checked);\"%%39%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné čtverce v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_restangle\" onclick=\"rand(this.checked);\"%%40%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné polokruhy v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_arc\" onclick=\"rand(this.checked);\"%%41%% />
      </label>
      <label class=\"input_checkbox\">
        <span>Generovat náhodné elipsy v captcha obrázku:</span>
        <input type=\"checkbox\" name=\"checkbox_rand_ellipse\" onclick=\"rand(this.checked);\"%%42%% />
      </label>
      <label class=\"input_radio\">
        <span>Pevný počet objektů na písmeno:</span>
        <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp1\" onclick=\"rand_koeficient_1();\"%%43%% />
      </label>
      <label class=\"input_text\">
        <span>Počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[0]\" value=\"%%44%%\" id=\"rand_koeficient_p1\" />
      </label>
      <label class=\"input_radio\">
        <span>Náhodný počet objektů na písmeno v určitém rozsahu:</span>
        <input type=\"radio\" name=\"radio_rand_koeficient\"id=\"rand_koeficient_rp2\" onclick=\"rand_koeficient_2();\"%%45%% />
      </label>
      <label class=\"input_text\">
        <span>Minimální počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[0]\" value=\"%%44%%\" id=\"rand_koeficient_p2\" />
      </label>
      <label class=\"input_text\">
        <span>Maximální počet objektů na písmeno:</span>
        <input type=\"text\" name=\"rand_koeficient[1]\" value=\"%%46%%\" id=\"rand_koeficient_p3\" />
      </label>
      <label class=\"input_radio\">
        <span>Pevné nastavení barvy:</span>
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_1();\"%%47%% />
        <span class=\"captcha_dodatek\">Mřížka nebo náhodný objekt bude jednou barvou.<br />Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"input_text\">
        <span>Hodnota barvy v pevném nastavení:</span>
        <input type=\"text\" name=\"color[0]\" value=\"%%48%%\" id=\"color_p1\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Nastavení barvy v určitém rozsahu:</span>
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_2();\"%%49%% />
        <span class=\"captcha_dodatek\">Mřížka nebo náhodný objekt bude barvou v určitém rozsahu (každá čára / část náhodného objektu bude jinou barvou, ovšem v tebou stanoveném rozsahu).<br />Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"input_text\">
        <span>Minimální hodnota barvy v určitém rozsahu:</span>
        <input type=\"text\" name=\"color[0]\" value=\"%%48%%\" id=\"color_p2\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_text\">
        <span>Maximální hodnota barvy v určitém rozsahu:</span>
        <input type=\"text\" name=\"color[1]\" value=\"%%50%%\" id=\"color_p3\" maxlength=\"6\" />
        <span class=\"captcha_dodatek\">Zadej barvu v Hex. Můžeš použít plný i zkrácený tvar [xxxxxx] i [xxx].</span>
      </label>
      <label class=\"input_radio\">
        <span>Náhodná barva:</span>
        <input type=\"radio\" name=\"radio_color\" onclick=\"color_3();\"%%51%% />
        <span class=\"captcha_dodatek\">Mřížka nebo náhodný objekt bude náhodnou barvou (každá čára / část náhodného objektu bude náhodnou barvou).<br />Platí pro mřížku i pro náhodné objekty.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit captcha obrázek\" />
      </label>
    </fieldset>
  </form>
</div>

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

  function pozadi_1()
  {
    document.getElementById('pozadi_p1').disabled = false;
    document.getElementById('pozadi_p2').disabled = true;
    document.getElementById('pozadi_p3').disabled = true;
    document.getElementById('pozadi_p4').disabled = true;
  }

  function pozadi_2()
  {
    document.getElementById('pozadi_p1').disabled = true;
    document.getElementById('pozadi_p2').disabled = false;
    document.getElementById('pozadi_p3').disabled = false;
    document.getElementById('pozadi_p4').disabled = false;
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

  %%52%%
  %%53%%
  %%54%%
  %%55%%
  %%56%%
  %%57%%
  %%58%%
  %%59%%
</script>\n",

                  "admin_edit_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven captcha obrázek: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet fontů navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_del_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán captcha obrázek: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet fontů navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_addfont" => "
<div class=\"captcha_pridat_upravit_font\">
  <h3>Přidat font</h3>
  <p class=\"backlink_captcha\"><a href=\"%%1%%\" title=\"Zpět na výpis fontů a položek captchy\">Zpět na výpis fontů a položek captchy</a></p>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Název fontu:</span>
        <input type=\"text\" name=\"nazev\" />
      </label>
      <label class=\"input_file\">
        <span>Cesta fontu:</span>
        <input type=\"file\" name=\"font\" />
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

                  "set_typkodu" => array ("Text (malá písmena) [počet]",
                                          "Text (velká písmena) [počet]",
                                          "Text (náhodná kombinace malých a velkých písmen) [počet]",
                                          "Číslo [počet]",
                                          "Text a číslo (malá písmena) [počet]",
                                          "Text a číslo (velká písmena) [počet]",
                                          "Text a číslo (náhodná kombinace malých a velkých písmen) [počet]",
                                          "Příklad (sčítání) (+)",
                                          "Příklad (odčítání) (-)",
                                          "Příklad (sčítání a odčítání) (+&amp;-)",
                                          "Příklad (krácení) (*)",
                                          "Příklad (náhodná kombinace +&amp;-&amp;*)",
                                          "Příklad (mocnina)",
                                          "Příklad (převod Bin -> Dec) [počet]",
                                          "Příklad (převod Dec -> Bin) (od 0 do: [počet])",
                                          "Příklad (převod Oct -> Dec) [počet]",
                                          "Příklad (převod Dec -> Oct) (od 0 do: [počet])",
                                          "Příklad (převod Hex -> Dec) [počet]",
                                          "Příklad (převod Dec -> Hex) (od 0 do: [počet])",
                                          "Příklad (náhodná kombinace všech převodů) [počet][od 0 do 100]",
                                          "Příklad (převod barvy Hex->RGB)",
                                          "Příklad (převod barvy RGB->Hex)",
                                          "Příklad (náhodná kombinace převodů RGB &amp; Hex)"
                                          ),
                  
                  "admin_slovo_lower" => "abcdefghijklmnopqrstuvwxyz",

                  "admin_slovo_upper" => "ABCDEFGHIJKLMNOPQRSTUVWXYZ",

                  "admin_slovo_num" => "0123456789",

                  "admin_slovo_bin" => "01",

                  "admin_slovo_hex" => "0123456789ABCDEF",

                  "admin_slovo_oct" => "01234567",

                  "admin_slovo_znamenka" => "+-*",

                  "admin_slovo_implode" => ",",

                  "admin_captcha_7" => "%%1%%+%%2%%",

                  "admin_captcha_8" => "%%1%%-%%2%%",

                  "admin_captcha_9" => "%%1%%%%2%%%%3%%",

                  "admin_captcha_10" => "%%1%%*%%2%%",

                  "admin_captcha_11" => "%%1%%%%2%%%%3%%",

                  "admin_captcha_12" => "%%1%%^%%2%%",

                  "admin_captcha_13" => "Bin(%%1%%)=>Dec",

                  "admin_captcha_14" => "Dec(%%1%%)=>Bin",

                  "admin_captcha_15" => "Oct(%%1%%)=>Dec",

                  "admin_captcha_16" => "Dec(%%1%%)=>Oct",

                  "admin_captcha_17" => "Hex(%%1%%)=>Dec",

                  "admin_captcha_18" => "Dec(%%1%%)=>Hex",

                  //19 si sama prepina mezi 13-18

                  "admin_captcha_20" => "#%%1%%=>RGB",

                  "admin_captcha_21" => "RGB:%%1%%=>#Hex",
                  
                  "admin_slovo_in21" => "#%%1%%",

                  "set_defaultpic" => "default",

                  "set_barva_pozadi" => "fff",

                  "set_barva_fontu" => "000",

                  "set_nahled_size" => 12,

                  "set_nahled_text" => "abcdefghijklmnopqrstuvwxyz                          0123456789 +-*^                                     ABCDEFGHIJKLMNOPQRSTUVWXYZ",

                  "set_nahled_zalomit" => 26,

                  "set_nahled_height_letter" => 18,

                  "set_nahled_width_letter" => 18,

                  "set_prepis" => array("\xc3\xa1" => "a",
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
                                        "đ" => "d"),

                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
