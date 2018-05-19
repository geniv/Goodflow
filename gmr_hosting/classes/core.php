<?php
/*
 * core.php
 *
 * Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 * pouzite externi tridy:
 * https://github.com/garetjax/phpbrowscap
 */

  namespace classes;
//TODO napsat komentare+vygenerovat testy!
  use DirectoryIterator,
      RecursiveIteratorIterator,
      RecursiveDirectoryIterator,
      UnexpectedValueException,
      DateTime;
//TODO vyhazet try bloky!
//FIXME vyhazet zbytecne metody!!!
  /**
   * Hlavni trida s nejpouzivanenejsimi statickymi metodami
   * je nevytvoritelna (abstraktni)
   *
   * @author geniv
   */
  abstract class Core {
    const VERSION = 2.72;
    //minimal version for php5
    const PHPMIN = '5.3.0';

    private static $worktime; //promena pro mereni casu
    private static $browscap = NULL;  //promenna browscap-u

    /**
     * zasilani text nebo pole do error logu
     *
     * @param text vstupni text nebo pole textu co se maji zalogovat
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

    /**
     * zapinani "ladicich" informaci, pro vysktu chyby chybu interpretuje a zaloguje
     *
     * @param show_memory zapinani logovani vytizeni pametu
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
     * @param settings pole nastaveni
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
     * @param settings pole nastaveni
     * @return absolutni url do aktualniho adresare
     */
    public static function getUrl(array $settings = array()) {
      $path = dirname($_SERVER['SCRIPT_NAME']);
      $end = self::getPartUrl($settings); //php_uname('n')
      return sprintf('http://%s%s/%s', $_SERVER['SERVER_NAME'], ($path != '/' ? $path : ''), $end);
    }

    /**
     * vytvoreni linku jako ve getUrl nebo getAbsoluteUrl
     *
     * @param url url pro odkaz
     * @param settings pole nastaveni
     * @return sestaveny bezpecny odkaz
     */
    public static function makeUrl($url, array $settings = array()) {
      return sprintf('%s%s', $url, self::getPartUrl($settings));
    }

    /**
     * zakodovani vstupniho textu podle sekvence kodu
     *
     * @param algorithms vstupni terezec algoritmu oddelenych +, dostupne algoritmy: hash_algos()
     * @param text vstupni text na zakodovani
     * @return nekolika nasobne zakodovany text
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
     *
     * @param settings pole nastaveni, rewrite(boolean), amp(string)
     * @return tener absolutni adresa webu
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
     * @return cesta stranek
     */
    public static function getWebPath() {
      return dirname($_SERVER['SCRIPT_FILENAME']);
    }

    /**
     * absolutni path webu, s moznosti urcit zdrojovou slozku
     *
     * @param sourcedir moznost urcit pocatecni adresar
     * @return absolutni path webu
     */
    public static function getAbsoluteWebPath($sourcedir = __DIR__) {
      $script = explode('/', $_SERVER['SCRIPT_FILENAME']);  //rozdeleni script pathe
      $dir = explode('/', $sourcedir); //rozdeleni aktualniho pathe
      return implode('/', array_intersect($script, $dir));  //slouceni pruniku
    }

    /**
     * vraci aktualni request url adresu
     *
     * @param url dodatek k adrese
     * @param length posun v indexech
     * @param offset pocatecni posun indexu
     * @return request adresa
     */
    public static function getRequestUrl($url = null, $length = null, $offset = 0) {
      $uniq = array_unique(explode('/', $_SERVER['REQUEST_URI'].'/'.$url));
      return 'http://'.$_SERVER['SERVER_NAME'].implode('/', array_slice($uniq, $offset, $length));
    }

    /**
     * vypocet prevodu velikosti
     *
     * @param size cislo velikosti pro prevod
     * @return vypocitana velikost
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
     *
     * @param filename path k souboru
     * @return zmerena a prepocitana velikost
     */
    public static function getFileSize($filename) {
      $result = NULL;
      if (file_exists($filename)) {
        $result = self::calculateSize(filesize($filename));
      }
      return $result;
    }

    public static function getFileModify($filename, $format = NULL) {
      $result = NULL;
      if (file_exists($filename)) {
        $result = filemtime($filename);
        if (!is_null($format)) {
          $result = date($format, $result);
        }
      }
      return $result;
    }

    /**
     * zacatek mereni casu
     */
    public static function startTime() {
      self::$worktime[0] = microtime(true); //vrati cas v mikro sec.
    }

    /**
     * konec mereni casu a vypocet s vypsanim
     *
     * @return cas vykonani
     */
    public static function stopTime() {
      self::$worktime[1] = microtime(true); //vrati cas v mikro sec.
      //nadefinovane symboly
      $symbol = array(-2 => '&mu;s', -1 => 'ms', 0 => 's');
      //vypocet rozdilu, vysledek je v sekundach
      $conv = round(self::$worktime[1] - self::$worktime[0], 10);
      //vypocet exponentu
      $exp = floor(log($conv) / log(1000));
      //vypocet vysledne hodnoty
      $converted = ($conv / pow(1000, floor($exp)));
      return sprintf('%.4f %s', $converted, $symbol[$exp]);
    }

    /**
     * kodovani dat, jen base64 // base64 + url**code
     *
     * @param data vstupni data na zakodovani
     * @param url zapina kodovani url
     * @return zakodovane data
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
     * @param data zakodovane data
     * @param url dekodovat z url
     * @return dekodovany text
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
     * @param data vstupni text
     * @return zakodovany retezec
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
     * @param data vstuni zakodovane data
     * @return dekodonany retezec
     */
    public static function easyDecode($data) {
      $pole = explode('a', $data);
      $func = function($value) { return chr($value); };
      $base = implode('', array_map($func, $pole));
      return base64_decode($base);  //dekodovani z prechodneho base64
    }

    /**
     * soucet velikosti obsahu adresare/adresaru
     *
     * @param path cesta adresare
     * @param recursive rekurzivne ano/ne
     * @return suma zmerene velikosti
     */
    public static function getSizeDir($path, $recursive = false) {
      try {
        $sum = 0;
        if (file_exists($path) && is_readable($path)) {
          //rozhodnuti jakou tridu pouzit
          if ($recursive) {
            //pokud prochazi rekurzivne
            $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
          } else {
            //pokud prochazi jen jednu slozku
            $it = new DirectoryIterator($path);
          }

          //pruchod iterace
          foreach ($it as $ifile) {
            //pokud je soubor
            if ($ifile->isFile()) {
              $sum += $ifile->getSize();
            }
          }
        }
      } catch (UnexpectedValueException $e) {
        echo $e;
      }
      return $sum;
    }

    /**
     * osetrovnani prazdnoty indexu pole, funkci "empty"
     *
     * @param array vstupní pole
     * @param key klic do pole
     * @param default defaultni hodnota, kdyz je vyhodnoceno jako prazdne
     * @return hodnota pole pod danym klicem pokud je neprazdne
     */
    public static function isFill($array, $key, $default = '') {
      return (!empty($array[$key]) ? $array[$key] : $default);
    }

    /**
     * osetrovani pokud klic pole existuje, funkci "array_key_exists"
     *
     * @param array vstupni pole
     * @param key klic do pole
     * @param defautl defaultni polozka
     * @return hodnota z pole pokud v poli existuje
     */
    public static function isNull($array, $key, $default = '') {
      return (is_array($array) && array_key_exists($key, $array) ? $array[$key] : $default);
    }

    /**
     * vkladani hodnoty pokud neni prazdna, funkci "empty"
     *
     * @param value vstupni hodnota
     * @param default defaultni polozka
     * @return hodnota value pokud je neprazdna, jinak vraci default
     */
    public static function isEmpty($value, $default = '') {
      return (!empty($value) ? $value : $default);
    }

    /**
     * vygenerovani nahodne barvy
     *
     * @param min pocatecni barva ve tvaru #rrggbb
     * @param max koncova barva ve tvaru #rrggbb
     * @return nahodna barva z rozsahu ve tvaru #rrggbb
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
              $res[] = dechex(rand(hexdec(implode('', $val)), hexdec(implode('', $_max[$i]))));
            }
            $result = implode('', $res);
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
     * @param itrems vstupni pole
     * @param param pole parametru, 'sort' => array()
     * @return pole s aplikovanym razenim
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
     * aplikace filtru na pole souboru
     *
     * @param itrems vstupni pole
     * @param param pole parametru, 'filter+/-' => array()
     * @return pole s aplikovanym filrem
     */
    private static function applyListFilter(array $items, array $param) {
      $filterp = self::isFill($param, 'filter+'); //akceptovat nebo
      $filterm = self::isFill($param, 'filter-'); //vynechat

      if (!empty($filterp) || !empty($filterm)) {
        $res = null;
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
     * @param param pole parametru, 'path' => ''
     * @return seznam adresaru
     */
    public static function getListDir(array $param) {
      try {
        $path = self::isFill($param, 'path'); //nacteni pathu
        $result = NULL;
        if (file_exists($path)) {
          $result = array();
          $it = new DirectoryIterator($path);
          foreach ($it as $row) {
            if ($row->isDir() && !$row->isDot()) {
              $result[] = $row->getFilename();
            }
          }
          $result = self::applyListSort($result, $param);
        }
      } catch (UnexpectedValueException $e) {
        echo $e;
      }
      return $result;
    }

    /**
     * nacteni seznamu souboru
     *
     * @param param pole parametru, 'path' => ''
     * @return seznam souboru
     */
    public static function getListFile(array $param) {
      try {
        $path = self::isFill($param, 'path'); //nacteni pathu
        $full = self::isFill($param, 'full', false); //plna cesta

        $result = NULL;
        if (file_exists($path)) {
          $result = array();
          $it = new DirectoryIterator($path);
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
      } catch (UnexpectedValueException $e) {
        echo $e;
      }
      return $result;
    }

    /**
     * vrati pocet slozek ve slozce
     *
     * @param param pole parametru, 'path' => ''
     * @return pocet slozek v adresari
     */
    public static function getCountListDir(array $param) {
      try {
        $path = self::isFill($param, 'path'); //nacteni pathu
        $result = NULL;
        if (file_exists($path)) {
          $result = 0;
          $it = new DirectoryIterator($path);
          foreach ($it as $row) {
            if ($row->isDir() && !$row->isDot()) {
              $result++;
            }
          }
        }
      } catch (UnexpectedValueException $e) {
        echo $e;
      }
      return $result;
    }

    /**
     * vrati pocet souboru ve slozce
     *
     * @param param pole parametru, 'path' => ''
     * @return vraci pocet souboru v adresari
     */
    public static function getCountListFile(array $param) {
      try {
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
          $it = new DirectoryIterator($path);
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
      } catch (UnexpectedValueException $e) {
        echo $e;
      }
      return $result;
    }

    /**
     * vrati pocet polozek ve slozce
     *
     * @param param pole parametru, 'path' => ''
     * @return vraci pole polozek v adresari
     */
    public static function getCountListItems(array $param) {
      try {
        $path = self::isFill($param, 'path'); //nacteni pathu
        $result = NULL;
        if (file_exists($path)) {
          $result = 0;
          $it = new DirectoryIterator($path);
          foreach ($it as $row) {
            if (!$row->isDot()) {
              $result++;
            }
          }
        }
      } catch (UnexpectedValueException $e) {
        echo $e;
      }
      return $result;
    }

    /**
     * vrati rekurzivni vypis adresare
     *
     * @param param pole parametru, 'path' => ''
     * @return vraci pole rekurzivne projiteho adresare
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
     * @param path cesta souboru
     * @param concat tvar spojeni souboru a cisla
     * @return pole s novym pathem a indexem
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
     * @param text vstupni text
     * @param width po kolika pismenech zkratit
     * @param trimmarker ukoncovaci znaky, defaultni "..."
     * @param encoding sada kodovani textu, defaultni "UTF-8"
     * @return zkraceny text s ukoncovacimi znaky
     */
    public static function trimMarker($text, $width, $trimmarker = '...', $encoding = 'UTF-8') {
      $result = $text;
      if ($width > 0) {
        $result = mb_strimwidth($text, 0, $width, $trimmarker, $encoding);
      }
      return $result;
    }

    /**
     * vrati aktualni user agent
     *
     * @return vraci aktualniho user-agenta
     */
    public static function getUserAgent() {
      return self::isFill($_SERVER, 'HTTP_USER_AGENT', null);
    }

//detekuje jestli se jedna o firefox
    public static function isFirefox($agent = NULL) { //pokud by bylo zapotrebi tak by se to rozsirilo podobne jako u chrome
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('#(Firefox|Shiretoko)/([a-zA-Z0-9\.]+)#i', $ua);
    }

//detekuje jestli se jedna o chrome
    public static function isChrome($agent = NULL, $version = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      //return (boolean) preg_match('#Chrome/([a-zA-Z0-9\.]+) Safari/([a-zA-Z0-9\.]+)#i', $ua);
      $result = NULL;
      if (!empty($version)) {
        $b = self::getBrowser($ua);
        $result = ($b->browser == 'Chrome' && $b->version == $version);
      } else {
        $result = (boolean) preg_match('#Chrome/([a-zA-Z0-9\.]+) Safari/([a-zA-Z0-9\.]+)#i', $ua);
      }
      return $result;
    }

//detekuje jestli se jedna o Safati
    public static function isSafari($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('#Safari/([a-zA-Z0-9\.]+)#i', $ua);
    }

//detekuje jestli se jedna o Operu
    public static function isOpera($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('#Opera[ /]([a-zA-Z0-9\.]+)#i', $ua);
    }

//detekuje jestli se jedna o Explorer
    public static function isIExplorer($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('#MSIE ([a-zA-Z0-9\.]+)#i', $ua);
    }

//detekuje jestli se jedna o android
    public static function isAndroid($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('#Android ([a-zA-Z0-9\.]+)#i', $ua);
    }

//detekuje jestli se jedna o iPhone
    public static function isiPhone($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('/(iPhone)/i', $ua);
    }

//detekuje jestli se jedna o iPod
    public static function isiPod($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('/(iPod)/i', $ua);
    }

//detekuje jestli se jedna o webOS
    public static function iswebOS($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('#webOS/([a-zA-Z0-9\.]+)#i', $ua);
    }

//detekuje jestli se jedna o Linux
    public static function isLinux($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('/(Linux)|(Android)/i', $ua);
    }

//detekuje jestli se jedna o Mac
    public static function isMac($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('/(Mac OS)|(Mac OS X)|(Mac_PowerPC)|(Macintosh)/i', $ua);
    }

//detekuje jestli se jedna o Windows
    public static function isWindows($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('/(Windows)/i', $ua);
    }

//detekuje jestli se jedna o jadro Webkit
    public static function isWebKit($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('#AppleWebKit/([a-zA-Z0-9\.]+)#i', $ua);
    }

//detekuje jestli se jedna o jadro Gecko
    public static function isGecko($agent = NULL) {
      $ua = (!empty($agent) ? $agent : self::getUserAgent());
      return (boolean) preg_match('#Gecko/([a-zA-Z0-9\.]+)#i', $ua);
    }

//slucovani pole title textu
    public static function implodeTitle(array $array, $separe = ' - ') {
      $result = NULL;
      if (!empty($array)) {
        $row = array();
        foreach ($array as $value) {
          if (!empty($value)) {
            $row[] = $value;
          }
        }
        $result = implode($separe, $row);
      }
      return $result;
    }

//vraceni opravneni souboru/slozky v plnem a nebo oktalovem modu
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

//jmeno vlastnika ciselne nebo textove
    public static function getFileOwner($path, $numerical = true) {
      $result = fileowner($path);
      if ($numerical) {
        $res = posix_getpwuid($result);
        $result = $res['name'];
      }
      return $result;
    }

//porovna jestli id je od apache
    public static function isApacheOwner($path) {
      return (posix_getgid() == fileowner($path));
    }

//zkontroluje jestli se da v adresari zapisovat, alias k: is_writable()
    public static function isPermissionReady($path) {
      return is_writable($path);
    }

    /**
     * Nacteni IP adresy s ohledem na proxy server
     *
     * @return ip adresa
     */
    public static function getIP() {
      return self::isFill($_SERVER, 'HTTP_X_FORWARDED_FOR', $_SERVER['REMOTE_ADDR']);
    }

//vrati host name
    public static function getHost() {
      //return gethostname();
      return gethostbyaddr(self::getIP());
    }

//TODO mozna spoluprace i s: http://www.useragentstring.com/
//FIXME DEPRECATED!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//inicializace browscapu
    public static function initBrowscap($path = __DIR__) {
      if (is_null(self::$browscap)) {
        $temp = sprintf('%s/.tmp', $path);  //slozeni cesty pro temp
        //vytvoreni slozky tempu
        if (!file_exists($temp)) {
          if (!@mkdir($temp, 0777)) {
            echo sprintf('nelze vytcorit "%s"', $temp);
          }
        }
        //pokud se do tempu zapisovat
        if (is_writable($temp)) {
          self::$browscap = new Browscap($temp);  //vytvoreni instance od staticke promennne
          self::$browscap->lowercase = true;  //nacte do cache a indexy z malich pismen
          //prvotni inicializace
          if (!file_exists(self::$browscap->cacheDir.self::$browscap->cacheFilename) ||
              !file_exists(self::$browscap->cacheDir.self::$browscap->iniFilename)) {
            print_r(self::$browscap->getBrowser());
            self::setLocation('.');
            exit(0);
          }
        }
      }
    }

    //prekryti metody z Browscap-u, vraci jeho objekt
    public static function getBrowser($user_agent = null, $return_array = false) {
      $result = NULL;
      if (!is_null(self::$browscap)) {
        $result = self::$browscap->getBrowser($user_agent, $return_array);
      }
      return $result;
    }

    /**
     * Check minimal php5 version
     *
     * @return bool jestli vyhovuje
     */
    public static function checkPHP() {
      return version_compare(PHP_VERSION, self::PHPMIN, '>=');
    }

    /**
     * get current php version
     *
     * @return php version
     */
    public static function getPHPVersion() {
      return PHP_VERSION;
    }

    /**
     * Nastavovani header hlavicky
     *
     * @param chat vystupni charser, defaultni UTF-8
     */
    public static function setCharset($char = 'UTF-8') {
      header(sprintf('Content-type: text/html; charset=%s', $char));
    }

    /**
     * Calculate holiday
     *
     * @param date int
     * @return string name
     */
    public static function getHoliday($date) {
      try {
                        //leden
        $svatek = array(array('Nový rok', 'Karina', 'Radmila', 'Diana', 'Dalimil',
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
                              'Silvestr - Nový rok'));

        $dat = strtotime($date);
        if (date('Y', $dat) > 1970) {
          return $svatek[date('n', $dat) - 1][date('j', $dat) - 1];
        } else {
          throw new ExceptionCore('Spatny format datumu!');
        }

      } catch (ExceptionCore $e) {
        echo $e;
      }
    }

    /**
     * vraci cesky nazev mesice
     * date('n')
     *
     * @param month cislo mesice 1-12
     * @param timestamp true pokud je vstupem timestamp
     * @return cesky mesic
     */
    public static function getCzechMonth($month, $tvar1 = true, $timestamp = true) {
      $mesice1 = array(1 => 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec');
      $mesice2 = array(1 => 'ledna', 'února', 'března', 'dubna', 'května', 'června', 'července', 'srpna', 'září', 'října', 'listopadu', 'prosince');
      $m =  ($tvar1 ? $mesice1 : $mesice2);
      return ($timestamp ? $m[date('n', $month)] : $m[$month]);
    }

    /**
     * vraci cesky den v tydnu
     * date('w')
     *
     * @param day cislo dne, 0-6, 0 = sunday
     * @param timestamp true pokud je vstupem timestamp
     * @return cesky den
     */
    public static function getCzechDay($day, $timestamp = true) {
      $dny = array('neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota');
      return ($timestamp ? $dny[date('w', $day)] : $dny[$day]);
    }

    /**
     * get difference two date
     *
     * @param startdate first date time
     * @param enddate second date time
     * @param format (optional) format output interval date
     * @return difference date object (or null)
     */
    public static function getDifferenceDate($startdate, $enddate, $format = null) {
      if (!empty($startdate) && !empty($enddate)) {
        //start time
        $d1 = new DateTime();
        $d1->setTimestamp(is_int($startdate) ? $startdate : strtotime($startdate));

        //end time
        $d2 = new DateTime();
        $d2->setTimestamp(is_int($enddate) ? $enddate : strtotime($enddate));

        //vypocet rozdilu
        $interval = $d1->diff($d2);
        if (!empty($format)) {
          return $interval->format($format);
        } else {
          return $interval;
        }
      } else {
        return null;
      }
    }

    /**
     * Nastaveni intervalu pro presmerovani
     *
     * @param time cas pro vyckani
     * @param path cesta pro vysledne presmerovani
     */
    public static function setRefresh($time, $path) {
      $url = htmlspecialchars_decode($path);
      header(sprintf('Refresh: %s; URL=%s', $time, $url));
    }

//presmerovani na dotycny (absolutni) path
    public static function setLocation($path) {
      header(sprintf('Location: %s', $path), true, 303);
    }

//vraci hodnotu z indexu cookie
    public static function getCookie($name) {
      return self::isFill($_COOKIE, $name);
    }

//nastavuje hodnotu cookie na index
    public static function setCookie($name, $value, $deltatime = 31536000) {
      setcookie($name, $value, Time() + $deltatime);
    }

//zruseni indexu cookie
    public static function unsetCookie($name, $deltatime = 31536000) {
      setcookie($name, '', Time() - $deltatime);
    }

//inicializace session
    public static function initSession($name = NULL) {
      @session_start();  //ma tehdenci nekdy zlobit!!!
      if (!empty($name)) {
        session_name($name);
      }
    }

//vraci hodnotu indexu session
    public static function getSession($name) {
      return self::isFill($_SESSION, $name);
    }

//nastaveni indexu session
    public static function setSession($name, $value) {
      $_SESSION[$name] = $value;
    }

//vraceni id session
    public static function getSessionId($id = NULL) {
      $result = session_id();
      if (!empty($id)) {
        $result = session_id($id);
      }
      return $result;
    }

//prinuti sesion o regeneraci id
    public static function setRenewSessionId() {
      session_regenerate_id();
    }

//vraci jmeno session
    public static function getSessionName() {
      return session_name();
    }

//vraci dlouhy unikatni text s dir
    public static function getUniqId() {
      return uniqid(__DIR__, true);
    }

//vraci dlouhy unikatni text s cisli
    public static function getUniqText($prefix = NULL) {
      return uniqid(self::isEmpty($prefix, rand()));
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

//vraci bezbecny text zpracovany dle vzoru
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
        $result = implode('', $row);
      }
      return $result;
    }

//vraci inteligentni rewrite
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
     * Vytvari mezery v cisle, po tisicech
     *
     * @method public static setSpaceNumber
     * @param cislo int
     * @param desetinne char
     * @param mezera char
     * @return int in string with space
     */
    public static function setSpaceNumber($cislo, $desetinna = '.', $mezera = ' ') {
      return number_format($cislo, 0, $desetinna, $mezera);
    }

//posilani post dat pres cURL
    public static function sendPostData($url, array $data) {
      //pokud je dostupny cURL
      if (extension_loaded('curl')) {
        $c = curl_init();
        $options = array (CURLOPT_URL => $url,
                          CURLOPT_POST => true,
                          CURLOPT_POSTFIELDS => $data,
                          );
        curl_setopt_array($c, $options);
        curl_exec($c);
        curl_close($c);
        exit;
      }
      //var_dump($_SERVER['HTTP_HOST']);
      //var_dump($_SERVER);
      //print_r(apache_request_headers());
    }
//TEST na rekurzivni generovani slozek!
//vytvareni struktury slozek podle znameho pathu
    public static function generatePath($path, $mode = 0777) {
      //~ if (is_array($path)) {
        //~ foreach ($path as $row) {
          //~ self::createPartPath($row);
        //~ }
      //~ } else {
        //~ self::createPartPath($path);
      //~ }
      return mkdir($path, $mode, true);
    }

//vytvyreni casti cesty
    //~ private static function createPartPath($path) {
      //~ try {
        //~ if (!empty($path)) {
          //~ $pole = explode('/', $path);
          //~ $dir = ''; //vynulovani generovaneho nazvu slozek
          //~ foreach ($pole as $value) {  //prochazi kazde jeden smer slozek
            //~ $dir .= sprintf('%s/', $value); //scita jmeno slozky
            //~ if (!file_exists($dir)) {  //overuje existenci
              //~ if (@mkdir($dir)) { //vytvari slozky
                //~ chmod($dir, 0777);  //nastavi opravneni na 777
              //~ } else {
                //~ throw new ExceptionCore(sprintf('dir "%s" does not create', $dir)); //opravneni
              //~ }
            //~ }
          //~ }
        //~ }
      //~ } catch (ExceptionCore $e) {
        //~ echo $e;
      //~ }
    //~ }

//zpracovava Google markup
    public static function getMarkupText($text, $ownpattern = array()) {
      $patterns = array('/_([^_]+)_/' => Html::em()->setText('$1'),
                        '/\*([^\*]+)\*/' => Html::strong()->setText('$1'),
                        '/\\n|\\\n/' => Html::br(),
                        );
      if (!empty($ownpattern)) {
        $patterns = array_merge($patterns, $ownpattern);
      }
      return self::getOptionalMarkup($text, $patterns);
    }

//volitelne znackovani/zpracovani textu
    public static function getOptionalMarkup($text, $patterns = array()) {
      //  '/^.../' => Html::...
      $regex = array_keys($patterns);
      return preg_replace($regex, $patterns, $text);
    }

//zpracovava BBCode
    public static function getBBCodeText($text, $ownpattern = array()) {
      $patterns = array('/\[b\](.*?)\[\/b\]/' => Html::strong()->setText('$1'),
                        '/\[b id=(.*?)\](.*?)\[\/b\]/' => Html::strong(array('id' => '$1'))->setText('$2'),
                        '/\[b class=(.*?)\](.*?)\[\/b\]/' => Html::strong(array('class' => '$1'))->setText('$2'),
                        '/\[i\](.*?)\[\/i\]/' => Html::em()->setText('$1'),
                        '/\[i id=(.*?)\](.*?)\[\/i\]/' => Html::em(array('id' => '$1'))->setText('$2'),
                        '/\[i class=(.*?)\](.*?)\[\/i\]/' => Html::em(array('class' => '$1'))->setText('$2'),
                        '/\[s\](.*?)\[\/s\]/' => Html::span()->setText('$1'),
                        '/\[s id=(.*?)\](.*?)\[\/s\]/' => Html::span(array('id' => '$1'))->setText('$2'),
                        '/\[s class=(.*?)\](.*?)\[\/s\]/' => Html::span(array('class' => '$1'))->setText('$2'),
                        '/\\n|\\\n/' => Html::br(),
                        );
      if (!empty($ownpattern)) {
        $patterns = array_merge($patterns, $ownpattern);
      }
      return self::getOptionalMarkup($text, $patterns);
    }

//vrati bezpecny email, jak pro href tak i text
    public static function getSafeEmail($email) {
      $result['href'] = sprintf('mailto:%s', str_replace('@', '%40', $email));
      $result['text'] = str_replace('@', '&#064;', $email);
      return $result;
    }

    //overovani jestli jde o integer
    public static function isInteger($value) {
      return (bool) (is_int($value) || is_string($value) && preg_match('#^-?[0-9]+$#', $value));
    }

    //overovani jestli jde o double
    public static function isDouble($value) {
      return (bool) (is_float($value) || is_int($value) || is_string($value) && preg_match('#^-?[0-9]*[.]?[0-9]+$#', $value));
    }

//overuje jestli je to validni email
    public static function isEmail($value) {
      $atom = "[-a-z0-9!#$%&'*+/=?^_`{|}~]"; // RFC 5322 unquoted characters in local-part
      $localPart = "(?:\"(?:[ !\\x23-\\x5B\\x5D-\\x7E]*|\\\\[ -~])+\"|$atom+(?:\\.$atom+)*)"; // quoted or unquoted
      $alpha = "a-z\x80-\xFF"; // superset of IDN
      $domain = "[0-9$alpha](?:[-0-9$alpha]{0,61}[0-9$alpha])?"; // RFC 1034 one domain component
      $topDomain = "[$alpha][-0-9$alpha]{0,17}[$alpha]";
      return (bool) preg_match("(^$localPart@(?:$domain\\.)+$topDomain\\z)i", $value);
    }

    //overuje jestli se jedna o validni url
     public static function isUrl($value)  {
      $alpha = "a-z\x80-\xFF";
      $domain = "[0-9$alpha](?:[-0-9$alpha]{0,61}[0-9$alpha])?";
      $topDomain = "[$alpha][-0-9$alpha]{0,17}[$alpha]";
      return (bool) preg_match("(^https?://(?:(?:$domain\\.)*$topDomain|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(:\d{1,5})?(/\S*)?\\z)i", $value);
    }

//vypis pole v danem rozsahu, s moznosti zachovavat klice
    public static function getListRangeArray(array $pole, array $limit, $preserve_keys = false) {
      $result = array();
      if (!empty($limit)) {
        list($from, $length) = $limit;
        $result = array_slice($pole, $from, $length, $preserve_keys);
      }
      return $result;
    }

  //test jestli se hodnota nachazi v rozsahu
    public static function isInRange($value, $range) {
      return (!isset($range[0]) || $value >= $range[0]) && (!isset($range[1]) || $value <= $range[1]);
    }

  }

  class ExceptionCore extends \Exception {}

?>
