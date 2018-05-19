<?
  $jm = "Geniv";
  $ps = "Tecra8K";
  if (!Empty($jmeno) and !Empty($heslo))
  {
    if($jmeno == $jm and $heslo == $ps) 
    {
      SetCookie("UP_jmeno", $jmeno, Time() + 31536000);
      SetCookie("UP_heslo", $heslo, Time() + 31536000);
      print "Pøihlášen...";
    }
      else
    {
      SetCookie("UP_jmeno","");
      SetCookie("UP_heslo","");
      print "špatné heslo...";
    }
    print 
    "<head>
    <meta http-equiv=\"refresh\" content=\"1;URL=index.php\">
    </head>
    <a href=\"index.php\">Pokraèuj</a>"; 
  }

  if (!Empty($logov) and $logov == "logof")
  {
    SetCookie("UP_jmeno", "");
    SetCookie("UP_heslo", "");
    print 
    "<head>
    <meta http-equiv=\"refresh\" content=\"1;URL=index.php\">
    </head>
    <a href=\"index.php\">pokraèuj</a>"; 
  }
  
  print
  "<html>
  <head>
    <title>Geniv upload</title>
  </head>
  <style type=\"text/css\">
    body 
    {
      color: #6C87DC;
    }
  </style>
  <body bgcolor=\"black\">
  <font color=\"white\">";

  if(Empty($UP_jmeno) and Empty($UP_heslo))
  {
    print
    "<form method=\"post\">
      Login: <input type=\"text\" name=\"jmeno\"><br>
      Pass: <input type=\"password\" name=\"heslo\"><br>
      <input type=\"submit\" value=\"Login\">
    </form>";
  }
    else
  {
  print
  "<form method=\"post\">
    <input type=\"submit\" value=\"Log out\">
    <input type=\"hidden\" name=\"logov\" value=\"logof\">
  </form>";
  }

  $aktualni_soubor = basename(__FILE__);
  
  if(!Empty($UP_jmeno) and !Empty($UP_heslo) and $jm == $UP_jmeno and $ps == $UP_heslo)
  {
    print
    "<form method=\"post\" enctype=\"multipart/form-data\">
    Soubor: <input type=\"file\" name=\"priloha\">
    <br>";

    if(Empty($priloha))
    {
      print
      "<input type=\"submit\" value=\"Upload...\">
      </form>";
    }
      else
    {
      $nazev = $priloha_name;
      $ftp_server = "geniv.hostuju.cz";
      $ftp_user_name = "geniv.hostuju.cz";
      $ftp_user_pass = "meganote30";
      $conn_id = ftp_ssl_connect($ftp_server);
      $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);//musí
      $upload = ftp_put($conn_id, "Upload/$nazev", $priloha, FTP_BINARY);
      ftp_close($conn_id);
      print 
      "<head>
      <meta http-equiv=\"refresh\" content=\"1;URL=index.php\">
      </head>
      Pøidán soubor: <b>$nazev</b> <a href=\"index.php\" class=\"odkaz\">Pokraèuj zde</a>";
    }
  }

  $pol = "Upload";
  $i = 0;
  $cesta[] = "";
  $handle = opendir($pol);
  while($soub = readdir($handle))
  {
    $i++;
    $cesta[$i] = $soub;
  }
  closedir($handle);
  sort($cesta);//seøazení
  reset($cesta);

  print
  "<table cellpadding=\"6\" cellspacing=\"0\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
  <tr>
    <td>Odkaz</td>
    <td>Link</td>
    <td>Velikost</td>
    <td>Akce</td>
  </tr>";

  if(count($cesta) != 3)
  {
    $sum = 0;
    for($i = 3; $i < count($cesta); $i++)
    {
      //------------------------------------------------------------
      if(!Empty($UP_jmeno) and !Empty($UP_heslo) and $jm == $UP_jmeno and $ps == $UP_heslo)
      {
        $smazat = "<a href=\"$aktualni_soubor?prik=smaz&co=$pol/{$cesta[$i]}\" class=\"odkaz\">Smazat</a>";
      }
        else
      {
        $smazat="Nedostatek práv";
      }
      //------------------------------------------------------------
      $vel = filesize("$pol/{$cesta[$i]}"); //velikost jednotlivých souborù
      $sum += $vel;
      if($vel >= 1048576)
      {
        $velikost = sprintf("%.2lf MB", $vel / 1048576);
      }
          else
      if($vel >= 1024)
      {
        $velikost = sprintf("%.2lf kB", $vel / 1024);
      }
        else
      {
        $velikost = sprintf("%.2lf Bytes", $vel);
      }
      //------------------------------------------------------------
      if($sum >= 1048576) //celková velikost
      {
        $celsum = sprintf("%.2lf MB", $sum / 1048576);
      }
          else
      if($sum >= 1024)
      {
        $celsum = sprintf("%.2lf kB", $sum / 1024);
      }
        else
      {
        $celsum = sprintf("%.2lf Bytes", $sum);
      }
      //------------------------------------------------------------
      $link="http://geniv.hostuju.cz/Upload/{$cesta[$i]}";
      echo
      "<tr>
        <td><a href=\"$pol/{$cesta[$i]}\" target=\"_blank\" class=\"odkaz\">{$cesta[$i]}</a></td>
        <td>$link</td>
        <td>$velikost</td>
        <td>$smazat</td>
      </tr>";
    }//end for

  }
    else
  {
    print
    "<tr>
    <th colspan=\"4\">Žádné soubory</th>
    </tr>";
  }
  print
  "<tr>
     <td colspan=\"2\" align=\"right\">Celková velikost složky Upload:</td>
     <td colspan=\"2\" align=\"center\"><b>$celsum</b></td>
   </tr>
  </table>";

  if(!Empty($prik) and !Empty($co) and $prik=="smaz")
  {
    if(Empty($prikaz))
    {
      print
      "<form method=\"post\">
      Smazat: <b>$co</b> ??<br>
      <input type=\"submit\" value=\"Ano\" name=\"prikaz\">
      <input type=\"submit\" value=\"Ne\" name=\"prikaz\">
      <input type=\"hidden\" name=\"co\" value=\"$co\">
      </form>"; //<input type=\"hidden\" name=\"prik\" value=\"$prik\">
    }
      else
    {
      if($prikaz=="Ano")
      {
        $ftp_server = "geniv.hostuju.cz";
        $ftp_user_name = "geniv.hostuju.cz";
        $ftp_user_pass = "meganote30";
        $conn_id = ftp_ssl_connect($ftp_server);
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        ftp_delete($conn_id, $co);
        ftp_close($conn_id);
        print 
        "<head>
        <meta http-equiv=\"refresh\" content=\"1;URL=index.php\">
        </head>
        Soubor: <i>$co</i> smazán! <a href=\"index.php\">Pokraèuj zde</a>";
      }//end if prikaz=ano
	else
      {
        print 
        "<head>
        <meta http-equiv=\"refresh\" content=\"1;URL=index.php\">
        </head>";
      }
    }//end if prikaz
  }//end if prik
  print
  "</font>
  </body>
  </html>";
?>
