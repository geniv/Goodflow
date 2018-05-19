{loop="$menu->getMenu()"}
  <a href="{$value->allurl}"{$value->active ? ' class="active"' : ''} title="{$value->name}">{$value->name}</a>
{/loop}