<?php

  namespace pages;

  use classes\IPage,
      classes\Core,
      classes\Form,
      classes\ContentValues;

  class Registrace implements IPage {
    const VISIBLE = false;
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Registrace',
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
      $f = $data['form_global'];
      $uri = $data['web_uri'];
      $db = $data['db'];

      //TODO pokud uzivatel bude chtit po objednavce registrovat tak se mu otevre: gmr_hosting/registrace

      $login_range = array(5, 30);
      $heslo_min = 5;

      $f->addText('registrace_login', 'Login', null, array('maxlength' => 30))
          ->setRequired('Je nutne vyplnit login')
          ->addRule(Form::LENGTH, 'login nevyhovuje delce %s az %s', $login_range)
        ->addPassword('registrace_heslo', 'Heslo')
          ->setRequired('Je nutne vyplnit heslo 1')
          ->addRule(Form::MIN_LENGTH, 'heslo nevyhovuje delce %s', $heslo_min)
        ->addPassword('registrace_heslo2', 'Heslo znovu')
          ->setRequired('Je nutne vyplnit heslo 2')
          ->addRule(Form::MIN_LENGTH, 'heslo 2 nevyhovuje delce %s', $heslo_min)
          ->addRule(Form::EQUAL, 'hesla musi byt stejny!', $f['registrace_heslo'])
        ->addText('registrace_email', 'Email', null, array('maxlength' => 100))
          ->setRequired('Je nutne vyplnit email')
          ->addRule(Form::EMAIL, 'musi byt vlasidni email!')
          ->addRule(Form::MAX_LENGTH, 'maximální délka emailu je %s', 100)
        ->addSelect('registrace_zeme', 'Země')
          ->setItems($data->getZeme());

        $typ = (isset($uri['typ']) ? $uri['typ'] : null);
        if ($typ) {
          $f->addText('registrace_jmeno', 'Jméno', null, array('maxlength' => 100))
              ->setRequired('Je nutne vyplnit jméno')
              ->addRule(Form::MAX_LENGTH, 'maximální délka jména je %s', 100)
            ->addText('registrace_prijmeni', 'Příjmení', null, array('maxlength' => 100))
              ->setRequired('Je nutne vyplnit příjmení')
              ->addRule(Form::MAX_LENGTH, 'maximální délka přijmení je %s', 100)
            ->addText('registrace_telefon', 'Telefon', null, array('maxlength' => 20))
              ->setRequired('Je nutne vyplnit telefon')
              ->addRule(Form::MAX_LENGTH, 'maximální délka přijmení je %s', 20);
        }

        $f->addSubmit('registrace_tlacitko', null, 'Registrovat se');

      $res_out = array();
      if ($f->isSubmitted()) {
        if ($f->isValid()) {
          $val = $f->getValues();

          $block_login = array('geniv', 'fugess', 'rami', 'admin', 'logout', 'kokot', 'pica');
          if (!in_array($val['registrace_login'], $block_login)) {

//FIXME dopsat overovani pomoci emailu, posle se mail na overeni a az se potvrzi tak uzivatel zacne fungovat, bude se vyplnovat a rozlisovat podle sloupce potvrzeno
//po registraci s potvrzenim prejit na stranku o informaci o tom ze ma dojit email s potvrzenim

            $c = new ContentValues;
            $c->put('login', $val['registrace_login'])
              ->put('hash', $data['user']::getCleverHash($val['registrace_login'], $val['registrace_heslo']))
              ->put('idrole', 1)  //role defaultne 1, role se bude menit adminem nebo na zaklade dokoncene objednavky
              ->put('idzeme', $val['registrace_zeme'])
              ->put('email', $val['registrace_email'])
              ->putDate('pridano');

            if ($typ) {
              $c->put('jmeno', $val['registrace_jmeno'])
                ->put('prijmeni', $val['registrace_prijmeni'])
                ->put('telefon', $val['registrace_telefon']);
            }

            $res = $db->insert('uzivatele', $c);
            if ($res > 0) {
              $res_out[] = '<h2>Uživatel <em>'.$val['registrace_login'].'</em> byl úspěšně zaregistrován. Budete automaticky přesměrováni.</h2>';
              Core::setRefresh(3, $data['weburl'].'prihlasit-se');
            } else {
              $err = $db->getError();
              if ($err) {
                $p1 = explode('\'',$err);
                $p2 = explode('_', $p1[3]);
                //~ var_dump($p2[0]);
                if ($p2[0] == 'email') {
                  $res_out[] = 'zadali jste duplikatni email';
                } else
                if ($p2[0] == 'login') {
                  $res_out[] = 'zadali jste duplikatni login';
                } else {
                  $res_out[] = 'vyskytla se jina chyba...';
                }
              }
            }

          } else { // konec login bloku
            $res_out[] = 'vyberte si jine jmeno, tento login spada do zakazanych loginu';
          }

        } else {
          $f->setReturnValues($_POST, array('registrace_heslo', 'registrace_heslo2'));
          $res_out = array_merge($res_out, $f->getErrors());
        }
      }

      $assign = array(
                      'registracni_formular' => $f->render(1),
                      'registracni_formular_out' => $res_out,
                      );
      $tpl->assign($assign);

      return $tpl->template('page_registrace')->render();
    }
  }
