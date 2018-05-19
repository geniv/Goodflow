<?php

/**
 *
 * Reimplementace imagick knihovny
 * made by GFdesign pro GoodFlowAdmin
 * programming by Geniv (geniv.radek@gmail.com)
 *
 */
class Imagic
{
  private $obrazek; //vnitrni ukazatel
  private $tempdir = ".tmp";  //slozka pro temp

/**
 *
 * Konstruktor tridy
 *
 * @param obr nazev obrazku pro nacteni
 */
  public function __construct($obr = NULL)
  {
    $result = true; //?!

    //vytvoreni lokalniho temp souboru
    $this->createTemp();

    //vytvoreni temp obrazku
    $this->obrazek->stream = tempnam($this->tempdir, "tempimagic");
    if (!file_exists($this->obrazek->stream))
    {
      echo "nebyl vytvoren temp soubor!";
      exit(1);
    }

    //nacteni obrazku do temp souboru
    if (file_exists($obr))
    {
      $this->obrazek->name = $obr;
      $result = copy($obr, $this->obrazek->stream);
    }

    return $result;
  }

  public function __get($var)
  {
    return $this->obrazek->$var;
  }

  private function createTemp()
  {
    if (!file_exists($this->tempdir) &&
        !mkdir($this->tempdir))
    {
      echo "neporadilo se vytvorit lokalni odkladaci slozku!";
      exit(1);
    }
  }

/**
 *
 * Nacte obrazek ze zadaneho souboru
 *
 * @param filename nazev obrazku
 * @return bool o provedeni akce
 */
  public function readImage($filename)
  {
    $result = false;
    if (file_exists($filename))
    { //pokud existuje napise si jmeno a zkopikuje do tempu
      $this->obrazek->name = $filename;
      $result = copy($filename, $this->obrazek->stream);
    }

    return $result;
  }

/**
 *
 * Ulozi obrazek do zadane cesty
 *
 * @param filename cesta k obrazku
 * @return bool o provedeni akce
 */
  public function writeImage($filename = NULL)
  {
    $result = false;
    if (is_null($filename))
    { //pokud neni pouzit nazev zapise do stejneho z ktereho cetl
      $filename = $this->obrazek->name;
    }

    if (!Empty($filename))
    { //pokud je nazev neprazdny
      $result = copy($this->obrazek->stream, $filename);
    }

    return $result;
  }
/*
 * Imagick::displayImage
 * Imagick::readImageFile($filehandle)
 *
 * Imagick::getImageFilename() - vraci nazev obrazku v sekvenci
 * Imagick::setImageFilename($filename) - nastavuje nazev obrazku v sekvenci
 **/

  public function adaptiveBlurImage($radius, $sigma)
  {
    return $this->execConvert("-adaptive-blur {$radius}x{$sigma}");
  }

  private function absolutesize($columns, $rows)
  {
    return ($columns > 0 && $rows > 0 ? "\!" : "");
  }

  public function adaptiveResizeImage($columns, $rows)
  {
    $absolute = $this->absolutesize($columns, $rows);
    $columns = (!Empty($columns) ? $columns : "");
    $rows = (!Empty($rows) ? $rows : "");

    return $this->execConvert("-adaptive-resize {$columns}x{$rows}{$absolute}");
  }

  public function adaptiveSharpenImage($radius, $sigma)
  {
    return $this->execConvert("-adaptive-sharpen {$radius}x{$sigma}");
  }

/*
//append!?!
  public function addImage($source)
  {
    //$source
  }
*/
//dodelat! clone?!!
  public function annotateImage($draw_settings, $x, $y, $angle, $text)
  {
    $draw = implode(" ", $draw_settings->draw);

    return $this->execConvert("-draw '{$draw}' -annotate {$angle}x{$angle}+{$x}+{$y} '{$text}'");
  }

  public function blurImage($radius, $sigma, $channel = NULL)
  {
    $channel = (!Empty($channel) ? "-channel {$channel}" : "");

    return $this->execConvert("-blur {$radius}x{$sigma} {$channel}");
  }

