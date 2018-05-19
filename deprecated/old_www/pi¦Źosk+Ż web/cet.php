<?
$sou_ban="ban_qpwjfiowejhvurhvasocjsoiuhciuwrcizwrciuwrnizrbvzeurnbvwizuvvwrzrubc.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,100000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
{
require "ee.php";
exit;
}
}//end for
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>obec Hlupín</title>
<META http-equiv="Content-Type" content="text/html; charset=windows-1250">
<SCRIPT LANGUAGE="JavaScript" src="cookies.js"></SCRIPT>
</head>
<body>
<?
$volne=0;//nulování volných
for($i=0;$i<11;$i++)
{
$soub="zivate_l_$i.php"; //jména
$u=fopen($soub,"r");
$uzi=fread($u,100);
fclose($u);
if(Empty($uzi)){$volne++;}//volné
}

if(!Empty($jmen) and !Empty($zprv) and $volne!=11)
{
$lg=Date("H:i j.n. Y")." od <b>$jmen</b>: $zprv<br>\n";
$s_lop="ke_ci_n_a__cas_tu_adslcdicnasdjoinoiqpddwekfiuenfvinwicnmucvnbrfsivnsvnbrsfhbvsjkdnbvijhsfbvisjbvsidjhnijwedihwbvihwnvjwdnbvjh.php";
$u=fopen($s_lop,"a+");
fwrite($u,$lg);
fclose($u);
}
if(!Empty($sysst) and $sysst=="logoff" and !Empty($jmen))
{
$loghj="true";
for($i=0;$i<11;$i++)
{
$soub="zivate_l_$i.php"; //jména
$u=fopen($soub,"r");
$uzi=fread($u,100);
fclose($u);
if($uzi==$jmen)
{
$loghj="false";
$uzi="";//odlogování
$soub="zivate_l_$i.php";
$u=fopen($soub,"w");
fwrite($u,$uzi);
fclose($u);
}
}

}
?>
<script language="JavaScript">
function obnov()
{
ct.repete.value=ReadCookie('maxi','20',24*365);
max.value=ct.repete.value;
ct.jmen.value=ReadCookie('jmc','',24*365);
jmeno.innerText=ct.jmen.value;
}

a=0;
function plus()
{
a++;
poc.innerText=a;
if(a==max.value)
{
a=0;
ct.zprv.value='';
ct.poslat.click();
}
setTimeout("plus();",1000);
}

function settim()
{
WriteCookie('maxi',max.value,24*365);
}
function kocec()
{
window.close();
}
function plusraad()
{
if(event.keyCode==13){odesil.click();}
}
</script>
<?
if(!Empty($loghj) and $loghj=="false")
{
$ukon="kocec();";
}
else
{
$ukon="";
}
echo "<body onload=\"obnov();plus();$ukon\"></body>";
?>


<table border=1>
<tr>
<td>
<div style="width:500px;height:350px">
<? //zprávy
$s_lop="ke_ci_n_a__cas_tu_adslcdicnasdjoinoiqpddwekfiuenfvinwicnmucvnbrfsivnsvnbrsfhbvsjkdnbvijhsfbvisjbvsidjhnijwedihwbvihwnvjwdnbvjh.php";
$u=fopen($s_lop,"r");
$tex=fread($u,10000000);
fclose($u);
echo $tex;
?>
</div>
</td>
<td valign=top>
<div style="width:100px;height:350px">
<? //uživatelé
for($i=0;$i<11;$i++)
{
$soub="zivate_l_$i.php";
$u=fopen($soub,"r");
$uzi=fread($u,100);
fclose($u);

$soub="pohl_l_$i.php";
$u=fopen($soub,"r");
$pohl=fread($u,100);
fclose($u);

if(!Empty($uzi) and !Empty($pohl))
{
if($pohl=="muz"){$po="muz.gif";}
if($pohl=="zena"){$po="zena.gif";}
echo "<img src=\"$po\"> $uzi<br>";
}
}
?>
</div>
</td>
</tr>
<tr>
<td><span id=jmeno></span>: <input name=zvc type=text onkeydown="plusraad();" size=50>&nbsp;<input type=button name=odesil value="Odepiš" onclick="ct.zprv.value=zvc.value;ct.poslat.click();";></td>
<td>Obnov každých: <input type=text name=max value=20 size=3> s <input type=button value="ulož" onclick="ct.repete.value=max.value;settim();ct.poslat.click();"></td>
</tr>

<tr>
<td colspan=2><input type=button name=logovoffv value="Odhlasit" onclick="ct.sysst.value='logoff';ct.poslat.click();"> Aktualizace za: (<span id=poc></span>)</td>
</tr>

</table>

<form name=ct method=get>
<input type=hidden name=jmen>
<input type=hidden name=zprv>
<input type=hidden name=repete>
<input type=hidden name=sysst>
<input type=submit name=poslat value="" style="visibility:hidden">
</form>
</body>
</html>
