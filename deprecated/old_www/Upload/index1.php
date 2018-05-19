<?
print
"<form method=\"post\" enctype=\"multipart/form-data\">
Jmeno: 
Fotka: <input type=\"file\" name=\"priloha\"><br>";

if(Empty($priloha))
{
  print
  "<input type=\"submit\" value=\"Pøidat\">
  </form>";
}
else
{
  $nazev = $priloha_name;
  $ftp_server = "";
  $ftp_user_name = "";
  $ftp_user_pass = "";
  $conn_id = ftp_ssl_connect($ftp_server);
  $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); //musí
  $upload=ftp_put($conn_id, "Upload/$nazev", $priloha, FTP_BINARY);
  if(!$upload)
  {
    print "<font color=\"red\">Chyba pøi nahrávání na server</font>";
  }
    else
  {
    print 
    "odesláno...";
    mail("radek.foltyn@seznam.cz", "Profil", "Profl: $jmeno, Fotka: http://web/Upload/$nazev");
  }
    ftp_close($conn_id);
  }
}
?>
