<?php
/*
 * pdohelper.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      PDO,
      PDOException;

  /**
   *
   * PDOOpenHelper
   *
   * pozn: tvorba integritnich omezeni (mysql: innodb) a budovani podminek uz na
   * urovni databaze je jen kvuli tomu pokud se apliakce uvazuje nad ruznyma
   * zpusobama pristupu tj webowe rozhrani nebo desktop aplikace, aby programator
   * nemusel v kazde aplikaci resit ty same podminky ktere se prave resi obvykle
   * primo v aplikaci.
   */
  class PDOHelper {
    const VERSION = 2.06;

    const SQLITE_MEMORY = ':memory:';
    const MIN_PHP = '5.3.6';  //pro MySQL

    protected $helper = null;

    /**
     * Create a helper object to create, open, and/or manage a database.
     *
     * @param dbname of the database file or host mysql database or null for an in-memory database
     */
    public function __construct($dbname, array $options = array()) {
      $this->helper = new stdClass;

      $this->helper->db = null; //handler pripojeni databaze
      $this->helper->sqlitePath = null; //celkova cesta sqlite
      $this->helper->param = array(); //pridavne parametry

      //prefixy resit pouze v odvozene tride!!!!

      $param = array('dbname' => ($dbname ?: null),
                    'charset' => 'utf8',
                    'path' => null,
                    );

      $this->helper->param = array_merge($param, $options);
    }

    /**
     * Called when the database is created for the first time. This is where the creation of tables and the initial population of the tables should happen.
     * public abstract void onCreate (SQLiteDatabase db)
     * overlay on inheritance class
     *
     * @param db The database.
     */
    public function onCreate(PDODatabase $db) {}

    /**
     * Close any open database object.
     * public synchronized void close ()
     */
    public function close() {
      $this->helper->db = null;
    }

    /**
     * univerzalni pripojovac pro sqliteX databaze
     *
     * @param type typ sqlite databaze
     * @param dbpath volitelny path pro databazi
     * @return this
     */
    public function _SQLiteX($type, $dbpath = null) {
      if (!empty($this->helper->param['dbname'])) { //neprazdne jmeno
        if (!empty($dbpath)) {
          $path = $dbpath.'/'.$this->helper->param['dbname'];
        } else
        if (!empty($this->helper->param['path'])) { //neprazdna cesta
          $path = $this->helper->param['path'].'/'.$this->helper->param['dbname'];
        } else {
          $path = $this->helper->param['dbname'];
        }
      } else {  //prazdne jmeno
        $path = self::SQLITE_MEMORY;
      }

      $this->helper->sqlitePath = $path;  //ulozeni sqlite path

      if (in_array($type, PDO::getAvailableDrivers())) {
        $this->helper->db = new PDODatabase(sprintf('%s:%s', $type, $path));
      } else {
        throw new PDOException('could not find driver');
      }
      return $this;
    }

    /**
     * SQLite2 PDO connector
     * doporucuji pouze cteni!
     * v PHP 5.3.x sqlite2 jiz nefunguje!!
     *
     * @param path database path
     * @return this helper
     */
    public function SQLite2($dbpath = null) {
      return $this->_SQLiteX('sqlite2', $dbpath);
    }

    /**
     * SQLite3 PDO connector
     *
     * @param path database path
     * @return this helper
     */
    public function SQLite3($dbpath = null) {
      return $this->_SQLiteX('sqlite', $dbpath);
    }

    /**
     * vrati cestu sqliteX databaze
     *
     * @return sqlite path
     */
    public function getSQLitePath() {
      return $this->helper->sqlitePath;
    }

    /**
     * zpracovani promennych predanych pres array host
     *
     * @param host hostname
     * @param username username do databaze
     * @param password password do databaze
     * @param port port k databazi
     * @param options pdo options
     */
    protected function processHost(&$host, &$username, &$password, &$port, &$options) {
      if (is_array($host)) {
        extract($host); //predani promenych do php
      } else {
        if (!isset($username)) {  // osetreni username
          throw new PDOException('username is not defined!');
        }

        if (!isset($password)) {  // osetreni password
          throw new PDOException('password is not defined!');
        }
      }
    }

    /**
     * MySQL PDO connector
     *
     * @param host database host|array: array('host', 'username', 'password'[, 'port', 'options'])
     * @param username database user
     * @param password database password
     * @param port database port
     * @param options PDO option array
     * @return this helper
     */
    public function MySQL($host, $username = null, $password = null, $port = null, $options = null) {
      if (version_compare(PHP_VERSION, self::MIN_PHP, '>=')) {
        $this->processHost($host, $username, $password, $port, $options);
        $port = ($port ?: 3306);
        $uri = sprintf('mysql:host=%s;dbname=%s;port=%s;charset=%s',
                $host, $this->helper->param['dbname'], $port, $this->helper->param['charset']);
        $this->helper->db = new PDODatabase($uri, $username, $password, $options);
      } else {
        throw new PDOException('Minimum php version for using charset is: '.self::MIN_PHP);
      }
      return $this;
    }

    /**
     * Oracle OCI8 PDO connector
     *
     * @param host database host|array: array('host', 'username', 'password'[, 'port', 'options'])
     * @param username database user
     * @param password database password
     * @param port database port
     * @param options PDO option array
     * @return this helper
     */
    public function Oci8($host, $username = null, $password = null, $port = null, $options = null) {
      $this->processHost($host, $username, $password, $port, $options);
      $port = ($port ?: 1521);
      $uri = sprintf('oci:dbname=%s;port=%s;charset=%s', $host, $port, $this->helper->param['charset']);
      $this->helper->db = new PDODatabase($uri, $username, $password, $options);
      return $this;
    }

    /**
     * Create and/or open a database.
     * public SQLiteDatabase getReadableDatabase ()
     * public SQLiteDatabase getWritableDatabase ()
     * defaultne nevytvari tabulky
     *
     * @return a database object valid until close() is called.
     */
    public function getDatabase($autocreate = false) {
      $result = null;
      //overeni jestli existuje vlastnost db
      if (property_exists($this->helper, 'db')) {
        if ($autocreate) {  //pokud je zapnute autovytvareni tabulek (u potomka tridy?)
          static::onCreate($this->helper->db);  //volani onCreate u potomka
        }
        $result = $this->helper->db;
      } else {
        throw new PDOException('Unable to connect to database.');
      }
      return $result;
    }

    /**
     * Return the name of the SQLite database being opened, as given to the constructor.
     * public String getDatabaseName ()
     *
     * @return Return the name of database
     */
    public function getDatabaseName() {
      return $this->helper->param['dbname'];
    }

    /**
     * Set new database name
     *
     * @param dbname new database name
     * @return this helper
     */
    public function setDatabaseName($dbname) {
      if (!empty($dbname)) {
        $this->helper->param['dbname'] = $dbname;
      }
      return $this;
    }

    /**
     * vrati nastaveny db path
     *
     * @return database path
     */
    public function getDatabasePath() {
      return $this->helper->param['path'];
    }

    /**
     * nastavi novy db path
     *
     * @param path nova cesta
     * @return this
     */
    public function setDatabasePath($path) {
      if (!empty($path)) {
        $this->helper->param['path'] = $path;
      }
      return $this;
    }

    /**
     * smaze SQLiteX databazi
     *
     * @return true pokud bylo uspesne smazano
     */
    public function deleteDatabase() {
      return @unlink($this->helper->sqlitePath);
    }

    /**
     * nacteni charsetu (defaultne: utf8)
     *
     * @return aktualni charset
     */
    public function getCharset() {
      return $this->helper->param['charset'];
    }

    /**
     * nastaveni charsetu
     *
     * @param charset novy charset
     * @return this
     */
    public function setCharset($charset) {
      if (!empty($charset)) {
        $this->helper->param['charset'] = $charset;
      }
      return $this;
    }
  }

  /**
   *
   * PDODatabase
   *
   */
  class PDODatabase {
    const VERSION = 1.80;

    private $pdo = null;  // PDO objekt
    private $error = null;  // text chyby

    /**
     * Construct for create PDO object
     *
     * @param uri PDO uri url
     * @param user database user
     * @param passwd datamase password
     * @param driver_options PDO options array
     */
    public function __construct($uri, $user = null, $passwd = null, $driver_options = null) {
      if (!empty($uri)) {
        $this->pdo = new PDO($uri, $user, $passwd, $driver_options);
        $this->checkPDOError();
      }
    }

    /**
     * Check error in PDO transaction
     *
     * @param statement input error from fetch statement, optional
     */
    private function checkPDOError($statement = null) {
      $e = (!is_null($statement) ? $statement->errorInfo() : $this->pdo->errorInfo());
      if (!is_null($e[1])) {
        throw new PDOException($e[2]);
      }
    }
//TODO zapracovat vic.. i na update a pod, s moznosti vypinat throw!
    /**
     * vrati text chyby, pokud dotaz teda naskonci s PDOException
     *
     * @return text chyby
     */
    public function getError() {
      return $this->error[2];
    }

    /**
     * vyskytla se nejaka chyba?
     *
     * @return true pokud se vyskytla chyba
     */
    public function isError() {
      return (isset($this->error));
    }

    /**
     * Initiates a transaction
     * Begins a transaction in EXCLUSIVE mode.
     * public void beginTransaction ()
     *
     * @return Returns TRUE on success or FALSE on failure.
     */
    public function beginTransaction() {
      return $this->pdo->beginTransaction();
    }

    /**
     * Commits a transaction
     * End a transaction.
     * public void endTransaction ()
     *
     * @return Returns TRUE on success or FALSE on failure.
     */
    public function endTransaction() {
      return $this->pdo->commit();
    }

    /**
     * Rolls back the current transaction
     *
     * @return Returns TRUE on success or FALSE on failure.
     */
    public function rollBack() {
      return $this->pdo->rollBack();
    }

    /**
     * Checks if inside a transaction
     * Returns true if the current thread has a transaction pending.
     * public boolean inTransaction ()
     *
     * @return Returns TRUE if a transaction is currently active, and FALSE if not.
     */
    public function inTransaction() {
      return (bool) $this->pdo->inTransaction();
    }

    /**
     * internal insert method
     */
    private function _insert($table, ContentValues $values) {
      $content = $values->_getContent();
      $sql = sprintf('INSERT INTO %s (%s) VALUES (%s);',
                    $table,
                    implode(', ', $content['keys']),
                    implode(', ', array_fill(0, count($content['keys']), '?')));
      $stpdo = $this->pdo->prepare($sql);
      return array('result' => ($stpdo->execute($content['values']) ? intval($this->pdo->lastInsertId()) : -1),
                   'statement' => $stpdo);
    }

    /**
     * Convenience method for inserting a row into the database.
     * public function insert(String table, String nullColumnHack, ContentValues values)
     *
     * @param table the table to insert the row into
     * @param values this map contains the initial column values for the row. The keys should be the column names and the values the column values
     * @return the row ID of the newly inserted row, or -1 if an error occurred
     */
    public function insert($table, ContentValues $values) {
      $result = '';
      $_res = $this->_insert($table, $values);

      $code = $_res['statement']->errorCode();
      if ($code != 23000) { //vyjimka na error kod duplicity
        $this->checkPDOError($_res['statement']);
      } else {
        $this->error = $_res['statement']->errorInfo();
      }
      return $_res['result'];
    }

    /**
     * Convenience method for inserting a row into the database.
     * public long insertOrThrow (String table, String nullColumnHack, ContentValues values)
     *
     * @param table the table to insert the row into
     * @param values this map contains the initial column values for the row. The keys should be the column names and the values the column values
     * @return the row ID of the newly inserted row, or -1 if an error occurred
     */
    public function insertOrThrow($table, ContentValues $values) {
      $_res = $this->_insert($table, $values);
      $result = $_res['result'];
      $this->checkPDOError($_res['statement']);
      return $result;
    }

    /**
     * Convenience method for updating rows in the database.
     * public int update (String table, ContentValues values, String whereClause, String[] whereArgs)
     *
     * @param table the table to update in
     * @param values a map from column names to new column values. null is a valid value that will be translated to NULL.
     * @param whereClause the optional WHERE clause to apply when updating. Passing null will update all rows.
     * @param whereArgs
     * @return the number of rows affected
     */
    public function update($table, ContentValues $values, $whereClause, array $whereArgs) {
      $result = '';
      $content = $values->_getContent();
      $dotfunc = function($pole) { return $pole.'=?'; };
      $sql = sprintf('UPDATE %s SET %s WHERE %s;', $table, implode(', ', array_map($dotfunc, $content['keys'])), $whereClause);
      $stpdo = $this->pdo->prepare($sql);
      $result = ($stpdo->execute(array_merge($content['values'], $whereArgs)) ? $stpdo->rowCount() : 0);
      $this->checkPDOError($stpdo);
      return $result;
    }

    /**
     * Convenience method for deleting rows in the database.
     * public int delete (String table, String whereClause, String[] whereArgs)
     *
     * @param table the table to delete from
     * @param whereClause the optional WHERE clause to apply when deleting. Passing null will delete all rows.
     * @return the number of rows affected if a whereClause is passed in, 0 otherwise. To remove all rows and get a count pass "1" as the whereClause.
     */
    public function delete($table, $whereClause, array $whereArgs) {
      $result = '';
      $sql = 'DELETE FROM '.$table.' WHERE '.$whereClause;
      $stpdo = $this->pdo->prepare($sql);
      $result = ($stpdo->execute($whereArgs) ? $stpdo->rowCount() : 0);
      $this->checkPDOError($stpdo);
      return $result;
    }

    /**
     * provede sql truncate, spolehlivejsi nez delete
     *
     * @param table nazev tabulky
     * @return true pokud se povedlo
     */
    public function truncate($table) {
      $this->execSQL('SET FOREIGN_KEY_CHECKS = 0'); // deaktivace kontroly fk, MySQL!!
      $sql = 'TRUNCATE '.$table;
      $stpdo = $this->pdo->prepare($sql);
      $result = $stpdo->execute();
      $this->checkPDOError($stpdo);
      $this->execSQL('SET FOREIGN_KEY_CHECKS = 1'); // aktivace kontroly fk
      return $result;
    }

    /**
     * Query the given table, returning a Cursor over the result set.
     * public Cursor query (String table, String[] columns, String selection, String[] selectionArgs, String groupBy, String having, String orderBy, String limit)
     *
     * @param table The table name to compile the query against.
     * @param columns A list of which columns to return. Passing null will return all columns, which is discouraged to prevent reading data from storage that isn't going to be used.
     * @param selection A filter declaring which rows to return, formatted as an SQL WHERE clause (excluding the WHERE itself). Passing null will return all rows for the given table.
     * @param selectionArgs You may include ?s in selection, which will be replaced by the values from selectionArgs, in order that they appear in the selection. The values will be bound as St
     * @param groupBy A filter declaring how to group rows, formatted as an SQL GROUP BY clause (excluding the GROUP BY itself). Passing null will cause the rows to not be grouped.
     * @param having A filter declare which row groups to include in the cursor, if row grouping is being used, formatted as an SQL HAVING clause (excluding the HAVING itself). Passing null will cause all row groups to be included, and is required when row grouping is not being used.
     * @param orderBy How to order the rows, formatted as an SQL ORDER BY clause (excluding the ORDER BY itself). Passing null will use the default sort order, which may be unordered.
     * @param limit Limits the number of rows returned by the query, formatted as LIMIT clause. Passing null denotes no LIMIT clause.
     * @return A Cursor object, which is positioned before the first entry. Note that Cursors are not synchronized, see the documentation for more details.
     */
    public function query($table, array $columns, $selection = null, $selectionArgs = array(), $groupBy = null, $having = null, $orderBy = null, $limit = null) {
      $result = null;
      $sql = sprintf('SELECT %s FROM %s%s%s%s%s%s;', implode(', ', $columns), $table,
                    (!is_null($selection) ? sprintf(' WHERE %s', $selection) : ''),
                    (!is_null($groupBy) ? sprintf(' GROUP BY %s', $groupBy) : ''),
                    (!is_null($having) ? sprintf(' HAVING %s', $having) : ''),
                    (!is_null($orderBy) ? sprintf(' ORDER BY %s', $orderBy) : ''),
                    (!is_null($limit) ? sprintf(' LIMIT %s', $limit) : ''));
      $statement = $this->pdo->prepare($sql);
      if ($statement->execute($selectionArgs)) {
        $result = new PDOCursor($statement);
      } else {
        $this->checkPDOError($statement);
      }
      return $result;
    }

    /**
     * Runs the provided SQL and returns a Cursor over the result set.
     * public Cursor rawQuery (String sql, String[] selectionArgs)
     *
     * @param sql the SQL query. The SQL string must not be ; terminated
     * @param selectionArgs You may include ?s in where clause in the query, which will be replaced by the values from selectionArgs. The values will be bound as Strings.
     * @return A Cursor object, which is positioned before the first entry. Note that Cursors are not synchronized, see the documentation for more details.
     */
    public function rawQuery($sql, array $selectionArgs = array()) {
      $result = null;
      $statement = $this->pdo->prepare($sql);
      if ($statement->execute($selectionArgs)) {
        $result = new PDOCursor($statement);  //predani cursoru
      } else {
        $this->checkPDOError($statement);
      }
      return $result;
    }

    /**
     * Execute a single SQL statement that is NOT a SELECT or any other SQL statement that returns data.
     * public void execSQL (String sql)
     *
     * @param sql the SQL statement to be executed. Multiple statements separated by semicolons are not supported.
     * @param param hodnoty zajisa pres (%d,%s...) tak array('v1', 'v2')
     * @return bool vykonano
     */
    public function execSQL($sql, $param = array()) {
      $result = NULL;
      $result = $this->pdo->exec(isset($param) && is_array($param) ? vsprintf($sql, $param) : $sql);
      $this->checkPDOError();
      return $result;
    }

    /**
     * get available pdo drives
     *
     * @return list array pdo drivers
     */
    public static function getAvailableDrivers() {
      return PDO::getAvailableDrivers();
    }

    /**
     * get current pdo driver name
     *
     * @return current driver
     */
    public function getDriverName() {
      return $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    }

    /**
     * zjistluje jestli jde o mysql
     *
     * @return true pokud je driver mysql
     */
    public function isMySQL() {
      return ($this->getDriverName() == 'mysql');
    }

    /**
     * zjistuje jestli jde o sqlite3
     *
     * @return true pokud je driver sqlite3
     */
    public function isSQLite() {
      return ($this->getDriverName() == 'sqlite');
    }
//TODO doimpelemntovat! isOCI8
    public function isOCI8() {}

    /**
     * Retrieve a database connection attribute
     *
     * @param attribute One of the PDO::ATTR_* constants.
     * @return A successful call returns the value of the requested PDO attribute. An unsuccessful call returns null.
     */
    public function getAttribute($attribute) {
      return $this->pdo->getAttribute($attribute);
    }

    /**
     * Set an attribute
     *
     * @param attribute Sets an attribute on the database handle.
     * @param value attribude new value
     * @return Returns TRUE on success or FALSE on failure.
     */
    public function setAttribute($attribute, $value) {
      return $this->pdo->setAttribute($attribute, $value);
    }
  }

  /**
   *
   * ContentValues
   *
   */
  class ContentValues {
    const VERSION = 1.20;

    private $content = null;

    /**
     * Creates an empty set of values using the default initial size
     * Creates a set of values copied from the given set
     * public ContentValues ()
     * ContentValues(ContentValues from)
     *
     * @param from the values to copy
     */
    public function __construct($from = null) {
      $this->content = array();

      if ($from instanceof ContentValues) {
        $content = $from->_getContent();
        $this->content = $content['content'];
      }

      if (is_array($from)) {
        $this->content = $from;
      }
    }

    /**
     * Removes all values.
     * public void clear ()
     */
    public function clear() {
      $this->content = null;
    }

    /**
     * Returns true if this object has the named value.
     * public boolean containsKey (String key)
     *
     * @param key the value to check for
     * @return true if the value is present, false otherwise
     */
    public function containsKey($key) {
      return array_key_exists($key, $this->content);
    }

    //public boolean equals (Object object)

    /**
     * Gets a value.
     * public Object get (String key)
     *
     * @param key the value to get
     * @return the data for the value
     */
    public function get($key) {
      return ($this->containsKey($key) ? $this->content[$key] : null);
    }

    /**
     * Gets a value and converts it to a Boolean.
     * public Boolean getAsBoolean (String key)
     *
     * @param key the value to get
     * @return the Boolean value, or null if the value is missing or cannot be converted
     */
    public function getAsBoolean($key) {
      return (boolean) $this->content[$key];
    }

    /**
     * Gets a value and converts it to a Float.
     * public Float getAsFloat (String key)
     *
     * @param key the value to get
     * @return the Float value, or null if the value is missing or cannot be converted
     */
    public function getAsFloat($key) {
      return floatval($this->content[$key]);
    }

    /**
     * Gets a value and converts it to an Integer.
     * public Integer getAsInteger (String key)
     *
     * @param key the value to get
     * @return the Integer value, or null if the value is missing or cannot be converted
     */
    public function getAsInteger($key) {
      return intval($this->content[$key]);
    }

    /**
     * Gets a value and converts it to a String.
     * public String getAsString (String key)
     *
     * @param key the value to get
     * @return the String for the value
     */
    public function getAsString($key) {
      return strval($this->content[$key]);
    }

    /**
     * Adds a value to the set.
     * public void put (String key, String value)
     *
     * @param string|array key the name of the value to put or array key=>value
     * @param value the data for the value to put
     * @return this for float-interface
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
     * public void putAll (ContentValues other)
     *
     * @param other the ContentValues from which to copy
     * @return this for float-interface
     */
    public function putAll(ContentValues $other) {
      $content = $other->_getContent();
      $this->content = array_merge($this->content, $content['content']);
      return $this;
    }

    /**
     * Adds a null value to the set.
     * public void putNull (String key)
     *
     * @param key the name of the value to make null
     * @return this for float-interface
     */
    public function putNull($key) {
      $this->content[$key] = null;
      return $this;
    }

    /**
     * prida date now polozku
     *
     * @param key klic hodnoty
     * @param timestamp predavany cas, defaultne now
     * @param format date format, defaultne Y-m-d H:i:s
     * @return this
     */
    public function putDate($key, $timestamp = 'now', $format = 'Y-m-d H:i:s') {
      $this->content[$key] = DateAndTime::from($timestamp)->format($format);
      return $this;
    }

    /**
     * Remove a single value.
     * public void remove (String key)
     *
     * @param key the name of the value to remove
     */
    public function remove($key) {
      unset($this->content[$key]);
      return $this;
    }

    /**
     * Returns the number of values.
     * public int size ()
     *
     * @return the number of values
     */
    public function size() {
      return count($this->content);
    }

    /**
     * systemova metoda pro vyber
     *
     * @return array zpracovany obsah
     */
    public function _getContent() {
      return array('content' => $this->content,
                   'keys' => array_keys($this->content),
                   'values' => array_values($this->content),
                  );
    }

    /**
     * Returns a string containing a concise, human-readable description of this object.
     * public String toString ()
     *
     * @return a printable representation of this object.
     */
    public function __toString() {
      return print_r($this->content, true);
    }
  }

  /**
   *
   * PDOCursor
   *
   * podporuje foreach(...) a count()
   *
   */
  class PDOCursor implements \Iterator/*, \Countable*/ {
    const VERSION = 2.00;

    private $cursor = null;

    /**
     * hlavni konstruktor
     *
     * @param statement handler po preparaci a execute
     */
    public function __construct($statement) {
      $this->cursor = new stdClass;
      //fetch pristup (iterator)
      $this->cursor->fetch = null;
      //fetchAll pristup (naraz)
      $this->cursor->fetchAll = new stdClass;
      $this->cursor->fetchAll->data = null;
      $this->cursor->fetchAll->index = 0;
      $this->cursor->fetchAll->columns = null;
      //statement from executed
      $this->cursor->statement = $statement;

      //TODO predelat na pole....
      //~ $this->cursor = array('fetch', 'fetchAll', 'statement');
    }

    /**
     * Closes the Cursor, releasing all of its resources and making it completely invalid.
     * public abstract void close ()
     *
     * @return Returns TRUE on success or FALSE on failure.
     */
    public function close() {
      $result = $this->cursor->statement->closeCursor();
      $this->cursor->statement = null;
      return $result;
    }

    /**
     * osetrovani existence klicu pole s funkci "array_key_exists"
     *
     * @param array vstupni pole
     * @param key klic do pole
     * @param defautl defaultni polozka
     * @return hodnota z pole pokud v poli existuje
     */
    private function _isNull($array, $key, $default = '') {
      return (is_array($array) && array_key_exists($key, $array) ? $array[$key] : $default);
    }
//FIXME dporuceni: nepouzivat zatim metody pracujici s fetchAll !!!!! jsou tu kvuli ni duplikace kodu!
    /**
     * interni incializace pro cteni kurzoru s fetchAll
     */
    private function _initFetchAll() {
      if (is_null($this->cursor->fetch) && is_null($this->cursor->fetchAll->data)) {
        //TODO nacitat veskera data do PDOCursorData (kazdy radek!)
        $this->cursor->fetchAll->data = $this->cursor->statement->fetchAll(); //inicializace fetchAll()
        $this->cursor->fetchAll->count = count($this->cursor->fetchAll->data);
        if ($this->cursor->fetchAll->count > 0) {
          $this->cursor->fetchAll->columns = array_keys($this->cursor->fetchAll->data[0]);
        }
      }
    }

    /**
     * vraceni zdroje z fetch nebo fetchAll
     *
     * @return nactene data kurzoru
     */
    private function _getSource() {
      return (!is_null($this->cursor->fetch) ?
                $this->cursor->fetch :
                $this->cursor->fetchAll->data[$this->cursor->fetchAll->index]
              );
    }

    /**
     * Return total number of columns
     * public abstract int getColumnCount ()
     * (fetchAll)
     *
     * @return number of columns
     */
    public function getColumnCount() {
      $this->_initFetchAll();
      return count($this->cursor->fetchAll->columns) / 2;
    }

    /**
     * Returns the zero-based index for the given column name, or -1
     * if the column doesn't exist.
     * public abstract int getColumnIndex (String columnName)
     * (fetchAll)
     *
     * @param columnName the name of the target column.
     * @return the zero-based column index for the given column name, or -1 if the column name does not exist.
     */
    public function getColumnIndex($columnName) {
      $this->_initFetchAll();
      $func = function($val) { return is_string($val); };
      $filter = array_flip(array_values(array_filter($this->cursor->fetchAll->columns, $func)));
      return $this->_isNull($filter, $columnName, -1);
    }

    /**
     * Returns the zero-based index for the given column name,
     * or throws PDOException if the column doesn't exist.
     * If you're not sure if a column will exist or not use getColumnIndex(String)
     * and check for -1, which is more efficient than catching the exceptions.
     * public abstract int getColumnIndexOrThrow (String columnName)
     * (fetchAll)
     *
     * @param columnName the name of the target column.
     * @return the zero-based column index for the given column name
     */
    public function getColumnIndexOrThrow($columnName) {
      $result = $this->getColumnIndex($columnName);
      if ($result < 0) {
        throw new PDOException('column does not exist');
      }
      return $result;
    }

    /**
     * Returns the column name at the given zero-based column index.
     * public abstract String getColumnName (int columnIndex)
     * (fetchAll)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return the column name for the given column index.
     */
    public function getColumnName($columnIndex) {
      $this->_initFetchAll();
      $func = function($val) { return is_string($val); };
      $filter = array_values(array_filter($this->cursor->fetchAll->columns, $func));
      return $this->_isNull($filter, $columnIndex);
    }

    /**
     * Returns a string array holding the names of all of the columns in the
     * result set in the order in which they were listed in the result.
     * public abstract String[] getColumnNames ()
     * (fetchAll)
     *
     * @return the names of the columns returned in this query.
     */
    public function getColumnNames() {
      $this->_initFetchAll();
      $func = function($val) { return is_string($val); };
      return array_values(array_filter($this->cursor->fetchAll->columns, $func));
    }

    /**
     * Returns the numbers of rows in the cursor.
     * public abstract int getCount ()
     * (fetchAll)
     *
     * @return the number of rows in the cursor.
     */
    public function getCount() {
      $this->_initFetchAll();
      return $this->cursor->fetchAll->count;
    }

    /**
     * alias for getCount(), this is not \Countable!
     * (fetchAll)
     *
     * @return Count elements of an object
     */
    public function count() {
      return $this->getCount();
    }

    /**
     * Returns the value of the requested column as a boolean.
     *
     * @param columnIndex the zero-based index of the target column.
     * @return the value of that column as a boolean.
     */
    public function getBool($columnIndex) {
      return (bool) $this->_isNull($this->_getSource(), $columnIndex);
    }

    /**
     * Returns the value of the requested column as a float.
     * public abstract float getFloat (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return the value of that column as a float.
     */
    public function getFloat($columnIndex) {
      return floatval($this->_isNull($this->_getSource(), $columnIndex));
    }

    /**
     * Returns the value of the requested column as an int.
     * public abstract int getInt (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return the value of that column as an int.
     */
    public function getInt($columnIndex) {
      return intval($this->_isNull($this->_getSource(), $columnIndex));
    }

    /**
     * Returns the current position of the cursor in the row set.
     * public abstract int getPosition ()
     * (fetchAll)
     *
     * @return the current cursor position.
     */
    public function getPosition() {
      return $this->cursor->fetchAll->index;
    }

    /**
     * Returns the value of the requested column as a String.
     * public abstract String getString (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return the value of that column as a String.
     */
    public function getString($columnIndex) {
      return strval($this->_isNull($this->_getSource(), $columnIndex));
    }

    /**
     * Returns data type of the given column's value.
     * public abstract int getType (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return column value type
     */
    public function getType($columnIndex) {
      return gettype($this->_isNull($this->_getSource(), $columnIndex, null));
    }

    /**
     * Returns whether the cursor is pointing to the position after the last row.
     * public abstract boolean isAfterLast ()
     * (fetchAll)
     *
     * @return whether the cursor is after the last result.
     */
    public function isAfterLast() {
      return ($this->cursor->fetchAll->index == ($this->getCount() - 2));
    }

    /**
     * Returns whether the cursor is pointing to the position before the first row.
     * public abstract boolean isBeforeFirst ()
     * (fetchAll)
     *
     * @return whether the cursor is before the first result.
     */
    public function isBeforeFirst() {
      return ($this->cursor->fetchAll->index == 1);
    }

    /**
     * return true if the cursor is closed
     * public abstract boolean isClosed ()
     * (fetchAll)
     *
     * @return true if the cursor is closed.
     */
    public function isClosed() {
      return (is_null($this->cursor->statement));
    }

    /**
     * Returns whether the cursor is pointing to the first row.
     * public abstract boolean isFirst ()
     * (fetchAll)
     *
     * @return whether the cursor is pointing at the first entry.
     */
    public function isFirst() {
      return ($this->cursor->fetchAll->index == 0);
    }

    /**
     * Returns whether the cursor is pointing to the last row.
     * public abstract boolean isLast ()
     * (fetchAll)
     *
     * @return whether the cursor is pointing at the last entry.
     */
    public function isLast() {
      return ($this->cursor->fetchAll->index == ($this->getCount() - 1));
    }

    /**
     * Returns true if the value in the indicated column is null.
     * public abstract boolean isNull (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return whether the column value is null.
     */
    public function isNull($columnIndex) {
      return is_null($this->_isNull($this->_getSource(), $columnIndex, null));
    }

    /**
     * Move the cursor by a relative amount, forward or backward, from the current position.
     * Positive offsets move forwards, negative offsets move backwards.
     * If the final position is outside of the bounds of the result set then the resultant
     * position will be pinned to -1 or count() depending on whether the value is off the front or end of the set, respectively.
     * public abstract boolean move (int offset)
     * (fetchAll)
     *
     * @param offset the offset to be applied from the current position.
     * @return whether the requested move fully succeeded.
     */
    public function move($offset) {
      $this->_initFetchAll();
      $index = $this->cursor->fetchAll->index;
      $offsetindex = $index + $offset;  //predvypocet posunu
      $podm = ($offsetindex > 0 && $offsetindex < $this->getCount());
      $this->cursor->fetchAll->index = ($podm ? $offsetindex : $index);
      return $podm;
    }

    /**
     * Move the cursor to the first row.
     * This method will return false if the cursor is empty.
     * public abstract boolean moveToFirst ()
     * (fetchAll)
     *
     * @return whether the move succeeded.
     */
    public function moveToFirst() {
      $this->_initFetchAll();
      $this->cursor->fetchAll->index = 0;
      return ($this->getCount() > 0);
    }

    /**
     * Move the cursor to the last row.
     * This method will return false if the cursor is empty.
     * public abstract boolean moveToLast ()
     * (fetchAll)
     *
     * @return whether the move succeeded.
     */
    public function moveToLast() {
      $this->_initFetchAll();
      $this->cursor->fetchAll->index = $this->getCount() - 1;
      return ($this->getCount() > 0);
    }

    /**
     * Move the cursor to the next row.
     * This method will return false if the cursor is already past the last entry in the result set.
     * public abstract boolean moveToNext ()
     * (fetchAll)
     *
     * @return whether the move succeeded.
     */
    public function moveToNext() {
      $this->_initFetchAll();
      $result = ($this->getCount() > ($this->cursor->fetchAll->index + 1));
      if ($result) {
        $this->cursor->fetchAll->index++;
      }
      return $result;
    }

    /**
     * Move the cursor to an absolute position. The valid range of values is -1 <= position <= count.
     * This method will return true if the request destination was reachable, otherwise, it returns false.
     * public abstract boolean moveToPosition (int position)
     * (fetchAll)
     *
     * @param position the zero-based position to move to.
     * @return whether the requested move fully succeeded.
     */
    public function moveToPosition($position) {
      $this->_initFetchAll();
      $result = ($position > 0 && $position < $this->getCount());
      if ($result) {
        $this->cursor->fetchAll->index = $position;
      }
      return $result;
    }

    /**
     * Move the cursor to the previous row.
     * This method will return false if the cursor is already before the first entry in the result set.
     * public abstract boolean moveToPrevious ()
     * (fetchAll)
     *
     * @return whether the move succeeded.
     */
    public function moveToPrevious() {
      $this->_initFetchAll();
      $result = (0 <= ($this->cursor->fetchAll->index - 1));
      if ($result) {
        $this->cursor->fetchAll->index--;
      }
      return $result;
    }

    /**
     *
     * normal iterator hasNext() + nextRow()
     *
     */

    /**
     * Return true if has next row (fetch)
     * public boolean hasNext ()
     *
     * @return true if exist next
     */
    public function hasNext() {
      $this->cursor->fetch = $this->cursor->statement->fetch(); //inicializace fetch()
      return (!empty($this->cursor->fetch));
    }

    /**
     * Return current row (fetch)
     * public boolean next ()
     *
     * @return current row
     */
    public function nextRow() {
      return new PDOCursorData($this->cursor->fetch);
    }

    /**
     * Interface for external iterators or objects that can be iterated themselves internally.
     * (fetch)
     */

    /**
     * incialization iterator (fetch)
     */
    private function _initIterate() {
      $this->cursor->fetch = $this->cursor->statement->fetch(); //inicializace fetch()
    }

    private $_iterate = 0;  //pocitadlo Iteratoru

    /**
     * Return the current element
     */
    public function current() {
      return new PDOCursorData($this->cursor->fetch);
    }

    /**
     * Return the key of the current element
     */
    public function key() {
      return $this->_iterate++;
    }

    /**
     * Move forward to next element
     */
    public function next() {
      $this->_initIterate();
    }

    /**
     * Rewind the Iterator to the first element
     */
    public function rewind() {
      $this->_initIterate();
      $this->_iterate = 0;
    }

    /**
     * Checks if current position is valid
     */
    public function valid() {
      return (!empty($this->cursor->fetch));
    }
  }

  /**
   *
   * PDOCursorData
   *
   * obsluhuje jednotlive radky
   *
   */
  class PDOCursorData implements \ArrayAccess, \Iterator, \Countable {
    const VERSION = 1.16;

    private $data;

    // iterator
    private $iteratorIndex = 0;
    private $klice = array();

    /**
     * kostruktor tridy
     *
     * @param data vstupni data z dotazu
     */
    public function __construct($data) {
      $this->data = $data;
    }

    /**
     * osetrovani existence klicu pole s funkci "array_key_exists"
     *
     * @param array vstupni pole
     * @param key klic do pole
     * @param defautl defaultni polozka
     * @return hodnota z pole pokud v poli existuje
     */
    private function _isNull($array, $key, $default = '') {
      return (isset($array[$key]) ? $array[$key] : $default);
    }

    /**
     * Returns the value of the requested column as a String.
     * public abstract String getString (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return the value of that column as a String.
     */
    public function getString($columnIndex) {
      return strval($this->_isNull($this->data, $columnIndex));
    }

    /**
     * Returns data type of the given column's value.
     * public abstract int getType (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return column value type
     */
    public function getType($columnIndex) {
      return gettype($this->_isNull($this->data, $columnIndex, null));
    }

    /**
     * Returns the value of the requested column as a boolean.
     *
     * @param columnIndex the zero-based index of the target column.
     * @return the value of that column as a boolean.
     */
    public function getBool($columnIndex) {
      return (bool) $this->_isNull($this->data, $columnIndex);
    }

    /**
     * Returns the value of the requested column as a float.
     * public abstract float getFloat (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return the value of that column as a float.
     */
    public function getFloat($columnIndex) {
      return floatval($this->_isNull($this->data, $columnIndex));
    }

    /**
     * Returns the value of the requested column as an int.
     * public abstract int getInt (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return the value of that column as an int.
     */
    public function getInt($columnIndex) {
      return intval($this->_isNull($this->data, $columnIndex));
    }

    /**
     * Returns true if the value in the indicated column is null.
     * public abstract boolean isNull (int columnIndex)
     *
     * @param columnIndex the zero-based index of the target column.
     * @return whether the column value is null.
     */
    public function isNull($columnIndex) {
      return is_null($this->_isNull($this->data, $columnIndex, null));
    }

    /**
     * vraceni hodnot na zaklade klice predaneho jako objektovy atribut
     *
     * @param name klic k hodnote
     * @return hodnota
     */
    public function __get($name) {
      return $this->_isNull($this->data, $name);
    }

    /**
     *
     * implementace \ArrayAccess
     *
     */

    // test existence
    public function offsetExists($offset) {
      return isset($this->data[$offset]);
    }

    // nacteni hodnoty
    public function offsetGet($offset) {
      return $this->_isNull($this->data, $offset);
    }

    // nastaveni hodnoty (zamerne neimplementovano)
    public function offsetSet($offset, $value) {}
    // likvidae hodnoty (zamerne neimplementovano)
    public function offsetUnset($offset) {}

    /**
     *
     * implementace \Iterator
     *
     */

    public function rewind() {  // inicializace
      $this->iteratorIndex = 0;
      $this->klice = array_values(array_filter(array_keys($this->data), function($v) { return !is_numeric($v); })); // nazvy klicu a oprava indexu
    }

    public function current() { // vraceni hodnoty
      return $this->data[$this->klice[$this->iteratorIndex]]; //klic saha do dat
    }

    public function key() { // vraceni klice
      return $this->klice[$this->iteratorIndex];  //index saha do klicu
    }

    public function next() {  // posouvani na dalsi index
      $this->iteratorIndex++;
    }

    public function valid() { // je dalsi?
      return isset($this->klice[$this->iteratorIndex]);
    }

    /**
     *
     * implementace \Countable
     *
     */
    public function count() {
      return count($this->data) / 2;
    }
  }
