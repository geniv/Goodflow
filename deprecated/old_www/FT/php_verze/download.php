<?
$sb_ban="bin_ban_bong_lide_ihhciacianfancoijnhiuhoiadaoifisubvcs.php";
$uk=fopen($sb_ban,"r");
$nezadouci_ip=explode("#b*",fread($uk,1000000));
fclose($uk);

for ($i=0;$i<count($nezadouci_ip);$i++)
{
if ($nezadouci_ip[$i]==$REMOTE_ADDR)
{
require "ban/ban.php";
exit;
}}
?>
<table border=0 cellpadding=0 cellspacing=0 align=center>
<tr><td>Download - 3D Modely do TRS 2004 / 2006</td></tr>
</table>
<?
//Obr�zek
$obr[0]="download_obr/geniv_config_creator.gif";
$obr[1]="download_obr/Rodinny_dum_s_night.gif";
$obr[2]="download_obr/Prislusenstvi_k_zahrade.gif";
$obr[3]="download_obr/Poldi_hute.gif";
$obr[4]="download_obr/Kaplicka_b.gif";
$obr[5]="download_obr/Kaplicka_a.gif";
$obr[6]="download_obr/IDS_-_Informacni_tabule_-_Reskin.gif";
$obr[7]="download_obr/IDS_-_Informacni_tabule.gif";
$obr[8]="download_obr/Chladici_box_na_napoje.gif";
$obr[9]="download_obr/Stavedlo_holoubkov.gif";
$obr[10]="download_obr/Garaz_b.gif";
$obr[11]="download_obr/Garaz_a.gif";
$obr[12]="download_obr/Elektricke_skrine.gif";
$obr[13]="download_obr/Automat_na_listky.gif";
$obr[14]="download_obr/Ruda_hvezda.gif";
$obr[15]="download_obr/Hasicska_stanice.gif";
$obr[16]="download_obr/Garaze_radove.gif";
$obr[17]="download_obr/Sada_predloh.gif";
$obr[18]="download_obr/Stanicnik.gif";
$obr[19]="download_obr/Lampa-Moravsky_Krumlov.gif";
$obr[20]="download_obr/lamelovy_billboard.gif";
$obr[21]="download_obr/Moravsky_Krumlov.gif";
//N�zev
$naz[0]="Geniv Config Creator";
$naz[1]="Rodinn� d�m";
$naz[2]="P��slu�enstv� k zahrad�";
$naz[3]="Poldi H�te";
$naz[4]="Kapli�ka - B";
$naz[5]="Kapli�ka - A";
$naz[6]="Informa�n� Tabule IDS JMK";
$naz[7]="Informa�n� Tabule IDS JMK";
$naz[8]="Chlad�c� box na n�poje";
$naz[9]="Stav�dlo Holoubkov";
$naz[10]="Gar� - B";
$naz[11]="Gar� - A";
$naz[12]="Elektrick� sk��n�";
$naz[13]="Automat na l�stky";
$naz[14]="Rud� hv�zda";
$naz[15]="Hasi�sk� stanice";
$naz[16]="�ada re�ln�ch gar��";
$naz[17]="Sada p�edloh";
$naz[18]="Stani�n�k";
$naz[19]="Lampa";
$naz[20]="Lamelov� billboard";
$naz[21]="Moravsk� Krumlov";
//Popis - Z�kladn�
$pop[0]="- Pomocn�k p�i tvorb� configu";
$pop[1]="- Stav�no podle vzoru";
$pop[2]="- Sada obsahuje dopl�ky k zahrad�";
$pop[3]="- Billboard";
$pop[4]="- Um�stn�n�: Nov� Cerekev";
$pop[5]="- Um�stn�n�: Nov� Cerekev";
$pop[6]="- Reskin";
$pop[7]="- Dopln�k na n�dra��";
$pop[8]="- Dopln�k na n�dra��";
$pop[9]="- Obsahuje no�n� m�d";
$pop[10]="- Stav�no podle vzoru";
$pop[11]="- Stav�no podle vzoru";
$pop[12]="- Um�stn�n�: Jak�koliv obytn� z�ny";
$pop[13]="- Dopln�k pro zast�vky";
$pop[14]="- Dopln�k pro r�zn� tov�rny";
$pop[15]="- Postaveno pro JediTrainz Team";
$pop[16]="- Um�stn�n�: B�eclav";
$pop[17]="- P�edloha pro stavitele map";
$pop[18]="- B�val� zna�en� \"kilometrovn�k\"";
$pop[19]="- Nach�z� se v Moravsk�m Krumlov�";
$pop[20]="- Postupn� ot��ej�c� se billboard";
$pop[21]="- Model je stav�n podle skute�n� stanice";
//Popis - Prvn�
$pz1[0]="- Mo�nosti konfigurace:";
$pz1[1]="- Obsahuje no�n� m�d";
$pz1[2]="- 21 model�";
$pz1[3]="- Na ��dost";
$pz1[4]="- O�ezan� detaily p�vodn�ho modelu";
$pz1[5]="- Detailn�j�� model";
$pz1[6]="- Dopln�k na n�dra��";
$pz1[7]="";
$pz1[8]="";
$pz1[9]="- Obohaceno o kou�ov� efekt";
$pz1[10]="";
$pz1[11]="";
$pz1[12]="";
$pz1[13]="- Obsahuje no�n� m�d";
$pz1[14]="- Na ��dost";
$pz1[15]="- Um�stn�n�: Nov� Cerekev";
$pz1[16]="";
$pz1[17]="- <a href='http://trainz.jedisoft.cz/remotefile.php?IdFrag=1160' target='_blank'>N�vod</a> (z Trainz.cz)";
$pz1[18]="- Na desetinn� m�sta";
$pz1[19]="- Obsahuje no�n� m�d";
$pz1[20]="- V bal��ku jsou dv� verze";
$pz1[21]="- 3 p�episovateln� cedule";
//Popis - Druh�
$pz2[0]="- Z�kladn� funkce configu";
$pz2[1]="";
$pz2[2]="";
$pz2[3]="";
$pz2[4]="";
$pz2[5]="";
$pz2[6]="";
$pz2[7]="";
$pz2[8]="";
$pz2[9]="- <span id=down_aktualiz>Aktualizace 21.01.2007</span>";
$pz2[10]="";
$pz2[11]="";
$pz2[12]="";
$pz2[13]="";
$pz2[14]="";
$pz2[15]="";
$pz2[16]="";
$pz2[17]="";
$pz2[18]="- Scenery objekt";
$pz2[19]="- Na ��dost";
$pz2[20]="- Postaveno pro JediTrainz Team";
$pz2[21]="- s no�n�m m�dem";
//Popis - T�et�
$pz3[0]="- Night m�d";
$pz3[1]="";
$pz3[2]="";
$pz3[3]="";
$pz3[4]="";
$pz3[5]="";
$pz3[6]="";
$pz3[7]="";
$pz3[8]="";
$pz3[9]="- Seznam oprav je vyps�n v CDP";
$pz3[10]="";
$pz3[11]="";
$pz3[12]="";
$pz3[13]="";
$pz3[14]="";
$pz3[15]="";
$pz3[16]="";
$pz3[17]="";
$pz3[18]="- Postaveno pro JediTrainz Team";
$pz3[19]="";
$pz3[20]="- <a href='http://www.nahraj.cz/down/54404169/lamelovy_billboard.rar.html' target='_blank'>Zde video z renderu</a>";
$pz3[21]="- <span id=down_aktualiz>Aktualizace 22.01.2007</span>";
//Popis - �tvrt�
$pz4[0]="- Kou�ov� efekt";
$pz4[1]="";
$pz4[2]="";
$pz4[3]="";
$pz4[4]="";
$pz4[5]="";
$pz4[6]="";
$pz4[7]="";
$pz4[8]="";
$pz4[9]="";
$pz4[10]="";
$pz4[11]="";
$pz4[12]="";
$pz4[13]="";
$pz4[14]="";
$pz4[15]="";
$pz4[16]="";
$pz4[17]="";
$pz4[18]="- <span id=down_aktualiz>Aktualizace 24.01.2007</span>";
$pz4[19]="";
$pz4[20]="";
$pz4[21]="- Aktualizace je pops�na v CDP";
//Pro
$pro[0]="TRS 2004";
$pro[1]="TRS 2004";
$pro[2]="TRS 2004";
$pro[3]="TRS 2004";
$pro[4]="TRS 2004";
$pro[5]="TRS 2004";
$pro[6]="TRS 2004 / TRS 2006";
$pro[7]="TRS 2004";
$pro[8]="TRS 2004";
$pro[9]="TRS 2004 / TRS 2006";
$pro[10]="TRS 2004";
$pro[11]="TRS 2004";
$pro[12]="TRS 2004";
$pro[13]="TRS 2004";
$pro[14]="TRS 2004 / 2006";
$pro[15]="TRS 2004 / 2006";
$pro[16]="TRS 2004 / 2006";
$pro[17]="TRS 2004 / 2006";
$pro[18]="TRS 2004 / 2006";
$pro[19]="TRS 2004";
$pro[20]="TRS 2004 / 2006";
$pro[21]="TRS 2004 / 2006";
//Velikost
$vel[0]="576 kB";
$vel[1]="89,2 kB";
$vel[2]="596 kB";
$vel[3]="50,6 kB";
$vel[4]="347 kB";
$vel[5]="226 kB";
$vel[6]="295 kB";
$vel[7]="296 kB";
$vel[8]="683 kB";
$vel[9]="277�kB";
$vel[10]="51,9 kB";
$vel[11]="48 kB";
$vel[12]="122 kB";
$vel[13]="165 kB";
$vel[14]="106 kB";
$vel[15]="406 kB";
$vel[16]="318 kB";
$vel[17]="1,24 MB";
$vel[18]="192�kB";
$vel[19]="68,4 kB";
$vel[20]="1,94�MB";
$vel[21]="585�kB";
//Download
$stos[0]="location.href='download_soubory/geniv_config_creator.rar';";
$stos[1]="location.href='download_soubory/Rodinny_dum_s_night.cdp';";
$stos[2]="location.href='download_soubory/Prislusenstvi_k_zahrade.cdp';";
$stos[3]="location.href='download_soubory/Poldi_hute.cdp';";
$stos[4]="location.href='download_soubory/Kaplicka_b.cdp';";
$stos[5]="location.href='download_soubory/Kaplicka_a.cdp';";
$stos[6]="location.href='download_soubory/IDS_-_Informacni_tabule_-_Reskin.cdp';";
$stos[7]="location.href='download_soubory/IDS_-_Informacni_tabule.cdp';";
$stos[8]="location.href='download_soubory/Chladici_box_na_napoje.cdp';";
$stos[9]="location.href='download_soubory/Stavedlo_holoubkov.cdp';";
$stos[10]="location.href='download_soubory/Garaz_b.cdp';";
$stos[11]="location.href='download_soubory/Garaz_a.cdp';";
$stos[12]="location.href='download_soubory/Elektricke_skrine.cdp';";
$stos[13]="location.href='download_soubory/Automat_na_listky.cdp';";
$stos[14]="location.href='download_soubory/Ruda_hvezda.cdp';";
$stos[15]="location.href='download_soubory/Hasicska_stanice.cdp';";
$stos[16]="location.href='download_soubory/Garaze_radove.cdp';";
$stos[17]="location.href='download_soubory/Sada_predloh.cdp';";
$stos[18]="location.href='download_soubory/Stanicnik.cdp';";
$stos[19]="location.href='download_soubory/Lampa-Moravsky_Krumlov.cdp';";
$stos[20]="location.href='download_soubory/lamelovy_billboard.cdp';";
$stos[21]="location.href='download_soubory/Moravsky_Krumlov.cdp';";
//Vykreslov�n� tabulky, po sp�tku
for($p1=count($obr)-1;$p1<>-1;$p1--)
{//generuje podle po�tu obr�zku,d�l� dokud n�ni -1,ode��t�  
$pp1=$p1+1;
echo
"
<hr size=1 color=white>
<table border=0 cellpadding=0 cellspacing=0 align=center width=640px>
<tr>
<td>
<table border=0 cellpadding=0 cellspacing=0 align=left>
<tr>
<td align=left><img src=\"".$obr[$p1]."\"></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 align=left>
<tr>
<td align=center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 align=left>
<tr>
<td align=right><u>N�zev</u>:</td>
<td align=center>&nbsp;</td>
<td align=left>".$naz[$p1]."</td>
</tr>
<tr>
<td align=right><u>Popis</u>:</td>
<td align=center>&nbsp;</td>
<td align=left>".$pop[$p1]."</td>
</tr>";
if($pz1[$p1]!="")
{
echo "
<tr>
<td align=right>&nbsp;</td>
<td>&nbsp;</td>
<td align=left colspan=3>".$pz1[$p1]."</td>
</tr>";
$mzr="
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>";
}
else
{
$mzr="
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>";
}//end if a else
if($pz2[$p1]!="")
{
echo "
<tr>
<td align=right>&nbsp;</td>
<td>&nbsp;</td>
<td align=left colspan=3>".$pz2[$p1]."</td>
</tr>";
$mzr="
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>";
}
if($pz3[$p1]!="")
{
echo "
<tr>
<td align=right>&nbsp;</td>
<td>&nbsp;</td>
<td align=left colspan=3>".$pz3[$p1]."</td>
</tr>";
$mzr="
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left>&nbsp;</td>
</tr>";
}
if($pz4[$p1]!="")
{
echo
"<tr>
<td align=right>&nbsp;</td>
<td>&nbsp;</td>
<td align=left colspan=3>".$pz4[$p1]."</td>
</tr>";
$mzr="";
}
echo"
<tr>
<td align=right><u>Pro</u>:</td>
<td align=center>&nbsp;</td>
<td align=left>".$pro[$p1]."</td>
</tr>
<tr>
<td align=right><u>Velikost</u>:</td>
<td align=center>&nbsp;</td>
<td align=left>".$vel[$p1]."</td>
</tr>
$mzr
<tr>
<td align=right>&nbsp;</td>
<td align=center>&nbsp;</td>
<td align=left><INPUT type=image src=\"download_tlacitko.gif\" onclick=\"men.down.value='st$pp1';men.kam.value='download';men.posl.click();\"></td>
</tr>
</table>
</td>
</tr>
</table>
";
}//end for
?>
<hr size=1 color=white>

