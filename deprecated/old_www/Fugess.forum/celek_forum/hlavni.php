<!-- obsah -->
<?

/*
$del[0]=2;
$del[1]=4;
$del[2]=1;
$del[3]=3;
$del[4]=2;


$nadpis[0]="Všeobecné informace o fóru";
$nadpis[1]="TRS 2004 / 2006";
$nadpis[2]="Grafika";
$nadpis[3]="Elektro";
$nadpis[4]="Ostatní";

$tema[0]="Struèný popis fóra";
$tema[1]="Návrhy a øešení";
$tema[2]="Stavba objektù";
$tema[3]="Projekty";
$tema[4]="Tutoriály";
$tema[5]="Programy";
$tema[6]="3D Grafika";
$tema[7]="Elektro výrobky";
$tema[8]="Schémata";
$tema[9]="Unikátní fotky a videa";
$tema[10]="Reálná železnice";
$tema[11]="Modelová železnice";

$pozn[0]="Seznámení s možnostmi tohohle fóra";
$pozn[1]="Návrhy na vylepšení fóra a jejich øešení";
$pozn[2]="Novinky, informace a vše kolem stavby objektù";
$pozn[3]="Chystané a stávající projekty";
$pozn[4]="Návody na gmax / 3Dsmax";
$pozn[5]="Programy jako pomùcky pøi tvorbì v TRS";
$pozn[6]="Obrázky reálných i nereálných scén";
$pozn[7]="Fotky funkèních i nefunkèních výrobkù a diskuze k nim";
$pozn[8]="Schémata ovìøených i neovìøených výrobkù a diskuze k nim";
$pozn[9]="Jedineèné fotky a videa - co dokáže elektronika";
$pozn[10]="Fotky a videa z modelové železnice";
$pozn[11]="Fotky a videa z reálu";
*/
//print array_sum($del).", ";
//print velikost_adresare("images\avatars");
//-------------------------------------------------------
//$delka_novoty=delka_novoty_hlavni();
$pom=0;
$celkem_pris=0;
for($i=0;$i<delka_nadpisu_hl();$i++)
{
$nadp=nadpis($i);

echo
"<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
		<tr>
			<td colspan=\"3\">
			
				<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td width=\"0%\"><img src=\"images/cat_lcap.gif\" width=\"22\" height=\"51\"></td>
						<td width=\"100%\" background=\"images/cat_bar.jpg\" valign=\"top\">
							<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\">
								<tr>
									<td class=\"cBarStart\" valign=\"top\">										
                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
											<tr>
												<td valign=\"top\" width=\"0%\"><img src=\"images/cat_arrow.gif\" width=\"25\" height=\"39\"></td>
												<td class=\"cattitle\" width=\"100%\"><span class=\"cattitle\">$nadp</span></td>
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
			<td width=\"100%\" valign=\"top\">
			
			<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td width=\"0%\" class=\"cboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
						<td width=\"100%\" class=\"cbox\" valign=\"top\">
						<table width=\"100%\" height=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
									<td class=\"cBoxStart\">";
for($i1=0;$i1<delka_fora($i);$i1++)
{
$pom++;
$tema=temata_fora($pom);
$pozn=obsah_pozn($pom-1);
$temata=pocet_temat($pom);
$prispevky=pocet_prispevku($pom);

$celkem_pris+=$prispevky;

if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true")
{$posledni=nacti_posledni_prispevek_v_hlavnim($pom);}
else
{$posledni="";}

$zamk=stav_zamku_vlakna($pom);

//nacti_novotu_vlakna($pom)>Date("j.n.")
//$celkovy_pocet=celkovy_pocet_zhlednuti_tema($pom);
//if($celkovy_pocet!=0 and $celkovy_pocet<=$delka_novoty)

if(novota_fora($pom)=="nove")
{
if($zamk=="true")
{$obrz="<img src=\"images/folder_new_big.gif\" width=\"30\" height=\"30\" alt=\"Nové pøíspìvky\" title=\"Nové pøíspìvky\" class=\"img_forumstatus\">";}
else
{$obrz="<img src=\"images/folder_locked_new_big.gif\" width=\"30\" height=\"30\" alt=\"Nové pøíspìvky [zamknuto]\" title=\"Nové pøíspìvky [zamknuto]\" class=\"img_forumstatus\">";}
}
else
{
if($zamk=="true")
{$obrz="<img src=\"images/folder_big.gif\" width=\"30\" height=\"30\" alt=\"Žádné nové pøíspìvky\" title=\"Žádné nové pøíspìvky\" class=\"img_forumstatus\">";}
else
{$obrz="<img src=\"images/folder_locked_big.gif\" width=\"30\" height=\"30\" alt=\"Žádné nové pøíspìvky [zamknuto]\" title=\"Žádné nové pøíspìvky [zamknuto]\" class=\"img_forumstatus\">";}
}

echo 
"                     <table width=\"100%\" border=\"0\" cellspacing=\"8\" style=\"padding-left: 5px\">
												<tr>
													<td width=\"0%\" align=\"center\">
                            <DIV align=\"center\"><img src=\"images/spacer.gif\" width=\"8\" height=\"6\">$obrz</DIV>
                          </td>
													<td width=\"80%\">
                            <span class=\"forumlink\">
                            <A href=\"index.php?kam=forum&cis=$pom&str=1\" class=\"forumlink\">$tema</a>
                            <br>
                            </span>
                            <span class=\"forumdescription\">$pozn</span>
                            <br>
                            <span class=\"forummoderator\">&nbsp;</span>
                          </td>
													<td width=\"10%\" nowrap=\"nowrap\" align=\"center\" class=\"forumstats\">
                            <strong>
                            <a href=\"#\" class=\"forumstats\" title=\"Pøíspìvky\">$prispevky</a>
                            &nbsp;/&nbsp;
                            <a href=\"#\" class=\"forumstats\" title=\"Témata\">$temata</a>
                            </strong>
                          </td>
													<td width=\"160\" align=\"center\" nowrap>
                            <span class=\"gensmall\">
                            $posledni
                            </span>
                          </td>
												</tr>
											</table>";
}//end for $i1
echo
"											<img src=\"images/spacer.gif\" width=\"6\" height=\"6\">

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
		<tr>
			<td colspan=\"3\"><BR></td>
		</tr>
	</table>";
}//end for $i

