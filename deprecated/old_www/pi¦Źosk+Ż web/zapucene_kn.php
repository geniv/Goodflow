<?
$bar1="#99ff99";
$bar2="#ffff00";
$bar3="#669900";
$bar4="#ff66ff";
$bta1="skyblue";//zamluveno
$bta2="orange";
$bta3="lime";//vypùjèeno
$bta4="red";
echo "
<table border=1 align=center cellpadding=0 cellspacing=2>
<tr>
<th>(Poèet knih)<br>Poøadí dané knihy</th>
<th>Autor</th>
<th>Název</th>
<th>Zamluveno (A/N)</th>
<th>Zapùjèeno (A/N)</th>
<th>Na jméno</th>
</tr>";

$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,1000000));
fclose($u);
$ppm=0;
$i1=0;
$jmk=0;
$stv="";
$blok="";
$blok1="";
$brzam="";
$brzap="";
for($i=0;$i<(count($kni)-1)/6;$i++)
{
$i1=$i1+8;
$ck=$i+1;
$jmk=(($i1-7)-($i*2))+3;
if($kni[(($i1-7)-($i*2))+2]=="true")//zamluvení
{
$stv="volná";
$blok="";
$blok1="disabled";//blok vydání pøed zamluvením
$brzam=$bta1;
}
else
{
$stv="zamluvená";
$blok="disabled";
$blok1="";//blok vydání
$brzam=$bta2;
}
if($kni[(($i1-7)-($i*2))+4]=="true")//pùjèení
{
$odn="V knihovnì";
$brzap=$bta3;
//$blok1="";
}
else
{
$odn="Zapùjèena";
$brzap=$bta4;
$blok1="disabled";
}
$pz="";//pozicování
if($kni[(($i1-7)-($i*2))+5]==$bar1){$pz="no1";}
if($kni[(($i1-7)-($i*2))+5]==$bar2){$pz="no2";}
if($kni[(($i1-7)-($i*2))+5]==$bar3){$pz="no3";}
if($kni[(($i1-7)-($i*2))+5]==$bar4){$pz="no4";}
if(!Empty($pozhlle) and $pozhlle=="true" and !Empty($nambr) and $nambr==$i+1){$pz="no5";}
if($kni[(($i1-7)-($i*2))+2]=="false" or $kni[(($i1-7)-($i*2))+4]=="false")
{
$ppm++;
echo 
"<tr>
<th bgcolor=".$kni[(($i1-7)-($i*2))+5].">($ppm) - <a name=\"$pz\"></a>$ck</th>
<td>".$kni[(($i1-7)-($i*2))+1]."</td>
<td>".$kni[($i1-7)-($i*2)]."</td>
<th bgcolor=\"$brzam\">$stv</th>
<th bgcolor=\"$brzap\">$odn</th>
<td><input type=text $blok size=10 value=".$kni[(($i1-7)-($i*2))+3]." name=zamljm$ck></td>
</tr>
";
}
}//end for
echo 
"</table>";
/*
<td><input type=button $blok name=zaml$ck value=\"Zamluvit\" onclick=\"men.kam.value='knihovna';men.zajm.value=zamljm$ck.value;men.czkn.value='$jmk';men.poslat.click();\"></td>
<td><input type=button $blok1 name=zaml$ck value=\"Vydat\" onclick=\"men.kam.value='knihovna';men.zajm.value=zamljm$ck.value;men.czkn.value='$jmk';men.vyp.value='vypuceno';men.poslat.click();\"></td>
<td><input type=button name=zaml$ck value=\"Vráceno\" onclick=\"men.kam.value='knihovna';men.zajm.value='nikdoAM';men.czkn.value='$jmk';men.poslat.click();\"></td>
*/
?>
