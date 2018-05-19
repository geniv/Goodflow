<?
echo
"
<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td colspan=\"3\">
            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
              <tr>
                <td width=\"0%\"><img src=\"images/cat_lcap.gif\" width=\"22\" height=\"51\"></td>
                <td width=\"100%\" background=\"images/cat_bar.jpg\" valign=\"top\">
                  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\">
                    <tr>
                      <td class=\"cBarStart\" valign=\"top\">
                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                          <tr>
                            <td valign=\"top\"><img src=\"images/cat_arrow.gif\" width=\"25\" height=\"39\"></td>
                            <td class=\"cattitle\"><span class=\"tableTitle\">Úprava osobních údajù v profilu</span></td>
                          </tr>
                        </table>
                      </td>
                      <td><img src=\"images/spacer.gif\" width=\"1\" height=\"51\"></td>
                    </tr>
                  </table>
                </td>
                <td width=\"0%\"><img src=\"images/cat_rcap.gif\" width=\"33\" height=\"51\"></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width=\"0%\"><img src=\"images/spacer.gif\" width=\"16\" height=\"22\"></td>
          <td width=\"100%\">
            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
              <tr>
                <td width=\"0%\" class=\"cboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
                <td width=\"100%\" class=\"cbox\">
                  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                    <tr>
                      <td class=\"cBoxStart\">
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">

                          <tr>
                            <td align=\"center\" colspan=\"2\"><span class=\"genmed\"><b>Upravil jste svùj profil.</b></span></td>
                          </tr>

                          <tr>
                            <td align=\"center\" colspan=\"2\"><b>Následující údaje byly zmìnìny:</b></td>
                          </tr>
                          <tr>
                            <td align=\"center\" colspan=\"2\">&nbsp;</td>
                          </tr>
";

 // $pokarac="Pokraèujte <a href=\"index.php\">>zde<</a><br>";
$d_bar="lime";
$s_bar="silver";
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
$dup=0;
for($i=1;$i<count($udaj);$i++)
{
if($Jmeno_r==$udaj[$i] and $udaj[$i+13]==$ID_uz){$porc=$i;}//end if
if($email==$udaj[$i]){$dup=$i;}
}//end for

if($porc!=0 and $udaj[$porc+2]==$cur_password and $dup==0)
{
$udaj[$porc+1]=$email;
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
print "<tr><td align=\"right\"><b>E-mail:</b></td><td align=\"left\"><div style=\"width:90px;\"><b><font color=\"$d_bar\">zmìnìn</font></b></div></td></tr>";
mail($email,"Úprava údajù - Fugess-Trainz-CZ","Dobrý den, Vaše úprava udajù na Fugess Trainz CZ byla uložena. \n Vaše aktuální udaje jsou: \n Jméno: $username \n Heslo: $cur_password \n Dìkuji, Fugess."); //pro klienta
//mail("fugess.martin@centrum.cz","Uprava udaju na Fugess.Trainz.CZ: ","Uprava dat klienta: $username \ns emailem: $email \ns heslem: $cur_password \n v: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR"); //pro admina na email
}//end if !=0
else
{print "<tr><td align=\"right\"><b>E-mail:</b></td><td align=\"left\"><div style=\"width:90px;\"><b><font color=\"$s_bar\">Duplikátní údaj!</font></b></div></td></tr>";}
}//end if empty
else
{
print "<tr><td align=\"right\"><b>E-mail:</b></td><td align=\"left\"><div style=\"width:90px;\"><b><font color=\"$s_bar\">nezmìnìn</font></b></div></td></tr>";
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
if($Jmeno_r==$udaj[$i] and $udaj[$i+13]==$ID_uz){$porc=$i;}//end if
}//end for

