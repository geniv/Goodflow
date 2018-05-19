<?php
/*
 * htpasswd.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;

    /**
     * trida na zpracovani htpasswd souboru
     *
     * @package unstable
     * @author geniv
     * @version 1.16
     */
    class Htpasswd {
        const FILE = '.htpasswd';
        private $path = '';
        private $data = array();

        /**
         * defaultni konstruktor
         *
         * @since 1.02
         * @param string path cesta k souboru
         * @param string file nazav souboru
         */
        public function __construct($path = '', $file = self::FILE) {
            $this->path = $path . $file;
        }

        /**
         * nacteni obsahu ze souboru
         *
         * @since 1.04
         * @param void
         * @return this
         */
        public function load() {
            if (file_exists($this->path) && is_readable($this->path)) {
                $this->data = $this->parseHtpasswd();
            } else {
                if (!file_exists($this->path)) {
                    throw new ExceptionHtpasswd('Soubor neexistuje!');
                }

                if (!is_readable($this->path)) {
                    throw new ExceptionHtpasswd('Soubor nelze cist!');
                }
            }
            return $this;
        }

        /**
         * ulozeni obsahu do souboru
         *
         * @since 1.12
         * @param void
         * @return this
         */
        public function save() {
            if ($this->data) {
                $res = array();
                foreach ($this->data as $l => $p) {
                    $res[] = $l . ':' . $p;
                }
                file_put_contents($this->path, implode(PHP_EOL, $res));
            }
            return $this;
        }

        /**
         * parsrovani souboru
         *
         * @since 1.06
         * @param void
         * @return array vyparsrovane data
         */
        private function parseHtpasswd() {
            $result = '';
            $file = file_get_contents($this->path);

            foreach (explode(PHP_EOL, $file) as $row) {
                $d = explode(':', $row);
                $result[$d[0]] = $d[1];
            }
            return $result;
        }

        /**
         * nacteni pole uzivatelu
         *
         * @since 1.06
         * @param bool full true pro plne nacteni u=>h, jinak jen 0=>u
         * @return array pole uzivatelu
         */
        public function getUsers($full = false) {
            return $full ? $this->data : array_keys($this->data);
        }

        /**
         * tovarni metoda na nacteni pole uzivatelu
         *
         * @since 1.14
         * @param bool full true pro plne nacteni u=>h, jinak jen 0=>u
         * @return array pole uzivatelu
         */
        public static function users($full = false) {
            $h = new self;
            $h->load(); // pri defaultnim nastaveni
            return $h->getUsers($full);
        }

        /**
         * existuje uzivatel?
         *
         * @since 1.10
         * @param string login jmeno
         * @return bool true pokud uzivatel existuje
         */
        public function existUser($login) {
            return array_key_exists($login, $this->data);
        }

        /**
         * pridani uzivate
         *
         * @since 1.10
         * @param string login jmeno
         * @param string hash heslo
         * @param bool autohash true pokud ma byt automaticky zahesovano
         * @return this
         */
        public function addUser($login, $hash, $autohash = true) {
            if (!$this->existUser($login)) {
                $this->data[$login] = ($autohash ? Core::getHtpasswdHash($hash) : $hash);
            }
            return $this;
        }

        /**
         * editace uzivatele
         *
         * @since 1.10
         * @param string login jmeno
         * @param string hash heslo
         * @param bool autohash true pokud ma byt automaticky zahesovano
         * @return this
         */
        public function editUser($login, $hash, $autohash = true) {
            if ($this->existUser($login)) {
                $this->data[$login] = $autohash ? Core::getHtpasswdHash($hash) : $hash;
            }
            return $this;
        }

        /**
         * smazani uzivatele
         *
         * @since 1.10
         * @param string login jmeno
         * @return this
         */
        public function delUser($login) {
            if ($this->existUser($login)) {
                unset($this->data[$login]);
            }
            return $this;
        }
    }

    /**
     * trida vyjimky pro Htpasswd
     *
     * @package stable
     * @author geniv
     * @version 1.00
     */
    class ExceptionHtpasswd extends \Exception {}