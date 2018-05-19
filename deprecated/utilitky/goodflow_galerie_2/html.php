<?php
/*
 *      html.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  class Html {
    protected $attributes = array();
    protected $name, $text, $newline = "\n";
    protected $nopair = array('input', 'img', 'link', 'meta', 'br', 'hr');
    protected $children = array();
    protected $beforlevel = array();
    protected $afterlevel = array();
    protected $zan = 0;

    /**
     *
     * Main static constructor
     *
     * @param name string
     * @param attributes array
     * @return mixed
     */
    public static function elem($name, array $attributes = NULL) {
      $elem = new self;

      $elem->setName($name);

      if (is_array($attributes)) {
        $elem->attributes = $attributes;
      }

      return $elem;
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

        $last = (in_array($name, $this->attributes) || !empty($this->attributes[$name]) ? $this->attributes[$name] : NULL);
        $value = NULL;
        switch ($name) {
          case 'type':    //atribut type
          case 'name':
          case 'id':      //atribut id
          case 'value':   //atribut value
          case 'disabled'://atribut disabled
          case 'readonly'://atribut readonly
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
            $value = $values[0];
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
    public function addAttributes(array $atributes) {
      foreach ($atributes as $key => $value) {
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
          $this->name = $name;
        } else {
          throw new ExceptionHtml;
        }
      } catch (ExceptionHtml $e) {
        echo 'Nelze vytvořit element s prázdným jménem!';
      }
    }

    public function getText() {
      return $this->text;
    }

    public function setText($text) {
      $this->text[] = $text;
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

    protected function findElement($search) {
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

        if (is_array($elements)) {
          foreach ($elements as $elem) {
            if ($elem instanceof Html) {
              $elem->zan = $this->zan + 1;
              $this->children[] = $elem;
            } else { throw new ExceptionHtml; }
          }
        } else {
          if ($elements instanceof Html) {
            $elements->zan = $this->zan + 1;
            $this->children[] = $elements;
          } else { throw new ExceptionHtml; }
        }

      } catch (ExceptionHtml $e) {
        echo 'Inserted element does not instance of class Html!';
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
            } else { throw new ExceptionHtml; }
          }
        } else {
          if ($elements instanceof Html) {
            $this->beforlevel[] = $elements;
          } else { throw new ExceptionHtml; }
        }

      } catch (ExceptionHtml $e) {
        echo 'Inserted element does not instance of class Html!';
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
            } else { throw new ExceptionHtml; }
          }
        } else {
          if ($elements instanceof Html) {
            $this->afterlevel[] = $elements;
          } else { throw new ExceptionHtml; }
        }

      } catch (ExceptionHtml $e) {
        echo 'Inserted element does not instance of class Html!';
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

    /**
     *
     * Renders form
     *
     * @return string
     */
    public function render() {

      $nopair = in_array($this->name, $this->nopair); //detekuje neparove tagy

      //print_r($this);

      $odsazeni = str_repeat(' ', $this->zan * 2);

      //prochazeni prvku za
      foreach ($this->beforlevel as $before) {
        $result[] = $before->render();
      }

      $result[] = sprintf('%s<%s', $odsazeni, $this->name); //"{}<{}"

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
            if ($key == 'style') {
              $func = function($key, $value) { return sprintf('%s: %s', $key, $value); }; //"{}: {}"
              $val = implode('; ', array_map($func, array_keys($value), $value));
            }
//TODO zmenou nekterych prvku na [] se mohlo stat ze se nedostane format NULL ale array => NULL
            if ($key == 'class') {

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

            }
          break;

          case 'NULL':
            $show = false;
          break;
        }

        if ($show) {
          $result[] = sprintf(' %s="%s"', $key, $val);  //" {}=\"{}\"";
        }
      }

      $result[] = ($nopair ? ' />' : '>');

      if (empty($this->text)) {
        $result[] = $this->newline;
      }

      if (!empty($this->text)) {
        foreach ($this->text as $text) {
          $result[] = $text;  //vlozeni obsahu dovnitr
        }
      }

      //$result[] = $this->text;  //vlozeni obsahu dovnitr

      //prochazeni a renderovani potomku
      foreach ($this->children as $child) {
        $result[] = $child->render();
      }

      if (empty($this->text)) {
        $result[] = (!$nopair ? $odsazeni : '');
      }

      $result[] = (!$nopair ? sprintf('</%s>%s', $this->name, $this->newline) : '');  //"</{}>\n"

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
