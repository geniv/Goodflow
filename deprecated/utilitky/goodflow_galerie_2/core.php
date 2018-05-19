<?php
/*
 *      core.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  final class Core {
    //minimal version for php5
    const PHPMIN = '5.3.0';

/* //TODO zahrnout do testu!!!!
$ext = get_loaded_extensions();
$a = array('gettext', 'session', 'SimpleXML');
var_dump($ext);
*/

    /**
     * Load absolute web page adress
     *
     * @param $query sting
     * @return adress web page
     */
    public static function getAbsoluteUrl(array $query = array()) {
      $path = dirname($_SERVER["SCRIPT_NAME"]);
      $end = NULL;
      if (!empty($query)) {
        $end = sprintf('?%s', http_build_query($query));
      }
      return sprintf('http://%s%s/%s', $_SERVER["SERVER_NAME"], ($path != "/" ? $path : ""), $end);
    }

    /**
     * Nacitani cesty stranek
     *
     * @return cesta stranek
     */
    public static function getWebPath() {
      return dirname($_SERVER["SCRIPT_FILENAME"]);
    }

    /**
     * Vypocet prevodu velikosti
     *
     * @param size cislo velikosti pro prevod
     * @return prevedena velikost
     */
    public static function calculateSize($size) {
      $exp = 0;
      $converted = 0;
      //nadefinovane symboly
      $symbol = array("b", "kB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");
      //pokud je velikost > 0
      if ($size > 0) {
        //vypocet exponentu
        $exp = floor(log($size) / log(1024));
        //vypocet vysledne hodnoty
        $converted = ($size / pow(1024, floor($exp)));
      }

      return sprintf(($exp == 0 ? "%d {$symbol[$exp]}" : "%.2f {$symbol[$exp]}"), $converted);
    }

    //promena pro mereni casu
    protected static $worktime;

    /**
     * Zacatek mereni casu
     */
    public static function startTime() {
      self::$worktime[0] = microtime(true); //vrati cas v mikro sec.
    }

    /**
     * Konec mereni casu a vypocet s vypsanim
     *
     * @return cas vykonani
     */
    public static function stopTime() {
      self::$worktime[1] = microtime(true); //vrati cas v mikro sec.
      //nadefinovane symboly
      $symbol = array(-2 => "&mu;s", -1 => "ms", 0 => "s");
      //vypocet rozdilu, vysledek je v sekundach
      $conv = round(self::$worktime[1] - self::$worktime[0], 10);
      //vypocet exponentu
      $exp = floor(log($conv) / log(1000));
      //vypocet vysledne hodnoty
      $converted = ($conv / pow(1000, floor($exp)));

      return sprintf("%.4f {$symbol[$exp]}", $converted);
    }

    /**
     * Suma velikosti obsahu adresare/adresaru
     *
     * @param path cesta adresare
     * @param recursive rekurzivne ano/ne
     * @return suma zmerene velikosti
     */
    public static function getSizeDir($path, $recursive = false) {
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

      return $sum;
    }

    /**
     * Osetrovnani prazdnoty indexu pole
     *
     * @param array vstupní pole
     * @param key klic do pole
     * @param default defaultni hodnota, kdyz je vyhodnoceno jako prazdne
     * @return hodnota pole pod danym klicem pokud je neprazdne
     */
    public static function isFill($array, $key, $default = "") {
      return (!empty($array[$key]) ? $array[$key] : $default);
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
     * Aplikace razeni na pole
     *
     * @param itrems vstupni pole
     * @param param pole parametru, 'sort' => array()
     * @return pole s aplikovanym razenim
     */
    protected static function applyListSort(array $items, array $param) {
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
              $items = array_merge($intersect, $diff);  //souver pruniku a rozdilu
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
     * Aplikace filtru na pole
     *
     * @param itrems vstupni pole
     * @param param pole parametru, 'filter+/-' => array()
     * @return pole s aplikovanym filrem
     */
    protected static function applyListFilter(array $items, array $param) {
      $filterp = self::isFill($param, 'filter+'); //akceptovat nebo
      $filterm = self::isFill($param, 'filter-'); //vynechat

      if (!empty($filterp) || !empty($filterm)) {
        $res = NULL;
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
     * Nacteni seznamu adresaru
     *
     * @param param pole parametru, 'path' => ''
     * @return seznam adresaru
     */
    public static function getListDir(array $param) {
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

      return $result;
    }

    /**
     * Nacteni seznamu souboru
     *
     * @param param pole parametru, 'path' => ''
     * @return seznam souboru
     */
    public static function getListFile(array $param) {
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

      return $result;
    }

    public static function getCountListDir(array $param) {
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

      return $result;
    }

    public static function getCountListFile(array $param) {
      $path = self::isFill($param, 'path'); //nacteni pathu

      $result = NULL;
      if (file_exists($path)) {
        $result = 0;
        $it = new DirectoryIterator($path);
        foreach ($it as $row) {
          if ($row->isFile() && !$row->isDot()) {
            $result++;
          }
        }
      }

      return $result;
    }

    public static function getListRecursiveAll(array $param) {
      $path = self::isFill($param, 'path'); //nacteni pathu
      $full = self::isFill($param, 'full', false); //plna cesta

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

            if (is_file($fullpath)) {
              $result[] = (!$full ? $shortpath : $fullpath);
            }

            if (is_dir($fullpath)) {
              $param['path'] = $fullpath;
              if (!$full) {
                $param['_lengthreal'] = $lenreal;
              }
              $res = self::getListRecursiveAll($param); //rekurze
              $result = array_merge($result, $res);

              $resend[] = (!$full ? $shortpath : $fullpath);
            }
          }
        }
        $result = array_merge($result, $resend);
      }

      return $result;
    }
//TODO pridat i moznost na rozslisovani i konkretni verze!!!!
    public static function isFirefox($agent = NULL) {
      $ua = (!empty($agent) ? $agent : $_SERVER['HTTP_USER_AGENT']);
      return (boolean) preg_match('#(Firefox|Shiretoko)/([a-zA-Z0-9\.]+)#i', $ua);
    }

    public static function isChrome($agent = NULL) {
      $ua = (!empty($agent) ? $agent : $_SERVER['HTTP_USER_AGENT']);
      return (boolean) preg_match('#Chrome/([a-zA-Z0-9\.]+) Safari/([a-zA-Z0-9\.]+)#i', $ua);
    }

    public static function isSafari($agent = NULL) {
      $ua = (!empty($agent) ? $agent : $_SERVER['HTTP_USER_AGENT']);
      return (boolean) preg_match('#Safari/([a-zA-Z0-9\.]+)#i', $ua);
    }

    public static function isOpera($agent = NULL) {
      $ua = (!empty($agent) ? $agent : $_SERVER['HTTP_USER_AGENT']);
      return (boolean) preg_match('#Opera[ /]([a-zA-Z0-9\.]+)#i', $ua);
    }

    public static function isIExplorer($agent = NULL) {
      $ua = (!empty($agent) ? $agent : $_SERVER['HTTP_USER_AGENT']);
      return (boolean) preg_match('#MSIE ([a-zA-Z0-9\.]+)#i', $ua);
    }

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
     * Nacteni IP adresy s ohledem na proxy server
     *
     * @return ip adresa
     */
    public static function getIP() {
      return self::isFill($_SERVER, 'HTTP_X_FORWARDED_FOR', $_SERVER["REMOTE_ADDR"]);
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
     * Nastavovani ehader hlavicky
     *
     * @param chat vystupni charser, defaultni UTF-8
     */
    public static function setCharset($char = 'UTF-8') {
      header("Content-type: text/html; charset={$char}");
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
        $svatek = array(array("Nový rok", "Karina", "Radmila", "Diana", "Dalimil",
                              "Tři králové", "Vilma", "Čestmír", "Vladan", "Břetislav",
                              "Bohdana", "Pravoslav", "Edita", "Radovan", "Alice",
                              "Ctirad", "Drahoslav", "Vladislav", "Doubravka", "Ilona",
                              "Běla", "Slavomír", "Zdeněk", "Milena", "Miloš", "Zora",
                              "Ingrid", "Otýlie", "Zdislava", "Robin", "Marika"),
                        //unor
                        array("Hynek", "Nela/Hromnice", "Blažej", "Jarmila", "Dobromila",
                              "Vanda", "Veronika", "Milada", "Apolena", "Mojmír",
                              "Božena", "Slavěna", "Věnceslav", "Valentýn", "Jiřina",
                              "Ljuba", "Miloslava", "Gizela", "Patrik", "Oldřich",
                              "Lenka", "Petr", "Svatopluk", "Matěj", "Liliana",
                              "Dorota", "Alexandr", "Lumír", "Horymír"),
                        //brezen
                        array("Bedřich", "Anežka", "Kamil", "Stela", "Kazimír",
                              "Miroslav", "Tomáš", "Gabriela", "Františka", "Viktorie",
                              "Anděla", "Řehoř", "Růžena", "Rút/Matylda", "Ida",
                              "Elena/Herbert", "Vlastimil", "Eduard", "Josef", "Světlana",
                              "Radek", "Leona", "Ivona", "Gabriel", "Marián",
                              "Emanuel", "Dita", "Soňa", "Taťána", "Arnošt",
                              "Kvido"),
                        //duben
                        array("Hugo", "Erika", "Richard", "Ivana", "Miroslava",
                              "Vendula", "Heřman/Hermína", "Ema", "Dušan", "Darja",
                              "Izabela", "Julius", "Aleš", "Vincenc", "Anastázie",
                              "Irena", "Rudolf", "Valérie", "Rostislav", "Marcela",
                              "Alexandra", "Evženie", "Vojtěch", "Jiří", "Marek",
                              "Oto", "Jaroslav", "Vlastislav", "Robert", "Blahoslav"),
                        //kveten
                        array("Svátek práce", "Zikmund", "Alexej", "Květoslav", "Klaudie, Květnové povstání českého lidu",
                              "Radoslav", "Stanisla", "Den osvobození od fašismu", "Ctibor", "Blažena",
                              "Svatava", "Pankrác", "Servác", "Bonifác", "Žofie",
                              "Přemysl", "Aneta", "Nataša", "Ivo", "Zbyšek",
                              "Monika", "Emil", "Vladimír", "Jana", "Viola",
                              "Filip", "Valdemar", "Vilém", "Maxmilián", "Ferdinand",
                              "Kamila"),
                        //cerven
                        array("Laura", "Jarmil", "Tamara", "Dalibor", "Dobroslav",
                              "Norbert", "Iveta/Slavoj", "Medard", "Stanislav", "Gita",
                              "Bruno", "Antonie", "Antonín", "Roland", "Vít",
                              "Zbyněk", "Adolf", "Milan", "Leoš", "Květa",
                              "Alois", "Pavla", "Zdeňka", "Jan", "Ivan",
                              "Adriana", "Ladislav", "Lubomír", "Petr a Pavel", "Šárka"),
                        //cervenec
                        array("Jaroslava", "Patricie", "Radomír", "Prokop", "Den slovanských věrozvěstů Cyrila a Metoděje",
                              "Upálení mistra Jana Husa", "Bohuslava", "Nora", "Drahoslava", "Libuše/Amálie",
                              "Olga", "Bořek", "Markéta", "Karolína", "Jindřich",
                              "Luboš", "Martina", "Drahomíra", "Čeněk", "Ilja",
                              "Vítězslav", "Magdeléna", "Libor", "Kristýna", "Jakub",
                              "Anna", "Věroslav", "Viktor", "Marta", "Bořivoj",
                              "Ignác"),
                        //srpen
                        array("Oskar", "Gustav", "Miluše", "Dominik", "Kristián",
                              "Oldřiška", "Lada", "Soběslav", "Roman", "Vavřinec",
                              "Zuzana", "Klára", "Alena", "Alan", "Hana",
                              "Jáchym", "Petra", "Helena", "Ludvík", "Bernard",
                              "Johana", "Bohuslav", "Sandra", "Bartoloměj", "Radim",
                              "Luděk", "Otakar", "Augustýn", "Evelína", "Vladěna",
                              "Pavlína"),
                        //zari
                        array("Linda/Samuel", "Adéla", "Bronislav", "Jindřiška", "Boris",
                              "Boleslav", "Regína", "Mariana", "Daniela", "Irma",
                              "Denisa", "Marie", "Lubor", "Radka", "Jolana",
                              "Ludmila", "Naděžda", "Kryštof", "Zita", "Oleg",
                              "Matouš", "Darina", "Berta", "Jaromír", "Zlata",
                              "Andrea", "Jonáš", "Václav, Den české státnosti", "Michal", "Jeroným"),
                        //rijen
                        array("Igor", "Olívie", "Bohumil", "František", "Eliška",
                              "Hanuš", "Justýna", "Věra", "Štefan/Sára", "Marina",
                              "Andrej", "Marcel", "Renáta", "Agáta", "Tereza",
                              "Havel", "Hedvika", "Lukáš", "Michaela", "Vendelín",
                              "Brigita", "Sabina", "Teodor", "Nina", "Beáta",
                              "Erik", "Šarlota/Zoe", "Den vzniku samostatného československého státu", "Silvie", "Tadeáš",
                              "Štěpánka"),
                        //listopad
                        array("Felix", "Památka zesnulých", "Hubert", "Karel", "Miriam",
                              "Liběna", "Saskie", "Bohumír", "Bohdan", "Evžen",
                              "Martin", "Benedikt", "Tibor", "Sáva", "Leopold",
                              "Otmar", "Mahulena, Den boje studentů za svobodu a demokracii", "Romana", "Alžběta", "Nikola",
                              "Albert", "Cecílie", "Klement", "Emílie", "Kateřina",
                              "Artur", "Xenie", "René", "Zina", "Ondřej"),
                        //prosinec
                        array("Iva", "Blanka", "Svatoslav", "Barbora", "Jitka",
                              "Mikuláš", "Ambrož/Benjamín", "Květoslava", "Vratislav", "Julie",
                              "Dana", "Simona", "Lucie", "Lýdie", "Radana",
                              "Albína", "Daniel", "Miloslav", "Ester", "Dagmar",
                              "Natálie", "Šimon", "Vlasta", "Adam a Eva, Štědrý den", "Boží hod vánoční - svátek vánoční",
                              "Štěpán - svátek vánoční", "Žaneta", "Bohumila", "Judita", "David",
                              "Silvestr - Nový rok"));

        $dat = strtotime($date);
        if (date("Y", $dat) > 1970) {
          return $svatek[date("n", $dat) - 1][date("j", $dat) - 1];
        } else {
          throw new ExceptionCore;
        }

      } catch (ExceptionCore $e) {
        echo 'Spatny format datumu!';
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
      header("Refresh: {$time}; URL={$url}");
    }

    public static function getCookie($name) {
      return self::isFill($_COOKIE, $name);
    }

    public static function setCookie($name, $value, $deltatime = 31536000) {
      setcookie($name, $value, Time() + $deltatime);
    }

    public static function unsetCookie($name, $deltatime = 31536000) {
      setcookie($name, '', Time() - $deltatime);
    }

    public static function initSession($name = NULL) {
      session_start();
      if (!empty($name)) {
        session_name($name);
      }
    }

    public static function getSession($name) {
      return self::isFill($_SESSION, $name);
    }

    public static function setSession($name, $value) {
      $_SESSION[$name] = $value;
    }

    public static function getSessionId($id = NULL) {
      $result = session_id();
      if (!empty($id)) {
        $result = session_id($id);
      }
      return $result;
    }

    public static function setRenewSessionId() {
      session_regenerate_id();
    }

    public static function getSessionName() {
      return session_name();
    }

    //synchronizacni funkce pro miniatury
    //cyklicke opravovani (prejmenovani) nazvu slozek
    //osetrovani jmena
      //imagick bude volany v indexu jako externi objekt

    //tak nespecha:
    //nejak error message??
    //rozlisovani os, browser apod...
    //detekce prohlizecu a ruznych os
    //centralni hlasky!
    //obsluha curl s cache
    //obsluha last error

    //debug mod
    //vytvareni slozek

    //TODO preklady udelat mozna uplne jinak!! kdyz vyuzivam objektovych indexu!!!
    //na sqlite databaze vkladat dotoaz: VACUUM , pac pry datazaeb po delete nemaze ...


    protected static $alphabet = array ("á" => "a", "Á" => "A",
                                        "ä" => "a", "Ä" => "A",
                                        "ǎ" => "a", "Ǎ" => "A",
                                        "ć" => "c", "Ć" => "C",
                                        "č" => "c", "Č" => "C",
                                        "ď" => "d", "Ď" => "D",
                                        "é" => "e", "É" => "E",
                                        "ě" => "e", "Ě" => "E",
                                        "ë" => "e", "Ë" => "E",
                                        "í" => "i", "Í" => "I",
                                        "ǐ" => "i", "Ǐ" => "I",
                                        "ï" => "i", "Ï" => "I",
                                        "ĺ" => "l", "Ĺ" => "L",
                                        "ľ" => "l", "Ľ" => "L",
                                        "ň" => "n", "Ň" => "N",
                                        "ń" => "n", "Ń" => "N",
                                        "ó" => "o", "Ó" => "O",
                                        "ǒ" => "o", "Ǒ" => "O",
                                        "ö" => "o", "Ö" => "O",
                                        "ŕ" => "r", "Ŕ" => "R",
                                        "ř" => "r", "Ř" => "R",
                                        "ś" => "s", "Ś" => "S",
                                        "š" => "s", "Š" => "S",
                                        "ť" => "t", "Ť" => "T",
                                        "ẗ" => "t",
                                        "ů" => "u", "Ů" => "U",
                                        "ú" => "u", "Ú" => "U",
                                        "ǔ" => "u", "Ǔ" => "U",
                                        "ü" => "u", "Ü" => "U",
                                        "ý" => "y", "Ý" => "Y",
                                        "ÿ" => "y", "Ÿ" => "Y",
                                        "ž" => "z", "Ž" => "Z",
                                        "ź" => "z", "Ź" => "Z",);

  //FIXME zkontrolovat popis, upravit pripadne vymyslet lip
  //tady ty prevody testnout na standartnim testu češtiny!
    public static function getSafeText($text, $pattern = "/[a-zA-Z0-9_\-\.\(\)]{1}/") {
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

        $result = implode("", $row);
      }

      return $result;
    }

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

  //FIXME zkontrolovat popis, upravit pripadne vymyslet lip
    /**
     *
     * Prepis textu podle rewrite standardu by GFdesign.cz
     *
     * @param text vstupni text
     * @param out vystupni nastaveni >> "up" (upper), "low" (lower), NULL (zanecha velikost)
     * @return prepsavy text posle prepisovaciho pole
     */
/*
    //public static function getRewriteText($text, $out = NULL) {
      $prepis = array("á" => "a", "Á" => "A",
                      "ä" => "a", "Ä" => "A",
                      "ǎ" => "a", "Ǎ" => "A",
                      "ć" => "c", "Ć" => "C",
                      "č" => "c", "Č" => "C",
                      "ď" => "d", "Ď" => "D",
                      "é" => "e", "É" => "E",
                      "ě" => "e", "Ě" => "E",
                      "ë" => "e", "Ë" => "E",
                      "í" => "i", "Í" => "I",
                      "ǐ" => "i", "Ǐ" => "I",
                      "ï" => "i", "Ï" => "I",
                      "ĺ" => "l", "Ĺ" => "L",
                      "ľ" => "l", "Ľ" => "L",
                      "ň" => "n", "Ň" => "N",
                      "ń" => "n", "Ń" => "N",
                      "ó" => "o", "Ó" => "O",
                      "ǒ" => "o", "Ǒ" => "O",
                      "ö" => "o", "Ö" => "O",
                      "ŕ" => "r", "Ŕ" => "R",
                      "ř" => "r", "Ř" => "R",
                      "ś" => "s", "Ś" => "S",
                      "š" => "s", "Š" => "S",
                      "ť" => "t", "Ť" => "T",
                      "ẗ" => "t",
                      "ů" => "u", "Ů" => "U",
                      "ú" => "u", "Ú" => "U",
                      "ǔ" => "u", "Ǔ" => "U",
                      "ü" => "u", "Ü" => "U",
                      "ý" => "y", "Ý" => "Y",
                      "ÿ" => "y", "Ÿ" => "Y",
                      "ž" => "z", "Ž" => "Z",
                      "ź" => "z", "Ź" => "Z",
                      " " => "-", "	" => "-",
                      "." => "-",
                      "(" => "-", ")" => "-",
                      "[" => "-", "]" => "-",
                      "{" => "-", "}" => "-",
                      "ˇ" => "-", "´" => "-",
                      "+" => "-",
                      //"-" => "_",
                      "*" => "-",
                      "/" => "-",  // /
                      "=" => "-",
                      ";" => "-",
                      ":" => "-",
                      "," => "-",
                      "'" => "-",
                      "\'" => "-",
                      "?" => "-",
                      "<" => "-", ">" => "-",
                      "\\" => "-",  // \
                      "|" => "-",
                      "!" => "-",
                      "@" => "-",
                      "%" => "-",
                      //"\"" => "-",
                      //"&quot;" => "-",
                      "&" => "-",
                      "-quot-" => "-",
                      "§" => "-",
                      "#" => "-",
                      "$" => "-",
                      "˚" => "-", "°" => "-",
                      "`" => "-",
                      "~" => "-",
                      "^" => "-",
                      "€" => "-",
                      "¶" => "-",
                      "¨" => "-",
                      "ŧ" => "-", "Ŧ" => "-",
                      "¯" => "-",
                      "–" => "-",
                      "←" => "-", "→" => "-", "↓" => "-",
                      "ø" => "-",
                      "þ" => "-",
                      "Đ" => "-",
                      "đ" => "-",
                      "ł" => "-",
                      "Ł" => "-",
                      );

      $search = array_keys($prepis);
      $replace = array_values($prepis);
      $result = str_replace($search, $replace, $text);

      switch ($out) {
        case "up":
          $result = mb_strtoupper($result, "UTF-8");
        break;

        case "low":
          $result = mb_strtolower($result, "UTF-8");
        break;
      }

      return $result;
    }
*/
  //FIXME zkontrolovat popis
    /**
     * Vytvari mezery v cisle, po tisicech
     *
     * @param cislo int
     * @param desetinne char
     * @param mezera char
     * @return int in string with space
     */
    public static function getSpaceNumber($cislo, $desetinna = ".", $mezera = " ") {
      return number_format($cislo, 0, $desetinna, $mezera);
    }
  }

  class ExceptionCore extends Exception {}

?>
