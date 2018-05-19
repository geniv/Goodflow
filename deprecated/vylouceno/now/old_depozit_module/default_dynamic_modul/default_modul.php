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
