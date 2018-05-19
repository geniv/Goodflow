{if="isset($admin_uri['subaction']) && !in_array($admin_uri['subaction'], array('del', 'restore'))"}
<div class="grid_2 mws-tree-navigace mws-tree-navigace-noaddbtn">
  <div class="grid_8_full mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Navigace</span>
    </div>
  {if="count($v0list = $crate->getListDownloadCategory(null, 'cs')->getAll()) > 0"}
    <div class="mws-panel mws-panel-v3">
      <div class="mws-panel-body no-padding">
        <ul id="navigation-treeview">
        {loop="$v0list" as $v0}
          <li><a href="{$weburl_admin}downloads/deactivated/{$crate->getDownloadUrlBuildID($v0->iddownload_category)}"><span>{$v0->name} [{$crate->getCountDownloadInCategory($v0->iddownload_category, true)}]</span></a>
            {if="count($v1list = $crate->getListDownloadCategory($v0->iddownload_category, 'cs')->getAll()) > 0"}
            <ul>
              {loop="$v1list" as $v1}
                <li><a href="{$weburl_admin}downloads/deactivated/{$crate->getDownloadUrlBuildID($v1->iddownload_category)}"><span>{$v1->name} [{$crate->getCountDownloadInCategory($v1->iddownload_category, true)}]</span></a>
                  {if="count($v2list = $crate->getListDownloadCategory($v1->iddownload_category, 'cs')->getAll()) > 0"}
                  <ul>
                  {loop="$v2list" as $v2}
                    <li><a href="{$weburl_admin}downloads/deactivated/{$crate->getDownloadUrlBuildID($v2->iddownload_category)}"><span>{$v2->name} [{$crate->getCountDownloadInCategory($v2->iddownload_category, true)}]</span></a>
                      {if="count($v3list = $crate->getListDownloadCategory($v2->iddownload_category, 'cs')->getAll()) > 0"}
                      <ul>
                        {loop="$v3list" as $v3}
                          <li><a href="{$weburl_admin}downloads/deactivated/{$crate->getDownloadUrlBuildID($v3->iddownload_category)}"><span>{$v3->name} [{$crate->getCountDownloadInCategory($v3->iddownload_category, true)}]</span></a>
                          {if="count($v4list = $crate->getListDownloadCategory($v3->iddownload_category, 'cs')->getAll()) > 0"}
                            <ul>
                              {loop="$v4list" as $v4}
                                <li><a href="{$weburl_admin}downloads/deactivated/{$crate->getDownloadUrlBuildID($v4->iddownload_category)}"><span>{$v4->name} [{$crate->getCountDownloadInCategory($v4->iddownload_category, true)}]</span></a></li>
                              {/loop}
                            </ul>
                          {/if}
                          </li>
                        {/loop}
                      </ul>
                      {/if}
                    </li>
                  {/loop}
                  </ul>
                  {/if}
                </li>
              {/loop}
            </ul>
            {/if}
          </li>
        {/loop}
        </ul>
      </div>
    </div>
  </div>
  {/if}
</div>
{/if}

{code}//<?

$last = null;
if (isset($admin_uri['subaction'])) {
  $idlist = explode('-', $admin_uri['subaction']);
  $last = implode(array_slice($idlist, -1));
}

$sekce = classes\Section::build($weburl_admin.'downloads/deactivated/', '$admin_uri.subaction', '$admin_uri.id');
$sekce
    ->setTable('downloads', 'iddownload')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setList(array(
        'url' => !in_array($admin_uri['subaction'], array('del', 'restore')) ? $admin_uri['subaction'] : null,
        'query' => '$db->rawQuery(\'SELECT iddownload, idlanguage, users.login, users.alias, %%table%%.author, picture, polygons, visible, %%table%%.added, %%table%%.edited, %%table%%.deleted,
                                          languages_has_downloads.name, languages_has_downloads.description FROM %%table%%
                                    JOIN languages_has_downloads USING(iddownload)
                                    JOIN languages USING(idlanguage)
                                    LEFT JOIN users USING(iduser)
                                    WHERE languages.code=? AND iddownload_category=? AND %%table%%.deleted IS NOT NULL
                                    ORDER BY %%table%%.added DESC\', array(\'cs\', \''.$last.'\'))',
        'name' => '{$value->name}',
        'description' => '
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
                  <td class="val"><input type="checkbox" disabled{$value->visible ? \' checked\' : null} class="ibutton" data-label-on="ANO" data-label-off="NE&nbsp;" /></td>
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
        </div>',
        'content' => '
<div class="grid_6 mws-tree-navigace-noaddbtn">
  <div class="grid_8_full mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>{$crate->getDownloadCategory(\''.$last.'\', \'name\') ?: \'Download\'}</span>
    </div>
  </div>
      %%loop_begin%%
  <div class="grid_4_vypis {$counter1 % 2 == 0 ? \'grid_4_vypis_liche \' : null}mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%name%%</span>
      <span class="idpolozky">#{%%id_row%%}</span>
    </div>
    <div class="mws-panel-body no-padding">
      %%description%%
      <div class="mws-button-row">
        %%links%%
      </div>
    </div>
  </div>
      %%loop_empty%%
  {if="%%action_uri%%"}
  <div class="grid_8_full mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
      <span>Žádná položka</span>
    </div>
  </div>
  {/if}
      %%loop_end%%
</div>',
    ))
    ->setDel(array(
      'enabled' => $user->isAllowed($acl_resource, 'del'),
      'title' => 'Smazat objekt/mapu',
      'code_pre_delete' => '
        $iddownload_category = $db->query(\'downloads\', \'iddownload_category\', \'iddownload=?\', array(%%row_id%%))->getFirst()->iddownload_category;

        // prepsany trigger
        // odmazavani cdp
        $db->delete(\'trainz_cdp\', \'idtrainz_cdp IN (SELECT idtrainz_cdp FROM downloads_has_trainz_cdp WHERE iddownload=?)\', array(%%row_id%%));
        // odmazavani download-cdp M:N
        $db->delete(\'downloads_has_trainz_cdp\', \'iddownload=?\', array(%%row_id%%));
        // odmazavani download-language M:N
        $db->delete(\'languages_has_downloads\', \'iddownload=?\', array(%%row_id%%));
      ',
      'refresh_url' => '%%weburl%%\'.$crate->getDownloadUrlBuildID($iddownload_category).\'',
      ))
    ->setUpdate(array(
      'enabled' => $user->isAllowed($acl_resource, 'restore'),
      'url' => 'restore',
      'title' => 'Obnovit objekt/mapu',
      'question' => 'Opravdu chcete obnovit: &quot;%%name%%&quot; ?',
      'color' => 'btn-primary btn-primary18',
      'content_values' => '->putNull(\'deleted\')',
      'code_post_update' => '
        $iddownload_category = $db->query(\'downloads\', \'iddownload_category\', \'iddownload=?\', array(%%row_id%%))->getFirst()->iddownload_category;
      ',
      'refresh_url' => '%%weburl%%\'.$crate->getDownloadUrlBuildID($iddownload_category).\'',
      ));
{/code}

{compile="$sekce->render()"}