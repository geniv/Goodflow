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
?>
<div id=menu>
<form name=gj method=post>
<input type=image src="bs_uvod.gif" onclick="gj.okd.value='uvod';" onmousemove="src='bt_uvod.gif';" onmouseout="src='bs_uvod.gif';"><br>
<input type=image src="bs_programovani.gif" onclick="gj.okd.value='programovani';" onmousemove="src='bt_programovani.gif';" onmouseout="src='bs_programovani.gif';"><br>
<input type=image src="bs_elektro.gif" onclick="gj.okd.value='elektro';" onmousemove="src='bt_elektro.gif';" onmouseout="src='bs_elektro.gif';"><br>
<input type=image src="bs_zeleznice.gif" onclick="gj.okd.value='zeleznice';" onmousemove="src='bt_zeleznice.gif';" onmouseout="src='bs_zeleznice.gif';"><br>
<input type=image src="bs_kontakt.gif" onclick="gj.okd.value='kontakt';" onmousemove="src='bt_kontakt.gif';" onmouseout="src='bs_kontakt.gif';"><br>
<center>
<input type=submit value="Škola" onclick="gj.okd.value='skola';" onmouseout="value='Škola';" onmousemove="value='Pascal ze školy';"><br>
<input type=submit value="Návštìvní kniha" onclick="gj.okd.value='navsteva';" onmouseout="value='Návštìvní kniha';" onmousemove="value='Místo pro vaše názory';">
</center>
<br><br><br>
<center>
<h3>Pøihlášení:</h3>
<input type=text name=logjm value="Login jméno...." onclick="value='';"><br>
<input type=password name=loghe value=""><br>
<input type=image src="login.gif" onclick="gj.okd.value='skola';"><br>
<input type=image src="logout.gif" onclick="gj.okd.value='uvod';"><br>
<a href="newreg.php" title="Registrace nového uživatele" target=_blank>Registrace</a>
<input type=hidden name=okd>
<input type=hidden name=mejljm>
<input type=hidden name=mejlpr>
<input type=hidden name=mejlzp>
<input type=hidden name=navsjm>
<input type=hidden name=navsem>
<input type=hidden name=navste>
<input type=hidden name=test>
<INPUT type=submit value="" name=posli style="visibility:hidden">
</center>
</form>
</div>
