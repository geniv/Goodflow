<?php
/*
 * index.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  require 'lightloader.php';

  classes\ErrorLoger::enable('logs/');

//******************************************************************************

//~ Core::setCharset();

//******************************************************************************

classes\Debugger::startTime();
$weburl = classes\Core::getUrl();


$model = array(
    'action',
    'action==page/number',
    'action==edit/id',
    'action==del/id',
    'action==select/id'
  );
$router = classes\Router::uri($model);
//~ echo '<br />';
//~ echo 'router: '.print_r($router, true).'<br />';
//~ echo 'post: '.print_r($_POST, true).'<br />';
//~ echo 'files: '.print_r($_FILES, true).'<br />';
//~ var_dump($_FILES);
//~ var_dump($_POST);
//~ exit;

//~ var_dump(classes\Core::getSafeName(
//~ <<<T
//~ testuji mez'ery ašč"ěš123.txt
//~ T
//~ ));

//~ var_dump($_SERVER['HTTP_USER_AGENT']);
//~ echo '<hr>';

//~ var_dump(CURLOPT_USERAGENT, CURLOPT_CONNECTTIMEOUT);

//TODO ten post+data na get atd..!!!

//~ $cur = new classes\Curl('http://www.useragentstring.com/?' . http_build_query(array('uas' => $_SERVER['HTTP_USER_AGENT'], 'getJSON' => 'all')));
//~ $cur->get('htatp://www.useragentstring.com/', array('uas' => $_SERVER['HTTP_USER_AGENT'], 'getJSON' => 'all'));
//~ $cur->url('http://localhost/www/git/goodflow/i.php');
//~ $cur->get('http://localhost/www/git/goodflow/i.php', array('aa' => 123123, 'vbvb' => 'bssbss'))
    //~ ->post(array('a' => 123, 'vb' => 'bss'));
//~ $cur->setTimeout(1);
//~ var_dump($cur->exec());

use classes\Core;

classes\DateAndTime::setDateTimezone('Europe/Berlin');

echo '<pre>';

    $conf = <<<F
#NEON configure

common:             # spolecne nastaveni
    database:
        name: test
        driver: MySQL
        autoinstall: false
        charset: utf8
        dsn:
            host: localhost
            username:
            password:
            port:
            options:

# @database

                    # vyvojovy blok
development < common:
    database:
        name: test
        autoinstall: true
        dsn:
            username: root
            password: geniv

                    # produkcni blok
production < common:
    database:
        name: final-name
        dsn:
            username: userXX
            password: passXX

F;


    class Arrays {

        // do jiste miry hloupe ale vinikajici slucovani
        private static function _merge($array1, $array2) {
            foreach ($array2 as $k => $v) {
                $array1[$k] = is_array($v) ? self::_merge($array1[$k], $v) : $v;
            }
            return $array1;
        }

        // arr.2 prepisuje arr.1
        public static function merge($array1, $array2) {
            return self::_merge($array1, $array2);
        }
    }

    //TODO udelat tridu na praci s pole, hlavne kvuli rekurzivnimu scitani pro konfigurator (ne array_merge ale +)

    // vsechny konfiguraky predzvejkat do cache a kontrolovagt invalidaci pres json soubor ve kterem bude: path/nazev.xxx => datum zmeny
    // |bude projizdet jen pri develop modu a nebo z adminu bude nejake tlacitko pro likvidaci

    //TODO to co bude v teto tride ktera bude toto provadet tak by mela brat v potaz registrovane sluzby a ty poskytovat pod @promenna

//TODO toto bude trida konfiguratoru
//trida na nacitani neonu bude NEON resp Neon
//TODO jeste trida services

    $c = classes\Configurator::decode($conf);

    foreach ($c as $k => $v) {
        if (preg_match('/(?<to>\w+) < (?<from>\w+)/', $k, $m)) {
            $cx[$m['to']] = Arrays::merge($c[$m['from']], $c[$k]);
        } else {
            $cx[$k] = $v;
        }
    }
    //~ print_r($cx);

    //TODO PDOHelper by mel byt schopny byt vytvoritelny pres tovarnu jednoduchym zpusobem!! asi podobne jako v nette!!!


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


//~ Container:
//~ addService(name, object)
//~ getService(name)
//~ hasService(name)
//~ //isCreated(name)
//~ createService(name, array args)
//~ //createInstance(class, array args)



//~ app/bootstrap.php:
//~ reqiire autlo loader
//~ $configurator = new Configurator
//~ //$configurator->$setDebugMode(bool)
//~ //$configurator->$configuratorenableDebuger log dir
//~ $configurator->setTempDirectory(file)

//~ //$configurator->createRobotLoader()->addDirectory()...

//~ $configurator->addConfig(neon file)

//~ return $configurator->createContainer() <-- generuje loader do php

//~ index.php
//~ $container = require('app/bootstrap.php');
//~ $container->getService('application')->run();


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
    $i = new classes\IpBan;
    //~ $i->load();

    $i->setOrder(classes\IpRules::DENY_ALLOW)
        ->addBan(new classes\IpRule(classes\IpRules::ALLOW, '127.0.0.1 127.0.0.2'))
        ->addBan(new classes\IpRule(classes\IpRules::DENY));

    $b = new classes\IpRuleBlock(classes\IpRules::FILES, 'admin.php');
    $b->addIp(new classes\IpRule(classes\IpRules::ALLOW, '127.0.0.1'))
        ->addIp(new classes\IpRule(classes\IpRule::DENY));

    $i->addBan($b);

    //~ $i->addBan($i);

    $i->save();

    //~ echo htmlspecialchars();
    echo htmlspecialchars($i->render());

    //~ Js::generate('js/my.js', 'js/out/my.js', array(
        //~ 'weburl' => 'http://www.gfdesign.cz/obr/kod/',
        //~ 'weburl1' => 'http://www.gfdesign.cz/highslide/graphics/',
        //~ ));
*/

    //po zaroutovani se presmeruje a zobrazi konkretni view
    //
    //odkaz == volani funkce?
    //
    //aplikace preklada pres router pozadavky z adresy, aby mohl spustit konkretni presenter a kterou akci s nim chce vykonat
    //kdyz napr odpovi: presenter Product, akce show: tj link Product:show, s parametrem id:123
    //takze to na pozadi vyrobi objekt ProductPresenter ktery bude reprezentovat produkt (tovarna vyrobi presenter: presenterFactory) a pozada o akci show($id)
    //presenter ma za ukol na to vymyslet odpoved (bud presenter nebo jakozot kontroler) odpoved bude primarne html, ale muze to byt obrazek, xml, json a podobne...
    //tedy ProductPresenter pozada o data svuj model aby je mohla sablona vykreslit
    //v presenteru bude vykreslovani konkretni akce obstaravat render: renderShow($id) kde se budou predavat data do templatu
    //presenter pote vykresluje sablonu ze souboru Produck/show.latte nebo Product.show.latte

    // stara se o vytahovani dat z databaze, prace s daty
    // class Model {}  //toto je vrstva! ne jen jedna trida!

    // prebira data (metody) z modelu a z view
    // class Controller {} // (vytvari v sobe model), logika ma k dizpozici vstup od uzivatele, Presenter, <-- vrstva (v nette je to presenter)
    // zpracovava akce z linku

    // class View {} //(pohled/prezentace) <-- vrstva pohledu
    // stara se o template

    //client saha na kontroler
    //klient macka na odkaz.. ten vola metodu (ktera je umistena v prezenteru)
    //
    //komponenty (kazda ve vlastni slozce s latte, model a control)
    //vytvareni helperu (libovolne funkce na templatovac)
    //
    //z view je volany kontroler a z kontroleru je volany model




