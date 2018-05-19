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
  <td align=center>Ostatní zajímavosti - obrázky</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style="border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;">
 <tr>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_h.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_h.jpg'"></td>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_ch.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_ch.jpg'"></td>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_i.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_i.jpg'"></td>
 </tr>
 <tr>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_j.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_j.jpg'"></td>
 </tr>
</table>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center><input type=image src="zpatky_tlacitko.gif" onclick="history.back()"></td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
