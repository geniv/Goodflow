<?php
include_once "login.php";
include_once "funkce_promenne.php";
include_once "funkce.php";

class Fotka
{
  public $var;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();  //třída proměnné
    $this->var->login = new Login();  //třída objektů
    $this->var->main = new HlavniFunkce($this->var);  //třída hlavních funkcí
    $this->Fotka(); //zavolánní výpisu fotky
  }
//******************************************************************************
  function Fotka()
  {
    if (!Empty($_GET["id"]) && !Empty($_GET["sekce"]))
    {
      $id = $_GET["id"];
      settype($id, "integer");
      $sekce = $_GET["sekce"];

      switch($sekce)
      {
        case "zamestnancimini": //zamestnanci
          $databaze = "fotozamestnanecmini";
        break;

        case "zamestnancifull":
          $databaze = "fotozamestnanecfull";
        break;

        case "partnerimini":  //partneri
          $databaze = "fotopartnermini";
        break;

        case "partnerifull":
          $databaze = "fotopartnerfull";
        break;

        case "zakaznicimini":  //zakaznici
          $databaze = "fotozakaznikmini";
        break;

        case "zakaznicifull":
          $databaze = "fotozakaznikfull";
        break;
      }

      if ($this->var->main->OtevriMySQLi())
      {
        if ($res = $this->var->mysqli->query("SELECT foto, typ FROM $databaze WHERE id=$id"))
        {
          if ($res->num_rows != 0)
          {
            $data = $res->fetch_object();
            header("Content-Type: $data->typ"); //hlavička
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
        $this->var->main->ZavriMySQLi();
      }
    }
    echo $result;
  }
//******************************************************************************
}
  $web = new Fotka();
?>
