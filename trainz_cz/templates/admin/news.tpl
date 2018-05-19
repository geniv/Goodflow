{code}//<?

$code = '
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-form mws-form-v2">
        <span class="mws-form-title-v2">Vyber ikonu</span>';
foreach ($db->query('news_icons') as $i => $v) {
  $code .= '
        <div class="mws-form-row-v2">
          <label class="mws-form-label-v2" for="'.$v->name.'">
            {img:obrazek;'.$weburl.'img/icons/'.$v->path.'}
          </label>
          <div class="mws-form-item-v2">
            {radio:idnews_icon;'.$v->idnews_icon.'|$|'.($i == 0 ? 'checked' : '') .'|,|class|:|ibutton|,|id|:|'.$v->name.'|,|data-label-on|:|ANO|,|data-label-off|:|NE&nbsp;}
          </div>
        </div>';
}
$code .= '
      </div>
    </div>
  </div>
  <div class="mws-tabs grid_8">
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
          <label class="mws-form-label" for="nadpis_'.$v->code.'_lb">Nadpis '.$translate['lang_code'][$v->code].'</label>
          <div class="mws-form-item">
            <div class="medium">
              {text:name['.$v->idlanguage.']|$|maxlength|:|100|,|placeholder|:|Nadpis '.$translate['lang_code'][$v->code].'|,|class|:|large|,|id|:|nadpis_'.$v->code.'_lb|@|filled|:|Nadpis '.$translate['lang_code'][$v->code].' musí být vyplněn!}
            </div>
            <span class="error">Povinné pole!</span>
          </div>
        </div>
        <div class="mws-form-row">
          <label class="mws-form-label" for="text_'.$v->code.'_lb">Text novinky '.$translate['lang_code'][$v->code].'</label>
          <div class="mws-form-item tiny-novinky">
            <div class="large">
              {textarea:description['.$v->idlanguage.']|$|placeholder|:|Text novinky '.$translate['lang_code'][$v->code].'|,|class|:|large|,|id|:|text_'.$v->code.'_lb|@|filled|:|Text novinky '.$translate['lang_code'][$v->code].' musí být vyplněn!}
            </div>
            <span class="error">Povinné pole!</span>
          </div>
        </div>
      </div>';
}

$code .= '
    </div>
    <div class="mws-panel">
      <div class="mws-panel-body no-padding">
        <div class="mws-button-row">
          %%submit%%
        </div>
      </div>
    </div>
  </div>
';

$sekce = classes\Section::build($weburl_admin.'news/', '$admin_uri.subblock', '$admin_uri.subaction');
$sekce
    ->setTable('news', 'idnews')
    ->setFormCode($code, array('class' => 'mws-form clearfix', 'autocomplete' => 'off'), array('admin_uri', 'crate', 'translate'))
    ->setList(array(
        'query' => '$db->rawQuery(\'SELECT idnews, users.login, users.alias, roles.name role, news_icons.name icon_name, news_icons.path icon_path,
                                      languages_has_news.name name, languages_has_news.description description, %%table%%.added, %%table%%.edited FROM %%table%%
                                    JOIN languages_has_news USING(idnews)
                                    JOIN languages USING(idlanguage)
                                    JOIN news_icons USING(idnews_icon)
                                    JOIN users USING(iduser)
                                    JOIN roles USING(idrole)
                                    WHERE languages.code=?
                                    ORDER BY %%table%%.added DESC\', array(\'cs\'))',
        'name' => '{$value->name}',
        'enabled' => $user->isAllowed($acl_resource, 'list'),
        'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_s h_80">
            <img src="{$weburl}img/icons/{$value->icon_path}" />
          </div>
          <div class="obal_pravy_sloupec_s">
            <div class="sloupec obsahovy_sloupec">
              {$value->description}
            </div>
            <div class="sloupec">
              <hr />
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Autor</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->role}]</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Vytvořeno</td>
                  <td class="val">{$core::getCzechDateTime($value->added)}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Upraveno</td>
                  <td class="val">{if="$value->edited"}{$core::getCzechDateTime($value->edited)}{else}---{/if}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>',
      ))
    ->setAdd(array(
        'title' => 'Přidat novinku',
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'form_raw' => true,
        'submit_security' => true,
        'success' => '
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message success">%%success_title%%</div>
    </div>
  </div>',
        'content' => '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
%%if_iserrors%%
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
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
  </div>
%%if_end%%
{%%form_msg%%}
{%%form%%}
',
        'content_values' => '->remove(\'name\')
                            ->remove(\'description\')
                            ->put(\'iduser\', $user->getId())
                            ->putDate(\'added\')',
        'code_post_insert' => '
          foreach (%%values%%[\'name\'] as $i => $v) {
            $cv = classes\ContentValues::init()
                    ->put(\'idlanguage\', $i)
                    ->put(\'idnews\', %%row_id%%)
                    ->put(\'name\', $v)
                    ->put(\'description\', %%values%%[\'description\'][$i]);
            $db->insert(\'languages_has_news\', $cv);
          }
        ',
      ))
    ->setEdit(array(
        'title' => 'Upravit novinku',
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'form_raw' => true,
        'success' => '
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message info">%%success_title%%</div>
    </div>
  </div>',
        'success_empty' => '
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message info">%%success_empty_title%%</div>
    </div>
  </div>',
        'query_separator' => array('idlanguage' => array('name', 'description')),
        'query' => '$db->rawQuery(\'SELECT iduser, idnews_icon, idlanguage, idnews,
                                      languages_has_news.name, languages_has_news.description FROM %%table%%
                                    JOIN languages_has_news USING(idnews)
                                    JOIN languages USING(idlanguage)
                                    JOIN news_icons USING(idnews_icon)
                                    JOIN users USING(iduser)
                                    WHERE %%table_id%%=?\', array(%%row_id%%))',
        'content_values' => '->remove(\'name\')
                            ->remove(\'description\')
                            ->putDate(\'edited\')',
        'code_post_update' => '
          foreach (%%values%%[\'name\'] as $i => $v) {
            $cv = classes\ContentValues::init()
                    ->put(\'name\', $v)
                    ->put(\'description\', %%values%%[\'description\'][$i]);
            %%rows%% += $db->update(\'languages_has_news\', $cv, \'idlanguage=? AND idnews=?\', array($i, %%row_id%%));
          }
        ',
        'content' => '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
%%if_iserrors%%
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
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
  </div>
%%if_end%%
{%%form_msg%%}
{%%form%%}
',
      ))
    ->setDel(array(
      'title' => 'Smazat novinku',
      'enabled' => $user->isAllowed($acl_resource, 'del'),
      ));
{/code}

{compile="$sekce->render()"}