  public function borderImage($bordercolor, $width, $height)
  {
    return $this->execConvert("-bordercolor {$bordercolor} -border {$width}x{$height}");
  }

//efekt
  public function charcoalImage($radius, $sigma)
  {
    return $this->execConvert("-charcoal {$sigma}x{$radius}");
  }

/*
  public function chopImage($width, $height, $x, $y)
  { //dodelat?!
    return $this->execConvert("-chop {$width}x{$height} -gravity Center -region {$x}x{$y}");  // -gravity Center,South -region {$x}x{$y}
  }
*/
//system("composite -compose {$composite} -geometry +{$x}+{$y} '{$composite_object}' '{$this->obrazek->stream}' '{$this->obrazek->stream}'", $result);

//http://cz.php.net/manual/en/imagick.constants.php#imagick.constants.compositeop
//src, dst, clear,  xor, over, in, out, atop, dst_over, dst_in, dst_out, dst_atop
//http://www.imagemagick.org/Usage/compose/
//slouceni obrazku
  public function compositeImage($composite_object, $composite, $x, $y)
  { //return $this->execConvert("-compose {$composite} -geometry +{$x}+{$y} -composite '{$composite_object->stream}'");
    $pozice = (is_numeric($x) && is_numeric($y) ? "-geometry +{$x}+{$y}" : "-gravity {$x}");
    system("convert -compose {$composite} {$pozice} -composite '{$this->obrazek->stream}' '{$composite_object->stream}' '{$this->obrazek->stream}'", $result);

    return $result;
  }

  public function contrastImage($sharpen)
  {
    $sharpen = ($sharpen ? "+" : "-");
    return $this->execConvert("{$sharpen}contrast");
  }

  public function contrastStretchImage($black_point, $white_point)
  {
    return $this->execConvert("-contrast-stretch {$black_point}x{$white_point}%");
  }

  public function clear()
  { //vymazani obsahu streamu
    $this->obrazek->stream = NULL;
    $this->obrazek = NULL;
  }

//klonovani
  public function cloneImage()
  { //udela klon obrazku tim ze vytvori znovu sama sebe a vrati se ukazatel
    $result = new Imagic($this->obrazek->stream);

    return $result;
  }

//vysec obrazku
  public function cropImage($width, $height, $x, $y)
  {
    return $this->execConvert("-crop {$width}x{$height}+{$x}+{$y}");
  }

  public function colorFloodfillImage($fill, $fuzz, $bordercolor, $x, $y)
  {
    return $this->execConvert("-fill '{$fill}' -fuzz {$fuzz}% -floodfill +{$x}+{$y} '{$bordercolor}'");
  }
/*
  public function colorizeImage($colorize, $opacity)
  { //dodelat?!
    return $this->execConvert("-colorize '{$colorize}'"); //-fill '{$colorize}'
  }
*/

//ScaleRotateTranslate/SRT, Affine, AffineProjection, BilinearForward, BilinearReverse,
//Perspective, PerspectiveProjection, Arc, Polar, DePolar, Barrel, BarrelInverse, Shepards
  public function distortImage($method, $arguments)
  {
    return $this->execConvert("-distort {$method} '{$arguments}'");
  }

  public function despeckleImage()
  {
    return $this->execConvert("-despeckle");
  }

  public function destroy()
  {
    unlink($this->obrazek->stream); //smazani ukazatele
    unset($this->obrazek);  //odalokovani
  }

  public function drawImage($draw)
  {
    $draw = implode(" ", $draw->draw);

    return $this->execConvert("-draw '{$draw}'");
  }

  public function edgeImage($radius)
  {
    return $this->execConvert("-edge {$radius}");
  }

  public function evaluateImage($op, $value)
  {
    return $this->execConvert("-evaluate {$op} {$value}");
  }

  public function embossImage($radius, $sigma)
  {
    return $this->execConvert("-emboss {$radius}x{$sigma}");
  }

  public function equalizeImage()
  {
    return $this->execConvert("-equalize");
  }

  public function extentImage($width, $height, $x, $y)
  {
    return $this->execConvert("-extent {$width}x{$height}+{$x}+{$y}");
  }

  public function flipImage()
  {
    return $this->execConvert("-flip");
  }

  public function flopImage()
  {
    return $this->execConvert("-flop");
  }

  public function flattenImages()
  {
    return $this->execConvert("-flatten");
  }

  public function frameImage($matte_color, $width, $height, $inner_bevel, $outer_bevel)
  {
    return $this->execConvert("-mattecolor '{$matte_color}' -frame {$width}x{$height}+{$inner_bevel}+{$outer_bevel}");
  }