/*
<span class="gensmall">
<A href="index.php?mark=forums" class="gensmall">Oznaèit všechna fóra jako pøeètená</a>
</span>
*/
?>
<!-- obsah -->
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="0%"><img src="images/cat_lcap_whosonline.gif" width="22" height="51"></td>
<td width="100%" background="images/cat_bar.jpg" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
<tr>
<td class="cBarStart" valign="top">

<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td valign="top" width="0%"><img src="images/whosonline_item.gif"></td>
<td class="cattitle" width="100%"><span class="cattitle">Všeobecné informace</span></td>
</tr>
</table>

</td>
<td><img src="images/spacer.gif" width="1" height="51"></td>
</tr>
</table>

</td>
<td width="0%"><img src="images/cat_rcap.gif" width="33" height="51"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td width="0%"><img src="images/spacer.gif" width="16" height="22"></td>
<td width="100%">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="0%" class="cboxLeft"><img src="images/spacer.gif" width="6" height="5"></td>
<td width="100%" class="cbox">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="cBoxStart">

<table width="100%" border="0" cellspacing="6" cellpadding="3" style="padding-top: 1px">
<tr>
<td rowspan="2" align="left" width="7%"><img src="images/whosonline.gif" alt="Všeobecné informace"></td>
<td>
<span class="genmed" width="100%">Uživatelé zaslali celkem <b><? print $celkem_pris; ?></b> pøíspìvkù.
<br>
Je zde <b><? print pocet_uzivatelu_celkem(); ?></b> 
registrovaných uživatelù.<br>Nejnovìjším registrovaným uživatelem je 
<b><? print posledni_uzivatel();?></b>.
</span>
</td>
</tr>
<tr>
<td class="onlineIndex">
<!---  
<span class="genmed">Celkem je zde pøítomno 
XX<b><? print pocet_uzivatelu($REMOTE_ADDR); ?></b>XX
uživatelù: XX<? print registrovanych(); ?>XX 
registrovaných a XX<? print anonymnich($REMOTE_ADDR); ?>XX anonymních. &nbsp; 
[ <span style="color:#27CFFF">administrátoøi</span> ] &nbsp; 
[ <span style="color:#FFFF00">moderátoøi</span> ]
<br>
Registrovaní uživatelé: 
<?
/*
for($i=1;$i<registrovanych();$i++)
{
$uzv=vypis_uzivatelu($i);
$car=", ";
if($i==1)
{echo "$car<a href=\"index.php?kam=info_user&kdo=$uzv\">$uzv</a>";}
else
{echo "<a href=\"index.php?kam=info_user&kdo=$uzv\">$uzv</a> ";}
}//end for
*/
?>
</span>
---->
</td>
</tr>
</table>

