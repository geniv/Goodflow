{code}//<?
$sekce = classes\Section::build($weburl_admin.'users/deactivated/', '$admin_uri.subaction', '$admin_uri.id');
$sekce
    ->setTable('users', 'iduser')
    ->setList(array(
        'query' => '$db->rawQuery(\'SELECT iduser, login, alias, email, roles.name, avatar, confirmed, confirmed_email, added, edited, deleted FROM %%table%%
                                    JOIN roles USING(idrole)
                                    WHERE deleted IS NOT NULL
                                    ORDER BY iduser ASC\')',
        'name' => '{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->name}]',
        'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_m h_158">
            <img src="{$weburl}img/avatars/{$value->avatar}" alt="" onerror="this.src=\'{$weburl}img/avatars/no-profile-img.png\'" />
          </div>
          <div class="obal_pravy_sloupec_m">
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Email</td>
                  <td class="val">{$value->email}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m ibtn_blok">
              <table>
                <tr>
                  <td class="key">Schválený uživatel</td>
                  <td class="val"><input type="checkbox" disabled{$value->confirmed ? \' checked\' : null} class="ibutton" data-label-on="ANO" data-label-off="NE&nbsp;" /></td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m ibtn_blok">
              <table>
                <tr>
                  <td class="key">Schválený email</td>
                  <td class="val"><input type="checkbox" disabled{$value->confirmed_email ? \' checked\' : null} class="ibutton" data-label-on="ANO" data-label-off="NE&nbsp;" /></td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Vytvořen</td>
                  <td class="val">{$core::getCzechDateTime($value->added)}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Upraven</td>
                  <td class="val">{if="$value->edited"}{$core::getCzechDateTime($value->edited)}{else}---{/if}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Deaktivován</td>
                  <td class="val">{$core::getCzechDateTime($value->deleted)}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>',
        'content' => '
  <div class="mws-tree-navigace-noaddbtn"></div>
      %%loop_begin%%
  <div class="grid_4 mws-panel">
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
        <span>Žádný uživatel</span>
      </div>
    </div>
      %%loop_end%%',
      ))
    ->setDel(array(
      'enabled' => $user->isAllowed($acl_resource, 'del'),
      'title' => 'Smazat uživatele',
      'code_pre_delete' => '
        // prepsany trigger
        $old = $db->query(\'users\', \'login, alias\', \'iduser=?\', array(%%row_id%%))->getFirst();
        $tvar = $old->login . ($old->alias ? \' (\'.$old->alias.\')\' : null);
        $db->update(\'slideshows\', classes\ContentValues::init()->put(\'author\', $tvar), \'iduser=?\', array(%%row_id%%));
        $db->update(\'downloads\', classes\ContentValues::init()->put(\'author\', $tvar), \'iduser=?\', array(%%row_id%%));
      ',
      ))
    ->setUpdate(array(
      'enabled' => $user->isAllowed($acl_resource, 'restore'),
      'url' => 'restore',
      'title' => 'Obnovit uživatele',
      'question' => 'Opravdu chcete obnovit: &quot;%%name%%&quot; ?',
      'color' => 'btn-primary btn-primary18',
      'content_values' => '->putNull(\'deleted\')',
      ));
{/code}

{compile="$sekce->render()"}