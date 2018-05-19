<?php

  //load autoload
  require 'loader.php';

  use classes\Core,
      classes\Html,
      classes\LightHtml,
      classes\HtmlPage,
      classes\Form,
      classes\Debugger,
      classes\LoginForm,
      classes\Cache;

  //~ Debugger::configure();

  Debugger::startTime();

//var_dump($_GET);
//var_dump($_SERVER);
//var_dump($_POST);

  //Debugger::test()->isString('text..', 'je toto text?');
  //Debugger::test()->isString(true, 'je toto ma byt text?');
  //Debugger::error('tu je nejaka nepodstatna chyba...');

  //var_dump(Debugger::viewTests());

  //$cach = Cache::getInstance();
  $cach = Cache::getInstance(true); //s output buffer
  //$cach->setCache()->setCacheExpire('10 minutes');  //zapnuti cachovani a nastaveni

//var_dump($cach->getCacheDir());

  //echo $cach->getCacheInfo();

//$aa = new DateTime('now');
//$bb = new DateTime('-2 day');
//var_dump($aa, $bb, $aa->diff($bb));

//var_dump($cach->getRemainTime());
//var_dump($cach->getElapseTime());

//var_dump($cach);
//$cach->reloadCache();
//$cach->clearCache();
//var_dump($cach->getCacheExpire());
//$cach->clearAllCache();
//var_dump(ob_get_status());

  if ($cach->isCached()) {
//var_dump('cteni z cache');
    echo $cach->getCacheContent();  //vraceni nacachovaneho obsahu
    //echo $cach->getOutBuff();
  } else {
    $cach->initOutBuff();

/*
    $f = NULL;
    $f = new Form;
    $f->addText('nejakej_huj')
      ->addText('nejakej_nviiiiiiii')
      ->addGroup('', array('html' => Html::span()->class('chuj')->insert(Html::strong()->setText('skupina 1'))))
        ->addText('textove_pole')
        ->addPassword('heslo')
      ->addGroup('skupina 2')
        ->addTextArea('vice_text')
      ->endGroup()
      ->addSearch('hledani_pekla')
      ->addSubmit('tlc')
      ;

    //Debugger::startTime('pokus');

    $page = new HtmlPage;
    $page->setLanguage('cs')
          ->addBody($f);

    //$p = (string) $page;
    //$p = $page;

    //$cach->setCacheContent($p);

    //echo $p;
    echo $page;
*/

    echo '
    <script language="javascript" type="text/javascript">
      GFA = {
          AJAX: {
            atribut: "moje",
            pole: ["a", "b", "c", 1, 2, 3],
            metoda: function () {
              alert(this.atribut+" a rikam ahoj!");
            },
          },
          Body: {},
          Control: {},
          Debugger: {},
          Element: {},
          Form: {}
      }

    </script>

    <input type="button" value="klik" onclick="GFA.AJAX.metoda();">
';

    //$form = new LoginForm;

    LightHtml::enableBreakDepth();
    LightHtml::setDepth(2);
    //LightHtml
    //LHtml
    //LHTM
    //Lhtml AHTM

    $br = LightHtml::elem('br');//->insert(LightHtml::elem('div'));
    $a = LightHtml::elem('div');
    //$a->insert($br);
    $s = LightHtml::elem('span')->insert(LightHtml::elem('strong')->insert(array($br, $br)));
    $a->insert($s);

    $b = LightHtml::elem('div');
    $b->setText('ahoj světe');
    $b->insert(LightHtml::elem('input'));
    //$b->insert(LightHtml::elem('a')->href('ultra_odkaz')->insert(LightHtml::el('span')));
    $b->insert(LightHtml::elem('a')->href('ultra_odkaz')->setText('toto je odkazovy odkaz'));
    //$b->setText('ahoj světe');
    //$b->insert($br);
    //$a->insert(LightHtml::elem('hr'));
    //$a->insert(LightHtml::elem('input'));
//print_r($b);
    //$a->insert($br);
    //$a->insert($br)->insert($br);
    //$a->insert($br);
    //$a->insert($br);
    $a->insert($b);

    //$a->insert($a);
    //$a->insert($a->insert($a));

    var_dump(Core::isFirefox(),Core::isChrome());


//var_dump($a);
//print_r($a);
    echo $a;

    //echo LightHtml::elem('i');

    //echo LightHtml::el('br');

    $cach->setOutBuff();
  }

  //echo Debugger::viewTimes();
  echo Debugger::viewTime();

?>
