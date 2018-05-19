<?php
/*
 * nodejs.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;
//TODO unit testy!!!
//TODO zatahnout metodu na uglify (slevani JS)!!!
    /**
     * obsluda node-js knihovny
     *
     * - instalace ubuntu: sudo apt-get install nodejs npm
     * - konzole: node/nodejs, npm
     * - zdroje: https://npmjs.org/
     * - pouziva se take: http://gruntjs.com/ + bower
     *
     * @package stable
     * @author geniv
     * @version 1.22
     */
    class NodeJS {

        /**
         * je nodejs nebo konkretni pack instalovan?
         * - instalace napr: sudo npm install -g less
         * - parametry: -g|--global = globalne do systemu / lokalne do aktualni slozky (man 1 npm)
         *
         * @since 1.02
         * @param string|null pack z npm (https://npmjs.org/) ktery se ma overit jestli existuje, defaultne null
         * @return bool true pokud jsou zoucasti dostupne
         */
        private static function isInstall($pack = null) {
            // $node = Bash::isInstall('node');
            $npm = Bash::isInstall('npm');
            $p = true;
            if ($pack) {
                $p = Bash::isInstall($pack);
            }
            return $npm && $p;
        }

        /**
         * konvertovani less do css
         * - automaticky pred regenerovanim odstrani css
         *
         * @since 1.02
         * @param string less zdrojovy soubor lessu
         * @param  string css cilovy soubor po kompilaci
         * @param string param pridavne parametry kompilace
         * @return int pocet zpracovanych soubouru
         */
        public static function less2css($less, $css, $param = '--compress') {
            if (self::isInstall('lessc')) {
                $less_dir = dirname($less);
                if ($less && file_exists($less) && is_readable($less) && $css) {
                    $map_path = $less_dir.'/.map'; // vytvareni jmena mapy souboru

                    if (file_exists($less) && file_exists($map_path) && !file_exists($css)) {
                        unlink($map_path);  // pokud neexistuje css a existuje mapa, odstrani potom mapu
                    }

                    $compile = true;
                    if (file_exists($map_path)) {
                        $ret = json_decode(file_get_contents($map_path), true);
                        $compile = false;
                        foreach ($ret as $k => $v) {
                            if (md5_file($k) != $v) {   //FIXME oprravit pri neexistenci!!
                                $compile = true;
                            }
                        }
                    }

                    if ($compile) {
                        // automaticke odstraneni generovaneho css
                        if (file_exists($css)) {
                            unlink($css);
                        }

                        $r = Bash::exec('lessc '.$param.' --source-map='.$map_path.' --no-color '.$less.' '.$css.' 2>&1', $c);    // automaticky vytvaci slozku
                        if ($c != 0) {
                            throw new ExceptionNodeJS(implode('<br />'.PHP_EOL, $r), 1);
                        }

                        if (file_exists($map_path)) {   // uprava vygenerovane mapy
                            $m = json_decode(file_get_contents($map_path), true);
                            $arr = array($less => md5_file($less)); // pridani sama sebe
                            foreach ($m['sources'] as $value) {
                                $arr[$less_dir.'/'.$value] = md5_file($less_dir.'/'.$value);
                            }
                            file_put_contents($map_path, json_encode($arr));
                        }

                        return count($arr);
                    }  else {
                        return 0;
                    }
                } else {
                    if (!is_readable($less)) {
                        throw new ExceptionNodeJS('Less nelze cist!', 1);
                    } else
                    if (!file_exists($less)) {
                        throw new ExceptionNodeJS('Less neexistuje!', 1);
                    } else
                    if (!$less || $css) {
                        throw new ExceptionNodeJS('Spatne zadany parametr!', 1);
                    }
                }
            } else {
                throw new ExceptionNodeJS('Less neni nainstalovan!', 1);
            }
            return null;
        }
    }

    /**
     * trida vyjimky pro NodeJS
     *
     * @package stable
     * @author geniv
     * @version 1.00
     */
    class ExceptionNodeJS extends \Exception {}