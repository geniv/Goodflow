<?
echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"  />
<link rel=\"stylesheet\" href=\"../templates/subSilver/subSilver.css\" type=\"text/css\">
<style type=\"text/css\">
<!--

/*
  The original subSilver Theme for phpBB version 2+
  Created by subBlue design
  http://www.subBlue.com

  NOTE: These CSS definitions are stored within the main page body so that you can use the phpBB2
  theme administration centre. When you have finalised your style you could cut the final CSS code
  and place it in an external file, deleting this section to save bandwidth.
*/




/* General font families for common tags */
font,th,td,p { font-family: Verdana, Arial, Helvetica, sans-serif }
p, td		{ font-size : 11; color : #000000; }
h1,h2		{ font-family: \"Trebuchet MS\", Verdana, Arial, Helvetica, sans-serif; font-size : 22px; font-weight : bold; text-decoration : none; line-height : 120%; color : #000000;}


/* The largest text used in the index page title and toptic title etc. */
.maintitle	{
			font-weight: bold; font-size: 22px; font-family: \"Trebuchet MS\",Verdana, Arial, Helvetica, sans-serif;
			text-decoration: none; line-height : 120%;
}

/* General text */
.gen { font-size : 12px; }
.genmed { font-size : 11px; }
.gensmall { font-size : 10px; }


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

/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@import url(\"../templates/subSilver/formIE.css\");
-->
</style>

<!--

  NOTICE

  Cobalt 2.0 template by Jakob Persson.

  This template is publicly available for use with the phpBB forum software (http://www.phpbb.com).

  This template is copyright � 2002-2004 Jakob Persson

  Template ID: KhtkAeytMupoUmTL8RpDVnhddWDnq3AmeW5c

  Removal or alteration of this notice is strongly prohibited.

-->

<title>Fugessovo fórum - </title>
</head>
<body bgcolor=\"#E5E5E5\" text=\"#000000\" link=\"#A3C8FF\" vlink=\"#579AFF\">

<a name=\"top\"></a>


<h1>Vítejte na phpBB</h1>

<p>Děkujeme, že jste si zvolil(a) phpBB jako řešení pro vaše fórum. Tato stránka slouží k rychlému zobrazení různých statistik vašeho fóra. Pokud se budete chtít vrátit zpět na tuto stránku klikněte na odkaz <u>Obsah administrace</u> v levém panelu. Pro návrat na obsah vašeho fóra, klikněte na logo fóra umístěném též na levém panelu. Ostatní odkazy na levém panelu této stránky vás dovedou k jednotlivým položkám možného nastavení fóra dle vašich požadavků, každá stránka obsahuje návod jak použít danou funkci.</p>

<h1>Statistiky fóra</h1>

<table width=\"100%\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" class=\"forumline\">
  <tr>
	<th width=\"25%\" nowrap=\"nowrap\" height=\"25\" class=\"thCornerL\">Statistiky</th>
	<th width=\"25%\" height=\"25\" class=\"thTop\">Hodnota</th>
	<th width=\"25%\" nowrap=\"nowrap\" height=\"25\" class=\"thTop\">Statistiky</th>
	<th width=\"25%\" height=\"25\" class=\"thCornerR\">Hodnota</th>
  </tr>
  <tr>
	<td class=\"row1\" nowrap=\"nowrap\">Počet příspěvků:</td>
	<td class=\"row2\"><b>8</b></td>
	<td class=\"row1\" nowrap=\"nowrap\">Příspěvků za den:</td>
	<td class=\"row2\"><b>0.82</b></td>
  </tr>
  <tr>
	<td class=\"row1\" nowrap=\"nowrap\">Počet témat:</td>
	<td class=\"row2\"><b>2</b></td>
	<td class=\"row1\" nowrap=\"nowrap\">Témat za den:</td>
	<td class=\"row2\"><b>0.21</b></td>
  </tr>
  <tr>
	<td class=\"row1\" nowrap=\"nowrap\">Počet uživatelů:</td>
	<td class=\"row2\"><b>2</b></td>
	<td class=\"row1\" nowrap=\"nowrap\">Uživatelů za den:</td>
	<td class=\"row2\"><b>0.21</b></td>
  </tr>
  <tr>
	<td class=\"row1\" nowrap=\"nowrap\">Fórum spuštěno:</td>
	<td class=\"row2\"><b>čtvrtek, 22 březen, 2007 15:31</b></td>
	<td class=\"row1\" nowrap=\"nowrap\">Velikost adresáře s obrázky postaviček:</td>
	<td class=\"row2\"><b>191 Bytes</b></td>
  </tr>
  <tr>
	<td class=\"row1\" nowrap=\"nowrap\">Velikost databáze:</td>
	<td class=\"row2\"><b>95.38 KB</b></td>
	<td class=\"row1\" nowrap=\"nowrap\">GZIP komprese:</td>
	<td class=\"row2\"><b>Ne</b></td>
  </tr>
</table>
<h1>Kdo je přítomen</h1>

<table width=\"100%\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" class=\"forumline\">
  <tr>
	<th width=\"20%\" class=\"thCornerL\" height=\"25\">&nbsp;Uživatel&nbsp;</th>
	<th width=\"20%\" height=\"25\" class=\"thTop\">&nbsp;Přihlášení&nbsp;</th>
	<th width=\"20%\" class=\"thTop\">&nbsp;Poslední aktualizace&nbsp;</th>
	<th width=\"20%\" class=\"thCornerR\">&nbsp;Nachází se&nbsp;</th>
	<th width=\"20%\" height=\"25\" class=\"thCornerR\">&nbsp;IP adresa&nbsp;</th>
  </tr>
  <tr>
	<td width=\"20%\" class=\"row1\">&nbsp;<span class=\"gen\"><a href=\"admin_users.php?mode=edit&amp;u=3&amp;sid=b997929478a956914d7baab13f779a96\" class=\"gen\">Geniv</a></span>&nbsp;</td>
	<td width=\"20%\" align=\"center\" class=\"row1\">&nbsp;<span class=\"gen\">neděle, 01 duben, 2007 8:43</span>&nbsp;</td>
	<td width=\"20%\" align=\"center\" nowrap=\"nowrap\" class=\"row1\">&nbsp;<span class=\"gen\">neděle, 01 duben, 2007 8:47</span>&nbsp;</td>
	<td width=\"20%\" class=\"row1\">&nbsp;<span class=\"gen\"><a href=\"index.php?pane=right&amp;sid=b997929478a956914d7baab13f779a96\" class=\"gen\">Obsah fóra</a></span>&nbsp;</td>
	<td width=\"20%\" class=\"row1\">&nbsp;<span class=\"gen\"><a href=\"http://network-tools.com/default.asp?host=80.78.146.245\" class=\"gen\" target=\"_phpbbwhois\">80.78.146.245</a></span>&nbsp;</td>
  </tr>
  <tr>
	<td colspan=\"5\" height=\"1\" class=\"row3\"><img src=\"../templates/subSilver/images/spacer.gif\" width=\"1\" height=\"1\" alt=\".\"></td>
  </tr>
</table>

<br />


<!--

	Please note that the following copyright notice
	MUST be displayed on each and every page output
	by phpBB. You may alter the font, colour etc. but
	you CANNOT remove it, nor change it so that it be,
	to all intents and purposes, invisible. You may ADD
	your own notice to it should you have altered the
	code but you may not replace it. The hyperlink must
	also remain intact. These conditions are part of the
	licence this software is released under. See the
	LICENCE and README files for more information.

	The phpBB Group : 2001

//-->

<!--

  NOTICE

  Cobalt 2.0 template by Jakob Persson.

  This template is publicly available for use with the phpBB forum software (http://www.phpbb.com).

  This template is copyright � 2002-2004 Jakob Persson

  Template ID: KhtkAeytMupoUmTL8RpDVnhddWDnq3AmeW5c

  Removal or alteration of this notice is strongly prohibited.

-->

<div align=\"center\">
	<span class=\"copyright\">
		Powered by phpBB 2.0.22 &copy; 2001 <a href=\"http://www.phpbb.com/\" target=\"_phpbb\" class=\"copyright\">phpBB Group</a><br />Český překlad <a href=\"http://www.phpbbcz.com\" target=\"_blank\">phpBB Czech - www.phpbbcz.com</a><br /><br />

    	<a href=\"http://www.jakob-persson.com\"><strong><i>Cobalt <span style=\"font-style: italic; color: #1094E7\">2.0</span></i></strong> phpBB theme/template by Jakob Persson.<br /> Copyright &copy; 2002-2004 Jakob Persson</a>
	</span>
</div>


</body>
</html>
";
?>
admin hlavni
