<?php
/*
 * mysqlexporter.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;

    /**
     * Exporter a importer do SQL databazi
     *
     * @package stable/pdo
     * @author geniv
     * @version 2.38
     */
    class SqlBackup {
        private $config = null;

        // nazvy bash programu na export a import
        const
            BASH_MYSQL_EXPORT = 'mysqldump',
            BASH_MYSQL_IMPORT = 'mysql',
            BASH_SQLITE2 = 'sqlite',
            BASH_SQLITE3 = 'sqlite3',
            BASH_GZIP = 'gzip',
            BASH_GUNZIP = 'gunzip';

        // parametry pro bash prikazy
        const
            MYSQL_HOST = '--host=%s',       // host
            MYSQL_USER = '--user=%s',       // uzivatel
            MYSQL_PASS = '--password=%s',   // heslo
            MYSQL_PORT = '--port=%d';       // port

        // bash prikazy na export a import
        const
            // mysql
            MYSQL_EXPORT = 'mysqldump %s %s',
            MYSQL_IMPORT = '%smysql %s',
            // sqlite2
            SQLITE2_EXPORT = 'sqlite %s ".dump %s" %s',
            SQLITE2_IMPORT = '%ssqlite %s',
            // sqlite3
            SQLITE3_EXPORT = 'sqlite3 %s ".dump %s" %s',
            SQLITE3_IMPORT = '%ssqlite3 %s';

        // nazvy driveru
        const
            TYPE_SQLITE2 = 'sqlite2',
            TYPE_SQLITE3 = 'sqlite3',
            TYPE_MYSQL = 'mysql';

        /**
         * defaultni konstruktor
         *
         * @since 2.02
         * @param array config konfiguracni pole databaze
         */
        public function __construct(array $config) {
            // driver ; host ; dbname ; user ; password ; port
            $default = array(   // implicitni hodnoty
                // povinne polozky
                'driver' => null,
                'dbname' => null,
                'user' => null,
                'password' => null,
                // volitelne polozky
                'host' => 'localhost',  // implicitne localhost / SQLite2|3 path
                'port' => null,
                // volitene nastaveni pro export - nastavuji se externe
                'output' => null,       // vystupni soubor
                'gzip' => false,        // zabalit vystup do gzip-u
                );
            $this->config = array_merge($default, $config);

            // kontrola povinych polozek
            if (!isset($this->config['driver'])) {
                throw new ExceptionSqlBackup('nedefinovany nebo spatny driver databaze!');
            }

            // prepis driveru
            $this->config['driver'] = strtolower($this->config['driver']);

            // kontrola existence programu
            switch ($this->config['driver']) {
                case self::TYPE_SQLITE2:
                    if (!Bash::isInstall(self::BASH_SQLITE2)) {
                        throw new ExceptionSqlBackup('neexistuje obsluzny program: '.self::BASH_SQLITE2);
                    }
                    break;

                case self::TYPE_SQLITE3:
                    if (!Bash::isInstall(self::BASH_SQLITE3)) {
                        throw new ExceptionSqlBackup('neexistuje obsluzny program: '.self::BASH_SQLITE3);
                    }
                    break;

                case self::TYPE_MYSQL:
                    if (!Bash::isInstall(self::BASH_MYSQL_EXPORT)) {
                        throw new ExceptionSqlBackup('neexistuje obsluzny program: '.self::BASH_MYSQL_EXPORT);
                    }
                    if (!Bash::isInstall(self::BASH_MYSQL_IMPORT)) {
                        throw new ExceptionSqlBackup('neexistuje obsluzny program: '.self::BASH_MYSQL_IMPORT);
                    }

                    if (!isset($this->config['dbname'])) {
                        throw new ExceptionSqlBackup('neexistuje dbname!');
                    }

                    if (!isset($this->config['user'])) {
                        throw new ExceptionSqlBackup('neexistuje user!');
                    }

                    if (!isset($this->config['password'])) {
                        throw new ExceptionSqlBackup('neexistuje password!');
                    }
                    break;

                default:
                    throw new ExceptionSqlBackup('neznamy driver databaze!');
            }

            // overovani existence hostu
            if (!isset($this->config['host'])) {
                throw new ExceptionSqlBackup('nedefinovany host!');
            }

            if ($this->config['gzip']) {    // overovani gzip utilit
                if (!Bash::isInstall(self::BASH_GZIP)) {
                    throw new ExceptionSqlBackup('neexistuje obsluzny program: '.self::BASH_GZIP);
                }
                if (!Bash::isInstall(self::BASH_GUNZIP)) {
                    throw new ExceptionSqlBackup('neexistuje obsluzny program: '.self::BASH_GUNZIP);
                }
            }
        }

        /**
         * nastaveni vystupniho pathe pro export
         *
         * @since 2.26
         * @param string path cesta pro ulozeni
         * @return this
         */
        public function setOutput($path) {
            $this->config['output'] = $path;
            return $this;
        }

        /**
         * zapinani vystupni gzip komprimace pro export
         *
         * @since 2.26
         * @param bool state true pro zanuti gzip komprimace
         * @return this
         */
        public function setGzip($state) {
            $this->config['gzip'] = $state;
            return $this;
        }

        /**
         * exportovani databaze
         * - pokud se nezada nazev tak vyhodi sql do vystupu
         *
         * @since 2.02
         * @param string table nepovinny nazev tabuky na export
         * @return string path souboru nebo sql dotaz
         */
        public function export($table = null) {
            $gz = ($this->config['gzip'] ? '.gz' : null);
            $result = $this->config['output'] . $gz;  // defaultni cesta
            // sestaveni vystupu
            $output = (isset($this->config['output']) ? ($this->config['gzip'] ? '| '.self::BASH_GZIP : null) . ' > ' . $this->config['output'] . $gz : null);
            // sestaveni driveru
            switch ($this->config['driver']) {
                case self::TYPE_SQLITE2:
                    $res = Bash::exec(sprintf(self::SQLITE2_EXPORT, $this->config['host'], (isset($table) ? $table : null), $output), $code);
                    break;

                case self::TYPE_SQLITE3:
                    $res = Bash::exec(sprintf(self::SQLITE3_EXPORT, $this->config['host'], (isset($table) ? $table : null), $output), $code);
                    break;

                case self::TYPE_MYSQL:
                    $p = array(
                        sprintf(self::MYSQL_HOST, $this->config['host']),
                        sprintf(self::MYSQL_USER, $this->config['user']),
                        sprintf(self::MYSQL_PASS, $this->config['password']),
                        (isset($this->config['port']) ? sprintf(self::MYSQL_PORT, $this->config['port']) : null),
                        $this->config['dbname'],
                        (isset($table) ? $table : null),
                        );

                    $res = Bash::exec(sprintf(self::MYSQL_EXPORT, implode(' ', array_filter($p)), $output), $code);
                    break;
            }
            if ($code === 0 && $res) {
                $result = implode(PHP_EOL, $res);
            }
            return $result;
        }

        /**
         * importovani databaze
         *
         * @since 2.02
         * @param string path soubor s sql dotazy na importovani
         * @return bool true pokud import probehl uspesne
         */
        public function import($path) {
            $result = false;
            // nacteni koncovky
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            // sestaveni vstupu pri dekompilaci
            $input = ($ext == 'gz' ? self::BASH_GUNZIP.' < '.$path.' | ' : null);
            // prepinani podle driveru
            switch ($this->config['driver']) {
                case self::TYPE_SQLITE2:
                    $p = array(
                        $this->config['host'],
                        (!$input ? '< '.$path : null),
                        );

                    $res = Bash::exec(sprintf(self::SQLITE2_IMPORT, $input, implode(' ', array_filter($p))), $code);
                    break;

                case self::TYPE_SQLITE3:
                    $p = array(
                        $this->config['host'],
                        (!$input ? '< '.$path : null),
                        );

                    $res = Bash::exec(sprintf(self::SQLITE3_IMPORT, $input, implode(' ', array_filter($p))), $code);
                    break;

                case self::TYPE_MYSQL:
                    $p = array(
                        sprintf(self::MYSQL_HOST, $this->config['host']),
                        sprintf(self::MYSQL_USER, $this->config['user']),
                        sprintf(self::MYSQL_PASS, $this->config['password']),
                        (isset($this->config['port']) ? sprintf(self::MYSQL_PORT, $this->config['port']) : null),
                        $this->config['dbname'],
                        (!$input ? '< '.$path : null),
                        );

                    $res = Bash::exec(sprintf(self::MYSQL_IMPORT, $input, implode(' ', array_filter($p)), $path), $code);
                    break;
            }
            return ($code == 0);
        }
    }

    /**
     * trida vyjimky pro SqlBackup
     *
     * @package stable
     * @author geniv
     * @version 2.00
     */
    class ExceptionSqlBackup extends \Exception {}