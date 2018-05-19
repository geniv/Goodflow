<?php

/**
 * Forms manual form rendering.
 *
 * - separated form and rules definition
 * - manual form rendering
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
	'm' => 'male',
	'f' => 'female',
);



// Step 1: Define form
$form = new NForm;
$form->addText('name');
$form->addText('age');
$form->addRadioList('gender', NULL, $sex);
$form->addText('email')->setEmptyValue('@');

$form->addCheckbox('send');
$form->addText('street');
$form->addText('city');
$form->addSelect('country', NULL, $countries)->skipFirst();

$form->addPassword('password');
$form->addPassword('password2');
$form->addFile('avatar');
$form->addHidden('userid');
$form->addTextArea('note');

$form->addSubmit('submit');


// Step 1b: Define validation rules
$form['name']->addRule(NForm::FILLED, 'Enter your name');

$form['age']->addRule(NForm::FILLED, 'Enter your age');
$form['age']->addRule(NForm::INTEGER, 'Age must be numeric value');
$form['age']->addRule(NForm::RANGE, 'Age must be in range from %d to %d', array(10, 100));

// conditional rule: if is email filled, ...
$form['email']->addCondition(NForm::FILLED)
	->addRule(NForm::EMAIL, 'Incorrect email address'); // ... then check email

// another conditional rule: if is checkbox checked...
$form['send']->addCondition(NForm::EQUAL, TRUE)
	// toggle div #sendBox
	->toggle('sendBox');

$form['city']->addConditionOn($form['send'], NForm::EQUAL, TRUE)
	->addRule(NForm::FILLED, 'Enter your shipping address');

$form['country']->addConditionOn($form['send'], NForm::EQUAL, TRUE)
	->addRule(NForm::FILLED, 'Select your country');

$form['password']->addRule(NForm::FILLED, 'Choose your password');
$form['password']->addRule(NForm::MIN_LENGTH, 'The password is too short: it must be at least %d characters', 3);

$form['password2']->addConditionOn($form['password'], NForm::VALID)
	->addRule(NForm::FILLED, 'Reenter your password')
	->addRule(NForm::EQUAL, 'Passwords do not match', $form['password']);



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

	<title>Nette\Forms manual form rendering | Nette Framework</title>

	<style type="text/css">
	.required {
		color: darkred
	}

	fieldset {
		padding: .5em;
		margin: .5em 0;
		background: #E4F1FC;
		border: 1px solid #B2D1EB;
	}

	input.button {
		font-size: 120%;
	}

	th {
		width: 10em;
		text-align: right;
	}
	</style>
	<link rel="stylesheet" type="text/css" media="screen" href="files/style.css" />
	<script src="http://nette.github.com/resources/js/netteForms.js"></script>
</head>

<body>
	<h1>Nette\Forms manual form rendering</h1>

	<?php $form->render('begin') ?>

	<?php if ($form->errors): ?>
	<p>Opravte chyby:</p>
	<?php $form->render('errors') ?>
	<?php endif ?>

	<fieldset>
		<legend>Personal data</legend>
		<table>
		<tr class="required">
			<th><?php echo $form['name']->getLabel('Your name:') ?></th>
			<td><?php echo $form['name']->control->cols(35) ?></td>
		</tr>
		<tr class="required">
			<th><?php echo $form['age']->getLabel('Your age:') ?></th>
			<td><?php echo $form['age']->control->cols(5) ?></td>
		</tr>
		<tr>
			<th><?php echo $form['gender']->getLabel('Your gender:') ?></th>
			<td><?php echo $form['gender']->control ?></td>
		</tr>
		<tr>
			<th><?php echo $form['email']->getLabel('Email:') ?></th>
			<td><?php echo $form['email']->control->cols(35) ?></td>
		</tr>
		</table>
	</fieldset>


	<fieldset>
		<legend>Shipping address</legend>

		<p><?php echo $form['send']->control?><?php echo $form['send']->getLabel('Ship to address') ?></p>

		<table id="sendBox">
		<tr>
			<th><?php echo $form['street']->getLabel('Street:') ?></th>
			<td><?php echo $form['street']->control->cols(35) ?></td>
		</tr>
		<tr class="required">
			<th><?php echo $form['city']->getLabel('City:') ?></th>
			<td><?php echo $form['city']->control->cols(35) ?></td>
		</tr>
		<tr class="required">
			<th><?php echo $form['country']->getLabel('Country:') ?></th>
			<td><?php echo $form['country']->control ?></td>
		</tr>
		</table>
	</fieldset>



	<fieldset>
		<legend>Your account</legend>
		<table>
		<tr class="required">
			<th><?php echo $form['password']->getLabel('Choose password:') ?></th>
			<td><?php echo $form['password']->control->cols(20) ?></td>
		</tr>
		<tr class="required">
			<th><?php echo $form['password2']->getLabel('Reenter password:') ?></th>
			<td><?php echo $form['password2']->control->cols(20) ?></td>
		</tr>
		<tr>
			<th><?php echo $form['avatar']->getLabel('Picture:') ?></th>
			<td><?php echo $form['avatar']->control ?></td>
		</tr>
		<tr>
			<th><?php echo $form['note']->getLabel('Comment:') ?></th>
			<td><?php echo $form['note']->control->cols(30)->rows(5) ?></td>
		</tr>
		</table>
	</fieldset>

	<div>
		<?php echo $form['userid']->control ?>
		<?php echo $form['submit']->getControl('Send') ?>
	</div>

	<?php $form->render('end'); ?>
</body>
</html>
