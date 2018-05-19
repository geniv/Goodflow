<?php
/*
 * tplform.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * formularovy kompilator
   * - kombinace tpl parseru pro formualre s implementaci starajici se o kompletni formular
   * - vkladani: {->render()} nebo pro aplikaci TPL kompilace {compile="->render()"}
   *
   * @package stable
   * @author geniv
   * @version 3.02
   */
  class TplForm {
    private $template = null;     // text pro template
    private $template_temp = null;// docasny text pro template

    private $autohide = false;    // auto schovavani
    private $submit_blocker = true; // js blok proti vicenasobnemu kliknuti na submit tlacitko
    private $submit_security = false; // session chrana proti vicenasobnemu odeslani jednoho formulare
    private $submit_security_name = null; // jmeno security elementu

    private $formAttributes = null; // atributy formulare

    private $elements = array();  // pole elementu
    private $rules = array();     // pole pravidel elementu
    private $errors = null;    // pole error hlasek

    private $submittedBy = '__button';  // defaultni name tlacitka + pridava se staticke pocitani
    private $defaults = array();  // pole defaultnich hodnot pokud se maji nastavovat
    private $returns = array();   // pole vracenych hodnot

    private $define_values = array(); // pole pred definovanych hodnot
    private $define_attr = array();   // pole pred definovanych hodnot

    private $separator_value_attr = '\|\$\|'; // oddelovac value a atributu (preg_match)
    private $separator_attributes = '|,|';    // oddelovac atributu (explode)
    private $separator_attr_k_v = '\|\:\|';   // oddelovac klicu a hodnot atributu (preg_match)
    private $separator_attr_k_v_nb = '|:|';   // oddelovac klicu a hodnot atributu bez backslashu, pro vnitrni slucovani

    private $separator_attr_rule = '\|\@\|';  // oddelovac atributu a pravidel  (preg_match)
    private $separator_rules = '|,|';         // oddelovac pravidel (explode)
    private $separator_rules_attr = '\|\:\|'; // oddelovac atributu v pravidlech (preg_match)

    // odesilaci metody
    /** method POST */
    const POST = 'post';
     /** method GET */
    const GET = 'get';

    private static $cnt_form = 0;

    private $tags = array(
        // textove elementy
        'input_text' => array('({text:.+?})', '/{text:%%InputPattern%%}/s'),
        'input_password' => array('({password:.+?})', '/{password:%%InputPattern%%}/s'),
        'input_hidden' => array('({hidden:.+?})', '/{hidden:%%InputPattern%%}/s'),
        'input_textarea' => array('({textarea:.+?})', '/{textarea:%%InputPattern%%}/s'),

        'input_checkbox' => array('({checkbox:.+?})', '/{checkbox:%%InputPattern%%}/s'),
        'input_radio' => array('({radio:.+?})', '/{radio:%%InputPattern%%}/s'),
        'input_select' => array('({select:.+?})', '/{select:%%InputPattern%%}/s'),  // value se zadava v NEON syntaxi, via: http://ne-on.org/ 1-2 urovnove pole

        'input_file' => array('({file:.+?})', '/{file:%%InputPattern%%}/s'),
        'input_image' => array('({image:.+?})', '/{image:%%InputPattern%%}/s'),

        //html5 elementy
        'input_email' => array('({email:.+?})', '/{email:%%InputPattern%%}/s'),
        'input_url' => array('({url:.+?})', '/{url:%%InputPattern%%}/s'),
        'input_tel' => array('({tel:.+?})', '/{tel:%%InputPattern%%}/s'),
        'input_number' => array('({number:.+?})', '/{number:%%InputPattern%%}/s'),
        'input_range' => array('({range:.+?})', '/{range:%%InputPattern%%}/s'),
        'input_search' => array('({search:.+?})', '/{search:%%InputPattern%%}/s'),
        'input_color' => array('({color:.+?})', '/{color:%%InputPattern%%}/s'),
        'input_datalist' => array('({datalist:.+?})', '/{datalist:%%NameValue%%}/s'), // value se zadava v NEON syntaxi, via: http://ne-on.org/ 1 urovnove pole
        // html5 casove elementy
        'input_date' => array('({date:.+?})', '/{date:%%InputPattern%%}/s'),
        'input_week' => array('({week:.+?})', '/{week:%%InputPattern%%}/s'),
        'input_month' => array('({month:.+?})', '/{month:%%InputPattern%%}/s'),
        'input_time' => array('({time:.+?})', '/{time:%%InputPattern%%}/s'),
        'input_datetime' => array('({datetime:.+?})', '/{datetime:%%InputPattern%%}/s'),
        'input_datetime-local' => array('({datetime-local:.+?})', '/{datetime-local:%%InputPattern%%}/s'),

        // tlacitkove elementy
        'input_reset' => array('({reset:.+?})', '/{reset:%%InputPattern%%}/s'),
        'input_submit' => array('({submit:.*?})', '/{submit:(?<name>.*?)%%Value%%%%Attr%%}/s'), // submit muze mit prazdne jmeno, pouzije se potom implicitne zadane
        'input_button' => array('({button:.+?})', '/{button:%%InputPattern%%}/s'),

        // staticke elementy
        'show_image' => array('({img:.+?})', '/{img:%%NameValue%%%%Attr%%}/s'),  // nazev + value (path) + podpora atributu
        'show_link_begin' => array('({link:.+?})', '/{link:%%NameValue%%%%Attr%%}/s'),  // nazev + value (path) + podpora atributu
        'show_link_end' => array('({\/link})', '/{\/link}/'), // konec linku je totiz parovej!
        'show_label' => array('({label:.+?})', '/{label:%%NameValue%%}/s'), // obycejny text, nazev + value + atributy
    );

    // defaultni chybove hlasky
    private $defaultMsg = array(  //TODO doplnit chybejici indexy a lip prejmenovat obsah
        'equal' => 'Please enter %s.',
        'equalinput' => 'Please enter same value %s.',
        'is_in' => 'Please enter correct value',
        'same' => 'Please enter same like %s.',
        'less' => 'Please enter less than %s.',
        'lessorequal' => 'Please enter less or equal than %s.',
        'more' => 'Please enter more than %s.',
        'moreorequal' => 'Please enter more or equal than %s.',
        'filled' => 'Please complete mandatory field.',
        'minlength' => 'Please enter a value of at least %d characters.',
        'maxlength' => 'Please enter a value no longer than %d characters.',
        'length' => 'Please enter a value between %d and %d characters long.',
        'email' => 'Please enter a valid email address.',
        'url' => 'Please enter a valid URL.',
        'pattern' => 'Please enter a valid pattern.',
        'integer' => 'Please enter a integer value.',
        'double' => 'Please enter a double value.',
        'numeric' => 'Please enter a numeric value.',
        'min' => 'Please enter a minimal value %d.',
        'max' => 'Please enter a maximal value %d.',
        'range' => 'Please enter a value between %d and %d.',
        'count' => 'Please select %d values.',
        'maxfilesize' => 'The size of the uploaded file can be up to %d bytes.',
        'mimetype' => 'The MIME TYPE of the upload file can be type: %s.',
        'image' => 'The uploaded file must be image in format JPEG, GIF or PNG.',
      );
//TODO metodu nbebo atribut na zapnuti ochtravy proti znovu odeslani!!!!!
    /**
     * defaultni konstruktor
     *
     * @since 1.00
     * @param string code zdrojovy kod obsahu formulare
     * @param array settings pole atributu na nastaveni formulare
     */
    public function __construct($code = null, $settings = array()) {
      $this->template = $code;
      $default = array(
          'action' => '',
          'method' => self::POST,
          'enctype' => null,  // application/x-www-form-urlencoded | multipart/form-data | text/plain
          'autocomplete' => 'on',
          //~ 'accept-charset' => '',
        );
      $this->formAttributes = array_merge($default, $settings); // nastaveni atributu

      // globalni definice pro opakujici se parrent tagy
      $patternsSearch = array(
          '%%InputPattern%%',
          '%%NameValue%%',
          '%%Rules%%',
          '%%Attr%%',
          '%%Value%%',
          '%%Name%%',
        );
      $patternsReplace = array(
          '%%NameValue%%%%Attr%%%%Rules%%',
          '%%Name%%%%Value%%',
          '(?:'.$this->separator_attr_rule.'(?<rules>.*?))?', // pattern zadavat zakodovane v: base64_encode, vnitrne provadi: base64_decode
          '(?:'.$this->separator_value_attr.'(?<attr>.*?))?',
          '(?:;(?<value>.*?))?',
          '(?<name>.+?)',
        );
      $this->tags = array_map(function($row) use ($patternsSearch, $patternsReplace) {
          return str_replace($patternsSearch, $patternsReplace, $row);
        }, $this->tags);
      //~ var_dump($this->tags);

      $this->submittedBy .= self::$cnt_form . '__';
      $this->submit_security_name = '__security'.$this->submittedBy;
      self::$cnt_form++;  // pocitani instanci, na zajisteni unikatnosti odesilaneho formulare
    }

    /**
     * tovarni konstruktor
     *
     * @since 1.34
     * @param string code
     * @param array settings pole atributu na nastaveni formulare
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
     * dodatecne nastaveni atributu formulare
     *
     * @since 1.94
     * @param array settings pole atributu na nastaveni formulare
     * @return this
     */
    public function setAttributes($settings = array()) {
      $this->formAttributes = array_merge($this->formAttributes, $settings); // nastaveni atributu
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
      // skladani regularniho vyrazu na splitnuti zdrojaku
      $split = implode('|', array_map(function($r) {
          return $r[0];
        }, $this->tags));

      $tagMatch = array_map(function($r) {
          return $r[1];
        }, $this->tags);

      $codeSplit = preg_split("/" . $split . "/s", $template, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

      $result = '';
      if ($codeSplit) {
        foreach ($codeSplit as $html) {

          // input type text
          if (preg_match($tagMatch['input_text'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="text" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type password
          if (preg_match($tagMatch['input_password'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="password" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type hidden
          if (preg_match($tagMatch['input_hidden'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="hidden" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input textarea
          if (preg_match($tagMatch['input_textarea'], $html, $match)) {
            $attr = $this->processAttr($match);
            $result .= '<textarea name="'.$match['name'].'"'.$attr.'>'.$this->processValue($match, false).'</textarea>';
          } else

          // input type checkbox
          if (preg_match($tagMatch['input_checkbox'], $html, $match)) { // zasadne bez value, value bude slouzit jako checked
            $_value = (bool) ($this->processValue($match, false) || $this->getMethodValue($match['name'])); // vraceni a nacitani hodnot
            $attr = $this->processAttr($match) . ($_value === true ? ' checked' : null);
            $result .= '<input type="checkbox" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type radio
          if (preg_match($tagMatch['input_radio'], $html, $match)) {  // zasadne s value
            $_send_value = $this->processValue($match, false);
            $_value = $this->processValue($match, false, false);
            $attr = $this->processValue($match, true, false) . $this->processAttr($match) . ($this->returnVar($match['name']) && $_send_value == $_value ? ' checked' : null);
            $result .= '<input type="radio" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type select
          if (preg_match($tagMatch['input_select'], $html, $match)) { // live test via: http://ne-on.org/
            $_value = $this->processValue($match, false, false);  // nacteni jen values, value se zadava v NEON syntax
            $_option = null;
            if ($_value) {
              $_send_value = $this->returnVar($match['name']);  // nacitani odeslane hodnoty
              $_items = is_string($_value) ? Configurator::decode($_value) : $_value;  // dekodovani textu na pole, pokud je value text, jinak necha jako pole

              if ($this->keyIsArray($match['name'], $m)) {
                if (isset($m['key'][0]) && isset($_send_value[$m['key'][0]])) {
                  $_send_value = $_send_value[$m['key'][0]];  // vyplnovani pro 1.urovnove pole
                }
              }

              foreach ($_items as $_key => $_item) {
                if (is_array($_item)) {
                  $_option .= '<optgroup label="'.$_key.'">';
                  foreach ($_item as $_k => $_v) { // pokud je pole tak striktne hleda v poli
                    $_option .= '<option value="'.$_k.'"'.(is_array($_send_value) ? in_array($_k, $_send_value) : strval($_k) == $_send_value ? ' selected' : null).'>'.$_v.'</option>';
                  }
                  $_option .= '</optgroup>';
                } else {
                  $_option .= '<option value="'.$_key.'"'.(is_array($_send_value) ? $_key != '0' && in_array($_key, $_send_value) : strval($_key) == $_send_value ? ' selected' : null).'>'.$_item.'</option>';
                }
              }
            }
            $attr = $this->processAttr($match);
            $result .= '<select name="'.$match['name'].'"'.$attr.'>'.$_option.'</select>';
          } else

          // input type file
          if (preg_match($tagMatch['input_file'], $html, $match)) {
            $this->formAttributes['enctype'] = 'multipart/form-data'; // nastaveni potrebneho atributu
            $attr = $this->processAttr($match); //$this->processValue($match) .
            $result .= '<input type="file" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // HTML5 elementy ****************************************************

          // input type email
          if (preg_match($tagMatch['input_email'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="email" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type url
          if (preg_match($tagMatch['input_url'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="url" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type tel
          if (preg_match($tagMatch['input_tel'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="tel" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type number
          if (preg_match($tagMatch['input_number'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="number" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type range
          if (preg_match($tagMatch['input_range'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="range" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type search
          if (preg_match($tagMatch['input_search'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="search" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type color
          if (preg_match($tagMatch['input_color'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="color" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // datalist
          if (preg_match($tagMatch['input_datalist'], $html, $match)) {
            $_value = $this->processValue($match, false);  // nacteni jen values, value se zadava v NEON syntax
            $_option = null;
            if ($_value) {
              $_items = Configurator::decode($match['value']);  // dekodovani pole
              foreach ($_items as $_item) {
                $_option .= '<option value="'.$_item.'">';
              }
            }
            $result .= '<datalist id="'.$match['name'].'">'.$_option.'</datalist>';
          } else

          // input type date
          if (preg_match($tagMatch['input_date'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="date" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type week
          if (preg_match($tagMatch['input_week'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="week" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type month
          if (preg_match($tagMatch['input_month'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="month" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type time
          if (preg_match($tagMatch['input_time'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="time" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type datetime
          if (preg_match($tagMatch['input_datetime'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="datetime" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type datetime-local
          if (preg_match($tagMatch['input_datetime-local'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="datetime-local" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // buttony ***********************************************************

          // input type image
          if (preg_match($tagMatch['input_image'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="image" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type reset
          if (preg_match($tagMatch['input_reset'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="reset" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // input type submit
          if (preg_match($tagMatch['input_submit'], $html, $match)) {
            $this->submittedBy = $match['name'] ?: $this->submittedBy;  // nastaveni button name
            $attr = $this->processValue($match) . $this->processAttr($match);
            if ($this->submit_blocker) {
              // osetreni prokliku na click nebo double click
              $attr .= ' onclick="this.style.visibility=\'hidden\';" ondblclick="this.style.visibility=\'hidden\';"';
            }
            $result .= '<input type="submit" name="'.$this->submittedBy.'"'.$attr.'/>';
          } else

          // input type button
          if (preg_match($tagMatch['input_button'], $html, $match)) {
            $attr = $this->processValue($match) . $this->processAttr($match);
            $result .= '<input type="button" name="'.$match['name'].'"'.$attr.'/>';
          } else

          // ostatni ***********************************************************

          // zobrazeni obrazku
          if (preg_match($tagMatch['show_image'], $html, $match)) {
            $attr = $this->processAttr($match);
            $result .= '<img src="'.$this->processValue($match, false, false).$this->returnVar($match['name']).'"'.$attr.'/>';
          } else

          // zobrazeni odkazu (parovy tag!!!)
          if (preg_match($tagMatch['show_link_begin'], $html, $match)) {
            $attr = $this->processAttr($match);
            $result .= '<a href="'.$this->processValue($match, false, false).$this->returnVar($match['name']).'"'.$attr.'>';
          } else

          if (preg_match($tagMatch['show_link_end'], $html)) {
            $result .= '</a>';
          } else

           // zobrazeni obycejneho textu
          if (preg_match($tagMatch['show_label'], $html, $match)) {
            $result .= $this->processValue($match, false, false).$this->returnVar($match['name']);
          } else


          //TODO element na zaobrazeni captcha kodu


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
     * vraceni promennych z pole
     *
     * @since 1.00
     * @param string name nazev promenne
     * @return string|null hodnota z indexu nebo defaultni hodnota
     */
    private function returnVarFromArray($name, $array, $default = null) {
      if ($array) {
        if (isset($array[$name])) { // pokud je definovany jednoduchy index
          return $array[$name];
        } else {
          if ($this->keyIsArray($name, $m)) { // pokud je definovany index pole
            if (isset($array[$m['name']])) {  //[]
              return $array[$m['name']];
            } else
            if (isset($m['key'][0]) && isset($array[$m['name']][$m['key'][0]])) {  //[x] / [x][]
              return $array[$m['name']][$m['key'][0]];
            } else
            if (isset($m['key'][0]) && isset($m['key'][1]) && isset($array[$m['name']][$m['key'][0]][$m['key'][1]])) {  //[x][y]
              return $array[$m['name']][$m['key'][0]][$m['key'][1]];
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
      preg_match('/\{[a-zA-Z\-]+\:/', $source, $m0);
      preg_match('/\{(.*)\:/', $m0[0], $m1);
      return $m1[1];
    }

    /**
     * pouhe vraceni nactenych hodnot pro value
     *
     * @since 2.32
     * @param string name jmeno elementu
     * @param mixed|null value predavana hodnota
     * @return mixed vracene value
     */
    private function returnVar($name, $value = null) {
      // vraceni nactenych dat z DB
      $value = $this->returnVarFromArray($name, $this->defaults, $value);
      // vraceni poslanych dat z formulare
      return $this->returnVarFromArray($name, $this->returns, $value);
    }

    /**
     * zpracovani value atributu
     *
     * @since 1.18
     * @param array match vyparsrovane pole
     * @param bool attribute true pro vraceni value jako atributu, false jako hodnoty
     * @param bool returnVar true pro automaticke vraceni hodnot ze: setDefaults() nebo setReturnValues()
     * @return string zpracovany atribut value
     */
    private function processValue($match, $attribute = true, $returnVar = true) {
      $value = isset($match['value']) ? $match['value'] : null;
      if ($returnVar) { // pokud je zapnuto vraceni
        $value = $this->returnVar($match['name'], $value);
      }
      if (!$value && isset($this->define_values[$match['name']])) {  // pokud jsou nastaveny predefinovane hodnoty
        $value = $this->define_values[$match['name']];
      }
      // pokud je pole, vraci konkretni klic pole
      if ($this->keyIsArray($match['name'], $m)) {
        if (is_array($value)) {
          if (isset($m['key'][0]) && isset($m['key'][1])) {
            $value = isset($value[$m['key'][0]][$m['key'][1]]) ? $value[$m['key'][0]][$m['key'][1]] : null;
          } else
          if (isset($m['key'][0])) {
            $value = isset($value[$m['key'][0]]) ? $value[$m['key'][0]] : null;
          }
        }
      }
      return $value != '' ? ($attribute ? ' value="'.$value.'"' : $value) : null;  //$value && <- vyhozeno kvuli 0
    }

    /**
     * zpracovani atributu elementu
     * - priklad attributu: |$|class|:|value|,|required|,|placeholder|:|text
     * - oddelovac parovych tagu |:|
     * - oddelovac bloku atributu |$|
     * - zpracovani %%tpl__%% a %%__tpl%% jako nahrazeni za { a } pro TPL kompilaci
     *
     * @since 1.20
     * @param array match vyparsrovane pole
     * @return string prekonvertovane atributy do html tvaru
     */
    private function processAttr($match) {
      $attr = isset($match['attr']) ? $match['attr'] : null;  // vyber atributu
      $attributes = explode($this->separator_attributes, $attr);
      if (isset($this->define_attr[$match['name']])) {  // vyber predefinovaneho atributu
       $attributes += $this->define_attr[$match['name']];
      }
      $separator = $this->separator_attr_k_v;
      $_attr = array_map(function($item) use ($separator) {
          if ($item) {
            if (preg_match('/(.*)'.$separator.'(.*)/', $item, $match)) {
              return ' ' . $match[1] . '="' . $match[2] . '"';  // pair parametry
            } else {
              return ' '.$item; // single parametry
            }
          }
        }, $attributes);
      // zpracovani promennych nebo tpl kodu pro kompilaci formulare
      return str_replace(array('%%tpl__%%', '%%__tpl%%'), //TODO pripadne rozsirit??? nebo dat modifikovatelne?
                          array('{', '}'),
                          implode('', $_attr));
    }

    /**
     * nacteni pole vyparsrovanych pravidel
     *
     * @since 2.08
     * @param void
     * @return array pole pravidel
     */
    public function getRules() {
      return $this->rules;
    }

    /**
     * zpracovani pravidel a zaneseni do vnitrniho pole rules
     * - priklad pravidel: |@|filled|:|vyplneno|,|minlength|:|min delka|:|14
     * - argumenty pravidel zpracovava: Configurator::decode()
     * - nepovinna: ~ , povinny: type, nepovinna: message, nepovinny: argv
     * - vylucuje duplikatni pravidla
     *
     * @since 1.24
     * @param string name jmeno elementu
     * @param array match vyparsrovane pole
     * @return void
     */
    private function processRules($name, $match) {
      $rules = isset($match['rules']) ? explode($this->separator_rules, $match['rules']) : array();
      foreach ($rules as $item) {
        if ($item) {  // pokud neni polozka prazdna
          if (!preg_match('/(?<negation>\~)?(?<type>\w+)(?:('.$this->separator_rules_attr.'(?<message>.*))?'.$this->separator_rules_attr.'(?<argv>.*))?/s', $item, $m)) {
            throw new ExceptionTplForm('nepovedeny format pravidla: '.$item.'!');
          }

          if ($this->ruleHasArgv($m['type'])) {
            if (!isset($m['argv'])) {
              throw new ExceptionTplForm('pravidlo '.$m['type'].' vyzaduje argument!');
            }
          } else {
            if (isset($m['argv'])) {
              $m['message'] = $m['argv'];
              $m['argv'] = null;
            }
          }

          if (!isset($this->rules[$name . '_' . $m['type']])) { // pokud jiz neni nastaveno
            $this->rules[$name . '_' . $m['type']] = array(
                'name' => $name,
                'type' => $m['type'], // typ pravidla
                'negation' => (bool) $m['negation'],  // detekce negace
                'message' => isset($m['message']) ? $m['message'] : null, // chybova zprava
                'argv' => isset($m['argv']) ? ($m['type'] == 'pattern' ? $m['argv'] : Configurator::decode($m['argv'])) : null,  // doplnujici argument, nedekoduje pri patternu
              );
          } else {
            if ($this->rules[$name . '_' . $m['type']] == 'null') { // pokud je vyplnena priznakem prazdneho textu
              unset($this->rules[$name . '_' . $m['type']]);
            }
          }
        }
      }
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
        if (isset($subkey[0]) && isset($subkey[1])) {
          return isset($val[$name][$subkey[0]][$subkey[1]]) ? $val[$name][$subkey[0]][$subkey[1]] : null;
        } else
        if (isset($subkey[0])) {
          return isset($val[$name][$subkey[0]]) ? $val[$name][$subkey[0]] : null;
        } else {
          return $val[$name][0];
        }
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
     * - pri vraceni hodnot neosetruje XSS!
     *
     * @since 1.30
     * @param array rules pole pravidla k aktualnimu elementu
     * @return string zpracovana error hlaska
     */
    private function prepareErrorMsg($rules) {
      $_value = $this->getMethodValue($rules['name']);
      $_value = is_array($_value) && array_key_exists('name', $_value) ? $_value['name'] : $_value;
      if (is_array($_value)) {
        $sl = array_slice($_value, 0, 1);
        $_value = $sl[0];
      }
      $msg = str_replace( // zpracovani substituce name a value
          array('%name', '%value'),
          array($rules['name'], $_value),
          trim($rules['message']) ? $rules['message'] : $this->defaultMsg[$rules['type']]);
      return $rules['argv'] ? vsprintf($msg, $rules['argv']) : $msg;  // substituce z rules
    }

    /**
     * bylo odeslano a je zaroven i validni?
     * - pokud je zapnuta security musi se volat jen na jednom miste!
     * - nesmi se vic kombinovat s isSecurityValid() pokud je (true)
     *
     * @since 1.16
     * @param bool security true pro aplikaci security odesilani, false jen submit && valid, defaultne
     * @return bool true pokud je uplny uspech
     */
    public function isSuccess($security = false) {
      return $this->isSubmitted() && $this->isValid() && ($security ? $this->isSecurityValid() : true);
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
     * jsou nejake chyby?
     *
     * @since 2.30
     * @param void
     * @return bool true pokud jsou nejake chyby
     */
    public function isErrors() {
      return $this->errors ? count($this->errors) > 0 : false;
    }

    /**
     * nastaveni pole polozek, implicitne pro select
     *
     * @since 2.72
     * @param string name html jmeno elementu
     * @param array items pole polozek
     * @param string prompt prvni vybrana polozka
     * @return this
     */
    public function setItems($name, $items, $prompt = null) {
      $this->define_values[$name] = $prompt ? array($prompt) + $items : $items;
      return $this;
    }
//TODO udelat getValue() metodu pro nacitani polozek po odelsani mezi renderem a konstruktorem formulare!!
    /**
     * nastaveni hodnoty polozky
     *
     * @since 2.72
     * @param string name html jmeno elementu
     * @param mixed value hodnota polozky
     * @return this
     */
    public function setValue($name, $value) {
      $this->define_values[$name] = $value;
      return $this;
    }

    /**
     * nastaveni hodnoty atributu
     * - pro single polozky je value typu bool (checked, selected, multiple, ...)
     *
     * @since 2.80
     * @param string name html jmeno elementu
     * @param string attribute klic polozky
     * @param mixed value hodnota polozky
     * @return this
     */
    public function setAttribute($name, $attribute, $value) {
      if (is_bool($value) ? $value : true) {
        $this->define_attr[$name][$attribute] = is_bool($value) ? $attribute : $attribute . $this->separator_attr_k_v_nb . $value; // pri bool dava jen atribut
      }
      return $this;
    }
//TODO metodu na skladani multi podminek respekzive neco jako addCondition|addConditionOn($name, $type, $args = null) {} ?????
    /**
     * manualni pridani specialni podminky
     * - pokud jsou pozadovany podminky ktere formular normalne neumi
     * - podpora funkci (function name(){}) a anonymnich funkci ($a = function(){};)
     * - touhle cestou jde nadefinovat podminky na elementy ktere se primo nerenderuji ve formulari
     * - vklada se jeste pred ->render()
     *
     * @since 2.68
     * @param string name html jmeno elementu
     * @param string type typ podminky
     * @param string text vraceny text podminky pri nesplneni
     * @param mixed args argument podminky
     * @return this
     */
    public function addRule($name, $type, $text = null, $args = null) {
      $callback = null;
      if (is_callable($type)) {
        $callback = $type;
        $type = is_object($type) ? '_'.get_class($type) : '_function';
      }
      preg_match('/(?<negation>\~)?(?<type>\w+)/', $type, $m);
      $this->rules[$name . '_' . $m['type']] = array(
              'name' => $name,
              'type' => $m['type'], // typ pravidla
              'callback' => $callback,  // prenos callback funkce
              'negation' => (bool) $m['negation'],  // detekce negace
              'message' => $text, // chybova zprava
              'argv' => $args);
      return $this;
    }

    /**
     * manualni odebrani podminky
     *
     * @since 2.84
     * @param string name html jmeno elementu
     * @param string type typ podminky
     * @return this
     */
    public function removeRule($name, $type) {
      $this->rules[$name . '_' . $type] = 'null'; // nastaveni prazdneho priznaku
      return $this;
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
      $array = (bool) preg_match('/(?<name>.+)\[.*\]/', $source);
      if ($array) {
        $split = preg_split('/[\[\]]+/', $source);
        $match['name'] = $split[0]; // nacteni jmena
        $match['key'] = array_slice($split, 1, -1); // nacteni klicu
      }
      return $array;
    }

    /**
     * potrebuje pravidlo parametr?
     *
     * @since 2.22
     * @param string type nazev pravidla
     * @return bool true pokud pravidlo potrebuje parametr
     */
    private function ruleHasArgv($type) {
      $rules_argv = array(
          'minlength',
          'maxlength',
          'length',
          'range',
          'min',
          'lessorequal',
          'max',
          'moreorequal',
          'pattern',
          'count',
          'is_in',
          'equal',
          'equalinput',
          'same',
          'filledor',
          'less',
          'more',
          'maxfilesize',
          'mimetype',
          '_Closure', // anonymni funkce
          '_function',  // funkce
        );
      return in_array($type, $rules_argv);
    }

    /**
     * kontrola zadanych pravidel
     * pravidla ovlivnuje: ini_get('post_max_size'); ini_get('upload_max_filesize'); ini_get('max_execution_time');
     *
     * @since 1.26
     * @param array rules pole pravidel
     * @return bool true pokud podminka prosla
     */
    private function checkRules($rules) {
      $value = $this->parseValue($rules['name']);

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
        case 'moreorequal': // >=
          return Core::isInteger($value) || Core::isDouble($value) ? ($argv <= $value) : false;

        case 'max': // maximalni hodnota
        case 'lessorequal': // <=
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

        case 'pattern': // platny regularni vyraz
          return (bool) preg_match('/^' . $argv . '$/', $value);

        case 'count': // kontrola poctu
          if (isset($value['name'])) {  // zatim jen prohlizeni uploadu
            return count($value['name']) == $argv;
          } else {
            return count($value) == $argv;
          }

        /* validatory */

        case 'equal': // porovnani s promennou
        case 'is_in': // kontrola ve vyctu, existuje value v poli argumentu?
          if (is_array($argv)) { // porovnani kdyz je argument pole nebo jen hodnota
            return is_array($value) ? $argv == $value : in_array($value, $argv);
          } else {
            return $value == $argv;
          }

        case 'equalinput':  // porovnani s elementem
          return $value == $this->getMethodValue($argv);

        case 'same':  // striktnejsi porovnani s promennou
          return $value === $argv;

        case 'filled':  // kontrola vyplneni
          return is_array($value) && isset($value['error']) ? ($value['error'] === 0 || is_array($value['error']) && in_array(0, $value['error'], true)) : ($value === 0 || $value != '');

        case 'less':  // mensi jak
          return Core::isInteger($value) || Core::isDouble($value) ? ($value < $argv) : false;

        case 'more':  // vetsi jak
          return Core::isInteger($value) || Core::isDouble($value) ? ($value > $argv): false;

        /* validatory uploadu */

        case 'maxfilesize': // kontrola na velikost (64 * 1024 kb), musi se pak zvlast osetrovat prazdnota!
          if ($value['name']) {
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
          }
          return true;

        case 'mimetype':  // kontrola na mimetyp, via: (http://www.iana.org/assignments/media-types)
          if ($value['name']) {
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
          }
          return true;

        case 'image': // kontrola na obrazek (png, jpg, gif)
          $images = array(
              'image/png',
              'image/jpeg',
              'image/gif',
            );
          if ($value['name']) {
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
          return true;

        case '_Closure': // anonymni funkce (value, argv)
          $callback = $rules['callback'];
          return $callback($value, $argv);

        case '_function':  // klasicka funkce (value, argv)
          return call_user_func($rules['callback'], $value, $argv);

        default:
          throw new ExceptionTplForm('neznama rule podminka!');
      }
      return false;
    }

    /**
     * preparace value pred vracenim s aplikaci ochrany pro XSS
     *
     * @since 2.48
     * @param bool raw true pro cisty vypis, false (null) pro odstraneni html entit
     * @param mixed values vstupni value (pole nebo promenna)
     * @return mixed osetrene value
     */
    private function prepareRaw($raw, $values) {
      if (!$raw) {
        if (is_array($values)) {
          $values = array_map(function($val) {
              return htmlspecialchars($val, ENT_NOQUOTES);
            }, $values);
        } else {
          $values = htmlspecialchars($values, ENT_NOQUOTES);
        }
      }
      return $values;
    }

    /**
     * nacteni pole odeslanych dat
     * - osetruje XSS utoky
     * - defaultne vraci pouze z name elementu pouzitych ve formulari
     *
     * @since 1.16
     * @param bool raw true pro vraceni surovych dat, jinak konvertuje html na text, XSS ochrana
     * @param array other pole dalsich promennych ktere ma foreach zpracovat
     * @return array pole odeslanych dat
     */
    public function getValues($raw = false, $other = array()) {
      $method = $this->getMethodValues();
      $keys = array_merge(array_keys($this->elements), $other);
      $val = array();
      foreach ($keys as $name) {
        if ($this->keyIsArray($name, $m)) {
          switch (count($m['key'])) { // podpora preparsrovani az na 2 urovnove pole
            case 0: //[]
              $val[$m['name']] = isset($method[$m['name']]) ? $this->prepareRaw($raw, $method[$m['name']]) : null;
            break;

            case 1: //[x] / [x][]
              $val[$m['name']][$m['key'][0]] = isset($method[$m['name']][$m['key'][0]]) ? $this->prepareRaw($raw, $method[$m['name']][$m['key'][0]]) : null;
            break;

            case 2: //[x][y]
              $val[$m['name']][$m['key'][0]][$m['key'][1]] = isset($method[$m['name']][$m['key'][0]][$m['key'][1]]) ? $this->prepareRaw($raw, $method[$m['name']][$m['key'][0]][$m['key'][1]]) : null;
            break;
          }
        } else {
          if (isset($method[$name])) {
            $val[$name] = $this->prepareRaw($raw, $method[$name]);  // nacteni udaju jen z aktualniho formulare
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
        $this->defaults += $this->removeIgnoreArray((array) $values, $ignore);
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
        $this->returns += $this->removeIgnoreArray((array) $values, $ignore);
      }
      return $this;
    }

    /**
     * ovladani auto schovavani po odeslani formulare
     * - defaultne vypnute (neschovava)
     * - jen po uspesnem odeslani!! tj: ->isSuccess()
     * - vklada se pred ->render()
     *
     * @since 1.30
     * @param bool state true pro schovani celeho formulare po odeslani, false neschovava
     * @return this
     */
    public function setAutoHide($state) {
      $this->autohide = $state;
      return $this;
    }

    /**
     * automaticke vkladani blokeru proti prokliknuti submit tlacitka
     * - defaultne zapnuto (skryva po kliknuti)
     * - vklada se pred ->render()
     *
     * @since 2.90
     * @param bool state true pri zapinani ochrany, false pro vypnuti ochrany
     * @return this
     */
    public function setSubmitBlocker($state) {
      $this->submit_blocker = $state;
      return $this;
    }

    /**
     * ovladani odesilaci ochrany proti vecenasobnemu odeslani pomoci F5
     * - defaultne vypnuto (povoleni znovu odeslani pres F5)
     * - vklada hidden element s security textem a pracuje se Session
     * - vklada se pred ->render()
     * - design pattern: http://en.wikipedia.org/wiki/Post/Redirect/Get
     *
     * @since 2.96
     * @param bool state true zapnuti ochrany, false vypnuti ochrany
     * @return this
     */
    public function setSubmitSecurity($state) {
      $this->submit_security = $state;
      return $this;
    }

    /**
     * zpracovani atributu formuare
     *
     * @since 1.34
     * @param void
     * @return string zpracovane formularove atributy do textu
     */
    private function processFormAttributes() {
      $result = '';
      foreach ($this->formAttributes as $name => $value) {
        if (!is_null($value)) {
          $result .= ' '.$name.'="'.$value.'"';
        }
      }
      return $result;
    }

    /**
     * nacitani a generovani security textu
     * - nacita a generuje
     *
     * @since 2.94
     * @param bool force_regenerate true pro vynucenou regeneraci textu
     * @return string security text
     */
    public function getSecurityText($force_regenerate = false) {
      $name = $this->submit_security_name;  // jmeno secutiry
      $result = Session::factory()->getSection('tplform')->$name; // nacteni session
      if (!isset($result) || $force_regenerate) {  // pokud je prazdne nebo vynucene generovani
        $result = Core::getUniqText('tplform_');  // vytvoreni textu a priprava na vraceni
        Session::factory()->getSection('tplform')->$name = $result; // ulozeni textu
      }
      return $result;
    }

    /**
     * nacteni security jmena
     *
     * @since 3.00
     * @param void
     * @return string jmeno security elementu
     */
    public function getSecurityName() {
      return $this->submit_security_name;
    }

    /**
     * je odesilany formular bezpecnostne validni?
     * - musi byt zapnute: ->setSubmitSecurity()
     * - vklada se za ->render()
     * - musi byt volane jen jednou!!
     * - varianta 1) ->isSuccess() && ->isSecurityValid()
     * - varianta 2) ->isSuccess(true)
     *
     * @since 2.96
     * @param void
     * @return bool true pokud se bezpecnostni kod plati nebo je security vypnute, false pokud kod neplati
     */
    public function isSecurityValid() {
      $result = true;
      if ($this->submit_security) {
        // porovnani hodnoty formulare a session
        $result = $this->getMethodValue($this->submit_security_name) === $this->getSecurityText();
        // obnoveni klice jen pri uspesnem pruchodu validaci
        $this->getSecurityText($this->isSuccess());
      }
      return $result;
    }

    /**
     * hlavni renderovani
     * - pozor: vola v sobe: isSubmitted() && isValid() takze validace projizdji radobi 2x!
     * - volani: {$form->render()} nebo {compile="$form->render()"}
     *
     * @since 1.10
     * @param void
     * @return string vyrenderovany formular
     */
    public function render() {
      if ($this->submit_security) {
        // pridani security elementu
        $this->template_temp .= '{hidden:'.$this->submit_security_name.'}'; // vytvoreni elementu
        $this->setDefaults(array($this->submit_security_name => $this->getSecurityText())); // nacteni obsahu
      }

      $_compile = $this->compileTemplate($this->template.$this->template_temp); // vlozeni kompilace do kontextu
      $this->template_temp = null;  // vymazani temp template pridavku aby se neduplikovaly elementy
      $result = '<form'.$this->processFormAttributes().'>' . $_compile . '</form>';

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