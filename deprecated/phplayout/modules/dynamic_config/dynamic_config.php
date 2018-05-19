<?php

/**
 *
 * Blok dynamicke konfigurace
 *
 */

//verze modulu
define("v_DynamicConfig", "2.11");

class DynamicConfig extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona;
  public $idmodul = "pattern";  //id pro rozliseni modulu v adminu
  private $idsort = "_sort";
  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php");
  public $generated = array("script/ajax.js"); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul
  public $convmeth = array("Ajax" => "DynamicConfig");  //konvert nazvu metody

  private $localpermit;

  private $cfgexplode = "|--xx--|";
  private $typ_hodnot;

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul, $this->idsort);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      $this->typ_hodnot = $this->unikatni["set_typ_hodnot"];

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->adress[0],
                                                $this->adress[1]);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);

      $this->Instalace();

      //secteni pole permission a vytvorenych sablon
      $this->permit += $this->RozsiritPermission();
      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->RozsiritAdminMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->adress[0],
                                                        $this->UmelyTitle(),
                                                        $this->adress[1])));
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
          $result = (!Empty($adr[1]) ? $this->AdminObsahSablony($adr[1]) : $this->AdministraceObsahu());
        break;

        case "{$this->idmodul}{$this->idsort}": //razeni menu
          $result = $this->AdminiVypisRazeniMenu();
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
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}sablona (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                adresa TEXT,
                                nazev VARCHAR(200),
                                popis TEXT,
                                poradi INTEGER UNSIGNED);

                              CREATE TABLE {$this->dbpredpona}element (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                sablona INTEGER UNSIGNED,
                                adresa TEXT,
                                nazev VARCHAR(200),
                                typ VARCHAR(50),
                                konfigurace TEXT,
                                value TEXT,
                                zamek BOOL,
                                popis TEXT,
                                pridano DATETIME,
                                upraveno DATETIME,
                                poradi INTEGER UNSIGNED);
                                ");

    //preinstalace dat
    $this->ControlPreInstall($this->unikatni["control_preinstall"],
                            array($this->cfgexplode, date("Y-m-d H:i:s")));
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
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
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
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      //vypis sablon
      foreach ($res as $data)
      {
        $result["{$this->idmodul}__{$data->id}"] = array ("" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_vypis"], $data->nazev),
                                                          "savevalue" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_uprava_hodnot"], $data->nazev));
      }
    }

    return $result;
  }

/**
 *
 * Vygeneruje umely title dle zvolene sekce
 *
 * @return novy title do admin menu
 */
  private function UmelyTitle()
  {
    $co = $this->NotEmpty("get", "co");

    switch ($co)
    {
      case "copysab": //duplikace sablony
      case "editsab": //uprava sablony
        $result = $this->VypisHodnotu("nazev", "sablona", $_GET["id"]);
      break;

      case "copyelem": //duplikace elementu
        $result = $this->VypisHodnotu("nazev", "sablona", $_GET["id"]);
      break;

      case "addelem":  //pridani elementu
        $result = $this->VypisHodnotu("nazev", "sablona", $_GET["sab"]);
      break;

      case "editelem": //uprava elementu
        $id = $_GET["id"];
        settype($id, "integer");
        //zjisteni cisla skupiny z obsahu a dosazeni do skupiny
        $result = $this->VypisHodnotu("nazev", "sablona", $this->VypisHodnotu("sablona", "element", $id));
      break;

      default:  //defaultni vyber
        $result = $this->unikatni["admin_default_title"];
      break;
    }

    return $result;
  }

