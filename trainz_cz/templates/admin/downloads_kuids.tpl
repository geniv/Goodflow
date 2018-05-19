{code}//<?

// zdrojovy kod formulare
$code = '
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label" for="kuid_lb">Kuid</label>
    <div class="mws-form-item clearfix">
      <div class="end-owrfl defined-650">
        {text:kuid|$|maxlength|:|30|,|placeholder|:|xxxxx:yyyyy(:zzz)|,|class|:|kuid_input defined-250|,|id|:|kuid_lb|@|filled|:|Musí být vyplněn kuid!}
        <label class="defined-380 custom-label">Formát: <span class="kuid_format">&lt;kuid(2):(-)xxxxx:yyyyy(:zzz)&gt;</span></label>
      </div>
      <span class="error clrb">Kuid musí mít správný formát! Pouze čísla, dvojtečky a mínusy!<ul><li><em>xxxxx:yyyyy</em> pro <em>&lt;kuid:xxxxx:yyyyy&gt;</em></li><li><em>xxxxx:yyyyy:zzz</em> pro <em>&lt;kuid2:xxxxx:yyyyy:zzz&gt;</em></li></ul></span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="popis_lb">Název</label>
    <div class="mws-form-item">
      <div class="medium">
        {text:name|$|maxlength|:|100|,|class|:|large|,|id|:|popis_lb}
      </div>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="odkaz_lb">Odkaz</label>
    <div class="mws-form-item">
      <div class="medium">
        {url:url|$|maxlength|:|150|,|class|:|large|,|id|:|odkaz_lb}
      </div>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label">Přiřazení k objektu</label>
    <div class="mws-form-item">
      <div class="medium">
        {select:idtrainz_cdp|$|class|:|mws-dbkuid-select2 large|,|onchange|:|getCdpName(\\\'#popis_lb\\\', this.value)}
      </div>
      <span class="error">Zde můžete manuálně přiřadit konkrétní soubor ke kuidu.<br /><a href="#" id="nepr_zad_obj" class="btn btn-small btn-primary btn-primary18">-- nepřiřazen žádný objekt --</a></span>
    </div>
  </div>
</div>
<div class="mws-button-row">
  %%submit%%
</div>';

// pager
$p = classes\Paginator::init($db->query('trainz_kuids', 'COUNT(idtrainz_kuid) pocet')->getFirst()->pocet, $global_configure['download']['kuidPolozekNaStranku'])
        ->setPage(isset($admin_uri['subaction']) ? ($admin_uri['subaction']?:1) : 1);

$sekce = classes\Section::build($weburl_admin.'downloads/kuids/', '$admin_uri.subaction', '$admin_uri.id');
$sekce
    ->setTable('trainz_kuids', 'idtrainz_kuid')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'), array('uri', 'p'))
    ->setList(array(
        'url' => isset($admin_uri['subaction']) ? $admin_uri['subaction'] : '',
        'query' => '$db->rawQuery(\'SELECT idtrainz_kuid, kuid, t0.name, url, idtrainz_cdp, _tc.name cdp_name, languages_has_downloads.name lang_name
                                    FROM %%table%% t0
                                    LEFT JOIN trainz_cdp _tc USING(idtrainz_cdp)
                                    LEFT JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                    LEFT JOIN languages_has_downloads USING(iddownload)
                                    LEFT JOIN languages USING(idlanguage)
                                    WHERE languages.code=? OR languages.code IS NULL
                                    ORDER BY CAST(kuid AS DECIMAL) ASC, kuid ASC '.$p->getLimit().'\', array(\'cs\'))',
        'name' => '{$crate::formatKuid($value->kuid)}',
        'description' => '
        <div class="mws-summary-2">
          <div class="levy_sloupec_obsah">
            <div class="sloupec">
              <table>
                <tr>
                  <td class="key">Název</td>
                  <td class="val">{$value->name ?: \'-- nevyplněno --\'}</td>
                </tr>
              </table>
            </div>
            <div class="sloupec">
              <table>
                <tr>
                  <td class="key">Odkaz</td>
                  <td class="val">{$value->url ?: \'-- nevyplněno --\'}</td>
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
        </div>',
        'content' => '
  <div class="grid_8 addbtn">
    %%add_link%%
  </div>
      %%loop_begin%%
  <div class="grid_2 mws-panel">
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
    <div class="grid_8 mws-panel">
      <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
        <span>Žádná položka</span>
      </div>
    </div>
      %%loop_end%%',
      ))
    ->setAdd(array(
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'title' => 'Přidat kuid',
        'code_post_form' => '
          %%form_var%%
              ->addRule(\'kuid\', \'pattern\', \'Kuid musí mít správný formát!<ul><li><strong>xxxxx:yyyyy</strong> pro <strong>&lt;kuid:xxxxx:yyyyy&gt;</strong></li><li><strong>xxxxx:yyyyy:zzz</strong> pro <strong>&lt;kuid2:xxxxx:yyyyy:zzz&gt;</strong></li></ul>\', \'-?[0-9]+:[0-9]+(?::[0-9]+)?\')
              ->setItems(\'idtrainz_cdp\', $crate->getArrayListTrainzCDP(), \'-- nepřiřazen žádný objekt --\');
        ',
        'content_values' => '->put(\'name\', %%values%%[\'name\'] ?: null)
                            ->put(\'url\', %%values%%[\'url\'] ?: null)
                            ->put(\'idtrainz_cdp\', %%values%%[\'idtrainz_cdp\'] ?: null)',
      ))
    ->setEdit(array(
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'title' => 'Upravit kuid',
        'code_post_form' => '
          %%form_var%%
              ->addRule(\'kuid\', \'pattern\', \'Kuid musí mít správný formát!<ul><li><strong>xxxxx:yyyyy</strong> pro <strong>&lt;kuid:xxxxx:yyyyy&gt;</strong></li><li><strong>xxxxx:yyyyy:zzz</strong> pro <strong>&lt;kuid2:xxxxx:yyyyy:zzz&gt;</strong></li></ul>\', \'-?[0-9]+:[0-9]+(?::[0-9]+)?\')
              ->setItems(\'idtrainz_cdp\', $crate->getArrayListTrainzCDP(), \'-- nepřiřazen žádný objekt --\');
        ',
        'content_values' => '->put(\'name\', %%values%%[\'name\'] ?: null)
                            ->put(\'url\', %%values%%[\'url\'] ?: null)
                            ->put(\'idtrainz_cdp\', %%values%%[\'idtrainz_cdp\'] ?: null)',
      ))
    ->setDel(array(
        'enabled' => $user->isAllowed($acl_resource, 'del'),
        'title' => 'Smazat kuid',
      ));
{/code}

{compile="$sekce->render()"}

{if="$p->isVisible()"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <div class="dataTables_wrapper">
      <div class="dataTables_paginate paging_full_numbers clearfix">
  {if="$p->isPrev()"}
        <a href="{$weburl_admin}downloads/kuids/{$p->getPrevPage()}" class="first paginate_button paginate_button_active" title="Předchozí">&laquo;</a>
  {else}
        <a class="first paginate_button paginate_button_disabled" title="Předchozí">&laquo;</a>
  {/if}
        <span>
  {loop="$p->render(classes\Paginator::TYPE3, array('range' => $global_configure['download']['kuidRozsahStrankovani']))"}
    {if="$p->getPage()==$value"}
          <a class="paginate_active" title="Strana {$value}">{$value}</a>
    {else}
          <a href="{$weburl_admin}downloads/kuids/{$value}" class="paginate_button" title="Strana {$value}">{$value}</a>
    {/if}
  {/loop}
        </span>
  {if="$p->isNext()"}
        <a href="{$weburl_admin}downloads/kuids/{$p->getNextPage()}" class="last paginate_button paginate_button_active" title="Další">&raquo;</a>
  {else}
        <a class="last paginate_button paginate_button_disabled" title="Další">&raquo;</a>
  {/if}
      </div>
    </div>
  </div>
</div>
{/if}