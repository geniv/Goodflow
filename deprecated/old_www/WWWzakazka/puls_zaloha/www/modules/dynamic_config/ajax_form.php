<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $var, $dbpredpona, $seppol;
  private $cfgexplode = "|--xx--|";

/**
 *
 * konstuktor ajaxu stranky s tiskem
 *
 * @return tisk vysledku dane funkce
 */
  public function __construct()
  {
    $this->var = new Promenne();  //vytvoreni promennych
    $this->var->main[0] = new Funkce($this->var, 0);  //vytvoreni funkce
    $this->unikatni = $this->var->main[0]->AjaxInicializaceModulu(".unikatni_obsah.php");  //inicializace pro ajax

    echo $this->VyberFunkci();
  }

/**
 *
 * vybere provadenou akci ajaxu pres dane parmetry
 *
 * @return dana akce
 */
  private function VyberFunkci()  //vybere volanou funkci
  {
    $result = "";

    $action = $_POST["action"];

    $group = array ("checkgroup");

    //vypis pro POST
    if (!Empty($action))
    {
      switch ($action)
      {
        case "listradio": //generovani polozek radio, select, checkgroup
          $poc = $_POST["pocet"];
          settype($poc, "integer");

          $typ = $_POST["typ"];
          //odchyceni checkgroup
          $gr = in_array($typ, $group);

          $popis = $this->AjaxJQueryKonverze(explode("|,|", $_POST["popis"]), NULL, array("|" => ""));  //nacteni nazvu
          $value = $this->AjaxJQueryKonverze(explode("|,|", $_POST["value"]), NULL, array("|" => ""));  //nacteni hodnot

          for ($i = 0; $i < $poc; $i++)
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_listradio"],
                                                $i,
                                                $i + 1,
                                                $popis[$i],
                                                $value[$i],
                                                ($gr ? "" : $this->NactiUnikatniObsah($this->unikatni["ajax_listradio_radsel"], $i, $i + 1)),
                                                ($i > 1 && ($poc - 1) == $i ? $this->unikatni["ajax_listradio_del"] : ""));
          }
        break;

        case "savevalue": //ukladani hodnot
          $id = $_POST["id"];
          settype($id, "integer");
          $value = $this->AjaxJQueryKonverze(explode("|,|", $_POST["value"]), NULL, array("|" => ""));  //nacteni nazvu
          $val = $value[0];
          $ret = "";

          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"));
          //nacteni kominikace
          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }
          $sablona = $this->VypisHodnotu("sablona", "element", $id);
          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}__{$sablona}", $action))
          {
            $ret = $val;
            $typ = $this->VypisHodnotu("typ", "element", $id);
            //rozliseni typu kvuli odlisnemu ukladani
            if (in_array($typ, $group))
            {
              $hodnota = explode($this->cfgexplode, $this->VypisHodnotu("value", "element", $id));
              $konfigurace = explode($this->cfgexplode, $this->VypisHodnotu("konfigurace", "element", $id));
              list($pop, $hod) = $this->RozdelitHodnoty($konfigurace, 2, 2);
              $pole = array();
              for ($i = 0; $i < $konfigurace[1]; $i++)
              { //pokud zaskrkne jen dotycny radek jinak jo odkskrne a nebo necha napokoji
                $rozhod = explode($this->unikatni["admin_checkgroup_sep"], $hod[$i]); //rozdeleni hodnot na on a off
                $pole[$i] = ($val == "{$i}true" ? $rozhod[0] : ($val == "{$i}false" ? $rozhod[1] : $hodnota[$i]));
                if ($val == "{$i}true" ||
                    $val == "{$i}false")
                {
                  $ret = $pole[$i];
                }
              }

              $val = implode($this->cfgexplode, $pole);
            }
//$this->ChangeWrongChar()
            if ($this->NastavHodnotu("value", $val, "element", $id))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["ajax_savevalue"], $this->ZkraceniTextu(htmlspecialchars(html_entity_decode($ret, ENT_QUOTES, "UTF-8")), $this->unikatni["ajax_savevalue_zkraceni"]));
              $naz = $this->VypisHodnotu("nazev", "element", $id);
              $this->AdminAddActionLog(array($naz, $val), array(__LINE__, __METHOD__), "{$module->adress[0]}__{$sablona}", $action);
            }
          }
            else
          {
            $result = $this->unikatni["ajax_savevalue_not_permit"];
          }
        break;

        case "updateelement": //drag'n'drop na polozky elementu
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);

          if ($this->OverovaniManualPermission($module->class, $module->adress[0], $action))
          {
            $update_poradi = $_POST["arrayporadi"]; //nactene pole id z jQuery

            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $sql = "";
            foreach ($update_poradi as $index => $polozka)
            {
              $poc = $index + 1;
              $sql[] = "UPDATE {$this->dbpredpona}element SET poradi={$poc} WHERE id={$polozka};";
            }

            if (is_array($sql))
            {
              if ($this->queryExec(implode("\n", $sql)))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__), $module->adress[0], $action);
              }
            }

            $result = $this->unikatni["ajax_updateelement"];
          }
            else
          {
            $result = $this->unikatni["ajax_updateelement_not_permit"];
          }
        break;

        case "updatesablona": //drag'n'drop na polozky sablon
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);

          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}{$module->adress[1]}", $action))
          {
            $update_poradi = $_POST["arrayporadi"]; //nactene pole id z jQuery

            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $sql = "";
            foreach ($update_poradi as $index => $polozka)
            {
              $poc = $index + 1;
              $sql[] = "UPDATE {$this->dbpredpona}sablona SET poradi={$poc} WHERE id={$polozka};";
            }

            if (is_array($sql))
            {
              if ($this->queryExec(implode("\n", $sql)))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__), "{$module->adress[0]}{$module->adress[1]}", $action);
              }
            }

            $result = $this->unikatni["ajax_updatesablona"];
          }
            else
          {
            $result = $this->unikatni["ajax_updatesablona_not_permit"];
          }
        break;

        case "changeactelem": //zmeni aktivitu modulu
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);
          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}", $action))
          {
            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $id = $_POST["id"]; //vrati nove poradi ID
            $stav = ($_POST["stav"] == "true" ? 1 : 0); //vrati nove poradi ID

            if ($this->queryExec("UPDATE {$this->dbpredpona}element SET zamek={$stav}
                                  WHERE id={$id};", $error))
            {
              $naz = $this->VypisHodnotu("nazev", "element", $id);  //nacte nazev
              $st = $this->unikatni["ajax_changeactelem_stav"][$stav];  //nacte jmeno stavu
              $this->AdminAddActionLog(array($naz, $st), array(__LINE__, __METHOD__), "{$module->adress[0]}", $action);
              $result = $this->NactiUnikatniObsah($this->unikatni["ajax_changeactelem"], $naz, $st);
            }
          }
            else
          {
            $result = $this->unikatni["ajax_changeactelem_not_permit"];
          }
        break;
      }
    }

    return $result;
  }
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
