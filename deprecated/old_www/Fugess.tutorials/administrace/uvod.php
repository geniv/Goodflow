<?
if(!Empty($admin_jmeno) and !Empty($admin_heslo) and login($admin_jmeno,$admin_heslo)=="true")
{
$delkasoub=delka_souboru(".");
$soub="../uvod_ni_apfijnsdjvnadkcjnosnvosinhvisuffnbpqoweigunfugfhgifjhkdjgztdedzgtdfeoikjwefoihweoufwerf.php";
$u=fopen($soub,"r");
$uvd=explode("--VL--",fread($u,$delkasoub));

fclose($u);
$del1=delka_pole_uvodu("..");
$poc[0]=(count($uvd)-1)/$del1;
$soub="../navody_y_qpwdjnisvbnaocnbsuivniufcvbekjshbvuwzbviuciwuehcwiufchwfcveruzcweoijwiufvwezfvcweiciwecibwiuc.php";
$u=fopen($soub,"r");
$nav=explode("--OD--",fread($u,$delkasoub));

fclose($u);
$del2=delka_pole_navodu("..");
$poc[1]=(count($nav)-1)/$del2;
$soub="../odka_zy_qpwojiusbisubviusdbiuufasaiasnisjjcnisjdnbvisibsdvisdbdviuusdbdvisuubvs.php";
$u=fopen($soub,"r");
$odk=explode("--DA--",fread($u,$delkasoub));

fclose($u);
$del3=delka_pole_odkazu("..");
$poc[2]=(count($odk)-1)/$del3;
$soub="../kontakty_qpwjovinrsovnsdonvosidnviosbvoisdfbvisfbvoisdhnvoisnbv.php";
$u=fopen($soub,"r");
$kont=explode("--KT--",fread($u,$delkasoub));

fclose($u);
$del4=delka_pole_kontaktu("..");
$poc[3]=(count($kont)-1)/$del4;
$poc[4]=pocet_souboru("../images/obrazky_navody")-1;
$poc[5]=velikost_adresare("../images/obrazky_navody",true);
$poc[6]=velikost_stranek();

$tx[0]="Po�et&nbsp;tabulek&nbsp;v&nbsp;�vodu:";
$tx[1]="Po�et&nbsp;n�vod�:";
$tx[2]="Po�et&nbsp;odkaz�:";
$tx[3]="Po�et&nbsp;kontakt�:";
$tx[4]="Po�et&nbsp;obr�zk�&nbsp;ve&nbsp;slo�ce:&nbsp;obrazky_navody";
$tx[5]="Velikost&nbsp;slo�ky:&nbsp;obrazky_navody";
$tx[6]="Celkov�&nbsp;velikost&nbsp;str�nek:";

print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"100%\"><strong>Administrace&nbsp;webu&nbsp;CZ&nbsp;&&nbsp;SK&nbsp;Tutorial</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td align=\"right\">";

for ($i=0;$i<count($poc);$i++)
{
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
<td class=\"input\" align=\"center\" width=\"1%\"><strong>{$tx[$i]}</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>{$poc[$i]}</strong></td>
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
</table>";
} //end for

print
"</td>
</tr>
</table>".autori_tutorialu();
}
else
{print "neopr�vn�n� p��stup!";}
?>
