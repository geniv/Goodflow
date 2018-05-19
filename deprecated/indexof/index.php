<?php
/*
 *      index.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  //load autoload
  require 'loader.php';

  use classes\Core,
      classes\Html,
      classes\HtmlPage,
      classes\Form,
      classes\Sql,
      classes\SqlConnector,
      classes\Email;

/* IP ban:
 * 119.255.59.106
 * 151.31.59.39
 * 65.255.42.40
 * 31.44.184.50
 * 89.172.234.232
 * 134.173.204.132
 * 80.250.8.205
 * 88.101.241.123
 * 79.131.123.164
 * 90.179.137.29
 * 203.123.159.178
 * 92.114.134.8
 * 89.176.39.173
 * 83.27.67.118
 * 182.185.243.10
 * 196.205.239.15
 * 98.150.45.145
 * 74.86.67.66
 * 85.132.159.230
 * 109.253.71.158
 * 95.169.240.85
 * 151.31.59.39
 * 180.222.178.73
 * 62.87.154.40
 * 24.226.194.156
 *
 **/

 //FIXME OMG!!!!!!!!!!!!!

  const GET_ACTIVATE = 'activate';

  const SESSION = 'sess';
  const SESS_ACCESS = 'access';
  const SESS_ID = 'id';

  const LOC_EMAIL = Email::LOCATION_LOCAL;  //LOCATION_LOCAL|LOCATION_WEB
  const BCC_EMAIL = 'geniv@geniv-asus';
  const FROM_EMAIL = 'indexof@gfdesign.cz';

  const LONG_VALIDATE = '+5 day';

  class StateUser {
    const NOTAUTORIZED = 0; //prvni prihaseni nepo po vyplreni platnosti
    const EMAILSEND = 1;  //email zaslan na zadanou adresu
    const ACTIVATED = 2;  //aktivovano, pokud potvrdi z emailu
    //const DEACTIVATED = 3;  //deaktivovano vyssim opravnenim, zbytecny
  }

  //vnitrni funkce
  function makePass($pass) {
    return Core::makeHash('md5+sha256+md5', $pass);
  }

  function initSql() {
    $c = new SqlConnector(SqlConnector::SQLite3, array('path' => __DIR__.'/.db'));
    $s = array('ipban' => array('ip' => Sql::VARCHAR(50).Sql::UNIQUE, //unikatni IP
                                'create_date' => Sql::DATETIME,
                                'edit_date' => Sql::DATETIME,
                                'active' => Sql::BOOLEAN,
                                //TODO polozku ktera bude vyrazovat aktualni IP z bloku pokud je uzivatel prihlaseny
                                'comment' => Sql::VARCHAR(100)),
//TODO kde kurva registrovat nove uzivatele??

//FIXME polozku logged vyhodit z DB!!!
              'user' => array('login' => Sql::VARCHAR(50).Sql::UNIQUE,  //unikatni login
                              'pass' => Sql::VARCHAR(100),  //hash hesla
                              'logged' => Sql::BOOLEAN, //priznak prihlaseni, kazdy uzivatel muze byt prihlasem jen 1x!!!
                              'state' => Sql::INTEGER, //cislo stavu polozky
                              'email' => Sql::VARCHAR(100), //na ktery se bude posilat vyzva k potrvrzebi pristupu
                              'permission' => Sql::INTEGER, //id opravneni
                              'session' => Sql::VARCHAR(50),  //ID prihlasene session (prijate autorizace)
                              'validate' => Sql::DATETIME, //datum do kdy validace plati
                              'create_date' => Sql::DATETIME, //datum vytvoreni
                              'edit_date' => Sql::DATETIME, //datum editace
                              'last_login' => Sql::DATETIME,  //datum a cas posledniho prihlaseni
                              'last_agent' => Sql::VARCHAR(300),  //posledni user agent
                              'last_ip' => Sql::VARCHAR(50),  //posledni ip adresa
                              'active' => Sql::BOOLEAN),

              'permission' => array('name' => Sql::VARCHAR(50).Sql::UNIQUE, //unikatni nazev opravneni
                                    'permits' => Sql::TEXT, //TODO taky dopsat povolovani a zakazovani jednotlivych urovni (nejak modifikovatelne)
                                    'create_date' => Sql::DATETIME, //datum vytvoreni
                                    'edit_date' => Sql::DATETIME, //datum editace
                                    'active' => Sql::BOOLEAN,
                                    'comment' => Sql::VARCHAR(100)),
              );
    $c->setStructure($s);

    $c->addRow('permission', array('name' => 'Počáteční admin profil'));
    $c->addRow('user', array('login' => 'admin', 'pass' => makePass('adminheslo'), 'state' => StateUser::NOTAUTORIZED, 'email' => 'geniv.radek@gmail.com', 'permission' => 1, 'logged' => false, 'create_date' => 'now', 'active' => true));

    return $c;
  }

  if (Core::checkPHP()) {
    //php redy
    $weburl = Core::getUrl();
    $content = NULL;
    $c = initSql();


//FIXME +podpora na IP ban!
//TODO udelat databazi na prihalsovani! - prpadne to zabalit do tridy! (hodi se to!)

//var_dump($_SERVER['REMOTE_ADDR'], $_SERVER['REQUEST_TIME'], $_SERVER['HTTP_USER_AGENT']);
//TODO domyslet pri jakych podminkach blokovat IP
//Sql::varchar(), sql::boolean

    //TODO pridat sem instalaci vychoziho uzivatele! s vychozim opravnenim...!

//TODO administrace: IP, uzivatelu<--(N:1)-->skupin uzivatelu
//(kazdy uzivatel muze mit jen jedno opravneni!!!!)


    /*
    $c->addRow('ipban', array('ip' => '119.255.59.106', 'create_date' => 'now', 'active' => true));
    $c->addRow('ipban', array('ip' => '151.31.59.39', 'create_date' => 'now', 'active' => true));
    $c->addRow('ipban', array('ip' => '65.255.42.40', 'create_date' => 'now', 'active' => true));

    //var_dump($c->getLastInsertID());
    //var_dump($c->editRow('ipban', 1, array('ip' => '151.31.59.37', 'active' => false, 'edit_date' => 'now')));
    $c->editRow('ipban', 2, array('edit_date' => 'now'));
    //$c->editRow('ipban', 15, array('ip' => '151.31.59.3212', 'edit_date' => 'now'));
    //var_dump($c->delRow('ipban', 2));
    //var_dump($c->loadRow('ipban', 2, 'rowid, ip, edit_date'));

    $p = NULL;
    $sql = new Sql;
    $sql->column('ip')->column('create_date')->column('edit_date')->table('ipban')->where('active=?', 1)->order('create_date')->asc()->limit(0, 2);
    //$sql->column('rowid as id')->column('ip')->column('create_date')->table('ipban')->order('create_date')->asc()->limit(0, 3);
    //$sql->column('rowid as id')->column('ip')->column('create_date')->table('ipban')->order('create_date')->asc()->where('active=0')->limit(0, 1);
    $p = $c->setIterator($sql, array('result_count' => true,));
    var_dump($p);
    foreach ($c as $v) {  //$k =>
      var_dump($v);
    }
*/

    //~ $sql = new Sql;
    //~ $sql->column('login')->table('user')->order('login')->desc();
    //~ $c->setIterator($sql);
    //~ var_dump(count($c));
    //$c->pokus();
//select rowid, ip, create_date, edit_date from ipban
//var_dump($c::getAvailableDrivers());


    Core::initSession();
    //$sess = Core::getSession(SESSION);
//Core::setRenewSessionId();
    $session = Core::getSessionId();
//var_dump($sess, $sess[SESS_ID]);
    //$logged = false;
//var_dump($session, $sess, $_SESSION);
//var_dump(empty($sess) && !$sess[SESS_ACCESS] && $sess[SESS_ID] == $session);

    $sess = NULL;

    //if (empty($sess)) {
      //prihlasanovani uzivatele, nesmi byt predesli prihlaseny
    $rs = $c->loadRow('user', array('session=? AND state=? AND validate>=? AND last_agent=? AND active=1', $session, StateUser::ACTIVATED, date('Y-m-d H:i:s'), $_SERVER['HTTP_USER_AGENT']), 'rowid'); ///AND logged=0
    if ($rs && $rs->rowid > 0) {
      //if ($rs->last_agent == $_SERVER['HTTP_USER_AGENT']) {
        //Core::setSession(SESSION, array(SESS_ACCESS => $rs->rowid, SESS_ID => $session)); //ulozeni id uzivatele a session prohlizece
      //}
      $sess = $rs->rowid;

      //$logged = true;
//TODO zajistit taby se furt nesahalo do DB ale jen kdyz je to opravdu potreba!!!!
      //var_dump($rs);
    }
    //}
//var_dump($rs);

$sess = $session; //FIXME hnusne obejiti autorizace!

    //nesmi byt prazdne id, a ulozene session musi byt stejne jako aktualni
    if (empty($sess)) {
//FIXME poresit podhazovani session, auto odhlasovani, potrebne prihlasavani...atd...

      // else {
        //FIXME osetrit vicenasobne prihlaseni!!!!
        //echo 'že by to tak dal nešlo? nebo vypršelo sezeni';
      //}
//var_dump($logged);
      //TODO odhlasovani uzivatele!

      //aktivace uctu
      $activate = Core::isFill($_GET, GET_ACTIVATE);
      if (!empty($activate)) {
        $rs = $c->loadRow('user', array('session=? AND active=1', $activate), 'rowid, state, email');
        if ($rs && $rs->state == StateUser::EMAILSEND) {
          $ma = new Email(LOC_EMAIL);
          $ma->to($rs->email)->subject('dokončení autorizace na indexof')
              ->from(FROM_EMAIL)
              ->bcc(BCC_EMAIL)
              ->message('gratuluji, tvuj počadavek byl registrován a potvrzen... už by ses mohl jakože normálně přihlásit.. ;) GL');

          if ($ma->send()) {
            //zmena stavu na aktivovano
            $c->editRow('user', $rs->rowid, array('session' => NULL, 'state' => StateUser::ACTIVATED));
            echo 'účet byl úspěšně aktivován... enjoy it!';
          } else {
            echo 'odeslání infa se zřejmě nepovedlo.. :(';
          }
        }
      }

//FIXME dodelat autoredirecty!!!!

      //login
      $f = new Form;
      $f->addText('login', array('label' => 'Cťený login'))
        ->addPassword('pass', array('label' => 'Cťené heslo'))
        ->addSubmit('tlc', array('value' => 'Zmačknutelné'));

      $content = $f;

      if ($f->isSubmitted()) {
        $values = $f->getValues();
        //nekolikanásobne overeni + overeni na email...

        $rs = $c->loadRow('user', array('login=? AND pass=? AND active=1', $values['login'], makePass($values['pass'])), 'rowid, state, email, last_agent, *');
        if ($rs) {
          //FIXME overovat pokud je prihlasen (pokud neni session a je DB)
          switch ($rs->state) {
            case StateUser::NOTAUTORIZED:
              $uniqtext = Core::getUniqText();
              $ma = new Email(LOC_EMAIL);
              $ma->to($rs->email)->subject('potrvzení autorizace na indexof')
                  ->from(FROM_EMAIL)
                  ->bcc(BCC_EMAIL)
                  ->message('gratuluji, získal si nějakou haluzí přístup na tyto ůžasné stránky,
                            pokud nechceš zpřerážet hnáty mnou osobně nebudeš zneužívat soubory tu dostupné jinak budeš mít problém se mnou :)
                            ..někde tu by měl být i link na samotné potvrzení...
                            <a href=\'%s\'>potvrzovací link</a>
                            ', Core::makeUrl(Core::getAbsoluteUrl(), array('query' => array(GET_ACTIVATE => $uniqtext))));
//TEST otestovat link!! na potvrzeni!
//FIXME zapracovat urcitou dobu platnosti

              if ($ma->send()) {
                echo 'odeslání se povedlo..., čekej v nejbližším okamžiku email...';
                //zapis autorizacniho textu docasne do session a zmena stavu
                $c->editRow('user', $rs->rowid, array('session' => $uniqtext, 'state' => StateUser::EMAILSEND));
              } else {
                echo 'odeslání se zřejmě nepovedlo.. :(';
              }
            break;

            case StateUser::EMAILSEND:
              echo 'jeste nebyli dokonceny vsechny autorizacni kroky..';
            break;

            case StateUser::ACTIVATED:
              echo 'ucet je aktivní... probíhá přihlašování...';
//var_dump($rs->last_agent, $_SERVER['HTTP_USER_AGENT']);
//var_dump($rs);
var_dump($session == $rs->session);
//FIXME nebude se prepisovat jeden ucet!!,
//ale budou se pridavat padky ne nejake navazujici tabulky ktera bude hlidat prihlasene session?!!!
//NEBO proste jen udelat tak ze se bude overovat sloupec logged a pokud jiz bude instance prihlasena
//tak se nepusti prihlasit, jenze pak se naskyta otazka na to co se stane kdyz bude session jiny a priznak bude na logged=true
//musi se pocitat s tim ze prichazeji nove verze prohlizecu a agenti se taky meni...

//NE!! bude to jen proste tak ze se prihlasi pod danym session, kdyz se nekdo prihlasi pod jinym tak se to v DB prepise a prihlaseni dostane samy ucet na jinym PC
//TODO ale jak pak rozlisit ze se jedna o toho sameho cloveka a ne nejakeho blbecka o se naboural do systemu...?!
//→ pak ale vznika riziko podstrceni session

              $c->editRow('user', $rs->rowid, array('session' => $session, 'validate' => LONG_VALIDATE, 'last_login' => $_SERVER['REQUEST_TIME'], 'last_agent' => $_SERVER['HTTP_USER_AGENT'], 'last_ip' => $_SERVER['REMOTE_ADDR']));  //'now', 'logged' => true,
            break;

            /*
            case StateUser::DEACTIVATED:
              echo 'ucet byl deaktivovan asi z nejakeho duvodu';
            break;
            */
          }

        } else {
          var_dump('neuspesny pokus');
        }

        //~ if ($values['login'] == 'pokus' && $values['pass'] == 'aa') {
          //~ //var_dump('pššššt... muzes se prihlasit!');
          //~ var_dump($_SERVER['HTTP_USER_AGENT'], Core::getSessionId());
          //~ var_dump($_SERVER['REMOTE_ADDR'], $_SERVER['REQUEST_TIME']);
        //~ }
//TODO pokud se nepodari autorizovat na 3 pokus tak problehne bloknuti IP
      }

    } else {
//var_dump($sess[SESS_ACCESS], $sess[SESS_ID], $session, $sess[SESS_ID] == $session);
      //if ($sess[SESS_ACCESS] && $sess[SESS_ID] == $session) {
//$_SESSION[SESSION][SESS_ACCESS]
        echo 'přihlášen: id='.$sess.', tu by měl být i link na odhlášení...';

  //TODO drobeckova navigace???
        $host = sprintf('http://%s', $_SERVER['HTTP_HOST']);
        $uri = Core::isFill($_SERVER, 'REQUEST_URI');
  //var_dump($uri, );
        $path = '/var/www'.$uri;  //TODO do konfigu!!
        $default_index = 'index.php';

        $parse_full = parse_url($path);
        $quickredirect = $parse_full['path'].$default_index; //TODO vice moznosti!!!!!!?!

        $quickredirect_vyjimka = (substr($parse_full['path'], -2) == '//');
  //pokud existuje cesta, a konec nekonci s //
        if (file_exists($quickredirect) && !$quickredirect_vyjimka) {
          $parse = parse_url($uri);
          header(sprintf('Location: %s%s%s', $parse['path'], $default_index, (!empty($parse['query']) ? '?'.$parse['query'] : '')));
        }
  //FIXME kontrolovat dobre .. a udalat aby tam byli absolutni cesty!
  //var_dump(is_dir($path));
        if (file_exists($path) && is_dir($path)) {
          $dirs = Core::getListDir(array('path' => $path, 'sort' => array(Core::LIST_SORT_STR, Core::LIST_SORT_ASC)));
          $files = Core::getListFile(array('path' => $path, 'sort' => array(Core::LIST_SORT_STR, Core::LIST_SORT_ASC)));
          $items = array_merge($dirs, $files);

    //TODO upgradovat na config!!!!!
          $icondir = 'pripony/';
          $absolutepath = __DIR__.'/'.$icondir;
          $webpath = $weburl.$icondir;
          $execsuffix = array('php', 'html', 'txt');
          //TODO opensuffix ???

          $row = array();
          $updir = dirname($uri);
          if ($uri != $updir) {
            $row[] = Html::a()->href($updir)->setText('..');
          }

          foreach ($items as $item) { //slozky
            $pathfile = $path.$item;
            $type = filetype($pathfile);
            switch ($type) {
              case 'dir': //adresar
                $count = 0;
                if (is_readable($pathfile)) {
                  $count = Core::getCountListItems(array('path' => $pathfile));
                }

                $itm = Html::a()->href($host.$uri.$item)->setText($item)->title($count)
                            ->insert(Html::img()->src($webpath.($count == 0 ? 'dir_empty.png' : 'dir_full.png'))->alt($count));

                if (!is_readable($pathfile)) {
                  $itm->setText('*nedostatecne prava!*');
                }

                $row[] = $itm;
              break;

              case 'file':  //soubor
              case 'link':  //odkaz na soubor
                $suffix = pathinfo($pathfile, PATHINFO_EXTENSION);

                $size = Core::calculateSize(filesize($pathfile));
                $mtime = date('d.m.Y H:i:s', filemtime($pathfile));

                $itm = Html::span();
                if (in_array($suffix, $execsuffix)) {
                  $itm->insert(Html::a()->href('http://'.$_SERVER['HTTP_HOST'].$uri.$item)->setText($item));
                } else {
                  $itm->setText($item);
                }

                if ($type == 'link') {
                  $itm->setText('*Link*');
                }
                $itm->setText($size)->setText($mtime);

                if (file_exists($absolutepath.$suffix.'.png')) {
                  $itm->insert(Html::img()->src($webpath.$suffix.'.png')->alt(''));
                }
                $row[] = $itm;
              break;

              default:  //ostatni
              break;
            }
          }

          $content = Html::div()
                          ->insert($row);

        }
      //~ } else {
        //~ echo 'vyprselo prihlaseni';
        //~ Core::clearSession(SESSION);
      //~ }
    }

    $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
    $page->setLanguage('cs')
        ->setUrlPage($weburl)
        //->setCache()
        ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
        ->addMeta('copyright', 'Created by GoodFlow design')
        ->addMeta('robots', 'noindex, nofollow')
        ->setTitle('Super index of vypis')
        ->addBody($content);

//FIXME a ted to prihlasovani!!!!

    echo $page;


  }

?>
