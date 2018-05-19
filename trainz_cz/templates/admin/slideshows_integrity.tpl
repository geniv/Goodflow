<div class="grid_8 mws-tree-navigace-noaddbtn">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Kontrola nepřiřazených autorů oproti databázi</span>
    </div>
  </div>
</div>
{loop="$db->rawQuery('SELECT login, alias, idslideshow, description FROM users
                      JOIN slideshows ON author=login')"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Autor v databázi: {$value->login}{if="$value->alias"} ({$value->alias}){/if} odpovídá ručně zadanému autorovi: {$value->login}</span>
    <span class="idpolozky">Popis: {$value->description}, ID: {$value->idslideshow}</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div class="mws-button-row">
      <a href="{$weburl_admin}slideshows/edit/{$value->idslideshow}" class="btn btn-small btn-primary btn-primary18">Zobrazit</a>
    </div>
  </div>
</div>
{emptyloop}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
    <span>Nebyl zjištěn nepřiřazený autor oproti databázi</span>
  </div>
</div>
{/loop}