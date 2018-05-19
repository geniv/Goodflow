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
$odk[count($odk)+1]=stripslashes($cesta);//cesta
$odk[count($odk)+2]=stripslashes($odkaz);//odkaz
$odk[count($odk)+3]=stripslashes($nazev);//nazev
$odk[count($odk)+4]=stripslashes($program);//program
$odk[count($odk)+5]=stripslashes($popis);//popis
$odk[count($odk)+6]=stripslashes($autor);//autor
$odk[count($odk)+7]=stripslashes($typ);//typ
$odk[count($odk)+8]=Date("d.m.Y");//založen

pridej_uvod("Pøidán návod - $nazev");

$u=fopen($soub,"w");
fwrite($u,implode($odk,"--OD--"));
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Pøidal&nbsp;jsi&nbsp;návod:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong>$nazev</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=pridej\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
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
$odk[($del*$cislo)-7]=stripslashes($cesta);
$odk[($del*$cislo)-6]=stripslashes($odkaz);
$odk[($del*$cislo)-5]=stripslashes($nazev);
$odk[($del*$cislo)-4]=stripslashes($program);
$odk[($del*$cislo)-3]=stripslashes($popis);
$odk[($del*$cislo)-2]=stripslashes($autor);
$odk[($del*$cislo)-1]=stripslashes($typ);

