<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r))
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$sb_del="pocet_poli_wpfkwrdfsiomvspedfjvirokjwiefoghveiufhjowiehiwresuvieruhnrunvireunbvireuwnwroiujnfoij.php";
$u=fopen($sb_del,"r");
$pocet=fread($u,10);
fclose($u);

$porc=0;//po�aov� ��slo
for($i=1;$i<count($udaj);$i++)
{
if($Jmeno_r==$udaj[$i])
{
$porc=$i;
}//end if
}//end for

if($udaj[$porc+12]=="1")
{$zaspo[1]="checked";
$zaspo[2]="";}
else
{$zaspo[1]="";
$zaspo[2]="checked";}

if($udaj[$porc+13]=="1")
{$zaspo[3]="checked";
$zaspo[4]="";}
else
{$zaspo[3]="";
$zaspo[4]="checked";}

if($udaj[$porc+14]=="1")
{$zaspo[5]="checked";
$zaspo[6]="";}
else
{$zaspo[5]="";
$zaspo[6]="checked";}

if($udaj[$porc+15]=="1")
{$zaspo[7]="checked";
$zaspo[8]="";}
else
{$zaspo[7]="";
$zaspo[8]="checked";}

if($udaj[$porc+21]=="M")
{$zaspo[9]="checked";
$zaspo[10]="";}
else
{$zaspo[9]="";
$zaspo[10]="checked";}

