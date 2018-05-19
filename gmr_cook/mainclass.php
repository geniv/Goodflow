<?php
/*
 * mainclass.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  final class MainClass extends classes\BaseMainClass {
    const VERSION = 1.60;

    /**
     * hlavni metoda inicializace jadra systemu
     *
     * @param path pocatecni path
     */
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

      // user
      $user = new classes\User('user');
      $user->setAuthenticator(new UserAuthenticator($db))
           ->setExpiration($this->configure['user']['expire']);
      $this['user'] = $user;

      // acl
      $acl = new classes\StaticACL;
      $user->setAuthorizator($acl);
      $this['acl'] = $acl;  //prenost acl do globalni instance
      $roles = self::getConstRoles(); // nacteni (globalnich) roli
      $this['roles'] = $roles;
      $resources = self::getConstResource();  // nacteni (globalnich) zdroju
      $this['resources'] = $resources;

          //definovani roli
      $acl->addRole($roles['uzivatel'])
          ->addRole($roles['administrator'], $roles['uzivatel'])
          //definovani zdroju
          ->addResource($resources['user_sekce'])
          ->addResource($resources['admin_sekce'], $resources['user_sekce'])
          //~ ->deny()
          //~ ->allow($roles['uzivatel'], $resources['moderate_cook'])
          //~ ->allow($roles['administrator'], $resources['administrate_web'], classes\StaticACL::ALL, true)
          ;
//~ print_r($this['acl']->getRules());

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
        //~ $glob_form = new $frm($p);
        //~ $this['form_global'] = $glob_form;
        $this['form_global'] = new $frm($p);
      }
    }
