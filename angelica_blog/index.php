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
    $base_class = array(
        'core' => 'classes\Core',
    );
    // class typu univerzalni prepravka pro prenaseni hodnot
    $crate = new Crate($base_class);
    $crate->tpl->assign($crate->toArray());
    echo $crate->tpl->template($crate->main_index_tpl)->render();  // cely index se provadi nad TPL
  } catch (Exception $e) {
    classes\ErrorLoger::logTryCatchException($e);
    if (classes\Configurator::decodeVariable('database_config.php', array('errorloger', 'printstdout'))) {
      die($e);
    } else {
      echo 'Vyskytla se chyba, administrátoři jsou o chybě vyrozumněni a pracují na nápravě.';
    }
  }