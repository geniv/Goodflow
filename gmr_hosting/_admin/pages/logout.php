<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core;

  class Logout implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Odhlásit se',
                  'icon' => 'icon-off',
                  );
    }

    //extra JS pro danou stranku
    //~ public static function getJS() {}

    //extra CSS pro danou stranku
    //~ public static function getCSS() {}

    //obsah
    public static function getContent($data = null) {
      $spravce = $data['spravce'];

      $spravce->logout();  //odhlaseni bez vymazani identity
      Core::setLocation($data['weburl'].'../'); //presmerovani na web

      return '';
    }
  }