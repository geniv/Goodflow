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
"<h3>Upravit komentáø v galerii: <u>{$udaj[($galerie*$del)-3]}</u></h3>
<table cellpadding=\"6\" cellspacing=\"0\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td>#</td>
<td>Miniatura</td>
<td>Název fotky</td>
<td>Komentáø</td>
<td>Akce</td>
</tr>";

for($i=1;$i<((count($foto)-1)/$del1)+1;$i++)
{
if(strpos($foto[($i*$del1)],"center><a href=")==1)
{$kom="Nelze kliknout";}
else
{$kom=$foto[($i*$del1)];}

echo
"<tr>
<td>$i</td>
<td><img src=\"../{$udaj[($galerie*$del)-1]}/miniatury/{$foto[($i*$del1)-2]}\"></td>
<td>{$foto[($i*$del1)-1]}</td>
<td>$kom</td>
<td><a href=\"index.php?kam=$kam&galerie=$galerie&cislo=$i\" class=\"odkaz\">Upravit</a></td>
</tr>";
}//end for
print
"</table>";

if(!Empty($cislo))
{
print
"upravujete øádek: $cislo<br>
<form method=\"post\">
komentáø: <input type=\"text\" name=\"komentar\" value=\"".htmlspecialchars($foto[($cislo*$del1)])."\"><br>
<input type=\"hidden\" name=\"nazev\" value=\"{$foto[($cislo*$del1)-1]}\">
<input type=\"hidden\" name=\"nahled\" value=\"{$foto[($cislo*$del1)-2]}\"><br>";
}

if(Empty($upraveno) and !Empty($cislo))
{
print 
"<input type=\"submit\" value=\"Upravit\" name=\"upraveno\">
</form>";//antiblbovské ošetøení
}

if(!Empty($upraveno) and !Empty($cislo))
{
if(Empty($komentar)){$komentar="";}
print UpravitObrazek($cislo,$galerie,$nahled,$nazev,stripslashes($komentar));
}

}
else
{print "ádné fotky!";}

}
else
{print "Neoprávnìnı pøístup!";}

}
else
{print "Nepovolenı pøístup";}
?>
