<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues;

  class Suroviny implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Suroviny',
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

      $f->addText('nazev', 'nazev sroviny', null, array('maxlength' => 100,))
          ->setRequired('je nutne vypnit nazev')
        ->addTextArea('popis', 'popis suroviny', null, array('maxlength' => 200,));

      switch ($blok) {
        default:
          //~ $dbResult = $db->query('suroviny', array('idsuroviny', 'nazev', 'popis'), null, null, null, null, 'nazev ASC');

          $dbResult = $db->rawQuery('SELECT idsuroviny, nazev, popis,
                                        (SELECT COUNT(idsuroviny) FROM
                                            (SELECT idrecepty, idsuroviny FROM suroviny_na_recepty
                                                JOIN (SELECT idrecepty FROM recepty WHERE smazano IS NULL) AS nn_recepty USING(idrecepty)
                                            ) AS nr
                                            WHERE nr.idsuroviny=n.idsuroviny
                                        )
                                    pocet FROM suroviny AS n
                                    ORDER BY nazev ASC;');
        break;

        case 'add':
          $backUrl = Core::getRequestUrl(null, -1);

          $f->addBackLink('zpět', $backUrl)
            ->addSubmit('add_suroviny', null, 'Přidat suroviny')
            ->setReturnValues($_POST);

          $result = $f->render();

          if ($f->isSubmitted()) {
            if ($f->isValid()) {
              $val = $f->getValues();

              //TODO kontrolovat duplikatni nazev

              $c = new ContentValues($val);
              $c->remove('add_suroviny');

              $res = $db->insertOrThrow('suroviny', $c);

              if ($res > 0) {
                $result = 'přidáno: '.$val['nazev'];
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
            $edit = $db->query('suroviny', array('nazev', 'popis'), 'idsuroviny=?', array($id));  //vyber radku z db
            if ($edit->hasNext()) { //nacteni zaznamu
              $d = $edit->nextRow();

              $f->addBackLink('zpět', $backUrl)
                ->addSubmit('edit_suroviny', null, 'Upravit suroviny')
                ->setDefaults($d) //vraceni nastavenych dat
                ->setReturnValues($_POST);

              $result = $f->render();

              if ($f->isSubmitted()) {
                if ($f->isValid()) {
                  $val = $f->getValues();

                  $c = new ContentValues($val);
                  $c->remove('edit_suroviny');

                  $res = $db->update('suroviny', $c, 'idsuroviny=?', array($id));
                  if ($res > 0) {
                    $result = 'upraveno: '.$val['nazev'];
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
            $res = $db->delete('suroviny', 'idsuroviny=?', array($id));
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

      return $tpl->template('page_suroviny')->render();
    }
  }