{*/code}var_dump($menu);{/code/*}
------------------
<pre>
js: {$menu->getJS(null, true)|print_r:true}

external: {$menu->getJS('external', true)|print_r:true}

embed: {$menu->getJS('embed', true)|print_r:true}
</pre>
------------------
title: <b>{$t=$menu->getTitle(array('show_default' => false))}{$t}</b><br /><br />

<ul>
{loop="$menu->getMenu()" as $v0}
    <li><a href="{$v0->allurl}">{$v0}</a> [{$v0->active}]</li>
    {if="$v0->hasMenu()"}
      <ul>
        {loop="$v0->getMenu()" as $v1}
          <li><a href="{$v1->allurl}">{$v1}</a> [{$v1->active}]</li>
          {if="$v1->hasMenu()"}
            <ul>
            {loop="$v1->getMenu()" as $v2}
              <li><a href="{$v2->allurl}">{$v2}</a> [{$v2->active}]</li>
              {if="$v2->hasMenu()"}
                <ul>
                {loop="$v2->getMenu()" as $v3}
                  <li><a href="{$v3->allurl}">{$v3}</a> [{$v3->active}]</li>
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
{**}
title: <b>{$menu->getTitle()}</b><br />
tpl: {$menu->getTplAddress()}<br />

{*
  {$menu->getUri()|var_dump}
$menu->getTitle()|print_r:true

<a href="...." title="{@Trainz CSU: Oficiální stránky Trainz Railroad Simulator a Trainz Classics CZ, SK@}" id="trainznazev">{@Trainz CSU: Oficiální stránky Trainz Railroad Simulator a Trainz Classics CZ, SK XYZ@}</a>

<a href="...." title="{@Trainz CSU: Oficiální stránky Trainz Railroad Simulator a Trainz Classics CZ, SK|Trainz CSU: Oficiální stránky Trainz Railroad Simulator a Trainz Classics CZ, SK5|1@}" id="trainznazev">{@Trainz CSU: Oficiální stránky Trainz Railroad Simulator a Trainz Classics CZ, SK XYZ|Trainz CSU: Oficiální stránky Trainz Railroad Simulator a Trainz Classics CZ, SK XYZ6|1@}</a>

*}