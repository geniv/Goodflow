<?php

  namespace pages;

  use classes\IPage;

  class Herni_servery_akce implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Herní servery - Akce',
                  'menu' => 'Akce',
                  //'idsekce' => 'hlavni'
                  );
    }

    //extra JS pro danou stranku
    //~ public static function getJS() {}

    //extra CSS pro danou stranku
    //~ public static function getCSS() {}

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      //~ $user = $data['user'];
      //~ $html = $data['html'];

      return $tpl->template('page_herni_servery_akce')->render();
    }
  }