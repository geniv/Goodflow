<?php
/*
 *      form.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  final class Form {  //implements ArrayAccess
    //obsluha formularu

    const ACTION_GET = 'get';
    const ACTION_POST = 'post';

    const MIME_MULTIPART = 'multipart/form-data';

    //pravidla na porovnani
    const RULE_FILLED = 'filled'; //musi byt vyplneno
    const RULE_VALID = 'valid'; //musi byt validni
    const RULE_EQUAL = 'equal'; //musi byt rovno

    //pravidla na vstupni udaje
    const RULE_MIN_LENGTH = 'min_length'; //kontrola na min delku
    const RULE_MAX_LENGTH = 'max_length'; //kontrola na max delku
    const RULE_MIN_VALUE = 'min_value'; //kontrola na min hodnotu (float, int)
    const RULE_MAX_VALUE = 'max_value'; //kontrola na max hodnotu (float, int)
    const RULE_RANGE = 'range'; //kontrola na rozsak cisla (float, int)
    //const RULE_LENGTH = 'length'; //kontrola na delku?
    const RULE_EMAIL = 'email'; //kontrola na validni email
    //const RULE_URL = 'url'; //kontrola na url?
    const RULE_REGEXP = 'regexp'; //kontrola dle regularniho vyrazu
    //const RULE_PATTERN = 'pattern';
    const RULE_INTEGER = 'integer'; //kontrola na int
    //const RULE_NUMERIC = 'integer'; //kontola na ruzne cisla??
    const RULE_FLOAT = 'float'; //kontrola na float


    protected $element = NULL;

    public function __construct() {
      //nastavovat id, class?...
      $this->element = new stdClass();
      $this->element->action = '';
      $this->element->method = self::ACTION_POST;
      $this->element->enctype = NULL;

      $elem = Html::elem('form')
                ->action($this->element->action)
                ->method($this->element->method)
                ->enctype($this->element->enctype);

      $elem->insert(Html::elem('fieldset'));

      $this->element->html = $elem;
      $this->element->rules = array();
    }

    public function __toString() {
      return $this->render();
    }

    public function render() {
      return $this->element->html->render();
    }

    public function getAction() {
      return $this->element->action;
    }

    public function setAction($url) {
      $this->element->action = $url;
    }

    public function getMethod() {
      return $this->element->method;
    }

    public function setMethod($method) {
      $this->element->method = $method;
    }

    public function getEnctype() {
      return $this->element->enctype;
    }

    public function setEnctype($mime) {
      $this->element->enctype = $mime;
    }

/*  //zvazit mozne pretezovani!!!
    public function __call($name, $args) {
      var_dump($name, $args);
    }
*/

    //verzme obsah promenne z post/getu, pokud to bude nevyhovujici pujde to do
    //__call nebo __callStatic
    public function __get($name) {
      return $this->getArgs($name);
    }

