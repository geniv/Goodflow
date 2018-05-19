<?php
  include_once "promenne.php";
  include_once "funkce.php";

class Fotka
{
  public $var;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->main = new Hlavni($this->var);
    $this->Fotka(); //zavolánní výpisu fotky
  }
//******************************************************************************
  function Fotka()
  {
    if (!Empty($_GET["id"]) && !Empty($_GET["action"]))
    {
      $sekce = $_GET["action"];
      $id = $_GET["id"];
      settype($id, "integer");

      switch($sekce)
      {
        case "mini": //zamestnanci
          $databaze = "fotografikamini";
        break;

        case "full":
          $databaze = "fotografikafull";
        break;
      }

      if ($res = $this->var->jurixgra->query("SELECT foto, typ FROM {$databaze} WHERE id={$id}"))
      {
        if ($res->numRows() != 0)
        {
          $data = $res->fetchObject();
          header("Content-Type: {$data->typ}"); //hlavička
          $result = stripslashes(base64_decode($data->foto)); //přidá dekoduje a přidá ''
        }
          else
        {
          header("Content-Type: image/png"); //hlavička
          $nazev = "./obr/nahradni_obrazek.png";
          $u = fopen($nazev, "r");
          $result = fread($u, filesize($nazev));
          fclose($u); //zavře
        }
      }
    }
    echo $result;
  }
//******************************************************************************
}
  $web = new Fotka();
?>
