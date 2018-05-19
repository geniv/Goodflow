<?php
  include_once "promenne.php";
  include_once "funkce.php";
  include_once "login.php";

class Fotka
{
  public $var;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();  //vytvorení objektu promennych
    $this->var->login = new Login();  //trida objektu
    $this->var->main = new Hlavni($this->var);  //trida hlavnich funkci
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
        case "mini": //mini
          $databaze = "fotomini";
        break;

        case "full":  //full
          $databaze = "fotofull";
        break;
      }

      if ($this->var->main->OtevriMySQLi())
      {
        if ($res = $this->var->mysqli->query("SELECT foto, typ FROM {$databaze} WHERE id={$id}"))
        {
          if ($res->num_rows != 0)
          {
            $data = $res->fetch_object();
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
      $this->var->main->ZavriMySQLi();
    }
    echo $result;
  }
//******************************************************************************
}
  $web = new Fotka();
?>
