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
//dopsat!!
?>
<table border=0 align=center valign=top>
<tr>
<td>Jm�no:</td>
<td><INPUT type=text name=jmen></td>
</tr>
<tr>
<td>P�edm�t:</td>
<td><INPUT type=text name=pred></td>
<tr>
<td colspan=2><TEXTAREA rows=7 cols=30 name=vzk></TEXTAREA></td>
</tr>
<tr>
<th colspan=2><INPUT type=button value="Odeslat" onclick="gj.mejljm.value=jmen.value;gj.mejlpr.value=pred.value;gj.mejlzp.value=vzk.innerText;gj.okd.value='kontakt';gj.posli.click();"></th>
</tr>
<tr>
<th colspan=2>Kontakt na m�: Geniv@centrum.cz</th>
</tr>
<tr>
<th colspan=2>ICQ: 312 007 953<hr></th>
</tr>
<tr>
<th colspan=2>Odkazy na str�nky na kter�ch jsem d�lal:</th>
</tr>
<tr>
<th colspan=2><a href="http://fugess.trainz.cz/" target="_blank">Fugess.trainz.cz</a></th>
<tr>
<tr>
<th colspan=2><a href="http://cestina-cichnova.ic.cz/" target="_blank">Cestina-cichnova.ic.cz</a><hr></th>
<tr>
</table>
<?
if(!Empty($mejljm)&& !Empty($mejlpr)&& !Empty($mejlzp))
{
$zpr="Odesilatel: <b>".$mejljm."</b>\n<br>Zpr�va: <b>".$mejlzp."</b>;\n<br>Odesilatel: \n<br>IP: <b>".$REMOTE_ADDR."</b>\n<br>V �ase: ".
Date("H:i.s j.F. Y").", Neboli: ".Date("H:i.s A, j.m. Y")."\n<br>Typ prohl�e�e: ".$HTTP_USER_AGENT.
"\n<br>Server: \n<br>Typu: ".$SERVER_NAME."\n<br> Software serveru: ".$SERVER_SOFTWARE;
Mail("geniv@centrum.cz",$mejlpr,$zpr); 
print "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><center><h2>Odesl�no!</h2>\n V �ase: ".Date("H:i:s - j.m. Y</center>");
}
?>
