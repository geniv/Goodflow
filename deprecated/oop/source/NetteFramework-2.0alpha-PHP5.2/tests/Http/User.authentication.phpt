<?php

/**
 * Test: NUser authentication.
 *
 * @author     David Grudl
 * @package    Nette\Web
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



// Setup environment
$_COOKIE = array();
ob_start();



class AuthenticationHandler implements IAuthenticator
{
	/*
	 * @param  array
	 * @return IIdentity
	 * @throws NAuthenticationException
	 */
	function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		if ($username !== 'john') {
			throw new NAuthenticationException('Unknown user', self::IDENTITY_NOT_FOUND);

		} elseif ($password !== 'xxx') {
			throw new NAuthenticationException('Password not match', self::INVALID_CREDENTIAL);

		} else {
			return new NIdentity('John Doe', 'admin');
		}
	}

}



function onLoggedIn($user) {
	// TODO: add test
}



function onLoggedOut($user) {
	// TODO: add test
}



$user = new NUser;
$user->onLoggedIn[] = 'onLoggedIn';
$user->onLoggedOut[] = 'onLoggedOut';


Assert::false( $user->isLoggedIn(), 'isLoggedIn?' );
Assert::null( $user->getIdentity(), 'getIdentity' );
Assert::null( $user->getId(), 'getId' );



// authenticate
try {
	// login without handler
	$user->login('jane', '');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', "Service 'Nette\\Security\\IAuthenticator' not found.", $e );
}

$handler = new AuthenticationHandler;
$user->setAuthenticationHandler($handler);

try {
	// login as jane
	$user->login('jane', '');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NAuthenticationException', 'Unknown user', $e );
}

try {
	// login as john
	$user->login('john', '');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NAuthenticationException', 'Password not match', $e );
}

// login as john#2
$user->login('john', 'xxx');
Assert::true( $user->isLoggedIn(), 'isLoggedIn?' );
Assert::equal( new NIdentity('John Doe', 'admin'), $user->getIdentity(), 'getIdentity' );
Assert::same( 'John Doe', $user->getId(), 'getId' );



// log out
// logging out...
$user->logout(FALSE);

Assert::false( $user->isLoggedIn(), 'isLoggedIn?' );
Assert::equal( new NIdentity('John Doe', 'admin'), $user->getIdentity(), 'getIdentity' );


// logging out and clearing identity...
$user->logout(TRUE);

Assert::false( $user->isLoggedIn(), 'isLoggedIn?' );
Assert::null( $user->getIdentity(), 'getIdentity' );



// namespace
// login as john#2?
$user->login('john', 'xxx');
Assert::true( $user->isLoggedIn(), 'isLoggedIn?' );


// setNamespace(...)
$user->setNamespace('other');

Assert::false( $user->isLoggedIn(), 'isLoggedIn?' );
Assert::null( $user->getIdentity(), 'getIdentity' );
