<?
require "funkce_admin.php";

if(!Empty($jmeno_admina) and !Empty($heslo_admina) and login_admin($jmeno_admina,$heslo_admina)=="true" and prava_uzivatele_admin($jmeno_admina,$ID_uz_admin)==3)
{
$prik="Zobrazit";
$prik1="Promazat";

$popis[0]="Aktivita všech IP";
$popis[1]="Aktivita uživatelù";
$popis[2]="Pøihlašování";
$popis[3]="Aktivaèní odkazy";
$popis[4]="Ovládání aktivaèních odkazù";
$popis[5]="Žádosti o zaslání hesla";

$cesta[0]="../hlav_ni_log_qpfcmiruhgniewijfveuiccoiwrehnviunfenrzuibirunvowieufniuruwenbfiunbreiunrefgiunreiuniuneiunbugerunb.php";
$cesta[1]="../poh_yb_po_sstr_qpwjfcsodnvsdalnjaodkjqipojfcuifsncwevbisciusjvnwisvbisucoahncalfvndfuhznbv.php";
$cesta[2]="../prih_l_log_qwpofjsuoimwvnieunviueoiwrngvoiweunvzubadflkjofnvoiujsdfnvoikjdfmvoiunedfoibnuoinbqpwoeirdkslcmmbgzhezhgewewwwfnbreuxy.php";
$cesta[3]="../akt_iv_log_qepfsovjdnviwekjfviuedhwiuegvieusfnwribvizeuhfwriugbvebviewriuhfjfoiwjvoiwrnfnfvnnnv.php";
$cesta[4]="../ak_ti_v_li_nky_qwpfoeijgsfnxiokmsciovsnviuojsdcvuisfnvmcoiaesdvjnsudnvsdounosdncoiudanciodnviusbvuzwreg.php";
$cesta[5]="../zas_la_ni_h_es_la_qwpfdkcosiovnsriunvsornvsnoijnvsfoinsokjkjnsfjniujbndonrsonkjnskjvnbrfjnjn.php";

$cesta_ext[0]=$cesta[0];
$cesta_ext[1]=$cesta[1];
$cesta_ext[2]=$cesta[2];
$cesta_ext[3]=$cesta[3];
$cesta_ext[4]="../seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php";
$cesta_ext[5]=$cesta[5];

$tlacitko[0]="<input type=\"submit\" value=\"$prik1\" onclick=\"prk.value='prm0';\">";
$tlacitko[1]="<input type=\"submit\" value=\"$prik1\" onclick=\"prk.value='prm1';\">";
$tlacitko[2]="<input type=\"submit\" value=\"$prik1\" onclick=\"prk.value='prm2';\">";
$tlacitko[3]="<input type=\"submit\" value=\"$prik1\" onclick=\"prk.value='prm3';\">";
$tlacitko[4]="<input type=\"submit\" value=\"$prik1\" onclick=\"prk.value='prm4';\">";
$tlacitko[5]="<input type=\"submit\" value=\"$prik1\" onclick=\"prk.value='prm5';\">";

echo
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


<h2>Logování</h2>

<p>Zde jsou všechny logovací soubory.</p>




<form method=\"post\">
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">
<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" align=\"center\">
	<tr>
	  <th class=\"thHead\" colspan=\"3\">Výpis logovacích souborù</th>
	</tr>";

for($i=0;$i<count($popis);$i++)
{
echo
"	<tr>
		<td class=\"input\" width=\"60%\">{$popis[$i]}</td>
		<td class=\"input\" align=\"center\"><a href=\"{$cesta[$i]}\" class=\"genmed\">$prik</a></td>
		<td class=\"input\">{$tlacitko[$i]}</td>
	</tr>";
}	
/*
 <tr>
		<td class=\"input\" width=\"60%\">Aktivita uživatelù</td>
		<td class=\"input\" align=\"center\"><a href=\"../poh_yb_po_sstr_qpwjfcsodnvsdalnjaodkjqipojfcuifsncwevbisciusjvnwisvbisucoahncalfvndfuhznbv.php\" class=\"genmed\">Zobrazit</a></td>
		<td class=\"input\"><input type=\"button\" name=\"\" value=\"Promazat\"></td>
	</tr>
	<tr>
		<td class=\"input\" width=\"60%\">Pøihlašování</td>
		<td class=\"input\" align=\"center\"><a href=\"../prih_l_log_qwpofjsuoimwvnieunviueoiwrngvoiweunvzubadflkjofnvoiujsdfnvoikjdfmvoiunedfoibnuoinbqpwoeirdkslcmmbgzhezhgewewwwfnbreuxy.php\" class=\"genmed\">Zobrazit</a></td>
		<td class=\"input\"><input type=\"button\" name=\"\" value=\"Promazat\"></td>
	</tr>
	<tr>
		<td class=\"input\" width=\"60%\">Aktivaèní odkazy</td>
		<td class=\"input\" align=\"center\"><a href=\"../akt_iv_log_qepfsovjdnviwekjfviuedhwiuegvieusfnwribvizeuhfwriugbvebviewriuhfjfoiwjvoiwrnfnfvnnnv.php\" class=\"genmed\">Zobrazit</a></td>
		<td class=\"input\"><input type=\"button\" name=\"\" value=\"Promazat\"></td>
	</tr>
	<tr>
		<td class=\"input\" width=\"60%\">Ovládání aktivaèních odkazù</td>
		<td class=\"input\" align=\"center\"><a href=\"../ak_ti_v_li_nky_qwpfoeijgsfnxiokmsciovsnviuojsdcvuisfnvmcoiaesdvjnsudnvsdounosdncoiudanciodnviusbvuzwreg.php\" class=\"genmed\">Zobrazit</a></td>
		<td class=\"input\"><a href=\"../seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php\" class=\"genmed\">tento soubor se promaže</a></td>
	</tr>
	<tr>
		<td class=\"input\" width=\"60%\">Žádosti o zaslání hesla</td>
		<td class=\"input\" align=\"center\"><a href=\"../zas_la_ni_h_es_la_qwpfdkcosiovnsriunvsornvsnoijnvsfoinsokjkjnsfjniujbndonrsonkjnskjvnbrfjnjn.php\" class=\"genmed\">Zobrazit</a></span></td>
		<td class=\"input\"><input type=\"button\" name=\"\" value=\"Promazat\"></td>
	</tr>
*/
echo
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
<input type=\"hidden\" name=\"prk\">
</form>";

for($i=0;$i<count($popis);$i++)
{

if(!Empty($prk) and $prk=="prm$i")
{
$sb_del=$cesta_ext[$i];
$u=fopen($sb_del,"w");
fclose($u);
}//end if

}//end for

echo
"<div align=\"center\">
	<span class=\"copyright\">

<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
 <tr>
  <td align=\"center\" class=\"copyright\">&nbsp;</td>
 </tr>
 <tr>
  <td align=\"center\" class=\"copyright\">Copyright <a href=\"http://fugess.trainz.cz/\" target=\"_blank\" class=\"copyright\">Fugess</a> © 2007</td>
 </tr>
  <tr>
  <td align=\"center\" class=\"copyright\">Programming <a href=\"http://geniv.wu.cz/\" target=\"_blank\" class=\"copyright\">Geniv</a> &reg; 2007</td>
 </tr>
  <tr>
  <td align=\"center\" class=\"copyright\">Design & Testing <a href=\"http://fugess.trainz.cz/\" target=\"_blank\" class=\"copyright\">Fugess</a> &reg; 2007</td>
 </tr>
</table>

	</span>
</div>


</body>
</html>";
}
?>
