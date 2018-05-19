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
    <td align=\"center\" class=\"sekce_nadpis\">Akce</td>
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
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"90%\">
  <tr>
    <td align=\"center\" class=\"sekce_text\">V této sekci můžete přidat, upravit nebo smazat <u>akci</u>. U každé akce můžete odmazat libovolně obrázek.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Po klapnutí na <u>Přidat akci</u> se Vám zobrazí dvě textové pole do kterých napíšete <u>nadpis akce</u> a <u>text akce</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Po vypsání textových polí klapnete na tlačítko <u>Pokračovat...</u> a poté můžete vybrat první logo klapnutím na <u>Vybrat logo (s umístněním)</u> přičemž se Vám otevře sekce <u>Soubory z FTP</u>, kde vyberete logo které chcete přiřadit na určité místo v akci, nebo můžete pokračovat v průvodci bez přidání fotky a nebo také můžete ukončit průvodce přičemž se akce uloží.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestliže v určité akci není obrázek, tak je nahrazen výchozím obrázkem s logem Rybářské Bašty.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestliže uložíte průvodce v průběhu přidávání obrázků, tak se vybrané obrázky uloží a na místo nevybraných obrázku se nastaví výchozí obrázek s logem Rybářské Bašty.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\"><u>--- Doporučení --- Nahrávejte malé loga nejlépe v poměru 4:3</u></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\"><u>--- Upozornění --- Jestliže nahrajete například první obrázek a druhý přeskočíte, tak je možné, že první obrázek se přiřadí na místo druhého. V takovém případě nevyžádaný obrázek manuálně odmažete</u></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=akce&akce=add\">Přidat akci</a></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";

