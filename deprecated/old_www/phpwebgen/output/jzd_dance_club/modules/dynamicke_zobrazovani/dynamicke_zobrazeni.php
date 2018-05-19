<?php

/**
 *
 * Blok dynamicky generovaneho obsahu
 *
 * public funkce:\n
 * construct: DynamicZobrazeni - hlavni konstruktor tridy\n
 * RychloVypis() - rychlo vypis polozek\n
 * DynamickeZobrazeni() - standartni vypis polozek\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicZobrazeni extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $unikatni;
  private $idmodul = "dynzobr";  //id pro rozliseni modulu v adminu
  private $povolit_pridani = true; //true/false - povolit / zakazat, pridavani (i mazani) dalsich polozek
  private $vypis_chybu = false;
  private $znacka_povinne = "*";

                            //index => slovní popis
  private $element = array ("nadpis" =>  "Napis",
                            "popisek" => "Krátký popisek",
                            "text" =>    "Dlouhé texty",
                            "obrazek" => "Obrázek",

                            "datum" =>   "Datum",
                            "cas" =>     "Čas",
                            "datumcas" =>"Datum a čas",
                            );  //narvat checkbox a radio!!!!!

  private $vstupni_typ = array ("text",
                                "integer",
                                "reg_exp");

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
    //$this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->znacka_povinne = $this->NactiUnikatniObsah($this->unikatni["set_znacka_povinne"]);
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
          $result = (!Empty($adr[1]) ? $this->AdminObsahSablony($adr[1]) : $this->AdministraceObsahu());
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
      if (!@$this->sqlite->queryExec("CREATE TABLE sablona (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      razeni VARCHAR(50),
                                      nove INTEGER UNSIGNED,
                                      nazev VARCHAR(200),
                                      popisek TEXT,
                                      href_id VARCHAR(200),
                                      href_class VARCHAR(200),
                                      href_akce VARCHAR(500),
                                      zobrazit BOOL);

                                      CREATE TABLE obsah_sablony (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      sablona INTEGER UNSIGNED,
                                      obsah TEXT,
                                      pridano DATETIME);

                                      CREATE TABLE element (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      sablona INTEGER UNSIGNED,
                                      typ INTEGER UNSIGNED,
                                      nazev VARCHAR(200),
                                      value VARCHAR(200),
                                      input_id VARCHAR(200),
                                      input_class VARCHAR(200),
                                      input_akce VARCHAR(500),
                                      povinne BOOL,
                                      vstupni_typ INTEGER UNSIGNED,
                                      reg_exp VARCHAR(500),
                                      vystupni_format VARCHAR(200),
                                      min_poc INTEGER UNSIGNED,
                                      max_poc INTEGER UNSIGNED,
                                      poradi INTEGER UNSIGNED);
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
    if ($res = @$this->sqlite->query("SELECT id, nazev, href_id, href_class, href_akce, zobrazit FROM sablona ORDER BY nazev;", NULL, $error))
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
 * Vrati nazvy polozek v poli
 *
 * @param adresa adresa sablony
 * @return pole polozek
 */
  private function PolozkySablony($adresa)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT element.nazev nazev
                                      FROM sablona, element
                                      WHERE
                                      sablona.id=element.sablona AND
                                      sablona.adresa='{$adresa}';", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while($data = $res->fetchObject())
        {
          $result[] = $data->nazev;
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
 * Vrati textovy smer razeni
 *
 * @param adresa adresa sablony
 * @return text razeni
 */
  private function RychloVypisRazeni($adresa)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT razeni
                                      FROM sablona
                                      WHERE
                                      adresa='{$adresa}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $result = $data->razeni;
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
 * Vrati cislo pro pocet zobrazeni novinek v rychlo vypisu
 *
 * @param adresa adresa sablony
 * @return cislo pro limit
 */
  private function RychloVypisLimit($adresa)
  {
    $result = 0;
    if ($res = @$this->sqlite->query("SELECT nove
                                      FROM sablona
                                      WHERE
                                      adresa='{$adresa}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $result = $data->nove;
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
 * Vrati text popisku
 *
 * @param sablona id sablony
 * @return popisek
 */
  private function VypisPopisku($sablona)
  {
    settype($sablona, "integer");

    $result = "";
    if ($res = @$this->sqlite->query("SELECT popisek
                                      FROM sablona
                                      WHERE
                                      id={$sablona};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $result = $data->popisek;
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
 * Rychlo vypis pro strucne zobrazeni napr. na uvodu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RychloVypis"[, "adresa", 1]);</strong>
 *
 * @param adr adresa sablony
 * @param tvar cislo tvaru
 * @return dany pocet polozek obsahu
 */
  public function RychloVypis($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
    }

//tu udelat vypis ezvsech sekci a nebo z definovanych sekci!!!

    $polozky = $this->PolozkySablony($adresa);  //vrati polozky v poli
    $razeni = $this->RychloVypisRazeni($adresa);  //vrati smer razeni
    $limit = $this->RychloVypisLimit($adresa);  //vrati pocet polozek v rychlo vypisu

    $result = "";
    if ($res = @$this->sqlite->query("SELECT obsah_sablony.obsah obsah
                                      FROM sablona, obsah_sablony
                                      WHERE
                                      sablona.id=obsah_sablony.sablona AND
                                      sablona.adresa='{$adresa}'
                                      ORDER BY obsah_sablony.pridano {$razeni}
                                      LIMIT 0,{$limit};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $obsahpole = explode("|-x-|", $data->obsah);
          $vypis = "";
          $vypis = array("array_args");
          for ($i = 0; $i < count($polozky) * 2; $i++)  //nadpis: sdfdsf --> sdfdsf, odelat ty texty, nechat je do admnu
          {
            $vypis[] = (($i % 2) == 0 ? $polozky[$i / 2] : $obsahpole[$i / 2]);
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_{$tvar}"], $vypis);
        }
      }
        else
      {
        if ($this->vypis_chybu)
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_null_{$tvar}"]);
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
 * Hlavni dynamicke zobrazeni obsahu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "DynamickeZobrazeni"[, "adresa", 1]);</strong>
 *
 * @param adr adresa sablony
 * @param tvar cislo tvaru
 * @return hlavni graficky vypis
 */
  public function DynamickeZobrazeni($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
    }

    $polozky = $this->PolozkySablony($adresa);  //vrati polozky v poli
    $razeni = $this->RychloVypisRazeni($adresa);  //vrati smer razeni

    //rozkliknuti polozky do podmenu!!!

    $result = "";
    if ($res = @$this->sqlite->query("SELECT obsah_sablony.obsah obsah
                                      FROM sablona, obsah_sablony
                                      WHERE
                                      sablona.id=obsah_sablony.sablona AND
                                      sablona.adresa='{$adresa}'
                                      ORDER BY obsah_sablony.pridano {$razeni};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $obsahpole = explode("|-x-|", $data->obsah);
          $vypis = "";
          $vypis = array("array_args");
          for ($i = 0; $i < count($polozky) * 2; $i++)
          {
            $vypis[] = (($i % 2) == 0 ? $polozky[$i / 2] : $obsahpole[$i / 2]);
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_{$tvar}"], $vypis);
        }
      }
        else
      {
        if ($this->vypis_chybu)
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_null_{$tvar}"]);
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
 * @param sablona id dane sablony
 * @return obsah skupny s odkazy
 */
  private function AdminObsahSablony($sablona)
  {
    settype($sablona, "integer");

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_sablony"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=addobsah",
                                        $this->VypisPopisku($sablona),
                                        $this->AdminVypisObsahSablony($sablona));

    $typelementu = array_keys($this->element);

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addobsah":  //pridavani obsahu
          if ($res = @$this->sqlite->query("SELECT id, sablona, typ, nazev, value,
                                            input_id, input_class, input_akce,
                                            povinne, vstupni_typ, reg_exp,
                                            vystupni_format, min_poc, max_poc,
                                            poradi
                                            FROM element
                                            WHERE sablona={$sablona};", NULL, $error))
          {
            if ($res->numRows() != 0)
            {
              $element = "";
              $i = 0;
              while($data = $res->fetchObject())
              {
                $povinne = ($data->povinne ? $this->znacka_povinne : "");

                if ($data->povinne)
                {
                  $podminka[$i]["name"] = "elem_{$data->id}";
                  $podminka[$i]["typ"] = $typelementu[$data->typ];
                }

                $input_id = (!Empty($data->input_id) ? $data->input_id : "");
                $input_class = (!Empty($data->input_id) ? $data->input_class : "");
                $input_akce = (!Empty($data->input_id) ? $data->input_akce : "");

                switch ($typelementu[$data->typ])
                {
                  case "nadpis": //nadpis
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_nadpis"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $data->value,
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne);
                  break;

                  case "popisek": //popisek
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_popisek"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $data->value,
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne);
                  break;

                  case "text": //text
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_text"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $data->value,
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne);
                  break;

                  case "obrazek": //obrazek
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_obrazek"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne);
                  break;

                  case "datum": //datum
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datum"],
                                                          $data->nazev,
                                                          $data->id,
                                                          date($data->vystupni_format),//$data->value,
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format));
                  break;

                  case "cas": //cas
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_cas"],
                                                          $data->nazev,
                                                          $data->id,
                                                          date($data->vystupni_format),//$data->value,
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format));
                  break;

                  case "datumcas": //datumcas
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datumcas"],
                                                          $data->nazev,
                                                          $data->id,
                                                          date($data->vystupni_format),//$data->value,
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format));
                  break;
                }

                $i++;
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah_form"], $element);

          $poc = 0;
          $check = true;
          for ($i = 0; $i < count($podminka); $i++)
          {
            if (Empty($_POST[$podminka[$i]["name"]]))
            {
              $check = false;
            }
              else
            {
              $poc++;
            }
          }

          //dopsat kontrolu podle poctu, upload obrazku, kontrolu podle reg_exp!

          if (!Empty($_POST["tlacitko"]) &&
              $poc == count($podminka))
          {
            $data = array_values($_POST);
            $data = array_slice($data, 0, -1);  //odstrani polozku tlacitka
            $ulozit = implode("|-x-|", $data);  //ulozit do DB

            if (@$this->sqlite->queryExec("INSERT INTO obsah_sablony (id, sablona, obsah, pridano) VALUES
                                          (NULL, {$sablona}, '{$ulozit}', datetime('now', '+2 hour'));", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addsab_hlaska"], $ulozit);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
          }
            else
          {
            if (count($_POST) > 0)
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah_error"]);

              $this->var->main[0]->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
            }
          }
        break;

        case "editobsah": //uprava obsahu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT sablona, obsah, pridano FROM obsah_sablony WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
              $obsah = $data->obsah;
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          $nacist = explode("|-x-|", $obsah); //znovu rozdeleni

          if ($res = @$this->sqlite->query("SELECT id, sablona, typ, nazev, value,
                                            input_id, input_class, input_akce,
                                            povinne, vstupni_typ, reg_exp,
                                            vystupni_format, min_poc, max_poc,
                                            poradi
                                            FROM element
                                            WHERE sablona={$sablona};", NULL, $error))
          {
            if ($res->numRows() != 0)
            {
              $element = "";
              $i = 0;
              while($data = $res->fetchObject())
              {
                $povinne = ($data->povinne ? $this->znacka_povinne : "");

                if ($data->povinne)
                {
                  $podminka[$i] = "elem_{$data->id}";
                }

                $input_id = (!Empty($data->input_id) ? $data->input_id : "");
                $input_class = (!Empty($data->input_id) ? $data->input_class : "");
                $input_akce = (!Empty($data->input_id) ? $data->input_akce : "");

                switch ($typelementu[$data->typ])
                {
                  case "nadpis": //nadpis
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_nadpis"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne);
                  break;

                  case "popisek": //popisek
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_popisek"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne);
                  break;

                  case "text": //text
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_text"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne);
                  break;

                  case "obrazek": //obrazek
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_obrazek"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne);
                  break;

                  case "datum": //datum
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datum"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format));
                  break;

                  case "cas": //cas
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_cas"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format));
                  break;

                  case "datumcas": //datumcas
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datumcas"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $input_id,
                                                          $input_class,
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format));
                  break;
                }

                $i++;
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah_form"], $element);

          $poc = 0;
          $check = true;
          for ($i = 0; $i < count($podminka); $i++)
          {
            if (Empty($_POST[$podminka[$i]]))
            {
              $check = false;
            }
              else
            {
              $poc++;
            }
          }

          if (!Empty($_POST["tlacitko"]) &&
              $poc == count($podminka) &&
              $id != 0)
          {
            $data = array_values($_POST);
            $data = array_slice($data, 0, -1);  //odstrani polozku tlacitka
            $ulozit = implode("|-x-|", $data);  //ulozit do DB

            if (@$this->sqlite->queryExec("UPDATE obsah_sablony SET sablona={$sablona},
                                                                    obsah='{$ulozit}'
                                                                    WHERE id={$id};", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editsab_hlaska"], $ulozit);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
          }
            else
          {
            if (count($_POST) > 0)
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah_error"]);

              $this->var->main[0]->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
            }
          }
        break;

        case "delobsah": //mazani podle id skupny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT obsah FROM obsah_sablony WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM obsah_sablony WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delsab_hlaska"], $data->obsah);
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error);
              }

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
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
 * Vypis zdruzenych odkazu (ve skupine) podle adresy
 *
 * @param sablona cislo skupiny
 * @return vypis odkazu na upravu obsahu
 */
  private function AdminVypisObsahSablony($sablona)
  {
    settype($sablona, "integer");

    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, obsah, pridano
                                      FROM obsah_sablony
                                      WHERE sablona={$sablona}
                                      ORDER BY obsah_sablony.pridano DESC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while($data = $res->fetchObject())
        {
          $result .=
          "
          {$data->obsah}, {$data->pridano}
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=editobsah&amp;id={$data->id}\">uprav obsah</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=delobsah&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat nazev: \'{$data->obsah}\' ?');\">smazat obsah</a>
          <br />
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

/**
 *
 * Overuje existenci sablony
 *
 * @param nazev nazev sablony
 * @return true/false - existuje / neexistuje
 */
  private function ExistujeSablona($adresa)
  {
    if (!Empty($adresa))
    {
      if ($res = @$this->sqlite->query("SELECT id FROM sablona WHERE adresa='{$adresa}';", NULL, $error))
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
 * Select pro vyber sablony
 *
 * @param id nepovinne urcuje oznacene id polozky
 * @return vyber sablony
 */
  private function VyberSablony($id = NULL)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa, nazev
                                      FROM sablona;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony_begin"]);
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony"],
                                              $data->id,
                                              (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->nazev,
                                              $data->adresa);
        }
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony_end"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony_null"]);
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
 * Vypisuje seznam typu
 *
 * @param id id polozky typu, nepovinne
 * @param adresa adresa pro navrat spravne stranky, nepovinne
 * @return html select
 */
  private function VyberTypu($id = NULL, $adresa = NULL)
  {
    $typ = array_keys($this->element);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_typ_select_begin"], $adresa);
    for ($i = 0; $i < count($typ); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typ_select"],
                                          $i,
                                          ($id == $i ? " selected=\"selected\"" : ""),
                                          $typ[$i],
                                          $this->element[$typ[$i]]);
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typ_select_end"]);

    return $result;
  }

/**
 *
 * Vrati select pro vyber ze vstupu
 *
 * @param id id polozky vstupu, nepovinne
 * @param adresa adresa pro navrat spravne stranky, nepovinne
 * @return html select
 */
  private function VyberVstupu($id = NULL, $adresa = NULL)
  {
    $typ = $this->vstupni_typ;

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select_begin"], $adresa);
    for ($i = 0; $i < count($typ); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select"],
                                          $i,
                                          ($id == $i ? " selected=\"selected\"" : ""),
                                          $typ[$i]);
      ;
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select_end"]);

    return $result;
  }

/**
 *
 * Vrati pocet elementu v dane sablone
 *
 * @param sablona cislo formulare
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($sablona, $inc = 0)
  {
    settype($sablona, "integer");
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) pocet FROM element WHERE sablona={$sablona};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->pocet + $inc;
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
 * Interne volana funkce pro zobrazovani administrace dynamickeho obsahu adminu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_obsah_add_link"],
                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addsab",
                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem") : ""),
                                        $this->AdminVypisObsahu());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addsab": //pridavani sablony
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addsab"]);

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $razeni = stripslashes(htmlspecialchars($_POST["razeni"], ENT_QUOTES));
          $nove = $_POST["nove"];
          settype($nove, "integer");
          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
          $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
          $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
          $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));
          $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($nazev) &&
              !$this->ExistujeSablona($adresa) &&
              $this->povolit_pridani)
          {
            if (@$this->sqlite->queryExec("INSERT INTO sablona (id, adresa, razeni, nove, nazev, popisek, href_id, href_class, href_akce, zobrazit) VALUES
                                          (NULL, '{$adresa}', '{$razeni}', {$nove}, '{$nazev}', '{$popisek}', '{$href_id}', '{$href_class}', '{$href_akce}', {$zobrazit});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addsab_hlaska"], $nazev);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editsab":  //uprava skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, razeni, nove, nazev, popisek, href_id, href_class, href_akce, zobrazit FROM sablona WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editsab"],
                                                  $data->adresa,
                                                  ($data->razeni == "ASC" ? " checked=\"checked\"" : ""),
                                                  ($data->razeni == "DESC" ? " checked=\"checked\"" : ""),
                                                  $data->nove,
                                                  $data->nazev,
                                                  $data->popisek,
                                                  $data->href_id,
                                                  $data->href_class,
                                                  $data->href_akce,
                                                  ($data->zobrazit ? " checked=\"checked\"" : ""));

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $razeni = stripslashes(htmlspecialchars($_POST["razeni"], ENT_QUOTES));
              $nove = $_POST["nove"];
              settype($nove, "integer");
              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));
              $href_id = stripslashes(htmlspecialchars($_POST["href_id"], ENT_QUOTES));
              $href_class = stripslashes(htmlspecialchars($_POST["href_class"], ENT_QUOTES));
              $href_akce = stripslashes(htmlspecialchars($_POST["href_akce"], ENT_QUOTES));
              $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE sablona SET adresa='{$adresa}',
                                                                  razeni='{$razeni}',
                                                                  nove={$nove},
                                                                  nazev='{$nazev}',
                                                                  popisek='{$popisek}',
                                                                  href_id='{$href_id}',
                                                                  href_class='{$href_class}',
                                                                  href_akce='{$href_akce}',
                                                                  zobrazit={$zobrazit}
                                                                  WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editsab_hlaska"], $nazev);
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

        case "delsab": //mazani podle id skupny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = @$this->sqlite->query("SELECT nazev FROM sablona WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM sablona WHERE id={$id};
                                            DELETE FROM element WHERE sablona={$id};
                                            DELETE FROM obsah_sablony WHERE sablona={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delsab_hlaska"], $data->nazev);
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

        case "addelem": //pridavani elementu
          $sab = $_GET["sab"];
          settype($sab, "integer");
          $type = $_GET["typ"];
          settype($type, "integer");
          $vstup = $_GET["vstup"];
          settype($vstup, "integer");

          $zakaz_datumu = ($type < 3);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addelem"],
                                              $this->VyberSablony($sab),
                                              $this->VyberTypu($type, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$sab}&amp;vstup={$vstup}"),
                                              ($type < 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_addelem_value"], "") : ""), //($type == 4 ? date("d.m.Y") : ($type == 5 ? date("H:i:s") : ($type == 6 ? date("d.m.Y H:i:s") : "")))
                                              ($type < 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_addelem_vstupni_typ"], $this->VyberVstupu($vstup, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$sab}&amp;typ={$type}")) : ""),
                                              ($vstup == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_addelem_reg_exp"]) : ""),
                                              ($type >= 4 && $type <= 6 ? $this->NactiUnikatniObsah($this->unikatni["admin_addelem_vystupni_format"], ($type == 4 ? "d.m.Y" : ($type == 5 ? "H:i:s" : "d.m.Y H:i:s"))) : ""),
                                              ($type < 3 ?$this->NactiUnikatniObsah($this->unikatni["admin_addelem_min_max_poc"]) : ""),
                                              $this->PocetRadku($sab, 1));

          $sablona = $_POST["sablona"];
          settype($sablona, "integer");
          $typ = $_POST["typ"];
          settype($typ, "integer");
          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $value = stripslashes(htmlspecialchars($_POST["value"], ENT_QUOTES));
          $input_id = stripslashes(htmlspecialchars($_POST["input_id"], ENT_QUOTES));
          $input_class = stripslashes(htmlspecialchars($_POST["input_class"], ENT_QUOTES));
          $input_akce = stripslashes(htmlspecialchars($_POST["input_akce"], ENT_QUOTES));
          $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
          $vstupni_typ = $_POST["vstupni_typ"];
          settype($vstupni_typ, "integer");
          $reg_exp = stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES));
          $vystupni_format = stripslashes(htmlspecialchars($_POST["vystupni_format"], ENT_QUOTES));
          $min_poc = $_POST["min_poc"];
          settype($min_poc, "integer");
          $max_poc = $_POST["max_poc"];
          settype($max_poc, "integer");
          $poradi = $_POST["poradi"];
          settype($poradi, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              $poradi > 0 &&
              $this->povolit_pridani)
          {
            if (@$this->sqlite->queryExec("INSERT INTO element (id, sablona, typ, nazev, value, input_id, input_class, input_akce, povinne, vstupni_typ, reg_exp, vystupni_format, min_poc, max_poc, poradi) VALUES
                                          (NULL, {$sablona}, {$typ}, '{$nazev}', '{$value}', '{$input_id}', '{$input_class}', '{$input_akce}', {$povinne}, {$vstupni_typ}, '{$reg_exp}', '{$vystupni_format}', {$min_poc}, {$max_poc}, {$poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addelem_hlaska"], $nazev);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editelem":  //uprava elementu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $sab = $_GET["sab"];
          settype($sab, "integer");
          $type = $_GET["typ"];
          settype($type, "integer");
          $vstup = $_GET["vstup"];
          settype($vstup, "integer");

          if ($res = @$this->sqlite->query("SELECT sablona, typ, nazev, value, input_id, input_class, input_akce, povinne, vstupni_typ, reg_exp, vystupni_format, min_poc, max_poc, poradi FROM element WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $sab_1 = (!Empty($sab) ? $sab : $data->sablona);
              $type_1 = (!Empty($type) ? $type : $data->typ);
              $vstup_1 = (!Empty($vstup) ? $vstup : $data->vstupni_typ);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelem"],
                                                  $this->VyberSablony($sab_1),
                                                  $this->VyberTypu($type_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$id}&amp;sab={$sab_1}&amp;vstup={$vstup_1}"),
                                                  $data->nazev,
                                                  ($type_1 < 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_editelem_value"], $data->value) : ""),
                                                  $data->input_id,
                                                  $data->input_class,
                                                  $data->input_akce,
                                                  ($data->povinne ? " checked=\"checked\"" : ""),
                                                  ($type_1 < 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_editelem_vstupni_typ"], $this->VyberVstupu($vstup_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$id}&amp;sab={$sab_1}&amp;typ={$type_1}")) : ""),
                                                  ($vstup_1 == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_editelem_reg_exp"], $data->reg_exp) : ""),
                                                  ($type_1 >= 4 && $type_1 <= 6 ? $this->NactiUnikatniObsah($this->unikatni["admin_editelem_vystupni_format"], (Empty($type) ? $data->vystupni_format : ($type_1 == 4 ? "d.m.Y" : ($type_1 == 5 ? "H:i:s" : "d.m.Y H:i:s")))) : ""),
                                                  ($type_1 < 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_editelem_min_max_poc"], $data->min_poc, $data->max_poc) : ""),
                                                  $data->poradi);

              $sablona = $_POST["sablona"];
              settype($sablona, "integer");
              $typ = $_POST["typ"];
              settype($typ, "integer");
              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $value = stripslashes(htmlspecialchars($_POST["value"], ENT_QUOTES));
              $input_id = stripslashes(htmlspecialchars($_POST["input_id"], ENT_QUOTES));
              $input_class = stripslashes(htmlspecialchars($_POST["input_class"], ENT_QUOTES));
              $input_akce = stripslashes(htmlspecialchars($_POST["input_akce"], ENT_QUOTES));
              $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
              $vstupni_typ = $_POST["vstupni_typ"];
              settype($vstupni_typ, "integer");
              $reg_exp = stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES));
              $vystupni_format = stripslashes(htmlspecialchars($_POST["vystupni_format"], ENT_QUOTES));
              $min_poc = $_POST["min_poc"];
              settype($min_poc, "integer");
              $max_poc = $_POST["max_poc"];
              settype($max_poc, "integer");
              $poradi = $_POST["poradi"];
              settype($poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $poradi > 0 &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE element SET sablona={$sablona},
                                                                  typ={$typ},
                                                                  nazev='{$nazev}',
                                                                  value='{$value}',
                                                                  input_id='{$input_id}',
                                                                  input_class='{$input_class}',
                                                                  input_akce='{$input_akce}',
                                                                  povinne={$povinne},
                                                                  vstupni_typ={$vstupni_typ},
                                                                  reg_exp='{$reg_exp}',
                                                                  vystupni_format='{$vystupni_format}',
                                                                  min_poc={$min_poc},
                                                                  max_poc={$max_poc},
                                                                  poradi={$poradi}
                                                                  WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelem_hlaska"], $nazev);
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

        case "delelem": //mazani podle id skupny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = @$this->sqlite->query("SELECT nazev FROM element WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM element WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delelem_hlaska"], $data->nazev);
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
    if ($res = @$this->sqlite->query("SELECT id, nazev, popisek FROM sablona ORDER BY nazev ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_sablona"],
                                              $data->id,
                                              $data->nazev,
                                              $data->popisek,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editsab&amp;id={$data->id}",
                                              ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_sablona_adddel_link"],
                                                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delsab&amp;id={$data->id}",
                                                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$data->id}",
                                                                                                  $data->nazev) : "")
                                              );

          if ($res1 = @$this->sqlite->query("SELECT id, nazev, value FROM element WHERE sablona={$data->id} ORDER BY poradi ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_element"],
                                                    $data1->nazev,
                                                    $data1->value,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$data1->id}",
                                                    ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_del_link"],
                                                                                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delelem&amp;id={$data1->id}",
                                                                                                        $data1->nazev) : ""));
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
