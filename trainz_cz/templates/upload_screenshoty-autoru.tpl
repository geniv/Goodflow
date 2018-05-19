{if="isset($uri['action'])"}
{code}
  $c = $db->query('users', 'login, alias, avatar', 'login=?', array($uri['action']))->getFirst();
{/code}
          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>Všechny screenshoty od autora: {if="$c"}{$c->login}{if="$c->alias"} ({$c->alias}){/if}{else}{$uri['action']}{/if}</h2>
            </div>
          </div>
          <div class="obal_upload_sekce">
            <div class="well well-sm clearfix">
              {if="$c"}
              <span class="avatar-obal">
                <img src="{$weburl}img/avatars/{$c->avatar}" onerror="this.src='{$weburl}img/avatars/no-profile-img.png'" class="pull-left avatar-upload" />
              </span>
              {/if}
              <p class="pull-left">{if="$c"}{$c->login}{if="$c->alias"} ({$c->alias}){/if}{else}{$uri['action']}{/if}</p>
              <div class="btn-group btn-group-sm pull-right">
                <a href="{$weburl}upload/screenshoty-autoru" class="btn btn-info">Zpět na výpis autorů</a>
              </div>
            </div>
          </div>
          {loop="$db->rawQuery('SELECT path, description FROM slideshows _s
                                LEFT JOIN users USING(iduser)
                                WHERE _s.confirmed=1 AND (author=? OR login=?)', array($uri['action'], $uri['action']))"}
          <div class="screenshot_autor">
            <img src="{$weburl}img/slideshow/{$value->path}" />
            <div class="screenshot_popis">
              {$value->description}
              <div class="social_buttony">
                <div class="socialb1">
                  <div class="fb-like" data-href="{$weburl}img/slideshow/{$value->path}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                </div>
                <div class="socialb2">
                  <div class="g-plusone" data-size="medium" data-align="right" data-href="{$weburl}img/slideshow/{$value->path}"></div>
                </div>
                <div class="socialb3">
                  <a href="https://twitter.com/share" data-align="right" class="twitter-share-button" data-text="Trainz.cz - {$value->description}" data-lang="cs"  data-url="{$weburl}img/slideshow/{$value->path}"><!-- --></a>
                </div>
              </div>
            </div>
          </div>
          {/loop}
{else}
          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>{$menu->getVariable('name')}</h2>
            </div>
          </div>
          <div class="well well-sm clearfix upload_screeny_well">
            {loop="$db->rawQuery('SELECT login, alias, author, COUNT(idslideshow) pocet FROM slideshows _s
                                  LEFT JOIN users USING(iduser)
                                  WHERE _s.confirmed=1
                                  GROUP BY iduser, author
                                  ORDER BY COALESCE(login, author) ASC')"}
            <p class="clearfix">
              <a href="{$weburl}upload/screenshoty-autoru/{$value->author}{$value->login}" class="btn btn-default btn-sm clearfix" title="{if="$value->author"}{$value->author}{else}{$value->login}{if="$value->alias"} ({$value->alias}){/if}{/if}"><em>{if="$value->author"}{$value->author}{else}{$value->login}{if="$value->alias"} ({$value->alias}){/if}{/if}</em><span class="badge pull-right">{$value->pocet} {$core::getCzechPlural($value->pocet, array('obrázek', 'obrázky', 'obrázků'))}</span></a>
            </p>
            {emptyloop}
            <p class="clearfix">Žádný autor nemá screenshoty!</p>
            {/loop}
          </div>
{/if}
