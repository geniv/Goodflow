<?php

/**
 *
 * Blok dynamicky generovaneho obsahu
 *
 * public funkce:\n
 * construct: DynamicLanguageCyklObsah - hlavni konstruktor tridy\n
 * LangCyklObsah() - hlavni vypis obsahu, podle adresy a nebo podle daneho parametru\n
 * RSSVystup() - vypise link pro RSS vystup\n
 * AdminMenu() - odkaz na admin obsahu\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicLanguageCyklObsah
{
  private $var;
  private $sqlite;
  private $dbname;  //jmeno db se ziska z promenne.php
  private $idmodul = "langcyklobsah";
  private $dirpath;

  private $rsslink = "rss";

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
      if (!@$this->sqlite->queryExec("CREATE TABLE cyklicky_lang_obsah (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      jazyk INTEGER UNSIGNED,
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
 * Navraceni samotneho generovaneho textu dle dane adresy a zvoleneho jazyku
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "LangCyklObsah", "nekde_nekde");</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return vystupni text
 */
  public function LangCyklObsah($adr = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
    }

    $jazyk = $this->var->main[0]->NactiFunkci("DynamicLanguage", "ZvolenyJazyk");

    $result = "";
    if ($res = @$this->sqlite->query("SELECT datum, text FROM cyklicky_lang_obsah
                                      WHERE adresa='{$adresa}' AND jazyk={$jazyk}
                                      ORDER BY cyklicky_lang_obsah.datum DESC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $datum = date("j.n.Y", strtotime($data->datum));

          $result .=
          "
                    <dl>
                      <dt>
                        <em>
                          {$datum}
                          <span>-</span>
                        </em>
                      </dt>
                      <dd>
                        {$data->text}
                      </dd>
                    </dl>
          ";
        }
      }
        else
      {
        $result = "špatná adresa";
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
 * pouziti: <strong>$rss = $this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "RSSLink");</strong>
 *
 * @return head link
 */
  public function RSSLink()
  {
    $mutace = $this->var->main[0]->NactiFunkci("DynamicLanguage", "MutaceJazyka");
    $pole = array_keys($mutace);  //navrat klicu

    $result = "";
    for ($i = 0; $i < count($pole); $i++)
    {
      $result .=
      "<link type=\"application/rss+xml\" rel=\"alternate\" href=\"".($this->var->htaccess ? "{$this->rsslink}/{$mutace[$pole[$i]]}" : "?{$this->var->get_kam}={$this->rsslink}&amp;jazyk={$pole[$i]}")."\" title=\"Novnky, jazyk: {$mutace[$pole[$i]]}\" />\n";
    }

    return $result;
  }

/**
 *
 * Administracni menu
 *
 * @return admin menu
 */
  public function AdminMenu()
  {
    $result =
    "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\">administrace multilanguage cyklického obsahu</a><br />";

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
    if ($res = @$this->sqlite->query("SELECT id FROM cyklicky_lang_obsah WHERE adresa='{$adresa}';", NULL, $error))
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
    "administrace multilanguage cyklického obsahu
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
          $select = $this->var->main[0]->NactiFunkci("DynamicLanguage", "VyberJazyka");

          $result =
          "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" /><br />
              datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s")."\" /><br />
              text: <input type=\"text\" name=\"text\" /><br />
              {$select}<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ";

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
          $text = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));
          $jazyk = $_POST["jazyk"];

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($datum) &&
              !Empty($jazyk) &&
              !Empty($text)) // && !$this->ExistujePolozka($adresa)
          {
            if (@$this->sqlite->queryExec("INSERT INTO cyklicky_lang_obsah (id, adresa, jazyk, datum, text) VALUES
                                          (NULL, '{$adresa}', {$jazyk}, '{$datum}', '{$text}');", $error))
            {
              $jazyk = $this->var->main[0]->NactiFunkci("DynamicLanguage", "JazykPodleId", $jazyk);

              $result =
              "
                přídána: {$adresa} do jazyku: {$jazyk}
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

          if ($res = @$this->sqlite->query("SELECT adresa, jazyk, datum, text FROM cyklicky_lang_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $select = $this->var->main[0]->NactiFunkci("DynamicLanguage", "VyberJazyka", $data->jazyk);

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"{$data->adresa}\" /><br />
                  datum: <input type=\"text\" name=\"datum\" value=\"".date("j.n.Y H:i:s", strtotime(stripslashes($data->datum)))."\" /><br />
                  text: <input type=\"text\" name=\"text\" value=\"{$data->text}\" /><br />
                  {$select}<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
              $text = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));
              $jazyk = $_POST["jazyk"];

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($datum) &&
                  !Empty($jazyk) &&
                  !Empty($text) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE cyklicky_lang_obsah SET adresa='{$adresa}',
                                                                              jazyk={$jazyk},
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

          if ($res = @$this->sqlite->query("SELECT adresa, jazyk FROM cyklicky_lang_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM cyklicky_lang_obsah WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazáno: '{$data->adresa}', jazyk: {$data->jazyk}
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
    if ($res = @$this->sqlite->query("SELECT id, adresa, jazyk, datum, text FROM cyklicky_lang_obsah ORDER BY LOWER(adresa) ASC, jazyk ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          //$exter_add = $this->var->main[0]->NactiFunkci(2, "PridejSmazStranku", $this->UpravaStoupani($data->id));
          $zkratka = $this->var->main[0]->NactiFunkci("DynamicLanguage", "ZkratkaPodleId", $data->jazyk);
          $datum = date("j.n. Y H:i:s", strtotime($data->datum));

          $result .=
          "{$data->adresa} ({$data->id}) {$zkratka} '{$datum}'<p>{$data->text}</p>
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
