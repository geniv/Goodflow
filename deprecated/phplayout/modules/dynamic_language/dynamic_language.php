<?php

/**
 *
 * Blok dynamicky generovanych jazyku
 *
 */

//verze modulu
define("v_DynamicLanguage", "1.31");

class DynamicLanguage extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona;
  public $idmodul = "dynlang";
  public $mount = array(".unikatni_obsah.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul
  //public $convmeth = array("Ajax" => "DynamicConfig");  //konvert nazvu metody
  private $localpermit;

  private $ozn_jazyk_l = "[";
  private $ozn_jazyk_r = "]";
  private $cookiename = "LANG";
  private $adrname = "sub"; //get
  private $adrchange = "changelang";  //detekce v get
  private $idlang = "id"; //id jazyku

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

      $this->ozn_jazyk_l = $this->unikatni["set_ozn_jazyk_l"];
      $this->ozn_jazyk_r = $this->unikatni["set_ozn_jazyk_r"];
      $this->cookiename = $this->unikatni["set_cookie_name"];
      $this->adrname = $this->unikatni["set_adrname"];
      $this->adrchange = $this->unikatni["set_adrchange"];
      $this->idlang = $this->unikatni["set_idlang"];

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->adress[0]);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);

      $this->Instalace();

      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                          $this->idmodul));
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
 * Instalace databaze
 *
 */
  private function Instalace()
  {
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}jazyk (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                jazyk VARCHAR(100),
                                zkratka VARCHAR(20),
                                autovolba VARCHAR(20));");
  }

/**
 *
 * Zkontroluje aktualni jazyk a pripadne nastavi automaticky jazyk podle uzivatelova prohlizece
 *
 * pouziti:
 * $this->var->main[0]->NactiFunkci("DynamicLanguage", "AutoVolbaJazyka");
 *
 */
  public function AutoVolbaJazyka()
  {
    $roz = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
    $autolang = explode("-", $roz[0]);

    $id = $this->VypisHodnotu("id", "jazyk", $autolang[0], "autovolba=");
    settype($id, "integer");

    if ($id != 0 &&
        $id != $this->ZvolenyJazyk())
    {
      SetCookie($this->cookiename, $id, Time() + 31536000); //zápis do cookie

      $this->AutoClick(0, $this->absolutni_url);  //auto kliknuti
    }
  }

/**
 *
 * Vrati cislo prvni polozky
 *
 * pouziti:
 * $cislo = $this->var->main[0]->NactiFunkci("DynamicLanguage", "PrvniPolozka");
 *
 * @return cislo prvni polozky
 */
  public function PrvniPolozka()
  {
    $result = $this->querySingle("SELECT id FROM {$this->dbpredpona}jazyk ORDER BY LOWER(zkratka) ASC LIMIT 0,1;");
    settype($result, "integer");

    return $result;
  }

