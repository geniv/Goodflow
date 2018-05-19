        <ul>        {loop="$menu->getMenu()" as $v0}{$url=$v0->url}
          <li>
            <a href="{$v0->allurl}" title="{$v0->name}">{$v0->name}</a>
          </li>        {/loop}
        </ul>
