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
<td align=center>Poèítadla</td>
</tr>
<tr>
<td align=center>&nbsp;</td>
</tr>
</table>
<?
$s_dow="dovnloud_ihsiLKDJDcnnNvjndfjksddpjfdpjhmxkmxaufazufgkjclc.php";
$ukz=fopen($s_dow,"r");
$dow=explode("*+*",fread($ukz,10000));
fclose($ukz);

$s_nav="navody_poc_ujacaiohcaoishuhaqwfoijjiufhdiujhuifzgbzvrhzuburjnsdojhnshgvvv.php";
$ukz=fopen($s_nav,"r");
$nav=explode("*+*",fread($ukz,10000));
fclose($ukz);

$s_vg="video_gal_dflknvalkqpojqwpofjfknbjlyvlknsdvinsoidnviosdnbvsrsiovnbsoivg.php";
$ukz=fopen($s_vg,"r");
$vig=explode("*+*",fread($ukz,10000));
fclose($ukz);

$naz[0]="Geniv Config Creator";
$naz[1]="Rodinný dùm";
$naz[2]="Pøíslušenství k zahradì";
$naz[3]="Poldi Hüte";
$naz[4]="Kaplièka - B";
$naz[5]="Kaplièka - A";
$naz[6]="Informaèní Tabule IDS JMK - Reskin";
$naz[7]="Informaèní Tabule IDS JMK";
$naz[8]="Chladící box na nápoje";
$naz[9]="Stavìdlo Holoubkov";
$naz[10]="Garáž - B";
$naz[11]="Garáž - A";
$naz[12]="Elektrické skøínì";
$naz[13]="Automat na lístky";
$naz[14]="Rudá hvìzda";
$naz[15]="Hasièská stanice";
$naz[16]="Øada reálných garáží";
$naz[17]="Sada pøedloh";
$naz[18]="Stanièník";
$naz[19]="Lampa";
$naz[20]="Lamelový billboard";
$naz[21]="Moravský Krumlov";

$naz1[0]="Jak zjistit polygony v gmaxu nebo tacs ?";
$naz1[1]="Návod jak postavit jednoduchý dùm";
$naz1[2]="Návod jak namapovat jednoduchý dùm";
$naz1[3]="Návod jak napsat config pro jednoduchý dùm";
$naz1[4]="Videonávod na jednoduchou animaci";

$nvg[0]="Capsule s modifikátorem melt";
$nvg[1]="Použití modifikátoru twist na cilindrech";
$nvg[2]="Použití modifikátorù twist a stretch";
$nvg[3]="Použití modifikátorù twist a taper";
$nvg[4]="Èásticové efekty - kouøící komín";
$nvg[5]="Gravitace a dynamické efekty s míèkem";
$nvg[6]="Generování objektu pomocí PArray";

print "<table border=0 align=center cellspacing=0 cellpadding=0>\n<tr>\n<td colspan=2 align=center>Sekce Download:</td>\n</tr>\n";
for($p1=count($naz)-1;$p1<>-1;$p1--)
{
echo "<tr><td align=right>".$naz[$p1]."&nbsp;&nbsp;-</td><td style=\"width:200\">&nbsp;&nbsp;".$dow[$p1]."x&nbsp;staženo</td></tr>\n";
}
print "</table>\n";

print "<table border=0 align=center cellspacing=0 cellpadding=0>\n<tr>\n<td colspan=2 align=center>&nbsp;</td>\n</tr>\n<tr>\n<td colspan=2 align=center>Sekce Návody:</td>\n</tr>\n";
for($p1=count($naz1)-1;$p1<>0-1;$p1--)
{
echo "<tr><td align=right>".$naz1[$p1]."&nbsp;&nbsp;-</td><td>&nbsp;&nbsp;".$nav[$p1]."x&nbsp;staženo</td></tr>\n";
}
print "</table>";

print "<table border=0 align=center cellspacing=0 cellpadding=0>\n<tr>\n<td colspan=2 align=center>&nbsp;</td>\n</tr>\n<tr>\n<td colspan=2 align=center>Sekce Video Galerie:</td>\n</tr>\n";
for($p1=0;$p1<count($nvg);$p1++)
{
echo "<tr><td align=right>".$nvg[$p1]."&nbsp;&nbsp;-</td><td>&nbsp;&nbsp;".$vig[$p1]."x&nbsp;staženo</td></tr>\n";
}
print "</table>";
?>
