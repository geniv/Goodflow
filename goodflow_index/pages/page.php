<?php
/*
 *      page.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace pages;

  interface Page {
    //const URL = '';
    public static function getName(); //jmeno stranky
    public static function getUserVariable(); //uzivatelske promenne
    public static function getLoadModules(); //nacitani js, css, script
    public static function getSubMenu(); //podmenu
    public static function getContent();  //obsah
  }
?>
