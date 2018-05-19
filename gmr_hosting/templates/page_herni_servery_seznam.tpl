    <div class="clear"></div>

    <div class="block_titleline">
      <h1>Herní servery - Seznam</h1>

      <div class="block_search">
        <div class="field"><input type="text" class="w_def_text" title="Hledat"></div>
        <input type="submit" class="button" value="Hledat">
      </div>
    </div>

    <div class="block_breadcrumbs">
      <ul>
        <li><a href="{$weburl}">Home</a></li>
        <li><a href="{$weburl}herni-servery">Herní servery</a></li>
        <li>Seznam</li>
      </ul>
    </div>

    <div class="h_line"></div>
  </header>
  <!-- End Head -->
  
  <div class="separator_1"></div>

  <div class="block_portfolio c_2">

{loop="$nabidka_her_vypis"}
    <div class="portfolio_item">
      <div class="generic_pic_border w_caption play medium">
        <a href="http://www.youtube.com/watch?v=FWUtMsiKhmM" data-rel="prettyPhoto">
          <img src="{$weburl}img/pic_portfolio_2_4.png" alt="">
          <span class="caption">
            <span class="icon"></span>
          </span>
        </a>
      </div>

      <div class="description">
        <p class="title">{$value->nazev}</p>
        <p>{$value->popis}</p>
        <p>{$value->cena},  od: {$value->minslotu}, do: {$value->maxslotu}, <a href="{$weburl}objednavka/{$value->url}">objednat?</a> <a href="{$weburl}herni-server/{$value->url}">informace</a></p>
        <a href="#" class="generic_button"><span>Learn More</span></a>
      </div>
    </div>

{/loop}

    <div class="clear"></div>
  </div>

  <div class="h_line"></div>
  <div class="separator_3"></div>

  <div class="block_pager fright">
    <ul>
      <li class="prev"><a href="#"><span></span></a></li>
      <li class="first"><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li class="current"><a href="#">3</a></li>
      <li class="last"><a href="#">4</a></li>
      <li class="next"><a href="#"><span></span></a></li>
    </ul>
  </div>



{*
    <a href="{$weburl}objednavka/{$value->nazev}">objednat (1.polozka k objednavce, prejit na stranku objednavky a zbytek poslat postem)</a>
    <a href="{$weburl}herni-server/{$value->nazev}">informace (rozkliknuti samotne hry, rozkliknout nad herni-server nebo informace?)</a>
*}
