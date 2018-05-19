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

$soubor="foto_{$galerie}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($soubor,"r");
$foto=explode("--FOT--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del1=DelkaPoleFotek(".");

if((count($foto)-1)!=0)
{
echo
"<h3>Smazat obrázek v galerii: <u>{$udaj[($galerie*$del)-3]}</u></h3>
<table cellpadding=\"6\" cellspacing=\"0\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td>#</td>
<td>Miniatura</td>
<td>Komentáø</td>
<td>Miniatura</td>
<td>Fotka originál</td>
<td>Akce</td>
</tr>";

for($i=1;$i<((count($foto)-1)/$del1)+1;$i++)
{
if(file_exists("../{$udaj[($galerie*$del)-1]}/miniatury/nahled_{$foto[($i*$del1)-1]}")=="true")
{$mini="OK";}
else
{$mini="Neexistuje!";}

if(file_exists("../{$udaj[($galerie*$del)-1]}/{$foto[($i*$del1)-1]}")=="true")
{$fot="OK";}
else
{$fot="Neexistuje!";}

if(strpos($foto[($i*$del1)],"center><a href=")==1)
{$kom="Nelze";}
else
{$kom=$foto[($i*$del1)];}

echo
"<tr>
<td>$i</td>
<td><img src=\"../{$udaj[($galerie*$del)-1]}/miniatury/{$foto[($i*$del1)-2]}\"></td>
<td>$kom</td>
<td>$mini</td>
<td>$fot</td>
<td><a href=\"index.php?kam=$kam&galerie=$galerie&cislo=$i\">Smazat</a></td>
</tr>";
}//end for
print
"</table>";

if(Empty($potvrzeni) and !Empty($cislo))
{
print
"<form method=\"post\">
Smazat? <b>{$foto[($cislo*$del1)-1]}</b>, øádek: $cislo<br>
<input type=\"submit\" name=\"potvrzeni\" value=\"Ano\">
<input type=\"submit\" name=\"potvrzeni\" value=\"Ne\">
</form>";
}

if(!Empty($potvrzeni) and $potvrzeni=="Ano" and !Empty($cislo))
{
$ftp_server=PristupoveFtpUdaje(".",1);
$ftp_user_name=PristupoveFtpUdaje(".",2);
$ftp_user_pass=PristupoveFtpUdaje(".",3);
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);//musí

if(strpos($foto[($cislo*$del1)],"a href=")==1)
{
/*
$soubor="foto_{$galerie}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($soubor,"r");
$udaj=explode("--FOT--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleFotek(".");

$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$gal=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del1=DelkaPoleGalerie(".");
*/
//print $foto[($cislo*$del1)];
//print "../".ExtrahujNazevZOdkazu($foto[($cislo*$del1)]);
ftp_delete($conn_id,"../".ExtrahujNazevZOdkazu($foto[($cislo*$del1)]));//smazat soubor
}
$soubor="foto_{$galerie}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($soubor,"r");
$udaj=explode("--FOT--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleFotek(".");

$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$gal=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del1=DelkaPoleGalerie(".");

//ftp_delete($conn_id,"../{$gal[($galerie*$del1)-1]}/miniatury/nahled_{$udaj[($cislo*$del)-1]}");
//ftp_delete($conn_id,"../{$gal[($galerie*$del1)-1]}/{$udaj[($cislo*$del)-1]}");
ftp_close($conn_id);
print SmazatObrazek($cislo,$galerie);
}

}
else
{print "Žádné fotky!";}

}
else
{print "Neoprávnìný pøístup!";}

}
else
{print "Nepovolený pøístup";}
?>
