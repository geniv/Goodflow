<?php
/*
 *      html.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use Exception;

  class Html {
    const NOTE_NORMAL = 'note';
    const NOTE_IF = 'ifnote';
    const VERSION = '1.5';

    private $attributes, $name, $text, $newline, $children,
              $beforlevel, $afterlevel, $zan, $note;

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
        $elem->attributes = $attributes;
      }

      return $elem;
    }

    public function __construct($name) {
      $this->attributes = array();
      $this->note = NULL;
      $this->setName($name);
      $this->text = array();
      $this->newline = "\n";
      $this->children = array();
      $this->beforlevel = array();
      $this->afterlevel = array();
      $this->zan = 0;
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
//TODO pridat systemovy atribut: visible => buse se starat o skryvani html prvku
        $last = (in_array($name, $this->attributes) || !empty($this->attributes[$name]) ? $this->attributes[$name] : NULL);
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
            throw new ExceptionHtml($name);
          break;
        }

        $this->attributes[$name] = $value;

      } catch (ExceptionHtml $e) {
        echo sprintf('Unknown atrtibut <strong>%s</strong>!', $e->getMessage());
      }

      return $this;
    }

    //pro prime cteni
    public function __get($name) {  //&__get  ???
      return $this->attributes[$name];
    }

    //pro prime nastavovani
    public function __set($name, $value) {
      $this->attributes[$name] = $value;
    }

    //pridavani atributu po jednom
    public function addAttribute($name, $value) {
      $this->attributes[$name] = $value;
      return $this;
    }

    //pridavani atributu v poli
    public function addAttributes(array $attributes) {
      foreach ($attributes as $key => $value) {
        $this->attributes[$key] = $value;
      }
      return $this;
    }

    public function getName() {
      return $this->name;
    }

    public function setName($name) {
      try {

        if (!empty($name)) {

          switch ($name) {
            default:
              $this->name = $name;
            break;

            case self::NOTE_NORMAL:
              $this->name = '!-- ';
              $this->note = self::NOTE_NORMAL;
            break;

            case self::NOTE_IF:
              $this->name = '!--[if';
              $this->note = self::NOTE_IF;
            break;
          }

        } else {
          throw new ExceptionHtml('Nelze vytvořit element s prázdným jménem!');
        }

      } catch (ExceptionHtml $e) {
        echo $e;
      }
    }

    public function getText() {
      return $this->text;
    }

    public function setText($text) {
      if (is_array($text)) {
        $this->text = array_merge($this->text, $text);  //secteni poli
      } else {
        $this->text[] = $text;
      }
      return $this;
    }

    public function getDepth() {
      return $this->zan;
    }

    public function setDepth($depth) {
      $this->zan = $depth;
      return $this;
    }

    public function getChildren() {
      return $this->children;
    }
//TODO pridat hledani s dodatecnyma parametrama!!!
    private function findElement($search) {
      $result = '';
      foreach ($this->children as $child) {
        if ($child->name == $search) {
          $result[] = $child;
        } else {
          return $child->findElement($search);
        }
      }

      return $result;
    }

    public function getElement($search) {
      $children = $this->findElement($search);

      if (count($children) == 1) {
        $result = $children[0];
      } else {
        $result = $children;
      }

      return $result;
    }

    //vkladani do elementu
    public function insert($elements) {
      try {
//TODO skusit vyresit vecny problem se zanorovanim prvku?!! tady pri vkladani si prece musi nejak vytahnout jeho pozici
//prinejmensim kdyz se vlozi prvek do jineho tak mu pridelat svou hloubku aby se on mohl o dalsi stupen posunout...

//TODO vkladat je n do textu a prisuzovat typ: [] = array('type' => 'html'/'text', 'content' => ...)
        if (is_array($elements)) {
          foreach ($elements as $elem) {
            if ($elem instanceof Html) {
              $elem->setDepth($this->zan + 1);
              $this->children[] = $elem;
            } else { throw new ExceptionHtml('Inserted array element does not instance of Html class!'); }
          }
        } else {
          if ($elements instanceof Html) {
            $elements->setDepth($this->zan + 1);
            $this->children[] = $elements;
          } else { throw new ExceptionHtml('Inserted element does not instance of Html class!'); }
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
              $this->beforlevel[] = $elem;
            } else { throw new ExceptionHtml('Inserted before array element does not instance of Html class!'); }
          }
        } else {
          if ($elements instanceof Html) {
            $this->beforlevel[] = $elements;
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
              $this->afterlevel[] = $elem;
            } else { throw new ExceptionHtml('Inserted after array element does not instance of Html class!'); }
          }
        } else {
          if ($elements instanceof Html) {
            $this->afterlevel[] = $elements;
          } else { throw new ExceptionHtml('Inserted after element does not instance of Html class!'); }
        }

      } catch (ExceptionHtml $e) {
        echo $e;
      }

      return $this;
    }

    public function getNewLine() {
      return $this->newline;
    }

    public function setNewLine($char) {
      $this->newline = $char;
      return $this;
    }
//TODO newline udelat stejne jako tady tech checkpair!
    private function checkPairTag($name) {
      $nopair = array('input', 'img', 'link', 'meta', 'br', 'hr');
      return in_array($name, $nopair); //detekuje neparove tagy
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
      //print_r($this->content);

      $odsazeni = str_repeat(' ', $this->zan * 2);
      $nopair = $this->checkPairTag($this->name);

      //prochazeni prvku za
      foreach ($this->beforlevel as $before) {
        $result[] = $before->render();
      }

      //zacatek tagu 1/2
      $result[] = sprintf('%s<%s', $odsazeni, $this->name);

      //seskladani atributu
      foreach ($this->attributes as $key => $value) {
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
          if ($this->note == self::NOTE_IF) {
            $in = array('IE<=', 'IE>=', 'IE<', 'IE>', '=');
            $out = array ('lte IE ', 'gte IE ', 'lt IE ', 'gt IE ', ' ');
            $val = str_replace($in, $out, $val);
            $result[] = sprintf(' %s]>', $val);
          } else {
            $result[] = sprintf(' %s="%s"', $key, $val);
          }
        } else {
          //var_dump($key, $val);
          //$result[] = sprintf(' %s="%s"', $key, $val);
        }

      }

      if (!$this->note) {
        $result[] = ($nopair ? ' />' : '>');
      }
      //konec 1/2 tagu

      //zacatek 2/2
      if (!empty($this->text)) {
        foreach ($this->text as $text) {
          $result[] = $text;  //vlozeni obsahu dovnitr
        }
      } else {
        $result[] = $this->newline;
      }

      //prochazeni a renderovani potomku
      foreach ($this->children as $child) {
        $result[] = $child->render();
      }

      if (empty($this->text)) {
        $result[] = (!$nopair ? $odsazeni : '');
      }

      if (!$this->note) {
        $result[] = (!$nopair ? sprintf('</%s>%s', $this->name, $this->newline) : '');
      } else {
        $result[] = sprintf('%s-->%s', ($this->note == self::NOTE_IF ? '<![endif]' : ' '), $this->newline);
      }
      //konec tagu 2/2

      //prochazeni prvku za
      foreach ($this->afterlevel as $after) {
        $result[] = $after->render();
      }

      return implode('', $result);
    }

    public function renderTest() {
      print_r($this);
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
  }

  class ExceptionHtml extends Exception {}

/*
//TODO moznost vyskladani v poli a pak jednim prikauem vykresli??
'input' => array ('type' => 'text',
                  'value' => 'neco',
                  'class' => 'nekdoo')

*/

?>