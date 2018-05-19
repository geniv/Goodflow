<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Sklad souborů",
                                              "title" => "Sklad souborů",
                                              "id" => "",
                                              "class" => "sklad_souboru_menu",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_obsah" => "administrace datoveho skladu
    <br />
    <a href=\"%%1%%\" title=\"\">přidat složku</a><br />
    <a href=\"%%2%%\" title=\"\">přidat soubor</a><br />
    <br />
    %%3%%
    ",

                  "admin_add_dir" => "
          <form method=\"post\">
            <fieldset>
              název složky: <input type=\"text\" name=\"slozka\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat slozku\" />
            </fieldset>
          </form>
          ",

                  "admin_add_dir_hlaska" => "složka %%1%% vytvořena",

                  "admin_edit_dir" => "
          <form method=\"post\">
            <fieldset>
              název složky: <input type=\"text\" name=\"nazev\" value=\"%%1%%\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit slozku\" />
            </fieldset>
          </form>
          ",

                  "admin_edit_dir_hlaska" => "složka %%1%% přejmenována",

                  "admin_del_dir_hlaska" => "složka %%1%% smazána",

                  "admin_add_file" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              název souboru: <input type=\"file\" name=\"soubor\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat soubor\" />
            </fieldset>
          </form>
          ",

                  "admin_add_file_hlaska" => "uploadovani souboru: %%1%% probehlo uspesne",

                  "admin_edit_file" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              název složky: <input type=\"text\" name=\"nazev\" value=\"%%1%%\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit soubor\" />
            </fieldset>
          </form>
          ",

                  "admin_edit_file_hlaska" => "složka %%1%% přejmenována",

                  "admin_del_file_hlaska" => "soubor: %%1%% smazán",

                  "admin_vypis_obsah_dir" => "<br />
            %%1%% složka: %%2%%, zanoreni: %%3%%<br />
            %%1%% <a href=\"%%4%%\" title=\"\">přidat soubor</a>
            <a href=\"%%5%%\" title=\"\">přidat podsložku</a>
            <a href=\"%%6%%\" title=\"\">upravit složku</a>
            <a href=\"%%7%%\" title=\"\" onclick=\"return confirm('Opravdu smazat složku: \'%%2%%\' ?');\">smazat složku</a>
            %%8%%",

                  "admin_vypis_obsah_file" => "<br />
            %%1%% soubor: %%2%% (%%3%%) %%4%%<br />
            %%1%% relativni cesta: ../%%6%% <a href=\"../%%6%%\">%%2%%</a><br />
            %%1%% absolutni cesta: %%5%%%%6%% <a href=\"%%5%%%%6%%\">%%2%%</a><br />
            %%1%% <a href=\"%%7%%\" title=\"\">upravit soubor</a>
            <a href=\"%%8%%\" title=\"\" onclick=\"return confirm('Opravdu smazat soubor: \'%%2%%\' ?');\">smazat soubor</a>
            %%9%%
            ",

                  "admin_vypis_obsah_sum" => "<br />
    %%1%% počet složek: %%2%%<br />
    %%1%% počet souborů: %%3%%
    ",

                  "admin_vypis_obsah_obr" => "<img src=\"%%1%%\" width=\"%%2%%px\" height=\"%%3%%px\" />",

                  "admin_import_exec" => "
                  imporotváno...
                ",

                  "admin_vypis_obsah" => "
          <a href=\"%%1%%\">%%2%%</a> (%%3%%) %%4%%<br />
        ",

                  "set_pomer" => 10,  //%
                  "set_pathdata" => "soubory",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
