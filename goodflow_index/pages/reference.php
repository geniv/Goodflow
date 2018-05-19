<?php
/*
 *      uvod.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace pages;

  use \Config,
      classes\Core,
      classes\Html,
      classes\JsonStorage,
      classes\Pagination,
      classes\Configurator;

  class Reference extends Configurator implements Page {
    const URL = '';

    public static function getName() {
      return _('Reference');
    }

    public static function getUserVariable() {
      return array('addition' => 'naše projekty',
                  'idsekce' => 'reference');
    }

    public static function getLoadModules() {
      return array('' => array('script' => array(sprintf('$(document).ready(function() {
        Cufon.replace(\'#obsah_reference .polozka .nazev_reference h2\', { fontFamily: \'mwp\', hover: true });
        Cufon.replace(\'#obsah_reference #strankovani #urceni_strany a.cisla_stranek, #obsah_reference #strankovani #urceni_strany span\', { fontFamily: \'Museo\', hover: true });
        //<![CDATA[
          $(\'#obsah_reference .polozka .obal_slide\').each(function(i) {
            var poc = $(this).find(\'.highslide\').length;
            var $this = $(this).after(\'<span class="ikony_slide nav_slide_\'+i+\'"></span>\').find(\'.slide\').after(poc > 1 ? \'<a href="#" class="prev_slide prevslide\'+i+\'" title="Předchozí">Předchozí náhled</a>\' : \'\').after(poc > 1 ? \'<a href="#" class="next_slide nextslide\'+i+\'" title="Následující">Následující náhled</a>\' : \'\');
            $this.cycle({
              fx: \'turnLeft\',
              speed: 900,
              timeout: 0,
              pager: \'.nav_slide_\'+i,
              prev: \'.prevslide\'+i,
              next: \'.nextslide\'+i,
              easing: \'easeOutBounce\'
            });
          });
        //]]>
      });
      hs.graphicsDir = \'*url*highslide/graphics/\';
      var config = new Array();
      //<![CDATA[
        for (var i = 0; i < %s; i++) {
          hs.addSlideshow({
            slideshowGroup: \'group\'+i,
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: \'fit\',
            overlayOptions: {
              className: \'large-dark\',
              opacity: 0.6,
              position: \'bottom center\',
              offsetX: 0,
              offsetY: -15,
              hideOnMouseOut: true
            }
          });
          config[i] = {
            slideshowGroup: \'group\'+i,
            numberPosition: \'caption\',
            transitions: [\'expand\', \'crossfade\']
          }
        }
      //]]>', Config::REFERENCE_PERPAGE)),
                              ),
                  );
/*
                  '' => array('js' => array('script/jquery/jquery.cycle.all.min.js',),
                              'script' => array('  $(\'#monitor\').cycle({
          width: 384,
          height: 240,
          fx: \'scrollHorz\',
          easing: \'easeOutExpo\',
          speed: 700,
          prev: \'#sipka_vlevo\',
          next: \'#sipka_vpravo\',
          random: 1,
          timeout: 5000,
          pause: 1
        });'
                                            )
                              ),
*/
    }

    public static function getSubMenu() {
      return array();
    }

    public static function getContent() {
      //nacitani dat z JSON
/*
      $data = JsonStorage::getData('json/centralni_informace.json');
      $email_info = Core::getSafeEmail($data['info']);
      $email_servis = Core::getSafeEmail($data['servis']);
      $telefon = $data['telefon'];

      $data = JsonStorage::getData('json/home.json');
      $func = function($value) { return Html::img(array('alt' => $value['alt'], 'width' => 384, 'height' => 240))->srcpath($value['path']); };
      $monitor = array_map($func, $data['monitor']);

      $func = function($value) { return Html::li()->setText($value)->class('museo100300'); };
      $info_left = array_map($func, $data['info']['left']);
      $info_right = array_map($func, $data['info']['right']);
*/

/*
      $a = array(array('nazev' => 'SMSKNIsivýhru',
                      'url' => 'http://www.kokott.cz',
                      'text' => 'www.kokotteeeeee.cz',
                      'obr' => array('1.png' => 'nazev',
                                    '2.png' => 'Nazev reference',
                                    '3.png' => 'Nazev reference',
                                    '4.png' => 'Nazev reference',
                                    )
                      ),
                array('nazev' => 'SMSKNIsivýhru 2',
                      'url' => '',
                      'text' => 'kokotteeeeee df dfsd.',
                      'obr' => array('5.png' => 'nazev',
                                    '6.png' => 'nazev',
                                    '7.png' => 'nazev',
                                    '8.png' => 'nazev',
                                    '9.png' => 'nazev',
                                    ),
                      ),
                );
*/

      //JsonStorage::setData('json/reference.json', $a);

      $data = JsonStorage::getData('json/reference.json');

      $pg = new Pagination;
      $pg->setCountItem(count($data))
          ->setPerPage(Config::REFERENCE_PERPAGE)
          ->setPagingVariable('page')
          ->calculate();

      $data = Core::getListRangeArray($data, $pg->getArrayLimit());

      $row = array();
      foreach ($data as $index => $values) {
        $obr = array();
        foreach ($values['obr'] as $path => $title) {
          $obr[] = Html::a()->hrefpath('reference/full/'.$path)->title($title)->onclick(sprintf('return hs.expand(this, config[%s] )', $index))->class('highslide')
                            ->insert(Html::img()->srcpath('reference/mini/'.$path)->alt($title)->width('651')->height('178'));
        }

        $nazev_zavorky = (!empty($values['url']) ? Html::a()->href($values['url'])->title(sprintf('%s - %s', $values['nazev'], $values['text'])) : Html::strong());
        $row[] = Html::div()->class('polozka')
                                ->insert(Html::div()->class('obal_slide')
                                        ->insert(Html::p()->class('slide')->class('highslide-gallery')->insert($obr))
                                )
                                ->insert(Html::div()->class('nazev_reference')
                                        ->insert(Html::h2()->setText('%s [ %s ]', array($values['nazev'], $nazev_zavorky->setText($values['text'])))
                                        )
                                );
      }

      $sablona = array('prev' => Html::a()->hrefpath('{page}')->setText('Předchozí strana')->title('Předchozí strana')->class('sipka_predchozi'), //->href('{url}', array('{args}'))
                       'item' => Html::a()->hrefpath('{page}')->setText('{val}')->class('cisla_stranek')->title('Strana {val}'),
                       'current' => Html::span()->setText('{val}')->title('Strana {val}'),
                       'next' => Html::a()->hrefpath('{page}')->setText('Následující strana')->title('Následující strana')->class('sipka_nasledujici'), // -&gt; &lt;-
                       'pager' => Html::div()->id('strankovani')
                                                                //->insert(Html::span()->id('info_strana')->setText('Strana {current} z {countpage}'))
                                                                ->insert(Html::span()->id('urceni_strany')->setText('{hrefs}')->clearBreakDepth())->clearBreakDepth()
                        );

$reklama = Html::div()->setText('<script type="text/javascript"><!--
google_ad_client = "ca-pub-7051007774325370";
/* GF design */
google_ad_slot = "3335370211";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>');

      return Html::div()->id('obsah_%s', self::getUserVar('idsekce'))
                        ->insert($row)
                        ->insertContent($pg->getPager(Pagination::PAGER_FULL_NORMAL, $sablona))
/*->insert($reklama)*/;

/*
      ->id('obal_reference')
                        ->insert(Html::div()->id('obal_pozadi'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_1'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_2'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_3'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_4'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_5'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_6'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_7'))
                        ->insert(Html::div()->id('obsah_reference')


                        ->class('obal_polozka')
*/
/*
                                ->setText('')'



Lorem ipsum dolor sit amet consectetuer Sed amet semper wisi sem. Tellus porttitor a In quis et eros tincidunt augue pede senectus. Et lorem interdum neque Mauris et convallis facilisi dui tincidunt felis. Consectetuer sit Vivamus pharetra et Integer non interdum egestas nibh congue. Sed Vestibulum iaculis Aliquam pellentesque dis quis pellentesque nibh suscipit urna. Vestibulum.


<div class="highslide-gallery">
	<ul>
	<li>
	<a href="highslide/sample-images/thumbstrip01.jpg" class="highslide"
			title="Caption from the anchor's title attribute"
			onclick="">
		<img src="highslide/sample-images/thumbstrip01.thumb.jpg"  alt=""/>
	</a>



                        ')
                        */

/*
                        ->insert(Html::div()->class('polozka')
                                ->insert(Html::div()->class('obal_slide')
                                        ->insert(Html::div()->class('slide')->class('highslide-gallery')
                                                ->insert(Html::a()->hrefpath('reference/full/1.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/1.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/2.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/2.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/3.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/3.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/4.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/4.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                        )
                                )
                                ->insert(Html::div()->class('nazev_reference')
                                        ->insert(Html::h2()->setText('SMSKNIsivýhru [ %s ]', array(Html::a()->href('#')->title('Nazev reference')->setText('www.kokotteeeeee.cz')))
                                        )
                                )

                        )

                        ->insert(Html::div()->class('polozka')
                                ->insert(Html::div()->class('obal_slide')
                                        ->insert(Html::div()->class('slide')
                                                ->insert(Html::a()->hrefpath('reference/full/5.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/5.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/6.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/6.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/7.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/7.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/8.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/8.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/9.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/9.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/8.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/8.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/8.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/8.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                                ->insert(Html::a()->hrefpath('reference/full/8.png')->title('Nazev reference')->onclick('return hs.expand(this, config1 )')->class('highslide')
                                                        ->insert(Html::img()->srcpath('reference/mini/8.png')->alt('Nazev reference')->width('651')->height('178'))
                                                )
                                        )
                                )

                                ->insert(Html::div()->class('nazev_reference')
                                        ->insert(Html::h2()->setText('SMSKNIsivýhru [ %s ]', array(Html::strong()->setText('Kokot public projekt')))
                                        )
                                )

                                //->insert(Html::span()->class('ikony_slide'))
                        )
*/



                        //)
                        //;
/*
                        ->insert(Html::div()->id('vrchni_cast')
                                ->insert(Html::div()->id('info_text')
                                        ->insert(Html::h2()->setText('PC SERVIS AŽ K VÁM DOMŮ')->class('museo500700'))
                                        ->insert(Html::ul()
                                                ->insert($info_left)
                                        )
                                        ->insert(Html::ul()->id('seznam_vpravo')
                                                ->insert($info_right)
                                        )
                                )
                                ->insert(Html::div()->id('obal_prava_cas')
                                        ->insert(Html::div()->id('obal_monitor')
                                                ->insert(Html::div()->id('monitor')
                                                        ->insert($monitor)
                                                )
                                                ->insert(Html::p()->id('sipka_vlevo')
                                                        ->insert(Html::a()->href('#')->title('')->setText('Předchozí'))
                                                )
                                                ->insert(Html::p()->id('sipka_vpravo')
                                                        ->insert(Html::a()->href('#')->title('')->setText('Další'))
                                                )
                                        )
                                )
                        )
                        ->insert(Html::div()->id('spodni_cast')
                                ->insert(Html::div()->id('prvni_blok')
                                        ->insert(Html::h3()->setText('Domácí kurz práce na PC')->class('museo900'))
                                        ->insert(Html::p()->setText('Kurz je zaměřený pro')->insert(Html::em()->setText('lidi středního věku'))->setText('a seniory.')->class('museo100300'))
                                        ->insert(Html::span()->class('oddelovac_bloky'))
                                        ->insert(Html::p()->setText('Nemusíte nikam chodit, technik (školitel)')
                                                ->insert(Html::em()->setText('přijde až k Vám domů'))->setText('a bude se věnovat jen Vám, tím se zvýší úspěšnost kurzu.')->class('museo100300')
                                                )
                                )
                                ->insert(Html::div()->id('druhy_blok')
                                        ->insert(Html::h3()->setText('Hot line')->class('museo900'))
                                        ->insert(Html::p()->insert(Html::strong()->setText('24')->class('museo900'))->insert(Html::em()->setText('Hodin denně')->class('museo100300')))
                                        ->insert(Html::p()->class('druhy_odstavec')->insert(Html::strong()->setText('7')->class('museo100300'))->insert(Html::em()->setText('Dní v týdnu')->class('museo500700')))
                                )
                                ->insert(Html::div()->id('treti_blok')
                                        ->insert(Html::h3()->setText('Kontakt na hotline')->class('museo900'))
                                        ->insert(Html::p()->insert(Html::strong()->setText('Mobil')->class('museo500700'))
                                                ->insert(Html::em()->setText($telefon)->class('museo100300'))
                                                )
                                        ->insert(Html::p()->insert(Html::strong()->setText('Mail')->class('museo500700'))
                                                ->insert(Html::a()->href($email_servis['href'])->title('')->setText($email_servis['text'])->class('museo100300'))
                                                ->insert(Html::a()->href($email_info['href'])->title('')->setText($email_info['text'])->class('museo100300'))
                                                )
                                )
                        )
                        ->insert(Html::div()->id('objednat_servis')
                                ->insert(Html::h3()
                                        ->insert(Html::strong()->setText('Objednat servis')->class('museo500700'))
                                        ->insert(Html::span())
                                        ->insert(Html::em()->setText('vyberte typ servisu')->class('museo100300'))
                                )
                                ->insert(Html::p()
                                        ->insert(Html::a()->hrefpathrewrite(Kontakt::URL, Kontakt::ZAKAZNIK)->title('Objednat servis u ZÁKAZNÍKA')->setText('Objednat servis u ZÁKAZNÍKA')->id('objednat_servis_1'))
                                        ->insert(Html::a()->hrefpathrewrite(Kontakt::URL, Kontakt::SVOZ)->title('Objednat svoz ZDARMA')->setText('Objednat svoz ZDARMA')->id('objednat_servis_2'))

                                ->insert(Html::a()->href('#')->title('Objednat servis TELEFONICKY')->setText('Objednat servis TELEFONICKY')->id('objednat_servis_3')->onclick('return hs.htmlExpand(this, { width: \'450\' })'))
                                ->insert(Html::span()->class('highslide-maincontent')
                                        ->insert(Html::strong()->setText(sprintf('tel.: ( +420 ) %s', $telefon))->class('museo500700')->id('centralni_cislo'))
                                )



                                )
                        );
*/
    }
  }

?>
