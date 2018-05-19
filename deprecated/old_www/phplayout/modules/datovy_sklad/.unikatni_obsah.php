<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Úložiště souborů",
                                              "title" => "Úložiště souborů",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => false),
                                        ),

                  "admin_obsah" => "
<div class=\"datovy_sklad_prepinani_vypisu\">
  <a href=\"%%1%%\" title=\"Stromový výpis\" class=\"stromovy_vypis%%5%%\"></a>
  <a href=\"%%2%%\" title=\"Hierarchický výpis\" class=\"hierarchicky_vypis%%6%%\"></a>
  <a href=\"%%3%%\" title=\"Dlaždicový výpis\" class=\"dlazdicovy_vypis%%7%%\"></a>
</div>\n%%4%%\n",

                  "admin_obsah_aktivni" => " aktivni",

                  "admin_obsah_tree" => "
<div class=\"datovy_sklad\">
  <h3>Výpis souborů a složek v úložišti</h3>
  <div class=\"datovy_sklad_slozka datovy_sklad_slozka_koren\">
    <p class=\"slozka\">
      <span class=\"ikona_slozky ikona_slozky_koren\" title=\"Kořenová složka\"><!-- --></span>
      <span class=\"nazev_slozky\">
        Kořenová složka
      </span>
      <em>
        <a href=\"%%1%%\" title=\"Vytvořit složku v kořenu\">Vytvořit složku v kořenu</a>
      </em>
      <em class=\"odkazy_pridat\">
        <a href=\"%%2%%\" title=\"Přidat soubor do kořenu\" class=\"odkaz_vpravo\">Přidat soubor do kořenu</a>
      </em>
      <span class=\"pocet_slozek_souboru\">
        <strong>%%4%%</strong>.složek, <strong>%%5%%</strong>. souborů
      </span>
    </p>
  </div>
%%3%%
</div>\n",

                  "admin_obsah_lefttree" => "
<div class=\"datovy_sklad_hierarchie_vypis\">
  <h3>Výpis souborů a složek v úložišti</h3>
%%3%%
</div>\n",

                  "admin_obsah_classic" => "
<div class=\"datovy_sklad_os_vypis\">
  <h3>Výpis souborů a složek v úložišti</h3>
%%3%%
</div>\n",

                  "admin_add_dir" => "
<div class=\"datovy_sklad_add_edit_dir\">
  <h3>Vytvořit složku</h3>
  <p>
    <a href=\"%%1%%\" title=\"Zpět do výpisu složek a souborů\">Zpět do výpisu složek a souborů</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Název složky:</span>
        <input type=\"text\" name=\"nazev\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Vytvořit složku\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_add_dir_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla vytvořena složka: \"%%1%%\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_edit_dir" => "
<div class=\"datovy_sklad_add_edit_dir\">
  <h3>Upravit název složky</h3>
  <p>
    <a href=\"%%2%%\" title=\"Zpět do výpisu složek a souborů\">Zpět do výpisu složek a souborů</a>
  </p>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Název složky:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%1%%\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit název složky\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_edit_dir_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byla přejmenována složka: \"%%1%%\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_del_dir_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Složka: \"%%1%%\" byla smazána !
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_add_file" => "
<div class=\"datovy_sklad_add_edit_file\">
  <h3>Přidat soubor</h3>
  <p>
    <a href=\"%%1%%\" title=\"Zpět do výpisu složek a souborů\">Zpět do výpisu složek a souborů</a>
  </p>
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\">
    <fieldset>
      <label>
        <span>Nahrát soubor:</span>
        <input type=\"file\" name=\"soubor\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat soubor\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_add_file_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl nahrán soubor: \"%%1%%\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_edit_file" => "
<div class=\"datovy_sklad_add_edit_file\">
  <h3>Upravit soubor</h3>
  <p>
    <a href=\"%%3%%\" title=\"Zpět do výpisu složek a souborů\">Zpět do výpisu složek a souborů</a>
  </p>
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\">
    <fieldset>
      <label>
        <span>Původní název souboru:</span>
        <em>%%1%%</em>
      </label>
      <label class=\"nazev_souboru\">
        <span>Název souboru:</span>
        <input type=\"text\" name=\"nazev\" value=\"%%2%%\" />
      </label>
      <label>
        <span>Znovu nahrát soubor:</span>
        <input type=\"file\" name=\"soubor\" />
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit soubor\" />
      </label>
    </fieldset>
  </form>
