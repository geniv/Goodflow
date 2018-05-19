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
     * @version 3.56
     */
    final class Crate extends classes\ObjectArray {
        const DATABASE_NAME = 'timer_task.sqlite3';

        const DATE_NORMAL = 'H:i:s (d.m.Y)';  // normalni datumovy format
        const DATE_DIFF = '<span>%a</span> <strong>%H:%I:%S</strong>';  // rozdilovy datumovy format

        /**
         * defaultni konstruktor
         *
         * @since 1.00
         * @param array pole vstupni pole
         */
        public function __construct($pole) {
            parent::__construct($pole);

            // kontrola zavislosti
            classes\Core::checkDependency(array(
                    'global_config.php',
                    'database_config.php',
                ));

            // nacitani hlavni konfigurace *******************************************
            $db_conf = classes\Configurator::decode('database_config.php');
            classes\Core::checkValidity($db_conf);
            $this->configure = classes\Configurator::decode('global_config.php');
            $this->crate = $this;

            // nacitani kofigurace z db konfigurace **********************************
            classes\ErrorLoger::setEmail($db_conf['errorloger']['email']);
            classes\ErrorLoger::setPrintStdOut(!$this->configure['system']['stable']);
            classes\ErrorLoger::setInstantlySend($this->configure['system']['stable']);

            // nastavovani weburl do crate *******************************************
            $this->weburl = classes\Core::getUrl();

            // nastaveni time zony ***************************************************
            classes\DateAndTime::setDateTimezone($this->configure['date_timezone']);

            // databaze **************************************************************
            $this->db = MyDBHandler::getFactoryDatabase($db_conf['factory']);
            //TODO nemaze uzivatele, neni prehled o uzivatelych!
            //TODO v pripade uziti FK se musi podpora zapinat pri kazdem sahani do DB!

            // naplneni tabulky z htpasswd
            if ($this->db->beginTransaction()) {
                foreach (classes\Htpasswd::users(true) as $u => $h) {
                    if (!$this->db->query('users', 'iduser', 'login=?', array($u))->getFirst()) {
                        $cv = classes\ContentValues::init()->put('login', $u)->put('hash', $h);
                        $this->db->insert('users', $cv);
                    }
                }
                $this->iduser = $this->db->query('users', 'iduser', 'login=?', array($_SERVER['PHP_AUTH_USER']))->getFirst()->iduser;
                $this->db->endTransaction();
            }

            // router model **********************************************************
            $this->lang_url = 'lang';
            $model = array(
                'page',
            );

            // menu ******************************************************************
            $this->menu = classes\Menu::simple($this->configure['menu'], $model, 'home');
            $this->uri = array_filter($this->menu->getUri());

            // tpl *******************************************************************
            $this->tpl = new classes\Tpl($this->configure['tpl']);
            $this->main_index_tpl = 'index';    // prvni stranka

            // title stranek
            $this->title = $this->configure['project_name'];

            // mazani automaticky vygenerovaneho obsahu ******************************
            if ($this->configure['system']['clearall']) {   // mazani tpl cache
                $this->tpl->clearAll();
            }
//TODO implements: grund js
            if (!$this->configure['system']['stable']) {
                // generovani css
                classes\NodeJS::less2css('less/bootstrap.less', 'css/bootstrap.css');
                // generovani js (bere z src a konvertuje do js)
                classes\JsUtils::generate('src/functions.js', 'js/functions.js', array(
                    'weburl' => $this->weburl,
                ));
            }
        }

        /**
         * ajaxova rest metoda
         *
         * @since 1.06
         * @param void
         * @return string navratovy text
         */
        public static function getAjax() {
            $weburl = classes\Core::getUrl();

            $db_conf = classes\Configurator::decode('database_config.php');
            $db = MyDBHandler::getFactoryDatabase($db_conf['factory']);

            $iduser = null;
            if ($c = $db->query('users', 'iduser', 'login=?', array($_SERVER['PHP_AUTH_USER']))->getFirst()) {
                $iduser = $c->iduser;
            }

            switch (isset($_POST['type']) ? $_POST['type'] : null) {
                default:
                    return 'nothing ...';


                // sprava projektu ********************************************************


                case 'addproject':  // pridavani projektu
                    if ($db->beginTransaction()) {
                        $cv = classes\ContentValues::init()->put('iduser', $iduser)->put('name', $_POST['name']);
                        $db->insertOrThrow('projects', $cv);
                        return $db->endTransaction();
                    }
                break;


                case 'editproject': // editace projektu
                    if ($db->beginTransaction()) {
                        $cv = classes\ContentValues::init()->put('name', $_POST['name']);
                        $db->updateOrThrow('projects', $cv, 'iduser=? AND idproject=?', array($iduser, $_POST['id']));
                        return $db->endTransaction();
                    }
                break;


                case 'delproject':  // mazani projektu
                    if ($db->beginTransaction()) {
                        $db->delete('tasks', 'idproject=?', array($_POST['id']));
                        $db->delete('projects', 'iduser=? AND idproject=?', array($iduser, $_POST['id']));
                        return $db->endTransaction();
                    }
                break;


                case 'restoreproject':  // obnoveni projektu z archivu
                    if ($db->beginTransaction()) {
                        $cv = classes\ContentValues::init()->putNull('archive');
                        $db->update('projects', $cv, 'iduser=? AND idproject=?', array($iduser, $_POST['id']));
                        return $db->endTransaction();
                    }
                break;


                case 'archiveproject':  // archivace projektu
                    if ($db->beginTransaction()) {
                        $cv = classes\ContentValues::init()->putDate('archive');
                        $db->update('projects', $cv, 'iduser=? AND idproject=?', array($iduser, $_POST['id']));

                        $cv = classes\ContentValues::init()->putDate('stop');
                        $db->update('tasks', $cv, 'idproject=? AND stop IS NULL', array($_POST['id']));

                        foreach ($db->query('tasks', 'idtask', 'idproject=? AND pause_start IS NOT NULL', array($_POST['id'])) as $task) {
                            self::processPause($db, $_POST['id'], $task->idtask);
                        }
                        return $db->endTransaction();
                    }
                break;


                // sprava tasku ********************************************************


                case 'addtask': // pridavani tasku
                    if ($db->beginTransaction()) {
                        $cv = classes\ContentValues::init()->put('idproject', $_POST['id'])->putDate('start');
                        $db->insert('tasks', $cv);
                        return $db->endTransaction();
                    }
                break;


                case 'deltask': // mazani tasku
                    if ($db->beginTransaction()) {
                        $db->delete('tasks', 'idproject=? AND idtask=?', array($_POST['id'], $_POST['task']));
                        return $db->endTransaction();
                    }
                break;


                case 'usedtask':    // pouzity task
                    if ($db->beginTransaction()) {
                        $cv = classes\ContentValues::init()->putBool('used', $_POST['state'] == 'true');
                        $db->update('tasks', $cv, 'idproject=? AND idtask=?', array($_POST['id'], $_POST['task']));
                        return $db->endTransaction();
                    }
                break;


                case 'stoptask':    // zastaveni ulohy
                    if ($db->beginTransaction()) {
                        if ($db->query('tasks', 'pause_start', 'idproject=? AND idtask=?', array($_POST['id'], $_POST['task']))->getFirst()->pause_start) {
                            self::processPause($db, $_POST['id'], $_POST['task']);
                        }
                        $cv = classes\ContentValues::init()->putDate('stop');
                        $db->update('tasks', $cv, 'idproject=? AND idtask=?', array($_POST['id'], $_POST['task']));
                        return $db->endTransaction();
                    }
                break;


                case 'pausetask':   // pozastaveni ulohy
                    if ($db->beginTransaction()) {
                        self::processPause($db, $_POST['id'], $_POST['task']);
                        return $db->endTransaction();
                    }
                break;


                case 'savedescription': // ulozeni poznamky
                    if ($db->beginTransaction()) {
                        $cv = classes\ContentValues::init()->put('description', $_POST['description']);
                        $db->update('tasks', $cv, 'idproject=? AND idtask=?', array($_POST['id'], $_POST['task']));
                        return $db->endTransaction();
                    }
                break;


                case 'activetask':  // aktivni uloha
                    $result = array();
                    if (!$db->inTransaction()) {
                        foreach ($db->query('projects', 'idproject, name', 'iduser=?', array($iduser)) as $proj) {

                            if (self::getCountActivate($db, $proj->idproject) > 0) {   // pokud je neco aktivovano
                                $result[$proj->idproject] = array(
                                    'name' => $proj->name,
                                    'list' => array(),
                                );
                            }

                            foreach ($db->query('tasks', 'idtask, start, stop, pause_start, pause_length', 'idproject=?', array($proj->idproject)) as $task) {
                                if (!$task->stop) {
                                    if ($task->pause_start) {
                                        $pause = $task->pause_start;

                                        $diff = classes\DateAndTime::different($task->start, strtotime($pause) - time() - $task->pause_length);
                                        $diff_pause = classes\DateAndTime::different($pause, time());
                                        $diff_sum = classes\DateAndTime::different($pause, time() + $task->pause_length);

                                        $result[$proj->idproject]['list'][$task->idtask] = array(
                                                'state' => 'pause',
                                                'name' => self::getFormatDate($diff, self::DATE_DIFF),
                                                'from' => self::getFormatDate($task->start, self::DATE_NORMAL),

                                                'pause' => self::getFormatDate($pause, self::DATE_NORMAL),
                                                'current' => self::getFormatDate($diff_pause, self::DATE_DIFF),
                                                'sum' => self::getFormatDate($diff_sum, self::DATE_DIFF),
                                            );
                                    } else {
                                        // pokud to normalne bezi
                                        $diff = classes\DateAndTime::different($task->start, time() - $task->pause_length);
                                        $result[$proj->idproject]['list'][$task->idtask] = array(
                                            'state' => 'run',
                                            'name' => self::getFormatDate($diff, self::DATE_DIFF),
                                            'from' => self::getFormatDate($task->start, self::DATE_NORMAL),
                                        );
                                    }
                                }
                            }
                        }
                    }
                    return json_encode($result);
                break;
            }

            return null;
        }

        /**
         * zpracovani pauzy
         *
         * @since 1.14
         * @param string db databazove spojeni
         * @param string id identifikator beziciho projektu
         * @param string task identifikator beziciho tasku
         * @return array upravena data
         */
        private static function processPause($db, $id, $task) {
            if ($c = $db->query('tasks', 'pause_start, pause_length', 'idproject=? AND idtask=?', array($id, $task))->getFirst()) {
                if (!$c->pause_start) {
                    $cv = classes\ContentValues::init()->putDate('pause_start');
                    return $db->update('tasks', $cv, 'idproject=? AND idtask=?', array($id, $task));
                } else {
                    $diff = classes\DateAndTime::different($c->pause_start, time());
                    $cv = classes\ContentValues::init()->put('pause_length', $c->pause_length + classes\DateAndTime::toSeconds($diff))->putNull('pause_start');
                    return $db->update('tasks', $cv, 'idproject=? AND idtask=?', array($id, $task));
                }
            }
            return null;
        }

        /**
         * pocitani aktivnich tasku
         *
         * @since 2.18
         * @param array db databazovy konektor
         * @return int cislo aktivnich projektu
         */
        private static function getCountActivate($db, $id) {
            return $db->query('tasks', 'COUNT(idtask) pocet', 'idproject=? AND stop IS NULL', array($id))->getFirst()->pocet;
        }


        // manipulacni metody ******************************************************


        /**
         * globalni date formatovac
         * - pro rozdily %a nahrazuje za "[cislo] [den]"
         *
         * @since 2.20
         * @param DateInterval|int date datum jako rozdil nebo ciselny
         * @param string format textovy format datumu
         * @return string naformatovane datum
         */
        public static function getFormatDate($date, $format) {
            if ($date instanceof \DateInterval) {
                // datumovy rozdil
                $days = classes\Core::getCzechPlural($date->days, array('den', 'dny', 'dnů'));
                return $date->format(str_replace('%a', '<em>' . $date->days . '</em> ' . $days, $format));
            } else {
                // klasicke datum
                return classes\DateAndTime::from($date)->format($format);
            }
        }

        /**
         * je aktivni konkretni task?
         *
         * @since 1.06
         * @param string id identifikator projektu
         * @param string task identifikator tasku
         * @return bool true pokud je aktivni konkretni task
         */
        public function isActiveTask($id, $task) {
            if ($c = $this->db->query('tasks', 'stop', 'idproject=? AND idtask=?', array($id, $task))->getFirst()) {
                return is_null($c->stop);
            }
            return null;
        }

        /**
         * je zapauzivany konkretni task?
         *
         * @since 2.14
         * @param string id identifikator projektu
         * @param string task identifikator tasku
         * @return bool true pokud je zapazuovany konkretni task
         */
        public function isPausedTask($id, $task) {
            if ($c = $this->db->query('tasks', 'pause_start', 'idproject=? AND idtask=?', array($id, $task))->getFirst()) {
                return !$c->pause_start;
            }
            return null;
        }

        /**
         * sumarizace hodnot z projektu
         *
         * @since 1.14
         * @param string id identifikator projektu
         * @return array pole hodnot: time a pause
         */
        public function summaryTask($id) {
            return $this->sqlSummaryTask('iduser=? AND idproject=?', array($this->iduser, $id));
        }

        /**
         * pocitani sumarizace nad sql dotazem
         *
         * @since 3.24
         * @param string where ast sql dotazu za where
         * @param array args pole argumentu pro sql dotaz
         * @return array pole hodnot pro vypsani
         */
        public function sqlSummaryTask($where, $args) {
            $sumtime = $sumpause = 0;
            $first = null;
            foreach ($this->db->rawQuery('SELECT start, stop, pause_length FROM projects
                                        JOIN tasks USING(idproject)
                                        WHERE ' . $where . ' AND iduser=? ORDER BY start ASC', array_merge($args, array($this->iduser))) as $task) {
                $sumtime += classes\DateAndTime::toSeconds(classes\DateAndTime::different($task->start, $task->stop));  // soucet sekund
                $sumpause += $task->pause_length; // soucat pauzy
                $first = $first ?: strtotime($task->start); // prevadi se na cislo
            }

            return array(
                'sum' => self::getFormatDate(classes\DateAndTime::different($first, $first + $sumtime), self::DATE_DIFF),    // vcetne pauzy
                'time' => self::getFormatDate(classes\DateAndTime::different($first, ($first + $sumtime) - $sumpause), self::DATE_DIFF),   // bez pauzy
                'pause' => self::getFormatDate(classes\DateAndTime::different($first, $first + $sumpause), self::DATE_DIFF),   // jen pauza

                'hours_sum' => classes\DateAndTime::correct(classes\DateAndTime::toHours($sumtime)),
                'hours_time' => classes\DateAndTime::correct(classes\DateAndTime::toHours($sumtime - $sumpause)),
                'hours_pause' => classes\DateAndTime::correct(classes\DateAndTime::toHours($sumpause)),
            );
        }
    }

    /**
     * databazovy layer
     *
     * @package stable
     * @author geniv
     * @version 1.06
     */
    class MyDBHandler extends classes\PDOHelper {

        // prekryta metoda helperu
        public function onCreate(classes\PDODatabase $db, $data = null) {

            // uzivatele
            $users = classes\SqlBuilder::create('users')
                ->column('iduser')->integer()->notNull()->primary()->autoIncrement()
                ->column('login')->varchar(30)->notNull()->unique()
                ->column('hash')->varchar(100)->notNull();

            // projekty
            $projects = classes\SqlBuilder::create('projects')
                ->column('idproject')->integer()->notNull()->primary()->autoIncrement()
                ->column('iduser')->integer()->notNull()
                ->column('name')->varchar(100)->notNull()
                ->column('archive')->datetime();

            // tasky
            $tasks = classes\SqlBuilder::create('tasks')
                ->column('idtask')->integer()->notNull()->primary()->autoIncrement()
                ->column('idproject')->integer()->notNull()
                ->column('start')->datetime()->notNull()
                ->column('stop')->datetime()
                ->column('description')->text()
                ->column('used')->bool()
                ->column('pause_start')->datetime()
                ->column('pause_length')->integer();

            switch ($db->getDriverName()) {
                case 'sqlite':
                    // uzivatele
                    $db->execSQL($users->getSQLite3());

                    // projekty
                    $db->execSQL($projects->getSQLite3());

                    // tasky
                    $db->execSQL($tasks->getSQLite3());
                break;
            }
        }
    }
