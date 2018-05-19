<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{$title}</title>
        <meta name="description" content="{$title}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        {loop="array_merge($configure.global_css, (array) $menu->getCSS())"}<link rel="stylesheet" href="{$weburl}{$value}">\n        {/loop}
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-default" role="navigation">
                            <div class="navbar-header">
                                <a href="{$weburl}" class="navbar-brand navbar-left visible-xs" title="{$title}">{$title}</a>
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-left">
                                    {loop="$menu->getMenu()" as $v0}<li{$v0->active ? ' class="active"' : ''}><a href="{$v0->allurl}"{$v0->active ? ' class="active"' : ''} title="{$v0->name}">{$v0->name}</a></li>{/loop}
                                </ul>
                                <a href="{$weburl}" class="navbar-brand navbar-right hidden-xs" title="{$title}">{$title}</a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="container">
{include="$menu->getTplAddress('_')"}

                {loop="array_merge($configure.global_js, (array) $menu->getJS())"}<script src="{$weburl}{$value}"></script>\n                {/loop}
            </div>
        </div>
    </body>
</html>