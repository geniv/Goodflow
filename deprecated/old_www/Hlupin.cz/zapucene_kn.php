<?
require "funkce.php";

$bta1="skyblue";//zamluveno
$bta2="orange";
$bta3="lime";//vyp�j�eno
$bta4="red";

$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();
if((((count($kni)-1)/$del)+1)!=1)
{
echo 
"<table border=1 align=center cellpadding=0 cellspacing=2>
<tr>
<th>(Po�et knih)<br>Po�ad� dan� knihy</th>
<th>Autor</th>
<th>N�zev</th>
<th>Zamluveno (A/N)</th>
<th>Zap�j�eno (A/N)</th>
<th>Na jm�no</th>
</tr>";

$poc=0;
for($i=1;$i<((count($kni)-1)/$del)+1;$i++)
{
if($kni[($i*$del)-3]=="true")//zamluveno
{
$zamluvenoBarva=$bta1;
$zamluvenoText="Voln�";
}
else
{
$zamluvenoBarva=$bta2;
$zamluvenoText="Zamluven�";
}

if($kni[($i*$del)-1]=="true")//zap�j�eno
{
$zapujcenoBarva=$bta3;
$zapujcenoText="Voln�";
}
else
{
$zapujcenoBarva=$bta4;
$zapujcenoText="Zap�j�en�";
}

if(!Empty($kni[($i*$del)-2]))
{$jme=$kni[($i*$del)-2];}
else
{$jme="&nbsp;";}

if($kni[($i*$del)-3]=="false")
{
$poc++;
echo 
"<tr>
<th bgcolor=\"{$kni[($i*$del)]}\">($poc) - $i</th>
<td>{$kni[($i*$del)-4]}</td>
<td>{$kni[($i*$del)-5]}</td>
<th bgcolor=\"$zamluvenoBarva\">$zamluvenoText</th>
<th bgcolor=\"$zapujcenoBarva\">$zapujcenoText</th>
<td>$jme</td>
</tr>";
}//end if

}//end for
}//end empty
else
{print "��dn� knihy!";}

echo 
"</table>";
?>
