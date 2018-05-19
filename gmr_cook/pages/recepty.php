<?php

  namespace pages;

  use classes\IPage;

  class Recepty implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Recepty',
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

      return $tpl->template('page_recepty')->render();
    }
  }