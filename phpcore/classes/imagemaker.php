<?php
/*
 * imagemakers.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * zpracovani obrazku pomoci image-magic metod
   *
   * @package stable
   * @author geniv
   * @version 1.26
   */
  abstract class ImageMaker {

    /**
     * nacte geometrii obrazku
     *
     * @since 1.12
     * @param string path cesta obrazku pro nacteni
     * @return array pole rozmeru, ['width'], ['height']
     */
    public static function geometry($path) {
      if (!file_exists($path) || filesize($path) == 0) {
        throw new ExceptionImageMaker('Vstupni obrazek neexistuje!');
      }
      $img = new \Imagick($path);
      return $img->getImageGeometry();
    }

    /**
     * zmena velikosti obrazku s tim ze se muze nejaka hodnota nechat dopocitat
     *
     * @since 1.00
     * @param string path_in cesta obrazku pro nacteni
     * @param string path_out cesta obrazku pro zapis
     * @param int|null w pozadovana sirka
     * @param int|null h pozadovana vyska
     * @param bool increasing true pro zvetsovani obrazku kdyz je mensi nez pozadovany rozmery, false nezvetsuje pokud je obrazek mensi
     * @return bool provedeno
     */
    public static function resize($path_in, $path_out, $w, $h, $increasing = false) {
      if (!file_exists($path_in) || filesize($path_in) == 0) {
        throw new ExceptionImageMaker('Vstupni obrazek neexistuje!');
      }
      $img = new \Imagick($path_in);
      if ($increasing) {
        $img->thumbnailImage($w, $h, $w && $h, true); // pokud je zadane w i h tak se zapina bestfit, + roztahuje mensi (jen pozadi)
      } else {
        $geometry = $img->getImageGeometry();
        // zmensuje kdyz je zadany w mensi nez samotny width obrazku
        if ($w && $w < $geometry['width'] || $h && $h < $geometry['height']) {
          $img->thumbnailImage($w, $h, $w && $h); // pokud je zadane w i h tak se zapina bestfit
        }
      }
      return $img->writeImage($path_out);
    }

    /**
     * cropnuti obrazku kvuli dodrzeni danych proporci
     *
     * @since 1.02
     * @param string path_in cesta obrazku pro nacteni
     * @param string path_out cesta obrazku na zapis
     * @param int w sirka cropu (orezu)
     * @param int h vyska cropu (orezu)
     * @param int x pocatecni souradnice cropu x
     * @param int y pocatecni souradnice cropu y
     * @return bool provedeno
     */
    public static function crop($path_in, $path_out, $w, $h, $x, $y) {
      if (!file_exists($path_in) || filesize($path_in) == 0) {
        throw new ExceptionImageMaker('Vstupni obrazek neexistuje!');
      }
      $img = new \Imagick($path_in);
      $img->cropImage($w, $h, $x, $y);
      return $img->writeImage($path_out);
    }

    /**
     * cropnuti a zmenseni obrazku
     *
     * @since 1.14
     * @param string path_in cesta obrazku pro nacteni
     * @param string path_out cesta obrazku na zapis
     * @param int|null w pozadovana sirka
     * @param int|null h pozadovana vyska
     * @return bool provedeno
     */
    public static function cropResize($path_in, $path_out, $w, $h) {
      if (!file_exists($path_in) || filesize($path_in) == 0) {
        throw new ExceptionImageMaker('Vstupni obrazek neexistuje!');
      }
      $img = new \Imagick($path_in);
      $img->cropthumbnailimage($w, $h);
      return $img->writeImage($path_out);
    }
  }

  class ExceptionImageMaker extends \Exception {}