<?php
/*
 * home.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace pages;

  use classes\IPage,
      classes\Html;

  abstract class Home implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Home',
                  'addition' => 'co děláme',
                  'idsekce' => 'hlavni');
    }

    //extra JS pro danou stranku
    public static function getJS() {}

    //extra CSS pro danou stranku
    public static function getCSS() {}

    //obsah
    public static function getContent($data = null) {
      return $data['tpl']->template('uniq_home');
    }
  }

?>
