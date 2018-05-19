<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $dbname, $var, $get_id, $get_sablona, $get_text, $dbpredpona;
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

          $oldporadi = "";
          if ($res = $this->query("SELECT adresa
                                  FROM {$this->dbpredpona}gallery
                                  GROUP BY adresa
                                  ORDER BY LOWER(adresa) ASC;", $error))
          {
            if ($this->numRows($res) != 0)
            {
              while ($data = $this->fetchObject($res))
              {
                $poradi = "";
                $rozdil1 = "";
                $rozdil2 = "";
                if ($res1 = $this->query("SELECT id, poradi
                                          FROM {$this->dbpredpona}gallery
                                          WHERE adresa='{$data->adresa}'
                                          ORDER BY poradi ASC;", $error1))
                {
                  if ($this->numRows($res1) != 0)
                  {
                    while ($data1 = $this->fetchObject($res1))
                    {
                      $poradi[$data1->id] = $data1->poradi; //vytvori pole: [ID] => poradi
                      $oldporadi[] = $data1->id;
                    }
                  }
                }
                 else
                {
                  var_dump($error1, array(__LINE__, __METHOD__));
                }

                $klice = array_keys($poradi); //vezme klice z poradi
                $rozdil1 = array_diff($update_poradi, $klice);  //udela 1 rozdil mezi updatem (zismkame konec pole)
                $rozdil2 = array_diff($update_poradi, $rozdil1);  //udela 2 rozdil mezi rozdlem1 a updatem (ziskam zacatek)
                $rozdil_klice = array_keys($rozdil2); //vezmu klice z rozdilu2 na adresovani pole rozdilu2

                $poc = 0;
                for ($i = 0; $i < count($rozdil2); $i++)
                {
                  $poc = $i + 1;  //predpocitani poradi od 1
                  if (!$this->queryExec("UPDATE {$this->dbpredpona}gallery SET poradi={$poc}
                                        WHERE id={$rozdil2[$rozdil_klice[$i]]};", $error))
                  {
                    var_dump($error, array(__LINE__, __METHOD__));
                  }
                }
              }
            }
          }
            else
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $zmena = array_values(array_udiff_assoc($oldporadi, $update_poradi, "strcmp"));
          $result = $this->NactiUnikatniObsah($this->unikatni["ajax_update_records_listings"],
                                              $zmena[0],
                                              $zmena[1]);
        break;
      }
    }

    return $result;
  }
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
