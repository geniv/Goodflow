<?php
/*
 * mainclass.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 * hlavni trida ktera bude agregovat nejpouzivanejsi atributy a metody
 */

  final class MainClass extends classes\BaseMainClass {
    const VERSION = 1.64;

    // globalni pole konstant roli
    public static function getConstRoles() {
      return array(
                    'registred' => 'registrovaný',  // registrovany 1.uroven
                    'moderator' => 'moderator webu',  // registrovany + objednavka, jen hosting
                    'manager' => 'spravce her', // registrovany + objednavka, jen servery
                    'moderator_manager' => 'moderátor + správce', // registrovany + objednavka, hosting + servery
                  );
    }

    // globalni pole konstant zdroju
    public static function getConstResource() {
      return array(
                    'moderate_web' => 'moderatovani webu',
                    'manage_game' => 'spravce her',
                    'moderate_manage' => 'moderator a spravce',
                  );
    }

    // incializace promennych na web
    public function initialization($path = '') {
      // nacitani hlavni konfigurace
      $this['configure'] = classes\Configurator::decode($path.'global_config.php');
      // nacteni konfigurace databaze
      $db_conf = classes\Configurator::decode($path.'database_config.php');

      // nastaveni time zony
      classes\DateAndTime::setDateTimezone($this->configure['date_timezone']);

      // obsluha databaze
      $handle = new DBHandler($db_conf['name']);
      $_driver = $db_conf['driver'];  //nacteni driveru, pak jeho volani a predani konfigurace pole
      $handle->$_driver($db_conf[$_driver]);  // univerzalni konektor databaze
      //pripojeni k databazi
      $db = $handle->getDatabase($db_conf['autoinstall']);
      $this['handle'] = $handle;
      $this['db'] = $db;

      // vytvoreni session, userstorage, uzivatel
      $sess = new classes\Session();
      $sess->setExpiration($this->configure['session']['expire']);

      // user storage
      $user_storage = new classes\UserStorage($sess);
      $user_storage->setNamespace('user');
      // user
      $user = new classes\User($user_storage);
      $user->setAuthenticator(new UzivatelAuthenticator($db));
      $this['user'] = $user;


//FIXME overovovat ACL pouze pokud je uzivatel prihlaseny!!!! kvule uspore vykonu!
      // acl
      $acl = new classes\Permission;
      $user->setAuthorizator($acl); // predani ACL do uzivatelu
      $this['acl'] = $acl;
      $roles = self::getConstRoles(); // nacteni (globalnich) roli
      $this['roles'] = $roles;
      $resources = self::getConstResource();  // nacteni (globalnich) zdroju
      $this['resources'] = $resources;
      $acl->addRole($roles['registred'])
          ->addRole($roles['moderator'], $roles['registred']) //moderator
          ->addRole($roles['manager'], $roles['registred']) //spravce
          ->addRole($roles['moderator_manager'], array($roles['moderator'], $roles['manager'])) //moderator + spravce
          //TODO dalsi zdroje dle potreby webu
          ->addResource($resources['moderate_web'])
          ->addResource($resources['manage_game'])
          ->addResource($resources['moderate_manage'], array($resources['moderate_web'], $resources['manage_game']))
          //~ ->allow($roles['registred'])
          ->allow($roles['moderator'], $resources['moderate_web'])
          ->allow($roles['manager'], $resources['manage_game'])
          ->allow($roles['moderator_manager'], $resources['moderate_manage']);
//TODO dodelat a promyslet dalsi opravneni & zdroje!!!


      // spravce storage
      $spravce_storage = new classes\UserStorage($sess);
      $spravce_storage->setNamespace('spravce');
      // spravce
      $spravce = new classes\User($spravce_storage);
      $spravce->setAuthenticator(new SpravceAuthenticator($db));
      $this['spravce'] = $spravce;


      // nacteni url adresy
      $this['weburl'] = classes\Core::getUrl();


      // vytvoreni instance template
      $this['tpl'] = new classes\Tpl(array('debug' => $this->configure['system']['debug']));


      // globalni formular
      if (isset($this['form'])) {
        $frm = $this['form'];
        $p = array(
                    $frm::CALLBACK_LABEL => function($r) {
                      $submit = ($r['type'] == 'addSubmit');
                      $select = ($r['type'] == 'addSelect');

                      return $r['html']::label()->add($r['label'] ? $r['html']::p()->setText($r['label']) : null)
                                                ->add($r['element'])
                                                ->add($select ? $r['html']::span()->class('select-arrow') : null);
                    },
                    $frm::CALLBACK_BACKLINK => function($row) {
                      return $row['html']::a()->href($row['href'])->title($row['text'])->setText($row['text']);
                    }
                  );
        $glob_form = new $frm($p);
        $this['form_global'] = $glob_form;
      }

//TODO objednavky, datacentrum(natvrdo)
//R1: CRON!!!
//R2: objednavky=> datacentrum, objednavka_hry, stav_objednavky, nabidka_her, doba_pronajmu
//R3: firma, jednorazova_sleva, balicek, balicek_nabidka_her
    }

    // uklizeni po instanci
    public function __destruct() {
      $this['handle']->close(); //zavreni databaze
    }

    /**************************************************************************/

    // nacitani novinek na index a do sekce novinek
    public function getNovinky($mini = true, $id = '', $limit = '0, 3') {
      if ($mini) {
        // podle limitu
        return $this['db']->query('novinky', array('idnovinky', 'idspravce', 'nadpis', 'url', 'pridano'), 'smazano is null', null, null, null, 'pridano DESC', $limit);
      } else {
        // podle id
        $where = (!empty($id) ? 'url=? AND smazano is null' : 'smazano is null');
        $whereargs = (!empty($id) ? array($id) : null);
        return $this['db']->query('novinky', array('idnovinky', 'idspravce', 'nadpis', 'url', 'zprava', 'pridano'), $where, $whereargs, null, null, 'pridano DESC');
      }
    }

    // nacitani nadpisu novinky
    public function getNovinkaNadpis($id) {
      $result = null;
      if (!empty($id)) {
        $res = $this['db']->query('novinky', array('nadpis'), 'url=?', array($id), null, null);
        $res->hasNext();
        $result = $res->nextRow()->nadpis;
      }
      return $result;
    }

    //TODO prozatimni metoda na export novinek... ma budoucnost???!
    public function getRssNovinky() {
      return $this['db']->query('novinky', array('idnovinky', 'nadpis', 'zprava', 'pridano'), null, null, null, null, 'pridano DESC');
    }

    // nacte uzivatelske role do asociativniho pole
    public function getUzivateleRole() {
      $it = iterator_to_array($this['db']->query('uzivatele_role', array('idrole', 'nazev'), null, null, null, null, 'idrole ASC'));
      $k_roles = array_map(function($r) { return $r->idrole; }, $it);
      $v_roles = array_map(function($r) { return $r->nazev; }, $it);
      return (!empty($k_roles) ? array_combine($k_roles, $v_roles) : array());
    }

    // nacitani dat o urctem uzivately
    public function getUzivatelData($id) {
      return $this['db']->query('uzivatele', array('idrole', 'idzeme', 'jmeno', 'prijmeni', 'telefon', 'avatar'), 'iduzivatel=?', array($id));
    }

    // nacteni zemi z databaze
    public function getZeme() {
      $it = iterator_to_array($this['db']->query('zeme', array('idzeme', 'nazev'), null, null, null, null, 'nazev ASC'));
      $k = array_map(function($r) { return $r->idzeme; }, $it);
      $v = array_map(function($r) { return $r->nazev; }, $it);
      return array_combine($k, $v);
    }

    // logovani posledniho prihlaseni uzivatele
    public function addLastLoginUzivatel($id) {
      $c = new classes\ContentValues;
      $c->put('iduzivatel', $id)
        ->putDate('pridano')
        ->put('ip', ip2long($_SERVER['REMOTE_ADDR'])) // long2ip / IPv6: inet_ntop/inet_pton
        ->put('useragent', $_SERVER['HTTP_USER_AGENT']);
      $this['db']->insert('lastlogin_uzivatele', $c);
    }

    // logovani posledniho prihlaseni spravce
    public function addLastLoginSpravce($id) {
      $c = new classes\ContentValues;
      $c->put('idspravce', $id)
        ->putDate('pridano')
        ->put('ip', ip2long($_SERVER['REMOTE_ADDR']))
        ->put('useragent', $_SERVER['HTTP_USER_AGENT']);
      $this['db']->insert('lastlogin_spravci', $c);
    }
  }


  /**
   *
   * trida zajistujici inicializaci databaze
   *
   */

  class DBHandler extends classes\PDOHelper {

    public function __construct($name) {
      parent::__construct($name);
    }

    public function onCreate(classes\PDODatabase $db) {
      if ($db->isMySQL()) {

        // spravci
        $cont = array('geniv' => '72500292392c54db9c17cf69e4e88320e0239630a99fd284226ca3d610676bd5105d7c3d66271a2f',
                      'Fugess' => '2fe68c9dc0b75ceb0642d79c4b1acdfd46ebcc9eaa9fc236c2cc4fd1c4c91cc5a3933b453962b43d',
                      'rami' => '95384963092854d788a93af7b5109a4eb25cb944e8a244b336b94aac1ac5c9a38fc85cea5787172c');

        $db->truncate('spravci');
        foreach ($cont as $k => $v) {
          $c = new classes\ContentValues;
          $c->put('login', $k)
            ->put('hash', $v)
            ->putDate('pridano');
          $db->insert('spravci', $c);
        }

//TODO ještě tu musí byt tabulka pro jazyky aby se jednotlive zeme daly zahrnout do prekladu

        //zeme
        $zeme = array(
                      'Česká republika',
                      'Slovensko',
                      'Velká británie',
                      'Německo',
                      );

        $db->truncate('zeme');
        foreach ($zeme as $v) {
          $c = new classes\ContentValues;
          $c->put('nazev', $v);
          $db->insert('zeme', $c);
        }

        $role = MainClass::getConstRoles();

        $db->truncate('uzivatele_role');
        foreach ($role as $v) {
          $c = new classes\ContentValues;
          $c->put('nazev', $v);
          $db->insert('uzivatele_role', $c);
        }

        //TODO dalsi defaultni plneni tabulek
      }
    }
  }


  class UzivatelAuthenticator implements classes\IAuthenticator {
    private $db = null;

    public function __construct($db) {
      $this->db = $db;
    }

    public function authenticate(array $credentials) {
      list($login, $pass) = $credentials;

      $hash = classes\User::getCleverHash($login, $pass);

      $c = $this->db->rawQuery('SELECT iduzivatel, uzivatele_role.nazev as role FROM uzivatele
                                JOIN uzivatele_role USING(idrole)
                                WHERE login=? AND hash=?;', array($login, $hash));

      if ($c->hasNext()) {
        $res = $c->nextRow();
        $c->close();  //zavreni cursoru

        $data = array(
                      'login' => $login,
                      );

        return new classes\Identity(intval($res->iduzivatel), array($res->role), $data);
      } else {
        return null;
      }
    }
  }

  /**
   *
   * trida pro authorizaci spravce
   *
   */

  class SpravceAuthenticator implements classes\IAuthenticator {
    private $db = null;

    public function __construct($db) {
      $this->db = $db;
    }

    public function authenticate(array $credentials) {
      list($login, $pass) = $credentials;

      $hash = classes\User::getCleverHash($login, $pass);

      $c = $this->db->rawQuery('SELECT idspravce FROM spravci
                                WHERE login=? AND hash=?;', array($login, $hash));

      if ($c->hasNext()) {
        $res = $c->nextRow();
        $c->close();  //zavreni cursoru

        $data = array(
                      'login' => $login,
                      );

        return new classes\Identity(intval($res->idspravce), array(), $data);
      } else {
        return null;
      }
    }
  }