<?php
/*
 *      template.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use classes\Core,
      stdClass;
//deprecated!!
  class Template {  //instancni trida
    const VERSION = 1.0;
    private $items;

    public function __construct() {
      $this->items = new stdClass;
      $this->items->structure = NULL;
      $this->items->data = NULL;
    }

    public function __get($name) {
      return Core::isFill($this->items->data, $name, $name);
    }

    public function __toString() {
      //var_dump($this->items->structure);
      return (string) $this->items->structure;
    }

    public function structure($struct) {
      $this->items->structure = $struct;
    }

    public function rewrite(array $values) {
      $this->items->data = $values;
    }
  }

?>
