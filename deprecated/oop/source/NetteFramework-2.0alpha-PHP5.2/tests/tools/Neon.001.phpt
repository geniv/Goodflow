<?php

/**
 * Test: NeonParser simple values.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::null( NNeon::decode('') );
Assert::null( NNeon::decode('   ') );
Assert::same( 1, NNeon::decode('1') );
Assert::same( -1.2, NNeon::decode('-1.2') );
Assert::same( -120.0, NNeon::decode('-1.2e2') );
Assert::true( NNeon::decode('true') );
Assert::null( NNeon::decode('null') );
Assert::same( 'the"string#literal', NNeon::decode('the"string#literal') );
Assert::same( 'the"string', NNeon::decode('the"string #literal') );
Assert::same( "the'string #literal", NNeon::decode('"the\'string #literal"') );
Assert::same( 'the"string #literal', NNeon::decode("'the\"string #literal'") );
Assert::same( "", NNeon::decode("''") );
Assert::same( "", NNeon::decode('""') );
Assert::same( 'x', NNeon::decode('x') );
Assert::same( "x", NNeon::decode("\nx\n") );
Assert::same( "x", NNeon::decode("  x") );
