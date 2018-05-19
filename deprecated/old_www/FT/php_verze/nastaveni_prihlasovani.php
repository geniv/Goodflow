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
<body onload="vyp();"></body>
<SCRIPT LANGUAGE=javascript>
function vyp()
{
ttu.value=ReadCookie('aut','',24*365);
if(ttu.value=='goojdi'){atu.checked=true;}
if(atu.checked)
{
me_te.innerText='Vypnout';
}
else
{
me_te.innerText='Zapnout';
}
}
function kl()
{
if(atu.checked)
{
ttu.value='goojdi';
me_te.innerText='Vypnout';
}
else
{
ttu.value='';
me_te.innerText='Zapnout';
}
}
function zap()
{
WriteCookie('aut',ttu.value,24*365);
}
</SCRIPT>
<?
echo                      //do další podsekce!!!
"
<table border=0 cellpadding=0 cellspacing=0 align=center>
 <tr>
  <td align=center>Nastavení pøihlašování Vašeho úètu</td>
 </tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 align=center>
 <tr>
  <td align=center colspan=5>&nbsp;</td>
 </tr>
 <tr>
  <td id=vel_b><span id=me_te></span>&nbsp;automatické pøihlašování do všech sekcí pro registrované uživatele</td>
  <td align=center>&nbsp;</td>
  <td align=center>-</td>
  <td align=center>&nbsp;</td>
  <td id=vel_b><input type=checkbox name=atu onclick=\"kl();zap();vyp();\"><input type=hidden name=ttu></td>
 </tr>
 <tr>
  <td align=center colspan=5>&nbsp;</td>
 </tr>
</table>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center><input type=image src=\"zpatky_tlacitko.gif\" onclick=\"history.back()\"></td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
";
?>
