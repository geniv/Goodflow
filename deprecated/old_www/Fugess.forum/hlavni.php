<!-- obsah -->
<?

/*
$del[0]=2;
$del[1]=4;
$del[2]=1;
$del[3]=3;
$del[4]=2;


$nadpis[0]="V�eobecn� informace o f�ru";
$nadpis[1]="TRS 2004 / 2006";
$nadpis[2]="Grafika";
$nadpis[3]="Elektro";
$nadpis[4]="Ostatn�";

$tema[0]="Stru�n� popis f�ra";
$tema[1]="N�vrhy a �e�en�";
$tema[2]="Stavba objekt�";
$tema[3]="Projekty";
$tema[4]="Tutori�ly";
$tema[5]="Programy";
$tema[6]="3D Grafika";
$tema[7]="Elektro v�robky";
$tema[8]="Sch�mata";
$tema[9]="Unik�tn� fotky a videa";
$tema[10]="Re�ln� �eleznice";
$tema[11]="Modelov� �eleznice";

$pozn[0]="Sezn�men� s mo�nostmi tohohle f�ra";
$pozn[1]="N�vrhy na vylep�en� f�ra a jejich �e�en�";
$pozn[2]="Novinky, informace a v�e kolem stavby objekt�";
$pozn[3]="Chystan� a st�vaj�c� projekty";
$pozn[4]="N�vody na gmax / 3Dsmax";
$pozn[5]="Programy jako pom�cky p�i tvorb� v TRS";
$pozn[6]="Obr�zky re�ln�ch i nere�ln�ch sc�n";
$pozn[7]="Fotky funk�n�ch i nefunk�n�ch v�robk� a diskuze k nim";
$pozn[8]="Sch�mata ov��en�ch i neov��en�ch v�robk� a diskuze k nim";
$pozn[9]="Jedine�n� fotky a videa - co dok�e elektronika";
$pozn[10]="Fotky a videa z modelov� �eleznice";
$pozn[11]="Fotky a videa z re�lu";
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
{$obrz="<img src=\"images/folder_new_big.gif\" width=\"30\" height=\"30\" alt=\"Nov� p��sp�vky\" title=\"Nov� p��sp�vky\" class=\"img_forumstatus\">";}
else
{$obrz="<img src=\"images/folder_locked_new_big.gif\" width=\"30\" height=\"30\" alt=\"Nov� p��sp�vky [zamknuto]\" title=\"Nov� p��sp�vky [zamknuto]\" class=\"img_forumstatus\">";}
}
else
{
if($zamk=="true")
{$obrz="<img src=\"images/folder_big.gif\" width=\"30\" height=\"30\" alt=\"��dn� nov� p��sp�vky\" title=\"��dn� nov� p��sp�vky\" class=\"img_forumstatus\">";}
else
{$obrz="<img src=\"images/folder_locked_big.gif\" width=\"30\" height=\"30\" alt=\"��dn� nov� p��sp�vky [zamknuto]\" title=\"��dn� nov� p��sp�vky [zamknuto]\" class=\"img_forumstatus\">";}
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
                            <a href=\"#\" class=\"forumstats\" title=\"P��sp�vky\">$prispevky</a>
                            &nbsp;/&nbsp;
                            <a href=\"#\" class=\"forumstats\" title=\"T�mata\">$temata</a>
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
<A href="index.php?mark=forums" class="gensmall">Ozna�it v�echna f�ra jako p�e�ten�</a>
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
<td class="cattitle" width="100%"><span class="cattitle">V�eobecn� informace</span></td>
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
<td rowspan="2" align="left" width="7%"><img src="images/whosonline.gif" alt="V�eobecn� informace"></td>
<td>
<span class="genmed" width="100%">U�ivatel� zaslali celkem <b><? print $celkem_pris; ?></b> p��sp�vk�.
<br>
Je zde <b><? print pocet_uzivatelu_celkem(); ?></b> 
registrovan�ch u�ivatel�.<br>Nejnov�j��m registrovan�m u�ivatelem je 
<b><? print posledni_uzivatel();?></b>.
</span>
</td>
</tr>
<tr>
<td class="onlineIndex">
<!---  
<span class="genmed">Celkem je zde p��tomno 
XX<b><? print pocet_uzivatelu($REMOTE_ADDR); ?></b>XX
u�ivatel�: XX<? print registrovanych(); ?>XX 
registrovan�ch a XX<? print anonymnich($REMOTE_ADDR); ?>XX anonymn�ch. &nbsp; 
[ <span style="color:#27CFFF">administr�to�i</span> ] &nbsp; 
[ <span style="color:#FFFF00">moder�to�i</span> ]
<br>
Registrovan� u�ivatel�: 
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
<td align="center" style="padding-top: 3px; padding-bottom: 3px"><img src="images/folder_new.gif" alt="Nov� p��sp�vky" width="23" height="23"></td>
<td><span class="genmed">Nov� p��sp�vky</span></td>
<td>&nbsp;</td>
<td align="center"><img src="images/folder.gif" alt="��dn� nov� p��sp�vky" width="23" height="23"></td>
<td><span class="genmed">��dn�&nbsp;nov� p��sp�vky</span></td>
<td>&nbsp;</td>
<td align="center"><img src="images/folder_lock_new.gif" alt="Nov� p��sp�vky [zamknuto]" width="23" height="23"></td>
<td><span class="genmed">Nov�&nbsp;p��sp�vky [zamknuto]</span></td>
<td>&nbsp;</td>
<td align="center"><img src="images/folder_lock.gif" alt="��dn� nov� p��sp�vky [zamknuto]" width="23" height="23"></td>
<td><span class="genmed">��dn�&nbsp;nov� p��sp�vky&nbsp;[zamknuto]</span></td>
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
