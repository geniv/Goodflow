{code}//<?

// zdrojovy kod formulare
$code = '
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label" for="verze_lb">Trainz verze</label>
    <div class="mws-form-item">
      <div class="small">
        {text:name|$|maxlength|:|50,|placeholder|:|Trainz verze|,|class|:|large|,|id|:|verze_lb|@|filled|:|Musí být vyplněna trainz verze!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
</div>
<div class="mws-button-row">
  %%submit%%
</div>';

$sekce = classes\Section::build($weburl_admin.'downloads/version/', '$admin_uri.subaction', '$admin_uri.id');
$sekce
    ->setTable('trainz_versions', 'idtrainz_version')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'))
    ->setList(array(
        'query' => '$db->query(\'%%table%%\', \'idtrainz_version, name\', null, null, null, null, \'rank ASC\')',
        'name' => '{$value->name}',
        'description' => '',
        'content' => '
  <div class="grid_8 addbtn">
    %%add_link%%
  </div>
  <div id="sortable">
      %%loop_begin%%
  <div class="grid_2 mws-panel" id="item_%%id_row%%">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%name%%</span>
      <span class="idpolozky">#{%%id_row%%}</span>
    </div>
    <div class="mws-panel-body no-padding">
      %%description%%
      <div class="mws-button-row">
        %%links%%
      </div>
    </div>
  </div>
      %%loop_empty%%
    <div class="grid_8 mws-panel">
      <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
        <span>Žádná položka</span>
      </div>
    </div>
      %%loop_end%%
  </div>',
      ))
    ->setAdd(array(
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'title' => 'Přidat verzi',
      ))
    ->setEdit(array(
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'title' => 'Upravit verzi',
      ))
    ->setDel(array(
        'enabled' => $user->isAllowed($acl_resource, 'del'),
        'title' => 'Smazat verzi',
      ));
{/code}

{compile="$sekce->render()"}