<?php

//include_once "imagic.php";

function __autoload($name)
{
  $nazev = mb_strtolower($name);
  include_once "{$nazev}.php";
}

/*
  $obr1 = new Imagic("0000021-1920.jpg");
  $obr1->resizeImage(215, 0);
  $h1 = $obr1->getImageHeight();
  $obr2 = new Imagic("0000021-1920.jpg");
  $obr2->resizeImage(215, 0);
  $obr2->setImageColorSpace("Gray");
  //$h2 = $obr2->getImageHeight();

  $canvas = new Imagic();
  $canvas->newImage((215*2) + 40, $h1 + 20, "transparent");
  $canvas->compositeImage($obr1, "over", 10, 10);
  $canvas->compositeImage($obr2, "over", 215 + 20 + 10, 10);
  $canvas->setImageDepth(24);

  echo $canvas->getImage();
*/
//var_dump($obr);
//dopocitat Y!!!!
//$h = $obr->getImageHeight();
//var_dump($h);
//$canvas->setGravity("center");

  //$obr = new Imagic("23-11-2010_15-36-19_1041.jpg");
  $obr = new Imagic("simply_perfect_animace.gif");
  //$obr = new Imagic("1204352719_ramdas_shivaji.gif");
  $obr->resizeImage(80, 80, false);
  $canvas = new Imagic();
  $canvas->newImage(300, 300, "gray");
  $canvas->compositeImage($obr, "over", "center", 0);

  //header("content-type: image/png");
  echo $canvas->sendImageHeader();
  echo $obr->getImage();
  //uklid po sobe
  $canvas->destroy();
  $obr->destroy();

//->getImage()
//$obr1->fxImage("xx=i/w-.5; yy=j/h-.5; rr=xx*xx+yy*yy; 1-rr*4");
  //$imagic->readImage("kameny.png");
/*
  header("content-type: image/png");
  echo $obr->getImage();
exit;

  $imagic = new Imagic();
  $imagic->readImage("logo-Ubuntu.png");
//$obr2->frameImage("Tomato", 10, 10, 5, 5);
  //$imagic->newImage(200, 200, "white", "png");
  $draw = new ImagicDraw();
  $imagic->annotateImage($draw, 200, 200, 45, "hviiiii");
  $draw->setFont("GIGI.TTF");
  $draw->setFontSize(100);
  $draw->setFillColor("blue");
  $draw->annotation(20, 150, "kveteeeeeneeee");
  $draw->setFillColor("transparent");
  $draw->setStrokeColor("black");
  $draw->setStrokeWidth(5);
  $draw->arc(100, 100, 200, 300, 300, 100);
  $draw->bezier(array(array(40,10), array(20,50), array(90,10), array(70,40)));
  $draw->circle(200, 200, 300, 300);
  $draw->color(30, 20, "point");
  $draw->ellipse(50, 30, 40, 20, 0, 360);
  $draw->line(20, 50, 90, 10);
  $draw->setFillColor("none");
  $draw->matte(100, 100, "floodfill");
  $draw->setFillColor("blue");
  $draw->point(3, 2);
  $draw->setFillColor("lime");
  $draw->setStrokeWidth(1);
  $draw->setStrokeLineCap("butt");
  $draw->setStrokeOpacity(0.5);
  $draw->translate(50, 30);
  $draw->polygon(array(array(90, 60), array(70, 100), array(140, 60), array(120, 90)));
  $draw->polyline(array(array(90, 60), array(70, 100), array(140, 60), array(120, 90)));
  $draw->scale(1.2, 1.2);
  $draw->rotate(-30);
  $draw->rectangle(5, 10, 15, 50);
  $draw->setStrokeDashArray(array(5, 5, 5));
  $draw->roundRectangle(20, 10, 80, 50, 20, 15);
  $imagic->drawImage($draw);
  echo $imagic->getImage();
*/
  //$imagic->borderImage("red", 5, 5);
  //$imagic->sepiaToneImage(80);
  //$imagic->thumbnailImage(100, 100);
  //$imagic->waveImage(25, 150);
  //$imagic->blurImage(5, 3);
  //$imagic->borderImage("red", 2, 5);
  //$imagic->charcoalImage(5, 2);
  //$imagic->chopImage(10, 10, 20, 20);
  //$imagic->clear();
  //$imagic->clipImage();
  //$a = $imagic->cloneImage();
  //$imagic->colorFloodfillImage("blue", 0.1, "red", 2, 2);
  //$imagic->colorizeImage("red", 0.1);
  //$imagic->flipImage();
  //$imagic->flopImage();
  //$imagic->gammaImage(2.8);
  //$imagic->gaussianBlurImage(5, 3);
  //$imagic->magnifyImage();
  //$imagic->medianFilterImage(0.99);
  //$imagic->modulateImage(50, 20, 2);
  //$imagic->motionBlurImage(5, 3, 8);
  //$imagic->negateImage(false);
  //$imagic->oilPaintImage(2);
  //$imagic->radialBlurImage(5);
  //$imagic->implodeImage(0.89);
  //$imagic->adaptiveResizeImage(0, 200);
  //$imagic->adaptiveSharpenImage(2, 3);
  //$imagic->resizeImage(0, 400, 0, 1);
  //$imagic->rollImage(400, 0);
  //$imagic->scaleImage(400, 0);
  //$imagic->setBackgroundColor("red");
  //$imagic->sampleImage(400, 10);
  //$imagic->rotateImage("", 32);
  //$imagic->rotateImage("", 34);
  //$cavas = new Imagic("test.png");
  //$imagic->compositeImage($cavas, "over", 20, 20);

//  echo $imagic->getImage();
  //exit;

?>
