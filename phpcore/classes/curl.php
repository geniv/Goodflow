<?php
/*
 * curl.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;

    /**
     * obsluha cURL knihovny
     * - vyzaduje: CURL (apt-get install php5-curl)
     *
     * @package stable
     * @author geniv
     * @version 1.38
     */
    class Curl {
        private $res = null;
        private $url = null;
        private $timeout = 10;
        private $returntransfer = true;
        private $header = false;
        private $useragent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.114 Safari/537.36';
        private $options = array();
        private $info = null;
        private $autoRequest = true;    // automaticke provadeni pri metodach get/post/put/delete...

        /**
         * defaultni konstruktor
         *
         * @param string url adresa, nepovinna
         * @since 1.00
         */
        public function __construct($url = null) {
            if (self::isLoaded()) {
                $this->res = curl_init($url);
                if ($url) {
                    $this->setUrl($url);
                }
            } else {
                throw new ExceptionCurl('PHP extension cURL must be loaded!');
            }
        }

        /**
         * tovarni metoda na staticke vyuziti
         *
         * @since 1.36
         * @param string url adresa
         * @return vlastni instance Curl
         */
        public static function factory($url) {
            return new self($url);
        }

        /**
         * je cURL nacten jako modul?
         *
         * @since 1.02
         * @param void
         * @return bool true kdyz je nacteno
         */
        public static function isLoaded() {
            return extension_loaded('curl');
        }

        /**
         * nacteni timeoutu
         *
         * @since 1.24
         * @param void
         * @return int casovy timeout
         */
        public function getTimeout() {
            return $this->timeout;
        }

        /**
         * nastavovani timeout
         * - The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
         *
         * @since 1.04
         * @param int timeout cas, defaultne 10
         * @return this
         */
        public function setTimeout($timeout) {
            $this->timeout = intval($timeout);
            return $this;
        }

        /**
         * nacteni vraceni do promenne
         *
         * @since 1.24
         * @param void
         * @return bool true kdyz vraci do promenne
         */
        public function getReturnTransfer() {
            return $this->returntransfer;
        }

        /**
         * nastaveni vraceni do promenne
         * - TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
         *
         * @since 1.06
         * @param bool state true pro povoleni vraceni do promenne
         * @return this
         */
        public function setReturnTransfer($state) {
            $this->returntransfer = (bool) $state;
            return $this;
        }

        /**
         * nacteni vraceni hlavicek
         *
         * @since 1.24
         * @param void
         * @return bool true kdyz vracet hlavicky
         */
        public function getHeader() {
            return $this->header;
        }

        /**
         * nastaveni vraceni hlavicek
         * - TRUE to include the header in the output.
         *
         * @since 1.08
         * @param bool state true pro vraceni hlavicek, defaultni false
         * @return this
         */
        public function setHeader($state) {
            $this->header = (bool) $state;
            return $this;
        }

        /**
         * nacteni user agenta
         *
         * @since 1.30
         * @param void
         * @return string text user agenta
         */
        public function getUseragent() {
            return $this->useragent;
        }

        /**
         * nastaveni user agenta
         * - The contents of the "User-Agent: " header to be used in a HTTP request.
         *
         * @since 1.10
         * @param string agent text usera agenta ktery se ma pouzit pri pristupu
         * @return this
         */
        public function setUseragent($agent) {
            if ($agent) {
                $this->useragent = $agent;
            }
            return $this;
        }

        /**
         * pridani http hlavicek
         *
         * @since 1.34
         * @param string header hlavicka ('Content-Type: application/xml', ...)
         * @return this
         */
        public function addHttpHeader($header) {
            $h = &$this->options[CURLOPT_HTTPHEADER];
            if ($header && !in_array($header, (array) $h)) {
                $h[] = $header;
            }
            return $this;
        }

        /**
         * nacteni pole informaci po provedenem spojeni, po zavolani metody: exec()
         * - obsahuje informace z: http://php.net/manual/en/function.curl-getinfo.php
         *
         * @since 1.32
         * @param void
         * @return array pole informaci nactenych ze spojeni
         */
        public function getInfo() {
            return $this->info;
        }

        /**
         * nacteni moznosti
         *
         * @since 1.28
         * @param string key klic nastaveni
         * @return mixed hodnota nastaveni
         */
        public function getOption($key) {
            return (isset($this->options[$key]) ? $this->options[$key] : (!$key ? $this->options : null));
        }

        /**
         * nastavovani moznosti
         * - vice moznosti: http://www.php.net/manual/en/function.curl-setopt.php
         *
         * @since 1.14
         * @param int key klic nastaveni
         * @param mixed value hodnota nastaveni
         * @return this
         */
        public function setOption($key, $value) {
            if ($key && $value) {
                $this->options[$key] = $value;
            }
            return $this;
        }

        /**
         * nacteni url adresy
         *
         * @since 1.30
         * @param void
         * @return string url adresa
         */
        public function getUrl() {
            return $this->url;
        }

        /**
         * nastaveni url adresy
         * - The URL to fetch. This can also be set when initializing a session with curl_init().
         *
         * @since 1.18
         * @param string url url adresa
         * @return this
         */
        public function setUrl($url) {
            if ($url) {
                $this->url = $url;
            }
            return $this;
        }

        /**
         * zapinani auto requestu
         *
         * @since 1.36
         * @param bool state true pro zapnuti, defaultne true
         * @return this
         */
        public function setAutoRequest($state) {
            $this->autoRequest = $state;
            return $this;
        }

        /**
         * provadeni auto requestu (auto execu)
         *
         * @since 1.36
         * @param void
         * @return mixed|this navracene data aplikace
         */
        private function autoExec() {
            if ($this->autoRequest) {
                return $this->exec();
            }
            return $this;
        }

        /**
         * umozni pripojeni na HTTPS
         *
         * @since 1.36
         * @param void
         * @return this
         */
        public function https() {
            $this->options[CURLOPT_SSL_VERIFYHOST] = 0;
            $this->options[CURLOPT_SSL_VERIFYPEER] = 0;
            return $this;
        }

        // public function ftp($user, $password, )

        /**
         * posilani GET requestu
         *
         * @since 1.16
         * @param array|null argv pole argumentu, nepovinny argument
         * @return mixed odpoved
         */
        public function get($argv = null) {
            $this->url .= ($argv && is_array($argv) ? '?' . http_build_query($argv) : null);  // pokud je pole
            return $this->autoExec();
        }

        /**
         * vnitrni zpracovani post argumentu
         *
         * @since 1.36
         * @param array fields pole argumentu
         * @return void
         */
        private function addPostFileds(array $fields) {
            $this->options[CURLOPT_POST] = true;
            if (!isset($this->options[CURLOPT_POSTFIELDS])) {
                $this->options[CURLOPT_POSTFIELDS] = $fields;   // vkladani argumentu
            } else {
                $this->options[CURLOPT_POSTFIELDS] += $fields;  // pricitani argumentu
            }
        }

        /**
         * posilani POST requestu
         *
         * @since 1.14
         * @param array argv pole argumentu (klic=>hodnota)
         * @return mixed odpoved
         */
        public function post(array $argv = null) {
            if ($argv && is_array($argv)) { // pokud je pole
                $this->addPostFileds($argv);
            }
            return $this->autoExec();
        }

        /**
         * prikladani dat na poslani, prikladani se POSTem
         *
         * @since 1.00
         * @param string|array index nazev indexu nebo pole (index=>jmeno_souboru)
         * @param string|null file jmeno souboru
         * @return this
         */
        public function setFile($index, $file = null) {
            if ($index && $file) {  // vkladani souboru
                $this->addPostFileds(array($index => new \CURLFile($file)));
            } else
            if (is_array($index) && !$file) {   // vkladani pole souboru
                foreach ($index as $i => $f) {
                    $this->addPostFileds(array($i => new \CURLFile($f)));
                }
            } else {
                throw new ExceptionCurl('Wrong arguments!!');
            }
            return $this;
        }

//TODO test put na FTPecku!!!!
// ftp:
// $ch = curl_init();
// $localfile = $_FILES['upload']['tmp_name'];
// $fp = fopen($localfile, 'r');
// curl_setopt($ch, CURLOPT_URL, 'ftp://user:password@address.com/'.$_FILES['upload']['name']);
// curl_setopt($ch, CURLOPT_UPLOAD, 1);
// curl_setopt($ch, CURLOPT_INFILE, $fp);
// curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));


// $url = "http://some.server.com/put_script";
// $localfile = "localfile.csv";
// $fp = fopen ($localfile, "r");
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_VERBOSE, 1);
// curl_setopt($ch, CURLOPT_USERPWD, 'user:password');
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_PUT, 1);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_INFILE, $fp);
// curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
// $http_result = curl_exec($ch);
// $error = curl_error($ch);
// $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
// curl_close($ch);
// fclose($fp);

