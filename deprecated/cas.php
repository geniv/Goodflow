<?php
/*
 * cas.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  $cas = '16:00';

  $timestamp = strtotime($cas);

  echo $timestamp.PHP_EOL;
  echo date('Y.m.d H:i:s', $timestamp);

?>
