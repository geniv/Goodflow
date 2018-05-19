<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core;

  abstract class Home implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Home',
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

      return $tpl->template('page_home')->render();
    }
  }

?>
