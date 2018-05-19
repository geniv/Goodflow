<?php
/*
 *      htmlpage.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception;

  class HtmlPage extends Html {
    const VERSION = '1.3';
    const DOCTYPE_STRICT = 'strict';
    const DOCTYPE_HTML5 = 'html5';

    const MEDIA_SCREEN = 'screen';
    const MEDIA_PRINT = 'print';
    const MEDIA_ALL = 'all';

    private $conf, $meta, $css, $condcss, $title, $javascript, $js, $body;// $last;

    public function __construct($doctype) {
      $this->conf = new stdClass;
      $this->conf->titlesep = ' - ';
      $this->meta = array();
      $this->css = array();
      $this->condcss = array();
      $this->title = NULL;
      $this->javascript = array();
      $this->js = array();
      $this->body = array();
      //$this->last = NULL;
      $this->setDoctype($doctype);
    }

    public function setDoctype($doctype) {
      $this->conf->doctype = $doctype;
      return $this;
    }

    public function setLanguage($lang) {
      $this->conf->lang = $lang;
      return $this;
    }

    public function addMeta($name, $content) {
      $this->meta[$name] = $content;
      return $this;
    }

/* jinac vyjadreny!!
    //public function setStyleSheet() {
      //
      return $this;
    }

    //public function setJavaScript() {
      //
      return $this;
    }
*/

    public function loadCSS($href, array $settings = array()) {
      $settings['rel'] = Core::isFill($settings, 'rel', 'stylesheet');
      $settings['type'] = Core::isFill($settings, 'type', 'text/css');
      $settings['media'] = Core::isFill($settings, 'media', self::MEDIA_SCREEN);
      $settings['title'] = Core::isFill($settings, 'title', NULL);
      $settings['href'] = $href;
      $this->css[] = $settings;
      return $this;
    }

    public function loadConditionalCSS($href, $if, array $settings = array()) {
      $settings['rel'] = Core::isFill($settings, 'rel', 'stylesheet');
      $settings['type'] = Core::isFill($settings, 'type', 'text/css');
      $settings['media'] = Core::isFill($settings, 'media', self::MEDIA_SCREEN);
      $settings['title'] = Core::isFill($settings, 'title', NULL);
      $settings['href'] = $href;
      $settings['if'] = $if;
      $this->condcss[] = $settings;
      return $this;
    }

//conditional comment
    public function loadJavaScript($src, array $settings = array()) {
      $settings['type'] = Core::isFill($settings, 'type', 'text/javascript');
      $settings['charset'] = Core::isFill($settings, 'charset', NULL);
      $settings['src'] = $src;
      $this->javascript[] = $settings;
      return $this;
    }

    public function setTitleSeparator($separ) {
      $this->conf->titlesep = $separ;
      return $this;
    }

    public function setTitle($title) {
      if (is_array($title)) {
        $this->title = Core::implodeTitle($title, $this->conf->titlesep);
      } else {
        $this->title = $title;
      }
      return $this;
    }

    public function setFavicon($href, array $settings = array()) {
      $settings['type'] = Core::isFill($settings, 'type', NULL);
      $settings['rel'] = Core::isFill($settings, 'rel', 'shortcut icon');
      $settings['enabled'] = Core::isNull($settings, 'enabled', true);
      $settings['href'] = $href;
      $this->conf->favicon = $settings;
      return $this;
    }

    public function addJavaScript($script) {
      if ($script instanceof JavaScript) {
        $this->js[] = $script;
      }
      return $this;
    }

    public function addBody($html) {
      $this->body[] = $html;
      return $this;
    }

    public function __toString() {
      return $this->render();
    }

    public function render() {
      $result = array();

      switch ($this->conf->doctype) {
        case self::DOCTYPE_STRICT:
          $result[] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'.PHP_EOL;
        break;

        case self::DOCTYPE_HTML5:
          $result[] = '<!DOCTYPE html>'.PHP_EOL;
        break;
      }

      $meta = array(self::elem('meta', array('http-equiv' => 'Content-Type', 'content' => 'text/html; charset=UTF-8')),
                    self::elem('meta', array('http-equiv' => 'Content-Language', 'content' => $this->conf->lang)),
                    );

      //generovani uzivatelskych metadat
      foreach ($this->meta as $name => $content) {
        $meta[] = self::elem('meta', array('name' => $name, 'content' => $content));
      }

      $css = array();
      foreach ($this->css as $attributes) {
        $css[] = self::elem('link', $attributes);
      }

      foreach ($this->condcss as $attributes) {
        $if = $attributes['if'];
        $attributes['if'] = NULL;

        $link = self::elem('link', $attributes);
        $note = self::elem('ifnote', array($if))
                    ->setDepth(2)
                    ->insert($link);
        $css[] = $note;
      }

      $title = self::elem('title')->setText($this->title);

      $favicon = array();
      if (!empty($this->conf->favicon)) {
        $enabled = $this->conf->favicon['enabled'];
        $this->conf->favicon['enabled'] = NULL;
        $favicon = self::elem('link', $this->conf->favicon)->setNewLine('');
        if (!$enabled) {
          $favicon = self::elem('note')->setDepth(2)->setText($favicon);
        }
      }

      $js = array();
      //JS loaders
      foreach ($this->javascript as $attributes) {
        $js[] = self::elem('script', $attributes)->setText(NULL);
      }

      //JS funcntions
      foreach ($this->js as $script) {
        //TODO doresit vice nasobne skadani skriptu do sebe!!
        $js[] = self::elem('script')
                    ->type('text/javascript')
                    ->setText($script)
                    ;
      }

      $head = self::elem('head')
                  ->setDepth(1)
                  ->insert($meta)
                  ->insert($css)
                  ->insert($title)
                  ->insert($favicon)
                  ->insert($js)
                  ;

      $body = self::elem('body')
                  ->insert($this->body);

      //$html5 = ($this->conf->doctype == self::DOCTYPE_HTML5);

      $html = self::elem('html')
                  ->addAttributes(array('xmlns' => 'http://www.w3.org/1999/xhtml',
                                        'xml:lang' => $this->conf->lang,
                                        'lang' => $this->conf->lang))
                  ->insert($head)
                  ->insert($body)
                  ;

      $result[] = $html;

      $result = implode('', $result);

      return $result;
    }
  }

  class ExceptionHtmlPage extends Exception {}

?>
