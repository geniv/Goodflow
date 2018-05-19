<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $var, $dbpredpona;

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

    //vypis pro POST
    if (!Empty($action))
    {
      switch ($action)
      {
        case "updaterow": //post
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);

          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}", $action))
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
              $sql[] = "UPDATE {$this->dbpredpona}htaccess SET poradi={$poc} WHERE id={$polozka};";
            }

            if (is_array($sql))
            {
              if ($this->queryExec(implode("\n", $sql)))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__), "{$module->adress[0]}", $action);
              }
            }
//dodelat logovani??!
            $result = $this->unikatni["ajax_updaterow"];
          }
            else
          {
            $result = $this->unikatni["ajax_updaterow_not_permit"];
          }
        break;

        case "changeact": //zmeni aktivitu checkboxu
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

            if ($this->NastavHodnotu("aktivni", $stav, "htaccess", $id))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["ajax_changeact"], $id);
              $this->AdminAddActionLog(array($id, $stav), array(__LINE__, __METHOD__), "{$module->adress[0]}", $action);
            }
          }
            else
          {
            $result = $this->unikatni["ajax_changeact_not_permit"];
          }
        break;
      }
    }

    return $result;
  }


}

  $web = new Ajax();
?>
