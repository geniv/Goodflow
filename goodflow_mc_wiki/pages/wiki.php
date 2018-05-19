<?php

  namespace pages;

  use classes\IPage;

  abstract class Wiki implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Wiki',
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

      //TODO nejaky assigny pro data nazvejkane z databaze!!!

      return $tpl->template('page_wiki')->render();
    }
  }

?>
