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
<TABLE align=center border=0 cellspacing=0 cellpadding=0>
<TR><TD>
<form method=post name=men>
<img src=menu_a.gif><br>
<INPUT type=image src=menu_b.gif onclick="men.kam.value='uvod';"><br>
<INPUT type=image src=menu_c.gif onclick="men.kam.value='download';"><br>
<INPUT type=image src=menu_d.gif onclick="men.kam.value='navody';"><br>
<INPUT type=image src=menu_e.gif onclick="men.kam.value='galerie';"><br>
<INPUT type=image src=menu_f.gif onclick="men.kam.value='3dgalerie';"><br>
<INPUT type=image src=menu_g.gif onclick="men.kam.value='videogalerie';"><br>
<INPUT type=image src=menu_h.gif onclick="men.kam.value='3danimace';"><br>
<INPUT type=image src=menu_ch.gif onclick="men.kam.value='zajimavosti';"><br>
<INPUT type=image src=menu_i.gif onclick="men.kam.value='projekty';"><br>
<INPUT type=image src=menu_j.gif onclick="men.kam.value='modelovazeleznice';"><br>
<INPUT type=image src=menu_k.gif onclick="men.kam.value='ankety';"><br>
<INPUT type=image src=menu_l.gif onclick="men.kam.value='odpovedi';"><br>
<INPUT type=image src=menu_m.gif onclick="men.kam.value='navsteva';"><br>
<INPUT type=image src=menu_n.gif onclick="men.kam.value='pocitadla';"><br>
<INPUT type=image src=menu_o.gif onclick="men.kam.value='odkazy';"><br>
<INPUT type=image src=menu_p.gif onclick="men.kam.value='napistemi';"><br>
<INPUT type=image src=menu_q.gif onclick="men.kam.value='kontakt';"><br>
<img src=menu_r.gif><br>
<INPUT type=hidden name=kam>
<INPUT type=hidden name=down>
<INPUT type=hidden name=anke>
<INPUT type=hidden name=dota>
<INPUT type=hidden name=dotamejl>
<INPUT type=hidden name=dotajme>
<INPUT type=hidden name=infomejlod>
<INPUT type=hidden name=infomejlpred>
<INPUT type=hidden name=infomejltext>
<INPUT type=hidden name=ajm>
<INPUT type=hidden name=ahe1>
<INPUT type=hidden name=ahe2>
<INPUT type=hidden name=prik>
<INPUT type=hidden name=mobs>
<INPUT type=hidden name=logjm>
<INPUT type=hidden name=loghe>
<INPUT type=hidden name=pridrzjme>
<INPUT type=hidden name=pridrzhes>
<INPUT type=hidden name=emm>
<INPUT type=hidden name=emp>
<INPUT type=hidden name=emz>
<INPUT type=hidden name=kuk>
<INPUT type=hidden name=pca>
<INPUT type=reset value="" name=zrus style="visibility:hidden">
<INPUT type=submit value="" name=posl style="visibility:hidden">
</form>
</TD></TR>
<tr>
<td onclick="men.kam.value='admin';men.posl.click();">&nbsp;</td>
</tr>
</TABLE>
<? print "\n"; ?>
