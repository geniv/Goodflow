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

$sekce = classes\Section::build($weburl_admin.'slideshows/new/', '$admin_uri.subaction', '$admin_uri.id');
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
            'query' => '$db->rawQuery(\'SELECT %%table_id%%, type, subject, message, %%table%%.added, state_id, state_old_id,
                                          _from.login, _from.alias,
                                          _id.path, _id.description, _id.added add_date, _id.edited new_date,
                                         _old.description old_description, _old.added old_date
                                        FROM %%table%%
                                        JOIN users _from ON _from.iduser=from_id
                                        JOIN slideshows _id ON _id.idslideshow=state_id
                                        LEFT JOIN slideshows _old ON _old.idslideshow=state_old_id
                                        WHERE %%table%%.deleted IS NULL AND type=? AND %%table_id%%=?\', array($crate::TYPE_SLIDESHOW, %%action_id%%))',
            'name' => '{$crate->getMsgTypeNotification($value->type . ($value->state_old_id ? \'_edit\': null))}',
            'description' => '
{if="$value->state_old_id"}
        <div class="mws-summary-2">
          <div class="levy_sloupec_obsah levy_sloupec_obsah_porovnani">
            <div class="sloupec sloupec_head info_blok_s">
              <table>
                <tr>
                  <td class="key"></td>
                  <td class="val"><span>Staré údaje</span></td>
                  <td class="val"><span>Aktualizované údaje</span></td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Popis</td>
                  <td class="val">{$value->old_description}</td>
                  <td class="val">{$value->description}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_s">
              <table>
                <tr>
                  <td class="key">Obrázek</td>
                  <td class="val"><img src="{$weburl}img/slideshow/{$value->path}" /></td>
                  <td class="val"><img src="{$weburl}img/slideshow/{$value->path}" /></td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Autor</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_s">
              <table>
                <tr>
                  <td class="key">Datum</td>
                  <td class="val">{$core::getCzechDateTime($value->old_date)}</td>
                  <td class="val">{$core::getCzechDateTime($value->new_date)}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
{else}
        <div class="mws-summary-2">
          <div class="levy_sloupec_obsah levy_sloupec_obsah_porovnani levy_sloupec_obsah_samostatny">
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Popis</td>
                  <td class="val">{$value->description}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_m">
              <table>
                <tr>
                  <td class="key">Obrázek</td>
                  <td class="val"><img src="{$weburl}img/slideshow/{$value->path}" /></td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Autor</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Datum přidání</td>
                  <td class="val">{$core::getCzechDateTime($value->add_date)}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
{/if}',
            'content' => '
  <div class="grid_8 addbtn">
    <a href="%%weburl%%" class="btn btn-primary btn-primary5">Zpět na výpis</a>
  </div>
      %%loop_begin%%
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%name%%</span>
      <span class="idpolozky">{if="$value->state_old_id"}z #{$value->state_old_id} na #{$value->state_id}{else}#{$value->state_id}{/if}</span>
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
        <span>Žádný screenshot</span>
      </div>
    </div>
      %%loop_end%%',
          ))
        ->setLink(array(  // prechot do editace, pokud je nove id pouzi v odkatu to (nove/idnotif)
            'title' => 'Schválit screenshot',
            'color' => 'btn-primary btn-primary18',
            'enabled' => $user->isAllowed($acl_resource, 'activate'),
            'link' => '<a href="%%weburl%%../edit/{$value->state_id}/{$value->idnotification}" class="btn btn-small %%color%%">%%title%%</a>',
          ))
        ->setEdit(array(
            'title' => 'Zamítnout screenshot',
            'url' => 'deactivate',
            'color' => 'btn-danger btn-danger28',
            'submit_button' => '{submit:;%%title%%|$|class|:|btn btn-small btn-danger btn-danger28}',
            'success' => '<div class="mws-form-message info">Screenshot byl zamítnut!</div>',
            'enabled' => $user->isAllowed($acl_resource, 'deactivate'),
            'form_raw' => true,
            'content' => '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%show/{%%action_id%%}" class="btn btn-primary btn-primary5" title="Zpět na podrobnosti screenshotu">Zpět na podrobnosti screenshotu</a>
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
            'content_values' => '->put(\'state_msg\', %%values%%[\'state_msg\'] ?: null)
                                ->put(\'handled_id\', $user->getId())
                                ->putDate(\'deleted\')
                                ->put(\'state\', false)',
            'code_post_update' => '
              // vytazeni id z notifikaci
              $c = $db->rawQuery(\'SELECT from_id, state_id, state_old_id, iduser, description FROM %%table%%
                                  JOIN slideshows ON idslideshow=state_id
                                  WHERE %%table_id%%=?\', array(%%row_id%%))->getFirst();

              if ($c) { // overeni existence
                classes\Emailer::factory(classes\Emailer::HTML)
                    ->addTo($db->query(\'users\', \'email\', \'iduser=?\', array($c->iduser))->getFirst()->email)  // nacteni emailu
                    ->setFrom(\'admin@trainz.cz\')
                    ->setSubject(\'Žádost o přidání/aktualizaci screenshotu na Trainz.cz\')
                    ->setMessageArgs(\'Dobrý den,<br /><br />Váš screenshot byl zamítnut.<br /><br />Důvod:<br />----------------------------<br />%s<br />----------------------------<br /><br />Pro získání podrobnějších informací přejděte do autorské sekce Trainz.cz<br /><br />--<br />Trainz.cz\', %%values%%[\'state_msg\'] ?: \'-- Důvod nebyl uveden --\')
                    ->send();

                if ($c->state_old_id) { // pokud je aktualizovana
                  // aktivace stare polozky
                  $db->update(\'slideshows\', classes\ContentValues::init(array(\'confirmed\' => true)), \'idslideshow=?\', array($c->state_old_id));
                }

                // add (smaze novy) / update (smaze novy + stary necha)
                $db->delete(\'slideshows\', \'idslideshow=?\', array($c->state_id)); // odmazani noveho
              }
            ',
          ));
  } else {
    $sekce
        ->setList(array(
            'query' => '$db->rawQuery(\'SELECT idnotification, type, subject, message, %%table%%.added, state_id, state_old_id,
                                        _from.login, _from.alias, _id.description,
                                        _old.description old_description
                                        FROM %%table%%
                                        JOIN users _from ON _from.iduser = from_id
                                        JOIN slideshows _id ON _id.idslideshow = state_id
                                        LEFT JOIN slideshows _old ON _old.idslideshow=state_old_id
                                        WHERE %%table%%.deleted IS NULL AND type=?
                                        ORDER BY %%table%%.added DESC\', array($crate::TYPE_SLIDESHOW))',
            'name' => '{$crate->getMsgTypeNotification($value->type . ($value->state_old_id ? \'_edit\': null))}',
            'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_obsah">
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Screenshot</td>
                  <td class="val">{$value->old_description ?: $value->description}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Autor</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Datum přidání</td>
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
      <span class="idpolozky">{if="$value->state_old_id"}z #{$value->state_old_id} na #{$value->state_id}{else}#{$value->state_id}{/if}</span>
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
        <span>Žádný screenshot</span>
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