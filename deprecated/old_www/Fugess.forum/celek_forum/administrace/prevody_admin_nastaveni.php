<?
require "funkce_admin.php";

if(!Empty($jmeno_admina) and !Empty($heslo_admina) and login_admin($jmeno_admina,$heslo_admina)=="true" and prava_uzivatele_admin($jmeno_admina,$ID_uz_admin)==3)
{

$delkasoub=delka_souboru_admin();
$sb_hes="../skr_ypt_zn_ack_y_pqwkdfciournviowemvionvmsvinsokfmwirumviowjdvmiojvmifovjnmwroviksjkmowirkvjkowivjvikmweoivnoiwrejnv.php";
$u=fopen($sb_hes,"r");
$zdroj=explode("--z--",fread($u,$delkasoub));
fclose($u);

$sb_hes="../skry_p_t_zn_prevod_qpfomcieufnbviomciwnvisnmvosdmvosfnmvosnvjfdnbslkmvsokfmvosikdmvfolksdvnslkfmvsdfolkvmdolkfvmed.php";
$u=fopen($sb_hes,"r");
$nahrada=explode("--zp--",fread($u,$delkasoub));
fclose($u);

$zd=count($zdroj);
$na=count($nahrada);

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
@import url(\"../fugess_form.css\");
-->
</style>


<title>Fugessovo fórum - administrace</title>
</head>
<body bgcolor=\"#E5E5E5\" text=\"#000000\" link=\"#A3C8FF\" vlink=\"#579AFF\">

<h2>Převody hodnot</h2>

<p>Seznam převodů hodnot.<br>Zde si můžeš zpracovat některou hodnotu ze seznamu.<br>Zdroj převádí napsané hodnoty na náhradu (nebo-li do html).</p>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">

<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" class=\"forumline\">
	<tr>
	  <th class=\"thHead\" colspan=\"7\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Výpis hodnot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"right\"><b>Délka zdroje:</b></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"left\"><b>$zd</b></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"right\"><b>Délka náhrady:</b></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"left\"><b>$na</b></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	</tr>
</table>
      </td>
      <td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
    </tr>
    <tr>
      <td width=\"0%\" class=\"mainboxLeftbottom\">&nbsp;</td>
      <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"0%\" class=\"mainboxRightbottom\">&nbsp;</td>
    </tr>
  </table>
</td>
</tr>
</table>

<form>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">

<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" class=\"forumline\">
	<tr>
	  <th class=\"thHead\" colspan=\"5\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Zpracování hodnot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\" colspan=\"5\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"right\" valign=\"center\"><input type=\"text\" name=\"pok\" size=\"70\"></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"left\" valign=\"center\"><input type=\"submit\" value=\"Zpracuj\"></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\" colspan=\"5\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\" colspan=\"5\"><b>Vypsaný text:</b></td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\" colspan=\"5\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\" colspan=\"5\">";
if(!Empty($pok))
{
print prekopej_text_admin($pok);
}
print
"<tr>
<td class=\"input\" align=\"center\" colspan=\"5\">&nbsp;</td>
</tr>
</td>
</tr>
</table>
      </td>
      <td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
    </tr>
    <tr>
      <td width=\"0%\" class=\"mainboxLeftbottom\">&nbsp;</td>
      <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"0%\" class=\"mainboxRightbottom\">&nbsp;</td>
    </tr>
  </table>
</td>
</tr>
</table>

</form>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">

<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" class=\"forumline\">
	<tr>
	  <th class=\"thHead\" colspan=\"4\">Seznam převáděných znaků</th>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\"><b>#</b></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"center\"><b>Zdroj</b></td>
	  <td class=\"input\" align=\"center\"><b>Náhrada</b></td>
	</tr>";

/*
<td>Zdroj</td>
<td>Nadrada</td>

<td>

{$zdroj[$i]}

</td>
<td>

{$nahrada[$i]}

</td>
*/

for($i=1;$i<count($nahrada);$i++)
{
echo
"
<tr>
<td class=\"input\">$i</td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\"><input type=text value=\"".htmlspecialchars($zdroj[$i])."\"></td>
<td class=\"input\"><input type=text size=60 value=\"".htmlspecialchars($nahrada[$i])."\"></td>
</tr>
";
}
print
"</table>
      </td>
      <td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
    </tr>
    <tr>
      <td width=\"0%\" class=\"mainboxLeftbottom\">&nbsp;</td>
      <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"0%\" class=\"mainboxRightbottom\">&nbsp;</td>
    </tr>
  </table>
</td>
</tr>
</table>";
}
?>
