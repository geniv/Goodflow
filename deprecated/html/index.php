<?php

  require 'html.php';
  require 'template.php';
  require 'core.php';

  use classes\Html,
      classes\Core,
      classes\Template;

  //$t = new Template;

/*
  $data = array('href_link' => 'toto je super href',
                'podminka' => 'kdyz jsou vajca tak 30 rohliku',
                'name' => 'naaazev',
                'neco' => 'super neco novyho',
                );
*/
  //$t->rewrite($data);

  $struct = Html::elem('a')
                  ->href('{href_link}')
                  //->class('pred')
                  ->class('{podminka}')
                  //->class('{podminka}')
                  //->class('za')
                  //->class('kdneslas')
                  ->id('kokot mrdka')
                  ->setText('{name} kuk: {title}')
                  ->insert(Html::elem('span')->setText('{title}')->setText('{name}'))
                  ->setUse(Html::USE_REPEAT)
                  //->setText('{neco}')
                  ;

echo test::testMethod($struct);

  class test {
    public static function testMethod($s = NULL) {

      if (empty($s)) {
        $row = Html::elem('a')
                    ->href('{href_link}')
                    ->class($podm)
                    ->class('jina_trida')
                    ->id('kokot_mrdka')
                    //->setText('a toto je text pred obsahem')
                    //->setText('a toto je text pred obsahem')
                    ->insert(Html::elem('span')->setText('%%title%%'))
                    ->insert(Html::elem('span')->setText('{title}')->setText('{name}'))
                    ->insert(Html::elem('span')->setText('{title}')->setText('{name}'))
                    //->setText('a toto je text za obsahem')
                    //->setText('a toto je text za obsahem')
                    //->setTemplate($data)
                    //->setTemplate($data)
                    ;
      } else {
        foreach (range(1, 5) as $val) {
          $data = array('href_link' => 'hreeeeeeeefiiiiik',
                        'podminka' => (false ? 'podmiiinka' : NULL),
                        'name' => rand(),
                        'title' => '+tituleek+',
                        );

          $row[] = $s->setTemplate($data)->render();
        }
        $row = implode('', $row);
      }

      return $row;
    }
  }

  //echo $sablona_menu;

  //echo PHP_EOL;

//var_dump($sablona_menu);

/*
  $sablona = Html::elem('div')
                  ->setText('text1');
                  //->appendBefore('ahooook')
                  //->appendAfter(array('a tady je teeext', '', NULL, Html::elem('em')->class('lolka')));

  //echo Html::template($sablona);
  echo $sablona;
*/


/*
  $span = NULL;
  $br = Html::elem('br');
  $a = Html::elem('a')->setText('hniii')->insert($br);
  //p = Html::elem('p')->class('hovno')->setText('toto je span 1');
  $p = Html::elem('strong');
  echo $k = Html::elem(Html::NOTE_NORMAL)->setText('toto je komentar?');
  $k1 = Html::elem(Html::NOTE_IF, array('IE=7'))->setText('toto je komentar s podminkou?');
  $p1 = Html::elem('p')->class('hovno')->setText('toto je text spanu')->insert($a);
  $span = Html::elem('span')->insert(array($p, $p1, $k, $k1));

  //$span = Html::elem('br');//->setText('nejaky em?');
  //$span = Html::elem('em')->setText('nejaky em?');
  //$span = Html::elem(Html::NOTE_NORMAL)->setText('toto je komentar?');
  //$strong = Html::elem('strong')->id('kokot')->setText('a tady je nááš text');
  //$span = Html::elem('p')->class('nečum')->insert(array($strong, $strong, $strong));

  echo Html::elem('div')
            //->setText('ahoj')
            //->setText('cece')
            //->setText('kuku')
            //->setText('huuuu')
            //->setText(array('hhh', 'kkkk', 'lllll', '', NULL))
            ->insert(array($span, $span, $span))
            //->appendBefore($strong)
            //->insert($span)
            //->setText('hvviiiii')
            //->setText(array('txxxxx', 'tyyyy'))
            //->insert(array($span, $span))
            ;
*/

  //var_dump(Core::easyDecode(Core::easyEncode('ahoj')));
  //var_dump(Core::isLinux(), Core::isWindows());
  //print_r(apache_get_modules());
  //var_dump(apache_get_version());
  //print_r(apache_request_headers());
  //print_r(apache_response_headers());

/*
  $db = new SQLite3('mysqlitedb.db');
  $db->exec('CREATE TABLE foo (bar STRING)');
  $db->exec("INSERT INTO foo (bar) VALUES ('This is a test')");
  $result = $db->query('SELECT bar FROM foo');
  var_dump($result->fetchArray());
*/

?>
