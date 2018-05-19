<?php

  require 'loader.php';

  use
      classes\Core,
      classes\Email;

  //

  $e = new Email();
  $e
    //->from($values['email'])
    //->to('faja@gfdesign.cz')	//FIXME docasne vymenene!!!!
    ->to('geniv.radek@gmail.com')
    ->to('martin.fugess@gmail.com')
  //->to('kontakt@gfdesign.cz')
    ->subject('Zpráva z gfdesign.cz')
    ->message('ultra dlouha zprava!');
    //->message(Core::getMarkupText(sprintf('\nZpráva ze stránek www.gfdesign.cz\n\nÚdaje o odesílateli:\nIP: %s\nHost: %s\nOperační systém: %s\nProhlížeč: %s\n\nDatum / čas odeslání zprávy: %s\nJméno: %s\nE-mail: %s\nZpráva: %s\n', Email::getIP(), Email::getHost(), Email::getOS(), Email::getBrowser(), Email::getDateTime('d.m.Y / H:i:s'), 'jakoze jmeno', 'jakoze@mail.cz', 'toto je velni dlouha zprava')));

    //mail("geniv.radek@gmail.com", "Pokus1", "pokusna zprava ne delsi nez 70 znaku na radek.");

//var_dump(Core::getMarkupText(sprintf('\nZpráva ze stránek www.gfdesign.cz\n\nÚdaje o odesílateli:\nIP: %s\nHost: %s\nOperační systém: %s\nProhlížeč: %s\n\nDatum / čas odeslání zprávy: %s\nJméno: %s\nE-mail: %s\nZpráva: %s\n', Email::getIP(), Email::getHost(), Email::getOS(), Email::getBrowser(), Email::getDateTime('d.m.Y / H:i:s'), 'jakoze jmeno', 'jakoze@mail.cz', 'toto je velni dlouha zprava')));

  if ($e->send()) {
    echo 'odeslano';
  } else {
    echo 'neodeslano';
  }



//var_dump(mail("geniv.radek@gmail.com, martin.fugess@gmail.com", "Pokus1", "pokusna zprava ne delsi nez 70 znaku na radek."));

?>