/**
 *
 * Vraci cislo aktualnho zvoleneho jazyku
 *
 * pouziti:
 * $cislo = $this->var->main[0]->NactiFunkci("DynamicLanguage", "ZvolenyJazyk");
 *
 * @return cislo aktualniho jazyku
 */
  public function ZvolenyJazyk()
  {
    $jaz = $_COOKIE[$this->cookiename];
    $result = (!Empty($jaz) ? $jaz : $this->PrvniPolozka());
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
 * pouziti:
 * $cislo = $this->var->main[0]->NactiFunkci("DynamicLanguage", "PrevodTextoveAdresy", $_GET["jazyk"]);
 *
 * @param zkraka textova zkratka jazyka
 * @return cislo jazyku
 */
  public function PrevodTextoveAdresy($zkratka)
  {
    $result = $this->VypisHodnotu("id", "jazyk", $zkratka, "zkratka=");
    settype($result, "integer");

    return $result;
  }

/**
 *
 * Generovani samotneho menu, vystup v: $_COOKIE[$this->cookiename]
 *
 * pouziti:
 * $jazyky = $this->var->main[0]->NactiFunkci("DynamicLanguage", "SeznamJazyku");
 *
 * @param tvar cislo tvaru
 * @return vygenerovane menu
 */
  public function SeznamJazyku($tvar = 1)
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, jazyk, zkratka FROM {$this->dbpredpona}jazyk ORDER BY id ASC;"))
    {
      foreach ($res as $data)
      {
        $podm = (!Empty($_COOKIE[$this->cookiename]) && $_COOKIE[$this->cookiename] == $data->id ? true : (Empty($_COOKIE[$this->cookiename]) && $this->PrvniPolozka() == $data->id ? true : false));

        $url = $this->NactiUnikatniObsah($this->unikatni["rewrite_url_seznam_jazyku_{$tvar}"],
                                        $this->absolutni_url,
                                        $data->zkratka);

        $ozn_jazyk_class = $this->NactiUnikatniObsah($this->unikatni["set_ozn_jazyk_class"],
                                                    $url,
                                                    $data->jazyk,
                                                    $data->zkratka);

        $ozn_class = ($podm ? $ozn_jazyk_class : "");
        $ozn_l = ($podm ? $this->ozn_jazyk_l : "");
        $ozn_r = ($podm ? $this->ozn_jazyk_r : "");

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
      $result = $this->unikatni["normal_seznam_jazyku_null_{$tvar}"];
    }

    if (!Empty($_GET[$this->adrname]) && //pod htaccess neuklada do cookies
        $_GET[$this->adrname] == $this->adrchange)
    {
      $result .= $this->unikatni["normal_seznam_jazyku_changelang_{$tvar}"];

      $id = $this->PrevodTextoveAdresy($_GET[$this->idlang]);
      settype($id, "integer");

      if ($id != 0)
      {
        SetCookie($this->cookiename, $id, Time() + 31536000); //zápis do cookie
      }

      $this->AutoClick(0, $this->absolutni_url);  //auto kliknuti
    }

    return $result;
  }

/**
 *
 * Vrati nazev nalezici danemu id, pro externi moduly
 *
 * pouziti:
 * $select = $this->var->main[0]->NactiFunkci("DynamicLanguage", "VyberJazyka"[, $id, $tvar]);
 *
 * @param id id polozky menu, nepovinne
 * @param tvar cislo tvaru pro vicenasobne pouziti v jinych castech
 * @return nazev polozky menu
 */
  public function VyberJazyka($id = NULL, $tvar = 1)
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, jazyk, zkratka FROM {$this->dbpredpona}jazyk ORDER BY LOWER(zkratka) ASC;"))
    {
      $row = array();
      foreach ($res as $data)
      {
        $row[] = $this->NactiUnikatniObsah($this->unikatni["normal_vyber_jazyka_select_row_{$tvar}"],
                                          $data->id,
                                          $data->zkratka,
                                          $data->jazyk,
                                          (!Empty($id) && $id == $data->id ? $this->unikatni["normal_vyber_jazyka_aktivni_{$tvar}"] : ""));
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["normal_vyber_jazyka_select_{$tvar}"],
                                          implode("", $row));
    }
      else
    {
      $result = $this->unikatni["normal_vyber_jazyka_select_null_{$tvar}"];
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
    if ($res = $this->queryMultiObjectSingle("SELECT id, zkratka FROM {$this->dbpredpona}jazyk ORDER BY LOWER(zkratka) ASC;"))
    {
      foreach ($res as $data)
      {
        $result[$data->id] = $data->zkratka;
      }
    }

    return $result;
  }

/**
 *
 * Vrati nazev nalezici danemu id, pro externi moduly
 *
 * pouziti:
 * $jazyk = $this->var->main[0]->NactiFunkci("DynamicLanguage", "JazykPodleId", $id);
 *
 * @param id id polozky menu
 * @param tvar cislo tvaru
 * @return nazev polozky menu
 */
  public function JazykPodleId($id, $tvar = 1)
  {
    settype($id, "integer");
    $result = $this->unikatni["normal_jazyk_podle_id_{$tvar}"];

    $jazyk = $this->VypisHodnotu("jazyk", "jazyk", $id);
    $result = (!Empty($jazyk) ? $jazyk : $result);

    return $result;
  }

/**
 *
 * Vrati zkratku nalezici danemu id, pro externi moduly
 *
 * pouziti:
 * $zkratka = $this->var->main[0]->NactiFunkci("DynamicLanguage", "ZkratkaPodleId", $id);
 *
 * @param id id polozky menu
 * @param tvar cislo tvaru
 * @return nazev polozky menu
 */
  public function ZkratkaPodleId($id, $tvar = 1)
  {
    settype($id, "integer");
    $result = $this->unikatni["normal_zkratka_podle_id_{$tvar}"];

    $zkratka = $this->VypisHodnotu("zkratka", "jazyk", $id);
    $result = (!Empty($zkratka) ? $zkratka : $result);

    return $result;
  }

/**
 *
 * Hlavni administrace jazyku
 *
 * @return obsluha jazyku
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addlang"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addlang" : ""),
                                        $this->AdminVypisObsahu());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addlang": //pridavani jazyka
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditlang"],
                                              $this->unikatni["admin_addeditlang_add"],
                                              "", "", "",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("jazyk" => array("post", "string"),
                                        "zkratka" => array("post", "string"),
                                        "autovolba" => array("post", "string")),
                        (!Empty($_POST["tlacitko"]) && !Empty($_POST["jazyk"]) && !Empty($_POST["zkratka"]) && $this->DuplikatniHodnota("zkratka", "jazyk", $_POST["zkratka"])),
                        array("insert", "jazyk", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["jazyk"]);
            $this->AdminAddActionLog($_POST["jazyk"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editlang":  //uprava jazyka
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT id, jazyk, zkratka, autovolba FROM {$this->dbpredpona}jazyk WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditlang"],
                                                $this->unikatni["admin_addeditlang_edit"],
                                                $data->jazyk,
                                                $data->zkratka,
                                                $data->autovolba,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("jazyk" => array("post", "string"),
                                          "zkratka" => array("post", "string"),
                                          "autovolba" => array("post", "string")),
                          (!Empty($_POST["tlacitko"]) && !Empty($_POST["jazyk"]) && !Empty($_POST["zkratka"]) && $id > 0),
                          array("update", "jazyk", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["jazyk"]);
              $this->AdminAddActionLog($_POST["jazyk"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "dellang": //mazani jazyka
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("jazyk" => array("id", $id, "jazyk")), $nazev))
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
 * Vypis administrace obsahu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisObsahu()
  {
    $result = "";
    $editlang_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editlang"];
    $dellang_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["dellang"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, jazyk, zkratka, autovolba FROM {$this->dbpredpona}jazyk ORDER BY id ASC;"))
    {
      foreach ($res as $data)
      {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                              $data->id,
                                              $data->jazyk,
                                              $data->zkratka,
                                              $data->autovolba,
                                              ($editlang_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editlang&amp;id={$data->id}" : ""),
                                              ($dellang_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=dellang&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_obsah_null"];
    }

    return $result;
  }


}
?>
