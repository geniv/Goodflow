<?php

/**
 * Uzivatelsky nadefinovane nastaveni individualni pro kazdy projekt, pristupy adminu, moduly a IP blok adresy
 */

  include_once "login_promenne.php";  //vlozeni unikatnich loginu
  class UserPromenne extends LoginMySQLi
  {
    public $admin_ozn_menu = "class";  //jedna volba oznaceni
    public $select_admin_oznac = array ("odkaz" => "[|--|]",// "["  "]"
                                        "class" => "aktivni",
                                        "id" => " aktivnejsi"); //moznost volby oznacovani menu v adminu

    public $admin_expire = "+4 hours"; //expirace z adminu, http://php.net/manual/en/function.strtotime.php

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

                            array("include" => "modules/prepinani_podle_sekci/prepinani.php",
                                  "class" =>  "PrepinaniPodleSekci",
                                  "admin" => true,
                                  "databaze" => ".dbprepinanisekci.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "sqlite"),

                            array("include" => "modules/dynamic_tasks/tasks.php",
                                  "class" =>  "DynamicTasks",
                                  "admin" => true,
                                  "databaze" => ".dbdyntas.sqlite2",
                                  "zobrazit" => true,
                                  "uloziste" => "mysqli"),

/*
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
*/

                            );
  }
?>
