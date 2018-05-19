{code}//<?
//@deprecated!!!

// zdrojovy kod formulare
$code = '
{select:to_id|$|class|:|mws-select2 large|,|id|:|opravneni_lb}

{text:subject|$|maxlength|:|100|,|placeholder|:|Předmět}

{textarea:message|$|placeholder|:|Zpráva}

<div class="mws-button-row">
  %%submit%%
</div>';

//TODO tlacitka: nova
//~ var_dump($admin_uri, $admin_uri['subblock'] == 'show');

$sekce = classes\Section::build($weburl_admin.'notifications/', '$admin_uri.subblock', '$admin_uri.subaction');
$sekce
    ->setTable('notifications', 'idnotification')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'), array('admin_uri'));

switch ($admin_uri['subblock']) {
  default:
    $sekce
        ->setList(array(
            'enabled' => $user->isAllowed($acl_resource, 'list'),
            'query' => '$db->rawQuery(\'SELECT idnotification,
                                          _from.login from_login,
                                          _to.login to_login,
                                          _handled.login handled_login,
                                          type, subject, message, %%table%%.added
                                        FROM %%table%%
                                        JOIN users _from ON _from.iduser = from_id
                                        LEFT JOIN users _to ON _to.iduser = to_id
                                        LEFT JOIN users _handled ON _handled.iduser = handled_id
                                        WHERE %%table%%.deleted IS NULL AND type!=?
                                        ORDER BY %%table%%.added DESC\', array(\'message\'))',
            'name' => '{$crate->getMsgTypeNotification($value->type)}',
            'description' => '
              from: {$value->from_login}<br />
              to: {$value->to_login}<br />
              vyrizeno kym: {$value->handled_login}<br />
              type: ({$value->type})<br />
              subject: {$value->subject}<br />
              message: {$value->message}<br />
              added {$core::getCzechDateTime($value->added)}<br />
            ',
          ))
        ->setLink(array(
            'url' => 'show',
            'title' => 'zobrazit notifikaci',
          ));
  break;

  case 'show':
    $sekce
        ->setList(array(
            'url' => 'show',
            'query' => '$db->rawQuery(\'SELECT %%table_id%%, type, subject, message, added FROM %%table%%
                                        WHERE %%table_id%%=?\', array(%%action_id%%))',
            'name' => '{$value->subject}',
            'description' => '
                --toto je rozkliknuta zprava--
              message: {$value->message}<br />
              added {$core::getCzechDateTime($value->added)}<br />
            ',
          ))
        ->setUpdate(array(
            'title' => 'Potvrdit',
            'question' => 'Opravtu potvrdit?',
          ))
        //~ ->setUpdate(array(  //TODO u potvrzeni registrace se archivuje sama po potvrzeni???
            //~ 'url' => 'archive',
            //~ 'title' => 'Archivovat zprávu',
            //~ 'question' => 'Opravdu de má zpráva archivovat?',
            //~ 'if_link' => ' && $value->type != \'message\'',
            //~ 'enabled' => $user->isAllowed($acl_resource, 'archive'),
            //~ 'content_values' => '->putDate(\'deleted\')->put(\'handled_id\', $user->getId())',
          //~ ))
          ;
  break;
}

//<a href="javascript:confirmUser('.$id_user.')">SCHVALIT</a> <a href="{$weburl_admin}users/del/'.$id_user.'">ZAMITNOUT</a>

{/code}

{compile="$sekce->render()"}