<?php
/*
 *      imagic.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 * Reimplement imagick libraries
 * 100% function garanteed on Linux
 * made by GFdesign for GoodFlowAdmin etc.
 * example using: http://eclecticdjs.com/mike/tutorials/php/imagemagick/
 * manual: http://www.php.net/manual/en/class.imagick.php
 * zpracovano s: Fluent Interfaces
 */

  /**
   *
   * Library Imagic
   *
   */
  final class Imagic {
    protected $picture; //hlavni instance
    const TEMPDIR = '.tmp';
    const IMAGICPREFIX = 'tempimagic';
    //const IMAGICMIN = '6.5.0';

//get_loaded_extensions()
//extension_loaded()

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

    //internal cmdtype
    const _CMDTYPE_NORMAL = 'normal';
    const _CMDTYPE_SPECIAL = 'special';

//------------------------------------------------------------------------------
    //redy
    public function __construct($files = NULL) {
      try {
        $this->picture = new stdClass();
        $this->picture->path = NULL;
        $this->picture->format = NULL;
        $this->picture->size = NULL;
        $this->picture->geometry = NULL;
        $this->picture->task = NULL;
        $this->picture->compress = NULL;
        $this->picture->font = NULL;
        $this->picture->delay = 0;
        $this->picture->temp_path = '.';
        $this->picture->state = true;
        $this->picture->version = self::getVersion();
        $this->picture->_stream = NULL; //pro uklizeni streamu
        $this->picture->_remove = array();  //pro uklid prebytku
        $this->picture->_debug = array();

        //nacteni obrazku do temp souboru
        if (!empty($files)) {
          if (is_array($files)) {
           //TODO muze nacitat i pole cest?????!!!
          } else {

            if (file_exists($files)) {
              $this->getIdentify($files); //nacteni identifikace
            } else { throw new ExceptionImagic($files); }
          }
        }

        if (is_writable($this->picture->temp_path)) {
          $this->getTempFile();  //nacteni streamu, pokud jde tedy zapisovat
        }

      } catch (ExceptionImagic $e) {
        echo sprintf('obrazek %s neexistuje!', $e->getMessage());
      }
    }

    //redy
    public function __destruct() {
      $this->destroy();
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
    }

//FIXME dodelat poradnou implementaci!
    public static function destroyTemp() {
      //pac temp se dokaze zaplnit i pri neuspesnem pokusu o vygeneorvani
      //kontrolovat dle data stari, max tak 24hodin stare mazat
/*
      $temp_path = $this->tempdir;
      $files = scandir($temp_path);
      if (!empty($files)) {
        foreach ($files as $file) {
          if ($file != '.' && $file != '..') {
            $path = sprintf('%s/%s', $temp_path, $file);
            //test jestli se zadarilo smazat
            unlink($path);
          }
        }
      }
*/
    }
//------------------------------------------------------------------------------
    //redy
    protected function getTempFile() {
      try {
//musi se volat az po nastaveni pathu!!!!
        $result = NULL;
        $path = sprintf('%s/%s', $this->picture->temp_path, self::TEMPDIR);

        //pokud se da zapisovat do pathe
        if (is_writable($this->picture->temp_path)) {
          if (!file_exists($path)) {
            if (!@mkdir($path)) {
              throw new ExceptionImagic(NULL, 100);
            }
          }

          if (!$result = tempnam($path, self::IMAGICPREFIX)) {
            throw new ExceptionImagic(NULL, 101);
          }

          $this->picture->_stream = $result;  //pro destruktor
        } else {
          throw new ExceptionImagic($this->picture->temp_path, 102);
        }

      } catch (ExceptionImagic $e) {
        switch ($e->getCode()) {
          case 100:
            echo 'nelze vytvorit adresar tempu!';
          break;

          case 101:
            echo 'nepodarilo se ziskat temp soubor';
          break;

          case 102:
            echo sprintf('nezle zapisovat do slozky: %s', $e->getMessage());
          break;
        }
      }

      return $result;
    }
//------------------------------------------------------------------------------
    //array getVersion ( void )
    public static function getVersion($key = NULL) {
      $version = exec('identify -version | head -n 1 | cut -c 10-');
      preg_match('/\d\.\d\.\d/', $version, $match);
      $result = array('versionNumber' => $match[0],
                      'versionInteger' => str_replace('.', '', $match[0]),
                      'versionString' => $version);
      return (!empty($key) ? $result[$key] : $result);
    }
//------------------------------------------------------------------------------
    //redy
    protected function getIdentify($file) {

      if (file_exists($file) &&
          filesize($file) > 0) {
        $identifyexec = exec(sprintf('identify \'%s\'', $file));
        $filestrlen = mb_strlen($file);
        $identifysubstr = mb_substr($identifyexec, $filestrlen + 1);
        $identifyexplode = explode(' ', $identifysubstr);
        //exec(sprintf('identify -verbose %s', $file), $identify_verbose);
      } else {
        echo 'smazis se zase nacist neexistujici a nebo prazdny obrazek!';
        var_dump($file, $this->picture);
        exit(1);
      }

      $this->picture->path = $file;
      $this->picture->format = $identifyexplode[0];
//TODO kdyby blbnulo tak by se pouzije identify -verbose %s
      $size_split = preg_split('/x|\+/', $identifyexplode[1]);
      $this->picture->size = array ('width' => (int) $size_split[0],
                                    'height' => (int) $size_split[1]);

      $geometry_split = preg_split('/x|\+/', $identifyexplode[2]);
      $this->picture->geometry = array ('width' => (int) $geometry_split[0],
                                        'height' => (int) $geometry_split[1],
                                        'x' => (int) $geometry_split[2],
                                        'y' => (int) $geometry_split[3]);
      //$this->picture->verbose = $identify_verbose;
    }

    //array identifyImage ([ bool $appendRawOutput = false ] )
    public function identifyImage($appendRawOutput = false) {
      $result = array();
      exec(sprintf('identify -verbose \'%s\'', $this->picture->path), $identifyverbose);

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
        $result['rawOutput'] = implode("\n", $identifyverbose);
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
      return $this->picture->size;
    }
//------------------------------------------------------------------------------
    //array getImagePage ( void )
    public function getImagePage() {
      return $this->picture->geometry;
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
      return $this->picture->size['height'];
    }
//------------------------------------------------------------------------------
    //int getImageWidth ( void )
    public function getImageWidth() {
      return $this->picture->size['width'];
    }
//------------------------------------------------------------------------------
    //int getImageDelay ( void )
    public function getImageDelay() {
      return $this->picture->delay;
    }
//FIXME pozor musi se zadavat k jednotlivim obrazkum!!!! pri retezovem zpracovani!
//neaplikovano! zaimplementovat!!
    //bool setImageDelay ( int $delay )
    public function setImageDelay($delay) {
      $this->picture->delay = $delay;
      return $this;
    }
//------------------------------------------------------------------------------
    //int getCompression ( void )
    public function getCompression() {
      return $this->picture->compress;
    }

    //bool setCompression ( int $compression )
    public function setCompression($compression) {
      $this->picture->compress = $compression;
      return $this;
    }
//------------------------------------------------------------------------------
    //Imagick getImage ( void )
    public function getImage() {
      return file_get_contents($this->picture->_stream);
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

      return $this;
    }

    //bool writeImage ([ string $filename ] )
    public function writeImage($filename = NULL) {

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
            exec(sprintf('convert \'%s\' \'%s\'', $this->picture->path, $filename));
          } else {
            copy($this->picture->path, $filename);
          }

        } else {
          copy($this->picture->_stream, $filename);
        }

        $this->getIdentify($filename); //nacteni identifikace

      } else {

        if (!empty($this->picture->path)) {
          $filename = $this->picture->path;

          copy($this->picture->_stream, $filename);
          //exec(sprintf('convert \'%s\' \'%s\'', $this->picture->_stream, $filename));
//FIXME udelat spravny konvert na format!!!!?!
          $this->getIdentify($filename); //nacteni identifikace

        } else {
          echo 'nemuzes zapsat obrazek ktery se nijak nejmenuje!!';
          exit(1);
        }
      }

      return $this;
    }
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
    const _CHECH_ARRAY = 'array';
    const _CHECK_BOOLEAN = 'boolean';
    const _CHECK_IMAGIC = 'Imagic';
    const _CHECK_IMAGICDRAW = 'ImagicDraw';
    const _CHECK_NUMERIC = 'numeric';
    const _CHECK_STRING = 'string';

    //pretezovana metoda pro efekty
    public function __call($name, $values) {
      try {

        if (empty($this->picture->_stream)) {
          $this->getTempFile();  //nacteni streamu, pokud neexistuje
        }

        $parameters = $values;
//FIXME predelat typy na konstanty!!!!
        $check = NULL;
        $format = NULL;
        $version = NULL;
        $cmdtype = self::_CMDTYPE_NORMAL;
        switch ($name) {

          //bool adaptiveBlurImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case 'adaptiveBlurImage':
            $check = array('numeric', 'numeric');
            $version = '629';
            switch (count($values)) {
              case 2: $format = '-adaptive-blur %sx%s'; break;
              case 3: $format = '-adaptive-blur %sx%s -channel %s'; break;
            }
          break;

          //bool adaptiveResizeImage ( int $columns , int $rows [, bool $bestfit = false ] )
          case 'adaptiveResizeImage':
            $check = array('numeric', 'numeric');
            $version = '629';
            $columns = self::isFill($values, 0);
            $rows =  self::isFill($values, 1);
            $bestfit = self::getBestfitValue($values, 2, $columns, $rows);
            $values = array($columns, $rows, $bestfit);
            $format = '-adaptive-resize %sx%s%s';
          break;

          //bool adaptiveSharpenImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case 'adaptiveSharpenImage':
            $check = array('numeric', 'numeric');
            $version = '629';
            switch (count($values)) {
              case 2: $format = '-adaptive-sharpen %sx%s'; break;
              case 3: $format = '-adaptive-sharpen %sx%s -channel %s'; break;
            }
          break;

          //bool adaptiveThresholdImage ( int $width , int $height , int $offset )
          case 'adaptiveThresholdImage':
            $check = array('numeric', 'numeric', 'numeric');
            $version = '600';
            $values[2] = self::getSignValue($values[2]);
            $format = '-lat %sx%s%s';
          break;

          //bool annotateImage ( ImagickDraw $draw_settings , float $x , float $y , float $angle , string $text )
          case 'annotateImage':
            $check = array('ImagicDraw', 'numeric', 'numeric', 'numeric', 'string');
            $version = '600';
            $draw = $values[0]->getDataImagicDraw();
            $x = $values[1];
            $y = $values[2];
            $angle = $values[3];
            $text = $values[4];
            $values = array($draw, $angle, $angle, $x, $y, $text);
            $format = '%s -annotate %sx%s+%s+%s "%s"';
          break;

          //bool blurImage ( float $radius , float $sigma [, int $channel ] )
          case 'blurImage':
            $check = array('numeric', 'numeric');
            $version = '600';
            switch (count($values)) {
              case 2: $format = '-blur %sx%s'; break;
              case 3: $format = '-blur %sx%s -channel %s'; break;
            }
          break;

          //bool borderImage ( mixed $bordercolor , int $width , int $height )
          case 'borderImage':
            $check = array('string', 'numeric', 'numeric');
            $version = '600';
            $format = '-bordercolor \'%s\' -border %sx%s';
          break;

          //bool charcoalImage ( float $radius , float $sigma )
          case 'charcoalImage':
            $check = array('numeric', 'numeric');
            $version = '600';
            $format = '-charcoal %sx%s';
          break;

          //bool chopImage ( int $width , int $height , int $x , int $y )
          case 'chopImage':
            $check = array('numeric', 'numeric', 'numeric', 'numeric');
            $version = '600';
            $format = '-chop %sx%s+%s+%s';
          break;

          //bool colorizeImage ( mixed $colorize , mixed $opacity )
          case 'colorizeImage':
            $check = array('string');
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
            $check = array('Imagic', 'string', 'numeric', 'numeric');
            $version = '600';
            $cmdtype = self::_CMDTYPE_SPECIAL;
            $composite_object = $values[0]->getDataImagic();
            $composite = $values[1];
            $x = $values[2];
            $y = $values[3];
            //convert -compose over -geometry +10+10 -composite out1.jpg pokus2.png out0.jpg
            //z -> vlozit -> do
            switch (count($values)) {
              case 4:
                $values = array($composite, $x, $y, $this->picture->_stream, $composite_object, $this->picture->_stream);
                $format = '-compose %s -geometry +%s+%s -composite \'%s\' \'%s\' \'%s\'';
              break;

              case 5:
                $values = array($composite, $x, $y, $values[4], $this->picture->_stream, $composite_object, $this->picture->_stream);
                $format = '-compose %s -geometry +%s+%s -channel %s -composite \'%s\' \'%s\' \'%s\'';
              break;
            }
          break;

          //bool contrastImage ( bool $sharpen )
          case 'contrastImage':
            $check = array('boolean');
            $version = '600';
            $values[0] = self::getSign(!$values[0]);
            $format = '%scontrast';
          break;

          //bool contrastStretchImage ( float $black_point , float $white_point [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'contrastStretchImage':
            $check = array('numeric', 'numeric');
            $version = '629';
            switch (count($values)) {
              case 2: $format = '-contrast-stretch %sx%s%%'; break;
              case 3: $format = '-contrast-stretch %sx%s%% -channel %s'; break;
            }
          break;

          //convolveImage

          //bool cropImage ( int $width , int $height , int $x , int $y )
          case 'cropImage':
            $check = array('numeric', 'numeric', 'numeric', 'numeric');
            $version = '600';
            $format = '-crop %sx%s+%s+%s';
          break;

          //bool cropThumbnailImage ( int $width , int $height )
          case 'cropThumbnailImage':
            $check = array('numeric', 'numeric');
            $version = '600';
            $width = $values[0];
            $height = $values[1];
            $values = array($width, $height, $width, $height);
            $format = '-thumbnail %sx%s^ -gravity center -extent %sx%s';
          break;

          //bool cycleColormapImage ( int $displace )
          case 'cycleColormapImage':
            $check = array('numeric');
            $version = '600';
            $format = '-cycle %s';
          break;

          //bool deskewImage ( float $threshold )
          case 'deskewImage':
            $check = array('numeric');
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
            $check = array('string', 'array', 'boolean');
            $version = '636';
            $method = $values[0];
            $arguments = $values[1];
            $bestfit = self::getSign($values[2]);
            $poc = 0;
            $row = NULL;
            //TODO optimalizovat!
            //4 hodnoty na radek! => X,X  X,X    X,X  X,X ...
            foreach ($arguments as $val) {
              if (($poc % 2) == 0) {
                $row .= $val.',';
              } else {
                $row .= $val.' ';
              }
              $poc++;
            }

            $values = array($bestfit, $method, $row);
            $format = '%sdistort %s \'%s\'';
          break;

          //bool drawImage ( ImagickDraw $draw )
          case 'drawImage':
            $check = array('ImagicDraw');
            $version = '600';
            $values[0] = $values[0]->getDataImagicDraw();
            $format = '%s';
          break;

          //bool edgeImage ( float $radius )
          case 'edgeImage':
            $check = array('numeric');
            $version = '600';
            $format = '-edge %s';
          break;

          //bool embossImage ( float $radius , float $sigma )
          case 'embossImage':
            $check = array('numeric', 'numeric');
            $version = '600';
            $format = '-emboss %sx%s';
          break;

          //bool encipherImage ( string $passphrase )
          case 'encipherImage':
            $check = array('string');
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
            $check = array('numeric', 'numeric');
            $version = '600';
            switch (count($values)) {
              case 2: $format = '-evaluate %s %s'; break;
              case 3: $format = '-evaluate %s %s -channel %s'; break;
            }
          break;

          //bool extentImage ( int $width , int $height , int $x , int $y )
          case 'extentImage':
            $check = array('numeric', 'numeric', 'numeric', 'numeric');
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
            $check = array('string', 'numeric', 'numeric', 'numeric', 'numeric');
            $version = '600';
            $format = '-mattecolor \'%s\' -frame %sx%s+%s+%s';
          break;

          //bool functionImage ( int $function , array $arguments [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case 'functionImage':
            $check = array('string', 'array');
            $version = '649';
            $values[1] = implode(',', $values[1]);
            switch (count($values)) {
              case 2: $format = '-function %s %s'; break;
              case 3: $format = '-function %s %s -channel %s'; break;
            }
          break;

          //bool fxImage ( string $expression [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'fxImage':
            $check = array('string');
            $version = '600';
            switch (count($values)) {
              case 1: $format = '-fx \'%s\''; break;
              case 2: $format = '-fx \'%s\' -channel %s'; break;
            }
          break;

          //bool gammaImage ( float $gamma [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'gammaImage':
            $check = array('numeric');
            $version = '600';
            switch (count($values)) {
              case 1: $format = '-gamma %s'; break;
              case 2: $format = '-gamma %s -channel %s'; break;
            }
          break;

          //bool gaussianBlurImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'gaussianBlurImage':
            $check = array('numeric', 'numeric');
            $version = '600';
            switch (count($values)) {
              case 2: $format = '-gaussian-blur %sx%s'; break;
              case 3: $format = '-gaussian-blur %sx%s -channel %s'; break;
            }
          break;

          //bool haldClutImage ( Imagick $clut [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case '':
            //TODO nastudovat a dodealt?!
          break;

          //bool implodeImage ( float $radius )
          case 'implodeImage':
            $check = array('numeric');
            $version = '600';
            $format = '-implode %s';
          break;

          //bool levelImage ( float $blackPoint , float $gamma , float $whitePoint [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'levelImage':
            $check = array('numeric', 'numeric', 'numeric');
            $version = '600';
            $blackPoint = $values[0];
            $gamma = $values[1];
            $whitePoint = $values[2];
            $values = array($blackPoint, $whitePoint, $gamma) + $values;
            switch (count($values)) {
              case 3: $format = '-level %s,%s,%s'; break;
              case 4: $format = '-level %s,%s,%s -channel %s'; break;
            }
          break;

          //bool linearStretchImage ( float $blackPoint , float $whitePoint )
          case 'linearStretchImage':
            $check = array('numeric', 'numeric');
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
            $check = array('numeric');
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
            $check = array('numeric', 'numeric', 'numeric');
            $version = '600';
            $format = '-modulate %s,%s,%s';
          break;

          //bool motionBlurImage ( float $radius , float $sigma , float $angle [, int $channel = Imagick::CHANNEL_DEFAULT ] )
          case 'motionBlurImage':
            $check = array('numeric', 'numeric', 'numeric');
            $version = '600';
            switch (count($values)) {
              case 3: $format = '-motion-blur %sx%s+%s'; break;
              case 4: $format = '-motion-blur %sx%s+%s -channel %s'; break;
            }
          break;

          //bool negateImage ( bool $gray [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'negateImage':
            $check = array('boolean');
            $version = '600';
            $values[0] = self::getSign($values[0]);
            switch (count($values)) {
              case 1: $format = '%snegate'; break;
              case 2: $format = '%snegate -channel %s'; break;
            }
          break;

          //bool newImage ( int $cols , int $rows , mixed $background [, string $format ] )
          case 'newImage':
            $check = array('numeric', 'numeric', 'string');
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
            $check = array('numeric', 'numeric', 'string');
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
            switch (count($values)) {
              case 0: $format = '-normalize'; break;
              case 1: $format = '-normalize -channel %s'; break;
            }
          break;

          //bool oilPaintImage ( float $radius )
          case 'oilPaintImage':
            $check = array('numeric');
            $version = '600';
            $format = '-paint %s';
          break;

          //bool paintOpaqueImage ( mixed $target , mixed $fill , float $fuzz [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'paintOpaqueImage':
            $check = array('string', 'string', 'numeric');
            $version = '600';
            $target = $values[0];
            $fill = $values[1];
            $fuzz = $values[2];
            $values = array($fuzz, $fill, $target) + $values;
            switch (count($values)) {
              case 3: $format = '-fuzz %s -fill \'%s\' -opaque \'%s\''; break;
              case 4: $format = '-fuzz %s -fill \'%s\' -opaque \'%s\' -channel %s'; break;
            }
          break;

          //bool paintTransparentImage ( mixed $target , float $alpha , float $fuzz )
          case 'paintTransparentImage':
            $check = array('string', 'numeric', 'numeric');
            $version = '600';
            $target = $values[0];
            $alpha = $values[1];
            $fuzz = $values[2];
            $values = array($fuzz, $alpha, $target);
            $format = '-fuzz %s -channel rgba -fill "rgba(0,0,0,%s)" -opaque \'%s\'';  // -transparent white
          break;

          //bool polaroidImage ( ImagickDraw $properties , float $angle )
          case 'polaroidImage':
            $check = array('ImagicDraw', 'numeric');
            $version = '632';
            $values[0] = $values[0]->getDataImagicDraw();
            $format = '%s -polaroid %s';
          break;

          //bool posterizeImage ( int $levels , bool $dither )
          case 'posterizeImage':
            $check = array('numeric', 'boolean');
            $version = '600';
            $values[1] = self::getSign(!$values[1]);
            $format = '-posterize %s %sdither Riemersma';
          break;

          //bool previewImages ( int $preview )
          case 'previewImages': //?!!
            $check = array('string');
            $version = '600';
            $format = '-preview %s';
          break;

          //bool radialBlurImage ( float $angle [, int $channel = Imagick::CHANNEL_ALL ] )
          case 'radialBlurImage':
            $check = array('numeric');
            $version = '600';
            switch (count($values)) {
              case 1: $format = '-radial-blur %s'; break;
              case 2: $format = '-radial-blur %s -channel %s'; break;
            }
          break;

          //bool raiseImage ( int $width , int $height , int $x , int $y , bool $raise )
          case 'raiseImage':
            $check = array('numeric', 'numeric', 'numeric', 'numeric', 'boolean');
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
            $check = array('numeric', 'numeric');
            $version = '629';
            switch (count($values)) {
              case 2: $format = '-random-threshold %sx%s'; break;
              case 3: $format = '-random-threshold %sx%s -channel %s'; break;
            }
          break;

          //bool reduceNoiseImage ( float $radius )
          case 'reduceNoiseImage':
            $check = array('numeric');
            $version = '600';
            $format = '-noise %s';
          break;

          //bool resampleImage ( float $x_resolution , float $y_resolution , int $filter , float $blur )
          case 'resampleImage':
            $check = array('numeric', 'numeric', 'string', 'numeric');
            $version = '600';
            $format = '-resample %sx%s -filter %s'; // -blur %s
          break;

          //bool resizeImage ( int $columns , int $rows , int $filter , float $blur [, bool $bestfit = false ] )
          case 'resizeImage':
            $check = array('numeric', 'numeric', 'string', 'numeric');
            $version = '600';
            $columns = self::isFill($values, 0);
            $rows =  self::isFill($values, 1);
            $bestfit = self::getBestfitValue($values, 4, $columns, $rows);
            $values = array($columns, $rows, $bestfit, $values[2], $values[3]);
            $format = '-resize %sx%s%s -filter %s -define filter:blur=%s';  //-blur %s.0%%
          break;

          //bool rollImage ( int $x , int $y )
          case 'rollImage':
            $check = array('numeric', 'numeric');
            $version = '600';
            $format = '-roll +%s+%s';
          break;

          //bool rotateImage ( mixed $background , float $degrees )
          case 'rotateImage':
            $check = array('string', 'numeric');
            $version = '600';
            $format = '-background \'%s\' -rotate %s';
          break;

          //bool roundCorners ( float $x_rounding , float $y_rounding [, float $stroke_width = 10 [, float $displace = 5 [, float $size_correction = -6 ]]] )
          case 'roundCorners':
            $check = array('numeric', 'numeric');
            $version = '629';
            $cmdtype = self::_CMDTYPE_SPECIAL;  //<--- pujde ale budou tam nejake ustupky!
            switch (count($values)) {
              //case 2: $format = '-fill blue -draw \'roundRectangle 0,0 100,100 15,15 stroke-width 10\''; break;
              //case 3: $format = '-random-threshold %sx%s -channel %s'; break;
            }
            //$format = '-fill blue -draw \'roundRectangle 0,0 200,200 50,50 stroke-width 10\' '.$this->picture->_stream.' -compose SrcIn -composite ';
//TODO tydy je konec, dodelat dopocitavani korekci atd...
            //stroke-width 1 ???
            $format = '\''.$this->picture->_stream.'\' -mattecolor black \( -size 450x281  xc:none -draw \'roundRectangle 1,1 448,279 50,50\' \) -compose DstIn -composite \''.$this->picture->_stream.'\'';
          break;

          case '':
          break;

          //bool setImageBackgroundColor ( mixed $background )
          case 'setImageBackgroundColor':
            $check = array('string');
            $version = '600';
            $format = '-background \'%s\'';
          break;

          //bool setImageVirtualPixelMethod ( int $method )
          case 'setImageVirtualPixelMethod':
            $check = array('string');
            $version = '600';
            $format = '-virtual-pixel %s';
          break;

          case '':
          break;

          case '':
          break;

          case '':
          break;

          //bool thumbnailImage ( int $columns , int $rows [, bool $bestfit = false [, bool $fill = false ]] )
          case 'thumbnailImage':
            $check = array('numeric', 'numeric');
            $version = '600';
            $columns = self::isFill($values, 0);
            $rows =  self::isFill($values, 1);
            $bestfit = self::getBestfitValue($values, 2, $columns, $rows);
            $values = array($columns, $rows, $bestfit);
            $format = '-thumbnail %sx%s%s';
          break;

          case '':
          break;

          default:
            echo sprintf('zadaná metoda <strong>%s</strong> není k dispozici!', $name);
            exit(1);
          break;
        }

        //typove kontroly
        foreach ($check as $index => $type) {
          $value = $parameters[$index];
          switch ($type) {
            case 'numeric': //kontrola na cisla
              if (!is_numeric($value)) {
                throw new ExceptionImagic($value, 100);
              }
            break;

            case 'string':  //kontrola textu
              if (!is_string($value)) {
                throw new ExceptionImagic($value, 101);
              }
            break;

            case 'boolean': //kontrola boolean
              if (!is_bool($value)) {
                throw new ExceptionImagic($value, 102);
              }
            break;

            case 'array': //kontrola array
              if (!is_array($value)) {
                throw new ExceptionImagic($value, 103);
              }
            break;

            case 'Imagic':  //kontrola instance Imagic
              if (!($value instanceof Imagic)) {
                throw new ExceptionImagic(NULL, 104);
              }
            break;

            case 'ImagicDraw':  //kontrola instance ImagicDraw
              if (!($value instanceof ImagicDraw)) {
                throw new ExceptionImagic(NULL, 105);
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

      } catch (ExceptionImagic $e) {
        $msg = $e->getMessage();
        switch ($e->getCode()) {
          case 100: //numeric
            echo sprintf('zadana hodnota "%s" v metode <strong>%s</strong> neni ciselna!', $msg, $name);
          break;

          case 101: //string
            echo sprintf('zadana hodnota "%s" v metode <strong>%s</strong> neni textova!', $msg, $name);
          break;

          case 102: //boolean
            echo sprintf('zadana hodnota "%s" v metode <strong>%s</strong> neni booleovska!', $msg, $name);
          break;

          case 103: //array
            echo sprintf('zadana hodnota "%s" v metode <strong>%s</strong> neni pole!', $msg, $name);
          break;

          case 104: //Imagic
            echo sprintf('zadana hodnota v metode <strong>%s</strong> nepochazi ze tridy Imagic!', $name);
          break;

          case 105: //ImagicDraw
            echo sprintf('zadana hodnota v metode <strong>%s</strong> nepochazi ze tridy ImagicDraw!', $name);
          break;
        }
      }
//var_dump($task['cmd']); //TODO taky zapinat debugem!!!!
/*
Imagick clone ( void )
public array exportImagePixels ( int $x , int $y , int $width , int $height , string $map , int $STORAGE )
Imagick flattenImages ( void )
*/
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
    protected function executeCmd() {

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

          if ($this->picture->version['versionInteger'] >= $task['version']) {

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

        $allcmd = implode("\n", $cmdarray);
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
        $this->setState(true, 101);

      } else {
        $this->setState(false, 102);
      }

    }
//------------------------------------------------------------------------------
    //redy
    protected static function getSignValue($value) {
      return sprintf('%s%s', ($value >= 0 ? '+' : '-'), $value);
    }

    //redy
    protected static function getSign($value) {
      return ($value ? '+' : '-');
    }

    //redy
    protected static function isFill($array, $key, $default = "") {
      return (!empty($array[$key]) ? $array[$key] : $default);
    }

    //redy
    protected static function seraprateRGB($hex) {
      $result = NULL;
      $hex = array_slice(str_split($hex), 1); //orezani #

      if (count($hex) == 6) { //slouceni po dvojcich a prevedeni cisla na dec
        $chunk = array_chunk($hex, 2);
        foreach ($chunk as $kod) {
          $result[] = hexdec(implode('', $kod));
        }
      }

      return $result;
    }

    //redy
    protected static function getBestfitValue($values, $index, $columns, $rows) {
      return (self::isFill($values, $index, false) ? '' : ($columns > 0 && $rows > 0 ? '!' : ''));
    }
//------------------------------------------------------------------------------
    //redy
    protected function setState($state, $code) {
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


































//TODO aplikace formatu u ukladani obrazku!
/*
    //public function getFormat($format) {
      return $this->obrazek->format;
    }

    //public function setFormat($format) {
      $this->obrazek->format = $format;
      return $this;
    }
*/

  /*
   * Imagick::displayImage
   * Imagick::readImageFile($filehandle)
   *
   **/


  /*
  //TODO append!?! nebo jen pro gify?
    public function addImage($source)
    {
      //$source
    }
  */
  //system("composite -compose {$composite} -geometry +{$x}+{$y} '{$composite_object}' '{$this->obrazek->stream}' '{$this->obrazek->stream}'", $result);

    public function clear() {
      //vymazani obsahu streamu, ale ne tempu!
      $this->obrazek->stream = NULL;
      $this->obrazek = NULL;
    }

  //klonovani
    public function cloneImage() {
      //udela klon obrazku tim ze vytvori znovu sama sebe a vrati ukazatel
      $result = new self($this->obrazek->stream);
//TODO melo by fungovat
      return $result;
    }



    public function getImageDepth() {
      $a = getimagesize($this->obrazek->stream);

      return $a["bits"];
    }

    public function getImageSize() {
      return filesize($this->obrazek->stream);
    }

    public function getImageMime() {
      $a = getimagesize($this->obrazek->stream);

      return $a["mime"];
    }

    public function sendImageHeader() {
      $a = getimagesize($this->obrazek->stream);

      header("content-type: {$a["mime"]}");
    }

    public function sampleImage($columns, $rows) {
      return $this->execConvert("-sample {$columns}x{$rows}\!");
    }

    public function sepiaToneImage($threshold) {
      return $this->execConvert("-sepia-tone {$threshold}%");
    }

    public function sigmoidalContrastImage($sharpen, $alpha, $beta) {
      $sharpen = ($sharpen ? "+" : "-");

      return $this->execConvert("{$sharpen}sigmoidal-contrast {$alpha}x{$beta}");
    }
//FIXME pridat volitelny parametr na vypnuty absolutni velikosti $absolutne = true
    public function scaleImage($columns, $rows) {
      $absolute = $this->absolutesize($columns, $rows);
      $columns = (!Empty($columns) ? $columns : "");
      $rows = (!Empty($rows) ? $rows : "");

      return $this->execConvert("-scale {$columns}x{$rows}{$absolute}");
    }
  //R, G, B
    public function separateImageChannel($channel) {
      return $this->execConvert("-channel {$channel} -separate");
    }

    public function selfCommandLine($command) {
      return $this->execConvert($command);
    }

    public function setImageAlphaChannel($mode) {
      //?????
      return $this->execConvert("-alpha {$mode}");
    }

    public function setBackgroundColor($background) {
      return $this->execConvert("-background '{$background}'");
    }


  //Undefined, CMYK, Gray, HSB, HSL, HWB, Lab, OHTA, RGB, sRGB, Transparent, XYZ, YCbCr, YCC, YIQ, YPbPr, YUV
    public function setImageColorSpace($colorspace) {
      return $this->execConvert("-colorspace {$colorspace}");
    }

    public function setImageCompression($compression) {
      return $this->execConvert("-compress {$compression}");
    }

    public function setImageCompressionQuality($quality = 75) {
      return $this->execConvert("-quality {$quality}");
    }

  //Red, Green, Blue, Alpha, Cyan, Magenta, Yellow, Black, Opacity, Index, RGB, RGBA, CMYK, CMYKA
    public function setImageChannel($channel) {
      return $this->execConvert("-channel {$channel}");
    }

    public function setImageDepth($depth) {
      return $this->execConvert("-depth {$depth}");
    }

  //Bilevel, Grayscale, GrayscaleMatte, Palette, PaletteMatte, TrueColor, TrueColorMatte, ColorSeparation, ColorSeparationMatte
    public function setImageType($image_type) {
      return $this->execConvert("-type {$image_type}");
    }

  //Point, Hermite, Cubic, Box, Gaussian, Catrom, Triangle, Quadratic, Mitchell
    public function setImageFilter($filter) {
      return $this->execConvert("-filter {$filter}");
    }

    public function setGravity($gravity) {
      return $this->execConvert("-gravity {$gravity}");
    }

    public function setImageMatteColor($matte) {
      return $this->execConvert("-mattecolor '{$matte}'");
    }

    public function setPointSize($point_size) {
      return $this->execConvert("-pointsize {$point_size}");
    }

    public function shadeImage($azimuth, $elevation) {
      //+/-!
      return $this->execConvert("-shade {$azimuth}x{$elevation}");
    }

    //shadowImage

    public function sharpenImage($radius, $sigma) {
      return $this->execConvert("-sharpen {$radius}x{$sigma}");
    }

    public function shaveImage($columns, $rows) {
      return $this->execConvert("-shave {$columns}x{$rows}");
    }

    public function shearImage($background, $x_shear, $y_shear) {
      return $this->execConvert("-background '{$background}' -shear {$x_shear}x{$y_shear}");
    }

    public function sketchImage($radius, $sigma, $angle) {
      return $this->execConvert("-sketch {$radius}x{$sigma}+{$angle}");
    }

    public function solarizeImage($threshold) {
      return $this->execConvert("-solarize {$threshold}");
    }

    public function spliceImage($width, $height, $x, $y) {
      return $this->execConvert("-splice {$width}x{$height}+{$x}+{$y}");
    }

    public function spreadImage($radius) {
      return $this->execConvert("-spread {$radius}");
    }

    public function swirlImage($degrees) {
      return $this->execConvert("-swirl {$degrees}");
    }

    public function thresholdImage($threshold, $channel = NULL) {
      $channel = (!Empty($channel) ? "-channel {$channel}" : "");

      return $this->execConvert("-threshold {$threshold}% {$channel}");
    }

    public function transparent($color) {
      return $this->execConvert("-transparent '{$color}'");
    }

    public function transparentColor($color) {
      return $this->execConvert("-transparent-color '{$color}'");
    }

    public function tintImage($tint, $opacity) {
      return $this->execConvert("-fill '{$tint}' -tint {$opacity}%");
    }

    public function transposeImage() {
      return $this->execConvert("-transpose");
    }

    public function transverseImage() {
      return $this->execConvert("-transverse");
    }

    public function trimImage($fuzz) {
      return $this->execConvert("-trim -fuzz {$fuzz}%");
    }

    public function unsharpMaskImage($radius, $sigma, $amount, $threshold) {
      return $this->execConvert("-unsharp {$radius}x{$sigma}+{$amount}+{$threshold}");
    }

    public function vignetteImage($radius, $sigma, $x, $y) {
      return $this->execConvert("-vignette {$radius}x{$sigma}+{$x}+{$y}%");
    }

    public function waveImage($amplitude, $length) {
      return $this->execConvert("-wave {$amplitude}x{$length}");
    }


  }

  class ExceptionImagic extends Exception {}

  /**
   *
   * Library ImagickDraw
   *
   */
  final class ImagicDraw {
    protected $draw = NULL;

    public function __construct() {
      $this->draw = new stdClass();
    }
//FIXME dodelat zbyvajici funkce a overit ktere spadaji pod cmd drawu a nebo convertu!!!
//a nasledne i ten pak predelat taky na fluent interface...! a overovani typu etc...
    public function getDataImagicDraw() {
      $convert = NULL;
      if (!empty($this->draw->convert)) {
        $convert = implode(' ', $this->draw->convert);
      }

      $cmd = NULL;
      if (!empty($this->draw->cmd)) {
        $cmd = implode("\n", $this->draw->cmd);
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
        $row[] = implode(",", $polozka);
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
      //FIXME overit existenci fontu?!
      $this->draw->convert[] = sprintf('-font "%s"', $font_name);
      return $this;
    }

    public function setFontSize($pointsize) {
      $this->draw->convert[] = sprintf('-pointsize %s', $pointsize);
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
      $this->draw->cmd[] = sprintf('stroke-width %s', $stroke_width);
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
Function Available:
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
dep - bool commentImage ( string $comment )
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
ok - int getCompression ( void )
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
string getImageBlob ( void )
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
int getImageColorspace ( void )
int getImageCompose ( void )
int getImageCompression ( void )
int getCompressionQuality ( void )
int getImageDelay ( void )
int getImageDepth ( void )
int getImageDispose ( void )
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
int getImageIndex ( void )
int getImageInterlaceScheme ( void )
int getImageInterpolateMethod ( void )
int getImageIterations ( void )
int getImageLength ( void )
string getImageMagickLicense ( void )
bool getImageMatte ( void )
ImagickPixel getImageMatteColor ( void )
int getImageOrientation ( void )
ok - array getImagePage ( void )
ImagickPixel getImagePixelColor ( int $x , int $y )
string getImageProfile ( string $name )
array getImageProfiles ([ string $pattern = "*" [, bool $only_names = true ]] )
array getImageProperties ([ string $pattern = "*" [, bool $only_names = true ]] )
string getImageProperty ( string $name )
array getImageRedPrimary ( void )
Imagick getImageRegion ( int $width , int $height , int $x , int $y )
int getImageRenderingIntent ( void )
array getImageResolution ( void )
string getImagesBlob ( void )
int getImageScene ( void )
string getImageSignature ( void )
int getImageSize ( void )
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
bool hasNextImage ( void )
bool hasPreviousImage ( void )
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
bool nextImage ( void )
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
bool previousImage ( void )
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
bool roundCorners ( float $x_rounding , float $y_rounding [, float $stroke_width = 10 [, float $displace = 5 [, float $size_correction = -6 ]]] )
bool sampleImage ( int $columns , int $rows )
bool scaleImage ( int $cols , int $rows [, bool $bestfit = false ] )
bool segmentImage ( int $COLORSPACE , float $cluster_threshold , float $smooth_threshold [, bool $verbose = false ] )
bool separateImageChannel ( int $channel )
bool sepiaToneImage ( float $threshold )
bool setBackgroundColor ( mixed $background )
bool setColorspace ( int $COLORSPACE )
ok - bool setCompression ( int $compression )
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
bool setImageColorspace ( int $colorspace )
bool setImageCompose ( int $compose )
bool setImageCompression ( int $compression )
bool setImageCompressionQuality ( int $quality )
bool setImageDelay ( int $delay )
bool setImageDepth ( int $depth )
bool setImageDispose ( int $dispose )
bool setImageExtent ( int $columns , int $rows )
ok - bool setImageFilename ( string $filename )
ok - bool setImageFormat ( string $format )
bool setImageGamma ( float $gamma )
bool setImageGravity ( int $gravity )
bool setImageGreenPrimary ( float $x , float $y )
bool setImageIndex ( int $index )
bool setImageInterlaceScheme ( int $interlace_scheme )
bool setImageInterpolateMethod ( int $method )
bool setImageIterations ( int $iterations )
bool setImageMatte ( bool $matte )
bool setImageMatteColor ( mixed $matte )
bool setImageOpacity ( float $opacity )
bool setImageOrientation ( int $orientation )
ok - bool setImagePage ( int $width , int $height , int $x , int $y )
bool setImageProfile ( string $name , string $profile )
bool setImageProperty ( string $name , string $value )
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
bool shadeImage ( bool $gray , float $azimuth , float $elevation )
bool shadowImage ( float $opacity , float $sigma , int $x , int $y )
bool sharpenImage ( float $radius , float $sigma [, int $channel = Imagick::CHANNEL_ALL ] )
bool shaveImage ( int $columns , int $rows )
bool shearImage ( mixed $background , float $x_shear , float $y_shear )
bool sigmoidalContrastImage ( bool $sharpen , float $alpha , float $beta [, int $channel = Imagick::CHANNEL_ALL ] )
bool sketchImage ( float $radius , float $sigma , float $angle )
bool solarizeImage ( int $threshold )
bool sparseColorImage ( int $SPARSE_METHOD , array $arguments [, int $channel = Imagick::CHANNEL_DEFAULT ] )
bool spliceImage ( int $width , int $height , int $x , int $y )
bool spreadImage ( float $radius )
Imagick steganoImage ( Imagick $watermark_wand , int $offset )
bool stereoImage ( Imagick $offset_wand )
bool stripImage ( void )
bool swirlImage ( float $degrees )
bool textureImage ( Imagick $texture_wand )
bool thresholdImage ( float $threshold [, int $channel = Imagick::CHANNEL_ALL ] )
ok! - bool thumbnailImage ( int $columns , int $rows [, bool $bestfit = false [, bool $fill = false ]] )
bool tintImage ( mixed $tint , mixed $opacity )
Imagick transformImage ( string $crop , string $geometry )
bool transparentPaintImage ( mixed $target , float $alpha , float $fuzz , bool $invert )
bool transposeImage ( void )
bool transverseImage ( void )
bool trimImage ( float $fuzz )
bool uniqueImageColors ( void )
bool unsharpMaskImage ( float $radius , float $sigma , float $amount , float $threshold [, int $channel = Imagick::CHANNEL_ALL ] )
bool valid ( void )
bool vignetteImage ( float $blackPoint , float $whitePoint , int $x , int $y )
bool waveImage ( float $amplitude , float $length )
dep - bool whiteThresholdImage ( mixed $threshold )
ok - bool writeImage ([ string $filename ] )
bool writeImageFile ( resource $filehandle )
bool writeImages ( string $filename , bool $adjoin )
bool writeImagesFile ( resource $filehandle )
--------------------------------------------------------------------------------
ok = redy, ok! = redy with edit, dep = deprecated
*/


//TODO takto
//header( "Content-Type: image/{$Imagick->getImageFormat()}" );
//echo $Imagick->getImageBlob( );

//gray scale: -fx '0.29900*R+0.58700*G+0.11400*B'
//-colorspace gray
//"blue", "#0000ff", "rgb(0,0,255)", "cmyk(100,100,100,10)"
?>
