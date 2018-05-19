<?
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  //DostaveniDelkyOtvirani(".", "false");
  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_nadpis\">Ceny povolenek</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"center\" colspan=\"3\" height=\"20px\"><hr></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">V této sekci můžete upravit jednotlivé ceny v sekci <u>Ceny povolenek</u></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">V textových polích můžete upravit jednotlivé <u>nadpisy</u> a <u>ceny</u> v položkách ceníku.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Po upravení textů klapněte na tlačítko <u>Upravit položky</u>.</td>
  </tr>
</table>";

  if (!Empty($_POST["tledit"]) && !Empty($_POST["t1"]) && !Empty($_POST["t2"]) && !Empty($_POST["t3"]) && !Empty($_POST["t4"]) && !Empty($_POST["t5"]) && !Empty($_POST["t11"]) && !Empty($_POST["t12"]) && !Empty($_POST["t13"]) && !Empty($_POST["t14"]) && !Empty($_POST["t15"]) && !Empty($_POST["t16"]) && !Empty($_POST["t17"]) && !Empty($_POST["t21"]) && !Empty($_POST["t22"]) && !Empty($_POST["t31"]) && !Empty($_POST["t32"]) && !Empty($_POST["t33"]) && !Empty($_POST["t41"]) && !Empty($_POST["t42"]))
  {
    echo UpravPovolenky("." ,htmlspecialchars($_POST["t1"]), htmlspecialchars($_POST["t2"]), htmlspecialchars($_POST["t3"]), htmlspecialchars($_POST["t4"]), htmlspecialchars($_POST["t5"]), htmlspecialchars($_POST["t11"]), htmlspecialchars($_POST["t12"]), htmlspecialchars($_POST["t13"]), htmlspecialchars($_POST["t14"]), htmlspecialchars($_POST["t15"]), htmlspecialchars($_POST["t16"]), htmlspecialchars($_POST["t17"]), htmlspecialchars($_POST["t21"]), htmlspecialchars($_POST["t22"]), htmlspecialchars($_POST["t31"]), htmlspecialchars($_POST["t32"]), htmlspecialchars($_POST["t33"]), htmlspecialchars($_POST["t41"]), htmlspecialchars($_POST["t42"]));
  }

  echo
  "<form method=\"post\">
<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\" width=\"500px\">
    <tr>
      <td align=\"center\" colspan=\"2\" class=\"prechod_tabulka_001\"><input type=\"text\" name=\"t1\" value=\"".stripslashes(VratHodnotuPovolenky(".", 1))."\" class=\"prechod_tabulka_input\" size=\"40\"></td>
    </tr>
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t2\" value=\"".stripslashes(VratHodnotuPovolenky(".", 2))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t3\" value=\"".stripslashes(VratHodnotuPovolenky(".", 3))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
    </tr>
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t4\" value=\"".stripslashes(VratHodnotuPovolenky(".", 4))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t5\" value=\"".stripslashes(VratHodnotuPovolenky(".", 5))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
    </tr>
  </table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\" width=\"500px\">
    <tr>
      <td align=\"center\" colspan=\"2\" class=\"prechod_tabulka_001\"><input type=\"text\" name=\"t11\" value=\"".stripslashes(VratHodnotuPovolenky(".", 6))."\" class=\"prechod_tabulka_input\" size=\"40\"></td>
    </tr>
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t12\" value=\"".stripslashes(VratHodnotuPovolenky(".", 7))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t13\" value=\"".stripslashes(VratHodnotuPovolenky(".", 8))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
    </tr>
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t14\" value=\"".stripslashes(VratHodnotuPovolenky(".", 9))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t15\" value=\"".stripslashes(VratHodnotuPovolenky(".", 10))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
    </tr>
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t16\" value=\"".stripslashes(VratHodnotuPovolenky(".", 11))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t17\" value=\"".stripslashes(VratHodnotuPovolenky(".", 12))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
    </tr>
  </table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\" width=\"500px\">
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_001\"><input type=\"text\" name=\"t21\" value=\"".stripslashes(VratHodnotuPovolenky(".", 13))."\" class=\"prechod_tabulka_input\" size=\"40\"></td>
    </tr>
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t22\" value=\"".stripslashes(VratHodnotuPovolenky(".", 14))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
    </tr>
  </table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\" width=\"500px\">
    <tr>
      <td align=\"center\" colspan=\"2\" class=\"prechod_tabulka_001\"><input type=\"text\" name=\"t31\" value=\"".stripslashes(VratHodnotuPovolenky(".", 15))."\" class=\"prechod_tabulka_input\" size=\"40\"></td>
    </tr>
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t32\" value=\"".stripslashes(VratHodnotuPovolenky(".", 16))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t33\" value=\"".stripslashes(VratHodnotuPovolenky(".", 17))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
    </tr>
  </table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\" width=\"500px\">
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_001\"><input type=\"text\" name=\"t41\" value=\"".stripslashes(VratHodnotuPovolenky(".", 18))."\" class=\"prechod_tabulka_input\" size=\"40\"></td>
    </tr>
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_004\"><input type=\"text\" name=\"t42\" value=\"".stripslashes(VratHodnotuPovolenky(".", 19))."\" class=\"prechod_tabulka_input\" size=\"30\"></td>
    </tr>
  </table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\"><input type=\"submit\" name=\"tledit\" value=\"Upravit položky\"></td>
  </tr>
</table>
</form>";

}
  else
{
  echo HlaskaVypadni(".");
}
?>
