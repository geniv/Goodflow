<div class="obal_upload_download">
  <div class="well well-sm">
{code}//<?
$code = '
    <ul class="list-group">
      <li class="list-group-item">
        <div class="form-group">
          <label for="inputNazev" class="col-lg-2 control-label">Název</label>
          <div class="col-lg-10">
            {text:name[1]|$|maxlength|:|100|,|placeholder|:|Název|,|class|:|form-control ajax_downloads_name|,|id|:|inputNazev|@|filled|:|Název musí být vyplněn!}{hidden:name[2];en|$|class|:|ajax_downloads_name}{hidden:name[3];de|$|class|:|ajax_downloads_name}
            <span class="help-block pull-left">Povinné pole. Název objektu / mapy.</span>
            <span class="help-block result_ajax_name1 pull-right"></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Popis</label>
          <div class="col-lg-10">
            {textarea:description[1]|$|placeholder|:|Popis|,|class|:|tiny-upload|,|cols|:|100|,|rows|:|12|@|filled|:|Popis musí být vyplněn!}{textarea:description[2];en|$|class|:|hide}{textarea:description[3];de|$|class|:|hide}
            <span class="help-block">Povinné pole. Popis objektu / mapy.</span>
          </div>
        </div>
        <div class="form-group posledni-form-group">
          <label class="col-lg-2 control-label">Kategorie</label>
          <div class="col-lg-10">
            {select:iddownload_category|$|class|:|upload-select2|@|~equal|:|Musí být vybrána kategorie!|:|0}
            <span class="help-block">Zařaďte Váš objekt / mapu do příslušné kategorie.</span>
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        <a href="#" class="add_cdp btn btn-primary btn-sm pridat_oddil"><i class="icon-plus-sign"></i> Přidat další oddíl</a>
      </li>
    </ul>
    <div class="download_cdp"></div>
    <ul class="list-group">
      <li class="list-group-item">
        <div class="form-group">
          <label class="col-lg-2 control-label">Kuid závislosti:<br /><span class="text-center">(databáze)</span></label>
          <div class="col-lg-10">
             {hidden:kuid_dependency|$|class|:|upload-kuid-dependency-select2}
            <span class="help-block">Zde můžete kliknutím do pole vybrat neomezený počet kuidů z databáze.<br />Tyto kuidy budou označeny jako "Doporučené KUID součásti".<br />Doporučené KUID součásti jsou kuidy, které jsou potřebné pro správnou funkci Vašeho objektu.</span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Kuid závislosti:<br /><span class="text-center">(přidat nové)</span></label>
          <div class="col-lg-10 clearfix">
            {textarea:kuid_dependency_plain|$|class|:|kuid_input_plain defined-265 autosize form-control|,|id|:|kuid_zavs_lb_nw|,|placeholder|:|xxxxx:yyyyy(:zzz)|,|onkeyup|:|javascript:validateKuid(this.value, \\\'.ext_kuid_zav\\\')}<div class="ext_kuid_zav custom-label-2 defined-265">Formát: &lt;kuid(2):(-)xxxxx:yyyyy(:zzz)&gt;</div>
            <span class="help-block clrb">Zde můžete zadat neomezený počet kuidů.<br />Tyto kuidy budou označeny jako "Doporučené KUID součásti".<br />Doporučené KUID součásti jsou kuidy, které jsou potřebné pro správnou funkci Vašeho objektu.<br />Každý nový kuid musí být na novém řádku!<br />Prázdné řádky se vyhodnocují jako špatné zadání!<br />Kuid musí mít správný formát! Pouze čísla, dvojtečky a mínusy!<ul><li><em>xxxxx:yyyyy</em> pro <em>&lt;kuid:xxxxx:yyyyy&gt;</em></li><li><em>xxxxx:yyyyy:zzz</em> pro <em>&lt;kuid2:xxxxx:yyyyy:zzz&gt;</em></li></ul></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Náhled</label>
          <div class="col-lg-10 clearfix upload_form_img">
            {file:picture|$|id|:|inputNahled|,|class|:|filestyle|,|data-buttonText|:|Vybrat soubor|,|data-classButton|:|btn btn-primary|,|data-classInput|:|form-control btn-file|@|image|:|V náhledu musí být vložen pouze obrázek!|,|filled|:|Náhled je povinný!|,|maxfilesize|:|Obrázek nesmí překročit velikost 1,5 MB!|:|1572864}
            <span class="help-block">Povinné pole. Rozměry obrázku musí být minimálně <strong>'.$global_configure['download']['miniWidth'].'x'.$global_configure['download']['miniHeight'].'</strong> pixelů!<br />Obrázek nesmí překročit velikost <strong>1,5</strong> MB! Podporovány jsou obrázkové formáty (.jpg, .png, apod.)<br />Doporučujeme nahrávat obrázky v poměru 4:3</span>
            {if="$uri.action == \\\'update\\\'"}
            <span class="help-block">Aktuání náhled:</span>
            {link:picture;'.$weburl.'img/download/full/|$|class|:|upload-img-fancy thumbnail pull-left|,|title|:|Náhled}
              {img:picture;'.$weburl.'img/download/mini/|$|alt|:|Náhled|,|class|:|img-rounded}
            {/link}
            {/if}
          </div>
        </div>
        <div class="form-group posledni-form-group">
          <label for="polygony_elem" class="col-lg-2 control-label">Počet polygonů:<br /><span class="text-center">(celkem)</span></label>
          <div class="col-lg-10">
            {text:polygons|$|id|:|polygony_elem|,|class|:|form-control defined-150 jenom-cisla|,|maxlength|:|20}
            <span class="help-block">Nepovinné pole. Počet polygonů musí mít správný formát! Pouze čísla! Číslo je pouze orientační.<br />Pokud máte více (polygonově stejných) objektů v jednom CDP, tak zadejte počet polygonů jednoho objektu.<br />Pokud objekt pracuje pouze s dalšími objekty tak zadejte celkový počet polygonů včetně těch se kterými pracuje.</span>
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        %%submit%%
        <span class="help-block">Pokud není tlačítko aktivní, tak formulář, který chcete odeslat je chybný!</span>
      </li>
    </ul>';

$sekce = classes\Section::build($weburl.'upload/downloads/', '$crate->upload_uri.action', '$crate->upload_uri.id');
$sekce
    ->setTable('downloads', 'iddownload')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'form-horizontal', 'autocomplete' => 'off'))
    ->setList(array(
        'query' => '$db->rawQuery(\'SELECT iddownload, author, picture, polygons, confirmed, visible, d0.added, edited,
                                      languages_has_downloads.name, languages_has_downloads.description, languages_has_downloads_category.name category, state_old_id
                                    FROM %%table%% d0
                                    LEFT JOIN notifications n0 ON (n0.state_id=iddownload AND n0.deleted IS NULL AND n0.type=?)
                                    JOIN languages_has_downloads USING(iddownload)
                                    JOIN languages_has_downloads_category USING(iddownload_category, idlanguage)
                                    JOIN languages USING(idlanguage)
                                    WHERE
                                      d0.deleted IS NULL AND
                                      languages.code=? AND iduser=? AND
                                      iddownload NOT IN (SELECT state_old_id FROM notifications WHERE state_old_id IS NOT NULL AND deleted IS NULL AND from_id=d0.iduser)
                                    ORDER BY d0.visible DESC, d0.confirmed DESC, d0.added DESC\', array($crate::TYPE_DOWNLOAD, \'cs\', $upload_user->getId()))',
        'name' => '{$value->name}',
        'description' => '
        <table>
          <tr>
            <td>
              <table>
                <tr>
                  <td>UID:</td>
                  <td>{if="$value->confirmed && $value->visible"}<a href="{$weburl}download/hledat/@{%%id_row%%}" title="{$value->name}">#{%%id_row%%}</a>{else}#{%%id_row%%}{/if}</td>
                </tr>
                <tr>
                  <td>Popis:</td>
                  <td>{$crate->getSafeDescription($value->description)}</td>
                </tr>
                <tr>
                  <td>Kategorie:</td>
                  <td>{$value->category}</td>
                </tr>
                <tr>
                  <td>Uveřejněno:</td>
                  <td>{$core::getCzechDateTime($value->added)}</td>
                </tr>
                {if="$value->edited"}<tr><td>Aktualizováno:</td><td>{$core::getCzechDateTime($value->edited)}</td></tr>{/if}
                <tr>
                  <td>Stav:</td>
                  <td>{$value->confirmed ? \'Schváleno\' : \'Čeká na schválení\'} a {$value->visible ? \'zařazeno v Download sekci\' : \'zatím nezařazeno v Download sekci\'}</td>
                </tr>
                {$value->confirmed == 0 && $value->state_old_id ? \'<tr><td></td><td>Aktualizace byla odeslána a čeká na schválení!</td></tr>\' : null}
              </table>
            </td>
            <td>
              <img src="{$weburl}img/download/mini/{$value->picture}" class="img-rounded" />
            </td>
          </tr>
        </table>',
        'content' => '
    <ul class="list-group">
      <li class="list-group-item">
        <h4>Objekty / Mapy</h4>
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
    <div class="alert alert-info">Žádný objekt / mapa</div>
%%loop_end%%
',
      ))
    ->setAdd(array(
        'title' => 'Přidat objekt / mapu',
        'form_raw' => true,
        'submit_security' => true,
        'submit_button' => '{submit:;%%title%%|$|class|:|btn btn-primary addeditbtn_dwn}',
        'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">Přidat objekt / mapu</h4>
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
        'success' => '<div class="alert alert-success">Formulář byl odeslán!</div>',
        'failure' => '<div class="alert alert-danger">Byl zadán název, který už v databázi existuje!</div><ul class="list-group"><li class="list-group-item"><a href="javascript:history.back()" class="btn btn-primary">Zpět na formulář</a></li></ul>',
        'form_values' => array('cdp', 'version', 'kuid_cdp', 'kuid_cdp_plain'),
        'code_post_form' => '
          %%form_var%%
              ->setItems(\'iddownload_category\', $crate->getArrayListDownloadsCategory())
              ->addRule(\'polygons\', \'pattern\', \'Polygony musí být v číselném formátu!\', \'[0-9]*\')
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
          // uprva obrazku
          $base_dest = classes\Core::makeFilesName(%%values%%[\'picture\']);  // priprava jmena
          classes\ImageMaker::cropResize(%%values%%[\'picture\'][\'tmp_name\'], \'img/download/mini/\' . $base_dest, $global_configure[\'download\'][\'miniWidth\'], $global_configure[\'download\'][\'miniHeight\']);

          $dest_full = \'img/download/full/\' . $base_dest;
          classes\ImageMaker::resize(%%values%%[\'picture\'][\'tmp_name\'], $dest_full, $global_configure[\'download\'][\'fullWidth\'], $global_configure[\'download\'][\'fullHeight\']);
          %%values%%[\'picture\'] = basename($dest_full);
        ',
        'content_values' => '->remove(\'name\')
                            ->remove(\'description\')
                            ->remove(\'kuid_dependency\')
                            ->remove(\'kuid_dependency_plain\')
                            ->remove(\'cdp\')
                            ->remove(\'version\')
                            ->remove(\'kuid_cdp\')
                            ->remove(\'kuid_cdp_plain\')
                            ->put(\'iduser\', $upload_user->getId())
                            ->put(\'polygons\', %%values%%[\'polygons\'] ?: null)
                            ->putDate(\'added\')',
        'code_post_insert' => '
          // doplneni rewrite
          $db->update(\'%%table%%\', classes\ContentValues::init(array(\'rewrite\' => %%row_id%% . \'-\' . classes\Core::getRewrite(%%values%%[\'name\'][1]))), \'%%table_id%%=?\', array(%%row_id%%));

          //TODO POZN. napevno urceno jazykem!
          %%values%%[\'name\'] = array( // naplneni nazvu
              1 => %%values%%[\'name\'][1],
              2 => %%values%%[\'name\'][1] . \' - en\',
              3 => %%values%%[\'name\'][1] . \' - de\',
            );

          %%values%%[\'description\'] = array(  // naplneni popisku
              1 => %%values%%[\'description\'][1],
              2 => %%values%%[\'description\'][1],
              3 => %%values%%[\'description\'][1],
            );

          // vlozeni name a description
          foreach (%%values%%[\'name\'] as $i => $v) {
            if ($db->query(\'languages_has_downloads\', \'COUNT(idlanguage) pocet\', \'idlanguage=? AND name=?\', array($i, $v))->getFirst()->pocet == 0) {  // pokud neexistuje (0.pocet radku)
              $cv = classes\ContentValues::init()
                      ->put(\'idlanguage\', $i)
                      ->put(\'iddownload\', %%row_id%%)
                      ->put(\'name\', $v)
                      ->put(\'description\', %%values%%[\'description\'][$i]);
              $db->insert(\'languages_has_downloads\', $cv);
            } else {
              %%row_id%% = -1;
              $db->rollBack();
              break(2);
            }
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

          // zaslani nove
          $crate->addNotification($upload_user->getId(), null, $crate::TYPE_DOWNLOAD, %%row_id%%, null, \'add-download\', \'Byl odeslán objekt / mapa s názvem: <strong>\'.%%values%%[\'name\'][1].\'</strong>\');
        ',
      ))
    ->setAdd(array( // duplikace
        'title' => 'Aktualizovat objekt / mapu',
        'url' => 'update',
        'if_link' => '&& $value->confirmed',  // povoleni aktualizace jen pokud je potvrzeny
        'link' => '<a href="%%url%%/{$value->iddownload}" class="btn btn-primary btn-xs pull-right">%%title%%</a>',
        'global_link' => false,
        'form_raw' => true,
        'submit_security' => true,
        'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">Aktualizovat objekt / mapu</h4>
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
        'failure' => '<div class="alert alert-danger">Byl zadán název, který už v databázi existuje!</div><ul class="list-group"><li class="list-group-item"><a href="javascript:history.back()" class="btn btn-primary">Zpět na formulář</a></li></ul>',
        'submit_button' => '{submit:;%%title%%|$|class|:|btn btn-primary addeditbtn_dwn}',
        'form_values' => array('cdp', 'version', 'kuid_cdp', 'kuid_cdp_plain'),
        'code_post_form' => '
          $do = $db->rawQuery(\'SELECT iddownload_category, picture, polygons, added,
                                idlanguage, languages_has_downloads.name, languages_has_downloads.description
                                FROM downloads
                                JOIN languages_has_downloads USING(iddownload)
                                JOIN languages USING(idlanguage)
                                WHERE iddownload=?\', array(%%action_id%%))->getAll();

          if ($do) {    // nacteni hodnot do formulare, nacteni toho co jde, zbytek JS
            %%form_var%%->setDefaults($do[0], array(\'name\', \'description\'));
            // nacteni jmen a popisku
            $pole = array();
            foreach ($do as $v) {
              $pole[\'name\'][$v->idlanguage] = htmlspecialchars($v->name);
              $pole[\'description\'][$v->idlanguage] = $v->description;
            }
            // nacteni kuid dependency
            $pole[\'kuid_dependency\'] = implode(\',\', $db->rawQuery(\'SELECT idtrainz_kuid FROM trainz_kuids
                                                                        JOIN downloads_has_trainz_kuid USING(idtrainz_kuid)
                                                                        WHERE iddownload=?\', array(%%action_id%%))->getAllRows());
            %%form_var%%->setDefaults($pole);

            $cdp = $db->rawQuery(\'SELECT idtrainz_cdp, name, path FROM trainz_cdp
                                  JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                  WHERE iddownload=?\', array(%%action_id%%))->getAll();
          }

          %%form_var%%
              ->setItems(\'iddownload_category\', $crate->getArrayListDownloadsCategory())
              ->addRule(\'polygons\', \'pattern\', \'Polygony musí být v číselném formátu!\', \'[0-9]*\')
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
          if (%%values%%[\'picture\'][\'name\']) {
            // uprava obrazku
            $base_dest = classes\Core::makeFilesName(%%values%%[\'picture\']);  // priprava jmena
            classes\ImageMaker::cropResize(%%values%%[\'picture\'][\'tmp_name\'], \'img/download/mini/\' . $base_dest, $global_configure[\'download\'][\'miniWidth\'], $global_configure[\'download\'][\'miniHeight\']);

            $dest_full = \'img/download/full/\' . $base_dest;
            classes\ImageMaker::resize(%%values%%[\'picture\'][\'tmp_name\'], $dest_full, $global_configure[\'download\'][\'fullWidth\'], $global_configure[\'download\'][\'fullHeight\']);
            %%values%%[\'picture\'] = basename($dest_full);
          } else {
            %%values%%[\'picture\'] = $do[0]->picture;  // jinak navrat obrazku
          }
        ',
        'content_values' => '->remove(\'name\')
                            ->remove(\'description\')
                            ->remove(\'kuid_dependency\')
                            ->remove(\'kuid_dependency_plain\')
                            ->remove(\'cdp\')
                            ->remove(\'version\')
                            ->remove(\'kuid_cdp\')
                            ->remove(\'kuid_cdp_plain\')
                            ->put(\'iduser\', $upload_user->getId())
                            ->put(\'polygons\', %%values%%[\'polygons\'] ?: null)
                            ->put(\'added\', $do[0]->added)
                            ->putDate(\'edited\')',
        'code_post_insert' => '
          // doplneni rewrite
          $db->update(\'%%table%%\', classes\ContentValues::init(array(\'rewrite\' => %%row_id%% . \'-\' . classes\Core::getRewrite(%%values%%[\'name\'][1]))), \'%%table_id%%=?\', array(%%row_id%%));

          // vlozeni name a description
          foreach (%%values%%[\'name\'] as $i => $v) {  // jakoby uprava alias duplikace
            if ($db->query(\'languages_has_downloads\', \'COUNT(idlanguage) pocet\', \'idlanguage=? AND name=? AND iddownload!=?\', array($i, $v, %%action_id%%))->getFirst()->pocet == 0) {  // pokud neexistuje (0.pocet radku)
              $cv = classes\ContentValues::init()
                      ->put(\'idlanguage\', $i)
                      ->put(\'iddownload\', %%row_id%%)
                      ->put(\'name\', $v)
                      ->put(\'description\', %%values%%[\'description\'][$i]);
              $db->insert(\'languages_has_downloads\', $cv);
            } else {
              %%row_id%% = -1;
              $db->rollBack();
              break(2);
            }
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
            $cv_cdp = null;
            if (%%values%%[\'cdp\'][\'name\'][$i]) {  // vkladani souboru nebo nahrati souboru
              $dest = \'files/\' . classes\Core::makeFilesName(array(\'tmp_name\' => %%values%%[\'cdp\'][\'tmp_name\'][$i], \'name\' => $v));
              move_uploaded_file(%%values%%[\'cdp\'][\'tmp_name\'][$i], $dest); // nahrani do slozky

              $cv_cdp = classes\ContentValues::init(array(\'name\' => $v, \'path\' => basename($dest)));
            } else {
              if (!isset($cdp[$i])) {
                continue;  // prazdny se ignoruje
              }
              $cv_cdp = classes\ContentValues::init(array(\'name\' => $cdp[$i]->name, \'path\' => $cdp[$i]->path));
            }

            // vlozeni cdp
            $id_cdp = $db->insert(\'trainz_cdp\', $cv_cdp);

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

          // deaktivace stare polozky
          $db->update(\'%%table%%\', classes\ContentValues::init(array(\'confirmed\' => false)), \'%%table_id%%=?\', array(%%action_id%%));

          // zaslani aktualizace
          $crate->addNotification($upload_user->getId(), null, $crate::TYPE_DOWNLOAD, %%row_id%%, %%action_id%%, \'edit-download\', \'Byl aktualizován objekt / mapa s názvem: <strong>\'.%%values%%[\'name\'][1].\'</strong>\');
        ',
        'success_title' => 'Položka upravena',
      ));
{/code}
{compile="$sekce->render()"}
  </div>
</div>