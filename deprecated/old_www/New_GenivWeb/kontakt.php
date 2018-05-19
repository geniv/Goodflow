<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto stránky máte zákaz vstupu!!</h2>";
 exit;}
}
//dopsat!!
?>
<table border=0 align=center valign=top>
<tr>
<td>Jméno:</td>
<td><INPUT type=text name=jmen></td>
</tr>
<tr>
<td>Pøedmìt:</td>
<td><INPUT type=text name=pred></td>
<tr>
<td colspan=2><TEXTAREA rows=7 cols=30 name=vzk></TEXTAREA></td>
</tr>
<tr>
<th colspan=2><INPUT type=button value="Odeslat" onclick="gj.mejljm.value=jmen.value;gj.mejlpr.value=pred.value;gj.mejlzp.value=vzk.innerText;gj.okd.value='kontakt';gj.posli.click();"><hr></th>
</tr>
<tr>
<th colspan=2>Kontakt na mì: Geniv@centrum.cz</th>
</tr>
<tr>
<th colspan=2>ICQ: 312 007 953<hr></th>
</tr>
<tr>
<th colspan=2>Odkazy na stránky na kterých jsem dìlal funkci:</th>
</tr>
<tr>
<th colspan=2><hr><a href="http://www.studio-effect.ic.cz" target="_blank">Studio effect (na zakázku)</a><hr></th>
</tr>
<tr>
<th colspan=2><a href="http://www.vysinka.com" target="_blank">Vysinka.com - stránky s elektro tématikou</a></th>
</tr>
<tr>
<th colspan=2><a href="http://www.starcraftii.cz/" target="_blank">Starcraft II - stránky populární real-time strategické hry</a><hr></th>
</tr>
<tr>
<th colspan=2><a href="http://cz-sk-trainz-tutorial.ic.cz/" target="_blank">CZ & SK Trainz tutorial</a></th>
</tr>
<tr>
<th colspan=2><a href="http://fugess.trainz.cz/forum/" target="_blank">Fugessovo fórum</a></th>
</tr>
<tr>
<th colspan=2><a href="http://hlupin.cz/" target="_blank">(Hlupin.cz) - <font color="red">OSTUDA!!!<br>s tìmito stránkami už nemá náš vyvojový tým<br>nic spoleènýho!</font></a></th>
</tr>
<tr>
<th colspan=2><a href="http://Hlupin.ic.cz" target="_blank">Hlupin.ic.cz (pøesunuto z Hlupin.cz)</a></th>
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
$zpr="Odesilatel: <b>".$mejljm."</b>\n<br>Zpráva: <b>".$mejlzp."</b>;\n<br>Odesilatel: \n<br>IP: <b>".$REMOTE_ADDR."</b>\n<br>V èase: ".
Date("H:i.s j.F. Y").", Neboli: ".Date("H:i.s A, j.m. Y")."\n<br>Typ prohlížeèe: ".$HTTP_USER_AGENT.
"\n<br>Server: \n<br>Typu: ".$SERVER_NAME."\n<br> Software serveru: ".$SERVER_SOFTWARE;
Mail("geniv@centrum.cz",$mejlpr,$zpr); 
print "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><center><h2>Odesláno!</h2>\n V èase: ".Date("H:i:s - j.m. Y</center>");
}
?>
