<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Dynamické zobrazování - tvůrce šablon",
                                              "title" => "dynamicke zobrazování - tvůrce šablon",
                                              "id" => "",
                                              "class" => "dynamicky_obsah_menu",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_tvar_menu_odkaz" => "%%1%%",

                  "admin_tvar_menu_title" => "%%1%%",

                  "admin_vypis_edit_link_skupina" => "
          <a href=\"%%1%%\" title=\"%%2%%\">%%2%%</a> (%%3%%)<br />
          ",

                  "admin_vypis_obsahu_skupiny" => "<br />
        %%1%%<br />
        %%2%%<br />
        %%3%%
        ",
                  //rychlo vypis
                  "normal_rychlo_vypis_1" => "
                  %%1%% %%2%%<br />
                  %%3%% %%4%%<br />
                  %%5%% %%6%%<br />
                  %%7%% %%8%%<br />
                  %%9%% %%10%%<br />
                  %%11%% %%12%%<br /><br />
                  ",

                  "normal_rychlo_vypis_null_1" => "žádná položka",

                  //normalni vypis
                  "normal_vypis_1" => "
                  %%1%% %%2%%<br />
                  %%3%% %%4%%<br />
                  %%5%% %%6%%<br />
                  %%7%% %%8%%<br />
                  %%9%% %%10%%<br />
                  %%11%% %%12%%<br /><br />
                  ",

                  "normal_vypis_null_1" => "zadaná adresa neexistuje",

                  "admin_addeditobsah_nadpis" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />%%7%%<br />",

                  "admin_addeditobsah_popisek" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />%%7%%<br />",

                  "admin_addeditobsah_text" => "%%1%% <textarea name=\"elem_%%2%%\"%%4%%%%5%%%%6%%>%%3%%</textarea>%%7%%<br />",

                  "admin_addeditobsah_obrazek" => "%%1%% <input type=\"file\" name=\"elem_%%2%%\"%%3%%%%4%%%%5%% />%%6%%<br />
                    Alt obrázku <input type=\"text\" name=\"alt_obr\" /><br />
                    Název obrázku <input type=\"text\" name=\"nazev_obr\" /><br />
                    Mini width <input type=\"text\" name=\"mini_w\" /><br />
                    Mini height <input type=\"text\" name=\"mini_h\" /><br />
                    Full width <input type=\"text\" name=\"full_w\" /><br />
                    Full height <input type=\"text\" name=\"full_h\" /><br />
                    ",

                  "admin_addeditobsah_datum" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%%<br />",

                  "admin_addeditobsah_cas" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%%<br />",

                  "admin_addeditobsah_datumcas" => "%%1%% <input type=\"text\" name=\"elem_%%2%%\" value=\"%%3%%\"%%4%%%%5%%%%6%% />(format: %%8%%, %%9%%) %%7%%<br />",

                  "admin_addobsah_form" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              %%1%%
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_addobsah_error" => "chybý data!",

                  "admin_editobsah_form" => "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              %%1%%
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
            </fieldset>
          </form>
          ",

                  "admin_editobsah_error" => "chybý data!",

                  //
                  "admin_obsah_sablony" => "
                  <a href=\"%%1%%\">přidej obsah</a><br />
                  %%2%%<br />
                  %%3%%
                  ",

                  "admin_sablona_vypis_element" => "
                  %%1%%
                  ",

                  "admin_vyber_sablony_begin" => "<select name=\"sablona\">",

                  "admin_vyber_sablony" => "
          <option value=\"%%1%%\"%%2%%>%%3%% - %%4%%</option>
          ",

                  "admin_vyber_sablony_end" => "</select>",

                  "admin_vyber_sablony_null" => "zadaná šablona neexistuje",


                  "admin_vstupni_typ_select_begin" => "<select name=\"vstupni_typ\" onchange=\"document.location.href='%%1%%&amp;vstup='+this.value\">",

                  "admin_vstupni_typ_select" => "
        <option value=\"%%1%%\"%%2%%>%%3%%</option>
      ",
                  "admin_vstupni_typ_select_end" => "</select>",


                  "admin_typ_select_begin" => "<select name=\"typ\" onchange=\"document.location.href='%%1%%&amp;typ='+this.value\">",

                  "admin_typ_select" => "
        <option value=\"%%1%%\"%%2%%>%%3%% - %%4%%</option>
      ",
                  "admin_typ_select_end" => "</select>",

                  "admin_obsah_add_link" => "
                  <a href=\"%%1%%\" title=\"\">přidej šablonu</a><br />
                  <a href=\"%%2%%\" title=\"\">přidej element</a><br />
                  ",

                  "admin_obsah" => "administrace dynamickeho obsahu<br />
    %%1%%
    %%2%%<br />",

                  "admin_addsab" => "<form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" />*<br />
              řazení podle data:<br />
              asc (A->Z, 0->9): <input type=\"radio\" name=\"razeni\" value=\"ASC\" /><br />
              desc (Z->A, 9->0): <input type=\"radio\" name=\"razeni\" value=\"DESC\" checked=\"checked\" /><br />
              počet novych položek na rychlo vypis: <input type=\"text\" name=\"nove\" value=\"1\" />*<br />
              nazev: <input type=\"text\" name=\"nazev\" />*<br />
              popisek: <textarea name=\"popisek\"></textarea><br />
              href_id: <input type=\"text\" name=\"href_id\" /><br />
              href_class: <input type=\"text\" name=\"href_class\" /><br />
              href_akce: <input type=\"text\" name=\"href_akce\" /><br />
              zobrazit: <input type=\"checkbox\" name=\"zobrazit\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>",

                  "admin_addsab_hlaska" => "přidána šablona: %%1%%",

                  "admin_editsab" => "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" />*<br />
                  řazení podle data:<br />
                  asc (A->Z, 0->9): <input type=\"radio\" name=\"razeni\" value=\"ASC\" %%2%% /><br />
                  desc (Z->A, 9->0): <input type=\"radio\" name=\"razeni\" value=\"DESC\" %%3%% /><br />
                  počet novych položek na rychlo vypis: <input type=\"text\" name=\"nove\" value=\"%%4%%\" />*<br />
                  nazev: <input type=\"text\" name=\"nazev\" value=\"%%5%%\" />*<br />
                  popisek: <textarea name=\"popisek\">%%6%%</textarea><br />
                  href_id: <input type=\"text\" name=\"href_id\" value=\"%%7%%\" /><br />
                  href_class: <input type=\"text\" name=\"href_class\" value=\"%%8%%\" /><br />
                  href_akce: <input type=\"text\" name=\"href_akce\" value=\"%%9%%\" /><br />
                  zobrazit: <input type=\"checkbox\" name=\"zobrazit\"%%10%% /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_editsab_hlaska" => "upravena šablona: %%1%%",

                  "admin_delsab_hlaska" => "smazána šablona: %%1%% a všechny elementy v ní!",


                  "admin_addelem_value" => "value: <input type=\"text\" name=\"value\" value= \"%%1%%\" /><br />",

                  "admin_addelem_vstupni_typ" => "vstupní typ: %%1%%<br />",

                  "admin_addelem_reg_exp" => "reg_exp: <input type=\"text\" name=\"reg_exp\" /> <a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />",

                  "admin_addelem_vystupni_format" => "vystupni_format: <input type=\"text\" name=\"vystupni_format\" value=\"%%1%%\" /> <a href=\"http://php.net/manual/en/function.date.php\">dokumentace</a><br />",

                  "admin_addelem_min_max_poc" => "
                  min_poc: <input type=\"text\" name=\"min_poc\" value=\"0\" /><br />
                  max_poc: <input type=\"text\" name=\"max_poc\" value=\"0\" /><br />
                  ",

                  "admin_addelem" => "<form method=\"post\">
            <fieldset>
              šablona: %%1%%<br />
              typ: %%2%%<br />
              nazev: <input type=\"text\" name=\"nazev\" />*<br />
              %%3%%
              input_id: <input type=\"text\" name=\"input_id\" /><br />
              input_class: <input type=\"text\" name=\"input_class\" /><br />
              input_akce: <input type=\"text\" name=\"input_akce\" /><br />
              povinne: <input type=\"checkbox\" name=\"povinne\" /><br />
              %%4%%
              %%5%%
              %%6%%
              %%7%%
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%8%%\" /> >0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>",

                  "admin_addelem_hlaska" => "přidán element: %%1%%",


                  "admin_editelem_value" => "value: <input type=\"text\" name=\"value\" value= \"%%1%%\" /><br />",

                  "admin_editelem_vstupni_typ" => "vstupní typ: %%1%%<br />",

                  "admin_editelem_reg_exp" => "reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"%%1%%\" /> <a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />",

                  "admin_editelem_vystupni_format" => "vystupni_format: <input type=\"text\" name=\"vystupni_format\" value=\"%%1%%\" /> <a href=\"http://php.net/manual/en/function.date.php\">dokumentace</a><br />",

                  "admin_editelem_min_max_poc" => "
                  min_poc: <input type=\"text\" name=\"min_poc\" value=\"%%1%%\" /><br />
                  max_poc: <input type=\"text\" name=\"max_poc\" value=\"%%2%%\" /><br />
                  ",

                  "admin_editelem" => "<form method=\"post\">
            <fieldset>
              šablona: %%1%%<br />
              typ: %%2%%<br />
              nazev: <input type=\"text\" name=\"nazev\" value=\"%%3%%\" />*<br />
              %%4%%
              input_id: <input type=\"text\" name=\"input_id\" value=\"%%5%%\" /><br />
              input_class: <input type=\"text\" name=\"input_class\" value=\"%%6%%\" /><br />
              input_akce: <input type=\"text\" name=\"input_akce\" value=\"%%7%%\" /><br />
              povinne: <input type=\"checkbox\" name=\"povinne\"%%8%% /><br />
              %%9%%
              %%10%%
              %%11%%
              %%12%%
              poradi: <input type=\"text\" name=\"poradi\" value=\"%%13%%\" /> >0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
            </fieldset>
          </form>",

                  "admin_editelem_hlaska" => "upraven element: %%1%%",

                  "admin_delelem_hlaska" => "smazán element: %%1%%",


                  "admin_vypis_sablona_adddel_link" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat nazev: \'%%3%%\' ?');\">smazat šablonu</a>
                                                        <a href=\"%%2%%\" title=\"\">přidej element do šablony</a>",

                  "admin_vypis_del_link" => "<a href=\"%%1%%\" title=\"\" onclick=\"return confirm('Opravdu smazat adresu: \'%%2%%\' ?');\">smazat sekci</a>",

                  "admin_vypis_sablona" => "
          šablona: %%1%%, nazev: %%2%%, popis: %%3%%<br />
          <a href=\"%%4%%\" title=\"\">uprav šablonu</a>
          %%5%%
          <br />",

                  "admin_vypis_skupina_end" => "end šablony<br /><br />",

                  "admin_vypis_element" => "
nazev: %%1%%
<p>
name: %%2%%
<a href=\"%%3%%\" title=\"\">uprav element</a>
%%4%%
</p>
          ",

                  "set_povolit_pridani" => true,

                  "set_vypis_chybu" => false,

                  "set_znacka_povinne" => "*",

                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
                  "" => "",
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
