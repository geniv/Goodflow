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
}//end if
}//end for       
?>
<table border=0 align=center cellspacing=0 cellpadding=0 width=640px>
<tr>
<td id=vel_a align=center>Návštìvní kniha</td>
</tr>
<tr>
<td align=center><hr size=1 color=white></td>
</tr>
<tr>
<td align=center><input type=button name=pridzp value="Napsat zprávu" onclick="men.kam.value='pridejzpravu';men.posl.click();"></td>
</tr>
<tr>
<td align=center><hr size=1 color=white></td>
</tr>
</table>
<table border=0 align=center cellspacing=0 cellpadding=0>
<?
if($dota && $dotajme && $dotamejl)
{
$dota="<tr><td><table border=0 align=left cellspacing=2 cellpadding=0 width=640px><tr><td valign=top align=right><u>Jméno</u>:</td><td><div style=width:580px;>".$dotajme."</td></tr><tr><td valign=top align=right><u>E-mail</u>:</td><td>".$dotamejl."</td></tr><tr><td valign=top align=right><u>Zpráva</u>:</td><td>".$dota."</td></tr><tr><td valign=top align=right><u>Zasláno</u>:</td><td><span id=nav_kni_barv>".Date("j.m.Y - H:i:s")."</span></td></tr><tr><td colspan=2><hr size=1 color=white></td></tr></table></td></tr>\n";
mail("fugess@trainz.cz","Pøidán dotaz","Vloženo:\nOd koho:".$dotajme."\n Email: ".$dotamejl."\nZpráva: ".$dota."; z IP: ".$REMOTE_ADDR."\n v: ".Date("H:i:s j.m. Y"));
if(!$soubor=fopen("nastevnikniha_kwkenfijrsngiualkfkwoiziowppogiusutiahjfwokknmafbccbbvnvann.php","a+"))
{
echo("Soubor nelze otevøít!");
}
else
{
if(!@fwrite($soubor,$dota))
echo("Chyba pøi zápisu do souboru!");
else
fclose($soubor);
}
}
if(File_Exists("nastevnikniha_kwkenfijrsngiualkfkwoiziowppogiusutiahjfwokknmafbccbbvnvann.php"))
{
$text=file("nastevnikniha_kwkenfijrsngiualkfkwoiziowppogiusutiahjfwokknmafbccbbvnvann.php");    // naètení do pole
while($dotz = Each($text))  //z dotz udìlá pole
 {
  print $dotz["value"];
 }
}
print "</table>";
?>
