<?
//dasazení do polí....
if(!Empty($ptx1) and !Empty($pvas) and $pvas=="odpoved")
{
$odpnaot="RE: $ptx1";
}
else
{
$odpnaot="";
}
/*
<center>
<img src=\"006.gif\"><br>
<img src=\"002.gif\">
</center>
*/
echo
"<h2 align=center>Diskuze k obci</h2>
<hr>
<table border=0 align=center cellpadding=0 cellspacing=3>
<tr>
<td>Nadpis:<br>
<input type=text value=\"$odpnaot\" name=nad class=inputtext></td>
<td rowspan=3 valign=top>Váš komentáø:<br>
<textarea name=kom rows=7 cols=55 style=\"overflow:auto;\" class=inputtext></textarea></td>
</tr>
<tr>
<td>Vaše jméno:<br>
<input type=text name=jme class=inputtext></td>
</tr>
<tr>
<td>Váš e-mail:<br>
<input type=text name=ema class=inputtext></td>
</tr>
<tr>
<th colspan=2><input type=button class=button value=\"Odeslat komentáø\" onclick=\"men.ptx1.value=nad.value;men.ptx2.value=jme.value;men.ptx3.value=ema.value;men.ptx4.value=kom.innerText;men.kam.value='forum';men.poslat.click();\"></th>
</tr>
</table>";

//print "$ptx1, $ptx2, $ptx3, $ptx4";
// and !Empty($ptx3)
if(!Empty($ptx1) and !Empty($ptx2) and !Empty($ptx4))
{
$lg="Pøidání pøíspìvku do fóra s nadpisem: <b>$ptx1</b>, jmémen: <b>$ptx2</b>, emailem: <b>$ptx3</b> a zprávou: <b>$ptx4</b>; v: ".Date("H:i:s j.n. Y")." z IP: <b>$REMOTE_ADDR</b><br>\n";
$s_lop="l_s_p_f_qwifojhwizuvbuefnviufgwfzfrzuhfrzutohfrzuhiuwefiuwqpqppqpoejfirjguhrvuwefehv.php";
$u=fopen($s_lop,"a+");
fwrite($u,$lg);
fclose($u);

$s_vz="vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php";
$u=fopen($s_vz,"r");
$dvz=explode("--*vz*--",fread($u,1000000));
fclose($u);

$dvz[count($dvz)+1]=$ptx1;//nadpis
$dvz[count($dvz)+2]=$ptx2;//jméno
$dvz[count($dvz)+3]=$ptx3;//e-mail
$dvz[count($dvz)+4]=$ptx4;//zpráva
$dvz[count($dvz)+5]=Date("j.n.Y H:i:s");  // n !!!

//"<tr><td><table border=1 align=left cellpadding=0 cellspacing=2><tr><td align=right><u>Jméno</u>: </td><td>$ptx3</td></tr><tr><td align=right><u>Email</u>: </td><td>$ptx4</td></tr><tr><td align=right><u>Zpráva</u>: </td><td>$pvas</td></tr><tr><td align=right><u>Zasláno</u>: </td><td>".Date("j.m.Y - H:i:s")."</td></tr></table></td></tr>";
$s_vz="vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php";
$u=fopen($s_vz,"w");
fwrite($u,implode($dvz,"--*vz*--"));
fclose($u);
}

$s_vz="vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php";
$u=fopen($s_vz,"r");
$dvz=explode("--*vz*--",fread($u,1000000));
fclose($u);

