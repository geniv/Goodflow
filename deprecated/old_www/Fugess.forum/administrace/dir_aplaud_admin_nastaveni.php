<?
require "funkce_admin.php";
if(!Empty($jmeno_admina) and !Empty($heslo_admina) and login_admin($jmeno_admina,$heslo_admina)=="true" and prava_uzivatele_admin($jmeno_admina,$ID_uz_admin)==3)
{
echo
"<form enctype=\"multipart/form-data\" method=\"post\">
<input type=\"file\" name=\"souborek\">
<input type=\"submit\" value=\"aplauduj!\">
</form>
<table border=1>
<tr>
<th>Název:</th>
<th>Velikost:</th>
<th>Práva:</th>
<th>Pøíkaz:</th>
</tr>";

$aktualni_soubor=basename(__FILE__);

//doknedlit!
if(!Empty($sloz))
{
if(!Empty($urv1))
{$pol="$sloz/$urv1";}
else
{$pol=$sloz;}
}
else
{$pol=".";}

//print "http://$SERVER_NAME/".basename(getcwd())."/..test";
//print "<img src=\"../../2.tyden.jpg\">";

if(!Empty($prik) and !Empty($co) and $prik=="smaz")
{
$ftp_server="fugess.trainz.cz";
$ftp_user_name="jedisoft_fugess";
$ftp_user_pass="siemens";
$conn_id=ftp_ssl_connect($ftp_server); 
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);
ftp_delete($conn_id,$co);
ftp_close($conn_id);
print "Soubor: <i>$co</i> smazán!<br>";
}

print 
"Cesta: <b>$pol</b>
<br>
<a href=\"$aktualni_soubor\">$aktualni_soubor</a>
<br><br>";

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
for($i=1;$i<count($cesta);$i++)
{
//------------------------------------------------------------
$smazat="<a href=\"$aktualni_soubor?prik=smaz&co=$pol/{$cesta[$i]}\">Smazat</a>";
//------------------------------------------------------------
if(filetype("$pol/{$cesta[$i]}")=="file")
{$polozka="<a href=\"$pol/{$cesta[$i]}\" target=\"_blank\">{$cesta[$i]}</a>";}
else
{
if(Empty($sloz))
{$polozka="<b><a href=\"$aktualni_soubor?sloz={$cesta[$i]}&urv1=\">{$cesta[$i]}</a></b>";}
else
{$polozka="<b><a href=\"$aktualni_soubor?sloz=$pol&urv1={$cesta[$i]}\">{$cesta[$i]}</a></b>";}
}
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
$prava=fileperms("$pol/{$cesta[$i]}");
//------------------------------------------------------------
echo
"<tr>
<td>$polozka</td>
<td>$velikost</td>
<td>$prava</td>
<td>$smazat</td>
</tr>";
}//end for

print "</table>";
//$slozka=dirname($pol);
if(!Empty($souborek))
{
$ftp_server="fugess.trainz.cz";
$ftp_user_name="jedisoft_fugess";
$ftp_user_pass="siemens";
$conn_id=ftp_ssl_connect($ftp_server); 
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass); 
$source_file=$souborek; //z komplu
$destination_file="$pol/$souborek_name";
$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY); 

if(!$upload) 
{print "FTP aplaud selhal!";}
else
{print 
"Uloženo na server! :-)<br>
$destination_file";}
ftp_close($conn_id);
}
}//end pøistup OK
?>
