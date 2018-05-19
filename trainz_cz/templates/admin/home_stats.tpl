<div class="grid_8 mws-tree-navigace-noaddbtn">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Statistiky</span>
    </div>
  </div>
</div>
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Počet nových objektů/map za poslední dva týdny</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div id="objektymapydvatydny" style="height: 300px;"></div>
  </div>
</div>
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Počet nových screenshotů za poslední dva týdny</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div id="slideshowsdvatydny" style="height: 300px;"></div>
  </div>
</div>
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Počet nově registrovaných uživatelů za poslední dva týdny</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div id="uzivateledvatydny" style="height: 300px;"></div>
  </div>
</div>
<div class="grid_4 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Podíl Trainz verzí</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div id="trainzverze" style="height: 600px;"></div>
  </div>
</div>
<div class="grid_4 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Podíl přiřazených/nepřiřazených uživatelů</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div id="prirazeniuzivatele" style="height: 600px;"></div>
  </div>
</div>

<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Počet objektů/map a screenshotů k registrovaným uživatelům</span>
  </div>
  <div class="mws-panel-body">
    <ol class="stat_vypisy">
      {loop="$db->rawQuery('SELECT login, alias,
                                (SELECT COUNT(iddownload) FROM downloads WHERE downloads.iduser=_u.iduser AND author IS NULL AND confirmed=1 AND deleted IS NULL) poc_d,
                                (SELECT COUNT(idslideshow) FROM slideshows WHERE slideshows.iduser=_u.iduser AND author IS NULL AND confirmed=1) poc_s
                            FROM users AS _u
                            ORDER BY login ASC')"}
        <li>{$value->login}{if="$value->alias"} ($value->alias){/if}<em>objektů: {$value->poc_d}, screenshotů: {$value->poc_s}</em></li>
      {emptyloop}
      <li>Žádný uživatel</li>
      {/loop}
    </ol>
  </div>
</div>

{loop="range(1, 0)"}
{$c = $db->rawQuery('SELECT COUNT(iddownload) pocet, visible FROM downloads
                    WHERE confirmed=1 AND visible=?
                    GROUP BY visible ', array($value))->getFirst()}
<div class="grid_2_5 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">{$value == 1 ? 'Počet zobrazených objektů/map' : 'Počet nezobrazených objektů/map'}</span>
    <span class="idpolozky">{$c ? $c->pocet : 0}</span>
  </div>
</div>
{/loop}
<div class="grid_2_5 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Počet deaktivovaných objektů/map</span>
    <span class="idpolozky">{$db->query('downloads', 'COUNT(iddownload) pocet', 'deleted IS NOT NULL')->getFirst()->pocet}</span>
  </div>
</div>
{loop="$db->rawQuery('SELECT iddownload, _lhd.name FROM downloads
                      JOIN languages_has_downloads _lhd USING(iddownload)
                      JOIN languages USING(idlanguage)
                      WHERE idlanguage=1 AND confirmed=1 AND visible=0')"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Nezobrazený objekt/mapa</span>
    <span class="idpolozky">{$value->name}, #{$value->iddownload}</span>
  </div>
</div>
{/loop}
<div class="grid_4 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Žebříček autorů</span>
    <span class="idpolozky"><i class="icon-thumbs-down" title="Nepřiřazený uživatel"></i> - Nepřiřazený uživatel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-thumbs-up" title="Přiřazený uživatel"></i> - Přiřazený uživatel</span>
  </div>
  <div class="mws-panel-body">
    <ol class="stat_vypisy">
      {loop="$db->rawQuery('SELECT login, alias, author, COUNT(iduser) + COUNT(author) pocet FROM downloads _d
                            LEFT JOIN users _u USING(iduser)
                            WHERE
                            _d.confirmed=1 AND
                            _d.visible=1 AND
                            _d.deleted IS NULL
                            GROUP BY iduser, author
                            ORDER BY pocet DESC, COALESCE(login, author) ASC')"}
      <li class=""{if="$counter1 == 9"} style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px dotted;"{/if}>
        {if="$value->author"}
        <span><i class="icon-thumbs-down" title="Nepřiřazený uživatel"></i> {$value->author}</span>
        {else}
        <span><i class="icon-thumbs-up" title="Přiřazený uživatel"></i> {$value->login}{if="$value->alias"} ($value->alias){/if}</span>
        {/if}
        <em>{$value->pocet} {$core::getCzechPlural($value->pocet, array('objekt', 'objekty', 'objektů'))}</em>
      </li>
      {/loop}
    </ol>
  </div>
</div>
<div class="grid_4 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">100 nejstahovanějších objektů/map</span>
  </div>
  <div class="mws-panel-body">
    <ol class="stat_vypisy">
      {loop="$db->rawQuery('SELECT _lhd.name, _tc.name cdp_name, _tc.counter FROM trainz_cdp _tc
                            JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                            JOIN languages_has_downloads _lhd USING(iddownload)
                            WHERE idlanguage=1 AND counter>1
                            ORDER BY counter DESC, _lhd.name ASC
                            LIMIT 0,100')"}
      <li class=""{if="$counter1 == 9"} style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px dotted;"{/if}>{$value->name}, [{$value->cdp_name}]<em>{$value->counter}x</em></li>
      {emptyloop}
      <li>Žádný objekt</li>
      {/loop}
    </ol>
  </div>
</div>