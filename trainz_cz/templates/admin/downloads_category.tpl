{code}//<?

// zdrojovy kod formulare
$code = '
  <div class="mws-tabs mws-tabs-slouceny grid_8">
    <ul>
    {loop="$crate->getListLanguages()"}
      <li><a href="#tab-{$value->code}">{$translate.lang_code[$value->code]}</a></li>
    {/loop}
    </ul>
    <div class="mws-form-inline">';
  foreach ($crate->getListLanguages() as $v) {
    $code .= '
      <div id="tab-'.$v->code.'">
        <div class="mws-form-row">
          <label class="mws-form-label" for="nadpis_'.$v->code.'_lb">Název kategorie '.$translate['lang_code'][$v->code].'</label>
          <div class="mws-form-item">
            <div class="small">
              {text:name['.$v->idlanguage.']|$|maxlength|:|50|,|placeholder|:|Název kategorie '.$translate['lang_code'][$v->code].'|,|class|:|large ajax_category_name|,|id|:|nadpis_'.$v->code.'_lb|@|filled|:|Název kategorie '.$translate['lang_code'][$v->code].' musí být vyplněn!}
              <span class="result_ajax_name pull-right error pull-right"></span>
            </div>
            <span class="error">Povinné pole!</span>
          </div>
        </div>
        <div class="mws-form-row hide">
          <label class="mws-form-label" for="text_'.$v->code.'_lb">Popis kategorie '.$translate['lang_code'][$v->code].'</label>
          <div class="mws-form-item">
            <div class="small">
              {textarea:description['.$v->idlanguage.']|$|maxlength|:|100|,|placeholder|:|Popis kategorie '.$translate['lang_code'][$v->code].'|,|class|:|large|,|id|:|text_'.$v->code.'_lb}
            </div>
          </div>
        </div>
      </div>';
  }
$code .= '
    </div>
  </div>
  <div class="grid_8 mws-panel">
    <div class="mws-panel-body no-padding">
      <div class="mws-form-inline">
        <div class="mws-form-row">
          <label class="mws-form-label" for="nadr_kat_lb">Nadřazená kategorie</label>
          <div class="mws-form-item">
            <div class="medium">
              {select:parent|$|class|:|mws-select2|,|id|:|nadr_kat_lb}
            </div>
          </div>
        </div>
      </div>
      <div class="mws-button-row">
        %%submit%%
      </div>
    </div>
  </div>';

