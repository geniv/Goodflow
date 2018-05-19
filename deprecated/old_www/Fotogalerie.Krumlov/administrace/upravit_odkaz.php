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
"<h3>Upravit Odkaz</h3>
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
<td><a href=\"index.php?kam=upravit_odkaz&cislo=$i\" class=\"odkaz\">Upravit</a></td>
</tr>";
}//end for

print "</table>";

if(!Empty($cislo))
{
print
"upravujete øádek: $cislo<br>
<form method=\"post\">
Popis: <input type=\"text\" name=\"popis\" value=\"".htmlspecialchars($udaj[($cislo*$del)-1])."\"><br>
Link: <input type=\"text\" name=\"link\" value=\"".htmlspecialchars($udaj[($cislo*$del)])."\"><br>";
if(Empty($popis) and Empty($link))
{
print
"<input type=\"submit\" value=\"Upravit\"><br>
</form>";
}

if(!Empty($popis) and !Empty($link) and !Empty($cislo))
{print UpravitOdkaz($cislo,stripslashes($popis),stripslashes($link));}

}//end empty cislo

}
else
{print "Žádné odkazy";}

}
else
{print "Nepovolený pøístup";}

?>
