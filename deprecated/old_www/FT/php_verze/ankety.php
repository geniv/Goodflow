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

//-----------new styl-----------
$ha0=false;
$ha1=false;
$ha2=false;
$ha3=false;
$ha4=false;
$ha5=false;
$ha6=false;
$ha7=false;
$ha8=false;
$ha9=false;
$ha10=false;
$ha11=false;
$ha12=false;
$ha13=false;
$ha14=false;
$ha15=false;
$ha16=false;
$ha17=false;
$ha18=false;
$ha19=false;
$ha20=false;
if(!Empty($anke))
{
if($anke=="an11"){$ha0=true;$hlasovan="1.anketa 1.hlas";}
if($anke=="an12"){$ha1=true;$hlasovan="1.anketa 2.hlas";}
if($anke=="an13"){$ha2=true;$hlasovan="1.anketa 3.hlas";}
if($anke=="an21"){$ha3=true;$hlasovan="2.anketa 1.hlas";}
if($anke=="an22"){$ha4=true;$hlasovan="2.anketa 2.hlas";}
if($anke=="an23"){$ha5=true;$hlasovan="2.anketa 3.hlas";}
if($anke=="an31"){$ha6=true;$hlasovan="3.anketa 1.hlas";}
if($anke=="an32"){$ha7=true;$hlasovan="3.anketa 2.hlas";}
if($anke=="an33"){$ha8=true;$hlasovan="3.anketa 3.hlas";}
if($anke=="an34"){$ha9=true;$hlasovan="3.anketa 4.hlas";}
if($anke=="an41"){$ha10=true;$hlasovan="4.anketa 1.hlas";}
if($anke=="an42"){$ha11=true;$hlasovan="4.anketa 2.hlas";}
if($anke=="an51"){$ha12=true;$hlasovan="5.anketa 1.hlas";}
if($anke=="an52"){$ha13=true;$hlasovan="5.anketa 2.hlas";}
if($anke=="an61"){$ha14=true;$hlasovan="6.anketa 1.hlas";}
if($anke=="an62"){$ha15=true;$hlasovan="6.anketa 2.hlas";}
if($anke=="an63"){$ha16=true;$hlasovan="6.anketa 3.hlas";}
if($anke=="an64"){$ha17=true;$hlasovan="6.anketa 4.hlas";}
if($anke=="an71"){$ha18=true;$hlasovan="7.anketa 1.hlas";}
if($anke=="an72"){$ha19=true;$hlasovan="7.anketa 2.hlas";}
if($anke=="an73"){$ha20=true;$hlasovan="7.anketa 3.hlas";}
}
else
{
$ha0=false;
$ha1=false;
$ha2=false;
$ha3=false;
$ha4=false;
$ha5=false;
$ha6=false;
$ha7=false;
$ha8=false;
$ha9=false;
$ha10=false;
$ha11=false;
$ha12=false;
$ha13=false;
$ha14=false;
$ha15=false;
$ha16=false;
$ha17=false;
$ha18=false;
$ha19=false;
$ha20=false;
$hlasovan="";
}

$so_an="los_akn1_ccideiemcieaaacachnbiewufbjne.php";
$uk=fopen($so_an,"r");
$hls=explode("->",fread($uk,5000));//naètení z pole
fclose($uk);

//      rozhoduje negace!!
if($hls[0]!=$REMOTE_ADDR)
{
if($ha0==true and $kuk=="hld"){$hls[1]++;}
if($ha1==true and $kuk=="hld"){$hls[2]++;}
if($ha2==true and $kuk=="hld"){$hls[3]++;}
$vyhd="neblokován";
}
else
{
$vyhd="blokován";
}//end if

//      rozhoduje negace!!
if($hls[4]!=$REMOTE_ADDR)
{
if($ha3==true and $kuk=="hld1"){$hls[5]++;}
if($ha4==true and $kuk=="hld1"){$hls[6]++;}
if($ha5==true and $kuk=="hld1"){$hls[7]++;}
$vyhd="neblokován";
}
else
{
$vyhd="blokován";
}//end if

//      rozhoduje negace!!
if($hls[8]!=$REMOTE_ADDR)
{
if($ha6==true and $kuk=="hld2"){$hls[9]++;}
if($ha7==true and $kuk=="hld2"){$hls[10]++;}
if($ha8==true and $kuk=="hld2"){$hls[11]++;}
if($ha9==true and $kuk=="hld2"){$hls[12]++;}
$vyhd="neblokován";
}
else
{
$vyhd="blokován";
}//end if

