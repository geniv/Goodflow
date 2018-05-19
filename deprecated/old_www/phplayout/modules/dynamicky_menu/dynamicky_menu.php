<?php

/**
 *
 * Blok dynamicky generovaneho menu
 *
 * public funkce:\n
 * construct: DynamicMenu - hlavni konstruktor tridy\n
 * DynamickyMenu() - hlavni vypis obsahu\n
 * Title() - vraci title vybrane sekce
 * DefaultniPolozka() - vrati podle dane adresy defaultni stranku, je-li nastavena\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicMenu extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $absolutni_url, $unikatni;
  public $idmodul = "dynmenu";  //id pro rozliseni modulu v adminu

  private $defprvni = false;  //brat defaultne prvni polozku
  private $get_sekce = "sekce"; //adresa vnoreneho menu
  private $vypis_chybu = false;
  private $povolit_pridani = true; //true/false - povolit / zakazat, pridavani (i mazani) dalsich polozek

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

  private $ente_definovane = false; //je-li definovane ente oznacovani
  private $ente_ozn_def = array(1, 3, 4); //pole definovachy cisel

  private $ente_ozn_od = 0;
  private $ente_ozn_po = 2;

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

    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->defprvni = $this->NactiUnikatniObsah($this->unikatni["set_defprvni"]);
    $this->get_sekce = $this->NactiUnikatniObsah($this->unikatni["set_get_sekce"]);
    $this->vypis_chybu = $this->NactiUnikatniObsah($this->unikatni["set_vypis_chybu"]);
    $this->povolit_pridani = $this->NactiUnikatniObsah($this->unikatni["set_povolit_pridani"]);

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $this->Instalace();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"], $this->idmodul));
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
      if (!@$this->sqlite->queryExec("CREATE TABLE skupina_menu (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      nazev VARCHAR(200),
                                      poradi INTEGER UNSIGNED,
                                      razeni BOOL,
                                      adresa TEXT,
                                      adr_obsahu VARCHAR(200));

                                      CREATE TABLE dynamic_menu (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      main_href VARCHAR(200),
                                      odkaz VARCHAR(300),
                                      title VARCHAR(300),
                                      href_id VARCHAR(200),
                                      href_class VARCHAR(200),
                                      href_akce VARCHAR(500),
                                      skupina INTEGER UNSIGNED,
                                      poradi INTEGER UNSIGNED,
                                      defaultni BOOL);", $error))
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
    if ($res = @$this->sqlite->query("SELECT adresa FROM skupina_menu ORDER BY poradi ASC LIMIT 0,1;", NULL, $error))
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
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicMenu", "DefaultniPolozka", $adresa_sekce);</strong>
 *
 * @return nazev defaultni polozky
 */
  public function DefaultniPolozka($kam)
  {
    $result = "";
    if (!Empty($kam))
    {
      if ($res = @$this->sqlite->query("SELECT main_href
                                        FROM skupina_menu, dynamic_menu
                                        WHERE
                                        skupina_menu.adresa='{$kam}' AND
                                        skupina_menu.id=dynamic_menu.skupina AND
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
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicMenu", "DynamickyMenu", "korenovy_link"[, "nejaka_adresa", $cislo]);</strong>
 *
 * @param vnoreni pod-adresa sekce
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return vygenerovany obsah
 */
  public function DynamickyMenu($vnoreni, $adr = NULL, $tvar = 1)
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

    //prepinani mezi linearnim a definovanym oznacovani
    $this->ente_definovane = $this->NactiUnikatniObsah($this->unikatni["set_ente_definovane_{$tvar}"]);

    //pole definovaneho oznacovani
    $this->ente_ozn_def = $this->NactiUnikatniObsah($this->unikatni["set_ente_ozn_def_{$tvar}"]);

    //cislo linearniho oznacovani od
    $this->ente_ozn_od = $this->NactiUnikatniObsah($this->unikatni["set_ente_ozn_od_{$tvar}"]);

    //cislo linearniho oznacovani krok
    $this->ente_ozn_po = $this->NactiUnikatniObsah($this->unikatni["set_ente_ozn_po_{$tvar}"]);

    $kam = $_GET[$this->get_sekce]; //odchytava get_sekce

    $defaultni = $this->DefaultniPolozka($adresa);

    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev, razeni FROM skupina_menu WHERE adresa='{$adresa}' ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          if ($data->razeni)  //rozlisuje typ razeni
          {
            $order = "dynamic_menu.poradi ASC";
          }
            else
          {
            $order = "LOWER(dynamic_menu.odkaz) ASC";
          }

          $result .= (!Empty($data->nazev) ? $this->NactiUnikatniObsah($this->unikatni["normal_vypis_menu_nadpis_{$tvar}"],
                                                                      $data->nazev) : ""); //nadpis

          //vypisuje sub odkazy
          if ($res1 = @$this->sqlite->query("SELECT
                                            main_href,
                                            odkaz,
                                            href_id,
                                            href_class,
                                            href_akce
                                            FROM dynamic_menu
                                            WHERE dynamic_menu.skupina={$data->id}
                                            ORDER BY {$order};
                                            ", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              $i = 0;
              while ($data1 = $res1->fetchObject())
              { //pokud se shoduje main_href s adresaou a nebo prazdna subadresa a dafault se rovna main_href
                $podminka = ($kam == $data1->main_href || (Empty($kam) && $defaultni == $data1->main_href));

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

                //eventualni podminky pro oznaceni zacatku, konce a kazdeno eN-teho
                $prvni = ($i == 0); //prvni
                $posledni = ($i == ($res1->numRows() - 1)); //posledni
                $ente = ($this->ente_definovane ? in_array($i, $this->ente_ozn_def) : (($i + $this->ente_ozn_od) % $this->ente_ozn_po) == 0);

                $mainhref = (!Empty($data1->main_href) ? ($this->var->htaccess ? "{$this->absolutni_url}{$vnoreni}/{$data1->main_href}" : "?{$this->var->get_kam}={$vnoreni}&amp;{$this->get_sekce}={$data1->main_href}") : "./");
                $id = (!Empty($data1->href_id) ? " id=\"{$data1->href_id}{$ozn_id}\"" : "");
                $class = (!Empty($data1->href_class) || !Empty($ozn_class) ? " class=\"{$data1->href_class}{$ozn_class}\"" : "");
                $akce = (!Empty($data1->href_akce) ? " {$data1->href_akce}" : "");

                $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_menu_{$tvar}"],
                                                    $mainhref,
                                                    $data1->odkaz,
                                                    $class,
                                                    $id,
                                                    $akce,
                                                    $ozn_odkaz_l,
                                                    $ozn_odkaz_p,
                                                    ($prvni ? $this->NactiUnikatniObsah($this->unikatni["normal_menu_prvni_{$tvar}"]) : ""),
                                                    ($posledni ? $this->NactiUnikatniObsah($this->unikatni["normal_menu_posledni_{$tvar}"]) : ""),
                                                    ($ente ? $this->NactiUnikatniObsah($this->unikatni["normal_menu_ente_{$tvar}"]) : ""),
                                                    $i);
                $i++;
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        }
      }
        else
      {
        if ($this->vypis_chybu)
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_null_{$tvar}"]);
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
 * Vrati typ (bool) razeni poradi/abeceda
 *
 * @param skupina zvolena skupina
 * @return razeni podle poradi / abecedy
 */
  private function VolbaRazeni($skupina)
  {
    $result = 0;
    if (!Empty($skupina))
    {
      if ($res = @$this->sqlite->query("SELECT razeni FROM skupina_menu WHERE id={$skupina};", NULL, $error))
      {
        if ($res->numRows() == 1)
        {
          $result = $res->fetchObject()->razeni;
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }

    settype($result, "bool");

    return $result;
  }

/**
 *
 * Vraci text title
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicMenu", "DynamickyMenu", "Title", "adresa");</strong>
 *
 * @return title text
 */
  public function Title($adresa)
  {
    $kam = $_GET[$this->get_sekce]; //odchytava get_sekce

    if ($res = @$this->sqlite->query("SELECT
                                      title
                                      FROM dynamic_menu, skupina_menu
                                      WHERE
                                      skupina_menu.id=dynamic_menu.skupina AND
                                      main_href='{$kam}' AND
                                      skupina_menu.adresa='{$adresa}'
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
 * Vypis skupin menu v selektech
 *
 * @param id nepovinny parametr pro oznaceni skupny
 * @return select s vypisem
 */
  private function VyberSkupiny($id = NULL)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev, adresa FROM skupina_menu ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_skupiny_begin"]);
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_skupiny"],
                                              $data->id,
                                              (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->nazev,
                                              $data->adresa);
        }
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_skupiny_end"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_skupiny_null"]);
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
 * Vrati pocet radku skupin
 *
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetSkupin($inc = 0)
  {
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) as pocet FROM skupina_menu;", NULL, $error))
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
 * Vrati pocet radku
 *
 * @param skupina cislo skupiny
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($skupina, $inc = 0)
  {
    settype($skupina, "integer");
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) as pocet FROM dynamic_menu WHERE skupina={$skupina};", NULL, $error))
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
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_obsah_add"],
                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addgrup") : ""),
                                        $this->AdminVypisMenu());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addgrup": //pridavani skupin
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgrup"],
                                              $_GET["adresa"],
                                              $this->PocetSkupin(1));

          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
          settype($poradi, "integer");
          $razeni = ($_POST["razeni"] == "true" ? 1 : 0);
          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $adr_obsahu = stripslashes(htmlspecialchars($_POST["adr_obsahu"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              //!Empty($nazev) &&
              !Empty($poradi) &&
              $poradi > 0 &&
              !Empty($adresa) &&
              !Empty($adr_obsahu) &&
              $this->povolit_pridani)
          {
            if (@$this->sqlite->queryExec("INSERT INTO skupina_menu (id, nazev, poradi, razeni, adresa, adr_obsahu) VALUES
                                          (NULL, '{$nazev}', {$poradi}, {$razeni}, '{$adresa}', '{$adr_obsahu}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgrup_hlaska"], $adresa);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editgrup":  //uprava
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT nazev, poradi, razeni, adresa, adr_obsahu FROM skupina_menu WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgrup"],
                                                  $data->adresa,
                                                  $data->nazev,
                                                  $data->poradi,
                                                  $data->adr_obsahu,
                                                  ($data->razeni ? " checked=\"checked\"" : ""),
                                                  (!$data->razeni ? " checked=\"checked\"" : ""));

              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
              settype($poradi, "integer");
              $razeni = ($_POST["razeni"] == "true" ? 1 : 0);
              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $adr_obsahu = stripslashes(htmlspecialchars($_POST["adr_obsahu"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  //!Empty($nazev) &&
                  !Empty($poradi) &&
                  $poradi > 0 &&
                  !Empty($adresa) &&
                  !Empty($adr_obsahu) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec ("UPDATE skupina_menu SET nazev='{$nazev}',
                                                                        poradi={$poradi},
                                                                        razeni={$razeni},
                                                                        adresa='{$adresa}',
                                                                        adr_obsahu='{$adr_obsahu}'
                                                                        WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgrup_hlaska"], $adresa);
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

        case "delgrup": //mazani podle id
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = @$this->sqlite->query("SELECT adresa FROM skupina_menu WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM skupina_menu WHERE id={$id};
                                            DELETE FROM dynamic_menu WHERE skupina={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delgrup_hlaska"], $data->adresa);
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

        case "addmenu": //pridavani poloze menu
          $skup = $_GET["skupina"];
          settype($skup, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addmenu"],
                                              $this->VyberSkupiny($skup),
                                              ($this->VolbaRazeni($skup) ? $this->NactiUnikatniObsah($this->unikatni["admin_addmenu_poradi"], $this->PocetRadku($skup, 1)) : ""));

          $main_href = stripslashes(htmlspecialchars($_POST["main_href"], ENT_QUOTES));
          $odkaz = stripslashes(htmlspecialchars($_POST["odkaz"], ENT_QUOTES));
          $title = stripslashes(htmlspecialchars($_POST["title"], ENT_QUOTES));
          $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
          $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
          $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));
          $skupina = $_POST["skupina"];
          settype($skupina, "integer");
          $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
          settype($poradi, "integer");
          $defaultni = (!Empty($_POST["defaultni"]) ? 1 : 0);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($main_href) &&
              !Empty($odkaz) &&
              !Empty($skupina) &&
              $skupina > 0 &&
              $this->povolit_pridani)
          {
            if (@$this->sqlite->queryExec("INSERT INTO dynamic_menu (id, main_href, odkaz, title, href_id, href_class, href_akce, skupina, poradi, defaultni) VALUES
                                          (NULL, '{$main_href}', '{$odkaz}', '{$title}', '{$href_id}', '{$href_class}', '{$href_akce}', {$skupina}, {$poradi}, {$defaultni});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addmenu_hlaska"], $main_href);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editmenu":  //uprava menu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT main_href, odkaz, title, href_id, href_class, href_akce, skupina, poradi, defaultni FROM dynamic_menu WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editmenu"],
                                                  $data->main_href,
                                                  $data->odkaz,
                                                  $data->title,
                                                  $data->href_id,
                                                  $data->href_class,
                                                  $data->href_akce,
                                                  $this->VyberSkupiny($data->skupina),
                                                  ($this->VolbaRazeni($data->skupina) ? $this->NactiUnikatniObsah($this->unikatni["admin_editmenu_poradi"], $data->poradi) : ""),
                                                  ($data->defaultni ? " checked=\"checked\"" : ""));

              $main_href = stripslashes(htmlspecialchars($_POST["main_href"], ENT_QUOTES));
              $odkaz = stripslashes(htmlspecialchars($_POST["odkaz"], ENT_QUOTES));
              $title = stripslashes(htmlspecialchars($_POST["title"], ENT_QUOTES));
              $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
              $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
              $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));
              $skupina = $_POST["skupina"];
              settype($skupina, "integer");
              $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
              settype($poradi, "integer");
              $defaultni = (!Empty($_POST["defaultni"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($main_href) &&
                  !Empty($odkaz) &&
                  !Empty($skupina) &&
                  $skupina > 0 &&
                  $id != 0)
              { //kdyz bude dafaultni na ON tak se ve skupine promazne a nastavi nove
                if (@$this->sqlite->queryExec ("UPDATE dynamic_menu SET main_href='{$main_href}',
                                                                        odkaz='{$odkaz}',
                                                                        title='{$title}',
                                                                        href_id='{$href_id}',
                                                                        href_class='{$href_class}',
                                                                        href_akce='{$href_akce}',
                                                                        skupina={$skupina},
                                                                        poradi={$poradi},
                                                                        defaultni={$defaultni}
                                                                        WHERE id={$id};
                                                ".($defaultni ? "UPDATE dynamic_menu SET defaultni=0 WHERE skupina={$skupina};" : "")."
                                                UPDATE dynamic_menu SET defaultni='{$defaultni}' WHERE skupina={$skupina} AND id={$id};
                                                                        ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editmenu_hlaska"], $main_href);
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

        case "delmenu": //mazani menu podle id
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = @$this->sqlite->query("SELECT main_href FROM dynamic_menu WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM dynamic_menu WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delmenu_hlaska"], $data->main_href);
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
    if ($res = @$this->sqlite->query("SELECT id, nazev, poradi, razeni, adresa, adr_obsahu FROM skupina_menu ORDER BY poradi ASC, LOWER(nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina"],
                                              $data->nazev,
                                              $data->adresa,
                                              $data->adr_obsahu,
                                              ($data->razeni ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_poradi"]) :
                                                                $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_nazev"])),
                                              $data->poradi,
                                              ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_addmenu"], "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addmenu&amp;skupina={$data->id}") : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editgrup&amp;id={$data->id}",
                                              ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_delgru"], "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delgrup&amp;id={$data->id}", $data->adresa) : ""));

          if ($data->razeni)  //rozlisuje typ razeni
          {
            $order = "dynamic_menu.poradi ASC";
          }
            else
          {
            $order = "LOWER(dynamic_menu.odkaz) ASC";
          }

          if ($res1 = @$this->sqlite->query("SELECT
                                            id,
                                            main_href,
                                            odkaz,
                                            title,
                                            href_id,
                                            href_class,
                                            href_akce,
                                            defaultni,
                                            poradi
                                            FROM dynamic_menu
                                            WHERE skupina={$data->id}
                                            ORDER BY
                                            {$order};
                                            ", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                                    $data1->main_href,
                                                    $data1->odkaz,
                                                    $data1->title,
                                                    $data1->href_id,
                                                    $data1->href_class,
                                                    $data1->href_akce,
                                                    $data1->poradi,
                                                    ($data1->defaultni ? " checked=\"checked\"" : ""),
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editmenu&amp;id={$data1->id}",
                                                    ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_del"], "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delmenu&amp;id={$data1->id}", $data1->main_href) : ""),
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$data->adr_obsahu}&amp;adresa={$data1->main_href}");
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
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
