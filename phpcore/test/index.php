<?php

	require '../lightloader.php'; //load autoload

	// version = 1.10

	$dir = dirname(__DIR__);
	$it_class = new DirectoryIterator($dir . '/classes');
	$it_test = new DirectoryIterator($dir . '/test');


	$tests = array();
	foreach ($it_test as $item) {
		if (!$item->isDot() && $item->isFile() && $item->getExtension() == 'php') {
			$info = pathinfo($item->getPathname());
			if (substr($info['filename'], -4) == 'Test') {
				$tests[] = substr($info['filename'], 0, -4);
			}
		}
	}
	sort($tests);


	$classes = array();
	foreach ($it_class as $item) {
		if (!$item->isDot() && $item->isFile()) {
			$info = pathinfo($item->getPathname());
			$classes[] = $info['filename'];
		}
	}
	sort($classes);


	$test_low = array_map('strtolower', $tests);	// uprava na mele pismena
	foreach ($classes as $item) {
		$index = array_search($item, $test_low);	// vyhleda jmeno testu v poli testu
		$size = 0;
		$name = '';
		if ($index !== false) {
			$name = $tests[$index];
			$test_file = $dir . '/test/' . $tests[$index] . 'Test.php';	// slozeni cesty testu
			$size = classes\Core::getFileSize($test_file);
		}
		echo $item . ' - (' . $name . ') - ' . (in_array($item, $test_low) ? '<font color="green">existuje test</font>' : '<font color="red">xxx</font>') . ($size ? ' - ' . $size : null) . '<br />' . PHP_EOL;
	}
