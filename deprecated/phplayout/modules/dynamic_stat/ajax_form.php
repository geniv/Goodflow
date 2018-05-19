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

    //vypis pro POST
    if (!Empty($_POST["action"]))
    {
      switch ($_POST["action"])
      {
        case "updateprojekt":  //drag and drop na elementy
          $update_poradi = $_POST["arrayprojekts"]; //nactene pole id z jQuery

          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $sql = "";
          foreach ($update_poradi as $index => $polozka)
          {
            $poc = $index + 1;
            $sql[] = "UPDATE {$this->dbpredpona}projekt SET poradi={$poc} WHERE id={$polozka};";
          }

          if (is_array($sql))
          {
            if (!$this->queryExec(implode("\n", $sql), $error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }
          }

          $result = $this->unikatni["ajax_update_projekts"];
        break;
      }
    }

    return $result;
  }


}

new Ajax();
?>
