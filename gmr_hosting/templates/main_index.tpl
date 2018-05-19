
  <!--[if lte IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<!-- Header -->
<div id="obal_layout">
<div class="container obal_obsah">
  <header>
    <div class="row top_row">
      <div class="user_logreg">{if="$index_user_isloggedin"}přihlášen jako: <a href="{$weburl}{$index_user_link}">{$index_user_login}</a> / <a href="{$weburl}{$index_user_logout}">odhlásit se</a>{else}<a href="{$weburl}prihlasit-se" title="Přihlásit se">Přihlásit se</a> / <a href="{$weburl}registrace" title="Registrace">Registrace</a>{/if}</div>
      <div class="follow_us">
          <span>Najdete nás:</span>
          <a href="http://steamcommunity.com/groups/gmrhosting" class="steam" title="Komunita služby Steam :: Skupina :: [CZ] GMR hosting"></a>
          <a href="https://plus.google.com/communities/114305119229743892676" class="gplus" title="GMR hosting – Google+"></a>          
          <a href="https://twitter.com/GMRhosting" class="tweeter" title="GMR Hosting (GMRhosting) na Twitteru"></a>
          <a href="http://www.facebook.com/pages/GMR-hosting/462150543833686" class="facebook" title="GMR hosting - Facebook"></a>
      </div>
      <div class="clear"></div>
    </div>
    <div class="logo">
      <a href="{$weburl}">GMRHOSTING<span class="yellow">.</span>CZ</a>
      <a href="{$weburl}" class="sub_txt">Hosting herních serverů</a>
    </div>
    <div class="menu">
      <nav>
        <ul>{loop="$web->getMenu()" as $val}{$li_class = implode(' ', array_filter(array( ($val->poc == 0 ? 'first' : ''), ($val->poc + 1 == $val->count ? 'last' : ''), ($val->active ? 'active' : '') )))}
          <li{if="$li_class"} class="{$li_class}"{/if}>
            <a href="{$weburl}{$val->allurl}">{$val->name}</a>{if="$val->submenu"}
            <ul>{loop="$val->submenu|array_slice:1" as $v}{$li_class = implode(' ', array_filter(array( ($v->poc == 1 ? 'first' : ''), ($v->poc == $v->count - 1 ? 'last' : ''), ($v->active ? 'active' : '') )))}
              <li{if="$li_class"} class="{$li_class}"{/if}>
                <a href="{$weburl}{$v->allurl}">{$v->menu}</a>
              </li>{/loop}
            </ul>{/if}
          </li>{/loop}
        </ul>
      </nav>
    </div>  
{$index_content}
</div>
<!-- footer -->
<footer>
  <div id="footer">
    <div class="container">
      <div class="row-fluid">
        <div class="span4">
          <section class="novinky_zapati">
            <h3>Novinky</h3>
{loop="$index_novinky_vypis"}{$pridano = strtotime($value->pridano)}
            <div class="post{if="$counter1 == 0"} first{/if}">
              <div class="pic"><div class="generic_pic_border"><img src="{$weburl}img/spravce_{$value->idspravce}.png" alt="" /></div></div>
              <div class="text">
                <p><a href="{$weburl}{$index_novinky_link}/{$value->url}">{$core::trimMarker($value->nadpis, 60)}</a></p>
                <p class="date">{date="j", $pridano}. {$core::getCzechMonth($pridano, false)} {date="Y", $pridano}</p>
              </div>
            </div>
{/loop}
            <a href="{$weburl}{$index_novinky_link}" class="novinky_link_all">Více zde...</a>
          </section>
        </div>
        <div class="span3">
          <section class="interesting_links">
            <h3>Další sekce</h3>

            <ul>
              <li><a href="{$weburl}donate">Donate</a></li>
              <li><a href="{$weburl}verejne-servery">Veřejné servery</a></li>
              <li><a href="{$weburl}statistiky">Statistiky</a></li>
              <li><a href="{$weburl}faq">FAQ</a></li>
              <li><a href="{$weburl}navody">Návody</a></li>
            </ul>
          </section>
        </div>
        <div class="span5">
          <section class="twitter_widget">
            <h3>Naposledy přidané balíčky</h3>

            <div class="post first">
              <p>Premium Web Templates and Themes for professionals business work with <a href="#">http://brong.lt/rIGkm67</a></p>
              <p class="date">24 minnutes ago</p>
            </div>

            <div class="post">
              <p>Premium Web Templates and Themes for professionals business work with <a href="#">http://brong.lt/rIGkm67</a></p>
              <p class="date">24 minnutes ago</p>
            </div>

            <div class="post">
              <p>Premium Web Templates and Themes for professionals business work with <a href="#">http://brong.lt/rIGkm67</a></p>
              <p class="date">24 minnutes ago</p>
            </div>

          </section>
        </div>

      </div>

      <div class="row bottom_row">

        <div class="ostatni_odkazy_vlevo">
          <p><a href="{$weburl}{$configure.htmlpage.urladmin}">Admin</a></p>
        </div>

        <div class="ostatni_odkazy_vpravo">
          <p><a href="#" title="Nahoru" id="odkaz_nahoru" onclick="$.scrollTo('header', 2000, {easing: 'easeOutExpo'}); return false;">Nahoru</a></p>
        </div>

      </div>
    </div>
  </div>
</footer>
<!-- footer end -->
</div>

  <!-- Google Analytics -->