  public function fxImage($expression)
  {
    return $this->execConvert("-fx '{$expression}'");
  }

  public function gammaImage($gamma)
  {
    return $this->execConvert("-gamma {$gamma}");
  }

//gray scale: -fx '0.29900*R+0.58700*G+0.11400*B'
//-colorspace gray

  public function getImageWidth()
  {
    $a = getimagesize($this->obrazek->stream);

    return $a[0];
  }

  public function getImageHeight()
  {
    $a = getimagesize($this->obrazek->stream);

    return $a[1];
  }

  public function getImageDepth()
  {
    $a = getimagesize($this->obrazek->stream);

    return $a["bits"];
  }

  public function getImageSize()
  {
    return filesize($this->obrazek->stream);
  }

  public function getImageMime()
  {
    $a = getimagesize($this->obrazek->stream);

    return $a["mime"];
  }

  public function sendImageHeader()
  {
    $a = getimagesize($this->obrazek->stream);

    header("content-type: {$a["mime"]}");
  }

  public function getVersion()
  {
    system("convert -version", $result);

    return $result;
  }

  public function gaussianBlurImage($radius, $sigma)
  {
    return $this->execConvert("-gaussian-blur {$radius}x{$sigma}");
  }

  public function functionImage($function, $arguments)
  {
    return $this->execConvert("-function {$function} {$arguments}");
  }

  public function implodeImage($radius)
  {
    return $this->execConvert("-implode {$radius}");
  }

  public function levelImage($blackPoint, $gamma, $whitePoint)
  {
    return $this->execConvert("-level {$blackPoint},{$whitePoint}%,{$gamma}");
  }

  public function linearStretchImage($blackPoint, $whitePoint)
  {
    return $this->execConvert("-linear-stretch {$blackPoint}x{$whitePoint}%");
  }

  public function medianFilterImage($radius)
  {
    return $this->execConvert("-median {$radius}");
  }

  public function modulateImage($brightness, $saturation, $hue)
  {
    return $this->execConvert("-modulate {$brightness},{$saturation},{$hue}");
  }

  public function motionBlurImage($radius, $sigma, $angle)
  {
    return $this->execConvert("-motion-blur {$radius}x{$sigma}+{$angle}");
  }

  public function negateImage($gray)
  {
    $g = ($gray ? "+" : "-");
    return $this->execConvert("{$g}negate");
  }

  public function oilPaintImage($radius)
  {
    return $this->execConvert("-paint {$radius}");
  }

  public function polaroidImage($properties, $angle)
  {
    $draw = implode(" ", $draw->properties);

    return $this->execConvert("-draw '{$draw}' -polaroid {$angle}");
  }

  public function radialBlurImage($angle)
  {
    return $this->execConvert("-radial-blur {$angle}");
  }

  public function raiseImage($width, $height, $x, $y, $raise)
  {
    $r = ($raise ? "+" : "-");
    return $this->execConvert("{$r}raise {$width}x{$height}+{$x}+{$y}");
  }

  public function reduceNoiseImage($radius)
  {
    return $this->execConvert("-noise {$radius}");
  }
//$filter = 0, $blur = 1
  public function resizeImage($columns, $rows, $absolutne = true)
  { //obsluha absolutniho zmenseni, pri XxY a je treba dodrzet z W i H
    $absolute = ($absolutne ? $this->absolutesize($columns, $rows) : "");
    $columns = (!Empty($columns) ? $columns : "");
    $rows = (!Empty($rows) ? $rows : "");

    return $this->execConvert("-resize {$columns}x{$rows}{$absolute}");
  }

  public function rollImage($x, $y)
  {
    return $this->execConvert("-roll +{$x}+{$y}");
  }

//"blue", "#0000ff", "rgb(0,0,255)", "cmyk(100,100,100,10)"
//http://www.imagemagick.org/contrib/color-converter.php
  public function rotateImage($background, $degrees)
  {
    return $this->execConvert("-rotate {$degrees} -background '{$background}'");
  }

  public function sampleImage($columns, $rows)
  {
    return $this->execConvert("-sample {$columns}x{$rows}\!");
  }

  public function sepiaToneImage($threshold)
  {
    return $this->execConvert("-sepia-tone {$threshold}%");
  }

  public function sigmoidalContrastImage($sharpen, $alpha, $beta)
  {
    $sharpen = ($sharpen ? "+" : "-");

    return $this->execConvert("{$sharpen}sigmoidal-contrast {$alpha}x{$beta}");
  }

