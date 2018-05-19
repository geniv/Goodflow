<?php
/*
 * crate.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 * prepravka pro instance
 */

  /**
   * prepravka instanci
   *
   * @package unstable
   * @author geniv
   * @version 1.04
   */
  final class Crate extends classes\ObjectArray implements classes\ICron {

    /**
     * defaultni konstruktor
     *
     * @since 1.00
     * @param array pole vstupni pole
     */
    public function __construct($pole) {
      parent::__construct($pole);

      classes\Core::checkDependency(array(
          'global_config.php',
          'database_config.php',
        ));

      // nacitani hlavni konfigurace *******************************************
      $this->configure = classes\Configurator::decode('global_config.php');
      $this->crate = $this;

      // nacteni konfigurace databaze ******************************************
      $db_conf = classes\Configurator::decode('database_config.php');
      isset($db_conf['run'.chr(110).'able'])?:die(file_get_contents('data://text/plain;base64,ZnVja2luZyBub29iIQ=='));
      //~ $db_conf['language'] = $this->configure['language']['list'];

      // nacitani kofigurace z db konfigurace **********************************
      classes\ErrorLoger::setEmail($db_conf['errorloger']['email']);
      classes\ErrorLoger::setPrintStdOut($db_conf['errorloger']['printstdout']);
      classes\ErrorLoger::setInstantlySend($db_conf['errorloger']['instantlysend']);

      // nastavovani weburl do crate *******************************************
      $this->weburl = classes\Core::getUrl();
      $this->weburl_admin = $this->weburl . $this->configure['admin']['url'] . '/';

      // nastaveni time zony ***************************************************
      classes\DateAndTime::setDateTimezone($this->configure['date_timezone']);

      // databaze **************************************************************
      $this->db_name = $db_conf['name'];  // pro home
      $this->handle = new MyDatabaseHandler($db_conf['name']);
      $_driver = $db_conf['driver'];
      $this->db = $this->handle->$_driver($db_conf[$_driver])->getDatabase($db_conf['autoinstall'], $db_conf);

      // uzivatele *************************************************************
      $this->user = new classes\User('user'); // admin uzivatele

      $this->user->setAuthenticator(new classes\SimpleAuthenticator($db_conf['admin']['users']))
                ->setExpiration($this->configure['user']['expire']);

      // router model **********************************************************
      $this->lang_url = 'lang';
      $model = array(
          'page',
          'page==' . $this->lang_url . '/language',  // pravidlo pro prepinani jazyku
          'page==' . $this->configure['admin']['url'] . '/block/action/id',  // admin sekce
      );

      // menu ******************************************************************
      $this->menu = classes\Menu::simple($this->configure['menu'], $model, 'home');
      $this->uri = array_filter($this->menu->getUri());

      // tpl *******************************************************************
      $this->tpl = new classes\Tpl($this->configure['tpl']);

      // mazani automaticky vygenerovaneho obsahu ******************************
      if ($this->configure['system']['clearall']) {
        $this->tpl->clearAll();
      }
//TODO do tohoto mista musi byt nactene jazyky z databaze!!!
/*
      // jazykova mutace - prepinani *******************************************
      $this->language = classes\Language::getInstance();  // inicializace & nastaveni
      $this->language->setListLanguage($this->configure['language']['list'])
                    ->setDefaultLanguage($this->configure['language']['default'])
                    ->setAutoCreate($this->configure['language']['auto_create']);

      if (isset($this->uri['page']) && $this->uri['page'] == $this->lang_url && isset($this->uri['language']) && $this->language->inListLanguage($this->uri['language'])) {
        classes\Core::setCookie('language', $this->uri['language'], 60 * 60 * 24 * 30); // mesic, ukaldani jazyk do cookie
        classes\Core::setLocation(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $this->weburl); // presmerovani zpet nebo na home
        $this->current_language = $this->uri['language'];
      } else {
        $this->current_language = classes\Core::getCookie('language', $this->configure['language']['default']);
      }

      // jazykova mutace gettext ***********************************************
      $this->language->setLanguage($this->current_language)
                    ->initLanguage(null, false);
*/
      // title stranek - web
      $this->title = $this->menu->getTitle(array('before' => $this->configure['project_name'],));

      // prepinani indexu a adminu *********************************************
      $this->main_index_tpl = 'index';
      if (isset($this->uri['page']) && $this->uri['page'] === $this->configure['admin']['url']) {
        $this->main_index_tpl = 'admin/index';  // sahne do slozky adminu

        $this->admin_menu = classes\Menu::simple($this->configure['admin']['menu'], $model, 'home', $this->weburl . $this->configure['admin']['url'] . '/', 1);
        $this->admin_uri = $this->admin_menu->getUri();

        // title stranek - admin
        $this->title = $this->admin_menu->getTitle(array('before' => $this->configure['project_name'],));

        $this->current_language = 'en';
      }
    }

    /**
     * hlavni destruktor
     * - uzavreni handleru databaze
     *
     * @since 1.18
     * @param void
     * @return void
     */
    public function __destruct() {
      if (isset($this->handle)) {
        $this->handle->close();
      }
    }

    /**
     * synchronizacni metoda
     *
     * @since 1.60
     * @param array args pole konfigurace predavane z cronu
     * @return int pocet provedenych zmen
     */
    public static function synchronizeCron($args = array()) {
      $db_conf = classes\Configurator::decode('database_config.php');
      $handle = new MyDatabaseHandler($db_conf['name']);
      $_driver = $db_conf['driver'];
      $db = $handle->$_driver($db_conf[$_driver])->getDatabase($db_conf['autoinstall'], $db_conf);

      $poc = 0;
      // synchronizace pro slideshows
      //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/slideshow/', 'ignore' => array('no-slideshow-img.png'), 'db' => $db->query('slideshows', 'path')->getAllRows()));

      // synchronizace pro users
      //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/avatars/', 'ignore' => array('no-profile-img.png'), 'db' => $db->query('users', 'avatar', 'avatar IS NOT NULL')->getAllRows()));

      // synchronizace pro downloads
      //~ $download_pictures = $db->query('downloads', 'picture')->getAllRows();
      //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/download/mini/', 'db' => $download_pictures)); // mini
      //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/download/full/', 'db' => $download_pictures)); // full

      // cisteni neslinkovanych cdp souboru
      //~ $poc += $db->execSQL('DELETE _tc FROM trainz_cdp _tc
                            //~ LEFT JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                            //~ WHERE iddownload IS NULL');

      // synchronizace pro trainz_cdp
      //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'files/', 'db' => $db->query('trainz_cdp', 'path')->getAllRows()));

      // cisteni lastloginu (dny)
      //~ $poc += $db->delete('lastlogins', 'added <= (CURDATE() - INTERVAL '.$global_configure['expire']['lastlogins'].' DAY)', array());

      // cisteni archivu (dny)
      //~ $poc += $db->delete('notifications', 'deleted <= (CURDATE() - INTERVAL '.$global_configure['expire']['notifications'].' DAY)', array());

      return $poc;
    }

    /**
     * ajaxova rest metoda
     *
     * @since 1.82
     * @param void
     * @return string navratovy text
     */
    public static function getAjax() {
      $global_configure = classes\Configurator::decode('user_global_config.php');
      $db_conf = classes\Configurator::decode('database_config.php');
      $handle = new MyDatabaseHandler($db_conf['name']);
      $_driver = $db_conf['driver'];
      $db = $handle->$_driver($db_conf[$_driver])->getDatabase($db_conf['autoinstall'], $db_conf);
      $weburl = classes\Core::getUrl();
      $user = new classes\User('user'); // nacteni admin uzivatele

      $translate = require('translate.php');

      switch (isset($_POST['type']) ? $_POST['type'] : null) {
        default:
          return 'vubec nic...';

        case 'unique_download_name':  // kontrola duplicit nad downloads
          parse_str(urldecode($_POST['value']), $values); // dekodovani z url a prevedeni do pole
          $value_id = intval($_POST['value_id']); // nacteni id elementu (id jazyka)
          if ($_POST['act'] == 'add') {
            $c = $db->rawQuery('SELECT idlanguage FROM languages_has_downloads WHERE idlanguage=? AND name=?', array($value_id, $values['name'][$value_id]));
          } else {
            $c = $db->rawQuery('SELECT idlanguage FROM languages_has_downloads WHERE idlanguage=? AND name=? AND iddownload!=?', array($value_id, $values['name'][$value_id], intval($_POST['id'])));
          }
          $result = null;
          // kontrola proti databazi
          foreach ($c as $r) {
            $result = '<strong>Tento název již v databázi existuje!</strong>';
          }
          return $result;

        case 'unique_category_name':  // kontrola duplicit nad downloads category
          parse_str(urldecode($_POST['value']), $values); // dekodovani z url a prevedeni do pole
          $array_values = array_values($values['name']);
          if ($_POST['act'] == 'add') {
            $c = $db->rawQuery('SELECT iddownload_category FROM downloads_category _dc
                                JOIN languages_has_downloads_category _lhdc USING(iddownload_category)
                                WHERE
                                  idlanguage=? AND
                                  (_lhdc.name=? OR _dc.rewrite=?)',  array(1, $array_values[0], classes\Core::getRewrite($array_values[0])));
          } else {
            $c = $db->rawQuery('SELECT iddownload_category FROM downloads_category _dc
                                JOIN languages_has_downloads_category _lhdc USING(iddownload_category)
                                WHERE
                                  idlanguage=? AND
                                  iddownload_category!=? AND
                                  (_lhdc.name=? OR _dc.rewrite=?)', array(1, intval($_POST['id']), $array_values[0], classes\Core::getRewrite($array_values[0])));
          }
          $result = null;
          // kontrola proti databazi
          foreach ($c as $r) {
            $result = '<strong>Tento název již v databázi existuje!</strong>';
          }
          return $result;

        case 'download_cdp':  // pocitani stazeni
          $id = intval($_POST['id']);
          $ses = classes\Session::factory()->getSection('stahovaci')->setClearAfterExpire(true)->setExpiration($global_configure['download']['sessionExpire']); // expirace dle nastaveni a bez regenerace
          if ($db->beginTransaction()) {
            $c = $db->query('trainz_cdp', 'idtrainz_cdp, path, name, counter', 'idtrainz_cdp=?', array($id))->getFirst(); // nacteni
            $counter = $c->counter;
            if ($ses->$id != classes\Core::getIp() && $_POST['reckon'] == 'true') {  // pokud pro id neni IP && je povoleni pocitani (reckon)
              $counter = $c->counter + 1;
              $db->update('trainz_cdp', classes\ContentValues::init(array('counter' => $counter)), 'idtrainz_cdp=?', array($id)); // ulozeni
              $ses->$id = classes\Core::getIp();
            }
            $db->endTransaction();  // legalni ukonceni transakce
          }
          return json_encode(array(
              'counter' => $counter,
              'name' => base64_encode($c->name),
              'path' => base64_encode('files/' . $c->path)
            ));

        case 'hostname':  // nacitani host-name
          return gethostbyaddr($_POST['ip']);

        case 'cdpname': // nacitani cdp name pro databazi kuidu z ceskeho nazvu objektu
          $c = $db->rawQuery('SELECT languages_has_downloads.name FROM trainz_cdp
                              JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                              JOIN languages_has_downloads USING(iddownload)
                              JOIN languages USING(idlanguage)
                              WHERE languages.code=? AND idtrainz_cdp=?', array('cs', intval($_POST['id'])))->getFirst();
          return $c ? $c->name : null;

        case 'sendmessage': // posilani zprav a vraceni pridavane spravy v JSONu
          $message = mb_substr(urldecode($_POST['value']), 8);  // v tomto pripade se musi text jen orezavat! od 8 znaku (...=)
          if ($message) {
            $cv = classes\ContentValues::init()
                      ->put('iduser', $user->getId())
                      ->put('message', htmlspecialchars($message, ENT_NOQUOTES))  // prevadeni na entity
                      ->putDate('added');
            if (($idshoutboard = $db->insert('shoutboards', $cv)) > 0) {
              return json_encode(array(
                  'idshoutboard' => $idshoutboard,
                  'login' => $user->getData('login'),
                  'alias' => $user->getData('alias'),
                  'avatar' => $user->getData('avatar'),
                  'role' => implode($user->getRoles()),
                  'message' => htmlspecialchars($message, ENT_NOQUOTES),
                  'added' => classes\Core::getCzechDateTime(time(), true),
                ));
            }
          }
          return json_encode(array());

        case 'getlistmessages': // nacitani listu zprav do json-u
          $c = $db->rawQuery('SELECT idshoutboard, login, alias, avatar, _r.name role, message, _s.added FROM shoutboards _s
                              JOIN users USING(iduser)
                              JOIN roles _r USING(idrole)
                              WHERE _s.added >= (NOW() - INTERVAL ? DAY)
                              ORDER BY _s.added ASC', array(1))->getAll();
          $ret = array_map(function($v) { // konverze datumu
              $v['added'] = classes\Core::getCzechDateTime($v->added);
              return $v; }, $c);
          return json_encode($ret);

        case 'getonlineusers':  // nacitani seznamu online uzivatelu
          $c = $db->rawQuery('SELECT _u.login, _u.alias FROM shoutboards _s
                              JOIN users _u USING(iduser)
                              WHERE _s.added >= (NOW() - INTERVAL ? MINUTE)
                              GROUP BY _u.login
                              ORDER BY _u.login ASC', array($global_configure['admin']['shoutboardUserOnline']))->getAll();
          return json_encode($c);

        case 'sortableversion': // sortable uprava poradi trainz verzi
          parse_str(urldecode($_POST['value']), $values); // dekodovani z url a prevedeni do pole
          $poc = 0;
          foreach ($values['item'] as $k => $v) { // projiti pole
            $poc += $db->update('trainz_versions', classes\ContentValues::init(array('rank' => $k)), 'idtrainz_version=?', array($v)); // ulozeni
          }
          return $poc;

        case 'sortablecategory':  // sortable uprava poradi download kategorii
          parse_str(urldecode($_POST['value']), $values); // dekodovani z url a prevedeni do pole
          $poc = 0;
          foreach ($values['item'] as $k => $v) { // projiti pole
            $poc += $db->update('downloads_category', classes\ContentValues::init(array('rank' => $k)), 'iddownload_category=?', array($v)); // ulozeni
          }
          return $poc;

        case 'select_trainz_kuids': // dynamicke nacitani kuidu
          $value = '%'.$_POST['value'].'%';
          $result = array();
          foreach ($db->rawQuery('SELECT idtrainz_kuid, kuid, url, trainz_kuids.name, _tc.name cdp_name FROM trainz_kuids
                                  LEFT JOIN trainz_cdp _tc USING(idtrainz_cdp)
                                  WHERE (idtrainz_kuid LIKE ? OR kuid LIKE ? OR trainz_kuids.name LIKE ? OR _tc.name LIKE ?)
                                  ORDER BY CAST(kuid AS DECIMAL) ASC, kuid ASC', array($value, $value, $value, $value)) as $v) {
            $result[] = array('id' => $v->idtrainz_kuid, 'value' => '[ID: #'.$v->idtrainz_kuid.'] '.self::formatKuid($v->kuid, true) . ($v->name ? '&nbsp;&nbsp;(' . $v->name . ')' : null) . ($v->cdp_name ? '&nbsp;&nbsp;['.$v->cdp_name.']' : null) . ($v->url ? '&nbsp;&nbsp;[externi odkaz]' : null));
          }
          return json_encode($result);

        case 'init_select_trainz_kuids':  // inicializace pro dynamicke nacitani kuidu (chybne odeslani/nacitani)
          $values = explode(',', $_POST['value']);
          $result = array();
          foreach ($db->rawQuery('SELECT idtrainz_kuid, kuid, url, trainz_kuids.name, _tc.name cdp_name FROM trainz_kuids
                                  LEFT JOIN trainz_cdp _tc USING(idtrainz_cdp)
                                  WHERE idtrainz_kuid IN ('.implode(', ', array_fill(0, count($values), '?')).')
                                  ORDER BY CAST(kuid AS DECIMAL) ASC, kuid ASC', $values) as $v) {
            $result[] = array('id' => $v->idtrainz_kuid, 'value' => '[ID: #'.$v->idtrainz_kuid.'] '.self::formatKuid($v->kuid, true) . ($v->name ? '&nbsp;&nbsp;(' . $v->name . ')' : null) . ($v->cdp_name ? '&nbsp;&nbsp;['.$v->cdp_name.']' : null) . ($v->url ? '&nbsp;&nbsp;[externi odkaz]' : null));
          }
          return json_encode($result);
      }
    }

    // manipulacni metody ******************************************************

    /**
     * nacteni jazyku v databazi (downloads.tpl, news.tpl, downloads_category.tpl)
     *
     * @since 1.44
     * @param void
     * @return PDOCursor vysledny kurzor
     */
    public function getListLanguages() {
      return $this->db->query('languages', 'idlanguage, code, name');
    }
  }



  // databazovy handler
  class MyDatabaseHandler extends classes\PDOHelper {
    // instalace prvnich dat
    public function onCreate(classes\PDODatabase $db, $data = null) {
      switch ($db->getDriverName()) {
        case 'mysql':
          // SQL tabulky jsou synchronyzovane predem
/*
          $db->truncate('roles');
          foreach ($data['admin']['roles'] as $v) {
            $c = new classes\ContentValues;
            $c->put('name', $v);
            $db->insertOrThrow('roles', $c);
          }

          $db->truncate('users');
          foreach ($data['admin']['users'] as $l => $v) {
            $c = new classes\ContentValues;
            $c->put('login', $l)
              ->put('hash', $v['hash'])
              ->put('idrole', $v['role'])
              ->put('email', $v['email'])
              ->put('confirmed', true)
              ->put('confirmed_email', true)
              ->putDate('added');
            $db->insertOrThrow('users', $c);
          }

          $db->truncate('news_icons');
          foreach ($data['admin']['news_icons'] as $v) {
            $c = new classes\ContentValues;
            $c->put('name', basename($v, '.png'))
              ->put('path', $v);
            $db->insertOrThrow('news_icons', $c);
          }

          $db->truncate('languages');
          foreach ($data['language'] as $code => $v) {
            $c = new classes\ContentValues;
            $c->put('code', $code)
              ->put('name', $v[1]);
            $db->insertOrThrow('languages', $c);
          }

          $db->truncate('links_category');
          foreach ($data['admin']['links_category'] as $v) {
            $c = new classes\ContentValues;
            $db->insertOrThrow('links_category', $c);
          }

          $db->truncate('languages_has_links_category');
          $poc = 1; // cislo jazyka
          foreach ($data['admin']['languages_has_links_category'] as $langs) {
            foreach ($langs as $key => $lang) { // prochazeni prekladu
              $c = new classes\ContentValues;
              $c->put('idlanguage', $poc)
                ->put('idlink_category', $key + 1)
                ->put('name', $lang);
              $db->insertOrThrow('languages_has_links_category', $c);
            }
            $poc++;
          }
*/
        break;
      }
    }
  }