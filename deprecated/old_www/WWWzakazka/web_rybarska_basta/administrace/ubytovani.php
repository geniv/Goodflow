<?
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  //DostaveniDelkyOtvirani(".", "false");

  $nazev = "./ubytovani_fsbvjfksbvnweofhvsfsbvlsjcbydnvbydvnbddhjcvhjdsvjbdaskfvjb.php";
  $u = fopen($nazev, "r");
  $udaj = explode("--x--", fread($u, filesize($nazev)));
  fclose($u);

  $del = PocetPoliUbytovani(".");
  $tabulka = "";
  for ($i = 1; $i < ((count($udaj) - 1) / $del) + 1; $i++)
  {
    $tabulka .=
    "<tr>
      <td align=\"center\" class=\"prechod_tabulka_004\">".stripslashes($udaj[($i * $del) - 1])."</td>
      <td align=\"center\" class=\"prechod_tabulka_004\">".stripslashes($udaj[($i * $del)])."</td>
      <td align=\"center\" class=\"prechod_tabulka_004\">&nbsp;<a href=\"index.php?kam=ubytovani&akce=edit&cislo={$i}\">Upravit</a>&nbsp;</td>
      <td align=\"center\" class=\"prechod_tabulka_004\">&nbsp;<a href=\"index.php?kam=ubytovani&akce=del&cislo={$i}\" onclick=\"return confirm('Opravdu chcete smazat ubytovani s nazvem: {$udaj[($i * $del) - 1]} ?');\">Smazat</a>&nbsp;</td>
    </tr>";
  }

$cislo = $_GET["cislo"];
$akce = $_GET["akce"];
  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_nadpis\">Ceny ubytování</td>
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
    <td align=\"center\" class=\"sekce_text\">V této sekci můžete přidat, upravit nebo smazat jednotlivé ceny v sekci <u>O nás > Ubytování</u> </td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Po klapnutí na <u>Přidat položku ceníku</u> se Vám zobrazí dvě textové pole do kterých napíšete <u>popis</u> a <u>cenu</u> položky ceníku.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Stejný postup je i při upravení položky ceníku.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Při mazání položky z ceníku se zobrazí dotaz jestli chcete opravdu položku odstranit.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=ubytovani&akce=add\">Přidat položku ceníku</a></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";

  if (!Empty($akce) and $akce == "add")
  {
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
  <tr>
    <td align=\"center\"><u>Popis&nbsp;položky:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"text1\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><u>Cena&nbsp;položky:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"text2\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"tladd\" value=\"Přidat položku\"></td>
  </tr>
</table>
</form>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
  }

  if (!Empty($_POST["tladd"]) && !Empty($_POST["text1"]) && !Empty($_POST["text2"]))
  {
    echo PridejUbytovani(".", htmlspecialchars($_POST["text1"]), htmlspecialchars($_POST["text2"]));
  }

  if (!Empty($akce) and $akce == "edit" and !Empty($cislo))
  {
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
  <tr>
    <td align=\"center\"><u>Popis&nbsp;položky:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"text1\" value=\"".stripslashes(VratHodnotuUbytovny(".", $cislo, 1))."\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><u>Cena&nbsp;položky:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"text2\" value=\"".stripslashes(VratHodnotuUbytovny(".", $cislo, 0))."\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"tledit\" value=\"Upravit položku\"></td>
  </tr>
</table>
</form>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
  }

  if (!Empty($_POST["tledit"]) and !Empty($cislo) and !Empty($_POST["text1"]) and !Empty($_POST["text2"]))
  {
    echo UpravUbytovani(".", $cislo, htmlspecialchars($_POST["text1"]), htmlspecialchars($_POST["text2"]));
  }

  if (!Empty($akce) and $akce == "del" and !Empty($cislo))
  {
/*
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\">Opravdu&nbsp;chcete&nbsp;smazat&nbsp;položku:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><u>".stripslashes(VratHodnotuUbytovny(".", $cislo, 1))."</u></td>
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
</form>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
*/
echo SmazUbytovani(".", $cislo);
  }

/*
  if (!Empty($cislo) and !Empty($conf) and $conf == "Ano")
  {
    echo SmazUbytovani(".", $cislo);
  }

  if (!Empty($cislo) and !Empty($conf) and $conf == "Ne")
  {
    echo
    "<head>
     <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=ubytovani\">
     </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">".nacitani_admin()."</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"40px\"></td>
  </tr>
</table>";
  }
*/

    echo
    "<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\">
  <tr>
    <td colspan=\"4\" align=\"center\" class=\"prechod_tabulka_001\">Ceny ubytování:</td>
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
