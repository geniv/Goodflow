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
          settype($id, "integer");
          $sablona = $_POST["sablona"];
          settype($sablona, "integer");
          $text = $_POST["text"];

          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          if ($res = $this->query("SELECT
                                  vstupni_typ, reg_exp, min_val, max_val
                                  FROM {$this->dbpredpona}element_kniha
                                  WHERE sablona={$sablona} AND id={$id}
                                  ORDER BY poradi ASC;"), $error))
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
                $result = $this->unikatni["ajax_dobre"];
              }
                else
              {
                $result = $this->unikatni["ajax_spatne"];
              }
            }
          }
            else
          {
            var_dump($error);
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
