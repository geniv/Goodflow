<?
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  $pole = NactiRybky(".");
  echo
  "
<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
  <tr>
    <td align=\"center\"><input type=\"text\" name=\"p0\" value=\"".stripslashes($pole[0])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"p1\" value=\"".stripslashes($pole[1])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"p2\" value=\"".stripslashes($pole[2])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><input type=\"text\" name=\"p3\" value=\"".stripslashes($pole[3])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"p4\" value=\"".stripslashes($pole[4])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"p5\" value=\"".stripslashes($pole[5])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><input type=\"text\" name=\"p6\" value=\"".stripslashes($pole[6])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"p7\" value=\"".stripslashes($pole[7])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"p8\" value=\"".stripslashes($pole[8])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><input type=\"text\" name=\"p9\" value=\"".stripslashes($pole[9])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"p10\" value=\"".stripslashes($pole[10])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"p11\" value=\"".stripslashes($pole[11])."\" size=\"10\" class=\"prechod_tabulka_input\"></td>
  </tr>
</table>
<input type=\"text\" name=\"p12\" value=\"".stripslashes($pole[12])."\" size=\"10\" class=\"prechod_tabulka_input\"><br/>
<input type=\"text\" name=\"p13\" value=\"".stripslashes($pole[13])."\" size=\"10\" class=\"prechod_tabulka_input\"><br/>
<input type=\"text\" name=\"p14\" value=\"".stripslashes($pole[14])."\" size=\"10\" class=\"prechod_tabulka_input\"><br/>
<input type=\"text\" name=\"p15\" value=\"".stripslashes($pole[15])."\" size=\"10\" class=\"prechod_tabulka_input\"><br/>
<input type=\"submit\" name=\"tlacitko\" value=\"Upravit\">
</form>";

echo UpravitRybky();

}
  else
{
  echo HlaskaVypadni(".");
}
?>
