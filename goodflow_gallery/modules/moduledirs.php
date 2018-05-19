<?php
/*
 *      menudirs.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace modules;

  use classes\Core,
      classes\Html,
      classes\Form,
      classes\Administration,
      classes\XmlStorage,
      classes\Notification,
      classes\GlobalText,
      \Config,
      Exception;

  final class ModuleDirs implements Module {
    const URL = 'dir';
    const VERSION = 1.94;
    const PREFIX_GALLERY = 'gallery';

//vraci nazev modulu
    public static function getName() {
      return _('Directory');
    }

//vraci pole nazvu sekci
    public static function getSection() {
      return array ('' => _('Listing Directory'),
                    'create' => _('Create directory'),
                    'enabled' => _('Set visibility'),
                    'activate' => _('Add to database'),
                    'activateall' => _('Add all to database'),
                    'page' => _('Pagination: %s'),
                    'rename' => _('Rename: %s'),
                    'del' => _('Delete directory'),
                    'delsel' => _('Delete select dir(s)'),
                    'delall' => _('Clear content'),
                    );
    }

//vraci pole pro js/script/css
    public static function getLoadModules() {
      return array();
    }

    private static $xmldata = NULL;

//vraci aktualni stav modulu
    public static function getState() {
      try {
        $result = false;
        if (!file_exists(self::$source_path)) {
          if (!@mkdir(self::$source_path)) {
            throw new ExceptionModuleDirs(GlobalText::s(__METHOD__));
          }
        }
        $result = file_exists(self::$source_path);

      } catch (ExceptionModuleDirs $e) {
        Administration::setErrors($e);
      }
      return $result;
    }

//FIXME predelat!!!!!!
    private static $weburl = NULL;
    private static $adminurl = NULL;
    private static $source_path = NULL;

//nastavovani pathu pro modul
    public static function setPath($path = NULL, $adminurl = NULL, $weburl = NULL) {
      self::$source_path = sprintf('%s%s', $path, Config::SOURCE);
      self::$adminurl = $adminurl;  //url adminu
      self::$weburl = $weburl;  //url webu
    }

//nacitani pathu pro xml uloziste
    public static function getXmlPath() {
      $class = substr(__CLASS__, strlen(__NAMESPACE__) + 1);
      return XmlStorage::getAutoPath(__DIR__, $class);
    }

//vraci jen aktivni adresare
    public static function getActiveDirs() {
      $load_data = self::loadXmlData();
      $result = array();
      if (!empty($load_data)) {
        foreach ($load_data as $dir => $conf) {
          $enabled = $conf['enabled'];
          if ($enabled) {
            $result[$dir] = $conf;
          }
        }
      }
      return $result;
    }

//obsluha synchronizace s filesytemem
    private static function synchronizeXml($load, $dirs) {
      $result = NULL;

      $xml_path = self::getXmlPath();
      $load_data = self::loadXmlData();

      var_dump(self::$adminurl, Administration::getAdminUrl()); //FIXME dodelat!!!!

      $diff = array_diff($load, $dirs);
      if (!empty($diff)) {
        foreach ($diff as $dir) {
          $index = self::getIndexGallery($dir);
          $load_data[$index] = NULL;
        }

        if (!empty($load_data[''])) {
          $load_data[''] = NULL;
        }

        if (XmlStorage::setData($xml_path, $load_data)) {
          $result =  Notification::info(_('Synchronized %s'))->args(Html::elem('br'), $diff)->wait(Notification::NORMAL);
          $get_adress = Administration::getGetAdress();
          Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, array('query' => array($get_adress[0] => self::URL), 'path' => Administration::ADMIN_URL)));
        }
      }
      return $result;
    }

//nacitani xml dat d ostaticke promenne
    private static function loadXmlData($reload = false) {
      try {
        $xml_path = self::getXmlPath();
        if (file_exists($xml_path)) {
          //pokud je prazdna jednou se nacte
          if (empty(self::$xmldata) || $reload) {
            self::$xmldata = XmlStorage::getData($xml_path);
          }
        } else {
          //neni kriticka chyba!
          //throw new ExceptionModuleDirs(sprintf('Does not exist file: %s', $xml_path));
        }
      } catch (ExceptionModuleDirs $e) {
        Administration::setErrors($e);
      }
      return self::$xmldata;
    }

//vraceni title na stranky
    public static function getPageTitle($settings = array()) {
      $result = NULL;
      $before = Core::isFill($settings, 'before');
      $after = Core::isFill($settings, 'after');

      $current = Administration::getCurrentAdress();

      $row = array();
      if (!empty($before)) {  //muze se zatim vlozit jen text! ne pole!
        $row[] = $before;
      }

      //nacitany nazev
      if (!empty($current)) {
        $index = self::getIndexGallery($current);
        $load_data = self::loadXmlData();
        $value = Core::isFill($load_data, $index);
        $title = Core::isFill($value, 'title');
        if (!empty($title)) {
          $row[] = $title;
        } else {
          Administration::setErrors(GlobalText::s(__METHOD__));
        }
      }

      if (!empty($after)) { //muze se zatim vlozit jen text! ne pole!
        $row[] = $after;
      }

      $result = implode(' - ', $row); //slucovani title

      return $result;
    }

//vraceni menu na stranky
    public static function getPageMenu($weburl, $sablona = NULL) {
      $result = NULL;
      $load_data = self::getActiveDirs();

      $current = Administration::getCurrentAdress();

      $row = array();
      foreach ($load_data as $dir => $values) {
        $name = $values['name'];
        $title = $values['title'];
        $href_link = sprintf('%s%s', $weburl, $name);
        if (empty($sablona)) {
          $row[] = Html::elem('a')  //defaultni sablona
                        ->href($href_link)
                        ->class($current == $name ? 'aktivni' : NULL)
                        ->setText($title);
        } else {
          $data = array('href_link' => $href_link,
                        'conditions' => ($current == $name ? 'aktivni' : NULL),
                        'name' => $title,
                        );
          $row[] = $sablona->setTemplate($data)->render(); //vkladana sablona
        }
      }
      $result = implode('', $row);
      return $result;
    }

//vraceni obsahu na stranky
    public static function getPageContent($weburl, $sablona = NULL) {
      $result = NULL;
      $load_data = self::getActiveDirs();

      $current = Administration::getCurrentAdress();

      $source_path = Config::SOURCE;

      if (!empty($current)) {
        $index = self::getIndexGallery($current);
        if (array_key_exists($index, $load_data)) {
          $path_full = sprintf('%s%s/%s', $weburl, $source_path, $current);
          $path_mini = sprintf('%s%s/%s/%s', $weburl, $source_path, $current, Config::THUMB);

          $files = Core::isFill($load_data[$index], 'files');
          $paginate = Core::isFill($load_data[$index], 'paginate');
//var_dump($paginate);
//FIXME doimplementovat strankovani!!!! - pocet zaznamu, na stranku

          if (!empty($files)) {
            $row = array();
            foreach ($files as $name => $comment) {
              $href_link = sprintf('%s/%s', $path_full, urlencode($name));
              $obr_path = sprintf('%s/%s', $path_mini, urlencode($name));

              if (empty($sablona)) {
                $row[] = Html::elem('span')
                              ->insert(Html::elem('strong')->setText($comment)->appendAfter(Html::elem('br')))
                              ->insert(Html::elem('a')->href($href_link)
                                                      ->insert(Html::elem('img')
                                                                    ->src($obr_path)
                                                              )
                                      )
                              ->appendAfter(Html::elem('br'))
                              ->appendAfter(Html::elem('br'))
                              ;
              } else {
                $data = array('name' => $name,
                              'comment' => $comment,
                              'href_link' => $href_link,
                              'obr_path' => $obr_path,
                              );
                $row[] = $sablona->setTemplate($data)->render(); //vkladana sablona
              }
            }
            $result = implode('', $row);
            //$result = $row;
          } else {
            $result = _('No photos');
          }
        }
      }

      return $result;
    }

//vraceni admin title
    public static function getAdminTitle() {
      $current = base64_decode(Core::isFill($_GET, 'iddir'));
      $load_data = self::loadXmlData();
      $value = Core::isFill($load_data, $current);
      $name = NULL;
      //pokud neni prazdne current a je prazdne value
      if (!empty($current) && empty($value)) {  //uprava indexu z pictures
        $iddir = base64_decode(Core::isFill($_GET, 'id'));
        $val = Core::isFill($load_data, $iddir);
        //pokud je val prazdne tak vezme hodnotu current
        $name = (!empty($val) ? Core::isFill($val['files'], $current) : $current);
      }
      return ($value ? $value['title'] : $name);
    }

    private static function getIndexGallery($name) {
      return sprintf('%s_%s', self::PREFIX_GALLERY, $name);
    }

//vraceni admin obsahu
    public static function getAdminContent($co) {
      $result = NULL;
      $source_path = self::$source_path;

      $adminurl = Core::makeUrl(self::$adminurl, array('path' => Administration::ADMIN_URL));
      $get_adress = Administration::getGetAdress();

      $backarray = array($get_adress[0] => self::URL);
      $refreshurl = array('query' => $backarray, 'path' => Administration::ADMIN_URL);

      $xml_path = self::getXmlPath();

      switch ($co) {
        default:
          $load_data = self::loadXmlData();

          $key_load_data = array();
          $func = function($value) { return $value['name']; };  //navraceni jen jmena slozky
          $key_load_data = (is_array($load_data) ? array_values(array_map($func, $load_data)) : array());

          //nacteni serazenych polozek z filesystemu
          $dirs = array();
          $dirs = Core::getListDir(array('path' => $source_path, 'sort' => array(Core::LIST_SORT_SELF => $key_load_data)));

          //vzory textu
          $column = array('name' => array('class' => 'name', 'title' => _('Name')),
                          'size' => array('class' => 'size', 'title' => _('Size')),
                          'count' => array('class' => 'number', 'title' => _('Count pictures')),
                          'permit' => array('class' => 'permission', 'title' => _('Permission Created on')),
                          'enable' => array('class' => 'hiding', 'title' => _('Visibility')),
                          'page' => array('class' => 'pagination', 'title' => _('Pagination')),
                          'rename' => array('class' => 'rename', 'title' => _('Rename')),
                          'delete' => array('class' => 'delete', 'title' => _('Delete')),
                          'delete_all' => array('class' => 'delete_all_pictures', 'title' => _('Clear content')),
                          );

          $checkbox_class_deleteselect = 'checkbox_selective_delete';
          $pocadd = 0;
          $row = array();
          foreach ($dirs as $index => $dir) {
            $pathdir = sprintf('%s/%s', $source_path, $dir);

            $index = self::getIndexGallery($dir);
            $iddir = base64_encode($index);
            $row_data = Core::isFill($load_data, $index); //nactene data radku
            $activate = (boolean) Core::isFill($row_data, 'enabled'); //aktivace
            $title = Core::isFill($row_data, 'title', $dir);  //titulek slozky
//var_dump($title);
//$row_data
            $stav = (empty($row_data) ? 'inactive' : ($activate ? 'unhidden' : 'hidden'));
            $dir_size = (Core::calculateSize(Core::getSizeDir($pathdir, true)) ?: _('Empty dir'));  //cele slozky
            $count_pic = Core::getCountListFile(array('path' => $pathdir, 'onlywrite' => true));
            $paginate = Core::isFill($row_data, 'paginate');

//TODO otestovat POST odkazy pres headery?!!! preda se stejne pole... ale nepodle se to getem ale postem?!...
//otazkou cok se to bude cele chovat?!!!

            $links = array();
            if (empty($row_data)) {
              //neni v ulozisti
              $a_text = _('Add to database');
              $links[] = Html::elem('li')->insert(Html::elem('a')
                                                      ->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'activate', 'id' => base64_encode($dir)))
                                                      ->title($a_text)
                                                      ->setText($a_text))
                                                  ->class('add_to_database');
              $pocadd++;
            } else {
              //je v ulozisti
              $a_text = ($activate ? _('Hide') : _('Unhide'));
              $links[] = Html::elem('li')->insert(Html::elem('a')
                                                      ->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'enabled', 'id' => $iddir))
                                                      ->title($a_text)
                                                      ->setText($a_text))
                                                  ->class($column['enable']['class']);

              $a_text = _('Set pagination');
              $enable_page = Core::isFill($paginate, 'enabled');
              $per_page = Core::isFill($paginate, 'perpage');
              $links[] = Html::elem('li')->insert(Html::elem('a')  //strankovani
                                                      ->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'page', 'id' => $iddir))
                                                      ->title($a_text)
                                                      ->setText($a_text))
                                          ->class($column['page']['class'])
                                          ->insert(Html::elem('p')->setText($enable_page ? sprintf(_('%s per page'), $per_page) : _('Paginate disabled')));

              $a_text = $column['rename']['title'];
              $links[] = Html::elem('li')->insert(Html::elem('a')  //rename
                                                      ->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'rename', 'id' => $iddir))
                                                      ->title($a_text)
                                                      ->setText($a_text))
                                                  ->class($column['rename']['class']);

              $a_text = $column['delete']['title'];
              $links[] = Html::elem('li')->insert(Html::elem('a')  //delete
                                                      ->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'del', 'id' => $iddir))
                                                      ->title($a_text)
                                                      ->setText($a_text)
                                                      ->onclick(sprintf('return confirm(\'%s\');', sprintf(_('Really delete dir: &quot;%s&quot; ?'), $title))))
                                          ->class($column['delete']['class'])
                                          ->insert($count_pic['writable'] == $count_pic['count'] ? Html::elem('input')->type('checkbox')->class($checkbox_class_deleteselect)->onclick('enabledeletebutton(this.checked);')->value($iddir) : NULL);

              $a_text = $column['delete_all']['title'];
              $links[] = Html::elem('li')->insert(Html::elem('a')  //delete content
                                                      ->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'delall', 'id' => $iddir))
                                                      ->title($a_text)
                                                      ->setText($a_text)
                                                      ->onclick(sprintf('return confirm(\'%s\');', sprintf(_('Really delete all content: &quot;%s&quot; ?'), $title))))
                                                  ->class($column['delete_all']['class']);
            }
//FIXME jeste vyresit nacitani poctu slozek/souboru a jejich opravneni!
            $nazev_title = sprintf(_('Filesystem name: %s'), $dir);
            $li_nazev = Html::elem('li')->class($column['name']['class'])->title($nazev_title)->insert(Html::elem('p')->title($nazev_title)->setText(Core::trimMarker($title, Config::TRIMMARKER_DIR))
                   ->setText('--%s %s--', array((!is_writable($pathdir) ? 'dir notwrite' : NULL), ($count_pic['writable'] != $count_pic['count'] ? 'pic notwrite' : '')))  //TODO doresit! co a jak s timto?!
            )
                                                                                                                                            ;
            $li_size = Html::elem('li')->class($column['size']['class'])->setText($dir_size);
            $li_count = Html::elem('li')->class($column['count']['class'])->setText(sprintf(ngettext('%s photo', '%s photos', $count_pic['count']), $count_pic['count']));
            $owner = (Core::isApacheOwner($pathdir) ? _('server') : _('client')); //TODO zdrejme vyhodit je k nicemu?!
            $li_perm = Html::elem('li')->class($column['permit']['class'])
                                      ->insert(Html::elem('p')->setText(Core::getFilePermissions($pathdir)))
                                      ->insert(Html::elem('p')->setText($owner));

            $row[] = Html::elem('ul')  //obal polozky
                          ->class($stav)
                          ->class(empty($row_data) ? 'not_in_database' : NULL)
                          ->id(!empty($row_data) ? sprintf('arrays_%s', Core::easyEncode($dir)) : NULL)  //jen kdyz je slozka aktivovana
                          ->insert($li_nazev)
                          ->insert($li_size)
                          ->insert($li_count)
                          ->insert($li_perm)
                          ->insert($links);
          }

          $a_text = _('Create directory');
          $createlink = Html::elem('a')->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'create'))
                                      ->id('create_directory')
                                      ->title($a_text)
                                      ->setText($a_text);

          $a_text = _('Delete selected directories');
          $href_class_deleteselect = 'delete_selected';
          $deleteselect = Html::elem('a')->href('#')
                                          ->class($href_class_deleteselect)
                                          ->title($a_text)
                                          ->onclick('deleteselect(); return false;')
                                          ->setText($a_text);

          $a_text = _('Add all to database');
          $activateall = Html::elem('a')->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'activateall'))
                                        ->id('all_to_database')
                                        ->title($a_text)
                                        ->setText($a_text);

          $url = array ('menu' => __CLASS__,
                        'co' => 'sortdirs',
                        'weburl' => self::$weburl,
                        );

          $sel_url = Core::makeUrl(self::$adminurl, array('query' => array($get_adress[0] => self::URL, $get_adress[1] => 'delsel', 'array' => ''), 'amp' => '&', 'path' => Administration::ADMIN_URL));

          $javascript = Html::elem('script')
                            ->type('text/javascript')
                            ->setText('
          //<![CDATA[
            function deleteselect() {
              var row = new Array();
              $(".%s").each(function(key, elem) {
                if (elem.checked) { row.push(elem.value); }
              });
              if (row.length != 0) {
                if (confirm(\'%s\')) {
                  var seznam = row.join(";;;");
                  location.href="%s"+encodeURI(seznam);
                }
              }
            }
            function enabledeletebutton(state) {
              var delselact = "delete_selected_active";
              if (state) {  //oznaceno
                $(".%s").addClass(delselact);
              } else {
                var poc = 0;
                $(".%s").each(function(key, elem) {
                  if (elem.checked) { poc++; }
                });
                if (poc == 0) {
                  $(".%s").removeClass(delselact);
                }
              }
            }
            $(document).ready(function(){
              $(function() {
                $("#wrap_sort").sortable({
                  tolerance: \'pointer\',
                  scroll: true,
                  scrollSensitivity: 40,
                  scrollSpeed: 30,
                  revert: 300,
                  opacity: 0.6,
                  cursor: \'move\',
                  delay: 150,
                  placeholder: \'placeholder_sort\',
                  items: \'ul:not(.inactive)\',
                  cancel: \'.inactive\',
                  activate: function() {
                    $("#status_drag").fadeOut("slow");
                  },
                  update: function() {
                    //<![CDATA[
                      var order = $(this).sortable("serialize") + "&%s";
                    //]]>
                    $.post("%sajax.php", order, function(theResponse) {
                      $("#status_drag").html(theResponse);
                    });
                    ZpracujHlasku(\'#status_drag\');
                  }
                });
                $("#wrap_sort").disableSelection();
              });
            });
            function ZpracujHlasku(ret) {
              $(ret).fadeIn(\'slow\').delay(2000).fadeOut(\'slow\');
            }
          //]]>
          ', array($checkbox_class_deleteselect,
            _('Really delete selected dir(s) ?'),
            $sel_url,
            $href_class_deleteselect,
            $checkbox_class_deleteselect,
            $href_class_deleteselect,
            http_build_query($url),
            self::$weburl));

          $header = Html::elem('ul')->class('inactive')->class('heading');
          foreach ($column as $value) {
            $header->insert(Html::elem('li')->class($value['class'])->setText($value['title']));
          }

          $result = Html::elem('div')
                        ->id('listing_dir')
                        ->insert($createlink)
                        ->insert($pocadd > 0 ? $activateall : NULL)
                        ->insert($deleteselect)
                        ->insert($javascript)
                        ->insert(Html::elem('div')
                                      ->id('wrap_sort')
                                      ->setText(self::synchronizeXml($key_load_data, $dirs))
                                      ->insert($header)
                                      ->insert($row)
                                      ->insert($header)
                                );
        break;

        case 'activate':  //activate dirs
          $id = base64_decode(Core::isFill($_GET, 'id'));
          if (!empty($id)) {
            $ret = self::activateSelectDir($id);
            if (!empty($ret)) {
              $result = Notification::info(_('%s added to database'))->arg($ret)->wait(Notification::NORMAL);
              Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
            }
          } else {
            Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl));
          }
        break;

        case 'activateall':
          $load_data = self::loadXmlData();
          $rets = array();
          $dirs = Core::getListDir(array('path' => $source_path));
          foreach ($dirs as $dir) {
            $index = self::getIndexGallery($dir);
            $row_data = Core::isFill($load_data, $index);
            if (empty($row_data)) {
              $ret = self::activateSelectDir($dir);
              if (!empty($ret)) {
                $rets[] = $ret;
              }
            }
          }
          if (!empty($rets)) {
            $result = Notification::info(_('%s added to database'))->args(Html::elem('br'), $rets)->wait(Notification::NORMAL);
            Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
          }
        break;

        case 'enabled': //enabled/disable dirs
          $id = base64_decode(Core::isFill($_GET, 'id'));
          $data = self::loadXmlData();
          $item = Core::isFill($data, $id);
          if (!empty($item)) {
            $data[$id]['enabled'] = !(boolean) $item['enabled'];
            if (XmlStorage::setData($xml_path, $data)) {
              $state = ($data[$id]['enabled'] ? _('%s unhidden') : _('%s hidden'));
              $result = Notification::successful($state)->arg($item['title'])->wait(Notification::NORMAL);
              Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
            }
          } else {
            Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl)); //presmerovani zpet
          }
        break;

        case 'page':  //nastavovani strankovani
          $id = base64_decode(Core::isFill($_GET, 'id'));
          $data = self::loadXmlData();

          $item = Core::isFill($data, $id);
          if (!empty($item)) {
            $paginate = Core::isFill($item, 'paginate', NULL);

            $form = new Form;
            $form->addBackLink(_('Back'), $adminurl, $backarray, array('id' => 'back_link_central'))
                  ->addCheckbox('enablepage', array('label' => _('Enable pagination'), 'label_class' => 'checkbox', 'checked' => Core::isFill($paginate, 'enabled', false)))
                    ->setTypeVariable(Form::TYPE_BOOL)
                  ->addText('perpage', array('value' => Core::isFill($paginate, 'perpage', 1), 'label' => _('Number items per page')))
                    ->addRule(Form::RULE_NUMERIC, _('Value number items per page must be numeric!'))
                    ->setTypeVariable(Form::TYPE_INTEGER)
                  ->addSubmit(__CLASS__.'_submit', array('value' => _('Set pagination')));

            $result = $form;

            if ($form->isSubmitted()) {
              $data[$id]['paginate'] = array('enabled' => $form->enablepage,
                                            'perpage' => $form->perpage);

              if (XmlStorage::setData($xml_path, $data)) {
                $result = Notification::info(_('Settings pagination sucessfull'))->wait(Notification::NORMAL);
                Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
              }
            }

            if ($form->isErrors()) {
              $result .= Notification::warning(_('Wrong: %s'))->arg($form->getErrors());
            }
          } else {
            Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl)); //presmerovani zpet
          }
        break;

        case 'create':  //create new dir
          try {
            $form = new Form;
            $form->addBackLink(_('Back'), $adminurl, $backarray, array('id' => 'back_link_central'))
                  ->addText('namedir', array('value' => '', 'label' => _('Name for new dir'), 'placeholder' => _('Here type name directory...')))
                    ->addRule(Form::RULE_FILLED, _('Folder name must be filled!'))
                  ->addSubmit(__CLASS__.'_submit', array('value' => _('Create')));

            $result = $form;

            if ($form->isSubmitted()) {
              $namedir = $form->getValue('namedir');
              $pathdir = sprintf('%s/%s', $source_path, $namedir);

              if (!file_exists($pathdir)) {
                if (@mkdir($pathdir)) {
                  $result = Notification::successful(_('%s successfully created directory!'))->arg($namedir)->wait(Notification::NORMAL);
                  $refreshurl['query'] = $backarray + array($get_adress[1] => 'activate', 'id' => base64_encode($namedir));
                  Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
                } else {
                  throw new ExceptionModuleDirs(sprintf(GlobalText::s(__METHOD__, 'nocreate'), $namedir));
                }
              } else {
                throw new ExceptionModuleDirs(sprintf(GlobalText::s(__METHOD__, 'alreadyexists'), $namedir));
              }
            }

            if ($form->isErrors()) {
              $result .= Notification::warning(_('Wrong: %s'))->arg($form->getErrors());
            }
          } catch (ExceptionModuleDirs $e) {
            Administration::setErrors($e)->wait(Notification::NORMAL);
            Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
          }
        break;

        case 'rename':  //rename dirs
          try {

            $id = base64_decode(Core::isFill($_GET, 'id'));
            $data = self::loadXmlData();

            $backarray = array($get_adress[0] => self::URL);

            $item = Core::isFill($data, $id);
            if (!empty($item)) {
              $form = new Form;
              $form->addBackLink(_('Back'), $adminurl, $backarray, array('id' => 'back_link_central'))
                    ->addText('dir', array('value' => $item['title'], 'label' => _('New name dir')))
                      ->addRule(Form::RULE_FILLED, _('Folder name must be filled!'))
                    ->addSubmit(__CLASS__.'_submit', array('value' => _('Save')));

              $result = $form;

              if ($form->isSubmitted()) {
                $values = $form->getValues();
                $newname = Core::getInteligentRewrite($values['dir']);

                //if ($data[$id]['name'] != $newname) {
                if ($item['title'] != $values['dir']) {
                  if (!@rename(sprintf('%s/%s', $source_path, $item['name']), sprintf('%s/%s', $source_path, $newname))) {
                    throw new ExceptionModuleDirs(GlobalText::s(__METHOD__, 'badpermit'));
                  }
                  $newindex = self::getIndexGallery($newname);  //jen tu se musi udelat novy index
                  $data[$newindex] = $item; //preneseni stareho id do noveho
                  $data[$newindex]['name'] = $newname;  //do noveho se vlozi i nove jmeno!!
                  $data[$newindex]['title'] = $values['dir'];
                  if ($id != $newindex) { //pokud jsou ruzne indexy tak ten stary odstrani!
                    $data[$id] = NULL;  //odstraneni indexu
                  }

                  if (XmlStorage::setData($xml_path, $data)) {
                    $result = Notification::info(_('%s renamed'))->arg($values['dir'])->wait(Notification::NORMAL);
                  }
                } else {
                  $result = Notification::info(_('nothing renamed, name is equally'))->wait(Notification::NORMAL);
                }

                Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
              }

            } else {
              //throw new ExceptionModuleDirs(GlobalText::s(__METHOD__, 'badindex'));
              Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl)); //presmerovani zpet
            }

          } catch (ExceptionModuleDirs $e) {
            Administration::setErrors($e);
          }
        break;

        case 'del':
          $id = base64_decode(Core::isFill($_GET, 'id'));

          if (!empty($id)) {
            $ret = self::deleteSelectDir($id);
            if (!empty($ret)) {
              $result = Notification::info(_('%s deleted'))->arg($ret)->wait(Notification::NORMAL);
              Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
            }
          } else {
            Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl)); //presmerovani zpet
          }
        break;

        case 'delsel':  //mazani vybrane slozky
          $array_id = explode(';;;', Core::isFill($_GET, 'array'));
          $decode_array = array_map('base64_decode', $array_id);

          if (!empty($decode_array)) {
            $dirs = array();
            foreach ($decode_array as $id) {
              $ret = self::deleteSelectDir($id);
              if (!empty($ret)) {
                $dirs[] = $ret;
              }
            }

            if (!empty($dirs)) {
              $result = Notification::info(_('%s deleted'))->args(Html::elem('br'), $dirs)->wait(Notification::NORMAL);
              Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
            }
          } else {
            Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl)); //presmerovani zpet
          }
        break;

        case 'delall':  //smazani obsahu
          try {
            $id = base64_decode(Core::isFill($_GET, 'id'));
            $data = self::loadXmlData();

            $item = Core::isFill($data, $id);
            if (!empty($item)) {
              $dirname = $item['name'];
              $path = sprintf('%s/%s', $source_path, $dirname);

              $subcont = Core::getListRecursiveAll(array('path' => $path, 'full' => true, 'onlyfile' => true));
              if (!empty($subcont)) {
                foreach ($subcont as $file) {
                  if (is_writable($file) && is_file($file)) {
                    if (@!unlink($file)) {
                      throw new ExceptionModuleDirs(sprintf(GlobalText::s(__METHOD__, 'nounlink'), $file));
                    }
                  } else {
                    throw new ExceptionModuleDirs(sprintf(GlobalText::s(__METHOD__, 'nowrite'), $file));
                  }
                }

                $result = Notification::info(_('%s all content deleted'))->arg($item['title'])->wait(Notification::NORMAL);
                Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
              } else {
                $result = Notification::info(_('%s no content'))->arg($item['title'])->wait(Notification::NORMAL);
                Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshurl));
              }
            } else {
              Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl)); //presmerovani zpet
            }
          } catch (ExceptionModuleDirs $e) {
            Administration::setErrors($e);
          }
        break;
      }

      return $result;
    }

//privatni metoda pro obsluhu mazani jednotlivych slozek
    private static function deleteSelectDir($id) {
      try {

        $result = NULL;
        $source_path = self::$source_path;
        $xml_path = self::getXmlPath();

        $data = self::loadXmlData();

        $item = Core::isFill($data, $id);
        if (!empty($item)) {
          $dirname = $item['name'];
          $title = $item['title'];
          $path = sprintf('%s/%s', $source_path, $dirname);
          if (!file_exists($path)) {
            throw new ExceptionModuleDirs(sprintf(GlobalText::s(__METHOD__, 'noexist'), $path));
          }

          $subcont = Core::getListRecursiveAll(array('path' => $path, 'full' => true));

          if (!empty($subcont)) {
            //smazani obsahu
            foreach ($subcont as $file) {
              $basefile = basename($file);
              if (is_writable($file)) {
                if (is_file($file)) {
                  if (!@unlink($file)) {
                    throw new ExceptionModuleDirs(sprintf(GlobalText::s(__METHOD__, 'nounlink'), $basefile));
                  }
                }

                if (is_dir($file)) {
                  if (!@rmdir($file)) {
                    throw new ExceptionModuleDirs(sprintf(GlobalText::s(__METHOD__, 'normdir'), $basefile));
                  }
                }
              } else {
                throw new ExceptionModuleDirs(sprintf(GlobalText::s(__METHOD__, 'badpermit'), $basefile));
              }
            }
          }
          //nakonec smazani samotneho adresare
          if (!@rmdir($path)) {
            throw new ExceptionModuleDirs(sprintf(GlobalText::s(__METHOD__, 'normdir'), $path));
          }

          //pokud je vse uspesne smazano tak muze odmaznout i zaznam...
          $data[$id] = NULL;
          if (XmlStorage::setData($xml_path, $data)) {
            $result = $title;
          }
        }

      } catch (ExceptionModuleDirs $e) {
        Administration::setErrors($e);
      }
      return $result;
    }

//privateni metoda pro obsluhu aktivovani slozky
    private static function activateSelectDir($id) {
      try {
        $result = NULL;
        $source_path = self::$source_path;
        $xml_path = self::getXmlPath();

        $data = self::loadXmlData(true);

        $safename = Core::getInteligentRewrite($id);

        $final = array();
        $index = self::getIndexGallery($safename);
        $new = array($index => array('name' => $safename, 'title' => $id, 'enabled' => true, 'files' => array(), 'paginate' => ''));
        $dest = sprintf('%s/%s', $source_path, $safename);
        $concat_path = _('%s-%s');
        $concat_name = _('%s %s');
        if (is_array($data)) {
          if (array_key_exists($index, $data)) { //kontroluje jestli existuje index
            if (file_exists($dest)) {
              $incfile = Core::getIncNameFile($dest, $concat_path);  //zaneseni indexu
              $poc = $incfile['index'];
              $safename = sprintf($concat_path, $safename, $poc);
              $title = sprintf($concat_name, $id, $poc);  //novy title
              $index = self::getIndexGallery($safename);
              //musi se udelat nove pole new
              $new = array($index => array('name' => $safename, 'title' => $title, 'enabled' => true, 'files' => array(), 'paginate' => ''));
            }
          }
          //prejmenovani pokud se vstup lisi od projeteho jmena
          if ($id != $safename) {
            $incfile = Core::getIncNameFile($dest, $concat_path);  //zaneseni cesty
            if (!@rename(sprintf('%s/%s', $source_path, $id), $incfile['path'])) {
              throw new ExceptionModuleDirs(GlobalText::s(__METHOD__, 'badpermit'));
            }
          }

          $final = array_merge($data, $new);
        } else {
          $final = $new;
        }

        if (XmlStorage::setData($xml_path, $final)) {
          $result = $id;
        }

      } catch (ExceptionModuleDirs $e) {
        Administration::setErrors($e);
      }
      return $result;
    }

//metoda pro obsluhu ajaxu
    public static function getAjax() {
      $result = NULL;

      $co = Core::isFill($_POST, 'co');

      switch ($co) {
        case 'sortdirs':
          $arrays = Core::isFill($_POST, 'arrays');

          Notification::setPath($_POST['weburl']);

          $xml_path = self::getXmlPath();
          $data = self::loadXmlData();

          //nacita si core primo
          $decode_array = array_map('classes\Core::easyDecode', $arrays);
          if (!empty($decode_array)) {
            $new_data = array();
            foreach ($decode_array as $dir) {
              $index = self::getIndexGallery($dir);
              $new_data[$index] = $data[$index];  //preskladani pole
            }

            if (XmlStorage::setData($xml_path, $new_data)) {
              $result = Notification::info(_('Sucessfull saved'))->wait(Notification::SMALL);
            }
          }
        break;
      }
      return $result;
    }
  }

  class ExceptionModuleDirs extends Exception {}

?>
