<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r))
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$sb_del="pocet_poli_wpfkwrdfsiomvspedfjvirokjwiefoghveiufhjowiehiwresuvieruhnrunvireunbvireuwnwroiujnfoij.php";
$u=fopen($sb_del,"r");
$pocet=fread($u,10);
fclose($u);

echo 
"CviËnÈ udaje! 
<table border=1>";
$i1=0;
for($i=1;$i<count($udaj)/$pocet;$i++)
{
$i1=$i1+($pocet+2);
echo 
"<tr>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+2]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+3]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+4]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+5]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+6]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+7]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+8]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+9]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+10]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+11]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+12]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+13]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+14]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+15]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+16]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+17]}</td>
<td>typ: {$udaj[(($i1-($pocet+1))-($i*2))+18]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+19]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+20]}</td>
<td>Zaloûen: {$udaj[(($i1-($pocet+1))-($i*2))+21]}</td>
<td>p¯ÌspÏvk˘: {$udaj[(($i1-($pocet+1))-($i*2))+22]}</td>
<td>pohlavÌ: {$udaj[(($i1-($pocet+1))-($i*2))+23]}</td>
</tr>";
}//end for
echo "</table><br><br>";

echo
" <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">

					<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
					  <tr>
						<td class=\"ErrorConfirmBoxStart\">
						<table width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"0\">
								<tr>
								  <th height=\"25\" class=\"thCornerL\" nowrap>#</th>
								  <th class=\"thTop\" nowrap>&nbsp;</th>
								  <th class=\"thTop\" nowrap>Uûivatel</th>
								  <th class=\"thTop\" nowrap>E-mail</th>
								  <th class=\"thTop\" nowrap>BydliötÏ</th>
								  <th class=\"thTop\" nowrap>Zaloûen</th>
								  <th class=\"thTop\" nowrap>P¯ÌspÏvky</th>
								  <th class=\"thCornerR\" nowrap>WWW</th>
								</tr>";
$i1=0;
for($i=1;$i<count($udaj)/$pocet;$i++)
{
$i1=$i1+($pocet+2);			
echo 
"		       			<tr>
								  <td class=\"row1\" align=\"center\"><span class=\"gen\">&nbsp;$i&nbsp;</span></td>
								  <td class=\"row1\" align=\"center\">&nbsp;<a href=\"zpr·va...\"><img src=\"images/lang_english/icon_pm.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odeslat soukromou zpr√°vu\" title=\"Odeslat soukromou zpr·vu\" border=\"0\"></a>&nbsp;</td>
								  <td class=\"row1\" align=\"center\"><span class=\"gen\"><a href=\"ukaû profil...\" class=\"gen\">{$udaj[(($i1-($pocet+1))-($i*2))+2]}</a></span></td>
								  <td class=\"row1\" align=\"center\" valign=\"middle\">&nbsp;<a href=\"mailto:{$udaj[(($i1-($pocet+1))-($i*2))+3]}\"><img src=\"images/lang_english/icon_email.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odeslat e-mail\" title=\"Odeslat e-mail\" border=\"0\"></a>&nbsp;</td>
								  <td class=\"row1\" align=\"center\" valign=\"middle\"><span class=\"gen\">{$udaj[(($i1-($pocet+1))-($i*2))+10]}</span></td>
								  <td class=\"row1\" align=\"center\" valign=\"middle\"><span class=\"gensmall\">{$udaj[(($i1-($pocet+1))-($i*2))+21]}</span></td>
								  <td class=\"row1\" align=\"center\" valign=\"middle\"><span class=\"gen\">{$udaj[(($i1-($pocet+1))-($i*2))+22]}</span></td>
								  <td class=\"row1\" align=\"center\">&nbsp;<a href=\"{$udaj[(($i1-($pocet+1))-($i*2))+9]}\"><img src=\"images/lang_english/icon_www.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Webov· str·nka\" title=\"Webov· str·nka\" border=\"0\"></a>&nbsp;</td>
								</tr>";
}							
/*								
								<tr>
								  <td class=\"row2\" align=\"center\"><span class=\"gen\">&nbsp;2&nbsp;</span></td>
								  <td class=\"row2\" align=\"center\">&nbsp;<a href=\"privmsg.php?mode=post&amp;u=3\"><img src=\"images/lang_english/icon_pm.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odeslat soukromou zpr√°vu\" title=\"Odeslat soukromou zpr√°vu\" border=\"0\"></a>&nbsp;</td>
								  <td class=\"row2\" align=\"center\"><span class=\"gen\"><a href=\"profile.php?mode=viewprofile&amp;u=3\" class=\"gen\">Geniv</a></span></td>
								  <td class=\"row2\" align=\"center\" valign=\"middle\">&nbsp;<a href=\"mailto:geniv@centrum.cz\"><img src=\"images/lang_english/icon_email.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odeslat e-mail\" title=\"Odeslat e-mail\" border=\"0\"></a>&nbsp;</td>
								  <td class=\"row2\" align=\"center\" valign=\"middle\"><span class=\"gen\">&nbsp;</span></td>
								  <td class=\"row2\" align=\"center\" valign=\"middle\"><span class=\"gensmall\">22.3.2007</span></td>
								  <td class=\"row2\" align=\"center\" valign=\"middle\"><span class=\"gen\">0</span></td>
								  <td class=\"row2\" align=\"center\">&nbsp;&nbsp;</td>
								</tr>
*/								
								
