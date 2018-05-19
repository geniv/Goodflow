<?php
/*
 *      email.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use classes\Core,
      stdClass,
      Exception;

  final class Email {
    const VERSION = 1.17;

    const CONTENT_HTML = 'text/html';
    const CONTENT_PLAIN = 'text/plain';

    const LOCATION_WEB = 'web'; //plna kontrola emailu
    const LOCATION_LOCAL = 'local'; //ignorace kontroly emailu

    private $conf = NULL, $header = NULL;

    public function __construct($location = self::LOCATION_WEB) {
      $this->conf = new stdClass();
      $this->header = array();
      $this->conf->content = self::CONTENT_HTML;
      $this->conf->charset = 'UTF-8';
      $this->conf->state = true;
      $this->conf->error = NULL;
      $this->conf->location = $location;
    }

    private function onWeb() {
      return ($this->conf->location == self::LOCATION_WEB);
    }

    public function __call($method, $parameters) {

      $value = Core::isFill($parameters, 0);
      switch ($method) {
        case 'from':  //od koho
        case 'cc':  //kopie
        case 'bcc': //skryta kopie
          $val = NULL;
          if (is_array($value)) {
            $row = array();
            foreach ($value as $email) {
              if ($this->onWeb()) {
                if (self::checkEmail($email)) {
                  $row[] = $email;
                } else {
                  $this->conf->state = false;
                  $this->conf->error = _('wrong format email');
                }
              } else {
                $row[] = $email;
              }
            }
            $val = implode(', ', $row);
          } else {
            if ($this->onWeb()) {
              if (self::checkEmail($value)) {
                $val = $value;
              } else {
                $this->conf->state = false;
                $this->conf->error = _('wrong format email');
              }
            } else {
              $val = $value;
            }
          }
          $key = ucwords($method);  //nastaveni na prvni velke pismeno
          $this->header[$key] = $val;
        break;

        case 'to':  //pro koho
          $this->conf->to[] = (self::checkEmail($value) ? $value : NULL);
        break;

        case 'subject': //predmet
          $this->conf->subject = $value;
        break;

        case 'message': //zprava
          $this->conf->message = (!empty($parameters[1]) ? vsprintf($value, $parameters[1]) : $value);
        break;

        case 'setContent':  //nastavovani typu obsahu
          $this->conf->content = $value;
        break;

        case 'setCharset': //nastavovani kodovani
          $this->conf->charset = $value;
        break;
      }
      return $this;
    }

//kontroluje validitu emailu
    public static function checkEmail($email) {
      $pattern = "/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$/";
      return preg_match($pattern, $email);
    }

//alias pro checkEmail()
    public static function check($email) {
      return self::checkEmail($email);
    }

//metoda odeslani
    public function send() {
      try {
        $header = array('MIME-Version: 1.0',
                        sprintf('Content-type: %s; charset=%s', $this->conf->content, $this->conf->charset)
                        );
        foreach ($this->header as $key => $value) {
          $header[] = sprintf('%s: %s', $key, $value);
        }
        $header[] = sprintf('X-Mailer: PHP-%s', phpversion());
        $header = implode("\r\n", $header); //PHP_EOL
        //print_r($header);

        $result = false;

        if ($this->conf->state) {
          $result = mail(implode(', ', $this->conf->to), $this->conf->subject, $this->conf->message, $header);
        } else {
          echo $this->conf->error;
        }
      } catch (ExceptionEmail $e) {
        echo $e;
      }
      return $result;
    }

//staticke metody
    public static function __callStatic($method, $parameters) {
      $result = NULL;
      switch ($method) {
        case 'getIP':
          $result = Core::getIP();
        break;

        case 'getHost':
          $result = Core::getHost();
        break;

        case 'getOS':
          $result = Core::getBrowser()->platform;
        break;

        case 'getBrowser':
          $result = Core::getBrowser()->parent;
        break;

        case 'getDateTime':
          $format = Core::isFill($parameters, 0, 'd.m.Y H:i:s');
          $result = date($format);
        break;
      }
      return $result;
    }

  }

  class ExceptionEmail extends Exception {}

/*
Core::initBrowscap(__DIR__);

$e = new Email;
$e->from(array('jmeno@email.cz'))
  ->to('xxxxx@gmail.com')
  ->subject('ultra předmět žluťoučký kůň ůpěl dábělské tóny')
  ->message('toto je šuuuuuuuper teeeext!!! žluťoučký kůň ůpěl dábělské tóny');
  ->message(Core::getMarkupText(sprintf('\nZpráva ze stránek www.example.cz\n\nÚdaje o odesílateli:\nIP: %s\nHost: %s\nOperační systém: %s\nProhlížeč: %s\n\nDatum / čas odeslání zprávy: %s\nJméno: %s\nE-mail: %s\nZpráva: %s\n', Email::getIP(), Email::getHost(), Email::getOS(), Email::getBrowser(), Email::getDateTime('d.m.Y / H:i:s'), $values['jmeno'], $values['email'], $values['zprava'])));

if ($e->send()) {
  echo ' odeslano... ';
}
*/
?>
