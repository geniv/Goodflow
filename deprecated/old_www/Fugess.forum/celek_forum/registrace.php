<?
//images?hl=cs&q=neco&btnG=Hledat+obr%C3%A1zky&gbv=2
//images? hl=cs & q=neco & btnG=Hledat+obr%C3%A1zky & gbv=2

/*
pøi registraci do pole:

uživatel !! -username
email !! -email 
heslo !! a potvrzení!! -new_password -password_confirm
ICQ -icq 
AOL -aim
MSN -msn
YaHoo -yim
www -website
bydlištì -location
povolání -occupation
zájmy -interests
podpis -signature

zobrazování emailové adresy -viewemail
upozornìní na odpovìï -notifyreply
upzornit na pøíchod inbox -notifypm
pøipojení podpisu -attachsig

<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
	<tr>
		<td align=\"left\"><span class=\"nav\"><a href=\"index.php\" class=\"nav\">Obsah fóra phpBB.cz:Templates</a></span></td>
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
                        <td class=\"cattitle\">Registraèní údaje</td>
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
                        <td class=\"row2\" colspan=\"2\"><span class=\"gensmall\">Tyto údaje jsou dùležité pro zaregistrování:</span></td>
                      </tr>
                	<tr>
                		<td class=\"row1\" width=\"38%\"><span class=\"genmed\"><strong>Uživatel: *</strong></span></td>
                		<td class=\"row2\"><input type=\"text\" class=\"post\" style=\"width:200px\" name=\"username\" size=\"25\" maxlength=\"25\" value=\"\"></td>
                	</tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>E-mailová adresa: *</strong></span></td>
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
                	  <td class=\"row1\"><span class=\"genmed\"><strong>Potvrzení hesla: *</strong></span><br>
                		<span class=\"gensmall\"></span></td>
                	  <td class=\"row2\">
                		<input type=\"password\" class=\"post\" style=\"width: 200px\" name=\"password_confirm\" size=\"25\" maxlength=\"32\" value=\"\">
                	  </td>
                	</tr>
                      <tr>
                        <td colspan=\"2\" height=\"28\"><span class=\"genmed\"><strong><i>(*) - Povinné údaje</right></i></strong></td>
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
				<th class=\"thHead\">Osobní údaje</th>
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
                        <td class=\"row2\" colspan=\"2\"><span class=\"gensmall\">Tyto údaje budou veøejnì zobrazitelné:</span></td>
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
                        <td class=\"row1\"><span class=\"genmed\"><strong>Bydlištì:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"location\" size=\"25\" maxlength=\"100\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Povolání:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"occupation\" size=\"25\" maxlength=\"100\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Zájmy:</strong></span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\"style=\"width: 200px\"  name=\"interests\" size=\"35\" maxlength=\"150\" value=\"\">
                        </td>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Pohlaví: *</strong></span></td>
                        <td class=\"row2\">
                          <span class=\"genmed\">Muž</span><input type=\"radio\" class=\"checkbox\" name=\"pohlavi\" value=\"M\" checked=\"checked\">
                          <span class=\"genmed\">Žena</span><input type=\"radio\" class=\"checkbox\" name=\"pohlavi\" value=\"Z\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Podpis:</strong></span><br>
                          <span class=\"gensmall\">Text, který mùže být pøidáván do vašich pøíspìvkù<br>Maximálnì 255 znakù<br></span></td>
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
				<th class=\"thHead\">Možnosti</th>
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
                        <td class=\"row2\" colspan=\"2\"><span class=\"gensmall\">Doplòující možnosti, které mùžete libovolnì nastavit:</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"38%\"><span class=\"genmed\"><strong>Vždy zobrazovat mou e-mailovou adresu:</strong></span></td>
                        <td class=\"row2\" width=\"62%\">
                          <input type=\"radio\" class=\"checkbox\" name=\"viewemail\" value=\"1\" >
                          <span class=\"gen\">Ano</span>&nbsp;&nbsp;
                          <input type=\"radio\" class=\"checkbox\" name=\"viewemail\" value=\"0\" checked=\"checked\">
                          <span class=\"gen\">Ne</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"genmed\"><strong>Vždy pøipojit mùj podpis:</strong></span></td>
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
                          <input type=\"reset\" value=\"Pùvodní hodnoty\" name=\"reset\" class=\"liteoption\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Registrace dokonèena</span></td>
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
                            <td align=\"center\"><span class=\"genmed\"><b>Vaše registrace byla dokonèena.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Nyní Vám byl zaslán e-mail s potvrzovacím odkazem a pøihlašovacími údaji.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php\" class=\"genmed\"><b>zde</b></a> pro pøechod na hlavní stránku.</td>
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Registrace nebyla dokonèena</span></td>
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
                            <td align=\"center\"><span class=\"genmed\"><b>Vaše registrace nebyla dokonèena.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Zadali jste špatné nebo duplikátní údaje.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=registrace&souhlas=true&dok=false\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
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
                            <td class=\"cattitle\"><span class=\"tableTitle\"><span class=\"cattitle\">Registraèní podmínky</span></td>
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
                              Aèkoliv se administrátoøi a moderátoøi tohoto fóra pokusí odstranit nebo upravit jakýkoliv všeobecnì nežádoucí materiál tak rychle, jak je to jen možné, je nemožné prohlédnout každý pøíspìvek. Proto musíte vzít na vìdomí, že všechny pøíspìvky v tomto fóru vyjadøují pohledy a názory autora pøíspìvku a ne administrátorù, moderátorù a webmastera (mimo pøíspìvkù od tìchto lidí), a proto za nì nemohou být zodpovìdní.<br><br>Souhlasíte s tím, že nebudete posílat žádné hanlivé, neslušné, vulgární, nenávistné, zastrašující, sexuálnì orientované nebo jiné materiály, které mohou porušovat zákony. Posílání takových materiálù vám mùže pøivodit okamžité a permanentní vyhoštìní z fóra (a váš ISP bude o vaší èinnosti informován). IP adresa všech pøíspìvkù je zaznamenávána pro pøípad potøeby vynucení tìchto podmínek. Souhlasíte, že webmaster, administrátor a moderátoøi tohoto fóra mají právo odstranit, upravit, pøesunout nebo ukonèit jakékoliv téma, kdykoliv zjistí, že odporuje tìmto podmínkám. Jako uživatel souhlasíte, že jakékoliv informace, které vložíte, budou uloženy v databázi. Dokud nebudou tyto informace prozrazeny tøetí stranì bez vašeho svolení, nemohou být webmaster, administrátor a moderátoøi èinìni zodpovìdnými za jakékoliv hackerské pokusy, které mohou vést k tomu, že data budou kompromitována.<br><br>Systém tohoto fóra používá cookies k ukládání informací na vašem poèítaèi. Tato cookies neobsahují žádné informace, které jste vložil, slouží jen ke zvýšení vašeho pohodlí pøi prohlížení. E-mailová adresa je používána jen pro potvrzení vašich registraèních detailù a hesla (a pro posláni nového hesla, pokud jste zapomnìl aktuální).<br><br>Kliknutím na Registraci níže souhlasíte být vázaný tìmito podmínkami.<br>
                              <br>
                              <br>
                              <div align=\"center\"><a href=\"index.php?kam=registrace&souhlas=true&dok=false\" class=\"genmed\">Souhlasím s tìmito podmínkami</a><br>
                                <br>
                                <a href=\"index.php\" class=\"genmed\">Nesouhlasím s tìmito podmínkami.</a></div>
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
