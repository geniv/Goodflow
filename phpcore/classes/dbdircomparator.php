<?php
/*
 * dbdircomparator.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * Synchronizace souboru a databaze
   *
   * @package stable
   * @author geniv
   * @version 1.10
   */
  class DbDirComparator implements ICron {

    /**
     * synchronizacni metoda
     * - odstrnuje prebytecne soubory ve file systemu
     *
     * @since 1.00
     * @param array args pole konfigurace predavane z cronu, dir: adresar pro synchronizaci, db: pole polozek z databaze, ignore: pole ignorovanych souboru
     * @return int pocet smazanych souboru
     */
    public static function synchronizeCron($args = array()) {
      if (!isset($args['dir']) || !isset($args['db'])) {
        return ;
      }
      $ignore = isset($args['ignore']) ? $args['ignore'] : array(); // pokud je definovany ignore
      $files = Core::getListFile(array( // nacteni obsahu slozky
          'path' => $args['dir'],
        ));
      $path = $args['dir']; // priparava pathu na mapy
      $exists = array_filter($args['db'], function ($r) use ($path) { // nacteni existujicich souboru
          return file_exists($path . $r);
        });
      // vytvoreni rozdilu poli a aplikace souboroveho filtru
      $diff = array_filter(array_diff($files, $exists), function($r) use ($ignore) {
          return !in_array($r, $ignore);
        });
      $ret = array_map(function($r) use ($path) { // odmazani a vraceni poctu prebytku
          return file_exists($path . $r) && unlink($path . $r);
        }, $diff);
      return array_sum($ret);
    }
  }
