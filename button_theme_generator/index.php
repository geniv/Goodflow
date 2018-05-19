<?php
/*
 * index.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  require 'lightloader.php'; // load autoload

  classes\ErrorLoger::enable(__DIR__ . '/logs/');

  try {
    classes\Debugger::startTime();
    classes\Core::checkPHP(false);

    $pole = array(
        'core' => 'classes\Core',
        'tplform' => 'classes\TplForm',
      );
    echo classes\Tpl::draw('index', array('auto_create' => true, 'force_compile' => true))->assign($pole);

    //echo classes\Debugger::viewTime();
  } catch (Exception $e) {
    classes\ErrorLoger::logTryCatchException($e);
    die($e);
  }