if($porc!=0 and $udaj[$porc+2]==$cur_password)
{
$udaj[$porc+2]=$new_password;
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
print "<tr><td align=\"right\"><b>Heslo:</b></td><td align=\"left\"><div style=\"width:90px;\"><b><font color=\"$d_bar\">zmìnìno</font></b></div></td></tr>";
mail($email,"Uprava udaju - Fugess-Trainz-CZ","Dobrý den, Vaše úprava udajù na Fugess Trainz CZ byla uložena. \n Vaše aktuální udaje jsou: \n Jméno: $username \n Heslo: $new_password \n Dìkuji, Fugess."); //pro klienta
//mail("fugess.martin@centrum.cz","Uprava udaju na Fugess.Trainz.CZ: ","Uprava dat klienta: $username \ns emailem: $email \ns heslem: $new_password \n v: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR"); //pro admina na email
}//end if !=0
}//end if empty
else
{
print "<tr><td align=\"right\"><b>Heslo:</b></td><td align=\"left\"><div style=\"width:90px;\"><b><font color=\"$s_bar\">nezmìnìno</font></b></div></td></tr>";
}

if(Empty($cur_password) and Empty($new_password) and Empty($password_confirm))
{
$delkasoub=delka_souboru();

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$porc=0;//poøaové èíslo
for($i=1;$i<count($udaj);$i++)
{
if($Jmeno_r==$udaj[$i] and $udaj[$i+13]==$ID_uz){$porc=$i;}//end if
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
$udaj[$porc+13]=$ID_uz;
$udaj[$porc+14]="nic";
$udaj[$porc+15]=$attachsig;
$udaj[$porc+21]=$pohlavi;

if(!Empty($obrazek) and $obrazek_size<=setings_avatar(3) and $vel=getimagesize($obrazek) and $vel[0]<=setings_avatar(1) and $vel[1]<=setings_avatar(2) and ($obrazek_type=="image/gif" or $obrazek_type=="image/pjpeg"))
{
//print_r(stat($obrazek));
$ftp_server="fugess.trainz.cz";
$ftp_user_name="jedisoft_fugess";
$ftp_user_pass="siemens";
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);
$source_file=$obrazek; //z komplu název
$novnaz=vygeneruj_nazev_obrazku($obrazek_type);
$destination_file="./forum/images/avatars/$novnaz";//na ftp
$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
if(!$upload)
{print "<font color=\"$s_bar\">Chyba pøi nahrávání na server</font>";}
else
{
if(file_exists($udaj[$porc+17])=="true")
{unlink($udaj[$porc+17]);}
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
print "<tr><td align=\"right\"><b>Ostatní údaje:</b></td><td align=\"left\"><div style=\"width:90px;\"><b><font color=\"$d_bar\">zmìnìny</font></b></div></td></tr>";
//mail($email,"Uprava udaju - Fugess-Trainz-CZ","Dobrý den, Vaše úprava udajù na Fugess Trainz CZ byla uložena. \n Vaše aktuální udaje jsou: \n Jméno: $username \n Dìkuji, Fugess."); //pro klienta
//mail("fugess.martin@centrum.cz","Uprava udaju na Fugess.Trainz.CZ: ","Uprava dat klienta: $username \ns emailem: $email \n v: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR"); //pro admina na email
}//end if !=0
}//end if empty
else
{
print "<tr><td align=\"right\"><b>Ostatní údaje:</b></td><td align=\"left\"><div style=\"width:90px;\"><b><font color=\"$s_bar\">nezmìnìny</font></b></div></td></tr>";
}

//print "<br><br><br>$username, $email, $cur_password, $new_password, $password_confirm, $icq, $aim, $msn, $yim, $website, $location, $occupation, $interests, $signature, $viewemail,$notifyreply, $notifypm, $attachsig, $SERVER_NAME, ".basename(getcwd()).", $REMOTE_ADDR, $pohlavi";


echo
"                       <tr>
                            <td align=\"center\" colspan=\"2\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\" colspan=\"2\">Kliknìte <a href=\"index.php\" class=\"genmed\"><b>zde</b></a> pro návrat na obsah.</td>
                          </tr>
                          <tr>
                            <td align=\"center\" colspan=\"2\">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width=\"0%\" class=\"cboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
              </tr>
              <tr>
                <td width=\"0%\" class=\"cboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
                <td width=\"100%\" valign=\"top\" class=\"cboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
                <td width=\"0%\" class=\"cboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
              </tr>
            </table>
          </td>
          <td class=\"catbox_right\"><img src=\"images/spacer.gif\" width=\"27\" height=\"27\"></td>
        </tr>
      </table>
</td>
  </tr>
</table>



";



?>
