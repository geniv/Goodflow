<?
require "zac.php";
?>
<h2 align=center><u>Vzkazy pro spr�vce str�nek</u></h2>
<form method=post>
<table border=0 align=center>
<tr>
<td>Jmeno:</td>
<td><input type=text name=jme></td>
</tr>
<tr>
<td>Email:</td>
<td><input type=text name=ema value="@"></td>
</tr>
<tr>
<td valign=top>Zpr�va:</td>
<td><textarea rows=8 cols=30 name=zpr></textarea></td>
</tr>
<tr>
<th colspan=2><input type=submit value="P�idejte svuj vzkaz..."></th>
</tr>
</table>
</form>
<hr>
<?
if(!Empty($jme) and !Empty($ema) and !Empty($zpr))
{
print "<center>Zpr�va byla p�id�na</center>";
$zprv="<b><u>Jm�no:</u></b> ".$jme."<br><b><u>E-mail:</u></b> ".$ema."<br><b><u>Zpr�va:</u></b> ".$zpr."<br>".Date("[ H:i:s - j.m. Y ]")."<br><hr>\n";
$soub="vzk_alkcnjsdnbjcwnsbdviuwnuiec.php";
$uk=fopen($soub,"a");
fwrite($uk,$zprv);
fclose($uk);
}
$vyst=file("vzk_alkcnjsdnbjcwnsbdviuwnuiec.php");
while($radka=Each($vyst))
{
print $radka["value"];
}
require "kon.php";
?>
