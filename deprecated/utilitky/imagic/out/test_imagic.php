<?php

//var_dump(new ImagickPixel("#ffffff"));

  header("content-type: image/png");
  $obr1 = new Imagick("0000021-1920.jpg");
  //$obr1->separateImageChannel("G");
  //$obr1->resizeImage(215, 0);
  //$h1 = $obr1->getImageHeight();
  //$obr2 = new Imagick("0000021-1920.jpg");
  //$obr2->resizeImage(215, 0);

  //$canvas = new Imagick();
  //$canvas->newImage((215*2) + 40, $h1 + 20, "transparent");
  //$canvas->compositeImage($obr1, "over", 10, 10);
  //$canvas->compositeImage($obr2, "over", 215 + 20 + 10, 10);
  //$canvas->setImageDepth(24);

  echo $obr1->getImage();
/*
  $imagick = new Imagick(); //"test.png"
  //$imagick->readImage("kameny.png");
  $imagick->readImage("logo-Ubuntu.png");
  $h = $imagick->getImageHeight();
  $w = $imagick->getImageWidth();
  $size = $imagick->getImageSize();
  var_dump($size, $h, $w);
*/
/*
  $imagick->newImage(200, 200, new ImagickPixel("black"), "png");
  $imagick->newImage(200, 200, new ImagickPixel("blue"), "png");
  $imagick->newImage(200, 200, new ImagickPixel("red"), "png");
  $imagick->newImage(200, 200, new ImagickPixel("green"), "png");
  $imagick->resetIterator();
  $imagick = $imagick->appendImages(true);
*/
/*
  $draw = new ImagickDraw();
  $imagick->annotateImage($draw, 200, 200, 45, "hviiiii");
  $draw->setFont("GIGI.TTF");
  $draw->setFontSize(100);
  $draw->setFillColor("blue");
  $draw->annotation(20, 150, "kveteeeeeneeee");
  $draw->setFillColor("transparent");
  $draw->setStrokeColor("black");
  $draw->setStrokeWidth(5);
  $draw->arc(100, 100, 200, 300, 300, 100);
  $points = array
    (
        array('x' => 40, 'y' => 10),
        array( 'x' => 20, 'y' => 50 ),
        array( 'x' => 90, 'y' => 10 ),
        array( 'x' => 70, 'y' => 40 )
    );
  $draw->bezier($points);
  $draw->circle(200, 200, 300, 300);
  //$draw->color(30, 20, -1); ?
  $draw->ellipse(50, 30, 40, 20, 0, 360);
  $draw->line(20, 50, 90, 10);
  $draw->setFillColor("blue");
  $draw->point(3, 2);
  $imagick->drawImage($draw);
*/
  //$imagick->borderImage("red", 5, 5);
  //$imagick->sepiaToneImage(80);
  //$imagick->thumbnailImage(100, 100);
  //$imagick->waveImage(25, 150);
  //$imagick->blurImage(5, 3);
  //$imagick->borderImage("red", 2, 5);
  //$imagick->charcoalImage(5, 2);
  //$imagick->chopImage(10, 10, 20, 20);
  //$imagick->clear();
  //$imagick->clipImage();
  //$a = $imagick->clone();
  //$imagick->colorFloodfillImage("blue", 0.1, "red", 2, 2);
  //$imagick->colorizeImage("red", 0.1);
  //$imagick->flipImage();
  //$imagick->flopImage();
  //$imagick->gammaImage(2.8);
  //$imagick->gaussianBlurImage(5, 3);
  //$imagick->magnifyImage();
  //$imagick->medianFilterImage(0.99);
  //$imagick->modulateImage(50, 20, 2);
  //$imagick->motionBlurImage(5, 3, 8);
  //$imagick->negateImage(false);
  //$imagick->oilPaintImage(2);
  //$imagick->radialBlurImage(5);
  //$imagick->implodeImage(0.89);
  //$imagick->adaptiveResizeImage(0, 200);
  //$imagick->adaptiveSharpenImage(2, 3);
  //$imagick->resizeImage(0, 400, 0, 1);
  //$imagick->rollImage(400, 0);
  //$imagick->scaleImage(400, 0);
  //$imagick->setBackgroundColor("blue");
  //$imagick->setImageBackgroundColor("blue");
  //$imagick->sampleImage(400, 10);
  //$imagick->rotateImage(new ImagickPixel(), 32);
  //$imagick->rotateImage(new ImagickPixel(), 34);
  //$canvas = new Imagick("test.png");
  //$imagick->compositeImage($canvas, imagick::COMPOSITE_ATOP, 20, 20);
  //$imagick = $canvas;

  //echo $imagick->getImage();

  //exit;

//var_dump($imagick);
//system ("convert -version", $ret);
//echo $ret;
//echo $ret;
//var_dump($imagick);
//system("display -version", $ret);
//system("convert -rotate 33 'test.png' 'pok.png'", $ret);
//echo $ret;
//system("display 'pok.png'", $ret);
//system("convert 'pok.png' show:", $ret);
//echo $ret;

?>
