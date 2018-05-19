<?php

/**
 *
 * Blok dynamicky generovanych jazyku
 *
 * public funkce:\n
 * construct: DynamicLanguage - hlavni konstruktor tridy\n
 * SeznamJazyku() - hlavni vypis jazyku ve strankach\n
 * VyberJazyka() - vyber jazyka do ostatnch modulu, s nepovinnym parametrem id\n
 * MutaceJazyka() - vracene polezek jazyka v poli [index] = zkratka\n
 * PrevodTextoveAdresy() - prevede zkratku jazyka na id v DB\n
 * ZvolenyJazyk() - vypise cislo zvoleneho jazyku\n
 * AdminObsah() - obsah adminu\n
 * PrvniPolozka() - vrati cislo prvni defaultni polozky\n
 * JazykPodleId() - vrati nazev jazyka podle daneho id\n
 * ZkratkaPodleId() - vrati nazev zkratky podle daneho id\n
 * ZkratkaPodleZvolenehoJazyka() - vrati zkratku jazyka dle aktualni volby v cookie\n
 *
 */

class DynamicLanguage extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $absolutni_url, $unikatni;
  private $idmodul = "language";
  private $ozn_jazyk_l = "[";
  private $ozn_jazyk_r = "]";
  private $ozn_jazyk_class = "_aktivni";

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

    $this->ozn_jazyk_l = $this->NactiUnikatniObsah($this->unikatni["set_ozn_jazyk_l"]);
    $this->ozn_jazyk_r = $this->NactiUnikatniObsah($this->unikatni["set_ozn_jazyk_r"]);
    $this->ozn_jazyk_class = $this->NactiUnikatniObsah($this->unikatni["set_ozn_jazyk_class"]);

    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $this->Instalace();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"], $this->idmodul));
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
      if (!@$this->sqlite->queryExec("CREATE TABLE jazyk (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      jazyk VARCHAR(100),
                                      zkratka VARCHAR(10));
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Vrati cislo prvni polozky
 *
 * pouziti: <strong>$cislo = $this->var->main[0]->NactiFunkci("DynamicLanguage", "PrvniPolozka");</strong>
 *
 * @return cislo prvni polozky
 */
  public function PrvniPolozka()
  {
    $result = 0;
    if ($res = @$this->sqlite->query("SELECT id FROM jazyk ORDER BY LOWER(zkratka) ASC LIMIT 0,1;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->id;
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
 * Vraci cislo aktualnho zvoleneho jazyku
 *
 * pouziti: <strong>$cislo = $this->var->main[0]->NactiFunkci("DynamicLanguage", "ZvolenyJazyk");</strong>
 *
 * @return cislo aktualniho jazyku
 */
  public function ZvolenyJazyk()
  {
    $jaz = $_COOKIE["LANG"];
    if (!Empty($jaz))
    {
      $result = $jaz;
    }
      else
    {
      $result = $this->PrvniPolozka();
    }
    settype($result, "integer");

    return $result;
  }

/**
 *
 * Vrati zkratku dle aktualniho zvoleneho jazyka
 *
 * pouziti: <strong>$zkratka = $this->var->main[0]->NactiFunkci("DynamicLanguage", "ZkratkaPodleZvolenehoJazyka");</strong>
 *
 * @return zkratka jazyka dle nastaveneho jazyka
 */
  public function ZkratkaPodleZvolenehoJazyka()
  {
    $result = $this->ZkratkaPodleId($this->ZvolenyJazyk());

    return $result;
  }

/**
 *
 * Prevede textouvou reprezentaci adresy na index v DB
 *
 * pouziti: <strong>$cislo = $this->var->main[0]->NactiFunkci("DynamicLanguage", "PrevodTextoveAdresy", $_GET["jazyk"]);</strong>
 *
 * @param zkraka textova zkratka jazyka
 * @return cislo jazyku
 */
  public function PrevodTextoveAdresy($zkratka)
  {
    $result = 0;
    if ($res = @$this->sqlite->query("SELECT id FROM jazyk WHERE zkratka='{$zkratka}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->id;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    settype($result, "integer");

    return $result;
  }

/**
 *
 * Generovani samotneho menu, vystup v: $_COOKIE["LANG"]
 *
 * pouziti: <strong>$jazyky = $this->var->main[0]->NactiFunkci("DynamicLanguage", "SeznamJazyku");</strong>
 *
 * @param tvar cislo tvaru
 * @return vygenerovane menu
 */
  public function SeznamJazyku($tvar = 1)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, jazyk, zkratka FROM jazyk ORDER BY LOWER(zkratka) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $podm = (!Empty($_COOKIE["LANG"]) && $_COOKIE["LANG"] == $data->id ? true : (Empty($_COOKIE["LANG"]) && $this->PrvniPolozka() == $data->id ? true : false));

          $ozn_class = ($podm ? $this->ozn_jazyk_class : "");
          $ozn_l = ($podm ? $this->ozn_jazyk_l : "");
          $ozn_r = ($podm ? $this->ozn_jazyk_r : "");

          $url = ($this->var->htaccess ? $this->NactiUnikatniObsah($this->unikatni["rewrite_url_seznam_jazyku_{$tvar}"],
                                                                  $this->absolutni_url,
                                                                  $data->zkratka)
                                      : "?{$this->var->get_submenu}=changelang&amp;id={$data->id}");

          $result .= (!$podm ? $this->NactiUnikatniObsah($this->unikatni["normal_seznam_jazyku_{$tvar}"],
                                                        $url,
                                                        $data->jazyk,
                                                        $data->zkratka,
                                                        $ozn_l,
                                                        $ozn_r,
                                                        $ozn_class) :

                              $this->NactiUnikatniObsah($this->unikatni["normal_sezam_jazyku_nohref_{$tvar}"],
                                                        $url,
                                                        $data->jazyk,
                                                        $data->zkratka,
                                                        $ozn_l,
                                                        $ozn_r,
                                                        $ozn_class));
        }
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_seznam_jazyku_null_{$tvar}"]);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    if (!Empty($_GET[$this->var->get_submenu]) && //pod htaccess neuklada do cookies
        $_GET[$this->var->get_submenu] == "changelang")
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_seznam_jazyku_changelang_{$tvar}"]);

      $id = ($this->var->htaccess ? $this->PrevodTextoveAdresy($_GET["id"]) : $_GET["id"]);
      settype($id, "integer");

      if ($id != 0)
      {
        SetCookie("LANG", $id, Time() + 31536000); //zápis do cookie
      }

      $this->var->main[0]->AutoClick(0, "./");  //auto kliknuti
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
          $result = $this->AdministraceJazyku();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vrati nazev nalezici danemu id, pro externi moduly
 *
 * pouziti: <strong>$select = $this->var->main[0]->NactiFunkci("DynamicLanguage", "VyberJazyka"[, $id, $tvar]);</strong>
 *
 * @param id id polozky menu, nepovinne
 * @param tvar cislo tvaru pro vicenasobne pouziti v jinych castech
 * @return nazev polozky menu
 */
  public function VyberJazyka($id = NULL, $tvar = 1)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, jazyk, zkratka FROM jazyk ORDER BY LOWER(zkratka) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_vyber_jazyka_select_begin_{$tvar}"]);

        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vyber_jazyka_select_{$tvar}"],
                                              $data->id,
                                              $data->zkratka,
                                              $data->jazyk,
                                              (!Empty($id) && $id == $data->id ? $this->NactiUnikatniObsah($this->unikatni["normal_vyber_jazyka_select_oznaceni_{$tvar}"]) : ""));
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vyber_jazyka_select_end_{$tvar}"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_vyber_jazyka_select_null_{$tvar}"]);
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
 * Vrati mutace jazyka pro ostatni muduly
 *
 * pouziti: <strong>$mutace = $this->var->main[0]->NactiFunkci("DynamicLanguage", "MutaceJazyka");</strong>
 *
 * @return pole jazyku [index] = zkratka
 */
  public function MutaceJazyka()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, zkratka FROM jazyk ORDER BY LOWER(zkratka) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result[$data->id] = $data->zkratka;
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
 * Interne volana funkce pro zobrazovani administrace dynamickeho menu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceJazyku()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add",
                                        $this->AdminVypisJazyk());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add"]);

          $jazyk = stripslashes(htmlspecialchars($_POST["jazyk"], ENT_QUOTES));
          $zkratka = stripslashes(htmlspecialchars($_POST["zkratka"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($jazyk) &&
              !Empty($zkratka) &&
              !$this->ExistujePolozka($zkratka))  //kontola jestli neni stejna zkratka
          {
            if (@$this->sqlite->queryExec("INSERT INTO jazyk (id, jazyk, zkratka) VALUES
                                          (NULL, '{$jazyk}', '{$zkratka}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_hlaska"],
                                                  $jazyk,
                                                  $zkratka);
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

          if ($res = @$this->sqlite->query("SELECT jazyk, zkratka FROM jazyk WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit"],
                                                  $data->jazyk,
                                                  $data->zkratka);

              $jazyk = stripslashes(htmlspecialchars($_POST["jazyk"], ENT_QUOTES));
              $zkratka = stripslashes(htmlspecialchars($_POST["zkratka"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($jazyk) &&
                  !Empty($zkratka) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE jazyk SET jazyk='{$jazyk}',
                                                                zkratka='{$zkratka}'
                                                                WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_hlaska"], $jazyk);
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

          if ($res = @$this->sqlite->query("SELECT jazyk FROM jazyk WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM jazyk WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_hlaska"], $data->jazyk);
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
 * Overuje jestli existuje polozda v DB
 *
 * @param zkratka zkratka jazyka
 * @return true/false - existuje / neexistuje
 */
  private function ExistujePolozka($zkratka)
  {
    if ($res = @$this->sqlite->query("SELECT id FROM jazyk WHERE zkratka='{$zkratka}';", NULL, $error))
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
 * Vrati nazev nalezici danemu id, pro externi moduly
 *
 * pouziti: <strong>$jazyk = $this->var->main[0]->NactiFunkci("DynamicLanguage", "JazykPodleId", $id);</strong>
 *
 * @param id id polozky menu
 * @param tvar cislo tvaru
 * @return nazev polozky menu
 */
  public function JazykPodleId($id, $tvar = 1)
  {
    settype($id, "integer");
    $result = $this->NactiUnikatniObsah($this->unikatni["normal_jazyk_podle_id_{$tvar}"]);
    if ($res = @$this->sqlite->query("SELECT jazyk FROM jazyk WHERE id='{$id}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->jazyk;
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
 * Vrati zkratku nalezici danemu id, pro externi moduly
 *
 * pouziti: <strong>$zkratka = $this->var->main[0]->NactiFunkci("DynamicLanguage", "ZkratkaPodleId", $id);</strong>
 *
 * @param id id polozky menu
 * @param tvar cislo tvaru
 * @return nazev polozky menu
 */
  public function ZkratkaPodleId($id, $tvar = 1)
  {
    settype($id, "integer");
    $result = $this->NactiUnikatniObsah($this->unikatni["normal_zkratka_podle_id_{$tvar}"]);
    if ($res = @$this->sqlite->query("SELECT zkratka FROM jazyk WHERE id='{$id}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->zkratka;
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
 * Vypis administrace menu
 *
 * @return vypis menu v html
 */
  private function AdminVypisJazyk()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, jazyk, zkratka FROM jazyk ORDER BY LOWER(zkratka) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                              $data->id,
                                              $data->zkratka,
                                              $data->jazyk,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}");
        }
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_null"]);
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
