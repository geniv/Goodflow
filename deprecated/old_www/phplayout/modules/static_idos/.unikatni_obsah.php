<?php

  $result = array("normal_datum_select_begin" => "<select name=\"datum\">\n",

                  "normal_datum_select" => "<option value=\"%%1%%\">%%2%%</option>\n",

                  "normal_datum_select_end" => "</select>",


                  "normal_doprava_select_begin" => "<select name=\"doprava\">\n",

                  "normal_doprava_select" => "<option value=\"%%1%%\">%%2%%</option>\n",

                  "normal_doprava_select_end" => "</select>",


                  "normal_start_select_begin" => "<select name=\"start\">\n",

                  "normal_start_select" => "<option value=\"%%1%%\">%%2%%</option>\n",

                  "normal_start_select_end" => "</select>",


                  "normal_vypis_obsah_1" => "
    <form method=\"post\" target=\"_blank\">
      <fieldset>
        Výběr akce: %%1%%<br />
        Vyber počáteční (startovni) stanici: %%2%%<br />
        cíl: %%3%%<br />
        Způsob dopravy: %%4%%<br />
        Čas příjezdu: %%5%%<br />
        <input type=\"submit\"%%6%% value=\"Hledej\" />
      </fieldset>
    </form>
    ",

                  "set_cil_1" => "Moravská Nová Ves",

                  "set_cas_1" => "20:00",

                  "set_vychozi" => array ("Břeclav",
                                          "Lanžhot",
                                          "Kostice",
                                          "Tvrdonice",
                                          "Týnec [BV]",
                                          "Hrušky [BV]",
                                          "Prušánky",
                                          "Moravský Žižkov",
                                          "Velké Bílovice",
                                          "Mikulčice",
                                          "Lužice [HO]",
                                          "Hodonín [HO]"),

                  "set_doprava" => array ("autobusy" => "Bus",
                                          "vlaky" => "Vlak",
                                          "vlakyautobusy" => "Vlak & Bus",
                                          "idsjmk" => "IDS-JMK"),

                  "set_vyhledavaciurl" => "http://www.idos.cz/%%0%%/?f=%%1%%&amp;t=%%2%%&amp;date=%%3%%&amp;time=%%4%%&amp;byarr=true&amp;lng=C&amp;submit=true",
                  );

  return $result;
?>
