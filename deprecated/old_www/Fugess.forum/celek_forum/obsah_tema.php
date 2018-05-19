<?
//print "má tu být obsah: $cis a $pris";
//index.php?kam=novy_topik&cis=$cis&pris=$pris

//parametr_uzivatele(jm,param);

//<img src=\"images/spacer.gif\" width=\"150\" height=\"1\">

//print prispevek($cis,$pris,9,$pm-delka_obsahu());
//print prispevek($cis,$pris,$pm-delka_obsahu(),5);//<------supr
//print obrazek_typu_uzivatele(parametr_uzivatele(prispevek($cis,$pris,5,$pm-delka_obsahu()),0));

//parametr_uzivatele(prispevek($cis,$pris,5,$pm-delka_obsahu()),0)
//print "$zobrmin, $zobrmax";
//$Jmeno_r

//for($i=$zobrmin;$i<$zobrmax+1;$i++)


if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true" and !Empty($cis))
{
$zamk=stav_zamku($cis,$pris);
$pravo=prava_uzivatele($Jmeno_r,$ID_uz);

$zobstr=pocet_prispevku_na_strance();

if(Empty($str))
{$str=1;}

$nazev="f_topik_{$cis}_{$pris}.php";
if(file_exists($nazev)=="true")
{
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$prispevek=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$rozd=delka_obsahu();
$delka=(count($prispevek)-1)/$rozd;

$zobrmin=0;
$zobrmax=0;

$stran=ceil($delka/$zobstr);//poèet stran,zaokrouhluje nahoru!

$zobrmax=($str*$zobstr);
$zobrmin=($zobrmax-$zobstr)+1;

if(stav_zamku_vlakna($cis)=="false")
{$odpov="<img src=\"images/tlacitka/reply-locked.gif\" border=\"0\" alt=\"Zablokovaná odpovìï\" align=\"middle\">";}
else
{
if($zamk=="true")
{$odpov="<a href=\"index.php?kam=novy_pris&cis=$cis&pris=$pris&str=$stran\"><img src=\"images/tlacitka/reply.gif\" border=\"0\" alt=\"Zaslat odpovìï\" align=\"middle\"></a>";}
else
{$odpov="<img src=\"images/tlacitka/reply-locked.gif\" border=\"0\" alt=\"Zablokovaná odpovìï\" align=\"middle\">";}
}

echo
"<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\">
  <tr>
	<td align=\"left\" valign=\"bottom\" nowrap>$odpov</td>
  </tr>

  
</table>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
	<tr>
		<td width=\"0%\" class=\"mainboxLefttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"mainboxTop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"0%\" class=\"mainboxRighttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>
	<tr>
		<td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"viewTopicBox\">

			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" height=\"100%\">
				<tr>
					<td class=\"viewTopicBoxStart\">

						<table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"0\">
							<tr align=\"right\">
                <td class=\"catHead\" colspan=\"2\" height=\"28\">
                
                </td>
							</tr>
						</table>

					</td>
				</tr>
			</table>

		</td>
		<td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>
	<tr>
		<td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>

	<tr>
		<td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"viewTopicBox\">

			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" height=\"100%\">
				<tr>
					<td class=\"viewTopicBoxStart\">

<!-- opakování -->";

pridej_zhlednuti($cis,$pris);

//zrychlit!!!... možná se podaøilo..
$pocet_uzivatelu=delka_reg_uzivatelu();

$pm=0;
for($i=1;$i<$delka+1;$i++)
{
$pm+=$rozd;

$poc=0;
for($i3=1;$i3<$pocet_uzivatelu;$i3++)
{
if($udaj[$i3]==$prispevek[($rozd*$i)-4] and $udaj[$i3+13]==$prispevek[($rozd*$i)-3]){$poc=$i3;}
}//end for

$uzivatel=$prispevek[($pm-$rozd)+4];
$idecko=$prispevek[($pm-$rozd)+5];

if($uzivatel==$Jmeno_r or $pravo==3)
{$uprv="<a href=\"index.php?kam=novy_pris&cis=$cis&pris=$pris&str=$str&poz=$i\"><img src=\"images/tlacitka/icon_edit.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Upravit tento pøíspìvek\" title=\"Upravit tento pøíspìvek\" border=\"0\"></a>";}//jen majitel a admin
else
{$uprv="";}

if($pravo==3)
{
$delt="<a href=\"index.php?kam=smaz&cis=$cis&pris=$pris&str=$str&poz=$i&kdo=$uzivatel&idic=$idecko\"><img src=\"images/icon_delete.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odstranit tento pøíspìvek\" title=\"Odstranit tento pøíspìvek\" border=\"0\"></a>";
$ipadr="";//zobrazí
}//jen majitel a admin
else
{
$delt="";
$ipadr="";
}

if($zamk=="true" or $pravo==3)
{$cit="<a href=\"index.php?kam=novy_pris&cis=$cis&pris=$pris&str=$stran&poz=$i&upr=new&jm={$udaj[$poc]}\"><img src=\"images/tlacitka/icon_quote.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Citovat\" title=\"Citovat\" border=\"0\"></a>";}
else
{$cit="";}

$podpis=podpis_uzivatele($udaj[$poc+15],$udaj[$poc+11]);
$emaill=email_uzivatele($udaj[$poc+12],$udaj[$poc+1]);
$byt=byliste_uzivatele($udaj[$poc+8],"Bydlištì: ");

$icq=icq_uzivatele($udaj[$poc+3]);
$aol=aol_uzivatele($udaj[$poc+4]);
$msn=msn_uzivatele($udaj[$poc+5]);
$yah=yahoo_uzivatele($udaj[$poc+6]);
$www=www_uzivatele($udaj[$poc+7]);

//print $udaj[$poc+2];

//<a href=\"modcp.php?mode=ip&amp;p=11&amp;t=5&amp;sid=3779e72d1eb3c9287f390a413cfb19af\"><img src=\"images/tlacitka/icon_ip.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Zobrazit IP adresu odesilatele\" title=\"Zobrazit IP adresu odesilatele\" border=\"0\"></a>
if(($i>=$zobrmin and $i<=$zobrmax))
{
echo "			<table width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
							<tr>
								<td width=\"0%\" align=\"left\" valign=\"top\" class=\"row1\">
                <span class=\"name\"><a name=\"pz$i\"></a>
                <b>{$udaj[$poc]}</b>
                </span>
                <br>
                <span class=\"postdetails\">
                ".typ_uzivatele($udaj[$poc+16])."
                <br>
                ".obrazek_typu_uzivatele($udaj[$poc+22])."
                ".avatar_obrazek($udaj[$poc+17])."
                <br><br>
                Pohlaví: ".pohlavi_uzivatele($udaj[$poc+21])."
                <br>
                Založen: {$udaj[$poc+19]}
                <br>
                Pøíspìvky: {$udaj[$poc+20]}
                <br>
                $byt 
                </span>
                <br>
                </td>
								<td class=\"row1\" width=\"80%\" height=\"28\" valign=\"top\">

									<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
										<tr>
											<td width=\"100%\">
                      <a href=\"#pz$i\"><img src=\"images/minipost_read.gif\" width=\"12\" height=\"9\" alt=\"Pøíspìvek\" title=\"Pøíspìvek\" border=\"0\"></a>
                      <span class=\"postdetails\">
                      Zasláno: {$prispevek[($pm-$rozd)+8]}
                      <span class=\"gen\">&nbsp;</span>&nbsp;&nbsp;
                      Pøedmìt: {$prispevek[($pm-$rozd)+1]}
                      </span></td>
											<td valign=\"top\" align=\"right\" nowrap=\"nowrap\">
                      $cit
                      $uprv
                      $delt
                      $ipadr
                      <a href=\"#top\"><img src=\"images/icon_top.gif\" width=\"22\" height=\"19\" alt=\"Back to top\" border=\"0\" class=\"imgfade\" onmouseover=\"this.className='imgfull'\" onmouseout=\"this.className='imgfade'\"></a></td>
										</tr>
										<tr>
											<td colspan=\"2\"><hr class=\"post\"></td>
										</tr>
										<tr>
											<td colspan=\"2\" class=\"postbody\">
                      <span class=\"postbody\">".prekopej_text($prispevek[($pm-$rozd)+2])."
                      $podpis
                      </span>
                      </td>
										</tr>
									</table>

								</td>
							</tr>
							<tr>
								<td class=\"row1\" width=\"150\" align=\"left\" valign=\"middle\">&nbsp;</td>
								<td class=\"row1\" width=\"100%\" height=\"28\" valign=\"bottom\" nowrap>

									<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" height=\"18\" width=\"18\">
										<tr>
											<td valign=\"middle\" style=\"padding-top: 10px\" nowrap>
                      <a href=\"index.php?kam=info_user&kdo={$udaj[$poc]}&idic={$udaj[$poc+13]}\"><img src=\"images/tlacitka/icon_profile.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Zobrazit informace o autorovi\" title=\"Zobrazit informace o autorovi\" border=\"0\"></a>
                      $emaill
                      $icq
                      $aol
                      $msn
                      $yah
                      $www
                      </td>
										</tr>
									</table>

								</td>
							</tr>
						</table>";
//($delka>1 and $delka!=$i)or
if($delka>1 and $zobrmax!=$i and $delka!=$i)
{
echo
"<!-- mezistupeò -->

					</td>
				</tr>
			</table>

		</td>
		<td width=\"0%\" class=\"mainboxRight\"><img src=\"templates/Cobalt/images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>
	<tr>
		<td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"templates/Cobalt/images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"templates/Cobalt/images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"templates/Cobalt/images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>


	<tr>
		<td width=\"0%\" class=\"mainboxLeft\"><img src=\"templates/Cobalt/images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"viewTopicBox\">

			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" height=\"100%\">
				<tr>
					<td class=\"viewTopicBoxStart\">
<!-- mezistupeò -->";
}//end mezistupeò
}//end rozdìlení
}//end for
echo
"<!-- opakování -->




					</td>
				</tr>
			</table>
		</td>
		<td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>
	<tr>
		<td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>


	<tr>
		<td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"viewTopicBox\">

			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" height=\"100%\">
				<tr>
					<td class=\"viewTopicBoxStart\">

						<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
							<tr align=\"center\">
								<td class=\"catBottom\" colspan=\"2\" height=\"28\" align=\"center\">

								</td>
							</tr>
						</table>

					</td>
				</tr>
			</table>

		</td>
		<td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>

	<tr>
		<td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>
</table>

			<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
			  <tr>
				<td align=\"left\" valign=\"middle\" class=\"tdPostImgBottom\" nowrap>$odpov</td>
        <td align=\"right\" class=\"nav\" valign=\"top\">".jdi_na_stranku($str,$cis,$pris,$stran,"obsah_tema")."</td>
			  </tr>
			  <tr>
				<td align=\"left\" colspan=\"3\" class=\"nav\">Strana $str z $stran</td>
			  </tr>
			</table>
			
<span class=\"gensmall\">
  ".sledovanost_fora($Jmeno_r,$cis,$pris,$str)."
</span>		
          	
			<table width=\"100%\" cellspacing=\"2\" border=\"0\" align=\"center\">
			  <tr>
				<td width=\"40%\" valign=\"top\" nowrap align=\"left\">
         
				  &nbsp;<br>";
/*
index.php?kam=sledovani&cis=$cislo&pris=$prispevek&prik=del&kdo={$udaj[($i*$pocet)-22]}
          <br>
*/				  

//stav_sledovani_prispevku($cis,$pris,$str,$i);

if($pravo==3)
{
if($zamk=="true")
{$jk="false";}
else
{$jk="true";}

echo
"				  <a href=\"index.php?kam=smaz&cis=$cis&pris=$pris&str=$str&poz=1&kdo=$uzivatel&idic=$idecko\"><img src=\"images/topic_delete.gif\" alt=\"Odstranit toto téma\" title=\"Odstranit toto téma\" border=\"0\"></a>
          &nbsp;
          <a href=\"index.php?kam=zamek&cis=$cis&pris=$pris&jak=$jk\"><img src=\"images/topic_lock.gif\" alt=\"Zamknout/Odemknout toto téma\" title=\"Zamknout/Odemknout toto téma\" border=\"0\"></a>
          &nbsp;
          ".uprava_novoty($cis,$pris);
}
echo
"         </td>
			  </tr>
			</table>";	
}
else
{
print
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td colspan=\"3\">
            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
              <tr>
                <td width=\"0%\"><img src=\"images/cat_lcap.gif\" width=\"22\" height=\"51\"></td>
                <td width=\"100%\" background=\"images/cat_bar.jpg\" valign=\"top\">
                  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\">
                    <tr>
                      <td class=\"cBarStart\" valign=\"top\">
                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                          <tr>
                            <td valign=\"top\"><img src=\"images/cat_arrow.gif\" width=\"25\" height=\"39\"></td>
                            <td class=\"cattitle\"><span class=\"tableTitle\">Téma nebo pøíspìvek neexistuje</span></td>
                          </tr>
                        </table>
                      </td>
                      <td><img src=\"images/spacer.gif\" width=\"1\" height=\"51\"></td>
                    </tr>
                  </table>
                </td>
                <td width=\"0%\"><img src=\"images/cat_rcap.gif\" width=\"33\" height=\"51\"></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width=\"0%\"><img src=\"images/spacer.gif\" width=\"16\" height=\"22\"></td>
          <td width=\"100%\">
            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
              <tr>
                <td width=\"0%\" class=\"cboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
                <td width=\"100%\" class=\"cbox\">
                  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                    <tr>
                      <td class=\"cBoxStart\">
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Toto téma nebo pøíspìvek neexistuje.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php\" class=\"genmed\"><b>zde</b></a> pro návrat na hlavní stránku.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width=\"0%\" class=\"cboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
              </tr>
              <tr>
                <td width=\"0%\" class=\"cboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
                <td width=\"100%\" valign=\"top\" class=\"cboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
                <td width=\"0%\" class=\"cboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
              </tr>
            </table>
          </td>
          <td class=\"catbox_right\"><img src=\"images/spacer.gif\" width=\"27\" height=\"27\"></td>
        </tr>
      </table>
</td>
  </tr>
</table>






";
}//end exist!
}
else
{print "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";}
/*
echo 
"	      		<table width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
							<tr>
								<td width=\"0%\" align=\"left\" valign=\"top\" class=\"row1\"><span class=\"name\"><a name=\"11\"></a><b>Geniv</b></span><br><span class=\"postdetails\"><br><br><br>ZaloÅ¾en: 22.3.2007<br>PÅ™Ã­spÄ›vky: 1<br></span><br>                  <img src=\"images/spacer.gif\" width=\"150\" height=\"1\"></td>
								<td class=\"row1\" width=\"80%\" height=\"28\" valign=\"top\">

									<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
										<tr>
											<td width=\"100%\">&nbsp;<a href=\"viewtopic.php?p=11#11\"><img src=\"images/minipost_read.gif\" width=\"12\" height=\"9\" alt=\"PÅ™Ã­spÄ›vek\" title=\"PÅ™Ã­spÄ›vek\" border=\"0\"></a><span class=\"postdetails\">Zaslal: pondÄ›lÃ­, 02 duben, 2007 17:24<span class=\"gen\">&nbsp;</span>&nbsp; &nbsp;PÅ™edmÄ›t: neco test</span></td>
											<td valign=\"top\" align=\"right\" nowrap=\"nowrap\"><a href=\"posting.php?mode=quote&amp;p=11\"><img src=\"images/tlacitka/icon_quote.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Citovat\" title=\"Citovat\" border=\"0\"></a> <a href=\"posting.php?mode=editpost&amp;p=11\"><img src=\"images/tlacitka/icon_edit.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Upravit/Odstranit tento pÅ™Ã­spÄ›vek\" title=\"Upravit/Odstranit tento pÅ™Ã­spÄ›vek\" border=\"0\"></a> <a href=\"posting.php?mode=delete&amp;p=11&amp;sid=3779e72d1eb3c9287f390a413cfb19af\"><img src=\"images/icon_delete.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odstranit tento pÅ™Ã­spÄ›vek\" title=\"Odstranit tento pÅ™Ã­spÄ›vek\" border=\"0\"></a> <a href=\"modcp.php?mode=ip&amp;p=11&amp;t=5&amp;sid=3779e72d1eb3c9287f390a413cfb19af\"><img src=\"images/tlacitka/icon_ip.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Zobrazit IP adresu odesilatele\" title=\"Zobrazit IP adresu odesilatele\" border=\"0\"></a> <a href=\"#top\"><img src=\"images/icon_top.gif\" width=\"22\" height=\"19\" alt=\"Back to top\" border=\"0\" class=\"imgfade\" onmouseover=\"this.className='imgfull'\" onmouseout=\"this.className='imgfade'\"></a></td>
										</tr>
										<tr>
											<td colspan=\"2\"><hr class=\"post\"></td>
										</tr>
										<tr>
											<td colspan=\"2\" class=\"postbody\"><span class=\"postbody\">bla bla bla.....<br>_________________<br>VÅ¡e na mÃ½ch strÃ¡nkÃ¡ch...</span><span class=\"gensmall\"></span></td>
										</tr>
									</table>

								</td>
							</tr>
							<tr>
								<td class=\"row1\" width=\"150\" align=\"left\" valign=\"middle\">&nbsp;</td>
								<td class=\"row1\" width=\"100%\" height=\"28\" valign=\"bottom\" nowrap>

									<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" height=\"18\" width=\"18\">
										<tr>
											<td valign=\"middle\" style=\"padding-top: 10px\" nowrap>
                      <a href=\"profile.php?mode=viewprofile&amp;u=3\"><img src=\"images/tlacitka/icon_profile.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Zobrazit informace o autorovi\" title=\"Zobrazit informace o autorovi\" border=\"0\"></a> 
                      <a href=\"privmsg.php?mode=post&amp;u=3\"><img src=\"images/tlacitka/icon_pm.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odeslat soukromou zprÃ¡vu\" title=\"Odeslat soukromou zprÃ¡vu\" border=\"0\"></a> 
                      <a href=\"mailto:geniv@centrum.cz\"><img src=\"images/tlacitka/icon_email.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odeslat e-mail\" title=\"Odeslat e-mail\" border=\"0\"></a>     
                      </td>
										</tr>
									</table>

								</td>
							</tr>
						</table>";
*/
			
?>
