<?
//konstanty
$h1="cernobil"; //hesla
$h2="26";
$h3="duben";
$h4="1986";
/*
$pocet=15;
$delka=1000000;

$popisky[0]="Otev��t";
$popisky[1]="Ulo�it";
$popisky[2]="Z�lohovat";
$popisky[3]="Zobrazit";
$popisky[4]="Z�lohovan� soubor";
$popisky[5]="Zaloha_";
$popisky[6]="(otev�eno)";
$popisky[7]="(ulo�eno)";
$popisky[8]="(z�lohov�no)";
$popisky[9]="(smaz�no)";
$popisky[10]="Smazat obsah";

$naz[0]="Logovac� soubor str�nek";
$naz[1]="Logovac� soubor p�ihla�ov�n� (admin)";
$naz[2]="Banovan� �lenov� (bez mezer)";
$naz[3]="Str�nky aktualit";
$naz[4]="Odkazy po t�chto str�nk�ch - Akuality";
$naz[5]="Datum posledn� aktualizace";
$naz[6]="Vzkazy ve f�rum (bez mezer!)";
$naz[7]="Logov�n� p��sp�vk� ve f�ra";
$naz[8]="Logov�n� p��stup� do knihovny";
$naz[9]="Kn�ky v knihovn� (bez mezer!)";
$naz[10]="Logov�n� chodu knihovny";
$naz[11]="Ot�zka v anket�";
$naz[12]="Odpov�di v anket�";
$naz[13]="Hlasy v anket�";
$naz[14]="Logov�n� ankety";
$naz[15]="Vypr�zdnit pol��ka";

$systzkratky[0]="logst";
$systzkratky[1]="logpr";
$systzkratky[2]="ban";
$systzkratky[3]="akt";
$systzkratky[4]="aktD";
$systzkratky[5]="dat";
$systzkratky[6]="fro";
$systzkratky[7]="lfo";
$systzkratky[8]="prk";
$systzkratky[9]="dbk";
$systzkratky[10]="lgchknh";
$systzkratky[11]="otvank";
$systzkratky[12]="odpvank";
$systzkratky[13]="hlvankt";
$systzkratky[14]="logank";
$systzkratky[15]="az";

$sob[0]="l_s_qpwoedjoweijfhsdjhvkjsnvijsnisufrhoireuhgiwjhgwrgnidfuvevowhfviuunviuentrvuirevizuehbiuenv.php";
$sob[1]="l_s_p_qwpoijfeoifhiwruvzuztdrtsredrewsrewqwpiojdcocycyxcmnyxbcnmb.php";
$sob[2]="ban_qpwjfiowejhvurhvasocjsoiuhciuwrcizwrciuwrnizrbvzeurnbvwizuvvwrzrubc.php";
$sob[3]="aktuality_upravovani_qpwrijoiweuhrfgvuirhbiuvnuivwrezvbwriufniuowr.php";
$sob[4]="aktuality_skrypt_DB_odkazy_po_str_aoisdhncoasdnqpojfuiszvsfhcnivuisnvisbviusdhhfvisdhuvdvwsd.php";
$sob[5]="datum_akualizace_pqjiowuvuirwnbvizuwefoijwiurvnruifnwuirbviurenbvzwr.php";
$sob[6]="vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php";
$sob[7]="l_s_p_f_qwifojhwizuvbuefnviufgwfzfrzuhfrzutohfrzuhiuwefiuwqpqppqpoejfirjguhrvuwefehv.php";
$sob[8]="l_s_lg_d_kn_qpfkcjsoadcnunvzrebwesiuvasizvbsizcvaeufnuquwhuienczagfcviuahqpcjaducvnzbcvizcaiucb.php";
$sob[9]="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";
$sob[10]="log_fu_n_kni_ho_vn_yy_qpowfjwiuvnruiwvhwjnvuwrhviuzrfuiwjnuvnrwuifwiejfurehguiwhviznwfoujnwrouvhwruof.php";
$sob[11]="otz_na_ak_ket_e_qpefjwroifhiufhiuehcuwehfoiwefuorhgwrjfoijeoijweoifjwojfowrhgweokfhiruvhwroijf.php";
$sob[12]="n_ot_v_an_ke_t_e_qpwjeoiwfhiuhbviuwrnvuerbniuwnvnebiuwhnruivreuhfjhreoiuhoiwrejhf.php";
$sob[13]="s_an_ke_t_djkfcdnsjqwporjeoiwjuitgozhegnunvronvreilnmvsdimwimwpockmspidmvsdmpoimpcmwpoemf.php";
$sob[14]="lo_g_a_n_k_e_t_y_aodshpqwoefmnriunvoiefjveurnviueifjnvurenviuerhnviuhgiruhgiurhg.php";
$sob[15]="";

if(!Empty($ptx1) and !Empty($ptx2) and !Empty($ptx3) and !Empty($ptx4))
{


if($ptx1==$h1 and $ptx2==$h2 and $ptx3==$h3 and $ptx4==$h4)
{$pris="vstoupil nebo upravuje";}
else
{$pris="nevstoupil";}
//----------------------logov�n� do souboru------------------
$logt="P�ihl�en� pod: $ptx1 , $ptx2 , $ptx3 , $ptx4 , ".Date("H:i:s j.m. Y")." z IP: <b>".$REMOTE_ADDR."</b> a $pris<br>\n";
$lg_s="l_s_p_qwpoijfeoifhiwruvzuztdrtsredrewsrewqwpiojdcocycyxcmnyxbcnmb.php";  //zapisovac� soubor
$uk=fopen($lg_s,"a+");
fwrite($uk,$logt);
fclose($uk);
}
*/

