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
"<h3>Upravit galerii</h3>
<table cellpadding=\"6\" cellspacing=\"0\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td>#</td>
<td>Název</td>
<td>Popis</td>
<td>Fotek</td>
<td>Datum vytvoøení</td>
<td>Akce</td>
</tr>";
//{$udaj[($i*$del)-1]}
for($i=1;$i<((count($udaj)-1)/$del)+1;$i++)
{
print
"<tr>
<td>$i</td>
<td>{$udaj[($i*$del)-3]}</td>
<td>{$udaj[($i*$del)-2]}</td>
<td>".PocetFotek($i,".",true)."</td>
<td>{$udaj[($i*$del)]}</td>
<td><a href=\"index.php?kam=$kam&cislo=$i\" class=\"odkaz\">Upravit</a></td>
</tr>";
}//end for

print 
"</table>";

if(!Empty($cislo))
{
print
"upravujete øádek: $cislo<br>
<form method=\"post\">
Název galerie: <input type=\"text\" name=\"nazev\" value=\"".htmlspecialchars($udaj[($cislo*$del)-3])."\"><br>
Popis galerie: <TextArea name=\"popis\">".htmlspecialchars($udaj[($cislo*$del)-2])."</TextArea><br>
<input type=\"hidden\" name=\"slozka\" value=\"{$udaj[($cislo*$del)-1]}\">
<input type=\"hidden\" name=\"datum\" value=\"{$udaj[($cislo*$del)]}\">";

if(Empty($nazev) and Empty($popis))
{
print
"<input type=\"submit\" value=\"Uprav\">
</form>";
}//end empty cislo

if(!Empty($nazev) and !Empty($popis) and !Empty($cislo))
{print UpravitGalerii(stripslashes($nazev),stripslashes($popis),$slozka,$datum,$cislo);}

}//end empty cislo

}
else
{print "Žádné galerie!";}

}
else
{print "Nepovolený pøístup";}
?>