//      rozhoduje negace!!
if($hls[13]!=$REMOTE_ADDR)
{
if($ha10==true and $kuk=="hld3"){$hls[14]++;}
if($ha11==true and $kuk=="hld3"){$hls[15]++;}
$vyhd="neblokován";
}
else
{
$vyhd="blokován";
}//end if

//      rozhoduje negace!!
if($hls[16]!=$REMOTE_ADDR)
{
if($ha12==true and $kuk=="hld4"){$hls[17]++;}
if($ha13==true and $kuk=="hld4"){$hls[18]++;}
$vyhd="neblokován";
}
else
{
$vyhd="blokován";
}//end if

//      rozhoduje negace!!
if($hls[19]!=$REMOTE_ADDR)
{
if($ha14==true and $kuk=="hld5"){$hls[20]++;}
if($ha15==true and $kuk=="hld5"){$hls[21]++;}
if($ha16==true and $kuk=="hld5"){$hls[22]++;}
if($ha17==true and $kuk=="hld5"){$hls[23]++;}
$vyhd="neblokován";
}
else
{
$vyhd="blokován";
}//end if

//      rozhoduje negace!!
if($hls[24]!=$REMOTE_ADDR)
{
if($ha18==true and $kuk=="hld6"){$hls[25]++;}
if($ha19==true and $kuk=="hld6"){$hls[26]++;}
if($ha20==true and $kuk=="hld6"){$hls[27]++;}
$vyhd="neblokován";
}
else
{
$vyhd="blokován";
}//end if

if($kuk=="hld")
{
$hls[0]=$REMOTE_ADDR;//hází aktuální ip
}//end if

if($kuk=="hld1")
{
$hls[4]=$REMOTE_ADDR;//hází aktuální ip
}//end if

if($kuk=="hld2")
{
$hls[8]=$REMOTE_ADDR;//hází aktuální ip
}//end if

if($kuk=="hld3")
{
$hls[13]=$REMOTE_ADDR;//hází aktuální ip
}//end if

if($kuk=="hld4")
{
$hls[16]=$REMOTE_ADDR;//hází aktuální ip
}//end if

if($kuk=="hld5")
{
$hls[19]=$REMOTE_ADDR;//hází aktuální ip
}//end if

if($kuk=="hld6")
{
$hls[24]=$REMOTE_ADDR;//hází aktuální ip
}//end if

$hlasovalo=0;
for($h=1;$h<=3;$h++)
{
$hlasovalo+=$hls[$h];
}

$hlasovalo1=0;
for($h=5;$h<=7;$h++)
{
$hlasovalo1+=$hls[$h];
}

$hlasovalo2=0;
for($h=9;$h<=12;$h++)
{
$hlasovalo2+=$hls[$h];
}

$hlasovalo3=0;
for($h=14;$h<=15;$h++)
{
$hlasovalo3+=$hls[$h];
}

$hlasovalo4=0;
for($h=17;$h<=18;$h++)
{
$hlasovalo4+=$hls[$h];
}

$hlasovalo5=0;
for($h=20;$h<=23;$h++)
{
$hlasovalo5+=$hls[$h];
}

$hlasovalo6=0;
for($h=25;$h<=27;$h++)
{
$hlasovalo6+=$hls[$h];
}

$uk=fopen($so_an,"w");
fwrite($uk,implode($hls,"->"));
fclose($uk);
//------------------------------------------------

$sb="ip_asiksdjhkyxjbiapdjhuipasfgiuadhubiphfduisfjivodjivnsdoifnvmjcbwpfhwauif.php";
$k=fopen($sb,"r");
$dataip=explode("*@*",fread($k,1000000));
fclose($k);

for($ri=1;$ri<count($dataip);$ri=$ri+2)
{
if($REMOTE_ADDR==$dataip[$ri])  //ovìøuje IP
{
$kdo=$dataip[$ri+1];
}//end if
}//end for
$lgzp="Hlasovalo ip: ".$REMOTE_ADDR." v: ".Date("H:i:s j.m. Y")." ,  klikl na : ".$hlasovan." viz: <b>".$kdo."</b> - ".$vyhd."<br>\n";
$logank="hlas_ank_KJSDHCiuahciuihaichsiulkdkjjcosejojijfofiz.php";
$uklg=fopen($logank,"a+");
fwrite($uklg,$lgzp);
fclose($uklg);

$oncl1="men.anke.value='an11';men.kuk.value='hld';men.kam.value='ankety';men.posl.click();";
$oncl2="men.anke.value='an12';men.kuk.value='hld';men.kam.value='ankety';men.posl.click();";
$oncl3="men.anke.value='an13';men.kuk.value='hld';men.kam.value='ankety';men.posl.click();";

