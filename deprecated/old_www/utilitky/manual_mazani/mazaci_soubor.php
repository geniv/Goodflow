<?
/* smaze soubor
 *
 * name: SmazSoubor
 * @param
 * @return
 */
  function SmazSoubor()
  {
    if (!Empty($_POST["smazsoubor"]))
    {
      $a = explode("/", $_SERVER["SCRIPT_NAME"]);
      $scriptname = $a[count($a) - 1];

      $nazev = $_POST["nazev_souboru"];
      if (!Empty($nazev))
      {
        if (file_exists($nazev) && is_file($nazev) && $scriptname != $nazev)
        {
          chmod($nazev, 0777);
          if (unlink($nazev))
          {
            $result = "Byl smazán soubor: {$nazev}";
          }
            else
          {
            $result = "NeByl smazán soubor: {$nazev}";
          }
        }
          else
        {
          $result = "Daná cesta: '{$nazev}' neexistuje";
        }
      }
        else
      {
        $result = "Je třeba zadat název";
      }
    }

    return $result;
  }

/* smaze slozku
 *
 * name: SmazSlozku
 * @param
 * @return
 */
  function SmazSlozku()
  {
    if (!Empty($_POST["smazslozku"]))
    {
      $nazev = $_POST["nazev_slozky"];
      if (!Empty($nazev))
      {
        if (file_exists($nazev) && is_dir($nazev) && $nazev != "./" && $nazev != "../" && $nazev != "." && $nazev != "..")
        {
          chmod($nazev, 0777);
          if (rmdir($nazev))
          {
            $result = "Byla smazána složka: {$nazev}";
          }
            else
          {
            $result = "NeByla smazána složka: {$nazev}";
          }
        }
          else
        {
          $result = "Daná cesta: '{$nazev}' neexistuje";
        }
      }
        else
      {
        $result = "Je třeba zadat název";
      }
    }

    return $result;
  }

/* smaze obsah slozky se soubory
 *
 * name: SmazObsahSlozky
 * @param
 * @return
 */
  function SmazObsahSlozky()
  {
    if (!Empty($_POST["smazobsah"]))
    {
      RekDelFileDir("./");
    }

    return $result;
  }

/* rekurzvni mazani
 *
 * name: RekDelFileDir
 * @param
 * @return
 */
  function RekDelFileDir($jmeno) //rekurentni mazani slozek a podslozek
  {
    $a = explode("/", $_SERVER["SCRIPT_NAME"]);
    $scriptname = $a[count($a) - 1];
    $handle = opendir($jmeno);

    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && $soub != $scriptname)
      {
        if (!(filetype("{$jmeno}/{$soub}") == "file" ? @unlink("{$jmeno}/{$soub}") : @rmdir("{$jmeno}/{$soub}")))
        {
          RekDelFileDir("{$jmeno}/{$soub}");  //rekurzivn volani
        }
      }
    }

    closedir($handle);
  }

/* spocitani souboru a slozek
 *
 * name: PocetFileDir
 * @param
 * @return
 */
  function PocetFileDir()
  {
    $result = PocFileDir("./") - 1;

    return $result;
  }

/* rekurzivni pocitani souboru a slozek
 *
 * name: PocFileDir
 * @param
 * @return
 */
  function PocFileDir($jmeno) //rekurentni mazani slozek a podslozek
  {
    $poc = 0;
    $handle = opendir($jmeno);

    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        if (filetype("{$jmeno}/{$soub}") == "dir")
        {
          $poc += PocFileDir("{$jmeno}/{$soub}");
          $poc++;
        }
          else
        {
          $poc++;
        }
      }
    }

    closedir($handle);

    return $poc;  //odecteni sama sebe
  }

  $soubor = SmazSoubor();
  $slozka = SmazSlozku();
  $obsah = SmazObsahSlozky();
  $pocet = PocetFileDir();

  echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
    <head>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
      <meta http-equiv=\"Content-Language\" content=\"cs\" />
      <title></title>
    </head>
    <body>
      <form method=\"post\" onsubmit=\"return confirm('Opravdu provést danou operaci?');\">
        <fieldset>
          <dl>
            <dt>
              <label for=\"nazev_souboru\">Název souboru:</label>
            </dt>
            <dd>
              <input type=\"text\" name=\"nazev_souboru\" id=\"nazev_souboru\" />
              <input type=\"submit\" name=\"smazsoubor\" />
            </dd>
            <dt>
              <label for=\"nazev_slozky\">Název složky:</label>
            </dt>
            <dd>
              <input type=\"text\" name=\"nazev_slozky\" id=\"nazev_slozky\" />
              <input type=\"submit\" name=\"smazslozku\" />
            </dd>
          </dl>
          <input type=\"submit\" name=\"smazobsah\" value=\"Smazat všechny složky a soubory na urovni tohoto skryptu\" />
        </fieldset>
      </form>
      {$soubor}
      {$slozka}
      {$obsah}
      zbývá navíc: {$pocet}
    </body>
  </html>
  ";
?>
