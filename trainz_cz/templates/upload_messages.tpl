<div class="obal_upload_message">
  <div class="well well-sm">
{code}//<?
  $code = '
    <ul class="list-group">
      <li class="list-group-item">
        <div class="form-group">
          <label class="col-lg-2 control-label">Příjemce</label>
          <div class="col-lg-10">
            {select:to|$|class|:|upload-select2|@|~equal|:|Musí být vybrán příjemce!|:|"0"}
            <span class="help-block">Povinné pole.</span>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPredmet" class="col-lg-2 control-label">Předmět</label>
          <div class="col-lg-10">
            {text:subject|$|maxlength|:|100|,|placeholder|:|Předmět|,|class|:|form-control|,|id|:|inputPredmet|@|filled|:|Předmět musí být vyplněn!}
            <span class="help-block">Povinné pole.</span>
          </div>
        </div>
        <div class="form-group posledni-form-group">
          <label class="col-lg-2 control-label">Zpráva</label>
          <div class="col-lg-10">
            {textarea:message|$|placeholder|:|Zpráva|,|class|:|tiny-upload|,|cols|:|100|,|rows|:|12|@|filled|:|Zpráva musí být vyplněna!}
            <span class="help-block">Povinné pole.</span>
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        %%submit%%
      </li>
    </ul>';