$oncl4="men.anke.value='an21';men.kuk.value='hld1';men.kam.value='ankety';men.posl.click();";
$oncl5="men.anke.value='an22';men.kuk.value='hld1';men.kam.value='ankety';men.posl.click();";
$oncl6="men.anke.value='an23';men.kuk.value='hld1';men.kam.value='ankety';men.posl.click();";

$oncl7="men.anke.value='an31';men.kuk.value='hld2';men.kam.value='ankety';men.posl.click();";
$oncl8="men.anke.value='an32';men.kuk.value='hld2';men.kam.value='ankety';men.posl.click();";
$oncl9="men.anke.value='an33';men.kuk.value='hld2';men.kam.value='ankety';men.posl.click();";
$oncl10="men.anke.value='an34';men.kuk.value='hld2';men.kam.value='ankety';men.posl.click();";

$oncl11="men.anke.value='an41';men.kuk.value='hld3';men.kam.value='ankety';men.posl.click();";
$oncl12="men.anke.value='an42';men.kuk.value='hld3';men.kam.value='ankety';men.posl.click();";

$oncl13="men.anke.value='an51';men.kuk.value='hld4';men.kam.value='ankety';men.posl.click();";
$oncl14="men.anke.value='an52';men.kuk.value='hld4';men.kam.value='ankety';men.posl.click();";

$oncl15="men.anke.value='an61';men.kuk.value='hld5';men.kam.value='ankety';men.posl.click();";
$oncl16="men.anke.value='an62';men.kuk.value='hld5';men.kam.value='ankety';men.posl.click();";
$oncl17="men.anke.value='an63';men.kuk.value='hld5';men.kam.value='ankety';men.posl.click();";
$oncl18="men.anke.value='an64';men.kuk.value='hld5';men.kam.value='ankety';men.posl.click();";

$oncl19="men.anke.value='an71';men.kuk.value='hld6';men.kam.value='ankety';men.posl.click();";
$oncl20="men.anke.value='an72';men.kuk.value='hld6';men.kam.value='ankety';men.posl.click();";
$oncl21="men.anke.value='an73';men.kuk.value='hld6';men.kam.value='ankety';men.posl.click();";

