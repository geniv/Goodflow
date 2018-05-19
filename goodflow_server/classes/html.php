<?php
/*
 *      html.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use classes\Core,
      stdClass,
      Exception;

  class Html {
    const VERSION = 2.46;

    const NOTE_NORMAL = 'note';
    const NOTE_IF = 'ifnote';
    const PLAIN_TEXT = 'text';

    const LIST_NORMAL = 'normal';
    const LIST_NOODLE = 'noodle';

    const br = '<br />';

    private $element;
    private static $template; //na prenaseni template
    private static $type_list;

/**
 * Konstruktor html elementu
 *
 * @sinve 1.0
 * @method public __construct
 * @param string name
 */
    public function __construct($name) {
      $this->element = new stdClass;
      $this->element->name = NULL;
      $this->element->attributes = array();
      $this->element->content = array();
      $this->element->note = false;
      $this->element->zan = 0;
      $this->element->break = PHP_EOL;
      //$this->element->replchar = array('{', '}'); //defaultni substitucni znaky
      $this->element->plaintext = false;
      $this->element->id = uniqid();
      $this->setName($name);
    }
//typ Html:text() je dost nevyspatatalna!
//metoda pro ulehceni zapisu, napr: Html::elem('div'[, array()]) <=> Html::div([array()])
    public static function __callStatic($method, $parameters) {
      $attr = Core::isFill($parameters, 0, NULL);
      $result = self::elem($method, $attr);
      return $result;
    }

