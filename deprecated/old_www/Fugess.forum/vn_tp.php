<?
if(!Empty($message) and !Empty($subject) and !Empty($ID_uz))
{print pridani_topiku($cis,stripslashes($subject),stripslashes($message),$Jmeno_r,$ID_uz,$topictype,$REMOTE_ADDR);}
else
{print 
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Nevyplnily jste text nebo p�edm�t zpr�vy</span></td>
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
                            <td align=\"center\"><span class=\"genmed\"><b>Napi�te text nebo (a) p�edm�t zpr�vy pro zalo�en� nov�ho t�matu.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Klikn�te <a href=\"javascript:history.back();\" class=\"genmed\"><b>zde</b></a> pro n�vrat.</td>
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
</table>
";}


/*

//print "Upraven� vzhled: ".prekopej_text($message)."<br>";
//$text=prekopej_text($message);


$cis
$subject
$message


		<tr>
				<td class="row1" width="22%"><span class="gensmall">&nbsp;</span></td>
                                <td class="row2" width="78%"><span class="gensmall"><br>Jestli�e nechcete p�idat mo�nost hlasov�n� k tomuto t�matu, nechte pole pr�zdn�.</span></td>
	        </tr>
            <tr>
				<td class="row1" width="22%" align="right"><span class="genmed"><b>Hlasovac� ot�zka</b></span></td>
				<td class="row2" width="78%"><span class="genmed"><input type="text" name="poll_title" size="50" maxlength="255" class="post" value=""></span></td>
			</tr>
            <tr>
				<td class="row1" align="right"><span class="genmed"><b>Mo�n� odpov�di</b></span></td>
				<td class="row2"><span class="genmed"><input type="text" name="add_poll_option_text" size="50" maxlength="255" class="post" value=""></span> &nbsp;<input type="submit" name="add_poll_option" value="P�idat odpov�ď" class="liteoption"></td>
			</tr>
            <tr>
				<td class="row1" align="right"><span class="genmed"><b>D�lka trv�n�</b></span></td>
				<td class="row2"><span class="genmed"><input type="text" name="poll_length" size="3" maxlength="3" class="post" value=""></span>&nbsp;<span class="gen"><b>dn�</b></span> &nbsp; <span class="gensmall">(zadejte 0 nebo nevyplňujte pro neomezenou dobu hlasov�n�)</span></td>
			</tr>

*/
?>
