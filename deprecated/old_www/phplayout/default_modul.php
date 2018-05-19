<?php

/**
 *
 * Blok defaultniho dynamickeho modulu
 *
 * public funkce:\n
 * construct: DefaultModule - hlavni konstruktor tridy\n
 * AdminTitle() - navraceni hlavicky podle zvolene sekce\n
 * AdminMenu() - ozkazy do admin menu\n
 *
 */

class DefaultModule
{
  private $adresa_menu, $typdb, $ukazatel, $var, $trida, $cesta, $newcesta, $nazvydb, $unikatni, $pripojeno;
  private $kodroz = "0-0";

/**
 *
 * Nastaveni komunikace s databazi
 *
 * @param &var predan hlavnich promennych
 * @param uloziste nastavene uloziste danaho modulu
 * @param class trida daneho modulu
 * @param cesta cesta pro sqlite databazi
 * @return vrati nazev predpony dle typu databaze
 */
  public function NastavKomunikaci(&$var, $uloziste, $class, $cesta)
  {
    $this->var = $var;
    $this->typdb = $uloziste;
    $this->trida = strtolower($class);  //jako predpona do databaze pro tabulky, musi byt lower!
    $this->cesta = $cesta;
    $this->newcesta = "{$this->cesta}.mysqli";

    switch ($this->typdb)
    {
      default:
      case "sqlite":
        $result = "";
      break;

      case "mysqli":  //v pripade mysqli prida nazev tridy
        $result = "{$this->trida}_";
      break;
    }

    return $result;
  }

/**
 *
 * Vrati aktualni typ nastavene databaze
 *
 * @return typ databaze
 */
  public function ZjistiTypDB()
  {
    return $this->typdb;
  }

/**
 *
 * Pripoji databazi podle typu uloziste
 *
 * uzavira se ve funkci: VypisVsechnyChyby()
 *
 * @param &error text chyby
 * @return true/false - pripojilo/nepripojilo
 */
  public function PripojeniDatabaze(&$error)
  {
    $result = false;
    switch ($this->typdb) //mysql_dbname, mysql_host, mysql_user, mysql_pass, mysql_port
    {
      default:
      case "sqlite":
        if ($this->ukazatel = @new SQLiteDatabase($this->cesta, 0777, $error))
        {
          $result = true;
        }
          else
        {
          $result = false;
        }

        $this->pripojeno = $result;
      break;

      case "mysqli":
        $this->ukazatel = @new mysqli($this->var->mysql_host, $this->var->mysql_user, $this->var->mysql_pass, $this->var->mysql_dbname, $this->var->mysql_port);
        if (!mysqli_connect_errno())  //je-li 0 chyb
        {
          if (@$this->ukazatel->multi_query("SET CHARACTER SET UTF8")) //nastaveni kodovani
          {
            $result = true;
          }
            else
          {
            $error = $this->ukazatel->error;
            $result = false;
          }
        }
          else
        {
          $error = mysqli_connect_error();
          $result = false;
        }

        $this->pripojeno = $result;
      break;
    }

    return $result;
  }

/**
 *
 * Ukonci spojeni s databazi
 *
 * uzavira se ve funkci: VypisVsechnyChyby()
 *
 */
  public function ZavritDatabaze()
  {
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        //
      break;

      case "mysqli":
        $this->ukazatel->close();
      break;
    }
  }

/**
 *
 * Osetreni nebezpecnych znaku pro vstup do databaze
 *
 * @param text vstupni text
 * @param komplexne pri false vyhazuje: ENT_QUOTES
 * @return osetreny text
 */
  public function ChangeWrongChar($text, $komplexne = true)
  {
    $result = "";
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        $result = ($komplexne ? stripslashes(htmlspecialchars($text, ENT_QUOTES)) : stripslashes(htmlspecialchars($text)));
      break;

      case "mysqli":
        $result = ($komplexne ? $text : stripslashes(htmlspecialchars($text)));
      break;
    }

    return $result;
  }

