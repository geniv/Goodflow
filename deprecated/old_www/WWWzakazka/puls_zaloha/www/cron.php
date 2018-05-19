<?php

  include_once "default_modul.php";
  include_once "promenne.php";
  include_once "funkce.php";

class CronExecude extends DefaultModule
{
  private $var;

/**
 *
 * Konstruktor cron vykonavace
 *
 */
  public function __construct()
  {
    $this->var = new Promenne();  //vytvoreni promennych
    $this->var->main[0] = new Funkce($this->var, 0);  //vytvoreni funkce
    $this->var->main[0]->InicializaceModulu($null); //nastartuje dodatecne funkce

    $this->var->main[0]->NactiFunkci("DynamicCron", "CronAction");  //zavola jedinou vykonavaci funkci
  }

}

  $web = new CronExecude();
?>
