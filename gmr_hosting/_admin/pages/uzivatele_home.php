<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues,
      classes\User,
      classes\Form;

  class Uzivatele_Home implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Výpis uživatelů',
                  'name_blok' => 'Uživatelé',
                  );
    }

    //extra JS pro danou stranku
    //~ public static function getJS() {}

    //extra CSS pro danou stranku
    //~ public static function getCSS() {}

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      $spravce = $data['spravce'];
      //~ $html = $data['html'];
      $f = $data['form_global'];
      $uri = $data['web_uri'];
      $db = $data['db'];

      $blok = (isset($uri['blok']) ? $uri['blok'] : '');
      $id = (isset($uri['id']) ? $uri['id'] : '');

      $result = null;
      $dbVypis = null;
      $frm_out = null;
      
      $f->addText('uzivatele_login', 'Login', null, array('maxlength' => 30))
        ->setRequired('Je nutne vyplnit login')
          ->addRule(Form::MAX_LENGTH, 'maximální délka je %s', 30)
        //~ ->addPassword('uzivatele_hash', 'Heslo')
        ->addSelect('uzivatele_idrole', 'Role')
          ->setItems($data->getUzivateleRole())
        ->addSelect('uzivatele_idzeme', 'Země')
          ->setItems($data->getZeme())
        ->addText('uzivatele_email', 'Email', null, array('maxlength' => 100))
          ->setRequired('Je nutne vyplnit email')
          ->addRule(Form::MAX_LENGTH, 'maximální délka je %s', 100)
        ->addText('uzivatele_jmeno', 'Jméno', null, array('maxlength' => 100))
          ->addRule(Form::MAX_LENGTH, 'maximální délka je %s', 100)
        ->addText('uzivatele_prijmeni', 'Příjmení', null, array('maxlength' => 100))
          ->addRule(Form::MAX_LENGTH, 'maximální délka je %s', 100)
        ->addText('uzivatele_telefon', 'Telefon', null, array('maxlength' => 20))
          ->addRule(Form::MAX_LENGTH, 'maximální délka je %s', 20)
        //~ ->addText('uzivatele_avatar', 'Avatar', $d->avatar)
        ->addCheckbox('uzivatele_potvrzeno', 'Potvrzeno');
//TODO pridat dalsi polozky z firemnich veci!

      switch ($blok) {
        default:
          $result = 'tady je pridavny text u vypis z databaze...';
//~ jmeno, prijmeni, email, telefon, avatar,
//~ firma, dic, ico, ulicecp, mesto, psc,
//~ potvrzeno, pridano, upraveno
          $dbVypis = $db->rawQuery('SELECT iduzivatel, login, uzivatele_role.nazev as role, zeme.nazev as zeme,
                                            login, email, potvrzeno, pridano, upraveno
                                      FROM uzivatele
                                      JOIN uzivatele_role USING(idrole)
                                      JOIN zeme USING(idzeme)
                                      WHERE smazano IS NULL');
        break;

        case 'edit':  // editace uzivatele
          $backUrl = Core::getRequestUrl(null, -2);

          if (is_numeric($id)) {
            $edit = $db->query('uzivatele', array('login', 'idrole', 'idzeme', 'email', 'jmeno', 'prijmeni', 'telefon', 'avatar', 'potvrzeno'), 'iduzivatel=?', array($id));  //vyber radku z db
            if ($edit->hasNext()) { //nacteni zaznamu
              $d = $edit->nextRow();

              $f->addBackLink('zpět', $backUrl)
                ->addSubmit('edit_uzivatele', null, 'Upravit uživatele');

              $f->setDefaults(array(
                                    'uzivatele_login' => $d->login,
                                    'uzivatele_email' => $d->email,
                                    'uzivatele_jmeno' => $d->jmeno,
                                    'uzivatele_prijmeni' => $d->prijmeni,
                                    'uzivatele_telefon' => $d->telefon,
                                    'uzivatele_potvrzeno' => $d->pozvrzeno,
                                    'uzivatele_idrole' => $d->idrole,
                                    'uzivatele_idzeme' => $d->idzeme,
                                    )
                              );

              $result = $f->render();

              if ($f->isSubmitted()) {
                if ($f->isValid()) {
                  $val = $f->getValues();

                  $c = new ContentValues;
                  $c//->put('idspravce', $spravce->getIdentity()->getId())
                    //~ ->put('idjazyka',)
                    //~ ->put('nadpis', $val['novinky_nadpis'])
                    //~ ->put('zprava', $val['novinky_zprava'])
                    ->put('login', $val['uzivatele_login'])
                    //~ ->put('hash', $val['uzivatele_hash'])
                    ->put('idrole', $val['uzivatele_idrole'])
                    ->put('idzeme', $val['uzivatele_idzeme'])
                    ->put('email', $val['uzivatele_email'])
                    ->put('jmeno', $val['uzivatele_jmeno'])
                    ->put('prijmeni', $val['uzivatele_prijmeni'])
                    ->put('telefon', $val['uzivatele_telefon'])
                    //~ ->put('avatar')
//TODO dalsi polozky firmy
                    //~ ->putDate('potvrzeno')
                    //~ ->putDate('upraveno')
                    ;

                  $res = $db->update('uzivatele', $c, 'iduzivatel=?', array($id));
                  if ($res > 0) {
                    $result = 'upraveno: '.$val['uzivatele_login'];
                    Core::setRefresh(1, $backUrl);
                  } else {
                    $result = 'nepodařilo se upravit';
                  }
                } else {
                  $frm_out = $f->getErrors();
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
            $c = new ContentValues;
            $c->putDate('smazano');

            $res = $db->update('uzivatele', $c, 'iduzivatel=?', array($id));
            if ($res > 0) {
              $result = 'smazano';
              Core::setRefresh(1, $backUrl);
            }
//TODO pro CRONa vystup hodnot ktere podlehaji zkaze, expirace uzivatelu respektive smazanych udaju!
          } else {
            $result = 'neni vybrane ID!';
          }
        break;
      }

      $assign = array(
                      //~ 'addLink' => Core::getRequestUrl('add'),
                      'editLink' => Core::getRequestUrl('edit'),
                      'delLink' => Core::getRequestUrl('del'),

                      'url_blok' => $blok,
                      //~ 'url_id' => $id,

                      'dbVypis' => $dbVypis,

                      'formular' => $result,
                      'formular_out' => $frm_out,
                      );
      $tpl->assign($assign);

      return $tpl->template('webadmin/uzivatele_home')->render();
    }
  }