/**
 *
 * Objektovy vystup jedne promenne
 *
 * $prom = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigSingle", "sablona", "adresa"[, false]);
 * ($prom->absolutni_url, $prom->adresa)
 *
 * @param adr_sablona adresa sablony
 * @param adresa adresa prvku v sablone
 * @param konvert bool na prevod entit, defaultne false = vraci primo to co je v db
 * @return objekt promenne
 */
  public function ObjectConfigSingle($adr_sablona, $adresa, $konvert = false)
  {
    if ($this->ControlIsPreInstall())
    {
      $result->absolutni_url = $this->absolutni_url;
      if ($data = $this->querySingleRow("SELECT value FROM {$this->dbpredpona}sablona s, {$this->dbpredpona}element e WHERE s.adresa='{$adr_sablona}' AND s.id=e.sablona AND e.adresa='{$adresa}';"))
      {
        $result->$adresa = ($konvert ? html_entity_decode(html_entity_decode($data->value, NULL, "UTF-8")) : $data->value);
      }
    }

    return $result;
  }

/**
 *
 * Objektovy vystup skupiny promennych z dane adresy sablony
 *
 * $prom = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "adresa"[, false]);
 * ($prom->absolutni_url, $prom->adr1, $prom->adr2, ...)
 *
 * @param adr_sablona adresa sablony
 * @param konvert bool na prevod entit, defaultne false = vraci primo to co je v db
 * @return objekt promennych
 */
  public function ObjectConfigGroup($adr_sablona, $konvert = false)
  {
    $result = (object)"";
    if ($this->ControlIsPreInstall())
    {
      $result->absolutni_url = $this->absolutni_url;
      if ($res = $this->queryMultiObjectSingle("SELECT e.adresa adresa, value FROM {$this->dbpredpona}sablona s, {$this->dbpredpona}element e WHERE s.id=e.sablona AND s.adresa='{$adr_sablona}';"))
      {
        //generovani hodnot do objektu
        foreach ($res as $data)
        {
          $adr = $data->adresa;
          $result->$adr = ($konvert ? html_entity_decode(html_entity_decode($data->value, NULL, "UTF-8")) : $data->value);
        }
      }
    }

    return $result;
  }

/**
 *
 * Klasicky vystup promenne
 *
 * $prom = $this->var->main[0]->NactiFunkci("DynamicConfig", "ConfigSingle", "sablona", "adresa"[, false]);
 * ($prom)
 *
 * @param adr_sablona adresa sablony
 * @param adresa adresa prvku v sablone
 * @param konvert bool na prevod entit, defaultne false = vraci primo to co je v db
 * @return klasicka hodnota promenne
 */
  public function ConfigSingle($adr_sablona, $adresa, $konvert = false)
  {
    if ($this->ControlIsPreInstall())
    {
      $result = "";
      if ($data = $this->querySingleRow("SELECT value FROM {$this->dbpredpona}sablona s, {$this->dbpredpona}element e WHERE s.adresa='{$adr_sablona}' AND s.id=e.sablona AND e.adresa='{$adresa}';"))
      {
        $result = ($konvert ? html_entity_decode(html_entity_decode($data->value, NULL, "UTF-8")) : $data->value);
      }
    }

    return $result;
  }

