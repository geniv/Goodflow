<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues;

  abstract class Users implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Uživatelé',
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
      $form = $data['form'];
      $url = $data['weburl'];
      $uri = $data['staticweb_uri'];
      $db = $data['db'];

      $blok = (isset($uri['blok']) ? $uri['blok'] : '');
      $id = (isset($uri['id']) ? $uri['id'] : '');

      $result = null;
      $dbVypis = null;
      $frm_out = null;

      $p = array(
                $form::CALLBACK_LABEL => function($r) {
                  return $r['html']::label()->add($r['label'] ? $r['html']::span()->setText($r['label']) : null)->add($r['element']); }
                );

      $frm = new $form($p);

      switch ($blok) {
        default:
          $result = 'tady je pridavny text u vypis z databaze...';

          //~ $dbVypis = $db->query('users', array('iduser', 'login', 'pridano', 'upraveno'), 'smazano is null');
          $dbVypis = $db->rawQuery('SELECT iduser, login, pridano, upraveno, roles.nazev role
                                    FROM users
                                    JOIN roles
                                    USING (idrole)
                                    WHERE smazano IS NULL;');
        break;

        case 'add': // pridani uzivatele
          $backUrl = Core::getRequestUrl(null, -1);

          $roles = $data->getUserRoles();

          $frm->addText('login', 'Jméno uživatel')
                ->addPassword('hash', 'Heslo uživatel')
                ->addSelect('role')
                  ->setItems($roles)
                ->addSubmit('add_user', null, 'Přidat človíčka');
//TODO doplnit pravidla
          $result = $frm->render();

          if ($frm->isSubmitted()) {

            if ($frm->isValid()) {
              $val = $frm->getValues();

              $cont = new ContentValues;
              $cont->put('login', $val['login'])
                  ->put('hash', $user::getCleverHash($val['login'], $val['hash']))
                  ->put('idrole', $val['role'])
                  ->put('pridano', date('Y-m-d H:i:s'));

              $res = $db->insert('users', $cont);
              if ($res > 0) {
                $result = 'přidán uživatel: '.$val['login'];
                //~ Core::setLocation($backUrl);
                Core::setRefresh(1, $backUrl);
              } else {
                $result = 'uživatel: '.$val['login'].' již existuje!';
              }

            } else {
              $frm_out = $frm->getErrors();
            }
          }
        break;

        case 'edit':  // editace uzivatele
          $backUrl = Core::getRequestUrl(null, -2);

          if (is_numeric($id)) {

            $edit = $db->query('users', array('login', 'hash', 'idrole'), 'iduser=?', array($id));  //vyber radku z db
            if ($edit->hasNext()) { //nacteni zaznamu
              $d = $edit->nextRow();

              $login = $d->getString('login');
              $idrole = $d->getInt('idrole');

              $roles = $data->getUserRoles();

              $frm->addText('login', 'Jméno uživatel', $login)
                    ->addPassword('hash', 'Heslo uživatel pro ověření')
                    ->addSelect('role')
                      ->setItems($roles)
                    ->addSubmit('edit_user', null, 'Upravit človíčka');

              $frm->setDefaults(array('role' => $idrole));

              $result = $frm->render();

              if ($frm->isSubmitted()) {

                if ($frm->isValid()) {
                  $val = $frm->getValues();

                  $cont = new ContentValues;
                  $cont
                      ->put('login', $val['login'])
                      //~ ->put('hash', $user::getCleverHash($val['login'], $val['hash']))
                      ->put('idrole', $val['role'])
                      ->put('upraveno', date('Y-m-d H:i:s'));

                  //~ $oldHash = $d->getString('hash');
                  //~ $newHash = $user::getCleverHash($login, $oldHash);
                  //~ var_dump($oldHash, $newHash);

                  $res = $db->update('users', $cont, 'iduser=?', array($id));
                  if ($res > 0) {
                    $result = 'uživatel: '.$login.' upraven';
                    Core::setRefresh(1, $backUrl);
                  }

                } else {
                  $frm_out = $frm->getErrors();
                }
              }

            } else {
              $result = 'neexistuje v databazi!';
            }
          } else {
            $result = 'neni vybrane ID!';
          }
        break;

        case 'del': // smazani uzivatele
          $backUrl = Core::getRequestUrl(null, -2);

          if (is_numeric($id)) {

            $q = $db->query('users', array('login'), 'iduser=?', array($id));
            if ($q->hasNext()) {  //vyber radku z db
              $login = $q->nextRow()->getString('login');

              $curlogin = $user->getIdentity()->getData('login');

              if ($login != $curlogin) {  // ochrana proti podmazani pristupu

                //~ $res = $db->delete('users', 'iduser=?', array($id));
                //~ if ($res > 0) {
                  //~ $result = 'uživatel: '.$login.' smazan';
                  //~ Core::setRefresh(1, $backUrl);
                //~ }
//TODO pro CRON vystup hodnot ktere podlehaji zkaze, expirace uzivatelu respektive smazanych udaju!
                $cont = new ContentValues;
                $cont->put('smazano', date('Y-m-d H:i:s'));

                $res = $db->update('users', $cont, 'iduser=?', array($id));
                if ($res > 0) {
                  $result = 'uživatel: '.$login.' "smazan"';
                  Core::setRefresh(1, $backUrl);
                }

              } else {
                $result = 'nelze smazat sama sebe!!';
              }
            } else {
              $result = 'uživatel s id: '.$id.' neexistuje';
            }

          } else {
            $result = 'neni vybrane ID!';
          }
        break;
      }

      $assign = array(
                      'addLink' => Core::getRequestUrl('add'),
                      'editLink' => Core::getRequestUrl('edit'),
                      'delLink' => Core::getRequestUrl('del'),
                      'url_blok' => $blok,
                      'url_id' => $id,
                      'output' => $result,
                      'dbVypis' => $dbVypis,
                      'formOut' => $frm_out,
                      //~ 'page_admin_form' => $form->render(7),
                      //~ 'page_admin_form_out' => $res_out,
                      );
      $tpl->assign($assign);

      return $tpl->template('page_users')->render();
    }
  }
