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
  <td align=center>Zábavné kreslené obrázky</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style="border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;">
 <tr>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_a.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_a.gif'"></td>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_b.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_b.gif'"></td>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_c.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_c.gif'"></td>
 </tr>
 <tr>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_d.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_d.gif'"></td>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_e.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_e.gif'"></td>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_f.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_f.gif'"></td>
 </tr>
 <tr>
  <td><input type=image src="obr_zajimavosti/obr_nahled/obr_zajimavosti_g.gif" onclick="location.href='obr_zajimavosti/obr_zajimavosti/obr_zajimavosti_g.gif'"></td>
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
