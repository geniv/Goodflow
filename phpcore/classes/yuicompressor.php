<?php
/*
 * yuicompressor.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;

   /**
     * yuicompressor na minimalizaci kodu
     * - zdroj: https://github.com/yui/yuicompressor/releases
     * - prinejlepsim volat jen 1x
     * - nema smysl pokus se pouzivat GrundJS
     *
     * @deprecated
     * @package stable
     * @author geniv
     * @version 1.12
     */
    class YuiCompressor {
        const COMPRESSOR = 'yuicompressor-2.4.8.jar';

        /**
         * vnitrni yui konvertovani
         *
         * @since 1.04
         * @param string dir cilova slozka
         * @param string param parametry do bash-u
         * @return bool true pri uspechu
         */
        private static function yuiConvert($dir, $param) {
            if (file_exists($dir) && is_writable($dir) && file_exists(self::COMPRESSOR) && is_executable(self::COMPRESSOR)) {
                $r = Bash::exec($param, $c);
                if ($c == 1) {
                    throw new ExceptionYuiCompressor(implode('<br />'.PHP_EOL, $r), 1);
                }
                return $c == 0;
            } else {
                if (!file_exists($dir)) {
                    throw new ExceptionYuiCompressor('Slozka neexistuje!', 1);
                } else
                if (!is_writable($dir)) {
                    throw new ExceptionYuiCompressor('Nelze zapisovat do slozky!', 1);
                } else
                if (!file_exists(self::COMPRESSOR)) {
                    $c = new Curl('https://github.com/yui/yuicompressor/releases/download/v2.4.8/yuicompressor-2.4.8.jar');
                    throw new ExceptionYuiCompressor('Kompresor neexistuje! Stahnout zde: '.$c->exec(), 1);
                } else
                if (!is_executable(self::COMPRESSOR)) {
                    throw new ExceptionYuiCompressor('Nelze spoustet kompresor!', 1);
                }
            }
        }
//FIXME soubory u kterych se duplikuji -min- promazavat
        /**
         * minimalizace pro JS
         * - pokud jiz min existuje vytvori *-min-min.*
         *
         * @since 1.02
         * @param string dir slozka s JS, musi koncit /
         * @return bool true pri uspechu
         */
        public static function convertJS($dir = null, $param = '--charset utf-8 -o ".js$:-min.js"') {
            return self::yuiConvert($dir, 'java -jar '.self::COMPRESSOR.' '.$param.' '.$dir.'*.js');
        }

        /**
         * minimalizace pro CSS
         * - pokud jiz min existuje vytvori *-min-min.*
         *
         * @since 1.02
         * @param string dir slozka s CSS, musi koncit /
         * @return bool true pri uspechu
         */
        public static function convertCSS($dir, $param = '--charset utf-8 -o ".css$:-min.css"') {
            return self::yuiConvert($dir, 'java -jar '.self::COMPRESSOR.' '.$param.' '.$dir.'*.css');
        }
    }

    /**
     * trida vyjimky pro yuiCompressor
     *
     * @package stable
     * @author geniv
     * @version 1.00
     */
    class ExceptionYuiCompressor extends \Exception {}