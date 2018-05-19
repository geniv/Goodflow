  <div class="non-shortable-content">
     <h1>Uživatelé</h1>
     <h6>Let's get a quick overview of some features...</h6>  
  </div>

  <div class="shortable-content">

      <div class="box _75">
        <div class="box-header">
          Uživatelé
        </div>
        
        <div class="box-content padd-10">



{$formular}
{loop="$formular_out"}<span>{$value}</span>{/loop}

{if="$dbVypis"}
<ul>{loop="$dbVypis"}
  <li>
    {$value->login}
    ({$value->role})
    zeme: {$value->zeme} ;
    email: {$value->email} ;
{$value->pridano}
{$value->upraveno}
<input type="checkbox" disabled{if="$value->potvrzeno"} checked{/if}>
    <a href="{$editLink}/{$value->iduzivatel}">editovat</a>
    <a href="{$delLink}/{$value->iduzivatel}" onclick="return confirm('opravdu smazat {$value->login} ??')">smazat</a>
  </li>
{else}
no to je fejlicek nooo, proste nic tu neni nooo...
{/loop}</ul>
{/if}

        </div>
      </div>
