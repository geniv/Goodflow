<?php

/**
 * Uzivatelsky nadefinovane nastaveni individualni pro kazdy projekt, pristupy adminu, moduly a IP blok adresy
 */

  include_once "login_promenne.php";  //vlozeni unikatnich loginu
  class UserPromenne extends LoginMySQLi
  {
    public $adminpristup = array ("06b586c247dd639a269aa3bbe70fabac" => "2750e0d761a4d611073ae2ac3b171753",
                                  "48acfd8edd4b6009c8257490df01c717" => "7c8c47575b1ff8a0a34e871a33b5954f",
                                  "5cdd4a9ba64b43686b8a1a70f6448efc" => "19d63889e06b4a8ecebcfbffdf2845b0",
                                  "6342fd9364b41005acce71e244849183" => "93f9a5d3507bbd81db94663fd09dc866",
                                  );

    public $admin_ozn_menu = "odkaz";  //jedna volba oznaceni
    public $select_admin_oznac = array ("odkaz" => "[|--|]",// "["  "]"
                                        "class" => "aktivni",
                                        "id" => "aktivnejsi"); //moznost volby oznacovani menu v adminu

    public $ente_ozn_od = 0;  //pocitat od cisla
    public $ente_ozn_po = 2;  //poctat po cisle
    public $ente_definovane = false;  //indikuje zda brat linearne a nebo volitelne
    public $ente_ozn_def = array(1, 5, 8);  //definovane oznacovani

    public $admin_expire = array(0, 30, 0); //expirace z adminu

    public $zalohovatdni = 5;  //pocet dni pro ponechani zalohy
    public $autozaloha = true;  //true/false - aktualizace kazdy den
    public $zalohadir = "db"; //adresa slozky zalohovani databazi

    public $nazevwebu = "Kvarta matrace";  //definuje nazev webu

    public $default = "uvod"; //defaultni stranka

    public $klenot = true;  //true/false - nastaveni jestli je domena na klenot.cz ci ne
    public $autoklenot = true;  //true/false - (zapnuto / vypnuto auto zjistovani) - zjitsti podle IP jestli je soubor na webu ci nikoli

    public $aktualizovat = true; //true/false - zapnuti aktualizaci / vypnuti aktualizaci

    public $htaccess = true;  //true/false - zapinani adres pro htaccess

    public $debug_mod = false; //true/false - zapina vyvojarsky rezim

    public $administrace = true;  //ma-li stranka obsahovat admin sekci
    public $adresaadminu = "\$ad";    //text adresy do adminu

    public $souborymenu = "sekce";  //umisteni souboru menu
    public $souboryinclude = "included";  //umsteni included

    public $get_kam = "action";
    public $get_idmodul = "modul";
    public $get_submenu = "sub";

    //moduly webu
    public $moduly = array (array("include" => "funkce.php",  //hlavni funkce musi byt implicitne na 0.
                                  "class" => "Funkce",
                                  "admin" => true,
                                  "databaze" => "",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/static_menu/static_menu.php",
                                  "class" =>  "StaticMenu",
                                  "admin" => false,
                                  "databaze" => "",
                                  "zobrazit" => false,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/admin_databaze/admin_db.php",
                                  "class" =>  "AdministraceDatabaze",
                                  "admin" => true,
                                  "databaze" => "",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/datovy_sklad/datovy_sklad.php",
                                  "class" =>  "DataStorage",
                                  "admin" => true,
                                  "databaze" => "",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/prepinani_podle_sekci/prepinani.php",
                                  "class" =>  "PrepinaniPodleSekci",
                                  "admin" => true,
                                  "databaze" => ".dbpre.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_language/language.php",
                                  "class" =>  "DynamicLanguage",
                                  "admin" => true,
                                  "databaze" => ".dblan.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamicky_obsah/dynamicky_obsah.php",
                                  "class" =>  "DynamicObsah",
                                  "admin" => true,
                                  "databaze" => ".dbdynobs.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamicke_zobrazovani/dynamicke_zobrazeni.php",
                                  "class" =>  "DynamicZobrazeni",
                                  "admin" => true,
                                  "databaze" => ".dbdynzob.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/static_flash/flash_header.php",
                                  "class" =>  "FlashHeader",
                                  "admin" => false,
                                  "databaze" => "",
                                  "zobrazit" => false,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_htaccess/htaccess.php",
                                  "class" =>  "DynamicHtaccess",
                                  "admin" => true,
                                  "databaze" => ".dbhta.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),
);

    //seznam blokovanych ip pri kontrole z localhostu
    public $ipblok = array ("127.0.0.1",
                            "127.0.1.1",
                            "192.168.1.1",
                            "192.168.1.10",
                            "192.168.1.101",
                            "192.168.1.102",
                            "192.168.1.103",
                            "192.168.1.104",
                            "192.168.1.105",
                            "192.168.1.11",
                            "192.168.1.12",
                            "192.168.1.13",
                            "192.168.1.14",
                            "192.168.1.15",
                            "192.168.1.16",
                            "192.168.1.17",
                            "192.168.1.18",
                            "192.168.1.19",
                            "192.168.1.2",
                            "192.168.1.20",
                            "192.168.1.21",
                            "192.168.1.22",
                            "192.168.1.23",
                            "192.168.1.24",
                            "192.168.1.25",
                            "192.168.1.26",
                            "192.168.1.27",
                            "192.168.1.28",
                            "192.168.1.29",
                            "192.168.1.3",
                            "192.168.1.30",
                            "192.168.1.31",
                            "192.168.1.32",
                            "192.168.1.33",
                            "192.168.1.34",
                            "192.168.1.35",
                            "192.168.1.36",
                            "192.168.1.37",
                            "192.168.1.38",
                            "192.168.1.39",
                            "192.168.1.4",
                            "192.168.1.40",
                            "192.168.1.41",
                            "192.168.1.42",
                            "192.168.1.43",
                            "192.168.1.44",
                            "192.168.1.45",
                            "192.168.1.46",
                            "192.168.1.47",
                            "192.168.1.48",
                            "192.168.1.49",
                            "192.168.1.5",
                            "192.168.1.50",
                            "192.168.1.6",
                            "192.168.1.7",
                            "192.168.1.8",
                            "192.168.1.9",
                            );
  }
?>
