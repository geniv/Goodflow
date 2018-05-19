{code}//<?
$sekce = classes\Section::build($weburl_admin.'users/lastlogin/', '$admin_uri.subaction', '$admin_uri.id');
$sekce
    ->setTable('lastlogins', 'idlastlogin')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    //~ ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'))
    ->setList(array(
        'query' => '$db->rawQuery(\'SELECT %%table_id%%, users.login, users.alias, roles.name role, ip, agent, screen, from_web, %%table%%.added FROM %%table%%
                                    JOIN users USING(iduser)
                                    JOIN roles USING(idrole)
                                    ORDER BY %%table%%.added DESC\')',
        'name' => '{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->role}]',
        'description' => '
<table class="mws-summary-4">
  <tr>
    <td>{$value->ip}</td>
    <td><a href="javascript:getHostName(\'.rethref{$value->idlastlogin}\', \'{$value->ip}\')" class="rethref{$value->idlastlogin}">hostname</a></td>
    <td>{$value->agent}</td>
  {if="($screen_data = json_decode($value->screen, true))"}
    <td>{$screen_data.width}x{$screen_data.height}x{$screen_data.colorDepth}</td>
  {else}
    <td>Nefunkční JS! (bez údajů)</td>
  {/if}
    <td>{$core::getCzechDateTime($value->added)}</td>
  </tr>
</table>',
        'content' => '
  <div class="mws-tree-navigace-noaddbtn"></div>
      %%loop_begin%%
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%name%%</span>
      <span class="idpolozky">{$value->from_web ? \'Přihlášení do upload sekce\': \'Přihlášení do administrace\'}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#{%%id_row%%}</span>
    </div>
    <div class="mws-panel-body">
      %%description%%
    </div>
  </div>
      %%loop_end%%',
      ));
{/code}
{compile="$sekce->render()"}