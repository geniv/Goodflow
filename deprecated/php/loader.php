<?php
/*
 *      loader.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

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
        //include $cesta;
        //include_once $cesta;
        require $cesta; //nejrychlejsi, chyba => kritikal
        //require_once $cesta;
      } else {
        //var_dump($name, $cesta);
        throw new ExceptionAutoload(sprintf('Class <strong>%s</strong> does not exist!', $cesta));
      }

    } catch (ExceptionAutoload $e) {
      echo $e;
    }
  }

  class ExceptionAutoload extends Exception {}

?>
