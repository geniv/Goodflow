<?php
/*
 * section.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * tvurce sekci
   *
   * @package unstable
   * @author geniv
   * @version 3.60
   */
  class Section {
    private $weburl = null;
    private $action_uri = null;
    private $id_uri = null;

    private $table = null;  // jmeno pravocni tabulky
    private $id_table = null; // hlavni id PK sloupce pracovni tabulky

    private $var_form = '$__form';  // formular je konecne vytvareny vnitrne

    private $form_code = null;  // predavany kod formulare
    private $form_settings = null;  // predavane nastaveni formulare
    private $form_argv_compile = array(); // pole defaultnich form argumentu pri kompilaci

    private $code = array();
    private $global_replace = array(  // globalni search - replace pary
        '%%add_link%%' => null,
        '%%links%%' => array(),
      );

    private $list_suffix = null;  // adresa defaultni sekce
    private $add_suffix = 'add';  // adresa add sekce
    private $edit_suffix = 'edit'; // adresa edit sekce
    private $del_suffix = 'del';  // adresa del sekce
    private $dup_suffix = 'dupl'; // adresa duplikacni sekce

    private $refresh_time = 2;  // cas refreshu


    /**
     * ukryti defaultni konstruktor
     *
     * @since 2.04
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
     * defaultni tovani metoda
     *
     * @since 2.00
     * @param string weburl webova adresa sekce
     * @param string action_uri akcni uri
     * @param string id_uri id uri
     * @return Section vytvorena instance
     */
    public static function build($weburl, $action_uri, $id_uri) {
      return new self($weburl, $action_uri, $id_uri);
    }

    /**
     * nastaveni pristupu na tabulku
     *
     * @since 2.04
     * @param string table jmeno pracovni tabulky
     * @param string id_table jmeno PK sloupce
     * @return this
     */
    public function setTable($table, $id_table) {
      $this->table = $table;
      $this->id_table = $id_table;
      return $this;
    }

    /**
     * nastaveni refresh time
     *
     * @since 2.32
     * @param int time cas na refresh ve formularich
     * @return this
     */
    public function setRefreshTime($time) {
      $this->refresh_time = $time;
      return $this;
    }

    /**
     * nastaveni formularoveho kodu
     *
     * @since 2.10
     * @param string zdrojovy kod formulare
     * @param array settings pole nastaveni pro formular
     * @param array form_argv_compile pole defaultnich argumentu pri kompilaci formulare
     * @return this
     */
    public function setFormCode($code, $settings = array(), $argv_compile = array('uri')) {
      $this->form_code = $code;
      $this->form_settings = $settings;
      $this->form_argv_compile = $argv_compile;
      return $this;
    }

    /**
     * vytvareni defaultni sekce
     *
     * @since 2.02
     * @param array settings pole nastaveni
     * @return this
     */
    public function setList($settings = array()) {
      $_url = isset($settings['url']) ? $settings['url'] : $this->list_suffix;

      $_query = isset($settings['query']) ? $settings['query'] : '$db->query(\'%%table%%\')';

      $_global = isset($settings['global']) ? $settings['global'] : true;  // prepinani na globalni (pokud je vice ->setList)

      if ($_global) {
        $this->global_replace['%%name%%'] = isset($settings['name']) ? $settings['name'] : '{$value.0}';
        $this->global_replace['%%description%%'] = isset($settings['description']) ? $settings['description'] : '{$value.1} ';
        $this->global_replace['%%id_row%%'] = isset($settings['id_row']) ? $settings['id_row'] : '$value->' . $this->id_table;  // uz se vklada do {}
      }

      $_enabled = isset($settings['enabled']) ? ((bool) $settings['enabled'] ? 1 : 0) : 1;

      $_content = isset($settings['content']) ? $settings['content'] : '
  <div class="grid_8 addbtn">
    %%add_link%%
  </div>
      %%loop_begin%%
  <div class="grid_4 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%name%%</span>
      <span class="idpolozky">#{%%id_row%%}</span>
    </div>
    <div class="mws-panel-body no-padding">
      %%description%%
      <div class="mws-button-row">
        %%links%%
      </div>
    </div>
  </div>
      %%loop_empty%%
    <div class="grid_8 mws-panel">
      <div class="mws-panel-header mws-panel-header-normal mws-panel-header-center">
        <span>Žádná položka</span>
      </div>
    </div>
      %%loop_end%%';

      $search = array(
          '%%content%%',  // obsah

          '%%weburl%%',

          '%%loop_begin%%', // loopy
          '%%loop_empty%%',
          '%%loop_end%%',
          '%%loop_query%%',

          '%%table%%',
          '%%table_id%%',

          '%%action_uri%%',
          '%%action_id%%',
        );
      $replace = array(
          $_content,

          $this->weburl,

          '{loop="%%loop_query%%"}',
          '{emptyloop}',
          '{/loop}',
          $_query,

          $this->table,
          $this->id_table,

          Tpl::compileVar($this->action_uri),
          Tpl::compileVar($this->id_uri),
        );
      $this->code[$_url] = str_replace($search, $replace, '
{if="isset('.$this->action_uri.') && '.$this->action_uri.'==\''.$_url.'\' && '.$_enabled.'"}
%%content%%
{/if}');
      return $this;
    }
//FIXME prekopat a sjednotit povolovani linku a bloku kterym linkum patri (enabled + ignore) !!!!!
    /**
     * vytvareni pridavaci sekce
     *
     * @since 2.08
     * @param array settings pole nastaveni
     * @return this
     */
    public function setAdd($settings = array()) {
      $_url = isset($settings['url']) ? $settings['url'] : $this->add_suffix;
      $_back_link = isset($settings['back_link']) ? $settings['back_link'] : $this->weburl;
      $_refresh_url = isset($settings['refresh_url']) ? $settings['refresh_url'] : $this->weburl;  // url presmerovani

      $_query = isset($settings['query']) ? $settings['query'] : '$db->query(\%%table%%\')';

      $_form_raw = isset($settings['form_raw']) ? ($settings['form_raw'] ? 'true' : 'false') : 'false';
      $_form_values = isset($settings['form_values']) ? $settings['form_values'] : array(); // pridani promennych vracenych s getValues()
      $_auto_hide = isset($settings['auto_hide']) ? ($settings['auto_hide'] ? 1 : 0) : 1;  // automaticky schovavat formular
      $_submit_blocker = isset($settings['submit_blocker']) ? ($settings['submit_blocker'] ? 1 : 0) : 1; // automaticky po kliknuti schovavat submit tlacitko
      $_submit_security = isset($settings['submit_security']) ? ($settings['submit_security'] ? 1 : 0) : 0; // ochrana proti vecenasobnemu odeslani


      $_title = isset($settings['title']) ? $settings['title'] : 'Přidat';
      $_submit_button = isset($settings['submit_button']) ? $settings['submit_button'] : '{submit:;%%title%%|$|class|:|btn btn-small btn-success btn-success45}';  //TODO sjednotit nazev indexu!!! a normalizovat!! button/submit_button/edit_button/send_button
      $_color = isset($settings['color']) ? $settings['color'] : 'btn-success btn-success45'; // trida linku urcujici hlavne barvu

      $_content_values = isset($settings['content_values']) ? $settings['content_values'] : ''; // pro manipulaci s ContentValues

      $_code_pre_form = isset($settings['code_pre_form']) ? $settings['code_pre_form'] : ''; // pred form compile
      $_code_post_form = isset($settings['code_post_form']) ? $settings['code_post_form'] : ''; // po form compile
      $_argv_form_compile = isset($settings['argv_form_compile']) ? $settings['argv_form_compile'] : $this->form_argv_compile;  // argumenty pro TPL kompilaci formulare

      $_code_success = isset($settings['code_success']) ? $settings['code_success'] : ''; // pro vlozeni php kodu pod content value
      $_code_post_insert = isset($settings['code_post_insert']) ? $settings['code_post_insert'] : ''; // po provedeni insert


      $_success_title = isset($settings['success_title']) ? $settings['success_title'] : 'Položka byla přidána.';
      $_success = isset($settings['success']) ? $settings['success'] : '<div class="mws-form-message success">%%success_title%%</div>';
      $_failure_title = isset($settings['failure_title']) ? $settings['failure_title'] : 'Byl zadán duplikátní název!';
      $_failure = isset($settings['failure']) ? $settings['failure'] : '<div class="mws-form-message warning">%%failure_title%%</div><div class="mws-button-row"><a href="javascript:history.back()" class="btn btn-small btn-warning btn-warning16">Zpět na formulář</a></div>';


      $_global_link = isset($settings['global_link']) ? $settings['global_link'] : true;  // prepinani na globalni (hlavni add link) nebo lokalni link

      $_enabled = isset($settings['enabled']) ? ((bool) $settings['enabled'] ? 1 : 0) : 1;
      $_if_link = isset($settings['if_link']) ? $settings['if_link'] : '';  // pridavani podminky do zobrazovani odkazu
      $_else_link = isset($settings['else_link']) ? '{else}'.$settings['else_link'] : ''; // else linku pokud se nezobrazi
      $s = array(
          '%%else%%',
          '%%title%%',
          '%%weburl%%',
          '%%url%%',
          '%%color%%',
          '%%enabled%%',
          '%%if%%',
        );
      $r = array(
          $_else_link,
          $_title,
          $this->weburl,
          $this->weburl . $_url,
          $_color,
          $_enabled,
          $_if_link,
        );
      if ($_global_link) {
        $this->global_replace['%%add_link%%'] = str_replace($s, $r, '{if="(%%enabled%%) %%if%%"}' . (isset($settings['link']) ? $settings['link'] : '<a href="%%url%%" class="btn %%color%%">%%title%%</a>') . '%%else%%{/if}');
      } else {
        $this->global_replace['%%links%%'][] = str_replace($s, $r, '{if="(%%enabled%%) %%if%%"}' . (isset($settings['link']) ? $settings['link'] : '<a href="%%url%%" class="btn %%color%%">%%title%%</a>') . '%%else%%{/if}');
      }

      $_content = isset($settings['content']) ? $settings['content'] : '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
%%if_iserrors%%
  <div class="mws-form-message error">
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
    </div>
  </div>
';

      $search = array(
          // obsah
          '%%content%%',
          '%%back_link%%',
          '%%weburl%%',
          '%%form%%',
          '%%form_msg%%',
          '%%form_var%%',
          '%%data%%',
          '%%values%%',
          '%%row_id%%',
          '%%is_submitted%%',

          '%%success%%',
          '%%success_title%%',
          '%%failure%%',
          '%%failure_title%%',

          '%%submit%%',  // tlacitko pridavane ve formulari
          '%%title%%',
          '%%refresh_time%%',

          '%%table%%',
          '%%table_id%%',

          '%%if_iserrors%%',
          '%%if_end%%',
          '%%loop_geterrors%%',
          '%%loop_end%%',

          '%%action_uri%%',
          '%%action_id%%',
          '%%add_suffix%%',
          '%%edit_suffix%%',
          '%%del_suffix%%',
        );
      $replace = array(
          $_content,
          $_back_link,
          $this->weburl,
          '$__form_render',
          '$__msg',
          $this->var_form,
          '$_data',
          '$_values',
          '$__id',
          $this->var_form.'->isSubmitted()',

          $_success,
          $_success_title,
          $_failure,
          $_failure_title,

          $_submit_button,
          $_title,
          $this->refresh_time,


          $this->table,
          $this->id_table,

          '{if="'.$this->var_form.'->isErrors()"}',
          '{/if}',
          '{loop="'.$this->var_form.'->getErrors()"}',
          '{/loop}',

          Tpl::compileVar($this->action_uri),
          Tpl::compileVar($this->id_uri),
          $this->add_suffix,
          $this->edit_suffix,
          $this->del_suffix,
        );
      $this->code[$_url] = str_replace($search, $replace, '
{if="isset('.$this->action_uri.') && '.$this->action_uri.'==\''.$_url.'\' && '.$_enabled.'"}
{code}
  %%data%% = array();
  '.$_code_pre_form.'
  %%form_var%% = classes\TplForm::compile(\''.$this->form_code.'\''.($this->form_settings ? ', '.var_export($this->form_settings, true) : null).')
                    ->setReturnValues($_POST)
                    ->setAutoHide('.$_auto_hide.')
                    ->setSubmitBlocker('.$_submit_blocker.')
                    ->setSubmitSecurity('.$_submit_security.');
  '.$_code_post_form.'
  %%form%% = classes\Tpl::compile('.$this->var_form.'->render(), array_merge(array(\'data\' => %%data%%), compact(\''.implode('\', \'', $_argv_form_compile).'\')));  //TODO z venku zapinat vyhazovani backslashu

  %%form_msg%% = null;
  if ('.$this->var_form.'->isSuccess(true)) {
    %%values%% = '.$this->var_form.'->getValues('.$_form_raw.', '.var_export($_form_values, true).');
    '.$_code_success.'
    $_cv = classes\ContentValues::init(%%values%%)
              ->remove('.$this->var_form.'->getSubmittedBy())
              ->remove('.$this->var_form.'->getSecurityName())'.$_content_values.';

    do {
      if ($db->beginTransaction()) {
        %%row_id%% = $db->insert(\''.$this->table.'\', $_cv);
        '.$_code_post_insert.'
        $db->endTransaction();  // legalni ukonceni transakce
      }
    } while (0);  // pro vyskoceni: $db->rollBack(); break;
    if (%%row_id%% > 0) {
      %%form_msg%% = \'%%success%%\';
      classes\Core::setRefresh(%%refresh_time%%, \''.$_refresh_url.'\');
    } else {
      %%form_msg%% = \'%%failure%%\';
    }
  }
{/code}
%%content%%
{/if}
  ');
      return $this;
    }

    /**
     * vytvareni edit sekce
     *
     * @since 2.10
     * @param array settings pole nastaveni
     * @return this
     */
    public function setEdit($settings = array()) {
      $_url = isset($settings['url']) ? $settings['url'] : $this->edit_suffix;
      $_back_link = isset($settings['back_link']) ? $settings['back_link'] : $this->weburl;
      $_refresh_url = isset($settings['refresh_url']) ? $settings['refresh_url'] : $this->weburl;  // url presmerovani

      $_title = isset($settings['title']) ? $settings['title'] : 'Upravit';
      $_submit_button = isset($settings['submit_button']) ? $settings['submit_button'] : '{submit:;%%title%%|$|class|:|btn btn-small btn-primary btn-primary18}';
      $_color = isset($settings['color']) ? $settings['color'] : 'btn-primary btn-primary18'; // trida linku urcujici hlavne barvu

      $_code_pre_form = isset($settings['code_pre_form']) ? $settings['code_pre_form'] : ''; // pred form compile
      $_code_post_form = isset($settings['code_post_form']) ? $settings['code_post_form'] : ''; // po form compile
      $_argv_form_compile = isset($settings['argv_form_compile']) ? $settings['argv_form_compile'] : $this->form_argv_compile;  // argumenty pro TPL kompilaci formulare

      $_code_success = isset($settings['code_success']) ? $settings['code_success'] : ''; // pro vlozeni php kodu pod content value
      $_code_post_update = isset($settings['code_post_update']) ? $settings['code_post_update'] : ''; // po provedeni update

      $_success_title = isset($settings['success_title']) ? $settings['success_title'] : 'Položka byla upravena.';
      $_success = isset($settings['success']) ? $settings['success'] : '<div class="mws-form-message info">%%success_title%%</div>';
      $_success_empty_title = isset($settings['success_empty_title']) ? $settings['success_empty_title'] : 'Položka nebyla změněna.';
      $_success_empty = isset($settings['success_empty']) ? $settings['success_empty'] : '<div class="mws-form-message info">%%success_empty_title%%</div>';
      $_failure_title = isset($settings['failure_title']) ? $settings['failure_title'] : 'Byl zadán duplikátní název!'; //TODO zmenit na duplikatni položku!!!!
      $_failure = isset($settings['failure']) ? $settings['failure'] : '<div class="mws-form-message warning">%%failure_title%%</div><div class="mws-button-row"><a href="javascript:history.back()" class="btn btn-small btn-warning btn-warning16">Zpět na formulář</a></div>';

      $_source_id = isset($settings['source_id']) ? $settings['source_id'] : '%%action_id%%'; // normalni id source
      $_query = isset($settings['query']) ? $settings['query'] : '$db->query(\'%%table%%\', null, \'%%table_id%%=?\', array($__id))'; // vyberovy dotaz
      $_query_separator = isset($settings['query_separator']) ? $settings['query_separator'] : array(); // separator pro vice vysledku, array(group => array(slupec1, sloupec2))

      $_form_raw = isset($settings['form_raw']) ? ($settings['form_raw'] ? 'true' : 'false') : 'false';
      $_form_values = isset($settings['form_values']) ? $settings['form_values'] : array(); // pridani promennych vracenych s getValues()
      $_auto_hide = isset($settings['auto_hide']) ? ($settings['auto_hide'] ? 1 : 0) : 1;  // automaticky schovavat formular
      $_submit_blocker = isset($settings['submit_blocker']) ? ($settings['submit_blocker'] ? 1 : 0) : 1; // automaticky po kliknuti schovavat submit tlacitko
      $_submit_security = isset($settings['submit_security']) ? ($settings['submit_security'] ? 1 : 0) : 0; // ochrana proti vecenasobnemu odeslani


      $_content_values = isset($settings['content_values']) ? $settings['content_values'] : ''; // pro manipulaci s ContentValues
      $_ignore_defaults = isset($settings['ignore_defaults']) ? ', ' . var_export($settings['ignore_defaults'], true) : ''; // pro ignoraci defaults
      $_ignore_returns = isset($settings['ignore_returns']) ? ', ' . var_export($settings['ignore_returns'], true) : '';  // pro ignoraci return values


      $_enabled = isset($settings['enabled']) ? ((bool) $settings['enabled'] ? 1 : 0) : 1;
      $_ignore = isset($settings['ignore']) ? $settings['ignore'] : array();
      $_if_link = isset($settings['if_link']) ? $settings['if_link'] : '';  // pridavani podminky do zobrazovani odkazu
      $_else_link = isset($settings['else_link']) ? '{else}'.$settings['else_link'] : ''; // else linku pokud se nezobrazi

      $_if_id_blok = isset($settings['if_id_blok']) ? $settings['if_id_blok'] : 'isset('.$this->id_uri.') && is_numeric('.$this->id_uri.') && !in_array('.$this->id_uri.', '.var_export($_ignore, true).')';  // pripousteci podminka pro ID vstup

      $s = array(
          '%%else%%',
          '%%title%%',
          '%%weburl%%',
          '%%url%%',
          '%%color%%',
          '%%ignore%%',
          '%%enabled%%',
          '%%if%%',
        );
      $r = array(
          $_else_link,
          $_title,
          $this->weburl,
          $this->weburl . $_url . '/{$value->'. $this->id_table . '}',
          $_color,
          '!in_array($value->'.$this->id_table.', '.var_export($_ignore, true).')',
          $_enabled,
          $_if_link,
        );
      $this->global_replace['%%links%%'][] = str_replace($s, $r, '{if="(%%ignore%% && %%enabled%%) %%if%%"}' . (isset($settings['link']) ? $settings['link'] : '<a href="%%url%%" class="btn btn-small %%color%%">%%title%%</a>') . '%%else%%{/if}');


      $_content = isset($settings['content']) ? $settings['content'] : '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
%%if_iserrors%%
  <div class="mws-form-message error">
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
    </div>
  </div>
';

      $search = array(
          '%%content%%',
          '%%back_link%%',
          '%%weburl%%',
          '%%form%%',
          '%%form_msg%%',
          '%%form_var%%',
          '%%query%%',
          '%%data%%',
          '%%values%%',
          '%%row_id%%',
          '%%rows%%',
          '%%is_submitted%%',

          '%%success%%',
          '%%success_title%%',
          '%%success_empty%%',
          '%%success_empty_title%%',
          '%%failure%%',
          '%%failure_title%%',

          '%%submit%%',  // tlacitko pridavane ve formulari
          '%%title%%',

          '%%table%%',
          '%%table_id%%',

          '%%if_iserrors%%',
          '%%if_end%%',
          '%%loop_geterrors%%',
          '%%loop_end%%',

          '%%action_uri%%',
          '%%action_id%%',
          '%%add_suffix%%',
          '%%edit_suffix%%',
          '%%del_suffix%%',
        );
      $replace = array(
          $_content,
          $_back_link,
          $this->weburl,
          '$__form_render',
          '$__msg',
          $this->var_form,
          $_query,
          '$_data',
          '$_values',
          '$__id',
          '$_rows', // na pocitani externich updatu v code_post_update
          $this->var_form.'->isSubmitted()',

          $_success,
          $_success_title,
          $_success_empty,
          $_success_empty_title,
          $_failure,
          $_failure_title,

          $_submit_button,
          $_title,

          $this->table,
          $this->id_table,

          '{if="'.$this->var_form.'->isErrors()"}',
          '{/if}',
          '{loop="'.$this->var_form.'->getErrors()"}',
          '{/loop}',

          Tpl::compileVar($this->action_uri),
          Tpl::compileVar($this->id_uri),
          $this->add_suffix,
          $this->edit_suffix,
          $this->del_suffix,
        );
      $this->code[$_url] = str_replace($search, $replace, '
{if="isset('.$this->action_uri.') && '.$this->action_uri.'==\''.$_url.'\' && '.$_enabled.' && '.$_if_id_blok.'"}
  {code}
    %%row_id%% = '.$_source_id.';
    $cursor = %%query%%;  // nacitaci dotaz

    %%data%% = $cursor->getAll(); // nacteni pole radku
    if (count(%%data%%) == 1) {
      foreach (%%data%%[0] as $cv__k => $cv__v) { // projiti dat
        %%data%%[0][$cv__k] = htmlspecialchars($cv__v); // uprava " na entity
      }
      %%data%% = %%data%%[0];  // vycteni prvniho radku
    } else {
      $_sep = '.var_export($_query_separator, true).';  // uspusobeno jen na jedno slouceni!
      $_g = array_keys($_sep);  // zpracovani separatoru
      $_group = $_g[0];

      $_pp = array();
      foreach (%%data%% as $_v0) {
        foreach ($_v0 as $_k1 => $_v1) {
          if (in_array($_k1, $_sep[$_group])) {  // hledani pro skupinu
            $_pp[$_k1][$_v0->$_group] = htmlspecialchars($_v1);
          } else {
            $_pp[$_k1] = htmlspecialchars($_v1);
          }
        }
      }
      %%data%% = $_pp;
    }

    '.$_code_pre_form.'
    %%form_var%% = classes\TplForm::compile(\''.$this->form_code.'\''.($this->form_settings ? ', '.var_export($this->form_settings, true) : null).')
                      ->setDefaults(%%data%%'.$_ignore_defaults.')
                      ->setReturnValues($_POST'.$_ignore_returns.')
                      ->setAutoHide('.$_auto_hide.')
                      ->setSubmitBlocker('.$_submit_blocker.')
                      ->setSubmitSecurity('.$_submit_security.');
    '.$_code_post_form.'
    %%form%% = classes\Tpl::compile('.$this->var_form.'->render(), array_merge(array(\'data\' => %%data%%), compact(\''.implode('\', \'', $_argv_form_compile).'\')));

    %%rows%% = 0;
    %%form_msg%% = null;
    if ('.$this->var_form.'->isSuccess(true)) {
      %%values%% = '.$this->var_form.'->getValues('.$_form_raw.', '.var_export($_form_values, true).');
      '.$_code_success.'
      $_cv = classes\ContentValues::init(%%values%%)
                ->remove('.$this->var_form.'->getSubmittedBy())
                ->remove('.$this->var_form.'->getSecurityName())'.$_content_values.';

      do {
        if ($db->beginTransaction()) {
          %%rows%% += $db->update(\''.$this->table.'\', $_cv, \''.$this->id_table.'=?\', array(%%row_id%%));
          '.$_code_post_update.'
          $db->endTransaction();  // legalni ukonceni transakce
        }
      } while (0);  // pro vyskoceni: $db->rollBack(); break;
      if (%%rows%% == 0) {
        %%form_msg%% = \'%%success_empty%%\';
        classes\Core::setRefresh('.$this->refresh_time.', \''.$_refresh_url.'\');
      } else
      if (%%rows%% > 0) {
        %%form_msg%% = \'%%success%%\';
        classes\Core::setRefresh('.$this->refresh_time.', \''.$_refresh_url.'\');
      } else {
        %%form_msg%% = \'%%failure%%\';
      }
    }
  {/code}
%%content%%
{/if}');
      return $this;
    }

    /**
     * vytvareni del sekce
     *
     * @since 2.10
     * @param array settings pole nastaveni
     * @return this
     */
    public function setDel($settings = array()) {
      $_url = isset($settings['url']) ? $settings['url'] : $this->del_suffix;
      $_title = isset($settings['title']) ? $settings['title'] : 'Smazat';
      $_question = isset($settings['question']) ? $settings['question'] : 'Opravdu chcete smazat: &quot;%%name%%&quot; ?';
      $_color = isset($settings['color']) ? $settings['color'] : 'btn-danger btn-danger28'; // trida linku urcujici hlavne barvu
      $_refresh_url = isset($settings['refresh_url']) ? $settings['refresh_url'] : $this->weburl;  // url presmerovani

      $_code_pre_delete = isset($settings['code_pre_delete']) ? $settings['code_pre_delete'] : ''; // pred provedenim delete
      $_code_post_delete = isset($settings['code_post_delete']) ? $settings['code_post_delete'] : ''; // po provedeni delete

      $_success_title = isset($settings['success_title']) ? $settings['success_title'] : 'Položka byla smazána.';
      $_success = isset($settings['success']) ? $settings['success'] : '<div class="mws-form-message info">%%success_title%%</div>';
      $_success_empty_title = isset($settings['success_empty_title']) ? $settings['success_empty_title'] : 'Položka nebyla smazána.';
      $_success_empty = isset($settings['success_empty']) ? $settings['success_empty'] : '<div class="mws-form-message info">%%success_empty_title%%</div>';
      $_failure_title = isset($settings['failure_title']) ? $settings['failure_title'] : 'Nelze smazat záznam!';
      $_failure = isset($settings['failure']) ? $settings['failure'] : '<div class="mws-form-message warning">%%failure_title%%</div><div class="mws-button-row"><a href="javascript:history.back()" class="btn btn-small btn-warning btn-warning16">Zpět na formulář</a></div>';

      $_enabled = isset($settings['enabled']) ? ((bool) $settings['enabled'] ? 1 : 0) : 1;
      $_ignore = isset($settings['ignore']) ? $settings['ignore'] : array();
      $_if_link = isset($settings['if_link']) ? $settings['if_link'] : '';  // pridavani podminky do zobrazovani odkazu
      $_else_link = isset($settings['else_link']) ? '{else}'.$settings['else_link'] : ''; // else linku pokud se nezobrazi
      $s = array(
          '%%else%%',
          '%%title%%',
          '%%weburl%%',
          '%%url%%',
          '%%question%%',
          '%%color%%',
          '%%ignore%%',
          '%%enabled%%',
          '%%if%%',
        );
      $r = array(
          $_else_link,
          $_title,
          $this->weburl,
          $this->weburl . $_url . '/{$value->'. $this->id_table . '}',
          $_question,
          $_color,
          '!in_array($value->'.$this->id_table.', '.var_export($_ignore, true).')',
          $_enabled,
          $_if_link,
        );
      $this->global_replace['%%links%%'][] = str_replace($s, $r, '{if="(%%ignore%% && %%enabled%%) %%if%%"}' . (isset($settings['link']) ? $settings['link'] : '<a href="%%url%%" class="btn btn-small %%color%%" onclick="return confirm(\'%%question%%\')">%%title%%</a>') . '%%else%%{/if}');

      $_content = isset($settings['content']) ? $settings['content'] : '
  <div class="grid_8 mws-panel addbtn">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
{%%form_msg%%}
    </div>
  </div>';

      $search = array(
          '%%content%%',
          '%%weburl%%',
          '%%title%%',
          '%%row_id%%',
          '%%rows%%',
          '%%form_msg%%',

          '%%table%%',
          '%%table_id%%',

          '%%action_uri%%',
          '%%action_id%%',

          '%%success%%',
          '%%success_title%%',
          '%%success_empty%%',
          '%%success_empty_title%%',
          '%%failure%%',
          '%%failure_title%%',
        );
      $replace = array(
          $_content,
          $this->weburl,
          $_title,
          '$__id',
          '$_rows',
          '$__msg',

          $this->table,
          $this->id_table,

          Tpl::compileVar($this->action_uri),
          Tpl::compileVar($this->id_uri),

          $_success,
          $_success_title,
          $_success_empty,
          $_success_empty_title,
          $_failure,
          $_failure_title,
        );
      $this->code[$_url] = str_replace($search, $replace, '
{if="isset('.$this->action_uri.') && '.$this->action_uri.'==\''.$_url.'\' && '.$_enabled.' && isset('.$this->id_uri.') && is_numeric('.$this->id_uri.') && !in_array('.$this->id_uri.', '.var_export($_ignore, true).')"}
  {code}
    %%rows%% = 0;
    %%form_msg%% = null;
    %%row_id%% = '.Tpl::compileVar($this->id_uri).';
    do {
      if ($db->beginTransaction()) {
        '.$_code_pre_delete.'
        %%rows%% += $db->delete(\''.$this->table.'\', \''.$this->id_table.'=?\', array(%%row_id%%));
        '.$_code_post_delete.'
        $db->endTransaction();  // legalni ukonceni transakce
      }
    } while (0);  // pro vyskoceni: $db->rollBack(); break;
    if (%%rows%% == 0) {
        %%form_msg%% = \'%%success_empty%%\';
        classes\Core::setRefresh('.$this->refresh_time.', \''.$_refresh_url.'\');
      } else
      if (%%rows%% > 0) {
        %%form_msg%% = \'%%success%%\';
        classes\Core::setRefresh('.$this->refresh_time.', \''.$_refresh_url.'\');
      } else {
        %%form_msg%% = \'%%failure%%\';
      }
  {/code}
%%content%%
{/if}');
      return $this;
    }

    /**
     * vytvareni upravovaci (invalidacni) sekce na uprava/(invalidaci, nastavovani priznaku) zaznamu
     * - pridavani priznaku do databaze
     *
     * @since 2.40
     * @param array settings pole nastaveni
     * @return this
     */
    public function setUpdate($settings = array()) {
      $_url = isset($settings['url']) ? $settings['url'] : 'update';
      $_title = isset($settings['title']) ? $settings['title'] : 'Smazáno';
      $_question = isset($settings['question']) ? $settings['question'] : 'Opravdu chcete deaktivovat: &quot;%%name%%&quot; ?';
      $_color = isset($settings['color']) ? $settings['color'] : 'btn-danger btn-danger28'; // trida linku urcujici hlavne barvu
      $_refresh_url = isset($settings['refresh_url']) ? $settings['refresh_url'] : $this->weburl;  // url presmerovani

      $_code_post_update = isset($settings['code_post_update']) ? $settings['code_post_update'] : ''; // po provedeni update

      $_success_title = isset($settings['success_title']) ? $settings['success_title'] : 'Položka byla upravena.';
      $_success = isset($settings['success']) ? $settings['success'] : '<div class="mws-form-message info">%%success_title%%</div>';
      $_success_empty_title = isset($settings['success_empty_title']) ? $settings['success_empty_title'] : 'Položka nebyla změněna.';
      $_success_empty = isset($settings['success_empty']) ? $settings['success_empty'] : '<div class="mws-form-message info">%%success_empty_title%%</div>';
      $_failure_title = isset($settings['failure_title']) ? $settings['failure_title'] : 'Byl zadán duplikátní název!'; //TODO zmenit na duplikatni položku!!!!
      $_failure = isset($settings['failure']) ? $settings['failure'] : '<div class="mws-form-message warning">%%failure_title%%</div><div class="mws-button-row"><a href="javascript:history.back()" class="btn btn-small btn-warning btn-warning16">Zpět na formulář</a></div>';

      $_enabled = isset($settings['enabled']) ? ((bool) $settings['enabled'] ? 1 : 0) : 1;
      $_ignore = isset($settings['ignore']) ? $settings['ignore'] : array();
      $_if_link = isset($settings['if_link']) ? $settings['if_link'] : '';  // pridavani podminky do zobrazovani odkazu
      $_else_link = isset($settings['else_link']) ? '{else}'.$settings['else_link'] : ''; // else linku pokud se nezobrazi
      $s = array(
          '%%else%%',
          '%%title%%',
          '%%weburl%%',
          '%%url%%',
          '%%question%%',
          '%%color%%',
          '%%ignore%%',
          '%%enabled%%',
          '%%if%%',
        );
      $r = array(
          $_else_link,
          $_title,
          $this->weburl,
          $this->weburl . $_url . '/{$value->'. $this->id_table . '}',
          $_question,
          $_color,
           '!in_array($value->'.$this->id_table.', '.var_export($_ignore, true).')',
          $_enabled,
          $_if_link,
        );
      $this->global_replace['%%links%%'][] = str_replace($s, $r, '{if="(%%ignore%% && %%enabled%%) %%if%%"}' . (isset($settings['link']) ? $settings['link'] : '<a href="%%url%%" class="btn btn-small %%color%%" onclick="return confirm(\'%%question%%\')">%%title%%</a>') . '%%else%%{/if}');

      $_content_values = isset($settings['content_values']) ? $settings['content_values'] : ''; // pro manipulaci s ContentValues

      $_content = isset($settings['content']) ? $settings['content'] : '
  <div class="grid_8 mws-panel addbtn">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
{%%form_msg%%}
    </div>
  </div>';

      $search = array(
          '%%content%%',
          '%%weburl%%',
          '%%title%%',
          '%%row_id%%',
          '%%rows%%',
          '%%form_msg%%',

          '%%table%%',
          '%%table_id%%',

          '%%action_uri%%',
          '%%action_id%%',

          '%%success%%',
          '%%success_title%%',
          '%%success_empty%%',
          '%%success_empty_title%%',
          '%%failure%%',
          '%%failure_title%%',
        );
      $replace = array(
          $_content,
          $this->weburl,
          $_title,
          '$__id',
          '$_rows',
          '$__msg',

          $this->table,
          $this->id_table,

          Tpl::compileVar($this->action_uri),
          Tpl::compileVar($this->id_uri),

          $_success,
          $_success_title,
          $_success_empty,
          $_success_empty_title,
          $_failure,
          $_failure_title,
        );  //TODO pre_code?
      $this->code[$_url] = str_replace($search, $replace, '
{if="isset('.$this->action_uri.') && '.$this->action_uri.'==\''.$_url.'\' && '.$_enabled.' && isset('.$this->id_uri.') && is_numeric('.$this->id_uri.') && !in_array('.$this->id_uri.', '.var_export($_ignore, true).')"}
  {code}
    %%rows%% = 0;
    %%form_msg%% = null;
    %%row_id%% = '.Tpl::compileVar($this->id_uri).';
    $_cv = classes\ContentValues::init()'.$_content_values.';
    do {
      if ($db->beginTransaction()) {
        %%rows%% += $db->update(\''.$this->table.'\', $_cv, \''.$this->id_table.'=?\', array(%%row_id%%));
        '.$_code_post_update.'
        $db->endTransaction();  // legalni ukonceni transakce
      }
    } while (0);  // pro vyskoceni: $db->rollBack(); break;
    if (%%rows%% == 0) {
      %%form_msg%% = \'%%success_empty%%\';
      classes\Core::setRefresh('.$this->refresh_time.', \''.$_refresh_url.'\');
    } else
    if (%%rows%% > 0) {
      %%form_msg%% = \'%%success%%\';
      classes\Core::setRefresh('.$this->refresh_time.', \''.$_refresh_url.'\');
    } else {
      %%form_msg%% = \'%%failure%%\';
    }
    classes\Core::setRefresh('.$this->refresh_time.', \''.$_refresh_url.'\');
  {/code}
  %%content%%
{/if}');
      return $this;
    }
//FIXME search - replace bloky sjednotit?!!
    /**
     * vytvareni libovolne sekce
     *
     * @since 2.62
     * @param array settings pole nastaveni
     * @return this
     */
    public function setSection($settings = array()) {
      $_url = isset($settings['url']) ? $settings['url'] : 'section';
      $_title = isset($settings['title']) ? $settings['title'] : 'Smazáno';
      $_submit_button = isset($settings['submit_button']) ? $settings['submit_button'] : '{submit:;%%title%%|$|class|:|btn btn-small btn-primary btn-primary18}';

      $_code_pre_form = isset($settings['code_pre_form']) ? $settings['code_pre_form'] : ''; // pred form compile
      $_code_post_form = isset($settings['code_post_form']) ? $settings['code_post_form'] : ''; // po form compile
      $_argv_form_compile = isset($settings['argv_form_compile']) ? $settings['argv_form_compile'] : $this->form_argv_compile;  // argumenty pro TPL kompilaci formulare

      $_code_success = isset($settings['code_success']) ? $settings['code_success'] : ''; // pro vlozeni php kodu pod content value

      $_form_raw = isset($settings['form_raw']) ? ($settings['form_raw'] ? 'true' : 'false') : 'false';
      $_form_values = isset($settings['form_values']) ? $settings['form_values'] : array(); // pridani promennych vracenych s getValues()
      $_auto_hide = isset($settings['auto_hide']) ? ($settings['auto_hide'] ? 1 : 0) : 1;  // automaticky schovavat formular
      $_submit_blocker = isset($settings['submit_blocker']) ? ($settings['submit_blocker'] ? 1 : 0) : 1; // automaticky po kliknuti schovavat submit tlacitko
      $_submit_security = isset($settings['submit_security']) ? ($settings['submit_security'] ? 1 : 0) : 0; // ochrana proti vecenasobnemu odeslani

      $_ignore_defaults = isset($settings['ignore_defaults']) ? ', ' . var_export($settings['ignore_defaults'], true) : ''; // pro ignoraci defaults
      $_ignore_returns = isset($settings['ignore_returns']) ? ', ' . var_export($settings['ignore_returns'], true) : '';  // pro ignoraci return values

      $_enabled = isset($settings['enabled']) ? ((bool) $settings['enabled'] ? 1 : 0) : 1;

      $_form = isset($settings['form']) ? $settings['form'] : '';

      //'%%links%%'

      $_content = isset($settings['content']) ? $settings['content'] : '
  <div class="grid_8 addbtn">
    <a href="%%back_link%%" class="btn btn-primary btn-primary5" title="Zpět na výpis">Zpět na výpis</a>
  </div>
  <div class="grid_8 mws-panel">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">%%title%%</span>
    </div>
    <div class="mws-panel-body no-padding">
%%if_iserrors%%
  <div class="mws-form-message error">
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
    </div>
  </div>
';

      $search = array(
          '%%content%%',
          '%%form%%',
          '%%form_msg%%',
          '%%form_var%%',
          '%%data%%',
          '%%values%%',
          '%%is_submitted%%',

          '%%back_link%%',
          '%%submit%%',  // tlacitko pridavane ve formulari
          '%%title%%',
          '%%refresh_time%%',

          '%%table%%',
          '%%table_id%%',

          '%%if_iserrors%%',
          '%%if_end%%',
          '%%loop_geterrors%%',
          '%%loop_end%%',

          '%%action_uri%%',
          '%%action_id%%',
        );
      $replace = array(
          $_content,
          '$__form_render',
          '$__msg',
          $this->var_form,
          '$_data',
          '$_values',
          $this->var_form.'->isSubmitted()',

          $this->weburl,
          $_submit_button,
          $_title,
          $this->refresh_time,

          $this->table,
          $this->id_table,

          '{if="'.$this->var_form.'->isErrors()"}',
          '{/if}',
          '{loop="'.$this->var_form.'->getErrors()"}',
          '{/loop}',

          Tpl::compileVar($this->action_uri),
          Tpl::compileVar($this->id_uri),
        );
      $this->code[$_url] = str_replace($search, $replace, '
{if="isset('.$this->action_uri.') && '.$this->action_uri.'==\''.$_url.'\' && '.$_enabled.'"}
  {code}
    %%data%% = array();
    '.$_code_pre_form.'
    '.$this->var_form.' = classes\TplForm::compile(\''.$_form.'\''.($this->form_settings ? ', '.var_export($this->form_settings, true) : null).')
                            ->setDefaults(%%data%%'.$_ignore_defaults.')
                            ->setReturnValues($_POST'.$_ignore_returns.')
                            ->setAutoHide('.$_auto_hide.')
                            ->setSubmitBlocker('.$_submit_blocker.')
                            ->setSubmitSecurity('.$_submit_security.');
    '.$_code_post_form.'
    %%form%% = classes\Tpl::compile('.$this->var_form.'->render(), array_merge(array(\'data\' => %%data%%), compact(\''.implode('\', \'', $_argv_form_compile).'\')));

    %%form_msg%% = null;
    if ('.$this->var_form.'->isSuccess(true)) {
      %%values%% = '.$this->var_form.'->getValues('.$_form_raw.', '.var_export($_form_values, true).');
      //~ ->remove('.$this->var_form.'->getSecurityName())
      do {
        if ($db->beginTransaction()) {
          '.$_code_success.'
          $db->endTransaction();  // legalni ukonceni transakce
        }
      } while (0);  // pro vyskoceni: $db->rollBack(); break;
      //~ classes\Core::setRefresh('.$this->refresh_time.', \'...\');
    }
  {/code}
%%content%%
{/if}');
      return $this;
    }

    /**
     * vytvoreni linku pod vypisem
     *
     * @since 3.30
     * @param array settings pole nastaveni
     * @return this
     */
    public function setLink($settings = array()) {
      $_url = isset($settings['url']) ? $settings['url'] : $this->edit_suffix;

      $_title = isset($settings['title']) ? $settings['title'] : 'Upravit';
      $_color = isset($settings['color']) ? $settings['color'] : 'btn-primary btn-primary18'; // trida linku urcujici hlavne barvu

      $_enabled = isset($settings['enabled']) ? ((bool) $settings['enabled'] ? 1 : 0) : 1;
      $_ignore = isset($settings['ignore']) ? $settings['ignore'] : array();
      $_if_link = isset($settings['if_link']) ? $settings['if_link'] : '';  // pridavani podminky do zobrazovani odkazu
      $_else_link = isset($settings['else_link']) ? '{else}'.$settings['else_link'] : ''; // else linku pokud se nezobrazi

      $_if_id_blok = isset($settings['if_id_blok']) ? $settings['if_id_blok'] : 'isset('.$this->id_uri.') && is_numeric('.$this->id_uri.') && !in_array('.$this->id_uri.', '.var_export($_ignore, true).')';  // pripousteci podminka pro ID vstup

      $s = array(
          '%%else%%',
          '%%title%%',
          '%%weburl%%',
          '%%url%%',
          '%%color%%',
          '%%ignore%%',
          '%%enabled%%',
          '%%if%%',
        );
      $r = array(
          $_else_link,
          $_title,
          $this->weburl,
          $this->weburl . $_url . '/{$value->'. $this->id_table . '}',
          $_color,
          '!in_array($value->'.$this->id_table.', '.var_export($_ignore, true).')',
          $_enabled,
          $_if_link,
        );
      $this->global_replace['%%links%%'][] = str_replace($s, $r, '{if="(%%ignore%% && %%enabled%%) %%if%%"}' . (isset($settings['link']) ? $settings['link'] : '<a href="%%url%%" class="btn btn-small %%color%%">%%title%%</a>') . '%%else%%{/if}');

      return $this;
    }

    /**
     * vyrenderovani obsahu
     * - volani: {compile="$sekce->render()"}
     * - pouziva globalni nahrazovani
     *
     * @since 2.06
     * @param bool debug true pro zapnuti vypisu co je v code
     * @return string vyrenrerovana sekce
     */
    public function render($debug = false) {
      if ($debug) { var_dump($this->code, $this->global_replace); }
      $this->global_replace['%%links%%'] = implode($this->global_replace['%%links%%']);
      return str_replace(array_keys($this->global_replace), array_values($this->global_replace), implode($this->code));
    }
  }