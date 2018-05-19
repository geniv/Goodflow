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
    <td align=\"center\" class=\"sekce_nadpis\">Jezdící texty</td>
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
    <td align=\"center\" class=\"sekce_text\">Zde můžete změnit jezdící texty v sekcích <u>Úvod (Aktuality)</u> nebo <u>Akce</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestli upravíte jezdící text v <u>Úvodu</u>, tak se upraví i v <u>Aktualitách</u>. V <u>Akcích</u> je text druhý.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestli chcete upravit jezdící text v příslušné sekci, tak přepište text v příslušném poli a pak text uložte stiskem na tlačítko <u>uložit</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jakmile text upravíte, tak stránku na které se text zobrazuje musíte <u>aktualizovat</u>, aby jste si prohlédli Vámi provedené změny v textu.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
  <tr>
    <td align=\"center\"><u>Jezdící&nbsp;text&nbsp;v&nbsp;Úvodu&nbsp;a&nbsp;v&nbsp;Aktualitách:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"uvod\" value=\"".stripslashes(JezdiciTextUvodAktuality("."))."\" size=\"60\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"submit\" name=\"tluvod\" value=\"Upravit\"></td>
  </tr>
</table>
</form>
<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
  <tr>
    <td align=\"center\"><u>Jezdící&nbsp;text&nbsp;v&nbsp;Akcích:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"akce\" value=\"".stripslashes(JezdiciTextAkce("."))."\" size=\"60\" class=\"prechod_tabulka_input\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"submit\" name=\"tlakce\" value=\"Upravit\"></td>
  </tr>
</table>
</form>";

  if (!Empty($_POST["tluvod"]))
  {
    echo UpravitTextUvodAktuality(".", htmlspecialchars($_POST["uvod"]));
  }

  if (!Empty($_POST["tlakce"]))
  {
    echo UpravitTextAkce(".", htmlspecialchars($_POST["akce"]));
  }
}
  else
{
  echo HlaskaVypadni(".");
}
?>
