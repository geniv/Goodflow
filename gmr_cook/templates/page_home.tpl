
{$formular}
{loop="$formular_out"}<span>{$value}, </span>{/loop}

{if="$dbResult"}
vyhledano:
<ul>
{loop="$dbResult"}
  <li>
    <p>
      id: {$value->idrecepty},
      nazev: <a href="{$receptyLink}/{$value->idrecepty}">{$value->nazev}</a>
    </p>
  </li>
{else}
vubec nic nenalezeno
{/loop}
</ul>
{else}
žádné výsledky
{/if}
