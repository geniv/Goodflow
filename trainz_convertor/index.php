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
    classes\Core::checkPHP(false);
    echo classes\Tpl::draw('index', array('auto_create' => false));
  } catch (Exception $e) {
    die($e);
  }