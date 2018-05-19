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
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona;
  public $idmodul = "dynobsah";  //id pro rozliseni modulu v adminu
  public $mount = array("");

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
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->povolit_pridani = $this->NactiUnikatniObsah($this->unikatni["set_povolit_pridani"]);
    $this->vypis_chybu = $this->NactiUnikatniObsah($this->unikatni["set_vypis_chybu"]);

    $this->dbpredpona = $this->NastavKomunikaci($this->var, $index);
    //$this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dirpath}/{$this->dbname}");
    if (!$this->PripojeniDatabaze($error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $this->Instalace();

    $blok = ($_GET["co"] == "editgroup" || $_GET["co"] == "delgroup");  //blokovani urcitych adres
    $this->NastavitAdresuMenu($this->RozsiritAdminMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                      $this->idmodul,
                                                      $this->UmelyTitle(($blok ? -1 : NULL), ($blok ? $_GET["id"] : NULL)))));
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
 * Instalace databaze
 *
 */
  private function Instalace()
  {
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}dynamicky_obsah (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  adresa TEXT,
                                  text TEXT,
                                  skupina INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}gtk_skupina (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  nazev VARCHAR(200),
                                  popisek TEXT,
                                  href_id VARCHAR(200),
                                  href_class VARCHAR(200),
                                  href_akce VARCHAR(500),
                                  zobrazit BOOL);", $error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
    if ($res = $this->query("SELECT id, nazev, href_id, href_class, href_akce, zobrazit FROM {$this->dbpredpona}gtk_skupina ORDER BY id ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
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
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $adresa;
  }

/**
 *
 * Vygeneruje umely title dle zvolene sekce
 *
 * @return novy title do admin menu
 */
  private function UmelyTitle($id_par = NULL, $group_par = NULL)
  {
    $id = (!Empty($id_par) ? $id_par : $_GET["id"]);  //cislo sekce
    settype($id, "integer");

    $group = (!Empty($group_par) ? $group_par : $_GET["group"]);  //cislo sekce
    settype($group, "integer");

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_default_title"]);
//var_dump($id, $group);
    if (!Empty($id) && $id > 0)
    {
      if ($res = $this->query("SELECT {$this->dbpredpona}gtk_skupina.nazev nazev
                              FROM {$this->dbpredpona}gtk_skupina, {$this->dbpredpona}dynamicky_obsah
                              WHERE {$this->dbpredpona}gtk_skupina.id={$this->dbpredpona}dynamicky_obsah.skupina AND
                              {$this->dbpredpona}dynamicky_obsah.id={$id};", $error))
      {
        if ($this->numRows($res) == 1)
        {
          $result = $this->fetchObject($res)->nazev;
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));

      }
    }
      else
    {
      if ($res = $this->query("SELECT nazev
                              FROM {$this->dbpredpona}gtk_skupina
                              WHERE id={$group};", $error))
      {
        if ($this->numRows($res) == 1)
        {
          $result = $this->fetchObject($res)->nazev;
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $result;
  }

/**
 *
 * Generovani samotneho obsahu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah"[, "nejaka_adresa", true, array("dalsi text a nebo funkce")]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @param kontrola true/false - zapinani nebo vypinani kontroly specialnich znaku (false = &, true = &amp;)
 * @param pridavek pridavny obsah co se da vlozit do textu, ve tvaru @@XX@@
 * @return vygenerovany obsah
 */
  public function DynamickyObsah($adr = NULL, $kontrola = true, $pridavek = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
    }

    $result = "";
    if ($res = $this->query("SELECT text
                            FROM {$this->dbpredpona}dynamicky_obsah
                            WHERE adresa='{$adresa}';", $error))
    {
      if ($this->numRows($res) == 1)
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

          $doplnek = array_merge($doplnek, $dalsi); //slouceni pole
        }

        //nacteni textu z databaze
        $text = $this->fetchObject($res)->text;
        //zpetny prevod kvuli ampersantum a tomu ze sqlite preklada texty malinko jinak
        //htmlspecialchars_decode(html_entity_decode($text))
        $special = ($this->ZjistiTypDB() == "sqlite" ? html_entity_decode($text, ENT_QUOTES, "UTF-8") : html_entity_decode($text, ENT_QUOTES, "UTF-8"));
        //prepnuti mezi normalnim prevodem a nebo primym vystupem a vlozeni textu
        $result = $this->PrevodUnikatnihoTextu(($kontrola ? $special : html_entity_decode(html_entity_decode($text, ENT_QUOTES, "UTF-8"))), $doplnek);
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
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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

    if ($res = $this->query("SELECT id, nazev, popisek FROM {$this->dbpredpona}gtk_skupina WHERE id={$id};", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $data = $this->fetchObject($res);

        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsahu_skupiny"],
                                            $data->nazev,
                                            htmlspecialchars_decode(html_entity_decode($data->popisek, NULL, "UTF-8")),
                                            ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_skupina_add_link_skupina"],
                                                                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addobsah&amp;group={$data->id}&amp;ret={$_GET[$this->var->get_idmodul]}") : ""),
                                            $this->VypisSkupiny($id));
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
 * Vypis zdruzenych odkazu (ve skupine) podle adresy
 *
 * @param skupina cislo skupiny
 * @return vypis odkazu na upravu obsahu
 */
  private function VypisSkupiny($skupina)
  {
    settype($skupina, "integer");

    $doplnek = ($this->NactiUnikatniObsah($this->unikatni["set_admin_prepnani_unikatnich"]) ? "_{$skupina}" : "");  //rozlisi jestli vkladat _X nebo ""

    if ($res = $this->query("SELECT id, adresa, text FROM {$this->dbpredpona}dynamicky_obsah WHERE skupina={$skupina};", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_edit_link_skupina{$doplnek}"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editobsah&amp;id={$data->id}&amp;ret={$_GET[$this->var->get_idmodul]}",
                                              ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_skupina_del_link{$doplnek}"],
                                                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delobsah&amp;id={$data->id}&amp;ret={$_GET[$this->var->get_idmodul]}",
                                                                                                  $data->adresa) : ""),
                                              $data->adresa,
                                              htmlspecialchars_decode(html_entity_decode($data->text, NULL, "UTF-8")));  //html_entity_decode()
        }
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
 * Externe volana funkce pri smazani polozky v menu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicObsah", "SmazStranku");</strong>
 *
 * @param cesta adresy ktere byly smazany
 * @return vypis obsahu v html
 */
  public function SmazStranku($cesta)
  {
    if (!$this->queryExec("DELETE FROM {$this->dbpredpona}dynamicky_obsah WHERE adresa='{$cesta}';", $error)) //provedeni dotazu
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
      if ($res = $this->query("SELECT id FROM {$this->dbpredpona}dynamicky_obsah WHERE adresa='{$adresa}';", $error))
      {
        $result = ($this->numRows($res) == 1 ? true : false);
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
      if ($res = $this->query("SELECT id FROM {$this->dbpredpona}gtk_skupina WHERE nazev='{$nazev}';", $error))
      {
        $result = ($this->numRows($res) == 1 ? true : false);
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
    if ($res = $this->query("SELECT id, nazev
                            FROM {$this->dbpredpona}gtk_skupina
                            WHERE zobrazit=1;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_seznam_skupin_begin"]);
        while ($data = $this->fetchObject($res))
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
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati bool podle toho jestli je skupina skryta nebo ne
 *
 * @param id cislo skupiny
 * @return true/false - zobrazena/skryta
 */
  private function ZobrazeniSkupiny($id)
  {
    settype($id, "integer");
    $result = NULL;
    if ($res = $this->query("SELECT zobrazit FROM {$this->dbpredpona}gtk_skupina WHERE id={$id};", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $data = $this->fetchObject($res);
        settype($data->zobrazit, "bool"); //prevedeni na bool
        $result = $data->zobrazit;
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

    $skupina = 0; //rozlisovani skupiny
    if (!Empty($_GET["ret"]))
    {
      $skupina = explode("__", $_GET["ret"]);
      $skupina = $skupina[1];
    }
      else
    {
      $skupina = $_GET["group"];
    }
    settype($skupina, "integer");

    $doplnek = ($this->NactiUnikatniObsah($this->unikatni["set_admin_prepnani_unikatnich"]) ? "_{$skupina}" : "");  //rozlisi jestli vkladat _X nebo ""

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addobsah": //pridavani obsahu
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah{$doplnek}"],
                                              $_GET["adresa"],
                                              $this->SeznamSkupin($_GET["group"]),
                                              $this->absolutni_url,
                                              (!Empty($_GET["ret"]) ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$_GET["ret"]}" :
                                                                      "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}"),
                                              $this->UmelyTitle());

          $adresa = $this->ChangeWrongChar($_POST["adresa"]);
          $obsah = $this->ChangeWrongChar($_POST["text"]);
          $skup = $_POST["skupina"]; //pokud je skryta tak ulozit stejnou
          settype($skup, "integer");
          $skupina = ($this->ZobrazeniSkupiny($_GET["group"]) ? $skup : $_GET["group"]);

          if (!Empty($_POST["tlacitko"]) &&
              //!Empty($obsah) &&
              !$this->ExistujeOdkaz($adresa) &&
              $skupina != 0 &&
              $this->povolit_pridani)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}dynamicky_obsah (id, adresa, text, skupina) VALUES
                                  (NULL, '{$adresa}', '{$obsah}', {$skupina});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah_hlaska"], $adresa);

              if (!Empty($_GET["ret"])) //pokud je nastavena vraceci adresa
              {
                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$_GET["ret"]}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editobsah":  //uprava obsahu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT adresa, text, skupina FROM {$this->dbpredpona}dynamicky_obsah WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah{$doplnek}"],
                                                  $data->adresa,
                                                  $data->text,
                                                  $this->SeznamSkupin($data->skupina),
                                                  (!Empty($_GET["ret"]) ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$_GET["ret"]}" :
                                                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}"),
                                                  $this->absolutni_url,
                                                  $this->UmelyTitle());

              $adresa = $this->ChangeWrongChar($_POST["adresa"]);
              $obsah = $this->ChangeWrongChar($_POST["text"]);
              $skup = $_POST["skupina"]; //pokud je skryta tak ulozit stejnou
              settype($skup, "integer");
              $skupina = ($this->ZobrazeniSkupiny($data->skupina) ? $skup : $data->skupina);

              if (!Empty($_POST["tlacitko"]) &&
                  //!Empty($adresa) &&
                  //!Empty($obsah) &&
                  $skupina != 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}dynamicky_obsah SET adresa='{$adresa}',
                                                                                    text='{$obsah}',
                                                                                    skupina={$skupina}
                                                                                    WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah_hlaska"], $adresa);

                  if (!Empty($_GET["ret"])) //pokud je nastavena vraceci adresa
                  {
                    $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$_GET["ret"]}");  //auto kliknuti
                  }
                    else
                  {
                    $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
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
        break;

        case "delobsah": //mazani podle id obsahu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = $this->query("SELECT adresa FROM {$this->dbpredpona}dynamicky_obsah WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}dynamicky_obsah WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delobsah_hlaska"], $data->adresa);

                if (!Empty($_GET["ret"])) //pokud je nastavena vraceci adresa
                {
                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$_GET["ret"]}");  //auto kliknuti
                }
                  else
                {
                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
                }
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

        case "addgroup": //pridavani skupiny
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgroup"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $popisek = $this->ChangeWrongChar($_POST["popisek"]);
          $href_id = $this->ChangeWrongChar($_POST["href_id"]);
          $href_class = $this->ChangeWrongChar($_POST["href_class"]);
          $href_akce = $this->ChangeWrongChar($_POST["href_akce"]);
          $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !$this->ExistujeSkupina($nazev) &&
              $this->povolit_pridani)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}gtk_skupina (id, nazev, popisek, href_id, href_class, href_akce, zobrazit) VALUES
                                  (NULL, '{$nazev}', '{$popisek}', '{$href_id}', '{$href_class}', '{$href_akce}', {$zobrazit});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgroup_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editgroup":  //uprava skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev, popisek, href_id, href_class, href_akce, zobrazit FROM {$this->dbpredpona}gtk_skupina WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgroup"],
                                                  $data->nazev,
                                                  $data->popisek,
                                                  $data->href_id,
                                                  $data->href_class,
                                                  $data->href_akce,
                                                  ($data->zobrazit ? " checked=\"checked\"" : ""),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $popisek = $this->ChangeWrongChar($_POST["popisek"]);
              $href_id = $this->ChangeWrongChar($_POST["href_id"]);
              $href_class = $this->ChangeWrongChar($_POST["href_class"]);
              $href_akce = $this->ChangeWrongChar($_POST["href_akce"]);
              $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}gtk_skupina SET nazev='{$nazev}',
                                                                                popisek='{$popisek}',
                                                                                href_id='{$href_id}',
                                                                                href_class='{$href_class}',
                                                                                href_akce='{$href_akce}',
                                                                                zobrazit={$zobrazit}
                                                                                WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgroup_hlaska"], $nazev);

                  if (!Empty($_GET["ret"])) //pokud je nastavena vraceci adresa
                  {
                    $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$_GET["ret"]}");  //auto kliknuti
                  }
                    else
                  {
                    $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
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
        break;

        case "delgroup": //mazani podle id skupny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}gtk_skupina WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}gtk_skupina WHERE id={$id};
                                    DELETE FROM {$this->dbpredpona}dynamicky_obsah WHERE skupina={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delgroup_hlaska"], $data->nazev);

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
 * Vypis administrace obsahu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisObsahu()
  {
    $result = "";
    if ($res = $this->query("SELECT id, nazev, popisek FROM {$this->dbpredpona}gtk_skupina ORDER BY id ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina"],
                                              $data->id,
                                              $data->nazev,
                                              htmlspecialchars_decode(html_entity_decode($data->popisek, NULL, "UTF-8")),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editgroup&amp;id={$data->id}",
                                              ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_del_link"],
                                                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delgroup&amp;id={$data->id}",
                                                                                                  $data->nazev) : ""),
                                              ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_skupina_add_link"],
                                                                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addobsah&amp;group={$data->id}") : ""));

          if ($res1 = $this->query("SELECT id, adresa, text FROM {$this->dbpredpona}dynamicky_obsah WHERE skupina={$data->id} ORDER BY adresa ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
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
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_end"]);
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
