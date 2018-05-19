<?
//if(($a<>0)&&($b<>0))
//{
if($a<>0){$a=0;}
$vys=$a+$b;
//echo "Výsledek souètu èísel $a a $b je: $vys<br>\n";
//}
echo "Verze OS: ".PHP_OS."<br>\n";
echo "Verze PHP: ".PHP_VERSION."<br>\n";

//echo "cislo CP je: $pc<br>";
//<input type="image" src=button_ankety_a.gif name=obr1>
?>
<body>
<form method=post>
<input type="text" name="a"><br>
<input type="text" name="b"><br>
<input type="text" name="pc" value=<? echo $pc ?>><br>
<input type="submit" value=vysledek>
</form>

<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0>
	<TR>
		<TD bgcolor=<? echo $pc ?>>......<? echo $pc ?></TD>
	</TR>
</TABLE>