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
<title>Registrace na Fugess Trainz CZ</title>
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
font-size: 20px;
}
#vel_b
{
font-size: 12px;
}
</style>
<form method=post>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center id=vel_a>Registrace</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center id=vel_b>Zaregistrov�n�m z�sk�te p��stup do sekc�:</td>
</tr>
<tr>
<td colspan=3 align=center id=vel_b>Galerie, 3D Galerie, Video Galerie, 3D Animace a Modelov� �eleznice</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td align=right>Jm�no:</td>
<td>&nbsp;</td>
<td align=left><input type=text name=regjmen>*</td>
</tr>
<tr>
<td align=right>E-mail:</td>
<td>&nbsp;</td>
<td align=left><input type=text name=regem value="@">*</td>
</tr>
<tr>
<td align=right>Heslo:</td>
<td>&nbsp;</td>
<td align=left><input type=password name=reghes1>*</td>
</tr>
<tr>
<td align=right>Kontrola hesla:</td>
<td>&nbsp;</td>
<td align=left><input type=password name=reghes2>*</td>
</tr>
<tr>
<td align=right>WWW str�nky:</td>
<td>&nbsp;</td>
<td align=left><input type=text name=webs value="http://"></td>
</tr>
<tr>
<td align=right>ICQ:</td>
<td>&nbsp;</td>
<td align=left><input type=text name=icqs></td>
</tr>
<tr>
<td align=right>&nbsp;</td>
<td>&nbsp;</td>
<td align=left><input type=submit value="Potvrdit registraci"></td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center>* - povinn� �daje</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
</table>
</form>
<?
if(!Empty($regjmen) and !Empty($reghes1) and !Empty($reghes2) and !Empty($regem))
{
if($reghes1<>$reghes2)
{
print "<table border=0 align=center valign=top cellspacing=0 cellpadding=0><tr><td align=center id=vel_a>�patn� kontroln� heslo</td></tr></table>";
}
else
{
$uklhs="Chce se zaregistrovat: <b>".$regjmen."</b><br>s E-mailem: <b>".$regem."</b><br>s heslem: <b>".$reghes1."</b><br>Jeho web: ".$webs."<br>Jeho ICQ: ".$icqs."<br>z IP adresy: ".$REMOTE_ADDR."<br>v: ".Date("H:i:s j.m. Y")."<br><br>\n"; //pro admina do log souboru
$novh="now_hes_reg_sdfhoiuhoqijwdpwqpijfsvnvknsjdnsdkjhedcc.php";
$uns=fopen($novh,"a+");
fwrite($uns,$uklhs);
fclose($uns);
print "<table border=0 align=center valign=top cellspacing=0 cellpadding=0><tr><td align=center id=vel_a>V� po�adavek na registraci byl zaznamen�n. N�sledn� na to V�m byl zasl�n e-mail s ozn�men�m, �e V� po�adavek byl zaznamen�n v datab�zi. Do 24 hodin V�m bude zasl�n druh� e-mail s potvrzen�m Va�� registrace.</td></tr></table>";
mail($regem,"Registrace - Fugess-Trainz-CZ","Dobr� den, Va�e ��dost o registraci na Fugess Trainz CZ byla zaznamen�na. Do 24 hodin bude registrace potvrzena. Pros�m vy�kejte na potvrzovac� e-mail. D�kuji, Fugess."); //pro klienta
mail("fugess@trainz.cz","��dost o registraci na Fugess.Trainz.CZ: ","Registruje se klient: ".$regjmen." \ns emailem: ".$regem."\ns heslem: ".$reghes1."\nv: ".Date("H:i:s j.m. Y")." \nz IP: ".$REMOTE_ADDR); //pro admina na email
}//end if hes1=hes2
}//end empty
?>
