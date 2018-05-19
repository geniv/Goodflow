<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto stránky máte zákaz vstupu!!</h2>";
 exit;}
}

$sb_hes="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";             
$u=fopen($sb_hes,"r");
$udaj=explode("*-*-*",fread($u,1000000));
fclose($u);

//zjištìní èísla dle IP
if($pristp!=0)
{
$s_pucc="puc".$pristp."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"r");
$cuuz=fread($u,100);
fclose($u);
}
else
{$cuuz=0;}

if($cuuz!=0)
{
echo "
<table border=0 align=center>
<tr>
<th colspan=2>Editace udajù</th>
</tr>
<tr>
<td>Jméno: </td>
<td><input type=text name=jmeno value=\"".$udaj[$cuuz]."\" size=39></td>
</tr>
<tr>
<td>Oslovení </td>
<td><input type=text name=osl value=\"".$udaj[$cuuz+2]."\" size=39></td>
</tr>
<tr>
<td>Email: </td>
<td><input type=text name=ema value=\"".$udaj[$cuuz+3]."\" size=39></td>
</tr>
<tr>
<td>Heslo: </td>
<td><input type=password name=hes1><input type=button value=\"Stávající heslo\" onclick=\"alert('".$udaj[$cuuz+1]."')\"><br><input type=password name=hes2><input type=button disabled value=\"Zmìnit za nové\"></td>
</tr>
<tr>
<td>Web: </td>
<td><input type=text name=web value=\"".$udaj[$cuuz+4]."\" size=39></td>
</tr>
<tr>
<td>ICQ: </td>
<td><input type=text name=icq value=\"".$udaj[$cuuz+5]."\" size=39></td>
</tr>
<tr>
<th colspan=2><input type=button disabled value=\"Uložit\"></th>
</tr>
</table>";
}
else
{
 print "<br><br><br><br><br><br><br><br><h2 align=center>Bez hesla nemáte právo pro pøístup na tuto stránku!!</h2>";
}
?>
