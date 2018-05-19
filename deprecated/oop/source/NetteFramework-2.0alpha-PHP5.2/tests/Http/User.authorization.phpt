<?php

/**
 * Test: NUser authorization.
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
			return new NIdentity('John Doe', array('admin'));
		}
	}

}



class AuthorizationHandler implements IAuthorizator
{
	/**
	 * @param  string  role
	 * @param  string  resource
	 * @param  string  privilege
	 * @return bool
	 */
	function isAllowed($role = self::ALL, $resource = self::ALL, $privilege = self::ALL)
	{
		return $role === 'admin' && strpos($resource, 'jany') === FALSE;
	}

}



$user = new NUser;

// guest
Assert::false( $user->isLoggedIn(), 'isLoggedIn?' );


Assert::same( array('guest'), $user->getRoles(), 'getRoles()' );
Assert::false( $user->isInRole('admin'), 'is admin?' );
Assert::true( $user->isInRole('guest'), 'is guest?' );



// authenticated
$handler = new AuthenticationHandler;
$user->setAuthenticationHandler($handler);

// login as john
$user->login('john', 'xxx');

Assert::true( $user->isLoggedIn(), 'isLoggedIn?' );
Assert::same( array('admin'), $user->getRoles(), 'getRoles()' );
Assert::true( $user->isInRole('admin'), 'is admin?' );
Assert::false( $user->isInRole('guest'), 'is guest?' );


// authorization
try {
	$user->isAllowed('delete_file');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', "Service 'Nette\\Security\\IAuthorizator' not found.", $e );
}

$handler = new AuthorizationHandler;
$user->setAuthorizationHandler($handler);

Assert::true( $user->isAllowed('delete_file'), "isAllowed('delete_file')?" );
Assert::false( $user->isAllowed('sleep_with_jany'), "isAllowed('sleep_with_jany')?" );



// log out
// logging out...
$user->logout(FALSE);

Assert::false( $user->isAllowed('delete_file'), "isAllowed('delete_file')?" );
