<div class="obal_upload_profil">
  <div class="well well-sm div-validate">
{code}//<?
$code = '
    <ul class="list-group">
      <li class="list-group-item">
        <div class="form-group">
          <label for="inputPassword" class="col-lg-1 control-label">Heslo</label>
          <div class="col-lg-11">
            {password:hash|$|maxlength|:|45|,|placeholder|:|Heslo|,|class|:|form-control|,|id|:|inputPassword}
            <span class="help-block">Pokud nechcete změnit heslo, tak nechejte pole prázdné!</span>
          </div>
        </div>
        <div class="form-group">
          <label for="inputJmeno" class="col-lg-1 control-label">Jméno</label>
          <div class="col-lg-11">
            {text:alias|$|maxlength|:|50|,|placeholder|:|Jméno|,|class|:|form-control|,|id|:|inputJmeno}
            <span class="help-block">Nepovinné pole.<br />Jméno se pak zobrazuje u screenshotů na úvodní straně a u objektů v závorce.<br />Doporučujeme vyplnit.</span>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-lg-1 control-label">Email</label>
          <div class="col-lg-11">
            {text:email|$|maxlength|:|100|,|placeholder|:|Email|,|class|:|form-control required|,|id|:|inputEmail|@|filled|:|Musí být vyplněn Email!|,|email|:|Email musí mít správný tvar!}
            <span class="help-block">Povinné pole.<br />Pokud změníte email, systém po Vás bude chtít ověřit nový email!<br />Email musí mít správný tvar!</span>
          </div>
        </div>
        <div class="form-group posledni-form-group">
          <label for="inputJmeno" class="col-lg-1 control-label">Avatar</label>
          <div class="col-lg-11 clearfix upload_form_img">
            {file:avatar|$|id|:|avatar_lb|,|class|:|filestyle|,|data-buttonText|:|Vybrat soubor|,|data-classButton|:|btn btn-primary|,|data-classInput|:|form-control btn-file|@|image|:|Musí být vložen pouze obrázek!|,|maxfilesize|:|Obrázek nesmí překročit velikost 1 MB!|:|1048576}
            <span class="help-block">Nepovinné pole. Obrázek nesmí překročit velikost <strong>1</strong> MB!</span>
            <span class="help-block">Aktuání avatar:</span>
            {img:avatar;'.$weburl.'img/avatars/|$|onerror|:|this.src=\\\''.$weburl.'img/avatars/no-profile-img.png\\\'}
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary btn-sm btn-check">{checkbox:avatar_delete}<span>Smazat avatar</span></label>
            </div>
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item">
        %%submit%%
      </li>
    </ul>';
$sekce = classes\Section::build($weburl.'upload/profile/', '$crate->upload_uri.action', '$crate->upload_uri.id');
$sekce
    ->setTable('users', 'iduser')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode($code, array('class' => 'form-horizontal', 'autocomplete' => 'off'))
    ->setList(array(
        'query' => '$db->query(\'%%table%%\', \'login, hash, alias, avatar, email, confirmed_email, added, edited\', \'%%table_id%%=?\', array($upload_user->getId()))',
        'name' => '',
        'content' => '
%%loop_begin%%
%%name%%
%%description%%
%%loop_empty%%
%%loop_end%%',
        'description' => '
    <ul class="list-group">
      <li class="list-group-item">
        <h4>Profil autora</h4>
      </li>
    </ul>
    <ul class="list-group">
      <li class="list-group-item clearfix">
        <img src="{$weburl}img/avatars/{$value->avatar}" onerror="this.src=\'{$weburl}img/avatars/no-profile-img.png\'" class="pull-right img-rounded" />
        <table>
          <tr>
            <td>Login:</td>
            <td>{$value->login}</td>
          </tr>
          <tr>
            <td>Jméno:</td>
            <td>{if="$value->alias"}{$value->alias}{else}-- nevyplněno --{/if}</td>
          </tr>
          <tr>
            <td>Email:</td>
            <td>{$value->email}</td>
          </tr>
        </table>
        <a href="{$weburl}upload/profile/edit" class="btn btn-primary">Upravit profil</a>
      </li>
    </ul>',
      ))
    ->setEdit(array(
        'title' => 'Upravit profil',
        'submit_button' => '{submit:;%%title%%|$|class|:|btn btn-primary}',
        'submit_blocker' => false,
        'if_id_blok' => 'true',
        'source_id' => $upload_user->getId(),
        'ignore_defaults' => array('hash'),
        'ignore_returns' => array('hash'),  // nevraceni hesla
        'code_post_form' => '
          %%form_var%%
              ->setReturnValues(array(\'avatar\' => %%data%%->avatar));
          if (isset($_POST[\'hash\']) && $_POST[\'hash\'] != \'\') {   // pokud je neco vyplneno
            %%form_var%%->addRule(\'hash\', \'minlength\', \'Minimální délka hesla musí být %s znaků!\', 6);
          }
        ',
        'code_success' => '
          if (%%values%%[\'avatar\'][\'name\']) {
            $dest = \'img/avatars/\' . classes\Core::makeFilesName(%%values%%[\'avatar\']);

            classes\ImageMaker::resize(%%values%%[\'avatar\'][\'tmp_name\'], $dest, $global_configure[\'admin\'][\'userAvatarWidth\'], $global_configure[\'admin\'][\'userAvatarHeight\']);
            %%values%%[\'avatar\'] = basename($dest);
          } else {
            %%values%%[\'avatar\'] = %%data%%->avatar;
          }

          if (isset(%%values%%[\'avatar_delete\'])) {  // pokud chce obrazek smazat
            %%values%%[\'avatar\'] = null;
          }
        ',
        'content_values' => '->remove(\'avatar_delete\')
                            ->put(\'hash\', %%values%%[\'hash\'] ? classes\Core::getCleverHash(%%values%%[\'login\'], %%values%%[\'hash\']) : %%data%%->hash)
                            ->put(\'alias\', %%values%%[\'alias\'] ?: null)
                            ->putDate(\'edited\')
                            ->putBool(\'confirmed_email\', %%values%%[\'email\'] == %%data%%->email)',
        'content' => '
<ul class="list-group">
  <li class="list-group-item clearfix upr_pr_fr">
    <h4 class="pull-left">Upravit profil autora</h4>
    <a href="%%back_link%%" class="btn btn-primary btn-xs pull-right" title="Zpět">Zpět</a>
  </li>
</ul>
%%if_iserrors%%
<div class="alert alert-danger">
  Nastaly tyto chyby:
  <ul>
      %%loop_geterrors%%
    <li>{$value}</li>
      %%loop_end%%
  </ul>
</div>
%%if_end%%
{%%form_msg%%}
{%%form%%}
',
        'success' => '<div class="alert alert-info">Profil byl upraven!</div>',
        'failure' => '<div class="alert alert-danger">Byl zadán email, který už v databázi existuje!</div><ul class="list-group"><li class="list-group-item"><a href="javascript:history.back()" class="btn btn-primary">Zpět na formulář</a></li></ul>',
      ));
{/code}
{compile="$sekce->render()"}
  </div>
</div>