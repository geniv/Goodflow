<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Galerie bez sekcí",
                                              "title" => "Galerie bez sekcí",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_obsah_caption" => "
  <li%%7%%>
    <a href=\"%%1%%\" title=\"%%3%%\" onclick=\"return hs.expand(this)\">
      <img src=\"%%2%%\" alt=\"%%3%%\" />
    </a>
    <span class=\"highslide-caption\">%%3%%</span>
  </li>          ",

                  "normal_vypis_null_caption" => "\n<li>žádná položka</li>",

                  "normal_vypis_prvni_caption" => "prvni",

                  "normal_vypis_posledni_caption" => "posledni",

                  "normal_vypis_ente_def_array_caption" => array(1, 2, 5),

                  "normal_vypis_ente_def_caption" => "aktivni",

                  "normal_vypis_ente_od_caption" => 1,

                  "normal_vypis_ente_po_caption" => 4,

                  "normal_vypis_ente_caption" => " class=\"pravy\"",

                  "normal_vypis_obsah_heading" => "
  <li%%7%%>
    <a href=\"%%1%%\" title=\"%%3%%\" onclick=\"return hs.expand(this)\">
      <img src=\"%%2%%\" alt=\"%%3%%\" />
    </a>
    <span class=\"highslide-heading\">%%3%%</span>
  </li>          ",

                  "normal_vypis_null_heading" => "\n<li>žádná položka</li>",

                  "normal_vypis_prvni_heading" => "prvni",

                  "normal_vypis_posledni_heading" => "posledni",

                  "normal_vypis_ente_def_array_heading" => array(1, 2, 5),

                  "normal_vypis_ente_def_heading" => "aktivni",

                  "normal_vypis_ente_od_heading" => 1,

                  "normal_vypis_ente_po_heading" => 4,

                  "normal_vypis_ente_heading" => " class=\"pravy\"",

                  "admin_vypis_adres" => "<span><a href=\"%%1%%\" title=\"%%2%%\">Přidat obrázek do skupiny: <strong>%%2%%</strong></a> <em>[ve skupině je <strong>%%3%%</strong> obrázků]</em></span>",

                  "admin_vypis_adres_null" => "žádná položka",

                  "admin_dragndrop_null" => "žádná položka",

                  "admin_vypis_obsah_null" => "žádná položka",

                  "admin_obsah" => "
<div class=\"galerie_bez_sekci\">
  <h3>Výpis skupin s obrázky</h3>
  <p class=\"odkaz_pridat\">%%1%%<span class=\"odkaz_vpravo\"><a href=\"%%2%%\" title=\"Řazení obrázků\">Řazení obrázků</a></span></p>
  <p class=\"odkaz_pridat_skupinu\">%%3%%</p>
%%4%%
</div>\n",

                  "admin_edit_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl upraven obrázek: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet obrázků navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_del_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl smazán obrázek: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet obrázků navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_vypis_obsah_begin" => "začátek admin skupny: %%1%%<br />",

                  "admin_vypis_obsah" => "
<ul>
  <li>[%%1%%] - %%4%%</li>
  <li class=\"adresa_skupiny\">Adresa skupiny: <strong>%%3%%</strong><em>Datum vytvoření obrázku: <strong>%%2%%</strong></em></li>
  <li class=\"poradi_odkazy_obrazku\">
    <span class=\"zarovnani_vlevo\"><a href=\"%%8%%\" title=\"Upravit obrázek\">Upravit obrázek</a> - <a href=\"%%9%%\" title=\"Smazat obrázek\" onclick=\"return confirm('Opravdu chceš smazat obrázek: &quot;%%4%%&quot; ?');\">Smazat obrázek</a></span>
    <span class=\"zarovnani_vpravo\">Pořadí obrázku ve skupině: %%5%%</span>
  </li>
  <li class=\"obrazek_nahled\">
    <a href=\"%%6%%\" title=\"%%4%%\" onclick=\"return hs.expand(this)\">
      <img src=\"%%7%%\" alt=\"%%4%%\" />
    </a>
    <span class=\"highslide-caption\">%%4%%</span>
  </li>
