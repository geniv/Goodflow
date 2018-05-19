<?php
/*
 * index.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  require 'lightloader.php'; // load autoload

  classes\ErrorLoger::enable(__DIR__ . '/logs/', 'geniv.radek@gmail.com');
  //~ classes\ErrorLoger::setPrintStdOut(false);
  classes\ErrorLoger::setInstantlySend(false);

  try {
    classes\Core::checkPHP(false);

    $base_class = array(
        'core' => 'classses\Core',
        'html' => 'classes\Html',
        'form' => 'classes\Form',
    );

    // class typu univerzalni prepravka pro prenaseni hodnot
    $crate = new Crate($base_class, '');

    if ($crate->cache->isCached()) {
      echo $crate->cache->getContents();
    } else {
      $crate->cache->start();
      $crate->tpl->assign($crate->toArray());

      echo $crate->tpl->template($crate->main_index_tpl)->render();  // cely index se provadi nad TPL
      $crate->cache->end();
    }
  } catch (Exception $e) {
    classes\ErrorLoger::logTryCatchException($e);
    die($e);
  }