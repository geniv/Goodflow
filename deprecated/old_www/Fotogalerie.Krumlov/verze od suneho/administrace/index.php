<?
require "funkce.php";
//$AD_jmeno, $AD_heslo
if(!Empty($AD_jmeno) and !Empty($AD_heslo) and LoginAdmin($AD_jmeno,$AD_heslo,".")=="true")
{
$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleGalerie(".");

echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
<title>Administrace Krumlov Trainz</title>
<style type=\"text/css\">
body {
	background-color: #FAA735;
	margin-top : 0px ! important;
	margin-left : 0px ! important;
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


font,th,td,p { font-family: Verdana, Arial, Helvetica, sans-serif }
p, td { font-size : 14px; }
h1 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size : 12px; font-weight : bold; text-decoration : none; line-height : 120%; }
h2 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size : 13px; font-weight : bold; text-decoration : none; line-height : 120%; }
h3 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size : 14px; font-weight : bold; text-decoration : none; line-height : 120%; }


a,a:active,a:visited {
	color : Black;
	text-decoration: none;
}

/* čárkovaný text začátek */

a.odkaz {
	text-decoration: none;
	border-bottom : 1px dashed #00027F;
	font-size : 12px;
}
a.odkaz:hover {
	color: #000482;
	text-decoration: underline;
		border-bottom : 0px dashed blue;
}

a:hover { color: blue;	!important; }

/* čárkovaný text konec */

td.u {
	text-decoration: underline;
}
td.i {
	font-style: italic;
}
td.b {
	font-weight: bold;
}

td.f12 {
	font-size : 12px;
}

span.f12 {
	font-size : 12px;
}

hr {
	color: #00027F;
	height: 1px;
}
</style>
</head>
<body>

<table cellpadding=\"6\" cellspacing=\"0\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td align=\"center\" valign=\"top\" class=\"f12\">
<span class=\"f12\"><center><b><u>Menu</u></b></center></span><hr>
<a href=\"index.php?kam=uvod\" class=\"odkaz\">Úvod</a>
<hr>
<a href=\"../\" target=\"_blank\" class=\"odkaz\">Náhled na stránky</a>
<hr>
<a href=\"index.php?kam=pridat_galerii\" class=\"odkaz\">Přidat novou galerii</a><br>
<a href=\"index.php?kam=upravit_galerii\" class=\"odkaz\">Upravit galerii</a><br>
<a href=\"index.php?kam=smazat_galerii\" class=\"odkaz\">Smazat galerii</a>
<hr>
<a href= \"index.php?kam=pridat_odkaz\" class=\"odkaz\">Přidat odkaz</a><br>
<a href= \"index.php?kam=upravit_odkaz\" class=\"odkaz\">Upravit odkaz</a><br>
<a href= \"index.php?kam=smazat_odkaz\" class=\"odkaz\">Smazat odkaz</a>
<hr>
<a href= \"index.php?kam=interni_upload\" class=\"odkaz\">Interní upload</a>
<hr>";

if(((count($udaj)-1)/$del)!=0)
{
for($i=1;$i<((count($udaj)-1)/$del)+1;$i++)
{
print
"
<span class=\"f12\"><center>&nbsp;<b>Galerie:&nbsp;<u>{$udaj[($i*$del)-3]}</u></b>&nbsp;</center></span><hr>
<a href=\"index.php?kam=info_galerie&galerie=$i\" class=\"odkaz\">Informace o galerii</a><br>
<a href=\"index.php?kam=pridat_obrazek&galerie=$i\" class=\"odkaz\">Přidat obrázek nebo soubor</a><br>
<a href=\"index.php?kam=upravit_obrazek&galerie=$i\" class=\"odkaz\">Upravit komentář</a><br>
<a href=\"index.php?kam=smazat_obrazek&galerie=$i\" class=\"odkaz\">Smazat obrázek nebo soubor</a><hr>";
}//end for
}
else
{
print "Žádné galerie!<hr>";
}

print
"<a href=\"index.php?kam=hlavni\" class=\"odkaz\">Hlavní nastavení</a>
</td>
<td align=\"center\" valign=\"top\" class=\"f12\">";

if (ERegI("^[a-z0-9_]+$", $kam)):
  if(Empty($kam))
   {
     require "uvod.php";
   }
   elseIf (@File_Exists($kam.".php"))
   {
    require "{$kam}.php";
   }
   else
   {
    echo("Nepovolená hodnota!");
   }
 elseIf ($kam <> ""):
  echo("Jsi hacker a s takovými se nebavím!");
endif;


echo
"</td>
</tr>
</table>

</body>
</html>";
}
else
{
print "Nepovolený přístup";
}
?>