/*
    public static function br() {
      //
    }
*/
    /**
     *
     * Overloading html elements
     *
     * @param name string
     * @param values array
     * @return mixed
     */
    public function __call($name, $values) {
      try {
//TODO pridat systemovy atribut: visible => bude se starat o skryvani html prvku

        $value = NULL;
        $vsprintf_value = (!empty($values[1]) ? vsprintf($values[0], $values[1]) : $values[0]);
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
          //case 'title': //titulek (input,href, metet apod.)
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
          case 'colspan': //BUGFIX
          case 'rowspan':
          case 'media': //od css
          case 'rel': //propojovani s JS a pod.
          case 'min': //html5 number
          case 'max': //html5 number
          case 'step':  //html5 number
          case 'low':   //html5 nissi hodnota <meter>
          case 'high':  //html5 vyssi hodnota <meter>
          case 'required':  //html5 povinne
          //case 'onresize':
            if (!is_null($values[0])) { //musi testovat na NULL, vkladani prazdne ale ne NULL
              $value = $values[0];
            }
          break;

          case 'title': //titulek (input,href, metet apod.)
            if (!is_null($values[0])) { //musi testovat na NULL, vkladani prazdne ale ne NULL
              if (!empty($values[1])) {
                $value = vsprintf($values[0], $values[1]);
              } else {
                $value = $values[0];
              }
            }
          break;

          case 'onconfirm': //pro automaticke dosazeni return confirm
            if (!is_null($values[0])) { //musi testovat na NULL, vkladani prazdne ale ne NULL
              $name = 'onclick';
              $value = sprintf('return confirm(\'%s\');', $vsprintf_value);
            }
          break;

          case 'onalert':
            if (!is_null($values[0])) { //musi testovat na NULL, vkladani prazdne ale ne NULL
              $name = 'onclick';
              $value = sprintf('return alert(\'%s\');', $vsprintf_value);
            }
          break;

          case 'id':  //atribut id ->id('text')->id('text %s', 'subst')->id('test %s %s', array('su', 'bst'))
            if (!is_null($values[0])) {
              $value = $vsprintf_value;
            }
          break;

          case 'class':   //->class('a')->class(array('a', 'b'))->class('text %s', 'subst')->class('text %s %s', array('sub', 'st'))
            if (is_array($values[0])) { //pokud je pole
              if (!empty($this->element->attributes[$name])) {
                $value = $this->element->attributes[$name];
                foreach ($values[0] as $val) {
                  if (!is_null($val)) { //vyhazovani NULL polozek
                    $value[] = $val;
                  }
                }
              } else {
                foreach ($values[0] as $val) {  //pri prvni polozce
                  if (!is_null($val)) { //vyhazovani NULL polozek
                    $value[] = $val;
                  }
                }
              }
            } else {  //pokud je text
              if (!empty($this->element->attributes[$name])) {
                if (!is_null($values[0])) { //vyhazovani NULL polozek
                  $value = array_merge($this->element->attributes[$name], (array) $vsprintf_value);  //bere jen values[0] konvertovane na array
                } else {
                  $value = $this->element->attributes[$name]; //vracet value
                }
              } else {
                if (!is_null($values[0])) { //vyhazovani NULL polozek
                  $value[] = (!empty($values[1]) ? vsprintf($values[0], $values[1]) : $values[0]);  //pri prvni polozce v rade
                }
              }
            }
          break;

          case 'style': //->style('k', 'v')->style(array('k' => 'v', 'k' => 'v'))
            if (is_array($values[0])) {
              if (!empty($this->element->attributes[$name])) {
                $value = $this->element->attributes[$name];
                foreach ($values[0] as $idx => $val) {
                  if (!is_null($val)) { //vyhazovani NULL polozek
                    $value[$idx] = $val;
                  }
                }
              } else {
                foreach ($values[0] as $idx => $val) {  //pri prvni polozce v rade
                  if (!is_null($val)) { //vyhazovani NULL polozek
                    $value[$idx] = $val;
                  }
                }
              }
            } else {
              if (!empty($this->element->attributes[$name])) {
                if (!is_null($values[0])) { //vyhazovani NULL polozek
                  $sub[$values[0]] = $values[1];
                  $value = array_merge($this->element->attributes[$name], $sub);
                } else {
                  $value = $this->element->attributes[$name];
                }
              } else {
                if (!is_null($values[0])) { //vyhazovani NULL polozek
                  $value[$values[0]] = $values[1];  //pri prvni polozce v rade
                }
              }
            }
          break;

          case 'srcpath': //->srcpath('obr1.png') - webpath/obr1.png
            if (!is_null($values[0])) {
              $name = 'src';  //interpterace za src
              $value = Core::getUrl(array('path' => $values[0]));
            }
          break;

          case 'srchash': //->srchash('image/png', $blob_data) - obrazev v odkazu
            if (!empty($values[0]) && !empty($values[1])) {
              $name = 'src';  //interpterace za src
              $value = sprintf('data:%s;base64,%s', $values[0], base64_encode($values[1]));
            }
          break;

          case 'href':  //->href('url', array('k' => 'v', 'k' => 'v'))
            if (!is_null($values[0])) {
              $value = $values[0];
              if (!empty($values[1])) {
                $arg = http_build_query($values[1], NULL, '&amp;');
                $value = sprintf('%s?%s', $values[0], $arg);
              }
            }
          break;

          case 'hrefpath':  //->hrefpath('path/url', array('')) - webpath
            if (!is_null($values[0])) {
              $name = 'href'; //interpretace za href
              if (!empty($values[1])) {
                $arg = http_build_query($values[1], NULL, '&amp;');
                $values[0] = sprintf('%s?%s', $values[0], $arg);
              }
              $value = Core::getUrl(array('path' => $values[0]));
            }
          break;

          case 'hrefrewrite': //->hrefrewrite('path/url', array(''))->hrefrewrite('p', 'a', 't', 'h') - rewrite
            if (!is_null($values[0])) {
              $name = 'href'; //interpretace za href
              if (is_array($values[1])) {
                $arr[] = $values[0];
                $arr = array_merge($arr, $values[1]);
                $value = implode('/', $arr);
              } else {
                $value = implode('/', $values);
              }
            }
          break;

          case 'hrefpathrewrite': //->hrefrewrite('path/url', array('pa', 'th'))->hrefpathrewrite('p', 'a', 't', 'h') - webpath + rewrite
            if (!is_null($values[0])) {
              $name = 'href'; //interpretace za href
              if (is_array($values[1])) {
                $values[0] = sprintf('%s/%s', $values[0], implode('/', $values[1]));
              } else {
                $values[0] = implode('/', $values);
              }
              $value = Core::getUrl(array('path' => $values[0]));
            }
          break;

          default:
            throw new ExceptionHtml(sprintf('Unknown atrtibut "%s"!', $name));
          break;
        }

        $this->element->attributes[$name] = $value;

      } catch (ExceptionHtml $e) {
        echo $e;
      }
      return $this;
    }

    /**
     *
     * Renders form to string
     *
     * @return string
     */
    public function __toString() {
      return $this->render();
    }

    /**
     *
     * Main static constructor
     *
     * @param name string
     * @param attributes array
     * @return mixed
     */
    public static function elem($name, array $attributes = NULL) {
      $elem = new self($name);  //volani konstruktoru
      if (!empty($attributes)) {
        $elem->element->attributes = $attributes;
      }
      return $elem;
    }

