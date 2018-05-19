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
        case "geteditcell": //vrati editacni formular bunky
        case "seteditcell": //nastavi editovany obsah bunky
          $index = $_POST["index"];
          settype($index, "integer");

          $pole = $this->var->moduly[$index]; //nacteni modulu
          $pole["include"] = "../../{$pole["include"]}";  //uprava cesty pro pripojeni

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $pole);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $table = $_POST["table"];

          $id = $_POST["id"];
          settype($id, "integer");
          $bunka = $_POST["bunka"];

          $stav = $_POST["stav"];
          $ret = $_POST["ret"];

          switch ($_POST["action"])
          {
            case "geteditcell": //vypis pro get
              $lastval = $_POST["lastval"]; //nacteni posledni value hodnota

              $result = $this->NactiUnikatniObsah($this->unikatni["ajax_get_edit_cell"],
                                                  "SaveEditCell({$index}, '{$table}', {$id}, '{$bunka}', $('{$ret}-textarea').val(), {$stav}, '{$ret}');",
                                                  substr($ret, 1),
                                                  $this->BackChangeChar($this->VypisHodnotu($bunka, $table, $id)),
                                                  "CancelEditCell('{$lastval}', '{$ret}');");
            break;

            case "seteditcell": //vypis pro set
              $value = $_POST["value"]; //nacteni value

              $val = $this->AjaxJQueryKonverze($value);

              //ulozeni value zpet do DB
              if ($this->NastavHodnotu($bunka, $this->ChangeWrongChar($val), $table, $id))
              {
                settype($stav, "boolean");  //prevedeni stavu na bool

                $small = $this->ZkraceniTextu($val, $this->unikatni["admin_show_small_count"], $this->unikatni["admin_show_small_char"]);

                $result = ($stav ? $small : $val);
              }
            break;
          }
        break;

        case "inserthistory": //vlozeni dekodovane historie
          $result = base64_decode($_POST["hash"]);
        break;
      }
    }

    return $result;
  }


}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
