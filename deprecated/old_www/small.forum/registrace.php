<?
echo
"<form method=\"post\">
Jmeno: *<input type=\"text\" name=\"jmeno\"><br>
Heslo: *<input type=\"text\" name=\"heslo\"><br>
Heslo kontrola: *<input type=\"text\" name=\"heslo_1\"><br>
Email: *<input type=\"text\" name=\"email\"><br>
ICQ: <input type=\"text\" name=\"icq\"><br>
AOL: <input type=\"text\" name=\"aol\"><br>
MSN: <input type=\"text\" name=\"msn\"><br>
YAHOO: <input type=\"text\" name=\"yah\"><br>
WWW: <input type=\"text\" name=\"www\"><br>
Bydlištì: <input type=\"text\" name=\"lokace\"><br>
Povolání: <input type=\"text\" name=\"povolani\"><br>
Zájmy: <input type=\"text\" name=\"zajmy\"><br>
Podpis: <textarea name=\"podpis\"></textarea><br>
Skrýt email: ANO:<input name=\"skremail\" type=\"radio\" value=\"A\" checked>
NE:<input name=\"skremail\" type=\"radio\" value=\"N\"><br>
<input type=\"submit\" value=\"Registrovat\">
</form>";

if(!Empty($jmeno) and !Empty($heslo) and !Empty($email))
{
if(Empty($icq)){$icq="";}
if(Empty($aol)){$aol="";}
if(Empty($msn)){$msn="";}
if(Empty($yah)){$yah="";}
if(Empty($www)){$www="";}
if(Empty($lokace)){$lokace="";}
if(Empty($povolani)){$povolani="";}
if(Empty($zajmy)){$zajmy="";}
if(Empty($podpis)){$podpis="";}
$st=registrace($jmeno,$heslo,$heslo_1,$email,$icq,$aol,$msn,$yah,$www,$lokace,$povolani,$zajmy,$podpis,$skremail,$SERVER_NAME,basename(getcwd()));

}
?>
