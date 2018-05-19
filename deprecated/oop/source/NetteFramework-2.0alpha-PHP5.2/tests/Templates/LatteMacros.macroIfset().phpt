<?php

/**
 * Test: NLatteMacros::macroIfset()
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';


$macros = new NLatteMacros;

// {ifset ... }
Assert::same( '$var',  $macros->macroIfset('$var') );
Assert::same( '$item->var["test"]',  $macros->macroIfset('$item->var["test"]') );
Assert::same( '$_l->blocks["block"]',  $macros->macroIfset('#block') );
Assert::same( '$item->var["#test"], $_l->blocks["block"]',  $macros->macroIfset('$item->var["#test"], #block') );
