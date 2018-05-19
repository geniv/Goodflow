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
 */

  namespace classes;

  /**
   * trida primarne urcena pro prekladani statickych stranek
   *
   * @package stable
   * @author geniv
   * @version 2.62
   */
  final class Language {

    private static $instance = null;

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
     * defaultni vnitrni konstruktor
     *
     * @since 1.00
     * @param void
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
      $this->language = null;
      $this->auto_create = false;
      $this->status = array('change' => false);
    }

    private function __clone() {} //blokovani vyvroteni instanci ostatnim zpusobem
    private function __wakeup() {}

    /**
     * hlavni staticka metoda pro vraceni instnace tridy
     *
     * @since 1.00
     * @param void
     * @return this tridy
     */
    public static function getInstance() {
      if (!self::$instance) {
        self::$instance = new self;
      }
      return self::$instance;
    }

    /**
     * nacitani statusu
     *
     * @since 1.00
     * @param void
     * @return array status tridy v poli
     */
    public static function getState() {
      return self::$instance->status;
    }

    /**
     * nacitani pole jazykonych mutaci
     *
     * @since 1.00
     * @param void
     * @return array pole language mutaci
     */
    public function getListLanguage() {
      return $this->list_language;
    }

    /**
     * eventualni nacteni language listu
     * - (pokud se nezada pouzije se defaultni pole)
     * - 'code' => array('iso code', 'name language')
     * - 'cs' => array('cs_CZ', 'Czech'), 'en' => array('en_EN', 'English'), ...
     *
     * @since 1.00
     * @param array list pole jazykovych mutaci
     * @return this
     */
    public function setListLanguage(array $list) {
      if ($list) {
        $this->list_language = $list;
      } else {
        throw new ExceptionLanguage('$list cannot be empty!');
      }
      return $this;
    }

    /**
     * vraci pole language kodu
     * - (cs_CZ, en_EN)
     *
     * @since 1.00
     * @param void
     * @return array pole lang kodu
     */
    public function getLanguageCodes() {
      return array_map(function($row) {
          return $row[0];
        }, $this->list_language);
    }

    /**
     * vraci pole language nazvu
     * - (Czech, English)
     *
     * @since 1.00
     * @param void
     * @return array pole lang nazvu
     */
    public function getLanguageNames() {
      return array_map(function($row) {
          return $row[1];
        }, $this->list_language);
    }

    /**
     * vraceni aktualniho jazyka
     *
     * @since 1.00
     * @param void
     * @return string aktualni jazyk
     */
    public function getLanguage() {
      return $this->language;
    }

    /**
     * nastaveni aktualniho jazyka
     * - (na jaky jazyk se bude aktualne prekladat)
     *
     * @since 1.00
     * @param string lang novy aktualni jazyk
     * @return this
     */
    public function setLanguage($lang) {
      if ($lang) {
        if (is_string($lang)) {
          //pokud je zadavyny jazyk v poli jazyku
          if (array_key_exists($lang, $this->list_language)) {
            $this->language = $lang;
          } else {
            throw new ExceptionLanguage('Language "'.$lang.'" abbreviation is not available in the array of languages!');
          }
        } else {
          throw new ExceptionLanguage('Value "'.$lang.'" is not valid!');
        }
      } else {
        $this->language = (!empty($this->default_lang) ? $this->default_lang : self::DEFAULT_LANG);
      }
      return $this;
    }

    /**
     * nacteni vychoziho jazyku
     *
     * @since 1.00
     * @param void
     * @return string jazyk
     */
    public function getDefaultLanguage() {
      return $this->default_lang;
    }

    /**
     * nastaveni vychoziho jazyka
     * - (na defaultni jazyk se neaplikuji preklady, vychozi jazkyk webu)
     *
     * @since 1.00
     * @param string lang novy vychozi jazyk
     * @return this
     */
    public function setDefaultLanguage($lang) {
      if ($lang) {
        $this->default_lang = $lang;
      }
      return $this;
    }

    /**
     * vrati slozku jazyku
     *
     * @since 1.00
     * @param void
     * @return string slozka
     */
    public function getLanguageDir() {
      return $this->gettext_dir;
    }

    /**
     * nastavi slozku jazyku
     *
     * @since 1.00
     * @param string dir nova slozka jazyku
     * @return this
     */
    public function setLanguageDir($dir) {
      if ($dir) {
        $this->gettext_dir = $dir;
      }
      return $this;
    }

    /**
     * vrati slozku jazykove domeny
     *
     * @since 1.00
     * @param void
     * @return string slozka
     */
    public function getLanguageDomain() {
      return $this->gettext_domain;
    }

    /**
     * nastavi slozku jazykove domeny
     *
     * @since 1.00
     * @param string domain nova slozka domeny
     * @return this
     */
    public function setLanguageDomain($domain) {
      if ($domain) {
        $this->gettext_domain = $domain;
      }
      return $this;
    }

    /**
     * vrati jazykove kodovani
     *
     * @since 1.00
     * @param void
     * @return string kodovani
     */
    public function getCodeset() {
      return $this->gettext_codeset;
    }

    /**
     * nastavi jazyk kodovani
     *
     * @since 1.00
     * @param string codeset nove jazykove kodovani
     * @return this
     */
    public function setCodeset($codeset) {
      if ($codeset) {
        $this->gettext_codeset = $codeset;
      }
      return $this;
    }

    /**
     * detekuje jeslti je aktuani jazyk jiny nez defaultni
     * - (tj detekuje se jestli se ma prekladat)
     *
     * @since 1.00
     * @param void
     * @return bool true pokud jsou jazyky ruzne
     */
    public function isChanged() {
      return (isset($this->language) && $this->default_lang != $this->language);  //$this->status['change'];
    }

    /**
     * nacteni stavu automatickeho vytvareni
     *
     * @since 1.00
     * @param void
     * @return bool true pokud je povolene
     */
    public function getAutoCreate() {
      return $this->auto_create;
    }

    /**
     * nastaveni stavu automatickeho vytvareni
     *
     * @since 1.00
     * @param bool state true pro zapnuti auto vytvareni
     * @return this
     */
    public function setAutoCreate($state) {
      $this->auto_create = $state;
      return $this;
    }

    /**
     * vnitrni funkce na vytvareni prekladovych slozek/souboru
     *
     * @since 1.00
     * @param void
     * @return void
     */
    private function autoCreate() {
      $po = $this->status['po_file'];
      $dir = dirname($po);
      if (!file_exists($dir)) {
        mkdir($dir, 0777, true);  //vytvoreni adresarove struktury
        chmod($dir, 0777);
      }

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
          @chmod($po, 0777);
        }
      }
    }

    /**
     * inicializace jazykove knihovny
     *
     * @since 1.00
     * @param string path nova cesta pro umisteni jazykovych prekladu
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
            throw new ExceptionLanguage('The server is missing for the language version ( $ locale -a ): "'.$full_lang_code.'"!');
          }
          $this->status['bindtextdomain'] = bindtextdomain($this->gettext_domain, sprintf('%s%s', $path, $this->gettext_dir)); //bacha na umisteni!!!
          $this->status['textdomain'] = textdomain($this->gettext_domain);
        } else {
          if ($this->auto_create) {
            $this->autoCreate();
          } else
          if (!file_exists($po_file)) {
            throw new ExceptionLanguage('Language file "'.$po_file.'" does not exist');
          } else
          if (!file_exists($mo_file)) {
            throw new ExceptionLanguage('Language file "'.$mo_file.'" does not generated');
          }
        }
      } else {
        $this->status['change'] = false;
      }
      return $this;
    }
  }



  /**
   * trida vyjimky pro Language
   *
   * @package stable
   * @author geniv
   * @version 1.00
   */
  class ExceptionLanguage extends \Exception {}