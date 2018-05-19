<?php
/*
 *      modulepictures.php
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
      classes\Imagic,
      classes\Notification,
      classes\GlobalText,
      \Config,
      Exception;

  final class ModulePictures implements Module {
    const URL = 'file';
    const VERSION = 1.86;

//vraci nazev modulu
    public static function getName() {
      return _('Pictures');
    }

//vraci pole nazvu sekci
    public static function getSection() {
      return array ('' => _('Listing Directory'),
                    'dir' => _('%s'),
                    'upload' => _('Upload: %s'),
                    'gen' => _('Generated pictures: %s'),
                    'edit' => _('Edit: %s'),
                    'del' => _('Delete: %s'),
                    'delsel' => _('Delete select photo(s)'),
                    );
    }

//skripty potrebne pro vykreslovani v dane sekci
    public static function getLoadModules() {
      return array('dir' => array('js' => array('script/tipsy-0.1.7/jquery.tipsy.js',
                                                'script/prettyphoto-3.1.2/jquery.prettyphoto.js',
                                                ),
                                  'css' => array('script/tipsy-0.1.7/tipsy.css',
                                                'script/prettyphoto-3.1.2/prettyphoto.css',
                                                ),
                                  ),
                  //'*' => array('js' => array('script/nejaky_mocny.js')),
                  );
    }

//vraci aktualni stav modulu
    public static function getState() {
      try {
        if (!$result = class_exists('classes\Imagic')) {
          throw new ExceptionModulePictures(GlobalText::s(__METHOD__));
        }
      } catch (ExceptionModulePictures $e) {
        Administration::setErrors($e);
      }
      return $result;
    }

//FIXME predelat!!!!!!
    private static $weburl = NULL;
    private static $adminurl = NULL;
    private static $source_path = NULL;

//nastavovani pathe, admin a web url
    public static function setPath($path = NULL, $adminurl = NULL, $weburl = NULL) {
      self::$source_path = sprintf('%s%s', $path, Config::SOURCE);  //path v adresarich
      self::$adminurl = $adminurl;  //url adminu
      self::$weburl = $weburl;  //url webu
    }

//obsluha synchronizace s filesytemem
    private static function synchronizeXml($id) {
      try {
        $result = NULL;

        $source_path = self::$source_path;

        $get_adress = Administration::getGetAdress();

        $xml_path = ModuleDirs::getXmlPath();
        $load_data = XmlStorage::getData($xml_path);
        $name = $load_data[$id]['name'];
        $title = $load_data[$id]['title'];

        $files = $load_data[$id]['files'];
        $files_key = array_keys($files);

        $full_path = sprintf('%s/%s', $source_path, $name);
        $full_files = Core::getListFile(array('path' => $full_path, 'sort' => array(Core::LIST_SORT_SELF => $files_key)));

        $mini_path = sprintf('%s/%s/%s', $source_path, $name, Config::THUMB);
        $mini_files = Core::getListFile(array('path' => $mini_path));

        $backarray = array('query' => array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'iddir' => base64_encode($id)), 'path' => Administration::ADMIN_URL);

        $newitem = array();
        $generate = array();
        foreach ($full_files as $file) {
          //prohledava jestli soubory z file systemu jsou obsazeny v klici pole databaze
          if (!array_key_exists($file, $files)) {
            $file_path = sprintf('%s/%s', $full_path, $file);
            $pathinfo = pathinfo($file_path);
            $source = sprintf('%s/%s', $full_path, $file);
            //$filename = md5_file($file_path);
            $filename = strtotime('now').uniqid('-');
            $newfile = sprintf('%s.%s', $filename, Core::isFill($pathinfo, 'extension', 'txt'));
            $newpath = sprintf('%s/%s', $full_path, $newfile);
            if (is_writable($source)) {
              if (!@rename($source, $newpath)) { //prejmenuje nebezpecny nazev na bezpecny
                throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'norename'), $newfile));
              }
            } else {
              throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'badpermit'), basename($source)));
            }

            $newitem[$newfile] = $file; //do indexu jde nazev souboru a do hodnoty komentar, defaultne stary nazev
            //ty ktere nejsou vygenerovane si prida do seznemu na vygenerovani
            $generate[] = $newfile; //prida novy soubor na vygenerovani
          } else {
            //kontrola jestli existuje miniatura, pokud neexistuje tak prida do pole generovani
            $file_path = sprintf('%s/%s/%s', $full_path, Config::THUMB, $file);
            if (!file_exists($file_path)) {
              $generate[] = $file;
            }
            $newitem[$file] = $files[$file];
          }
        }

        //pokud se new a old pole nerovani tak teprve pak uklada
        if ($newitem != $files || !empty($generate)) {
          $load_data[$id]['files'] = $newitem;
          if (XmlStorage::setData($xml_path, $load_data)) {
            if (!empty($generate)) {
              $result[] = Notification::info(_('Redirect on generated photo %s'))->arg($title)->wait(Notification::NORMAL);
              //presmerovani na generovani miniatur
              $url = array('query' => array($get_adress[0] => self::URL, $get_adress[1] => 'gen', 'iddir' => base64_encode($id), 'files' => $generate), 'path' => Administration::ADMIN_URL);
              Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $url));
            } else {
              $result[] = Notification::info(_('Refresh for synchronize...'))->wait(Notification::NORMAL);
              Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $backarray));
            }
          }
        } else {
          //kontrola fotek ktere jsou navic v miniaturach
          //mini vs full (ktere jsou navic v mini)
          if (!empty($mini_files)) {  //pokud jsou nejake fotky v mini
            $diff = array_diff($mini_files, $full_files);
            if (!empty($diff)) {
              $state = true;
              foreach ($diff as $file) {
                $path = sprintf('%s/%s', $mini_path, $file);
                if (is_writable($mini_path)) {
                  if (!@unlink($path)) {
                    $state = false;
                  }
                } else {
                  $state = false;
                }
              }

              if ($state) {
                $result[] = Notification::info(_('File mini synchronized: %s'))->args(', ', $diff)->wait(Notification::NORMAL);
                Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $backarray));
              } else {
                $result[] = Notification::warning(_('does not write to thumbnails gallery'));
              }
            }
          }
        }

      } catch (ExceptionModulePictures $e) {
        Administration::setErrors($e);
      }
      return $result;
    }

    //uprava komentaru a mazani obrazku
    public static function getAdminContent($co) {
      $result = NULL;
      $source_path = self::$source_path;

      $adminurl = Core::makeUrl(self::$adminurl, array('path' => Administration::ADMIN_URL));
      $get_adress = Administration::getGetAdress();

      $backarray = array($get_adress[0] => self::URL);
      $refreshurl = array('query' => $backarray, 'path' => Administration::ADMIN_URL);
      $backdirarray = $backarray + array($get_adress[1] => 'dir', 'iddir' => Core::isFill($_GET, 'iddir'));
      $refreshdirurl = array('query' => $backdirarray, 'path' => Administration::ADMIN_URL);

      $xml_path = ModuleDirs::getXmlPath();

      switch ($co) {
        default:  //vypis
          $dirs = ModuleDirs::getActiveDirs();

          $column = array('name' => array('class' => 'name', 'title' => _('Name')),
                          'size' => array('class' => 'size', 'title' => _('Size')),
                          'count' => array('class' => 'number', 'title' => _('Count pictures')),
                          'state' => array('class' => 'status', 'title' => _('Status')),
                          );

          $row = array();
          foreach ($dirs as $dir => $conf) {
            $iddir = base64_encode($dir);

            $name = $dirs[$dir]['name'];
            $title = $dirs[$dir]['title'];
            $count_files = count($dirs[$dir]['files']);
            $pathdir = sprintf('%s/%s', $source_path, $name);
            $count_pic = Core::getCountListFile(array('path' => $pathdir, 'onlywrite' => true));
            $size = Core::getSizeDir($pathdir, true);
            $dir_size = (Core::calculateSize($size) ?: _('Empty dir'));  //cele slozky

            $stav = ($size > 0 ? ($count_files == 0 ? _('Not in database') : _('In database')) : _('Empty'));
            $status = ($size > 0 ? ($count_files == 0 ? 'inactive' : 'active') : 'empty');

            $li_nazev = Html::elem('li')->class($column['name']['class'])
                                        ->class($count_pic['writable'] != $count_pic['count'] ? 'wrongpermit' : 'okpermit')
                                        ->insert($count_pic['writable'] != $count_pic['count'] ? Html::span()->setText('neni zapis na souborech,') : NULL)
                                        ->insert(!is_writable($pathdir) ? Html::span()->setText('neni zapis na slozku') : NULL)
                                        ->insert(Html::elem('a')->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'iddir' => $iddir))
                                                                ->title($title)
                                                                ->setText(Core::trimMarker($title, Config::TRIMMARKER_PIC))
                                                );
            $li_size = Html::elem('li')->class($column['size']['class'])->setText($dir_size);
            $li_count = Html::elem('li')->class($column['count']['class'])->setText(sprintf(ngettext('%s photo', '%s photos', $count_pic['count']), $count_pic['count']));
            $li_state = Html::elem('li')->class($column['state']['class'])->class($status)->setText($stav);

            $row[] = Html::elem('ul')  //obal polozky
                          ->insert($li_nazev)
                          ->insert($li_size)
                          ->insert($li_count)
                          ->insert($li_state);
          }

          $header = Html::elem('ul')->class('heading');
          foreach ($column as $value) {
            $header->insert(Html::elem('li')->class($value['class'])
                                            ->setText($value['title'])
                            );
          }

          $result = Html::elem('div')
                        ->id('listing_pic')
                        ->insert($header)
                        ->insert($row)
                        ->insert($header);
        break;

        case 'dir': //vyber galerie
          $hashid = Core::isFill($_GET, 'iddir');
          $id = base64_decode($hashid);

          $data = ModuleDirs::getActiveDirs();
          $item = Core::isFill($data, $id);
          if (!empty($item)) {
            $row = array();
            $delsel_link = NULL;
            $checkbox_class = 'checkbox_selective_delete';

            $name = $item['name'];

            $path = sprintf('%s/%s', $source_path, $name);

            $files = $item['files'];
            if (!empty($files)) {
              $imgurl = sprintf('%s%s/%s', self::$weburl, Config::SOURCE, $name);
              foreach ($files as $file => $comment) {
                $idfile = base64_encode($file);

                $mini_path = sprintf('%s/%s/%s', $path, Config::THUMB, $file);
                $full_path = sprintf('%s/%s', $path, $file);

                $img = Html::elem('img')
                            ->src(sprintf('%s/%s/%s', $imgurl, Config::THUMB, $file))
                            ->alt(htmlspecialchars(Core::trimMarker($comment, Config::TRIMMARKER_LISTPIC)));  //zkracovanu kvuli galerii

                $links = array();
                $links[] = Html::elem('a')
                                ->href(sprintf('%s/%s', $imgurl, $file))
                                ->rel('prettyPhoto[pp_gal]')
                                ->class('photo_item')
                                ->class('tipsy_photo')
                                ->class('pretty_photo')
                                ->title(htmlspecialchars($comment))
                                ->insert($img);

                $a_text = _('Edit');
                $links[] = Html::elem('a')
                                ->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'edit', 'iddir' => $hashid, 'id' => $idfile))
                                ->class('edit_photo')
                                ->title($a_text)
                                ->setText($a_text);

                $a_text = _('Delete');
                $links[] = Html::elem('a')
                                ->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'del', 'iddir' => $hashid, 'id' => $idfile))
                                ->class('delete_photo')
                                ->title($a_text)
                                ->setText($a_text)
                                ->onclick(sprintf('return confirm(\'%s\');', sprintf(_('Really delete photo: &quot;%s&quot; ?'), urlencode($comment))));

                $html_check = Html::elem('input')->type('checkbox')
                                                ->class($checkbox_class)
                                                ->class('input_delsel')
                                                ->value($idfile)
                                                ->onclick('enablebutton(this.checked);');

                $row[] = Html::elem('li')
                              ->insert($html_check)
                              ->insert(Html::elem('p')->class('move_photo')->setText(_('Move')))
                              ->insert($links)
                              ->id(sprintf('arrays_%s', Core::easyEncode($idfile)));
              }

              $a_text = _('Delete selected photo(s)');
              $delsel_link = Html::elem('a')->href('#')
                                            ->class('delete_selected')
                                            ->title($a_text)
                                            ->onclick('deleteselect(); return false;')
                                            ->setText($a_text);
            } else {
              $row = Html::elem('p')->id('no_photo')->setText(_('No photos'));
            }

            if (is_writable($path)) {
              $a_text = _('upload new picture');
              $upload_link = Html::elem('a')->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'upload', 'iddir' => $hashid))
                                            ->id('upload_picture')
                                            ->title($a_text)
                                            ->setText($a_text);
            } else {
              $upload_link = Html::elem('p')->id('upload_picture')
                                            ->setText(_('Can not write to folder'));
            }

            $a_text = _('Back');
            $back_link = Html::elem('a')->href($adminurl, $backarray)
                                        ->id('back_link')
                                        ->title($a_text)
                                        ->setText($a_text);

            $url = array ('menu' => __CLASS__,
                          'co' => 'sortdirs',
                          'iddir' => $hashid,
                          'weburl' => self::$weburl,
                          );

            $sel_url = Core::makeUrl(self::$adminurl, array('query' => array($get_adress[0] => self::URL, $get_adress[1] => 'delsel', 'iddir' => $hashid, 'array' => ''), 'amp' => '&', 'path' => Administration::ADMIN_URL));

            $javascript = Html::elem('script')
                              ->type('text/javascript')
                              ->setText(sprintf('
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
                function enablebutton(state) {
                  if (state) {  //oznaceno
                    $(".delete_selected").addClass("delete_selected_active");
                  } else {
                    var poc = 0;
                    $(".%s").each(function(key, elem) {
                      if (elem.checked) { poc++; }
                    });
                    if (poc == 0) {
                      $(".delete_selected").removeClass("delete_selected_active");
                    }
                  }
                }
                $(document).ready(function(){
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
                      handle: \'.move_photo\',
                      activate: function() {
                        $("#status_drag").fadeOut("slow");
                        //$("#wrap_content #listing_photo ul#wrap_sort li a.tipsy_photo").tipsy({trigger: "manual"});
                      },
                      update: function() {
                        var order = $(this).sortable("serialize") + "&%s";
                        $.post("%sajax.php", order, function(theResponse) {
                          $("#status_drag").html(theResponse);
                        });
                        ZpracujHlasku("#status_drag");
                      }
                  });
                  $("#wrap_content #listing_photo ul#wrap_sort li a.tipsy_photo").tipsy({gravity: $.fn.tipsy.autoWE});
                  $("#wrap_content #listing_photo ul#wrap_sort li a.pretty_photo").prettyPhoto({slideshow: 5000, social_tools: false, deeplinking: false});
                });
                function ZpracujHlasku(ret) {
                  $(ret).fadeIn("slow").delay(2000).fadeOut("slow");
                }
              //]]>
            ', $checkbox_class,
              _('Really delete selected photo(s) ?'),
              $sel_url,
              $checkbox_class,
              http_build_query($url),
              self::$weburl)
            );

            $result = Html::elem('div')
                          ->id('listing_photo')
                          ->insert($javascript)
                          ->insert($back_link)
                          ->insert($upload_link)
                          ->insert($delsel_link)
                          ->insert(Html::elem(empty($files) ? 'div' : 'ul')
                                        ->id('wrap_sort')
                                        ->setText(self::synchronizeXml($id))
                                        ->insert($row)
                                  );
          } else {
            Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl));
          }
        break;

        case 'upload':  //upload obrazku
          try {
            $hashid = Core::isFill($_GET, 'iddir');
            $id = base64_decode($hashid);

            $data = ModuleDirs::getActiveDirs();
            $item = Core::isFill($data, $id);
            if (!empty($item)) {
              $dirname = $item['name'];

              $form = new Form(array('enctype' => Form::MIME_MULTIPART));
              $form->addBackLink(_('Back'), $adminurl, $backdirarray, array('id' => 'back_link_central'))
                    ->addFile('pictures', array('label' => _('Select picture(s)'), 'multiple' => true))
                      ->addRule(Form::RULE_FILLED, _('Must be chosen some files!'))
                    ->addSubmit(__CLASS__.'_submit', array('value' => _('Upload')));

              $result = $form;

              //kontola prekroceni limitu
              $content_length = Core::isFill($_SERVER, 'CONTENT_LENGTH');
              $post_max_size = intval(ini_get('post_max_size')) * 1024 * 1024;  //konvert na cislo a prepocitana byte

              if ($content_length > $post_max_size) {
                throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'badlimit'), Core::calculateSize($content_length), Core::calculateSize($post_max_size)));
              }

              if ($form->isSubmitted()) {
                $pictures = $form->getValue('pictures');

                $tmp_name = $pictures['tmp_name'];
                $name = $pictures['name'];
                $error = $pictures['error'];

                $state = true;
                foreach ($tmp_name as $index => $tmp) {
                  if ($error[$index] == UPLOAD_ERR_OK) {
                    $path = sprintf('%s/%s/%s', $source_path, $dirname, $name[$index]);
                    if (!@move_uploaded_file($tmp, $path)) {
                      $state = false;
                    }
                  }
                }

                if ($state) {
                  $result = Notification::info(_('Photos successfully uploaded!'))->wait(Notification::NORMAL);
                } else {
                  $result = Notification::warning(_('Upload Images Failed'))->wait(Notification::NORMAL);
                }
                Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshdirurl));
              }

              if ($form->isErrors()) {
                $result .= Notification::warning(_('Wrong: %s'))->arg($form->getErrors());
              }
            }

          } catch (ExceptionModulePictures $e) {
            Administration::setErrors($e);
          }
        break;

        case 'gen':  //generovani miniatur
          try {

            $originalid = Core::isFill($_GET, 'iddir');
            $id = base64_decode($originalid);

            $files = Core::isFill($_GET, 'files');

            $data = ModuleDirs::getActiveDirs();

            $item = Core::isFill($data, $id);
            if (!empty($item)) {
              $dirname = $item['name'];

              $pathdir = sprintf('%s/%s', self::$source_path, $dirname);
              $mini_path = sprintf('%s/%s', $pathdir, Config::THUMB);

              if (is_writable($pathdir)) {
                if (!file_exists($mini_path)) {
                  if (!@mkdir($mini_path)) {
                    throw new ExceptionModulePictures(GlobalText::s(__METHOD__, 'nomkdir'));
                  }
                }
              } else {
                throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'badpermit'), $dirname, Html::elem('br')));
              }

              $data_settings = ModuleSettings::getXmlData();

              $maxsizew = Core::isNull($data_settings, 'maxsizew', Config::MAXSIZEW);
              $maxsizeh = Core::isNull($data_settings, 'maxsizeh', Config::MAXSIZEH);

              $pictures = array();
              foreach ($files as $file) {
                $full_path = sprintf('%s/%s', $pathdir, $file);
                if (is_readable($full_path) &&
                    ($maxsizew != 0 && $maxsizeh != 0 ? is_writable($full_path) : true)) {
                  $pictures[] = array('name'=> $item['files'][$file],
                                      'mini' => sprintf('%s/%s/%s', $pathdir, Config::THUMB, $file),
                                      'full' => $full_path,
                                      );
                } else {
                  if (!is_readable($full_path)) {
                    throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'noread'), $file));
                  }

                  if (!is_writable($full_path)) {
                    throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'nowrite'), $file));
                  }
                }
              }

              $datas = array('files' => $pictures,
                              'dir' => $id,
                              'mini_path' => $mini_path,
                              'minsizew' => Core::isNull($data_settings, 'minsizew', Config::MINSIZEW),
                              'minsizeh' => Core::isNull($data_settings, 'minsizeh', Config::MINSIZEH),
                              'maxsizew' => $maxsizew,
                              'maxsizeh' => $maxsizeh,
                              );

              $url = array ('menu' => __CLASS__,
                            'co' => 'gen',
                            'data' => Core::encodeData(json_encode($datas)),
                            'adminurl' => Core::makeUrl(self::$adminurl, $refreshdirurl + array('amp' => '&')),
                            );

              $javascript = Html::elem('script')
                              ->type('text/javascript')
                              ->setText(sprintf('
                //<![CDATA[
                function generovani() {
                  $(document).ready(function() {
                    $.post("%sajax.php", "%s", function(data) {
                      $("#wrap_generate").html(data);
                    });
                  });
                }
                //]]>
                generovani();
                ', self::$weburl, http_build_query($url)));

              $result = Html::elem('div')->id('wrap_generate')
                                          ->insert($javascript)
                                          ->insert(Html::elem('p')->id('wait_text')->setText(_('Please wait being prepared for generating images...')));

            }
          } catch (ExceptionModulePictures $e) {
            Administration::setErrors($e);
            $result = Html::elem('a')->href($adminurl, $backarray)
                                      ->id('back_link_central')
                                      ->setText(_('Back'));
          }
        break;

        case 'edit': //uprava komentaru
          $hashiddir = Core::isFill($_GET, 'iddir');
          $iddir = base64_decode($hashiddir); //id adresare
          $id = base64_decode(Core::isFill($_GET, 'id')); //id fotky

          $data = XmlStorage::getData($xml_path);  //tady se musi nacitat vsechno aby se i vsechno ukladalo
          $item = Core::isFill($data, $iddir);
          if (!empty($item)) {  //osetreni pokud je spatne iddir
            $subitem = Core::isNull($item['files'], $id, NULL);
            if (!is_null($subitem)) { //osetreni pokud je spatne id
              $form = new Form;
              $form->addBackLink(_('Back'), $adminurl, $backdirarray, array('id' => 'back_link_central'))
                    ->addTextArea('comment', array('label' => _('Comment:'), 'value' => $subitem))
                    ->addSubmit(__CLASS__.'_submit', array('value' => _('Edit comment')));

              $result = $form;

              if ($form->isSubmitted()) {
                $values = $form->getValues();
                $data[$iddir]['files'][$id] = $form->getValue('comment');
                if (XmlStorage::setData($xml_path, $data)) {
                  $result = Notification::info(_('Comment saved!'))->wait(Notification::NORMAL);
                  Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshdirurl));
                }
              }
            } else {
              Core::setLocation(Core::makeUrl(self::$adminurl, $refreshdirurl + array('amp' => '&')));
            }
          } else {
            Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl));
          }
        break;

        case 'del': //mazani mini a full
          try {
            $hashiddir = Core::isFill($_GET, 'iddir');
            $iddir = base64_decode($hashiddir);
            $id = base64_decode(Core::isFill($_GET, 'id'));

            $data = XmlStorage::getData($xml_path);

            $item = Core::isFill($data, $iddir);
            if (!empty($item)) {
              $name = $item['name'];
              $comment = Core::isFill($item['files'], $id, $id);

              $mini_path = sprintf('%s/%s/%s/%s', $source_path, $name, Config::THUMB, $id);
              $full_path = sprintf('%s/%s/%s', $source_path, $name, $id);

              if (file_exists($mini_path)) {
                if (!@unlink($mini_path)) {
                  throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'nodelthumb'), $mini_path));
                }
              }

              if (file_exists($full_path)) {
                if (!@unlink($full_path)) {
                  throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'nodelfull'), $full_path));
                }
              }

              $data[$iddir]['files'][$id] = NULL;

              if (XmlStorage::setData($xml_path, $data)) {
                $result = Notification::info(_('Deleted: %s'))->arg($comment)->wait(Notification::NORMAL);
                Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshdirurl));
              }
            } else {
              Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl));
            }
          } catch (ExceptionModulePictures $e) {
            Administration::setErrors($e);
          }
        break;

        case 'delsel':  //mazani vybranych souboru
          try {
            $hashiddir = Core::isFill($_GET, 'iddir');
            $iddir = base64_decode($hashiddir);
            $array_id = explode(';;;', Core::isFill($_GET, 'array'));
            $decode_array = array_map('base64_decode', $array_id);

            $data = XmlStorage::getData($xml_path);
            $item = Core::isFill($data, $iddir);
            if (!empty($item)) {
              $dir = $item['name'];
              $files = array();
              foreach ($decode_array as $file) {
                $files[] = $item['files'][$file];

                $mini_path = sprintf('%s/%s/%s/%s', $source_path, $dir, Config::THUMB, $file);
                $full_path = sprintf('%s/%s/%s', $source_path, $dir, $file);

                if (file_exists($mini_path) && !@unlink($mini_path)) {
                  throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'nodelonethumb'), $mini_path));
                }

                if (file_exists($full_path) && !@unlink($full_path)) {
                  throw new ExceptionModulePictures(sprintf(GlobalText::s(__METHOD__, 'nodelonefull'), $full_path));
                }

                $data[$iddir]['files'][$file] = NULL;
              }

              if (XmlStorage::setData($xml_path, $data)) {
                $result = Notification::info(_('Deleted: %s'))->args(Html::elem('br'), $files)->wait(Notification::NORMAL);
                Core::setRefresh(Config::TIME_EDIT, Core::makeUrl(self::$adminurl, $refreshdirurl));
              }
            } else {
              Core::setLocation(Core::makeUrl(self::$adminurl, $refreshurl));
            }
          } catch (ExceptionModulePictures $e) {
            Administration::setErrors($e);
          }
        break;
      }
      return $result;
    }

//obsluha ajaxu
    public static function getAjax() {
      $result = NULL;

      $get_adress = Administration::getGetAdress();

      $co = Core::isFill($_POST, 'co');
      switch ($co) {
        case 'gen':
          $data = json_decode(Core::decodeData($_POST['data']));

          if (!empty($data->files)) {
            $count = count($data->files);
            $name = '';
            foreach ($data->files as $index => $file) {
              if (!file_exists($file->mini)) {
                $name = $file->name;
                //overeni jestli se jedna o obrazek
                if (Imagic::isPicture($file->full)) {
                  //vytvoreni mini
                  $image = new Imagic($file->full);
                  $image->thumbnailImage($data->minsizew, $data->minsizeh, true);
                  $image->writeImage($file->mini);

                  //pokud jsou obe hodnoty max nenulove - deprecated - postrada to smyslu ;)
                  if ($data->maxsizew != 0 && $data->maxsizeh != 0) {
                    //uprava full
                    $image = new Imagic($file->full);
                    $image->thumbnailImage($data->maxsizew, $data->maxsizeh, true);
                    $image->writeImage();
                  }
                  break;
                } else {
                  echo Notification::error(_('File: %s does not picture!'))->arg(basename($file->full));
                  unlink($file->full);
                  exit;
                }
              }
            }

            $poc = $index + 1;
            $percent = round((100 / $count) * $poc);

            $res = array ('url' => $_POST['adminurl'],
                          );

            $json = json_encode($res);

            $result = Html::elem('script')
                            ->type('text/javascript')
                            ->setText(sprintf('var data = %s; %s', $json, ($count == $poc ? 'location.href=data.url;' : 'setTimeout("generovani()", 200);')))
                            ->appendAfter(Html::elem('p')->id('wrap_progressbar')
                                                          ->insert(Html::elem('span')->id('progressbar')->style('width', sprintf('%s%%', $percent)))
                                                          ->insert(Html::elem('span')->id('progressbar_status')->setText(sprintf('%s%%', $percent)))
                                          )
                            ->appendAfter(Html::elem('p')->id('status_filename')->insert(Html::elem('span')->setText(basename($name))))
                            ->appendAfter(Html::elem('p')->id('info_status')
                                                          ->insert(Html::elem('span')->id('number_status')->setText(sprintf(_('%s of %s'), $poc, $count)))
                                                          ->insert(Html::elem('span')->id('time_status')->setText(date(_('H:i:s'))))
                                          );
          }
        break;

        case 'sortdirs':
          $arrays = Core::isFill($_POST, 'arrays');

          Notification::setPath($_POST['weburl']);

          $iddir = base64_decode(Core::isFill($_POST, 'iddir'));

          $xml_path = ModuleDirs::getXmlPath();

          $data = XmlStorage::getData($xml_path);

          //prime volani core pro dekodovani
          $base = array_map('classes\Core::easyDecode', $arrays);
          $decode_array = array_map('base64_decode', $base);

          $new_data = array();
          foreach ($decode_array as $index) {
            $new_data[$index] = $data[$iddir]['files'][$index];  //preskladani pole
          }

          $data[$iddir]['files'] = $new_data;

          if (XmlStorage::setData($xml_path, $data)) {
            $result = Notification::info(_('Sucessfull saved'))->wait(Notification::SMALL);
          }
        break;
      }

      return $result;
    }
  }

  class ExceptionModulePictures extends Exception {}

?>
