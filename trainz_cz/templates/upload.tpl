          <div class="row tcz_nadpisy">
            <div class="col-lg-12">
              <h2>{@Sekce pro autory@}</h2>
            </div>
          </div>
{code}//<?
  $confirm_update = $confirm_update_fail = false;
  if (isset($crate->upload_uri['block']) && $crate->upload_uri['block'] == 'authorize_hash') {  // potvrzovani
    $p = @unserialize(base64_decode(urldecode($crate->upload_uri['action'])));
    if ($p) {
      if ($p['time'] > time()) {  // pokud jeste plati
        if ($db->update('users', classes\ContentValues::init()->put('confirmed_email', true), 'iduser=?', array($p['id'])) > 0) {
          $confirm_update = true;
        }
      } else {
        $confirm_update_fail = true;
      }
    } else {
      classes\Core::setLocation($weburl);
    }
  }
{/code}

{if="$confirm_update"}
  <div class="alert alert-success text-center">
    <p>{@Váš email byl ověřen!@}<p>
    <p>{@Nyní můžete nahrávat objekty/mapy či screenshoty!@}</p>
  </div>
{/if}

{if="$confirm_update_fail"}
  <div class="alert alert-danger text-center btn-lg">
    <p>{@Vypršela platnost ověřovacího odkazu!@}</p>
    <p>{@Časový limit pro ověřovací odkaz je nastaven na 3 hodiny.@}</p>
    <p>{@Nechejte si zaslat ověřovací email znovu!@}</p>
  </div>
{/if}

