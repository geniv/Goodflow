{code}//<?
  $superadmin = $admin_uri['subblock'] == 'edit' && in_array($admin_uri['subaction'], array (1, 2));
// zdrojovy kod formulare
$code = '
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label" for="login_lb">Login</label>
    <div class="mws-form-item">
      <div class="small">
        {text:login|$|maxlength|:|45|,|placeholder|:|Login|,|class|:|large|,|id|:|login_lb|@|filled|:|Musí být vyplněn login!|,|minlength|:|Minimální délka loginu musí být %s znaky!|:|3}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="heslo_lb">Heslo</label>
    <div class="mws-form-item">
      <div class="small">
        {password:hash|$|maxlength|:|45|,|placeholder|:|Heslo|,|class|:|large|,|id|:|heslo_lb}
      </div>
      {if="$admin_uri.subblock == \\\'add\\\'"}<span class="error">Povinné pole!</span>{/if}
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="email_lb">Email</label>
    <div class="mws-form-item">
      <div class="small">
        {text:email|$|maxlength|:|100|,|placeholder|:|Email|,|class|:|large|,|id|:|email_lb|@|filled|:|Musí být vyplněn email!|,|email|:|Email musí mít správný tvar!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="jmeno_lb">Jméno</label>
    <div class="mws-form-item">
      <div class="small">
        {text:alias|$|maxlength|:|50|,|placeholder|:|Jméno|,|class|:|large|,|id|:|jmeno_lb}
      </div>
    </div>
  </div>
  {if="!'.($superadmin ?: 0).'"}<div class="mws-form-row">
    <label class="mws-form-label" for="opravneni_lb">Oprávnění</label>
    <div class="mws-form-item">
      <div class="small">
        {select:idrole|$|class|:|mws-select2 large|,|id|:|opravneni_lb}
      </div>
    </div>
  </div>
  {/if}<div class="mws-form-row">
    <label class="mws-form-label" for="avatar_lb">Avatar</label>
    <div class="mws-form-item">
      <div class="small">
        {file:avatar|$|id|:|avatar_lb|@|image|:|Musí být vložen pouze obrázek!|,|maxfilesize|:|Obrázek nesmí překročit velikost 1 MB!|:|1048576}
      </div>
    </div>
  </div>
  {if="$admin_uri.subblock == \\\'edit\\\'"}<div class="mws-form-row">
    <label class="mws-form-label">Aktuální avatar</label>
    <div class="mws-form-item">
      <div class="small">
        {img:avatar;'.$weburl.'img/avatars/|$|onerror|:|this.src=\\\''.$weburl.'img/avatars/no-profile-img.png\\\' }
      </div>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="smazat_avatar_lb">Smazat avatara</label>
    <div class="mws-form-item">
      <div class="small">
        {checkbox:avatar_delete|$|class|:|ibutton|,|id|:|smazat_avatar_lb|,|data-label-on|:|ANO|,|data-label-off|:|NE&nbsp;}
      </div>
    </div>
  </div>
  {/if}<div class="mws-form-row">
    <label class="mws-form-label" for="confirmed_email_lb">Schválený email</label>
    <div class="mws-form-item">
      <div class="small">
        {checkbox:confirmed_email|$|class|:|ibutton|,|id|:|confirmed_email_lb|,|data-label-on|:|ANO|,|data-label-off|:|NE&nbsp;}
      </div>
    </div>
  </div>
</div>
<div class="mws-button-row">
  %%submit%%
</div>';

// pager
$p = classes\Paginator::init($db->query('users', 'COUNT(iduser) pocet', 'deleted IS NULL AND confirmed=1')->getFirst()->pocet, $global_configure['user']['polozekNaStranku'])
        ->setPage(isset($admin_uri['subblock']) ? ($admin_uri['subblock']?:1) : 1);

$sekce = classes\Section::build($weburl_admin.'users/', '$admin_uri.subblock', '$admin_uri.subaction');
$sekce
    ->setTable('users', 'iduser')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'), array('admin_uri'))
    ->setList(array(
        'url' => isset($admin_uri['subblock']) ? $admin_uri['subblock'] : '',
        'enabled' => $user->isAllowed($acl_resource, 'list'),
        'query' => '$db->rawQuery(\'SELECT iduser, login, alias, email, roles.name, avatar, confirmed_email, added, edited FROM %%table%%
                                    JOIN roles USING(idrole)
                                    WHERE deleted IS NULL AND confirmed=1
                                    ORDER BY iduser ASC '.$p->getLimit().'\')',
        'name' => '{$value->login}{if="$value->alias"} ({$value->alias}){/if}&nbsp;&nbsp;[{$value->name}]',
        'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_m h_158">
            <img src="{$weburl}img/avatars/{$value->avatar}" alt="" onerror="this.src=\'{$weburl}img/avatars/no-profile-img.png\'" />
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
                  <td class="val"><input type="checkbox" disabled{$value->confirmed_email ? \' checked\' : null} class="ibutton" data-label-on="ANO" data-label-off="NE&nbsp;" /></td>
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
        </div>',
      ))
    ->setAdd(array(
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'title' => 'Přidat uživatele',
        'code_post_form' => '
          %%form_var%%
              ->setItems(\'idrole\', $crate->getArrayListRoles())
              ->addRule(\'login\', \'pattern\', \'Login musí mít validní formát!\', \'[a-zA-Z0-9]{3,45}\')
              ->addRule(\'hash\', \'filled\', \'Musí být vyplněno Heslo!\')
              ->addRule(\'hash\', \'minlength\', \'Minimální délka hesla musí být %s znaků!\', 6);
        ',
        'content_values' => '->put(\'hash\', classes\Core::getCleverHash(%%values%%[\'login\'], %%values%%[\'hash\']))
                            ->put(\'alias\', %%values%%[\'alias\'] ?: null)
                            ->putDate(\'added\')
                            ->putBool(\'confirmed\', true)
                            ->putBool(\'confirmed_email\', isset(%%values%%[\'confirmed_email\']))
                            ->putNull(\'avatar\')
                            ->remove(\'avatar_delete\')',
      ))
    ->setEdit(array(
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'title' => 'Upravit uživatele',
        'code_post_form' => '
          %%form_var%%
              ->setReturnValues(array(\'avatar\' => %%data%%->avatar))
              ->setItems(\'idrole\', $crate->getArrayListRoles())
              ->addRule(\'login\', \'pattern\', \'Login musí mít validní formát!\', \'[a-zA-Z0-9]{3,45}\');
        ',
        'content_values' => '->remove(\'avatar_delete\')
                            ->put(\'hash\', %%values%%[\'hash\'] ? classes\Core::getCleverHash(%%values%%[\'login\'], %%values%%[\'hash\']) : %%data%%->hash)
                            ->put(\'alias\', %%values%%[\'alias\'] ?: null)
                            ->putDate(\'edited\')
                            ->putBool(\'confirmed_email\', isset(%%values%%[\'confirmed_email\']))'.($superadmin ? '->remove(\'idrole\')' : ''),
        'ignore_defaults' => array('hash'),
        'code_success' => '
            if (%%values%%[\'avatar\'][\'name\']) {
              $dest = \'img/avatars/\' . classes\Core::makeFilesName(%%values%%[\'avatar\']);

              classes\ImageMaker::resize(%%values%%[\'avatar\'][\'tmp_name\'], $dest, $global_configure[\'admin\'][\'userAvatarWidth\'], $global_configure[\'admin\'][\'userAvatarHeight\']);
              %%values%%[\'avatar\'] = basename($dest);
            } else {
              %%values%%[\'avatar\'] = %%data%%->avatar;
            }

            if (isset(%%values%%[\'avatar_delete\'])) {  // pokud chce obrazek smazat
              %%values%%[\'avatar\'] = null;
            }
          ',
      ))
    ->setUpdate(array(
        'enabled' => $user->isAllowed($acl_resource, 'del'),
        'url' => 'del',
        'title' => 'Deaktivovat uživatele',
        'content_values' => '->putDate(\'deleted\')',
        'ignore' => array(1, 2),
      ));
{/code}

{compile="$sekce->render()"}

{if="$p->isVisible()"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <div class="dataTables_wrapper">
      <div class="dataTables_paginate paging_full_numbers clearfix">
  {if="$p->isPrev()"}
        <a href="{$weburl_admin}users/{$p->getPrevPage()}" class="first paginate_button paginate_button_active" title="Předchozí">&laquo;</a>
  {else}
        <a class="first paginate_button paginate_button_disabled" title="Předchozí">&laquo;</a>
  {/if}
        <span>
  {loop="$p->render(classes\Paginator::TYPE3, array('range' => $global_configure['user']['rozsahStrankovani']))"}
    {if="$p->getPage() == $value"}
          <a class="paginate_active" title="Strana {$value}">{$value}</a>
    {else}
          <a href="{$weburl_admin}users/{$value}" class="paginate_button" title="Strana {$value}">{$value}</a>
    {/if}
  {/loop}
        </span>
  {if="$p->isNext()"}
        <a href="{$weburl_admin}users/{$p->getNextPage()}" class="last paginate_button paginate_button_active" title="Další">&raquo;</a>
  {else}
        <a class="last paginate_button paginate_button_disabled" title="Další">&raquo;</a>
  {/if}
      </div>
    </div>
  </div>
</div>
{/if}