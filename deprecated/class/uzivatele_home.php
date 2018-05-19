<?php

  namespace _admin\pages;

  use classes\IPage;

  class Uzivatele_home implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Uživatelé');
    }

    //extra JS pro danou stranku
    //~ public static function getJS() {}

    //extra CSS pro danou stranku
    //~ public static function getCSS() {}

    //obsah
    public static function getContent() {
      return null;
    }
  }
