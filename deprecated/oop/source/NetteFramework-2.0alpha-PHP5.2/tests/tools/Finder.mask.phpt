<?php

/**
 * Test: NFinder mask tests.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



function export($iterator)
{
	$arr = array();
	foreach ($iterator as $key => $value) $arr[] = strtr($key, '\\', '/');
	return $arr;
}



// multiple mask
$finder = NFinder::findFiles('*.txt', '*.gif')->from('files');
Assert::same(array(
	'files/file.txt',
	'files/images/logo.gif',
	'files/subdir/file.txt',
	'files/subdir/subdir2/file.txt',
), export($finder));

$finder = NFinder::findFiles(array('*.txt', '*.gif'))->from('files');
Assert::same(array(
	'files/file.txt',
	'files/images/logo.gif',
	'files/subdir/file.txt',
	'files/subdir/subdir2/file.txt',
), export($finder));


// * mask
$finder = NFinder::findFiles('*.txt', '*')->in('files/subdir');
Assert::same(array(
	'files/subdir/file.txt',
	'files/subdir/readme',
), export($finder));


// *.* mask
$finder = NFinder::findFiles('*.*')->in('files/subdir');
Assert::same(array(
	'files/subdir/file.txt',
), export($finder));


// subdir mask
$finder = NFinder::findFiles('*/*2/*')->from('files');
Assert::same(array(
	'files/subdir/subdir2/file.txt',
), export($finder));


// excluding mask
$finder = NFinder::findFiles('*')->exclude('*i*')->in('files/subdir');
Assert::same(array(
	'files/subdir/readme',
), export($finder));


// subdir excluding mask
$finder = NFinder::findFiles('*')->exclude('*i*/*')->from('files');
Assert::same(array(
	'files/bad.ppt',
	'files/file.txt',
), export($finder));


// complex mask
$finder = NFinder::findFiles('*[efd][a-z][!a-r]*')->from('files');
Assert::same(array(
	'files/images/logo.gif',
), export($finder));


$finder = NFinder::findFiles('*2*/fi??.*')->from('files');
Assert::same(array(
	'files/subdir/subdir2/file.txt',
), export($finder));


// anchored
$finder = NFinder::findFiles('/f*')->from('files');
Assert::same(array(
	'files/file.txt',
), export($finder));

$finder = NFinder::findFiles('/*/f*')->from('files');
Assert::same(array(
	'files/subdir/file.txt',
), export($finder));


// multidirs mask
$finder = NFinder::findFiles('/**/f*')->from('files');
Assert::same(array(
	'files/subdir/file.txt',
	'files/subdir/subdir2/file.txt',
), export($finder));
