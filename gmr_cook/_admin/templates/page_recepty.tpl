example template...
recepty

řazení: {loop="$sortValues"}{$actv=(isset($web_uri.id) ? $key==$web_uri.id : $key==$defaultDirection)}
  <span><a href="{$weburl}?recepty/sort/{$key}-{$selectDirection}">{$actv ? '[' : ''}{$value.0} ({$sortDirection.$defaultDirection.0}){$actv ? ']' : ''}</a>, </span>
{/loop}

{if="!$url_blok"}
<a href="{$addLink}">Přidat recepty</a>
<a href="{$genLink}" onclick="return confirm('Opravdu vygenerovat? operace je časově náročná...')">Vygenerovat SQLite</a>
<a href="{$genPath}">SQLite</a>, naposledy vygenerováno: {date="d.m.Y H:i:s", $genMtime}
{/if}

{$formular}
{loop="$formular_out"}<span>{$value}, </span>{/loop}

{if="$genResult"}
<ul>
  {loop="$genResult"}
    <li>do tabulky: <strong>{$key}</strong> bylo vloženo {$value} řádků</li>
  {/loop}
</ul>
{/if}

{if="$dbResult"}

{if="$url_blok|is_numeric"}
{* rozkliknuta polozka *}
<ul>
{loop="$dbResult"}
  <li>
    <p>
      id: {$value->idrecepty},
      autor: {$value->uzivatel_login},
      kategorie: {$value->kategorie_nazev},
      nazev: <strong>{$value->recept_nazev}</strong>,
      popis: <p>{$value->recept_popis}</p>
      doba: {$value->doba},
      porce: {$value->porce},
      navrh: {$value->navrh ? 'ROZEPSANY' : 'HOTOVY'},
      Přidáno: {date_str="d.m.Y H:i:s", $value->pridano},
      Upraveno: {date_str="d.m.Y H:i:s", $value->upraveno},<br />
      pouzite nadobi: {$value->nadobi}<br />
      pouzite suroviny: {$value->suroviny}<br />
      <a href="{$editLink}/{$value->idrecepty}">upravit</a>
      <a href="{$delLink}/{$value->idrecepty}" onclick="return confirm('Opravdu chceš smazat: &quot;{$value->recept_nazev}&quot; ?')">smazat</a><br />
    </p>
  </li>
{else}
vubec nic
{/loop}
</ul>

{else}

{* vypis vsech polozek *}
<ul>
{loop="$dbResult"}
  <li>
    <p>
      <a href="{$weburl}?recepty/{$value->idrecepty}">id: {$value->idrecepty}</a>,
      autor: {$value->uzivatel_login},
      kategorie: {$value->kategorie_nazev},
      nazev: <strong>{$value->recept_nazev}</strong>,
      doba: {$value->doba},
      porce: {$value->porce},
      navrh: {$value->navrh ? 'ROZEPSANY' : 'HOTOVY'},
      Přidáno: {date_str="d.m.Y H:i:s", $value->pridano},
      Upraveno: {date_str="d.m.Y H:i:s", $value->upraveno},<br />
      pouzite nadobi: {$value->nadobi}<br />
      pouzite suroviny: {$value->suroviny}<br />
      <a href="{$editLink}/{$value->idrecepty}">upravit</a>
      <a href="{$delLink}/{$value->idrecepty}" onclick="return confirm('Opravdu chceš smazat: &quot;{$value->recept_nazev}&quot; ?')">smazat</a><br />
    </p>
  </li>
{else}
vubec nic
{/loop}
</ul>
{/if}


{/if}