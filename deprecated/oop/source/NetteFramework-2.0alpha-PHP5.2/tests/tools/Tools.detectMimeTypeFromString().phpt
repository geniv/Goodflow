<?php

/**
 * Test: NTools::detectMimeTypeFromString()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( 'image/gif', NTools::detectMimeTypeFromString(file_get_contents('files/images/logo.gif')) );
Assert::same( 'application/octet-stream', NTools::detectMimeTypeFromString(file_get_contents('files/bad.ppt')) );
