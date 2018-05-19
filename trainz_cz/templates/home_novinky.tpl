{code}//<?
  if (isset($uri['id'])) {
    $value = $crate->getNews($uri['id'])->getFirst();
    if (!$value) {
      classes\Core::setLocation($weburl);
      exit;
    }
  } else {
    classes\Core::setLocation($weburl);
    exit;
  }
{/code}
          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>{@Novinka@}</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 hlavni_obal_novinky">
              <div class="obal_novinky obal_novinky_full">
                <div class="ikona_novinky">
                  <img src="{$weburl}img/icons/{$value->icon_path}" alt="{$value->icon_name}" />
                </div>
                <div class="obsah_novinky">
                  <h3>{$value->name}</h3>
                  <span class="novinky_autordatum">{@Autor@}: <strong>{$value->login}{if="$value->alias"} ({$value->alias}){/if}</strong><em>{$core::getCzechDate($value->added)}</em></span>
{$value->description}
                </div>
              </div>
            </div>
          </div>
