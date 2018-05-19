<?
$soubor="administrace/obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru("administrace")));
fclose($u);

$del=DelkaPoleGalerie("administrace");

if(((count($udaj)-1)/$del)!=0)
{
print 
"<table border=\"1\" cellpadding=\"4\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td align=\"center\">Název galerie:</td>
<td align=\"center\">Poèet fotek:</td>
<td align=\"center\">Popis:</td>
<td align=\"center\">Založeno:</td>
</tr>";
for($i=1;$i<((count($udaj)-1)/$del)+1;$i++)
{
if(PocetFotek($i,"administrace",true)!=0)
{$gal="<a href=\"index.php?kam=galerieobrazku&str=1&cis=$i\" class=\"odkaz\">{$udaj[($i*$del)-3]}</a>";}
else
{$gal="{$udaj[($i*$del)-3]}";}

echo 
"<tr>
<td align=\"center\" class=\"f12\">$gal</td>
<td align=\"center\" class=\"f12\">".PocetFotek($i,"administrace",false)."</td>
<td align=\"center\" class=\"f12\">{$udaj[($i*$del)-2]}</td>
<td align=\"center\" class=\"f12\">{$udaj[($i*$del)]}</td>
</tr>";
}//end for
print 
"
</table>
<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\">
<tr>
<td height=\"30px\"></td>
</tr>
<tr>
<td width=\"460px\" align=\"center\"><img border=\"0\" src=\"http://trainz.jedisoft.cz/counter.php?owner=Krumlov\"></td>
</tr>
</table>
";
}
else
{print "Žádné galerie!";}
?>
