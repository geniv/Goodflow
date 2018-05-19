<?php
/*
 *      connector.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */
//FIXME upradovat!! respektive udelat fork: novy nazev, udelat o neco rozumnejsi implementaci
  namespace classes;

  use stdClass,
      Exception;

  //FIXME moznost vytváret: XmlConnector a JsonConnector

  class Connector {
    const VERSION = 1.28;

    //bude sprostredkovavat napojeni na databaze,
    //ruznych typu?! propazne ze zacatku jen pro xml a json

    const TYPE_XML = 'xml';
    const TYPE_JSON = 'json';

    private $storage_type = array(self::TYPE_XML => 'classes\XmlStorage',
                                  self::TYPE_JSON => 'classes\JsonStorage',
                                  );

    private $pointer;

    public function __construct($type, $path) {
      $this->pointer = new stdClass;
      $this->pointer->type = $type;
      $this->pointer->path = sprintf('%s.%s', $path, $type); //jmeno souboru
      $this->pointer->stream = array();
      //autoindex?
    }

    public function __destruct() {
      $this->close();
    }

    public function setStructure($struct) {
      $this->pointer->struct = $struct;
      return $this;
    }

    public function load() {
      try {

        $class = $this->storage_type[$this->pointer->type];
        if (file_exists($this->pointer->path)) {
          $this->pointer->stream = $class::getData($this->pointer->path);
        } else {
          $this->close();
          //file_put_contents($this->pointer->path, NULL);  //vytvoreni prazdneho souboru
          throw new ExceptionConnector('path for storage does not exist!');
        }

      } catch (ExceptionConnector $e) {
        echo $e;
      }
      return $this;
    }

//metoda pro zavirani otevrene relace (hlavne spis ulozeni)
    public function close() {
      $class = $this->storage_type[$this->pointer->type];
      if (!is_null($this->pointer->stream)) { //pokud neni NULL tak ulozi
        $class::setData($this->pointer->path, $this->pointer->stream);
      }
      return $this;
    }

    public function save() {
      $this->close();
      return $this;
    }

    private function setInternalType($data) {
      $result = array();
      foreach ($this->pointer->struct as $column => $type) {
        $item = NULL;
        $input = Core::isFill($data, $column);
        switch ($type) {
          case 'string':
            $item = strval($input);
          break;

          case 'string_code':
            $item = base64_encode($input);
          break;

          case 'float':
            $item = floatval($input);
          break;

          case 'int':
          case 'integer';
            $item = intval($input);
          break;

          case 'bool':
          case 'boolean':
            $item = (boolean) $input;
          break;

          case 'array':
            $item = (array) $input;
          break;
        }
        $result[$column] = $item;
      }
      return $result;
    }

//prida radek do uloziste
    public function addRow($data) {
      $index = Core::getUniqText();
      $this->pointer->stream[$index] = $this->setInternalType($data);
      $this->save();
      return $this;
    }

    public function loadRow($id, $columns = NULL) {
      try {

        $result = NULL;
        if (array_key_exists($id, $this->pointer->stream)) {
          $loaddata = $this->pointer->stream[$id];
          foreach ($this->pointer->struct as $column => $type) {
            switch ($type) {
              case 'string_code':
                $loaddata[$column] = base64_decode($loaddata[$column]);
              break;
            }
          }

          //vraceni vybranych sloupcu
          if (!empty($columns)) {
            if (!is_array($columns)) {
              $loaddata = $loaddata[$columns];
            } else {
              //TODO dodelat implementaci pri poli
            }
          }

          $result = $loaddata;
        } else {
          throw new ExceptionConnector('key for load does not exist!');
        }

      } catch (ExceptionConnector $e) {
        echo $e;
      }
      return $result;
    }

//predpoklada se ze vzdycky pred editem se provede ->loadRow($id)
//ulozeni zadaneho radku, musi se vkladat data uz prohnane funkci array_merge() !!!
    public function editRow($id, $data) {
      try {

        if (array_key_exists($id, $this->pointer->stream)) {
          //kvuli sifrovanemu textu se vklada primo
          $this->pointer->stream[$id] = $this->setInternalType($data);
          $this->save();
        } else {
          throw new ExceptionConnector('key for edit does not exist!');
        }

      } catch (ExceptionConnector $e) {
        echo $e;
      }
      return $this;
    }

    public function delRow($id) {
      try {

        if (array_key_exists($id, $this->pointer->stream)) {
          unset($this->pointer->stream[$id]);
          $this->save();
        } else {
          throw new ExceptionConnector('key for delete does not exist!');
        }

      } catch (ExceptionConnector $e) {
        echo $e;
      }
      return $this;
    }

    public function getListRows($columns = NULL) {
      $result = $this->pointer->stream;
      if (!empty($columns)) {

        if (!is_array($columns)) {
          //zadany klic sahne do pole
          foreach ($result as $key => $values) {
            $result[$key] = $values[$columns];
          }
        } else {
//FIXME vymyslet lepsi a optimalizovany algoritmus!
          foreach ($result as $key => $values) {
            $val = array();
            foreach ($columns as $col) {
              $val[$col] = $values[$col];
            }
            $result[$key] = $val;
          }
        }
      }
      return $result;
    }
  }

  class ExceptionConnector extends Exception {}

?>
