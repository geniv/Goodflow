<?php

/**
 * Test: Forms naming container.
 *
 * @author     David Grudl
 * @package    Nette\Forms
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$_SERVER['REQUEST_METHOD'] = 'POST';

$_POST = array(
	'name' => 'jim',
	'text1' => 'hello',
	'text2' => 'world',
	'formCont' =>
	array(
		'name' => 'jack',
		'age' => '23',
	),
	'firstperson' =>
	array(
		'name' => 'david',
		'age' => '30',
	),
	'secondperson' =>
	array(
		'name' => 'jim',
		'age' => '40',
	),
	'age' => '50',
);

$_FILES = array(
	'secondperson' => array(
		'name' => array(
			'avatar' => 'license.txt',
		),

		'type' => array(
			'avatar' => 'text/plain',
		),

		'tmp_name' => array(
			'avatar' => 'C:\\PHP\\temp\\php1D5C.tmp',
		),

		'error' => array(
			'avatar' => 0,
		),

		'size' => array(
			'avatar' => 3013,
		),
	),
);



$form = new NForm();
$form->addText('name', 'Your name:', 35);

$sub = new NComponentContainer($form, 'container');
$sub->addComponent(new NTextInput('First line'), 'text1');
$sub->addComponent(new NTextInput('Second line'), 'text2');
$sub->addComponent($sub2 = new NFormContainer, 'formCont');
	$sub2->addText('name', 'Your name:', 35);
	$sub2->addText('age', 'Your age:', 5);

$sub = $form->addContainer('firstperson');
$sub->addText('name', 'Your name:', 35);
$sub->addText('age', 'Your age:', 5);

$sub = $form->addContainer('secondperson');
$sub->addText('name', 'Your name:', 35);
$sub->addText('age', 'Your age:', 5);
$sub->addFile('avatar', 'Picture:');

$form->addText('age', 'Your age:', 5);

$form->addSubmit('submit1', 'Send');

Assert::true( (bool) $form->isSubmitted() );
Assert::equal( NArrayHash::from(array(
	'name' => 'jim',
	'text1' => 'hello',
	'text2' => 'world',
	'formCont' => NArrayHash::from(array(
		'name' => 'jack',
		'age' => '23',
	)),
	'firstperson' => NArrayHash::from(array(
		'name' => 'david',
		'age' => '30',
	)),
	'secondperson' => NArrayHash::from(array(
		'name' => 'jim',
		'age' => '40',
		'avatar' => new NHttpUploadedFile(array(
			'name' => 'license.txt',
			'type' => '',
			'size' => 3013,
			'tmp_name' => 'C:\PHP\temp\php1D5C.tmp',
			'error' => 0,
		)),
	)),
	'age' => '50',
)), $form->getValues() );
