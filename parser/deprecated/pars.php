<?php

    die('deprecated - only for first test');

    header("Content-Type: text/html; charset=UTF-8");

    $f = 'Autodnetfirmy.cz.html';
    // $c = iconv('WINDOWS-1250', 'UTF-8', file_get_contents($f));
    $c = file_get_contents($f);

    // vypreparovani skodliveho obsahu
    $prepare = str_replace(array(
            '&copy;',
            '<br/>',    // uprava entru
            '<br />',
        ), array(
            '',
            PHP_EOL,
            PHP_EOL,
        ), $c);

    // vytvoreni xml objektu
    $xml = simplexml_load_string($prepare);

    // content obsahu
    $content = $xml->body->div->div[1]->div;

// print_r($content);
// print_r($content->script[2]);

// var_dump($content->table->tr[1]->td[1]->dl->dt);


    $adr = strval($content->table->tr[1]->td[0]);
    $a1 = explode(',', $adr);
    $Address = trim($a1[0]);
    $a2 = explode(PHP_EOL, $a1[1]);
    $PSC = trim($a2[0]);
    $Lokalita = trim($a2[1]);

    // kontaktni udaje
    $i = 0;
    $contact = array();
    foreach ($content->table->tr[1]->td[1]->dl->dt as $v) {
        $dd = $content->table->tr[1]->td[1]->dl->dd;
        $contact[substr(strval($v), 0, -1)] = trim($dd[$i].$dd[$i]->a);
        $i++;
    }

    // geo
    $geo = strval($content->script[2]);
    preg_match('/initialize\((?<lat>[0-9\.]+), (?<long>[0-9\.]+)/', $geo, $m);
    $GPSlat = $m['lat'];
    $GPSlong = $m['long'];

echo PHP_EOL.PHP_EOL.PHP_EOL;

    $result = array(
        'Id',
        'DetailUrl',
        'Company' => trim(strval($content->h1)),
        'Description' => trim(strval($content->p)),
        'Web' => trim(strval($content->p->a)),
        'Address' => $Address,//trim(strval($content->table->tr[1]->td[0])),
        'PSC' => $PSC,
        'Lokalita' => $Lokalita,
        'Contact' => $contact,  // pole kontaktu
        'GPSlat' => $GPSlat,
        'GPSlong' => $GPSlong,
        'Zarazeni',
        'KategorieParser',
        'Page',
    );

    var_dump($result);