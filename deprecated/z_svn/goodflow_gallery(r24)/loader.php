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

      //$ignore = array('Exception');
      $file = str_replace('\\', '/', strtolower($name));
      $cesta = sprintf('%s/%s.php', __DIR__, $file);
      //var_dump($cesta);
      //overeni existence cesty
      if (file_exists($cesta)) {
        //include $cesta;
        //include_once $cesta;
        require $cesta; //nejrychlejsi, chyba => kritikal

        //require_once $cesta;
/*
        if (interface_exists($name, false) && class_exists($name, false)) {
          throw new ExceptionAutoload($name);
        }
*/
      } else {
        var_dump($name);
        throw new ExceptionAutoload(sprintf('Class <strong>%s</strong> does not exist!', $cesta));
      }

    } catch (ExceptionAutoload $e) {
      echo $e;
    }
  }

  class ExceptionAutoload extends Exception {}

?>
