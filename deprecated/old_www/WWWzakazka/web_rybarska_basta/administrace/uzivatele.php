<?
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  $nazev = "./p_udj_qpodhsfvjnlkfcndvkvhbjdybflyknvkjfknskjnjdkylfnsbfnaklfjbvfdskabvjksdncjbvkjsdbvvnjsfbvjshfvkjfshvksbgkjbfvbjds.php";
  $u = fopen($nazev, "r");
  $udaj = explode("--*--", fread($u, filesize($nazev)));
  fclose($u);

  $del = PocetPoliLogin(".");
  $tabulka = "";
  for ($i = 1; $i < ((count($udaj) - 1) / $del) + 1; $i++)
  {
    $tabulka .=
    "<tr>
      <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">&nbsp;{$udaj[($i * $del) - 9]}&nbsp;</td>
      <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">&nbsp;{$udaj[($i * $del) - 6]}&nbsp;</td>
      <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">&nbsp;{$udaj[($i * $del) - 5]}&nbsp;</td>
      <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">&nbsp;<a href=\"index.php?kam=uzivatele&id={$udaj[($i * $del)]}\">Zobrazit detaily</a>&nbsp;</td>
    </tr>";
  }

  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_nadpis\">Uživatelé</td>
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
    <td align=\"center\" class=\"sekce_text\">V této sekci je seznam všech zaregistrovaných <u>uživatelů</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Po klapnutí na <u>Zobrazit detaily</u> se Vám zobrazí celý výpis informací o daném uživateli.</td>
  </tr>
</table>";
$id = $_GET["id"];
if (!Empty($_GET["id"]))
  {
    echo
    "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\">
  <tr>
    <td align=\"center\" colspan=\"2\" class=\"prechod_tabulka_001\">&nbsp;Výpis&nbsp;uživatele:&nbsp;<u>".stripslashes(VratHodnotuLoginu(".", $id, 9))."</u>&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">Login:</td>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">".stripslashes(VratHodnotuLoginu(".", $id, 9))."</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">Jméno:</td>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">".stripslashes(VratHodnotuLoginu(".", $id, 6))."</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">Příjmení:</td>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">".stripslashes(VratHodnotuLoginu(".", $id, 5))."</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">Bydliště:</td>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">".stripslashes(VratHodnotuLoginu(".", $id, 4))."</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">Email:</td>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">".stripslashes(VratHodnotuLoginu(".", $id, 3))."</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">Telefon:</td>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">".stripslashes(VratHodnotuLoginu(".", $id, 2))."</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">Mobil:</td>
    <td align=\"center\" class=\"prechod_tabulka_004_uzivatele\">".stripslashes(VratHodnotuLoginu(".", $id, 1))."</td>
  </tr>
</table>";
  }
    echo
    "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\">
  <tr>
    <td align=\"center\" colspan=\"4\" class=\"prechod_tabulka_001\">Výpis&nbsp;uživatelů</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_001\">&nbsp;Login:&nbsp;</td>
    <td align=\"center\" class=\"prechod_tabulka_001\">&nbsp;Jméno:&nbsp;</td>
    <td align=\"center\" class=\"prechod_tabulka_001\">&nbsp;Příjmení:&nbsp;</td>
    <td align=\"center\" class=\"prechod_tabulka_001\">&nbsp;Zobrazit&nbsp;detaily&nbsp;</td>
  </tr>
  {$tabulka}
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
}
  else
{
  echo HlaskaVypadni(".");
}
?>
