<?php
header("Content-Type: application/rss+xml"); //velice důležitá hlavička!!

print
"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<rss version=\"0.91\">
	<channel>
		<title>Pokusný RSS source</title>    
		<link>http://geniv.ic.cz/</link>
		<category>Pokus</category>
		<description>poznamka k mému zdroji +ěščřžýáíé=</description>
		<language>cs</language>
		<copyright>(c) by Geniv</copyright>
		<managingEditor>kokot@debl.cz (kokot debil)</managingEditor>
		<webMaster>geniv@centrum.cz (potento netento)</webMaster>
		<ttl>120</ttl>
		<pubDate>Tue, 29 Jan 2008 15:34:11 GMT</pubDate>
		<lastBuildDate>Tue, 29 Jan 2008 15:34:11 GMT</lastBuildDate>
		<item>
				<title>hlava0</title>
				<link>http://odkaz0.cz</link>
				<description>poznámky0</description>
				<guid isPermaLink=\"false\">jedinecneID0</guid>
		</item>
		<item>
				<title>hlava1</title>
				<link>http://odkaz1.cz</link>
				<description>poznamky1</description>
				<guid isPermaLink=\"false\">jedinecneID1</guid>
		</item>
	</channel>
</rss>";
?>
