<?php
/*
 * down.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 * pro-ajaxove-stahovani
 */

  require 'lightloader.php'; // load autoload
  classes\ErrorLoger::enable(__DIR__ . '/logs/');

  try {
    if (isset($_GET['path']) && isset($_GET['name'])) {
      $path = base64_decode($_GET['path']);
      $name = base64_decode($_GET['name']);
      if (dirname($path) === 'files') { // ochrana proti stouralum
        classes\Core::getDownloadFile($path, classes\Core::getSafeName($name));
      } else {
        throw new Exception('neexistuje path: '.$path.', name: '.$name);
      }
    } else {
      throw new Exception('nebyly zadany parametry');
    }
  } catch (Exception $e) {
    classes\Core::setLocation(classes\Core::getUrl());  // presmerovani zpet
    classes\ErrorLoger::logTryCatchException($e); // zalogaovani
  }