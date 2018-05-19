<?php

  namespace pages;

  use classes\IPage;

  class Herni_servery implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Herní servery',
                  //'addition' => 'co děláme',
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
      
      //TODO url dane na pevno nebo brane z konfigu?

      return $tpl->template('page_herni_servery')->render();
    }
  }