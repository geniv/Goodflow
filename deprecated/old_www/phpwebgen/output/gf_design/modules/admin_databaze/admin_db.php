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
  private $idmodul = "admindb";  //id pro rozliseni modulu v adminu

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
 * Interne volana funkce pro zobrazovani administrace databaze
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"], $this->AdminVypisObsahu());

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

          if (file_exists("{$path}/{$databaze}"))
          {
            if (!$this->sqlite = @new SQLiteDatabase("{$path}/{$databaze}", 0777, $error))
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $class = $this->var->moduly[$index]["class"];

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_info_hlavicka"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}",
                                                $class);

            if ($res = @$this->sqlite->query("SELECT name FROM sqlite_master WHERE type='table';", NULL, $error))
            {
              if ($res->numRows() != 0)
              {
                while ($data = $res->fetchObject())
                {
                  $result .= $this->NactiUnikatniObsah($this->unikatni["admin_info_vypis"],
                                                      "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=show&amp;table={$data->name}&amp;index={$index}",
                                                      $data->name);
                }

                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_info_dodatek"],
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=export&amp;index={$index}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=import&amp;index={$index}");
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }
          }
        break;

        case "show":  //zobrazeni obsahu
          $index = $_GET["index"];
          settype($index, "integer");

          $table = $_GET["table"];

          $databaze = $this->var->moduly[$index]["databaze"];
          $path = dirname($this->var->moduly[$index]["include"]);

          if (file_exists("{$path}/{$databaze}"))
          {
            if (!$this->sqlite = @new SQLiteDatabase("{$path}/{$databaze}", 0777, $error))
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_show_hlavicka"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}",
                                                $table);

            if ($res = @$this->sqlite->query("SELECT * FROM {$table};", NULL, $error))
            {
              if ($res->numRows() != 0)
              {
                //vykresleni hlavicky tabulky
                if ($res1 = @$this->sqlite->query("SELECT * FROM {$table} LIMIT 0,1;", NULL, $error))
                {
                  if ($res1->numRows() != 0)
                  {
                    $sloupce = array_keys($res1->fetch());  //vezme klice, zahodi obsah

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
                  $this->var->main[0]->ErrorMsg($error);
                }

                //vygenerovani telicka tabulky
                while ($data = $res->fetchObject())
                {
                  $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_begin_body"]);

                  for ($i = 0; $i < count($sloupce); $i++)
                  {
                    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_body"], $data->$sloupce[$i]);
                    ;
                  }

                  $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_end_body"]);
                }

                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_show_end_table"]);
              }
                else
              {
                $result .= "Prázdná tabulka";
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }
          }
        break;

        case "export":  //export DB
          $index = $_GET["index"];
          settype($index, "integer");

          $databaze = $this->var->moduly[$index]["databaze"];
          $path = dirname($this->var->moduly[$index]["include"]);

          if (file_exists("{$path}/{$databaze}"))
          {
            if (!$this->sqlite = @new SQLiteDatabase("{$path}/{$databaze}", 0777, $error))
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            if ($res = @$this->sqlite->query("SELECT sql, name FROM sqlite_master WHERE type='table';", NULL, $error))
            {
              if ($res->numRows() != 0)
              {
                $dotaz = "";
                while ($data = $res->fetchObject()) //cele generovani exportu
                {
                  $dotaz .=
                  "DROP TABLE {$data->name};\n{$data->sql};\n"; //vymazani tabulky + create

                  //sloupce
                  if ($res1 = @$this->sqlite->query("SELECT * FROM {$data->name} LIMIT 0,1;", NULL, $error))
                  {
                    if ($res1->numRows() != 0)
                    {
                      $sloupce = array_keys($res1->fetch());  //vezme klice, zahodi obsah

                      $sloup = "";
                      for ($i = 0; $i < count($sloupce); $i++)
                      {
                        $sloup .=
                        "{$sloupce[$i]}, ";
                      }

                      $sloup = substr($sloup, 0, -2);
                    }
                  }
                    else
                  {
                    $this->var->main[0]->ErrorMsg($error);
                  }

                  //data
                  if ($res1 = @$this->sqlite->query("SELECT * FROM {$data->name};", NULL, $error))
                  {
                    if ($res1->numRows() != 0)
                    {
                      while ($data1 = $res1->fetchObject())
                      {
                        $obsah =  "";
                        for ($i = 0; $i < count($sloupce); $i++)
                        {
                          $obsah .=
                          "'{$data1->$sloupce[$i]}', ";
                        }
                        $obsah = substr($obsah, 0, -2);

                        $dotaz .=
                        "INSERT INTO {$data->name} ({$sloup}) VALUES ({$obsah});\n";
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

            $class = $this->var->moduly[$index]["class"];

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_export"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}",
                                                $class,
                                                $dotaz);
          }
        break;

        case "import":  //import DB
          $index = $_GET["index"];
          settype($index, "integer");

          $databaze = $this->var->moduly[$index]["databaze"];
          $path = dirname($this->var->moduly[$index]["include"]);

          if (file_exists("{$path}/{$databaze}"))
          {
            if (!$this->sqlite = @new SQLiteDatabase("{$path}/{$databaze}", 0777, $error))
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $dotaz = stripslashes(htmlspecialchars($_POST["dotaz"])); //' neprevadi do # podoby

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_import"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}",
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}",
                                                $dotaz);

            if (!Empty($_POST["tlacitko"]) &&
                !Empty($dotaz))
            {
              if (@$this->sqlite->queryExec($dotaz, $error))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_import_exec"]);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&co=info&index={$index}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error);
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

      $velikost = $this->var->main[0]->NactiFunkci("Funkce", "Velikost", filesize("{$path}/{$databaze}"));
      $datum = date("d.m.Y / H:i:s", filemtime("{$path}/{$databaze}"));

      if (!Empty($this->var->moduly[$i]["databaze"]))
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$i}",
                                            $class,
                                            $velikost,
                                            $datum);
      }
    }

    return $result;
  }
}
?>