</ul>\n",

                  "admin_vypis_obsah_end" => "konec admin skupny: %%1%%<br />",

                  "admin_config" => "
<div class=\"nastaveni_galerie_bez_sekci\">
  <h3>Nastavení skupinové galerie bez sekcí</h3>
  <p class=\"backlink_galerie\"><a href=\"%%1%%\" title=\"Zpět na výpis skupin s obrázky\">Zpět na výpis skupin s obrázky</a></p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"nadpis_sekce_galerie\">
        <span>Nastavení miniatury</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%2%% name=\"mini\" onclick=\"mini_1();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka miniatury [width]:</span>
        <input type=\"text\" name=\"w_mini\" id=\"mini1_p1\" value=\"%%3%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%4%% name=\"mini\" onclick=\"mini_2();\" />
      </label>
      <label class=\"input_text\">
        <span>Výška miniatury [height]:</span>
        <input type=\"text\" name=\"h_mini\" id=\"mini2_p1\" value=\"%%5%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%6%% name=\"mini\" onclick=\"mini_3();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka miniatury [width]:</span>
        <input type=\"text\" name=\"w_mini\" id=\"mini3_p1\" value=\"%%3%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška miniatury [height]:</span>
        <input type=\"text\" name=\"h_mini\" id=\"mini3_p2\" value=\"%%5%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Vlastní miniatura:</span>
        <input type=\"radio\"%%7%% name=\"mini\" onclick=\"mini_4();\" />
      </label>
      <label class=\"nadpis_sekce_galerie\">
        <span>Nastavení plného náhledu</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%8%% name=\"full\" onclick=\"full_1();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"w_full\" id=\"full1_p1\" value=\"%%9%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%10%% name=\"full\" onclick=\"full_2();\" />
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"h_full\" id=\"full2_p1\" value=\"%%11%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_3();\" />
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"w_full\" id=\"full3_p1\" value=\"%%9%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"h_full\" id=\"full3_p2\" value=\"%%11%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_radio\">
        <span>Originální velikost:</span>
        <input type=\"radio\"%%13%% name=\"full\" onclick=\"full_4();\" />
        <span class=\"galerie_dodatek\">Ponechá velikost obrázku zjištěnou při nahrávání.</span>
      </label>
      <label class=\"input_text\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"w_full\" id=\"full4_p1\" value=\"0\" disabled=\"disabled\" />
        <span class=\"galerie_dodatek\">Tato položka má informativní účel. Nuly znamenají automatické zjištění velikosti obrázku při jeho nahrávání.</span>
      </label>
      <label class=\"input_text\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"h_full\" id=\"full4_p2\" value=\"0\" disabled=\"disabled\" />
        <span class=\"galerie_dodatek\">Tato položka má informativní účel. Nuly znamenají automatické zjištění velikosti obrázku při jeho nahrávání.</span>
      </label>
      <label class=\"nadpis_sekce_galerie\">
        <span>Nastavení limitu nahrávání</span>
      </label>
      <label class=\"input_radio\">
        <span>Limit nahrávání obrázku:</span>
        <input type=\"radio\"%%14%% name=\"lim\" onclick=\"lim_1();\" />
      </label>
      <label class=\"input_text\">
        <span>Hodnota limitu nahrávání obrázku:</span>
        <input type=\"text\" name=\"limit\" id=\"lim_p1\" value=\"%%15%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [MB].</span>
      </label>
      <label class=\"input_radio\">
        <span>Neomezený limit nahrávání obrázku:</span>
        <input type=\"radio\"%%16%% name=\"lim\" onclick=\"lim_2();\" />
        <span class=\"galerie_dodatek\">Při tomto nastavení je limit omezen jen výchozím nastavením PHP konfigurace.</span>
      </label>
      <label class=\"nadpis_sekce_galerie\">
        <span>Nastavení řazení obrázků</span>
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle data [A -> Z, 0 -> 9]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"1\"%%17%% />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle data [Z -> A, 9 -> 0]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"2\"%%18%% />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle pořadí přidání [0 -> 9]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"3\"%%19%% />
      </label>
      <label class=\"input_radio\">
        <span>Řazení podle pořadí přidání [9 -> 0]:</span>
        <input type=\"radio\" name=\"razeni\" value=\"4\"%%20%% />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Uložit nastavení\" />
      </label>
    </fieldset>
  </form>
