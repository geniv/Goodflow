aplaud<br>
<form>
<input type="file" name="souborek">
<input type="submit" value="kopni to tam!!" onclick="posl.value='jo';">
<input type="hidden" name="posl">
</form>
<?
//$cesta=dirname($PATH_TRANSLATED);
if(!Empty($souborek))
{
$naweb=basename($souborek);
}

if(!Empty($posl) and $posl=="jo")
{
$ftp_server="fugess.trainz.cz";
$ftp_user_name="jedisoft_fugess";
$ftp_user_pass="siemens";

$conn_id = ftp_connect($ftp_server); 
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

$source_file=$souborek; //z komplu
$destination_file=$naweb; //na ftp
//na serveru to házi chybu ohlednì cesty èi co..
$upload =ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY); 

if(!$upload) 
{
echo "FTP upload has failed!";
}
else
{
echo "Uloženo <b>$source_file</b> na <i>$ftp_server</i> jako <u>$destination_file</u>";
}

ftp_close($conn_id); 
}
?>
