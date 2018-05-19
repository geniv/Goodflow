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
$_POST = array('name'=>'John Doe ','age'=>'9.9','email'=>'@','street'=>'','city'=>'Troubsko','country'=>'0','password'=>'xx','password2'=>'xx','note'=>'','submit1'=>'Send','userid'=>'231',);


$countries = array(
	'Select your country',
	'Europe' => array(
		'CZ' => 'Czech Republic',
		'SK' => 'Slovakia',
		'GB' => 'United Kingdom',
	),
	'CA' => 'Canada',
	'US' => 'United States',
	'?'  => 'other',
);

$sex = array(
	'm' => NHtml::el('option', 'male')->style('color: #248bd3'),
	'f' => NHtml::el('option', 'female')->style('color: #e948d4'),
);



// Step 1: Define form with validation rules
$form = new NForm;
// setup custom rendering
$renderer = $form->renderer;
$renderer->wrappers['form']['container'] = NHtml::el('div')->id('form');
$renderer->wrappers['form']['errors'] = FALSE;
$renderer->wrappers['group']['container'] = NULL;
$renderer->wrappers['group']['label'] = 'h3';
$renderer->wrappers['pair']['container'] = NULL;
$renderer->wrappers['controls']['container'] = 'dl';
$renderer->wrappers['control']['container'] = 'dd';
$renderer->wrappers['control']['.odd'] = 'odd';
$renderer->wrappers['control']['errors'] = TRUE;
$renderer->wrappers['label']['container'] = 'dt';
$renderer->wrappers['label']['suffix'] = ':';
$renderer->wrappers['control']['requiredsuffix'] = " \xE2\x80\xA2";


// group Personal data
$form->addGroup('Personal data');
$form->addText('name', 'Your name')
	->addRule(NForm::FILLED, 'Enter your name');

$form->addText('age', 'Your age')
	->addRule(NForm::FILLED, 'Enter your age')
	->addRule(NForm::INTEGER, 'Age must be numeric value')
	->addRule(NForm::RANGE, 'Age must be in range from %d to %d', array(10, 100));

$form->addSelect('gender', 'Your gender', $sex);

$form->addText('email', 'Email')
	->setEmptyValue('@')
	->addCondition(NForm::FILLED) // conditional rule: if is email filled, ...
		->addRule(NForm::EMAIL, 'Incorrect email address'); // ... then check email


// group Shipping address
$form->addGroup('Shipping address')
	->setOption('embedNext', TRUE);

$form->addCheckbox('send', 'Ship to address')
	->addCondition(NForm::EQUAL, TRUE) // conditional rule: if is checkbox checked...
		->toggle('sendBox'); // toggle div #sendBox


// subgroup
$form->addGroup()
	->setOption('container', NHtml::el('div')->id('sendBox'));

$form->addText('street', 'Street');

$form->addText('city', 'City')
	->addConditionOn($form['send'], NForm::EQUAL, TRUE)
		->addRule(NForm::FILLED, 'Enter your shipping address');

$form->addSelect('country', 'Country', $countries)
	->skipFirst()
	->addConditionOn($form['send'], NForm::EQUAL, TRUE)
		->addRule(NForm::FILLED, 'Select your country');


// group Your account
$form->addGroup('Your account');

$form->addPassword('password', 'Choose password')
	->addRule(NForm::FILLED, 'Choose your password')
	->addRule(NForm::MIN_LENGTH, 'The password is too short: it must be at least %d characters', 3)
	->setOption('description', '(at least 3 characters)');

$form->addPassword('password2', 'Reenter password')
	->addConditionOn($form['password'], NForm::VALID)
		->addRule(NForm::FILLED, 'Reenter your password')
		->addRule(NForm::EQUAL, 'Passwords do not match', $form['password']);

$form->addFile('avatar', 'Picture');

$form->addHidden('userid');

$form->addTextArea('note', 'Comment');


// group for buttons
$form->addGroup();

$form->addSubmit('submit', 'Send');



$defaults = array(
	'name'    => 'John Doe',
	'userid'  => 231,
	'country' => 'CZ', // Czech Republic
);

$form->setDefaults($defaults);
$form->fireEvents();

Assert::match( file_get_contents(dirname(__FILE__) . '/Forms.example.004.expect'), $form->__toString(TRUE) );
