example template...
suroviny

{if="!$url_blok"}
<a href="{$addLink}">Přidat suroviny</a>
{/if}

{$formular}
{loop="$formular_out"}<span>{$value}</span>{/loop}

{if="$dbResult"}
<ul>
{loop="$dbResult"}
  <li>
    <p>
      id: {$value->idsuroviny}
      nazev: {$value->nazev},
      popis: {$value->popis},
      pocet vyuziti: {$value->pocet}x,
      <a href="{$editLink}/{$value->idsuroviny}">upravit</a>
      <a href="{$delLink}/{$value->idsuroviny}" onclick="return confirm('Opravdu chceš smazat: &quot;{$value->nazev}&quot; ?')">smazat</a>
    </p>
  </li>
{else}
  mno nic tu neni
{/loop}
</ul>
{/if}