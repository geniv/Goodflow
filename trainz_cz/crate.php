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
     * @package stable
     * @author geniv
     * @version 3.66
     */
    final class Crate extends classes\ObjectArray implements classes\ICron {

        // typy notifikaci
        const TYPE_REGISTRATION = 'registration';
        const TYPE_DOWNLOAD = 'download';
        const TYPE_SLIDESHOW = 'slideshow';
        const TYPE_MESSAGE = 'message';

        /**
         * defaultni konstruktor
         *
         * @since 1.00
         * @param array pole vstupni pole
         */
        public function __construct($pole) {
            parent::__construct($pole);

            classes\Core::checkDependency(array(
                    'user_global_config.php',
                    'global_config.php',
                    'database_config.php',
                ));

            // uzivatelska globalni konfigurace **************************************
            $this->global_configure = classes\Configurator::decode('user_global_config.php');
            // nacitani hlavni konfigurace *******************************************
            $this->configure = classes\Configurator::decode('global_config.php');
            $this->crate = $this;

            // nacteni konfigurace databaze ******************************************
            $db_conf = classes\Configurator::decode('database_config.php');
            isset($db_conf['run'.chr(110).'able'])?:die(file_get_contents('data://text/plain;base64,ZnVja2luZyBub29iIQ=='));
            $db_conf['language'] = $this->configure['language']['list'];

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
            $this->user->setAuthenticator(new AdminUserAuthenticator($this->db))
                        ->setExpiration($this->configure['user']['expire']);

            $this->upload_user = new classes\User('upload user'); // upload uzivatele
            $this->upload_user->setAuthenticator(new UploadUserAuthenticator($this->db))
                                ->setExpiration($this->configure['user']['expire']);

            // definice roles & resources ********************************************
            $this->roles = $this->getArrayListAclRoles();
            $this->resources = classes\Configurator::decode('acl_config.php');

            // ACL *******************************************************************
            $this->acl = new classes\StaticACL;
            $this->user->setAuthorizator($this->acl);
            $this->upload_user->setAuthorizator($this->acl);  // up.uzivateli se priradi ACLko

            $this->acl->loadFromFile('.staticACL');
            if (!$this->acl->isLoadFromFile()) {
                // definovani roli na ACL **********************************************
                // nacitani roli do ACL
                foreach ($this->roles as $k_role => $v_role) {
                    $this->acl->addRole($this->roles[$k_role]);
                }

                // nacitani resources do ACL
                foreach ($this->resources as $k_resources => $v_resources) {
                    $this->acl->addResource($k_resources);
                }

                // definovani allow a deny *********************************************
                $this->acl->allow($this->roles[2]);
                $this->acl->commitRules('.staticACL', true);
            }

            // router model **********************************************************
            $this->lang_url = 'lang';
            $this->down_type = 'downloadtype';
            $model = array(
                'page',
                'page==page/pager', // strankovani home
                'page==novinky/id', // rozkliknuti novinky
                'page==download/lvl1/lvl2/lvl3/lvl4/lvl5/id', // rozkliknuti downloadu
                'page==download/lvl1==autor/login', // rozkliknuti autora
                'page==download/lvl1==historie/datum',  // rozkliknuti historie
                'page==upload/block/action/id', // upload sekce
                'page==' . $this->lang_url . '/language', // pravidlo pro prepinani jazyku
                'page==' . $this->down_type . '/type',    // pravidla pro prepinani typu downloadu
                'page==' . $this->configure['admin']['url'] . '/block/subblock/subaction/id',  // admin sekce
            );

            // menu ******************************************************************
            $this->menu = classes\Menu::simple($this->configure['menu'], $model, 'home');
            $this->uri = array_filter($this->menu->getUri());

            // tpl *******************************************************************
            $this->tpl = new classes\Tpl($this->configure['tpl']);
            $this->main_index_tpl = 'index';    // prvni stranka

            // mazani automaticky vygenerovaneho obsahu ******************************
            if ($this->configure['system']['clearall']) {
                $this->tpl->clearAll();
            }

            // jazykova mutace - prepinani *******************************************
            $this->language = classes\Language::getInstance();  // inicializace & nastaveni
            $this->language->setListLanguage($this->configure['language']['list'])
                            ->setDefaultLanguage($this->configure['language']['default'])
                            ->setAutoCreate($this->configure['language']['auto_create']);

            // overeni jestli je na co prepinat
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

            // prekladove pole - zdrojove texty, v konfigurakach se vubec nezobrazi **
            $this->translate = require('translate.php');

            // prepinani typu download vypisu ****************************************
            if (isset($this->uri['page']) && $this->uri['page'] == $this->down_type && isset($this->uri['type'])) {
                classes\Core::setCookie('type', $this->uri['type'], 60 * 60 * 24 * 30); // mesic, ukaldani jazyk do cookie
                classes\Core::setLocation(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $this->weburl . 'download'); // presmerovani zpet nebo na jen download
                $this->current_down_type = $this->uri['type'];
            } else {
                $this->current_down_type = classes\Core::getCookie('type', 'tree'); // list | tree
            }

            // title stranek
            $after = array();
            if (isset($this->uri['page']) && $this->uri['page'] == 'download') {
                // prochazeni adresy
                foreach (array_slice($this->uri, 1) as $value) {
                    $after[] = $this->getDownloadCategoryRewrite($value, 'name');
                }
                // objekt
                if ($this->isDownloadObject($this->uri)) {
                    $after[] = $this->getDownload($this->getDownloadObjectID($this->uri), 'name');
                }
            }

            $this->title = $this->menu->getTitle(array('before' => $this->configure['project_name'], 'source' => $this->translate['title'], 'after' => $after));

            // prepinani indexu a adminu *********************************************
            // $this->main_index_tpl = 'index';
            if (isset($this->uri['page']) && $this->uri['page'] === $this->configure['admin']['url']) {
                $this->main_index_tpl = 'admin/index';  // sahne do slozky adminu

                $this->admin_menu = classes\Menu::simple($this->configure['admin']['menu'], $model, 'home', $this->weburl . $this->configure['admin']['url'] . '/', 1);
                $this->admin_uri = $this->admin_menu->getUri();

                $this->current_language = 'cs';

                // podrobne filtrovani uri jen na povolene adresy
                $this->acl_resource = implode('/', array_slice(array_filter($this->admin_uri, function($v) {
                    return $v && $v != 'add' && $v != 'edit' && $v != 'del' && !preg_match('/[-0-9]+/', $v);
                    }), 0, 2));
            }

            // obsluha uzivatelske upload sekce **************************************
            if (isset($this->uri['page']) && $this->uri['page'] === $this->configure['user']['url']) {
                $this->upload_menu = classes\Menu::simple($this->configure['user']['menu'], $model, 'home', $this->weburl . $this->configure['user']['url'] . '/', 1);
                $this->upload_uri = $this->upload_menu->getUri();
            }
            // ***********************************************************************
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
            $this->handle->close();
        }

        /**
         * synchronizacni metoda
         *
         * @since 1.60
         * @param array args pole konfigurace predavane z cronu
         * @return int pocet provedenych zmen
         */
        public static function synchronizeCron($args = array()) {
            $global_configure = classes\Configurator::decode('user_global_config.php');
            $db_conf = classes\Configurator::decode('database_config.php');
            $handle = new MyDatabaseHandler($db_conf['name']);
            $_driver = $db_conf['driver'];
            $db = $handle->$_driver($db_conf[$_driver])->getDatabase($db_conf['autoinstall'], $db_conf);

            $poc = 0;
            if ($db->beginTransaction()) {
                // synchronizace pro slideshows
                $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/slideshow/', 'ignore' => array('no-slideshow-img.png'), 'db' => $db->query('slideshows', 'path')->getAllRows()));

                // synchronizace pro users
                $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/avatars/', 'ignore' => array('no-profile-img.png'), 'db' => $db->query('users', 'avatar', 'avatar IS NOT NULL')->getAllRows()));

                // synchronizace pro links
                $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/links/', 'ignore' => array('no-img.png'), 'db' => $db->query('links', 'picture', 'picture IS NOT NULL')->getAllRows()));

                // synchronizace pro news_icons
                $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/icons/', 'db' => $db->query('news_icons', 'path')->getAllRows()));

                // synchronizace pro downloads
                $download_pictures = $db->query('downloads', 'picture')->getAllRows();
                $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/download/mini/', 'db' => $download_pictures)); // mini
                $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/download/full/', 'db' => $download_pictures)); // full

                // cisteni neslinkovanych cdp souboru
                $poc += $db->execSQL('DELETE _tc FROM trainz_cdp _tc
                                    LEFT JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                    WHERE iddownload IS NULL');

                // synchronizace pro trainz_cdp
                $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'files/', 'db' => $db->query('trainz_cdp', 'path')->getAllRows()));

                // cisteni neaktivovanych uzivatelu (dny)
                $poc += $db->delete('users', '(confirmed=0 OR confirmed_email=0) AND added <= (CURDATE() - INTERVAL '.$global_configure['expire']['users'].' DAY)', array());

                // cisteni lastloginu (dny)
                $poc += $db->delete('lastlogins', 'added <= (CURDATE() - INTERVAL '.$global_configure['expire']['lastlogins'].' DAY)', array());

                // cisteni archivu (dny)
                $poc += $db->delete('notifications', 'deleted <= (CURDATE() - INTERVAL '.$global_configure['expire']['notifications'].' DAY)', array());

                // cisteni vyexpirovanych uzivatelu
                $poc += $db->delete('notifications', 'from_id IS NULL AND to_id IS NULL AND handled_id IS NULL AND deleted IS NULL', array());

                // cisteni shoutboard (dny)
                $poc += $db->delete('shoutboards', 'added <= (CURDATE() - INTERVAL '.$global_configure['expire']['shoutboards'].' DAY)', array());

                // vytvoreni sitemap-y
                $poc += self::createSitemap($db);

                $db->endTransaction();
            }

            return $poc;
        }

        /**
         * vytvoreni sitemapy
         *
         * @since 3.60
         * @param PDODatabase db ukazatel databaze
         * @return int pocet vygenerovanych polozek
         */
        private static function createSitemap($db) {
            $poc = 0;
            $url = classes\Core::getUrl();
            $site = new classes\Sitemap;
            $site->addLink('http://forum.trainz.cz')
                ->addLink($url . 'download')
                ->addLink($url . 'odkazy')
                ->addLink($url . 'shop')
                ->addLink($url . 'upload')
                ->addLink($url . 'upload/zebricek-autoru')
                ->addLink($url . 'upload/nejstahovanejsi-objekty')
                ->addLink($url . 'upload/screenshoty-autoru');

            // generovani screenshotu
            foreach ($db->rawQuery('SELECT login, alias, author, COUNT(idslideshow) pocet FROM slideshows _s
                                        LEFT JOIN users USING(iduser)
                                        WHERE _s.confirmed=1
                                        GROUP BY iduser, author
                                        ORDER BY COALESCE(login, author) ASC') as $v) {
                $site->addLink($url . 'upload/screenshoty-autoru/' . $v->author.$v->login);
                foreach ($db->rawQuery('SELECT path, description FROM slideshows _s
                                      LEFT JOIN users USING(iduser)
                                      WHERE _s.confirmed=1 AND (author=? OR login=?)', array($v->author, $v->login)) as $vv) {
                    $site->addImage($url . 'img/slideshow/' . $vv->path, $vv->description);
                    $poc++;
                }
            }

            // generovani novinek
            foreach ($db->query('news', 'idnews, added, edited') as $v) {
                $site->addLink($url . 'novinky/' . $v->idnews, $v->edited ?: $v->added);
                $poc++;
            }

            foreach (self::getStaticListDownloadCategory($db, null) as $v0) { // level 0
                $poc += self::getSitemapDownloads($db, $v0->iddownload_category, $site, $url, $v0->rewrite);
                foreach (self::getStaticListDownloadCategory($db, $v0->iddownload_category) as $v1) { // level 1
                    $poc += self::getSitemapDownloads($db, $v1->iddownload_category, $site, $url, $v0->rewrite.'/'.$v1->rewrite);
                    foreach (self::getStaticListDownloadCategory($db, $v1->iddownload_category) as $v2) { // level 2
                        $poc += self::getSitemapDownloads($db, $v2->iddownload_category, $site, $url, $v0->rewrite.'/'.$v1->rewrite.'/'.$v2->rewrite);
                        foreach (self::getStaticListDownloadCategory($db, $v2->iddownload_category) as $v3) { // level 4
                            $poc += self::getSitemapDownloads($db, $v3->iddownload_category, $site, $url, $v0->rewrite.'/'.$v1->rewrite.'/'.$v2->rewrite.'/'.$v3->rewrite);
                            foreach (self::getStaticListDownloadCategory($db, $v3->iddownload_category) as $v4) { // level 5
                                $poc += self::getSitemapDownloads($db, $v4->iddownload_category, $site, $url, $v0->rewrite.'/'.$v1->rewrite.'/'.$v2->rewrite.'/'.$v3->rewrite.'/'.$v4->rewrite);
                            }
                        }
                    }
                }
            }
            $site->render('sitemap.xml');
            return $poc;
        }

        /**
         * generovani polozek pro sitemapu (crate)
         * - skladani linku a obrazku
         *
         * @since 3.54
         * @param PDODatabase db ukazatel databaze
         * @param int iddownload_category
         * @param Sitemap site objekt sitemapy
         * @param string url url webu
         * @param string rewrite skaladana rewrite adresa
         * @return int pocet zpracovanych poloezk
         */
        public static function getSitemapDownloads($db, $iddownload_category, $site, $url, $rewrite) {
            $poc = 0;
            foreach (self::getStaticListDownloads($db, $iddownload_category) as $vv) {
                $site->addLink($url . 'download/' . $rewrite . '/' . $vv->rewrite, $vv->edited ?: $vv->added)
                    ->addImage($url . 'img/download/mini/' . $vv->picture, $vv->name);
                $poc++;
            }
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
                        if ($c) { // pokud cdp existuje
                            $counter = $c->counter;
                            if ($ses->$id != classes\Core::getIp(null) && $_POST['reckon'] == 'true') {  // pokud pro id neni IP && je povoleni pocitani (reckon)
                                $counter = $c->counter + 1;
                                $db->update('trainz_cdp', classes\ContentValues::init(array('counter' => $counter)), 'idtrainz_cdp=?', array($id)); // ulozeni
                                $ses->$id = classes\Core::getIp(null);
                            }
                        }
                        $db->endTransaction();  // legalni ukonceni transakce
                    }
                    return $c ? json_encode(array(
                        'counter' => $counter,
                        'name' => base64_encode($c->name),
                        'path' => base64_encode('files/' . $c->path)
                        )) : json_encode(array());

                case 'hostname':  // nacitani host-name
                    return classes\Core::getHost($_POST['ip']);

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

                case 'delmessage':  // smazani zpravy z historie
                    return $db->delete('shoutboards', 'idshoutboard=?', array(intval($_POST['id'])));

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
                        $poc += $db->update('trainz_versions', classes\ContentValues::init()->put('rank', $k), 'idtrainz_version=?', array($v)); // ulozeni
                    }
                    return $poc;

                case 'sortablelinks': // sortable uprava poradi links
                  parse_str(urldecode($_POST['value']), $values); // dekodovani z url a prevedeni do pole
                  $poc = 0;
                  foreach ($values['item'] as $k => $v) { // projiti pole
                    $poc += $db->update('links', classes\ContentValues::init()->put('rank', $k + 1), 'idlink=?', array($v)); // ulozeni
                  }
                  return $poc;

                case 'sortablecdp': // sortable uprava poradi trainz cdp
                  parse_str(urldecode($_POST['value']), $values); // dekodovani z url a prevedeni do pole
                  $poc = 0;
                  foreach ($values['item'] as $k => $v) { // projiti pole
                    $poc += $db->update('trainz_cdp', classes\ContentValues::init()->put('rank', $k), 'idtrainz_cdp=?', array($v)); // ulozeni
                  }
                  return $poc;

                case 'sortablecategory':  // sortable uprava poradi download kategorii
                  parse_str(urldecode($_POST['value']), $values); // dekodovani z url a prevedeni do pole
                  $poc = 0;
                  foreach ($values['item'] as $k => $v) { // projiti pole
                    $poc += $db->update('downloads_category', classes\ContentValues::init()->put('rank', $k), 'iddownload_category=?', array($v)); // ulozeni
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

                case 'fix_translate': // opravy prekladu
                  $poc = 0;
                  foreach ($db->rawQuery('SELECT idlanguage, iddownload, description FROM languages_has_downloads
                                          WHERE description LIKE ? OR description LIKE ? OR description LIKE ? OR description LIKE ?
                                          LIMIT 0,50', array('%<span class=_hps_>%', '%<div id=_gt-res-tools_>%', '%span id=_%', '%div id=_%')) as $v) {

                    $out = preg_replace(array(
                                          '/<span id="result_box" lang="(en|de)">(.+)(<\/span>)?/',
                                          '/<span id="result_box" lang="(en|de)" tabindex="-1">(.+)(<\/span>)?/',
                                          '/<span id="result_box" class="(short_text|long_text|long_text short_text)" lang="(en|de)" tabindex="-1">(.+)(<\/span>)?/',

                                          '/<span class="(hps|atn|hps atn|hps alt-edited)">([\w \-\.\"\=\:\(\)\;\&\/,žňěčř]+)<\/span>/',
                                          '/<span class="(hps|atn|hps atn|hps alt-edited)">(.+)(<\/span>)?/',

                                          '/<span>(.*)<\/span>/',
                                          '/<\/span>(.*)<span>/',
                                          '/<\/span><span>/',
                                          '/<\/span>/',
                                        ),
                                      array(
                                          '${2}',
                                          '${2}',
                                          '${3}',

                                          '${2}',
                                          '${2}',

                                          '${1}',
                                          '${1}',
                                          '',
                                          '',
                                        ),
                                      $v->description);

                    if ($db->update('languages_has_downloads', classes\ContentValues::init()->put('description', $out), 'idlanguage=? AND iddownload=?', array($v->idlanguage, $v->iddownload)) > 0) {
                      $poc++;
                    }
                  }
                  return $poc;

                case 'homedata':
                    $result = array(
                        // pocet objektu
                        'count_downloads' => $db->rawQuery('SELECT COUNT(iddownload) pocet FROM downloads WHERE confirmed=1 AND deleted IS NULL')->getFirst()->pocet,
                        'count_up_downloads' => $db->rawQuery('SELECT COUNT(iddownload) pocet FROM downloads WHERE confirmed=1 AND deleted IS NULL AND DATE(added)=CURDATE()')->getFirst()->pocet,
                        // pocet slideshow
                        'count_slideshows' => $db->rawQuery('SELECT COUNT(idslideshow) pocet FROM slideshows WHERE confirmed=1')->getFirst()->pocet,
                        'count_up_slideshows' => $db->rawQuery('SELECT COUNT(idslideshow) pocet FROM slideshows WHERE confirmed=1 AND DATE(added)=CURDATE()')->getFirst()->pocet,
                        //pocet novinek
                        'count_news' => $db->rawQuery('SELECT COUNT(idnews) pocet FROM news')->getFirst()->pocet,
                        'count_up_news' => $db->rawQuery('SELECT COUNT(idnews) pocet FROM news WHERE DATE(added)=CURDATE()')->getFirst()->pocet,
                        // pocet odkazu
                        'count_links' => $db->rawQuery('SELECT COUNT(idlink) pocet FROM links')->getFirst()->pocet,
                        // pocet kuidu
                        'count_trainz_kuid' => $db->rawQuery('SELECT COUNT(idtrainz_kuid) pocet FROM trainz_kuids')->getFirst()->pocet,
                        // pocet kategorii
                        'count_downloads_category' => $db->rawQuery('SELECT COUNT(iddownload_category) pocet FROM downloads_category')->getFirst()->pocet,
                        // pocet trainz verzi
                        'count_trainz_versions' => $db->rawQuery('SELECT COUNT(idtrainz_version) pocet FROM trainz_versions')->getFirst()->pocet,
                        // pocet uzivatelu
                        'count_users' => $db->rawQuery('SELECT COUNT(iduser) pocet FROM users WHERE confirmed=1 AND deleted IS NULL')->getFirst()->pocet,
                        'count_up_users' => $db->rawQuery('SELECT COUNT(iduser) pocet FROM users WHERE confirmed=1 AND deleted IS NULL AND DATE(added)=CURDATE()')->getFirst()->pocet,
                        // pocet autoru
                        'count_authors' => $db->rawQuery('SELECT COUNT(poc) + (SELECT COUNT(poc) pocet FROM
                                            (SELECT COUNT(author) poc FROM slideshows WHERE author IS NOT NULL AND confirmed=1 GROUP BY author) tab) pocet FROM
                                                (SELECT COUNT(author) poc FROM downloads WHERE author IS NOT NULL AND confirmed=1 AND deleted IS NULL GROUP BY author) tab')->getFirst()->pocet,
                        // velikost cdp souboru
                        'file_size_files' => classes\Core::calculateSize(classes\Core::getSizeDir('files/')),
                        // velikost download obrazku
                        'file_size_img_download' => classes\Core::calculateSize(classes\Core::getSizeDir('img/download/', true)),
                        // velikost slideshow obrazku
                        'file_size_img_slideshow' => classes\Core::calculateSize(classes\Core::getSizeDir('img/slideshow/')),
                        // velikost databaze
                        'db_size' => classes\Core::calculateSize($db->rawQuery('SELECT Sum(data_length + index_length) size FROM information_schema.tables WHERE table_schema=?', array($db_conf['name']))->getFirst()->size),
                        );
                    return json_encode($result);
            }
        }

        // kontrololni metody ******************************************************

    /**
     * formatovac kuidu
     *
     * @since 2.48
     * @param string kuid vstupni kuid text
     * @param bool html true pro html entity
     * @return string naformatovany kuid
     */
    public static function formatKuid($kuid, $html = false) {
        $k1 = substr_count($kuid, ':') == 1;
        if ($html) {
            return '&#60;' . ($k1 ? 'kuid' : 'kuid2') . ':' . $kuid . '&#62;';
        } else {
            return '&lt;' . ($k1 ? 'kuid' : 'kuid2') . ':' . $kuid . '&gt;';
        }
    }

    /**
     * zpracovani textu, osekani na jeden odstavec, vyhozeni html elementu
     *
     * @since 2.56
     * @param string text vstupni text
     * @return string zpracovany text
     */
    public static function getSafeDescription($text) {
        return classes\Core::getReplaceText(classes\Core::trimParagraphs($text, 1), array('/<\/?[a-zA-Z0-9"=\-\_:;\.\/ \?\!\&\#]+>/' => ''));
    }

    /**
     * nacteni ID kuidu (downloads.tpl)
     *
     * @since 1.90
     * @param string kuid vstupni kuid
     * @return int|null id kuidu, pokud neexistuje tak null
     */
    public function getKuidId($kuid) {
        $c = $this->db->query('trainz_kuids', 'idtrainz_kuid', 'kuid=?', array($kuid))->getFirst();
        return $c ? $c->idtrainz_kuid : null;
    }

    /**
     * existuje downloads name? (downloads.tpl)
     *
     * @since 1.88
     * @param string name vstupni jmeno
     * @return bool true kdyz jmeno existuje
     */
    public function existDownloadsName($name) {
        $c = $this->db->query('languages_has_downloads', 'iddownload', 'name=?', array($name));
        return $c->count() > 0;
    }

    /**
     * jedna se o download objekt?
     *
     * @since 1.92
     * @param array uri pole uri adresy
     * @return bool true pokud jde o download objekt
     */
    public function isDownloadObject($uri) {
        return (bool) preg_match('/^[0-9]+\-(.+)/', implode(array_slice($uri, -1)));
    }

    /**
     * nacteni ID download objektu z uri adresy
     *
     * @since 1.96
     * @param array uri pole uri adresy
     * @return string id objektu z adresy
     */
    public function getDownloadObjectID($uri) {
        $last = explode('-', implode(array_slice($uri, -1)));
        return $last[0];
    }

    // manipulacni metody ******************************************************

    /**
     * logovani prihlasovani (upload.tpl, a:index.tpl)
     *
     * @since 2.18
     * @param int id_user id prihlaseneho uzivatele
     * @param string screen serializovany screen objekt
     * @param bool from_web true pokud jde o prihlaseni z webu, false z adminu
     * @return void
     */
    public function addLastLogin($id_user, $screen, $from_web) {
        $cv = new classes\ContentValues;
        $cv->put('iduser', $id_user)
            ->put('ip', classes\Core::getIP(null))
            ->put('agent', $_SERVER['HTTP_USER_AGENT'])
            ->put('screen', $screen)
            ->putDate('added')
            ->put('from_web', $from_web);
        $this->db->insert('lastlogins', $cv);
    }

    /**
     * nacteni roli, krome role=2, do asociativniho pole (user.tpl)
     * - vyhazuje idrole 2
     *
     * @since 1.50
     * @param void
     * @return array pole roli
     */
    public function getArrayListRoles() {
        $result = array();
        foreach ($this->db->query('roles', 'idrole, name', 'idrole!=?', array(2), null, null, 'idrole DESC') as $v) {
            $result[$v->idrole] = $v->name;
        }
        return $result;
    }

    /**
     * nacteni uzivatelu, do asociativniho pole (slideshows.tpl, downloads.tpl)
     *
     * @since 1.58
     * @param void
     * @return array pole uzivatelu
     */
    public function getArrayListUsers() {
        $result = array();
        foreach ($this->db->rawQuery('SELECT iduser, login, alias, roles.name FROM users
                                      JOIN roles USING(idrole)
                                      WHERE confirmed=1 AND deleted IS NULL
                                      ORDER BY iduser ASC') as $v) {
            $result[$v->iduser] = $v->login . ' ' . ($v->alias ? '(' . $v->alias . ')&nbsp;&nbsp;' : ''). '[' . $v->name . ']';
        }
        return $result;
    }

    /**
     * nacteni vsech roli (crate)
     *
     * @since 1.56
     * @param void
     * @return array pole pravidel
     */
    public function getArrayListAclRoles() {
        $result = array();
        foreach ($this->db->query('roles') as $v) {
            $result[$v->idrole] = $v->name;
        }
        return $result;
    }

    /**
     * nacteni kategorii linku do asociativniho pole (links.tpl)
     *
     * @since 1.56
     * @param void
     * @return array pole roli
     */
    public function getArrayListLinksCategory() {
        $result = array();
        foreach ($this->db->rawQuery('SELECT idlink_category, name FROM links_category
                                      JOIN languages_has_links_category USING(idlink_category)
                                      WHERE idlanguage=?', array(1)) as $v) {
            $result[$v->idlink_category] = $v->name;
        }
        return $result;
    }

    /**
     * nacitani slideshows (home.tpl)
     *
     * @since 1.58
     * @param void
     * @return PDOCursor vysledny kurzor
     */
    public function getListSlideshows() {
        return $this->db->rawQuery('SELECT
                                    users.login,
                                    users.alias,
                                    slideshows.author,
                                    slideshows.path,
                                    slideshows.description
                                    FROM slideshows
                                    LEFT JOIN users USING(iduser)
                                    WHERE slideshows.confirmed=1 AND slideshows.visible=1
                                    ORDER BY idslideshow ASC');
    }

    /**
     * nacitani novinek (home.tpl)
     *
     * @since 1.34
     * @param string limit sql limit pro spravne strankovani
     * @return PDOCursor vysledny kurzor
     */
    public function getListNews($limit) {
        return $this->db->rawQuery('SELECT
                                    users.login,
                                    users.alias,
                                    news_icons.name icon_name,
                                    news_icons.path icon_path,
                                    idnews,
                                    languages_has_news.name,
                                    languages_has_news.description,
                                    news.added added
                                    FROM news
                                    JOIN languages_has_news USING(idnews)
                                    JOIN languages USING(idlanguage)
                                    JOIN users USING(iduser)
                                    JOIN news_icons USING(idnews_icon)
                                    WHERE languages.code=?
                                    ORDER BY news.added DESC ' . $limit, array($this->current_language));
    }

    /**
     * nacteni konkretni novinky (home_novinky.tpl)
     *
     * @since 1.48
     * @param int idnews cislo radku novinky
     * @return PDOCursor vysledny kurzor
     */
    public function getNews($idnews) {
        return $this->db->rawQuery('SELECT
                                    users.login,
                                    users.alias,
                                    news_icons.name icon_name,
                                    news_icons.path icon_path,
                                    languages_has_news.name,
                                    languages_has_news.description,
                                    news.added added
                                    FROM news
                                    JOIN languages_has_news USING(idnews)
                                    JOIN languages USING(idlanguage)
                                    JOIN users USING(iduser)
                                    JOIN news_icons USING(idnews_icon)
                                    WHERE languages.code=? AND idnews=?', array($this->current_language, $idnews));
    }

    /**
     * nacteni download sekci (download.tpl, downloads.tpl, downloads_deactivated.tpl, downloads_category.tpl)
     *
     * @since 1.64
     * @param int|null parent cislo rodice
     * @param string language kod jazyka
     * @return PDOCursor vysledny kurzor
     */
    public function getListDownloadCategory($parent = null, $language = null) {
        return $this->db->rawQuery('SELECT iddownload_category, parent, rewrite, languages_has_downloads_category.name, languages_has_downloads_category.description FROM downloads_category
                                    JOIN languages_has_downloads_category USING(iddownload_category)
                                    JOIN languages USING(idlanguage)
                                    WHERE languages.code=? AND parent'.($parent ? '=?' : ' IS ?').'
                                    ORDER BY downloads_category.rank ASC', array($language ?: $this->current_language, $parent));
    }

    /**
     * staticke nacitani kategorie downloadu (crate)
     *
     * @since 3.52
     * @param PDODatabase db ukazatel databaze
     * @param null|int parent rodickovska skupina
     * @return PDOCursor vysledny kurzor
     */
    public static function getStaticListDownloadCategory($db, $parent = null) {
        return $db->rawQuery('SELECT iddownload_category, parent, rewrite, languages_has_downloads_category.name, languages_has_downloads_category.description FROM downloads_category
                              JOIN languages_has_downloads_category USING(iddownload_category)
                              JOIN languages USING(idlanguage)
                              WHERE languages.code=? AND parent'.($parent ? '=?' : ' IS ?').'
                              ORDER BY downloads_category.rank ASC', array('cs', $parent));
    }

    /**
     * nacteni ID polozky podle rewrite (download.tpl)
     *
     * @since 1.64
     * @param string rewrite text z adresy
     * @return int|null iddownload_category
     */
    public function getDownloadCategoryID($rewrite) {
        $cur = $this->db->query('downloads_category', 'iddownload_category', 'rewrite=?', array($rewrite))->getFirst();
        return $cur ? $cur->iddownload_category : null;
    }

    /**
     * nacteni radku konkretni download sekce (downloads.tpl)
     *
     * @since 1.94
     * @param int id id radku
     * @param string|null index nazev indexu, nepovinny
     * @return PDOCursorData|string vysledny datovy kurzor
     */
    public function getDownloadCategory($id, $index = null) {
        $c = $this->db->rawQuery('SELECT parent, rewrite, languages_has_downloads_category.name, languages_has_downloads_category.description FROM downloads_category
                                  JOIN languages_has_downloads_category USING(iddownload_category)
                                  JOIN languages USING(idlanguage)
                                  WHERE languages.code=? AND iddownload_category=?', array($this->current_language, $id))->getFirst();
        return $index ? (isset($c->$index) ? $c->$index : null) : $c;
    }

    /**
     * nacteni radku podle rewrite adresy (crate, download.tpl)
     * - jeden radek
     *
     * @since 1.64
     * @param string rewrite rewrite nazev
     * @param string|null index nezav indexu, nepovinny, jinak vraci cursor
     * @return PDOCursorData|string vysledny datovy kurzor
     */
    public function getDownloadCategoryRewrite($rewrite, $index = null) {
        $c = $this->db->rawQuery('SELECT iddownload_category, parent, rewrite, languages_has_downloads_category.name, languages_has_downloads_category.description FROM downloads_category
                                  JOIN languages_has_downloads_category USING(iddownload_category)
                                  JOIN languages USING(idlanguage)
                                  WHERE languages.code=? AND rewrite=?', array($this->current_language, $rewrite))->getFirst();
        return $index ? (isset($c->$index) ? $c->$index : null) : $c;
    }

    /**
     * vytvoreni rewrite cesty podle download sekce (home.tpl)
     *
     * @since 1.92
     * @param int id cislo download sekce
     * @return string url cesta
     */
    public function getDownloadUrlBuildRewrite($id) {
        $c = $this->db->rawQuery('SELECT t1.rewrite r1, t2.rewrite r2, t3.rewrite r3, t4.rewrite r4, t5.rewrite r5 FROM downloads_category AS t1
                                    LEFT JOIN downloads_category t2 ON t1.parent = t2.iddownload_category
                                    LEFT JOIN downloads_category t3 ON t2.parent = t3.iddownload_category
                                    LEFT JOIN downloads_category t4 ON t3.parent = t4.iddownload_category
                                    LEFT JOIN downloads_category t5 ON t4.parent = t5.iddownload_category
                                    WHERE t1.iddownload_category=?', array($id))->getFirst();
        return implode('/', array_reverse(array_filter((array) $c)));
    }

    /**
     * vytvoreni id cesty podle download sekce (downloads.tpl, downloads_deactivated.tpl)
     *
     * @since 1.96
     * @param int id cislo download sekce
     * @return string url cesta
     */
    public function getDownloadUrlBuildID($id) {
        $c = $this->db->rawQuery('SELECT t1.iddownload_category r1, t2.iddownload_category r2, t3.iddownload_category r3, t4.iddownload_category r4, t5.iddownload_category r5 FROM downloads_category AS t1
                                    LEFT JOIN downloads_category t2 ON t1.parent = t2.iddownload_category
                                    LEFT JOIN downloads_category t3 ON t2.parent = t3.iddownload_category
                                    LEFT JOIN downloads_category t4 ON t3.parent = t4.iddownload_category
                                    LEFT JOIN downloads_category t5 ON t4.parent = t5.iddownload_category
                                    WHERE t1.iddownload_category=?', array($id))->getFirst();
        return implode('-', array_reverse(array_filter((array) $c)));
    }

    /**
     * nacteni pole download sekci (downloads.tpl, upload_downloads.tpl)
     *
     * @since 1.72
     * @param int|null ignore ignorace urcitych polozek
     * @return array pole sekci
     */
    public function getArrayListDownloadsCategory($ignore = null) {
        $result = array();
        foreach ($this->getListDownloadCategory(null, 'cs') as $v0) {                   // #0
            if ($ignore != $v0->iddownload_category) {  // ignorace v0
                $result[$v0->iddownload_category] = $v0->name;
                foreach ($this->getListDownloadCategory($v0->iddownload_category, 'cs') as $v1) { // #1
                    if ($ignore != $v1->iddownload_category) {  // ignorace v1
                        $result[$v1->iddownload_category] = $v0->name.' / '.$v1->name;
                        foreach ($this->getListDownloadCategory($v1->iddownload_category, 'cs') as $v2) { // #2
                            if ($ignore != $v2->iddownload_category) {  // ignorace v2
                                $result[$v2->iddownload_category] = $v0->name.' / '.$v1->name.' / '.$v2->name;
                                foreach ($this->getListDownloadCategory($v2->iddownload_category, 'cs') as $v3) { // #3
                                    if ($ignore != $v3->iddownload_category) {  // ignorace v3
                                        $result[$v3->iddownload_category] = $v0->name.' / '.$v1->name.' / '.$v2->name.' / '.$v3->name;
                                        foreach ($this->getListDownloadCategory($v3->iddownload_category, 'cs') as $v4) { // #4
                                            if ($ignore != $v4->iddownload_category) {  // ignorace v4
                                                $result[$v4->iddownload_category] = $v0->name.' / '.$v1->name.' / '.$v2->name.' / '.$v3->name.' / '.$v4->name;
                                            } // ignore
                                        }
                                    } // ignore
                                }
                            } // ignore
                        }
                    } // ignore
                }
            } // ignore
        }
        return $result;
    }

    /**
     * nacteni poctu download polozek pro konkretni sekci (downloads.tpl, downloads_deactivated.tpl, downloads_category.tpl)
     *
     * @since 2.00
     * @param int idcategory id download kategorie
     * @param bool|null deleted true pro spocitani smazanych, false pro spocitani aktivnich, null pro spocitani vsech
     * @return int pocet polozek
     */
    public function getCountDownloadInCategory($idcategory, $deleted = false) {
        return $this->db->query('downloads', 'COUNT(iddownload_category) pocet', ($deleted === null ? '1' : ($deleted ? 'deleted IS NOT NULL' : 'deleted IS NULL')) . ' AND confirmed=1 AND iddownload_category=?', array($idcategory))->getFirst()->pocet;
    }

    /**
     * nacteni postu aktivnich objektu pro konkretni sekci (download.tpl)
     *
     * @since 2.54
     * @param int idcategory id download kategorie
     * @return int pocet polozek
     */
    public function getCountDownloadItems($idcategory) {
        return $this->db->query('downloads', 'COUNT(iddownload_category) pocet', 'deleted IS NULL AND confirmed=1 AND visible=1 AND iddownload_category=?', array($idcategory))->getFirst()->pocet;
    }

    /**
     * nacteni konkretni polozky downloads (crate, download.tpl, downaload_autor.tpl)
     *
     * @since 1.96
     * @param int id id radku
     * @param string|null index
     * @return PDOCursorData|string vysledny datovy kurzor
     */
    public function getDownload($id, $index = null) { //confirmed, visible
        $c = $this->db->rawQuery('SELECT downloads.iddownload, users.login, users.alias, author, rewrite, iddownload_category, picture, polygons, downloads.added, downloads.edited,
                                      GROUP_CONCAT(DISTINCT trainz_versions.name ORDER BY trainz_versions.rank SEPARATOR \', \') versions,
                                      languages_has_downloads.name, languages_has_downloads.description
                                    FROM downloads
                                    LEFT JOIN users USING(iduser)
                                    JOIN downloads_has_trainz_cdp USING(iddownload)
                                    JOIN trainz_cdp USING(idtrainz_cdp)
                                    LEFT JOIN trainz_cdp_has_trainz_versions USING(idtrainz_cdp)
                                    LEFT JOIN trainz_versions USING(idtrainz_version)
                                    JOIN languages_has_downloads USING(iddownload)
                                    JOIN languages USING(idlanguage)
                                    WHERE downloads.deleted IS NULL AND downloads.confirmed=1 AND downloads.visible=1 AND languages.code=? AND downloads.iddownload=?
                                    GROUP BY downloads.iddownload', array($this->current_language, $id))->getFirst();
        return $index ? (isset($c->$index) ? $c->$index : null) : $c;
    }

    /**
     * nacteni downloads polozek (download.tpl)
     *
     * @since 1.96
     * @param int iddownload_category id download sekce
     * @return PDOCursor vysledny kurzor
     */
    public function getListDownloads($iddownload_category) {
        return $this->db->rawQuery('SELECT downloads.iddownload, users.login, users.alias, author, rewrite, picture, polygons, downloads.added, downloads.edited,
                                      GROUP_CONCAT(DISTINCT trainz_versions.name ORDER BY trainz_versions.rank SEPARATOR \', \') versions,
                                      languages_has_downloads.name, languages_has_downloads.description
                                    FROM downloads
                                    LEFT JOIN users USING(iduser)
                                    JOIN downloads_has_trainz_cdp USING(iddownload)
                                    JOIN trainz_cdp USING(idtrainz_cdp)
                                    LEFT JOIN trainz_cdp_has_trainz_versions USING(idtrainz_cdp)
                                    LEFT JOIN trainz_versions USING(idtrainz_version)
                                    JOIN languages_has_downloads USING(iddownload)
                                    JOIN languages USING(idlanguage)
                                    WHERE downloads.deleted IS NULL AND downloads.confirmed=1 AND downloads.visible=1 AND languages.code=? AND downloads.iddownload_category=?
                                    GROUP BY downloads.iddownload
                                    ORDER BY languages_has_downloads.name ASC', array($this->current_language, $iddownload_category));
    }

    /**
     * staticke nacitani downloadu podle id katagorie (crate)
     *
     * @since 3.52
     * @param PDODatabase db ukazatel databaze
     * @param int iddownload_category cislo skupiny
     * @return PDOCursor vysledny kurzor
     */
    public static function getStaticListDownloads($db, $iddownload_category) {
        return $db->rawQuery('SELECT downloads.iddownload, users.login, users.alias, author, rewrite, picture, polygons, downloads.added, downloads.edited,
                                GROUP_CONCAT(DISTINCT trainz_versions.name ORDER BY trainz_versions.rank SEPARATOR \', \') versions,
                                languages_has_downloads.name, languages_has_downloads.description
                              FROM downloads
                              LEFT JOIN users USING(iduser)
                              JOIN downloads_has_trainz_cdp USING(iddownload)
                              JOIN trainz_cdp USING(idtrainz_cdp)
                              LEFT JOIN trainz_cdp_has_trainz_versions USING(idtrainz_cdp)
                              LEFT JOIN trainz_versions USING(idtrainz_version)
                              JOIN languages_has_downloads USING(iddownload)
                              JOIN languages USING(idlanguage)
                              WHERE downloads.deleted IS NULL AND downloads.confirmed=1 AND downloads.visible=1 AND languages.code=? AND downloads.iddownload_category=?
                              GROUP BY downloads.iddownload
                              ORDER BY languages_has_downloads.name ASC', array('cs', $iddownload_category));
    }

    /**
     * nacteni pole cdp pro prilinkovani v kuidech (downloads_kuids.tpl)
     *
     * @since 2.72
     * @param void
     * @return array pole položek
     */
    public function getArrayListTrainzCDP() {
        $result = array();
        foreach ($this->db->rawQuery('SELECT idtrainz_cdp, iddownload, trainz_cdp.name cdp_name, languages_has_downloads.name FROM trainz_cdp
                                        JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                        JOIN languages_has_downloads USING(iddownload)
                                        JOIN languages USING(idlanguage)
                                        WHERE languages.code=?', array('cs')) as $v) {
            $result[$v->idtrainz_cdp] = '[ID: #' . $v->iddownload . '], ' . $v->name . '&nbsp;&nbsp;>&nbsp;&nbsp;' . $v->cdp_name . '';
        }
        return $result;
    }

    /**
     * nacteni pole verzi (downloads.tpl, index.tpl)
     *
     * @since 1.72
     * @param void
     * @return array pole polozek
     */
    public function getArrayListTrainzVersion() {
        $result = array();
        foreach ($this->db->query('trainz_versions', 'idtrainz_version, name', null, null, null, null, 'rank ASC') as $v) {
            $result[$v->idtrainz_version] = $v->name;
        }
        return $result;
    }

    /**
     * nacteni poslednich polozek downloadu (home.tpl)
     *
     * @since 1.76
     * @param int limit pocet polozek na uvodni strance
     * @return PDOCursor vysledny kurzor
     */
    public function getListLastDownloads($limit) {
        return $this->db->rawQuery('SELECT iddownload, iddownload_category, rewrite, _d.picture, _d.added, _d.edited, _u.login, _u.alias, _d.author, _lhd.name FROM downloads _d
                                    JOIN languages_has_downloads _lhd USING(iddownload)
                                    JOIN languages USING(idlanguage)
                                    LEFT JOIN users _u USING(iduser)
                                    WHERE _d.deleted IS NULL AND _d.confirmed=1 AND _d.visible=1 AND languages.code=?
                                    ORDER BY IF(_d.edited > _d.added, _d.edited, _d.added) DESC
                                    LIMIT 0,'.$limit, array($this->current_language));
    }

    /**
     * nacteni posledniho datumu
     * - aby se nemuselo oznacovat v historii defaulne
     *
     * @since 3.46
     * @param void
     * @return PDOCursor vysledny kurzor
     */
    public function getDateLastDownloads() {
        return $this->db->rawQuery('SELECT DATE(IF(edited > added, edited, added)) datum FROM downloads
                                    WHERE deleted IS NULL AND confirmed=1 AND visible=1
                                    GROUP BY datum
                                    ORDER BY datum DESC
                                    LIMIT 1')->getFirst()->datum;
    }

    /**
     * poslani (pridani) notifikace (upload_registrace.tpl, upload_slideshows.tpl, upload_download.tpl, upload_messages.tpl)
     * - admin <--> user
     *
     * @since 1.36
     * @param string from od uzivatele
     * @param string|null to pro uzivatele
     * @param string type typ notifikace (message, registration, slideshow, download)
     * @param int|null state_id id prislusneho radku prislusne tabulky podle typu (nova polozka)
     * @param int|null state_old_id id duplikatniho radku prislusne tabulky podle typu ktery se vyplnuje pri aktualizaci objektu, (stara polozka kdyz se provadi aktualizacni duplikace)
     * @param string subject predmet
     * @param string message zprava
     * @return void
     */
    public function addNotification($from, $to, $type, $state_id, $state_old_id, $subject, $message) {
        $cv = classes\ContentValues::init()
            ->put('from_id', $from)
            ->put('to_id', $to)
            ->put('type', $type)
            ->put('state_id', $state_id)
            ->put('state_old_id', $state_old_id)
            ->put('subject', $subject)
            ->put('message', $message)
            ->put('ip', classes\Core::getIp(null))          // vlozeni IP
            ->put('agent', classes\Core::getUserAgent())    // vlozeni Agenta
            ->putDate('added');
        $_id = $this->db->insert('notifications', $cv);

      switch ($type) {  // rozdelovani rozesilani upominkovych emailu podle typu
        case self::TYPE_MESSAGE:  // uporozneni na zpravu
          classes\Emailer::factory(classes\Emailer::HTML)
              ->addTo($this->db->query('users', 'email', 'iduser=?', array($to))->getFirst()->email)  // nacteni emailu
              ->setFrom('admin@trainz.cz')
              ->setSubject('Byla přijata nová zpráva ze stránek Trainz.cz')
              ->setMessageArgs('Dobrý den,<br /><br />Byla přijata nová zpráva ze stránek Trainz.cz<br /><br />----------------------------<br />Předmět zprávy: %s<br />----------------------------<br /><br />Pro přečtení zprávy přejděte na stránky <a href="%s">Trainz.cz</a><br /><br />--<br />Trainz.cz', $subject, $this->weburl)
              ->send();
        break;

        case self::TYPE_REGISTRATION: // registrace
        case self::TYPE_SLIDESHOW:  // slideshow
        case self::TYPE_DOWNLOAD: // download
          $message = null;
          switch ($type) {
            case self::TYPE_REGISTRATION:
              $c = $this->db->query('users', 'login, alias, reason', 'iduser=?', array($state_id))->getFirst();
              $subject = $this->getMsgTypeNotification(self::TYPE_REGISTRATION);
              $message = sprintf('Dobrý den,<br /><br />%s<br /><br />----------------------------<br />Registrující: %s<br />Důvod registrace: %s<br />----------------------------<br /><a href="%s">Přejít do administrace</a><br />----------------------------<br /><br />--<br />Trainz.cz',
                                    $subject,
                                    $c->login.($c->alias ? ' ('.$c->alias.')' : null),
                                    $c->reason,
                                    $this->weburl_admin
                                    );
            break;

            case self::TYPE_SLIDESHOW:
              if ($state_old_id) {  // aktualizace
                $c = $this->db->query('slideshows', 'description', 'idslideshow=?', array($state_old_id))->getFirst();
                $subject = $this->getMsgTypeNotification(self::TYPE_SLIDESHOW.'_edit');
                $message = sprintf('Dobrý den,<br /><br />%s<br /><br />----------------------------<br />ID: z #%d na #%d<br />Screenshot: %s<br />----------------------------<br /><a href="%s">Přejít do administrace</a><br />----------------------------<br /><br />--<br />Trainz.cz', $subject, $state_old_id, $state_id, $c->description, $this->weburl_admin);
              } else {  // nove
                $c = $this->db->query('slideshows', 'description', 'idslideshow=?', array($state_id))->getFirst();
                $subject = $this->getMsgTypeNotification(self::TYPE_SLIDESHOW);
                $message = sprintf('Dobrý den,<br /><br />%s<br /><br />----------------------------<br />ID: #%d<br />Screenshot: %s<br />----------------------------<br /><a href="%s">Přejít do administrace</a><br />----------------------------<br /><br />--<br />Trainz.cz', $subject, $state_id, $c->description, $this->weburl_admin);
              }
            break;

            case self::TYPE_DOWNLOAD:
              if ($state_old_id) {  // aktualizace
                $c = $this->db->rawQuery('SELECT _lhd.name FROM downloads
                                          JOIN languages_has_downloads _lhd USING(iddownload)
                                          JOIN languages USING(idlanguage)
                                          WHERE languages.code=? AND iddownload=?', array('cs', $state_old_id))->getFirst();
                $subject = $this->getMsgTypeNotification(self::TYPE_DOWNLOAD.'_edit');
                $message = sprintf('Dobrý den,<br /><br />%s<br /><br />----------------------------<br />ID: z #%d na #%d<br />Objekt/mapa: %s<br />----------------------------<br /><a href="%s">Přejít do administrace</a><br />----------------------------<br /><br />--<br />Trainz.cz', $subject, $state_old_id, $state_id, $c->name, $this->weburl_admin);
              } else {  // nove
                $c = $this->db->rawQuery('SELECT _lhd.name FROM downloads
                                          JOIN languages_has_downloads _lhd USING(iddownload)
                                          JOIN languages USING(idlanguage)
                                          WHERE languages.code=? AND iddownload=?', array('cs', $state_id))->getFirst();
                $subject = $this->getMsgTypeNotification(self::TYPE_DOWNLOAD);
                $message = sprintf('Dobrý den,<br /><br />%s<br /><br />----------------------------<br />ID: #%d<br />Objekt/mapa: %s<br />----------------------------<br /><a href="%s">Přejít do administrace</a><br />----------------------------<br /><br />--<br />Trainz.cz', $subject, $state_id, $c->name, $this->weburl_admin);
              }
            break;
          }

          foreach ($this->global_configure['notification_email'][$type] as $v) {  // cyklicke posilani
            $_usr = $this->db->query('users', 'email', 'iduser=?', array($v))->getFirst();
            if ($_usr) {  // pokud v konfigu definovany uzivatel existuje
              classes\Emailer::factory(classes\Emailer::HTML)
                  ->addTo($_usr->email)  // nacteni emailu
                  ->setFrom('admin@trainz.cz')
                  ->setSubject($subject)
                  ->setMessage($message, true)
                  ->send();
            }
          }
        break;
      }
      return $_id;
    }

    /**
     * nacitani poctu novych zprav (upload_menu.tpl)
     *
     * @since 2.24
     * @param int id_user id uzivatele
     * @return int pocet polozek
     */
    public function getCountMessage($id_user) {
      return $this->db->query('notifications', 'COUNT(idnotification) pocet', 'type=? AND to_id=? AND handled_id IS NULL AND deleted IS NULL', array(self::TYPE_MESSAGE, $id_user))->getFirst()->pocet;
    }

    /**
     * nacitani poctu nepotvrzenych notifikaci pro konkretni typ (a:index.tpl)
     *
     * @since 2.24
     * @param string type typ notifikace
     * @return int pocet polozek
     */
    public function getCountNotification($type) {
      return $this->db->query('notifications', 'COUNT(idnotification) pocet', 'type=? AND IF(type=?, to_id=?, 1) AND handled_id IS NULL AND deleted IS NULL', array($type, self::TYPE_MESSAGE, $this->user->getId()))->getFirst()->pocet;
    }

    /**
     * nacteni listu nepotvrzenych notifikaci pro konktretni typ (a:index.tpl)
     *
     * @since 2.24
     * @param string type typ notifikace
     * @return PDOCursor vysledny kurzor
     */
    public function getListNotification($type) {
      return $this->db->query('notifications', 'idnotification, type, added, state_old_id', 'type=? AND IF(type=?, to_id=?, 1) AND handled_id IS NULL AND deleted IS NULL', array($type, self::TYPE_MESSAGE, $this->user->getId()), null, null, 'added DESC', '0, 10');
    }

    /**
     * nacitani zpravy notifikace dle typu (a:index.tpl)
     *
     * @since 1.52
     * @param string type text typu
     * @return string text hlasky pro konkretni typ
     */
    public function getMsgTypeNotification($type) {
      $msg = array(
        self::TYPE_REGISTRATION => 'Byl zaregistrován nový uživatel, který čeká na schválení.',
        self::TYPE_DOWNLOAD => 'Byl přidán nový objekt/mapa, který čeká na schválení.',  // add
        self::TYPE_DOWNLOAD.'_edit' => 'Byl aktualizován objekt/mapa, který čeká na schválení.', // edit
        self::TYPE_SLIDESHOW => 'Byl přidán nový screenshot, který čeká na schválení.', // add
        self::TYPE_SLIDESHOW.'_edit' => 'Byl aktualizován screenshot, který čeká na schválení.',  // edit
        self::TYPE_MESSAGE => 'Byla přijata nová zpráva.',
      );
      return $msg[$type];
    }

    /**
     * nacitani pole pro select (upload_messages.tpl)
     *
     * @since 2.66
     * @param void
     * @return array zpracovane pole
     */
    public function getArrayListUploadMessages() {
      $result = array();
      foreach ($this->global_configure['notification'] as $i => $v) {
        if (is_numeric($v)) { // pokud je value cislo
          $c = $this->db->rawQuery('SELECT login, alias, roles.name FROM users
                                    JOIN roles USING(idrole)
                                    WHERE iduser=?', array($v))->getFirst();
          if ($c) {
            $result[$i] = $c->name . ' - ' . $c->login . ($c->alias ? ' (' . $c->alias . ')' : null);
          }
        }
      }
      return $result;
    }

    /**
     * nacteni odkazu podle kategorie (odkazy.tpl)
     *
     * @since 1.42
     * @param int idlink_category cislo kategorie
     * @return PDOCursor vysledny kurzor
     */
    public function getListLinks($idlink_category) {
      return $this->db->query('links', 'name, url, picture', 'idlink_category=?', array($idlink_category), null, null, 'rank ASC');
    }

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
        break;
      }
    }
  }



  /**
   * autorizacni trida do adminu
   *
   * @package unstable
   * @author geniv
   * @version 1.04
   */
  class AdminUserAuthenticator implements classes\IAuthenticator {
    private $db = null;
    // defaultni konstruktor
    public function __construct($db) { $this->db = $db; }
    // hlavni metoda
    public function authenticate(array $credentials) {
      list($login, $pass) = $credentials;
      $hash = classes\Core::getCleverHash($login, $pass);
      // musi byt nesmazany, moderator nebo admin, potvrzeny
      $c = $this->db->rawQuery('SELECT iduser, roles.name role, users.alias, users.avatar FROM users
                                JOIN roles USING(idrole)
                                WHERE login=? AND hash=? AND deleted IS NULL AND roles.idrole>? AND confirmed=1', array($login, $hash, 1)); // nesmi byt 1
      $row = $c->getFirst();
      if ($row) {
        $c->close();  //zavreni cursoru
        $data = array(
            'login' => $login,
            'alias' => $row->alias,
            'avatar' => $row->avatar,
            //~ 'kuid' => $row->kuid, , kuid
          );
        return new classes\Identity(intval($row->iduser), array($row->role), $data);
      }
      return null;
    }
  }



  /**
   * autorizacni trida do upload sekci
   *
   * @package unstable
   * @author geniv
   * @version 2.00
   */
  class UploadUserAuthenticator implements classes\IAuthenticator {
    private $db = null;
    // defaultni konstruktor
    public function __construct($db) { $this->db = $db; }
    // hlavni metoda
    public function authenticate(array $credentials) {
      list($login, $pass) = $credentials;
      $hash = classes\Core::getCleverHash($login, $pass);
      // musi byt nesmazany, potvrzeny
      $c = $this->db->rawQuery('SELECT iduser, roles.name role, users.alias, users.avatar FROM users
                                JOIN roles USING(idrole)
                                WHERE login=? AND hash=? AND deleted IS NULL AND confirmed=1', array($login, $hash));
      $row = $c->getFirst();
      if ($row) {
        $c->close();  //zavreni cursoru
        $data = array(
            'login' => $login,
            'alias' => $row->alias,
            'avatar' => $row->avatar,
            //~ 'kuid' => $row->kuid, , kuid
          );
        return new classes\Identity(intval($row->iduser), array($row->role), $data);
      }
      return null;
    }
  }