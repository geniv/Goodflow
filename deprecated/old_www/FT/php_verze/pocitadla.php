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
<td align=center>Po��tadla</td>
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
$naz[1]="Rodinn� d�m";
$naz[2]="P��slu�enstv� k zahrad�";
$naz[3]="Poldi H�te";
$naz[4]="Kapli�ka - B";
$naz[5]="Kapli�ka - A";
$naz[6]="Informa�n� Tabule IDS JMK - Reskin";
$naz[7]="Informa�n� Tabule IDS JMK";
$naz[8]="Chlad�c� box na n�poje";
$naz[9]="Stav�dlo Holoubkov";
$naz[10]="Gar� - B";
$naz[11]="Gar� - A";
$naz[12]="Elektrick� sk��n�";
$naz[13]="Automat na l�stky";
$naz[14]="Rud� hv�zda";
$naz[15]="Hasi�sk� stanice";
$naz[16]="�ada re�ln�ch gar��";
$naz[17]="Sada p�edloh";
$naz[18]="Stani�n�k";
$naz[19]="Lampa";
$naz[20]="Lamelov� billboard";
$naz[21]="Moravsk� Krumlov";

$naz1[0]="Jak zjistit polygony v gmaxu nebo tacs ?";
$naz1[1]="N�vod jak postavit jednoduch� d�m";
$naz1[2]="N�vod jak namapovat jednoduch� d�m";
$naz1[3]="N�vod jak napsat config pro jednoduch� d�m";
$naz1[4]="Videon�vod na jednoduchou animaci";

$nvg[0]="Capsule s modifik�torem melt";
$nvg[1]="Pou�it� modifik�toru twist na cilindrech";
$nvg[2]="Pou�it� modifik�tor� twist a stretch";
$nvg[3]="Pou�it� modifik�tor� twist a taper";
$nvg[4]="��sticov� efekty - kou��c� kom�n";
$nvg[5]="Gravitace a dynamick� efekty s m��kem";
$nvg[6]="Generov�n� objektu pomoc� PArray";

print "<table border=0 align=center cellspacing=0 cellpadding=0>\n<tr>\n<td colspan=2 align=center>Sekce Download:</td>\n</tr>\n";
for($p1=count($naz)-1;$p1<>-1;$p1--)
{
echo "<tr><td align=right>".$naz[$p1]."&nbsp;&nbsp;-</td><td style=\"width:200\">&nbsp;&nbsp;".$dow[$p1]."x&nbsp;sta�eno</td></tr>\n";
}
print "</table>\n";

print "<table border=0 align=center cellspacing=0 cellpadding=0>\n<tr>\n<td colspan=2 align=center>&nbsp;</td>\n</tr>\n<tr>\n<td colspan=2 align=center>Sekce N�vody:</td>\n</tr>\n";
for($p1=count($naz1)-1;$p1<>0-1;$p1--)
{
echo "<tr><td align=right>".$naz1[$p1]."&nbsp;&nbsp;-</td><td>&nbsp;&nbsp;".$nav[$p1]."x&nbsp;sta�eno</td></tr>\n";
}
print "</table>";

print "<table border=0 align=center cellspacing=0 cellpadding=0>\n<tr>\n<td colspan=2 align=center>&nbsp;</td>\n</tr>\n<tr>\n<td colspan=2 align=center>Sekce Video Galerie:</td>\n</tr>\n";
for($p1=0;$p1<count($nvg);$p1++)
{
echo "<tr><td align=right>".$nvg[$p1]."&nbsp;&nbsp;-</td><td>&nbsp;&nbsp;".$vig[$p1]."x&nbsp;sta�eno</td></tr>\n";
}
print "</table>";
?>
