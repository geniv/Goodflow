<?
if(!Empty($AD_jmeno) and !Empty($AD_heslo) and LoginAdmin($AD_jmeno,$AD_heslo,".")=="true")
{
DostaveniDelkyOtvirani(false);

$soubor="odkazy_poiucvcdskjhvkjvbsijhvjkvnjkhjfosibvdhfbhjvdhgvjydbvjhdbvjdsbvjhdsbvhjsdbvhjsdbvvlkanhsbvshvuvuifubghsjbshvs.php";
$u=fopen($soubor,"r");
$udaj=explode("--ODK--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleOdkazu(".");

if(((count($udaj)-1)/$del)!=0)
{
print
"<h3>Smazat Odkaz</h3>
<table cellpadding=\"6\" cellspacing=\"0\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td>Odkaz</td>
<td>Popis</td>
<td>Link</td>
<td>Akce</td>
</tr>";

for($i=1;$i<((count($udaj)-1)/$del)+1;$i++)
{
print
"<tr>
<td><a href=\"{$udaj[($i*$del)]}\" target=\"_blank\" class=\"odkaz\">{$udaj[($i*$del)-1]}</a></td>
<td>{$udaj[($i*$del)-1]}</td>
<td>{$udaj[($i*$del)]}</td>
<td><a href=\"index.php?kam=smazat_odkaz&cislo=$i\" class=\"odkaz\">Smazat</a></td>
</tr>";
}//end for

print "</table>";

if(Empty($potvrzeni) and !Empty($cislo))
{
print
"<form method=\"post\">
smazat? <b>{$udaj[($cislo*$del)-1]}</b>, øádek: $cislo<br>
<input type=\"submit\" name=\"potvrzeni\" value=\"Ano\">
<input type=\"submit\" name=\"potvrzeni\" value=\"Ne\">
</form>";
}

if(!Empty($potvrzeni) and $potvrzeni=="Ano" and !Empty($cislo))
{print SmazatOdkaz($cislo);}

}//end empty cislo
else
{print "Žádné odkazy";}

}
else
{print "Nepovolený pøístup";}
?>
