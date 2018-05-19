<?php
/*
 * Form.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      classes\Core,
      ArrayAccess;

  /**
   *
   * rozhrani s konstantami pro formulare
   *
   */

  interface FormRules {
    //const VERSION = 2.02;

    //metody formulare
    const GET = 'get',
          POST = 'post';

    const MIME_MULTIPART = 'multipart/form-data';

     // CSRF protection
    //~ const PROTECTION = 'Nette\Forms\Controls\HiddenField::validateEqual';

//with ':' is possible negation ~XXX
    // validator
    const EQUAL = ':equal', //porovnani, stejne?
          SAME = ':same', //striktnejsi porovnani
          IS_IN = ':equal', //je ve vyctu
          FILLED = ':filled', //vyplnene?
          VALID = ':valid'; //je prvek spravne vyplnen?

    // button
    const SUBMITTED = ':submitted';

    // text
    const MIN_LENGTH = ':minLength',  //min delka
          MAX_LENGTH = ':maxLength',  //max delka
          LENGTH = ':length', //presna delka/pole(nejkratsi, nejdelsi) hodnota
          EMAIL = ':email', //platny email
          URL = ':url', //platna url
          //~ REGEXP = ':regexp', //deprecated
          PATTERN = ':pattern', //platny regularni vyraz
          INTEGER = ':integer', //cele cislo
          NUMERIC = ':integer', //alias pro INTEGER
          FLOAT = ':float', //desetine cislo
          RANGE = ':range'; //ciselne rozmezi (nejnizsi, nejvyssi)

    // multiselect
    const COUNT = ':length';

    // file upload
    const MAX_FILE_SIZE = ':fileSize',  //maximalni velikost souboru
          MIME_TYPE = ':mimeType',  //povolemne mime text,text/pole(text, text)
          IMAGE = ':image'; //musi byt obrazek

    //konstantni indexy pro FormControl configure
    const _RULES = 'rules::';

    //other constants
    const _O_EMPTY_VALUE = 'empty_value',
          _O_PROMPT = 'prompt',
          _O_ITEMS = 'items';

    //typy condition & rule
    const _TYPE_CONDITION = 'condition',
          _TYPE_RULE = 'rule';

    //callback indexy (pro obaly prvku)
    const CALLBACK_LEGEND = 'legend',
          CALLBACK_FIELDSET = 'fieldset';

    //indexy globalnich form callback funckci
    const CALLBACK_LABEL = 'label_callback',
          CALLBACK_OBAL = 'obal_callback',
          CALLBACK_ELEMENT = 'element_callback',
          CALLBACK_BACKLINK = 'backlink_callback';
  }

  /**
   *
   * trida spravujici (rule) pravidla
   *
   */

  class FormRule implements FormRules {
    const VERSION = 2.02;

    private $rule = array();

    /**
     * hlavni konstruktor pravidel
     *
     * @param type typ pravidla
     * @param param parametry pravidla
     */
    public function __construct($type, $param) {
      $this->rule[$type] = $param;
      $this->rule['true'] = null;
      $this->rule['false'] = null;
    }

    /**
     * pridani true vetve pri condition
     *
     * @param param paramerty pravidla
     */
    public function addTrue($param) {
      if (empty($this->rule['true'])) {
        $this->rule['true'] = $param;
      } else {
        $this->rule['true'] = array_merge($this->rule['true'], $param);
      }
    }

    /**
     * nacteni true pravidel
     *
     * @return pole true pravidel
     */
    public function getTrue() {
      return $this->rule['true'];
    }

    /**
     * pridani false vetve pri condition
     *
     * @param param parametry pravidla
     */
    public function addFalse($param) {
      if (empty($this->rule['false'])) {
        $this->rule['false'] = $param;
      } else {
        $this->rule['false'] = array_merge($this->rule['false'], $param);
      }
    }

    /**
     * nacteni false pravidel
     *
     * @return pole false pravidel
     */
    public function getFalse() {
      return $this->rule['false'];
    }

    /**
     * nacteni typu podminky
     *
     * @return typ podminky
     */
    public function getRuleType() {
      $keys = array_keys($this->rule);
      return $keys[0];
    }

    /**
     * nacteni podminky
     *
     * @param index cislo podminky
     * @return pole podminky
     */
    public function getCondition($index) {
      $cond = $this->rule[self::_TYPE_CONDITION];
      $conf = $cond[0]->getConfigure(self::_RULES);
      return array(
                    'rules' => $conf[$index], //sub podminky
                    //'name' => $cond[0]->getHtmlName(),
                    'rule' => $cond[1],
                    'arg' => $cond[2],
                  );
    }

    /**
     * nacteni pravidel
     *
     * @return pole pravidel
     */
    public function getRules() {
      $cond = array_values($this->rule[self::_TYPE_RULE]);
      $cond = $cond[0];
      return array(
                    'rule' => $cond[0],
                    'msg' => $cond[1],
                    'arg' => $cond[2],
                  );
    }
  }

  /**
   *
   * trida spravujici kontrolu nad prvkama
   *
   */

  class FormControl implements FormRules {
    const VERSION = 2.20;

    private $control = null;

    /**
     * hlavni konstruktor
     *
     * @param data pole dat predavanych do instnace
     */
    public function __construct($data) {
      $this->control = array(
                              'html' => null,//$html,  //cislty element
                              'type' => null,//$type,
                              'source' => null,//$source,
                              'name' => null,//$name,
                              'callback' => null, //callback pro vykreslovani obalu a elementu
                              'configure' => array(),
                              'error' => array(),
                            );
      $this->control = array_merge($this->control, $data);
    }

    /**
     * nacteni html jmena
     *
     * @return html jmeno
     */
    public function getHtmlName() {
      return $this->control['name'];
    }

    /**
     * nacteni typu elementu
     *
     * @return typ elementu
     */
    public function getType() {
      return $this->control['type'];
    }

    /**
     * nacteni html jmena prvku
     *
     * @return html jmeno
     */
    public function getHtmlType() {
      return $this->control['html']->getName();
    }

    /**
     * nacteni Lighthtml objektu
     *
     * @return html objekt
     */
    public function getHtml() {
      return $this->control['html'];
    }

    /**
     * nacteni callback funckci
     * CALLBACK_OBAL, CALLBACK_ELEMENT
     *
     * @param index jmeno indexu, nepovinne
     * @return pole callback nebo konkterni callback
     */
    public function getCallBack($index = null) {
      $callback = $this->control['callback'];
      return ($index ? (isset($callback[$index]) ? $callback[$index] : null) : $callback);
    }

    /**
     * nacteni konfigurace instance
     *
     * @return pole konfigurace
     */
    public function getConfiguration() {
      return $this->control['configure'];
    }

    /**
     * nastaveni konfigurace instance
     *
     * @param configuration pole nove konfigurace
     * @return this
     */
    public function setConfiguration(array $configuration) {
      $this->control['configure'] = $configuration;
      return $this;
    }

    /**
     * pridani dalsiho indexu konfigurace
     *
     * @param key klic konfigurace
     * @param value hodnota konfigurace
     * @return this
     */
    public function addConfigure($key, $value) {
      if (empty($this->control['configure'][$key])) {
        $this->control['configure'][$key] = array($value);
      } else {
        $this->control['configure'][$key] = array_merge($this->control['configure'][$key], array($value));
      }
      return $this;
    }

    /**
     * nacteni konfigurace dle klice
     *
     * @param key klic konfigurace
     * @return hodnota konfigurace
     */
    public function getConfigure($key) {
      return (isset($this->control['configure'][$key]) ? $this->control['configure'][$key] : null);// $this->control['configure'][$key];
      //return $this->control['configure'][$key];
    }

    /**
     * nastaveni konkretniho klice konfigurace
     *
     * @param key klic konfigurace
     * @param value hodnota konfigurace
     * @return this
     */
    public function setConfigure($key, $value) {
      $this->control['configure'][$key] = $value;
      return $this;
    }

    /**
     * nacteni konkterniho html atributu
     *
     * @param name jmeno atributu
     * @return hotnota atributu
     */
    public function getAttribute($name) {
      return $this->control['html']->$name;
    }

    /**
     * nastaveni konkterniho atributu
     *
     * @param name jmeno atributu
     * @param value hodnota atributu
     * @return this
     */
    public function setAttribute($name, $value) {
      $this->control['html']->$name = $value;
      return $this;
    }

    /**
     * vrati predvyplnenou prazdnou hodnotu
     *
     * @return hodnota prazdne hodnoty
     */
    public function getEmptyValue() {
      return $this->getConfigure(self::_O_EMPTY_VALUE);
    }

    /**
     * nacteni hodnoty s poslane metody
     *
     * @param name jmeno promenne
     * @return hodnota dle jmena
     */
    private function getMethodValue($name = null) {
      $values = $this->control['source']->getMethodValues();
      //testuje jestli pod stejnym jmenem neni i pole souboru
      return (isset($values[$name]) ? $values[$name] : (isset($_FILES[$name]) ? $_FILES[$name] : null));
    }

    /**
     * nacteni nastavene hodnoty ve value
     *
     * @return value hodnota
     */
    public function getValue() {
      return $this->control['html']->value;
    }

    /**
     * nacteni poslane hodnoty z value
     *
     * @return hodnota poslana metodou
     */
    public function getSendValue() {
      return $this->getMethodValue($this->control['name']);
    }

    /**
     * nastaveni hodnoty do value
     *
     * @param value hodnota value
     * @return this
     */
    public function setValue($value) {
      $this->control['html']->value = $value;
      return $this;
    }

    /**
     * overeni jestli je odeslana hodnota plna
     *
     * @return true pokud je odeslana hodnota plna
     */
    public function isFilled() {
      $value = $this->getSendValue();
      return (!empty($value));
    }

    /**
     * nacteni polozek u selectu, chceckbox a radio group
     *
     * @return pole hodnot
     */
    public function getItems() {
      return (isset($this->control['configure'][self::_O_ITEMS]) ? $this->control['configure'][self::_O_ITEMS] : array());
    }

    /**
     * Adds error message to the list.
     *
     * @param message error message
     * @return this
     */
    public function addError($message) {
      $this->control['error'][] = $message;
      return $this;
    }

    /**
     * Returns validation errors.
     *
     * @return pole chyb
     */
    public function getErrors() {
      return $this->control['error'];
    }

    /**
     * existuje nejaky error
     *
     * @return true pokud jsou chyby
     */
    public function hasErrors() {
      return (!empty($this->control['error']));
    }

    /**
     * vycisteni pole chyb
     *
     * @return this
     */
    public function cleanErrors() {
      $this->control['error'] = array();
      return $this;
    }

    /**
     * kontrola a oprava nazvu negovaneho prvku
     *
     * @param rule typ pravidla
     * @return true pokud je znegovano
     */
    private function _checkNegation(&$rule) {
      $negation = (ord($rule[0]) > 127);  //zpracovani negace
      $rule = ($negation ? ~$rule : $rule);
      return $negation;
    }

    /**
     * kontrola pravidel
     *
     * @param rule typ pravidla
     * @param arg argument pravidla
     * @param value hodnota pravidla
     * @return true pokud pravidlo projde
     */
    private function _checkRule($rule, $arg, $value) {
      //var_dump($rule, $arg, $value);
      $result = null;
      switch ($rule) {
        /*
         * textove podminky
         */
        case self::MIN_LENGTH:  //min delka
          $result = ($arg <= mb_strlen($value, 'UTF-8'));
        break;

        case self::MAX_LENGTH:  //max delka
          $result = ($arg >= mb_strlen($value, 'UTF-8'));
        break;

        case self::LENGTH:  //presna delka/pole(nejkratsi, nejdelsi) hodnota
          $result = Core::isInRange(mb_strlen($value, 'UTF-8'), $arg);
        break;

        case self::EMAIL: //platny email
          $result = Core::isEmail($value);
        break;

        case self::URL: //platna url
          $result = Core::isUrl($value);
        break;

        case self::PATTERN: //platny vzor
          $result = (bool) preg_match('/^'.$arg.'$/', $value);
          //$result = (bool) preg_match('\x01^'.$arg.'$\x01u', $value);
        break;

        case self::INTEGER: //cele cislo
        $result = (bool) (is_int($value) || is_string($value) && preg_match('#^-?[0-9]+$#', $value));
        break;

        case self::FLOAT: //desetine cislo
          $result = (bool) (is_float($value) || is_int($value) || is_string($value) && preg_match('#^-?[0-9]*[.]?[0-9]+$#', $value));
        break;

        case self::RANGE: //ciselne rozmezi (nejnizsi, nejvyssi)
          $result = Core::isInRange($value, $arg);
        break;

        /*
         * validatory
         */

        case self::EQUAL: //porovnani, stejne?, resp: EQUAL/SAME
          if (is_array($arg)) {
            $result = in_array($value, $arg);
          } else {
            $result = ($arg == $value);
          }
        break;

        case self::SAME:  //striktnejsi porovnani
          $result = ($arg === $value);
        break;

        case self::FILLED:
          $result = ($value !== '');
        break;

        case self::VALID: //je prvek spravne vyplnen
          //TODO omfg? a toto ma byt zase co dpc?
        break;
//TODO dodelat!!! pozor bude muset umet zpracovavat jednotlive i pole!!!!
        /*
         * file upload
         */

        case self::MAX_FILE_SIZE: //mezeni na max velikost
          $filter_callback = function($size) use ($arg) {
            return ($arg >= $size);
          };
          $filter = array_filter((array) $value['size'], $filter_callback);
          $result = (count($filter) == count($value['size']));  //pokud sedi pocet
        break;

        case self::MIME_TYPE: //omezani na konktertni typ
          $filter_callback = function($type) use ($arg) {
            return ($arg == $type);
          };
          $filter = array_filter((array) $value['type'], $filter_callback);
          $result = (count($filter) == count($value['type']));  //pokud sedi pocet
        break;

        case self::IMAGE: //omezeni na vycet obrazku
          $image = array(
                          'image/png',
                          'image/jpeg',
                          'image/gif',
                        );
          $filter_callback = function($type) use ($image) {
            return in_array($type, $image);
          };
          $filter = array_filter((array) $value['type'], $filter_callback);
          $result = (count($filter) == count($value['type']));  //pokud sedi pocet
        break;
//~ SUBMITTED = ':submitted';
        default:
          if (is_callable($rule)) { //detekce vlastniho validatoru
            $result = call_user_func($rule, $value, $arg);
          } else {
            throw new ExceptionForm('unknown rules!');
          }
        break;
      }

      return $result;
    }

    /**
     * substituce error message
     *
     * @param message pro substituci
     * @return substituovana message
     */
    private function getSubstMessage($message) {
      $name = $this->getHtmlName();
      $label = $this->control['source']->getCurrentGroup()->getLabel($name);
      $value = $this->getSendValue();
      if (is_array($value)) { //TODO test musi vyhradne reagovat na files ne na multi promennou!
        $value = $value['name'];
        if (is_array($value)) { //osetreni subpole pokud je multiple
          $value = implode(', ', $value);
        }
      }

      return str_replace(array('%label', '%name', '%value'),
                        array($label, $name, $value),
                        $message);
    }

    /**
     * kontrola validace pravidel
     * substituce: '%label', '%name', '%value'
     *
     * @return true pokud pravidla plati
     */
    public function checkValidateRule() {
      $result = true;
      $rules = $this->getConfigure(self::_RULES);

      $value = $this->getSendValue();
      $emptyValue = $this->getConfigure(self::_O_EMPTY_VALUE);
      if ($value == $emptyValue) {
        $value = '';
      }

      if (!is_null($rules)) {
        foreach ($rules as $index => $rule) {

          switch ($rule->getRuleType()) {
            case self::_TYPE_CONDITION:
              $_cond = $rule->getCondition($index);
              $_state = $this->_checkRule($_cond['rule'], $_cond['arg'], $value);
              $_iterate = ($_state ? $_cond['rules']->getTrue() : $_cond['rules']->getFalse());

              if (!is_null($_iterate)) {
                foreach ($_iterate as $_rule => $_param) {
                  $_msg = $_param[1];
                  $_arg = $_param[2];

                  $_negation = $this->_checkNegation($_rule); //kontrola negace
                  $_r = $this->_checkRule($_rule, $_arg, $value);
                  $_r = ($_negation ? !$_r : $_r);  //pripadne negovani vysledku

                  if (!$_r) {
                    $_msg = $this->getSubstMessage($_msg);
                    $this->addError(vsprintf($_msg, $_arg));
                  }
                  $_res[] = $_r;
                }
                $result = (!in_array(false, $_res));
              }
            break;

            case self::_TYPE_RULE:
              $cond = $rule->getRules();
              $_rule = $cond['rule'];
              $_negation = $this->_checkNegation($_rule); //kontrola negace
              $_arg = $cond['arg'];
              $_message = $cond['msg'];
              $_r = $this->_checkRule($_rule, $_arg, $value);

              $result = ($_negation ? !$_r : $_r); //pripadne negovani vysledku

              if (!$result) {
                $_message = $this->getSubstMessage($_message);
                $this->addError(vsprintf($_message, $_arg));
              }
            break;
          }
        }
      }
      return $result;
    }
  }

  /**
   *
   * trida spravujici vytvareni skupin
   *
   */

  class FormGroup implements FormRules {
    const VERSION = 2.02;

    private $groups = null;

    /**
     * hlavni konstruktor skupiny
     * callback: CALLBACK_LEGEND, CALLBACK_FIELDSET
     *
     * @param caption nadpis (caption) sekce, '' je defaultni, null ukoncuje sekci
     * @param settings pole nastaveni skupiny
     */
    public function __construct($caption = null, $settings = array()) {
      $this->groups = new stdClass;
      $this->groups->caption = $caption;
      $this->groups->elements = null;
      $this->groups->labels = null;

      $this->groups->callback = array(
                                      self::CALLBACK_LEGEND => function($row) {  //implicitni callback pro legend
                                        return ($row['caption'] ? $row['html']::legend()->setText($row['caption']) : null); },
                                      self::CALLBACK_FIELDSET => function($row) {  //implicitni callback pro fieldset
                                        return $row['html']::fieldset()->add($row['legend'])->add($row['elements']); }
                                      );

      if (!empty($settings[self::CALLBACK_LEGEND])) {
        $this->groups->callback[self::CALLBACK_LEGEND] = $settings[self::CALLBACK_LEGEND];
      }

      if (!empty($settings[self::CALLBACK_FIELDSET])) {
        $this->groups->callback[self::CALLBACK_FIELDSET] = $settings[self::CALLBACK_FIELDSET];
      }
    }

    /**
     * pridani elementu a label popisku
     *
     * @param name jmeno elementu
     * @param label nazev labelu
     * @param elementu objekt elementu
     * @return this
     */
    public function addElement($name, $label, $element) {
      $this->groups->elements[] = $element;
      $this->groups->labels[$name] = $label;
      return $this;
    }

    /**
     * nacteni jmena labelu pro konkterni prvek ve skupine
     *
     * @param name jmeno prvku
     * @return obsal labelu
     */
    public function getLabel($name) {
      return $this->groups->labels[$name];
    }

    /**
     * nacteni caption cele skupiny
     *
     * @return caption skupiny
     */
    public function getCaption() {
      return $this->groups->caption;
    }

    /**
     * nastaveni caption pro skupinu
     *
     * @param caption nove jmeno skupiny
     * @return this
     */
    public function setCaption($caption) {
      $this->groups->caption = $caption;
      return $this;
    }

    /**
     * nastaveni callback funkci pro vykreslovani legendy (caption) a fieldsetu
     * callback: CALLBACK_LEGEND, CALLBACK_FIELDSET
     *
     * @param index callback funkce
     * @param callback callback funkce
     * @return this
     */
    public function setCallback($index, $callback) {
      $this->groups->callback[$index] = $callback;
      return $this;
    }

    /**
     * vraceni elementu
     *
     * @param data pole dat pro vykresleni skupiny
     * @return skupina
     */
    public function getElements($data) {
      $data['caption'] = $this->groups->caption;  //pridani caption indexu
      if (!is_null($data['caption'])) { //pokud je caption definovany
        $data[self::CALLBACK_LEGEND] = $this->groups->callback[self::CALLBACK_LEGEND]($data); //generovani legendy z callback
        $data['elements'] = $this->groups->elements;  //pridani elements indexu
        return (!is_null($data['elements']) ? $this->groups->callback[self::CALLBACK_FIELDSET]($data) : null);
      } else {
        return $this->groups->elements;
      }
    }
  }

  /**
   *
   * hlavni trida tvorici formular
   *
   */
