<?php
/*
 * lighthtml.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 * prvni trida, ktera je vyvijena pomoci testu
 */

  namespace classes;

  use stdClass,
      Exception,
      Countable,
      classes\Core;

  class LightHtml implements Countable {
    const VERSION = 1.68;

    const br = '<br />';  //only xhtml
    const hr = '<hr />';

    private $elem = null;
    private static $elements = array();
    private static $xhtml = true;

    private static $zan = NULL;
    private static $break = false;

    const PREFIX = 'class:LightHtml:';  //prefix pro identifikaci objektu

    /**
     * hlavni privatni konstruktor
     *
     * @param name jmeno elementu
     */
    private function __construct($name) {
      $this->elem = new stdClass;
      $id = uniqid(self::PREFIX);
      $this->elem->id = $id;
      self::$elements[$id] = array('name' => $name,
                                  'attributes' => array(),
                                  'contents' => array(),
                                  );
    }

    /**
     * globalni ovladani renderovani vystupu
     *
     * @param state true pro zapnuti xhtml
     */
    public static function setXHTML($state) {
      self::$xhtml = $state;
    }

    /**
     * vraci stav renderu
     *
     * @return true pro zapnuty xhtml
     */
    public static function getXHTML() {
      return self::$xhtml;
    }

    /**
     * zapinani zalamovani a odsazovani
     *
     * @param state true pro zapnuti zalamovani
     */
    public static function setBreakDepth($state) {
      if ($state) {
        self::$zan = 0;
      } else {
        self::$zan = null;
      }
      self::$break = $state;
    }

    /**
     * vraci nazev aktualniho elementu
     *
     * @return jmeno elementu
     */
    public function getName() {
      return self::$elements[$this->elem->id]['name'];
    }

    /**
     * zjistuje jestli je uvnit content elementu nejaky obsah
     *
     * @return true pokud uvnit elementu neco je
     */
    public function isEmpty() {
      return (count(self::$elements[$this->elem->id]['contents']) == 0);
    }

    /**
     * vraci pocet content elementu
     *
     * @return pocet elementu
     */
    public function count() {
      return count(self::$elements[$this->elem->id]['contents']);
    }

    /**
     * vraceni hodnoty atrubutu
     *
     * @param attribute klic atributu
     * @return hodnota atributu
     */
    public function getAttribute($attribute) {
      return Core::isNull(self::$elements[$this->elem->id]['attributes'], $attribute);
    }

    /**
     * nastaveni hodnoty atributu
     *
     * @param attribute klic atributu
     * @param value hotnota atributu
     * @return this
     */
    public function setAttribute($attribute, $value) {
      if (!is_null($value)) {
        self::$elements[$this->elem->id]['attributes'][$attribute] = $value;
      }
      return $this;
    }

    /**
     * vraceni pole vsech atributu aktualniho prvku
     *
     * @return pole atributu
     */
    public function getAttributes() {
      return self::$elements[$this->elem->id]['attributes'];
    }

    /**
     * jednorazove nastaveni vsech atributu
     *
     * @param attributes pole atributu
     * @return this
     */
    public function setAttributes(array $attributes) {
      if (empty(self::$elements[$this->elem->id]['attributes'])) {
        self::$elements[$this->elem->id]['attributes'] = $attributes;
      } else {
        self::$elements[$this->elem->id]['attributes'] = array_merge(self::$elements[$this->elem->id]['attributes'], $attributes);
      }
      return $this;
    }

    /**
     * hlavni staticky konstruktor
     *
     * @param name jmeno elementu
     * @param attributes pole atributu
     * @return instance elementu
     */
    public static function element($name, array $attributes = null) {
      $elem = new self($name);
      if (!is_null($attributes)) {
        $elem->setAttributes($attributes);
      }
      return $elem;
    }

    /**
     * kratsi varianta konstruktoru k "element"
     *
     * @param name jmeno elementu
     * @param attributes
     * @return instance elementu
     */
    public static function e($name, array $attributes = null) {
      return self::element($name, $attributes);
    }

    /**
     * kratsi varianta konstruktoru k "element"
     * nette style
     *
     * @param name jmeno elementu
     * @param attributes pole atributu
     * @return instance elementu
     */
    public static function el($name, array $attributes = null) {
      return self::element($name, $attributes);
    }

    /**
     * kratsi varianta konstruktoru k "element"
     * geniv style
     *
     * @param name jmeno elementu
     * @param attributes pole atributu
     * @return instance elementu
     */
    public static function elem($name, array $attributes = null) {
      return self::element($name, $attributes);
    }

    /**
     * nejpohodlnejsi varianta konstruktoru
     * fakjahell
     *
     * @param method jmeno elementu (napr. __CLASS__::span() )
     * @param parameters pole atributu
     * @return instance elementu
     */
    public static function __callStatic($method, $parameters) {
      $attr = Core::isFill($parameters, 0, null); //atributy jsou nepovinne
      $result = self::element($method, $attr);
      return $result;
    }

    /**
     * easy vytvareni atrubutu pro elementy
     *
     * @param method jmeno atributu
     * @param parameters promenny pocet parametru atrubutu
     * @return this
     */
    public function __call($method, $parameters) {
      //var_dump('call: '.$method, $parameters);

      $value = null;

      $vsprintf_value = (!empty($parameters[1]) ? vsprintf($parameters[0], $parameters[1]) : $parameters[0]);

      switch ($method) {
        //attributes:
        case 'accept':
        case 'accept-charset':
        case 'accesskey':
        case 'action':
        case 'alt':
        case 'async':
        case 'autoplay':
        case 'autofocus':
        case 'autocomplete':  //on|off
        case 'border':
        //case 'challenge':
        case 'charset':
        case 'checked':
        case 'cols':
        case 'colspan':
        case 'coords':
        case 'controls':
        case 'content':
        case 'cite':
        case 'datetime':
        case 'defer':
        case 'default':
        //case 'data':
        case 'disabled':
        case 'dir':
        case 'draggable': //true|false|auto
        case 'enctype':
        case 'for':
        case 'form':
        case 'formaction':
        case 'formenctype':
        case 'formmethod':
        case 'formnovalidate':
        case 'formtarget':
        case 'headers':
        case 'height':
        case 'hreflang':
        case 'high':
        case 'http-equiv':
        case 'icon':
        case 'ismap':
        case 'keytype':
        case 'kind':
        case 'label':
        case 'low':
        case 'loop':
        case 'list':
        case 'manifest':
        case 'max':
        case 'maxlength':
        case 'media':
        case 'method':
        case 'min':
        case 'multiple':
        case 'muted':
        case 'name':
        case 'novalidate':
        case 'open':
        case 'optimum':
        case 'pattern':
        case 'placeholder':
        case 'points':
        case 'poster':
        case 'preload':
        case 'pubdate':
        case 'radiogroup':
        case 'readonly':
        case 'rel':
        case 'required':
        case 'reversed':
        case 'rows':
        case 'rowspan':
        case 'sandbox':
        case 'scope':
        case 'scoped':
        case 'seamless':
        case 'selected':
        case 'shape':
        case 'size':
        case 'sizes':
        case 'span':
        case 'src':
        case 'srcdoc':
        case 'srclang':
        case 'start':
        case 'step':
        case 'tabindex':
        case 'target':
        case 'type':
        case 'usemap':
        case 'version':
        case 'width':
        case 'wrap':
        case 'xmlns':
        //events:
        case 'onblur':
        case 'onchange':
        case 'onclick':
        case 'ondblclick':
        case 'ondrop':
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
          if (!is_null($parameters[0])) {
            $value = $parameters[0];
          }
        break;

        case 'srcpath':
          if (!is_null($parameters[0])) {
            $method = 'src';
            $value = Core::getUrl(array('path' => $parameters[0]));
          }
        break;

        case 'srchash':
          if (!is_null($parameters[0])) {
            $method = 'src';
            $mime = $parameters[0];
            $blob = Core::isFill($parameters, 1);
            if (empty($blob)) {
              if (file_exists($parameters[0])) {
                $o = getimagesize($parameters[0]);
                $mime = $o['mime'];
                $blob = file_get_contents($parameters[0]);
              } else {
                throw new ExceptionLightHtml('Unknown picture: '.$method);
              }
            }
            $value = sprintf('data:%s;base64,%s', $mime, base64_encode($blob));
          }
        break;

        case 'id':
        case 'title':
          if (!is_null($parameters[0])) {
            $value = $vsprintf_value;
          }
        break;

        case 'class':
          if (is_array($parameters[0])) {
            //predano jako pole
            foreach ($parameters[0] as $param) {
              //pruchod a dosazeni do value
              if (!is_null($param)) {
                $value[] = $param;
              }
            }
          } else {
            //predano jako text
            if (count($parameters) == 1) {
              //pokud ma jeden parametr
              if (!is_null($parameters[0])) {
                //kontrola jestli uz nejake atributy neobsahuje
                $attribute = $this->getAttribute($method);
                if (!empty($attribute)) {
                  //pokud je uz neco obsazeno tak scita pole
                  $value = array_merge(array($attribute), $parameters);
                } else {
                  //pokud je to prvni parametr
                  $value = $parameters[0];
                }
              }
            } else
            if (count($parameters) == 2) {
              //pokud ma dva parametry
              $value = $vsprintf_value;
            } else {
              throw new ExceptionLightHtml('Unknown format? for: '.$method);
            }
          }
        break;

        case 'style':
          if (!is_null($parameters[0])) {
            $value = Core::isEmpty(self::getAttribute('style'), null);
            if (count($parameters) == 1) {
              foreach ($parameters[0] as $k => $v) {
                if (!is_null($v)) {
                  $value[$k] = $v;
                }
              }
            } else
            if (count($parameters) == 2) {
              if (!is_null($parameters[1])) {
                $value[$parameters[0]] = $parameters[1];
              }
            } else {
              throw new ExceptionLightHtml('Unknown format? for: '.$method);
            }
          }
        break;

        case 'href':  //->href('url', array('k' => 'v', 'k' => 'v'))
          if (!is_null($parameters[0])) {
            $value = $parameters[0];
            //pokud neni prazdne pole v dalsim parametru
            if (!empty($parameters[1])) {
              $value = sprintf('%s?%s', $parameters[0], http_build_query($parameters[1], null, '&amp;'));
            }
          }
        break;

        case 'hrefpath':
          if (!is_null($parameters[0])) {
            $method = 'href';
            $conf = array('path' => $parameters[0],
                          'query' => Core::isFill($parameters, 1, null));
            $value = Core::getUrl($conf);
          }
        break;

        case 'hrefrewrite':
          if (!is_null($parameters[0])) {
            $method = 'href';
            $conf = array('path' => $parameters[0],
                          'query' => Core::isFill($parameters, 1, null),
                          'rewrite' => true,
                          'amp' => '/');
            $value = Core::getUrl($conf);
          }
        break;

        case 'value':
          if (!is_null($parameters[0])) {
            $value = htmlspecialchars($parameters[0], ENT_NOQUOTES);
          }
        break;

        case 'data':
          if (!is_null($parameters[1])) {
            $method .= '-'.$parameters[0];
            $value = $parameters[1];
          }
        break;

        default:
          throw new ExceptionLightHtml('Unknown attribute: '.$method);
        break;
      }
      //samotne nastaveni atributu
      $this->setAttribute($method, $value);

      return $this;
    }

    /**
     * vraceni unikatniho id elementu
     *
     * @return id elementu
     */
    public function getId() {
      return $this->elem->id;
    }

    /**
     * vraceni textu z aktualniho content elementu
     *
     * @return pole textu
     */
    public function getText() {
      $filter_text = function($text) {
        $c = __CLASS__;
        return (!empty($text) && !preg_match('/'.$c::PREFIX.'/', $text));
      };
      $html_special = function($text) { return html_entity_decode($text, ENT_QUOTES, 'UTF-8'); };
      return array_values(array_map($html_special, array_filter(self::$elements[$this->elem->id]['contents'], $filter_text)));
    }

    /**
     * vkladani textu do aktualniho content elementu
     *
     * @param text vkladany text, html tagy se prevadi na text
     * @param args nepovinny parametr pro vsprintf substituci
     * @return this
     */
    public function setText($text, $args = null) {
      if (is_array($text)) {
        $html_special = function($text) { return htmlspecialchars($text, ENT_NOQUOTES); };
        self::$elements[$this->elem->id]['contents'] = array_merge(self::$elements[$this->elem->id]['contents'], array_map($html_special, $text));
      } else {
        self::$elements[$this->elem->id]['contents'][] = htmlspecialchars((!is_null($args) ? vsprintf($text, $args) : $text), ENT_NOQUOTES);
      }
      return $this;
    }

    /**
     * vraceni textu jako html z aktualniho content elementu
     *
     * @return pole textu jako html
     */
    public function getHtml() {
      $filter_text = function($text) {
        $c = __CLASS__;
        return (!empty($text) && !preg_match('/'.$c::PREFIX.'/', $text));
      };
      return array_values(array_filter(self::$elements[$this->elem->id]['contents'], $filter_text));
    }

    /**
     * nastavovani textu jako html
     *
     * @param html vkladany text, html tagy se neprepisuji
     * @param args nepovinny parametr pro vsprintf substituci
     * @return this
     */
    public function setHtml($html, $args = null) {
      if (is_array($html)) {
        self::$elements[$this->elem->id]['contents'] = array_merge(self::$elements[$this->elem->id]['contents'], $html);
      } else {
        self::$elements[$this->elem->id]['contents'][] = (!is_null($args) ? vsprintf($html, $args) : (string) $html);
      }
      return $this;
    }

    /**
     * prida element za posledni vlozeny element obsahu
     * nette alias pro add
     *
     * @param content element nebo pole elementu pro vlozeni do obsahu
     * @return this
     */
    public function add($content) {
      if (is_array($content)) {
        $get_id = function($cont) { return $cont->getId(); };
        self::$elements[$this->elem->id]['contents'] = array_merge(self::$elements[$this->elem->id]['contents'], array_map($get_id, $content));
      } else {
        self::$elements[$this->elem->id]['contents'][] = $content->getId();
      }
      return $this;
    }

    /**
     * vlozeni elementu na urcitou ciselnou pozici
     * nette alias pro insert
     *
     * @param index pozice kam se ma vlozit element
     * @param content vkladany element nebo pole elementu
     * @param replace pri true nahradit element na indexu
     * @param replace_length pocet elementu na nahrazeni, null = pocet prvku v content
     * @return this
     */
    public function insert($index, $content, $replace = false, $replace_length = 1) {
      if (!is_int($index)) {
        throw new ExceptionLightHtml('is not a number!');
      }

      if (is_array($content)) {
        $get_id = function($cont) { return $cont->getId(); };
        $ctx = array_map($get_id, $content);
      } else {
        $ctx = $content->getId();
      } //0: vkladani, 1: nahrazeni 1 prvku
      $length = ($replace ? (!is_null($replace_length) ? $replace_length : count($ctx)) : 0);
      array_splice(self::$elements[$this->elem->id]['contents'], intval($index), $length, $ctx);
      return $this;
    }

    /**
     * overovani jestli je tag parovy
     *
     * @param name jmeno tagu
     * @return true pokud se jedna o parovy tag
     */
    private function isPairTag($name) {
      $tag = array('input', 'img', 'link', 'meta', 'br', 'hr', 'keygen',
                  'area', 'embed', 'source', 'base', 'col', 'param', 'isindex',
                  //'wbr', 'command'
                  );
      return !in_array($name, $tag); //detekuje neparove tagy
    }

    /**
     * overovani jesti se jedna o specialni atribut
     *
     * @param name jmeno atributu
     * @return true pokud se jedna o specialni atribut
     */
    private function isSpecialAttrubure($name) {
      $attr = array('checked', 'selected', 'multiple', 'required', 'disabled',
                    'readonly', 'autoplay', 'controls', 'loop', 'autofocus',
                    'formnovalidate', 'novalidate', 'seamless', 'reversed',
                    'async', 'defer', 'scoped', 'default', 'muted');
      return in_array($name, $attr); //detekuje neparove tagy
    }

    /**
     * vytvari strojove zalomeni
     *
     * @return EOL
     */
    private function makeBreak() {
      return (self::$break ? PHP_EOL : '');
    }

    /**
     * vytvari strojove odsazeni
     *
     * @return co zanoreni to ++2 mezery
     */
    private function makeZan() {
      $zan = self::$zan;
      return (!is_null($zan) ? str_repeat(' ', $zan * 2) : '');
    }

    /**
     * zvysovani zanoreni
     */
    private function incZan() {
      if (!is_null(self::$zan)) {
        self::$zan++;
      }
    }

    /**
     * snizovani zanoreni
     */
    private function decZan() {
      if (!is_null(self::$zan)) {
        self::$zan--;
      }
    }

    /**
     * overovani jestli je zanorovani zapnute
     *
     * @return true pokud je zapnute
     */
    private function isZan() {
      return !is_null(self::$zan);
    }

    /**
     * overuje jestli vlozeny text nebo pole/index je textem
     *
     * @param text vstupni text nebo pole
     * @param index ciselny index pro pole
     * @return true pokud se jedna o text
     */
    private function isText($text, $index = null) {
      if (!is_null($index)) {
        $_text = (!empty($text[0]) ? $text[0] : null);
      }
      return (bool) preg_match('/'.self::PREFIX.'/', $_text);
    }

    /**
     * hlavni generovani/renderovani elementu
     *
     * @param content pole elemtnu vyuzivane pri rekurzi
     * @return generovany html kod
     */
    public function render($content = null) {
      $result = '';

      //var_dump('render:', $this, self::$elements);

      $elem = (is_null($content) ? self::$elements[$this->elem->id] : $content);
      $name = $elem['name'];

//var_dump($elem);

      $pair = self::isPairTag($name);
//var_dump($pair);
      $attribute = null;
      $attributes = $elem['attributes'];
      if (!empty($attributes)) {

        //var_dump($attributes);

        $attr = array();
        foreach ($attributes as $key => $value) {
          $val = $value;

          switch (gettype($value)) {
            case 'array':
              //sluceni z pole
              switch ($key) {
                case 'class': //pri class
                  $val = implode(' ', $value);
                break;

                case 'style': //pri inline style
                  $implode = function($k, $v) { return sprintf('%s: %s', $k, $v); };
                  $val = implode('; ', array_map($implode, array_keys($value), $value));
                break;
              }
            break;
          }

          if (self::isSpecialAttrubure($key)) {
            if ($val) { //pokud je hodnota true
              $attr[] = (self::$xhtml ? sprintf(' %s="%s"', $key, $key) : ' '.$key);
            }
          } else {
            $attr[] = sprintf(' %s="%s"', $key, $val);
          }
        }
        $attribute = implode('', $attr);
      }

      $result .= sprintf('%s<%s%s%s>', self::makeZan(), $name, $attribute, ($pair ? '' : (self::$xhtml ? ' /' : '')));

      $contents = $elem['contents'];
      $emptypair = ($pair && empty($contents));

      //$result .= (!$emptypair && self::isText($contents, 0) ? $this->makeBreak() : '');

      $last = 'elem';
      if (!empty($contents)) {
        $poc = 0;
        foreach ($contents as $contentid) {
          $element = Core::isNull(self::$elements, $contentid, $contentid);
          if (is_array($element)) {

            $result .= (!$emptypair && $poc == 0 ? $this->makeBreak() : '');

            self::incZan(); //pricteni zanoreni
            $result .= self::render($element);
            self::decZan(); //odecteni zanoreni

            $last = 'elem';
          } else {
            $result .= $element;

            $last = 'text';
          }
          $poc++;
        }
      }

      if ($pair) {
        $result .= sprintf('%s</%s>%s', (!$emptypair && $last != 'text' ? self::makeZan() : ''), $name, self::makeBreak());
      }
      return $result;
    }

    /**
     * magicka metoda pro prime renderovani
     *
     * @return vygenerovany html kod
     */
    public function __toString() {
      return $this->render();
    }

    //ulozeni do souboru nebo vraceni resource
    /**
     * serializace obsahu tridy pro filesystemove preneseni
     *
     * @param path cesta pro cilovy souboru, nezdali se returnuje se
     * @return pokud neni path vraci se serializovany obsah, jinak vraci return po zapisu
     */
    public function save($path = null) {
      $save = array('elem' => $this->elem,
                    'elements' => self::$elements);

      $data = base64_encode(serialize($save));
      return (!is_null($path) ? file_put_contents($path, $data) : $data);
    }

    /**
     * deserializace obsahu souboru zpet na __CLASS__ objekt
     *
     * @param path nacteni ze souboru nebo ze zdroje
     * @return vytvoreny objekt
     */
    public static function load($path = null) {
      $data = null;
      if (file_exists($path)) {
        //pokud existuje soubor tak ho nacte
        $data = file_get_contents($path);
      } else {
        $data = unserialize(base64_decode($path));
      }
      $el = self::element('|');
      $el->elem = $data['elem'];
      $el::$elements = $data['elements'];
      return $el;
    }
  }

  class ExceptionLightHtml extends Exception {}

?>
