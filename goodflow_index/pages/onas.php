<?php
/*
 *      mycomp.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace pages;

  use classes\Core,
      classes\Html,
      classes\JsonStorage,
      classes\Configurator;

  class Onas extends Configurator implements Page {
    const URL = 'o-nas';

    public static function getName() {
      return _('O nás');
    }

    public static function getUserVariable() {
      return array('addition' => 'co děláme',
                  'idsekce' => 'o_nas');
    }

    public static function getLoadModules() {
      return array('' => array('script' => array('$(document).ready(function() {
        Cufon.replace(\'#obsah_o_nas #nazev_sekce h2, #obsah_o_nas h3\', { fontFamily: \'mwp\', hover: true });
      });')));
    }

    public static function getSubMenu() {
      return array();
    }

    public static function getContent() {
      //nacitani dat z JSON
      $data = JsonStorage::getData('json/onas.json');
      $func = function($value) { return Html::p()->setMarkupText($value); };
      $texty = array_map($func, $data);

      return Html::div()->id('obsah_%s', self::getUserVar('idsekce'))
      ->insert(Html::div()->id('nazev_sekce')
              ->insert(Html::h2()->setText('Kdo jsme'))
      )
      ->insert(Html::h3()->setText('O tom kdo jsme a co děláme'))
      ->insert($texty)
      //->insert(Html::p()->setText('Jsme tým vývojářů, mající za sebou bohaté zkušenosti se zpracováváním a vývojem administračního systému pro user-friendly použití. Můžeme se pochlubit řadou úspěšných referencí, díky kterým se naše zkušenosti obohatily a přinesly celou řadu změn a vylepšení v admin systému. Při naší práci dbáme především na vysokou kvalitu zpracování.'))
      //->insert(Html::p()->setMarkupText('Naše role jsou:\nwebmaster - Martin Fryšták a programátor - Radek Fryšták'))
      //->insert(Html::p()->setText('Dále už za nás hovoří naše reference.'))

      //->insert(Html::kua()->setText('proč?')->insert(Html::pica()->setText('hcii')))

      ;
/*
      ->id('obal_o_nas')
                        ->insert(Html::div()->id('obal_pozadi'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_1'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_2'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_3'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_4'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_5'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_6'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_7'))
                        ->insert(Html::div()->id('obsah_o_nas')
                                ->setText('o nas')
                        );
*/
/*
                        ->insert(Html::h2()->setText('O FIRMĚ myComp')->class('museo500700'))
                        ->insert($menu)
                        ->insert(Html::div()
                                ->insert(Html::img()->srcpath('obr/mycomp-foto/1.jpg')->alt('')->width('922')->height('277'))
                                ->insert(Html::h3()->setText('Společnost myComp')->class('museo500700'))
                                ->insert(Html::p()->setMarkupText($data['paragraph_left'])->class('museo500700'))
                                ->insert(Html::p()->setMarkupText($data['paragraph_right'])->class('museo500700'))
                        );
*/
    }
  }

?>