{if="!$upload_user->isLoggedIn()"}
          <!--[if lte IE 8]>
            <div class="hidden">
          <![endif]-->
          <p>{@Zde se můžete přihlásit do autorské sekce.@}</p><br />
          <!--[if lte IE 8]>
            </div>
          <![endif]-->
{code}
$userLoginForm = classes\TplForm::compile('
    <!--[if lte IE 8]>
      <div class="hidden">
    <![endif]-->
    <div class="form-group">
      <label for="inputLogin" class="col-lg-3 control-label">Login</label>
      <div class="col-lg-9">
        {text:login|$|placeholder|:|Login|,|class|:|form-control required|,|id|:|inputLogin|@|filled|:|Musí být vyplněn Login!}
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-3 control-label">Heslo</label>
      <div class="col-lg-9">
        {password:hash|$|placeholder|:|Heslo|,|class|:|form-control required|,|id|:|inputPassword|@|filled:Musí být vyplněno Heslo!}{hidden:screen|$|id|:|hid_scr}
      </div>
    </div>
    <div class="form-group upload_prihlasitse">
      <div class="col-lg-offset-3 col-lg-9">
        {submit:;Přihlásit se|$|class|:|btn btn-success}
        <a href="'.$weburl.'upload/registrace" class="btn btn-primary pull-right" title="Registrace">Registrace</a>
      </div>
    </div>
    <!--[if lte IE 8]>
      </div>
    <![endif]-->
  ', array('class' => 'form-horizontal'))->setAutoHide(true)->setSubmitBlocker(false);  //, array('autocomplete' => 'off')
{/code}
<div class="row">
  <div class="col-lg-4 col-lg-offset-4 div-validate">
{$userLoginForm}
{if="$userLoginForm->isSubmitted()"}
  {if="$userLoginForm->isValid()"}
    {$val = $userLoginForm->getValues()}
    {if="$upload_user->login($val.login, $val.hash)->isLoggedIn()"}
      {$crate->addLastLogin($upload_user->getId(), $val['screen'], true)}
      {$core::setLocation($weburl . 'upload/')}
    {else}
    <div class="alert alert-danger">
      <h4>Nastala tato chyba:</h4>
      <ul>
        <li>
          <p>Byly zadány špatné přihlašovací údaje!</p>
        </li>
      </ul>
    </div>
    {/if}
  {/if}
{/if}
  </div>
</div>
<br />
<!--[if lte IE 8]>
  <div class="hidden">
<![endif]-->
<p>{@Přihlašovací údaje ze starých stránek trainz.cz nebudou fungovat!@}<br />{@Tato sekce je pro autory, aby mohli nahrávat své objekty/mapy do download sekce nebo screenshoty na úvodní stranu.@}<br />{@Pokud jste zde tedy poprvé a chcete nahrávat své objekty/mapy či screenshoty, tak se prosím zaregistrujte.@}</p>
<!--[if lte IE 8]>
  </div>
<![endif]-->
<div class="well well-sm upload-well">
  <div class="btn-group btn-group-justified">
    <a href="{$weburl}upload/zebricek-autoru" class="btn btn-default btn-sm" title="Žebříček autorů">Žebříček autorů</a>
    <a href="{$weburl}upload/nejstahovanejsi-objekty" class="btn btn-default btn-sm" title="30 nejstahovanějších objektů/map">30 nejstahovanějších objektů/map</a>
    <a href="{$weburl}upload/screenshoty-autoru" class="btn btn-default btn-sm" title="Všechny screenshoty autorů">Všechny screenshoty autorů</a>
  </div>
</div>
{else}
  {code}//<?
    $user = $db->query('users', 'login, alias, avatar, email, confirmed_email', 'iduser=?', array($upload_user->getId()))->getFirst();
    if (!$user) { // pokud neexistuje okamzite odhlasi
      $upload_user->logout();
      classes\Core::setLocation($weburl . 'upload');
    }
    $confirm_send = false;
    if (isset($crate->upload_uri['block'])) {
      switch ($crate->upload_uri['block']) {
        case 'logout':
          $upload_user->logout();
          classes\Core::setLocation($weburl . 'upload');
        break;

        case 'authorize': // posilani
          // sestaveni linku
          $p = array('id' => $upload_user->getId(),
                      'agent' => $_SERVER['HTTP_USER_AGENT'],
                      'ip' => classes\Core::getIp(null),  // adresa
                      'time' => strtotime('+3 hours'),  // platnost
                      'sum' => classes\Core::getUniqId(),
                    );
          $url = $weburl . 'upload/authorize_hash/' . urlencode(base64_encode(serialize($p)));

          // poslani emailu uzivatelovy
          $confirm_send = classes\Emailer::factory(classes\Emailer::HTML)
                              ->addTo($user->email)
                              ->setFrom('admin@trainz.cz')
                              ->setSubject('Ověřovací odkaz z autorské sekce Trainz.cz')
                              ->setMessageArgs('Dobrý den,<br /><br />zde je Váš ověřovací odkaz z autorské sekce Trainz.cz.<br /><br />Klikněte na níže uvedený odkaz pro ověření emailu.<br />----------------------------<br /><a href="%s">%s</a><br />----------------------------<br /><br />Jakmile bude Váš email potvrzen, budete moci nahrávat své objekty/mapy či screenshoty.<br /><br />--<br />Trainz.cz', $url, $url)
                              ->send();
        break;
      }
    }
    $upload_user->revalidate();
  {/code}
<div class="obal_upload_sekce">
    {if="$user && $user->confirmed_email"}
<div class="well well-sm clearfix">
  <span class="avatar-obal">
    <img src="{$weburl}img/avatars/{$user ? $user->avatar : null}" onerror="this.src='{$weburl}img/avatars/no-profile-img.png'" class="pull-left avatar-upload" />
  </span>
  <p class="pull-left">{$user ? $user->login : null}{$user && $user->alias ? ' (' . $user->alias . ')' : null}</p>
  <div class="btn-group btn-group-sm pull-right">
    <a href="{$weburl}upload/profile/" class="btn btn-info{if="isset($crate->upload_uri['block']) && $crate->upload_uri['block'] == 'profile'"} active{/if}">Profil</a>
    <a href="{$weburl}upload/logout" class="btn btn-warning">Odhlásit se</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-3">
    <ul class="nav nav-pills nav-stacked well well-sm">
      {compile_file="upload_menu.tpl"}
    </ul>
  </div>
  <div class="col-lg-9">
    {include="'upload_'.$crate->upload_menu->getTplAddress('_')"}
  </div>
</div>
<div class="well well-sm text-center">
  <p>Při neaktivitě budete automaticky odhlášen v: {$core::getCzechDateTime($upload_user->getExpirationTime(), true)}</p>
</div>
    {else}
<div class="well well-sm clearfix">
  <span class="avatar-obal">
    <img src="{$weburl}img/avatars/{$user ? $user->avatar : null}" onerror="this.src='{$weburl}img/avatars/no-profile-img.png'" class="pull-left avatar-upload" />
  </span>
  <p class="pull-left">{$user ? $user->login : null}{$user && $user->alias ? ' (' . $user->alias . ')' : null}</p>
  <div class="btn-group btn-group-sm pull-right">
    <a href="{$weburl}upload/logout" class="btn btn-warning">Odhlásit se</a>
  </div>
</div>
<div class="alert alert-danger text-center">
  <p>{@Před samotným nahráváním objektů/map či screenshotů musíte ověřit svůj email, poté už budete mít přístup k nahrávání!@}</p>
</div>
<div class="text-center">
  <a href="{$weburl}upload/authorize" class="btn btn-success alert">Klikněte zde pro zaslání ověřovacího emailu</a>
</div>
{if="$confirm_send"}
<div class="alert alert-info text-center">
  <p>{@Byl Vám zaslán ověřovací email!@}</p>
  <p>{@Poté co potvrdíte svůj email, budete mít přístup k nahrávání.@}</p>
</div>
{/if}
    {/if}
</div>
{/if}