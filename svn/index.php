<?php

$svnpath = '/var/www/www/svn';

//TODO do budoucna vylepsit!

echo '<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>GMR Repository</title>
        <meta name="description" content="GMR Repository">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Carme">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <h1>GMR Repository</h1>
        ';

$it = new DirectoryIterator($svnpath);
$ti = array();
foreach ($it as $row) {
    if ($row->isDir() && !$row->isDot()) {
        $ti[] = $row->getFilename();
    }
}
natcasesort($ti);  // serazeni
foreach ($ti as $row) {
    echo '<h2>' . $row . '</h2><ul>';

    $init = new \DirectoryIterator($svnpath . '/' . $row);
    $tini = array();
    foreach ($init as $r) {
        if ($r->isDir() && !$r->isDot()) {
            $tini[] = $r->getFilename();
        }
    }
    natcasesort($tini);    // serazeni
    foreach ($tini as $r) {
        echo '<li><a href="http://websvn.gfdesign.cz/listing.php?repname='.$r.'">'.$r.'</a></li>';
    }
    echo '</ul>';
}

echo '
    </body>
</html>';
