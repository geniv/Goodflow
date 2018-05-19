<?php
/*
 *      module.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace modules;

  interface Module {
    public static function getName(); //jmeno modulu
    public static function getSection();  //nazvy sekci
    public static function getState();  //stav modulu
    public static function getLoadModules(); //nacitani js, css
    public static function getAdminContent($co);  //admin obsah
  }

?>
