<?
echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<title>Registrace</title>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">

<h1 align=center>Registrace na f�rum</h1>
<form method=post>
<table border=0 align=center ellpadding=0 cellspacing=10>

<tr>
<td>Login (nick)</td>
<td><input type=text name=nick><font color=red>*</font></td>
</tr>

<tr>
<td>Jm�no</td>
<td><input type=text name=jmeno><font color=red>*</font></td>
</tr>

<tr>
<td>P��jmen�</td>
<td><input type=text name=prij><font color=red>*</font></td>
</tr>

<tr>
<td>Email</td>
<td><input type=text name=ema value=@><font color=red>*</font></td>
</tr>

<tr>
<td>Heslo</td>
<td><input type=password name=hes1><font color=red>*</font></td>
</tr>

<tr>
<td>Znovu heslo</td>
<td><input type=password name=hes2><font color=red>*</font></td>
</tr>

<tr>
<td>ICQ</td>
<td><input type=text name=icq></td>
</tr>

<tr>
<th colspan=2><font color=red>*</font> = povinn� udaje</th>
</tr>

<tr>
<th colspan=2><input type=submit value=\"Zaregistruj\"></th>
</tr>

</table>
</form>
";

if(!Empty($nick) and !Empty($jmeno) and !Empty($prij) and !Empty($ema) and !Empty($hes1) and !Empty($hes2) and $ema!="@")
{
if($hes1!=$hes2)
{
echo "<center><img src=\"chyba.gif\"><br><b>�patn� kontroln� heslo</b></center>";
}
else
{
$sb_hes="u_h_s_qwpofejoivnuienvwuijoiwejfncinuqwopefijwicvnwoijdvoijnaosdifwdiiuvizuenbvirubvrui.php";             
$u=fopen($sb_hes,"r");
$reg=explode("--*uz*--",fread($u,1000000));
fclose($u);

$pp1=0;
for($p=0;$p<count($reg);$p++)
{
if($reg[$p]==$nick and $reg[$p]!=""){$pp1++;}//kontrola jm�na
//if($reg[$p]==$hes1 and $reg[$p]!=""){$pp1++;}//kontrola hesla
}

if($pp1==0)
{
$sb_hes="u_h_s_qwpofejoivnuienvwuijoiwejfncinuqwopefijwicvnwoijdvoijnaosdifwdiiuvizuenbvirubvrui.php";             
$u=fopen($sb_hes,"r");
$reg=explode("--*uz*--",fread($u,1000000));
fclose($u);
//dosazen� prom�nn�ch
$reg[count($reg)+1]=$nick;
$reg[count($reg)+2]=$hes1;

$sb_hes="u_h_s_qwpofejoivnuienvwuijoiwejfncinuqwopefijwicvnwoijdvoijnaosdifwdiiuvizuenbvirubvrui.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($reg,"--*uz*--"));
fclose($u);

echo "<center><img src=\"ok.gif\"></center><br><h2 align=center>V� po�adavek byl odesl�n a zpracov�n. O registraci budete informov�ni e-mailem.</h2>";
mail($ema,"Potvrzen� registrace z fora","Va�e ��dost o registraci: \nNick: $nick \nHeslo: $hes1 \nEmail: $ema \nJm�no: $jmeno \nP��jmen�: $prij \n Byla zpracov�na a p�ijata. Nyn� se m��ete s t�mito �daji p�ihl�sit do f�ra.\nP�eji p��jemn� den.\nadmin.hlupin@seznam.cz");
mail("admin.hlupin@seznam.cz","Registrace klienta do fora","Zaregistroval se klient: $nick ,\ns emailem: $ema \ns heslem: $hes1 \nJm�no: $jmeno \nP�ijmeni: $prij \nICQ: $icq \nv: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR");
}
else
{
print "<center><img src=\"chyba.gif\"><br><b>N�kter� z t�chto �daj� ji� existuje!</b></center>";
}

}//end dobr� heslo
}//end if empty
?>