//TODO sublim3: dotahnout plugin na naseptavani phpunit testu!!!

//TODO doresit debuger tridu na detekovani hostname a podle toho prepinat devel/product version
//TODO doresit PDOHelper aby mel podobne napojovani jako dibi
//TODO dorazit chybejici testy trid!!!
//TODO doprepisovat core!!!!
//TODO tridu na CNB kurzy jednotek, via todo.gf...
//TODO autoinstalaci databaze - detekovani na soubor ktery po smazani provede kompletni instalaci databaze
//TODO z-univerzalnit cachovaci system treba prave pro CNB kurzy!!! ukladani JSON
//TODO error logy / cache / atd / ukladat pod 0777 !!!! a nebo to minimalne prevadet!! kvuli vseovbenemu mazani!!!
//TODO doknedlit uz ten mysql exporter, asi jednodures pres sql-dump s opravou znaku
//TODO tridu nebo metodu na automaticke vytvareni/udrzovani zadane adresarove struktury
//TODO porovnavac souboru jadra a testu! jesti kde chyby testy!
//TOOD roztridit tridy do logickych celku!!!
//TOOD tridu na requesty?!!



/*
svn export nazvu zmenenych slozek pro deploy:
$ svn diff -r 50:56 --summarize
$ svn diff -r 50:56 --summarize --xml
$ svn diff -r 50:HEAD --summarize

asi opravku php integrace
pokud to bude zparacovavat php tak vystpu bude v xml
po tom co stahne sumarize tak ho simple xml projede a za zaklade zname nebo zadane
-- jeste pred vytvarenim je treba zbylodvnay seznam seradit aby vytvareni sozek bylo prvni
pathe zkopiruje zadane soubory a slozky a vytvorit tak vlastne aktualni export rozdilu proti posledni verzi
*/


