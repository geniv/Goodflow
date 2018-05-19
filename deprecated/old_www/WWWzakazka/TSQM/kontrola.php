<?php
include_once "login.php";
include_once "funkce.php";
include_once "funkce_promenne.php";

class Kontrola
{
  public $var, $action, $value;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();
    $this->var->login = new Login();
    $this->var->main = new HlavniFunkce($this->var);
    $this->var->main->VolbaJazyka();

    if ($this->var->main->OtevriMySQLi())
    {
      echo $this->KontrolujGet();
      $this->var->main->ZavriMySQLi();
    }
  }
//******************************************************************************
  function KontrolujGet() //rozdělení na subkontroly
  {
    $this->action = $_GET["action"];
    $this->value = $_GET["value"];
    
    switch ($this->action)
    {
      //************************************************************************
      case "zamlog":
        $result = $this->KontrolaLoginZamestnanec();
      break;
      //************************************************************************
      case "parlog":
        $result = $this->KontrolaLoginPartner();
      break;
      //************************************************************************
      case "genden":
        $result = $this->VygenerovaniDne();
      break;
      //************************************************************************
      //************************************************************************
      //************************************************************************
      //************************************************************************
    }

    if (strlen($this->value) == 0)
    {
      $result = "";
    }

    return $result;
  }
//******************************************************************************
  function KontrolaLoginZamestnanec() //kontroluje login zaměstnance
  {
    if ($res = @$this->var->mysqli->query("SELECT id
                                          FROM zamestnanec
                                          WHERE loginjmeno='{$this->value}';"))
    {
      if ($res->num_rows == 0)
      {
        $result = $this->var->jazyk["kon_ok"];  //ok
      }
        else
      {
        $result = $this->var->jazyk["kon_exis"]; //chyba, existuje!
      }
    }

    return $result;
  }
//******************************************************************************
  function KontrolaLoginPartner() //kontroluje login patrnera?? jestli se bude logovat?!
  {
    if ($res = @$this->var->mysqli->query("SELECT id
                                          FROM partner
                                          WHERE jmeno='{$this->value}';"))
    {
      if ($res->num_rows == 0)
      {
        $result = $this->var->jazyk["kon_ok"];  //ok
      }
        else
      {
        $result = $this->var->jazyk["kon_exis"]; //chyba, existuje!
      }
    }

    return $result;
  }
//******************************************************************************
  function VygenerovaniDne()
  {
    $result = date("w", strtotime($this->value));

    return $this->var->jazyk["den{$result}"];
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

$web = new Kontrola();
?>
