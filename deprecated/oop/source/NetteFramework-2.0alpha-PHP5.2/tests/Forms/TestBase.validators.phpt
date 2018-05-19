<?php

/**
 * Test: NTextBase validators.
 *
 * @author     David Grudl
 * @package    Nette\Forms
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$control = new NTextInput();
$control->value = '';
Assert::false( NTextBase::validateEmail($control) );


$control->value = '@.';
Assert::false( NTextBase::validateEmail($control) );


$control->value = 'name@a-b-c.cz';
Assert::true( NTextBase::validateEmail($control) );


$control->value = "name@\xc5\xbelu\xc5\xa5ou\xc4\x8dk\xc3\xbd.cz"; // name@žluťoučký.cz
Assert::true( NTextBase::validateEmail($control) );


$control->value = "\xc5\xbename@\xc5\xbelu\xc5\xa5ou\xc4\x8dk\xc3\xbd.cz"; // žname@žluťoučký.cz
Assert::false( NTextBase::validateEmail($control) );
