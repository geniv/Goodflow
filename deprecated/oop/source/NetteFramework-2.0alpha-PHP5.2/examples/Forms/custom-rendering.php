<?php

/**
 * Forms custom rendering example.
 */


require dirname(__FILE__) . '/../../Nette/loader.php';


NDebug::enable();


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



// Step 2: Check if form was submitted?
if ($form->isSubmitted()) {

	// Step 2c: Check if form is valid
	if ($form->isValid()) {
		echo '<h2>Form was submitted and successfully validated</h2>';

		NDebug::dump($form->values);

		// this is the end, my friend :-)
		exit;
	}

} else {
	// not submitted, define default values
	$defaults = array(
		'name'    => 'John Doe',
		'userid'  => 231,
		'country' => 'CZ', // Czech Republic
	);

	$form->setDefaults($defaults);
}



// Step 3: Render form
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">

	<title>Nette\Forms custom rendering example | Nette Framework</title>

	<style type="text/css">
	html {
		font: 16px/1.5 "Trebuchet MS", "Geneva CE", lucida, sans-serif;
		border-top: 4.7em solid #F4EBDB;
	}

	body {
		max-width: 780px;
		margin: -4.7em auto 0;
		background: white;
		color: #333;
	}

	h1 {
		font-size: 1.9em;
		margin: .5em 0 1.5em;
		background: url(http://files.nette.org/icons/logo-e1.png) right center no-repeat;
		color: #7A7772;
		text-shadow: 1px 1px 0 white;
	}

	.required {
		font-weight: bold;
	}

	.error {
		color: red;
	}

	input.text {
		border: 1px solid #78BD3F;
		padding: 3px;
		color: black;
		background: white;
	}

	input.button {
		font-size: 120%;
	}

	dt, dd {
		padding: .5em 1em;
	}

	#form h3 {
		background: #78BD3F;
		color: white;
		margin: 0;
		padding: .1em 1em;
		font-size: 100%;
		font-weight: normal;
		clear: both;
	}

	#form dl {
		background: #F8F8F8;
		margin: 0;
	}

	#form dt {
		text-align: right;
		font-weight: normal;
		float: left;
		width: 10em;
		clear: both;
	}

	#form dd {
		margin: 0;
		padding-left: 10em;
		display: block;
	}

	#form dd ul {
		list-style: none;
		font-size: 90%;
	}

	#form dd.odd {
		background: #EEE;
	}
	</style>
	<link rel="stylesheet" type="text/css" media="screen" href="files/style.css" />
	<script src="http://nette.github.com/resources/js/netteForms.js"></script>
</head>

<body>
	<h1>Nette\Forms custom rendering example</h1>

	<?php echo $form ?>
</body>
</html>