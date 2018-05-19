<?php

/**
 *
 * Blok administrace databaze
 *
 */

//verze modulu
define("v_DynamicDatabase", "1.51");

class DynamicDatabase extends DefaultModule
{
  private $var, $sqlite, $dirpath, $unikatni;
  public $idmodul = "admindb";  //id pro rozliseni modulu v adminu
  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php");
  public $generated = array(".history"); //soubory co generuje modul
  public $support = array(NODATA);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul
  public $convmeth = array();

  private $localpermit;

  private $historysep = "|-x-|";

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul);

      $this->namemodule = $this->unikatni["name_module"];

      $this->NastavKomunikaci($this->var, $index);  //pripojeni defaultu

      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                $this->idmodul));
    }
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
 * Zalohuje modul daneho indexu
 *
 * pouziti:
 * $sql = $this->var->main[0]->NactiFunkci("AdministraceDatabaze", "ZalohujDatabazi", 1);
 *
 * @param index index modulu
 * @return sql dotaz modulu
 */
  public function ZalohujDatabazi($index)
  {
    settype($index, "integer");

    $class = $this->var->moduly[$index]["class"];
    $base = $this->var->moduly[$index]["uloziste"];

    $this->NastavKomunikaci($this->var, $index);
    if (!$this->PripojeniDatabaze($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }
      else
    {
      $dbname = $this->DekodujText($this->var->mysql_dbname);
      $sql = ($base == "sqlite" ? "SELECT sql, name FROM sqlite_master WHERE type='table';" : "SHOW TABLES WHERE `Tables_in_{$dbname}` LIKE('{$class}_%')");
      $sqlname = "Tables_in_{$dbname}";
      if ($res = $this->query($sql))
      {
        if ($this->numRows($res) != 0)
        {
          $dotaz = "";
          while ($data = $this->fetchObject($res)) //cele generovani exportu
          {
            $name = ($base == "sqlite" ? $data->name : $data->$sqlname);

            $create = "";
            switch ($base)  //vytvoreni create dotazu
            {
              default:
              case "sqlite":
                $create = $data->sql;
              break;

              case "mysqli":
                if ($res2 = $this->query("SHOW CREATE TABLE {$name}"))
                {
                  if ($this->numRows($res2) == 1)
                  {
                    $column = "Create Table";
                    $create = $this->fetchObject($res2)->$column;
                  }
                }
              break;
            }

            $dotaz .= "\n-------------------- table:{$name}\n\n{$create};\n\n";

            //sloupce
            if ($res1 = $this->query("SELECT * FROM {$name} LIMIT 0,1;"))
            {
              if ($this->numRows($res1) != 0)
              {
                $sloupce = array_keys($this->fetch($res1, "ASSOC"));  //vezme klice, zahodi obsah

                $sloup = implode(", ", $sloupce);
              }
            }

            //data
            if ($res1 = $this->query("SELECT * FROM {$name};"))
            {
              if ($this->numRows($res1) != 0)
              {
                while ($data1 = $this->fetchObject($res1))
                {
                  $obsah =  "";
                  for ($i = 0; $i < count($sloupce); $i++)
                  {
                    $obsah .=
                    "'{$data1->$sloupce[$i]}', ";
                  }
                  $obsah = substr($obsah, 0, -2);

                  $dotaz .=
                  "INSERT INTO {$name} ({$sloup}) VALUES ({$obsah});\n";
                }
              }
            }
          }
        }
      }
    }

    return $dotaz;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace databaze
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        $this->AdminVypisObsahu());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "info":  //vypis tabulek
          $index = $_GET["index"];
          settype($index, "integer");

          $class = $this->var->moduly[$index]["class"];
          $base = $this->var->moduly[$index]["uloziste"];
          if (!Empty($class))
          {
            $this->NastavKomunikaci($this->var, $index);
            if (!$this->PripojeniDatabaze($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
              else
            {
              $dbname = $this->DekodujText($this->var->mysql_dbname);
              $sql = ($base == "sqlite" ? "SELECT name FROM sqlite_master WHERE type='table';" : "SHOW TABLES WHERE `Tables_in_{$dbname}` LIKE('{$class}_%')");
              $sqlname = "Tables_in_{$dbname}";

              if ($res = $this->queryMultiObjectSingle($sql))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_info_hlavicka_begin"],
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                    $class,
                                                    ($this->localpermit[$_GET[$this->var->get_idmodul]]["sqlquery"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=sqlquery&amp;index={$index}" : ""),
                                                    ($this->localpermit[$_GET[$this->var->get_idmodul]]["export"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=export&amp;out=sqlite&amp;index={$index}" : ""),
                                                    ($this->localpermit[$_GET[$this->var->get_idmodul]]["export"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=export&amp;out=mysqli&amp;index={$index}" : ""),
                                                    ($this->localpermit[$_GET[$this->var->get_idmodul]]["import"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=import&amp;index={$index}" : ""));

                foreach ($res as $data)
                {
                  $name = ($base == "sqlite" ? $data->name : $data->$sqlname);  //zjisti nazev tabulky
                  $pocet = $this->querySingle("SELECT COUNT(id) FROM {$name}"); //zjisti pocet zaznamu v tabulce

                  $result .= $this->NactiUnikatniObsah($this->unikatni["admin_info_hlavicka"],
                                                      ($this->localpermit[$_GET[$this->var->get_idmodul]]["show"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=show&amp;table={$name}&amp;index={$index}" : ""),
                                                      ($this->localpermit[$_GET[$this->var->get_idmodul]]["struct"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=struct&amp;table={$name}&amp;index={$index}" : ""),
                                                      $name,
                                                      $pocet);
                }

                $result .= $this->unikatni["admin_info_hlavicka_end"];
              }
            }
          }
        break;

        case "show":  //zobrazeni obsahu
          $index = $_GET["index"];
          settype($index, "integer");
          $table = $_GET["table"];

          $base = $this->var->moduly[$index]["uloziste"];
          if (!Empty($base) && !Empty($table))
          {
            $this->NastavKomunikaci($this->var, $index);
            if (!$this->PripojeniDatabaze($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
              else
            {
              $checksmall = (!Empty($_GET["small"]));
              $checksmall = (!isset($_GET["small"]) ? true : $checksmall);  //defaultni hodnota
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_show_hlavicka"],
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  ($this->localpermit[$_GET[$this->var->get_idmodul]]["info"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}" : ""),
                                                  ($this->localpermit[$_GET[$this->var->get_idmodul]]["struct"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=struct&amp;table={$table}&amp;index={$index}" : ""),
                                                  $this->var->moduly[$index]["class"],
                                                  $table,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=show&amp;table={$table}&amp;index={$index}&amp;small=".(!$checksmall ? 1 : 0),
                                                  ($checksmall ? " checked=\"checked\"" : ""),
                                                  $this->dirpath, //8
                                                  $this->AjaxJQueryKonverze(NULL, array("value", "roz")));

              if ($res = $this->query("SELECT * FROM {$table};"))
              {
                if ($this->numRows($res) != 0)
                {
                  //vykresleni hlavicky tabulky
                  if ($sloupce = $this->GetColumnTable($table, null, $error))
                  {
                    $result .= $this->unikatni["admin_show_begin_table"];

                    foreach ($sloupce as $polozka)
                    {
                      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_header"], $polozka);
                    }

                    $result .= $this->unikatni["admin_show_end_header"];
                  }
                    else
                  {
                    $this->ErrorMsg($error, array(__LINE__, __METHOD__));
                  }

                  //vygenerovani telicko tabulky
                  while ($data = $this->fetchObject($res))
                  {
                    $result .= $this->unikatni["admin_show_begin_body"];

                    foreach ($sloupce as $polozka)
                    {
                      $hodnota = ($base == "mysqli" ? $this->ChangeWrongChar($data->$polozka, false) : $data->$polozka);
                      $small = $this->ZkraceniTextu($hodnota, $this->unikatni["admin_show_small_count"], $this->unikatni["admin_show_small_char"]);

                      if ($polozka == "id") //id celeho radku
                      {
                        $idrow = $data->id;
                      }

                      $cellid = "{$idrow}-{$polozka}";  //slozeni id polozky na radku
                      $stav = ($checksmall ? 1 : 0);
                      $value = ($checksmall ? $small : $hodnota);

                      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_body"],
                                                          $value,
                                                          ($polozka != "id" ? " ondblclick=\"EditCell({$index}, '{$table}', {$idrow}, '{$polozka}', {$stav}, '{$value}', '#{$cellid}');\"" : ""),
                                                          $cellid,
                                                          $hodnota);
                    }

                    $result .= $this->unikatni["admin_show_end_body"];
                  }

                  $result .= $this->unikatni["admin_show_end_table"];
                }
                  else
                {
                  //pri prazdnem obsahu vypise alespon hlavicku tabulky
                  if ($sloupce = $this->GetColumnTable($table, null))
                  {
                    $result .= $this->unikatni["admin_show_begin_empty_table"];

                    foreach ($sloupce as $polozka)
                    {
                      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_empty_header"],
                                                          $polozka);
                    }

                    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_end_empty_table"],
                                                        count($sloupce));
                  }
                }
              }
            }
          }
        break;

        case "struct":  //zobrazeni struktury dat
          $index = $_GET["index"];
          settype($index, "integer");
          $table = $_GET["table"];

          if (!Empty($this->var->moduly[$index]["uloziste"]))
          {
            $this->NastavKomunikaci($this->var, $index);
            if (!$this->PripojeniDatabaze($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
              else
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_struct_hlavicka"],
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  ($this->localpermit[$_GET[$this->var->get_idmodul]]["info"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}" : ""),
                                                  ($this->localpermit[$_GET[$this->var->get_idmodul]]["show"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=show&amp;table={$table}&amp;index={$index}" : ""),
                                                  $this->var->moduly[$index]["class"],
                                                  $table);

              //vykresleni hlavicky tabulky
              if ($sloupce = $this->GetColumnTable($table, true))
              {
                $result .= $this->unikatni["admin_struct_begin"];

                foreach ($sloupce as $polozka)
                {
                  $name = $polozka[0];  //definovane vzdy pevne
                  $typ = $polozka[1];
                  $flags = $this->NactiUnikatniObsah($this->unikatni["admin_struct_flags"],
                                                    (in_array("unsigned", $polozka, false) ? $this->unikatni["admin_struct_flags_unsigned"] : ""),
                                                    (in_array("zerofill", $polozka) ? $this->unikatni["admin_struct_flags_zerofill"] : ""),
                                                    (in_array("character", $polozka) ? $this->unikatni["admin_struct_flags_binary"] : ""));
                  $pk = (in_array("primary", $polozka) ? " checked=\"checked\"" : "");
                  $ai = (in_array("auto_increment", $polozka) ? " checked=\"checked\"" : "");

                  $result .= $this->NactiUnikatniObsah($this->unikatni["admin_struct"],
                                                      $name,
                                                      $typ,
                                                      $flags,
                                                      $pk,
                                                      $ai);
                }

                $result .= $this->unikatni["admin_struct_end"];
              }
            }
          }
        break;

        case "sqlquery":  //sql dotaz do databaze
          $index = $_GET["index"];
          settype($index, "integer");

          $checksmallhist = (!Empty($_GET["smallhist"]));
          $checksmallhist = (!isset($_GET["smallhist"]) ? true : $checksmallhist);  //defaultni hodnota

          if (!Empty($this->var->moduly[$index]["uloziste"]))
          {
            $this->NastavKomunikaci($this->var, $index);
            if (!$this->PripojeniDatabaze($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
              else
            {
              $small = (!Empty($_POST["small"]));
              $dotaz = stripslashes(htmlspecialchars($this->NotEmpty("post", "dotaz"), ENT_COMPAT, "UTF-8"));

              $ret = "";
              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($_POST["dotaz"]))
              {
                $this->AddHistory($dotaz, $this->var->moduly[$index]["class"]);
                $dotaz = html_entity_decode($dotaz, NULL, "UTF-8");

                $error = true;
                if ($data = $this->queryMultiArraySingle($dotaz, $error))
                {
                  if (count($data) > 0) //min 1 radek
                  {
                    $key = array_keys($data[0]);  //vybere klice z [0] indexu
                    $ret = $this->NactiUnikatniObsah($this->unikatni["admin_sqlquery_ret_table_begin"],
                                                    $dotaz,
                                                    count($data),
                                                    $this->numChanges());

                    //vykresleni hlavicky tabulky
                    foreach ($key as $hlavicka)
                    {
                      $ret .= $this->NactiUnikatniObsah($this->unikatni["admin_sqlquery_ret_hlavicka"],
                                                        $hlavicka);
                    }

                    $ret .= $this->unikatni["admin_sqlquery_ret_hlavicka_end"];

                    foreach ($data as $polozky)
                    {
                      $ret .= $this->unikatni["admin_sqlquery_ret_telicko_begin"];
                      //vykresleni radku tabulky
                      foreach ($polozky as $hodnota)
                      {
                        $ret .= $this->NactiUnikatniObsah($this->unikatni["admin_sqlquery_ret_telicko"],
                                                          ($small ? $this->ZkraceniTextu($hodnota, $this->unikatni["admin_sqlquery_small_count"], $this->unikatni["admin_sqlquery_small_char"]) : $hodnota));
                      }

                      $ret .= $this->unikatni["admin_sqlquery_ret_telicko_end"];
                    }

                    $ret .= $this->unikatni["admin_sqlquery_ret_table_end"];
                  }
                }
                  else
                {
                  if (!Empty($error))
                  {
                    $ret = $this->NactiUnikatniObsah($this->unikatni["admin_sqlquery_ret_error"],
                                                    $error);
                  }
                    else
                  {
                    $ret = $this->NactiUnikatniObsah($this->unikatni["admin_sqlquery_ret_null"],
                                                    $this->numChanges());
                  }
                }
              }

              //vygenerovani seznamu tabulek
              $tab = array();
              foreach ($this->GetTable() as $tabulka)
              {
                $tab[] = $this->NactiUnikatniObsah($this->unikatni["admin_sqlquery_available_table"],
                                                  $tabulka);
              }

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_sqlquery"],
                                                  $this->dirpath,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}",
                                                  $this->var->moduly[$index]["class"],
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=sqlquery&amp;index={$index}&amp;smallhist=".(!$checksmallhist ? 1 : 0),
                                                  ($checksmallhist ? " checked=\"checked\"" : ""),  //5
                                                  $this->ListHistory($checksmallhist, $this->var->moduly[$index]["class"]), //prepinani small / full
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=clearhist&amp;index={$index}",
                                                  implode("", $tab),
                                                  $dotaz,
                                                  ($small ? " checked=\"checked\"" : ""),
                                                  $ret);
            }
          }
        break;

        case "clearhist": //vymazani sql historie
          $index = $_GET["index"];
          settype($index, "integer");

          if (!Empty($this->var->moduly[$index]["uloziste"]))
          {
            $cesta = "{$this->dirpath}/{$this->generated[0]}_{$this->var->moduly[$index]["class"]}";
            if (file_exists($cesta))
            {
              if (@unlink($cesta))
              {
                $result = $this->Hlaska("del", "Byla smazána historie dotazů pro tuto třídu");
                $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=sqlquery&amp;index={$index}");  //auto kliknuti
              }
            }
          }
        break;

        case "export":  //export DB
          $index = $_GET["index"];
          settype($index, "integer");

          if (!Empty($this->var->moduly[$index]["uloziste"]))
          {
            $out = $_GET["out"];

            $class = $this->var->moduly[$index]["class"];
            $base = $this->var->moduly[$index]["uloziste"];

            $dodatek = ($out == "mysqli" && $base != "mysqli" ? strtolower($class)."_" : "");

            $this->NastavKomunikaci($this->var, $index);
            if (!$this->PripojeniDatabaze($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
              else
            {
              $dbname = $this->DekodujText($this->var->mysql_dbname);
              $sql = ($base == "sqlite" ? "SELECT sql, name FROM sqlite_master WHERE type='table';" : "SHOW TABLES WHERE `Tables_in_{$dbname}` LIKE('{$class}_%')");
              $sqlname = "Tables_in_{$dbname}";
              if ($res = $this->query($sql, $error))
              {
                if ($this->numRows($res) != 0)
                {
                  $dotaz = "";
                  while ($data = $this->fetchObject($res)) //cele generovani exportu
                  {
                    $name = ($base == "sqlite" ? $data->name : $data->$sqlname);

                    $create = "";
                    switch ($base)  //vytvoreni create dotazu
                    {
                      default:
                      case "sqlite":
                        $create = $data->sql;
                        if (!Empty($dodatek)) //kdyz se upgrade: sqlite->mysqli
                        {
                          $create = str_replace("CREATE TABLE {$name}",
                                                "CREATE TABLE {$dodatek}{$name}",
                                                $create);
                        }
                      break;

                      case "mysqli":
                        if ($res2 = $this->query("SHOW CREATE TABLE {$name}", $error))
                        {
                          if ($this->numRows($res2) == 1)
                          {
                            $column = "Create Table";
                            $create = "{$this->fetchObject($res2)->$column}";

                            if ($out == "sqlite") //kdyz se degraduje: mysqli->sqlite
                            {
                              $arrnewname = explode("_", $name);  //rozdeli
                              $newname = implode("_", array_splice($arrnewname, 1, count($arrnewname)));  //odstrani 1. index
                              $create = str_replace(array("`", "NOT NULL", "default NULL", "collate utf8_czech_ci", "ENGINE=MyISAM", "AUTO_INCREMENT=", "DEFAULT CHARSET=utf8", "COLLATE=utf8_czech_ci", $name),
                                                    array("", "", "", "", "", "", "", "", $newname),
                                                    $create);
                            }
                          }
                        }
                          else
                        {
                          $this->ErrorMsg($error, array(__LINE__, __METHOD__));
                        }
                      break;
                    }

                    //jmena databaze
                    if ($out == "sqlite" && $base == "mysqli")
                    {
                      $arrnewname = explode("_", $name);
                      $newname = implode("_", array_splice($arrnewname, 1, count($arrnewname)));
                    }
                      else
                    {
                      $newname = "{$dodatek}{$name}";
                    }

                    $dotaz .= "\n-------------------- table:{$newname}\n\n{$create};\n\n";

                    //sloupce
                    if ($res1 = $this->query("SELECT * FROM {$name} LIMIT 0,1;", $error))
                    {
                      if ($this->numRows($res1) != 0)
                      {
                        $sloupce = array_keys($this->fetch($res1, "ASSOC"));  //vezme klice, zahodi obsah

                        $sloup = implode(", ", $sloupce);
                      }
                    }
                      else
                    {
                      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
                    }

                    //data
                    if ($res1 = $this->query("SELECT * FROM {$name};", $error))
                    {
                      if ($this->numRows($res1) != 0)
                      {
                        while ($data1 = $this->fetchObject($res1))
                        {
                          $obsah =  "";
                          for ($i = 0; $i < count($sloupce); $i++)
                          {
                            $obsah[] = "'{$data1->$sloupce[$i]}'";
                          }
                          //$obsah = substr($obsah, 0, -2);
                          $obsah = implode(", ", $obsah);

                          $dotaz .=
                          "INSERT INTO {$newname} ({$sloup}) VALUES ({$obsah});\n";
                        }
                      }
                    }
                      else
                    {
                      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
                    }
                  }
                }
              }
                else
              {
                $this->ErrorMsg($error, array(__LINE__, __METHOD__));
              }

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_export"],
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  ($this->localpermit[$_GET[$this->var->get_idmodul]]["info"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}" : ""),
                                                  $this->var->moduly[$index]["class"],
                                                  $out,
                                                  $dotaz);
            }
          }
        break;

        case "import":  //import DB
          $index = $_GET["index"];
          settype($index, "integer");

          if (!Empty($this->var->moduly[$index]["uloziste"]))
          {
            $class = $this->var->moduly[$index]["class"];

            $this->NastavKomunikaci($this->var, $index);
            if (!$this->PripojeniDatabaze($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
              else
            {
              $dotaz = stripslashes(htmlspecialchars($this->NotEmpty("post", "dotaz"), ENT_COMPAT, "UTF-8"));
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_import"],
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                  ($this->localpermit[$_GET[$this->var->get_idmodul]]["info"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}" : ""),
                                                  $class,
                                                  $dotaz);

              if (!Empty($_POST["tlacitko_import"]) &&
                  !Empty($dotaz))
              {
                if ($this->queryExec($dotaz, $error))
                {
                  $result = $this->Hlaska("info", "Databáze byla importována");

                  $this->AutoClick(5, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&co=info&index={$index}");  //auto kliknuti
                }
                  else
                {
                  $this->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              }
            }
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Pridava sql dotaz do historie
 *
 * @param sql zadany sql dotaz
 */
  private function AddHistory($sql, $trida)
  {
    // datum|dotaz|pocet
    $dotaz = $this->ChangeWrongChar($sql);
    $datum = date("Y-m-d H:i:s");

    $result = "";
    $cesta = "{$this->dirpath}/{$this->generated[0]}_{$trida}";
    if (file_exists($cesta))
    {
      if ($u = @fopen($cesta, "r"))
      {
        if (filesize($cesta) > 0)
        {
          $data = explode($this->historysep, fread($u, filesize($cesta)));
          fclose($u);

          $count = array_count_values($data); //spocitani
          $new = array($datum, $dotaz, $count[$dotaz] + 1); //novy radek
          $write = array_merge($data, $new);  //slouceni nactenych a novych dat

          $u = fopen($cesta, "w");
          fwrite($u, implode($this->historysep, $write)); //kazdy dalsi
          fclose($u);
        }
      }
    }
      else
    {
      if ($u = @fopen($cesta, "w"))
      {
        $write = array($datum, $dotaz, 1);
        fwrite($u, implode($this->historysep, $write));
        fclose($u);
      }
    }

    return $result;
  }

/**
 *
 * Vypisuje historii sql dotazu
 *
 * @param mini zapina mini/full zobrazeni, def=true
 * @return vypis historie
 */
  private function ListHistory($mini = true, $trida)
  {
    $result = "";
    $cesta = "{$this->dirpath}/{$this->generated[0]}_{$trida}";
    if ($u = @fopen($cesta, "r"))
    {
      $data = explode($this->historysep, fread($u, (filesize($cesta) == 0 ? 1 : filesize($cesta))));
      fclose($u);

      //rozdeleni pole do trojcich
      $index = 0;
      $pole = array();
      foreach ($data as $i => $polozka)
      {
        switch ($i % 3) //rozdeleni poli podle modulo
        {
          case 0:
            $pole[$index][] = $polozka; //datum
          break;

          case 1:
            $pole[$index][] = $polozka;//html_entity_decode($polozka, NULL, "UTF-8"); //sql dotaz
            $minipole[] = $polozka;//html_entity_decode($polozka, NULL, "UTF-8");
          break;

          case 2:
            $pole[$index][] = $polozka; //poradi
            $index++;
          break;
        }
      }

      if (is_array($minipole))  //pokud je pole pusti vypisy
      {
        //samotny vypis
        if ($mini &&
            is_array($minipole))
        { //mini vypis
          foreach (array_count_values($minipole) as $polozka => $pocet)
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_small_history"],
                                                $polozka,
                                                base64_encode($polozka),
                                                $pocet);
          }
        }
          else
        { //full vypis
          foreach ($pole as $polozky)
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_full_history"],
                                                date($this->unikatni["admin_vypis_full_datum"], strtotime($polozky[0])),
                                                $polozky[1],
                                                base64_encode($polozky[1]),
                                                $polozky[2]);
          }
        }
      }
        else
      {
        $result = $this->unikatni["admin_vypis_history_null"];
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_history_null"];
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
    //prochazeni a vypis modulu
    foreach ($this->var->moduly as $index => $modul)
    {
      $class = $modul["class"];
      $databaze = $modul["databaze"];
      $path = dirname($modul["include"]);
      $uloziste = $modul["uloziste"];
      $mysqli = ($uloziste == "mysqli" ? ".mysqli" : "");

      $velikost = 0;
      switch ($uloziste)
      {
        case "sqlite":
          $velikost = $this->Velikost(@filesize("{$path}/{$databaze}{$mysqli}"));
        break;

        case "mysqli":
          $size = 0;
          $trida = strtolower($class);
          $this->NastavKomunikaci($this->var, $index);
          if (!$this->PripojeniDatabaze($error))
          {
            $this->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
            else
          {
            if ($res = $this->queryMultiObjectSingle("SHOW TABLE STATUS LIKE '{$trida}_%';", $error))
            {
              foreach ($res as $data)
              {
                $size += $data->Data_length + $data->Index_length;
              }
            }
              else
            {
              if (!Empty($error))
              {
                $this->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }

          $velikost = $this->Velikost($size);
        break;
      }

      $datum = "- / -";
      if (file_exists("{$path}/{$databaze}{$mysqli}"))
      {
        $datum = date($this->unikatni["admin_tvar_datum"], @filemtime("{$path}/{$databaze}{$mysqli}"));
      }

      if (!Empty($modul["databaze"]))
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["info"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}" : ""),
                                            $class,
                                            $velikost,
                                            $datum,
                                            $uloziste);
      }
    }

    return $result;
  }


}
?>
