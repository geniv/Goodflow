<?php
/*
 * backuper.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * trida starajici se zalohovani do zipu
   *
   * @package stable
   * @author geniv
   * @version 1.72
   */
  class Backuper implements ICron {

    /** format datumu souboru */
    const DEFAULT_DATE_FORMAT = 'Y-m-d_H-i-s';
    /** format nazvu souboru */
    const DEFAULT_FILE_FORMAT = 'backup_%s.zip';
    /** jmeno konfigu */
    const DEFAULT_CONFIG_NAME = '.Backuper_config';
    /** maximalne ponechat dni */
    const DEFAULT_EXPIRE = 7;
    /** maximalni pocet zaloh */
    const DEFAULT_COUNT = 10;

    private $files = array();
    private $destination = null;

    /**
     * nacteni destinace zipu
     *
     * @since 1.62
     * @return string path cesta
     */
    public function getDestination() {
      return $this->destination;
    }

    /**
     * nastaveni destinace zipu
     *
     * @since 1.04
     * @param string path cesta kam se ma archiv balit
     * @return this
     */
    public function setDestination($path) {
      $this->destination = $path;
      return $this;
    }

    /**
     * pridavani souboru nebo pole souboru
     *
     * @since 1.00
     * @param string file soubor nebo pole souboru
     * @return this
     */
    public function addFile($file) {
      if (!is_array($file)) {
        $this->files[] = $file;
      } else {
        $this->files = array_merge($this->files, $file);  //FIXME spatne
      }
      return $this;
    }

    /**
     * nacteni seznamu souboru
     *
     * @since 1.10
     * @return array pole souboru
     */
    public function getFiles() {
      return $this->files;
    }

    /**
     * nastaveni souboru najednou
     *
     * @since 1.08
     * @param string files pole souboru pro prime nastaveni
     * @return this
     */
    public function setFiles($files) {
      $this->files = $files;
      return $this;
    }

    /**
     * nacteni pole souboru z cache
     *
     * @since 1.00
     * @param string path cesta a jmeno configu
     * @return this
     */
    public function load($path = null) {
      // pokud je jednoducha konfigurace json-u je mozne brat ji rovnou z objektu
      $decode = json_decode(file_get_contents($path ?: self::DEFAULT_CONFIG_NAME));
      $this->destination = $decode->destination;
      $this->files = $decode->files;
      return $this;
    }

    /**
     * ulozeni pole souboru do cache
     *
     * @since 1.00
     * @param string path cesta a jmeno configu
     * @return this
     */
    public function save($path = null) {
      $encode = array(
                      'destination' => $this->destination,
                      'files' => $this->files,
                      );
      file_put_contents($path ?: self::DEFAULT_CONFIG_NAME, json_encode($encode));
      return $this;
    }

    /**
     * metoda pro spousteni cronem
     *
     * @since 1.00
     * @param array (jinak pole konfigurace predavana z kofigurace cronu)
     * @return int pocet zpracovanych polozek
     */
    public static function synchronizeCron($args = array()) {
      $conf = array(
                      'path' => null, // path konfiguracniho souboru
                      'file_format' => self::DEFAULT_FILE_FORMAT, // format nazvu souboru
                      'date_format' => self::DEFAULT_DATE_FORMAT,
                      'clean_expire' => self::DEFAULT_EXPIRE,
                      'clean_count' => self::DEFAULT_COUNT,
                    );
      $conf = array_merge($conf, $args);  // secteni konfigurace
      $poc = 0;
      $path = ($conf['path'] ?: self::DEFAULT_CONFIG_NAME);
      if (file_exists($path)) {
        // nacteni konfigurace
        $decode = json_decode(file_get_contents($path), true);
        // pripraveni jmena zipu
        $file = sprintf($conf['file_format'], date($conf['date_format']));

        $zip = new Zipper($decode['destination'].$file);  // pripraveni zipu
        foreach ($decode['files'] as $f) {
          if (is_file($f)) {  // pridavani souboru
            $zip->addFile($f);
            $poc++;
          }

          if (is_dir($f)) {
            $zip->addDir($f); // pridavani adresaru
            $poc++;
          }
        }

        // nacteni pole souboru
        $list = Core::getListFile(array(
            'path' => ($decode['destination'] ?: __DIR__),
            'full' => true,
            'filter+' => array('zip'),
            'sort' => array(Core::LIST_SORT_MTIME, Core::LIST_SORT_DESC),
          ));

        // mazani na expiraci souboru
        $poc += Core::cleanExpire($list, $conf['clean_expire'] . ' day');
        // mazani na pocet souboru
        $poc += Core::cleanCount($list, $conf['clean_count']);
      }

      return $poc;
    }
  }