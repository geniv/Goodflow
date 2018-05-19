<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core;

  class Statistiky_Home implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Statistiky',
                  'name_blok' => 'Home',
                  'name_sekce' => 'Home výpis',
                  'icon' => 'icon-bar-chart',
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

      //TODO nejaky kod...

      //~ $assign = array(
                      //~ 'page_admin_form' => $form->render(7),
                      //~ 'page_admin_form_out' => $res_out,
                      //~ );
      //~ $tpl->assign($assign);

      return $tpl->template('statistiky/statistiky_home')->render();
    }
  }