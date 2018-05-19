<?php
/*
 *      template.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass;

  class Template {  //instancni trida
    private $items;

    public function __construct() {
      $this->items = new stdClass;
      $this->items->structure = NULL;
      $this->items->data = NULL;
    }

    public function __set($name, $value) {
      //var_dump($name, $value);
    }

    public function __get($name) {
      //var_dump($name);
      //$this->items
      return $this->items->data[$name];
    }

    public function structure($struct) {
      $this->items->structure = $struct;
    }

    public function rewrite(array $values) {
      $this->items->data = $values;
    }
  }

?>
