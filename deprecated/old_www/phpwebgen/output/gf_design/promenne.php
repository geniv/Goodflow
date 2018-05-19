<?php

/**
 * Centralni promenne projektu, uzivatelsky definovane promenne se zdedi 'extends ConfigPromenne'
 */

  include_once "user_promenne.php";

  class Promenne extends UserPromenne //promenne zdedi promenne z ConfigPromenne
  {
    public $main;   //hlavni pole tridy funkci
    public $meta;   //meta presmerovani
    public $chyba;  //globalni hlaska chyby

    public $depozitar = "http://depozit.gfdesign.cz/"; //adresa depozitu balicku

    public $aktivniadmin = false; //je-li admin prihlasen bude true a aktvuje prvky s adminem

    public $prepis_pravidla = array(" " => "-",
                                    "_" => "-");
  }
?>