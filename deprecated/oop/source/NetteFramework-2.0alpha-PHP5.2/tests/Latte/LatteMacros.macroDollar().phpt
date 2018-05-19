<?php

/**
 * Test: NLatteMacros::macroDollar()
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';


$macros = new NLatteMacros;

// {$...}
Assert::same( '$var',  $macros->macroDollar('var', '') );
Assert::same( '$$var',  $macros->macroDollar('$var', '') );
Assert::same( '$template->filter($var)',  $macros->macroDollar('var', 'filter') );
