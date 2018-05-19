<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $dbname, $var, $get_id, $get_sablona, $get_text, $sqlite;
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
    $this->get_id = $this->NactiUnikatniObsah($this->unikatni["ajax_set_get_id"]);
    $this->get_sablona = $this->NactiUnikatniObsah($this->unikatni["ajax_set_get_sablona"]);
    $this->get_text = $this->NactiUnikatniObsah($this->unikatni["ajax_set_get_text"]);

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
    //$web = "http://{$_SERVER["SERVER_NAME"]}{$this->var->temp}";
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
        case "kontrola": //post
          $id = $_POST[$this->get_id];
          settype($id, "integer");
          $sablona = $_POST[$this->get_sablona];
          settype($sablona, "integer");
          $text = $_POST[$this->get_text];

          $script = explode("/", dirname($_SERVER["SCRIPT_NAME"])); //vezme si cestu sama sebe a vyhleda svoje umisteni
          $index = $this->var->main->NajdiIndexPodleCesty(implode("/", array_slice($script, -2))); //nalezeni prislusneho modulu

          //$this->dirpath = dirname($this->var->moduly[$index]["include"]);  //nacte dir path
          $this->dbname = $this->var->moduly[$index]["databaze"]; //nacte db name, musis byt v te same slozce

          $this->sqlite = new SQLiteDatabase($this->dbname, 0777, $error);  //pripojeni do DB
//var_dump($index, $this->dbname, $this->sqlite, $error);
          if ($res = @$this->sqlite->query($this->NactiUnikatniObsah($this->unikatni["ajax_kontrola_sql_dotaz"], $sablona, $id), NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

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
      }
    }

    return $result;
  }
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
