<?
if (!Empty($_COOKIE["R_jmeno"]) && !Empty($_COOKIE["R_heslo"]) && !Empty($_COOKIE["R_ID"]) && LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" && LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{

if (Empty($_GET["action"]))
{
  $aktualni_soubor = "index.php";
  //"soubory.php"; //basename(__FILE__);
  $pol = "../Upload";
  $i = 0;
  $cesta[] = "";
  $soubor[] = "";
  $handle = opendir($pol);
  while($soub = readdir($handle))
  {
    $i++;
    $cesta[$i] = $soub;
    $sbr = stat("$pol/$soub"); //Date("j.n. Y G:i:s", )
    $soubor[$i] = $sbr[10];
  }
  closedir($handle);

  //rsort($cesta);  //seřazení    <td>Link</td>
  //array_pop($cesta);
  //array_pop($cesta);
  //array_pop($cesta);

  arsort($cesta);
  reset($cesta);

  //rsort($soubor);  //seřazení    <td>Link</td>
  //array_pop($soubor);
  //array_pop($soubor);
  //array_pop($soubor);
  //print_r($soubor);
  //print "<br>";

  arsort($soubor); //řadit nějak podle datumu
  reset($soubor);

  $soubor = array_keys($soubor);

  //print_r($cesta);

  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_nadpis\">Soubory z FTP</td>
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
    <td align=\"center\" class=\"sekce_text\">Tato sekce je určena pro správcování souborů ve složce <u>Upload</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Chcete-li přepsat ceník nebo jídelníček, tak dotyčný soubor s koncovkou <u>.doc</u> překopírujte do složky <u>Upload</u> a poté u dotyčného souboru ve spodním seznamu klapněte na odkaz <u>Provést akci</u>. Dále jste vyzváni na vybrání provedení akce dotyčnému souboru.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Na místo jídelníčku nebo outdoor ceníku můžete nahrát jen soubory typu <u>.doc</u></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestli nahrajete jiný soubor nežli <u>.doc</u> tak ho nebudete moct přepsat místo jídelníčku nebo outdoor ceníku.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestli chcete nahrát fotku do sekce <u>Fotografie</u>, tak nahrejte obrázek do složky <u>Upload</u> a poté v <u>administraci</u> přidáte fotku pomocí sekce <u>Fotografie -> Přidat fotku</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">>>>>>>>>>> <u>!!! doporučujeme nahrávat logo o malé velikosti a v poměru 4:3 !!!</u> <<<<<<<<<<</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestli chcete nahrát logo do sekce <u>Akce</u>, tak nahrejte obrázek do složky <u>Upload</u> a poté v <u>administraci</u> přidáte logo pomocí sekce <u>Akce -> Přidat akci</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">>>>>>>>>>> <u>!!! doporučujeme nahrávat logo o malé velikosti a v poměru 4:3 !!!</u> <<<<<<<<<<</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestli jsou ve složce <u>Upload</u> obrázky ve formátu <u>.jpg</u> nebo <u>.gif</u> tak se zobrazí náhledy.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Pro fotky do sekce <u>Fotografie</u> doporučujeme nahrávat obrázky ve formátu <u>.jpg</u> a pro loga do sekce <u>Akce</u> doporučujeme nahrávat obrázky ve formátu <u>.gif</u>, můžou být samozřejmě i <u>.jpg</u></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">>>>>>>>>>> <u>!!! UPOZORNĚNÍ - NAHRÁVEJTE FOTKY BEZ MEZER A BEZ DIAKRITIKY, tj. BEZ HÁČKŮ A ČÁREK !!!</u> <<<<<<<<<<</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestli nahrajete fotky s mezerami nebo s diakritikou tak se obrázky nezobrazí.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"><br /><a href=\"?kam=soubory&amp;action=addfile\">uploadovat soubor</a><br /><br /></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\"><h2>V Názvu fotky nesmí být tečky ! tj. musí být JEDNA tečka v příponě souboru - tj: .jpg, .gif, .bmp, atd...</h2></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";

  if (!Empty($_GET["akce"]) && $_GET["akce"] == "proved" && !Empty($_GET["co"]))
  {
    $coces = explode("/", $_GET["co"]);
    echo
    "<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"right\"><input type=\"radio\" name=\"sel\" value=\"2\" checked></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"left\">Smazat soubor: <u>{$coces[2]}</u></td>
  </tr>
  <tr>
    <td align=\"right\"><input type=\"radio\" name=\"sel\" value=\"0\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"left\">Tímto souborem přepsat <u>jídelníček</u></td>
  </tr>
  <tr>
    <td align=\"right\"><input type=\"radio\" name=\"sel\" value=\"1\"></td>
    <td align=\"center\">&nbsp;</td>
    <td align=\"left\">Tímto souborem přepsat <u>outdoor ceník</u></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"6px\" colspan=\"3\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"hidden\" name=\"co\" value=\"{$_GET["co"]}\">";
    if (Empty($_POST["tlakc"]))
    {
      echo "<input type=\"submit\" name=\"tlakc\" value=\"Provést akci\">";
    }
    echo
    "</td>
  </tr>
</table>
</form>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";

    if (!Empty($_POST["tlakc"]) and !Empty($_GET["co"]))
    {
      switch ($_POST["sel"])
      {
        case 0:
          if (RozlisPriponu($_GET["co"], 3) == "doc")
          {
            if (copy($_GET["co"], "../menu.doc") == true)
            {
              echo "<head>
            <meta http-equiv=\"refresh\" content=\"3;URL=index.php?kam=soubory\">
            </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">Jídelníček byl přepsán.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
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
              else
            {
              echo "<head>
            <meta http-equiv=\"refresh\" content=\"3;URL=index.php?kam=soubory\">
            </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">Jídelníček nebyl přepsán.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
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
          }
            else
          {
            echo "<head>
            <meta http-equiv=\"refresh\" content=\"3;URL=index.php?kam=soubory\">
            </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">Pokoušíte se nahrát jiný typ souboru než <u>.doc</u></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
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
        break;

        case 1:
          if (RozlisPriponu($_GET["co"], 3) == "doc")
          {
            if (copy($_GET["co"], "../cenik_outdoor.doc") == true)
            {
              echo "<head>
            <meta http-equiv=\"refresh\" content=\"3;URL=index.php?kam=soubory\">
            </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">Outdoor ceník byl přepsán.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
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
              else
            {
              echo "<head>
            <meta http-equiv=\"refresh\" content=\"3;URL=index.php?kam=soubory\">
            </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">Outdoor ceník nebyl přepsán.</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
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
          }
            else
          {
            echo "<head>
            <meta http-equiv=\"refresh\" content=\"3;URL=index.php?kam=soubory\">
            </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">Pokoušíte se nahrát jiný typ souboru než <u>.doc</u></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
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
        break;

        case 2:
          if (!unlink($_GET["co"]))
          {
            echo
            "<head>
            <meta http-equiv=\"refresh\" content=\"3;URL=index.php?kam=soubory\">
            </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">Soubor nebyl smazán</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
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
            else
          {
            echo
            "<head>
            <meta http-equiv=\"refresh\" content=\"3;URL=index.php?kam=soubory\">
            </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">Soubor byl smazán</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
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
        break;
      }
    } //end if
  }


//time of last change (11)-1 = 10
  echo
  "<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" borderColorDark=\"#3886C6\" borderColorLight=\"#25548A\">
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_001\">&nbsp;Náhled jen pro JPG a GIF&nbsp;</td>
    <td align=\"center\" class=\"prechod_tabulka_001\">&nbsp;Odkaz&nbsp;</td>
    <td align=\"center\" class=\"prechod_tabulka_001\">&nbsp;Velikost&nbsp;</td>
    <td align=\"center\" class=\"prechod_tabulka_001\">&nbsp;Datum poslední změny&nbsp;</td>
    <td align=\"center\" class=\"prechod_tabulka_001\">&nbsp;Akce&nbsp;</td>
  </tr>";

  $celsum = 0;
  if(count($cesta) != 3)
  {
    $sum = 0;
    for($i = 0; $i < count($cesta); $i++)
    {
      //------------------------------------------------------------
      if (!Empty($_GET["selpro"]) && ($_GET["selpro"] <= 5) and
          (RozlisPriponu($cesta[$soubor[$i]], 1) == "jpg" || RozlisPriponu($cesta[$soubor[$i]], 1) == "JPG" or
           RozlisPriponu($cesta[$soubor[$i]], 1) == "gif" || RozlisPriponu($cesta[$soubor[$i]], 1) == "GIF"))
      {
        switch ($_GET["selpro"])
        {
          case 1:
            $action = "<a href=\"{$aktualni_soubor}?kam=akce&akce=vyberobr1&co={$pol}/{$cesta[$soubor[$i]]}&krok={$krok}&{$jmn}=neco\" class=\"odkaz\">Vybrat obrázek pro levé vrchní logo</a>";
          break;

          case 2:
            $action = "<a href=\"{$aktualni_soubor}?kam=akce&akce=vyberobr2&co={$pol}/{$cesta[$soubor[$i]]}&krok={$krok}&{$jmn}=neco\" class=\"odkaz\">Vybrat obrázek pro pravé vrchní logo</a>";
          break;

          case 3:
            $action = "<a href=\"{$aktualni_soubor}?kam=akce&akce=vyberobr3&co={$pol}/{$cesta[$soubor[$i]]}&krok={$krok}&{$jmn}=neco\" class=\"odkaz\">Vybrat obrázek pro levé spodní logo</a>";
          break;

          case 4:
            $action = "<a href=\"{$aktualni_soubor}?kam=akce&akce=vyberobr4&co={$pol}/{$cesta[$soubor[$i]]}&krok={$krok}&{$jmn}=neco\" class=\"odkaz\">Vybrat obrázek pro pravé spodní logo</a>";
          break;

          case 5:
            $action = "<a href=\"{$aktualni_soubor}?kam=fotografie&akce=vyberfoto&co={$pol}/{$cesta[$soubor[$i]]}\" class=\"odkaz\">Vybrat fotku</a>";
          break;
        }

      }
        else
      {
        if(!Empty($_GET["selpro"]) and $_GET["selpro"] == 6)
        {
          $action = "<a href=\"{$aktualni_soubor}?kam=download&akce=vybersoubor&co={$pol}/{$cesta[$soubor[$i]]}\" class=\"odkaz\">Vybrat soubor</a>";
        }
          else
        {
          $action = "<a href=\"{$aktualni_soubor}?kam=soubory&akce=proved&co={$pol}/{$cesta[$soubor[$i]]}\" class=\"odkaz\">Provést akci</a>";
        }
      }

      //------------------------------------------------------------
      if (file_exists ("{$pol}/{$cesta[$soubor[$i]]}") == true)
      {
        $vel = filesize("{$pol}/{$cesta[$soubor[$i]]}");
        $sum += $vel;
        if($vel >= 1048576)
        {
          $velikost = sprintf("%.2lf MB", $vel / 1048576);
        }
            else
        if($vel >= 1024)
        {
          $velikost = sprintf("%.2lf kB", $vel / 1024);
        }
          else
        {
          $velikost = sprintf("%.2lf Bytes", $vel);
        }
      }
      //------------------------------------------------------------
      if($sum >= 1048576) //celková velikost
      {
        $celsum = sprintf("%.2lf MB", $sum / 1048576);
      }
          else
      if($sum >= 1024)
      {
        $celsum = sprintf("%.2lf kB", $sum / 1024);
      }
        else
      {
        $celsum = sprintf("%.2lf Bytes", $sum);
      }
      //------------------------------------------------------------
      if (RozlisPriponu($cesta[$soubor[$i]], 1) == "jpg" || RozlisPriponu($cesta[$soubor[$i]], 1) == "JPG" or
          RozlisPriponu($cesta[$soubor[$i]], 1) == "gif" || RozlisPriponu($cesta[$soubor[$i]], 1) == "GIF")
      {
        $img = "<img width=\"200\" height=\"138\" src=\"{$pol}/{$cesta[$soubor[$i]]}\">";
      }
        else
      {
        $img = "Náhled jen pro JPG a GIF";
      }

      if ((file_exists ("$pol/{$cesta[$soubor[$i]]}") == true) && ($cesta[$soubor[$i]] != ".") && ($cesta[$soubor[$i]] != ".."))
      {
        rename("{$pol}/{$cesta[$soubor[$i]]}", KontrolaJmena("{$pol}/{$cesta[$soubor[$i]]}")); //kontrola souborů
        $info = stat("{$pol}/{$cesta[$soubor[$i]]}");
        echo
        "<tr>
          <td align=\"center\" class=\"prechod_tabulka_vtipy\">{$img}</td>
          <td align=\"center\" class=\"prechod_tabulka_vtipy\">&nbsp;<a href=\"{$pol}/{$cesta[$soubor[$i]]}\" target=\"_blank\" class=\"odkaz\">{$cesta[$soubor[$i]]}</a>&nbsp;</td>
          <td align=\"center\" class=\"prechod_tabulka_vtipy\">&nbsp;{$velikost}&nbsp;</td>
          <td align=\"center\" class=\"prechod_tabulka_vtipy\">&nbsp;".Date("j. ").CZDatum(Date("n")).Date(" Y H:i:s", $info[10])."&nbsp;</td>
          <td align=\"center\" class=\"prechod_tabulka_vtipy\">&nbsp;{$action}&nbsp;</td>
        </tr>";
      }
    } //end for

  }
    else
  {
    echo
    "<tr>
    <td colspan=\"4\" class=\"prechod_tabulka_vtipy\" align=\"center\">Žádné soubory</th>
    </tr>";
  }
  echo
  "<tr>
     <td colspan=\"2\" align=\"center\" class=\"prechod_tabulka_012\">&nbsp;Celková velikost složky Upload:&nbsp;</td>
     <td align=\"center\" class=\"prechod_tabulka_012\" colspan=\"3\">&nbsp;<u>{$celsum}</u>&nbsp;</td>
  </tr>
  </table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";

} //end empty action
  else
{
  echo
  "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              soubor: <input type=\"file\" name=\"soubor\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Uploadovat soubor\" />
            </fieldset>
          </form>
  ";

  if (!Empty($_POST["tlacitko"]) &&
      !Empty($_FILES["soubor"]["tmp_name"]))

  {
    $cil = "../Upload/{$_FILES["soubor"]["name"]}";
    if (move_uploaded_file($_FILES["soubor"]["tmp_name"], $cil))
    {
      echo "<br />uploadovani probehlo uspesne<br />";
    }
      else
    {
      echo "<br />vyskytla se chyba!!<br />";
    }
  }
}


}
  else
{
  echo HlaskaVypadni(".");
}

//CZDatum()
//$info = filectime ("$pol/{$cesta[$i]}"); //Date($info)
/*
    <select onmousewheel=\"return false\" name=\"sel\">
      <option value=\"0\"></option>
      <option value=\"1\"></option>
      <option value=\"2\"></option>
    </select>
*/
 //print_r($_POST);
    //print RozlisPriponu($co, 3);
    /*
      <option value=\"1\">Přesunout fotku do fotografie</option>
      <option value=\"3\">Přesunout fotku do outdoor</option>
      <option value=\"4\">Přesunout fotku do akce foto 1</option>
      <option value=\"5\">Přesunout fotku do akce foto 2</option>
      <option value=\"6\">Přesunout fotku do akce foto 3</option>
      <option value=\"7\">Přesunout fotku do akce foto 4</option>
    */
    /*
       print
       "<head>
       <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=vtipy\">
       </head>
       .... Pokračuj <a href=\"index.php?kam=vtipy\">zde</a>";*/
?>
