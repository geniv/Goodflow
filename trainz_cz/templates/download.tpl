{code}//<?
  $current_section = implode(array_slice(array_slice($uri, 1), -1));
  //var_dump($current_section);
{/code}          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>{@Download@}{$current_section ? ' - ' . ($crate->isDownloadObject($uri) ? $crate->getDownload($crate->getDownloadObjectID($uri), 'name') : $crate->getDownloadCategoryRewrite($current_section, 'name')) : null}</h2>
            </div>
          </div>
          <div class="row drn-hl">
            <div class="col-lg-9">
              <ul class="breadcrumb">
                <li><a href="{$weburl}download" title="Download">Download</a></li>{loop="array_slice($uri, 1)"}
                <li>{if="(count($uri) - 2) != $counter1"}<a href="{$weburl}{$uri|array_slice:0,$counter1+1|implode:'/'}{$value ? '/' . $value : null}" title="{$crate->getDownloadCategoryRewrite($value, 'name')}">{$crate->getDownloadCategoryRewrite($value, 'name')}</a>{else}{if="$crate->isDownloadObject($uri)"}{$crate->getDownload($crate->getDownloadObjectID($uri), 'name')}{else}{$crate->getDownloadCategoryRewrite($value, 'name')}{/if}{/if}</li>{/loop}
              </ul>
            </div>
            <div class="col-lg-3">
              <form method="post" action="{$weburl}download/hledat" class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Hledat...">
                <span class="input-group-btn">
                  <input class="btn btn-default" type="submit" value="Hledat">
                </span>
              </form>
            </div>
          </div>{code}
  // nacteni id pro loop
  $parent = $current_section ? $crate->getDownloadCategoryID($current_section) : null;
  // slozeni cesty pro proklikavani
  $link_parents = implode('/', array_slice($uri, 1));
{/code}{if="$crate->isDownloadObject($uri) && ($down = $crate->getDownload($crate->getDownloadObjectID($uri)))"}
          <div class="obal_download_polozka">
            <div class="panel panel-default polozka_description">
              <div class="panel-body clearfix">
                <a href="{$weburl}img/download/full/{$down->picture}" class="download-img-fancy thumbnail" title="{$down->name}">
                  <img src="{$weburl}img/download/mini/{$down->picture}" alt="{$down->name}" class="img-rounded" />
                </a>
                <div class="obal_informace">
                  <p>
                    Autor: <a href="{$weburl}download/autor/{$down->author ?: $down->login}" title="Objekty od autora: {if="$down->author"}{$down->author}{else}{$down->login}{if="$down->alias"} ({$down->alias}){/if}{/if}">{if="$down->author"}{$down->author}{else}{$down->login}{if="$down->alias"} ({$down->alias}){/if}{/if}</a>
                  </p>{if="$down->versions"}
                  <p>
                    Pro: {$down->versions}
                  </p>{/if}{if="$down->polygons"}
                  <p>
                    Počet polygonů: {$down->polygons}
                  </p>{/if}
                  <p>
                    Uveřejněno: {$core::getCzechDateTime($down->added)}
                  </p>{if="$down->edited"}
                  <p>
                    Aktualizováno: {$core::getCzechDateTime($down->edited)}
                  </p>{/if}
                </div>
                <div class="obal_sdileni">
                  <div class="fb-like" data-href="{$core::getRequestUrl()}/" data-width="90" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                  <div class="g-tlacitko"><div class="g-plusone" data-size="medium" data-align="right"></div></div>
                  <a href="https://twitter.com/share" class="twitter-share-button" data-text="Trainz.cz - {$down->name}" data-lang="cs" data-align="right"><!-- --></a>
                </div>
              </div>
              <div class="panel-heading clearfix">
                {$down->description}
              </div>
            </div>
            <div class="polozka_soubory_kuidy">
              <div class="panel panel-info">
                <div class="panel-heading"><p>Oddíl se soubory</p></div>
                <div class="panel-body">{loop="$db->rawQuery('SELECT t0.idtrainz_cdp, path, t0.name, counter,
                                                              GROUP_CONCAT(DISTINCT trainz_versions.name ORDER BY trainz_versions.rank SEPARATOR \', \') versions
                                                              FROM trainz_cdp t0
                                                              JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                                                              LEFT JOIN trainz_cdp_has_trainz_versions USING(idtrainz_cdp)
                                                              LEFT JOIN trainz_versions USING(idtrainz_version)
                                                              WHERE iddownload=?
                                                              GROUP BY t0.idtrainz_cdp', array($down->iddownload))" as $cdp}
                  <ul class="list-group">
                    <li class="list-group-item">
                      <a href="#" onclick="return downloadCDP({$cdp->idtrainz_cdp}, '.class_counter', true)" title="{$cdp->name}">{$cdp->name}</a> <em>({$core::getFileSize('files/' . $cdp->path)})</em><em class="pull-right">Staženo: <span class="class_counter{$cdp->idtrainz_cdp}">{$cdp->counter}x</span></em>
                    </li>{if="$cdp->versions"}
                    <li class="list-group-item verze_kuid_item">Pro: {$cdp->versions}</li>{/if}{$list = $db->rawQuery('SELECT kuid, name FROM trainz_kuids
                                                                                                                        JOIN trainz_cdp_has_trainz_kuids _tchtk USING(idtrainz_kuid)
                                                                                                                        WHERE _tchtk.idtrainz_cdp=?
                                                                                                                        ORDER BY name ASC, CAST(kuid AS DECIMAL) ASC, kuid ASC', array($cdp->idtrainz_cdp))->getAll()}{if="count($list) > 0"}
                    <li class="list-group-item verze_kuid_item">
                    <table>{loop="$list"}
                      <tr>
                        <td class="td_kuid">{$crate::formatKuid($value->kuid)}</td>
                        <td>{$value->name ?: null}</td>
                      </tr>{/loop}
                      </table>
                    </li>{/if}
                  </ul>{/loop}
                </div>
              </div>{$list = $db->rawQuery('SELECT kuid, trainz_kuids.name, url, _tc.idtrainz_cdp, _tc.name cdp_name, _tc.path cdp_path FROM trainz_kuids
                                            JOIN downloads_has_trainz_kuid USING(idtrainz_kuid)
                                            LEFT JOIN trainz_cdp _tc USING(idtrainz_cdp)
                                            WHERE iddownload=?
                                            GROUP BY idtrainz_kuid
                                            ORDER BY
                                                IF(trainz_kuids.name IS NOT NULL, 0, 1) ASC, IF(_tc.name IS NOT NULL, 2, 3) ASC, IF(url IS NOT NULL, 4, 5) ASC,
                                                trainz_kuids.name, _tc.name ASC,
                                                CAST(kuid AS DECIMAL) ASC, kuid ASC', array($down->iddownload))->getAll()}{if="count($list) > 0"}
              <div class="panel panel-warning">
                <div class="panel-heading"><p>Doporučené KUID součásti</p></div>
                <div class="panel-body">
                  <ul class="list-group">
                    <li class="list-group-item verze_kuid_item">
                      <table>{loop="$list"}
                        <tr>
                          <td class="td_kuid">{$crate::formatKuid($value->kuid)}</td>
                          <td>{$value->name ? $value->name . ' - ' : null}{if="$value->url && !$value->idtrainz_cdp"}[<a href="{$value->url}" title="externí odkaz" target="_blank">externí odkaz</a>]{else}{if="!$value->idtrainz_cdp"}{$value->name ? '[neznámé umístění]' : '[neznámý]'}{else}[<a href="#" onclick="return downloadCDP({$value->idtrainz_cdp}, null, true)" title="{$value->cdp_name}">{$value->cdp_name}</a>] <em>({$core::getFileSize('files/' . $value->cdp_path)})</em>{/if}{/if}</td>
                        </tr>{/loop}
                      </table>
                    </li>
                  </ul>
                </div>
              </div>{/if}
            </div>
            <div class="fb-comments" data-href="{$core::getRequestUrl()}" data-width="950" data-numposts="10" data-colorscheme="light"></div>
          </div>{else}
          <div class="row">
            <div class="col-lg-3 col-lg-offset-9 clearfix">
              {if="$current_down_type == 'tree'"}<a href="{$weburl}{$down_type}/list" class="btn btn-primary btn-xs pull-right">Klasická navigace</a>{else}<a href="{$weburl}{$down_type}/tree" class="btn btn-primary btn-xs pull-right">Stromová navigace</a>{/if}
            </div>
          </div>{if="$current_down_type == 'list'"}
          <div class="row download-row">
            <div class="col-lg-8 col-lg-offset-2">{if="count($list = $crate->getListDownloadCategory($parent)->getAll()) > 0"}
              <div class="well clearfix">{loop="$list"}
                <a href="{$weburl}download/{$link_parents ? $link_parents . '/' : null}{$value->rewrite}" title="{$value->name}" class="col-lg-6 {$counter1 % 2 == 0 ? 'lichy ' : null}btn btn-default btn-lg btn-block">{$value->name}</a>{/loop}
              </div>{/if}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">{else}
          <div class="row">
            <div class="col-lg-3">{if="count($v0list = $crate->getListDownloadCategory()->getAll()) > 0"}
              <ul id="navigation-treeview">{loop="$v0list" as $v0}
                <li>
                  <a href="{$weburl}download/{$v0->rewrite}">{$v0->name}{if="($poc = $crate->getCountDownloadItems($v0->iddownload_category)) > 0"} [{$poc}]{/if}</a>{if="count($v1list = $crate->getListDownloadCategory($v0->iddownload_category)->getAll()) > 0"}
                  <ul>{loop="$v1list" as $v1}
                    <li>
                      <a href="{$weburl}download/{$v0->rewrite}/{$v1->rewrite}">{$v1->name}{if="($poc = $crate->getCountDownloadItems($v1->iddownload_category)) > 0"} [{$poc}]{/if}</a>{if="count($v2list = $crate->getListDownloadCategory($v1->iddownload_category)->getAll()) > 0"}
                      <ul>{loop="$v2list" as $v2}
                        <li>
                          <a href="{$weburl}download/{$v0->rewrite}/{$v1->rewrite}/{$v2->rewrite}">{$v2->name}{if="($poc = $crate->getCountDownloadItems($v2->iddownload_category)) > 0"} [{$poc}]{/if}</a>{if="count($v3list = $crate->getListDownloadCategory($v2->iddownload_category)->getAll()) > 0"}
                          <ul>{loop="$v3list" as $v3}
                            <li>
                              <a href="{$weburl}download/{$v0->rewrite}/{$v1->rewrite}/{$v2->rewrite}/{$v3->rewrite}">{$v3->name}{if="($poc = $crate->getCountDownloadItems($v3->iddownload_category)) > 0"} [{$poc}]{/if}</a>{if="count($v4list = $crate->getListDownloadCategory($v3->iddownload_category)->getAll()) > 0"}
                              <ul>{loop="$v4list" as $v4}
                                <li>
                                  <a href="{$weburl}download/{$v0->rewrite}/{$v1->rewrite}/{$v2->rewrite}/{$v3->rewrite}/{$v4->rewrite}">{$v4->name}{if="($poc = $crate->getCountDownloadItems($v4->iddownload_category)) > 0"} [{$poc}]{/if}</a>
                                </li>{/loop}
                              </ul>{/if}
                            </li>{/loop}
                          </ul>{/if}
                        </li>{/loop}
                      </ul>{/if}
                    </li>{/loop}
                  </ul>{/if}
                </li>{/loop}
              </ul>{/if}
            </div>
            <div class="col-lg-9">{/if}{loop="$crate->getListDownloads($parent)"}
              <div class="row download-item">
                <div class="col-lg-12">
                  <a href="{$weburl}download/{$link_parents}/{$value->rewrite}" class="thumbnail">
                    <span class="left-block-img">
                      <img src="{$weburl}img/download/mini/{$value->picture}" alt="{$value->name}" class="img-rounded" />
                    </span>
                    <span class="right-block-content">
                      <strong>
                        {$value->name}
                      </strong>
                      <em class="description">
                        <span class="description_content">{$crate->getSafeDescription($value->description)}</span>
                      </em>
                      <em>
                        Autor: {if="$value->author"}{$value->author}{else}{$value->login}{if="$value->alias"} ({$value->alias}){/if}{/if}
                      </em>{if="$value->polygons"}
                      <em>
                        Počet polygonů: {$value->polygons}
                      </em>{/if}{if="$value->versions"}
                      <em>
                        Pro: {$value->versions}
                      </em>{/if}
                      <em>
                        Uveřejněno: {$core::getCzechDateTime($value->added)}
                      </em>{if="$value->edited"}
                      <em>
                        Aktualizováno: {$core::getCzechDateTime($value->edited)}
                      </em>{/if}
                    </span>
                  </a>
                </div>
              </div>{emptyloop}{if="count($uri) > 1"}
              <div class="alert alert-info text-center download-alert">
                <p>{@V této kategorii nejsou žádné objekty!@}</p>
              </div>{/if}{/loop}
            </div>
          </div>{/if}