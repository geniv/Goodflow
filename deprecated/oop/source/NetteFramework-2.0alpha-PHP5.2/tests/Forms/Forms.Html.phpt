<?php

/**
 * Test: Forms and NHtml.
 *
 * @author     David Grudl
 * @package    Nette\Forms
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$form = new NForm;
$form->addText('input', NHtml::el('b')->setText('Strong text.'));

Assert::match(<<<EOD
%A%
	<th><label for="frm-input"><b>Strong text.</b></label></th>
%A%
EOD
, $form->__toString(TRUE));
