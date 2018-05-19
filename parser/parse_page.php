<?php
/*
 * parse_page.php
 *
 * Copyright 2014 geniv <geniv.radek@gmail.com>
 *
 * parser detailu stranek
 */

# `Id` ,
# `Company` ,
# `DetailUrl` ,
# `Description` ,
# `Web` ,
# `GPSlat` ,
# `GPSlong` ,
# `Address` ,
# `PSC` ,
# `Lokalita` ,
# `Tel1` ,
# `Tel2` ,
# `Email` ,
# `Zarazeni` ,
# `KategorieParser` ,
# `Page`


function getArguments($args) {
    return ($args);
}

if ($argv && PHP_SAPI == 'cli' && PHP_OS == 'Linux') {
    // pokud je posteno v cli
    $args = getArguments($argv);

    // predani cli argumentu
    $zarazeni = $args[1];
    $url_category = $args[2];
    $page_num = intval($args[3]);
    $url_page = $args[4];
    $url_content = $args[5];

    // id firmy
    preg_match('/firma\/(?<id>[0-9]+)/', $url_page, $m);
    $id = intval($m['id']);

    // vypreparovani skodliveho obsahu
    $prepare = str_replace(array(
            '&copy;',
            '&raquo;',
            '&nbsp;',
            '&lt;',
            '&gt;',
            '<br/>',    // uprava entru
            '<br />',
            ',    ',   // oprava rozdeleni description a web url
            '&',
            // 'amp;',
            // '// <![CDATA[',
            // '// ]]>',
            '',
        ), array(
            '',
            '',
            '',
            '',
            '',
            PHP_EOL,
            PHP_EOL,
            '',
            '&amp;',
            // '',
            // '',
            // '',
            '',
        ), $url_content);

    // vytvoreni xml objektu
    $xml = simplexml_load_string($prepare);

    // content obsahu
    $content = $xml->body->div->div[1]->div;


    // web/y firmy
    $web = array();
    foreach ($content->p->a as $v) {
        $a = $v->attributes();
        $web[] = trim(strval($a->href));
    }


    // zpracovani adresy
    $adr = strval($content->table->tr[1]->td[0]);
    $a1 = array_values(array_filter(array_map('trim', explode(PHP_EOL, $adr))));
    $a0 = array_values(array_map('trim', explode(',', $a1[0])));
    $Address = implode(', ', (count($a0) > 1 ? array_slice($a0, 0, -1) : $a0));
    $PSC = (preg_match('/.+(?<psc>[0-9]{3}\s?[0-9]{2})/', $a1[0], $m) ? $m['psc'] : (isset($a0[1]) ? $a0[1] : null));
    $Lokalita = $a1[1];
    // var_dump($Address);


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
    $Latitude = isset($m['lat']) ? $m['lat'] : null;
    $Longitude = isset($m['long']) ? $m['long'] : null;


    // vysledne pole
    $result = array(
        'Id' => $id,
        'DetailUrl' => $url_page,
        'Company' => trim(strval($content->h1)),
        'Description' => trim(strval($content->p)),
        'Web' => implode(', ', $web),
        'Address' => $Address,
        'PSC' => $PSC,
        'Lokalita' => $Lokalita,
        'Contact' => serialize($contact),  // pole kontaktu - serializovane
        'Latitude' => $Latitude,
        'Longitude' => $Longitude,
        'Zarazeni' => $zarazeni,
        'KategorieParser' => $url_category,
        'Page' => $page_num,
    );
    // var_dump($result);

    try {
        // ulozeni do databaze
        $db = 'vystup.sqlite3';
        $pdo = new \PDO('sqlite:'.$db);
        if (filesize($db) == 0) {
            require('sqlbuilder.php');
            $sql = classes\SqlBuilder::create('kontakty');
            $sql->c('id')->int()->pk()
                ->c('DetailUrl')->text()
                ->c('Company')->text()
                ->c('Description')->text()
                ->c('Web')->text()
                ->c('Address')->text()
                ->c('PSC')->text()
                ->c('Lokalita')->text()
                ->c('Contact')->text()
                ->c('Latitude')->text()
                ->c('Longitude')->text()
                ->c('Zarazeni')->text()
                ->c('KategorieParser')->text()
                ->c('Page')->int();

            // var_dump($sql->getSQLite3());
            $pdo->exec($sql->getSQLite3());
        }

        if ($pdo->beginTransaction()) { // zacatek transakce
            $k = array_keys($result);
            $v = array_map(function($v) { return '?'; }, $result);
            $s = 'INSERT INTO kontakty ('.implode(', ', $k).') VALUES ('.implode(', ', $v).')';;

            $sth = $pdo->prepare($s);
            if ($sth->execute(array_values($result))) {
                echo 'pridano id: ' . $pdo->lastInsertId() . ' == '. $id . PHP_EOL;
                $pdo->commit();
            } else {
                $e = $sth->errorInfo(); // nacteni chyby
                echo 'nevykonano! pro: ' . $id . ' ( ' . $e[2] . ' )' . PHP_EOL;
            }
        }

    } catch (\PDOException $e) {
        // $pdo->rollBack();
        die($e->getMessage());
    }

} else {
    die('nepovolena operace!');
}