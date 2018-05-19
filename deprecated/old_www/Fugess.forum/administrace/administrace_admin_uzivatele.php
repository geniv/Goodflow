<?
require "../funkce.php";
require "funkce_admin.php";

if(!Empty($jmeno_admina) and !Empty($heslo_admina) and login_admin($jmeno_admina,$heslo_admina)=="true" and prava_uzivatele_admin($jmeno_admina,$ID_uz_admin)==3)
{
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


<h2>Administrace uživatelů</h2>

<p>Klapnutím na uživatele si zobrazíš jeho profil.<br>Upravit nebo smazat ho můžeš pomocí ikonek.</p>





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

<table cellspacing=\"0\" cellpadding=\"6\" border=\"0\" align=\"center\" class=\"forumline\">
	<tr>
	  <td class=\"input\"><a href=\"tabulka_kompletni_vypis_admin_uzivatele.php\" target=\"_blank\" class=\"genmed\"><b>Tabulka s kompletním výpisem všech uživatelů</b></a></td>
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







<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td width=\"60%\">
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">

					<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
					  <tr>
						<td class=\"ErrorConfirmBoxStart\">
						<table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\" align=\"center\">
								<tr>
								  <th height=\"25\" class=\"thCornerL\" nowrap>#</th>
								  <th class=\"thTop\" nowrap>Uživatel</th>
								  <th class=\"thTop\" nowrap>E-mail</th>
								  <th class=\"thTop\" nowrap>Bydliště</th>
								  <th class=\"thTop\" nowrap>Založen</th>
								  <th class=\"thTop\" nowrap>Příspěvky</th>
								  <th class=\"thCornerR\" nowrap>WWW</th>
								  <th class=\"thCornerR\" nowrap>Upravit</th>
								  <th class=\"thCornerR\" nowrap>Odstranit</th>
								  <th class=\"thCornerR\" nowrap>Sledování</th>
								</tr>";	
                
$delkasoub=delka_souboru_admin();
$sb_hes="../re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocet=delka_registrace_admin();

//print (count($udaj)-1)/$pocet;




for($i=1;$i<((count($udaj)-1)/$pocet)+1;$i++)
{
$soub="../{$udaj[($i*$pocet)-22]}_pqaovdnsfijnsfvlknvjnsdfivjnsdkjvndxkljvnsfjnvsfvisujdjbvfjsoinv.php";
if(file_exists($soub)=="true")
{
$uk=fopen($soub,"r");
$mej=explode("--EMA--",fread($uk,$delkasoub));
fclose($uk);
}
$cosled=(count($mej)-1)/2;
echo
"               <tr>
								  <td class=\"input\" align=\"center\"><span class=\"gen\">&nbsp;$i&nbsp;</span></td>
								  <td class=\"input\" align=\"center\"><span class=\"gen\"><a href=\"../index.php?kam=info_user&kdo={$udaj[($i*$pocet)-22]}&idic={$udaj[($i*$pocet)-9]}\" class=\"gen\">{$udaj[($i*$pocet)-22]}</a></span></td>
								  <td class=\"input\" align=\"center\" valign=\"middle\">&nbsp;{$udaj[($i*$pocet)-21]}&nbsp;</td>
								  <td class=\"input\" align=\"center\" valign=\"middle\"><span class=\"gen\">{$udaj[($i*$pocet)-14]}</span></td>
								  <td class=\"input\" align=\"center\" valign=\"middle\"><span class=\"gensmall\">{$udaj[($i*$pocet)-3]}</span></td>
								  <td class=\"input\" align=\"center\" valign=\"middle\"><span class=\"gen\">{$udaj[($i*$pocet)-2]}</span></td>
								  <td class=\"input\" align=\"center\">&nbsp;".www_uzivatele_admin($udaj[($i*$pocet)-15])."&nbsp;</td>
								  <td class=\"input\" align=\"center\" valign=\"middle\"><a href=\"uz=$i&st=upr\"><img src=\"../images/icon_mini_profile.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a></td>
								  <td class=\"input\" align=\"center\" valign=\"middle\"><a href=\"uz=$i&st=smz\"><img src=\"../images/topic_delete.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a></td>
								  <td class=\"input\" align=\"center\" valign=\"middle\">$cosled</td>
								</tr>";	
}
echo
"						  </table>
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


<div align=\"center\">
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
