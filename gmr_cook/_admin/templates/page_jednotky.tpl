example template...
jednotky

{if="!$url_blok"}
<a href="{$addLink}">Přidat jednotky</a>
{/if}

{$formular}
{loop="$formular_out"}<span>{$value}</span>{/loop}

{if="$dbResult"}
<ul>
{loop="$dbResult"}
  <li>
    <p>
      id: {$value->idjednotky}
      nazev: {$value->nazev},
      popis: {$value->popis},
      <a href="{$editLink}/{$value->idjednotky}">upravit</a>
      <a href="{$delLink}/{$value->idjednotky}" onclick="return confirm('Opravdu chceš smazat: &quot;{$value->nazev}&quot; ?')">smazat</a>
    </p>
  </li>
{else}
  mno nic tu neni
{/loop}
</ul>
{/if}