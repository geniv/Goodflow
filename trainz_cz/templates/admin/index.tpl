{code}
  $browser = classes\UserAgentString::isBrowser(array('Chrome', 'Android Webkit Browser', 'Firefox', 'Opera'));
{/code}{if="!$user->isLoggedIn()"}<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>Trainz.cz - Admin</title>
    <meta name="robots" content="noindex, nofollow" />
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/bootstrap/css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/fonts/ptsans/stylesheet.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/fonts/icomoon/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/login.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/mws-theme.css" media="screen" />
  </head>
<body>
{if="!$browser"}
<div class="hero-unit"><img src="{$weburl}admin_template/images/ieblock.jpg" class="img-rounded"></div>
<p class="chromeframe">Používáte <strong>nedoporučovaný</strong> prohlížeč. <a href="http://www.mozilla.org/cs/firefox/new/">Použij Firefox</a> nebo <a href="https://www.google.com/intl/cs/chrome/browser/">Použij Chrome</a></p>
{/if}
<div id="mws-login-wrapper">
  <div id="mws-login">
    <h1>Vstup do Administrace</h1>
    <div class="mws-login-lock"><i class="icon-lock"></i></div>
    <div id="mws-login-form">
{code}
$code = '
  <div class="mws-form-row mws-form-row2">
    <div class="mws-form-item">
      {text:login|$|placeholder|:|username|,|class|:|mws-login-username required|@|filled|:|Musí být vyplněn username!}
    </div>
  </div>
  <div class="mws-form-row mws-form-row2">
    <div class="mws-form-item">
      {password:hash|$|placeholder|:|password|,|class|:|mws-login-password required|@|filled|:|Musí být vyplněn password!}{hidden:screen|$|id|:|hid_scr}
    </div>
  </div>
  <div class="mws-form-row mws-form-row2">';
  if ($browser) {
    $code .= '{submit:;Přihlásit se|$|class|:|btn btn-success btn-success25 mws-login-button ff-correct}';
  } else {
    $code .= '<a href="http://www.mozilla.org/cs/firefox/new/" class="btn btn-success btn-success25">Použij Firefox</a> <span>nebo</span> <a href="https://www.google.com/intl/cs/chrome/browser/" class="btn btn-success btn-success25 pull-right">Použij Chrome</a>';
  }
  $code .= '</div>
  <div class="mws-form-row3">
    <a href="'.$weburl.'" title="Přejít na stránky" class="btn btn-primary btn-primary39 w-100-pr">Přejít na stránky</a>
  </div>';
$loginForm = classes\TplForm::compile($code, array('class'=>'mws-form'))->setAutoHide(true)->setSubmitBlocker(false);
{/code}
{$loginForm}
      {if="$loginForm->isSubmitted()"}
        {if="$loginForm->isValid()"}
          {$val = $loginForm->getValues()}
          {if="$user->login($val.login, $val.hash)->isLoggedIn()"}
            {code}
              //~ $upload_user->login($val['login'], $val['hash']);
              $crate->addLastLogin($user->getId(), $val['screen'], false);
              classes\Core::setLocation($weburl_admin . 'home/');
            {/code}
          {else}
      <div class="mws-form-row mws-form-row2">
        <div class="mws-form-message error no-pointer">
          Nastala chyba:
          <ul>
            <li>Zadal jsi špatné přihlašovací údaje!</li>
          </ul>
        </div>
      </div>
      <div class="mws-form-row3">
        <a href="{$weburl}" title="Přejít na stránky" class="btn btn-primary btn-primary39 w-100-pr">Přejít na stránky</a>
      </div>
          {/if}
        {else}
      <div class="mws-form-row mws-form-row2">
        <div class="mws-form-message error no-pointer">
          Nastaly tyto chyby:
          <ul>
            {loop="$loginForm->getErrors()"}<li>{$value}</li>{/loop}
          </ul>
        </div>
      </div>
        {/if}
      {/if}
    </div>
  </div>
</div>
<script src="{$weburl}admin_template/js/libs/jquery-1.8.3.min.js"></script>
<script src="{$weburl}admin_template/js/libs/jquery.placeholder.min.js"></script>
<script src="{$weburl}admin_template/jui/js/jquery-ui-effects.min.js"></script>
<script src="{$weburl}admin_template/plugins/validate/jquery.validate-min.js"></script>
<script src="{$weburl}admin_template/js/core/login.js"></script>
<script>$('#hid_scr').val(JSON.stringify({availWidth:screen.availWidth,availHeight:screen.availHeight,availTop:screen.availTop,availLeft:screen.availLeft,pixelDepth:screen.pixelDepth,colorDepth:screen.colorDepth,width:screen.width,height:screen.height}));</script>
{else}<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <!-- Viewport Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=0, maximum-scale=1.0">
    <title>Trainz.cz - Admin</title>
    <meta name="robots" content="noindex, nofollow" />

    <!-- Plugin Stylesheets first to ease overrides -->
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/custom-plugins/wizard/wizard.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/plugins/select2-3.4.2/select2.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/plugins/ibutton/jquery.ibutton.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/plugins/imgareaselect/css/imgareaselect-default.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/plugins/jgrowl/jquery.jgrowl.css" media="screen">

    <!-- Required Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/bootstrap/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/fonts/ptsans/stylesheet.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/fonts/icomoon/style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/fonts/font-awesome/font-awesome.css" media="screen">

    <!-- MWS icons -->
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/mws-style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/icons/icol16.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/icons/icol32.css" media="screen">

    <!-- Components Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/main.css" media="screen">

    <!-- jQuery-UI Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/jui/css/jquery.ui.all.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/jui/jquery-ui.custom.css" media="screen">

    <!-- Theme Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/mws-theme.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/css/themer.css" media="screen">

    <!-- Plugin Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{$weburl}admin_template/plugins/treeview/jquery.treeview.css" media="screen">
  </head>
