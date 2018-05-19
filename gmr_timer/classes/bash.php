<?php
/*
 * bash.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

	namespace classes;
//TODOD unit testy!!!
    /**
     * obsluha volani do bash
     *
     * @package stable
     * @author geniv
     * @version 1.06
     */
    class Bash {

        /**
         * predavani prikazu do bashu
         *
         * @since 1.02
         * @param string command hash prikaz
         * @param int code navratovy kod prikazu, 0 = ok, 1 = ko, defaultne -1
         * @param string first prvni radek vysledku. defaultne ''
         * @return array pole radku z vysledku
         */
        public static function giveCommand($command, &$code = -1, &$first = '') {
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
            $r = self::giveCommand('which '.$name, $code);
            return isset($r[0]) && $code == 0;
        }
	}