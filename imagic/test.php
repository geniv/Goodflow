<?
/*
 *      test.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  $error = print_r(error_get_last(), true);
  if (!empty($error)) {
    echo '<pre>'.$error.'</pre>';
  }

  include_once 'imagic.php';

  use classes\Imagic, classes\ImagicDraw;

  $problem = 'img/problem.jpg';

  $picture = 'img/Answer_to_Life.png';
  $picture1 = 'img/Answer_to_Life_fill.png';
  $picture12 = 'img/Answer=to_Life.png';
  $picture2 = 'img/lena_std.tiff';
  $picture3 = 'img/25909-bigthumbnail.jpg';
  $picture4 = 'img/323_airlive.gif';
  $picture5 = 'img/gambas-logo.png';

  $load_picture = $picture3;
  $suffix = pathinfo($load_picture, PATHINFO_EXTENSION);
  $out1 = 'img/out1.'.$suffix;
  $out2 = 'img/out2.'.$suffix;

  $log1 = $log2 = array();

////////////////////////////////////////////////////////////////////////////////

  $draw = new ImagicDraw();
  $draw->setFillColor('#999999')
        ->setFont('Bookman-DemiItalic')
        ->setFontSize(30)
        //->annotation(10, 40, 'nekoukej, kukuč :D')
        ;

  //$canvas = new Imagic($picture5, 'img');
  //$canvas->setTempPath('img')
          //->newImage(50, 50, 'gold')
          //->setImageFormat('jpg')
          //->newPseudoImage(100, 100, 'gradient:blue-red')
          //->setImageFormat('jpg')
          //->rotateImage('skyblue', 39)
          //->setImageFilename('img/pokus1.jpg')
          //->writeImage()
          //;
  //$canvas = new Imagic;
  //$canvas->newImage(400, 200, '#636363');

  $points = array(0,0, 25,25,
                 100,0, 100,50);

  //var_dump(Imagic::isPicture($load_picture));

  $rand = rand(-50, 50);
  //$image = new Imagic(array('files' => $load_picture, 'path' => 'img'));
  $image = new Imagic($load_picture, 'img');
  //var_dump($image);
  $image//->setTempPath('img')
        //->setImageFilename($picture2)
        //->setImageMatte(true)
        //->setImageMatteColor('#dddddd')
        //->setImageFormat('png')
        //->setImagePage(200, 200, 1, 1)
        //->readImage($picture3)
        //->readImage('picturedatabase')
        //->contrastStretchImage(1, 27, Imagic::CHANNEL_YELLOW)
        //->cropImage(200, 200, 50, 70)
        //->cropThumbnailImage(150, 150)
        //->cycleColormapImage(1)
        //->deskewImage(10)
        //->despeckleImage()
        //->setImageBackgroundColor('#fad888')
        //->setImageVirtualPixelMethod('Background')
        //->distortImage(Imagic::DISTORTION_AFFINE, $points, true)
        //->edgeImage(2)
        //->drawImage($draw)
        //->enhanceImage()
        //->equalizeImage()
        //->evaluateImage(5, 3, Imagic::CHANNEL_RED)
        //->extentImage(100, 100, 100, 100)
        //->flipImage()
        //->flopImage()
        //->frameImage('#0000ff', 10, 10, 3, 3)
        //->functionImage(Imagic::FUNCTION_ARCTAN, array(1.0, 0.5, 1.0, 0.5))
        //->fxImage('(1.0/(1.0+exp(10.0*(0.5-u)))-0.006693)*1.0092503')
        //->gammaImage(4, Imagic::CHANNEL_RED)
        //->setCompression(Imagic::COMPRESSION_JPEG)
        //->implodeImage(0.7)
        //->levelImage(0, 1.5, 50000)
        //->levelImage(0, 1.5, 50000, Imagic::CHANNEL_RED)
        //->linearStretchImage(50000, 800)
        //->magnifyImage()
        //->medianFilterImage(10)
        //->minifyImage()
        //->modulateImage(100, 60, 80)
        //->motionBlurImage(40, 5, 45)
        //->negateImage(false)
        //->normalizeImage(Imagic::CHANNEL_RED)
        //->oilPaintImage(2)
        //->paintOpaqueImage('black', 'red', 1000)
        //->paintTransparentImage('black', 0.7, 10)
        //->polaroidImage(new ImagicDraw, 15)
        //->posterizeImage(2, false)
        //->previewImages('Wave')
        //->radialBlurImage(20)
        //->raiseImage(10, 10, 140, 100, true)
        //->randomThresholdImage(0.4*50000, 0.6*50000)
        //->reduceNoiseImage(8)
        //->resampleImage(100, 100, Imagic::FILTER_GAUSSIAN, 1.0)
        //->rollImage(50, 50)
        //->scaleImage(470, 470, true)
        //->roundCorners(50, 50, 0, 5)  //, 1, 1, -3
        //->separateImageChannel(Imagic::CHANNEL_RED)
        //->sepiaToneImage(80)
        //->shadeImage(true, 45, 30)
        //->sharpenImage(10, 20)
        //->shaveImage(100, 100)
        //->shearImage('transparent', 20, 40)
        //->sigmoidalContrastImage(false, 3, 50)
        //->sketchImage(5, 3, 10)
        //->solarizeImage(1000)
        //->spliceImage(20, 20, 200, 100)
        //->spreadImage(5)
        //->swirlImage(90)
        //->thresholdImage(20000)
        //->tintImage('rgb(238, 180, 34)', 100)
        //->trimImage(10)
        //->uniqueImageColors()
        //->unsharpMaskImage(0, 10, 40, 50)
        //->setImageBackgroundColor('red')
        //->vignetteImage(1, 1, 0, 0)
        //->waveImage(20, 176)
        //->sampleImage(200, 200)
        //->scaleImage(300, 300, true)
        //->gaussianBlurImage(10, 20, Imagic::CHANNEL_RED)
        //->setImage($canvas)
        //->resizeImage(400, 400, Imagic::FILTER_HAMMING, 0, true)
        //->thumbnailImage(500, 500, true)
        //->adaptiveBlurImage(5, 3)
        //->adaptiveBlurImage(5, 4, Imagic::CHANNEL_RED)
        //->adaptiveResizeImage(0, 768)
        //->adaptiveResizeImage(100, 100, false)
        //->adaptiveResizeImage(200, 200, true)
        //->adaptiveSharpenImage(2, 1, Imagic::CHANNEL_BLUE)
        //->borderImage('red', 10, 10)
        //->adaptiveThresholdImage(10, 10, 1)
        //->chopImage(200, 200, 0, 0)
        //->annotateImage($draw, 10, 45, 0, 'The quick brown fox jumps over the lazy dog')
        //->clipImage()
        //->colorizeImage('#000078', 0)
        //->compositeImage($canvas, Imagic::COMPOSITE_OVER, 5, 5)
        //->borderImage('red', 10, 10)
        //->borderImage('gold', 5, 5)
        //->compositeImage($canvas, Imagic::COMPOSITE_OVER, 100, 100)
        //->borderImage('blue', 2, 2)
        //->contrastImage(false)
        //->commentImage('huuuuuu')
        ->annotateImage($draw, 30, 30, $rand, 'a')
        ->writeImage($out1);
        //var_dump($image->getImageProperty('comment'));

//echo $image->getImage();
//var_dump($image->identifyImage());


    //var_dump(Imagic::seraprateRGB('#aabbcd'));
    //var_dump($image->getMinimalVersion());

  //var_dump($image->getImageProperties('*', false));

  //$image->writeImage($out1);
  //var_dump($image->getImageBlob());

  $log1[] = $image->getImageFilename();
  $log1[] = $image->getImageFormat();
  $log1[] = $image->getImageMimeType();
  $log1[] = $image->getImageLength();
  $log1[] = 'w:'.$image->getImageWidth();
  $log1[] = 'h:'.$image->getImageHeight();
  $log1[] = $image->getImageDelay();
  $log1[] = implode(', ', $image->getImagePage());
  $log1[] = ($image->getState() ? 'redy' : 'nekde je chyba');
  //$log1[] = implode('<br />', $canvas->getCmd());
  //$log1[] = implode('<br />', $image->getCmd());
  //$log1[] = (Imagic::isPicture('picturedatabase') ? 'je obr' : 'neni obr');
  $log1[] = (Imagic::isPicture($picture2) ? 'je obr' : 'neni obr');

  //$image->setImageIndex(6);
  //$image->nextImage();
  //$image->previousImage();
  //var_dump($image->hasPreviousImage(), $image->hasNextImage(), $image->getImageIndex());

  $image->destroy();
  //$canvas->destroy();

//var_dump($image->getImageGeometry());
//var_dump($image->getImagePage());
//var_dump($image->getVersion());
//var_dump(Imagic::getVersion('versionNumber'));

  //$log1[] = print_r($image, true);

////////////////////////////////////////////////////////////////////////////////

  if (extension_loaded('Imagick')) {

    $draw = new ImagickDraw();
    $draw->setFillColor('#999999');
    $draw->setFont('Bookman-DemiItalic');
    $draw->setFontSize(30);
    //$draw->annotation(10, 40, 'nekoukej, kukuč :D');

    $canvas = new Imagick();
    //$canvas->newImage(50, 50, 'gold');
    $canvas->newPseudoImage(100, 100, 'radial-gradient:white-black');
    //var_dump($canvas->getImageFormat());
    $canvas->setImageFormat('jpg');
    $canvas->rotateImage('blue', 39);
    //$canvas->setImageFilename('img/pokus.png');
    //$canvas->writeImage();

    $image = new Imagick($load_picture);
    //$image->setImageMatte(true);
    //$image->setImageMatteColor('#dddddd');
    //$image->setImageFilename($picture2);
    //$image->setImageFormat('tiff');
    //$image->setImagePage(200, 200, 1, 1);
    //$image->readImage($picture3);
    //$image->contrastStretchImage(1, 27, Imagick::CHANNEL_YELLOW);
    //$image->cropImage(200, 200, 50, 70);
    //$image->cropThumbnailImage(200, 100);
    //$image->cycleColormapImage(1);
    //$image->deskewImage(10);
    //$image->despeckleImage();
    //$image->setimagebackgroundcolor('#fad888');
    //$image->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_BACKGROUND);
    //$image->distortImage(Imagick::DISTORTION_AFFINE, $points, true);
    //$image->edgeImage(2);
    //$image->drawImage($draw);
    //$image->enhanceImage();
    //$image->equalizeImage();
    //$image->extentImage(100, 100, 100, 100);
    //$image->flipImage();
    //$image->flopImage();
    //$image->frameImage('#0000ff', 10, 10, 3, 3);
    //$image->functionImage(Imagick::FUNCTION_ARCTAN, array(1.0, 0.5, 1.0, 0.5));
    //$image->fxImage('(1.0/(1.0+exp(10.0*(0.5-u)))-0.006693)*1.0092503');
    //$image->gammaImage(4, Imagick::CHANNEL_RED);
    //$image->setCompression(Imagick::COMPRESSION_JPEG);
    //$image->gaussianBlurImage(10, 20, Imagick::CHANNEL_RED);
    //$image->setImage($canvas);
    //$image->resizeImage(200, 200, Imagick::FILTER_HAMMING, 0, true);
    //$image->thumbnailImage(200, 100, true);
    //$image->setFont('Helvetica');
    //var_dump($image->getFont());
    //var_dump($image->identifyImage());
    //$image->implodeImage(0.7);
    //$image->labelImage('žluťoučký kůň');
    //$image->levelImage(0, 1.5, 50000);
    //$image->linearStretchImage(50000, 800);
    //$image->magnifyImage();
    //$image->medianFilterImage(10);
    //$image->minifyImage();
    //$image->modulateImage(100, 60, 80);
    //$image->mosaicImages();
    //$image->motionBlurImage(40, 5, 45);
    //$image->negateImage(false);
    //$image->normalizeImage(Imagick::CHANNEL_RED);
    //$image->oilPaintImage(5);
    //$image->paintOpaqueImage('black', 'red', 1000);
    //$image->paintTransparentImage('black', 0.7, 10);
    //$image->polaroidImage($draw, 15);
    //$image->posterizeImage(2, false);
    //$image->previewImages(Imagick::PREVIEW_IMPLODE);
    //$image->radialBlurImage(20);
    //$image->raiseImage(10, 10, 140, 100, true);
    //$image->randomThresholdImage(0.4*50000, 0.6*50000);
    //$image->reduceNoiseImage(8);
    //$image->resampleImage(100, 100, Imagick::FILTER_GAUSSIAN, 1.0);
    //$image->rollImage(50, 50);
    //$image->setBackgroundColor('red');
    //$image->setImageBackgroundColor('red');
    //$image->roundCorners(50, 50, 0, 5);
    //$image->separateImageChannel(Imagick::CHANNEL_RED);
    //$image->sepiaToneImage(80);
    //$image->shadeImage(true, 45, 30);
    //$image->shadowImage(1, 2, -3, -4);
    //$image->sharpenImage(10, 20);
    //$image->shaveImage(100, 100);
    //$image->shearImage('transparent', 20, 40);
    //$image->sigmoidalContrastImage(false, 3, 50);
    //$image->sketchImage(5, 3, 10);
    //$image->solarizeImage(1000);
    //$image->spliceImage(20, 20, 200, 100);
    //$image->spreadImage(5);
    //$image->swirlImage(90);
    //$image->thresholdImage(20000);
    //$image->tintImage('rgb(238, 180, 34)', 100);
    //$image->trimImage(10);
    //$image->uniqueImageColors();
    //$image->unsharpMaskImage(0, 10, 40, 50);
    //$image->vignetteImage(1, 1, 0, 0);
    //$image->waveImage(20, 176);
    //$image->sampleImage(200, 200);
    //$image->scaleImage(300, 300, true);
    //var_dump($image->getCompression());
//var_dump($image->getFont(), $image->getImage());
    //echo $image->getImage();
    //$image->adaptiveBlurImage(5, 3);
    //$image->adaptiveBlurImage(5, 3, Imagick::CHANNEL_RED);
    //$image->adaptiveResizeImage(0, 768);
    //$image->adaptiveResizeImage(100, 100, false);
    //$image->adaptiveResizeImage(200, 200, true);
    //var_dump($image->getImageFormat());
    //$image->adaptiveSharpenImage(2, 1, Imagick::CHANNEL_BLUE);
    //$image->borderImage('red', 10, 10);
    //$image->adaptiveThresholdImage(10, 10, 1);
    //$image->chopImage(200, 200, 0, 0);
    //$image->annotateImage($draw, 10, 45, 0, 'The quick brown fox jumps over the lazy dog');
    //$image->clipImage();
    //$image->colorizeImage('#000078', 0);
    //$image->compositeImage($canvas, Imagick::COMPOSITE_OVER, 30, 40);
    //$image->borderImage('red', 10, 10);
    //$image->borderImage('gold', 5, 5);
    //$image->compositeImage($canvas, Imagick::COMPOSITE_OVER, 100, 100);
    //$image->borderImage('blue', 2, 2);
    //$image->contrastImage(false);
    //var_dump($image->getImageCompressionQuality(), $image->getCompressionQuality());
    //$image->commentImage('huuuuuu');
    $image->annotateImage($draw, 30, 30, $rand, 'a');
    $image->writeImage($out2);

    //var_dump($image->getImageProperties('*', false));
    //var_dump($image->getImageProperty('comment'));

    //var_dump($image->getImageBlob());

    $log2[] = $image->getImageFilename();
    $log2[] = $image->getImageFormat();
    //$log2[] = $image->getImageMimeType();
    $log2[] = '---';
    $log2[] = $image->getImageLength();
    $log2[] = 'w:'.$image->getImageWidth();
    $log2[] = 'h:'.$image->getImageHeight();
    $log2[] = $image->getImageDelay();
    $log2[] = implode(', ', $image->getImagePage());


//var_dump($image->getImageGeometry());
//var_dump($image->getImagePage());
//var_dump($image->getVersion());

    //$log2[] = print_r($image, true);

  } else {
    $log2[] = 'offline';
  }

////////////////////////////////////////////////////////////////////////////////

  if (!file_exists($out1)) {
    $out1 = $problem;
  }

  if (!file_exists($out2)) {
    $out2 = $problem;
  }

////////////////////////////////////////////////////////////////////////////////

$result = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="cs" />
    <meta name="author" content="GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)" />
    <title>Imagic(k) test</title>
  </head>
  <body>
    <div style="float: left;">
      Picture 1: (<strong>Imagic</strong>)<br />
      <img src="'.$out1.'" />
      <pre>'.implode("\n\n", $log1).'</pre>
    </div>
    <div style="float: right;">
      Picture 2: (<em>Imagick</em>)<br />
      <img src="'.$out2.'" />
      <pre>'.implode("\n\n", $log2).'</pre>
    </div>
  </body>
</html>
';

echo $result;

?>
