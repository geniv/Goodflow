<?php

  namespace classes;
  
  use classes\Xicron;

  class Xtpl implements Xicron {
    
    public function __construct() {}
    public function clear($name) {}
    public function render($compile_path = null) {}

    public static function synchronizeCron() {
      $result = 0;
      return $result;
    }
  }