<?php
/*
 * paginator.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;
//TODO dopsat testy!!!!
  /**
   * strankovaci trida uzpusobena na strankovani v TPL
   * - na vysostne prani mr.Fajagamy :D
   * - zalozeno na: http://api.nette.org/2.0/source-Utils.Paginator.php.html
   *
   * @package stable
   * @author geniv
   * @version 2.38
   */
  final class Paginator {
    private $itemCount;
    private $itemsPerPage = 1;
    private $base = 1;
    private $page;

    /**
     * defaultni konstruktor
     *
     * @since 2.00
     * @param int itemCount celkovy pocet polozek
     * @param int itemsPerPage pocet polozek na stranku
     */
    public function __construct($itemCount, $itemsPerPage = 1) {
      $this->setItemCount($itemCount)
           ->setItemsPerPage($itemsPerPage);
    }

    /**
     * tovarni metoda na vytvareni instance
     *
     * @since 1.00
     * @param int itemCount celkovy pocet polozek
     * @param int itemsPerPage pocet polozek na stranku
     * @return Paginator instance paginatoru
     */
    public static function init($itemCount, $itemsPerPage = 1) {
      return new self($itemCount, $itemsPerPage);
    }

    /**
     * nacteni poctu polozek na strankovani
     *
     * @since 2.04
     * @param void
     * @return int pocet polozek
     */
    public function getItemCount() {
      return $this->itemCount;
    }

    /**
     * nastaveni poctu polozek na strankovani
     *
     * @since 2.02
     * @param int itemCount pocet polozek
     * @return this
     */
    public function setItemCount($itemCount) {
      $this->itemCount = max(0, $itemCount);
      return $this;
    }

    /**
     * nacteni poctu polozek na stranku
     *
     * @since 2.04
     * @param void
     * @return int pocet polozek na stranku
     */
    public function getItemsPerPage() {
      return $this->itemsPerPage;
    }

    /**
     * nastaveni poctu polozek na stranku
     *
     * @since 2.04
     * @param int itemsPerPage pocet polozek na stranku
     * @return this
     */
    public function setItemsPerPage($itemsPerPage) {
      $this->itemsPerPage = max(1, $itemsPerPage);
      return $this;
    }

    /**
     * nacteni cisla prvni (bazove) stranky
     *
     * @since 2.08
     * @param void
     * @return int cislo bazove stranky
     */
    public function getBase() {
      return $this->base;
    }

    /**
     * nastaveni cisla prvni (bazove) stranky
     *
     * @since 2.10
     * @param int base cislo bazove stranky
     * @return this
     */
    public function setBase($base) {
      $this->base = $base;
      return $this;
    }

    /**
     * nacteni aktualni stranky
     * - aktualni / celkovy pocet: $pagination->getPage() / $pagination->getPageCount()
     *
     * @since 2.10
     * @param void
     * @return int cislo aktualni stranky
     */
    public function getPage() {
      return $this->base + $this->getPageIndex();
    }

    /**
     * nastaveni aktualni stranky
     *
     * @since 2.10
     * @param int page cislo aktualni stranky
     * @return this
     */
    public function setPage($page) {
      $this->page = $page;
      return $this;
    }

    /**
     * nacteni ciselneho zakladu strankovace
     *
     * @since 2.10
     * @param void
     * @return int index stranky
     */
    private function getPageIndex() {
      $index = max(0, $this->page - $this->base);
      return min($index, max(0, $this->getPageCount() - 1));
    }

    /**
     * nacteni cisla prvni stranky
     *
     * @since 2.10
     * @param void
     * @return int cislo prvni stranky
     */
    public function getFirstPage() {
      return $this->base;
    }

    /**
     * nacteni cisla posledni stranky
     *
     * @since 2.10
     * @param void
     * @return int cislo posledni stranky
     */
    public function getLastPage() {
      return $this->base + max(0, $this->getPageCount() - 1);
    }

    /**
     * nacteni cisla predchozi stranky
     *
     * @since 2.20
     * @param void
     * @return int cislo predchozi stranky
     */
    public function getPrevPage() {
      return $this->getPage() - 1;
    }

    /**
     * nacteni cisla dalsi stranky
     *
     * @since 2.20
     * @param void
     * @return int cislo dalsi stranky
     */
    public function getNextPage() {
      return $this->getPage() + 1;
    }

    /**
     * je aktualni stranka prvni?
     *
     * @since 2.08
     * @param void
     * @return bool true pokud je stranka prvni
     */
    public function isFirst() {
      return $this->getPageIndex() === 0;
    }

    /**
     * je aktualni stranka posledni?
     *
     * @since 2.08
     * @param void
     * @return bool true pokud je stranka posledni
     */
    public function isLast() {
      return $this->getPageIndex() >= $this->getPageCount() - 1;
    }

    /**
     * je predchozi stranka?
     *
     * @since 2.18
     * @param void
     * @return bool true pokud je predchozi stranka
     */
    public function isPrev() {
      return $this->getPageIndex() !== 0;
    }

    /**
     * je dalsi stranka?
     *
     * @since 2.18
     * @param void
     * @return bool true pokud je dalsi stranka
     */
    public function isNext() {
      return $this->getPageIndex() < $this->getPageCount() - 1;
    }

    /**
     * nacteni celkoveho poctu stranek
     * - $pagination->getPage() / $pagination->getPageCount()
     *
     * @since 2.06
     * @param void
     * @return int celkovy pocet stranek
     */
    public function getPageCount() {
      return (int) ceil($this->itemCount / $this->itemsPerPage);
    }

    /**
     * ma ceni zobrazovat pager?
     * - pokud bude pocet stranek > 1
     * - pokud je page cislo
     *
     * @since 2.32
     * @param void
     * @return bool true pokud ma cenu pager zobrazovat?
     */
    public function isVisible() {
      return is_numeric($this->page) && $this->getPageCount() > 1;
    }

    /**
     * nacteni absolutniho indexu prvni polozky na aktualni strance
     * - od polozky
     *
     * @since 2.12
     * @param void
     * @return int offset strankovani
     */
    public function getOffset() {
      return $this->getPageIndex() * $this->itemsPerPage;
    }

    /**
     * nacteni absolutniho indexu prvni polozky na aktualni strance, ale opacne
     * - od polozky (opacne)
     *
     * @since 2.12
     * @param void
     * @return int offset strankovani
     */
    public function getCountdownOffset() {
      return max(0, $this->itemCount - ($this->getPageIndex() + 1) * $this->itemsPerPage);
    }

    /**
     * nacteni cisla pocatku pro offset
     * - pocet polozek na stranku
     *
     * @since 2.12
     * @param void
     * @return int cislo pocatku pro offset
     */
    public function getLength() {
      return min($this->itemsPerPage, $this->itemCount - $this->getPageIndex() * $this->itemsPerPage);
    }

    /**
     * rozdeleni pole podle aktualniho offset a length
     * - pomocna metoda ktera vnitrne oseka pole podle offset a length
     *
     * @since 2.16
     * @param array input vstupni pole (vsechny polozky)
     * @param bool preserve_keys true pro zachovani indexu pole
     * @return array vystupni orezane pole podle offset a length (zapomoci strankovani)
     */
    public function getArraySlice($input, $preserve_keys = false) {
      return array_slice($input, $this->getOffset(), $this->getLength(), $preserve_keys);
    }

    /**
     * nacteni SQL limitu
     *
     * @since 2.20
     * @param void
     * @return string sql limit do sql dotazu
     */
    public function getLimit() {
      return 'LIMIT '.$this->getOffset().', '.$this->getLength();
    }

    // typy zobrazeni strankovani
    const FULL = 0;   /** plne zobrazeni - () 1 2 3 4 (plne) () */
    const TYPE1 = 1;  /** zkracene zobrazovani s prvnim - () 1 ... 4 5 6 ... 9 () - nastaveni: [koeficient],[range] */
    const TYPE2 = 2;  /** zkracene zobrazovani - () 4 5 6 () - nastaveni: [koeficient],[range]  */
    const TYPE3 = 3;  /** zkracene zobrazovani danym poctem - 1 2 3 4 5 (do rozsahu) - nastaveni: [range] */

    /**
     * hlavni render-er strankovace pro prepinani
     *
     * @since 2.18
     * @param int|null typ vykreslovani strankovani
     * @param array|null settings moznosti variabilniho nastaveni pro ruzne mody vykreslovani
     * @return array vygenerovane pole na prepinani
     */
    public function render($type = null, $settings = null) {
      $result = array();
      switch ($type) {
        default:
        case self::FULL:
          $result = range($this->getFirstPage(), $this->getLastPage());
        break;

        case self::TYPE1:
          $page = $this->getPage();
          $last = $this->getLastPage();
          $koef = isset($settings['koeficient']) ? $settings['koeficient'] : 4;
          $range = isset($settings['range']) ? $settings['range'] : 1;

          $result[] = $this->getFirstPage();
          if ($page < $koef) {
            $result = array_merge($result, range(2, $koef));
          } else
          if ($page >= $koef && $page <= $last - ($koef - 1)) {
            $result = array_merge($result, range($page - $range, $page + $range));
          } else
          if ($page > $last - ($koef - 1)) {
            $result = array_merge($result, range($last - ($koef - 1), $last - 1));
          }
          $result[] = $last;
        break;

        case self::TYPE2:
          $page = $this->getPage();
          $last = $this->getLastPage();
          $koef = isset($settings['koeficient']) ? $settings['koeficient'] : 4;
          $range = isset($settings['range']) ? $settings['range'] : 1;

          if ($page < $koef) {
            $result = range(1, $koef);
          } else
          if ($page >= $koef && $page <= $last - ($koef - 1)) {
            $result = range($page - $range, $page + $range);
          } else
          if ($page > $last - ($koef - 1)) {
            $result = range($last - ($koef - 1), $last);
          }
        break;

        case self::TYPE3:
          $page = $this->getPage();
          $last = $this->getLastPage();
          $range = isset($settings['range']) ? $settings['range'] : 10;
          $mid = floor($range / 2);

          if ($last < $range) {
            $result = range(1, $last);
          } else {
            if ($page <= $mid) {
              $result = range(1, $range);
            } else
            if ($page > $mid && $page <= $last - $mid) {
              $result = range($page - $mid, $page + $mid);
            } else
            if ($page > $last - $mid) {
              $result = range($last - ($range - 1), $last);
            }
          }
        break;
      }
      return $result;
    }
  }