<div class="grid_8 mws-tree-navigace-noaddbtn">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Kontrola integrity překladů</span>
    </div>
  </div>
</div>
<div class="grid_8">
  <div class="grid_8_full">
    <div class="grid_4_vypis grid_4_vypis_liche mws-panel">
      <div class="mws-panel-header mws-panel-header-normal">
        <span class="nazevpolozky">Jazyky v sekci: Download</span>
        <span class="idpolozky">Počet položek: {$db->query('downloads', 'COUNT(iddownload) pocet')->getFirst()->pocet}</span>
      </div>
      <div class="mws-panel-body clearfix">
        <table class="mws-summary-3">
        {loop="$db->rawQuery('SELECT languages.code, COUNT(iddownload) pocet FROM downloads
                              LEFT JOIN languages_has_downloads USING(iddownload)
                              LEFT JOIN languages USING(idlanguage)
                              GROUP BY idlanguage')"}
          <tr>
            <td class="key key_m">Kód jazyka:</td><td class="val">{$value->code ?: '-- špatný kód jazyka --'}</td>
            <td class="key">Počet překladů:</td><td class="val">{$value->pocet}</td>
          </tr>
        {/loop}
        </table>
        <table class="mws-summary-3 mws-summary-3-r">
        {loop="$db->rawQuery('SELECT iddownload id, (SELECT COUNT(idlanguage) FROM languages) - COUNT(iddownload) pocet FROM languages_has_downloads
                              GROUP BY iddownload
                              HAVING COUNT(iddownload) < (SELECT COUNT(idlanguage) FROM languages)')"}
          <tr>
            <td class="key key_s">Chybé ID:</td><td class="val">{$value->id}</td>
            <td class="key key_l">Počet chybějících překladů:</td><td class="val">{$value->pocet}</td>
          </tr>
        {emptyloop}
          <tr>
            <td class="empty">Integrita překladů v pořádku!</td>
          </tr>
        {/loop}
        </table>
      </div>
    </div>
    <div class="grid_4_vypis mws-panel">
      <div class="mws-panel-header mws-panel-header-normal">
        <span class="nazevpolozky">Jazyky v sekci: Download Kategorie</span>
        <span class="idpolozky">Počet položek: {$db->query('downloads_category', 'COUNT(iddownload_category) pocet')->getFirst()->pocet}</span>
      </div>
      <div class="mws-panel-body clearfix">
        <table class="mws-summary-3">
        {loop="$db->rawQuery('SELECT languages.code, COUNT(iddownload_category) pocet FROM downloads_category
                              LEFT JOIN languages_has_downloads_category USING(iddownload_category)
                              LEFT JOIN languages USING(idlanguage)
                              GROUP BY idlanguage')"}
          <tr>
            <td class="key key_m">Kód jazyka:</td><td class="val">{$value->code ?: '-- špatný kód jazyka --'}</td>
            <td class="key">Počet překladů:</td><td class="val">{$value->pocet}</td>
          </tr>
        {/loop}
        </table>
        <table class="mws-summary-3 mws-summary-3-r">
        {loop="$db->rawQuery('SELECT iddownload_category id, (SELECT COUNT(idlanguage) FROM languages) - COUNT(iddownload_category) pocet FROM languages_has_downloads_category
                              GROUP BY iddownload_category
                              HAVING COUNT(iddownload_category) < (SELECT COUNT(idlanguage) FROM languages)')"}
          <tr>
            <td class="key key_s">Chybé ID:</td><td class="val">{$value->id}</td>
            <td class="key key_l">Počet chybějících překladů:</td><td class="val">{$value->pocet}</td>
          </tr>
        {emptyloop}
          <tr>
            <td class="empty">Integrita překladů v pořádku!</td>
          </tr>
        {/loop}
        </table>
      </div>
    </div>
  </div>
  <div class="grid_8_full">
    <div class="grid_4_vypis grid_4_vypis_liche mws-panel">
      <div class="mws-panel-header mws-panel-header-normal">
        <span class="nazevpolozky">Jazyky v sekci: Odkazy</span>
        <span class="idpolozky">Počet položek: {$db->query('links_category', 'COUNT(idlink_category) pocet')->getFirst()->pocet}</span>
      </div>
      <div class="mws-panel-body clearfix">
        <table class="mws-summary-3">
        {loop="$db->rawQuery('SELECT languages.code, COUNT(idlink_category) pocet FROM links_category
                              LEFT JOIN languages_has_links_category USING(idlink_category)
                              LEFT JOIN languages USING(idlanguage)
                              GROUP BY idlanguage')"}
          <tr>
            <td class="key key_m">Kód jazyka:</td><td class="val">{$value->code ?: '-- špatný kód jazyka --'}</td>
            <td class="key">Počet překladů:</td><td class="val">{$value->pocet}</td>
          </tr>
        {/loop}
        </table>
        <table class="mws-summary-3 mws-summary-3-r">
        {loop="$db->rawQuery('SELECT idlink_category id, (SELECT COUNT(idlanguage) FROM languages) - COUNT(idlink_category) pocet FROM languages_has_links_category
                              GROUP BY idlink_category
                              HAVING COUNT(idlink_category) < (SELECT COUNT(idlanguage) FROM languages)')"}
          <tr>
            <td class="key key_s">Chybé ID:</td><td class="val">{$value->id}</td>
            <td class="key key_l">Počet chybějících překladů:</td><td class="val">{$value->pocet}</td>
          </tr>
        {emptyloop}
          <tr>
            <td class="empty">Integrita překladů v pořádku!</td>
          </tr>
        {/loop}
        </table>
      </div>
    </div>
    <div class="grid_4_vypis mws-panel">
      <div class="mws-panel-header mws-panel-header-normal">
        <span class="nazevpolozky">Jazyky v sekci: Novinky</span>
        <span class="idpolozky">Počet položek: {$db->query('news', 'COUNT(idnews) pocet')->getFirst()->pocet}</span>
      </div>
      <div class="mws-panel-body clearfix">
        <table class="mws-summary-3">
        {loop="$db->rawQuery('SELECT languages.code, COUNT(idnews) pocet FROM news
                              LEFT JOIN languages_has_news USING(idnews)
                              LEFT JOIN languages USING(idlanguage)
                              GROUP BY idlanguage')"}
          <tr>
            <td class="key key_m">Kód jazyka:</td><td class="val">{$value->code ?: '-- špatný kód jazyka --'}</td>
            <td class="key">Počet překladů:</td><td class="val">{$value->pocet}</td>
          </tr>
        {/loop}
        </table>
        <table class="mws-summary-3 mws-summary-3-r">
        {loop="$db->rawQuery('SELECT idnews id, (SELECT COUNT(idlanguage) FROM languages) - COUNT(idnews) pocet FROM languages_has_news
                              GROUP BY idnews
                              HAVING COUNT(idnews) < (SELECT COUNT(idlanguage) FROM languages)')"}
          <tr>
            <td class="key key_s">Chybé ID:</td><td class="val">{$value->id}</td>
            <td class="key key_l">Počet chybějících překladů:</td><td class="val">{$value->pocet}</td>
          </tr>
        {emptyloop}
          <tr>
            <td class="empty">Integrita překladů v pořádku!</td>
          </tr>
        {/loop}
        </table>
      </div>
    </div>
  </div>
</div>
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Databáze</span>
    </div>
  </div>
</div>
{code}//<?
  $import_render = null;
  $import_out = null;
  $import = null;
  if (isset($admin_uri['subaction'])) {
    $e = new classes\MySQLExporter($handle, $db);
    switch ($admin_uri['subaction']) {
      case 'export':  // export databaze
//TODO docasne zakomentovano!
        // $file_name = 'export_db.json';
        // file_put_contents($file_name, $e->export());  // export
        // classes\Core::getDownloadFile($file_name);
      break;

      case 'import':  // import databaze
        $import = classes\TplForm::compile('
<div style="padding: 10px;">
  {file:soubor|@|filled|:|Musí být vybrán soubor!}
</div>
<div style="padding: 0 10px 3px;">
  {checkbox:drop|$|class|:|ibutton|,|data-label-on|:|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SMAZAT TABULKY&nbsp;&nbsp;|,|data-label-off|:|&nbsp;&nbsp;VYPRÁZDNIT TABULKY&nbsp;&nbsp;}
</div>
<div class="mws-button-row">
  {submit:;Importovat databázi|$|class|:|btn btn-small btn-primary btn-primary18}
</div>');
        $import->setAutoHide(true)
              //~ ->setSubmitBlocker(true)
              ->setSubmitSecurity(false);
        $import_render = $import->render();

        if ($import->isSuccess(true)) {
          $val = $import->getValues();
          // $import_out = $e->import(file_get_contents($val['soubor']['tmp_name']), isset($val['drop']));
//TODO docasne zakomentovano!
        }
      break;
    }
  }
{/code}
<div class="grid_4 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Export</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div class="mws-button-row">
      <a href="{$weburl_admin}settings/integrity/export" class="btn btn-small btn-primary btn-primary18">Exportovat databázi</a>
    </div>
  </div>
</div>
<div class="grid_4 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Import</span>
  </div>
  <div class="mws-panel-body no-padding">
    {if="!$import_render"}
    <div class="mws-button-row">
      <a href="{$weburl_admin}settings/integrity/import" class="btn btn-small btn-primary btn-primary18">Otevřít import</a>
    </div>
    {/if}
    {if="$import && $import->isErrors()"}
    <div class="mws-form-message error">
      Nastaly tyto chyby:
      <ul>
        {loop="$import->getErrors()"}
        <li>{$value}</li>
        {/loop}
      </ul>
    </div>
    {/if}
    {if="$import_out"}
    <div class="mws-form-message info">
      Byl proveden import databáze!
      <ul>
        {loop="$import_out"}
        <li>Název tabulky: {$key}</li>
        <li>Přidáno záznamů: {$value}</li>
        {/loop}
      </ul>
    </div>
    {/if}
    {$import_render}
  </div>
</div>
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Výpis logů</span>
    </div>
  </div>
</div>
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Seznam logů</span>
  </div>
  <div class="mws-panel-body no-padding">
    <div class="mws-button-row" style="padding-bottom: 5px;">
      {loop="classes\Core::getListFile(array('path' => 'logs/', 'full' => true, 'sort' => array($core::LIST_SORT_MTIME, SORT_ASC)))"}
      <a href="{$weburl_admin}settings/integrity/{$value}" class="btn btn-small btn-primary btn-primary18{if="isset($admin_uri['id']) && $admin_uri['id'] == basename($value)"} active{/if}" style="margin: 0 5px 5px 0;">{$value|basename} ({$core::getFileSize($value)})</a>
      {/loop}
    </div>
  </div>
</div>
{if="isset($admin_uri['subaction']) && $admin_uri['subaction'] == 'logs' && isset($admin_uri['id'])"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Výpis logu: {$admin_uri['id']}</span>
  </div>
  <div class="mws-panel-body no-padding">
    <pre style="margin: 0; border: none;">{function="file_get_contents('logs/' . $admin_uri['id'])"}</pre>
  </div>
</div>
{/if}
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Výpis nadbytečného obsahu záznamů</span>
    </div>
  </div>
</div>
{loop="$db->rawQuery('SELECT idlanguage, iddownload, name, description FROM languages_has_downloads
                      WHERE description LIKE ? OR description LIKE ? OR description LIKE ? OR description LIKE ?', array('%<span class=_hps_>%', '%<div id=_gt-res-tools_>%', '%span id=_%', '%div id=_%'))"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">{$value->name}</span>
    <span class="idpolozky">ID: #{$value->iddownload}</span>
  </div>
  <div class="mws-panel-body no-padding" style="border-bottom: none;">
    <pre style="margin: 0; border: none;">{$value->description|htmlentities}</pre>
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
    <span>Nebyl zjištěn nadbytečný obsah v záznamech</span>
  </div>
</div>
{/loop}
<div class="grid_8 mws-tree-navigace-noaddbtn-2">
  <div class="mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Výpis souborů, které budou automaticky smazány cronem</span>
    </div>
  </div>
</div>
{loop="$db->rawQuery('SELECT idtrainz_cdp, name FROM trainz_cdp
                      LEFT JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                      WHERE iddownload IS NULL')"}
<div class="grid_4 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">{$value->name}</span>
    <span class="idpolozky">#{$value->idtrainz_cdp}</span>
  </div>
</div>
{emptyloop}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
    <span>Nebyl zjištěn žádný soubor</span>
  </div>
</div>
{/loop}