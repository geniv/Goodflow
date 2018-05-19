<?php

  $result = array("admin_menu" => array(array("main_href" => "%%1%%",
                                              "odkaz" => "Administrace dynamické obrázkové galerie bez sekcí",
                                              "title" => "administrace dynamické obrázkové galerie bez sekcí",
                                              "id" => "",
                                              "class" => "",
                                              "akce" => "",
                                              "zobrazit" => true),
                                        ),

                  "normal_vypis_obsah_1" => "
          <br />
          <a href=\"%%1%%\" title=\"%%3%%\">
            <img src=\"%%2%%\" alt=\"%%3%%\" />
          </a>
          <p>%%3%%</p>
          <br />
          ",

                  "normal_vypis_null_1" => "žádná položka",

                  "set_printurl_1" => "rss",

                  "set_sourcedb_1" => "DynamicLanguageCyklObsah",

                  "set_sourcequery_1" => "SELECT datum, text FROM cyklicky_lang_obsah WHERE
                                        jazyk=%%1%% ORDER BY cyklicky_lang_obsah.datum DESC",

                  "set_rss_datum_1" => "datum",

                  "set_rss_descr_1" => "text",

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
                  "set_jazyk_1" => true,

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
