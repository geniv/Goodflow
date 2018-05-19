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
$_POST = array('name'=>'John Doe ','age'=>'','email'=>'  @ ','send'=>'on','street'=>'','city'=>'','country'=>'HU','password'=>'xxx','password2'=>'','note'=>'','submit1'=>'Send','userid'=>'231',);


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
	'm' => 'male',
	'f' => 'female',
);



// Step 1: Define form with validation rules
$form = new NForm;

// group Personal data
$form->addGroup('Personal data')
	->setOption('description', 'We value your privacy and we ensure that the information you give to us will not be shared to other entities.');

$form->addText('name', 'Your name:')
	->addRule(NForm::FILLED, 'Enter your name');

$form->addText('age', 'Your age:')
	->addRule(NForm::FILLED, 'Enter your age')
	->addRule(NForm::INTEGER, 'Age must be numeric value')
	->addRule(NForm::RANGE, 'Age must be in range from %d to %d', array(10, 100));

$form->addRadioList('gender', 'Your gender:', $sex);

$form->addText('email', 'Email:')
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

$form->addText('street', 'Street:');

$form->addText('city', 'City:')
	->addConditionOn($form['send'], NForm::EQUAL, TRUE)
		->addRule(NForm::FILLED, 'Enter your shipping address');

$form->addSelect('country', 'Country:', $countries)
	->skipFirst()
	->addConditionOn($form['send'], NForm::EQUAL, TRUE)
		->addRule(NForm::FILLED, 'Select your country');


// group Your account
$form->addGroup('Your account');

$form->addPassword('password', 'Choose password:')
	->addRule(NForm::FILLED, 'Choose your password')
	->addRule(NForm::MIN_LENGTH, 'The password is too short: it must be at least %d characters', 3);

$form->addPassword('password2', 'Reenter password:')
	->addConditionOn($form['password'], NForm::VALID)
		->addRule(NForm::FILLED, 'Reenter your password')
		->addRule(NForm::EQUAL, 'Passwords do not match', $form['password']);

$form->addFile('avatar', 'Picture:')
	->addCondition(NForm::FILLED)
		->addRule(NForm::IMAGE, 'Uploaded file is not image');

$form->addHidden('userid');

$form->addTextArea('note', 'Comment:');


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

Assert::match( file_get_contents(dirname(__FILE__) . '/Forms.example.001.expect'), $form->__toString(TRUE) );
