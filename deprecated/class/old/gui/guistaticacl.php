<?php
/*
 * guistaticacl.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes\gui;

  use
    classes\Configurator,
    classes\Tpl,
    classes\TplForm;

  /**
   * trida vytvarejici GUI pro ACL
   *
   * @deprecated
   * @package unstable
   * @author geniv
   * @version 1.22
   */
  class GuiStaticACL {
    private $weburl = null;     // weburl pro unisteni
    private $action_uri = null; // action uri pro akci
    private $id_uri = null;     // id uri pro id

    private $code = '';

    private $roles = array();     // pole roli
    private $resources = array(); // pole zdroju
    private $modify_resources = array();
    private $acl = null;          // instance ACL
    
    private $var_form = '$__form';  // vnitrne vytvareny formular
    private $form_code = null;
    private $form_settings = null;

    /**
     * ukryti defaultni konstruktor
     *
     * @since 1.04
     * @param string weburl webova adresa sekce
     * @param string action_uri akcni uri
     * @param string id_uri id uri
     */
    private function __construct($weburl, $action_uri, $id_uri) {
      $this->weburl = $weburl;
      $this->action_uri = $action_uri;
      $this->id_uri = $id_uri;
    }

    /**
     * defaultni tovarni metoda
     *
     * @since 1.16
     * @param string weburl webova adresa sekce
     * @param string action_uri akcni uri
     * @param string id_uri id uri
     * @return GuiStaticACL vytvorena instance
     */
    public static function build($weburl, $action_uri, $id_uri) {
      return new self($weburl, $action_uri, $id_uri);
    }
//TODO komentare
    /**
     * nastaveni roli a zdroju
     *
     * @since 1.14
     * @param
     * @return
     */
    public function setACL($roles, $resources, $acl) {
      $this->roles = $roles;
      $this->resources = $resources;
      $this->acl = $acl;

      // uprava pole roli a zdroju
      $this->roles['all'] = 'Všichni';
      $this->modify_resources = array('all' => 'Všechno');  //$res=
      foreach ($this->resources as $k => $v) {
        foreach ($v as $k0 => $v0) {
          $this->modify_resources['zdroj: \''.$k.'\''][$k.'--'.$v0] = $k . '/' . $v0;
        }
      }
      return $this;
    }
    
    //~ /**
     //~ * nastaveni formularoveho kodu
     //~ *
     //~ * @since 1.20
     //~ * @param string zdrojovy kod formulare
     //~ * @param array settings pole nastaveni pro formular
     //~ * @return this
     //~ */
    //~ public function setFormCode($code, $settings = array()) {
      //~ $this->form_code = $code;
      //~ $this->form_settings = $settings;
      //~ return $this;
    //~ }

    /**
     * hlavni metoda pro kompilace
     *
     * @since 1.04
     * @param void
     * @return this
     */
    public function compile() {

//~ var_dump($this->roles);

    // uprava pole roli a zdroju
      //~ $this->roles['all'] = 'Všichni';
      $res = array('all' => 'Všechno');  //$res=
      foreach ($this->resources as $k => $v) {
        foreach ($v as $k0 => $v0) {
          $res['zdroj: "'.$k.'"'][$k.'--'.$v0] = $k . '/' . $v0;
        }
      }

      $this->form_code = '
      typ: {checkbox:type} (check = allow)

      <div class="mws-form-row">
        <label class="mws-form-label">role</label>
        <div class="mws-form-item">
            {select:roles;'.Configurator::encode($this->roles, Configurator::BLOCK).'|$|class|:|mws-select2 small}
        </div>
      </div>

      <div class="mws-form-row">
        <label class="mws-form-label">zdroje:</label>
        <div class="mws-form-item">
          {select:resources[];'.Configurator::encode($res, Configurator::BLOCK).'|$|class|:|mws-select2 large|,|multiple|,|size|:|20}
        </div>
      </div>
      
      {submit:;potvrdit}
    ';

      $this->code = '

{if="isset('.$this->action_uri.') && '.$this->action_uri.'==\'\'"}
  {code}
    $_roles = '.var_export($this->roles, true).';
    $_roles_link = array_flip($_roles);
    //~ var_dump($_roles_link);
  {/code}

  <a href="'.$this->weburl.'add" class="btn btn-success btn-success45 btn-large">Přidat oprávnění</a>

<br /><br/ >

      dostupne pravidla:<br />

      {loop="$acl->getRules()" as $k_rules => $v_rules}
        role: <strong>{$k_rules}</strong><br />

        <a href="'.$this->weburl.'edit/{if="isset($_roles_link.$k_rules)"}{$_roles_link.$k_rules}{else}{$k_rules}{/if}" class="btn btn-primary btn-primary18">Upravit ACL</a>
        <a href="'.$this->weburl.'del/{if="isset($_roles_link.$k_rules)"}{$_roles_link.$k_rules}{else}{$k_rules}{/if}" class="btn btn-danger btn-danger28" onclick="return confirm(\'Opravdu se má smazat: &quot;{$k_rules}&quot; ?\')">Smazat ACL</a>
        <br />

        {loop="$v_rules" as $k_res => $v_res}
          typ: {$v_res|array_values|array_unique|implode}<br />
          privilegia: {$v_res|array_keys|implode:\', \'}<br /><br />
        {/loop}
        <br />

      {/loop}
{/if}



{if="isset('.$this->action_uri.') && ('.$this->action_uri.'==\'add\' or '.$this->action_uri.'==\'edit\')"}
  {code}
    $act = '.Tpl::compileVar($this->action_uri).';
  
    '.$this->var_form.' = classes\TplForm::compile(\''.$this->form_code.'\''.($this->form_settings ? ', '.var_export($this->form_settings, true) : null).')->setReturnValues($_POST)->setAutoHide();
    
    if ($act == \'edit\') {
      '.$this->var_form.'->setDefaults();
    }
    
    $__form_render = '.$this->var_form.'->render();
    
    //FIXME bacha!! add a edit sekce v podstate spliva!!!!
    
    if ('.$this->var_form.'->isSuccess()) {
      $values = '.$this->var_form.'->getValues();

      $_type = isset($values[\'type\']) ? \'allow\' : \'deny\';  // nacteni ACL typu

      if ($values[\'resources\']) {
        $pole = array();
        foreach ($values[\'resources\'] as $resource_priv) {
          $sep = explode(\'--\', $resource_priv);
          if (count($sep) > 1) {
            $pole[$sep[0]][] = $sep[1];
          } else {
            $pole[$sep[0]] = null;
          }
        }

        foreach ($pole as $res => $priv) {
          $role = is_numeric($values[\'roles\']) ? $roles[$values[\'roles\']] : $values[\'roles\'];
          if ($priv) {
            $acl->$_type($role, $res, $priv);
          } else {
            $acl->$_type($role, $res);
          }
        }
      } else
      if ($values[\'roles\']) {
      var_dump($pole);
        $acl->$_type($values[\'roles\']);
      }
      
      var_dump($acl);
    }
  {/code}
  
  {$__form_render}
  
{/if}


{if="isset('.$this->action_uri.') && '.$this->action_uri.'==\'del\' && isset('.$this->id_uri.')"}
  del
{/if}

      
      ';

      return $this;
    }

    /**
     *
     *
     * @since 1.04
     * @param
     * @return string
     */
    public function render($debug = false) {
      if ($debug) { var_dump($this->code); }

      //~ $form = TplForm::compile($this->code);
      //~ $form->setReturnValues($_POST);
      //~ $render = $form->render();
//~ 
      //~ if ($form->isSuccess()) {
        //~ $values = $form->getValues();
//~ 
        //~ $type = $values['type'];  // nacteni ACL typu
//~ 
        //~ if ($values['resources']) {
          //~ $pole = array();
          //~ foreach ($values['resources'] as $resource_priv) {
            //~ $sep = explode('--', $resource_priv);
            //~ if (count($sep) > 1) {
              //~ $pole[$sep[0]][] = $sep[1];
            //~ } else {
              //~ $pole[$sep[0]] = null;
            //~ }
          //~ }
//~ 
          //~ foreach ($pole as $res => $priv) {
            //~ $role = is_numeric($values['roles']) ? $this->roles[$values['roles']] : $values['roles'];
            //~ if ($priv) {
              //~ $this->acl->$type($role, $res, $priv);
            //~ } else {
              //~ $this->acl->$type($role, $res);
            //~ }
          //~ }
        //~ } else
        //~ if ($values['roles']) {
          //~ $this->acl->$type($values['roles']);
        //~ }
        //~ 
        //~ var_dump($this->acl);
        
        //loadFromFile
        //isLoadFromFile
        //commitRules
      //~ }
  //~ var_dump($this->acl);
      return $this->code;
    }
  }