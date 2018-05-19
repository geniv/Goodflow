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
 * kompressor KF wavemask creator
 *
 * @package unstable
 * @author geniv
 * @version 1.20
 */
  try {

    if (classes\Core::checkPHP()) {
//http://metalmedved.com/en/nastrojka-pesochnicy.html
      $tpl = new classes\Tpl;//(array('debug' => true));

      //~ $file_name = 'config_death_space.json';
      //~ $file_name = 'config_default.json';

      //~ $json = null;
      //~ if (file_exists($file_name)) {
        //~ $file = file_get_contents($file_name);
        //~ $json = json_decode($file, true);
      //~ }

      //~ $monster = array(
        //~ 'A' => 'Clot',
        //~ 'B' => 'Crawler',
        //~ 'C' => 'GoreFast',
        //~ 'D' => 'Stalker',
        //~ 'E' => 'Scrake',
        //~ 'F' => 'Fleshpound',
        //~ 'G' => 'Bloat',
        //~ 'H' => 'Siren',
        //~ 'I' => 'Husk',
      //~ );

      //~ if (isset($json['monster'])) {
        //~ $monster = $json['monster'];
      //~ }
      //~ $tpl->assign('monster', $monster);

      //~ $squad = array(
        //~ '4A',
        //~ '4A1G',
        //~ '2B',
        //~ '4B',
        //~ '3A1G',
        //~ '2D',
        //~ '3A1C',
        //~ '2A2C',
        //~ '2A3B1C',
        //~ '1A3C',
        //~ '3A1C1H',
        //~ '3A1B2D1G1H',
        //~ '3A1E',
        //~ '2A1E',
        //~ '2A3C1E',
        //~ '2B3D1G2H',
        //~ '4A1C',
        //~ '4A',
        //~ '4D',
        //~ '4C',
        //~ '6B',
        //~ '2B2C2D1H',
        //~ '2A2B2C2H',
        //~ '1F',
        //~ '1I',
        //~ '2A1C1I',
        //~ '2I',
      //~ );

      //~ if (isset($json['squad'])) {
        //~ $squad = $json['squad'];
      //~ }
      //~ $tpl->assign('squad', $squad);

      //~ echo 'monsters: <br />'.PHP_EOL;
      //~ foreach ($monster as $i => $v) {
        //~ echo $i.': '.$v.' <br />'.PHP_EOL;
      //~ }

      //~ echo '<hr />'.PHP_EOL;



      //~ $tpl->assign('num', $num);

      //~ $q = '<form><input type="text" name="num" value="'.$num.'"><input type="submit"></form><hr />';

      //~ echo $q;

      //~ $dec = $num; //196611 / 125892608;

      //~ echo 'pro cislo: '.$dec.' je: <hr />'.PHP_EOL;

      //~ $tpl->assign('num', $num);

      //~ $bin = decbin($dec);
      //~ $doplnit = count($squad) - strlen($bin);
      //~ $finalbin = str_repeat('0', $doplnit) . $bin;
      //~ $split = str_split($finalbin);
      //~ $poc = count($squad) - 1;
      //~ $prenos = array();


      //~ $tpl->assign('poc', $poc)
          //~ ->assign('split', $split);

      /*
      foreach ($split as $i => $v) {
        if ($split[$poc]) {
          $skupinky = $squad[$i];
          $prenos[$i] = $i;
          $sk = str_split($skupinky);
          foreach ($sk as $id => $va) {
            if ($id % 2 == 0) {
              echo 'poc: '.$va.'x ';
            } else {
              echo $monster[$va] . '<br />'.PHP_EOL;
            }
          }
          echo '<hr />'.PHP_EOL;
        }
        $poc--;
      }

      echo '<hr />'.PHP_EOL;
      */

      //~ $index = isset($_GET['index']) ? $_GET['index'] : $prenos;

      //~ $tpl->assign('index', $index);

      //~ echo '<form>';
      //~ foreach ($squad as $i => $s) {
        //~ echo 'i='.$i.':  <input type="checkbox" name="index['.$i.']" value="'.$i.'"'.(isset($index[$i]) ? ' checked' : '').'>:  ' .$s.  '<br />'.PHP_EOL;
      //~ }
      //~ echo '<input type="submit"></form><hr />';

      //~ if ($index) {
        //~ $pole = null;
        //~ foreach ($squad as $i => $v) {
          //~ $pole[] = (isset($index[$i]) ? 1 : 0);
        //~ }
        //~ $novy = implode('', array_reverse($pole));
        //~ echo 'WaveMask=' . bindec($novy);
      //~ }

      //~ echo '<hr />'.PHP_EOL;

      //~ echo 'editace squadu:';

      //~ $f = '<form><input type="submit" value="++ pridat squadronu" name="plus"><br />'.PHP_EOL;

      //~ if (isset($_GET['plus'])) {
        //~ $squad[] = '';
      //~ }

      //~ foreach ($squad as $i => $v) {
        //~ $f .= '<input type="text" name="val['.$i.']" value="'.$v.'"><br />'.PHP_EOL;
      //~ }
      //~ $f .= '<input type="submit" name="save" value="ulozit"></form>';

      //~ echo $f;

      //~ $newsquad = array();
      //~ if (isset($_GET['val'])) {
        //~ $newsquad = array_filter($_GET['val']);
      //~ }

      //~ $fin = array(
        //~ 'monster' => $monster,
        //~ 'squad' => $newsquad,
      //~ );

      //~ if (isset($_GET['save']) && $_GET['save'] == 'ulozit') {
        //~ echo 'ulozeno';
        //~ file_put_contents($file_name, json_encode($fin));
        //~ Core::setRefresh(0, Core::getUrl());
      //~ }

      echo $tpl->template('main');
    }

  } catch (Exception $e) {
    classes\ErrorLoger::logTryCatchException($e);
    echo $e;
  }