/**
 *
 * Instaluje databazi
 *
 * @param prikaz create prikazy
 * @param &error text chybove hlasky
 * @return true/false - nanistalovano/nenanistalovano
 */
  public function InstalaceDatabaze($prikaz, &$error)
  {
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        if (!filesize($this->cesta))
        {
          $result = @$this->ukazatel->queryExec($prikaz, $error);
        }
          else
        {
          $result = true;
        }
      break;

      case "mysqli":
        if (!file_exists($this->newcesta))
        {
          $expl1 = explode("CREATE TABLE ", $prikaz);

          $tab = 0;
          $poc = count($expl1);
          $key = "";
          for ($i = 1; $i < $poc; $i++)
          {
            $expl2 = explode(" (", $expl1[$i]); //vysekani nazvu databaze
            $tab += ($this->ExistujeTabulka($expl2[0], $error) ? 1 : 0);
          }

          if ($tab != ($poc - 1))
          {
            $result = @$this->ukazatel->multi_query($prikaz);  //prevedeni nazvu db
            $error = $this->ukazatel->error;
          }
            else
          {
            $u = fopen($this->newcesta, "w");
            fwrite($u, date("Y-m-d H:i:s"));
            fclose($u);

            $result = true;
          }
        }
          else
        {
          $result = true;
        }
      break;
    }

    return $result;
  }

/**
 *
 * Zjisti jestli dana tabulka existuje
 *
 * @param tabulka nazev tabulky
 * @param &error text chybove hlasky
 * @return true/false - existuje/neexistuje
 */
  public function ExistujeTabulka($tabulka, &$error)
  {
    $result = false;
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        if ($res = @$this->ukazatel->query("SELECT name FROM sqlite_master WHERE type='table' AND name='{$tabulka}';", NULL, $error))
        {
          $result = ($res->numRows() == 1);
        }
      break;

      case "mysqli":
        if ($res = @$this->ukazatel->query("SHOW TABLES WHERE `Tables_in_{$this->var->mysql_dbname}`='{$tabulka}';"))
        {
          $result = ($res->num_rows == 1);
        }
          else
        {
          $error = $this->ukazatel->error;
        }
      break;
    }

    return $result;
  }

/**
 *
 * Provede exec prikaz v DB
 *
 * @param prikaz sql prikaz
 * @param &error text chybove hlasky
 * @return true/false - povedlo/nepovedlo
 */
  public function queryExec($prikaz, &$error)
  {
    $result = false;  //$this->pripojeno
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        $result = @$this->ukazatel->queryExec($prikaz, $error);
      break;

      case "mysqli":
        $result = @$this->ukazatel->multi_query($prikaz);
        $error = $this->ukazatel->error;
      break;
    }

    return $result;
  }

/**
 *
 * Provede vyberovy prikaz
 *
 * @param prikaz sql prikaz
 * @param &error text chybove hlasky
 * @return resource prikazu
 */
  public function query($prikaz, &$error)
  {
    $result = false;
    if ($this->pripojeno) //kontrola pripojene databaze
    {
      switch ($this->typdb)
      {
        default:
        case "sqlite":
          $result = @$this->ukazatel->query($prikaz, NULL, $error);
        break;

        case "mysqli":
          $result = @$this->ukazatel->query($prikaz); //$osetreni ? $this->OsetreniNazvuDB($prikaz) :
          $error = $this->ukazatel->error;
        break;
      }
    }

    return $result;
  }

/**
 *
 * Zjisti pocet radku
 *
 * @param resource resource sql dotazu
 * @return pocet radku
 */
  public function numRows($resource)
  {
    $result = 0;
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        $result = $resource->numRows();
      break;

      case "mysqli":
        $result = $resource->num_rows;
      break;
    }

    return $result;
  }

