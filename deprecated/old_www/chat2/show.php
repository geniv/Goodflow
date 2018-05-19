<?
Header("Pragma: no-cache");
Header("Cache-control: no-cache");
Header("Expires: ".GMDate("D, d m Y H:i:s")." GMT");
?>
<html>
<head>
	<title>Zobrazenie odkazov</title>
</head>
<body bgcolor="#cccccc">
<p style="font-family: 'ARIAL CE', 'HELVETICA CE','ARIAL','HELVETICA'; font-size: 12px;">
<?
require "./const.php"; // nacitaj "konstanty"

$fp = FOpen($subor,"r"); // otvor subor na citanie

ClearStatCache(); // vymaz vyrovnavaciu pamet
$velkostSuboru = FileSize($subor); // zisti velkost suboru

if($velkostSuboru > $maxOdkazByte) // uz mam v datovom subore viac sprav ako maxPocetOdkaz ?
	FSeek($fp,$velkostSuboru - $maxOdkazByte); // zmen poziciu na poslednych maxPocetOdkaz

FPassThru($fp); // vypis suboru od aktualnej pozicie & zatvor subor
?>
</p>
</body>
</html>