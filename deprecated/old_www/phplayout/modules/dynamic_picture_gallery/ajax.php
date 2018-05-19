<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $dbname, $var, $sqlite;

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
    $this->prevod = $this->NactiUnikatniObsah($this->unikatni["ajax_prepis"]);
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
    //print_r($_SESSION);

    $result = "";

    //vypis pro POST
    if (!Empty($_POST["action"]))
    {
      switch ($_POST["action"])
      {
        //uzivatele
        case "prepis": //post - prepis textu
          $result = $this->PrepisTextu($_POST["text"]);
        break;

        case "pocitadlo": //pocitadlo zobrazeni
          $id = $_POST["id"];
          settype($id, "integer");

          $script = explode("/", dirname($_SERVER["SCRIPT_NAME"])); //vezme si cestu sama sebe a vyhleda svoje umisteni
          $index = $this->var->main->NajdiIndexPodleCesty(implode("/", array_slice($script, -2))); //nalezeni prislusneho modulu

          $this->dbname = $this->var->moduly[$index]["databaze"]; //nacte db name, musis byt v te same slozce

          $this->sqlite = new SQLiteDatabase($this->dbname, 0777, $error);  //pripojeni do DB

          if ($res = @$this->sqlite->query("SELECT zobrazeni FROM picture_gallery WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $zobrazeni = $res->fetchObject()->zobrazeni + 1;

              if (!@$this->sqlite->queryExec("UPDATE picture_gallery SET zobrazeni={$zobrazeni}
                                                                        WHERE id={$id};", $error))
              {
                var_dump($error);
              }
            }
          }
            else
          {
            var_dump($error);
          }
        break;

        case "rozkliknuti": //rozkliknuta polozka
          $id = $_POST["id"];
          settype($id, "integer");

          $pathpicture = $this->NactiUnikatniObsah($this->unikatni["set_pathpicture"]);
          $minidir = $this->NactiUnikatniObsah($this->unikatni["set_minidir"]);
          $midddir = $this->NactiUnikatniObsah($this->unikatni["set_midddir"]);
          $fulldir = $this->NactiUnikatniObsah($this->unikatni["set_fulldir"]);

          $script = explode("/", dirname($_SERVER["SCRIPT_NAME"])); //vezme si cestu sama sebe a vyhleda svoje umisteni
          $index = $this->var->main->NajdiIndexPodleCesty(implode("/", array_slice($script, -2))); //nalezeni prislusneho modulu

          $this->dbname = $this->var->moduly[$index]["databaze"]; //nacte db name, musis byt v te same slozce

          $absolutni_url = $this->var->main->AbsoluteUrl();

          $this->sqlite = new SQLiteDatabase($this->dbname, 0777, $error);  //pripojeni do DB

          $result = "";
          if ($res = @$this->sqlite->query("SELECT url, popisek FROM picture_gallery WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["ajax_rozkliknuti"],
                                                  $data->popisek,
                                                  "{$absolutni_url}{$pathpicture}/{$minidir}/{$data->url}",
                                                  "{$absolutni_url}{$pathpicture}/{$midddir}/{$data->url}",
                                                  "{$absolutni_url}{$pathpicture}/{$fulldir}/{$data->url}",
                                                  "a tu jakože má být volání komentářů :D:D");

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

  private function PrepisTextu($text)
  {
    return strtr($text, $this->prevod);  //prevede text dle prevadecoho pole
  }
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
