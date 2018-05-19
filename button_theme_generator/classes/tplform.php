<?php
/*
 * tplform.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;
//TODO dodelat a dopsat testy!!!
  /**
   * formularovy kompilator
   * - kombinace tpl parseru pro formualre s plnohodnotnou tridou starajici se o kompletni formular
   *
   * @package unstable
   * @author geniv
   * @version 1.90
   */
  class TplForm {
    private $template = null;     // text pro template
    private $template_temp = null;// docasny text pro template

    private $autohide = false;    // auto schovavani

    private $formAttributes = null; // atributy formulare

    private $elements = array();  // pole elementu
    private $rules = array();     // pole pravidel elementu
    private $errors = null;    // pole error hlasek

    private $submittedBy = '__button__';
    private $defaults = array();  // pole defaultnich hodnot pokud se maji nastavovat
    private $returns = array();   // pole vracenych hodnot

    // odesilaci metody
    const POST = 'post';
    const GET = 'get';

    private $tags = array(  //TODO predelat na generovane pole kvuli udrzitelnosti stejny casti paternu!!!
        'input_text' => array('({text:.+?})', '/{text:%%InputPattern%%}/'),
        'input_password' => array('({password:.+?})', '/{password:%%InputPattern%%}/'),
        'input_textarea' => array('({textarea:.+?})', '/{textarea:%%InputPattern%%}/'),

        'input_checkbox' => array('({checkbox:.+?})', '/{checkbox:%%InputPattern%%}/'),
        'input_radio' => array('({radio:.+?})', '/{radio:%%InputPattern%%}/'),
        'input_select' => array('({select:.+})', '/{select:%%NameValue%%%%Source%%%%Attr%%%%Rules%%}/'),  //bez ? zamerne! vice selectu musi byt pod sebou!!!

        'input_file' => array('({file:.+?})', '/{file:%%InputPattern%%}/'),
        'input_image' => array('({image:.+?})', '/{image:%%InputPattern%%}/'),

        //html5 elementy
        'input_email' => array('({email:.+?})', '/{email:%%InputPattern%%}/'),
        'input_url' => array('({url:.+?})', '/{url:%%InputPattern%%}/'),
        'input_tel' => array('({tel:.+?})', '/{tel:%%InputPattern%%}/'),
        'input_number' => array('({number:.+?})', '/{number:%%InputPattern%%}/'),
        'input_range' => array('({range:.+?})', '/{range:%%InputPattern%%}/'),
        'input_search' => array('({search:.+?})', '/{search:%%InputPattern%%}/'),
        'input_color' => array('({color:.+?})', '/{color:%%InputPattern%%}/'),

        'input_date' => array('({date:.+?})', '/{date:%%InputPattern%%}/'),
        'input_week' => array('({week:.+?})', '/{week:%%InputPattern%%}/'),
        'input_month' => array('({month:.+?})', '/{month:%%InputPattern%%}/'),
        'input_time' => array('({time:.+?})', '/{time:%%InputPattern%%}/'),
        'input_datetime' => array('({datetime:.+?})', '/{datetime:%%InputPattern%%}/'),
        'input_datetime-local' => array('({datetime-local:.+?})', '/{datetime-local:%%InputPattern%%}/'),

        'input_reset' => array('({reset:.+?})', '/{reset:%%InputPattern%%}/'),
        'input_submit' => array('({submit:.*?})', '/{submit:(?<name>.*?)%%Value%%%%Attr%%}/'),
    );

    /**
     * defaultni konstruktor
     *
     * @since 1.00
     * @param string code
     * @param array settings
     */
    public function __construct($code = null, $settings = array()) {
      $this->template = $code;
      $default = array(
          'action' => '',
          'method' => self::POST,
          'enctype' => null,
        );
      $this->formAttributes = array_merge($default, $settings); // nastaveni atributu

      // globalni definice pro opakujici se parrent tagy
      $patternsSearch = array(
          //~ '%%NameValueAttr%%',
          '%%InputPattern%%',
          '%%NameValue%%',
          '%%Rules%%',
          '%%Attr%%',
          '%%Source%%',
          '%%Value%%',
          '%%Name%%',
        );
      $patternsReplace = array(
          //~ '%%NameValue%%%%Attr%%',
          '%%NameValue%%%%Attr%%%%Rules%%',
          '%%Name%%%%Value%%',
          '(?:\|\|(?<rules>.*?))?',
          '(?:\|(?<attr>.*?))?',
          '(?:;(?<source>.+))?',
          '(?:;(?<value>.*?))?',
          '(?<name>.+?)',
        );
      $this->tags = array_map(function($row) use ($patternsSearch, $patternsReplace) {
          return str_replace($patternsSearch, $patternsReplace, $row);
        }, $this->tags);
      //~ var_dump($this->tags);
    }

    /**
     * tovarni konstruktor
     *
     * @since 1.34
     * @param string code
     * @param array settings
     * @return TplForm vlastni instance
     */
    public static function compile($code, $settings = array()) {
      return new self($code, $settings);
    }

    /**
     * nastaveni vstupniho zdrojoveho kodu rucne
     *
     * @since 1.62
     * @param string code text tpl kodu
     * @return this
     */
    public function setCode($code) {
      $this->template = $code;
      return $this;
    }

    /**
     * nacteni jmeno odesilaciho tlacitka
     *
     * @since 1.62
     * @param void
     * @return string
     */
    public function getSubmittedBy() {
      return $this->submittedBy;
    }

    /**
     * rucnni nastavovani jmena tlacitka pro odesilani
     *
     * @since 1.32
     * @param string name jmeno elementu
     * @return this
     */
    public function setSubmittedBy($name) {
      $this->submittedBy = $name;
      return $this;
    }

    /**
     * kompiluje zadany template
     *
     * @since 1.00
     * @param string template vstupni kod na kompilaci
     * @return string vygenerovany html kod
     */
    public function compileTemplate($template) {
      $split = implode('|', array_map(function($r) {
          return $r[0];
        }, $this->tags));

      $tagMatch = array_map(function($r) {
          return $r[1];
        }, $this->tags);

      $codeSplit = preg_split("/" . $split . "/", $template, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

      $result = '';
      if ($codeSplit) {
        foreach ($codeSplit as $html) {

          // input type text
          if (preg_match($tagMatch['input_text'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="text" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type pasword
          if (preg_match($tagMatch['input_password'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="password" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // textarea
          if (preg_match($tagMatch['input_textarea'], $html, $match)) {
            $attr = $this->replaceAttr($match);
            $result .= '<textarea name="'.$match['name'].'"'.$attr.'>'.$this->processValue($match, false).'</textarea>';
          } else

          // input type checkbox
          if (preg_match($tagMatch['input_checkbox'], $html, $match)) {
            $_send_value = $this->getMethodValue($match['name']); // defaultni oznacovni je pres |:checked
            $_value = $this->processValue($match, false); // nacteni jen values
            $attr = $this->processValue($match) . $this->replaceAttr($match) . ($_send_value === $_value || $_send_value === 'on' ? ' checked' : null);
            $result .= '<input type="checkbox" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type radio
          if (preg_match($tagMatch['input_radio'], $html, $match)) {
            $_send_value = $this->getMethodValue($match['name']); // defaultni oznacovni je pres |:checked
            $attr = ' value="'.$match['value'].'"' . $this->replaceAttr($match) . ($_send_value === $match['value'] ? ' checked' : null);
            $result .= '<input type="radio" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type select
          if (preg_match($tagMatch['input_select'], $html, $match)) { //TODO momentalne neumi multiple select
            $_items = Configurator::decode($match['source']);  // dekodovani pole
            $_value = $this->processValue($match, false);  // nacteni jen values
            $_option = null;
            foreach ($_items as $key => $item) {
              if (is_array($item)) {
                $_option .= '<optgroup label="'.$key.'">';
                foreach ($item as $k => $v) {
                  $_option .= '<option value="'.$k.'"'.($k === $_value ? ' selected' : null).'>'.$v.'</option>';
                }
                $_option .= '</optgroup>';
              } else {
                $_option .= '<option value="'.$key.'"'.($key === $_value ? ' selected' : null).'>'.$item.'</option>';
              }
            }
            $attr = $this->replaceAttr($match);
            $result .= '<select name="'.$match['name'].'"'.$attr.'>'.$_option.'</select>';
          } else

          // input type file
          if (preg_match($tagMatch['input_file'], $html, $match)) {
            $this->formAttributes['enctype'] = 'multipart/form-data'; // nastaveni potrebneho atributu
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="file" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // HTML5 elementy ****************************************************

          // input type email
          if (preg_match($tagMatch['input_email'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="email" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type url
          if (preg_match($tagMatch['input_url'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="url" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type tel
          if (preg_match($tagMatch['input_tel'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="tel" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type number
          if (preg_match($tagMatch['input_number'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="number" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type range
          if (preg_match($tagMatch['input_range'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="range" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type search
          if (preg_match($tagMatch['input_search'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="search" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type color
          if (preg_match($tagMatch['input_color'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="color" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type date
          if (preg_match($tagMatch['input_date'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="date" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type week
          if (preg_match($tagMatch['input_week'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="week" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type month
          if (preg_match($tagMatch['input_month'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="month" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type time
          if (preg_match($tagMatch['input_time'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="time" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type datetime
          if (preg_match($tagMatch['input_datetime'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="datetime" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type datetime-local
          if (preg_match($tagMatch['input_datetime-local'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="datetime-local" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // buttony ***********************************************************

          // input type image
          if (preg_match($tagMatch['input_image'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="image" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type reset
          if (preg_match($tagMatch['input_reset'], $html, $match)) {
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="reset" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type submit
          if (preg_match($tagMatch['input_submit'], $html, $match)) {
            $this->submittedBy = $match['name'] ?: $this->submittedBy;  // nastaveni button name
            $attr = $this->processValue($match) . $this->replaceAttr($match);
            $result .= '<input type="submit" name="'.$this->submittedBy.'"'.$attr.'/>';
          } else

          { // posledni moznost, vklada se zbytek
            $result .= $html;
          }

          // prenos jmena do elementu a pravidel
          if (isset($match['name'])) {
            //~ var_dump($match);
            $this->elements[$match['name']] = array(
                'type' => $this->parseType($match[0]),
                'match' => $match,
              );
            $this->processRules($match['name'], $match);  // zaneseni do pravidel
          }
        }
      }
      return $result;
    }

    /**
     * parser textu do pole (max 2 zanoreni)
     * - alfa:beta
     * - items:[cs,CZ,en,EN,de,DE]
     * - items:[[cs,CZ],[en,EN],[de,DE]]
     *
     * - toto same uz mam davno pod nosem a spolehlivejsi!, via konfigurator a neon format v inline tvaru!
     *
     * @deprecated
     * @since 1.58
     * @param string value
     * @return array
     */
    private function parseToArray($value) {//FIXME asi prijde vyhodit.. parser z konfigurtoru bude bohate stacit!!!!
      $result = '';
      $_all = explode(';', $value); // rozsekani pole ;
      foreach ($_all as $_val) {
        preg_match('/(?<key>.*)\:(?<value>.*)/', $_val, $match);  //rozsekani podle :
        if (preg_match('/\[(.*)\]/', $_val, $m0)) {  // array(array())
          if (preg_match('/\[(.*)\]/', $m0[1], $m1)) {  //array()
            $m2 = explode('],[', $m1[1]);
            $result[$match['key']] = array_map(function($r) {
                return explode(',', $r);
              }, $m2);  // items:[[cs,CZ],[en,EN],[de,DE]]
          } else {  // items:[cs,CZ,en,EN,de,DE]
            if ($match) {
              $result[$match['key']] = explode(',', $m0[1]);
            } else {  //TODO ma by [] nebo tak jak je to ted?
              $result = explode(',', $m0[1]); // pokud neni k dispozici klic
            }
          }
        } else {
          $result[$match['key']] = $match['value']; // alfa:beta
        }
      }
      return $result;
    }

    /**
     * vraceni promennych z pole
     *
     * @since 1.00
     * @param string name nazev promenne
     * @return
     */
    private function returnVarFromArray($name, $array, $default = null) {
      if ($array) {
        if (isset($array[$name])) { // pokud je definovany jednoduchy index
          //var_dump($array);
          return $array[$name];
        } else {
          if ($this->keyIsArray($name, $m)) { // pokud je definovany index pole
            if (isset($array[$m['name']])) {
              return $array[$m['name']][$m['key']];
            }
          }
        }
      }
      return $default;
    }

    /**
     * parsrovani typu elementu
     *
     * @since 1.68
     * @param string text ktery obsahuje nazev typu
     * @return string vyparsrovany typ elementu
     */
    private function parseType($source) {
      preg_match('/\{[a-zA-Z]+\:/', $source, $m0);
      preg_match('/\{(.*)\:/', $m0[0], $m1);
      return $m1[1];
    }

    /**
     * zpracovani value elementu
     *
     * @since 1.18
     * @param array match
     * @param bool attribute
     * @return string
     */
    private function processValue($match, $attribute = true) { //TODO ohlidat u hodnoty 0!!!!
      $value = isset($match['value']) ? $match['value'] : null;
      // vraceni nactenych dat z DB
      $value = $this->returnVarFromArray($match['name'], $this->defaults, $value);
      // vraceni poslanych dat z formulare
      $value = $this->returnVarFromArray($match['name'], $this->returns, $value);
      return $value && $value !== '' ? ($attribute ? ' value="'.$value.'"' : $value) : null;
    }

    /**
     * zpracovani argumentu rule pravidel
     * - rosekani na pole
     *
     * @since 1.52
     * @param string argv argument pro zpracovani
     * @return array|string zpracovany argument
     */
    private function processArgv($argv) { //TODO pokud bude venyhovujici tak se nahradi za Configutrator syntax
      if (preg_match('/\[(.*)\]/', $argv, $match)) {
        return explode(',', $match[1]);
      } else {
        return $argv;
      }
    }

    /**
     * zpracovani pravidel a zaneseni do vnitrniho pole rules
     * - priklad pravidel: ||filled:vyplneno;minlength:min delka:14;
     *
     * @since 1.24
     * @param string name jmeno elementu
     * @param array match vyparsrovane pole
     * @return void
     */
    private function processRules($name, $match) {
      $rules = isset($match['rules']) ? explode(';', $match['rules']) : array();
      foreach ($rules as $item) {
        if (!preg_match('/(?<negation>(~))?(?<type>(\w+))(?:(\:(?<message>(.*)))?\:(?<argv>(.*)))?/', $item, $match)) {
          throw new ExceptionTplFor('nepovedeny format pravidla: '.$item);
        }

        // prohozeni argumentu kdyz je message v argumentu
        if (isset($match['message']) && isset($match['argv']) && $match['message'] == '' && $match['argv'] != '') {
          $match['message'] = $match['argv'];
          $match['argv'] = null;
        }

        $this->rules[] = array(
            'name' => $name,
            'type' => $match['type'], // typ pravidla
            'negation' => (bool) $match['negation'],  // detekce negace
            'message' => isset($match['message']) ? $match['message'] : null, // chybova zprava
            'argv' => isset($match['argv']) ? $this->processArgv($match['argv']) : null,  // doplnujici argument
          );
      }
    }

    /**
     * zpracovani a nahrazeni atributu elementu
     * - priklad attributu: |class:value;:required;placeholder:text;
     *
     * @since 1.20
     * @param array match vyparsrovane pole
     * @return string prekonvertovane atributy do html tvaru
     */
    private function replaceAttr($match) {
      $attr = isset($match['attr']) ? $match['attr'] : null;
      $_attr = array_map(function($item) {  //FIXME udelat chytrejsi parsrovani a polozek: require,ng-model,class:blleee
          return preg_replace(array('/^:(\w+)/', '/(.*)\:(.*)/'), array(' ${1}', ' ${1}="${2}"'), $item);
        }, explode(';', $attr));
      return implode('', $_attr);
    }

    /**
     * pridani odesilaciho tlacitka
     * - prida docasne tlacitko
     *
     * @since 1.12
     * @param string|null name nazev elementu, pokud je null pouzije se interni nazev z: submittedBy
     * @param string|null value hodnota elementu
     * @param string|null attr doplnujici argumenty v testovem tvaru a;b;c
     * @return
     */
    public function addSubmit($name = null, $value = null, $attr = null) {
      $attr = implode(';', array_filter(array(
          $name ?: $this->submittedBy,
          $value
        ))) . ($attr ? '|' . $attr : null); // filtrovani null hodnot
      $this->template_temp .= '{submit:'.$attr.'}';
      return $this;
    }

    /**
     * vnitrni metoda na nacitani odeslanych dat podle nastavene metody
     *
     * @since 1.14
     * @param void
     * @return array nactene hodnoty
     */
    private function getMethodValues() {
      switch ($this->formAttributes['method']) {
        case self::POST:
          return $_POST + $_FILES;
        break;

        case self::GET:
          return $_GET;
        break;
      }
    }

    /**
     * vnitrni metoda na nacitani konkretni hodnoty
     *
     * @since 1.30
     * @param string name index do pole
     * @return string hodnota na danem indexu
     */
    private function getMethodValue($name, $subkey = null) {
      $val = $this->getMethodValues();
      if ($subkey) {
        return isset($val[$name][$subkey]) ? $val[$name][$subkey] : null;
      }
      return isset($val[$name]) ? $val[$name] : null;
    }

    /**
     * je formular odeslan?
     *
     * @since 1.16
     * @param void
     * @return bool true pokud je odeslano
     */
    public function isSubmitted() {
      return (bool) $this->getMethodValue($this->submittedBy);
    }

    /**
     * jsou odeslana data validni?
     *
     * @since 1.16
     * @param void
     * @return bool true pokud jsou data validni
     */
    public function isValid() {
      //prochazeni a vyhodnocovani pravidel
      $this->errors = null;
      foreach ($this->rules as $rules) { //prochazeni elementu
        $check = $this->checkRules($rules); // konrtola pravidla
        if ($rules['negation'] ? $check : !$check) {  // aplikace negace a detekce chyby
          $this->errors[] = $this->prepareErrorMsg($rules);
        }
      }
      return count($this->errors) === 0;
    }

    /**
     * preparovani error zprav
     *
     * @since 1.30
     * @param array rules pole pravidla k aktualnimu elementu
     * @return string zpracovana error hlaska
     */
    private function prepareErrorMsg($rules) {
      $_value = $this->getMethodValue($rules['name']);
      $_value = is_array($_value) && isset($_value['name']) ? $_value['name'] : $_value;  //TODO z uploadu nebere veskere udaje (jen pri single poli)
//TODO pokud bude prazdny text erroru tak by se meli nacitat a pouzivat defaultni hlasky!!!
      $msg = str_replace( // zpracovani substituce name a value
          array('%name', '%value'),
          array($rules['name'], $_value),
          $rules['message']);
      return $rules['argv'] ? vsprintf($msg, $rules['argv']) : $msg;  // substituce z rules
    }

    /**
     * zpracovani value hodnoty, s detekci pole nebo normalni promenne
     *
     * @since 1.56
     * @param string source klic promenne na parsrovani
     * @return string hodnota promenne
     */
    private function parseValue($source) {
      if ($this->keyIsArray($source, $match)) {  //TODO bacha test, muze php brblat kvuli neexistenci indexu!!
        return $this->getMethodValue($match['name'], $match['key']);
      } else {
        return $this->getMethodValue($source);
      }
    }

    /**
     * je klic promenne pole?
     *
     * @since 1.56
     * @param string source klic promenne na parsrovani
     * @param array &match vyparsrovane pole z klice promenne, vracene parametrem
     * @return bool true kdyz je pole
     */
    private function keyIsArray($source, &$match = null) {
      return (bool) preg_match('/(?<name>(.+))\[(?<key>(.*))\]/', $source, $match);
    }

    /**
     * kontrola zadanych pravidel
     *
     * @since 1.26
     * @param array rules pole pravidel
     * @return bool true pokud podminka prosla
     */
    private function checkRules($rules) {
      $value = $this->parseValue($rules['name']);
//~ var_dump($value);
//TODO bacha na: ini_get('post_max_size'); ini_get('upload_max_filesize'); ini_get('max_execution_time')
      $argv = $rules['argv'];
      switch ($rules['type']) {
        /* textove podminky */
        case 'minlength': //minimalni delka
          return $argv <= mb_strlen($value, 'UTF-8');

        case 'maxlength': //maximalni delka
          return $argv >= mb_strlen($value, 'UTF-8');

        case 'length':  //delka/pole(min, max)
          return Core::isInRange(mb_strlen($value, 'UTF-8'), !is_array($argv) ? array($argv, $argv) : $argv);

        case 'range': // ciselny rozsah
          return Core::isInRange($value, !is_array($argv) ? array($argv, $argv) : $argv);

        case 'min': // minimalni hodnota
          return Core::isInteger($value) || Core::isDouble($value) ? ($argv <= $value) : false;

        case 'max':
          return Core::isInteger($value) || Core::isDouble($value) ? ($argv >= $value) : false;

        case 'integer': // validni integet
          return Core::isInteger($value);

        case 'double': // validni double
          return Core::isDouble($value);

        case 'numeric': // je nejake cislo
          return Core::isInteger($value) || Core::isDouble($value);

        case 'email': // validni email
          return Core::isEmail($value);

        case 'url': // validni url
          return Core::isUrl($value);

        //~ case 'pattern': // platny regularni vyraz - neni az tak extra vyuzitelny
          //~ return (bool) preg_match('/^'.$argv.'$/', $value);

        case 'count':
          if (isset($value['name'])) {  // zatim jen prohlizeni uploadu
            return count($value['name']) == $argv;
          }

        /* validatory */

        case 'is_in': // kontrola ve vyctu
          return in_array($value, $argv);

        case 'equal': // porovnani s promennou
          return $value == $argv;

        case 'equalinput':  // porovnani s elementem
          return $value == $this->getMethodValue($argv);

        case 'same':  // striktnejsi porovnani s promennou
          return $value === $argv;

        case 'filled':  // kontrola vyplneni
          return is_array($value) && isset($value['error']) ? $value['error'] === 0 || $value['error'][0] === 0 : ($value === 0 || $value != '');

        case 'less':  // mensi jak
          return Core::isInteger($value) || Core::isDouble($value) ? ($value < $argv) : false;

        case 'more':  // vetsi jak
          return Core::isInteger($value) || Core::isDouble($value) ? ($value > $argv): false;

        /* validatory uploadu */

        case 'maxfilesize': // kontrola na velikost (64 * 1024 kb)
          if (is_array($value['name'])) { // zpracovani multiple
            foreach ($value['size'] as $_size) {
              if ($argv < $_size) {
                return false;
              }
            }
            return true;
          } else {
            return $argv >= $value['size'];
          }

        case 'mimetype':  // kontrola na mimetyp, via: (http://www.iana.org/assignments/media-types)
          if (is_array($value['name'])) { // zpracovani multiple
            foreach ($value['type'] as $_type) {
              if ($_type != $argv) {
                return false;
              }
            }
            return true;
          } else {
            return $value['type'] == $argv;
          }

        case 'image': // kontrola na obrazek (png, jpg, gif)
          $images = array(
              'image/png',
              'image/jpeg',
              'image/gif',
            );
          if (is_array($value['name'])) { // zpracovani multiple
            foreach ($value['type'] as $_type) {
              if (!in_array($_type, $images)) {
                return false;
              }
            }
            return true;
          } else { // zpracovani single
            return in_array($value['type'], $images);
          }
      }
      return false;
    }

    /**
     * bylo odeslano a je zaroven i validni?
     *
     * @since 1.16
     * @param void
     * @return bool true pokud je uspech
     */
    public function isSuccess() {
      return ($this->isSubmitted() && $this->isValid());
    }

    /**
     * nacitani pole chyb
     *
     * @since 1.16
     * @param void
     * @return array pole chyb
     */
    public function getErrors() {
      return $this->errors;
    }

    /**
     * nacteni pole odeslanych dat
     *
     * @since 1.16
     * @param void
     * @return array pole odeslanych dat
     */
    public function getValues() {
      $keys = array_keys($this->elements);
      $method = $this->getMethodValues();
      $val = array();
      foreach ($keys as $name) {
        if ($this->keyIsArray($name, $m)) {
          if ($m['key']) {  // nacteni udaju jako pole
            $val[$m['name']][$m['key']] = $method[$m['name']][$m['key']];
          } else {
            $val[$m['name']] = $method[$m['name']];
          }
        } else {
          if (isset($method[$name])) {
            $val[$name] = $method[$name];  // nacteni udaju jen z aktualniho formulare
          }
        }
      }
      return $val;
    }

    /**
     * odstranine ignore polozek z pole
     * - filtruje ignore polozky (vyhazuje)
     *
     * @since 1.48
     * @param array values pole polozek (key=>value)
     * @param array ignore pole ignore klicu (key)
     * @return array vyfiltrovane pole (key=>value)
     */
    private function removeIgnoreArray($values, $ignore) {
      $result = array();
      foreach ($values as $k => $v) {
        if (!in_array($k, $ignore)) {
          $result[$k] = $v;
        }
      }
      return $result;
    }

    /**
     * nacitani vychozich hodnot do formulare
     * - vkladaji se pred odeslanim, obvykle data Databaze
     *
     * @since 1.30
     * @param array values pole na nastaveni
     * @param array ignore pole polozek na ignoraci
     * @return this
     */
    public function setDefaults($values, $ignore = array()) {
      if (!$this->isSubmitted()) {
        $this->defaults = $this->removeIgnoreArray((array) $values, $ignore);
      }
      return $this;
    }

    /**
     * nacitani odeslanych hodnot do formulare
     * - vkladaji se po odeslani, obvykle data z $_POST
     *
     * @since 1.32
     * @param array values pole na nastaveni
     * @param array ignore pole polozek na ignoraci
     * @return this
     */
    public function setReturnValues($values, $ignore = array()) {
      if ($this->isSubmitted()) {
        $this->returns = $this->removeIgnoreArray((array) $values, $ignore);
      }
      return $this;
    }

    /**
     * zapinani (ovladani) auto schovavani po odeslani formulare
     * - jen po uspesnem odeslani!! tj: ->isSuccess()
     *
     * @since 1.30
     * @param bool state true pro skryti celeho formulare po odeslani
     * @return this
     */
    public function setAutoHide($state = true) {
      $this->autohide = $state;
      return $this;
    }
//TODO pripadne zpracovatat univerzalne pokud bude potreba
    /**
     * zpracovani atributu formuare
     *
     * @since 1.34
     * @param void
     * @return string zpracovane formularove atributy do textu
     */
    private function processAttributes() {
      $result = '';
      foreach ($this->formAttributes as $name => $value) {
        if (!is_null($value)) {
          $result .= ' '.$name.'="'.$value.'"';
        }
      }
      return $result;
    }

    /**
     * hlavni renderovani
     * - pozor: vola v sobe: isSubmitted() && isValid() takze validase projizdji radobi 2x!
     *
     * @since 1.10
     * @param void
     * @return string vyrenderovany formular
     */
    public function render() {
      $_compile = $this->compileTemplate($this->template.$this->template_temp); // vlozeni kompilace do kontextu
      $this->template_temp = null;  // vymazani temp template pridavku aby se neduplikovaly elementy
      $result = '<form'.$this->processAttributes().'>' . $_compile . '</form>';

      // obsluha auto schovavani
      if ($this->autohide && $this->isSuccess()) {
        $result = '';
      }
      return $result;
    }

    /**
     * magicka metoda pro render formulare
     *
     * @since 1.08
     * @param void
     * @return string vyrenderovany formular
     */
    public function __toString() {
      return $this->render();
    }
  }

  /**
   * trida vyjimky pro TplForm
   *
   * @package stable
   * @author geniv
   * @version 1.50
   */
  class ExceptionTplForm extends \Exception {}