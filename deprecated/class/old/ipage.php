<?php
/*
 * ipage.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  interface IPage {
    //const VERSION = 1.04;
    public static function getName(); //jmeno a promenne stranky
    //public static function getJS(); //js
    //public static function getCSS(); //css
    public static function getContent(); //obsah
  }

?>
