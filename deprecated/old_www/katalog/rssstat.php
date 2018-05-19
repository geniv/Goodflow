<?php
class Stat
{
  var $rsspocnazev = ".pocitadlo_rss.huh";

  function Stat()
  {
    $this->rsspoc = new SQLiteDatabase($this->rsspocnazev); //poèítadlo
    if ($res = @$this->rsspoc->query("SELECT * FROM pocitadlo ORDER BY pocet DESC", NULL, $error))
    {
      $radku = $res->numRows();
      $suma = 0;
      $i = 0;
      $vyska = 20;
      $font = imageloadfont("font_pocitadlo.gdf");
      $img = imagecreate(400, $radku * $vyska + 1);
      $background_color = imagecolorallocate($img, 255, 255, 255);
      $text_color = imagecolorallocate($img, 0, 102, 255);
      $line_color = imagecolorallocate($img, 0, 153, 51);  
      while ($data = $res->fetchObject())
      {
        $host = gethostbyaddr($data->ip);
        imagestring($img, $font, 0, $i * $vyska,  "$host", $text_color);
        imagestring($img, $font, 350, $i * $vyska, "{$data->pocet}x", $text_color);
        imageline($img, 0, $i * $vyska, 400, $i * $vyska, $line_color);

        
        $i++;
        //$result .= "$data->id | $data->ip | $host | $data->hodina | $data->cas | $data->datum | {$data->pocet}x<br />";
        $suma += $data->pocet;
      }
      imagepng($img);
      imagedestroy($img);
    }
      else
    {
      $this->chyba = $error;
    }
  }
}

header("Content-type: image/png");
$web = new Stat();
?>