  public function scaleImage($columns, $rows)
  {
    $absolute = $this->absolutesize($columns, $rows);
    $columns = (!Empty($columns) ? $columns : "");
    $rows = (!Empty($rows) ? $rows : "");

    return $this->execConvert("-scale {$columns}x{$rows}{$absolute}");
  }
//R, G, B
  public function separateImageChannel($channel)
  {
    return $this->execConvert("-channel {$channel} -separate");
  }

  public function selfCommandLine($command)
  {
    return $this->execConvert($command);
  }

//set, off, on, opaque, transparent, extract, copy, shape, Background
  public function setImageAlphaChannel($mode)
  { //?????
    return $this->execConvert("-alpha {$mode}");
  }

  public function setBackgroundColor($background)
  {
    return $this->execConvert("-background '{$background}'");
  }

//Undefined, CMYK, Gray, HSB, HSL, HWB, Lab, OHTA, RGB, sRGB, Transparent, XYZ, YCbCr, YCC, YIQ, YPbPr, YUV
  public function setImageColorSpace($colorspace)
  {
    return $this->execConvert("-colorspace {$colorspace}");
  }

//None, BZip, Fax, Group4, JPEG, JPEG2000, Lossless, LZW, RLE, Zip
  public function setImageCompression($compression)
  {
    return $this->execConvert("-compress {$compression}");
  }

  public function setImageCompressionQuality($quality = 75)
  {
    return $this->execConvert("-quality {$quality}");
  }

//Red, Green, Blue, Alpha, Cyan, Magenta, Yellow, Black, Opacity, Index, RGB, RGBA, CMYK, CMYKA
  public function setImageChannel($channel)
  {
    return $this->execConvert("-channel {$channel}");
  }

  public function setImageDepth($depth)
  {
    return $this->execConvert("-depth {$depth}");
  }

//Bilevel, Grayscale, GrayscaleMatte, Palette, PaletteMatte, TrueColor, TrueColorMatte, ColorSeparation, ColorSeparationMatte
  public function setImageType($image_type)
  {
    return $this->execConvert("-type {$image_type}");
  }

//Point, Hermite, Cubic, Box, Gaussian, Catrom, Triangle, Quadratic, Mitchell
  public function setImageFilter($filter)
  {
    return $this->execConvert("-filter {$filter}");
  }

  public function setFont($font)
  {
    return $this->execConvert("-font '{$font}'");
  }

  public function setGravity($gravity)
  {
    return $this->execConvert("-gravity {$gravity}");
  }

  public function setImageMatteColor($matte)
  {
    return $this->execConvert("-mattecolor '{$matte}'");
  }

  public function setPointSize($point_size)
  {
    return $this->execConvert("-pointsize {$point_size}");
  }

  public function shadeImage($azimuth, $elevation)
  {//+/-!
    return $this->execConvert("-shade {$azimuth}x{$elevation}");
  }

  public function sharpenImage($radius, $sigma)
  {
    return $this->execConvert("-sharpen {$radius}x{$sigma}");
  }

  public function shaveImage($columns, $rows)
  {
    return $this->execConvert("-shave {$columns}x{$rows}");
  }

  public function shearImage($background, $x_shear, $y_shear)
  {
    return $this->execConvert("-background '{$background}' -shear {$x_shear}x{$y_shear}");
  }

  public function sketchImage ($radius, $sigma, $angle)
  {
    return $this->execConvert("-sketch {$radius}x{$sigma}+{$angle}");
  }

  public function solarizeImage ($threshold)
  {
    return $this->execConvert("-solarize {$threshold}");
  }

  public function spliceImage($width, $height, $x, $y)
  {
    return $this->execConvert("-splice {$width}x{$height}+{$x}+{$y}");
  }

  public function spreadImage($radius)
  {
    return $this->execConvert("-spread {$radius}");
  }

  public function swirlImage ($degrees)
  {
    return $this->execConvert("-swirl {$degrees}");
  }

  public function thumbnailImage($columns, $rows)
  {
    $absolute = $this->absolutesize($columns, $rows);
    $columns = (!Empty($columns) ? $columns : "");
    $rows = (!Empty($rows) ? $rows : "");

    return $this->execConvert("-thumbnail {$columns}x{$rows}{$absolute}");
  }

