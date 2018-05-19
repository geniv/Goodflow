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
  private $var;
  private $sqlite;
  private $dbname;
  private $idmodul = "dynmenu";  //id pro rozliseni modulu v adminu
  private $dirpath;
  private $defprvni = false;  //brat defaultne prvni polozku
  private $get_sekce = "sekce"; //adresa vnoreneho menu
  private $vypis_chybu = false;
  private $povolit_pridani = true; //true/false - povolit / zakazat, pridavani (i mazani) dalsich polozek

  private $adrobsahu = "dynobsah";  //adresa adminu dynamickeho obsahu

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

    $adresa_menu = array( array("main_href" => "{$this->idmodul}",
                                "odkaz" => "Dynamické menu",
                                "title" => "Dynamické menu",
                                "id" => "",
                                "class" => "dynamicke_menu_menu",
                                "akce" => ""),
                          );

    $this->NastavitAdresuMenu($adresa_menu);
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
                                      adresa TEXT);

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
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicMenu", "DynamickyMenu", "korenovy_link"[, "nejaka_adresa"]);</strong>
 *
 * @param vnoreni pod-adresa sekce
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return vygenerovany obsah
 */
  public function DynamickyMenu($vnoreni, $adr = NULL)
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

          $result .= "          <h2>{$data->nazev}</h2>\n"; //nadpis

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

                //evantualni podminky pro oznaceni zacatku, konce a kazdeno eN-teho
                $prvni = ($i == 0); //prvni
                $posledni = ($i == ($res1->numRows() - 1)); //posledni
                $ente = ((($i + 0) % 2) == 0);  //kazde 2 od 0

                $mainhref = (!Empty($data1->main_href) ? ($this->var->htaccess ? (Empty($kam) ? "{$vnoreni}/" : "../")."{$vnoreni}/{$data1->main_href}" : "?{$this->var->get_kam}={$vnoreni}&amp;{$this->get_sekce}={$data1->main_href}") : "./");
                $id = (!Empty($data1->href_id) ? " id=\"{$data1->href_id}{$ozn_id}\"" : "");
                $class = (!Empty($data1->href_class) || !Empty($ozn_class) ? " class=\"{$data1->href_class}{$ozn_class}\"" : "");
                $akce = (!Empty($data1->href_akce) ? " {$data1->href_akce}" : "");

                $result .=
                 "          <p{$class}>
            <a href=\"{$mainhref}\" title=\"{$data1->odkaz}\"{$id}{$akce}>
              {$ozn_odkaz_l}{$data1->odkaz}{$ozn_odkaz_p}
            </a>
          </p>\n";

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
        $result = "<select name=\"skupina\">";
        while ($data = $res->fetchObject())
        {
          $result .=
          "
            <option value=\"{$data->id}\"".(!Empty($id) && $id == $data->id ? " selected=\"selected\"" : "").">{$data->nazev} ({$data->adresa})</option>
          ";
        }
        $result .= "</select>";
      }
        else
      {
        $result = "žádná skupina";
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
    $result =
    "administrace dynamickeho obsahu<br />
    ".($this->povolit_pridani ? "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addgrup\" title=\"\">přidej sekci</a><br />" : "")."
    {$this->AdminVypisMenu()}<br />";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addgrup": //pridavani skupin
          $result =
          "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" value=\"{$_GET["adresa"]}\" />(url adresa v ktere se menu nachazi... z parametru a nebo \$_SERVER[\"QUERY_STRING\"])<br />
              nazev: <input type=\"text\" name=\"nazev\" /><br />
              poradi: <input type=\"text\" name=\"poradi\" value=\"{$this->PocetSkupin(1)}\" /> >0<br />
              razeni:<br />
              podle poradi: <input type=\"radio\" name=\"razeni\" value=\"true\" checked=\"checked\" /><br />
              podle abecedy: <input type=\"radio\" name=\"razeni\" value=\"false\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ";

          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
          settype($poradi, "integer");
          $razeni = ($_POST["razeni"] == "true" ? 1 : 0);
          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !Empty($poradi) &&
              $poradi > 0 &&
              !Empty($adresa) &&
              $this->povolit_pridani)
          {
            if (@$this->sqlite->queryExec("INSERT INTO skupina_menu (id, nazev, poradi, razeni, adresa) VALUES
                                          (NULL, '{$nazev}', {$poradi}, {$razeni}, '{$adresa}');", $error))
            {
              $result =
              "
                přídána: {$adresa}
              ";
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

          if ($res = @$this->sqlite->query("SELECT nazev, poradi, razeni, adresa FROM skupina_menu WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"{$data->adresa}\" />(url adresa v ktere se menu nachazi... z parametru a nebo \$_SERVER[\"QUERY_STRING\"])<br />
                  nazev: <input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\" /><br />
                  poradi: <input type=\"text\" name=\"poradi\" value=\"{$data->poradi}\" />>0<br />
                  razeni:<br />
                  podle poradi: <input type=\"radio\" name=\"razeni\" value=\"true\"".($data->razeni ? " checked=\"checked\"" : "")." /><br />
                  podle abecedy: <input type=\"radio\" name=\"razeni\" value=\"false\"".(!$data->razeni ? " checked=\"checked\"" : "")." /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
              settype($poradi, "integer");
              $razeni = ($_POST["razeni"] == "true" ? 1 : 0);
              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  !Empty($poradi) &&
                  $poradi > 0 &&
                  !Empty($adresa) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec ("UPDATE skupina_menu SET nazev='{$nazev}',
                                                                        poradi={$poradi},
                                                                        razeni={$razeni},
                                                                        adresa='{$adresa}'
                                                                        WHERE id={$id};", $error))
                {
                  $result =
                  "
                    upravena: {$adresa}
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
                $result =
                "
                  smazána adresa: '{$data->adresa}', a všechny vnořené odkazy.
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

        case "addmenu": //pridavani poloze menu
          $skup = $_GET["skupina"];
          settype($skup, "integer");

          $result =
          "
          <form method=\"post\">
            <fieldset>
              main_href: <input type=\"text\" name=\"main_href\" /><br />
              odkaz: <input type=\"text\" name=\"odkaz\" /><br />
              title: <input type=\"text\" name=\"title\" /><br />
              href_id: <input type=\"text\" name=\"href_id\" /><br />
              href_class: <input type=\"text\" name=\"href_class\" /><br />
              href_akce: <input type=\"text\" name=\"href_akce\" /><br />
              {$this->VyberSkupiny($skup)}<br />
              ".($this->VolbaRazeni($skup) ? "poradi: <input type=\"text\" name=\"poradi\" value=\"{$this->PocetRadku($skup, 1)}\" /><br />" : "")."
              defaultni: <input type=\"checkbox\" name=\"defaultni\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ";

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

        case "editmenu":  //uprava menu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT main_href, odkaz, title, href_id, href_class, href_akce, skupina, poradi, defaultni FROM dynamic_menu WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  main_href: <input type=\"text\" name=\"main_href\" value=\"{$data->main_href}\" /><br />
                  odkaz: <input type=\"text\" name=\"odkaz\" value=\"{$data->odkaz}\" /><br />
                  title: <input type=\"text\" name=\"title\" value=\"{$data->title}\" /><br />
                  href_id: <input type=\"text\" name=\"href_id\" value=\"{$data->href_id}\" /><br />
                  href_class: <input type=\"text\" name=\"href_class\" value=\"{$data->href_class}\" /><br />
                  href_akce: <input type=\"text\" name=\"href_akce\" value=\"{$data->href_akce}\" /><br />
                  {$this->VyberSkupiny($data->skupina)}<br />
                  ".($this->VolbaRazeni($data->skupina) ? "poradi: <input type=\"text\" name=\"poradi\" value=\"{$data->poradi}\" /><br />" : "")."
                  defaultni: <input type=\"checkbox\" name=\"defaultni\"".($data->defaultni ? " checked=\"checked\"" : "")." /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

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
    if ($res = @$this->sqlite->query("SELECT id, nazev, poradi, razeni, adresa FROM skupina_menu ORDER BY poradi ASC, LOWER(nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "<br />
            <p>
             <p>{$data->nazev}</p>
              adresa: '{$data->adresa}'<br />
              razeni podle: ".($data->razeni ? "pořadí" : "názvu")."<br />
              poradi: {$data->poradi}<br />
              ".($this->povolit_pridani ? "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addmenu&amp;skupina={$data->id}\" title=\"\">přidej položku</a>" : "")."
              <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editgrup&amp;id={$data->id}\" title=\"\">uprav sekci</a>
              ".($this->povolit_pridani ? "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delgrup&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat adresu: \'{$data->adresa}\' ?');\">smazat sekci</a>" : "")."
            </p><br />
-------------------------------------------------------------------------------
          ";

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
                $result .=
                "<br />
                  <p>
                    {$data1->main_href}<br />
                    {$data1->odkaz}<br />
                    {$data1->title}<br />
                    {$data1->href_id}<br />
                    {$data1->href_class}<br />
                    {$data1->href_akce}<br />
                    poradi: {$data1->poradi}<br />
                    def: <input type=\"checkbox\"".($data1->defaultni ? " checked=\"checked\"" : "")." disabled /><br />
                    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editmenu&amp;id={$data1->id}\" title=\"\">uprav menu</a>
                    ".($this->povolit_pridani ? "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delmenu&amp;id={$data1->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat menu: \'{$data1->main_href}\' ?');\">smazat menu</a>" : "")."
                    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->adrobsahu}&amp;co=add&amp;adresa={$data1->main_href}\" title=\"\">přidat obsah</a>
                  </p>
                  <br />
*******************************************************************************
                ";
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
