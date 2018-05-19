{code}//<?
$code = '<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label" for="kategorie_lb">Kategorie</label>
    <div class="mws-form-item">
      <div class="small">
        {select:idlink_category|$|class|:|large|,|id|:|kategorie_lb}
      </div>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="nazev_lb">Název odkazu</label>
    <div class="mws-form-item">
      <div class="medium">
        {text:name|$|maxlength|:|100|,|placeholder|:|Název odkazu|,|class|:|large|,|id|:|nazev_lb|@|filled|:|Musí být vyplněn název odkazu!}
      </div>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="odkaz_lb">Odkaz</label>
    <div class="mws-form-item">
      <div class="medium">
        {text:url|$|maxlength|:|100|,|placeholder|:|Odkaz|,|class|:|large|,|id|:|odkaz_lb|@|filled|:|Musí být vyplněn odkaz!|,|url|:|Odkaz musí mít správný tvar!}
      </div>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="obrazek_lb">Obrázek k odkazu</label>
    <div class="mws-form-item">
      <div class="medium">
        {file:picture|$|id|:|obrazek_lb|@|image|:|Musí být vložen pouze obrázek!|,|maxfilesize|:|Obrázek nesmí překročit 1 MB!|:|1048576}
      </div>
      <span class="error">Nepovinné pole. Obrázek bude automaticky zmenšen na {$global_configure.link.pictureWidth}x{$global_configure.link.pictureHeight} pixelů!</span>
    </div>
  </div>
  {if="$admin_uri.subblock == \\\'edit\\\'"}<div class="mws-form-row">
    <label class="mws-form-label">Aktuální obrázek</label>
    <div class="mws-form-item">
      <div class="small">
        {img:picture;'.$weburl.'img/links/|$|onerror|:|this.src=\\\''.$weburl.'img/links/no-img.png\\\' }
      </div>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="smazat_obrazek_lb">Smazat obrázek</label>
    <div class="mws-form-item">
      <div class="small">
        {checkbox:picture_delete|$|class|:|ibutton|,|id|:|smazat_obrazek_lb|,|data-label-on|:|ANO|,|data-label-off|:|NE&nbsp;}
      </div>
    </div>
  </div>
  {/if}
</div>
<div class="mws-button-row">
  %%submit%%
</div>';

$sekce = classes\Section::build($weburl_admin.'links/', '$admin_uri.subblock', '$admin_uri.subaction');
$sekce
    ->setTable('links', 'idlink')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form'), array('admin_uri', 'global_configure'))
    ->setList(array(
        'name' => '{$value->name}',
        'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_m">
            <img alt="" src="{$weburl}img/links/{$value->picture}" onerror="this.src=\'{$weburl}img/links/no-img.png\' "/>
          </div>
          <div class="obal_pravy_sloupec_m">
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Odkaz</td>
                  <td class="val">{$value->url}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Vložil</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->role}]</td>
                </tr>
              </table>
            </div>
          </div>
        </div>',
        'content' => '
  <div class="grid_8 addbtn">
    %%add_link%%
  </div>
  {loop="$db->rawQuery(\'SELECT idlink_category, languages_has_links_category.name FROM links_category
                        JOIN languages_has_links_category USING(idlink_category)
                        JOIN languages USING(idlanguage)
                        WHERE languages.code=?
                        ORDER BY languages_has_links_category.name ASC\', array(\'cs\'))" as $v0}
  <div class="grid_4">
    <div class="mws-panel">
      <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
        <span>{$v0->name}</span>
      </div>
    </div>
    <div id="sortable_links_{$v0->idlink_category}">
      {loop="$db->rawQuery(\'SELECT %%table_id%%, %%table%%.name, url, picture, login, alias, roles.name role FROM %%table%%
                            JOIN users USING(iduser)
                            JOIN roles USING(idrole)
                            WHERE idlink_category=?
                            ORDER BY rank ASC\', array($v0->idlink_category))"}
      <div class="mws-panel" id="item_%%id_row%%">
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
    <div class="mws-panel">
      <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
        <span>Žádný odkaz</span>
      </div>
    </div>
      {/loop}
    </div>
  </div>
  {/loop}
      ',
      ))
    ->setAdd(array(
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'title' => 'Přidat odkaz',
        'code_post_form' => '
          %%form_var%%->setItems(\'idlink_category\', $crate->getArrayListLinksCategory());
        ',
        'content_values' => '->remove(\'picture_delete\')
                            ->put(\'iduser\', $user->getId())',
        'code_success' => '
            if (%%values%%[\'picture\'][\'name\']) {
              $dest = \'img/links/\' . classes\Core::makeFilesName(%%values%%[\'picture\']);
              classes\ImageMaker::cropResize(%%values%%[\'picture\'][\'tmp_name\'], $dest, $global_configure[\'link\'][\'pictureWidth\'], $global_configure[\'link\'][\'pictureHeight\']);
              %%values%%[\'picture\'] = basename($dest);
            } else {
              %%values%%[\'picture\'] = null;
            }',
      ))
    ->setEdit(array(
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'title' => 'Upravit odkaz',
        'code_post_form' => '
          %%form_var%%->setItems(\'idlink_category\', $crate->getArrayListLinksCategory());
        ',
        'content_values' => '->remove(\'picture_delete\')', // ->put(\'iduser\', $user->getId())
        'code_success' => '
            if (%%values%%[\'picture\'][\'name\']) {
              $dest = \'img/links/\' . classes\Core::makeFilesName(%%values%%[\'picture\']);
              classes\ImageMaker::cropResize(%%values%%[\'picture\'][\'tmp_name\'], $dest, $global_configure[\'link\'][\'pictureWidth\'], $global_configure[\'link\'][\'pictureHeight\']);
              %%values%%[\'picture\'] = basename($dest);
            } else {
              %%values%%[\'picture\'] = $_data->picture;
            }

            if (isset(%%values%%[\'picture_delete\'])) {  // pokud chce obrazek smazat
              %%values%%[\'picture\'] = null;
            }
            ',
      ))
    ->setDel(array(
        'enabled' => $user->isAllowed($acl_resource, 'del'),
        'title' => 'Smazat odkaz',
      ));
{/code}

{compile="$sekce->render()"}