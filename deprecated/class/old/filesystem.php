<?php
/*
 *      filesystem.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 *      DEPRECATED MODUL, new version class: File
 */
//FIXME DEPRECATED!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  namespace classes;

  use stdClass,
      Exception;

  final class Filesystem {
    const VERSION = 1.35;
    const MODE_READ = 'r'; //TODO pripadne jeste vic moznosti?!
    const MODE_WRITE = 'w';
    //const MODE_APPEND = 'a';
//TODO mit moznost metodu na setMuteErrors??, getErrors, isErrors, duvod je ten aby to neblylo na stdout!
    private $handler = NULL;

    public function __construct($name, $mode) {
      $this->handler = new stdClass;
      $this->handler->state = true;
      $this->handler->pointer = NULL;
//TODO zabudovat tridu: SplFileObject?!
      $this->setMode($mode) //prvni se nastavi mod!
            ->setName($name);

      $this->open();
    }

    public function __destruct() {
      $this->close();
    }

    public function getState() {
      return $this->handler->state;
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
            if (!$this->handler->state = file_exists($this->handler->name)) {
              throw new ExceptionFilesystem('Soubor neexistuje!');
            }

            if (!$this->handler->state = is_readable($this->handler->name)) {
              throw new ExceptionFilesystem('Soubor nema pravo pro cteni!');
            }
          break;

          case self::MODE_WRITE:
            if (!$this->handler->state = is_writable(dirname($this->handler->name))) {
              throw new ExceptionFilesystem('Do slozky kde ma byt soubor ulozen se neda zapisovat!');
            }

            if (file_exists($this->handler->name)) {  //prepisovani souboru
              if (!$this->handler->state = is_writable($this->handler->name)) {
                throw new ExceptionFilesystem('Zadany soubor nelze prepsat!');
              }
            }
          break;
        }

      } catch (ExceptionFilesystem $e) {
        echo $e;
      }

      return $this;
    }

//otevirani handleru
    public function open() {
      try {

        if ($this->handler->state) {
          if (!$this->handler->pointer = fopen($this->handler->name, $this->handler->mode)) {
            $this->handler->state = false;
            throw new ExceptionFilesystem('Soubor se nepodarilo otevrit');
          }
        }

      } catch (ExceptionFilesystem $e) {
        echo $e;
      }

      return $this;
    }

//cteni z handleru
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

//zadis do handleru
    public function write($data) {
      try {

        if ($this->handler->state &&
            $this->handler->mode == self::MODE_WRITE &&
            is_resource($this->handler->pointer)) {
          if (!$this->handler->state = fwrite($this->handler->pointer, $data)) {
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
