<?php

/**
 * Test: NSimpleRouter with secured connection.
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$router = new NSimpleRouter(array(
	'id' => 12,
	'any' => 'anyvalue',
), NSimpleRouter::SECURED);

$uri = new NUriScript('http://nette.org/file.php');
$uri->setScriptPath('/file.php');
$uri->setQuery(array(
	'presenter' => 'myPresenter',
));
$httpRequest = new NHttpRequest($uri);

$req = new NPresenterRequest(
	'othermodule:presenter',
	NHttpRequest::GET,
	array()
);

$url = $router->constructUrl($req, $httpRequest->uri);
Assert::same( 'https://nette.org/file.php?presenter=othermodule%3Apresenter',  $url );
