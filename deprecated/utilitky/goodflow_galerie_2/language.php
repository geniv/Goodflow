<?php
/*
 *      language.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  //vzor singleton
  final class Language {
    protected static $instance = NULL;

    const GETTEXT_CODESET = 'UTF-8';
    const GETTEXT_DOMAIN = 'messages';
    const GETTEXT_DIR = 'language';
    const DEFAULT_LANG = 'en';

    public static function getInstance() {
      if (self::$instance == NULL) {
        $c = __CLASS__;
        self::$instance = new $c;
      }
      return self::$instance;
    }

//TODO defaultni pole jazyku
//array('cs' => 'cs_CZ',)
    //nl_NL, de_DE, ru_RU, hu_HU, es_ES, fr_FR...
    public function loadListLanguage(array $list) {
      try {

        if (!empty($list)) {
          self::$instance->list_language = $list;
        } else {
          throw new ExceptionLanguage;
        }

      } catch (ExceptionLanguage $e) {
        echo 'Byl předán prázdný language list!';
      }
    }

    public function getLanguage() {
      return self::$instance->language;
    }

    public function setLanguage($lang) {
      try {
//TODO asi osetrovat jen v pripade jineho datoveho formatu
        if (!empty($lang)) {
          self::$instance->language = $lang;
        } else {
          self::$instance->language = self::DEFAULT_LANG;
          //throw new ExceptionLanguage;
        }

      } catch (ExceptionLanguage $e) {
        //echo 'snažíte se nastavit prázdný jazyk!';
      }
    }

    public function loadGettext() {
      try {

        if (self::DEFAULT_LANG != self::$instance->language)
        {
          $codeset = self::$instance->list_language[self::$instance->language].'.'.self::GETTEXT_CODESET; //cs_CZ.UTF-8
          $domain = self::GETTEXT_DOMAIN;
          $lang_dir = self::GETTEXT_DIR;

          $po_file = sprintf("%s/%s/LC_MESSAGES/%s.po", $lang_dir, self::$instance->language, $domain);
          $mo_file = sprintf("%s/%s/LC_MESSAGES/%s.mo", $lang_dir, self::$instance->language, $domain);

          if (file_exists($po_file) && file_exists($mo_file)) {
            bind_textdomain_codeset($domain, self::GETTEXT_CODESET);
            setlocale(LC_MESSAGES, $codeset);
            bindtextdomain($domain, $lang_dir);
            textdomain($domain);
          } else {
            if (!file_exists($po_file)) {
              throw new ExceptionLanguage($po_file);
            }
            if (!file_exists($mo_file)) {
              throw new ExceptionLanguage($mo_file);
            }
          }
        }

      } catch (ExceptionLanguage $e) {
        echo sprintf('Jazykový soubor %s neexistuje!', $e->getMessage());
      }
    }

//ovladaci panel pro jazyky (bud tu pres ten select a nebo odkazy)
    public function controlPanel($values) {

      $fr = new Form;
      $fr->addSelect('language', array('values' => $values));
      $fr->addSubmit('language_button', array('value' => _('change language')));

      if ($fr->isSubmitted()) {
        //var_dump($_POST);
        //var_dump($fr->language);
        var_dump($fr->getValues());
        //print_r($_POST);
        //Core::setCookie('lang', $fr->language);
        //atd...

        //FIXME dodelat akceptaci jazyku, pripadne metodu na auto nacitani pro dalsi praci
        //kontrola odeslani, po odeslani ulozit do cookie... atd.. redirekt.. a konec
      }

      //echo $frm->getException();

      return $fr;
    }
  }

  class ExceptionLanguage extends Exception {}

?>
