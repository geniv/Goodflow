<?
require "funkce.php";

if(!Empty($jmeno) and !Empty($heslo) and login($jmeno,$heslo)=="true")
{
SetCookie("admin_jmeno",$jmeno,Time()+360000000);
SetCookie("admin_heslo",$heslo,Time()+360000000);
logovani_prihlasovani($jmeno,$heslo,$REMOTE_ADDR,login($jmeno,$heslo));
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
<body bgcolor=\"#BDD0EE\" text=\"#000000\" link=\"#A3C8FF\" vlink=\"#579AFF\" onload=\"vstup.click();\">
</div>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"90%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"100%\" class=\"mainbox\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
 <tr>
  <td colspan=\"3\" class=\"genmed\" align=\"center\">&nbsp;</td>
 </tr>
 <tr>
  <tr>
  <td colspan=\"3\" class=\"genmed\" align=\"center\"><a href=\"index_go.php\" name=\"vstup\" class=\"genmed\">Vstoupit</a></td>
 </tr>
 <tr>
  <td colspan=\"3\" class=\"genmed\" align=\"center\">&nbsp;</td>
 </tr>
</table>
</td>
<td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
</table>
</body>
</html>";
}
else
{
SetCookie("admin_jmeno","");
SetCookie("admin_heslo","");
if(!Empty($jmeno) and !Empty($heslo))
{logovani_prihlasovani($jmeno,$heslo,$REMOTE_ADDR,login($jmeno,$heslo));}
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
<td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"90%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"100%\" class=\"mainbox\">
<form method=\"post\">
<br>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
 <tr>
  <td colspan=\"3\" class=\"genmed\" align=\"center\">Přihlášení</td>
 </tr>
 <tr>
  <td colspan=\"3\" class=\"genmed\" align=\"center\">&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><input type=\"text\" name=\"jmeno\"></td>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><input type=\"password\" name=\"heslo\"></td>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><input type=\"password\" name=\"heslo1\"></td>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><input type=\"password\" name=\"heslo2\"></td>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><input type=\"password\" name=\"heslo3\"></td>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td colspan=\"3\" class=\"genmed\" align=\"center\">&nbsp;</td>
 </tr>
 <tr>
  <td colspan=\"3\" align=\"center\"><input type=\"submit\" value=\"Přihlásit\"></td>
 </tr>
</table>
</form>
</td>
<td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
</table>";
if(!Empty($jmeno) and !Empty($heslo))
{print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"90%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"100%\" class=\"mainbox\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
 <tr>
  <td colspan=\"3\" class=\"genmed\" align=\"center\">&nbsp;</td>
 </tr>
 <tr>
  <tr>
  <td colspan=\"3\" class=\"genmed\" align=\"center\">Zadal jsi špatné údaje.</td>
 </tr>
 <tr>
  <td colspan=\"3\" class=\"genmed\" align=\"center\">&nbsp;</td>
 </tr>
</table>
</td>
<td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>";}
}
?>
</body>
</html>
