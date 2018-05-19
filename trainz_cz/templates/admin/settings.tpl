  <div class="grid_8 mws-panel mws-tree-navigace-noaddbtn">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">Globalní nastavení</span>
    </div>
{code}//<?
  $msg = null;
  if (isset($_POST['settings_button']) && $user->isAllowed($acl_resource, 'save')) {  // je odeslano a ma pravo odesilat
    $out = '<?php
return <<<NEON
# neon file
' . classes\Configurator::encode($_POST['settings'], classes\Configurator::BLOCK) . '
NEON;
';
    if (is_writable('user_global_config.php')) {
      if (file_put_contents('user_global_config.php', $out, LOCK_EX)) {
        $msg = '<div class="mws-form-message success">Nastavení bylo uloženo!</div>';
        classes\Core::setRefresh(2, $weburl_admin.'settings/');
      } else {
        $msg = '<div class="mws-form-message error">Nastavení nebylo uloženo!</div>';
      }
    } else {
      $msg = '<div class="mws-form-message error">Nastavení nelze zapsat!</div>';
    }
  }
{/code}
    <div class="mws-panel-body no-padding">
      <form action="" method="post" autocomplete="off" class="mws-form">
        {$msg}
  {loop="$global_configure" as $blok => $v}
        <fieldset class="mws-form-inline">
          <legend>{$blok}</legend>
{$unit = null}
    {loop="$v"}
      {code}
        $blockkey = null;
        if (substr_count($key, '-description') === 1) {
          $unit = $v[$key]; // nacitani jednotky polozky
          $blockkey = $key; // blokovani klicu, vypisuji se v hidden
        }
      {/code}
      {if="$key != $blockkey"}
          {if="is_array($value)"}
            {loop="$value" as $k1 => $v1}
          <div class="mws-form-row">
            <label class="mws-form-label">{$key}</label>
            <div class="mws-form-item">
              <div class="small">
                <input type="text" name="settings[{$blok}][{$key}][{$k1}]" value="{$v1}" class="small"> {$unit}
              </div>
            </div>
          </div>
            {/loop}
          {else}
          <div class="mws-form-row">
            <label class="mws-form-label">{$key}</label>
            <div class="mws-form-item">
              <div class="small">
                <input type="text" name="settings[{$blok}][{$key}]" value="{$value}" class="small"> {$unit}
              </div>
            </div>
          </div>
          {/if}
      {else}
        <input type="hidden" name="settings[{$blok}][{$key}]" value="{$value}">
      {/if}
    {/loop}
        </fieldset>
  {/loop}
        <div class="mws-button-row">
          {if="$user->isAllowed($acl_resource, 'save')"}<input class="btn btn-small btn-primary btn-primary18" type="submit" name="settings_button" value="Uložit nastavení">{/if}
        </div>
      </form>
    </div>
  </div>