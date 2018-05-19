<?php
/*
 * loader.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  /**
   * hlavni loadovaci trida
   *
   * @package stable
   * @author geniv
   * @version 2.12
   */
  class Loader {

    private static $debug = false;
    private static $exceptionDir = null;

    /**
     * zmena stavu debug vypisu
     *
     * @param state true pro zapnuti debug modu
     */
    public static function setDebug($state) {
      self::$debug = $state;
    }

    /**
     * zjisteni stavu debug modu
     *
     * @return true kdyz je debug mod zapnuty
     */
    public static function getDebug() {
      return self::$debug;
    }

    /**
     * nastaveni adresare ktery tvori vyjimku pro strtolower
     *
     * @param dir adresar vyjimky
     */
    public static function setExtrudeDir($dir) {
      self::$exceptionDir = $dir;
    }

    /**
     * metoda zajistujici autoload goodflow trid
     *
     * @param name jmeno tridy
     */
    public static function autoload($name) {
      if (self::$debug) {
        echo 'try load class: '.$name.'<br />'.PHP_EOL;
      }

      try {
        $file = str_replace('\\', '/', strtolower($name));
        if (!empty(self::$exceptionDir)) {  //pokud je neco ve vyjimkach
          if (preg_match('/'.self::$exceptionDir.'/', $name)) {
            $file = str_replace('\\', '/', $name);
          }
        }

        //$cesta = sprintf('%s/%s.php', __DIR__, $file);
        $cesta = __DIR__ . '/' . $file . '.php';
        //overeni existence cesty
        if (file_exists($cesta)) {
          @require $cesta; //faster, fail => critical, @mute fail
        } else {
          throw new ExceptionLoader('<strong>Path: "'.$cesta.'" for class: "'.$name.'" doesn\'t exist!</strong>');
        }
      } catch (ExceptionLoader $e) {
        echo $e;
      }

      if (self::$debug) {
        if (class_exists($name, false)) {
          echo $name.' have been successfully load.<br />'.PHP_EOL;
        }
      }
    }
  }

  //registrace noveho spl loaderu
  spl_autoload_register(array('Loader', 'autoload'));

  /**
   * trida vyjimky pro Loader
   *
   * @package stable
   * @author geniv
   * @version 1.00
   */
  class ExceptionLoader extends \Exception {}