<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true")
{
$delkasoub=delka_souboru();
//
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

//$poc=0;
/*
for($i3=1;$i3<delka_reg_uzivatelu();$i3++)
{
if($udaj[$i3]==$Jmeno_r){$poc=$i3;}
}//end for

echo 
"Cvièné udaje! 
<table border=1>";
$i1=0;
for($i=1;$i<count($udaj)/delka_registrace();$i++)
{
$i1=$i1+(delka_registrace()+2);
echo 
"<tr>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+2)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+3)."</td>
<td><h6>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+4)."</h6></td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+5)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+6)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+7)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+8)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+9)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+10)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+11)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+12)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+13)."</td>
<td>Skryt email: ".uzivatel((($i1-(delka_registrace()+1))-($i*2))+14)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+15)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+16)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+17)."</td>
<td>typ: ".uzivatel((($i1-(delka_registrace()+1))-($i*2))+18)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+19)."</td>
<td>".uzivatel((($i1-(delka_registrace()+1))-($i*2))+20)."</td>
<td>Založen: ".uzivatel((($i1-(delka_registrace()+1))-($i*2))+21)."</td>
<td>pøíspìvkù: ".uzivatel((($i1-(delka_registrace()+1))-($i*2))+22)."</td>
<td>pohlaví: ".uzivatel((($i1-(delka_registrace()+1))-($i*2))+23)."</td>
<td>hodnocení: ".uzivatel((($i1-(delka_registrace()+1))-($i*2))+24)."</td>
</tr>";
}//end for
echo "</table><br><br>";
*/
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
								  <th class=\"thTop\" nowrap>Uživatel</th>
								  <th class=\"thTop\" nowrap>E-mail</th>
								  <th class=\"thTop\" nowrap>Bydlištì</th>
								  <th class=\"thTop\" nowrap>Založen</th>
								  <th class=\"thTop\" nowrap>Pøíspìvky</th>
								  <th class=\"thCornerR\" nowrap>WWW</th>
								</tr>";
								
$delkarg=delka_registrace();
$zobstr=pocet_uzivatelu_na_strance();	
$delka=(delka_reg_uzivatelu()-1)/$delkarg;

$zobrmin=0;
$zobrmax=0;

$stran=ceil($delka/$zobstr);//poèet stran,zaokrouhluje nahoru!

$zobrmax=($str*$zobstr);
$zobrmin=($zobrmax-$zobstr)+1;

//print identifikacni_cislo();
//$i1=0;
for($i=1;$i<$delka+1;$i++)
{
//print $udaj[($i*$delkarg)-2];
$wb=www_uzivatele($udaj[($i*$delkarg)-15]);
$emi=email_uzivatele($udaj[($i*$delkarg)-10],$udaj[($i*$delkarg)-21]);

//$emi=;
//$udaj[(($i1-(delka_registrace()+1))-($i*2))+3];

//email_uzivatele(uzivatel((($i1-(delka_registrace()+1))-($i*2))+2));

//<td class=\"row1\" align=\"center\">&nbsp;<a href=\"zpráva...\"><img src=\"images/tlacitka/icon_pm.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odeslat soukromou zprávu\" title=\"Odeslat soukromou zprávu\" border=\"0\"></a>&nbsp;</td>

//&idic={$udaj[($i*$delkarg)-9]}

if(($i>=$zobrmin and $i<=$zobrmax))
{
echo 
"		       			<tr>
								  <td class=\"row1\" align=\"center\"><span class=\"gen\">&nbsp;$i&nbsp;</span></td>
								  <td class=\"row1\" align=\"center\"><span class=\"gen\"><a href=\"index.php?kam=info_user&kdo={$udaj[($i*$delkarg)-22]}&idic={$udaj[($i*$delkarg)-9]}\" class=\"gen\">{$udaj[($i*$delkarg)-22]}</a></span></td>
								  <td class=\"row1\" align=\"center\" valign=\"middle\">&nbsp;$emi&nbsp;</td>
								  <td class=\"row1\" align=\"center\" valign=\"middle\"><span class=\"gen\">{$udaj[($i*$delkarg)-14]}</span></td>
								  <td class=\"row1\" align=\"center\" valign=\"middle\"><span class=\"gensmall\">{$udaj[($i*$delkarg)-3]}</span></td>
								  <td class=\"row1\" align=\"center\" valign=\"middle\"><span class=\"gen\">{$udaj[($i*$delkarg)-2]}</span></td>
								  <td class=\"row1\" align=\"center\">&nbsp;$wb&nbsp;</td>
								</tr>";
}								
}//end pocet vykr.								
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

			<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">
			  <tr>
			  <td align=\"left\" class=\"nav\">Strana $str z $stran</td>
        <td align=\"right\" class=\"nav\">".jdi_na_stranku($str,"","",$stran,"uzivatele")."</td>
			  </tr>
			</table>

</form>

";

}
else
{
echo "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";
}
?>
