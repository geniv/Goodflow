<?php
/*
 * highlight.php
 *
 * Copyright 2011 server <geniv.radek@gmail.com>
 *
 * zvyraznovac php syntaxe
 */

  require 'loader.php'; //auto load

  use classes\Form;

  $form = new Form;
  $form->addTextArea('text', array('returnvalue' => true, 'placeholder' => 'kod musí začínat: <?php'))
        ->addSubmit('tlacitko');

  echo $form;

  if ($form->isSubmitted()) {
    $text = $form->getValue('text');
    echo highlight_string($text, true);
  }

?>
