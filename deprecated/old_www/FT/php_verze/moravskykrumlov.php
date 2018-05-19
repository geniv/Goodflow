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
<?
$sr_uz="regr_uz_kjdscnjnikjafajfvsoiudhvuihaSDVsgasdfhjkndihuafuh.php";
$uk=fopen($sr_uz,"r");
$reg=explode("*r*",fread($uk,1000000));
fclose($uk);

$pc=0;

if(Empty($pridrzjme) and Empty($pridrzhes))
{
$pridrzjme="";
$pridrzhes="";
}//end empty

for($p1=0;$p1<count($reg);$p1++)
{
if($reg[$p1]==$pridrzjme and $reg[$p1+1]==$pridrzhes){$pc++;}//rovná-li se pøiète se 1.
}   //end for

if($pc==1)
{
echo                      //do další podsekce!!!
"
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>Projekt - Moravský Krumlov - nádražní budova</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_projekty_stavba/obr_nahled/stavba_moravsky_krumlov_a.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_projekty_stavba/obr_projekty/stavba_moravsky_krumlov_a.gif'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_projekty_stavba/obr_nahled/stavba_moravsky_krumlov_b.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_projekty_stavba/obr_projekty/stavba_moravsky_krumlov_b.gif'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_projekty_stavba/obr_nahled/stavba_moravsky_krumlov_c.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_projekty_stavba/obr_projekty/stavba_moravsky_krumlov_c.gif'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_projekty_stavba/obr_nahled/stavba_moravsky_krumlov_d.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_projekty_stavba/obr_projekty/stavba_moravsky_krumlov_d.gif'\"></td>
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
<SCRIPT LANGUAGE=javascript>
function dopl()
{
men.pridrzjme.value=\"$pridrzjme\"; 
men.pridrzhes.value=\"$pridrzhes\";
}
</SCRIPT>
<body onload=\"dopl();\"></body>
";
}
else
{
print "Sem mají pøístup jen zaregistrovaní uživatelé";
}//end if pc
?>
