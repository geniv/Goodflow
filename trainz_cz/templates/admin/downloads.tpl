{if="isset($admin_uri['subblock']) && !in_array($admin_uri['subblock'], array('add', 'edit', 'update', 'del'))"}
<div class="grid_2 mws-tree-navigace">
  <div class="grid_8_full mws-panel">
    <div class="mws-panel-header mws-panel-header-normal mws-panel-header-typ-2">
      <span>Navigace</span>
    </div>
  {if="count($v0list = $crate->getListDownloadCategory(null, 'cs')->getAll()) > 0"}
    <div class="mws-panel mws-panel-v3">
      <div class="mws-panel-body no-padding">
        <ul id="navigation-treeview">
        {loop="$v0list" as $v0}
          <li><a href="{$weburl_admin}downloads/{$crate->getDownloadUrlBuildID($v0->iddownload_category)}"><span>{$v0->name} [{$crate->getCountDownloadInCategory($v0->iddownload_category)}]</span></a>
            {if="count($v1list = $crate->getListDownloadCategory($v0->iddownload_category, 'cs')->getAll()) > 0"}
            <ul>
              {loop="$v1list" as $v1}
                <li><a href="{$weburl_admin}downloads/{$crate->getDownloadUrlBuildID($v1->iddownload_category)}"><span>{$v1->name} [{$crate->getCountDownloadInCategory($v1->iddownload_category)}]</span></a>
                  {if="count($v2list = $crate->getListDownloadCategory($v1->iddownload_category, 'cs')->getAll()) > 0"}
                  <ul>
                  {loop="$v2list" as $v2}
                    <li><a href="{$weburl_admin}downloads/{$crate->getDownloadUrlBuildID($v2->iddownload_category)}"><span>{$v2->name} [{$crate->getCountDownloadInCategory($v2->iddownload_category)}]</span></a>
                      {if="count($v3list = $crate->getListDownloadCategory($v2->iddownload_category, 'cs')->getAll()) > 0"}
                      <ul>
                        {loop="$v3list" as $v3}
                          <li><a href="{$weburl_admin}downloads/{$crate->getDownloadUrlBuildID($v3->iddownload_category)}"><span>{$v3->name} [{$crate->getCountDownloadInCategory($v3->iddownload_category)}]</span></a>
                          {if="count($v4list = $crate->getListDownloadCategory($v3->iddownload_category, 'cs')->getAll()) > 0"}
                            <ul>
                              {loop="$v4list" as $v4}
                                <li><a href="{$weburl_admin}downloads/{$crate->getDownloadUrlBuildID($v4->iddownload_category)}"><span>{$v4->name} [{$crate->getCountDownloadInCategory($v4->iddownload_category)}]</span></a></li>
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
// zdrojovy kod formulare
$code = '
  <div class="mws-tabs mws-tabs-slouceny grid_8">
    <ul>
    {loop="$crate->getListLanguages()"}
      <li><a href="#tab-{$value->code}">{$translate.lang_code[$value->code]}</a></li>
    {/loop}
    </ul>
    <div class="mws-form-inline">';