</div>\n",

                  "admin_edit_file_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Soubor byl znovu nahrán: \"%%1%%\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_del_file_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Soubor: \"%%1%%\" byl smazán !
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_edit_rename_file_hlaska" => "
<div class=\"central_absolutni central_info\">
  <p>
    Byl přejmenován soubor: \"%%1%%\"
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_vypis_obsah_dir_adddir" => "<a href=\"%%1%%\" title=\"Vytvořit složku ve složce &quot;%%2%%&quot;\">Vytvořit podsložku</a>",

                  "admin_vypis_obsah_dir" => "
<div class=\"datovy_sklad_slozka\">
  <p class=\"slozka\" style=\"margin-left: %%1%%px;\">
    <span class=\"ikona_slozky ikona_slozky_%%9%%\" title=\"Složka &quot;%%2%%&quot;\"><!-- --></span>
    <span class=\"nazev_slozky\">
      %%2%%
    </span>
    <em>
      <a href=\"%%6%%\" title=\"Upravit složku &quot;%%2%%&quot;\">Upravit složku</a>
      <a href=\"%%7%%\" title=\"Smazat složku &quot;%%2%%&quot;\" onclick=\"return confirm('Opravdu chceš smazat složku &quot;%%2%%&quot; ?');\">Smazat složku</a>
    </em>
    <em class=\"odkazy_pridat\">
      <a href=\"%%4%%\" title=\"Přidat soubor do složky &quot;%%2%%&quot;\">Přidat soubor</a>
      %%5%%
    </em>
    <span class=\"pocet_slozek_souboru\">
      <strong>%%10%%</strong>.složek, <strong>%%11%%</strong>. souborů, <strong>%%3%%</strong>. zanoření
    </span>
  </p>
%%8%%
</div>\n",

                  "admin_vypis_obsah_file" => "
<div class=\"datovy_sklad_soubor\">
  <p class=\"soubor\" style=\"margin-left: %%1%%px;\">
    <span class=\"ikona_souboru\">
      %%10%%
      <img src=\"%%11%%\" alt=\"Soubor &quot;%%2%%&quot;\" title=\"Soubor &quot;%%2%%&quot;\" />
    </span>
    <span class=\"nazev_souboru\">
      <a href=\"%%7%%\" title=\"%%2%%\">%%2%%</a>
    </span>
    <em>
      <a href=\"%%8%%\" title=\"Upravit soubor &quot;%%2%%&quot;\">Upravit soubor</a>
      <a href=\"%%9%%\" title=\"Smazat soubor &quot;%%2%%&quot;\" onclick=\"return confirm('Opravdu chceš smazat soubor &quot;%%2%%&quot; ?');\">Smazat soubor</a>
    </em>
    <em class=\"odkazy_relativni_absolutni\">
      <label>
        <strong>Relativní cesta:</strong>
        <input type=\"text\" value=\"%%7%%\" readonly=\"readonly\" />
      </label>
      <label>
        <strong>Absolutní cesta:</strong>
        <input type=\"text\" value=\"%%6%%%%7%%\" readonly=\"readonly\" />
      </label>
    </em>
    <span class=\"datum_velikost_souboru\">
      <strong>%%4%%</strong>, %%5%%, <strong>%%3%%</strong>. zanoření
    </span>
  </p>
</div>\n",

                  "admin_vypis_file_posledni" => " posledni_soubor",

                  "admin_vypis_dir_posledni" => " posledni_slozka",

                  "admin_vypis_datum" => "d.m.Y / H:i:s",

                  "admin_vypis_obsah_obr" => "<a href=\"%%1%%\" title=\"Náhled obrázku &quot;%%4%%&quot;\" onclick=\"return hs.expand(this)\"></a>", // style=\"width: %%2%%px; height: %%3%%px;\"

                  "admin_error_upload" => "