/**
 *
 * Klasicky vystup bloku s jiz aplikovanymi promennymi
 *
 * $prom = $this->var->main[0]->NactiFunkci("DynamicConfig", "ConfigGroup", "adresa"[, false, array("adrpridavek" => "pridavek", ) 1]);
 * ($prom)
 *
 * @param adr_sablona adresa sablony
 * @param konvert bool na prevod entit, defaultne false = vraci primo to co je v db
 * @param pridavek pole na pridani externich promennych: array("klic" => "hodnota", ...)
 * @param tvar cislo tvaru
 * @return blok textu s aplikovanymi promennymi
 */
  public function ConfigGroup($adr_sablona, $konvert = false, $pridavek = NULL, $tvar = 1)
  {
    if ($this->ControlIsPreInstall())
    {
      $result = "";
      if ($res = $this->queryMultiObjectSingle("SELECT e.adresa adresa, value FROM {$this->dbpredpona}sablona s, {$this->dbpredpona}element e WHERE s.id=e.sablona AND s.adresa='{$adr_sablona}';"))
      {
        //generovani hodnot
        $search[] = "@@absolutni_url@@";
        $replace[] = $this->absolutni_url;
        foreach ($res as $data)
        { //($kontrola ? $special : html_entity_decode(html_entity_decode($data->hodnota, ENT_QUOTES, "UTF-8")))
          //nacitani nahrazovaciho pole
          $search[] = "@@{$data->adresa}@@";
          $replace[] = ($konvert ? html_entity_decode(html_entity_decode($data->value, NULL, "UTF-8")) : $data->value);
        }
        //aplikace pridavku, vytahaji se klice a hodnoty ktere se pak sectou s hlavnim polem (nove duplikatni prepisou stare)
        if (is_array($pridavek))
        {
          $search = array_merge($search, array_keys($pridavek));
          $replace = array_merge($replace, array_values($pridavek));
        }

        //zpracovani textu nahrazovacim polem
        $result = str_replace($search, $replace, $this->EqTv($this->unikatni, "normal_config_group_{$tvar}", $adresa));
      }
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
  private function AdminObsahSablony($id)
  {
    settype($id, "integer");
    //hodnoty se zamkem se schovavaji
    if ($data = $this->querySingleRow("SELECT id, nazev, popis FROM {$this->dbpredpona}sablona WHERE id={$id};"))
    {
      if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, typ, konfigurace, value, popis FROM {$this->dbpredpona}element WHERE sablona={$data->id} AND zamek=0 ORDER BY poradi ASC;"))
      {
        //vypis elementu
        $ret = array();
        foreach ($res as $data1)
        { //vykreslovani podle typu
          switch ($data1->typ)
          {
            case "number":
              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_number", $id),
                                                $data1->id,
                                                $data1->konfigurace,
                                                $data1->nazev,  //3
                                                $data1->value,
                                                $data1->popis);
            break;

            case "alphanumeric":
              $konfigurace = explode($this->cfgexplode, $data1->konfigurace);
              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_alphanumeric", $id),
                                                $data1->id,
                                                $konfigurace[0],
                                                $konfigurace[1],
                                                $konfigurace[2],
                                                $konfigurace[3],
                                                $konfigurace[4],
                                                $data1->nazev,  //7
                                                $data1->value,
                                                $data1->popis);
            break;

            case "minitext":
            case "color":
              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_{$data1->typ}", $id),
                                                $data1->id,
                                                $data1->nazev,  //2
                                                $data1->value,
                                                $data1->popis);
            break;

            case "fulltext":
              $konfigurace = explode($this->cfgexplode, $data1->konfigurace);
              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_fulltext", $id),
                                                $data1->id,
                                                $konfigurace[0],
                                                $konfigurace[1],
                                                $data1->nazev,  //4
                                                $data1->value,
                                                $data1->popis);
            break;

            case "wymeditor": //mozna prijde vyhodit a nebo predelat do jineho
              //nechano samo v pripade dalsi zozsireni konfigurace
              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_wymeditor", $id),
                                                $data1->id,
                                                $data1->nazev,  //2
                                                $data1->value,
                                                $data1->popis);
            break;

            case "tinymce":
              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_tinymce", $id),
                                                $data1->id,
                                                $this->dirpath,
                                                $data1->nazev,  //3
                                                $data1->value,
                                                $data1->popis);
            break;

            case "slider":
              $konfigurace = explode($this->cfgexplode, $data1->konfigurace);
              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_slider", $id),
                                                $data1->id,
                                                $konfigurace[0],
                                                $konfigurace[1],
                                                $konfigurace[2],
                                                $konfigurace[3],
                                                $konfigurace[4],
                                                $konfigurace[5],
                                                $konfigurace[6],
                                                $konfigurace[7],
                                                $data1->nazev,  //10
                                                $data1->value,
                                                $data1->popis);
            break;

            case "checkbox":
              $konfigurace = explode($this->cfgexplode, $data1->konfigurace);
              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_checkbox", $id),
                                                $data1->id,
                                                ($data1->value == $konfigurace[0] ? " checked=\"checked\"" : ""),
                                                $konfigurace[0],  //3
                                                $konfigurace[1],
                                                $data1->nazev,  //5
                                                $data1->value,
                                                $data1->popis);
            break;

            case "checkgroup":
              $konfigurace = explode($this->cfgexplode, $data1->konfigurace);
              list($pop, $val) = $this->RozdelitHodnoty($konfigurace, 2, 2);
              //parsnuti hodnot
              $value = explode($this->cfgexplode, $data1->value);
              $row = array();
              for ($i = 0; $i < $konfigurace[1]; $i++)
              {
                $rozhod = explode($this->unikatni["admin_checkgroup_sep"], $val[$i]); //rozdeleni na on a off
                $podm = (($i + 1) == $konfigurace[0]);
                $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_{$data1->typ}_row", $id),
                                                  $i,
                                                  $data1->id,
                                                  $pop[$i], //3
                                                  ($value[$i] == $rozhod[0] ? $rozhod[0] : $rozhod[1]),
                                                  ($value[$i] == $rozhod[0] ? " checked=\"checked\"" : ""),
                                                  ($podm ? $this->EqTv($this->unikatni, "admin_obsah_element_{$data1->typ}_zalomeni", $id) : ""));
              }

              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_{$data1->typ}", $id),
                                                $data1->id,
                                                implode("", $row),
                                                $data1->nazev,  //3
                                                $data1->popis);
            break;

            case "radio":
            case "select":
            case "stars2":
              $konfigurace = explode($this->cfgexplode, $data1->konfigurace);
              list($pop, $val) = $this->RozdelitHodnoty($konfigurace, 2, 2);
              //detekce selectu
              $select = ($data1->typ == "select");
              //lamat vsude krom selectu
              $lom = ($data1->typ != "select" ? $this->EqTv($this->unikatni, "admin_obsah_element_{$data1->typ}_zalomeni", $id) : "");
              $row = array();
              for ($i = 0; $i < $konfigurace[1]; $i++)
              {
                $podm = (($i + 1) == $konfigurace[0]);
                $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_{$data1->typ}_row", $id),
                                                  $i,
                                                  $data1->id,
                                                  $pop[$i], //3
                                                  $val[$i],
                                                  ($data1->value == $val[$i] ? ($select ? " selected=\"selected\"" : " checked=\"checked\"") : ""),
                                                  ($podm ? $lom : ""),
                                                  $konfigurace[0]); //nebo split
              }

              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_{$data1->typ}", $id),
                                                $data1->id,
                                                implode("", $row),
                                                $data1->nazev,  //3
                                                $data1->popis);
            break;

            case "stars":
              $konfigurace = explode($this->cfgexplode, $data1->konfigurace);
              $row = array();
              foreach (range($konfigurace[0], $konfigurace[1]) as $polozka)
              {
                $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_stars_row", $id),
                                                  $data1->id,
                                                  $polozka,
                                                  $konfigurace[2],  //split
                                                  ($data1->value == $polozka ? " checked=\"checked\"" : ""));
              }

              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_stars", $id),
                                                $data1->id,
                                                implode("", $row),
                                                $data1->nazev,  //3
                                                $data1->popis);
            break;

            case "header":
            case "specheader":
              $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_element_{$data1->typ}", $id),
                                                $data1->id,
                                                $data1->nazev,  //2
                                                $data1->popis);
            break;
          }
        }
      }
        else
      {
        $ret[] = $this->EqTv($this->unikatni, "admin_obsah_element_null", $id); //null
      }

      $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_sablona", $id),
                                          "{$this->dirpath}/{$this->generated[0]}",
                                          $this->dirpath,
                                          $data->nazev,
                                          $data->popis,
                                          implode("", $ret));
    }
      else
    {
      $result = $this->EqTv($this->unikatni, "admin_obsah_sablona_null", $id); //null
    }

    return $result;
  }

