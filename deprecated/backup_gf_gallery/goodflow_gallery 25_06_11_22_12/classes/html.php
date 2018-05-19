<?php
/*
 *      html.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception;

  class Html {
    const NOTE_NORMAL = 'note';
    const NOTE_IF = 'ifnote';
    const VERSION = '1.5';

    private $element;

    public function __construct($name) {
      $this->element = new stdClass;
      $this->element->name = NULL;
      $this->element->attributes = array();
      $this->element->content = array();
      $this->element->note = false;
      $this->element->zan = 0;
      $this->element->break = PHP_EOL;
      $this->setName($name);
    }

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
        $last = (in_array($name, $this->element->attributes) ||
                !empty($this->element->attributes[$name]) ? $this->element->attributes[$name] : NULL);
        $value = NULL;
        //var_dump($name, $values);
        switch ($name) {
          case 'type':    //atribut type
          case 'name':
          case 'id':      //atribut id
          case 'value':   //atribut value
          case 'disabled'://atribut disabled
          case 'readonly'://atribut readonly
          case 'accept':  //????
          case 'placeholder': //vychozi text v inputu
          case 'size':
          case 'maxlength':
          case 'autocomplete':
          case 'src':
          case 'alt':
          case 'title':
          case 'multiple':
          case 'checked':
          case 'selected':
          case 'cols':
          case 'rows':
          case 'wrap':
          case 'for':
          case 'align':
          case 'label':
          case 'method':
          case 'action':
          case 'enctype':
          case 'onclick':
            //if (!empty($values[0])) {
            if (!is_null($values[0])) { //musi testovat na NULL, vkladani prazdne ale ne NULL
              $value = $values[0];
            }
          break;

          case 'class':   //atribut class
            $value[] = $values[0];
            if (!empty($last)) { $value = array_merge($last, $value); }
          break;

          case 'style': //atribut style
            if (is_array($values[0])) {
              $value = $values[0];  //array('k' => 'v')
            } else {
              $value[$values[0]] = $values[1];  //'k', 'v'
            }

            //spojeni predchoziho obsahu
            if (!empty($last)) { $value = array_merge($last, $value); }
          break;

          case 'href':  //atribut href
            $value = $values[0];
            if (!empty($values[1])) {
              $arg = http_build_query($values[1], NULL, '&amp;');
              $value = sprintf('%s?%s', $value, $arg);
            }
          break;

          default:
            throw new ExceptionHtml(sprintf('Unknown atrtibut <strong>%s</strong>!', $name));
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

/*
    //pro prime cteni
    public function __get($name) {  //&__get  ???
      return $this->element->attributes[$name];
    }

    //pro prime nastavovani
    public function __set($name, $value) {
      $this->element->attributes[$name] = $value;
    }
*/

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

    public function getName() {
      return $this->element->name;
    }

    public function setName($name) {
      try {

        if (!empty($name)) {
          switch ($name) {
            default:
              $this->element->name = $name;
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


    public function setText($text) {
      if (is_array($text)) {
        $this->element->content = array_merge($this->element->content, $text);
      } else {
        $this->element->content[] = $text;
      }
      return $this;
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

    //vkladani do elementu
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

    //pripojit pred element
    public function appendBefore($elements) {
      $this->appendElements('before', $elements);
      return $this;
    }

    //pripojit za element
    public function appendAfter($elements) {
      $this->appendElements('after', $elements);
      return $this;
    }

    public function getBreak() {
      return $this->element->break;
    }

    public function clearBreak() {
      $this->element->break = '';
      return $this;
    }

    public function setBreak($char) {
      $this->element->break = $char;
      return $this;
    }

    private function checkPairTag($name) {
      $nopair = array('input', 'img', 'link', 'meta', 'br', 'hr');
      return !in_array($name, $nopair); //detekuje neparove tagy
    }

    private function getCountContents() {
      $result = array('string' => 0, 'object' => 0);
      foreach ($this->element->content as $content) {
        $type = gettype($content);
        if ($type == 'string' || $type == 'object') {
          $result[$type]++;
        }
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

      $name = $this->element->name;
      $zan = $this->element->zan;
      $indent = str_repeat(' ', $zan * 2);
      $paired = $this->checkPairTag($name);
      $c_br = ($name == 'br');  //overeni jestli se jedna o br
      $note = $this->element->note;
      $contents = $this->element->content;
      $break = $this->element->break;
      $pocty = $this->getCountContents();

      //prochazeni prvku pred
      if (!empty($this->element->before)) {
        $result = array_merge($result, $this->element->before);
        $result[] = $break;
      }

      //zacatek tagu 1/2
      $result[] = sprintf('%s<%s', (!$c_br ? $indent : ''), $name);

      //seskladani atributu
      foreach ($this->element->attributes as $key => $value) {
        $val = $value;
        $show = true;
        $type = gettype($value);
        //var_dump($key, $type, $value);
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
                  //vic imploduje
                  $val = implode(' ', $value);
                }
              break;
            }
          break;

          case 'NULL':
            $show = false;
          break;
        }

        if ($show) {
          if ($note == self::NOTE_IF) {
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
      //konec 1/2 tagu

      //zacatek 2/2
      if (!empty($contents)) {

        $result[] = ($pocty['object'] > 0 ? $break : '');

        $p_string = 0;
        $p_object = 0;
        foreach ($contents as $content) { //generovqani obsahu
          if (!empty($content)) {

            $type = gettype($content);
            switch ($type) {
              case 'string':  //text
                //pred textem
                if ($p_object > 0) {
                  $result[] = $indent;
                }
                $result[] = $content;
                //za textem
                if ($p_object > 0) {
                  $result[] = $break;
                }
                $p_string++;
              break;

              case 'object':  //html
                //pred objektem
                if ($p_object > 0) {
                  $result[] = $break;
                }
                //vkladani zanoreni do dalsiho elementu
                $depth = $content->getDepth();
                if (!is_null($depth) &&
                    $content instanceof Html) {
                  $content->setDepth($depth + $zan + 1);  //nastavene + aktualni + 1
                }
                $result[] = $content->render();
                //za objektem
                if ($p_object == 0 && $pocty['object'] == 1) {
                  $result[] = $break;
                }
                $p_object++;
              break;
            } //end switch type

          } //end if empty content

        } //ent foreach contents

        $result[] = ($pocty['object'] > 1 ? $break : '');
        $result[] = ($pocty['object'] > 0 ? $indent : '');
      } //end if not empty contents

      if (!$note) {
        $result[] = ($paired ? sprintf('</%s>', $name) : '');
      } else {
        $result[] = sprintf('%s -->', ($note == self::NOTE_IF ? '<![endif]' : ''));
      }
      //konec tagu 2/2

      //prochazeni prvku za
      if (!empty($this->element->after)) {
        $result[] = $break;
        $result = array_merge($result, $this->element->after);
      }

      return implode('', $result);
    }

    public function renderTest() {
      print_r($this);
    }
  }

  class ExceptionHtml extends Exception {}

?>