//specialni pripad elem
    public static function note($if = NULL) {
      if (!empty($if)) {
        $elem = self::elem(self::NOTE_IF, array($if));
      } else {
        $elem = self::elem(self::NOTE_NORMAL);
      }
      return $elem;
    }

//overuje jestli se jedna o poznamkovy element
    public function isNote() {
      return (!empty($this->element->note) &&
              ($this->element->note == self::NOTE_NORMAL ||
              $this->element->note == self::NOTE_IF));
    }

    public function isElemImg() {
      return (!empty($this->element->name) && $this->element->name == 'img');
    }

//vraci jmeno elementu
    public function getName() {
      return $this->element->name;
    }

//nastavuje jmeno elementu
    public function setName($name) {
      try {
        if (!empty($name)) {
          switch ($name) {
            default:
              $this->element->name = $name;
            break;

            case self::PLAIN_TEXT:
              //nastavi do jmena obsah konstanty pro detekovani textu pri renderovani
              $this->element->name = self::PLAIN_TEXT;
              $this->element->plaintext = true;
            break;

            case self::NOTE_NORMAL:
              $this->element->name = '!-- ';
              $this->element->note = self::NOTE_NORMAL;
            break;

            case self::NOTE_IF:
              $this->element->name = '!--[if';
              $this->element->note = self::NOTE_IF;
            break;
          }
        } else {
          throw new ExceptionHtml('You can not create an element with an empty name!');
        }
      } catch (ExceptionHtml $e) {
        echo $e;
      }
      return $this;
    }

    //pridavani atributu po jednom
    public function addAttribute($name, $value) {
      $this->element->attributes[$name] = $value;
      return $this;
    }

    //pridavani atributu v poli
    public function addAttributes(array $attributes) {
      $this->element->attributes = array_merge($this->element->attributes, $attributes);
      return $this;
    }

//vklada obycejny text nebo pole textu, refaktor. args pole pro substituce
    public function setText($text, $args = NULL) {
      if (is_array($text)) {
        $this->element->content = array_merge($this->element->content, $text);
      } else {
        $this->element->content[] = (!is_null($args) ? vsprintf($text, $args) : $text);
      }
      return $this;
    }

//vklada jako znackovaci text, jen jeden text
    public function setMarkupText($text, $newpattern = array()) {
      if (is_string($text)) {
        $this->element->content[] = Core::getMarkupText($text, $newpattern);
      }
      return $this;
    }

//vklada jako znacky bbcode, jen jeden text
    public function setBBCodeText($text, $newpattern = array()) {
      if (is_string($text)) {
        $this->element->content[] = Core::getBBCodeText($text, $newpattern);
      }
      return $this;
    }

    public function getBreak() {
      return $this->element->break;
    }

    public function clearBreak() {
      $this->element->break = NULL;
      return $this;
    }

    public function setBreak($char) {
      $this->element->break = $char;
      return $this;
    }

