<?php
/*
 * ajax.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 * @author geniv
 * @version 1.08
 */

  require 'lightloader.php'; // load autoload
  classes\ErrorLoger::enable(__DIR__ . '/logs/');

  try {
    classes\Core::checkPHP(false);  // kontrola php verze
    $c = classes\Configurator::decode('ajax_config.php');
    echo call_user_func_array(array($c['class'], $c['method']), array());
  } catch (Exception $e) {
  	classes\ErrorLoger::logTryCatchException($e);
    die($e);
  }