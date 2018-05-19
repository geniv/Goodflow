<?php
/*
 * lighthtmlbeta.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use Exception;

//TODO psat slusne komentare!

  //skusit prototyp skralani htmlka pomoci jsonu
  class LightHtmlBeta {
    const VERSION = 1.27;

    private $element = NULL;  //skladani vsech id, sem se bodou ukladat jen ID na prvky
    private static $storelem = array(); //skladovani vsech elemtnu
    private static $stortext = array(); //skladovani vsech textu

    private static $zan = NULL;
    private static $break = false;
    private $current = NULL;

    private function __construct($name) {
      $id = uniqid();
      $this->current = $id;
      $this->element = array($id => array('name' => $name,
                                          'attributes' => array(),
                                          'content' => array(),
                                          'id' => $id,
                                          )
                            );
    }

    public function __call($name, $values) {
      try {
//TODO pridat systemovy atribut: visible => bude se starat o skryvani html prvku

        $value = NULL;
        //var_dump($name, $values);
        switch ($name) {
          case 'type':    //atribut type
          case 'name':
          case 'value':   //hodnota
          case 'disabled'://deaktivovat (bool)
          case 'readonly'://pouze pro cteni (bool)
          case 'accept':  //akceptovani typu (ale neakceptuje)
          case 'accesskey': //klavesova zkratka alt+hodnota
          case 'placeholder': //vychozi text v inputu
          case 'size':  //velikost inputu
          case 'maxlength': //maximalni pocet znaku
          case 'autocomplete':  //automaticke doplnovani
          case 'border':
          case 'src': //cesta k obrazku
          case 'width': //sirka pro obrazky
          case 'height':  //vyska pro obrazky
          case 'alt': //text pod obrazkem
          case 'title': //titulek (input,href)
          case 'tabindex':  //poradi elementu
          case 'multiple':  //multy vyber u input type file
          case 'checked': //zaskrknuto
          case 'selected':  //oznaceno
          case 'cols':  //pocet sloupcu (textarea)
          case 'rows':  //pocet radku (textarea)
          case 'wrap':  //zalamovani textu (textarea)
          case 'for': //?
          case 'align': //?
          case 'label': //obal inputu
          case 'method':
          case 'action':
          case 'enctype':
          case 'onblur':
          case 'onchange':
          case 'onclick':
          case 'ondblclick':
          case 'onfocus':
          case 'onkeypress':
          case 'onkeydown':
          case 'onkeyup':
          case 'onmousedown':
          case 'onmouseup':
          case 'onmouseover':
          case 'onmousemove':
          case 'onmouseout':
          case 'onselect':
          case 'media': //od css
          case 'rel': //propojovani s JS a pod.
          case 'min': //html5 number
          case 'max': //html5 number
          case 'step':  //html5 number
          case 'required':  //html5 povinne

          case 'href':
          //case 'onresize':
            if (!is_null($values[0])) { //musi testovat na NULL, vkladani prazdne ale ne NULL
              $value = $values[0];
            }
          break;

          case 'id':  //atribut id ->id('text')->id('text %s', 'subst')->id('test %s %s', array('su', 'bst'))

          break;

          case 'class':   //->class('a')->class(array('a', 'b'))->class('text %s', 'subst')->class('text %s %s', array('sub', 'st'))

          break;

          case 'style': //->style('k', 'v')->style(array('k' => 'v', 'k' => 'v'))

          break;

          case 'srcpath': //->srcpath('obr1.png') - webpath/obr1.png

          break;

          case 'srchash': //->srchash('image/png', $blob_data) - obrazev v odkazu

          break;

          //case 'href':  //->href('url', array('k' => 'v', 'k' => 'v'))
          //break;

          case 'hrefpath':  //->hrefpath('path/url', array('')) - webpath

          break;

          case 'hrefrewrite': //->hrefrewrite('path/url', array(''))->hrefrewrite('p', 'a', 't', 'h') - rewrite

          break;

          case 'hrefpathrewrite': //->hrefrewrite('path/url', array('pa', 'th'))->hrefpathrewrite('p', 'a', 't', 'h') - webpath + rewrite

          break;

          default:
            throw new ExceptionLightHtml(sprintf('Unknown attrtibute "%s"!', $name));
          break;
        }

       // $this->element->attributes[$name] = $value;
       $this->element[$this->current]['attributes'][$name] = $value;

      } catch (ExceptionHtml $e) {
        echo $e;
      }
      return $this;
    }

    public static function enableBreakDepth() {
      self::$zan = 0;
      self::$break = true;
    }

    public static function setDepth($depth) {
      self::$zan = $depth;
    }

    public static function elem($name, $attribute = NULL) {
      $el = new self($name);
      //TODO zaaplikovat atributy!
      return $el;
    }
//TODO pripravit co nejdriv na komentare!!!!!
    public static function el($name, $attribute = NULL) {
      return self::elem($name, $attribute);
    }

    public function getId() {
      return $this->element[$this->current]['id'];
    }

    public function getName() {
      return $this->element[$this->current]['name'];
    }

    public function regenId() {
      //var_dump($this->element[$this->current]);
      $last = $this->element[$this->current]; //ulozeni puvodniho obsahu
      $id = uniqid(); //vygenerovani id
      $this->current = $id; //nove global id
      $this->element[$this->current] = $last; //vraceni dat
      $this->element[$this->current]['id'] = $id; //prepis id
      return $this;
    }

    public function getArray() {
      return $this->element;
    }

    public function getArrayValue() {
      return $this->element[$this->current];
    }

    public function setText($text) {
      if (is_array($text)) {
        //TODO dodelat vkladani pole textu!
      } else {
        $id = uniqid();
        self::$stortext[$id] = $text;
        $this->element[$this->current]['content'][] = $id;
      }
      return $this;
    }

//TODO jeste appendy pred a za!

    const DEFAUTL = 0;
    const NOTHIG = 1;

//FIXME pridat druhy parametr ktery bude rozhodovat jake bude zalomeni: default/nothing
//pri zadnem zalomeni rekne ze vnitrni prvky aktualniho insertu se nesmi zalamovat!
//nebo to prenaset pres nejakou metodu???
    public function insert($elements, $break = self::DEFAUTL) {
      //TODO jak rozlisovat jestli jde element nebo text!!

      if (is_array($elements)) {
        foreach ($elements as $elem) {
          if (!empty($elem)) {
            if ($elem instanceof LightHtml && $this->isPairTag()) {
              self::$storelem += $elem->getArray();
              $this->element[$this->current]['content'][] = $elem->getId();
            }
          }
        }
      } else {
        if (!empty($elements)) {
          if ($elements instanceof LightHtml && $this->isPairTag()) { //kontoluje zda-li je aktualni tak parovy
            self::$storelem += $elements->getArray();
            $this->element[$this->current]['content'][] = $elements->getId();
          } else {
            echo sprintf('nelze vkladat do neparoveho tagu "%s" další tag "%s"!', $this->getName(), $elements->getName());
          }
        }
      }
      return $this;
    }

    private function pairTag($name) {
      $nopair = array('input', 'img', 'link', 'meta', 'br', 'hr');
      return !in_array($name, $nopair); //detekuje neparove tagy
    }

    private function isPairTag() {
      $nopair = array('input', 'img', 'link', 'meta', 'br', 'hr');
      return !in_array($this->element[$this->current]['name'], $nopair); //detekuje neparove tagy
    }

    private function makeBreak() {
      return (self::$break ? PHP_EOL : '');
    }

    private function makeZan() {
      $zan = self::$zan;
      return (!is_null($zan) ? str_repeat(' ', $zan * 2) : '');
    }

    private function incZan() {
      if (!is_null(self::$zan)) {
        self::$zan++;
      }
    }

    private function decZan() {
      if (!is_null(self::$zan)) {
        self::$zan--;
      }
    }

    public function render($content = NULL) {
      //print_r($this->element);
      $result = NULL;

      $elem = (is_null($content) ? $this->element[$this->current] : $content);
      //print_r($elem);
      //print_r(self::$storelem);
      //print_r(self::$stortext);

      $pair = $this->pairTag($elem['name']);
      $emptypair = ($pair && empty($elem['content']));

      $attribute = NULL;
      if (!empty($elem['attributes'])) {
        //TODO bude se vkladat pred: />

        //var_dump($elem['attributes']);
        //TODO ovladani zobrazovani, kdy NULL znamena nazobrazovat!
        foreach ($elem['attributes'] as $key => $value) {
          $type = gettype($value);
          var_dump($key, $value, $type);
          switch ($type) {
            case 'string':
              //
            break;
          }
        }

        //TODO dodelat generovani atributu!
      }

      $result .= sprintf('%s<%s%s%s>', $this->makeZan(), $elem['name'], $attribute, (!$pair ? ' /' : ''));

      $result .= (!$emptypair ? $this->makeBreak() : ''); //vkladani noveho radku

      foreach ($elem['content'] as $contentid) {
        //var_dump($contentid);

        $contentelem = (array_key_exists($contentid, self::$storelem) ? self::$storelem[$contentid] : NULL);
        $contenttext = (array_key_exists($contentid, self::$stortext) ? self::$stortext[$contentid] : NULL);

        if (!empty($contentelem)) {
          $this->incZan();  //pricitani zanoreni
          $result .= $this->render($contentelem); //rekurzini vykreslovani
          $this->decZan();  //vraceni zanoreni
        }

//TODO jednoho textu take nezalamonat!  a hlavne rozlisovt texty
        if (!empty($contenttext)) {
          $result .= $contenttext;
        }
      }

      if ($pair) {
        $result .= sprintf('%s</%s>%s', (!$emptypair ? $this->makeZan() : ''), $elem['name'], $this->makeBreak());
      }

      return $result;
    }

    public function __toString() {
      return $this->render();
    }
  }

  class ExceptionLightHtml extends Exception {}

?>
