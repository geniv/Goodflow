<?php

  namespace pages;

  use classes\IPage,
      classes\Core;

  class Home implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Home',
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

      $f->addSearch('nazev', 'nazev receptu')
        ->addGroup('nadobí')
        ->addCheckList('nadobi_na_recepty', array($f::CALLBACK_ELEMENT => $data->getCallbackFormCheckList()))
          ->setItems($data->getNadobi())
        ->addGroup('suroviny')
        ->addCheckList('suroviny_na_recepty', array($f::CALLBACK_ELEMENT => $data->getCallbackFormCheckList()))
          ->setItems($data->getSuroviny())
        ->addGroup()
        ->addSubmit('search_recepty', null, 'Vyhledat recept')
        ->setReturnValues($_POST);

      $result = $f->render();

      if ($f->isSubmitted()) {
        $val = $f->getValues();
        if ($f->isValid()) {

          $nazev = null;
          $sql = array('');
          // hledani podle nazvu
          if (!empty($val['nazev'])) {
            $sql[] = 'nazev LIKE ?';
            $nazev = '%'.$val['nazev'].'%';
          }
//TODO vyhledavat i v popisech??
          // hledani podle nadobi
          if (!empty($val['nadobi_na_recepty'])) {
            $sql[] = 'idnadobi IN ('.implode(', ', $val['nadobi_na_recepty']).')';
          }

          // hledani podle surovin
          if (!empty($val['suroviny_na_recepty'])) {
            $sql[] = 'idsuroviny IN ('.implode(', ', $val['suroviny_na_recepty']).')';
          }

          //~ var_dump($sql);
          //TODO vyhladavani v mysql databazi!!!!!!

        } else {
          $form_out = $f->getErrors();
        }
      }

      $assign = array(
                      'url_blok' => $blok,

                      'receptyLink' => Core::getRequestUrl('?recepty'),

                      'formular' => $result,
                      'formular_out' => $form_out,
                      'dbResult' => $dbResult,
                      );
      $tpl->assign($assign);

      return $tpl->template('page_home')->render();
    }
  }