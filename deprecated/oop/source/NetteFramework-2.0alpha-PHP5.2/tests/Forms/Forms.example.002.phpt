<?php

/**
 * Test: Forms example.
 *
 * @author     David Grudl
 * @package    Nette\Forms
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST = array('text'=>'a','submit1'=>'Send',);


$form = new NForm;

$form->addProtection('Security token did not match. Possible CSRF attack.', 3);

$form->addHidden('id')->setDefaultValue(123);
$form->addSubmit('submit', 'Delete item');
$form->fireEvents();

Assert::match( file_get_contents(dirname(__FILE__) . '/Forms.example.002.expect'), $form->__toString(TRUE) );