<body>
{code}//<?
  if (isset($uri['block']) && $uri['block'] == 'logout') {
    $user->logout();
    classes\Core::setLocation($weburl_admin);
  }

  $msg = null;
  $user->revalidate();  //var_dump($acl_resource);
  if (!$user->isAllowed($acl_resource, 'show')) {
    if ($user->isLoggedIn()) {
      $msg = '<div class="mws-form-message error"><h3>Bylo nastaveno špatné oprávnění</h3></div>';
      $user->logout();
      classes\Core::setRefresh(3, $weburl);
    } else {
      classes\Core::setLocation($weburl);
    }
  }
{/code}
  <!-- Header -->
  <div id="mws-header" class="clearfix">
    <!-- Logo Container -->
    <div id="mws-logo-container">
      <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
      <div id="mws-logo-wrap">
        <img src="{$weburl}admin_template/images/trainz-admin-logo.png" alt="mws admin">
      </div>
    </div>
    <!-- User Tools (notifications, logout, profile, change password) -->
    <div id="mws-user-tools" class="clearfix">
      {if="$user->isAllowed('messages', 'show')"}<!-- Zpravy -->
      <div class="mws-dropdown-menu">
        <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-envelope"></i></a>
        <!-- Pocet neprectenych zprav -->
        {if="($count = $crate->getCountNotification($crate::TYPE_MESSAGE)) > 0"}<span class="mws-dropdown-notif">{$count}</span>{/if}
        <!-- Rozbalovaci menu -->
        <div class="mws-dropdown-box">
          <div class="mws-dropdown-content">
            <ul class="mws-messages">
              {loop="$crate->getListNotification($crate::TYPE_MESSAGE)"}
              <li>
                <a href="{$weburl_admin}messages/show/{$value->idnotification}">
                  <span class="message">
                    {$crate->getMsgTypeNotification($value->type)}
                  </span>
                  <span class="time">
                    {$core::getCzechDateTime($value->added)}
                  </span>
                </a>
              </li>
              {emptyloop}
              <li>
                <em>Žádné nové</em>
              </li>
              {/loop}
            </ul>
            <div class="mws-dropdown-viewall">
              <a href="{$weburl_admin}messages/">Zobrazit všechny zprávy</a>
            </div>
          </div>
        </div>
      </div>{/if}
      {if="$user->isAllowed('users/new', 'show')"}<!-- Uzivatele -->
      <div class="mws-dropdown-menu">
        <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-users"></i></a>
        <!-- Pocet nove registrovanych -->
        {if="($count = $crate->getCountNotification($crate::TYPE_REGISTRATION)) > 0"}<span class="mws-dropdown-notif">{$count}</span>{/if}
        <!-- Rozbalovaci menu -->
        <div class="mws-dropdown-box">
          <div class="mws-dropdown-content">
            <ul class="mws-notifications">
              {loop="$crate->getListNotification($crate::TYPE_REGISTRATION)"}
              <li>
                <a href="{$weburl_admin}users/new/show/{$value->idnotification}">
                  <span class="message">
                    {$crate->getMsgTypeNotification($value->type)}
                  </span>
                  <span class="time">
                    {$core::getCzechDateTime($value->added)}
                  </span>
                </a>
              </li>
              {emptyloop}
              <li>
                <em>Žádný nový</em>
              </li>
              {/loop}
            </ul>
            <div class="mws-dropdown-viewall">
              <a href="{$weburl_admin}users/new/">Zobrazit všechny nově registrované</a>
            </div>
          </div>
        </div>
      </div>{/if}
      {if="$user->isAllowed('slideshows/new', 'show')"}<!-- Slideshow -->
      <div class="mws-dropdown-menu">
        <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-pictures"></i></a>
        <!-- Pocet nove pridanych -->
        {if="($count = $crate->getCountNotification($crate::TYPE_SLIDESHOW)) > 0"}<span class="mws-dropdown-notif">{$count}</span>{/if}
        <!-- Rozbalovaci menu -->
        <div class="mws-dropdown-box">
          <div class="mws-dropdown-content">
            <ul class="mws-notifications">
              {loop="$crate->getListNotification($crate::TYPE_SLIDESHOW)"}
              <li>
                <a href="{$weburl_admin}slideshows/new/show/{$value->idnotification}">
                  <span class="message">
                    {$crate->getMsgTypeNotification($value->type . ($value->state_old_id ? '_edit' : null))}
                  </span>
                  <span class="time">
                    {$core::getCzechDateTime($value->added)}
                  </span>
                </a>
              </li>
              {emptyloop}
              <li>
                <em>Žádné nové</em>
              </li>
              {/loop}
            </ul>
            <div class="mws-dropdown-viewall">
              <a href="{$weburl_admin}slideshows/new/">Zobrazit všechny nově přidané</a>
            </div>
          </div>
        </div>
      </div>{/if}
      {if="$user->isAllowed('downloads/new', 'show')"}<!-- Download -->
      <div class="mws-dropdown-menu">
        <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-box-add"></i></a>
        <!-- Pocet nove pridanych -->
        {if="($count = $crate->getCountNotification($crate::TYPE_DOWNLOAD)) > 0"}<span class="mws-dropdown-notif">{$count}</span>{/if}
        <!-- Rozbalovaci menu -->
        <div class="mws-dropdown-box">
          <div class="mws-dropdown-content">
            <ul class="mws-notifications">
              {loop="$crate->getListNotification($crate::TYPE_DOWNLOAD)"}
              <li>
                <a href="{$weburl_admin}downloads/new/show/{$value->idnotification}">
                  <span class="message">
                    {$crate->getMsgTypeNotification($value->type . ($value->state_old_id ? '_edit' : null))}
                  </span>
                  <span class="time">
                    {$core::getCzechDateTime($value->added)}
                  </span>
                </a>
              </li>
              {emptyloop}
              <li>
                <em>Žádné nové</em>
              </li>
              {/loop}
            </ul>
            <div class="mws-dropdown-viewall">
              <a href="{$weburl_admin}downloads/new/">Zobrazit všechny nově přidané</a>
            </div>
          </div>
        </div>
      </div>{/if}
      <!-- User Information and functions section -->
      <div id="mws-user-info" class="mws-inset">
        <!-- User Photo -->
        <div id="mws-user-photo">
          <div id="obal-user-photo">
            <img src="{$weburl}img/avatars/{$user->getData('avatar')}" alt="Avatar" onerror="this.src='{$weburl}img/avatars/no-profile-img.png'" />
          </div>
        </div>
        <!-- Username and Functions -->
        <div id="mws-user-functions">
          <div id="mws-username">
            {$user->getData('login')}{if="$user->getData('alias')"} ({$user->getData('alias')}){/if}
          </div>
          <ul>
            <li><a href="{$weburl}">Přejít na stránky</a></li>
            <li><a href="{$weburl_admin}logout">Odhlásit se</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Start Main Wrapper -->
  <div id="mws-wrapper">
    <!-- Necessary markup, do not remove -->
    <div id="mws-sidebar-stitch"></div>
    <div id="mws-sidebar-bg"></div>
    <!-- Sidebar Wrapper -->
    <div id="mws-sidebar">
      <!-- Hidden Nav Collapse Button -->
      <div id="mws-nav-collapse">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- Searchbox -->
{code}
  $access = false;
  if (isset($admin_uri['block']) && isset($admin_uri['subblock']) && isset($configure['admin']['search'][$admin_uri['block']])) {
    $access = in_array($admin_uri['subblock'], $configure['admin']['search'][$admin_uri['block']]);
  }
{/code}
      <div id="mws-searchbox" class="mws-inset">
        <form method="post" action="{$weburl_admin}search/{if="isset($admin_uri['block'])"}{$admin_uri.block}{if="isset($admin_uri['subblock'])"}/{$admin_uri.subblock}{/if}{/if}">
          <input type="text" class="mws-search-input" name="search" placeholder="{$access ? 'Hledat...' : 'Zde není co hledat!'}"{$access ? null : ' disabled'}>
          <button type="submit" class="mws-search-submit"{$access ? null : ' disabled'}><i class="icon-search"></i></button>
        </form>
      </div>
      <!-- Main Navigation -->
{compile_file="admin/menu.tpl"}
    </div>
    <!-- Main Container -->
    <div id="mws-container" class="clearfix">
      <!-- Inner Container -->
      <div class="container">
        <noscript>
          <div class="mws-form-message error clearfix"><h3>Váš prohlížeč nemá povolený javascript nebo ho nepodporuje!</h3><h3>Bez javascriptu nebude fungovat administrace!</h3></div>
        </noscript>
{$msg}{include="'admin/'.$admin_menu->getTplAddress('_')"}
      </div>
      <!-- Footer -->
      <div id="mws-footer">
        Při neaktivitě budete automaticky odhlášen v: {$core::getCzechDateTime($user->getExpirationTime(), true)} | Created by <a href="http://www.gfdesign.cz/" title="GMR hosting, www.gmrhosting.cz, www.gfdesign.cz">GMR</a>
      </div>
    </div>
  </div>

  <!-- JavaScript Plugins -->
  <script src="{$weburl}admin_template/js/libs/jquery-1.8.3.min.js"></script>
  <script src="{$weburl}admin_template/custom-plugins/fileinput.js"></script>

  <!-- jQuery-UI Dependent Scripts -->
  <script src="{$weburl}admin_template/jui/js/jquery-ui-1.9.2.min.js"></script>
  <script src="{$weburl}admin_template/jui/jquery-ui.custom.min.js"></script>

  <!-- Plugin Scripts -->
  <script src="{$weburl}admin_template/plugins/autosize/jquery.autosize.min.js"></script>
  <script src="{$weburl}admin_template/plugins/select2-3.4.2/select2.min.js"></script>
  <script src="{$weburl}admin_template/plugins/select2-3.4.2/select2_locale_cs.js"></script>
  <script src="{$weburl}admin_template/plugins/validate/jquery.validate-min.js"></script>
  <script src="{$weburl}admin_template/plugins/ibutton/jquery.ibutton.min.js"></script>
  <script src="{$weburl}admin_template/plugins/imgareaselect/jquery.imgareaselect.min.js"></script>
  <script src="{$weburl}admin_template/plugins/maskedinput/jquery.numberMask.js"></script>
  <script src="{$weburl}admin_template/plugins/treeview/jquery.treeview.js"></script>
  <script src="{$weburl}admin_template/plugins/jgrowl/jquery.jgrowl-min.js"></script>

  <!-- Core Script -->
  <script src="{$weburl}admin_template/bootstrap/js/bootstrap.min.js"></script>
  <script src="{$weburl}admin_template/js/core/mws.js"></script>

  {loop="$admin_menu->getJS()"}<script src="{$weburl}{$value}"></script>\n  {/loop}

  <!-- Components Scripts -->
  <script src="{$weburl}admin_template/js/components/main.js"></script>

  <!-- Plugin Scripts -->
  <script type="text/javascript" src="{$weburl}js/tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: ".mws-form-row .tiny-novinky textarea",
      language: 'cs',
      relative_urls: false,
      remove_script_host: false,
      autoresize_on_init: false,
      autoresize_bottom_margin: 15,
      autoresize_min_height: 200,
      autoresize_max_height: 500,
      resize: true,
      paste_as_text: true,
      height: 200,
        plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen autoresize",
          "insertdatetime media table contextmenu paste emoticons textcolor nonbreaking"
        ],
      toolbar: "newdocument print | undo redo | styleselect | bold italic underline | removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media emoticons | forecolor backcolor | hr anchor charmap | searchreplace | code preview fullscreen"
    });
    tinymce.init({
      selector: ".mws-form-row .tiny-download textarea",
      language: 'cs',
      relative_urls: false,
      remove_script_host: false,
      autoresize_on_init: false,
      autoresize_bottom_margin: 15,
      autoresize_min_height: 200,
      autoresize_max_height: 500,
      height: 200,
      menubar : false,
      resize: true,
      paste_as_text: true,
        plugins: [
          "advlist autolink lists link charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen autoresize",
          "insertdatetime table contextmenu paste emoticons textcolor nonbreaking"
        ],
      toolbar: "newdocument print | undo redo | styleselect | bold italic underline strikethrough superscript subscript | removeformat | table | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link emoticons | forecolor backcolor | hr anchor charmap | searchreplace | visualblocks visualchars | code preview fullscreen"
    });

    $("#navigation-treeview").css('display', 'block');
    $("#navigation-treeview").treeview({
        persist: "location",
        animated: "fast",
        collapsed: false,
        unique: false
    });

    $('#sortable').sortable({
        placeholder: 'grid_2 mws-panel grid_2_podklad',
        tolerance: 'pointer',
        scrollSensitivity: 40,
        scrollSpeed: 30,
        revert: 300,
        opacity: 0.6,
        cursor: 'move',
        delay: 150,
        update: function(event, ui) {
            $.post('{$weburl}ajax.php', {'type': 'sortableversion', 'value': $(this).sortable('serialize')}, function(data) {
              if (data > 0) {
                $.jGrowl('Pořadí bylo změněno!', {
                  position: 'bottom-right'
                });
              }
            });
          }
    });
{/*
    $("#sortable-cdp").sortable({
        placeholder: "grid_cdp_podklad",
        tolerance: 'pointer',
        scrollSensitivity: 40,
        scrollSpeed: 30,
        revert: 300,
        opacity: 0.6,
        cursor: 'move',
        delay: 150,
        update: function(event, ui) {
            $.post('{$weburl}ajax.php', {'type': 'sortablecdp', 'value': $(this).sortable("serialize")}, function(data) {
              if (data > 0) {
                $.jGrowl("Pořadí bylo změněno!", {
                  position: "bottom-right",
                  afterOpen: function(e,m,o) {
                      window.location.reload();
                    }
                });
              }
            });
          }
    });
*/}
    $('.kategorie-treeview ul').sortable({
        tolerance: 'pointer',
        scrollSensitivity: 40,
        scrollSpeed: 30,
        revert: 300,
        opacity: 0.6,
        cursor: 'move',
        delay: 150,
        update: function(event, ui) {
          $.post('{$weburl}ajax.php', {'type': 'sortablecategory', 'value': $(this).sortable('serialize')}, function(data) {
              if (data > 0) {
                $.jGrowl('Pořadí bylo změněno!', {
                  position: 'bottom-right'
                });
              }
            });
        }
    });

    $('#sortable_links_1, #sortable_links_2').sortable({
        placeholder: 'grid_4_podklad',
        tolerance: 'pointer',
        scrollSensitivity: 40,
        scrollSpeed: 30,
        revert: 300,
        opacity: 0.6,
        cursor: 'move',
        delay: 150,
        update: function(event, ui) {
            $.post('{$weburl}ajax.php', {'type': 'sortablelinks', 'value': $(this).sortable('serialize')}, function(data) {
              if (data > 0) {
                $.jGrowl('Pořadí bylo změněno!', {
                  position: 'bottom-right'
                });
              }
            });
          }
    });

    function downloadCDP(id, ret, reckon) {
      $.post('{$weburl}ajax.php', {'type': 'download_cdp', 'id': id, 'reckon': reckon}, function(data) {
        var jdata = jQuery.parseJSON(data);
        if (ret) {
          $(ret+id).html(jdata.counter+'x');
        }
        window.location = '{$weburl}down.php?name='+jdata.name+'&path='+jdata.path;
      });
      return false;
    }

    function getHostName(ret, ip) { // nacitani host
      $.post('{$weburl}ajax.php', {'type': 'hostname', 'ip': ip}, function(data) {
        $(ret).html(data);
      });
    }

    $("select.mws-select2").select2();

  {if="isset($admin_uri['block']) && $admin_uri['block'] == 'downloads'"}
{code}
//~ var_dump($_POST);
//~ var_dump($uri);
//~ var_dump($admin_uri);