// put:
// // setup Curl
// $session = curl_init();
// // Put requires a file to 'put' to the servier, so lets use php's TEMP file function
// // to create the file so we don't have to worry about writing a file to the server
// $putData = tmpfile();
// // now we write the JSON string into the file
// fwrite($putData, $jsonString);
// // Reset the file pointer
// fseek($putData, 0);

// // Setup our headers so we tell the server to expect JSON
// $headers = array(
// 'Accept: application/json',
// 'Content-Type: application/json',
// );
// curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
// // We want to transfer this as a Binary Transfer
// curl_setopt($session, CURLOPT_BINARYTRANSFER, true);
// curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
// // Do you want CURL to output the headers? Set to FALSE to hide them
// curl_setopt($session, CURLOPT_HEADER, true);
// // pass the URL to CURL
// curl_setopt($session, CURLOPT_URL, $url);
// // Tell CURL we are using PUT
// curl_setopt($session, CURLOPT_PUT, true);
// // Authenticate the user using basic auth $username and $password
// curl_setopt($session, CURLOPT_USERPWD, $username.":".$password );
// // Now we want to tell CURL the were the file is and it's size
// curl_setopt($session, CURLOPT_INFILE, $putData);
// curl_setopt($session, CURLOPT_INFILESIZE, strlen($putString));
// // right all done? Lets execute this
// $output = curl_exec($session);


