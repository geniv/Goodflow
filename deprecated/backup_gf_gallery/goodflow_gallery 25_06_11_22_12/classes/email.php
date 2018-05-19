<?php
/*
 *      email.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception;

  final class Email {
    const VERSION = '1.1';
    const CONTENT_HTML = 'text/html';
    const CONTENT_PLAIN = 'text/plain';

    private $conf = NULL, $header = NULL;

    public function __construct() {
      $this->conf = new stdClass();
      $this->header = array();
      $this->conf->content = self::CONTENT_HTML;
      $this->conf->charset = 'UTF-8';
      $this->conf->state = true;
    }

    public function __call($method, $parameters) {

      $value = Core::isFill($parameters, 0);
      switch ($method) {
        case 'from':  //od koho
        case 'cc':
        case 'bcc':
          $val = NULL;
          if (is_array($value)) {
            $row = array();
            foreach ($value as $email) {
              if (self::checkEmail($email)) {
                $row[] = $email;
              } else {
                $this->conf->state = false;
              }
            }
            $val = implode(', ', $row);
          } else {
            if (self::checkEmail($value)) {
              $val = $value;
            } else {
              $this->conf->state = false;
            }
          }
          $key = ucwords($method);
          $this->header[$key] = $val;
        break;

        case 'to':  //pro koho
          $this->conf->to = $value;
        break;

        case 'subject': //predmet
          $this->conf->subject = $value;
        break;

        case 'message': //zprava
          $this->conf->message = $value;
        break;

        case 'setContent':  //nastavovani typu obsahu
          $this->conf->content = $value;
        break;

        case 'setCharset': //nastavovani kodovani
          $this->conf->charset = $value;
        break;
      }
//TODO pridavani syst veci: PHP_OS, ip, server veci a pod.
      return $this;
    }

    public static function checkEmail($email) {
      $pattern = "/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$/";
      return preg_match($pattern, $email);
    }

    public function send() {
      //TODO pripadne aby se mohli pridat i statistyky od odesilatele, a vyjimky do try/catch

      $header = array('MIME-Version: 1.0',
                      sprintf('Content-type: %s; charset=%s', $this->conf->content, $this->conf->charset)
                      );
      foreach ($this->header as $key => $value) {
        $header[] = sprintf('%s: %s', $key, $value);
      }
      $header[] = sprintf('X-Mailer: PHP-%s', phpversion());
      $header = implode(PHP_EOL, $header);
      //print_r($header);

      $result = false;
      if (self::checkEmail($this->conf->to) &&
          $this->conf->state) {
        $result = mail($this->conf->to, $this->conf->subject, $this->conf->message, $header);
      }
      return $result;
    }

  }

  class ExceptionEmail extends Exception {}

/*
            $e = new Email();
            $e->from(array('martin.fugess@gmail.com', 'jmeno@email.cz'))
              ->to('geniv.radek@gmail.com')
              ->subject('ultra předmět žluťoučký kůň ůpěl dábělské tóny')
              ->message('toto je šuuuuuuuper teeeext!!! žluťoučký kůň ůpěl dábělské tóny');
//var_dump(PHP_OS);
//var_dump(Email::checkEmail('martin.fugess@gmail.com23'));
            if ($e->send()) {
              echo ' odeslano... ';
            }
*/
?>