/**
 *
 * Provadi array vystup z databaze
 *
 * @param resource resource sql dotazu
 * @param out vystupni format indexu pole, NUM - cisla, ASSOC - asociativni, BOTH - oboji
 * @return pole pro nacteni hodnot
 */
  public function fetch($resource, $out = "NUM")
  {
    $result = "";
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        $typ = array ("ASSOC" => SQLITE_ASSOC,
                      "NUM" => SQLITE_NUM,
                      "BOTH" => SQLITE_BOTH); //ASSOC, NUM, BOT

        $result = $resource->fetch($typ[$out]); //SQLITE_ASSOC, SQLITE_NUM, SQLITE_BOTH
      break;

      case "mysqli":
        $typ = array ("ASSOC" => MYSQLI_ASSOC,
                      "NUM" => MYSQLI_NUM,
                      "BOTH" => MYSQLI_BOTH); //ASSOC, NUM, BOT

        $result = $resource->fetch_array($typ[$out]); //MYSQLI_ASSOC, MYSQLI_NUM, MYSQLI_BOTH
      break;
    }

    return $result;
  }

/**
 *
 * Provadi objektove vystup z databaze
 *
 * @param resource resource sql dotazu
 * @return objekty pro nacteni hodnoty
 */
  public function fetchObject($resource)
  {
    $result = "";
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        $result = $resource->fetchObject();
      break;

      case "mysqli":
        $result = $resource->fetch_object();
      break;
    }

    return $result;
  }

/**
 *
 * Zjisti vlastnosti sloupce
 *
 * @param resource resource sql dotazu
 * @return vlastnosti sloupce v objektu
 */
  public function fetchFields($resource)
  {
    $result = NULL;
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        //$result = $resource->;
      break;

      case "mysqli":
        $result = $resource->fetch_fields();
      break;
    }

    return $result;
  }

/**
 *
 * Zjisti posledni pridane ID
 *
 * @param resource resource sql dotazu
 * @return cislo ID
 */
  public function lastInsertRowid($resource)
  {
    $result = 0;
    switch ($this->typdb)
    {
      default:
      case "sqlite":
        $result = $resource->lastInsertRowid();
      break;

      case "mysqli":
        $result = $resource->insert_id;
      break;
    }

    return $result;
  }

/**
 *
 * Zakoduje text
 *
 * @param text vstupni text
 * @return zasifrovany text
 */
  public function ZakodujText($text)
  {
    $lett = str_split($text, 1);
    $result = "";

    for ($i = 0; $i < count($lett); $i++)
    {
      $result[] = decoct(decoct(ord($lett[$i]) + ($i * 10)) + (($i + 1) * 14)) + ($i * 11);
    }

    return implode($this->kodroz, $result);
  }

/**
 *
 * Dekoduj text
 *
 * @param text vstupni zakodovany text
 * @return rozsifrovany text
 */
  public function DekodujText($text)
  {
    $kod = explode($this->kodroz, $text);
    $result = "";

    for ($i = 0; $i < count($kod); $i++)
    {
      $result .= chr(octdec(octdec($kod[$i] - ($i * 11)) - (($i + 1) * 14)) - ($i * 10));
    }

    return $result;
  }

/**
 *
 * Nacte obsah daneho souboru
 *
 * pouziti: <strong>$obsah = $this->var->main[0]->NactiFunkci("Funkce", "NactiObsahSouboru"[, false]);</strong>
 *
 * @param soubor nazev souboru pro nacteni, slozku bere dle cesty (souboryinclude) v user_promenne
 * @param once rozliseni jestli se ma nacis jedenkrat a nebo normalne
 * @return obsah
 */
  public function NactiObsahSouboru($soubor, $once = true)
  {
    $result = "";
    if (file_exists($soubor))
    {
      $result = ($once ? include_once $soubor : include $soubor);
    }
      else
    {
      echo "chyba: soubor: <strong>{$soubor}</strong> neexistuje";
    }

    return $result;
  }

