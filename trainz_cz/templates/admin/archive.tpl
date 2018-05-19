  <div class="grid_8 mws-panel mws-tree-navigace-noaddbtn">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">Registrace uživatelů</span>
    </div>
  </div>
{loop="$db->rawQuery('SELECT idnotification, subject, message, type, notifications.added, notifications.deleted, state, state_id, state_msg, ip, agent,
                        -- _from.login from_login, _from.alias from_alias, _fr.name from_role,
                        -- _to.login to_login, _to.alias to_alias, _tr.name to_role,
                        _handled.login handled_login, _handled.alias handled_alias, _hr.name handled_role
                      FROM notifications
                      -- LEFT JOIN users _from ON _from.iduser = from_id
                      -- LEFT JOIN roles _fr ON _fr.idrole = _from.idrole

                      -- LEFT JOIN users _to ON _to.iduser = to_id
                      -- LEFT JOIN roles _tr ON _tr.idrole = _to.idrole

                      LEFT JOIN users _handled ON _handled.iduser = handled_id
                      LEFT JOIN roles _hr ON _hr.idrole = _handled.idrole
                      WHERE notifications.deleted IS NOT NULL AND type=?
                      ORDER BY notifications.deleted DESC', array($crate::TYPE_REGISTRATION))"}
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$crate->getMsgTypeNotification($value->type)}</span>
      <span class="idpolozky">#{$value->state_id}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2 mws-summary-2-archiv">
        <div class="levy_sloupec_obsah">
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Registrující</td>
                <td class="val">{$value->subject} ({if="$value->ip"}<a href="javascript:getHostName('.rethref{$value->idnotification}', '{$value->ip}')" class="rethref{$value->idnotification}">{$value->ip}</a>{else}nedostupné{/if}, {$value->agent ? classes\UserAgentString::getBrowser($value->agent) : 'nedostupné'})</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Email registrujícího</td>
                <td class="val">{$value->message}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Vyřídil</td>
                <td class="val">{$value->handled_login} {if="$value->handled_alias"} ({$value->handled_alias}){/if}&nbsp;&nbsp;[{$value->handled_role}]</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Stav</td>
                <td class="val">{$value->state === "1" ? 'Schváleno' : null}{$value->state === "0" ? 'Zamítnuto' : null}{$value->state === null ? 'Čeká na schválení' : null}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Důvod</td>
                <td class="val">{$value->state_msg ?: '-- bez důvodu --'}</td>
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
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Datum vyřízení</td>
                <td class="val">{$core::getCzechDateTime($value->deleted)}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Žádný záznam</span>
    </div>
  </div>
{/loop}
  <div class="grid_8 mws-panel mws-tree-navigace-noaddbtn">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">Zprávy</span>
    </div>
  </div>
{loop="$db->rawQuery('SELECT idnotification, subject, message, type, subject, message, notifications.added, notifications.deleted, state, state_id, state_msg, ip, agent,
                        _from.login from_login, _from.alias from_alias, _fr.name from_role,
                        _to.login to_login, _to.alias to_alias, _tr.name to_role
                        -- _handled.login handled_login, _handled.alias handled_alias, _hr.name handled_role
                      FROM notifications
                      LEFT JOIN users _from ON _from.iduser = from_id
                      LEFT JOIN roles _fr ON _fr.idrole = _from.idrole

                      LEFT JOIN users _to ON _to.iduser = to_id
                      LEFT JOIN roles _tr ON _tr.idrole = _to.idrole

                      -- LEFT JOIN users _handled ON _handled.iduser = handled_id
                      -- LEFT JOIN roles _hr ON _hr.idrole = _handled.idrole
                      WHERE notifications.deleted IS NOT NULL AND type=?
                      ORDER BY notifications.deleted DESC', array($crate::TYPE_MESSAGE))"}
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$crate->getMsgTypeNotification($value->type)}</span>
      <span class="idpolozky">#{$value->idnotification}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2 mws-summary-2-archiv">
        <div class="levy_sloupec_obsah">
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Předmět</td>
                <td class="val">{$value->subject}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Zpráva</td>
                <td class="val">{$value->message}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Od</td>
                <td class="val">{if="$value->from_login"}{$value->from_login}{if="$value->from_alias"} ({$value->from_alias}){/if}&nbsp;&nbsp;[{$value->from_role}]{else}-- autor již neexistuje --{/if} ({if="$value->ip"}<a href="javascript:getHostName('.rethref{$value->idnotification}', '{$value->ip}')" class="rethref{$value->idnotification}">{$value->ip}</a>{else}nedostupné{/if}, {$value->agent ? classes\UserAgentString::getBrowser($value->agent) : 'nedostupné'})</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Komu</td>
                <td class="val">{if="$value->to_login"}{$value->to_login}{if="$value->to_alias"} ({$value->to_alias}){/if}&nbsp;&nbsp;[{$value->to_role}]{else}-- autor již neexistuje --{/if}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Datum zprávy</td>
                <td class="val">{$core::getCzechDateTime($value->added)}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Datum archivace</td>
                <td class="val">{$core::getCzechDateTime($value->deleted)}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Žádný záznam</span>
    </div>
  </div>
{/loop}
  <div class="grid_8 mws-panel mws-tree-navigace-noaddbtn">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">Slideshow</span>
    </div>
  </div>
{loop="$db->rawQuery('SELECT idnotification, subject, message, type, subject, message, notifications.added, notifications.deleted, state, state_id, state_old_id, state_msg, ip, agent,
                        _from.login from_login, _from.alias from_alias, _fr.name from_role,
                        -- _to.login to_login, _to.alias to_alias, _tr.name to_role,
                        _handled.login handled_login, _handled.alias handled_alias, _hr.name handled_role
                      FROM notifications
                      LEFT JOIN users _from ON _from.iduser = from_id
                      LEFT JOIN roles _fr ON _fr.idrole = _from.idrole

                      -- LEFT JOIN users _to ON _to.iduser = to_id
                      -- LEFT JOIN roles _tr ON _tr.idrole = _to.idrole

                      LEFT JOIN users _handled ON _handled.iduser = handled_id
                      LEFT JOIN roles _hr ON _hr.idrole = _handled.idrole
                      WHERE notifications.deleted IS NOT NULL AND type=?
                      ORDER BY notifications.deleted DESC', array($crate::TYPE_SLIDESHOW))"}
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$crate->getMsgTypeNotification($value->type . ($value->state_old_id ? '_edit': null))}</span>
      <span class="idpolozky">{if="$value->state_old_id"}z #{$value->state_old_id} na #{$value->state_id}{else}#{$value->state_id}{/if}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2 mws-summary-2-archiv">
        <div class="levy_sloupec_obsah">
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Popis</td>
                <td class="val">{$value->message}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Autor</td>
                <td class="val">{$value->from_login}{if="$value->from_alias"} ({$value->from_alias}){/if}&nbsp;&nbsp;[{$value->from_role}] ({if="$value->ip"}<a href="javascript:getHostName('.rethref{$value->idnotification}', '{$value->ip}')" class="rethref{$value->idnotification}">{$value->ip}</a>{else}nedostupné{/if}, {$value->agent ? classes\UserAgentString::getBrowser($value->agent) : 'nedostupné'})</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Vyřídil</td>
                <td class="val">{$value->handled_login} {if="$value->handled_alias"} ({$value->handled_alias}){/if}&nbsp;&nbsp;[{$value->handled_role}]</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Stav</td>
                <td class="val">{$value->state === "1" ? 'Schváleno' : null}{$value->state === "0" ? 'Zamítnuto' : null}{$value->state === null ? 'Čeká na schválení' : null}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Důvod</td>
                <td class="val">{$value->state_msg ?: '-- bez důvodu --'}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Datum vytvoření</td>
                <td class="val">{$core::getCzechDateTime($value->added)}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Datum vyřízení</td>
                <td class="val">{$core::getCzechDateTime($value->deleted)}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Žádný záznam</span>
    </div>
  </div>
{/loop}
  <div class="grid_8 mws-panel mws-tree-navigace-noaddbtn">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">Download</span>
    </div>
  </div>
{loop="$db->rawQuery('SELECT idnotification, subject, message, type, subject, message, notifications.added, notifications.deleted, state, state_id, state_old_id, state_msg, ip, agent,
                        _from.login from_login, _from.alias from_alias, _fr.name from_role,
                        -- _to.login to_login, _to.alias to_alias, _tr.name to_role,
                        _handled.login handled_login, _handled.alias handled_alias, _hr.name handled_role
                      FROM notifications
                      LEFT JOIN users _from ON _from.iduser = from_id
                      LEFT JOIN roles _fr ON _fr.idrole = _from.idrole

                      -- LEFT JOIN users _to ON _to.iduser = to_id
                      -- LEFT JOIN roles _tr ON _tr.idrole = _to.idrole

                      LEFT JOIN users _handled ON _handled.iduser = handled_id
                      LEFT JOIN roles _hr ON _hr.idrole = _handled.idrole
                      WHERE notifications.deleted IS NOT NULL AND type=?
                      ORDER BY notifications.deleted DESC', array($crate::TYPE_DOWNLOAD))"}
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$crate->getMsgTypeNotification($value->type . ($value->state_old_id ? '_edit': null))}</span>
      <span class="idpolozky">{if="$value->state_old_id"}z #{$value->state_old_id} na #{$value->state_id}{else}#{$value->state_id}{/if}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2 mws-summary-2-archiv">
        <div class="levy_sloupec_obsah">
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Název</td>
                <td class="val">{$value->message}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Autor</td>
                <td class="val">{$value->from_login}{if="$value->from_alias"} ({$value->from_alias}){/if}&nbsp;&nbsp;[{$value->from_role}] ({if="$value->ip"}<a href="javascript:getHostName('.rethref{$value->idnotification}', '{$value->ip}')" class="rethref{$value->idnotification}">{$value->ip}</a>{else}nedostupné{/if}, {$value->agent ? classes\UserAgentString::getBrowser($value->agent) : 'nedostupné'})</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Vyřídil</td>
                <td class="val">{$value->handled_login} {if="$value->handled_alias"} ({$value->handled_alias}){/if}&nbsp;&nbsp;[{$value->handled_role}]</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Stav</td>
                <td class="val">{$value->state === "1" ? 'Schváleno' : null}{$value->state === "0" ? 'Zamítnuto' : null}{$value->state === null ? 'Čeká na schválení' : null}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Důvod</td>
                <td class="val">{$value->state_msg ?: '-- bez důvodu --'}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Datum vytvoření</td>
                <td class="val">{$core::getCzechDateTime($value->added)}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_m">
            <table>
              <tr>
                <td class="key">Datum vyřízení</td>
                <td class="val">{$core::getCzechDateTime($value->deleted)}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Žádný záznam</span>
    </div>
  </div>
{/loop}