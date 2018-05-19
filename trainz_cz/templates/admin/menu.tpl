      <div id="mws-navigation">
        <ul>{loop="$admin_menu->getMenu()" as $v0}{if="$user->isAllowed($v0->url, 'show')"}
          <li{$v0->active ? ' class="active"' : ''}>
            {if="$user->isAllowed($v0->url, 'list')"}<a href="{$v0->allurl}/"><i class="icon-{$v0->ikona}"></i> {$v0->name}{if="$v0->url == 'messages' && ($count = $crate->getCountNotification($crate::TYPE_MESSAGE)) > 0"} <span class="mws-nav-tooltip">{$count}</span>{/if}</a>{else}<span><i class="icon-{$v0->ikona}"></i>{$v0->name}</span>{/if}{if="$v0->hasMenu()"}
            <ul>{loop="$v0->getMenu()" as $v1}{if="$user->isAllowed($v0->url . '/' . $v1->url, 'show')"}
              <li{$v1->active ? ' class="active2"' : ''}><a href="{$v1->allurl}/">{$v1->name}{if="$v1->url == 'new' && ($count = $crate->getCountNotification($v0->url == 'users' ? $crate::TYPE_REGISTRATION : ($v0->url == 'slideshows' ? $crate::TYPE_SLIDESHOW : $crate::TYPE_DOWNLOAD))) > 0"} <span class="mws-nav-tooltip">{$count}</span>{/if}</a></li>{/if}{/loop}
            </ul>{/if}
          </li>{/if}{/loop}
        </ul>
      </div>