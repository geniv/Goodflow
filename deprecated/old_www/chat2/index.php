<?
require "./const.php";

ClearStatCache(); // vymaz vyrovnavaciu pamet

if(!File_Exists($subor)) // ak subor neexistuje - vytvor ho
	FClose(FOpen($subor,"w"));
?>
<html>
<head>
	<title>Jednoduchý "chat"</title>
</head>

<frameset rows="100,*,20">
	<frameset cols="34%,*">
		<frame src="head.php?oldSize=<?ClearStatCache(); echo FileSize($subor)?>" name="head">
		<frame src="form.php?name=&sprava=" name="form">
	</frameset>
	<frame src="show.php" name="show">
</frameset>

</html>
