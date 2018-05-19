{loop="$crate->upload_menu->getMenu()"}
<li{$value->active ? ' class="active"' : ''}><a href="{$value->allurl}{$value->url !='home' ? '/' : null}">{$value->name}{if="$value->url == 'messages'"}<span class="badge pull-right">{$crate->getCountMessage($upload_user->getId())}</span>{/if}</a></li>
{/loop}