//TODO nastavovat kodovani formularovach textu!!!!????
  class Form implements FormRules, ArrayAccess {
    const VERSION = 4.26;

    private $form = null; // instancni atribut obsahu

    /**
     * hlavni konstruktor
     * callback: CALLBACK_LABEL, CALLBACK_BACKLINK, CALLBACK_OBAL, CALLBACK_ELEMENT
     *
     * @param settings
     */
    public function __construct(array $settings = array(), $htmlClass = 'classes\Html') {
      $this->form = new stdClass;

      $attributes = array(//'accept' => null,  //neni v HTML5
                          //form nastaveni
                          'accept-charset' => null,
                          'action' => '',
                          'autocomplete' => null, //on|off
                          'enctype' => null,  //MIME_MULTIPART
                          'method' => self::POST,
                          'name' => null,
                          'novalidate' => null,
                          'target' => null,
                          'class' => null,
                          'id' => null,
                          'onSubmit' => null,
                          'onReset' => null,
                          //systemove nastaveni
                          //globalni label
                          self::CALLBACK_LABEL => function($row) { //$row['html'], $row['label'], $row['element']
                                                    return $row['element']; },
                          //globalni backlink
                          self::CALLBACK_BACKLINK => function($row) {
                                                        return $row['html']::a()->href('', $row['href'])->title($row['text'])->setText($row['text']); },
                          self::CALLBACK_OBAL => function($row) { //obal group elementu
                                                    return $row['html']::div()->add($row['rows']); },
                          self::CALLBACK_ELEMENT => function($row) {  //element pro group
                            $res[] = $row['element'];
                            $res[] = $row['html']::span()->setText($row['value']);
                            return $res; },
                          );
      //slouceni defaultni konfigurace a nastaveni
      $this->form->attribute = array_merge($attributes, $settings);

      $this->form->htmlClass = $htmlClass; //html generator

      $this->form->elements = array();  //pole elementu
      $this->form->lastElement = null;  //jmeno (index) posledniho pridaneho prvku
      $this->form->lastCondition = null;
      $this->form->lastConditionState = true;
      $this->form->submittedBy = null;  //index elementu ktery se stara o odesilani
      $this->form->errors = array();  //pole chyb

      $this->form->groups = array();  //pole skupin fieldsetu
      $this->form->groupsName = array();  //jmenne pole skupin
      $this->form->lastGroup = null;  //posledni aktivni skupina

      $this->form->backLinks = array(); //pole backlinku
      $this->form->lastBackLink = null; //posledni aktivni backlink

      $this->addGroup('');  //fieldset da se vypnout kdyz se na zacatku uvede ->addGroup()
    }

    /**
     * vrati nastaveny action url
     *
     * @return action url
     */
    public function getAction() {
      return $this->form->attribute['action'];
    }

    /**
     * nastavi novy action url form
     *
     * @param url novy url action
     * @return this
     */
    public function setAction($url) {
      $this->form->attribute['action'] = $url;
      return $this;
    }

    /**
     * vrati nastavenou form metodu
     *
     * @return metoda formulare
     */
    public function getMethod() {
      return $this->form->attribute['method'];
    }

    /**
     * nacteni pole podle zvolene posilaci metody
     * $_FILES se resi zvlast v getMethodValue() [FormControl]
     *
     * @return pole odeslanych hodnot
     */
    public function getMethodValues() {
      switch ($this->form->attribute['method']) {
        case self::POST:
          return $_POST + $_FILES;
        break;

        case self::GET:
          return $_GET;
        break;
      }
    }

    /**
     * nastavi novou form metodu
     *
     * @param method nova metoda
     * @return this
     */
    public function setMethod($method) {
      if (!empty($method)) {
        $this->form->attribute['method'] = $method;
      }
      return $this;
    }

    /**
     * vrati pole atributu form
     *
     * @return pole argumentu
     */
    public function getFormAttributes() {
      return $this->form->attribute;
    }

    /**
     * nastaveni atributu formuare
     *
     * @param name jmeno atributu
     * @param value hodnota atributu
     * @return this
     */
    public function setFormAttribute($name, $value) {
      $this->form->attribute[$name] = $value;
      return $this;
    }

    /**
     * nastaveni atributu elementu
     *
     * @param name jmeno atributu
     * @param value hodnota atributu
     * @return this
     */
    public function setAttribute($name, $value) {
      $this->form->lastElement->setAttribute($name, $value);
      return $this;
    }

//csrf protekce (+session)
    //public function addProtection($message = NULL, $timeout = NULL) {}

    /**
     * Adds fieldset group to the form.
     * null pro konec skupiny
     *
     * @param caption nadpis skupiny
     * @param settings pole nastaveni
     * @return this
     */
    public function addGroup($caption = null, $settings = array()) {
      $group = new FormGroup($caption, $settings); //vytvoreni instance
      $this->form->lastGroup = $group;
      $this->form->groups[] = $group; //volne pole skupin
      $this->form->groupsName[$caption] = $group; //jmene pole skupin
      return $this;
    }

    /**
     * Removes fieldset group from form.
     * vcetne elementu
     *
     * @param name nazev skupiny
     * @return this
     */
    public function removeGroup($name) {
      foreach ($this->form->groups as $index => $group) {
        if ($group === $this->form->groupsName[$name]) {  //vyhledani instance
          //zruseni instance na indexu a zruseni z skupunovych jmen
          unset($this->form->groups[$index], $this->form->groupsName[$name]);
          break;
        }
      }
      return $this;
    }

    /**
     * Returns the specified group.
     *
     * @param nazev skupiny
     * @return objekt skupiny
     */
    public function getGroup($name) {
      return $this->form->groupsName[$name];
    }

    /**
     * Returns current group.
     *
     * @return aktualni objekt skupiny
     */
    public function getCurrentGroup() {
      return $this->form->lastGroup;
    }

    /**
     * Returns all defined groups.
     *
     * @return pole objektu skupin
     */
    public function getGroups() {
      return $this->form->groups; //jmeno lze zjistit ->getCaption()
    }

    /**
     * osetrovani pokud klic pole existuje, funkci "array_key_exists"
     *
     * @param array vstupni pole
     * @param key klic do pole
     * @param defautl defaultni polozka
     * @return hodnota z pole pokud v poli existuje
     */
    private function _isNull($array, $key, $default = '') {
      return (is_array($array) && array_key_exists($key, $array) ? $array[$key] : $default);
    }

    /**
     * pridani back linku
     * callback: CALLBACK_BACKLINK
     *
     * @param text nazev linku
     * @param href pole adres linku
     * @param settings pole nastaveni
     * @return this
     */
    public function addBackLink($text, $href = array(), $settings = array()) {
      $backlink_callback = $this->_isNull($settings, self::CALLBACK_BACKLINK);

      $backlink_callback_data = array('html' => $this->form->htmlClass, 'href' => $href, 'text' => $text, 'settings' => $settings);
      if ($backlink_callback) {
        $link = $backlink_callback($backlink_callback_data);
      } else {
        $link = $this->form->attribute[self::CALLBACK_BACKLINK]($backlink_callback_data);
      }
      $this->form->backLinks[] = $link;
      $this->form->lastBackLink = $link;

      return $this;
    }

    /**
     * hlavni pretezovaci metoda vytvarejici elementy
     *
     * @param method nazev metody
     * @param parameters pole parametru
     * @return this
     */
    public function __call($method, $parameters) {
      $element = null;

      $this->endCondition();  //uzavreni podminek

//var_dump($method, $parameters);
      $html = $this->form->htmlClass;

      $name = $this->_isNull($parameters, 0);
      $settings = $this->_isNull($parameters, 1);

      //pokud je druhy parametr text
      if (is_string($settings)) {
        $settings = array('label' => $settings);
      }

      $val = $this->_isNull($parameters, 2);
      if (!empty($val)) {
        $settings['value'] = $val;
      }

      // pokud jsou 3 parametry vyplneny podle nette stylu, 4 arg je settings
      $ext = $this->_isNull($parameters, 3);
      if (!empty($ext)) {
        $settings = array_merge($settings, $ext);
      }

//var_dump($settings);
      //osetreni pro name
      if (!$name) { //overovani prazdnoty jmena
        throw new ExceptionForm('name for: '.$method.' is empty!!');
      }
      $name_multiple = $name.(!$this->_isNull($settings, 'multiple', false) ? '' : '[]');  //multiple jmena

      //systemove nastaveni elementu
      $label = $this->_isNull($settings, 'label');
      $label_callback = $this->_isNull($settings, self::CALLBACK_LABEL);
      $obal_callback = $this->_isNull($settings, self::CALLBACK_OBAL);
      $element_callback = $this->_isNull($settings, self::CALLBACK_ELEMENT);

      //nulovani indexu ktere nemaji co delat v elementech
      $settings['label'] = null;
      $settings[self::CALLBACK_LABEL] = null;
      $settings[self::CALLBACK_OBAL] = null;
      $settings[self::CALLBACK_ELEMENT] = null;

      //rozdelovani metod
      switch ($method) {
        //main elements
        case 'addText': //addText($name, $settings = array())
          $element = $html::input($settings)
                          ->type('text')
                          ->name($name);
        break;

        case 'addPassword': //addPassword($name, $settings = array())
          $element = $html::input($settings)
                          ->type('password')
                          ->name($name);
        break;

        case 'addTextArea': //addTextArea($name, $settings = array())
        case 'addTextarea':
          $default = array('cols' => 40, 'rows' => 10);
          $value = (isset($settings['value']) ? $settings['value'] : null);
          $settings['value'] = null;

          $element = $html::textarea(array_merge($default, $settings))
                          ->name($name)
                          ->setText($value);
        break;

        case 'addHidden': //addHidden($name, $settings = array())
          $element = $html::input($settings)
                          ->type('hidden')
                          ->name($name);
        break;

        case 'addSubmit': //addSubmit($name, $settings = array())
          $element = $html::input($settings)
                          ->type('submit')
                          ->name($name);
          $this->form->submittedBy = $name;
        break;

        case 'addReset':  //addReset($name, $settings = array())
          $element = $html::input($settings)
                          ->type('reset')
                          ->name($name);
        break;

        case 'addImage':  //addImage($name, $settings = array())
          $element = $html::input($settings)
                          ->type('image')
                          ->name($name);
        break;

        case 'addButton': //addButton($name, $settings = array())
          $element = $html::input($settings)
                          ->type('button')
                          ->name($name);
        break;

        case 'addUpload': //addUpload($name, $settings = array())
        case 'addFile': //deprecated
          $element = $html::input($settings)
                          ->type('file')
                          ->name($name_multiple);
          //automaticke doplneni atributu
          $this->setFormAttribute('enctype', self::MIME_MULTIPART);
        break;

        case 'addSelect':  //addSelect($name, $settings = array())
          $value = $this->_isNull($settings, 'value');
          $settings['value'] = null;

          $range = $this->_isNull($settings, 'range');
          $settings['range'] = null;
          //podpora rozsahu
          if (empty($value) && !empty($range)) {
            $range = range($range[0], $range[1]);
            $value = array_combine($range, $range);
          }

          //generovani polozek
          $rows = $this->generateItems('select', $name, $value, $settings);

          $element = $html::select($settings)
                          ->name($name_multiple)
                          ->add($rows);
        break;

        case 'addMultiSelect':  //addMultiSelect($name, $settings = array())
          //pouze vece nastaveny select
          $default = array('size' => 4, 'multiple' => true);
          return $this->addSelect($name, array_merge($default, $settings)); //umi mutiple name
        break;

        case 'addCheckbox':  //addCheckbox($name, $settings = array())
          $element = $html::input($settings)
                          ->type('checkbox')
                          ->name($name_multiple);
        break;

        case 'addCheckList':  //addCheckList($name, $settings = array())
          $value = $this->_isNull($settings, 'value');
          $settings['value'] = null;

          //generovani polozek
          $rows = $this->generateItems('checkbox', $name, $value, $settings, $element_callback);

          $obal_callback_data = array('html' => $html, 'rows' => $rows, 'settings' => $settings);
          if ($obal_callback) {
            $element = $obal_callback($obal_callback_data);
          } else {
            $element = $this->form->attribute[self::CALLBACK_OBAL]($obal_callback_data);
          }
        break;

        case 'addRadioList':  //addRadioList($name, $settings = array())
          $value = $this->_isNull($settings, 'value');
          $settings['value'] = null;

          //generovani polozek
          $rows = $this->generateItems('radio', $name, $value, $settings, $element_callback);

          $obal_callback_data = array('html' => $html, 'rows' => $rows, 'settings' => $settings);
          if ($obal_callback) {
            $element = $obal_callback($obal_callback_data);
          } else {
            $element = $this->form->attribute[self::CALLBACK_OBAL]($obal_callback_data);
          }
        break;

        //html5 elememts
        case 'addEmail':  //addEmail($name, $settings = array())
          $element = $html::input($settings)
                          ->type('email')
                          ->name($name);
        break;

        case 'addUrl':  //addUrl($name, $settings = array())
          $element = $html::input($settings)
                          ->type('url')
                          ->name($name);
        break;

        case 'addPhone':  //addPhone($name, $settings = array())
          $element = $html::input($settings)
                          ->type('tel')
                          ->name($name);
        break;

        case 'addNumber': //addNumber($name, $settings = array())
          $element = $html::input($settings)
                          ->type('number')
                          ->name($name);
        break;

        case 'addRange':  //addSearch($name, $settings = array())
          $element = $html::input($settings)
                          ->type('range')
                          ->name($name);
        break;

        case 'addSearch': //addSearch($name, $settings = array())
          $element = $html::input($settings)
                          ->type('search')
                          ->name($name);
        break;

        case 'addColor':  //addColor($name, $settings = array())
          $element = $html::input($settings)
                          ->type('color')
                          ->name($name);
        break;

        case 'addDatalist': //addDatalist($name, $settings = array())
          //TODO podobny prvek jako select, az na to ze se datalist vaze na input
          //pres ID datalistu?!
        break;

        case 'addDate': //addDate($name, $settings = array())
          $element = $html::input($settings)
                          ->type('date')
                          ->name($name);
        break;

        case 'addWeek': //addWeek($name, $settings = array())
          $element = $html::input($settings)
                          ->type('week')
                          ->name($name);
        break;

        case 'addMonth':  //addMonth($name, $settings = array())
          $element = $html::input($settings)
                          ->type('month')
                          ->name($name);
        break;

        case 'addTime': //addTime($name, $settings = array())
          $element = $html::input($settings)
                          ->type('time')
                          ->name($name);
        break;

        case 'addDatetime': //addDatetime($name, $settings = array())
        case 'addDateTime': //addDateTime($name, $settings = array())
          $element = $html::input($settings)
                          ->type('datetime')
                          ->name($name);
        break;

        case 'addDatetimeLocal':  //addDatetimeLocal($name, $settings = array())
        case 'addDateTimeLocal':  //addDateTimeLocal($name, $settings = array())
          $element = $html::input($settings)
                          ->type('datetime-local')
                          ->name($name);
        break;

        //jine elementy
        case 'addLabel':  //addLabel($text, $settings = array())
          $element = $html::label($settings)->setText($name);
        break;

        case 'addElement':  //addElement($text, $settings = array(), $element)
          $element = $this->_isNull($parameters, 2);
        break;

        default:
          throw new ExceptionForm('unknown element!');
        break;
      }

      if (!is_null($element)) { //create self instance Control
        //budovani obalu z callback funkci
        $label_callback_data = array('html' => $html, 'type' => $method, 'label' => $label, 'element' => $element,);
        if (!empty($label_callback)) {
          $element_obal = $label_callback($label_callback_data);  //uzivatelsky callback
        } else {
          $element_obal = $this->form->attribute[self::CALLBACK_LABEL]($label_callback_data);  //defaultni callback
        }

        $this->form->lastGroup->addElement($name, $label, $element_obal);  //prideni elementu s name a label-em do obalu

        $data = array(
                      'source' => $this,
                      'type' => $method,
                      'name' => $name,
                      'html' => $element,
                      'callback' => array(self::CALLBACK_OBAL => $obal_callback,
                                          self::CALLBACK_ELEMENT => $element_callback,),
                      );

        $elem = new FormControl($data); //predava se naplnene pole
        $this->form->elements[$name] = $elem; //prida element do pole k ostatnim elementum
        $this->form->lastElement = $elem; //nastavi instanci posledniho prvku

        if (!empty($this->form->submittedBy) && !($this->form->submittedBy instanceof FormControl)) {
          $this->form->submittedBy = $elem;
        }
      }
      return $this;
    }

    /**
     * generovani polozek pro radio a checkbo group, select
     * callback: CALLBACK_ELEMENT
     *
     * @param type typ elementu
     * @param name name elementu
     * @param value value elementu
     * @param settings pole nastaveni eleemntu
     * @param element_callback callback elementu
     * @return vygenerovane radky
     */
    private function generateItems($type, $name, $value, $settings = null, $element_callback = null) {
      $rows = null;
      $html = $this->form->htmlClass;

      //radio nebo checkbox
      if ($type == 'radio' || $type == 'checkbox') {
        $list_callback = function($value, $key, $data) {
          //vytvareni elementu
          $element = $data['html']::input($data['settings'])
                                  ->type($data['type'])
                                  ->name($data['name']) //stejne jmeno
                                  ->value($key);
          //slozeni pole pro callback
          $callback_data = array_merge($data, array('key' => $key, 'value' => $value, 'element' => $element));
          //skladani radku
          $data['rows'] = array_merge($data['rows'], $data['callback']($callback_data));
        };

        if (!empty($value)) {
          $rows = array();
          //volba callback funkce
          $callback = ($element_callback ?: $this->form->attribute[self::CALLBACK_ELEMENT]);
          $list_callback_data = array('html' => $html, 'type' => $type, 'rows' => &$rows, 'name' => $name,
                                      'callback' => $callback, 'settings' => $settings);
          array_walk($value, $list_callback, $list_callback_data);
        }
      }

      //select
      if ($type == 'select') {
        $option_callback = function($value, $key, $data) {
          $html = $data['html'];
          if (!is_array($value)) {
            $data['rows'][] = $html::option()->value($key)->setText($value);
          } else {
            $rows = &$data['rows']; //ulozeni puvodni adresy
            unset($data['rows']); //zruseni puvodni adresy
            $data['rows'] = &$group;  //prilozeni nove adresy
            array_walk($value, $data['callback'], $data); //pruchod pro skupinu
            $rows[] = $html::optgroup()->label($key)->add($group);  //vlozeni do puvodniho
          }
        };

        //$rows = null;
        if (!empty($value)) {
          $option_callback_data = array('html' => $html, 'rows' => &$rows, 'callback' => $option_callback);
          array_walk($value, $option_callback, $option_callback_data);
        }
      }

      return $rows;
    }

    /**
     * nastavovani polozek pro radio a checkbox group, select
     *
     * @param items pole polozek
     * @return this
     */
    public function setItems(array $items) {
      $last = $this->form->lastElement;
      $last->setConfigure(self::_O_ITEMS, $items);

      switch ($last->getType()) {
        case 'addRadioList':
          $type = 'radio';
        break;

        case 'addCheckList':
          $type = 'checkbox';
        break;

        case 'addSelect':
          $type = 'select';
        break;
      }

      $rows = $this->generateItems($type, $last->getHtmlName(), $items, null, $last->getCallBack(self::CALLBACK_ELEMENT));
      $last->getHtml()->add($rows);
      return $this;
    }

    /**
     * nastavi prazdnou hodnotu value
     * hodnota je pri validaci posuzovana jako by bylo pole prazdne
     *
     * @param value hodnota value
     * @return this
     */
    public function setEmptyValue($value) {
      $last = $this->form->lastElement;
      $last->setConfigure(self::_O_EMPTY_VALUE, $value);
      $last->setValue($value);
      return $this;
    }
//TODO udelat verzi pro formcontrol (setDefaultValue)
    /**
     * Sets control's default value.
     * nastaveni hodnoty pokud nebyl nejaky element odeslan
     * umistuje do formulare
     *
     * @param value hodnota pro posleni aktivni element
     * @return this
     */
    public function setDefaultValue($value) {
      if (!$this->_isSubmitted()) { //pokud nebylo odeslano
        $this->form->lastElement->setValue($value);
      }
      return $this;
    }

    /**
     * vnitrni hromadne nastavovani hodnot value
     *
     * @param values pole hodnot
     * @return this
     */
    private function _setValues(array $values, $ignore = array()) {
      foreach ($values as $k => $v) {
        //kontrola existence prvku a pokud neni v poli ignorovanych
        if (isset($this->form->elements[$k]) && !in_array($k, $ignore)) {
          $element = $this->form->elements[$k];
          //nastavovani posle typu elementu
          switch ($element->getHtmlType()) {
            case 'select':
              $children = $element->getHtml()->getChildren();
              foreach ($children as $child) {
                //pokud ma select optgroup nebo option
                switch ($child->getName()) {
                  case 'optgroup':
                    $callback_optgroup = function($val, $key, $data) {
                      if (is_array($data)) {
                        $val->selected(in_array($val->value, $data));
                      } else {
                        $val->selected($val->value == $data);
                      }
                    };
                    $gchild = $child->getChildren();
                    array_walk($gchild, $callback_optgroup, $v);
                  break;

                  case 'option':
                    if (is_array($v)) {
                      $child->selected(in_array($child->value, $v));
                    } else {
                      $child->selected($child->value == $v);
                    }
                  break;
                }
              }
            break;

            case 'textarea':
              $this->form->elements[$k]->getHtml()->setText($v);
            break;

            default:
              $elemHtml = $this->form->elements[$k]->getHtml();

              if (!isset($elemHtml->type)) {
                $callback_group = function($val, $key, $data) {
                  if ($val->getName() == 'input') {
                    if (is_array($data)) {  //pro radio nebo checkbox
                      $val->checked(in_array($val->value, $data));
                    } else {
                      $val->checked($val->value == $data);
                    }
                  }
                };
                $children = $elemHtml->getChildren();
                array_walk($children, $callback_group, $v);
              } else {
                //vyber dle typu inputu
                switch ($elemHtml->type) {
                  case 'checkbox':
                    //pokud ma value kontriluje value, jinak bere v potaz on
                    $elemHtml->checked(isset($elemHtml->value) ? $elemHtml->value == $v : $v == 'on');
                  break;

                  case 'file':
                  //case 'password':
                  break;

                  default:
                    $this->form->elements[$k]->setValue($v);
                  break;
                }
              }
            break;
          }
        }
      }
      return $this;
    }

    /**
     * nastavovani defaultnich hodnot do formulare, pokud jeste nebyl odeslan
     * musi byt pred ->reder()
     *
     * @param values pole hodnot
     * @param ignore pole ignorovanych hodnot (hesla apod)
     * @return this
     */
    public function setDefaults(array $values, $ignore = array()) {
      if (!$this->isSubmitted()) { //pokud nebylo odeslano
        $this->_setValues($values, $ignore);
      }
      return $this;
    }

    /**
     * nastavovani odeslanych hodnot po odeslani formulare, vetsinou pri chybnem vyplneni
     * musi byt pred ->reder()
     *
     * @param values pole hodnot
     * @param ignore pole ignorovanych hodnot (hesla apod)
     * @return this
     */
    public function setReturnValues(array $values, $ignore = array()) {
      if ($this->isSubmitted()) {
        $this->_setValues($values, $ignore);
      }
      return $this;
    }

    /**
     * prida condition podminku na aktualni element
     *
     * @param operation typ pravidla (podminky)
     * @param arg argument pravidla
     * @return this
     */
    public function addCondition($operation, $arg = null) {
      $this->addConditionOn($this->form->lastElement, $operation, $arg);
      return $this;
    }

    /**
     * prida condition podminku na konkterni element
     *
     * @param control kontrolni objekt
     * @param operation typ pravidla
     * @param arg agrument pravidla
     * @return this
     */
    public function addConditionOn($control, $operation, $arg = NULL) {
      $this->endCondition();  //uzavreni podminek

      $rule = new FormRule(self::_TYPE_CONDITION, array($control, $operation, $arg));
      $this->form->lastCondition = $rule;
      $control->addConfigure(self::_RULES, $rule);
      return $this;
    }

    //TODO moznost ovladat podminkama prepinani atributu nebo prepinani kodu

    /**
     * zajisti prepnuti z true vetve na false vetev v condition podmince
     *
     * @return this
     */
    public function elseCondition() {
      //prepnuti na false blok
      $this->form->lastConditionState = false;
      return $this;
    }

    /**
     * ukonceni condition podminky
     *
     * @return this
     */
    public function endCondition() {
      $this->form->lastCondition = null;
      $this->form->lastConditionState = true;
      return $this;
    }

    /**
     * prida pravidlo na posledni element
     *
     * @param type typ pravidla, konstanta nebo callback funkce
     * @param text text pri nedodrzeni podminky
     * @param args argumenty pravidla
     * @return this
     */
    public function addRule($type, $text = null, $args = null) {
      if ($this->_isSubmitted() && $args instanceof FormControl) {
        $args = $args->getSendValue();  //vybrani hodnoty z jineho elementu
      }

      $rule = array($type => array($type, $text, $args));

      if (!is_null($this->form->lastCondition)) {
        //prepinani true nebo false vetve
        if ($this->form->lastConditionState) {
          $this->form->lastCondition->addTrue($rule);
        } else {
          $this->form->lastCondition->addFalse($rule);
        }
      } else {
        //vkladani podminky
        $r = new FormRule(self::_TYPE_RULE, $rule);
        $this->form->lastElement->addConfigure(self::_RULES, $r);
      }

      return $this;
    }

    /**
     * predefinovane pravidlo na vyplnou hodnotu, FILLED
     *
     * @param message chybova hlaska pokud pravidlo nebude platit
     * @return this
     */
    public function setRequired($message = NULL) {
      return $this->addRule(self::FILLED, $message);
    }

    /**
     * Returns first prompt item?
     * prvni vybrana polozka u select-u
     *
     * @return
     */
    public function getPrompt() {
      return $this->form->lastElement->getConfigure(self::_O_PROMPT);
    }

    /**
     * Sets first prompt item in select box
     * nastavi prvni vybranou polozku u selectu
     *
     * @param prompt text prvni polozky
     * @return this
     */
    public function setPrompt($prompt) {
      $htmlClass = $this->form->htmlClass;
      $last = $this->form->lastElement; //posledni element
      if ($last->getHtmlType() == 'select') {
        $children = $last->getHtml()->getChildren();  //nacteni potomku
        //pokud je option a uz je tam value '' tak prepisuje jinak vklada
        if ($children[0]->getName() == 'option' && $children[0]->value == '') {
          $children[0]->clearText()->setText($prompt);
        } else {
          $last->getHtml()->insert(0, $htmlClass::option()->value('')->setText($prompt));
        }
        $last->setConfigure(self::_O_PROMPT, $prompt);
      } else {
        throw new ExceptionForm('"'.$last->getHtmlName().'" is not input type select');
      }
      return $this;
    }

    /**
     * vraci hohnoty ktere byli odeslany
     *
     * @return pole odeslanych hodnot
     */
    public function getValues() {
      return $this->getMethodValues();
    }

    /**
     * interni nepresna detekce odeslaneho formulare
     *
     * @return true pokud je neco v odeslane metode
     */
    private function _isSubmitted() {
      $values = $this->getMethodValues(); //TODO mozna case trochu poupravit????
      return (!empty($values));
    }

    /**
     * test na odeslani aktualniho formulare
     *
     * @return true pokud je aktualni formular odeslany
     */
    public function isSubmitted() {
      return (!is_null($this->form->submittedBy->getSendValue()));
    }

    /**
     * overuje jestli jsou odeslana formularova data validni
     *
     * @return true kdyz jsou formularove data validni
     */
    public function isValid() {
      // checkovani formularu
      $callback_check = function($v) {
        $v->checkValidateRule();
        return $v->hasErrors();
      };
      $filter = array_filter($this->form->elements, $callback_check);

      // zoracovani erroru
      $callback_error = function($v, $k, $data) {
        $data['err'] = array_merge($data['err'], $v->getErrors());
      };
      array_walk($filter, $callback_error, array('err' => &$this->form->errors));

      // nesmi obsahovat chyby
      return (empty($this->form->errors));
    }

    /**
     * vraci pole erroru z chybne validace
     *
     * @return pole erroru
     */
    public function getErrors() {
      return $this->form->errors;
    }

    /**
     * overuje jestli je nejaka chyba pri validaci
     *
     * @return true pokud se vyskytuji nejake chyby
     */
    public function hasErrors() {
      return (!empty($this->form->errors));
    }

    //pokud je odeslano + spravne validovano
    public function isSuccess() {
      return ($this->isSubmitted() && $this->isValid());
    }

//TODO nastavovani odesilaciho tlacitka
    //~ public function setSubmittedBy(ISubmitterControl $by = null) {}

    /**
     * nastavuje caption hlavni skupiny ('')
     *
     * @param text caption hlavni skupiny
     * @return
     */
    public function setLegend($text) {
      $this->getGroup('')->setCaption($text);
      return $this;
    }

    /**
     * zajistuje vykresleni pri funkci echo
     *
     * @return textova podoba formulare
     */
    public function __toString() {
      return strval($this->render());
    }

    /**
     * zajistuje renderovani formulare
     * sam nevola ->render() !! ten se az externe vola v toString
     *
     * @param depth aplikace manualniho zanoreni
     * @return objekt html generoatoru
     */
    public function render($depth = 0) {
      $this->form->lastElement = null;  //vynulovani posledniho elementu
      $this->endCondition();  //uzavreni podminek

      $htmlClass = $this->form->htmlClass;

      //resetovani indexu ktere nemaji co delat ve formulari
      $this->form->attribute[self::CALLBACK_LABEL] = null;
      $this->form->attribute[self::CALLBACK_BACKLINK] = null;
      $this->form->attribute[self::CALLBACK_OBAL] = null;
      $this->form->attribute[self::CALLBACK_ELEMENT] = null;

      $form = $htmlClass::form($this->form->attribute)->setDepth($depth);

      $form->add($this->form->backLinks); //vkladani backlinku

      //defaultni data pro callback
      $callback_data = array('html' => $htmlClass);

      //generovani primo do formulare
      foreach ($this->form->groups as $group) {
        $form->add($group->getElements($callback_data));
      }

      return $form;
    }

    /**
     * array access
     */

    /**
     * overovani existence indexu kontejneru
     *
     * @param offset index pole
     * @return true pokud index existuje
     */
    public function offsetExists($offset) {
      return (isset($this->form->elements[$offset]));
    }

    /**
     * nacteni osabu indexu
     *
     * @param offset index pole
     * @return objekt kontroleru
     */
    public function offsetGet($offset) {
      $result = null;
      if ($this->offsetExists($offset)) {
        return $this->form->elements[$offset];
      } else {
        throw new ExceptionForm('jmeno elementu neexistuje');
      }
      return $result;
    }

    /**
     * nastavovani obsahu kontejneru
     *
     * @param offset index pole
     * @param value hodnota kontejneru
     */
    public function offsetSet($offset, $value) {
      $this->form->elements[$offset] = $value;
    }

    /**
     * zruseni obsahu konkterniho indexu (kontrolni tridy), pomoci unset()
     *
     * @param offset index pole
     */
    public function offsetUnset($offset) {
      //TODO pokud by se pouzivalo, tak by se muselo zajistit odstraneni zavislosti mezi sebou a pak az smaznout
      unset($this->form->elements[$offset]);
    }
  }

  class ExceptionForm extends \Exception {}