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
 
if(!Empty($prikaz))
{
if($prikaz=="nacti_na")
{
$prvs[0]="(otev�eno)";
$dot_s="navstevni_kniha_fksuvjsrvrsjhisuhviurshoihsgoihwoighweoiughowefg.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_na" and !$edttxt=="")
{
$prvs[0]="(ulo�eno)";
$dot_s="navstevni_kniha_fksuvjsrvrsjhisuhviurshoihsgoihwoighweoiughowefg.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_na" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_hl")
{
$prvs[1]="(otev�eno)";
$dot_s="log_chod_sdvjhshviuashfoiuashvoeifhqoeifhafoihjegoih.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_hl" and !$edttxt=="")
{
$prvs[1]="(ulo�eno)";
$dot_s="log_chod_sdvjhshviuashfoiuashvoeifhqoeifhafoihjegoih.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_hl" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_pr")
{
$prvs[2]="(otev�eno)";
$dot_s="log_ost_eafzujgwusiuiiufhoqihagweggoiiheviusdvciweuefwe.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_pr" and !$edttxt=="")
{
$prvs[2]="(ulo�eno)";
$dot_s="log_ost_eafzujgwusiuiiufhoqihagweggoiiheviusdvciweuefwe.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_pr" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_ban")
{
$prvs[2]="(otev�eno)";
$dot_s="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_ban" and !$edttxt=="")
{
$prvs[2]="(ulo�eno)";
$dot_s="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_pr" and $edttxt==""){$obsah="";}
}//end if uloz

/*
if($prikaz=="nacti_vs")
{
$prvs[3]="(otev�eno)";
$dot_s="log_vst_rjfhvvjhoiwjfvoiuwrhgowririjhgjvoirehgoiwgoijhwegw.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_vs" and !$edttxt=="")
{
$prvs[3]="(ulo�eno)";
$dot_s="log_vst_rjfhvvjhoiwjfvoiuwrhgowririjhgjvoirehgoiwgoijhwegw.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_vs" and $edttxt==""){$obsah="";}
}//end if uloz
*/
if($prikaz=="nacti_nu")
{
$prvs[4]="(otev�eno)";
$dot_s="now_hes_esjkhfceisjfiuehfoihwoidhwdaqwfpojovijhrfvwevolj.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_nu" and !$edttxt=="")
{
$prvs[4]="(ulo�eno)";
$dot_s="now_hes_esjkhfceisjfiuehfoihwoidhwdaqwfpojovijhrfvwevolj.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_nu" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_po")
{
$prvs[5]="(otev�eno)";
$dot_s="po_zn_am_ky_rvjrhigouvhriogjoiewjhfjoiwerhjqwfoihroijhnv.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_po" and !$edttxt=="")
{
$prvs[5]="(ulo�eno)";
$dot_s="po_zn_am_ky_rvjrhigouvhriogjoiewjhfjoiwerhjqwfoihroijhnv.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_po" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_hes")
{
$prvs[7]="(otev�eno)";
$dot_s="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_hes" and !$edttxt=="")
{
$prvs[7]="(ulo�eno)";
$dot_s="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_hes" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_now")
{
$prvs[8]="(otev�eno)";
$dot_s="nowinky_ieuwjciweuciquhdqpowfkllskdjhfsbfnv.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_now" and !$edttxt=="")
{
$prvs[8]="(ulo�eno)";
$dot_s="nowinky_ieuwjciweuciquhdqpowfkllskdjhfsbfnv.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_now" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="posl_mejl")
{
if(!Empty($emm) and !Empty($emp) and !Empty($emz))
{
mail($emm,$emp,$emz);
$prvs[6]="Email odesl�n!";
}//end empty
$obsah="";
}//end p��kaz

}
else
{
$obsah="";
}

if(Empty($prvs[0])){$prvs[0]="";} 
if(Empty($prvs[1])){$prvs[1]="";} 
if(Empty($prvs[2])){$prvs[2]="";} 
//if(Empty($prvs[3])){$prvs[3]="";} 
if(Empty($prvs[4])){$prvs[4]="";} 
if(Empty($prvs[5])){$prvs[5]="";} 
if(Empty($prvs[6])){$prvs[6]="";} 
if(Empty($prvs[7])){$prvs[7]="";} 
if(Empty($prvs[8])){$prvs[8]="";} 

?>
<form method=post name=fom>
<center>
<textarea rows=20 cols=100 name=memo><? print $obsah; ?></textarea>
</center>
<br>
<center>

<table border=0>
<tr>
<th>Logovac� soubor str�nek</th>
<td><a href="log_chod_sdvjhshviuashfoiuashvoeifhqoeifhafoihjegoih.php" title="Logovac� soubor" target="_blank">Zobrazit</a></td>
<td><input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_hl';"></td>
<td><input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_hl';fom.edttxt.value=memo.innerText;"></td>
<td><? print $prvs[1]; ?></td>
</tr>

<tr>
<th>Logovac� soubor p�ihla�ov�n�</th>
<td><a href="log_ost_eafzujgwusiuiiufhoqihagweggoiiheviusdvciweuefwe.php" title="P�ihla�ovac� soubor" target="_blank">Zobrazit</a></td>
<td><input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_pr';"></td>
<td><input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_pr';fom.edttxt.value=memo.innerText;"></td>
<td><? print $prvs[2]; ?></td>
</tr>

<tr>
<th>Logovac� soubor nov�ch u�ivatel�</th>
<td><a href="now_hes_esjkhfceisjfiuehfoihwoidhwdaqwfpojovijhrfvwevolj.php" title="Nov� u�ivatel�" target="_blank">Zobrazit</a></td>
<td><input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_nu';"></td>
<td><input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_nu';fom.edttxt.value=memo.innerText;"></td>
<td><? print $prvs[4]; ?></td>
</tr>

<tr>
<th>Soubor n�v�t�v</th>
<td><a href="navstevni_kniha_fksuvjsrvrsjhisuhviurshoihsgoihwoighweoiughowefg.php" title="N�v�t�vy" target=_blank>Zobrazit</a></td>
<td><input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_na';"></td>
<td><input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_na';fom.edttxt.value=memo.innerText;"></td>
<td><? print $prvs[0]; ?></td>
</tr>

<tr>
<th>Pozn�mky admina</th>
<td><a href="po_zn_am_ky_rvjrhigouvhriogjoiewjhfjoiwerhjqwfoihroijhnv.php" title="Pozn�mky" target="_blank">Zobrazit</a></td>
<td><input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_po';"></td>
<td><input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_po';fom.edttxt.value=memo.innerText;"></td>
<td><? print $prvs[5]; ?></td>
</tr>

<tr>
<th>Editace souboru v�ech �daj� (bez mezer!!)</th>
<td><a href="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php" title="Hesla" target="_blank">Zobrazit</a></td>
<td><input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_hes';"></td>
<td><input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_hes';fom.edttxt.value=memo.innerText;"></td>
<td><? print $prvs[7]; ?></td>
</tr>

<tr>
<th>Editace souboru novinek</th>
<td><a href="nowinky_ieuwjciweuciquhdqpowfkllskdjhfsbfnv.php" title="Novinky" target="_blank">Zobrazit</a></td>
<td><input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_now';"></td>
<td><input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_now';fom.edttxt.value=memo.innerText;"></td>
<td><? print $prvs[8]; ?></td>
</tr>

<tr>
<th>Ban�n (bez mezer!)</th>
<td><a href="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php" title="Novinky" target="_blank">Zobrazit</a></td>
<td><input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_ban';"></td>
<td><input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_ban';fom.edttxt.value=memo.innerText;"></td>
<td><? print $prvs[8]; ?></td>
</tr>

</table>

<hr>
<input type=submit value="Sma� Obsah" onclick="fom.memo.innerText='';fom.edttxt.value='';"><br>
<hr>
<input type=text name=emm title="Email" value="..n��� mejl.." onclick="emm.value='';"><br>
<input type=text name=emp title="P�edm�t" value="..n�jak� p�edm�t.." onclick="emp.value='';"><br>
<textarea name=emz cols=40 rows=10 title="Zpr�va"></textarea><br>
<input type=submit value="Poslat mejl" onclick="fom.prikaz.value='posl_mejl';"> <? print $prvs[6]; ?>
<hr>
</center>
<input type=hidden name=prikaz>
<input type=hidden name=edttxt>
</form>

<SCRIPT LANGUAGE=javascript src="cookies.js"></SCRIPT>
<SCRIPT LANGUAGE=javascript>
function nascr()
{
y=ReadCookie("scrolg_y",0,24*365);
window.scrollTo(0,y);
}
function ulscr()
{
y=document.body ? document.body.scrollTop:pageYoffset;
WriteCookie("scrolg_y",y,24*365);
}
</SCRIPT>
<body onload="nascr();" onUnload="ulscr();"></body>
<?
require "konec.php";
?>
