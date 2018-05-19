<?php

/**
 *
 * Blok dynamicky generovaneho obsahu
 *
 * public funkce:\n
 * construct: DynamicObsah - hlavni konstruktor tridy\n
 * DynamickyObsah() - hlavni vypis obsahu\n
 * SmazStranku() - muze smazat z venci danou adresu\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicObsah extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $unikatni;
  private $idmodul = "dynobsah";  //id pro rozliseni modulu v adminu
  private $povolit_pridani = true; //true/false - povolit / zakazat, pridavani (i mazani) dalsich polozek
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

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");

    $this->povolit_pridani = $this->NactiUnikatniObsah($this->unikatni["set_povolit_pridani"]);
    $this->vypis_chybu = $this->NactiUnikatniObsah($this->unikatni["set_vypis_chybu"]);

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $this->Instalace();

    $this->NastavitAdresuMenu($this->RozsiritAdminMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"], $this->idmodul)));
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
      $adr = explode("__", $_GET[$this->var->get_idmodul]); //rozdeleni adresy
      switch ($adr[0])
      {
        case $this->idmodul:  //id modul
          $result = (!Empty($adr[1]) ? $this->VypisObsahSkupny($adr[1]) : $this->AdministraceObsahu());
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
                                      text TEXT,
                                      skupina INTEGER UNSIGNED);

                                      CREATE TABLE gtk_skupina (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      nazev VARCHAR(200),
                                      popisek TEXT,
                                      href_id VARCHAR(200),
                                      href_class VARCHAR(200),
                                      href_akce VARCHAR(500),
                                      zobrazit BOOL);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Rozsireni menu adminu o dane skupiny z teto sekce
 *
 * @param adresa pole adres adminmenu
 * @return rozsirene pole adres adminmenu o sekce z tohoto modulu
 */
  private function RozsiritAdminMenu($adresa)
  {
    $i = count($adresa);
    if ($res = @$this->sqlite->query("SELECT id, nazev, href_id, href_class, href_akce, zobrazit FROM gtk_skupina;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $adresa[$i]["main_href"] = "{$this->idmodul}__{$data->id}";
          $adresa[$i]["odkaz"] = $this->NactiUnikatniObsah($this->unikatni["admin_tvar_menu_odkaz"], $data->nazev);
          $adresa[$i]["title"] = $this->NactiUnikatniObsah($this->unikatni["admin_tvar_menu_title"], $data->nazev);
          $adresa[$i]["id"] = $data->href_id;
          $adresa[$i]["class"] = $data->href_class;
          $adresa[$i]["akce"] = $data->href_akce;
          $adresa[$i]["zobrazit"] = $data->zobrazit;
          $i++;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $adresa;
  }

/**
 *
 * Generovani samotneho obsahu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah"[, "nejaka_adresa"]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @param kontrola true/false - zapinani nebo vypinani kontroly specialnich znaku
 * @return vygenerovany obsah
 */
  public function DynamickyObsah($adr = NULL, $kontrola = true)
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
    if ($res = @$this->sqlite->query("SELECT text
                                      FROM dynamicky_obsah
                                      WHERE adresa='{$adresa}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = ($kontrola ? htmlspecialchars_decode(html_entity_decode($res->fetchObject()->text)) : $res->fetchObject()->text);
      }
        else
      {
        if ($this->vypis_chybu)
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_null"]);
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
 * Vypise obsah skupiny, univerzelni vypis
 *
 * @param id id dane skupiny
 * @return obsah skupny s odkazy
 */
  private function VypisObsahSkupny($id)
  {
    settype($id, "integer");

    if ($res = @$this->sqlite->query("SELECT nazev, popisek FROM gtk_skupina WHERE id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();

        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsahu_skupiny"],
                                            $data->nazev,
                                            $data->popisek,
                                            $this->VypisSkupiny($id));
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
 * Vypis zdruzenych odkazu (ve skupine) podle adresy
 *
 * @param skupina cislo skupiny
 * @return vypis odkazu na upravu obsahu
 */
  private function VypisSkupiny($skupina)
  {
    settype($skupina, "integer");

    if ($res = @$this->sqlite->query("SELECT id, adresa, text FROM dynamicky_obsah WHERE skupina={$skupina};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_edit_link_skupina"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editobsah&amp;id={$data->id}&amp;ret={$_GET[$this->var->get_idmodul]}",
                                              $data->adresa,
                                              $data->text);
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
 * Externe volana funkce pri smazani polozky v menu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicObsah", "SmazStranku");</strong>
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
  private function ExistujeOdkaz($adresa)
  {
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
 * Overuje existenci skupiny
 *
 * @param nazev nazev skupiny
 * @return true/false - existuje / neexistuje
 */
  private function ExistujeSkupina($nazev)
  {
    if (!Empty($nazev))
    {
      if ($res = @$this->sqlite->query("SELECT id FROM gtk_skupina WHERE nazev='{$nazev}';", NULL, $error))
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
 * Select pro vyber skupin
 *
 * @param id nepovinne urcuje oznacene id polozky
 * @return vyber skupin
 */
  private function SeznamSkupin($id = NULL)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev
                                      FROM gtk_skupina;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_seznam_skupin_begin"]);
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_skupin"],
                                              $data->id,
                                              (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->nazev);
        }
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_skupin_end"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_seznam_skupin_null"]);
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
 * Interne volana funkce pro zobrazovani administrace dynamickeho obsahu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_obsah_add_link"],
                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addobsah",
                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addgroup") : ""),
                                        $this->AdminVypisObsahu());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addobsah": //pridavani obsahu
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah"],
                                              $_GET["adresa"],
                                              $this->SeznamSkupin($_GET["group"]));

          $obsah = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));
          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $skupina = $_POST["skupina"];
          settype($skupina, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              //!Empty($obsah) &&
              !$this->ExistujeOdkaz($adresa) &&
              $skupina != 0 &&
              $this->povolit_pridani)
          {
            if (@$this->sqlite->queryExec("INSERT INTO dynamicky_obsah (id, adresa, text, skupina) VALUES
                                          (NULL, '{$adresa}', '{$obsah}', {$skupina});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah_hlaska"], $adresa);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editobsah":  //uprava obsahu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $ret = $_GET["ret"];  //navratova sekce

          if ($res = @$this->sqlite->query("SELECT adresa, text, skupina FROM dynamicky_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah"],
                                                  $data->adresa,
                                                  $data->text,
                                                  $this->SeznamSkupin($data->skupina),
                                                  (!Empty($ret) ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$ret}" :
                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}"));

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $obsah = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));
              $skupina = $_POST["skupina"];
              settype($skupina, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  //!Empty($adresa) &&
                  //!Empty($obsah) &&
                  $skupina != 0 &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE dynamicky_obsah SET adresa='{$adresa}',
                                                                          text='{$obsah}',
                                                                          skupina={$skupina}
                                                                          WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah_hlaska"], $adresa);
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error);
                }

                if (!Empty($ret)) //pokud je nastavena vraceci adresa
                {
                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$ret}");  //auto kliknuti
                }
                  else
                {
                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
                }
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;

        case "delobsah": //mazani podle id obsahu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = @$this->sqlite->query("SELECT adresa FROM dynamicky_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM dynamicky_obsah WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delobsah_hlaska"], $data->adresa);
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

        case "addgroup": //pridavani skupiny
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgroup"]);

          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
          $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
          $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
          $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));
          $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !$this->ExistujeSkupina($nazev) &&
              $this->povolit_pridani)
          {
            if (@$this->sqlite->queryExec("INSERT INTO gtk_skupina (id, nazev, popisek, href_id, href_class, href_akce, zobrazit) VALUES
                                          (NULL, '{$nazev}', '{$popisek}', '{$href_id}', '{$href_class}', '{$href_akce}', {$zobrazit});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgroup_hlaska"], $nazev);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editgroup":  //uprava skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT nazev, popisek, href_id, href_class, href_akce, zobrazit FROM gtk_skupina WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgroup"],
                                                  $data->nazev,
                                                  $data->popisek,
                                                  $data->href_id,
                                                  $data->href_class,
                                                  $data->href_akce,
                                                  ($data->zobrazit ? " checked=\"checked\"" : ""));

              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
              $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
              $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
              $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));
              $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE gtk_skupina SET nazev='{$nazev}',
                                                                      popisek='{$popisek}',
                                                                      href_id='{$href_id}',
                                                                      href_class='{$href_class}',
                                                                      href_akce='{$href_akce}',
                                                                      zobrazit={$zobrazit}
                                                                      WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgroup_hlaska"], $nazev);
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error);
                }

                $ret = $_GET["ret"];
                if (!Empty($ret)) //pokud je nastavena vraceci adresa
                {
                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$ret}");  //auto kliknuti
                }
                  else
                {
                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
                }
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;

        case "delgroup": //mazani podle id skupny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = @$this->sqlite->query("SELECT nazev FROM gtk_skupina WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM gtk_skupina WHERE id={$id};
                                            DELETE FROM dynamicky_obsah WHERE skupina={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delgroup_hlaska"], $data->nazev);
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
    if ($res = @$this->sqlite->query("SELECT id, nazev, popisek FROM gtk_skupina ORDER BY nazev ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina"],
                                              $data->id,
                                              $data->nazev,
                                              $data->popisek,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editgroup&amp;id={$data->id}",
                                              ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_del_link"],
                                                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delgroup&amp;id={$data->id}",
                                                                                                  $data->nazev) : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addobsah&amp;group={$data->id}");

          if ($res1 = @$this->sqlite->query("SELECT id, adresa, text FROM dynamicky_obsah WHERE skupina={$data->id} ORDER BY adresa ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                                    $data1->text,
                                                    $data1->adresa,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editobsah&amp;id={$data1->id}",
                                                    ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_del_link"],
                                                                                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delobsah&amp;id={$data1->id}",
                                                                                                        $data1->adresa) : ""));
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_end"]);
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
