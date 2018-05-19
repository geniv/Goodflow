<?php
/*
 *      ajax.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  //load autoload
  require 'loader.php';

  use classes\Core;

  try {

    $menu = Core::isFill($_POST, 'menu');
    if (!empty($menu)) {
      if (method_exists($menu, 'getAjax')) {
        echo $menu::getAjax();  //volani metody ajaxu dotycne tridy
      } else { throw new ExceptionAjax('Method ajax does not exist!'); }
    }

  } catch (ExceptionAjax $e) {
    echo $e;
  }

  class ExceptionAjax extends Exception {}

?>
