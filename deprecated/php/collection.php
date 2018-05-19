<?php
/*
 *      collection.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;
//deprecated!
  class Collection {
    private static $errors;

    public static function error($e) {
      self::$errors[] = $e;
    }

    public static function getErrors() {
      return self::$errors;
    }
  }

?>
