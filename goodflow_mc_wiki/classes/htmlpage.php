<?php
/*
 * htmlpage.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception;

  class HtmlPage {
    const VERSION = 2.08;

    //doctype
    const DOCTYPE_HTML4 = 'html4';
    const DOCTYPE_HTML5 = 'html5';

    //media
    const MEDIA_SCREEN = 'screen';
    const MEDIA_PRINT = 'print';
    const MEDIA_ALL = 'all';

    private $page = null;

    /**
     * hlavni konstruktor tridy
     *
     * @param doctype typ doctype html4/html5
     * @param htmlClass trida ktera ude obstaravat generovani htmlkodu
     */
    public function __construct($doctype = self::DOCTYPE_HTML5, $htmlClass = 'classes\Html') {
      $this->page = new stdClass;
      $this->page->htmlClass = $htmlClass;  //trida generovani html kodu
      $this->page->head = array();  //head
      $this->page->meta = array();  //meta v head (http-/content, xx/yy)
      $this->page->metaTag = array();  //meta v head (name/content)
      $this->page->title = null;  //title v head
      $this->page->body = array();  //body
      $this->page->favicon = null;  //favicona
      $this->page->embedCSS = array();  //embed css zapis
      $this->page->externalCSS = array(); //externi css linky
      $this->page->embedJS = array();  //embed js zapis
      $this->page->externalJS = array();  //externi js linky
      $this->page->googleCode = null; //kod google analitics
      $this->page->configure = new stdClass;
      $this->page->configure->doctype = $doctype;
      $this->page->configure->language = 'cs';
      $this->page->configure->url = null;
      $this->page->configure->charset = 'utf-8';
      $this->page->configure->bodyAttributes = array();
      $this->page->configure->bodyContent = array('text' => null, 'html' => null);
      $this->page->configure->isBody = false; //detekce jestli uz bylo vlozeno body
    }

    /**
     * vrati nastaveny doctype
     *
     * @return aktualni doctype
     */
    public function getDoctype() {
      return $this->page->configure->doctype;
    }

    /**
     * nastaveni doctype
     *
     * @param doctype jiny doctype nez je defaultni
     * @return this
     */
    public function setDoctype($doctype) {
      $this->page->configure->doctype = $doctype;
      return $this;
    }

    /**
     * zjisti jeslti je nataven doctype na html5
     *
     * @return true pokud je doctype nastaveno na html5
     */
    private function isHtml5() {
      return ($this->page->configure->doctype == self::DOCTYPE_HTML5);
    }

    /**
     * overuje jestli dany klic existuje v danem poli
     * alias metody: Core::isFill()
     *
     * @param array vstupni pole
     * @param key vstupni klic
     * @param default defaultni polozka pokud klic neexistue nebo neni plny
     * @return hodnota z klice nebo default
     */
    private function isFill($array, $key, $default = '') {
      return (!empty($array[$key]) ? $array[$key] : $default);
    }

    /**
     * vrati nasteveny jazyk
     *
     * @return aktualni jazyk
     */
    public function getLanguage() {
      return $this->page->configure->language;
    }

    /**
     * nastavni novy jazyk
     *
     * @param language novy jazyk
     * @return this
     */
    public function setLanguage($language) {
      $this->page->configure->language = $language;
      return $this;
    }

    /**
     * vrati nastevenou url
     *
     * @return url
     */
    public function getUrl() {
      return $this->page->configure->url;
    }

    /**
     * nastavi novou url adresu
     *
     * @param url nova url adresa
     * @return this
     */
    public function setUrl($url) {
      $this->page->configure->url = $url;
      return $this;
    }

    /**
     * vrati aktuani charset
     *
     * @return charset
     */
    public function getCharset() {
      return $this->page->configure->charset;
    }

    /**
     * nastavi novy charset
     *
     * @param charset novy charset
     * @return this
     */
    public function setCharset($charset) {
      $this->page->configure->charset = $charset;
      return $this;
    }

    /**
     * vrati aktualni title
     *
     * @return title
     */
    public function getTitle() {
      return $this->page->title;
    }

    /**
     * nastavi novy title
     *
     * @param title novy title text
     * @return this
     */
    public function setTitle($title) {
      $this->page->title = $title;
      return $this;
    }

    /**
     * prida dalsi meta (tag), z pole
     *
     * @param values pole hodnot meta tagu
     * @return this
     */
    public function addMeta(array $values) {
      if (!empty($values)) {
        //osetreni proti duplikatnimu vkladani
        if (array_search($values, $this->page->meta) === false) {
          $this->page->meta[] = $values;
        }
      }
      return $this;
    }

    /**
     * vraci pole tagu
     *
     * @return pole tagu
     */
    public function getMeta() {
      return $this->page->meta;
    }

    /**
     * prida dalsi meta tag
     *
     * @param name jmeno meta tagu
     * @param content obsah meta tagu content
     * @return this
     */
    public function addMetaTag($name, $content) {
      if (!empty($content)) {
        $this->page->metaTag[$name] = $content;
      }
      return $this;
    }

    /**
     * vrati pole meta tagu
     *
     * @return pole meta tagu
     */
    public function getMetaTag() {
      return $this->page->metaTag;
    }

    /**
     * prida dalsi embed css
     *
     * @param text css zapis
     * @param args pripadne substituce v textu (%s, %d, %f), >1 array()
     * @return this
     */
    public function addEmbedCSS($text, $args = null) {
      $this->page->embedCSS[] = vsprintf($text, $args);
      return $this;
    }

    /**
     * vrati obsah embed css
     *
     * @return pole embed css
     */
    public function getEmbedCSS() {
      return $this->page->embedCSS;
    }

    /**
     * prida dalsi css link
     *
     * @param href cesta/pole cest
     * @param settings pole nastaveni
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
                            'href' => $this->isFill($settings, 'url', $this->page->configure->url).$row,
                            'if' => null,
                            );
            $this->page->externalCSS[] = array_merge($default, $settings, array('url' => null));
          }
        } else {
          $default = array('rel' => 'stylesheet',
                          'type' => (!$this->isHtml5() ? 'text/css' : null),
                          'media' => self::MEDIA_SCREEN,
                          'title' => null,
                          'href' => $this->isFill($settings, 'url', $this->page->configure->url).$href,
                          'if' => null,
                          );
          $this->page->externalCSS[] = array_merge($default, $settings, array('url' => null));
        }
      }
      return $this;
    }

    /**
     * vrati pole css linku
     *
     * @return pole css linku
     */
    public function getExternalCSS() {
      return $this->page->externalCSS;
    }

    /**
     * prida dalsi embed js
     * podpora before/after
     *
     * @param text js zapis
     * @param args pripadne substituce v textu (%s, %d, %f), >1 array()
     * @return this
     */
    public function addEmbedJS($text, $args = null) {
      if (!empty($text)) {
        //prepinani pole before a after body
        if (!$this->page->configure->isBody) {
          $embedJS = &$this->page->embedJS['before'];
        } else {
          $embedJS = &$this->page->embedJS['after'];
        }

        $embedJS[] = vsprintf($text, $args);
      }
      return $this;
    }

    /**
     * vrati obsah embed js
     *
     * @return pole embed js
     */
    public function getEmbedJS() {
      return $this->page->embedJS;
    }

    /**
     * prida dalsi js link
     * podpora before/after
     *
     * @param src cesta/pole cest
     * @param settings pole nastaveni
     * @return this
     */
    public function addExternalJS($src, array $settings = array()) {
      if (!empty($src)) {
        //prepinani pole before a after body
        if (!$this->page->configure->isBody) {
          $externalJS = &$this->page->externalJS['before'];
        } else {
          $externalJS = &$this->page->externalJS['after'];
        }

        if (is_array($src)) {
          foreach ($src as $row) {
            $default = array('type' => (!$this->isHtml5() ? 'text/javascript' : null),
                            'charset' => null,
                            'src' => $this->isFill($settings, 'url', $this->page->configure->url).$row,
                            'if' => null,
                            );
            $externalJS[] = array_merge($default, $settings, array('url' => null));
          }
        } else {
          $default = array('type' => (!$this->isHtml5() ? 'text/javascript' : null),
                          'charset' => null,
                          'src' => $this->isFill($settings, 'url', $this->page->configure->url).$src,
                          'if' => null,
                          );
          $externalJS[] = array_merge($default, $settings, array('url' => null));
        }
      }
      return $this;
    }

    /**
     * vrati pole js linku
     *
     * @return pole js linku
     */
    public function getExternalJS() {
      return $this->page->externalJS;
    }

    /**
     * vrati faviconu
     *
     * @return favicona
     */
    public function getFavicon() {
      return $this->page->favicon;
    }

    /**
     * nastavi favocinu
     *
     * @param href cesta favicony
     * @param settings pole nastaveni
     * @return this
     */
    public function setFavicon($href, array $settings = array()) {
      $default = array('rel' => 'shortcut icon',
                      'type' => null, //image/png
                      'href' => $this->isFill($settings, 'url', $this->page->configure->url).$href,
                      );
      $this->page->favicon = array_merge($default, $settings, array('url' => null));
      return $this;
    }

    /**
     * nastavi google analitics kod
     *
     * @param code google analitics kod
     * @return this
     */
    public function setGoogleAnalytics($code) {
      $htmlClass = $this->page->htmlClass;
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
      $this->page->googleCode = $js;
      return $this;
    }

    /**
     * prida dalsi obsah do head
     *
     * @param head novy element pro head
     * @return this
     */
    public function addHead($head) {
      if (!empty($head)) {
        if (is_array($head)) {
          $this->page->head = array_merge($this->page->head, array_filter($head));
        } else {
          $this->page->head[] = $head;
        }
      }
      return $this;
    }

    /**
     * vrati polozky v head
     *
     * @return pole elementu z head
     */
    public function getHead() {
      return $this->page->head;
    }

    /**
     * prida dalsi obsah do body
     *
     * @param body dalsi body
     * @return this
     */
    public function addBody($body) {
      if (!empty($body)) {
        if (is_array($body)) {
          $this->page->body = array_merge($this->page->body, array_filter($body));
        } else {
          $this->page->body[] = $body;
        }
      }
      $this->page->configure->isBody = true;
      return $this;
    }

    /**
     * vrati polozky z body
     *
     * @return pole elementu z body
     */
    public function getBody() {
      return $this->page->body;
    }

    /**
     * prida do body class
     *
     * @param class novy class selektor
     * @return this
     */
    public function addBodyClass($class) {
      if (!is_null($class)) {
        $this->page->configure->bodyAttributes['class'][] = $class;
      }
      return $this;
    }

    /**
     * nastavi do body id
     *
     * @param id novy id selektor
     * @return this
     */
    public function setBodyId($id) {
      if (!is_null($id)) {
        $this->page->configure->bodyAttributes['id'] = $id;
      }
      return $this;
    }

    /**
     * nastavi text do body
     *
     * @param text
     * @return this
     */
    public function setBodyText($text) {
      if (!is_null($text)) {
        $this->page->configure->bodyContent['text'][] = $text;
      }
      return $this;
    }

    /**
     * nastavi textove html do body
     *
     * @param html
     * @return this
     */
    public function setBodyHtml($html) {
      if (!is_null($html)) {
        $this->page->configure->bodyContent['html'][] = $html;
      }
      return $this;
    }

    /**
     * magicka metoda zajistujici render pri echo
     *
     * @return vyrenderovana stranka
     */
    public function __toString() {
      return $this->render();
    }

    /**
     * renderovani samotne html stranky dle nastaveni
     *
     * @return html stranka
     */
    public function render() {
      $result = '';

      $htmlClass = $this->page->htmlClass;
      $html5 = $this->isHtml5();

      switch($this->page->configure->doctype) {
        case self::DOCTYPE_HTML4: //xhtml4 strict
          $result .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'.PHP_EOL;
          $html = $htmlClass::html(array(
                                  'xmlns' => 'http://www.w3.org/1999/xhtml',
                                  'xml:lang' => $this->page->configure->language,
                                  'lang' => $this->page->configure->language)
                                  );

          //implicitni deklarace mety
          $this->addMeta(array('http-equiv' => 'Content-Type', 'content' => 'text/html; charset='.strtoupper($this->page->configure->charset)))
              ->addMeta(array('http-equiv' => 'Content-Language', 'content' => $this->page->configure->language));
        break;

        case self::DOCTYPE_HTML5:
          $result .= '<!DOCTYPE html>'.PHP_EOL;
          $html = $htmlClass::html()->lang($this->page->configure->language);

          //implicitni deklarace mety
          $this->addMeta(array('charset' => $this->page->configure->charset));
        break;
      }

      //generovani meta
      $callbackMeta = function($value, $key, $data) {
        $data['out'][] = $data['class']::meta($value);
      };
      array_walk($this->page->meta, $callbackMeta, array('class' => $htmlClass, 'out' => &$meta));

      //generovani meta tagu
      $callbackMetaTag = function($value, $key, $data) {
        $data['out'][] = $data['class']::meta()->name($key)->content($value);
      };
      array_walk($this->page->metaTag, $callbackMetaTag, array('class' => $htmlClass, 'out' => &$metaTag));

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
      array_walk($this->page->externalCSS, $callbackExternalCSS, array('class' => $htmlClass, 'last' => &$a, 'out' => &$externalCSS));
      unset($a);

      //generovani embed ccs
      $embedCSS = null;
      if (!empty($this->page->embedCSS)) {
        //pokud je zanorovani zapnute
        if ($htmlClass::getBreakDepth()) {
          $_text = PHP_EOL.'      '.implode(PHP_EOL.'      ', $this->page->embedCSS).PHP_EOL.'    ';
        } else {
          $_text = implode(' ', $this->page->embedCSS);
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
      $before = $this->isFill($this->page->externalJS, 'before', array());
      array_walk($before, $callbackExternalJS, array('class' => $htmlClass, 'last' => &$a, 'out' => &$beforeExternalJS));
      unset($a);
      //after
      $after = $this->isFill($this->page->externalJS, 'after', array());
      array_walk($after, $callbackExternalJS, array('class' => $htmlClass, 'last' => &$a, 'out' => &$afterExternalJS));
      unset($a);

      //pridani google code do embed after js
      if ($this->page->googleCode) {
        $this->page->embedJS['after'][] = $this->page->googleCode;
      }

      //generovani embed js
      $beforeEmbedJS = null;
      $afterEmbedJS = null;
      if (!empty($this->page->embedJS)) {
        //before
        $before = $this->isFill($this->page->embedJS, 'before');
        if ($before) {
          $beforeEmbedJS = $htmlClass::script()->type('text/javascript')->setHtml($before);
        }

        //after
        $after = $this->isFill($this->page->embedJS, 'after');
        if ($after) {
          $afterEmbedJS = $htmlClass::script()->type('text/javascript')->setHtml($after);
        }
      }

      //generovani favicon
      $favicon = null;
      if (!is_null($this->page->favicon)) {
        $favicon = $htmlClass::link($this->page->favicon);
      }

      //generovani head
      $head = $htmlClass::head();
      $head->add($this->page->head)
          ->add($meta)
          ->add($metaTag)
          ->add($externalCSS)
          ->add($embedCSS)
          ->add($htmlClass::title()->setText($this->page->title))
          ->add($favicon)
          ->add($beforeExternalJS)
          ->add($beforeEmbedJS)
          ;

      //generovani body
      $body = $htmlClass::body($this->page->configure->bodyAttributes);
      $body->setText($this->page->configure->bodyContent['text']) //vkladani textu
          ->setHtml($this->page->configure->bodyContent['html'])  //vkladani html textu
          ->add($this->page->body)
          ->add($afterExternalJS)
          ->add($afterEmbedJS)
          ;

      //slozeni hlavicky a telicka
      $result .= $html->add($head)
                      ->add($body)
                      ->render();

      return $result;
    }
  }

  class ExceptionHtmlPage extends Exception {}

?>