// var_dump(classes\UserAgentString::isBrowser('Chrome'));
// var_dump(classes\UserAgentString::getOs('Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.16 Safari/537.36'));
// var_dump(classes\UserAgentString::getBrowser('Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0; Media Center PC 4.0; SLCC1; .NET CLR 3.0.04320)'));
// var_dump(classes\UserAgentString::getBrowser('Mozilla/5.0 (Windows NT 6.0; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0'));
// var_dump(classes\UserAgentString::isIExplorer('Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0; Media Center PC 4.0; SLCC1; .NET CLR 3.0.04320)'));



echo '<br /><br /><br /><br />';


//~ $a = array();
//~ echo 'a:'.var_export($a, true);
/*
  class UserAuthenticator implements classes\IAuthenticator {
    private $db = null;

    public function __construct($db) { $this->db = $db; }

    public function authenticate(array $credentials) {
      list($login, $pass) = $credentials;

      $hash = classes\Core::getCleverHash($login, $pass);

      $c = $this->db->rawQuery('SELECT iduzivatel, role.nazev as role FROM uzivatele
                                JOIN role USING(idrole)
                                WHERE login=? AND hash=? AND smazano IS NULL;', array($login, $hash));
      $row = $c->getFirst();
      if ($row) {
        $c->close();  //zavreni cursoru
        $data = array(
            'login' => $login,
            );

        return new classes\Identity(intval($row->iduzivatel), array($row->role), $data);
      } else {
        return null;
      }
    }
  }
*/


//~ $weburl = classes\Core::getUrl();

/*
$auth = new UserAuthenticator($db);

$user = new classes\User('useraa');
$user->setAuthenticator($auth)
    ->setExpiration('2 hours');
*/
//~ $userb = new classes\User('userab');
//~ $userb->setAuthenticator($auth)
    //~ ->setExpiration('2 hours');


//~ $user->login('pokus', 'aa');
//~ $user->logout();
//~ $userb->login('pokus', 'aa');
//~ $userb->login('');
//~ var_dump($user->isLoggedIn(), $user->getId());
//~ var_dump($userb->isLoggedIn(), $userb->getId());


// $exp = new classes\MySQLExporter($handle, $db);
// var_dump($exp);

// var_dump($exp->exportModel('downloads'));
// var_dump($exp->exportTable('downloads'));
//~ file_put_contents('export.json', $exp->export());
//~ var_dump($exp->exportTable('trainz_kuids'));
//~ print_r($exp->importModel(file_get_contents('export.json')));
//~ print_r($exp->import(file_get_contents('export.json'), false));

//~ print_r($exp->import(file_get_contents('export_db_web.json'), true));
//~ print_r($exp->importModel(json_encode(array('a' => array('create_table'), 'c' => 2))));
//~ print_r($exp->importModel('export.json'));
//~ print_r($exp->import('export.json'));
//~ print_r($exp->importModel(json_encode(array('a' => array('create_table'), 'c' => 2))));

//~ var_dump(date('r'));
// Mon, 28 Oct 2013 21:28:05 +0100
// Mon, 28 Oct 2013 19:57:49 +0100



//~ throw new Exception('pokusek...');
//~ echo $aabb;
//~ if ($aa){}

//var_dump(getimagesize('im000447.jpg'), getimagesize('coolislowefullhd.jpg'));


