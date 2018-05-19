<?php

/**
 * Test: NLatteMacros::macroLink()
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';


$macros = new NLatteMacros;

// {link ...}
Assert::same( '$control->link("p")',  $macros->macroLink('p', '') );
Assert::same( '$template->filter($control->link("p"))',  $macros->macroLink('p', 'filter') );
Assert::same( '$control->link("p:a")',  $macros->macroLink('p:a', '') );
Assert::same( '$control->link($dest)',  $macros->macroLink('$dest', '') );
Assert::same( '$control->link($p:$a)',  $macros->macroLink('$p:$a', '') );
Assert::same( '$control->link("$p:$a")',  $macros->macroLink('"$p:$a"', '') );
Assert::same( '$control->link("p:a")',  $macros->macroLink('"p:a"', '') );
Assert::same( '$control->link(\'p:a\')',  $macros->macroLink("'p:a'", '') );

Assert::same( '$control->link("p", array(\'param\'))',  $macros->macroLink('p param', '') );
Assert::same( '$control->link("p", array(\'param\' => 123))',  $macros->macroLink('p param => 123', '') );
Assert::same( '$control->link("p", array(\'param\' => 123))',  $macros->macroLink('p, param => 123', '') );
