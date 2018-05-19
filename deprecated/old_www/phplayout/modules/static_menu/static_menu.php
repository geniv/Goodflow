<?php

/**
 *
 * Blok staticky generovaneho menu
 *
 * public funkce:\n
 * construct: StaticMenu - hlavni konstruktor tridy\n
 * Menu() - hlavni vypis menu\n
 * ObsahStranek() - vraci obsah stranek\n
 * Title() - vraci text title\n
 * NavratPolozkyMenu() - vradi dany element z menu\n
 *
 */

class StaticMenu extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni;

  /**
   * Trida oznaceni, hodnoty ktere se nastavuji do promenne <b>$oznacovat</b>, pouze JEDNA z techto hodnot (1 ze 4)\n\n
   * oz_none: zadne\n
   * oz_class: oznaceni pres tridu\n
   * oz_odkaz: oznaceni pres link\n
   * oz_id: oznaceni pres id\n
   * oz_class_span: oznacen na span
   */
  private $oznacovat = "oz_odkaz";  //Volba oznaceni v menu, muze obsahovat jen JEDEN typ!!

  private $oznac_odkazu_L = "[";  //Znak pro oznaceni odkazu Levy
  private $oznac_odkazu_P = "]";  //Znak pro oznaceni odkazu Pravy
  private $oznac_class = "aktivni"; //Text pro oznaceni z class
  private $oznac_id = "_neco2"; //Text pro oznaceni z id
  private $oznac_id_span = "<span></span>"; //text pro oznaceni ze span

  private $go_default = true; //true/false - pokud stranka neexistuje vrati default
  private $vypis_chybu = false;  //true/false - zakaz chybovych hlasek pri neexistenci

  private $ente_definovane = "_aktivni"; //oznacovani pro pole
  private $ente_ozn_def = array(1, 3, 4); //pole definovachy cisel

  private $ente_ozn_od = 0;
  private $ente_ozn_po = 2;

  private $get_sekce = "sekce"; //nazev submenu pro odchyceni

  /**
   * Staticky nadefinovane menu\n\n
   * main_href: hlavni adresa, kdyz bude prazdne je to udkaz na "./" - jinak se pouziva pro htaccess zapis\n
   * href: jsou to vnorene odkazy stranek, prvni se uvadi bez &amp;\n
   * odkaz: text samotneho odkazu\n
   * title: text to head title\n
   * id: identicky identifikator elementu\n
   * class: trida elementu\n
   * akce: akce napriklad pro JavaScript\n
   */
  private $menu = array(array("main_href" => "...", //bez "?action="
                              "href" => "",         //prvni sub odkaz bez &AMP, neplati pro htaccess
                              "odkaz" => "....",
                              "title" => ".....",
                              "id" => "",
                              "class" => "",
                              "akce" => ""),
                        );

/**
 *
 * Konstruktor menu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;

    $this->dirpath = dirname($this->var->moduly[$index]["include"]);

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");
  }

/**
 *
 * Vrati title dle aktualni stranky
 *
 * pouziti: <strong>$title = $this->var->main[0]->NactiFunkci("StaticMenu", "Title");</strong>
 *
 * @return title dokumentu
 */
  public function Title()
  {
    $adrkam = $_GET[$this->var->get_kam]; //vezme odkaz z url

    if (!Empty($adrkam))
    {
      if (file_exists("{$this->var->souborymenu}/{$adrkam}.php"))
      {
        $kam = $adrkam;
      }
        else
      {
        $kam = $this->var->default;
      }
    }
      else
    {
      $kam = $this->var->default;
    }

    $cis = -1;
    for ($i = 0; $i < count($this->menu); $i++) //projde pole odkazu
    {
      if ($this->menu[$i]["main_href"] == $kam || ($kam == $this->var->default && Empty($this->menu[$i]["main_href"])))
      {
        $cis = $i;
        break;
      }
    }

    $result = "";
    if ($cis != -1) //pokud je nalezeny index
    {
      if ($this->NaleziStrankaMenu() || $kam == $this->var->default)
      {
        $result = $this->menu[$cis]["title"];
      }
    }

    return $result;
  }

/**
 *
 * Vrati obsah stranek dle aktualniho obsahu
 *
 * pouziti: <strong>$obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek");</strong>
 *
 * @return obsah pres return $neco
 */
  public function ObsahStranek()
  {
    $kam = $_GET[$this->var->get_kam];

    $result = "";
    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      return $result;
    }

    if (!Empty($kam))
    {
      if (file_exists("{$this->var->souborymenu}/{$kam}.php"))
      {
        if ($this->NaleziStrankaMenu())
        {
          $result = include "{$this->var->souborymenu}/{$kam}.php";
        }
      }
        else
      {
        if ($this->go_default)  //vraceni defaultu
        {
          $result = $this->KontrolaDefaultu();
        }

        if ($this->vypis_chybu)
        {
          $this->var->main[0]->ErrorMsg("Sekce: '{$kam}' neexstuje", "přejděte na jinou sekci pls...");
        }
      }
    }
      else
    {
      if ($this->go_default)  //vraceni defaultu
      {
        $result = $this->KontrolaDefaultu();
      }
    }

    return $result;
  }

