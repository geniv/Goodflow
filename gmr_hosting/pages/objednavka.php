<?php

  namespace pages;

  use classes\IPage;

  class Objednavka implements IPage {
    const VISIBLE = false;
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Objednávka',
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

      //TODO nejlepsi cast stranek!

      return $tpl->template('page_objednavka')->render();
    }
  }