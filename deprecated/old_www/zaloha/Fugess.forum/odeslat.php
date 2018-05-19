<?
$pokarac="Pokraèujte <a href=\"index.php\">>zde<</a><br>";
$d_bar="lime";
$s_bar="red";
if(!Empty($cur_password) and Empty($new_password) and Empty($password_confirm))
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$porc=0;//poøaové èíslo
for($i=1;$i<count($udaj);$i++)
{
if($Jmeno_r==$udaj[$i])
{
$porc=$i;
}//end if
}//end for

if($porc!=0 and $udaj[$porc+2]==$cur_password)
{
$udaj[$porc+1]=$email;
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
print "Email <font color=\"$d_bar\">upraven!</font> $pokarac";
mail($email,"Uprava udaju - Fugess-Trainz-CZ","Dobrý den, Vaše úprava udajù na Fugess Trainz CZ byla uložena. \n Vaše aktuální udaje jsou: \n Jméno: $username \n Heslo: $cur_password \n Dìkuji, Fugess."); //pro klienta
//mail("fugess.martin@centrum.cz","Uprava udaju na Fugess.Trainz.CZ: ","Uprava dat klienta: $username \ns emailem: $email \ns heslem: $cur_password \n v: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR"); //pro admina na email
}//end if !=0
}//end if empty
else
{
print "Email <font color=\"$s_bar\">nebyl</font> upraven! $pokarac";
}

if(!Empty($cur_password) and !Empty($new_password) and !Empty($password_confirm) and $new_password==$password_confirm)
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$porc=0;//poøaové èíslo
for($i=1;$i<count($udaj);$i++)
{
if($Jmeno_r==$udaj[$i])
{
$porc=$i;
}//end if
}//end for

if($porc!=0 and $udaj[$porc+2]==$cur_password)
{
$udaj[$porc+2]=$new_password;
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
print "Heslo <font color=\"$d_bar\">upraveno!</font> $pokarac";
mail($email,"Uprava udaju - Fugess-Trainz-CZ","Dobrý den, Vaše úprava udajù na Fugess Trainz CZ byla uložena. \n Vaše aktuální udaje jsou: \n Jméno: $username \n Heslo: $new_password \n Dìkuji, Fugess."); //pro klienta
//mail("fugess.martin@centrum.cz","Uprava udaju na Fugess.Trainz.CZ: ","Uprava dat klienta: $username \ns emailem: $email \ns heslem: $new_password \n v: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR"); //pro admina na email
}//end if !=0
}//end if empty
else
{
print "Heslo <font color=\"$s_bar\">nebylo</font> upraveno! $pokarac";
}

if(Empty($cur_password) and Empty($new_password) and Empty($password_confirm))
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$porc=0;//poøaové èíslo
for($i=1;$i<count($udaj);$i++)
{
if($Jmeno_r==$udaj[$i])
{
$porc=$i;
}//end if
}//end for

if($porc!=0)
{
$udaj[$porc+3]=$icq;
$udaj[$porc+4]=$aim;
$udaj[$porc+5]=$msn;
$udaj[$porc+6]=$yim;
$udaj[$porc+7]=$website;
$udaj[$porc+8]=$location;
$udaj[$porc+9]=$occupation;
$udaj[$porc+10]=$interests;
$udaj[$porc+11]=$signature;
$udaj[$porc+12]=$viewemail;
$udaj[$porc+13]=$notifyreply;
$udaj[$porc+14]=$notifypm;
$udaj[$porc+15]=$attachsig;

if(!Empty($obrazek) and $obrazek_size<=13000 and ($obrazek_type=="image/gif" or $obrazek_type=="image/pjpeg"))
{
//print_r(stat($obrazek));
$ftp_server="fugess.trainz.cz";
$ftp_user_name="jedisoft_fugess";
$ftp_user_pass="siemens";
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);
$source_file=$obrazek; //z komplu název
$novnaz=vygeneruj_nazev_obrazku($obrazek_type);
$destination_file="./testovani_php/images/avatars/$novnaz";//na ftp
$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
if(!$upload)
{print "<font color=\"$s_bar\">Chyba pøi nahrávání na FTP</font>";}
else
{unlink($udaj[$porc+17]);
$udaj[$porc+17]="images/avatars/$novnaz";}
ftp_close($conn_id);
}//end if empty
else
{
if(!Empty($obrazek))
{print "<font color=\"$s_bar\">Obrázek nesplòuje požadavky!!</font><br>";}
}
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
print "Ostatní údaje <font color=\"$d_bar\">upraveny!</font> $pokarac";
//mail($email,"Uprava udaju - Fugess-Trainz-CZ","Dobrý den, Vaše úprava udajù na Fugess Trainz CZ byla uložena. \n Vaše aktuální udaje jsou: \n Jméno: $username \n Dìkuji, Fugess."); //pro klienta
//mail("fugess.martin@centrum.cz","Uprava udaju na Fugess.Trainz.CZ: ","Uprava dat klienta: $username \ns emailem: $email \n v: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR"); //pro admina na email
}//end if !=0
}//end if empty
else
{
print "Ostatní údaje <font color=\"$s_bar\">nebyli</font> upraveny! $pokarac";
}

//print "<br><br><br>$username, $email, $cur_password, $new_password, $password_confirm, $icq, $aim, $msn, $yim, $website, $location, $occupation, $interests, $signature, $viewemail,$notifyreply, $notifypm, $attachsig, $SERVER_NAME, ".basename(getcwd()).", $REMOTE_ADDR, $pohlavi";
?>
