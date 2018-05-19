<?php
/*
 *      isingleton.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  interface ISingleton {
    //const VERSION = 1.2;
    //private static $instance = NULL;
    //private function __construct() {}
    //private function __clone() {}
    //private function __wakeup() {}
    public static function getInstance();
  }

?>
