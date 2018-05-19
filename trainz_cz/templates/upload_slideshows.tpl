<div class="obal_upload_slideshow">
  <div class="well well-sm div-validate">
{code}//<?
  $code = '
    <ul class="list-group">
      <li class="list-group-item">
        <div class="progress progress-striped active">
          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
            <i class="icon-publish"></i> Nahrát obrázek
          </div>
          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
            <i class="icon-fullscreen"></i> Upravit rozměry
          </div>
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
            <i class="icon-pencil"></i> Doplnit údaje
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        <div class="form-group">
          <label class="col-lg-2 control-label">Popis obrázku</label>
          <div class="col-lg-10">
            {text:description|$|maxlength|:|80|,|class|:|form-control required|@|filled|:|Musí být vyplněn popis obrázku!}
            <span class="help-block">Povinné pole. Jedná se o popis obrázku, který se bude zobrazovat na úvodní straně pod obrázkem.</span>
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        <p>Pokud se Vám zobrazil obrázek ve stejném stavu jak při úpravě rozměrů, tak obnovte stránku.</p>
        <p class="posledni-form-group">Nejedná se o chybu, ale mezipaměť Vašeho prohlížeče si pamatuje stav obrázku z minulého kroku.</p>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        {img:path;'.$weburl.'img/slideshow/|$|style|:|max-width: 100%;}
      </li>
    </ul>
    <div class="hide">
      {hidden:path}
    </div>
    <ul class="list-group">
      <li class="list-group-item">
        %%submit%%
      </li>
    </ul>';

$_geometry = array('width' => 0, 'height' => 0);
if ($crate->upload_uri['action'] == 'add2') { // exerni nacteni velikosti obrazku pri crop-u
  $img_url = base64_decode(urldecode($crate->upload_uri['id']));
  if (file_exists($img_url)) {  // kontrola pokud obrazek nezmizel (pri cronu)
    $_geometry = classes\ImageMaker::geometry($img_url);
  } else {
    classes\Core::setLocation($weburl.'upload/slideshows/add1');  // prime presmerovani
  }
}

