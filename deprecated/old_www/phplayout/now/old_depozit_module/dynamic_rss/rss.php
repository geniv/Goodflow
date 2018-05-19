<?php

/**
 *
 * Blok dynamicky generovaneho obsahu rss vystup, pasivne cte externi SQLite2 databazi,
 * kde tento modul ceka na svou chvili nez bude zavolan, jinak se neprojevuje
 *
 * public funkce:\n
 * construct: DynamicRSS - hlavni konstruktor tridy\n
 * RSSVystup() - hlavni vypis obsahu, podle adresy a nebo podle daneho parametru\n
 *
 */

class DynamicRSS
{
  private $var;
  private $sqlite;
  private $dbname;
  private $dirpath;

  private $printurl = "rss";  //url na kterou ceka

  //data pro pripojen externi databaze
  private $sourcedb = "DynamicLanguageCyklObsah"; //nazev hledane tridy
  private $sourcetable = "cyklicky_lang_obsah";  //nazev tabulky
  private $sourcecolumn = "datum, text"; //nazev sloupcu
  private $sourceorder = "ORDER BY cyklicky_lang_obsah.datum DESC";

  private $rss_datum = "datum"; //datum
  private $rss_descr = "text";  //description

  private $rss_kodovani = "UTF-8";
  private $rss_title = "title rss";
  private $rss_category = "kategorie";
  private $rss_description = "poznamka";
  private $rss_language = "cs";
  private $rss_copyright = "(c) vytvoren (c)";
  private $rss_managingEditor = "rizeni@email.cz (rizeni)";
  private $rss_webMaster = "webmaster@email.cz (webmaster)";
  private $rss_ttl = 120;

  private $rss_image_title = "nadpis obrazku";
  private $rss_image_link = "http://www.kam_nas_obrazek_zavede.cz";
  private $rss_image_url = "http://www.absolutni_cesta_obrazku.cz/obr.png";

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;

    $index = $this->var->main[0]->NajdiIndexPodleTridy($this->sourcedb);
    if ($index >= 0)
    {
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);
      $this->dbname = $this->var->moduly[$index]["databaze"];

      if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg("Modul: '{$this->sourcedb}' nenalezen");
    }
  }

/**
 *
 * Generuje rss, odchytava si danou url
 *
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("DynamicRSS", "RSSVystup");</strong>
 *
 */
  public function RSSVystup()
  {
    if ($_GET[$this->var->get_kam] == $this->printurl)  //ceka na danou adresu
    {
      $web_url = "http://{$_SERVER["SERVER_NAME"]}";

      if ($this->var->htaccess)
      {
        $jazyk = $this->var->main[0]->NactiFunkci("DynamicLanguage", "PrevodTextoveAdresy", $_GET["jazyk"]);
      }
        else
      {
        $jazyk = $_GET["jazyk"];
        settype($jazyk, "integer");
      }

      $pubdate = gmdate("D, d M Y H:i:s \G\M\T");

      $result =
"<?xml version=\"1.0\" encoding=\"{$this->rss_kodovani}\"?>
<rss version=\"0.92\">
  <channel>
    <title>{$this->rss_title}</title>
    <link>{$web_url}</link>
    <category>{$this->rss_category}</category>
    <description>{$this->rss_description}</description>
    <language>{$this->rss_language}</language>
    <copyright>{$this->rss_copyright}</copyright>
    <managingEditor>{$this->rss_managingEditor}</managingEditor>
    <webMaster>{$this->rss_webMaster}</webMaster>
    <ttl>{$this->rss_ttl}</ttl>
    <pubDate>{$pubdate}</pubDate>
    <lastBuildDate>{$pubdate}</lastBuildDate>

    <image>
    <title>{$this->rss_title}</title>
    <link>{$web_url}</link>
    <url>{$this->rss_image_url}</url>
    </image>
";

      if ($res = @$this->sqlite->query("SELECT {$this->sourcecolumn} FROM
                                        {$this->sourcetable} WHERE
                                        jazyk={$jazyk} {$this->sourceorder}", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $i = 0;
          while ($data = $res->fetchObject())
          {
            $column_dat = $this->rss_datum;
            $column_des = $this->rss_descr;
            $title = date("d.m.Y", strtotime($data->$column_dat));

            $dat = strtotime($data->$column_dat);
            $datum = date("D, d M Y H:i:s \G\M\T", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat) - 1, date("Y", $dat)));

            $result .=
"
    <item>
      <title>{$title}</title>
      <link>{$web_url}</link>
      <description>
        {$data->$column_des}
      </description>
      <pubDate>{$datum}</pubDate>
      <guid isPermaLink=\"false\">ID{$i}</guid>
    </item>";

            $i++;
          } //$xml->channel->item[$i]->pubDate = gmdate("D, d M Y H:i:s \G\M\T", strtotime($data->datum));
        }
      }

    $result .=
"
  </channel>
</rss>";

      echo $result;
      exit;
    }
  }
}
?>
