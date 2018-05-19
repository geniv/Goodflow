<?php

class Browser
{
  public function __construct()
  {
    if (Empty($_GET["adr"]))
    {
      $result = "
      <form method=\"get\">
        <fieldset>
          <input type=\"text\" name=\"adr\" value=\"http://\">
          <input type=\"submit\" value=\"go page\">
        </fieldset>
      </form>
      ";
    }
      else
    {
      $stranka = $this->NactiUrl($_GET["adr"]);
      $baseadr = explode("/", $_GET["adr"]);
      $adresa = "http://browser.gfdesign.cz/?adr={$baseadr[0]}/";

      $pole = array("src=\"" => "src=\"{$adresa}",
                    "href=\"" => "href=\"{$adresa}",
                    );

      $result = strtr($stranka, $pole);
    }

    echo $result;
  }

  public function NactiUrl($url)
  {
    $url = str_replace("http://", "", $url);
    if (preg_match("#/#","{$url}"))
    {
      $page = $url;
      $url = @explode("/",$url);
      $url = $url[0];
      $page = str_replace($url,"",$page);
      if (!$page || $page == "")
      {
        $page = "/";
      }
      $ip = gethostbyname($url);
    }
      else
    {
      $ip = gethostbyname($url);
      $page = "/";
    }

    if ($open = @fsockopen($ip, 80, $errno, $errstr, 60))
    {
      $send .= "GET {$page} HTTP/1.0\r\n";
      $send .= "Host: {$url}\r\n";
      $send .= "Accept-Language: en-us, en;q=0.50\r\n";
      $send .= "User-Agent: {$_SERVER["HTTP_USER_AGENT"]}\r\n";
      $send .= "Connection: Close\r\n\r\n";

      fputs($open, $send);
      $return = "";
      while (!feof($open))
      {
        $return .= fgets($open, 4096);
      }
      fclose($open);

      $ret = @explode("\r\n\r\n", $return, 2);
      //$header = $ret[0]; //header
      $result = $ret[1]; //body
    }
      else
    {
      //$this->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["error_get_url"], $errno, $errstr), array(__LINE__, __METHOD__));
      $result = NULL;
    }
    //$result = file_get_contents($url);

    return $result;
  }
}

$web = new Browser();
?>
