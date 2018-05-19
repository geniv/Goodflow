<?php
/*
 * test_email.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  require 'lightloader.php'; // load autoload

  $email = '...@gmail.com';

  $url = 'http://localhost/moja_super_dlouha_url';

  // poslani emailu uzivatelovy
  $em = new classes\Emailer(classes\Emailer::HTML);
  $ret = $em->addTo($email)
            ->setFrom('admin@web.cz')
            ->setSubject('Potvrzeni emailu do autorské sekce web.cz')
            ->setMessageArgs('Dobrý den,<br /><br />Vaše žádost o potvrzeni emailu: <a href="%s">tu klikni</a>  Po schválení se budete moct plně přihlásit.<br />----------------------------<br /><br /><br />Děkujeme za Vaši registraci.<br />--<br />web.cz', $url)
            ->send();

  if ($em) {
    echo 'odeslano...';
  } else {
    echo 'wtf?';
  }