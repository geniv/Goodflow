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
?>
<div id=menu>
<form name=gj method=post>
<input type=image src="bs_uvod.gif" onclick="gj.okd.value='uvod';" onmousemove="src='bt_uvod.gif';" onmouseout="src='bs_uvod.gif';"><br>
<input type=image src="bs_programovani.gif" onclick="gj.okd.value='programovani';" onmousemove="src='bt_programovani.gif';" onmouseout="src='bs_programovani.gif';"><br>
<input type=image src="bs_elektro.gif" onclick="gj.okd.value='elektro';" onmousemove="src='bt_elektro.gif';" onmouseout="src='bs_elektro.gif';"><br>
<input type=image src="bs_zeleznice.gif" onclick="gj.okd.value='zeleznice';" onmousemove="src='bt_zeleznice.gif';" onmouseout="src='bs_zeleznice.gif';"><br>
<input type=image src="bs_kontakt.gif" onclick="gj.okd.value='kontakt';" onmousemove="src='bt_kontakt.gif';" onmouseout="src='bs_kontakt.gif';"><br>
<center>
<input type=submit value="Programming" onclick="gj.okd.value='skola';" onmouseout="value='Programming';" onmousemove="value='Programming in school';"><br>
<input type=submit value="Návštìvní kniha" onclick="gj.okd.value='navsteva';" onmouseout="value='Návštìvní kniha';" onmousemove="value='Místo pro vaše názory';"><br>
</center>
<br>
<center>
<SCRIPT LANGUAGE=javascript>
function obn()
{
setInterval("window.location.reload();",100); 
setInterval("window.location.reload();",1000); 
}
</SCRIPT>
<?
//udaje registrovaných úèastníkù
$sb_hes="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";
$u=fopen($sb_hes,"r");
$udaj=explode("*-*-*",fread($u,1000000));
fclose($u);

//úèastníci 1..5 (èíslo)
for($p=1;$p<6;$p++)
{
$s_pucc="puc".$p."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"r");
$pruz[$p]=fread($u,100);//ète pro zjištìní prázdného
fclose($u);
}

//úèastníci 1..5 (IP)
for($p=1;$p<6;$p++)
{
$s_pucc="pucip".$p."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"r");
$pruzip[$p]=fread($u,100);//ète pro zjištìní prázdného
fclose($u);
}
$oakip=0;
$prist=0;
for($p=1;$p<6;$p++)
{
if($pruzip[$p]==$REMOTE_ADDR)//musí fakèit kontrola dle IP
 {
 $oakip++;//ovìøení opakonání se IP
 $prist=$p;//pøiøazení èísla dle IP
 }
}
if($oakip>1)//rozlišení zápisu
{$pov=false;}
else
{$pov=true;}

$pm=0;
$pm1=0;//zjištìmí prázdného souboru
for($p=1;$p<6;$p++)
{
if(Empty($pruz[$p])){$pm=$p;}
if(Empty($pruzip[$p])){$pm1=$p;}
}
if($pm==0 and $pm1==0){print "Poèet pøihlášených<br> úèastníku je maximální!!";}
//print $pm.", ".$pm1.", ".$prist;

if($prist==0)
{
echo
"<h3>Pøihlášení:</h3>
<input type=text name=logjm value=\"\"><br>
<input type=password name=loghe value=\"\"><br>
<a href=\"newreg.php\" title=\"Registrace nového uživatele\" target=_blank>Registrace</a><br><br>
";
}
else
{
$s_pucc="puc".$prist."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"r");
$jmucc=fread($u,100);//ète pro zjištìní prázdného
fclose($u);
echo
"<center>Pøihlášen pod jménem: <br><b>".$udaj[$jmucc]."</b></center>";
}//end if

if($prist==0)
{
echo "<input type=image src=\"login.gif\" onclick=\"gj.okd.value='uvod';gj.klnt.value='zmac';obn();\"><br>\n";
}
else
{
echo "
<br>
<input type=submit value=\"Editace údajù\" onclick=\"gj.okd.value='editace';\"><br><br>
<input type=image src=\"logout.gif\" onclick=\"gj.okd.value='uvod';gj.klnt.value='llout';obn();\"><br>
";
}

if(!Empty($klnt) and $klnt=="llout" and $prist!=0)
{
$zud="";
$s_pucc="puc".$prist."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"w");
fwrite($u,$zud);
fclose($u);

$s_pucc="pucip".$prist."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"w");
fwrite($u,$zud);
fclose($u);
}//end if log out

if(!Empty($logjm) and !Empty($loghe) and !Empty($klnt) and $klnt=="zmac" )
{
$prp=0;
$ulc=0;
for($p1=1;$p1<count($udaj);$p1++)
{
if($udaj[$p1]==$logjm and $udaj[$p1+1]==$loghe)
{
$prp++; //poèitadlo pøístupu vždy musí být -1-
$ulc=$p1; //uložení èísla uèastníka - poøadí
}
}//end for

if($prp==1)
{
if($pm!=0 and $pov==true)//uložení v
{
$zud=$ulc;
$s_pucc="puc".$pm."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"w");
fwrite($u,$zud);
fclose($u);
}

if($pm1!=0 and $pov==true)//uložení v
{
$zud1=$REMOTE_ADDR;
$s_pucc="pucip".$pm1."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"w");
fwrite($u,$zud1);
fclose($u);
}

}//end if prp==1

}//end if empty
else
{
$prp=0;
$ulc=0;
}
echo "
<input type=hidden name=okd>
<input type=hidden name=mejljm>
<input type=hidden name=mejlpr>
<input type=hidden name=mejlzp>
<input type=hidden name=navsjm>
<input type=hidden name=navsem>
<input type=hidden name=navste>
<input type=hidden name=test>
<input type=hidden name=klnt>
<input type=hidden name=pristp value=$prist>
<INPUT type=submit value=\"\" name=posli style=\"visibility:hidden\">
</center>
</form>
<center>
<A href=\"http://www.smsbrana.cz/?ref=15017555\" target=\"_blank\"><img src=\"http://www.smsbrana.cz/bannery/sms_brana_88x31.gif\" border=\"0\" title=\"Pošlete si SMS ZADARMO!!\"></a>
</center>
</div>
";
?>
