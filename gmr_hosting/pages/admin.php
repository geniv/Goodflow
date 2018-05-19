<?php

  namespace pages;

  use classes\IPage,
      classes\Html,
      classes\Core;

  class Admin implements IPage {
    const VISIBLE = false;
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Vstup do administrace',
                  );
    }

    //extra JS pro danou stranku
    //~ public static function getJS() {}

    //extra CSS pro danou stranku
    //~ public static function getCSS() {}

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      $spravce = $data['spravce'];
      $html = $data['html'];
      $f = $data['form_global'];

      $f->addText('admin_login', 'Login')
          ->setRequired('Musí být vyplněn login')
        ->addPassword('admin_heslo', 'Heslo')
          ->setRequired('Musí být vyplněno heslo')
        ->addSubmit('admin_tlacitko', null, 'Přihlásit se');

      $res_out = array();
      if ($f->isSubmitted()) {
        if ($f->isValid()) {
          $val = $f->getValues();
          $spravce->login($val['admin_login'], $val['admin_heslo']);

          if ($spravce->isLoggedIn(true)) {
            $data->addLastLoginSpravce($spravce->getIdentity()->getId());
            $res_out[] = '<h2 class="loginfo_user">Probíhá přihlašování...</h2>';
            //~ Core::setLocation($data['weburl'].'_admin/');
          } else {
            $res_out[] = '<h2 class="loginfo_user">Zadal jste špatné přihlašovací údaje.</h2>';
          }

        } else {
          $res_out = array_merge($res_out, $f->getErrors());
        }
      }

      if ($spravce->isLoggedIn(true)) {
        Core::setLocation($data['weburl'].'_admin/');
      }

      $assign = array(
                      'admin_login_form' => (!$f->isSubmitted() ? $f->render(1) : null),
                      'admin_login_form_out' => $res_out,
                      );
      $tpl->assign($assign);

      return $tpl->template('page_admin')->render();
    }
  }