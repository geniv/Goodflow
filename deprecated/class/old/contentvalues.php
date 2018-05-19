<?php
/*
 * contentvalues.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * ContentValues, trida starajici se o vstupni data do insert, update a delete
   * - zalozeno na: http://developer.android.com/reference/android/content/ContentValues.html
   *
   * @package stable/pdo
   * @author geniv
   * @version 2.06
   */
  final class ContentValuesX {

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
      if ($from instanceof self) {  //ContentValues
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
     * systemova metoda pro vyber
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
  }