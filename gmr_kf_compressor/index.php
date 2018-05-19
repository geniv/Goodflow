<?php
/*
 * index.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  require 'lightloader.php'; // load autoload

  classes\ErrorLoger::enable();

/**
 * kompressor KF map
 *
 * @package unstable
 * @author geniv
 * @version 1.10
 */
  try {
//TODO aplikovat TPL!!
    if (classes\Core::checkPHP()) {

      $in_list = classes\Core::getListFile(array('path' => 'kf/in', 'full' => true, 'filter-' => array('ini', 'uz2')));
//TOD predelat na: getListRecursiveAll
      $in_poc = 0;
      foreach ($in_list as $value) {
        $result = null;
        $original = __DIR__ . '/' . $value;
        $cmd = '/home/gmr/dedicated/kf/convert.sh '. $original;

//TODO generovat jen pokud soubor v out neexistuje...

        exec($cmd, $result, $core);
        if ($core == 0) {
          echo 'vygenerovano: ' . $result[0] . '<br />' . PHP_EOL;
          $in_poc++;
        }
      }

      echo '<hr />';

      $out_poc = 0;
      $in_out_list = classes\Core::getListFile(array('path' => 'kf/in', 'full' => true, 'filter+' => array('uz2')));
      foreach ($in_out_list as $value) {
        $old_uz = __DIR__ . '/' . $value;
        $new_uz = __DIR__ . '/kf/out/' . pathinfo($value, PATHINFO_FILENAME).'.uz2';

        if (copy($old_uz, $new_uz)) {
          echo 'presunuto na: ' . $new_uz . '<br />' . PHP_EOL;
          unlink($old_uz);
          $out_poc++;
        }
      }

      echo '<hr />';

      echo 'na vstupu: ' . $in_poc . ', na vystupu: ' . $out_poc . ', stav: ' . ($in_poc > 0 ? ($in_poc == $out_poc ? 'dobry' : 'spatny!') : 'prazdne...');
    }

  } catch (Exception $e) {
    die($e);
  }