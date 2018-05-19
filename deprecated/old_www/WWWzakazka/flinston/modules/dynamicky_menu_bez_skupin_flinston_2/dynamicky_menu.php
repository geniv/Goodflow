<?php

/**
 *
 * Blok dynamicky generovaneho menu bez skupin
 *
 * public funkce:\n
 * construct: DynamicMenuWithoutGroup - hlavni konstruktor tridy\n
 * DynamickyMenu() - hlavni vypis obsahu\n
 * Title() - vraci title vybrane sekce
 * DefaultniPolozka() - vrati podle dane adresy defaultni stranku, je-li nastavena\n
 * AdminMenu() - odkaz na admin obsahu\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicMenuWithoutGroup2
{
  private $var;
  private $sqlite;
  private $dbname;
  private $idmodul = "dynmenuoutgrup2";  //id pro rozliseni modulu v adminu
  private $dirpath;
  private $defprvni = false;  //brat defaultne prvni polozku
  private $vypis_chybu = false;
  private $povolit_pridani = false; //true/false - povolit / zakazat, pridavani (i mazani) dalsich polozek
  private $go_default = false;  //true/false - povoleni auto navratu na default

  private $get_sekce = "sekce"; //nazev submenu pro odchyceni

/**
  * Trida oznaceni, hodnoty ktere se nastavuji do promenne <b>$this->oznacovat</b>, pouze JEDNA z techto hodnot (1 ze 4)\n\n
  * oz_none: zadne\n
  * oz_class: oznaceni pres tridu\n
  * oz_odkaz: oznaceni pres link\n
  * oz_id: oznaceni pres id
  */
  private $oznacovat = "oz_class";  //Volba oznaceni v menu, muze obsahovat jen JEDEN typ!!

  private $oznac_odkazu_L = "[";  //Znak pro oznaceni odkazu Levy
  private $oznac_odkazu_P = "]";  //Znak pro oznaceni odkazu Pravy
  private $oznac_class = " aktivni"; //Text pro oznaceni z class
  private $oznac_id = "_neco";    //text pro oznaceni z ID

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;
    $this->dirpath = dirname($this->var->moduly[$index]["include"]);
    $this->dbname = $this->var->moduly[$index]["databaze"];

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $this->Instalace();
  }

/**
 *
 * Administracni menu
 *
 * @return admin menu
 */
  public function AdminMenu()
  {
    $result =
    "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\">administrace dynamickeho menu bez skupin</a><br />";

    return $result;
  }