/**
 *
 * Vyber sablony
 *
 * @param id identifikator sablony, nepovinne
 * @return vyber sablon
 */
  private function VyberSablony($id = NULL)
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, adresa, nazev FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      $result = $this->unikatni["admin_vyber_sablony_begin"];
      //vypis sablon
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony"],
                                            $data->id,
                                            ($id == $data->id ? " selected=\"selected\"" : ""),
                                            $data->nazev,
                                            $data->adresa);
      }
      $result .= $this->unikatni["admin_vyber_sablony_end"];
    }
      else
    {
      $result = $this->unikatni["admin_vyber_sablony_null"]; //null
    }

    return $result;
  }

/**
 *
 * Vyber typu
 *
 * @param id id polozky typu, nepovinne
 * @param adresa adresa pro navrat spravne stranky, nepovinne
 * @param konfigurace pole nastaveni jednotlivych prvku
 * @return vyber typu s konfiguraci
 */
  private function VyberTypu($id, $adresa, $konfigurace = NULL)
  {
    $ret = array();
    foreach ($this->typ_hodnot as $index => $hodnota)
    {
      $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_row"],
                                          $index,
                                          ($id == $index ? " selected=\"selected\"" : ""),
                                          $hodnota);
    }
    //konfigurace typu
    $res = array();
    switch ($id)
    {
      case "number":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_number_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);
        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_number"],
                                          $hodnota[0]);
      break;

      case "alphanumeric":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_alphanumeric_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);
        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_alphanumeric"],
                                          ($hodnota[0] == "alphanumeric" ? " checked=\"checked\"" : ""),
                                          ($hodnota[0] == "alpha" ? " checked=\"checked\"" : ""),
                                          ($hodnota[0] == "numeric" ? " checked=\"checked\"" : ""),
                                          $hodnota[1],
                                          $hodnota[2],
                                          ($hodnota[3] == "true" ? " checked=\"checked\"" : ""),
                                          ($hodnota[3] == "false" ? " checked=\"checked\"" : ""),
                                          ($hodnota[4] == "true" ? " checked=\"checked\"" : ""),
                                          ($hodnota[4] == "false" ? " checked=\"checked\"" : ""));
      break;

      case "minitext":
      case "wymeditor":
      case "tinymce":
      case "color":
      case "header":
      case "specheader":
        $res[] = $this->unikatni["admin_vyber_typu_empty"];
      break;

      case "fulltext":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_fulltext_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);
        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_fulltext"],
                                          $hodnota[0],
                                          $hodnota[1]);
      break;

      case "slider":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_slider_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);
        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_slider"],
                                          $hodnota[0],
                                          $hodnota[1],
                                          $hodnota[2],
                                          $hodnota[3],
                                          $hodnota[4],
                                          ($hodnota[5] == "true" ? " checked=\"checked\"" : ""),
                                          ($hodnota[5] == "false" ? " checked=\"checked\"" : ""),
                                          $hodnota[6],
                                          ($hodnota[7] == "blue" ? " checked=\"checked\"" : ""),
                                          ($hodnota[7] == "plastic" ? " checked=\"checked\"" : ""),
                                          ($hodnota[7] == "round" ? " checked=\"checked\"" : ""),
                                          ($hodnota[7] == "round_plastic" ? " checked=\"checked\"" : ""));
      break;

      case "checkbox":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_checkbox_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);
        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_checkbox"],
                                          $hodnota[0],
                                          $hodnota[1]);
      break;

      case "radio":
      case "select":
      case "checkgroup":
      case "stars2":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_radio_default"];
        }
        $roz_mozn = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);
        list($pop, $val) = $this->RozdelitHodnoty($roz_mozn, 2, 2);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_radio"],
                                          $this->dirpath,
                                          $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                          $id,
                                          (!Empty($roz_mozn[1]) ? $roz_mozn[1] : 2),  //pocet
                                          (!Empty($pop) ? html_entity_decode(implode("|', '|", $pop), NULL, "UTF-8") : ""), //popis
                                          (!Empty($val) ? html_entity_decode(implode("|', '|", $val), NULL, "UTF-8") : ""), //value
                                          $roz_mozn[0]);
      break;

      case "stars":
        if (Empty($konfigurace))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_stars_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);
        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_stars"],
                                          $hodnota[0],
                                          $hodnota[1],
                                          $hodnota[2]);
      break;

      default:
        $res[] = $this->unikatni["admin_vyber_typu_null"];
      break;
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu"],
                                        $adresa,
                                        implode("", $ret),
                                        "{$this->dirpath}/preview",
                                        $id,
                                        implode("", $res));

    return $result;
  }

