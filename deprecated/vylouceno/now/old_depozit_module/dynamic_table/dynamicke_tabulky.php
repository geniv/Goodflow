<?php

/**
 *
 * Blok dynamicky generovanych tabulek
 *
 * public funkce:\n
 * construct: DynamicTable - hlavni konstruktor tridy\n
 * Table() - vypis obsahu galerie podle adresy\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicTable extends DefaultModule
{
  private $var;
  private $sqlite;
  private $dbname;
  private $idmodul = "dyntab";
  private $dirpath;
  private $min_col = 1; //min sloupcu
  private $max_col = 0; //max sloupcu, 0 - nekonecno

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
                                "odkaz" => "administrace dynamickych tabulek",
                                "title" => " - administrace dynamickych tabulek",
                                "id" => "",
                                "class" => "",
                                "akce" => ""),
                          );

    $this->NastavitAdresuMenu($adresa_menu);
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
      if (!@$this->sqlite->queryExec("CREATE TABLE hlavicka (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      nadpis VARCHAR(200),
                                      sloupce TEXT,
                                      defaultni TEXT,
                                      poznamka VARCHAR(300),
                                      table_id VARCHAR(200),
                                      table_class VARCHAR(200),
                                      table_akce VARCHAR(500));

                                      CREATE TABLE bunka (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      hlavicka INTEGER UNSIGNED,
                                      radek TEXT,
                                      poradi INTEGER UNSIGNED,
                                      bunka_id VARCHAR(200),
                                      bunka_class VARCHAR(200),
                                      bunka_akce VARCHAR(500));
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Navraceni samotne tabulky podle sekce
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicTable", "Table"[, "adresa"]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return vystupni galerie
 */
  public function Table($adr = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
    }

    $result = "";
    if ($res = @$this->sqlite->query("SELECT
                                      id,
                                      nadpis,
                                      sloupce,
                                      poznamka,
                                      table_id,
                                      table_class,
                                      table_akce
                                      FROM hlavicka
                                      WHERE adresa='{$adresa}';", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $sloupce = "";
          $sloup = explode("|--|", $data->sloupce);
          $poc_sloup = count($sloup);
          for ($i = 0; $i < $poc_sloup; $i++)  //generovani hlavicky
          {
            $sloupce .=
            "<th>{$sloup[$i]}</th>";
          }

          $id = (!Empty($data->table_id) ? " id=\"{$data->table_id}\"" : "");
          $class = (!Empty($data->table_class) ? " class=\"{$data->table_class}\"" : "");
          $akce = (!Empty($data->table_akce) ? " {$data->table_akce}" : "");

          $result .=
          "{$data->nadpis}
          <table border=\"1\"{$id}{$class}{$akce}>
          <tr>
          {$sloupce}
          </tr>
          ";

          //generovani bunek
          if ($res1 = @$this->sqlite->query("SELECT
                                            radek,
                                            poradi,
                                            bunka_id,
                                            bunka_class,
                                            bunka_akce
                                            FROM bunka
                                            WHERE hlavicka={$data->id}
                                            ORDER BY poradi ASC, id ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $id = (!Empty($data1->bunka_id) ? " id=\"{$data1->bunka_id}\"" : "");
                $class = (!Empty($data1->bunka_class) ? " class=\"{$data1->bunka_class}\"" : "");
                $akce = (!Empty($data1->bunka_akce) ? " {$data1->bunka_akce}" : "");

                $radek = "";
                $rad = explode("|--|", $data1->radek);
                for ($i = 0; $i < count($rad); $i++)
                {
                  $radek .=
                  "<td>{$rad[$i]}</td>";
                }

                $result .=  //tridy pro kazdy radek TR
                "
                <tr{$id}{$class}{$akce}>
                  {$radek}
                </tr>
                ";
              }
            }
              else
            {
              $result .= "<th colspan=\"{$poc_sloup}\">žádný řádek</th>";
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          $result .=
          "
          </table>
          {$data->poznamka}";
        }
      }
        else
      {
        $result = "žádná položka";
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
          $result = $this->AdministraceTable();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vrati select pro vyber z tabulek
 *
 * @param id id polozky menu, nepovinne
 * @return html select
 */
  private function VyberTabulky($id = NULL)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa FROM hlavicka ORDER BY LOWER(adresa) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = "<select name=\"hlavicka\">";
        while ($data = $res->fetchObject())
        {
          $result .=
          "
            <option value=\"{$data->id}\"".(!Empty($id) && $id == $data->id ? " selected=\"selected\"" : "").">adresa: {$data->adresa}</option>
          ";
        }
        $result .= "</select>";
      }
        else
      {
        $result = "žádný formulář";
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
 * Vrati pocet bunek dane hlavicky
 *
 * @param hlavicka cislo hlavicky
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($hlavicka, $inc = 0)
  {
    settype($hlavicka, "integer");
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) as pocet FROM bunka WHERE hlavicka={$hlavicka};", NULL, $error))
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
 * Interne volana funkce pro zobrazovani administrace dynamickych tabulek
 *
 * @return adminstracni formular v html
 */
  private function AdministraceTable()
  {
    $result =
    "administrace dynamickych tabulek
    <br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab&amp;col=4\" title=\"\">přidat tabulku</a><br />
    <br />
    {$this->AdminVypisTable()}
    ";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addtab":
          $col = $_GET["col"];  //cislo sekce
          settype($col, "integer");

          $col = ($col <= 0 || $col < $this->min_col || ($this->max_col > 0 ? $col > $this->max_col : false) ? $this->min_col : $col);  //osetreni spatnych vstupu

          $plus = ($this->max_col > 0 ? (($col + 1) <= $this->max_col ? $col + 1 : $col) : $col + 1);
          $mimus = (($col - 1) < $this->min_col ? $this->min_col : $col - 1); //osetreni zapornych cisel

          $sloupce = str_repeat("<input type=\"text\" name=\"sloupce[]\" size=\"10\" />", $col);
          $defaultni = str_repeat("<input type=\"text\" name=\"defaultni[]\" size=\"10\" />", $col);

          $result =
          "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /><br />
              nadpis: <input type=\"text\" name=\"nadpis\" /><br />
              <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab&amp;col={$plus}\" title=\"\">++ přidat sloupec</a>
              <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab&amp;col={$mimus}\" title=\"\">-- odebrat sloupec</a><br />
              sloupce: {$sloupce}<br />
              defaultni: {$defaultni}<br />
              poznamka: <input type=\"text\" name=\"poznamka\" /><br />
              table_id: <input type=\"text\" name=\"table_id\" /><br />
              table_class: <input type=\"text\" name=\"table_class\" /><br />
              table_akce: <input type=\"text\" name=\"table_akce\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat tabulku\" />
            </fieldset>
          </form>
          ";

          if (count($_POST) > 1)
          {
            $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
            $nadpis = stripslashes(htmlspecialchars($_POST["nadpis"], ENT_QUOTES));
            $sloupce = stripslashes(htmlspecialchars(implode("|--|", $_POST["sloupce"]), ENT_QUOTES));
            $defaultni = stripslashes(htmlspecialchars(implode("|--|", $_POST["defaultni"]), ENT_QUOTES));
            $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"], ENT_QUOTES));
            $table_id = stripslashes(htmlspecialchars($_POST["table_id"], ENT_QUOTES));
            $table_class = stripslashes(htmlspecialchars($_POST["table_class"], ENT_QUOTES));
            $table_akce = stripslashes(htmlspecialchars($_POST["table_akce"], ENT_QUOTES));
          }

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa))
          {
            if (@$this->sqlite->queryExec("INSERT INTO hlavicka (id, adresa, nadpis, sloupce, defaultni, poznamka, table_id, table_class, table_akce) VALUES
                                          (NULL, '{$adresa}', '{$nadpis}', '{$sloupce}', '{$defaultni}', '{$poznamka}', '{$table_id}', '{$table_class}', '{$table_akce}');", $error))
            {
              $result =
              "
                přídána tabulka s adresou: {$adresa}
              ";
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "edittab":
          $col = $_GET["col"];  //cislo sekce
          settype($col, "integer");

          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, nadpis, sloupce, defaultni, poznamka, table_id, table_class, table_akce FROM hlavicka WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $col = ($col <= 0 || $col < $this->min_col || ($this->max_col > 0 ? $col > $this->max_col : false) ? $this->min_col : $col);  //osetreni spatnych vstupu

              $plus = ($this->max_col > 0 ? (($col + 1) <= $this->max_col ? $col + 1 : $col) : $col + 1);
              $mimus = (($col - 1) < $this->min_col ? $this->min_col : $col - 1); //osetreni zapornych cisel

              $sloupce = "";
              $sloup = explode("|--|", $data->sloupce);
              for ($i = 0; $i < count($sloup); $i++)
              {
                $sloupce .=
                "<input type=\"text\" name=\"sloupce[]\" size=\"10\" value=\"{$sloup[$i]}\" />";
              }

              $defaultni = "";
              $def = explode("|--|", $data->defaultni);
              for ($i = 0; $i < count($def); $i++)
              {
                $defaultni .=
                "<input type=\"text\" name=\"defaultni[]\" size=\"10\" value=\"{$def[$i]}\" />";
              }

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"{$data->adresa}\" /><br />
                  nadpis: <input type=\"text\" name=\"nadpis\" value=\"{$data->nadpis}\" /><br />
                  <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;col={$plus}&amp;id={$id}\" title=\"\">++ přidat sloupec</a>
                  <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;col={$mimus}&amp;id={$id}\" title=\"\">-- odebrat sloupec</a><br />
                  sloupce: {$sloupce}<br />
                  defaultni: {$defaultni}<br />
                  poznamka: <input type=\"text\" name=\"poznamka\" value=\"{$data->poznamka}\" /><br />
                  table_id: <input type=\"text\" name=\"table_id\" value=\"{$data->table_id}\" /><br />
                  table_class: <input type=\"text\" name=\"table_class\" value=\"{$data->table_class}\" /><br />
                  table_akce: <input type=\"text\" name=\"table_akce\" value=\"{$data->table_akce}\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit tabulku\" />
                </fieldset>
              </form>
              ";

              if (count($_POST) > 1)
              {
                $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
                $nadpis = stripslashes(htmlspecialchars($_POST["nadpis"], ENT_QUOTES));
                $sloupce = stripslashes(htmlspecialchars(implode("|--|", $_POST["sloupce"]), ENT_QUOTES));
                $defaultni = stripslashes(htmlspecialchars(implode("|--|", $_POST["defaultni"]), ENT_QUOTES));
                $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"], ENT_QUOTES));
                $table_id = stripslashes(htmlspecialchars($_POST["table_id"], ENT_QUOTES));
                $table_class = stripslashes(htmlspecialchars($_POST["table_class"], ENT_QUOTES));
                $table_akce = stripslashes(htmlspecialchars($_POST["table_akce"], ENT_QUOTES));
              }

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa))
              {
                if (@$this->sqlite->queryExec ("UPDATE hlavicka SET adresa='{$adresa}',
                                                                    nadpis='{$nadpis}',
                                                                    sloupce='{$sloupce}',
                                                                    defaultni='{$defaultni}',
                                                                    poznamka='{$poznamka}',
                                                                    table_id='{$table_id}',
                                                                    table_class='{$table_class}',
                                                                    table_akce='{$table_akce}'
                                                                    WHERE id={$id};", $error))
                {
                  $result =
                  "
                    upravena tabulka s adresou: {$adresa}
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

        case "deltab":
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa FROM hlavicka WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM hlavicka WHERE id={$id};
                                            DELETE FROM bunka WHERE hlavicka={$id};", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazana tabulka s adresou: {$data->adresa} a její buňky také
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

        case "addrow":
          $tab = $_GET["tab"];  //cislo sekce
          settype($tab, "integer");

          if ($res = @$this->sqlite->query("SELECT sloupce, defaultni FROM hlavicka WHERE id={$tab};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $sloupce = "<table border=\"1\"><tr>";
              $sloup = explode("|--|", $data->sloupce);
              for ($i = 0; $i < count($sloup); $i++)
              {
                $sloupce .=
                "<th>{$sloup[$i]}</th>";
              }

              $sloupce .= "</tr><tr>";
              $def = explode("|--|", $data->defaultni);
              for ($i = 0; $i < count($def); $i++)
              {
                $sloupce .=
                "<td><input type=\"text\" name=\"radek[]\" size=\"10\" value=\"{$def[$i]}\" /></td>";
              }
              $sloupce .= "</tr></table>";

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  {$this->VyberTabulky($tab)}<br />
                  sloupce: {$sloupce}
                  poradi: <input type=\"text\" name=\"poradi\" value=\"{$this->PocetRadku($tab, 1)}\" /><br />
                  bunka_id: <input type=\"text\" name=\"bunka_id\" /><br />
                  bunka_class: <input type=\"text\" name=\"bunka_class\" /><br />
                  bunka_akce: <input type=\"text\" name=\"bunka_akce\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Přidat řádek\" />
                </fieldset>
              </form>
              ";

            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          if (count($_POST) > 1)
          {
            $hlavicka = stripslashes(htmlspecialchars($_POST["hlavicka"], ENT_QUOTES));
            settype($hlavicka, "integer");
            $radek = stripslashes(htmlspecialchars(implode("|--|", $_POST["radek"]), ENT_QUOTES));
            $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
            settype($poradi, "integer");
            $bunka_id = stripslashes(htmlspecialchars($_POST["bunka_id"], ENT_QUOTES));
            $bunka_class = stripslashes(htmlspecialchars($_POST["bunka_class"], ENT_QUOTES));
            $bunka_akce = stripslashes(htmlspecialchars($_POST["bunka_akce"], ENT_QUOTES));
          }

          if (!Empty($_POST["tlacitko"]))
          {
            if (@$this->sqlite->queryExec("INSERT INTO bunka (id, hlavicka, radek, poradi, bunka_id, bunka_class, bunka_akce) VALUES
                                          (NULL, {$hlavicka}, '{$radek}', {$poradi}, '{$bunka_id}', '{$bunka_class}', '{$bunka_akce}');", $error))
            {
              $result =
              "
                přídán radek: {$radek}
              ";
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editrow":
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT hlavicka, radek, poradi, bunka_id, bunka_class, bunka_akce FROM bunka WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              //generovan popisku
              if ($res1 = @$this->sqlite->query("SELECT sloupce FROM hlavicka WHERE id={$data->hlavicka};", NULL, $error))
              {
                if ($res1->numRows() == 1)
                {
                  $data1 = $res1->fetchObject();

                  $sloupce = "<table border=\"1\"><tr>";
                  $sloup = explode("|--|", $data1->sloupce);
                  for ($i = 0; $i < count($sloup); $i++)
                  {
                    $sloupce .=
                    "<th>{$sloup[$i]}</th>";
                  }
                }
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error);
              }

              //generovani obsahu
              $sloupce .= "</tr><tr>";
              $rad = explode("|--|", $data->radek);
              for ($i = 0; $i < count($rad); $i++)
              {
                $sloupce .=
                "<td><input type=\"text\" name=\"radek[]\" size=\"10\" value=\"{$rad[$i]}\" /></td>";
              }
              $sloupce .= "</tr></table>";

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  {$this->VyberTabulky($data->hlavicka)}<br />
                  sloupce: {$sloupce}
                  poradi: <input type=\"text\" name=\"poradi\" value=\"{$data->poradi}\" /><br />
                  bunka_id: <input type=\"text\" name=\"bunka_id\" value=\"{$data->bunka_id}\" /><br />
                  bunka_class: <input type=\"text\" name=\"bunka_class\" value=\"{$data->bunka_class}\" /><br />
                  bunka_akce: <input type=\"text\" name=\"bunka_akce\" value=\"{$data->bunka_akce}\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit řádek\" />
                </fieldset>
              </form>
              ";
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          if (count($_POST) > 1)
          {
            $hlavicka = stripslashes(htmlspecialchars($_POST["hlavicka"], ENT_QUOTES));
            settype($hlavicka, "integer");
            $radek = stripslashes(htmlspecialchars(implode("|--|", $_POST["radek"]), ENT_QUOTES));
            $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
            settype($poradi, "integer");
            $bunka_id = stripslashes(htmlspecialchars($_POST["bunka_id"], ENT_QUOTES));
            $bunka_class = stripslashes(htmlspecialchars($_POST["bunka_class"], ENT_QUOTES));
            $bunka_akce = stripslashes(htmlspecialchars($_POST["bunka_akce"], ENT_QUOTES));
          }

          if (!Empty($_POST["tlacitko"]) &&
              $id != 0)
          {
            if (@$this->sqlite->queryExec("UPDATE bunka SET hlavicka={$hlavicka},
                                                            radek='{$radek}',
                                                            poradi={$poradi},
                                                            bunka_id='{$bunka_id}',
                                                            bunka_class='{$bunka_class}',
                                                            bunka_akce='{$bunka_akce}'
                                                            WHERE id={$id};", $error))
            {
              $result =
              "
                upraven radek: {$radek}
              ";
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "delrow":
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT radek FROM bunka WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM bunka WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazan radek: {$data->radek}
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
 * Vypis administrace tabulek
 *
 * @return vypis menu v html
 */
  private function AdminVypisTable()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id,
                                      adresa,
                                      nadpis,
                                      sloupce,
                                      defaultni,
                                      poznamka
                                      FROM hlavicka
                                      ORDER BY LOWER(adresa) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $sloupce = explode("|--|", $data->sloupce);
          $col = count($sloupce);

          $result .=
          "({$data->id}) '{$data->adresa}', '{$data->nadpis}'
          <p>
            adresa: {$data->adresa}<br />
            '{$data->poznamka}'<br />
            '{$data->sloupce}'
          </p>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addrow&amp;tab={$data->id}\" title=\"\">přidar řádek</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;col={$col}&amp;id={$data->id}\" title=\"\">upravit tabulku</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deltab&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->adresa}\' ?');\">smazat tabulku</a> <br />
          <br />
          ";

          if ($res1 = @$this->sqlite->query("SELECT id,
                                            radek,
                                            poradi
                                            FROM bunka
                                            WHERE hlavicka={$data->id}
                                            ORDER BY poradi ASC, id ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $result .=
                "
                {$data1->radek} - {$data1->poradi}<br />
                <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editrow&amp;id={$data1->id}\" title=\"\">upravit řádek</a>
                <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delrow&amp;id={$data1->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data1->radek}\' ?');\">smazat řádek</a><br />
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
