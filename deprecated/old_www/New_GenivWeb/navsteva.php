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
<h2 align=center><u>N�v�t�vn� kniha</u></h2>
<table border=0 align=center>
<tr>
<th colspan=2><u>P�id�n� dal�� zpr�vy:</u></th>
</tr>
<tr>
<td>Jm�no:</td>
<td><input type=text name=jmen></td>
</tr>
<tr>
<td>E-mail:</td>
<td><input type=text value="@" name=emai></td>
</tr>
<tr>
<td>Zpr�va:</td>
<td rowspan=5><TEXTAREA name=dota rows=8 cols=25></TEXTAREA></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<th colspan=2><input type=button title="Vyplnil jsi v�echny �daje???" value="P�idej k dal��m..." onclick="gj.navsjm.value=jmen.value;gj.navsem.value=emai.value;gj.navste.value=dota.value;gj.okd.value='navsteva';gj.test.value='zmac';gj.posli.click();"></th>
</tr>
</table>
<br>
<hr>
<?
if(!Empty($navsjm) and !Empty($navsem) and !Empty($navste))
{
$navzp="<u>Jm�no:</u> <b>".$navsjm."</b><br><u>Email:</u> <b>".$navsem."</b><br><u>Zpr�va:</u> ".$navste." <br><font color=gray>[".Date("H:i:s j.m. Y")."]</font><br><hr>\n";
mail("geniv@centrum.cz","P�id�n� p��sp�vku do n�v�t�vn� knihy","Od: ".$navsjm." \nEmail: ".$navsem." \nZpr�va: ".$navste." \nv: ".Date("H:i:s j.m. Y")." \nz IP: ".$REMOTE_ADDR);
if(!$unk=fopen("navstevni_kniha_fksuvjsrvrsjhisuhviurshoihsgoihwoighweoiughowefg.php","a+"))
 {
  print "Nelze otev��t!!";
 }
else
 {
  if(!@fwrite($unk,$navzp))
   print "Nelze zapsat!!";
  else
   fclose($unk);
 }
}
else
{
if(!Empty($test) and $test=="zmac")
{
print "<h2 align=center>Ne�pln� �daje!!</h2>";
}
}
print "\n";
$txnk=file("navstevni_kniha_fksuvjsrvrsjhisuhviurshoihsgoihwoighweoiughowefg.php");
while($vynk=Each($txnk))
 {
  print $vynk["value"];
 }
?>
