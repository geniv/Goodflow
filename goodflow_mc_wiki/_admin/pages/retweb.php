<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core;

  abstract class RetWeb implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Přejít na web',
                  );
    }

    //extra JS pro danou stranku
    //~ public static function getJS() {}

    //extra CSS pro danou stranku
    //~ public static function getCSS() {}

    //obsah
    public static function getContent($data = null) {
      Core::setLocation('../'); //presmerovani na web

      return '';
    }
  }

?>
