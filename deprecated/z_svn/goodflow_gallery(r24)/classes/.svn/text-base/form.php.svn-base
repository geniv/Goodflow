<?php
/*
 *      form.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass;

  final class Form extends Html {
    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const VERSION = '1.9';

    const MIME_MULTIPART = 'multipart/form-data';

    //pravidla na porovnani
    const RULE_FILLED = 'filled'; //musi byt vyplneno; ->addRule(Form::RULE_FILLED, '...');
    //const RULE_VALID = 'valid'; //musi byt validni??????????
    const RULE_EQUAL = 'equal'; //musi byt rovno; ->addRule(Form::RULE_EQUAL, '...', $form->pass);

    //pravidla na vstupni udaje
    //const RULE_MIN_LENGTH = 'min_length'; //kontrola na min delku
    //const RULE_MAX_LENGTH = 'max_length'; //kontrola na max delku
    //const RULE_MIN_VALUE = 'min_value'; //kontrola na min hodnotu (float, int)
    //const RULE_MAX_VALUE = 'max_value'; //kontrola na max hodnotu (float, int)
    //const RULE_RANGE = 'range'; //kontrola na rozsak cisla (float, int)
    //const RULE_LENGTH = 'length'; //kontrola na delku?
    //const RULE_EMAIL = 'email'; //kontrola na validni email
    //const RULE_URL = 'url'; //kontrola na url?
    //const RULE_REGEXP = 'regexp'; //kontrola dle regularniho vyrazu
    //const RULE_PATTERN = 'pattern';
    const RULE_NUMERIC = 'numeric'; //kontola obecne cisla (float / int); ->addRule(Form::RULE_NUMERIC, '...')

    //vystupni typy udaju
    const TYPE_INTEGER = 'integer'; //nastavuje integer; ->setTypeVariable(Form::TYPE_INTEGER)
    const TYPE_FLOAT = 'float'; //nastavuje float; ->setTypeVariable(Form::TYPE_FLOAT)
    const TYPE_BOOL = 'boolean';  //nastavuje bool; ->setTypeVariable(Form::TYPE_BOOL)

    private $form, $conf, $rule, $type, $submit, $before, $zan, $last, $error, $values;

    public function __construct(array $settings = array()) {
      $this->conf = new stdClass();
      $this->conf->action = Core::isFill($settings, 'action');
      $this->conf->method = Core::isFill($settings, 'method', self::METHOD_POST);
      $this->conf->enctype = Core::isFill($settings, 'enctype', NULL);
      $this->conf->form_class = Core::isFill($settings, 'form_class', NULL);
      $this->conf->form_id = Core::isFill($settings, 'form_id', NULL);

      $this->form = array();

      $this->rule = array();
      $this->submit = NULL;
      $this->before = array();
      $this->zan = 0;
      $this->last = NULL;
      $this->error = array();
      $this->values = array();
    }

    //verzme obsah promenne z post/getu, pokud to bude nevyhovujici pujde to do
    //kvuli jiste kompatibilni podobnosti; $form->varible (funguje kdyz je odeslano!)
    public function __get($name) {
      return $this->getArgs($name);
    }

    public function __toString() {
      return $this->render();
    }

    public function render() {
      $row = array();
      foreach ($this->form as $elem) {
        $row[] = $elem['html']; //renderovani elementu do pole
      }

      $fieldset = self::elem('fieldset')
                      ->setDepth($this->zan + 1)
                      ->insert($row)
                      ;

      $form = self::elem('form')
                  ->setDepth($this->zan)
                  ->action($this->conf->action)
                  ->method($this->conf->method)
                  ->enctype($this->conf->enctype)
                  ->class($this->conf->form_class)
                  ->id($this->conf->form_id)
                  ->insert($fieldset)
                  ->appendBefore($this->before)
                  ;

      return $form->render();
    }

//action
    public function getAction() {
      return $this->conf->action;
    }

    public function setAction($url) {
      $this->conf->action = $url;
      return $this;
    }
//method
    public function getMethod() {
      return $this->conf->method;
    }

    public function setMethod($method) {
      $this->conf->method = $method;
      return $this;
    }
//enctype
    public function getEnctype() {
      return $this->conf->enctype;
    }

    public function setEnctype($mime) {
      $this->conf->enctype = $mime;
      return $this;
    }

    public function getDepth() {
      return $this->zan;
    }

    public function setDepth($depth) {
      $this->zan = $depth;
      return $this;
    }

    private function buildLabel($settings) {
      $span = array();
      //pokud je label vyplneny
      $label_text = Core::isFill($settings, 'label', '');
      if (!empty($label_text)) {
        $span[] = self::elem('span')
                      ->setText($label_text)
                      ;
      }
      //pokud se ma vlozit vlastni element
      $self_elem = Core::isFill($settings, 'self_elem', array());
      if ($self_elem) {
        //zatim to je tak ze se muze vkladat je jeden element
        //pripadne jeden element ktery ma navkladane dovnitr dalsi prvky
        $span[] = $self_elem;
      }

      $result = self::elem('label')
                    ->class(Core::isFill($settings, 'label_class', NULL))
                    ->id(Core::isFill($settings, 'label_id', NULL))
                    ->setDepth($this->zan + 2)
                    ->insert($span)
                    ;
      return $result;
    }

    const _T_TEXT = 'text';
    const _T_FILE = 'file';
    const _T_SUBMIT = 'submit';

    public function __call($method, $parameters) {
//FIXME osetrit tady kdyz budou parametry jinak a nebo nebudou zadane!!!!!
      $name = $parameters[0];
      $settings = Core::isFill($parameters, 1);

      $type = NULL;
      $element = NULL;

      $value = Core::isFill($settings, 'value', NULL);
      $checked = (boolean) Core::isFill($settings, 'checked', false); //je haklive na typ
      $multiple = (boolean) Core::isFill($settings, 'multiple', false);
      $cols = Core::isFill($settings, 'cols', 40);
      $rows = Core::isFill($settings, 'rows', 10);
      $placeholder = Core::isFill($settings, 'placeholder', NULL);
      $autocomplete = Core::isFill($settings, 'autocomplete', NULL);

      switch ($method) {
        case 'addText':
          $type = self::_T_TEXT;

          $element = self::elem('input')
                          ->type('text')
                          ->name($name)
                          ->value($value)
                          ->autocomplete($autocomplete)
                          ->placeholder($placeholder)
                          ;
        break;

        case 'addPassword':
          $type = self::_T_TEXT;

          $element = self::elem('input')
                          ->type('password')
                          ->name($name)
                          ->value($value)
                          ->autocomplete($autocomplete)
                          ;
        break;

        case 'addTextArea':
          $type = self::_T_TEXT;

          $element = self::elem('textarea')
                          ->name($name)
                          ->cols($cols)
                          ->rows($rows)
                          ->setText($value)
                          ->placeholder($placeholder)
                          ;
        break;

        case 'addCheckbox':
          $type = self::_T_TEXT;
//TODO nema u byt jeste pripadne nejaky obal nebo nejaky span element
          $element = self::elem('input')
                          ->type('checkbox')
                          ->name($name)
                          ->value($value)
                          ->checked($checked)
                          ;
        break;

        //TODO dodelat select!! a dalsi prvky!!
        //case 'addSelect':
        //break;

        case 'addFile':
          $type = self::_T_FILE;

          $element = self::elem('input')
                          ->type('file')
                          //->accept('image/gif,image/jpeg')//TODO bude funguvat?????
                          ->name(sprintf('%s%s', $name, ($multiple ? '[]' : '')))
                          ->multiple($multiple)
                          ;
        break;

        case 'addSubmit':
          $type = self::_T_SUBMIT;
//TODO mit moznost mit vic submit tlacitek????
          $this->submit = $name;

          $element = self::elem('input')
                          ->type('submit')
                          ->name($name)
                          ->value($value)
                          ;
        break;
//TODO udelat obalovaci metodu!!!
        default:
          echo sprintf('element s nazvem "%s" neexistuje nebo neni doposud implementovat!!!', $method);
        break;
      }

      $elem = $this->buildLabel($settings)
                    ->insert($element);
//FIXME bacha!!! name musi byt unikatni?!!!!!! pokud se bude pridavat vickrat tak se musi ke jmenu pridat []
      $this->last = $name;

      $this->form[] = array('method' => $method,
                            'parameters' => $parameters,
                            'html' => $elem,
                            'name' => $name,
                            'type' => $type,
                            );

      return $this;
    }

    public function addBackLink($text, $adress, $args = array()) {
      $this->before[] = self::elem('a')
                            ->href($adress, $args)
                            ->setText($text)
                            ;

      return $this;
    }

    //od kazdeho typu muze byt vzdy jen jedno pravidlo!
    public function addRule($typ, $text = NULL, $args = NULL) {
      $this->rule[$this->last][$typ] = array('text' => $text, 'args' => $args);
      return $this;
    }

    public function setTypeVariable($type) {
      $this->type[$this->last] = $type;
      return $this;
    }

//TODO metodu na vkladani vychozich hodnot, nebo z get/post
//jeste nastaveni vychozi hodnoty pred vyplnenim, (JS)
//po zadani vyplnovani tato hodnota zmizne!

    private function searchElementByName($name) {
      $result = NULL;
      //TODO osetrovat prazdnou hodnotu?
      foreach ($this->form as $elem) {
        if ($name == $elem['name']) {
          $result = $elem;
          break;
        }
      }
      return $result;
    }

    private function getArgs($index) {
      $elem = $this->searchElementByName($index);
      $args = NULL;
      switch ($elem['type']) {
        case self::_T_TEXT:
        case self::_T_SUBMIT:
          $args = ($this->conf->method == self::METHOD_POST ? $_POST : $_GET);
        break;

        case self::_T_FILE:
          //$this->conf->enctype
          $args = $_FILES;
        break;
      }

      return Core::isFill($args, $index, NULL);
    }

    //interni aplikace typu
    private function applyType($index) {
      $value = $this->values[$index];
      $type = Core::isFill($this->type, $index);
      switch ($type) {
        case self::TYPE_INTEGER:
          $this->values[$index] = (integer) $value;
        break;

        case self::TYPE_FLOAT:
          $this->values[$index] = (float) $value;
        break;

        case self::TYPE_BOOL:
          $this->values[$index] = (boolean) $value;
        break;
      }
    }

    private function isSendet() {
      $result = false;
      if (!empty($this->submit)) {
        $submit_value = $this->getArgs($this->submit);  //tady nemuze byt values, naplnuje se az po provedeni tohoto!
        $result = (!empty($submit_value));
      } //TODO osetrovat nejak ze chybi submit tlacitko???? resp je toto sparavne???
      return $result;
    }

    //kontrola validity dat
    public function isSubmitted() {
      $result = false;
      if ($this->isSendet()) {
        $result = true;

        if (!empty($this->form)) {
          foreach ($this->form as $elem) {
            $name = $elem['name'];

            //nacteni hodnoty argumentu
            $arg = $this->getArgs($name);
            $this->values[$name] = $arg;  //ulozeni do instancni promenne

            //var_dump($name, $this->rule);
            //pokud jsou zadane podminky
            $rules = Core::isFill($this->rule, $name);
            if (!empty($rules)) {
              foreach ($rules as $type => $rule) {
                //nacteni hodnoty argumentu
                //$arg = $this->getArgs($name);

                //var_dump($type, $arg);
                //var_dump($rule['text'], $rule['args']);
                //rozdeleni osetreni dle podminky
                switch ($type) {
                  case self::RULE_FILLED:
                    if (empty($arg)) {
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;

                  case self::RULE_EQUAL:
                    if ($arg != $rule['args']) {
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;

                  case self::RULE_NUMERIC:
                    if (!is_numeric($arg)) {
                      $this->addError($type, $rule['text']);
                      $result = false;
                    }
                  break;

                  //TODO dalsi osetreni podminek!

                } //end switch type
              } //end foreach rule
            } //empty rules

            //po kontrole, za platnosti name
            $this->applyType($name);  //aplikace pretypovani
          } //end foreach form
        } //end empty forms
      }

      return $result;
    }

    private function addError($typ, $zprava) {
      $this->error[$typ][] = $zprava;
    }

    public function isErrors() {
      return (!empty($this->error));
    }

    public function getErrors() {
      $result = array();
      if (!empty($this->error)) {
        foreach ($this->error as $typ => $errors) {
          //$result[] = sprintf('%s<br />', $typ);
//TODO pretahovat pres pole nejakych user.def polozek pole!
          foreach ($errors as $error) {
            $result[] = sprintf('%s<br />', $error);
          }
        }
      }

      return implode('', $result);
    }

    public function getValue($name) {
      $result = NULL;
      if ($this->isSendet()) {
        //$result = $this->getArgs($name);
        $result = $this->values[$name];
      }
      return $result;
    }

    //zadavat v poli polozky ktere se maji ignorovat (kdyz je potreba si je vybrat bokem)
    public function getValues(array $settings = array()) {
      $ignore = Core::isFill($settings, 'ignore');
      $define = Core::isFill($settings, 'define');

      $result = NULL;
      if ($this->isSendet()) {
        $result = array();
        foreach ($this->form as $index) {
          switch ($index['type']) {
            case self::_T_TEXT: //vypisuje vse krome submit
            case self::_T_FILE:
              $name = $index['name'];
              //$result[$name] = $this->getArgs($name);
              if ((!empty($ignore) ? !in_array($name, $ignore) : true) &&
                  (!empty($define) ? in_array($name, $define) : true)) {
                $result[$name] = $this->values[$name];
              }
            break;
          }
        }
      }
      return $result;
    }













//FIXME predelat!!!!
/*
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
*/

//http://www.html5tutorial.info/html5-placeholder.php
//http://diveintohtml5.org/forms.html

    //public function addTextArea() {}
    //public function addFile() {}
    //public function addHidden() {}
    //public function addCheckbox() {} - i skupinove!!!
    //public function addRadio() {} - i skupinove!!!
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
