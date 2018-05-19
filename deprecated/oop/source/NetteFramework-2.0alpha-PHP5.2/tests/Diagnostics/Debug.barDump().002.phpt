<?php

/**
 * Test: NDebug::barDump() with showLocation.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;
NDebug::$productionMode = FALSE;
NDebug::$showLocation = TRUE;
header('Content-Type: text/html');

NDebug::enable();

function shutdown() {
	$m = NString::match(ob_get_clean(), '#debug.innerHTML = (".*");#');
	Assert::match(<<<EOD
%A%<h1>Dumped variables</h1>

<div class="nette-inner">

	<table>
			<tr class="">
		<th></th>
		<td><pre class="nette-dump">"value" (5)
</pre></td>
	</tr>
		</table>
</div>
%A%
EOD
, json_decode($m[1]));
}
Assert::handler('shutdown');



NDebug::barDump('value');