foreach ($crate->getListLanguages() as $v) {
  $code .= '
      <div id="tab-'.$v->code.'">
        <div class="mws-form-row">
          <label class="mws-form-label" for="nadpis_'.$v->code.'_lb">Název '.$translate['lang_code'][$v->code].'</label>
          <div class="mws-form-item">
            <div class="medium">
              {text:name['.$v->idlanguage.']|$|maxlength|:|100|,|placeholder|:|Název '.$translate['lang_code'][$v->code].'|,|class|:|large ajax_downloads_name|,|id|:|nadpis_'.$v->code.'_lb|@|filled|:|Název '.$translate['lang_code'][$v->code].' musí být vyplněn!}
              <span class="result_ajax_name'.$v->idlanguage.' pull-right error pull-right"></span>
            </div>
            <span class="error">Povinné pole!</span>
          </div>
        </div>
        <div class="mws-form-row">
          <label class="mws-form-label" for="text_'.$v->code.'_lb">Popis '.$translate['lang_code'][$v->code].'</label>
          <div class="mws-form-item tiny-download">
            <div class="large">
              {textarea:description['.$v->idlanguage.']|$|placeholder|:|Popis '.$translate['lang_code'][$v->code].'|,|class|:|large|,|id|:|text_'.$v->code.'_lb|@|filled|:|Popis '.$translate['lang_code'][$v->code].' musí být vyplněn!}
            </div>
            <span class="error">Povinné pole!</span>
          </div>
        </div>
      </div>';
}
$code .= '
    </div>
  </div>
  <div class="grid_8 mws-panel">
    <div class="mws-panel-body no-padding">
      <fieldset class="mws-form-inline">
        <legend>Zvolte autora a vyberte kategorii (povinné)</legend>
        <div class="mws-form-row">
          <label class="mws-form-label" for="autor_dwn_lb">Autor (databáze autorů)</label>
          <div class="mws-form-item">
            <div class="medium">
              {select:iduser|$|class|:|mws-select2|,|id|:|autor_dwn_lb|,|onchange|:|document.getElementById(\\\'author_elem_dwn\\\').disabled=this.selectedIndex}
            </div>
            <span class="error">Vyberte autora z databáze. Pokud není autor uveden v databázi, tak ho zadejte ručně!</span>
          </div>
        </div>
        <div class="mws-form-row">
          <label class="mws-form-label" for="author_elem_dwn">Autor (zadat ručně)</label>
          <div class="mws-form-item">
            <div class="medium">
              {text:author|$|id|:|author_elem_dwn|,|class|:|large|,|maxlength|:|45}
            </div>
            <span class="error">Zadejte ručně autora pokud není uveden v databázi autorů.</span>
          </div>
        </div>
        <div class="mws-form-row">
          <label class="mws-form-label" for="kategorie_dwnld_lb">Zařadit do kategorie</label>
          <div class="mws-form-item">
            <div class="large">
              {select:iddownload_category|$|class|:|mws-select2|,|id|:|kategorie_dwnld_lb|@|~equal|:|Musí být vybrána kategorie!|:|0}
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="mws-form-inline">
        <legend>Vložte soubor/y (povinné), zvolte Trainz verzi/e a zadejte kuid/y (nepovinné). Zde můžete libovolně přidávat či odebírat oddíly.</legend>
        <div class="obal_file_oddil">
          <a href="#" class="add_cdp btn btn-primary btn-primary17 pridat_oddil"><i class="icon-plus-sign"></i> Přidat další oddíl</a>
          <div class="download_cdp"></div>
        </div>
      </fieldset>
      <fieldset class="mws-form-inline">
        <legend>Kuid závislosti (nepovinné)</legend>
        <div class="mws-form-row">
          <label class="mws-form-label" for="kuid_zavs_lb">Kuid závislosti (databáze)</label>
          <div class="mws-form-item">
            <div class="large">
              {hidden:kuid_dependency|$|class|:|mws-kuid-dependency-select2 large|,|id|:|kuid_zavs_lb}
            </div>
            <span class="error">Zde můžete kliknutím do pole vybrat neomezený počet kuidů z databáze.<br />Tyto kuidy budou označeny jako "Doporučené KUID součásti".<br />Doporučené KUID součásti jsou kuidy, které jsou potřebné pro správnou funkci Vašeho objektu.</span>
          </div>
        </div>
        <div class="mws-form-row">
          <label class="mws-form-label" for="kuid_zavs_lb_nw">Kuid závislosti (přidat nové)</label>
          <div class="mws-form-item clearfix">
            <div class="defined-650">
              {textarea:kuid_dependency_plain|$|class|:|kuid_input_plain defined-250 autosize|,|id|:|kuid_zavs_lb_nw|,|placeholder|:|xxxxx:yyyyy(:zzz)|,|onkeyup|:|javascript:validateKuid(this.value, \\\'.ext_kuid_zav\\\')}
              <div class="ext_kuid_zav custom-label-2 defined-380">Formát: &lt;kuid(2):(-)xxxxx:yyyyy(:zzz)&gt;</div>
            </div>
            <span class="error clrb">Zde můžete zadat neomezený počet kuidů.<br />Tyto kuidy budou označeny jako "Doporučené KUID součásti".<br />Doporučené KUID součásti jsou kuidy, které jsou potřebné pro správnou funkci Vašeho objektu.<br />Každý nový kuid musí být na novém řádku!<br />Prázdné řádky se vyhodnocují jako špatné zadání!<br />Kuid musí mít správný formát! Pouze čísla, dvojtečky a mínusy!<ul><li><em>xxxxx:yyyyy</em> pro <em>&lt;kuid:xxxxx:yyyyy&gt;</em></li><li><em>xxxxx:yyyyy:zzz</em> pro <em>&lt;kuid2:xxxxx:yyyyy:zzz&gt;</em></li></ul></span>
          </div>
        </div>
      </fieldset>
      <fieldset class="mws-form-inline">
        <legend>Vložte náhled (povinné), zadejte počet polygonů celkem (nepovinné) a zvolte, zda se má objekt/mapa zobrazit ve stránkách.</legend>
        <div class="mws-form-row">
          <label class="mws-form-label">Náhled</label>
          <div class="mws-form-item">
            <div class="medium">
              {file:picture|@|image|:|V náhledu musí být vložen obrázek!|,|filled|:|Náhled je povinný!|,|maxfilesize|:|Obrázek nesmí překročit velikost 1,5 MB!|:|1572864}
            </div>
            <span class="error">Rozměry obrázku musí být minimálně <strong>'.$global_configure['download']['miniWidth'].'x'.$global_configure['download']['miniHeight'].'</strong> pixelů!</span>
            <span class="error">Obrázek nesmí překročit velikost <strong>1,5</strong> MB! Podporovány jsou obrázkové formáty (.jpg, .png, apod.)</span>
            <span class="error">Doporučujeme nahrávat obrázky v poměru 4:3</span>
            <span class="error">Povinné pole!</span>
          </div>
        </div>
        {if="$admin_uri.subblock == \\\'edit\\\'"}
        <div class="mws-form-row">
          <label class="mws-form-label">Aktuální náhled</label>
          <div class="mws-form-item">
            <div class="large clearfix">
              <span class="obal_nahled_dwn">
                {img:picture;'.$weburl.'img/download/mini/}
                <span class="mws-nahled-overlay">
                  <a href="#" class="mws-gallery-btn" id="mws-jui-dialog-mdl-btn"><i class="icon-search"></i></a>
                </span>
              </span>
              <div id="mws-jui-dialog" style="padding: 0;">
                {img:picture;'.$weburl.'img/download/full/}
              </div>
            </div>
          </div>
        </div>
        {/if}
        <div class="mws-form-row">
          <label class="mws-form-label" for="polygony_elem">Počet polygonů celkem</label>
          <div class="mws-form-item">
            <div class="small">
              {text:polygons|$|id|:|polygony_elem|,|class|:|large defined-150 jenom-cisla|,|maxlength|:|20}
              <span class="error clrb">Nepovinné pole. Počet polygonů musí mít správný formát! Pouze čísla! Číslo je pouze orientační.<br />Pokud máte více (polygonově stejných) objektů v jednom CDP, tak zadejte počet polygonů jednoho objektu.<br />Pokud objekt pracuje pouze s dalšími objekty tak zadejte celkový počet polygonů včetně těch se kterými pracuje.</span>
            </div>
          </div>
        </div>
        <div class="mws-form-row">
          <label class="mws-form-label" for="visible_dwn_lb">Zobrazit ve stránkách</label>
          <div class="mws-form-item">
            <div class="small">
              {checkbox:visible|$|class|:|ibutton|,|id|:|visible_dwn_lb|,|data-label-on|:|ANO|,|data-label-off|:|NE&nbsp;}
            </div>
            <span class="error">Určuje, zda bude tento objekt/mapa zobrazen ve stránkách!</span>
          </div>
        </div>
      </fieldset>
      <div class="mws-button-row">
        %%submit%%
        <div class="mws-form-item"><span class="error">Pokud není tlačítko aktivní, tak formulář, který chcete odeslat je chybný!</span></div>
      </div>
    </div>
  </div>';

$last = null;
if (isset($admin_uri['subblock'])) {
  $idlist = explode('-', $admin_uri['subblock']);
  $last = implode(array_slice($idlist, -1));
}

$sekce = classes\Section::build($weburl_admin.'downloads/', '$admin_uri.subblock', '$admin_uri.subaction');
$sekce
    ->setTable('downloads', 'iddownload')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form clearfix', 'autocomplete' => 'off'), array('admin_uri', 'crate', 'translate'))
    ->setList(array(
        'enabled' => $user->isAllowed($acl_resource, 'list'),
        'query' => '$db->rawQuery(\'SELECT iddownload, idlanguage, users.login, users.alias, %%table%%.author, picture, polygons, visible, %%table%%.added, %%table%%.edited,
                                      languages_has_downloads.name, languages_has_downloads.description
                                    FROM %%table%%
                                    JOIN languages_has_downloads USING(iddownload)
                                    JOIN languages USING(idlanguage)
                                    LEFT JOIN users USING(iduser)
                                    WHERE languages.code=? AND iddownload_category=? AND %%table%%.confirmed=1 AND %%table%%.deleted IS NULL
                                    ORDER BY %%table%%.added DESC\', array(\'cs\', \''.$last.'\'))',
        'url' => isset($admin_uri['subblock']) && !in_array($admin_uri['subblock'], array('add', 'edit')) ? $admin_uri['subblock'] : null,
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
          </div>
        </div>',
        'content' => '
<div class="grid_6">
  <div class="grid_8_full addbtn{%%action_uri%% ? null : \' download-root\'}">
    %%add_link%%
  </div>
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
      <span>Žádný objekt/mapa</span>
    </div>
  </div>
  {/if}
      %%loop_end%%
</div>',
      ))
    ->setAdd(array(
        'title' => 'Přidat objekt/mapu',
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'back_link' => '%%weburl%%{$crate->getDownloadUrlBuildID(%%action_id%%)}',
        'refresh_url' => '%%weburl%%\'.$crate->getDownloadUrlBuildID(%%action_id%%).\'',
        'link' => '<a href="%%weburl%%add/'.$last.'" class="btn %%color%%">%%title%%</a>',
        'form_raw' => true,
        'submit_security' => true,
        'submit_button' => '{submit:;%%title%%|$|class|:|btn btn-small btn-success btn-success45 addeditbtn_dwn}',
        'success' => '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message success">%%success_title%%</div>
    </div>',
        'failure' => '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message warning">%%failure_title%%</div>
        <div class="mws-button-row"><a href="javascript:history.back()" class="btn btn-small btn-warning btn-warning16">Zpět na formulář</a>
      </div>
    </div>',
        'content' => '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
  <div class="grid_8 mws-panel mws-panel-v2">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
{%%form_msg%%}
%%if_iserrors%%
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message error">
        Nastaly tyto chyby:
        <ul>
            %%loop_geterrors%%
          <li>{$value}</li>
            %%loop_end%%
        </ul>
      </div>
    </div>
%%if_end%%
  </div>
{%%form%%}
',
        'form_values' => array('cdp', 'version', 'kuid_cdp', 'kuid_cdp_plain'),
        'code_post_form' => '
          %%form_var%%->setDefaults(array(\'iddownload_category\' => %%action_id%%))
              ->setItems(\'iduser\', $crate->getArrayListUsers(), \'Autor není v seznamu\')
              ->setItems(\'iddownload_category\', $crate->getArrayListDownloadsCategory())
              ->addRule(\'author\', function($value, $argv) { return $value || $_POST[$argv]; }, \'Musí být vyplněn autor, nebo vybrán z databáze autorů!\', \'iduser\')
              ->addRule(\'polygons\', \'pattern\', \'Polygony celkem musí být v číselném formátu!\', \'[0-9]*\')
              ->addRule(\'cdp\', \'filled\', \'Musí být vložen/y soubor/y!\')
              ->addRule(\'kuid_dependency_plain\', function($value) {
                    $explode = array_filter(explode(PHP_EOL, $value));
                    $poc = 0;
                    foreach ($explode as $row) {
                      if (preg_match(\'/-?[0-9]+:[0-9]+(?::[0-9]+)?/\', $row, $match) && trim($row) == $match[0]) { $poc++; }
                    }
                    return count($explode) == $poc;
                  }, \'Kuid musí mít správný formát! Pouze čísla, dvojtečky a mínusy!\')
              ->addRule(\'kuid_cdp_plain\', function($value) {
                    $sumpoc = $poc = 0;
                    foreach ($value as $item) { // prochazeni pridanych polozek
                      $explode = array_filter(explode(PHP_EOL, $item));
                      $sumpoc += count($explode);
                      foreach ($explode as $row) {  // prochazeni samotnych zaznamu
                        if (preg_match(\'/-?[0-9]+:[0-9]+(?::[0-9]+)?/\', $row, $match) && trim($row) == $match[0]) { $poc++; }
                      }
                    }
                    return $sumpoc == $poc;
                  }, \'Kuid musí mít správný formát! Pouze čísla, dvojtečky a mínusy!\');
        ',
        'code_success' => '
          // uprava obrazku
          $base_dest = classes\Core::makeFilesName(%%values%%[\'picture\']);  // priprava jmena
          classes\ImageMaker::cropResize(%%values%%[\'picture\'][\'tmp_name\'], \'img/download/mini/\' . $base_dest, $global_configure[\'download\'][\'miniWidth\'], $global_configure[\'download\'][\'miniHeight\']);

          $dest_full = \'img/download/full/\' . $base_dest;
          classes\ImageMaker::resize(%%values%%[\'picture\'][\'tmp_name\'], $dest_full, $global_configure[\'download\'][\'fullWidth\'], $global_configure[\'download\'][\'fullHeight\']);
          %%values%%[\'picture\'] = basename($dest_full);
        ',
        'content_values' => '->put(\'iduser\', %%values%%[\'iduser\'] ?: null)
                            ->put(\'author\', %%values%%[\'iduser\'] ? null : trim(%%values%%[\'author\']))
                            ->remove(\'name\')
                            ->remove(\'description\')
                            ->remove(\'kuid_dependency\')
                            ->remove(\'kuid_dependency_plain\')
                            ->remove(\'cdp\')
                            ->remove(\'version\')
                            ->remove(\'kuid_cdp\')
                            ->remove(\'kuid_cdp_plain\')
                            ->put(\'polygons\', %%values%%[\'polygons\'] ?: null)
                            ->putBool(\'confirmed\', true)
                            ->putBool(\'visible\', isset(%%values%%[\'visible\']))
                            ->putDate(\'added\')',
        'code_post_insert' => '
          // doplneni rewrite
          $db->update(\'%%table%%\', classes\ContentValues::init(array(\'rewrite\' => %%row_id%% . \'-\' . classes\Core::getRewrite(%%values%%[\'name\'][1]))), \'%%table_id%%=?\', array(%%row_id%%));

          // kontrola duplicity jen prozi idlanguage=1, pokud je duplikatni vyskakuje
          $idlanguage = 1;
          if ($db->query(\'languages_has_downloads\', \'COUNT(idlanguage) pocet\', \'idlanguage=? AND name=?\', array($idlanguage, %%values%%[\'name\'][$idlanguage]))->getFirst()->pocet != 0) {
            %%row_id%% = -1;
            $db->rollBack();
            break(1);
          }

          // vlozeni name a description
          foreach (%%values%%[\'name\'] as $i => $v) {
            //~ if ($db->query(\'languages_has_downloads\', \'COUNT(idlanguage) pocet\', \'idlanguage=? AND name=?\', array($i, $v))->getFirst()->pocet == 0) {  // pokud neexistuje (0.pocet radku)
              $cv = classes\ContentValues::init()
                      ->put(\'idlanguage\', $i)
                      ->put(\'iddownload\', %%row_id%%)
                      ->put(\'name\', $v)
                      ->put(\'description\', %%values%%[\'description\'][$i]);
              $db->insert(\'languages_has_downloads\', $cv);
            //~ } else {
              //~ %%row_id%% = -1;
              //~ $db->rollBack();
              //~ break(2);
            //~ }
          }

          //vlozeni kuid zavislosti (nepovinne)
          if (isset(%%values%%[\'kuid_dependency\']) && %%values%%[\'kuid_dependency\']) {
            foreach (explode(\',\', %%values%%[\'kuid_dependency\']) as $v) {
              $cv = classes\ContentValues::init()
                      ->put(\'iddownload\', %%row_id%%)
                      ->put(\'idtrainz_kuid\', $v);
              $db->insert(\'downloads_has_trainz_kuid\', $cv);
            }
          }

          // vlozeni kuid zavislosti z plain textu (nepovinne), vyhazuje duplikatni, a prirazuje k downloads
          if (isset(%%values%%[\'kuid_dependency_plain\'])) {
            foreach (array_filter(explode(PHP_EOL, %%values%%[\'kuid_dependency_plain\'])) as $v) {
              $id_kuid = $crate->getKuidId(trim($v));
              if (!$id_kuid) {  // pokud neexistuje, tak ho vlozi
                $id_kuid = $db->insert(\'trainz_kuids\', classes\ContentValues::init(array(\'kuid\' => trim($v)))); // vlozi kuid
              }

              $cv = classes\ContentValues::init()
                    ->put(\'iddownload\', %%row_id%%)
                    ->put(\'idtrainz_kuid\', $id_kuid);
              $db->insert(\'downloads_has_trainz_kuid\', $cv);
            }
          }

          // vlozeni cdp a verzi (projiti pole)
          foreach (%%values%%[\'cdp\'][\'name\'] as $i => $v) {
            if ($v) {
              $dest = \'files/\' . classes\Core::makeFilesName(array(\'tmp_name\' => %%values%%[\'cdp\'][\'tmp_name\'][$i], \'name\' => $v));
              move_uploaded_file(%%values%%[\'cdp\'][\'tmp_name\'][$i], $dest); // nahrani do slozky
            } else {
              continue;  // prazdny se ignoruje
            }

            // vlozeni cdp
            $id_cdp = $db->insert(\'trainz_cdp\', classes\ContentValues::init(array(\'name\' => $v, \'path\' => basename($dest))));

            // vlozeni zavislosti cdp->kuid (nepovinne), multiple select
            if (isset(%%values%%[\'kuid_cdp\'][$i][0]) && %%values%%[\'kuid_cdp\'][$i][0]) {
              foreach (explode(\',\', %%values%%[\'kuid_cdp\'][$i][0]) as $v) {
                $cv = classes\ContentValues::init()
                      ->put(\'idtrainz_cdp\', $id_cdp)
                      ->put(\'idtrainz_kuid\', $v);
                $db->insert(\'trainz_cdp_has_trainz_kuids\', $cv);
              }
            }

            // vlozeni zavislosti cdp->kuid (nepovinne), plain text
            if (isset(%%values%%[\'kuid_cdp_plain\'][$i])) {
              foreach (array_filter(explode(PHP_EOL, %%values%%[\'kuid_cdp_plain\'][$i])) as $v) {
                $id_kuid = $crate->getKuidId(trim($v));
                if (!$id_kuid) {  // pokud neexistuje, tak ho vlozi
                  $id_kuid = $db->insert(\'trainz_kuids\', classes\ContentValues::init()->put(\'kuid\', trim($v))->put(\'name\', %%values%%[\'name\'][1])->put(\'idtrainz_cdp\', $id_cdp)); // vlozi kuid
                }

                $cv = classes\ContentValues::init()
                    ->put(\'idtrainz_cdp\', $id_cdp)
                    ->put(\'idtrainz_kuid\', $id_kuid);
                $db->insert(\'trainz_cdp_has_trainz_kuids\', $cv);
              }
            }

            // spojeni s downloadem
            $cv = classes\ContentValues::init()
                    ->put(\'iddownload\', %%row_id%%)
                    ->put(\'idtrainz_cdp\', $id_cdp);
            $db->insert(\'downloads_has_trainz_cdp\', $cv);

            // prilozeni verzi k cdp
            if (isset(%%values%%[\'version\'][$i])) {
              foreach (%%values%%[\'version\'][$i] as $version) {
                $cv = classes\ContentValues::init()
                      ->put(\'idtrainz_cdp\', $id_cdp)
                      ->put(\'idtrainz_version\', $version);
                $db->insert(\'trainz_cdp_has_trainz_versions\', $cv);
              }
            }
          }
        ',
      ))
    ->setEdit(array(
        'title' => isset($admin_uri['id']) ? 'Schválit objekt/mapu' : 'Upravit objekt/mapu',
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'back_link' => isset($admin_uri['id']) ? null : '%%weburl%%{$crate->getDownloadUrlBuildID(%%data%%[\'iddownload_category\'])}',
        'refresh_url' => isset($admin_uri['id']) ? $weburl_admin.'downloads/new/' : '%%weburl%%\'.$crate->getDownloadUrlBuildID(%%data%%[\'iddownload_category\']).\'',
        'form_raw' => true,
        'submit_button' => '{submit:;%%title%%|$|class|:|btn btn-small btn-primary btn-primary18 addeditbtn_dwn}',
        'success' => isset($admin_uri['id']) ? '<div class="mws-panel-body no-padding"><div class="mws-form-message success">Objekt/mapa byl schválen!</div></div>' : '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message info">%%success_title%%</div>
    </div>',
        'success_empty' => '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message info">%%success_empty_title%%</div>
    </div>',
        'failure' => '
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message warning">%%failure_title%%</div>
        <div class="mws-button-row"><a href="javascript:history.back()" class="btn btn-small btn-warning btn-warning16">Zpět na formulář</a>
      </div>
    </div>',
        'content' => isset($admin_uri['id']) ? '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%new/show/{$admin_uri[\'id\']}" class="btn btn-primary btn-primary5" title="Zpět na podrobnosti objektu/mapy">Zpět na podrobnosti objektu/mapy</a>
  </div>
  <div class="grid_8 mws-panel mws-panel-v2">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
{%%form_msg%%}
%%if_iserrors%%
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message error">
        Nastaly tyto chyby:
        <ul>
            %%loop_geterrors%%
          <li>{$value}</li>
            %%loop_end%%
        </ul>
      </div>
    </div>
%%if_end%%
  </div>
{%%form%%}' : '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
  <div class="grid_8 mws-panel mws-panel-v2">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
{%%form_msg%%}
%%if_iserrors%%
    <div class="mws-panel-body no-padding">
      <div class="mws-form-message error">
        Nastaly tyto chyby:
        <ul>
            %%loop_geterrors%%
          <li>{$value}</li>
            %%loop_end%%
        </ul>
      </div>
    </div>
%%if_end%%
  </div>
{%%form%%}
',
        'form_values' => array('cdp', 'version', 'kuid_cdp', 'kuid_cdp_plain'),
        'query_separator' => array('idlanguage' => array('name', 'description')),
        'query' => '$db->rawQuery(\'SELECT iddownload, idlanguage, iduser, author, iddownload_category, picture, polygons, confirmed, visible,
                                      languages_has_downloads.name, languages_has_downloads.description FROM %%table%%
                                    JOIN languages_has_downloads USING(iddownload)
                                    WHERE iddownload=?\', array(%%row_id%%))',
        'code_post_form' => '
          $dat = array();
          $dat[\'kuid_dependency\'] = implode(\',\', $db->rawQuery(\'SELECT idtrainz_kuid FROM trainz_kuids
                                                                    JOIN downloads_has_trainz_kuid USING(idtrainz_kuid)
                                                                    WHERE iddownload=?\', array(%%row_id%%))->getAllRows());

          $cdp = $db->rawQuery(\'SELECT idtrainz_cdp, name, path FROM trainz_cdp
                                JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                WHERE iddownload=?\', array(%%row_id%%))->getAll();

          $old_cdp = null;
          $state_old_id = null;
          if (isset($admin_uri[\'id\'])) {  // vybirani starych dat z predlohy
            $c = $db->query(\'notifications\', \'state_old_id\', \'idnotification=?\', array($admin_uri[\'id\']))->getFirst(); // vybez id z notifikace
            $state_old_id = $c->state_old_id;
            $old_cdp = $db->rawQuery(\'SELECT idtrainz_cdp, name, path FROM trainz_cdp
                                      JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                      WHERE iddownload=?\', array($c->state_old_id))->getAll();
          }

          %%form_var%%->setDefaults($dat)
              ->setItems(\'iduser\', $crate->getArrayListUsers(), \'Autor není v seznamu\')
              ->setAttribute(\'author\', \'disabled\', %%data%%[\'iduser\'] > 0)
              ->setItems(\'iddownload_category\', $crate->getArrayListDownloadsCategory())
              ->addRule(\'author\', function($value, $argv) { return $value || $_POST[$argv]; }, \'Musí být vyplněn autor, nebo vybrán z databáze autorů!\', \'iduser\')
              ->addRule(\'polygons\', \'pattern\', \'Polygony celkem musí být v číselném formátu!\', \'[0-9]*\')
              ->removeRule(\'picture\', \'filled\')
              ->addRule(\'kuid_dependency_plain\', function($value) {
                    $explode = array_filter(explode(PHP_EOL, $value));
                    $poc = 0;
                    foreach ($explode as $row) {
                      if (preg_match(\'/-?[0-9]+:[0-9]+(?::[0-9]+)?/\', $row, $match) && trim($row) == $match[0]) { $poc++; }
                    }
                    return count($explode) == $poc;
                  }, \'Kuid musí mít správný formát! Pouze čísla, dvojtečky a mínusy!\')
              ->addRule(\'kuid_cdp_plain\', function($value) {
                    $sumpoc = $poc = 0;
                    foreach ($value as $item) { // prochazeni pridanych polozek
                      $explode = array_filter(explode(PHP_EOL, $item));
                      $sumpoc += count($explode);
                      foreach ($explode as $row) {  // prochazeni samotnych zaznamu
                        if (preg_match(\'/-?[0-9]+:[0-9]+(?::[0-9]+)?/\', $row, $match) && trim($row) == $match[0]) { $poc++; }
                      }
                    }
                    return $sumpoc == $poc;
                  }, \'Kuid musí mít správný formát! Pouze čísla, dvojtečky a mínusy!\');
        ',
        'code_success' => '
          if (isset(%%values%%[\'picture\'][\'name\']) && %%values%%[\'picture\'][\'name\']) {
            // uprava obrazku
            $base_dest = classes\Core::makeFilesName(%%values%%[\'picture\']);  // priprava jmena
            classes\ImageMaker::cropResize(%%values%%[\'picture\'][\'tmp_name\'], \'img/download/mini/\' . $base_dest, $global_configure[\'download\'][\'miniWidth\'], $global_configure[\'download\'][\'miniHeight\']);

            $dest_full = \'img/download/full/\' . $base_dest;
            classes\ImageMaker::resize(%%values%%[\'picture\'][\'tmp_name\'], $dest_full, $global_configure[\'download\'][\'fullWidth\'], $global_configure[\'download\'][\'fullHeight\']);
            %%values%%[\'picture\'] = basename($dest_full);
          } else {
            %%values%%[\'picture\'] = %%data%%[\'picture\'];  // jinak navrat obrazku
          }
        ',
        'content_values' => '->put(\'iduser\', %%values%%[\'iduser\'] ?: null)
                            ->put(\'author\', %%values%%[\'iduser\'] ? null : trim(%%values%%[\'author\']))
                            ->put(\'rewrite\', ($state_old_id ?: %%row_id%%) . \'-\' . classes\Core::getRewrite(%%values%%[\'name\'][1]))  // doplneni rewrite
                            ->remove(\'name\')
                            ->remove(\'description\')
                            ->remove(\'kuid_dependency\')
                            ->remove(\'kuid_dependency_plain\')
                            ->remove(\'cdp\')
                            ->remove(\'version\')
                            ->remove(\'kuid_cdp\')
                            ->remove(\'kuid_cdp_plain\')
                            ->put(\'polygons\', %%values%%[\'polygons\'] ?: null)
                            ->putBool(\'confirmed\', isset($admin_uri[\'id\']) ?: %%data%%[\'confirmed\'])  // prenos potvrzeni
                            ->putBool(\'visible\', isset(%%values%%[\'visible\']))',
        'code_post_update' => '
          // kontrola duplicity jen prozi idlanguage=1, pokud je duplikatni vyskakuje
          $idlanguage = 1;
          if (isset($admin_uri[\'id\'])) {  // akceptovani duplikovane polozky
            $c = $db->query(\'notifications\', \'state_old_id\', \'idnotification=?\', array($admin_uri[\'id\']))->getFirst(); // vybez id z notifikace
            $dupl_pocet = $db->query(\'languages_has_downloads\', \'COUNT(idlanguage) pocet\', \'idlanguage=? AND name=? AND iddownload!=? AND iddownload!=?\', array($idlanguage, %%values%%[\'name\'][$idlanguage], %%row_id%%, $c->state_old_id))->getFirst()->pocet;
          } else {  // klasicka kontrola
            $dupl_pocet = $db->query(\'languages_has_downloads\', \'COUNT(idlanguage) pocet\', \'idlanguage=? AND name=? AND iddownload!=?\', array($idlanguage, %%values%%[\'name\'][$idlanguage], %%row_id%%))->getFirst()->pocet;
          }

          if ($dupl_pocet != 0) {
            %%rows%% = -1;
            $db->rollBack();
            break(1);
          }

          // uprava name a description
          foreach (%%values%%[\'name\'] as $i => $v) {  // vyblokovana kontrola duplicity
            //~ if ($db->query(\'languages_has_downloads\', \'COUNT(idlanguage) pocet\', \'idlanguage=? AND name=? AND iddownload!=?\', array($i, $v, %%row_id%%))->getFirst()->pocet == 0) {  // pokud neexistuje (0.pocet radku)
              $cv = classes\ContentValues::init()
                      ->put(\'name\', $v)
                      ->put(\'description\', %%values%%[\'description\'][$i]);
              $ret = $db->update(\'languages_has_downloads\', $cv, \'idlanguage=? AND iddownload=?\', array($i, %%row_id%%));
            //~ } else {
              //~ %%rows%% = -1;
              //~ $db->rollBack();
              //~ break(2);
            //~ }
            %%rows%% += $ret;
          }

          //vlozeni kuid zavislosti (nepovinne)
          $db->delete(\'downloads_has_trainz_kuid\', \'iddownload=?\', array(%%row_id%%));  // promaznuti vazeb, aby se mohly znovu vlozit  (0,N)
          if (isset(%%values%%[\'kuid_dependency\']) && %%values%%[\'kuid_dependency\']) {
            foreach (explode(\',\', %%values%%[\'kuid_dependency\']) as $v) {
              $cv = classes\ContentValues::init()
                      ->put(\'iddownload\', %%row_id%%)
                      ->put(\'idtrainz_kuid\', $v);
              $db->insert(\'downloads_has_trainz_kuid\', $cv);
              %%rows%%++;
            }
          }

          // vlozeni kuid zavislosti z plain textu (nepovinne), vyhazuje duplikatni, a prirazuje k downloads
          if (isset(%%values%%[\'kuid_dependency_plain\'])) {
            foreach (array_filter(explode(PHP_EOL, %%values%%[\'kuid_dependency_plain\'])) as $v) {
              $id_kuid = $crate->getKuidId(trim($v));
              if (!$id_kuid) {  // pokud neexistuje, tak ho vlozi
                $id_kuid = $db->insert(\'trainz_kuids\', classes\ContentValues::init(array(\'kuid\' => trim($v)))); // vlozi kuid
              }

              $cv = classes\ContentValues::init()
                    ->put(\'iddownload\', %%row_id%%)
                    ->put(\'idtrainz_kuid\', $id_kuid);
              $db->insert(\'downloads_has_trainz_kuid\', $cv);
              %%rows%%++;
            }
          }

          %%rows%% += $db->delete(\'downloads_has_trainz_cdp\', \'iddownload=?\', array(%%row_id%%)); // promazani download-cdp vazeb (1,N)

          // vlozeni cdp a verzi (projiti pole)
          foreach (%%values%%[\'cdp\'][\'name\'] as $i => $v) {
            $old_id_cdp = isset($cdp[$i]) ? $cdp[$i]->idtrainz_cdp : null; // ulozeni stareno cdp id
            if (isset($old_cdp[$i])) {  // pouziti stareho cdp id z predlohy objektu
              $old_id_cdp = $old_cdp[$i]->idtrainz_cdp;
            }

            if ($v) { // jen pokud je soubor prilozeny
              $dest = \'files/\' . classes\Core::makeFilesName(array(\'tmp_name\' => %%values%%[\'cdp\'][\'tmp_name\'][$i], \'name\' => $v));
              move_uploaded_file(%%values%%[\'cdp\'][\'tmp_name\'][$i], $dest); // nahrani do slozky

              // vlozeni noveho cdp
              $id_cdp = $db->insert(\'trainz_cdp\', classes\ContentValues::init(array(\'name\' => $v, \'path\' => basename($dest))));
            } else {
              if (!isset($cdp[$i])) {
                continue;  // prazdny se ignoruje
              }
              $id_cdp = $cdp[$i]->idtrainz_cdp; // jinak nacte zpet id
            }

            // vlozeni zavislosti cdp->kuid (nepovinne), multiple select
            $db->delete(\'trainz_cdp_has_trainz_kuids\', \'idtrainz_cdp=?\', array($id_cdp));  // promaznuti vazeb, aby se mohly znovu vlozit (0,N)
            if (isset(%%values%%[\'kuid_cdp\'][$i][0]) && %%values%%[\'kuid_cdp\'][$i][0]) {
              foreach (explode(\',\', %%values%%[\'kuid_cdp\'][$i][0]) as $v) {
                $cv = classes\ContentValues::init()
                      ->put(\'idtrainz_cdp\', $id_cdp)
                      ->put(\'idtrainz_kuid\', $v);
                $db->insert(\'trainz_cdp_has_trainz_kuids\', $cv);
                %%rows%%++;
              }
            }

            // uprava id cdp po prehrati souboru
            if ($old_id_cdp && $old_id_cdp != $id_cdp) {
              %%rows%% += $db->update(\'trainz_kuids\', classes\ContentValues::init()->put(\'idtrainz_cdp\', $id_cdp), \'idtrainz_cdp=?\', array($old_id_cdp));
            }

            // vlozeni zavislosti cdp->kuid (nepovinne), plain text
            if (isset(%%values%%[\'kuid_cdp_plain\'][$i])) {
              foreach (array_filter(explode(PHP_EOL, %%values%%[\'kuid_cdp_plain\'][$i])) as $v) {
                $id_kuid = $crate->getKuidId(trim($v));
                if (!$id_kuid) {  // pokud neexistuje, tak ho vlozi
                  $id_kuid = $db->insert(\'trainz_kuids\', classes\ContentValues::init()->put(\'kuid\', trim($v))->put(\'name\', %%values%%[\'name\'][1])->put(\'idtrainz_cdp\', $id_cdp)); // vlozi kuid
                }

                $cv = classes\ContentValues::init()
                    ->put(\'idtrainz_cdp\', $id_cdp)
                    ->put(\'idtrainz_kuid\', $id_kuid);
                $db->insert(\'trainz_cdp_has_trainz_kuids\', $cv);
                %%rows%%++;
              }
            }

            // spojeni s downloadem
            $cv = classes\ContentValues::init()
                    ->put(\'iddownload\', %%row_id%%)
                    ->put(\'idtrainz_cdp\', $id_cdp);
            $db->insert(\'downloads_has_trainz_cdp\', $cv);
            %%rows%%++;

            // prilozeni verzi k cdp
            $db->delete(\'trainz_cdp_has_trainz_versions\', \'idtrainz_cdp=?\', array($id_cdp));  // promaznuti vazeb, aby se mohly znovu vlozit (0,N)
            if (isset(%%values%%[\'version\'][$i])) {
              foreach (%%values%%[\'version\'][$i] as $version) {
                $cv = classes\ContentValues::init()
                      ->put(\'idtrainz_cdp\', $id_cdp)
                      ->put(\'idtrainz_version\', $version);
                $db->insert(\'trainz_cdp_has_trainz_versions\', $cv);
                %%rows%%++;
              }
            }
          }

          $notif_id = isset($admin_uri[\'id\']) ? $admin_uri[\'id\'] : null;
          if ($notif_id) {
            $c = $db->query(\'notifications\', \'from_id, state_id, state_old_id\', \'idnotification=?\', array($notif_id))->getFirst();
            if ($c->state_old_id) { // aktualizace
              $db->delete(\'downloads\', \'iddownload=?\', array($c->state_old_id)); // odmazani stareho

              // oprava pro zachovani ID objektu
              $db->execSQL(\'SET FOREIGN_KEY_CHECKS = 0\'); // vyrazeni FK
                //downloads
              $db->update(\'downloads\', classes\ContentValues::init()->put(\'iddownload\', $c->state_old_id), \'iddownload=?\', array(%%row_id%%));
                //downloads_has_trainz_kuid
              $db->update(\'downloads_has_trainz_kuid\', classes\ContentValues::init()->put(\'iddownload\', $c->state_old_id), \'iddownload=?\', array(%%row_id%%));
                //downloads_has_trainz_cdp
              $db->update(\'downloads_has_trainz_cdp\', classes\ContentValues::init()->put(\'iddownload\', $c->state_old_id), \'iddownload=?\', array(%%row_id%%));
                //languages_has_downloads
              $db->update(\'languages_has_downloads\', classes\ContentValues::init()->put(\'iddownload\', $c->state_old_id), \'iddownload=?\', array(%%row_id%%));
              $db->execSQL(\'SET FOREIGN_KEY_CHECKS = 1\'); // aktivace FK
            }
            // archivace
            $cv = classes\ContentValues::init()
                ->put(\'handled_id\', $user->getId())
                ->putDate(\'deleted\')
                ->put(\'state\', true);
            %%rows%% += $db->update(\'notifications\', $cv, \'idnotification=?\', array($notif_id)); // potvrzeni

            // zaslani emailu pri schvaleni
            classes\Emailer::factory(classes\Emailer::HTML)
                ->addTo($db->query(\'users\', \'email\', \'iduser=?\', array($c->from_id))->getFirst()->email)  // nacteni emailu
                ->setFrom(\'admin@trainz.cz\')
                ->setSubject(\'Žádost o přidání/aktualizaci objektu/mapy na Trainz.cz\')
                ->setMessageArgs(\'Dobrý den,<br /><br />Váš objekt/mapa byl schválen.<br /><br />Pro získání podrobnějších informací přejděte do autorské sekce Trainz.cz<br /><br />--<br />Trainz.cz\')
                ->send();
          }
        ',
      ))
    ->setUpdate(array(
        'enabled' => $user->isAllowed($acl_resource, 'del'),
        'url' => 'del',
        'title' => 'Deaktivovat objekt/mapu',
        'content_values' => '->putDate(\'deleted\')',
        'code_post_update' => '
          $iddownload_category = $db->query(\'downloads\', \'iddownload_category\', \'iddownload=?\', array(%%row_id%%))->getFirst()->iddownload_category;
        ',
        'refresh_url' => '%%weburl%%\'.$crate->getDownloadUrlBuildID($iddownload_category).\'',
      ));
{/code}

{compile="$sekce->render()"}
