<?php
/*
 * ipban.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;
//TODO dopsat a doplnit UnitTesty!!!
    /**
     * rozhranni s pouzivanyma konstantama
     *
     * @package stable
     * @author geniv
     * @version 1.06
     */
    interface IpRules {
        const ALLOW = 'Allow',
              DENY = 'Deny',
              ALL = 'all';

        const FILES_MATCH = 'FilesMatch',
              FILES = 'Files';

        const ALLOW_DENY = 'Allow,Deny',    // prvni povoleni (vse) pak zakazovani
              DENY_ALLOW = 'Deny,Allow',    // prvni zakazani (vse) pak povolovani
              HTACCESS = '.htaccess';

        const IPBAN_REGEX = '/##ipban##(.*)##\/ipban##/s',
              IPBAN_BEGIN = '##ipban##',
              IPBAN_END = '##/ipban##';
    }


    /**
     * rozhranni pro parametr metody addBan()
     *
     * @package stable
     * @author geniv
     * @version 1.02
     */
    interface IpBans extends IpRules {}


    /**
     * trida spravujici IP pravidla
     *
     * @package unstable
     * @author geniv
     * @version 2.06
     */
    class IpRule implements IpRules, IpBans {
        private $type, $ip;

        /**
         * defaultni konstruktor
         * - pokud se ip nepouzije bere se ALL
         *
         * @since 1.02
         * @param string type typ pristupu, moznosti: ALLOW, DENY
         * @param string ip ip adresa, zapis: x.x.x.x/x nebo x.x.x.x/x.x.x.x nebo ALL
         */
        public function __construct($type, $ip = self::ALL) {
            $this->type = strtolower($type) == 'allow' ? self::ALLOW : self::DENY;
            $this->ip = $ip;
        }

        /**
         * zpracovani vystupu z atributu
         *
         * @since 1.00
         * @param void
         * @return string slozena polozka
         */
        public function render() {
            return $this->type . ' from ' . $this->ip . PHP_EOL;
        }
    }


    /**
     * trida na spravu IP bloku na soubor/y
     *
     * @package unstable
     * @author geniv
     * @version 2.10
     */
    class IpRuleBlock implements IpRules, IpBans {
        private $type, $value;
        private $data = array();

        /**
         * defaultni konstruktor
         *
         * @since 1.00
         * @param string type typ bloku
         * @param string value podminka
         */
        public function __construct($type, $value) {
            $this->type = strtolower($type) == 'files' ? self::FILES : self::FILES_MATCH;
            $this->value = $value;
        }

        /**
         * pridavani ip pravidla do bloku
         *
         * @since 1.02
         * @param IpRule ip instance ip pravidla
         * @return this
         */
        public function addIp(IpRule $ip) {
            $this->data[] = $ip;
            return $this;
        }

        /**
         * vykresleni bloku
         *
         * @since 1.06
         * @param void
         * @return string vygenerovany blok v textu
         */
        public function render() {
            $result = PHP_EOL . '<' . $this->type . ' "' . $this->value . '">' . PHP_EOL;
            foreach ($this->data as $v) {
                $result .= '    ' . $v->render();
            }
            $result .= '</'.$this->type.'>' . PHP_EOL . PHP_EOL;
            return $result;
        }
    }


    /**
     * trida na generovani a ovladani ip-banu na urovni souboru .htaccess (Apache2)
     * - via: http://httpd.apache.org/docs/2.0/mod/core.html#filesmatch
     * - parsruje v bloku: ##ipban## ... ##/ipban##
     *
     * @package unstable
     * @author geniv
     * @version 2.16
     */
    class IpBan implements IpRules {
        private $state = self::ALLOW_DENY;
        private $path = '';

        private $data = null;

        /**
         * defaultni konstruktor
         *
         * @since 1.00
         * @param string path cesta k .htacess
         */
        public function __construct($path = '', $file = self::HTACCESS) {
            $this->path = $path . $file;
        }

        /**
         * vkadani noveho ip-pravidla nebo ip bloku pravidel
         * - prijima pouze rozhranni: IpBans (tridy: IpRule, IpRuleBlock)
         *
         * @since 2.16
         * @param IpBans ip instance odvozena z rozhranni IpBans
         * @param int poradi cislo poradi
         * @return this
         */
        public function addBan(IpBans $ip, $poradi = 0) {
            $this->data[] = $ip;    //TODO doimplementovat poradi!!!!
            return $this;
        }

        /**
         * nastavovani poradi vyhodnocovani pravidel
         * - pripravene konstanty: ALLOW_DENY, DENY_ALLOW
         *
         * @since 1.06
         * @param string state poradi vyhodnocovani, defaultne: ALLOW_DENY
         * @return this
         */
        public function setOrder($state) {
            $this->state = $state;
            return $this;
        }

        /**
         * parsrovani order razeni
         *
         * @since 1.08
         * @param string text vstupni text
         * @return string vyparsrovane poradi razeni
         */
        private function parseOrder($text) {
            preg_match('/^Order (.+)/', $text, $match);
            return isset($match[1]) ? $match[1] : null;
        }

        /**
         * pasrovani typu pristupu
         *
         * @since 1.08
         * @param string text vstupni text
         * @return string vyparsrovany typ pristupu
         */
        private function parseType($text) {
            if (preg_match('/^([ ]+)?(([a|A]llow)|([D|d]eny)).*/', $text, $match)) {
                return $match[2];
            }
            return null;
        }

        /**
         * parsrovani ip adresy
         *
         * @since 1.08
         * @param string text vstupni text
         * @return string vyparsrovana ip adresa
         */
        private function parseIp($text) {
            $ex = explode(' ', trim($text), 3); // orezani a rozdeleni na 3 polozky
            return isset($ex[2]) ? $ex[2] : null;
        }

        /**
         * parsrovani bloku files/filesmatch
         *
         * @since 1.12
         * @param string text vstupni text
         * @return array vyparsrovane bloky
         */
        private function isBlock($text) {
            preg_match('/(<Files "(.+)">)|(<FilesMatch "(.+)">)/', $text, $match);
            $result = array();
            switch (count($match)) {
                case 3:
                    return array('Files', $match[2]);

                case 5:
                    return array('FilesMatch', $match[4]);

                default:
                    return array();
            }
        }

        /**
         * je konec bloku?
         *
         * @since 1.12
         * @param string text vstupni text
         * @return bool true pokud jde o konec bloku
         */
        private function isCloseBlock($text) {
            return (bool) preg_match('/(<\/Files>)|(<\/FilesMatch>)/', $text);
        }

        /**
         * parsrovani .htacces souboru
         *
         * @since 1.04
         * @param void
         * @return array vyparsrovany htaccess
         */
        private function parseHtaccess() {
            $file = file_get_contents($this->path);

            $result = array();
            if (preg_match(self::IPBAN_REGEX, $file, $match)) { // vypreparovani bloku
                $block = $match[1];
                $rows = array_filter(explode(PHP_EOL, $block));

                $lastBlock = null;
                foreach ($rows as $v) {
                    // parsrovani poradi
                    if ($state = $this->parseOrder($v)) {
                        $this->state = $state;
                    }

                    $type = $this->parseType($v);
                    $ip = $this->parseIp($v);
                    $block = $this->isBlock($v);
                    if ($block) {
                        $lastBlock = new IpRuleBlock($block[0], $block[1]);
                    } else {
                        if ($type && $ip) {
                            $r = new IpRule($type, $ip);
                            if ($lastBlock) {
                                $lastBlock->addIp($r);  // vlozeni ip do bloku
                            } else {
                                $result[] = $r;  // vlozeni ip primo
                            }
                        }
                    }
                    if ($this->isCloseBlock($v)) {  // uzavreni bloku
                        $block = null;
                        $result[] = $lastBlock;
                        $lastBlock = null;
                    }
                }
            }
            return $result;
        }

        /**
         * pouhe vykresleni zaznamu pro IpBan
         *
         * @since 2.06
         * @param void
         * @return string vyrenderovane ip ban pravidla
         */
        public function render() {
            $res = null;
            if ($this->data) {
                foreach ($this->data as $v) {
                    $res .= $v->render();
                }
            }
            return  $res;
        }

        //TODO metodu ktera umozni interaktive vypisovat obsah a bude brat z: $this->data

        /**
         * nacteni ip ban konfigurace z .htaccess
         *
         * @since 1.02
         * @param void
         * @return this
         */
        public function load() {
            $this->data = $this->parseHtaccess($this->path);
            //~ var_dump($this->data);
            return $this;
        }

        /**
         * ulozeni konfigurace do .htaccess
         * - uklada jen pokud je neco v datove strukture
         *
         * @since 1.02
         * @param void
         * @return int pocet zapsanych bytu
         */
        public function save() {
            $result = null;
            if ($this->data) {
                $res = self::IPBAN_BEGIN . PHP_EOL . 'Order ' . $this->state . PHP_EOL;
                $res .= $this->render();
                $res .= self::IPBAN_END;

                if (is_writable($this->path)) {   // jen pokud jde zapisovat
                    return file_put_contents($this->path, preg_replace(self::IPBAN_REGEX, $res , file_get_contents($this->path)));
                } else {
                    throw new ExceptionIpBan('nelze zapisovat do ' . $this->path);
                }
            }
        }
    }

    /**
     * trida vyjimky pro IpBan
     *
     * @package stable
     * @author geniv
     * @version 1.00
     */
    class ExceptionIpBan extends \Exception {}