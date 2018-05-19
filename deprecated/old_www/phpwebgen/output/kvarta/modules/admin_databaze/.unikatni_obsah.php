<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace databaze",
                                              "title" => "administrace databaze",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "admin_obsah" => "administrace databaze<br />
    <br />
    %%1%%<br />",

                  "admin_info_hlavicka" => "
            <a href=\"%%1%%\">zpět na výpis tříd</a><br />
            Tabulky třídy <strong>%%2%%</strong>:<br />
            ",

                  "admin_info_vypis" => "
                  <a href=\"%%1%%\">%%2%%</a>
                  <br />
                  ",

                  "admin_info_dodatek" => "<br />
                (<a href=\"%%1%%\">export DB</a>
                <a href=\"%%2%%\">import DB</a>)
                ",

                  "admin_show_hlavicka" => "
            <a href=\"%%1%%\">zpět na výpis tříd</a><br />
            <a href=\"%%2%%\">zpět na podrobnosti třídy</a><br />
            Obsah tabulky <strong>%%3%%</strong>:<br />
            ",

                  "admin_show_begin_table" => "
                    <table border=\"1\">
                      <tr>
                    ",

                  "admin_show_header" => "
                        <th>%%1%%</th>
                      ",

                  "admin_show_end_header" => "
                      </tr>
                    ",

                  "admin_show_begin_body" => "
                  <tr>
                  ",

                  "admin_show_body" => "
                      <td>%%1%%</td>
                    ",

                  "admin_show_end_body" => "
                  </tr>
                  ",

                  "admin_show_end_table" => "
                </table>
                ",

                  "admin_show_empty_table" => "Prázdná tabulka",

                  "admin_export" => "
            <a href=\"%%1%%\">zpět na výpis tříd</a><br />
            <a href=\"%%2%%\">zpět na podrobnosti třídy</a><br />
            export SQL dotraz třídy <strong>%%3%%</strong>:<br />
            <textarea rows=\"10\" cols=\"100\">%%4%%</textarea>
            ",

                  "admin_import" => "
            <a href=\"%%1%%\">zpět na výpis tříd</a><br />
            <a href=\"%%2%%\">zpět na podrobnosti třídy</a><br />
            import SQL dotraz třídy <strong>%%3%%</strong>:<br />
            <form method=\"post\">
              <fieldset>
                <textarea name=\"dotaz\" rows=\"10\" cols=\"100\">%%4%%</textarea><br />
                <input type=\"submit\" name=\"tlacitko\" value=\"impotrovat...\" />
              </fieldset>
            </form>
            ",

                  "admin_import_exec" => "
                  imporotváno...<br />
                  <a href=\"%%1%%\">pokračuj zde...</a>
                ",

                  "admin_vypis_obsah" => "
          <a href=\"%%1%%\">%%2%%</a> (%%3%%) %%4%%<br />
        ",

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