<div class=\"central_absolutni central_warning\">
  <p>
    Při nahrávání souboru se vyskytla chyba !
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_add_dir_max" => "
<div class=\"central_absolutni central_warning\">
  <p>
    Individuální nastavení pro tento web nedovoluje větší zanoření.
  </p>
</div>\n",

                  "admin_vypis_dane_slozky_up" => "<a href=\"%%1%%\" title=\"O úroveň nahoru\" id=\"nahoru_uroven\"><!-- --></a>",

                  "admin_vypis_dane_slozky_addlink" => "  <a href=\"%%1%%\" title=\"Vytvořit složku ve složce &quot;%%2%%&quot;\" id=\"vytvorit_slozku\"></a>\n",

                  "admin_vypis_dane_slozky_dir_adddir" => "  <a href=\"%%1%%\" title=\"Vytvořit složku ve složce &quot;%%2%%&quot;\"></a>\n",

                  "admin_vypis_dane_slozky_dellink" => "
  <a href=\"%%1%%\" title=\"Upravit složku &quot;%%3%%&quot;\" id=\"upravit_slozku\"></a>
  <a href=\"%%2%%\" title=\"Smazat složku &quot;%%3%%&quot;\" onclick=\"return confirm('Opravdu chceš smazat složku &quot;%%3%%&quot; ?');\" id=\"smazat_slozku\"></a>\n",

                  "admin_vypis_dane_slozky_root" => "Kořenová složka",

                  "admin_vypis_dane_slozky_link" => "
<div id=\"odkazy_ovladani_slozky\">
  <a href=\"%%1%%\" title=\"Přidat soubor do složky &quot;%%4%%&quot;\" id=\"pridat_soubor\"></a>
%%2%%
%%3%%
</div>\n",

                  "admin_vypis_dane_slozky_dir" => "
<ul>
  <li>
    <a href=\"%%4%%\" title=\"%%2%%\" class=\"odkaz_slozka\">
      <span class=\"ikona_slozka ikona_slozky_%%11%%\"><!-- --></span>
      <em>%%2%%</em>
      <em class=\"pocet_slozek\">Počet složek: %%12%%</em>
      <em class=\"pocet_souboru\">Počet souborů: %%13%%</em>
    </a>
  </li>
</ul>\n",

                  "admin_vypis_dane_slozky_obr" => "<a href=\"%%1%%\" title=\"Náhled obrázku &quot;%%4%%&quot;\" onclick=\"return hs.expand(this)\" class=\"nahled_obrazku\"></a>",

                  "admin_vypis_dane_slozky_file" => "
<ul class=\"soubor\">
  <li>
    <a href=\"%%7%%\" title=\"%%2%%\" class=\"odkaz_soubor\">
      <img src=\"%%11%%\" alt=\"%%2%%\" />
      <em>%%2%%</em>
      <em class=\"pocet_slozek\">%%4%%</em>
      <em class=\"pocet_souboru\">%%5%% [%%3%%. zanoření]</em>
    </a>
    %%10%%
    <a href=\"%%8%%\" title=\"Upravit soubor &quot;%%2%%&quot;\" class=\"odkaz_upravit_soubor\"></a>
    <a href=\"%%9%%\" title=\"Smazat soubor &quot;%%2%%&quot;\" onclick=\"return confirm('Opravdu chceš smazat soubor &quot;%%2%%&quot; ?');\" class=\"odkaz_smazat_soubor\"></a>
  </li>
</ul>\n",

                  "admin_vypis_dane_slozky_empty" => "
<ul class=\"prazdna_slozka\">
  <li>
    Prázdná složka
  </li>
</ul>\n",

                  "admin_left_tree_polozka" => "%%1%%",

                  "admin_left_tree_obsah" => "
<div class=\"datovy_sklad_hierarchie_panel\">
<ul%%2%%>
  <li class=\"korenova_slozka\"><a href=\"%%1%%\" title=\"Kořenová složka\" class=\"ikona_slozka ikona_slozky_koren\"><!-- --></a><a href=\"%%1%%\" title=\"Kořenová složka\">Kořenová složka</a></li>