//TODO dotaz na kontrolu syrotku v pripojovacich tabulkach!
    /**
     * uklizeni po instanci
     */
    public function __destruct() {
      $this['handle']->close(); //zavreni databaze
    }

    /**
     * pomocna metoda inicializace pro vygenerovani databaze na mobilni platformu
     *
     * @param path pocatecni path
     */
    public function initializationSQLite($path = '', $mysql) {
      // nacitani hlavni konfigurace
      $this['configure'] = classes\Configurator::decode($path.'global_config.php');
      // nacteni konfigurace databaze
      $db_conf = classes\Configurator::decode($path.'database_config.php');

      // nastaveni time zony
      classes\DateAndTime::setDateTimezone($this->configure['date_timezone']);

      // nadefinovani desty pro SQLite3
      $p = __DIR__ .'/'. $db_conf['SQLite3']['host']; // path sqlite3
      if (file_exists($p)) {
        @unlink($p);
      }
//TODO tento kod pripadne upravit na generovani s pomoci BASH scriptu, protoze casova narocnost bude stoupat!!!
      $handle = new DBHandlerSQLite3($db_conf['SQLite3']['host']);  // predani jmena databaze
      $db = $handle->SQLite3(__DIR__)->getDatabase(true); // nacteni sqlite3 databaze

      // vlozeni polozky s meta-datama
      $c = new classes\ContentValues;
      $c->put('locale', 'cs_CZ');
      $db->insert('android_metadata', $c);

      //~ $result['uzivatele'] = 0;
      //~ // preklopeni mysql.uzivatele -> sqlite3.a_uzivatele
      //~ $dbResult = $mysql->query('uzivatele', array('iduzivatel', 'jmeno'), 'smazano IS NULL');
      //~ foreach ($dbResult as $k => $v) {
        //~ $c = new classes\ContentValues;
        //~ $c->put('iduzivatel', $v->iduzivatel)
          //~ ->put('jmeno', $v->jmeno);
        //~ $db->insert('a_uzivatele', $c);
        //~ $result['uzivatele']++;
      //~ }

      $result['kategorie'] = 0;
      // preklopeni mysql.kategorie -> sqlite3.a_kategorie
      $dbResult = $mysql->query('kategorie', array('idkategorie', 'nazev', 'popis'));
      foreach ($dbResult as $k => $v) {
        $c = new classes\ContentValues;
        $c->put('_id', $v->idkategorie)
          ->put('nazev', $v->nazev)
          ->put('popis', $v->popis);
        $db->insert('a_kategorie', $c);
        $result['kategorie']++;
      }

      $result['recepty'] = 0;
      // preklopeni mysql.recepty -> sqlite3.a_recepty
      //~ $dbResult = $mysql->query('recepty', array('idrecepty', 'iduzivatel', 'idkategorie', 'nazev', 'popis', 'doba', 'porce', 'pridano', 'upraveno'), 'smazano IS NULL');
      $dbResult = $mysql->rawQuery('SELECT idrecepty, uzivatele.jmeno autor, idkategorie, nazev, popis, doba, porce, recepty.pridano pridano, recepty.upraveno upraveno FROM recepty
                                    JOIN uzivatele USING(iduzivatel) WHERE recepty.smazano IS NULL AND navrh=FALSE;');
      foreach ($dbResult as $k => $v) {
        $c = new classes\ContentValues;
        $c->put('_id', $v->idrecepty)
          ->put('autor', $v->autor)
          ->put('idkategorie', $v->idkategorie)
          ->put('nazev', $v->nazev)
          ->put('nazev_hledani', classes\Core::getSafeText($v->nazev))
          ->put('popis', $v->popis)
          ->put('doba', $v->doba)
          ->put('porce', $v->porce)
          ->put('pridano', $v->pridano)
          ->put('upraveno', $v->upraveno);
        $db->insert('a_recepty', $c);
        $result['recepty']++;
      }

      $result['nadobi'] = 0;
      // preklopeni mysql.nadobi -> sqlite3.a_nadobi
      $dbResult = $mysql->query('nadobi', array('idnadobi', 'nazev', 'popis'));
      foreach ($dbResult as $k => $v) {
        $c = new classes\ContentValues;
        $c->put('_id', $v->idnadobi)
          ->put('nazev', $v->nazev)
          ->put('nazev_hledani', classes\Core::getSafeText($v->nazev))
          ->put('popis', $v->popis);
        $db->insert('a_nadobi', $c);
        $result['nadobi']++;
      }

      $result['nadobi_na_recepty'] = 0;
      // preklopeni mysql.nadobi_na_recepty -> sqlite3.a_nadobi_na_recepty
      $dbResult = $mysql->query('nadobi_na_recepty', array('idnadobi', 'idrecepty', 'mnozstvi', 'povinne'));
      foreach ($dbResult as $k => $v) {
        $c = new classes\ContentValues;
        $c->put('idnadobi', $v->idnadobi)
          ->put('idrecepty', $v->idrecepty)
          ->put('mnozstvi', $v->mnozstvi)
          ->put('povinne', $v->povinne);
        $db->insert('a_nadobi_na_recepty', $c);
        $result['nadobi_na_recepty']++;
      }

      $result['suroviny'] = 0;
      // preklopeni mysql.suroviny -> sqlite3.a_suroviny
      $dbResult = $mysql->query('suroviny', array('idsuroviny', 'nazev', 'popis'));
      foreach ($dbResult as $k => $v) {
        $c = new classes\ContentValues;
        $c->put('_id', $v->idsuroviny)
          ->put('nazev', $v->nazev)
          ->put('nazev_hledani', classes\Core::getSafeText($v->nazev))
          ->put('popis', $v->popis);
        $db->insert('a_suroviny', $c);
        $result['suroviny']++;
      }

      $result['suroviny_na_recepty'] = 0;
      // preklopeni mysql.suroviny_na_recepty -> sqlite3.a_suroviny_na_recepty
      $dbResult = $mysql->query('suroviny_na_recepty', array('idsuroviny', 'idrecepty', 'mnozstvi', 'povinne', 'idjednotky'));
      foreach ($dbResult as $k => $v) {
        $c = new classes\ContentValues;
        $c->put('idsuroviny', $v->idsuroviny)
          ->put('idrecepty', $v->idrecepty)
          ->put('mnozstvi', $v->mnozstvi)
          ->put('povinne', $v->povinne)
          ->put('idjednotky', $v->idjednotky);
        $db->insert('a_suroviny_na_recepty', $c);
        $result['suroviny_na_recepty']++;
      }

      //~ $result['jednotky'] = 0;
      //~ // preklopeni mysql.jednotky -> sqlite3.a_jednotky
      //~ $dbResult = $mysql->query('jednotky', array('idjednotky', 'nazev', 'popis'));
      //~ foreach ($dbResult as $k => $v) {
        //~ $c = new classes\ContentValues;
        //~ $c->put('idjednotky', $v->idjednotky)
          //~ ->put('nazev', $v->nazev)
          //~ ->put('popis', $v->popis);
        //~ $db->insert('a_jednotky', $c);
        //~ $result['jednotky']++;
      //~ }

      $handle->close();
      return $result;
    }

    /**
     * nacte uzivatelske role do asociativniho pole
     */
    public function getUzivateleRole() {
      $it = iterator_to_array($this['db']->query('role', array('idrole', 'nazev'), null, null, null, null, 'idrole ASC'));
      $k_roles = array_map(function($r) { return $r->idrole; }, $it);
      $v_roles = array_map(function($r) { return $r->nazev; }, $it);
      return (!empty($k_roles) ? array_combine($k_roles, $v_roles) : array());
    }

    /**
     * nacte kategorie receptu do pole
     */
    public function getKategorie() {
      $it = iterator_to_array($this['db']->query('kategorie', array('idkategorie', 'nazev'), null, null, null, null, 'nazev ASC'));
      $k_kat = array_map(function($r) { return $r->idkategorie; }, $it);
      $v_kat = array_map(function($r) { return $r->nazev; }, $it);
      return (!empty($k_kat) ? array_combine($k_kat, $v_kat) : array());
    }

    /**
     * nacte nadobi do pole
     */
    public function getNadobi() {
      $it = iterator_to_array($this['db']->query('nadobi', array('idnadobi', 'nazev'), null, null, null, null, 'nazev ASC'));
      $k_nadobi = array_map(function($r) { return $r->idnadobi; }, $it);
      $v_nadobi = array_map(function($r) { return $r->nazev; }, $it);
      return (!empty($k_nadobi) ? array_combine($k_nadobi, $v_nadobi) : array());
    }

    /**
     * nacte suroviny do pole
     */
    public function getSuroviny() {
      $it = iterator_to_array($this['db']->query('suroviny', array('idsuroviny', 'nazev'), null, null, null, null, 'nazev ASC'));
      $k_sur = array_map(function($r) { return $r->idsuroviny; }, $it);
      $v_sur = array_map(function($r) { return $r->nazev; }, $it);
      return (!empty($k_sur) ? array_combine($k_sur, $v_sur) : array());
    }

    /**
     * nacte idnadobi podle idreceptu
     */
    public function getIdNadobi($idrecepty) {
      $it = iterator_to_array($this['db']->query('nadobi_na_recepty', array('idnadobi'), 'idrecepty=?', array($idrecepty)));
      return array_map(function($r) { return $r->idnadobi; }, $it);
    }

    /**
     * nacte idsuroviny podle idreceptu
     */
    public function getIdSuroviny($idrecepty) {
      $it = iterator_to_array($this['db']->query('suroviny_na_recepty', array('idsuroviny'), 'idrecepty=?', array($idrecepty)));
      return array_map(function($r) { return $r->idsuroviny; }, $it);
    }

    /**
     * globalni pole konstant roli
     */
    public static function getConstRoles() {
      return array(
                    'uzivatel' => 'uživatel',  // registrovany uzivatel
                    'administrator' => 'administrátor', // administrator webu
                  );
    }

    /**
     * globalni pole konstant zdroju
     */
    public static function getConstResource() {
      return array(
                    'user_sekce' => 'user sekce', // rodic uzivatelske sekce
                    'admin_sekce' => 'admin sekce', // rodic admin sekce

                    //~ 'moderate_cook' => 'moderatovani receptů',
                    //~ 'administrate_web' => 'administrace webu',
                  );
    }

    /**
     * vraceni callback funkce pro generovani skupiny checkboxu
     */
    public function getCallbackFormCheckList() {
      return function($row) {  //element pro CheckList group
        $popisek = $row['html']::span()->setText($row['value']);
        $celek = $row['html']::label()->add($row['element'])->add($popisek);
        $res[] = $celek;
        return $res;
      };
    }
  }

  /**
   *
   * trida zajistujici inicializaci hlavni databaze
   *
   */

  class DBHandler extends classes\PDOHelper {

    /**
     * metoda volana pri instalaci databaze
     *
     * @param db databazovy handler
     */
    public function onCreate(classes\PDODatabase $db) {
      if ($db->isMySQL()) {

        // naplneni roli
        $role = MainClass::getConstRoles();
        $db->truncate('role');
        foreach ($role as $v) {
          $c = new classes\ContentValues;
          $c->put('nazev', $v);
          $db->insert('role', $c);
        }

        // napalneni uzivatele
        $db->truncate('uzivatele');
        $c = new classes\ContentValues;
        $c->put('idrole', 2)
          ->put('jmeno', 'Radek')
          ->put('login', 'geniv')
          ->put('hash', '72500292392c54db9c17cf69e4e88320e0239630a99fd284226ca3d610676bd5105d7c3d66271a2f')
          ->put('email', '')
          ->putDate('pridano');
        $db->insert('uzivatele', $c);

        //
      }
    }
  }

  /**
   *
   * trida zajistujici vytvoreni sqlite3 databaze pro mobilni aplikaci
   *
   */

  class DBHandlerSQLite3 extends classes\PDOHelper {

    /**
     * metoda volana pri instalaci databaze
     *
     * @param db databazovy handler
     */
    public function onCreate(classes\PDODatabase $db) {
      if ($db->isSQLite()) {
        $db->execSQL('CREATE TABLE IF NOT EXISTS android_metadata (locale TEXT DEFAULT "en_US")');
        // vytvoreni tabulky a_kategorie
        $db->execSQL('CREATE TABLE IF NOT EXISTS a_kategorie (
                      _id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT ,
                      nazev VARCHAR(100) NOT NULL UNIQUE,
                      popis VARCHAR(200) NULL)');

        // vytvoreni tabulky a_recepty
        $db->execSQL('CREATE TABLE IF NOT EXISTS a_recepty (
                      _id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT ,
                      idkategorie INTEGER NOT NULL ,
                      nazev VARCHAR(200) NOT NULL UNIQUE,
                      nazev_hledani VARCHAR(200) NOT NULL ,
                      popis TEXT NOT NULL ,
                      doba VARCHAR(30) NOT NULL ,
                      porce VARCHAR(30) NOT NULL ,
                      autor VARCHAR(300) NOT NULL ,
                      pridano DATETIME NULL ,
                      upraveno DATETIME NULL)');

        // vytvoreni tabulky a_nadobi
        $db->execSQL('CREATE TABLE IF NOT EXISTS a_nadobi (
                      _id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT ,
                      nazev VARCHAR(100) NOT NULL UNIQUE,
                      nazev_hledani VARCHAR(100) NOT NULL ,
                      popis VARCHAR(200) NULL)');

        // vytvoreni tabulky a_nadobi_na_recepty
        $db->execSQL('CREATE TABLE IF NOT EXISTS a_nadobi_na_recepty (
                      idnadobi INTEGER NOT NULL ,
                      idrecepty INTEGER NOT NULL ,
                      mnozstvi DOUBLE NULL ,
                      povinne TINYINT(1) NULL)');

        // vytvoreni tabulky a_suroviny
        $db->execSQL('CREATE TABLE IF NOT EXISTS a_suroviny (
                      _id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT ,
                      nazev VARCHAR(100) NOT NULL UNIQUE,
                      nazev_hledani VARCHAR(100) NOT NULL ,
                      popis VARCHAR(200) NULL)');

        // vytvoreni tabulky a_suroviny_na_recepty
        $db->execSQL('CREATE TABLE IF NOT EXISTS a_suroviny_na_recepty (
                      idsuroviny INTEGER NOT NULL ,
                      idrecepty INTEGER NOT NULL ,
                      mnozstvi DOUBLE NULL ,
                      povinne TINYINT(1) NULL ,
                      idjednotky INTEGER NULL)');

        //~ // vytvoreni tabulky a_jednotky
        //~ $db->execSQL('CREATE TABLE IF NOT EXISTS a_jednotky (
                      //~ idjednotky INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT ,
                      //~ nazev TEXT NOT NULL UNIQUE,
                      //~ popis TEXT NULL)');
      }
    }

  }

  /**
   *
   * trida pro authorizaci uzivatele
   *
   */

  class UserAuthenticator implements classes\IAuthenticator {
    private $db = null;

    /**
     * konstruktor Authenticator
     *
     * @param db databazovy handler
     */
    public function __construct($db) {
      $this->db = $db;
    }

    /**
     * hlavni metoda Authenticator
     *
     * @param credentials pole
     * @return trida identity nebo null
     */
    public function authenticate(array $credentials) {
      list($login, $pass) = $credentials;

      $hash = classes\Core::getCleverHash($login, $pass);

      $c = $this->db->rawQuery('SELECT iduzivatel, role.nazev as role FROM uzivatele
                                JOIN role USING(idrole)
                                WHERE login=? AND hash=? AND smazano IS NULL;', array($login, $hash));

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