/**
 *
 * Nacitani unikatniho textu a z promenne kde se nazrazuji za skutecny obsah
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("Funkce", "NactiUnikatniObsah", $this->unikatni["sekce"][, "parametry", ...]);</strong>
 * pouziti: <strong>$text = $this->NactiUnikatniObsah($this->unikatni["sekce"][, "parametry", ...]);</strong>
 *
 * odedelovace: @@_@@
 *
 * pro zapsani libovolneho poctu argumentu v jednom argumentu: array("array_args", ...);
 *
 * @param sekce sekce vlozena z pole
 * @return obsah dane sekce
 */
  public function PrevodUnikatnihoTextu($sekce)
  {
    $parametr = func_get_args();
    $pocet = func_num_args();
    $result = $sekce; //vlozeni do promenne result

    switch (gettype($result))
    {
      case "integer":
        settype($result, "integer");
      break;

      case "array":
        if (is_array($result[0])) //detekce pole pro admin_menu
        {
          for ($i = 0; $i < count($result); $i++)
          {
            $klic = array_keys($result[$i]);
            for ($j = 0; $j < count($klic); $j++)
            {
              for ($k = 1; $k < $pocet; $k++)
              {
                $result[$i][$klic[$j]] = str_replace("@@{$k}@@", $parametr[$k], $result[$i][$klic[$j]]);
              }
            }
          }
        }
          else
        {
          $klic = array_keys($result);

          for ($i = 0; $i < count($klic); $i++) //projde klice
          {
            for ($j = 1; $j < $pocet; $j++) //v parametru projde parametr
            {
              $result[$klic[$i]] = str_replace("@@{$j}@@", $parametr[$j], $result[$klic[$i]]);
            }
          }
        }
      break;

      case "string":
        $end_index = count($parametr) - 1;  //algoritmus na slouceni pole s paramerem
        if ($parametr[$end_index][0] === "array_args")
        {
          $result = $parametr[0];
          $mezi = array_slice($parametr[$end_index], 1);  //odstrani: array_args
          $mezi0 = array_slice($parametr, 1, -1); //vezme text bez [0] a bez posledniho [$end_index]

          $mezera[] = ""; //vlozeni prazdne mezery
          $parametr = array_merge($mezera, $mezi0, $mezi);  //slouceni mezery, vezme pevne parametry a nakonec prida pridane parametry
          $pocet = count($parametr);  //vypocita novy pocet parametru
        }

        for ($i = 1; $i < $pocet; $i++)
        {
          $result = str_replace("@@{$i}@@", $parametr[$i], $result);
        }
      break;
    }

    return $result;
  }

/**
 *
 * Nacitani unikatnich obsahu stranek z promenne kde se nazrazuji za skutecny obsah
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("Funkce", "NactiUnikatniObsah", $this->unikatni["sekce"][, "parametry", ...]);</strong>
 * pouziti: <strong>$text = $this->NactiUnikatniObsah($this->unikatni["sekce"][, "parametry", ...]);</strong>
 *
 * odedelovace: %%_%%
 *
 * pro zapsani libovolneho poctu argumentu v jednom argumentu: array("array_args", ...);
 *
 * @param sekce sekce vlozena z pole
 * @return obsah dane sekce
 */
  public function NactiUnikatniObsah($sekce)
  {
    $parametr = func_get_args();
    $pocet = func_num_args();
    $result = $sekce; //vlozeni do promenne result

    switch (gettype($result))
    {
      case "integer":
        settype($result, "integer");
      break;

      case "array":
        if (is_array($result[0])) //detekce pole pro admin_menu
        {
          for ($i = 0; $i < count($result); $i++)
          {
            $klic = array_keys($result[$i]);
            for ($j = 0; $j < count($klic); $j++)
            {
              for ($k = 1; $k < $pocet; $k++)
              {
                $result[$i][$klic[$j]] = str_replace("%%{$k}%%", $parametr[$k], $result[$i][$klic[$j]]);
              }
            }
          }
        }
          else
        {
          $klic = array_keys($result);

          for ($i = 0; $i < count($klic); $i++) //projde klice
          {
            for ($j = 1; $j < $pocet; $j++) //v parametru projde parametr
            {
              $result[$klic[$i]] = str_replace("%%{$j}%%", $parametr[$j], $result[$klic[$i]]);
            }
          }
        }
      break;

      case "string":
        $end_index = count($parametr) - 1;  //algoritmus na slouceni pole s paramerem
        if ($parametr[$end_index][0] === "array_args")
        {
          $result = $parametr[0];
          $mezi = array_slice($parametr[$end_index], 1);  //odstrani: array_args
          $mezi0 = array_slice($parametr, 1, -1); //vezme text bez [0] a bez posledniho [$end_index]

          $mezera[] = ""; //vlozeni prazdne mezery
          $parametr = array_merge($mezera, $mezi0, $mezi);  //slouceni mezery, vezme pevne parametry a nakonec prida pridane parametry
          $pocet = count($parametr);  //vypocita novy pocet parametru
        }

        for ($i = 1; $i < $pocet; $i++)
        {
          $result = str_replace("%%{$i}%%", $parametr[$i], $result);
        }
      break;
    }

    return $result;
  }

