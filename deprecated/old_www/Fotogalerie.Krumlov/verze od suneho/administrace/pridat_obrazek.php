<?
if(!Empty($AD_jmeno) and !Empty($AD_heslo) and LoginAdmin($AD_jmeno,$AD_heslo,".")=="true")
{
if(!Empty($galerie))
{
DostaveniDelkyOtvirani(false);

$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleGalerie(".");

echo
"<h3>P�idat Obr�zek do galerie: <u>{$udaj[($galerie*$del)-3]}</u></h3>
Lze uploadovat bu� to fotku s koment��em nebo p��lohu.
<form method=\"post\" enctype=\"multipart/form-data\">
Fotka: <input type=\"file\" name=\"fotka\"><br>
Koment��: <input type=\"text\" name=\"komentar\"><br>
<br>
<u>P��loha:</u><br>
Soubor: <input type=\"file\" name=\"priloha\"><br>";

if(Empty($fotka) and Empty($priloha))
{
print
"<input type=\"submit\" value=\"P�idat\">
</form>";
}

if(!Empty($fotka) and $prm=getimagesize($fotka) and $prm[2]=="2")
{
if(Empty($komentar)){$komentar="";}

$param=getimagesize($fotka);//zji�t�n� parametr�
$nazev=VygenerujNazevObrazku($param[2]);//vygenerov�n� jm�na
/*
$ftp_server=PristupoveFtpUdaje(".",1);
$ftp_user_name=PristupoveFtpUdaje(".",2);
$ftp_user_pass=PristupoveFtpUdaje(".",3);
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);//mus�

$upload=ftp_put($conn_id,"../{$udaj[($galerie*$del)-1]}/$nazev",$fotka,FTP_BINARY);
//$upload=ftp_put($conn_id,"../{$udaj[($galerie*$del)-1]}/miniatury/nahled_{$nazev}",$fotka,FTP_BINARY);
*/
@UnLink("../{$udaj[($galerie*$del)-1]}/$nazev");
$upload = @move_uploaded_file($fotka, "../{$udaj[($galerie*$del)-1]}/$nazev");
@UnLink("../{$udaj[($galerie*$del)-1]}/miniatury/nahled_{$nazev}");
$upload = $upload && @copy("../{$udaj[($galerie*$del)-1]}/$nazev", "../{$udaj[($galerie*$del)-1]}/miniatury/nahled_{$nazev}");

if(!$upload)
{print "<font color=\"red\">Chyba p�i nahr�v�n� na server</font>";}
else
{
  print PridatObrazek($galerie,"../{$udaj[($galerie*$del)-1]}",$nazev,$fotka,stripslashes($komentar));

}
//ftp_close($conn_id);
}
else
{
if(!Empty($fotka))
{print "Jin� typ souboru! Podpora typ�: *.jpg <a href=\"index.php?kam=pridat_obrazek&galerie=$galerie\">Pokra�uj zde</a>";}
}

if(Empty($fotka) and !Empty($priloha))
{
//$priloha
$nazev=VygenerujMalyNazev()."_{$priloha_name}";
/*
$ftp_server=PristupoveFtpUdaje(".",1);
$ftp_user_name=PristupoveFtpUdaje(".",2);
$ftp_user_pass=PristupoveFtpUdaje(".",3);
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);//mus�

$upload=ftp_put($conn_id,"../{$udaj[($galerie*$del)-1]}/$nazev",$priloha,FTP_BINARY);
*/

$upload = move_uploaded_file($priloha,"../{$udaj[($galerie*$del)-1]}/$nazev");

//$obr=getimagesize("ikona_soubor.png");
//$naz=VygenerujNazevObrazku($obr[2]);
//copy("ikona_soubor.png","../{$udaj[($galerie*$del)-1]}/$naz");
//copy("ikona_soubor.png","../{$udaj[($galerie*$del)-1]}/miniatury/nahled_$naz");

if(!$upload)
{print "<font color=\"red\">Chyba p�i nahr�v�n� na server</font>";}
else
{print PridejKomentar($galerie,"{$udaj[($galerie*$del)-1]}/$nazev");}
//ftp_close($conn_id);
}

}
else
{print "Neopr�vn�n� p��stup!";}

}
else
{print "Nepovolen� p��stup";}
?>
