<?php

/**
 * Forms and HTML5.
 *
 * - for the best experience, use the latest version of browser (Internet Explorer 9, Firefox 4, Chrome 5, Safari 5, Opera 9)
 */


require dirname(__FILE__) . '/../../Nette/loader.php';


NDebug::enable();


// Step 1: Define form with validation rules
$form = new NForm;

$form->addGroup();

$form->addText('query', 'Search:')
	->setType('search')
	->setAttribute('autofocus');

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



// Step 2: Check if form was submitted?
if ($form->isSubmitted() && $form->isValid()) {
	echo '<h2>Form was submitted and successfully validated</h2>';

	$values = $form->values;
	NDebug::dump($values);

	// this is the end, my friend :-)
	exit;
}



// Step 3: Render form
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">

	<title>Nette\Forms and HTML5 | Nette Framework</title>

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
	<h1>Nette\Forms and HTML5</h1>

	<?php echo $form ?>
</body>
</html>
