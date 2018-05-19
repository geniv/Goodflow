<?php

/**
 *
 * Blok dynamicky generovaneho obsahu
 *
 * public funkce:\n
 * construct: DynamicCyklObsah - hlavni konstruktor tridy\n
 * CyklObsah() - hlavni vypis obsahu, podle adresy a nebo podle daneho parametru\n
 * RSSVystup() - vypise link pro RSS vystup\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicCyklObsah extends DefaultModule
{
  private $var;
  private $sqlite;
  private $dbname;  //jmeno db se ziska z promenne.php
  private $idmodul = "cyklobsah";
  private $dirpath;

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
                                "odkaz" => "administrace cyklického obsahu",
                                "title" => " - administrace cyklického obsahu",
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
      if (!@$this->sqlite->queryExec("CREATE TABLE cyklicky_obsah (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      datum DATETIME,
                                      text TEXT);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Navraceni samotneho generovaneho textu dle dane adresy
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicCyklObsah", "CyklObsah", "nekde_nekde");</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return vystupni text
 */
  public function CyklObsah($adr = NULL)
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
    if ($res = @$this->sqlite->query("SELECT datum, text FROM cyklicky_obsah
                                      WHERE adresa='{$adresa}'
                                      ORDER BY cyklicky_obsah.datum DESC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $datum = date("j.n. Y", strtotime($data->datum));

          $result .= "<p>{$datum} - {$data->text}</p>";
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
 * Generuje rss link do html hlavicky (head)
 *
 * @return head link
 */
  public function RSSLink()
  {
    $result =
    "<link type=\"application/rss+xml\" rel=\"alternate\" href=\"?{$this->var->get_kam}=rss\" title=\"Novinky\" />
    ";

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
          $result = $this->AdministraceLangObsahu();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Overuje jestli existuje polozda v DB
 *
 * @param nazev nazev sekce
 * @param zanoreni cislo zanoreni sekce
 * @return true/false - existuje / neexistuje
 */
  private function ExistujePolozka($adresa)
  {
    if ($res = @$this->sqlite->query("SELECT id FROM cyklicky_obsah WHERE adresa='{$adresa}';", NULL, $error))
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
 * Interne volana funkce pro zobrazovani administrace dynamickeho menu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceLangObsahu()
  {
    $result =
    "administrace cyklického obsahu
    <br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add\" title=\"\">přidat položku</a><br />
    <br />
    {$this->AdminVypisObsah()}
    ";

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
              adresa: <input type=\"text\" name=\"adresa\" /><br />
              datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s")."\" /><br />
              text: <input type=\"text\" name=\"text\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ";

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
          $text = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($datum) &&
              !Empty($text))
          {
            if (@$this->sqlite->queryExec("INSERT INTO cyklicky_obsah (id, adresa, datum, text) VALUES
                                          (NULL, '{$adresa}', '{$datum}', '{$text}');", $error))
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

        case "edit":  //editace
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, datum, text FROM cyklicky_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"{$data->adresa}\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s", strtotime(stripslashes($data->datum)))."\" /><br />
                  text: <input type=\"text\" name=\"text\" value=\"{$data->text}\" /><br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
              $text = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($datum) &&
                  !Empty($text) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec ("UPDATE cyklicky_obsah SET adresa='{$adresa}',
                                                                          datum='{$datum}',
                                                                          text='{$text}'
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

        case "del": //rekurzivni mazani
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa FROM cyklicky_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM cyklicky_obsah WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazáno: '{$data->adresa}'
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
 * Vypis administrace menu
 *
 * @return vypis menu v html
 */
  private function AdminVypisObsah()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa, datum, text FROM cyklicky_obsah ORDER BY LOWER(adresa) ASC, cyklicky_obsah.datum DESC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $datum = date("j.n. Y H:i:s", strtotime($data->datum));

          $result .=
          "{$data->adresa} ({$data->id}) '{$datum}'<p>{$data->text}</p>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}\" title=\"\">upravit obsah</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->adresa}\' ?');\">smazat obsah</a> <br />
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
