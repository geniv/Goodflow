<?php

//$host = gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
//var_dump(geoip_country_name_by_name($host));
/*
$pdo = new PDO("sqlite:hviiiiiiii.sqlite3");
var_dump($pdo->query("CREATE TABLE sablona (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                adresa TEXT,
                                nazev VARCHAR(200),
                                predmet VARCHAR(100),
                                email VARCHAR(100),
                                textemail TEXT,
                                dodatek TEXT,
                                oznameni BOOL,

                                predmetoznameni VARCHAR(200),
                                textemailoznameni TEXT,
                                zdrojovyemail VARCHAR(100),
                                odesilateladmin VARCHAR(100),
                                odesilateluzivatel VARCHAR(100),

                                konfigurace TEXT,
                                popis TEXT
                                );"));
*/
/*
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=phplayout", "root", "geniv");
$p = $pdo->query("SHOW TABLES;");
foreach ($p as $rows)
{//var_dump($rows["Tables_in_phplayout"]);
  echo "{$rows["Tables_in_phplayout"]}<br />\n";
}
echo "<br />";
$p = $pdo->query("SELECT * FROM dynamicform_sablona");
foreach ($p as $rows)
{
  //var_dump($rows["id"], $rows["adresa"]);
  echo "{$rows["id"]}, {$rows["adresa"]}<br />\n";
}
*/

/*
$textxml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rss version="0.92">
<channel>
<title>Akce kavárny jantar</title>
<link>http://www.kavarnajantar.cz/</link>
<category>Akce kavárna jantar</category>
<description>Přednášky na kavárně jantar</description>
<language>cs</language>
<copyright>All rights reserved by Kavarna Jantar</copyright>
<managingEditor>info(a)kavarnajantar.cz (webmaster)</managingEditor>
<webMaster>info(a)kavarnajantar.cz (webmaster)</webMaster>
<ttl>120</ttl>
<pubDate>Fri, 31 Dec 2010 13:29:14 GMT</pubDate>
<lastBuildDate>Fri, 31 Dec 2010 13:29:14 GMT</lastBuildDate>
<image>
<title>Akce kavárny jantar</title>
<link>http://www.kavarnajantar.cz/</link>
<url>http://www.kavarnajantar.cz/obr.png</url>
</image>
<item>
<title>Filosofie SAIB</title>
<link>http://www.kavarnajantar.cz/akce</link>
<description>
  <![CDATA[
    <dl>
      <dt>Kde:</dt>
      <dd><strong>Kavárna Jantar</strong></dd>
    </dl>
    <dl>
      <dt>Kdo:</dt>
      <dd><strong>Martin Marek</strong></dd>
    </dl>
    <dl>
      <dt>Kdy:</dt>
      <dd><strong>19.12.2010, neděle</strong></dd>
    </dl>
    <dl>
      <dt>V kolik:</dt>
      <dd><strong>18:30</strong></dd>
    </dl>
    <dl>
      <dt>Popis:</dt>
      <dd><strong><p>Účast na přednášce, která se bude
konat v neděli 26.12., je nutno zajistit prostřednictvím registrace na
stránkách kavárny Jantar. Registrace budou spuštěny v úterý 21.12.
v 9:00 (50 míst) a následně v 21:00 (50 míst). Prosíme účastníky
přednášky aby se chovali <strong>ohleduplně</strong>
v prostorách čajovny a kavárny Jantar, rovněž pak před čajovnou,
v ulici Libušina. Během přestávek doporučujeme použít k relaxaci
blízký park, aby nedocházelo k vyrušování ostatních obyvatel ulice
Libušina. Rovněž dáváme na vědomí, že v čajovně probíhá před přednáškou i během
přestávek normální provoz a účastníkům přednášky je vyhrazen především prostor
kavárny. Doporučujeme rovněž zaparkovat mimo ulici Libušina, aby jste se
vyhnuli komplikacím s městskou policií. Děkujeme.</p></strong></dd>
    </dl>
    <br /><br /><br />
  ]]>
</description>
<pubDate>Sun, 31 Oct 2010 15:39:19 GMT</pubDate>
<guid isPermaLink="false">ID0</guid>
</item>
</channel>
</rss>
XML;
*/