if(!Empty($_POST["tx1"]) and !Empty($_POST["tx2"]) and !Empty($_POST["tx3"]) and !Empty($_POST["tx4"]) and 
$_POST["tx1"]==$h1 and $_POST["tx2"]==$h2 and $_POST["tx3"]==$h3 and $_POST["tx4"]==$h4)
{
{print "<h1><a href=\"index.php?kam=ajdimne&vstup=true\">>> Pokra�uj zde <<</a></h1>";}


/*
if(!Empty($pvas))
{
for($i=0;$i<$pocet;$i++)
{
if($pvas=="l_{$systzkratky[$i]}")
{// print "$i, {$systzkratky[$i]} $sob[$i]";
$prvs[$i]=$popisky[6];
$doss=fopen($sob[$i],"r");
$obsah=fread($doss,$delka);
fclose($doss);
}//end if nacti

if($pvas=="s_{$systzkratky[$i]}" and !$edttxt=="")
{
$prvs[$i]=$popisky[7];
$doss=fopen($sob[$i],"w");
fwrite($doss,$edttxt);
$doss=fopen($sob[$i],"r");
$obsah=fread($doss,$delka);
fclose($doss);
}
else
{
if($pvas=="s_{$systzkratky[$i]}" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="{$popisky[5]}$i")
{
$prvs[$i]=$popisky[8];
copy($sob[$i],$popisky[5].$sob[$i]);
$obsah="";
}//end zaloha

if($pvas=="sm_{$systzkratky[$pocet]}")
{
$prvs[$pocet]=$popisky[9];
$obsah="";
}//end smaz
}//end for
}//end empty pvas
else
{
$obsah="";
}

echo
"<center>
<textarea rows=15 cols=80 name=memo>$obsah</textarea>
</center>
<table border=0 align=center cellpadding=0 cellspacing=10>";

for($i=0;$i<$pocet;$i++)
{
if(Empty($prvs[$i])){$prvs[$i]="&nbsp;";}
if(Empty($prvs[$pocet])){$prvs[$pocet]="&nbsp;";}

echo 
"<tr>
<td>{$naz[$i]}</td>
<td><a href=\"{$sob[$i]}\" target=\"_blank\">{$popisky[3]}</a></td>
<td><input type=button value=\"{$popisky[0]}\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_{$systzkratky[$i]}';men.poslat.click();\"></td>
<td><input type=button value=\"{$popisky[1]}\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_{$systzkratky[$i]}';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>{$prvs[$i]}</td>
<td><input type=button value=\"{$popisky[2]}\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='{$popisky[5]}$i';men.poslat.click();\"></td>
<td><a href=\"{$popisky[5]}$sob[$i]\" target=\"_blank\">{$popisky[4]}</a></td>
</tr>";
}//end for
echo
"<tr>
<td>{$naz[$pocet]}</td>
<th colspan=3><input type=button value=\"{$popisky[10]}\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';memo.innerText='';men.edttxt.value='';men.pvas.value='sm_{$systzkratky[$pocet]}';men.poslat.click();\"></th>
<td>{$prvs[$pocet]}</td>
<td  colspan=2>&nbsp;</td>
</tr>
</table>";

*/

}
else
{
echo 
"<form method=\"post\">
<table border=0 align=center cellpadding=0 cellspacing=0>
<tr>
<td><input type=\"password\" name=\"tx1\"></td>
</tr>
<tr>
<td><input type=\"password\" name=\"tx2\"></td>
</tr>
<tr>
<td><input type=\"password\" name=\"tx3\"></td>
</tr>
<tr>
<td><input type=\"password\" name=\"tx4\"></td>
</tr>
<tr>
<th><input type=\"submit\" value=\"GO\"></th>
</tr>
</table>
</form>";
}




