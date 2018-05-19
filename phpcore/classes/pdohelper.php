<?php
/*
 * pdohelper.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

    namespace classes;

    /**
     * PDOOpenHelper, tvorba integritnich omezeni (mysql: innodb)
     * - zalozeno na: http://developer.android.com/reference/android/database/sqlite/SQLiteOpenHelper.html
     *
     * @package stable/pdo
     * @author geniv
     * @version 3.26
     */
    abstract class PDOHelper {

        const SQLITE_MEMORY = ':memory:';
        const MIN_PHP = '5.3.6';  //pro MySQL

        private $handle = null; // handler pripojeni databaze
        private $params = null; // pridavne parametry

        private $sqlitePath = null; // cela cestu SQLite databaze, pro jeji pripadne smazani

        /**
         * Create a helper object to create, open, and/or manage a database.
         * - #public SQLiteOpenHelper(Context context, String name, SQLiteDatabase.CursorFactory factory, int version)
         * - defautlni konstruktor
         * - prefixy se resi pouze v odvozene tride!!!!
         * - muze se dedit, pokud je potreba z venku zadavat nazev db; public function __construct($name) { parent::__construct($name); }
         *
         * @since 2.00
         * @param string dbname of the database file or host mysql database or null for an in-memory database
         */
        public function __construct($dbname, $options = array()) {
          $params = array(
              'dbname' => ($dbname ?: null),
              'charset' => 'utf8',
              'path' => null,
          );
          $this->params = array_merge($params, $options);
        }

        /**
         * Called when the database is created for the first time. This is where the creation of tables and the initial population of the tables should happen.
         * - #public abstract void onCreate (SQLiteDatabase db)
         * - overlay on inheritance class
         * - muze se dedit, pokud je potreba vytvaret a plnit tabulky; public function onCreate(PDODatabase $db) { $db->execSQL(...); }
         *
         * @since 2.00
         * @param PDODatabase db The database.
         * @param mixed data uzivatelske data
         * @return void
         */
        public function onCreate(PDODatabase $db, $data = null) {}

        /**
         * Close any open database object.
         * - #public synchronized void close ()
         *
         * @since 2.00
         * @param void
         * @return void
         */
        public function close() {
            $this->handle = null;
        }

        /**
         * univerzalni pripojovac pro sqliteX databaze
         *
         * @since 2.00
         * @param string type typ sqlite databaze
         * @param string dbpath volitelny path pro databazi
         * @param bool fk povolovani cizich klicu (ForeigKeys)
         * @return this
         */
        private function __SQLiteX($type, $dbpath = null, $fk = null) {
            if ($this->params['dbname']) {
                if ($dbpath) {
                    $path = $dbpath . '/' . $this->params['dbname'];  // parametr + option (path + name)
                } else
                if ($this->params['path']) {
                    $path = $this->params['path'] . '/' . $this->params['dbname'];  // option + option (path + name)
                } else {
                    $path = $this->params['dbname'];  // option (path/name)
                }
            } else {
                $path = self::SQLITE_MEMORY;
            }
            $this->sqlitePath = $path;  // ulozeni sqlite pathe

            if (in_array($type, \PDO::getAvailableDrivers())) {
              $this->handle = new PDODatabase($type . ':' . $path);
              if ($fk) {
                  $this->handle->execSQL('PRAGMA foreign_keys='.($fk ? 'ON' : 'OFF'));   // aktivace / deaktivate podpory FK
              }
            } else {
              throw new \PDOException('could not find driver');
            }
            return $this;
        }

        /**
         * SQLite2 PDO connector
         * - doporucuji pouze cteni!
         * - v PHP 5.3.x sqlite2 jiz nefunguje!!
         *
         * @since 2.00
         * @deprecated
         * @param string path database path, nepovinny, null == memory
         * @return this
         */
        public function SQLite2($dbpath = null) {
            return $this->__SQLiteX('sqlite2', $dbpath);
        }

        /**
         * SQLite3 PDO connector
         *
         * @since 2.00
         * @param string path database path, nepovinny, null == memory
         * @param bool fk zapinani kontroly cizich klicu (ForeignKey), defaultne false
         * @return this
         */
        public function SQLite3($dbpath = null, $fk = false) {
            return $this->__SQLiteX('sqlite', $dbpath, $fk);
        }

        /**
         * vrati cestu sqliteX databaze
         *
         * @since 2.00
         * @param void
         * @return string sqlite path
         */
        public function getSQLitePath() {
            return $this->sqlitePath;
        }

        /**
         * smaze SQLiteX databazi, teda pokud nejde o memory databazi
         *
         * @since 2.08
         * @param void
         * @return bool true pokud bylo uspesne smazano
         */
        public function deleteDatabase() {
            return ($this->sqlitePath == self::SQLITE_MEMORY ?: @unlink($this->sqlitePath));
        }

        /**
         * zpracovani promennych predanych pres array host
         *
         * @since 2.10
         * @param string host hostname
         * @param string username username do databaze
         * @param string password password do databaze
         * @param int port port k databazi
         * @param array options pdo options
         * @return void
         */
        protected function parseHost(&$host, &$username, &$password, &$port, &$options) {
            if (is_array($host)) {
                extract($host); //predani promenych do php a vyvraceni pres parametry
            } else {
                if (!isset($username)) {  // osetreni username
                    throw new \PDOException('username is not defined!');
                }

                if (!isset($password)) {  // osetreni password
                    throw new \PDOException('password is not defined!');
                }
            }
        }

        /**
         * MySQL PDO connector
         * - stara se o navazani komunikace s MySQL serverem
         *
         * @since 2.00
         * @param string|array host database host|array: array('host', 'username', 'password'[, 'port', 'options'])
         * @param string username database user
         * @param string password database password
         * @param int port database port
         * @param array options PDO option array
         * @return this
         */
        public function MySQL($host, $username = null, $password = null, $port = null, $options = null) {
            if (version_compare(PHP_VERSION, self::MIN_PHP, '>=')) {
                $this->parseHost($host, $username, $password, $port, $options);
                $port = ($port ?: 3306);
                $uri = 'mysql:host='.$host.';dbname='.$this->params['dbname'].';port='.$port.';charset='.$this->params['charset'];
                $this->handle = new PDODatabase($uri, $username, $password, $options);
            } else {
                throw new \PDOException('Minimum php version for using charset is: '.self::MIN_PHP);
            }
            return $this;
        }
//TODO promyslet tady toto!! neni to uplne stastne reseni!!!
        /**
         * Oracle OCI8 PDO connector
         * - pro fungovani je nutne doinstalovat z oracle potrebne ovladace
         * //TODO pripojeni do OCI8 neni otestovano!!!!
         *
         * @since 2.20
         * @param string|array host database host|array: array('host', 'username', 'password'[, 'port', 'options'])
         * @param string username database user
         * @param string password database password
         * @param int port database port
         * @param array options PDO option array
         * @return this
         */
        public function Oci8($host, $username = null, $password = null, $port = null, $options = null) {
            $this->parseHost($host, $username, $password, $port, $options);
            $port = ($port ?: 1521);
            $uri = 'oci:dbname='.$host.';port='.$port.';charset='.$this->params['charset'];
            $this->handle = new PDODatabase($uri, $username, $password, $options);
            return $this;
        }

        /**
         * Create and/or open a database.
         * - #public SQLiteDatabase getReadableDatabase ()
         * - #public SQLiteDatabase getWritableDatabase ()
         * - defaultne nevytvari tabulky (neprovadi onCreate u potomka tridy)
         *
         * @since 2.00
         * @param bool autocreate true pro automaticke volani onCreate() v potomkovy
         * @param mixed data uzivatelske data
         * @return PDODatabase a database object valid until close() is called.
         */
        public function getDatabase($autocreate = false, $data = null) {
            // pokud je databaze pripojena
            if ($this->handle) {
                //pokud je zapnute autovytvareni tabulek (u potomka tridy)
                if ($autocreate) {
                    static::onCreate($this->handle, $data);  //volani onCreate u potomka
                }
                return $this->handle;
            } else {
                throw new \PDOException('Unable to connect to database.');
            }
        }

        /**
         * tovarni metoda na pripojovani databazoveho layeru
         *
         * @since 3.22
         * @param array configure pole konfigurace, povinne: handler, driver
         * @param mixed data uzivatelske data
         * @return PDODatabase instance pripojeni
         */
        public static function getFactoryDatabase($configure, $data = null) {
            if (!isset($configure['name'])) { throw new \PDOException('database name is not defined!'); }
            if (!isset($configure['driver'])) { throw new \PDOException('driver is not defined!'); }
            $parent = get_called_class();   // naceni volane tridy
            $handler = new $parent($configure['name']); // vytvoreni instance handleru
            $driver = $configure['driver']; // nacteni driveru
            $dsn = isset($configure['dsn']) ? $configure['dsn'] : null; // definice dsn
            $autoinstall = isset($configure['autoinstall']) && $configure['autoinstall'];    // auto install
            return $handler->$driver($dsn)->getDatabase($autoinstall, $data);   // nacteni databaze
        }
    //FIXME prejmenovat na connect!!!
    //FIXME indentation na 4!
    //FIXME data a autoinstall uklad do instance a udelat pristup takovy, pokud nebude potrebovat pripojeni tak se nebude pripojovat!!
        /**
         * Return the name of the SQLite database being opened, as given to the constructor.
         * - #public String getDatabaseName ()
         *
         * @since 2.00
         * @param void
         * @return string Return the name of database
         */
        public function getDatabaseName() {
            return $this->params['dbname'];
        }

        /**
         * Set new database name
         *
         * @since 2.00
         * @param string dbname new database name
         * @return this
         */
        public function setDatabaseName($dbname) {
            if ($dbname) {
                $this->params['dbname'] = $dbname;
            }
            return $this;
        }

        /**
         * vrati nastaveny db path
         *
         * @since 2.00
         * @param void
         * @return string database path
         */
        public function getDatabasePath() {
            return $this->params['path'];
        }

        /**
         * nastavi novy db path
         *
         * @since 2.00
         * @param string path nova cesta
         * @return this
         */
        public function setDatabasePath($path) {
            if ($path) {
                $this->params['path'] = $path;
            }
            return $this;
        }

        /**
         * nacteni charsetu
         * - defaultne: utf8
         *
         * @since 2.00
         * @param void
         * @return string aktualni charset
         */
        public function getCharset() {
            return $this->params['charset'];
        }

        /**
         * nastaveni charsetu pro pripojeni
         *
         * @since 2.00
         * @param string charset novy charset
         * @return this
         */
        public function setCharset($charset) {
            if ($charset) {
                $this->params['charset'] = $charset;
            }
            return $this;
        }
    }



  /**
   * PDODatabase, spravce samotne instance databaze, uvnitr PDO
   * - zalozeno na: http://developer.android.com/reference/android/database/sqlite/SQLiteDatabase.html
   *
   * @package stable/pdo
   * @author geniv
   * @version 2.54
   */
  final class PDODatabase {

    private $pdo = null;  // PDO objekt
    private $error = null;  // text chyby

    /**
     * Construct for create PDO object
     * - defaultne nastavuje: ATTR_STATEMENT_CLASS na classes\PDOCursor
     *
     * @since 2.00
     * @param string uri PDO uri url
     * @param string user database user
     * @param string passwd datamase password
     * @param array driver_options PDO options array
     */
    public function __construct($uri, $user = null, $passwd = null, $driver_options = array()) {
      if ($uri) {
        // nastaveni tridy Cursoru na vlastni tridu
        $driver_options[\PDO::ATTR_STATEMENT_CLASS] = array('classes\PDOCursor', array());
        $this->pdo = new \PDO($uri, $user, $passwd, $driver_options); // pri chybe vyvola vyjimku
        $this->checkPDOError();
      }
    }

    /**
     * nacteni vnitrni instance POD objektu
     *
     * @since 2.34
     * @param void
     * @return \PDO vnitrni instance
     */
    public function getPDO() {
      return $this->pdo;
    }

    /**
     * Check error in PDO transaction
     *
     * @since 2.00
     * @param null|PDOStatement statement input error from fetch statement, optional
     * @return void
     */
    private function checkPDOError($statement = null) {
      $e = ($statement ? $statement->errorInfo() : $this->pdo->errorInfo());
      if (!is_null($e[1])) {
        throw new \PDOException($e[2]);
      }
    }

    /**
     * vrati text chyby, pokud dotaz teda naskonci s PDOException
     *
     * @since 2.00
     * @param void
     * @return string text chyby
     */
    public function getError() {
      return $this->error[2];
    }

    /**
     * vyskytla se nejaka chyba?
     *
     * @since 2.00
     * @param void
     * @return bool true pokud se vyskytla chyba
     */
    public function isError() {
      return isset($this->error);
    }

    /**
     * Initiates a transaction
     * - Begins a transaction in EXCLUSIVE mode.
     * - #public void beginTransaction ()
     * - support: InnoDB
     *
     * @since 2.00
     * @param void
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function beginTransaction() {
      return $this->pdo->beginTransaction();
    }

    /**
     * Commits a transaction
     * - End a transaction.
     * - #public void endTransaction ()
     * - support: InnoDB
     *
     * @since 2.00
     * @param void
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function endTransaction() {
      return $this->pdo->commit();
    }

    /**
     * Rolls back the current transaction
     * - vraceni zaznamu na zpet, pokud se transakce nezdarila
     * - support: InnoDB
     *
     * @since 2.00
     * @param void
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function rollBack() {
      return $this->pdo->rollBack();
    }

    /**
     * Checks if inside a transaction
     * - Returns true if the current thread has a transaction pending.
     * - #public boolean inTransaction ()
     *
     * @since 2.00
     * @param void
     * @return bool Returns TRUE if a transaction is currently active, and FALSE if not.
     */
    public function inTransaction() {
      return (bool) $this->pdo->inTransaction();
    }

    /**
     * vnitrni insert metoda
     *
     * @since 2.00
     * @param string table nazev tabulky
     * @param ContentValues values instance s hodnotama
     * @return array pole s vysledkama
     */
    private function _insert($table, ContentValues $values) {
      $content = $values->_getContent();
      $keys = implode(', ', $content['keys']);  //TODO bacha na ` jsou hlavne pro mysql?! nutne u FK!
      //FIXME hledat unikatni predefinovana slova!!!! jako je from a to atd...
      $values = $content['keys'] ? implode(', ', array_fill(0, count($content['keys']), '?')) : null;
      $sql = 'INSERT INTO ' . $table . ' (' . $keys . ') VALUES (' . $values . ');';
      $stpdo = $this->pdo->prepare($sql);
      return array('result' => ($stpdo->execute($content['values']) ? intval($this->pdo->lastInsertId()) : -1),
                   'statement' => $stpdo);
    }

    /**
     * Convenience method for inserting a row into the database.
     * - #public function insert(String table, String nullColumnHack, ContentValues values)
     *
     * @since 2.00
     * @param string table the table to insert the row into
     * @param ContentValues values this map contains the initial column values for the row. The keys should be the column names and the values the column values
     * @return int the row ID of the newly inserted row, or -1 if an error occurred
     */
    public function insert($table, ContentValues $values) {
      $res = $this->_insert($table, $values);
      $code = $res['statement']->errorCode();
      if ($code != 23000) { // vyjimka na error kod duplicity
        $this->checkPDOError($res['statement']);
      } else {
        $this->error = $res['statement']->errorInfo();
      }
      return $res['result'];
    }

    /**
     * Convenience method for inserting a row into the database.
     * - #public long insertOrThrow (String table, String nullColumnHack, ContentValues values)
     *
     * @since 2.00
     * @param string table the table to insert the row into
     * @param ContentValues values this map contains the initial column values for the row. The keys should be the column names and the values the column values
     * @return int the row ID of the newly inserted row, or -1 if an error occurred
     */
    public function insertOrThrow($table, ContentValues $values) {
      $res = $this->_insert($table, $values);
      $this->checkPDOError($res['statement']);
      return $res['result'];
    }

    /**
     * vicenasobne vkladani radku do databaze
     * - vklada se pole trid typu ContentValues
     * - strukturalne podobna metode: insert()
     *
     * @since 2.46
     * @param string table jmeno tabulky
     * @param array values pole trid ContentValues pro jednu tabulku
     * @return int pocet ovlivnenych polozek, -1 pri zadnem zasahu
     */
    public function insertMultiple($table, array $values) {
      $result = null;
      if ($values && $values[0] instanceof ContentValues) {
        $keys = $values[0]->_getContentKeys();
        $cols = implode(', ', $keys);
        $sql = 'INSERT INTO ' . $table . ' (' . $cols . ') VALUES ';
        $fill = '(' . implode(', ', array_fill(0, count($keys), '?')) . ')';
        $sql .= implode(', ', array_fill(0, count($values), $fill)) . ';';
        $val = array();
        foreach ($values as $v) {
          if ($v instanceof ContentValues) {
            $val = array_merge($val, array_values($v->_getContentValues()));
          }
        }
        $stpdo = $this->pdo->prepare($sql);
        $result = $stpdo->execute($val) ? intval($stpdo->rowCount()) : -1;
        if ($stpdo->errorCode() != 23000) {
          $this->checkPDOError($stpdo);
        } else {
          $this->error = $stpdo->errorInfo();
        }
      }
      return $result;
    }

    /**
     * vnitrni update metoda
     *
     * @since 2.42
     * @param string table nazev tabulky
     * @param ContentValues values instance s hodnotama
     * @param string whereClause podminka pro upravu
     * @param array whereArg pole hodnot pro podminku
     * @return array pole s vysledkama
     */
    private function _update($table, ContentValues $values, $whereClause, array $whereArgs) {
      $content = $values->_getContent();
      $values = implode(', ', array_map(function($pole) {
          return $pole . '=?';
        }, $content['keys']));
      $sql = 'UPDATE ' . $table . ' SET ' . $values . ' WHERE ' . $whereClause . ';';
      $stpdo = $this->pdo->prepare($sql);
      return array('result' => ($stpdo->execute(array_merge($content['values'], $whereArgs)) ? intval($stpdo->rowCount()) : -1),
                    'statement' => $stpdo);
    }

    /**
     * Convenience method for updating rows in the database.
     * - #public int update (String table, ContentValues values, String whereClause, String[] whereArgs)
     *
     * @since 2.00
     * @param string table the table to update in
     * @param ContentValues values a map from column names to new column values. null is a valid value that will be translated to NULL.
     * @param string whereClause the optional WHERE clause to apply when updating. Passing null will update all rows.
     * @param array whereArgs You may include ?s in the where clause, which will be replaced by the values from whereArgs. The values will be bound as Strings.
     * @return int the number of rows affected, or -1 if an error occurred
     */
    public function update($table, ContentValues $values, $whereClause, array $whereArgs) {
      $res = $this->_update($table, $values, $whereClause, $whereArgs);
      $code = $res['statement']->errorCode();
      if ($code != 23000) { // vyjimka na error kod duplicity
        $this->checkPDOError($res['statement']);
      } else {
        $this->error = $res['statement']->errorInfo();
      }
      return $res['result'];
    }

    /**
     * Convenience method for updating rows in the database, with throw
     * - #public int updateWithOnConflict (String table, ContentValues values, String whereClause, String[] whereArgs, int conflictAlgorithm)
     *
     * @since 2.42
     * @param string table the table to update in
     * @param ContentValues values a map from column names to new column values. null is a valid value that will be translated to NULL.
     * @param string whereClause the optional WHERE clause to apply when updating. Passing null will update all rows.
     * @param array whereArgs You may include ?s in the where clause, which will be replaced by the values from whereArgs. The values will be bound as Strings.
     * @return the number of rows affected, or -1 if an error occurred
     */
    public function updateOrThrow($table, ContentValues $values, $whereClause, array $whereArgs) {
      $res = $this->_update($table, $values, $whereClause, $whereArgs);
      $this->checkPDOError($res['statement']);
      return $res['result'];
    }

    /**
     * vnitrni delete metoda
     *
     * @since 2.44
     * @param string table nazev tabulky
     * @param string whereClause podminka pro upravu
     * @param array whereArg pole hodnot pro podminku
     * @return array pole s vysledkama
     */
    private function _delete($table, $whereClause, array $whereArgs) {
      $sql = 'DELETE FROM ' . $table . ' WHERE ' . $whereClause;
      $stpdo = $this->pdo->prepare($sql);
      return array('result' => ($stpdo->execute($whereArgs) ? intval($stpdo->rowCount()) : -1),
                    'statement' => $stpdo);
    }

    /**
     * Convenience method for deleting rows in the database.
     * - #public int delete (String table, String whereClause, String[] whereArgs)
     *
     * @since 2.00
     * @param string table the table to delete from
     * @param string whereClause the optional WHERE clause to apply when deleting. Passing null will delete all rows.
     * @param array whereArgs
     * @return int the number of rows affected if a whereClause is passed in, 0 otherwise. To remove all rows and get a count pass "1" as the whereClause.
     */
    public function delete($table, $whereClause, array $whereArgs) {
      $res = $this->_delete($table, $whereClause, $whereArgs);
      $code = $res['statement']->errorCode();
      if ($code != 23000) { // vyjimka na error
        $this->checkPDOError($res['statement']);
      } else {
        $this->error = $res['statement']->errorInfo();
      }
      return $res['result'];
    }

    /**
     * Convenience method for deleting rows in the database, with throw
     * - #public int deleteWithOnConflict (String table, ContentValues values, String whereClause, String[] whereArgs, int conflictAlgorithm)
     *
     * @since 2.44
     * @param string table the table to delete from
     * @param string whereClause the optional WHERE clause to apply when deleting. Passing null will delete all rows.
     * @param array whereArgs
     * @return int the number of rows affected if a whereClause is passed in, 0 otherwise. To remove all rows and get a count pass "1" as the whereClause.
     */
    public function deleteOrThrow($table, $whereClause, array $whereArgs) {
      $res = $this->_delete($table, $whereClause, $whereArgs);
      $this->checkPDOError($res['statement']);
      return $res['result'];
    }

    /**
     * provede sql truncate, spolehlivejsi nez delete
     * - automaticky vypina FK zavislosti
     *
     * @since 2.00
     * @param string table nazev tabulky
     * @param bool disable_fk true pro vypinani FK zavislosti, false pro normali chod se zavislostma
     * @return bool true pokud se povedlo
     */
    public function truncate($table, $disable_fk = true) {
      if ($disable_fk) {
        $this->execSQL('SET FOREIGN_KEY_CHECKS = 0'); // deaktivace kontroly fk, MySQL!!
      }
      $sql = 'TRUNCATE ' . $table;
      $stpdo = $this->pdo->prepare($sql);
      $result = $stpdo->execute();
      $this->checkPDOError($stpdo);
      if ($disable_fk) {
        $this->execSQL('SET FOREIGN_KEY_CHECKS = 1'); // aktivace kontroly fk
      }
      return $result;
    }

    /**
     * Query the given table, returning a Cursor over the result set.
     * - #public Cursor query (String table, String[] columns, String selection, String[] selectionArgs, String groupBy, String having, String orderBy, String limit)
     * - columns: null=*, array=implode(,), string=string
     *
     * @since 2.02
     * @param string table The table name to compile the query against.
     * @param array|string|null columns A list of which columns to return. Passing null will return all columns, which is discouraged to prevent reading data from storage that isn't going to be used.
     * @param string selection A filter declaring which rows to return, formatted as an SQL WHERE clause (excluding the WHERE itself). Passing null will return all rows for the given table.
     * @param array selectionArgs You may include ?s in selection, which will be replaced by the values from selectionArgs, in order that they appear in the selection. The values will be bound as St
     * @param string groupBy A filter declaring how to group rows, formatted as an SQL GROUP BY clause (excluding the GROUP BY itself). Passing null will cause the rows to not be grouped.
     * @param string having A filter declare which row groups to include in the cursor, if row grouping is being used, formatted as an SQL HAVING clause (excluding the HAVING itself). Passing null will cause all row groups to be included, and is required when row grouping is not being used.
     * @param string orderBy How to order the rows, formatted as an SQL ORDER BY clause (excluding the ORDER BY itself). Passing null will use the default sort order, which may be unordered.
     * @param string limit Limits the number of rows returned by the query, formatted as LIMIT clause. Passing null denotes no LIMIT clause.
     * @return PDOCursor A Cursor object, which is positioned before the first entry. Note that Cursors are not synchronized, see the documentation for more details.
     */
    public function query($table, $columns = null, $selection = null, $selectionArgs = array(), $groupBy = null, $having = null, $orderBy = null, $limit = null) {
      $sql = sprintf('SELECT %s FROM %s%s%s%s%s%s;', ($columns ? (is_array($columns) ? implode(', ', $columns) : $columns) : '*'), $table,
                    (!is_null($selection) ? sprintf(' WHERE %s', $selection) : ''),
                    (!is_null($groupBy) ? sprintf(' GROUP BY %s', $groupBy) : ''),
                    (!is_null($having) ? sprintf(' HAVING %s', $having) : ''),
                    (!is_null($orderBy) ? sprintf(' ORDER BY %s', $orderBy) : ''),
                    (!is_null($limit) ? sprintf(' LIMIT %s', $limit) : ''));
      $statement = $this->pdo->prepare($sql);
      if ($statement->execute($selectionArgs)) {
        return $statement;
      } else {
        $this->checkPDOError($statement);
      }
    }

    /**
     * Runs the provided SQL and returns a Cursor over the result set.
     * - #public Cursor rawQuery (String sql, String[] selectionArgs)
     *
     * @since 2.02
     * @param string sql the SQL query. The SQL string must not be ; terminated
     * @param array selectionArgs You may include ?s in where clause in the query, which will be replaced by the values from selectionArgs. The values will be bound as Strings.
     * @return PDOCursor A Cursor object, which is positioned before the first entry. Note that Cursors are not synchronized, see the documentation for more details.
     */
    public function rawQuery($sql, array $selectionArgs = array()) {
      $statement = $this->pdo->prepare($sql);
      if ($statement->execute($selectionArgs)) {
        return $statement;
      } else {
        $this->checkPDOError($statement);
      }
    }

    /**
     * Execute a single SQL statement that is NOT a SELECT or any other SQL statement that returns data.
     * - #public void execSQL (String sql)
     *
     * @since 2.00
     * @param string sql the SQL statement to be executed. Multiple statements separated by semicolons are not supported.
     * @param array param pole hodnot na substituci; (%d,%s...) tak array('v1', 'v2')
     * @return int pocet pozmenenych radku
     */
    public function execSQL($sql, $param = array()) {
      $result = $this->pdo->exec(isset($param) && is_array($param) ? vsprintf($sql, $param) : $sql);
      $this->checkPDOError();
      return $result;
    }

    /**
     * get available pdo drives
     *
     * @since 2.00
     * @param void
     * @return array list array pdo drivers
     */
    public static function getAvailableDrivers() {
      return \PDO::getAvailableDrivers();
    }

    /**
     * get current pdo driver name
     *
     * @since 2.00
     * @param void
     * @return string current driver
     */
    public function getDriverName() {
      return $this->pdo->getAttribute(\PDO::ATTR_DRIVER_NAME);
    }

    /**
     * zjistluje jestli jde o mysql
     *
     * @since 2.00
     * @param void
     * @return bool true pokud je driver mysql
     */
    public function isMySQL() {
      return ($this->getDriverName() == 'mysql');
    }

    /**
     * zjistuje jestli jde o sqlite3
     *
     * @since 2.00
     * @param void
     * @return bool true pokud je driver sqlite3
     */
    public function isSQLite() {
      return ($this->getDriverName() == 'sqlite');
    }

    /**
     * zjisti jestli jde o OCI8
     * //TODO pripojeni do OCI8 neni otestovano!!!!
     *
     * @since 2.00
     * @param void
     * @return bool true pokud je driver oci8
     */
    public function isOCI8() {
      return ($this->getDriverName() == 'oci');
    }

    /**
     * Retrieve a database connection attribute
     *
     * @since 2.00
     * @param int attribute One of the PDO::ATTR_* constants.
     * @return mixed A successful call returns the value of the requested PDO attribute. An unsuccessful call returns null.
     */
    public function getAttribute($attribute) {
      return $this->pdo->getAttribute($attribute);
    }

    /**
     * Set an attribute
     *
     * @since 2.00
     * @param int attribute Sets an attribute on the database handle.
     * @param mixed value attribude new value
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function setAttribute($attribute, $value) {
      return $this->pdo->setAttribute($attribute, $value);
    }
  }



  /**
   * ContentValues, trida starajici se o vstupni data do insert, update a delete
   * - zalozeno na: http://developer.android.com/reference/android/content/ContentValues.html
   *
   * @package stable/pdo
   * @author geniv
   * @version 2.14
   */
  final class ContentValues {

    private $content = null;

    /**
     * Creates an empty set of values using the default initial size
     * Creates a set of values copied from the given set
     * - #public ContentValues ()
     * - #public ContentValues (ContentValues from)
     *
     * @since 2.00
     * @param null|array|ContentValues from the values to copy
     */
    public function __construct($from = null) {
      $this->content = array();

      // pokud se vklada instance ContentValues
      if ($from instanceof self) {
        $content = $from->_getContent();
        $this->content = $content['content'];
      }

      // pokud se vklada pole
      if (is_array($from)) {
        $this->content = $from;
      }
    }

    /**
     * tovarni konstruktor pro tpl
     *
     * @since 2.04
     * @param null|array|ContentValues from the values to copy
     * @return ContentValues vytvorena instance
     */
    public static function init($from = null) {
      $c = new self($from);
      return $c;
    }

    /**
     * Removes all values.
     * - #public void clear ()
     *
     * @since 2.00
     * @param void
     * @return void
     */
    public function clear() {
      $this->content = null;
    }

    /**
     * Returns true if this object has the named value.
     * - #public boolean containsKey (String key)
     *
     * @since 2.00
     * @param string key the value to check for
     * @return bool true if the value is present, false otherwise
     */
    public function containsKey($key) {
      return array_key_exists($key, $this->content);
    }

    /**
     * Gets a value.
     * - #public Object get (String key)
     *
     * @since 2.00
     * @param string key the value to get
     * @return mixed the data for the value
     */
    public function get($key) {
      return ($this->containsKey($key) ? $this->content[$key] : null);
    }

    /**
     * Gets a value and converts it to a Boolean.
     * - #public Boolean getAsBoolean (String key)
     *
     * @since 2.00
     * @param string key the value to get
     * @return bool the Boolean value, or null if the value is missing or cannot be converted
     */
    public function getAsBoolean($key) {
      return (bool) $this->content[$key];
    }

    /**
     * Gets a value and converts it to a Float.
     * - #public Float getAsFloat (String key)
     *
     * @since 2.00
     * @param string key the value to get
     * @return float the Float value, or null if the value is missing or cannot be converted
     */
    public function getAsFloat($key) {
      return floatval($this->content[$key]);
    }

    /**
     * Gets a value and converts it to an Integer.
     * - #public Integer getAsInteger (String key)
     *
     * @since 2.00
     * @param string key the value to get
     * @return int the Integer value, or null if the value is missing or cannot be converted
     */
    public function getAsInteger($key) {
      return intval($this->content[$key]);
    }

    /**
     * Gets a value and converts it to a String.
     * - #public String getAsString (String key)
     *
     * @since 2.00
     * @param string key the value to get
     * @return string the String for the value
     */
    public function getAsString($key) {
      return strval($this->content[$key]);
    }

    /**
     * Adds a value to the set.
     * - #public void put (String key, String value)
     *
     * @since 2.00
     * @param string|array key the name of the value to put or array(key=>value,)
     * @param mixed|null value the data for the value to put
     * @return this
     */
    public function put($key, $value = null) {
      if (is_array($key) && is_null($value)) {
        $this->content += $key;
      } else {
        $this->content[$key] = $value;
      }
      return $this;
    }

    /**
     * Adds all values from the passed in ContentValues.
     * - #public void putAll (ContentValues other)
     *
     * @since 2.00
     * @param ContentValues other the ContentValues from which to copy
     * @return this
     */
    public function putAll(ContentValues $other) {
      $content = $other->_getContent();
      $this->content = array_merge($this->content, $content['content']);
      return $this;
    }

    /**
     * Adds a null value to the set.
     * - #public void putNull (String key)
     *
     * @since 2.00
     * @param string key the name of the value to make null
     * @return this
     */
    public function putNull($key) {
      $this->content[$key] = null;
      return $this;
    }

    /**
     * pridani bool polozky
     *
     * @since 2.06
     * @param string key klic hodnoty
     * @param bool value hodnota vnitrne konvertovana na bool
     * @return this
     */
    public function putBool($key, $value = false) {
      return $this->put($key, (bool) $value);
    }

    /**
     * pridavani polozky pokud neni NULL
     *
     * @since 1.00
     * @param string key klic hodnoty
     * @param mixed value hodnota polozky, vlozi jen kdyz neni NULL
     * @return this
     */
    public function putIsset($key, $value) {
      if ($value) {
        $this->put($key, $value);
      }
      return $this;
    }

    /**
     * prida date now polozku
     *
     * @since 2.00
     * @param string key klic hodnoty
     * @param string timestamp predavany cas, defaultne now
     * @param string format date format, defaultne Y-m-d H:i:s
     * @return this
     */
    public function putDate($key, $timestamp = 'now', $format = 'Y-m-d H:i:s') {
      $this->content[$key] = DateAndTime::from($timestamp)->format($format);
      return $this;
    }

    /**
     * Remove a single value.
     * - #public void remove (String key)
     *
     * @since 2.00
     * @param key the name of the value to remove
     * @return this
     */
    public function remove($key) {
      unset($this->content[$key]);
      return $this;
    }

    /**
     * Returns the number of values.
     * - #public int size ()
     *
     * @since 2.00
     * @param void
     * @return int the number of values
     */
    public function size() {
      return count($this->content);
    }

    /**
     * Returns a string containing a concise, human-readable description of this object.
     * - #public String toString ()
     *
     * @since 2.00
     * @param void
     * @return string a printable representation of this object.
     */
    public function __toString() {
      return print_r($this->content, true);
    }

    /**
     * systemova nacitani pole
     * - vraci samotny content
     * - vraci klice
     * - vraci hodnoty
     *
     * @since 2.00
     * @param void
     * @return array zpracovany obsah
     */
    public function _getContent() {
      return array('content' => $this->content,
                   'keys' => array_keys($this->content),
                   'values' => array_values($this->content),
                  );
    }

    /**
     * systemove nacitani klicu pole
     * - vraci extrahovane klice
     *
     * @since 2.12
     * @param void
     * @return array pole klicu
     */
    public function _getContentKeys() {
      return array_keys($this->content);
    }

    /**
     * systemove navitani hodnot pole
     * - vraci cely content
     *
     * @since 2.12
     * @param void
     * @return array pole hodnot
     */
    public function _getContentValues() {
      return $this->content;
    }
  }



  /**
   * PDOCursor, prace s navratovym cursorem dotazu
   * - zalozeno na: http://developer.android.com/reference/android/database/Cursor.html
   * - zalozeno na: http://developer.android.com/reference/android/database/AbstractCursor.html
   *
   * @package stable/pdo
   * @author geniv
   * @version 2.52
   */
  final class PDOCursor extends \PDOStatement {
    private $first_row = null;
    private $all_row = null;

    /**
     * defaultni konstruktor, pro potreby \PDOStatement
     * - nastavovani fetch modu na tridu PDOCursorData
     *
     * @since 2.00
     * @param void
     */
    private function __construct() {
      // nastaveni fetch modu
      parent::setFetchMode(\PDO::FETCH_CLASS, 'classes\PDOCursorData');
    }

    /**
     * interni nacteni jednoho radku
     *
     * @since 2.00
     * @param void
     * @return void
     */
    private function loadFirstRow() {
      if (!$this->first_row) {
        $this->first_row = parent::fetch();
      }
    }

    /**
     * interni nacteni vsech radku (zbylich pokud byl nacteny prvni radek)
     *
     * @since 2.10
     * @param void
     * @return void
     */
    private function loadAllRow() {
      if (!$this->all_row) {
        $this->all_row = parent::fetchAll();
      }
    }

    /**
     * Closes the Cursor, releasing all of its resources and making it completely invalid.
     * - #public abstract void close ()
     *
     * @since 2.00
     * @param void
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function close() {
      return $this->closeCursor();
    }

    /**
     * Return total number of columns
     * - #public abstract int getColumnCount ()
     * - pouzivat samostatne!!
     *
     * @since 2.00
     * @param void
     * @return int number of columns
     */
    public function getColumnCount() {
      $this->loadFirstRow();
      $row = ($this->first_row ?: $this->all_row[0]);
      return count((array) $row);
    }

    /**
     * Returns the zero-based index for the given column name, or -1 if the column doesn't exist.
     * - #public int getColumnIndex (String columnName)
     * - pouzivat samostatne!!
     *
     * @since 2.00
     * @param string columnName the name of the target column.
     * @return int the zero-based column index for the given column name, or -1 if the column name does not exist.
     */
    public function getColumnIndex($columnName) {
      $this->loadFirstRow();
      $row = ($this->first_row ?: $this->all_row[0]);
      $filter = array_flip(array_values(array_filter(array_keys((array) $row), function($r) { return is_string($r); })));
      return (array_key_exists($columnName, $filter) ? $filter[$columnName] : -1);
    }

    /**
     * Returns the zero-based index for the given column name, or throws PDOException if the column doesn't exist. If you're not sure if a column will exist or not use getColumnIndex(String) and check for -1, which is more efficient than catching the exceptions.
     * - #public int getColumnIndexOrThrow (String columnName)
     * - pouzivat samostatne!!
     *
     * @since 2.00
     * @param string columnName the name of the target column.
     * @return int the zero-based column index for the given column name
     */
    public function getColumnIndexOrThrow($columnName) {
      $res = $this->getColumnIndex($columnName);
      if ($res < 0) {
        throw new \PDOException('column does not exist');
      }
      return $res;
    }

    /**
     * Returns the column name at the given zero-based column index.
     * - #public String getColumnName (int columnIndex)
     * - pouzivat samostatne!!
     *
     * @since 2.00
     * @param int columnIndex the zero-based index of the target column.
     * @return string the column name for the given column index.
     */
    public function getColumnName($columnIndex) {
      $this->loadFirstRow();
      $row = ($this->first_row ?: $this->all_row[0]);
      $filter = array_values(array_filter(array_keys((array) $row), function($r) { return is_string($r); }));
      return (array_key_exists($columnIndex, $filter) ? $filter[$columnIndex] : '');
    }

    /**
     * Returns a string array holding the names of all of the columns in the result set in the order in which they were listed in the result.
     * - #public abstract String[] getColumnNames ()
     * - pouzivat samostatne!!
     *
     * @since 2.00
     * @param void
     * @return array the names of the columns returned in this query.
     */
    public function getColumnNames() {
      $this->loadFirstRow();
      $row = ($this->first_row ?: $this->all_row[0]);
      return array_values(array_filter(array_keys((array) $row), function($r) { return is_string($r); }));
    }

    /**
     * Returns the numbers of rows in the cursor.
     * - #public abstract int getCount ()
     *
     * @since 2.00
     * @param void
     * @return int the number of rows in the cursor.
     */
    public function getCount() {
      $this->loadAllRow();  // akceptovani first_row kvuli presnemu poctu
      return count($this->all_row) + ($this->first_row ? 1 : 0);
    }

    /**
     * alias pro getCount(), kvuli TPL neni zavedeno rozhranni \Countable!
     *
     * @since 2.00
     * @param void
     * @return int the number of rows in the cursor.
     */
    public function count() {
      return $this->getCount();
    }

    /**
     * nacteni prvni polozky
     * - ekvivalent k moveToFirst + vyber
     *
     * @since 2.30
     * @param void
     * @return PDOCursorData pro prvni radek
     */
    public function getFirst() {
      $this->loadFirstRow();
      $row = ($this->first_row ?: $this->all_row[0]);
      return $row;
    }

    /**
     * alias k metoda getFirst
     *
     * @since 2.50
     * @param void
     * @return PDOCursorData pro prvni radek
     */
    public function getRow() {
      return $this->getFirst();
    }

    /**
     * nacteni vsech polozek
     * - vyber vsech polozek
     *
     * @since 2.30
     * @param void
     * @return array pole instanci PDOCursorData polozek
     */
    public function getAll() {
      return $this->sumRow();
    }

    /**
     * nacteni vsech polozek, ktere zatim nebyli vyiterovany
     * - urceno pro jednoucelovy vypis jednoho sloupce
     *
     * @since 2.48
     * @param mixed fetch_style styl fetch vystupu, defaultne FETCH_COLUMN
     * @param mixed fetch_argument druhy argument, pro FETCH_COLUMN je tento parametr indexu ktery se ma pouzit jako jedina polozka v hodnote
     * @return array pole polozek
     */
    public function getAllRows($fetch_style = \PDO::FETCH_COLUMN, $fetch_argument = null) {
      return parent::fetchAll($fetch_style, $fetch_argument);
    }

    /**
     * nacitani instance iteratoru IteratorIterator
     * - pokud jiz byla nactena polozka z db tak donacte zbytek
     * - univerzalni iterator
     * - iteruje postupne, pokud byla nactena polozka iteruje z pole
     *
     * @since 2.18
     * @return \IteratorIterator instance iteratoru
     */
    public function getIterator() {
      $iterate = $this;
      if ($this->first_row || $this->all_row) { // pokud jiz bylo iterovano
        $iterate = new \ArrayIterator($this->sumRow()); // Array -> Traversable
      }
      return new \IteratorIterator($iterate);
    }

    /**
     * nacitani iteratoru podle jazyka Java
     * - provadi vnitrne fetch()
     * - iteruje pouze postupne
     *
     * @since 2.38
     * @param void
     * @return __Iterator instance iteratoru
     */
    public function getJavaIterator() {
      return new __JavaIterator($this);
    }

    /**
     * soucet poli first a all
     *
     * @since 2.30
     * @param void
     * @return array sectene pole
     */
    private function sumRow() {
      $result = array();
      // vlozeni prvni polozky (pokud byla pouzity)
      if ($this->first_row) {
        $result[] = $this->first_row;
      }
      // nacteni vsech polozek
      if (!$this->all_row) {
        $this->loadAllRow();
      }
      return array_merge($result, $this->all_row);
    }

    /**
     * nacitani posouvaciho iteratoru
     * - umoznuje praci s metodama move***()
     *
     * @since 2.28
     * @param void
     * @return PDOCursorMoveIterator posouvaci iterator
     */
    public function getMoveIterator() {
      return new __MoveIterator($this->sumRow());
    }
  }



  /**
   * Trida obsluhujici iterator radku
   * - po vzoru iteratoru z javy: http://docs.oracle.com/javase/6/docs/api/java/util/Iterator.html
   *
   * @package stable/pdo
   * @author geniv
   * @version 1.08
   */
  final class __JavaIterator {
    private $cursor = null; // predana instance z PDOCursor
    private $fetch = null;  // aktualni polozky

    /**
     * defaultni konstruktor
     *
     * @since 1.00
     * @param mixed cursor instance predana z PDOCursor
     */
    public function __construct($cursor) {
      $this->cursor = $cursor;
    }

    /**
     * existuje dalsi polozka?
     *
     * @since 1.02
     * @param void
     * @return bool true pokud polozka existuje
     */
    public function hasNext() {
      $this->fetch = $this->cursor->fetch();
      return (bool) $this->fetch;
    }

    /**
     * nacitani obsahu polozky
     *
     * @since 1.02
     * @param void
     * @return mixed nactena polozka
     */
    public function next() {
      return $this->fetch;
    }
  }



  /**
   * Trida umoznujici posouvat iterator podle potreby
   * - zalozeno na: http://developer.android.com/reference/android/database/Cursor.html
   *
   * @package stable/pdo
   * @author geniv
   * @version 1.32
   */
  final class __MoveIterator implements \ArrayAccess {
    private $data = null;
    private $index = 0;
    private $count = 0;

    /**
     * defaultni konstruktor
     *
     * @since 1.00
     * @param array data vsechny polozky z databaze
     */
    public function __construct($data) {
      $this->data = $data;
      $this->count = count($data);
    }

    /**
     * nacte pocet polozek v iteratoru
     *
     * @since 1.30
     * @param void
     * @return int pocet polozek
     */
    public function count() {
      return $this->count;
    }

    /**
     * Returns whether the cursor is pointing to the position after the last row.
     * - #public abstract boolean isAfterLast ()
     *
     * @since 1.00
     * @param void
     * @return bool whether the cursor is after the last result.
     */
    public function isAfterLast() {
      return ($this->index === ($this->count - 2));
    }

    /**
     * Returns whether the cursor is pointing to the position before the first row.
     * - #public abstract boolean isBeforeFirst ()
     *
     * @since 1.00
     * @param void
     * @return bool whether the cursor is before the first result.
     */
    public function isBeforeFirst() {
      return ($this->index === 1);
    }

    /**
     * Returns whether the cursor is pointing to the first row.
     * - #public final boolean isFirst ()
     *
     * @since 1.00
     * @param void
     * @return bool whether the cursor is pointing at the first entry.
     */
    public function isFirst() {
      return ($this->index === 0);
    }

    /**
     * Returns whether the cursor is pointing to the last row.
     * - #public final boolean isLast ()
     *
     * @since 1.00
     * @param void
     * @return bool whether the cursor is pointing at the last entry.
     */
    public function isLast() {
      return ($this->index === ($this->count - 1));
    }

    /**
     * Move the cursor to the first row.
     * - #public abstract boolean moveToFirst ()
     *
     * @since 1.00
     * @param void
     * @return bool whether the move succeeded.
     */
    public function moveToFirst() {
       $this->index = 0;
       return true;
    }

    /**
     * Move the cursor to the last row.
     * - #public abstract boolean moveToLast ()
     *
     * @since 1.00
     * @param void
     * @return bool whether the move succeeded.
     */
    public function moveToLast() {
      $this->index = ($this->count - 1);
      return true;
    }

    /**
     * Move the cursor to the next row.
     * - #public final boolean moveToNext ()
     *
     * @since 1.00
     * @param void
     * @return bool whether the move succeeded.
     */
    public function moveToNext() {
      if ($this->count > ($this->index + 1)) {
        $this->index++;
        return true;
      }
      return false;
    }

    /**
     * Move the cursor to the previous row.
     * - #public abstract boolean moveToPrevious ()
     *
     * @since 1.00
     * @param void
     * @return bool whether the move succeeded.
     */
    public function moveToPrevious() {
      if (0 <= ($this->index - 1)) {
        $this->index--;
        return true;
      }
      return false;
    }

    /**
     * Returns the current position of the cursor in the row set.
     * - #public final int getPosition ()
     *
     * @since 1.00
     * @param void
     * @return int the current cursor position.
     */
    public function getPosition() {
      return $this->index;
    }

    /**
     * Move the cursor by a relative amount, forward or backward, from the current position.
     * Positive offsets move forwards, negative offsets move backwards.
     * - #public abstract boolean move (int offset)
     *
     * @since 1.00
     * @param int offset the offset to be applied from the current position.
     * @return bool whether the requested move fully succeeded.
     */
    public function move($offset) {
      $new = $this->index + $offset;
      if ($new >= 0 && $new < $this->count) {
        $this->index = $new;
        return true;
      }
      return false;
    }

    /**
     * Move the cursor to an absolute position. The valid range of values is -1 <= position <= count.
     * This method will return true if the request destination was reachable, otherwise, it returns false.
     * - #public abstract boolean moveToPosition (int position)
     *
     * @since 1.00
     * @param int position the zero-based position to move to.
     * @return bool whether the requested move fully succeeded.
     */
    public function moveToPosition($position) {
      if ($position >= 0 && $position < $this->count) {
        $this->index = $position;
        return true;
      }
      return false;
    }

    /**
     * nacitani instance polozky
     *
     * @since 1.12
     * @param void
     * @return PDOCursorData instance aktualni polozky
     */
    public function get() {
      return $this->data[$this->index];
    }

    /*
     * magicke metody
     */

    /**
     * nacitani hodnoty polozky
     *
     * @since 1.00
     * @param string name jmeno indexu
     * @return mixed hodnota indexu
     */
    public function __get($name) {
      return $this->data[$this->index]->$name;
    }

    /**
     * existuje polozka?
     *
     * @since 1.00
     * @param string name jmeno indexu
     * @return bool true pokud index existuje
     */
    public function __isset($name) {
      return (isset($this->data[$this->index]->$name));
    }

    // __set(), __unset() zamerne neimplementovano, neni zapotreby!

    /*
     * \ArrayAccess
     */

    /**
     * existuje polozky pole?
     *
     * @since 1.00
     * @param string offset nazev indexu
     * @return bool true pokud index existuje
     */
    public function offsetExists($offset) {
      return (isset($this->data[$this->index]->$offset));
    }

    /**
     * nacitani hodnoty polozky
     * - akceptuje numericke a textove indexy
     *
     * @since 1.00
     * @param string|int offset nazev nebo cislo indexu
     * @return mixed hodnota na indexu
     */
    public function offsetGet($offset) {
      if (is_numeric($offset)) {
        $pole = array_values((array) $this->data[$this->index]);
        return $pole[$offset];
      } else {
        return $this->data[$this->index]->$offset;
      }
    }

    // zamerne neimplementovano, neni zapotreby!
    public function offsetSet($offset, $value) {}
    public function offsetUnset($offset) {}
  }



  /**
   * Instance starajici se o vystupni data z PDOCursor
   *
   * @package stable/pdo
   * @author geniv
   * @version 1.26
   */
  final class PDOCursorData implements \ArrayAccess, \Countable {

    /*
     * \ArrayAccess
     */

    /**
     * overovani existence polozky pres index pole
     *
     * @since 1.02
     * @param string offset nazev indexu
     * @return bool true pokud polozka existuje
     */
    public function offsetExists($offset) {
      $v = $this->__getValue($offset);
      return isset($v);
    }

    /**
     * nacitani hodnoty polozky pres index pole
     *
     * @since 1.02
     * @param string|int offset nazev nebo cislo indexu
     * @return mixed hodnota polozky
     */
    public function offsetGet($offset) {
      return $this->__getValue($offset);
    }

    /**
     * nastavovani hodnoty polozky pres index pole
     *
     * @since 1.02
     * @param string offset nazev indexu
     * @param mixed value hodnota polozky
     * @return void
     */
    public function offsetSet($offset, $value) {
      $this->$offset = $value;
    }

    /**
     * mazani hodnoty polozky pres index pole
     *
     * @since 1.02
     * @param string offset nazev indexu
     * @return void
     */
    public function offsetUnset($offset) {
      unset($this->$offset);
    }

    /*
     * Magic function
     */

    /**
     * overovani existence polozky pres objekt
     *
     * @since 1.04
     * @param string name nazev indexu
     * @return bool true pokud existuje index
     */
    public function __isset($name) {
      return (isset($this->$name));
    }

    /**
     * nacitani hodnoty polozky pres objekt
     *
     * @since 1.04
     * @param string name nazev indexu
     * @return mixed hodnota polozky
     */
    public function __get($name) {
      return (isset($this->$name) ? $this->$name : null);
    }

    /**
     * nastavovani hodnoty polozky pres objekt
     *
     * @since 1.06
     * @param string name nazev indexu
     * @param mixed value hodnota polozky
     * @return void
     */
    public function __set($name, $value) {
      $this->$name = $value;
    }

    /*
     * \Countable
     */

    /**
     * nacteni poctu polozek pri implementaci \Countable
     *
     * @since 1.08
     * @param void
     * @return int pocet polozek v radku
     */
    public function count() {
      return count((array) $this);
    }

    /*
     * Android Cursor
     */

     /**
      * nacitani hodnoty polozky objektovym nebo indexovym pristupem
      *
      * @since 1.18
      * @param string|int index textovy nebo ciselny index
      * @return mixed hodnota polozky na konkternim indexu
      */
    private function __getValue($index) {
      if (is_numeric($index)) {
        $pole = array_values((array) $this);
        return (isset($pole[$index]) ? $pole[$index] : null);
      } else {
        return (isset($this->$index) ? $this->$index : null);
      }
    }

    /**
     * Returns the value of the requested column as a String.
     * - #public abstract String getString (int column)
     *
     * @since 1.10
     * @param string columnIndex the zero-based index of the target column.
     * @return string the value of that column as a String.
     */
    public function getString($columnIndex) {
      return strval($this->__getValue($columnIndex));
    }

    /**
     * Returns data type of the given column's value.
     * - #public int getType (int column)
     *
     * @since 1.10
     * @param string columnIndex the zero-based index of the target column.
     * @return string column value type
     */
    public function getType($columnIndex) {
      return gettype($this->__getValue($columnIndex));
    }

    /**
     * Returns the value of the requested column as a boolean.
     *
     * @since 1.10
     * @param string columnIndex the zero-based index of the target column.
     * @return bool the value of that column as a float.
     */
    public function getBool($columnIndex) {
      return (bool) $this->__getValue($columnIndex);
    }

    /**
     * Returns the value of the requested column as a float.
     * - #public abstract float getFloat (int column)
     *
     * @since 1.10
     * @param string columnIndex the zero-based index of the target column.
     * @return float the value of that column as a float.
     */
    public function getFloat($columnIndex) {
      return floatval($this->__getValue($columnIndex));
    }

    /**
     * Returns the value of the requested column as an int.
     * - #public abstract int getInt (int column)
     *
     * @since 1.10
     * @param string columnIndex the zero-based index of the target column.
     * @return int the value of that column as an int.
     */
    public function getInt($columnIndex) {
      return intval($this->__getValue($columnIndex));
    }

    /**
     * Returns true if the value in the indicated column is null.
     * - #public abstract boolean isNull (int column)
     *
     * @since 1.00
     * @param string columnIndex the zero-based index of the target column.
     * @return bool whether the column value is null.
     */
    public function isNull($columnIndex) {
      return is_null($this->__getValue($columnIndex));
    }

    /**
     * magicka metoda pro vypis do textu bez ->|[] argumentu
     *
     * @since 1.24
     * @param void
     * @return string prvni polozka pole
     */
    public function __toString() {
      return $this[0];
    }
  }