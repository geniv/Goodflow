<?
if(!Empty($Jme) and !Empty($Hes) and !Empty($ID) and Login($Jme,$Hes)=="true")
{
$delkaotv=DelkaOtvirani("administrace");
$soub="administrace/reg_lide_qpodjiuwhfiuaikjfcnbdbiqpqejfoihsvsnfdiweqopdjiwdnsdodvinvnurehf.php";
$u=fopen($soub,"r");
$udaj=explode("--REG--",fread($u,$delkaotv));
fclose($u);

$del=DelkaRegistrace("administrace");

$poc=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$Jme and $udaj[$i+1]==$Hes and $udaj[$i+2]==$ID){$poc=$i;}
}//end for

if($udaj[$poc+11]=="M")
{$poh[0]="checked";
$poh[1]="";}
else
{$poh[0]="";
$poh[1]="checked";}

print 
"<form method=\"post\">
<h5><u>Profil</u></h5>
Pøihlašovací jméno: <input type=\"hidden\" name=\"login\" value=\"{$udaj[$poc]}\">{$udaj[$poc]}<br>
Heslo: <input type=\"password\" name=\"heslo1\"><br>
Heslo kontrola: <input type=\"password\" name=\"heslo2\"><br>
Email: <input type=\"text\" name=\"email\" value=\"{$udaj[$poc+3]}\">
<hr>
Jméno: <input type=\"text\" name=\"jmeno\" value=\"{$udaj[$poc+4]}\"><br>
Pøijmení: <input type=\"text\" name=\"prijmeni\" value=\"{$udaj[$poc+5]}\"><br>
ICQ: <input type=\"text\" name=\"icq\" value=\"{$udaj[$poc+6]}\"><br>
WWW: <input type=\"text\" name=\"www\" value=\"{$udaj[$poc+7]}\"><br>
Zájmy: <input type=\"text\" name=\"zajmy\" value=\"{$udaj[$poc+8]}\"><br>
Bydlištì: <input type=\"text\" name=\"bydliste\" value=\"{$udaj[$poc+9]}\"><br>
Povolání: <input type=\"text\" name=\"povolani\" value=\"{$udaj[$poc+10]}\"><br>
Pohlaví: Muž: <input type=\"radio\" name=\"pohlavi\" {$poh[0]} value=\"M\">Žena: <input type=\"radio\" name=\"pohlavi\" {$poh[1]} value=\"Z\"><br>
Podpis: <textarea name=\"podpis\">{$udaj[$poc+12]}</textarea><br>
<input type=\"submit\" value=\"Uprav\">
</form>";

if(!Empty($heslo1) and !Empty($heslo2))
{
//uprava hesla

//--porovnání hesla
//porovnání emailù
}

if(Empty($heslo1) and Empty($heslo2) and  !Empty($email))
{
//uprava emailu
}

//if(Empty($heslo1) and Empty($heslo2) and  !Empty($email))

//UlozProfil($login,$heslo1,$heslo2,$email,$jmeno,$prijmeni,$icq,$www,$zajmy,$bydliste,$povolani,$pohlavi,$podpis);

/*
if(!Empty($login) and !Empty($heslo1) and !Empty($heslo2) and !Empty($email))
{
if(Empty($jmeno)){$jmeno="";}
if(Empty($prijmeni)){$prijmeni="";}
if(Empty($icq)){$icq="";}
if(Empty($www)){$www="";}
if(Empty($zajmy)){$zajmy="";}
if(Empty($bydliste)){$bydliste="";}
if(Empty($povolani)){$povolani="";}
if(Empty($pohlavi)){$pohlavi="";}
if(Empty($podpis)){$podpis="";}
$stav=Registrace($login,$heslo1,$heslo2,$email,$jmeno,$prijmeni,$icq,$www,$zajmy,$bydliste,$povolani,$pohlavi,$podpis,$SERVER_NAME,basename(getcwd()),$REMOTE_ADDR);
*/
}
else
{
print "Neoprávnìné nabourávání!!";
}
?>
