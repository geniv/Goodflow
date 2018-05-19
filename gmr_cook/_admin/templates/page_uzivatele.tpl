example template...
uzivatele

{if="!$url_blok"}
<a href="{$addLink}">Přidat uzivatele</a>
{/if}

{$formular}
{loop="$formular_out"}<span>{$value}</span>{/loop}

{if="$dbResult"}
<ul>
{loop="$dbResult"}
  <li>
    <p>
      id: {$value->iduzivatel}
      role: {$value->nazev_role},
      jmeno: {$value->jmeno},
      login: {$value->login},
      email: {$value->email},
      Přidáno: {date_str="d.m.Y H:i:s", $value->pridano},
      Upraveno: {date_str="d.m.Y H:i:s", $value->upraveno},
      pocet napsanych receptu: {$value->pocet}x
      <a href="{$editLink}/{$value->iduzivatel}">upravit</a>
      <a href="{$delLink}/{$value->iduzivatel}" onclick="return confirm('Opravdu chceš smazat: &quot;{$value->login}&quot; ?')">smazat</a>
    </p>
  </li>
{else}
  mno nic tu neni
{/loop}
</ul>
{/if}