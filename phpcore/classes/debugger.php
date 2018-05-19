<?php
/*
 * debugger.php
 *
 * Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * pomocna ladici trida
   *
   * @package stable
   * @author geniv
   * @version 1.32
   */
  final class Debugger {
    private static $startTime = array();
    private static $stopTime = array();

    private static $instance = null;

    /**
     * startuje mereni konkterniho casu
     *
     * @param name jmeno pro index
     */
    public static function startTime($name = 'default') {
      self::$startTime[$name] = microtime(true);
    }

    /**
     * ukoncuje mereni konkterniho casu
     *
     * @assert (null) throws ExceptionDebugger
     * @assert ('nic') throws ExceptionDebugger
     *
     * @param name jmeno pro index
     */
    public static function stopTime($name = 'default') {
      $time = microtime(true);
      if (array_key_exists($name, self::$startTime)) {
        self::$stopTime[$name] = $time;
      } else {
        throw new ExceptionDebugger('snazite se ukoncit nezapocaty cas!');
      }
    }

    /**
     * zastavuje vsechny casy
     */
    public static function stopTimeAll() {
      foreach (self::$startTime as $key => $value) {
        if (!array_key_exists($key, self::$stopTime)) {
          self::stopTime($key);
        }
      }
    }

    /**
     * prepocitava casy
     *
     * @param name jmeno indexu
     * @return zformatovany vypocteny cas pro dany index
     */
    private static function calculateTime($name = 'default') {
      //nadefinovane symboly
      $symbol = array(-2 => '&mu;s', -1 => 'ms', 0 => 's');
      //vypocet rozdilu, vysledek je v sekundach
      $conv = round(self::$stopTime[$name] - self::$startTime[$name], 10);
      //vypocet exponentu
      $exp = floor(log($conv) / log(1000));
      //vypocet vysledne hodnoty
      $converted = ($conv / pow(1000, floor($exp)));
      return sprintf('%0.6f %s', $converted, $symbol[$exp]);
    }

    /**
     * zobrazeni jednoho casu
     *
     * @param name jmeno indexu
     * @return formatovany vystup
     */
    public static function viewTime($name = 'default') {
      self::stopTime($name);  //zastavi konkretni casovac
      return sprintf('%s: %s', $name, self::calculateTime($name)).PHP_EOL;
    }

    /**
     * zobrazeni vsech casu
     *
     * @return formatovany vystup
     */
    public static function viewTimes() {
      self::stopTimeAll();  //zastavi vsechny casovace
      $result = array(PHP_EOL);
      foreach (self::$startTime as $key => $value) {
        $result[] = sprintf('%s: %s', $key, self::calculateTime($key));
      }
      return implode('<br />'.PHP_EOL, $result);
    }

    /**
     * singleton pro testy
     *
     * @param group nazev skupiny pro test
     * @return instance
     */
    public static function test($group = 'default') {
      if (is_null(self::$instance)) {
        self::$instance = new self;
        self::$instance->tests = array();
      }
      self::$instance->group = $group;
      return self::$instance;
    }

    /**
     * pretezovana metoda pro instancni metody testu
     *
     * @assert Debugger::test()->isInt() throws ExceptionDebugger
     * @assert Debugger::test()->isNeco('a') throws ExceptionDebugger
     *
     * @param metoda metoda testovani
     * @param description nepovinny popisek
     * @return vysledek testu
     */
    public function __call($method, $parameters) {
      $result = null;
      $value = null;
      if (count($parameters) > 0) {
        $value = $parameters[0];
      } else {
        throw new ExceptionDebugger('byla zadana prazdna hodnota');
      }
      $description = Core::isFill($parameters, 1);  //nepovinny description
      switch ($method) {
        case 'isString':  //Debugger::test()->isString($var, 'popis')
        case 'isStr':  //Debugger::test()->isStr($var, 'popis')
          $result = is_string($value);
        break;

        case 'isInteger': //Debugger::test()->isInteger($var, 'popis')
        case 'isInt': //Debugger::test()->isInt($var,, 'popis')
          $result = is_int($value);
        break;

        case 'isFloat': //Debugger::test()->isFloat($var 'popis')
        case 'isDouble':  //Debugger::test()->isDouble($var 'popis')
          $result = is_float($value);
        break;

        case 'isNumeric': //Debugger::test()->isNumeric($var, 'popis')
        case 'isNum': //Debugger::test()->isNum($var, 'popis')
          $result = is_numeric($value);
        break;

        case 'isObject':  //Debugger::test()->isObject($var, 'popis')
          $result = is_object($value);
        break;

        case 'isArray': //Debugger::test()->isArray($var, 'popis')
          $result = is_array($value);
        break;

        case 'isBoolean': //Debugger::test()->isBoolean($var, 'popis')
        case 'isBool': //Debugger::test()->isBool($var, 'popis')
          $result = is_bool($value);
        break;

        default:
          throw new ExceptionDebugger('neznamy test!');
        break;
      }
      self::$instance->tests[self::$instance->group][] = array($description, $method, $value, $result);
      return $result;
    }

    /**
     * zobrazeni vysledku vsech testu
     *
     * @return formatovany vystup
     */
    public static function viewTests() {
      // callback na generovani skupin
      $create_group = function ($group, $key) {
        // callback na generovani radku
        $print_test = function ($row) { $c = __CLASS__; return sprintf('TEST: %s <strong>%s(%s)</strong> => %s', $row[0], $row[1], $c::dump($row[2], false), ($row[3] ? 'true' : 'false')); };
        return sprintf('skupina testu: <strong>%s</strong><br />%s%s', $key, PHP_EOL, implode('<br />'.PHP_EOL, array_map($print_test, $group)));
      };
      return implode('<br />'.PHP_EOL, array_map($create_group, self::$instance->tests, array_keys(self::$instance->tests)));
    }

    /**
     * vnitrni metoda nadetekovani typu a prevod do citelne podoby
     *
     * @param value hodnota
     * @return detekovany a upraveny popis typu
     */
    private static function _getType($value) {
      $result = null;
      switch (gettype($value)) {
        case 'boolean':
          $result = 'bool('.($value ? 'true' : 'false').')';
        break;

        case 'integer':
          $result = 'int('.$value.')';
        break;

        case 'float':
        case 'double':
          $result = 'double('.$value.')';
        break;

        case 'string':
          $result = 'string('.strlen($value).') "'.$value.'"';
        break;

        case 'array':
          $result = 'array('.count($value).') { ... }';
        break;

        case 'object':
          $result = 'object('.get_class($value).')';
        break;

        case 'resource':
          $result = 'resource('.get_resource_type($value).')';
        break;

        case 'NULL':
          $result = 'NULL';
        break;

        case 'unknown type':
          $result = 'UNKNOWN TYPE';
        break;
      }
      return $result;
    }

    /**
     * Dumps information about a variable in readable format.
     *
     * @param var variable(s) to dump
     * @param return output instead of printing it? default true, true = stdout
     * @return variable itself or dump
     */
    public static function dump($var, $return = true) {
      $result = array();
      if (is_array($var)) {
        foreach ($var as $v) {
          $result[] = self::_getType($v);
        }
      } else {
        $result = self::_getType($var);
      }
      return print_r($result, !$return);
    }
  }


  /**
   * trida vyjimky pro Debugger
   *
   * @package stable
   * @author geniv
   * @version 1.00
   */
  class ExceptionDebugger extends \Exception {}