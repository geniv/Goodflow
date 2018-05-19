
<div class="menu">  {*$menu_loop|print_r:true*}
  <ul>
  {loop="$menu_loop" as $v}
    <li><a href="{$v->allurl}">{$v->name}</a> - [ <strong>{$v->active}</strong> ], ({$v->url}), {$v->poc}-{$v->count}, lvl: {$v->level} {*$v|print_r:true*} </li>
    {if="$v->hasMenu()"}
      <ul>
      {loop="$v->getMenu()" as $v1}
        <li><a href="{$v1->allurl}">{$v1->name}</a> - [ <strong>{$v1->active}</strong> ], ({$v1->url}), {$v1->poc}-{$v1->count}, lvl: {$v1->level} {*$v1|print_r:true*} </li>
        {if="$v1->hasMenu()"}
          <ul>
          {loop="$v1->getMenu()" as $v2}
            <li><a href="{$v2->allurl}">{$v2->name}</a> - [ <strong>{$v2->active}</strong> ], ({$v2->url}) {$v2->poc}-{$v2->count}, lvl: {$v2->level} {*$v2|print_r:true*} </li>
            {if="$v2->hasMenu()"}
              <ul>
              {loop="$v2->getMenu()" as $v3}
                <li><a href="{$v3->allurl}">{$v3->name}</a> - [ <strong>{$v3->active}</strong> ], ({$v3->url}) {$v3->poc}-{$v3->count}, lvl: {$v3->level} {*$v3|print_r:true*} </li>
              {/loop}
              </ul>
            {/if}
          {/loop}
          </ul>
        {/if}
      {/loop}
      </ul>
    {/if}
  {/loop}
  </ul>
</div>

<br />

pro tpl: <strong>{$menu->getActiveAddress()|implode:'/'}</strong>