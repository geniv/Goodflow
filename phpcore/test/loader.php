<?php
/*
 * loader.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  /**
   * hlavni loadovaci trida, modifikace pro testy
   *
   * @package stable
   * @author geniv
   * @version 3.04
   */
  class Loader {

    /**
     * metoda zajistujici autoload goodflow trid
     *
     * @param name jmeno tridy
     */
    public static function autoload($name) {
      $file = str_replace('\\', '/', strtolower($name));
      $path = __DIR__ . '/../' . $file . '.php'; // posunuti o slozku vys
      //overeni existence cesty
      if (file_exists($path)) {
        @require $path; //faster, fail => critical, @mute fail
      }
    }
  }

  //registrace noveho spl loaderu
  spl_autoload_register(array('Loader', 'autoload'));