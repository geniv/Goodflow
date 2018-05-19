<?php
/*
 *      configurator.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  class Configurator {
    const VERSION = 1.03;

    //nacitani modulu (administration)
    public static function getLoadModules() {
      return static::$loadModules;
    }

    //nacitani stranek (staticweb)
    public static function getLoadPages() {
      return static::$loadpages;
    }

    //nacitani uzivatelskych promennych
    public static function getUserVar($index = NULL) {
      $item = static::getUserVariable();
      return Core::isFill($item, $index, $index);
    }
  }

?>
