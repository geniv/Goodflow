<?php
/*
 * index.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  require 'loader.php'; // load autoload
  //Loader::setDebug(true);

  use classes\Core,
      classes\Html,
      classes\Debugger;

//TODO oddelit zvlast do souboru!
    class DBHandler extends classes\PDOOpenHelper {

      // roles
      const TABLE_ROLES = 'roles';
      const TABLE_ROLES_idrole = 'idrole';
      const TABLE_ROLES_nazev = 'nazev';

      // users
      const TABLE_USERS = 'users';
      const TABLE_USERS_idusers = 'idusers';
      const TABLE_USERS_login = 'login';
      const TABLE_USERS_hash = 'hash';
      const TABLE_USERS_description = 'description';
      const TABLE_USERS_avatar = 'avatar';
      const TABLE_USERS_idrole = 'idrole';
      const TABLE_USERS_add = 'add';
      const TABLE_USERS_edit = 'edit';
      const TABLE_USERS_deleted = 'deleted';

      public function __construct($name) {
        parent::__construct($name);
      }

      public function onCreate(classes\PDODatabase $db) {
        if ($db->getDriverName() == 'mysql') {
          $sql = 'INSERT INTO roles (idrole, nazev) VALUES (1, \'guest\');
                  INSERT INTO roles (idrole, nazev) VALUES (2, \'moderator\');
                  INSERT INTO roles (idrole, nazev) VALUES (3, \'administrator\');';
          $db->execSQL($sql);

          $pass = User::getCleverHash('admin', 'defaultadmin');
          $sql = 'INSERT INTO users (login, hash, idrole, pridano) VALUES (\'admin\', \''.$pass.'\', 3, NOW())';
          $db->execSQL($sql);

          //~ $sql = '';
          //~ $db->execSQL($sql);

          //~ $sql = '';
          //~ $db->execSQL($sql);
        }
      }
    }


//TODO oddelit zvlast do souboru!
    class DBAuthenticator implements classes\IAuthenticator {
      private $db = null;

      public function __construct($db) {
        $this->db = $db;
      }

      public function authenticate(array $credentials) {
        list($login, $pass) = $credentials;

        $hash = classes\User::getCleverHash($login, $pass);

        $c = $this->db->rawQuery('SELECT iduser, nazev as role, avatar FROM users
                                  JOIN roles USING(idrole)
                                  WHERE login=? AND hash=?;', array($login, $hash));

        if ($c->hasNext()) {
          $data = array(
                        'login' => $login,
                        'avatar' => $c->getString('avatar')
                        );

          $idUser = $c->getInt('iduser');
          $role = $c->getString('role');
          $c->close();  //zavreni cursoru
          return new classes\Identity($c->getInt('iduser'), array($role), $data);
        } else {
          return null;
        }
      }
    }



  try {

    if (Core::checkPHP()) {
      Debugger::startTime();

      $html = 'classes\Html';
      $form = 'classes\Form';

      // data prochazejici celym kodem
      $maindata = array(
                        'html' => $html,
                        'form' => $form,
                        'core' => 'classes\Core',
                        );

      $mainClass = new MainClass($maindata);

      // nacitani konfigurace
      $configure = classes\Configurator::decode('global_config.php');
      $db_conf = classes\Configurator::decode('database_config.php');
      //~ var_dump($configure);
      $mainClass['configure'] = $configure;

      // nastaveni time zony
      classes\DateAndTime::setDateTimezone($configure['date_timezone']);

      //obsluha databaze
      $handle = new DBHandler($db_conf['name']);
      $handle->MySQL($db_conf['mysql']);
      //pripojeni k databazi
      $db = $handle->getDatabase($db_conf['autoinstall']);
      $mainClass['db'] = $db;

      // vytvoreni session, userstorage, uzivatel
      $sess = new classes\Session();
      $sess->setExpiration($configure['session']['expire']);
      $storage = new classes\UserStorage($sess);
      $user = new classes\User($storage);
      $user->setAuthenticator(new DBAuthenticator($db));

      $mainClass['user'] = $user;


      // inicializace cache
      $cache = new classes\Cache;
      $cache->setCache($configure['cache']['enabled'])
            ->setCacheExpire($configure['cache']['expire'])
            ->setExceptionUri(array('admin'));

      // pri instlaci systemu
      if ($configure['system']['install']) {
        $cache->clearAllCache();
      }

      if ($cache->isCached()) {
        echo $cache->getOutBuff();  //vypsani z cache
      } else {
        $cache->initOutBuff();

        // adresa webu
        $weburl = Core::getUrl();

        $mainClass['weburl'] = $weburl;

        // vytvoreni template
        $tpl = new classes\Tpl(array('debug' => $configure['system']['debug']));
        $mainClass['tpl'] = $tpl;

        // pri instlaci systemu po vyprazdneni cache
        if ($configure['system']['install']) {
          $tpl::setConfigure('auto_gen_dir', true);
          $tpl->installDirs()->clearAll();
        }

        // definice modelu menu
        $menuskel = array(
          'menu' => function($row) {
            $result = Html::li()->add(
                                      Html::a()->hrefrewrite('', array('action' => $row['url']))
                                                    ->setText($row['name'])
                                                    ->id($row['active'] ? 'aktivni' : null)
                                      );
            return $result;
          }
        );

        // vytvoreni instance static webu
        $sweb = new classes\StaticWeb(array('action/sekce'));
        $sweb->setLoadMenu($configure['main_index']['pages']);

        //~ $uri = $sweb->getUri();
        //~ var_dump($sweb->getUri());

        // zapnuti zalamovani kodu
        $html::setBreakDepth(true);

        // zakladani definici vyhledavaciho formulare
        $searchform = new $form;
        $searchform->addSearch('global-search', array('size' => 16, 'placeholder' => 'Hledat'))
                    ->addSubmit('global-search-submit', array('class' => 'button', 'value' => 'Vyhledat'));

        $pocetClanku = '????';  //TODO nejaky sql

        // predani promennych do template
        $assign = array(
                        'index_searchform' => $searchform,
                        'index_menu' => $sweb->getMenu($menuskel),
                        'index_content' => $sweb->getContent($mainClass),
                        'index_pocetClanku' => $pocetClanku,
                        );
        $tpl->assign($mainClass->toArray())->assign($assign);  //assign dat

        // vytvoreni zakladni html stranky
        $page = new classes\HtmlPage;
        $page->setTitle('GMR - '.$sweb->getTitle())
            ->setUrl($weburl)
            ->addMetaTag('author', 'GMR Team')
            ->addMetaTag('copyright', 'Created by GMR Team')
            ->addMetaTag('keywords', 'GMR, GMR ceska minecraft wiki')
            ->addMetaTag('description', 'GMR Ceska minecraft wiki')
            ->addMetaTag('robots', 'noindex, nofollow')
            ->addExternalCSS('css/style_global.css')
            //~ ->addBody($body)
            ->setBodyHtml($tpl->template('main_index')->render())
            //->setGoogleAnalytics('UA-17828373-1')
            ;

        echo $page;

        $cache->setOutBuff();
      }

      $handle->close(); //zavreni databaze

      if ($configure['system']['debug']) {
        echo $cache->getCacheInfo();
        echo Debugger::viewTimes();
      }

    } else {
      throw new Exception('php neni v poradku');
    }

  } catch (Exception $e) {
    die($e);
  }