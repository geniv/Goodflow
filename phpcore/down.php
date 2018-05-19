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
  classes\Core::getDownloadFile(base64_decode($_GET['path']), base64_decode($_GET['name']));