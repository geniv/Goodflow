<?php


$files = array(
	'app',
	'app/config',
	'log',
	'temp',
	'www',
	);


if (is_writable(__DIR__)) {
	foreach ($files as $f) {
		if (!file_exists($f)) {
			if (mkdir($f, 0777, true)) {
				echo 'vytvoreno: ' . $f . '<br />';
			}
		} else {
			echo 'jiz existuje: ' . $f . '<br />';
		}
	}
}

