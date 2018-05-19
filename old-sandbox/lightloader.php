<?php
/*
 * loader.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  /**
   * odlehcena loadovaci trida
   *
   * @package stable
   * @author geniv
   * @version 3.08
   */
  class LightLoader {
//TODO prejmenovat a neupravovat velikot souboru!!
    /**
     * metoda zajistujici autoload trid
     *
     * @param name jmeno tridy
     */
    public static function autoload($name) {
      $file = str_replace('\\', '/', $name);
      $path = __DIR__ . '/' . $file . '.php'; // nacita od aktualniho (_DIR_) umisteni loaderu
      //overeni existence cesty
      if (file_exists($path)) {
        @require($path); //faster, fail => critical, @mute fail
      } else {
        die('<strong>Path: "'.$path.'" for class: "'.$name.'" doesn\'t exist!</strong>');
      }
    }
  }

  //registrace noveho spl loaderu
  spl_autoload_register(array('LightLoader', 'autoload'));