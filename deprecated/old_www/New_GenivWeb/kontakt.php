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
<th colspan=2><INPUT type=button value="Odeslat" onclick="gj.mejljm.value=jmen.value;gj.mejlpr.value=pred.value;gj.mejlzp.value=vzk.innerText;gj.okd.value='kontakt';gj.posli.click();"><hr></th>
</tr>
<tr>
<th colspan=2>Kontakt na m�: Geniv@centrum.cz</th>
</tr>
<tr>
<th colspan=2>ICQ: 312 007 953<hr></th>
</tr>
<tr>
<th colspan=2>Odkazy na str�nky na kter�ch jsem d�lal funkci:</th>
</tr>
<tr>
<th colspan=2><hr><a href="http://www.studio-effect.ic.cz" target="_blank">Studio effect (na zak�zku)</a><hr></th>
</tr>
<tr>
<th colspan=2><a href="http://www.vysinka.com" target="_blank">Vysinka.com - str�nky s elektro t�matikou</a></th>
</tr>
<tr>
<th colspan=2><a href="http://www.starcraftii.cz/" target="_blank">Starcraft II - str�nky popul�rn� real-time strategick� hry</a><hr></th>
</tr>
<tr>
<th colspan=2><a href="http://cz-sk-trainz-tutorial.ic.cz/" target="_blank">CZ & SK Trainz tutorial</a></th>
</tr>
<tr>
<th colspan=2><a href="http://fugess.trainz.cz/forum/" target="_blank">Fugessovo f�rum</a></th>
</tr>
<tr>
<th colspan=2><a href="http://hlupin.cz/" target="_blank">(Hlupin.cz) - <font color="red">OSTUDA!!!<br>s t�mito str�nkami u� nem� n� vyvojov� t�m<br>nic spole�n�ho!</font></a></th>
</tr>
<tr>
<th colspan=2><a href="http://Hlupin.ic.cz" target="_blank">Hlupin.ic.cz (p�esunuto z Hlupin.cz)</a></th>
</tr>
<tr>
<th colspan=2><a href="http://fugess.trainz.cz/" target="_blank">Fugess.trainz.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://cestina-cichnova.ic.cz/" target="_blank">Cestina-cichnova.ic.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://geniv.wu.cz/">Geniv.wu.cz (Tento WEB)</a></th>
</tr>
<tr>
<th colspan=2><a href="http://zst.ic.cz" target="_blank">Zst.ic.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://frantisekmarak.wz.cz" target="_blank">Frantisekmarak.wz.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://lalak.wz.cz" target="_blank">Lalak.wz.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://Dacanweb.borec.cz" target="_blank">Dacanweb.borec.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://ervin.unas.cz" target="_blank">Ervin.unas.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://Kalimevodu.ic.cz" target="_blank">kalimevodu.ic.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://bechystova-stranka.ic.cz" target="_blank">Bechystova-stranka.ic.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://george-dohnal.ic.cz" target="_blank">George-dohnal.ic.cz</a></th>
</tr>
<tr>
<th colspan=2><a href="http://behnasweb.tym.cz" target="_blank">Behnasweb.tym.cz</a><hr></th>
</tr>
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
