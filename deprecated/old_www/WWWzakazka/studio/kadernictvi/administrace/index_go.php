<?
require "funkce.php";

//---------------------------------------------------------------------
$soub="../../kosmetika/administrace/nazev_stranek_gwdksnnbkjjndfjvhbvikjdijsjidjvlkshvsjfjvolkshgoisdehoiwreshoishoiesudfhv.php";
$u=fopen($soub,"r");
$nazev=fread($u,1000);
fclose($u);
//---------------------------------------------------------------------

if(!Empty($hl_jmeno) and !Empty($hl_heslo))
{
if(LoginAdmin($hl_jmeno,$hl_heslo)=="true1")
{
echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">

<title>$nazev - Kadeřnictví - Administrátorská sekce</title>
</head>
<body>

<table border=\"1\">
<tr>
<td>

<table border=\"0\">
<tr>
<td><a href=\"index_go.php?kam=uvod\">Uvodní strana</a></td>
</tr>

<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td><a href=\"http://www.studio-effect.ic.cz/index.php?sekce=kosmetika&kam=uvodni\" target=\"_blank\">Náhled na stránky</a></td>
</tr>

<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td><a href=\"index_go.php?kam=pridat_aktualitu\">Přidat aktualitu</a></td>
</tr>
<tr>
<td><a href=\"index_go.php?kam=upravit_aktualitu\">Upravit aktualitu</a></td>
</tr>
<tr>
<td><a href=\"index_go.php?kam=smazat_aktualitu\">Smazat aktualitu</a></td>
</tr>

<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td><a href=\"index_go.php?kam=pridat_cenik\">Přidat ceník</a></td>
</tr>
<tr>
<td><a href=\"index_go.php?kam=upravit_cenik\">Upravit ceník</a></td>
</tr>
<tr>
<td><a href=\"index_go.php?kam=smazat_cenik\">Smazat ceník</a></td>
</tr>

<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td><a href=\"index_go.php?kam=hlavni\">Hlavní nastavení</a></td>
</tr>
</table>

</td>
<td>";
if(!Empty($kam))
{require "{$kam}.php";}
else
{require "uvod.php";}
echo
"</td>
</tr>

</table>

</body>
</html>";
}//plná
else
{
echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
<style type=\"text/css\">
<!--
body {
	background-color: #FA9FCC;
	margin-top : 0px ! important;
	margin-left : 0px ! important;
	margin-right : 0px ! important;
	margin-bottom : 0px ! important;
	color: #000000;

/*	scrollbar-face-color: #DEE3E7;
	scrollbar-highlight-color: #FFFFFF;
	scrollbar-shadow-color: #DEE3E7;
	scrollbar-3dlight-color: #D1D7DC;
	scrollbar-arrow-color: #006699;
	scrollbar-track-color: #EFEFEF;
	scrollbar-darkshadow-color: #98AAB1;
*/
}

.ic_lista
{
visibility: hidden;
background-color: #BDD0EE;
position:absolute;
top:-100px;
}

font,th,td,p { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
p, td { font-size: 14; }
h4 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size: 16px; font-weight: 600; text-decoration: none; line-height: 120%; letter-spacing: 0.1em; }

a,a:active,a:visited {
	color: White;
	text-decoration: none;
}

/* čárkovaný text začátek */

a.odkaz {
	text-decoration: none;
	border-bottom : 1px dashed White;
}
a.odkaz:hover {
	color: White;
	text-decoration: underline;
		border-bottom : 0px dashed Green;
}

a:hover { color: White;	!important; }

/* čárkovaný text konec */

td.ramecek_levy_horni {
	background-image: url(../obrazky/ramecek_levy_horni.gif);
	background-repeat: no-repeat;
}

td.ramecek_horni {
	background-image : url(../obrazky/ramecek_horni.gif);
	background-repeat: repeat-x;
}

td.ramecek_pravy_horni {
	background-image: url(../obrazky/ramecek_pravy_horni.gif);
	background-repeat: no-repeat;
}

td.ramecek_levy {
	background-image: url(../obrazky/ramecek_levy.gif);
	background-repeat: repeat-y;
}

td.ramecek_pravy {
	background-image: url(../obrazky/ramecek_pravy.gif);
	background-repeat: repeat-y;
}

td.ramecek_levy_dolni {
	background-image: url(../obrazky/ramecek_levy_dolni.gif);
	background-repeat: no-repeat;
}

td.ramecek_dolni {
	background-image : url(../obrazky/ramecek_dolni.gif);
	background-repeat: repeat-x;
}

td.ramecek_pravy_dolni {
	background-image: url(../obrazky/ramecek_pravy_dolni.gif);
	background-repeat: no-repeat;
}

input {
	color: #FFFFFF;
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	background-image: url(../obrazky/pozadi_input.jpg);
	border-color: #5D7A8E #5D7A8E #5D7A8E #5D7A8E;
}

td.input {
	background-image: url(../obrazky/pozadi_input.jpg);
  color: #FFFFFF;
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}

td.input_nadpis {
	background-image: url(../obrazky/pozadi_input.jpg);
  color: #FFFFFF;
	font: normal 16px Trebuchet MS;
	font-weight: bold;
}

td.vnitrni_tabulka {
	background-color: #688499;
}

-->
</style>

<title>$nazev - Kadeřnictví - Administrátorská sekce</title>
</head>
<div class=\"ic_lista\">
<body>
</div>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"2\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td valign=\"top\" width=\"1%\" class=\"vnitrni_tabulka\">

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"></td>
</tr>
<tr>
<td class=\"input\" height=\"6px\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\"><a href=\"index_go.php?kam=uvod\" class=\"odkaz\">Úvodní strana</a></td>
<td class=\"input\" height=\"6px\">&nbsp;</td>
</tr>
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"><hr color=\"white\"></td>
</tr>
<tr>
<td class=\"input\" height=\"6px\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\"><a href=\"../../index.php?sekce=kadernictvi&kam=aktuality\" target=\"_blank\" class=\"odkaz\">Náhled na stránky</a></td>
<td class=\"input\" height=\"6px\">&nbsp;</td>
</tr>
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"><hr color=\"white\"></td>
</tr>
<tr>
<td class=\"input\" height=\"6px\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\"><a href=\"index_go.php?kam=pridat_aktualitu\" class=\"odkaz\">Přidat aktualitu</a></td>
<td class=\"input\" height=\"6px\">&nbsp;</td>
</tr>
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"></td>
</tr>
<tr>
<td class=\"input\" height=\"6px\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\"><a href=\"index_go.php?kam=upravit_aktualitu\" class=\"odkaz\">Upravit aktualitu</a></td>
<td class=\"input\" height=\"6px\">&nbsp;</td>
</tr>
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"></td>
</tr>
<tr>
<td class=\"input\" height=\"6px\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\"><a href=\"index_go.php?kam=smazat_aktualitu\" class=\"odkaz\">Smazat aktualitu</a></td>
<td class=\"input\" height=\"6px\">&nbsp;</td>
</tr>
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"><hr color=\"white\"></td>
</tr>
<tr>
<td class=\"input\" height=\"6px\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\"><a href=\"index_go.php?kam=pridat_cenik\" class=\"odkaz\">Přidat položku ceníku</a></td>
<td class=\"input\" height=\"6px\">&nbsp;</td>
</tr>
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"></td>
</tr>
<tr>
<td class=\"input\" height=\"6px\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\"><a href=\"index_go.php?kam=upravit_cenik\" class=\"odkaz\">Upravit položku ceníku</a></td>
<td class=\"input\" height=\"6px\">&nbsp;</td>
</tr>
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"></td>
</tr>
<tr>
<td class=\"input\" height=\"6px\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\"><a href=\"index_go.php?kam=smazat_cenik\" class=\"odkaz\">Smazat položku ceníku</a></td>
<td class=\"input\" height=\"6px\">&nbsp;</td>
</tr>
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"><hr color=\"white\"></td>
</tr>
<tr>
<td class=\"input\" height=\"6px\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\"><a href=\"index_go.php?kam=hlavni\" class=\"odkaz\">Nastavení&nbsp;kontaktních&nbsp;údajů</a></td>
<td class=\"input\" height=\"6px\">&nbsp;</td>
</tr>
<tr>
<td height=\"6px\" colspan=\"3\" class=\"input\"></td>
</tr>
</table>

</td>
<td valign=\"top\" align=\"center\" class=\"vnitrni_tabulka\">";
if(!Empty($kam))
{require "{$kam}.php";}
else
{require "uvod.php";}
echo
"</td>

</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"2\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</body>
</html>";
}//beta
}
else
{print "neoprávněný přístup!";}

/*
}
else


if(!Empty($hl_jmeno) and !Empty($hl_heslo) and LoginAdmin($hl_jmeno,$hl_heslo)=="true0")
{



}
else
{print "neoprávněný přístup!";}
*/
?>
