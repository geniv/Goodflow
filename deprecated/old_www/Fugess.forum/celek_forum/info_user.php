<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and !Empty($kdo) and !Empty($idic) and login($Jmeno_r,$Heslo_r)=="true")
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$poru=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$kdo and $udaj[$i+13]==$idic){$poru=$i;}
}//end for

if($poru!=0)
{
$co=typ_uzivatele($udaj[$poru+16]);
$hodnc=obrazek_typu_uzivatele($udaj[$poru+22]);
$pohlavi=pohlavi_uzivatele($udaj[$poru+21]);
$emi=email_uzivatele($udaj[$poru+12],$udaj[$poru+1]);
$obr0=www_uzivatele($udaj[$poru+7]);
$obr1=msn_uzivatele($udaj[$poru+5]);
$obr2=yahoo_uzivatele($udaj[$poru+6]);
$obr3=aol_uzivatele($udaj[$poru+4]);
$obr4=icq_uzivatele($udaj[$poru+3]);

echo
"<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
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
                      <td class=\"cattitle\">Informace o uživateli {$udaj[$poru]}</td>
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
                  <table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\" align=\"center\">
                    <tr>
                      <th class=\"thHead\" width=\"40%\" height=\"28\" align=\"center\">Obrázek postavièky</th>
                      <th class=\"thHead\" width=\"60%\">Vše o uživateli {$udaj[$poru]}</th>
                    </tr>
                    <tr>
                      <td class=\"row1\" height=\"6\" valign=\"top\" align=\"center\">
                        <span class=\"postdetails\">".avatar_obrazek($udaj[$poru+17])."<br>$hodnc<br>$co</span></td>
                      <td class=\"row1\" rowspan=\"3\" valign=\"top\">
                        <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
                          <tr>
                            <td valign=\"middle\" align=\"right\" nowrap><span class=\"genmed\"><strong>Založen:</strong>&nbsp;</span></td>
                            <td width=\"100%\"><span class=\"genmed\">{$udaj[$poru+19]}</span></td>
                          </tr>
                          <tr>
                            <td valign=\"top\" align=\"right\" nowrap><span class=\"genmed\"><strong>Pøíspìvky:</strong>&nbsp;</span></td>
                            <td valign=\"top\"><span class=\"genmed\">{$udaj[$poru+20]}</span></td>
                          </tr>
                          <tr>
                            <td valign=\"middle\" align=\"right\" nowrap><span class=\"genmed\"><strong>Bydlištì:</strong>&nbsp;</span></td>
                            <td><span class=\"genmed\">{$udaj[$poru+8]}</span></td>
                          </tr>
                          <tr>
                            <td valign=\"middle\" align=\"right\" nowrap><span class=\"genmed\"><strong>WWW:</strong>&nbsp;</span></td>
                            <td><span class=\"genmed\">$obr0</span></td>
                          </tr>
                          <tr>
                            <td valign=\"middle\" align=\"right\" nowrap><span class=\"genmed\"><strong>Povolání:</strong>&nbsp;</span></td>
                            <td><span class=\"genmed\">{$udaj[$poru+9]}</span></td>
                          </tr>
                          <tr>
                            <td valign=\"top\" align=\"right\" nowrap><span class=\"genmed\"><strong>Zájmy:</strong></span></td>
                            <td><span class=\"genmed\">{$udaj[$poru+10]}</span></td>
                          </tr>
                          
                          <tr>
                            <td valign=\"top\" align=\"right\" nowrap><span class=\"genmed\"><strong>Pohlaví:</strong></span></td>
                            <td><span class=\"genmed\">$pohlavi</span></td>
                          </tr>
                          
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <th class=\"thHead\" align=\"center\" height=\"28\">Kontakt {$udaj[$poru]}</td>
                    </tr>
                    <tr>
                      <td class=\"row1\" valign=\"top\">
                        <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
                          <tr>
                            <td valign=\"middle\" align=\"right\" nowrap><span class=\"genmed\"><strong>E-mailová adresa:</strong></span></td>
                            <td class=\"row1\" valign=\"middle\" width=\"100%\"><span class=\"genmed\">$emi</span></td>
                          </tr>
                          <tr>
                            <td valign=\"middle\" nowrap align=\"right\"><span class=\"genmed\"><strong>MSN Messenger:</strong></span></td>
                            <td class=\"row1\" valign=\"middle\"><span class=\"genmed\">$obr1</span></td>
                          </tr>
                          <tr>
                            <td valign=\"middle\" nowrap align=\"right\"><span class=\"genmed\"><strong>Yahoo Messenger:</strong></span></td>
                            <td class=\"row1\" valign=\"middle\"><span class=\"genmed\">$obr2</span></td>
                          </tr>
                          <tr>
                            <td valign=\"middle\" nowrap align=\"right\"><span class=\"genmed\"><strong>AOL Instant Messenger:</strong></span></td>
                            <td class=\"row1\" valign=\"middle\"><span class=\"genmed\">$obr3</span></td>
                          </tr>
                          <tr>
                            <td valign=\"middle\" nowrap align=\"right\"><span class=\"genmed\"><strong>ICQ:</strong></span></td>
                            <td class=\"row1\" valign=\"middle\"><span class=\"genmed\">$obr4</span></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
          <td width=\"0%\" class=\"cboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
        </tr>
        <tr>
          <td width=\"0%\" class=\"cboxLeftbottom\">&nbsp;</td>
          <td width=\"100%\" valign=\"top\" class=\"cboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
          <td width=\"0%\" class=\"cboxRightbottom\">&nbsp;</td>
        </tr>
      </table>
    </td>
    <td class=\"catbox_right\"><img src=\"images/spacer.gif\" width=\"27\" height=\"27\"></td>
  </tr>
</table>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
	<td align=\"right\"><span class=\"nav\"><br>

</span></td>
  </tr>
</table>";
}//end poru!=0
else
{print "Chybný uživatel!!";}
}
else
{
echo "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";
}
?>