$sekce = classes\Section::build($weburl.'upload/messages/', '$crate->upload_uri.action', '$crate->upload_uri.id');
$sekce
    ->setTable('notifications', 'idnotification')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'form-horizontal', 'autocomplete' => 'off'));

  // rozklikavaci sekce
  if (isset($crate->upload_uri['action']) && $crate->upload_uri['action'] == 'show' && isset($crate->upload_uri['id']) && is_numeric($crate->upload_uri['id'])) {  // rozkliknute
    $sekce
        ->setList(array(
            'url' => 'show',
            'query' => '$db->rawQuery(\'SELECT idnotification, from_id, to_id, subject, message, m0.added, m0.deleted,
                                          _from.login from_login, _from.alias from_alias, _r.name from_role,
                                          _handled.login handled_login, _handled.alias handled_alias
                                        FROM %%table%% m0
                                        JOIN users _from ON _from.iduser=from_id
                                        JOIN roles _r ON _r.idrole=_from.idrole
                                        LEFT JOIN users _to ON _to.iduser=to_id
                                        LEFT JOIN users _handled ON _handled.iduser=handled_id
                                        WHERE
                                          type=? AND
                                          (from_id=? OR to_id=?) AND
                                          %%table_id%%=?\', array($crate::TYPE_MESSAGE, $upload_user->getId(), $upload_user->getId(), %%action_id%%))',
            'name' => '{$value->subject}',
            'description' => '<div class="list-group">{$value->message}</div>',
            'content' => '
    <ul class="list-group">
      <li class="list-group-item clearfix upr_pr_fr">
        <h4 class="pull-left">Zpráva</h4>
        <a href="{$weburl}upload/messages/" class="btn btn-primary btn-xs pull-right" title="Zpět">Zpět</a>
      </li>
    </ul>
%%loop_begin%%
    <ul class="list-group">
      <li class="panel-heading clearfix upr_pr_fr">%%name%%<span class="btn-xs pull-right">Adresát: {$value->from_login}{if="$value->from_login"} ({$value->from_alias}){/if}{$value->from_role ? \'&nbsp;&nbsp;[\' . $value->from_role . \']\' : null}</span></li>
      <li class="list-group-item clearfix">
%%description%%
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
%%links%%
      </li>
    </ul>
%%loop_empty%%
    <div class="alert alert-info">Žádná zpráva</div>
%%loop_end%%
',
          ))
        ->setLink(array(
            'url' => 'reply',
            'title' => 'Odpovědět',
            'link' => '<a href="%%url%%" class="btn btn-primary">%%title%%</a> &nbsp; ',
            'if_link' => ' && $value->from_id != $upload_user->getId()',
          ))
        ->setLink(array(
            'url' => 'archive',
            'title' => 'Smazat',
            'if_link' => ' && !$value->deleted',
            'link' => '<a href="%%url%%" class="btn btn-danger" onclick="return confirm(\'Opravdu chcete zprávu smazat?\')">%%title%%</a>',
          ));
  } else {
    $sekce
        ->setList(array(
            'query' => '$db->rawQuery(\'SELECT idnotification, from_id, to_id,
                                          _from.login from_login, _from.alias from_alias, _from_role.name from_role,
                                          _to.login to_login, _to.alias to_alias, _to_role.name to_role,
                                          subject, message, m0.added, m0.deleted
                                        FROM %%table%% m0
                                        LEFT JOIN users _from ON _from.iduser=from_id
                                        LEFT JOIN roles _from_role ON _from_role.idrole=_from.idrole
                                        LEFT JOIN users _to ON _to.iduser=to_id
                                        LEFT JOIN roles _to_role ON _to_role.idrole=_to.idrole
                                        WHERE type=? AND (from_id=? OR to_id=?) AND m0.deleted IS NULL
                                        ORDER BY m0.added DESC\', array($crate::TYPE_MESSAGE, $upload_user->getId(), $upload_user->getId()))',
            'name' => '{$value->subject}',
            'description' => '
    <table>
      <tr>
        <td>Od:</td>
        <td>{$value->from_login}{if="$value->from_alias"} ({$value->from_alias}){/if}{$value->from_role ? \'&nbsp;&nbsp;[\' . $value->from_role . \']\' : null}</td>
      </tr>
      <tr>
        <td>Komu:</td>
        <td>{$value->to_login}{if="$value->to_alias"} ({$value->to_alias}){/if}{$value->to_role ? \'&nbsp;&nbsp;[\' . $value->to_role . \']\' : null}</td>
      </tr>
      <tr>
        <td>Kdy:</td>
        <td>{$core::getCzechDateTime($value->added)}</td>
      </tr>
    </table>
    <a href="{$weburl}upload/messages/show/{$value->idnotification}" class="btn btn-primary">Zobrazit zprávu</a>',
            'content' => '
    <ul class="list-group">
      <li class="list-group-item">
        <h4>Zprávy</h4>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        %%add_link%%
      </li>
    </ul>
%%loop_begin%%
    <ul class="list-group">
      <li class="panel-heading clearfix">%%name%%<span class="btn-xs pull-right">{$value->to_id == $upload_user->getId() ? \'Příchozí\' : \'Odchozí\'}</span></li>
      <li class="list-group-item clearfix">
%%description%%
      </li>
    </ul>
%%loop_empty%%
    <div class="alert alert-info">Žádná zpráva</div>
%%loop_end%%
',
          ))
        ->setAdd(array( // odkaz prasani zpravy
            'url' => 'send',
            'title' => 'Napsat zprávu',
          ))
        ->setSection(array(
            'title' => 'Napsat zprávu',
            'submit_button' => '{submit:;Odeslat|$|class|:|btn btn-primary}',
            'url' => 'send',
            'form_raw' => true,
            'form' => $code,
            'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">Napsat zprávu</h4>
    <a href="%%back_link%%" class="btn btn-primary btn-xs pull-right" title="Zpět">Zpět</a>
  </li>
</ul>
%%if_iserrors%%
<div class="alert alert-danger">
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
',
            'code_post_form' => '
              %%form_var%%->setItems(\'to\', $crate->getArrayListUploadMessages(), \'-- Není vybrán příjemce --\');
            ',
            'code_success' => '
              if ($crate->addNotification($upload_user->getId(), $global_configure[\'notification\'][%%values%%[\'to\']], $crate::TYPE_MESSAGE, null, null, %%values%%[\'subject\'], %%values%%[\'message\'])) {
                %%form_msg%% = \'<div class="alert alert-success">Zpráva byla odeslána!</div>\';
                classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%\');
              }
            ',
          ))
        ->setSection(array( // odpovidani
            'url' => 'reply',
            'title' => 'Odpovědět',
            'form_raw' => true,
            'form' => '
    <ul class="list-group">
      <li class="list-group-item">
        <div class="form-group">
          <label for="inputPredmet" class="col-lg-2 control-label">Adresát</label>
          <div class="col-lg-10">
            {text:adresat|$|disabled|,|class|:|form-control}
          </div>
        </div>
        <div class="form-group">
          <label for="inputPredmet" class="col-lg-2 control-label">Předmět</label>
          <div class="col-lg-10">
            {text:subject|$|maxlength|:|100|,|placeholder|:|Předmět|,|class|:|form-control|,|id|:|inputPredmet|@|filled|:|Předmět musí být vyplněn!}
            <span class="help-block">Povinné pole.</span>
          </div>
        </div>
        <div class="form-group posledni-form-group">
          <label class="col-lg-2 control-label">Zpráva</label>
          <div class="col-lg-10">
            {textarea:message|$|placeholder|:|Zpráva|,|class|:|tiny-upload|,|cols|:|100|,|rows|:|12|@|filled|:|Zpráva musí být vyplněna!}
            <span class="help-block">Povinné pole.</span>
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        %%submit%%
      </li>
    </ul>',
            'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">Odpovědět na zprávu</h4>
    <a href="%%back_link%%show/{%%action_id%%}" class="btn btn-primary btn-xs pull-right" title="Zpět">Zpět</a>
  </li>
</ul>
%%if_iserrors%%
<div class="alert alert-danger">
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
',
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
              $_id = $crate->addNotification($upload_user->getId(), $c->from_id, $crate::TYPE_MESSAGE, null, null, %%values%%[\'subject\'], %%values%%[\'message\']);

              // archivace
              $cv = classes\ContentValues::init()
                  ->put(\'handled_id\', $upload_user->getId())
                  ->putDate(\'deleted\')
                  ->put(\'state\', true);
              $db->update(\'%%table%%\', $cv, \'%%table_id%%=?\', array(%%action_id%%));

              if ($_id > 0) {
                %%form_msg%% = \'<div class="alert alert-success">Zpráva byla odeslána!</div>\';
                classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%\');
              }
            ',
          ))
        ->setUpdate(array(
            'url' => 'archive',
            'title' => '',
            'success' => '<div class="alert alert-info">Zpráva byla smazána!</div>',
            'content' => '{%%form_msg%%}',
            'if_link' => ' && 0',
            'content_values' => '->put(\'handled_id\', $upload_user->getId())
                                ->putDate(\'deleted\')
                                ->put(\'state\', true)',
          ));;
  }

{/code}
{compile="$sekce->render()"}
  </div>
</div>