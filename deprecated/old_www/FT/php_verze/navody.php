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
<td align=center>N�vody - Tutori�ly na gmax a 3dsmax</td>
</tr>
</table>
<?
//Obr�zek
$obr[0]="download_obr/Jak_zjistit_polygony_v_gmaxu_nebo_tacs.gif";
$obr[1]="download_obr/Navod_stavba_domu.gif";
$obr[2]="download_obr/Navod_mapovani_domu.gif";
$obr[3]="download_obr/Navod_config_k_domu.gif";
$obr[4]="download_obr/videonavod_jednocha_animace.gif";
//N�zev
$naz[0]="Jak zjistit polygony v gmaxu nebo tacs ?";
$naz[1]="N�vod jak postavit jednoduch� d�m";
$naz[2]="N�vod jak namapovat jednoduch� d�m";
$naz[3]="N�vod jak napsat config pro jednoduch� d�m";
$naz[4]="Videon�vod na jednoduchou animaci";
//Popis - Z�kladn�
$pop[0]="- Tento obr�zek v�m odpov� na tuhle ot�zku";
$pop[1]="- N�vod je ur�en pro �pln� za��te�n�ky";
$pop[2]="- Podrobn� vysv�tleno jak namapovat d�m";
$pop[3]="- Vysv�tleny pot�ebn� hodnoty v configu";
$pop[4]="- Vysv�tleno jak vytvo�it animaci";
//Popis - Prvn�
$pz1[0]="- Obr�zkov� verze";
$pz1[1]="- Html verze";
$pz1[2]="- Obr�zkov� verze";
$pz1[3]="- Pdf verze";
$pz1[4]="- N�vod je pro za��te�n�ky";
//Popis - Druh�
$pz2[0]="";
$pz2[1]="";
$pz2[2]="";
$pz2[3]="";
$pz2[4]="- Po rozbalen� archivu si p�e�t�te \"�ti m�.txt\"";
//Popis - T�et�
$pz3[0]="";
$pz3[1]="";
$pz3[2]="";
$pz3[3]="";
$pz3[4]="";
//Popis - �tvrt�
$pz4[0]="";
$pz4[1]="";
$pz4[2]="";
$pz4[3]="";
$pz4[4]="";
//Pro
$pro[0]="Gmax a Trainz asset creation studio";
$pro[1]="Gmax a Trainz asset creation studio";
$pro[2]="Trainz asset creation studio";
$pro[3]="Hotov� 3D model";
$pro[4]="3D Studio Max (Gmax - Tacs)";
//Velikost
$vel[0]="91,2�kB";
$vel[1]="3,48�MB";
$vel[2]="2,04�MB";
$vel[3]="1,93�MB";
$vel[4]="1,98�MB";
//Download
$stos[0]="location.href='download_soubory/Jak_zjistit_polygony_v_gmaxu_nebo_tacs.rar';";
$stos[1]="location.href='download_soubory/Navod_stavba_domu.rar';";
$stos[2]="location.href='download_soubory/Navod_mapovani_domu.rar';";
$stos[3]="location.href='download_soubory/Navod_config_k_domu.rar';";
$stos[4]="location.href='download_soubory/videonavod_jednocha_animace.rar';";
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
if($REMOTE_ADDR==$dataip[$ri])  //ov��uje IP
{
$kdo=$dataip[$ri+1];
}//end if
}//end for
//rozli�ov�n� soubor�
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
