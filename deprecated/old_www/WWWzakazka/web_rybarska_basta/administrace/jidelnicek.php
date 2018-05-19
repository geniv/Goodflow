<?
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_nadpis\">Jídelníček</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"center\" colspan=\"3\" height=\"20px\"><hr></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">V této sekci naleznete odkaz na aktuální jídelníček.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestli chcete vyměnit aktuální jídelníček za nový, tak nahrajte nový jídelníček do složky <u>Upload</u> pomocí FTP manažera.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jakmile nahrajete nový jídelníček do složky <u>Upload</u>, tak přejděte do sekce <a href=\"index.php?kam=soubory\">Soubory&nbsp;z&nbsp;FTP</a> a další pokyny naleznete tam.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
  <tr>
    <td align=\"center\">Jídelníček:</td>
    <td align=\"center\">&nbsp;&nbsp;</td>
    <td align=\"center\"><a href=\"../menu.doc\">stáhnete&nbsp;zde</a></td>
  </tr>
</table>

<br />
<form method=\"post\" enctype=\"multipart/form-data\">
  <input type=\"file\" name=\"soubor\"><br>
  <input type=\"submit\" name=\"tlupload\" value=\"Nahrát novou verzi\">
</form>
";

  $result = "";
  if (!Empty($_POST["tlupload"]) && !Empty($_FILES["soubor"]["tmp_name"]))
  {
    $cil = "../menu.doc";
    if (move_uploaded_file($_FILES["soubor"]["tmp_name"], $cil))
    {
      $result = "<br />uploadovani probehlo uspesne<br />
      <head>
       <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=jidelnicek\">
       </head>
      ";
    }
      else
    {
      $result = "<br />vyskytla se chyba!!<br />";
    }
  }

  echo $result;

 /*
  <form method=\"post\" enctype=\"multipart/form-data\">
  <input type=\"file\" name=\"soubor\"><br>
  <input type=\"submit\" name=\"tlupload\" value=\"Nahrát novou verzi\">
  </form>

  if (!Empty($tlupload) and !Empty($soubor))
  {
    $conn_id = ftp_ssl_connect(FtpUdaje(".",1));
    $login_result = ftp_login($conn_id, FtpUdaje(".",2), FtpUdaje(".",3));
    $source_file = $soubor; //z komplu název
    $destination_file="../menu.doc";
    $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);
    if(!$upload)
    {
      print "<font color=\"red\">Chyba při nahrávání na server</font>";
    }
    else
    {
      print
      "<head>
       <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=jidelnicek\">
       </head>
      Soubor aktualizován! Pokračuj <a href=\"index.php?kam=jidelnicek\">zde</a>";
    }
    ftp_close($conn_id);
  }
    else
  {
    if (!Empty($tlupload))
    {
      print
      "<head>
       <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=jidelnicek\">
       </head>
      Není vybraný žádný soubor! Pokračuj <a href=\"index.php?kam=jidelnicek\">zde</a>";
    }
  }
  */
}
  else
{
  echo "Co tu kurva děláš?";
}
?>
