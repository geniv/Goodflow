<?php

  //load autoload
  require 'loader.php';

  use classes\Core,
      classes\Html,
      //classes\HtmlPage,
      classes\Form;


  $f = new Form;
  $f->addText('nejakej_huj')
    ->addText('nejakej_nviiiiiiii')
    ->addGroup('', array('html' => Html::span()->class('chuj')->insert(Html::strong()->setText('skupina 1'))))
      ->addText('textove_pole')
      ->addPassword('heslo')
    ->addGroup('skupina 2')
      ->addTextArea('vice_text')
    ->endGroup()
    ->addSearch('hledani_pekla')
    ->addSubmit('tlc')
    ;

  echo $f;

?>
