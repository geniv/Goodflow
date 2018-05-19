          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>{$menu->getVariable('name')}</h2>
            </div>
          </div>
          <ul class="breadcrumb">
            <li><a href="{$weburl}download" title="Download">Download</a></li>
            <li>{$menu->getVariable('name')}</li>
          </ul>
          <div class="row">
            <div class="col-lg-3">
              <ul class="nav nav-pills nav-stacked menu-history">
            {loop="$db->rawQuery('SELECT DATE(IF(edited > added, edited, added)) datum FROM downloads
                                  WHERE deleted IS NULL AND confirmed=1 AND visible=1 AND IF(edited > added, edited, added) > (CURDATE() - INTERVAL ? MONTH)
                                  GROUP BY datum
                                  ORDER BY datum DESC', array($global_configure.novinky.pocetMesicuHistorie))"}
                <li{if="isset($uri['datum']) && $uri['datum'] === $value->datum"} class="active"{/if}>
                  <a href="{$weburl}download/historie/{$value->datum}" title="{$core::getCzechDate($value->datum)}">{$core::getCzechDate($value->datum)}</a>
                </li>
            {emptyloop}
                <li>
                  <p>Nebyl nalezen žádný objekt/mapa v tomto datu!</p>
                </li>
            {/loop}
              </ul>
            </div>
            <div class="col-lg-9">
            {if="isset($uri['datum'])"}
              {loop="$db->rawQuery('SELECT iddownload, iddownload_category, rewrite, _d.picture, _d.added, _d.edited, _u.login, _u.alias, _d.author, _lhd.name FROM downloads _d
                                    JOIN languages_has_downloads _lhd USING(iddownload)
                                    JOIN languages USING(idlanguage)
                                    LEFT JOIN users _u USING(iduser)
                                    WHERE _d.deleted IS NULL AND _d.confirmed=1 AND _d.visible=1 AND languages.code=? AND DATE(IF(_d.edited > _d.added, _d.edited, _d.added))=?
                                    ORDER BY IF(_d.edited > _d.added, _d.edited, _d.added) DESC', array($current_language, $uri['datum']))"}
              <div class="row download-item download-history">
                <div class="col-lg-12">
                  <a href="{$weburl}download/{$crate->getDownloadUrlBuildRewrite($value->iddownload_category)}/{$value->rewrite}" title="{$value->name}" class="thumbnail">
                    <span class="left-block-img">
                      <img src="{$weburl}img/download/mini/{$value->picture}" alt="{$value->name}" class="img-rounded" />
                    </span>
                    <span class="right-block-content">
                      <strong>{$value->name}</strong>
                      <em>Autor: {if="$value->author"}{$value->author}{else}{$value->login}{if="$value->alias"} ({$value->alias}){/if}{/if}</em>
                      <em>Uveřejněno: {$core::getCzechDateTime($value->added)}</em>
                      {if="$value->edited"}<em>Aktualizováno: {$core::getCzechDateTime($value->edited)}</em>{/if}
                    </span>
                  </a>
                </div>
              </div>
              {emptyloop}
              <div class="row download-item download-history">
                <div class="col-lg-12">
                  <div class="alert alert-info text-center">
                    <p>V tomto datu nejsou žádné objekty!</p>
                  </div>
                </div>
              </div>
              {/loop}
            {/if}
            </div>
          </div>