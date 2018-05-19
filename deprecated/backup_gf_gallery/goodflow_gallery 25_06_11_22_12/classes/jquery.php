<?php
/*
 *      jquery.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  class jQuery extends JavaScript {
    const VERSION = '1.1';
    private $modules, $index, $lastindex;

    public function __construct() {
      $this->components = array();
      $this->index = 0;
      $this->lastindex = NULL;
    }

    public function addModule($elements, $name, array $attributes = array()) {
      $this->modules[$this->index] = array ('name' => $name,
                                'elements' => $elements);
//TODO pridavani atributu (pole)! zpracovani elementu!
      $this->lastindex = $this->index;
      $this->index++;
      return $this;
    }

    public function __call($name, $values) {
      $params = Core::isFill($values, 0);
      if (!empty($params)) {
        $this->modules[$this->lastindex]['settings'][$name] = $params;
      }
      return $this;
    }

    public function render() {
      $result = array();

      $result[] = PHP_EOL.'$(document).ready(function(){'.PHP_EOL;
//TODO zanorovani!!
      if (!empty($this->modules)) {
        foreach ($this->modules as $modul) {
          $elements = $modul['elements'];
          $elements = (!empty($elements) ? sprintf('("%s")', $elements) : $elements);
          $name = $modul['name'];

          $settings = Core::isFill($modul, 'settings');
          $sett = NULL;
          $row = array();
          if (!empty($settings)) {
            $row[] = '{'.PHP_EOL;
            $meth = array();
            foreach ($settings as $key => $values) {
              $r = array();
              //var_dump(gettype($values));
              switch (gettype($values)) {
                case 'array':
                  foreach ($values as $k => $v) {
                    $r[] = sprintf('%s: \'%s\'', $k, $v);
                  }
                  $val = implode(', ', $r);
                  $meth[] = sprintf('%s: [{ %s }]', $key, $val);
                break;

                case 'string':
                  $meth[] = sprintf('%s: \'%s\'', $key, $values); //TODO lip udelat slucovani!
                break;

                case 'integer':
                case 'double':
                  $meth[] = sprintf('%s: %s', $key, $values);
                break;

                case 'boolean':
                  $meth[] = sprintf('%s: %s', $key, ($values ? 'true' : 'false'));
                break;
              }

            }
            $row[] = implode(', '.PHP_EOL, $meth);
            $row[] = PHP_EOL.'}';
          }

          $sett = implode('', $row);

          $result[] = sprintf('  $%s.%s(%s);'.PHP_EOL, $elements, $name, $sett);
        }
      }
      $result[] = '});'.PHP_EOL;

      $result = implode('', $result);

      return $result;
    }

    public function __toString() {
      return $this->render();
    }
  }

/*
$jquery = new jQuery();
$jquery->addModule(NULL, 'supersized')
          ->slides(array('image' => 'images/body_small.png'))
        ->addModule('#tabs', 'tabs');
*/

?>
