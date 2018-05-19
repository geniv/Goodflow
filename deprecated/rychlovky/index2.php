<?php
//automatizovat a nechat projet!
  function NactiUrl($url)
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
        $return .= fgets($open, 4096);  //4096
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

  $max = 182;
  $index = (!Empty($_GET["index"]) ? ($_GET["index"] >= $max ? $max : $_GET["index"]) : 1);
  $pokr = true;

$web = NactiUrl("http://www.girlshq.eu/wallpapers/{$index}/");
$web1 = explode("<div class=\"girls-thumbnails\">", $web);

$prevod = array(//"<a href=\"" => "|http://www.girlshq.eu/hq-wallpapers",
                //"\" title=\"" => "",
                "<div class=\"thumb-area\" onmouseover=\"this.className='thumb-area-over';\" onmouseout=\"this.className='thumb-area'\">" => "",
                "<br />" => "",
                "<h2>" => "",
                "</h2>" => "",
                "</div>" => "",
                //"www.GirlsHQ.eu presents" => "|",
                "\" width=\"152\"" => "||",

                "/functions/nude-thumbnail.php?image=../hq-wallpapers" => "||http://www.girlshq.eu/hq-wallpapers",
                "<a href=\"/set-nude-visibility.php?shownude=y\" onclick=\"return confirm('Are you sure you want to enable erotic content?')\" title=\"GirlsHQ.eu presents " => "",
                "</a>" => "",
                "/thumbs" => "",
                "target=\"_blank\"><img src=\"" => "||http://www.girlshq.eu",
                //"http://www.girlshq.eu/functions/nude-thumbnail.php?image=../hq-wallpapers" => "http://www.girlshq.eu/",
                //"target=\"_blank\"><img src=\"" => "",
                //"\">" => "",
                //"</a>" => "",
                //"\" width=\"152\" height=\"114\" alt=\"" => "",
                //"/wallpapers/" => "/",
                //"http://www.girlshq.eu/hq-wallpapers/set-nude-visibility.php?shownude=y" => "",
                //"" => "",
                //"" => "",
                //"" => "",
                //"" => "",
                );
//doresit!
$vys = trim(strtr($web1[1], $prevod));

$web2 = explode("|", $vys);


  $c_pocet = count($web2);
  for ($i = 0; $i < $c_pocet; $i++)
  {
    if (substr($web2[$i],0, 21) == "http://www.girlshq.eu")
    {
      $vysl[] = $web2[$i];
    }
  }

  $obr = array_slice($vysl, 0, 21);

  $slozka = "sosnute_obr";

  $c_obr = count($obr);
  if (!file_exists($slozka))
  {
    mkdir($slozka, 0777);
  }

  $generuj = NULL;
  for ($i = 0; $i < $c_obr; $i++)
  {
    $jmeno = basename($obr[$i]);
    $cesta = "{$slozka}/{$jmeno}";
    if (!file_exists($cesta))
    {
      $generuj = $i;
      break;
    }
  }

  if (!is_null($generuj)) // && false
  {
    $obraz = file_get_contents($obr[$generuj]);
    $jmeno = basename($obr[$generuj]);
    $cesta = "{$slozka}/{$jmeno}";
    $u = fopen ($cesta, "w");
    fwrite($u, $obraz);
    fclose($u);
//$this->var->main[0]->AutoClick(100, $this->absolutni_url);

    $cis = $generuj + 1;
    echo "uloženo: '{$cesta}' ({$cis} z 21)";
  }
    else
  {
    if ($index == $max)
    {
      $pokr = false;
    }

    $index += 1;

    echo "hotovo.. (prechod na: {$index})";
  }

  if ($index <= $max && $pokr)
  {
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=index2.php?index={$index}\" />";
  }
//http://geniv-asus/rychlovky/index2.php?index=182
//http://www.girlshq.eu/wallpapers/
?>
