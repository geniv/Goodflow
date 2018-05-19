<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $dbname, $var, $dbpredpona;
// $dirpath,

/**
 *
 * konstuktor ajaxu stranky s tiskem
 *
 * @return tisk vysledku dane funkce
 */
  public function __construct()
  {
    $this->var = new Promenne();  //vytvoreni promennych
    $this->var->main = new Funkce($this->var, 0);  //vytvoreni funkce

    $this->unikatni = $this->NactiObsahSouboru(".unikatni_obsah.php");

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
    //$action = (!Empty($_POST["action"]) ? $_POST["action"] : $_GET["action"]);
    //print_r($_GET);
    //print_r($_POST);
    //print_r($_SERVER);
    //print_r($_SESSION);

    $result = "";

    //vypis pro POST
    if (!Empty($_POST["action"]))
    {
      switch ($_POST["action"])
      {
        case "updateRecordsListings": //post
          $script = explode("/", dirname($_SERVER["SCRIPT_NAME"])); //vezme si cestu sama sebe a vyhleda svoje umisteni
          $index = $this->var->main->NajdiIndexPodleCesty(implode("/", array_slice($script, -2))); //nalezeni prislusneho modulu

          //$this->dirpath = dirname($this->var->moduly[$index]["include"]);  //nacte dir path
          $this->dbname = $this->var->moduly[$index]["databaze"]; //nacte db name, musis byt v te same slozce

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dbname}");
          if (!$this->PripojeniDatabaze($error))
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $update_poradi = $_POST["recordsArray"]; //vrati nove poradi ID

          for ($i = 0; $i < count($update_poradi); $i++)
          {
            $poc = $i + 1;  //predpocitani poradi od 1
            if (!$this->queryExec("UPDATE {$this->dbpredpona}htaccess SET poradi={$poc}
                                  WHERE id={$update_poradi[$i]};", $error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["ajax_update_records_listings"]);
        break;

        case "changeact":
          $script = explode("/", dirname($_SERVER["SCRIPT_NAME"])); //vezme si cestu sama sebe a vyhleda svoje umisteni
          $index = $this->var->main->NajdiIndexPodleCesty(implode("/", array_slice($script, -2))); //nalezeni prislusneho modulu

          //$this->dirpath = dirname($this->var->moduly[$index]["include"]);  //nacte dir path
          $this->dbname = $this->var->moduly[$index]["databaze"]; //nacte db name, musis byt v te same slozce

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dbname}");
          if (!$this->PripojeniDatabaze($error))
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $id = $_POST["id"]; //vrati nove poradi ID
          $stav = ($_POST["stav"] == "true" ? 1 : 0); //vrati nove poradi ID

          if (!$this->queryExec("UPDATE {$this->dbpredpona}htaccess SET aktivni={$stav}
                                WHERE id={$id};", $error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["ajax_update_action"], $id);
        break;
      }
    }

    return $result;
  }
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
