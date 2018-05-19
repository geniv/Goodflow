<?php
/*
 * html.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * html generator,
   * prvni trida, ktera byla vyvijena pomoci testu
   *
   * @deprecated
   * @package stable
   * @author geniv
   * @version 4.30
   */
  class Html implements \ArrayAccess, \Countable {

    // only xhtml
    const br = '<br />';
    const hr = '<hr />';

    private $elem_id = null;
    private $elem_depth = null;

    private static $elements = array();
    private static $xhtml = true;

    private static $zan = NULL;
    private static $break = false;

    const PREFIX = 'class:Html:';  //prefix pro identifikaci objektu
    const NOTE = 'note';  //klasicke poznamky
    const NOTE_IF = 'noteif'; //poznamky s podminkou

    //konstanty implicitnich hodnot pro elementy
    private static $implicitAttribure = array(
                      'img' => array('alt' => ''),
                    );

    /**
     * defaultni privatni konstruktor
     *
     * @since 4.00
     * @param string name jmeno elementu
     * @param int depth hloubka zanoreni
     */
    private function __construct($name, $depth = 0) {
      $id = uniqid(self::PREFIX);

      $this->elem_id = $id;
      $this->elem_depth = $depth; // instancni zanorovani

      self::$elements[$id] = array('name' => $name, //jmeno elementu
                                  'instance' => $this,  //vlastni instance tridy
                                  'attributes' => array(),  //atributy elementu
                                  'contents' => array(),  //obsah elementu
                                  );
    }

    /**
     * globalni ovladani renderovani vystupu
     *
     * @since 4.00
     * @param bool state true pro zapnuti xhtml
     * @return void
     */
    public static function setXHTML($state) {
      self::$xhtml = $state;
    }

    /**
     * vraci stav renderu
     *
     * @since 4.00
     * @param void
     * @return bool true pro zapnuty xhtml
     */
    public static function getXHTML() {
      return self::$xhtml;
    }

    /**
     * zapinani zalamovani a odsazovani
     *
     * @since 4.00
     * @param bool state true pro zapnuti zalamovani
     * @return void
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
     * overovani jestli je zanorovani zapnute
     *
     * @since 4.00
     * @param void
     * @return bool true pokud je zapnute
     */
    public static function getBreakDepth() {
      return !is_null(self::$zan);
    }

    /**
     * vraci nazev aktualniho elementu
     *
     * @since 4.00
     * @param void
     * @return string jmeno elementu
     */
    public function getName() {
      return self::$elements[$this->elem_id]['name'];
    }

    /**
     * zjistuje jestli je uvnit content elementu nejaky obsah
     *
     * @since 4.00
     * @param void
     * @return bool true pokud uvnit elementu neco je
     */
    public function isEmpty() {
      return (count(self::$elements[$this->elem_id]['contents']) == 0);
    }

    /**
     * vraceni hodnoty atrubutu
     *
     * @since 4.00
     * @param string attribute klic atributu
     * @return mixed hodnota atributu
     */
    public function getAttribute($attribute) {
      //return Core::isNull(self::$elements[$this->elem->id]['attributes'], $attribute);
      return (isset(self::$elements[$this->elem_id]['attributes'][$attribute]) ? self::$elements[$this->elem_id]['attributes'][$attribute] : '');
    }

    /**
     * nastaveni hodnoty atributu
     *
     * @since 4.00
     * @param string attribute klic atributu
     * @param mixed value hotnota atributu
     * @return this
     */
    public function addAttribute($attribute, $value) {
      if (!is_null($value)) {
        self::$elements[$this->elem_id]['attributes'][$attribute] = $value;
      }
      return $this;
    }

    /**
     * nastaveni hodnoty atributu
     * alias pro: addAttribute()
     *
     * @since 4.00
     * @param string attribute klic atributu
     * @param mixed value hotnota atributu
     * @return this
     */
    public function setAttribute($attribute, $value) {
      return $this->addAttribute($attribute, $value);
    }

    /**
     * vraceni pole vsech atributu aktualniho prvku
     *
     * @since 4.00
     * @param void
     * @return array pole atributu
     */
    public function getAttributes() {
      return self::$elements[$this->elem_id]['attributes'];
    }

    /**
     * jednorazove nastaveni vsech atributu
     *
     * @since 4.00
     * @param array attributes pole atributu
     * @return this
     */
    public function setAttributes(array $attributes) {
      //filtruje hodnoty ktere nejsou null
      $func_filter = function($row) { return !is_null($row); };
      if (empty(self::$elements[$this->elem_id]['attributes'])) {
        self::$elements[$this->elem_id]['attributes'] = array_filter($attributes, $func_filter);
      } else {
        self::$elements[$this->elem_id]['attributes'] = array_merge(self::$elements[$this->elem_id]['attributes'], array_filter($attributes, $func_filter));
      }
      return $this;
    }

    /**
     * hlavni staticky konstruktor
     * - tovarni metoda
     *
     * @since 4.00
     * @param string name jmeno elementu
     * @param array|null attributes pole atributu
     * @return Html instance elementu
     */
    public static function element($name, array $attributes = null) {
      $depth = 0;
      if (isset($attributes['depth'])) { //zruseni atributu
        $depth = $attributes['depth'];  //prenos zanoreni pro instantci z atributu
        unset($attributes['depth']);
      }
      $elem = new self($name, $depth);  //vytvoreni instance elementu
      //nastavovani atributu elementu
      if (!is_null($attributes)) {
        $elem->setAttributes($attributes);
      }
      //aplikace implicitnich atributu elementu
      if (!empty(self::$implicitAttribure[$name])) {
        $elem->setAttributes(self::$implicitAttribure[$name]);
      }
      return $elem;
    }

    /**
     * kratsi varianta konstruktoru k "element"
     * - tovarni metoda
     *
     * @since 4.00
     * @param string name jmeno elementu
     * @param array|null attributes
     * @return Html instance elementu
     */
    public static function e($name, array $attributes = null) {
      return self::element($name, $attributes);
    }

    /**
     * kratsi varianta konstruktoru k "element"
     * - nette style
     * - toavrni metoda
     *
     * @since 4.00
     * @param string name jmeno elementu
     * @param array|null attributes pole atributu
     * @return Html instance elementu
     */
    public static function el($name, array $attributes = null) {
      return self::element($name, $attributes);
    }

    /**
     * kratsi varianta konstruktoru k "element"
     * - geniv style
     * - tovarni metoda
     *
     * @since 4.00
     * @param string name jmeno elementu
     * @param array|null attributes pole atributu
     * @return Html instance elementu
     */
    public static function elem($name, array $attributes = null) {
      return self::element($name, $attributes);
    }

    /**
     * nejpohodlnejsi varianta konstruktoru
     * - fakjahell
     * - tovarni metoda, pro staticke volani
     *
     * @since 4.00
     * @param string method jmeno elementu (napr. __CLASS__::span() )
     * @param array|null parameters pole atributu
     * @return Html instance elementu
     */
    public static function __callStatic($method, $parameters) {
      $attr = (isset($parameters[0]) ? $parameters[0] : null);  // atributy jsou nepovinne
      if ($method == self::NOTE_IF) {
        if (!empty($attr) && is_string($attr)) {
          //pokud je text vlozi jako pole (noteif)
          $attr = array('condition' => $attr);
        } else {
          throw new ExceptionHtml('neni zadan parametr s podminkou, napr.: IE=6');
        }
      }
      $result = self::element($method, $attr);
      return $result;
    }

    /*
     * magic methods
     */

    /**
     * vrati hodnotu atributu
     *
     * @since 4.00
     * @param string name nazev atributu
     * @return mixed &hodnota atributu, prenasi instanci pro editovani
     */
    public function &__get($name) {
      return self::$elements[$this->elem_id]['attributes'][$name];
    }

    /**
     * nastavi hodnotu atributu
     *
     * @since 4.00
     * @param string name nazev atributu
     * @param mixed value hodnota atributu
     * @return void
     */
    public function __set($name, $value) {
      self::$elements[$this->elem_id]['attributes'][$name] = $value;
    }

    /**
     * overi jestli atribut existuje
     *
     * @since 4.00
     * @param string name nazev atributu
     * @return bool true pokud atribut existuje
     */
    public function __isset($name) {
      return isset(self::$elements[$this->elem_id]['attributes'][$name]);
    }

    /**
     * zruseni atributu
     *
     * @since 4.00
     * @param string name nazev atributu
     * @return void
     */
    public function __unset($name) {
      unset(self::$elements[$this->elem_id]['attributes'][$name]);
    }

    /**
     * easy vytvareni atrubutu pro elementy
     *
     * @since 4.00
     * @param string method jmeno atributu
     * @param array parameters promenny pocet parametru atrubutu
     * @return this
     */
    public function __call($method, $parameters) {
      //var_dump('call: '.$method, $parameters);

      $value = null;

      $vsprintf_value = (!empty($parameters[1]) ? vsprintf($parameters[0], $parameters[1]) : (isset($parameters[0]) ? $parameters[0] : null));

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
        case 'lang':
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
//TODO zadelat do testu!!!
        //angularjs:  (http://docs.angularjs.org/api/)
        case 'ng_app':
        case 'ng_bind':
        case 'ng_bind_html_unsafe':
        case 'ng_bind_template':
        case 'ng_change':
        case 'ng_checked':
        case 'ng_controller':
        case 'ng_class':
        case 'ng_class_even':
        case 'ng_class_odd':
        case 'ng_click':
        case 'ng_cloak':
        case 'ng_csp':
        case 'ng_dblclick':
        case 'ng_disabled':
        case 'ng_false_value':
        case 'ng_form':
        case 'ng_hide':
        case 'ng_href':
        case 'ng_include':
        case 'ng_init':
        case 'ng_keydown':
        case 'ng_keypress':
        case 'ng_keyup':
        case 'ng_list':
        case 'ng_maxlength':
        case 'ng_minlength':
        case 'ng_model':
        case 'ng_mousedown':
        case 'ng_mouseenter':
        case 'ng_mouseleave':
        case 'ng_mousemove':
        case 'ng_mouseover':
        case 'ng_mouseup':
        case 'ng_multiple':
        case 'ng_non_bindable':
        case 'ng_options':
        case 'ng_pattern':
        case 'ng_pluralize':
        case 'ng_readonly':
        case 'ng_repeat':
        case 'ng_required':
        case 'ng_selected':
        case 'ng_show':
        case 'ng_src':
        case 'ng_style':
        case 'ng_submit':
        case 'ng_switch':
        case 'ng_switch_when':
        case 'ng_switch_default':
        case 'ng_transclude':
        case 'ng_true_value':
        case 'ng_view':
          $method = str_replace(array('ng_', '_'), array('ng-', '-'), $method); // uprava nazvu
          if (!is_null($parameters[0])) {
            $value = $parameters[0];
          } else {
            $value = '__null';
          }
        break;

        case 'onconfirm':
        case 'onConfirm':
          if (!is_null($parameters[0])) {
            $method = 'onclick';
            $value = sprintf('return confirm(\'%s\');', $vsprintf_value);
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
            $blob = (isset($parameters[1]) ? $parameters[1] : '');
            if (empty($blob)) {
              if (file_exists($parameters[0])) {
                $o = getimagesize($parameters[0]);
                $mime = $o['mime'];
                $blob = file_get_contents($parameters[0]);
              } else {
                throw new ExceptionHtml('Unknown picture: '.$method);
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
              throw new ExceptionHtml('Unknown format? for: '.$method);
            }
          }
        break;

        case 'style': //->style(array('a' => b, ...))->style('a: b')->style('a', b)
          if (!is_null($parameters[0])) {
            $value = Core::isEmpty(self::getAttribute('style'), null);
            if (count($parameters) == 1) {
              //pokud je vlozeno jako pole
              if (is_array($parameters[0])) {
                foreach ($parameters[0] as $k => $v) {
                  if (!is_null($v)) {
                    $value[$k] = $v;
                  }
                }
              } else {
                //pokud je vlozeno jako jeden text
                $e = explode(':', $parameters[0]);
                $value[trim($e[0])] = trim($e[1]);
              }
            } else
            if (count($parameters) == 2) {
              if (!is_null($parameters[1])) {
                $value[$parameters[0]] = $parameters[1];
              }
            } else {
              throw new ExceptionHtml('Unknown format? for: '.$method);
            }
          }
        break;

        case 'href':  //->href('url', array('k' => 'v', 'k' => 'v'))
          if (isset($parameters[0])) {
            $value = $parameters[0];
            //pokud neni prazdne pole v dalsim parametru
            if (!empty($parameters[1])) {
              $value = sprintf('%s?%s', $parameters[0], http_build_query($parameters[1], null, '&amp;'));
            }
          } else {
            $value = '#';
          }
        break;
//FIXME is_null neprenese neidentifokovany index!!!! opravit na isset!!!!
        case 'hrefpath':
          if (!is_null($parameters[0])) {
            $method = 'href';
            $conf = array('path' => $parameters[0],
                          'query' => (isset($parameters[1]) ? $parameters[1] : null));
            $value = Core::getUrl($conf);
          }
        break;

        case 'hrefrewrite':
          if (!is_null($parameters[0])) {
            $method = 'href';
            $conf = array('path' => $parameters[0],
                          'query' => (isset($parameters[1]) ? $parameters[1] : null),
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
          throw new ExceptionHtml('Unknown attribute: '.$method);
        break;
      }
      //pridani atributu
      $this->addAttribute($method, $value);
      return $this;
    }

    /**
     * vraceni unikatniho id elementu
     *
     * @since 4.00
     * @param void
     * @return string id elementu
     */
    public function getId() {
      return $this->elem_id;
    }

    /**
     * vraceni textu z aktualniho content elementu
     * provadi: html_entity_decode
     *
     * @since 4.00
     * @param void
     * @return array pole textu
     */
    public function getText() {
      $prefix = self::PREFIX;
      $filter_text = function($text) use ($prefix) {
        return (!empty($text) && !preg_match('/'.$prefix.'/', $text));
      };
      $html_special = function($text) { return html_entity_decode($text, ENT_QUOTES, 'UTF-8'); };
      return array_values(array_map($html_special, array_filter(self::$elements[$this->elem_id]['contents'], $filter_text)));
    }

    /**
     * vkladani textu do aktualniho content elementu
     *
     * @since 4.00
     * @param string text vkladany text, html tagy se prevadi na text
     * @param array|null args nepovinny parametr pro vsprintf substituci
     * @return this
     */
    public function setText($text, $args = null) {
      if (!is_null($text)) {
        if (is_array($text)) {
          $html_special = function($text) { return htmlspecialchars($text, ENT_NOQUOTES); };
          self::$elements[$this->elem_id]['contents'] = array_merge(self::$elements[$this->elem_id]['contents'], array_map($html_special, $text));
        } else {
          self::$elements[$this->elem_id]['contents'][] = htmlspecialchars((!is_null($args) ? vsprintf($text, $args) : $text), ENT_NOQUOTES);
        }
      }
      return $this;
    }
//TODO dosat testy!!!
    /**
     * vycisti text
     *
     * @since 4.00
     * @param void
     * @return this
     */
    public function clearText() {
      $prefix = self::PREFIX;
      $filter_text = function($text) use ($prefix) {
        return (!empty($text) && preg_match('/'.$prefix.'/', $text));
      };
      //vyfiltruje elementry a vrati je do kontextu
      self::$elements[$this->elem_id]['contents'] = array_filter(self::$elements[$this->elem_id]['contents'], $filter_text);
      return $this;
    }

    /**
     * vraceni textu jako html z aktualniho content elementu, cisty text bez konverze
     *
     * @since 4.00
     * @param void
     * @return array pole textu jako html
     */
    public function getHtml() {
      $prefix = self::PREFIX;
      $filter_text = function($text) use ($prefix) {
        return (!empty($text) && !preg_match('/'.$prefix.'/', $text));
      };
      return array_values(array_filter(self::$elements[$this->elem_id]['contents'], $filter_text));
    }

    /**
     * nastavovani textu jako html
     *
     * @since 4.00
     * @param string html vkladany text, html tagy se neprepisuji
     * @param array|null args nepovinny parametr pro vsprintf substituci
     * @return this
     */
    public function setHtml($html, $args = null) {
      if (!is_null($html)) {
        if (is_array($html)) {
          self::$elements[$this->elem_id]['contents'] = array_merge(self::$elements[$this->elem_id]['contents'], $html);
        } else {
          self::$elements[$this->elem_id]['contents'][] = (!is_null($args) ? vsprintf($html, $args) : (string) $html);
        }
      }
      return $this;
    }

    /**
     * prida element za posledni vlozeny element obsahu
     * - nette alias pro add
     *
     * @since 4.00
     * @param Html|array content element nebo pole elementu pro vlozeni do obsahu (i vice parametru)
     * @return this
     */
    public function add($content) {
      if (func_num_args() > 1) { $content = func_get_args(); }  //podpora vice argumentu

      if (is_array($content)) {
        $get_id = function($cont) {
          if (!is_null($cont)) {
            if ($cont instanceof Html) {
              return $cont->getId();
            } else {
              throw new ExceptionHtml('content neni instanci teto tridy!');
            }
          }
        };
        self::$elements[$this->elem_id]['contents'] = array_merge(self::$elements[$this->elem_id]['contents'], array_map($get_id, $content));
      } else {
        if (!is_null($content)) {
          if ($content instanceof Html) {
            self::$elements[$this->elem_id]['contents'][] = $content->getId();
          } else {
            throw new ExceptionHtml('content neni instanci teto tridy!');
          }
        }
      }
      return $this;
    }

    /**
     * vlozeni elementu na urcitou ciselnou pozici
     * - nette alias pro insert
     *
     * @since 4.00
     * @param int index pozice kam se ma vlozit element
     * @param array|Html content vkladany element nebo pole elementu
     * @param bool replace pri true nahradit element na indexu
     * @param int replace_length pocet elementu na nahrazeni, null = pocet prvku v content
     * @return this
     */
    public function insert($index, $content, $replace = false, $replace_length = 1) {
      if (!is_int($index)) {
        throw new ExceptionHtml('is not a number!');
      }

      if (is_array($content)) {
        $get_id = function($cont) { return $cont->getId(); };
        $ctx = array_map($get_id, $content);
      } else {
        $ctx = $content->getId();
      } //0: vkladani, 1: nahrazeni 1 prvku
      $length = ($replace ? (!is_null($replace_length) ? $replace_length : count($ctx)) : 0);
      array_splice(self::$elements[$this->elem_id]['contents'], intval($index), $length, $ctx);
      return $this;
    }

    /**
     * overovani jestli je tag parovy
     *
     * @since 4.00
     * @param string name jmeno tagu
     * @return bool true pokud se jedna o parovy tag
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
     * @since 4.00
     * @param string name jmeno atributu
     * @return bool true pokud se jedna o specialni atribut
     */
    private static function isSpecialAttrubure($name) {
      $attr = array('checked', 'selected', 'multiple', 'required', 'disabled',
                    'readonly', 'autoplay', 'controls', 'loop', 'autofocus',
                    'formnovalidate', 'novalidate', 'seamless', 'reversed',
                    'async', 'defer', 'scoped', 'default', 'muted');
      return in_array($name, $attr); //detekuje neparove tagy
    }

    /**
     * jde o tag AngularJS?
     *
     * @since 4.20
     * @param string name nazev klice
     * @return bool true pokud jde o angular tag
     */
    private static function isAnguralJS($name) {
      return (bool) preg_match('/^ng-/', $name);
    }

    /**
     * vytvari strojove zalomeni
     *
     * @since 4.00
     * @param void
     * @return string EOL
     */
    private function makeBreak() {
      return (self::$break ? PHP_EOL : '');
    }

    /**
     * vytvari strojove odsazeni
     *
     * @since 4.00
     * @param int depth manualni zvetsovani zanoreni
     * @return string co zanoreni to ++2 mezery
     */
    private function makeZan($depth) {
      $zan = self::$zan + $depth;
      return (!is_null($zan) ? str_repeat(' ', $zan * 2) : '');
    }

    /**
     * zvysovani zanoreni
     *
     * @since 4.00
     * @param void
     * @return void
     */
    private function incZan() {
      if (!is_null(self::$zan)) {
        self::$zan++;
      }
    }

    /**
     * snizovani zanoreni
     *
     * @since 4.00
     * @param void
     * @return void
     */
    private function decZan() {
      if (!is_null(self::$zan)) {
        self::$zan--;
      }
    }

    /**
     * vraci hodnotu aktualniho zanoreni
     *
     * @since 4.00
     * @param void
     * @return int hodnota zanoreni
     */
    public function getDepth() {
      //~ return self::$zan;
      return $this->elem_depth;
    }

    /**
     * nastavuje novou hodnotu zanoreni
     *
     * @since 4.00
     * @param int depth nova hodnota zanoreni
     * @return this
     */
    public function setDepth($depth) {
      if (!is_null($depth)) {
        //~ self::$zan = $depth;
        $this->elem_depth = $depth;
      }
      return $this;
    }

    /**
     * overuje jestli vlozeny text nebo pole/index je textem
     *
     * @since 4.00
     * @param string text vstupni text nebo pole
     * @param int index ciselny index pro pole
     * @return bool true pokud se jedna o text
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
     * @since 4.00
     * @param Html|null content pole elemtnu vyuzivane pri rekurzi
     * @return string generovany html kod
     */
    public function render($content = null) {
      $result = '';

      //var_dump('render:', $this, self::$elements);

      $elem = (is_null($content) ? self::$elements[$this->elem_id] : $content);
      $name = $elem['name'];

      //detekce komentaru a podminenych komentaru
      $isNote = ($name == self::NOTE);
      $isNoteIf = ($name == self::NOTE_IF);

      $pair = $this->isPairTag($name);
//var_dump($pair);
      $attribute = null;
      $attributes = $elem['attributes'];
      //pokud neni prazdny atribut a nejedna se o komentar
      if ($attributes && !$isNote) {  //!empty()

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
          } else
          if (self::isAnguralJS($key)) {
            $attr[] = ' ' . $key . ($val && $val != '__null' ? '="' . $val . '"' : '');
          } else {
            $attr[] = sprintf(' %s="%s"', $key, $val);
          }
        }
        $attribute = implode('', $attr);
      }

      //obsluha podminenych komentaru
      $noteCondition = null;
      if ($isNoteIf) {
        $condition = $attributes['condition'];
        //vyhodnoceni negace
        $exc = explode('!', $condition);
        if (count($exc) > 1) {
          $condition = '!('.implode('', $exc).')';
        }
        //vyhodnoceni and
        $and = explode('&', $condition);
        if (count($and) > 1) {
          $trim_func = function($val) { return trim($val); };
          $condition = '('.implode(')&(', array_map($trim_func, $and)).')';
        }
        //vyhodnoceni or
        $or = explode('|', $condition);
        if (count($or) > 1) {
          $trim_func = function($val) { return trim($val); };
          $condition = '('.implode(')|(', array_map($trim_func, $or)).')';
        }

        $in = array('IE<=', 'IE>=', 'IE<', 'IE>', '=');
        $out = array ('lte IE ', 'gte IE ', 'lt IE ', 'gt IE ', ' ');
        $noteCondition = str_replace($in, $out, $condition);
      }

      $makeZan = $this->makeZan($this->elem_depth);  // aplikace instancniho zanorovani
      $makeBreak = $this->makeBreak();

      $result .= $makeZan.((!$isNote && !$isNoteIf) ? sprintf('<%s%s%s>', $name, $attribute, ($pair ? '' : (self::$xhtml ? ' /' : ''))) : ($isNoteIf ? '<!--[if '.$noteCondition.']>' : '<!-- '));

      $contents = $elem['contents'];
      $emptypair = ($pair && empty($contents));

      //~ $result .= (!$pair && empty($contents) ? $makeBreak : '');  //neparovy tag + prazdny obsah

      //$result .= (!$emptypair && self::isText($contents, 0) ? $this->makeBreak() : '');

      $last = 'elem';
      if (!empty($contents)) {
        foreach ($contents as $index => $contentid) {
          //$element = Core::isNull(self::$elements, $contentid, $contentid);
          $element = (isset(self::$elements[$contentid]) ? self::$elements[$contentid] : $contentid);
          if (is_array($element)) {
            $result .= (!$emptypair && $index == 0 ? $makeBreak : '');

            $this->incZan(); //pricteni zanoreni
            $result .=  $this->render($element).$makeBreak;
            $this->decZan(); //odecteni zanoreni

            $last = 'elem';
          } else {
            $result .= $element;

            $last = 'text';
          }
        }
      }

      if ($pair) {
        $result .= (!$emptypair && $last != 'text' ? $makeZan : '').((!$isNote && !$isNoteIf) ? sprintf('</%s>', $name) : ($isNoteIf ? '<![endif]-->' : ' -->'));//.$makeBreak;
      }
      return $result;
    }

    /**
     * magicka metoda pro prime renderovani
     *
     * @since 4.00
     * @param void
     * @return string vygenerovany html kod
     */
    public function __toString() {
      return $this->render();
    }

    //ulozeni do souboru nebo vraceni resource
    /**
     * serializace obsahu tridy pro filesystemove preneseni
     *
     * @since 4.00
     * @param string|null path cesta pro cilovy souboru, nezdali se returnuje se
     * @return bool pokud neni path vraci se serializovany obsah, jinak vraci return po zapisu
     */
    public function save($path = null) {
      $save = array('elem_id' => $this->elem_id,
                    'elem_depth' => $this->elem_depth,
                    'elements' => self::$elements);

      $data = base64_encode(serialize($save));
      return (!is_null($path) ? file_put_contents($path, $data) : $data);
    }

    /**
     * deserializace obsahu souboru zpet na __CLASS__ objekt
     *
     * @since 4.00
     * @param string|null path nacteni ze souboru nebo ze zdroje
     * @return Html vytvoreny objekt
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
      $el->elem_id = $data['elem_id'];
      $el->elem_depth = $data['elem_depth'];
      $el::$elements = $data['elements'];
      return $el;
    }

    /**
     * vraci pole instanci potomku
     *
     * @since 4.00
     * @param void
     * @return array pole instanci potomku
     */
    public function getChildren() {
      $prefix = self::PREFIX;
      $filter_html = function($item) use ($prefix) {
        return preg_match('/'.$prefix.'/', $item);
      };
      $contents = array_values(array_filter(self::$elements[$this->elem_id]['contents'], $filter_html));
      // po tom co se nycte seznam dedi jeste se musi prepsat do vlastnich instanci
      $elements = self::$elements;
      $callback = function($id) use ($elements) {
        return $elements[$id]['instance'];
      };
      return array_map($callback, $contents);
    }

    /**
     * nacteni objektu elementu podle id elementu
     *
     * @since 4.00
     * @param string id id elementu s html prefixem
     * @return mixed objekt html tridy
     */
    public static function getElementById($id) {
      return self::$elements[$id]['instance'];
    }

    /*
     * \ArrayAccess
     */

    /**
     * overovani existence offsetu pole
     *
     * @since 4.00
     * @param string offset index pole
     * @return bool true pokud index existuje
     */
    public function offsetExists($offset) {
      return isset(self::$elements[$this->elem_id]['contents'][$offset]);
    }

    /**
     * nacitani obsahu zadaneho indexu
     *
     * @since 4.00
     * @param string offset index pole
     * @return midex instance pole
     */
    public function offsetGet($offset) {
      $id = self::$elements[$this->elem_id]['contents'][$offset];
      return self::$elements[$id]['instance'];
    }

    /**
     * nastavovani obsahu zadaneho indexu
     *
     * @since 4.00
     * @param string|null offset index pole, null pri []
     * @param mixed value novy element pro vlozeni
     * @return void
     */
    public function offsetSet($offset, $value) {
      if (!is_null($offset)) {
        $this->insert($offset, $value, true);
      } else {
        $this->add($value);
      }
    }

    /**
     * ruseni indexu pole
     *
     * @since 4.00
     * @param string offset index pole
     * @return void
     */
    public function offsetUnset($offset) {
      unset(self::$elements[$this->elem_id]['contents'][$offset]);
    }

    /*
     * \Countable
     */

    /**
     * vraci pocet content elementu
     *
     * @since 4.00
     * @param void
     * @return int pocet elementu
     */
    public function count() {
      return count(self::$elements[$this->elem_id]['contents']);
    }
  }


  /**
   * trida vyjimky pro Html
   *
   * @package stable
   * @author geniv
   * @version 1.00
   */
  class ExceptionHtml extends \Exception {}