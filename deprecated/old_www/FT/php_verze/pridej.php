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
<table border=0 align=center cellspacing=2 cellpadding=0>
<tr>
<td colspan=2 align=center>Otázky a odpovìdi</td>
</tr>
<tr>
<td colspan=2 align=center id=vel_b>Zde napište jméno, e-mail a otázku</td>
</tr>
<tr>
<td colspan=2 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=2 align=center id=upoz_ota_nav>Anonymní pøíspìvky bez jména nebo pøezdívky budou bez varování smazány</td>
</tr>
<tr>
<td colspan=2 align=center>&nbsp;</td>
</tr>
</table>
<table border=0 align=center cellspacing=2 cellpadding=0>
<tr>
<td align=right>Jméno:&nbsp;</td>
<td><input type=text name=jme></td>
</tr>
<tr>
<td align=right>E-mail:&nbsp;</td>
<td><input type=text name=mejl value="@"></td>
</tr>
<tr>
<td align=right valign=top>Otázka:&nbsp;</td>
<td><textarea rows=10 cols=40 name=dt></textarea></td>
</tr>
<tr>
<th colspan=2><input type=button value="Pøidej otázku" onclick="men.dota.value=dt.value;men.dotamejl.value=mejl.value;men.dotajme.value=jme.value;men.kam.value='odpovedi';men.posl.click();"></th>
</tr>
</table>
