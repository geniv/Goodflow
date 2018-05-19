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
//poèítání--------------------------------------
$pocso="pocet_zobrazeni_historie-novinky_kfnsjfnjflsdngjksdbfgksadnsdgnsdflkgdsgdsfs.php";
$upp=fopen($pocso,"r+");
$pop=fread($upp,10);
rewind($upp);
fwrite($upp,++$pop,10);
fclose($upp);                        
?>
<title>Historie novinek na Fugess Trainz CZ</title>
<style>
body,table,center
{
background: #A8ACB8;
font-family: Trebuchet MS, Courier, Courier New, sans-serif, verdana;
font-size: 14px;
font-weight: bold;
color: black;
}
#vel_a
{
text-decoration: underline;
font-size: 16px;
}
#vel_b
{
font-size: 12px;
}
#vel_c
{
font-size: 10px;
}
#vel_d
{
font-size: 9px;
}
#vel_e
{
font-size: 12px;
background: #B6BCC3;
}
#vel_ank_a
{
font-size: 12px;
}
#otz_odp_barv
{
color: navy;
}
#otz_odp_barv_a
{
color: #004080;
}
#nav_kni_barv
{
color: #5A5A5A;
}
#barv_tab_poz
{
background: #B6BCC3;
}
#podt_v_as
{
text-decoration: underline;
color: blue;
}
#upoz_ota_nav
{
text-decoration: overline underline;
color: maroon;
}
#gal_vi_down
{
text-decoration: underline;
color: blue;
cursor: hand;
font-size: 12px;
background: #B6BCC3;
}
#uvod_info_ozn
{
text-decoration: underline;
}
#down_aktualiz
{
color: navy;
text-decoration: underline;
}
</style>
<table border=0 cellpadding=0 cellspacing=6 align=center>
 <tr>
  <td align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td align=center id=vel_a>Historie novinek</td>
 </tr>
 <tr>
  <td align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td>
   <table border=0 cellpadding=0 cellspacing=0 align=center>
    <tr>
     <td colspan=8><img src="novinka_vrsek.gif"></td>
    </tr>
    <tr>
     <td align=left><img src="novinka_levy.gif"></td>
     <td><img src="novinka_ikona_max.gif"></td>
     <td align=left>02.01.2007</td>
     <td align=center>&nbsp;</td>
     <td align=center>-</td>
     <td align=center>&nbsp;</td>
     <td><div style="width:430px;">Pøidán videonávod - <span id=uvod_info_ozn>Jak vytvoøit jednoduchou animaci</span></div></td>
     <td align=right><img src="novinka_pravy.gif"></td>
    </tr>
    <tr>
     <td colspan=8><img src="novinka_spodek.gif"></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
   <table border=0 cellpadding=0 cellspacing=0 align=center>
    <tr>
     <td colspan=8><img src="novinka_vrsek.gif"></td>
    </tr>
    <tr>
     <td align=left><img src="novinka_levy.gif"></td>
     <td><img src="novinka_ikona_max.gif"></td>
     <td align=left>01.01.2007</td>
     <td align=center>&nbsp;</td>
     <td align=center>-</td>
     <td align=center>&nbsp;</td>
     <td><div style="width:430px;">Pøidán objekt - <span id=uvod_info_ozn>Lamelový billboard</span></div></td>
     <td align=right><img src="novinka_pravy.gif"></td>
    </tr>
    <tr>
     <td colspan=8><img src="novinka_spodek.gif"></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
   <table border=0 cellpadding=0 cellspacing=0 align=center>
    <tr>
     <td colspan=8><img src="novinka_vrsek.gif"></td>
    </tr>
    <tr>
     <td align=left><img src="novinka_levy.gif"></td>
     <td><img src="novinka_ikona_trs.gif"></td>
     <td align=left>27.12.2006</td>
     <td align=center>&nbsp;</td>
     <td align=center>-</td>
     <td align=center>&nbsp;</td>
     <td><div style="width:430px;">Spraveno automatické pøihlašování</div></td>
     <td align=right><img src="novinka_pravy.gif"></td>
    </tr>
    <tr>
     <td colspan=8><img src="novinka_spodek.gif"></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
   <table border=0 cellpadding=0 cellspacing=0 align=center>
    <tr>
     <td colspan=8><img src="novinka_vrsek.gif"></td>
    </tr>
    <tr>
     <td align=left><img src="novinka_levy.gif"></td>
     <td><img src="novinka_ikona_trs.gif"></td>
     <td align=left>27.12.2006</td>
     <td align=center>&nbsp;</td>
     <td align=center>-</td>
     <td align=center>&nbsp;</td>
     <td><div style="width:430px;">Pøidána nová anketa</div></td>
     <td align=right><img src="novinka_pravy.gif"></td>
    </tr>
    <tr>
     <td colspan=8><img src="novinka_spodek.gif"></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
   <table border=0 cellpadding=0 cellspacing=0 align=center>
    <tr>
     <td colspan=8><img src="novinka_vrsek.gif"></td>
    </tr>
    <tr>
     <td align=left><img src="novinka_levy.gif"></td>
     <td><img src="novinka_ikona_trs.gif"></td>
     <td align=left>26.12.2006</td>
     <td align=center>&nbsp;</td>
     <td align=center>-</td>
     <td align=center>&nbsp;</td>
     <td><div style="width:430px;"><span id=uvod_info_ozn>Oznámení:</span>&nbsp;Objevily se zde problémy s registrací a proto je tu</div></td>
     <td align=right><img src="novinka_pravy.gif"></td>
    </tr>
    <tr>
     <td align=left><img src="novinka_levy.gif"></td>
     <td align=center>&nbsp;</td>
     <td align=center>&nbsp;</td>
     <td align=center>&nbsp;</td>
     <td align=center>&nbsp;</td>
     <td align=center>&nbsp;</td>
     <td><div style="width:430px;"><a href="clanek_-_problemy_s_registraci_na_fugess_trainz_cz.php" target="_blank">Èlánek</a> pro všechny zaregistrované i neregistrované uživatele</div></td>
     <td align=right><img src="novinka_pravy.gif"></td>
    </tr>
    <tr>
     <td colspan=8><img src="novinka_spodek.gif"></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
   <table border=0 cellpadding=0 cellspacing=0 align=center>
    <tr>
     <td colspan=8><img src="novinka_vrsek.gif"></td>
    </tr>
    <tr>
     <td align=left><img src="novinka_levy.gif"></td>
     <td><img src="novinka_ikona_trs.gif"></td>
     <td align=left>24.12.2006</td>
     <td align=center>&nbsp;</td>
     <td align=center>-</td>
     <td align=center>&nbsp;</td>
     <td><div style="width:430px;">Aktualizován nový vzhled s novými funkcemi</div></td>
     <td align=right><img src="novinka_pravy.gif"></td>
    </tr>
    <tr>
     <td colspan=8><img src="novinka_spodek.gif"></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td id=vel_b align=center>Prohlíželo <? print $pop ?> lidí</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td align=center><input type=image src="zpatky_tlacitko.gif" onclick="window.close()"></td>
 </tr>
</table>
