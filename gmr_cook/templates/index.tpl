
  <nav>
    <ul>{loop="$web->getMenu(0)"}
      <li>
        <a href="{$weburl}{$value->allurl}"{if="$value->active"} class="current"{/if} title="{$value->name}">{$value->name}</a>
      </li>{/loop}
    </ul>
  </nav>

  //TODO user sekce, mimo admin! a jeste vypis: nadobi+suroviny

<p><a href="{$weburl}{$configure.htmlpage.urladmin}">Admin</a></p>

{$content}

