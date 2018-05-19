<?php

  namespace pages;

  use classes\IPage;

  class Novinky implements IPage {
    const VISIBLE = false;
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Novinky',
                  //'addition' => 'co děláme',
                  //'idsekce' => 'hlavni'
                  );
    }

    //extra JS pro danou stranku
    //~ public static function getJS() {}

    //extra CSS pro danou stranku
    //~ public static function getCSS() {}

    // obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      $user = $data['user'];
      //~ $html = $data['html'];
      $uri = $data['web_uri'];

//TODO do budoucna strankovani!!!!

      $id = (isset($uri['id']) ? $uri['id'] : null);

      $assign = array(
                      'novinky_link' => 'novinky',
                      'novinky_drobecek' => $data->getNovinkaNadpis($id),
                      'novinky_vypis' => $data->getNovinky(false, $id),
                      'uri_id' => $id,
                      );
      $tpl->assign($assign);

      return $tpl->template('page_novinky')->render();
    }
  }