echo 
"
<table align=center cellpadding=0 cellspacing=0 border=0>
 <tr>
  <td colspan=3 align=center>Ankety</td>
 </tr>
 <tr>
  <td colspan=3 align=center>&nbsp;</td>
 </tr>
 <tr>
  <td valign=top>
   <table border=1 cellspacing=1 cellpadding=1 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
    <tr>
     <td>
      <table cellpadding=0 cellspacing=0 border=0 width=180px>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Chcete tutoriály na<br>3D studio max a TACS ?</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl19;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">Ano</span></td>
        <td align=right id=vel_ank_a>".$hls[25]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl20;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">Ne</span></td>
        <td align=right id=vel_ank_a>".$hls[26]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl21;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">Je mi to úplnì jedno</span></td>
        <td align=right id=vel_ank_a>".$hls[27]."</td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a><hr color=black size=1></td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Celkem hlasovalo: $hlasovalo6</td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
  <td align=center>&nbsp;</td>
  <td valign=top>
   <table border=1 cellspacing=1 cellpadding=1 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
    <tr>
     <td>
      <table cellpadding=0 cellspacing=0 border=0 width=180px>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Chcete radìji tutoriály na<br>TACS nebo 3D Studio max ?</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl13;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">TACS (Gmax)</span></td>
        <td align=right id=vel_ank_a>".$hls[17]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl14;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">3D Studio max</span></td>
        <td align=right id=vel_ank_a>".$hls[18]."</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Celkem hlasovalo: $hlasovalo4</td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td colspan=3 align=center>&nbsp;</td>
 </tr>
 <tr>
  <td valign=top>
   <table border=1 cellspacing=1 cellpadding=1 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
    <tr>
     <td>
      <table cellpadding=0 cellspacing=0 border=0 width=180px>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Stavíte 3D modely v gmaxu nebo v 3D studiu max ?</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl1;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">V gmaxu</span></td>
        <td align=right id=vel_ank_a>".$hls[1]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl2;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">V 3D studiu max</span></td>
        <td align=right id=vel_ank_a>".$hls[2]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl3;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">Neumím ani v jednom</span></td>
        <td align=right id=vel_ank_a>".$hls[3]."</td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a><hr color=black size=1></td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Celkem hlasovalo: $hlasovalo</td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
  <td align=center>&nbsp;</td>
  <td valign=top>
   <table border=1 cellspacing=1 cellpadding=1 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
    <tr>
     <td>
      <table cellpadding=0 cellspacing=0 border=0 width=180px>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Jste fanoušek hry Trainz Railroad Simulator ?</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl4;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">Ano</span></td>
        <td align=right id=vel_ank_a>".$hls[5]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl5;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">Ne</span></td>
        <td align=right id=vel_ank_a>".$hls[6]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl6;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">Tuto hru neznám</span></td>
        <td align=right id=vel_ank_a>".$hls[7]."</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Celkem hlasovalo: $hlasovalo1</td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td colspan=3 align=center>&nbsp;</td>
 </tr>
 <tr>
  <td valign=top>
   <table border=1 cellspacing=1 cellpadding=1 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
    <tr>
     <td>
      <table cellpadding=0 cellspacing=0 border=0 width=180px>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>O kterém TRS si myslíte, <br>že je lepší ?</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl7;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">TRS 2004</span></td>
        <td align=right id=vel_ank_a>".$hls[9]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl8;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">TRS 2006</span></td>
        <td align=right id=vel_ank_a>".$hls[10]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl9;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">Obì dvì jsou stejné</span></td>
        <td align=right id=vel_ank_a>".$hls[11]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl10;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">Obì dvì by mìli být lepší</span></td>
        <td align=right id=vel_ank_a>".$hls[12]."</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Celkem hlasovalo: $hlasovalo2</td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
  <td align=center>&nbsp;</td>
  <td valign=top>
   <table border=1 cellspacing=1 cellpadding=1 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
    <tr>
     <td>
      <table cellpadding=0 cellspacing=0 border=0 width=180px>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>V jakém formátu souboru by jste chtìli tutoriály vydávat ?</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl15;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">v HTML</span></td>
        <td align=right id=vel_ank_a>".$hls[20]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl16;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">v PDF</span></td>
        <td align=right id=vel_ank_a>".$hls[21]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl17;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">v JPG</span></td>
        <td align=right id=vel_ank_a>".$hls[22]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl18;\" style=\"cursor:hand;\" onmouseover=\"style.color='white';style.textDecoration='underline';\" onmouseout=\"style.color='black';style.textDecoration='none';\">v HLP</span></td>
        <td align=right id=vel_ank_a>".$hls[23]."</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Celkem hlasovalo: $hlasovalo5</td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td colspan=3 align=center>&nbsp;</td>
 </tr>
 <tr>
  <td valign=top>
   <table border=1 cellspacing=1 cellpadding=1 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
    <tr>
     <td>
      <table cellpadding=0 cellspacing=0 border=0 width=180px>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Chtìli by jste otevírání obrázkù v novém oknì jak je ve videogalerii, nebo ve stejném oknì jak je v ostatních galeriích ?</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl11;\" style=\"cursor:hand;\" onmouseover=\"jho1.style.color='white';jho3.style.color='white';style.textDecoration='underline';\" onmouseout=\"jho1.style.color='black';jho3.style.color='black';style.textDecoration='none';\" id=jho1>V novém oknì</span></td>
        <td align=right id=vel_ank_a>".$hls[14]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl12;\" style=\"cursor:hand;\" onmouseover=\"jho2.style.color='white';jho4.style.color='white';style.textDecoration='underline';\" onmouseout=\"jho2.style.color='black';jho4.style.color='black';style.textDecoration='none';\"  id=jho2>Ve stejném oknì</span></td>
        <td align=right id=vel_ank_a>".$hls[15]."</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Stejná otázka pro webmastery: Použít window.open() nebo location.href ?</td>
       </tr>
       <tr>
        <td colspan=2 align=center><hr color=black size=1></td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl11;\" style=\"cursor:hand;\" onmouseover=\"jho1.style.color='white';jho3.style.color='white';style.textDecoration='underline';\" onmouseout=\"jho1.style.color='black';jho3.style.color='black';style.textDecoration='none';\" id=jho3>window.open()</span></td>
        <td align=right id=vel_ank_a>".$hls[14]."</td>
       </tr>
       <tr>
        <td align=left id=vel_ank_a><span onclick=\"$oncl12;\" style=\"cursor:hand;\" onmouseover=\"jho2.style.color='white';jho4.style.color='white';style.textDecoration='underline';\" onmouseout=\"jho2.style.color='black';jho4.style.color='black';style.textDecoration='none';\" id=jho4>location.href</span></td>
        <td align=right id=vel_ank_a>".$hls[15]."</td>
       </tr>
       <tr>
        <td colspan=2 align=center id=vel_ank_a>Celkem hlasovalo: $hlasovalo3</td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
";
?>
