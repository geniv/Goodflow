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
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
<tr>
<td align=center>Návody - Tutoriály na gmax a 3dsmax</td>
</tr>
</table>
<?
//Obrázek
$obr[0]="download_obr/Jak_zjistit_polygony_v_gmaxu_nebo_tacs.gif";
$obr[1]="download_obr/Navod_stavba_domu.gif";
$obr[2]="download_obr/Navod_mapovani_domu.gif";
$obr[3]="download_obr/Navod_config_k_domu.gif";
$obr[4]="download_obr/videonavod_jednocha_animace.gif";
//Název
$naz[0]="Jak zjistit polygony v gmaxu nebo tacs ?";
$naz[1]="Návod jak postavit jednoduchý dùm";
$naz[2]="Návod jak namapovat jednoduchý dùm";
$naz[3]="Návod jak napsat config pro jednoduchý dùm";
$naz[4]="Videonávod na jednoduchou animaci";
//Popis - Základní
$pop[0]="- Tento obrázek vám odpoví na tuhle otázku";
$pop[1]="- Návod je urèen pro úplné zaèáteèníky";
$pop[2]="- Podrobnì vysvìtleno jak namapovat dùm";
$pop[3]="- Vysvìtleny potøebné hodnoty v configu";
$pop[4]="- Vysvìtleno jak vytvoøit animaci";
//Popis - První
$pz1[0]="- Obrázková verze";
$pz1[1]="- Html verze";
$pz1[2]="- Obrázková verze";
$pz1[3]="- Pdf verze";
$pz1[4]="- Návod je pro zaèáteèníky";
//Popis - Druhý
$pz2[0]="";
$pz2[1]="";
$pz2[2]="";
$pz2[3]="";
$pz2[4]="- Po rozbalení archivu si pøeètìte \"èti mì.txt\"";
//Popis - Tøetí
$pz3[0]="";
$pz3[1]="";
$pz3[2]="";
$pz3[3]="";
$pz3[4]="";
//Popis - Ètvrtý
$pz4[0]="";
$pz4[1]="";
$pz4[2]="";
$pz4[3]="";
$pz4[4]="";
//Pro
$pro[0]="Gmax a Trainz asset creation studio";
$pro[1]="Gmax a Trainz asset creation studio";
$pro[2]="Trainz asset creation studio";
$pro[3]="Hotový 3D model";
$pro[4]="3D Studio Max (Gmax - Tacs)";
//Velikost
$vel[0]="91,2 kB";
$vel[1]="3,48 MB";
$vel[2]="2,04 MB";
$vel[3]="1,93 MB";
$vel[4]="1,98 MB";
//Download
$stos[0]="location.href='download_soubory/Jak_zjistit_polygony_v_gmaxu_nebo_tacs.rar';";
$stos[1]="location.href='download_soubory/Navod_stavba_domu.rar';";
$stos[2]="location.href='download_soubory/Navod_mapovani_domu.rar';";
$stos[3]="location.href='download_soubory/Navod_config_k_domu.rar';";
$stos[4]="location.href='download_soubory/videonavod_jednocha_animace.rar';";
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
<td align=left><INPUT type=image src=\"download_tlacitko.gif\" onclick=\"men.down.value='st$pp1';men.kam.value='navody';men.posl.click();\"></td>
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
y=ReadCookie("scroln_y",0,24*365);
window.scrollTo(0,y);
}
function ulscr()
{
y=document.body ? document.body.scrollTop:pageYoffset;
WriteCookie("scroln_y",y,24*365);
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
}// 
echo "<body onload=\"nascr();".$sta."\" onUnload=\"ulscr();\"></body>";

//----------------------------------------------------------------------
$s_nav="navody_poc_ujacaiohcaoishuhaqwfoijjiufhdiujhuifzgbzvrhzuburjnsdojhnshgvvv.php";
$ukz=fopen($s_nav,"r");
$dow=explode("*+*",fread($ukz,10000));
fclose($ukz);

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
//rozlišování souborù
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
$s_ldw="log_navody_ahsjhciazuhdqwfpojaodfuhiushviuhvriugsv.php";
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

$ukz=fopen($s_nav,"w");
fwrite($ukz,implode($dow,"*+*"));
fclose($ukz);
}
?>
