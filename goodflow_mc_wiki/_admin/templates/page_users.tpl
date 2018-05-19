
toto je admin stranka sprava uživatelů

{if="!$url_blok"}
<a href="{$addLink}">přidat uživatele</a>
{/if}

{if="$url_blok=='add'"}
toto je přidávní uživatelů!
{/if}

{$output}
{loop="$formOut"}<span>{$value}</span>{/loop}

{if="$dbVypis"}
<ul>{loop="$dbVypis"}
  <li>
    {$value->getString('login')} 
    {$value->getString('role')} 
    {$value->getString('pridano')} 
    {$value->getString('upraveno')} 
    <a href="{$editLink}/{$value->getString('iduser')}">editorvat</a>
    <a href="{$delLink}/{$value->getString('iduser')}" onclick="return confirm(\'opravdu smazat uživatele  {$value->getString('login')} ??\')">smazat</a>
  </li>
{else}
no to je fejlicek nooo, proste nic tu neni nooo...
{/loop}</ul>
{/if}



{*function="print_r($dbVypis, true)"*}
{*$result*}
  

