<?php

/**
 *
 * Blok staticky generovaneho menu
 *
 */

class StaticMenu extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni;
  public $mount = array(".unikatni_obsah.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(NODATA);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul

  private $mainbuff = ""; //buffer promennych

  private $menu = array();

/**
 *
 * Konstruktor menu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    if (!Empty($var))
    {
      $this->var = $var;

      $this->dirpath = dirname($this->var->moduly[$index]["include"]);

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      $this->NastavKomunikaci($this->var, $index);  //pripojeni defaultu
    }
  }

/**
 *
 * Vrati title dle aktualni stranky
 *
 * poradi: 4. + libovolne
 *
 * pouziti: <strong>$title = $this->var->main[0]->NactiFunkci("StaticMenu", "Title", $struktura);</strong>
 *
 * @return title dokumentu
 */
  public function Title($struktura)
  {
    if (is_array($struktura))
    {
      //zjisteni aktualnich indexu
      $aktualni_pole = $this->AktualniPole($struktura);
      //slozeni cesty
      $cesta_souboru = $this->GenerovaniAdresyPodlePole($struktura, $aktualni_pole);
      //overeni existence souboru
      $existence_souboru = file_exists("{$this->var->souborymenu}/{$cesta_souboru}.php");

      $result = ($existence_souboru ? $this->GenerovaniTitlePodlePole($struktura, $aktualni_pole) : "");
    }
      else
    {
      $this->ErrorMsg("Proměnná 'struktura' není pole!", array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati obsah stranek dle aktualniho obsahu
 *
 * poradi: 3. + libovolne
 *
 * pouziti: <strong>$obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek", $struktura);</strong>
 *
 * @return obsah pres return $neco
 */
  public function ObsahStranek($struktura)
  {
    $result = "";
    //osetreni adminu
    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      return $result;
    }

    if (is_array($struktura))
    {
      //zjisteni aktualnich indexu
      $aktualni_pole = $this->AktualniPole($struktura);
      //poskladani cesty podle indexu
      $cesta_souboru = $this->GenerovaniAdresyPodlePole($struktura, $aktualni_pole);
  //var_dump($cesta_souboru);
      //pokud je zvolena cesta
      if (!Empty($cesta_souboru))
      {
        if (file_exists("{$this->var->souborymenu}/{$cesta_souboru}.php"))
        {
          $result = include "{$this->var->souborymenu}/{$cesta_souboru}.php";
        }
          else
        {
          $result = $this->KontrolaExistenceStranky($cesta_souboru);
        }
      }
    }
      else
    {
      $this->ErrorMsg("Proměnná 'struktura' není pole!", array(__LINE__, __METHOD__));
    }
//var_dump($result);
    return $result;
  }

/**
 *
 * Vraci danou hodnotu z oddilu v admin menu
 *
 * pouziti: <strong>$polozka = $this->var->main[0]->NactiFunkci("StaticMenu", "NavratPolozkyMenu", $struktura, "class");</strong>
 *
 * @param oddil 2 index dvou rozmerneho pole
 * @return dana hodnota oddilu
 */
  public function NavratPolozkyMenu($struktura, $oddil)
  {
    $result = "";
    $index = 0;

    if (is_array($struktura))
    {
      //zjisteni aktualnich indexu
      $aktualni_pole = $this->AktualniPole($struktura);
      //poskladani cesty podle indexu
      $cesta_souboru = $this->GenerovaniAdresyPodlePole($struktura, $aktualni_pole);

      if (file_exists("{$this->var->souborymenu}/{$cesta_souboru}.php"))
      {
        //var_dump($aktualni_pole); casem mozna rozsirit na prepinani mezi indexy
        $index = array_slice($aktualni_pole, -1); //extrehuje z pole posledni clanek
        $result = $struktura[$oddil][$index[0]];  //jediny! 0 index pouzije jako adresaci
      }
    }
      else
    {
      $this->ErrorMsg("Proměnná 'struktura' není pole!", array(__LINE__, __METHOD__));
    }
//var_dump($index);
    return $result;
  }

/**
 *
 * Kontrluje zda existuje stranka a zpet adresu
 *
 * @param adresa kontrolovana adresa stranky (bez a prnotni cesty *.php)
 * @return adresa nebo prazdny text
 */
  private function KontrolaExistenceStranky($adresa)
  {
    $result = "";
    if (file_exists("{$this->var->souborymenu}/{$adresa}.php"))
    {
      $result = $adresa;
    }
      else
    {
      $this->ErrorMsg("Stánka: '{$adresa}.php' neexistuje", array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Kontroluje jestli zadany nazev existuje ve strukture
 *
 * @param struktura struktura menu
 * @param nazev hledany nazev v main_href
 * @return bool, true = existuje, false = neexistuje
 */
  private function KontrolaExistencePolozky($struktura, $nazev)
  {
    $result = false;
    $c_struktura = count($struktura["zanoreni"]);
    for ($i = 0; $i < $c_struktura; $i++)
    {
      if ($struktura["main_href"][$i] == $nazev)
      {
        $result = true;
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vygeneruje cestu souboru dle zadaneho pole id
 *
 * @param struktura struktura menu
 * @param pole pole id pro slozeni adresy
 * @return slozena cesta soboru
 */
  private function GenerovaniAdresyPodlePole($struktura, $pole)
  {
    $result = "";
    if (is_array($struktura) && is_array($pole))
    {
      //oddelovac bere defaultni z nuloveho configu
      $oddeleni = $struktura["menu_config"][0]["tvar_oddeleni_sub_souboru"];

      $href = array();
      foreach ($pole as $polozka)
      {
        $href[] = $struktura["main_href"][$polozka];
      }
      //spoji jen unikatni polozky
      $result = implode($oddeleni, array_unique($href));
    }
      else
    {
      $this->ErrorMsg("Proměnná 'struktura' nebo 'pole' není pole!", array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vygeneruje title dle zadaneho pole id
 *
 * @param struktura struktura menu
 * @param pole pole id pro slozeni title
 * @return slozeny title
 */
  private function GenerovaniTitlePodlePole($struktura, $pole)
  {
    $result = "";
    //oddelovac bere defaultni z nuloveho configu
    $oddeleni = $struktura["menu_config"][0]["tvar_oddeleni_sub_title"];
    $c_pole = count($pole);
    for ($i = 0; $i < $c_pole; $i++)
    {
      $href[] = $struktura["title"][$pole[$i]]; //nacteni nazvu dle id v poli
    }

    $result = implode($oddeleni, $href);

    return $result;
  }

/**
 *
 * Vraci aktualni oznacene pole
 *
 * @param struktura nactena sktrukturta menu
 * @return nazev
 */
  private function AktualniPole($struktura)
  {
    if (is_array($struktura))
    {
      $adrkam = "";
      $result = "";
      //spocitani polozek na zanorenich
      $pocty = array_count_values($struktura["zanoreni"]);
      $c_struktura = count($struktura["zanoreni"]);
      for ($i = 0; $i < $c_struktura; $i++)
      { //tady je jeste potencionalni problem! dodelat!!
        $adrkam = $_GET[$struktura["tvar_get_kam"][$i]];

        if (!Empty($adrkam))
        {
          if ($adrkam == $struktura["main_href"][$i])
          {
            $result[] = $i;

            //kontrola jestli N-ta polozka o uroven niz je opravdu defaultni
            //zacina od nasledujiciho a konci o jeden posunuty
            for ($j = 1; $j < $pocty[$struktura["zanoreni"][$i + 1]] + 1; $j++)
            {
  //var_dump($i + $j);
              if ($struktura["defaultni"][$i + $j] && //je nadledujici o J posunute defaultni?
                  !isset($_GET[$struktura["tvar_get_kam"][$i + $j]]))  //je nasledne o J posunute v get prazdne?
              {
                $result[] = $i + $j;
              }
            }
          }
            else
          {
            if ($struktura["defaultni"][$i] &&  //pri defaultu
                !in_array($adrkam, $struktura["menu_config"][$i]["zruseni_aktivity"]) && //ruseni aktivity
                !$this->KontrolaExistencePolozky($struktura, $adrkam) &&  //pri neexistenci
                $struktura["zanoreni"][$i] == 0)  //na nulovem zanoreni
            {
              $result[] = $i;
            }
          }
        }
          else
        {
          if ($struktura["defaultni"][$i] && //defaultni polozka
              is_null($adrkam) && //pri prazdne adrese (pocatecni)
              $struktura["zanoreni"][$i] == 0) //na nulovem zanoreni
          {
            $result[] = $i;
          }
        }
  //echo "poc: {$i}| zan: {$struktura["zanoreni"][$i]}| def: {$struktura["defaultni"][$i]}|<br />\n";
      }
    }
      else
    {
      $this->ErrorMsg("Proměnná 'struktura' není pole!", array(__LINE__, __METHOD__));
    }
//print_r($result);
    return $result;
  }

/**
 *
 * Generovani samotneho statickeho menu
 *
 * poradi: 2. + libovolne
 *
 * pouziti: <strong>$menu = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu", $struktura);</strong>
 *
 * @param struktura pole struktury menu
 * @return vygenerovane menu
 */
  public function Menu($struktura)
  {
    $result = "";
    if (is_array($struktura))
    {
      //spocitani polozek na zanorenich
      $pocty = array_count_values($struktura["zanoreni"]);

      $zanpoc = NULL;
      $podminka = false;

      //zjisteni aktualnich indexu
      $aktualni_pole = $this->AktualniPole($struktura);
      //poskladani cesty podle indexu
      $cesta_souboru = $this->GenerovaniAdresyPodlePole($struktura, $aktualni_pole);
      //overeni existence souboru
      $existence_souboru = (file_exists("{$this->var->souborymenu}/{$cesta_souboru}.php"));
      //var_dump("{$this->var->souborymenu}/{$cesta_souboru}.php");
  //var_dump($cesta_souboru, $existence_souboru);
  //print_r($aktualni_pole);
  //print_r($struktura);
      $c_struktura = count($struktura["zanoreni"]);
      for ($i = 0; $i < $c_struktura; $i++)
      {
        if (is_null($zanpoc[$struktura["zanoreni"][$i]]))
        {
          $zanpoc[$struktura["zanoreni"][$i]] = 0;
        }

        //kontrola pole, true->vyskyt id v aktualnim + overeni existence souboru, jinak false
        $podminka = (is_array($aktualni_pole) && $existence_souboru ? in_array($i, $aktualni_pole) : false);
//var_dump($i, $aktualni_pole, $podminka, in_array($i, $aktualni_pole), "\n\n");
        //prepisovani tvar_main_href
        $main_href = $this->NactiUnikatniObsah($struktura["tvar_main_href"][$i],
                                              $this->absolutni_url,
                                              $struktura["prev_href"][$i],
                                              $struktura["main_href"][$i]);

        $result .= $this->NactiUnikatniObsah($struktura["tvar_vypis_menu"][$i],
                                            $main_href,
                                            $struktura["odkaz"][$i],
                                            $struktura["id"][$i],
                                            ($podminka ? $this->NactiUnikatniObsah($struktura["menu_config"][$i]["tvar_aktivity_id"], $struktura["id"][$i], $struktura["class"][$i]) : ""), //4
                                            $struktura["class"][$i],
                                            ($podminka ? $this->NactiUnikatniObsah($struktura["menu_config"][$i]["tvar_aktivity_class"], $struktura["id"][$i], $struktura["class"][$i]) : ""),  //6
                                            $struktura["akce"][$i], //7
                                            $i, //hlavni pocitadlo - 8
                                            $zanpoc[$struktura["zanoreni"][$i]],  //pocitadlo v zanoreni - 9
                                            ($i == 0 ? $struktura["menu_config"][$i]["tvar_aktivity_global_prvni"] : ""),  //v ramci globalniho pocitadla
                                            ($zanpoc[$struktura["zanoreni"][$i]] == 0 ? $struktura["menu_config"][$i]["tvar_aktivity_prvni"] : ""),  //v ramci zanoreni
                                            ($i == ($c_struktura - 1) ? $struktura["menu_config"][$i]["tvar_aktivity_global_posledni"] : ""), //v ramci globalniho pocitadla
                                            ($zanpoc[$struktura["zanoreni"][$i]] == ($pocty[$struktura["zanoreni"][$i]] - 1) ? $struktura["menu_config"][$i]["tvar_aktivity_posledni"] : ""), //v ramci zanoreni
                                            ((($i + $struktura["menu_config"][$i]["tvar_ente_global_od"]) % $struktura["menu_config"][$i]["tvar_ente_global_po"]) == 0 ? $struktura["menu_config"][$i]["tvar_aktivity_ente_global_odpo"] : ""),  //v ramci globalniho pocitadla
                                            ((($zanpoc[$struktura["zanoreni"][$i]] + $struktura["menu_config"][$i]["tvar_ente_od"]) % $struktura["menu_config"][$i]["tvar_ente_po"]) == 0 ? $struktura["menu_config"][$i]["tvar_aktivity_ente_odpo"] : ""),  //v ramci zanoreni
                                            (in_array($i, $struktura["menu_config"][$i]["tvar_ente_global_array"]) ? $struktura["menu_config"][$i]["tvar_aktivity_ente_global_array"] : ""), //v ramci globalniho pocitadla
                                            (in_array($zanpoc[$struktura["zanoreni"][$i]], $struktura["menu_config"][$i]["tvar_ente_array"]) ? $struktura["menu_config"][$i]["tvar_aktivity_ente_array"] : ""), //v ramci zanoreni
                                            ($podminka ? $this->NactiUnikatniObsah($struktura["menu_config"][$i]["tvar_aktivity_volitelny_text"], $struktura["id"][$i], $struktura["class"][$i]) : ""), //18
                                            ($podminka ? $struktura["menu_config"][$i]["tvar_aktivity_odkazu_LP"][0] : ""),
                                            ($podminka ? $struktura["menu_config"][$i]["tvar_aktivity_odkazu_LP"][1] : "")
                                            );

        //pocitadlo daneho zanoreni
        $zanpoc[$struktura["zanoreni"][$i]]++;
      }
    }
      else
    {
      $this->ErrorMsg("Proměnná 'struktura' není pole!", array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vyvtori preheld vstupniho pole "poc => zanoreni:sumpoc"
 *
 * @param menu vstupni menu
 * @pamam zan pocitadlo zanoreni
 * @return analyzovane menu
 */
  private function AnalyzaPoleMenu($menu, $zan = 0)
  {
    static $result;

    $c_menu = count($menu);
    for ($i = 0; $i < $c_menu; $i++)
    {
      $result[] = "{$zan}:{$i}";  //sklada vystupni tvar

      if (!is_null($menu[$i]["subsekcemenu"]))
      {
        $zan++; //pricitani zanoreni
        $this->AnalyzaPoleMenu($menu[$i]["subsekcemenu"], $zan);
        $zan--; //zpetne odcitani zanoreni
      }
    }

    return $result;
  }

/**
 *
 * Postara se o nacteni slozite struktury pole menu do jednoducheho pole
 *
 * poradi: 1.
 *
 * pouziti: <strong>$struktura = $this->var->main[0]->NactiFunkci("StaticMenu", "NactiStrukturuMenu"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return jednoduche pole menu
 */
  public function NactiStrukturuMenu($tvar = 1)
  {
    $result = "";
    if (array_key_exists("normal_menu_{$tvar}", $this->unikatni))
    {
      $this->menu = $this->unikatni["normal_menu_{$tvar}"];

      $this->mainbuff["array_tvar_main_href"] = $this->unikatni["array_tvar_main_href"];  //tvar odkazu
      $this->mainbuff["array_tvar_vypis_menu"] = $this->unikatni["array_tvar_vypis_menu"];  //tvar vypisu
      $this->mainbuff["array_tvar_get_kam"] = $this->unikatni["array_tvar_get_kam"];  //promenna v get
      $this->mainbuff["array_tvar_spojeni_sub"] = $this->unikatni["array_tvar_spojeni_sub"];  //tvar spojeni menu/submenu

      $this->mainbuff["array_menu_config"] = $this->unikatni["array_menu_config"];  //konfigurace menu

      $result = $this->RekurzivniNacitaniStruktury($this->menu, true);
    }
      else
    {
      $this->ErrorMsg("Proměnná 'normal_menu_{$tvar}' nebyla nalezena!", array(__LINE__, __METHOD__), "crit");
    }

    return $result;
  }

/**
 *
 * Rekurzivne volana funkce na naciteni a prochazeni pole
 *
 * @param menu menu urciteho zanoreni
 * @param zanoreni cislo zanoreni
 * @return jednoduche pole menu
 */
  private function RekurzivniNacitaniStruktury($menu, $nove, $zanoreni = 0, $prev_href = "")
  {
    static $result, $config;
    if ($nove)  //pri novem poli uplny reset
    {
      $result = "";
      $config = "";
    }

    $c_menu = count($menu);
    for ($i = 0; $i < $c_menu; $i++)
    {
      //rozlozeni nekolika urovnoveho pole do jedno-rozmerneho
      $result["zanoreni"][] = $zanoreni;
      $result["main_href"][] = $menu[$i]["main_href"];
      $result["odkaz"][] = $menu[$i]["odkaz"];
      $result["title"][] = $menu[$i]["title"];
      $result["id"][] = $menu[$i]["id"];
      $result["class"][] = $menu[$i]["class"];
      $result["akce"][] = $menu[$i]["akce"];

      $result["defaultni"][] = $menu[$i]["defaultni"];
      $result["obsah_pri_sub"][] = $menu[$i]["obsah_pri_sub"];

      $result["prev_href"][] = $prev_href;

      $result["tvar_main_href"][] = $this->mainbuff["array_tvar_main_href"][$menu[$i]["tvar_main_href"]];
      $result["tvar_vypis_menu"][] = $this->mainbuff["array_tvar_vypis_menu"][$menu[$i]["tvar_vypis_menu"]];
      $result["tvar_get_kam"][] = $this->mainbuff["array_tvar_get_kam"][$menu[$i]["tvar_get_kam"]];
      $result["tvar_spojeni_sub"][] = $this->mainbuff["array_tvar_spojeni_sub"][$menu[$i]["tvar_spojeni_sub"]];

      $config_obsah = $this->mainbuff["array_menu_config"][$menu[$i]["menu_config"]];
      //kdyz je nalezena nova konfigurace pole nacteji, jinak necha stary
      $config = (array_key_exists("menu_config", $menu[$i]) ? $config_obsah : $config);
      //($i == 0 && !Empty($config_obsah) ? $config_obsah : $config);
      $result["menu_config"][] = $config;

      if (!is_null($menu[$i]["subsekcemenu"]))
      {
        //zpracovani zpetne adresy url
        $sub_href = $this->NactiUnikatniObsah($this->mainbuff["array_tvar_spojeni_sub"][$menu[$i]["tvar_spojeni_sub"]],
                                              $prev_href,
                                              $menu[$i]["main_href"]);

        $zanoreni++; //pricitani zanoreni
        $this->RekurzivniNacitaniStruktury($menu[$i]["subsekcemenu"], false, $zanoreni, $sub_href);
        $zanoreni--; //zpetne odcitani zanoreni
      }
    }

    return $result;
  }
}
?>
