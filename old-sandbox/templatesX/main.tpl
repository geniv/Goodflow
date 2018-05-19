

example template...

sekce: {$sekce}

{*
{ *$menu|print_r:true* }
{ *$value|print_r:true* }

{noparse}
<form name="frm">
  <fieldset>
    <input name="cosik" type="text" value="5">
    <input type="checkbox" name="chck" value="anoo">
    <input type="button" value="spočítat příklad" onclick="vypocet();">
  </fieldset>
</form>

<script>
//~ var a = prompt('zadej A', 5);
//~ var b = prompt('zadej b', 4);
//~ document.write(parseFloat(a)+parseFloat(b)+": "+Math.sqrt(64));

function vypocet() {
  //~ document.write(document.frm.cosik.value);
  document.write(document.frm.chck.checked);
}
</script>
{/noparse}


hlavni menu:<br />

  <nav>
    <ul>
      {loop="$menu->getMenu(0, array('a' => 55))" as $key => $value}
       <li>
         <a href="{$weburl}{$value->allurl}" class="current" title="{$value->name}">
           <i class="icon-map-marker"></i>
           {$value->name}
         </a>
       </li>{$value|print_r:true} 
      {/loop}
    </ul>
  </nav>

  <ul id="main-nav">
    {loop="$menu2->getMenu(2, null)" as $key => $value}
     <li>
       <a href="#" class="nav-top-item current" >{$value->name}</a>
       <ul>
          {loop="$value->submenu" as $k => $v}
          <li><a href="{$weburl}{$sekce}/{$v->allurl}"{if="$value->active"} class="active"{/if}>{$v->name}</a></li>{$v|print_r:true}
          {else}{$url = array_merge(array($weburl . $sekce), $value->lasturl)}
          <li><a href="{$url|implode:'/'}"{if="$value->active"} class="active"{/if}>{$value->name}</a></li>{$value|print_r:true}
          {/loop}
       </ul>
     </li>{ *$value|print_r:true* }
    {/loop}
  </ul>
*}
