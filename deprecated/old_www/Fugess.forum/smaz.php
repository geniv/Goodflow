<?
if(!Empty($delete) and $delete=="Ano" and !Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true" and !Empty($cis))
{print odstranit_prispevek($cis,$pris,$poz,$kdo,$idic,$str);}
else
{
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainboxTop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
  <tr>
    <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"ErrorConfirmBox\">

      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
        <tr>
          <td class=\"ErrorConfirmBoxStart\">

            <table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"0\">
              <tr>
                <th class=\"thHead\" height=\"25\" valign=\"middle\"><span class=\"tableTitle\">Informace</span></th>
              </tr>
			</table>

		  </td>
		</tr>
	 </table>

    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
  <tr>
	<td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	<td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	<td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
  <tr>
    <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"ErrorConfirmBox\">

      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
        <tr>
          <td class=\"ErrorConfirmBoxStart\">

            <table width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
              <tr>
                <td class=\"row1\" align=\"center\">
                  <form method=\"get\">
                    <span class=\"gen\"><br>
                    <span class=\"messagetextwrap\">Opravdu chcete odstranit tento pøíspìvek?</span><br>
                    <br>
                    <input type=\"submit\" name=\"delete\" value=\"Ano\" class=\"mainoption\">
                    &nbsp;&nbsp;
                    <input type=\"button\" value=\"Ne\" class=\"liteoption\" onclick=\"javascript:history.back();\">
                    </span><br><br>
                    <input type=\"hidden\" name=\"kam\" value=\"smaz\">
                    <input type=\"hidden\" name=\"cis\" value=\"$cis\">
                    <input type=\"hidden\" name=\"pris\" value=\"$pris\">
                    <input type=\"hidden\" name=\"poz\" value=\"$poz\">
                    <input type=\"hidden\" name=\"kdo\" value=\"$kdo\">
                    <input type=\"hidden\" name=\"idic\" value=\"$idic\">
                    <input type=\"hidden\" name=\"str\" value=\"$str\">
                  </form>
                </td>
              </tr>
            </table>

		  </td>
		</tr>
	 </table>

    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
  <tr>
    <td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
</table>";
}
?>
