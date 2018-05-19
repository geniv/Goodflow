<?php
$zip = new ZipArchive;
$res = $zip->open('test.zip', ZipArchive::CREATE);
if ($res === TRUE) {
    $zip->addFromString('test.txt', 'toto je text');
    $zip->addFile('P3220334.JPG');
    $zip->addFile('michal.jpg');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}

?>