/*
//[]|$|multiple
//~ $t = classes\TplForm::compile('{file:picture|@|image|:|V náhledu musí být vložen obrázek!|,|filled|:|ggg!}{submit:;}');
//~ $t = classes\TplForm::compile('{file:picture[]|$|multiple|@|image|:|V náhledu musí být vložen obrázek!|,|filled|:|ggg!}{submit:;}');
$t = classes\TplForm::compile('{file:picture[]|$|multiple|@|image|:|V náhledu musí být vložen obrázek!}{submit:;}');
//~ $t = classes\TplForm::compile('{text:hu}{file:picture|@|image|:|V náhledu musí být vložen obrázek!}{submit:;}');

echo $t;
// 1128


if ($t->isSuccess()) {
  var_dump($t->getValues());
}

if ($t->isErrors()) {
  var_dump($t->getErrors());
}


*/







//TODO tridu na: mysql export/import, light tpl ->git
//TODO nejake bloky hotovych administracnich bloku pro mesi data pracujici s json nebo sqlite3
//TODO MySQL Backuper!!
//TODO tridu zajistujici blokovani podle IP, a jeste podle pripadnych prohlizecu atd...
//TOOD trida zajistujici wait nebo blok index pres tpl...
//TODO prekopat generator captcha kodu!!!
//TODO "instalacni" respektive jen kontroler jestli je na webu/ nebo pri zacatku webu vse v poradku

//ahoj svete

  //~ $tpl = classes\Tpl::draw('main_section', array('auto_create' => true, 'force_compile' => false));
  //~ $tpl = classes\Tpl::draw('main_angular', array('auto_create' => true, 'force_compile' => true));
  //~ $tpl = classes\Tpl::draw('main_pager', array('auto_create' => true, 'force_compile' => true));
  //~ $tpl->clearAll();




  //~ $input = '{select:sel2;vialue;"{europe: {cs: česky, de: dojčasky}, word: {en: englišsky, uk: ukrajinsky}}"|class:hvii||filled:sdfdfsd}';
  //~ $input = '{select:sel2;vialue;"{europe: {cs: česky, de: dojčasky}, word: {en: englišsky, uk: ukrajinsky}}"}';
  //~ $input = 'sdsadsad{select:sel1;vialue;{cs: česky, en: anglicky, de: německy}}sdsdsdasd<br />sdsadsd sd df s
  //~ sadsad{select:sel1;vialue;{europe: {cs: česky, de: dojčasky}, word: {en: englišsky, uk: ukrajinsky}}}sdsdsdasd<br />';
  //~ $input = '{select:sel1;vialue}<br />';
  //~ preg_match('/{select:(?<name>.*?)(?:;(?<value>.*?))?(?:;"(?<source>.*?)")?(?:\|(?<attr>.*?))?(?:\|\|(?<rules>.*?))?}/', $input, $match);
  //~ preg_match('/({select:.*?})/', $input, $match);
            //~ ///{select:(?<name>.*?)(?:;(?<value>.*?))?(?:;"(?<source>.*?)")?(?:\|(?<attr>.*?))?(?:\|\|(?<rules>.*?))?}/
  //~ var_dump($match);

  //~ $split = '({text:.*?})|({password:.*?})|({checkbox:.*?})|({radio:.*?})|({select:.+})|({file:.*?})|({textarea:.*?})|({submit:.*?})';
  //~ $codeSplit = preg_split("/" . $split . "/", $input, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
  //~ foreach ($codeSplit as $html) {
    //~ if (preg_match('/{select:(?<name>.*?)(?:;(?<value>.*?))?(?:;(?<source>.+))?(?:\|(?<attr>.*?))?(?:\|\|(?<rules>.*?))?}/', $html, $match)) {
      //~ var_dump($match);
    //~ }
  //~ }
  //~ $input = '{checkbox:chck;valuiik;sdfasdf|class:pica;:checked}';
  //~ preg_match('/{checkbox:(?<name>.+?)(?:;(?<value>.*?))?(?:\|(?<attr>.*?))?(?:\|\|(?<rules>.*?))?}/', $input, $match);
  //~ var_dump($match);

  //~ $input = '{text:nazev;valsd dfĐ[ ad| dfsd@sd #dsdsd@sd
   //~ fds ff df&scaron;d dsf
   //~ dfdfdfue|$|attr:value&nbsp;|,|....|@|rules&nbsp;|:|text&nbsp;|:|argv&nbsp;|,|...|,|...}';
  //~ $input = '{text:nazev;value|@|pattern|:|musi vyhovovat vyrazu|:|[a-zA-Z]{5}[0-9]+}';
  //~ preg_match('/{text:(?<name>.+?)(?:;(?<value>.*?))?(?:\|\$\|(?<attr>.*?))?(?:\|\@\|(?<rules>.*))?}/s', $input, $match);
  //~ var_dump($match);

