<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto str�nky m�te z�kaz vstupu!!</h2>";
 exit;}
}
?>
<h1>Ve v�stavb�!</h1>
Tady je n�kolik program�, kter� se v�m ur�it� hod� p�i tvorb� 
plo�n�ch spoj�.
<table border=1>
<tr>
<td>Program</td>
<td>Popis</td>
</tr>
<tr>
<td><input type=image src="krok.gif" onclick="location.href='crococlip.rar';"></td>
<td>Crocodilclip</td>
</tr>
<tr>
<td><input type=image src="help.gif" onclick="location.href='elektro.rar';"></td>
<td>Help</td>
</tr>
<tr>
<td><input type=image src="" onclick="location.href='gmouse20.rar';"></td>
<td>Ghoust mouse - p�esune se!</td>
</tr>
</table>
