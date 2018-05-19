<?php



// Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require dirname(__FILE__) . '/../../../Nette/loader.php';


// Enable NDebug for error visualisation & logging
NDebug::enable();

// Enable NRobotLoader - this allows load all classes automatically
// so that you don't have to litter your code with 'require' statements
NEnvironment::getRobotLoader()->register();


// Configure application
$application = NEnvironment::getApplication();
$application->router[] = new NSimpleRouter('Default:default');


// Run the application!
$application->run();
