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

//Po�et fotek: ".PocetFotek($galerie,".",true)."<br>
echo
"Velikost galerie i s miniaturama: ".VelikostGalerie($udaj[($galerie*$del)-1])."<br>
Velikost origin�ln�ch fotek: ".velikost_adresare("../{$udaj[($galerie*$del)-1]}",true)."<br>
Velikost miniatur: ".velikost_adresare("../{$udaj[($galerie*$del)-1]}/miniatury",true)."<br>
Po�et soubor� origin�ln�ch fotek: ".(pocet_souboru("../{$udaj[($galerie*$del)-1]}")-1)."<br>
Po�et soubor� miniatur: ".pocet_souboru("../{$udaj[($galerie*$del)-1]}/miniatury");

}
else
{print "Neopr�vn�n� p��stup!";}

}
else
{
print "Nepovolen� p��stup";
}
?>
