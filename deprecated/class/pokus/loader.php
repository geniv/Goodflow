<?php
/*
 * loader.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  class Autoload {
    const VERSION = 1.26;
  }

  /**
   * Autoload classes
   *
   * @param name string
   */
  function __autoload($name) {
    try {

      $file = str_replace('\\', '/', strtolower($name));
      $cesta = sprintf('%s/%s.php', __DIR__, $file);
      //overeni existence cesty
      if (file_exists($cesta)) {
        @require $cesta; //faster, fail => critical, @mute fail
      } else {
        throw new ExceptionAutoload(sprintf('Class "%s" does not exist!', $cesta));
      }

    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  class ExceptionAutoload extends Exception {}

?>