/*
 * tvorba RSS
//$xml = simplexml_load_file("browscap.xml");
$xml = new SimpleXMLElement("<rss></rss>");
//foreach ($xml->attributes() as $a => $b)
//{
//  var_dump($a, $b);
//}
//<rss version="2.0">
$xml->addAttribute("version", "2.0");

$xml->channel->title = "titulek";
$xml->channel->category = "kategorie...";
$xml->channel->description = "poznamka...";
$xml->channel->item[0]->title = "titulek polozky";
$xml->channel->item[0]->link = "link na polozku...";
$xml->channel->item[0]->description = "popis polozky...";
$xml->channel->item[0]->pubDate = "Sun, 31 Oct 2010 15:39:19 GMT";
$xml->channel->item[0]->guid = "ID001";
$xml->channel->item[0]->guid->addAttribute("isPermaLink", "false");

echo $xml->asXML();
*/

/*
//var_dump($xml->browscapitem);
, $xml->attributes->version, $xml->channel
foreach ($xml->browscapitem as $polozka)
{
  var_dump($polozka);
}
*/



/*
  function ProjdiUrl($url, $predane = "", $poc = 0)
  {
    static $result = array();
    if ($poc == 0)
    { // = array($url);
      //$result = array($url);
      $predane = $url;
    }
    $html = file_get_contents($predane);
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xml = simplexml_import_dom($dom);
    //vyhledani odkazu
    $search = $xml->xpath("body//*[@href]");
    $clear_url = preg_split("/^http\:\/\/|\//", $url);
    if (is_array($search))
    {
      $odkazy = array();
      foreach ($search as $polozka)
      {
        $atribut = $polozka->attributes();
        $href = (string)$atribut->href;

        if (preg_match("/{$clear_url[1]}\/[a-zA-Z0-9]+/", $href) &&
            !preg_match("/\/modules\/{1}/", $href) &&
            !in_array($href, $result))
        {
          $result[] = $href;

$p = count($result);
$u = fopen("log", "a+");
fwrite($u, "{$href} [{$predane}] - {$poc} - {$p}\n");
fclose($u);

          //!in_array($href, $result)
          if (!preg_match("/\/modules\/{1}/", $href))
          {
            //$s = in_array($href, $result);
            //$result[] = $href;
          }
        }
      }

      foreach ($result as $pole)
      {
        $sub = ProjdiUrl($url, $pole, ++$poc);
        $rozdil = array_diff($sub, $result);
        $result = array_merge($result, $rozdil);
      }

      //$result = array_unique($result);


    }

    return $result;
  }
*/


/*
      foreach ($result as $href)
      {
        $sub = ProjdiUrl($href);
        $aa = array_merge($result, $sub);
        $rozdil = array_diff($aa, $result);
        $result = array_merge($result, $rozdil);
      }
*/

//$url = "http://www.mladipodnikatele.cz/";
//$url = "http://www.mladipodnikatele.cz/o-nas";
//$listurl = ProjdiUrl($url);
//var_dump($listurl);

/*
$pole = (object)array("klic1" => (object)array("sklic1" => "hodnota1",
                                               "sklic2" => "hodnota2",
                                               "sklic3" => "hodnota3",
                                               "sklic4" => "hodnota4",
                                               "sklic5" => "hodnota5",
                                               ),
                      "klic2" => (object)array("sklic2" => "hodnota2"),
                      "klic3" => (object)array("sklic3" => "hodnota2"),);

var_dump($pole);
*/
//var_dump(base64_decode("TWFydHk="));

include_once("Browscap.php"); //!!toto by slo!
$br = new Browscap("cache");
$br->doAutoUpdate = false;
//$br->updateMethod = UPDATE_CURL;
$br->localFile = "lite_php_browscap.ini";

var_dump($br->getBrowser());

?>
