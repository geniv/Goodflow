<?php
/*
 *      notification.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception,
      classes\Administration,
      \Config;

  class Notification  {
    const VERSION = 1.23;
    const TYPE_INFO = 'info';
    const TYPE_SUCCESSFUL = 'successful';
    const TYPE_ERROR = 'error';
    const TYPE_WARNING = 'warning';

    //samotny obrazek waitu
    const SMALL = 'small_wait_%s';
    const NORMAL = 'wait_%s';

    private $element;

    //vnitrni systemove
    private function __construct($type, $message) {
      $this->element = new stdClass;
      $this->element->wait = false;
      $this->element->args = array();
      $this->setType($type)
          ->setMessage($message);
    }

    public function __toString() {
      return $this->render();
    }

    private function setType($type) {
      $this->element->type = $type;
      return $this;
    }

    private function setMessage($message) {
      $this->element->message = $message;
      return $this;
    }

    //verejne
    public function wait($typ) {
      $this->element->wait = $typ;
      return $this;
    }

//vkladani jedne hodnoty
    public function arg($argument) {
      $this->element->args[] = $argument;
      return $this;
    }

//vkladani jedno/pole hodnot se separatorem
    public function args($separate, $arrays) {
      $this->element->args[] = implode($separate, $arrays);
      return $this;
    }

    //verejne, hlasky
    public static function info($message) {
      return new self(self::TYPE_INFO, $message);
    }

    public static function successful($message) {
      return new self(self::TYPE_SUCCESSFUL, $message);
    }

    public static function error($message) {
      if ($message instanceof Exception) {  //vyber hlasky z Exception
        $message = $message->getMessage();
      }
      error_log($message);  //postovani chyby do logu (jen pro kontrolu)
      return new self(self::TYPE_ERROR, $message);
    }

    public static function warning($message) {
      return new self(self::TYPE_WARNING, $message);
    }

    public function render() {
      $img = NULL;
      if (!empty($this->element->wait)) {
        $weburl = Administration::getWebUrl();
        $path = sprintf($this->element->wait, Config::LANG);
        $img = Html::elem('img')->src(sprintf('%simages/%s.gif', $weburl, $path))->alt(_('Wait please ...'));
      }

      $func = function($value) { return Html::elem('span')->setText($value); };
      $args = array_map($func, $this->element->args); //obaleni kazde hodnoty spanem
      if (!empty($args)) {
        $p = Html::elem('p')->setText(vsprintf($this->element->message, $args));
      } else {
        $p = Html::elem('p')->insert(Html::elem('span')->class('top_align')->setText($this->element->message));
      }

      $result = Html::elem('div')
                          ->class('notification')
                          ->class(sprintf('notification_%s', $this->element->type))
                          ->insert(array($p, $img))
                          ;

      return $result->render();
    }

  }

?>
