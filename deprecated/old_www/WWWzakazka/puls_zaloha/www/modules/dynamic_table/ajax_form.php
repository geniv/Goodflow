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
        case "listsloup": //vypis sloupcu
          $poc = $_POST["pocet"];
          settype($poc, "integer");

          $slo = $this->AjaxJQueryKonverze(explode("|,|", $_POST["sloupec"]), NULL, array("|" => ""));  //nacteni nazvu
          $def = $this->AjaxJQueryKonverze(explode("|,|", $_POST["default"]), NULL, array("|" => ""));  //nacteni hodnot
          $pop = $this->AjaxJQueryKonverze(explode("|,|", $_POST["popis"]), NULL, array("|" => ""));  //nacteni hodnot

          for ($i = 0; $i < $poc; $i++)
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_listsloup"],
                                                $i,
                                                $i + 1,
                                                $slo[$i],
                                                $def[$i],
                                                $pop[$i],
                                                ($i > 0 && ($poc - 1) == $i ? $this->unikatni["ajax_listsloup_del"] : ""));
          }
        break;

        case "updatehlavicka":  //drag'n'drop na polozky hlavicek
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
              $sql[] = "UPDATE {$this->dbpredpona}hlavicka SET poradi={$poc} WHERE id={$polozka};";
            }

            if (is_array($sql))
            {
              if ($this->queryExec(implode("\n", $sql)))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__));
              }
            }

            $result = $this->unikatni["ajax_updatehlavicka"];
          }
            else
          {
            $result = $this->unikatni["ajax_updatehlavicka_not_permit"];
          }
        break;

        case "updateradek":  //drag'n'drop na polozky radku
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"));

          $update_poradi = $_POST["arrayporadi"]; //nactene pole id z jQuery

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }
          //vezme si prvni index a podle neho urci sablonu
          $sablona = $this->VypisHodnotu("hlavicka", "bunka", $update_poradi[0]);
          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}__{$sablona}", $action))
          {
            $sql = "";
            foreach ($update_poradi as $index => $polozka)
            {
              $poc = $index + 1;
              $sql[] = "UPDATE {$this->dbpredpona}bunka SET poradi={$poc} WHERE id={$polozka};";
            }

            if (is_array($sql))
            {
              if ($this->queryExec(implode("\n", $sql)))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__));
              }
            }

            $result = $this->unikatni["ajax_updateradek"];
          }
            else
          {
            $result = $this->unikatni["ajax_updateradek_not_permit"];
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
