{code}//<?
  $search = isset($_POST['search']) ? $_POST['search'] : null;  // hledany vyraz
  $referer = isset($_POST['HTTP_REFERER']) ? $_POST['HTTP_REFERER'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $weburl_admin); // vraceni na sekci

  if (!isset($admin_uri['subblock'])) {
    classes\Core::setLocation($weburl_admin);
    exit;
  }

  $id_search = isset($search[0]) && $search[0] == '#' ? substr($search, 1) : 0; // parsrovani na # vyhledavani podle cisla

  // prepinani podle sekce
  switch ($admin_uri['subblock']) {
    default:
      $nazev = null;
    break;

    case 'home':
      $nazev = 'Home';
      $list = $db->rawQuery('SELECT _s.message, _u.login, _u.alias, _u.avatar, _r.name role, _s.added FROM shoutboards _s
                            JOIN users _u USING(iduser)
                            JOIN roles _r USING(idrole)
                            WHERE
                              (_u.login LIKE ? OR _u.alias LIKE ? OR _s.message LIKE ?)', array('%'.$search.'%', '%'.$search.'%', '%'.$search.'%'));
    break;

    case 'news':  // acl: search/news
      $nazev = 'Novinky';
      $list = $db->rawQuery('SELECT idnews, _u.login, _u.alias, _r.name role, news_icons.name icon_name, news_icons.path icon_path,
                              _lhn.name name, _lhn.description description, _n.added, _n.edited FROM news _n
                            JOIN languages_has_news _lhn USING(idnews)
                            JOIN languages USING(idlanguage)
                            JOIN news_icons USING(idnews_icon)
                            JOIN users _u USING(iduser)
                            JOIN roles _r USING(idrole)
                            WHERE languages.code=? AND
                              (idnews=? OR _u.login LIKE ? OR _u.alias LIKE ? OR _lhn.name LIKE ? OR _lhn.description LIKE ?)', array('cs', $id_search, '%'.$search.'%', '%'.$search.'%', '%'.$search.'%', '%'.$search.'%'));
    break;

    case 'users': // acl: search/users
      $nazev = 'Uživatelé';
      $list = $db->rawQuery('SELECT iduser, login, alias, email, roles.name, avatar, confirmed, confirmed_email, added, edited FROM users
                            JOIN roles USING(idrole)
                            WHERE deleted IS NULL AND
                              (iduser=? OR login LIKE ? OR alias LIKE ? OR email LIKE ?)', array($id_search, '%'.$search.'%', '%'.$search.'%', '%'.$search.'%'));
    break;

    case 'slideshows':  // acl: search/slideshows
      $nazev = 'Slideshow';
      $list = $db->rawQuery('SELECT idslideshow, _s.iduser, _u.login, _u.alias, _s.author, _s.visible, _s.path, _s.description, _s.added, _s.edited
                            FROM slideshows _s
                            LEFT JOIN users _u USING(iduser)
                            WHERE _s.confirmed=1 AND
                              (idslideshow=? OR _u.login LIKE ? OR _u.alias LIKE ? OR _s.author LIKE ? OR _s.description LIKE ?)', array($id_search, '%'.$search.'%', '%'.$search.'%', '%'.$search.'%', '%'.$search.'%'));
    break;

    case 'downloads': // acl: search/downloads
      $nazev = 'Download';
      switch ($admin_uri['subaction']) {
        case '':
          $list = $db->rawQuery('SELECT iddownload, idlanguage, _u.login, _u.alias, _d.author, picture, polygons, visible, _d.added, _d.edited, _lhd.name, _lhd.description
                                FROM downloads _d
                                JOIN languages_has_downloads _lhd USING(iddownload)
                                JOIN languages USING(idlanguage)
                                LEFT JOIN users _u USING(iduser)
                                WHERE languages.code=? AND _d.confirmed=1 AND _d.deleted IS NULL AND
                                  (iddownload=? OR _u.login LIKE ? OR _u.alias LIKE ? OR _d.author LIKE ? OR _lhd.name LIKE ? OR _lhd.description LIKE ?)', array('cs', $id_search, '%'.$search.'%', '%'.$search.'%', '%'.$search.'%', '%'.$search.'%', '%'.$search.'%'));
        break;

        case 'deactivated':
          $nazev .= ' - Deaktivované';
          $list = $db->rawQuery('SELECT iddownload, idlanguage, _u.login, _u.alias, _d.author, picture, polygons, visible, _d.added, _d.edited, _d.deleted, _lhd.name, _lhd.description FROM downloads _d
                                JOIN languages_has_downloads _lhd USING(iddownload)
                                JOIN languages USING(idlanguage)
                                LEFT JOIN users _u USING(iduser)
                                WHERE languages.code=? AND _d.deleted IS NOT NULL AND
                                  (iddownload=? OR _u.login LIKE ? OR _u.alias LIKE ? OR _d.author LIKE ? OR _lhd.name LIKE ? OR _lhd.description LIKE ?)', array('cs', $id_search, '%'.$search.'%', '%'.$search.'%', '%'.$search.'%', '%'.$search.'%', '%'.$search.'%'));
        break;

        case 'kuids':
          $nazev .= ' - Databáze kuidů';
          $list = $db->rawQuery('SELECT idtrainz_kuid, kuid, _tk.name, url, idtrainz_cdp, _tc.name cdp_name
                                FROM trainz_kuids _tk
                                LEFT JOIN trainz_cdp _tc USING(idtrainz_cdp)
                                LEFT JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                  WHERE (idtrainz_kuid=? OR kuid=? OR _tk.name LIKE ? OR url LIKE ? OR _tc.name LIKE ?)', array($id_search, $search, '%'.$search.'%', '%'.$search.'%', '%'.$search.'%'));
        break;
      }
    break;
  }
{/code}
  <div class="grid_8 addbtn">
    <a href="{$referer}" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">Hledat v sekci: {$nazev}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <form action="" method="post" autocomplete="off" class="mws-form">
        <div class="mws-form-inline">
          <div class="mws-form-row">
            <label class="mws-form-label" for="hledat_lb">Hledaný výraz</label>
            <div class="mws-form-item">
              <div class="large">
                <input type="text" name="search" placeholder="Hledat..." value="{$search|htmlspecialchars}" class="large" id="hledat_lb">
                <input type="hidden" name="HTTP_REFERER" value="{$referer}">
              </div>
            </div>
          </div>
        </div>
        <div class="mws-button-row">
          <input class="btn btn-small btn-primary btn-primary18" type="submit" value="Hledat">
        </div>
      </form>
    </div>
  </div>
{if="$admin_uri.subblock == 'home'"}
{if="$search"}
<div class="grid_8 mws-panel mws-vzkaznik">
  <div class="mws-panel-header mws-panel-header-normal">
    <span class="nazevpolozky">Vzkazník</span>
  </div>
  <div class="mws-panel-body no-padding clearfix">
    <div class="chat_obal" style="width: 100%;">
      <div class="chat_content">
  {loop="$list"}
        <div class="prispevek {$counter1 % 2 == 0 ? 'lichy_prispevek' : 'sudy_prispevek'}">
          <div class="levy_blok">
            <img src="{$weburl}img/avatars/{$value->avatar}" alt="" onerror="this.src='{$weburl}img/avatars/no-profile-img.png'" />
          </div>
          <div class="pravy_blok">
            <p class="autor">{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->role}]</p>
            <p class="datum">{$core::getCzechDateTime($value->added)}</p>
            <div class="zprava">{$value->message}</div>
          </div>
        </div>
  {emptyloop}
        <div style="padding: 10px; text-align: center;">
          <span>Nebyly nalezeny žádné odpovídající výsledky!</span>
        </div>
  {/loop}
      </div>
    </div>
  </div>
</div>
{else}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyl zadán žádný výraz pro hledání!</span>
    </div>
  </div>
{/if}
{elseif="$admin_uri.subblock == 'news'"}
{if="$search"}
  {loop="$list"}
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$value->name}</span>
      <span class="idpolozky">#{$value->idnews}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2">
        <div class="levy_sloupec_s h_80">
          <img src="{$weburl}img/icons/{$value->icon_path}" />
        </div>
        <div class="obal_pravy_sloupec_s">
          <div class="sloupec obsahovy_sloupec">
            {$value->description}
          </div>
          <div class="sloupec">
            <hr>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Autor</td>
                <td class="val">{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->role}]</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Vytvořeno</td>
                <td class="val">{$core::getCzechDateTime($value->added)}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Upraveno</td>
                <td class="val">{if="$value->edited"}{$core::getCzechDateTime($value->edited)}{else}---{/if}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="mws-button-row">
        {if="$user->isAllowed('news', 'edit')"}<a href="{$weburl_admin}news/edit/{$value->idnews}" class="btn btn-small btn-primary btn-primary18">Upravit novinku</a>{/if}
        {if="$user->isAllowed('news', 'del')"}<a href="{$weburl_admin}news/del/{$value->idnews}" class="btn btn-small btn-danger btn-danger28" onclick="return confirm('Opravdu chcete smazat: &quot;{$value->name}&quot; ?')">Smazat novinku</a>{/if}
      </div>
    </div>
  </div>
  {emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyly nalezeny žádné odpovídající výsledky!</span>
    </div>
  </div>
  {/loop}
{else}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyl zadán žádný výraz pro hledání!</span>
    </div>
  </div>
{/if}
{elseif="$admin_uri.subblock == 'users'"}
{if="$search"}
  {loop="$list"}
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->name}]</span>
      <span class="idpolozky">#{$value->iduser}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2">
        <div class="levy_sloupec_m h_158">
          <img src="{$weburl}img/avatars/{$value->avatar}" alt="" onerror="this.src='{$weburl}img/avatars/no-profile-img.png'" />
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
                <td class="key">Schválený email</td>
                <td class="val"><input type="checkbox" disabled{$value->confirmed_email ? ' checked' : null} class="ibutton" data-label-on="ANO" data-label-off="NE&nbsp;" /></td>
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
        </div>
      </div>
      <div class="mws-button-row">
        {if="$user->isAllowed('users', 'edit')"}<a href="{$weburl_admin}users/edit/{$value->iduser}" class="btn btn-small btn-primary btn-primary18">Upravit uživatele</a>{/if}
        {if="!in_array($value->iduser, array(1, 2)) && $user->isAllowed('users', 'del')"}<a href="{$weburl_admin}users/del/{$value->iduser}" class="btn btn-small btn-danger btn-danger28" onclick="return confirm('Opravdu chcete deaktivovat: &quot;{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->name}]&quot; ?')">Deaktivovat uživatele</a>{/if}
      </div>
    </div>
  </div>
  {emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyly nalezeny žádné odpovídající výsledky!</span>
    </div>
  </div>
  {/loop}
{else}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyl zadán žádný výraz pro hledání!</span>
    </div>
  </div>
{/if}
{elseif="$admin_uri.subblock == 'slideshows'"}
{if="$search"}
  {loop="$list"}
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$value->description}</span>
      <span class="idpolozky">#{$value->idslideshow}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2">
        <div class="levy_sloupec_l h_120">
          <img src="{$weburl}img/slideshow/{$value->path}" />
        </div>
        <div class="obal_pravy_sloupec_l">
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Autor</td>
                <td class="val">{if="$value->author"}{$value->author}{else}{$value->login}{if="$value->alias"} ({$value->alias}){/if}{/if}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_l ibtn_blok">
            <table>
              <tr>
                <td class="key">Zařazeno ve slideshow</td>
                <td class="val"><input type="checkbox" disabled{$value->visible ? ' checked' : null} class="ibutton" data-label-on="ANO" data-label-off="NE&nbsp;" /></td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Vytvořeno</td>
                <td class="val">{$core::getCzechDateTime($value->added)}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Upraveno</td>
                <td class="val">{if="$value->edited"}{$core::getCzechDateTime($value->edited)}{else}---{/if}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="mws-button-row">
        {if="$user->isAllowed('slideshows', 'edit')"}<a href="{$weburl_admin}slideshows/edit/{$value->idslideshow}" class="btn btn-small btn-primary btn-primary18">Upravit obrázek</a>{/if}
        {if="$user->isAllowed('slideshows', 'del')"}<a href="{$weburl_admin}slideshows/del/{$value->idslideshow}" class="btn btn-small btn-danger btn-danger28" onclick="return confirm('Opravdu chcete smazat: &quot;{$value->description}&quot; ?')">Smazat obrázek</a>{/if}
      </div>
    </div>
  </div>
  {emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyly nalezeny žádné odpovídající výsledky!</span>
    </div>
  </div>
  {/loop}
{else}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyl zadán žádný výraz pro hledání!</span>
    </div>
  </div>
{/if}
{elseif="$admin_uri.subblock == 'downloads' && $admin_uri.subaction == ''"}
{if="$search"}
  {loop="$list"}
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$value->name}</span>
      <span class="idpolozky">#{$value->iddownload}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2">
        <div class="levy_sloupec_l h_158">
          <img src="{$weburl}img/download/mini/{$value->picture}" />
        </div>
        <div class="obal_pravy_sloupec_l">
          <div class="sloupec obsahovy_sloupec">
            {$value->description}
          </div>
          <div class="sloupec">
            <hr />
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Autor</td>
                <td class="val">{if="$value->author"}{$value->author}{else}{$value->login}{if="$value->alias"} ({$value->alias}){/if}{/if}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_l ibtn_blok">
            <table>
              <tr>
                <td class="key">Zobrazit ve stránkách</td>
                <td class="val"><input type="checkbox" disabled{$value->visible ? ' checked' : null} class="ibutton" data-label-on="ANO" data-label-off="NE&nbsp;" /></td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Vytvořeno</td>
                <td class="val">{$core::getCzechDateTime($value->added)}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Upraveno</td>
                <td class="val">{if="$value->edited"}{$core::getCzechDateTime($value->edited)}{else}---{/if}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="mws-button-row">
        {if="$user->isAllowed('downloads', 'edit')"}<a href="{$weburl_admin}downloads/edit/{$value->iddownload}" class="btn btn-small btn-primary btn-primary18">Upravit objekt/mapu</a>{/if}
        {if="$user->isAllowed('downloads', 'del')"}<a href="{$weburl_admin}downloads/del/{$value->iddownload}" class="btn btn-small btn-danger btn-danger28" onclick="return confirm('Opravdu chcete deaktivovat: &quot;{$value->name}&quot; ?')">Deaktivovat objekt/mapu</a>{/if}
      </div>
    </div>
  </div>
  {emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyly nalezeny žádné odpovídající výsledky!</span>
    </div>
  </div>
  {/loop}
{else}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyl zadán žádný výraz pro hledání!</span>
    </div>
  </div>
{/if}
{elseif="$admin_uri.subblock == 'downloads' && $admin_uri.subaction == 'deactivated'"}
{if="$search"}
  {loop="$list"}
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$value->name}</span>
      <span class="idpolozky">#{$value->iddownload}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2">
        <div class="levy_sloupec_l h_158">
          <img src="{$weburl}img/download/mini/{$value->picture}" />
        </div>
        <div class="obal_pravy_sloupec_l">
          <div class="sloupec obsahovy_sloupec">
            {$value->description}
          </div>
          <div class="sloupec">
            <hr />
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Autor</td>
                <td class="val">{if="$value->author"}{$value->author}{else}{$value->login}{if="$value->alias"} ({$value->alias}){/if}{/if}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_l ibtn_blok">
            <table>
              <tr>
                <td class="key">Zobrazit ve stránkách</td>
                <td class="val"><input type="checkbox" disabled{$value->visible ? ' checked' : null} class="ibutton" data-label-on="ANO" data-label-off="NE&nbsp;" /></td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Vytvořeno</td>
                <td class="val">{$core::getCzechDateTime($value->added)}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Upraveno</td>
                <td class="val">{if="$value->edited"}{$core::getCzechDateTime($value->edited)}{else}---{/if}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec info_blok_s">
            <table>
              <tr>
                <td class="key">Deaktivováno</td>
                <td class="val">{$core::getCzechDateTime($value->deleted)}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="mws-button-row">
        {if="$user->isAllowed('downloads/deactivated', 'del')"}{/if}<a href="{$weburl_admin}downloads/deactivated/del/{$value->iddownload}" class="btn btn-small btn-danger btn-danger28" onclick="return confirm('Opravdu chcete smazat: &quot;{$value->name}&quot; ?')">Smazat objekt/mapu</a>
        {if="$user->isAllowed('downloads/deactivated', 'restore')"}{/if}<a href="{$weburl_admin}downloads/deactivated/restore/{$value->iddownload}" class="btn btn-small btn-primary btn-primary18" onclick="return confirm('Opravdu chcete obnovit: &quot;{$value->name}&quot; ?')">Obnovit objekt/mapu</a>
      </div>
    </div>
  </div>
  {emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyly nalezeny žádné odpovídající výsledky!</span>
    </div>
  </div>
  {/loop}
{else}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyl zadán žádný výraz pro hledání!</span>
    </div>
  </div>
{/if}
{elseif="$admin_uri.subblock == 'downloads' && $admin_uri.subaction == 'kuids'"}
{if="$search"}
  {loop="$list"}
<div class="grid_2 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">{$crate::formatKuid($value->kuid)}</span>
      <span class="idpolozky">#{$value->idtrainz_kuid}</span>
    </div>
    <div class="mws-panel-body no-padding">
      <div class="mws-summary-2">
        <div class="levy_sloupec_obsah">
          <div class="sloupec">
            <table>
              <tr>
                <td class="key">Název</td>
                <td class="val">{$value->name ?: '-- nevyplněno --'}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec">
            <table>
              <tr>
                <td class="key">Odkaz</td>
                <td class="val">{$value->url ?: '-- nevyplněno --'}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec">
            <table>
              <tr>
                <td class="key">Objekt</td>
                <td class="val">{if="$value->idtrainz_cdp"}{$value->lang_name}{else}-- není v objektu/mapě --{/if}</td>
              </tr>
            </table>
          </div>
          <div class="sloupec">
            <table>
              <tr>
                <td class="key">Soubor</td>
                <td class="val">{if="$value->idtrainz_cdp"}{$value->cdp_name} [#{$value->idtrainz_cdp}]{else}-- není v souboru --{/if}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="mws-button-row">
        {if="$user->isAllowed('downloads/kuids', 'edit')"}<a href="{$weburl_admin}downloads/kuids/edit/{$value->idtrainz_kuid}" class="btn btn-small btn-primary btn-primary18">Upravit kuid</a>{/if}
        {if="$user->isAllowed('downloads/kuids', 'del')"}<a href="{$weburl_admin}downloads/kuids/del/{$value->idtrainz_kuid}" class="btn btn-small btn-danger btn-danger28" onclick="return confirm('Opravdu chcete smazat: &quot;{$crate::formatKuid($value->kuid)}&quot; ?')">Smazat kuid</a>{/if}
      </div>
    </div>
  </div>
  {emptyloop}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyly nalezeny žádné odpovídající výsledky!</span>
    </div>
  </div>
  {/loop}
{else}
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Nebyl zadán žádný výraz pro hledání!</span>
    </div>
  </div>
{/if}
{/if}