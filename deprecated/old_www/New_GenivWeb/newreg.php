<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto str�nky m�te z�kaz vstupu!!</h2>";
 exit;}
}
//kontrola �daj�
//po��tadlo ��astn�k�
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
<td>Jm�no: (Nick)</td>
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
<td>Osloven�: (Dobr� den...)</td>
<td><input type=text name=osl value="�lov��e"></td>
</tr>

<tr>
<td>WWW str�nky:</td>
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
<center>* = povinn� udaje!!</center>
<?
if(!Empty($regjmen) and !Empty($reghes1) and !Empty($reghes2) and !Empty($regem))
{
if($reghes1<>$reghes2)
{
print "<h2 align=center>�patn� kontroln� heslo</h2>";
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
if($reg[$p]==$regjmen and $reg[$p]!=""){$pp1++;}//kontrola jm�na
if($reg[$p]==$reghes1 and $reg[$p]!=""){$pp1++;}//kontrola hesla
if($reg[$p]==$regem and $reg[$p]!=""){$pp1++;}//kontrola emailu
//if($reg[$p]==$osl and $reg[$p]!=""){$pp1++;}
//if($reg[$p]==$webs and $reg[$p]!=""){$pp1++;}
//if($reg[$p]==$icqs and $reg[$p]!=""){$pp1++;}
}
//print $pp1;
if($pp1==0)
{//prvn� zalogov�n� nov��ho klienta
$uklhs="Zaregistroval se: <b>".$regjmen."</b>, s Emailem: <b>".$regem."</b> , s heslem: <b>".$reghes1."</b> , d�le m�: ".$webs." , ".$icqs." , ".$osl." z IP adresy: ".$REMOTE_ADDR." , v: ".Date("H:i:s j.m. Y")."<br>\n";
$novh="now_hes_esjkhfceisjfiuehfoihwoidhwdaqwfpojovijhrfvwevolj.php";
$uns=fopen($novh,"a+");
fwrite($uns,$uklhs);
fclose($uns);

$jm_succ="poctrge_ucc_dsjhvhqwpolkajfklkhduizgttfgtdzddcxnvbvgztqrdqduzeeeeepieuf.php";
$u=fopen($jm_succ,"r+");
$cisk=fread($u,1000);
rewind($u);
fwrite($u,++$cisk);
fclose($u);//��slo ��astn�ka

$sb_hes="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";             
$u=fopen($sb_hes,"r");
$reg=explode("*-*-*",fread($u,1000000));
fclose($u);

//dosazen� pozice
$noj=count($reg)+1;//jm�no
$noh=count($reg)+2;//heslo
$no1=count($reg)+3;//osloven�
$no2=count($reg)+4;//Email
$no3=count($reg)+5;//web
$no4=count($reg)+6;//icq
$no5=count($reg)+7;//osobn� ��slo, z�rove� se ukl�d� i do souboru

//dosazen� prom�nn�ch
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

print "<h2 align=center>V� po�adavek byl odesl�n a zpracov�n. O registraci budete informov�ni e-mailem.</h2>";
mail($regem,"Potvrzen� registrace","Jste zaregistrov�ni pod jm�nem: ".$regjmen."\nHeslem: ".$reghes1."\na Emailem: ".$regem);
mail("geniv@centrum.cz","Registrace klienta","Zaregistroval se klient: ".$regjmen." , \ns emailem: ".$regem."\ns heslem: ".$reghes1."\nv: ".Date("H:i:s j.m. Y")." \nz IP: ".$REMOTE_ADDR);
}//end kontrola udaju
else
{
print "N�kter� z t�chto �daj� ji� existuje!";
}
}//end if hes1=hes2
}//end empty
?>
