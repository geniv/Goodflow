<?php

/**
 *
 * Blok dynamicky generovanych tabulek
 *
 */

//verze modulu
define("v_DynamicTable", "1.81");

class DynamicTable extends DefaultModule
{
  private $var, $dirpath, $unikatni, $absolutni_url, $dbpredpona;
  public $idmodul = "dyntab";
  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul
  public $convmeth = array("Ajax" => "DynamicTable"); //konvert nazvu metody

  private $localpermit;

  private $valexplode = "|-x--x-|";

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);

      $this->Instalace();

      //secteni pole permission a vytvorenych sablon
      $this->permit += $this->RozsiritPermission();
      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->RozsiritAdminMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul)));
    }
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
          $result = (!Empty($adr[1]) ? $this->AdminObsahTabulky($adr[1]) : $this->AdministraceObsahu());
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
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}hlavicka (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                adresa TEXT,
                                nazev VARCHAR(200),
                                max_row INTEGER UNSIGNED,
                                zamek BOOL,
                                uradku BOOL,
                                popis TEXT,
                                sloupce TEXT,
                                defaultni TEXT,
                                popisy TEXT,
                                table_id VARCHAR(200),
                                table_class VARCHAR(200),
                                table_akce VARCHAR(500),
                                poradi INTEGER UNSIGNED);

                              CREATE TABLE {$this->dbpredpona}bunka (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                hlavicka INTEGER UNSIGNED,
                                radek TEXT,
                                bunka_id VARCHAR(200),
                                bunka_class VARCHAR(200),
                                bunka_akce VARCHAR(500),
                                pridano DATETIME,
                                upraveno DATETIME,
                                aktivni BOOL,
                                poradi INTEGER UNSIGNED);
                                ");
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
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}hlavicka ORDER BY poradi ASC;"))
    {
      $i = count($adresa);
      foreach ($res as $data) //rozsireni menu
      {
        $adresa[$i]["main_href"] = "{$this->idmodul}__{$data->id}";
        $adresa[$i]["odkaz"] = $data->nazev;
        $adresa[$i]["title"] = $data->nazev;
        $i++;
      }
    }

    return $adresa;
  }

/**
 *
 * Rozsireni pole permission na zaklade vytvorenych sablon
 *
 * @return pole vytvorenych sablon
 */
  private function RozsiritPermission()
  {
    $result = array();
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}hlavicka ORDER BY poradi ASC;"))
    {
      //vypis hlavicky
      foreach ($res as $data)
      {
        $result["{$this->idmodul}__{$data->id}"] = array("" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_vypis"], $data->nazev),
                                                        "addrow" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_addrow"], $data->nazev),
                                                        "editrow" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_editrow"], $data->nazev),
                                                        "delrow" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_delrow"], $data->nazev),
                                                        "updateradek" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_updateradek"], $data->nazev));
      }
    }

    return $result;
  }
