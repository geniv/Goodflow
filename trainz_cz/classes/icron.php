<?php
/*
 * icron.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * rozhranni ktere zarucuje spolupraci s cronem
   *
   * @package stable
   * @author geniv
   * @version 1.08
   */
  interface ICron {

    /**
     * metoda kterou bude cron pri provadeni volat
     *
     * @since 1.00
     * @param array args volitelny argument, vstup bude vetsinou pole
     * @return int pocet zpracovanych polozek
     */
    public static function synchronizeCron($args = array());
  }