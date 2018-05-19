<?
require "administrace/funkce.php";

Banovani($REMOTE_ADDR);

if(Empty($Jme))
{$jm="Inkogito";}
else
{$jm=$Jme;}

if(Empty($kam)){$kam="uvod";}
HlavniLogovani($jm,$kam,$REMOTE_ADDR);

if(!Empty($odhlas) and $odhlas=="true")
{
SetCookie("Jme","");
SetCookie("Hes","");
SetCookie("ID","");
}

if(!Empty($jmeno) and !Empty($heslo))
{
$stav=Login($jmeno,$heslo);

LogovaniLogin($jmeno,$heslo,$REMOTE_ADDR,$stav);

if($stav=="true")
{
$prihl="Byli jste úspěšně přihlášeni!<br>Pokračujte <a class=\"odkaz\" href=\"index.php?kam=$kam\">zde</a>";
SetCookie("Jme",$jmeno,Time()+360000000);
SetCookie("Hes",$heslo,Time()+360000000);
SetCookie("ID",IdeckoUzivatele($jmeno,$heslo),Time()+360000000);
}
else
{
$prihl="";
}//end if else stav

}
else
{
$prihl="";
}//end if else jmeno heslo

echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
<style type=\"text/css\">
<!--

body {
	background-color: #3A79C1;
	margin-top : 0px ! important;
	margin-left : 0px ! important;
	margin-right : 0px ! important;
	margin-bottom : 0px ! important;
	color : #FFFFFF;

/*	scrollbar-face-color: #DEE3E7;
	scrollbar-highlight-color: #FFFFFF;
	scrollbar-shadow-color: #DEE3E7;
	scrollbar-3dlight-color: #D1D7DC;
	scrollbar-arrow-color: #006699;
	scrollbar-track-color: #EFEFEF;
	scrollbar-darkshadow-color: #98AAB1;
*/
}


font,th,td,p { font-family: Verdana, Arial, Helvetica, sans-serif }
p, td { font-size : 11; color : #FFFFFF; }
h1 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size : 12px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}
h2 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size : 13px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}
h3 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size : 14px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}


a,a:active,a:visited {
	color : White;
	text-decoration: none;
}




/* čárkovaný text začátek */

a.odkaz {
	color: White;
	text-decoration: none;
	border-bottom : 1px dashed #FFFFFF;
}
a.odkaz:hover {
	color: #FFCE00;
	text-decoration: underline;
		border-bottom : 0px dashed #FFCE00;
}

a:hover { color: #FFCE00;	!important; }

/* čárkovaný text konec */


</style>

<title>Geniv web</title>
</head>
<body>








<table border=1>
<tr>
<td colspan=2>Nadpis</td>
</tr>
<tr>
<td>
<form method=\"post\">
<a href=\"index.php?kam=uvod\" class=\"odkaz\">Úvod</a><br>
<a href=\"index.php?kam=programovani\" class=\"odkaz\">Programování</a><br>
<a href=\"index.php?kam=elektro\" class=\"odkaz\">Elektro</a><br>
<a href=\"index.php?kam=zeleznice\" class=\"odkaz\">Železnice</a><br>
<a href=\"index.php?kam=kontakt\" class=\"odkaz\">Kontakt</a><br>
<a href=\"index.php?kam=odkazy\" class=\"odkaz\">Odkazy</a><br>
<a href=\"index.php?kam=programming\" class=\"odkaz\">the Programming</a><br>
<a href=\"index.php?kam=forum\" class=\"odkaz\">Fórum</a><br>

";

if(Empty($Jme) and Empty($Hes) and Empty($ID))
{
print
"Jméno:<input type=\"text\" name=\"jmeno\" size=\"10\"><br>
Heslo:<input type=\"password\" name=\"heslo\" size=\"10\"><br>
<input type=\"submit\" value=\"Přihlásit\"><br>
<a href=\"index.php?kam=registrace\" class=\"odkaz\">Registrace</a><br>$prihl";
}
else
{
print 
"<a href=\"index.php?kam=profil\" class=\"odkaz\">Můj profil</a><br>
<a href=\"index.php?kam=seznam\" class=\"odkaz\">Seznam uživatelů</a><br>
<a href=\"index.php?kam=$kam&odhlas=true\" class=\"odkaz\">Odhlásit [ $Jme ]</a>";
}

print 
"</form>

3A79C1

</td>
<td>";

if(Empty($kam))
{require "uvod.php";}
else
{require "{$kam}.php";}

print
"</td>
</tr>
</table>
</body>
</html>";
?>
