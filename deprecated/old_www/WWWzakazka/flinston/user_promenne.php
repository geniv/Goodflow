<?php

/**
 * Uzivatelsky nadefinovane nastaveni individualni pro kazdy projekt, pristupy adminu, moduly a IP blok adresy
 */

  class UserPromenne
  {
    public $adminpristup = array ("Geniv" => "93f9a5d3507bbd81db94663fd09dc866",  //hesla v doubleMD5
                                  "Fugess" => "7c8c47575b1ff8a0a34e871a33b5954f",
                                  "jurkix" => "2750e0d761a4d611073ae2ac3b171753"
                                  );
                                  
    public $moduly = array (array("include" => "funkce.php",  //hlavni funkce musi byt implicitne 0
                                  "class" => "Funkce",
                                  "admin" => true,
                                  "databaze" => ""),

                            array("include" => "modules/dynamicky_menu_bez_skupin_flinston_1/dynamicky_menu.php",
                                  "class" =>  "DynamicMenuWithoutGroup1",
                                  "admin" => true,
                                  "databaze" => ".dbdynmenuoutgrup.sqlite2"),

                            array("include" => "modules/dynamicky_menu_bez_skupin_flinston_2/dynamicky_menu.php",
                                  "class" =>  "DynamicMenuWithoutGroup2",
                                  "admin" => true,
                                  "databaze" => ".dbdynmenuoutgrup.sqlite2"),

                            array("include" => "modules/dynamicky_menu/dynamicky_menu.php",
                                  "class" =>  "DynamicMenu",
                                  "admin" => true,
                                  "databaze" => ".dbdynmenu.sqlite2"),

                            array("include" => "modules/dynamicky_obsah/dynamicky_obsah.php",
                                  "class" =>  "DynamicObsah",
                                  "admin" => true,
                                  "databaze" => ".dbdynobsah.sqlite2"),

                            array("include" => "modules/prepinani_podle_sekci/prepinani.php",
                                  "class" =>  "PrepinaniPodleSekci",
                                  "admin" => true,
                                  "databaze" => ".dbprepinanisekci.sqlite2"),

                            array("include" => "modules/dynamic_htaccess/htaccess.php",
                                  "class" =>  "DynamicHtaccess",
                                  "admin" => true,
                                  "databaze" => ".dbdynhtaccess.sqlite2"),

                            array("include" => "modules/dynamic_picture_gallery_flinston/picture_gallery.php",
                                  "class" =>  "DynamicPictureGallery",
                                  "admin" => true,
                                  "databaze" => ".dbdynpicgallery.sqlite2"),

                            array("include" => "modules/dynamic_gallery_flinston/dynamicka_galerie.php",
                                  "class" =>  "DynamicGallery",
                                  "admin" => true,
                                  "databaze" => ".dbdyngallery.sqlite2"),

                            array("include" => "modules/datovy_sklad/datovy_sklad.php",
                                  "class" =>  "DataStorage",
                                  "admin" => true,
                                  "databaze" => ""),

                            array("include" => "modules/dynamic_form_flinston/dynamicky_formular.php",
                                  "class" =>  "DynamicForm",
                                  "admin" => true,
                                  "databaze" => ".dbdynform.sqlite2"),
                                  
                            array("include" => "modules/static_menu_flinston/static_menu.php",
                                  "class" =>  "StaticMenu",
                                  "admin" => false,
                                  "databaze" => ""),
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
                            "192.168.1.101",
                            "192.168.1.102",
                            "192.168.1.103",
                            "192.168.1.104",
                            "192.168.1.105");
  }
?>