//vraci unikatni id elementu, pokud je prazdne vraci null
    public function getId() {
      return (!empty($this->element->id) ? $this->element->id : NULL);
    }

    public function getDepth() {
      return $this->element->zan;
    }

    public function clearDepth() {
      $this->element->zan = NULL;
      return $this;
    }

    public function setDepth($depth) {
      $this->element->zan = $depth;
      return $this;
    }

    public function clearBreakDepth() {
      $this->element->break = NULL;
      $this->element->zan = NULL;
      return $this;
    }

    //vkladani do elementu jen ciste html
    public function insert($elements) {
      try {
        if (is_array($elements)) {
          foreach ($elements as $elem) {
            if (!empty($elem)) {
              if ($elem instanceof Html) {
                $this->element->content[] = $elem;
              } else { throw new ExceptionHtml('Inserted array element does not instance of Html class!'); }
            }
          }
        } else {
          if (!empty($elements)) {
            if ($elements instanceof Html) {
              $this->element->content[] = $elements;
            } else { throw new ExceptionHtml('Inserted element does not instance of Html class!'); }
          }
        }
      } catch (ExceptionHtml $e) {
        echo $e;
      }
      return $this;
    }

//vnitrni funkce pro vkladani obsahu pred, za a do elementu
    private function appendElements($location, $elements) {
      if (empty($this->element->$location)) {
        $this->element->$location = array();
      }
      $loc = $this->element->$location; //nacteni
      if (is_array($elements)) {
        foreach ($elements as $elem) {
          if (!empty($elem)) {
            $loc[] = $elem;
          }
        }
      } else {
        if (!empty($elements)) {
          $loc[] = $elements;
        }
      }
      $this->element->$location = $loc; //ulozeni
      return $this;
    }

    public function insertContent($elements) {
      return $this->appendElements('content', $elements);
    }

    //pripojit pred element
    public function appendBefore($elements) {
      return $this->appendElements('before', $elements);
    }

    //pripojit za element
    public function appendAfter($elements) {
      return $this->appendElements('after', $elements);
    }

    private function checkPairTag($name) {
      $nopair = array('input', 'img', 'link', 'meta', 'br', 'hr');
      return !in_array($name, $nopair); //detekuje neparove tagy
    }

    public function setTypeList($type) {
      self::$type_list = $type;
      return $this;
    }

/*
    public function setReplaceChar($subst) {
      $this->element->replchar = $subst;
      return $this;
    }
*/

//nastavovani pole pro template
    public function setTemplate($data) {
      if (!empty($data)) {
        $func = function($value) { return sprintf('{%s}', $value); };
        $newkey = array_map($func, array_keys($data));
        $newdata = array_combine($newkey, $data);
        //pokud je prazdny template tak provede vytvoreni jinak scitani
        self::$template = (!empty(self::$template) ? array_merge(self::$template, $newdata) : array_combine($newkey, $data));
      }
      return $this;
    }

    //konstanta na eval zpracovani textu
    const _SYNTAX_EVAL = '/^eval::/';
//TODO dodelat i do ostatnich casti kodu a pripadne oddelit do zvlastni metody ktera to bude rozlisovat a sefovat...
    private function replaceValues($value) {
      $result = $value;
//var_dump($value);
      $temp = self::$template;
      if (!empty($temp)) {
        $type = gettype($value);
        switch ($type) {
          case 'string':
            if (!empty($value) && array_key_exists($value, $temp)) {
              $result = $temp[$value];
            }
          break;

          case 'array':
            $result = array();
            foreach ($value as $val) {
              //var_dump($val);
              if (!is_null($val)) { //pokud neni hodnota null
                if (array_key_exists($val, $temp)) {
                  if (!is_null($temp[$val])) {  //pokud neni hodnota null tak ji vlozi
                    $result[] = $temp[$val];
                  }
                } else {
                  //provadeni parsovani textu pres eval
                  if (preg_match(self::_SYNTAX_EVAL, $val)) {
                    $func = sprintf('return %s;', preg_replace(self::_SYNTAX_EVAL, '', $val));
                    $eval = $this->replaceTemplate($func);
                    $result[] = eval($eval);
                  } else {
                    $result[] = $val;
                  }
                }
              }
            }
          break;
        }
      }
      return $result;
    }

