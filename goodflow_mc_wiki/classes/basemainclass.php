<?php
/*
 * basemainclass.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   *
   * bazova trida pro vytvoreni MainClass struktury pro prenos dat v aplikaci
   *
   */
//TODO vygenerovat a napsat testy!!!!
  abstract class BaseMainClass implements \ArrayAccess {
    const VERSION = 1.24;

    protected $data = null;

    /**
     * hlavni konstruktor
     *
     * @param data pole hodnot jako pocateni hodnoty
     */
    public function __construct(array $data) {
      $this->data = $data;
    }

    /**
     * overeni existencev objektovem stylu
     *
     * @param name klic pole
     * @return true pokud existuje
     */
    public function __isset($name) {
      return isset($this->data[$name]);
    }

    /**
     * objektove nacteni hodnot z pole
     * (trida->promenna)
     *
     * @param name klic do pole hodnot
     * @return hodnota z pole
     */
    public function __get($name) {
      return $this->data[$name];
    }

    /**
     * objektove nastavovani hodnot do pole
     *
     * @param name klic do pole
     * @param value nova hodnota
     */
    public function __set($name, $value) {
      $this->data[$name] = $value;
    }

    /**
     * zruseni hornoty v objektovem stylu
     *
     * @param name klic pole
     */
    public function __unset($name) {
      unset($this->data[$name]);
    }

    /**
     * overeni existence v array stylem
     *
     * @param offset klic pole
     * @return true pokus existuje
     */
    public function offsetExists($offset) {
      return isset($this->data[$name]);
    }

    /**
     * nacteni hodnoty array stylem
     *(trida[promenna])
     *
     * @param offset klic do pole
     * @return hodnota z klice
     */
    public function offsetGet($offset) {
      return $this->data[$offset];
    }

    /**
     * nastaveni hodnoty array stylem
     *
     * @param offset klic pole
     * @param value hodnota na klic
     */
    public function offsetSet($offset, $value) {
      $this->data[$offset] = $value;
    }

    /**
     * zruseni hodnoty array stylem
     *
     * @param offset klic pole
     */
    public function offsetUnset($offset) {
      unset($this->data[$offset]);
    }

    /**
     * vraceni pole hodnot
     *
     * @return pole hodnot
     */
    public function toArray() {
      return $this->data;
    }
  }