<?php
/*
 * sqlbuilder.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;

    /**
     * builder na vystaveni sql create|drop dotazu
     *
     * @package stable
     * @author geniv
     * @version 1.78
     */
    class SqlBuilder {
        const
            CREATE = 'CREATE TABLE IF NOT EXISTS',  // typ vytvareni
            DROP = 'DROP TABLE IF EXISTS';          // typ likvidace

        const
            SQLITE3 = 'sqlite',         // SQLite3 uzpusobeno pro PDOHelper
            MYSQL = 'mysql';            // MySQL

        const
            NAME = '%name%',            // nazev sloupce
            TYPE = '%type%',            // typ sloupce
            SEP = 'sep',                // separator polozek
            // priznaky
            PK = '%pk%',                // primary key - group
            NN = '%nn%',                // not null    - group
            UQ = '%uq%',                // unique
            //bin
            UN = '%un%',                // unsigned
            //zf
            AI = '%ai%',                // auto increment
            // substituce
            DF = '%df%',                // defaultni hodnota
            CM = '%cm%';                // komentar

        const
            // identifikatory
            FK = '%fk%',                    // foreign key
            FK_FOR = 'for',                 // fk foreign
            FK_REF = 'ref',                 // fk reference
            FK_DELETE = 'delete',           // fk on delete
            FK_UPDATE = 'update',           // fk on update
            FK_INDEX = 'fkindex',           // fk index
            FK_INDEX_SEP = 'fksep',         // kf index separator
            // akce KF
            FK_SET_NULL = 'SET NULL',       // nastaveni na null
            FK_SET_DEFAULT = 'SET DEFAULT', // nastaveni na defaultni (asi jen Sqlite3)
            FK_CASCADE = 'CASCADE',         // dodrzeni kasakdy mazani
            FK_RESTRICT = 'RESTRICT',       // chrani pred odstranenim rodicu, ne deti
            FK_NO_ACTION = 'NO ACTION';     // neudela nic

        const
            TYPE_EQ = 'type_eq',            // ekvivalent typu
            TPL_ROW = 'tpl_row';            // template radku dotazu

        private $type = null;           // typ sql dotazu
        private $table = null;          // jmeno tabulky
        private $tableComment = null;   // komentar tabulky
        private $last = null;           // posledni sloupec
        private $columns = array();     // pole sloupcu

        // defaultni hodnoty pro MySQL
        private $charset = 'utf8';
        private $collate = 'utf8_general_ci';
        private $engine = 'InnoDB';

        // atributy sloupcu
        private $attrColumns = array(
            self::SQLITE3 => array(
                self::NAME => '  %s ',
                self::UN => ' UNSIGNED',
                self::NN => ' NOT NULL',
                self::AI => ' AUTOINCREMENT',
                self::DF => ' DEFAULT %s',
                self::CM => ' /* %s */',
                self::PK => ' PRIMARY KEY',
                self::UQ => '  UNIQUE (%s)',
                self::SEP => ', ',
                self::FK_INDEX => '',
                self::FK_INDEX_SEP => '',
                self::FK => '  CONSTRAINT fk_%s
    FOREIGN KEY(%s)
    REFERENCES %s(%s)
    ON UPDATE %s
    ON DELETE %s',
                self::TYPE_EQ => array(
                    'INT' => 'INTEGER',
                    'ENUM' => 'VARCHAR',
                    ),
                self::TPL_ROW => '%name%%type%%un%%nn%%pk%%df%%ai%%cm%',
                ),
            self::MYSQL => array(
                self::NAME => '  `%s` ',
                self::UN => ' UNSIGNED',
                self::NN => ' NOT NULL',
                self::AI => ' AUTO_INCREMENT',
                self::DF => ' DEFAULT %s',
                self::CM => ' COMMENT \'%s\'',
                self::PK => '  PRIMARY KEY (`%s`)',
                self::UQ => '  UNIQUE INDEX (`%s`)',
                self::SEP => '`, `',
                self::FK_INDEX => '  INDEX `fk_%s_index` (`%s` ASC)',
                self::FK_INDEX_SEP => '` ASC, `',
                self::FK => '  CONSTRAINT `fk_%s`
    FOREIGN KEY (`%s`)
    REFERENCES `%s` (`%s`)
    ON DELETE %s
    ON UPDATE %s',
                self::TYPE_EQ => null,
                self::TPL_ROW => '%name%%type%%un%%nn%%df%%ai%%cm%',
            ),
        );

        /**
         * defaultni konstruktor
         *
         * @since 1.02
         * @param string table nazev tabulky
         * @param string type typ sql prikazu: CREATE, DROP
         */
        private function __construct($table, $type) {
            $this->table = $table;
            $this->type = $type;
        }

        /**
         * tovarni metoda na vytvoreni tabulky
         *
         * @since 1.02
         * @param string table nazev tabulky
         * @param string|null comment komentar cele tabulky (ma smysl pro MySQL)
         * @return SqlBuilder instance sama sebe pro CREATE
         */
        public static function create($table, $comment = null) {
            $b = new self($table, self::CREATE);
            if ($comment) {
                $b->tableComment($comment);
            }
            return $b;
        }

        /**
         * tovarni metoda na likvidaci tabulky
         *
         * @since 1.32
         * @param string table nazev tabulky
         * @return SqlBuilder instance sama sebe pro DROP
         */
        public static function drop($table) {
            $b = new self($table, self::DROP);
            return $b;
        }

        /**
         * nacitani typu vytvorene tovarny
         *
         * @since 1.36
         * @param void
         * @return string text typu
         */
        public function type() {
            return $this->type;
        }

        /**
         * hlavni metoda na pridavani sloupce
         *
         * @since 1.02
         * @param string name jmeno sloupce
         * @return this
         */
        public function column($name) {
            $this->columns[$name] = array(  // predefinice pole
                self::TYPE => null,
                self::PK => false,
                self::NN => false,
                self::UQ => false,
                self::UN => false,
                self::AI => false,
                self::DF => null,
                self::CM => null,
                self::FK => null,
                );
            $this->last = $name;    // ukladani posledniho klice
            return $this;
        }

        /**
         * kratsi alias pro metodu column()
         *
         * @since 1.40
         * @param string name jmeno sloupce
         * @return this
         */
        public function c($name) {
            return $this->column($name);
        }

        /**
         * odstrani sloupec
         *
         * @since 1.70
         * @param string name jmeno sloupce
         * @return void
         */
        public function remove($name) {
            unset($this->columns[$name]);
        }

        /**
         * nacteni konkretniho sloupce
         *
         * @since 1.70
         * @param string name jmeno sloupce
         * @return array struktura sloupce
         */
        public function getColumn($name) {
            if (isset($this->columns[$name])) {
                return $this->columns[$name];
            } else {
                throw new ExceptionSqlBuilder('sloupec neexistuje');
            }
        }

        /**
         * nacteni pole nazvu sloupcu
         *
         * @since 1.16
         * @param void
         * @return array pole sloupcu
         */
        public function getColumns() {
            return array_keys($this->columns);
        }

        /**
         * nacteni typu sloupce
         *
         * @since 1.18
         * @param string column nazev sloupce
         * @return string typ slouce
         */
        public function getType($column) {
            if (isset($this->columns[$column])) {
                return $this->columns[$column][self::TYPE];
            } else {
                throw new ExceptionSqlBuilder('sloupec neexistuje');
            }
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
            if (isset($args[0]) && is_array($args[0])) {
                $args[0] = '\'' . implode('\', \'', $args[0]) . '\'';
            }
            $this->columns[$this->last][self::TYPE] = strtoupper($method) . (count($args) > 0 ? '(' . implode(',', $args) . ')' : null);
            return $this;
        }

        /**
         * nastavovani defaultni hodnoty
         *
         * @since 1.32
         * @param string value defaultni hodnota
         * @return this
         */
        public function defaultValue($value) {
            $this->columns[$this->last][self::DF] = $value;
            return $this;
        }

        /**
         * definovani primarniho klice
         * - k ciselnemu typu, podporuje nekolik klicu
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
         * kratsi alias k metode primary()
         *
         * @since 1.38
         * @param void
         * @return this
         */
        public function pk() {
            return $this->primary();
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
         * kratsi alias k metode notNull()
         *
         * @since 1.38
         * @param void
         * @return this
         */
        public function nn() {
            return $this->notNull();
        }

        /**
         * definovani k typu UNIQUE
         * - unikatni typ
         *
         * @since 1.08
         * @param void
         * @return this
         */
        public function unique() {  //TODO pokud bude potreba ON CONFLICT http://www.sqlite.org/lang_conflict.html , http://www.sqlite.org/syntaxdiagrams.html#conflict-clause
            $this->columns[$this->last][self::UQ] = true;
            return $this;
        }

        /**
         * kratsi alias k metode unique()
         *
         * @since 1.38
         * @param void
         * @return this
         */
        public function uq() {
            return $this->unique();
        }

        /**
         * definovani k typu UNSIGNED
         * - neznamenkovy typ (ciselne)
         *
         * @since 1.08
         * @param void
         * @return this
         */
        public function unsigned() {
            $this->columns[$this->last][self::UN] = true;
            return $this;
        }

        /**
         * kratsi alias k metode unsigned()
         *
         * @since 1.38
         * @param void
         * @return this
         */
        public function un() {
            return $this->unsigned();
        }

        /**
         * definovani k typu AUTO INCREMENT
         * - automaticke pricitani vetsinou k primarnimu klici
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
         * kratsi alias k metode autoIncrement()
         *
         * @since 1.38
         * @param void
         * @return this
         */
        public function ai() {
            return $this->autoIncrement();
        }

        /**
         * definovani foreign key vazeb
         *
         * @since 1.32
         * @param string foreigns cilova tabulka
         * @param string references cilove sloupce
         * @param string ondelete akce pri delete
         * @param string onupdate akce pri update
         * @return this
         */
        public function foreign($foreigns, $references, $ondelete = null, $onupdate = null) {
            $this->columns[$this->last][self::FK] = array(
                self::FK_FOR => $foreigns,      // reference na tabulku
                self::FK_REF => $references,    // reference na sloupec
                self::FK_DELETE => ($ondelete ?: self::FK_NO_ACTION),   // akce on delete
                self::FK_UPDATE => ($onupdate ?: self::FK_NO_ACTION),   // akce on update
                );
            return $this;
        }

        /**
         * kratsi alias k metode foreign()
         *
         * @since 1.52
         * @param string foreigns cilova tabulka
         * @param string references cilove sloupce
         * @param string ondelete akce pri delete
         * @param string onupdate akce pri update
         * @return this
         */
        public function fk($foreigns, $references, $ondelete = null, $onupdate = null) {
            return $this->foreign($foreigns, $references, $ondelete, $onupdate);
        }

        //TODO vkladani nejakych dalsich indexu??
        //index, fulltext

        /**
         * definovani komentare pro celou tabulku
         * - ma smysl jen pro MySQL
         *
         * @since 1.48
         * @param string comment text komentare
         * @return this
         */
        public function tableComment($comment) {
            $this->tableComment = $comment;
            return $this;
        }

        /**
         * definovani komentare pro sloupec
         * - vyuziti hlavne pro mysql, v sqlite3 se nikde neukazuji
         *
         * @since 1.32
         * @param string comment text komentare
         * @return this
         */
        public function comment($comment) {
            $this->columns[$this->last][self::CM] = $comment;
            return $this;
        }

        /**
         * nastavovani engine pro MySQL
         *
         * @since 1.40
         * @param string engine nazev engine
         * @return this
         */
        public function setEngine($engine) {
            $this->engine = $engine;
            return $this;
        }

        /**
         * nastavovani charset pro MySQL
         *
         * @since 1.40
         * @param string charset kodovani tabulky
         * @return this
         */
        public function setCharset($charset) {
            $this->charset = $charset;
            return $this;
        }

        /**
         * nastaveni porovanvani pro MySQL
         *
         * @since 1.78
         * @param string collate typ porovnavani
         * @return this
         */
        public function setCollate($collate) {
            $this->collate = $collate;
            return $this;
        }
//TODO collate porovavani i pro samostatne textove sloupce mysql
        /**
         * interni generovani PK
         *
         * @since 1.36
         * @param string db typ databaze
         * @return string primarni klice
         */
        private function generatePK($db) {
            $result = array();
            foreach ($this->columns as $name => $value) {
                if ($value[self::PK]) {
                    $result[] = $name;
                }
            }
            return ($result ? sprintf($this->attrColumns[$db][self::PK],
                                            implode($this->attrColumns[$db][self::SEP], $result)) : '');
        }

        /**
         * interni generovani cizich klicu
         *
         * @since 1.40
         * @param string db typ databaze
         * @return string cizi klice a jejich indexy
         */
        private function generateFK($db) {
            $idx = $fkx = array();
            // seskladani indexu a fk
            foreach ($this->columns as $name => $value) {
                if ($value[self::FK]) {
                    $idx[] = sprintf($this->attrColumns[$db][self::FK_INDEX],
                                            $name,
                                            $name);

                    $fkx[] = sprintf($this->attrColumns[$db][self::FK],
                                            $value[self::FK][self::FK_FOR].'_'.$name,
                                            $name,
                                            $value[self::FK][self::FK_FOR],
                                            $value[self::FK][self::FK_REF], //TODO vkladat i pole?
                                            $value[self::FK][self::FK_DELETE],
                                            $value[self::FK][self::FK_UPDATE]);
                }
            }
            return implode(',' . PHP_EOL, array_filter(array_merge($idx, $fkx)));
        }

        /**
         * interni generovani UQ
         *
         * @since 1.44
         * @param string db typ databaze
         * @return string unikatni klice
         */
        private function generateUQ($db) {
            $result = array();
            foreach ($this->columns as $name => $value) {
                if ($value[self::UQ]) {
                    $result[] = $name;
                }
            }
            return ($result ? sprintf($this->attrColumns[$db][self::UQ],
                                            implode($this->attrColumns[$db][self::SEP], $result)) : '');
        }

        /**
         * interni generovani sloupcu
         *
         * @since 1.40
         * @param string db typ databaze
         * @return string sloupce
         */
        private function generateColumns($db) {
            $result = array();
            foreach ($this->columns as $name => $value) {
                // ekvivalenty typu
                $type = $value[self::TYPE];
                if ($this->attrColumns[$db][self::TYPE_EQ]) {
                    $t = $type;
                    if (($pos = strpos($t, '(')) !== false) {   // pokud ma typ parmetry
                        $t = substr($t, 0, $pos);   // parametry se vyhodi
                    }
                    // pokus o sahnuti na index pole
                    if (isset($this->attrColumns[$db][self::TYPE_EQ][$t])) {
                        $type = $this->attrColumns[$db][self::TYPE_EQ][$t];
                    }
                }

                $search = array(
                    self::NAME => sprintf($this->attrColumns[$db][self::NAME], $name),
                    self::TYPE => $type,
                    self::PK => ($value[self::PK] ? $this->attrColumns[$db][self::PK] : null),
                    self::UN => ($value[self::UN] && !($db == self::SQLITE3 && $value[self::PK]) ? $this->attrColumns[$db][self::UN] : null),
                    // self::UQ
                    self::NN => ($value[self::NN] ? $this->attrColumns[$db][self::NN] : ' NULL'),
                    self::DF => ($value[self::DF] ? sprintf($this->attrColumns[$db][self::DF], $this->columns[$name][self::DF]) : null),
                    self::AI => ($value[self::AI] ? $this->attrColumns[$db][self::AI] : null),
                    self::CM => ($value[self::CM] ? sprintf($this->attrColumns[$db][self::CM], $this->columns[$name][self::CM]) : null),
                    );

                $result[] = str_replace(array_keys($search),
                                        $search,
                                        $this->attrColumns[$db][self::TPL_ROW]);
            }
            return implode(',' . PHP_EOL, $result);
        }

        /**
         * vygenerovani sql pro databazi typu SQLite3
         *
         * @since 1.10
         * @param void
         * @return string finalni sql dotaz
         */
        public function getSQLite3() {
            if ($this->type == self::CREATE) {
                $db = self::SQLITE3;
                $begin = self::CREATE . ' '.$this->table.' (';

                $cols = array(
                    $this->generateColumns($db),
                    // $this->generatePK($db),
                    $this->generateUQ($db),
                    $this->generateFK($db),
                    );
                $cols = implode(',' . PHP_EOL, array_filter($cols));

                $end = array(
                    ')',
                );
                $end = implode(PHP_EOL, $end);

                return $begin . PHP_EOL . $cols . PHP_EOL . $end;
            } else {
                return self::DROP.' '.$this->table;
            }
        }

        /**
         * vygenerovani sql pro databazi typu MySQL
         *
         * @since 1.10
         * @param void
         * @return string finalni sql dotaz
         */
        public function getMySQL() {
            if ($this->type == self::CREATE) {
                $db = self::MYSQL;
                $begin = self::CREATE . ' `'.$this->table.'` (';

                $cols = array(
                    $this->generateColumns($db),
                    $this->generatePK($db),
                    $this->generateUQ($db),
                    $this->generateFK($db),
                    );
                $cols = implode(',' . PHP_EOL, array_filter($cols));

                $end = array(
                    ')',
                    'ENGINE = '.$this->engine,
                    ($this->charset ? 'CHARSET = ' . $this->charset : null),
                    ($this->collate ? 'COLLATE = ' . $this->collate : null),
                    // 'AUTO_INCREMENT = ?'
                    ($this->tableComment ? 'COMMENT = \'' . $this->tableComment . '\'' : null),
                    );
                $end = implode(PHP_EOL, array_filter($end));

//TODO vetsi paleta indexu, fulltext atd...

                return $begin . PHP_EOL . $cols . PHP_EOL . $end;
            } else {
                return self::DROP.' `'.$this->table.'`';
            }
        }

        /**
         * generovani sql pole potrebneho typus databaze
         *
         * @since 1.34
         * @param string type typ vystupni databaze podle konstant: SQLITE3, MYSQL
         * @return string vybenerovany sql dotat
         */
        public function getAs($type) {
            switch ($type) {
                case self::SQLITE3: // generovani pro sqlite3
                    return $this->getSQLite3();

                case self::MYSQL:   // generovani pro mysql
                    return $this->getMySQL();

                default:
                    throw new ExceptionSqlBuilder('zadany typ neexistuje');
            }
        }
    }

    /**
     * vyjimky pro sqlbuilder
     *
     * @package stable
     * @author geniv
     * @version 1.00
     */
    class ExceptionSqlBuilder extends \Exception {}