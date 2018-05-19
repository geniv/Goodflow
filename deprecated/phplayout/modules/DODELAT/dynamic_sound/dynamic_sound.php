<?php

/**
 *
 * Blok sound modulu
 *
 */

class DynamicSound extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona, $mainindex;
  public $idmodul = "dynsound";  //id pro rozliseni modulu v adminu
  private $idlog = "_logy";
  public $mount = array(".unikatni_obsah.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul

  private $localpermit;

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul, $this->idlog);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);
      $this->mainindex = $index;

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul,
                                                $this->idlog);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);  //pripojeni defaultu

      $this->Instalace();

      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                          $this->idmodul,
                                                          $this->idlog));
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

        case "{$this->idmodul}{$this->idlog}":  //vypis logu
          $result = $this->AdminVypisLogu();
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
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}cron (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                modul VARCHAR(100),
                                funkce VARCHAR(100),
                                parametry TEXT,
                                popis TEXT,
                                pridano DATETIME,
                                upraveno DATETIME,
                                aktivni BOOL);

                              CREATE TABLE {$this->dbpredpona}cron_log (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                exectime VARCHAR(100),
                                datum DATETIME,
                                agent VARCHAR(300),
                                ip VARCHAR(50));");

    //preinstalace dat
    $this->ControlPreInstall($this->unikatni["control_preinstall"],
                            array(date("Y-m-d H:i:s")));
  }

/**
 *
 * Vykona zadane akce v databazi, externe volana z cron.php
 *
 */
  public function CronAction()
  {
    $start = $this->MeritCas(); //zacatek mereni
    $result = date("Y-m-d H:i:s");
//kazda logovaci funkce si sama musi kontrolovat podle data svoje stare logy/soubory
    if ($res = $this->queryMultiObjectSingle("SELECT modul, funkce, parametry FROM {$this->dbpredpona}cron WHERE aktivni=1;"))
    {
      foreach ($res as $data)
      {
        //pripadne potrebne parametry na 'pole' jinak polozku paramatry vyhodit!
        $this->var->main[0]->NactiFunkci($data->modul, $data->funkce, $data->parametry);
      }
    }

    $konec = $this->MeritCas(); //konec mereni
    $exectime = $this->KalkulaceCas($start, $konec);
    $result .= "<br />{$exectime}s"; //vypsani casu
    $this->AddLogCron($exectime);  //pridani
    $this->ClearLogCron();  //auto promazani

    echo $result;
  }

/**
 *
 * Pridani logu cronu
 *
 * @param exectime vypocteny cas delky tvani
 */
  private function AddLogCron($exectime)
  {
    $this->ControlForm(array("exectime" => array("self", "string", $exectime),
                              "datum" => array("self", "date", "now"),
                              "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"]),
                              "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"])),
                        true, array("insert", "cron_log", NULL));
  }