/**
 *
 * Vygenerovani ajax scriptu pro web
 *
 */
  public function VygenerujAjaxScript()
  {
    $cesta = "{$this->dirpath}/{$this->generated[0]}"; //cesta ajaxu
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        $this->dirpath,
                                        $this->AjaxJQueryKonverze(NULL, array("value", "roz")));

      $result = $this->ControlWriteFile(array($cesta => $obsah));
    }

    return $result;
  }

/**
 *
 * Hlavni administrace configu
 *
 * @return obsluha configu
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addsab"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addsab" : ""),
                                        $this->AdminVypisObsahu());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addsab":  //pridavani sablony
        case "copysab": //duplikace sablony
          $val_adresa = $val_nazev = $val_popis = "";
          $podm_copy = ($co == "copysab");
          if ($podm_copy)
          {
            $id = $_GET["id"];
            settype($id, "integer");

            //nacita hodnoty z kopirovane sablony
            if ($data = $this->querySingleRow("SELECT adresa, nazev, popis FROM {$this->dbpredpona}sablona WHERE id={$id};"))
            {
              $val_adresa = $data->adresa;
              $val_nazev = $data->nazev;
              $val_popis = $data->popis;
            }
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditsab"],
                                              $this->unikatni["admin_addeditsab_add"],
                                              $val_adresa,
                                              $val_nazev,
                                              $val_popis,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("adresa" => array("post", "string"),
                                        "nazev" => array("post", "string"),
                                        "popis" => array("post", "string"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "sablona", 1))),
                        (!Empty($_POST["tlacitko"]) && !Empty($_POST["adresa"]) && !Empty($_POST["nazev"]) && $this->DuplikatniHodnota("adresa", "sablona", $_POST["adresa"])),
                        array("insert", "sablona", NULL)))
          {
            if ($podm_copy)
            {
              //kopirovani elementu
              if ($this->ControlForm(array ("sablona" => array("self|copy", "integer", $this->lastInsertRowid()),
                                            "adresa" => array("copy", "string"),
                                            "nazev" => array("copy", "string"),
                                            "typ" => array("copy", "string"),
                                            "konfigurace" => array("copy", "string"),
                                            "value" => array("copy", "string"),
                                            "zamek" => array("copy", "boolean"),
                                            "popis" => array("copy", "string"),
                                            "pridano" => array("self", "date", "now"),
                                            "poradi" => array("copy", "integer")),
                                    true,
                                    array("copy", "element", $id)))
              {
                //pokud se podari zkopirovat
                $result = $this->Hlaska("copy", $_POST["nazev"]);
              }
            }
              else
            {
              $result = $this->Hlaska("add", $_POST["nazev"]);
            }
            $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editsab":  //uprava sablony
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT adresa, nazev, popis FROM {$this->dbpredpona}sablona WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditsab"],
                                                $this->unikatni["admin_addeditsab_edit"],
                                                $data->adresa,
                                                $data->nazev,
                                                $data->popis,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("adresa" => array("post", "string"),
                                          "nazev" => array("post", "string"),
                                          "popis" => array("post", "string")),
                          (!Empty($_POST["tlacitko"]) && !Empty($_POST["adresa"]) && !Empty($_POST["nazev"]) && $id > 0),
                          array("update", "sablona", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "delsab": //mazani sablony
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array ("sablona" => array("id", $id, "nazev"),
                                              "element" => array("sablona")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;


        case "addelem": //pridavani elementu
        case "copyelem": //duplikace elementu
          $val_sablona = $val_adresa = $val_nazev = $val_typ = $val_konfigurace = $val_value = $val_zamek = $val_popis = "";
          $podm_copy = ($co == "copyelem");
          if ($podm_copy)
          {
            $id = $_GET["id"];
            settype($id, "integer");

            //nacita hodnoty z kopirovaneho elementu
            if ($data = $this->querySingleRow("SELECT sablona, adresa, nazev, typ, konfigurace, value, zamek, popis FROM {$this->dbpredpona}element WHERE id={$id};"))
            {
              $val_sablona = $data->sablona;
              $val_adresa = $data->adresa;
              $val_nazev = $data->nazev;
              $val_typ = $data->typ;
              $val_konfigurace = explode($this->cfgexplode, $data->konfigurace);
              $val_value = $data->value;
              $val_zamek = $data->zamek;
              $val_popis = $data->popis;
            }
          }

          if (!Empty($_POST["tlacitko"]))
          {
            $val_sablona = $_POST["sablona"];
            $val_adresa = $_POST["adresa"];
            $val_nazev = $_POST["nazev"];
            //konfigurace si vraci data sama
            $val_value = $_POST["value"];
            $val_zamek = $_POST["zamek"];
            $val_popis = $_POST["popis"];
          }

          $sab = (!Empty($_GET["sab"]) ? $_GET["sab"] : $val_sablona);
          settype($sab, "integer");
          $typ = (!Empty($_GET["typ"]) ? $_GET["typ"] : $val_typ);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem"],
                                              $this->unikatni["admin_addeditelem_add"],
                                              $this->VypisHodnotu("nazev", "sablona", $sab),
                                              $this->VyberSablony($sab),
                                              $val_adresa,
                                              $val_nazev,
                                              $this->VyberTypu($typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;sab={$sab}", $val_konfigurace),
                                              $val_value,
                                              ($val_zamek ? " checked=\"checked\"" : ""),
                                              $val_popis,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("sablona" => array("post", "string"),
                                        "adresa" => array("post", "string"),
                                        "nazev" => array("post", "string"),
                                        "typ" => array("post", "string"),
                                        "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                        "value" => array("post", "string"),
                                        "zamek" => array("post", "boolean"),
                                        "popis" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "element", 1))),
                        (!Empty($_POST["tlacitko"]) && !Empty($_POST["sablona"]) && !Empty($_POST["adresa"]) && !Empty($_POST["nazev"]) && !Empty($_POST["typ"]) && $this->DuplikatniHodnota("adresa", "element", $_POST["adresa"], "sablona='{$sab}' AND ")),
                        array("insert", "element", NULL)))
          {
            $result = $this->Hlaska(($podm_copy ? "copy" : "add"), $_POST["nazev"]);
            $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editelem":  //uprava elementu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT sablona, adresa, nazev, typ, konfigurace, value, zamek, popis FROM {$this->dbpredpona}element WHERE id={$id};"))
          {
            $typ = (!Empty($_GET["typ"]) ? $_GET["typ"] : $data->typ);

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem"],
                                                $this->unikatni["admin_addeditelem_edit"],
                                                $this->VypisHodnotu("nazev", "sablona", $data->sablona),
                                                $this->VyberSablony($data->sablona),
                                                $data->adresa,
                                                $data->nazev,
                                                $this->VyberTypu($typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;id={$id}", explode($this->cfgexplode, $data->konfigurace)),
                                                $data->value,
                                                ($data->zamek ? " checked=\"checked\"" : ""),
                                                $data->popis,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("sablona" => array("post", "string"),
                                          "adresa" => array("post", "string"),
                                          "nazev" => array("post", "string"),
                                          "typ" => array("post", "string"),
                                          "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                          "value" => array("post", "string"),
                                          "zamek" => array("post", "boolean"),
                                          "popis" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now")),
                          (!Empty($_POST["tlacitko"]) && !Empty($_POST["sablona"]) && !Empty($_POST["adresa"]) && !Empty($_POST["nazev"]) && !Empty($_POST["typ"]) && $id > 0),
                          array("update", "element", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "delelem": //mazani elementu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("element" => array("id", $id, "nazev")), $nazev))
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
 * Rychlo vypis menu se scroll odkazy
 *
 * @return odkazy do menu
 */
  private function AdminVypisScrollTo()
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      //vypis sablon pro scrollto
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_scrollto"],
                                            $data->id,
                                            $data->nazev);
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_scrollto_null"]; //null
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
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_begin"],
                                        $this->dirpath,
                                        $this->AdminVypisScrollTo());

    $tvar_datum = $this->unikatni["admin_vypis_tvar_datum"];
    $addelem_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["addelem"];
    $copysab_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["copysab"];
    $editsab_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editsab"];
    $delsab_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delsab"];

    $copyelem_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["copyelem"];
    $editelem_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editelem"];
    $delelem_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delelem"];

    if ($res = $this->queryMultiObjectSingle("SELECT id, adresa, nazev FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      //vypis sablon
      foreach ($res as $data)
      {
        //generovani elementu
        $element = "";
        if ($res1 = $this->queryMultiObjectSingle("SELECT id, adresa, nazev, typ, konfigurace, value, zamek, popis, pridano, upraveno FROM {$this->dbpredpona}element WHERE sablona={$data->id} ORDER BY poradi ASC;"))
        {
          //vypis elementu
          foreach ($res1 as $data1)
          {
            $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_element"],
                                                  $data1->id,
                                                  $data1->adresa,
                                                  $data1->nazev,
                                                  $this->typ_hodnot[$data1->typ],
                                                  $this->ZkraceniTextu(htmlspecialchars(html_entity_decode($data1->value, ENT_QUOTES, "UTF-8")), $this->unikatni["admin_vypis_element_zkraceni"]),
                                                  ($data1->zamek ? " checked=\"checked\"" : ""),
                                                  date($tvar_datum, strtotime($data1->pridano)),
                                                  (!Empty($data1->upraveno) ? date($tvar_datum, strtotime($data1->upraveno)) : $this->unikatni["admin_vypis_element_neupraveno"]),
                                                  ($copyelem_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=copyelem&amp;id={$data1->id}" : ""),
                                                  ($editelem_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$data1->id}" : ""),
                                                  ($delelem_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delelem&amp;id={$data1->id}" : ""));
          }
        }
          else
        {
          $element[] = $this->unikatni["admin_vypis_element_null"]; //null
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_sablona"],
                                            $data->id,
                                            $data->adresa,
                                            $data->nazev,
                                            ($addelem_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$data->id}" : ""),
                                            ($copysab_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=copysab&amp;id={$data->id}" : ""),
                                            ($editsab_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editsab&amp;id={$data->id}" : ""),
                                            ($delsab_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delsab&amp;id={$data->id}" : ""),
                                            implode("", $element));
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_sablona_null"]; //null
    }

    $result .= $this->unikatni["admin_vypis_obsah_end"];

    return $result;
  }

/**
 *
 * Vypisuje polozky menu a umoznuje je radit
 *
 * @return vypis polozek menu
 */
  private function AdminiVypisRazeniMenu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_razeni_menu_begin"],
                                        $this->dirpath);

    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, poradi FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      //vypis sablon
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_razeni_menu"],
                                            $data->id,
                                            $data->poradi,
                                            $data->nazev);
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_razeni_menu_null"]; //null
    }

    $result .= $this->unikatni["admin_vypis_razeni_menu_end"];

    return $result;
  }


}
?>
