<?php
/*
 * jsutils.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;
//TODO Unit testy + dopsat!!!
//TODO mozna spis pojmenovat jako JsHelper ! s tim ze bude uvnit radoby tpl nastroj!!!
    /**
     * trida pro praci s JS souborem
     *
     * @package unstable
     * @author geniv
     * @version 1.12
     */
    class JsUtils {

        /**
         * generovani JS souboru pro rozvijeni promennych
         *
         * @since 1.00
         * @param string int vstupni soubor/slozka
         * @param string out vystupni soubor/slozka
         * @param array variables pole promenych, array(klic => hodnota,) ; hleda: {$klic}
         * @return int cislo
         */
        public static function generate($in, $out, $variables) {
            if (is_dir($in)) {
                if ($in != $out && file_exists($out)) {
                    //konvert slozky do slozky
                }
            } else {
                // konvertovani souboru do souboru
                if ($in && $out && $in != $out && file_exists($in) && file_exists(dirname($out))) {

                    //TODO kontrolova md5 file a chachovat map file kvuli optimalizace zapisu na disk!!!

                    $keys = array_map(function($v) {    // upraveni klicu
                        return '{$' . $v . '}';
                    }, array_keys($variables));
                    return file_put_contents($out, str_replace($keys, $variables, file_get_contents($in)));
                }
            }

            if ($in && $out && $in == $out) {
                throw new ExceptionJsUtils('stejny vstup i vystup!');
            }

            if (!file_exists($in)) {
                throw new ExceptionJsUtils('neexistuje vstupni soubor!');
            }

            if (!file_exists($out)) {
                if (!@mkdir(is_dir($in) ? $out : dirname($out), 0777, true)) {
                    throw new ExceptionJsUtils('nelze vytvorit adresarovou strukturu');
                }
            }
        }
    }

    /**
     * trida vyjimky pro JsUtils
     *
     * @package stable
     * @author geniv
     * @version 1.00
     */
    class ExceptionJsUtils extends \Exception {}