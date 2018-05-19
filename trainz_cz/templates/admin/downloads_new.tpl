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

$sekce = classes\Section::build($weburl_admin.'downloads/new/', '$admin_uri.subaction', '$admin_uri.id');
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
            'query' => '$db->rawQuery(\'SELECT %%table_id%%, type, subject, message, notifications.added, state_id, state_old_id,
                                          _from.login, _from.alias,
                                          _id.iddownload id, _idlangcategory.name category, _idlangdown.name, _idlangdown.description,
                                          _id.picture, _id.polygons, _id.added add_date, _id.edited new_date,

                                          _old.iddownload old_id, _oldlangcategory.name old_category, _oldlangdown.name old_name, _oldlangdown.description old_description,
                                          _old.picture old_picture, _old.polygons old_polygons, _old.added old_date

                                        FROM %%table%%
                                        JOIN users _from ON _from.iduser=from_id

                                        JOIN downloads _id ON _id.iddownload=state_id
                                        LEFT JOIN downloads _old ON _old.iddownload=state_old_id

                                        JOIN languages_has_downloads _idlangdown ON _idlangdown.iddownload=_id.iddownload
                                        LEFT JOIN languages_has_downloads _oldlangdown ON _oldlangdown.iddownload=_old.iddownload

                                        JOIN languages _idlang ON _idlang.idlanguage=_idlangdown.idlanguage
                                        LEFT JOIN languages _oldlang ON _oldlang.idlanguage=_oldlangdown.idlanguage

                                        JOIN languages_has_downloads_category _idlangcategory ON (_idlangcategory.iddownload_category=_id.iddownload_category AND _idlangcategory.idlanguage=_idlang.idlanguage)
                                        LEFT JOIN languages_has_downloads_category _oldlangcategory ON (_oldlangcategory.iddownload_category=_old.iddownload_category AND _oldlangcategory.idlanguage=_oldlang.idlanguage)

                                        WHERE
                                            %%table%%.deleted IS NULL AND
                                            _idlang.code=? AND
                                            IF(state_old_id IS NOT NULL, _oldlang.idlanguage=_idlang.idlanguage, 1) AND
                                            type=? AND %%table_id%%=?\', array(\'cs\', $crate::TYPE_DOWNLOAD, %%action_id%%))',
            'name' => '{$crate->getMsgTypeNotification($value->type . ($value->state_old_id ? \'_edit\': null))}',
            'description' => '
{if="$value->state_old_id"}
        <div class="mws-summary-2">
          <div class="levy_sloupec_obsah levy_sloupec_obsah_porovnani">
            <div class="sloupec sloupec_head info_blok_l">
              <table>
                <tr>
                  <td class="key"></td>
                  <td class="val"><span>Staré údaje</span></td>
                  <td class="val"><span>Aktualizované údaje</span></td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_l">
              <table>
                <tr>
                  <td class="key">Název</td>
                  <td class="val">{$value->old_name}</td>
                  <td class="val">{$value->name}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_l">
              <table>
                <tr>
                  <td class="key">Popis</td>
                  <td class="val">{$value->old_description}</td>
                  <td class="val">{$value->description}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_l">
              <table>
                <tr>
                  <td class="key">Zařazeno do kategorie</td>
                  <td class="val">{$value->old_category}</td>
                  <td class="val">{$value->category}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_l">
              <table>
                <tr>
                  <td class="key">Oddíly</td>
                  <td class="val clearfix oddily" colspan="2">
                    <div class="obal_stare">
                      {loop="$db->rawQuery(\'SELECT _tc.idtrainz_cdp, _tc.name, path, GROUP_CONCAT(DISTINCT trainz_versions.name ORDER BY trainz_versions.rank SEPARATOR \\\'<br />\\\') versions FROM trainz_cdp _tc
                                            JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                            LEFT JOIN trainz_cdp_has_trainz_versions USING(idtrainz_cdp)
                                            LEFT JOIN trainz_versions USING(idtrainz_version)
                                            WHERE iddownload=?
                                            GROUP BY _tc.idtrainz_cdp\', array($value->old_id))" as $cdp}
                      <div>
                        <table>
                          <tr>
                            <th colspan="2">Oddíl #{$counter2+1}</th>
                          </tr>
                        </table>
                        <table>
                          <tr>
                            <td>Soubor</td>
                            <td><a href="#" onclick="return downloadCDP({$cdp->idtrainz_cdp}, null, false)" class="btn btn-small">{$cdp->name}</a></td>
                          </tr>
                        </table>
                        <table>
                          <tr>
                            <td>Trainz verze</td>
                            <td class="tr_ver_hg">{$cdp->versions ?: \'-- nevyplněno --\'}</td>
                          </tr>
                        </table>
                        <table>
                          <tr>
                            <td>Kuidy</td>
                            <td class="kuidy_hg">
                              {loop="$db->rawQuery(\'SELECT kuid, name FROM trainz_kuids
                                                    JOIN trainz_cdp_has_trainz_kuids _tchtk USING(idtrainz_kuid)
                                                    WHERE _tchtk.idtrainz_cdp=?
                                                    ORDER BY CAST(kuid AS DECIMAL) ASC, kuid ASC\', array($cdp->idtrainz_cdp))" as $k}
                              {if="$counter3 > 0"}<br />{/if}{$crate::formatKuid($k->kuid)}
                              {emptyloop}
                              -- nevyplněno --
                              {/loop}
                            </td>
                          </tr>
                        </table>
                      </div>
                      {/loop}
                    </div>
                    <div class="obal_nove">
                      {loop="$db->rawQuery(\'SELECT _tc.idtrainz_cdp, _tc.name, path, GROUP_CONCAT(DISTINCT trainz_versions.name ORDER BY trainz_versions.rank SEPARATOR \\\'<br />\\\') versions FROM trainz_cdp _tc
                                            JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                            LEFT JOIN trainz_cdp_has_trainz_versions USING(idtrainz_cdp)
                                            LEFT JOIN trainz_versions USING(idtrainz_version)
                                            WHERE iddownload=?
                                            GROUP BY _tc.idtrainz_cdp\', array($value->id))" as $cdp}
                      <div>
                        <table>
                          <tr>
                            <th colspan="2">Oddíl #{$counter2+1}</th>
                          </tr>
                        </table>
                        <table>
                          <tr>
                            <td>Soubor</td>
                            <td><a href="#" onclick="return downloadCDP({$cdp->idtrainz_cdp}, null, false)" class="btn btn-small">{$cdp->name}</a></td>
                          </tr>
                        </table>
                        <table>
                          <tr>
                            <td>Trainz verze</td>
                            <td class="tr_ver_hg">{$cdp->versions ?: \'-- nevyplněno --\'}</td>
                          </tr>
                        </table>
                        <table>
                          <tr>
                            <td>Kuidy</td>
                            <td class="kuidy_hg">
                              {loop="$db->rawQuery(\'SELECT kuid, name FROM trainz_kuids
                                                    JOIN trainz_cdp_has_trainz_kuids _tchtk USING(idtrainz_kuid)
                                                    WHERE _tchtk.idtrainz_cdp=?
                                                    ORDER BY CAST(kuid AS DECIMAL) ASC, kuid ASC\', array($cdp->idtrainz_cdp))" as $k}
                              {if="$counter3 > 0"}<br />{/if}{$crate::formatKuid($k->kuid)}
                              {emptyloop}
                              -- nevyplněno --
                              {/loop}
                            </td>
                          </tr>
                        </table>
                      </div>
                      {/loop}
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_l">
              <table>
                <tr>
                  <td class="key">Kuid závislosti</td>
                  <td class="val">
                    {loop="$db->rawQuery(\'SELECT kuid FROM trainz_kuids
                                          JOIN downloads_has_trainz_kuid USING(idtrainz_kuid)
                                          WHERE iddownload=?\', array($value->old_id))" as $k}
                    {if="$counter2 > 0"}<br />{/if}{$crate::formatKuid($k->kuid)}
                    {emptyloop}
                    -- nevyplněno --
                    {/loop}
                  </td>
                  <td class="val">
                    {loop="$db->rawQuery(\'SELECT kuid FROM trainz_kuids
                                          JOIN downloads_has_trainz_kuid USING(idtrainz_kuid)
                                          WHERE iddownload=?\', array($value->id))" as $k}
                    {if="$counter2 > 0"}<br />{/if}{$crate::formatKuid($k->kuid)}
                    {emptyloop}
                    -- nevyplněno --
                    {/loop}
                  </td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_l">
              <table>
                <tr>
                  <td class="key">Náhled</td>
                  <td class="val"><img src="{$weburl}img/download/mini/{$value->old_picture}" /></td>
                  <td class="val"><img src="{$weburl}img/download/mini/{$value->picture}" /></td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_l">
              <table>
                <tr>
                  <td class="key">Počet polygonů celkem</td>
                  <td class="val">{$value->old_polygons ?: \'-- nevyplněno --\'}</td>
                  <td class="val">{$value->polygons ?: \'-- nevyplněno --\'}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_l">
              <table>
                <tr>
                  <td class="key">Autor</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_l">
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
            <div class="sloupec info_blok_l">
              <table>
                <tr>
                  <td class="key">Název</td>
                  <td class="val">{$value->name}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_l">
              <table>
                <tr>
                  <td class="key">Popis</td>
                  <td class="val">{$value->description}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_l">
              <table>
                <tr>
                  <td class="key">Zařazeno do kategorie</td>
                  <td class="val">{$value->category}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_l">
              <table>
                <tr>
                  <td class="key">Oddíly</td>
                  <td class="val clearfix oddily" colspan="2">
                    <div class="obal_oddil">
                      {loop="$db->rawQuery(\'SELECT _tc.idtrainz_cdp, _tc.name, path, GROUP_CONCAT(DISTINCT trainz_versions.name ORDER BY trainz_versions.rank SEPARATOR \\\'<br />\\\') versions FROM trainz_cdp _tc
                                            JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                            LEFT JOIN trainz_cdp_has_trainz_versions USING(idtrainz_cdp)
                                            LEFT JOIN trainz_versions USING(idtrainz_version)
                                            WHERE iddownload=?
                                            GROUP BY _tc.idtrainz_cdp\', array($value->id))" as $cdp}
                      <div>
                        <table>
                          <tr>
                            <th colspan="2">Oddíl #{$counter2+1}</th>
                          </tr>
                        </table>
                        <table>
                          <tr>
                            <td>Soubor</td>
                            <td><a href="#" onclick="return downloadCDP({$cdp->idtrainz_cdp}, null, false)" class="btn btn-small">{$cdp->name}</a></td>
                          </tr>
                        </table>
                        <table>
                          <tr>
                            <td>Trainz verze</td>
                            <td class="tr_ver_hg">{$cdp->versions ?: \'-- nevyplněno --\'}</td>
                          </tr>
                        </table>
                        <table>
                          <tr>
                            <td>Kuidy</td>
                            <td class="kuidy_hg">
                              {loop="$db->rawQuery(\'SELECT kuid, name FROM trainz_kuids
                                                    JOIN trainz_cdp_has_trainz_kuids _tchtk USING(idtrainz_kuid)
                                                    WHERE _tchtk.idtrainz_cdp=?
                                                    ORDER BY CAST(kuid AS DECIMAL) ASC, kuid ASC\', array($cdp->idtrainz_cdp))" as $k}
                              {if="$counter3 > 0"}<br />{/if}{$crate::formatKuid($k->kuid)}
                              {emptyloop}
                              -- nevyplněno --
                              {/loop}
                            </td>
                          </tr>
                        </table>
                      </div>
                      {/loop}
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_l">
              <table>
                <tr>
                  <td class="key">Kuid závislosti</td>
                  <td class="val">
                    {loop="$db->rawQuery(\'SELECT kuid FROM trainz_kuids
                                          JOIN downloads_has_trainz_kuid USING(idtrainz_kuid)
                                          WHERE iddownload=?\', array($value->id))" as $k}
                    {if="$counter2 > 0"}<br />{/if}{$crate::formatKuid($k->kuid)}
                    {emptyloop}
                    -- nevyplněno --
                    {/loop}
                  </td>
                </tr>
              </table>
            </div>
            <div class="sloupec sloupec_flexhg info_blok_l">
              <table>
                <tr>
                  <td class="key">Náhled</td>
                  <td class="val"><img src="{$weburl}img/download/mini/{$value->picture}" /></td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_l">
              <table>
                <tr>
                  <td class="key">Počet polygonů celkem</td>
                  <td class="val">{$value->polygons ?: \'-- nevyplněno --\'}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_l">
              <table>
                <tr>
                  <td class="key">Autor</td>
                  <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec info_blok_l">
              <table>
                <tr>
                  <td class="key">Datum</td>
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
        <span>Žádná položka</span>
      </div>
    </div>
      %%loop_end%%',
          ))
        ->setLink(array(  // prechot do editace, pokud je nove id pouzi v odkatu to (nove/idnotif)
            'title' => 'Schválit objekt/mapu',
            'color' => 'btn-primary btn-primary18',
            'enabled' => $user->isAllowed($acl_resource, 'activate'),
            'link' => '<a href="%%weburl%%../edit/{$value->state_id}/{$value->idnotification}" class="btn btn-small %%color%%">%%title%%</a>',
          ))
        ->setEdit(array(
            'title' => 'Zamítnout objekt/mapu',
            'url' => 'deactivate',
            'form_raw' => true,
            'color' => 'btn-danger btn-danger28',
            'submit_button' => '{submit:;%%title%%|$|class|:|btn btn-small btn-danger btn-danger28}',
            'success' => '<div class="mws-form-message info">Objekt/mapa byl zamítnut!</div>',
            'enabled' => $user->isAllowed($acl_resource, 'deactivate'),
            'content' => '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%show/{%%action_id%%}" class="btn btn-primary btn-primary5" title="Zpět na podrobnosti objektu/mapy">Zpět na podrobnosti objektu/mapy</a>
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
              $c = $db->rawQuery(\'SELECT from_id, state_id, state_old_id, iduser FROM %%table%%
                                  JOIN downloads ON iddownload=state_id
                                  WHERE %%table_id%%=?\', array(%%row_id%%))->getFirst();

              if ($c) { // overeni existence
                classes\Emailer::factory(classes\Emailer::HTML)
                    ->addTo($db->query(\'users\', \'email\', \'iduser=?\', array($c->iduser))->getFirst()->email)  // nacteni emailu
                    ->setFrom($db->query(\'users\', \'email\', \'iduser=?\', array($user->getId()))->getFirst()->email) //\'admin@trainz.cz\'
                    ->setSubject(\'Žádost o přidání/aktualizaci objektu/mapy na Trainz.cz\')
                    ->setMessageArgs(\'Dobrý den,<br /><br />Váš objekt/mapa byl zamítnut.<br /><br />Důvod:<br />----------------------------<br />%s<br />----------------------------<br /><br />Pro získání podrobnějších informací přejděte do autorské sekce Trainz.cz<br /><br />--<br />Trainz.cz\', %%values%%[\'state_msg\'] ?: \'-- Důvod nebyl uveden --\')
                    ->send();

                if ($c->state_old_id) { // pokud je aktualizovana
                  // aktivace stare polozky
                  $db->update(\'downloads\', classes\ContentValues::init(array(\'confirmed\' => true)), \'iddownload=?\', array($c->state_old_id));
                }

                // add (smaze novy) / update (smaze novy + stary necha)
                $db->delete(\'downloads\', \'iddownload=?\', array($c->state_id)); // odmazani noveho
              }
            ',
          ));
  } else {
    $sekce
        ->setList(array(
            'query' => '$db->rawQuery(\'SELECT idnotification, type, subject, message, %%table%%.added, state_id, state_old_id,
                                        _from.login, _from.alias, _lhd.name, _lhd_old.name old_name
                                        FROM %%table%%

                                        JOIN users _from ON _from.iduser = from_id

                                        JOIN downloads _id ON _id.iddownload = state_id
                                        LEFT JOIN downloads _old ON _old.iddownload = state_old_id

                                        JOIN languages_has_downloads _lhd ON _lhd.iddownload = _id.iddownload
                                        LEFT JOIN languages_has_downloads _lhd_old ON _lhd_old.iddownload = _old.iddownload

                                        JOIN languages _l ON _l.idlanguage = _lhd.idlanguage
                                        LEFT JOIN languages _l_old ON _l_old.idlanguage = _lhd_old.idlanguage

                                        WHERE
                                          %%table%%.deleted IS NULL AND
                                          _l.code=? AND
                                          IF(state_old_id IS NOT NULL, _l_old.idlanguage=_l.idlanguage, 1) AND
                                          type=?
                                        ORDER BY %%table%%.added DESC\', array(\'cs\', $crate::TYPE_DOWNLOAD))',
            'name' => '{$crate->getMsgTypeNotification($value->type . ($value->state_old_id ? \'_edit\': null))}',
            'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_obsah">
            <div class="sloupec info_blok_m">
              <table>
                <tr>
                  <td class="key">Objekt/Mapa</td>
                  <td class="val">{$value->old_name ?: $value->name}</td>
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
        <span>Žádný objekt/mapa</span>
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