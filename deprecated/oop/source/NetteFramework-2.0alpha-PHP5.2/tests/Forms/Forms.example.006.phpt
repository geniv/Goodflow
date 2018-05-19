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
$_POST = array('first'=>array('name'=>'James Bond','email'=>'bond@007.com','street'=>'Unknown','city'=>'London','country'=>'GB',),'second'=>array('name'=>'Jim Beam','email'=>'jim@beam.com','street'=>'','city'=>'','country'=>'US',),'submit1'=>'Send',);


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

// group First person
$form->addGroup('First person');
$sub = $form->addContainer('first');
$sub->addText('name', 'Your name:');
$sub->addText('email', 'Email:');
$sub->addText('street', 'Street:');
$sub->addText('city', 'City:');
$sub->addSelect('country', 'Country:', $countries);

// group Second person
$form->addGroup('Second person');
$sub = $form->addContainer('second');
$sub->addText('name', 'Your name:');
$sub->addText('email', 'Email:');
$sub->addText('street', 'Street:');
$sub->addText('city', 'City:');
$sub->addSelect('country', 'Country:', $countries);

// group for buttons
$form->addGroup();

$form->addSubmit('submit', 'Send');
$form->fireEvents();

Assert::equal( NArrayHash::from(array(
   'first' => NArrayHash::from(array(
      'name' => 'James Bond',
      'email' => 'bond@007.com',
      'street' => 'Unknown',
      'city' => 'London',
      'country' => 'GB',
   )),
   'second' => NArrayHash::from(array(
      'name' => 'Jim Beam',
      'email' => 'jim@beam.com',
      'street' => '',
      'city' => '',
      'country' => 'US',
   )),
)), $form->getValues() );

Assert::match( file_get_contents(dirname(__FILE__) . '/Forms.example.006.expect'), $form->__toString(TRUE) );
