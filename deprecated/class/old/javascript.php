<?php
/*
 *      javascript.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  class JavaScript {
    const VERSION = 1.0;
    private $attributes;

    public function __construct($href = NULL) {
      $this->attributes = array();
    }

    public function __call($name, $values) {
      $result = NULL;
      switch ($name) {
        case 'var': //var(promenna)
        case 'for': //for(od, podminka, pocitadlo)
        break;
//TODO napridaat a otestovat na nejakem pouzit
      }
      //tady pridavat do pole, z tohoto pole si to pak bdue render funkce brat
      return $result;
    }

    public function render() {
      $result = '';
      //TODO vykreslovani atributu, dodelat!!

      return $result;
    }

    public function __toString() {
      return $this->render();
    }
  }

?>
