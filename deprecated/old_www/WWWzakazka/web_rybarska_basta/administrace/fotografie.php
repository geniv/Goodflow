<?
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  //DostaveniDelkyOtvirani(".", "false");
//nasimulovat jinym zpusobem!!! protoze tento je nemozny!
  $nazev = "./fotografie_qohdakcjbacjhbakfvbsdvkjbdvksdbvskdbvskdbvaskdbvsdv.php";
  $u = fopen($nazev, "r");
  $udaj = explode("--x--", fread($u, filesize($nazev)));
  fclose($u);

  $del = PocetPoliFotografie(".");

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
    $pod = stripslashes($udaj[($i * $del) - 0]);

    if(Empty($nad)){$nad = "&nbsp;";}
    if(Empty($pod)){$pod = "&nbsp;";}

    $tabulka .=
    "<td align=\"center\" class=\"prechod_tabulka_fotografie\" valign=\"center\">
    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
    <tr>
    <td align=\"center\" class=\"fotografie_tabulka\">{$nad}</td>
    </tr>
    </table>
    <a href=\"../".stripslashes($udaj[($i * $del) - 1])."\" target=\"_blank\"><img width=\"200\" height=\"138\" src=\"../".stripslashes($udaj[($i * $del) - 1])."\" border=\"2\"></a>
    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
    <tr>
    <td align=\"center\" class=\"fotografie_tabulka\">{$pod}</td>
    </tr>
    </table>
    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
    <tr>
    <td align=\"center\" class=\"fotografie_tabulka\"><u>{$i}</u></td>
    <td align=\"center\" class=\"fotografie_tabulka\"><a href=\"index.php?kam=fotografie&akce=edit&cislo={$i}\">upravit</a></td>
    <td align=\"center\" class=\"fotografie_tabulka\"><a href=\"index.php?kam=fotografie&akce=del&cislo={$i}\" onclick=\"return confirm('Opravdu chcete smazat forogafii: {$i} ?');\">smazat</a></td>
    </tr>
    </table>
    </td>
    {$rd}";
  } //end for i

  $result =
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_nadpis\">Fotografie</td>
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
    <td align=\"center\" class=\"sekce_text\">V této sekci můžete přidat fotku a k ní komentář, který může být nad fotkou, či pod ní.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Komentář můžete u každé fotky zvlášť upravit.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">U fotky nemusí být komentář, nebo může být jenom nad fotkou, nebo jen pod fotkou.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Po klapnutí na Přidat fotku se zobrazí textové pole kde napíšete komentáře a pak klapnete na vybrat fotku.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Tím se vám otevře sekce <u>Soubory z FTP</u>, kde vyberete Vámi nahranou fotku.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Při mazání fotky se zobrazí dotaz jestli chcete opravdu fotku odstranit.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=fotografie&akce=add\">Přidat fotku</a></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";

$cislo = $_GET["cislo"];
$nadpis = $_POST["nadpis"];
$popis = $_POST["popis"];

  if (!Empty($_POST["tladd"]) && !Empty($_FILES["soubor"]["tmp_name"]))
  {
    if (Empty($nadpis)){$nadpis = "";}
    if (Empty($popis)){$popis = "";}

    $cil = "obr/fotografie/{$_FILES["soubor"]["name"]}";
    if (move_uploaded_file($_FILES["soubor"]["tmp_name"], "../{$cil}"))
    {
      $result .= "<br />uploadovani probehlo uspesne<br />";
    }
      else
    {
      $result .= "<br />vyskytla se chyba!!<br />";
    }

    $nazev = "./fotografie_qohdakcjbacjhbakfvbsdvkjbdvksdbvskdbvskdbvaskdbvsdv.php";
    $u = fopen($nazev, "r");
    $udaj = explode("--x--", fread($u, filesize($nazev)));
    fclose($u);

    $pocet = 0;
    $del = PocetPoliFotografie(".");
    $pocet += (count($udaj) - 1) / $del;

    $udaj[0] = "<?php"; //ochrana
    $udaj[count($udaj) + 1] = $nadpis;
    $udaj[count($udaj) + 2] = $cil;
    $udaj[count($udaj) + 3] = $popis;

    $nazev = "./fotografie_qohdakcjbacjhbakfvbsdvkjbdvksdbvskdbvskdbvaskdbvsdv.php";
    $u = fopen($nazev, "w");
    fwrite($u, implode($udaj, "--x--"));
    fclose($u);

    $result .=
    "<head>
<meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=fotografie\">
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

  if (!Empty($_GET["akce"]) and $_GET["akce"] == "add" and Empty($_POST["tladd"]))
  {
    $result .=
    "<form method=\"post\" enctype=\"multipart/form-data\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\"><u>Komentář nad fotkou:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><u>Fotka:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"file\" name=\"soubor\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><u>Komentář pod fotkou:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"popis\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"tladd\" value=\"Přidat fotku\"></td>
  </tr>
</table>
    </form>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
  }

  if (!Empty($_GET["akce"]) and $_GET["akce"] == "edit" and !Empty($cislo))
  {
    $result .=
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\"><u>Komentář nad fotkou číslo {$cislo}:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis\" value=\"".stripslashes(VratHodnotuFotografie(".", $cislo, 2))."\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=\"center\"><u>Komentář pod fotkou číslo {$cislo}:</u></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"popis\" value=\"".stripslashes(VratHodnotuFotografie(".", $cislo, 0))."\" class=\"prechod_tabulka_input\"></td>
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

  if (!Empty($_POST["tledit"]) and !Empty($cislo))
  {
    if (Empty($nadpis)){$nadpis = "";}
    if (Empty($popis)){$popis = "";}
    echo UpravFotografii(".", $cislo, $nadpis, $popis);
  }

//".stripslashes(VratHodnotuFotografie(".", $cislo, 1))."

  if (!Empty($_GET["akce"]) && $_GET["akce"] == "del" && !Empty($cislo))
  {
/*
    $result .=
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\">Opravdu&nbsp;chcete&nbsp;smazat&nbsp;fotku číslo:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><u>{$cislo}</u></td>
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
    $result .= SmazatFotografii(".", $cislo);
  }

/*
  if (!Empty($cislo) and !Empty($_POST["conf"]) and $_POST["conf"] == "Ano")
  {
    echo SmazatFotografii(".", $cislo);
  }

  if (!Empty($cislo) and !Empty($_POST["conf"]) and $_POST["conf"] == "Ne")
  {
    $result .=
    "<head>
     <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=fotografie\">
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
  if (!Empty($_GET["akce"]) && $_GET["akce"] == "vyberfoto" && !Empty($_GET["co"]))
  {
    PridejMezPametDoFoto(".", htmlspecialchars($_GET["co"]), 2);
    echo PrepisMezPametDoFoto(".");
  }
*/

  $result .=
  "<table border=\"1\" cellspacing=\"3\" cellpadding=\"3\" align=\"center\" width=\"600px\" borderColorDark=\"white\" borderColorLight=\"white\" style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
    <tr>
    {$tabulka}
    </tr>
  </table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";

echo $result;

  //VratHodnotuFotografie($kde, $cislo, $poradi)
}
  else
{
  echo HlaskaVypadni(".");
}
?>
