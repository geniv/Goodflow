<?php

$obr_in = "test.jpg";
$obr_out = "out.jpg";

$img = new Imagick($obr_in);
$img->cropthumbnailimage(200, 200);
$img->writeImage($obr_out);

echo '<img src="'.$obr_in.'"/><img src="'.$obr_out.'"/>';
