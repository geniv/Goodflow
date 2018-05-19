example template...
nadobí

{if="!$url_blok"}
<a href="{$addLink}">Přidat nadobi</a>
{/if}

{$formular}
{loop="$formular_out"}<span>{$value}</span>{/loop}

{if="$dbResult"}
<ul>
{loop="$dbResult"}
  <li>
    <p>
      id: {$value->idnadobi}
      nazev: {$value->nazev},
      popis: {$value->popis},
      pocet vyuziti: {$value->pocet}x,
      <a href="{$editLink}/{$value->idnadobi}">upravit</a>
      <a href="{$delLink}/{$value->idnadobi}" onclick="return confirm('Opravdu chceš smazat: &quot;{$value->nazev}&quot; ?')">smazat</a>
    </p>
  </li>
{else}
vubec nic
{/loop}
</ul>
{/if}