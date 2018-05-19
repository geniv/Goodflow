<?php

/**
 *
 * Blok prepinani bloku zdrojaku podle adresy
 *
 * public funkce:\n
 * construct: PrepinaniPodleSekci - hlavni konstruktor tridy\n
 * Prepinani() - hlavni vypis prepnani podle url, pri zadan parametru zvoli primo kod\n
 * AdminObsah() - obsah adminu\n
 *
 */

class PrepinaniPodleSekci extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $absolutni_url, $unikatni;
  public $idmodul = "prepinanisekci";  //id modulu

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

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $this->Instalace();

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
          $result = $this->AdministracePrepinani();
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
      if (!@$this->sqlite->queryExec("CREATE TABLE prepinani (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      kod TEXT);", $error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
  }

/**
 *
 * Prepinani samotneho kodu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("PrepinaniPodleSekci", "Prepinani"[, "nejaka_adresa", true, array("dalsi text a nebo funkce")]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @param kontrola true/false - zapinani nebo vypinani kontroly specialnich znaku
 * @param pridavek pridavny obsah co se da vlozit do textu, ve tvaru @@XX@@
 * @return vygenerovany obsah
 */
  public function Prepinani($adr = NULL, $kontrola = true, $pridavek = NULL)
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
    if ($res = @$this->sqlite->query("SELECT kod FROM prepinani WHERE adresa='{$adresa}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $doplnek = array("array_args",
                          $this->absolutni_url);

        $dalsi = "";
        if (!Empty($pridavek))
        {
          for ($i = 0; $i < count($pridavek); $i++)
          {
            $dalsi[] = $pridavek[$i]; //naplneni pole pro doplnkove %% parametry
          }
        }

        if (!Empty($dalsi)) //pokud je pridavek pouzit
        {
          $doplnek = array_merge($doplnek, $dalsi); //slouceni pole
        }

        $result = $this->PrevodUnikatnihoTextu(($kontrola ? htmlspecialchars_decode(html_entity_decode($res->fetchObject()->kod, ENT_QUOTES)) : $res->fetchObject()->kod), $doplnek);
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
 * Overeni jestli dana url jiz neexstuje
 *
 * @param adresa vstupni adresa pro kontrolu
 * @return true/false - existuje / neexistuje
 */
  private function ExistujeAdresa($adresa)
  {
    //$adresa = stripslashes(htmlspecialchars($adresa, ENT_QUOTES));
    if ($res = @$this->sqlite->query("SELECT id FROM prepinani WHERE adresa='{$adresa}';", NULL, $error))
    {
      $result = ($res->numRows() == 1 ? true : false);
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace prepnani kodu
 *
 * @return adminstracni formular v html
 */
  private function AdministracePrepinani()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add",
                                        $this->AdminVypisPrepinani());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $kod = stripslashes(htmlspecialchars($_POST["kod"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($kod) &&
              !$this->ExistujeAdresa($adresa))  //+kontrola duplicity
          {
            if (@$this->sqlite->queryExec("INSERT INTO prepinani (id, adresa, kod) VALUES
                                          (NULL, '{$adresa}', '{$kod}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_hlaska"], $adresa);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "edit":  //editace
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, kod FROM prepinani WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit"],
                                                  $data->adresa,
                                                  $data->kod,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $kod = stripslashes(htmlspecialchars($_POST["kod"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($kod) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE prepinani SET adresa='{$adresa}',
                                                                    kod='{$kod}'
                                                                    WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_hlaska"], $adresa);

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

        case "del": //rekurzivni mazani
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa FROM prepinani WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM prepinani WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_hlaska"],
                                                    $data->adresa);

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
 * Vypis administrace prepnani
 *
 * @return vypis prepnani v html
 */
  private function AdminVypisPrepinani()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa, kod FROM prepinani ORDER BY id ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                              $data->id,
                                              $data->adresa,
                                              $data->kod,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}");
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }
}
?>
