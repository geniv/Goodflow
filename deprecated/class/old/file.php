<?php
/*
 * file.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 * NEW VERSION instead of the class: Filesystem
 */

  namespace classes;

  use Exception;

  class File {
    const VERSION = 1.1;

    /**
     * read from file
     *
     * @param file jmeno souboru
     * @return read content file
     */
    public static function read($file) {
      return file_get_contents($file);
    }

    /**
     * write to file
     *
     * @param file jmeno souboru
     * @param content text na zapsani
     * @return num write chars
     */
    public static function write($file, $content) {
      return file_put_contents($file, $content);
    }

    /**
     * delete file
     *
     * @param file name file
     * @return bool success or not
     */
    public static function delete($file) {
      if (file_exists($file)) {
        return unlink($file);
      }
    }
  }

  class ExceptionFile extends Exception {}

?>
