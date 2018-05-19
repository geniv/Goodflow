<?php
/*
 * zipper.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * trida starajici se o baleni do zipu, specialni pripad tridy ZipArchive,
   * slouzi pouze pro baleni do archivu
   *
   * @package stable
   * @author geniv
   * @version 1.26
   */
  class Zipper {
    private $zip = null;  // vnitrni instance
    private $opened = false;  // otevreno?

    /**
     * vytvareni tridy
     *
     * @since 1.10
     * @param string filename jmeno zip souboru, pro rychle vytvoreni
     */
    public function __construct($filename = null) {
      $this->zip = new \ZipArchive;
      if ($filename) {
        $this->open($filename);
      }
    }

    /**
     * otevreni zipu
     * -open stavy: http://www.php.net/manual/en/zip.constants.php
     *
     * @since 1.12
     * @param string filename jmeno zip souboru, pro klasicke otevreni/vytvoreni
     * @param int flags priznaky pro vytvoreni: ZIPARCHIVE::OVERWRITE|CREATE|EXCL|CHECKCONS
     * @return bool stav z open
     */
    public function open($filename, $flags = \ZipArchive::CREATE) {
      $this->opened = $this->zip->open($filename, $flags);
      if ($this->opened !== true) {
        throw new ExceptionZipper('zip error: '.$this->opened);
      }
      return $this;
    }

    /**
     * nacteni stavu otevreni
     *
     * @since 1.24
     * @return bool true pokud je otevreno
     */
    public function isOpen() {
      return $this->opened;
    }

    /**
     * nacteni cesty zipu
     *
     * @since 1.18
     * @return string path zipu
     */
    public function getFileName() {
      return $this->zip->filename;
    }

    /**
     * nacteni stavu zipu
     *
     * @since 1.00
     * @return int cislo stavu
     */
    public function getStatus() {
      return $this->zip->status;
    }

    /**
     * uzavreni zipu
     *
     * @since 1.10
     * @return this
     */
    public function close() {
      if ($this->opened) {
        $this->opened = !$this->zip->close();
      }
      return $this;
    }

    /**
     * automaticke uzivirani zipu pri uklidu
     *
     * @since 1.18
     */
    public function __destruct() {
      $this->close();
    }

    /**
     * vytvoreni souboru z textu v zipu
     *
     * @since 1.14
     * @param string localname lokalni jmeno v zip
     * @param string contents obsah ktery ma priijit do souboru
     * @return this
     */
    public function addFromString($localname, $contents) {
      $this->zip->addFromString($localname, $contents);
      return $this;
    }

    /**
     * pridani souboru do zipu
     *
     * @since 1.10
     * @param string filename jmeno (cesta) souboru
     * @param string localname nove jmeno souboru v zipu, defaultne stejne jako filename
     * @return this
     */
    public function addFile($filename, $localname = null) {
      $this->zip->addFile($filename, $localname);
      return $this;
    }

    /**
     * pridani adresare do zipu
     *
     * @since 1.00
     * @param string filename jmeno (cesta) adresare
     * @param string localname nove jmeno adresare v zipu, defaultne stejne jako filename
     * @return this
     */
    public function addDir($filename, $localname = null) {
      $localname = ($localname ?: $filename);
      $this->zip->addEmptyDir($localname); //pridani prazdne slozky
      $iter = new \RecursiveDirectoryIterator($filename, \FilesystemIterator::SKIP_DOTS);
      foreach ($iter as $fileinfo) {  //prochazeni iteratoru
        if (!$fileinfo->isFile() && !$fileinfo->isDir()) {
          continue;
        }
        //zvoleni metody na pridavani, file/rekurziven dir
        $method = $fileinfo->isFile() ? 'addFile' : 'addDir';
        $this->$method($fileinfo->getPathname(), $localname.'/'.$fileinfo->getFilename());
      }
      return $this;
    }
  }


  /**
   * trida vyjimky pro Zipper
   *
   * @package stable
   * @author geniv
   * @version 1.00
   */
  class ExceptionZipper extends \Exception {}