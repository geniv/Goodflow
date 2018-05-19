<?php
/*
 *      captcha.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      classes\Imagic,
      Exception;

  class Captcha {
    const VERSION = 1.23;

    const TYPE_PLUSMINUS = 'plusminus';

    private $captcha; //vnitrni prenaseci promenna

    public function __construct($settings = NULL) {
      try {
        if (!class_exists('classes\Imagic')) {
          throw new ExceptionCaptcha('Class Imagic does not exist!');
        }

        $this->captcha = new stdClass;
        $this->captcha->settings = $settings; //TODO osetrovat vyplneni!

        $this->captcha->result = NULL;

      } catch (ExceptionCaptcha $e) {
        echo $e;
      }
    }

/*????????????????????????
    //nastaveni odpovedi pro rozbareni
    //public function setAnswer($answer = NULL) {
      //TODO vlastni moznosti otazek a odpovedi
    }
*/

    public function setConfigure($settings = NULL) {
      $this->captcha->configure = $settings;
      return $this;
    }

//pokud dostane pole vrati nahodnou hodnotu z rozsahu, jinak jen hodnotu
    private static function getRandValue($value) {
      $result = NULL;
      if (is_array($value)) {
        if (count($value == 2)) {
          $result = rand($value[0], $value[1]);
        }
      } else {
        $result = $value;
      }
      return $result;
    }

//pokud dostane pole vrati nahodnou barvu z rozsahu, jinak jen hodnotu
    private static function getRandRGB($value) {
      $result = NULL;
      if (is_array($value)) {
        if (count($value == 2)) {
          $result = Core::getRandomColor($value[0], $value[1]);
        }
      } else {
        $result = $value;
      }
      return $result;
    }

    public function render() {
      //vykreslovani
      $width = Core::isFill($this->captcha->configure, 'width', 200);
      $height = Core::isFill($this->captcha->configure, 'height', 100);
      $background_color = Core::isFill($this->captcha->configure, 'background_color', 'black');
      //obrazen na pozadi
      $background_image = Core::isFill($this->captcha->configure, 'background_image');  //cesta obrazku pozadi
      $background_x = Core::isFill($this->captcha->configure, 'background_x', 0); //pozice pozadi x
      $background_y = Core::isFill($this->captcha->configure, 'background_y', 0); //pozice pozadi y
      $background_composite = Core::isFill($this->captcha->configure, 'background_composite', Imagic::COMPOSITE_OVER);  //nastaveni prolnuti

      $rotation_letter = Core::isFill($this->captcha->configure, 'rotation_letter');
      $font_name = Core::isFill($this->captcha->configure, 'font_name', 'fixed');
      $font_color = Core::isFill($this->captcha->configure, 'font_color', 'white');
      $font_size = Core::isFill($this->captcha->configure, 'font_size', 20);
      $font_gravity = Core::isFill($this->captcha->configure, 'font_gravity', Imagic::GRAVITY_CENTER);
      $font_letterspacing = Core::isFill($this->captcha->configure, 'font_letterspacing');  //pokud je celek dava prikaz, pokud se mezery pocitaji tak pocita s timto rozestupem
      $font_wordspacing = Core::isFill($this->captcha->configure, 'font_wordspacing');
      $font_x = Core::isFill($this->captcha->configure, 'font_x', 0);
      $font_y = Core::isFill($this->captcha->configure, 'font_y', 0);

      $type_plus = Core::isFill($this->captcha->configure, 'type_plus', '%s+%s');
      $type_minus = Core::isFill($this->captcha->configure, 'type_minus', '%s-%s');

      $i = new Imagic;
      $i->newImage($width, $height, $background_color); //TODO udelat i update na zpracovani nahodnych barev pozadi

      if (!empty($background_image) && file_exists($background_image)) {
        $c = new Imagic(array('files' => $background_image));
        $i->compositeImage($c, $background_composite, $background_x, $background_y);
      }

      $settings = $this->captcha->settings;
      $min = $settings['min'];
      $max = $settings['max'];

      $num1 = rand($min, $max);
      $num2 = rand($min, $max);

//TODO udelat vic moznosti a rozsireni!!!!
      switch ($settings['type']) {
        case self::TYPE_PLUSMINUS:
          $calc = array(sprintf($type_plus, $num1, $num2) => $num1 + $num2,
                        sprintf($type_minus, $num1, $num2) => $num1 - $num2);

          $index = array_rand($calc);

          $this->captcha->result = $calc[$index];
          $text = $index;
        break;
      }

      $draw = new ImagicDraw;
      $draw->setFont($font_name);

      if (!empty($rotation_letter)) { //rotace pismen + nahodna velikost pismen
        $split = str_split($text);
        foreach ($split as $index => $letter) {
          $rand = rand($rotation_letter[0], $rotation_letter[1]);
          $draw->setFontSize(self::getRandValue($font_size))
              ->setFillColor(self::getRandRGB($font_color));
          $i->annotateImage($draw, $font_x + ($index * $font_letterspacing), $font_y, $rand, $letter);
        }
      } else {
        $draw->setFontSize(self::getRandValue($font_size))
            ->setFillColor(self::getRandRGB($font_color))
            ->annotation($font_x, $font_y, $text)
            ->setGravity($font_gravity);

        if (!empty($font_letterspacing)) {  //rozestupy pismen
          $draw->setTextKerning($font_letterspacing);
        }

        if (!empty($font_wordspacing)) {  //rozestupy slov
          $draw->setTextInterWordSpacing($font_wordspacing);
        }
      }

      //TODO a i tu zapinat ty efekty pozadi! viz: http://www.imagemagick.org/Usage/advanced/
      //http://www.imagemagick.org/Usage/advanced/

      $i->drawImage($draw);
      $blob = $i->getImageBlob(); //prozatim tu se provadi exec
      $result = Html::img()->alt('')->srchash($i->getImageMimeType(), $blob);

      //var_dump($i->getMinimalVersion());

      return $result->render();
    }

    //vraci aktualni vysledek
    public function getCurrentResult() {
      return $this->captcha->result;
    }

    //vraceni posledni vysledek pro porovnavani ve formulari
    public function getResult() {
      $result = Core::isNull($_SESSION, 'last');
      $_SESSION['last'] = $this->captcha->result; //nastavuje aktialani pro dalsi pouziti
      return $result;
    }

    public function __toString() {
      return $this->render();
    }

  }

  class ExceptionCaptcha extends Exception {}

?>