/*
{$udaj[$porc+12]}
{$udaj[$porc+13]}
{$udaj[$porc+14]}
{$udaj[$porc+15]}
//$zaspo[9]
//$zaspo[10]

$i1=0;
for($i=1;$i<count($udaj)/$pocet;$i++)
{
$i1=$i1+($pocet+2);
echo 
"<tr>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+2]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+3]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+4]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+5]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+6]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+7]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+8]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+9]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+10]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+11]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+12]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+13]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+14]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+15]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+16]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+17]}</td>
<td>typ: {$udaj[(($i1-($pocet+1))-($i*2))+18]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+19]}</td>
<td>{$udaj[(($i1-($pocet+1))-($i*2))+20]}</td>
</tr>";
}//end for
*/
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
                        <td class=\"cattitle\">Registra�n�� �daje</td>
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
                    <table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" class=\"forumline\">
                	<tr>
                		<td class=\"row1\" width=\"38%\"><span class=\"genmed\"><strong>U�ivatel: *</strong></span></td>
                		<td class=\"row2\"><input type=\"hidden\" name=\"username\" value=\"{$udaj[$porc]}\"><span class=\"gen\"><b>{$udaj[$porc]}</b></span></td>
                	</tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>E-mailov� adresa: *</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\" style=\"width:200px\" name=\"email\" size=\"25\" maxlength=\"255\" value=\"{$udaj[$porc+1]}\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Aktu�ln� heslo: *<strong></strong></span><br>
                          <span class=\"gensmall\">Pokud chcete zm�nit heslo nebo upravit e-mailovou adresu mus�te zadat va�e aktu�ln� heslo.</span></td>
                        <td class=\"row2\">
                          <input type=\"password\" class=\"post\" style=\"width: 200px\" name=\"cur_password\" size=\"25\" maxlength=\"32\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Nov� heslo: *</strong></span><br>
                          <span class=\"gensmall\">Vypl�te pokud chcete zm�nit aktu�ln� heslo.</span></td>
                        <td class=\"row2\">
                          <input type=\"password\" class=\"post\" style=\"width: 200px\" name=\"new_password\" size=\"25\" maxlength=\"32\" value=\"\">
                        </td>
                      </tr>
                	<tr>
                	  <td class=\"row1\"><span class=\"genmed\"><strong>Potvrzen� hesla: *</strong></span><br>
                		<span class=\"gensmall\">Vypl�te pro potvrzen�, pokud chcete zm�nit va�e aktu�ln� heslo.</span></td>
                	  <td class=\"row2\">
                		<input type=\"password\" class=\"post\" style=\"width: 200px\" name=\"password_confirm\" size=\"25\" maxlength=\"32\" value=\"\">
                	  </td>
                	</tr>
          
                      <tr>
                        <td colspan=\"2\" height=\"28\">&nbsp;</td>
                      </tr>
                </table>

             </td>
         </tr>
      </table>

          </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainBox\" cellpadding=\"0\">

                <table cellspacing=\"0\" width=\"100%\">
			<tr>
				<th class=\"thHead\">Osobn�� �daje</th>
	                </tr>
                </table>

    </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"cBox\" cellpadding=\"0\">

              <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                <tr>
                  <td class=\"cBoxStart\" align=\"center\">

                  <table>
                      <tr>
                        <td class=\"row2\" colspan=\"2\"><span class=\"gensmall\">Tyto informace budou ve�ejn� zobraziteln�</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=38%\"><span class=\"genmed\"><strong>ICQ:</strong></span></td>
                        <td class=\"row2\" width=62%\">
                          <input type=\"text\" name=\"icq\" class=\"post\"style=\"width: 100px\"  size=\"10\" maxlength=\"15\" value=\"{$udaj[$porc+3]}\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>AOL Instant Messenger:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 150px\"  name=\"aim\" size=\"20\" maxlength=\"255\" value=\"{$udaj[$porc+4]}\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>MSN Messenger:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 150px\"  name=\"msn\" size=\"20\" maxlength=\"255\" value=\"{$udaj[$porc+5]}\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Yahoo Messenger:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 150px\"  name=\"yim\" size=\"20\" maxlength=\"255\" value=\"{$udaj[$porc+6]}\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>WWW:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"website\" size=\"25\" maxlength=\"255\" value=\"{$udaj[$porc+7]}\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Bydli�t�:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"location\" size=\"25\" maxlength=\"100\" value=\"{$udaj[$porc+8]}\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Povol�n�:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"occupation\" size=\"25\" maxlength=\"100\" value=\"{$udaj[$porc+9]}\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Z�jmy:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"interests\" size=\"35\" maxlength=\"150\" value=\"{$udaj[$porc+10]}\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Pohlav�:</strong></span></td>
                        <td class=\"row2\">
                          <span class=\"genmed\">Mu�</span><input type=\"radio\" class=\"checkbox\" name=\"pohlavi\" value=\"M\" {$zaspo[9]}>
                          <span class=\"genmed\">�ena</span><input type=\"radio\" class=\"checkbox\" name=\"pohlavi\" value=\"Z\" {$zaspo[10]}>
                        </td>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Podpis:</strong></span><br>
                          <span class=\"gensmall\">Text, kter� m��e b�t p�id�v�n do va�ich p��sp�vk�<br>Maxim�ln� 255 znak�
                        <td class=\"row2\">
                          <textarea name=\"signature\"style=\"width: 300px\"  rows=\"6\" cols=\"30\" class=\"post\">{$udaj[$porc+11]}</textarea>
                        </td>
                      </tr>
                      <tr>
                        <td colspan=\"2\" height=\"28\">&nbsp;</td>
                      </tr>
                    </table>
                </td>
             </tr>
         </table>


                              </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainBox\" cellpadding=\"0\">

                <table cellspacing=\"0\" width=\"100%\">
			<tr>
				<th class=\"thHead\">Mo�nosti</th>
	                </tr>
                </table>

    </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"cBox\" cellpadding=\"0\">

              <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                <tr>
                  <td class=\"cBoxStart\" align=\"center\">

                    <table width=\"100%\">
                      <tr>
                        <td class=\"row1\" width=\"38%\"><span class=\"genmed\"><strong>V�dy zobrazovat mou e-mailovou adresu:</strong></span></td>
                        <td class=\"row2\" width=\"62%\">
                          <input type=\"radio\" class=\"checkbox\" name=\"viewemail\" value=\"1\" {$zaspo[1]}>
                          <span class=\"gen\">Ano</span>&nbsp;&nbsp;
                          <input type=\"radio\" class=\"checkbox\" name=\"viewemail\" value=\"0\" {$zaspo[2]}>
                          <span class=\"gen\">Ne</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>V�dy mn� upozornit na odpov�di:</strong></span><br>
                          <span class=\"gensmall\">Po�le e-mail kdy� n�kdo odpov� na v�mi poslan� t�ma. Toto m��e b�t zm�n�no kdykoli p�ed odesl�n�m nov�ho t�matu.</span></td>
                        <td class=\"row2\">
                          <input type=\"radio\" class=\"checkbox\" name=\"notifyreply\" value=\"1\" {$zaspo[3]}>
                          <span class=\"gen\">Ano</span>&nbsp;&nbsp;
                          <input type=\"radio\" class=\"checkbox\" name=\"notifyreply\" value=\"0\" {$zaspo[4]}>
                          <span class=\"gen\">Ne</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Upozornit na p��chod nov� soukrom� zpr�vy:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"radio\" class=\"checkbox\" name=\"notifypm\" value=\"1\" {$zaspo[5]}>
                          <span class=\"gen\">Ano</span>&nbsp;&nbsp;
                          <input type=\"radio\" class=\"checkbox\" name=\"notifypm\" value=\"0\" {$zaspo[6]}>
                          <span class=\"gen\">Ne</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>V�dy p�ipojit m�j podpis:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"radio\" class=\"checkbox\" name=\"attachsig\" value=\"1\" {$zaspo[7]}>
                          <span class=\"gen\">Ano</span>&nbsp;&nbsp;
                          <input type=\"radio\" class=\"checkbox\" name=\"attachsig\" value=\"0\" {$zaspo[8]}>
                          <span class=\"gen\">Ne</span></td>
                      </tr>
                    </table>

                </td>
             </tr>
         </table>

    </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainBox\" cellpadding=\"0\">

                <table cellspacing=\"0\" width=\"100%\">
			<tr>
				<th class=\"thHead\">Nastaven�� postavi�ek</th>
	                </tr>
                </table>

    </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"cBox\" cellpadding=\"0\">

              <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                <tr>
                  <td class=\"cBoxStart\" align=\"center\">

                    <table>
                      <tr>
                        <td class=\"row1\" colspan=\"2\" style=\"padding-top: 20px;\">

                          <table width=\"70%\" cellspacing=\"2\" cellpadding=\"0\" border=\"0\" align=\"center\">
                            <tr>
                              <td width=\"65%\"><span class=\"gensmall\">Zobrazit mal� obr�zek postavi�ky pod podrobnostmi v p��sp�vc�ch. Pouze jeden obr�zek postavi�ky bude zobrazen, jeho ���ka by nem�la b�t v�t�� ne� 90 bod� a v��ka 90 bod� a velikost souboru by nem�la p�esahovat 90kB.</span></td>
                              <td align=\"center\"><span class=\"gensmall\">Aktu�ln� obr�zek</span><br><img src=\"{$udaj[$porc+17]}\">
                                <br>
                                <input type=\"checkbox\" class=\"checkbox\" name=\"avatardel\">
                                &nbsp;<span class=\"gensmall\">Odstranit obr�zek</span></td>
                            </tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
                          </table>

                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"38%\"><span class=\"genmed\"><strong>Zvolte obr�zek postavi�ky z galerie:</strong></span></td>
                        <td class=\"row2\" width=\"62%\">
                          <input type=\"submit\" name=\"avatargallery\" value=\"Zobrazit galerii postavi�ek\" class=\"liteoption\">
                        </td>
                      </tr>

                      <tr>
                        <td colspan=\"2\" height=\"28\">&nbsp;</td>
                      </tr>
				   </table>

				</td>
			</tr>
		</table>

    </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>

  <tr>
    <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainBox\" cellpadding=\"0\">

                <table cellspacing=\"0\" width=\"100%\">
                      <tr>
                        <td class=\"catBottom\" colspan=\"2\" align=\"center\" height=\"28\"><input type=\"hidden\" name=\"mode\" value=\"editprofile\"><input type=\"hidden\" name=\"agreed\" value=\"true\"><input type=\"hidden\" name=\"coppa\" value=\"0\"><input type=\"hidden\" name=\"sid\" value=\"20e55dc90531e04c7bb8e1fa5c56c347\"><input type=\"hidden\" name=\"user_id\" value=\"3\"><input type=\"hidden\" name=\"current_email\" value=\"geniv@centrum.cz\">
                          <input type=\"submit\" name=\"submit\" value=\"Odeslat\" class=\"mainoption\">
                          &nbsp;&nbsp;
                          <input type=\"reset\" value=\"P�vodn� hodnoty\" name=\"reset\" class=\"liteoption\">
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
  </table>";
}
else
{
echo "Nem�te opr�vn�n�!";
}
?>