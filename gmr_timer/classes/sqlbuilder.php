<?php
/*
 * sqlbuilder.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;
//TODO dopsat Unit testy!!!!
    /**
     * builder na vystaveni sql create dotazu
     *
     * @package unstable
     * @author geniv
     * @version 1.16
     */
    class SqlBuilder {
        const
            TYPE = 'type',  // typ sloupce
            PK = 'pk',      // primary key
            NN = 'nn',      // not null
            UQ = 'uq',      // unique
            //bin
            UN = 'un',      // unsigned
            //zf
            AI = 'ai';      // auto increment

        private $table = null;
        private $last = null;
        private $columns = array();

        /**
         * defaultni konstruktor
         *
         * @since 1.02
         * @param string table nazev tabulky
         */
        private function __construct($table) {
            $this->table = $table;
        }

        /**
         * tovarni metoda
         *
         * @since 1.02
         * @param string table nazev tabulky
         * @return SqlBuilder instance sama sebe
         */
        public static function create($table) {
            $b = new self($table);
            return $b;
        }

        /**
         * hlavni metoda na pridavani sloupce
         *
         * @since 1.02
         * @param string name jemno sloupce
         * @return this
         */
        public function column($name) {
            $this->columns[$name] = array(
                self::TYPE => null,
                self::PK => false,
                self::NN => false,
                self::UQ => false,
                self::UN => false,
                self::AI => false,
                );
            $this->last = $name;
            return $this;
        }

        /**
         * definovani typu sloupce
         *
         * @since 1.12
         * @param string method nazev metody
         * @param array args pole argumentu predane funkci
         * @return this
         */
        public function __call($method, $args) {
            $this->columns[$this->last][self::TYPE] = strtoupper($method) . (count($args) > 0 ? '(' . implode(',', $args) . ')' : null);
            return $this;
        }

        /**
         * definovani primarniho klice
         * - k ciselnemu typu
         *
         * @since 1.08
         * @param void
         * @return this
         */
        public function primary() {
            $this->columns[$this->last][self::PK] = true;
            return $this;
        }

        /**
         * definovani k typu NOT NULL
         * - not null znamena povinny, defaultne NULL
         *
         * @since 1.08
         * @param void
         * @return this
         */
        public function notNull() {
            $this->columns[$this->last][self::NN] = true;
            return $this;
        }

        /**
         * definovani k typu UNIQUE
         * - unikatni typ
         *
         * @since 1.08
         * @param void
         * @return this
         */
        public function unique() {
            $this->columns[$this->last][self::UQ] = true;
            return $this;
        }

        /**
         * definovani k typu UNSIGNED
         * - neznamenkovy typ (ciselne)
         *
         * @since 1.00
         * @param void
         * @return this
         */
        public function unsigned() {
            $this->columns[$this->last][self::UN] = true;
            return $this;
        }

        /**
         * definovani k typu AUTO INCREMENT
         * . automaticke pricitani vetsinou k primarnimu klici
         *
         * @since 1.08
         * @param void
         * @return this
         */
        public function autoIncrement() {
            $this->columns[$this->last][self::AI] = true;
            return $this;
        }

        /**
         * vygenerovani sql pro databazi typu SQLite3
         *
         * @since 1.10
         * @param void
         * @return string finalni sql dotaz
         */
        public function getSQLite3() {
            $result = 'CREATE TABLE IF NOT EXISTS '.$this->table.' ('.PHP_EOL;
            $res = array();
            foreach ($this->columns as $name => $value) {
                $res[] = $name.' '.
                    ($value[self::UN] ? 'UNSIGNED ' : null).
                        $value[self::TYPE].
                    ($value[self::NN] ? ' NOT NULL' : ' NULL').
                    ($value[self::UQ] ? ' UNIQUE' : null).
                    ($value[self::PK] ? ' PRIMARY KEY' : null).
                    ($value[self::AI] ? ' AUTOINCREMENT' : null);
            }
            return $result.implode(','.PHP_EOL, $res).PHP_EOL.')';
        }
//TODO mohlo by podporovat zavislosti v podobe FK, komentare k tabulce a radkum?!
//TODO via: http://www.sqlite.org/foreignkeys.html  http://www.sqlite.org/lang_createtable.html - musi se pokazde zaponat pragma!
        /**
         * vygenerovani sql pro databazi typu MySQL
         *
         * @since 1.10
         * @param void
         * @return string finalni sql dotaz
         */
        public function getMySQL() {
            $result = 'CREATE TABLE IF NOT EXISTS `'.$this->table.'` ('.PHP_EOL;
            $res = array();
            foreach ($this->columns as $name => $value) {
                $res[] = '`'.$name.'` '.
                    $value[self::TYPE].
                    ($value[self::UN] ? ' UNSIGNED' : null).
                    ($value[self::NN] ? ' NOT NULL' : ' NULL').
                    ($value[self::UQ] ? ' UNIQUE' : null).
                    ($value[self::PK] ? ' PRIMARY KEY' : null).
                    ($value[self::AI] ? ' AUTO_INCREMENT' : null);
            }
            //TODO nepodporuje: ENGINE = InnoDB, CONSTRAINT, INDEX, UNIQUE INDEX, COMMENT
            return $result.implode(','.PHP_EOL, $res).PHP_EOL.')';
        }
    }