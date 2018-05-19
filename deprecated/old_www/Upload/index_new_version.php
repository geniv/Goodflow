<html>
  <head>
    <title>Upload souborù</title>
  </head>
  <body>
    <form action="#" method="post" enctype="multipart/form-data">
      <input type="file" name="fupload">
      <input type="submit" value="Nahrát">
    </form>
<?php
if (isset($_FILES['fupload']))
  {
    $slozka = "Upload"; 
    $cil = $slozka . "/" .$_FILES['fupload']['name']; 
    $nazev_souboru = $_FILES['fupload']['tmp_name'];
    $copy = move_uploaded_file($nazev_souboru, $cil) or die ("Pøenesený soubor nelze zkopírovat");
    chmod ($cil, 0644);
    if($copy == true)
    { 
      echo "Soubor " .$_FILES['fupload']['name']. " byl úspìšnì nahrán na server.\n<br><a href=\"$cil\">Jdi na soubor</a>";
    }
      else
    {
      echo "Soubor nemohl být nahrán.\nPoèet chyb: " . $_FILES['fupload']['error'];
    }
  }

$pol="./";
$i=0;
$cesta[]="";
$handle=opendir($pol);
while($soub=readdir($handle))
{
$i++;
$cesta[$i]=$soub;
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

if(count($cesta)!=3)
{

for($i=3;$i<count($cesta);$i++)
{
//------------------------------------------------------------
if(!Empty($UP_jmeno) and !Empty($UP_heslo))
{$smazat="<a href=\"$aktualni_soubor?kam=interni_upload&prik=smaz&co=$pol/{$cesta[$i]}\" class=\"odkaz\">Smazat</a>";}
else
{$smazat="Nedostatek práv";}
//------------------------------------------------------------
$vel=filesize("$pol/{$cesta[$i]}");
if($vel>=1048576)
{$velikost=sprintf("%.2f MB",$vel/1048576);}
else
if($vel>=1024)
{$velikost=sprintf("%.2f KB",$vel/1024);}
else
{$velikost=sprintf("%.2f Bytes",$vel);}
//------------------------------------------------------------
$link="http://krumlov.trainz.cz/Upload/{$cesta[$i]}";
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
{print
"<tr>
<th colspan=\"4\">Žádné soubory</th>
</tr>";}

print
"</table>";

?>
</body>
</html>
















<?
/*
if(!Empty($jmeno) and !Empty($heslo))
{
 if($jmeno=="test" and $heslo=="test") 
 {
  SetCookie("UP_jmeno",$jmeno,Time()+31536000);
  SetCookie("UP_heslo",$heslo,Time()+31536000);
 }
 else
 {
  SetCookie("UP_jmeno","");
  SetCookie("UP_heslo",""); 
 }
print "<a href=\"index.php\">pokraèuj</a>"; 
}

if(!Empty($logov) and $logov=="logof")
{
SetCookie("UP_jmeno","");
SetCookie("UP_heslo","");
print "<a href=\"index.php\">pokraèuj</a>"; 
}

if(Empty($UP_jmeno) and Empty($UP_heslo))
{
print
"<form method=\"post\">
<input type=\"text\" name=\"jmeno\">
<input type=\"password\" name=\"heslo\">
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

$aktualni_soubor=basename("index.php");

print
"<form method=\"post\" enctype=\"multipart/form-data\">
Soubor: <input type=\"file\" name=\"priloha\"><br>";

print_r($_GET);
print_r($_POST);

if(Empty($priloha))
{
print
"<input type=\"submit\" value=\"Pøidat\">";
}
else
{
print "zaèíná upload";

$nazev=$priloha_name;
$ftp_server="klenot.cz";
$ftp_user_name="azsystem.cz";
$ftp_user_pass="dIfr70Je8V";

$connection=ssh2_connect($ftp_server, 22);
ssh2_auth_password($connection, $ftp_user_name, $ftp_user_pass);
//ssh2_scp_send($connection, "Upload/$nazev", $priloha, 0644);
//$sftp = ssh2_sftp($connection);
//ssh2_sftp_mkdir($sftp, './Upload22');

print "konec uploadu";

//$conn_id=ftp_ssl_connect($ftp_server);
//$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass); //musí
//$upload=ftp_put($conn_id, "Upload/$nazev", $priloha, FTP_BINARY);
//ftp_close($conn_id);
print "Pøidán soubor: <b>$nazev</b> <a href=\"index.php?kam=interni_upload\" class=\"odkaz\">Pokraèuj zde</a>";


}
print "</form>";

$pol="Upload";
$i=0;
$cesta[]="";
$handle=opendir($pol);
while($soub=readdir($handle))
{
$i++;
$cesta[$i]=$soub;
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

if(count($cesta)!=3)
{

for($i=3;$i<count($cesta);$i++)
{
//------------------------------------------------------------
if(!Empty($UP_jmeno) and !Empty($UP_heslo))
{$smazat="<a href=\"$aktualni_soubor?kam=interni_upload&prik=smaz&co=$pol/{$cesta[$i]}\" class=\"odkaz\">Smazat</a>";}
else
{$smazat="Nedostatek práv";}
//------------------------------------------------------------
$vel=filesize("$pol/{$cesta[$i]}");
if($vel>=1048576)
{$velikost=sprintf("%.2f MB",$vel/1048576);}
else
if($vel>=1024)
{$velikost=sprintf("%.2f KB",$vel/1024);}
else
{$velikost=sprintf("%.2f Bytes",$vel);}
//------------------------------------------------------------
$link="http://krumlov.trainz.cz/Upload/{$cesta[$i]}";
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
{print
"<tr>
<th colspan=\"4\">Žádné soubory</th>
</tr>";}

print
"</table>";

if(!Empty($prik) and !Empty($co) and $prik=="smaz")
{
if(Empty($prikaz))
{
print
"<form method=\"post\">
Smazat: <b>$co</b> ??<br>
<input type=\"submit\" value=\"Ano\" name=\"prikaz\">
<input type=\"submit\" value=\"Ne\" name=\"prikaz\">
<input type=\"hidden\" name=\"prik\" value=\"$prik\">
<input type=\"hidden\" name=\"co\" value=\"$co\">
</form>";
}
else
{
if($prikaz=="Ano")
{
$ftp_server="geniv.hostuju.cz";
$ftp_user_name="geniv.hostuju.cz";
$ftp_user_pass="";
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);
ftp_delete($conn_id,$co);
ftp_close($conn_id);
print "Soubor: <i>$co</i> smazán! <a href=\"index.php?kam=interni_upload\">Pokraèuj zde</a>";
}//end if prikaz=ano
}//end if prikaz

}//end if prik
*/

?>
