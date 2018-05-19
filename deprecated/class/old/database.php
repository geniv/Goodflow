<?php
/*
 *      database.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */
//FIXME mozna nini uplne dobry napad!!!!
  namespace classes;

  use Exception;

  //vzor singleton
  final class Database implements Singleton {
    const VERSION = 1.0;
    private static $instance = NULL;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
      if (is_null(self::$instance)) {
        self::$instance = new self;
      }
      return self::$instance;
    }

    //
  }

  class ExceptionDatabase extends Exception {}

?>
