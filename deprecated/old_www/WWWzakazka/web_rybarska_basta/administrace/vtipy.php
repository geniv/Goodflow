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
    <td align=\"center\" class=\"sekce_nadpis\">Vtipy</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"center\" colspan=\"3\" height=\"20px\"><hr></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"90%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">V této sekci můžete přidávat, upravovat a mazat <u>vtipy</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Po klapnutí na <u>Přidat vtip</u> se Vám zobrazí dvě textové pole do kterých napíšete <u>název skupiny vtipů</u> a <u>název vtipu</u>, textové pole do kterého napíšete <u>text vtipu</u>, a také výběr druhu pozadí pro skupinu a název vtipu.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=vtipy&akce=add\">Přidat vtip</a></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
$akce = $_GET["akce"];
$cislo = $_GET["cislo"];

  if (!Empty($_POST["tladd"]) && !Empty($_POST["nadpis1"]) && !Empty($_POST["nadpis2"]) && !Empty($_POST["text"]))
  {
    echo PridejVtip(".", htmlspecialchars($_POST["nadpis1"]), htmlspecialchars($_POST["nadpis2"]), $_POST["bar"], htmlspecialchars($_POST["text"]));
  }

  if (!Empty($_POST["tledit"]) && !Empty($cislo) && !Empty($_POST["nadpis1"]) && !Empty($_POST["nadpis2"]) && !Empty($_POST["text"]))
  {
    echo UpravVtip(".", htmlspecialchars($_POST["nadpis1"]), htmlspecialchars($_POST["nadpis2"]), $_POST["bar"], htmlspecialchars($_POST["text"]), $cislo);
  }

  if (!Empty($akce) && $akce == "del" && !Empty($cislo))
  {
/*
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\">Opravdu chcete smazat</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\">vtip s názvem: <u>".stripslashes(VratHodnotuVtipu(".", $cislo, 2))."</u></td>
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
echo SmazVtip(".", $cislo);
  }

/*
  if (!Empty($cislo) and !Empty($conf) and $conf == "Ano")
  {
    echo SmazVtip(".", $cislo);
  }

  if (!Empty($cislo) and !Empty($conf) and $conf == "Ne")
  {
    echo
    "<head>
     <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=vtipy\">
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

  if (!Empty($akce) and $akce == "add")
  {
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"right\">Název skupiny vtipů:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis1\" class=\"prechod_tabulka_input\" size=\"52\"></td>
  </tr>
  <tr>
    <td align=\"right\">Název vtipu:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis2\" class=\"prechod_tabulka_input\" size=\"52\"></td>
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
    <td align=\"center\" colspan=\"3\">Vyberte pozadí pro skupinu a název vtipu:</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" width=\"40%\">
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_001\"><input type=\"radio\" name=\"bar\" value=\"0\" checked>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_002\"><input type=\"radio\" name=\"bar\" value=\"1\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_003\"><input type=\"radio\" name=\"bar\" value=\"2\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_004\"><input type=\"radio\" name=\"bar\" value=\"3\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_005\"><input type=\"radio\" name=\"bar\" value=\"4\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_006\"><input type=\"radio\" name=\"bar\" value=\"5\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_007\"><input type=\"radio\" name=\"bar\" value=\"6\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_008\"><input type=\"radio\" name=\"bar\" value=\"7\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_009\"><input type=\"radio\" name=\"bar\" value=\"8\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_010\"><input type=\"radio\" name=\"bar\" value=\"9\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_011\"><input type=\"radio\" name=\"bar\" value=\"10\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_012\"><input type=\"radio\" name=\"bar\" value=\"11\">&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"tladd\" value=\"Přidat vtip\"></td>
  </tr>
</table>
    </form>";
  }

  if (!Empty($akce) and $akce == "edit" and !Empty($cislo))
  {
    switch (VratHodnotuVtipu(".", $cislo, 1))
    {
      case 0:
        $se[0] = "checked";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "";
      break;

      case 1:
        $se[0] = "";
        $se[1] = "checked";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "";
      break;

      case 2:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "checked";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "";
      break;

      case 3:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "checked";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "";
      break;

      case 4:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "checked";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "";
      break;

      case 5:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "checked";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "";
      break;

      case 6:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "checked";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "";
      break;

      case 7:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "checked";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "";
      break;

      case 8:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "checked";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "";
      break;

      case 9:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "checked";
        $se[10] = "";
        $se[11] = "";
      break;

      case 10:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "checked";
        $se[11] = "";
      break;

      case 11:
        $se[0] = "";
        $se[1] = "";
        $se[2] = "";
        $se[3] = "";
        $se[4] = "";
        $se[5] = "";
        $se[6] = "";
        $se[7] = "";
        $se[8] = "";
        $se[9] = "";
        $se[10] = "";
        $se[11] = "checked";
      break;
    }

    print
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"right\">Název skupiny vtipů:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis1\" value=\"".stripslashes(VratHodnotuVtipu(".", $cislo, 3))."\" class=\"prechod_tabulka_input\" size=\"52\"></td>
  </tr>
  <tr>
    <td align=\"right\">Název vtipu:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis2\" value=\"".stripslashes(VratHodnotuVtipu(".", $cislo, 2))."\" class=\"prechod_tabulka_input\" size=\"52\"></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\">Text aktuality:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><textarea name=\"text\" rows=\"6\" cols=\"40\">".stripslashes(VratHodnotuVtipu(".", $cislo, 0))."</textarea></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\">Vyberte pozadí pro skupinu a název vtipu:</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" width=\"40%\">
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_001\"><input type=\"radio\" name=\"bar\" value=\"0\" {$se[0]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_002\"><input type=\"radio\" name=\"bar\" value=\"1\" {$se[1]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_003\"><input type=\"radio\" name=\"bar\" value=\"2\" {$se[2]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_004\"><input type=\"radio\" name=\"bar\" value=\"3\" {$se[3]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_005\"><input type=\"radio\" name=\"bar\" value=\"4\" {$se[4]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_006\"><input type=\"radio\" name=\"bar\" value=\"5\" {$se[5]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_007\"><input type=\"radio\" name=\"bar\" value=\"6\" {$se[6]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_008\"><input type=\"radio\" name=\"bar\" value=\"7\" {$se[7]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_009\"><input type=\"radio\" name=\"bar\" value=\"8\" {$se[8]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_010\"><input type=\"radio\" name=\"bar\" value=\"9\" {$se[9]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_011\"><input type=\"radio\" name=\"bar\" value=\"10\" {$se[10]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" class=\"prechod_tabulka_012\"><input type=\"radio\" name=\"bar\" value=\"11\" {$se[11]}>&nbsp;pozadí pro skupinu a název vtipu&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"tledit\" value=\"Upravit vtip\"></td>
  </tr>
</table>
    </form>";
  }

  $nazev = "./vtipy_poiugfdavjhbsdvhjbvdsakjvksdvnsdvnbsdkjbsdkbv.php";
  $u = fopen($nazev, "r");
  $udaj = explode("--x--", fread($u, filesize($nazev)));
  fclose($u);

  $del = PocetPoliVtipy(".");
  $tabulka = "";
  for($i = (count($udaj) - 1) / $del; $i > 0 ; $i--)
  {
    $tabulka .=
    "<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\" width=\"500px\">
      <tr>
        <td align=\"center\" class=\"".VratHodnotuBarvy(".", $udaj[($i * $del) - 1] + 1)."\">".stripslashes($udaj[($i * $del) - 3])."</td>
        <td align=\"center\" class=\"".VratHodnotuBarvy(".", $udaj[($i * $del) - 1] + 1)."\">".stripslashes($udaj[($i * $del) - 2])."</td>
      </tr>
      <tr>
        <td align=\"center\" colspan=\"2\" class=\"prechod_tabulka_vtipy\">".KonverzeTextu(".", stripslashes($udaj[($i * $del)]))."</td>
      </tr>
      <tr>
        <td align=\"center\" colspan=\"2\" class=\"prechod_tabulka_004\">
          <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
            <tr>
              <td align=\"right\"><a href=\"index.php?kam=vtipy&akce=edit&cislo={$i}\">Upravit</a></td>
              <td align=\"center\" width=\"4%\">-</td>
              <td align=\"left\"><a href=\"index.php?kam=vtipy&akce=del&cislo={$i}\" onclick=\"return confirm('Opravdu chcete smazat vtip: {$udaj[($i * $del) - 3]} ?');\">Smazat</a></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
  }

  echo $tabulka;

}
  else
{
  echo HlaskaVypadni(".");
}
?>
