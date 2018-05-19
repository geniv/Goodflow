{code}//<?
// zdrojovy kod formulare
$code = '
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label">Příjemce</label>
    <div class="mws-form-item">
      <div class="large">
        {select:to_id[]|$|multiple|,|class|:|mws-select2 large|@|filled|:|Musí být vybrán příjemce!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label">Předmět</label>
    <div class="mws-form-item">
      <div class="large">
        {text:subject|$|maxlength|:|100|,|placeholder|:|Předmět|,|class|:|large|@|filled|:|Předmět musí být vyplněn!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label">Zpráva</label>
    <div class="mws-form-item">
      <div class="large tiny-novinky">
        {textarea:message|$|placeholder|:|Zpráva|,|class|:|large|@|filled|:|Zpráva musí být vyplněna!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
</div>
<div class="mws-button-row">
  %%submit%%
</div>';

$sekce = classes\Section::build($weburl_admin.'messages/', '$admin_uri.subblock', '$admin_uri.subaction');
$sekce
    ->setTable('notifications', 'idnotification')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'), array('admin_uri'));

  // rozklikavaci sekce
  if (isset($admin_uri['subblock']) && $admin_uri['subblock'] == 'show' && isset($admin_uri['subaction']) && is_numeric($admin_uri['subaction'])) {  // rozkliknute
    $sekce
        ->setList(array(
            'url' => 'show',
            'enabled' => $user->isAllowed($acl_resource, 'show'),
            'query' => '$db->rawQuery(\'SELECT idnotification, from_id, to_id,
                                          _from.login from_login, _from.alias from_alias, _r.name from_role,
                                          _to.login to_login,
                                          _handled.login handled_login,
                                          subject, message, n0.added
                                        FROM %%table%% n0
                                        JOIN users _from ON _from.iduser=from_id
                                        JOIN roles _r ON _r.idrole=_from.idrole
                                        LEFT JOIN users _to ON _to.iduser=to_id
                                        LEFT JOIN users _handled ON _handled.iduser=handled_id
                                        WHERE
                                          n0.deleted IS NULL AND
                                          type=? AND %%table_id%%=?\', array($crate::TYPE_MESSAGE, %%action_id%%))',
            'name' => '{$value->subject}',
            'description' => '
  <div class="mws-summary-5">
    {$value->message}
  </div>',
            'content' => '
  <div class="grid_8 addbtn">
    <a href="{$weburl_admin}messages/" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
      %%loop_begin%%
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%name%%</span>
      <span class="idpolozky">Adresát: {$value->from_login}{if="$value->from_login"} ({$value->from_alias}){/if}{if="$value->from_role"}&nbsp;&nbsp;[{$value->from_role}]{/if}</span>
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
        <span>Žádná zpráva</span>
      </div>
    </div>
      %%loop_end%%',
          ))
        ->setLink(array(
            'url' => 'reply',
            'title' => 'Odpovědět',
            'enabled' => $user->isAllowed($acl_resource, 'reply'),
            'if_link' => ' && $value->from_id != $user->getId()',
          ))
        ->setLink(array(
            'url' => 'archive',
            'title' => 'Smazat',
            'enabled' => $user->isAllowed($acl_resource, 'archive'),
            'if_link' => ' && !$value->deleted',
            'link' => '<a href="%%url%%" class="btn btn-small %%color%%" onclick="return confirm(\'Opravdu chcete zprávu smazat?\')">%%title%%</a>',
            'color' => 'btn-danger btn-danger28',
          ));
  } else {
    $sekce
        ->setList(array(
            'query' => '$db->rawQuery(\'SELECT idnotification, type, subject, message, n0.added, from_id, to_id, state_id, state_old_id,
                                          _from.login from_login, _from.alias from_alias, _rfrom.name from_role,
                                          _to.login to_login, _to.alias to_alias, _tfrom.name to_role
                                        FROM %%table%% n0
                                        JOIN users _from ON _from.iduser=n0.from_id
                                        JOIN roles _rfrom ON _rfrom.idrole=_from.idrole
                                        LEFT JOIN users _to ON _to.iduser=n0.to_id
                                        LEFT JOIN roles _tfrom ON _tfrom.idrole=_to.idrole
                                        WHERE n0.deleted IS NULL AND n0.type=? AND (from_id=? OR to_id=?)
                                        ORDER BY n0.added DESC\', array($crate::TYPE_MESSAGE, $user->getId(), $user->getId()))',
            'name' => '{$value->subject}',
            'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_obsah">
            <div class="sloupec">
              <table>
                <tr>
                  <td class="key">Od</td>
                  <td class="val">{$value->from_login}{if="$value->from_alias"} ({$value->from_alias}){/if}{$value->from_role ? \'&nbsp;&nbsp;[\' . $value->from_role . \']\' : null}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec">
              <table>
                <tr>
                  <td class="key">Komu</td>
                  <td class="val">{$value->to_login}{if="$value->to_alias"} ({$value->to_alias}){/if}{$value->to_role ? \'&nbsp;&nbsp;[\' . $value->to_role . \']\' : null}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec">
              <table>
                <tr>
                  <td class="key">Kdy</td>
                  <td class="val">{$core::getCzechDateTime($value->added)}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>',
            'content' => '
  <div class="grid_8 addbtn">
    %%add_link%%
  </div>
      %%loop_begin%%
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%name%%</span>
      <span class="idpolozky">{$value->to_id == $user->getId() ? \'Příchozí\' : \'Odchozí\'}</span>
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
        <span>Žádná zpráva</span>
      </div>
    </div>
      %%loop_end%%',
          ))
        ->setLink(array(  // rozkliknuti
            'url' => 'show',
            'enabled' => $user->isAllowed($acl_resource, 'show'),
            'title' => 'Zobrazit zprávu',
          ))
        ->setAdd(array( // odkaz prasani zpravy
            'url' => 'send',
            'title' => 'Napsat zprávu',
            'enabled' => $user->isAllowed($acl_resource, 'send'),
          ))
        ->setSection(array( // psani
            'url' => 'send',
            'enabled' => $user->isAllowed($acl_resource, 'send'),
            'title' => 'Odeslat',
            'form_raw' => true,
            'form' => $code,
            'code_post_form' => '
              %%form_var%%
                  ->setItems(\'to_id[]\', $crate->getArrayListUsers());
            ',
            'code_success' => '
              $_id = 0;
              foreach (%%values%%[\'to_id\'] as $v) {
                if ($user->getId() != $v) { // aby neslo poslat samo sobe
                  $_id += $crate->addNotification($user->getId(), $v, $crate::TYPE_MESSAGE, null, null, %%values%%[\'subject\'], %%values%%[\'message\']);
                }
              }

              if ($_id > 0) {
                %%form_msg%% = \'<div class="mws-form-message success">Zpráva byla odeslána!</div>\';
                classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%\');
              }
            ',
          ))
        ->setSection(array( // odpovidani
            'url' => 'reply',
            'title' => 'Odpovědět',
            'form_raw' => true,
            'enabled' => $user->isAllowed($acl_resource, 'reply'),
            'form' => '
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label">Adresát</label>
    <div class="mws-form-item">
      <div class="large">
        {text:adresat|$|disabled|,|class|:|form-control large}
      </div>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label">Předmět</label>
    <div class="mws-form-item">
      <div class="large">
        {text:subject|$|maxlength|:|100|,|placeholder|:|Předmět|,|class|:|large|@|filled|:|Předmět musí být vyplněn!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label">Zpráva</label>
    <div class="mws-form-item">
      <div class="large tiny-novinky">
        {textarea:message|$|placeholder|:|Zpráva|,|class|:|large|@|filled|:|Zpráva musí být vyplněna!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
</div>
<div class="mws-button-row">
  %%submit%%
</div>',
            'content' => '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%show/{%%action_id%%}" class="btn btn-primary btn-primary5" title="Zpět na zprávu">Zpět na zprávu</a>
  </div>
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
%%if_iserrors%%
  <div class="mws-form-message error">
    Nastaly tyto chyby:
    <ul>
        %%loop_geterrors%%
      <li>{$value}</li>
        %%loop_end%%
    </ul>
  </div>
%%if_end%%
{%%form_msg%%}
{%%form%%}
    </div>
  </div>',
            'code_post_form' => '
              $c = $db->rawQuery(\'SELECT subject, message, from_id, m.added,
                                    _from.login from_login, _from.alias from_alias, _from_role.name from_role
                                  FROM %%table%% m
                                  LEFT JOIN users _from ON _from.iduser=from_id
                                  LEFT JOIN roles _from_role ON _from_role.idrole=_from.idrole
                                  WHERE %%table_id%%=?\', array(%%action_id%%))->getFirst();
              if ($c) {
                $d = array(
                    \'subject\' => \'FWD: \'.$c->subject,
                    \'message\' => \'<br /><br /><br />----------------------------------------<br /><strong>Od:</strong> \'.$c->from_login . ($c->from_alias ? \' (\' . $c->from_alias .\')\' : null) . ($c->from_role ? \'&nbsp;&nbsp;[\' . $c->from_role . \']\' : null) . \'<br /><strong>Předmět:</strong> \'.$c->subject.\'<br /><strong>Kdy:</strong> \'.classes\Core::getCzechDateTime($c->added).\'<br />\'.$c->message,
                    \'adresat\' => $c->from_login . ($c->from_alias ? \' (\' . $c->from_alias .\')\' : null) . ($c->from_role ? \'&nbsp;&nbsp;[\' . $c->from_role . \']\' : null),
                  );
                %%form_var%%->setDefaults($d);
              }
            ',
            'code_success' => '
              // odeslani nove zpravy
              $_id = $crate->addNotification($user->getId(), $c->from_id, $crate::TYPE_MESSAGE, null, null, %%values%%[\'subject\'], %%values%%[\'message\']);

              // archivace
              $cv = classes\ContentValues::init()
                  ->put(\'handled_id\', $user->getId())
                  ->putDate(\'deleted\')
                  ->put(\'state\', true);
              $db->update(\'%%table%%\', $cv, \'%%table_id%%=?\', array(%%action_id%%));

              if ($_id > 0) {
                %%form_msg%% = \'<div class="mws-form-message success">Zpráva byla odeslána!</div>\';
                classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%\');
              }
            ',
          ))
        ->setUpdate(array(
            'url' => 'archive',
            'title' => 'Smazat zprávu',
            'success' => '<div class="mws-form-message info">Zpráva byla smazána!</div>',
            'if_link' => ' && 0',
            'enabled' => $user->isAllowed($acl_resource, 'archive'),
            'content_values' => '->put(\'handled_id\', $user->getId())
                                ->putDate(\'deleted\')
                                ->put(\'state\', true)',
          ));
  }
{/code}

{compile="$sekce->render()"}