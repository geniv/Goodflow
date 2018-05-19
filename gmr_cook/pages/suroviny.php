<?php

  namespace pages;

  use classes\IPage;

  class Suroviny implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Suroviny',
                  //'addition' => 'co děláme',
                  //'idsekce' => 'hlavni'
                  );
    }

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      //~ $user = $data['user'];
      //~ $html = $data['html'];

      //TODO nejaky assigny pro nejaka data z databaze!!!

      return $tpl->template('page_suroviny')->render();
    }
  }