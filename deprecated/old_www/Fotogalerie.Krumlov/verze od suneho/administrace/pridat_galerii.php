<?
if(!Empty($AD_jmeno) and !Empty($AD_heslo) and LoginAdmin($AD_jmeno,$AD_heslo,".")=="true")
{
DostaveniDelkyOtvirani(false);

print
"<h3>Pøidat galerii</h3>
<form method=\"post\">
Název galerie: <input type=\"text\" name=\"nazev\"><br>
Popis galerie: <TextArea name=\"popis\"></TextArea><br>";
if(Empty($nazev) and Empty($popis))
{
print "<input type=\"submit\" value=\"Vytvoø\">";
}
print "</form>";

if(!Empty($nazev) and !Empty($popis))
{
/*
$ftp_server=PristupoveFtpUdaje(".",1);
$ftp_user_name=PristupoveFtpUdaje(".",2);
$ftp_user_pass=PristupoveFtpUdaje(".",3);

$conn_id=ftp_ssl_connect($ftp_server);
$conn_id=ftp_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);//musí

$NazevSlozky=VygenerujNazev();
ftp_mkdir($conn_id,"../$NazevSlozky"); //1.adr
ftp_chmod($conn_id,0777,"$NazevSlozky"); //nastav na zápis
ftp_mkdir($conn_id,"../$NazevSlozky/miniatury");//2.adr
ftp_chmod($conn_id,0777,"$NazevSlozky/miniatury");//nastav na zápis
ftp_close($conn_id);
*/

$NazevSlozky=VygenerujNazev();
mkdir("../$NazevSlozky", 0777); //1.adr
mkdir("../$NazevSlozky/miniatury", 0777);//2.adr

print PridatGalerii(stripslashes($nazev),stripslashes($popis),$NazevSlozky);
}

}
else
{print "Nepovolený pøístup";}
?>
