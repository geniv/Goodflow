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

//-------------------------------------------------------
$delkasoub=delka_souboru();

$soub="nad_pi_s_qwpdojsniufcojsiufvhjnviurebhfcbvjdoiqpowdfncwdfkjmvnwriufcmireu�hjoiewghvisucjwruvbwiuijfiwuhfuehfiwhufeueueuuueueuckaeinef.php";
$u=fopen($soub,"r");
$nadpis=explode("--NP--",fread($u,$delkasoub));
fclose($u);

$soub="te_ma_qpwdemwriuvjuoiejdcwriuhvneuirbvuiernvenclnqwdpkweoimcqeodcmrievneiuvwioiwrjnvoierjvoijwiojfoiwrjvrvrv.php";
$u=fopen($soub,"r");
$tema=explode("--TM--",fread($u,$delkasoub));
fclose($u);

$soub="poz_namky_dlkjfhiwocniwspqwejfowwchnzsiudcmrweiuvbcnwreuivzbuisfnvezuhvbnwrezuisjfhvnerjhkfvherniuvnervjkhejhverhjv.php";
$u=fopen($soub,"r");
$pozn=explode("--PZ--",fread($u,$delkasoub));
fclose($u);
//-------------------------------------------------------

$pom=0;
for($i=0;$i<count($nadpis);$i++)
{
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
												<td class=\"cattitle\" width=\"100%\"><span class=\"cattitle\">{$nadpis[$i]}</span></td>
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
echo 
"                     <table width=\"100%\" border=\"0\" cellspacing=\"8\" style=\"padding-left: 5px\">
												<tr>
													<td width=\"0%\" align=\"center\">
                            <DIV align=\"center\"><img src=\"images/spacer.gif\" width=\"8\" height=\"6\"><img src=\"images/folder_big.gif\" width=\"30\" height=\"30\" alt=\"��dn� nov� p��sp�vky\" title=\"��dn� nov� p��sp�vky\" class=\"img_forumstatus\"></DIV>
                          </td>
													<td width=\"80%\">
                            <span class=\"forumlink\">
                            <A href=\"index.php?kam=forum&cis=$pom\" class=\"forumlink\">{$tema[$pom-1]}</a>
                            <br>
                            </span>
                            <span class=\"forumdescription\">{$pozn[$pom-1]}</span>
                            <br>
                            <span class=\"forummoderator\">&nbsp;</span>
                          </td>
													<td width=\"10%\" nowrap=\"nowrap\" align=\"center\" class=\"forumstats\">
                            <strong>
                            <a href=\"#\" class=\"forumstats\" title=\"P��sp�vky\">$i1</a>
                            &nbsp;/&nbsp;
                            <a href=\"#\" class=\"forumstats\" title=\"T�mata\">$i1</a>
                            </strong>
                          </td>
													<td width=\"160\" align=\"center\" nowrap>
                            <span class=\"gensmall\">(datum)
                            <br>
                            ????
                            <a href=\"...n�kam\"><img src=\"images/minipost_goto_read.gif\" border=\"0\" alt=\"Zobrazit posledn� p��sp�vek\" title=\"Zobrazit posledn� p��sp�vek\">(p�ej�t)</a>
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
<table width="100%" cellspacing="0" border="0" align="center" cellpadding="2">
<tr>
<td align="left">
&nbsp;
</td>

<td align="right">
<span class="gensmall">�asy uv�d�ny v GMT + 1 hodina</span>
</td>
</tr>
</table>

<BR><BR>

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
<td valign="top" width="0%"><img src="images/whosonline_item.gif" width="21" height="39"></td>
<td class="cattitle" width="100%"><span class="cattitle"><A href="viewonline.php" class="cattitle">Kdo je p��tomen</a></span></td>
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

<table width="100%" border="0" cellspacing="8" cellpadding="0" style="padding-top: 1px">
<tr>
<td rowspan="2" align="center"><img src="images/whosonline.gif" width="49" height="48" alt="Kdo je p��tomen"></td>
<td>
<span class="genmed">U�ivatel� zaslali celkem <b>xxx</b> p��sp�vk�.
<br>
Je zde <b><? print pocet_uzivatelu_celkem(); ?></b> 
registrovan�ch u�ivatel�.<br>Nejnov�j��m registrovan�m u�ivatelem je 
<b><a href="index.php?kam=info_user&kdo=<? print posledni_uzivatel(); ?>"><? print posledni_uzivatel(); ?></a></b>.
</span>
</td>
</tr>
<tr>
<td class="onlineIndex">
<span class="genmed">Celkem je zde p��tomno 
<b><? print pocet_uzivatelu($REMOTE_ADDR); ?></b> 
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

<table width="100%" cellpadding="1" cellspacing="1" border="0">
<tr>
<td align="left" valign="top"><span class="gensmall">Tato data jsou zalo�ena na aktivit� u�ivatel� b�hem posledn�ch 5 minut.</span></td>
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
<td width="23" align="center" style="padding-top: 5px; padding-bottom: 5px"><img src="images/folder_new.gif" alt="Nov� p��sp�vky" width="23" height="23"></td>
<td><span class="genmed">Nov� p��sp�vky</span></td>
<td>&nbsp;</td>
<td width="23" align="center"><img src="images/folder.gif" alt="��dn� nov� p��sp�vky" width="23" height="23"></td>
<td><span class="genmed">��dn� nov� p��sp�vky</span></td>
<td>&nbsp;</td>
<td width="23" align="center"><img src="images/folder_lock.gif" alt="F�rum je zamknuto" width="23" height="23"></td>
<td><span class="genmed">F�rum je zamknuto</span></td>
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
