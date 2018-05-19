{code}//<?
// zdrojovy kod formulare
$code = '
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label">Důvod</label>
    <div class="mws-form-item">
      <div class="large tiny-novinky">
        {textarea:state_msg|$|placeholder|:|Důvod|,|class|:|large}
      </div>
      <span class="error">Nepovinné pole.</span>
    </div>
  </div>
</div>
<div class="mws-button-row">
  %%submit%%
</div>';

$sekce = classes\Section::build($weburl_admin.'users/new/', '$admin_uri.subaction', '$admin_uri.id');
$sekce
    ->setTable('notifications', 'idnotification')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'));

  // rozklikavaci sekce
  if (isset($admin_uri['subaction']) && isset($admin_uri['id']) && is_numeric($admin_uri['id'])) {  // rozkliknute
    $sekce
        ->setList(array(
            'url' => 'show',
            'enabled' => $user->isAllowed($acl_resource, 'show'),
            'query' => '$db->rawQuery(\'SELECT %%table_id%%, type, subject, message, %%table%%.added, agent,
                                        _id.login, _id.email, _id.alias, _id.reason
                                        FROM %%table%%
                                        JOIN users _id ON _id.iduser = state_id
                                        WHERE %%table%%.deleted IS NULL AND type=? AND %%table_id%%=?\', array($crate::TYPE_REGISTRATION, %%action_id%%))',
            'name' => '{$value->login}{if="$value->alias"} ({$value->alias}){/if} žádá o registraci',
            'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_obsah">
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Uživatel</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Email</td>
                  <td class="val">{$value->email}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Prohlížeč</td>
                  <td class="val">{function="classes\UserAgentString::getBrowser($value->agent)"}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Důvod registrace</td>
                  <td class="val">{$value->reason}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Datum registrace</td>
                  <td class="val">{$core::getCzechDateTime($value->added)}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>',
            'content' => '
  <div class="grid_8 addbtn">
    <a href="%%weburl%%" class="btn btn-primary btn-primary5">Zpět na výpis</a>
  </div>
      %%loop_begin%%
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%name%%</span>
    </div>
    <div class="mws-panel-body no-padding">
      %%description%%
      <div class="mws-button-row">
        %%links%%
      </div>
    </div>
  </div>
      %%loop_empty%%
    <div class="grid_8 mws-panel mws-tree-navigace-noaddbtn">
      <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
        <span>Žádný uživatel</span>
      </div>
    </div>
      %%loop_end%%',
          ))
        ->setUpdate(array(
            'url' => 'activate',
            'enabled' => $user->isAllowed($acl_resource, 'activate'),
            'title' => 'Schválit uživatele',
            'color' => 'btn-primary btn-primary18',
            'success' => '<div class="mws-form-message success">Uživatel byl schválen!</div>',
            'question' => 'Opravdu chcete tohoto uživatele schválit?',
            'content_values' => '->put(\'handled_id\', $user->getId())
                                ->putDate(\'deleted\')
                                ->put(\'state\', true)',
            'code_post_update' => '
              // vytazeni id z notifikaci
              $c = $db->rawQuery(\'SELECT state_id FROM %%table%%
                                  JOIN users ON iduser=state_id
                                  WHERE %%table_id%%=?\', array(%%row_id%%))->getFirst();
              if ($c) { // overeni existence
                %%rows%% += $db->update(\'users\', classes\ContentValues::init()->put(\'confirmed\', true), \'iduser=?\', array($c->state_id)); // potvrzeni

                classes\Emailer::factory(classes\Emailer::HTML)
                    ->addTo($db->query(\'users\', \'email\', \'iduser=?\', array($c->state_id))->getFirst()->email)  // nacteni emailu
                    ->setFrom(\'admin@trainz.cz\')
                    ->setSubject(\'Registrace do autorské sekce Trainz.cz\')
                    ->setMessageArgs(\'Dobrý den,<br /><br />Vaše žádost o registraci do autorské sekce Trainz.cz byla schválena.<br /><br />Nyní se do autorské sekce můžete přihlásit.<br /><br />--<br />Trainz.cz\')
                    ->send();
              }
            ',
          ))
        ->setEdit(array(
            'title' => 'Zamítnout uživatele',
            'color' => 'btn-danger btn-danger28',
            'submit_button' => '{submit:;%%title%%|$|class|:|btn btn-small btn-danger btn-danger28}',
            'success' => '<div class="mws-form-message info">Uživatel byl zamítnut!</div>',
            'url' => 'deactivate',
            'enabled' => $user->isAllowed($acl_resource, 'deactivate'),
            'form_raw' => true,
            'content' => '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%show/{%%action_id%%}" class="btn btn-primary btn-primary5" title="Zpět na podrobnosti uživatele">Zpět na podrobnosti uživatele</a>
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
  </div>
',
            'content_values' => '->put(\'handled_id\', $user->getId())
                                ->putDate(\'deleted\')
                                ->put(\'state\', false)',
            'code_post_update' => '
              // vytazeni id z notifikaci
              $c = $db->rawQuery(\'SELECT state_id FROM %%table%%
                                  JOIN users ON iduser=state_id
                                  WHERE %%table_id%%=?\', array(%%row_id%%))->getFirst();

              if ($c) { // overeni existence
                classes\Emailer::factory(classes\Emailer::HTML)
                    ->addTo($db->query(\'users\', \'email\', \'iduser=?\', array($c->state_id))->getFirst()->email)  // nacteni emailu
                    ->setFrom(\'admin@trainz.cz\')
                    ->setSubject(\'Registrace do autorské sekce Trainz.cz\')
                    ->setMessageArgs(\'Dobrý den,<br /><br />Vaše žádost o registraci do autorské sekce Trainz.cz byla zamítnuta.<br /><br />Důvod:<br />----------------------------<br />%s<br />----------------------------<br /><br />--<br />Trainz.cz\', %%values%%[\'state_msg\'] ?: \'-- Důvod nebyl uveden --\')
                    ->send();

                $db->delete(\'users\', \'iduser=?\', array($c->state_id)); // odmazani
              }
            ',
          ));
  } else {
    $sekce
        ->setList(array(
            'query' => '$db->rawQuery(\'SELECT idnotification, type, subject, message, %%table%%.added,
                                        _id.login id_login, _id.alias id_alias
                                        FROM %%table%%
                                        JOIN users _id ON _id.iduser = state_id
                                        WHERE %%table%%.deleted IS NULL AND type=?
                                        ORDER BY %%table%%.added DESC\', array($crate::TYPE_REGISTRATION))',
            'name' => '{$crate->getMsgTypeNotification($value->type)}',
            'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_obsah">
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Uživatel</td>
                  <td class="val">{$value->id_login}{if="$value->id_alias"} ({$value->id_alias}){/if}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Datum registrace</td>
                  <td class="val">{$core::getCzechDateTime($value->added)}</td>
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
        ->setLink(array(
            'url' => 'show',
            'enabled' => $user->isAllowed($acl_resource, 'show'),
            'title' => 'Zobrazit podrobnosti',
          ));
  }
{/code}

{compile="$sekce->render()"}