</div>

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

  %%21%%
  %%22%%
  %%23%%
</script>\n",

                  "admin_config_save" => "
<div class=\"central_absolutni central_info\">
  <p>
    Bylo upraveno nastavení galerie
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_input_poradi" => "
      <label class=\"input_text\">
        <span>Pořadí obrázku:</span>
        <input type=\"text\" name=\"poradi\" value=\"%%1%%\" />
      </label>\n",

                  "admin_add" => "
<div class=\"nastaveni_galerie_bez_sekci pridat_upravit_obrazek_galerie_bez_sekci\">
  <h3>Přidat obrázek do skupiny <strong>%%1%%</strong></h3>
  <p class=\"backlink_galerie\"><a href=\"%%18%%\" title=\"Zpět na výpis skupin s obrázky\">Zpět na výpis skupin s obrázky</a></p>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Adresa skupiny:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%1%%\"%%19%% />
        <span class=\"galerie_dodatek\">Povinná položka. Pokud je tato položka vyplněná, tak slouží jen k informativním účelům.</span>
      </label>
      <label class=\"input_text popis_obrazku\">
        <span>Popis obrázku:</span>
        <input type=\"text\" name=\"popisek\" />
        <span class=\"galerie_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_file\">
        <span>Obrázek v plném rozlišení:</span>
        <input type=\"file\" name=\"obrazek\" />
        <span class=\"galerie_dodatek\">Povinná položka. Nastavení pro obrázek v plném rozlišení je uvedeno níže.</span>
      </label>
      <label class=\"input_text\">
        <span>Datum přidání obrázku:</span>
        <input type=\"text\" name=\"datum\" value=\"%%2%%\"%%19%% />
        <span class=\"galerie_dodatek\">Povinná položka. Při úpravě musíš zachovat formát data i času ve kterém je zapsaný !</span>
      </label>
%%3%%
      <label class=\"nadpis_sekce_galerie\">
        <span>Nastavení miniatury</span>
      </label>
      <label class=\"input_radio%%20%%\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%8%% name=\"mini\" onclick=\"mini_1();\" />
      </label>
      <label class=\"input_radio%%20%%\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%9%% name=\"mini\" onclick=\"mini_2();\" />
      </label>
      <label class=\"input_radio%%20%%\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%10%% name=\"mini\" onclick=\"mini_3();\" />
      </label>
      <label class=\"input_radio\">
        <span>Vlastní miniatura:</span>
        <input type=\"radio\"%%11%% name=\"mini\" onclick=\"mini_4();\" />
      </label>
      <label class=\"input_text%%20%%\">
        <span>Šířka miniatury [width]:</span>
        <input type=\"text\" name=\"w_mini\" id=\"mini_p1\" value=\"%%4%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text%%20%%\">
        <span>Výška miniatury [height]:</span>
        <input type=\"text\" name=\"h_mini\" id=\"mini_p2\" value=\"%%5%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_file\">
        <span>Obrázek miniatury:</span>
        <input type=\"file\" name=\"mini_obrazek\" id=\"mini_p3\" />
        <span class=\"galerie_dodatek\">Povinná položka jen pokud je nastavena vlastní miniatura.</span>
      </label>
      <label class=\"nadpis_sekce_galerie\">
        <span>Nastavení plného náhledu</span>
      </label>
      <label class=\"input_radio%%20%%\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%12%% name=\"full\" onclick=\"full_1();\" />
      </label>
      <label class=\"input_radio%%20%%\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%13%% name=\"full\" onclick=\"full_2();\" />
      </label>
      <label class=\"input_radio%%20%%\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%14%% name=\"full\" onclick=\"full_3();\" />
      </label>
      <label class=\"input_radio\">
        <span>Originální velikost:</span>
        <input type=\"radio\"%%15%% name=\"full\" onclick=\"full_4();\" />
        <span class=\"galerie_dodatek\">Ponechá velikost obrázku zjištěnou při nahrávání.</span>
      </label>
      <label class=\"input_text%%20%%\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"w_full\" id=\"full_p1\" value=\"%%6%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text%%20%%\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"h_full\" id=\"full_p2\" value=\"%%7%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat obrázek\" />
      </label>
    </fieldset>
  </form>
