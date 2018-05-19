<?php
/*
 * __email.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  require 'lightloader.php'; // load autoload
  classes\ErrorLoger::enable(__DIR__ . '/logs/');

  try {

    $_values['email'] = '@centrum.cz';
    $_values['login'] = 'pokusator';
    $_values['hash'] = 'test123';
    $_values['alias'] = 'frantik';

    // poslani emailu uzivatelovy
    $p = classes\Emailer::factory(classes\Emailer::HTML)
            ->addTo($_values['email'])  //, $_values['login'] , 'frantik frantikovic'
            ->addTo('@centrum.cz')
            ->setFrom('admin@trainz.cz')
            ->setSubject('Registrace do autorské sekce Trainz.cz')
            ->setMessageArgs('Dobrý den,<br /><br />Vaše žádost o registraci do autorské sekce Trainz.cz byla předložena administrátorům ke schválení. Po schválení se budete moct přihlásit.<br /><br />Vaše přihlašovací údaje:<br />----------------------------<br />Login: %s<br />Heslo: %s<br />Email: %s<br />Jméno: %s<br />----------------------------<br /><br />Jakmile bude Vaše registrace schválena/zamítnuta, tak Vám dojde potvrzovací email.<br /><br />Děkujeme Vám za registraci.<br />--<br />Trainz.cz', $_values['login'], $_values['hash'], $_values['email'], $_values['alias'] ?: "-- nevyplněno --")
            ->send();

var_dump($p);

  } catch (Exception $e) {
    classes\ErrorLoger::logTryCatchException($e); // zalogaovani
  }