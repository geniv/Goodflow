<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Multilanguage cyklicky obsah",
                                              "title" => "multilanguage cyklického obsahu",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_datum_1" => "j.n. Y",

                  "normal_vypis_obsah_1" => "<p>%%1%% - %%2%%</p>",

                  "normal_vypis_null_1" => "žádná novinka",

                  "normal_link_rss_1" => "<link type=\"application/rss+xml\" rel=\"alternate\" href=\"%%1%%\" title=\"Novnky, jazyk: %%2%%, %%3%%\" />\n",

                  "normal_link_rss_web_1" => "<a href=\"%%1%%\">jazyk: %%2%%</a>, ",

                  "normal_rss_header_1" => "<?xml version=\"1.0\" encoding=\"%%1%%\"?>
<rss version=\"0.92\">
  <channel>
    <title>%%2%%</title>
    <link>%%3%%</link>
    <category>%%4%%</category>
    <description>%%5%%</description>
    <language>%%6%%</language>
    <copyright>%%7%%</copyright>
    <managingEditor>%%8%%</managingEditor>
    <webMaster>%%9%%</webMaster>
    <ttl>%%10%%</ttl>
    <pubDate>%%11%%</pubDate>
    <lastBuildDate>%%11%%</lastBuildDate>

    <image>
    <title>%%2%%</title>
    <link>%%3%%</link>
    <url>%%12%%</url>
    </image>
",

                  "normal_rss_item_datum_1" => "d.m.Y",

                  "normal_rss_item_1" => "
    <item>
      <title>%%1%%</title>
      <link>%%2%%</link>
      <description>
        %%3%%
      </description>
      <pubDate>%%4%%</pubDate>
      <guid isPermaLink=\"false\">ID%%5%%</guid>
    </item>",

                  "normal_rss_end_1" => "
  </channel>
</rss>",

                  "admin_obsah" => "administrace multilanguage cyklického obsahu
    <br />
    <a href=\"%%1%%\" title=\"\">přidat položku</a><br />
    <br />
    %%2%%
    ",

                  "admin_add" => "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /><br />
              datum: <input type=\"text\" name=\"datum\" value=\"%%1%%\" /><br />
              text: <input type=\"text\" name=\"text\" /><br />
              %%2%%<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ",

                  "admin_add_hlaska" => "
                přídána: %%1%% do jazyku: %%2%%
              ",

                  "admin_edit" => "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"%%1%%\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"%%2%%\" /><br />
                  text: <input type=\"text\" name=\"text\" value=\"%%3%%\" /><br />
                  %%4%%<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ",

                  "admin_edit_hlaska" => "
                    upravena: %%1%%, jazyk: %%2%%
                  ",

                  "admin_del_hlaska" => "
                  smazáno: '%%1%%', jazyk: %%2%%
                ",

                  "admin_vypis_datum" => "j.n. Y H:i:s",

                  "admin_vypis_obsah" => "%%2%%, (%%1%%), %%5%%, %%4%%<p>%%3%%</p>
          <a href=\"%%6%%\" title=\"\">upravit obsah</a>
          <a href=\"%%7%%\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'%%2%%\' ?');\">smazat obsah</a> <br />
          ",

                  "set_rsslink" => "rss",

                  "set_rss_kodovani_1" => "UTF-8",

                  "set_rss_title_1" => "title rss",

                  "set_rss_category_1" => "kategorie",

                  "set_rss_description_1" => "poznamka",

                  "set_rss_language_1" => "cs",

                  "set_rss_copyright_1" => "(c) vytvoren (c)",

                  "set_rss_managingEditor_1" => "rizeni@email.cz (rizeni)",

                  "set_rss_webMaster_1" => "webmaster@email.cz (webmaster)",

                  "set_rss_ttl_1" => 120,

                  "set_rss_image_title_1" => "nadpis obrazku",

                  "set_rss_image_link_1" => "http://www.kam_nas_obrazek_zavede.cz",

                  "set_rss_image_url_1" => "http://www.absolutni_cesta_obrazku.cz/obr.png",

                  "" => "",
                  "" => "",
                  "" => "",
                  );

  return $result;
?>