</div>

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

  %%16%%
  %%17%%
</script>\n",

                  "admin_add_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl nahrán obrázek: \"<strong>%%1%%</strong>\"
  </p>
  <p>
    Počet obrázků navíc: \"<strong>%%2%%</strong>\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_edit" => "
<div class=\"nastaveni_galerie_bez_sekci pridat_upravit_obrazek_galerie_bez_sekci\">
  <h3>Upravit obrázek ve skupině <strong>%%1%%</strong></h3>
  <p class=\"backlink_galerie\"><a href=\"%%21%%\" title=\"Zpět na výpis skupin s obrázky\">Zpět na výpis skupin s obrázky</a></p>
  <form method=\"post\" enctype=\"multipart/form-data\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Adresa skupiny:</span>
        <input type=\"text\" name=\"adresa\" value=\"%%1%%\"%%22%% />
        <span class=\"galerie_dodatek\">Povinná položka. Pokud je tato položka vyplněná, tak slouží jen k informativním účelům.</span>
      </label>
      <label class=\"input_text popis_obrazku\">
        <span>Popis obrázku:</span>
        <input type=\"text\" name=\"popisek\" value=\"%%2%%\" />
        <span class=\"galerie_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_file\">
        <span>Obrázek v plném rozlišení:</span>
        <input type=\"file\" name=\"obrazek\" />
        <span class=\"galerie_dodatek\">Povinná položka. Nastavení pro obrázek v plném rozlišení je uvedeno níže.</span>
        <a href=\"%%4%%\" title=\"%%2%%\" onclick=\"return hs.expand(this)\">
          <img src=\"%%3%%\" alt=\"%%2%%\" />
        </a>
      </label>
      <label class=\"input_text\">
        <span>Datum přidání obrázku:</span>
        <input type=\"text\" name=\"datum\" value=\"%%5%%\"%%22%% />
        <span class=\"galerie_dodatek\">Povinná položka. Při úpravě musíš zachovat formát data i času ve kterém je zapsaný !</span>
      </label>
%%6%%
      <label class=\"nadpis_sekce_galerie\">
        <span>Nastavení miniatury</span>
      </label>
      <label class=\"input_radio%%23%%\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%11%% name=\"mini\" onclick=\"mini_1();\">
      </label>
      <label class=\"input_radio%%23%%\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%12%% name=\"mini\" onclick=\"mini_2();\">
      </label>
      <label class=\"input_radio%%23%%\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%13%% name=\"mini\" onclick=\"mini_3();\">
      </label>
      <label class=\"input_radio\">
        <span>Vlastní miniatura:</span>
        <input type=\"radio\"%%14%% name=\"mini\" onclick=\"mini_4();\">
      </label>
      <label class=\"input_text%%23%%\">
        <span>Šířka miniatury [width]:</span>
        <input type=\"text\" name=\"w_mini\" id=\"mini_p1\" value=\"%%7%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text%%23%%\">
        <span>Výška miniatury [height]:</span>
        <input type=\"text\" name=\"h_mini\" id=\"mini_p2\" value=\"%%8%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_file\">
        <span>Obrázek miniatury:</span>
        <input type=\"file\" name=\"mini_obrazek\" id=\"mini_p3\" />
        <span class=\"galerie_dodatek\">Povinná položka jen pokud je nastavena vlastní miniatura.</span>
      </label>
      <label class=\"nadpis_sekce_galerie\">
        <span>Nastavení plného náhledu</span>
      </label>
      <label class=\"input_radio%%23%%\">
        <span>Dopočítávat výšku:</span>
        <input type=\"radio\"%%15%% name=\"full\" onclick=\"full_1();\" />
      </label>
      <label class=\"input_radio%%23%%\">
        <span>Dopočítávat šířku:</span>
        <input type=\"radio\"%%16%% name=\"full\" onclick=\"full_2();\" />
      </label>
      <label class=\"input_radio%%23%%\">
        <span>Pevná velikost:</span>
        <input type=\"radio\"%%17%% name=\"full\" onclick=\"full_3();\" />
      </label>
      <label class=\"input_radio\">
        <span>Originální velikost:</span>
        <input type=\"radio\"%%18%% name=\"full\" onclick=\"full_4();\" />
        <span class=\"galerie_dodatek\">Ponechá velikost obrázku zjištěnou při nahrávání.</span>
      </label>
      <label class=\"input_text%%23%%\">
        <span>Šířka plného náhledu [width]:</span>
        <input type=\"text\" name=\"w_full\" id=\"full_p1\" value=\"%%9%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"input_text%%23%%\">
        <span>Výška plného náhledu [height]:</span>
        <input type=\"text\" name=\"h_full\" id=\"full_p2\" value=\"%%10%%\" />
        <span class=\"galerie_dodatek\">Jednotky jsou v [px].</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit obrázek\" />
      </label>
    </fieldset>
  </form>