  public function thresholdImage($threshold, $channel = NULL)
  {
    $channel = (!Empty($channel) ? "-channel {$channel}" : "");

    return $this->execConvert("-threshold {$threshold}% {$channel}");
  }

  public function transparent($color)
  {
    return $this->execConvert("-transparent '{$color}'");
  }

  public function transparentColor($color)
  {
    return $this->execConvert("-transparent-color '{$color}'");
  }

  public function tintImage($tint, $opacity)
  {
    return $this->execConvert("-fill '{$tint}' -tint {$opacity}%");
  }

  public function transposeImage()
  {
    return $this->execConvert("-transpose");
  }

  public function transverseImage()
  {
    return $this->execConvert("-transverse");
  }

  public function trimImage($fuzz)
  {
    return $this->execConvert("-trim -fuzz {$fuzz}%");
  }

  public function unsharpMaskImage($radius, $sigma, $amount, $threshold)
  {
    return $this->execConvert("-unsharp {$radius}x{$sigma}+{$amount}+{$threshold}");
  }

  public function vignetteImage($radius, $sigma, $x, $y)
  {
    return $this->execConvert("-vignette {$radius}x{$sigma}+{$x}+{$y}%");
  }

  public function waveImage($amplitude, $length)
  {
    return $this->execConvert("-wave {$amplitude}x{$length}");
  }

/**
 *
 * Vytvoreni noveho obrazku
 *
 * @param columns sirka obrazku
 * @param rows vyska obrazku
 * @param background barva pozadi
 * @param format format obrazku, defaultni png
 * @return navrat z konzole
 */
  public function newImage($columns, $rows, $background, $format = "png")
  {
    system("convert -size {$columns}x{$rows} xc:'{$background}' '{$this->obrazek->stream}.{$format}'", $result);
    //zkopirovani verze s priponou zpet do streamu
    copy("{$this->obrazek->stream}.{$format}", $this->obrazek->stream);
    //smazani verze s priponou
    unlink("{$this->obrazek->stream}.{$format}");

    return $result;
  }

/**
 *
 * Spolecna kostra pro konvertovani obrazku
 *
 * @param prikaz konzolovy prikaz pro convert
 * @return navrat z konzoly
 */
  private function execConvert($prikaz)
  {
    system("convert {$prikaz} '{$this->obrazek->stream}' '{$this->obrazek->stream}'", $result);

    return $result;
  }

/**
 *
 * Vrati aktualni stream obrazku
 *
 * @return stream obrazku
 */
  public function getImage()
  { //vypise stream dat obrazku
    $result = file_get_contents($this->obrazek->stream);

    return $result;
  }

/**
 *
 * Nastavi obrazek danym streamem
 *
 * @param replace stream obrazku na nahrazeni
 * @return pocet zapsanych znaku
 */
  public function setImage($replace)
  { //nastavi stream dat obrazku
    $result = file_put_contents($this->obrazek->stream, $replace);

    return $result;
  }

/**
 *
 * Vraci nazev obrazku
 *
 * @return nazev obrazku
 */
  public function getFilename()
  {
    return $this->obrazek->name;
  }

/**
 *
 * Nastavuje novy nazev obrazku
 *
 * @param filename novy nazev obrazku
 * @return
 */
  public function setFilename($filename)
  {
    $result = false;
    if (!Empty($filename))
    {
      $this->obrazek->name = $filename;
      $result = true;
    }

    return $result;
  }


}

/**
 *
 * Reimplementace imagickdraw knihovny
 *
 */
class ImagicDraw
{
  public $draw;

  public function __construct()
  {
    $this->draw = array();
  }

  public function __get($var)
  {
    return $this->$var;
  }

  public function annotation($x, $y, $text)
  {
    $this->draw[] = "text {$x},{$y} \"{$text}\"";
  }

  public function arc($sx, $sy, $ex, $ey, $sd, $ed)
  {
    $this->draw[] = "arc {$sx},{$sy} {$ex},{$ey} {$sd},{$ed}";
  }
//array(array(x, y), array(x, y))
  public function bezier($coordinates)
  {
    $row = array();
    foreach ($coordinates as $polozka)
    {
      $row[] = implode(",", $polozka);
    }
    $row = implode(" ", $row);
    $this->draw[] = "bezier {$row}";
  }