</ul>\n
  %%3%%
</div>
<div class=\"datovy_sklad_hierarchie_obsah\">
  %%4%%
</div>\n",

                  "admin_rekurzivni_tree_dir" => "
<ul%%3%%>
  <li style=\"margin-left: %%5%%px;\"><a href=\"%%1%%\" title=\"%%2%% (%%4%%. zanoření)\" class=\"ikona_slozka ikona_slozky_%%6%%\"><!-- --></a><a href=\"%%1%%\" title=\"%%2%% (%%4%%. zanoření)\">%%2%%</a></li>
</ul>\n", //  zan %%4%%, ods: %%5%%, sub dir: %%6%%

                  "admin_rekurzivni_tree_rek" => "%%2%%", // nepouzito vnořené ve složce: %%2%%<br />%%1%%

                  "admin_vypis_dane_slozky_nasobitel_odsazeni" => 70,

                  "admin_rekurzivni_tree_nasobitel_odsazeni" => 10,

                  "admin_rekurzivni_tree_aktivni" => " class=\"aktivni\"",

                  "admin_drobecky_root" => "<a href=\"%%1%%\" title=\"Kořenová složka\"%%2%%>Kořenová složka</a>",

                  "admin_drobecky_aktivni" => " class=\"aktivni\"",

                  "admin_drobecky_link" => "<a href=\"%%1%%\" title=\"%%2%%\"%%3%%>%%2%%</a>",

                  "admin_drobecky_implode" => " > ",

                  "admin_classic_polozka" => "%%1%%",

                  "admin_classic_obsah" => "
<div class=\"datovy_sklad_os_obsah\">
  <p class=\"drobeckova_navigace\">%%1%%</p>
  %%2%%
</div>\n",

                  "admin_obsah_change" => "
<div class=\"central_absolutni central_info\">
  <p>
    Mění se styl výpisu. Vydržte chvíli.
  </p>
  <p class=\"odkaz_pokracovat\">
    Vyčkejte, než se stránka sama obnoví.
  </p>
