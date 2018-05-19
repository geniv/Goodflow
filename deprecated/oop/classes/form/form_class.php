<?php

  namespace Classes;

  class ContainerForm implements \ArrayAccess {
    protected $data = array();

    //__construct??

    public final function offsetGet($name) {
      return (isset($this->data[$name]) ? : NULL);
    }

    public final function offsetSet($name, $value) {
      if (is_null($name)) {
        $this->data[] = $value;
      } else {
        $this->data[$name] = $value;
      }
    }

    public final function  offsetExists($name) {
      return isset($this->data[$name]);
    }

    public final function offsetUnset($name) {
      unset($this->data[$name]);
    }

    public final function getData() {
      return $this->data;
    }
  }

  class Form extends ContainerForm {

/*
    public static function __callStatic($name, $args) {
      //
      //var_dump($name);
    }

    public static function metoda($neco) {
      echo ":{$neco}";
      //var_dump(__CLASS__, __DIR__, __FILE__, __NAMESPACE__, __METHOD__, __FUNCTION__);
//new alias;

    }
*/

    const POST = 'post';
    const GET = 'get';

    protected $element;

    public function __construct($name = NULL) {
      //vnitrni nastaveni metody a url na vychozi hodnotu

      //$this->element = Html::elem('form');  //na to smysl?

      $this->element->action = '';
      $this->element->method = self::POST;
    }

    public function __toString() {
var_dump($this->getData());
      //TODO dopsat výstup!
      return "toto je ultra formulař :D";
    }

    public function render() {
      //to same jako __tostring?!!
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

    public function addGroup($name) { //?????
      //
    }

    public function addText($name, array $hodnoty = NULL) {
      //var_dump($hodnoty);
      //hodnoty:?
//do kazdeho prvku se musi da vlozit X rule pravidel!
      $control = new InputText();
      $control->setType(InputText::TTEXT);

      return $this[$name] = $control;
    }

    public function addPassword($name, array $hodnoty = NULL) {
      //hodnoty?
      $control = new InputText();
      $control->setType(InputText::TPASS);

      return $this[$name] = $control;
    }


    public function addTextArea() {}
    public function addFile() {}
    public function addHidden() {}
    public function addCheckbox() {}
    public function addRadio() {}
    public function addSelect() {}
    public function addMultiSelect() {}
    public function addSubmit() {}
    public function addButton() {}
    public function addImage() {}
    //public function addContainer() {}

    //pradavne naskryptovane
    public function addTinyMCE() {}
    public function addColor() {}
    public function addCheckGroup() {}
    public function addTime() {}
    public function addDate() {}
    public function addDateTime() {}

    //nove HTML5 prvky
    public function addEmail() {}
    public function addUrl() {}
    public function addNumber() {}
    public function addRange() {}
    public function addSearch() {}

  }

  class Html {
    //seskladavani inputu.... uz konecne?

    protected $elem, $name;
//TODO ma toto smysl????
    public static function elem($name = NULL) {
      $elem = new self;
      $elem->name = $name;

      return $elem;
    }

  }

  class ControlForm {
    //tady by melo byt neco vy stylu tech globalnich emtod pro vsechny prvky

  }

  class BaseText extends ControlForm {
    //tady metody ktere jsou textove zalozene

    //TODO dodelat!
    //nastaveni value
    //valadace na ruzne formaty
  }

  class InputText extends BaseText {
    //tady je samotna trida co se stata o textove prvky?
    protected $control, $value;

    const TTEXT = 'text';
    const TPASS = 'password';
    const THIDD = 'hidden';
//text,passowrd,hidden,radio,checkbox,file,...

    public function __construct() {
      //
      $this->control->type = self::TTEXT;
      $this->value = '';
    }

    public function setType($type) {
      $this->control->type = $type;
    }
  }

?>