/**
 *
 * Vraci danou hodnotu z oddilu v admin menu
 *
 * pouziti: <strong>$polozka = $this->var->main[0]->NactiFunkci("StaticMenu", "NavratPolozkyMenu", "class");</strong>
 *
 * @param oddil 2 index dvou rozmerneho pole
 * @return dana hodnota oddilu
 */
  public function NavratPolozkyMenu($oddil)
  {
    $adrkam = $_GET[$this->var->get_kam]; //vezme odkaz z url

    if (!Empty($adrkam))
    {
      if (file_exists("{$this->var->souborymenu}/{$adrkam}.php"))
      {
        $kam = $adrkam;
      }
        else
      {
        $kam = $this->var->default;
      }
    }
      else
    {
      $kam = $this->var->default;
    }

    $cis = -1;
    for ($i = 0; $i < count($this->menu); $i++) //projde pole odkazu
    {
      if ($this->menu[$i]["main_href"] == $kam || ($kam == $this->var->default && Empty($this->menu[$i]["main_href"])))
      {
        $cis = $i;
        break;
      }
    }

    $result = "";
    if ($cis != -1) //pokud je nalezeny index
    {
      if ($this->NaleziStrankaMenu() || $kam == $this->var->default)
      {
        $result = $this->menu[$cis][$oddil];
      }
    }

    return $result;
  }

/**
 *
 * Kotroluje zda dana stranka
 *
 * @return true/false - existuje / neexistuje
 */
  private function NaleziStrankaMenu()
  {
    $kam = $_GET[$this->var->get_kam];

    $result = false;
    for ($i = 0; $i < count($this->menu); $i++)
    {
      if ($this->menu[$i]["main_href"] == $kam)
      {
        $result = true;
        break;
      }
    }

    return $result;
  }

/**
 *
 * Kontrluje zda existuje a vraci obsah defaultni stranky
 *
 * @return defultni stranku nebo chybu
 */
  private function KontrolaDefaultu()
  {
    if (file_exists("{$this->var->souborymenu}/{$this->var->default}.php"))
    {
      $result = include "{$this->var->souborymenu}/{$this->var->default}.php";
    }
      else
    {
      if ($this->vypis_chybu)
      {
        $this->var->main[0]->ErrorMsg("Stánka: '{$this->var->default}.php' neexistuje");
      }
    }

    return $result;
  }