</div>

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

  %%19%%
  %%20%%
</script>\n",

                  "admin_dragndrop_begin" => "
<script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-1.3.2.min.js\"></script>
<script type=\"text/javascript\" src=\"%%1%%%%2%%/jquery-ui-1.7.1.custom.min.js\"></script>
<div class=\"razeni_galerie_bez_sekci\">
  <h3>Řazení obrázků metodou <strong>drag and drop</strong></h3>
  <p class=\"odkaz_vpravo\"><a href=\"%%3%%\" title=\"Zpět na výpis skupin s obrázky\">Zpět na výpis skupin s obrázky</a></p>
<script type=\"text/javascript\">
  $(document).ready(function(){
    $(function() {
      $(\"#obal_razeni ul\").sortable({ opacity: 0.6, cursor: 'move', update: function() {
        var order = $(this).sortable(\"serialize\") + '&action=updateRecordsListings';
        $.post(\"%%1%%%%2%%/ajax_form.php\", order, function(theResponse){
          $(\"#status_drag\").html(theResponse);
          setTimeout(\"SchovejHlasku()\", 2000);
        });
        ZobrazHlasku();
      }
      });
    });
  });

  function ZobrazHlasku()
  {
    $(document).ready(function(){
      $(\"#status_drag\").fadeIn(\"slow\");
    });
  }

  function SchovejHlasku()
  {
    $(document).ready(function(){
      $(\"#status_drag\").fadeOut(\"slow\");
    });
  }
</script>
<div id=\"obal_razeni\">
<ul>\n",

                  "admin_dragndrop_group_begin" => "  <li class=\"zacatek_skupiny\">Skupina: <strong>%%1%%</strong></li>\n",

                  "admin_dragndrop" => "
  <li class=\"obrazek_razeni\" id=\"recordsArray_%%1%%\">
    <img src=\"%%5%%\" alt=\"%%3%%\" />
    <span>[%%1%%] - [%%7%%], %%3%%</span>
  </li>\n",

                  "admin_dragndrop_group_end" => "  <li class=\"konec_skupiny\"><!-- --></li>\n",

                  "admin_dragndrop_end" => "
</ul>
</div>
<div id=\"status_drag\"></div>
</div>\n",

                  "ajax_update_records_listings" => "Byl proveden přesun mezi položkami: %%1%% a %%2%%",

                  "admin_datum_tvar" => "j.n.Y H:i:s",

                  "set_pathpicture" => "picture",

                  "set_minidir" => "mini",

                  "set_fulldir" => "full",

                  "set_conffile" => ".config_file",

                  "set_povolit_pridani" => true,

                  "admin_obsah_config_link" => "<a href=\"%%1%%\" title=\"Přidat skupinu s obrázkem\">Přidat skupinu s obrázkem</a><span class=\"odkaz_vpravo\">&nbsp;-&nbsp;<a href=\"%%2%%\" title=\"Nastavení galerie\">Nastavení galerie</a></span>",

                  "admin_addedit_visible" => " neaktivni_polozka",

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
