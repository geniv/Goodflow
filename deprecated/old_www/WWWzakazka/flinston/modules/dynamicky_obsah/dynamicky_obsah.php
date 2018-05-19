<?php

/**
 *
 * Blok dynamicky generovaneho obsahu
 *
 * public funkce:\n
 * construct: DynamicObsah - hlavni konstruktor tridy\n
 * DynamickyObsah() - hlavni vypis obsahu\n
 * PridejSmazStranku() - funkce pridava a maze z externich modulu obsah stranek\n
 * AdminMenu() - odkaz na admin obsahu\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicObsah
{
  private $var;
  private $sqlite;
  private $dbname;// = ".dbdynobsah.sqlite2";
  private $idmodul = "dynobsah";  //id pro rozliseni modulu v adminu
  private $dirpath;
  private $defprvni = false;  //brat defaultne prvni polozku
  private $vypis_chybu = false;

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
 * Administracni menu
 *
 * @return admin menu
 */
  public function AdminMenu()
  {
    $result =
    "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\">administrace dynamickeho obsahu</a><br />";

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
 * Instalace SQLite databaze
 *
 */
  private function Instalace()
  {
    if (filesize("{$this->dirpath}/{$this->dbname}") == 0)
    {
      if (!@$this->sqlite->queryExec("CREATE TABLE dynamicky_obsah (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      text TEXT);", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Zjisti prvni polozku v databazi
 *
 * @return adresu prvni polozky
 */
  private function PrvniPolozka()
  {
    if ($res = @$this->sqlite->query("SELECT adresa FROM dynamicky_obsah ORDER BY LOWER(adresa) ASC LIMIT 0,1;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->adresa;
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
 * Generovani samotneho obsahu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah"[, "nejaka_adresa"]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @return vygenerovany obsah
 */
  public function DynamickyObsah($adr = NULL)
  {
    if (!Empty($adr)) //$adresa = (!Empty($_GET[$this->var->get_kam]) ? $_GET[$this->var->get_kam] : $this->PrvniPolozka());
    {
      $adresa = $adr;
    }
      else
    {
      if ($this->defprvni)  //defaultne prvni a nebo z url
      {
        $adresa = $this->PrvniPolozka();
      }
        else
      {
        $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
      }
    }

    $result = "";
    if ($res = @$this->sqlite->query("SELECT text
                                      FROM dynamicky_obsah
                                      WHERE adresa='{$adresa}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = htmlspecialchars_decode(html_entity_decode($res->fetchObject()->text)); //pripadne prepisovac specialni syntaxe a v editoru ajax zobrazovani
      }
        else
      {
        if ($this->vypis_chybu)
        {
          $result = "zadaná adresa neexistuje";
        }
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
 * Externi odkaz do dalsich modulu, kontroluje se s existenci adresy v DB
 *
 * @param cesta cesta k obsahu
 * @return odkaz nebo zprava
 */
  public function PridejSmazStranku($cesta)
  {
    $result = ($this->ExistujeOdkaz($cesta) ? "Již existuje obsah <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deladress&amp;adresa={$cesta}\" onclick=\"return confirm('Opravdu smazat  adresu: \'{$cesta}\' ?');\">Odstranit obsah</a>" :
    "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add&amp;adresa={$cesta}\">Přidej obsah</a>");

    return $result;
  }

/**
 *
 * Externe volana funkce pri smazani polozky v menu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "SmazStranku");</strong>
 *
 * @param cesta adresy ktere byly smazany
 * @return vypis obsahu v html
 */
  public function SmazStranku($cesta)
  {
    if (!@$this->sqlite->queryExec("DELETE FROM dynamicky_obsah WHERE adresa='{$cesta}';", $error)) //provedeni dotazu
    {
      $this->var->main[0]->ErrorMsg($error);
    }
  }

/**
 *
 * Overeni existence odkazu
 *
 * @param cesta ceska k obsahu
 * @return true/false - existuje / neexistuje
 */
  private function ExistujeOdkaz($cesta)
  {
    $adresa = $cesta;

    if (!Empty($adresa))
    {
      if ($res = @$this->sqlite->query("SELECT id FROM dynamicky_obsah WHERE adresa='{$adresa}';", NULL, $error))
      {
        $result = ($res->numRows() == 1 ? true : false);
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickeho obsahu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result =
    "administrace dynamickeho obsahu<br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add\" title=\"\">přidej obsah</a>
    <br />
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
              adresa: <input type=\"input\" name=\"adresa\" value=\"{$_GET["adresa"]}\" /> <br />
              obsah: <textarea name=\"text\"></textarea> <br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" />
            </fieldset>
          </form>
          ";

          $obsah = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));
          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($obsah) &&
              !$this->ExistujeOdkaz($adresa))
          {
            if (@$this->sqlite->queryExec("INSERT INTO dynamicky_obsah (id, adresa, text) VALUES
                                          (NULL, '{$adresa}', '{$obsah}');", $error))
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

        case "edit":  //uprava
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, text FROM dynamicky_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"input\" name=\"adresa\" value=\"{$data->adresa}\" /> <br />
                  obsah: <textarea name=\"text\">{$data->text}</textarea> <br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $obsah = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($obsah) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE dynamicky_obsah SET adresa='{$adresa}',
                                                                          text='{$obsah}'
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

        case "del": //mazani podle id
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa FROM dynamicky_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM dynamicky_obsah WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazána adresa: '{$data->adresa}'.
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

        case "deladress": //mazani podle adresy
          $adresa = $_GET["adresa"];

          if ($res = @$this->sqlite->query("SELECT adresa FROM dynamicky_obsah WHERE adresa='{$adresa}';", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM dynamicky_obsah WHERE adresa='{$adresa}';", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazána adresa: '{$adresa}'.
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
 * Vypis administrace obsahu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisObsahu()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa, text FROM dynamicky_obsah ORDER BY adresa ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
<pre id=\"vypis_admin\">
{$data->text}
</pre>
<p>
adresa: {$data->adresa}

<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}\" title=\"\">uprav sekci</a>
<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat adresu: \'{$data->adresa}\' ?');\">smazat sekci</a>
</p>
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