//vnitrni metoda pro pro interpretaci pri renderingu
    private function replaceTemplate($value) {
      //var_dump($value);
      if (!empty(self::$template)) {
        $temp = self::$template;
        $search = array_keys($temp);
        //var_dump($search);
        $result = str_replace($search, $temp, $value);
      } else {
        $result = $value;
      }
      return $result;
    }

    /**
     *
     * Renders form
     *
     * @return string
     */
    public function render() {
      $result = array();
      //print_r($this);
      //print_r($this->element);
      //print_r($this->element->attributes);

      $noodle = (self::$type_list == self::LIST_NOODLE);  //zaninani nudla vypisu
      $name = $this->element->name;
      $zan = (!$noodle ? $this->element->zan : 0);
      $indent = ($zan >= 0 ? str_repeat(' ', $zan * 2) : '');
      $paired = $this->checkPairTag($name);
      $c_br = ($name == 'br');  //overeni jestli se jedna o br
      $note = $this->element->note;
      $contents = $this->element->content;
      $break = (!$noodle ? $this->element->break : '');

      //renderovani prvku pred
      if (!empty($this->element->before)) {
        foreach ($this->element->before as $index => $before) {
          $result[] = (string) $before;
          $result[] = $break;
        }
      }

      if (!$this->element->plaintext) {
        //zacatek tagu 1/2 - hlavni deklarace
        $result[] = sprintf('%s<%s', (!$c_br ? $indent : ''), $name);

        //seskladani atributu
        foreach ($this->element->attributes as $key => $value) {
          $val = $value;
          $show = true;
          //var_dump($key, $type, $value);
          $value = $this->replaceValues($value);
          $type = gettype($value);
          switch ($type) {  //vyjimky u typu
            case 'boolean':
              $val = ($value ? $key : '');
              $show = $value;
            break;

            case 'array': //jedine pole je style
              switch ($key) {
                case 'style':
                  $func = function($key, $value) { return sprintf('%s: %s', $key, $value); };
                  $val = implode('; ', array_map($func, array_keys($value), $value));
                break;

                case 'class':
                  if (count($value) == 1) {
                    //pokud je jen 1 index
                    if (!is_null($value[0])) {
                      $val = $value[0];
                    } else {
                      $show = false;
                    }
                  } else {
                    //vic plnych imploduje
                    if (!empty($value)) {
                      $val = implode(' ', $value);  //imploduje s mezerou
                    } else {
                      $show = false;
                    }
                  }
                break;
              }
            break;

            case 'NULL':
              $show = false;
            break;
          }

          if ($show) {
            if ($note == self::NOTE_IF) { //IE>=,<=,=
              //TODO pripadne tuto cast oddelit do vlastni privatni metody?!
              $in = array('IE<=', 'IE>=', 'IE<', 'IE>', '=');
              $out = array ('lte IE ', 'gte IE ', 'lt IE ', 'gt IE ', ' ');
              $val = str_replace($in, $out, $val);
              $result[] = sprintf(' %s]>', $val);
            } else {
              $result[] = sprintf(' %s="%s"', $key, $val);
            }
          }
        }

        if (!$note) {
          $result[] = ($paired ? '>' : ' />');
        }
      } //end not plain
      //konec 1/2 tagu

      //zacatek 2/2 tagu - obsah
      if (!empty($contents)) {
        $pocet = count($contents);

        if ($pocet == 1) {
          if ($contents[0] instanceof Html) { //pokud je instanci Html
            if ($contents[0]->isNote()) {  //pokud je poznamka
              $break = NULL;
              $indent = NULL;
              $contents[0]->clearDepth();
            }
          } else {  //pokud neni instanci Html
            $break = NULL;
            $indent = NULL;
          }
        }

        if (!$this->element->plaintext) { //pokud neni plain
          $result[] = $break;
        }

        //$texthtml = false;  //text v html v [0] pozici
        static $last = array();
        foreach ($contents as $index => $content) { //generovani obsahu
          //if (!empty($content)) {
          if (!is_null($content)) {
            if ($content instanceof Html) {
              $depth = $content->getDepth();
              //pokud je depth nenullove a id polozky se jeste negenerovalo
              $id = $content->getId();
              if (!is_null($depth) && !in_array($content->getId(), $last)) {  //pocitani zanorovani
                $content->setDepth($depth + $zan + 1);
              }
              $result[] = $content->render();
              if (!empty($id)) {
                $last[] = $content->getId();  //pridani do pole posledne generovanych elementu
              }
            } else {  //pridani jednoho zanoreni pri textu
              //jednoradkove texty
              //$item = (string) $content;
              $item = strval($content);
              $result[] = $indent.(!is_null($indent) ? '  ' : '');  //vkladani dalsiho zanoreni pokud se jedna o text
              $result[] = $item;
            }
            $result[] = $break;
          } //end if empty content
        } //ent foreach contents
        //pokud neni html v textu tak vklada odsazeni za text
        $result[] = $indent;

      } //end if not empty contents
      $result = $this->replaceTemplate($result);  //substituce parametru a obsahu

      //pokud neni obycejny text
      if (!$this->element->plaintext) {
        if (!$note) {
          $result[] = ($paired ? sprintf('</%s>', $name) : '');
        } else {
          $result[] = sprintf('%s-->', ($note == self::NOTE_IF ? '<![endif]' : ' '));
        }
        //konec tagu 2/2 tagu
      } //end not plain

      //renderovani prvku za
      if (!empty($this->element->after)) {
        $break = (!$noodle ? $this->element->break : ''); //tady si vrati puvodni break
        $result[] = $break;
        $pocet = count($this->element->after);
        foreach ($this->element->after as $index => $after) {
          $result[] = (string) $after;
          if ($index != ($pocet - 1)) {
            $result[] = $break;
          }
        }
      }
      return implode('', $result);
    }

    public function renderTest() {
      print_r($this);
    }

