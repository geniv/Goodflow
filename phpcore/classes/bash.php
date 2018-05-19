<?php
/*
 * bash.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

	namespace classes;

    /**
     * obsluha volani do bash
     *
     * @package stable
     * @author geniv
     * @version 1.12
     */
    abstract class Bash {

        /**
         * predavani prikazu do bashu
         *
         * @since 1.02
         * @param string command hash prikaz
         * @param int code navratovy kod prikazu, 0 = ok, 1 = ko, defaultne -1
         * @param string first prvni radek vysledku. defaultne ''
         * @return array nactene pole radku z vysledku
         */
        public static function exec($command, &$code = -1, &$first = '') {
            $first = exec($command, $result, $code);
            return $result;
        }

        /**
         * je program instalovan?
         *
         * @since 1.02
         * @param string name nazev programu
         * @return bool true pokud je program nainstalovany
         */
        public static function isInstall($name) {
            $r = self::exec('which ' . $name, $code, $row);
            return ($code === 0 && isset($row));
        }

        /**
         * je aktualni konzole root?
         *
         * @since 1.08
         * @param void
         * @return bool true pokud je konzole pod uzivatelem 'root'
         */
        public static function isRoot() {
            self::exec('whoami', $code, $row);
            return ($code === 0 && $row == 'root');
        }

        /**
         * nacteni temp souboru z konzoly
         *
         * @since 1.10
         * @param void
         * @return string jmeno temp souboru
         */
        public static function getTempfile() {
            self::exec('tempfile', $code, $row);
            return ($code === 0 ? $row : null);
        }
	}