{code}//<?
$sekce = classes\Section::build($weburl_admin.'news/icons/', '$admin_uri.subaction', '$admin_uri.id');
$sekce
    ->setTable('news_icons', 'idnews_icon')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode('
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label" for="nazev_ikony_lb">Popis ikony</label>
    <div class="mws-form-item">
      <div class="small">
        {text:name|$|maxlength|:|50|,|placeholder|:|Popis ikony|,|class|:|large|,|id|:|nazev_ikony_lb|@|filled|:|Musí být vyplněn popis ikony!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="cesta_ikony_lb">Cesta k ikoně</label>
    <div class="mws-form-item">
      <div class="small">
        {text:path|$|maxlength|:|50|,|placeholder|:|název_ikony.png|,|class|:|large|,|id|:|cesta_ikony_lb|@|filled|:|Musí být vyplněna cesta ikony!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
</div>
<div class="mws-button-row">
  %%submit%%
</div>
', array('class' => 'mws-form'))
    ->setList(array(
        'name' => '{$value->name}',
        'content' => '
  <div class="grid_8 addbtn">
    %%add_link%%
  </div>
      %%loop_begin%%
  <div class="grid_2 mws-panel">
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
      %%loop_end%%',
        'description' => '
        <div class="mws-summary-2">
          <div class="sloupec h_70">
            <img src="'.$weburl.'img/icons/{$value->path}" />
          </div>
        </div>',
        'add_link_title' => 'Přidat ikonu',
      ))
    ->setAdd(array(
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'title' => 'Přidat ikonu',
      ))
    ->setEdit(array(
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'title' => 'Upravit ikonu',
      ))
    ->setDel(array(
        'enabled' => $user->isAllowed($acl_resource, 'del'),
        'title' => 'Smazat ikonu',
      ));
{/code}
{compile="$sekce->render()"}
