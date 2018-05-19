<?php

/**
 * Test: NString::truncate()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



iconv_set_encoding('internal_encoding', 'UTF-8');
$s = "\xc5\x98ekn\xc4\x9bte, jak se (dnes) m\xc3\xa1te?"; // Řekněte, jak se (dnes) máte?

Assert::same( '…', NString::truncate($s, -1), 'length=-1' );
Assert::same( '…', NString::truncate($s, 0), 'length=0' );
Assert::same( '…', NString::truncate($s, 1), 'length=1' );
Assert::same( 'Ř…', NString::truncate($s, 2), 'length=2' );
Assert::same( 'Ře…', NString::truncate($s, 3), 'length=3' );
Assert::same( 'Řek…', NString::truncate($s, 4), 'length=4' );
Assert::same( 'Řekn…', NString::truncate($s, 5), 'length=5' );
Assert::same( 'Řekně…', NString::truncate($s, 6), 'length=6' );
Assert::same( 'Řeknět…', NString::truncate($s, 7), 'length=7' );
Assert::same( 'Řekněte…', NString::truncate($s, 8), 'length=8' );
Assert::same( 'Řekněte,…', NString::truncate($s, 9), 'length=9' );
Assert::same( 'Řekněte,…', NString::truncate($s, 10), 'length=10' );
Assert::same( 'Řekněte,…', NString::truncate($s, 11), 'length=11' );
Assert::same( 'Řekněte,…', NString::truncate($s, 12), 'length=12' );
Assert::same( 'Řekněte, jak…', NString::truncate($s, 13), 'length=13' );
Assert::same( 'Řekněte, jak…', NString::truncate($s, 14), 'length=14' );
Assert::same( 'Řekněte, jak…', NString::truncate($s, 15), 'length=15' );
Assert::same( 'Řekněte, jak se…', NString::truncate($s, 16), 'length=16' );
Assert::same( 'Řekněte, jak se …', NString::truncate($s, 17), 'length=17' );
Assert::same( 'Řekněte, jak se …', NString::truncate($s, 18), 'length=18' );
Assert::same( 'Řekněte, jak se …', NString::truncate($s, 19), 'length=19' );
Assert::same( 'Řekněte, jak se …', NString::truncate($s, 20), 'length=20' );
Assert::same( 'Řekněte, jak se …', NString::truncate($s, 21), 'length=21' );
Assert::same( 'Řekněte, jak se (dnes…', NString::truncate($s, 22), 'length=22' );
Assert::same( 'Řekněte, jak se (dnes)…', NString::truncate($s, 23), 'length=23' );
Assert::same( 'Řekněte, jak se (dnes)…', NString::truncate($s, 24), 'length=24' );
Assert::same( 'Řekněte, jak se (dnes)…', NString::truncate($s, 25), 'length=25' );
Assert::same( 'Řekněte, jak se (dnes)…', NString::truncate($s, 26), 'length=26' );
Assert::same( 'Řekněte, jak se (dnes)…', NString::truncate($s, 27), 'length=27' );
Assert::same( 'Řekněte, jak se (dnes) máte?', NString::truncate($s, 28), 'length=28' );
Assert::same( 'Řekněte, jak se (dnes) máte?', NString::truncate($s, 29), 'length=29' );
Assert::same( 'Řekněte, jak se (dnes) máte?', NString::truncate($s, 30), 'length=30' );
Assert::same( 'Řekněte, jak se (dnes) máte?', NString::truncate($s, 31), 'length=31' );
Assert::same( 'Řekněte, jak se (dnes) máte?', NString::truncate($s, 32), 'length=32' );