/**
 *
 * Cisteni logu cronu
 *
 */
  private function ClearLogCron()
  {
    $expire = date("Y-m-d H:i:s", strtotime($this->unikatni["set_expire_log"]));
    if ($res = $this->queryMultiObjectSingle("SELECT id
                                              FROM {$this->dbpredpona}cron_log
                                              WHERE
                                              datum<='{$expire}';"))
    {
      $id = "";
      foreach ($res as $data)
      {
        $id[] = $data->id;
      }

      if (!Empty($id) &&
          is_array($id))
      {
        $sloucene = implode(", ", $id);
        $this->queryExec("DELETE FROM {$this->dbpredpona}cron_log WHERE id IN ({$sloucene});"); //provedeni dotazu
      }
    }
  }

/**
 *
 * Vypise seznam vsech trid a jejich public funkci
 *
 * @param modul nazev modulu
 * @param nazev jmeno funkce
 * @return select s tridama a funkcema
 */
  private function SeznamTrid($modul = NULL, $nazev = NULL)
  {
    $result = $this->unikatni["admin_seznam_trid_begin"];
    $funblok = $this->BlokovaneNazvyVypisu();
    foreach ($this->var->main as $index => $polozka)
    {
      $trida = get_class($polozka);
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_trid_skupina_begin"],
                                          $trida);

      if ($index != $this->mainindex) //vyblokovani vlastni funkce
      {
        //nacteni funkci
        $fun = get_class_methods($polozka);
        foreach ($fun as $funkce)
        {
          if (!in_array($funkce, $funblok)) //ignorace funkci
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_trid"],
                                                "{$trida}:{$funkce}",
                                                ($trida == $modul && $funkce == $nazev ? " selected=\"selected\"" : ""),
                                                $funkce);
          }
        }
      }

      $result .= $this->unikatni["admin_seznam_trid_skupina_end"];
    }
    $result .= $this->unikatni["admin_seznam_trid_end"];

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
                                        ($this->localpermit->$_GET[$this->var->get_idmodul]->addcron ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addcron" : ""),
                                        $this->AdminVypisObsahu());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addcron": //pridavani polozky crona
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditcron"],
                                              $this->unikatni["admin_addeditcron_add"],
                                              $this->SeznamTrid(),
                                              "", "", "",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $trida = explode(":", $_POST["trida"]);
          if ($this->ControlForm(array ("modul" => array("self", "string", $trida[0]),
                                        "funkce" => array("self", "string", $trida[1]),
                                        "parametry" => array("post", "string"),
                                        "popis" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "aktivni" => array("post", "boolean")),
                        (!Empty($_POST["tlacitko"]) && !Empty($_POST["trida"])),
                        array("insert", "cron", NULL)))
          {
            $result = $this->Hlaska("add", $trida[1]);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editcron":  //editaci polozky crona
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT modul, funkce, parametry, popis, aktivni FROM {$this->dbpredpona}cron WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditcron"],
                                                $this->unikatni["admin_addeditcron_edit"],
                                                $this->SeznamTrid($data->modul, $data->funkce),
                                                $data->parametry,
                                                $data->popis,
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            $trida = explode(":", $_POST["trida"]);
            if ($this->ControlForm(array ("modul" => array("self", "string", $trida[0]),
                                          "funkce" => array("self", "string", $trida[1]),
                                          "parametry" => array("post", "string"),
                                          "popis" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now"),
                                          "aktivni" => array("post", "boolean")),
                          (!Empty($_POST["tlacitko"]) && !Empty($_POST["trida"]) && $id > 0),
                          array("update", "cron", $id)))
            {
              $result = $this->Hlaska("edit", $trida[1]);
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "delcron": //mazani polozky crona
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("cron" => array("id", $id, "funkce")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
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
    $tvar_datum = $this->unikatni["admin_vypis_tvar_datum"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, modul, funkce, parametry, popis, pridano, upraveno, aktivni FROM {$this->dbpredpona}cron ORDER BY LOWER(modul) ASC, LOWER(funkce) ASC;"))
    {
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            $data->modul,
                                            $data->funkce,
                                            $data->parametry,
                                            $data->popis,
                                            date($tvar_datum, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : ""),
                                            ($data->aktivni ? " checked=\"checked\"" : ""),
                                            ($this->localpermit->$_GET[$this->var->get_idmodul]->editcron ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editcron&amp;id={$data->id}" : ""),
                                            ($this->localpermit->$_GET[$this->var->get_idmodul]->delcron ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delcron&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_obsah_null"];
    }

    return $result;
  }

/**
 *
 * Vypis obsahu logu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisLogu()
  {
    $result = $this->unikatni["admin_vypis_logu_begin"];
    $tvar_datum = $this->unikatni["admin_vypis_logu_tvar_datum"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, exectime, datum, agent, ip FROM {$this->dbpredpona}cron_log ORDER BY cron_log.datum DESC;"))
    {
      foreach ($res as $data)
      {
        $os = $this->TypOS($data->agent);
        $browser = $this->TypBrowseru($data->agent);
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_logu"],
                                            $data->id,
                                            $data->exectime,
                                            date($tvar_datum, strtotime($data->datum)),
                                            $data->ip,
                                            $os,
                                            $browser);
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_obsah_null"];
    }

    return $result;
  }


}
?>
