<?
$zobr=false;
//vlo�eno na str�nky !!!cestina-cichnova.ic.cz!!!
//window.showModalDialog();
//-----------------na�ten� hesel a jmen-----------------------
$sb_hes="hesl_oiaeruhviusjdoijoij�aawpoeuofljylvnsbbvvutzfqwetzvc.php";             
$u=fopen($sb_hes,"r");
$pristup=explode("***",fread($u,1000));
fclose($u);

$tridazd=$pristup[8];
$heszd=$pristup[9];

$zadvtrid=$pristup[10];
$zadvhes=$pristup[11];

$vpo="";

if(!Empty($tri) and !Empty($roc) and !Empty($hes))
{
$trida=$tri.$roc;  
if(($trida==$tridazd and $hes==$heszd)or($trida==$zadvtrid and $hes==$zadvhes)){$zobr=true;}
} //end if empty

if($zobr==true)  //p�i spln�n� podm�nky
{
//-------------------------- na��t�n� koment��e
$sob_NPZ2="kom_NPZ2_jsjnjnasoiunvuzbtqpewoirjfhsncajnsdjncvmsjivhn.php";
$uk=fopen($sob_NPZ2,"r");
$kot1=explode("-*-",fread($uk,100000));
fclose($uk);

$sob_M3="kom_M3_jsjnjnaasrfgvsgnjm,hghjsfgcajnsdjncvmsjivhn.php";
$uk=fopen($sob_M3,"r");
$kot2=explode("-*-",fread($uk,100000));
fclose($uk);

$sob_PS2B="kom_PS2B_dofvhpoakjf�kbjifgsjqpfogjdjfnbidfbsfsdfn.php";
$uk=fopen($sob_PS2B,"r");
$kot3=explode("-*-",fread($uk,100000));
fclose($uk);

$sob_ME2B="kom_ME2B_pkdfgboinoisdvqpfjvjkfnsdokmcsdcfvvcsn.php";
$uk=fopen($sob_ME2B,"r");
$kot4=explode("-*-",fread($uk,100000));
fclose($uk);

//---------------n�zev t��dy-----------------
// na�ten� pole t��d
$s_tr="tridy_dsicjqpjochsdiuhjqwidozeurizdvbnjirefufugrv.php";
$uk=fopen($s_tr,"r");
$trid=explode("-&-",fread($uk,1000));
fclose($uk);

//-------------------konstanty n�zv�--------------------------
$sona="naz_npz2_cdohaochauhcuiadhoiqdqwpdojcokhaigjdksfsiudsfg.php";
$uk=fopen($sona,"r");
$nat1=explode("*--*",fread($uk,10000));
fclose($uk);

$sona="naz_m3_cdfknvoalskclskdcsdvbggdojcokhaigjdksfsiudsfg.php";
$uk=fopen($sona,"r");
$nat2=explode("*--*",fread($uk,10000));
fclose($uk);

$sona="naz_ps2b_jsdhnvonsdiohnvadetboiujweffsdvoijsvbasfsiudsfg.php";
$uk=fopen($sona,"r");
$nat3=explode("*--*",fread($uk,10000));
fclose($uk);

$sona="naz_me2b_lsfvdfkvopksdfop�kefokeopbjigdkjqwfpokrjfviudsfg.php";
$uk=fopen($sona,"r");
$nat4=explode("*--*",fread($uk,10000));
fclose($uk);

//----------------volba---------------------------
if(!Empty($volba))
{
$vs_poz_so="vstupni_po_zn_amka.php";

if($volba=="ot_vspo")
{
$ediovan1="(otev�eno)";
$uk=fopen($vs_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}//end if otev�i

if($volba=="ul_vspo" and !$pm_text=="")
{
$ediovan1="(ulo�eno)";
$uk=fopen($vs_poz_so,"w");
fwrite($uk,$pm_text);
$uk=fopen($vs_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}
else
{
if($volba=="ul_vspo" and $pm_text==""){$vpo="";}
}//end if ulo�

$NPZ2_poz_so="NPZ2_po_zn_amka.php";

if($volba=="ot_poNPZ2")
{
$ediovan2="(otev�eno)";
$uk=fopen($NPZ2_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}//end otev��

if($volba=="ul_poNPZ2" and !$pm_text=="")
{
$ediovan2="(ulo�eno)";
$uk=fopen($NPZ2_poz_so,"w");
fwrite($uk,$pm_text);
$uk=fopen($NPZ2_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}
else
{
if($volba=="ul_poNPZ2" and $pm_text==""){$vpo="";}
}//end ulo�

$M3_poz_so="M3_po_zn_amka.php";
if($volba=="ot_poM3")
{
$ediovan3="(otev�eno)";
$uk=fopen($M3_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}//end otev��

if($volba=="ul_poM3" and !$pm_text=="")
{
$ediovan3="(ulo�eno)";
$uk=fopen($M3_poz_so,"w");
fwrite($uk,$pm_text);
$uk=fopen($M3_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}
else
{
if($volba=="ul_poM3" and $pm_text==""){$vpo="";}
}//end ulo�

$PS2B_poz_so="PS2B_po_zn_amka.php";
if($volba=="ot_poPS2B")
{
$ediovan4="(otev�eno)";
$uk=fopen($PS2B_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}//end otev��

if($volba=="ul_poPS2B" and !$pm_text=="")
{
$ediovan4="(ulo�eno)";
$uk=fopen($PS2B_poz_so,"w");
fwrite($uk,$pm_text);
$uk=fopen($PS2B_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}
else
{
if($volba=="ul_poPS2B" and $pm_text==""){$vpo="";}
}//end ulo�

$ME2B_poz_so="ME2B_po_zn_amka.php";
if($volba=="ot_poME2B")
{
$ediovan5="(otev�eno)";
$uk=fopen($ME2B_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}//end otev��

if($volba=="ul_poME2B" and !$pm_text=="")
{
$ediovan5="(ulo�eno)";
$uk=fopen($ME2B_poz_so,"w");
fwrite($uk,$pm_text);
$uk=fopen($ME2B_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);
}
else
{
if($volba=="ul_poME2B" and $pm_text==""){$vpo="";}
}//end ulo�

$vzk_s="vzk_alkcnjsdnbjcwnsbdviuwnuiec.php";
if($volba=="ot_vzk")
{
$ediovan6="(otev�eno)";
$uk=fopen($vzk_s,"r");
$vpo=fread($uk,50000);
fclose($uk);
}//end otev��

if($volba=="ul_vzk" and !$pm_text=="")
{
$ediovan6="(ulo�eno)";
$uk=fopen($vzk_s,"w");
fwrite($uk,$pm_text);
$uk=fopen($vzk_s,"r");
$vpo=fread($uk,50000);
fclose($uk);
}
else
{
if($volba=="ul_vzk" and $pm_text==""){$vpo="";}
}//end ulo�

$poz_s="poznamky_wahnxueibfuebafiqdwpouoihadoihaafcw.php";
if($volba=="ot_pozn")
{
$ediovan8="(otev�eno)";
$uk=fopen($poz_s,"r");
$vpo=fread($uk,50000);
fclose($uk);
}//end otev��

if($volba=="ul_pozn" and !$pm_text=="")
{
$ediovan8="(ulo�eno)";
$uk=fopen($poz_s,"w");
fwrite($uk,$pm_text);
$uk=fopen($poz_s,"r");
$vpo=fread($uk,50000);
fclose($uk);
}
else
{
if($volba=="ul_pozn" and $pm_text==""){$vpo="";}
}//end ulo�

if($volba="uloz_kom")
{
$ediovan7="(ulo�eno)";
//n�stavba
$kot1[0]=$ptex00;
$kot1[1]=$ptex01;
$kot1[2]=$ptex02;
$kot1[3]=$ptex03;
$kot1[4]=$ptex04;
$kot1[5]=$ptex05;
$kot1[6]=$ptex06;
$kot1[7]=$ptex07;
$kot1[8]=$ptex08;
$kot1[9]=$ptex09;
$kot1[10]=$ptex010;
$kot1[11]=$ptex011;
$kot1[12]=$ptex012;
$kot1[13]=$ptex013;
$kot1[14]=$ptex014;
$kot1[15]=$ptex015;
$kot1[16]=$ptex016;
$kot1[17]=$ptex017;
$kot1[18]=$ptex018;
$kot1[19]=$ptex019;
$kot1[20]=$ptex020;
$kot1[21]=$ptex021;
$kot1[22]=$ptex022;
$kot1[23]=$ptex023;
$kot1[24]=$ptex024;
$kot1[25]=$ptex025;
$kot1[26]=$ptex026;
$kot1[27]=$ptex027;
$kot1[28]=$ptex028;
$kot1[29]=$ptex029;
$kot1[30]=$ptex030;
$kot1[31]=$ptex031;
$kot1[32]=$ptex032;
//$kot1[33]=$ptex033;
//norm�l
$kot2[0]=$ptex10;
$kot2[1]=$ptex11;
$kot2[2]=$ptex12;
$kot2[3]=$ptex13;
$kot2[4]=$ptex14;
$kot2[5]=$ptex15;
$kot2[6]=$ptex16;
$kot2[7]=$ptex17;
$kot2[8]=$ptex18;
$kot2[9]=$ptex19;
$kot2[10]=$ptex110;
$kot2[11]=$ptex111;
$kot2[12]=$ptex112;
$kot2[13]=$ptex113;
$kot2[14]=$ptex114;
$kot2[15]=$ptex115;
$kot2[16]=$ptex116;
$kot2[17]=$ptex117;
$kot2[18]=$ptex118;
$kot2[19]=$ptex119;
$kot2[20]=$ptex120;
$kot2[21]=$ptex121;
$kot2[22]=$ptex122;
$kot2[23]=$ptex123;
$kot2[24]=$ptex124;
$kot2[25]=$ptex125;
$kot2[26]=$ptex126;
$kot2[27]=$ptex127;
$kot2[28]=$ptex128;
$kot2[29]=$ptex129;
//$kot2[30]=$ptex130;

$kot3[0]=$ptex20;
$kot3[1]=$ptex21;
$kot3[2]=$ptex22;
$kot3[3]=$ptex23;
$kot3[4]=$ptex24;
$kot3[5]=$ptex25;
$kot3[6]=$ptex26;
$kot3[7]=$ptex27;
$kot3[8]=$ptex28;
$kot3[9]=$ptex29;
$kot3[10]=$ptex210;
$kot3[11]=$ptex211;
$kot3[12]=$ptex212;
$kot3[13]=$ptex213;
$kot3[14]=$ptex214;
$kot3[15]=$ptex215;
$kot3[16]=$ptex216;
$kot3[17]=$ptex217;
$kot3[18]=$ptex218;
$kot3[19]=$ptex219;
$kot3[20]=$ptex220;
$kot3[21]=$ptex221;
$kot3[22]=$ptex222;
$kot3[23]=$ptex223;
$kot3[24]=$ptex224;
$kot3[25]=$ptex225;
$kot3[26]=$ptex226;
$kot3[27]=$ptex227;
$kot3[28]=$ptex228;
$kot3[29]=$ptex229;

$kot4[0]=$ptex30;
$kot4[1]=$ptex31;
$kot4[2]=$ptex32;
$kot4[3]=$ptex33;
$kot4[4]=$ptex34;
$kot4[5]=$ptex35;
$kot4[6]=$ptex36;
$kot4[7]=$ptex37;
$kot4[8]=$ptex38;
$kot4[9]=$ptex39;
$kot4[10]=$ptex310;
$kot4[11]=$ptex311;
$kot4[12]=$ptex312;
$kot4[13]=$ptex313;
$kot4[14]=$ptex314;
$kot4[15]=$ptex315;
$kot4[16]=$ptex316;
$kot4[17]=$ptex317;
$kot4[18]=$ptex318;
$kot4[19]=$ptex319;
$kot4[20]=$ptex320;
$kot4[21]=$ptex321;
$kot4[22]=$ptex322;
$kot4[23]=$ptex323;
$kot4[24]=$ptex324;
$kot4[25]=$ptex325;
$kot4[26]=$ptex326;
$kot4[27]=$ptex327;
$kot4[28]=$ptex328;
$kot4[29]=$ptex329;

// ulo�en� pole koment��u
$sob_NPZ2="kom_NPZ2_jsjnjnasoiunvuzbtqpewoirjfhsncajnsdjncvmsjivhn.php";
$uk=fopen($sob_NPZ2,"w");
fwrite($uk,implode($kot1,"-*-"));
fclose($uk);

$sob_M3="kom_M3_jsjnjnaasrfgvsgnjm,hghjsfgcajnsdjncvmsjivhn.php";
$uk=fopen($sob_M3,"w");
fwrite($uk,implode($kot2,"-*-"));
fclose($uk);

$sob_PS2B="kom_PS2B_dofvhpoakjf�kbjifgsjqpfogjdjfnbidfbsfsdfn.php";
$uk=fopen($sob_PS2B,"w");
fwrite($uk,implode($kot3,"-*-"));
fclose($uk);

$sob_ME2B="kom_ME2B_pkdfgboinoisdvqpfjvjkfnsdokmcsdcfvvcsn.php";
$uk=fopen($sob_ME2B,"w");
fwrite($uk,implode($kot4,"-*-"));
fclose($uk);

$trid[0]=$trida1;
$trid[1]=$trida2;
$trid[2]=$trida3;
$trid[3]=$trida4;

// ulo�en� pole t��dy
$s_tr="tridy_dsicjqpjochsdiuhjqwidozeurizdvbnjirefufugrv.php";
$uk=fopen($s_tr,"w");
fwrite($uk,implode($trid,"-&-"));
fclose($uk);

$pristup[0]=$pj1;
$pristup[1]=$ph1;
$pristup[2]=$pj2;
$pristup[3]=$ph2;
$pristup[4]=$pj3;
$pristup[5]=$ph3;
$pristup[6]=$pj4;
$pristup[7]=$ph4;
$pristup[8]=$pj5;
$pristup[9]=$ph5;

// ulo�en� hesel
$sb_hes="hesl_oiaeruhviusjdoijoij�aawpoeuofljylvnsbbvvutzfqwetzvc.php";             
$u=fopen($sb_hes,"w");
fwrite($u,implode($pristup,"***"));
fclose($u);


}//end ulo�
//<---- aplikovat do v�eho!!!! kde je zapot�eb�!!!

//je�t� jak� si eqivalent n�v�t�vn� knihy (od ��ku pro u�itelku)
//pozn�mky je�t� pro jednotliv� t��dy
}
else
{
$vpo="";
}//end if empty volba

if(Empty($ediovan1)){$ediovan1="";}
if(Empty($ediovan2)){$ediovan2="";}
if(Empty($ediovan3)){$ediovan3="";}
if(Empty($ediovan4)){$ediovan4="";}
if(Empty($ediovan5)){$ediovan5="";}
if(Empty($ediovan6)){$ediovan6="";}
if(Empty($ediovan7)){$ediovan7="";}
if(Empty($ediovan8)){$ediovan8="";}

//---------------------------konec prov�d�c� ��sti, konstanty!

//------------------konstanty cest----------------------------------
$sona="ces_npz2_doischiuqdpoiwejfkaaqopsokddovhhuevwrugvev.php";
$uk=fopen($sona,"r");
$cet1=explode("*--*",fread($uk,10000));
fclose($uk);

$sona="ces_m3_eflkshjqqpeolvjdaqopsokddovhhuevwrugvev.php";
$uk=fopen($sona,"r");
$cet2=explode("*--*",fread($uk,10000));
fclose($uk);

$sona="ces_ps2b_eflkshjqqpeolvjdaqopsokddovhhuevwrugvev.php";
$uk=fopen($sona,"r");
$cet3=explode("*--*",fread($uk,10000));
fclose($uk);

$sona="ces_me2b_dflkjhnvisunfcweofcqwpfojvsfnbvedfvev.php";
$uk=fopen($sona,"r");
$cet4=explode("*--*",fread($uk,10000));
fclose($uk);

//--------------------------------------------------
$pop="Ulo�...";
//---------gener�tor z�kazu-----------------------
for($p1=0;$p1<count($nat1);$p1++)
{
if($kot1[$p1]=="nestahovat")
{$zat1[$p1]="disabled";}
else
{$zat1[$p1]="";} 
}//end for

for($p1=0;$p1<count($nat2);$p1++)
{
if($kot2[$p1]=="nestahovat")
{$zat2[$p1]="disabled";}
else
{$zat2[$p1]="";} 
}//end for

for($p1=0;$p1<count($nat3);$p1++)
{
if($kot3[$p1]=="nestahovat")
{$zat3[$p1]="disabled";}
else
{$zat3[$p1]="";} 
}//end for

for($p1=0;$p1<count($nat4);$p1++)
{
if($kot4[$p1]=="nestahovat")
{$zat4[$p1]="disabled";}
else
{$zat4[$p1]="";} 
}//end for

echo
"
<h1 align=center><u>Administr�torsk� str�nka</u></h1>
<form method=post name=fo>

<table border=0 align=center>
<tr>
<th colspan=3>".$trid[0]."</th>
</tr>
<tr>
<th>N�zev:</th>
<th>Koment�� pro ��ky & cesta k souboru:</th>
</tr>
";//gener�tor admin sekce t��dy 1
for($p1=0;$p1<count($nat1);$p1++)
{
echo
"<tr>
<td>".$nat1[$p1]."</td>
<td><input type=text name=te0$p1 value=\"".$kot1[$p1]."\">&nbsp;<input type=button value=\"Pr�zdn� pole\" onclick=\"fo.te0$p1.value='&nbsp;';\">&nbsp;<input type=button value=\"Zak�zat ulo�en�\" onclick=\"fo.te0$p1.value='nestahovat';\">&nbsp;<input type=text name=ce0$p1 value=\"".$cet1[$p1]."\"></td>
</tr>
";
}
echo "
</table>
<hr>

<table border=0 align=center>
<tr>
<th colspan=3>".$trid[1]."</th>
</tr>
<tr>
<th>N�zev:</th>
<th>Koment�� pro ��ky & cesta k souboru:</th>
</tr>
";//gener�tor admin sekce t��dy 2
for($p1=0;$p1<count($nat2);$p1++)
{
echo
"<tr>
<td>".$nat2[$p1]."</td>
<td><input type=text name=te1$p1 value=\"".$kot2[$p1]."\">&nbsp;<input type=button value=\"Pr�zdn� pole\" onclick=\"fo.te1$p1.value='&nbsp;';\">&nbsp;<input type=button value=\"Zak�zat ulo�en�\" onclick=\"fo.te1$p1.value='nestahovat';\">&nbsp;<input type=text name=ce1$p1 value=\"".$cet2[$p1]."\"></td>
</tr>
";
}
echo "
</table>
<hr>

<table border=0 align=center>
<tr>
<th colspan=3>".$trid[2]."</th>
</tr>
<tr>
<th>N�zev:</th>
<th>Koment�� pro ��ky & cesta k souboru:</th>
</tr>
";//gener�tor admin sekce t��dy 3
for($p1=0;$p1<count($nat3);$p1++)
{
echo
"<tr>
<td>".$nat3[$p1]."</td>
<td><input type=text name=te2$p1 value=\"".$kot3[$p1]."\">&nbsp;<input type=button value=\"Pr�zdn� pole\" onclick=\"fo.te2$p1.value='&nbsp;';\">&nbsp;<input type=button value=\"Zak�zat ulo�en�\" onclick=\"fo.te2$p1.value='nestahovat';\">&nbsp;<input type=text name=ce2$p1 value=\"".$cet3[$p1]."\"></td>
</tr>
";
}
echo "
</table>
<hr>

<table border=0 align=center>
<tr>
<th colspan=3>".$trid[3]."</th>
</tr>
<tr>
<th>N�zev:</th>
<th>Koment�� pro ��ky & cesta k souboru:</th>
</tr>
";//gener�tor admin sekce t��dy 4
for($p1=0;$p1<count($nat4);$p1++)
{
echo
"<tr>
<td>".$nat4[$p1]."</td>
<td><input type=text name=te3$p1 value=\"".$kot4[$p1]."\">&nbsp;<input type=button value=\"Pr�zdn� pole\" onclick=\"fo.te3$p1.value='&nbsp;';\">&nbsp;<input type=button value=\"Zak�zat ulo�en�\" onclick=\"fo.te3$p1.value='nestahovat';\">&nbsp;<input type=text name=ce3$p1 value=\"".$cet4[$p1]."\"></td>
</tr>
";
}
echo "
</table>
<hr>

<input type=hidden name=tri value=\"$tri\">
<input type=hidden name=roc value=\"$roc\">
<input type=hidden name=hes value=\"$hes\">
<input type=hidden name=volba>
<input type=hidden name=pm_text>
";//gener�tor hiden pro t��du 1
for($p1=0;$p1<count($nat1);$p1++)
{
echo
"<input type=hidden name=ptex0$p1 value=\"".$kot1[$p1]."\">
";
}
//gener�tor hiden� pro t��du 2
for($p1=0;$p1<count($nat2);$p1++)
{
echo
"<input type=hidden name=ptex1$p1 value=\"".$kot2[$p1]."\">
";
}
//gener�tor hiden� pro t��du 3
for($p1=0;$p1<count($nat3);$p1++)
{
echo
"<input type=hidden name=ptex2$p1 value=\"".$kot3[$p1]."\">
";
}
//gener�tor hiden� pro t��du 4
for($p1=0;$p1<count($nat4);$p1++)
{
echo
"<input type=hidden name=ptex3$p1 value=\"".$kot4[$p1]."\">
";
}
echo "
<input type=hidden name=trida1 value=\"".$trid[0]."\">
<input type=hidden name=trida2 value=\"".$trid[1]."\">
<input type=hidden name=trida3 value=\"".$trid[2]."\">
<input type=hidden name=trida4 value=\"".$trid[3]."\">

<input type=hidden name=pj1 value=\"".$pristup[0]."\">
<input type=hidden name=pj2 value=\"".$pristup[2]."\">
<input type=hidden name=pj3 value=\"".$pristup[4]."\">
<input type=hidden name=pj4 value=\"".$pristup[6]."\">
<input type=hidden name=pj5 value=\"".$pristup[8]."\">

<input type=hidden name=ph1 value=\"".$pristup[1]."\">
<input type=hidden name=ph2 value=\"".$pristup[3]."\">
<input type=hidden name=ph3 value=\"".$pristup[5]."\">
<input type=hidden name=ph4 value=\"".$pristup[7]."\">
<input type=hidden name=ph5 value=\"".$pristup[9]."\">

N�hled pro t��du: <b>".$trid[0]."</b><br>

<table border=0 align=center>
<tr>
<th>N�zev</th>
<th>Ulo�te si</th>
<th>Koment��</th>
</tr>
";//gener�tor n�hledu t��dy 1
for($p1=0;$p1<count($nat1);$p1++)
{
echo 
"<tr>
<td>".$nat1[$p1]."</td>
<th><input type=button value=\"$pop\" ".$zat1[$p1]." onclick=\"location.href='".$cet1[$p1]."';\"></th>
<th>".$kot1[$p1]."</th>
</tr>
";
}
echo "
</table>
<hr>

N�hled pro t��du: <b>".$trid[1]."</b><br>

<table border=0 align=center>
<tr>
<th>N�zev</th>
<th>Ulo�te si</th>
<th>Koment��</th>
</tr>
";//gener�tor n�hledu t��dy 2
for($p1=0;$p1<count($nat2);$p1++)
{
echo 
"<tr>
<td>".$nat2[$p1]."</td>
<th><input type=button value=\"$pop\" ".$zat2[$p1]." onclick=\"location.href='".$cet2[$p1]."';\"></th>
<th>".$kot2[$p1]."</th>
</tr>
";
}
echo "
</table>
<hr>

N�hled pro t��du: <b>".$trid[2]."</b><br>

<table border=0 align=center>
<tr>
<th>N�zev</th>
<th>Ulo�te si</th>
<th>Koment��</th>
</tr>
";//gener�tor n�hledu t��dy 3
for($p1=0;$p1<count($nat3);$p1++)
{
echo 
"<tr>
<td>".$nat3[$p1]."</td>
<th><input type=button value=\"$pop\" ".$zat3[$p1]." onclick=\"location.href='".$cet3[$p1]."';\"></th>
<th>".$kot3[$p1]."</th>
</tr>
";
}
echo "
</table>
<hr>

N�hled pro t��du: <b>".$trid[3]."</b><br>

<table border=0 align=center>
<tr>
<th>N�zev</th>
<th>Ulo�te si</th>
<th>Koment��</th>
</tr>
";//gener�tor n�hledu t��dy 2
for($p1=0;$p1<count($nat4);$p1++)
{
echo 
"<tr>
<td>".$nat4[$p1]."</td>
<th><input type=button value=\"$pop\" ".$zat4[$p1]." onclick=\"location.href='".$cet4[$p1]."';\"></th>
<th>".$kot4[$p1]."</th>
</tr>
";
}
echo "
</table>
<hr>

<table border=0 align=center>
<tr>
<th colspan=2>Editace n�zvu t��dy</th>
</tr>
<tr>
<th>��slo:</th>
<th>n�zev:</th>
</tr>
";//gener�tor editace t��dy
for($p1=0;$p1<4;$p1++)
{
$pp1=$p1+1;
echo
"
<tr>
<th>$pp1.</th>
<td><input type=text size=8 name=trd$pp1 value=\"".$trid[$p1]."\" title=\"".$trid[$p1]."\"></td>
</tr>";
}

echo "
</table>
<hr>

<table border=0 align=center cellspacing=10 cellpadding=0>
<tr>
<th colspan=2>Editace p�ihla�ov�n�</th>
</tr>
<tr>
<th>��slo</th>
<th>t��da & ro�n�k</th>
<th>heslo</th>
</tr>
<tr>
<th>1.</th>
<th><input type=text size=8 name=jm1 value=\"".$pristup[0]."\"></th>
<td><input type=text size=8 name=he1 value=\"".$pristup[1]."\"></td>
</tr>
<tr>
<th>2.</th>
<th><input type=text size=8 name=jm2 value=\"".$pristup[2]."\"></th>
<td><input type=text size=8 name=he2 value=\"".$pristup[3]."\"></td>
</tr>
<tr>
<th>3.</th>
<th><input type=text size=8 name=jm3 value=\"".$pristup[4]."\"></th>
<td><input type=text size=8 name=he3 value=\"".$pristup[5]."\"></td>
</tr>
<tr>
<th>4.</th>
<th><input type=text size=8 name=jm4 value=\"".$pristup[6]."\"></th>
<td><input type=text size=8 name=he4 value=\"".$pristup[7]."\"></td>
</tr>
<tr>
<th>&nbsp;</th>
<th><input type=text size=8 name=jm5 value=\"".$pristup[8]."\"></th>
<td><input type=text size=8 name=he5 value=\"".$pristup[9]."\"></td>
</tr>
</table>

<hr>

<center>
<input type=submit value=\"Ulo�it koment��e & n�zvy t��d & jmena + hesla\" onclick=\"
fo.volba.value='uloz_kom';
";//gener�tor javascriptu pro t��du 1
for($p1=0;$p1<count($nat1);$p1++)
{
echo 
"fo.ptex0$p1.value=fo.te0$p1.value;
";
}
for($p1=0;$p1<count($nat2);$p1++)
{//gener�tor javascriptu pro t��du 2
echo 
"fo.ptex1$p1.value=fo.te1$p1.value;
";
}
for($p1=0;$p1<count($nat3);$p1++)
{//gener�tor javascriptu pro t��du 3
echo 
"fo.ptex2$p1.value=fo.te2$p1.value;
";
}
for($p1=0;$p1<count($nat4);$p1++)
{//gener�tor javascriptu pro t��du 4
echo 
"fo.ptex3$p1.value=fo.te3$p1.value;
";
}
echo 
"fo.trida1.value=fo.trd1.value;
fo.trida2.value=fo.trd2.value;
fo.trida3.value=fo.trd3.value;
fo.trida4.value=fo.trd4.value;
fo.pj1.value=fo.jm1.value;
fo.pj2.value=fo.jm2.value;
fo.pj3.value=fo.jm3.value;
fo.pj4.value=fo.jm4.value;
fo.pj5.value=fo.jm5.value;
fo.ph1.value=fo.he1.value;
fo.ph2.value=fo.he2.value;
fo.ph3.value=fo.he3.value;
fo.ph4.value=fo.he4.value;
fo.ph5.value=fo.he5.value;
\"> $ediovan7

<hr>
<textarea rows=15 cols=80 name=memb>$vpo</textarea><br><br>
<input type=submit value=\"Otev��t pozn�mku (P�i vstupu)\" onclick=\"fo.volba.value='ot_vspo';\"> $ediovan1
<input type=submit value=\"Ulo�it pozn�mku (P�i vstupu)\" onclick=\"fo.volba.value='ul_vspo';fo.pm_text.value=memb.innerText;\"><br><br>

<input type=submit value=\"Otev��t pozn�mku ve t��d� ".$trid[0]."\" onclick=\"fo.volba.value='ot_poNPZ2';\"> $ediovan2
<input type=submit value=\"Ulo�it pozn�mku ve t��d� ".$trid[0]."\" onclick=\"fo.volba.value='ul_poNPZ2';fo.pm_text.value=memb.innerText;\"><br><br>

<input type=submit value=\"Otev��t pozn�mku ve t��d� ".$trid[1]."\" onclick=\"fo.volba.value='ot_poM3';\"> $ediovan3
<input type=submit value=\"Ulo�it pozn�mku ve t��d� ".$trid[1]."\" onclick=\"fo.volba.value='ul_poM3';fo.pm_text.value=memb.innerText;\"><br><br>

<input type=submit value=\"Otev��t pozn�mku ve t��d� ".$trid[2]."\" onclick=\"fo.volba.value='ot_poPS2B';\"> $ediovan4
<input type=submit value=\"Ulo�it pozn�mku ve t��d� ".$trid[2]."\" onclick=\"fo.volba.value='ul_poPS2B';fo.pm_text.value=memb.innerText;\"><br><br>

<input type=submit value=\"Otev��t pozn�mku ve t��d� ".$trid[3]."\" onclick=\"fo.volba.value='ot_poME2B';\"> $ediovan5
<input type=submit value=\"Ulo�it pozn�mku ve t��d� ".$trid[3]."\" onclick=\"fo.volba.value='ul_poME2B';fo.pm_text.value=memb.innerText;\"><br><br>

<input type=submit value=\"Otev��t vzkazy\" onclick=\"fo.volba.value='ot_vzk';\"> $ediovan6
<input type=submit value=\"Ulo�it vzkazy\" onclick=\"fo.volba.value='ul_vzk';fo.pm_text.value=memb.innerText;\"><br><br>

<input type=submit value=\"Otev��t pozn�mku\" onclick=\"fo.volba.value='ot_pozn';\"> $ediovan8
<input type=submit value=\"Ulo�it pozn�mku\" onclick=\"fo.volba.value='ul_pozn';fo.pm_text.value=memb.innerText;\"><br><br>

<hr>
<input type=submit value=\"Smazat obsah\">
<hr>
</form>
<a href=\"ologovo_soboro.php\" target=\"_blank\">Kdo se kdy p�ihla�oval</a><br>
<a href=\"vstupni_po_zn_amka.php\" target=\"_blank\">Zobrazit vstupn� pozn�mky</a><br>
<a href=\"NPZ2_po_zn_amka.php\" target=\"_blank\">Zobrazit pozn�mky ve t��d� ".$trid[0]."</a><br>
<a href=\"M3_po_zn_amka.php\" target=\"_blank\">Zobrazit pozn�mky ve t��d� ".$trid[1]."</a><br>
<a href=\"PS2B_po_zn_amka.php\" target=\"_blank\">Zobrazit pozn�mky ve t��d� ".$trid[2]."</a><br>
<a href=\"ME2B_po_zn_amka.php\" target=\"_blank\">Zobrazit pozn�mky ve t��d� ".$trid[3]."</a><br>
<a href=\"vzkaz_icnuaibvjqpwofjvndksjvnajcnuiajniudjfadiufhn.php\" target=\"_blank\">--P�idat vzkazy--</a><br>
<a href=\"vzk_alkcnjsdnbjcwnsbdviuwnuiec.php\" target=\"_blank\">Zobrazit vzkazy</a><br>
<br>
</center>

<SCRIPT LANGUAGE=javascript src=\"cookies.js\"></SCRIPT>
<SCRIPT LANGUAGE=javascript>
function nascr()
{
y=ReadCookie(\"scrol_y\",0,24*365);
window.scrollTo(0,y);
}
function ulscr()
{
y=document.body ? document.body.scrollTop:pageYoffset;
WriteCookie(\"scrol_y\",y,24*365);
}
</SCRIPT>
<body onload=\"nascr();\" onUnload=\"ulscr();\"></body>
";
}
else
{
print "<br><br><br><br><br><h1 align=center>Nepovolen� p��stup</h1>";
}
?>
