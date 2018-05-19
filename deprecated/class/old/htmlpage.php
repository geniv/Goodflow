<?php
/*
 *      htmlpage.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 * @deprecated
 */

  namespace classes;

  use stdClass,
      classes\Core,
      classes\Html,
      //classes\Cache,
      Exception;

//FIXME nasadit implementaci?? dodelat system cachovani stranek!
  final class HtmlPage {
    const VERSION = 1.68;

    const DOCTYPE_STRICT = 'strict';
    const DOCTYPE_HTML5 = 'html5';

    const MEDIA_SCREEN = 'screen';
    const MEDIA_PRINT = 'print';
    const MEDIA_ALL = 'all';

    private $page;  //nova globalni promenna

//TODO ++charset?!

//konstruktor, htmlpage, defaultni doctype je strict
    public function __construct($doctype = self::DOCTYPE_STRICT) {
      $this->page = new stdClass;
      $this->page->conf = new stdClass;
      $this->page->meta = array();
      $this->page->css = array();
      $this->page->condcss = array();
      $this->page->title = NULL;
      $this->page->javascript = array();
      $this->page->condjs = array();
      $this->page->js = array();
      $this->page->endjs = array();
      $this->page->body = array();
      $this->page->bodyattr = array();
      $this->setDoctype($doctype);
      $this->setTitleSeparator(' - ');
      $this->setUrlPage('');

      $this->page->html5 = ($doctype == self::DOCTYPE_HTML5);
    }

    public function isHtml5() {
      return $this->page->html5;
    }
//self::isHtml5()
    public function setDoctype($doctype) {
      $this->page->conf->doctype = $doctype;
      return $this;
    }

    public function setLanguage($lang) {
      $this->page->conf->lang = $lang;
      return $this;
    }

    public function addMeta($name, $content) {
      $this->page->meta[$name] = $content;
      return $this;
    }

//TODO zatahat volani tridy cache

    public function loadCSS($href, array $settings = array()) {
      if (!empty($href)) {
        $settings['rel'] = Core::isFill($settings, 'rel', 'stylesheet');
        if (!self::isHtml5()) {
          $settings['type'] = Core::isFill($settings, 'type', 'text/css');
        }
        $settings['media'] = Core::isFill($settings, 'media', self::MEDIA_SCREEN);
        $settings['title'] = Core::isFill($settings, 'title', NULL);
        $settings['href'] = sprintf('%s%s', $this->page->conf->urlpage, $href);
        $this->page->css[] = $settings;
      }
      return $this;
    }

//conditional css
    public function loadConditionalCSS($href, $if, array $settings = array()) {
      $settings['rel'] = Core::isFill($settings, 'rel', 'stylesheet');
      if (!self::isHtml5()) {
        $settings['type'] = Core::isFill($settings, 'type', 'text/css');
      }
      $settings['media'] = Core::isFill($settings, 'media', self::MEDIA_SCREEN);
      $settings['title'] = Core::isFill($settings, 'title', NULL);
      $settings['href'] = sprintf('%s%s', $this->page->conf->urlpage, $href);
      $this->page->condcss[$if][] = $settings;
      return $this;
    }

//conditional js
    public function loadConditionalJavaScript($src, $if, array $settings = array()) {
      if (!self::isHtml5()) {
        $settings['type'] = Core::isFill($settings, 'type', 'text/javascript');
      }
      $settings['charset'] = Core::isFill($settings, 'charset', NULL);
      $settings['src'] = $src;
      $this->page->condjs[$if][] = $settings;
      return $this;
    }

    public function loadJavaScript($src, array $settings = array()) {
      if (!empty($src)) {
        if (!self::isHtml5()) {
          $settings['type'] = Core::isFill($settings, 'type', 'text/javascript');
        }
        $settings['charset'] = Core::isFill($settings, 'charset', NULL);
        $settings['src'] = sprintf('%s%s', $this->page->conf->urlpage, $src);
        $this->page->javascript[] = $settings;
      }
      return $this;
    }

//nacitani js/css/script modulu z pripojenych php modulu
    public function loadModules($modules) {
      $js = Core::isFill($modules, 'js', array());
      foreach ($js as $item) {
        $this->loadJavaScript($item);
      }

      $css = Core::isFill($modules, 'css', array());
      foreach ($css as $item) {
        $this->loadCSS($item);
      }

      $script = Core::isFill($modules, 'script', array());
      foreach ($script as $item) {
        $this->addJavaScript($item);
      }
      return $this;
    }

    public function setUrlPage($url) {
      $this->page->conf->urlpage = $url;
      return $this;
    }

    public function setInsertStyle($styles) {
      $this->page->insert_style = $styles;
      return $this;
    }

    public function setTitleSeparator($separ) {
      $this->page->conf->titlesep = $separ;
      return $this;
    }

    public function setTitle($title) {
      if (is_array($title)) {
        $this->page->title = Core::implodeTitle($title, $this->page->conf->titlesep);
      } else {
        $this->page->title = $title;
      }
      return $this;
    }
//FIXME pridat moznost do skriptu davat absolutni adresu pres nejaky zastupny znak!!!!
    public function setFavicon($href, array $settings = array()) {
      $settings['type'] = Core::isFill($settings, 'type', NULL);
      $settings['rel'] = Core::isFill($settings, 'rel', 'shortcut icon');
      $settings['enabled'] = Core::isNull($settings, 'enabled', true);
      $settings['href'] = $href;
      $this->page->conf->favicon = $settings;
      return $this;
    }

//radkovej JS
    public function addJavaScript($script, $args = NULL) {
      $markup = Core::getOptionalMarkup($script, array('/\*url\*/' => $this->page->conf->urlpage));
      $this->page->js[] = (!empty($args) ? vsprintf($markup, $args) : $markup);
      return $this;
    }

//nastavovani kodu google analytics
    public function setGoogleAnalytics($code) {
      $this->page->endjs[] = sprintf('
      var _gaq = _gaq || [];
      _gaq.push([\'_setAccount\', \'%s\']);
      _gaq.push([\'_trackPageview\']);
      (function() {
        var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
        ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
        var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
      })();
    ', $code);
      return $this;
    }

    public function addEndJavaScript($script) {
      $this->page->endjs[] = $script;
      return $this;
    }

//FIXME umoznost zpracovavat i pole i text
    public function addBody($html) {
      if (is_array($html)) {
        $this->page->body += $html; //TODO test na spravne indexovani
      } else {
        $this->page->body[] = $html;
      }
      return $this;
    }

//jeden i pole class
    public function addBodyClass($class) {
      $this->page->bodyattr['class'][] = $class;
      return $this;
    }

//pouze jedno id
    public function setBodyId($id) {
      $this->page->bodyattr['id'] = $id;
      return $this;
    }

    public function __toString() {
      return $this->render();
    }

    public function render() {
      $result = array();
      //print_r($this->conf);
//TODO dopracovat!!!
      switch ($this->page->conf->doctype) {
        case self::DOCTYPE_STRICT:
          $result[] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'.PHP_EOL;

          $html = Html::elem('html')
                  ->addAttributes(array('xmlns' => 'http://www.w3.org/1999/xhtml',
                                        'xml:lang' => $this->page->conf->lang,
                                        'lang' => $this->page->conf->lang));
        break;

        case self::DOCTYPE_HTML5:
          $result[] = '<!DOCTYPE html>'.PHP_EOL;

          $html = Html::elem('html')->addAttributes(array('lang' => $this->page->conf->lang));
        break;
      }

      $html5 = self::isHtml5();

//TODO wtf?!
      $meta = array(Html::elem('meta', ($html5 ? array('charset' => 'utf-8') : array('http-equiv' => 'Content-Type', 'content' => 'text/html; charset=UTF-8'))),
                    ($html5 ? null : Html::elem('meta', array('http-equiv' => 'Content-Language', 'content' => $this->page->conf->lang))),
                    );

      //generovani uzivatelskych metadat
      foreach ($this->page->meta as $name => $content) {
        $meta[] = Html::elem('meta', array('name' => $name, 'content' => $content));
      }

      $css = array();
      foreach ($this->page->css as $attributes) {
        $css[] = Html::elem('link', $attributes);
      }

      foreach ($this->page->condcss as $if => $attributes) {
        $load = array();
        foreach ($attributes as $attr) {
          $load[] = Html::elem('link', $attr);
        }
        $css[] = Html::note($if)->insert($load);
      }
//FIXME udelat regenerator .htaccess souboru!!!!!!!
      if (!empty($this->page->insert_style)) {
        $css[] = Html::elem('style')->type('text/css')
                                    ->media('screen')
                                    ->setText($this->page->insert_style);
      }

      $title = Html::elem('title')->setText($this->page->title);

//FIXME brutalne predelat, je to neefektivni!!! a hnusne!!!!!

      $favicon = array();
      if (!empty($this->page->conf->favicon)) {
        $enabled = $this->page->conf->favicon['enabled'];
        $this->page->conf->favicon['enabled'] = NULL;
        $favicon = Html::elem('link', $this->page->conf->favicon);
        if (!$enabled) {
          $favicon = Html::note()->insert($favicon)->clearBreak();
        }
      }

      $js = array();
      //JS loaders
      foreach ($this->page->javascript as $attributes) {
        $js[] = Html::elem('script', $attributes);
      }

      //JS cond loader
      foreach ($this->page->condjs as $if => $attributes) {
        $load = array();
        foreach ($attributes as $attr) {
          $load[] = Html::elem('script', $attr);
        }
        $js[] = Html::note($if)->insert($load);
      }

      //textove JS funcntions - slucuje do jednoho scriptu
      $jstext = array();
      if (!empty($this->page->js)) {
        foreach ($this->page->js as $script) {
          $jstext[] = $script;
        }
        $js[] = Html::elem('script')->type('text/javascript')
                                    ->setText($jstext);
      }

      //JS funcntions
      $endjs = array();
      foreach ($this->page->endjs as $script) {
        $endjs[] = Html::elem('script')->type('text/javascript')
                                        ->setText($script);
      }

      $head = Html::elem('head')
                  ->insert($meta)
                  ->insert($css)
                  ->insert($title)
                  ->insert($favicon)
                  ->insert($js)
                  ;

      $body = Html::elem('body', $this->page->bodyattr)
                  ->insertContent($this->page->body)
                  ->insert($endjs);

      //$html5 = ($this->page->conf->doctype == self::DOCTYPE_HTML5);


      $html->insert($head)
           ->insert($body);

      $result[] = $html;

      $result = implode('', $result);

//var_dump($result);

      //$this->cachePage($result);  //TODO jinak, jinde!

      return $result;
    }
  }

  class ExceptionHtmlPage extends Exception {}

?>
