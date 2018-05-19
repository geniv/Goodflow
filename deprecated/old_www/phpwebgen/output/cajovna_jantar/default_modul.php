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
  private $adresa_menu;

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
 * Nacitani unikatnich obsahu stranek z promenne kde se nazrazuji za skutecny obsah
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("Funkce", "NactiUnikatniObsah", $this->unikatni["sekce"][, "parametry", ...]);</strong>
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
