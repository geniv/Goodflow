<?php
/*
 *      ajax.php
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

      $file = strtolower($name);
      $cesta = "{$file}.php";
      //overovani existence cesty
      if (file_exists($cesta)) {
        include_once $cesta;
      } else {
        throw new ExceptionAutoload($cesta);
      }

    } catch (ExceptionAutoload $e) {
      echo sprintf('Třída <strong>%s</strong> neexistuje!', $e->getMessage());
    }
  }

  class ExceptionAutoload extends Exception {}

  try {

    $menu = Core::isFill($_POST, 'menu');
    if (!empty($menu)) {
      if (method_exists($menu, 'getAjax')) {
        echo $menu::getAjax();  //volani metody ajaxu dotycne tridy
      } else { throw new ExceptionAjax; }
    }

  } catch (ExceptionAjax $e) {
    echo 'Metoda Ajax-u neexistuje!';
  }

  class ExceptionAjax extends Exception {}

?>
