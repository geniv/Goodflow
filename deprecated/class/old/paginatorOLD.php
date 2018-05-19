<?php
/*
 * paginator.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception;

  class Paginator {
    const VERSION = 1.26;

    private $items = null;

    /**
     * konstruktor
     *
     * @param variable promena pro predavani hodnoty v url
     */
    public function __construct(&$pageVariable = null) {
      $this->items = new stdClass;
      $this->items->perPage = 1; //na stranku polozek, null = nekonecno (vypnute strankovani)
      $this->items->page = &$pageVariable;  //aktualni stranka
      $this->items->base = 1; //prvni stranka
      $this->items->count = 0;  //pocet polozek

      if (is_null($pageVariable)) {
        unset($this->items->page);
        $this->items->page = 1;
      }
      $this->checkPage($pageVariable);  //kontrola page hodnoty
    }

    /**
     * kontrola ciselneho rozsahu stranek
     *
     * @param page vstupni stranka na kontrolu
     */
    private function checkPage($page) {
      if ($page < 1) {
        $this->items->page = 1;
      }

      if ($this->getPageCount() > 0 && $page > $this->getPageCount()) {
        $this->items->page = $this->getPageCount();
      }
    }

    /**
     * nastaveni aktualni stranky
     *
     * @param page cislo stranky
     * @return this
     */
    public function setPage($page) {
      $this->items->page = intval($page);
      $this->checkPage($page);  //kontrola page hodnoty
      return $this;
    }

    /**
     * vraceni aktualni stranky
     *
     * @return cislo stranky
     */
    public function getPage() {
      $this->checkPage($this->items->page); //kontrola page hodnoty
      return $this->items->page;
    }

    /**
     * vrati prvni stranku
     * alias k: getBase()
     *
     * @return prvni stranka
     */
    public function getFirstPage() {
      return $this->items->base;
    }

    /**
     * vrati posledni stranku
     *
     * @return posledni stanka
     */
    public function getLastPage() {
      return $this->items->base + ($this->getPageCount() - 1);
    }

    /**
     * nastavi prvni stranku
     *
     * @param base prvni stranka
     * @return this
     */
    public function setBase($base) {
      $this->items->base = intval($base);
      $this->setPage($base);
      return $this;
    }

    /**
     * vrati prvni stranku, bazi
     *
     * @return base strankovani
     */
    public function getBase() {
      return $this->items->base;
    }

    /**
     * zjistuje jestli je aktualni stranka prvni
     *
     * @return true pokud je aktualni stranka prvni
     */
    public function isFirst() {
      return ($this->items->page <= $this->items->base);
    }

    /**
     * zjistuje jestli je aktualni stranka posledni
     *
     * @return true pokud je aktuani stranka posledni
     */
    public function isLast() {
      return ($this->items->page >= $this->getPageCount());
    }

    /**
     * vrati vypocitany pocet stranek
     * podle celkoveho poctu polozek a polozek na stranku
     *
     * @return pocet stranek
     */
    public function getPageCount() {
      return intval(ceil($this->items->count / $this->items->perPage));
    }

    /**
     * nastavi pocet polozek na jednu stranku
     *
     * @param itemsPerPage pocet polozek
     * @return this
     */
    public function setItemsPerPage($itemsPerPage) {
      $this->items->perPage = intval($itemsPerPage);
      return $this;
    }

    /**
     * vrati pocet polozek na jednu stranku
     *
     * @return pocet polozek
     */
    public function getItemsPerPage() {
      return $this->items->perPage;
    }

    /**
     * nastavi celkovy pocet polozek pro strankovani
     *
     * @param itemCount celkovy pocet polozek
     * @return this
     */
    public function setItemCount($itemCount) {
      $this->items->count = intval($itemCount);
      return $this;
    }

    /**
     * vrati celkovy pocet polozek pro strankovani
     *
     * @return celkovy pocet polozek
     */
    public function getItemCount() {
      return $this->items->count;
    }

    /**
     * vrati absolutni index prvni polozky na aktualni stranky
     *
     * @return index stranky
     */
    public function getOffset() {
      return abs(($this->items->page - 1) * $this->items->perPage);
    }

    /**
     * vrati pocet polozek na akualni stranku
     *
     * @return pocet polozek
     */
    public function getLength() {
      return $this->items->perPage;
    }

    /**
     * vrati rozsahy pro strankovani generovane z pole
     *
     * @return pole rozsahu strankovani
     */
    public function getArrayLimit() {
      return array($this->getOffset(), $this->getLength());
    }

    /**
     * vrati v textu sql limit
     *
     * @param withLimit true vypisuje navic klauzuli limit
     * @return rozsah pro sql limit
     */
    public function getSqlLimit($withLimit = false) {
      return ($withLimit ? 'LIMIT ' : '').$this->getOffset().', '.$this->getLength();
    }

    /**
     * vrati v textu sql limit s klauzuli offset
     *
     * @param withLimit true vypisuje navic klauzuli limit
     * @return rozsah pro sql limit s offset
     */
    public function getMySQLLimitOffset($withLimit = false) {
      return ($withLimit ? 'LIMIT ' : '').$this->getLength().' OFFSET '.$this->getOffset();
    }

    //TODO metody na vykrelovani strankovace!!! treba pres render a toString vkladani tvaru pres callback!!!!!

    //TODO lepsi nazev? predavat callback!!!
    public function setSkeleton($skeleton) {
    }
//TODO dodelat!!!!
    public function render() {
    }

    /**
     * renderovani strankovani pres magickou metodu
     *
     * @return vyrenderovane strankovani
     */
    public function __toString() { return $this->render(); }
  }

  class ExceptionPaginator extends Exception {}

?>
