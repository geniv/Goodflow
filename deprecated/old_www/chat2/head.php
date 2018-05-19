<?
Header("Pragma: no-cache");
Header("Cache-control: no-cache");
Header("Expires: ".GMDate("D, d m Y H:i:s")." GMT");
?>
<html>
<head>
	<title>Kontrola nových odkazov</title>
	<style type="text/css">
		input {
			background-color: #666666;
			color: #000000;
			border-left: 0px;
			border-right: 0px;
			border-top: 0px;
			border-bottom: 0px;
		}
	</style>
</head>
<body bgcolor="#666666">
<?
require "./const.php";

ClearStatCache(); // vymaz vyrovnavaciu pamet
$newSize = FileSize($subor); // zisti velkost suboru

if($newSize != $oldSize): // pribudol novy odkaz ?
?>
	<script language="JavaScript">
	parent.frames["show"].location = "show.php" // obnov ramec "show"
	</script>
<?
endif;
?>
<form name="form">
Kontrola nastane za <input type="text" name="timer" size="3" readonly> s
</form>

<script language="JavaScript">
var t = 10 // konstanta v sekundach znovunacitania stranky

function Timer(){
	document.form.timer.value = t // vypis do formulara
	if(!t) // uplynula doba casovaca
		parent.frames["head"].location = "head.php?oldSize=<?echo $newSize?>"
	else{
		t--
		setTimeout("Timer()",999) // spusti opat o 1 sekundu
		}
	}
Timer() // spustenie odpocitavania
</script>

</body>
</html>