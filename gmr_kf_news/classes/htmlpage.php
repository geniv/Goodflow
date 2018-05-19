<?php
/*
 * htmlpage.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * trida starajici se o zakladni vygenerovani stranky (html + head + body)
   *
   * @package stable
   * @author geniv
   * @version 3.20
   */
  class HtmlPage {

    //doctype
    const DOCTYPE_HTML4 = 'html4';
    const DOCTYPE_HTML5 = 'html5';

    //media
    const MEDIA_SCREEN = 'screen';
    const MEDIA_PRINT = 'print';
    const MEDIA_ALL = 'all';

    // samotne atributy
    private $head = array();  // head
    private $body = array();  // body

    private $embedCSS = array();    // embed css zapis
    private $externalCSS = array(); // externi css linky
    private $embedJS = array();     // embed js zapis
    private $externalJS = array();  // externi js linky

//text/ng-template

    // konfigurace
    private $conf = array(
        'htmlClass' => null,  //  trida pro generovani html kodu

        'meta' => array(),    // meta v head (http-/content, xx/yy)
        'metaTag' => array(), // meta v head (name/content)

        'title' => null,      // title v head
        'favicon' => null,    // favicona
        'googleCode' => null, // kod google analitics

        'angularjs' => false, // zapinani AngularJS (http://angularjs.org/)

        'doctype' => null,    // doctype stranek
        'language' => 'cs',
        'url' => null,
        'charset' => 'utf-8',
        'bodyAttributes' => array(),
        'bodyContent' => array('text' => null, 'html' => null),
        'isBody' => false,  // detekce jestli uz bylo vlozeno body
    );

    /**
     * defaultni konstruktor tridy
     *
     * @since 3.00
     * @param string doctype typ doctype html4/html5
     * @param string htmlClass trida ktera ude obstaravat generovani htmlkodu
     */
    public function __construct($doctype = self::DOCTYPE_HTML5, $htmlClass = 'classes\Html') {
      $this->conf['htmlClass'] = $htmlClass;
      $this->conf['doctype'] = $doctype;
    }

    /**
     * vrati nastaveny doctype
     *
     * @since 3.00
     * @param void
     * @return string aktualni doctype
     */
    public function getDoctype() {
      return $this->conf['doctype'];
    }

    /**
     * nastaveni doctype
     *
     * @since 3.00
     * @param string doctype jiny doctype nez je defaultni
     * @return this
     */
    public function setDoctype($doctype) {
      $this->conf['doctype'] = $doctype;
      return $this;
    }

    /**
     * Nastavovani stavu pro AngularJS
     * - podle stranek: http://angularjs.org/
     *
     * @since 3.12
     * @param string|bool state true pro zapnuti nebo text pro nazev angular projektu
     * @return this
     */
    public function setAngularJS($state) {
      $this->conf['angularjs'] = $state;
      if ($state) { //TODO pridat moznost na predavani rucni adresy?
        $this->addExternalJS('https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js');
      }
      return $this;
    }

    /**
     * zjisti jeslti je nataven doctype na html5
     *
     * @since 3.00
     * @param void
     * @return bool true pokud je doctype nastaveno na html5
     */
    private function isHtml5() {
      return ($this->conf['doctype'] == self::DOCTYPE_HTML5);
    }

    /**
     * overuje jestli dany klic existuje v danem poli
     * alias metody: Core::isFill()
     *
     * @since 3.00
     * @param array array vstupni pole
     * @param string key vstupni klic
     * @param mixed default defaultni polozka pokud klic neexistue nebo neni plny
     * @return mixed hodnota z klice nebo default
     */
    private function isFill($array, $key, $default = '') {
      return (!empty($array[$key]) ? $array[$key] : $default);
    }

    /**
     * vrati nasteveny jazyk
     *
     * @since 3.00
     * @param void
     * @return string aktualni jazyk
     */
    public function getLanguage() {
      return $this->conf['language'];
    }

    /**
     * nastavni novy jazyk
     *
     * @since 3.00
     * @param string language novy jazyk
     * @return this
     */
    public function setLanguage($language) {
      $this->conf['language'] = $language;
      return $this;
    }

    /**
     * vrati nastevenou url
     *
     * @since 3.00
     * @param void
     * @return string url
     */
    public function getUrl() {
      return $this->conf['url'];
    }

    /**
     * nastavi novou url adresu
     *
     * @since 3.00
     * @param string url nova url adresa
     * @return this
     */
    public function setUrl($url) {
      $this->conf['url'] = $url;
      return $this;
    }

    /**
     * vrati aktuani charset
     *
     * @since 3.00
     * @param void
     * @return string charset
     */
    public function getCharset() {
      return $this->conf['charset'];
    }

    /**
     * nastavi novy charset
     *
     * @since 3.00
     * @param string charset novy charset
     * @return this
     */
    public function setCharset($charset) {
      $this->conf['charset'] = $charset;
      return $this;
    }

    /**
     * vrati aktualni title
     *
     * @since 3.00
     * @param void
     * @return string title
     */
    public function getTitle() {
      return $this->conf['title'];
    }

    /**
     * nastavi novy title
     *
     * @since 3.00
     * @param string title novy title text
     * @return this
     */
    public function setTitle($title) {
      if (isset($title)) {
        $this->conf['title'] = $title;
      }
      return $this;
    }

    /**
     * prida dalsi meta (tag), z pole
     *
     * @since 3.00
     * @param array values pole hodnot meta tagu
     * @return this
     */
    public function addMeta(array $values) {
      if (!empty($values)) {
        //osetreni proti duplikatnimu vkladani
        if (array_search($values, $this->conf['meta']) === false) {
          $this->conf['meta'][] = $values;
        }
      }
      return $this;
    }

    /**
     * vraci pole tagu
     *
     * @since 3.00
     * @param void
     * @return array pole tagu
     */
    public function getMeta() {
      return $this->conf['meta'];
    }

    /**
     * prida dalsi meta tag
     *
     * @since 3.00
     * @param string name jmeno meta tagu
     * @param string content obsah meta tagu content
     * @return this
     */
    public function addMetaTag($name, $content) {
      if (isset($content)) {
        $this->conf['metaTag'][$name] = $content;
      }
      return $this;
    }

    /**
     * vrati pole meta tagu
     *
     * @since 3.00
     * @param void
     * @return array pole meta tagu
     */
    public function getMetaTag() {
      return $this->conf['metaTag'];
    }

    /**
     * prida dalsi embed css
     *
     * @since 3.00
     * @param string text css zapis
     * @param array args pripadne substituce v textu (%s, %d, %f), >1 array()
     * @return this
     */
    public function addEmbedCSS($text, $args = null) {
      if (!empty($text)) {
        $this->embedCSS[] = vsprintf($text, $args);
      }
      return $this;
    }

    /**
     * vrati obsah embed css
     *
     * @since 3.00
     * @param void
     * @return pole embed css
     */
    public function getEmbedCSS() {
      return $this->embedCSS;
    }

    /**
     * prida dalsi css link
     *
     * @since 3.00
     * @param string href cesta/pole cest
     * @param array settings pole nastaveni
     * @return this
     */
    public function addExternalCSS($href, array $settings = array()) {
      if (!empty($href)) {
        if (is_array($href)) {
          foreach ($href as $row) {
            $default = array('rel' => 'stylesheet',
                            'type' => (!$this->isHtml5() ? 'text/css' : null),
                            'media' => self::MEDIA_SCREEN,
                            'title' => null,
                            'href' => $this->isFill($settings, 'url', $this->conf['url']).$row,
                            'if' => null,
                            );
            $this->externalCSS[] = array_merge($default, $settings, array('url' => null));
          }
        } else {
          $default = array('rel' => 'stylesheet',
                          'type' => (!$this->isHtml5() ? 'text/css' : null),
                          'media' => self::MEDIA_SCREEN,
                          'title' => null,
                          'href' => $this->isFill($settings, 'url', $this->conf['url']).$href,
                          'if' => null,
                          );
          $this->externalCSS[] = array_merge($default, $settings, array('url' => null));
        }
      }
      return $this;
    }

    /**
     * vrati pole css linku
     *
     * @since 3.00
     * @param void
     * @return array pole css linku
     */
    public function getExternalCSS() {
      return $this->externalCSS;
    }

    /**
     * prida rss link
     *
     * @since 3.00
     * @param string href adresa rss kanalu
     * @param string title popisek rss kanalu
     * @return this
     */
    public function addRSS($href, $title, $type = 'application/rss+xml') {
      return $this->addExternalCSS($href, array('rel' => 'alternate', 'media' => null, 'title' => $title, 'type' => $type));
    }

    /**
     * prida dalsi embed js
     * - podpora before/after
     *
     * @since 3.00
     * @param string text js zapis
     * @param array args pripadne substituce v textu (%s, %d, %f), >1 array()
     * @return this
     */
    public function addEmbedJS($text, $args = null) {
      if (!empty($text)) {
        //prepinani pole before a after body
        if (!$this->conf['isBody']) {
          $embedJS = &$this->embedJS['before'];
        } else {
          $embedJS = &$this->embedJS['after'];
        }
        $embedJS[] = vsprintf($text, $args);
      }
      return $this;
    }

    /**
     * vrati obsah embed js
     *
     * @since 3.00
     * @param void
     * @return array pole embed js
     */
    public function getEmbedJS() {
      return $this->embedJS;
    }

    /**
     * prida dalsi js link
     * - podpora before/after
     *
     * @since 3.00
     * @param string src cesta/pole cest
     * @param array settings pole nastaveni
     * @return this
     */
    public function addExternalJS($src, array $settings = array()) {
      if (!empty($src)) {
        //prepinani pole before a after body
        if (!$this->conf['isBody']) {
          $externalJS = &$this->externalJS['before'];
        } else {
          $externalJS = &$this->externalJS['after'];
        }

        if (is_array($src)) {
          foreach ($src as $row) {
            $default = array('type' => (!$this->isHtml5() ? 'text/javascript' : null),
                            'charset' => null,
                            'src' => $this->isFill($settings, 'url', $this->conf['url']).$row,
                            'if' => null,
                            );
            $externalJS[] = array_merge($default, $settings, array('url' => null));
          }
        } else {
          $default = array('type' => (!$this->isHtml5() ? 'text/javascript' : null),
                          'charset' => null,
                          'src' => $this->isFill($settings, 'url', $this->conf['url']).$src,
                          'if' => null,
                          );
          $externalJS[] = array_merge($default, $settings, array('url' => null));
        }
      }
      return $this;
    }

    /**
     * nastaveni CSS, array external a embed ze StaticWeb
     *
     * @since 3.00
     * @param array data pole dat, array: external, text: embed
     * @return this
     */
    public function setCSS($data) {
      if (isset($data['external'])) {
        foreach ($data['external'] as $v) {
          $this->addExternalCSS($v);
        }
      }
      $this->addEmbedCSS($data['embed']);
      return $this;
    }

    /**
     * nastaveni JS, array external a embed ze StaticWeb
     *
     * @since 3.00
     * @param array data pole dat, array: external, text: embed
     * @return this
     */
    public function setJS($data) {
      if (isset($data['external'])) {
        foreach ($data['external'] as $v) {
          $this->addExternalJS($v);
        }
      }
      $this->addEmbedJS($data['embed']);
      return $this;
    }

    /**
     * vrati pole js linku
     *
     * @since 3.00
     * @param void
     * @return array pole js linku
     */
    public function getExternalJS() {
      return $this->externalJS;
    }

    /**
     * vrati faviconu
     *
     * @since 3.00
     * @param void
     * @return string favicona
     */
    public function getFavicon() {
      return $this->conf['favicon'];
    }

    /**
     * nastavi favocinu
     *
     * @since 3.00
     * @param href cesta favicony
     * @param settings pole nastaveni
     * @return this
     */
    public function setFavicon($href, array $settings = array()) {
      $default = array('rel' => 'shortcut icon',
                      'type' => null, //image/png
                      'href' => $this->isFill($settings, 'url', $this->conf['url']).$href,
                      );
      $this->conf['favicon'] = array_merge($default, $settings, array('url' => null));
      return $this;
    }

    /**
     * nastavi google analitics kod
     *
     * @since 3.00
     * @param string code google analitics kod
     * @return this
     */
    public function setGoogleAnalytics($code) {
      $htmlClass = $this->conf['htmlClass'];
      if ($htmlClass::getBreakDepth()) {
        //pokud se zalamuje
        $js = sprintf('
      var _gaq = _gaq || [];
      _gaq.push([\'_setAccount\', \'%s\']);
      _gaq.push([\'_trackPageview\']);
      (function() {
        var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
        ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
        var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
      })();
    ', $code);
      } else {
        //TODO test jestli se neco v JS nerozilo!
        $js = sprintf('var _gaq=_gaq||[];_gaq.push([\'_setAccount\',\'%s\']);_gaq.push([\'_trackPageview\']);(function(){var ga=document.createElement(\'script\');ga.type =\'text/javascript\';ga.async=true;ga.src=(\'https:\'==document.location.protocol?\'https://ssl\':\'http://www\')+\'.google-analytics.com/ga.js\';var s=document.getElementsByTagName(\'script\')[0];s.parentNode.insertBefore(ga,s);})();', $code);
      }
      $this->conf['googleCode'] = $js;
      return $this;
    }

    /**
     * prida dalsi obsah do head
     *
     * @since 3.00
     * @param array|Html head novy element pro head
     * @return this
     */
    public function addHead($head) {
      if (!empty($head)) {
        if (is_array($head)) {
          $this->head = array_merge($this->head, array_filter($head));
        } else {
          $this->head[] = $head;
        }
      }
      return $this;
    }

    /**
     * vrati polozky v head
     *
     * @since 3.00
     * @param void
     * @return array pole elementu z head
     */
    public function getHead() {
      return $this->head;
    }

    /**
     * prida dalsi obsah do body
     *
     * @since 3.00
     * @param Html body dalsi body
     * @return this
     */
    public function addBody($body) {
      if (!empty($body)) {
        if (is_array($body)) {
          $this->body = array_merge($this->body, array_filter($body));
        } else {
          $this->body[] = $body;
        }
      }
      $this->conf['isBody'] = true;
      return $this;
    }

    /**
     * vrati polozky z body
     *
     * @since 3.00
     * @param void
     * @return array pole elementu z body
     */
    public function getBody() {
      return $this->body;
    }

    /**
     * prida do body class
     *
     * @since 3.00
     * @param string class novy class selektor
     * @return this
     */
    public function addBodyClass($class) {
      if (!is_null($class)) {
        $this->conf['bodyAttributes']['class'][] = $class;
      }
      return $this;
    }

    /**
     * nastavi do body id
     *
     * @since 3.00
     * @param string id novy id selektor
     * @return this
     */
    public function setBodyId($id) {
      if (!is_null($id)) {
        $this->conf['bodyAttributes']['id'] = $id;
      }
      return $this;
    }

    /**
     * nastavi text do body
     * - vklada se pouze 1x !!
     *
     * @since 3.00
     * @param string text text do telicka
     * @return this
     */
    public function setBodyText($text) {
      if (!is_null($text)) {
        $this->conf['bodyContent']['text'][] = $text;
        $this->conf['isBody'] = true;
      }
      return $this;
    }

    /**
     * nastavi textove html do body
     * - vklada se pouze 1x !!
     *
     * @since 3.00
     * @param Html html obsah pro body
     * @return this
     */
    public function setBodyHtml($html) {
      if (!is_null($html)) {
        $this->conf['bodyContent']['html'][] = $html;
        $this->conf['isBody'] = true;
      }
      return $this;
    }

    /**
     * magicka metoda zajistujici render pri echo
     *
     * @since 3.00
     * @param void
     * @return vyrenderovana stranka
     */
    public function __toString() {
      return $this->render();
    }
//TODO dodelat pro implementaci AngularJS
    /**
     * renderovani samotne html stranky dle nastaveni
     *
     * @since 3.00
     * @param void
     * @return html stranka
     */
    public function render() {
      $result = '';

      $htmlClass = $this->conf['htmlClass'];
      $html5 = $this->isHtml5();
      $angularjs = (bool) $this->conf['angularjs'];

      switch($this->conf['doctype']) {
        case self::DOCTYPE_HTML4: //xhtml4 strict
          $result .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'.PHP_EOL;
          $html = $htmlClass::html(array(
                                  'xmlns' => 'http://www.w3.org/1999/xhtml',
                                  'xml:lang' => $this->conf['language'],
                                  'lang' => $this->conf['language'])
                                  );

          //implicitni deklarace mety
          $this->addMeta(array('http-equiv' => 'Content-Type', 'content' => 'text/html; charset='.strtoupper($this->conf['charset'])))
              ->addMeta(array('http-equiv' => 'Content-Language', 'content' => $this->conf['language']));
        break;

        case self::DOCTYPE_HTML5:
          $result .= '<!DOCTYPE html>'.PHP_EOL;
          $html = $htmlClass::html()->lang($this->conf['language']);($html);
          if ($angularjs) {
            $html->ng_app($this->conf['angularjs']);
          }
          //implicitni deklarace mety
          $this->addMeta(array('charset' => $this->conf['charset']));
        break;
      }

      //generovani meta
      $callbackMeta = function($value, $key, $data) {
        $data['out'][] = $data['class']::meta($value);
      };
      array_walk($this->conf['meta'], $callbackMeta, array('class' => $htmlClass, 'out' => &$meta));

      //generovani meta tagu
      $callbackMetaTag = function($value, $key, $data) {
        $data['out'][] = $data['class']::meta()->name($key)->content($value);
      };
      array_walk($this->conf['metaTag'], $callbackMetaTag, array('class' => $htmlClass, 'out' => &$metaTag));

      //generovani external css
      $callbackExternalCSS = function($value, $key, $data) {
        $if = $value['if']; //ziskani if
        $value['if'] = null;  //nullovani if
        $link = $data['class']::link($value); //vytvoreni css linku
        //pokud je definovana podminka
        if ($if) {
          if ($data['last'] && $data['last'] === $if) {
            //sahne do posledniho a vlozi se do same podminky
            $data['out'][count($data['out']) - 1]->add($link);
          } else {
            //vlozi (prvni) link do podminky
            $data['out'][] = $data['class']::noteif($if)->add($link);
          }
        } else {
          //vlozi cisty link
          $data['out'][] = $link;
        }
        $data['last'] = $if;  //ulozeni posledni podminky pro detekci slouceni
      };
      array_walk($this->externalCSS, $callbackExternalCSS, array('class' => $htmlClass, 'last' => &$a, 'out' => &$externalCSS));
      unset($a);

      //generovani embed ccs
      $embedCSS = null;
      if (!empty($this->embedCSS)) {
        //pokud je zanorovani zapnute
        if ($htmlClass::getBreakDepth()) {
          $_text = PHP_EOL.'      '.implode(PHP_EOL.'      ', $this->embedCSS).PHP_EOL.'    ';
        } else {
          $_text = implode(' ', $this->embedCSS);
        }

        $embedCSS = $htmlClass::style()->type('text/css')->media('screen')->setHtml($_text);
      }

      //generovani external js
      $callbackExternalJS = function($value, $key, $data) {
        $if = $value['if']; //ziskani if
        $value['if'] = null;  //nullovani if
        $link = $data['class']::script($value); //vytvoreni js linku
        //pokud je definovana podminka
        if ($if) {
          if ($data['last'] && $data['last'] === $if) {
            //sahne do posledniho a vlozi se do same podminky
            $data['out'][count($data['out']) - 1]->add($link);
          } else {
            //vlozi (prvni) link do podminky
            $data['out'][] = $data['class']::noteif($if)->add($link);
          }
        } else {
          //vlozi cisty link
          $data['out'][] = $link;
        }
        $data['last'] = $if;  //ulozeni posledni podminky pro detekci slouceni
      };
      //before
      $before = $this->isFill($this->externalJS, 'before', array());
      array_walk($before, $callbackExternalJS, array('class' => $htmlClass, 'last' => &$a, 'out' => &$beforeExternalJS));
      unset($a);
      //after
      $after = $this->isFill($this->externalJS, 'after', array());
      array_walk($after, $callbackExternalJS, array('class' => $htmlClass, 'last' => &$a, 'out' => &$afterExternalJS));
      unset($a);

      //pridani google code do embed after js
      if ($this->conf['googleCode']) {
        $this->embedJS['after'][] = $this->conf['googleCode'];
      }

      //generovani embed js
      $beforeEmbedJS = null;
      $afterEmbedJS = null;
      if (!empty($this->embedJS)) {
        //before
        $before = $this->isFill($this->embedJS, 'before');
        if ($before) {
          $beforeEmbedJS = $htmlClass::script()->type('text/javascript')->setHtml($before);
        }

        //after
        $after = $this->isFill($this->embedJS, 'after');
        if ($after) {
          $afterEmbedJS = $htmlClass::script()->type('text/javascript')->setHtml($after);
        }
      }

      //generovani favicon
      $favicon = null;
      if ($this->conf['favicon']) {
        $favicon = $htmlClass::link($this->conf['favicon']);
      }

      //generovani head
      $head = $htmlClass::head();
      $head->add($this->head)
          ->add($meta)
          ->add($metaTag)
          ->add($externalCSS)
          ->add($embedCSS)
          ->add($htmlClass::title()->setText($this->conf['title']))
          ->add($favicon)
          ->add($beforeExternalJS)
          ->add($beforeEmbedJS);

      //generovani body
      $body = $htmlClass::body($this->conf['bodyAttributes']);
      $body->setText($this->conf['bodyContent']['text']) //vkladani textu
          ->setHtml($this->conf['bodyContent']['html'])  //vkladani html textu
          ->add($this->body)
          ->add($afterExternalJS)
          ->add($afterEmbedJS);

      //slozeni hlavicky a telicka
      $result .= $html->add($head)
                      ->add($body)
                      ->render();

      return $result;
    }
  }


  /**
   * trida vyjimky pro HtmlPage
   *
   * @package stable
   * @author geniv
   * @version 1.00
   */
  class ExceptionHtmlPage extends \Exception {}