<?
if(!Empty($cis))
{
$soubor="administrace/obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru("administrace")));
fclose($u);

$del=DelkaPoleGalerie("administrace");

$cesta="{$udaj[($del*$cis)-1]}";
$miniatury="{$udaj[($del*$cis)-1]}/miniatury";

$radku=HlavniKonfigurace("administrace",3);
$sloupcu=HlavniKonfigurace("administrace",4);

$PocetFotek=PocetFotek($cis,"administrace",true);//celkem fotek
if($PocetFotek!=0)
{
//$nazev="administrace/foto_{$cis}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$zob_str=$radku*$sloupcu;//na stránku fotek
$pocstr=ceil($PocetFotek/$zob_str);//poèet stránek

$zob_max=$str*$zob_str;
$zob_min=($zob_max-$zob_str)+1;

//print "<img src=\"".ZjistiTypAVyberObr("ikona_soubor.jpg")."\">";

//otevøení dle èísla
print 
"<table border=\"0\">";
$poc=0;
for($i=1;$i<$radku+1;$i++)
{
print "<tr>";
for($i1=1;$i1<$sloupcu+1;$i1++)
{
$poc++;
$poradi=($poc+$zob_min)-1;

if($poradi>=$zob_min and $poradi<=$zob_max)
{
print 
"<td valign=\"top\">".ObrazekFotky($cis,$miniatury,$cesta,$poradi)."</td>";
}//end if stranek
}//end for 1
print "</tr>";
}//end for
print 
"</table>
<table align=\"left\" border=\"0\" cellpadding=\"4\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td align=\"right\">Stránka:</td>
<td align=\"center\">$str z $pocstr</td>
</tr>
</table>
<table align=\"right\" border=\"0\" cellpadding=\"4\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td align=\"center\">".jdinastranu($str,$cis,$pocstr,"galerieobrazku")."</td>
</tr>
</table>
";

}
else
{print "Prázdná galerie!";}

}
else
{print "Neoprávnìný pøístup!";}
?>
