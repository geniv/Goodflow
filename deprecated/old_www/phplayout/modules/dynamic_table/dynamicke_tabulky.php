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
  private $var, $sqlite, $dbname, $dirpath, $unikatni, $absolutni_url, $dbpredpona;
  public $idmodul = "dyntab";
  private $povolit_pridani = true; //true/false - povolit / zakazat, pridavani (i mazani) dalsich polozek

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

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->min_col = $this->NactiUnikatniObsah($this->unikatni["set_min_col"]);
    $this->max_col = $this->NactiUnikatniObsah($this->unikatni["set_max_col"]);
    $this->povolit_pridani = $this->NactiUnikatniObsah($this->unikatni["set_povolit_pridani"]);

    $this->dbpredpona = $this->NastavKomunikaci($this->var, $this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dirpath}/{$this->dbname}");
    if (!$this->PripojeniDatabaze($error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $this->Instalace();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"], $this->idmodul));
  }

/**
 *
 * Instalace databaze
 *
 */
  private function Instalace()
  {
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}hlavicka (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  adresa TEXT,
                                  nadpis VARCHAR(200),
                                  sloupce TEXT,
                                  defaultni TEXT,
                                  poznamka VARCHAR(300),
                                  table_id VARCHAR(200),
                                  table_class VARCHAR(200),
                                  table_akce VARCHAR(500));

                                  CREATE TABLE {$this->dbpredpona}bunka (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  hlavicka INTEGER UNSIGNED,
                                  radek TEXT,
                                  poradi INTEGER UNSIGNED,
                                  bunka_id VARCHAR(200),
                                  bunka_class VARCHAR(200),
                                  bunka_akce VARCHAR(500));", $error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
  public function Table($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
    }

    $prvni = $this->NactiUnikatniObsah($this->unikatni["normal_table_prvni_{$tvar}"]);
    $posledni = $this->NactiUnikatniObsah($this->unikatni["normal_table_posledni_{$tvar}"]);
    $ente_def_array = $this->NactiUnikatniObsah($this->unikatni["normal_table_ente_def_array_{$tvar}"]);
    $ente_def = $this->NactiUnikatniObsah($this->unikatni["normal_table_ente_def_{$tvar}"]);
    $ente_od = $this->NactiUnikatniObsah($this->unikatni["normal_table_ente_od_{$tvar}"]);
    $ente_po = $this->NactiUnikatniObsah($this->unikatni["normal_table_ente_po_{$tvar}"]);

    $result = "";
    if ($res = $this->query("SELECT
                            id,
                            nadpis,
                            sloupce,
                            poznamka,
                            table_id,
                            table_class,
                            table_akce
                            FROM {$this->dbpredpona}hlavicka
                            WHERE adresa='{$adresa}';", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $sloupce = "";
          $sloup = explode("|--|", $data->sloupce);
          $poc_sloup = count($sloup);
          for ($i = 0; $i < $poc_sloup; $i++)  //generovani hlavicky
          {
            $sloupce .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_header_{$tvar}"], $sloup[$i]);
          }

          $id = (!Empty($data->table_id) ? " id=\"{$data->table_id}\"" : "");
          $class = (!Empty($data->table_class) ? " class=\"{$data->table_class}\"" : "");
          $akce = (!Empty($data->table_akce) ? " {$data->table_akce}" : "");

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_begin_{$tvar}"],
                                              $data->nadpis,
                                              $id,
                                              $class,
                                              $akce,
                                              $sloupce);

          //generovani bunek
          if ($res1 = $this->query("SELECT
                                    radek,
                                    poradi,
                                    bunka_id,
                                    bunka_class,
                                    bunka_akce
                                    FROM {$this->dbpredpona}bunka
                                    WHERE hlavicka={$data->id}
                                    ORDER BY poradi ASC, id ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              $j = 0;
              while ($data1 = $this->fetchObject($res1))
              {
                $id = (!Empty($data1->bunka_id) ? " id=\"{$data1->bunka_id}\"" : "");
                $class = (!Empty($data1->bunka_class) ? " class=\"{$data1->bunka_class}\"" : "");
                $akce = (!Empty($data1->bunka_akce) ? " {$data1->bunka_akce}" : "");

                $radek = "";
                $rad = explode("|--|", $data1->radek);
                for ($i = 0; $i < count($rad); $i++)
                {
                  $radek .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_row_bunka_{$tvar}"],
                                                      (!Empty($rad[$i]) ? $rad[$i] : $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_row_bunka_empty_{$tvar}"])),
                                                      $i);
                }

                $ente = $this->NactiUnikatniObsah($this->unikatni["normal_table_ente_{$tvar}"], //prvni/posledni pro ente oznacovani
                                                  ($j == 0 ? $prvni : ""),
                                                  ($j == ($this->numRows($res1) - 1) ? $posledni : ""));

                //tridy pro kazdy radek TR
                $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_row_{$tvar}"],
                                                    $id,
                                                    $class,
                                                    $akce,
                                                    $radek,
                                                    ($j == 0 ? $prvni : ""),
                                                    ($j == ($this->numRows($res1) - 1) ? $posledni : ""),
                                                    (in_array($j, $ente_def_array) ? $ente_def : ""),
                                                    ((($j + $ente_od) % $ente_po) == 0 ? $ente : ""),
                                                    $j);
                $j++;
              }
            }
              else
            {
              $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_null_{$tvar}"], $poc_sloup);
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $text = $data->poznamka;
          $special = ($this->ZjistiTypDB() == "sqlite" ? html_entity_decode($text) : htmlspecialchars_decode(html_entity_decode($text)));

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_table_end_{$tvar}"],
                                              $this->PrevodUnikatnihoTextu($special,
                                                                          $this->absolutni_url)
                                              );
        }
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_empty_{$tvar}"]);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
          $result = $this->AdministraceObsahu();
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
    if ($res = $this->query("SELECT id, adresa FROM {$this->dbpredpona}hlavicka ORDER BY LOWER(adresa) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tabulky_begin"]);

        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tabulky"],
                                              $data->id,
                                              (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->adresa);
          ;
        }
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tabulky_end"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_tabulky_null"]);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
    if ($res = $this->query("SELECT COUNT(id) as pocet FROM {$this->dbpredpona}bunka WHERE hlavicka={$hlavicka};", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $result = $this->fetchObject($res)->pocet + $inc;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickych tabulek
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_obsah_addlink"],
                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab&amp;col={$this->min_col}") : ""),
                                        $this->AdminVypisTable());

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

          $sloupce = "";
          for ($i = 0; $i < $col; $i++)
          {
            $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addtab_input_sloupce"], $i + 1);
            $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addtab_input_defaultni"], $i + 1);
          }

          //$sloupce = str_repeat($this->NactiUnikatniObsah($this->unikatni["admin_addtab_input_sloupce"]), $col);
          //$defaultni = str_repeat($this->NactiUnikatniObsah($this->unikatni["admin_addtab_input_defaultni"]), $col);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addtab"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab&amp;col={$plus}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab&amp;col={$mimus}",
                                              $sloupce,
                                              "",//$defaultni,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                              $col);

          $adresa = $this->ChangeWrongChar($_POST["adresa"]);
          $nadpis = $this->ChangeWrongChar($_POST["nadpis"]);

          $poznamka = $this->ChangeWrongChar($_POST["poznamka"]);
          $table_id = $this->ChangeWrongChar($_POST["table_id"]);
          $table_class = $this->ChangeWrongChar($_POST["table_class"]);
          $table_akce = $this->ChangeWrongChar($_POST["table_akce"]);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              count($_POST) > 0 &&
              $this->povolit_pridani)
          {
            $sloupce = $this->ChangeWrongChar(implode("|--|", $_POST["sloupce"]));
            $defaultni = $this->ChangeWrongChar(implode("|--|", $_POST["defaultni"]));

            if ($this->queryExec("INSERT INTO {$this->dbpredpona}hlavicka (id, adresa, nadpis, sloupce, defaultni, poznamka, table_id, table_class, table_akce) VALUES
                                (NULL, '{$adresa}', '{$nadpis}', '{$sloupce}', '{$defaultni}', '{$poznamka}', '{$table_id}', '{$table_class}', '{$table_akce}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addtab_hlaska"], $adresa);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "edittab":
          $col = $_GET["col"];  //cislo sekce
          settype($col, "integer");

          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT adresa, nadpis, sloupce, defaultni, poznamka, table_id, table_class, table_akce FROM {$this->dbpredpona}hlavicka WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $col = ($col <= 0 || $col < $this->min_col || ($this->max_col > 0 ? $col > $this->max_col : false) ? $this->min_col : $col);  //osetreni spatnych vstupu

              $plus = ($this->max_col > 0 ? (($col + 1) <= $this->max_col ? $col + 1 : $col) : $col + 1);
              $mimus = (($col - 1) < $this->min_col ? $this->min_col : $col - 1); //osetreni zapornych cisel

              $sloupce = "";
              $sloup = explode("|--|", $data->sloupce);
              $def = explode("|--|", $data->defaultni);
              $rozdil = $col - count($sloup);
              for ($i = 0; $i < count($sloup) + $rozdil; $i++)
              {
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_edittab_input_sloupce"], $sloup[$i], $i + 1);
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_edittab_input_defaultni"], $def[$i], $i + 1);
              }

/*
              $defaultni = "";
              $def = explode("|--|", $data->defaultni);
              for ($i = 0; $i < count($def) + $rozdil; $i++)
              {
                $defaultni .= $this->NactiUnikatniObsah($this->unikatni["admin_edittab_input_defaultni"], $def[$i], $i);
              }
*/

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edittab"],
                                                  $data->adresa,
                                                  $data->nadpis,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;col={$plus}&amp;id={$id}",
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;col={$mimus}&amp;id={$id}",
                                                  $sloupce,
                                                  "",//$defaultni,
                                                  $data->poznamka,
                                                  $data->table_id,
                                                  $data->table_class,
                                                  $data->table_akce,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  $col);

              $adresa = $this->ChangeWrongChar($_POST["adresa"]);
              $nadpis = $this->ChangeWrongChar($_POST["nadpis"]);

              $poznamka = $this->ChangeWrongChar($_POST["poznamka"]);
              $table_id = $this->ChangeWrongChar($_POST["table_id"]);
              $table_class = $this->ChangeWrongChar($_POST["table_class"]);
              $table_akce = $this->ChangeWrongChar($_POST["table_akce"]);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  count($_POST) > 0 &&
                  $id != 0 &&
                  $this->povolit_pridani)
              {
                $sloupce = $this->ChangeWrongChar(implode("|--|", $_POST["sloupce"]));
                $defaultni = $this->ChangeWrongChar(implode("|--|", $_POST["defaultni"]));

                if ($this->queryExec ("UPDATE {$this->dbpredpona}hlavicka SET adresa='{$adresa}',
                                                                              nadpis='{$nadpis}',
                                                                              sloupce='{$sloupce}',
                                                                              defaultni='{$defaultni}',
                                                                              poznamka='{$poznamka}',
                                                                              table_id='{$table_id}',
                                                                              table_class='{$table_class}',
                                                                              table_akce='{$table_akce}'
                                                                              WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edittab_hlaska"], $adresa);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "deltab":
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = $this->query("SELECT adresa FROM {$this->dbpredpona}hlavicka WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}hlavicka WHERE id={$id};
                                    DELETE FROM {$this->dbpredpona}bunka WHERE hlavicka={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_deltab_hlaska"], $data->adresa);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "addrow":
          $tab = $_GET["tab"];  //cislo sekce
          settype($tab, "integer");

          if ($res = $this->query("SELECT sloupce, defaultni FROM {$this->dbpredpona}hlavicka WHERE id={$tab};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              //$sloupce = $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table_begin"]);
              $sloup = explode("|--|", $data->sloupce);
              $def = explode("|--|", $data->defaultni);
              for ($i = 0; $i < count($sloup); $i++)
              {
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table_header"], $sloup[$i], $i + 1);
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table"], $def[$i], $i + 1);
              }

/*
              $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table_newrow"]);
              $def = explode("|--|", $data->defaultni);
              for ($i = 0; $i < count($def); $i++)
              {
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table"], $def[$i]);
              }
              $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_addrow_table_end"]);
*/

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addrow"],
                                                  $this->VyberTabulky($tab),
                                                  $sloupce,
                                                  $this->PocetRadku($tab, 1),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  (!$this->povolit_pridani ? " readonly=\"readonly\"" : ""));
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          if (!Empty($_POST["tlacitko"]) &&
              count($_POST) > 0)
          {
            $hlavicka = $this->ChangeWrongChar($_POST["hlavicka"]);
            settype($hlavicka, "integer");
            $radek = $this->ChangeWrongChar(implode("|--|", $_POST["radek"]));
            $poradi = $this->ChangeWrongChar($_POST["poradi"]);
            settype($poradi, "integer");
            $bunka_id = $this->ChangeWrongChar($_POST["bunka_id"]);
            $bunka_class = $this->ChangeWrongChar($_POST["bunka_class"]);
            $bunka_akce = $this->ChangeWrongChar($_POST["bunka_akce"]);

            if ($this->queryExec("INSERT INTO {$this->dbpredpona}bunka (id, hlavicka, radek, poradi, bunka_id, bunka_class, bunka_akce) VALUES
                                 (NULL, {$hlavicka}, '{$radek}', {$poradi}, '{$bunka_id}', '{$bunka_class}', '{$bunka_akce}');", $error))
            {
              $rozdel = explode("|--|", $radek);
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addrow_hlaska"], $rozdel[0]);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editrow":
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT hlavicka, radek, poradi, bunka_id, bunka_class, bunka_akce FROM {$this->dbpredpona}bunka WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);
              $rad = explode("|--|", $data->radek);

              //generovan popisku
              if ($res1 = $this->query("SELECT sloupce FROM {$this->dbpredpona}hlavicka WHERE id={$data->hlavicka};", $error))
              {
                if ($this->numRows($res1) == 1)
                {
                  $data1 = $this->fetchObject($res1);

                  //$sloupce = $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table_begin"]);
                  $sloupce = "";
                  $sloup = explode("|--|", $data1->sloupce);
                  for ($i = 0; $i < count($sloup); $i++)
                  {
                    $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table_header"], $sloup[$i], $i + 1);
                    $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table"], $rad[$i], $i + 1);
                  }
                }
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }

/*
              //generovani obsahu
              $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table_newrow"]);
              $rad = explode("|--|", $data->radek);
              for ($i = 0; $i < count($sloup); $i++)
              {
                $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table"], $rad[$i]);
              }
              $sloupce .= $this->NactiUnikatniObsah($this->unikatni["admin_editrow_table_end"]);
*/

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editrow"],
                                                  $this->VyberTabulky($data->hlavicka),
                                                  $sloupce,
                                                  $data->poradi,
                                                  $data->bunka_id,
                                                  $data->bunka_class,
                                                  $data->bunka_akce,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  (!$this->povolit_pridani ? " readonly=\"readonly\"" : ""));
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          if (!Empty($_POST["tlacitko"]) &&
              count($_POST) > 0 &&
              $id != 0)
          {
            $hlavicka = $this->ChangeWrongChar($_POST["hlavicka"]);
            settype($hlavicka, "integer");
            $radek = $this->ChangeWrongChar(implode("|--|", $_POST["radek"]));
            $poradi = $this->ChangeWrongChar($_POST["poradi"]);
            settype($poradi, "integer");
            $bunka_id = $this->ChangeWrongChar($_POST["bunka_id"]);
            $bunka_class = $this->ChangeWrongChar($_POST["bunka_class"]);
            $bunka_akce = $this->ChangeWrongChar($_POST["bunka_akce"]);

            if ($this->queryExec("UPDATE {$this->dbpredpona}bunka SET hlavicka={$hlavicka},
                                                                      radek='{$radek}',
                                                                      poradi={$poradi},
                                                                      bunka_id='{$bunka_id}',
                                                                      bunka_class='{$bunka_class}',
                                                                      bunka_akce='{$bunka_akce}'
                                                                      WHERE id={$id};", $error))
            {
              $rozdel = explode("|--|", $radek);
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editrow_hlaska"], $rozdel[0]);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "delrow":
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT radek, poradi FROM {$this->dbpredpona}bunka WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}bunka WHERE id={$id};", $error)) //provedeni dotazu
              {
                $rozdel = explode("|--|", $data->radek);
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delrow_hlaska"], $rozdel[0], $data->poradi);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_begin"],
                                        $this->absolutni_url,
                                        $this->dirpath);

    if ($res = $this->query("SELECT id,
                            adresa,
                            nadpis,
                            sloupce,
                            defaultni,
                            poznamka
                            FROM {$this->dbpredpona}hlavicka
                            ORDER BY LOWER(adresa) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $sloupce = explode("|--|", $data->sloupce);
          $col = count($sloupce);

          $rows = "";
          if ($res1 = $this->query("SELECT id,
                                    radek,
                                    poradi
                                    FROM {$this->dbpredpona}bunka
                                    WHERE hlavicka={$data->id}
                                    ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $radky = explode("|--|", $data1->radek);

                $obsah = array ("array_args",
                                $data1->id,
                                $radky[0],
                                $data1->poradi,
                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editrow&amp;id={$data1->id}",
                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delrow&amp;id={$data1->id}");

                $radky = array_merge($obsah, $radky); //slouceni pole obsahu a pole radku

                $rows .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_bunka"],
                                                    $radky);
              }
            }
              else
            {
              $rows = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_bunka_null"]);
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $vypis = array ("array_args",
                          $data->id,
                          $data->adresa,
                          $data->nadpis,
                          $data->poznamka,
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addrow&amp;tab={$data->id}",
                          ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_adddel_link"],
                                                                              $data->nadpis,
                                                                              $data->adresa,
                                                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;col={$col}&amp;id={$data->id}",
                                                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deltab&amp;id={$data->id}") : ""),
                          $rows); //vlozeni radku do hlavicky

          $vypis = array_merge($vypis, $sloupce); //slouceni pole vypisu a pole sloupcu

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_hlavicka"],
                                              $vypis);
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_end"]);

    return $result;
  }
}
?>
