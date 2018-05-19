{code}//<?

$code = '
<div class="wizard-nav wizard-nav-horizontal">
  <ul>
    <li>
      <span><i class="icol-application-get"></i> Nahrát obrázek</span>
    </li>
    <li>
      <span><i class="icol-shape-handles"></i> Upravit rozměry</span>
    </li>
    <li class="current">
      <span><i class="icol-pencil"></i> Doplnit údaje</span>
    </li>
  </ul>
</div>
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label" for="autor_su_lb">Autor (databáze autorů)</label>
    <div class="mws-form-item">
      <div class="medium">
        {select:iduser|$|class|:|mws-select2|,|id|:|autor_su_lb|,|onchange|:|document.getElementById(\\\'author_elem\\\').disabled=this.selectedIndex}
      </div>
      <span class="error">Vyberte autora z databáze. Pokud není autor uveden v databázi, tak ho zadejte ručně!</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="author_elem">Autor (zadat ručně)</label>
    <div class="mws-form-item">
      <div class="medium">
        {text:author|$|id|:|author_elem|,|class|:|large|,|maxlength|:|45}
      </div>
      <span class="error">Zadejte ručně autora pokud není uveden v databázi autorů.</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="description_elem">Popis obrázku</label>
    <div class="mws-form-item">
      <div class="medium">
        {text:description|$|maxlength|:|80|,|id|:|description_elem|,|class|:|large|@|filled|:|Musí být vyplněn popis obrázku!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label" for="visible_screen_lb">Zobrazit ve slideshow</label>
    <div class="mws-form-item">
      <div class="small">
        {checkbox:visible|$|class|:|ibutton|,|id|:|visible_screen_lb|,|data-label-on|:|ANO|,|data-label-off|:|NE&nbsp;}
      </div>
      <span class="error">Určuje, zda bude obrázek zařazen do slideshow na úvodní straně!</span>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label">Výsledný obrázek</label>
    <div class="mws-form-item">
        {img:path;'.$weburl.'img/slideshow/}
    </div>
  </div>
</div>
{hidden:path}
<div class="mws-button-row">
  %%submit%%
</div>
';

$_geometry = array('width' => 0, 'height' => 0);
if ($admin_uri['subblock'] == 'add2') { // exerni nacteni velikosti obrazku pri crop-u
  $img_url = base64_decode(urldecode($admin_uri['subaction']));
  if (file_exists($img_url)) {  // kontrola pokud obrazek nezmizel (pri cronu)
    $_geometry = classes\ImageMaker::geometry($img_url);
  } else {
    classes\Core::setLocation($weburl_admin.'slideshows/add1');  // prime presmerovani
  }
}

// pager
$p = classes\Paginator::init($db->query('slideshows', 'COUNT(idslideshow) pocet', 'confirmed=1')->getFirst()->pocet, $global_configure['slideshow']['polozekNaStranku'])
        ->setPage(isset($admin_uri['subblock']) ? ($admin_uri['subblock']?:1) : 1);

$sekce = classes\Section::build($weburl_admin.'slideshows/', '$admin_uri.subblock', '$admin_uri.subaction');
$sekce
    ->setTable('slideshows', 'idslideshow')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'))
    ->setList(array(
        'url' => isset($admin_uri['subblock']) ? $admin_uri['subblock'] : '',
        'enabled' => $user->isAllowed($acl_resource, 'list'),
        'query' => '$db->rawQuery(\'SELECT idslideshow, sl.iduser, users.login, users.alias, sl.author, sl.visible, sl.path, sl.description, sl.added, sl.edited
                                    FROM %%table%% sl
                                    LEFT JOIN users USING(iduser)
                                    WHERE sl.confirmed=1
                                    ORDER BY visible DESC, idslideshow DESC '.$p->getLimit().'\')',
        'name' => '{$value->description}',
        'description' => '
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
      ))
    ->setSection(array( // 1/3
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'title' => 'Nahrát obrázek (krok 1/3)',
        'url' => 'add1',
        'submit_button' => '{submit:;Nahrát obrázek|$|class|:|btn btn-small btn-primary btn-primary17}',
        'form' => '
<div class="wizard-nav wizard-nav-horizontal">
  <ul>
    <li class="current">
      <span><i class="icol-application-get"></i> Nahrát obrázek</span>
    </li>
    <li>
      <span><i class="icol-shape-handles"></i> Upravit rozměry</span>
    </li>
    <li>
      <span><i class="icol-pencil"></i> Doplnit údaje</span>
    </li>
  </ul>
</div>
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label" for="obrazek_lb">Obrázek</label>
    <div class="mws-form-item">
      <div class="medium">
        {file:obrazek|$|id|:|obrazek_lb|@|image|:|Musí být vložen pouze obrázek!|,|filled|:|Obrázek je povinný!|,|maxfilesize|:|Obrázek nesmí překročit velikost 1,5 MB!|:|1572864}
      </div>
      <span class="error">Rozměry obrázku musí být minimálně <strong>'.$global_configure['home']['slideshowWidth'].'x'.$global_configure['home']['slideshowHeight'].'</strong> pixelů!</span>
      <span class="error">Obrázek nesmí překročit velikost <strong>1,5</strong> MB!</span>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
</div>
<div class="mws-button-row">
  %%submit%%
</div>',
        'code_success' => '
          $_geometry = classes\ImageMaker::geometry(%%values%%[\'obrazek\'][\'tmp_name\']);

          if (($_geometry[\'width\'] > $global_configure[\'home\'][\'slideshowWidth\'] &&
              $_geometry[\'height\'] > $global_configure[\'home\'][\'slideshowHeight\']) ||

              ($_geometry[\'width\'] >= $global_configure[\'home\'][\'slideshowWidth\'] &&
              $_geometry[\'height\'] > $global_configure[\'home\'][\'slideshowHeight\']) ||

              ($_geometry[\'width\'] > $global_configure[\'home\'][\'slideshowWidth\'] &&
              $_geometry[\'height\'] >= $global_configure[\'home\'][\'slideshowHeight\'])) {
            // rozmery dodrzeny, pokracovani na crop

            $dest = \'img/slideshow/\' . classes\Core::makeFilesName(%%values%%[\'obrazek\']);
            if (move_uploaded_file(%%values%%[\'obrazek\'][\'tmp_name\'], $dest)) {
              // samotny upload
              %%form_msg%% = \'<div class="mws-form-message info">Byly překročeny rozměry!<ul><li>Obrázek bude upraven!</li></ul></div>\';
              classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add2/\'.urlencode(base64_encode($dest)));
            }
          } else
          if ($_geometry[\'width\'] == $global_configure[\'home\'][\'slideshowWidth\'] &&
              $_geometry[\'height\'] == $global_configure[\'home\'][\'slideshowHeight\']) {
            // presne rozmery, preskoceni crop a rovnou pridavani

            $dest = \'img/slideshow/\' . classes\Core::makeFilesName(%%values%%[\'obrazek\']);
            if (move_uploaded_file(%%values%%[\'obrazek\'][\'tmp_name\'], $dest)) {
              %%form_msg%% = \'<div class="mws-form-message success">Rozměry jsou v pořádku!<ul><li>Bude přeskočen druhý krok!</li></ul></div>\';
              classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add3/\'.urlencode(base64_encode(basename($dest))));
            }
          } else {
            // nebyli dodrzeny rozmery
            %%form_msg%% = \'<div class="mws-form-message error">Nastala chyba!<ul><li>Nebyly dodrženy rozměry obrázku!</li></ul></div>\';
            classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add1\');
          }
        ',
      ))
    ->setSection(array( // 2/3
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'title' => 'Upravit rozměry (krok 2/3)',
        'url' => 'add2',
        'submit_button' => '{submit:;Upravit rozměry|$|class|:|btn btn-small btn-primary btn-primary17}',
        'form' => '
<div class="wizard-nav wizard-nav-horizontal">
  <ul>
    <li>
      <span><i class="icol-application-get"></i> Nahrát obrázek</span>
    </li>
    <li class="current">
      <span><i class="icol-shape-handles"></i> Upravit rozměry</span>
    </li>
    <li>
      <span><i class="icol-pencil"></i> Doplnit údaje</span>
    </li>
  </ul>
</div>
<div class="mws-form-row">
  <label class="mws-form-label">Váš obrázek má rozměry: <strong>'.$_geometry['width'].'x'.$_geometry['height'].'</strong> pixelů. Stránky vyžadují, aby obrázek měl velikost <strong>'.$global_configure['home']['slideshowWidth'].'x'.$global_configure['home']['slideshowHeight'].'</strong> pixelů.<br />Přesuňte ohraničení na místo, kde chcete, aby se provedl výřez na požadovanou velikost.</label>
  <div id="mws-crop-parent" class="mws-form-item">
    {img:obrazek;'.$weburl.'|$|class|:|mws-crop-target|,|style|:|width: '.$_geometry['width'].'px; height: '.$_geometry['height'].'px; max-width: none;}
  </div>
</div>
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label">Pozice výřezu zleva</label>
    <div class="mws-form-item">
      <div class="small">
        {text:crop_x1;0|$|readonly|,|id|:|crop_x1}&nbsp;px
      </div>
    </div>
  </div>
  <div class="mws-form-row">
    <label class="mws-form-label">Pozice výřezu shora</label>
    <div class="mws-form-item">
      <div class="small">
        {text:crop_y1;0|$|readonly|,|id|:|crop_y1}&nbsp;px
      </div>
    </div>
  </div>
  <div class="mws-form-row hide">
    <div class="mws-form-item">
      <div class="small">
        {text:crop_x2;'.$global_configure['home']['slideshowWidth'].'|$|readonly|,|id|:|crop_x2}
      </div>
    </div>
  </div>
  <div class="mws-form-row hide">
    <div class="mws-form-item">
      <div class="small">
        {text:crop_y2;'.$global_configure['home']['slideshowHeight'].'|$|readonly|,|id|:|crop_y2}
      </div>
    </div>
  </div>
</div>
{hidden:path}
<div class="mws-button-row">
  %%submit%%
</div>',
        'code_pre_form' => '
          $img_url = base64_decode(urldecode(%%action_id%%));
          %%data%%[\'obrazek\'] = $img_url;
          %%data%%[\'path\'] = $img_url;
        ',
        'code_success' => '
          if ($global_configure[\'home\'][\'slideshowWidth\'] == (%%values%%[\'crop_x2\'] - %%values%%[\'crop_x1\']) &&
              $global_configure[\'home\'][\'slideshowHeight\'] == (%%values%%[\'crop_y2\'] - %%values%%[\'crop_y1\'])) {

            // bezpecnostni kontrola crop velikosti
            classes\ImageMaker::crop(%%values%%[\'path\'], %%values%%[\'path\'], $global_configure[\'home\'][\'slideshowWidth\'], $global_configure[\'home\'][\'slideshowHeight\'], %%values%%[\'crop_x1\'], %%values%%[\'crop_y1\']);

            if (classes\ImageMaker::geometry(%%values%%[\'path\']) === array(\'width\' => intval($global_configure[\'home\'][\'slideshowWidth\']), \'height\' => intval($global_configure[\'home\'][\'slideshowHeight\']))) {
              %%form_msg%% = \'<div class="mws-form-message success">Byl nastaven výřez obrázku!</div>\';
              classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add3/\'.urlencode(base64_encode(basename(%%values%%[\'path\']))));  // predani uz jen nazvu
            } else {
              %%form_msg%% = \'<div class="mws-form-message error">Nastala chyba!<ul><li>Nebyly dodrženy rozměry obrázku!</li></ul></div>\';
              classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add1/\'); // prehozeni na upload
            }
          } else {
            // pokud je chyba cropu (nemelo by normalne nastat)
            %%form_msg%% = \'<div class="mws-form-message error">Nastala chyba na Vaší straně!<ul><li>Nepoužíváte formulář korektně!</li><li>Výřez obrázku lze nastavit pouze jednou!</li></ul></div>\';
            classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add1/\'); // prehozeni na upload
          }
        ',
      ))
    ->setAdd(array( // 3/3
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'title' => 'Doplnit údaje (krok 3/3)',
        'url' => 'add3',
        'submit_security' => true,
        'submit_button' => '{submit:;Přidat obrázek|$|class|:|btn btn-small btn-success btn-success45}',
        'link' => '<a href="%%weburl%%add1" class="btn btn-success btn-success45">Přidat obrázek</a>',
        'code_post_form' => '
          %%data%%[\'path\'] = base64_decode(urldecode(%%action_id%%));
          %%form_var%%->setDefaults(%%data%%)
              ->setItems(\'iduser\', $crate->getArrayListUsers(), \'Autor není v seznamu\')
              ->addRule(\'author\', function($value, $argv) { return $value || $_POST[$argv]; }, \'Musí být vyplněn autor, nebo vybrán z databáze autorů!\', \'iduser\');
        ',
        'content_values' => '->put(\'iduser\', %%values%%[\'iduser\'] ?: null)
                            ->put(\'author\', %%values%%[\'iduser\'] ? null : %%values%%[\'author\'])
                            ->putBool(\'confirmed\', true)
                            ->putBool(\'visible\', isset(%%values%%[\'visible\']))
                            ->putDate(\'added\')',
      ))
    ->setEdit(array(
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'title' => isset($admin_uri['id']) ? 'Schválit screenshot' : 'Upravit obrázek',
        'refresh_url' => isset($admin_uri['id']) ? $weburl_admin.'slideshows/new/' : null,
        'success' => isset($admin_uri['id']) ? '<div class="mws-form-message success">Screenshot byl schválen!</div>' : null,
        'content' => isset($admin_uri['id']) ? '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%new/show/{$admin_uri[\'id\']}" class="btn btn-primary btn-primary5" title="Zpět na podrobnosti screenshotu">Zpět na podrobnosti screenshotu</a>
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
  </div>' : null,
        'code_post_form' => '
          %%form_var%%
              ->setItems(\'iduser\', $crate->getArrayListUsers(), \'Autor není v seznamu\')
              ->setAttribute(\'author\', \'disabled\', %%data%%->iduser > 0)
              ->addRule(\'author\', function($value, $argv) { return $value || $_POST[$argv]; }, \'Musí být vyplněn autor, nebo vybrán z databáze autorů!\', \'iduser\');
        ',
        'content_values' => '->put(\'iduser\', %%values%%[\'iduser\'] ?: null)
                            ->put(\'author\', %%values%%[\'iduser\'] ? null : %%values%%[\'author\'])
                            ->putBool(\'confirmed\', isset($admin_uri[\'id\']) ?: %%data%%->confirmed)  // prenos potvrzeni
                            ->putBool(\'visible\', isset(%%values%%[\'visible\']))',
        'code_post_update' => '
          $notif_id = isset($admin_uri[\'id\']) ? $admin_uri[\'id\'] : null;
          if ($notif_id) {
            $c = $db->query(\'notifications\', \'from_id, state_id, state_old_id\', \'idnotification=?\', array($notif_id))->getFirst();
            if ($c->state_old_id) { // aktualizace
              $db->delete(\'slideshows\', \'idslideshow=?\', array($c->state_old_id)); // odmazani stareho
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
                ->setSubject(\'Žádost o přidání/aktualizaci screenshotu na Trainz.cz\')
                ->setMessageArgs(\'Dobrý den,<br /><br />Váš screenshot byl schválen.<br /><br />Pro získání podrobnějších informací přejděte do autorské sekce Trainz.cz<br /><br />--<br />Trainz.cz\')
                ->send();
          }
        ',
      ))
    ->setDel(array(
        'enabled' => $user->isAllowed($acl_resource, 'del'),
        'title' => 'Smazat obrázek',
      ));
{/code}

{compile="$sekce->render()"}

{if="$p->isVisible()"}
<div class="grid_8 mws-panel">
  <div class="mws-panel-header mws-panel-header-normal">
    <div class="dataTables_wrapper">
      <div class="dataTables_paginate paging_full_numbers clearfix">
  {if="$p->isPrev()"}
        <a href="{$weburl_admin}slideshows/{$p->getPrevPage()}" class="first paginate_button paginate_button_active" title="Předchozí">&laquo;</a>
  {else}
        <a class="first paginate_button paginate_button_disabled" title="Předchozí">&laquo;</a>
  {/if}
        <span>
  {loop="$p->render(classes\Paginator::TYPE3, array('range' => $global_configure['slideshow']['rozsahStrankovani']))"}
    {if="$p->getPage() == $value"}
          <a class="paginate_active" title="Strana {$value}">{$value}</a>
    {else}
          <a href="{$weburl_admin}slideshows/{$value}" class="paginate_button" title="Strana {$value}">{$value}</a>
    {/if}
  {/loop}
        </span>
  {if="$p->isNext()"}
        <a href="{$weburl_admin}slideshows/{$p->getNextPage()}" class="last paginate_button paginate_button_active" title="Další">&raquo;</a>
  {else}
        <a class="last paginate_button paginate_button_disabled" title="Další">&raquo;</a>
  {/if}
      </div>
    </div>
  </div>
</div>
{/if}