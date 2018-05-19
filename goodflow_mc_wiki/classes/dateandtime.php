<?php
/*
 * dateandtime.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 * osamostatnena instancne staticka trida pro praci s datumem a casem
 */

  namespace classes;

  use DateTime,
      DateTimeZone;

  class DateAndTime extends DateTime {
    const VERSION = 1.10;

    const MINUTE = 60;
    const HOUR = 3600;
    const DAY = 86400;
    const WEEK = 604800;
    const MONTH = 2629800;
    const YEAR = 31557600;

    /**
     * DateTime tovarnicka
     * melo by byt nastaveno:
     * date_default_timezone_set('Europe/Berlin');
     * DateAndTime::setDateTimezone('Europe/Berlin');
     *
     * @param time vstupni cas textovy/ciselny/DateTime
     * @return DateTime objekt
     */
    public static function from($time) {
      $result = null;
      if ($time instanceof DateTime) {
        $result = new self($time->format('Y-m-d H:i:s'), $time->getTimezone());
      } else
      if (is_numeric($time)) {
        if ($time <= self::YEAR) { $time += time(); }
        $result = new static(date('Y-m-d H:i:s', $time));
      } else {
        $result = new static($time);
      }
      return $result;
    }

    /**
     * nastaveni datetime zony
     *
     * @param timezone time zona
     */
    public static function setDateTimezone($timezone) {
      date_default_timezone_set($timezone);
    }

    /**
     * nacteni datetime zony
     *
     * @return time zona
     */
    public static function getDateTimezone() {
      return date_default_timezone_get();
    }

    /**
     * tisk data pri echo
     *
     * @return datum
     */
    public function __toString() {
      return $this->format('Y-m-d H:i:s');
    }

    /**
     * modifikace s klonovanim
     *
     * @param modify modifikace casu
     * @return modifikovany DateTime
     */
    public function modilyClone($modify = '') {
      $pom = clone $this;
      return (!empty($modify) ? $pom->modify($modify) : $pom);
    }
  }

?>
