<?php
  include_once "funkce.php";
  include_once "promenne.php";

class RSS
{
  public $var;

/* konstuktor ajaxu stranky s tiskem
 *
 * name: __construct
 * @param void
 * @return tisk vysledku dane funkce
 */
  function __construct()
  {
    $this->var = new Promenne();
    $this->var->main = new Funkce($this->var);

    $init =
    "<rss version=\"2.0\"></rss>";

    $xml = new SimpleXMLElement($init, NULL, false);
    $xml->channel->title = "RSS kanál webu Kupředu.net";
    $xml->channel->link = "http://kupredu.net";
    $xml->channel->category = "novinky";
    $xml->channel->description = "Sledování nejnovějších informací na webu";
    $xml->channel->language = "cs";
    $xml->channel->copyright = "(c) 2008 GFdesign";
    $xml->channel->managingEditor = "info@kupredu.net";
    $xml->channel->webMaster = "admin@kupredu.net";
    $xml->channel->ttl = 120;
    $xml->channel->pubDate = gmdate("D, d M Y H:i:s \G\M\T");
    $xml->channel->lastBuildDate = gmdate("D, d M Y H:i:s \G\M\T");

    $xml->channel->image->title = "RSS kanál webu Kupředu.net";
    $xml->channel->image->link = "http://kupredu.net";
    $xml->channel->image->url = "http://kupredu.net/obr/kupredu_rss.png";

    if ($res = @$this->var->sqlite->query("SELECT
                                          datum,
                                          popis
                                          FROM novinky
                                          ORDER BY novinky.datum DESC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $xml->channel->item[$i]->title = date("d.m.Y", strtotime($data->datum));
          $xml->channel->item[$i]->link = "http://kupredu.net";
          $xml->channel->item[$i]->description = $data->popis;
          $dat = strtotime($data->datum); //-1D
          $datum = date("D, d M Y H:i:s \G\M\T", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat) - 1, date("Y", $dat)));  //expirace
          $xml->channel->item[$i]->pubDate = $datum;
          $i++;
        } //$xml->channel->item[$i]->pubDate = gmdate("D, d M Y H:i:s \G\M\T", strtotime($data->datum));
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    echo $xml->asXML();
    echo "{$this->var->chyba}";
  }
}

  header("Content-Type: application/rss+xml; charset=UTF-8");
  $web = new RSS();
?>