/*
if($pvas=="l_logst")
{
$prvs[0]="(otev�eno)";
$dot_s="l_s_qpwoedjoweijfhsdjhvkjsnvijsnisufrhoireuhgiwjhgwrgnidfuvevowhfviuunviuentrvuirevizuehbiuenv.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_logst"  and !$edttxt=="")
{
$prvs[0]="(ulo�eno)";
$dot_s="l_s_qpwoedjoweijfhsdjhvkjsnvijsnisufrhoireuhgiwjhgwrgnidfuvevowhfviuunviuentrvuirevizuehbiuenv.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_logst" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_logpr")
{
$prvs[1]="(otev�eno)";
$dot_s="l_s_p_qwpoijfeoifhiwruvzuztdrtsredrewsrewqwpiojdcocycyxcmnyxbcnmb.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_logpr"  and !$edttxt=="")
{
$prvs[1]="(ulo�eno)";
$dot_s="l_s_p_qwpoijfeoifhiwruvzuztdrtsredrewsrewqwpiojdcocycyxcmnyxbcnmb.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_logpr" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_ban")
{
$prvs[2]="(otev�eno)";
$dot_s="ban_qpwjfiowejhvurhvasocjsoiuhciuwrcizwrciuwrnizrbvzeurnbvwizuvvwrzrubc.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($pvas=="s_ban"  and !$edttxt=="")
{
$prvs[2]="(ulo�eno)";
$dot_s="ban_qpwjfiowejhvurhvasocjsoiuhciuwrcizwrciuwrnizrbvzeurnbvwizuvvwrzrubc.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($pvas=="s_ban" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_akt")
{
$prvs[3]="(otev�eno)";
$dot_s="aktuality_upravovani_qpwrijoiweuhrfgvuirhbiuvnuivwrezvbwriufniuowr.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($pvas=="s_akt"  and !$edttxt=="")
{
$prvs[3]="(ulo�eno)";
$dot_s="aktuality_upravovani_qpwrijoiweuhrfgvuirhbiuvnuivwrezvbwriufniuowr.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($pvas=="s_akt" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_dat")
{
$prvs[4]="(otev�eno)";
$dot_s="datum_akualizace_pqjiowuvuirwnbvizuwefoijwiurvnruifnwuirbviurenbvzwr.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($pvas=="s_dat"  and !$edttxt=="")
{
$prvs[4]="(ulo�eno)";
$dot_s="datum_akualizace_pqjiowuvuirwnbvizuwefoijwiurvnruifnwuirbviurenbvzwr.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($pvas=="s_dat" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_otvank")
{
$prvs[6]="(otev�eno)";
$dot_s="otz_na_ak_ket_e_qpefjwroifhiufhiuehcuwehfoiwefuorhgwrjfoijeoijweoifjwojfowrhgweokfhiruvhwroijf.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($pvas=="s_otvank"  and !$edttxt=="")
{
$prvs[6]="(ulo�eno)";
$dot_s="otz_na_ak_ket_e_qpefjwroifhiufhiuehcuwehfoiwefuorhgwrjfoijeoijweoifjwojfowrhgweokfhiruvhwroijf.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($pvas=="s_otvank" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_fro")
{
$prvs[7]="(otev�eno)";
$dot_s="vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_fro"  and !$edttxt=="")
{
$prvs[7]="(ulo�eno)";
$dot_s="vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_fro" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_lfo")
{
$prvs[8]="(otev�eno)";
$dot_s="l_s_p_f_qwifojhwizuvbuefnviufgwfzfrzuhfrzutohfrzuhiuwefiuwqpqppqpoejfirjguhrvuwefehv.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_lfo"  and !$edttxt=="")
{
$prvs[8]="(ulo�eno)";
$dot_s="l_s_p_f_qwifojhwizuvbuefnviufgwfzfrzuhfrzutohfrzuhiuwefiuwqpqppqpoejfirjguhrvuwefehv.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_lfo" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_odpvank")
{
$prvs[9]="(otev�eno)";
$dot_s="n_ot_v_an_ke_t_e_qpwjeoiwfhiuhbviuwrnvuerbniuwnvnebiuwhnruivreuhfjhreoiuhoiwrejhf.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,10000000);
fclose($doss);
}//end if nacti

if($pvas=="s_odpvank"  and !$edttxt=="")
{
$prvs[9]="(ulo�eno)";
$dot_s="n_ot_v_an_ke_t_e_qpwjeoiwfhiuhbviuwrnvuerbniuwnvnebiuwhnruivreuhfjhreoiuhoiwrejhf.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,10000000);
fclose($doss);
}
else
{
if($pvas=="s_odpvank" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_prk")
{
$prvs[10]="(otev�eno)";
$dot_s="l_s_lg_d_kn_qpfkcjsoadcnunvzrebwesiuvasizvbsizcvaeufnuquwhuienczagfcviuahqpcjaducvnzbcvizcaiucb.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_prk"  and !$edttxt=="")
{
$prvs[10]="(ulo�eno)";
$dot_s="l_s_lg_d_kn_qpfkcjsoadcnunvzrebwesiuvasizvbsizcvaeufnuquwhuienczagfcviuahqpcjaducvnzbcvizcaiucb.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_prk" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_dbk")
{
$prvs[11]="(otev�eno)";
$dot_s="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_dbk"  and !$edttxt=="")
{
$prvs[11]="(ulo�eno)";
$dot_s="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_prk" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_aktD")
{
$prvs[12]="(otev�eno)";
$dot_s="aktuality_skrypt_DB_odkazy_po_str_aoisdhncoasdnqpojfuiszvsfhcnivuisnvisbviusdhhfvisdhuvdvwsd.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_aktD"  and !$edttxt=="")
{
$prvs[12]="(ulo�eno)";
$dot_s="aktuality_skrypt_DB_odkazy_po_str_aoisdhncoasdnqpojfuiszvsfhcnivuisnvisbviusdhhfvisdhuvdvwsd.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_aktD" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_lgchknh")
{
$prvs[13]="(otev�eno)";
$dot_s="log_fu_n_kni_ho_vn_yy_qpowfjwiuvnruiwvhwjnvuwrhviuzrfuiwjnuvnrwuifwiejfurehguiwhviznwfoujnwrouvhwruof.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_lgchknh"  and !$edttxt=="")
{
$prvs[13]="(ulo�eno)";
$dot_s="log_fu_n_kni_ho_vn_yy_qpowfjwiuvnruiwvhwjnvuwrhviuzrfuiwjnuvnrwuifwiejfurehguiwhviznwfoujnwrouvhwruof.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_lgchknh" and $edttxt==""){$obsah="";}
}//end if uloz


if($pvas=="l_hlvankt")
{
$prvs[14]="(otev�eno)";
$dot_s="s_an_ke_t_djkfcdnsjqwporjeoiwjuitgozhegnunvronvreilnmvsdimwimwpockmspidmvsdmpoimpcmwpoemf.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_hlvankt"  and !$edttxt=="")
{
$prvs[14]="(ulo�eno)";
$dot_s="s_an_ke_t_djkfcdnsjqwporjeoiwjuitgozhegnunvronvreilnmvsdimwimwpockmspidmvsdmpoimpcmwpoemf.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_hlvankt" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="l_logank")
{
$prvs[15]="(otev�eno)";
$dot_s="lo_g_a_n_k_e_t_y_aodshpqwoefmnriunvoiefjveurnviueifjnvurenviuerhnviuhgiruhgiurhg.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end if nacti

if($pvas=="s_logank"  and !$edttxt=="")
{
$prvs[15]="(ulo�eno)";
$dot_s="lo_g_a_n_k_e_t_y_aodshpqwoefmnriunvoiefjveurnviueifjnvurenviuerhnviuhgiruhgiurhg.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($pvas=="s_logank" and $edttxt==""){$obsah="";}
}//end if uloz

if($pvas=="zaloha_1")
{
$prvs[0]="(z�lohov�no)";
copy($sob1,$sob1d);
$obsah="";
}//end zaloha

if($pvas=="zaloha_2")
{
$prvs[1]="(z�lohov�no)";
copy($sob2,$sob2d);
$obsah="";
}//end zaloha

if($pvas=="zaloha_3")
{
$prvs[2]="(z�lohov�no)";
copy($sob3,$sob3d);
$obsah="";
}//end zaloha

if($pvas=="zaloha_4")
{
$prvs[3]="(z�lohov�no)";
copy($sob4,$sob4d);
$obsah="";
}//end zaloha

if($pvas=="zaloha_5")
{
$prvs[4]="(z�lohov�no)";
copy($sob5,$sob5d);
$obsah="";
}//end zaloha

if($pvas=="sm_az")
{
$prvs[5]="(smaz�no)";
$obsah="";
}//end smaz

}
else
{
$obsah="";
}


echo
"<center>
<textarea rows=15 cols=80 name=memo>$obsah</textarea>
</center>

<table border=0 align=center cellpadding=0 cellspacing=10>

<tr>
<td>Logovac� soubor str�nek</td>
<td><a href=\"l_s_qpwoedjoweijfhsdjhvkjsnvijsnisufrhoireuhgiwjhgwrgnidfuvevowhfviuunviuentrvuirevizuehbiuenv.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_logst';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_logst';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[0]."</td>
<td><input type=button value=\"Z�lohovat\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='zaloha_1';men.poslat.click();\"></td>
<td><a href=\"$sob1d\" target=\"_blank\">Z�lohovan� soubor</a></td>
</tr>

<tr>
<td>Logovac� soubor p�ihla�ov�n�</td>
<td><a href=\"l_s_p_qwpoijfeoifhiwruvzuztdrtsredrewsrewqwpiojdcocycyxcmnyxbcnmb.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_logpr';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_logpr';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[1]."</td>
<td><input type=button value=\"Z�lohovat\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='zaloha_2';men.poslat.click();\"></td>
<td><a href=\"$sob2d\" target=\"_blank\">Z�lohovan� soubor</a></td>
</tr>

<tr>
<td>Banovan� �lenov� (bez mezer)</td>
<td><a href=\"ban_qpwjfiowejhvurhvasocjsoiuhciuwrcizwrciuwrnizrbvzeurnbvwizuvvwrzrubc.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_ban';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_ban';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[2]."</td>
<td><input type=button value=\"Z�lohovat\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='zaloha_3';men.poslat.click();\"></td>
<td><a href=\"$sob3d\" target=\"_blank\">Z�lohovan� soubor</a></td>
</tr>

<tr>
<td>Str�nky aktualit</td>
<td><a href=\"aktuality_upravovani_qpwrijoiweuhrfgvuirhbiuvnuivwrezvbwriufniuowr.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_akt';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_akt';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[3]."</td>
<td><input type=button value=\"Z�lohovat\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='zaloha_4';men.poslat.click();\"></td>
<td><a href=\"$sob4d\" target=\"_blank\">Z�lohovan� soubor</a></td>
</tr>

<tr>
<td>Odkazy po t�chto str�nk�ch - Akuality</td>
<td><a href=\"aktuality_skrypt_DB_odkazy_po_str_aoisdhncoasdnqpojfuiszvsfhcnivuisnvisbviusdhhfvisdhuvdvwsd.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_aktD';men.poslat.click();\"></td>logpr ban akt aktD
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_aktD';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[12]."</td>
<td><input type=button value=\"Z�lohovat\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='zaloha_4';men.poslat.click();\"></td>
<td><a href=\"$sob5d\" target=\"_blank\">Z�lohovan� soubor</a></td>
</tr>

<tr>
<td>Datum posledn� aktualizace</td>
<td><a href=\"datum_akualizace_pqjiowuvuirwnbvizuwefoijwiurvnruifnwuirbviurenbvzwr.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_dat';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_dat';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[4]."</td>
<td><input type=button value=\"Z�lohovat\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='zaloha_5';men.poslat.click();\"></td>
<td><a href=\"$sob5d\" target=\"_blank\">Z�lohovan� soubor</a></td>
</tr>

<tr>
<td>Vzkazy ve f�rum</td>
<td><a href=\"vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_fro';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_fro';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[7]."</td>
<td><input type=button disabled value=\"Z�lohovat\"></td>
</tr>

<tr>
<td>Logov�n� p��sp�vk� ve f�ra (bez mezer!)</td>
<td><a href=\"l_s_p_f_qwifojhwizuvbuefnviufgwfzfrzuhfrzutohfrzuhiuwefiuwqpqppqpoejfirjguhrvuwefehv.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_lfo';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_lfo';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[8]."</td>
<td><input type=button disabled value=\"Z�lohovat\"></td>
</tr>

<tr>
<td>Logov�n� p��stup� do knihovny</td>
<td><a href=\"l_s_lg_d_kn_qpfkcjsoadcnunvzrebwesiuvasizvbsizcvaeufnuquwhuienczagfcviuahqpcjaducvnzbcvizcaiucb.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_prk';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_prk';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[10]."</td>
<td><input type=button disabled value=\"Z�lohovat\"></td>
</tr>

<tr>
<td>Kn�ky v knihovn� (bez mezer!)</td>
<td><a href=\"DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_dbk';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_dbk';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[11]."</td>
<td><input type=button disabled value=\"Z�lohovat\"></td>
</tr>

<tr>
<td>Logov�n� chodu knihovny</td>
<td><a href=\"log_fu_n_kni_ho_vn_yy_qpowfjwiuvnruiwvhwjnvuwrhviuzrfuiwjnuvnrwuifwiejfurehguiwhviznwfoujnwrouvhwruof.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_lgchknh';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_lgchknh';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[13]."</td>
<td><input type=button disabled value=\"Z�lohovat\"></td>
</tr>

<tr>
<td>Ot�zka v anket�</td>
<td><a href=\"otz_na_ak_ket_e_qpefjwroifhiufhiuehcuwehfoiwefuorhgwrjfoijeoijweoifjwojfowrhgweokfhiruvhwroijf.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_otvank';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_otvank';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[6]."</td>
<td><input type=button disabled value=\"Z�lohovat\"></td>
</tr>

<tr>
<td>Odpov�di v anket�</td>
<td><a href=\"n_ot_v_an_ke_t_e_qpwjeoiwfhiuhbviuwrnvuerbniuwnvnebiuwhnruivreuhfjhreoiuhoiwrejhf.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_odpvank';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_odpvank';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[9]."</td>
<td><input type=button disabled value=\"Z�lohovat\"></td>
</tr>

<tr>
<td>Hlasy v anket�</td>
<td><a href=\"s_an_ke_t_djkfcdnsjqwporjeoiwjuitgozhegnunvronvreilnmvsdimwimwpockmspidmvsdmpoimpcmwpoemf.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_hlvankt';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_hlvankt';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[14]."</td>
<td><input type=button disabled value=\"Z�lohovat\"></td>
</tr>

<tr>
<td>Hlasy v anket�</td>
<td><a href=\"lo_g_a_n_k_e_t_y_aodshpqwoefmnriunvoiefjveurnviueifjnvurenviuerhnviuhgiruhgiurhg.php\" target=\"_blank\">Zobrazit</a></td>
<td><input type=button value=\"Otev��t\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='l_logank';men.poslat.click();\"></td>
<td><input type=button value=\"Ulo�it\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';men.pvas.value='s_logank';men.edttxt.value=memo.innerText;men.poslat.click();\"></td>
<td>".$prvs[15]."</td>
<td><input type=button disabled value=\"Z�lohovat\"></td>
</tr>

<tr>
<th colspan=5><input type=button value=\"Smazat obsah\" onclick=\"men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.ptx3.value='$ptx3';men.ptx4.value='$ptx4';men.kam.value='ajdimne';memo.innerText='';men.edttxt.value='';men.pvas.value='sm_az';men.poslat.click();\"></th>
<td>".$prvs[5]."</td>
</tr>

</table>";
*/
?>
