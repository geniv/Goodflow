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
  private $var;
  private $sqlite;
  //private $dbname;
  private $idmodul = "admindb";  //id pro rozliseni modulu v adminu
  //private $dirpath;
  //private $defprvni = false;  //brat defaultne prvni polozku
  //private $vypis_chybu = false;

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

    $adresa_menu = array( array("main_href" => "{$this->idmodul}",
                                "odkaz" => "administrace databaze",
                                "title" => " - administrace databaze",
                                "id" => "",
                                "class" => "",
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
 * Interne volana funkce pro zobrazovani administrace databaze
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result =
    "administrace databaze<br />
    <br />
    {$this->AdminVypisObsahu()}<br />";

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

            $result =
            "
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}\">zpět na výpis tříd</a><br />
            Tabulky třídy <strong>{$class}</strong>:<br />
            ";

            if ($res = @$this->sqlite->query("SELECT name FROM sqlite_master WHERE type='table';", NULL, $error))
            {
              if ($res->numRows() != 0)
              {
                while ($data = $res->fetchObject())
                {
                  $result .=
                  "
                  <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=show&amp;table={$data->name}&amp;index={$index}\">{$data->name}</a>
                  <br />
                  ";
                }

                $result .=
                "<br />
                (<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=export&amp;index={$index}\">export DB</a>
                <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=import&amp;index={$index}\">import DB</a>)
                ";
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

            $result =
            "
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}\">zpět na výpis tříd</a><br />
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}\">zpět na podrobnosti třídy</a><br />
            Obsah tabulky <strong>{$table}</strong>:<br />
            ";

            if ($res = @$this->sqlite->query("SELECT * FROM {$table};", NULL, $error))
            {
              if ($res->numRows() != 0)
              {
                //vykresleni hlavicky
                if ($res1 = @$this->sqlite->query("SELECT * FROM {$table} LIMIT 0,1;", NULL, $error))
                {
                  if ($res1->numRows() != 0)
                  {
                    $sloupce = array_keys($res1->fetch());  //vezme klice, zahodi obsah

                    $result .=
                    "
                    <table border=\"1\">
                      <tr>
                    ";

                    for ($i = 0; $i < count($sloupce); $i++)
                    {
                      $result .=
                      "
                        <th>{$sloupce[$i]}</th>
                      ";
                    }

                    $result .=
                    "
                      </tr>
                    ";
                  }
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error);
                }

                while ($data = $res->fetchObject())
                {
                  $result .=
                  "
                  <tr>
                  ";

                  for ($i = 0; $i < count($sloupce); $i++)
                  {
                    $result .=
                    "
                      <td>{$data->$sloupce[$i]}</td>
                    ";
                  }

                  $result .=
                  "
                  </tr>
                  ";
                }

                $result .=
                "
                </table>
                ";
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

            $result =
            "
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}\">zpět na výpis tříd</a><br />
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}\">zpět na podrobnosti třídy</a><br />
            SQL dotraz třídy <strong>{$class}</strong>:<br />
            <textarea rows=\"10\" cols=\"100\">{$dotaz}</textarea>
            ";
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

            $result =
            "
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}\">zpět na výpis tříd</a><br />
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$index}\">zpět na podrobnosti třídy</a><br />
            SQL dotraz:<br />
            <form method=\"post\">
              <fieldset>
                <textarea name=\"dotaz\" rows=\"10\" cols=\"100\">{$dotaz}</textarea><br />
                <input type=\"submit\" name=\"tlacitko\" value=\"impotrovat...\" />
              </fieldset>
            </form>
            ";

            if (!Empty($_POST["tlacitko"]) &&
                !Empty($dotaz))
            {
              if (@$this->sqlite->queryExec($dotaz, $error))
              {
                $result =
                "
                  imporotváno...
                ";

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
        $result .=
        "
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&amp;co=info&amp;index={$i}\">{$class}</a> ({$velikost}) {$datum}<br />
        ";
      }
    }

    return $result;
  }
}
?>
