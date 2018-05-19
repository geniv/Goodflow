
přihlášen: {$user->getData('login')} {$user->getRoles()|print_r:true}<br />

  <nav>
    <ul>{loop="$web->getMenu(0)"}
      <li>
        <a href="{$weburl}{$value->allurl}"{if="$value->active"} class="current"{/if} title="{$value->name}">{$value->name}</a>
      </li>{/loop}
    </ul>
  </nav>

{*
{if="$user->isAllowed($resources.moderate_cook)"}
moderate_cook
{/if}


{if="$user->isAllowed($resources.administrate_web)"}
administrate_web
{/if}
*}

  {$content}

<p>
  poslední aktualizace: {date="d.m.Y H:i:s"}<br />
  nastavená expirace: +{$configure.user.expire} {*date_str="d.m.Y H:i:s",'+'.$configure.user.expire*}<br />
  vygenerováno: {$vygenerovano}, cas expirace: {date="d.m.Y H:i:s", $user->getExpirationTime()}
</p>

