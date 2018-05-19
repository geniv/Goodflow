<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="author" content="GMR hosting, www.gmrhosting.cz, Fajagama" />
      <title>{@Killing Floor - vše o public servrech od GMRhosting.cz@}</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="{@Killing Floor - vše o public servrech od GMRhosting.cz@}" />
      <meta name="robots" content="noindex, nofollow" />
      <meta name="viewport" content="width=device-width" />
      <meta name="keywords" content="KF, Killing Floor, public server, gmrhosting, GMR, servrery" />

      <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

      <link rel="stylesheet" type="text/css" href="{$weburl}css/normalize.css" />
      <link rel="stylesheet" type="text/css" href="{$weburl}css/bootstrap.min.css" />
      <link rel="stylesheet" type="text/css" href="{$weburl}css/main.css" />
      <link rel="stylesheet" type="text/css" href="{$weburl}css/bootstrap-responsive.min.css" />
      <script src="{$weburl}js/vendor/modernizr-2.6.2.min.js"></script>
  </head>
  <body>
    <span id="body_top"></span>
    <div id="obal_layout">
    <!--[if lt IE 7]>
      <p class="chromeframe">Používáte <strong>zastaralý</strong> prohlížeč. Prosím, <a href="http://browsehappy.com/">aktualizujte svůj prohlížeč</a> nebo <a href="http://www.google.com/chromeframe/?redirect=true">aktivujte Google Chrome Frame</a> pro zlepšení Vašich zkušeností.</p>
    <![endif]-->
      <header>
        <a href="{$weburl}" title="{@Killing Floor - vše o public servrech od GMRhosting.cz@}" id="kfnazev">{@Killing Floor - vše o public servrech od GMRhosting.cz@}</a>
{include="menu"}
      </header>



      <div id="obal_obsah">
        <span id="body_obsah_top"></span>
        <div id="obsah">
{include="implode('/', $menu->getActiveAddress())"}

        </div>
      </div>
    </div>

<div id="zapati">

zapati

</div>


    <script src="{$weburl}js/jquery-1.10.2.min.js"></script>
    <script src="{$weburl}js/bootstrap.min.js"></script>
    <script src="{$weburl}js/plugins.js"></script>
    <!-- <script src="{$weburl}js/main.js"></script> -->
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. 
    <script>
      var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src='//www.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
    -->
  </body>
</html>
