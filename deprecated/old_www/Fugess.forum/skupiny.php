<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true")
{
echo "

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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Uživatelské skupiny</span></td>
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
                            <td align=\"center\"><b>Zatím zde nejsou zavedené uživatelské skupiny</b></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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




";
}
else
{
echo "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";
}
?>

