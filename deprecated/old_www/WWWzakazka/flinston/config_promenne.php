<?php

/**
 * Administrativne nadefinovane nastaveni skoro individualni pro kazdy projekt
 */

  include_once "user_promenne.php";

  class ConfigPromenne extends UserPromenne //promenne zdedi promenne z UserPromenne
  {
    public $default = "uvod"; //defaultni stranka

    public $klenot = true;  //true/false - nastaveni jestli je domena na klenot.cz ci ne
    public $autoklenot = true;  //true/false - (zapnuto / vypnuto auto zjistovani) - zjitsti podle IP jestli je soubor na webu si nikoli

    public $aktualizovat = true; //true/false - zapnuti aktualizaci / vypnuti aktualizaci

    public $htaccess = true;  //true/false - zapinani adres pro htaccess

    public $administrace = true;  //ma-li stranka obsahovat admin sekci
    public $adresaadminu = "\$admin";    //text adresy do adminu
    public $aktivniadmin = false; //je-li admin prihlasen bude true a aktvuje prvky s adminem

    public $souborymenu = "./sekce";  //umisteni souboru menu

    public $get_kam = "action";
    public $get_idmodul = "modul";
    public $get_submenu = "sub";

    public $prepis_pravidla = array(" " => "-",
                                    "_" => "-");
  }
?>