/**
 *
 * Vykresleni tabulkem dle adresy
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicTable", "Table", "adresa"[, true|false, 1]);
 *
 * @param adresa vstupni adresa
 * @param kontrola prepinani dekodovani html znaku
 * @return vystupni galerie
 */
  public function Table($adresa, $kontrola = true, $tvar = 1)
  {
    $result = "";
    if (!Empty($adresa) &&
        !$this->DuplikatniHodnota("adresa", "hlavicka", $adresa))  //kontrola existence
    {
      $prvni = $this->EqTv($this->unikatni, "normal_vypis_table_prvni_{$tvar}", $adresa);
      $posledni = $this->EqTv($this->unikatni, "normal_vypis_table_posledni_{$tvar}", $adresa);
      $ente_def_array = $this->EqTv($this->unikatni, "normal_vypis_table_ente_def_array_{$tvar}", $adresa);
      $ente_def = $this->EqTv($this->unikatni, "normal_vypis_table_ente_def_{$tvar}", $adresa);
      $ente_od = $this->EqTv($this->unikatni, "normal_vypis_table_ente_od_{$tvar}", $adresa);
      $ente_po = $this->EqTv($this->unikatni, "normal_vypis_table_ente_po_{$tvar}", $adresa);
      $ente_po = ($ente_po == 0 ? 1 : $ente_po);  //osetreni proti delani nulou
      $ente_break = $this->EqTv($this->unikatni, "normal_vypis_table_ente_break_{$tvar}", $adresa);

      $prvni_row = $this->EqTv($this->unikatni, "normal_vypis_table_row_prvni_{$tvar}", $adresa);
      $posledni_row = $this->EqTv($this->unikatni, "normal_vypis_table_row_posledni_{$tvar}", $adresa);
      $ente_def_array_row = $this->EqTv($this->unikatni, "normal_vypis_table_row_ente_def_array_{$tvar}", $adresa);
      $ente_def_row = $this->EqTv($this->unikatni, "normal_vypis_table_row_ente_def_{$tvar}", $adresa);
      $ente_od_row = $this->EqTv($this->unikatni, "normal_vypis_table_row_ente_od_{$tvar}", $adresa);
      $ente_po_row = $this->EqTv($this->unikatni, "normal_vypis_table_row_ente_po_{$tvar}", $adresa);
      $ente_po_row = ($ente_po_row == 0 ? 1 : $ente_po_row);  //osetreni proti delani nulou
      $ente_break_row = $this->EqTv($this->unikatni, "normal_vypis_table_row_ente_break_{$tvar}", $adresa);

      //table obal begin
      $result .= $this->EqTv($this->unikatni, "normal_vypis_table_obal_begin_{$tvar}", $adresa);

      //dotaz na tabulky
      if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, popis, sloupce, table_id, table_class, table_akce
                                                FROM {$this->dbpredpona}hlavicka
                                                WHERE adresa='{$adresa}'
                                                ORDER BY poradi ASC;"))
      {
        $poci = 0;
        $poc = $this->EqTv($this->unikatni, "normal_vypis_table_begin_poc_{$tvar}", $adresa);
        //prochazeni tabulek
        foreach ($res as $data)
        {
          //dosazovani hodnot pocitani do entych
          $ente = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_table_ente_{$tvar}", $adresa),
                                            $poc);

          //podminka linearnich entych
          $podm_ente = ((($poci + $ente_od) % $ente_po) == $ente_break);
          if ($podm_ente)
          { //pocitani linearni ente
            $poc++;
          }

          //generovani hlavicky
          $sloupce = "";
          foreach (explode($this->valexplode, $data->sloupce) as $index => $polozka)
          {
            $sloupce[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_table_row_header_{$tvar}", $adresa),
                                                  ($kontrola ? html_entity_decode(html_entity_decode($polozka, NULL, "UTF-8")) : $polozka),
                                                  $index + 1);
          }
          //row obal begin - header
          $result .= $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_table_row_begin_{$tvar}", $adresa),
                                              $data->nazev,
                                              $data->popis,
                                              implode("", $sloupce),
                                              $data->table_id,
                                              $data->table_class,
                                              $data->table_akce,
                                              ($poci == 0 ? $prvni : ""),
                                              ($poci == (count($res) - 1) ? $posledni : ""),
                                              (in_array($poci, $ente_def_array) ? $ente_def : ""),
                                              ($podm_ente ? $ente : ""));

          $poci++;

          //dotaz na radku
          if ($res1 = $this->queryMultiObjectSingle("SELECT radek, bunka_id, bunka_class, bunka_akce
                                                    FROM {$this->dbpredpona}bunka
                                                    WHERE hlavicka={$data->id} AND aktivni=1
                                                    ORDER BY poradi ASC;"))
          {
            $poci_row = 0;
            $poc_row = $this->EqTv($this->unikatni, "normal_vypis_table_row_begin_poc_{$tvar}", $adresa);
            //prochazeni radku
            foreach ($res1 as $data1)
            {
              //dosazovani hodnot pocitani do entych
              $ente_row = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_table_row_ente_{$tvar}", $adresa),
                                                    $poc_row);

              //podminka linearnich entych
              $podm_ente_row = ((($poci_row + $ente_od_row) % $ente_po_row) == $ente_break_row);
              if ($podm_ente_row)
              { //pocitani linearni ente
                $poc_row++;
              }

              //generovani radku
              $bunky = "";
              foreach (explode($this->valexplode, $data1->radek) as $index => $polozka)
              {
                $bunky[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_table_bunka_{$tvar}", $adresa),
                                                    ($kontrola ? html_entity_decode(html_entity_decode($polozka, NULL, "UTF-8")) : $polozka),
                                                    $index + 1);
              }
              $result .= $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_table_row_{$tvar}", $adresa),
                                                  implode("", $bunky),
                                                  $data1->bunka_id,
                                                  $data1->bunka_class,
                                                  $data1->bunka_akce,
                                                  ($poci_row == 0 ? $prvni_row : ""),
                                                  ($poci_row == (count($res1) - 1) ? $posledni_row : ""),
                                                  (in_array($poci_row, $ente_def_array_row) ? $ente_def_row : ""),
                                                  ($podm_ente_row ? $ente_row : ""));

              $poci_row++;
            }
          }
            else
          {
            $result .= $this->EqTv($this->unikatni, "normal_vypis_table_row_null_{$tvar}", $adresa); //null
          }

          //row obal end
          $result .= $this->EqTv($this->unikatni, "normal_vypis_table_row_end_{$tvar}", $adresa);
        }
      }
        else
      {
        $result .= $this->EqTv($this->unikatni, "normal_vypis_table_null_{$tvar}", $adresa); //null
      }

      //table obal end
      $result .= $this->EqTv($this->unikatni, "normal_vypis_table_obal_end_{$tvar}", $adresa);
    }

    return $result;
  }

