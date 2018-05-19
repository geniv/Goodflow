<?php
/*
 *      pagination.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception;

  class Pagination {
    const VERSION = 1.13;
//FIXME taktez uplne predelat! je to spatne!
    private $page = NULL;

    public function __construct($count_row = NULL) {
      $this->page = new stdClass;
      $this->page->count = $count_row;
      $this->page->webpath = '';
      $this->page->current = NULL;
      $this->page->from = 0;
      $this->page->done = false;
      //FIXME pridat oop promenne ktere se nize aplikuji.. dodelat inicializaci...
    }

//nastaveni poctu polozek
    public function setCountItem($num) {
      $this->page->count = $num;
      return $this;
    }

//nastaveni pocet polozek na stranku
    public function setPerPage($num) {
      $this->page->perpage = $num;
      return $this;
    }

//nastaveni path pro web adresu
    public function setWebPath($path) {
      $this->page->webpath = $path;
      return $this;
    }

//tvrde nastaveni strankovani
    public function setCurrentPage($num) {
      $this->page->current = $num;
      return $this;
    }

//nastavovani aktualni stranky
    public function setPagingVariable($var, $method = Core::METHOD_GET) {
      $http = Core::getHttpVariable($method);
      $this->page->pagevariable = $var;
      if (empty($this->page->current)) {  //pokud je current prazdny bere rovnou z promenne dane metody
        $this->page->current = Core::isFill($http, $var, 1);
      }
      return $this;
    }

//samotny propocet strankovani
    public function calculate() {
      try {
        if (empty($this->page->perpage) || $this->page->perpage <= 0) {
          throw new ExceptionPagination('Per page does not empty!');
        }

        if (empty($this->page->pagevariable)) {
          throw new ExceptionPagination('Page variable does not empty!');
        }

        //vypocet poctu stran
        $this->page->countpage = (integer) ceil($this->page->count / $this->page->perpage);

        //osetreni presahu
        $this->page->current = ($this->page->current < 1 ? 1 : $this->page->current);
        $this->page->current = ($this->page->current > $this->page->countpage ? $this->page->countpage : $this->page->current);

        //cislo from pro pocatek limitu
        $this->page->from = abs(($this->page->current - 1) * $this->page->perpage);

        $this->page->done = true;

      } catch (ExceptionPagination $e) {
        echo $e;
      }
      return $this;
    }

    const PAGER_DEFAULT = '';
    const PAGER_MINI_NORMAL = 'mininormal';
    const PAGER_FULL_NORMAL = 'fullnormal';

//vraci sadu strankovacich odkazu
    public function getPager($type = NULL, $sablona = NULL) {
      $result = NULL;
      if (!empty($this->page->count) && $this->page->done) {

//TODO pak i podporu na automaticke prepinani typu strankovani podle poctu stranek

        $hrefs = NULL;
        switch ($type) {
          default:
          case self::PAGER_DEFAULT:
          case self::PAGER_MINI_NORMAL:
            //TODO pri nejake prilezitosti dodelat...
          break;

          //TODO dodelat dalsi typy strankovani, dle potreby...

          case self::PAGER_FULL_NORMAL:
            $res = NULL;
            //predchozi
            if ($this->page->current > 1) {
              $prev = ($this->page->current - 1 > 1 ? $this->page->current - 1 : NULL);
              if (empty($sablona['prev'])) {
                $res[] = Html::a()->href($this->page->webpath, array($this->page->pagevariable => $prev))
                                  ->setText('prev');
              } else {
                $data = array('url' => $this->page->webpath,
                              $this->page->pagevariable => $prev);
                $res[] = $sablona['prev']->setTemplate($data)->render();  //template
              }
            }

            $row = array();
            $range = range(1, $this->page->countpage);
            foreach ($range as $val) {
              $item = NULL;
              if ($this->page->current == $val) {
                if (empty($sablona['current'])) {
                  $item = Html::span()->setText($val);
                } else {
                  $data = array('val' => $val);
                  $item = $sablona['current']->setTemplate($data)->render();  //template
                }
              } else {
                if (empty($sablona['item'])) {
                  $item = Html::a()->href($this->page->webpath, ($val > 1 ? array($this->page->pagevariable => $val) : NULL))
                                  ->setText($val);
                } else {
                  $data = array('url' => $this->page->webpath,
                                $this->page->pagevariable => ($val > 1 ? $val : NULL),
                                'val' => $val);
                  $item = $sablona['item']->setTemplate($data)->render(); //template
                }
              }
              $row[] = $item;
            }
            //$res[] = Html::div()->insert($row);
            $res[] = implode('', $row);

            //dalsi
            if ($this->page->current < $this->page->countpage) {
              $next = ($this->page->current + 1);
              if (empty($sablona['next'])) {
                $res[] = Html::a()->href($this->page->webpath, array($this->page->pagevariable => $next))
                                  ->setText('next');
              } else {
                $data = array('url' => $this->page->webpath,
                              $this->page->pagevariable => $next);
                $res[] = $sablona['next']->setTemplate($data)->render();  //template
              }
            }

            $hrefs = implode('', $res);
          break;
        }

        $current = $this->page->current;
        $countpage = $this->page->countpage;
        if (empty($sablona['pager'])) {
          $result = Html::div()->id('strankovani')->insert(Html::span()->id('info_strana')->setText('Strana %s z %s', array($current, $countpage)))
                                                  ->insert(Html::span()->id('urceni_strany')->setText($hrefs));
        } else {
          $data = array('current' => $current,
                        'countpage' => $countpage,
                        'hrefs' => $hrefs);
          $result =  $sablona['pager']->setTemplate($data)->render();  //template
        }
      }

      return $result;
    }

//vrati rozsah strankovani pro pole
    public function getArrayLimit() {
      $result = array();
      if ($this->page->done) {
        $result = array($this->page->from, $this->page->perpage);
      }
      return $result;
    }

//vrati rozsah strankovani pro SQL
    public function getSqlLimit() {
      return sprintf('LIMIT %s, %s', $this->page->from, $this->page->perpage);
    }

//vrati vypocitany pocet stranek
    public function getCountPage() {
      return $this->page->countpage;
    }
  }

  class ExceptionPagination extends Exception {}

?>
