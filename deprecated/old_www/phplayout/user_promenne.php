<?php

/**
 * Uzivatelsky nadefinovane nastaveni individualni pro kazdy projekt, pristupy adminu, moduly a IP blok adresy
 */

  include_once "login_promenne.php";  //vlozeni unikatnich loginu
  class UserPromenne extends LoginMySQLi
  {
    public $adminpristup = array ("6342fd9364b41005acce71e244849183" => "93f9a5d3507bbd81db94663fd09dc866", //ja, hesla v MD5
                                  "48acfd8edd4b6009c8257490df01c717" => "7c8c47575b1ff8a0a34e871a33b5954f", //fug
                                  "06b586c247dd639a269aa3bbe70fabac" => "2750e0d761a4d611073ae2ac3b171753", //jur
                                  "5cdd4a9ba64b43686b8a1a70f6448efc" => "19d63889e06b4a8ecebcfbffdf2845b0", //martin
                                  );

    public $admin_ozn_menu = "class";  //jedna volba oznaceni
    public $select_admin_oznac = array ("odkaz" => "[|--|]",// "["  "]"
                                        "class" => "aktivni",
                                        "id" => " aktivnejsi"); //moznost volby oznacovani menu v adminu

    public $admin_expire = array(1, 0, 0); //expirace z adminu

    public $zalohovatdni = 5;  //pocet dni pro ponechani zalohy
    public $autozaloha = true;  //true/false - aktualizace kazdy den
    public $zalohadir = "db"; //adresa slozky zalohovani databazi

    public $nazevwebu = "PHPLayout";  //definuje nazev webu

    public $default = "uvodni-sekce"; //defaultni stranka

    public $aktualizovat = true; //true/false - zapnuti aktualizaci / vypnuti aktualizaci

    public $htaccess = true;  //true/false - zapinani adres pro htaccess

    public $debug_mod = true; //true/false - zapina vyvojarsky rezim

    public $administrace = true;  //ma-li stranka obsahovat admin sekci
    public $adresaadminu = "\$ad";    //text adresy do adminu

    public $souborymenu = "sekce";  //umisteni souboru menu

    public $get_kam = "action";
    public $get_idmodul = "modul";
    public $get_submenu = "sub";

    public $moduly = array (array("include" => "funkce.php",  //hlavni funkce musi byt implicitne 0
                                  "class" => "Funkce",
                                  "admin" => true,
                                  "databaze" => NULL,
                                  "zobrazit" => true,
                                  "uloziste" => NULL),  //"sqlite|mysqli|combine"

                            array("include" => "modules/admin_databaze/admin_db.php",
                                  "class" =>  "AdministraceDatabaze",
                                  "admin" => true,
                                  "databaze" => NULL,
                                  "zobrazit" => true,
                                  "uloziste" => NULL),

                            array("include" => "modules/static_menu/static_menu.php",
                                  "class" =>  "StaticMenu",
                                  "admin" => false,
                                  "databaze" => NULL,
                                  "zobrazit" => true,
                                  "uloziste" => NULL),

                            array("include" => "modules/dynamicky_obsah/dynamicky_obsah.php",
                                  "class" =>  "DynamicObsah",
                                  "admin" => true,
                                  "databaze" => ".dbdynobsah.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),  //mysqli

                            array("include" => "modules/dynamicke_eshop_menu/eshop_menu.php",
                                  "class" =>  "DynamicEshopMenu",
                                  "admin" => true,
                                  "databaze" => ".dbdyneshmenu.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamicky_obsah_eshop/dynamicky_obsah_eshop.php",
                                  "class" =>  "DynamicObsahEshop",
                                  "admin" => true,
                                  "databaze" => ".dbdynobsaheshop.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/random_picture/random_picture.php",
                                  "class" =>  "RandomPicture",
                                  "admin" => false,
                                  "databaze" => "",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/rozliseni_podle_agenta/agent.php",
                                  "class" =>  "RozliseniPodleAgenta",
                                  "admin" => false,
                                  "databaze" => "",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/prepinani_podle_sekci/prepinani.php",
                                  "class" =>  "PrepinaniPodleSekci",
                                  "admin" => true,
                                  "databaze" => ".dbprepinanisekci.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/static_flash/flash_header.php",
                                  "class" =>  "FlashHeader",
                                  "admin" => false,
                                  "databaze" => "",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_language/language.php",
                                  "class" =>  "DynamicLanguage",
                                  "admin" => true,
                                  "databaze" => ".dbdynlanguage.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_htaccess/htaccess.php",
                                  "class" =>  "DynamicHtaccess",
                                  "admin" => true,
                                  "databaze" => ".dbdynhtaccess.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_cykl_obsah/cykl_obsah.php",
                                  "class" =>  "DynamicCyklObsah",
                                  "admin" => true,
                                  "databaze" => ".dbdyncyklobsah.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_picture_gallery/picture_gallery.php",
                                  "class" =>  "DynamicPictureGallery",
                                  "admin" => true,
                                  "databaze" => ".dbdynpicgallery.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            //dynamic menu se sekcemi
                            array("include" => "modules/dynamicky_menu/dynamicky_menu.php",
                                  "class" =>  "DynamicMenu",
                                  "admin" => true,
                                  "databaze" => ".dbdynmenu.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            //dynamic menu bez sekci
                            array("include" => "modules/dynamicky_menu_bez_skupin/dynamicky_menu.php",
                                  "class" =>  "DynamicMenuWithoutGroup",
                                  "admin" => true,
                                  "databaze" => ".dbdynmenuoutgrup.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            //dyngall
                            array("include" => "modules/dynamic_gallery/dynamicka_galerie.php",
                                  "class" =>  "DynamicGallery",
                                  "admin" => true,
                                  "databaze" => ".dbdyngallery.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),  //mysqli

                            array("include" => "modules/datovy_sklad/datovy_sklad.php",
                                  "class" =>  "DataStorage",
                                  "admin" => true,
                                  "databaze" => "",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_form/dynamicky_formular.php",
                                  "class" =>  "DynamicForm",
                                  "admin" => true,
                                  "databaze" => ".dbdynform.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/static_strankovani/strankovani.php",
                                  "class" =>  "StatickeStrankovani",
                                  "admin" => false,
                                  "databaze" => "",
                                  "zobrazit" => false,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_table/dynamicke_tabulky.php",
                                  "class" =>  "DynamicTable",
                                  "admin" => true,
                                  "databaze" => ".dbdyntable.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_random_picture/dynamicka_random_galerie.php",
                                  "class" =>  "DynamicRandomGallery",
                                  "admin" => true,
                                  "databaze" => ".dbdynrangal.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamicke_zobrazovani/dynamicke_zobrazeni.php",
                                  "class" =>  "DynamicZobrazeni",
                                  "admin" => true,
                                  "databaze" => ".dbdynzob.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "mysqli"),

                            array("include" => "modules/dynamic_drinks/dynamicke_napoje.php",
                                  "class" =>  "DynamicDrinks",
                                  "admin" => true,
                                  "databaze" => ".dbdyndri.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/captcha_code/captcha.php",
                                  "class" =>  "CaptchaCode",
                                  "admin" => true,
                                  "databaze" => ".dbcapcod.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/static_idos/idos.php",
                                  "class" =>  "StaticIdos",
                                  "admin" => false,
                                  "databaze" => "",
                                  "zobrazit" => false,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamicka_navstevni_kniha/dynamicka_kniha.php",
                                  "class" =>  "DynamicNavstevniKniha",
                                  "admin" => true,
                                  "databaze" => ".dbdynkni.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "mysqli"),

                            array("include" => "modules/dynamic_user/dynamicky_uzivatel.php",
                                  "class" =>  "DynamicUser",
                                  "admin" => true,
                                  "databaze" => ".dbdynusr.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "mysqli"),

                            array("include" => "modules/dynamicke_komentare/comment.php",
                                  "class" =>  "DynamicComment",
                                  "admin" => true,
                                  "databaze" => ".dbdyncom.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "mysqli"),

                            );

    public $ipblok = array ("127.0.1.1",  //seznam blokovanych ip pri kontrole z localhostu
                            "127.0.0.1",
                            "192.168.1.1",
                            "192.168.1.2",
                            "192.168.1.3",
                            "192.168.1.4",
                            "192.168.1.5",
                            "192.168.1.6",
                            "192.168.1.7",
                            "192.168.1.8",
                            "192.168.1.9",
                            "192.168.1.10",
                            "192.168.1.11",
                            "192.168.1.12",
                            "192.168.1.13",
                            "192.168.1.14",
                            "192.168.1.15",
                            "192.168.1.16",
                            "192.168.1.17",
                            "192.168.1.18",
                            "192.168.1.19",
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
                            "192.168.1.50",
                            "192.168.1.100",
                            "192.168.1.101",
                            "192.168.1.102",
                            "192.168.1.103",
                            "192.168.1.104",
                            "192.168.1.105");
  }
?>
