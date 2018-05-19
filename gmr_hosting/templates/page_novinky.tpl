    <div class="clear"></div>

    <div class="block_titleline">
      <h1>Novinky</h1>

      <div class="block_search">
        <div class="field"><input type="text" class="w_def_text" title="Hledat"></div>
        <input type="submit" class="button" value="Hledat">
      </div>
    </div>

    <div class="block_breadcrumbs">
      <ul>
        <li><a href="{$weburl}">Home</a></li>
        <li>{if="$novinky_drobecek"}<a href="{$weburl}{$novinky_link}">{/if}Novinky{if="$novinky_drobecek"}</a>{/if}</li>
        {if="$novinky_drobecek"}<li>{$novinky_drobecek}</li>{/if}
      </ul>
    </div>

    <div class="h_line"></div>
  </header>
  <!-- End Head -->
  <section class="novinky_vypis">
{loop="$novinky_vypis"}{$pridano = strtotime($value->pridano)}
    <div class="post">
      <div class="pic"><div class="generic_pic_border"><img src="{$weburl}img/spravce_{$value->idspravce}.png" alt="" /></div></div>
      <div class="text">
        <div class="oddelovac_nov">
          <p class="nov_nadpis">{if="!$uri_id"}<a href="{$weburl}{$novinky_link}/{$value->url}">{$value->nadpis}</a>{else}{$value->nadpis}{/if}</p>
          <p class="date">{$core::getCzechDay($pridano)} {date="j", $pridano}. {$core::getCzechMonth($pridano, false)}&nbsp;{date="Y", $pridano}, {date="H:i", $pridano}</p>
        </div>
        {$value->zprava}
      </div>
    </div>
{/loop}

  </section>