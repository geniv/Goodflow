<?
require "zac.php";
?>
<h2 align=center><u>Vzkazy pro správce stránek</u></h2>
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
<td valign=top>Zpráva:</td>
<td><textarea rows=8 cols=30 name=zpr></textarea></td>
</tr>
<tr>
<th colspan=2><input type=submit value="Pøidejte svuj vzkaz..."></th>
</tr>
</table>
</form>
<hr>
<?
if(!Empty($jme) and !Empty($ema) and !Empty($zpr))
{
print "<center>Zpráva byla pøidána</center>";
$zprv="<b><u>Jméno:</u></b> ".$jme."<br><b><u>E-mail:</u></b> ".$ema."<br><b><u>Zpráva:</u></b> ".$zpr."<br>".Date("[ H:i:s - j.m. Y ]")."<br><hr>\n";
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
