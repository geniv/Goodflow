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
          case 'onClick':
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

    //pripojit pred element
    public function appendBefore($elements) {
      try {

        if (is_array($elements)) {
          foreach ($elements as $elem) {
            if ($elem instanceof Html) {
              $this->element->before[] = $elem;
            } else { throw new ExceptionHtml('Inserted before array element does not instance of Html class!'); }
          }
        } else {
          if ($elements instanceof Html) {
            $this->element->before[] = $elements;
          } else { throw new ExceptionHtml('Inserted before element does not instance of Html class!'); }
        }

      } catch (ExceptionHtml $e) {
        echo $e;
      }

      return $this;
    }

    //pripojit za element
    public function appendAfter($elements) {
      try {

        if (is_array($elements)) {
          foreach ($elements as $elem) {
            if ($elem instanceof Html) {
              $this->element->after[] = $elem;
            } else { throw new ExceptionHtml('Inserted after array element does not instance of Html class!'); }
          }
        } else {
          if ($elements instanceof Html) {
            $this->element->after[] = $elements;
          } else { throw new ExceptionHtml('Inserted after element does not instance of Html class!'); }
        }

      } catch (ExceptionHtml $e) {
        echo $e;
      }

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

    private static function buildLayout($part, $html = NULL) {

//TODO nejak doresit a vychytat mouchy! - predavat zbytek pole a aktualni html ukazatel, furt nejak jebe, predava 2x posobe stejny?!

//var_dump($part);
      if (is_array($part)) {
        foreach ($part as $key => $values) {

//var_dump($key);
//var_dump($values);

          $el = NULL;
          switch ($key) {
            default:
              //var_dump($key);
              //var_dump($values);

              switch ($key) {
                case 'a:':
                  //var_dump($values);
                  $html->addAttributes($values);
                break;

                default:
                  //var_dump($values);
                  $html->setText($values);
                  //$a = self::buildLayout($values, $el);
                break;
              }
            break;


            case 'e:div': //div
              $el = self::elem('div');
              //var_dump($values);
            break;

            case 0:
              var_dump($key);
            break;

            case 'e:span':  //span
              $el = self::elem('span');
            break;

            case 'e:a':   //a
              $el = self::elem('a');
            break;

            case 'e:br':  //br
              $el = self::elem('br');
            break;

            case 'e:input': //input
              $el = self::elem('input');
            break;
          }
// && !empty($values)
          $a = NULL;
          if (!empty($el)) {
            $a = self::buildLayout($values, $el);
            if (empty($html)) {
              $html = $a;
            } else {
              //var_dump($html);
              //var_dump($values);
              //$a = self::buildLayout($values, $el);
              $html->insert($a);
            }
          }

        }
      } else {
        //$html->setText($part);
      }

      return $html;
    }

    public static function template(array $layout) {
      //TODO musi si volat pomocnou funkci ktera se bude starat o rekurzivni prochazeni

      return self::buildLayout($layout);
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
      $note = $this->element->note;
      $contents = $this->element->content;
      $break = $this->element->break;
      $pocty = $this->getCountContents();

      //prochazeni prvku za
      if (!empty($this->element->before)) {
        foreach ($this->element->before as $before) {
          $result[] = $before->render();
        }
      }

      //zacatek tagu 1/2
      $result[] = sprintf('%s<%s', $indent, $name);

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

        //$result[] = $break;
        //$result[] = ($paired && !$note && $pocty['object'] != 0 ? $break : '');
        //$result[] = $indent;&& $pocty['object'] != 0
        $result[] = ($pocty['object'] > 0 ? $break : '');

        $p_string = 0;
        $p_object = 0;
        foreach ($contents as $content) { //generovqani obsahu
          if (!empty($content)) {

            $type = gettype($content);
            switch ($type) {
              case 'string':  //text
                $result[] = $content;
                $p_string++;
              break;

              case 'object':  //html
                if ($p_object != 0) {
                  $result[] = $break;
                }

                $result[] = $content->setDepth($zan + 1)->render();

                if ($p_object == 0 && $pocty['object'] == 1) {
                  $result[] = $break;
                }

                $p_object++;
              break;
            }

          } //end if empty content

        } //ent foreach contents

        $result[] = ($pocty['object'] > 1 ? $break : '');
        $result[] = ($pocty['object'] != 0 ? $indent : '');

      } //end if not empty contents

      if (!$note) {
        $result[] = ($paired ? sprintf('</%s>%s', $name, '') : ''); //$break
      } else {
        $result[] = sprintf('%s-->%s', ($note == self::NOTE_IF ? '<![endif]' : ' '), $break);
      }
      //konec tagu 2/2

      //prochazeni prvku za
      if (!empty($this->element->after)) {
        foreach ($this->element->after as $after) {
          $result[] = $after->render();
        }
      }

      return implode('', $result);
    }

    public function renderTest() {
      print_r($this);
    }
  }

  class ExceptionHtml extends Exception {}

?>
