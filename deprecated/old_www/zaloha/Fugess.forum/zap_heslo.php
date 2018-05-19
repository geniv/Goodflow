<?
if(Empty($username) and Empty($email))
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
                        <td class=\"cattitle\">Žádost o zaslání hesla</td>
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
                        <td class=\"row2\" colspan=\"2\"><span class=\"genmed\">Pole oznaèená (*) jsou povinná a musí být vyplnìna.</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"38%\"><span class=\"gen\">Uživatel: *</span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\" style=\"width: 200px\" name=\"username\" size=\"25\" maxlength=\"40\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\"><span class=\"gen\">E-mailová adresa: *</span></td>
                        <td class=\"row2\">
                          <input type=\"text\" class=\"post\" style=\"width: 200px\" name=\"email\" size=\"25\" maxlength=\"255\" value=\"\">
                        </td>
                      </tr>
                      <tr>
                        <td colspan=\"2\">&nbsp;</td>
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
				<td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
				<td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
				<td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
				<td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
				<td width=\"100%\" class=\"genBox\">
				  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
					  <td class=\"cBoxStart\">
						<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" class=\"forumline\">
						  <tr>
							<td class=\"catBottom\" colspan=\"2\" align=\"center\" height=\"28\">
							  <input type=\"submit\" value=\"Odeslat\" class=\"mainoption\">
							  &nbsp;&nbsp;
							  <input type=\"reset\" value=\"Pùvodní hodnoty\" name=\"reset\" class=\"liteoption\">
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
  <input type=hidden name=\"kam\" value=\"zap_heslo\">
  </form>";
}
else
{
if(zapomel_heslo($username,$email,$REMOTE_ADDR)=="true")
{$vysl="byly";}
else
{$vysl="nebyly";}
echo "Udaje $vysl poslány! <a href=\"index.php?kam=login\">>Zde<</a>";
}
?>

