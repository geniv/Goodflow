<div class="grid_8 mws-tree-navigace-noaddbtn">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Kontrola nepřiřazených autorů oproti databázi</span>
    </div>
  </div>
</div>
{loop="$db->rawQuery('SELECT login, alias, iddownload, languages_has_downloads.name FROM users
                      JOIN downloads ON (author=login OR SUBSTRING_INDEX(author, \' \', 1)=login)
                      JOIN languages_has_downloads USING(iddownload)
                      JOIN languages USING(idlanguage)
                      WHERE languages.code=?', array('cs'))"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Autor v databázi: {$value->login}{if="$value->alias"} ({$value->alias}){/if} odpovídá ručně zadanému autorovi: {$value->login}</span>
    <span class="idpolozky">Název: {$value->name}, ID: {$value->iddownload}</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div class="mws-button-row">
      <a href="{$weburl_admin}downloads/edit/{$value->iddownload}" class="btn btn-small btn-primary btn-primary18">Zobrazit</a>
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
{*
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Seznam nepřiřazených autorů</span>
    </div>
    <div class="mws-panel-body clearfix">
{loop="$db->rawQuery('SELECT author, COUNT(author) pocet FROM downloads
                      WHERE
                        author IS NOT NULL AND
                        confirmed=1 AND
                        deleted IS NULL
                        GROUP BY author
                        ORDER BY pocet DESC, author ASC')"}
      <p class="grid_2"><span style="display: inline-block; width: 10%; text-align: right; margin-right: 10px;">{$value->pocet}x</span>{$value->author}</p>
{emptyloop}
      <p class="grid_8" style="text-align: center;">Nebyl zjištěn nepřiřazený autor</p>
{/loop}
    </div>
  </div>
</div>
*}
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Kontrola nepřeložených záznamů</span>
    </div>
  </div>
</div>
{loop="$db->rawQuery('SELECT (SELECT name FROM languages_has_downloads d0 WHERE d0.iddownload=d1.iddownload AND d0.idlanguage=?) name, iddownload, COUNT(languages_has_downloads.name) pocet FROM downloads d1
                      JOIN languages_has_downloads USING(iddownload)
                      JOIN languages l1 USING(idlanguage)
                      WHERE (languages_has_downloads.name LIKE ? OR languages_has_downloads.name LIKE ?)
                      GROUP BY iddownload', array(1, '% - en', '% - de'))"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">{$value->pocet}x nepřeložený záznam v: {$value->name}</span>
    <span class="idpolozky">ID: {$value->iddownload}</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div class="mws-button-row">
      <a href="{$weburl_admin}downloads/edit/{$value->iddownload}" class="btn btn-small btn-primary btn-primary18">Zobrazit</a>
    </div>
  </div>
</div>
{emptyloop}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
    <span>Nebyl zjištěn nepřeložený záznam</span>
  </div>
</div>
{/loop}
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Kontrola nepřidělených kuidů k objektům</span>
    </div>
  </div>
</div>
{loop="$db->rawQuery('SELECT idtrainz_kuid, _tk.kuid, iddownload, _tc.name cdp_name, _lhd.name, _u.login, _u.alias, author FROM trainz_cdp _tc
                      JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                      JOIN downloads USING(iddownload)
                      JOIN trainz_cdp_has_trainz_kuids _tchtk USING(idtrainz_cdp)
                      JOIN trainz_kuids _tk USING(idtrainz_kuid)
                      LEFT JOIN users _u USING(iduser)
                      JOIN languages_has_downloads _lhd USING(iddownload)
                      JOIN languages USING(idlanguage)
                      WHERE languages.code=? AND _tk.name IS NULL', array('cs'))"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">{$crate::formatKuid($value->kuid)} není přidělen v: {$value->name}{if="$value->cdp_name"} ({$value->cdp_name}){/if}</span>
    <span class="idpolozky">Autor: {$value->login}{if="$value->alias"} ({$value->alias}){/if}{$value->author}, kuid ID: {$value->idtrainz_kuid}, objekt ID: {$value->iddownload}</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div class="mws-button-row">
      <a href="{$weburl_admin}downloads/kuids/edit/{$value->idtrainz_kuid}" class="btn btn-small btn-primary btn-primary18">Zobrazit kuid</a>
      <a href="{$weburl_admin}downloads/edit/{$value->iddownload}" class="btn btn-small btn-primary btn-primary18">Zobrazit objekt</a>
    </div>
  </div>
</div>
{emptyloop}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
    <span>Nebyl zjištěn nepřidělený kuid</span>
  </div>
</div>
{/loop}
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Kontrola rozbitých vazeb mezi kuidy a soubory</span>
    </div>
  </div>
</div>
{loop="$db->rawQuery('SELECT
                        _tc.name cdp_name,
                        _tk.idtrainz_kuid, _tk.kuid, _tk.name kuid_name,
                        iddownload, _lhd.name download_name
                      FROM trainz_cdp _tc
                      JOIN trainz_cdp_has_trainz_kuids USING(idtrainz_cdp)
                      JOIN trainz_kuids _tk USING(idtrainz_kuid)
                      JOIN downloads_has_trainz_cdp _dhtc ON _dhtc.idtrainz_cdp=_tc.idtrainz_cdp
                      JOIN downloads USING(iddownload)
                      JOIN languages_has_downloads _lhd USING(iddownload)
                      JOIN languages USING(idlanguage)
                      WHERE languages.code=? AND confirmed=1 AND _tk.idtrainz_cdp IS NULL
                      ORDER BY _lhd.name ASC, _tk.idtrainz_kuid ASC', array('cs'))"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">{$value->kuid_name}, {$crate::formatKuid($value->kuid)}</span>
    <span class="idpolozky">[ID: #{$value->iddownload}], {$value->download_name}&nbsp;&nbsp;&gt;&nbsp;&nbsp;{$value->cdp_name}</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div class="mws-button-row">
      <a href="{$weburl_admin}downloads/kuids/edit/{$value->idtrainz_kuid}" class="btn btn-small btn-primary btn-primary18">Zobrazit kuid</a>
    </div>
  </div>
</div>
{emptyloop}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
    <span>Nebyla zjištěna rozbitá vazba</span>
  </div>
</div>
{/loop}
{code}
  // nacte pole souboru
  $list = classes\Core::getListFile(array('path' => 'files/'));
  // zmereni velikosti
  $size = array_map(function($v) {
      return filesize('files/'.$v);
    }, $list);
  // vyfiltrovani 0b
  $fail_size = array_filter($size, function($v) {
      return $v == 0;
    });
  // prizareni path jmena k indexu
  $fail_list = array_map(function($v) use ($list) {
      return $list[$v];
    }, array_keys($fail_size));
{/code}
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Kontrola chybně nahraných souborů</span>
    </div>
  </div>
</div>
{if="$fail_list"}
{loop="$db->rawQuery('SELECT idtrainz_cdp, name, path, iddownload FROM trainz_cdp
                      LEFT JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                      WHERE path IN (' . implode(', ', array_fill(0, count($fail_list), '?')) . ')', $fail_list)"}
<div class="grid_4 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Chybný soubor</span>
  </div>
  <div class="mws-panel-body no-padding">
    <p style="padding: 9.5px;">{$value->path}</p>
    <div class="mws-button-row">
      <p style="margin: 3px 0 0 0;" class="clearfix">{$value->name}<span class="pull-right">#{$value->idtrainz_cdp}</span></p>
    </div>
    <div class="mws-button-row">
    {if="$value->iddownload"}
      <a href="{$weburl_admin}downloads/edit/{$value->iddownload}" class="btn btn-small btn-primary btn-primary18">Zobrazit objekt</a>
    {else}
      <p style="margin: 3px 0 0 0;">Soubor bude automaticky smazán!</p>
    {/if}
    </div>
  </div>
</div>
{/loop}
{else}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
    <span>Nebyly zjištěny chybně nahrané soubory</span>
  </div>
</div>
{/if}
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Kontrola chybějících souborů v objektech</span>
    </div>
  </div>
</div>
{loop="$db->rawQuery('SELECT iddownload, _lhd.name FROM downloads
                      JOIN downloads_has_trainz_cdp USING(iddownload)
                      JOIN languages_has_downloads _lhd USING(iddownload)
                      JOIN languages USING(idlanguage)
                      JOIN trainz_cdp USING(idtrainz_cdp)
                      WHERE languages.code=? AND trainz_cdp.name=?
                      GROUP BY iddownload', array('cs', ''))"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">{$value->name}</span>
    <span class="idpolozky">ID: #{$value->iddownload}</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div class="mws-button-row">
      <a href="{$weburl_admin}downloads/edit/{$value->iddownload}" class="btn btn-small btn-primary btn-primary18">Zobrazit objekt</a>
    </div>
  </div>
</div>
{emptyloop}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
    <span>Nebyly zjištěny žádné chybějící soubory v objektech</span>
  </div>
</div>
{/loop}
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Kontrola nadbytečného obsahu záznamů</span>
    </div>
  </div>
</div>
{if="($pocet = $db->rawQuery('SELECT COUNT(name) pocet FROM languages_has_downloads
                            WHERE description LIKE ? OR description LIKE ? OR description LIKE ? OR description LIKE ?', array('%<span class=_hps_>%', '%<div id=_gt-res-tools_>%', '%span id=_%', '%div id=_%'))->getFirst()->pocet) > 0"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Počet záznamů s nadbytečným obsahem:</span>
    <span class="idpolozky">{$pocet}</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div class="mws-button-row">
      <input type="button" value="Opravit záznamy" class="btn btn-small btn-primary btn-primary18" onclick="fixTranslate()" />
    </div>
  </div>
</div>
{else}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
    <span>Nebyl zjištěn nadbytečný obsah v záznamech</span>
  </div>
</div>
{/if}