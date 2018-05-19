<?
echo
"<form enctype=\"multipart/form-data\" method=\"post\">
<input type=\"file\" name=\"souborek\">
<input type=\"submit\" value=\"aplauduj!\">
</form>

<table border=1>";


$aktualni_soubor=basename(__FILE__);

if(!Empty($sloz))
{
if(!Empty($urv1))
{$pol="$sloz/$urv1";}
else
{$pol=$sloz;}


}
else
{$pol=".";}

print 
"Cesta: <b>$pol</b>
<br>
<a href=\"$aktualni_soubor\">Hlavní soubor</a>";

$i=0;
$cesta[]="";
$handle=opendir($pol);
while($soub=readdir($handle))
{
$i++;
$cesta[$i]=$soub;
}
closedir($handle);

sort($cesta);
reset($cesta);

for($i=1;$i<count($cesta);$i++)
{
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
</tr>";

}//end for

print "</table>";

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
{echo "FTP aplaud selhal!";}
else
{echo "Uloženo";}
ftp_close($conn_id); 
}
?>
