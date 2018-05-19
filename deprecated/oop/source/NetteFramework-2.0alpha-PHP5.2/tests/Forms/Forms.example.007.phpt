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
$_POST = array('name'=>'John Doe ','age'=>'  12 ','email'=>'@','street'=>'','city'=>'','country'=>'CZ','password'=>'xxx','password2'=>'xxx','note'=>'','userid'=>'231','submit1'=>'Send',);

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

$defaults = array(
	'name'    => 'John Doe',
	'userid'  => 231,
	'country' => 'CZ', // Czech Republic
);

$form->setDefaults($defaults);
$form->fireEvents();

Assert::equal( array(
   'name' => 'John Doe',
   'age' => '12',
   'gender' => NULL,
   'email' => '',
   'send' => FALSE,
   'street' => '',
   'city' => '',
   'country' => 'CZ',
   'password' => 'xxx',
   'password2' => 'xxx',
   'avatar' => new NHttpUploadedFile(array(
      'name' => NULL,
      'type' => NULL,
      'size' => NULL,
      'tmp_name' => NULL,
      'error' => 4,
   )),
   'userid' => '231',
   'note' => '',
), (array) $form->getValues() );

ob_start();

?>
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

<?php

Assert::match( file_get_contents(dirname(__FILE__) . '/Forms.example.007.expect'), ob_get_clean() );