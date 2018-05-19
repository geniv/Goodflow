<?php
/*
 * basemainclass.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * bazova trida pro vytvoreni MainClass struktury pro prenos dat v aplikaci
   *
   * @package unstable
   * @author geniv
   * @version 1.36
   */
  abstract class BaseMainClass implements \ArrayAccess {

    protected $__data = null;

    /**
     * hlavni konstruktor
     *
     * @param data pole hodnot jako pocateni hodnoty
     */
    public function __construct(array $data = array()) {
      $this->__data = $data;
    }

    /*
     * Magic method
     */
    
    /**
     * overeni existencev objektovem stylu
     *
     * @param name klic pole
     * @return true pokud existuje
     */
    public function __isset($name) {
      return isset($this->__data[$name]);
    }

    /**
     * objektove nacteni hodnot z pole
     * (trida->promenna)
     *
     * @param name klic do pole hodnot
     * @return hodnota z pole
     */
    public function __get($name) {
      return (isset($this->__data[$name]) ? $this->__data[$name] : null);
    }

    /**
     * objektove nastavovani hodnot do pole
     *
     * @param name klic do pole
     * @param value nova hodnota
     */
    public function __set($name, $value) {
      $this->__data[$name] = $value;
    }

    /**
     * zruseni hornoty v objektovem stylu
     *
     * @param name klic pole
     */
    public function __unset($name) {
      unset($this->__data[$name]);
    }

    /*
     * ArrayAccess
     */

    /**
     * overeni existence v array stylem
     *
     * @param offset klic pole
     * @return true pokus existuje
     */
    public function offsetExists($offset) {
      return isset($this->__data[$offset]);
    }

    /**
     * nacteni hodnoty array stylem
     *(trida[promenna])
     *
     * @param offset klic do pole
     * @return hodnota z klice
     */
    public function offsetGet($offset) {
      return (isset($this->__data[$offset]) ? $this->__data[$offset] : null);
    }

    /**
     * nastaveni hodnoty array stylem
     *
     * @param offset klic pole
     * @param value hodnota na klic
     */
    public function offsetSet($offset, $value) {
      $this->__data[$offset] = $value;
    }

    /**
     * zruseni hodnoty array stylem
     *
     * @param offset klic pole
     */
    public function offsetUnset($offset) {
      unset($this->__data[$offset]);
    }

    /**
     * vraceni pole hodnot
     *
     * @return pole hodnot
     */
    public function toArray() {
      return $this->__data;
    }
  }