<SCRIPT LANGUAGE=javascript>
function nascr()
{
y=ReadCookie("scrol_y",0,24*365);
window.scrollTo(0,y);
}
function ulscr()
{
y=document.body ? document.body.scrollTop:pageYoffset;
WriteCookie("scrol_y",y,24*365);
}
</SCRIPT>

<?
if(!Empty($down))//rozli�en� st�hnut�!!
{
for($p1=count($obr)-1;$p1<>-1;$p1--)
{
$pp1=$p1+1;
$ss="st".$pp1;
if($down==$ss){$sta=$stos[$p1];}
}//end for
}
else
{
$sta="";
}//end if        na�te scroll, cesta           ukl�d� scroll
echo "<body onload=\"nascr();".$sta."\" onUnload=\"ulscr();\"></body>";
//--------------po��t�n�-------------------------------------------------
$s_dow="dovnloud_ihsiLKDJDcnnNvjndfjksddpjfdpjhmxkmxaufazufgkjclc.php";
$ukz=fopen($s_dow,"r");
$dow=explode("*+*",fread($ukz,10000));
fclose($ukz);
//------------
$sb="ip_asiksdjhkyxjbiapdjhuipasfgiuadhubiphfduisfjivodjivnsdoifnvmjcbwpfhwauif.php";
$k=fopen($sb,"r");
$dataip=explode("*@*",fread($k,1000000));
fclose($k);

