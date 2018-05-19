<?php
/*
 *      imagic.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 * Reimplement imagick libraries
 * 100% function garanteed on Linux
 * created by GoodFlow Design
 *
 * example using: http://eclecticdjs.com/mike/tutorials/php/imagemagick/
 *                http://valokuva.org/?cat=1
 *                http://www.imagemagick.org/script/command-line-options.php
 *                http://www.imagemagick.org/Usage/
 *                http://www.php.net/manual/en/imagick.examples-1.php
 *
 *
 * manual page: http://www.php.net/manual/en/class.imagick.php
 *              http://www.php.net/manual/en/class.imagickdraw.php
 *              http://www.php.net/manual/en/book.imagick.php
 *
 *
 * use: http://imagemagick.org/script/escape.php
 *
 * use with: Fluent Interfaces
 */
//TODO projit:
//http://www.rubblewebs.co.uk/imagemagick/
//http://www.imagemagick.org/Usage/anim_basics/
//http://valokuva.org/?cat=1
//http://www.imagemagick.org/script/command-line-options.php

  /**
   *
   * Library Imagic
   *
   */

  namespace classes;

  use stdClass,
      Exception;

  final class Imagic {
    private $picture; //hlavni instance
    const TEMPDIR = '.tmp';
    const IMAGICPREFIX = 'tempimagic';
    //const IMAGICMIN = '6.5.0';
    const VERSION = 1.76;

//TODO zabudovat pak i array iterator! pro GIF!
//ArrayAccess, ArrayIterator?!

    //channel
    const CHANNEL_DEFAULT = 'Default';
    const CHANNEL_RED = 'Red';
    const CHANNEL_GRAY = 'Gray';
    const CHANNEL_CYAN = 'Cyan';
    const CHANNEL_GREEN = 'Green';
    const CHANNEL_MAGENTA = 'Magenta';
    const CHANNEL_BLUE = 'Blue';
    const CHANNEL_YELLOW = 'Yellow';
    const CHANNEL_ALPHA = 'Alpha';
    const CHANNEL_OPACITY = 'Opacity';
    const CHANNEL_BLACK = 'Black';
    const CHANNEL_INDEX = 'Index';
    const CHANNEL_ALL = 'All';
    const CHANNEL_RGB = 'RGB';
    const CHANNEL_RGBA = 'RGBA';
    const CHANNEL_CMYK = 'CMYK';
    const CHANNEL_CMYKA = 'CMYKA';
    const CHANNEL_HUE = 'Hue';
    const CHANNEL_LIGHTNESS = 'Lightness';
    const CHANNEL_LUMINANCE = 'Luminance';
    const CHANNEL_LUMINOSITY = 'Luminosity';
    const CHANNEL_MATTE = 'Matte';
    const CHANNEL_SATURATION = 'Saturation';
    const CHANNEL_SYNC = 'Sync';

    //dispose
    const DISPOSE_NONE = 'None';
    const DISPOSE_UNDEFINED = 'Undefined';
    const DISPOSE_BACKGROUND = 'Background';
    const DISPOSE_PREVIOUS = 'Previous';

    //colorspace
    const COLORSPACE_CMY = 'CMY';
    const COLORSPACE_CMYK = 'CMYK';
    const COLORSPACE_GRAY = 'Gray';
    const COLORSPACE_HSB = 'HSB';
    const COLORSPACE_HSL = 'HSL';
    const COLORSPACE_HWB = 'HWB';
    const COLORSPACE_LAB = 'Lab';
    const COLORSPACE_LOG = 'Log';
    const COLORSPACE_OHTA = 'OHTA';
    const COLORSPACE_REC601LUMA = 'Rec601Luma';
    const COLORSPACE_REC601YCBCR = 'Rec601YCbCr';
    const COLORSPACE_REC709LUMA  = 'Rec709Luma';
    const COLORSPACE_REC709YCBCR = 'Rec709YCbCr';
    const COLORSPACE_RGB = 'RGB';
    const COLORSPACE_SRGB = 'sRGB';
    const COLORSPACE_TRANSPARENT = 'Transparent';
    const COLORSPACE_XYZ = 'XYZ';
    const COLORSPACE_YCBCR = 'YCbCr';
    const COLORSPACE_YCC = 'YCC';
    const COLORSPACE_YIQ = 'YIQ';
    const COLORSPACE_YPBPR = 'YPbPr';
    const COLORSPACE_YUV = 'YUV';

    //imgtype
    const IMGTYPE_BILEVEL  = 'Bilevel';
    const IMGTYPE_GRAYSCALE  = 'Grayscale';
    const IMGTYPE_GRAYSCALEMATTE  = 'GrayscaleMatte';
    const IMGTYPE_PALETTE  = 'Palette';
    const IMGTYPE_PALETTEMATTE  = 'PaletteMatte';
    const IMGTYPE_PALETTEBILEVELMATTE = 'PaletteBilevelMatte';
    const IMGTYPE_TRUECOLOR  = 'TrueColor';
    const IMGTYPE_TRUECOLORMATTE  = 'TrueColorMatte';
    const IMGTYPE_COLORSEPARATION  = 'ColorSeparation';
    const IMGTYPE_COLORSEPARATIONMATTE  = 'ColorSeparationMatte';
    const IMGTYPE_OPTIMIZE  = 'Optimize';

    //filter
    const FILTER_POINT  = 'Point';
    const FILTER_BOX  = 'Box';
    const FILTER_TRIANGLE  = 'Triangle';
    const FILTER_HERMITE  = 'Hermite';
    const FILTER_HANNING  = 'Hanning';
    const FILTER_HAMMING  = 'Hamming';
    const FILTER_BLACKMAN  = 'Blackman';
    const FILTER_GAUSSIAN  = 'Gaussian';
    const FILTER_QUADRATIC  = 'Quadratic';
    const FILTER_CUBIC  = 'Cubic';
    const FILTER_CATROM  = 'Catrom';
    const FILTER_MITCHELL  = 'Mitchell';
    const FILTER_LANCZOS  = 'Lanczos';
    const FILTER_LAGRANGE = 'Lagrange';
    const FILTER_BARTLETT = 'Bartlett';
    const FILTER_BESSEL  = 'Bessel';
    const FILTER_BOHMAN = 'Bohman';
    const FILTER_SINC  = 'Sinc';
    const FILTER_KAISER = 'Kaiser';
    const FILTER_WELSH = 'Welsh';
    const FILTER_PARZEN = 'Parzen';

    //function
    const FUNCTION_POLYNOMIAL = 'Polynomial';
    const FUNCTION_SINUSOID = 'Sinusoid';
    const FUNCTION_ARCSIN = 'ArcSin';
    const FUNCTION_ARCTAN = 'ArcTan';

    //gravity
    const GRAVITY_NORTHWEST = 'NorthWest';
    const GRAVITY_NORTH = 'North';
    const GRAVITY_NORTHEAST = 'NorthEast';
    const GRAVITY_WEST = 'West';
    const GRAVITY_CENTER = 'Center';
    const GRAVITY_EAST = 'East';
    const GRAVITY_SOUTHWEST = 'SouthWest';
    const GRAVITY_SOUTH  = 'South';
    const GRAVITY_SOUTHEAST = 'SouthEast';
    const GRAVITY_STATIC = 'Static';
    const GRAVITY_FORGET = 'Forget';
    const GRAVITY_NONE = 'None';

    //distortion
    const DISTORTION_AFFINE = 'Affine';
    const DISTORTION_AFFINEPROJECTION = 'AffineProjection';
    const DISTORTION_ARC = 'Arc';
    const DISTORTION_BILINEARFORWARD = 'BilinearForward';
    const DISTORTION_BILINEARREVERSE = 'BilinearReverse';
    const DISTORTION_PERSPECTIVE = 'Perspective';
    const DISTORTION_PERSPECTIVEPROJECTION = 'PerspectiveProjection';
    const DISTORTION_SCALEROTATETRANSLATE = 'ScaleRotateTranslate';
    const DISTORTION_POLYNOMIAL = 'Polynomial';
    const DISTORTION_POLAR = 'Polar';
    const DISTORTION_DEPOLAR = 'DePolar';
    const DISTORTION_BARREL = 'Barrel';
    const DISTORTION_BARRELINVERSE = 'BarrelInverse';
    const DISTORTION_SHEPARDS = 'Shepards';
    const DISTORTION_SRT = 'SRT';

    //alphachannel
    const ALPHACHANNEL_ACTIVATE = 'Activate';
    const ALPHACHANNEL_DEACTIVATE = 'Deactivate';
    const ALPHACHANNEL_OFF = 'Off';
    const ALPHACHANNEL_ON = 'On';
    const ALPHACHANNEL_SET = 'Set';
    const ALPHACHANNEL_COPY = 'Copy';
    const ALPHACHANNEL_EXTRACT = 'Extract';
    const ALPHACHANNEL_OPAQUE = 'Opaque';
    const ALPHACHANNEL_SHAPE = 'Shape';
    const ALPHACHANNEL_BACKGROUND = 'Background';
    const ALPHACHANNEL_TRANSPARENT = 'Transparent';

    //compression
    //const COMPRESSION_UNDEFINED = '';
    const COMPRESSION_NONE = 'None';
    const COMPRESSION_BZIP = 'BZip';
    const COMPRESSION_FAX = 'Fax';
    const COMPRESSION_GROUP4 = 'Group4';
    const COMPRESSION_JPEG = 'JPEG';
    const COMPRESSION_JPEG2000 = 'JPEG2000';
    const COMPRESSION_LOSSLESS = 'Lossless';
    const COMPRESSION_LOSSLESSJPEG = 'LosslessJPEG';
    const COMPRESSION_LZW = 'LZW';
    const COMPRESSION_RLE = 'RLE';
    const COMPRESSION_ZIP = 'Zip';
    const COMPRESSION_ZipS = 'ZipS';
    const COMPRESSION_B44 = 'B44';
    const COMPRESSION_B44A = 'B44A';
    const COMPRESSION_DXT1 = 'DXT1';
    const COMPRESSION_DXT3 = 'DXT3';
    const COMPRESSION_DXT5 = 'DXT5';
    const COMPRESSION_PIZ = 'Piz';
    const COMPRESSION_PXR24 = 'Pxr24';
    const COMPRESSION_RUNLENGTHENCODED = 'RunlengthEncoded';

    //paint ?
    const PAINT_POINT = 'point';
    const PAINT_REPLACE = 'replace';
    const PAINT_FLOODFILL = 'floodfill';
    const PAINT_FILLTOBORDER = 'filltoborder';
    const PAINT_RESET = 'reset';

    //linecaps
    //const LINECAP_UNDEFINED = '';
    const LINECAP_BUTT = 'Butt';
    const LINECAP_ROUND = 'Round';
    const LINECAP_SQUARE = 'Square';

    //linejoins
    //const LINEJOIN_UNDEFINED = '';
    const LINEJOIN_MITER = 'Miter';
    const LINEJOIN_ROUND = 'Round';
    const LINEJOIN_BEVEL = 'Bevel';

    //composite
    //const COMPOSITE_DEFAULT = '';
    const COMPOSITE_UNDEFINED = 'None';
    const COMPOSITE_ADD = 'Add';
    const COMPOSITE_ATOP = 'Atop';
    const COMPOSITE_BLEND = 'Blend';
    const COMPOSITE_BLUR = 'Blur';
    const COMPOSITE_BUMPMAP = 'Bumpmap';
    const COMPOSITE_CHANGEMASK = 'ChangeMask';
    const COMPOSITE_CLEAR = 'Clear';
    const COMPOSITE_COLORBURN = 'ColorBurn';
    const COMPOSITE_COLORDODGE = 'ColorDodge';
    const COMPOSITE_COLORIZE = 'Colorize';
    const COMPOSITE_COPYBLACK = 'CopyBlack';
    const COMPOSITE_COPYBLUE = 'CopyBlue';
    const COMPOSITE_COPY = 'Copy';
    const COMPOSITE_COPYCYAN = 'CopyCyan';
    const COMPOSITE_COPYGREEN = 'CopyGreen';
    const COMPOSITE_COPYMAGENTA = 'CopyMagenta';
    const COMPOSITE_COPYOPACITY = 'CopyOpacity';
    const COMPOSITE_COPYRED = 'CopyRed';
    const COMPOSITE_COPYYELLOW = 'CopyYellow';
    const COMPOSITE_DARKEN = 'Darken';
    const COMPOSITE_DSTATOP = 'DstAtop';
    const COMPOSITE_DST = 'Dst';
    const COMPOSITE_DSTIN = 'DstIn';
    const COMPOSITE_DSTOUT = 'DstOut';
    const COMPOSITE_DSTOVER = 'DstOver';
    const COMPOSITE_DIFFERENCE = 'Difference';
    const COMPOSITE_DIVIDE = 'Divide';
    const COMPOSITE_DISPLACE = 'Displace';
    const COMPOSITE_DISSOLVE = 'Dissolve';
    const COMPOSITE_DISTORT = 'Distort';
    const COMPOSITE_EXCLUSION = 'Exclusion';
    const COMPOSITE_HARDLIGHT = 'HardLight';
    const COMPOSITE_HUE = 'Hue';
    const COMPOSITE_IN = 'In';
    const COMPOSITE_LIGHTEN = 'Lighten';
    const COMPOSITE_LINEARBURN = 'LinearBurn';
    const COMPOSITE_LINEARDODGE = 'LinearDodge';
    const COMPOSITE_LINEARLIGHT = 'LinearLight';
    const COMPOSITE_LUMINIZE = 'Luminize';
    const COMPOSITE_MATHEMATICS = 'Mathematics';
    const COMPOSITE_MINUS = 'Minus';
    const COMPOSITE_MODULATE = 'Modulate';
    const COMPOSITE_MULTIPLY = 'Multiply';
    const COMPOSITE_OUT = 'Out';
    const COMPOSITE_OVER = 'Over';
    const COMPOSITE_OVERLAY = 'Overlay';
    const COMPOSITE_PEGTOPLIGHT = 'PegtopLight';
    const COMPOSITE_PINLIGHT = 'PinLight';
    const COMPOSITE_PLUS = 'Plus';
    const COMPOSITE_REPLACE = 'Replace';
    const COMPOSITE_SATURATE = 'Saturate';
    const COMPOSITE_SCREEN = 'Screen';
    const COMPOSITE_SOFTLIGHT = 'SoftLight';
    const COMPOSITE_SRCATOP = 'SrcAtop';
    const COMPOSITE_SRC = 'Src';
    const COMPOSITE_SRCIN = 'SrcIn';
    const COMPOSITE_SRCOUT = 'SrcOut';
    const COMPOSITE_SRCOVER = 'SrcOver';
    const COMPOSITE_SUBTRACT = 'Subtract';
    const COMPOSITE_THRESHOLD = 'Threshold';
    const COMPOSITE_VIVIDLIGHT = 'VividLight';
    const COMPOSITE_XOR = 'Xor';

    //virtualpixelmethod
    //const VIRTUALPIXELMETHOD_UNDEFINED = '';
    const VIRTUALPIXELMETHOD_BACKGROUND = 'Background';
    const VIRTUALPIXELMETHOD_RANDOM = 'Random';
    const VIRTUALPIXELMETHOD_DITHER = 'Dither';
    const VIRTUALPIXELMETHOD_EDGE = 'Edge';
    const VIRTUALPIXELMETHOD_MIRROR = 'Mirror';
    const VIRTUALPIXELMETHOD_TILE = 'Tile';
    const VIRTUALPIXELMETHOD_CHECKERTILE = 'CheckerTile';
    const VIRTUALPIXELMETHOD_TRANSPARENT = 'Transparent';
    const VIRTUALPIXELMETHOD_BLACK = 'Black';
    const VIRTUALPIXELMETHOD_GRAY = 'Gray';
    const VIRTUALPIXELMETHOD_WHITE = 'White';
    const VIRTUALPIXELMETHOD_HORIZONTALTILE = 'HorizontalTile';
    const VIRTUALPIXELMETHOD_HORIZONTALTILEEDGE = 'HorizontalTileEdge';
    const VIRTUALPIXELMETHOD_VERTICALTILE = 'VerticalTile';
    const VIRTUALPIXELMETHOD_VERTICALTILEEDGE = 'VerticalTileEdge';

    //font styletype
    const STYLETYPE_ANY = 'Any';
    const STYLETYPE_ITALIC = 'Italic';
    const STYLETYPE_NORMAL = 'Normal';
    const STYLETYPE_OBLIQUE = 'Oblique';

    //font stretch
    const STRETCH_ANY = 'Any';
    const STRETCH_CONDENSED = 'Condensed';
    const STRETCH_EXPANDED = 'Expanded';
    const STRETCH_EXTRACONDENSED = 'ExtraCondensed';
    const STRETCH_EXTRAEXPANDED = 'ExtraExpanded';
    const STRETCH_NORMAL = 'Normal';
    const STRETCH_SEMICONDENSED = 'SemiCondensed';
    const STRETCH_SEMIEXPANDED = 'SemiExpanded';
    const STRETCH_ULTRACONDENSED = 'UltraCondensed';
    const STRETCH_ULTRAEXPANDED = 'UltraExpanded';

    //internal cmdtype
    const _CMDTYPE_NORMAL = 'normal';
    const _CMDTYPE_SPECIAL = 'special';

//------------------------------------------------------------------------------
    //redy - vytvareni instance Imagic, v settings muze byt: files (pro vstupni soubory), path (pro tempfile)
    public function __construct($settings = array(), $pathtemp = NULL) {
      try {
        $this->picture = new stdClass;
        $this->picture->path = NULL;
        $this->picture->format = NULL;
        $this->picture->size = NULL;
        $this->picture->geometry = NULL;
        $this->picture->task = NULL;

        $this->picture->font = NULL;
        $this->picture->temp_path = '.';
        $this->picture->state = true;
        $this->picture->version = self::getVersion();
        $this->picture->_stream = NULL; //pro uklizeni streamu
        $this->picture->_remove = array();  //pro uklid prebytku
        $this->picture->_debug = array();

        $this->picture->quality = 0;
        $this->picture->compress = NULL;
        $this->picture->dispose = NULL;
        $this->picture->signature = NULL;
        $this->picture->delay = array();
        $this->picture->transparent = NULL;
        $this->picture->channel = NULL;
        $this->picture->colorspace = NULL;
        $this->picture->depth = NULL;

        $this->picture->animation = false;  //detekce jestli je animace ci ne
        $this->picture->anim_index = 0;
        $this->picture->anim_count = 0;

        if (is_array($settings)) {  //pokud je settings pole
          $files = self::isFill($settings, 'files');
          $path = self::isFill($settings, 'path');
          if (empty($files)) {  //pokud nenajde index files tak pole preda cele do files s tim ze jde pole obrazku na GIF
            $files = $settings;
          }
        } else {  //pokuj je text tak je predpokladano ze se jedna o files
          $files = $settings;
          if (!empty($pathtemp)) {  //pokud je druhy parametr text, predpoklada se ze se jedna o path na temp
            $path = $pathtemp;
          }
        }

        if (!empty($path) && is_writable($path)) {
          $this->setTempPath($path);  //pokud se tu extra nastavi path
          $this->getTempFile();  //nacteni streamu
        }

        //nacteni obrazku do temp souboru
        if (!empty($files)) {
          if (is_array($files)) {
           //TODO muze nacitat i pole cest -> konvert na gif
           //automaticky typ na GIF
           //pocet obrazku
          } else {
            if (file_exists($files)) {
              $this->getIdentify($files); //nacteni identifikace
              $this->copyPath2Stream($files);
            } else {
              throw new ExceptionImagic(sprintf('picture %s doen not exist!', $files));
            }
          }
        }

      } catch (ExceptionImagic $e) {
        echo $e;
      }
    }

    //redy - stara se o auto uklid
    public function __destruct() {
      if (!empty($this->picture)) {
        $this->destroy();
      }
    }
//------------------------------------------------------------------------------
    //kopirovani path do _stream
    private function copyPath2Stream($path) {
      if (empty($this->picture->_stream)) {
        $this->getTempFile();  //nacteni streamu, pokud neexistuje
      }
      return copy($path, $this->picture->_stream);
    }

    //kopirovani _stream do path
    private function copyStream2Path($path) {
      $result = copy($this->picture->_stream, $path);
    }
//------------------------------------------------------------------------------
    //bool destroy ( void )
    public function destroy() {
      //hlavni uklid
      if (!empty($this->picture->_stream)) {
        if (file_exists($this->picture->_stream)) {
          unlink($this->picture->_stream); //smazani nevyuziteho ukazatele
        }
      }
      //uklid prebytku
      if (!empty($this->picture->_remove)) {
        foreach ($this->picture->_remove as $file) {
          unlink($file);
        }
      }
      //odalokovani
      unset($this->picture);
      //slozku tempu necha
    }
//------------------------------------------------------------------------------
    //redy - vytvoreni docasneho _stream souboru
    private function getTempFile() {
      try {
        $result = NULL;
        $path = sprintf('%s/%s', $this->picture->temp_path, self::TEMPDIR);
//SplTempFileObject
        //pokud se da zapisovat do pathe
        if (is_writable($this->picture->temp_path)) {
          if (!file_exists($path)) {
            if (!@mkdir($path, 0777)) {
              throw new ExceptionImagic('nelze vytvorit adresar tempu!');
            }
          }

          if (!$result = tempnam($path, self::IMAGICPREFIX)) {
            throw new ExceptionImagic('nepodarilo se ziskat temp soubor');
          }

          $this->picture->_stream = $result;  //pro destruktor
        } else {
          throw new ExceptionImagic(sprintf('nezle zapisovat do slozky: %s', $this->picture->temp_path));
        }

      } catch (ExceptionImagic $e) {
        echo $e;
      }
      return $result;
    }
//------------------------------------------------------------------------------
    private static $version = NULL;
    //array getVersion ( void ) - ukladane do statickeho atributu
    public static function getVersion($key = NULL) {
      if (is_null(self::$version)) {
        exec('identify -version | head -n 1 | cut -c 10-', $ret);
        preg_match('/\d\.\d\.\d/', $ret[0], $match);
        self::$version = array ('versionNumber' => $match[0],
                                'versionInteger' => (int) str_replace('.', '', $match[0]),
                                'versionString' => $ret[0],
                                'versionImagic' => self::VERSION);
      }
      return (!empty($key) ? self::$version[$key] : self::$version);
    }
//------------------------------------------------------------------------------
    //zpracovani dat z ifentify na asociativni pole
    private static function parseData($input) {
      $data_explode = explode('||', $input);
      $func_key = function($value) { $exp = explode('=', $value, 2); return $exp[0]; };
      $keys = array_map($func_key, $data_explode);  //parsnuti klicu
      $func_val = function($value) { $exp = explode('=', $value, 2); return $exp[1]; };
      $values = array_map($func_val, $data_explode);  //parsnuti hodnot
      return array_combine($keys, $values); //slouceni poli
    }

    //konstanta formatu exec identify
    const IDENTIFY_FORMAT = 'identify -format "name=%f||format=%m||w=%w||h=%h||geometry=%Wx%H,%X,%Y||delay=%T||quality=%Q||compress=%C||dispose=%D||signature=%#||transparent=%A||channel=%[channels]||colorspace=%[colorspace]||depth=%z||index=%[scene]||count=%[scenes]\n" ';  //za to jeste nazev

    //redy - nacitani informaci o obrazku
    private function getIdentify($file) {
      try {
        if (file_exists($file) && filesize($file) > 0) {
          //identifikace obrazku
          exec(self::IDENTIFY_FORMAT.escapeshellarg($file), $ret);
          if (!empty($ret)) {
            $base_data = self::parseData($ret[0]); //zpracovani prvniho radku

            $count = $base_data['count']; //pocet obrazku

            $this->picture->path = $base_data['name'];
            $this->picture->format = $base_data['format'];
            $this->picture->compress = $base_data['compress'];
            $this->picture->quality = $base_data['quality'];
            $this->picture->channel = $base_data['channel'];
            $this->picture->depth = $base_data['depth'];
            $this->picture->animation = true;
            if ($count > 1) {  //vraci o radek vic
              //zpracovani serie obrazku - gif
              $this->picture->anim_count = $count;
              foreach ($ret as $ret_row) {
                if (!empty($ret_row)) { //nacit jen neprazdne radky
                  $row = self::parseData($ret_row);
                  $index = $row['index'];
                  $this->picture->size[$index] = $this->parseSize($row);
                  $this->picture->geometry[$index] = $this->parseGeometry($row['geometry']);
                  $this->picture->delay[$index] = $row['delay'];
                  $this->picture->dispose[$index] = $row['dispose'];
                  $this->picture->signature[$index] = $row['signature'];
                  $this->picture->transparent[$index] = $row['transparent'];
                  $this->picture->colorspace[$index] = $row['colorspace'];

                }
              }
            } else {
              //zpracovani jednoho obrazku
              $this->picture->path = $base_data['name'];
              $this->picture->format = $base_data['format'];
              $this->picture->compress = $base_data['compress'];  //FIXME zajistit vnitrni interpretaci techto funkci!!!
              $this->picture->quality = $base_data['quality'];
              $this->picture->channel = $base_data['channel'];
              $this->picture->size = $this->parseSize($base_data);
              $this->picture->geometry = $this->parseGeometry($base_data['geometry']);
              $this->picture->delay = $base_data['delay'];
              $this->picture->dispose = $base_data['dispose'];
              $this->picture->signature = $base_data['signature'];
              $this->picture->transparent = $base_data['transparent'];
              $this->picture->colorspace = $base_data['colorspace'];
              $this->picture->depth = $base_data['depth'];
              $this->picture->animation = false;
            }
          } else {
            throw new ExceptionImagic('Nepodarilo se nacist identifikaci obrazku!');
          }
        } else {
          var_dump($file, $this->picture);
          throw new ExceptionImagic('Smazis se nacist neexistujici a nebo prazdny obrazek!');
        }
      } catch (ExceptionImagic $e) {
        echo $e;
        exit(1);
      }
    }
//------------------------------------------------------------------------------
    private function parseSize($input) {
      return array ('width' => (int) $input['w'],
                    'height' => (int) $input['h']);
    }
    //parsovani geometry
    private function parseGeometry($input) {
      $split = preg_split('/x|\,/', $input);
      return array ('width' => (int) $split[0],
                    'height' => (int) $split[1],
                    'x' => (int) $split[2],
                    'y' => (int) $split[3]);
    }
//------------------------------------------------------------------------------
    //int getNumberImages ( void )
    public function getNumberImages() {
      return $this->picture->anim_count;
    }

    //int getImageIndex ( void ) - nacitani indexu obrazku
    public function getImageIndex() {
      return $this->picture->anim_index;
    }

    //bool setImageIndex ( int $index ) - nastaveni indexu obrazku
    public function setImageIndex($index) {
      $this->picture->anim_index = $index;
      return $this;
    }

    //bool nextImage ( void )
    public function nextImage() {
      //pokud je mozne pricist, inkrementuje
      if ($this->hasNextImage()) {
        $this->picture->anim_index++;
      }
      return $this;
    }

    //bool previousImage ( void )
    public function previousImage() {
      //pokud je mozne odecist, dekrementuje
      if ($this->hasPreviousImage()) {
        $this->picture->anim_index--;
      }
      return $this;
    }

    //bool hasNextImage ( void )
    public function hasNextImage() {
      return ($this->picture->anim_index + 1 < $this->picture->anim_count);
    }

    //bool hasPreviousImage ( void )
    public function hasPreviousImage() {
      return ($this->picture->anim_index - 1 >= 0);
    }
//------------------------------------------------------------------------------
    //int getImageDispose ( void )
    public function getImageDispose() {
      return ($this->picture->animation ? $this->picture->dispose[$this->picture->anim_index] : $this->picture->dispose);
    }

    //bool setImageDispose ( int $dispose )
    public function setImageDispose($dispose) {
      if ($this->picture->animation) {
        $this->picture->dispose[$this->picture->anim_index] = $dispose;
      } else {
        $this->picture->dispose = $dispose;
      }
      return $this;
    }
//------------------------------------------------------------------------------
    //string getImageSignature ( void )
    public function getImageSignature() {
      return ($this->picture->animation ? $this->picture->signature[$this->picture->anim_index] : $this->picture->signature);
    }
//------------------------------------------------------------------------------
    //int getImageCompression ( void )
    public function getImageCompression() {
      return $this->picture->compress;
    }

    //bool setImageCompression ( int $compression )
    public function setImageCompression($compression) {
      $this->picture->compress = $compression;  //def: 75~80
      return $this;
    }
//FIXME v cmd: -quality xx ,defaultne 80
    //int getImageCompressionQuality ( void )
    public function getImageCompressionQuality() {
      return $this->picture->quality;
    }
//a sem prijdou konstanty!
    //bool setImageCompressionQuality ( int $quality )
    public function setImageCompressionQuality($quality) {
      $this->picture->quality = $dispose;
      return $this;
    }

    //int getImageColorspace ( void )
    public function getImageColorspace() {
      return ($this->picture->animation ? $this->picture->colorspace[$this->picture->anim_index] : $this->picture->colorspace);
    }

    //int getImageDepth ( void )
    public function getImageDepth() {
      return $this->picture->depth;
    }

    //bool setImageDepth ( int $depth )
    public function setImageDepth($depth) {
      $this->picture->depth = $depth;
      return $this;
    }

/* Strict Standards: Imagick::getImageSize is deprecated.
    //int getImageSize ( void )
    public function getImageSize() {
      //FIXME provest nejdriv exec?!
      return filesize($this->picture->_stream);
    }
*/

    //int getImageLength ( void )
    public function getImageLength() {
      //FIXME provest nejdriv exec?!
      return filesize($this->picture->_stream);
    }

    //string getImageMimeType ( void )
    public function getImageMimeType() {
      $result = NULL;
      //FIXME provest nejdriv exec?!
      if (!empty($this->picture->_stream)) {
        $ret = getimagesize($this->picture->_stream);
        $result = $ret['mime'];
      }
      return $result;
    }

    //getImageChannelDepth
    public function getImageChannel() {
      return $this->picture->channel;
    }

    //array getImageProperties ([ string $pattern = "*" [, bool $only_names = true ]] )
    public function getImageProperties($pattern = '*', $only_names = true) {
      $result = NULL;
      if (self::checkVersion(636)) {
        exec(sprintf('identify -format %%[%s] %s', $pattern, escapeshellarg($this->picture->_stream)), $ret);
        $result = array();
        foreach ($ret as $row) {
          if (!empty($row)) {
            $expl = explode('=', $row, 2);
            if ($only_names) {
              $result[$expl[0]] = $expl[1];
            } else {
              $result[] = $expl[0];
            }
          }
        }
      }
      return $result;
    }

    //string getImageProperty ( string $name )
    public function getImageProperty($name) {
      //TODO hodnota z identify!!! napred si nacte z getImageProperties
      $ret = $this->getImageProperties();
      return $ret[$name];
    }

    //staticka metoda na kontrolu funkce
    private static function checkVersion($version) {
      return (self::getVersion('versionInteger') >= $version);
    }

    //TODO getImageLoop, setImageLoop
    public function getImageLoop() {
      return $this->picture->anim_loop; //TODO doaplikovat do exec!
    }
//TODO sety nacpat do __call
    public function setImageLoop($loop) {
      $this->picture->anim_loop = $loop;
      return $this;
    }

//------------------------------------------------------------------------------
    //array identifyImage ([ bool $appendRawOutput = false ] )
    public function identifyImage($appendRawOutput = false) {
      $result = array();
      exec(sprintf('identify -verbose %s', escapeshellarg($this->picture->path)), $identifyverbose);

      $match = implode('', preg_grep('/Image\:/', $identifyverbose));
      $result['imageName'] = substr($match, 7);

      $match = implode('', preg_grep('/Format\:/', $identifyverbose));
      $result['format'] = substr($match, 10);

      $result['geometry'] = $this->picture->size;

      $match = implode('', preg_grep('/Resolution\:/', $identifyverbose));
      $resolution_split = preg_split('/x/', substr($match, 14));
      $result['resolution'] = array('x' => (float) $resolution_split[0],
                                    'y' => (float) $resolution_split[1]);

      $match = implode('', preg_grep('/Units\:/', $identifyverbose));
      $result['units'] = substr($match, 9);

      $match = implode('', preg_grep('/Type\:/', $identifyverbose));
      $result['type'] = substr($match, 8);

      $match = implode('', preg_grep('/Colorspace\:/', $identifyverbose));
      $result['colorSpace'] = substr($match, 14);

      $match = implode('', preg_grep('/Compression\:/', $identifyverbose));
      $result['compression'] = substr($match, 15);

      $match = implode('', preg_grep('/Filesize\:/', $identifyverbose));
      $result['fileSize'] = substr($match, 12);

      if ($appendRawOutput) {
        $result['rawOutput'] = implode(PHP_EOL, $identifyverbose);
      }

      return $result;
    }
//------------------------------------------------------------------------------
    //redy
    public function getTempPath() {
      return $this->picture->temp_path;
    }

    //redy
    public function setTempPath($path) {
      $this->picture->temp_path = $path;
      return $this;
    }
//------------------------------------------------------------------------------
    //string getImageFilename ( void )
    public function getImageFilename() {
      return $this->picture->path;
    }

    //bool setImageFilename ( string $filename )
    public function setImageFilename($filename) {
      $this->picture->path = $filename;
      return $this;
    }
//------------------------------------------------------------------------------
    //string getImageFormat ( void )
    public function getImageFormat() {
      return $this->picture->format;
    }

    //bool setImageFormat ( string $format )
    public function setImageFormat($format) {
      $this->picture->format = $format;
      return $this;
    }
//------------------------------------------------------------------------------
    //array getImageGeometry ( void )
    public function getImageGeometry() {
      return ($this->picture->animation ? $this->picture->size[$this->picture->anim_index] : $this->picture->size);
    }
//------------------------------------------------------------------------------
    //array getImagePage ( void )
    public function getImagePage() {
      return ($this->picture->animation ? $this->picture->geometry[$this->picture->anim_index] : $this->picture->geometry);
    }

    //bool setImagePage ( int $width , int $height , int $x , int $y )
    public function setImagePage($width, $height, $x, $y) {
      $this->picture->geometry = array ('width' => (int) $width,
                                        'height' => (int) $height,
                                        'x' => (int) $x,
                                        'y' => (int) $y);
      return $this;
    }
//------------------------------------------------------------------------------
    //int getImageHeight ( void )
    public function getImageHeight() {
      return ($this->picture->animation ? $this->picture->size[$this->picture->anim_index]['height'] : $this->picture->size['height']);
    }
//------------------------------------------------------------------------------
    //int getImageWidth ( void )
    public function getImageWidth() {
      return ($this->picture->animation ? $this->picture->size[$this->picture->anim_index]['width'] : $this->picture->size['width']);
    }
//------------------------------------------------------------------------------
    //int getImageDelay ( void )
    public function getImageDelay() {
      return $this->picture->delay[$this->picture->anim_index];
    }

    //bool setImageDelay ( int $delay )
    public function setImageDelay($delay) {
      $this->picture->delay[$this->picture->anim_index] = $delay; //pridava vzdy do pole
      return $this;
    }
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
    //Imagick getImage ( void )
    public function getImage() {
      $result = NULL;
//FIXME Returns a new Imagick object with the current image sequence. Throw an ImagickException on error.
      //$this->executeCmd();  //nachroustani prikazu
/*
      if (!empty($this->picture->_stream)) {
        $result = file_get_contents($this->picture->_stream);
      }
      return $result;
*/
    }

    //bool setImage ( Imagick $replace )
    public function setImage(Imagic $replace) {
      if ($replace instanceof Imagic) {
        $filename = $replace->getDataImagic();
        $this->getIdentify($filename); //nacteni identifikace
      }
      return $this;
    }
//------------------------------------------------------------------------------
    //string getFont ( void )
    public function getFont() {
      return $this->picture->font;
    }

    //bool setFont ( string $font )
    public function setFont($font) {
      //FIXME rozlisovat nejak souborov a textovy font????
      $this->picture->font = $font;
      return $this;
    }
//------------------------------------------------------------------------------
    //bool readImage ( string $filename )
    public function readImage($filename) {
      if (file_exists($filename)) {
        $this->getIdentify($filename); //nacteni identifikace
      }
//FIXME nacteni i obrazku do streamu!!!!!
      return $this;
    }

    //bool writeImage ([ string $filename ] )
    public function writeImage($filename = NULL) {
      $result = false;
      $this->executeCmd();  //nachroustani prikazu

      if (!empty($filename)) {

        //pokud se neprovadi zadna operace a je jen zadany path v __construct
        if (empty($this->picture->_stream) &&
            !empty($this->picture->path)) {

//TODO poprepmyslet jestli nebube vubec rozumce cele(a nebo aspon cast) ukladani delat convertem
//aby se predeslo kolizim formatu u obrazku!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! a komprese???
//a mizna sem i dotahnou kompresi $this->picture->compress
//naaplikovat aby se to nekde: '-compress type' / '+compress type' ?????????

          //pokud se lisi koncovky provede prejmenovani s convertem
          $filenameformat = pathinfo($filename, PATHINFO_EXTENSION);
          if ($filenameformat != $this->picture->format) {
            exec(sprintf('convert \'%s\' \'%s\'', $this->picture->path, $filename), $out, $result);
          } else {
            $result = copy($this->picture->path, $filename);
          }

        } else {
          $result = copy($this->picture->_stream, $filename);
        }

        //$this->getIdentify($filename); //nacteni identifikace, ????????????????

      } else {

        if (!empty($this->picture->path)) {
          $filename = $this->picture->path;

          $result = copy($this->picture->_stream, $filename);
          //exec(sprintf('convert \'%s\' \'%s\'', $this->picture->_stream, $filename));
//FIXME udelat spravny konvert na format!!!!?!
          $this->getIdentify($filename); //nacteni identifikace

        } else {
          echo 'nemuzes zapsat obrazek ktery se nijak nejmenuje!!';
          exit(1);
        }
      }

      return $result;
    }

    //public function writeImages() {} //TODO dodelat?!!
//------------------------------------------------------------------------------
    //redy
    public function getDataImagic() {
      $result = NULL;
      if (!empty($this->picture->_stream)) {
        $this->executeCmd();  //nachroustani prikazu
        $result = $this->picture->_stream;
      }
      return $result;
    }
//------------------------------------------------------------------------------
    const _C_ARRAY = 'array';
    const _C_BOOLEAN = 'boolean';
    const _C_IMAGIC = 'Imagic';
    const _C_IMAGICDRAW = 'ImagicDraw';
    const _C_NUMERIC = 'numeric';
    const _C_STRING = 'string';

    //pretezovana metoda pro efekty
    public function __call($name, $values) {
      try {
        if (empty($this->picture->_stream)) {
          $this->getTempFile();  //nacteni streamu, pokud neexistuje
        }

        $parameters = $values;

        $check = NULL;
        $format = NULL;
        $version = NULL;
        $cmdtype = self::_CMDTYPE_NORMAL;

        switch ($name) {

          //bool adaptiveBlurImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case 'adaptiveBlurImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            switch (count($values)) {
              case 2: $format = '-adaptive-blur %sx%s'; break;
              case 3: $format = '-adaptive-blur %sx%s -channel %s'; break;
            }
          break;

          //bool adaptiveResizeImage ( int $columns , int $rows [, bool $bestfit = false ] )
          case 'adaptiveResizeImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            $columns = self::isFill($values, 0);
            $rows =  self::isFill($values, 1);
            $bestfit = self::getBestfitValue($values, 2, $columns, $rows);
            $values = array($columns, $rows, $bestfit);
            $format = '-adaptive-resize %sx%s%s';
          break;

          //bool adaptiveSharpenImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case 'adaptiveSharpenImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            switch (count($values)) {
              case 2: $format = '-adaptive-sharpen %sx%s'; break;
              case 3: $format = '-adaptive-sharpen %sx%s -channel %s'; break;
            }
          break;

          //bool adaptiveThresholdImage ( int $width , int $height , int $offset )
          case 'adaptiveThresholdImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $values[2] = self::getSignValue($values[2]);
            $format = '-lat %sx%s%s';
          break;

          //bool annotateImage ( ImagickDraw $draw_settings , float $angle , string $text )
          //bool annotateImage ( ImagickDraw $draw_settings , float $x , float $y , string $text )
          //bool annotateImage ( ImagickDraw $draw_settings , float $x , float $y, float $angle_x, float $angle_y , string $text )  //???

          //bool annotateImage ( ImagickDraw $draw_settings , float $x , float $y , float $angle , string $text )
          case 'annotateImage':
            $check = array(self::_C_IMAGICDRAW, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_STRING);
            $version = '600';
//var_dump($values);
            $draw = $values[0]->getDataImagicDraw();
            $x = $values[1];
            $y = $values[2];
            $angle = $values[3];
            $text = $values[4];
            $values = array($draw, $angle, $x, $y, $text);
            $format = '%s -annotate %sx+%s+%s "%s"';  //TODO pridat pretezovani
/*
//FIXME toto dodelat a nejak naimplementovat!!!!!
* http://www.imagemagick.org/Usage/misc/#annotate
* http://www.html46.com/Annotate_at_IM.html
*
-annotate degrees text
-annotate XdegreesxYdegrees text
-annotate XdegreesxYdegrees {+-}tx{+-}ty text
*
-annotate degrees text
-annotate XdegreesxYdegrees text
-annotate XdegreesxYdegrees {+-}tx{+-}ty text
*/
          break;

          //bool blurImage ( float $radius , float $sigma [, int $channel ] )
          case 'blurImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            switch (count($values)) {
              case 2: $format = '-blur %sx%s'; break;
              case 3: $format = '-blur %sx%s -channel %s'; break;
            }
          break;

          //bool borderImage ( mixed $bordercolor , int $width , int $height )
          case 'borderImage':
            $check = array(self::_C_STRING, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-bordercolor "%s" -border %sx%s';
          break;

          //bool charcoalImage ( float $radius , float $sigma )
          case 'charcoalImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-charcoal %sx%s';
          break;

          //bool chopImage ( int $width , int $height , int $x , int $y )
          case 'chopImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-chop %sx%s+%s+%s';
          break;

          //bool colorizeImage ( mixed $colorize , mixed $opacity )
          case 'colorizeImage':
            $check = array(self::_C_STRING);
            $version = '600';
            $colorize = $values[0]; //pouze ve tvaru #RRGGBB!!!!
            //$opacity = $values[1];
            list($r , $g, $b) = self::seraprateRGB($values[0]);

            $values = array($colorize,
                            round(($r / 255) * 100),
                            round(($g / 255) * 100),
                            round(($b / 255) * 100));
            $format = '-fill \'%s\' -colorize %s%%,%s%%,%s%%';
          break;

          //bool compositeImage ( Imagick $composite_object , int $composite , int $x , int $y [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'compositeImage':
            $check = array(self::_C_IMAGIC, self::_C_STRING, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $cmdtype = self::_CMDTYPE_SPECIAL;
            $composite_object = $values[0]->getDataImagic();
            $composite = $values[1];
            $x = $values[2];
            $y = $values[3];
            $channel = self::isFill($values, 4, self::CHANNEL_ALL);
            $values = array($composite, $x, $y, $channel, $this->picture->_stream, $composite_object, $this->picture->_stream);
            $format = '-compose %s -geometry +%s+%s -channel %s -composite \'%s\' \'%s\' \'%s\'';
          break;

          //bool contrastImage ( bool $sharpen )
          case 'contrastImage':
            $check = array(self::_C_BOOLEAN);
            $version = '600';
            $values[0] = self::getSign(!$values[0]);
            $format = '%scontrast';
          break;

          //bool contrastStretchImage ( float $black_point , float $white_point [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'contrastStretchImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            $values[2] = self::isFill($values, 2, self::CHANNEL_ALL);
            $format = '-contrast-stretch %sx%s%% -channel %s';
          break;

          //convolveImage

          //bool cropImage ( int $width , int $height , int $x , int $y )
          case 'cropImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-crop %sx%s+%s+%s';
          break;

          //bool cropThumbnailImage ( int $width , int $height )
          case 'cropThumbnailImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $width = $values[0];
            $height = $values[1];
            $values = array($width, $height, $width, $height);
            $format = '-thumbnail %sx%s^ -gravity center -extent %sx%s';
          break;

          //bool cycleColormapImage ( int $displace )
          case 'cycleColormapImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-cycle %s';
          break;

          //bool deskewImage ( float $threshold )
          case 'deskewImage':
            $check = array(self::_C_NUMERIC);
            $version = '645';
            $format = '-deskew %s';
          break;

          //bool despeckleImage ( void )
          case 'despeckleImage':
            $check = array();
            $version = '600';
            $format = '-despeckle';
          break;

          //bool distortImage ( int $method , array $arguments , bool $bestfit )
          case 'distortImage':
            $check = array(self::_C_STRING, self::_C_ARRAY, self::_C_BOOLEAN);
            $version = '636';
            $method = $values[0];
            $arguments = $values[1];
            $bestfit = self::getSign($values[2]);
            $row = NULL;
            $chunk = array_chunk($arguments, 2);  //X,X  X,X  X,X  X,X ...
            $point = array();
            foreach ($chunk as $pars) {
              $point[] = implode(',', $pars);
            }
            $row = implode(' ', $point);
            $values = array($bestfit, $method, $row);
            $format = '%sdistort %s \'%s\'';
          break;

          //bool drawImage ( ImagickDraw $draw )
          case 'drawImage':
            $check = array(self::_C_IMAGICDRAW);
            $version = '600';
            $values[0] = $values[0]->getDataImagicDraw();
            $format = '%s';
          break;

          //bool edgeImage ( float $radius )
          case 'edgeImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-edge %s';
          break;

          //bool embossImage ( float $radius , float $sigma )
          case 'embossImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-emboss %sx%s';
          break;

          //bool encipherImage ( string $passphrase )
          case 'encipherImage':
            $check = array(self::_C_STRING);
            $version = '639';
            $format = '-encipher \'%s\'';
          break;

          //bool enhanceImage ( void )
          case 'enhanceImage':
            $check = array();
            $version = '600';
            $format = '-enhance';
          break;

          //bool equalizeImage ( void )
          case 'equalizeImage':
            $check = array();
            $version = '600';
            $format = '-equalize';
          break;

          //bool evaluateImage ( int $op , float $constant [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'evaluateImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $values[2] = self::isFill($values, 2, self::CHANNEL_ALL);
            $format = '-evaluate %s %s -channel %s';
          break;

          //bool extentImage ( int $width , int $height , int $x , int $y )
          case 'extentImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '631';
            $format = '-extent %sx%s+%s+%s';
          break;

          //bool flipImage ( void )
          case 'flipImage':
            $check = array();
            $version = '600';
            $format = '-flip';
          break;

          //bool flopImage ( void )
          case 'flopImage':
            $check = array();
            $version = '600';
            $format = '-flop';
          break;

          //bool frameImage ( mixed $matte_color , int $width , int $height , int $inner_bevel , int $outer_bevel )
          case 'frameImage':
            $check = array(self::_C_STRING, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-mattecolor \'%s\' -frame %sx%s+%s+%s';
          break;

          //bool functionImage ( int $function , array $arguments [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case 'functionImage':
            $check = array(self::_C_STRING, self::_C_ARRAY);
            $version = '649';
            $values[1] = implode(',', $values[1]);
            switch (count($values)) {
              case 2: $format = '-function %s %s'; break;
              case 3: $format = '-function %s %s -channel %s'; break;
            }
          break;

          //bool fxImage ( string $expression [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'fxImage':
            $check = array(self::_C_STRING);
            $version = '600';
            $values[1] = self::isFill($values, 1, self::CHANNEL_ALL);
            $format = '-fx \'%s\' -channel %s';
          break;

          //bool gammaImage ( float $gamma [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'gammaImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $values[1] = self::isFill($values, 1, self::CHANNEL_ALL);
            $format = '-gamma %s -channel %s';
          break;

          //bool gaussianBlurImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'gaussianBlurImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $values[2] = self::isFill($values, 2, self::CHANNEL_ALL);
            $format = '-gaussian-blur %sx%s -channel %s';
          break;

          //bool haldClutImage ( Imagick $clut [, int $channel = Imagick::CHANNEL_DEFAULT ] )
/*
          case '':
            //TODO nastudovat a dodealt?!
          break;
*/

          //bool implodeImage ( float $radius )
          case 'implodeImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-implode %s';
          break;

          //bool levelImage ( float $blackPoint , float $gamma , float $whitePoint [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'levelImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $blackPoint = $values[0];
            $gamma = $values[1];
            $whitePoint = $values[2];
            $channel = self::isFill($values, 3, self::CHANNEL_ALL);
            $values = array($blackPoint, $whitePoint, $gamma, $channel);
            $format = '-level %s,%s,%s -channel %s';
          break;

          //bool linearStretchImage ( float $blackPoint , float $whitePoint )
          case 'linearStretchImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-linear-stretch %sx%s';
          break;

          //bool magnifyImage ( void )
          case 'magnifyImage':
            $check = array();
            $version = '600';
            $format = '-resize 200%%';
          break;

          //bool medianFilterImage ( float $radius )
          case 'medianFilterImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-median %s';
          break;

          //bool minifyImage ( void )
          case 'minifyImage':
            $check = array();
            $version = '600';
            $format = '-resize 50%%';
          break;

          //bool modulateImage ( float $brightness , float $saturation , float $hue )
          case 'modulateImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-modulate %s,%s,%s';
          break;

          //bool motionBlurImage ( float $radius , float $sigma , float $angle [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case 'motionBlurImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            switch (count($values)) {
              case 3: $format = '-motion-blur %sx%s+%s'; break;
              case 4: $format = '-motion-blur %sx%s+%s -channel %s'; break;
            }
          break;

          //bool negateImage ( bool $gray [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'negateImage':
            $check = array(self::_C_BOOLEAN);
            $version = '600';
            $values[0] = self::getSign($values[0]);
            $values[1] = self::isFill($values, 1, self::CHANNEL_ALL);
            $format = '%snegate -channel %s';
          break;

          //bool newImage ( int $cols , int $rows , mixed $background [, string $format ] )
          case 'newImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_STRING);
            $version = '600';
            $cmdtype = self::_CMDTYPE_SPECIAL;
            $this->picture->format = self::isFill($values, 3, 'png');
            $newstream = sprintf('%s.%s', $this->picture->_stream, $this->picture->format);  //vyrvoreni noveho jmena
            unlink($this->picture->_stream);  //smazani stareho streamu
            $this->picture->_stream = $newstream; //prepis novym jmenem
            $values[3] = $newstream;
            //TODO do budoucna jeste posefovat kvalitu vytvareni obrazku!
            //++pak zajistit spravne chovani pri animacich!!!
            $format = '-size %sx%s xc:\'%s\' \'%s\''; //\'{$this->obrazek->stream}.{$format}\'
          break;

          //bool newPseudoImage ( int $columns , int $rows , string $pseudoString )
          case 'newPseudoImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_STRING);
            $version = '600';
            $cmdtype = self::_CMDTYPE_SPECIAL;
            $this->picture->format = ($this->picture->format ?: 'png'); //nastaveni defaultniho formatu
            $newstream = sprintf('%s.%s', $this->picture->_stream, $this->picture->format);  //vyrvoreni noveho jmena
            unlink($this->picture->_stream);  //smazani stareho streamu
            $this->picture->_stream = $newstream; //prepis novym jmenem
            $values[3] = $newstream;
            $format = '-size %sx%s \'%s\' \'%s\'';
          break;

          //bool normalizeImage ([ int $channel = Imagick::CHANNEL_ALL ] )
          case 'normalizeImage':
            $check = array();
            $version = '600';
            $values[0] = self::isFill($values, 0, self::CHANNEL_ALL);
            $format = '-normalize -channel %s';
          break;

          //bool oilPaintImage ( float $radius )
          case 'oilPaintImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-paint %s';
          break;

          //bool paintOpaqueImage ( mixed $target , mixed $fill , float $fuzz [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'paintOpaqueImage':
            $check = array(self::_C_STRING, self::_C_STRING, self::_C_NUMERIC);
            $version = '600';
            $target = $values[0];
            $fill = $values[1];
            $fuzz = $values[2];
            $channel = self::isFill($values, 3, self::CHANNEL_ALL);
            $values = array($fuzz, $fill, $target, $channel);
            $format = '-fuzz %s -fill \'%s\' -opaque \'%s\' -channel %s';
          break;

          //bool paintTransparentImage ( mixed $target , float $alpha , float $fuzz )
          case 'paintTransparentImage':
            $check = array(self::_C_STRING, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $target = $values[0];
            $alpha = $values[1];
            $fuzz = $values[2];
            $values = array($fuzz, $alpha, $target);
            $format = '-fuzz %s -channel rgba -fill "rgba(0,0,0,%s)" -opaque \'%s\'';  // -transparent white
          break;

          //bool polaroidImage ( ImagickDraw $properties , float $angle )
          case 'polaroidImage':
            $check = array(self::_C_IMAGICDRAW, self::_C_NUMERIC);
            $version = '632';
            $values[0] = $values[0]->getDataImagicDraw();
            $format = '%s -polaroid %s';
          break;

          //bool posterizeImage ( int $levels , bool $dither )
          case 'posterizeImage':
            $check = array(self::_C_NUMERIC, self::_C_BOOLEAN);
            $version = '600';
            $values[1] = self::getSign(!$values[1]);
            $format = '-posterize %s %sdither Riemersma';
          break;

          //bool previewImages ( int $preview )
          case 'previewImages': //?!!
            $check = array(self::_C_STRING);
            $version = '600'; //TODO poresit lip!!!!
            $format = '-preview %s';
          break;

          //bool radialBlurImage ( float $angle [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'radialBlurImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $values[1] = self::isFill($values, 1, self::CHANNEL_ALL);
            $format = '-radial-blur %s -channel %s';
          break;

          //bool raiseImage ( int $width , int $height , int $x , int $y , bool $raise )
          case 'raiseImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_BOOLEAN);
            $version = '600';
            $width = $values[0];
            $height = $values[1];
            $x = $values[2];
            $y = $values[3];
            $raise = self::getSign(!$values[4]);
            $values = array($raise, $width, $height, $x, $y);
            $format = '%sraise %sx%s+%s+%s';
          break;

          //bool randomThresholdImage ( float $low , float $high [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'randomThresholdImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            $values[2] = self::isFill($values, 2, self::CHANNEL_ALL);
            $format = '-random-threshold %sx%s -channel %s';
          break;

          //bool reduceNoiseImage ( float $radius )
          case 'reduceNoiseImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-noise %s';
          break;

          //bool resampleImage ( float $x_resolution , float $y_resolution , int $filter , float $blur )
          case 'resampleImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_STRING, self::_C_NUMERIC);
            $version = '600';
            $format = '-resample %sx%s -filter %s'; // -blur %s
          break;

          //bool resizeImage ( int $columns , int $rows , int $filter , float $blur [, bool $bestfit = false ] )
          case 'resizeImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_STRING, self::_C_NUMERIC);
            $version = '600';
            $columns = self::isFill($values, 0);
            $rows =  self::isFill($values, 1);
            $bestfit = self::getBestfitValue($values, 4, $columns, $rows);
            $values = array($columns, $rows, $bestfit, $values[2], $values[3]);
            $format = '-resize %sx%s%s -filter %s -define filter:blur=%s';  //-blur %s.0%%
          break;

          //bool rollImage ( int $x , int $y )
          case 'rollImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-roll +%s+%s';
          break;

          //bool rotateImage ( mixed $background , float $degrees )
          case 'rotateImage':
            $check = array(self::_C_STRING, self::_C_NUMERIC);
            $version = '600';
            $format = '-background \'%s\' -rotate %s';
          break;

          //bool roundCorners ( float $x_rounding , float $y_rounding [, float $stroke_width = 10 [, float $displace = 5 [, float $size_correction = -6 ]]] )
          case 'roundCorners':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600'; //629, jelikoz je to psane rucne tak je to zbytecny
            $cmdtype = self::_CMDTYPE_SPECIAL;
            $x_rounding = $values[0];
            $y_rounding = $values[1];
            $stroke_width = self::isNull($values, 2, 10); //10
            $displace = self::isNull($values, 3, 5); //5
            $size_correction = self::isNull($values, 4, -6);  //-6
            $w = $this->picture->size['width']; //nezjistuje jestli se hybalo s obrazkama!
            $h = $this->picture->size['height'];
            switch (count($values)) {
              case 2:
                $values = array($this->picture->_stream, $w, $h, 0, 0, 0, $w, $h, $x_rounding, $y_rounding, $this->picture->_stream);
              break;
//TODO dodelat!!!! round!
              case 3:
              break;

              case 4:
                $values = array($this->picture->_stream, $w, $h, $stroke_width, $displace, $displace, $w - $displace - 1, $h - $displace - 1, $x_rounding, $y_rounding, $this->picture->_stream);
              break;
            }
            $format = '\'%s\' -mattecolor black \( -size %sx%s xc:none -stroke black -strokewidth %s -draw \'roundRectangle %s,%s %s,%s %s,%s\' \)  -compose DstIn -composite \'%s\'';
          break;

          //bool sampleImage ( int $columns , int $rows )
          case 'sampleImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-sample %sx%s!';
          break;

          //bool scaleImage ( int $cols , int $rows [, bool $bestfit = false ] )
          case 'scaleImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $cols = self::isFill($values, 0);
            $rows = self::isFill($values, 1);
            $bestfit = self::getBestfitValue($values, 2, $cols, $rows);
            $values = array($cols, $rows, $bestfit);
            $format = '-scale %sx%s%s';
          break;

          //bool separateImageChannel ( int $channel )
          case 'separateImageChannel':
            $check = array(self::_C_STRING);
            $version = '600';
            $format = '-separate -channel %s';
          break;

          //bool sepiaToneImage ( float $threshold )
          case 'sepiaToneImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-sepia-tone %s%%';
          break;

          //bool setImageColorspace ( int $colorspace )
          case 'setImageColorSpace':
            $check = array(self::_C_STRING);
            $version = '600';
            $format = '-colorspace %s';
            //TODO $this->picture->colorspace
          break;

          //bool setImageBackgroundColor ( mixed $background )
          case 'setImageBackgroundColor':
            $check = array(self::_C_STRING);
            $version = '600';
            $format = '-background \'%s\'';
          break;

          //bool setImageVirtualPixelMethod ( int $method )
          case 'setImageVirtualPixelMethod':
            $check = array(self::_C_STRING);
            $version = '600';
            $format = '-virtual-pixel %s';
          break;

          //bool setImageMatte ( bool $matte )
          case 'setImageMatte':
            $check = array(self::_C_BOOLEAN);
            $version = '629';
            $values[0] = self::getSign(!$values[0]);
            $format = '%smatte';
          break;

          //bool setImageProperty ( string $name , string $value )
          case 'setImageProperty':
            $check = array(self::_C_STRING, self::_C_STRING);
            $version = '632';
            $format = '-set \'%s\' \'%s\'';
          break;

          //bool commentImage ( string $comment )
          case 'commentImage':
            $check = array(self::_C_STRING);
            $version = '600';
            $format = '-comment \'%s\'';
          break;

          //bool setImageMatteColor ( mixed $matte )
          case 'setImageMatteColor':
            $check = array(self::_C_STRING);
            $version = '600';
            $format = '-mattecolor \'%s\'';
          break;

          //bool shadeImage ( bool $gray , float $azimuth , float $elevation )
          case 'shadeImage':
            $check = array(self::_C_BOOLEAN, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            $values[0] = self::getSign(!$values[0]);
            $format = '%sshade %sx%s';
          break;

          //bool shadowImage ( float $opacity , float $sigma , int $x , int $y )
          case 'shadowImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-shadow %sx%s+%s+%s';
          break;

          //bool sharpenImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'sharpenImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $values[2] = self::isFill($values, 2, self::CHANNEL_ALL);
            $format = '-sharpen %sx%s -channel %s';
          break;

          //bool shaveImage ( int $columns , int $rows )
          case 'shaveImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-shave %sx%s';
          break;

          //bool shearImage ( mixed $background , float $x_shear , float $y_shear )
          case 'shearImage':
            $check = array(self::_C_STRING, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-background \'%s\' -shear %sx%s';
          break;

          //bool sigmoidalContrastImage ( bool $sharpen , float $alpha , float $beta [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'sigmoidalContrastImage':
            $check = array(self::_C_BOOLEAN, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $values[0] = self::getSign(!$values[0]);
            $values[3] = self::isFill($values, 3, self::CHANNEL_ALL);
            $format = '%ssigmoidal-contrast %sx%s -channel %s';
          break;

          //bool sketchImage ( float $radius , float $sigma , float $angle )
          case 'sketchImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            $format = '-sketch %sx%s+%s';
          break;

          //bool solarizeImage ( int $threshold )
          case 'solarizeImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-solarize %s';
          break;

          //bool sparseColorImage ( int $SPARSE_METHOD , array $arguments [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case 'sparseColorImage':
            $check = array(self::_C_STRING, self::_C_ARRAY);
            $version = '645';
            //$values[3] = self::isFill($values, 3, self::CHANNEL_ALL);
            //TODO dodelat! -sparse-color method 'x,y color ...'
          break;

          //bool spliceImage ( int $width , int $height , int $x , int $y )
          case 'spliceImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $format = '-splice %sx%s+%s+%s';
          break;

          //bool spreadImage ( float $radius )
          case 'spreadImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-spread %s';
          break;

          //bool swirlImage ( float $degrees )
          case 'swirlImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $format = '-swirl %s';
          break;

          //bool thresholdImage ( float $threshold [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'thresholdImage':
            $check = array(self::_C_NUMERIC);
            $version = '600';
            $values[1] = self::isFill($values, 1, self::CHANNEL_ALL);
            $format = '-threshold %s -channel %s';
          break;

          //bool thumbnailImage ( int $columns , int $rows [, bool $bestfit = false [, bool $fill = false ]] )
          case 'thumbnailImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $columns = self::isFill($values, 0);
            $rows =  self::isFill($values, 1);
            $bestfit = self::getBestfitValue($values, 2, $columns, $rows);
            $values = array($columns, $rows, $bestfit);
            $format = '-thumbnail %sx%s%s';
          break;

          //bool tintImage ( mixed $tint , mixed $opacity )
          case 'tintImage':
            $check = array(self::_C_STRING, self::_C_NUMERIC);
            $version = '600';
            $format = '-fill \'%s\' -tint %s%%';
          break;

          //bool transposeImage ( void )
          case 'transposeImage':
            $check = array();
            $version = '629'; //ekv: -flip -rotate 90
            $format = '-transpose';
          break;

          //bool transverseImage ( void )
          case 'transverseImage':
            $check = array();
            $version = '629'; //ekv: -flop -rotate 90
            $format = '-transverse';
          break;

          //bool trimImage ( float $fuzz )
          case 'trimImage':
            $check = array(self::_C_NUMERIC);
            $version = '629';
            $format = '-trim -fuzz %s%%';
          break;

          //bool uniqueImageColors ( void )
          case 'uniqueImageColors':
            $check = array();
            $version = '629';
            $format = '-unique-colors';
          break;

          //bool unsharpMaskImage ( float $radius , float $sigma , float $amount , float $threshold [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'unsharpMaskImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '600';
            $values[4] = self::isFill($values, 4, self::CHANNEL_ALL);
            $format = '-unsharp %sx%s+%s+%s -channel %s';
          break;

          //bool vignetteImage ( float $blackPoint , float $whitePoint , int $x , int $y )
          case 'vignetteImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            $format = '-vignette %sx%s+%s+%s';
          break;

          //bool waveImage ( float $amplitude , float $length )
          case 'waveImage':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            $format = '-wave %sx%s';
          break;

/*
          case '':
          break;

    //public function transparent($color) {
      return $this->execConvert("-transparent '{$color}'");
    }

    //public function transparentColor($color) {
      return $this->execConvert("-transparent-color '{$color}'");
    }
*/
          default:
            echo sprintf('zadaná metoda <strong>%s</strong> není k dispozici!', $name);
            exit(1);
          break;
        }

        //typove kontroly
        foreach ($check as $index => $type) {
          $value = $parameters[$index];
          switch ($type) {
            case self::_C_NUMERIC: //kontrola na cisla
              if (!is_numeric($value)) {
                throw new ExceptionImagic(sprintf('zadana hodnota "%s" v metode <strong>%s</strong> neni ciselna!', $value, $name));
              }
            break;

            case self::_C_STRING:  //kontrola textu
              if (!is_string($value)) {
                throw new ExceptionImagic(sprintf('zadana hodnota "%s" v metode <strong>%s</strong> neni textova!', $value, $name));
              }
            break;

            case self::_C_BOOLEAN: //kontrola boolean
              if (!is_bool($value)) {
                throw new ExceptionImagic(sprintf('zadana hodnota "%s" v metode <strong>%s</strong> neni booleovska!', $value, $name));
              }
            break;

            case self::_C_ARRAY: //kontrola array
              if (!is_array($value)) {
                throw new ExceptionImagic(sprintf('zadana hodnota "%s" v metode <strong>%s</strong> neni pole!', $value, $name));
              }
            break;

            case self::_C_IMAGIC:  //kontrola instance Imagic
              if (!($value instanceof Imagic)) {
                throw new ExceptionImagic(sprintf('zadana hodnota v metode <strong>%s</strong> nepochazi ze tridy Imagic!', $name));
              }
            break;

            case self::_C_IMAGICDRAW:  //kontrola instance ImagicDraw
              if (!($value instanceof ImagicDraw)) {
                throw new ExceptionImagic(sprintf('zadana hodnota v metode <strong>%s</strong> nepochazi ze tridy ImagicDraw!', $name));
              }
            break;
          }
        }

        $task = array('name' => $name,
                      'cmd' => vsprintf($format, $values),
                      'cmdtype' => $cmdtype,
                      'format' => $format,
                      'values' => $values,
                      'version' => $version,
                      'done' => false,
                      );
//var_dump($task['cmd']);
        $this->picture->task[] = $task;
//var_dump($task['cmd']); //TODO taky zapinat debugem!!!!
      } catch (ExceptionImagic $e) {
        echo $e;
      }
      return $this;
    }
//------------------------------------------------------------------------------
//TODO tyto funkce nutne!!!!! dodelat!!!!
    public function getErrors() { //navrat generovanych chyb!!!
    }
//TODO i funkci getDebug()?
    public function enableDebug() {
    }

    public function getCmd() {
      return $this->picture->_debug['cmd'];
    }
//------------------------------------------------------------------------------
    private function executeCmd() {

      $final = 0;
      $count = 0;
      if (!empty($this->picture->task)) {

        $stream = $this->picture->_stream;

        if (file_exists($this->picture->path)) {
          //ze zdroje do streamu
          $this->setState(copy($this->picture->path, $stream), 100);
        }

//var_dump($this->picture->task);[name][cmd][cmdtype][format][values][version][done]

        $err = array();
        $count = count($this->picture->task);

        $cmdarray = array();
        $meziarray = array('convert');
        $cmdnexttype = NULL;

        foreach ($this->picture->task as $index => $task) {
          $cmd = $task['cmd'];
          $cmdtype = $task['cmdtype'];

          $nextindex = self::isFill($this->picture->task, $index + 1);
          if (!empty($nextindex)) {
            $cmdnexttype = $nextindex['cmdtype'];
          }

          if ($this->checkVersion($task['version'])) {
            switch ($cmdtype) {
              case self::_CMDTYPE_NORMAL:
                $meziarray[] = $cmd;
                //slouci pri zmene a nebo pri poslednim
                if ($cmdnexttype != $cmdtype ||
                    $count == ($index + 1)) {
                  $meziarray[] =  sprintf('\'%s\' \'%s\'', $stream, $stream);
                  $cmdarray[] = implode('    ', $meziarray);
                  $meziarray = array('convert');  //znovu nastaveni pole
                }
              break;

              case self::_CMDTYPE_SPECIAL:
                $cmdarray[] = sprintf('convert %s', $cmd);
              break;
            }

            $this->picture->task[$index]['done'] = true;
            $final++;
          } else { $err[] = sprintf('funkce: <strong>%s</strong>, není ve verzi %s obsažena!', $task['name'], $this->picture->version['versionNumber']); }

        }

//var_dump($cmdarray);
        $this->picture->_debug['cmd'] = $cmdarray;

        $allcmd = implode(PHP_EOL, $cmdarray);
        exec($allcmd, $stdout); //vykonani vsech prikazu zaraz

//TODO tento vypis zapinat pres nejakou metodu pro DEBUG!!!
//var_dump($allcmd);

        if (!empty($err)) {
          print_r($err);
        }

        if (!empty($stdout)) {
          print_r($stdout);
        }

      }
//FIXME dodelat osetreni stavu a vypis techto stavu!!!!
      if ($count == $final) {
        //ze streamu do destinace
        $this->setState(true, 101); //TODO jinak tady ty stavy?!!!!!

      } else {
        $this->setState(false, 102);
      }
    }

//TODO rozsirit tuto metodu i do ImagicDraw!!! ale az bude hotova __call !!!!!
//zjisetni optimalni (maximalni potrebne) verze Imagicu
    public function getMinimalVersion() {
      $result = 600;
      foreach ($this->picture->task as $task) {
        if ($task['version'] > $result) {
          $result = $task['version']; //pokud nelezne vetsi tak ho prepise
        }
      }
      return (int) $result;
    }
//------------------------------------------------------------------------------
    //redy - dle cisla vraci cislo v textu se znamenkem
    private static function getSignValue($value) {
      return sprintf('%s%s', ($value >= 0 ? '+' : '-'), $value);
    }

    //redy - dle bool vraci znamenka
    private static function getSign($value) {
      return ($value ? '+' : '-');
    }

    //redy - pokud je index v poli
    private static function isNull($array, $key, $default = '') {
      return (is_array($array) && array_key_exists($key, $array) ? $array[$key] : $default);
    }

    //redy - poluj je index v poli neprazdny
    private static function isFill($array, $key, $default = '') {
      return (!empty($array[$key]) ? $array[$key] : $default);
    }

    //redy - separace RGB barev (z 3 a 6 pismenych hex barev) na dec interpretaci
    public static function seraprateRGB($hex) {
      $result = NULL;
      if (!empty($hex)) {
        $_hex = str_split(substr($hex, 1)); //odebrani #
        switch (strlen($hex)) {
          case 3 + 1: //pro 3 znakove barvy
            foreach ($_hex as $val) {
              $result[] = hexdec($val.$val);
            }
          break;

          case 6 + 1: //pro 6 znakove barvy
            $_hex = array_chunk($_hex, 2);
            foreach ($_hex as $val) {
              $result[] = hexdec(implode('', $val));
            }
          break;
        }
      }
      return $result;
    }

    //redy - vraceni znamenka pro best-fit roztahovani obrazku
    private static function getBestfitValue($values, $index, $columns, $rows) {
      return (self::isFill($values, $index, false) ? '' : ($columns > 0 && $rows > 0 ? '!' : ''));
    }
//------------------------------------------------------------------------------
    //redy
    private function setState($state, $code) {
      if (!$state) {
        echo sprintf('neco je spatne?! vraceny kod: <strong>%s</strong> !', $code);
      }
    }

    //redy
    public function getState() {
      return $this->picture->state;
    }
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
    public static function isPicture($file, $type = array()) {
      //FIXME filtrovani na koncovky!
      //array('pdf', 'svg')
      $result = NULL;
      if (file_exists($file) && filesize($file) > 0) {
        exec(self::IDENTIFY_FORMAT.escapeshellarg($file), $ret);
        if (!empty($ret)) {
          $result = self::parseData($ret[0]); //zpracovani prvniho radku
        }
      }
      return (!empty($result));
    }
//------------------------------------------------------------------------------
    public function getImageBlob() {
      $result = NULL;
      $this->executeCmd();  //nachroustani prikazu

      if (!empty($this->picture->_stream)) {
        //probehla uprava
        $result = file_get_contents($this->picture->_stream);
      } else {
        //nic se nezmenilo
        $result = file_get_contents($this->picture->path);
      }

      return $result;
    }
//------------------------------------------------------------------------------

  }

  class ExceptionImagic extends Exception {}

  /**
   *
   * Library ImagickDraw
   *
   */
  final class ImagicDraw {
    private $draw = NULL;

    public function __construct() {
      $this->draw = new stdClass;
    }

    //pretezovani metod pro draw
    public function __call($name, $values) {
      try {
//FIXME dodelat zavislost na verzi imagicku!!!!

        $check = NULL;
        $format = NULL;
        $version = NULL;
        $cmdtype = self::_CMDTYPE_NORMAL;
//cmd/convert
        switch ($name) {
/*
          case '':
            $check = array(self::_C_NUMERIC, self::_C_NUMERIC);
            $version = '629';
            $format = '-adaptive-resize %sx%s%s';
          break;
*/
/*
          bool affine ( array $affine )
          bool annotation ( float $x , float $y , string $text )
          bool arc ( float $sx , float $sy , float $ex , float $ey , float $sd , float $ed )
          bool bezier ( array $coordinates )
          bool circle ( float $ox , float $oy , float $px , float $py )
          bool clear ( void )
          ImagickDraw clone ( void )
          bool color ( float $x , float $y , int $paintMethod )
          bool comment ( string $comment )
          bool composite ( int $compose , float $x , float $y , float $width , float $height , Imagick $compositeWand )
          ImagickDraw __construct ( void )
          bool destroy ( void )
          bool ellipse ( float $ox , float $oy , float $rx , float $ry , float $start , float $end )
          string getClipPath ( void )
          int getClipRule ( void )
          int getClipUnits ( void )
          ImagickPixel getFillColor ( void )
          float getFillOpacity ( void )
          int getFillRule ( void )
          string getFont ( void )
          string getFontFamily ( void )
          float getFontSize ( void )
          int getFontStyle ( void )
          int getFontWeight ( void )
          int getGravity ( void )
          bool getStrokeAntialias ( void )
          ImagickPixel getStrokeColor ( void )
          array getStrokeDashArray ( void )
          float getStrokeDashOffset ( void )
          int getStrokeLineCap ( void )
          int getStrokeLineJoin ( void )
          int getStrokeMiterLimit ( void )
          float getStrokeOpacity ( void )
          float getStrokeWidth ( void )
          int getTextAlignment ( void )
          bool getTextAntialias ( void )
          int getTextDecoration ( void )
          string getTextEncoding ( void )
          ImagickPixel getTextUnderColor ( void )
          string getVectorGraphics ( void )
          bool line ( float $sx , float $sy , float $ex , float $ey )
          bool matte ( float $x , float $y , int $paintMethod )
          bool pathClose ( void )
          bool pathCurveToAbsolute ( float $x1 , float $y1 , float $x2 , float $y2 , float $x , float $y )
          bool pathCurveToQuadraticBezierAbsolute ( float $x1 , float $y1 , float $x , float $y )
          bool pathCurveToQuadraticBezierRelative ( float $x1 , float $y1 , float $x , float $y )
          bool pathCurveToQuadraticBezierSmoothAbsolute ( float $x , float $y )
          bool pathCurveToQuadraticBezierSmoothRelative ( float $x , float $y )
          bool pathCurveToRelative ( float $x1 , float $y1 , float $x2 , float $y2 , float $x , float $y )
          bool pathCurveToSmoothAbsolute ( float $x2 , float $y2 , float $x , float $y )
          bool pathCurveToSmoothRelative ( float $x2 , float $y2 , float $x , float $y )
          bool pathEllipticArcAbsolute ( float $rx , float $ry , float $x_axis_rotation , bool $large_arc_flag , bool $sweep_flag , float $x , float $y )
          bool pathEllipticArcRelative ( float $rx , float $ry , float $x_axis_rotation , bool $large_arc_flag , bool $sweep_flag , float $x , float $y )
          bool pathFinish ( void )
          bool pathLineToAbsolute ( float $x , float $y )
          bool pathLineToHorizontalAbsolute ( float $x )
          bool pathLineToHorizontalRelative ( float $x )
          bool pathLineToRelative ( float $x , float $y )
          bool pathLineToVerticalAbsolute ( float $y )
          bool pathLineToVerticalRelative ( float $y )
          bool pathMoveToAbsolute ( float $x , float $y )
          bool pathMoveToRelative ( float $x , float $y )
          bool pathStart ( void )
          bool point ( float $x , float $y )
          bool polygon ( array $coordinates )
          bool polyline ( array $coordinates )
          bool pop ( void )
          bool popClipPath ( void )
          bool popDefs ( void )
          bool popPattern ( void )
          bool push ( void )
          bool pushClipPath ( string $clip_mask_id )
          bool pushDefs ( void )
          bool pushPattern ( string $pattern_id , float $x , float $y , float $width , float $height )
          bool rectangle ( float $x1 , float $y1 , float $x2 , float $y2 )
          bool render ( void )
          bool rotate ( float $degrees )
          bool roundRectangle ( float $x1 , float $y1 , float $x2 , float $y2 , float $rx , float $ry )
          bool scale ( float $x , float $y )
          bool setClipPath ( string $clip_mask )
          bool setClipRule ( int $fill_rule )
          bool setClipUnits ( int $clip_units )
          bool setFillAlpha ( float $opacity )
          bool setFillColor ( ImagickPixel $fill_pixel )
          bool setFillOpacity ( float $fillOpacity )
          bool setFillPatternURL ( string $fill_url )
          bool setFillRule ( int $fill_rule )
          ok - bool setFont ( string $font_name )
          bool setFontFamily ( string $font_family )
          ok - bool setFontSize ( float $pointsize )
          ok - bool setFontStretch ( int $fontStretch )
          ok - bool setFontStyle ( int $style )
          ok - bool setFontWeight ( int $font_weight )
          bool setGravity ( int $gravity )
          bool setStrokeAlpha ( float $opacity )
          bool setStrokeAntialias ( bool $stroke_antialias )
          bool setStrokeColor ( ImagickPixel $stroke_pixel )
          bool setStrokeDashArray ( array $dashArray )
          bool setStrokeDashOffset ( float $dash_offset )
          bool setStrokeLineCap ( int $linecap )
          bool setStrokeLineJoin ( int $linejoin )
          bool setStrokeMiterLimit ( int $miterlimit )
          bool setStrokeOpacity ( float $stroke_opacity )
          bool setStrokePatternURL ( string $stroke_url )
          bool setStrokeWidth ( float $stroke_width )
          bool setTextAlignment ( int $alignment )
          bool setTextAntialias ( bool $antiAlias )
          bool setTextDecoration ( int $decoration )
          bool setTextEncoding ( string $encoding )
          bool setTextUnderColor ( ImagickPixel $under_color )
          bool setVectorGraphics ( string $xml )
          ok - bool setViewbox ( int $x1 , int $y1 , int $x2 , int $y2 )
          ok - bool skewX ( float $degrees )
          ok - bool skewY ( float $degrees )
          ok - bool translate ( float $x , float $y )
*/
        }

      } catch (ExceptionImagicDraw $e) {
        echo $e;
      }
      return $this;
    }

//FIXME dodelat zbyvajici funkce a overit ktere spadaji pod cmd drawu a nebo convertu!!!
//a nasledne i ten pak predelat taky na fluent interface...! a overovani typu etc...
//a halvne tu zajistit aby v cmd bylo vsechno s '', totiz draw obaluje s "" !!!!
    public function getDataImagicDraw() {
      $convert = NULL;
      if (!empty($this->draw->convert)) {
        $convert = implode(' ', $this->draw->convert);
      }

      $cmd = NULL;
      if (!empty($this->draw->cmd)) {
        $cmd = implode(PHP_EOL, $this->draw->cmd);
      }
      return sprintf('%s -draw \'%s\'', $convert, $cmd);
    }

    public function annotation($x, $y, $text) {
      $this->draw->cmd[] = sprintf('text %s,%s "%s"', $x, $y, $text);
      return $this;
    }

    public function arc($sx, $sy, $ex, $ey, $sd, $ed) {
      $this->draw->cmd[] = sprintf('arc %s,%s %s,%s %s,%s', $sx, $sy, $ex, $ey, $sd, $ed);
      return $this;
    }
  //array(array(x, y), array(x, y))
    public function bezier($coordinates) {
      $row = array();
      foreach ($coordinates as $polozka) {
        $row[] = implode(',', $polozka);
      }
      $row = implode(' ', $row);
      $this->draw->cmd[] = sprintf('bezier %s', $row);
      return $this;
    }

    public function circle($ox, $oy, $px, $py) {
      $this->draw->cmd[] = sprintf('circle %s,%s %s,%s', $ox, $oy, $px, $py);
      return $this;
    }

    public function color($x, $y, $paintMethod) {
      $this->draw->cmd[] = sprintf('color %s,%s %s', $x, $y, $paintMethod);
      return $this;
    }

    public function ellipse($ox, $oy, $rx, $ry, $start, $end) {
      $this->draw->cmd[] = sprintf('ellipse %s,%s %s,%s %s,%s', $ox, $oy, $rx, $ry, $start, $end);
      return $this;
    }
  //image over 3,3 0,0 'terminal.gif'
    public function image($x, $y, $w, $h, $image) {
      //FIXME overovat existenci obrazku
      $this->draw->cmd[] = sprintf('image over %s,%s %s,%s "%s"', $x, $y, $w, $h, $image);
      return $this;
    }

    public function line($sx, $sy, $ex, $ey) {
      $this->draw->cmd[] = sprintf('line %s,%s %s,%s"', $sx, $sy, $ex, $ey);
      return $this;
    }
  //floodfill, reset
    public function matte($x, $y, $paintMethod) {
      $this->draw->cmd[] = sprintf('matte %s,%s %s', $x, $y, $paintMethod);
      return $this;
    }

    public function point($x, $y) {
      $this->draw->cmd[] = sprintf('point %s,%s', $x, $y);
      return $this;
    }

    public function polygon($coordinates) {
      $row = array();
      foreach ($coordinates as $polozka) {
        $row[] = implode(',', $polozka);
      }
      $row = implode(' ', $row);
      $this->draw->cmd[] = sprintf('polygon %s', $row);
      return $this;
    }

    public function polyline($coordinates) {
      $row = array();
      foreach ($coordinates as $polozka) {
        $row[] = implode(',', $polozka);
      }
      $row = implode(' ', $row);
      $this->draw->cmd[] = sprintf('polyline %s', $row);
      return $this;
    }

    public function rectangle($x1, $y1, $x2, $y2) {
      $this->draw->cmd[] = sprintf('rectangle %s,%s %s,%s', $x1, $y1, $x2, $y2);
      return $this;
    }

    public function rotate($degrees) {
      $this->draw->cmd[] = sprintf('rotate %s', $degrees);
      return $this;
    }

    public function roundRectangle($x1, $y1, $x2, $y2, $rx, $ry) {
      $this->draw->cmd[] = sprintf('roundrectangle %s,%s %s,%s %s,%s', $x1, $y1, $x2, $y2, $rx, $ry);
      return $this;
    }

    public function scale($x, $y) {
      $this->draw->cmd[] = sprintf('scale %s,%s', $x, $y);
      return $this;
    }

    public function setFillColor($fill_pixel) {
      $this->draw->convert[] = sprintf('-fill \'%s\'', $fill_pixel);
      return $this;
    }

    //setFillAlpha

    public function setFillOpacity($fillOpacity) {
      $this->draw->cmd[] = sprintf('fill-opacity %s', $fillOpacity);
      return $this;
    }

    public function setFont($font_name) {
      $this->draw->convert[] = sprintf('-font "%s"', $font_name);
      return $this;
    }

    public function setFontSize($pointsize) {
      $this->draw->convert[] = sprintf('-pointsize %s', $pointsize);
      return $this;
    }
//http://www.imagemagick.org/Usage/fonts/
//TODO k temto a ostatnim funkcim dodelat gettery!

    //bool ImagickDraw::setFontStretch ( int $fontStretch )
    public function setFontStretch($fontStretch) {
      $this->draw->convert[] = sprintf('-stretch %s', $fontStretch);
      return $this;
    }

    //bool ImagickDraw::setFontStyle ( int $style )
    public function setFontStyle($style) {
      $this->draw->convert[] = sprintf('-style %s', $style);
      return $this;
    }

/*
All	No effect.
Bold	Same as fontWeight = 700.
Bolder	Add 100 to font weight if currently ≤ 800.
Lighter	Subtract 100 to font weight if currently ≤ 100.
Normal	Same as fontWeight = 400.
*/
    //bool ImagickDraw::setFontWeight ( int $font_weight )
    public function setFontWeight($font_weight) { //~551
      $this->draw->convert[] = sprintf('-weight %s', $font_weight);
      return $this;
    }


//hustota pisma
    public function setTextKerning($kerning) {
      //6.4.7-8, -kerning XX
      $this->draw->convert[] = sprintf('-kerning %s', $kerning);
      return $this;
    }

//letter spacing
    public function setTextInterWordSpacing($spacing) {
      //v6.4.8-0, -interword-spacing XX
      $this->draw->convert[] = sprintf('-interword-spacing %s', $spacing);
      return $this;
    }

//line spacing
    public function setTextInterLineSpacing($spacing) {
      //v6.5.5-8, -interline-spacing XX
      $this->draw->convert[] = sprintf('-interline-spacing %s', $spacing);
      return $this;
    }

    public function setGravity($gravity) {
      $this->draw->convert[] = sprintf('-gravity %s', $gravity);
      return $this;
    }

    public function setStrokeColor($stroke_pixel) {
      $this->draw->convert[] = sprintf('-stroke "%s"', $stroke_pixel);
      return $this;
    }

    public function setStrokeDashArray($dashArray) {
      $row = implode(' ', $dashArray);
      $this->draw->cmd[] = sprintf('stroke-dasharray %s', $row);
      return $this;
    }

    public function setStrokeLineCap($linecap) {
      $this->draw->cmd[] = sprintf('stroke-linecap %s', $linecap);
      return $this;
    }

    public function setStrokeLineJoin($linejoin) {
      $this->draw->cmd[] = sprintf('stroke-linejoin %s', $linejoin);
      return $this;
    }

    public function setStrokeMiterLimit($miterlimit) {
      $this->draw->cmd[] = sprintf('stroke-miterlimit %s', $miterlimit);
      return $this;
    }

    public function setStrokeOpacity($stroke_opacity) {
      $this->draw->cmd[] = sprintf('stroke-opacity %s', $stroke_opacity);
      return $this;
    }

    public function setStrokeWidth($stroke_width) {
      $this->draw->convert[] = sprintf('-strokewidth %s', $stroke_width);
      return $this;
    }

    public function setViewbox($x1, $y1, $x2, $y2) {
      $this->draw->cmd[] = sprintf('viewbox %s %s %s %s', $x1, $y1, $x2, $y2);
      return $this;
    }

    public function skewX($degrees) {
      $this->draw->cmd[] = sprintf('skewX %s', $degrees);
      return $this;
    }

    public function skewY($degrees) {
      $this->draw->cmd[] = sprintf('skewY %s', $degrees);
      return $this;
    }

    public function translate($x, $y) {
      $this->draw->cmd[] = sprintf('translate %s,%s', $x, $y);
      return $this;
    }

  }

  class ExceptionImagicDraw extends Exception {}

/*
Imagic Function Available:
--------------------------------------------------------------------------------
ok - bool adaptiveBlurImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_DEFAULT ] )
ok - bool adaptiveResizeImage ( int $columns , int $rows [, bool $bestfit = false ] )
ok - bool adaptiveSharpenImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_DEFAULT ] )
ok - bool adaptiveThresholdImage ( int $width , int $height , int $offset )
bool addImage ( Imagick $source )
bool addNoiseImage ( int $noise_type [, int $channel = Imagick::CHANNEL_DEFAULT ] )
bool affineTransformImage ( ImagickDraw $matrix )
bool animateImages ( string $x_server )
ok - bool annotateImage ( ImagickDraw $draw_settings , float $x , float $y , float $angle , string $text )
Imagick appendImages ( bool $stack )
Imagick averageImages ( void )
dep - bool blackThresholdImage ( mixed $threshold )
ok - bool blurImage ( float $radius , float $sigma [, int $channel ] )
ok - bool borderImage ( mixed $bordercolor , int $width , int $height )
ok - bool charcoalImage ( float $radius , float $sigma )
ok - bool chopImage ( int $width , int $height , int $x , int $y )
bool clear ( void )
dep - bool clipImage ( void )
dep - bool clipPathImage ( string $pathname , bool $inside )
Imagick clone ( void )
bool clutImage ( Imagick $lookup_table [, float $channel = Imagick::CHANNEL_DEFAULT ] )
Imagick coalesceImages ( void )
dep - bool colorFloodfillImage ( mixed $fill , float $fuzz , mixed $bordercolor , int $x , int $y )
ok! - bool colorizeImage ( mixed $colorize , mixed $opacity )
Imagick combineImages ( int $channelType )
ok - bool commentImage ( string $comment )
array compareImageChannels ( Imagick $image , int $channelType , int $metricType )
Imagick compareImageLayers ( int $method )
array compareImages ( Imagick $compare , int $metric )
ok - bool compositeImage ( Imagick $composite_object , int $composite , int $x , int $y [, int $channel = Imagick::CHANNEL_ALL ] )
ok - Imagick __construct ([ mixed $files ] )
ok - bool contrastImage ( bool $sharpen )
ok - bool contrastStretchImage ( float $black_point , float $white_point [, int $channel = Imagick::CHANNEL_ALL ] )
bool convolveImage ( array $kernel [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool cropImage ( int $width , int $height , int $x , int $y )
ok - bool cropThumbnailImage ( int $width , int $height )
Imagick current ( void )
ok - bool cycleColormapImage ( int $displace )
bool decipherImage ( string $passphrase )
Imagick deconstructImages ( void )
bool deleteImageArtifact ( string $artifact )
ok - bool deskewImage ( float $threshold )
ok - bool despeckleImage ( void )
ok - bool destroy ( void )
bool displayImage ( string $servername )
bool displayImages ( string $servername )
ok - bool distortImage ( int $method , array $arguments , bool $bestfit )
ok - bool drawImage ( ImagickDraw $draw )
ok - bool edgeImage ( float $radius )
ok - bool embossImage ( float $radius , float $sigma )
ok - bool encipherImage ( string $passphrase )
ok - bool enhanceImage ( void )
ok - bool equalizeImage ( void )
ok - bool evaluateImage ( int $op , float $constant [, int $channel = Imagick::CHANNEL_ALL ] )
array exportImagePixels ( int $x , int $y , int $width , int $height , string $map , int $STORAGE )
ok - bool extentImage ( int $width , int $height , int $x , int $y )
Imagick flattenImages ( void )
ok - bool flipImage ( void )
bool floodFillPaintImage ( mixed $fill , float $fuzz , mixed $target , int $x , int $y , bool $invert [, int $channel = Imagick::CHANNEL_DEFAULT ] )
ok - bool flopImage ( void )
ok - bool frameImage ( mixed $matte_color , int $width , int $height , int $inner_bevel , int $outer_bevel )
ok - bool functionImage ( int $function , array $arguments [, int $channel = Imagick::CHANNEL_DEFAULT ] )
ok - bool fxImage ( string $expression [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool gammaImage ( float $gamma [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool gaussianBlurImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_ALL ] )
dep - int getColorspace ( void )
int getCompression ( void )
int getCompressionQuality ( void )
dep - string getCopyright ( void )
dep - string getFilename ( void )
ok - string getFont ( void )
dep - string getFormat ( void )
dep - int getGravity ( void )
dep - string getHomeURL ( void )
ok - Imagick getImage ( void )
int getImageAlphaChannel ( void )
string getImageArtifact ( string $artifact )
ImagickPixel getImageBackgroundColor ( void )
ok - string getImageBlob ( void )
array getImageBluePrimary ( void )
ImagickPixel getImageBorderColor ( void )
int getImageChannelDepth ( int $channel )
float getImageChannelDistortion ( Imagick $reference , int $channel , int $metric )
float getImageChannelDistortions ( Imagick $reference , int $metric [, int $channel = Imagick::CHANNEL_DEFAULT ] )
array getImageChannelExtrema ( int $channel )
array getImageChannelKurtosis ([ int $channel = Imagick::CHANNEL_DEFAULT ] )
array getImageChannelMean ( int $channel )
array getImageChannelRange ( int $channel )
array getImageChannelStatistics ( void )
Imagick getImageClipMask ( void )
ImagickPixel getImageColormapColor ( int $index )
int getImageColors ( void )
ok - int getImageColorspace ( void )
int getImageCompose ( void )
int getImageCompression ( void )
int getCompressionQuality ( void )
ok - int getImageDelay ( void )
ok - int getImageDepth ( void )
ok - int getImageDispose ( void )
float getImageDistortion ( MagickWand $reference , int $metric )
array getImageExtrema ( void )
ok - string getImageFilename ( void )
ok - string getImageFormat ( void )
float getImageGamma ( void )
ok - array getImageGeometry ( void )
int getImageGravity ( void )
array getImageGreenPrimary ( void )
ok - int getImageHeight ( void )
array getImageHistogram ( void )
ok - int getImageIndex ( void )
int getImageInterlaceScheme ( void )
int getImageInterpolateMethod ( void )
int getImageIterations ( void )
ok - int getImageLength ( void )
string getImageMagickLicense ( void )
bool getImageMatte ( void )
ImagickPixel getImageMatteColor ( void )
int getImageOrientation ( void )
ok - array getImagePage ( void )
ImagickPixel getImagePixelColor ( int $x , int $y )
string getImageProfile ( string $name )
array getImageProfiles ([ string $pattern = "*" [, bool $only_names = true ]] )
ok - array getImageProperties ([ string $pattern = "*" [, bool $only_names = true ]] )
ok - string getImageProperty ( string $name )
array getImageRedPrimary ( void )
Imagick getImageRegion ( int $width , int $height , int $x , int $y )
int getImageRenderingIntent ( void )
array getImageResolution ( void )
string getImagesBlob ( void )
int getImageScene ( void )
ok - string getImageSignature ( void )
dep - int getImageSize ( void )
int getImageTicksPerSecond ( void )
float getImageTotalInkDensity ( void )
int getImageType ( void )
int getImageUnits ( void )
int getImageVirtualPixelMethod ( void )
array getImageWhitePoint ( void )
ok - int getImageWidth ( void )
int getInterlaceScheme ( void )
int getIteratorIndex ( void )
int getNumberImages ( void )
string getOption ( string $key )
string getPackageName ( void )
array getPage ( void )
ImagickPixelIterator getPixelIterator ( void )
ImagickPixelIterator getPixelRegionIterator ( int $x , int $y , int $columns , int $rows )
float getPointSize ( void )
array getQuantumDepth ( void )
array getQuantumRange ( void )
string getReleaseDate ( void )
int getResource ( int $type )
int getResourceLimit ( int $type )
array getSamplingFactors ( void )
array getSize ( void )
int getSizeOffset ( void )
ok - array getVersion ( void )
bool haldClutImage ( Imagick $clut [, int $channel = Imagick::CHANNEL_DEFAULT ] )
ok - bool hasNextImage ( void )
ok - bool hasPreviousImage ( void )
ok - array identifyImage ([ bool $appendRawOutput = false ] )
ok - bool implodeImage ( float $radius )
bool importImagePixels ( int $x , int $y , int $width , int $height , string $map , int $storage , array $pixels )
bool labelImage ( string $label )
bool levelImage ( float $blackPoint , float $gamma , float $whitePoint [, int $channel = Imagick::CHANNEL_ALL ] )
bool linearStretchImage ( float $blackPoint , float $whitePoint )
dep - bool liquidRescaleImage ( int $width , int $height , float $delta_x , float $rigidity )
ok! - bool magnifyImage ( void )
bool mapImage ( Imagick $map , bool $dither )
dep - bool matteFloodfillImage ( float $alpha , float $fuzz , mixed $bordercolor , int $x , int $y )
ok - bool medianFilterImage ( float $radius )
bool mergeImageLayers ( int $layer_method )
ok - bool minifyImage ( void )
ok - bool modulateImage ( float $brightness , float $saturation , float $hue )
Imagick montageImage ( ImagickDraw $draw , string $tile_geometry , string $thumbnail_geometry , int $mode , string $frame )
Imagick morphImages ( int $number_frames )
Imagick mosaicImages ( void )
ok - bool motionBlurImage ( float $radius , float $sigma , float $angle [, int $channel = Imagick::CHANNEL_DEFAULT ] )
ok - bool negateImage ( bool $gray [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool newImage ( int $cols , int $rows , mixed $background [, string $format ] )
ok - bool newPseudoImage ( int $columns , int $rows , string $pseudoString )
ok - bool nextImage ( void )
ok - bool normalizeImage ([ int $channel = Imagick::CHANNEL_ALL ] )
ok - bool oilPaintImage ( float $radius )
bool opaquePaintImage ( mixed $target , mixed $fill , float $fuzz , bool $invert [, int $channel = Imagick::CHANNEL_DEFAULT ] )
bool optimizeImageLayers ( void )
bool orderedPosterizeImage ( string $threshold_map [, int $channel = Imagick::CHANNEL_ALL ] )
bool paintFloodfillImage ( mixed $fill , float $fuzz , mixed $bordercolor , int $x , int $y [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool paintOpaqueImage ( mixed $target , mixed $fill , float $fuzz [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool paintTransparentImage ( mixed $target , float $alpha , float $fuzz )
bool pingImage ( string $filename )
bool pingImageBlob ( string $image )
bool pingImageFile ( resource $filehandle [, string $fileName ] )
ok - bool polaroidImage ( ImagickDraw $properties , float $angle )
ok - bool posterizeImage ( int $levels , bool $dither )
ok! - bool previewImages ( int $preview )
ok - bool previousImage ( void )
bool profileImage ( string $name , string $profile )
bool quantizeImage ( int $numberColors , int $colorspace , int $treedepth , bool $dither , bool $measureError )
bool quantizeImages ( int $numberColors , int $colorspace , int $treedepth , bool $dither , bool $measureError )
array queryFontMetrics ( ImagickDraw $properties , string $text [, bool $multiline ] )
array queryFonts ([ string $pattern = "*" ] )
array queryFormats ([ string $pattern = "*" ] )
bool radialBlurImage ( float $angle [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool raiseImage ( int $width , int $height , int $x , int $y , bool $raise )
ok - bool randomThresholdImage ( float $low , float $high [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool readImage ( string $filename )
bool readImageBlob ( string $image [, string $filename ] )
bool readImageFile ( resource $filehandle [, string $fileName = null ] )
bool recolorImage ( array $matrix )
ok - bool reduceNoiseImage ( float $radius )
bool remapImage ( Imagick $replacement , int $DITHER )
bool removeImage ( void )
string removeImageProfile ( string $name )
bool render ( void )
ok! - bool resampleImage ( float $x_resolution , float $y_resolution , int $filter , float $blur )
bool resetImagePage ( string $page )
ok - bool resizeImage ( int $columns , int $rows , int $filter , float $blur [, bool $bestfit = false ] )
ok - bool rollImage ( int $x , int $y )
ok - bool rotateImage ( mixed $background , float $degrees )
ok - bool roundCorners ( float $x_rounding , float $y_rounding [, float $stroke_width = 10 [, float $displace = 5 [, float $size_correction = -6 ]]] )
ok - bool sampleImage ( int $columns , int $rows )
ok - bool scaleImage ( int $cols , int $rows [, bool $bestfit = false ] )
bool segmentImage ( int $COLORSPACE , float $cluster_threshold , float $smooth_threshold [, bool $verbose = false ] )
ok - bool separateImageChannel ( int $channel )
ok - bool sepiaToneImage ( float $threshold )
bool setBackgroundColor ( mixed $background )
bool setColorspace ( int $COLORSPACE )
bool setCompression ( int $compression )
bool setCompressionQuality ( int $quality )
bool setFilename ( string $filename )
bool setFirstIterator ( void )
ok - bool setFont ( string $font )
bool setFormat ( string $format )
bool setGravity ( int $gravity )
ok - bool setImage ( Imagick $replace )
bool setImageAlphaChannel ( int $mode )
bool setImageArtifact ( string $artifact , string $value )
bool setImageBackgroundColor ( mixed $background )
bool setImageBias ( float $bias )
bool setImageBluePrimary ( float $x , float $y )
bool setImageBorderColor ( mixed $border )
bool setImageChannelDepth ( int $channel , int $depth )
bool setImageClipMask ( Imagick $clip_mask )
bool setImageColormapColor ( int $index , ImagickPixel $color )
ok - bool setImageColorspace ( int $colorspace )
bool setImageCompose ( int $compose )
bool setImageCompression ( int $compression )
ok - bool setImageCompressionQuality ( int $quality )
ok - bool setImageDelay ( int $delay )
ok - bool setImageDepth ( int $depth )
ok - bool setImageDispose ( int $dispose )
bool setImageExtent ( int $columns , int $rows )
ok - bool setImageFilename ( string $filename )
ok - bool setImageFormat ( string $format )
bool setImageGamma ( float $gamma )
bool setImageGravity ( int $gravity )
bool setImageGreenPrimary ( float $x , float $y )
ok - bool setImageIndex ( int $index )
bool setImageInterlaceScheme ( int $interlace_scheme )
bool setImageInterpolateMethod ( int $method )
bool setImageIterations ( int $iterations )
ok - bool setImageMatte ( bool $matte )
ok - bool setImageMatteColor ( mixed $matte )
bool setImageOpacity ( float $opacity )
bool setImageOrientation ( int $orientation )
ok - bool setImagePage ( int $width , int $height , int $x , int $y )
bool setImageProfile ( string $name , string $profile )
ok - bool setImageProperty ( string $name , string $value )
bool setImageRedPrimary ( float $x , float $y )
bool setImageRenderingIntent ( int $rendering_intent )
bool setImageResolution ( float $x_resolution , float $y_resolution )
bool setImageScene ( int $scene )
bool setImageTicksPerSecond ( int $ticks_per-second )
bool setImageType ( int $image_type )
bool setImageUnits ( int $units )
bool setImageVirtualPixelMethod ( int $method )
bool setImageWhitePoint ( float $x , float $y )
bool setInterlaceScheme ( int $interlace_scheme )
bool setIteratorIndex ( int $index )
bool setLastIterator ( void )
bool setOption ( string $key , string $value )
bool setPage ( int $width , int $height , int $x , int $y )
bool setPointSize ( float $point_size )
bool setResolution ( float $x_resolution , float $y_resolution )
bool setResourceLimit ( int $type , int $limit )
bool setSamplingFactors ( array $factors )
bool setSize ( int $columns , int $rows )
bool setSizeOffset ( int $columns , int $rows , int $offset )
bool setType ( int $image_type )
ok - bool shadeImage ( bool $gray , float $azimuth , float $elevation )
ok - bool shadowImage ( float $opacity , float $sigma , int $x , int $y )
ok - bool sharpenImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool shaveImage ( int $columns , int $rows )
ok - bool shearImage ( mixed $background , float $x_shear , float $y_shear )
ok - bool sigmoidalContrastImage ( bool $sharpen , float $alpha , float $beta [, int $channel = Imagick::CHANNEL_ALL ] )
ok - bool sketchImage ( float $radius , float $sigma , float $angle )
ok - bool solarizeImage ( int $threshold )
bool sparseColorImage ( int $SPARSE_METHOD , array $arguments [, int $channel = Imagick::CHANNEL_DEFAULT ] )
ok - bool spliceImage ( int $width , int $height , int $x , int $y )
ok - bool spreadImage ( float $radius )
Imagick steganoImage ( Imagick $watermark_wand , int $offset )
bool stereoImage ( Imagick $offset_wand )
bool stripImage ( void )
ok - bool swirlImage ( float $degrees )
bool textureImage ( Imagick $texture_wand )
bool thresholdImage ( float $threshold [, int $channel = Imagick::CHANNEL_ALL ] )
ok! - bool thumbnailImage ( int $columns , int $rows [, bool $bestfit = false [, bool $fill = false ]] )
ok - bool tintImage ( mixed $tint , mixed $opacity )
Imagick transformImage ( string $crop , string $geometry )
bool transparentPaintImage ( mixed $target , float $alpha , float $fuzz , bool $invert )
ok - bool transposeImage ( void )
ok - bool transverseImage ( void )
ok - bool trimImage ( float $fuzz )
ok - bool uniqueImageColors ( void )
ok - bool unsharpMaskImage ( float $radius , float $sigma , float $amount , float $threshold [, int $channel = Imagick::CHANNEL_ALL ] )
bool valid ( void )
ok - bool vignetteImage ( float $blackPoint , float $whitePoint , int $x , int $y )
ok - bool waveImage ( float $amplitude , float $length )
dep - bool whiteThresholdImage ( mixed $threshold )
ok - bool writeImage ([ string $filename ] )
bool writeImageFile ( resource $filehandle )
bool writeImages ( string $filename , bool $adjoin )
bool writeImagesFile ( resource $filehandle )
--------------------------------------------------------------------------------
ImagicDraw Function Available:
--------------------------------------------------------------------------------
bool affine ( array $affine )
bool annotation ( float $x , float $y , string $text )
bool arc ( float $sx , float $sy , float $ex , float $ey , float $sd , float $ed )
bool bezier ( array $coordinates )
bool circle ( float $ox , float $oy , float $px , float $py )
bool clear ( void )
ImagickDraw clone ( void )
bool color ( float $x , float $y , int $paintMethod )
bool comment ( string $comment )
bool composite ( int $compose , float $x , float $y , float $width , float $height , Imagick $compositeWand )
ImagickDraw __construct ( void )
bool destroy ( void )
bool ellipse ( float $ox , float $oy , float $rx , float $ry , float $start , float $end )
string getClipPath ( void )
int getClipRule ( void )
int getClipUnits ( void )
ImagickPixel getFillColor ( void )
float getFillOpacity ( void )
int getFillRule ( void )
string getFont ( void )
string getFontFamily ( void )
float getFontSize ( void )
int getFontStyle ( void )
int getFontWeight ( void )
int getGravity ( void )
bool getStrokeAntialias ( void )
ImagickPixel getStrokeColor ( void )
array getStrokeDashArray ( void )
float getStrokeDashOffset ( void )
int getStrokeLineCap ( void )
int getStrokeLineJoin ( void )
int getStrokeMiterLimit ( void )
float getStrokeOpacity ( void )
float getStrokeWidth ( void )
int getTextAlignment ( void )
bool getTextAntialias ( void )
int getTextDecoration ( void )
string getTextEncoding ( void )
ImagickPixel getTextUnderColor ( void )
string getVectorGraphics ( void )
bool line ( float $sx , float $sy , float $ex , float $ey )
bool matte ( float $x , float $y , int $paintMethod )
bool pathClose ( void )
bool pathCurveToAbsolute ( float $x1 , float $y1 , float $x2 , float $y2 , float $x , float $y )
bool pathCurveToQuadraticBezierAbsolute ( float $x1 , float $y1 , float $x , float $y )
bool pathCurveToQuadraticBezierRelative ( float $x1 , float $y1 , float $x , float $y )
bool pathCurveToQuadraticBezierSmoothAbsolute ( float $x , float $y )
bool pathCurveToQuadraticBezierSmoothRelative ( float $x , float $y )
bool pathCurveToRelative ( float $x1 , float $y1 , float $x2 , float $y2 , float $x , float $y )
bool pathCurveToSmoothAbsolute ( float $x2 , float $y2 , float $x , float $y )
bool pathCurveToSmoothRelative ( float $x2 , float $y2 , float $x , float $y )
bool pathEllipticArcAbsolute ( float $rx , float $ry , float $x_axis_rotation , bool $large_arc_flag , bool $sweep_flag , float $x , float $y )
bool pathEllipticArcRelative ( float $rx , float $ry , float $x_axis_rotation , bool $large_arc_flag , bool $sweep_flag , float $x , float $y )
bool pathFinish ( void )
bool pathLineToAbsolute ( float $x , float $y )
bool pathLineToHorizontalAbsolute ( float $x )
bool pathLineToHorizontalRelative ( float $x )
bool pathLineToRelative ( float $x , float $y )
bool pathLineToVerticalAbsolute ( float $y )
bool pathLineToVerticalRelative ( float $y )
bool pathMoveToAbsolute ( float $x , float $y )
bool pathMoveToRelative ( float $x , float $y )
bool pathStart ( void )
bool point ( float $x , float $y )
bool polygon ( array $coordinates )
bool polyline ( array $coordinates )
bool pop ( void )
bool popClipPath ( void )
bool popDefs ( void )
bool popPattern ( void )
bool push ( void )
bool pushClipPath ( string $clip_mask_id )
bool pushDefs ( void )
bool pushPattern ( string $pattern_id , float $x , float $y , float $width , float $height )
bool rectangle ( float $x1 , float $y1 , float $x2 , float $y2 )
bool render ( void )
bool rotate ( float $degrees )
bool roundRectangle ( float $x1 , float $y1 , float $x2 , float $y2 , float $rx , float $ry )
bool scale ( float $x , float $y )
bool setClipPath ( string $clip_mask )
bool setClipRule ( int $fill_rule )
bool setClipUnits ( int $clip_units )
bool setFillAlpha ( float $opacity )
bool setFillColor ( ImagickPixel $fill_pixel )
bool setFillOpacity ( float $fillOpacity )
bool setFillPatternURL ( string $fill_url )
bool setFillRule ( int $fill_rule )
ok - bool setFont ( string $font_name )
bool setFontFamily ( string $font_family )
ok - bool setFontSize ( float $pointsize )
ok - bool setFontStretch ( int $fontStretch )
ok - bool setFontStyle ( int $style )
ok - bool setFontWeight ( int $font_weight )
bool setGravity ( int $gravity )
bool setStrokeAlpha ( float $opacity )
bool setStrokeAntialias ( bool $stroke_antialias )
bool setStrokeColor ( ImagickPixel $stroke_pixel )
bool setStrokeDashArray ( array $dashArray )
bool setStrokeDashOffset ( float $dash_offset )
bool setStrokeLineCap ( int $linecap )
bool setStrokeLineJoin ( int $linejoin )
bool setStrokeMiterLimit ( int $miterlimit )
bool setStrokeOpacity ( float $stroke_opacity )
bool setStrokePatternURL ( string $stroke_url )
bool setStrokeWidth ( float $stroke_width )
bool setTextAlignment ( int $alignment )
bool setTextAntialias ( bool $antiAlias )
bool setTextDecoration ( int $decoration )
bool setTextEncoding ( string $encoding )
bool setTextUnderColor ( ImagickPixel $under_color )
bool setVectorGraphics ( string $xml )
ok - bool setViewbox ( int $x1 , int $y1 , int $x2 , int $y2 )
ok - bool skewX ( float $degrees )
ok - bool skewY ( float $degrees )
ok - bool translate ( float $x , float $y )
--------------------------------------------------------------------------------
ok = redy, ok! = redy with edit, dep = deprecated
*/


/*
//TODO vytridit!!!!!!

    //public function clear() {
      //vymazani obsahu streamu, ale ne tempu!
      $this->obrazek->stream = NULL;
      $this->obrazek = NULL;
    }

  //klonovani
    //public function cloneImage() {
      //udela klon obrazku tim ze vytvori znovu sama sebe a vrati ukazatel
      $result = new self($this->obrazek->stream);
// melo by fungovat
      return $result;
    }

    //public function setImageAlphaChannel($mode) {
      //?????
      return $this->execConvert("-alpha {$mode}");
    }

    //public function setBackgroundColor($background) {
      return $this->execConvert("-background '{$background}'");
    }

  //Undefined, CMYK, Gray, HSB, HSL, HWB, Lab, OHTA, RGB, sRGB, Transparent, XYZ, YCbCr, YCC, YIQ, YPbPr, YUV
    //public function setImageColorSpace($colorspace) {
      return $this->execConvert("-colorspace {$colorspace}");
    }

    //public function setImageCompression($compression) {
      return $this->execConvert("-compress {$compression}");
    }

    //public function setImageCompressionQuality($quality = 75) {
      return $this->execConvert("-quality {$quality}");
    }

  //Red, Green, Blue, Alpha, Cyan, Magenta, Yellow, Black, Opacity, Index, RGB, RGBA, CMYK, CMYKA
    //public function setImageChannel($channel) {
      return $this->execConvert("-channel {$channel}");
    }

    //public function setImageDepth($depth) {
      return $this->execConvert("-depth {$depth}");
    }

  //Bilevel, Grayscale, GrayscaleMatte, Palette, PaletteMatte, TrueColor, TrueColorMatte, ColorSeparation, ColorSeparationMatte
    //public function setImageType($image_type) {
      return $this->execConvert("-type {$image_type}");
    }

  //Point, Hermite, Cubic, Box, Gaussian, Catrom, Triangle, Quadratic, Mitchell
    //public function setImageFilter($filter) {
      return $this->execConvert("-filter {$filter}");
    }

    //public function setGravity($gravity) {
      return $this->execConvert("-gravity {$gravity}");
    }

    //public function setPointSize($point_size) {
      return $this->execConvert("-pointsize {$point_size}");
    }
    *
This will take all of the source frames and will make them into one animated GIF image called animatespheres.gif. The -delay 20 argument will cause a 20 hundredths of a second delay between each frame, and the -loop 0 will cause the gif to loop over and over again.
convert   -delay 20   -loop 0   sphere*.gif   animatespheres.gif
* http://www.tjhsst.edu/~dhyatt/supercomp/n401a.html
*
* http://www.imagemagick.org/Usage/text/
*/
?>
