  <div class="non-shortable-content">
     <h1>Nabídka her</h1>
     <h6>Let's get a quick overview of some features...</h6>  
  </div>

  <div class="shortable-content">

      <div class="box _75">
        <div class="box-header">
          Nabídka her
        </div>

        <div class="box-content padd-10">

{if="!$url_blok"}
<a href="{$addLink}">přidat hru do nabídky</a>
{/if}

{$formular}
{loop="$formular_out"}<span>{$value}</span>{/loop}

{if="$dbVypis"}
<ul id="sortable">
{loop="$dbVypis"}
  <li id="arrayporadi_{$value->idnabidka_hra}">
    {$value->nazev} ;
    cena: {$value->cena} ;
    min: {$value->minslotu} ;
    max: {$value->maxslotu} ;
{$value->pridano};
{$value->upraveno}
    <a href="{$editLink}/{$value->idnabidka_hra}">editovat</a>
    <a href="{$delLink}/{$value->idnabidka_hra}" onclick="return confirm('opravdu smazat {$value->nazev} ??')">smazat</a>
  </li>
{/loop}
</ul>
<div id="status_drag"></div>
{if="$counter1==-1"}no to je fejlicek nooo, proste nic tu neni nooo...{/if}
{/if}

        </div>
      </div>
