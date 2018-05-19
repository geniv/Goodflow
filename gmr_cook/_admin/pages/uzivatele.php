<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues;

  class Uzivatele implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Uzivatele',
                  );
    }

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      $user = $data['user'];
      //~ $html = $data['html'];
      $f = $data['form_global'];
      $uri = $data['web_uri'];
      $db = $data['db'];

      $blok = (isset($uri['blok']) ? $uri['blok'] : '');
      $id = (isset($uri['id']) ? $uri['id'] : '');

      $result = null;
      $dbResult = null;
      $form_out = null;

      $f->addSelect('idrole', 'role')
          ->setItems($data->getUzivateleRole())
          ->setPrompt('vyber roli!')
          ->setRequired('je nutne vypnit roli')
        ->addText('jmeno', 'jmeno uzivatele', null, array('maxlength' => 300,))
          ->setRequired('je nutne vypnit jmeno')
        ->addText('login', 'login uzivatele', null, array('maxlength' => 30,))
          ->setRequired('je nutne vypnit login')
        ->addPassword('hash', 'heslo uzivatele', null, array('maxlength' => 100,))
          //~ ->setRequired('je nutne vypnit heslo')
        ->addEmail('email', 'email uzivatele', null, array('maxlength' => 100,))
          ->setRequired('je nutne vypnit email')
          ->addRule($f::EMAIL, 'je nutner vypnit korektni email');

      switch ($blok) {
        default:
          //~ $dbResult = $db->rawQuery('SELECT iduzivatel, role.nazev nazev_role, jmeno, login, email, pridano, upraveno FROM uzivatele
                                    //~ JOIN role USING(idrole)
                                    //~ WHERE smazano is null
                                    //~ ORDER BY pridano DESC;');

          $dbResult = $db->rawQuery('SELECT
                                      iduzivatel,
                                      role.nazev nazev_role,
                                      jmeno,
                                      login,
                                      email,
                                      pridano,
                                      upraveno,
                                      (SELECT count(idrecepty) FROM recepty r WHERE smazano IS NULL AND r.iduzivatel=u.iduzivatel) pocet
                                    FROM uzivatele u
                                    JOIN role USING(idrole)
                                    WHERE smazano is null
                                    ORDER BY pridano DESC;');
        break;

        case 'add':
          $backUrl = Core::getRequestUrl(null, -1);

          $f->addBackLink('zpět', $backUrl)
            ->addSubmit('add_uzivatele', null, 'Přidat uživatele')
            ->setReturnValues($_POST);

          $result = $f->render();

          if ($f->isSubmitted()) {
            if ($f->isValid()) {
              $val = $f->getValues();

              //TODO overeni jestli uzivatel uz existuje?!

              $c = new ContentValues($val);
              $c->put('hash', $user::getCleverHash($val['login'], $val['hash']))
                ->putDate('pridano')
                ->remove('add_uzivatele');

              $res = $db->insertOrThrow('uzivatele', $c);

              if ($res > 0) {
                $result = 'přidáno: '.$val['login'];
                Core::setRefresh(1, $backUrl);
              } else {
                $result = 'nepodařilo se přidat';
              }

            } else {
              $form_out = $f->getErrors();
            }
          }
        break;

        case 'edit':
          $backUrl = Core::getRequestUrl(null, -2);

          if (is_numeric($id)) {
            $edit = $db->query('uzivatele', array('idrole', 'jmeno', 'login', 'hash', 'email'), 'iduzivatel=?', array($id));  //vyber radku z db
            if ($edit->hasNext()) { //nacteni zaznamu
              $d = $edit->nextRow();

              $f->addBackLink('zpět', $backUrl)
                ->addSubmit('edit_uzivatele', null, 'Upravit uživatele')
                ->setDefaults($d, array('hash'))
                ->setReturnValues($_POST);

              $result = $f->render();

              if ($f->isSubmitted()) {
                if ($f->isValid()) {
                  $val = $f->getValues();

                  $c = new ContentValues($val);
                  $c->putDate('upraveno')
                    ->remove('hash')
                    ->remove('edit_uzivatele');

                  if (!empty($val['hash'])) {
                    $hash = $user::getCleverHash($val['login'], $val['hash']);
                    if ($hash != $d->hash) {
                      $c->put('hash', $hash);
                    }
                  }

                  $res = $db->update('uzivatele', $c, 'iduzivatel=?', array($id));
                  if ($res > 0) {
                    $result = 'upraveno: '.$val['login'];
                    Core::setRefresh(1, $backUrl);
                  } else {
                    $result = 'nepodařilo se upravit';
                  }
                } else {
                  $form_out = $f->getErrors();
                }
              }
            } else {
              $result = 'neni v DB';
            }
          } else {
            $result = 'neplatne ID';
          }
        break;

        case 'del':
          $backUrl = Core::getRequestUrl(null, -2);
          if (is_numeric($id)) {
            $c = new ContentValues;
            $c->putDate('smazano');
//TODO cronem cistit DB smazanach uzivatelu
            $res = $db->update('uzivatele', $c, 'iduzivatel=?', array($id));
            if ($res > 0) {
              $result = 'smazano';
              Core::setRefresh(1, $backUrl);
            }
          } else {
            $result = 'neplatne ID';
          }
        break;
      }

      $assign = array(
                      'url_blok' => $blok,

                      'addLink' => Core::getRequestUrl('add'),
                      'editLink' => Core::getRequestUrl('edit'),
                      'delLink' => Core::getRequestUrl('del'),

                      'formular' => $result,
                      'formular_out' => $form_out,
                      'dbResult' => $dbResult,
                      );
      $tpl->assign($assign);

      return $tpl->template('page_uzivatele')->render();
    }
  }