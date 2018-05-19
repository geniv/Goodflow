{code}//<?
  if (isset($uri['login'])) {
    $login = urldecode($uri['login']);
    $user = $db->query('users', 'iduser, alias', 'login=?', array($login))->getFirst(); //TODO bacha! bere jen iduser (prvni) NEBO autor z downloadu!!
    if ($user) { // nenalezen uzivatel
      $iddownload_list = $db->rawQuery('SELECT iddownload FROM downloads
                                        JOIN languages_has_downloads USING(iddownload)
                                        JOIN languages USING(idlanguage)
                                        WHERE languages.code=? AND iduser=?
                                        ORDER BY languages_has_downloads.name ASC', array($current_language, $user->iduser));
    } else {
      $iddownload_list = $db->rawQuery('SELECT iddownload FROM downloads
                                        JOIN languages_has_downloads USING(iddownload)
                                        JOIN languages USING(idlanguage)
                                        WHERE languages.code=? AND author=?
                                        ORDER BY languages_has_downloads.name ASC', array($current_language, $login));
    }
  } else {
    classes\Core::setLocation($weburl);
    exit;
  }
{/code}
          <div class="row tcz_nadpisy tcz_nadpisy_autor">
            <div class="col-lg-12">
              <h2>Objekty od autora: {$uri.login|urldecode}{$user && $user->alias ? ' (' . $user->alias . ')': null}</h2>
            </div>
          </div>
{loop="$iddownload_list" as $download}
{if="($value = $crate->getDownload($download->iddownload))"}
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
{/if}
{emptyloop}
<div class="alert alert-info text-center">
  <p>{@Od tohoto autora nejsou v databázi žádné objekty!@}</p>
</div>
{/loop}