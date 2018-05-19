<?php

echo '<form method="POST"><input name="nazev"/><input type="submit"></form>';

if ($_POST) {
	$nazev = __DIR__ .'/'. $_POST['nazev'];
	echo 'bude smazano: '.$nazev.', stav: '.(unlink($nazev) ? 'povedlo se' : 'neco je spatne');
}
