<?
//---------------------------------------------------------------------
$soub="manikura/administrace/udaje_manikura_oakdsjniunsvoioijsoihefoivhnwoigvjhirejfo.php";
$u=fopen($soub,"r");
$udj=explode("--UDJ--",fread($u,DelkaOtevirani("manikura/administrace")));
fclose($u);
//---------------------------------------------------------------------
echo
"<h4>Objednávky</h4>
Objednávky osobnì nebo na telefoním èísle: <b>{$udj[2]}</b><br>
viz.kontakt<br><br><br><u>Otevírací doba:</u><br>Pondìlí až pátek: 9:00 - 17:00 (nebo dle objednávek)<br>Sobota: dle objednávek";
?>
