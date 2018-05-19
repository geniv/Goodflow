<?php
/*
 * sql.php
 *
 * Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass;

  class Sql {
    const VERSION = 1.225;

    const BOOLEAN = 'bool';
    const INTEGER = 'int';
    const TEXT = 'text';
    const DATE = 'date';
    const DATETIME = 'datetime';
    const VARCHAR = 'varchar';  //pretezovana konstanta
    const FLOAT = 'float';
    const DOUBLE = 'double';

    //pripony
    const UNIQUE = ' unique';
    //const PRIMARYKEY = ' PRIMARY KEY';
    //const AUTOINCREMENT = ' AUTOINCREMENT';
    //const UNSIGNED = ' unsigned'; //otestovat az na mysql
//TODO podporovat array??
    public static function __callStatic($method, $parameters) {
      $result = NULL;
      //var_dump($method, $parameters);
      switch (strtolower($method)) {
        case self::VARCHAR:
          $result = sprintf('%s(%s)', self::VARCHAR, $parameters[0]);
        break;
      }
      return $result;
    }

    public static function getType($type, $value) {
      $result = NULL;
      if (substr($type, 0, 7) == self::VARCHAR) {
        $type = self::VARCHAR;
      }

      if (substr($type, 0, 3) == self::INTEGER) {
        $type = self::INTEGER;
      }
      //var_dump($type);
      switch ($type) {
        default:
        break;

        case self::FLOAT:
        case self::INTEGER:
          $result = sprintf('%s', empty($value) ? 'NULL' : $value);  //pokud je prazdny vraci null
        break;

        case self::BOOLEAN:
          $result = sprintf('%s', ($value ? 1 : 0));
        break;

        case self::TEXT:
          $result = sprintf('%s', $value);
        break;

        case self::DATE:
        case self::DATETIME:
          $result = sprintf('%s', date('Y-m-d H:i:s', strtotime($value)));
        break;
      }
      return $result;
    }

    //pomocna metoda na rozlisovani typu
    private static function getParseType($type, $value) {
      $result = NULL;
      //odchyceni specialnich typu
      if (substr($type, 0, 7) == self::VARCHAR) {
        $type = self::VARCHAR;
      }

      if (substr($type, 0, 3) == self::INTEGER) {
        $type = self::INTEGER;
      }
      //var_dump($type);
      //uprava hodnoty podle typu
      switch ($type) {
        case self::TEXT:
        case self::VARCHAR:
        case self::FLOAT:
        case self::INTEGER:
          $result = $value;
        break;

        case self::BOOLEAN:
          $result = ($value ? 1 : 0);
        break;

        case self::DATE:
        case self::DATETIME:  //rozlisovani ciselnych nebo textovych formatu
          $result = date('Y-m-d H:i:s', is_numeric($value) ? $value : strtotime($value));
        break;
      }
      return $result;
    }

    //zpracovani hodnot v poli
    public static function getTransferTypes($table_struct, $values) {
      $result = array();
      foreach ($values as $col => $value) {
        $result[] = (self::getParseType($table_struct[$col], $value));
      }
      return $result;
    }

//TODO je to jen zatim na generovani jednoduchych dotazu, neumi spojovat tabulky a podobne pokrocile prace
    private $query = NULL;

    public function __construct() {
      $this->query = new stdClass;
      $this->query->column = array();
      $this->query->table = array();
      $this->query->table_args = array();
      $this->query->where = NULL;
      $this->query->order = NULL;
      $this->query->ordertype = NULL;
      $this->query->limit = NULL;

      $this->query->limit_args= NULL;
      $this->query->where_args = NULL;
      //TODO v konstruktoru volit nejake zasadni zmeny pro instanci dotazu?
    }
//FIXME zatim nezvlada uplne dobre zavolani 2x stejne instance...
    //public function column($name) {}
    public function __call($method, $parameters) {
      //var_dump($method, $parameters, $this->query);
      switch ($method) {
        case 'column':  //jeden sloupec
          $this->query->column[] = $parameters[0];
        break;

        case 'columns': //vice sloupcu
          $this->query->column = array_merge($this->query->column, $parameters);
        break;

        case 'table': //jedna tabulka
          $this->query->table[] = $parameters[0];
          $this->query->table_args[] = $parameters[0];
        break;

        case 'tables':  //vice tabulek
          $this->query->table = array_merge($this->query->table, $parameters);
        break;

        case 'order': //razeni podle
          $this->query->order = $parameters[0];
        break;
//TODO otestovat vicenasobne razeni!
        case 'asc':   //razeni asc
        case 'desc':  //razeni desc
          $this->query->ordertype = ' '.strtoupper($method);
        break;

        case 'limit': //limitovani, z tudma brat rovnou hodnoty
          $this->query->limit = sprintf(' LIMIT %d,%d', $parameters[0], $parameters[1]);
          $this->query->limit_args = $parameters;
        break;

        //group

        case 'where':
          $this->query->where = sprintf(' WHERE %s', $parameters[0]);
          if (count($parameters) > 1) {
            $this->query->where_args = array_slice($parameters, 1);
          } else {
            $this->query->where_args = $parameters[0];
          }
        break;

        default:
          echo 'neaplikovano...';
        break;
      }
      return $this;
    }
/*
    public function getTable() {
      return implode(', ', $this->query->table_args);
    }

    public function getLimitArgs() {
      return $this->query->limit_args;
    }
*/
    public function getWhereArgs() {
      return $this->query->where_args;
    }

    public function getSql() {
      //tady bude veskere generovani

      $columns = implode(', ', $this->query->column);
      $table = implode(', ', $this->query->table);
      $where = $this->query->where;
      $order = $this->query->order;
      $ordertype = $this->query->ordertype;
      $limit = $this->query->limit;

      $_order = NULL;
      if (!empty($order)) {
        $_order = sprintf(' ORDER BY %s%s%s', $order, $ordertype, $limit);
      }
      $result = sprintf('SELECT rowid, %s FROM %s%s%s', $columns, $table, $where, $_order);

      return $result;
    }

    public function __toString() {
      return $this->getSql();
    }

  }


?>
