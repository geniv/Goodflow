<?php
/*
 * dateandtime.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * samostatna staticka trida pro praci s datumem a casem
   *
   * @package stable
   * @author geniv
   * @version 1.20
   */
  class DateAndTime extends \DateTime {

    //~ const MINUTE = 60;
    //~ const HOUR = 3600;
    //~ const DAY = 86400;
    //~ const WEEK = 604800;
    //~ const MONTH = 2629800;
    /** 1 rok a 6 hodin */
    const YEAR = 31557600;

    /**
     * DateTime tovarnicka
     *
     * melo by byt nastaveno:
     * date_default_timezone_set('Europe/Berlin');
     *
     * @uses DateAndTime::setDateTimezone('Europe/Berlin');
     * @since 1.00
     * @param DateTime|int|string time vstupni cas textovy/ciselny(posun|unixstamp)/DateTime
     * @return DateTime instance
     */
    public static function from($time = 'now') {
      $result = null;
      if ($time instanceof \DateTime) { //prevzeni instance
        $result = new static($time->format('Y-m-d H:i:s'), $time->getTimezone());
      } else
      if (is_numeric($time)) {  // z casovy posun(do 1 roku)/unixstamp
        if ($time <= self::YEAR) { $time += time(); }
        $result = new static(date('Y-m-d H:i:s', $time));
      } else {  //vytvoreni z textu
        $result = new static($time);
      }
      return $result;
    }

    /**
     * pocitani rozdilu casu
     * -pokud se zada jen $to pocota se uplynuty cas
     * -pokud se $from nezada tak se bere aktualni cas
     *
     * @since 1.14
     * @param DateTime|int|string to casovy udaj pro koncovy bod
     * @param DateTime|int|string from casovy udaj pro pocatecni bod
     * @return DateInterval rozdil casu
     */
    public static function different($to, $from = null) {
      $cur = self::from($from);
      $fin = self::from($to);
      return $cur->diff($fin);
    }

    /**
     * nastaveni datetime zony
     *
     * @since 1.10
     * @param string timezone nazev pozadovane datetime zony
     * @return void
     */
    public static function setDateTimezone($timezone) {
      date_default_timezone_set($timezone);
    }

    /**
     * nacteni datetime zony
     *
     * @since 1.10
     * @return string time zona
     */
    public static function getDateTimezone() {
      return date_default_timezone_get();
    }

    /**
     * tisk data pri echo
     *
     * @since 1.00
     * @return string datum
     */
    public function __toString() {
      return $this->format('Y-m-d H:i:s');
    }

    /**
     * modifikace s klonovanim
     *
     * @since 1.00
     *
     * @param string modify modifikace casu
     * @return DateTime modifikovany DateTime
     */
    public function modilyClone($modify = '') {
      $pom = clone $this;
      return (!empty($modify) ? $pom->modify($modify) : $pom);
    }
  }