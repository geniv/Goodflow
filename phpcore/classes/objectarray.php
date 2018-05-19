<?php
/*
 * objectarray.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * Object-Array manipulacni trida pro vytvareni nejen MainClass struktur a pro prenos dat v aplikaci/tpl/... ,
   * implementuje:
   * - ArrayAccess
   * - Countable
   * - Serializable
   *
   * @package stable
   * @author geniv
   * @version 2.52
   */
  abstract class ObjectArray implements \ArrayAccess, \Countable, \Serializable  {

    // bazova promenna se nesmi dedit
    private $data = null;

    /**
     * defaultni konstruktor
     * - hlavni vytvareni instance: ArrayObject
     * - musi byt zaruceho ze se vzdy vytvori
     * - pokud se bude v potomcich pouzivat defaultni konstruktor, musi volat: parent::__construct();
     *
     * @since 1.00
     * @param array data pole hodnot jako pocateni hodnoty
     */
    public function __construct($data = array()) {
      $this->data = new \ArrayObject($data);
    }

    /**
     * nacteni aktualni instance
     *
     * @since 2.42
     * @param void
     * @return ArrayObject aktualni instance
     */
    public function getData() {
      return $this->data;
    }

    /*
     * Magic method
     */

    /**
     * overeni existencev objektovem stylu
     *
     * @since 2.40
     * @param string name klic pole
     * @return bool true pokud existuje
     */
    public function __isset($name) {
      return $this->data->offsetExists($name);
    }

    /**
     * objektove nacteni hodnot z pole
     * @used (trida->promenna)
     *
     * @since 2.40
     * @param string name klic do pole hodnot
     * @return mixed hodnota z pole
     */
    public function __get($name) {
      return $this->offsetGet($name);
    }

    /**
     * objektove nastavovani hodnot do pole
     *
     * @since 2.40
     * @param string name klic do pole
     * @param mixed value nova hodnota
     * @return void
     */
    public function __set($name, $value) {
      $this->offsetSet($name, $value);
    }

    /**
     * zruseni hornoty v objektovem stylu
     *
     * @since 2.40
     * @param string name klic pole
     * @return void
     */
    public function __unset($name) {
      $this->offsetUnset($name);
    }

    /*
     * ArrayAccess
     */

    /**
     * overeni existence v array stylem
     *
     * @since 2.30
     * @param string offset klic pole
     * @return bool true pokus existuje
     */
    public function offsetExists($offset) {
      return $this->data->offsetExists($offset);
    }

    /**
     * nacteni hodnoty array stylem
     * @used (trida[promenna])
     *
     * @since 2.30
     * @param string offset klic do pole
     * @return mixed hodnota z klice
     */
    public function offsetGet($offset) {
      return (isset($this->data[$offset]) ? $this->data->offsetGet($offset) : null);
    }

    /**
     * nastaveni hodnoty array stylem
     *
     * @since 2.30
     * @param string offset klic pole
     * @param mixed value hodnota na klic
     * @return void
     */
    public function offsetSet($offset, $value) {
      $this->data->offsetSet($offset, $value);
    }

    /**
     * zruseni hodnoty array stylem
     *
     * @since 2.30
     * @param string offset klic pole
     * @return void
     */
    public function offsetUnset($offset) {
      if (isset($this->data[$offset])) {
        $this->data->offsetUnset($offset);
      }
    }

    /*
     * Countable
     */

    /**
     * nacteni poctu polozek
     *
     * @since 2.02
     * @param void
     * @return int pocet polozek
     */
    public function count() {
      return $this->data->count();
    }

    /*
     * Iterator
     */

    /**
     * nacteni instance iteratoru pro foreach
     *
     * @since 2.28
     * @param void
     * @return ArrayIterator instance iteratoru
     */
    public function getIterator() {
      return $this->data->getIterator();
    }

    /*
     * Serializable
     */

    /**
     * serializace vnitrnich dat
     *
     * @since 2.48
     * @param void
     * @return string serializovane data
     */
    public function serialize() {
      return $this->data->serialize();
    }

    /**
     * deserializace vnitrnich dat
     *
     * @since 2.48
     * @param string data serializovane data
     * @return void
     */
    public function unserialize($data) {
      $this->data->unserialize($data);
    }

    /*
     * zbytek
     */

    /**
     * vraceni pole hodnot
     *
     * @since 1.00
     * @param void
     * @return array pole hodnot
     */
    public function toArray() {
      return $this->data->getArrayCopy();
    }
  }