</div>\n",

                  "admin_nasobitel_odsazeni" => 20,

                  "admin_max_zanoreni" => 10,

                  "admin_vypis_file_type" => array ("default" => "%%1%%obr/admin/datovy_sklad_ikony/default.png",  //koncovka => cesta
                                                    "rar" => "%%1%%obr/admin/datovy_sklad_ikony/rar.png",
                                                    "psd" => "%%1%%obr/admin/datovy_sklad_ikony/psd.png",
                                                    "png" => "%%1%%obr/admin/datovy_sklad_ikony/png.png",
                                                    "pl" => "%%1%%obr/admin/datovy_sklad_ikony/pl.png",
                                                    "php" => "%%1%%obr/admin/datovy_sklad_ikony/php.png",
                                                    "pdf" => "%%1%%obr/admin/datovy_sklad_ikony/pdf.png",
                                                    "ogg" => "%%1%%obr/admin/datovy_sklad_ikony/ogg.png",
                                                    "mpeg4" => "%%1%%obr/admin/datovy_sklad_ikony/mpeg4.png",
                                                    "mpeg" => "%%1%%obr/admin/datovy_sklad_ikony/mpeg.png",
                                                    "mpc" => "%%1%%obr/admin/datovy_sklad_ikony/mpc.png",
                                                    "mp4" => "%%1%%obr/admin/datovy_sklad_ikony/mp4.png",
                                                    "mp3" => "%%1%%obr/admin/datovy_sklad_ikony/mp3.png",
                                                    "mov" => "%%1%%obr/admin/datovy_sklad_ikony/mov.png",
                                                    "js" => "%%1%%obr/admin/datovy_sklad_ikony/js.png",
                                                    "jpg" => "%%1%%obr/admin/datovy_sklad_ikony/jpg.png",
                                                    "jpeg" => "%%1%%obr/admin/datovy_sklad_ikony/jpeg.png",
                                                    "html" => "%%1%%obr/admin/datovy_sklad_ikony/html.png",
                                                    "gzip" => "%%1%%obr/admin/datovy_sklad_ikony/gzip.png",
                                                    "gz" => "%%1%%obr/admin/datovy_sklad_ikony/gz.png",
                                                    "gif" => "%%1%%obr/admin/datovy_sklad_ikony/gif.png",
                                                    "flac" => "%%1%%obr/admin/datovy_sklad_ikony/flac.png",
                                                    "doc" => "%%1%%obr/admin/datovy_sklad_ikony/doc.png",
                                                    "divx" => "%%1%%obr/admin/datovy_sklad_ikony/divx.png",
                                                    "dat" => "%%1%%obr/admin/datovy_sklad_ikony/dat.png",
                                                    "css" => "%%1%%obr/admin/datovy_sklad_ikony/css.png",
                                                    "cgi" => "%%1%%obr/admin/datovy_sklad_ikony/cgi.png",
                                                    "cab" => "%%1%%obr/admin/datovy_sklad_ikony/cab.png",
                                                    "bmp" => "%%1%%obr/admin/datovy_sklad_ikony/bmp.png",
                                                    "avi" => "%%1%%obr/admin/datovy_sklad_ikony/avi.png",
                                                    "asp" => "%%1%%obr/admin/datovy_sklad_ikony/asp.png",
                                                    "asf" => "%%1%%obr/admin/datovy_sklad_ikony/asf.png",
                                                    "arj" => "%%1%%obr/admin/datovy_sklad_ikony/arj.png",
                                                    "ape" => "%%1%%obr/admin/datovy_sklad_ikony/ape.png",
                                                    "aiff" => "%%1%%obr/admin/datovy_sklad_ikony/aiff.png",
                                                    "ace" => "%%1%%obr/admin/datovy_sklad_ikony/ace.png",
                                                    "aac" => "%%1%%obr/admin/datovy_sklad_ikony/aac.png",
                                                    "7z" => "%%1%%obr/admin/datovy_sklad_ikony/7z.png",
                                                    "3gp" => "%%1%%obr/admin/datovy_sklad_ikony/3gp.png",
                                                    "zip" => "%%1%%obr/admin/datovy_sklad_ikony/zip.png",
                                                    "xvid" => "%%1%%obr/admin/datovy_sklad_ikony/xvid.png",
                                                    "xml" => "%%1%%obr/admin/datovy_sklad_ikony/xml.png",
                                                    "xhtml" => "%%1%%obr/admin/datovy_sklad_ikony/xhtml.png",
                                                    "wpd" => "%%1%%obr/admin/datovy_sklad_ikony/wpd.png",
                                                    "wmv" => "%%1%%obr/admin/datovy_sklad_ikony/wmv.png",
                                                    "wma" => "%%1%%obr/admin/datovy_sklad_ikony/wma.png",
                                                    "wav" => "%%1%%obr/admin/datovy_sklad_ikony/wav.png",
                                                    "vqf" => "%%1%%obr/admin/datovy_sklad_ikony/vqf.png",
                                                    "vob" => "%%1%%obr/admin/datovy_sklad_ikony/vob.png",
                                                    "vcd" => "%%1%%obr/admin/datovy_sklad_ikony/vcd.png",
                                                    "txt" => "%%1%%obr/admin/datovy_sklad_ikony/txt.png",
                                                    "tif" => "%%1%%obr/admin/datovy_sklad_ikony/tif.png",
                                                    "tiff" => "%%1%%obr/admin/datovy_sklad_ikony/tiff.png",
                                                    "tga" => "%%1%%obr/admin/datovy_sklad_ikony/tga.png",
                                                    "swf" => "%%1%%obr/admin/datovy_sklad_ikony/swf.png",
                                                    "svcd" => "%%1%%obr/admin/datovy_sklad_ikony/svcd.png",
                                                    "rtf" => "%%1%%obr/admin/datovy_sklad_ikony/rtf.png",
                                                    "rm" => "%%1%%obr/admin/datovy_sklad_ikony/rm.png",
                                                    "fon" => "%%1%%obr/admin/datovy_sklad_ikony/fon.png",
                                                    "otf" => "%%1%%obr/admin/datovy_sklad_ikony/otf.png",
                                                    "pfb" => "%%1%%obr/admin/datovy_sklad_ikony/pfb.png",
                                                    "pfm" => "%%1%%obr/admin/datovy_sklad_ikony/pfm.png",
                                                    "ttf" => "%%1%%obr/admin/datovy_sklad_ikony/ttf.png",
                                                    "xls" => "%%1%%obr/admin/datovy_sklad_ikony/xls.png",
                                                    "mdf" => "%%1%%obr/admin/datovy_sklad_ikony/mdf.png",
                                                    "mds" => "%%1%%obr/admin/datovy_sklad_ikony/mds.png",
                                                    "nrg" => "%%1%%obr/admin/datovy_sklad_ikony/nrg.png",
                                                    "cue" => "%%1%%obr/admin/datovy_sklad_ikony/cue.png",
                                                    "iso" => "%%1%%obr/admin/datovy_sklad_ikony/iso.png",
                                                    "pps" => "%%1%%obr/admin/datovy_sklad_ikony/pps.png",
                                                    "ppt" => "%%1%%obr/admin/datovy_sklad_ikony/ppt.png"
                                                    ),

                  "admin_vypis_dir_type" => array("unknown" => "unknown", //koncovka => cesta
                                                  "empty" => "empty",
                                                  "dir" => "dir",
                                                  "asp" => "document",
                                                  "cgi" => "document",
                                                  "css" => "document",
                                                  "default" => "document",
                                                  "doc" => "document",
                                                  "html" => "document",
                                                  "js" => "document",
                                                  "pdf" => "document",
                                                  "php" => "document",
                                                  "pl" => "document",
                                                  "rtf" => "document",
                                                  "txt" => "document",
                                                  "wpd" => "document",
                                                  "xhtml" => "document",
                                                  "xml" => "document",
                                                  "xls" => "document",
                                                  "pps" => "document",
                                                  "ppt" => "document",
                                                  "bmp" => "picture",
                                                  "gif" => "picture",
                                                  "jpg" => "picture",
                                                  "png" => "picture",
                                                  "psd" => "picture",
                                                  "tga" => "picture",
                                                  "tif" => "picture",
                                                  "tiff" => "picture",
                                                  "jpeg" => "picture",
                                                  "aac" => "music",
                                                  "aiff" => "music",
                                                  "ape" => "music",
                                                  "flac" => "music",
                                                  "mp3" => "music",
                                                  "mpc" => "music",
                                                  "ogg" => "music",
                                                  "rm" => "music",
                                                  "vqf" => "music",
                                                  "wav" => "music",
                                                  "wma" => "music",
                                                  "3gp" => "video",
                                                  "asf" => "video",
                                                  "avi" => "video",
                                                  "dat" => "video",
                                                  "divx" => "video",
                                                  "mov" => "video",
                                                  "mp4" => "video",
                                                  "mpeg" => "video",
                                                  "mpeg4" => "video",
                                                  "svcd" => "video",
                                                  "swf" => "video",
                                                  "vcd" => "video",
                                                  "vob" => "video",
                                                  "wmv" => "video",
                                                  "xvid" => "video",
                                                  "7z" => "archives",
                                                  "ace" => "archives",
                                                  "arj" => "archives",
                                                  "cab" => "archives",
                                                  "gz" => "archives",
                                                  "gzip" => "archives",
                                                  "rar" => "archives",
                                                  "zip" => "archives",
                                                  "ttf" => "fonts",
                                                  "otf" => "fonts",
                                                  "pfm" => "fonts",
                                                  "pfb" => "fonts",
                                                  "fon" => "fonts",
                                                  "iso" => "diskimage",
                                                  "mdf" => "diskimage",
                                                  "mds" => "diskimage",
                                                  "nrg" => "diskimage",
                                                  "cue" => "diskimage"
                                                  ),

                  "set_pomer" => 100,  //%

                  "set_pathdata" => "soubory",

                  "admin_prepis" => array("\xc3\xa1" => "a",
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
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
