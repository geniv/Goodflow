<?
//konstanty     if(Empty($kam)){$kam="";}
$dil="<img src=\"dil.gif\">";
//otázka
$s_otz="otz_na_ak_ket_e_qpefjwroifhiufhiuehcuwehfoiwefuorhgwrjfoijeoijweoifjwojfowrhgweokfhiruvhwroijf.php";
$uk=fopen($s_otz,"r");
$otazka=fread($uk,100000);
fclose($uk);
//odpovìdi
$s_odp="n_ot_v_an_ke_t_e_qpwjeoiwfhiuhbviuwrnvuerbniuwnvnebiuwhnruivreuhfjhreoiuhoiwrejhf.php";
$uk=fopen($s_odp,"r");
$odpovedi=explode("--od--",fread($uk,100000));//naètení z pole
fclose($uk);
//hlasy
$so_an="s_an_ke_t_djkfcdnsjqwporjeoiwjuitgozhegnunvronvreilnmvsdimwimwpockmspidmvsdmpoimpcmwpoemf.php";
$uk=fopen($so_an,"r");
$dilku=explode("--h--",fread($uk,5000));//naètení z pole
fclose($uk);

if(!Empty($ank))
{
for($i=1;$i<count($odpovedi);$i++)
{
if($ank=="hlno$i"){$hlasovano=$odpovedi[$i];}
}//end for
$lg="kliknuto na <b>$ank</b> ($hlasovano) v sekci <i>$kam</i>, pøedchozí adresa: <b>{$dilku[0]}</b>, v: ".Date("H:i:s j.m. Y")." z IP: <b>$REMOTE_ADDR</b><br>\n";
$s_lop="lo_g_a_n_k_e_t_y_aodshpqwoefmnriunvoiefjveurnviueifjnvurenviuerhnviuhgiruhgiurhg.php";
$u=fopen($s_lop,"a+");
fwrite($u,$lg);
fclose($u);
}
if(!Empty($ank) and $dilku[0]!=$REMOTE_ADDR)
{
for($i=1;$i<count($odpovedi);$i++)
{
if($ank=="hlno$i"){$dilku[$i]++;}
}//end for

for($i=1;$i<count($odpovedi);$i++)
{
if($ank=="hlno$i"){$dilku[0]=$REMOTE_ADDR;}
}//end for

$uk=fopen($so_an,"w");
fwrite($uk,implode($dilku,"--h--"));
fclose($uk);
}

$celkem=0;
$celkemupr=0;
for($i=1;$i<count($dilku);$i++)
{
$celkem+=$dilku[$i];
}
//procentuálnní pomìr
$pr[]=0;
for($i=1;$i<count($odpovedi);$i++)
{
if($celkem!=0)
{
$pr[$i]=round((($dilku[$i]*100)/$celkem),1);
}
else
{
$pr[$i]=0;
}
}//end for

echo
"<table border=0 cellpadding=0 cellspacing=0>
<tr>
<td><img src=\"hoa.jpg\"></td>
</tr>
<tr>
<th bgcolor=\"#99CBFE\">$otazka</th>
</tr>";
for($i=1;$i<count($odpovedi);$i++)
{
echo 
"<tr>
<td bgcolor=\"#99CBFE\"><span style=\"cursor:hand;\" onclick=\"men.ank.value='hlno$i';men.kam.value='$kam';men.poslat.click();\">{$odpovedi[$i]}</span></td>
</tr>
<tr>
<td bgcolor=\"#99CBFE\">";
for($i1=1;$i1<$dilku[$i]+1;$i1++)
{
print $dil;//vykreslování poètu dílkù
}
print
" {$pr[$i]} %
</td>
</tr>";
}
echo 
"<tr>
<td bgcolor=\"#99CBFE\">Poèet hlasujících: <b>$celkem</b></td>
</tr>
<tr>
<td><img src=\"doa.jpg\"></td>
</tr>
</table>";
?>
