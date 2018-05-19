<?php
/*
 * useragentstring.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

 	namespace classes;
//TODOD unit testy!!!
    /**
     * nacitani user agentu
     * - poziva web: http://www.useragentstring.com/
     * - funguje pouze v pritomnosti internetu
     *
     * @package stable
     * @author geniv
     * @version 1.18
     */
    class UserAgentString {
        private static $curl = null;

        /**
         * inicializace pripojeni
         *
         * @since 1.00
         * @param string agent user agent
         * @return string
         */
        private static function initCurl($agent = null) {
            self::$curl = new Curl;
            self::$curl->get('http://www.useragentstring.com/', array('uas' => ($agent ?: $_SERVER['HTTP_USER_AGENT']), 'getJSON' => 'all'));
            return json_decode(self::$curl->exec(), true);
        }

        /**
         * jde o linux?
         *
         * @since 1.02
         * @param null|string agent volitelny agent
         * @return bool true pokud jde o linux
         */
        public static function isLinux($agent = null) {
            $a = self::initCurl($agent);
            return ($a['os_type'] == 'Linux');
        }

        /**
         * jde o windows?
         *
         * @since 1.02
         * @param null|string agent volitelny agent
         * @return bool true pokud jde o windows
         */
        public static function isWindows($agent = null) {
            $a = self::initCurl($agent);
            return ($a['os_type'] == 'Windows');
        }

        /**
         * jde o mac?
         *
         * @since 1.02
         * @param null|string agent volitelny agent
         * @return bool true pokud jde o mac
         */
        public static function isMac($agent = null) {
            $a = self::initCurl($agent);
            return ($a['os_type'] == 'Macintosh');
        }

        /**
         * jde o chrome?
         *
         * @since 1.02
         * @param null|string agent volitelny agent
         * @return bool true pokud jde o chrome
         */
        public static function isChrome($agent = null) {
            $a = self::initCurl($agent);
            return ($a['agent_name'] == 'Chrome');
        }

        /**
         * jde o firefox?
         *
         * @since 1.02
         * @param null|string agent volitelny agent
         * @return bool true pokud jde o firefox
         */
        public static function isFirefox($agent = null) {
            $a = self::initCurl($agent);
            return ($a['agent_name'] == 'Firefox');
        }

        /**
         * jde o operu?
         *
         * @since 1.00
         * @param null|string agent volitelny agent
         * @return bool true pokud jde o operu
         */
        public static function isOpera($agent = null) {
            $a = self::initCurl($agent);
            return ($a['agent_name'] == 'Opera');
        }

        /**
         * jde o android?
         *
         * @since 1.14
         * @param null|string agent volitelny agent
         * @return bool true pokud jde o android
         */
        public static function isAndroid($agent = null) {
            $a = self::initCurl($agent);
            return ($a['agent_name'] == 'Android Webkit Browser');
        }

        /**
         * jde o IE?
         *
         * @since 1.08
         * @param null|string agent volitelny agent
         * @return bool true pokud jde o IE
         */
        public static function isIExplorer($agent = null) {
            $a = self::initCurl($agent);
            return ($a['agent_name'] == 'Internet Explorer');
        }

        /**
         * je to konkretni prohlizec?
         * - Chrome, Android Webkit Browser, Firefox, Opera, Internet Explorer
         *
         * @since 1.04
         * @param string|array browsers jmeno nebo pole prohlizecu
         * @param null|string agent volitelny agent
         * @return bool true pokud vyhovuje
         */
        public static function isBrowser($browsers, $agent = null) {
            $a = self::initCurl($agent);
            if (is_array($browsers)) {  // pokud je pole hleda v poli
                return in_array($a['agent_name'], $browsers);
            } else {
                return ($a['agent_name'] == $browsers);
            }
        }

        /**
         * jde o konkretni operacni system?
         * - Linux, Windows, OS X, Android
         *
         * @since 1.16
         * @param string|array os jmeno nebo pole operacnich systemu
         * @return bool true pokud vyhovuje
         */
        public static function isOs($os, $agent = null) {
            $a = self::initCurl($agent);
            if (is_array($os)) {  // pokud je pole hleda v poli
                return in_array($a['os_type'], $os);
            } else {
                return ($a['os_type'] == $os);
            }
        }

        /**
         * vraceni informaci o OS
         *
         * @since 1.06
         * @param  null|string agent volitelny agent
         * @return string slozene jmeno OS
         */
        public static function getOs($agent = null) {
            $a = self::initCurl($agent);
            $result = $a['os_type'];
            if (isset($a['os_name'])) {
                if ($a['linux_distibution'] && $a['linux_distibution'] != 'Null') {
                    $result .= ' ('.$a['linux_distibution'].')';
                }

                if ($a['os_versionNumber'] && $a['os_versionNumber'] != 'Null') {
                    $result .= ' ('.$a['os_versionNumber'].')';
                }
            }
            return $result;
        }

        /**
         * vraceni informaci o browseru
         *
         * @since 1.06
         * @param null|string agent volitelny agent
         * @return string jmeno browseru
         */
        public static function getBrowser($agent = null) {
            $a = self::initCurl($agent);
            return ($a['agent_name'] . ' ' . $a['agent_version']);
        }

        /**
         * nacteni vsech dat
         *
         * @since 1.12
         * @param null|string agent volitelny agent
         * @return array pole dat
         */
        public static function getData($agent = null) {
            return self::initCurl($agent);
        }
    }