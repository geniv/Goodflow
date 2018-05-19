<?php
/*
 *      form.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use classes\Core,
      classes\Html,
      stdClass,
      Exception;

  final class Form extends Html {
    const VERSION = 2.41;

    const METHOD_GET = 'get'; //TODO prekopat do Core ???
    const METHOD_POST = 'post';

    const _T_TEXT = 'text';
    const _T_FILE = 'file';
    const _T_SUBMIT = 'submit';

    const _O_SPAN_ELEM = 'span-elem';
    const _O_ELEM_SPAN = 'elem-span';

    const MIME_MULTIPART = 'multipart/form-data';

    //pravidla na porovnani
    const RULE_FILLED = 'filled'; //musi byt vyplneno; ->addRule(Form::RULE_FILLED, '...');
    const RULE_EQUAL = 'equal'; //musi byt rovno; ->addRule(Form::RULE_EQUAL, '...', $form->pass);
    const RULE_NOTEQUAL = 'notequal'; //nesmi byt rovno

    //pravidla na vstupni udaje
    const RULE_COUNT = 'count'; //kontrola poctu prvku napr ve File
    const RULE_NUMERIC = 'numeric'; //kontola obecne cisla (float / int); ->addRule(Form::RULE_NUMERIC, '...')
      //const RULE_INTEGER = 'integer'; //kontrola na integer
      //const RULE_FLOAT = 'float'; //kontrola na float
    const RULE_MIN_LENGTH = 'min_length'; //kontrola na min delku
    const RULE_MAX_LENGTH = 'max_length'; //kontrola na max delku
    const RULE_LENGTH = 'length'; //kontrola na presnou delku
    const RULE_MIN_VALUE = 'min_value'; //kontrola na min hodnotu (float, int)
    const RULE_MAX_VALUE = 'max_value'; //kontrola na max hodnotu (float, int)
    const RULE_RANGE = 'range'; //kontrola na rozsah cisla (float, int)
    const RULE_EMAIL = 'email'; //kontrola na validni email
    const RULE_URL = 'url'; //kontrola na validni url
    const RULE_REGEXP = 'regexp'; //kontrola dle vlastniho regularniho vyrazu ->addRule(Form::RULE_REGEXP, '...', '[0-9]{9}')

    //output type value
    const TYPE_STRING = 'string';  //nastavuje string; ->setTypeVariable(Form::TYPE_STRING)
    const TYPE_INTEGER = 'integer'; //nastavuje integer; ->setTypeVariable(Form::TYPE_INTEGER)
    const TYPE_FLOAT = 'float'; //nastavuje float; ->setTypeVariable(Form::TYPE_FLOAT)
    const TYPE_BOOL = 'boolean';  //nastavuje bool; ->setTypeVariable(Form::TYPE_BOOL)

    private $element; //agregacni promenna
//TODO mit moznost aplikovat na vystupy fukci trim! - nejak volitelne!?!
    public function __construct(array $settings = array()) {
      $this->element = new stdClass;
      $this->element->conf = new stdClass;
      $this->element->conf->action = Core::isFill($settings, 'action');
      $this->element->conf->method = Core::isFill($settings, 'method', self::METHOD_POST);
      $this->element->conf->enctype = Core::isFill($settings, 'enctype', NULL);
      $this->element->conf->form_class = Core::isFill($settings, 'form_class', NULL);
      $this->element->conf->form_id = Core::isFill($settings, 'form_id', NULL);
      $this->element->form = array(); //elementy
      $this->element->before = array(); //pred formularem
      $this->element->zan = 0;  //zanoreni formulare
      $this->element->error = array();  //agregacni pole chyb
      $this->element->values = NULL;  //predavani hodnot
      $this->element->elemtype = array(); //pro sprvane vryceni hodnot
      $this->element->submit = NULL;  //name submitu
      $this->element->counts = array(); //pocty jednotlivych name
      $this->element->loadvalues = array(); //nacitane data pri editaci
      $this->element->validate = false;
    }

    //vraci hodnotu z post|get
    //kvuli jiste kompatibilni podobnosti (nette); $form->varible (funguje kdyz je odeslano!)
    public function __get($name) {
      return $this->getArgs($name);
    }

    public function __toString() {
      return $this->render();
    }

    public function render() {
      //print_r($this->element);
      //var_dump($this->element->form);
      //print_r($this->element->counts);

      $func = function($value) { return $value['html']; };  //vyber indexu html
      $row = array_map($func, $this->element->form);

      $fieldset = self::elem('fieldset')->insert($row);

      $form = self::elem('form')
                  ->setDepth($this->element->zan)
                  ->action($this->element->conf->action)
                  ->method($this->element->conf->method)
                  ->enctype($this->element->conf->enctype)
                  ->class($this->element->conf->form_class)
                  ->id($this->element->conf->form_id)
                  ->insert($fieldset)
                  ->appendBefore($this->element->before);

      return $form->render();
    }

//action
    public function getAction() {
      return $this->element->conf->action;
    }

    public function setAction($url) { //action skript
      $this->element->conf->action = $url;
      return $this;
    }

//method
    public function getMethod() {
      return $this->element->conf->method;
    }

    public function setMethod($method) {  //post/get
      $this->element->conf->method = $method;
      return $this;
    }

//enctype
    public function getEnctype() {
      return $this->element->conf->enctype;
    }

    public function setEnctype($mime) { //MIME_MULTIPART
      $this->element->conf->enctype = $mime;
      return $this;
    }

//hloubka
    public function getDepth() {
      return $this->element->zan;
    }

    public function setDepth($depth) {
      $this->element->zan = $depth;
      return $this;
    }

    private function buildLabel($settings, $element) {
      $span = array();
      //pokud je label vyplneny
      $label = Core::isFill($settings, 'label', '');
      if (!empty($label)) {
        $span[] = self::elem('span')->setText($label);
      }

      //pokud se ma vlozit vlastni element
      $self_elem = Core::isFill($settings, 'self_elem');
      if (!empty($self_elem)) {
        //zatim to je tak ze se muze vkladat je jeden element
        //pripadne jeden element ktery ma navkladane dovnitr dalsi prvky
        if (is_array($self_elem)) { //pokuj je pole tak ho slouzi
          $span = array_merge($span, $self_elem);
        } else {
          $span[] = $self_elem;
        }
      }

      $result = self::elem('label')->class(Core::isFill($settings, 'label_class', NULL))
                                    ->id(Core::isFill($settings, 'label_id', NULL));

      $label_text = Core::isFill($settings, 'label_text');
      if (!empty($label_text)) {
        $result->setText($label_text);
      }

      //prenaseno pres globalni nastaveni
      switch ($settings['_order']) {
        case self::_O_SPAN_ELEM:  //normalni
          $result->insertContent($span)
                 ->insertContent($element);
        break;

        case self::_O_ELEM_SPAN:  //checkbox
          $result->insertContent($element)
                 ->insertContent($span);
        break;
      }
      return $result;
    }

    public function __call($method, $parameters) {
      try {
        $name = Core::isFill($parameters, 0);

        if (empty($name)) {
          throw new ExceptionForm('Element name must not be empty!');
        }
        $settings = Core::isFill($parameters, 1);
//FIXME striktne kontrolovat jestli 2 ruzne elementy nemaji stejny nazev, pokud nejde o multiple!!!!!
        //$type = NULL;
        $element = NULL;
//TODO moznost pridavat volitelne parametry jako ze settings:, array('id' => 'back_link_central')

        $returnvalue = Core::isFill($settings, 'returnvalue', false);  //zapinani vraceni hodnot primo z metody
        //bude zpracovavat jen pri returnvalue=>true
        $loadvalue = Core::isNull($this->element->loadvalues, $name, NULL);
        $retval = Core::isEmpty($this->getMethodValue($name), $loadvalue);

        $value = Core::isNull($settings, 'value', ($returnvalue ? $retval : NULL));  //nesmi kontrolovat pres empty!
        $checked = Core::isFill($settings, 'checked', ($returnvalue ? $retval : NULL)); //je haklive na typ
        $selected = Core::isFill($settings, 'selected', ($returnvalue ? $retval : NULL));
        $multiple = (boolean) Core::isFill($settings, 'multiple', false);
        $multiple_name = sprintf('%s%s', $name, ($multiple ? '[]' : '')); //name pro elementy ktere podporuji multiple
        $cols = Core::isFill($settings, 'cols', 40);
        $rows = Core::isFill($settings, 'rows', 10);
        $size = Core::isFill($settings, 'size', NULL);
        $readonly = Core::isFill($settings, 'readonly', NULL);
        $maxlength = Core::isFill($settings, 'maxlength', NULL);
        $disabled = Core::isFill($settings, 'disabled', NULL);
        $accesskey = Core::isFill($settings, 'accesskey', NULL);
        $tabindex = Core::isFill($settings, 'tabindex', NULL);
        $title = Core::isFill($settings, 'title', NULL);
        $placeholder = Core::isFill($settings, 'placeholder', NULL);
        $autocomplete = Core::isFill($settings, 'autocomplete', NULL);
        $input_class = Core::isFill($settings, 'input_class', NULL);

        //podminka pro problemove prohlizece
        $oldplaceholder = (!empty($placeholder) && (Core::isIExplorer() || Core::isOpera()));

        //html5
        $min = Core::isFill($settings, 'min', 0);
        $max = Core::isFill($settings, 'max', 10);
        $step = Core::isFill($settings, 'step', 1);
        $required = Core::isFill($settings, 'required', false);

//var_dump($input_class);
//var_dump($name, $multiple_name);

        $settings['_order'] = self::_O_SPAN_ELEM; //defaultni poradi v labelu
        $type = self::_T_TEXT;

        switch ($method) {
          case 'addText':
            $element = self::elem('input')->type('text')
                                          ->class($input_class)
                                          ->name($multiple_name)
                                          ->value($value)
                                          ->autocomplete($autocomplete)
                                          ->placeholder($placeholder)
                                          ->size($size)
                                          ->readonly($readonly)
                                          ->maxlength($maxlength)
                                          ->disabled($disabled)
                                          ->accesskey($accesskey)
                                          ->tabindex($tabindex)
                                          ->title($title)
                                          ->required($required);

            if ($oldplaceholder) {  //pokud jsou IE nebo Opera
              $element->onfocus(sprintf('this.value=(this.value == \'%s\' ? \'\' : this.value);', $placeholder))
                      ->onblur(sprintf('this.value=(this.value == \'\' ? \'%s\' : this.value);', $placeholder))
                      ->placeholder(NULL)
                      ->required(NULL)
                      ->value(Core::isEmpty($value, $placeholder));
            }
          break;

          case 'addPassword':
            $element = self::elem('input')->type('password')
                                          ->class($input_class)
                                          ->name($multiple_name)
                                          ->value($value)
                                          ->autocomplete($autocomplete)
                                          ->size($size)
                                          ->readonly($readonly)
                                          ->maxlength($maxlength)
                                          ->disabled($disabled)
                                          ->accesskey($accesskey)
                                          ->tabindex($tabindex)
                                          ->title($title)
                                          ->required($required);
          break;

          case 'addTextArea':
            $wrap = Core::isFill($settings, 'wrap', NULL);  //soft, hard, off

            $element = self::elem('textarea')->name($multiple_name)
                                              ->class($input_class)
                                              ->cols($cols)
                                              ->rows($rows)
                                              ->placeholder($placeholder)
                                              ->readonly($readonly)
                                              ->maxlength($maxlength)
                                              ->disabled($disabled)
                                              ->wrap($wrap)
                                              ->accesskey($accesskey)
                                              ->tabindex($tabindex)
                                              ->title($title)
                                              ->required($required);

            if ($oldplaceholder) {  //pokud jsou IE nebo Opera
              $element->onfocus(sprintf('this.value=(this.value == \'%s\' ? \'\' : this.value);', $placeholder))
                      ->onblur(sprintf('this.value=(this.value == \'\' ? \'%s\' : this.value);', $placeholder))
                      ->placeholder(NULL)
                      ->required(NULL)
                      ->setText(Core::isEmpty($value, $placeholder));
            } else {
              $element->setText($value);
            }
          break;

          case 'addHidden':
            $element = self::elem('input')->type('hidden')
                                          ->class($input_class)
                                          ->name($multiple_name)
                                          ->value($value)
                                          ->readonly($readonly)
                                          ->maxlength($maxlength)
                                          ->disabled($disabled);
          break;

          case 'addCheckbox':
            $element = self::elem('input')->type('checkbox')
                                          ->class($input_class)
                                          ->name($multiple_name)
                                          ->value($value)
                                          ->checked($checked)
                                          ->disabled($disabled)
                                          ->accesskey($accesskey)
                                          ->tabindex($tabindex)
                                          ->title($title);

            $settings['_order'] = self::_O_ELEM_SPAN;
          break;

          case 'addCheckGroup':
            $row = array();
            //'value' => array('k' => 'v',)
            if (!empty($value)) {
              foreach ($value as $key => $val) {
                $row[] = self::elem('input')->type('checkbox')
                                            ->class($input_class)
                                            ->name($multiple_name)
                                            ->value($key)
                                            ->checked(is_array($checked) ? in_array($key, $checked) : $key == $checked);
                $row[] = self::span()->setText($val);
              }
            }

            $element = $row;
          break;

          case 'addSelect':
            //rozsah 'range' => array(5, 32)
            $range = Core::isFill($settings, 'range', NULL);
            if (empty($value) && !empty($range)) {
              $value = range($range[0], $range[1]);
              $value = array_combine($value, $value);
            }

            //interval 'interval' => array('-' => 5, 'current' => date('H'), '+' => 5)
            $interval = Core::isFill($settings, 'interval', NULL);
            if (empty($value) && !empty($interval)) {
              $before = array();
              $minus = $interval['-'];
              if (!empty($minus)) {
                $before = range($interval['current'] - $minus, $interval['current'] - 1);
              }
              $center[] = $interval['current'];
              $after = array();
              $plus = $interval['+'];
              if (!empty($plus)) {
                $after = range($interval['current'] + 1, $interval['current'] + $plus);
              }
              $merge = array_merge($before, $center, $after);
              $value = array_combine($merge, $merge);
            }

            //polozky value | optgroup
            //'value' => array('k' => 'v',)
            //'value' => array('k' => array('sk' => 'sv',),)
            $row = array();
            if (!empty($value)) {
              foreach ($value as $key => $val) {
                if (is_array($val)) {
                  $group = self::elem('optgroup')->label($key);
                  $r = array();
                  foreach ($val as $k => $v) {
                    $r[] = self::elem('option')->value((string) $k)
                                                ->selected(is_array($selected) ? in_array($k, $selected) : $k == $selected)
                                                ->setText($v);
                  }
                  $row[] = $group->insert($r);
                } else {
                  $row[] = self::elem('option')->value((string) $key)
                                                ->selected(is_array($selected) ? in_array($key, $selected) : $key == $selected)
                                                ->setText($val);
                }
              }
            }

            $element = self::elem('select')->name($multiple_name)
                                            ->class($input_class)
                                            ->multiple($multiple)
                                            ->size($size)
                                            ->disabled($disabled)
                                            ->accesskey($accesskey)
                                            ->tabindex($tabindex)
                                            ->title($title)
                                            ->insert($row);
          break;

          case 'addRadio':
            $row = array(); //TODO dodelat addRadio
            if (!empty($value)) {
              foreach ($value as $key => $val) {
                $row[] = self::elem('span')->setText($val);
                $row[] = self::elem('input')->type('radio')
                                            ->class($input_class)
                                            ->name($multiple_name)
                                            ->value($key)
                                            ->checked($key == $selected);
              }
            }
            $element = $row;
          break;

          case 'addImage':
            $src = Core::isFill($settings, 'src', NULL);
            $element = self::elem('input')->type('image')
                                          ->class($input_class)
                                          ->name($name)
                                          ->value($value)
                                          ->src($src)
                                          ->accesskey($accesskey)
                                          ->tabindex($tabindex)
                                          ->title($title);
          break;

          case 'addFile':
            $type = self::_T_FILE;
            $accept = Core::isFill($settings, 'accept', NULL);
            if (!empty($accept)) {
              $accept = implode(',', $accept);
            }

            $element = self::elem('input')->type('file')
                                          ->class($input_class)
                                          ->accept($accept)
                                          ->name($multiple_name)
                                          ->multiple($multiple)
                                          ->accesskey($accesskey)
                                          ->tabindex($tabindex)
                                          ->title($title)
                                          ->required($required);
          break;

          case 'addSubmit': //odesilaci tlacitko, ve formulari bude akceptovano jen jedno!
            $type = self::_T_SUBMIT;

            $this->element->submit = $name;

            $element = self::elem('input')->type('submit')
                                          ->class($input_class)
                                          ->name($name)
                                          ->value($value)
                                          ->accesskey($accesskey)
                                          ->tabindex($tabindex)
                                          ->title($title);
          break;

          case 'addButton':
            $element = self::elem('input')->type('button')
                                          ->name($name)
                                          ->value($value)
                                          ->accesskey($accesskey)
                                          ->tabindex($tabindex)
                                          ->title($title);
          break;

          case 'addReset':
            $element = self::elem('input')->type('reset')
                                          ->name($name)
                                          ->value($value)
                                          ->accesskey($accesskey)
                                          ->tabindex($tabindex)
                                          ->title($title);
          break;

          //html5
          case 'addEmail':
            $element = self::elem('input')->type('email')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          case 'addUrl':
            $element = self::elem('input')->type('url')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          case 'addNumber':
            $element = self::elem('input')->type('number')
                                          ->name($name)
                                          ->value($value)
                                          ->min($min)
                                          ->max($max)
                                          ->step($step)
                                          ->required($required);
          break;

          case 'addRange':
            $element = self::elem('input')->type('range')
                                          ->name($name)
                                          ->value($value)
                                          ->min($min)
                                          ->max($max)
                                          ->step($step);
          break;

          case 'addSearch':
            $element = self::elem('input')->type('search')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          case 'addColor':
            $element = self::elem('input')->type('color')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          case 'addDate':
            $element = self::elem('input')->type('date')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          case 'addMonth':
            $element = self::elem('input')->type('month')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          case 'addWeek':
            $element = self::elem('input')->type('week')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          case 'addTime':
            $element = self::elem('input')->type('time')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          case 'addDatetime':
            $element = self::elem('input')->type('datetime')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          case 'addDatetimeLocal':
            $element = self::elem('input')->type('datetime-local')
                                          ->name($name)
                                          ->value($value)
                                          ->required($required);
          break;

          //TODO udelat obalovaci metodu!!!??

          default:
            throw new ExceptionForm(sprintf('element s nazvem "%s" neexistuje nebo neni doposud implementovat!!!', $method));
          break;
        }

        $elem = $this->buildLabel($settings, $element);
        $this->element->form[] = array ('name' => $name,
                                        'type' => $type,
                                        'output' => self::TYPE_STRING,
                                        //'method' => $method,
                                        //'parameters' => $parameters,
                                        'multiple' => $multiple,
                                        'index' => Core::isFill($this->element->counts, $name, 0),
                                        'html' => $elem,
                                        );
        $this->element->lastindex = count($this->element->form) - 1;
        $this->element->elemtype[$name] = $type;

        //pokud je prazdne vlozi 1 pokud ne pricte jednicku
        if (empty($this->element->counts[$name])) {
          $this->element->counts[$name] = 1;
        } else {
          $this->element->counts[$name]++;
        }

      } catch (ExceptionForm $e) {
        echo $e;
      }
      return $this;
    }

//pridavani backlinku
    public function addBackLink($text, $adress, $args = array(), $settings = array()) {
      $this->element->before[] = self::elem('a', $settings)->href($adress, $args)
                                                            ->title($text)
                                                            ->setText($text);
      return $this;
    }

//pridavani pravidel
    public function addRule($type, $text = NULL, $args = NULL) {
      $index = $this->element->lastindex;
      $this->element->form[$index]['rule'][] = array ('type' => $type,
                                                      'text' => $text,
                                                      'args' => $args);
      return $this;
    }

//nastavovani konktretni vystupni hodnoty pro vystup
    public function setTypeVariable($type) {
      $index = $this->element->lastindex;
      $this->element->form[$index]['output'] = $type;
      return $this;
    }

//TODO metodu na vkladani vychozich hodnot, nebo z get/post
//jeste nastaveni vychozi hodnoty pred vyplnenim, (JS)
//po zadani vyplnovani tato hodnota zmizne!

    private function getArgs($name) {
      $source = NULL;

      switch ($this->element->elemtype[$name]) {
        case self::_T_TEXT:
        case self::_T_SUBMIT:
          $source = ($this->element->conf->method == self::METHOD_POST ? $_POST : $_GET);
        break;

        case self::_T_FILE:
          //$this->element->conf->enctype ???
          $source = $_FILES;
        break;
      }
      return Core::isNull($source, $name, NULL);  //isFill
    }

    private function getMethodValue($name) {
      $source = ($this->element->conf->method == self::METHOD_POST ? $_POST : $_GET);
      return Core::isNull($source, $name, NULL);
    }

//aplikace typu na zadanou promennou
    private function applyType($name, $type) {
      if ($type != self::TYPE_STRING) {
        settype($this->element->values[$name], $type);
      }
    }

//metoda pro overovani jestli jiz bylo znacknuto tlacitko instance formy
    //kontrola odeslani (znacknuti tlacitka submit)
    public function isSendet() {
      $result = false;
      if (!empty($this->element->submit)) {
        $submit_value = $this->getArgs($this->element->submit);
        $result = (!empty($submit_value));
      }
      return $result;
    }

//ekvivalent k ->addRule(Form::RULE_FILLED)
    public function setRequired($text) {
      $this->addRule(self::RULE_FILLED, $text);
      return $this;
    }

//validace dat, da se pouzit i misto isSubmitted()
    public function isValid() {
      $result = false;
      if (!$this->element->validate && $this->isSendet()) {
        $result = true;
        if (!empty($this->element->form)) {
          foreach ($this->element->form as $index => $elem) { //name,type,output,multiple,index,html,rule
            $name = $elem['name'];

            //nacteni hodnoty argumentu
            $arg = $this->getArgs($name);
            $readarg = $arg;  //ulozeni originalni hodnoty
            $this->element->values[$name] = $arg;

            //multiple jen u textu
            if ($elem['type'] == self::_T_TEXT && $elem['multiple'] && $this->element->counts[$name] > 1) {
              $arg = $arg[$elem['index']];  //predani spravneho indexu, jen pro ucely kontroly
            }

            if ($elem['type'] == self::_T_FILE) {
              if ($elem['multiple']) {
                $arg = $arg['name'][0];
              } else {
                $arg = $arg['name'];
              }
            }

            //zkontroluje jestli je neo v 0.indexu
            if (is_array($arg)) {
              $arg = $arg[0];
            }

//var_dump($index, $arg);

            //pokud jsou zadane podminky
            $rules = Core::isFill($elem, 'rule');
            if (!empty($rules)) {
              foreach ($rules as $rule) { //type,text,args
                //rozdeleni osetreni dle podminky
                $type = $rule['type'];
                switch ($type) {
                  case self::RULE_FILLED: //problem s nulou!
                    $arg = trim($arg);  //vyhazeni mezer/tabulatoru ze zacatku,konce
                    //pokud je textove prazdny argument
                    if ($arg == '') {  //kontrola prazdnosti
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;

                  case self::RULE_EQUAL:
                    if ($arg != $rule['args']) {
                      $this->addError($type, vsprintf($rule['text'], $rule['args']));
                      $result = false;
                    }
                  break;

                  case self::RULE_NOTEQUAL:
                    if (is_array($rule['args'])) {
                      if (in_array($arg, $rule['args'])) {
                        $this->addError($type, vsprintf($rule['text'], $arg));  //vraci zamerne aktualni hodnotu
                        $result = false;
                      }
                    } else {
                      if ($arg == $rule['args']) {
                        $this->addError($type, vsprintf($rule['text'], $rule['args']));
                        $result = false;
                      }
                    }
                  break;

                  case self::RULE_NUMERIC:
                    if (!is_numeric($arg)) {
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;

/*
                  case self::RULE_INTEGER:
                    if (!is_int($arg)) {
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;

                  case self::RULE_FLOAT:
                    if (!is_float($arg)) {
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;
*/

                  case self::RULE_MIN_LENGTH:
                    if (mb_strlen($arg, 'UTF-8') < $rule['args']) {
                      $this->addError($type, vsprintf($rule['text'], $rule['args']));
                      $result = false;
                    }
                  break;

                  case self::RULE_MAX_LENGTH:
                    if (mb_strlen($arg, 'UTF-8') > $rule['args']) {
                      $this->addError($type, vsprintf($rule['text'], $rule['args']));
                      $result = false;
                    }
                  break;

                  case self::RULE_LENGTH:
                    if (mb_strlen($arg, 'UTF-8') != $rule['args']) {
                      $this->addError($type, vsprintf($rule['text'], $rule['args']));
                      $result = false;
                    }
                  break;

                  case self::RULE_MIN_VALUE:
                    if ($arg < $rule['args']) {
                      $this->addError($type, vsprintf($rule['text'], $rule['args']));
                      $result = false;
                    }
                  break;

                  case self::RULE_MAX_VALUE:
                    if ($arg > $rule['args']) {
                      $this->addError($type, vsprintf($rule['text'], $rule['args']));
                      $result = false;
                    }
                  break;

                  case self::RULE_RANGE:
                    if ($arg < $rule['args'][0] || $arg > $rule['args'][1]) {
                      $this->addError($type, vsprintf($rule['text'], $rule['args']));
                      $result = false;
                    }
                  break;

                  case self::RULE_EMAIL:
                    $pattern = "/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$/";
                    if (!preg_match($pattern, $arg)) {
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;

                  case self::RULE_URL:
                    $pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
                    if (!preg_match($pattern, $arg)) {
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;

                  case self::RULE_REGEXP:
                    preg_match(sprintf('/%s/s', $rule['args']), $arg, $r);
                    $podm = (!empty($r) ? $r[0] == $arg : false); //vystupni retezec musi byt stejny jako zadavany
                    if (!$podm) {
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;

                  case self::RULE_COUNT:
                    $names = $readarg['name'];
                    if (count($names) > $rule['args']) {
                      $this->addError($type, vsprintf($rule['text'], $rule['args']));
                      $result = false;
                    }
                  break;
                } //end switch type

              } //end foreach rule
            } //empty rules
            $this->applyType($name, $elem['output']);  //aplikace pretypovani
          } //end foreach form
        } //end empty forms
        $this->element->validate = true;  //validace probehla
      }
      return $result;
    }

    //kontrola odeslani & auto validace dat
    public function isSubmitted($autovalidate = true) {
      $result = $this->isSendet();
      if ($autovalidate) {  //pokud je autovalidace povolena, provadi i zarovben autovalidaci
        $result = $this->isValid();
      }
      return $result;
    }