print "<hr>";
$i1=$i2=0;
$promenych=5;
for($i=0;$i<(count($dvz)-1)/$promenych;$i++)
{
$i1=$i1+($promenych+2);
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE:")===0)
{$barv="#ffff99";}//druhá
else
{$barv="#cccc99";}//první
echo
"<table border=0 bgcolor=\"$barv\" width=700>
<tr>"; //na 10x RE:
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE: RE: RE: RE: RE: RE: RE: RE: RE: RE:")===0) //podle RE:RE!!
{
echo "<td valign=top align=right rowspan=2 width=200><img src=\"l.gif\"></td>";
}
else
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE: RE: RE: RE: RE: RE: RE: RE: RE:")===0) //podle RE:RE!!
{
echo "<td valign=top align=right rowspan=2 width=180><img src=\"l.gif\"></td>";
}
else
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE: RE: RE: RE: RE: RE: RE: RE:")===0) //podle RE:RE!!
{
echo "<td valign=top align=right rowspan=2 width=160><img src=\"l.gif\"></td>";
}
else
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE: RE: RE: RE: RE: RE: RE:")===0) //podle RE:RE!!
{
echo "<td valign=top align=right rowspan=2 width=140><img src=\"l.gif\"></td>";
}
else
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE: RE: RE: RE: RE: RE:")===0) //podle RE:RE!!
{
echo "<td valign=top align=right rowspan=2 width=120><img src=\"l.gif\"></td>";
}
else
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE: RE: RE: RE: RE:")===0) //podle RE:RE!!
{
echo "<td valign=top align=right rowspan=2 width=100><img src=\"l.gif\"></td>";
}
else
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE: RE: RE: RE:")===0) //podle RE:RE!!
{
echo "<td valign=top align=right rowspan=2 width=80><img src=\"l.gif\"></td>";
}
else
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE: RE: RE:")===0) //podle RE:RE!!
{
echo "<td valign=top align=right rowspan=2 width=60><img src=\"l.gif\"></td>";
}
else
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE: RE:")===0) //podle RE:RE!!
{
echo "<td valign=top align=right rowspan=2 width=40><img src=\"l.gif\"></td>";
}
else
if(strpos($dvz[(($i1-($promenych+1))-($i*2))],"RE:")===0) //podle RE!!
{
echo "<td valign=top align=right rowspan=2 width=20><img src=\"l.gif\"></td>";
}

if($dvz[(($i1-($promenych+1))-($i*2))+2]=="")//pøiøazení odkazu
 {
  echo "<td><b>{$dvz[(($i1-($promenych+1))-($i*2))]}</b> - {$dvz[(($i1-($promenych+1))-($i*2))+1]} - {$dvz[(($i1-($promenych+1))-($i*2))+4]}";
 }
  else
 {
  echo "<td><b>{$dvz[(($i1-($promenych+1))-($i*2))]}</b> - <a href=\"mailto:{$dvz[(($i1-($promenych+1))-($i*2))+2]}\">{$dvz[(($i1-($promenych+1))-($i*2))+1]}</a> - {$dvz[(($i1-($promenych+1))-($i*2))+4]}</td>";
 }
echo "<td align=right><span style=\"cursor:hand;\" onclick=\"men.ptx1.value='{$dvz[(($i1-($promenych+1))-($i*2))]}';men.pvas.value='odpoved';men.kam.value='forum';men.poslat.click();\">[Odpovìdìt]</span></td>
</tr>
<tr>
<td colspan=2>{$dvz[(($i1-($promenych+1))-($i*2))+3]}</td>
</tr>
</table>";
}

//uložen do pole
/*
$max=11;
echo
"<br><br><br><br><br><br>
<script language=\"JavaScript\">
function pohl(jaky)
{
if(jaky==0){men.ptx2.value='muz';}
if(jaky==1){men.ptx2.value='zena';}
}
function chatov(pov)
{
if(pov==0){tcal.style.visibility=\"hidden\";}
if(pov==1){tcal.style.visibility=\"visible\";}
}
function ulozit()
{
WriteCookie('jmc',jmen.value,24*365);
}
</script>
<table border=0 valign=center align=center cellpadding=0 cellspacing=3>

<tr>
<th colspan=2>Chat login</th>
</tr>

<tr>
<th colspan=2>Login: <a href=\"cet.php\" name=novok target=\"_blank\"></a><input type=text size=10 name=jmen></th>
</tr>

<tr>
<th>Muž:<input type=radio name=poh onclick=\"pohl(0);chatov(1);\"><img src=\"muz.gif\"></th>
<th>Žena:<input type=radio name=poh onclick=\"pohl(1);chatov(1);\"><img src=\"zena.gif\"></th>
</tr>

<tr>
<th colspan=2><input type=button id=tcal value=\"Pøihlásit\" onclick=\"men.kam.value='forum';men.ptx1.value=jmen.value;ulozit();men.poslat.click();\"></th>
</tr>

<tr>
<th colspan=2>Pro správnou funkci musí být zapnutý \"Cookie!\"</th>
</tr>

</table>";
//zjištìní volnosti
$volne=0;//nulování volných
for($i=0;$i<$max;$i++)
{
$soub="zivate_l_$i.php"; //jména
$u=fopen($soub,"r");
$uzi=fread($u,100);
fclose($u);
if(Empty($uzi)){$volne++;}//volné
}
//jmeno, pohlaví
if(!Empty($ptx1) and !Empty($ptx2))
{
$pov="true";//povolování def.
$vic=0;//nulování ovìøovadla opakovaní 
//$blokovn="false"; //blokovat otvírání èetu!!!!!!!!!!!!!!!!
for($i=0;$i<$max;$i++)
{
$soub="zivate_l_$i.php"; //jména
$u=fopen($soub,"r");
$uzi=fread($u,100);
fclose($u);

if(!Empty($uzi) and $uzi==$ptx1)
{
$vic++;
}

if(Empty($uzi) and $pov=="true" and $vic==0)//když je obsah prázdný zapiš
{
$pov="false"; //zpìtná blokace
$uzi=$ptx1; //vložení jmena
$pohl=$ptx2;//vložení pohlaví

$soub="zivate_l_$i.php";
$u=fopen($soub,"w");
fwrite($u,$uzi);
fclose($u);

$soub="pohl_l_$i.php";
$u=fopen($soub,"w");
fwrite($u,$pohl);
fclose($u);
}//end if prazdný

}//end for
}//end if
if(!Empty($volne))
{
if($volne<=3)
{
echo "<center>Obsazeno míst: <b><font color=red>".($max-$volne)." z $max</font></b></center>";
}
else
{
echo "<center>Obsazeno míst: <b>".($max-$volne)." z $max</b></center>";
}
}//end empty
*/

