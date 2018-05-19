<?php
/*
 *      language.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use Exception;

  //vzor singleton
  final class Language implements Singleton {
    const VERSION = '1.4';
    private static $instance = NULL;

    const GETTEXT_CODESET = 'UTF-8';
    const GETTEXT_DOMAIN = 'messages';
    const GETTEXT_DIR = 'language';
    const DEFAULT_LANG = 'en';

    private function __construct() {
      try {

        //nemuze se vytvaret kdyz neni dostupny dotycny modul
        if (!extension_loaded('gettext')) {
          throw new ExceptionLanguage('Missing Apache extension Gettext!');
        }

        //odkazovani na vlastni objekt
        $this->default_lang = self::DEFAULT_LANG;
        $this->gettext_dir = self::GETTEXT_DIR;
        $this->gettext_domain = self::GETTEXT_DOMAIN;
        $this->gettext_codeset = self::GETTEXT_CODESET;

      } catch (ExceptionLanguage $e) {
        echo $e;
        exit(1);
      }
    }

    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
      if (is_null(self::$instance)) {
        self::$instance = new self;
      }
      return self::$instance;
    }

    //nl_NL, de_DE, ru_RU, hu_HU, es_ES, fr_FR...
    //array('cs' => 'cs_CZ', 'en' => 'en_EN', 'de' => 'de_DE', 'fr' => 'fr_FR',)
    public function loadListLanguage(array $list) {
      try {

        if (!empty($list)) {
          self::$instance->list_language = $list;
        } else {
          throw new ExceptionLanguage('$list cannot be empty!');
        }

      } catch (ExceptionLanguage $e) {
        echo $e;
      }
    }

    public function getLanguage() {
      return self::$instance->language;
    }

    public function setLanguage($lang) {
      try {

        if (!empty($lang)) {
          if (is_string($lang)) {
            self::$instance->language = $lang;
          } else {
            throw new ExceptionLanguage(sprintf('Value "%s" is not valid!', $lang));
          }
        } else {
          self::$instance->language = (!empty(self::$instance->default_lang) ? self::$instance->default_lang : self::DEFAULT_LANG);
        }

      } catch (ExceptionLanguage $e) {
        echo $e;
      }
    }

    public function getDefaultLanguage() {
      return self::$instance->default_lang;
    }

    public function setDefaultLanguage($lang) {
      if (!empty($lang)) {
        self::$instance->default_lang = $lang;
      }
    }

    public function getLanguageDir() {
      return self::$instance->gettext_dir;
    }

    public function setLanguageDir($dir) {
      if (!empty($dir)) {
        self::$instance->gettext_dir = $dir;
      }
    }

    public function getLanguageDomain() {
      return self::$instance->gettext_domain;
    }

    public function setLanguageDomain($domain) {
      if (!empty($domain)) {
        self::$instance->gettext_domain = $domain;
      }
    }

    public function getCodeset() {
      return self::$instance->gettext_codeset;
    }

    public function setCodeset($codeset) {
      if (!empty($codeset)) {
        self::$instance->gettext_codeset = $codeset;
      }
    }

    public function loadGettext($path = NULL) {
      try {

        $result = array('default_lang' => self::$instance->default_lang,
                        'language' => self::$instance->language,
                        'path' => $path,
                        'list_language' => self::$instance->list_language);
        if (self::$instance->default_lang != self::$instance->language) {
          $codeset = self::$instance->gettext_codeset;
          $full_codeset = sprintf('%s.%s', self::$instance->list_language[self::$instance->language], $codeset);  //cs_CZ.UTF-8
          $domain = self::$instance->gettext_domain;
          $lang_dir = self::$instance->gettext_dir;

          $po_file = sprintf('%s%s/%s/LC_MESSAGES/%s.po', $path, $lang_dir, self::$instance->language, $domain);
          $mo_file = sprintf('%s%s/%s/LC_MESSAGES/%s.mo', $path, $lang_dir, self::$instance->language, $domain);

          $result['po_file'] = $po_file;
          $result['mo_file'] = $mo_file;

          if (file_exists($po_file) && file_exists($mo_file)) {
            //putenv('LC_MESSAGES=xx_XX');
            $result['bind_textdomain_codeset'] = bind_textdomain_codeset($domain, $codeset);
            $result['setlocale'] = setlocale(LC_MESSAGES, $full_codeset); //LC_X, cs_CZ.UTF-8
            $result['bindtextdomain'] = bindtextdomain($domain, sprintf('%s%s', $path, $lang_dir)); //bacha na umisteni!!!
            $result['textdomain'] = textdomain($domain);
          } else {
            if (!file_exists($po_file)) {
              throw new ExceptionLanguage(sprintf('Language file "%s" does not exist', $po_file));
            }
            if (!file_exists($mo_file)) {
              throw new ExceptionLanguage(sprintf('Language file "%s" does not exist', $mo_file));
            }
          }
        }

      } catch (ExceptionLanguage $e) {
        echo $e;
      }

      return $result;
    }

//ovladaci panel pro jazyky (bud tu pres ten select a nebo odkazy)
    public function controlPanel($values) {

      //$fr = new Form;
      //$fr->addSelect('language', array('values' => $values));
      //$fr->addSubmit('language_button', array('value' => _('change language')));

/*
      if ($fr->isSubmitted()) {
        //var_dump($_POST);
        //var_dump($fr->language);
        var_dump($fr->getValues());
        //print_r($_POST);
        //Core::setCookie('lang', $fr->language);
        //atd...

        //!!!!!!!! dodelat akceptaci jazyku, pripadne metodu na auto nacitani pro dalsi praci
        //kontrola odeslani, po odeslani ulozit do cookie... atd.. redirekt.. a konec
      }
*/

      //echo $frm->getException();

      return $fr;
    }
  }

  class ExceptionLanguage extends Exception {}

?>
