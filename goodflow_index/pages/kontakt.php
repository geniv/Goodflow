<?php
/*
 *      kontakt.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace pages;

  use \Config,
      classes\Core,
      classes\Html,
      classes\Form,
      classes\Email,
      classes\JsonStorage,
      classes\Configurator,
      classes\Imagic,
      classes\Captcha;

  class Kontakt extends Configurator implements Page {
    const URL = 'kontakt';

    public static function getName() {
      return _('Kontakt');
    }

    public static function getUserVariable() {
      return array('addition' => 'kontaktujte nás',
                  'idsekce' => 'kontakt');
    }

    public static function getLoadModules() {
      return array('' => array('script' => array('$(document).ready(function() {
        Cufon.replace(\'#obsah_kontakt #nazev_sekce h2, #obsah_kontakt h3, #obsah_kontakt h4, #obsah_kontakt h5\', { fontFamily: \'mwp\', hover: true });
      });')));
    }

    public static function getSubMenu() {
      return array();
    }

/*
    const ZAKAZNIK = 'objednavka-servisu-u-zakaznika';
    const SVOZ = 'objednat-svoz-zarizeni-zdarma';
*/

    public static function getContent() {
/*
      $menu = Html::setArray(JsonStorage::getData('json/objednat_odkazy.json'));

      $data = JsonStorage::getData('json/centralni_informace.json');
      $email_info = Core::getSafeEmail($data['info']);
      $email_servis = Core::getSafeEmail($data['servis']);
*/

      $form = new Form;
      //$value_predmet = array('Vyberte možnost', self::ZAKAZNIK => 'Objednávka servisu u zákazníka', self::SVOZ => 'Objednat svoz zařízení ZDARMA');
      $value_predmet = array();

      Core::initSession();
      $cap = new Captcha(array('type' => Captcha::TYPE_PLUSMINUS, 'min' => 0, 'max' => 9));
      $conf = array('width' => 85,
                    'height' => 39,
                    //'background_color' => '#636363',
                    'background_color' => 'transparent',
                    'font_name' => 'fonty/journal.ttf',  //__DIR__.'/../
                    'font_color' => '#808487',
                    //'font_color' => array('#aaa', '#eee'),
                    //'font_size' => array(20, 40),
                    'font_size' => 26,
                    'font_letterspacing' => 20,
                    'rotation_letter' => array(-30, 30),
                    'font_x' => 18,
                    'font_y' => 25,
                    //'font_wordspacing' => 10,
                    //'type_plus' => '%s + %s',
                    'background_image' => 'obr/podklad_captcha.png',
                    //'background_composite' => Imagic::COMPOSITE_COPYOPACITY,  //COMPOSITE_OVER
                    );
      $cap->setConfigure($conf);

      $form->addText('jmeno', array('self_elem' => Html::span()->class('nazev_obal')->insert(Html::span()->setText('Jméno'))))
             ->addRule(Form::RULE_FILLED, 'Musí být vyplněno jméno !')
           ->addText('email', array('self_elem' => Html::span()->class('nazev_obal')->insert(Html::span()->setText('E-mail'))))
             ->addRule(Form::RULE_FILLED, 'Musí být vyplněn e-mail !')
             ->addRule(Form::RULE_EMAIL, 'Nekorektní formát e-mailu !')
           ->addText('cap', array('label_id' => 'input_captcha', 'self_elem' => array(Html::span()->class('nazev_obal')->insert(Html::span()->setText('Kontrola')), $cap->render(), Html::span()->id('captcha_znak')->setText('=')), 'maxlength' => 2)) //'label' => '=', , 'value' => $cap->getCurrentResult()
             ->addRule(Form::RULE_EQUAL, 'V kontrole jste zadali špatný výsledek !', $cap->getResult())
             ->addRule(Form::RULE_FILLED, 'Musí být vyplněna kontrola !')
           ->addTextArea('zprava', array('cols' => '80', 'rows' => '8', 'self_elem' => Html::span()->class('nazev_obal')->insert(Html::span()->setText('Zpráva'))))
             ->addRule(Form::RULE_FILLED, 'Musí být vyplněna zpráva !')
           ->addSubmit('odeslat', array('label_id' => 'input_submit', 'value' => '&nbsp;'));

//var_dump($cap->getCurrentResult());


      $kontakty = NULL;
      if (!$form->isSendet()) {
        $kontakty = Html::div()->id('kontaktni_info')
                                 ->insert(Html::p()->id('podklad_nadpis')
                                         ->insert(Html::span()->setBBCodeText('Martin Fryšták [i]&amp;[/i] Radek Fryšták'))
                                 )
                                 ->insert(Html::p()->setText('GoodFlow design'))
                                 ->insert(Html::p()->setText('IČ: 76376249'))
                                 ->insert(Html::p()->setText('www.gfdesign.cz'))




        ;
/*
        $kontakty = Html::ul()
                        ->insert(Html::li()
                                ->insert(Html::h5()->setText('Servisní nonstop linka')->class('museo500700'))
                                ->insert(Html::strong()->setText(sprintf('(+420) %s', $data['telefon']))->class('museo500700'))
                        )
                        ->insert(Html::li()
                                ->insert(Html::h5()->setText('Email')->class('museo500700'))
                                ->insert(Html::a()->href($email_info['href'])->title('')->setText($email_info['text'])->class('museo500700'))
                                ->insert(Html::a()->href($email_servis['href'])->title('')->setText($email_servis['text'])->class('museo500700'))
                        )
                        ->insert(Html::li()
                                ->insert(Html::h5()->setText('Skype')->class('museo500700'))
                                ->insert(Html::em()->setText($data['skype'])->class('museo500700'))
                        )
                        ->insert(Html::li()
                                ->insert(Html::h5()->setText('Web')->class('museo500700'))
                                ->insert(Html::a()->hrefpath('')->title(Config::PROJECT_NAME)->setText($data['url'])->class('museo500700'))
                        );
*/
      }

      if ($form->isSubmitted()) {

          $values = $form->getValues();

          $e = new Email;
          $e->from($values['email'])
            //~ ->to('geniv.radek@gmail.com')
            //~ ->to('martin.fugess@gmail.com')
            ->to('kontakt@gfdesign.cz')
            ->subject('Zpráva z gfdesign.cz')
            //->message(Core::getMarkupText(sprintf('\nZpráva ze stránek www.gfdesign.cz\n\nÚdaje o odesílateli:\nIP: %s\nHost: %s\nOperační systém: %s\nProhlížeč: %s\n\nDatum / čas odeslání zprávy: %s\nJméno: %s\nE-mail: %s\nZpráva: %s\n', Email::getIP(), Email::getHost(), Email::getOS(), Email::getBrowser(), Email::getDateTime('d.m.Y / H:i:s'), $values['jmeno'], $values['email'], $values['zprava'])));
            ->message(Core::getMarkupText(sprintf('\nZpráva ze stránek www.gfdesign.cz\n\nÚdaje o odesílateli:\nIP: %s\nHost: %s\nOperační systém: %s\nProhlížeč: %s\n\nDatum / čas odeslání zprávy: %s\nJméno: %s\nE-mail: %s\nZpráva: %s\n', Email::getIP(), Email::getHost(), '---', '---', Email::getDateTime('d.m.Y / H:i:s'), $values['jmeno'], $values['email'], $values['zprava'])));

          if ($e->send()) {
            $form = Html::h5()->id('h5nm')->insert(Html::span()->setText('Formulář byl odeslán, děkujeme za Váš zájem.'));
          } else {
            $form = Html::h4()->insert(Html::span()->setText('Formulář nebyl odeslán !'));
          }

      } else {
        if ($form->isErrors()) {
          $sablona = Html::h5()->insert(Html::span()->setText('{error}'))->setDepth(6);
          $form = Html::h4()->insert(Html::span()->setText('Formulář nebyl odeslán !'))->appendAfter($form->getErrors($sablona));
        }
      }



//centralni_informace



      return Html::div()->id('obsah_%s', self::getUserVar('idsekce'))
      ->insert(Html::div()->id('nazev_sekce')
              ->insert(Html::h2()->setText('Kontakt'))
      )
      ->insert(Html::h3()->setText('Neváhejte nás kontaktovat'))
      ->insertContent($form)
      ->insert($kontakty)

      //->insert(Html::p()->setText('Jsme tým vývojářů, mající za sebou bohaté zkušenosti se zpracováváním a vývojem administračního systému pro user-friendly použití. Můžeme se pochlubit řadou úspěšných referencí, díky kterým se naše zkušenosti obohatily a přinesly celou řadu změn a vylepšení v admin systému. Při naší práci dbáme především na vysokou kvalitu zpracování.'))
      //->insert(Html::p()->setMarkupText('Naše role jsou:\nwebmaster - Martin Fryšták a programátor - Radek Fryšták'))
      //->insert(Html::p()->setText('Dále už za nás mluví naše reference.'))

      //->insert(Html::kua()->setText('proč?')->insert(Html::pica()->setText('hcii')))






      ;






/*

Zprava z gfdesign.cz


<br />
Zpráva ze stránek <a href="@@1@@">www.gfdesign.cz</a>
<br /><br />
Údaje o odesílateli:
<br />
IP: @@2@@
<br />
Host: @@3@@
<br />
Operační systém: @@4@@
<br />
Prohlížeč: @@5@@
<br /><br />
Datum / čas odeslání zprávy: @@6@@
<br />
@@7@@: @@8@@
<br />
@@9@@: @@10@@
<br />
@@11@@: @@12@@
<br />









      ->id('obal_kontakt')
                        ->insert(Html::div()->id('obal_pozadi'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_1'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_2'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_3'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_4'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_5'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_6'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_7'))
                        ->insert(Html::div()->id('obsah_kontakt')
                                ->setText('kontakt')
                        );
*/


/*
                        ->insert(Html::h2()->setText('KONTAKT')->class('museo500700'))
                        ->insert($menu)
                        ->insert(Html::div()
                                ->insert(Html::h3()->setText('Neváhejte nás kontaktovat!')->class('museo500700'))
                                ->setText($form)
                                ->insert($kontakty)
                        );
*/
    }
  }
?>
