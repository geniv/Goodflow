<?php
/*
 * core.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;

    /**
     * hlavni trida s nejpouzivanenejsimi statickymi metodami,
     * - nevytvoritelna (abstraktni)
     *
     * @package unstable
     * @author geniv
     * @version 3.78
     */
    abstract class Core {

        // minimal version for php5
        const PHPMIN = '5.4';

        /**
         * defaultni skryty konstruktor
         *
         * @since 3.36
         * @param void
         */
        private function __construct() {}

        /**
         * zasilani text nebo pole do error logu
         *
         * @since 2.00
         * @param string text vstupni text nebo pole textu co se maji zalogovat
         * @return void
         */
        public static function sendErrorLog($text) {
            if (is_array($text)) {
                foreach ($text as $val) {
                    error_log($val);
                }
            } else {
                error_log($text);
            }
        }
//TODO rovnou delat core v2!!! a uplne premyslet nektere meotdy!!!
        /**
         * zapinani "ladicich" informaci, pro vysktu chyby chybu interpretuje a zaloguje
         *
         * @since 2.00
         * @param bool show_memory zapinani logovani vytizeni pametu
         * @return void
         */
        public static function enableDebug($show_memory = false) {
            $error = error_get_last();
            if (!empty($error)) {
                self::sendErrorLog($error); //poslani do error logu
                print_r($error);  //+tisk i na stdout
                print_r(apache_request_headers());
                print_r(apache_response_headers());
                print_r($_SERVER);
            }
//FIXME jinak!!!
            if ($show_memory) {
                self::sendErrorLog('*info* amount: '.self::calculateSize(memory_get_usage(true)));
                self::sendErrorLog('*info* peak: '.self::calculateSize(memory_get_peak_usage(true)));
                exec(sprintf('echo -n $( ps --pid %s --no-headers -o rss )', getmypid()), $out);
                self::sendErrorLog('*info* usage: ' . self::calculateSize($out[0] * 1024));
            }
        }

        /**
         * zpracovani url podle parametru settings
         *
         * @since 2.00
         * @param array settings pole nastaveni
         * @return cast zpracovaneho odkazu
         */
        private static function getPartUrl(array $settings = array()) {
            $query = self::isFill($settings, 'query');
            $rewrite = self::isFill($settings, 'rewrite', false);
            $link_path = self::isFill($settings, 'path', '');
            $amp = self::isFill($settings, 'amp', '&amp;');
            $end = (!empty($query) ?
                        ($rewrite ? sprintf('%s', implode($amp, $query))
                        : sprintf('?%s', http_build_query(($rewrite ? array_values($query) : $query), NULL, $amp)))
                    : NULL);
            return sprintf('%s%s', $link_path, $end);
        }

        /**
         * nacteni webove url pro aktualni slozku
         *
         * @since 2.00
         * @param array settings pole nastaveni
         * @return string absolutni url do aktualniho adresare
         */
        public static function getUrl(array $settings = array()) {
            $path = dirname($_SERVER['SCRIPT_NAME']);
            $end = self::getPartUrl($settings); //php_uname('n')
            return sprintf('http://%s%s/%s', $_SERVER['SERVER_NAME'], ($path != '/' ? $path : ''), $end);
        }

        /**
         * vytvoreni linku jako ve getUrl nebo getAbsoluteUrl
         *
         * @since 2.00
         * @param string url url pro odkaz
         * @param array settings pole nastaveni
         * @return string sestaveny bezpecny odkaz
         */
        public static function makeUrl($url, array $settings = array()) {
            return sprintf('%s%s', $url, self::getPartUrl($settings));
        }

        /**
         * zakodovani vstupniho textu podle sekvence kodu
         *
         * @since 2.00
         * @param astring lgorithms vstupni terezec algoritmu oddelenych +, dostupne algoritmy: hash_algos()
         * @param string text vstupni text na zakodovani
         * @return string nekolika nasobne zakodovany text
         */
        public static function makeHash($algorithms, $text) {
            $result = $text;
            $hash = explode('+', $algorithms);
            foreach ($hash as $algo) {
                $result = hash($algo, $result);
            }
            return $result;
        }

        /**
         * nacteni webove url uplneho pathe
         * - neakceptuje aktualni web, ale bere pouze primou slozku kde je web
         *
         * @deprecated
         * @since 2.00
         * @param array settings pole nastaveni, rewrite(boolean), amp(string)
         * @return string temer absolutni adresa webu
         */
        public static function getAbsoluteUrl(array $settings = array()) {
            $script = explode('/', $_SERVER['SCRIPT_NAME']);
            $sourcedir = self::isFill($settings, 'sourcedir', __DIR__); //nacitani zdrojoveho adresare
            $absolute_path = explode('/', self::getAbsoluteWebPath($sourcedir));
            $path = implode('/', array_intersect($script, $absolute_path));
            $end = self::getPartUrl($settings);
            return sprintf('http://%s%s/%s', $_SERVER['SERVER_NAME'], $path, $end);
        }

        /**
         * nacitani aktualni cesty stranek
         *
         * @since 2.00
         * @param void
         * @return string cesta stranek
         */
        public static function getWebPath() {
            return dirname($_SERVER['SCRIPT_FILENAME']);
        }

        /**
         * absolutni path webu, s moznosti urcit zdrojovou slozku
         *
         * @since 2.00
         * @param string sourcedir moznost urcit pocatecni adresar
         * @return string absolutni path webu
         */
        public static function getAbsoluteWebPath($sourcedir = __DIR__) {
            $script = explode('/', $_SERVER['SCRIPT_FILENAME']);  //rozdeleni script pathe
            $dir = explode('/', $sourcedir); //rozdeleni aktualniho pathe
            return implode('/', array_intersect($script, $dir));  //slouceni pruniku
        }

        /**
         * vraci aktualni request url adresu
         *
         * @since 3.00
         * @param string|null url dodatek k adrese
         * @param int|null length posun v indexech
         * @param int offset pocatecni posun indexu
         * @return string request adresa
         */
        public static function getRequestUrl($url = null, $length = null, $offset = 0) {
            $uniq = array_unique(explode('/', $_SERVER['REQUEST_URI'].'/'.$url));
            return 'http://'.$_SERVER['SERVER_NAME'].implode('/', array_slice($uniq, $offset, $length));
        }

        /**
         * vypocet prevodu velikosti
         * - jen vypocita a naformatuje jednotku
         *
         * @since 2.00
         * @param int size cislo velikosti pro prevod
         * @return string vypocitana velikost
         */
        public static function calculateSize($size) {
            $exp = 0;
            $converted = 0;
            $result = NULL;
            //nadefinovane symboly
            $symbol = array('b', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            //pokud je velikost > 0
            if ($size > 0) {
                $exp = floor(log($size) / log(1024)); //vypocet exponentu
                $converted = ($size / pow(1024, floor($exp)));  //vypocet vysledne hodnoty
                $result = sprintf(($exp == 0 ? '%d %s' : '%.2f %s'), $converted, $symbol[$exp]);
            }
            return $result;
        }

        /**
         * zmereni a prepocitani velikosti zadaneho souboru
         * - vsadi velikost souboru
         *
         * @since 2.00
         * @param string filename path k souboru
         * @return string zmerena a prepocitana velikost
         */
        public static function getFileSize($filename) {
            $result = NULL;
            if (file_exists($filename)) {
                $result = self::calculateSize(filesize($filename));
            }
            return $result;
        }

        /**
         * nacteni posledni modifikace soubiru
         *
         * @since 3.32
         * @param string filename cesta k souboru
         * @param string|null format format datumu, nepovinny
         * @return int|string|null posledni zmena (modifikace) souboru
         */
        public static function getFileModify($filename, $format = null) {
            $result = null;
            if (file_exists($filename)) {
                $result = filemtime($filename);
                if ($format) {
                $result = date($format, $result);
                }
            }
            return $result;
        }

        /**
         * kodovani dat, jen base64 // base64 + url**code
         *
         * @since 2.00
         * @param string data vstupni data na zakodovani
         * @param bool url zapina kodovani url
         * @return string zakodovane data
         */
        public static function encodeData($data, $url = false) {
            $result = base64_encode($data);
            if ($url) {
                $result = urlencode($result);
            }
            return $result;
        }

        /**
         * dekodovani zakodovanych dat
         *
         * @since 2.00
         * @param string data zakodovane data
         * @param bool url dekodovat z url
         * @return string dekodovany text
         */
        public static function decodeData($data, $url = false) {
            if ($url) {
                $data = urldecode($data);
            }
            return base64_decode($data);
        }

        /**
         * jednoduche kodovani pro prenos nazvu pres id, na eliminaci nebezpecnych znaku
         *
         * @deprecated
         * @since 2.00
         * @param string data vstupni text
         * @return string zakodovany retezec
         */
        public static function easyEncode($data) {
            $base = base64_encode($data); //zakodovani do prechodneho base64
            $pole = str_split($base);
            $func = function($value) { return ord($value); };
            return implode('a', array_map($func, $pole));
        }

        /**
         * jednoduche dekodovani
         *
         * @deprecated
         * @since 2.00
         * @param string data vstuni zakodovane data
         * @return string dekodonany retezec
         */
        public static function easyDecode($data) {
            $pole = explode('a', $data);
            $func = function($value) { return chr($value); };
            $base = implode('', array_map($func, $pole));
            return base64_decode($base);  //dekodovani z prechodneho base64
        }
//TODO opravit zalamovani!!! odsazeni?
        /**
         * soucet velikosti obsahu adresare/adresaru
         *
         * @since 3.00
         * @param string path cesta adresare
         * @param bool recursive rekurzivne ano/ne
         * @return int suma zmerene velikosti
         */
        public static function getSizeDir($path, $recursive = false) {
          $sum = 0;
          if (file_exists($path) && is_readable($path)) {
            //rozhodnuti jakou tridu pouzit
            if ($recursive) {
              //pokud prochazi rekurzivne
              $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            } else {
              //pokud prochazi jen jednu slozku
              $it = new \DirectoryIterator($path);
            }

            //pruchod iterace
            foreach ($it as $ifile) {
              //pokud je soubor
              if ($ifile->isFile()) {
                $sum += $ifile->getSize();
              }
            }
          }
          return $sum;
        }

          /**
           * osetrovnani prazdnoty indexu pole, funkci "empty"
           *
           * @since 2.00
           * @param array array vstupní pole
           * @param int|string key klic pole
           * @param string default defaultni hodnota
           * @return mixed hodnota pole pod danym klicem pokud je neprazdne
           */
        public static function isFill($array, $key, $default = '') {
          return (!empty($array[$key]) ? $array[$key] : $default);
        }

          /**
           * osetrovani pokud klic pole existuje, funkci "array_key_exists"
           *
           * @since 2.00
           * @param array array vstupni pole
           * @param int|string key klic pole
           * @param string default defaultni hodnota
           * @return mixed hodnota z pole pokud v poli existuje
           */
        public static function isNull($array, $key, $default = '') {
          return (is_array($array) && array_key_exists($key, $array) ? $array[$key] : $default);
        }

          /**
           * vkladani hodnoty pokud neni prazdna, funkci "empty"
           *
           * @since 2.00
           * @param mixed vstupni value
           * @param mixed defaultni|string default
           * @return mixed hodnota value pokud je neprazdna, jinak vraci default
           */
        public static function isEmpty($value, $default = '') {
          return (!empty($value) ? $value : $default);
        }

        /**
         * vygenerovani nahodne barvy
         *
         * @since 2.00
         * @param string min pocatecni barva ve tvaru #rrggbb
         * @param string max koncova barva ve tvaru #rrggbb
         * @return string nahodna barva z rozsahu ve tvaru #rrggbb
         */
        public static function getRandomColor($min, $max) {
          $result = NULL;
          if (strlen($min) == strlen($max)) {
            $_min = str_split(substr($min, 1));  //odebrani #
            $_max = str_split(substr($max, 1));
            switch (strlen($min)) {
              case 3+1:
                $res = array('#');
                foreach ($_min as $i => $val) {
                  $res[] = dechex(rand(hexdec($val.$val), hexdec($_max[$i].$_max[$i])));
                }
                $result = implode('', $res);
              break;

              case 6+1:
                $_min = array_chunk($_min, 2);  //slouceni po dvojcich
                $_max = array_chunk($_max, 2);
                $res = array('#');
                foreach ($_min as $i => $val) {
                  $res[] = dechex(rand(hexdec(implode($val)), hexdec(implode($_max[$i]))));
                }
                $result = implode($res);
              break;
            }
          }
          return $result;
        }

        //konstanty na zpusob razeni dle
        const LIST_SORT_LOWER = 'strtolower'; //male pismena
        const LIST_SORT_MTIME = 'filemtime';  //modife
        const LIST_SORT_CTIME = 'filectime';  //change
        const LIST_SORT_SELF = 'self';  //vlastni pole, jen prunik existujicich
        //konstanty na typ razeni
        const LIST_SORT_ASC = 'asc';
        const LIST_SORT_DESC = 'desc';
        //konstanty na specialni precialni volby
        const LIST_SORT_REG = 'regular';
        const LIST_SORT_NUM = 'numeric';
        const LIST_SORT_STR = 'string';

        /**
         * aplikace razeni na pole souboru
         *
         * @since 2.00
         * @param array itrems vstupni pole
         * @param array param pole parametru, 'sort' => array()
         * @return array pole s aplikovanym razenim
         */
        private static function applyListSort(array $items, array $param) {
          $sort = self::isFill($param, 'sort');

          if (!empty($sort)) {
            $final = array();
            foreach ($sort as $key => $value) {
              //pokud je klic detekovan jako vlastni razeni
              if ($key == self::LIST_SORT_SELF && is_array($value)) {
                $value = $key;  //prepsani value pro switch detekci
              }
              switch ($value) {
                //typ dle hodnoty
                case self::LIST_SORT_LOWER:
                  $final[0] = array_map('strtolower', $items);
                break;
    //FIXME pozor problem pri razeni souboru z jine slozky, musi se predavat cela full cesta
    //TODO pak na orez pouzivat: basename()/dirname()
                case self::LIST_SORT_MTIME:
                  $final[0] = array_map('filemtime', $items);
                break;

                case self::LIST_SORT_CTIME:
                  $final[0] = array_map('filectime', $items);
                break;

                //smer
                case self::LIST_SORT_ASC:
                  $final[1] = SORT_ASC;
                break;

                case self::LIST_SORT_DESC:
                  $final[1] = SORT_DESC;
                break;

                //specialni
                case self::LIST_SORT_REG:
                  $final[2] = SORT_REGULAR;
                break;

                case self::LIST_SORT_NUM:
                  $final[2] = SORT_NUMERIC;
                break;

                case self::LIST_SORT_STR:
                  $final[2] = SORT_STRING;
                break;

                //vlastni
                case self::LIST_SORT_SELF:
                  $selforder = $sort[self::LIST_SORT_SELF];
                  $intersect = array_intersect($selforder, $items); //prunik
                  $diff = array_diff($items, $selforder); //rozdil
                  $items = array_merge($intersect, $diff);  //soucet pruniku a rozdilu
                break;
              }
            }

            if (!empty($final)) {
              array_multisort(self::isFill($final, 0, $items),
                              self::isFill($final, 1, $items),
                              self::isFill($final, 2, $items),
                              $items);
            }
          }
          return $items;
        }

        /**
         * aplikace filtru koncovek na pole souboru
         *
         * @since 2.00
         * @param array itrems vstupni pole
         * @param array param pole parametru, 'filter+/-' => array()
         * @return array pole s aplikovanym filrem
         */
        private static function applyListFilter(array $items, array $param) {
          $filterp = self::isFill($param, 'filter+'); //akceptovat nebo
          $filterm = self::isFill($param, 'filter-'); //vynechat
    //TODO slo by dazajista efektivneji!
          if (!empty($filterp) || !empty($filterm)) {
            $res = array();
            foreach ($items as $row) {
              $info = strtolower(pathinfo($row, PATHINFO_EXTENSION));
              //akceptovane pripony else nepodporovane pripony
              if (!empty($filterp) && in_array($info, $filterp)) {
                $res[] = $row;
              } elseif (!empty($filterm) && !in_array($info, $filterm)) {
                $res[] = $row;
              }
            }
            $items = $res;
          }
          return $items;
        }

        /**
         * nacteni seznamu adresaru
         *
         * @since 2.00
         * @param array param pole parametru, 'path' => ''
         * @return array seznam adresaru
         */
        public static function getListDir(array $param) {
          $path = self::isFill($param, 'path'); //nacteni pathu
          $result = NULL;
          if (file_exists($path)) {
            $result = array();
            $it = new \DirectoryIterator($path);
            foreach ($it as $row) {
              if ($row->isDir() && !$row->isDot()) {
                $result[] = $row->getFilename();
              }
            }
            $result = self::applyListSort($result, $param);
          }
          return $result;
        }

        /**
         * nacteni seznamu souboru
         *
         * @since 2.00
         * @param array param pole parametru, 'path' => ''
         * @return array seznam souboru
         */
        public static function getListFile(array $param) {
          $path = self::isFill($param, 'path'); //nacteni pathu
          $full = self::isFill($param, 'full', false); //plna cesta

          $result = array();
          if (file_exists($path)) {
            $it = new \DirectoryIterator($path);
            foreach ($it as $row) {
              if ($row->isFile() && !$row->isDot()) {
                if ($full) {
                  $result[] = $row->getPathname();
                } else {
                  $result[] = $row->getFilename();
                }
              }
            }

            $result = self::applyListFilter($result, $param);
            $result = self::applyListSort($result, $param);
          }
          return $result;
        }

        /**
         * vrati pocet slozek ve slozce
         *
         * @since 2.00
         * @param array param pole parametru, 'path' => ''
         * @return int|array pocet slozek v adresari
         */
        public static function getCountListDir(array $param) {
          $path = self::isFill($param, 'path'); //nacteni pathu
          $result = NULL;
          if (file_exists($path)) {
            $result = 0;
            $it = new \DirectoryIterator($path);
            foreach ($it as $row) {
              if ($row->isDir() && !$row->isDot()) {
                $result++;
              }
            }
          }
          return $result;
        }

        /**
         * vrati pocet souboru ve slozce
         *
         * @since 2.00
         * @param array param pole parametru, 'path' => ''
         * @return int pocet souboru v adresari
         */
        public static function getCountListFile(array $param) {
          $path = self::isFill($param, 'path'); //nacteni pathu
          $onlywrite = self::isFill($param, 'onlywrite'); //jen to co jsou pro zapis
          $onlyread = self::isFill($param, 'onlyread'); //jen ty co jsou pro cteni
          $sumsize = self::isFill($param, 'sumsize');  //soucet velikosti

          $result = NULL;
          if (file_exists($path)) {
            if ($onlywrite) {
              $result['writable'] = 0;
              $result['count'] = 0;
            } elseif ($onlyread) {
              $result['readable'] = 0;
              $result['count'] = 0;
            } elseif ($sumsize) {
              $result['sum'] = 0;
              $result['calculatesum'] = 0;
              $result['count'] = 0;
            } else {
              $result = 0;
            }
            $it = new \DirectoryIterator($path);
            foreach ($it as $row) {
              if ($row->isFile() && !$row->isDot()) {
                if ($onlywrite) {
                  if ($row->isWritable()) {
                    $result['writable']++;  //pocitani jen tech ktere jsou pro zapis
                  }
                  $result['count']++; //pocitani vsech u kontoly pro zapis
                } elseif ($onlyread) {
                  if ($row->isReadable()) {
                    $result['readable']++;  //pocitani jen tech ktere jsou pro cteni
                  }
                  $result['count']++;
                } elseif ($sumsize) {
                  $result['sum'] += $row->getSize();  //soucet velikosti
                  $result['count']++;
                } else {
                  $result++;  //pocitani vsech
                }
              }
            }

            if ($sumsize) { //prepocita velikost
              $result['calculatesum'] = self::calculateSize($result['sum']);
            }
          }
          return $result;
        }

        /**
         * vrati pocet polozek ve slozce
         *
         * @since 2.00
         * @param array param pole parametru, 'path' => ''
         * @return int vraci pole polozek v adresari
         */
        public static function getCountListItems(array $param) {
          $path = self::isFill($param, 'path'); //nacteni pathu
          $result = NULL;
          if (file_exists($path)) {
            $result = 0;
            $it = new \DirectoryIterator($path);
            foreach ($it as $row) {
              if (!$row->isDot()) {
                $result++;
              }
            }
          }
          return $result;
        }

        /**
         * vrati rekurzivni vypis adresare
         *
         * @since 2.00
         * @param array param pole parametru, 'path' => ''
         * @return array vraci pole rekurzivne projiteho adresare
         */
        public static function getListRecursiveAll(array $param) {
          $path = self::isFill($param, 'path'); //nacteni pathu
          $full = self::isFill($param, 'full', false); //plna cesta
          $onlydir = self::isFill($param, 'onlydir', false); //pouze adresare
          $onlyfile = self::isFill($param, 'onlyfile', false); //pouze soubory

          if (!$full) {
            $lenreal = self::isFill($param, '_lengthreal', strlen($path) + 1);
          }

          $result = NULL;
          if (file_exists($path)) {
            $result = array();
            $resend = array();
            $items = scandir($path);  //nacteni aktualniho adresare
            foreach ($items as $row) {
              if ($row != '.' && $row != '..') {
                $fullpath = sprintf('%s/%s', $path, $row);
                if (!$full) {
                  $shortpath = substr($fullpath, $lenreal);
                }

                if (is_file($fullpath) && !$onlydir) {
                  $result[] = (!$full ? $shortpath : $fullpath);
                }

                if (is_dir($fullpath)) {
                  $param['path'] = $fullpath;
                  if (!$full) {
                    $param['_lengthreal'] = $lenreal;
                  }
                  $res = self::getListRecursiveAll($param); //rekurze
                  $result = array_merge($result, $res);

                  if (!$onlyfile) {
                    $resend[] = (!$full ? $shortpath : $fullpath);
                  }
                }
              }
            }
            $result = array_merge($result, $resend);
          }

          return $result;
        }

        /**
         * pridavani cisla za vice opakujici se soubor
         *
         * @since 2.00
         * @param string path cesta souboru
         * @param string concat tvar spojeni souboru a cisla
         * @return array pole s novym pathem a indexem
         */
        public static function getIncNameFile($path, $concat = '%s-%s') {
          $poc = 1;
          if (file_exists($path)) {
            $newpath = sprintf($concat, $path, $poc);
            while (file_exists($newpath)) {
              $poc++;
              $newpath = sprintf($concat, $path, $poc);
            }
          } else {
            $newpath = $path;
          }
          return array('path' => $newpath, 'index' => $poc);
        }

        /**
         * zkracovani textu, s podporou UTF-8
         *
         * @since 2.00
         * @param string text vstupni text
         * @param int width po kolika pismenech zkratit
         * @param string trimmarker ukoncovaci znaky, defaultni "..."
         * @param string encoding sada kodovani textu, defaultni "UTF-8"
         * @return string zkraceny text s ukoncovacimi znaky
         */
        public static function trimMarker($text, $width, $trimmarker = '...', $encoding = 'UTF-8') {
          $result = $text;
          if ($width > 0) {
            $result = mb_strimwidth($text, 0, $width, $trimmarker, $encoding);
          }
          return $result;
        }

        /**
         * orezavani odstavcoveho textu na zadany pocet odstavcu
         * - pokud neosahuje odstavce vrati cisty text
         *
         * @since 3.36
         * @param string text vstupni text s odstavcama
         * @param int max maximalni pocet odstavcu
         * @param string|null pattern regularni vyraz na hledani odstavcu
         * @param string implode spojovani rozparsrovanych odstavcu
         * @return string spojeny text se zadanym poctem odstavcu
         */
        public static function trimParagraphs($text, $max, $pattern = null, $implode = PHP_EOL) {
          $_pattern = $pattern ?: '/\<p\>(.*)\<\/p\>*/';
          if (preg_match_all($_pattern, $text, $match)) {
            return implode($implode, array_slice($match[0], 0, $max));
          } else {
            return $text;
          }
        }

        /**
         * spocita odstavce v textu
         *
         * @since 3.36
         * @param string text vstupni text s odstavcama
         * @param string|null pattern regularni vyraz na hledani odstavcu
         * @return int pocet odstavcu v textu
         */
        public static function getCountParagraphs($text, $pattern = null) {
          $_pattern = $pattern ?: '/\<p\>(.*)\<\/p\>*/';
          preg_match_all($_pattern, $text, $match);
          return count($match[0]);
        }

        /**
         * nazrazovani textu pres preg_replace
         *
         * @since 3.46
         * @param string text vstupni text
         * @param array patterns pole regularnich vyrazu
         * @return string zpracovany text
         */
        public static function getReplaceText($text, $patterns = array()) {
          $regex = array_keys($patterns);
          return preg_replace($regex, $patterns, $text);  //  '/^.../' => 'text, ${1}'
        }

        /**
         * vrati aktualni user agent
         *
         * @since 2.00
         * @param void
         * @return vraci aktualniho user-agenta
         */
        public static function getUserAgent() {
          return self::isFill($_SERVER, 'HTTP_USER_AGENT', null);
        }

        /**
         * jde o Firefox?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o firefox
         */
        public static function isFirefox($agent = null) { //pokud by bylo zapotrebi tak by se to rozsirilo podobne jako u chrome
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('#(Firefox|Shiretoko)/([a-zA-Z0-9\.]+)#i', $ua) == 1);
        }

        /**
         * jde o Chrome?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o chrome
         */
        public static function isChrome($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('#Chrome/([a-zA-Z0-9\.]+) Safari/([a-zA-Z0-9\.]+)#i', $ua) == 1);
        }

        /**
         * jde o Safari?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true oikud jde o safari
         */
        public static function isSafari($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('#Safari/([a-zA-Z0-9\.]+)#i', $ua) == 1);
        }

        /**
         * jde o Operu?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o operu
         */
        public static function isOpera($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('#Opera[ /]([a-zA-Z0-9\.]+)#i', $ua) == 1);
        }

        /**
         * jde o IE?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o ie
         */
        public static function isIExplorer($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('#MSIE ([a-zA-Z0-9\.]+)#i', $ua) == 1);
        }
    //TODO rozlizovat vice prohlizecu androida??
        /**
         * jde o Android?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o android
         */
        public static function isAndroid($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('#Android ([a-zA-Z0-9\.]+)#i', $ua) == 1);
        }

        /**
         * jde o iPhone?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o iphone
         */
        public static function isiPhone($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('/(iPhone)/i', $ua) == 1);
        }

        /**
         * jde o iPod?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o ipod
         */
        public static function isiPod($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('/(iPod)/i', $ua) == 1);
        }

        /**
         * jde o webOS?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o webos
         */
        public static function iswebOS($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('#webOS/([a-zA-Z0-9\.]+)#i', $ua) == 1);
        }

        /**
         * jde o Linux?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o linux
         */
        public static function isLinux($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('/(Linux)|(Android)/i', $ua) == 1);
        }

        /**
         * jde o Mac?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o mac
         */
        public static function isMac($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('/(Mac OS)|(Mac OS X)|(Mac_PowerPC)|(Macintosh)/i', $ua) == 1);
        }

        /**
         * jde o Windows?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o windows
         */
        public static function isWindows($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('/(Windows)/i', $ua) == 1);
        }

        /**
         * jde o Webkit?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o webkit
         */
        public static function isWebKit($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('#AppleWebKit/([a-zA-Z0-9\.]+)#i', $ua) == 1);
        }

        /**
         * jde o Gecko?
         *
         * @since 2.00
         * @param string|null agent manualne vlozeny user agent
         * @return bool true pokud jde o gecko
         */
        public static function isGecko($agent = null) {
          $ua = $agent ?: self::getUserAgent();
          return (preg_match('#Gecko/([a-zA-Z0-9\.]+)#i', $ua) == 1);
        }

        /**
         * slucovani pole titlu do jedne
         *
         * @since 2.00
         * @deprecated
         * @param array array pole titlu
         * @param string separe oddelovac pole
         * @return string slouceny text
         */
        public static function implodeTitle(array $array, $separe = ' - ') {
          $result = null;
          if (!empty($array)) {
            $result = implode($separe, array_filter($array));
          }
          return $result;
        }

        /**
         * nacitani opravneni souboru
         *
         * @since 2.00
         * @param string path cesta souboru
         * @param bool full pro plny format (rwx) true, pro octalovy 0751 false
         * @return string opravneni souboru v textovem nebo octalovem tvaru
         */
        public static function getFilePermissions($path, $full = false) {
          $result = NULL;
          $perms = fileperms($path);
          if ($full) {
            if (($perms & 0xC000) == 0xC000) {
                // Socket
                $info = 's';
            } elseif (($perms & 0xA000) == 0xA000) {
                // Symbolic Link
                $info = 'l';
            } elseif (($perms & 0x8000) == 0x8000) {
                // Regular
                $info = '-';
            } elseif (($perms & 0x6000) == 0x6000) {
                // Block special
                $info = 'b';
            } elseif (($perms & 0x4000) == 0x4000) {
                // Directory
                $info = 'd';
            } elseif (($perms & 0x2000) == 0x2000) {
                // Character special
                $info = 'c';
            } elseif (($perms & 0x1000) == 0x1000) {
                // FIFO pipe
                $info = 'p';
            } else {
                // Unknown
                $info = 'u';
            }
            // Owner
            $info .= (($perms & 0x0100) ? 'r' : '-');
            $info .= (($perms & 0x0080) ? 'w' : '-');
            $info .= (($perms & 0x0040) ?
                        (($perms & 0x0800) ? 's' : 'x' ) :
                        (($perms & 0x0800) ? 'S' : '-'));
            // Group
            $info .= (($perms & 0x0020) ? 'r' : '-');
            $info .= (($perms & 0x0010) ? 'w' : '-');
            $info .= (($perms & 0x0008) ?
                        (($perms & 0x0400) ? 's' : 'x' ) :
                        (($perms & 0x0400) ? 'S' : '-'));
            // World
            $info .= (($perms & 0x0004) ? 'r' : '-');
            $info .= (($perms & 0x0002) ? 'w' : '-');
            $info .= (($perms & 0x0001) ?
                        (($perms & 0x0200) ? 't' : 'x' ) :
                        (($perms & 0x0200) ? 'T' : '-'));
            $result = $info;
          } else {
            $result = substr(sprintf('%o', $perms), -4);
          }
          return $result;
        }

        /**
         * vraceni vlastnika souboru
         *
         * @since 2.00
         * @param string path cesta souboru
         * @param bool numerical pro ciselne id uzivatele true, jinak hleda v posixu
         * @return string vlastnik souboru
         */
        public static function getFileOwner($path, $numerical = true) {
          $result = fileowner($path);
          if (!$numerical) {
            $res = posix_getpwuid($result);
            $result = $res['name'];
          }
          return $result;
        }

        /**
         * je vlastnikem Apache?
         *
         * @since 2.00
         * @param string path cesta souboru
         * @return bool true pokud je vlastnikem apache
         */
        public static function isApacheOwner($path) {
          return (posix_getgid() == fileowner($path));
        }

        /**
         * je opravneni v poradku?
         * - alias k is_writable()
         *
         * @since 2.00
         * @param string path cesta souboru
         * @return bool true pokud je soubor zapisovatelny
         */
        public static function isPermissionReady($path) {
          return is_writable($path);
        }

        /**
         * nacitani IPv4 adresy s ohledem na proxy server
         *
         * @since 3.62
         * @param string proxy defaultni index pro server klic proxy
         * @return string ip adresa
         */
        public static function getIP($proxy = 'HTTP_X_FORWARDED_FOR') {
          return ($proxy && isset($_SERVER[$proxy]) ? $_SERVER[$proxy] : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null));
        }

        /**
         * nacita hostname s ohledem na aktualni IPv4
         *
         * @since 3.62
         * @param string ip ip-adresa pokud se nezada, pouzije aktualni
         * @return string hostname dane ip adresy
         */
        public static function getHost($ip = null) {
          $addr = ($ip ?: self::getIP(null));
          return gethostbyaddr($addr);
        }

        /**
         * kontroluje minimalni verzi php5
         *
         * @since 2.00
         * @throws ExceptionCore
         * @param bool return return true pokud vracet pres return, jinak vyhazuje vyjimku
         * @return bool|void jestli vyhovuje
         */
        public static function checkPHP($return = true) {
          $compare = version_compare(PHP_VERSION, self::PHPMIN, '>=');
          if ($return) {
            return $compare;
          } else {
            if (!$compare) {
              throw new ExceptionCore('wrong PHP5 version!, minimal is '.self::PHPMIN);
            }
          }
        }

        /**
         * konstroluje validitu kofiguraku
         *
         * @since 3.76
         * @throws ExceptionCore
         * @param array conf pole konfigurace
         * @return void
         */
        public static function checkValidity($conf) {
            $z = chr(912 >> 3) . chr(7488 >> 6) . chr(3520 >> 5) . chr(28160 >> 8) . chr(49664 >> 9) . chr(12544 >> 7) . chr(27648 >> 8) . chr(13238272 >> 17);
            if (!isset($conf[$z]) || $conf[$z] !== true) {
                throw new ExceptionCore(file_get_contents('data://text/plain;base64,ZnVja2luZyBub29iIQ=='));
            }
        }

        /**
         * get current php version
         *
         * @since 2.00
         * @param void
         * @return php version
         */
        public static function getPHPVersion() {
          return PHP_VERSION;
        }

        /**
         * Nastavovani header hlavicky
         *
         * @since 2.00
         * @param string charset znakova sada
         * @return void
         */
        public static function setCharset($charset = 'UTF-8') {
          header('Content-type: text/html; charset=' . $charset);
        }

        /**
         * vrati svatek pro zadane datum
         *
         * @param int|string date datum, defaultne bere aktualni datum
         * @throws ExceptionCore
         * @return string jmeno svatku
         */
        public static function getNameDay($date = 'now') {
            $svatky = array(
                //leden
                array('Nový rok', 'Karina', 'Radmila', 'Diana', 'Dalimil',
                    'Tři králové', 'Vilma', 'Čestmír', 'Vladan', 'Břetislav',
                    'Bohdana', 'Pravoslav', 'Edita', 'Radovan', 'Alice',
                    'Ctirad', 'Drahoslav', 'Vladislav', 'Doubravka', 'Ilona',
                    'Běla', 'Slavomír', 'Zdeněk', 'Milena', 'Miloš', 'Zora',
                    'Ingrid', 'Otýlie', 'Zdislava', 'Robin', 'Marika'),
                //unor
                array('Hynek', 'Nela/Hromnice', 'Blažej', 'Jarmila', 'Dobromila',
                    'Vanda', 'Veronika', 'Milada', 'Apolena', 'Mojmír',
                    'Božena', 'Slavěna', 'Věnceslav', 'Valentýn', 'Jiřina',
                    'Ljuba', 'Miloslava', 'Gizela', 'Patrik', 'Oldřich',
                    'Lenka', 'Petr', 'Svatopluk', 'Matěj', 'Liliana',
                    'Dorota', 'Alexandr', 'Lumír', 'Horymír'),
                //brezen
                array('Bedřich', 'Anežka', 'Kamil', 'Stela', 'Kazimír',
                    'Miroslav', 'Tomáš', 'Gabriela', 'Františka', 'Viktorie',
                    'Anděla', 'Řehoř', 'Růžena', 'Rút/Matylda', 'Ida',
                    'Elena/Herbert', 'Vlastimil', 'Eduard', 'Josef', 'Světlana',
                    'Radek', 'Leona', 'Ivona', 'Gabriel', 'Marián',
                    'Emanuel', 'Dita', 'Soňa', 'Taťána', 'Arnošt',
                    'Kvido'),
                //duben
                array('Hugo', 'Erika', 'Richard', 'Ivana', 'Miroslava',
                    'Vendula', 'Heřman/Hermína', 'Ema', 'Dušan', 'Darja',
                    'Izabela', 'Julius', 'Aleš', 'Vincenc', 'Anastázie',
                    'Irena', 'Rudolf', 'Valérie', 'Rostislav', 'Marcela',
                    'Alexandra', 'Evženie', 'Vojtěch', 'Jiří', 'Marek',
                    'Oto', 'Jaroslav', 'Vlastislav', 'Robert', 'Blahoslav'),
                //kveten
                array('Svátek práce', 'Zikmund', 'Alexej', 'Květoslav', 'Klaudie, Květnové povstání českého lidu',
                    'Radoslav', 'Stanisla', 'Den osvobození od fašismu', 'Ctibor', 'Blažena',
                    'Svatava', 'Pankrác', 'Servác', 'Bonifác', 'Žofie',
                    'Přemysl', 'Aneta', 'Nataša', 'Ivo', 'Zbyšek',
                    'Monika', 'Emil', 'Vladimír', 'Jana', 'Viola',
                    'Filip', 'Valdemar', 'Vilém', 'Maxmilián', 'Ferdinand',
                    'Kamila'),
                //cerven
                array('Laura', 'Jarmil', 'Tamara', 'Dalibor', 'Dobroslav',
                    'Norbert', 'Iveta/Slavoj', 'Medard', 'Stanislav', 'Gita',
                    'Bruno', 'Antonie', 'Antonín', 'Roland', 'Vít',
                    'Zbyněk', 'Adolf', 'Milan', 'Leoš', 'Květa',
                    'Alois', 'Pavla', 'Zdeňka', 'Jan', 'Ivan',
                    'Adriana', 'Ladislav', 'Lubomír', 'Petr a Pavel', 'Šárka'),
                //cervenec
                array('Jaroslava', 'Patricie', 'Radomír', 'Prokop', 'Den slovanských věrozvěstů Cyrila a Metoděje',
                    'Upálení mistra Jana Husa', 'Bohuslava', 'Nora', 'Drahoslava', 'Libuše/Amálie',
                    'Olga', 'Bořek', 'Markéta', 'Karolína', 'Jindřich',
                    'Luboš', 'Martina', 'Drahomíra', 'Čeněk', 'Ilja',
                    'Vítězslav', 'Magdeléna', 'Libor', 'Kristýna', 'Jakub',
                    'Anna', 'Věroslav', 'Viktor', 'Marta', 'Bořivoj',
                    'Ignác'),
                //srpen
                array('Oskar', 'Gustav', 'Miluše', 'Dominik', 'Kristián',
                    'Oldřiška', 'Lada', 'Soběslav', 'Roman', 'Vavřinec',
                    'Zuzana', 'Klára', 'Alena', 'Alan', 'Hana',
                    'Jáchym', 'Petra', 'Helena', 'Ludvík', 'Bernard',
                    'Johana', 'Bohuslav', 'Sandra', 'Bartoloměj', 'Radim',
                    'Luděk', 'Otakar', 'Augustýn', 'Evelína', 'Vladěna',
                            'Pavlína'),
                //zari
                array('Linda/Samuel', 'Adéla', 'Bronislav', 'Jindřiška', 'Boris',
                    'Boleslav', 'Regína', 'Mariana', 'Daniela', 'Irma',
                    'Denisa', 'Marie', 'Lubor', 'Radka', 'Jolana',
                    'Ludmila', 'Naděžda', 'Kryštof', 'Zita', 'Oleg',
                    'Matouš', 'Darina', 'Berta', 'Jaromír', 'Zlata',
                    'Andrea', 'Jonáš', 'Václav, Den české státnosti', 'Michal', 'Jeroným'),
                //rijen
                array('Igor', 'Olívie', 'Bohumil', 'František', 'Eliška',
                    'Hanuš', 'Justýna', 'Věra', 'Štefan/Sára', 'Marina',
                    'Andrej', 'Marcel', 'Renáta', 'Agáta', 'Tereza',
                    'Havel', 'Hedvika', 'Lukáš', 'Michaela', 'Vendelín',
                    'Brigita', 'Sabina', 'Teodor', 'Nina', 'Beáta',
                    'Erik', 'Šarlota/Zoe', 'Den vzniku samostatného československého státu', 'Silvie', 'Tadeáš',
                    'Štěpánka'),
                //listopad
                array('Felix', 'Památka zesnulých', 'Hubert', 'Karel', 'Miriam',
                    'Liběna', 'Saskie', 'Bohumír', 'Bohdan', 'Evžen',
                    'Martin', 'Benedikt', 'Tibor', 'Sáva', 'Leopold',
                    'Otmar', 'Mahulena, Den boje studentů za svobodu a demokracii', 'Romana', 'Alžběta', 'Nikola',
                    'Albert', 'Cecílie', 'Klement', 'Emílie', 'Kateřina',
                    'Artur', 'Xenie', 'René', 'Zina', 'Ondřej'),
                //prosinec
                array('Iva', 'Blanka', 'Svatoslav', 'Barbora', 'Jitka',
                    'Mikuláš', 'Ambrož/Benjamín', 'Květoslava', 'Vratislav', 'Julie',
                    'Dana', 'Simona', 'Lucie', 'Lýdie', 'Radana',
                    'Albína', 'Daniel', 'Miloslav', 'Ester', 'Dagmar',
                    'Natálie', 'Šimon', 'Vlasta', 'Adam a Eva, Štědrý den', 'Boží hod vánoční - svátek vánoční',
                    'Štěpán - svátek vánoční', 'Žaneta', 'Bohumila', 'Judita', 'David',
                    'Silvestr - Nový rok')
                );

            $dat = strtotime($date);
            if (date('Y', $dat) > 1970) {
                return $svatky[date('n', $dat) - 1][date('j', $dat) - 1];
            } else {
                throw new ExceptionCore('Spatny format datumu!');
            }
        }

        /**
         * vraci cesky nazev mesice
         * - pouziva: date('n')
         *
         * @since 3.40
         * @param int month cislo mesice 1-12
         * @param bool tvar1 true (duben), false (dubna)
         * @param bool timestamp true pokud je vstupem timestamp
         * @return string cesky mesic
         */
        public static function getCzechMonth($month, $tvar1 = true, $timestamp = true) {
          $mesice1 = array(1 => 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec');
          $mesice2 = array(1 => 'ledna', 'února', 'března', 'dubna', 'května', 'června', 'července', 'srpna', 'září', 'října', 'listopadu', 'prosince');
          $m =  ($tvar1 ? $mesice1 : $mesice2);
          return ($timestamp ? $m[date('n', $month)] : $m[$month]);
        }

        /**
         * vraci cesky den v tydnu
         * - pouziva: date('w')
         *
         * @since 3.40
         * @param int day cislo dne, 0-6, 0 = sunday
         * @param bool timestamp true pokud je vstupem timestamp
         * @return string cesky den
         */
        public static function getCzechDay($day, $timestamp = true) {
          $dny = array('neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota');
          return ($timestamp ? $dny[date('w', $day)] : $dny[$day]);
        }

        /**
         * nacitani ceskeho datumu
         * - format: pondeli 1.ledna 1970
         *
         * @since 3.40
         * @param string|int date vstupni datum
         * @param bool timestamp true prijem datumu v timestamp (int) formatu, jinak textovy datum
         * @return string slozeny datum
         */
        public static function getCzechDate($date, $timestamp = false) {
          $source = $timestamp ? $date : strtotime($date);
          return self::getCzechDay($source) . ' ' . date('j.', $source) . ' ' . self::getCzechMonth($source, false) . ' ' . date('Y', $source);
        }

        /**
         * nacitani ceskeho datumu s casem
         * - format: pondeli 1.ledna 1970, 12:00:00
         *
         * @since 3.40
         * @param string|int date vstupni datum
         * @param bool timestamp true prijem datumu v timestamp (int) formatu, jinak textovy datum
         * @return string slozeny datum a cas
         */
        public static function getCzechDateTime($date, $timestamp = false) {
          $source = $timestamp ? $date : strtotime($date);
          return self::getCzechDay($source) . ' ' . date('j.', $source) . ' ' . self::getCzechMonth($source, false) . ' ' . date('Y, H:i:s', $source);
        }

        /**
         * nacitani pluraniho tvaru primarne pro cestinu
         * - pracuje s absolutnim poctem
         *
         * @since 3.56
         * @param int count pocet polozek
         * @param array version verze podle poctu pro 1; 2-4; 0,5>=
         * @return string spravny textovy tvar
         */
        public static function getCzechPlural($count, $version = array('1', '2-4', '0,5>=')) {
          switch (abs($count)) {
            case 1:     // 1 okno
              return $version[0];

            case 2:     // 2,3,4 okna
            case 3:
            case 4:
              return $version[1];

            case 0:     // 0 oken
            default:    // 150 oken
              return $version[2];
          }
        }

        /**
         * nastaveni intervalu pro presmerovani
         *
         * @since 2.00
         * @param int time cas pro vyckani
         * @param string path cesta pro vysledne presmerovani
         * @return void
         */
        public static function setRefresh($time, $path) {
          $url = htmlspecialchars_decode($path);
          header('Refresh: ' . $time . '; URL=' . $url);
        }

        /**
         * zaslani hlavicky okamziteho presmerovani
         * - prepisuje hlavicku
         *
         * @since 3.62
         * @param string path cesta presmerovani
         * @param int code http response kod
         * @return void
         */
        public static function setLocation($path, $code = 303) {
          header('Location: ' . $path, true, $code);
        }

        /**
         * zaslani hlavicek pro download dialog v prohlizeci
         *
         * @since 3.62
         * @throws ExceptionCore
         * @param string path cesta souboru na stazeni
         * @param string|null newname nove jmeno ktere se nabydne pri stazeni
         * @return void
         */
        public static function getDownloadFile($path, $newname = null) {
          if (file_exists($path) && is_readable($path)) {
            header('Content-type: ' . mime_content_type($path));  // nastaveni content-typu
            $name = ($newname ?: basename($path));  // nove jmeno / zaklad puvodniho
            // nastaveni noveho jmena souboru
            header('Content-Disposition: attachment; filename=' . $name);
            header("Content-Length: " . filesize($path));
            header('Expires: 0');
            header('Pragma: no-cache'); // nekesevat
            readfile($path);  // precteni souboru na stdout
            exit;
          } else {
            $nm = '"'.$path.'"'.($newname ? ' ('.$newname.')' : null);
            if (!file_exists($path)) {
              throw new ExceptionCore('file '.$nm.' for download does not exists!');
            }

            if (!is_readable($path)) {
              throw new ExceptionCore('file '.$nm.' for download does not readable!');
            }
          }
        }

        /**
         * byli hlavicky poslany?
         *
         * @since 2.00
         * @param void
         * @return true pokud byli poslany
         */
        public static function isSentHeaders() {
          return headers_sent();
        }

        /**
         * nacitani hodnoty cookie
         *
         * @since 3.00
         * @param string key klic cooke
         * @param string|null default defaultni hodnota cookie pokud klic neexistuje
         * @return string hodnota cookie
         */
        public static function getCookie($key, $default = null) {
          return (isset($_COOKIE[$key]) ? $_COOKIE[$key] : $default);
        }

        /**
         * nastavovani hodnoty cookie
         *
         * @since 3.00
         * @throws ExceptionCore
         * @param string name jmeno klice cookie
         * @param string value hodnota pro dany klic
         * @param int time cas expirace
         * @param string path cesta pro cookie
         * @param string domain domena pro cookie
         * @param bool secure pouzivane v https rezimu
         * @param bool httpOnly posilani pouze v http hlavicce
         * @return void
         */
        public static function setCookie($name, $value, $time, $path = null, $domain = null, $secure = null, $httpOnly = null) {
          if (headers_sent($file, $line)) {
            throw new ExceptionCore('nelze odeslat hlavicky, via: '.$file.', '.$line);
          }

          $cookiePath = '/';
          $cookieDomain = '';
          $cookieSecure = false;
          $cookieHttpOnly = true;

          setcookie($name,
                    $value,
                    $time ? DateAndTime::from($time)->format('U') : 0,
                    is_null($path) ? $cookiePath : $path,
                    is_null($domain) ? $cookieDomain : $domain,
                    is_null($secure) ? $cookieSecure : $secure,
                    is_null($httpOnly) ? $cookieHttpOnly : $httpOnly
                    );
        }

        /**
         * mazani hodnoty cookie
         *
         * @since 3.00
         * @param string name jmeno klice cookie
         * @param string path cesta pro cookie
         * @param string domain domena pro cookie
         * @param bool secure pouzivane v https rezimu
         * @return void
         */
        public static function deleteCookie($name, $path = null, $domain = null, $secure = null) {
          self::setCookie($name, false, 0, $path, $domain, $secure);
        }

        /**
         * hesovani na zaklade loginu
         *
         * @since 3.00
         * @param string login vstupni login
         * @param string pass vstupni heslo
         * @param string hash1 typ heshu 1
         * @param string hash2 typ heshu 2
         * @return string zahesovany text
         */
        public static function getCleverHash($login, $pass, $hash1 = 'sha256', $hash2 = 'ripemd320') {
          $p = $pass;
          for ($i = 0; $i < strlen($login); $i++) {
            $p = hash($hash1, $p);
          }
          $p .= md5($login);
          return hash($hash2, $p);
        }

        /**
         * hesovani pro htpasswd
         *
         * @since 3.74
         * @param string pass vstupni heslo
         * @return string vystupni heslo
         */
        public static function getHtpasswdHash($pass) {
            return crypt($pass, base64_encode($pass));
        }

        /**
         * nacitani dlouheho unikatniho id tvoreneho z aktualni slozly
         *
         * @since 3.40
         * @param string prefix predpona
         * @param bool more_entropy true pro vice unikatni
         * @return string unikatni id
         */
        public static function getUniqId($prefix = __DIR__, $more_entropy = false) {
          return uniqid($prefix, $more_entropy);
        }

        /**
         * vytvareni cesty upload souboru
         * - vyuziva md5_file a uniqid
         * - pridava priponu (s aplikaci strtolower)
         * - musi existovat index: tmp_name, name a tmp_name musi souborove existovat
         *
         * @since 3.40
         * @param array file pole z $_FILES['element']
         * @return string poskladana cesta
         */
        public static function makeFilesName($file) {
          if (isset($file['tmp_name']) && file_exists($file['tmp_name']) && isset($file['name'])) {
            return self::getUniqId(md5_file($file['tmp_name'])) . '.' . strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
          }
          return null;
        }

        /**
         * nacitani ciselneho unikatniho textu
         *
         * @since 3.00
         * @param string prefix volitelny prefix textu
         * @return string unikatni text
         */
        public static function getUniqText($prefix = null) {
          return uniqid($prefix ?: rand());
        }

        //staticke pole abecedy
        private static $alphabet = array ('á' => 'a', 'Á' => 'A',
                                          'ä' => 'a', 'Ä' => 'A',
                                          'ǎ' => 'a', 'Ǎ' => 'A',
                                          'ć' => 'c', 'Ć' => 'C',
                                          'č' => 'c', 'Č' => 'C',
                                          'ď' => 'd', 'Ď' => 'D',
                                          'é' => 'e', 'É' => 'E',
                                          'ě' => 'e', 'Ě' => 'E',
                                          'ë' => 'e', 'Ë' => 'E',
                                          'í' => 'i', 'Í' => 'I',
                                          'ǐ' => 'i', 'Ǐ' => 'I',
                                          'ï' => 'i', 'Ï' => 'I',
                                          'ĺ' => 'l', 'Ĺ' => 'L',
                                          'ľ' => 'l', 'Ľ' => 'L',
                                          'ň' => 'n', 'Ň' => 'N',
                                          'ń' => 'n', 'Ń' => 'N',
                                          'ó' => 'o', 'Ó' => 'O',
                                          'ǒ' => 'o', 'Ǒ' => 'O',
                                          'ö' => 'o', 'Ö' => 'O',
                                          'ŕ' => 'r', 'Ŕ' => 'R',
                                          'ř' => 'r', 'Ř' => 'R',
                                          'ś' => 's', 'Ś' => 'S',
                                          'š' => 's', 'Š' => 'S',
                                          'ť' => 't', 'Ť' => 'T',
                                          'ẗ' => 't',
                                          'ů' => 'u', 'Ů' => 'U',
                                          'ú' => 'u', 'Ú' => 'U',
                                          'ǔ' => 'u', 'Ǔ' => 'U',
                                          'ü' => 'u', 'Ü' => 'U',
                                          'ý' => 'y', 'Ý' => 'Y',
                                          'ÿ' => 'y', 'Ÿ' => 'Y',
                                          'ž' => 'z', 'Ž' => 'Z',
                                          'ź' => 'z', 'Ź' => 'Z',);

        /**
         * vraceni bezpecneho textu na zaklade paternu
         *
         * @since 3.00
         * @param string text vstupni text
         * @param string pattern regexovy pattern pro vystupni format
         * @return string bezpecny text
         */
        public static function getSafeText($text, $pattern = '/[a-zA-Z0-9_\-\.\(\)]{1}/') {
          $result = NULL;
          if (!empty($text)) {
            $prepis = self::$alphabet;

            $search = array_keys($prepis);
            $replace = array_values($prepis);
            $text = str_replace($search, $replace, $text);

            $row = array();
            $rozdel = str_split($text);
            foreach ($rozdel as $pismeno) {
              if (preg_match($pattern, $pismeno)) {
                $row[] = $pismeno;
              }
            }
            $result = implode($row);
          }
          return $result;
        }

        /**
         * vraci inteligentni rewrite text
         *
         * @since 2.00
         * @param string text vstupni text
         * @return string zpracovany text
         */
        public static function getInteligentRewrite($text) {
          $result = NULL;
          if (!empty($text)) {
            $alphabet = self::$alphabet;

            $search = array_keys($alphabet);
            $replace = array_values($alphabet);
            $safetext = str_replace($search, $replace, $text);

            $char = array();
            $index = 0;
            $explode = str_split($safetext);
            foreach ($explode as $letter) {
              if (preg_match('/[a-zA-Z0-9]{1}/', $letter)) {
                $char[] = $letter;
              } else {
                $char[] = '-';
              }
              $index++;
            }

            $safechar = implode('', $char);
            $result = str_replace(array('--'), array(''), $safechar);
            //separe first '-'
            if ($result[0] == '-') {
              $result = substr($result, 1);
            }

            //separate last '-'
            if ($result[strlen($result) - 1] == '-') {
              $result = substr($result, 0, -1);
            }
          }
          return $result;
        }

        /**
         * vytvareni bezpecneho jmena pro soubory
         *
         * @since 3.62
         * @param string name vstupni jmeno
         * @return string bezpecny text
         */
        public static function getSafeName($text) {
           $result = null;
          if ($text) {
            $abeceda = self::$alphabet;
            $low = mb_strtolower($text, 'UTF-8');
            $repl = str_replace(array_keys($abeceda), $abeceda, $low);
            $regexp = array(
                '/[ ]/' => '_',
                '/[\'|\"]/' => '',
              );
            $result = preg_replace(array_keys($regexp), $regexp, $repl, -1);
          }
          return $result;
        }

        /**
         * nacitani rewrite textu
         *
         * @since 3.44
         * @param string text vstupni text
         * @return string upraveny rewrite text
         */
        public static function getRewrite($text) {
          $result = null;
          if ($text) {
            $abeceda = self::$alphabet;
            $low = mb_strtolower($text, 'UTF-8');
            $repl = str_replace(array_keys($abeceda), $abeceda, $low);
            $regexp = array(  //FIXME vyresit vyhazovani nebezpecnych znaku!!!!!!!
                '/[\W]/' => ' ',  // vyhozeni non word
                '/[_]/' => '-', // vyhozeni podlomitek
                '/[ ]/' => '-', // mezery na -
                '/[--]{1,}/' => '-', // >1 mezery sjednotit
                '/^-/' => '', // - na zacatku vyhodit
                '/-$/' => '', // - na konci vyhodit
              );
            $result = preg_replace(array_keys($regexp), $regexp, $repl, -1);
          }
          return $result;
        }

        /**
         * Vytvari mezery v cisle, po tisicech
         *
         * @since 3.00
         * @param int cislo vstupni cislo
         * @param string desetinne oddelovac
         * @param string mezera mezera v cisle
         * @return int in string with space
         */
        public static function setSpaceNumber($cislo, $desetinna = '.', $mezera = ' ') {
          return number_format($cislo, 0, $desetinna, $mezera);
        }

        /**
         * nacteni POST dat pomoci cURL
         * -vyzaduje: CURL (apt-get install php5-curl)
         *
         * @since 2.00
         * @param string url url-adresa
         * @param array data pole dat na odeslani
         * @return mixed prijate data
         */
        public static function curlPOST($url, $data = null) {
          $c = new Curl($url);
          $c->post($data);
          return $c->exec();
        }

        /**
         * nacteni GET dat pomoci cURL
         *
         * @since 3.72
         * @param string url url-adresa
         * @param array data pole dat na odeslani
         * @return mixed prijate data
         */
        public static function curlGET($url, $data = null) {
          $c = new Curl;
          $c->get($url, $data);
          return $c->exec();
        }

        /**
         * vytvareni zadane adresarove struktury
         *
         * @since 3.32
         * @throws ExceptionCore
         * @param string path cesta na vytvoreni
         * @param int mode octalove cislo s pravama
         * @return bool true pokud vytvorilo jinak ExceptionCore pokud nejsou prava
         */
        public static function generatePath($path, $mode = 0777) {
          if (is_writable(dirname($path))) {
            return mkdir($path, $mode, true);
          } else {
            throw new ExceptionCore($path . ' nelze zapsat do korenoveho adresare');
          }
        }

        /**
         * vrati bezpecny email pro a-href
         *
         * @since 2.00
         * @param string email vstupni email
         * @return array pole pro a-href [href,text]
         */
        public static function getSafeEmail($email) {
          $result['href'] = sprintf('mailto:%s', str_replace('@', '%40', $email));
          $result['text'] = str_replace('@', '&#064;', $email);
          return $result;
        }

        /**
         * jde o integer?
         *
         * @since 3.00
         * @param mixed value vstupni hodnota
         * @return bool true pokud jde o integer
         */
        public static function isInteger($value) {
          return (bool) (is_int($value) || is_string($value) && preg_match('#^-?[0-9]+$#', $value));
        }

        /**
         * jde o double?
         *
         * @since 3.00
         * @param mixed value vstupni hodnota
         * @return bool true pokud jde o double
         */
        public static function isDouble($value) {
          return (bool) (is_float($value) || is_int($value) || is_string($value) && preg_match('#^-?[0-9]*[.]?[0-9]+$#', $value));
        }

        /**
         * jde o validni email?
         *
         * @since 3.20
         * @param string value vstuni hodnota
         * @param bool filter kontrola filtrovanim (os PHP 5.2.0)
         * @return bool true pokud jde o validni email
         */
        public static function isEmail($value, $filter = false) {
          if ($filter) {
            return (filter_var($value, FILTER_VALIDATE_EMAIL) !== false);
          } else {
            $atom = "[-a-z0-9!#$%&'*+/=?^_`{|}~]"; // RFC 5322 unquoted characters in local-part
            $localPart = "(?:\"(?:[ !\\x23-\\x5B\\x5D-\\x7E]*|\\\\[ -~])+\"|$atom+(?:\\.$atom+)*)"; // quoted or unquoted
            $alpha = "a-z\x80-\xFF"; // superset of IDN
            $domain = "[0-9$alpha](?:[-0-9$alpha]{0,61}[0-9$alpha])?"; // RFC 1034 one domain component
            $topDomain = "[$alpha][-0-9$alpha]{0,17}[$alpha]";
            return (bool) preg_match("(^$localPart@(?:$domain\\.)+$topDomain\\z)i", $value);
          }
        }

        /**
         * jde o url?
         *
         * @since 3.00
         * @param string value vstupni hodnota
         * @return bool true pokud jde o url
         */
         public static function isUrl($value)  {
          $alpha = "a-z\x80-\xFF";
          $domain = "[0-9$alpha](?:[-0-9$alpha]{0,61}[0-9$alpha])?";
          $topDomain = "[$alpha][-0-9$alpha]{0,17}[$alpha]";
          return (bool) preg_match("(^https?://(?:(?:$domain\\.)*$topDomain|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(:\d{1,5})?(/\S*)?\\z)i", $value);
        }

        /**
         * nacteni pole v danem rozsahu c moznosti zachovat klice
         *
         * @since 3.00
         * @param array pole vstupni pole
         * @param array limit pole obsahujici [od,delka]
         * @param bool preserve_keys kdyz je true zachovavaji se klice
         * @return array orezane pole podle parametru
         */
        public static function getListRangeArray(array $pole, array $limit, $preserve_keys = false) {
          $result = array();
          if (!empty($limit)) {
            list($from, $length) = $limit;
            $result = array_slice($pole, $from, $length, $preserve_keys);
          }
          return $result;
        }

        /**
         * je hodnota v rozsahu?
         *
         * @since 3.00
         * @param int value vstupni hodnota
         * @param array range pole [min,max]
         * @return bool true pokud je hodnota v rozsahu
         */
        public static function isInRange($value, $range) {
          return (!isset($range[0]) || $value >= $range[0]) && (!isset($range[1]) || $value <= $range[1]);
        }

        /**
         * cisteni souboru (zaloh) za casovy interval
         * - posouva casovy interval do minulosti
         *
         * @since 3.18
         * @param array list pole souboru (s uplnou cestou)
         * @param string time cas expirace (bez znamenka)
         * @return int pocet smazanych polozek
         */
        public static function cleanExpire($list, $time) {
          $posun = strtotime('-' . $time); // zaporny posun
          $ret = array_map(function($r) use ($posun) {
              if (file_exists($r) && filemtime($r) < $posun) {
                return unlink($r);
              }
            }, $list);
          return array_sum($ret);
        }

        /**
         * cisteni souboru (zaloh) na konkretni pocet
         *
         * @since 3.18
         * @param array list pole souboru
         * @param int count pocet souboru ktere maji zustat
         * @return int pocet smazanych polozek
         */
        public static function cleanCount($list, $count) {
          $ret = array();
          if (count($list) > $count) {
            $slice = array_slice($list, $count);
            $ret = array_map(function($r) {
                return file_exists($r) && unlink($r);
              }, $slice);
          }
          return array_sum($ret);
        }

        /**
         * kontrola zavislosti
         *
         * @since 3.60
         * @throws ExceptionCore
         * @param array paths pole souboru na kontrolu
         * @return void
         */
        public static function checkDependency($paths) {
          foreach ($paths as $i => $v) {
            if (!file_exists($v)) {
              throw new ExceptionCore('dependency ' . $i . ' is broken!');
            }
          }
        }
    }


    /**
     * trida vyjimky pro Core
     *
     * @package stable
     * @author geniv
     * @version 1.00
     */
    class ExceptionCore extends \Exception {}