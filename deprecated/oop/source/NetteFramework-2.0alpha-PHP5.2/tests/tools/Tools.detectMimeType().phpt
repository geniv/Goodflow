<?php

/**
 * Test: NTools::detectMimeType()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( 'image/gif', NTools::detectMimeType('files/images/logo.gif') );
Assert::same( 'application/octet-stream', NTools::detectMimeType('files/bad.ppt') );
