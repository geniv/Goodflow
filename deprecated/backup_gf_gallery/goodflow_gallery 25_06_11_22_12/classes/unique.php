<?php
/*
 *      unique.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use Exception;

  //vzor singleton
  final class Unique implements Singleton {
    const VERSION = '1.1';
    private static $instance = NULL;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
      if (is_null(self::$instance)) {
        self::$instance = new self;
      }
      return self::$instance;
    }
//TODO pridat i nacitaci metodu z textu, aby bylo nejen ze sozboru ale i textu!
    public static function __callStatic($name, $args) {
      try {

        $result = NULL;
        if ($name == 'i') { //TODO pripadne pres switch na volani method
          if (self::$instance != NULL) {
            $result = self::$instance;
          } else { throw new ExceptionUnique('Nejprve je potreba zavolat: Unique::getInstance()->loadUnique(__FILE__);'); }
        }

      } catch (ExceptionUnique $e) {
        echo $e;
        exit(1);
      }

      return $result;
    }

    const UNIQUE_NAME = 'unique';
    const DUPLIC_NAME = 'duplicate';

    public function loadUnique($path) {
      try {

        $dir = dirname($path);
        $name = basename($path, '.php');
        //unikatni
        $uniq_path = sprintf('%s/%s_%s.php', $dir, $name, self::UNIQUE_NAME);
        if (file_exists($uniq_path)) {
          self::$instance->unique = include_once $uniq_path;
        } else {
          throw new ExceptionUnique($uniq_path);
        }
        //duplikatni
        $duplic_path = sprintf('%s/%s_%s.php', $dir, $name, self::DUPLIC_NAME);
        if (file_exists($duplic_path)) {
          self::$instance->unique = include_once $duplic_path;
        }

      } catch (ExceptionUnique $e) {
        echo sprintf('Cesta %s neexistuje!', $e->getMessage());
      }
    }

    public function getUniq($key, array $array, $znak = '%%') {
      try {

        $result = NULL;
        if (!empty(self::$instance->unique)) {
          if (array_key_exists($key, self::$instance->unique)) {
            $vstup = self::$instance->unique[$key];
          } else {
            throw new ExceptionUnique(sprintf('Klic "%s" nebyl nalezen!', $key));
          }
        } else {
          throw new ExceptionUnique('Unikatni nebyli doposud nacteny!');
        }

        //separace klicu z array
        $klice = array_keys($array);
        //uprava klicu
        $search = preg_replace('/\w+/', sprintf('%s$0%s', $znak, $znak), $klice); //'{$znak}$0{$znak}'
        //separace hodnot z array
        $replace = array_values($array);
        //nahrazeni vstupu naraz
        $result = str_replace($search, $replace, $vstup);

      } catch (ExceptionUnique $e) {
        echo $e;
      }

      return $result;
    }
  }

  class ExceptionUnique extends Exception {}

?>