$u=fopen($soub,"w");
fwrite($u,implode($odk,"--OD--"));
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Upravil&nbsp;jsi&nbsp;návod:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong>$nazev</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=uprav\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
}
//---------------------------------------------------------------------
function smazat_navod($cislo)
{
$delkasoub=delka_souboru(".");
$soub="../navody_y_qpwdjnisvbnaocnbsuivniufcvbekjshbvuwzbviuciwuehcwiufchwfcveruzcweoijwiufvwezfvcweiciwecibwiuc.php";
$u=fopen($soub,"r");
$odk=explode("--OD--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_navodu("..");
$pz=($cislo*$del)-($del-1);
$sb=$odk[($cislo*$del)-5];

$soub="uvod_ni_apfijnsdjvnadkcjnosnvosinhvisuffnbpqoweigunfugfhgifjhkdjgztdedzgtdfeoikjwefoihweoufwerf.php";
$u=fopen($soub,"r");
$uvd=explode("--VL--",fread($u,$delkasoub));
fclose($u);
$delka=delka_pole_uvodu("..");
smazat_uvod((count($uvd)-1)/$delka);

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

return
"<hr></a>
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Smazán&nbsp;návod:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong>$sb</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=smaz\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
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
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
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
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
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
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Pøidal&nbsp;jsi&nbsp;odkaz:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\" class\"genmed\"><strong><a href=\"$odkaz\" target=\"_blank\" class\"genmed\">$nadpis</a></strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=pridej_odkaz\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Upravil&nbsp;jsi&nbsp;odkaz:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\" class\"genmed\"><strong><a href=\"$odkaz\" target=\"_blank\" class\"genmed\">$nadpis</a></strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=uprav_odkaz\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Smazán&nbsp;odkaz:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong>$sb</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=smaz_odkaz\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Pøidal&nbsp;jsi&nbsp;kontakt:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong>$tvurce</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=pridej_kontakt\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Upravil&nbsp;jsi&nbsp;kontakt:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\" class\"genmed\"><strong>$tvurce</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=uprav_kontakt\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Smazán&nbsp;kontakt:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong>$sb</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=smaz_kontakt\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
}
//---------------------------------------------------------------------
function jdi_na_stranku($stranka,$pocet_stran,$sekce)
{
$dalstr=$stranka+1;
$predstr=$stranka-1;
if($pocet_stran<6)
{
if($stranka>1)
{$pred="( <a href=\"index.php?kam=$sekce&str=$predstr\" class=\"genmed\"><u>Pøedchozí</u></a> ) ";}
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
{$kn="<a href=\"index.php?kam=$sekce&str=$i\"><u>$i</u></a> ( <a href=\"index.php?kam=$sekce&str=$dalstr\" class=\"genmed\"><u>Další</u></a> )";}
}
}//end for

return "Jdi na stránku: {$pred}{$zc}{$kn}";
}
else
{
$str2=$stranka+1;
$str3=$stranka+2;
$str4=$pocet_stran-1;
$str5=$pocet_stran-2;

if($stranka>1)
{$pred1="( <a href=\"index.php?kam=$sekce&str=$predstr\" class=\"genmed\"><u>Pøedchozí</u></a> ) <a href=\"index.php?kam=$sekce&str=1\"><u>1</u></a> ... ";}
else
{$pred1="";}

if($stranka<$pocet_stran-2)
{
if($pocet_stran==1)
{$zc1=$stranka;}
else
{$zc1="";}

if($pocet_stran==2)
{$zc1="$stranka, <a href=\"index.php?kam=$sekce&str=$str2\"><u>$str2</u></a>";}
else
{$zc1="";}

if($pocet_stran>3)
{$zc1=" $stranka, <a href=\"index.php?kam=$sekce&str=$str2\"><u>$str2</u></a>, <a href=\"index.php?kam=$sekce&str=$str3\"><u>$str3</u></a>";}
else
{$zc1="";}

if($pocet_stran-2==$stranka)//dohlíží na další
{$kn1="";}//konec
else
{$kn1=" ... <a href=\"index.php?kam=$sekce&str=$pocet_stran\"><u>$pocet_stran</u></a> ( <a href=\"index.php?kam=$sekce&str=$dalstr\" class=\"genmed\"><u>Další</u></a> )";}

}
else
{
if($stranka==$str5)
{$zc1="$str5, <a href=\"index.php?kam=$sekce&str=$str4\"><u>$str4</u></a>, <a href=\"index.php?kam=$sekce&str=$pocet_stran\"><u>$pocet_stran</u></a> ( <a href=\"index.php?kam=$sekce&str=$dalstr\" class=\"genmed\"><u>Další</u></a> )";}

if($stranka==$str4)
{$zc1="<a href=\"index.php?kam=$sekce&str=$str5\"><u>$str5</u></a>, $str4, <a href=\"index.php?kam=$sekce&str=$pocet_stran\"><u>$pocet_stran</u></a> ( <a href=\"index.php?kam=$sekce&str=$dalstr\" class=\"genmed\"><u>Další</u></a> )";}

if($pocet_stran==$stranka)
{$zc1="<a href=\"index.php?kam=$sekce&str=$str5\"><u>$str5</u></a>, <a href=\"index.php?kam=$sekce&str=$str4\"><u>$str4</u></a>, $pocet_stran";}

$kn1="";
}
return "Jdi na stránku: {$pred1}{$zc1}{$kn1}";
}//...
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
$vs[6]=velikost_adresare("../tutorialy_download",false);

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
$delkasoub=delka_souboru(".");
$soub="../fugess-f-z.css";
$uk=fopen($soub,"r");
return fread($uk,$delkasoub);
fclose($uk);
}
//---------------------------------------------------------------------
function uloz_styl($text)
{
$soub="../fugess-f-z.css";
$uk=fopen($soub,"w");
fwrite($uk,$text);
fclose($uk);
return
"<hr>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"100%\"><strong>Nastavení&nbsp;CSS&nbsp;bylo&nbsp;uloženo</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong><a href=\"index_go.php?kam=css\" class=\"genmed\">Pokraèuj&nbsp;zde</a></strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table><hr>";
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
function autori_tutorialu()
{
$delkasoub=delka_souboru(".");
$soub="../navody_y_qpwdjnisvbnaocnbsuivniufcvbekjshbvuwzbviuciwuehcwiufchwfcveruzcweoijwiufvwezfvcweiciwecibwiuc.php";
$u=fopen($soub,"r");
$nav=explode("--OD--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_navodu("..");

for($i=1;$i<((count($nav)-1)/$del)+1;$i++)
{
$jm[$i]=$nav[($i*$del)-2];
}//end for

$jme=array_unique($jm);//odstranìní duplicitních hodnot
$jmena=array_values($jme);//do nového pole
$poc=count($jmena);//poèet jmen

for($i=0;$i<$poc;$i++)//jednotlivé jména
{$pocty[$i]=0;}//end for

for($i1=0;$i1<$poc;$i1++)//jednotlivé jména
{
for($i=1;$i<((count($nav)-1)/$del)+1;$i++)//celý
{
if($jmena[$i1]==$jm[$i]){$pocty[$i1]++;}
}//end for i
}//end for i1

print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"1%\">
<tr>
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Poèet&nbsp;autorù&nbsp;návodù:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>$poc</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"13\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\" colspan=\"11\"><strong>Výpis&nbsp;všech&nbsp;autorù&nbsp;návodù:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"13\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
<tr>
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>#</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Autor&nbsp;návodu:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>";
$ii=0;
for($i=0;$i<$poc;$i++)//jednotlivé jména
{
$ii++;
echo
"<tr>
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>$ii</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>{$jmena[$i]}</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>{$pocty[$i]}</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>";
}//end for
print "</table>";
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