  public function circle($ox, $oy, $px, $py)
  {
    $this->draw[] = "circle {$ox},{$oy} {$px},{$py}";
  }
//point, replace, floodfill, filltoborder, reset
  public function color($x, $y, $paintMethod)
  {
    $this->draw[] = "color {$x},{$y} {$paintMethod}";
  }

  public function ellipse($ox, $oy, $rx, $ry, $start, $end)
  {
    $this->draw[] = "ellipse {$ox},{$oy} {$rx},{$ry} {$start},{$end}";
  }
//image over 3,3 0,0 'terminal.gif'
  public function image($x, $y, $w, $h, $image)
  {
    $this->draw[] = "image over {$x},{$y} {$w},{$h} \"{$image}\"";
  }

  public function line($sx, $sy, $ex, $ey)
  {
    $this->draw[] = "line {$sx},{$sy} {$ex},{$ey}";
  }
//floodfill, reset
  public function matte($x, $y, $paintMethod)
  {
    $this->draw[] = "matte {$x},{$y} {$paintMethod}";
  }

  public function point($x, $y)
  {
    $this->draw[] = "point {$x},{$y}";
  }

  public function polygon($coordinates)
  {
    $row = array();
    foreach ($coordinates as $polozka)
    {
      $row[] = implode(",", $polozka);
    }
    $row = implode(" ", $row);
    $this->draw[] = "polygon {$row}";
  }

  public function polyline($coordinates)
  {
    $row = array();
    foreach ($coordinates as $polozka)
    {
      $row[] = implode(",", $polozka);
    }
    $row = implode(" ", $row);
    $this->draw[] = "polyline {$row}";
  }

  public function rectangle($x1, $y1, $x2, $y2)
  {
    $this->draw[] = "rectangle {$x1},{$y1} {$x2},{$y2}";
  }

  public function rotate($degrees)
  {
    $this->draw[] = "rotate {$degrees}";
  }

  public function roundRectangle($x1, $y1, $x2, $y2, $rx, $ry)
  {
    $this->draw[] = "roundrectangle {$x1},{$y1} {$x2},{$y2} {$rx},{$ry}";
  }

  public function scale($x, $y)
  {
    $this->draw[] = "scale {$x},{$y}";
  }

  public function setFillColor($fill_pixel)
  {
    $this->draw[] = "fill \"{$fill_pixel}\"";
  }

  public function setFillOpacity($fillOpacity)
  {
    $this->draw[] = "fill-opacity {$fillOpacity}";
  }

  public function setFont($font_name)
  {
    $this->draw[] = "font \"{$font_name}\"";
  }

  public function setFontSize($pointsize)
  {
    $this->draw[] = "font-size {$pointsize}";
  }
//None, Center, East, Forget, NorthEast, North, NorthWest, SouthEast, South, SouthWest, West
  public function setGravity($gravity)
  {
    $this->draw[] = "gravity {$gravity}";
  }

  public function setStrokeColor($stroke_pixel)
  {
    $this->draw[] = "stroke \"{$stroke_pixel}\"";
  }

  public function setStrokeDashArray($dashArray)
  {
    $row = implode(" ", $dashArray);
    $this->draw[] = "stroke-dasharray {$row}";
  }
//butt, round, square
  public function setStrokeLineCap($linecap)
  {
    $this->draw[] = "stroke-linecap {$linecap}";
  }
//miter, bevel, round
  public function setStrokeLineJoin($linejoin)
  {
    $this->draw[] = "stroke-linejoin {$linejoin}";
  }

  public function setStrokeMiterLimit($miterlimit)
  {
    $this->draw[] = "stroke-miterlimit {$miterlimit}";
  }

  public function setStrokeOpacity($stroke_opacity)
  {
    $this->draw[] = "stroke-opacity {$stroke_opacity}";
  }

  public function setStrokeWidth($stroke_width)
  {
    $this->draw[] = "stroke-width {$stroke_width}";
  }

  public function setViewbox($x1, $y1, $x2, $y2)
  {
    $this->draw[] = "viewbox {$x1} {$y1} {$x2} {$y2}";
  }

  public function skewX($degrees)
  {
    $this->draw[] = "skewX {$degrees}";
  }

  public function skewY($degrees)
  {
    $this->draw[] = "skewY {$degrees}";
  }

  public function translate($x, $y)
  {
    $this->draw[] = "translate {$x},{$y}";
  }


}

?>
