<?php

  require 'loader.php'; // load autoload

  try {

    if (classes\Core::checkPHP()) {

      // data prochazejici celym kodem
      $mainClass = new MainClass;
      // inicializace webu
      $mainClass->initialization();

      $_class = str_replace('/', '\\', $_POST['class']);  // nacteni a uprava adresy tridy
      if (method_exists($_class, $_POST['method'])) {
        echo $_class::$_POST['method']($mainClass, $_POST); // zavolani samotne metody
      } else {
        throw new Exception('neplatné volání metody!!');
      }
    }

  } catch (Exception $e) {
    die($e);
  }