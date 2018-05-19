{code}//<?
$code = '
<div class="mws-form-inline">
  <div class="mws-form-row">
    <label class="mws-form-label" for="nazev_lb">Název oprávnění</label>
    <div class="mws-form-item">
      <div class="small">
        {text:name|$|maxlength|:|50|,|placeholder|:|Název oprávnění|,|class|:|large|,|id|:|nazev_lb|@|filled|:|Musí být vyplněn název oprávnění!}
      </div>
      <span class="error">Povinné pole!</span>
    </div>
  </div>
  <table class="mws-table mws-table2">
    <tbody>';
    foreach ($resources as $k0 => $v0) {
      $code .= '
      <tr>
        <td class="path-column">/'.$k0.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="checkradio-column">{radio:_acltype[--'.$k0.'];none|$|checked|,|class|:|ibutton|,|data-label-on|:|&nbsp;None&nbsp;|,|data-label-off|:|&nbsp;None&nbsp;}</td>
        <td class="checkradio-column">{radio:_acltype[--'.$k0.'];allow|$|class|:|ibutton|,|data-label-on|:|&nbsp;Allow&nbsp;|,|data-label-off|:|&nbsp;Allow&nbsp;}</td>
        <td class="checkradio-column">{radio:_acltype[--'.$k0.'];deny|$|class|:|ibutton|,|data-label-on|:|&nbsp;Deny&nbsp;|,|data-label-off|:|&nbsp;Deny&nbsp;}</td>';
      foreach ($v0 as $v1) {
        $code .= '
        <td class="checkradio-column">{checkbox:_acl['.$k0.'--'.$v1.']|$|class|:|ibutton|,|data-label-on|:|&nbsp;'.$v1.'&nbsp;|,|data-label-off|:|&nbsp;'.$v1.'&nbsp;}</td>';
      }
      $code .= '
      </tr>';
    }
    $code .= '
    </tbody>
  </table>
</div>
<div class="mws-button-row">
  %%submit%%
</div>';

