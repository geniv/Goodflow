<?php

  namespace pages;

  use classes\IPage,
      classes\Html,
      classes\Form,
      classes\Core;

  abstract class Admin implements IPage {
    const VISIBLE = false;
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Adminin login',
                  );
    }

    //extra JS pro danou stranku
    //~ public static function getJS() {}

    //extra CSS pro danou stranku
    //~ public static function getCSS() {}

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      $user = $data['user'];
      $html = $data['html'];

      $p = array(
                Form::CALLBACK_LABEL => function($r) {
                  return $r['html']::label()->add($r['label'] ? $r['html']::span()->setText($r['label']) : null)->add($r['element']); }
                );

      $form = new Form($p);
      $form
          ->addText('login', 'Login')
            ->setRequired('Je nutne vyplnit login')
          ->addPassword('heslo', 'Heslo')
            ->setRequired('Je nutne vyplnit heslo')
          ->addSubmit('login-submit', null, 'Přihlásit se');

      $res_out = array();
      if ($form->isSubmitted()) {

        if ($form->isValid()) {
          $val = $form->getValues();
          $user->login($val['login'], $val['heslo']);

          if (!$user->isLoggedIn(true)) {
            $res_out[] = 'špatne udaje';
          }

        } else {
          $res_out = array_merge($res_out, $form->getErrors());
        }

      }

      // pokud je prihlaseno tak automaticky redirektuje do adminu
      if ($user->isLoggedIn(true)) {
        Core::setLocation('_admin/');
      }

      $assign = array(
                      'page_admin_form' => $form->render(7),
                      'page_admin_form_out' => $res_out,
                      );
      $tpl->assign($assign);

      return $tpl->template('page_admin')->render();
    }
  }

?>
