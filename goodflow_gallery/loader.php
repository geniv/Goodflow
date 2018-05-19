<?php
/*
 *      loader.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  class Autoload {
    const VERSION = 1.22;
    const NOTIFICATION = 'classes\Notification';
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
      //var_dump($cesta);
      //overeni existence cesty
      if (file_exists($cesta)) {
        require $cesta; //nejrychlejsi, chyba => kritikal
      } else {
        //var_dump($name, $cesta);
        throw new ExceptionAutoload(sprintf('Class "%s" does not exist!', $cesta));
      }

    } catch (ExceptionAutoload $e) {
      //pokud neexistuje trida notifikaci
      if (class_exists(Autoload::NOTIFICATION)) {
        $class = Autoload::NOTIFICATION;
        $class::error($e);
      } else {
        echo $e;
      }
    }
  }

  class ExceptionAutoload extends Exception {}

?>
