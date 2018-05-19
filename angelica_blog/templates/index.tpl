<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="author" content="GMR hosting, www.gmrhosting.cz, www.gfdesign.cz" />
      <title>{$title}</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="{@Oficiální stránky Trainz Railroad Simulator@}" />
      <meta name="robots" content="index, follow" />
      <meta name="viewport" content="width=device-width" />
      <meta name="keywords" content="trainz, train, czech trainz, trainz railroad simulator, trainz simulator, gmax, 3dsmax, cs trainz, cz trainz, TS12" />
      <!-- favicon.ico -->
      {loop="array_merge($configure.menu_css, (array) $menu->getCSS())"}<link rel="stylesheet" type="text/css" href="{$weburl}{$value}" />\n      {/loop}
      {loop="array_merge((array) $configure.menu_js, (array) $menu->getJS('head'))"}<script src="{$weburl}{$value}"></script>\n      {/loop}
  </head>
  <body>
    <span id="body_top"><!-- modre pozadi v oblasti zahlavi --></span>
    <div id="obal_layout">
    <!--[if lte IE 7]>
      <p class="chromeframe">Používáte <strong>zastaralý</strong> prohlížeč. <a href="http://browsehappy.com/">Aktualizujte svůj prohlížeč</a> nebo <a href="http://www.google.com/chromeframe/?redirect=true">aktivujte Google Chrome Frame</a>.</p>
    <![endif]-->
      <noscript>
        <p class="chromeframe">Váš prohlížeč nemá povolený javascript nebo ho nepodporuje!<br />Bez javascriptu nebudou stránky správně fungovat!</p>
      </noscript>
      <header>
        <h1><a href="{$weburl}" title="{$title}" id="trainznazev">{$title}</a></h1>
{compile_file="menu.tpl"}
      </header>
{compile_file="language.tpl"}
      <div id="obal_obsah">
        <span id="body_obsah_top"><!-- skryti pozadi obsahu v oblasti zahlavi --></span>
        <div id="obsah">
{include="$menu->getTplAddress('_')"}
        </div>
      </div>
    </div>
    <div id="zapati">
      <p>Created by <a href="http://www.gfdesign.cz/" title="GMR hosting, www.gmrhosting.cz, www.gfdesign.cz">GMR</a></p>
    </div>
    <script src="{$weburl}js/jquery-1.10.2.min.js"></script>
    <script src="{$weburl}js/bootstrap.min.js"></script>
    <script src="{$weburl}js/plugins.js"></script>
    {loop="$menu->getJS('tail', true)"}<script src="{$weburl}{$value}"></script>\n    {/loop}
{/*
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-17828373-3']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
*/}
  </body>
</html>