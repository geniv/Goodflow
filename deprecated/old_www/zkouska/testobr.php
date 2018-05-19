<?php
class Obr
{
  var $obr = "obr.png";
  var $font = "font.gdf";
  function Obr()
  {
    if ($_GET["x"] == 1)
    {
      $img = imagecreate(400, 200);
      $background_color = imagecolorallocate($img, 255, 255, 255);
      $text_color = imagecolorallocate($img, 0, 102, 255);
      $line_color = imagecolorallocate($img, 0, 153, 51);  
      imagestring($img, 8, 0, 100,  "ahoj!", $text_color);
      imagepng($img);
      imagedestroy($img);
    }
  
  }
}

header("Content-type: image/png");
$web = new Obr();
?>