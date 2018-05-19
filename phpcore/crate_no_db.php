<?php
/*
 * crate.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 * prepravka pro instance
 */

  /**
   * prepravka instanci
   *
   * @package unstable
   * @author geniv
   * @version 1.04
   */
    final class Crate extends classes\ObjectArray implements classes\ICron {

        /**
         * defaultni konstruktor
         *
         * @since 1.00
         * @param array pole vstupni pole
         */
        public function __construct($pole) {
            parent::__construct($pole);

            // nacitani hlavni konfigurace *******************************************
            $this->configure = classes\Configurator::decode('global_config.php');
            $this->crate = $this;

            // nacitani kofigurace z db konfigurace **********************************
            classes\ErrorLoger::setEmail('geniv.radek@gmail.com');
            classes\ErrorLoger::setPrintStdOut(false);
            classes\ErrorLoger::setInstantlySend(true);

            // nastavovani weburl do crate *******************************************
            $this->weburl = classes\Core::getUrl();

            // nastaveni time zony ***************************************************
            classes\DateAndTime::setDateTimezone($this->configure['date_timezone']);

            // router model **********************************************************
            $this->lang_url = 'lang';
            $model = array(
              'page',
            );

            // menu ******************************************************************
            $this->menu = classes\Menu::simple($this->configure['menu'], $model, 'home');
            $this->uri = array_filter($this->menu->getUri());

            // tpl *******************************************************************
            $this->tpl = new classes\Tpl($this->configure['tpl']);
            $this->main_index_tpl = 'index';    // prvni stranka

            // mazani automaticky vygenerovaneho obsahu ******************************
            if ($this->configure['system']['clearall']) {
              $this->tpl->clearAll();
            }
        }

        /**
         * synchronizacni metoda
         *
         * @since 1.60
         * @param array args pole konfigurace predavane z cronu
         * @return int pocet provedenych zmen
         */
        public static function synchronizeCron($args = array()) {


            $poc = 0;
            // synchronizace pro slideshows
            //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/slideshow/', 'ignore' => array('no-slideshow-img.png'), 'db' => $db->query('slideshows', 'path')->getAllRows()));

            // synchronizace pro users
            //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/avatars/', 'ignore' => array('no-profile-img.png'), 'db' => $db->query('users', 'avatar', 'avatar IS NOT NULL')->getAllRows()));

            // synchronizace pro downloads
            //~ $download_pictures = $db->query('downloads', 'picture')->getAllRows();
            //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/download/mini/', 'db' => $download_pictures)); // mini
            //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'img/download/full/', 'db' => $download_pictures)); // full

            // cisteni neslinkovanych cdp souboru
            //~ $poc += $db->execSQL('DELETE _tc FROM trainz_cdp _tc
                                //~ LEFT JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                //~ WHERE iddownload IS NULL');

            // synchronizace pro trainz_cdp
            //~ $poc += classes\DbDirComparator::synchronizeCron(array('dir' => 'files/', 'db' => $db->query('trainz_cdp', 'path')->getAllRows()));

            // cisteni lastloginu (dny)
            //~ $poc += $db->delete('lastlogins', 'added <= (CURDATE() - INTERVAL '.$global_configure['expire']['lastlogins'].' DAY)', array());

            // cisteni archivu (dny)
            //~ $poc += $db->delete('notifications', 'deleted <= (CURDATE() - INTERVAL '.$global_configure['expire']['notifications'].' DAY)', array());

            return $poc;
        }

        /**
         * ajaxova rest metoda
         *
         * @since 1.82
         * @param void
         * @return string navratovy text
         */
        public static function getAjax() {
          $weburl = classes\Core::getUrl();

          switch (isset($_POST['type']) ? $_POST['type'] : null) {
            default:
              return 'vubec nic...';
          }
        }

        // manipulacni metody ******************************************************
    }