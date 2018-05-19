<?php
  echo
  "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
    <head>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
      <meta http-equiv=\"Content-Language\" content=\"cs\" />
      <meta name=\"author\" content=\"Geniv &amp; Fugess (GF Design - www.gfdesign.cz)\" />
      <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz - www.gfdesign.cz)\" />
      <meta name=\"keywords\" content=\"Automatická galerie by GF Design\" />
      <meta name=\"description\" content=\"Automatická galerie by GF Design\" />
      <meta name=\"robots\" content=\"noindex, nofollow\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
      <title>Automatická galerie by GF Design - Wifi anténa na prodej</title>
      <script type=\"text/javascript\" src=\"script/highslide/highslide-full.js\"></script>
      <script type=\"text/javascript\">
      	hs.graphicsDir = 'obr/highslide/';
      	hs.align = 'center';
      	hs.transitions = ['expand', 'crossfade'];
      	hs.outlineType = 'rounded-white';
      	hs.fadeInOut = true;
      	//hs.dimmingOpacity = 0.75;

      	// Add the controlbar
      	hs.addSlideshow({
      		//slideshowGroup: 'group1',
      		interval: 5000,
      		repeat: false,
      		useControls: true,
      		fixedControls: 'fit',
      		overlayOptions: {
      			opacity: .75,
      			position: 'bottom center',
      			hideOnMouseOut: true
      		}
      	});
      </script>
    </head>
    <body>\n      <h1>Wifi anténa na prodej</h1>\n";

  $cesta = "./obr";
  $konc = "jpg";
  $w = 320;
  $h = 240;
  $mini = "mini";
  $handle = opendir($cesta);
  $obr = "";
  while($soub = readdir($handle))
  {
    $koncovka = explode(".", $soub);
    if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file" && strtolower($koncovka[count($koncovka) - 1]) == $konc)
    {
      echo
      "      <p class=\"polozka_obrazek\">
        <a href=\"{$cesta}/{$soub}\" title=\"{$cesta}/{$soub}\" class=\"highslide\" onclick=\"return hs.expand(this)\">
          <img src=\"{$mini}/{$soub}\" alt=\"{$mini}/{$soub}\" />
        </a>
        <span class=\"highslide-caption\">
          {$soub}
        </span>
      </p>\n";

      if (!file_exists("{$mini}/{$soub}"))
      {
        $obr = "{$cesta}/{$soub}";
        $nazev = $soub;
      }
    }
  }
  closedir($handle);

  if (!Empty($obr) && $konc == "jpg")
  {
    ini_set("memory_limit", "100M");
    list($old_w, $old_h) = getimagesize($obr);
    $img_old = imagecreatefromjpeg($obr);
    $img_new = imagecreatetruecolor($w, $h);
    imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $w, $h, $old_w, $old_h);
    imagejpeg($img_new, "{$mini}/{$nazev}", 100);
    imagedestroy($img_new);
  }

  echo
  "    </body>
  </html>
  ";
?>
