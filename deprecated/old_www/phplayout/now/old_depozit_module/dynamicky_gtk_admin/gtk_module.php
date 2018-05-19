<?php

/**
 *
 * Blok dynamicky generovaneho obsahu
 *
 * public funkce:\n
 * construct: DynamicGtkModule - hlavni konstruktor tridy\n
 * DynamickyObsah() - hlavni vypis obsahu\n
 * PridejSmazStranku() - funkce pridava a maze z externich modulu obsah stranek\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicGtkModule extends DefaultModule
{
  private $var;
  private $sqlite;
  private $dbname;
  private $idmodul = "dyngtkmod";  //id pro rozliseni modulu v adminu
  private $dirpath;
  //private $defprvni = false;  //brat defaultne prvni polozku
  private $vypis_chybu = false;
  private $adrobsahu = "dynobsah";  //adresa adminu dynamickeho obsahu

  private $adresy;

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

    $this->adresy = $this->var->main[0]->NactiFunkci("DynamicObsah", "SeznamAdres");

    $adresa_menu = array( array("main_href" => "{$this->idmodul}",
                                "odkaz" => "Nadstavba dynamického obsahu",
                                "title" => "Nadstavba dynamického obsahu",
                                "id" => "",
                                "class" => "nadstavba_obsahu_delsi_nazev_menu",
                                "akce" => ""),
                          );

    $adresa_menu = $this->RozsiritAdminMenu($adresa_menu);  //rozsiri adresu menu o sekce z tohoto modulu

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
      $adr = explode("__", $_GET[$this->var->get_idmodul]);
      switch ($adr[0])
      {
        case $this->idmodul:  //id modul
          $result = (!Empty($adr[1]) ? $this->VypisObsahSkupny($adr[1]) : $this->AdministraceObsahu());
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
      if (!@$this->sqlite->queryExec("CREATE TABLE gtk_module (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      nazev VARCHAR(200),
                                      adresy TEXT,
                                      popisek TEXT,
                                      href_id VARCHAR(200),
                                      href_class VARCHAR(200),
                                      href_akce VARCHAR(500));
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Rozsireni menu adminu o dane skupiny z teto sekce
 *
 * @param adresa pole adres adminmenu
 * @return rozsirene pole adres adminmenu o sekce z tohoto modulu
 */
  private function RozsiritAdminMenu($adresa)
  {
    $i = count($adresa);
    if ($res = @$this->sqlite->query("SELECT id, nazev, href_id, href_class, href_akce FROM gtk_module;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $adresa[$i]["main_href"] = "{$this->idmodul}__{$data->id}";

          $adresa[$i]["odkaz"] = "{$data->nazev}";
          $adresa[$i]["title"] = "{$data->nazev}";
          $adresa[$i]["id"] = $data->href_id;
          $adresa[$i]["class"] = $data->href_class;
          $adresa[$i]["akce"] = $data->href_akce;
          $i++;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $adresa;
  }

/**
 *
 * Zpracuje vypis adres z dynamic_obsahu
 *
 * @return vypis obsahu s check boxy
 */
  private function ZpracovaniAdres($adr = NULL)
  {
    $oznac = (!Empty($adr) ? explode("-", $adr) : NULL);
    $klice = array_keys($this->adresy);
    $result = "";
    for ($i = 0; $i < count($this->adresy); $i++)
    {
      $result .=
      "<input type=\"checkbox\" name=\"adresy[]\"".(!Empty($oznac) && in_array($klice[$i], $oznac) ? " checked=\"checked\"" : ($this->KontrolaRezervace($klice[$i]) ? "disabled=\"disabled\"" : ""))." value=\"{$klice[$i]}\"> {$this->adresy[$klice[$i]]}<br />\n";
    }

    return $result;
  }

/**
 *
 * Kontrola zda je jiz dane ID ulozene v nejake skupine
 *
 * @param id cislo pro kontrolu v db
 * @return true / false - existuje / neexistuje v databazi
 */
  private function KontrolaRezervace($id)
  {
    settype($id, "integer");

    $result = false;
    if ($res = @$this->sqlite->query("SELECT id FROM gtk_module
                                      WHERE
                                      adresy LIKE ('%-{$id}-%') OR
                                      adresy LIKE ('{$id}-%') OR
                                      adresy LIKE ('%-{$id}') OR
                                      adresy={$id};
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
 * Vypis zdruzenych odkazu (ve skupine) podle adresy
 *
 * @param adr text adres pro vypis odkazu
 * @return vypis odkazu na upravu obsahu
 */
  private function VypisSkupiny($adr)
  {
    $data = explode("-", $adr);
    $result = "";
    for ($i = 0; $i < count($data); $i++)
    {
      $result .=
      "
      <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->adrobsahu}&amp;co=edit&amp;id={$data[$i]}&amp;ret={$_GET[$this->var->get_idmodul]}\" title=\"{$this->adresy[$data[$i]]}\">{$this->adresy[$data[$i]]}</a><br />
      ";
    }

    return $result;
  }

/**
 *
 * Vypise obsah skupiny, univerzelni vypis
 *
 * @param id id dane skupiny
 * @return obsah skupny s odkazy
 */
  private function VypisObsahSkupny($id)
  {
    settype($id, "integer");

    if ($res = @$this->sqlite->query("SELECT nazev, adresy, popisek FROM gtk_module WHERE id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();

        $result =
        "<br />
        {$data->nazev}<br />
        {$data->popisek}<br />
        {$this->VypisSkupiny($data->adresy)}
        ";
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
 * Interne volana funkce pro zobrazovani administrace
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result =
    "graficka nastavba dynamickeho obsahu<br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add\" title=\"\">přidej skupinu</a><br />
    {$this->AdminVypisObsahu()}<br />";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani
          $result =
          "
          <form method=\"post\">
            <fieldset>
              {$this->ZpracovaniAdres()}
              nazev: <input type=\"text\" name=\"nazev\" />*<br />
              popisek: <textarea name=\"popisek\"></textarea><br />
              href_id: <input type=\"text\" name=\"href_id\" /><br />
              href_class: <input type=\"text\" name=\"href_class\" /><br />
              href_akce: <input type=\"text\" name=\"href_akce\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ";

          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $adresy = (!Empty($_POST["adresy"]) ? implode("-", $_POST["adresy"]) : "");
          $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
          $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
          $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
          $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev))
          {
            if (@$this->sqlite->queryExec("INSERT INTO gtk_module (id, nazev, adresy, popisek, href_id, href_class, href_akce) VALUES
                                          (NULL, '{$nazev}', '{$adresy}', '{$popisek}', '{$href_id}', '{$href_class}', '{$href_akce}');", $error))
            {
              $result =
              "
                přídán: {$nazev}
              ";
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "edit":  //uprava
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT id, nazev, adresy, popisek, href_id, href_class, href_akce FROM gtk_module WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  {$this->ZpracovaniAdres($data->adresy)}
                  nazev: <input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\" />*<br />
                  popisek: <textarea name=\"popisek\">{$data->popisek}</textarea><br />
                  href_id: <input type=\"text\" name=\"href_id\" value=\"{$data->href_id}\" /><br />
                  href_class: <input type=\"text\" name=\"href_class\" value=\"{$data->href_class}\" /><br />
                  href_akce: <input type=\"text\" name=\"href_akce\" value=\"{$data->href_akce}\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $adresy = (!Empty($_POST["adresy"]) ? implode("-", $_POST["adresy"]) : "");
              $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
              $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
              $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
              $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec ("UPDATE gtk_module SET nazev='{$nazev}',
                                                                      adresy='{$adresy}',
                                                                      popisek='{$popisek}'
                                                                      WHERE id={$id};", $error))
                {
                  $result =
                  "
                    upraven: {$nazev}
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

        case "del": //mazani podle id
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT nazev FROM gtk_module WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM gtk_module WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazán: '{$data->nazev}'
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

        case "show":  //zobrazeni podle id
          $result =
          "<br />
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\">zpet na vypis sekci</a>
          {$this->VypisObsahSkupny($_GET["id"])}
          ";
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
  private function AdminVypisObsahu()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev, adresy, popisek FROM gtk_module ORDER BY nazev ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
<br />
<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=show&amp;id={$data->id}\" title=\"\">{$data->nazev}</a><br />
popis: {$data->popisek}<br />
<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}\" title=\"\">uprav skupinu</a>
<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat skupinu: \'{$data->nazev}\' ?');\">smazat skupinu</a>
<br />
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