//~ i	for PCRE_CASELESS
//~ m	for PCRE_MULTILINE
//~ s	for PCRE_DOTALL
//~ x	for PCRE_EXTENDED
//~ U	for PCRE_UNGREEDY
//~ X	for PCRE_EXTRA

//~ $input = 'df f df sfd dsf
//~ sdfsdf dsf df  df df{textarea:description;tady je supe
//~ dlouhy nekolika
//~ radkyvy text
//~ na nekolikero
//~ radkovych
//~ radku|placeholder:tu ma byt popis;class:form-control;rows:20;cols:80||filled:popis musi byt vyplneno!}*<br/> df df
//~ sdfdsf ddf dsf ds
//~ fdsf df dfsdf';

  //~ preg_match('/{textarea:(?<name>.+?)(?:;(?<value>.*?))?(?:\|(?<attr>.*?))?(?:\|\|(?<rules>.*?))?}/s', $input, $match);
  //~ var_dump('TEST:', $input, $match, PHP_EOL);
  //~ $split = '({text:.*?})|({password:.*?})|({checkbox:.*?})|({radio:.*?})|({select:.+})|({file:.*?})|({textarea:.*?})|({submit:.*?})';
  //~ $codeSplit = preg_split("/" . $split . "/s", $input, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
  //~ var_dump($codeSplit);

  //~ $input = '  {select:sel21[];{výběr položky, europe: {cs: česky, de: dojčasky}, word: {en: englišsky, uk: ukrajinsky}}|:multiple;size:10|filled:musi byt &nbsp;&quot; cosika jak}<br />df sdf fdsf';
  //~ $input = '    {select:sel11;{vejběr, cs: česky, en: anglicky, de: německy}}<br /><br />df sdf fdsf';
  //~ preg_match('/{select:(?<name>.+?)(?:;(?<value>.*?\}?\}))?(?:\|(?<attr>.*?))?(?:\|\|(?<rules>.*?))?(?:\|\|\|(?<source>.*?))?}/s', $input, $match);
  //~ var_dump('TEST:', $match, PHP_EOL);
//~ exit;

