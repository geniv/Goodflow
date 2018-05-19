<?php
/*
 * parse_zarazeni.php
 *
 * Copyright 2014 geniv <geniv.radek@gmail.com>
 *
 * parsrovani jmena zarazeni
 */

function getArguments($args) {
    return ($args);
}

if ($argv && PHP_SAPI == 'cli' && PHP_OS == 'Linux') {
    // pokud je posteno v cli
    $args = getArguments($argv);

    $url_content = $args[1];

    // vypreparovani skodliveho obsahu
    $prepare = str_replace(array(
            '&copy;',
            '&raquo;',
            '&nbsp;',
            '<br/>',    // uprava entru
            '<br />',
        ), array(
            '',
            '',
            '',
            PHP_EOL,
            PHP_EOL,
        ), $url_content);

    // vytvoreni xml objektu
    $xml = simplexml_load_string($prepare);

    // content obsahu
    $content = $xml->body->div->div[1]->div;

    echo trim(strval($content->div->h3));
} else {
    die('nepovolena operace!');
}