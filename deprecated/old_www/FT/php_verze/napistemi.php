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
?>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
<tr>
<td colspan=2 align=center>Napi�te mi:</td>
</tr>
<tr>
<td colspan=2 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=2 align=center>&nbsp;</td>
</tr>
<tr>
<td align=right>V� E-mail:</td>
<td><INPUT type=text name=od value="@"></td>
</tr>
<tr>
<td align=right>P�edm�t:</td>
<td><INPUT type=text name=pred></td>
</tr>
<tr>
<td align=right valign=top>Zpr�va:</td>
<td><TEXTAREA rows=8 cols=30 name=textik></TEXTAREA></td>
</tr>
<th colspan=2><INPUT type="button" value="Odeslat" onclick="men.infomejlod.value='Od: '+od.value;men.infomejlpred.value='P�edm�t: '+pred.value;men.infomejltext.value='Zpr�va: '+textik.innerText;men.kam.value='napistemi';men.posl.click();"></th>
</tr>
</table>
<?
print "\n";
if(!Empty($infomejlod)&& !Empty($infomejlpred) && !Empty($infomejltext))
{
$mej="fugess@trainz.cz";
$vzkaz=$infomejlod."\n".$infomejlpred."\n".$infomejltext.";\n";
mail($mej,"Napi�te mi",$vzkaz."; z IP: ".$REMOTE_ADDR."\n v: ".Date("H:i:s j.m. Y"));
echo
"
<table border=0 align=center CELLSPACING=0 CELLPADDING=0>
<tr>
<td colspan=2 align=center><u>Odesl�no</u></td>
</tr>

<tr>
<td align=right>Dne:&nbsp;</td>
<td>".Date("j.m.Y")."</td>

</tr>

<tr>
<td align=right>V �ase:&nbsp;</td>
<td>".Date("H:i:s")."</td>
</tr>

</table>
";
}
?>
