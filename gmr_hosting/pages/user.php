<?php

  namespace pages;

  use classes\IPage,
      classes\Core,
      classes\Form,
      classes\ContentValues;

  class User implements IPage {
    const VISIBLE = false;
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Uživatel',
                  //'addition' => 'co děláme',
                  //'idsekce' => 'hlavni'
                  );
    }

    //extra JS pro danou stranku
    public static function getJS() {}

    //extra CSS pro danou stranku
    public static function getCSS() {}

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      $user = $data['user'];
      //~ $html = $data['html'];
      $f = $data['form_global'];
      $uri = $data['web_uri'];
      $db = $data['db'];

      $identity = $user->getIdentity();
      $form_send = false;
      $logout_send = false;
      $user_data = null;

      $akce = (isset($uri['akce']) ? $uri['akce'] : null);

//~ var_dump($uri);
//TODO akresa musi byt prave vyplnena cela kvuli fakturacnim udajum!!
      $res_out = array();
      if ($identity) {  //pokud je identita definovana
        $login = $identity->getData('login');
        if ($uri['login'] == $login) {

          $id = $identity->getId();

          switch ($akce) {
            default:  // hlavni stranka profilu
              $res = $db->rawQuery('SELECT login, uzivatele_role.nazev as role, zeme.nazev as zeme,
                                          jmeno, prijmeni, email, telefon, avatar,
                                          firma, dic, ico, ulicecp, mesto, psc,
                                          potvrzeno, pridano, upraveno
                                    FROM uzivatele
                                    JOIN uzivatele_role USING(idrole)
                                    JOIN zeme USING(idzeme)
                                    WHERE iduzivatel=? AND smazano IS NULL', array($id));
              $res->hasNext();
              $user_data = $res->nextRow();

              //~ $resources = $data::getConstResource();
              //~ var_dump($resources);

              //~ if ($user->isAllowed($resources['moderate_web'])) {
                //~ var_dump('tady jsou prava pro moderovani webu');
              //~ }

              //~ if ($user->isAllowed($resources['manage_game'])) {
                //~ var_dump('tady jsou prava pro spravce her');
              //~ }

              //~ if ($user->isAllowed($resources['moderate_manage'])) {
                //~ var_dump('tady jsou prava pro moderovani webu a spravu her');
              //~ }

              //...
            break;
//TODO dodelat!! uživatelský panel...
            case 'edit':  // editace uzivatele
              $res = $data->getUzivatelData($id); // nacteni kurzoru
              if ($res->hasNext()) {
                $d = $res->nextRow();

                $f->addSelect('user_idzeme', 'Země')
                    ->setItems($data->getZeme())
                  ->addText('user_jmeno', 'Jméno', $d->jmeno, array('maxlength' => 100))
                    ->addRule(Form::MAX_LENGTH, 'maximální délka je %s', 100)
                  ->addText('user_prijmeni', 'Příjmení', $d->prijmeni, array('maxlength' => 100))
                    ->addRule(Form::MAX_LENGTH, 'maximální délka je %s', 100)
                  ->addText('user_telefon', 'Telefon', $d->telefon, array('maxlength' => 20))
                    ->addRule(Form::MAX_LENGTH, 'maximální délka je %s', 20)
                  //~ ->addText('uzivatele_avatar', 'Avatar', $d->avatar)
                  ->addSubmit('edit_usder', null, 'Upravit');
//TODO pridat moznost pridavat si fakturacni udaje (pokud jde o firmu)!!!, zaskrtavaci polozka
                $f->setDefaults(array('user_idzeme' => $d->idzeme));

                $form_send = $f->isSubmitted();

                if ($f->isSubmitted()) {
                  if ($f->isValid()) {
                    $val = $f->getValues();

                    $c = new ContentValues;
                    $c//~ ->put('hash', $val['uzivatele_hash']) //TODO dodelat zmenu hesla!
                      ->put('idzeme', $val['user_idzeme'])
                      //~ ->put('email', $val['uzivatele_email'])
                      ->put('jmeno', $val['user_jmeno'])
                      ->put('prijmeni', $val['user_prijmeni'])
                      ->put('telefon', $val['user_telefon'])
                      ->putDate('upraveno');

                    $res = $db->update('uzivatele', $c, 'iduzivatel=?', array($id));
                    if ($res > 0) {
                      $res_out[] = 'upraveno';
                      Core::setRefresh(1, $data['weburl'].'user/'.$login);
                    } else {
                      $res_out[] = 'nepodařilo se upravit';
                    }
                  } else {
                    $res_out = $f->getErrors();
                  }
                }
              } else {
                $res_out[] = 'neexistuje v databazi!';
              }
            break;

            case 'logout':  // obsluha logout-u
              $user->logout(true);
              $res_out[] = '<h2 class="loginfo_user">Byl jste odhlášen.</h2><p class="loginfo_tl"><a href="'.$data['weburl'].'" title="Pokračovat" class="generic_button w_arrow green"><span><span>Pokračovat</span></span></a></p>';
              $logout_send = true;
              Core::setRefresh(3, $data['weburl']);
            break;
          }

        }
      } else {
        Core::setLocation($data['weburl']);
      }

      $assign = array(
                  'user_edit_link' => 'user/'.$login.'/edit',
                  'user_edit_form' => $f->render(1),
                  'user_edit_form_send' => $form_send,
                  'user_logout_send' => $logout_send,
                  'user_data' => $user_data,
                  'user_sekce' => $akce,
                  'user_out' => $res_out,
                );
      $tpl->assign($assign);

      return $tpl->template('page_user')->render();
    }
  }