<?php
/*
 *      servis.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace pages;

  use classes\Core,
      classes\Html,
      classes\JsonStorage,
      classes\Configurator;

  class Vyvoj extends Configurator implements Page {
    const URL = 'vyvoj';

    public static function getName() {
      return _('Vývoj');
    }

    public static function getUserVariable() {
      return array('addition' => 'z naší dílny',
                  'idsekce' => 'vyvoj');
    }

    public static function getLoadModules() {
      return array(); //'' => array('script' => array('')
    }

    public static function getSubMenu() {
      return array();
    }

    public static function getContent() {
/*
      $menu = Html::setArray(JsonStorage::getData('json/objednat_odkazy.json'));

      $data = JsonStorage::getData('json/servis.json');
      $func = function($value) { return Html::li()->insert(Html::p()->setText($value)->class('museo500700')); };
      $ostatni_servis = array_map($func, $data['ostatni_servis']);
*/

      return Html::div()->id('obsah_%s', self::getUserVar('idsekce'))->setText('vyvoj');
/*
      ->id('obal_vyvoj')
                        ->insert(Html::div()->id('obal_pozadi'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_1'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_2'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_3'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_4'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_5'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_6'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_7'))
                        ->insert(Html::div()->id('obsah_vyvoj')
                                ->setText('vyvoj')
                        );
*/

                        //->insert(Html::h2()->setText('Vývoj')->class('museo500700'))
/*
                        ->insert($menu)
                        ->insert(Html::div()
                                ->insert(Html::h3()->setText('Servis PC (opravy počítačů Břeclav a okolí)')->class('museo500700'))
                                ->insert(Html::img()->srcpath('obr/servis-foto/1.png')->alt('')->width('218')->height('114'))
                                ->insert(Html::p()->setText($data['odstavec_top'])->class('museo500700')->class('odstavec_top'))
                                ->insert(Html::h3()->setText('Nabídka oprav (komplexní pozáruční a záruční servis pc techniky)')->class('museo500700'))
                                ->insert(Html::ul()->class('nabidka_oprav')
                                        ->insert(Html::li()
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::strong()->setText('Servis počítačů')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()
                                                                ->insert(Html::em()->setText('osobních počítačů veškerých značek a typů')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()->setText('Acer, Asus, IBM, HP, Apple, Dell, Fujitsu Siemens, Leo, Lynx, Autocont, Sony atd..')->class('museo500700'))
                                                )
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::strong()->setText('Servis tiskáren')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()
                                                                ->insert(Html::em()->setText('opravy tiskáren všech značek a parametrů')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()->setText('Epson, HP, Canon, Samsung, Brother, Lexmark, Konica Minolta, Xerox atd..')->class('museo500700'))
                                                )
                                        )
                                        ->insert(Html::li()
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::strong()->setText('Servis notebooků')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()
                                                                ->insert(Html::em()->setText('opravy notebooků všech typů a značek')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()->setText('Acer, Asus, IBM, HP, Apple, Dell, Fujitsu Siemens, Toshiba, Sony atd...')->class('museo500700'))
                                                )
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::strong()->setText('Servis monitorů')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()
                                                                ->insert(Html::em()->setText('opravy monitorů všech typů a velikostí')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()->setText('Acer, Asus, Beng, Samsung, HP, LG, Dell, Panasonic, Eizo, Neovo atd..')->class('museo500700'))
                                                )
                                        )
                                        ->insert(Html::li()
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::strong()->setText('Servis mobilních telefonů')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()
                                                                ->insert(Html::em()->setText('opravy všech typů a značek')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()->setText('Nokia, Apple, Sony ericsson, Samsung, LG, Motorola, HTC atd..')->class('museo500700'))
                                                )
                                        )
                                        ->insert(Html::li()->class('modry_seznam')
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::strong()->setText('+ Tvorba webu')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()
                                                                ->insert(Html::em()->setText('tvorba webových stránek, firemních prezentací a systémů')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()->setText('Profesionální tvorba webových stránek od jednoduchých prezentací po složité administrační systémy')->class('museo500700'))
                                                        ->insert(Html::li()
                                                                ->insert(Html::a()->href('http://www.gfdesign.cz/')->title('GoodFlow design - Tvorba webových stránek a systémů')->setText('www.gfdesign.cz')->class('museo500700'))
                                                        )
                                                )
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::strong()->setText('+ Tvorba grafiky')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()
                                                                ->insert(Html::em()->setText('tvorba grafických návrhů')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()->setText('Profesionální tvorba tiskové i webové grafiky - logotypy, vizuály, flash, webdesign, corporation identity')->class('museo500700'))
                                                        ->insert(Html::li()
                                                                ->insert(Html::a()->href('http://www.martiondesign.net/')->title('Martion Design - webové portfolio Martina Šuláka')->setText('www.martiondesign.net')->class('museo500700'))
                                                        )
                                                )
                                        )
                                )
                                ->insert(Html::h3()->setText('Možnosti servisu')->class('museo500700'))
                                ->insert(Html::ul()->class('moznosti_servisu')
                                        ->insert(Html::li()
                                                ->insert(Html::ul()->class('moznosti_servisu_modry')
                                                        ->insert(Html::li()->class('prvni_li')
                                                                ->insert(Html::em()->setText('servis')->class('museo100300'))
                                                                ->insert(Html::strong()->setText('u zákazníka')->class('museo500700'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()->class('druhe_li')
                                                                ->insert(Html::p()->setText($data['moznosti_servisu_modry'])->class('museo500700'))
                                                        )
                                                        ->insert(Html::li()
                                                                ->insert(Html::a()->hrefpathrewrite(Kontakt::URL, Kontakt::ZAKAZNIK)->title('')->setMarkupText('objednat online\nservis u zákazníka')->class('museo500700'))
                                                        )
                                                )
                                                ->insert(Html::ul()->class('moznosti_servisu_hnedy')
                                                        ->insert(Html::li()->class('prvni_li')
                                                                ->insert(Html::em()->setText('servis')->class('museo100300'))
                                                                ->insert(Html::strong()->setText('u nás')->class('museo500700'))
                                                                ->insert(Html::em()->setText('(svoz zařízení zdarma)')->class('museo100300')->class('em_dodatek'))
                                                                ->insert(Html::span())
                                                        )
                                                        ->insert(Html::li()->class('druhe_li')
                                                                ->insert(Html::p()->setText($data['moznosti_servisu_hnedy'])->class('museo500700'))
                                                        )
                                                        ->insert(Html::li()
                                                                ->insert(Html::a()->hrefpathrewrite(Kontakt::URL, Kontakt::SVOZ)->title('')->setMarkupText('objednat online\nservis u nás')->class('museo500700'))
                                                        )
                                                )
                                        )
                                )
                                ->insert(Html::h4()->setText('Poskytujeme kompletní servis pc techniky a to 24 hodin denně 7 dní v týdnu!!!')->class('museo500700'))
                                ->insert(Html::h3()->setText('Ostatní servis a služby')->class('museo500700'))
                                ->insert(Html::ul()->class('ostatni_servis')->insert($ostatni_servis))
                                ->insert(Html::h3()->setText('Rychlost a způsob opravy')->class('museo500700'))
                                ->insert(Html::p()->setMarkupText($data['zpusob_opravy'])->class('museo500700')->class('zpusob_opravy'))
                        );
*/
    }
  }
?>