/**
 *
 * Obsah adminu
 *
 * @return obsah adminu
 */
  public function AdminObsah()
  {
    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      switch ($_GET[$this->var->get_idmodul])
      {
        case $this->idmodul:  //id modul
          $result = $this->AdministraceObsahu();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Instalace SQLite databaze
 *
 */
  private function Instalace()
  {
    if (filesize("{$this->dirpath}/{$this->dbname}") == 0)
    {
      if (!@$this->sqlite->queryExec("CREATE TABLE dynamic_menu_without_group (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      main_href VARCHAR(200),
                                      href VARCHAR(200),
                                      odkaz VARCHAR(300),
                                      title VARCHAR(300),
                                      href_id VARCHAR(200),
                                      href_class VARCHAR(200),
                                      href_akce VARCHAR(500),
                                      poradi INTEGER UNSIGNED,
                                      defaultni BOOL,
                                      adresa TEXT);", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Zjisti prvni polozku v databazi
 *
 * @return adresu prvni polozky
 */
  private function PrvniPolozka()
  {
    if ($res = @$this->sqlite->query("SELECT main_href FROM dynamic_menu_without_group ORDER BY poradi ASC LIMIT 0,1;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->adresa;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vrati defaultni polozku podle adresy a nastaveneho defaultu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup", "DefaultniPolozka", $adresa_sekce);</strong>
 *
 * @return nazev defaultni polozky
 */
  public function DefaultniPolozka($kam)
  {
    $result = "";
    if (!Empty($kam))
    {
      if ($res = @$this->sqlite->query("SELECT main_href
                                        FROM dynamic_menu_without_group
                                        WHERE
                                        adresa='{$kam}' AND
                                        defaultni=1
                                        LIMIT 0,1;", NULL, $error))
      {
        if ($res->numRows() == 1)
        {
          $result = $res->fetchObject()->main_href;
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }

    return $result;
  }

/**
 *
 * Generovani samotneho obsahu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup", "DynamickyMenu"[, "nejaka_adresa"]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return vygenerovany obsah
 */
  public function DynamickyMenu($adr = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      if ($this->defprvni)  //defaultne prvni a nebo z url
      {
        $adresa = $this->PrvniPolozka();
      }
        else
      {
        $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
      }
    }

    $kam = $_GET[$this->var->get_kam]; //odchytava get_kam
    $defaultni = $this->DefaultniPolozka($adresa);
    settype($kam, "string");

    $result = "";
    if ($res = @$this->sqlite->query("SELECT main_href, href, odkaz, href_id, href_class, href_akce FROM dynamic_menu_without_group WHERE adresa='{$adresa}' ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          //pokud se shoduje main_href s adresaou a nebo prazdna subadresa a dafault se rovna main_href
          $podminka = ($kam == $data->main_href || (Empty($kam) && $defaultni == $data->main_href));

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
          }

          $href = "";
          if ($this->var->htaccess)
          {
            if (!Empty($data->href))  //kdyz je odkaz neprazdny
            {
              $a = explode("=", $data->href);
              for ($j = 0; $j < count($a); $j++)
              {
                $href .= ((($j + 1) % 2) == 0 ? "/{$a[$j]}" : "");
              }
            }
          }
            else
          {
            if (!Empty($data->href))  //kdyz je odkaz neprazdny
            {
              $href = "&amp;{$data->href}";
            }
          }

          //evantualni podminky pro oznaceni zacatku, konce a kazdeno eN-teho
          $prvni = ($i == 0); //prvni
          $posledni = ($i == ($res->numRows() - 1)); //posledni
          $ente = ((($i + 0) % 2) == 0);  //kazde 2 od 0

          $mainhref = (!Empty($data->main_href) ? ($this->var->htaccess ? (!Empty($_GET[$this->get_sekce]) ? "../" : "")."{$data->main_href}" : "?{$this->var->get_kam}={$data->main_href}") : "./");
          $id = (!Empty($data->href_id) ? " id=\"{$data->href_id}{$ozn_id}\"" : "");
          $class = (!Empty($data->href_class) || !Empty($ozn_class) ? " class=\"{$data->href_class}{$ozn_class}\"" : "");
          $akce = (!Empty($data->href_akce) ? " {$data->href_akce}" : "");

          $result .=
           "\n          <p{$class}>
            <a href=\"{$mainhref}{$href}\" title=\"{$data->odkaz}\"{$id}{$akce}>
              <span>
                {$ozn_odkaz_l}{$data->odkaz}{$ozn_odkaz_p}
              </span>
            </a>
          </p>";

          $i++;
        }
      }
        else
      {
        if ($this->vypis_chybu)
        {
          $result = "zadaná adresa neexistuje";
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vraci text title
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicMenuWithoutGroup", "DynamickyMenu", "Title", "adresa");</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return title text
 */
  public function Title($adr = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      if ($this->defprvni)  //defaultne prvni a nebo z url
      {
        $adresa = $this->PrvniPolozka();
      }
        else
      {
        $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
      }
    }

    $kam = $_GET[$this->var->get_kam]; //odchytava get_kam

    if (Empty($kam) && $this->var->htaccess)
    {
      $kam = "./";
    }

    if ($res = @$this->sqlite->query("SELECT
                                      title
                                      FROM dynamic_menu_without_group
                                      WHERE
                                      main_href='{$kam}' AND
                                      adresa='{$adresa}';
                                      ", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->title;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vrati obsah stranek dle aktualniho obsahu
 *
 * pouziti: <strong>$obsah = $this->var->main[0]->NactiFunkci("StaticMenu", "ObsahStranek");</strong>
 *
 * @param adr
 * @return obsah pres return $neco
 */
  public function ObsahStranek($adr = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      if ($this->defprvni)  //defaultne prvni a nebo z url
      {
        $adresa = $this->PrvniPolozka();
      }
        else
      {
        $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
      }
    }

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
        if ($this->NaleziStrankaMenu($adresa))
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
 * Kotroluje zda dana stranka
 *
 * @return true/false - existuje / neexistuje
 */
  private function NaleziStrankaMenu($adr = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      if ($this->defprvni)  //defaultne prvni a nebo z url
      {
        $adresa = $this->PrvniPolozka();
      }
        else
      {
        $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
      }
    }

    $kam = $_GET[$this->var->get_kam];

    $result = false;
    if ($res = @$this->sqlite->query("SELECT
                                      id
                                      FROM dynamic_menu_without_group
                                      WHERE
                                      main_href='{$kam}' AND
                                      adresa='{$adresa}';
                                      ", NULL, $error))
    {
      $result = ($res->numRows() == 1 ? true : false);
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
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
 * Vrati pocet radku menu
 *
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($inc = 0)
  {
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) as pocet FROM dynamic_menu_without_group;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->pocet + $inc;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickeho obsahu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result =
    "administrace dynamickeho obsahu<br />
    ".($this->povolit_pridani ? "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add\" title=\"\">přidej položku</a><br />" : "")."
    {$this->AdminVypisMenu()}<br />";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani poloze menu
          $result =
          "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"input\" name=\"adresa\" /><br />
              main_href: <input type=\"input\" name=\"main_href\" /><br />
              href: <input type=\"input\" name=\"href\" /><br />
              odkaz: <input type=\"input\" name=\"odkaz\" /><br />
              title: <input type=\"input\" name=\"title\" /><br />
              href_id: <input type=\"input\" name=\"href_id\" /><br />
              href_class: <input type=\"input\" name=\"href_class\" /><br />
              href_akce: <input type=\"input\" name=\"href_akce\" /><br />
              poradi: <input type=\"input\" name=\"poradi\" value=\"{$this->PocetRadku(1)}\" /><br />
              defaultni: <input type=\"checkbox\" name=\"defaultni\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ";

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $main_href = stripslashes(htmlspecialchars($_POST["main_href"], ENT_QUOTES));
          $href = stripslashes(htmlspecialchars($_POST["href"], ENT_QUOTES));
          $odkaz = stripslashes(htmlspecialchars($_POST["odkaz"], ENT_QUOTES));
          $title = stripslashes(htmlspecialchars($_POST["title"], ENT_QUOTES));
          $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
          $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
          $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));
          $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
          settype($poradi, "integer");
          $defaultni = (!Empty($_POST["defaultni"]) ? 1 : 0);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              //!Empty($main_href) &&
              !Empty($odkaz) &&
              $this->povolit_pridani)
          {
            if (@$this->sqlite->queryExec("INSERT INTO dynamic_menu_without_group (id, main_href, href, odkaz, title, href_id, href_class, href_akce, poradi, defaultni, adresa) VALUES
                                          (NULL, '{$main_href}', '{$href}', '{$odkaz}', '{$title}', '{$href_id}', '{$href_class}', '{$href_akce}', {$poradi}, {$defaultni}, '{$adresa}');", $error))
            {
              $result =
              "
                přídána: {$main_href}
              ";
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "edit":  //uprava menu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT main_href, href, odkaz, title, href_id, href_class, href_akce, poradi, defaultni, adresa FROM dynamic_menu_without_group WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"input\" name=\"adresa\" value=\"{$data->adresa}\" /><br />
                  main_href: <input type=\"input\" name=\"main_href\" value=\"{$data->main_href}\" /><br />
                  href: <input type=\"input\" name=\"href\" value=\"{$data->href}\" /><br />
                  odkaz: <input type=\"input\" name=\"odkaz\" value=\"{$data->odkaz}\" /><br />
                  title: <input type=\"input\" name=\"title\" value=\"{$data->title}\" /><br />
                  href_id: <input type=\"input\" name=\"href_id\" value=\"{$data->href_id}\" /><br />
                  href_class: <input type=\"input\" name=\"href_class\" value=\"{$data->href_class}\" /><br />
                  href_akce: <input type=\"input\" name=\"href_akce\" value=\"{$data->href_akce}\" /><br />
                  poradi: <input type=\"input\" name=\"poradi\" value=\"{$data->poradi}\" /><br />
                  defaultni: <input type=\"checkbox\" name=\"defaultni\"".($data->defaultni ? " checked=\"checked\"" : "")." /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $main_href = stripslashes(htmlspecialchars($_POST["main_href"], ENT_QUOTES));
              $href = stripslashes(htmlspecialchars($_POST["href"], ENT_QUOTES));
              $odkaz = stripslashes(htmlspecialchars($_POST["odkaz"], ENT_QUOTES));
              $title = stripslashes(htmlspecialchars($_POST["title"], ENT_QUOTES));
              $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
              $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
              $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));
              $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
              settype($poradi, "integer");
              $defaultni = (!Empty($_POST["defaultni"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  //!Empty($main_href) &&
                  !Empty($odkaz) &&
                  $id != 0)
              { //kdyz bude dafaultni na ON tak se ve skupine promazne a nastavi nove
                if (@$this->sqlite->queryExec ("UPDATE dynamic_menu_without_group SET main_href='{$main_href}',
                                                                                      href='{$href}',
                                                                                      odkaz='{$odkaz}',
                                                                                      title='{$title}',
                                                                                      href_id='{$href_id}',
                                                                                      href_class='{$href_class}',
                                                                                      href_akce='{$href_akce}',
                                                                                      poradi={$poradi},
                                                                                      defaultni={$defaultni},
                                                                                      adresa='{$adresa}'
                                                                                      WHERE id={$id};
                                                ".($defaultni ? "UPDATE dynamic_menu_without_group SET defaultni=0 WHERE adresa='{$adresa}';" : "")."
                                                UPDATE dynamic_menu_without_group SET defaultni='{$defaultni}' WHERE adresa='{$adresa}' AND id={$id};
                                                                        ", $error))
                {
                  $result =
                  "
                    upravena: {$main_href}
                  ";
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error);
                }

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;

        case "del": //mazani menu podle id
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = @$this->sqlite->query("SELECT main_href FROM dynamic_menu_without_group WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM dynamic_menu_without_group WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazána main_href: '{$data->main_href}'.
                ";
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error);
              }

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis administrace obsahu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisMenu()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, main_href, href, odkaz, title, href_id, href_class, href_akce, poradi, defaultni, adresa FROM dynamic_menu_without_group ORDER BY LOWER(adresa) ASC, poradi ASC, LOWER(odkaz) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "<br />
            <p>
              adresa: {$data->adresa}<br />
              {$data->main_href}<br />
              {$data->href}<br />
              {$data->odkaz}<br />
              {$data->title}<br />
              {$data->href_id}<br />
              {$data->href_class}<br />
              {$data->href_akce}<br />
              poradi: {$data->poradi}<br />
              def: <input type=\"checkbox\"".($data->defaultni ? " checked=\"checked\"" : "")." disabled /><br />
              <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}\" title=\"\">uprav sekci</a>
              ".($this->povolit_pridani ? "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat adresu: \'{$data->main_href}\' ?');\">smazat sekci</a>" : "")."
            </p><br />
          ";
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }
}
?>