</td>
</tr>
</table>

</td>
<td width="0%" class="cboxRight"><img src="images/spacer.gif" width="6" height="6">
</td>
</tr>
<tr>
<td width="0%" class="cboxLeftbottom"><img src="images/spacer.gif" width="6" height="6"></td>
<td width="100%" valign="top" class="cboxBottom"><img src="images/spacer.gif" width="6" height="6"></td>
<td width="0%" class="cboxRightbottom"><img src="images/spacer.gif" width="6" height="6"></td>
</tr>
</table>

</td>
<td class="catbox_right"><img src="images/spacer.gif" width="27" height="27">
</td>
</tr>
</table>



<br><br>

<br clear="all">

<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td width="5" class="mainboxLefttop"><img src="images/spacer.gif" width="6" height="6"></td>
<td width="400" class="mainboxTop"><img src="images/spacer.gif" width="6" height="6"></td>
<td width="5" class="mainboxRighttop"><img src="images/spacer.gif" width="6" height="6"></td>
</tr>
<tr>
<td width="5" class="mainboxLeft"><img src="images/spacer.gif" width="6" height="6">
</td>
<td width="400" class="folderIconBox">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td class="folderIconBoxStart">
<table cellspacing="0" border="0" align="center" cellpadding="5">
<tr>
<td align="center" style="padding-top: 3px; padding-bottom: 3px"><img src="images/folder_new.gif" alt="Nové pøíspìvky" width="23" height="23"></td>
<td><span class="genmed">Nové pøíspìvky</span></td>
<td>&nbsp;</td>
<td align="center"><img src="images/folder.gif" alt="Žádné nové pøíspìvky" width="23" height="23"></td>
<td><span class="genmed">Žádné&nbsp;nové pøíspìvky</span></td>
<td>&nbsp;</td>
<td align="center"><img src="images/folder_lock_new.gif" alt="Nové pøíspìvky [zamknuto]" width="23" height="23"></td>
<td><span class="genmed">Nové&nbsp;pøíspìvky [zamknuto]</span></td>
<td>&nbsp;</td>
<td align="center"><img src="images/folder_lock.gif" alt="Žádné nové pøíspìvky [zamknuto]" width="23" height="23"></td>
<td><span class="genmed">Žádné&nbsp;nové pøíspìvky&nbsp;[zamknuto]</span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="5" class="mainboxRight"><img src="images/spacer.gif" width="6" height="6"></td>
</tr>
<tr>
<td width="5" class="mainboxLeftbottom"><img src="images/spacer.gif" width="6" height="6"></td>
<td width="400" valign="top" class="mainboxBottom"><img src="images/spacer.gif" width="6" height="6"></td>
<td width="5" class="mainboxRightbottom"><img src="images/spacer.gif" width="6" height="6"></td>
</tr>
</table>
