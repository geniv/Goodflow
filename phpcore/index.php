<?php
/*
 * classes_test.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  require 'lightloader.php'; //load autoload

  //VERSION = 1.24;

  try {
    $path = '..'; // path kde jsou soubory

    $url = classes\Core::getUrl();

    $dirList = classes\Core::getListDir(array('path' => $path));

    $result = '';

    $current_path = isset($_GET['path']) ? $_GET['path'] : null;

    $r = array();
    foreach ($dirList as $dir) {
      $p = $path . '/' . $dir;
      $r[] = $current_path == $p ? '<strong>'.$dir.'</strong>' : '<a href="' . $url . basename(__FILE__) . '?path=' . $p . '">' . $dir . '</a>';
    }
    $result .= implode(', ', $r) . '<hr />';

    if (isset($_GET['path'])) {
      $pathFile = $_GET['path'].'/classes';

      $weburl = $url . basename(__FILE__) . '?path=' . $_GET['path'] ;

      $result .= 'stav pro: <h1>'.dirname($pathFile).'</h1> pr: <a href="'.$url.$_GET['path'].'">go</a><br />';

      if (isset($_GET['copy'])) {
        $srcPath = 'classes/'.$_GET['copy'];
        $destPath = $pathFile.'/'.$_GET['copy'];

        $result .= '<hr />';

        if (@copy($srcPath, $destPath)) {
          @chmod($destPath, 0777);
          $result .= 'zkopirovano';
          classes\Core::setRefresh(1, '?path='.$_GET['path']);  // obnova
        } else {
          $result .= 'nelze zkopirovat, zkousim smazat...';
          if (!@unlink($destPath)) {
            $result .= 'tyvole, to nejde ani smazat';
          } else {
            if (@copy($srcPath, $destPath)) {
              $result .= 'smazano a zkopirovano znovu';
              classes\Core::setRefresh(1, '?path='.$_GET['path']);  // obnova
            }
          }
        }
        $result .= '<hr />';
      }

      $fileList = classes\Core::getListRecursiveAll(array('path' => $pathFile, 'onlyfile' => true));

      $selfPath = 'classes';

      if (!empty($fileList)) {
        $poclink = $pocakt = $pocnexist = 0;
        foreach ($fileList as $item) {

          $pO = $selfPath.'/'.$item;  //vlastni
          $pX = $pathFile.'/'.$item;  //testovane

          if (file_exists($pO)) { // && file_exists($pX)
            $type = filetype($pX);
            //pocitani
            if ($type == 'link') {$poclink++;}
            $md5_hash = (md5_file($pO) === md5_file($pX));
            if ($md5_hash) {$pocakt++;}
            $result .= $item.' - (<font color="'.($type == 'link' ? 'red' : 'blue').'">'.$type.'</font>) - <b>'.($md5_hash ? '<font color="blue">AKTUALNI</font>' : 'STARE').'</b>;  last modify: <b>'.date('d.m.Y H:i:s', filemtime($pX)).'</b> '.($md5_hash ? '' : '<a href="'.$weburl.'&copy='.$item.'">kopírovat do projektu</a>').'<br />';
          } else {
            $result .= 'neexistuje: <i>'.$item.'</i><br />';
            $pocnexist++;
          }
        }

        $r_link = round($poclink / count($fileList), 2) * 100;
        $r_akt = round($pocakt / count($fileList), 2) * 100;
        $r_nexist = round($pocnexist / count($fileList), 2) * 100;

        $result .= '<hr />
        Linky na: '.$r_link.'%<br />
        Aktualni na: '.$r_akt.'%<br />
        Jiz neexistujicich: '.$r_nexist.'%<br />';

      } else {
        $result .= 'zadna polozka';
      }
    }

  } catch (Exception $e) {
    $result .= $e;
  }

  echo $result;
