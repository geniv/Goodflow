<?php
include_once "promenne.php";
include_once "funkce.php";

class Zeme
{
  public $var;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();
    $this->var->main = new Funkce($this->var);

    $num = $_POST["ipnum"];
    if (!Empty($num) &&
        $num != 0)
    {
      echo $this->var->main->ZjistiZemi($num);
    }
  }
//******************************************************************************
}

$web = new Zeme();
?>