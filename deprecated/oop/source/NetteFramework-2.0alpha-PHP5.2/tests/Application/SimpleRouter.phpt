<?php

/**
 * Test: NSimpleRouter basic functions.
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$router = new NSimpleRouter(array(
	'id' => 12,
	'any' => 'anyvalue',
));

$uri = new NUriScript('http://nette.org/file.php');
$uri->setScriptPath('/file.php');
$uri->setQuery(array(
	'presenter' => 'myPresenter',
	'action' => 'action',
	'id' => '12',
	'test' => 'testvalue',
));
$httpRequest = new NHttpRequest($uri);

$req = $router->match($httpRequest);
Assert::same( 'myPresenter',  $req->getPresenterName() );
Assert::same( 'action',  $req->params['action'] );
Assert::same( '12',  $req->params['id'] );
Assert::same( 'testvalue',  $req->params['test'] );
Assert::same( 'anyvalue',  $req->params['any'] );

$url = $router->constructUrl($req, $httpRequest->uri);
Assert::same( 'http://nette.org/file.php?action=action&test=testvalue&presenter=myPresenter',  $url );
