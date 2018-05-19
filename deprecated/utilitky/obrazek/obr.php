<?php
class Obr
{
  var $obr = "obr.png";
  var $font = "font.gdf";

  function Obr()
  { //text z UTF-8 na Win-1250!!
    $font = imageloadfont($this->font); //naètení fontu
    $img = imagecreatefrompng($this->obr);  //otevøení obrázku
    list($r, $g, $b) = str_split($_GET["barva"], 2);  //rozdìlení barvy
    $text_color = imagecolorallocate($img, hexdec("0x$r"), hexdec("0x$g"), hexdec("0x$b")); //pøevod barvy do dec 
    imagestring($img, $font, $_GET["x"], $_GET["y"], stripslashes(iconv("UTF-8", "Windows-1250", $_GET["text"])), $text_color); //výpis textu
    imagepng($img); //vykreslení obrázku
    imagedestroy($img); //vyèištení pamìti
  }
}

header("Content-type: image/png");
$web = new Obr();
?>