$version = '[]';
$cdp_file = '[]';
$kuid_cdp = '[]';
$kuid_cdp_plain = '[]';

if (isset($uri['block']) && $uri['block'] == 'downloads') {
  if (isset($uri['subblock']) && $uri['subblock'] == 'add') {
    $version = isset($_POST['version']) ? json_encode($_POST['version']) : '[]';
    $kuid_cdp = isset($_POST['kuid_cdp']) ? json_encode($_POST['kuid_cdp']) : '[]';
    $kuid_cdp_plain = isset($_POST['kuid_cdp_plain']) ? json_encode($_POST['kuid_cdp_plain']) : '[]';
  }

  if (isset($uri['subblock']) && $uri['subblock'] == 'edit' && is_numeric($uri['subaction'])) {
    $iddownload = $uri['subaction'];

    $cdp = $db->rawQuery('SELECT idtrainz_cdp, name FROM trainz_cdp
                          JOIN downloads_has_trainz_cdp USING(idtrainz_cdp)
                          WHERE iddownload=?', array($iddownload));

    $cdp_file_db = array();
    $version_db = array();
    $kuid_cdp_db = array();
    foreach ($cdp as $v) {
      $cdp_file_db[] = $v;
      $c = $db->rawQuery('SELECT idtrainz_version FROM trainz_versions
                          JOIN trainz_cdp_has_trainz_versions USING(idtrainz_version)
                          WHERE idtrainz_cdp=?', array($v->idtrainz_cdp))->getAllRows();
      $version_db[] = $c;

      $c = $db->rawQuery('SELECT idtrainz_kuid FROM trainz_kuids
                          JOIN trainz_cdp_has_trainz_kuids _tchtk USING(idtrainz_kuid)
                          WHERE _tchtk.idtrainz_cdp=?', array($v->idtrainz_cdp))->getAllRows();
      $kuid_cdp_db[] = $c;
    }

    $cdp_file = json_encode($cdp_file_db);
    $version = isset($_POST['version']) ? json_encode($_POST['version']) : json_encode($version_db);
    $kuid_cdp = isset($_POST['kuid_cdp']) ? json_encode($_POST['kuid_cdp']) : json_encode($kuid_cdp_db);
    $kuid_cdp_plain = isset($_POST['kuid_cdp_plain']) ? json_encode($_POST['kuid_cdp_plain']) : '[]';
  }
}
{/code}

    function typKuidu(value) {
      if (value.split(':').length > 1) {
        return '&lt;' + (value.split(':').length == 2 ? 'kuid' : 'kuid2') +  ':' + value + '&gt;';
      } else {
        return '&lt;kuid(2):(-)xxxxx:yyyyy(:zzz)&gt;';
      }
    }

    function isKuid(value) {
      var patr = /-?[0-9]+:[0-9]+(?::[0-9]+)?/;
      var m = patr.exec(value);
      return m && value == m[0];
    }

    function in_array(needle, haystack) {
      for(var i in haystack) {
          if(haystack[i] == needle) return true;
      }
      return false;
    }

    // inicializace ciselne validace
    function initValidation() {
      $('.kuid_input_plain').numberMask({pattern:/^[\-0-9\:\\n]+$/});
      $.fn.autosize && $('.autosize').autosize();
      $("select.mws-select2").select2();
    }

    // hromadna validace kuidu
    function validateKuid(value, out_class) {
      var out = 'Formát: &lt;kuid(2):(-)xxxxx:yyyyy(:zzz)&gt;';
      var invalid_poc = 0;
      if (value) {
        var value_split = value.split('\\n');
        out = '';
        for (var v in value_split) {
          out += typKuidu(value_split[v]) + ' <em>&rarr;</em> '+ (isKuid(value_split[v]) ? '<i class="icon-ok-sign"></i>' : '<i class="icon-remove-sign"></i>') + '<br />';
          if (!isKuid(value_split[v])) {
            invalid_poc++;
          }
        }
      }
      $('.addeditbtn_dwn').attr('disabled', invalid_poc != 0);
      $(out_class).html(out);
    }

    function replacePath(name) {
      return name.split('\\\').pop();
    }

    function removeCDP(num) {
      $('.row'+num).remove();
      $.jGrowl("Byl odebrán Oddíl #"+ (num + 1) +" !", {
        position: "bottom-right"
      });
    }

    $(function() {

      // porovnavani velikosti div bloku
      var obal_stare = $('.obal_stare').children('div');
      var obal_nove = $('.obal_nove').children('div');
      var max_count = Math.max(obal_stare.length, obal_nove.length);
      for (var i = 0; i < max_count; i++) {
        var item_max = Math.max(obal_stare.eq(i).height(), obal_nove.eq(i).height());
        obal_stare.eq(i).height(item_max);
        obal_nove.eq(i).height(item_max);
      }

      // nastavovani velikosti td bloku
      var obal_stare_table = $('.obal_stare div table td.tr_ver_hg');
      var obal_nove_table = $('.obal_nove div table td.tr_ver_hg');
      var table_max = Math.max(obal_stare_table.length, obal_nove_table.length);
      for (i = 0; i < table_max; i++) {
        var td_max = Math.max(obal_stare_table.eq(i).height(), obal_nove_table.eq(i).height());
        obal_stare_table.eq(i).height(td_max);
        obal_nove_table.eq(i).height(td_max);
      }


      $('.jenom-cisla').numberMask();

      $('.kuid_input').numberMask({pattern:/^[\-0-9\:]+$/});

      initValidation();

      $('.kuid_input').keyup(function() {
        $('.kuid_format').html(typKuidu(this.value) + ' <em>&rarr;</em> '+ (isKuid(this.value) ? '<i class="icon-ok-sign"></i>' : '<i class="icon-remove-sign"></i>'));
      });

      var data_cdp_file = {$cdp_file};
      var data_version = {$version};  // podle nej se vraci pocet bloku
      var data_kuid_cdp = {$kuid_cdp};
      var data_kuid_cdp_plain = {$kuid_cdp_plain};

      var selectFormat = function(item) { return item.value; };
      var ajaxData = function (term, page) { return {type: 'select_trainz_kuids', value: term}; };
      var ajaxResults = function (data, page) { return {results: data}; };
      var initSelect = function(element, callback) {
          if (element.val() !== '') {
            $.post('{$weburl}ajax.php', {'type': 'init_select_trainz_kuids', 'value': element.val()}, function(data) {
              callback(jQuery.parseJSON(data));
            });
          }
        };

      var poc = 0;
      function addCDP() {
        $('.download_cdp').append('<div class="row'+poc+' file_oddil" id="item_'+(data_cdp_file[poc] ? data_cdp_file[poc].idtrainz_cdp : null)+'">'+
          '<legend class="legend-sort">Oddíl #'+(poc + 1) + (poc > 0 ? '<a href="javascript:removeCDP('+poc+')" class="btn btn-warning btn-warning7 btn-small pull-right odebrat_oddil"><i class="icon-remove-sign"></i> Odebrat Oddíl #'+(poc + 1)+'</a>' : '') + '</legend>'+
          '<div class="mws-form-row">'+
            '<label class="mws-form-label">Soubor</label>'+
            '<div class="mws-form-item">'+
              '<div class="medium">'+
                '<div class="fileinput-holder" style="position: relative;">'+
                  '<input type="text" class="fileinput-preview" id="idrow'+poc+'" style="width: 100%; padding-right: 101px;" readonly="readonly" placeholder="Nebyl vybrán žádný soubor..." />'+
                  '<span class="fileinput-btn btn" type="button" style="display:block; overflow: hidden; position: absolute; top: 0; right: 0; cursor: pointer;">Procházet...<input type="file" name="cdp['+poc+']" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;" onchange="$(\'#idrow'+poc+'\').val(replacePath(this.value))"></span>'+
                '</div>'+
              '</div>'+
            '</div>'+
          '</div>'+
          (data_cdp_file[poc] ?
          '<div class="mws-form-row">'+
            '<label class="mws-form-label">Nahraný soubor</label>'+
            '<div class="mws-form-item">'+
              '<div class="small">'+
                '<a href="#" onclick="return downloadCDP('+data_cdp_file[poc].idtrainz_cdp+', null, false)" class="btn">'+data_cdp_file[poc].name+'</a>'+
              '</div>'+
            '</div>'+
          '</div>' : '')+
          '<div class="mws-form-row">'+
            '<label class="mws-form-label" for="kuid_sznm_dwn_lb'+poc+'">Trainz verze (databáze)</label>'+
            '<div class="mws-form-item">'+
              '<div class="large">'+
                '<select name="version['+poc+'][]" class="mws-select2 large" multiple>{loop="$crate->getArrayListTrainzVersion()"}<option value="{$key}"'+(in_array({$key}, data_version[poc]) ? ' selected' : '')+'>{$value}</option>{/loop}</select>'+
              '</div>'+
              '<span class="error">Zde můžete kliknutím do pole vybrat neomezený počet Trainz verzí z databáze.</span>'+
            '</div>'+
          '</div>'+
          '<div class="mws-form-row">'+
            '<label class="mws-form-label" for="kuid_sznm_dwn_lb'+poc+'">Kuid (databáze)</label>'+
            '<div class="mws-form-item">'+
              '<div class="large">'+
                '<input type="hidden" id="kuid_sznm_dwn_lb'+poc+'" name="kuid_cdp['+poc+'][]" class="mws-kuid-select2 large" value="'+(data_kuid_cdp[poc] ? data_kuid_cdp[poc] : '')+'"/>'+
              '</div>'+
              '<span class="error">Zde můžete kliknutím do pole vybrat neomezený počet kuidů z databáze, které jsou obsaženy v souboru.</span>'+
            '</div>'+
          '</div>'+
          '<div class="mws-form-row">'+
            '<label class="mws-form-label" for="author_elem">Kuid (přidat nový)</label>'+
            '<div class="mws-form-item clearfix">'+
              '<div class="defined-650">'+
                '<textarea name="kuid_cdp_plain['+poc+']" class="kuid_input_plain defined-250 autosize" onkeyup="javascript:validateKuid(this.value, \'.kuid_dyn_kontrola_'+poc+'\')" placeholder="xxxxx:yyyyy(:zzz)">'+(data_kuid_cdp_plain[poc] ? data_kuid_cdp_plain[poc] : '')+'</textarea><div class="kuid_dyn_kontrola_'+poc+' custom-label-2 defined-380">Formát: &lt;kuid(2):(-)xxxxx:yyyyy(:zzz)&gt;</div>'+
              '</div>'+
              '<span class="error clrb">Zde můžete zadat neomezený počet kuidů, které jsou obsaženy v souboru.<br />Každý nový kuid musí být na novém řádku!<br />Prázdné řádky se vyhodnocují jako špatné zadání!<br />Kuid musí mít správný formát! Pouze čísla, dvojtečky a mínusy!<ul><li><em>xxxxx:yyyyy</em> pro <em>&lt;kuid:xxxxx:yyyyy&gt;</em></li><li><em>xxxxx:yyyyy:zzz</em> pro <em>&lt;kuid2:xxxxx:yyyyy:zzz&gt;</em></li></ul></span>'+
            '</div>'+
          '</div>'+
        '</div>');
        poc++;
        initValidation();

        $("input.mws-kuid-select2").select2({
          minimumInputLength: 3,
          multiple: true,
          ajax: {
              url: '{$weburl}ajax.php',
              type: 'POST',
              cache: true,
              data: ajaxData,
              results: ajaxResults
            },
            initSelection: initSelect,
            formatSelection: selectFormat,
            formatResult: selectFormat
        });

        $("select.mws-dbkuid-select2").select2({
          minimumInputLength: 3
        });
        $("#nepr_zad_obj").click(function() {
          $('#popis_lb').val('');
          $("select.mws-dbkuid-select2").select2("val", "0");
          return false;
        });
      }

      $("input.mws-kuid-dependency-select2").select2({
        minimumInputLength: 3,
        multiple: true,
        ajax: {
            url: '{$weburl}ajax.php',
            type: 'POST',
            cache: true,
            data: ajaxData,
            results: ajaxResults
          },
          initSelection: initSelect,
          formatSelection: selectFormat,
          formatResult: selectFormat
      });

      $('.add_cdp').click(function() {  // nabindovani hrefu na funkci
        addCDP();
        $.jGrowl("Byl přidán Oddíl #"+poc+" !", {
          position: "bottom-right"
        });
        return false;
      });

      if (data_version.length == 0) { // pridani jedne cdp polozky
        addCDP();
      }

      for (var k in data_version) { // naklikani podle vracenych poctu
        addCDP();
      }

      $('.ajax_downloads_name').keyup(function() {  // ajax kontrola download duplicity
        var patr = /[0-9]{1}/;
        var m = patr.exec($(this).attr('name'));  // identifikace jednotlivych indexu elementu
        $.post('{$weburl}ajax.php', {'type': 'unique_download_name', 'value': $('.ajax_downloads_name').serialize(), 'value_id': m[0], 'act': '{if="isset($uri.subblock)"}{$uri.subblock ?: 'null'}{else}null{/if}', 'id': {if="isset($uri.subaction)"}{$uri.subaction ?: 'null'}{else}null{/if}}, function(data) {
          $('.result_ajax_name'+m[0]).html(data);
        });
      });

      $('.ajax_category_name').keyup(function() {  // ajax kontrola category duplicity
        $.post('{$weburl}ajax.php', {'type': 'unique_category_name', 'value': $('.ajax_category_name').serialize(), 'act': '{if="isset($uri.subaction)"}{$uri.subaction ?: 'null'}{else}null{/if}', 'id': {if="isset($uri.id) && is_numeric($uri.id)"}{$uri.id}{else}null{/if}}, function(data) {
          $('.result_ajax_name').html(data);
        });
      });
    });

    function getCdpName(ret, id) {  // nacitani cdp jmena pro databazi kuidu
      $.post('{$weburl}ajax.php', {'type': 'cdpname', 'id': id}, function(data) {
        $(ret).val(data); // nastavovani inputu
      });
    }

    function fixTranslate() { // volani opravovani prekladu
      $.post('{$weburl}ajax.php', {'type': 'fix_translate'}, function(data) {
        $.jGrowl('Bylo opraveno '+data+' záznamů!', {
          position: "bottom-right"
        });
      });
      return false;
    }
  {/if}

    function loadHomeData() { // ajax nacitani home dat
        var jdata;
        var prodlevaNacitani = 150;
        $.post('{$weburl}ajax.php', {'type': 'homedata'}, function(data) {
            jdata = jQuery.parseJSON(data);
            initCountDownloads();
        });

        function initCountDownloads() {
            $('.count_downloads .mws-stat-value').html(jdata.count_downloads);
            if (jdata.count_up_downloads > 0) {
                $('.count_downloads .mws-stat-value').addClass('up');
            }
            $('.count_downloads').removeClass("preloader");
            $('.count_downloads .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountSlideshows()}, prodlevaNacitani);
        }

        function initCountSlideshows() {
            $('.count_slideshows .mws-stat-value').html(jdata.count_slideshows);
            if (jdata.count_up_slideshows > 0) {
                $('.count_slideshows .mws-stat-value').addClass('up');
            }
            $('.count_slideshows').removeClass("preloader");
            $('.count_slideshows .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountNews()}, prodlevaNacitani);
        }

        function initCountNews() {
            $('.count_news .mws-stat-value').html(jdata.count_news);
            if (jdata.count_up_news > 0) {
                $('.count_news .mws-stat-value').addClass('up');
            }
            $('.count_news').removeClass("preloader");
            $('.count_news .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountLinks()}, prodlevaNacitani);
        }

        function initCountLinks() {
            $('.count_links .mws-stat-value').html(jdata.count_links);
            $('.count_links').removeClass("preloader");
            $('.count_links .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountTrainzKuid()}, prodlevaNacitani);
        }

        function initCountTrainzKuid() {
            $('.count_trainz_kuid .mws-stat-value').html(jdata.count_trainz_kuid);
            $('.count_trainz_kuid').removeClass("preloader");
            $('.count_trainz_kuid .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountCategory()}, prodlevaNacitani);
        }

        function initCountCategory() {
            $('.count_downloads_category .mws-stat-value').html(jdata.count_downloads_category);
            $('.count_downloads_category').removeClass("preloader");
            $('.count_downloads_category .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountTrainzVersions()}, prodlevaNacitani);
        }

        function initCountTrainzVersions() {
            $('.count_trainz_versions .mws-stat-value').html(jdata.count_trainz_versions);
            $('.count_trainz_versions').removeClass("preloader");
            $('.count_trainz_versions .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountUsers()}, prodlevaNacitani);
        }

        function initCountUsers() {
            $('.count_users .mws-stat-value').html(jdata.count_users);
            if (jdata.count_up_users > 0) {
                $('.count_users .mws-stat-value').addClass('up');
            }
            $('.count_users').removeClass("preloader");
            $('.count_users .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountAuthors()}, prodlevaNacitani);
        }

        function initCountAuthors() {
            $('.count_authors .mws-stat-value').html(jdata.count_authors);
            $('.count_authors').removeClass("preloader");
            $('.count_authors .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountSizeFiles()}, prodlevaNacitani);
        }

        function initCountSizeFiles() {
            $('.file_size_files .mws-stat-value').html(jdata.file_size_files);
            $('.file_size_files').removeClass("preloader");
            $('.file_size_files .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountSizeImgDownload()}, prodlevaNacitani);
        }

        function initCountSizeImgDownload() {
            $('.file_size_img_download .mws-stat-value').html(jdata.file_size_img_download);
            $('.file_size_img_download').removeClass("preloader");
            $('.file_size_img_download .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountSizeImgSlideshow()}, prodlevaNacitani);
        }

        function initCountSizeImgSlideshow() {
            $('.file_size_img_slideshow .mws-stat-value').html(jdata.file_size_img_slideshow);
            $('.file_size_img_slideshow').removeClass("preloader");
            $('.file_size_img_slideshow .mws-stat-value').animate({opacity: 1});
            setTimeout(function(){initCountSizeDb()}, prodlevaNacitani);
        }

        function initCountSizeDb() {
            $('.db_size .mws-stat-value').html(jdata.db_size);
            $('.db_size').removeClass("preloader");
            $('.db_size .mws-stat-value').animate({opacity: 1});
        }
    };

  {if="isset($admin_uri['block']) && $admin_uri['block'] == 'home' && isset($admin_uri['subblock']) && $admin_uri['subblock'] == ''"}
    // generovani formatu polozky
    function renderRow(data, autohide, index) {
      return '<div class="prispevek'+(autohide ? ' hide' : '')+(index != null ? (index % 2 == 0 ? ' lichy_prispevek' : ' sudy_prispevek') : '')+'">'+
  '<div class="levy_blok">'+
    '<img src="{$weburl}img/avatars/'+data.avatar+'" alt="" onerror="this.src=\'{$weburl}img/avatars/no-profile-img.png\'" />'+
  '</div>'+
  '<div class="pravy_blok">'+
    '<p class="autor">'+data.login+(data.alias ? ' ('+data.alias+')': '')+'&nbsp;&nbsp;['+data.role+']</p>'+
    '<p class="datum">'+data.added+'</p>'+
    '<div class="zprava">'+data.message+'</div>'+
  '</div>'+
'</div>';
    }

    $('.ajax_message').keyup(function() { // ovladani send tlacitka
      $('.chatsendbutton').attr('disabled', $(this).val().length == 0); // deaktivace pri prazdnem obsahu
    });

    // odeslani zpravy
    function sendMessage(ret) {  // zaslani zpravy
      $('.chatsendbutton').attr('disabled', true);

      $.post('{$weburl}ajax.php', {'type': 'sendmessage', 'value': $('.ajax_message').serialize()}, function(data) {

        $('.ajax_message').val(''); // vymazani textu
        $('.chatsendbutton').attr('disabled', true);  // deaktivace tlacitka

        var jdata = jQuery.parseJSON(data);
        if (Object.keys(jdata).length > 0) {  // spocitani klicu
          $(ret).append(renderRow(jdata, true, null));  // vykreslovani jako hide
          $('.prispevek:last').fadeIn('slow');

          if ($(ret + ' .prispevek').hasClass('zadny_prispevek')) { // pokud je zadny prispevek
            getListMessages('.chat_content', false);  // pri prvnim prispevku provede tvrdy reload
          }
          getOnlineUsers(true); // nacteni online uzivatelu
        }
      });
      return false;
    }

    // vypis vsech polozek
    function getListMessages(ret, manual) { // nacitani zprav
      $.post('{$weburl}ajax.php', {'type': 'getlistmessages'}, function(data) {
        $.jGrowl("Vzkazník byl obnoven!", {
          position: "bottom-right"
        });

        var jdata = jQuery.parseJSON(data);
        if (jdata.length > 0) {
          $(ret).html('');  // vyprazdneni obsahu
          for (var v in jdata) {  // nacitani zprav z ajaxu
            $(ret).append(renderRow(jdata[v], manual, v)); // vykreslovani bez fadeIn pro automatiku, jinak fadeIn na cele
            if (manual) {
              $('.prispevek:last').fadeIn('slow');
            }
          }
        } else {
          $(ret).html('<div class="prispevek zadny_prispevek">Žádný vzkaz</div>');
        }
        getOnlineUsers(false); // nacteni online uzivatelu
      });
      return false;
    }

    function getOnlineUsers(oddeven) { // nacitani online uzivatelu
      if (oddeven) {
        // jquery nastaveni odd & even trid pri kazdem update
        $('.prispevek:even').addClass('lichy_prispevek');  // prohozene poradi
        $('.prispevek:odd').addClass('sudy_prispevek');
      }

      $.post('{$weburl}ajax.php', {'type': 'getonlineusers'}, function(data) {
        var jdata = jQuery.parseJSON(data);
        var out = '';
        if (jdata.length > 0) {
          for (var v in jdata) {
            out += (v > 0 ? ', ' : '')+jdata[v].login+(jdata[v].alias ? ' ('+jdata[v].alias+')': '');
          }
        } else {
          out = '-- nikdo --';
        }
        $('.online_user').html(out);
      });
    }

    loadHomeData(); // nacteni hodnot
    getOnlineUsers(false); // okamzity start
    setInterval(function() {  // casova smycka
        getListMessages('.chat_content', false);
      }, {$global_configure.admin.shoutboardRefresh} * 1000);
  {else}
    // odmazani zpravy
    function deleteMessage(id) {
      $.post('{$weburl}ajax.php', {'type': 'delmessage', 'id': id}, function(data) {
        if (data > 0) {
          $.jGrowl("Vzkaz byl smazán!", {
            position: "bottom-right",
            afterOpen: function(e,m,o) {
                window.location.reload();
              }
          });
        }
      });
      return false;
    }

    loadHomeData(); // nacteni hodnot
  {/if}
  {if="isset($admin_uri['block']) && $admin_uri['block'] == 'home' && isset($admin_uri['subblock']) && $admin_uri['subblock'] == 'stats'"}
    // statistiky
    Highcharts.setOptions({
      lang: {
        months: ['leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec'],
        weekdays: ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'],
        shortMonths: ['led', 'úno', 'bře', 'dub', 'kvě', 'čer', 'čec', 'srp', 'zář', 'říj', 'lis', 'pro']
      },
      credits: false
    });

  {code}
    // priprava datumu
    $date_pole = array();
    for ($i = 14; $i >= 0; $i--) {
      $date = strtotime(date('Y-m-d', strtotime('-'.$i.' day'))) * 1000;
      $date_pole[$date] = '['.$date.', 0]';
    }

    // downloads
    $data_last_downloads = $date_pole;
    foreach ($db->rawQuery('SELECT COUNT(iddownload) pocet, DATE(added) datum FROM downloads
                            WHERE added > (CURDATE() - INTERVAL 14 DAY)
                            GROUP BY datum
                            ORDER BY datum DESC') as $v) {
      $data_last_downloads[strtotime($v->datum) * 1000] = '['.(strtotime($v->datum) * 1000).', '.$v->pocet.']';
    }

    // slideshows
    $data_last_slideshows = $date_pole;
    foreach ($db->rawQuery('SELECT COUNT(idslideshow) pocet, DATE(added) datum FROM slideshows
                            WHERE added > (CURDATE() - INTERVAL 14 DAY)
                            GROUP BY datum
                            ORDER BY datum DESC') as $v) {
      $data_last_slideshows[strtotime($v->datum) * 1000] = '['.(strtotime($v->datum) * 1000).', '.$v->pocet.']';
    }

    // users
    $data_last_users = $date_pole;
    foreach ($db->rawQuery('SELECT COUNT(iduser) pocet, DATE(added) datum FROM users
                            WHERE added > (CURDATE() - INTERVAL 14 DAY)
                            GROUP BY datum
                            ORDER BY datum DESC') as $v) {
      $data_last_users[strtotime($v->datum) * 1000] = '['.(strtotime($v->datum) * 1000).', '.$v->pocet.']';
    }

    // train verze
    $data_trainzverze = array();
    foreach ($db->rawQuery('SELECT name, COUNT(idtrainz_cdp) pocet FROM trainz_versions
                            JOIN trainz_cdp_has_trainz_versions USING(idtrainz_version)
                            GROUP BY idtrainz_version
                            ORDER BY rank ASC') as $v) {
      $data_trainzverze[] = "['{$v->name}', {$v->pocet}]";
    }

    $data_prirazeniuzivatele = '';
    foreach ($db->rawQuery('SELECT COUNT(DISTINCT login) count_login, COUNT(DISTINCT author) count_author FROM downloads _d
                            LEFT JOIN users _u USING(iduser)
                            WHERE
                            _d.confirmed=1 AND
                            _d.deleted IS NULL') as $v) {
      $data_prirazeniuzivatele = "['Přiřazených uživatelů', {$v->count_login}], ['Nepřiřazených uživatelů', {$v->count_author}]";
    }
  {/code}

    $(function() {
      $('#objektymapydvatydny').highcharts({
          chart: {
              type: 'spline',
              marginRight: 40,
              marginTop: 15,
          },
          title: {
              text: ''
          },
          subtitle: {
              text: ''
          },
          legend: {
              enabled: false
          },
          xAxis: {
            type: 'datetime',
            //~ maxZoom: 48 * 3600 * 1000,
            title: {
                text: 'Časové období za poslední dva týdny',
                margin: 15,
              },
          },
          yAxis: {
            title: {
                text: 'Objektů/map',
              },
            min: -10,
            startOnTick: false,
          },
          tooltip: {
              formatter: function() {
                      return 'Objektů/map: '+this.y;
              }
          },
          series: [{
              data: [{$data_last_downloads|implode:', '}]
          }]
      });

      $('#slideshowsdvatydny').highcharts({
          chart: {
              type: 'spline',
              marginRight: 40,
              marginTop: 15,
          },
          title: {
              text: ''
          },
          subtitle: {
              text: ''
          },
          legend: {
              enabled: false
          },
          xAxis: {
            type: 'datetime',
            //~ maxZoom: 48 * 3600 * 1000,
            title: {
                text: 'Časové období za poslední dva týdny',
                margin: 15,
              },
          },
          yAxis: {
            title: {
                text: 'Screenshotů',
              },
            min: -10,
            startOnTick: false,
          },
          tooltip: {
              formatter: function() {
                      return 'Screenshotů: '+this.y;
              }
          },
          series: [{
              data: [{$data_last_slideshows|implode:', '}]
          }]
      });

      $('#uzivateledvatydny').highcharts({
          chart: {
              type: 'spline',
              marginRight: 40,
              marginTop: 15,
          },
          title: {
              text: ''
          },
          subtitle: {
              text: ''
          },
          legend: {
              enabled: false
          },
          xAxis: {
            type: 'datetime',
            //~ maxZoom: 48 * 3600 * 1000,
            title: {
                text: 'Časové období za poslední dva týdny',
                margin: 15,
              },
          },
          yAxis: {
            title: {
                text: 'Uživatelů',
              },
            min: -10,
            startOnTick: false,
          },
          tooltip: {
              formatter: function() {
                      return 'Uživatelů: '+this.y;
              }
          },
          series: [{
              data: [{$data_last_users|implode:', '}]
          }]
      });

      $('#trainzverze').highcharts({
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false
          },
          title: {
              text: ''
          },
          tooltip: {
              formatter: function() {
                      return this.point.name+': '+this.y+' objektů/map';
              }
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      color: '#000000',
                      connectorColor: '#000000',
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                  }
              }
          },
          series: [{
              type: 'pie',
              data: [{$data_trainzverze|implode:', '}]
          }]
      });

      $('#prirazeniuzivatele').highcharts({
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false
          },
          title: {
              text: ''
          },
          tooltip: {
              formatter: function() {
                      return this.point.name+': '+this.y+'';
              }
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      color: '#000000',
                      connectorColor: '#000000',
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                  }
              }
          },
          series: [{
              type: 'pie',
              data: [{$data_prirazeniuzivatele}]
          }]
      });

    });
  {/if}
  </script>
{/if}
</body>
</html>