/**
 *
 * Vypis obsah tabulky
 *
 * @param tabulka cisla tabulky
 * @return obsah radku tabulky
 */
  private function AdminObsahTabulky($tabulka)
  {
    settype($tabulka, "integer");
    //nacteni hodnot ze sablony
    $retdata = $this->ControlObjectHodnoty(array("nazev", "popis", "max_row", "zamek", "uradku", "sloupce", "defaultni", "popisy"),
                                          array("hlavicka", $tabulka));

    $podm_add = (!$retdata->zamek && ($retdata->max_row != 0 ? $this->VypisHodnotu("COUNT(id)", "bunka", $tabulka, "hlavicka=") < $retdata->max_row : true));

    $addrow_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["addrow"];

    $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_tabulky", $tabulka),
                                        $tabulka,
                                        ($podm_add ? $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_tabulky_add", $tabulka),
                                                                              ($addrow_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$tabulka}&amp;co=addrow" : "")) : ""),
                                        $retdata->nazev,
                                        $retdata->popis,
                                        $this->AdminVypisObsahTabulky($tabulka));
//$this->EqTv($this->unikatni, "", $tabulka)
    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addrow":  //pridavani radku
          $sloupce = explode($this->valexplode, $retdata->sloupce);
          $defaultni = explode($this->valexplode, $retdata->defaultni);
          $popisy = explode($this->valexplode, $retdata->popisy);
          //generovani polozek
          $sloupec = "";
          foreach ($sloupce as $index => $polozka)
          {
            $sloupec[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditrow_head", $tabulka),
                                                  $index,
                                                  $polozka,
                                                  $defaultni[$index],
                                                  $popisy[$index]);
          }

          $default = $this->EqTv($this->unikatni, "admin_addrow_default", $tabulka);

          $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditrow", $tabulka),
                                              $this->EqTv($this->unikatni, "admin_addeditrow_add", $tabulka),
                                              $retdata->nazev,
                                              implode("", $sloupec),
                                              ($retdata->uradku ? "" : " none-i"),
                                              $default[0],
                                              $default[1],
                                              $default[2],  //7
                                              ($default[3] ? " checked=\"checked\"" : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$tabulka}");

          if ($this->ControlForm(array ("hlavicka" => array("self", "integer", $tabulka),
                                        "radek" => array("post", "array", NULL, $this->valexplode),
                                        "bunka_id" => array("post", "string"),
                                        "bunka_class" => array("post", "string"),
                                        "bunka_akce" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "aktivni" => array("post", "boolean"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "bunka", 1))),
                        (!Empty($_POST["tlacitko"]) && $podm_add),
                        array("insert", "bunka", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["radek"][0]);
            $this->AdminAddActionLog($_POST["radek"][0], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$tabulka}");  //auto kliknuti
          }
        break;

        case "editrow": //uprava radku
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT hlavicka, radek, bunka_id, bunka_class, bunka_akce, aktivni FROM {$this->dbpredpona}bunka WHERE id={$id};"))
          {
            $sloupce = explode($this->valexplode, $retdata->sloupce);
            $nactene = explode($this->valexplode, $data->radek);
            $popisy = explode($this->valexplode, $retdata->popisy);
            //generovani polozek
            $sloupec = "";
            foreach ($sloupce as $index => $polozka)
            {
              $sloupec[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditrow_head", $tabulka),
                                                    $index,
                                                    $polozka,
                                                    $nactene[$index],
                                                    $popisy[$index]);
            }

            $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditrow", $tabulka),
                                                $this->EqTv($this->unikatni, "admin_addeditrow_edit", $tabulka),
                                                $retdata->nazev,
                                                implode("", $sloupec),
                                                ($retdata->uradku ? "" : " none-i"),
                                                $data->bunka_id,
                                                $data->bunka_class,
                                                $data->bunka_akce,
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$tabulka}");

            if ($this->ControlForm(array ("hlavicka" => array("self", "integer", $tabulka),
                                          "radek" => array("post", "array", NULL, $this->valexplode),
                                          "bunka_id" => array("post", "string"),
                                          "bunka_class" => array("post", "string"),
                                          "bunka_akce" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now"),
                                          "aktivni" => array("post", "boolean")),
                          (!Empty($_POST["tlacitko"]) && $id > 0),
                          array("update", "bunka", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["radek"][0]);
              $this->AdminAddActionLog($_POST["radek"][0], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$tabulka}");  //auto kliknuti
            }
          }
        break;

        case "delrow":  //mazani radku
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array ("bunka" => array("id", $id, "radek")), $nazev))
          {
            $naz = explode($this->valexplode, $nazev);
            $result = $this->Hlaska("edit", $naz[0]);
            $this->AdminAddActionLog($naz[0], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$tabulka}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis obsahu tabulky
 *
 * @param tabulka cislo tabulky
 * @return vypis obsahu
 */
  private function AdminVypisObsahTabulky($tabulka)
  {
    settype($tabulka, "integer");

    $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_tabulky_begin", $tabulka),
                                        $this->dirpath);

    //nacteni hodnot ze sablony
    $retdata = $this->ControlObjectHodnoty(array("zamek", "sloupce"),
                                          array("hlavicka", $tabulka));

    $tvar_datum = $this->EqTv($this->unikatni, "admin_vypis_obsah_tabulky_tvar_datum", $tabulka);
    $sep = $this->EqTv($this->unikatni, "admin_vypis_obsah_tabulky_sep", $tabulka);

    $editrow_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editrow"];
    $delrow_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delrow"];

    //nacteni pole sloupcu
    $sloupce = explode($this->valexplode, $retdata->sloupce);
    if ($res = $this->queryMultiObjectSingle("SELECT id, radek, bunka_id, bunka_class, bunka_akce, pridano, upraveno, aktivni
                                              FROM {$this->dbpredpona}bunka
                                              WHERE hlavicka={$tabulka} ORDER BY poradi ASC;"))
    {
      //vypis radku
      foreach ($res as $data)
      {
        $radek = implode($sep, explode($this->valexplode, $data->radek));
        $result .= $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_tabulky", $tabulka),
                                            $data->id,
                                            $radek,
                                            date($tvar_datum, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : $this->EqTv($this->unikatni, "admin_vypis_obsah_tabulky_neupraveno", $tabulka)),
                                            ($data->aktivni ? " checked=\"checked\"" : ""),
                                            ($editrow_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$tabulka}&amp;co=editrow&amp;id={$data->id}" : ""),
                                            (!$retdata->zamek ? $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_tabulky_del", $tabulka),
                                                                                          $data->id,
                                                                                          ($delrow_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$tabulka}&amp;co=delrow&amp;id={$data->id}" : "")) : "")
                                            );
      }
    }
      else
    {
      $result .= $this->EqTv($this->unikatni, "admin_vypis_obsah_tabulky_null", $tabulka); //null
    }

    $result .= $this->EqTv($this->unikatni, "admin_vypis_obsah_tabulky_end", $tabulka);

    return $result;
  }

/**
 *
 * Hlavni administrace obsahu modulu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addtab"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addtab" : ""),
                                        $this->AdminVypisObsahu());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addtab":  //pridavani tabulky
          $default = $this->unikatni["admin_addtab_default"];

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addedittab"],
                                              $this->dirpath,
                                              $default[0],
                                              (!Empty($default[1]) ? implode("|', '|", $default[1]) : ""),
                                              (!Empty($default[2]) ? implode("|', '|", $default[2]) : ""),
                                              (!Empty($default[3]) ? implode("|', '|", $default[3]) : ""),
                                              $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                              $this->unikatni["admin_addedittab_add"],  //7
                                              $default[4],  //8
                                              $default[5],
                                              $default[6],
                                              $default[7],  //11
                                              ($default[8] ? " checked=\"checked\"" : ""),  //12
                                              ($default[9] ? " checked=\"checked\"" : ""),
                                              $default[10], //14
                                              $default[11],
                                              $default[12],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("adresa" => array("post", "string"),
                                        "nazev" => array("post", "string"),
                                        "max_row" => array("post", "integer"),
                                        "zamek" => array("post", "boolean"),
                                        "uradku" => array("post", "boolean"),
                                        "popis" => array("post", "string"),
                                        "sloupce" => array("post", "array", NULL, $this->valexplode),
                                        "defaultni" => array("post", "array", NULL, $this->valexplode),
                                        "popisy" => array("post", "array", NULL, $this->valexplode),
                                        "table_id" => array("post", "string"),
                                        "table_class" => array("post", "string"),
                                        "table_akce" => array("post", "string"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "hlavicka", 1))),
                        (!Empty($_POST["tlacitko"]) && !Empty($_POST["adresa"]) && !Empty($_POST["nazev"])),
                        array("insert", "hlavicka", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["nazev"]);
            $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "edittab": //uprava tabulky
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT adresa, nazev, max_row, zamek, uradku, popis, sloupce, defaultni, popisy, table_id, table_class, table_akce FROM {$this->dbpredpona}hlavicka WHERE id={$id};"))
          {
            $slo = explode($this->valexplode, $data->sloupce);
            $def = explode($this->valexplode, $data->defaultni);
            $pop = explode($this->valexplode, $data->popisy);

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addedittab"],
                                                $this->dirpath,
                                                count($def),
                                                (!Empty($slo) ? implode("|', '|", $slo) : ""),
                                                (!Empty($def) ? implode("|', '|", $def) : ""),
                                                (!Empty($pop) ? implode("|', '|", $pop) : ""),
                                                $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                                $this->unikatni["admin_addedittab_edit"],
                                                $data->adresa,  //8
                                                $data->nazev,
                                                $data->popis,
                                                $data->max_row,
                                                ($data->zamek ? " checked=\"checked\"" : ""),
                                                ($data->uradku ? " checked=\"checked\"" : ""),
                                                $data->table_id,
                                                $data->table_class,
                                                $data->table_akce,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("adresa" => array("post", "string"),
                                          "nazev" => array("post", "string"),
                                          "max_row" => array("post", "integer"),
                                          "zamek" => array("post", "boolean"),
                                          "uradku" => array("post", "boolean"),
                                          "popis" => array("post", "string"),
                                          "sloupce" => array("post", "array", NULL, $this->valexplode),
                                          "defaultni" => array("post", "array", NULL, $this->valexplode),
                                          "popisy" => array("post", "array", NULL, $this->valexplode),
                                          "table_id" => array("post", "string"),
                                          "table_class" => array("post", "string"),
                                          "table_akce" => array("post", "string")),
                          (!Empty($_POST["tlacitko"]) && !Empty($_POST["adresa"]) && !Empty($_POST["nazev"]) && $id > 0),
                          array("update", "hlavicka", $id),
                          $error))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "deltab":  //mazani tabulky
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array ("hlavicka" => array("id", $id, "nazev"),
                                              "bunka" => array("hlavicka")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis administrace tabulek
 *
 * @return vypis sablon tabulek
 */
  private function AdminVypisObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_begin"],
                                        $this->dirpath);

    $edittab_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["edittab"];
    $deltab_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["deltab"];

    if ($res = $this->queryMultiObjectSingle("SELECT id, adresa, nazev, max_row, zamek, popis, sloupce, defaultni, popisy FROM {$this->dbpredpona}hlavicka ORDER BY poradi ASC;"))
    {
      $sep = $this->unikatni["admin_vypis_obsah_sep"];  //separator
      //vypis tabulek
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            $data->id,
                                            $data->adresa,
                                            $data->nazev,
                                            $data->max_row,
                                            ($data->zamek ? " checked=\"checked\"" : ""),
                                            $data->popis,
                                            implode($sep, explode($this->valexplode, $data->sloupce)),
                                            implode($sep, explode($this->valexplode, $data->defaultni)),
                                            implode($sep, explode($this->valexplode, $data->popisy)), //9
                                            ($edittab_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edittab&amp;id={$data->id}" : ""),
                                            ($deltab_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deltab&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_obsah_null"]; //null
    }

    $result .= $this->unikatni["admin_vypis_obsah_end"];

    return $result;
  }


}
?>
