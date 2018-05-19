{code}
  $browser = classes\Core::isChrome() || classes\Core::isFirefox() || $core::isOpera();
{/code}{if="!$user->isLoggedIn()"}<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Admin</title>
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
          {if="$user->login($val.login, classes\Core::getCleverHash($val.login, $val.hash))->isLoggedIn()"}
            {code}
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
{/*//TODO dodelat na ncitani z konfigu!!!*/}
{else}<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <!-- Viewport Metatag -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{$title}</title>
    <meta name="robots" content="noindex, nofollow" />
    {loop="array_merge($configure.admin_css, (array) $admin_menu->getCSS())"}<link rel="stylesheet" type="text/css" href="{$weburl}{$value}" />\n    {/loop}
    {loop="array_merge((array) $configure.admin_js, (array) $admin_menu->getJS('head'))"}<script src="{$weburl}{$value}"></script>\n    {/loop}
  </head>
<body>
{code}//<?
  if (isset($uri['block']) && $uri['block'] == 'logout') {
    $user->logout();
    classes\Core::setLocation($weburl_admin);
  }
  $user->revalidate();
{/code}
  <!-- Header -->
  <div id="mws-header" class="clearfix">
    <!-- Logo Container -->
    <div id="mws-logo-container">
      <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
      <div id="mws-logo-wrap">
        {/*<img src="{$weburl}admin_template/images/trainz-admin-logo.png" alt="mws admin">*/}
      </div>
    </div>
    <!-- User Tools (notifications, logout, profile, change password) -->
    <div id="mws-user-tools" class="clearfix">

      <!-- User Information and functions section -->
      <div id="mws-user-info" class="mws-inset">
        <!-- User Photo -->
        <div id="mws-user-photo">
          <div id="obal-user-photo">
            {/*<img src="{$weburl}img/avatars/{$user->getData('avatar')}" alt="Avatar" onerror="this.src='{$weburl}img/avatars/no-profile-img.png'" />*/}
          </div>
        </div>
        <!-- Username and Functions -->
        <div id="mws-user-functions">
          <div id="mws-username">
            {/*{$user->getData('login')}{if="$user->getData('alias')"} ({$user->getData('alias')}){/if}*/}
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
/*
  $access = false;
  if (isset($admin_uri['block']) && isset($admin_uri['subblock']) && isset($configure['admin']['search'][$admin_uri['block']])) {
    $access = in_array($admin_uri['subblock'], $configure['admin']['search'][$admin_uri['block']]);
  }
*/
{/code}
{/*
      <div id="mws-searchbox" class="mws-inset">
        <form method="post" action="{$weburl_admin}search/{if="isset($admin_uri['block'])"}{$admin_uri.block}{if="isset($admin_uri['subblock'])"}/{$admin_uri.subblock}{/if}{/if}">
          <input type="text" class="mws-search-input" name="search" placeholder="{$access ? 'Hledat...' : 'Zde není co hledat!'}"{$access ? null : ' disabled'}>
          <button type="submit" class="mws-search-submit"{$access ? null : ' disabled'}><i class="icon-search"></i></button>
        </form>
      </div>
*/}
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
{include="'admin/'.$admin_menu->getTplAddress('_')"}
      </div>
      <!-- Footer -->
      <div id="mws-footer">
        Při neaktivitě budete automaticky odhlášen v: {$core::getCzechDateTime($user->getExpirationTime(), true)} | Created by <a href="http://www.gfdesign.cz/" title="GMR hosting, www.gmrhosting.cz, www.gfdesign.cz">GMR</a>
      </div>
    </div>
  </div>
{/*
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

  </script>
*/}
{/if}
</body>
</html>