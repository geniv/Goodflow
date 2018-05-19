<?php

  namespace pages;

  use classes\IPage;

  class Servis implements IPage {
    const VISIBLE = true;
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Servis',
                  //'addition' => 'co děláme',
                  //'idsekce' => 'hlavni'
                  );
    }

    //extra JS pro danou stranku
    public static function getJS() {}

    //extra CSS pro danou stranku
    public static function getCSS() {}

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      //~ $user = $data['user'];
      //~ $html = $data['html'];

      return $tpl->template('page_servis')->render();
    }
  }