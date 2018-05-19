  <div class="non-shortable-content">
     <h1>Domény</h1>
     <h6>Sekce Domény</h6>
  </div>

  <div class="shortable-content">
{if="!$url_blok"}
<a href="{$addLink}" class="button float_l clear_fix odsazenitl">Přidat doménu</a>
{/if}
{$formular}
{loop="$formular_out"}<span>{$value}</span>{/loop}
{if="$dbVypis"}
{loop="$dbVypis"}
      <div class="box _75 clear_fix">
        <div class="box-header">
          {$value->nadpis}
        </div>
        <div class="box-content">
          <div class="form-row">
            {$value->zprava}
          </div>
          <div class="form-row">
            <div class="actions_bareditdel">
              <p>Přidáno: {date_str="d.m.Y H:i:s", $value->pridano}</p>
              <p>Upraveno: {date_str="d.m.Y H:i:s", $value->upraveno}</p>
            </div>
            <a href="{$editLink}/{$value->idnovinky}" class="grey">Upravit</a>
            <a href="{$delLink}/{$value->idnovinky}" onclick="return confirm('Opravdu chceš smazat: &quot;{$value->nadpis}&quot; ?')" class="grey float_r">Smazat</a>
          </div>
        </div>
      </div>
{else}
no to je fejlicek nooo, proste nic tu neni nooo...
{/loop}
{/if}
