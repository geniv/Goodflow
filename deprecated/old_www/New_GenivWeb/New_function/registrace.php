<?
if(!Empty($pod) and $pod=="true" and Empty($dok))
{
print 
"<form method=\"post\">
<h5><u>Registrace</u></h5>
P�ihla�ovac� jm�no: *<input type=\"text\" name=\"login\"><br>
Heslo: *<input type=\"password\" name=\"heslo1\"><br>
Heslo kontrola: *<input type=\"password\" name=\"heslo2\"><br>
Email: *<input type=\"text\" name=\"email\" value=\"@\">
<hr>
Jm�no: <input type=\"text\" name=\"jmeno\"><br>
P�ijmen�: <input type=\"text\" name=\"prijmeni\"><br>
ICQ: <input type=\"text\" name=\"icq\"><br>
WWW: <input type=\"text\" name=\"www\" value=\"http://\"><br>
Z�jmy: <input type=\"text\" name=\"zajmy\"><br>
Bydli�t�: <input type=\"text\" name=\"bydliste\"><br>
Povol�n�: <input type=\"text\" name=\"povolani\"><br>
Pohlav�: Mu�: <input type=\"radio\" name=\"pohlavi\" value=\"M\" checked>�ena: <input type=\"radio\" name=\"pohlavi\" value=\"Z\"><br>
Podpis: <textarea name=\"podpis\"></textarea><br>
<input type=\"submit\" value=\"Registruj\">";
}

if(Empty($pod) and Empty($dok))
{
print 
"Souhlas�m s registra�n�ma podm�nkama:<br>
...<br>
<a href=\"index.php?kam=registrace&pod=true\" class=\"odkaz\">Souhlas�m</a><br>
<a href=\"index.php?kam=uvod\" class=\"odkaz\">NESouhlas�m</a>";
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
print "<body onload=\"od.click();\"><a href=\"index.php?kam=registrace&pod=true&dok=true\" name=\"od\">Pokra�uj...</a></body>";
}
else
{
print "<body onload=\"od.click();\"><a href=\"index.php?kam=registrace&pod=true&dok=false\" name=\"od\">Pokra�uj...</a></body>";
}
}//end reg.

if(!Empty($dok) and $dok=="true" and $pod=="true")
{print "Registrace byla �sp�n� dokon�ena...<font color=\"red\">nyn� sta�� jen aktivovat ��et!!</font>";}

if(!Empty($dok) and $dok=="false" and $pod=="true")
{print "Registrace se nezda�ila... n�kter� povinn� udaje nebyly vypln�ny nebo jste zadaly spatn� kontroln� heslo nebo tento login ji� existuje!.";}

?>