$sekce = classes\Section::build($weburl_admin.'downloads/category/', '$admin_uri.subaction', '$admin_uri.id');
$sekce
    ->setTable('downloads_category', 'iddownload_category')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'), array('admin_uri', 'crate', 'translate'))
    ->setList(array(
        'name' => '{$value->name}',
        'content' => '
  <div class="grid_8 addbtn">
    %%add_link%%
  </div>
  <div class="grid_8 mws-tree-navigace2">
    <div class="mws-panel">
      <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
        <span>Download</span>
      </div>
    {if="count($v0list = $crate->getListDownloadCategory(null, \'cs\')->getAll()) > 0"}
      <div class="mws-panel mws-panel-v3">
        <div class="mws-panel-body no-padding kategorie-treeview">
          <ul id="navigation-treeview" class="treeview2">
          {loop="$v0list"}{$level = 0}{*==========1 uroven*}
            <li id="item_{$value->iddownload_category}">
              <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em>%%links%%
              {if="count($v1list = $crate->getListDownloadCategory($value->iddownload_category, \'cs\')->getAll()) > 0"}
              <ul>
                {loop="$v1list"}{$level = 1}{*==========2 uroven*}
                <li id="item_{$value->iddownload_category}">
                  <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em>%%links%%
                  {if="count($v2list = $crate->getListDownloadCategory($value->iddownload_category, \'cs\')->getAll()) > 0"}
                  <ul>
                    {loop="$v2list"}{$level = 2}{*==========3 uroven*}
                    <li id="item_{$value->iddownload_category}">
                      <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em>%%links%%
                      {if="count($v3list = $crate->getListDownloadCategory($value->iddownload_category, \'cs\')->getAll()) > 0"}
                      <ul>
                        {loop="$v3list"}{$level = 3}{*==========4 uroven*}
                        <li id="item_{$value->iddownload_category}">
                          <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em>%%links%%
                          {if="count($v4list = $crate->getListDownloadCategory($value->iddownload_category, \'cs\')->getAll()) > 0"}
                          <ul>
                            {loop="$v4list"}{$level = 4}{*==========5 uroven*}
                            <li id="item_{$value->iddownload_category}">
                              <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em>%%links%%
                              {if="count($v5list = $crate->getListDownloadCategory($value->iddownload_category, \'cs\')->getAll()) > 0"}
                              <ul>
                                {loop="$v5list"}{$level = 5}{*==========6 nad uroven*}
                                <li id="item_{$value->iddownload_category}">
                                  <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em><a href="#" onclick="return false" class="btn btn-small btn-warning btn-warning19">Tato kategorie nebude vykreslena!</a>%%links%%
                                  {if="count($v6list = $crate->getListDownloadCategory($value->iddownload_category, \'cs\')->getAll()) > 0"}
                                  <ul>
                                    {loop="$v6list"}{$level = 6}{*==========7 nad uroven*}
                                    <li id="item_{$value->iddownload_category}">
                                      <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em><a href="#" onclick="return false" class="btn btn-small btn-warning btn-warning19">Tato kategorie nebude vykreslena!</a>%%links%%
                                      {if="count($v7list = $crate->getListDownloadCategory($value->iddownload_category, \'cs\')->getAll()) > 0"}
                                      <ul>
                                        {loop="$v7list"}{$level = 7}{*==========8 nad uroven*}
                                        <li id="item_{$value->iddownload_category}">
                                          <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em><a href="#" onclick="return false" class="btn btn-small btn-warning btn-warning19">Tato kategorie nebude vykreslena!</a>%%links%%
                                          {if="count($v8list = $crate->getListDownloadCategory($value->iddownload_category, \'cs\')->getAll()) > 0"}
                                          <ul>
                                            {loop="$v8list"}{$level = 8}{*==========9 nad uroven*}
                                            <li id="item_{$value->iddownload_category}">
                                              <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em><a href="#" onclick="return false" class="btn btn-small btn-warning btn-warning19">Tato kategorie nebude vykreslena!</a>%%links%%
                                              {if="count($v9list = $crate->getListDownloadCategory($value->iddownload_category, \'cs\')->getAll()) > 0"}
                                              <ul>
                                                {loop="$v9list"}{$level = 9}{*==========10 nad uroven*}
                                                <li id="item_{$value->iddownload_category}">
                                                  <em>{$value->name} [{$crate->getCountDownloadInCategory($value->iddownload_category, null)}]</em><a href="#" onclick="return false" class="btn btn-small btn-warning btn-warning19">Tato kategorie nebude vykreslena!</a>%%links%%
                                                </li>
                                                {/loop}
                                              </ul>
                                              {/if}
                                            </li>
                                            {/loop}
                                          </ul>
                                          {/if}
                                        </li>
                                        {/loop}
                                      </ul>
                                      {/if}
                                    </li>
                                    {/loop}
                                  </ul>
                                  {/if}
                                </li>
                                {/loop}
                              </ul>
                              {/if}
                            </li>
                            {/loop}
                          </ul>
                          {/if}
                        </li>
                        {/loop}
                      </ul>
                      {/if}
                    </li>
                    {/loop}
                  </ul>
                  {/if}
                </li>
                {/loop}
              </ul>
              {/if}
            </li>
            {/loop}
          </ul>
        </div>
      </div>
      {/if}
    </div>
  </div>',
      ))
    ->setAdd(array(
        'title' => 'Přidat kategorii',
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'success' => '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message success">%%success_title%%</div>
    </div>',
        'failure' => '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message warning">%%failure_title%%</div><div class="mws-button-row"><a href="javascript:history.back()" class="btn btn-warning btn-warning16">Zpět na formulář</a></div>
    </div>',
        'content' => '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
  <div class="grid_8 mws-panel mws-panel-v2">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
{%%form_msg%%}
%%if_iserrors%%
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message error">
        Nastaly tyto chyby:
        <ul>
            %%loop_geterrors%%
          <li>{$value}</li>
            %%loop_end%%
        </ul>
      </div>
    </div>
%%if_end%%
  </div>
{%%form%%}
',
        'code_post_form' => '
          %%form_var%%->setItems(\'parent\', $crate->getArrayListDownloadsCategory(), \'Kořen\');
          if (isset(%%action_id%%)) {
            %%data%%[\'parent\'] = urldecode(%%action_id%%);
            %%form_var%%->setDefaults(%%data%%);
          }
        ',
        'content_values' => '->remove(\'name\')
                            ->remove(\'description\')
                            ->put(\'parent\', %%values%%[\'parent\'] ?: null)
                            ->put(\'rewrite\', classes\Core::getRewrite(%%values%%[\'name\'][1]))',
        'code_post_insert' => '
          if (%%row_id%% < 0) {
            $db->rollBack();
            break(1);
          }

          foreach (%%values%%[\'name\'] as $i => $v) {
            $cv = classes\ContentValues::init()
                    ->put(\'idlanguage\', $i)
                    ->put(\'iddownload_category\', %%row_id%%)
                    ->put(\'name\', $v);
                    //~ ->put(\'description\', %%values%%[\'description\'][$i]);
            if ($db->insert(\'languages_has_downloads_category\', $cv) < 0) {  // osetreni duplikatniho vkladani
              %%row_id%% = -1;
              $db->rollBack();
              break(2);
            }
          }
        ',
      ))
    ->setAdd(array( // pridava jen link (pridat sub polozku)
        'title' => 'Přidat sub-kategorii',
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'color' => 'btn-small btn-success btn-success45',
        'global_link' => false,
        'url' => 'add/%%id_row%%',
        'if_link' => '&& $level < 4',
      ))
    ->setEdit(array(
        'title' => 'Upravit kategorii',
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'color' => 'btn-primary btn-primary18',
        'success' => '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message info">%%success_title%%</div>
    </div>',
        'success_empty' => '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message info">%%success_empty_title%%</div>
    </div>',
        'failure' => '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message warning">%%failure_title%%</div><div class="mws-button-row"><a href="javascript:history.back()" class="btn btn-warning btn-warning16">Zpět na formulář</a></div>
    </div>',
        'content' => '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
  <div class="grid_8 mws-panel mws-panel-v2">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
{%%form_msg%%}
%%if_iserrors%%
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message error">
        Nastaly tyto chyby:
        <ul>
            %%loop_geterrors%%
          <li>{$value}</li>
            %%loop_end%%
        </ul>
      </div>
    </div>
%%if_end%%
  </div>
{%%form%%}
',
        'query_separator' => array('idlanguage' => array('name', 'description')),
        'query' => '$db->rawQuery(\'SELECT iddownload_category, parent, idlanguage, languages_has_downloads_category.name, languages_has_downloads_category.description FROM %%table%%
                                    JOIN languages_has_downloads_category USING(iddownload_category)
                                    JOIN languages USING(idlanguage)
                                    WHERE iddownload_category=?\', array(%%row_id%%))',
        'code_post_form' => '
          %%form_var%%->setItems(\'parent\', $crate->getArrayListDownloadsCategory(%%row_id%%), \'Kořen\'); // provadi ignoraci na presouvani sama do sebe!
        ',
        'content_values' => '->remove(\'name\')
                            ->remove(\'description\')
                            ->put(\'parent\', %%values%%[\'parent\'] ?: null)
                            ->put(\'rewrite\', classes\Core::getRewrite(%%values%%[\'name\'][1]))',
        'code_post_update' => '
          if (%%rows%% < 0) {
            $db->rollBack();
            break(1);
          }

          foreach (%%values%%[\'name\'] as $i => $v) {
            $cv = classes\ContentValues::init()
                    ->put(\'name\', $v);
                    //~ ->put(\'description\', %%values%%[\'description\'][$i]);
            $ret = $db->update(\'languages_has_downloads_category\', $cv, \'idlanguage=? AND iddownload_category=?\', array($i, %%row_id%%));
            if ($ret < 0) {
              %%rows%% = -1;
              $db->rollBack();
              break(2);
            }
            %%rows%% += $ret;
          }
        ',
      ))
    ->setDel(array(
        'title' => 'Smazat kategorii',
        'enabled' => $user->isAllowed($acl_resource, 'del'),
        'if_link' => '&& $crate->getCountDownloadInCategory($value->iddownload_category, null) == 0',
        'color' => 'btn-danger btn-danger28',
        'failure_title' => 'Nelze smazat kategorii protože obsahuje položky!',
      ));
{/code}

{compile="$sekce->render()"}