$sekce = classes\Section::build($weburl.'upload/slideshows/', '$crate->upload_uri.action', '$crate->upload_uri.id');
$sekce
    ->setTable('slideshows', 'idslideshow')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'form-horizontal', 'autocomplete' => 'off'))
    ->setList(array(  //deleted IS NULL OR
        'query' => '$db->rawQuery(\'SELECT idslideshow, confirmed, visible, path, description, s0.added, edited, state_old_id
                                    FROM %%table%% s0
                                    LEFT JOIN notifications n0 ON (n0.state_id=idslideshow AND n0.deleted IS NULL AND n0.type=?)
                                    WHERE
                                      iduser=? AND
                                      idslideshow NOT IN (SELECT state_old_id FROM notifications WHERE state_old_id IS NOT NULL AND deleted IS NULL AND from_id=s0.iduser)
                                    ORDER BY visible DESC, confirmed DESC, added DESC\', array($crate::TYPE_SLIDESHOW, $upload_user->getId()))',
        'name' => '{$value->description}',
        'description' => '
        <table>
          <tr>
            <td>UID:</td>
            <td>#{%%id_row%%}</td>
          </tr>
          <tr>
            <td>Uveřejněno:</td>
            <td>{$core::getCzechDateTime($value->added)}</td>
          </tr>
          {if="$value->edited"}<tr><td>Aktualizováno:</td><td>{$core::getCzechDateTime($value->edited)}</td></tr>{/if}
          <tr>
            <td>Stav:</td>
            <td>{$value->confirmed ? \'Schváleno\' : \'Čeká na schválení\'} a {$value->visible ? \'zařazeno ve slideshow na úvodní straně\' : \'zatím nezařazeno ve slideshow na úvodní straně\'}</td>
          </tr>
          {$value->confirmed == 0 && $value->state_old_id ? \'<tr><td></td><td>Aktualizace byla odeslána a čeká na schválení!</td></tr>\' : null}
        </table>
        <img src="{$weburl}img/slideshow/{$value->path}" class="img-rounded slideshow_vypis_nahled" />',
        'content' => '
    <ul class="list-group">
      <li class="list-group-item">
        <h4>Screenshoty</h4>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        %%add_link%%
      </li>
    </ul>
%%loop_begin%%
    <ul class="list-group">
      <li class="panel-heading clearfix">%%name%%%%links%%</li>
      <li class="list-group-item clearfix">
%%description%%
      </li>
    </ul>
%%loop_empty%%
    <div class="alert alert-info">Žádný screenshot</div>
%%loop_end%%
',
      ))
    ->setSection(array( // 1/3
      'title' => 'Nahrát obrázek (krok 1/3)',
      'url' => 'add1',
      'submit_button' => '{submit:;Nahrát obrázek|$|class|:|btn btn-primary}',
      'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">%%title%%</h4>
    <a href="%%back_link%%" class="btn btn-primary btn-xs pull-right" title="Zpět">Zpět</a>
  </li>
</ul>
%%if_iserrors%%
<div class="alert alert-danger">
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
',
      'form' => '
    <ul class="list-group">
      <li class="list-group-item">
        <div class="progress progress-striped active">
          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
            <i class="icon-publish"></i> Nahrát obrázek
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        <div class="form-group posledni-form-group">
          <label for="inputObrazek" class="col-lg-2 control-label">Obrázek</label>
          <div class="col-lg-10">
            {file:obrazek|$|id|:|inputObrazek|,|class|:|filestyle|,|data-buttonText|:|Vybrat soubor|,|data-classButton|:|btn btn-primary|,|data-classInput|:|form-control btn-file|@|image|:|Musí být vložen pouze obrázek!|,|filled|:|Obrázek je povinný!|,|maxfilesize|:|Obrázek nesmí překročit velikost 1,5 MB!|:|1572864}
            <span class="help-block">Rozměry obrázku musí být minimálně <strong>'.$global_configure['home']['slideshowWidth'].'x'.$global_configure['home']['slideshowHeight'].'</strong> pixelů!</span>
            <span class="help-block">Obrázek nesmí překročit velikost <strong>1,5</strong> MB!</span>
            <span class="help-block">Povinné pole!</span>
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        %%submit%%
      </li>
    </ul>',
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
            %%form_msg%% = \'<div class="alert alert-info">Byly překročeny rozměry!<ul><li>Obrázek bude upraven!</li></ul></div>\';
            classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add2/\'.urlencode(base64_encode($dest)));
          }
        } else
        if ($_geometry[\'width\'] == $global_configure[\'home\'][\'slideshowWidth\'] &&
            $_geometry[\'height\'] == $global_configure[\'home\'][\'slideshowHeight\']) {
          // presne rozmery, preskoceni crop a rovnou pridavani

          $dest = \'img/slideshow/\' . classes\Core::makeFilesName(%%values%%[\'obrazek\']);
          if (move_uploaded_file(%%values%%[\'obrazek\'][\'tmp_name\'], $dest)) {
            %%form_msg%% = \'<div class="alert alert-info">Rozměry jsou v pořádku!<ul><li>Bude přeskočen druhý krok!</li></ul></div>\';
            classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add3/\'.urlencode(base64_encode(basename($dest))));
          }
        } else {
          // nebyli dodrzeny rozmery
          %%form_msg%% = \'<div class="alert alert-danger">Nastala chyba!<ul><li>Nebyly dodrženy rozměry obrázku!</li></ul></div>\';
          classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add1\');
        }
        ',
      ))
    ->setSection(array( // 2/3
      'title' => 'Upravit rozměry (krok 2/3)',
      'url' => 'add2',
      'submit_button' => '{submit:;Upravit rozměry|$|class|:|btn btn-primary}',
      'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">%%title%%</h4>
    <a href="%%back_link%%" class="btn btn-primary btn-xs pull-right" title="Zpět">Zpět</a>
  </li>
</ul>
%%if_iserrors%%
<div class="alert alert-danger">
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
',
      'form' => '
    <ul class="list-group">
      <li class="list-group-item">
        <div class="progress progress-striped active">
          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
            <i class="icon-publish"></i> Nahrát obrázek
          </div>
          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
            <i class="icon-fullscreen"></i> Upravit rozměry
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        <p>Váš obrázek má rozměry: <strong>'.$_geometry['width'].'x'.$_geometry['height'].'</strong> pixelů. Stránky vyžadují, aby obrázek měl velikost <strong>'.$global_configure['home']['slideshowWidth'].'x'.$global_configure['home']['slideshowHeight'].'</strong> pixelů.</p>
        <p class="posledni-form-group">Přesuňte ohraničení na místo, kde chcete, aby se provedl výřez na požadovanou velikost.</p>
      </li>
    </ul>
    <ul class="list-group clearfix" style="position: relative; top: 0; left: -40%; width: '.($_geometry['width'] + 30).'px; height: '.($_geometry['height'] + 20).'px;">
      <li class="list-group-item">
        <div id="upload-crop-parent">
          {img:obrazek;'.$weburl.'|$|class|:|upload-crop-target|,|style|:|width: '.$_geometry['width'].'px; height: '.$_geometry['height'].'px;}
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        <div class="form-group">
          <label class="col-lg-3 control-label">Pozice výřezu zleva</label>
          <div class="col-lg-9">
            {text:crop_x1;0|$|readonly|,|id|:|crop_x1|,|class|:|form-control defined-150}&nbsp;px
            <span class="help-block">Tato hodnota slouží pouze pro informaci!</span>
          </div>
        </div>
        <div class="form-group posledni-form-group">
          <label class="col-lg-3 control-label">Pozice výřezu shora</label>
          <div class="col-lg-9">
            {text:crop_y1;0|$|readonly|,|id|:|crop_y1|,|class|:|form-control defined-150}&nbsp;px
            <span class="help-block">Tato hodnota slouží pouze pro informaci!</span>
          </div>
        </div>
      </li>
    </ul>
    <div class="hide">
      {text:crop_x2;'.$global_configure['home']['slideshowWidth'].'|$|readonly|,|id|:|crop_x2}
      {text:crop_y2;'.$global_configure['home']['slideshowHeight'].'|$|readonly|,|id|:|crop_y2}
      {hidden:path}
    </div>
    <ul class="list-group">
      <li class="list-group-item">
        %%submit%%
      </li>
    </ul>',
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
            %%form_msg%% = \'<div class="alert alert-info">Byl nastaven výřez obrázku!</div>\';

            header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

            classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add3/\'.urlencode(base64_encode(basename(%%values%%[\'path\']))));  // predani uz jen nazvu
          } else {
            %%form_msg%% = \'<div class="alert alert-danger">Nastala chyba!<ul><li>Nebyly dodrženy rozměry obrázku!</li></ul></div>\';
            classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add1/\'); // prehozeni na upload
          }
        } else {
          // pokud je chyba cropu (nemelo by normalne nastat)
          %%form_msg%% = \'<div class="alert alert-danger">Nastala chyba na Vaší straně!<ul><li>Nepoužíváte formulář korektně!</li><li>Výřez obrázku lze nastavit pouze jednou!</li></ul></div>\';
          classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add1/\'); // prehozeni na upload
        }
      ',
      ))
    ->setAdd(array( // 3/3
        'title' => 'Doplnit údaje (krok 3/3)',
        'url' => 'add3',
        'submit_button' => '{submit:;Přidat obrázek|$|class|:|btn btn-primary}',
        'success' => '<div class="alert alert-success">Formulář byl odeslán!</div>',
        'link' => '<a href="%%weburl%%add1" class="btn btn-success">Přidat obrázek</a>',
        'submit_blocker' => false,
        'submit_security' => true,
        'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">%%title%%</h4>
    <a href="%%back_link%%" class="btn btn-primary btn-xs pull-right" title="Zpět">Zpět</a>
  </li>
</ul>
%%if_iserrors%%
<div class="alert alert-danger">
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
',
        'code_post_form' => '
          %%data%%[\'path\'] = base64_decode(urldecode(%%action_id%%));
          %%form_var%%->setDefaults(%%data%%);
        ',
        'content_values' => '->put(\'iduser\', $upload_user->getId())
                            ->putDate(\'added\')',
        'code_post_insert' => '
          if (classes\ImageMaker::geometry(\'img/slideshow/\' . %%data%%[\'path\']) === array(\'width\' => intval($global_configure[\'home\'][\'slideshowWidth\']), \'height\' => intval($global_configure[\'home\'][\'slideshowHeight\']))) {
            // zaslani nove
            $crate->addNotification($upload_user->getId(), null, $crate::TYPE_SLIDESHOW, %%row_id%%, null, \'add-screenshot\', \'Byl odeslán screenshot s popisem: <strong>\'.%%values%%[\'description\'].\'</strong>\');
          } else {
            // pokud je chyba cropu (nemelo by normalne nastat)
            %%form_msg%% = \'<div class="alert alert-danger">Nastala chyba na Vaší straně!<ul><li>Nepoužíváte formulář korektně!</li><li>Výřez obrázku lze nastavit pouze jednou!</li></ul></div>\';
            classes\Core::setRefresh(%%refresh_time%%, \'%%back_link%%add1\');
          }
        ',
      ))
    ->setAdd(array( // duplikace
        'title' => 'Aktualizovat popis obrázku',
        'url' => 'update',
        'if_link' => '&& $value->confirmed',  // povoleni aktualizace jen pokud je potvrzeny
        'link' => '<a href="%%url%%/{$value->idslideshow}" class="btn btn-primary btn-xs pull-right">%%title%%</a>',
        'submit_blocker' => false,
        'submit_security' => true,
        'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">%%title%%</h4>
    <a href="%%back_link%%" class="btn btn-primary btn-xs pull-right" title="Zpět">Zpět</a>
  </li>
</ul>
%%if_iserrors%%
<div class="alert alert-danger">
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
',
        'success' => '<div class="alert alert-info">Aktualizace byla odeslána!</div>',
        'global_link' => false,
        'code_post_form' => '
          $ss = $db->query(\'slideshows\', \'path, description, added\', \'idslideshow=?\', array(%%action_id%%))->getFirst();
          if ($ss) {  // nacteni hodnot do formulare
            $ss->description = htmlspecialchars($ss->description);  // uprava "
            %%form_var%%->setDefaults($ss);
          }
        ',
        'content_values' => '->put(\'iduser\', $upload_user->getId())
                            ->put(\'added\', $ss->added)
                            ->putDate(\'edited\')',
        'code_post_insert' => '
          // deaktivace stare polozky
          $db->update(\'%%table%%\', classes\ContentValues::init(array(\'confirmed\' => false)), \'%%table_id%%=?\', array(%%action_id%%));

          // zaslani aktualizace
          $crate->addNotification($upload_user->getId(), null, $crate::TYPE_SLIDESHOW, %%row_id%%, %%action_id%%, \'edit-screenshot\', \'Byl aktualizován popis pro screenshot z: <strong>\'.$ss->description.\'</strong> na:  <strong>\'.%%values%%[\'description\'].\'</strong>\');
        ',
        'success_title' => 'Položka upravena',
      ))
    ->setDel(array(
        'title' => 'Smazat obrázek',
        'if_link' => '&& $value->confirmed',  // povoleni aktualizace jen pokud je potvrzeny
        'success' => '<div class="alert alert-info">Obrázek byl smazán!</div>',
        'link' => '<a href="%%url%%" class="btn btn-xs pull-right %%color%%" onclick="return confirm(\'%%question%%\')" style="margin-right: 10px;">%%title%%</a>',
        'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">%%title%%</h4>
  </li>
</ul>
{%%form_msg%%}
',
      ));
{/code}
{compile="$sekce->render()"}
  </div>
</div>