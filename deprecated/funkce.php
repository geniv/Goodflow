<?
function delka_souboru($kde)
{
$soubr="$kde/delka_otvir_a_qpwdojcnreuifnviernviwrbrsihbrsibvisbvisjbisbviwsnbvn.php";
$u=fopen($soubr,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function delka_pole_navodu($kde)
{
$soubr="$kde/delka_pole_navodu_qoihsdvisdnfoiaufhsoiaduisudbfsidudbv.php";
$u=fopen($soubr,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function delka_pole_uvodu($kde)
{
$soubr="$kde/delka_pole_uvodu_qpidfohnwscnqaoidhnwieujhevbsijvnbsivbsiuhvbsdijbvwijvwijbvwirhbfv.php";
$u=fopen($soubr,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function delka_pole_odkazu($kde)
{
$soubr="$kde/delka_pole_odkazu_qdpoisvisubvsdjnsidhbvisjbvihsdfbvushidbvisdvkjsf.php";
$u=fopen($soubr,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function delka_pole_kontaktu($kde)
{
$soubr="$kde/delka_pole_kontakty_qoiwhfwroigubvisubqwpeovjnisoiuvrsdfikjvbsibv.php";
$u=fopen($soubr,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function pocet_polozek_uvod($kde)
{
$soubr="$kde/pocet_polozek_uvod_qpojwoihsovnosnvosnvsdnvosnvoisnvsoiunv.php";
$u=fopen($soubr,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function pocet_polozek_navod($kde)
{
$soubr="$kde/pocet_polozek_navod_qpojwoihsovsdfghsfghsfsdsdfgbsfgnsfgnv.php";
$u=fopen($soubr,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function login($jmeno,$heslo)
{
$delkasoub=delka_souboru(".");
$nazev="cleno_ve_qpwdjcmjisfvncacnsidjvnsowksjcnsdkjnisjfnvidjfhbviwjejnbiwsjnvsowjknvokjwle.php";
$u=fopen($nazev,"r");
$clen=explode("--UV--",fread($u,$delkasoub));
fclose($u);

$poc=0;
for($i=1;$i<count($clen);$i++)
{
if($clen[$i]==$jmeno and $clen[$i+1]==$heslo){$poc++;}
}//end for
if($poc==1)
{return true;}
else
{return false;}
}
//---------------------------------------------------------------------
function vygeneruj_nazev_obrazku($typ)
{
if($typ==1){$konc=".gif";}
if($typ==2){$konc=".jpg";}
if($typ==3){$konc=".png";}
if($typ==4){$konc=".swf";}
if($typ==5){$konc=".psd";}
if($typ==6){$konc=".bmp";}
if($typ==7){$konc=".tiff";}
if($typ==8){$konc=".tiff";}
if($typ==9){$konc=".jpc";}
if($typ==10){$konc=".jp2";}
if($typ==11){$konc=".jpx";}

$slz=0;
for($i=1;$i<10;$i++)
{
$slz.=rand(1,10000);
}//end for
return "{$slz}{$konc}";
}
//---------------------------------------------------------------------
function pridej_navod($novnaz,$cesta,$odkaz,$nazev,$program,$popis,$autor,$typ)
{
$delkasoub=delka_souboru(".");
$soub="../navody_y_qpwdjnisvbnaocnbsuivniufcvbekjshbvuwzbviuciwuehcwiufchwfcveruzcweoijwiufvwezfvcweiciwecibwiuc.php";
$u=fopen($soub,"r");
$odk=explode("--OD--",fread($u,$delkasoub));
fclose($u);

$odk[0]="<?php";
$odk[count($odk)+1]=$cesta;//cesta
$odk[count($odk)+2]=$odkaz;//odkaz
$odk[count($odk)+3]=$nazev;//nazev
$odk[count($odk)+4]=$program;//program
$odk[count($odk)+5]=$popis;//popis
$odk[count($odk)+6]=$autor;//autor
$odk[count($odk)+7]=$typ;//typ
$odk[count($odk)+8]=Date("d.m.Y");//založen

pridej_uvod("Pøidán návod: $nazev");

$u=fopen($soub,"w");
fwrite($u,implode($odk,"--OD--"));
fclose($u);

return "uploadováno! soubor: $novnaz";
}
//---------------------------------------------------------------------
function upravit_navod($cislo,$cesta,$odkaz,$nazev,$program,$popis,$autor,$typ)
{
$delkasoub=delka_souboru(".");
$soub="../navody_y_qpwdjnisvbnaocnbsuivniufcvbekjshbvuwzbviuciwuehcwiufchwfcveruzcweoijwiufvwezfvcweiciwecibwiuc.php";
$u=fopen($soub,"r");
$odk=explode("--OD--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_navodu("..");

$odk[0]="<?php";
$odk[($del*$cislo)-7]=$cesta;
$odk[($del*$cislo)-6]=$odkaz;
$odk[($del*$cislo)-5]=$nazev;
$odk[($del*$cislo)-4]=$program;
$odk[($del*$cislo)-3]=$popis;
$odk[($del*$cislo)-2]=$autor;
$odk[($del*$cislo)-1]=$typ;

$u=fopen($soub,"w");
fwrite($u,implode($odk,"--OD--"));
fclose($u);

return "upraveno, kliknìte jinam";
}
//---------------------------------------------------------------------
function smazat_navod($cislo,$obrazek)
{
$delkasoub=delka_souboru(".");
$soub="../navody_y_qpwdjnisvbnaocnbsuivniufcvbekjshbvuwzbviuciwuehcwiufchwfcveruzcweoijwiufvwezfvcweiciwecibwiuc.php";
$u=fopen($soub,"r");
$odk=explode("--OD--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_navodu("..");
$pz=($cislo*$del)-($del-1);
$sb=$odk[($cislo*$del)-5];

unlink($obrazek);

$poc=0;
$nove[]="";
for($i=1;$i<$pz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$odk[$i];
}//end for

for($i1=$pz+$del;$i1<count($odk);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$odk[$i1];
}//end for

$nove[0]="<?php";
$u=fopen($soub,"w");
fwrite($u,implode($nove,"--OD--"));
fclose($u);

return "odmazáno! položka: <b>$sb</b>, kliknìte jinam";
}
//---------------------------------------------------------------------
function pridej_uvod($text)
{
$delkasoub=delka_souboru(".");
$soub="../uvod_ni_apfijnsdjvnadkcjnosnvosinhvisuffnbpqoweigunfugfhgifjhkdjgztdedzgtdfeoikjwefoihweoufwerf.php";
$u=fopen($soub,"r");
$uvd=explode("--VL--",fread($u,$delkasoub));
fclose($u);

$uvd[0]="<?php";
$uvd[count($uvd)+1]=Date("d.m.Y");//založen
$uvd[count($uvd)+2]=stripslashes($text);

$u=fopen($soub,"w");
fwrite($u,implode($uvd,"--VL--"));
fclose($u);

return
"<hr><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Pøidal&nbsp;jsi&nbsp;tabulku&nbsp;do&nbsp;úvodu&nbsp;s&nbsp;textem:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong>".stripslashes($text)."</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=pridej_uvod\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
</table><hr>";
}
//---------------------------------------------------------------------
function upravit_uvod($cislo,$text)
{
$delkasoub=delka_souboru(".");
$soub="../uvod_ni_apfijnsdjvnadkcjnosnvosinhvisuffnbpqoweigunfugfhgifjhkdjgztdedzgtdfeoikjwefoihweoufwerf.php";
$u=fopen($soub,"r");
$uvd=explode("--VL--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_uvodu("..");

$uvd[0]="<?php";
$uvd[($cislo*$del)]=stripslashes($text);

$u=fopen($soub,"w");
fwrite($u,implode($uvd,"--VL--"));
fclose($u);

return
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Upravil&nbsp;jsi&nbsp;tabulku&nbsp;v&nbsp;úvodu&nbsp;s&nbsp;textem:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong>".stripslashes($text)."</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=uprav_uvod\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
</table><hr>";
}
//---------------------------------------------------------------------
function smazat_uvod($cislo)
{
$delkasoub=delka_souboru(".");
$soub="../uvod_ni_apfijnsdjvnadkcjnosnvosinhvisuffnbpqoweigunfugfhgifjhkdjgztdedzgtdfeoikjwefoihweoufwerf.php";
$u=fopen($soub,"r");
$uvd=explode("--VL--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_uvodu("..");
$pz=($cislo*$del)-($del-1);
$sb=$uvd[($cislo*$del)];

$poc=0;
$nove[]="";
for($i=1;$i<$pz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$uvd[$i];
}//end for

for($i1=$pz+$del;$i1<count($uvd);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$uvd[$i1];
}//end for

$nove[0]="<?php";
$u=fopen($soub,"w");
fwrite($u,implode($nove,"--VL--"));
fclose($u);

return
"<hr>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>$cislo</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Smazána&nbsp;tabulka&nbsp;v&nbsp;úvodu&nbsp;s&nbsp;textem:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong>$sb</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=smaz_uvod\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
</table><hr>";
}
//---------------------------------------------------------------------
function pridej_odkaz($nadpis,$odkaz)
{
$delkasoub=delka_souboru(".");
$soub="../odka_zy_qpwojiusbisubviusdbiuufasaiasnisjjcnisjdnbvisibsdvisdbdviuusdbdvisuubvs.php";
$u=fopen($soub,"r");
$odk=explode("--DA--",fread($u,$delkasoub));
fclose($u);

$odk[0]="<?php";
$odk[count($odk)+1]=str_replace(" ","&nbsp;",$nadpis);
$odk[count($odk)+2]=$odkaz;

$u=fopen($soub,"w");
fwrite($u,implode($odk,"--DA--"));
fclose($u);

return  "pøidáno: $nadpis";
}
//---------------------------------------------------------------------
function upravit_odkaz($cislo,$nadpis,$odkaz)
{
$delkasoub=delka_souboru(".");
$soub="../odka_zy_qpwojiusbisubviusdbiuufasaiasnisjjcnisjdnbvisibsdvisdbdviuusdbdvisuubvs.php";
$u=fopen($soub,"r");
$odk=explode("--DA--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_odkazu("..");

$odk[($cislo*$del)-1]=str_replace(" ","&nbsp;",$nadpis);
$odk[($cislo*$del)]=$odkaz;

$u=fopen($soub,"w");
fwrite($u,implode($odk,"--DA--"));
fclose($u);

return "Upraveno, kliknìte jinam";
}
//---------------------------------------------------------------------
function smazat_odkaz($cislo)
{
$delkasoub=delka_souboru(".");
$soub="../odka_zy_qpwojiusbisubviusdbiuufasaiasnisjjcnisjdnbvisibsdvisdbdviuusdbdvisuubvs.php";
$u=fopen($soub,"r");
$odk=explode("--DA--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_odkazu("..");
$pz=($cislo*$del)-($del-1);
$sb=$odk[$pz];

$poc=0;
$nove[]="";
for($i=1;$i<$pz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$odk[$i];
}//end for

for($i1=$pz+$del;$i1<count($odk);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$odk[$i1];
}//end for

$nove[0]="<?php";
$u=fopen($soub,"w");
fwrite($u,implode($nove,"--DA--"));
fclose($u);

return "odmazáno! položka: <b>$sb</b>, kliknìte jinam";
}
//---------------------------------------------------------------------
function pridej_kontakt($tvurce,$zamereni,$email,$icq,$www)
{
$delkasoub=delka_souboru(".");
$soub="../kontakty_qpwjovinrsovnsdonvosidnviosbvoisdfbvisfbvoisdhnvoisnbv.php";
$u=fopen($soub,"r");
$kont=explode("--KT--",fread($u,$delkasoub));
fclose($u);

//str_replace(" ","&nbsp;",$nadpis);
$kont[0]="<?php";
$kont[count($kont)+1]=$tvurce;
$kont[count($kont)+2]=str_replace(" ","&nbsp;",$zamereni);
$kont[count($kont)+3]=$email;
$kont[count($kont)+4]=$icq;
$kont[count($kont)+5]=$www;

$u=fopen($soub,"w");
fwrite($u,implode($kont,"--KT--"));
fclose($u);

return "Pøidán: $tvurce";
}
//---------------------------------------------------------------------
function upravit_kontakt($cislo,$tvurce,$zamereni,$email,$icq,$www)
{
$delkasoub=delka_souboru(".");
$soub="../kontakty_qpwjovinrsovnsdonvosidnviosbvoisdfbvisfbvoisdhnvoisnbv.php";
$u=fopen($soub,"r");
$kont=explode("--KT--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_kontaktu("..");

$kont[0]="<?php";
$kont[($cislo*$del)-4]=$tvurce;
$kont[($cislo*$del)-3]=str_replace(" ","&nbsp;",$zamereni);
$kont[($cislo*$del)-2]=$email;
$kont[($cislo*$del)-1]=$icq;
$kont[($cislo*$del)]=$www;

$u=fopen($soub,"w");
fwrite($u,implode($kont,"--KT--"));
fclose($u);

return "Upraveno, kliknìte jinam";
}
//---------------------------------------------------------------------
function smazat_kontakt($cislo)
{
$delkasoub=delka_souboru(".");
$soub="../kontakty_qpwjovinrsovnsdonvosidnviosbvoisdfbvisfbvoisdhnvoisnbv.php";
$u=fopen($soub,"r");
$kont=explode("--KT--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_kontaktu("..");
$pz=($cislo*$del)-($del-1);
$sb=$kont[($cislo*$del)-4];

$poc=0;
$nove[]="";
for($i=1;$i<$pz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$kont[$i];
}//end for

for($i1=$pz+$del;$i1<count($kont);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$kont[$i1];
}//end for

$nove[0]="<?php";
$u=fopen($soub,"w");
fwrite($u,implode($nove,"--KT--"));
fclose($u);

return "odmazáno! položka: <b>$sb</b>, kliknìte jinam";
}
//---------------------------------------------------------------------
function jdi_na_stranku($stranka,$pocet_stran,$sekce)
{
$dalstr=$stranka+1;
$predstr=$stranka-1;

if($stranka>1)
{$pred="( <a href=\"index.php?kam=$sekce&str=$predstr\" class=\"genmed\">Pøedchozí</a> ) ";}
else
{$pred="";}

$zc="";
for($i=1;$i<=$pocet_stran;$i++)
{
if($i!=$pocet_stran)
{
if($i==$stranka)//ruší a href
{$zc.="$i, ";}//zaèátek
else
{$zc.="<a href=\"index.php?kam=$sekce&str=$i\"><u>$i</u></a>, ";}
}
else
{
if($pocet_stran==$stranka)//dohlíží na další
{$kn="$i";}//konec
else
{$kn="<a href=\"index.php?kam=$sekce&str=$i\"><u>$i</u></a> ( <a href=\"index.php?kam=$sekce&str=$dalstr\" class=\"genmed\">Další</a> )";}
}
}//end for

return "Jdi na stránku: {$pred}{$zc}{$kn}";
}
//---------------------------------------------------------------------
function pocet_souboru($cesta)
{
$handle=opendir($cesta);
$poc=0;
while($soub=readdir($handle))
{
$poc+=1;
}
closedir($handle);

return $poc-2;
}
//---------------------------------------------------------------------
function velikost_adresare($jmeno,$koncovka)
{
$handle=opendir($jmeno);
$vel=0;
while($soub=readdir($handle))
{
$vel+=filesize("$jmeno/$soub");
}
closedir($handle);

if($koncovka=="true")
{
if($vel>=1048576)
{return sprintf("%.2f&nbsp;MB",round($vel/1048576*100)/100);}
else
if($vel>=1024)
{return sprintf("%.2f&nbsp;KB",round($vel/1024*100)/100);}
else
{return sprintf("%.2f&nbsp;Bytes",$vel);}
}
else//else koncovka
{return $vel;}
}
//---------------------------------------------------------------------
function velikost_stranek()
{
$vs[0]=velikost_adresare("../images/obrazky_navody",false);
$vs[1]=velikost_adresare("../images",false);
$vs[2]=velikost_adresare("../images/menu",false);
$vs[3]=velikost_adresare("../images/menu/oramovani",false);
$vs[4]=velikost_adresare(".",false);//admin
$vs[5]=velikost_adresare("../",false);//hlavni

$vel=0;
for($i=0;$i<count($vs);$i++)
{
$vel+=$vs[$i];
}//end for

if($vel>=1048576)
{return sprintf("%.2f&nbsp;MB",$vel/1048576);}
else
if($vel>=1024)
{return sprintf("%.2f&nbsp;KB",$vel/1024);}
else
{return sprintf("%.2f&nbsp;Bytes",$vel);}
}
//---------------------------------------------------------------------
function otevri_styl()
{
$soub="../fugess-f-z.css";
$uk=fopen($soub,"r");
return fread($uk,30000);
fclose($uk);
}
//---------------------------------------------------------------------
function uloz_styl($text)
{
$soub="../fugess-f-z.css";
$uk=fopen($soub,"w");
fwrite($uk,$text);
fclose($uk);
return "styl uložen, klikni jinam!";
}
//---------------------------------------------------------------------
function pocitadlo_pristupu()
{
$soub="administrace/pocitadl_o_pristupu_qoiuefhcisudvhisduvdsjvsdiuhvisdubviusdfhbsiuvb.php";
$uk=fopen($soub,"r");
$cislo=fread($uk,100);
fclose($uk);

if(Empty($cislo)){$cislo=0;}
$cislo++;

$uk=fopen($soub,"w");
fwrite($uk,$cislo);
fclose($uk);

return $cislo;
}
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
function logovani_prihlasovani($jmeno,$heslo,$adresa,$stav)
{
if($stav=="true")
{$pov="<font color=lime>povoleno</font>";}
else
{$pov="<font color=red>zakázano</font>";}
$tex="Pøihlašoval se: <b>$jmeno</b>, s heslem: <b>$heslo</b>, v: ".Date("H:i:s").", dne: ".Date("j.n. Y").", z IP: $adresa, pøístup: <b>$pov</b><br>\n";
$soub="../prihl_apqfnmsojvbhsivbsjvsiusiuvqwfpokfnisnvnsosijvnskjvsdfkjvbjbisujbdv.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------

?>
