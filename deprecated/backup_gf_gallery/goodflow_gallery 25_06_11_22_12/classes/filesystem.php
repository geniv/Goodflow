<?php
/*
 *      filesystem.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception;

  final class Filesystem {
    const VERSION = '1.3';
    const MODE_READ = 'r'; //TODO pripadne jeste vic moznosti?!
    const MODE_WRITE = 'w';
    //const MODE_APPEND = 'a';

    private $handler = NULL;

    public function __construct($name, $mode) {
      $this->handler = new stdClass;
      $this->handler->state = true;
      $this->handler->pointer = NULL;

      $this->setMode($mode) //prvni se nastavi mod!
            ->setName($name);

      $this->open();
    }

    public function __destruct() {
      $this->close();
    }

    public function setMode($mode) {
      $this->handler->mode = $mode;
      return $this;
    }

    public function setName($name) {
      try {

        $this->handler->name = $name; //nastaveni jmena

        switch ($this->handler->mode) {
          case self::MODE_READ:
            if (!file_exists($this->handler->name)) {
              $this->handler->state = false;
              throw new ExceptionFilesystem('Soubor neexistuje!');
            }

            if (!is_readable($this->handler->name)) {
              $this->handler->state = false;
              throw new ExceptionFilesystem('Soubor nema pravo pro cteni!');
            }
          break;

          case self::MODE_WRITE:
            if (!is_writable(dirname($this->handler->name))) {
              $this->handler->state = false;
              throw new ExceptionFilesystem('Do slozky kde ma byt soubor ulozen se neda zapisovat!');
            }
          break;
        }

      } catch (ExceptionFilesystem $e) {
        echo $e;
      }

      return $this;
    }

    public function open() {
      try {

        if ($this->handler->state) {
          if (!$this->handler->pointer = fopen($this->handler->name, $this->handler->mode)) {
            throw new ExceptionFilesystem('Soubor se nepodarilo otevrit');
          }
        }

      } catch (ExceptionFilesystem $e) {
        echo $e;
      }

      return $this;
    }

    public function read() {
      $result = NULL;
      if ($this->handler->state &&
          $this->handler->mode == self::MODE_READ &&
          is_resource($this->handler->pointer)) {
        $size = filesize($this->handler->name);
        if ($size > 0) {
          $result = fread($this->handler->pointer, $size);
        }
//TODO pripadne i pres parametr predavat pripadne nejake textove transformace jako trim, explode apod...
      }

      return $result;
    }

    public function write($data) {
      try {

        if ($this->handler->state &&
            $this->handler->mode == self::MODE_WRITE &&
            is_resource($this->handler->pointer)) {
          if (!fwrite($this->handler->pointer, $data)) {
            throw new ExceptionFilesystem('Soubor se nepodarilo zapsat!');
          }
        }

      } catch (ExceptionFilesystem $e) {
        echo $e;
      }

      return $this;
    }

    public function close() {
      if (is_resource($this->handler->pointer)) {
        fclose($this->handler->pointer);
      }
    }

  }

  class ExceptionFilesystem extends Exception {}

?>
