<?
//images?hl=cs&q=neco&btnG=Hledat+obr%C3%A1zky&gbv=2
//images? hl=cs & q=neco & btnG=Hledat+obr%C3%A1zky & gbv=2

/*
p�i registraci do pole:

u�ivatel !! -username
email !! -email 
heslo !! a potvrzen�!! -new_password -password_confirm
ICQ -icq 
AOL -aim
MSN -msn
YaHoo -yim
www -website
bydli�t� -location
povol�n� -occupation
z�jmy -interests
podpis -signature

zobrazov�n� emailov� adresy -viewemail
upozorn�n� na odpov�� -notifyreply
upzornit na p��chod inbox -notifypm
p�ipojen� podpisu -attachsig

<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
	<tr>
		<td align=\"left\"><span class=\"nav\"><a href=\"index.php\" class=\"nav\">Obsah f�ra phpBB.cz:Templates</a></span></td>
	</tr>
</table>
*/

if(!Empty($souhlas) and $souhlas=="true" and !Empty($dok) and $dok!="true")
{
echo
"<form method=\"post\">
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
                        <td class=\"cattitle\">Registra�n� �daje</td>
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
                        <td class=\"row2\" colspan=\"2\"><span class=\"gensmall\">Tyto �daje jsou d�le�it� pro zaregistrov�n�:</span></td>
                      </tr>
                	<tr>
                		<td class=\"row1\" width=\"38%\"><span class=\"genmed\"><strong>U�ivatel: *</strong></span></td>
                		<td class=\"row2\"><input type=\"text\" class=\"post\" style=\"width:200px\" name=\"username\" size=\"25\" maxlength=\"25\" value=\"\"></td>
                	</tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>E-mailov� adresa: *</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\" style=\"width:200px\" name=\"email\" size=\"25\" maxlength=\"255\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Heslo: *</strong></span><br>
                          <span class=\"gensmall\"></span></td>
                        <td class=\"row2\">
                          <input type=\"password\" class=\"post\" style=\"width: 200px\" name=\"new_password\" size=\"25\" maxlength=\"32\" value=\"\">
                        </td>
                      </tr>
                	<tr>
                	  <td class=\"row1\"><span class=\"genmed\"><strong>Potvrzen� hesla: *</strong></span><br>
                		<span class=\"gensmall\"></span></td>
                	  <td class=\"row2\">
                		<input type=\"password\" class=\"post\" style=\"width: 200px\" name=\"password_confirm\" size=\"25\" maxlength=\"32\" value=\"\">
                	  </td>
                	</tr>
                      <tr>
                        <td colspan=\"2\" height=\"28\"><span class=\"genmed\"><strong><i>(*) - Povinn� �daje</right></i></strong></td>
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
				<th class=\"thHead\">Osobn� �daje</th>
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

                  <table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" class=\"forumline\">
                      <tr>
                        <td class=\"row2\" colspan=\"2\"><span class=\"gensmall\">Tyto �daje budou ve�ejn� zobraziteln�:</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=38%\"><span class=\"genmed\"><strong>ICQ:</strong></span></td>
                        <td class=\"row2\" width=62%\">
                          <input type=\"text\" name=\"icq\" class=\"post\"style=\"width: 100px\"  size=\"10\" maxlength=\"15\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>AOL Instant Messenger:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 150px\"  name=\"aim\" size=\"20\" maxlength=\"255\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>MSN Messenger:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 150px\"  name=\"msn\" size=\"20\" maxlength=\"255\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Yahoo Messenger:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 150px\"  name=\"yim\" size=\"20\" maxlength=\"255\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>WWW:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"website\" size=\"25\" maxlength=\"255\" value=\"http://\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Bydli�t�:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"location\" size=\"25\" maxlength=\"100\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Povol�n�:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"occupation\" size=\"25\" maxlength=\"100\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Z�jmy:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"interests\" size=\"35\" maxlength=\"150\" value=\"\">
                        </td>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Pohlav�: *</strong></span></td>
                        <td class=\"row2\">
                          <span class=\"genmed\">Mu�</span><input type=\"radio\" class=\"checkbox\" name=\"pohlavi\" value=\"M\" checked=\"checked\">
                          <span class=\"genmed\">�ena</span><input type=\"radio\" class=\"checkbox\" name=\"pohlavi\" value=\"Z\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Podpis:</strong></span><br>
                          <span class=\"gensmall\">Text, kter� m��e b�t p�id�v�n do va�ich p��sp�vk�<br>Maxim�ln� 255 znak�<br></span></td>
                        <td class=\"row2\">
                          <textarea name=\"signature\"style=\"width: 300px\" rows=\"6\" cols=\"30\" class=\"post\"></textarea>
                        </td>
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

                    <table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" class=\"forumline\">
                      <tr>
                        <td class=\"row2\" colspan=\"2\"><span class=\"gensmall\">Dopl�uj�c� mo�nosti, kter� m��ete libovoln� nastavit:</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"38%\"><span class=\"genmed\"><strong>V�dy zobrazovat mou e-mailovou adresu:</strong></span></td>
                        <td class=\"row2\" width=\"62%\">
                          <input type=\"radio\" class=\"checkbox\" name=\"viewemail\" value=\"1\" >
                          <span class=\"gen\">Ano</span>&nbsp;&nbsp;
                          <input type=\"radio\" class=\"checkbox\" name=\"viewemail\" value=\"0\" checked=\"checked\">
                          <span class=\"gen\">Ne</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>V�dy p�ipojit m�j podpis:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"radio\" class=\"checkbox\" name=\"attachsig\" value=\"1\" checked=\"checked\">
                          <span class=\"gen\">Ano</span>&nbsp;&nbsp;
                          <input type=\"radio\" class=\"checkbox\" name=\"attachsig\" value=\"0\" >
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
                        <td class=\"catBottom\" colspan=\"2\" align=\"center\" height=\"28\">
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
  </table>
  <input type=\"hidden\" name=\"notifyreply\" value=\"\">
  <input type=\"hidden\" name=\"notifypm\" value=\"\">
  </form>";
if(!Empty($username) and !Empty($email) and !Empty($new_password)and !Empty($password_confirm))
{
if(Empty($icq)){$icq="";}
if(Empty($aim)){$aim="";}
if(Empty($msn)){$msn="";}
if(Empty($yim)){$yim="";}
if(Empty($website)){$website="";}
if(Empty($location)){$location="";}
if(Empty($occupation)){$occupation="";}
if(Empty($interests)){$interests="";}
if(Empty($signature)){$signature="";}
if(Empty($pohlavi)){$pohlavi="";}
$stav=registrace($username,$email,$new_password,$password_confirm,$icq,$aim,$msn,$yim,$website,$location,$occupation,$interests,$signature,$viewemail,$notifyreply,$notifypm,$attachsig,$SERVER_NAME,basename(getcwd()),$REMOTE_ADDR,$pohlavi);
if($stav=="true")
{
print "<body onload=\"odj.click();\"><a name=\"odj\" href=\"index.php?kam=registrace&souhlas=true&dok=true&h=true\"></body>";
}
else
{
print "<body onload=\"odj.click();\"><a name=\"odj\" href=\"index.php?kam=registrace&souhlas=true&dok=true&h=false\"></body>";
}
}//end if empty
//print "http://$SERVER_NAME/".basename(getcwd());
}

