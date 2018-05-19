<?php



// Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require dirname(__FILE__) . '/../../../Nette/loader.php';


// Enable NDebug for error visualisation & logging
NDebug::enable();


// Load configuration from config.neon file
NEnvironment::loadConfig();


// Configure application
$application = NEnvironment::getApplication();


// Setup router
{
	$router = $application->getRouter();

	// mod_rewrite detection
	if (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules())) {
		$router[] = new NRoute('index.php', 'Front:Default:default', NRoute::ONE_WAY);

		$router[] = $adminRouter = new NMultiRouter('Admin');
		$adminRouter[] = new NRoute('admin/<presenter>/<action>', 'Default:default');

		$router[] = $frontRouter = new NMultiRouter('Front');
		$frontRouter[] = new NRoute('<presenter>/<action>[/<id>]', 'Default:default');

	} else {
		$router[] = new NSimpleRouter('Front:Default:default');
	}
};


// Run the application!
$application->run();
