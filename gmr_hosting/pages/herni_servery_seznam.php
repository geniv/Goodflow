<?php

  namespace pages;

  use classes\IPage;

  class Herni_servery_seznam implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Herní servery - Seznam',
                  'menu' => 'Seznam',
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
      $db = $data['db'];

      $dbVypis = $db->query('nabidka_her', array('idnabidka_hra', 'nazev', 'url', 'popis', 'cena', 'minslotu', 'maxslotu'), 'smazano is null', null, null, null, 'poradi ASC, nazev ASC');

      $assign = array(
                      'nabidka_her_vypis' => $dbVypis,
                      );
      $tpl->assign($assign);

      return $tpl->template('page_herni_servery_seznam')->render();
    }
  }