<?php

/**
 *
 * Blok multilanguage obsahu
 *
 * public funkce:\n
 * construct: DynamicEshopMenu - hlavni konstruktor tridy\n
 * LangObsah() - hlavni vypis obsahu, podle adresy a nebo podle daneho parametru\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicLanguageObsah extends DefaultModule
{
  private $var;
  private $sqlite;
  private $dbname;// = ".dbdynlangobsah.sqlite2";
  private $idmodul = "langobsah";
  private $dirpath;

/**
 *
 * Konstruktor menu
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
                                "odkaz" => "administrace multilanguage obsahu",
                                "title" => " - administrace multilanguage obsahu",
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
      if (!@$this->sqlite->queryExec("CREATE TABLE dynamcky_lang_obsah (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      jazyk INTEGER UNSIGNED,
                                      text TEXT);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Navraceni samotneho textu dle dane adresy a zvoleneho jazyku
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicLanguageObsah", "LangObsah", "neco_nekde");</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return vystupni text
 */
  public function LangObsah($adr = NULL)
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
    if ($res = @$this->sqlite->query("SELECT text FROM dynamcky_lang_obsah WHERE adresa='{$adresa}' AND jazyk={$jazyk};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = htmlspecialchars_decode($res->fetchObject()->text);
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
    if ($res = @$this->sqlite->query("SELECT id FROM dynamcky_lang_obsah WHERE adresa='{$adresa}';", NULL, $error))
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
    "administrace multilanguage obsahu
    <br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add\" title=\"\">přidat obsah</a><br />
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
              text: <input type=\"text\" name=\"text\" /><br />
              {$select}<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ";

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $text = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));
          $jazyk = $_POST["jazyk"];

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($jazyk) &&
              !Empty($text)) // && !$this->ExistujePolozka($adresa)
          {
            if (@$this->sqlite->queryExec("INSERT INTO dynamcky_lang_obsah (id, adresa, jazyk, text) VALUES
                                          (NULL, '{$adresa}', {$jazyk}, '{$text}');", $error))
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

          if ($res = @$this->sqlite->query("SELECT adresa, jazyk, text FROM dynamcky_lang_obsah WHERE id={$id};", NULL, $error))
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
                  text: <input type=\"text\" name=\"text\" value=\"{$data->text}\" /><br />
                  {$select}
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $text = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));
              $jazyk = $_POST["jazyk"];

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($jazyk) &&
                  !Empty($text) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE dynamcky_lang_obsah SET adresa='{$adresa}',
                                                                              jazyk={$jazyk},
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

          if ($res = @$this->sqlite->query("SELECT adresa FROM dynamcky_lang_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM dynamcky_lang_obsah WHERE id={$id};", $error)) //provedeni dotazu
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
    if ($res = @$this->sqlite->query("SELECT id, adresa, jazyk, text FROM dynamcky_lang_obsah ORDER BY LOWER(adresa) ASC, jazyk ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $zkratka = $this->var->main[0]->NactiFunkci("DynamicLanguage", "ZkratkaPodleId", $data->jazyk);

          $result .=
          "{$data->adresa} ({$data->id}) {$zkratka} <p>{$data->text}</p>
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