/*
$sb_uz="u_h_s_qwpofejoivnuienvwuijoiwejfncinuqwopefijwicvnwoijdvoijnaosdifwdiiuvizuenbvirubvrui.php";
$u=fopen($sb_uz,"r");
$uziv=explode("--*uz*--",fread($u,1000000));
fclose($u);
//$ptx1 //jméno
//$ptx2 //heslo
$ppo=0;
for($p=1;$p<count($uziv);$p++)
{
if($ptx1==$uziv[$p] and $ptx2==$uziv[$p+1])
{
$ppo++;
}//end if
}//end for

if($ppo==1)
{$prii="povoleno";}
else
{$prii="nepovoleno";}

$lg="Pøihlášení do fóra pod jmémen: <b>$ptx1</b> a heslem: $ptx2, v: ".Date("H:i:s j.m. Y")." z IP: <b>$REMOTE_ADDR</b> - $prii<br>\n";
$s_lop="l_s_p_f_qwifojhwizuvbuefnviufgwfzfrzuhfrzutohfrzuhiuwefiuwqpqppqpoejfirjguhrvuwefehv.php";
$u=fopen($s_lop,"a+");
fwrite($u,$lg);
fclose($u);

if($ppo==1)
{
echo
"<table border=1 align=center cellpadding=0 cellspacing=3>
<tr>
<th>Jméno:</th>
<td><input type=text name=jm size=24></td>
</tr>

<tr>
<th>Email:</th>
<td><input type=text name=em value=\"@\" size=24></td>
</tr>

<tr>
<th valign=top>Zpráva:</th>
<td><textarea name=zp rows=5 cols=20></textarea></td>
</tr>

<tr>
<th colspan=2><input type=button value=\"Pøidej další zprávu\" onclick=\"men.ptx3.value=jm.value;men.ptx4.value=em.value;men.pvas.value=zp.innerText;men.kam.value='forum';men.ptx1.value='$ptx1';men.ptx2.value='$ptx2';men.poslat.click();\"></th>
</tr>
</table>
<hr>";

//$ptx3 //jmeno
//$ptx4 //email
//$pvas //zpráva

//svátky

$s_vz="vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php";
$u=fopen($s_vz,"r");
$vzk=explode("--*vz*--",fread($u,1000000));
fclose($u);

echo
"<table border=0 cellpadding=0 cellspacing=10>";
for($p=1;$p<count($vzk);$p++)
{
echo $vzk[$p];
}//end for 1..n
echo
"</table>";

if(!Empty($ptx3) and !Empty($ptx4) and $ptx4!="@" and !Empty($pvas))
{
$s_vz="vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php";
$u=fopen($s_vz,"r");
$dvz=explode("--*vz*--",fread($u,1000000));
fclose($u);

$dvz[count($dvz)+1]="<tr><td><table border=1 align=left cellpadding=0 cellspacing=2><tr><td align=right><u>Jméno</u>: </td><td>$ptx3</td></tr><tr><td align=right><u>Email</u>: </td><td>$ptx4</td></tr><tr><td align=right><u>Zpráva</u>: </td><td>$pvas</td></tr><tr><td align=right><u>Zasláno</u>: </td><td>".Date("j.m.Y - H:i:s")."</td></tr></table></td></tr>";

$s_vz="vzk_apfojvunfivnwiusnqpwofijrheiuvncmiwiofuztvhduirdijehrurjeduhigfkjfviuhwioeqwopfjijv.php";
$u=fopen($s_vz,"w");
fwrite($u,implode($dvz,"--*vz*--"));
fclose($u);
}//end if !empty...

}//end if $ppo==1
else
{
echo "<br><br><br><br><br><br><br><br><br><br><br><h2 align=center>Bez hesla nemáte pøístup</h2>";
}//end if else
}//end if empty
*/

/*
<body onload="obnov();"></body>
<script language="JavaScript">
var a=0;
function obnov()
{
a++;
aa.innerText=a;
if(a==max.value)
{
a=0;
location.reload();
}
var tim=setTimeout("obnov()",1000);
}
</script>

<table border=1>
<tr>
<td><div style="width:200px;height:350px">èas: <span id=aa></span></div></td>
<td><div style="width:100px;height:350px"></div></td>
</tr>
<tr>
<td><input type=text  size=60><input type=submit value="Odepiš"></td>
<td>Obnov každých: <input type=text name=max value=20 size=5> s</td>
</tr>
</table>
*/
?>
