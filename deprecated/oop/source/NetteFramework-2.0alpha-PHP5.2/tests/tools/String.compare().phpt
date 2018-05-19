<?php

/**
 * Test: NString::compare()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( TRUE,  NString::compare('', '') );
Assert::same( TRUE,  NString::compare('', '', 0) );
Assert::same( TRUE,  NString::compare('', '', 1) );
Assert::same( FALSE, NString::compare('xy', 'xx') );
Assert::same( TRUE,  NString::compare('xy', 'xx', 0) );
Assert::same( TRUE,  NString::compare('xy', 'xx', 1) );
Assert::same( FALSE, NString::compare('xy', 'yy', 1) );
Assert::same( TRUE,  NString::compare('xy', 'yy', -1) );
Assert::same( TRUE,  NString::compare('xy', 'yy', -1) );
Assert::same( TRUE,  NString::compare("I\xc3\xb1t\xc3\xabrn\xc3\xa2ti\xc3\xb4n\xc3\xa0liz\xc3\xa6ti\xc3\xb8n", "I\xc3\x91T\xc3\x8bRN\xc3\x82TI\xc3\x94N\xc3\x80LIZ\xc3\x86TI\xc3\x98N") ); // Iñtërnâtiônàlizætiøn
Assert::same( TRUE,  NString::compare("I\xc3\xb1t\xc3\xabrn\xc3\xa2ti\xc3\xb4n\xc3\xa0liz\xc3\xa6ti\xc3\xb8n", "I\xc3\x91T\xc3\x8bRN\xc3\x82TI\xc3\x94N\xc3\x80LIZ\xc3\x86TI\xc3\x98N", 10) );
