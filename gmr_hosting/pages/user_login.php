<?php

  namespace pages;

  use classes\IPage,
      classes\Core;

  class User_login implements IPage {
    const VISIBLE = false;
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Přihlásit se',
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
      $user = $data['user'];
      //~ $html = $data['html'];
      $f = $data['form_global'];

      $f->addText('user_login', 'Login')
          ->setRequired('Musí být vyplněn login')
        ->addPassword('user_heslo', 'Heslo')
          ->setRequired('Musí být vyplněno heslo')
        ->addSubmit('user_tlacitko', null, 'Přihlásit se');

      $res_out = array();
      $form_send = $f->isSubmitted();
      if ($f->isSubmitted()) {
        if ($f->isValid()) {
          $val = $f->getValues();

          $user->login($val['user_login'], $val['user_heslo']);
          if ($user->isLoggedIn(true)) {
            $data->addLastLoginUzivatel($user->getIdentity()->getId());
            $res_out[] = '<h2 class="loginfo_user">Byl jste přihlášen.</h2><p class="loginfo_tl"><a href="'.$data['weburl'].'" title="Pokračovat" class="generic_button w_arrow green"><span><span>Pokračovat</span></span></a></p>';
            Core::setRefresh(3, $data['weburl']); // pokud je prihlaseno tak automaticky redirektuje do adminu
          } else {
            $res_out[] = '<h2 class="loginfo_user">Zadal jste špatné přihlašovací údaje.</h2><p class="loginfo_tl"><a href="'.$data['weburl'].'prihlasit-se" title="Pokračovat" class="generic_button w_arrow red"><span><span>Opakovat</span></span></a></p>';
          }

        } else {
          $res_out = array_merge($res_out, $f->getErrors());
        }
      }

      $assign = array(
                  'prihlasovaci_formular' => $f->render(1),
                  'prihlasovaci_formular_send' => $form_send,
                  'prihlasovaci_formular_out' => $res_out,
                );
      $tpl->assign($assign);

      return $tpl->template('page_user_login')->render();
    }
  }