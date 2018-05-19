<?
require "funkce.php";

if(!Empty($admin_jmeno) and !Empty($admin_heslo) and login($admin_jmeno,$admin_heslo)=="true")
{
print
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\"  />
<link rel=\"stylesheet\" href=\"../fugess-f-z.css\" type=\"text/css\">
<style type=\"text/css\">
<!--

/* General font families for common tags */
font,th,td,p { font-family: Verdana, Arial, Helvetica, sans-serif }
p, td { font-size : 11; color : #FFFFFF; }
h1 { font-family: \"Trebuchet MS\", Verdana, Arial, Helvetica, sans-serif; font-size : 20px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}
h2 { font-family: \"Trebuchet MS\", Verdana, Arial, Helvetica, sans-serif; font-size : 18px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}
h3 { font-family: \"Trebuchet MS\", Verdana, Arial, Helvetica, sans-serif; font-size : 16px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}


/* The largest text used in the index page title and toptic title etc. */
.maintitle	{
			font-weight: bold; font-size: 22px; font-family: \"Trebuchet MS\",Verdana, Arial, Helvetica, sans-serif;
			text-decoration: none; line-height : 120%;
}

/* General text */
.gen { font-size : 12px; }
.genmed { font-size : 11px; font-weight: bold; }
.gensmall { font-size : 10px;}


/* The register, login, search etc links at the top of the page */
.mainmenu		{ font-size : 11px; }

/* Forum category titles */
.cattitle		{ font-weight: bold; font-size: 12px; }

/* Forum title: Text and link to the forums used in: index.php */
.forumlink		{ font-weight: bold; font-size: 12px; }

/* Used for the navigation text, (Page 1,2,3 etc) and the navigation bar when in a forum */
.nav			{ font-weight: bold; font-size: 11px; }

/* Name of poster in viewmsg.php and viewtopic.php and other places */
.name			{ font-size : 11px; }

/* Location, number of posts, post date etc */
.postdetails		{ font-size : 10px; }


/* The content of the posts (body of text) */
.postbody { font-size : 12px; }


/* Form elements */
input,textarea, select {
	font: normal 11px;
}

input { text-indent : 2px; }

/* The buttons used for bbCode styling in message post */
input.button {
	font-size: 11px;
}

.ic_lista
{
visibility: hidden;
background-color: #BDD0EE;
position:absolute;
top:-100px;
}

/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@import url(\"fugess_form.css\");
-->
</style>
<title>CZ & SK Trainz Tutorial</title>
</head>
<div class=\"ic_lista\">
<body bgcolor=\"#BDD0EE\" text=\"#000000\" link=\"#A3C8FF\" vlink=\"#579AFF\">
</div>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td width=\"0%\" class=\"mainboxLefttop\"><a name=\"uplne_nahoru\"></a><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<a href=\"#uplne_dolu\"><td width=\"90%\" class=\"mainboxTop\" colspan=\"2\"><img src=\"../images/spacer.gif\" height=\"17px\"></td></a>
<td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"mainbox\" valign=\"top\">
	  <table width=\"1%\" cellpadding=\"6\" cellspacing=\"0\" border=\"0\" class=\"forumline_admin\">
		<tr>
		  <th class=\"thHead\"><b>Menu</b></th>
		</tr>
		<tr>
		  <td class=\"input\"><a href=\"index_go.php?kam=uvod\" class=\"genmed\">Úvod&nbsp;administrace</a></td>
		</tr>
		<tr>
		  <td class=\"input\"><a href=\"../index.php\" target=\"_blank\" class=\"genmed\">Zobrazit&nbsp;web</a></td>
		</tr>
		<tr>
		  <td class=\"catSides\" align=\"center\"><span class=\"cattitle\">Úvod</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=pridej_uvod\" class=\"genmed\">Přidat&nbsp;úvod</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=uprav_uvod\" class=\"genmed\">Upravit&nbsp;úvod</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=smaz_uvod\" class=\"genmed\">Smazat&nbsp;úvod</a></span></td>
		</tr>
		<tr>
		  <td class=\"catSides\" align=\"center\"><span class=\"cattitle\">Návody</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=pridej\" class=\"genmed\">Přidat&nbsp;návod</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=uprav\" class=\"genmed\">Upravit&nbsp;návod</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=smaz\" class=\"genmed\">Smazat&nbsp;návod</a></span></td>
		</tr>
		<tr>
		  <td class=\"catSides\" align=\"center\"><span class=\"cattitle\">Odkazy</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=pridej_odkaz\" class=\"genmed\">Přidat&nbsp;odkaz</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=uprav_odkaz\" class=\"genmed\">Upravit&nbsp;odkaz</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=smaz_odkaz\" class=\"genmed\">Smazat&nbsp;odkaz</a></span></td>
		</tr>
		<tr>
		  <td class=\"catSides\" align=\"center\"><span class=\"cattitle\">Kontakt</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=pridej_kontakt\" class=\"genmed\">Přidat&nbsp;kontakt</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=uprav_kontakt\" class=\"genmed\">Upravit&nbsp;kontakt</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=smaz_kontakt\" class=\"genmed\">Smazat&nbsp;kontakt</a></span></td>
		</tr>
		<tr>
		  <td class=\"catSides\"><span class=\"cattitle\">Nastavení</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=hlavni\" class=\"genmed\">Hlavní&nbsp;nastavení</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=css\" class=\"genmed\">Nastavení&nbsp;CSS</a></span></td>
		</tr>
		<tr>
		  <td class=\"catSides\"><span class=\"cattitle\">Logování&nbsp;do&nbsp;administrace</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=logovani\" class=\"genmed\">Zobrazit logování</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"index_go.php?kam=smaz_logovani\" class=\"genmed\">Smazat logování</a></span></td>
		</tr>
	  </table>
</td>
<td width=\"100%\" class=\"mainbox\">";

if(Empty($kam))
{require "uvod.php";}
else
{require "{$kam}.php";}

print
"</td>
<td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<a href=\"#uplne_nahoru\"><td width=\"100%\" class=\"mainboxBottom\" colspan=\"2\"><img src=\"../images/spacer.gif\" height=\"18px\"></td></a>
<td width=\"0%\" class=\"mainboxRightbottom\"><a name=\"uplne_dolu\"></a><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
</body>
</html>
";
}
else
{print "<center><b>Tady nemáš co dělat !!!</b></center>";}
?>
