<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues;

  class Jednotky implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Jednotky',
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

      $f->addText('nazev', 'nazev jednoty', null, array('maxlength' => 100,))
          ->setRequired('je nutne vypnit nazev')
        ->addTextArea('popis', 'popis jednotky', null, array('maxlength' => 200,));

      switch ($blok) {
        default:
          $dbResult = $db->query('jednotky', array('idjednotky', 'nazev', 'popis'), null, null, null, null, 'nazev ASC');
        break;

        case 'add':
          $backUrl = Core::getRequestUrl(null, -1);

          $f->addBackLink('zpět', $backUrl)
            ->addSubmit('add_jednotky', null, 'Přidat jednotku')
            ->setReturnValues($_POST);

          $result = $f->render();

          if ($f->isSubmitted()) {
            if ($f->isValid()) {
              $val = $f->getValues();

              //TODO kontrolovat duplikatni nazev

              $c = new ContentValues($val);
              $c->remove('add_jednotky');

              $res = $db->insertOrThrow('jednotky', $c);

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
            $edit = $db->query('jednotky', array('nazev', 'popis'), 'idjednotky=?', array($id));  //vyber radku z db
            if ($edit->hasNext()) { //nacteni zaznamu
              $d = $edit->nextRow();

              $f->addBackLink('zpět', $backUrl)
                ->addSubmit('edit_jednotky', null, 'Upravit jednotku')
                ->setDefaults($d) //vraceni nastavenych dat
                ->setReturnValues($_POST);

              $result = $f->render();

              if ($f->isSubmitted()) {
                if ($f->isValid()) {
                  $val = $f->getValues();

                  $c = new ContentValues($val);
                  $c->remove('edit_jednotky');

                  $res = $db->update('jednotky', $c, 'idjednotky=?', array($id));
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
            $res = $db->delete('jednotky', 'idjednotky=?', array($id));
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

      return $tpl->template('page_jednotky')->render();
    }
  }