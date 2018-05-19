<?php

/**
 * Test: NRules::validateMessage()
 *
 * @author     David Grudl
 * @package    Nette\Forms
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$form = new NForm;
$form->addText('email', 'Email')
	->addRule(NForm::EMAIL, '%label %value is invalid [field %name]')
	->setDefaultValue('xyz');

Assert::match("%A%data-nette-rules=\"{op:':email',msg:'Email %value is invalid [field email]'}\"%A%", $form->__toString(TRUE));

$form->validate();

Assert::same( array(
	"Email xyz is invalid [field email]",
), $form->getErrors() );