//nacteni jedne hodnoty
    public function getValue($name) {
      $result = NULL;
      if ($this->isSendet() && $this->element->validate) {  //vraci jen kdyz je odeslano a probehla jiz validace
        $result = $this->element->values[$name];
      }
      return $result;
    }

    public function setValues($data) {
      $this->element->loadvalues = $data;
      return $this;
    }

//nacteni pole hodnot
    //zadavat v poli polozky ktere se maji ignorovat (kdyz je potreba si je vybrat bokem)
    public function getValues(array $settings = array()) {
      $ignore = Core::isFill($settings, 'ignore');
      $define = Core::isFill($settings, 'define');

//FIXME mit moznost osetrovat vstypu taky aby html prevadel na zastupne texty html enetit
//kvuli XSS -> htmlentities($str, ENT_QUOTES) vicemene na textole elementy s uziv vstupem

      $result = NULL;
      if ($this->isSendet() && $this->element->validate) {  //vraci jen kdyz je odeslano a probehla jiz validace
        $result = array();
        foreach ($this->element->form as $index) {
          switch ($index['type']) {
            case self::_T_TEXT: //vypisuje vse krome submit
            case self::_T_FILE:
              $name = $index['name'];
              if (empty($ignore) && empty($define)) {
                //pokud je hodnota pole prepise se jakoby 2x zasebou
                $result[$name] = $this->element->values[$name];
              } else {
                if ((!empty($ignore) ? !in_array($name, $ignore) : true) &&
                    (!empty($define) ? in_array($name, $define) : true)) {
                  $result[$name] = $this->element->values[$name];
                }
              }
            break;
          }
        }
      }
      return $result;
    }

