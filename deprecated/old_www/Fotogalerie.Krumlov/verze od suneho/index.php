<?
require "administrace/funkce.php";

if(!Empty($jmeno) and !Empty($heslo) and LoginAdmin($jmeno,$heslo,"administrace")=="true")
{
SetCookie("AD_jmeno",$jmeno,Time()+31536000);
SetCookie("AD_heslo",$heslo,Time()+31536000);
}
else
{
if(!Empty($kam) and $kam=="admin")
{
SetCookie("AD_jmeno","");
SetCookie("AD_heslo","");
}//end kam==admin
}

print 
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
<title>Krumlov Trainz - Železniční Fotogalerie</title>

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
}
a.odkaz:hover {
	color: #000482;
	text-decoration: underline;
		border-bottom : 0px dashed blue;
}

a:hover { color: blue;	!important; }

/* čárkovaný text konec */

td.logo_nadpis {
	background-image: url(img/logo_nadpis.png);
	background-repeat: no-repeat;
}

td.stred_obsah {
	background-image: url(img/stred_obsah.png);
	background-repeat: no-repeat;
}

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

</style>
</head>
<body>

<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
<td colspan=\"2\" class=\"logo_nadpis\" height=\"73px\" width=\"100%\" align=\"left\"></td>
</tr>
<tr>
<td valign=\"top\">
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
<td height=\"1%\"><a href=\"index.php?kam=galerie_vyber\" border=\"0\"><img border=\"0\" src=\"img/vg_n.png\" onMouseOut=\"src='img/vg_n.png';\" onMouseOver=\"src='img/vg_a.png';\"></a></td>
</tr>
<tr>
<td height=\"1%\"><a href=\"index.php?kam=odkazy\" border=\"0\"><img border=\"0\" src=\"img/od_n.png\" onMouseOut=\"src='img/od_n.png';\" onMouseOver=\"src='img/od_a.png';\"></a></td>
</tr>
<tr>
<td height=\"1%\"><a href=\"index.php?kam=admin\" border=\"0\"><img border=\"0\" src=\"img/ad_n.png\" onMouseOut=\"src='img/ad_n.png';\" onMouseOver=\"src='img/ad_a.png';\"></a></td>
</tr>
<tr>
<td height=\"1%\"><img border=\"0\" src=\"img/spodek_menu.png\"></td>
</tr>
</table>
</td>
<td height=\"100%\" width=\"100%\" class=\"stred_obsah\" valign=\"top\">
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
<td height=\"3px\"></td>
</tr>
</table>";

if(Empty($kam))
{require "galerie_vyber.php";}
else
{require "{$kam}.php";}

print
"</td>
</tr>
</table>
</body>
</html>";
?>

