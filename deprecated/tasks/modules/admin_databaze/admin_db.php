<?php

/**
 *
 * Blok administrace databaze
 *
 * public funkce:\n
 * construct: AdministraceDatabaze - hlavni konstruktor tridy\n
 * AdminObsah() - obsah adminu\n
 *
 */

class AdministraceDatabaze extends DefaultModule
{
  private $var, $sqlite, $dirpath, $unikatni;
  public $idmodul = "admindb";  //id pro rozliseni modulu v adminu
  public $mount = array("");

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

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");

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
 * Zalohuje modul daneho indexu
 *
 * pouziti: <strong>$sql = $this->var->main[0]->NactiFunkci("AdministraceDatabaze", "ZalohujDatabazi", 1);</strong>
 *
 * @param index index modulu
 * @return sql dotaz modulu
 */
  public function ZalohujDatabazi($index)
  {
    settype($index, "integer");

    $databaze = $this->var->moduly[$index]["databaze"];
    $path = dirname($this->var->moduly[$index]["include"]);
    $class = $this->var->moduly[$index]["class"];
    $base = $this->var->moduly[$index]["uloziste"];

    $this->NastavKomunikaci($this->var, $index);
    //$base, $class, "{$path}/{$databaze}");
    if (!$this->PripojeniDatabaze($error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }
      else
    {
      $dbname = $this->var->main[0]->DekodujText($this->var->mysql_dbname);
      $sql = ($base == "sqlite" ? "SELECT sql, name FROM sqlite_master WHERE type='table';" : "SHOW TABLES WHERE `Tables_in_{$dbname}` LIKE('{$class}_%')");
      $sqlname = "Tables_in_{$dbname}";
      if ($res = @$this->query($sql, $error))
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
                if ($res2 = @$this->query("SHOW CREATE TABLE {$name}", $error))
                {
                  if ($this->numRows($res2) == 1)
                  {
                    $column = "Create Table";
                    $create = $this->fetchObject($res2)->$column;
                  }
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              break;
            }

            $dotaz .= "\n-------------------- table:{$name}\n\n{$create};\n\n";

            //sloupce
            if ($res1 = @$this->query("SELECT * FROM {$name} LIMIT 0,1;", $error))
            {
              if ($this->numRows($res1) != 0)
              {
                $sloupce = array_keys($this->fetch($res1, "ASSOC"));  //vezme klice, zahodi obsah

                $sloup = implode(", ", $sloupce);
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }

            //data
            if ($res1 = @$this->query("SELECT * FROM {$name};", $error))
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

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "info":  //vypis tabulek
          $index = $_GET["index"];
          settype($index, "integer");

          $databaze = $this->var->moduly[$index]["databaze"];
          $path = dirname($this->var->moduly[$index]["include"]);
          $class = $this->var->moduly[$index]["class"];
          $base = $this->var->moduly[$index]["uloziste"];

          $this->NastavKomunikaci($this->var, $index);
          //$base, $class, "{$path}/{$databaze}");
          if (!$this->PripojeniDatabaze($error))
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
            else
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_info_hlavicka"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                $class);

            $dbname = $this->var->main[0]->DekodujText($this->var->mysql_dbname);
            $sql = ($base == "sqlite" ? "SELECT name FROM sqlite_master WHERE type='table';" : "SHOW TABLES WHERE `Tables_in_{$dbname}` LIKE('{$class}_%')");
            $sqlname = "Tables_in_{$dbname}";

            if ($res = @$this->query($sql, $error))
            {
              if ($this->numRows($res) != 0)
              {
                while ($data = $this->fetchObject($res))
                {
                  $name = ($base == "sqlite" ? $data->name : $data->$sqlname);

                  $result .= $this->NactiUnikatniObsah($this->unikatni["admin_info_vypis"],
                                                      "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=show&amp;table={$name}&amp;index={$index}",
                                                      $name);
                }

                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_info_dodatek"],
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=export&amp;out=sqlite&amp;index={$index}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=export&amp;out=mysqli&amp;index={$index}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=import&amp;index={$index}");
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "show":  //zobrazeni obsahu
          $index = $_GET["index"];
          settype($index, "integer");
          $table = $_GET["table"];

          $databaze = $this->var->moduly[$index]["databaze"];
          $path = dirname($this->var->moduly[$index]["include"]);
          $class = $this->var->moduly[$index]["class"];
          $base = $this->var->moduly[$index]["uloziste"];

          $this->NastavKomunikaci($this->var, $index);
          //$base, $class, "{$path}/{$databaze}");
          if (!$this->PripojeniDatabaze($error))
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
            else
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_show_hlavicka"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}",
                                                $table);

            if ($res = @$this->query("SELECT * FROM {$table};", $error))
            {
              if ($this->numRows($res) != 0)
              {
                //vykresleni hlavicky tabulky
                if ($res1 = @$this->query("SELECT * FROM {$table} LIMIT 0,1;", $error))
                {
                  if ($this->numRows($res1) != 0)
                  {
                    $sloupce = array_keys($this->fetch($res1, "ASSOC"));  //vezme klice, zahodi obsah

                    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_begin_table"]);

                    for ($i = 0; $i < count($sloupce); $i++)
                    {
                      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_header"], $sloupce[$i]);
                    }

                    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_end_header"]);
                  }
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                }

                //vygenerovani telicka tabulky
                while ($data = $this->fetchObject($res))
                {
                  $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_begin_body"]);

                  for ($i = 0; $i < count($sloupce); $i++)
                  {
                    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_body"], ($base == "mysqli" ? $this->ChangeWrongChar($data->$sloupce[$i], false) : $data->$sloupce[$i]));
                  }

                  $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_end_body"]);
                }

                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_end_table"]);
              }
                else
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_empty_table"]);
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "export":  //export DB
          $index = $_GET["index"];
          settype($index, "integer");

          $out = $_GET["out"];

          $databaze = $this->var->moduly[$index]["databaze"];
          $path = dirname($this->var->moduly[$index]["include"]);
          $class = $this->var->moduly[$index]["class"];
          $base = $this->var->moduly[$index]["uloziste"];

          $dodatek = ($out == "mysqli" && $base != "mysqli" ? strtolower($class)."_" : "");

          $this->NastavKomunikaci($this->var, $index);
          //$base, $class, "{$path}/{$databaze}");
          if (!$this->PripojeniDatabaze($error))
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
            else
          {
            $dbname = $this->var->main[0]->DekodujText($this->var->mysql_dbname);
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
                      if ($res2 = @$this->query("SHOW CREATE TABLE {$name}", $error))
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
                        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
                  if ($res1 = @$this->query("SELECT * FROM {$name} LIMIT 0,1;", $error))
                  {
                    if ($this->numRows($res1) != 0)
                    {
                      $sloupce = array_keys($this->fetch($res1, "ASSOC"));  //vezme klice, zahodi obsah

                      $sloup = implode(", ", $sloupce);
                    }
                  }
                    else
                  {
                    $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                  }

                  //data
                  if ($res1 = @$this->query("SELECT * FROM {$name};", $error))
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
                    $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                  }
                }
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_export"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}",
                                                $this->var->moduly[$index]["class"],
                                                $dotaz);
          }
        break;

        case "import":  //import DB
          $index = $_GET["index"];
          settype($index, "integer");

          $databaze = $this->var->moduly[$index]["databaze"];
          $path = dirname($this->var->moduly[$index]["include"]);
          $class = $this->var->moduly[$index]["class"];
          $base = $this->var->moduly[$index]["uloziste"];

          $this->NastavKomunikaci($this->var, $index);
          //$base, $class, "{$path}/{$databaze}");
          if (!$this->PripojeniDatabaze($error))
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
            else
          {
            $dotaz = stripslashes(htmlspecialchars($_POST["dotaz"], ENT_COMPAT, "UTF-8"));
            //$this->ChangeWrongChar($_POST["dotaz"], false); //' neprevadi do # podoby

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_import"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}",
                                                $class,
                                                $dotaz);

            if (!Empty($_POST["tlacitko_import"]) &&
                !Empty($dotaz))
            {
              if ($this->queryExec($dotaz, $error))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_import_exec"],
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}");

                $this->var->main[0]->AutoClick(5, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&co=info&index={$index}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
 * Vypis administrace obsahu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisObsahu()
  {
    $result = "";
    for ($i = 0; $i < count($this->var->moduly); $i++)
    {
      $class = $this->var->moduly[$i]["class"];

      $databaze = $this->var->moduly[$i]["databaze"];
      $path = dirname($this->var->moduly[$i]["include"]);
      $uloziste = $this->var->moduly[$i]["uloziste"];

      $mysqli = ($uloziste == "mysqli" ? ".mysqli" : "");

      switch ($uloziste)
      {
        case "sqlite":
          $velikost = $this->var->main[0]->Velikost(@filesize("{$path}/{$databaze}{$mysqli}"));
        break;

        case "mysqli":
          $trida = strtolower($class);
          $this->NastavKomunikaci($this->var, $i);
          //$uloziste, $class, "");
          if (!$this->PripojeniDatabaze($error))
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
            else
          {
            if ($res = $this->query("SHOW TABLE STATUS LIKE '{$trida}_%';", $error))
            {
              $size = 0;
              if ($this->numRows($res) != 0)
              {
                while ($data = $this->fetchObject($res)) //cele generovani exportu
                {
                  $size += $data->Data_length+$data->Index_length;
                }
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }

          $velikost = $this->var->main[0]->Velikost($size);
        break;
      }

      $datum = "- / -";
      if (file_exists("{$path}/{$databaze}{$mysqli}"))
      {
        $datum = date("d.m.Y / H:i:s", @filemtime("{$path}/{$databaze}{$mysqli}"));
      }

      if (!Empty($this->var->moduly[$i]["databaze"]))
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$i}",
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
