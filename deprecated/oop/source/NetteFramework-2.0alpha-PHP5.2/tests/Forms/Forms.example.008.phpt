<?php

/**
 * Test: Forms example.
 *
 * @author     David Grudl
 * @package    Nette\Forms
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$form = new NForm;

$form->addGroup();

$form->addText('query', 'Search:')
	->setType('search')
	->setAttribute('autofocus')
	->addRule(NForm::PATTERN, 'Must be alphanumeric string', '[a-z0-9]+');

$form->addText('count', 'Number of results:')
	->setType('number')
	->setDefaultValue(10)
	->addRule(NForm::INTEGER, 'Must be numeric value')
	->addRule(NForm::RANGE, 'Must be in range from %d to %d', array(1, 100));

$form->addText('precision', 'Precision:')
	->setType('range')
	->setDefaultValue(50)
	->addRule(NForm::INTEGER, 'Precision must be numeric value')
	->addRule(NForm::RANGE, 'Precision must be in range from %d to %d', array(0, 100));

$form->addText('email', 'Send to email:')
	->setType('email')
	->setAttribute('autocomplete', 'off')
	->setAttribute('placeholder', 'Optional, but Recommended')
	->addCondition(NForm::FILLED) // conditional rule: if is email filled, ...
		->addRule(NForm::EMAIL, 'Incorrect email address'); // ... then check email

$form->addSubmit('submit', 'Send');

Assert::match( file_get_contents(dirname(__FILE__) . '/Forms.example.008.expect'), $form->__toString(TRUE) );