/**
 *
 * Zavola danou funkci z daneho indexu tridy, dokaze zpracovat libovolne mnozstvi parametru,
 * toto je modifikace napojivaci funkce z funkce.php jen pro ucel tohoto modulu
 *
 * @param index index nebo nazev funkce pro $main
 * @param funkce volana public funkce
 * @return obsah funkce
 */
  private function NactiFunkci($index, $funkce)
  {
    include_once "promenne.php";
    include_once "funkce.php";
    $var = new Promenne();
    $main = new Funkce($var, 0);

    $paramatr = func_get_args();
    $pocet = func_num_args();
    $argv = array();
    if ($pocet > 2)
    {
      for ($i = 2, $j = 0; $i < $pocet; $i++, $j++)
      {
        $argv[$j] = $paramatr[$i];  //prevedeni parametru
      }
    }

    if (is_string($index))
    {
      $cis = -1;
      for ($i = 0; $i < count($var->moduly); $i++)
      {
        if ($var->moduly[$i]["class"] == $index)
        {
          $cis = $i;
          break;
        }
      }

      if ($cis == -1)
      {
        echo "POZOR! Nepodařilo se najít třídu s názvem: ''{$index}'' !!<br />\n";
      }
        else
      {
        $index = $cis;
      }
    }

    $result = "";
    if ($cis != -1)
    {
      if (method_exists($var->moduly[$index]["class"], $funkce))
      {
        $result = call_user_func_array(array($main, $funkce), $argv);  //trida::funkce, parametry
      }
        else
      {
        if (!Empty($var->moduly[$index]["class"]))
        {
          echo "POZOR! U třídy: ''{$var->moduly[$index]["class"]}'' se neporařilo načíst funkci: ''{$funkce}''!<br />\n";
        }
          else
        {
          echo "POZOR! Nepodařilo se najít třídu o indexu:  ''{$index}''<br />\n";
        }
      }
    }

    return $result;
  }

/**
 *
 * Nastavi adresu menu pro lokalni tridu prenesenou z volane tridy (ze syna pro otce)
 *
 * @param adresa dvourozmerne pole menu
 */
  public function NastavitAdresuMenu($adresa)
  {
    $this->adresa_menu = $adresa;
  }

/**
 *
 * Administracni title
 *
 * @return title adminu
 */
  public function AdminTitle()
  {
    $result = $this->NactiFunkci("Funkce", "CallAdminTitle", $this->adresa_menu);

    return $result;
  }

/**
 *
 * Administracni menu
 *
 * @return odkazy menu
 */
  public function AdminMenu()
  {
    $result = $this->NactiFunkci("Funkce", "CallAdminMenu", $this->adresa_menu);

    return $result;
  }
}
?>
