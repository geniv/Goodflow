<div class="obal_upload_notification">
  <div class="well well-sm div-validate">
{code}//<?
$sekce = classes\Section::build($weburl.'upload/notification/', '$crate->upload_uri.action', '$crate->upload_uri.id');
$sekce
    ->setTable('notifications', 'idnotification')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setList(array(
        'query' => '$db->rawQuery(\'SELECT idnotification, from_id, to_id, state, state_id, state_old_id, state_msg,
                                      _handled.login handled_login, _handled.alias handled_alias,
                                    subject, message, %%table%%.added, %%table%%.deleted FROM %%table%%
                                    LEFT JOIN users _handled ON _handled.iduser = handled_id
                                    WHERE (type=? OR type=?) AND (from_id=? OR to_id=?)
                                    ORDER BY %%table%%.added DESC\', array($crate::TYPE_SLIDESHOW, $crate::TYPE_DOWNLOAD, $upload_user->getId(), $upload_user->getId()))',
        'name' => '',
        'content' => '
    <ul class="list-group">
      <li class="list-group-item">
        <h4>Stav požadavků</h4>
      </li>
    </ul>
%%loop_begin%%
%%description%%
%%loop_empty%%
    <div class="alert alert-info">Žádný požadavek</div>
%%loop_end%%
',
        'description' => '
    <div class="alert alert-{$value->state === "0" ? \'danger\' : null}{$value->state === "1" ? \'success\' : null}{$value->state === null ? \'info\' : null}">
      {$value->message}
      <ul>
        <li>UID: <strong>#{$value->state_id}</strong></li>
        {if="$value->state_old_id"}<li>Původní UID: <strong>#{$value->state_old_id}</strong></li>{/if}
        <li>Požadavek vytvořen: <strong>{$core::getCzechDateTime($value->added)}</strong></li>
        {if="$value->handled_login"}<li>Vyřídil: <strong>{$value->handled_login}{if="$value->handled_alias"} ({$value->handled_alias}){/if}</strong>, kdy: <strong>{$core::getCzechDateTime($value->deleted)}</strong></li>{/if}
        <li>Stav: <strong>{$value->state === "0" ? \'Zamítnuto\' : null}{$value->state === "1" ? \'Schváleno\' : null}{$value->state === null ? \'Čeká na schválení\' : null}</strong></li>
        {if="$value->state === \'0\'"}<li>Důvod: {$value->state_msg ?: \'<strong>-- bez důvodu --</strong>\'}</li>{/if}
      </ul>
    </div>',
      ));
{/code}
{compile="$sekce->render()"}
  </div>
</div>