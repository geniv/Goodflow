<br>
tady skusit jestli se da secstion pri templatech pouzit s callback funkcema pro zpracovani <br>
a nebo to zhavaruje na 2 renderovani?
<hr>
{$a=5}
<br>

{code}
	$funkce = function($a) {
		return 'ahoj vole!!';
	};
{/code}

{if="$a == 5"}
	a tady se zobrazuje pravda podminky
	{$funkce($a)}
{/if}