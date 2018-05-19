<?php

/**
 * Test: NDebug::timer()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::timer();

sleep(1);

NDebug::timer('foo');

sleep(1);

Assert::same( 2.0, round(NDebug::timer(), 1) );

Assert::same( 1.0, round(NDebug::timer('foo'), 1) );