/**
 *
 * Generovani samotneho statickeho menu
 *
 * pouziti: <strong>$menu = $this->var->main[0]->NactiFunkci("StaticMenu", "Menu");</strong>
 *
 * @param tvar cislo tvaru
 * @return vygenerovane menu
 */
  public function Menu($tvar = 1)
  {
    $adrkam = $_GET[$this->var->get_kam];

    $this->menu = $this->NactiUnikatniObsah($this->unikatni["normal_menu_{$tvar}"]);

    //Volba oznaceni v menu, muze obsahovat jen JEDEN typ!!
    $this->oznacovat = $this->NactiUnikatniObsah($this->unikatni["set_oznacovat_{$tvar}"]);

    //Znak pro oznaceni odkazu Levy
    $this->oznac_odkazu_L = $this->NactiUnikatniObsah($this->unikatni["set_oznac_odkazu_L_{$tvar}"]);

    //Znak pro oznaceni odkazu Pravy
    $this->oznac_odkazu_P = $this->NactiUnikatniObsah($this->unikatni["set_oznac_odkazu_P_{$tvar}"]);

    //Text pro oznaceni z class
    $this->oznac_class = $this->NactiUnikatniObsah($this->unikatni["set_oznac_class_{$tvar}"]);

    //Text pro oznaceni z id
    $this->oznac_id = $this->NactiUnikatniObsah($this->unikatni["set_oznac_id_{$tvar}"]);

    //text pro oznaceni ze span
    $this->oznac_id_span = $this->NactiUnikatniObsah($this->unikatni["set_oznac_id_span_{$tvar}"]);

    //true/false - pokud stranka neexistuje vrati default
    $this->go_default = $this->NactiUnikatniObsah($this->unikatni["set_go_default_{$tvar}"]);

    //true/false - zakaz chybovych hlasek pri neexistenci
    $this->vypis_chybu = $this->NactiUnikatniObsah($this->unikatni["set_vypis_chybu_{$tvar}"]);

    //prepinani mezi linearnim a definovanym oznacovani
    //$this->ente_definovane = $this->NactiUnikatniObsah($this->unikatni["set_ente_definovane_{$tvar}"]);
    //$ente = ($this->ente_definovane ?

    //pole definovaneho oznacovani
    $this->ente_ozn_def = $this->NactiUnikatniObsah($this->unikatni["set_ente_ozn_def_{$tvar}"]);

    //cislo linearniho oznacovani od
    $this->ente_ozn_od = $this->NactiUnikatniObsah($this->unikatni["set_ente_ozn_od_{$tvar}"]);

    //cislo linearniho oznacovani krok
    $this->ente_ozn_po = $this->NactiUnikatniObsah($this->unikatni["set_ente_ozn_po_{$tvar}"]);

    //nazev submenu pro odchyceni
    $this->get_sekce = $this->NactiUnikatniObsah($this->unikatni["set_get_sekce_{$tvar}"]);

    $result = "";
    for ($i = 0; $i < count($this->menu); $i++)
    {
      if (!Empty($adrkam))
      {
        if (file_exists("{$this->var->souborymenu}/{$adrkam}.php"))
        {
          $kam = $adrkam;
        }
          else
        {
          $kam = $this->var->default;
        }
      }
        else
      {
        $kam = $this->var->default;
      }

      $podminka = (($kam == $this->menu[$i]["main_href"]) || ($kam == $this->var->default && $this->menu[$i]["main_href"] == ""));

      switch ($this->oznacovat) //vyber dle oznaceni
      {
        case "oz_odkaz":
          $ozn_odkaz_l = ($podminka ? $this->oznac_odkazu_L : "");
          $ozn_odkaz_p = ($podminka ? $this->oznac_odkazu_P : "");
        break;

        case "oz_class":
          $ozn_class = ($podminka ? $this->oznac_class : "");
        break;

        case "oz_id":
          $ozn_id = ($podminka ? $this->oznac_id : "");
        break;

        case "oz_class_span":
          $ozn_id_span = ($podminka ? $this->oznac_id_span : "");
        break;
      }

      //evantualni podminky pro oznaceni zacatku, konce a kazdeno eN-teho
      $prvni = ($i == 0); //prvni
      $posledni = ($i == (count($this->menu) - 1)); //posledni

      $ente_def = in_array($i, $this->ente_ozn_def);  //pro definovane
      $ente = ((($i + $this->ente_ozn_od) % $this->ente_ozn_po) == 0);  //kazde 2 od 0 nebo def.

      $href = "";
      if ($this->var->htaccess)
      {
        if (!Empty($this->menu[$i]["href"]))  //kdyz je odkaz neprazdny
        {
          $a = explode("=", $this->menu[$i]["href"]);
          for ($j = 0; $j < count($a); $j++)
          {
            $href .= ((($j + 1) % 2) == 0 ? "/{$a[$j]}" : "");
          }
        }
      }
        else
      {
        if (!Empty($this->menu[$i]["href"]))  //kdyz je odkaz neprazdny
        {
          $href = "&amp;{$this->menu[$i]["href"]}";
        }
      }

      $mainhref = (substr($this->menu[$i]["main_href"], 0, 7) == "http://" ? $this->menu[$i]["main_href"] : (!Empty($this->menu[$i]["main_href"]) ? ($this->var->htaccess ? "{$this->absolutni_url}{$this->menu[$i]["main_href"]}" : "?{$this->var->get_kam}={$this->menu[$i]["main_href"]}") : $this->absolutni_url));
      $id = (!Empty($this->menu[$i]["id"]) || !Empty($ozn_id) ? " id=\"{$this->menu[$i]["id"]}{$ozn_id}\"" : "");
      $class = (!Empty($this->menu[$i]["class"]) || !Empty($ozn_class) ? " class=\"{$this->menu[$i]["class"]}{$ozn_class}\"" : "");
      $akce = (!Empty($this->menu[$i]["akce"]) ? " {$this->menu[$i]["akce"]}" : "");
      $span = (!Empty($ozn_id_span) ? $this->oznac_id_span : "");

      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_menu_{$tvar}"],
                                          "{$mainhref}{$href}",
                                          $this->menu[$i]["odkaz"],
                                          $id,
                                          $class,
                                          $akce,
                                          $span,
                                          $ozn_odkaz_l,
                                          $ozn_odkaz_p,
                                          $i,
                                          ($prvni ? $this->NactiUnikatniObsah($this->unikatni["normal_vypis_menu_prvni_{$tvar}"]) : ""),
                                          ($posledni ? $this->NactiUnikatniObsah($this->unikatni["normal_vypis_menu_posledni_{$tvar}"]) : ""),
                                          ($ente_def ? $this->NactiUnikatniObsah($this->unikatni["set_ente_definovane_{$tvar}"]) : ""),
                                          ($ente ? $this->NactiUnikatniObsah($this->unikatni["normal_vypis_menu_ente_{$tvar}"]) : ""));
    }

    return $result;
  }
}
?>
