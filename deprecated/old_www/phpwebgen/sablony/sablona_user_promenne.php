<?php

/**
 * Uzivatelsky nadefinovane nastaveni individualni pro kazdy projekt, pristupy adminu, moduly a IP blok adresy
 */

  include_once "login_promenne.php";  //vlozeni unikatnich loginu
  class UserPromenne extends LoginMySQLi
  {
    public $adminpristup = array (%%admini%%);

    public $admin_ozn_menu = "%%admin_ozn_menu%%";  //jedna volba oznaceni
    public $select_admin_oznac = array ("odkaz" => "%%select_admin_oznac0%%|--|%%select_admin_oznac1%%",// "["  "]"
                                        "class" => "%%select_admin_oznac2%%",
                                        "id" => "%%select_admin_oznac3%%"); //moznost volby oznacovani menu v adminu

    public $admin_expire = array(%%admin_expire_hod%%, %%admin_expire_min%%, %%admin_expire_sec%%); //expirace z adminu

    public $zalohovatdni = %%zalohovatdni%%;  //pocet dni pro ponechani zalohy
    public $autozaloha = %%autozaloha%%;  //true/false - aktualizace kazdy den
    public $zalohadir = "%%zalohadir%%"; //adresa slozky zalohovani databazi

    public $nazevwebu = "%%nazevwebu%%";  //definuje nazev webu

    public $default = "%%default%%"; //defaultni stranka

    public $aktualizovat = %%aktualizovat%%; //true/false - zapnuti aktualizaci / vypnuti aktualizaci

    public $htaccess = %%htaccess%%;  //true/false - zapinani adres pro htaccess

    public $debug_mod = %%debug_mod%%; //true/false - zapina vyvojarsky rezim

    public $administrace = %%administrace%%;  //ma-li stranka obsahovat admin sekci
    public $adresaadminu = "%%adresaadminu%%";    //text adresy do adminu

    public $souborymenu = "%%souborymenu%%";  //umisteni souboru menu
    public $souboryinclude = "%%souboryinclude%%";  //umsteni included

    public $get_kam = "%%get_kam%%";
    public $get_idmodul = "%%get_idmodul%%";
    public $get_submenu = "%%get_submenu%%";

    //moduly webu
    public $moduly = array (%%moduly%%);

    //seznam blokovanych ip pri kontrole z localhostu
    public $ipblok = array (%%ip%%);
  }
?>
