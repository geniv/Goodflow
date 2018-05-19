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
//Obrázek
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
//Název
$naz[0]="Geniv Config Creator";
$naz[1]="Rodinný dùm";
$naz[2]="Pøíslušenství k zahradì";
$naz[3]="Poldi Hüte";
$naz[4]="Kaplièka - B";
$naz[5]="Kaplièka - A";
$naz[6]="Informaèní Tabule IDS JMK";
$naz[7]="Informaèní Tabule IDS JMK";
$naz[8]="Chladící box na nápoje";
$naz[9]="Stavìdlo Holoubkov";
$naz[10]="Garáž - B";
$naz[11]="Garáž - A";
$naz[12]="Elektrické skøínì";
$naz[13]="Automat na lístky";
$naz[14]="Rudá hvìzda";
$naz[15]="Hasièská stanice";
$naz[16]="Øada reálných garáží";
$naz[17]="Sada pøedloh";
$naz[18]="Stanièník";
$naz[19]="Lampa";
$naz[20]="Lamelový billboard";
$naz[21]="Moravský Krumlov";
//Popis - Základní
$pop[0]="- Pomocník pøi tvorbì configu";
$pop[1]="- Stavìno podle vzoru";
$pop[2]="- Sada obsahuje doplòky k zahradì";
$pop[3]="- Billboard";
$pop[4]="- Umístnìní: Nová Cerekev";
$pop[5]="- Umístnìní: Nová Cerekev";
$pop[6]="- Reskin";
$pop[7]="- Doplnìk na nádraží";
$pop[8]="- Doplnìk na nádraží";
$pop[9]="- Obsahuje noèní mód";
$pop[10]="- Stavìno podle vzoru";
$pop[11]="- Stavìno podle vzoru";
$pop[12]="- Umístnìní: Jakékoliv obytné zóny";
$pop[13]="- Doplnìk pro zastávky";
$pop[14]="- Doplnìk pro rùzné továrny";
$pop[15]="- Postaveno pro JediTrainz Team";
$pop[16]="- Umístnìní: Bøeclav";
$pop[17]="- Pøedloha pro stavitele map";
$pop[18]="- Bývalé znaèení \"kilometrovník\"";
$pop[19]="- Nachází se v Moravském Krumlovì";
$pop[20]="- Postupnì otáèející se billboard";
$pop[21]="- Model je stavìn podle skuteèné stanice";
//Popis - První
$pz1[0]="- Možnosti konfigurace:";
$pz1[1]="- Obsahuje noèní mód";
$pz1[2]="- 21 modelù";
$pz1[3]="- Na žádost";
$pz1[4]="- Oøezané detaily pùvodního modelu";
$pz1[5]="- Detailnìjší model";
$pz1[6]="- Doplnìk na nádraží";
$pz1[7]="";
$pz1[8]="";
$pz1[9]="- Obohaceno o kouøový efekt";
$pz1[10]="";
$pz1[11]="";
$pz1[12]="";
$pz1[13]="- Obsahuje noèní mód";
$pz1[14]="- Na žádost";
$pz1[15]="- Umístnìní: Nová Cerekev";
$pz1[16]="";
$pz1[17]="- <a href='http://trainz.jedisoft.cz/remotefile.php?IdFrag=1160' target='_blank'>Návod</a> (z Trainz.cz)";
$pz1[18]="- Na desetinná místa";
$pz1[19]="- Obsahuje noèní mód";
$pz1[20]="- V balíèku jsou dvì verze";
$pz1[21]="- 3 pøepisovatelné cedule";
//Popis - Druhý
$pz2[0]="- Základní funkce configu";
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
$pz2[19]="- Na žádost";
$pz2[20]="- Postaveno pro JediTrainz Team";
$pz2[21]="- s noèním módem";
//Popis - Tøetí
$pz3[0]="- Night mód";
$pz3[1]="";
$pz3[2]="";
$pz3[3]="";
$pz3[4]="";
$pz3[5]="";
$pz3[6]="";
$pz3[7]="";
$pz3[8]="";
$pz3[9]="- Seznam oprav je vypsán v CDP";
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
//Popis - Ètvrtý
$pz4[0]="- Kouøový efekt";
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
$pz4[21]="- Aktualizace je popsána v CDP";
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
$vel[9]="277 kB";
$vel[10]="51,9 kB";
$vel[11]="48 kB";
$vel[12]="122 kB";
$vel[13]="165 kB";
$vel[14]="106 kB";
$vel[15]="406 kB";
$vel[16]="318 kB";
$vel[17]="1,24 MB";
$vel[18]="192 kB";
$vel[19]="68,4 kB";
$vel[20]="1,94 MB";
$vel[21]="585 kB";
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
//Vykreslování tabulky, po spátku
for($p1=count($obr)-1;$p1<>-1;$p1--)
{//generuje podle poètu obrázku,dìlá dokud néni -1,odeèítá  
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
<td align=right><u>Název</u>:</td>
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
if(!Empty($down))//rozlišení stáhnutí!!
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
}//end if        naète scroll, cesta           ukládá scroll
echo "<body onload=\"nascr();".$sta."\" onUnload=\"ulscr();\"></body>";
//--------------poèítání-------------------------------------------------
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
if($REMOTE_ADDR==$dataip[$ri])  //ovìøuje IP
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

$ckds="Byl stažen soubor: <b>$uzvsta</b> uživatelem: <b>$kdo</b> z IP: $REMOTE_ADDR v ".Date("H:i:s j.m. Y")."<br>\n";
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
