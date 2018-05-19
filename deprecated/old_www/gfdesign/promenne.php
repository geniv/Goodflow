<?php

/**
 * Centralni promenne projektu, uzivatelsky definovane promenne se zdedi 'extends ConfigPromenne'
 */

  include_once "config_promenne.php";

  class Promenne extends ConfigPromenne //promenne zdedi promenne z ConfigPromenne
  {
    public $main;   //hlavni pole tridy funkci
    public $meta;   //meta presmerovani
    public $chyba;  //globalni hlaska chyby

    public $depozitar = "http://depozit.gfdesign.cz/"; //adresa depozitu balicku
  }
?>