//interni prevod elementu do typu array, vyhazuje klice note,zan,break a use (pokud je zapnuta volba lite, defaultne je)
    private static function convert2array($values, $lite = true) {
      $result = array();
      foreach ($values as $key => $value) {
        if (is_object($value) || is_array($value)) {
          $result[$key] = self::convert2array($value, $lite);
        } else {
          if ($lite ? ($key !== 'note' && $key !== 'zan' && $key !== 'break' && $key !== 'use') : true) {
            $result[$key] = $value;
          }
        }
      }
      return $result;
    }

//interni prevod elementu do typu html
    private static function convert2html($values, $html = NULL) {
      $result = NULL;
      if (is_array($values)) {
        foreach ($values as $key => $value) {
          if ($key === 'element') {
            $result = Html::elem($value['name'], $value['attributes']);
            //nastavovani note pokud je
            if (!empty($value['note'])) {
              $result->element->note = $value['note'];
            }
            //nastavovani zan pokud je
            if (!empty($value['zan'])) {
              $result->element->zan = $value['zan'];
            }
            //nastavovani break pokud je
            if (!empty($value['break'])) {
              $result->element->break = $value['break'];
            }
            //nastavovani use pokud je
            if (!empty($value['use'])) {
              $result->element->use = $value['use'];
            }
            self::convert2html($value['content'], $result); //predani vygenerovaneho elementu dal
          } else {
            if (is_array($value)) {
              $html->insert(self::convert2html($value)); //vkladani elementu
            } else {
              $html->setText($value);  //vkladani textu do elementu
            }
          }
        }
      }
      return $result;
    }

//prevede zdroje do pole pro snazsi ulozeni treba do json
    public function toArray($lite = true) {
      return self::convert2array($this, $lite);
    }

//prevedeni zdroje zpet do objekto-pole pro html tridu
    public static function setArray(array $arrays = NULL) {
      $result = NULL;
      if (!empty($arrays)) {
        $result = self::convert2html($arrays);
      }
      return $result;
    }
  }

  class ExceptionHtml extends Exception {}

?>
