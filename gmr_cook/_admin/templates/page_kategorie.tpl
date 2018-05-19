example template...
kategorie

{if="!$url_blok"}
<a href="{$addLink}">Přidat kategorie</a>
{/if}

{$formular}
{loop="$formular_out"}<span>{$value}</span>{/loop}

{if="$dbResult"}
<ul>
{loop="$dbResult"}
  <li>
    <p>
      id: {$value->idkategorie}
      nazev: {$value->nazev},
      popis: {$value->popis},
      pocet vyuziti: {$value->pocet}x,
      <a href="{$editLink}/{$value->idkategorie}">upravit</a>
      <a href="{$delLink}/{$value->idkategorie}" onclick="return confirm('Opravdu chceš smazat: &quot;{$value->nazev}&quot; ?')">smazat</a>
    </p>
  </li>
{else}
  mno nic tu neni
{/loop}
</ul>
{/if}