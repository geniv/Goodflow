<?php
/*
 *      configurator.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use Exception;

  class Configurator {
    const VERSION = 1.04;

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

//vytahovani textu podle metody a pripadneho dodatku
    public static function s($method, $dodatek = NULL) {
      try {

        $result = NULL;
        $texts = static::getText();
        if (array_key_exists($method, $texts)) {
          if (!empty($dodatek)) {
            if (array_key_exists($dodatek, $texts[$method])) {
              $result = $texts[$method][$dodatek];
            } else {
              throw new ExceptionConfigurator(sprintf('Index textu: "%s" a s dodatkem: "%s" neexistuje!', $method, $dodatek));
            }
          } else {
            $result = $texts[$method];
          }
        } else {
          throw new ExceptionConfigurator(sprintf('Index textu: "%s" neexistuje!', $method));
        }

      } catch (ExceptionConfigurator $e) {
        echo $e;
      }
      return $result;
    }
  }

  class ExceptionConfigurator extends Exception {}

?>
