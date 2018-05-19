<?php

/**
 * Test: NLatteMacros::macroTranslate()
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';


$macros = new NLatteMacros;

// {_...}
Assert::same( '$template->translate(\'var\')',  $macros->macroTranslate('var', '') );
Assert::same( '$template->filter($template->translate(\'var\'))',  $macros->macroTranslate('var', '|filter') );
