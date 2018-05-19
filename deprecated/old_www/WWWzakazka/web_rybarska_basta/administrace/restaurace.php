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
    <td align=\"center\" class=\"sekce_nadpis\">Otevírací doba</td>
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
    <td align=\"center\" class=\"sekce_text\">V této sekci můžete upravit otevírací dobu, která se nachází v sekci <u>Restaurace</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">V textovém poli upravíte příslušný text a klapnete na tlačítko <u>Uložit</u>.</td>
  </tr>
</table>
  <form method=\"post\">
<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\" width=\"500px\">
  <tr>
    <td align=\"center\" colspan=\"2\" class=\"prechod_tabulka_001\"><input type=\"text\" name=\"text\" value=\"".stripslashes(NactiRestauraci("."))."\" size=\"60\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\" class=\"prechod_tabulka_001\"><input type=\"submit\" name=\"tledit\" value=\"Uložit\"></td>
  </tr>
</table>
  </form>";

  if (!Empty($_POST["tledit"]))
  {
    echo UpravtRestaurace(".", htmlspecialchars($_POST["text"]));
  }
}
  else
{
  echo HlaskaVypadni(".");
}
?>
