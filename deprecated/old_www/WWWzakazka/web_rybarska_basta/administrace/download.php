<?
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  //DostaveniDelkyOtvirani(".", "false");

  $nazev = "./soubory_qwertzuijsfvjgsdhcsdhjvbcnxsajhgxuhiwjxzwebhxiuerfbnchbe.php";
  $u = fopen($nazev, "r");
  $udaj = explode("--x--", fread($u, filesize($nazev)));
  fclose($u);

  $del = PocetPoliSoubor(".");

  $nowradek = "</tr><tr>";
  $pocrad = 3;

  $tabulka = "";
  for($i = (count($udaj) - 1) / $del; $i > 0 ; $i--)
  {
    $pocrad--;
    if ($pocrad == 0 and $i > 1)
    {
      $rd = $nowradek;
    }
      else
    {
      $rd = "";
    }

    if ($pocrad == 0)
    {
      $pocrad = 3;
    }

    $nad = stripslashes($udaj[($i * $del) - 2]);
    $pod = stripslashes($udaj[($i * $del) - 1]);

    if(Empty($nad)){$nad = "&nbsp;";}
    if(Empty($pod)){$pod = "&nbsp;";}

    //<img width=\"200\" height=\"138\" src=\"../".stripslashes($udaj[($i * $del) - 1])."\" border=\"2\">

    $tabulka .=
    "<td align=\"center\" class=\"prechod_tabulka_fotografie\" valign=\"center\">
    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
    <tr>
    <td align=\"center\" class=\"fotografie_tabulka\">{$nad}</td>
    </tr>
    </table>
    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
    <tr>
    <td align=\"center\" class=\"fotografie_tabulka\">{$pod}</td>
    </tr>
    </table>
    <a href=\"../".stripslashes($udaj[($i * $del) - 0])."\" target=\"_blank\">
      nějaký formát názvu: ".RozlisLomitko(stripslashes($udaj[($i * $del) - 0]), 2)."
    </a>

    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
    <tr>
    <td align=\"center\" class=\"fotografie_tabulka\"><u>{$i}</u></td>
    <td align=\"center\" class=\"fotografie_tabulka\"><a href=\"index.php?kam=download&akce=edit&cislo={$i}\">upravit</a></td>
    <td align=\"center\" class=\"fotografie_tabulka\"><a href=\"index.php?kam=download&akce=del&cislo={$i}\" onclick=\"return confirm('Opravdu chcete smazat aktuality s nazvem: {$udaj[($i * $del) - 1]} ?');\">smazat</a></td>
    </tr>
    </table>
    </td>
    {$rd}";
  } //end for i

$akce = $_GET["akce"];
$cislo = $_GET["cislo"];

  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_nadpis\">Ke stažení</td>
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
    <td align=\"center\" class=\"sekce_text\">V této sekci můžete přidat své vlastní soubory, které nahrajete do složky <u>Upload</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Poté zde klapnete na <u>Přidat soubor</u> a vyplníte nadpis a popis souboru.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Poté už jenom klapnete na tlačítko <u>Vybrat soubor</u> a vyberete ho.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=download&akce=add\">Přidat soubor</a></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
</table>";

if (!Empty($akce) && $akce == "add") // and Empty($tladd)
  {
  echo
  "<form method=\"post\" enctype=\"multipart/form-data\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\"><u>Nadpis:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><u>Popis:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"popis\" class=\"prechod_tabulka_input\" /><br />
    <input type=\"file\" name=\"soubor\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"tladd\" value=\"Vybrat soubor\"></td>
  </tr>
</table>
    </form>";

    if (!Empty($_POST["tladd"]) && !Empty($_FILES["soubor"]["tmp_name"]))
    {
      $result = "";

      $cil = "obr/download/{$_FILES["soubor"]["name"]}";
      if (move_uploaded_file($_FILES["soubor"]["tmp_name"], "../{$cil}"))
      {
        $result = "<br />uploadovani probehlo uspesne<br />
        <head>
         <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=jidelnicek\">
         </head>
        ";
      }
        else
      {
        $result = "<br />vyskytla se chyba!!<br />";
      }

echo $result;
      echo PridejSoubor(".", $_POST["nadpis"], $_POST["popis"], $cil);
    }
  }

/*
  if (!Empty($tladd))
  {
    if (Empty($nadpis)){$nadpis = "";}
    if (Empty($popis)){$popis = "";}

    PridejMezPametDoDownload(".", htmlspecialchars($nadpis), 0);
    PridejMezPametDoDownload(".", htmlspecialchars($popis), 1);

  echo
  "<head>
  <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=soubory&selpro=6\">
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

    if (!Empty($akce) && $akce == "edit" && !Empty($cislo))
  {
    echo
    "<form method=\"post\">
  <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\"><u>nadpis souboru číslo {$cislo}:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis\" value=\"".stripslashes(VratHodnotuSouboru(".", $cislo, 2))."\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><u>popis souboru číslo {$cislo}:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"popis\" value=\"".stripslashes(VratHodnotuSouboru(".", $cislo, 1))."\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"tledit\" value=\"Upravit fotku\"></td>
  </tr>
</table>
    </form>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
  }

$nadpis = $_POST["nadpis"];
$popis = $_POST["popis"];
  if (!Empty($_POST["tledit"]) && !Empty($cislo))
  {
    //if (Empty($_POST["nadpis)){$_POSTnadpis = "";}
    //if (Empty($_POST["popis)){$popis = "";}
    echo UpravSoubor(".", $nadpis, $popis, $cislo);
  }

  if (!Empty($akce) && $akce == "del" && !Empty($cislo))
  {
/*
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\">Opravdu&nbsp;chcete&nbsp;smazat&nbsp;soubor číslo:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><u>$cislo</u></td>
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
echo SmazSoubor(".", $cislo);
  }

/*
  if (!Empty($cislo) and !Empty($conf) and $conf == "Ano")
  {
    echo SmazSoubor(".", $cislo);
  }

  if (!Empty($cislo) and !Empty($conf) and $conf == "Ne")
  {
    echo
    "<head>
     <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=download\">
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

/*
  if (!Empty($akce) and $akce == "vybersoubor" and !Empty($co))
  {
    PridejMezPametDoDownload(".", htmlspecialchars($co), 2);
    echo PrepisMezPametDoDownload(".");
  }
*/

  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
  <table border=\"1\" cellspacing=\"3\" cellpadding=\"3\" align=\"center\" width=\"600px\" borderColorDark=\"white\" borderColorLight=\"white\" style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
    <tr>
    {$tabulka}
    </tr>
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