$akce = $_GET["akce"];
$cislo = $_GET["cislo"];
  if (!Empty($akce) && $akce == "add")
  {
    echo
    "<form method=\"post\" enctype=\"multipart/form-data\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"right\">Nadpis akce:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis\" class=\"prechod_tabulka_input\" size=\"52\"></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\">Text akce:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><textarea name=\"text\" rows=\"6\" cols=\"40\"></textarea></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\">
    Vybrat obrázek pro levé vrchní logo: <input type=\"file\" name=\"soubor[]\"><br />
    Vybrat obrázek pro pravé vrchní logo: <input type=\"file\" name=\"soubor[]\"><br />
    Vybrat obrázek pro levé spodní logo: <input type=\"file\" name=\"soubor[]\"><br />
    Vybrat obrázek pro pravé spodní logo: <input type=\"file\" name=\"soubor[]\"><br />
    <input type=\"submit\" name=\"tladd\" value=\"Přidat\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
    </form>";

    if (!Empty($_POST["tladd"]) && !Empty($_POST["nadpis"]) && !Empty($_POST["text"]))
    {
      $nazev = "./akce_poijhydxsrfhjdhjgjsacsdjbdvcajhdsgfcajhfjahdgfjahdsbfasf.php";
      $u = fopen($nazev, "r");
      $udaj = explode("--x--", fread($u, filesize($nazev)));
      fclose($u);

      $pocet = 0;
      $del = PocetPoliAkce(".");
      $pocet += (count($udaj) - 1) / $del;

      $udaj[0] = "<?php"; //ochrana

      $result = "";
      $plus = $pocet + 1;
      for ($i = 0; $i < 4; $i++)
      {
        if (!Empty($_FILES["soubor"]["tmp_name"][$i]))
        {
          $cil = "obr/akce/{$i}_{$plus}_{$_FILES["soubor"]["name"][$i]}";
          if (move_uploaded_file($_FILES["soubor"]["tmp_name"][$i], "../{$cil}"))
          {
            $result .= "<br />uploadovani {$i} probehlo uspesne<br />";

            $udaj[count($udaj) + ($i + 1)] = $cil;
          }
            else
          {
            $result .= "<br />vyskytla se chyba!!<br />";
          }
        }
          else
        {
          $udaj[count($udaj) + ($i + 1)] = "";
        }
      }

      $udaj[count($udaj) + 5] = $_POST["nadpis"];
      $udaj[count($udaj) + 6] = $_POST["text"];

      $nazev = "./akce_poijhydxsrfhjdhjgjsacsdjbdvcajhdsgfcajhfjahdgfjahdsbfasf.php";
      $u = fopen($nazev, "w");
      fwrite($u, implode($udaj, "--x--"));
      fclose($u);

      $result .=
      "
      <head>
        <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=akce\">
      </head>
      ";

      echo $result;

/*
      if (!Empty($_POST["tlupload"]) && !Empty($_FILES["soubor"]["tmp_name"]))
      {
        $cil = "../menu.doc";
        if (move_uploaded_file($_FILES["soubor"]["tmp_name"], $cil))
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
      }
*/

/*
      $nazev = "./akce_poijhydxsrfhjdhjgjsacsdjbdvcajhdsgfcajhfjahdgfjahdsbfasf.php";
      $u = fopen($nazev, "r");
      $udaj = explode("--x--", fread($u, filesize($nazev)));
      fclose($u);

      $pocet = 0;
      $del = PocetPoliAkce($kde);
      $pocet += (count($udaj) - 1) / $del;
      //jinak!!
      $udaj[0] = "<?php"; //ochrana
      if (!Empty($obr1))
      {
        $udaj[count($udaj) + 1] = ZmenseniObrazku($obr1, "logo{$pocet}_0");
      }
        else
      {
        $udaj[count($udaj) + 1] = "";
      }

      if (!Empty($obr2))
      {
        $udaj[count($udaj) + 2] = ZmenseniObrazku($obr2, "logo{$pocet}_1");
      }
        else
      {
        $udaj[count($udaj) + 2] = "";
      }

      if (!Empty($obr3))
      {
        $udaj[count($udaj) + 3] = ZmenseniObrazku($obr3, "logo{$pocet}_2");
      }
        else
      {
        $udaj[count($udaj) + 3] = "";
      }

      if (!Empty($obr4))
      {
        $udaj[count($udaj) + 4] = ZmenseniObrazku($obr4, "logo{$pocet}_3");
      }
        else
      {
        $udaj[count($udaj) + 4] = "";
      }

      $udaj[count($udaj) + 5] = $nadpis;
      $udaj[count($udaj) + 6] = $text;

      $nazev = "./akce_poijhydxsrfhjdhjgjsacsdjbdvcajhdsgfcajhfjahdgfjahdsbfasf.php";
      $u = fopen($nazev, "w");
      fwrite($u, implode($udaj, "--x--"));
      fclose($u);
*/
    }
  }

  if (!Empty($akce) and $akce == "edit" and !Empty($cislo))
  {
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"right\">Nadpis akce:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><input type=\"text\" name=\"nadpis\" class=\"prechod_tabulka_input\" size=\"52\" value=\"".stripslashes(VratHodnotuAkce(".", $cislo, 1))."\"></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\">Text akce:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><textarea name=\"text\" rows=\"6\" cols=\"40\">".stripslashes(VratHodnotuAkce(".", $cislo, 0))."</textarea></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"hidden\" name=\"krok\" value=\"0\"><input type=\"submit\" name=\"tledit\" value=\"Upravit akci\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
    </form>";
  }

  if (!Empty($_POST["tledit"]) && !Empty($_POST["nadpis"]) && !Empty($_POST["text"]) && !Empty($cislo))
  {
    echo UpravAkci(".", $cislo, $_POST["nadpis"], $_POST["text"]);
  }

  if (!Empty($akce) && $akce == "delfoto" && !Empty($cislo) && !Empty($_GET["ft"]))
  {
/*
    switch($ft)
    {
      case 2:
      $umistobr = "Pravý spodní";
      break;

      case 3:
      $umistobr = "Levý spodní";
      break;

      case 4:
      $umistobr = "Pravý vrchní";
      break;

      case 5:
      $umistobr = "Levý vrchní";
      break;
    }

    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\">Opravdu chcete smazat</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><u>$umistobr obrázek</u> u akce s názvem: <u>".stripslashes(VratHodnotuAkce(".", $cislo, 1))."</u></td>
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
  echo SmazObrazek(".", $_GET["ft"], $cislo);
  }

  if (!Empty($akce) && $akce == "del" && !Empty($cislo))
  {
/*
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\">Opravdu chcete smazat akci s názvem:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><u>".stripslashes(VratHodnotuAkce(".", $cislo, 1))."</u></td>
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

  echo SmazAkci(".", $cislo);
  }

/*
  if (!Empty($cislo) and !Empty($conf) and $conf == "Ano" and !Empty($ft) and !Empty($akce) and $akce == "delfoto")
  {
    echo SmazObrazek(".", $ft, $cislo);
  }

  if (!Empty($cislo) and !Empty($conf) and $conf == "Ne" and !Empty($ft) and !Empty($akce) and $akce == "delfoto")
  {
    echo
    "<head>
     <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=akce\">
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


  if (!Empty($akce) and $akce == "del" and !Empty($cislo))
  {
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\">Opravdu chcete smazat akci s názvem:</td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"center\"><u>".stripslashes(VratHodnotuAkce(".", $cislo, 1))."</u></td>
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

  echo SmazAkci(".", $cislo);
  }

  if (!Empty($cislo) and !Empty($conf) and $conf == "Ano" and !Empty($akce) and $akce == "del")
  {
    echo SmazAkci(".", $cislo);
  }

  if (!Empty($cislo) and !Empty($conf) and $conf == "Ne" and !Empty($akce) and $akce == "del")
  {
    echo
    "<head>
     <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=akce\">
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

  if (!Empty($tladd) and !Empty($nadpis) and !Empty($text) and Empty($krok))
  {
    $krok++;
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\"><hr></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=soubory&selpro=1&krok=$krok&jmn=tlnext0\">Vybrat obrázek pro levé vrchní logo</a></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"><input type=\"hidden\" name=\"krok\" value=\"$krok\"><input type=\"submit\" name=\"tlnext0\" value=\"Přeskočit obrázek...\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"><input type=\"submit\" name=\"tlkon\" value=\"Ukončit průvodce...\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\"><hr></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
    </form>";
    PridejMezPametDoAkce(".", htmlspecialchars($nadpis), 0);
    PridejMezPametDoAkce(".", htmlspecialchars($text), 1);
  }

  if (!Empty($tlnext0) and !Empty($krok) and $krok == 1)
  {
    $krok++;
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\"><hr></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=soubory&selpro=2&krok=$krok&jmn=tlnext1\">Vybrat obrázek pro pravé vrchní logo</a></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"><input type=\"hidden\" name=\"krok\" value=\"$krok\"><input type=\"submit\" name=\"tlnext1\" value=\"Přeskočit obrázek...\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"><input type=\"submit\" name=\"tlkon\" value=\"Ukončit průvodce...\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\"><hr></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
    </form>";
    if (Empty($co)){$co = "";}
    PridejMezPametDoAkce(".", htmlspecialchars($co), 2);
  }

  if (!Empty($tlnext1) and !Empty($krok) and $krok == 2)
  {
    $krok++;
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\"><hr></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=soubory&selpro=3&krok=$krok&jmn=tlnext2\">Vybrat obrázek pro levé spodní logo</a></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"><input type=\"hidden\" name=\"krok\" value=\"$krok\"><input type=\"submit\" name=\"tlnext2\" value=\"Přeskočit obrázek...\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"><input type=\"submit\" name=\"tlkon\" value=\"Ukončit průvodce...\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\"><hr></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
    </form>";
    if (Empty($co)){$co = "";}
    PridejMezPametDoAkce(".", htmlspecialchars($co), 3);
  }

  if (!Empty($tlnext2) and !Empty($krok) and $krok == 3)
  {
    $krok++;
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\"><hr></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\"><a href=\"index.php?kam=soubory&selpro=4&krok=$krok&jmn=tlnext3\">Vybrat obrázek pro pravé spodní logo</a></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"><input type=\"hidden\" name=\"krok\" value=\"$krok\"><input type=\"submit\" name=\"tlkon\" value=\"Ukončit průvodce...\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\"><hr></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
    </form>";
    if (Empty($co)){$co = "";}
    PridejMezPametDoAkce(".", htmlspecialchars($co), 4);
  } //<input type=\"submit\" name=\"tlnext3\" value=\"Dokončit průvodce\">

  if (!Empty($tlnext3) and !Empty($krok) and $krok == 4)
  {
    if (Empty($co)){$co = "";}
    PridejMezPametDoAkce(".", htmlspecialchars($co), 5);
    echo
    "<head>
    <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=akce\">
    </head>";
    echo PrepisMezPametDoAkce(".");
  }
*/
  if (!Empty($tlkon))
  {
    echo
    "<head>
    <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=akce\">
    </head>";
    echo PrepisMezPametDoAkce(".");
  }

  $nazev = "./akce_poijhydxsrfhjdhjgjsacsdjbdvcajhdsgfcajhfjahdgfjahdsbfasf.php";
  $u = fopen($nazev, "r");
  $udaj = explode("--x--", fread($u, filesize($nazev)));
  fclose($u);

  $del = PocetPoliAkce(".");
  $tabulka = "";
  for($i = (count($udaj) - 1) / $del; $i > 0 ; $i--)
  {
    if (!Empty($udaj[($i * $del) - 5]))
      {$obr1 = "<img src=\"../".stripslashes($udaj[($i * $del) - 5])."\" width=\"200\" height=\"138\" border=\"1\"><br>
      <a href=\"index.php?kam=akce&akce=delfoto&cislo={$i}&ft=5\" onclick=\"return confirm('Opravdu chcete smazat obrázek: {$udaj[($i * $del) - 5]} ?');\">Smazat obrázek</a>";}
        else
      {$obr1 = "<img src=\"../obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\">";}

    if (!Empty($udaj[($i * $del) - 4]))
      {$obr2 = "<img src=\"../".stripslashes($udaj[($i * $del) - 4])."\" width=\"200\" height=\"138\" border=\"1\"><br>
      <a href=\"index.php?kam=akce&akce=delfoto&cislo={$i}&ft=4\" onclick=\"return confirm('Opravdu chcete smazat obrázek: {$udaj[($i * $del) - 4]} ?');\">Smazat obrázek</a>";}
        else
      {$obr2 = "<img src=\"../obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\">";}

    if (!Empty($udaj[($i * $del) - 3]))
      {$obr3 = "<img src=\"../".stripslashes($udaj[($i * $del) - 3])."\" width=\"200\" height=\"138\" border=\"1\"><br>
      <a href=\"index.php?kam=akce&akce=delfoto&cislo={$i}&ft=3\" onclick=\"return confirm('Opravdu chcete smazat obrázek: {$udaj[($i * $del) - 3]} ?');\">Smazat obrázek</a>";}
        else
      {$obr3 = "<img src=\"../obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\">";}

    if (!Empty($udaj[($i * $del) - 2]))
      {$obr4 = "<img src=\"../".stripslashes($udaj[($i * $del) - 2])."\" width=\"200\" height=\"138\" border=\"1\"><br>
      <a href=\"index.php?kam=akce&akce=delfoto&cislo={$i}&ft=2\" onclick=\"return confirm('Opravdu chcete smazat obrázek: {$udaj[($i * $del) - 2]} ?');\">Smazat obrázek</a>";}
        else
      {$obr4 = "<img src=\"../obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\">";}

    $tabulka .=
    "<table border=\"1\" cellspacing=\"2\" cellpadding=\"3\" align=\"center\" width=\"720px\" borderColorDark=\"black\" borderColorLight=\"black\">
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_fotografie\">{$obr1}</td>
      <td align=\"center\" rowspan=\"4\" width=\"100%\" class=\"prechod_tabulka_akce\" valign=\"top\">
        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
        <tr>
          <td height=\"106px\"></td>
        </tr>
        </table>
        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
        <tr>
          <td class=\"vel1\">".stripslashes($udaj[($i * $del) - 1])."</td>
        </tr>
        </table>
        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
        <tr>
          <td height=\"10px\"></td>
        </tr>
        </table>
        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
        <tr>
          <td align=\"center\" class=\"akce_font\" height=\"160px\" valign=\"top\">".stripslashes($udaj[($i * $del) - 0])."</td>
        </tr>
        </table>
        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
        <tr>
          <td align=\"right\">&nbsp;<a href=\"index.php?kam=akce&akce=edit&cislo={$i}\">Upravit&nbsp;akci</a>&nbsp;</td>
          <td align=\"center\" width=\"10%\">&nbsp;-&nbsp;</td>
          <td align=\"left\">&nbsp;<a href=\"index.php?kam=akce&akce=del&cislo={$i}\" onclick=\"return confirm('Opravdu chcete smazat akci: {$udaj[($i * $del) - 1]} ?');\">Smazat&nbsp;akci</a>&nbsp;</td>
        </tr>
        </table>
      </td>
      <td align=\"center\" class=\"prechod_tabulka_fotografie\">{$obr2}</td>
    </tr>
    <tr>
      <td align=\"center\" class=\"prechod_tabulka_fotografie\">{$obr3}</td>
      <td align=\"center\" class=\"prechod_tabulka_fotografie\">{$obr4}</td>
    </tr>
    </table>
    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
    <tr>
      <td height=\"20px\"></td>
    </tr>
    </table>";
  }

  echo $tabulka;
}
  else
{
  echo HlaskaVypadni(".");
}


  /*
  <table border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"3\" width=\"680px\" borderColorDark=\"black\" borderColorLight=\"black\">
    <tr>
      <td class=\"prechod_tabulka_001\">".stripslashes($udaj[($i * $del) - 2])."</td>
    </tr>
    <tr>
      <td class=\"prechod_tabulka_004_cas\">{$udaj[($i * $del) - 1]}</td>
    </tr>
    <tr>
      <td class=\"prechod_tabulka_aktualita\">".stripslashes($udaj[($i * $del)])."</td>
    </tr>
    </table>
    <hr>
  */

    //print_r($_POST);

  /*  <input type=\"submit\" name=\"tlnext3\" value=\"Pokračovat v průvodci >>\"><br>
  if (!Empty($tladd) and !Empty($nadpis) and !Empty($text))
  {
    if (Empty($obr1)){$obr1 = "";}
    if (Empty($obr2)){$obr2 = "";}
    if (Empty($obr3)){$obr3 = "";}
    if (Empty($obr4)){$obr4 = "";}
    print PridejAkci(".", $obr1, $obr2, $obr3, $obr4, $nadpis, $text);
  }
  */
  //VratHodnotuAkce($kde, $cislo)

/*
  print
  "<br>test:
  <form method=\"post\" enctype=\"multipart/form-data\">
  1<input type=\"file\" name=\"obr1\">
  <input type=\"submit\" name=\"tl\" value=\"Přidat akci\">
  </form>";

 // print $obr1;

  print
  "<br>test:
  <form method=\"post\" enctype=\"multipart/form-data\">
  1<input type=\"file\" name=\"obr1\">
  <input type=\"submit\" name=\"tladd\" value=\"Přidat akci\">
  </form>";


  1:upload originalu...na server a pak
  2:zmenšení na požadovanou velikost... až při zápisu obrázků 200 x 138

  ošetřit vstupy!!:  stripslashes() {odstranění} lomítek htmlspecialchars() <-- !!! {speciální znaky na entity}


  if (!Empty($tladd) and !Empty($obr1))
  {
    ZmenseniObrazku($obr1);
  }*/
?>