//identifikace
for($ri=1;$ri<count($dataip);$ri=$ri+2)
{
if($REMOTE_ADDR==$dataip[$ri])  //ov��uje IP
{
$kdo=$dataip[$ri+1];
}//end if
}//end for

if(!Empty($down))
{
for($p1=0;$p1<count($obr);$p1++)
{
$pp1=$p1+1;
$ovt="st".$pp1;
if($down==$ovt)
{
$uzvsta=$naz[$p1];
}//end if
}//end for

$ckds="Byl sta�en soubor: <b>$uzvsta</b> u�ivatelem: <b>$kdo</b> z IP: $REMOTE_ADDR v ".Date("H:i:s j.m. Y")."<br>\n";
$s_ldw="log_down_aoeuchiuwsrvsihviuhiasdcacipojiuhasfvokjwroihwekh.php";
$uk=fopen($s_ldw,"a+");
fwrite($uk,$ckds);
fclose($uk);

for($p1=0;$p1<count($obr);$p1++)
{
$pp1=$p1+1;
$dtx="st".$pp1;
if($down==$dtx)
{//od nuly!!!
$dow[$p1]++;
}//end if
}//end for

$ukz=fopen($s_dow,"w");
fwrite($ukz,implode($dow,"*+*"));
fclose($ukz);
}
?>
