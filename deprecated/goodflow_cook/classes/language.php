<?php
/*
 * language.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 * source:
 * $ locale -a
 * http://www.gfdesign.cz/gettext.txt
 * http://www.gnu.org/software/gettext/manual/html_mono/gettext.html#Usual-Language-Codes
 * http://www.gnu.org/software/gettext/manual/html_mono/gettext.html#Country-Codes
 * https://flattr.com/support/integrate/languages
 * -singleton-
 *
 * manual: http://php.net/manual/en/ref.gettext.php
 *
 * singular:
 * _() / gettext()
 * plural:
 * printf(ngettext("%d window", "%d windows", 2), 2); // 2 okna
 *
 * cs plural:
 * nplurals=3; plural=(n==1) ? 0 : (n>=2 && n<=4) ? 1 : 2;
 *
 * en plural:
 * nplurals=2; plural=(n==1) ? 0 : 1;
 * nplurals=2; plural=(n != 1) ? 1 : 0;
 * nplurals=2; plural=(n != 1);
 *
 * trida je primarne urcena pro prekladani statickych stranek!
 */

  namespace classes;

  use classes\Core,
      Exception;

  final class Language {
    const VERSION = 2.56;
    private static $instance = NULL;

    const GETTEXT_CODESET = 'UTF-8';
    const GETTEXT_DOMAIN = 'messages';
    const GETTEXT_DIR = 'language';
    const DEFAULT_LANG = 'en';

    private $languagelist = array('sq' => array('sq_AL', 'Albanian'),
                                  'ar' => array('ar_DZ', 'Arabic'),
                                  'be' => array('be_BY', 'Belarusian'),
                                  'bg' => array('bg_BG', 'Bulgarian'),
                                  'ca' => array('ca_ES', 'Catalan'),
                                  'zh' => array('zh_CN', 'Chinese'),
                                  'hr' => array('hr_HR', 'Croatian'),
                                  'cs' => array('cs_CZ', 'Czech'),
                                  'da' => array('da_DK', 'Danish'),
                                  'nl' => array('nl_NL', 'Dutch'),
                                  //'en' => array('en_EN', 'English'),
                                  //'en' => array('en_GB', 'GB English'),//.utf8
                                  'en' => array('en_US', 'US English'),//.utf8
                                  'eo' => array('eo_EO', 'Esperanto'),
                                  'et' => array('et_EE', 'Estonian'),
                                  'fi' => array('fi_FI', 'Finnish'),
                                  'fr' => array('fr_FR', 'French'),
                                  'gl' => array('es_GL', 'Galician'),
                                  'de' => array('de_DE', 'German'),
                                  'el' => array('el_GR', 'Greek'),
                                  'he' => array('iw_IL', 'Hebrew'),
                                  'hi' => array('hi_IN', 'Hindi'),
                                  'hu' => array('hu_HU', 'Hungarian'),
                                  'is' => array('is_IS', 'Icelandic'),
                                  'id' => array('in_ID', 'Indonesian'),
                                  'ga' => array('ga_IE', 'Irish'),
                                  'it' => array('it_IT', 'Italian'),
                                  'ja' => array('ja_JP', 'Japanese'),
                                  'ko' => array('ko_KR', 'Korean'),
                                  'lv' => array('lv_LV', 'Latvian'),
                                  'lt' => array('lt_LT', 'Lithuanian'),
                                  'mk' => array('mk_MK', 'Macedonian'),
                                  'ms' => array('ms_MY', 'Malay'),
                                  'mt' => array('mt_MT', 'Maltese'),
                                  'no' => array('no_NO', 'Norwegian'),
                                  'nn' => array('nn_NO', 'Nynorsk'),
                                  'fa' => array('fa_FA', 'Persian'),
                                  'pl' => array('pl_PL', 'Polish'),
                                  'pt' => array('pt_PT', 'Portuguese'),
                                  'ro' => array('ro_RO', 'Romanian'),
                                  'ru' => array('ru_RU', 'Russian'),
                                  'sr' => array('sr_RS', 'Serbian'),
                                  'sk' => array('sk_SK', 'Slovak'),
                                  'sl' => array('sl_SI', 'Slovenian'),
                                  'es' => array('es_ES', 'Spanish'),
                                  'sv' => array('sv_SE', 'Swedish'),
                                  'th' => array('th_TH', 'Thai'),
                                  'tr' => array('tr_TR', 'Turkish'),
                                  'uk' => array('uk_UA', 'Ukrainian'),
                                  'vi' => array('vi_VN', 'Vietnamese'),
                                  );

    /**
     * hlavni vnitrni konstruktor
     */
    private function __construct() {
      //nemuze se vytvaret kdyz neni dostupny dotycny modul
      if (!extension_loaded('gettext')) {
        throw new ExceptionLanguage('Missing Apache extension Gettext!');
      }

      //odkazovani na vlastni objekt
      $this->default_lang = self::DEFAULT_LANG;
      $this->gettext_dir = self::GETTEXT_DIR;
      $this->gettext_domain = self::GETTEXT_DOMAIN;
      $this->gettext_codeset = self::GETTEXT_CODESET;
      $this->list_language = $this->languagelist;
      $this->language = NULL;
      $this->auto_create = false;
      $this->status = array('change' => false);
    }

    private function __clone() {} //blokovani vyvroteni instanci ostatnim zpusobem
    private function __wakeup() {}

    /**
     * hlavni staticka metoda pro vraceni instnace tridy
     *
     * @return this tridy
     */
    public static function getInstance() {
      if (is_null(self::$instance)) {
        self::$instance = new self;
      }
      return self::$instance;
    }

    /**
     * nacitani statusu
     *
     * @param
     * @return status tridy v poli
     */
    public static function getState() {
      return self::$instance->status;
    }

    /**
     * nacitani pole jazykonych mutaci
     *
     * @return pole language mutaci
     */
    public function getListLanguage() {
      return $this->list_language;
    }

    /**
     * eventualni nacteni language listu
     * (pokud se nezada pouzije se defaultni pole)
     * 'code' => array('iso code', 'name language')
     * 'cs' => array('cs_CZ', 'Czech'), 'en' => array('en_EN', 'English'), ...
     *
     * @param list pole jazykovych mutaci
     * @return this
     */
    public function setListLanguage(array $list) {
      if (!empty($list)) {
        $this->list_language = $list;
      } else {
        throw new ExceptionLanguage('$list cannot be empty!');
      }
      return $this;
    }

    /**
     * vraci pole language kodu
     * (cs_CZ, en_EN)
     *
     * @return pole lang kodu
     */
    public function getLanguageCodes() {
      return array_map(function($row) { return $row[0]; }, $this->list_language);
    }

    /**
     * vraci pole language nazvu
     * (Czech, English)
     *
     * @return pole lang nazvu
     */
    public function getLanguageNames() {
      return array_map(function($row) { return $row[1]; }, $this->list_language);
    }

    /**
     * vraceni aktualniho jazyka
     *
     * @return aktualni jazyk
     */
    public function getLanguage() {
      return $this->language;
    }

    /**
     * nastaveni aktualniho jazyka
     * (na jaky jazyk se bude aktualne prekladat)
     *
     * @param lang novy aktualni jazyk
     * @return this
     */
    public function setLanguage($lang) {
      if (!empty($lang)) {
        if (is_string($lang)) {
          //pokud je zadavyny jazyk v poli jazyku
          if (array_key_exists($lang, $this->list_language)) {
            $this->language = $lang;
          } else {
            throw new ExceptionLanguage(sprintf('Language "%s" abbreviation is not available in the array of languages!', $lang));
          }
        } else {
          throw new ExceptionLanguage(sprintf('Value "%s" is not valid!', $lang));
        }
      } else {
        $this->language = (!empty($this->default_lang) ? $this->default_lang : self::DEFAULT_LANG);
      }
      return $this;
    }

    /**
     * nacteni vychoziho jazyku
     *
     * @return jazyk
     */
    public function getDefaultLanguage() {
      return $this->default_lang;
    }

    /**
     * nastaveni vychoziho jazyka
     * (na defaultni jazyk se neaplikuji preklady, vychozi jazkyk webu)
     *
     * @param lang novy vychozi jazyk
     * @return this
     */
    public function setDefaultLanguage($lang) {
      if (!empty($lang)) {
        $this->default_lang = $lang;
      }
      return $this;
    }

    /**
     * vrati slozku jazyku
     *
     * @return slozka
     */
    public function getLanguageDir() {
      return $this->gettext_dir;
    }

    /**
     * nastavi slozku jazyku
     *
     * @param dir nova slozka jazyku
     * @return this
     */
    public function setLanguageDir($dir) {
      if (!empty($dir)) {
        $this->gettext_dir = $dir;
      }
      return $this;
    }

    /**
     * vrati slozku jazykove domeny
     *
     * @return slozka
     */
    public function getLanguageDomain() {
      return $this->gettext_domain;
    }

    /**
     * nastavi slozku jazykove domeny
     *
     * @param domain nova slozka domeny
     * @return this
     */
    public function setLanguageDomain($domain) {
      if (!empty($domain)) {
        $this->gettext_domain = $domain;
      }
      return $this;
    }

    /**
     * vrati jazykove kodovani
     *
     * @return kodovani
     */
    public function getCodeset() {
      return $this->gettext_codeset;
    }

    /**
     * nastavi jazyk kodovani
     *
     * @param codeset nove jazykove kodovani
     * @return this
     */
    public function setCodeset($codeset) {
      if (!empty($codeset)) {
        $this->gettext_codeset = $codeset;
      }
      return $this;
    }

    /**
     * detekuje jeslti je aktuani jazyk jiny nez defaultni
     * (tj detekuje se jestli se ma prekladat)
     *
     * @return true pokud jsou jazyky ruzne
     */
    public function isChanged() {
      return (isset($this->language) && $this->default_lang != $this->language);  //$this->status['change'];
    }

    /**
     * nacteni stavu automatickeho vytvareni
     *
     * @return true pokud je povolene
     */
    public function getAutoCreate() {
      return $this->auto_create;
    }

    /**
     * nastaveni stavu automatickeho vytvareni
     *
     * @param state true pro zapnuti auto vytvareni
     * @return this
     */
    public function setAutoCreate($state) {
      $this->auto_create = $state;
      return $this;
    }

    /**
     * vnitrni funkce na vytvareni prekladovych slozek/souboru
     */
    private function autoCreate() {

      $po = $this->status['po_file'];
      $dir_po = dirname($po);
      Core::generatePath($dir_po);  //vytvoreni adresarove struktury

      if (!file_exists($po)) {  //pokud neexistuje tak je vytvorena prvni hlavicka
        $head = 'msgid ""
msgstr ""
"Project-Id-Version: Project name\n"
"Report-Msgid-Bugs-To: \n"
"POT-Creation-Date: '.date('r').'\n"
"PO-Revision-Date: \n"
"Last-Translator: nick <email@domain.com>\n"
"Language-Team: nick <email@domain.com>\n"
"Language: \n"
"MIME-Version: 1.0\n"
"Content-Type: text/plain; charset=utf-8\n"
"Content-Transfer-Encoding: 8bit\n"
"X-Poedit-Basepath: ../../../\n"
"Plural-Forms: nplurals=3; plural=(n==1) ? 0 : (n>=2 && n<=4) ? 1 : 2;\n"
"X-Poedit-SourceCharset: utf-8\n"
"X-Poedit-SearchPath-0: .\n"';

        if (file_put_contents($po, $head)) {
          @chmod($po, 0646);
        }
      }
    }

    /**
     * inicializace jazykove knihovny
     *
     * @param path nova cesta pro umisteni jazykovych prekladu
     * @return this
     */
    public function initLanguage($path = null) {
      if ($this->isChanged()) {
        $codeset = $this->gettext_codeset;
        $language_code = $this->list_language[$this->language][0];

        $this->status['change'] = true;

        $this->status['default_lang'] = $this->default_lang;
        $this->status['language'] = $this->language;

        $po_file = sprintf('%s%s/%s/LC_MESSAGES/%s.po', $path, $this->gettext_dir, $this->language, $this->gettext_domain);
        $mo_file = sprintf('%s%s/%s/LC_MESSAGES/%s.mo', $path, $this->gettext_dir, $this->language, $this->gettext_domain);

        $this->status['po_file'] = $po_file;
        $this->status['mo_file'] = $mo_file;

        if (file_exists($po_file) && file_exists($mo_file)) {
          //$result['putenv'] = putenv(sprintf('LC_MESSAGES=%s', $language_code));
          $this->status['bind_textdomain_codeset'] = bind_textdomain_codeset($this->gettext_domain, $this->gettext_codeset);
          $full_lang_code = $language_code.'.'.$this->gettext_codeset;  //cs_CZ.UTF-8
          putenv('LC_ALL='.$language_code); //Sets the value of an environment variable
          $this->status['setlocale'] = setlocale(LC_MESSAGES, $full_lang_code);   //LC_X, cs_CZ.UTF-8
          if (!$this->status['setlocale']) {
            throw new ExceptionLanguage(sprintf('The server is missing for the language version ( $ locale -a ): "%s"!', $full_lang_code));
          }
          $this->status['bindtextdomain'] = bindtextdomain($this->gettext_domain, sprintf('%s%s', $path, $this->gettext_dir)); //bacha na umisteni!!!
          $this->status['textdomain'] = textdomain($this->gettext_domain);
        } else {
          if ($this->auto_create) {
            $this->autoCreate();
          } else
          if (!file_exists($po_file)) {
            throw new ExceptionLanguage(sprintf('Language file "%s" does not exist', $po_file));
          } else
          if (!file_exists($mo_file)) {
            throw new ExceptionLanguage(sprintf('Language file "%s" does not generated', $mo_file));
          }
        }
      } else {
        $this->status['change'] = false;
      }
      return $this;
    }
  }

  class ExceptionLanguage extends Exception {}

?>
