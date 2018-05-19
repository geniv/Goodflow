<?
if(!Empty($AD_jmeno) and !Empty($AD_heslo) and LoginAdmin($AD_jmeno,$AD_heslo,".")=="true")
{
DostaveniDelkyOtvirani(false);

$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleGalerie(".");

if(((count($udaj)-1)/$del)!=0)
{
print
"<h3>Smazat galerii</h3>
<table cellpadding=\"6\" cellspacing=\"0\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td>#</td>
<td>Název</td>
<td>Popis</td>
<td>Fotek</td>
<td>Datum vytvoøení</td>
<td>Akce</td>
</tr>";

for($i=1;$i<((count($udaj)-1)/$del)+1;$i++)
{
if(PocetFotek($i,".",true)==0)
{$prikaz="<a href=\"index.php?kam=$kam&cislo=$i\">Smazat</a>";}
else
{$prikaz="Nelze smazat!";}
//{$udaj[($i*$del)-1]}
print
"<tr>
<td>$i</td>
<td>{$udaj[($i*$del)-3]}</td>
<td>{$udaj[($i*$del)-2]}</td>
<td>".PocetFotek($i,".",true)."</td>
<td>{$udaj[($i*$del)]}</td>
<td>$prikaz</td>
</tr>";
}//end for

print 
"<tr>
<th colspan=\"6\">Galerii lze smazat až tehdy když je úplnì prázdná složka (bez fotek)</th>
</tr>
</table>";

if(Empty($potvrzeni) and !Empty($cislo))
{
print
"<form method=\"post\">
Smazat? <b>{$udaj[($cislo*$del)-3]}</b>, øádek: $cislo<br>
<input type=\"submit\" name=\"potvrzeni\" value=\"Ano\">
<input type=\"submit\" name=\"potvrzeni\" value=\"Ne\">
</form>";
}

if(!Empty($potvrzeni) and $potvrzeni=="Ano" and !Empty($cislo))
{
$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleGalerie(".");
$slozka=$udaj[($cislo*$del)-1];

$ftp_server=PristupoveFtpUdaje(".",1);
$ftp_user_name=PristupoveFtpUdaje(".",2);
$ftp_user_pass=PristupoveFtpUdaje(".",3);
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);//musí
ftp_delete($conn_id,"administrace/foto_{$cislo}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php");
ftp_rmdir($conn_id,"../$slozka/miniatury");
ftp_rmdir($conn_id,"../$slozka");
ftp_close($conn_id);
print SmazatGalerii($cislo);
}

}
else
{print "Žádné galerie!";}

}
else
{
print "Nepovolený pøístup";
}
?>
