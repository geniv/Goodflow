          <div id="tcz_slideshow" class="tcz_slideshow_{$current_language}">
            <div id="slideshow_arrows">
              <span id="prev" title="{@Předchozí@}">{@Předchozí@}</span>
              <span id="next" title="{@Další@}">{@Další@}</span>
            </div>
            <div class="cycle-slideshow" data-cycle-fx=fadeout data-cycle-timeout=5000 data-cycle-prev="#prev" data-cycle-next="#next" data-cycle-random="true" data-cycle-pause-on-hover="true" data-cycle-caption="#cycle-popis-img" data-cycle-caption-template="<span id='cycle-popis-nazev'>{{alt}}</span><span id='cycle-popis-autor'>{@Autor@}: {{cycleTitle}}</span>">{loop="$crate->getListSlideshows()"}
              <img src="{$weburl}img/slideshow/{$value->path}" alt="{$value->description|htmlspecialchars}" data-cycle-title="{if="$value->author"}{$value->author}{else}{$value->alias ?: $value->login}{/if}" />{emptyloop}
              <img src="{$weburl}img/slideshow/no-slideshow-img.png" alt="" data-cycle-title="" />{/loop}
            </div>
          </div>
          <div id="cycle-popis-img"></div>
          <img src="{$weburl}img/banner.gif" alt="Trainz 2012 banner" id="trainz_banner" class="hide" />
          <div class="row tcz_nadpisy home_row">
            <div class="col-lg-8">
              <h2>{@Novinky@}</h2>
            </div>
            <div class="col-lg-4">
              <h2>{@Novinky v Downloadu@}</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 hlavni_obal_novinky">{code}//<?
  // pager + zaruceni prvni stranky
  $pagination = classes\Paginator::init($db->query('news', 'COUNT(idnews) pocet')->getFirst()->pocet, $global_configure['novinky']['pocetPolozekNaStranku'])->setPage(isset($uri['pager']) ? $uri['pager'] : 1);
  $countToPage = $db->rawQuery('SELECT idnews FROM news '.$pagination->getLimit())->getCount(); // kvuli spravnemu zakoncovani grafiky
{/code}{loop="$crate->getListNews($pagination->getLimit())"}
              <div class="obal_novinky{$counter1 + 1 == $countToPage ? ' posledni' : null}">
                <div class="ikona_novinky">
                  <img src="{$weburl}img/icons/{$value->icon_path}" alt="{$value->icon_name}" />
                </div>
                <div class="obsah_novinky">
                  <h3>{$value->name}</h3>
                  <span class="novinky_autordatum">{@Autor@}: <strong>{$value->login}{if="$value->alias"} ({$value->alias}){/if}</strong><em>{$core::getCzechDay(strtotime($value->added))} {date_str="j."$value->added} {$core::getCzechMonth(strtotime($value->added),false)} {date_str="Y",$value->added}</em></span>
{$core::trimParagraphs($value->description, $global_configure.novinky.pocetOdstavcuNaPolozku)}{if="$core::getCountParagraphs($value->description) > $global_configure.novinky.pocetOdstavcuNaPolozku"}
                  <a href="{$weburl}novinky/{$value->idnews}" title="{@Více@}..." class="btn btn-primary btn-sm">{@Více@}...<span><!-- vypln odkazu --></span></a>{/if}
                </div>
              </div>
              {emptyloop}
              <div class="alert alert-info text-center">
                <p>{@Žádná novinka@}</p>
              </div>
              {/loop}
              {if="$pagination->isVisible()"}<div id="obal_strankovani">
                <div id="strankovani">
                  {if="$pagination->isPrev()"}<a href="{$weburl}page/{$pagination->getPrevPage()}" title="{@Předchozí@}" class="prochazeni predchozi">{@Předchozí@}</a>{else}<span class="prochazeni predchozi">{@Předchozí@}</span>{/if}
                  {loop="$pagination->render(classes\Paginator::TYPE3, array('range' => $global_configure.novinky.rozsahStrankovani))"}{if="$pagination->getPage()==$value"}<span title="{@Strana@} {$value}" class="strana">{$value}<span><!-- vypln --></span></span>{else}<a href="{$weburl}page/{$value}" title="{@Strana@} {$value}" class="strana">{$value}<span><!-- vypln --></span></a>{/if}{/loop}
                  {if="$pagination->isNext()"}<a href="{$weburl}page/{$pagination->getNextPage()}" title="{@Další@}" class="prochazeni dalsi">{@Další@}</a>{else}<span class="prochazeni dalsi">{@Další@}</span>{/if}
                </div>
              </div>{/if}
            </div>
            <div class="col-lg-4 obal_download_novinky">
              {loop="$crate->getListLastDownloads($global_configure.download.pocetPoslednichPolozek)"}
              <div class="download_novinka{$counter1 + 1 == $global_configure.download.pocetPoslednichPolozek ? ' posledni' : null}">
                <a href="{$weburl}download/{$crate->getDownloadUrlBuildRewrite($value->iddownload_category)}/{$value->rewrite}" title="{$value->name}">
                  <img src="{$weburl}img/download/mini/{$value->picture}" alt="{$value->name}" class="img-rounded" />
                  <em>{$value->name}</em>
                  <strong>{if="$value->edited"}Aktualizace!<br />{/if}Autor: {if="$value->author"}{$value->author}{else}{$value->login}{if="$value->alias"} ({$value->alias}){/if}{/if}</strong>
                  <span>{if="!$value->edited"}{$core::getCzechDateTime($value->added)}{else}{$core::getCzechDateTime($value->edited)}{/if}</span>
                </a>
              </div>
              {emptyloop}
              <div class="alert alert-info text-center">
                <p>{@Žádná novinka@}</p>
              </div>
              {/loop}
              <a href="{$weburl}download/historie/{$crate->getDateLastDownloads()}" class="btn btn-default btn-sm home_link_history" title="Historie Downloadu">Historie Downloadu</a>
            </div>
          </div>
          <div class="row">
            <div class="google_reklama">
              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              <!-- trainz.cz -->
              <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-7051007774325370" data-ad-slot="3733380212"></ins>
              <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
              </script>
            </div>
          </div>