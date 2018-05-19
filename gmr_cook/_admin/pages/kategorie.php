<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues;

  class Kategorie implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Kategorie',
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

      $f->addText('nazev', 'nazev kategorie', null, array('maxlength' => 100,))
          ->setRequired('je nutne vypnit nazev')
        ->addTextArea('popis', 'popis kategorie', null, array('maxlength' => 200,));

      switch ($blok) {
        default:
          //~ $dbResult = $db->query('kategorie', array('idkategorie', 'nazev', 'popis'), null, null, null, null, 'nazev ASC');

          $dbResult = $db->rawQuery('SELECT idkategorie, nazev, popis,
                                        (SELECT COUNT(idkategorie) FROM kategorie
                                          JOIN (SELECT idrecepty, idkategorie FROM (SELECT idrecepty, idkategorie FROM recepty WHERE smazano IS NULL) AS nn_recepty) AS nr USING(idkategorie)
                                    WHERE nr.idkategorie=n.idkategorie)
                                    pocet FROM kategorie AS n
                                    ORDER BY nazev ASC');
        break;

        case 'add':
          $backUrl = Core::getRequestUrl(null, -1);

          $f->addBackLink('zpět', $backUrl)
            ->addSubmit('add_kategorie', null, 'Přidat kategorie')
            ->setReturnValues($_POST);

          $result = $f->render();

          if ($f->isSubmitted()) {
            if ($f->isValid()) {
              $val = $f->getValues();

              //TODO kontrolovat duplikatni nazev

              $c = new ContentValues($val);
              $c->remove('add_kategorie');

              $res = $db->insertOrThrow('kategorie', $c);

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
            $edit = $db->query('kategorie', array('nazev', 'popis'), 'idkategorie=?', array($id));  //vyber radku z db
            if ($edit->hasNext()) { //nacteni zaznamu
              $d = $edit->nextRow();

              $f->addBackLink('zpět', $backUrl)
                ->addSubmit('edit_kategorie', null, 'Upravit kategorie')
                ->setDefaults($d) //vraceni nastavenych dat
                ->setReturnValues($_POST);

              $result = $f->render();

              if ($f->isSubmitted()) {
                if ($f->isValid()) {
                  $val = $f->getValues();

                  $c = new ContentValues($val);
                  $c->remove('edit_kategorie');

                  $res = $db->update('kategorie', $c, 'idkategorie=?', array($id));
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
            $res = $db->delete('kategorie', 'idkategorie=?', array($id));
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

      return $tpl->template('page_kategorie')->render();
    }
  }