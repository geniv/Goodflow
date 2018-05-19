<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues;

  class Nadobi implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Nadobi',
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

      $f->addText('nazev', 'nazev nadobi', null, array('maxlength' => 100,))
          ->setRequired('je nutne vypnit nazev')
        ->addTextArea('popis', 'popis nadobi', null, array('maxlength' => 200,));

      switch ($blok) {
        default:
          //~ $dbResult = $db->query('nadobi', array('idnadobi', 'nazev', 'popis'), null, null, null, null, 'nazev ASC');

          $dbResult = $db->rawQuery('SELECT idnadobi, nazev, popis,
                                        (SELECT COUNT(idnadobi) FROM
                                            (SELECT idrecepty, idnadobi FROM nadobi_na_recepty
                                                JOIN (SELECT idrecepty FROM recepty WHERE smazano IS NULL) AS nn_recepty USING(idrecepty)
                                            ) AS nr
                                            WHERE nr.idnadobi=n.idnadobi
                                        )
                                    pocet FROM nadobi AS n
                                    ORDER BY nazev ASC;');
        break;

        case 'add':
          $backUrl = Core::getRequestUrl(null, -1);

          $f->addBackLink('zpět', $backUrl)
            ->addSubmit('add_nadobi', null, 'Přidat nadobi')
            ->setReturnValues($_POST);

          $result = $f->render();

          if ($f->isSubmitted()) {
            if ($f->isValid()) {
              $val = $f->getValues();

              //TODO kontrolovat duplikatni nazev

              $c = new ContentValues($val);
              $c->remove('add_nadobi');

              $res = $db->insertOrThrow('nadobi', $c);

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
            $edit = $db->query('nadobi', array('nazev', 'popis'), 'idnadobi=?', array($id));  //vyber radku z db
            if ($edit->hasNext()) { //nacteni zaznamu
              $d = $edit->nextRow();

              $f->addBackLink('zpět', $backUrl)
                ->addSubmit('edit_nadobi', null, 'Upravit nadobi')
                ->setDefaults($d) //vraceni nastavenych dat
                ->setReturnValues($_POST);

              $result = $f->render();

              if ($f->isSubmitted()) {
                if ($f->isValid()) {
                  $val = $f->getValues();

                  $c = new ContentValues($val);
                  $c->remove('edit_nadobi');

                  $res = $db->update('nadobi', $c, 'idnadobi=?', array($id));
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
            $res = $db->delete('nadobi', 'idnadobi=?', array($id));
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

      return $tpl->template('page_nadobi')->render();
    }
  }