if(!Empty($souhlas) and $souhlas=="true" and !Empty($dok) and $dok=="true" and !Empty($h) and $h=="true")
{
 print "<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Registrace dokon�ena</span></td>
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
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Va�e registrace byla dokon�ena.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Nyn� V�m byl zasl�n e-mail s potvrzovac�m odkazem a p�ihla�ovac�mi �daji.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Klikn�te <a href=\"index.php\" class=\"genmed\"><b>zde</b></a> pro p�echod na hlavn� str�nku.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</table>";
}
else
{
 if(!Empty($h) and $h=="false")
 {
  print 
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Registrace nebyla dokon�ena</span></td>
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
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Va�e registrace nebyla dokon�ena.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Zadali jste �patn� nebo duplik�tn� �daje.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Klikn�te <a href=\"index.php?kam=registrace&souhlas=true&dok=false\" class=\"genmed\"><b>zde</b></a> pro n�vrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</table>";
 }//end if empty $h
}//end if kontrola hesla

if(Empty($souhlas))
{
echo 
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\"><span class=\"cattitle\">Registra�n� podm�nky</span></td>
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
                        <table width=\"80%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td><span class=\"genmed\"><br>
                              A�koliv se administr�to�i a moder�to�i tohoto f�ra pokus� odstranit nebo upravit jak�koliv v�eobecn� ne��douc� materi�l tak rychle, jak je to jen mo�n�, je nemo�n� prohl�dnout ka�d� p��sp�vek. Proto mus�te vz�t na v�dom�, �e v�echny p��sp�vky v tomto f�ru vyjad�uj� pohledy a n�zory autora p��sp�vku a ne administr�tor�, moder�tor� a webmastera (mimo p��sp�vk� od t�chto lid�), a proto za n� nemohou b�t zodpov�dn�.<br><br>Souhlas�te s t�m, �e nebudete pos�lat ��dn� hanliv�, neslu�n�, vulg�rn�, nen�vistn�, zastra�uj�c�, sexu�ln� orientovan� nebo jin� materi�ly, kter� mohou poru�ovat z�kony. Pos�l�n� takov�ch materi�l� v�m m��e p�ivodit okam�it� a permanentn� vyho�t�n� z f�ra (a v� ISP bude o va�� �innosti informov�n). IP adresa v�ech p��sp�vk� je zaznamen�v�na pro p��pad pot�eby vynucen� t�chto podm�nek. Souhlas�te, �e webmaster, administr�tor a moder�to�i tohoto f�ra maj� pr�vo odstranit, upravit, p�esunout nebo ukon�it jak�koliv t�ma, kdykoliv zjist�, �e odporuje t�mto podm�nk�m. Jako u�ivatel souhlas�te, �e jak�koliv informace, kter� vlo��te, budou ulo�eny v datab�zi. Dokud nebudou tyto informace prozrazeny t�et� stran� bez va�eho svolen�, nemohou b�t webmaster, administr�tor a moder�to�i �in�ni zodpov�dn�mi za jak�koliv hackersk� pokusy, kter� mohou v�st k tomu, �e data budou kompromitov�na.<br><br>Syst�m tohoto f�ra pou��v� cookies k ukl�d�n� informac� na va�em po��ta�i. Tato cookies neobsahuj� ��dn� informace, kter� jste vlo�il, slou�� jen ke zv��en� va�eho pohodl� p�i prohl�en�. E-mailov� adresa je pou��v�na jen pro potvrzen� va�ich registra�n�ch detail� a hesla (a pro posl�ni nov�ho hesla, pokud jste zapomn�l aktu�ln�).<br><br>Kliknut�m na Registraci n�e souhlas�te b�t v�zan� t�mito podm�nkami.<br>
                              <br>
                              <br>
                              <div align=\"center\"><a href=\"index.php?kam=registrace&souhlas=true&dok=false\" class=\"genmed\">Souhlas�m s t�mito podm�nkami</a><br>
                                <br>
                                <a href=\"index.php\" class=\"genmed\">Nesouhlas�m s t�mito podm�nkami.</a></div>
                              <br>
                              </span></td>
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
</table>";
}
?>
