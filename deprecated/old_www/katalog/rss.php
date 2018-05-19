<?php
include_once "login.php";

class Rss extends Login
{
	var $rsssoubor = ".rss_data.sqlite";	//název DB Rss
	var $rsspocnazev = ".pocitadlo_rss.huh";
	var $rsspoc;
	var $rsslite;  //objekt databáze
	var $delka = 9;	//polí v DB Rss
	var $nazevstranlite = "strankovani.baf";	//jméno databáze
//******************************************************************************
  function Hlavicka()
  {
    $datum = gmdate("D, d M Y H:i:s \G\M\T");
    $web = "http://{$_SERVER["SERVER_NAME"]}";
    $kodovani = "UTF-8";
    $title = "Katalogový systém by GF Design";
    $category = "Katalogový systém";
    $description = "Sledování nově přidaných položek v katalogu";
    $language = "cs";
    $copyright = "Programming by Geniv (c) 2008, Design by Fugess (c) 2008";
    $managingeditor = "info@gfdesign.cz (Info GFDesign)";
    $webmaster = "fugess@gfdesign.cz (Fugess GFDesign)";
    $ttl = 120;
    $imgurl = "$web/obr/katalog_rss.png";

    $result =
"<?xml version=\"1.0\" encoding=\"$kodovani\"?>
<rss version=\"2.0\">
  <channel>
    <title>$title</title>    
    <link>$web</link>
    <category>$category</category>
    <description>$description</description>
    <language>$language</language>
    <copyright>$copyright</copyright>
    <managingEditor>$managingeditor</managingEditor>
    <webMaster>$webmaster</webMaster>
    <ttl>$ttl</ttl>
    <pubDate>$datum</pubDate>
    <lastBuildDate>$datum</lastBuildDate>

    <image>
    <title>$title</title>
    <link>$web</link>
    <url>$imgurl</url>
    </image>";
    return $result;
  }
//******************************************************************************
  function Konec()
  {
    $result =
"  </channel>
</rss>";
    return $result;
  }
//******************************************************************************
  function Rss()	//bere jako konstruktor!
  {
    if (Empty($_GET["action"]) && $this->Soubor() != "index.php")
    {
      $this->rsslite = new SQLiteDatabase($this->rsssoubor);
      if (filesize($this->rsssoubor) == 0)
      {
        if (!@$this->rsslite->queryExec ("CREATE TABLE rss (
                                          id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                          detachid INTEGER,
                                          strana INTEGER,
                                          nazev VARCHAR(200),
                                          kategorie VARCHAR(30),
                                          typ VARCHAR(10),
                                          komentar VARCHAR(300),
                                          pocet INTEGER,
                                          cas TIME,
                                          datum DATE,
                                          rssdatum DATETIME);", $error))
        {
          $this->chyba = $error;
        }
      }
      
      $hlavicka = $this->Hlavicka();
      $obsah = $this->ObsahRss();
      $konec = $this->Konec();
      $this->rsspoc = new SQLiteDatabase($this->rsspocnazev); //počítadlo
      $pocitadlo = $this->Pocitadlo();

    $result =
"$hlavicka
$obsah
$konec
$this->chyba
$pocitadlo";

    header("Content-Type: application/rss+xml");
    print $result;
    }
      else
    {
      if ($_GET["action"] == "adminrss")
      {
        header('Content-type: text/html; charset=UTF-8');
        print $this->VypisPocitadla();
      }
    }
  }
//******************************************************************************
  function Soubor()
  {
    $odd = "/"; //zadaný oddělovač adresy
    $a = explode($odd, $_SERVER["SCRIPT_NAME"]); //rosekání adresy a vrácení žádaného výsledku
    return $a[count($a) - 1];
  }
//******************************************************************************
  function PripojMySQLi()
  {
    $this->mysqli = @new mysqli($this->host, $this->username, $this->password, $this->databaze, $this->port);

    if (!mysqli_connect_errno())	//objektové připojení do DB mysqli_connect_errno()
    {
      if (@$this->mysqli->multi_query("SET CHARACTER SET UTF8"))	//bez návratu testuje jen chybu s negací
      {
        $result = true;
      }
        else
      {
        $this->chyba = $this->mysqli->error;
      }
    }
      else
    {
      $result = false;
      $this->chyba = mysqli_connect_error();
    }

    return $result;
  }
//******************************************************************************
  function ZavriMySQLi()
  {
    $this->mysqli->close();	//uzavření DB
  }
//******************************************************************************
  function ObsahRss()
  {
    if (file_exists($this->rsssoubor))
    {
      if ($res = @$this->rsslite->query("SELECT id, detachid, strana, nazev, kategorie, typ, komentar, pocet, cas, datum, rssdatum FROM rss 
                                        WHERE datum=(SELECT datum FROM rss GROUP BY datum ORDER BY rssdatum DESC LIMIT 0,1) ORDER BY cas DESC", NULL, $error))
      {
        while ($data = $res->fetchObject())
        {
          $web = "http://{$_SERVER["SERVER_NAME"]}/?action=complet---{$data->strana}#presmerovani_{$data->detachid}";
          $result .=
"
    <item>
      <title>$data->nazev</title>
      <link>$web</link>
      <description>
        &lt;table cellpadding=\"2\"&gt;
          &lt;tr&gt;
            &lt;td align=\"right\"&gt;Název:&lt;/td&gt;
            &lt;th align=\"left\"&gt;$data->nazev&lt;/th&gt;
          &lt;/tr&gt;
          &lt;tr&gt;
            &lt;td align=\"right\"&gt;Žánr:&lt;/td&gt;
            &lt;th align=\"left\"&gt;$data->kategorie&lt;/th&gt;
          &lt;/tr&gt;
          &lt;tr&gt;
            &lt;td align=\"right\"&gt;Médium:&lt;/td&gt;
            &lt;th align=\"left\"&gt;$data->typ&lt;/th&gt;
          &lt;/tr&gt;
          &lt;tr&gt;
            &lt;td align=\"right\"&gt;Komentář:&lt;/td&gt;
            &lt;th align=\"left\"&gt;$data->komentar&lt;/th&gt;
          &lt;/tr&gt;
          &lt;tr&gt;
            &lt;td align=\"right\"&gt;Počet disků:&lt;/td&gt;
            &lt;th align=\"left\"&gt;$data->pocet&lt;/th&gt;
          &lt;/tr&gt;
        &lt;/table&gt;
      </description>
      <pubDate>".gmdate("D, d M Y H:i:s \G\M\T", strtotime($data->rssdatum))."</pubDate>
      <guid isPermaLink=\"false\">ID{$data->id}</guid>
    </item>";

        }
      }
        else
      {
        $this->chyba = $error;
      }

      return $result;
    }
  }
//******************************************************************************
  function VytvorRss($now = "")
  {
    if (!Empty($now) && $now == "now")
    {
      if ($this->PripojMySQLi())
      {
        $sqlite = new SQLiteDatabase($this->nazevstranlite);	//vytoření globálního objektu
        if ($res = @$sqlite->query("SELECT pocet FROM strankovani WHERE kde='complet'", $error))
        {
          $str = $res->fetchObject()->pocet;  //načtení stránkování
        }
          else
        {
          $this->chyba = $error;
        }

        if ($res = @$this->mysqli->query("SELECT
                                          dvd.iddvd as id,
                                          dvd.detachid,
                                          dvd.nazev as nazev, 
                                          kategorie.nazev as kategorie, 
                                          medium.typ as typ,
                                          dvd.komentar,
                                          dvd.pocet,
                                          DATE_FORMAT(datum, '%H:%i:%s')as cas,
                                          DATE_FORMAT(datum, '%d.%m.%Y')as datum,
                                          datum as rssdatum   
                                          FROM 
                                          dvd, kategorie, medium 
                                          WHERE 
                                          dvd.idkategorie=kategorie.idkategorie 
                                          AND
                                          dvd.idmedium=medium.idmedium
                                          ORDER BY dvd.detachid ASC;"))
        {

          $this->rsslite = new SQLiteDatabase($this->rsssoubor);
          $poc = 1;	//počítadlo 1..15
          $strana = 1;	//stránkování
          while ($data = $res->fetch_object())  //přidá všechny položky do sqlite
          {
            if (!@$this->rsslite->queryExec("INSERT INTO rss(id, detachid, strana, nazev, kategorie, typ, komentar, pocet, cas, datum, rssdatum) VALUES ($data->id, $data->detachid, $strana, '$data->nazev', '$data->kategorie', '$data->typ', '$data->komentar', $data->pocet, '$data->cas', '$data->datum', '$data->rssdatum');", $error))
            {
              $this->chyba = $error;
            }
            $poc++;
            if ($poc > $str)	//nulování a přičítání
            {
              $strana++;
              $poc = 1;
            }
          }
        }
          else
        {
          $this->chyba = $this->mysqli->error;
        }
        $this->ZavriMySQLi();
      }
    }
  }
//******************************************************************************
  function Pocitadlo()
	{
    $datum = date("Y-m-d");
    $cas = date("H:i:s");
    $hodina = date("H");
    $uphodina = date("H", mktime(date("H") + 1, 0, 0, 0, 0, 0));

    if (filesize($this->rsspocnazev) == 0)
    {
      if (!@$this->rsspoc->queryExec("CREATE TABLE pocitadlo (
                                      id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                      ip VARCHAR(40),
                                      hodina INTEGER,
                                      cas TIME,
                                      datum DATE,
                                      pocet INTEGER);", $error))
      {
        $this->chyba = $error;	//chyba do globální proměnné
      }
    }

    if ($res = @$this->rsspoc->query("SELECT COUNT(ip) as pocet FROM pocitadlo WHERE ip='{$_SERVER["REMOTE_ADDR"]}';", NULL, $error))
    {
      $data = $res->fetchObject();
      if ($data->pocet == 0)  //ověří existenci IP
      { //když neexistuje vytvoří s 1
        if (!@$this->rsspoc->queryExec("INSERT INTO pocitadlo VALUES (NULL, '{$_SERVER["REMOTE_ADDR"]}', $uphodina, '$cas', '$datum', 1);", $error))
        {
          $this->chyba = $error;	//chyba do globální proměnné
        }
      }
        else
      { //existuje-li a 'hodina'!='hodině aktuální' tak si načte a updatuje
        if ($res = @$this->rsspoc->query("SELECT pocet, hodina FROM pocitadlo WHERE ip='{$_SERVER["REMOTE_ADDR"]}'", NULL, $error))
        {
          $data = $res->fetchObject();
          $poc = $data->pocet;  //php porovnání dat
          if (date("H", mktime($data->hodina - 1, 0, 0, 0, 0, 0)) != $hodina)  //když se ->hodina <= $hodina tak updejtuj 23<22
          {
            $poc++;
            if (!@$this->rsspoc->queryExec("UPDATE pocitadlo SET pocet=$poc WHERE ip='{$_SERVER["REMOTE_ADDR"]}';
                                            UPDATE pocitadlo SET cas='$cas' WHERE ip='{$_SERVER["REMOTE_ADDR"]}';
                                            UPDATE pocitadlo SET datum='$datum' WHERE ip='{$_SERVER["REMOTE_ADDR"]}';
                                            UPDATE pocitadlo SET hodina=$uphodina WHERE ip='{$_SERVER["REMOTE_ADDR"]}';", $error))
            {
              $this->chyba = $error;	//chyba do globální proměnné
            }
          }
        }
          else
        {
          $this->chyba = $error;	//chyba do globální proměnné
        }
      }
    }
      else
    {
      $this->chyba = $error;	//chyba do globální proměnné
    }
	}
//******************************************************************************
  function VypisPocitadla()
  {
    $this->rsspoc = new SQLiteDatabase($this->rsspocnazev); //počítadlo
    if ($res = @$this->rsspoc->query("SELECT * FROM pocitadlo", NULL, $error))
    {
      $radku = $res->numRows();
      $suma = 0;
      while ($data = $res->fetchObject())
      {
        $host = gethostbyaddr($data->ip);
        $result .= "$data->id | $data->ip | $host | $data->hodina | $data->cas | $data->datum | {$data->pocet}x<br />";
        $suma += $data->pocet;
      }
      $prum = round($suma / $radku, 2);
      $result .=
      "navštíveno: {$suma}x<br />
      průměrně navštěv: $prum<br />
      <img src=\"rssstat.php\"/>";
    }
      else
    {
      $this->chyba = $error;
    }

    return $result;
  }
//******************************************************************************
}
//******************************************************************************
$web = new Rss(); //vytvoření a spuštění konstruktoru
?>
