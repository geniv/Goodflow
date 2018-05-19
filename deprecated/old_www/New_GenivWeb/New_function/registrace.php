<?
if(!Empty($pod) and $pod=="true" and Empty($dok))
{
print 
"<form method=\"post\">
<h5><u>Registrace</u></h5>
Pøihlašovací jméno: *<input type=\"text\" name=\"login\"><br>
Heslo: *<input type=\"password\" name=\"heslo1\"><br>
Heslo kontrola: *<input type=\"password\" name=\"heslo2\"><br>
Email: *<input type=\"text\" name=\"email\" value=\"@\">
<hr>
Jméno: <input type=\"text\" name=\"jmeno\"><br>
Pøijmení: <input type=\"text\" name=\"prijmeni\"><br>
ICQ: <input type=\"text\" name=\"icq\"><br>
WWW: <input type=\"text\" name=\"www\" value=\"http://\"><br>
Zájmy: <input type=\"text\" name=\"zajmy\"><br>
Bydlištì: <input type=\"text\" name=\"bydliste\"><br>
Povolání: <input type=\"text\" name=\"povolani\"><br>
Pohlaví: Muž: <input type=\"radio\" name=\"pohlavi\" value=\"M\" checked>Žena: <input type=\"radio\" name=\"pohlavi\" value=\"Z\"><br>
Podpis: <textarea name=\"podpis\"></textarea><br>
<input type=\"submit\" value=\"Registruj\">";
}

if(Empty($pod) and Empty($dok))
{
print 
"Souhlasím s registraèníma podmínkama:<br>
...<br>
<a href=\"index.php?kam=registrace&pod=true\" class=\"odkaz\">Souhlasím</a><br>
<a href=\"index.php?kam=uvod\" class=\"odkaz\">NESouhlasím</a>";
}

if(!Empty($login) and !Empty($heslo1) and !Empty($heslo2) and !Empty($email))
{
if(Empty($jmeno)){$jmeno="";}
if(Empty($prijmeni)){$prijmeni="";}
if(Empty($icq)){$icq="";}
if(Empty($www)){$www="";}
if(Empty($zajmy)){$zajmy="";}
if(Empty($bydliste)){$bydliste="";}
if(Empty($povolani)){$povolani="";}
if(Empty($pohlavi)){$pohlavi="";}
if(Empty($podpis)){$podpis="";}
$stav=Registrace($login,$heslo1,$heslo2,$email,$jmeno,$prijmeni,$icq,$www,$zajmy,$bydliste,$povolani,$pohlavi,$podpis,$SERVER_NAME,basename(getcwd()),$REMOTE_ADDR);

if($stav=="true")
{
print "<body onload=\"od.click();\"><a href=\"index.php?kam=registrace&pod=true&dok=true\" name=\"od\">Pokraèuj...</a></body>";
}
else
{
print "<body onload=\"od.click();\"><a href=\"index.php?kam=registrace&pod=true&dok=false\" name=\"od\">Pokraèuj...</a></body>";
}
}//end reg.

if(!Empty($dok) and $dok=="true" and $pod=="true")
{print "Registrace byla úspìšnì dokonèena...<font color=\"red\">nyní staèí jen aktivovat úèet!!</font>";}

if(!Empty($dok) and $dok=="false" and $pod=="true")
{print "Registrace se nezdaøila... nìkteré povinné udaje nebyly vyplnìny nebo jste zadaly spatné kontrolní heslo nebo tento login již existuje!.";}

?>
