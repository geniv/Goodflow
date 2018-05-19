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

//Poèet fotek: ".PocetFotek($galerie,".",true)."<br>
echo
"Velikost galerie i s miniaturama: ".VelikostGalerie($udaj[($galerie*$del)-1])."<br>
Velikost originálních fotek: ".velikost_adresare("../{$udaj[($galerie*$del)-1]}",true)."<br>
Velikost miniatur: ".velikost_adresare("../{$udaj[($galerie*$del)-1]}/miniatury",true)."<br>
Poèet souborù originálních fotek: ".(pocet_souboru("../{$udaj[($galerie*$del)-1]}")-1)."<br>
Poèet souborù miniatur: ".pocet_souboru("../{$udaj[($galerie*$del)-1]}/miniatury");

}
else
{print "Neoprávnìný pøístup!";}

}
else
{
print "Nepovolený pøístup";
}
?>
