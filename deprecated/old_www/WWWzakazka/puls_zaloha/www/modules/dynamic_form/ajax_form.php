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
        case "kontrola": //post
          $id = $_POST["id"];
          $roz = explode(":", $id);
          $id = $roz[0];
          settype($id, "integer");
          $text = $_POST["text"];

          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          if ($res = $this->query("SELECT
                                    vstupni_typ, reg_exp, min_val, max_val
                                    FROM {$this->dbpredpona}prvek
                                    WHERE id={$id}
                                    ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              switch ($data->vstupni_typ)
              {
                case 0: //text
                  settype($text, "string");

                  if ($data->min_val > 0 && //kontrola rozsahu poctu pismen
                      $data->max_val > 0)
                  {
                    if (strlen($text) < $data->min_val ||
                        strlen($text) > $data->max_val)
                    {
                      $text = "";
                    }
                  }
                    else
                  if ($data->min_val > 0)  //kontrola minina
                  {
                    if (strlen($text) < $data->min_val)
                    {
                      $text = "";
                    }
                  }
                    else
                  if ($data->max_val > 0)  //kontrola maxima
                  {
                    if (strlen($text) > $data->max_val)
                    {
                      $text = "";
                    }
                  }
                break;

                case 1: //integer
                  settype($text, "integer");

                  if ($data->min_val > 0 &&
                      $data->max_val > 0)
                  {
                    if ($text < $data->min_val ||  //kontrola hodnoty cisel
                        $text > $data->max_val)
                    {
                      $text = "";
                    }
                  }
                    else
                  if ($data->min_val > 0)  //kontrola minina
                  {
                    if ($text < $data->min_val)
                    {
                      $text = "";
                    }
                  }
                    else
                  if ($data->max_val > 0)  //kontrola maxima
                  {
                    if ($text > $data->max_val)
                    {
                      $text = "";
                    }
                  }
                break;

                case 2: //reg_exp
                  preg_match($data->reg_exp, $text, $ret);
                  $text = $ret[0];  //vybere nulty index
                break;
              }

              if (!Empty($text))  //kontrola prazdnosti
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["ajax_dobre"]);
              }
                else
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["ajax_spatne"]);
              }
            }
          }
            else
          {
            var_dump($error);
          }
        break;

        case "updateRecordsListings": //post - posouvani polozek elementu
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $update_poradi = $_POST["recordsArray"]; //vrati nove poradi ID

          $oldporadi = "";
          if ($res = $this->query("SELECT formular
                                  FROM {$this->dbpredpona}prvek
                                  GROUP BY formular
                                  ORDER BY formular ASC;", $error))
          {
            if ($this->numRows($res) != 0)
            {
              while ($data = $this->fetchObject($res))
              {
                $poradi = "";
                $rozdil1 = "";
                $rozdil2 = "";
                if ($res1 = $this->query("SELECT id, poradi
                                          FROM {$this->dbpredpona}prvek
                                          WHERE formular={$data->formular}
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
                $c_rozdil = count($rozdil2);
                for ($i = 0; $i < $c_rozdil; $i++)
                {
                  $poc = $i + 1;  //predpocitani poradi od 1
                  if (!$this->queryExec("UPDATE {$this->dbpredpona}prvek SET poradi={$poc}
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
