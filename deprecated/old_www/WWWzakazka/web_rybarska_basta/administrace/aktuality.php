<?
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  //DostaveniDelkyOtvirani(".", "false");
  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_nadpis\">Aktuality</td>
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
    <td align=\"center\" class=\"sekce_text\">V této sekci můžete přidávat, upravovat a mazat <u>aktuality</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Po klapnutí na <u>Přidat aktualitu</u> se Vám zobrazí dvě textové pole do kterých napíšete <u>název aktuality</u> a <u>text aktuality</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Stejný postup je i při upravení aktuality.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Při mazání aktuality se zobrazí dotaz jestli chcete opravdu aktualitu odstranit.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=aktuality&akce=add\">Přidat aktualitu</a></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";

$akce = $_GET["akce"];
$cislo = $_GET["cislo"];
  if (!Empty($akce) and $akce == "add")
  {
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"right\">Název aktuality:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis\" class=\"prechod_tabulka_input\" size=\"52\"></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\">Text aktuality:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><textarea name=\"text\" rows=\"6\" cols=\"40\"></textarea></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"tladd\" value=\"Přidat aktualitu\"></td>
  </tr>
</table>
    </form>";
  }

  if (!Empty($_POST["tladd"]) && !Empty($_POST["nadpis"]) && !Empty($_POST["text"]))
  {
    echo PridejAktualitu(".", htmlspecialchars($_POST["nadpis"]), htmlspecialchars($_POST["text"]));
  }

  if (!Empty($akce) && $akce == "edit" && !Empty($cislo))
  {
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"right\">Název aktuality:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis\" value=\"".stripslashes(VratHodnotuAktuality(".", $cislo, 2))."\" class=\"prechod_tabulka_input\" size=\"52\"></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\">Text aktuality:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><textarea name=\"text\" rows=\"6\" cols=\"40\">".stripslashes(VratHodnotuAktuality(".", $cislo, 0))."</textarea></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"tledit\" value=\"Upravit aktualitu\"></td>
  </tr>
</table>
    </form>";
  }

  if (!Empty($_POST["tledit"]) && !Empty($cislo) && !Empty($_POST["nadpis"]) && !Empty($_POST["text"]))
  {
    echo UpravAktualitu(".", $cislo, htmlspecialchars($_POST["nadpis"]), htmlspecialchars($_POST["text"]));
  }

  if (!Empty($akce) and $akce == "del" and !Empty($cislo))
  {
/*
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\">Opravdu&nbsp;chcete&nbsp;smazat&nbsp;aktualitu&nbsp;s&nbsp;názvem:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><u>".stripslashes(VratHodnotuAktuality(".", $cislo, 2))."</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\">?</td>
    <td align=\"center\">&nbsp;&nbsp;&nbsp;</td>
    <td align=\"center\"><input type=\"submit\" name=\"conf\" value=\"Ano\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\">-</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"submit\" name=\"conf\" value=\"Ne\"></td>
  </tr>
</table>
</form>";
*/
echo SmazAktualitu(".", $cislo);
  }

/*
  if (!Empty($cislo) and !Empty($conf) and $conf == "Ano")
  {
    echo SmazAktualitu(".", $cislo);
  }

  if (!Empty($cislo) and !Empty($conf) and $conf == "Ne")
  {
    echo
    "<head>
     <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=aktuality\">
     </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">".nacitani_admin()."</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
  }
*/

  $nazev = "./aktuality_qofuhgsvhsvsvbsvsfhvbsbvkjbsvkjdfkjvkbhqqwojqjpopoohjbvknhsfkvbkjbfv.php";
  $u = fopen($nazev, "r");
  $udaj = explode("--x--", fread($u, filesize($nazev)));
  fclose($u);

  $del = PocetPoliAktuality(".");
  $tabulka = "";
  for($i = (count($udaj) - 1) / $del; $i > 0 ; $i--)
  {
    $tabulka .=
    "<table border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"3\" width=\"680px\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\">
  <tr>
    <td class=\"prechod_tabulka_001\" width=\"100%\">".stripslashes($udaj[($i * $del) - 2])."</td>
    <td class=\"prechod_tabulka_001\" align=\"center\">&nbsp;&nbsp;&nbsp;<a href=\"index.php?kam=aktuality&akce=edit&cislo={$i}\">Upravit</a>&nbsp;&nbsp;&nbsp;</td>
    <td class=\"prechod_tabulka_001\" align=\"center\">&nbsp;&nbsp;&nbsp;<a href=\"index.php?kam=aktuality&akce=del&cislo={$i}\" onclick=\"return confirm('Opravdu chcete smazat aktuality s nazvem: {$udaj[($i * $del) - 2]} ?');\">Smazat</a>&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td class=\"prechod_tabulka_004_cas\" colspan=\"3\">{$udaj[($i * $del) - 1]}</td>
  </tr>
  <tr>
    <td class=\"prechod_tabulka_aktualita\" colspan=\"3\">".stripslashes($udaj[($i * $del)])."</td>
  </tr>
  </table>
  <hr>";
  }

  echo
  "
  {$tabulka}
  ";

}
  else
{
  echo HlaskaVypadni(".");
}
?>
