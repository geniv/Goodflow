<?php
/*
 *      pckurzy.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace pages;

  use classes\Core,
      classes\Html,
      classes\JsonStorage,
      classes\Configurator;

  class Blog extends Configurator implements Page {
    const URL = 'blog';

    public static function getName() {
      return _('Blog');
    }

    public static function getUserVariable() {
      return array('addition' => 'co je nového',
                  'idsekce' => 'blog');
    }

    public static function getLoadModules() {
      return array();
    }

    public static function getSubMenu() {
      return array();
    }

    public static function getContent() {
/*
      $menu = Html::setArray(JsonStorage::getData('json/objednat_odkazy.json'));

      $data = JsonStorage::getData('json/pckurzy.json');
      $func = function($value) { return Html::p()->setText($value)->class('museo500700'); };
      $text_kurzy_left = array_map($func, $data['text_kurzy']['left']);
      $text_kurzy_right = array_map($func, $data['text_kurzy']['right']);

      //$func = function($value) { return Html::p()->setText($value)->class('museo500700') };
      $kurzy = $data['osnova_kurzu']['kurzy'];
      $kurzy_row = array();
      foreach ($kurzy as $index => $v) {
        if (($index % 2) == 0) {
          $par = range($index, $index + 1);
          $par_obal = Html::ul();
          foreach ($par as $key) {
            $kurz = Core::isFill($kurzy, $key);
            if (!empty($kurz)) {
              $body = array_map($func, $kurzy[$key]['body']);
              $par_obal->insert(Html::li()->class(($key % 2) == 1 ? 'prave_li' : NULL)
                                ->insert(Html::span()->setText(sprintf('%s.', $key + 1))->class('museo500700'))
                                ->insert(Html::h5()
                                        ->insert(Html::strong()->setText($kurzy[$key]['nazev'])->class('museo500700'))
                                        )
                                ->insert($body)
                                );
            }
          }
          $kurzy_row[] = $par_obal;
        }
      }
*/

      return Html::div()->id('obsah_%s', self::getUserVar('idsekce'))->setText('blog');
      /*->id('obal_blog')
                        ->insert(Html::div()->id('obal_pozadi'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_1'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_2'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_3'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_4'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_5'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_6'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_7'))
                        ->insert(Html::div()->id('obsah_blog')
                                ->setText('blog')
                        );


                        ->insert(Html::h2()->setText('PC KURZY')->class('museo500700'))
                        ->insert($menu)
                        ->insert(Html::div()
                                ->insert(Html::h3()->setText('Domácí kurz práce na pc')->class('museo500700'))
                                ->insert(Html::ul()->class('text_kurzy')
                                        ->insert(Html::li()->insert($text_kurzy_left))
                                        ->insert(Html::li()->class('pravy_blok')
                                                ->insert($text_kurzy_right)
                                                ->insert(Html::img()->srcpath('obr/pc-kurzy-foto/1.jpg')->alt('')->width('440')->height('238'))
                                        )
                                )
                                ->insert(Html::h3()->setText('Osnova kurzu')->class('museo500700'))
                                ->insert(Html::h4()->setText($data['osnova_kurzu']['podnadpis'])->class('museo500700'))
                                ->insert(Html::ul()->class('osnova_kurzu')
                                        ->insert(Html::li()
                                                ->insert($kurzy_row)

                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::span()->setText('1.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('Probrání cíle kurzu a základy PC')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('seznámení se s lektorem')->class('museo500700'))
                                                                ->insert(Html::p()->setText('probrání základní osnovy')->class('museo500700'))
                                                                ->insert(Html::p()->setText('stanovení cíle kurzu')->class('museo500700'))
                                                        )
                                                        ->insert(Html::li()->class('prave_li')
                                                                ->insert(Html::span()->setText('2.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('Myš a klávesnice, základy Windows')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('spuštění, vypnutí a restart počítače')->class('museo500700'))
                                                                ->insert(Html::p()->setText('práce s periferiemi (myš, klávesnice, repráky, mikrofon, sluchátka, ...)')->class('museo500700'))
                                                                ->insert(Html::p()->setText('práce s okny, zavírání, maximalizace, minimalizace, přesouvání')->class('museo500700'))
                                                                ->insert(Html::p()->setText('seznámení se s pracovní plochou')->class('museo500700'))
                                                                ->insert(Html::p()->setText('upravení jasu, velikosti textu a ikon')->class('museo500700'))
                                                                ->insert(Html::p()->setText('nabídka Start')->class('museo500700'))
                                                                ->insert(Html::p()->setText('osvojení základních vlastností systému Windows')->class('museo500700'))
                                                        )
                                                )
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::span()->setText('3.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('Práce s dokumenty, tisk')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('vytvoření textového dokumentu WordPad')->class('museo500700'))
                                                                ->insert(Html::p()->setText('práce s jednoduchými textovými dokumenty')->class('museo500700'))
                                                                ->insert(Html::p()->setText('používání složek, složková struktura')->class('museo500700'))
                                                                ->insert(Html::p()->setText('kopírování, přesunování, přejmenování a mazání souborů a složek')->class('museo500700'))
                                                                ->insert(Html::p()->setText('malování, kalkulačka, foxit Reader')->class('museo500700'))
                                                                ->insert(Html::p()->setText('tisknutí dokumentu')->class('museo500700'))
                                                                ->insert(Html::p()->setText('koš')->class('museo500700'))
                                                        )
                                                        ->insert(Html::li()->class('prave_li')
                                                                ->insert(Html::span()->setText('4.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('Multimédia')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('používání CD, DVD, Flash disků')->class('museo500700'))
                                                                ->insert(Html::p()->setText('instalace vypalovacího programu')->class('museo500700'))
                                                                ->insert(Html::p()->setText('seznámení s vypalovacím programem, vytvoření disku')->class('museo500700'))
                                                                ->insert(Html::p()->setText('kopírování z Flash disku')->class('museo500700'))
                                                                ->insert(Html::p()->setText('bezpečné vyjmutí')->class('museo500700'))
                                                                ->insert(Html::p()->setText('spouštění programů')->class('museo500700'))
                                                                ->insert(Html::p()->setText('Windows media player')->class('museo500700'))
                                                                ->insert(Html::p()->setText('přehrávání filmů')->class('museo500700'))
                                                                ->insert(Html::p()->setText('přehrávání muziky')->class('museo500700'))
                                                        )
                                                )
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::span()->setText('5.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('Internet')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('nastavení domovské stránky')->class('museo500700'))
                                                                ->insert(Html::p()->setText('zřízení emailu')->class('museo500700'))
                                                                ->insert(Html::p()->setText('odeslání, přijmutí, smazání emailu')->class('museo500700'))
                                                                ->insert(Html::p()->setText('příloha v emailu')->class('museo500700'))
                                                                ->insert(Html::p()->setText('tisk z emailu')->class('museo500700'))
                                                                ->insert(Html::p()->setText('počasí, TV program')->class('museo500700'))
                                                                ->insert(Html::p()->setText('obsahově naučné stránky')->class('museo500700'))
                                                                ->insert(Html::p()->setText('online TV')->class('museo500700'))
                                                                ->insert(Html::p()->setText('vysvětlení pojmů')->class('museo500700'))
                                                                ->insert(Html::p()->setText('ochrana proti škodlivému softwaru')->class('museo500700'))
                                                                ->insert(Html::p()->setText('ochrana proti spamu')->class('museo500700'))
                                                        )
                                                        ->insert(Html::li()->class('prave_li')
                                                                ->insert(Html::span()->setText('6.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('Seznámení s balíkem MS Office')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('instalace balíku MS Office')->class('museo500700'))
                                                                ->insert(Html::p()->setText('základní seznámení')->class('museo500700'))
                                                                ->insert(Html::p()->setText('vytvoření nejpoužívanějších typů')->class('museo500700'))
                                                                ->insert(Html::p()->setText('Outlook')->class('museo500700'))
                                                                ->insert(Html::p()->setText('Excel')->class('museo500700'))
                                                                ->insert(Html::p()->setText('Word')->class('museo500700'))
                                                                ->insert(Html::p()->setText('Powerpoint')->class('museo500700'))
                                                        )
                                                )
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::span()->setText('7.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('MS Office Word')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('vytvoření textového souboru, uložení, otevření')->class('museo500700'))
                                                                ->insert(Html::p()->setText('nastavení formátování, odrážky, zarovnání, písmo')->class('museo500700'))
                                                                ->insert(Html::p()->setText('kontrola pravopisu')->class('museo500700'))
                                                                ->insert(Html::p()->setText('odstavce, nadpisy, velikosti, barvy, pozadí')->class('museo500700'))
                                                                ->insert(Html::p()->setText('vložení obrázku do dokumentu')->class('museo500700'))
                                                                ->insert(Html::p()->setText('tisk dokumentu')->class('museo500700'))
                                                        )
                                                        ->insert(Html::li()->class('prave_li')
                                                                ->insert(Html::span()->setText('8.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('MS Office Excell')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('vytvoření tabulkového souboru, uložení, otevření')->class('museo500700'))
                                                                ->insert(Html::p()->setText('seznámení se se základními vzorci')->class('museo500700'))
                                                                ->insert(Html::p()->setText('vytvoření jednoduchého účetnictví')->class('museo500700'))
                                                                ->insert(Html::p()->setText('složitější vnořené vzorce')->class('museo500700'))
                                                                ->insert(Html::p()->setText('tisk dokumentu')->class('museo500700'))
                                                                ->insert(Html::p()->setText('grafické zpracování tabulky')->class('museo500700'))
                                                        )
                                                )
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::span()->setText('9.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('MS Office Outlook a Powerpoint')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('nastavení Outlooku pro Váš email')->class('museo500700'))
                                                                ->insert(Html::p()->setText('přijmutí emailu, poslání, připnutí přílohy')->class('museo500700'))
                                                                ->insert(Html::p()->setText('základní rozvržení prezentace')->class('museo500700'))
                                                                ->insert(Html::p()->setText('styly, písmo, barvy, sladění')->class('museo500700'))
                                                                ->insert(Html::p()->setText('načasování, přidání efektů, uložení')->class('museo500700'))
                                                        )
                                                        ->insert(Html::li()->class('prave_li')
                                                                ->insert(Html::span()->setText('10.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('Práce s fotografiemi')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('instalace free programu Photofiltre')->class('museo500700'))
                                                                ->insert(Html::p()->setText('jednoduché úkony ve Photofiltre')->class('museo500700'))
                                                                ->insert(Html::p()->setText('seznámení s Adobe Photoshop')->class('museo500700'))
                                                                ->insert(Html::p()->setText('jednoduchá retuš, tvoření černobíle fotografie, tisk fotografií')->class('museo500700'))
                                                        )
                                                )
                                                ->insert(Html::ul()
                                                        ->insert(Html::li()
                                                                ->insert(Html::span()->setText('11.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('Pokročilejší využití PC')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('vytvoření datové zálohy na médium')->class('museo500700'))
                                                                ->insert(Html::p()->setText('využití internetu pro zálohu dat')->class('museo500700'))
                                                                ->insert(Html::p()->setText('používáni komunikačních programů')->class('museo500700'))
                                                                ->insert(Html::p()->setText('icq, skype, facebook')->class('museo500700'))
                                                                ->insert(Html::p()->setText('vytvoření fotogalerie na Internetu')->class('museo500700'))
                                                        )
                                                        ->insert(Html::li()->class('prave_li')
                                                                ->insert(Html::span()->setText('12.')->class('museo500700'))
                                                                ->insert(Html::h5()
                                                                        ->insert(Html::strong()->setText('Zhodnocení a rekapitulace')->class('museo500700'))
                                                                )
                                                                ->insert(Html::p()->setText('zopakování probrané látky')->class('museo500700'))
                                                                ->insert(Html::p()->setText('zaměření se na problémové věci')->class('museo500700'))
                                                                ->insert(Html::p()->setText('samostatná práce')->class('museo500700'))
                                                        )
                                                )

                                        )
                                )
                                ->insert(Html::h6()->class('museo500700')->setBBCodeText($data['zaver']))
                        );
                        */
    }
  }
?>
