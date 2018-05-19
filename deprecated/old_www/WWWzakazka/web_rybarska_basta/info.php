<?
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"740px\">
  <tr>
    <td height=\"10px\"></td>
  </tr>
</table>";

$id = $_GET["id"];
if (!Empty($_GET["id"]))
{
  echo
  "<form method=\"post\">
  <table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td align=\"center\" colspan=\"3\">Zde můžete upravit své kontaktní údaje:</td>
    </tr>
    <tr>
      <td align=\"center\" height=\"6px\" colspan=\"3\"></td>
    </tr>
    <tr>
      <td align=\"right\">Jméno:</td>
      <td>&nbsp;</td>
      <td><input type=text name=\"jme\" value=\"".stripslashes(VratHodnotuLoginu("administrace", $id, 6))."\" class=\"prechod_tabulka_input\"></td>
    </tr>
      <td align=\"right\">Příjmení:</td>
      <td>&nbsp;</td>
      <td><input type=text name=\"prijmeni\" value=\"".stripslashes(VratHodnotuLoginu("administrace", $id, 5))."\" class=\"prechod_tabulka_input\"></td>
    </tr>
      <td align=\"right\">Bydliště:</td>
      <td>&nbsp;</td>
      <td><input type=text name=\"bydliste\" value=\"".stripslashes(VratHodnotuLoginu("administrace", $id, 4))."\" class=\"prechod_tabulka_input\"></td>
    </tr>
      <td align=\"right\">E-mail:</td>
      <td>&nbsp;</td>
      <td><input type=text name=\"email\" value=\"".stripslashes(VratHodnotuLoginu("administrace", $id, 3))."\" class=\"prechod_tabulka_input\"></td>
    </tr>
      <td align=\"right\">Telefon:</td>
      <td>&nbsp;</td>
      <td><input type=text name=\"telefon\" value=\"".stripslashes(VratHodnotuLoginu("administrace", $id, 2))."\" class=\"prechod_tabulka_input\"></td>
    </tr>
      <td align=\"right\">Mobil:</td>
      <td>&nbsp;</td>
      <td><input type=text name=\"mobil\" value=\"".stripslashes(VratHodnotuLoginu("administrace", $id, 1))."\" class=\"prechod_tabulka_input\"></td>
    </tr>
    <tr>
      <td align=\"center\" height=\"6px\" colspan=\"3\"></td>
    </tr>
    <tr>
      <td align=\"center\" colspan=\"3\"><input type=\"submit\" value=\"Upravit\"></td>
    </tr>
  </table>
  <input type=\"hidden\" name=\"upraveno\" value=\"true\">
  </form>";
}

if (!Empty($_POST["upraveno"]))
{
  echo UpravitLogin("administrace", $id, htmlspecialchars($_POST["jme"]), htmlspecialchars($_POST["prijmeni"]), htmlspecialchars($_POST["bydliste"]), htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["telefon"]), htmlspecialchars($_POST["mobil"]));
}

?>