try {

  //~ $input = 'sadsd{select:sel11||||||{vejběr, cs: česky, en: anglicky, de: německy}}<br />';
  //~ preg_match('/{select:(?<name>.+?)(?:;(?<value>.*?))?(?:\|(?<attr>.*?))?(?:\|\|(?<rules>.*?))?(?:\|\|\|(?<source>.*))?}/', $input, $match);
  //~ //          /{select:(?<name>.+?)(?:;(?<value>.*?))?(?:\|(?<attr>.*?))?(?:\|\|(?<rules>.*?))?(?:\|\|\|(?<source>.*))?}/
  //~ preg_match('/({select:.+})/', $input, $match);
  //~ var_dump($match);

  //~ preg_match('/{select:(?<name>.+?)(?:;(?<value>.*?))?(?:\|(?<attr>.*?))?(?:\|\|(?<rules>.*?))?(?:\|\|\|(?<source>.*))?}/', $input, $match);
  //~ preg_match('({text:.+?})', '{text:ahoj|@|pattern|:|....|:|[\-0-9]\{3,\}\:[0-9]\{2,\}\:[0-9]+}', $match);
  //~ var_dump($match);

  //~ preg_match('/{text:(?<name>.+?)(?:;(?<value>.*?))?(?:\|\$\|(?<attr>.*?))?(?:\|\@\|(?<rules>.*?))?(\})!}/s', '{text:ahoj|@|pattern|:|....|:|[\-0-9]\{3,\}\:[0-9]\{2,\}\:[0-9]+|:|filled|:|upsi}', $match);
  //~ var_dump($match);
  //var_dump(preg_match('/{text:(?<name>.+?)(?:;(?<value>.*?))?(?:\|\$\|(?<attr>.*?))?(?:\|\@\|(?<rules>.*?))?(?<!\\\)}/s', $string, $match), $match);

/*
 (?=) - Positive look ahead assertion foo(?=bar) matches foo when followed by bar
 (?!) - Negative look ahead assertion foo(?!bar) matches foo when not followed by bar
 (?<=) - Positive look behind assertion (?<=foo)bar matches bar when preceded by foo
 (?<!) - Negative look behind assertion (?<!foo)bar matches bar when not preceded by foo
 (?>) - Once-only subpatterns (?>\d+)bar Performance enhancing when bar not present
 (?(x)) - Conditional subpatterns
 (?(3)foo|fu)bar - Matches foo if 3rd subpattern has matched, fu if not
 (?#) - Comment (?# Pattern does x y or z)
*/

  //text: '/{text:(?<name>.+?)(?:;(?<value>.*?))?(?:\|\$\|(?<attr>.*?))?(?:\|\@\|(?<rules>.*?))?}/s'

  //~ $string = 'ds sd sd sd{text:ahoj|@|pattern|:|....|:|[\-0-9]\{3,\}\:[0-9]\{2,\}\:[0-9]\{5\}|,|filled|:|upsi} s dsdsad';
  //~ var_dump(preg_match('/{text:(?<name>.+?)(?:;(?<value>.*?))?(?:\|\$\|(?<attr>.*?))?(?:\|\@\|(?<rules>.*?))?(?<!\\\)}/s', $string, $match), $match);


  //~ $string = 'ds sd sd sd {text:kuid|$|maxlength|:|30|,|class|:|switch_kuid|@|filled|:|Musí být vyplněno|,|pattern|:|musí vyhovovat KUID2 formátu: xxxx:yyyy|:|[\-0-9]+\:[0-9]+\:[0-9]\{1,\}} s dsdsad';
  //~ var_dump(preg_match('/{text:(?<name>.+?)(?:;(?<value>.*?))?(?:\|\$\|(?<attr>.*?))?(?:\|\@\|(?<rules>.*?))?(?<!\\\)}/s', $string, $match), $match);

  //~ $string = 'kuid{text:kuid|$|maxlength|:|30|,|class|:|kuid|@|filled|:|Musí být vyplněno|,|pattern|:|musí vyhovovat KUID formátu: xxxx:yyyy nebo xxxx:yyyy:zz pro kuid2|:|[\-0-9]+\:[0-9]+(\:[0-9]\{1,\})?}';
  //~ var_dump(preg_match('/{text:(?<name>.+?)(?:;(?<value>.*?))?(?:\|\$\|(?<attr>.*?))?(?:\|\@\|(?<rules>.*?))?(?<!\\\)}/s', $string, $match), $match);

  $tpl = classes\Tpl::draw('main_pokus', array('auto_create' => true, 'force_compile' => true));

  $pole = array(
      'core' => 'classes\Core',
      //~ 'form' => 'classes\Form',
      'debugger' => 'classes\Debugger',
      //~ 'user' => $user,
      'weburl' => $weburl,
      'uri' => $router,
      // 'db' => $db,
      'content' => 'classes\ContentValues',
      //~ 'form' => $builder->getForm(),  //vlozeni specialniho formulare z buideru
      'tplform' => 'classes\TplForm',
      'paginator_class' => 'classes\Paginator',
      //~ 'form' => $form,
      //~ 'section_builder' => $builder->render(),
//~ 'varr' => 'hovno',
//~ 'prenos' => null,
      'section' => 'classes\Section',
  );
//~ var_dump(base64_encode("fucking noob!"), md5('run'.md5('n').'able'));
//~ var_dump(ord('n'));
  //TODO admin index tpl vytvaret asi pres tridu a ten obsah se ak bude modifikovat

  $tpl->assign($pole);
  //$tpl->assign($admin->toArray());

  echo $tpl->render();
//~ var_dump(!@unlink('cosik'));
//~ var_dump(@!unlink('cosik'));
//~ var_dump(!unlink('cosik'));

} catch (Exception $e) {
  die($e);
}
//~ exit(0);


//******************************************************************************
