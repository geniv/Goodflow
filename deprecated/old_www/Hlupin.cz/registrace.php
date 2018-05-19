<?
echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<title>Registrace</title>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">

<h1 align=center>Registrace na fórum</h1>
<form method=post>
<table border=0 align=center ellpadding=0 cellspacing=10>

<tr>
<td>Login (nick)</td>
<td><input type=text name=nick><font color=red>*</font></td>
</tr>

<tr>
<td>Jméno</td>
<td><input type=text name=jmeno><font color=red>*</font></td>
</tr>

<tr>
<td>Příjmení</td>
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
<th colspan=2><font color=red>*</font> = povinné udaje</th>
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
echo "<center><img src=\"chyba.gif\"><br><b>Špatné kontrolní heslo</b></center>";
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
if($reg[$p]==$nick and $reg[$p]!=""){$pp1++;}//kontrola jména
//if($reg[$p]==$hes1 and $reg[$p]!=""){$pp1++;}//kontrola hesla
}

if($pp1==0)
{
$sb_hes="u_h_s_qwpofejoivnuienvwuijoiwejfncinuqwopefijwicvnwoijdvoijnaosdifwdiiuvizuenbvirubvrui.php";             
$u=fopen($sb_hes,"r");
$reg=explode("--*uz*--",fread($u,1000000));
fclose($u);
//dosazení proměnných
$reg[count($reg)+1]=$nick;
$reg[count($reg)+2]=$hes1;

$sb_hes="u_h_s_qwpofejoivnuienvwuijoiwejfncinuqwopefijwicvnwoijdvoijnaosdifwdiiuvizuenbvirubvrui.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($reg,"--*uz*--"));
fclose($u);

echo "<center><img src=\"ok.gif\"></center><br><h2 align=center>Váš požadavek byl odeslán a zpracován. O registraci budete informováni e-mailem.</h2>";
mail($ema,"Potvrzení registrace z fora","Vaše žádost o registraci: \nNick: $nick \nHeslo: $hes1 \nEmail: $ema \nJméno: $jmeno \nPříjmení: $prij \n Byla zpracována a přijata. Nyní se můžete s těmito údaji přihlásit do fóra.\nPřeji příjemný den.\nadmin.hlupin@seznam.cz");
mail("admin.hlupin@seznam.cz","Registrace klienta do fora","Zaregistroval se klient: $nick ,\ns emailem: $ema \ns heslem: $hes1 \nJméno: $jmeno \nPřijmeni: $prij \nICQ: $icq \nv: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR");
}
else
{
print "<center><img src=\"chyba.gif\"><br><b>Některý z těchto údajů již existuje!</b></center>";
}

}//end dobré heslo
}//end if empty
?>
