{code}//<?
  if (isset($uri['lvl2'])) {  // predani getu do postu
    $_POST['search'] = $uri['lvl2'];
  }
  $search = isset($_POST['search']) ? $_POST['search'] : null;
  $idsearch = isset($search[0]) && in_array($search[0], array('@', '#')) ? substr($search, 1) : 0; // detekovani id
  if (isset($search[0]) && $search[0] == '@') { // detekce hledani @xxx
    $search[0] = '#'; // prevod na #
  } // nehleda fulltext, jen v MyISAM, InnoDB az od 5.6>=
{/code}
          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>Hledat: {$search}</h2>
            </div>
          </div>
          <div class="sekce_hledat">
            <form method="post" action="{$weburl}download/hledat" class="input-group">
              <input type="text" class="form-control" name="search" value="{$search|htmlspecialchars}" placeholder="Hledat...">
              <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="Hledat">
              </span>
            </form>
{if="$search"}
  {loop="$db->rawQuery('SELECT downloads.iddownload, downloads.iddownload_category, users.login, users.alias, author, rewrite, picture, polygons, downloads.added, downloads.edited,
                          GROUP_CONCAT(DISTINCT trainz_versions.name ORDER BY trainz_versions.rank SEPARATOR \', \') versions,
                          languages_has_downloads.name, languages_has_downloads.description
                        FROM downloads
                        LEFT JOIN users USING(iduser)
                        JOIN downloads_has_trainz_cdp USING(iddownload)
                        JOIN trainz_cdp USING(idtrainz_cdp)
                        -- verze
                        LEFT JOIN trainz_cdp_has_trainz_versions USING(idtrainz_cdp)
                        LEFT JOIN trainz_versions USING(idtrainz_version)
                        -- dependency
                        -- JOIN downloads_has_trainz_kuid _dhtk USING(iddownload)
                        -- JOIN trainz_kuids _dependency ON _dependency.idtrainz_kuid=_dhtk.idtrainz_kuid
                        -- bloky
                        LEFT JOIN trainz_cdp_has_trainz_kuids _tchtk ON _tchtk.idtrainz_cdp=trainz_cdp.idtrainz_cdp
                        LEFT JOIN trainz_kuids _block ON _block.idtrainz_kuid=_tchtk.idtrainz_kuid
                        -- jazyky
                        JOIN languages_has_downloads USING(iddownload)
                        JOIN languages USING(idlanguage)
                        WHERE
                          downloads.deleted IS NULL AND
                          downloads.confirmed=1 AND downloads.visible=1 AND
                          languages.code=? AND
                          (
                            downloads.iddownload=? OR login LIKE ? OR author LIKE ? OR alias LIKE ? OR
                            languages_has_downloads.name LIKE ? OR languages_has_downloads.description LIKE ? OR
                            trainz_cdp.name LIKE ? OR trainz_versions.name LIKE ? OR
                            -- _dependency.kuid LIKE X OR
                            _block.kuid=?
                          )
                        GROUP BY downloads.iddownload
                        LIMIT 0, ' . $global_configure.download.maxSearchItems, array($current_language, $idsearch, '%' . $search . '%', '%' . $search . '%',
                            '%' . $search . '%', '%' . $search . '%', '%' . $search . '%', '%' . $search . '%', '%' . $search . '%', $search))"}
            <div class="row download-item">
              <div class="col-lg-12">
                <a href="{$weburl}download/{$crate->getDownloadUrlBuildRewrite($value->iddownload_category)}/{$value->rewrite}" class="thumbnail">
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
                    </em>
                  {if="$value->polygons"}
                    <em>
                      Počet polygonů: {$value->polygons}
                    </em>
                  {/if}
                  {if="$value->versions"}
                    <em>
                      Pro: {$value->versions}
                    </em>
                  {/if}
                    <em>
                      Uveřejněno: {$core::getCzechDateTime($value->added)}
                    </em>
                  {if="$value->edited"}
                    <em>
                      Aktualizováno: {$core::getCzechDateTime($value->edited)}
                    </em>
                  {/if}
                  </span>
                </a>
              </div>
            </div>
            {emptyloop}
            <div class="alert alert-info text-center">
              <p>{@Nebyly nalezeny žádné odpovídající výsledky!@}</p>
            </div>
            {/loop}
          {else}
            <div class="alert alert-info text-center">
              <p>{@Nebyl zadán žádný výraz pro hledání!@}</p>
            </div>
          {/if}
          </div>