//zjisteni jestli jsou nejake chyby
    public function isErrors() {
      return (!empty($this->element->error));
    }

//TODO toto je radoby docasne nahradni reseni!!?????????
//pridani chyby
    private function addError($typ, $zprava) {
      $this->element->error[$typ][] = $zprava;
    }

//vraceni chyb
    public function getErrors($sablona = NULL) {
      $result = NULL;
      if (!empty($this->element->error)) {
        $err = array();
        foreach ($this->element->error as $typ => $errors) {
          $err = array_merge($err, $errors);  //sber chyb
        }
        //zpracovani hodnot pri vyuziti sablony
        if (empty($sablona)) {
          $result = implode(self::elem('br'), $err);
        } else {
          foreach ($err as $error) {
            $data = array('error' => $error);
            $result[] = $sablona->setTemplate($data)->render();
          }
        }
      }
      return $result;
    }


//http://www.html5tutorial.info/html5-placeholder.php
//http://diveintohtml5.org/forms.html


    //public function addCheckbox() {} uz jen skupinove!!!
    //public function addRadio() {} + skupinove!!!
    //public function addImage() {}
    //public function addContainer() {}

    //pradavne naskryptovane?????????
    //public function addTinyMCE() {}
    //public function addColor() {}
    //public function addCheckGroup() {}
    //public function addTime() {}
    //public function addDate() {}
    //public function addDateTime() {}



    //TODO pak jeste i zabudouvat kontrolu proti znovuodeslani stejneho formulare!!!
    //udelat osetreni proti: http://php.vrana.cz/cross-site-request-forgery.php
  }

  class ExceptionForm extends Exception {}

?>
