<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto stránky máte zákaz vstupu!!</h2>";
 exit;}
}
//kontrola údajů
//počítadlo účastníků
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Registrace</title>
<META http-equiv="Content-Type"content="text/html; charset=windows-1250">
</head>
<br><br><br><br><br>
<form method=post>
<table border=0 align=center>

<tr>
<td>Jméno: (Nick)</td>
<td><input type=text name=regjmen>*</td>
</tr>

<tr>
<td>Heslo:</td>
<td><input type=password name=reghes1>*</td>
</tr>

<tr>
<td>Kontrola hesla:</td> 
<td><input type=password name=reghes2>*</td>
</tr>

<tr>
<td>Email:</td>
<td><input type=text value="@" name=regem>*</td>
</tr>

<tr>
<td>Oslovení: (Dobrý den...)</td>
<td><input type=text name=osl value="Člověče"></td>
</tr>

<tr>
<td>WWW stránky:</td>
<td><input type=text name=webs value="www..cz"></td>
</tr>

<tr>
<td>ICQ:</td>
<td><input type=text name=icqs></td>
</tr>

<tr>
<th colspan=2><input type=submit value="Zaregistruj se"></th>
</tr>
</table>
</form>
<center>* = povinné udaje!!</center>
<?
if(!Empty($regjmen) and !Empty($reghes1) and !Empty($reghes2) and !Empty($regem))
{
if($reghes1<>$reghes2)
{
print "<h2 align=center>Špatné kontrolní heslo</h2>";
}
else
{
$sb_hes="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";             
$u=fopen($sb_hes,"r");
$reg=explode("*-*-*",fread($u,1000000));
fclose($u);

$pp1=0;
for($p=0;$p<count($reg);$p++)
{
if($reg[$p]==$regjmen and $reg[$p]!=""){$pp1++;}//kontrola jména
if($reg[$p]==$reghes1 and $reg[$p]!=""){$pp1++;}//kontrola hesla
if($reg[$p]==$regem and $reg[$p]!=""){$pp1++;}//kontrola emailu
//if($reg[$p]==$osl and $reg[$p]!=""){$pp1++;}
//if($reg[$p]==$webs and $reg[$p]!=""){$pp1++;}
//if($reg[$p]==$icqs and $reg[$p]!=""){$pp1++;}
}
//print $pp1;
if($pp1==0)
{//první zalogování novéého klienta
$uklhs="Zaregistroval se: <b>".$regjmen."</b>, s Emailem: <b>".$regem."</b> , s heslem: <b>".$reghes1."</b> , dále má: ".$webs." , ".$icqs." , ".$osl." z IP adresy: ".$REMOTE_ADDR." , v: ".Date("H:i:s j.m. Y")."<br>\n";
$novh="now_hes_esjkhfceisjfiuehfoihwoidhwdaqwfpojovijhrfvwevolj.php";
$uns=fopen($novh,"a+");
fwrite($uns,$uklhs);
fclose($uns);

$jm_succ="poctrge_ucc_dsjhvhqwpolkajfklkhduizgttfgtdzddcxnvbvgztqrdqduzeeeeepieuf.php";
$u=fopen($jm_succ,"r+");
$cisk=fread($u,1000);
rewind($u);
fwrite($u,++$cisk);
fclose($u);//číslo účastníka

$sb_hes="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";             
$u=fopen($sb_hes,"r");
$reg=explode("*-*-*",fread($u,1000000));
fclose($u);

//dosazení pozice
$noj=count($reg)+1;//jméno
$noh=count($reg)+2;//heslo
$no1=count($reg)+3;//oslovení
$no2=count($reg)+4;//Email
$no3=count($reg)+5;//web
$no4=count($reg)+6;//icq
$no5=count($reg)+7;//osobní číslo, zároveň se ukládá i do souboru

//dosazení proměnných
$reg[$noj]=$regjmen;
$reg[$noh]=$reghes1;
$reg[$no1]=$osl;
$reg[$no2]=$regem;
$reg[$no3]=$webs;
$reg[$no4]=$icqs;
$reg[$no5]=$cisk;

$sb_hes="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($reg,"*-*-*"));
fclose($u);

print "<h2 align=center>Váš požadavek byl odeslán a zpracován. O registraci budete informováni e-mailem.</h2>";
mail($regem,"Potvrzení registrace","Jste zaregistrováni pod jménem: ".$regjmen."\nHeslem: ".$reghes1."\na Emailem: ".$regem);
mail("geniv@centrum.cz","Registrace klienta","Zaregistroval se klient: ".$regjmen." , \ns emailem: ".$regem."\ns heslem: ".$reghes1."\nv: ".Date("H:i:s j.m. Y")." \nz IP: ".$REMOTE_ADDR);
}//end kontrola udaju
else
{
print "Některý z těchto údajů již existuje!";
}
}//end if hes1=hes2
}//end empty
?>