// $handle = curl_init ($server_url);
//  if ($handle)
//  {
//      // specify custom header
//      $customHeader = array(
//          "Content-type: $file_type"
//      );
//      $curlOptArr = array(
//          CURLOPT_PUT => TRUE,
//          CURLOPT_HEADER => TRUE,
//          CURLOPT_HTTPHEADER => $customHeader,
//          CURLOPT_INFILESIZE => $file_size,
//          CURLOPT_INFILE => $file,
//          CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
//          CURLOPT_USERPWD => $user . ':' . $password,
//          CURLOPT_RETURNTRANSFER => TRUE
//      );
//      curl_setopt_array($handle, $curlOptArr);
//      $ret = curl_exec($handle);
//      $errRet = curl_error($handle);
//      curl_close($handle);


        /**
         * posilani PUT requestu
         *
         * @since 1.36
         * @param void
         * @return mixed odpoved
         */
        public function put() { //$data
            // if ($data) {
                $this->options[CURLOPT_PUT] = true;
                // $this->options[CURLOPT_CUSTOMREQUEST] = 'PUT';

// $this->options[CURLOPT_BINARYTRANSFER] = true;
//TODO doresit dohledat spravne pouziti!!!
/*
// $this->options[CURLOPT_VERBOSE] = true;
$f = tempnam(sys_get_temp_dir(), 'curl-');
file_put_contents($f, $data);
// $this->tt = fopen($f, 'r');
// fseek($this->tt, 0);

$this->options[CURLOPT_POST] = filesize($f);
$this->options[CURLOPT_POSTFIELDS] = file_get_contents($f);
$this->options[CURLOPT_POSTREDIR] = 3;

// $this->options[CURLOPT_INFILE] = file_get_contents($f);
// $this->options[CURLOPT_INFILESIZE] = filesize($f);
*/
                // $this->options[CURLOPT_CUSTOMREQUEST] = 'PUT';
                // $this->options[CURLOPT_POSTFIELDS] = http_build_query($data);
                //TODO predavani dat!!
            // }
            return $this->autoExec();
        }

        /**
         * posilani DELETE requestu
         *
         * @since 1.30
         * @param void
         * @return mixed odpoved
         */
        public function delete() {
            $this->options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
            return $this->autoExec();
        }

// CURLOPT_HTTPHEADER
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"OAuth-Token: $token"));
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

//TODO doladit!! otestovat!!! dopracovat!!!!


        /**
         * nastaveni autorizace
         *
         * @since 1.32
         * @param string user uzivatelske jmeno
         * @param string pass uzivatelske heslo
         * @return this
         */
        public function setAuthorize($user, $pass) {
            if ($user && $pass) {
                // $this->options[CURLOPT_FOLLOWLOCATION] = true;
                $this->options[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
                $this->options[CURLOPT_USERPWD] = $user . ':' . $pass;
            }
            return $this;
        }

        /**
         * hlavni vykovaci metoda
         * - This function should be called after initializing a cURL session and all the options for the session are set.
         *
         * @since 1.08
         * @param void
         * @return mixed data vracena z dotazu
         */
        public function exec() {
            $result = null;
            $options = array(
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => $this->returntransfer,
                CURLOPT_CONNECTTIMEOUT => $this->timeout,
                CURLOPT_HEADER => $this->header,
                CURLOPT_USERAGENT => $this->useragent,
                );
            $options += $this->options; // aplikace dalsiho nastaveni
            if (get_resource_type($this->res) == 'curl') {
                curl_setopt_array($this->res, $options);
                if (($result = curl_exec($this->res)) === false) {
                    throw new ExceptionCurl(curl_error($this->res), curl_errno($this->res));
                } else {
                    $this->info = curl_getinfo($this->res);
                    curl_close($this->res);
                }
            } else {
                throw new ExceptionCurl('Resource has been closed!!');
            }
            return $result;
        }

        /**
         * nacteni verze cURL
         *
         * @since 1.12
         * @param void
         * @return string verze cURL
         */
        public static function version() {
            $v = curl_version();
            return $v['version'];
        }
    }

    /**
     * vyjimky pro curl
     *
     * @package stable
     * @author geniv
     * @version 1.00
     */
    class ExceptionCurl extends \Exception {}