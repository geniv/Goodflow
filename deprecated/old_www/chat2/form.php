<html>
<!-- Ak nie je vyplnene meno - zameraj nan kurzor. Inak zameraj na spravu. -->
<body bgcolor="#666666" onLoad="if(document.f.meno.value.length) document.f.sprava.focus(); else document.f.meno.focus();">
<?
require "./const.php";

if($sprava != ""): // ak sprava nieco obsahuje

	if($meno == "")
		$meno = "anonym"; // ak uzivatel nezadal meno bude "anonym"
	else
		$meno = StripSlashes(StrTr($meno,"<>&","***")); // odstran lomitka spred citlivych znakov a nahradi niektore nebezpecne znaky

	$sprava = StripSlashes(StrTr($sprava,"<>&","***")); // odstran lomitka spred citlivych znakov a nahradi niektore nebezpecne znaky

	$fp = fopen($subor,"a"); // otvor subor pre doplnenie
	fputs($fp,sprintf($format,$meno,$sprava)); // naformatuj odkaz a zapis ho do suboru
	fclose($fp); // zatvor subor
	?>
		<script language="JavaScript">
		parent.frames["show"].location = "show.php" // bola pridana sprava, obnov zobrazenie odkazov
		</script>
	<?
	endif;
?>
<form method=post name="f">
<table border="0" align="center">
	<tr align="center">
		<td>meno</td>
		<td>správa</td>
	</tr>
	<tr align="center" valign="baseline">
		<td><input type="text" name="meno" size="8" maxlength="<?echo $maxDlzkaMeno?>" value="<?echo $meno?>"></td>
		<td><input type="text" name="sprava" size="40" maxlength="<?echo $maxDlzkaSprava?>"> <input type=submit value=" Ok "></td>
	</tr>
</table>
</form>
</body>
</html>
