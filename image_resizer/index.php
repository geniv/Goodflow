<?php
/*
 * index.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

require 'lightloader.php'; // load autoload

$weburl = classes\Core::getUrl();

$w1 = 400;
$h1 = 300;

//300*400 ??

$w2 = 800;
$h2 = 600;

$result = '
<a href="'.$weburl.'">domu</a><br />
<a href="'.$weburl.'delall" onclick="return confirm(\'Opravdu se má vse smazat? ?\')">smazat vse ve slozce</a><br />
<a href="'.$weburl.'zip">vytvorit ZIP</a><br />

<br />
<form action="" method="post" enctype="multipart/form-data">
  <input type="file" name="pole[]" multiple>
  <input type="submit" name="__but__" value="uploadovat">
</form>
';

$uri = classes\Router::uri('action');

echo $result;

$dirimage = 'images/';

if (isset($_POST['__but__']) && $_POST['__but__']) {
  $files = $_FILES['pole'];
  foreach ($files['tmp_name'] as $i => $v) {
    if ($files['error'][$i] == 0) {
      $img = new \Imagick($v);
      $img->thumbnailImage($w1, $h1);
      $suffix = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
      $md5 = md5_file($v);
      $name1 = __DIR__ . '/' . $dirimage .$md5 .'_1.'.$suffix;
      move_uploaded_file($v, $name1);
      $img->writeImage($name1);

      echo '<a href="' . $weburl . $dirimage . basename($name1) . '">stahnout img1</a><img src="' . $weburl . $dirimage . basename($name1) .'"><br />';

      $img->thumbnailImage($w2, $h2);
      $name2 = __DIR__ . '/images/' . $md5 .'_2.'.$suffix;
      $img->writeImage($name2);
      echo '<a href="' . $weburl . $dirimage . basename($name2) . '">stahnout img2</a><img src="' . $weburl . $dirimage . basename($name2) . '"><br />';
    } else {
      echo 'chybka';
    }
  }
}

  if ($uri['action']) {
    switch ($uri['action']) {
      case 'delall':
        //TODO doaplikovat!!!!
      break;

      case 'zip': //TODO bacha na prava zapisu!
        $zip = new classes\Zipper('archiv.zip');
        $zip->addDir('images');
        $zip->close();
        echo 'vytvoreno! <a href="'.$weburl.'archiv.zip">samotny zip zde</a><br />';
      break;
    }
  }