$sekce = classes\Section::build($weburl_admin.'users/roles/', '$admin_uri.subaction', '$admin_uri.id');
$sekce
    ->setTable('roles', 'idrole')
    ->setFormCode($code, array('class' => 'mws-form', 'autocomplete' => 'off'))
    ->setList(array(
        'name' => '{$value->name}',
        'enabled' => $user->isAllowed($acl_resource, 'list'),
        'description' => '',
        'query' => '$db->rawQuery(\'SELECT idrole, name FROM %%table%%
                                    ORDER BY idrole DESC\')',
    ))
    ->setAdd(array(
        'enabled' => $user->isAllowed($acl_resource, 'add'),
        'title' => 'Přidat oprávnění',
        'content_values' => '->remove(\'_acltype\')
                            ->remove(\'_acl\')',
        'code_success' => '
          $_acltype = %%values%%[\'_acltype\'];
          $_acl = %%values%%[\'_acl\'];

          $acl_pole = array();
          $acl_type = array();
          foreach ($_acltype as $k_type => $v_type) { // projiti typu
            if ($v_type != \'none\') {
              $_t = explode(\'--\', $k_type);
              $acl_pole[$_t[1]] = array();  // vlozeni typu
              $acl_type[$_t[1]] = $v_type;
            }
          }

          foreach ($_acl as $k_a => $v_a) { // projiti acl
            if ($v_a) {
              $_v = explode(\'--\', $k_a);
              $acl_pole[$_v[0]][] = $_v[1];
            }
          }

          if ($acl_pole) {
            if (!$acl->hasRole(%%values%%[\'name\'])) {
              $acl->addRole(%%values%%[\'name\']);  // rucni pridani role
            }

            // pre-nacteni resources do ACL (kvuli novym sekcim)
            $acl->removeAllResources();
            foreach ($resources as $k_resources => $v_resources) {
              $acl->addResource($k_resources);
            }

            foreach ($acl_pole as $k_pole => $v_pole) {
              if (isset($acl_type[$k_pole])) {
                $type = $acl_type[$k_pole];
                $acl->$type(%%values%%[\'name\'], $k_pole, $v_pole);
              }
            }
            $acl->commitRules(\'.staticACL\', true);
          }
        ',
      ))
    ->setEdit(array(
        'ignore' => array(1, 2),
        'enabled' => $user->isAllowed($acl_resource, 'edit'),
        'title' => 'Upravit oprávnění',
        'content_values' => '->remove(\'_acltype\')
                            ->remove(\'_acl\')',
        'code_pre_form' => '
          $rules = $acl->getRules();  // nacteni roli

          $_dat = array();
          if (isset($rules[%%data%%->name])) {
            foreach ($rules[%%data%%->name] as $k0 => $v0) {
              $vv = array_values($v0);
              $_dat[\'_acltype\'][\'--\' . $k0] = $vv[0];
              foreach (array_keys($v0) as $_kk) {
                $_dat[\'_acl\'][$k0 . \'--\' . $_kk] = \'on\';
              }
            }
          }
        ',
        'code_post_form' => '
          %%form_var%%->setDefaults($_dat);
        ',
        'code_success' => '
          $_acltype = %%values%%[\'_acltype\'];
          $_acl = %%values%%[\'_acl\'];

          $acl_pole = array();
          $acl_type = array();
          foreach ($_acltype as $k_type => $v_type) { // projiti typu
            if ($v_type != \'none\') {
              $_t = explode(\'--\', $k_type);
              $acl_pole[$_t[1]] = array();  // vlozeni typu
              $acl_type[$_t[1]] = $v_type;
            }
          }

          foreach ($_acl as $k_a => $v_a) { // projiti acl
            if ($v_a == \'on\') {
              $_v = explode(\'--\', $k_a);
              $acl_pole[$_v[0]][] = $_v[1];
            }
          }

          if ($acl_pole) {
            if (!$acl->hasRole(%%values%%[\'name\'])) {
              $acl->removeRole($roles[%%row_id%%]);  // odstrani puvodni a prida novou (prejmenovani)
              $acl->addRole(%%values%%[\'name\']);  // rucni pridani role
            }

            // pre-nacteni resources do ACL (kvuli novym sekcim)
            $acl->removeAllResources();
            foreach ($resources as $k_resources => $v_resources) {
              $acl->addResource($k_resources);
            }

            $rules = $acl->getRules();
            $rules[%%values%%[\'name\']] = null;  // odstraneni pravidel pro konkretni roli
            $acl->setRules($rules); // vraceni upravenych pravidel zpet do ACL
            foreach ($acl_pole as $k_pole => $v_pole) {
              if (isset($acl_type[$k_pole])) {
                $type = $acl_type[$k_pole];
                $acl->$type(%%values%%[\'name\'], $k_pole, $v_pole);
              }
            }
            $acl->commitRules(\'.staticACL\', true);
            %%rows%%++;
          }
        ',
      ))
    ->setDel(array(
        'ignore' => array(1, 2),
        'enabled' => $user->isAllowed($acl_resource, 'del'),
        'title' => 'Smazat oprávnění',
        'code_pre_delete' => '
          // vyber jmena role ktera se ma smazat
          $c = $db->query(\'%%table%%\', null, \'%%table_id%%=?\', array(%%row_id%%))->getFirst();
          $acl->removeRole($c->name);
          $rules = $acl->getRules();
          unset($rules[$c->name]); // odstraneni pravidel pro konkretni roli
          $acl->setRules($rules); // vraceni upravenych pravidel zpet do ACL;
          $acl->commitRules(\'.staticACL\', true);

          // prepsany trigger
          $db->update(\'users\', classes\ContentValues::init()->put(\'idrole\', 1), \'idrole=?\', array(%%row_id%%));
        ',
      ));
{/code}

{compile="$sekce->render()"}