//TODO metodu na vkladani vychozich hodnot, nebo z get/post
//jeste nastaveni vychozi hodnoty pred vyplnenim,
//po zadani vyplnovani tato hodnota zmizne!

    public function addText($name, array $settings = array()) {
      $this->element->forms[] = $name;

      $fieldset_elem = $this->element->html->getElement('fieldset');

      $label_elem = Html::elem('label')
                          ->class("class labelu")
                          ;
      $fieldset_elem->insert($label_elem);

      $span_elem = Html::elem('span')
                        //->class("class spanu")
                        ->setText(Core::isFill($settings, 'label', '<!-- -->'));
      $input_elem = Html::elem('input')
                        ->type('text')
                        ->name($name)
                        ->value(Core::isFill($settings, 'value', NULL));
      $label_elem->insert(array($span_elem, $input_elem));

      //$input_elem->addAttribute('id');
      //$input_elem->addAttribute('class');
      //$input_elem->addAttribute('disabled');
      //$input_elem->addAttribute('readonly');
      //$input_elem->addAttribute('size');
      //$input_elem->addAttribute('maxlength');
      //$input_elem->addAttribute('autocomplete');

      return $this;
    }

    public function addTextArea($name, array $settings = array()) {
      $this->element->forms[] = $name;

      $fieldset_elem = $this->element->html->getElement('fieldset');

      $label_elem = Html::elem('label')
                          ->class("class labelu")
                          ;
      $fieldset_elem->insert($label_elem);

      $span_elem = Html::elem('span')
                        ->setText(Core::isFill($settings, 'label', '<!-- -->'))
                        ;

      $input_elem = Html::elem('textarea')
                        ->name($name)
                        ->cols(40)
                        ->rows(10)
                        ->setText(Core::isFill($settings, 'value', NULL));
      $label_elem->insert(array($span_elem, $input_elem));

      return $this;
    }

    public function addPassword($name, array $settings = array()) {
      $this->element->forms[] = $name;

      $fieldset_elem = $this->element->html->getElement('fieldset');

      $label_elem = Html::elem('label')
                          ->class("class labelu...")
                          ;
      $fieldset_elem->insert($label_elem);

      $span_elem = Html::elem('span')
                        //->class("class spanu")
                        ->setText(Core::isFill($settings, 'label', '<!-- -->'));
      $input_elem = Html::elem('input')
                        ->type('password')
                        ->name($name)
                        ->value(Core::isFill($settings, 'value', NULL));
      $label_elem->insert(array($span_elem, $input_elem));

      //$input_elem->addAttribute('id');
      //$input_elem->addAttribute('class');
      //$input_elem->addAttribute('disabled');
      //$input_elem->addAttribute('readonly');
      //$input_elem->addAttribute('size');
      //$input_elem->addAttribute('maxlength');
      //$input_elem->addAttribute('autocomplete');

      return $this;
    }

    public function addSelect($name, array $settings = array()) {
      $this->element->forms[] = $name;

      $fieldset_elem = $this->element->html->getElement('fieldset');
//TODO jeste obal z labelu...

      $select_elem = Html::elem('select')
                          ->name($name);
      $fieldset_elem->insert($select_elem);

      $values = Core::isFill($settings, 'values', NULL);
      $option = array();
      foreach ($values as $key => $value) {
        $option[] = Html::elem('option')
                        ->value($key)
                        ->setText($value);
      }
      $select_elem->insert($option);

      return $this;
    }

    public function addCheckbox($name, array $settings = array()) {
      $this->element->forms[] = $name;

      $fieldset_elem = $this->element->html->getElement('fieldset');

      $label_elem = Html::elem('label')
                          ->class("class labelu...")
                          ;
      $fieldset_elem->insert($label_elem);

      $span_elem = Html::elem('span')
                        ->setText(Core::isFill($settings, 'label'));

      $span_input = Html::elem('span')
                        ->class('ultra trida...')
                        ->setDepth($label_elem->getDepth() + 1)
                        ;
      $input_elem = Html::elem('input')
                        ->type('checkbox')
                        ->name($name)
                        ->checked((boolean) Core::isFill($settings, 'state', false))

                            ;
      $span_input->insert($input_elem);
      $label_elem->insert(array($span_elem, $span_input));

      return $this;
    }

    //TODO jeste mit moznost nastavovat title pro elemnty (asi jen submit)
    public function addSubmit($name, array $settings = array()) {
      $this->element->submit = $name;

      $fieldset_elem = $this->element->html->getElement('fieldset');

      $label_elem = Html::elem('label')
                          ->class("class labelu")
                          ;
      $fieldset_elem->insert($label_elem);

      $input_elem = Html::elem('input')
                        ->type('submit')
                        ->name($name)
                        ->value(Core::isFill($settings, 'value', NULL));
      $label_elem->insert($input_elem);

      //$input_elem->addAttribute('title');
      //$input_elem->addAttribute('id');
      //$input_elem->addAttribute('class');
      //$input_elem->addAttribute('disabled');

      return $this;
    }

    public function addRule($typ, $text = NULL, $args = NULL) {
      $last = array_slice($this->element->forms, -1);
      $this->element->rules[$last[0]][$typ] = array('text' => $text, 'args' => $args);

      return $this;
    }

    public function getArgs($index) {
      $args = ($this->element->method == self::ACTION_POST ? $_POST : $_GET);
      return Core::isFill($args, $index, NULL);
    }

    protected function isSendet() {
      return $this->getArgs($this->element->submit);
    }

    public function isSubmitted() {
      $result = false;
      if ($this->isSendet()) {
        $result = true;
//print_r($this->element);
//print_r($this->element->rules);
        if (!empty($this->element->forms)) {
          foreach ($this->element->forms as $name) {
            //pokud jsou zadane podminky
            if (!empty($this->element->rules)) {
              foreach ($this->element->rules[$name] as $type => $rule) {
                //nacteni hodnoty argumentu
                $arg = $this->getArgs($name);
                //var_dump($rule['text'], $rule['args']);
                //rozdeleni osetreni dle podminky
                switch ($type) {
                  case self::RULE_FILLED:
                    if (empty($arg)) {
                      $this->addError(self::RULE_FILLED, $rule['text']);
                      $result = false;
                    }
                  break;

                  case self::RULE_EQUAL:
                    if ($arg != $rule['args']) {
                      $this->addError(self::RULE_EQUAL, $rule['text']);
                      $result = false;
                    }
                  break;

                  //TODO dalsi osetreni podminek!

                } //switch type
              }
            } //empty rules
          }
        } //empty forms
      }

      return $result;
    }

    protected function addError($typ, $zprava) {
      $this->element->error[$typ][] = $zprava;
    }

    public function getErrors() {
      $result = array();
      if (!empty($this->element->error)) {
        foreach ($this->element->error as $typ => $errors) {
          $result[] = "{$typ}<br />\n"; //TODO pretahnout pres pole vyrazu!
          foreach ($errors as $error) {
            $result[] = "{$error}<br />\n";
          }
        }
      }

      return implode("", $result);
    }

    public function getValues() {
      $result = NULL;
      if ($this->isSendet()) {
        $result = array();
        foreach ($this->element->forms as $index) {
          $result[$index] = $this->getArgs($index);
        }
      }
      return $result;
    }

    //public function addTextArea() {}
    //public function addFile() {}
    //public function addHidden() {}
    //public function addCheckbox() {}
    //public function addRadio() {}
    //public function addSelect() {}
    //public function addMultiSelect() {}
    //public function addSubmit() {}
    //public function addButton() {}
    //public function addImage() {}
    //public function addContainer() {}

    //pradavne naskryptovane
    //public function addTinyMCE() {}
    //public function addColor() {}
    //public function addCheckGroup() {}
    //public function addTime() {}
    //public function addDate() {}
    //public function addDateTime() {}

    //nove HTML5 prvky
    //public function addEmail() {}
    //public function addUrl() {}
    //public function addNumber() {}
    //public function addRange() {}
    //public function addSearch() {}

    //TODO pak jeste i zabudouvat kontrolu proti znovuodeslani stejneho formulare!!!
  }

  //class ExceptionForm extends Exception {}

?>