echo "					<tr>
							  	  <td class=\"catbottom\" colspan=\"8\" height=\"28\">&nbsp;</td>
								</tr>
						  </table>
					</td>
				  </tr>
				</table>
      </td>
      <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    </tr>
    <tr>
      <td width=\"0%\" class=\"mainboxLeftbottom\">&nbsp;</td>
      <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"0%\" class=\"mainboxRightbottom\">&nbsp;</td>
    </tr>
  </table>
  <table width=\"100%\" cellspacing=\"2\" border=\"0\" align=\"center\" cellpadding=\"2\">
	<tr>
	  <td align=\"right\" valign=\"top\"></td>
	</tr>
  </table>

<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
  <tr>
	<td><span class=\"nav\">Strana <b>1</b> z <b>1</b></span></td>
	<td align=\"right\"><span class=\"gensmall\">ƒåasy uv√°dƒõny v GMT + 1 hodina</span><br><span class=\"nav\">&nbsp;</span></td>
  </tr>
</table></form>

<table width=\"100%\" cellspacing=\"2\" border=\"0\" align=\"center\">
  <tr>
	<td valign=\"top\" align=\"right\">
<form method=\"get\" name=\"jumpbox\" action=\"viewforum.php\" onSubmit=\"if(document.jumpbox.f.value == -1){return false;}\"><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
	<tr>
		<td nowrap=\"nowrap\"><span class=\"gensmall\">P≈ôejdi na:&nbsp;<select name=\"f\" onchange=\"if(this.options[this.selectedIndex].value != -1){ forms['jumpbox'].submit() }\"><option value=\"-1\">Zvolte f√≥rum</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">V≈°eobecn√© informace o f√≥ru</option><option value=\"-1\">----------------</option><option value=\"1\">Struƒçn√Ω popis f√≥ra</option><option value=\"2\">N√°vrhy a ≈ôe≈°en√≠</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">TRS 2004 2006</option><option value=\"-1\">----------------</option><option value=\"3\">Stavba objekt≈Ø</option><option value=\"4\">Projekty</option><option value=\"5\">Tutori√°ly</option><option value=\"6\">Programy</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Grafika</option><option value=\"-1\">----------------</option><option value=\"12\">3D Grafika</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Elektro</option><option value=\"-1\">----------------</option><option value=\"9\">Elektro v√Ωrobky</option><option value=\"10\">Sch√©mata</option><option value=\"11\">Unik√°tn√≠ fotky a videa</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Ostatn√≠</option><option value=\"-1\">----------------</option><option value=\"7\">Re√°ln√° ≈æeleznice</option><option value=\"8\">Modelov√° ≈æeleznice</option></select><input type=\"hidden\" name=\"sid\" value=\"b997929478a956914d7baab13f779a96\">&nbsp;<input type=\"submit\" value=\"jdi\" class=\"liteoption\"></span></td>
	</tr>
</table></form>

</td>
  </tr>
</table>


<div align=\"center\">
	<p>
		<span class=\"copyright\">
			<a href=\"admin/index.php?sid=b997929478a956914d7baab13f779a96\">Administrace f√≥ra</a><br><br>
		</span>
	</p></div>";

}
else
{
echo "Nem·te opr·vnÏnÌ!";
}
?>
