        <ul>        {loop="$menu->getMenu()" as $v0}
          <li>
            <a href="{$v0->allurl}"{$v0->active ? ' class="active"' : ''} title="{$translate.menu_item[$v0->url]}">{$translate.menu_item[$v0->url]}</a>
          </li>        {/loop}
        </ul>